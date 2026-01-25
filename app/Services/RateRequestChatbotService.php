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

    // Cancel keywords
    private array $cancelKeywords = ['إلغاء', 'الغاء', 'cancel', 'إلغ'];

    public function __construct(
        WhatsAppService $whatsAppService,
        RateRequestRepositoryInterface $rateRepository
    ) {
        $this->whatsAppService = $whatsAppService;
        $this->rateRepository = $rateRepository;
    }

    /**
     * Handle incoming message
     */
    public function handleMessage(string $phoneNumber, string $messageText): void
    {
        // Check for cancel
        if ($this->isCancelMessage($messageText)) {
            $this->handleCancel($phoneNumber);
            return;
        }

        // Get or create conversation
        $conversation = WhatsAppConversation::findOrCreateForPhone($phoneNumber);
        $isNewConversation = $conversation->wasRecentlyCreated || empty($conversation->getCollectedData());

        // If message IS EXACTLY the trigger phrase (by itself, after trimming), always reset to start fresh
        $trimmedMessage = trim($messageText);
        $isExactTriggerPhrase = mb_strtolower($trimmedMessage) === mb_strtolower('طلب تقييم');

        if ($isExactTriggerPhrase) {
            $conversation->reset();
            $isNewConversation = true;
        }

        // If conversation is completed or cancelled, start fresh
        if (in_array($conversation->state, ['completed', 'cancelled'])) {
            $conversation->reset();
            $isNewConversation = true;
        }

        // Get current field being collected
        $currentField = $conversation->getCurrentField();

        // If no current field, start with welcome message and first field prompt in one message
        if (!$currentField) {
            $currentField = $this->fieldOrder[0];
            $conversation->setCurrentField($currentField);

            if ($isNewConversation) {
                $welcomeMessage = "مرحباً! سأساعدك في إنشاء طلب تقييم عقاري.\n\n";
                $welcomeMessage .= "سنحتاج إلى بعض المعلومات منك. دعنا نبدأ:\n\n";
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
            $this->sendMessage($phoneNumber, $validationResult['error'] . "\n\n" . $this->getCancelFooter());
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
        foreach ($this->cancelKeywords as $keyword) {
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

        $this->sendMessage($phoneNumber, "تم إلغاء الطلب. شكراً لك!", false);
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
        $prompts = [
            'first_name' => 'الرجاء إدخال الاسم الأول:',
            'last_name' => 'الرجاء إدخال اسم العائلة:',
            'mobile' => 'الرجاء إدخال رقم الجوال (يجب أن يبدأ بـ 05 ويحتوي على 10 أرقام):',
            'email' => 'الرجاء إدخال البريد الإلكتروني:',
            'address' => 'الرجاء إدخال العنوان:',
            'goal_id' => $this->getCategoryPrompt('goal_id', 'الهدف', $conversation),
            'type_id' => $this->getCategoryPrompt('type_id', 'نوع العقار', $conversation),
            'real_estate_age' => 'الرجاء إدخال عمر العقار (بالسنوات):',
            'real_estate_area' => 'الرجاء إدخال مساحة العقار (بالمتر المربع):',
            'estate_city' => 'الرجاء إدخال مدينة العقار:',
            'estate_region' => 'الرجاء إدخال حي العقار:',
            'estate_line_1' => 'الرجاء إدخال العنوان التفصيلي للعقار:',
            'notes' => 'الرجاء إدخال أي ملاحظات إضافية:',
        ];

        $prompt = $prompts[$field] ?? 'الرجاء إدخال ' . $field;
        return $prompt . "\n\n" . $this->getCancelFooter();
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
            return "اختر {$label}:";
        }

        $categories = Category::$categoryType()->publish()->ordered()->get();

        $prompt = "اختر {$label}:\n";
        $index = 1;
        foreach ($categories as $category) {
            $prompt .= "{$index}. {$category->title}\n";
            $index++;
        }
        $prompt .= "\nالرجاء إدخال الرقم";

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
                $this->sendMessage($phoneNumber, "عذراً، لا توجد حزم أسعار متاحة حالياً. يرجى المحاولة لاحقاً.\n\n" . $this->getCancelFooter());
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
                $errorMessage = "حدث خطأ في البيانات:\n" . implode("\n", $errors);
                $this->sendMessage($phoneNumber, $errorMessage . "\n\n" . $this->getCancelFooter());
                return;
            }

            // Create rate request
            $rateRequest = $this->rateRepository->createRateRequest($data);

            // Mark conversation as completed (do not reset — keeps state=completed so
            // unrelated messages won't be treated as "active conversation"; only "طلب تقييم" starts fresh)
            $conversation->markCompleted();

            // Send success message (no cancel footer — flow is complete)
            $successMessage = "تم إنشاء طلب التقييم بنجاح!\n\n";
            $successMessage .= "رقم الطلب: {$data['request_no']}\n\n";
            $successMessage .= "شكراً لك على استخدام خدمتنا. سنتواصل معك قريباً.";

            $this->sendMessage($phoneNumber, $successMessage, false);
        } catch (\Exception $e) {
            Log::error('Error creating rate request from WhatsApp', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->sendMessage($phoneNumber, "عذراً، حدث خطأ أثناء إنشاء الطلب. يرجى المحاولة مرة أخرى لاحقاً.\n\n" . $this->getCancelFooter());
        }
    }

    /**
     * Send WhatsApp message, optionally appending the cancel footer.
     */
    private function sendMessage(string $phoneNumber, string $message, bool $includeCancelFooter = true): void
    {
        if ($includeCancelFooter && !str_contains($message, $this->getCancelFooter())) {
            $message .= "\n\n" . $this->getCancelFooter();
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

    /**
     * Get cancel footer text
     */
    private function getCancelFooter(): string
    {
        return "اكتب 'إلغاء' لإلغاء الطلب";
    }
}
