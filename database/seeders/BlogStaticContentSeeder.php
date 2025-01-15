<?php

namespace Database\Seeders;

use App\Models\BlogStaticContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogStaticContent::create([
            'small_top_title' => 'المدونة',
            'main_top_title' => 'نصائح عقارية',
            'title' => 'دليلك للعقارات: اكتشف، $$استثمر$$ ، وازدهر',
            'description' => 'وجهتك الشاملة لكل ما يتعلق بالعقارات. هنا، نقدم نصائح واستراتيجيات، ونستعرض أحدث اتجاهات السوق لمساعدتك في اتخاذ قرارات استثمارية ناجحة. انضم إلينا لاستكشاف الفرص وتحقيق أهدافك العقارية!',
            'blog_small_title' => 'التدوينات',
            'blog_main_title' => 'تابع معنا احدث $$التدوينات$$ العقارية',
        ]);
    }
}
