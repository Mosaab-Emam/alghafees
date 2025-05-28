<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PricingStaticContent;

class PricingStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PricingStaticContent::create([
            'small_top_title' => 'الأسعار',
            'main_top_title' => 'أسعار التقييم العقاري',
            'hero_title' => 'أسعار خدمة التقييم العقاري',
            'hero_description' => 'نُقدّم تقييمًا دقيقًا ومعتمدًا لجميع أنواع العقارات في مختلف مدن المملكة، سواء بغرض البيع أو الشراء أو أي إجراء رسمي آخر.',
            'hero_image' => '',
            'hero_goals_title' => 'أغراض التقييم العقاري',
            'hero_goals' => [
                ['title' => "التقييم لغرض البيع أو الشراء"],
                ['title' => "التقييم لغرض الرهن والتمويل"],
                ['title' => "التقييم للأغراض المحاسبية"],
                ['title' => "التقييم للأغراض التجارية"],
            ],
            'payment_title' => 'خدماتنا صارت أسهل...ادفع على دفعات',
            'payment_description' => 'فعّلنا لك الدفع عبر $$تمارا$$ — اختَر خدمتك وادفع على راحتك بأقساط شهرية سهلة، بدون فوائد أو تعقيد.',
            'contact_description' => 'اذا كنت ترغب في تقييم عقار لاغراض اخرى تواصل معنا من جميع انحاء المملكة على الرقم : 0539455519',
            'packages_title' => 'أسعار خدمات التقييم العقاري',
            'packages_description' => 'نقدم لكم اسعار التقييم العقاري للاغراض التالية ( التقييم لغرض البيع و الشراء - التقييم لغرض الرهن و التمويل - التقييم لاغراض المحاسبية - التقييم للاغراض التجارية )',
            'banner_title' => 'هل لديك مجموعة عقارات؟',
            'banner_subtitle' => 'اطلب عرض سعر مخصص',
            'banner_description' => 'إذا كنت تملك أكثر من عقار وتحتاج إلى تقييم جماعي أو عرض خاص لخدمة معينة، نحن نوفر لك عرض سعر مخصص بناء على حالتك.',
            'banner_button_text' => 'اطلب عرض سعر',
        ]);
    }
}
