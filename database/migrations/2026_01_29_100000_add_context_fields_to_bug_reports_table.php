<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bug_reports', function (Blueprint $table) {
            $table->string('page_url', 500)->nullable()->after('suggestions');
            $table->string('user_agent', 500)->nullable()->after('page_url');
            $table->string('screen_size', 50)->nullable()->after('user_agent');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium')->after('screen_size');
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'dismissed'])->default('pending')->after('priority');
            $table->enum('report_type', ['bug', 'suggestion', 'question', 'other'])->default('bug')->after('status');
            $table->timestamp('resolved_at')->nullable()->after('report_type');
            $table->unsignedBigInteger('resolved_by')->nullable()->after('resolved_at');
            $table->text('admin_notes')->nullable()->after('resolved_by');

            $table->index('status');
            $table->index('priority');
            $table->index('report_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('bug_reports', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['priority']);
            $table->dropIndex(['report_type']);
            $table->dropIndex(['created_at']);

            $table->dropColumn([
                'page_url',
                'user_agent',
                'screen_size',
                'priority',
                'status',
                'report_type',
                'resolved_at',
                'resolved_by',
                'admin_notes'
            ]);
        });
    }
};
