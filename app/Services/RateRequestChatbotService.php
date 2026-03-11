<?php

namespace App\Services;

use App\Http\Requests\CreateRateRequestRequest;
use App\Interfaces\RateRequestRepositoryInterface;
use App\Models\Category;
use App\Models\PricePackage;
use App\Models\RateRequest;
use App\Models\WhatsAppConversation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RateRequestChatbotService
{
    private WhatsAppService $whatsAppService;
    private RateRequestRepositoryInterface $rateRepository;
    private WhatsAppChatbotStringsService $strings;

    // Field collection order (only required/non-nullable fields)
    private array $fieldOrder = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'address',
        'goal_id',
        'type_id',
        'real_estate_age',
        'real_estate_area',
        'estate_city',
        'estate_region',
        'estate_line_1',
        'notes',
    ];

    public function __construct(
        WhatsAppService $whatsAppService,
        RateRequestRepositoryInterface $rateRepository,
        WhatsAppChatbotStringsService $strings
    ) {
        $this->whatsAppService = $whatsAppService;
        $this->rateRepository = $rateRepository;
        $this->strings = $strings;
    }

    /**
     * Handle incoming message
     */
    public function handleMessage(string $phoneNumber, string $messageText): void
    {
        if ($this->isCancelMessage($messageText)) {
            $this->handleCancel($phoneNumber);
            return;
        }

        $conversation = WhatsAppConversation::findOrCreateForPhone($phoneNumber);
        $isNewConversation = $conversation->wasRecentlyCreated || empty($conversation->getCollectedData());

        $trimmedMessage = trim($messageText);
        $isExactTriggerPhrase = mb_strtolower($trimmedMessage) === mb_strtolower($this->strings->triggerPhrase());

        if ($isExactTriggerPhrase) {
            $conversation->reset();
            $isNewConversation = true;
        }

        if (in_array($conversation->state, ['completed', 'cancelled'])) {
            $conversation->reset();
            $isNewConversation = true;
        }

        $currentField = $conversation->getCurrentField();

        if (!$currentField) {
            $currentField = $this->fieldOrder[0];
            $conversation->setCurrentField($currentField);

            if ($isNewConversation) {
                $welcomeMessage = $this->strings->welcomeMessage();
                $welcomeMessage .= $this->getFieldPrompt($currentField, $conversation);
                $this->sendMessage($phoneNumber, $welcomeMessage);
            } else {
                $this->sendFieldPrompt($phoneNumber, $currentField, $conversation);
            }
            return;
        }

        // Validate and process current field
        $validationResult = $this->validateField($currentField, $messageText, $conversation);

        if (!$validationResult['valid']) {
            // Send error message and re-prompt
            $this->sendMessage($phoneNumber, $validationResult['error'] . "\n\n" . $this->strings->cancelFooter());
            $this->sendFieldPrompt($phoneNumber, $currentField, $conversation);
            return;
        }

        // Store validated value
        $conversation->setField($currentField, $validationResult['value']);

        // Move to next field
        $nextField = $this->getNextField($currentField);

        if ($nextField) {
            $conversation->setCurrentField($nextField);
            $this->sendFieldPrompt($phoneNumber, $nextField, $conversation);
        } else {
            // All fields collected, create rate request
            $this->createRateRequest($phoneNumber, $conversation);
        }
    }

    /**
     * Check if message is a cancel command
     */
    private function isCancelMessage(string $message): bool
    {
        $message = mb_strtolower(trim($message));
        foreach ($this->strings->cancelKeywords() as $keyword) {
            if (mb_strpos($message, mb_strtolower($keyword)) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Handle cancel command
     */
    private function handleCancel(string $phoneNumber): void
    {
        $conversation = WhatsAppConversation::findOrCreateForPhone($phoneNumber);
        $conversation->markCancelled();
        // Do not reset — keep state=cancelled so unrelated messages won't be treated as
        // "active conversation"; only "طلب تقييم" starts fresh (we reset then in handleMessage).

        $this->sendMessage($phoneNumber, $this->strings->cancelConfirmation(), false);
    }

    /**
     * Validate a field value
     */
    private function validateField(string $field, string $value, WhatsAppConversation $conversation): array
    {
        // Special handling for category fields
        if (in_array($field, ['goal_id', 'type_id', 'entity_id', 'usage_id'])) {
            return $this->validateCategoryField($field, $value, $conversation);
        }

        // Get validation rules from CreateRateRequestRequest
        $request = new CreateRateRequestRequest();
        $rules = $request->rules();
        $messages = $request->messages();

        // Get rule for this field
        $rule = $rules[$field] ?? null;
        if (!$rule) {
            return ['valid' => true, 'value' => $value];
        }

        // Validate
        $validator = Validator::make([$field => $value], [$field => $rule], $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first($field);
            return ['valid' => false, 'error' => $error];
        }

        // Convert value if needed
        $validatedValue = $validator->validated()[$field];
        if (in_array($field, ['real_estate_age', 'real_estate_area'])) {
            $validatedValue = (int) $validatedValue;
        }

        return ['valid' => true, 'value' => $validatedValue];
    }

    /**
     * Validate category field (goal_id, type_id, etc.)
     */
    private function validateCategoryField(string $field, string $value, WhatsAppConversation $conversation): array
    {
        // Get category type based on field
        $categoryType = match ($field) {
            'goal_id' => 'apartmentGoal',
            'type_id' => 'apartmentType',
            'entity_id' => 'apartmentEntity',
            'usage_id' => 'apartmentUsage',
            default => null,
        };

        if (!$categoryType) {
            return ['valid' => false, 'error' => 'حقل غير صحيح'];
        }

        // Get categories for this type
        $categories = Category::$categoryType()->publish()->ordered()->get();

        // Check if value is a number (selection from list)
        if (is_numeric($value)) {
            $index = (int) $value - 1; // Convert to 0-based index
            if ($index >= 0 && $index < $categories->count()) {
                $selectedCategory = $categories[$index];
                return ['valid' => true, 'value' => $selectedCategory->id];
            }
            return ['valid' => false, 'error' => 'الرقم المحدد غير صحيح. الرجاء اختيار رقم من القائمة'];
        }

        // Try to find by title
        $category = $categories->first(function ($cat) use ($value) {
            return mb_stripos($cat->title, $value) !== false;
        });

        if ($category) {
            return ['valid' => true, 'value' => $category->id];
        }

        return ['valid' => false, 'error' => 'القيمة غير صحيحة. الرجاء اختيار رقم من القائمة'];
    }

    /**
     * Send prompt for a field
     */
    private function sendFieldPrompt(string $phoneNumber, string $field, WhatsAppConversation $conversation): void
    {
        $prompt = $this->getFieldPrompt($field, $conversation);
        $this->sendMessage($phoneNumber, $prompt);
    }

    /**
     * Get prompt text for a field
     */
    private function getFieldPrompt(string $field, WhatsAppConversation $conversation): string
    {
        if (in_array($field, ['goal_id', 'type_id'])) {
            $prompt = $this->getCategoryPrompt($field, $this->strings->categoryLabel($field), $conversation);
        } else {
            $prompt = $this->strings->fieldPrompt($field);
        }

        return $prompt . "\n\n" . $this->strings->cancelFooter();
    }

    /**
     * Get category selection prompt with numbered list
     */
    private function getCategoryPrompt(string $field, string $label, WhatsAppConversation $conversation): string
    {
        $categoryType = match ($field) {
            'goal_id' => 'apartmentGoal',
            'type_id' => 'apartmentType',
            'entity_id' => 'apartmentEntity',
            'usage_id' => 'apartmentUsage',
            default => null,
        };

        if (!$categoryType) {
            $template = $this->strings->categoryChooseTemplate();
            return str_replace('{label}', $label, $template);
        }

        $categories = Category::$categoryType()->publish()->ordered()->get();
        $template = $this->strings->categoryChooseTemplate();
        $prompt = str_replace('{label}', $label, $template) . "\n";
        $index = 1;
        foreach ($categories as $category) {
            $prompt .= "{$index}. {$category->title}\n";
            $index++;
        }
        $prompt .= "\n" . $this->strings->categoryEnterNumber();

        return $prompt;
    }

    /**
     * Get next field in collection order
     */
    private function getNextField(string $currentField): ?string
    {
        $currentIndex = array_search($currentField, $this->fieldOrder);
        if ($currentIndex === false || $currentIndex === count($this->fieldOrder) - 1) {
            return null;
        }
        return $this->fieldOrder[$currentIndex + 1];
    }

    /**
     * Create rate request from collected data
     */
    private function createRateRequest(string $phoneNumber, WhatsAppConversation $conversation): void
    {
        try {
            $data = $conversation->getCollectedData();

            // Add auto-filled fields
            $firstPackage = PricePackage::first();
            if (!$firstPackage) {
                $this->sendMessage($phoneNumber, $this->strings->errorNoPricePackages() . "\n\n" . $this->strings->cancelFooter());
                return;
            }

            $data['price_package_id'] = $firstPackage->id;
            $data['source'] = 'whatsapp';

            // Generate request_no
            $latestRequest = RateRequest::latest()->first();
            $data['request_no'] = $latestRequest ? $latestRequest->id * 100 : '1000';

            // Validate all data using CreateRateRequestRequest
            $validator = Validator::make($data, (new CreateRateRequestRequest())->rules(), (new CreateRateRequestRequest())->messages());

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $errorMessage = $this->strings->errorValidationPrefix() . "\n" . implode("\n", $errors);
                $this->sendMessage($phoneNumber, $errorMessage . "\n\n" . $this->strings->cancelFooter());
                return;
            }

            // Create rate request
            $rateRequest = $this->rateRepository->createRateRequest($data);

            // Mark conversation as completed (do not reset — keeps state=completed so
            // unrelated messages won't be treated as "active conversation"; only "طلب تقييم" starts fresh)
            $conversation->markCompleted();

            // Send success message (no cancel footer — flow is complete)
            $this->sendMessage($phoneNumber, $this->strings->successMessage((string) $data['request_no']), false);
        } catch (\Exception $e) {
            Log::error('Error creating rate request from WhatsApp', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->sendMessage($phoneNumber, $this->strings->errorCreateFailed() . "\n\n" . $this->strings->cancelFooter());
        }
    }

    /**
     * Send WhatsApp message, optionally appending the cancel footer.
     */
    private function sendMessage(string $phoneNumber, string $message, bool $includeCancelFooter = true): void
    {
        $footer = $this->strings->cancelFooter();
        if ($includeCancelFooter && !str_contains($message, $footer)) {
            $message .= "\n\n" . $footer;
        }

        try {
            $this->whatsAppService->sendMessage($phoneNumber, $message);
        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp message', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);
        }
    }

}
