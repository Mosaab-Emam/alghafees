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
        Schema::create('pricing_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('hero_title');
            $table->string('hero_image');
            $table->string('hero_description');
            $table->string('hero_goals_title');
            $table->json('hero_goals');
            $table->string('payment_title');
            $table->string('payment_description');
            $table->string('contact_description');
            $table->string('packages_title');
            $table->string('packages_description');
            $table->string('banner_title');
            $table->string('banner_subtitle');
            $table->string('banner_description');
            $table->string('banner_button_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_static_contents');
    }
};
