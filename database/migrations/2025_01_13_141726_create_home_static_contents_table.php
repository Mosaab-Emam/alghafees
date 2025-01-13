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
            $table->string('hero_small_top_title');
            $table->string('hero_main_title');
            $table->string('hero_image');
            $table->string('description');
            $table->string('hero_main_button_text');
            $table->string('hero_main_button_link');
            $table->string('hero_secondary_button_text');
            $table->string('hero_secondary_button_link');
            $table->string('hero_download_box_text');
            $table->string('hero_x_link');
            $table->string('hero_linkedin_link');
            $table->string('hero_youtube_link');
            $table->string('hero_vertical_text');
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
