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
    Schema::create('our_clients_static_contents', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      $table->string('small_top_title');
      $table->string('main_top_title');
      $table->string('main_title');
      $table->text('main_description');
      $table->string('clients_title');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('our_clients_static_contents');
  }
};