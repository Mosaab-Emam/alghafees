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
            'small_top_title' => '',
            'main_top_title' => '',
            'main_title' => '',
            'main_description' => '',
            'services_title' => '',
            // Placeholder for services and their subitems can be added here
        ]);
    }
}
