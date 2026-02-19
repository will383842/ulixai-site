<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the press_inquiries table for the PressInquiry model.
 * Model existed without a corresponding migration.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('press_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('media_name');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->string('how_heard')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->text('internal_notes')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('press_inquiries');
    }
};
