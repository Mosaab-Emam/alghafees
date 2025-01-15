<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JoinUsStaticContent;

class JoinUsStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JoinUsStaticContent::create([
            'small_top_title' => 'انضم إلينا',
            'main_top_title' => 'شاركنا النجاح',
            'form_title' => 'فرصتك للانضمام إلينا تبدأ هنا.....',
            'form_description' => 'املء بيانات التسجيل بالاسفل لتنضم الينا',
            'form_btn_text' => 'تسجيل',
            'title' => 'انضم إلى $$فريقنا$$ المتميز وساهم في تحقيق نجاحات جديدة',
            'description' => 'نبحث عن أفراد طموحين ومبدعين للانضمام إلى فريقنا.إذا كنت مستعدًا لتحديات جديدة وترغب في المساهمة في نجاحاتنا، نرحب بك لتكون جزءًا من عائلتنا المهنية.',
        ]);
    }
}
