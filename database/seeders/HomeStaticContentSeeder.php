<?php

namespace Database\Seeders;

use App\Models\HomeStaticContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeStaticContent::create([
            'hero_small_top_title' => 'رحلتك العقارية في $$جميع$$ أنجاء المملكة',
            'hero_main_title' => 'إبدأ $$رحلتك العقارية$$ معنا بخطوات بسيطة واستشارات موثوقة ومتاعبة دقيقة',
            'hero_image' => '/hero_image.png',
            'description' => 'تفخر شركة صالح علي الغفيص للتقييم العقاري بفروعها المرخصة في مزاولة مهنة التقييم العقاري في كل من الرياض والقصيم ، حيث سعينا منذ وقت مبكر على التواصل مع الهيئة السعودية للمقيمين المعتمدين ايماناً منا بأهمية مهنة التقييم وتطويرها وتنظيمها ليكون العمل بالمهنة وفق األنظمة والمعايير الدولية للتقييم',
            'hero_main_button_text' => 'اتصل بنا',
            'hero_main_button_link' => '/contact-us',
            'hero_secondary_button_text' => 'تدقم بطلبك الآن',
            'hero_secondary_button_link' => '/request-evaluation',
            'hero_download_box_text' => 'حمل تطبيق $$الغفيص$$ الآن واستفد من خجماتنا العقارية أينما كنت',
            'hero_x_link' => 'https://x.com',
            'hero_linkedin_link' => 'https://linkedin.com',
            'hero_youtube_link' => 'https://youtube.com',
            'hero_vertical_text' => 'Saleh Al-Ghafis REV.Co.',
        ]);
    }
}