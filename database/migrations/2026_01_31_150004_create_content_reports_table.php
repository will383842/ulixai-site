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
        Schema::create('content_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users')->onDelete('cascade');
            $table->morphs('reportable'); // reportable_type, reportable_id
            $table->foreignId('reported_user_id')->constrained('users');
            $table->enum('reason', [
                'inappropriate_content',
                'spam',
                'harassment',
                'contact_info',
                'scam',
                'fake_profile',
                'hate_speech',
                'illegal_content',
                'other'
            ]);
            $table->text('description')->nullable();
            $table->json('screenshots')->nullable(); // Chemins des captures d'écran
            $table->enum('status', ['pending', 'investigating', 'resolved', 'dismissed'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->foreignId('resolved_by')->nullable()->constrained('users');
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->enum('action_taken', [
                'no_action',
                'content_removed',
                'user_warned',
                'user_suspended',
                'user_banned'
            ])->nullable();
            $table->timestamps();

            $table->index(['status', 'priority']);
            $table->index('reporter_id');
            $table->index('reported_user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_reports');
    }
};
