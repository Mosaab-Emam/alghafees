<?php

namespace Database\Seeders;

use App\Models\WhatsAppChatbotString;
use Illuminate\Database\Seeder;

class WhatsAppChatbotStringsSeeder extends Seeder
{
    public function run(): void
    {
        $strings = [
            ['key' => 'trigger_phrase', 'value' => 'طلب تقييم', 'description' => 'النص الذي يفعّل بدء محادثة طلب التقييم'],
            ['key' => 'cancel_keywords', 'value' => 'إلغاء,الغاء,cancel,إلغ', 'description' => 'كلمات الإلغاء (مفصولة بفاصلة)'],
            ['key' => 'cancel_footer', 'value' => "اكتب 'إلغاء' لإلغاء الطلب", 'description' => 'نص تذييل رسالة الإلغاء في كل رسالة'],
            ['key' => 'cancel_confirmation', 'value' => 'تم إلغاء الطلب. شكراً لك!', 'description' => 'رسالة تأكيد بعد إلغاء الطلب'],
            ['key' => 'welcome_message', 'value' => "مرحباً! سأساعدك في إنشاء طلب تقييم عقاري.\n\nسنحتاج إلى بعض المعلومات منك. دعنا نبدأ:\n\n", 'description' => 'رسالة الترحيب عند بدء المحادثة'],
            ['key' => 'prompt_first_name', 'value' => 'الرجاء إدخال الاسم الأول:', 'description' => 'طلب حقل الاسم الأول'],
            ['key' => 'prompt_last_name', 'value' => 'الرجاء إدخال اسم العائلة:', 'description' => 'طلب حقل اسم العائلة'],
            ['key' => 'prompt_mobile', 'value' => 'الرجاء إدخال رقم الجوال (يجب أن يبدأ بـ 05 ويحتوي على 10 أرقام):', 'description' => 'طلب حقل الجوال'],
            ['key' => 'prompt_email', 'value' => 'الرجاء إدخال البريد الإلكتروني:', 'description' => 'طلب حقل البريد الإلكتروني'],
            ['key' => 'prompt_address', 'value' => 'الرجاء إدخال العنوان:', 'description' => 'طلب حقل العنوان'],
            ['key' => 'prompt_goal_id', 'value' => '', 'description' => 'طلب حقل الهدف (يُبنى تلقائياً من القائمة إن كان فارغاً)'],
            ['key' => 'prompt_type_id', 'value' => '', 'description' => 'طلب حقل نوع العقار (يُبنى تلقائياً من القائمة إن كان فارغاً)'],
            ['key' => 'prompt_real_estate_age', 'value' => 'الرجاء إدخال عمر العقار (بالسنوات):', 'description' => 'طلب حقل عمر العقار'],
            ['key' => 'prompt_real_estate_area', 'value' => 'الرجاء إدخال مساحة العقار (بالمتر المربع):', 'description' => 'طلب حقل مساحة العقار'],
            ['key' => 'prompt_estate_city', 'value' => 'الرجاء إدخال مدينة العقار:', 'description' => 'طلب حقل مدينة العقار'],
            ['key' => 'prompt_estate_region', 'value' => 'الرجاء إدخال حي العقار:', 'description' => 'طلب حقل حي العقار'],
            ['key' => 'prompt_estate_line_1', 'value' => 'الرجاء إدخال العنوان التفصيلي للعقار:', 'description' => 'طلب حقل العنوان التفصيلي'],
            ['key' => 'prompt_notes', 'value' => 'الرجاء إدخال أي ملاحظات إضافية:', 'description' => 'طلب حقل الملاحظات'],
            ['key' => 'category_label_goal_id', 'value' => 'الهدف', 'description' => 'عنوان قائمة الهدف'],
            ['key' => 'category_label_type_id', 'value' => 'نوع العقار', 'description' => 'عنوان قائمة نوع العقار'],
            ['key' => 'category_choose_template', 'value' => 'اختر {label}:', 'description' => 'قالب اختيار الفئة (placeholder: {label})'],
            ['key' => 'category_enter_number', 'value' => 'الرجاء إدخال الرقم', 'description' => 'نص بعد قائمة الفئات'],
            ['key' => 'error_no_price_packages', 'value' => 'عذراً، لا توجد حزم أسعار متاحة حالياً. يرجى المحاولة لاحقاً.', 'description' => 'خطأ عند عدم وجود حزم أسعار'],
            ['key' => 'error_validation_prefix', 'value' => 'حدث خطأ في البيانات:', 'description' => 'بادئة رسالة أخطاء التحقق'],
            ['key' => 'error_create_failed', 'value' => 'عذراً، حدث خطأ أثناء إنشاء الطلب. يرجى المحاولة مرة أخرى لاحقاً.', 'description' => 'خطأ عند فشل إنشاء الطلب'],
            ['key' => 'success_message', 'value' => "تم إنشاء طلب التقييم بنجاح!\n\nرقم الطلب: {request_no}\n\nشكراً لك على استخدام خدمتنا. سنتواصل معك قريباً.", 'description' => 'رسالة النجاح (placeholder: {request_no})'],
        ];

        foreach ($strings as $item) {
            WhatsAppChatbotString::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'], 'description' => $item['description'] ?? null]
            );
        }
    }
}
