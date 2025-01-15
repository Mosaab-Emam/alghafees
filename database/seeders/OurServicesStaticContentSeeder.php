<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OurServicesStaticContent;

class OurServicesStaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurServicesStaticContent::create([
            'small_top_title' => 'خدماتنا',
            'main_top_title' => 'حلول عقارية',
            'main_title' => 'استفد من $$خدماتنا العقارية$$ المتميزة لدعم قراراتك الذكية',
            'main_description' => 'نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق المملكة.',
            'services_title' => 'خدماتنا العقارية',
            // Placeholder for services and their subitems can be added here
        ]);
    }
}
