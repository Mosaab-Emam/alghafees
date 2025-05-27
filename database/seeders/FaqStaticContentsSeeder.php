<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FaqStaticContents;

class FaqStaticContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaqStaticContents::create([
            'small_top_title' => 'الأسئلة الشائعة',
            'main_top_title' => 'الأسئلة الشائعة',
            'content' => 'الأسئلة الشائعة',
        ]);
    }
}
