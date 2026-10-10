<?php

namespace App\Services;

use App\Exceptions\WhatsAppRateLimitException;
use App\Exceptions\WhatsAppSendException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $apiKey;

    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = (string) config('services.wasender.api_key');
        $this->apiUrl = 'https://wasenderapi.com/api/send-message';
    }

    /**
     * Send a WhatsApp message
     *
     * @param  string  $phoneNumber  Phone number in E.164 format (e.g., +966501234567)
     * @param  string  $message  Message text to send
     * @return array Response from API
     *
     * @throws \Exception
     */
    public function sendMessage(string $phoneNumber, string $message, bool $retryRateLimit = true): array
    {
        if ($this->apiKey === '') {
            throw new WhatsAppSendException('not_configured', true);
        }
        // Ensure phone number is in E.164 format
        $formattedPhone = $this->formatPhoneNumber($phoneNumber);

        try {
            return $this->doSend($formattedPhone, $message, $retryRateLimit);
        } catch (\Exception $e) {
            Log::error('WhatsApp service exception', [
                'phone' => $formattedPhone,
                'exception' => get_class($e),
            ]);
            throw $e;
        }
    }

    /**
     * Perform a send with one optional short rate-limit retry for existing synchronous callers.
     */
    private function doSend(string $formattedPhone, string $message, bool $allowRetry): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
            'Content-Type' => 'application/json',
        ])->connectTimeout(5)->timeout(20)->post($this->apiUrl, [
            'to' => $formattedPhone,
            'text' => $message,
        ]);

        $body = strtolower($response->body());
        $isRateLimit = $response->status() === 429
            || (! $response->successful() && (
                str_contains($body, '1 message every 5 seconds')
                || (str_contains($body, 'account protection') && (
                    str_contains($body, 'wait') || str_contains($body, 'rate limit')
                    || str_contains($body, '5 seconds') || str_contains($body, 'too many')
                ))
            ));

        if ($isRateLimit) {
            $delay = $this->retryAfter($response);
            if ($allowRetry && $delay <= 60) {
                sleep($delay);

                return $this->doSend($formattedPhone, $message, false);
            }

            throw new WhatsAppRateLimitException($delay);
        }

        if ($response->successful()) {
            $data = $response->json();
            if (! is_array($data) || ($data['success'] ?? false) !== true) {
                throw new WhatsAppSendException('unconfirmed');
            }
            Log::info('WhatsApp message sent successfully', [
                'phone' => $formattedPhone,
                'message_id' => data_get($data, 'data.msgId'),
            ]);

            return $data;
        }

        Log::error('WhatsApp API error', [
            'phone' => $formattedPhone,
            'status' => $response->status(),
        ]);

        if (str_contains($body, 'session') && (str_contains($body, 'not connected') || str_contains($body, 'disconnected'))) {
            throw new WhatsAppSendException('session_unavailable', true);
        }

        throw new WhatsAppSendException(match ($response->status()) {
            401, 403 => 'authentication',
            402 => 'subscription',
            422 => 'recipient_rejected',
            503 => 'session_unavailable',
            default => 'unconfirmed',
        }, in_array($response->status(), [401, 402, 403], true) || $response->status() >= 500);
    }

    private function retryAfter(Response $response): int
    {
        $data = $response->json();
        $delays = [];
        foreach (['retry_after', 'data.retry_after'] as $key) {
            $value = is_array($data) ? data_get($data, $key) : null;
            if (is_numeric($value) && (float) $value > 0) {
                $delays[] = (int) ceil((float) $value);
            }
        }
        $retryHeader = $response->header('Retry-After');
        if (is_numeric($retryHeader)) {
            $delays[] = (int) ceil((float) $retryHeader);
        } elseif ($retryHeader && ($timestamp = strtotime($retryHeader)) !== false) {
            $delays[] = max(0, $timestamp - time());
        }

        if ($delays === []) {
            foreach (['X-RateLimit' => 'X-RateLimit-Reset', 'X-RateLimit-Daily' => 'X-RateLimit-Daily-Reset'] as $prefix => $header) {
                $remaining = $response->header($prefix.'-Remaining');
                $value = $response->header($header);
                if ($remaining !== '' && is_numeric($remaining) && (int) $remaining === 0 && is_numeric($value) && (float) $value > 0) {
                    // WASender documents seconds until reset; tolerate epoch-style gateways too.
                    $seconds = (float) $value;
                    $delays[] = (int) ceil($seconds > 1000000000 ? max(0, $seconds - time()) : $seconds);
                }
            }
        }

        // A one-second cushion avoids retrying exactly at the provider's window boundary.
        return max([5, ...$delays]) + 1;
    }

    /**
     * Format phone number to E.164 format
     */
    private function formatPhoneNumber(string $phoneNumber): string
    {
        // Remove any non-numeric characters except +
        $phoneNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

        // If already in E.164 format (starts with +), return as is
        if (str_starts_with($phoneNumber, '+')) {
            return $phoneNumber;
        }

        // If it starts with 0, it's likely a local number - determine country code
        // For Saudi numbers starting with 0, replace with +966
        if (preg_match('/^0/', $phoneNumber)) {
            // Check if it's a Saudi number (10 digits after 0)
            if (preg_match('/^05[0-9]{8}$/', $phoneNumber)) {
                return '+966'.substr($phoneNumber, 1);
            }

            // For other countries, we can't auto-detect, so return as is with +
            // The API should handle it or the user should provide full number
            return '+'.$phoneNumber;
        }

        // If it's a long number (10+ digits), it might already include country code
        // Check if it's a known Saudi format (starts with 5 and 10 digits), add +966
        if (preg_match('/^5[0-9]{9}$/', $phoneNumber)) {
            return '+966'.$phoneNumber;
        }

        // For numbers that look like they already have a country code (12+ digits starting with country code)
        // Just add + prefix and let the API handle it
        // Don't assume Saudi Arabia for all long numbers
        if (strlen($phoneNumber) >= 10) {
            return '+'.$phoneNumber;
        }

        // For shorter numbers, preserve as-is with +
        return '+'.$phoneNumber;
    }
}
