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
        Schema::create('moderation_flags', function (Blueprint $table) {
            $table->id();
            $table->morphs('flaggable'); // flaggable_type, flaggable_id (mission, message, offer)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Auteur du contenu (nullable car peut être anonyme)
            $table->string('flag_type', 50)->default('auto_review'); // Type: auto_blocked, auto_review, user_reported, etc.
            $table->enum('status', ['pending', 'approved', 'rejected', 'auto_rejected'])->default('pending');
            $table->enum('severity', ['critical', 'warning', 'info'])->default('warning');
            $table->string('reason', 500)->nullable(); // Raison textuelle du flag
            $table->integer('score')->default(0); // Score de risque 0-100
            $table->json('details')->nullable(); // Détails complets (remplace detected_issues + matched_words)
            $table->json('detected_issues')->nullable(); // Détails des problèmes détectés (legacy)
            $table->json('matched_words')->nullable(); // Mots qui ont matché (legacy)
            $table->boolean('has_contact_info')->default(false);
            $table->boolean('is_spam')->default(false);
            $table->text('original_content')->nullable(); // Contenu original pour référence
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'severity']);
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderation_flags');
    }
};
