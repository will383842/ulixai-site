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
        Schema::create('provider_document_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Document info
            $table->enum('document_type', ['passport', 'license', 'european_id']);
            $table->enum('document_side', ['front', 'back'])->nullable();
            $table->string('image_path');
            
            // Verification status
            $table->enum('verification_status', ['pending', 'processing', 'verified', 'rejected', 'error'])
                  ->default('pending');
            
            // Google Vision results
            $table->integer('confidence_score')->nullable();
            $table->text('detected_text')->nullable();
            $table->json('detected_labels')->nullable();
            $table->json('google_response')->nullable();
            
            // Rejection/Error handling
            $table->text('rejection_reason')->nullable();
            $table->integer('retry_count')->default(0);
            
            // Timestamps
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'document_type']);
            $table->index('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_document_verifications');
    }
};