<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.wasender.api_key', env('WASENDER_API_KEY'));
        $this->apiUrl = 'https://wasenderapi.com/api/send-message';
    }

    /**
     * Send a WhatsApp message
     *
     * @param string $phoneNumber Phone number in E.164 format (e.g., +966501234567)
     * @param string $message Message text to send
     * @return array Response from API
     * @throws \Exception
     */
    public function sendMessage(string $phoneNumber, string $message): array
    {
        // Ensure phone number is in E.164 format
        $formattedPhone = $this->formatPhoneNumber($phoneNumber);

        try {
            return $this->doSend($formattedPhone, $message, true);
        } catch (\Exception $e) {
            Log::error('WhatsApp service exception', [
                'phone' => $formattedPhone,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Perform send with optional retry on rate-limit (1 message per 5 seconds).
     */
    private function doSend(string $formattedPhone, string $message, bool $allowRetry): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, [
            'to' => $formattedPhone,
            'text' => $message,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            Log::info('WhatsApp message sent successfully', [
                'phone' => $formattedPhone,
                'response' => $data,
            ]);
            return $data;
        }

        $body = $response->body();
        $isRateLimit = str_contains($body, '1 message every 5 seconds') || str_contains($body, 'account protection');

        if ($isRateLimit && $allowRetry) {
            Log::info('WhatsApp rate limit hit, retrying after 5 seconds', ['phone' => $formattedPhone]);
            sleep(5);
            return $this->doSend($formattedPhone, $message, false);
        }

        Log::error('WhatsApp API error', [
            'phone' => $formattedPhone,
            'status' => $response->status(),
            'response' => $body,
        ]);

        throw new \Exception('Failed to send WhatsApp message: ' . $body);
    }

    /**
     * Format phone number to E.164 format
     *
     * @param string $phoneNumber
     * @return string
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
                return '+966' . substr($phoneNumber, 1);
            }
            // For other countries, we can't auto-detect, so return as is with +
            // The API should handle it or the user should provide full number
            return '+' . $phoneNumber;
        }

        // If it's a long number (10+ digits), it might already include country code
        // Check if it's a known Saudi format (starts with 5 and 10 digits), add +966
        if (preg_match('/^5[0-9]{9}$/', $phoneNumber)) {
            return '+966' . $phoneNumber;
        }

        // For numbers that look like they already have a country code (12+ digits starting with country code)
        // Just add + prefix and let the API handle it
        // Don't assume Saudi Arabia for all long numbers
        if (strlen($phoneNumber) >= 10) {
            return '+' . $phoneNumber;
        }

        // For shorter numbers, preserve as-is with +
        return '+' . $phoneNumber;
    }
}
