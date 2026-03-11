<?php

namespace App\Services;

use App\Models\WhatsAppChatbotString;

class WhatsAppChatbotStringsService
{
    private ?array $cache = null;

    private function get(string $key, string $default = ''): string
    {
        if ($this->cache === null) {
            $this->cache = WhatsAppChatbotString::all()->keyBy('key')->map(fn ($row) => $row->value)->toArray();
        }
        $value = $this->cache[$key] ?? null;
        return trim((string) $value) !== '' ? (string) $value : $default;
    }

    public function triggerPhrase(): string
    {
        return $this->get('trigger_phrase', 'طلب تقييم');
    }

    /** @return array<string> */
    public function cancelKeywords(): array
    {
        $value = $this->get('cancel_keywords', 'إلغاء,الغاء,cancel,إلغ');
        return array_map('trim', array_filter(explode(',', $value)));
    }

    public function cancelFooter(): string
    {
        return $this->get('cancel_footer', "اكتب 'إلغاء' لإلغاء الطلب");
    }

    public function cancelConfirmation(): string
    {
        return $this->get('cancel_confirmation', 'تم إلغاء الطلب. شكراً لك!');
    }

    public function welcomeMessage(): string
    {
        return $this->get('welcome_message', "مرحباً! سأساعدك في إنشاء طلب تقييم عقاري.\n\nسنحتاج إلى بعض المعلومات منك. دعنا نبدأ:\n\n");
    }

    public function fieldPrompt(string $field): string
    {
        $key = 'prompt_' . $field;
        $defaults = [
            'first_name' => 'الرجاء إدخال الاسم الأول:',
            'last_name' => 'الرجاء إدخال اسم العائلة:',
            'mobile' => 'الرجاء إدخال رقم الجوال (يجب أن يبدأ بـ 05 ويحتوي على 10 أرقام):',
            'email' => 'الرجاء إدخال البريد الإلكتروني:',
            'address' => 'الرجاء إدخال العنوان:',
            'goal_id' => '', // built from category template + label
            'type_id' => '',
            'real_estate_age' => 'الرجاء إدخال عمر العقار (بالسنوات):',
            'real_estate_area' => 'الرجاء إدخال مساحة العقار (بالمتر المربع):',
            'estate_city' => 'الرجاء إدخال مدينة العقار:',
            'estate_region' => 'الرجاء إدخال حي العقار:',
            'estate_line_1' => 'الرجاء إدخال العنوان التفصيلي للعقار:',
            'notes' => 'الرجاء إدخال أي ملاحظات إضافية:',
        ];
        return $this->get($key, $defaults[$field] ?? 'الرجاء إدخال ' . $field);
    }

    public function categoryLabel(string $field): string
    {
        $key = 'category_label_' . $field;
        $defaults = [
            'goal_id' => 'الهدف',
            'type_id' => 'نوع العقار',
            'entity_id' => 'الكيان',
            'usage_id' => 'الاستخدام',
        ];
        return $this->get($key, $defaults[$field] ?? $field);
    }

    public function categoryChooseTemplate(): string
    {
        return $this->get('category_choose_template', 'اختر {label}:');
    }

    public function categoryEnterNumber(): string
    {
        return $this->get('category_enter_number', 'الرجاء إدخال الرقم');
    }

    public function errorNoPricePackages(): string
    {
        return $this->get('error_no_price_packages', 'عذراً، لا توجد حزم أسعار متاحة حالياً. يرجى المحاولة لاحقاً.');
    }

    public function errorValidationPrefix(): string
    {
        return $this->get('error_validation_prefix', 'حدث خطأ في البيانات:');
    }

    public function errorCreateFailed(): string
    {
        return $this->get('error_create_failed', 'عذراً، حدث خطأ أثناء إنشاء الطلب. يرجى المحاولة مرة أخرى لاحقاً.');
    }

    public function successMessageTemplate(): string
    {
        return $this->get('success_message', "تم إنشاء طلب التقييم بنجاح!\n\nرقم الطلب: {request_no}\n\nشكراً لك على استخدام خدمتنا. سنتواصل معك قريباً.");
    }

    /**
     * Replace placeholders in success message (e.g. {request_no}).
     */
    public function successMessage(string $requestNo): string
    {
        return str_replace('{request_no}', $requestNo, $this->successMessageTemplate());
    }

    /**
     * Clear in-memory cache (e.g. after admin update).
     */
    public function clearCache(): void
    {
        $this->cache = null;
    }
}
