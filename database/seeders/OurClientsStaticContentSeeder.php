<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OurClientsStaticContent;

class OurClientsStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurClientsStaticContent::create([
            'small_top_title' => 'عملاؤنا',
            'main_top_title' => 'ثقة عملائنا',
            'main_title' => 'استمع إلى عملائنا كيف ساعدناهم في تحقيق $$أهدافهم العقارية$$ بنجاح واحترافية',
            'main_description' => 'نحن فخورون بعملائنا الراضين الذين يشاركوننا تجاربهم الإيجابية. نؤمن أن أفضل دليل على جودة خدماتنا هو رضا عملائنا وثقتهم بنا. اكتشف ما يقوله عملاؤنا عن الاستشارات العقارية التي نقدمها، وكيف ساعدناهم في تحقيق أهدافهم العقارية بطريقة سلسة وموثوقة. انضم إلى مجموعة عملائنا السعداء وكن جزءًا من رحلتنا المتميزة',
            'clients_title' => 'ثقة $$عملاؤنا$$ مبنية على إنجازات ملموسة',
        ]);
    }
}
