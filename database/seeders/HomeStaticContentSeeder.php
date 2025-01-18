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
            // Hero Section
            'hero_small_top_title' => 'رحلتك العقارية في $$جميع$$ أنحاء المملكة',
            'hero_main_title' => 'إبدأ $$رحلتك العقارية$$ معنا بخطوات بسيطة واستشارات موثوقة ومتابعة دقيقة',
            'hero_description' => 'تفخر شركة صالح علي الغفيص للتقييم العقاري بفروعها المرخصة في مزاولة مهنة التقييم العقاري في كل من الرياض والقصيم ، حيث سعينا منذ وقت مبكر على التواصل مع الهيئة السعودية للمقيمين المعتمدين ايماناً منا بأهمية مهنة التقييم وتطويرها وتنظيمها ليكون العمل بالمهنة وفق األنظمة والمعايير الدولية للتقييم',
            'hero_main_button_text' => 'اتصل بنا',
            'hero_main_button_link' => '/contact-us',
            'hero_secondary_button_text' => 'تدقم بطلبك الآن',
            'hero_secondary_button_link' => '/request-evaluation',
            'hero_download_box_text' => 'حمل تطبيق $$الغفيص$$ الآن واستفد من خجماتنا العقارية أينما كنت',
            'hero_x_link' => 'https://x.com',
            'hero_linkedin_link' => 'https://linkedin.com',
            'hero_youtube_link' => 'https://youtube.com',
            'hero_vertical_text' => 'Saleh Al-Ghafis REV.Co.',

            // About Sectino
            'about_small_top_title' => 'من نحن',
            'about_big_top_title' => '$$حقك ثمين...... وتقييمنا ينصفك$$',
            'about_main_title' => 'تعرف على $$فريقنا$$ الخبير ذو الخبرة لتقديم أفضل الحلول العقارية',
            'about_description' => 'تأسست شركة صالح علي الغفيص للتقييم والتثمين العقاري سنة 2015م بمنطقة القصيم بمدينة بريدة ويحمل سجل تجاري رقم )1131056566( ، ثم التوسع ليتم افتتاح مكتب الرياض سنة 2021م بسجل تجاري رقم )1010721458( وتغطي أعمال الشركة كافة مناطق المملكة .',
            'about_feat1_title' => 'تنمية.. وتطوير',
            'about_feat1_description' => 'المساهمة في تنمية الوطن، وتحقيق رؤية المملكة 2030م، والمشاركة في تطوير السوق العقارية.',
            'about_feat2_title' => 'تدريب.. وتأهيل',
            'about_feat2_description' => 'رفع كفاءة الشباب السعودي وتأهيلهم في المجال العقاري.',
            'about_feat3_title' => 'خدمات متكاملة',
            'about_feat3_description' => 'تقديم خدمات التقييم المتكاملة لعقارات الأفراد والشركات.',
            'about_button_text' => 'عرض المزيد من التقارير المعتمدة',
            'about_button_link' => '/about-us',

            // Our Services
            'services_small_top_title' => 'خدماتنا',
            'services_main_title' => 'استفد من خدماتنا العقارية المتميزة لدعم قراراتك الذكية',
            'services_description' => 'نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق المملكة.',
            'services_button_text' => 'عرض الكل',
            'services_button_link' => '/our-services',
            'services_stat1_number' => 31000000,
            'services_stat1_text' => 'قيمة الأصول العقارية',
            'services_stat2_number' => 20,
            'services_stat2_text' => 'عام خيرة',
            'services_stat3_number' => 100000,
            'services_stat3_text' => 'ساعات الخبرة',
            'services_events_small_top_title' => 'الأحداث والفعاليات',
            'services_events_main_title' => 'كن جزءاً من أحداثنا وفعالياتنا واستفد من فرص لا تفوت',
            'services_events_video_url' => 'https://youtu.be/ddG52erTf4A?si=AhWg47WSCFWc9YPA',
            'services_events_button_text' => 'عرض الكل',
            'services_events_button_link' => '/events',

            // Our Clients
            'clients_small_top_title' => 'عملاؤنا',
            'clients_main_title' => 'اسمتع إلى عملائنا كيف ساعدناهم في تحقيق $$أهدافهم العقارية$$ بنجاح واحترافية',
            'clients_description' => 'نحن فخورون بعملائنا الراضين الذين يشاركوننا تجاربهم الإيجابية. نؤمن أن أفضل دليل على جودة خدماتنا هو رضا عملائنا وثقتهم بنا. اكتشف ما يقوله عملاؤنا عن الاستشارات العقارية التي نقدمها، وكيف ساعدناهم في تحقيق أهدافهم العقارية بطريقة سلسة وموثوقة. انضم إلى مجموعة عملائنا السعداء وكن جزءًا من رحلتنا المتميزة',
            'clients_button_text' => 'عرض الكل',
            'clients_button_link' => '/our-clients',

            // Contact Us
            'contact_us_small_top_title' => 'تواصل معنا',
            'contact_us_main_title' => 'نحن هنا $$لمساعدتك$$ تواصل معنا الآن',
            'contact_us_form_title' => 'املأ بيانات النموذج بالأسفل',
            'contact_us_form_description' => 'قم بملء المعلومات في النموذج أدناه وسنتصل بك في أقرب وقت ممكن',
        ]);
    }
}