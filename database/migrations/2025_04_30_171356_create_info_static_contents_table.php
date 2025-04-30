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
        Schema::create('info_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('info_section_title');
            $table->string('work_hours');
            $table->string('email');
            $table->string('phone_number');
            $table->string('whatsapp_number');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('ios_app_link');
            $table->string('android_app_link');
            $table->string('x_link');
            $table->string('linkedin_link');
            $table->string('youtube_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_static_contents');
    }
};
