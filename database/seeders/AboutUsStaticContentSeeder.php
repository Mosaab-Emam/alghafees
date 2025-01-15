<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUsStaticContent;

class AboutUsStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUsStaticContent::create([
            'small_top_title' => '',
            'main_title' => '',
            'about_top_title' => '',
            'about_first_title' => '',
            'about_first_description' => '',
            'about_second_title' => '',
            'about_second_description' => '',
            'management_title' => '',
            'management_description' => '',
            'feat1_title' => '',
            'feat1_description' => '',
            'feat2_title' => '',
            'feat2_description' => '',
            'feat3_title' => '',
            'feat3_description' => '',
            'values_title' => '',
            'vision_title' => '',
            'vision_description' => '',
            'message_title' => '',
            'message_description' => '',
            'reports_title' => '',
        ]);
    }
}
