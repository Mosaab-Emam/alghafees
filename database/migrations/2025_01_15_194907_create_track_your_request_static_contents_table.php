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
        Schema::create('track_your_request_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('title');
            $table->text('description');
            $table->string('search_placeholder');
            $table->string('btn_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_your_request_static_contents');
    }
};
