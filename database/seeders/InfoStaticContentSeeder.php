<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InfoStaticContent;

class InfoStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfoStaticContent::create([
            'description' => 'تفخر شركة صالح علي الغفيص للتقييم العقاري بفروعها المرخصة في مزاولة مهنة التقييم العقاري في كل من الرياض والقصيم.',
            'info_section_title' => 'فروعنا تغطي جميع انحاء المملكة....',
            'work_hours' => 'من السبت : للخميس -- 8 صباحًا : 8 مساءًا',
            'email' => 'Info@alghafees.sa',
            'phone_number' => '0539455519',
            'whatsapp_number' => '0539455519',
            'address_1' => 'طريق الملك سلمان بن عبدالعزيز- الملقا-الرياض 13525- المملكة العربية السعودية',
            'address_2' => 'طريق الملك سلمان - حي النهضة - بريدة 52389 - القصيم - المملكة العربية السعودية',
            'ios_app_link' => '',
            'android_app_link' => '',
            'x_link' => 'https://x.com',
            'linkedin_link' => 'https://www.linkedin.com',
            'youtube_link' => 'https://www.youtube.com',
        ]);
    }
}
