<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestEvaluationStaticContentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_evaluation_static_contents', function (Blueprint $table) {
            $table->id();
            $table->string('small_top_title');
            $table->string('main_top_title');
            $table->string('evaluation_title');
            $table->text('evaluation_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_evaluation_static_contents');
    }
}