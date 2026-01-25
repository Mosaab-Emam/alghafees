<?php

namespace App\Http\Controllers;

use App\Services\RateRequestChatbotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppWebhookController extends Controller
{
    private RateRequestChatbotService $chatbotService;
    private const TRIGGER_PHRASE = 'طلب تقييم';

    public function __construct(RateRequestChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    /**
     * Handle incoming WhatsApp webhook
     */
    public function handleWebhook(Request $request)
    {
        // Log incoming request for debugging
        Log::info('WhatsApp webhook received', [
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
        ]);

        // Validate webhook signature
        if (!$this->validateSignature($request)) {
            Log::warning('Invalid webhook signature', [
                'signature' => $request->header('X-Webhook-Signature'),
            ]);
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Extract message data from webhook payload
        $messageData = $this->extractMessageData($request);

        if (!$messageData) {
            Log::warning('Could not extract message data from webhook', [
                'payload' => $request->all(),
            ]);
            return response()->json(['message' => 'No message data'], 200);
        }

        $phoneNumber = $messageData['phone_number'];
        $messageText = $messageData['message_text'];

        // Check for trigger phrase
        if (!$this->hasTriggerPhrase($messageText)) {
            Log::info('Message does not contain trigger phrase', [
                'phone' => $phoneNumber,
                'message' => $messageText,
            ]);
            // Return 200 OK but don't process
            return response()->json(['message' => 'Trigger phrase not found'], 200);
        }

        // Process message asynchronously to respond quickly
        // Use queue or dispatch to background job for better performance
        try {
            $this->chatbotService->handleMessage($phoneNumber, $messageText);
        } catch (\Exception $e) {
            Log::error('Error processing WhatsApp message', [
                'phone' => $phoneNumber,
                'message' => $messageText,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        // Always return 200 OK quickly to acknowledge receipt
        return response()->json(['message' => 'Webhook received'], 200);
    }

    /**
     * Validate webhook signature
     */
    private function validateSignature(Request $request): bool
    {
        $signature = $request->header('X-Webhook-Signature');
        $webhookSecret = config('services.wasender.webhook_secret', env('WASENDER_API_WEBHOOK_SECRET'));

        if (!$signature || !$webhookSecret) {
            return false;
        }

        // WA Sender API uses simple string comparison
        // For better security, you could implement HMAC-SHA256 if the API supports it
        return hash_equals($webhookSecret, $signature);
    }

    /**
     * Extract message data from webhook payload
     * 
     * WA Sender API webhook structure:
     * {
     *   "event": "messages.received",
     *   "data": {
     *     "messages": {
     *       "key": {
     *         "cleanedSenderPn": "1234567890",
     *         "cleanedParticipantPn": "1234567890" (for groups)
     *       },
     *       "messageBody": "message text"
     *     }
     *   }
     * }
     */
    private function extractMessageData(Request $request): ?array
    {
        $payload = $request->all();

        // Try different payload structures
        $phoneNumber = null;
        $messageText = null;

        // Structure 1: data.messages.key.cleanedSenderPn
        if (isset($payload['data']['messages']['key']['cleanedSenderPn'])) {
            $phoneNumber = $payload['data']['messages']['key']['cleanedSenderPn'];
        }
        // Structure 2: data.messages.key.cleanedParticipantPn (for groups)
        elseif (isset($payload['data']['messages']['key']['cleanedParticipantPn'])) {
            $phoneNumber = $payload['data']['messages']['key']['cleanedParticipantPn'];
        }
        // Structure 3: messages.key.cleanedSenderPn (alternative structure)
        elseif (isset($payload['messages']['key']['cleanedSenderPn'])) {
            $phoneNumber = $payload['messages']['key']['cleanedSenderPn'];
        }

        // Extract message text
        if (isset($payload['data']['messages']['messageBody'])) {
            $messageText = $payload['data']['messages']['messageBody'];
        } elseif (isset($payload['messages']['messageBody'])) {
            $messageText = $payload['messages']['messageBody'];
        } elseif (isset($payload['data']['messages']['message']['conversation'])) {
            $messageText = $payload['data']['messages']['message']['conversation'];
        } elseif (isset($payload['messageBody'])) {
            $messageText = $payload['messageBody'];
        } elseif (isset($payload['text'])) {
            $messageText = $payload['text'];
        }

        if (!$phoneNumber || !$messageText) {
            return null;
        }

        return [
            'phone_number' => $phoneNumber,
            'message_text' => $messageText,
        ];
    }

    /**
     * Check if message contains trigger phrase
     */
    private function hasTriggerPhrase(string $message): bool
    {
        return mb_stripos($message, self::TRIGGER_PHRASE) !== false;
    }
}
