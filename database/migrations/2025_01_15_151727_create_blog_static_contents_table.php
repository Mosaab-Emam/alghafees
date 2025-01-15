<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogStaticContentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('title');
            $table->text('description');
            $table->string('blog_small_title');
            $table->string('blog_main_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_static_contents');
    }
}