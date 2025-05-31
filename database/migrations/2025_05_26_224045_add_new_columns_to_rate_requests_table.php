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
        Schema::table('rate_requests', function (Blueprint $table) {
            $table->foreignId('price_package_id')->nullable()->constrained('price_packages');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('estate_city')->nullable();
            $table->string('estate_region')->nullable();
            $table->string('estate_line_1')->nullable();
            $table->string('estate_line_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rate_requests', function (Blueprint $table) {
            $table->dropColumn('price_package_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('estate_city');
            $table->dropColumn('estate_region');
            $table->dropColumn('estate_line_1');
            $table->dropColumn('estate_line_2');
        });
    }
};
