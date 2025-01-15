<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RequestEvaluationStaticContent;

class RequestEvaluationStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestEvaluationStaticContent::create([
            'small_top_title' => 'طلب تقييم',
            'main_top_title' => 'تقييم شامل',
            'evaluation_title' => 'اجعل قرارك مستنيرًا $$بتقييم احترافي$$ لعقاركم',
            'evaluation_description' => 'هل تفكر في بيع أو شراء عقار؟ قم بملء طلب تقييم العقار الآن لتحصل على تقدير دقيق لقيمته. بتقديم معلومات بسيطة، يمكنك اتخاذ قرار مدروس استنادًا إلى بيانات موثوقة وتحليلات متعمقة. لا تفوت الفرصة؛ ابدأ اليوم!',
        ]);
    }
}
