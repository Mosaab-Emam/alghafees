<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrackYourRequestStaticContent;

class TrackYourRequestStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrackYourRequestStaticContent::create([
            'small_top_title' => 'تتبع الطلب',
            'main_top_title' => 'تتبع مباشر',
            'title' => 'تابع طلبك خطوة بخطوة $$بسهولة$$ وشفافية',
            'description' => 'ببساطة قم بإدخال كود الطلب الخاص بك لتتعرف على مرحلته الحالية وتتبع جميع التفاصيل حتى إتمامه بنجاح',
            'search_placeholder' => 'ادخل الكود الخاص بطلبك هنا',
            'btn_text' => 'ارسال',
        ]);
    }
}
