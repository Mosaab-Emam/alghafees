<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingQuestionnaireRequest;
use App\Mail\TrainingQuestionnaireMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrainingQuestionnaireController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('training/TrainingQuestionnaire', [
            'title' => 'استكمال إجراءات التدريب | شركة صالح علي الغفيص',
            'description' => 'نموذج استكمال البيانات المطلوبة لإجراءات التدريب.',
            'noindex' => true,
            'questions' => config('training.questions'),
        ])->toResponse(request())->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }

    public function store(TrainingQuestionnaireRequest $request): JsonResponse
    {
        $answers = $request->safe()->except('website');
        $startedAt = microtime(true);

        try {
            // Send immediately: show success only after SMTP accepts the message.
            $sent = Mail::mailer('training_questionnaire')->to(config('training.recipient'))
                ->send(new TrainingQuestionnaireMail($answers));

            if ($sent === null) {
                throw new RuntimeException('The mailer did not return a sent message.');
            }
        } catch (Throwable $exception) {
            // Do not log applicants' personal data or SMTP credentials.
            Log::error('Training questionnaire email delivery failed.', [
                'exception_type' => get_class($exception),
            ]);

            return response()->json([
                'message' => 'تعذر إرسال بياناتك حاليًا. بياناتك ما زالت في النموذج، يرجى المحاولة لاحقًا.',
            ], 503);
        }

        Log::info('Training questionnaire email accepted by SMTP.', [
            'mailer' => 'training_questionnaire',
            'message_id' => $sent->getMessageId(),
            'sender' => $sent->getEnvelope()->getSender()->getAddress(),
            'recipients' => array_map(
                fn ($address) => $address->getAddress(),
                $sent->getEnvelope()->getRecipients()
            ),
            'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
        ]);

        return response()->json(['message' => 'تم إرسال بياناتك بنجاح.']);
    }
}
