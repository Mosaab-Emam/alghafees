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
        Schema::create('about_us_static_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Adding columns based on the fillable properties without nullable()
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('about_top_title');
            $table->string('about_first_title');
            $table->text('about_first_description');
            $table->string('about_second_title');
            $table->text('about_second_description');
            $table->string('management_title');
            $table->text('management_description');
            $table->string('feat1_title');
            $table->text('feat1_description');
            $table->string('feat2_title');
            $table->text('feat2_description');
            $table->string('feat3_title');
            $table->text('feat3_description');
            $table->string('values_title');
            $table->string('vision_title');
            $table->text('vision_description');
            $table->string('message_title');
            $table->text('message_description');
            $table->string('reports_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_static_contents');
    }
};
