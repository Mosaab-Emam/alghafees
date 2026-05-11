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
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->foreignId('previewer_locked_by')->nullable()->after('approver_id')->constrained('users')->nullOnDelete();
            $table->foreignId('income_locked_by')->nullable()->after('previewer_locked_by')->constrained('users')->nullOnDelete();
            $table->foreignId('review_locked_by')->nullable()->after('income_locked_by')->constrained('users')->nullOnDelete();
            $table->foreignId('approver_locked_by')->nullable()->after('review_locked_by')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->dropForeign(['previewer_locked_by']);
            $table->dropForeign(['income_locked_by']);
            $table->dropForeign(['review_locked_by']);
            $table->dropForeign(['approver_locked_by']);
            $table->dropColumn([
                'previewer_locked_by',
                'income_locked_by',
                'review_locked_by',
                'approver_locked_by',
            ]);
        });
    }
};
