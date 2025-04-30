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
        Schema::table('home_static_contents', function (Blueprint $table) {
            $table->dropColumn('hero_x_link');
            $table->dropColumn('hero_linkedin_link');
            $table->dropColumn('hero_youtube_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('create_home_static_contents', function (Blueprint $table) {
            $table->string('hero_x_link')->nullable();
            $table->string('hero_linkedin_link')->nullable();
            $table->string('hero_youtube_link')->nullable();
        });
    }
};
