<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RequestEvaluationStaticContentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            HomeStaticContentSeeder::class,
            AboutUsStaticContentSeeder::class,
            OurServicesStaticContentSeeder::class,
            OurClientsStaticContentSeeder::class,
            EventsStaticContentSeeder::class,
            RequestEvaluationStaticContentSeeder::class,
            // Other seeders can be added here
        ]);
    }
}
