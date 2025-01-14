<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_static_contents', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('hero_small_top_title');
            $table->string('hero_main_title');
            $table->string('hero_description');
            $table->string('hero_main_button_text');
            $table->string('hero_main_button_link');
            $table->string('hero_secondary_button_text');
            $table->string('hero_secondary_button_link');
            $table->string('hero_download_box_text');
            $table->string('hero_x_link');
            $table->string('hero_linkedin_link');
            $table->string('hero_youtube_link');
            $table->string('hero_vertical_text');

            // About Section
            $table->string('about_small_top_title');
            $table->string('about_big_top_title');
            $table->string('about_main_title');
            $table->string('about_description');
            $table->string('about_feat1_title');
            $table->string('about_feat1_description');
            $table->string('about_feat2_title');
            $table->string('about_feat2_description');
            $table->string('about_feat3_title');
            $table->string('about_feat3_description');
            $table->string('about_button_text');
            $table->string('about_button_link');

            // Our Services
            $table->string('services_small_top_title');
            $table->string('services_main_title');
            $table->string('services_description');
            $table->string('services_button_text');
            $table->string('services_button_link');
            $table->unsignedBigInteger('services_stat1_number');
            $table->string('services_stat1_text');
            $table->unsignedBigInteger('services_stat2_number');
            $table->string('services_stat2_text');
            $table->unsignedBigInteger('services_stat3_number');
            $table->string('services_stat3_text');
            $table->string('services_events_small_top_title');
            $table->string('services_events_main_title');
            $table->string('services_events_video_url');
            $table->string('services_events_button_text');
            $table->string('services_events_button_link');

            // Our Clients
            $table->string('clients_small_top_title');
            $table->string('clients_main_title');
            $table->string('clients_description');
            $table->string('clients_button_text');
            $table->string('clients_button_link');

            // Contact Us
            $table->string('contact_us_small_top_title');
            $table->string('contact_us_main_title');
            $table->string('contact_us_form_title');
            $table->string('contact_us_form_description');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_static_contents');
    }
};
