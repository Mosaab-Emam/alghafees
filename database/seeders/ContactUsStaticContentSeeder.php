<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUsStaticContent;

class ContactUsStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUsStaticContent::create([
            'small_top_title' => 'تواصل معنا',
            'main_top_title' => 'ابق على اتصال',
            'form_title' => 'املئ بيانات النموذج بالأسفل',
            'form_description' => 'قم بملء المعلومات في النموذج أدناه وسنتصل بك في أقرب وقت ممكن',
            'title' => 'نحن هنا $$لمساعدتك$$ تواصل معنا الآن',
            'box_title' => 'طلب عرض سعر',
            'phone' => '0539455519',
            'email' => 'info@alghafees.sa',
            'cta_text' => 'طلب تقييم',
            'cta_link' => 'request-evaluation',
        ]);
    }
}
