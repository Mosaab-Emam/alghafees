<?php

namespace App\Services;

use App\Exceptions\WhatsAppSendException;
use App\Mail\TrainingQuestionnaireMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

class TrainingQuestionnaireDelivery
{
    /**
     * Attempt every selected channel, even if another channel fails.
     * No applicant answers or provider response bodies are written to logs.
     */
    public function send(array $answers): array
    {
        $method = strtolower(trim((string) config('training.delivery_method')));
        $channels = match ($method) {
            'email' => ['email'],
            'whatsapp' => ['whatsapp'],
            'both' => ['email', 'whatsapp'],
            default => throw new InvalidArgumentException('Invalid questionnaire delivery method.'),
        };

        // Validate all selected destinations before sending anything.
        $phone = null;
        if (in_array('whatsapp', $channels, true)) {
            $phone = preg_replace('/[\s()-]+/', '', (string) config('training.whatsapp_number'));
            $phone = preg_replace('/^00/', '+', $phone);
            if (! preg_match('/^\+?[1-9][0-9]{7,14}$/', $phone)) {
                throw new InvalidArgumentException('Questionnaire WhatsApp destination must include a country code.');
            }
            $phone = '+'.ltrim($phone, '+');
            if (blank(config('services.wasender.api_key'))) {
                throw new InvalidArgumentException('Questionnaire WhatsApp API key is not configured.');
            }
        }
        if (in_array('email', $channels, true) && (
            ! filter_var(config('training.recipient'), FILTER_VALIDATE_EMAIL)
            || blank(config('mail.mailers.training_questionnaire.host'))
        )) {
            throw new InvalidArgumentException('Questionnaire email destination or SMTP host is not configured.');
        }

        $submissionId = (string) Str::uuid();
        $result = ['sent' => [], 'failed' => []];
        foreach ($channels as $channel) {
            $startedAt = microtime(true);
            try {
                $context = $channel === 'email'
                    ? $this->sendEmail($answers)
                    : $this->sendWhatsApp($answers, $phone);
                Log::info($channel === 'email'
                    ? 'Training questionnaire email accepted by SMTP.'
                    : 'Training questionnaire WhatsApp message accepted by provider.', $context + [
                        'submission_id' => $submissionId,
                        'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
                    ]);
                $result['sent'][] = $channel;
            } catch (Throwable $exception) {
                Log::error('Training questionnaire '.$channel.' delivery failed.', [
                    'submission_id' => $submissionId,
                    'exception_type' => get_class($exception),
                    'reason' => $exception instanceof WhatsAppSendException ? $exception->reason : null,
                    'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
                ]);
                $result['failed'][] = $channel;
            }
        }

        return $result;
    }

    private function sendEmail(array $answers): array
    {
        $sent = Mail::mailer('training_questionnaire')->to(config('training.recipient'))
            ->send(new TrainingQuestionnaireMail($answers));
        if ($sent === null) {
            throw new RuntimeException('The mailer did not return a sent message.');
        }

        return [
            'mailer' => 'training_questionnaire',
            'message_id' => $sent->getMessageId(),
            'sender' => $sent->getEnvelope()->getSender()->getAddress(),
            'recipients' => array_map(
                fn ($address) => $address->getAddress(),
                $sent->getEnvelope()->getRecipients()
            ),
        ];
    }

    private function sendWhatsApp(array $answers, string $phone): array
    {
        $message = view('messages.training-questionnaire-whatsapp', [
            'answers' => $answers,
            'questions' => config('training.questions'),
            'submittedAt' => now('Asia/Riyadh')->format('Y/m/d H:i'),
        ])->render();

        // Let the applicant retry a failed request rather than block on provider rate limits.
        $sent = app(WhatsAppService::class)->sendMessage($phone, trim($message), false);

        return ['message_id' => data_get($sent, 'data.msgId'), 'recipient' => $phone];
    }
}
