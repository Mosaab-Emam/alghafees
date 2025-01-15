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
        Schema::create('contact_us_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('form_title');
            $table->text('form_description');
            $table->string('title');
            $table->string('box_title');
            $table->string('phone');
            $table->string('email');
            $table->string('cta_text');
            $table->string('cta_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_static_contents');
    }
};
