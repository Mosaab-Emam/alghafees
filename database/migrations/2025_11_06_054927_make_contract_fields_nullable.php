<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedFloat('area')->nullable()->change();
            $table->string('deed_number')->nullable()->change();
            $table->date('deed_issue_date')->nullable()->change();
            $table->unsignedInteger('number_of_assets')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedFloat('area')->nullable(false)->change();
            $table->string('deed_number')->nullable(false)->change();
            $table->date('deed_issue_date')->nullable(false)->change();
            $table->unsignedInteger('number_of_assets')->nullable(false)->change();
        });
    }
};
