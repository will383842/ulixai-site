<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('provider_document_verifications')) {
            Schema::table('provider_document_verifications', function (Blueprint $table) {
                if (!Schema::hasColumn('provider_document_verifications', 'session_id')) {
                    $table->string('session_id', 255)->nullable()->after('user_id')->index();
                }
            });
            DB::statement('ALTER TABLE `provider_document_verifications` MODIFY `user_id` BIGINT UNSIGNED NULL');
        }

        if (!Schema::hasTable('provider_photo_verifications')) {
            Schema::create('provider_photo_verifications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
                $table->string('session_id', 255)->nullable()->index();
                $table->string('image_path');
                $table->enum('status', ['pending', 'processing', 'verified', 'rejected', 'error'])->default('pending');
                $table->integer('confidence_score')->nullable();
                $table->text('rejection_reason')->nullable();
                $table->json('google_vision_response')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();
                $table->index(['user_id', 'status']);
            });
        } else {
            Schema::table('provider_photo_verifications', function (Blueprint $table) {
                if (!Schema::hasColumn('provider_photo_verifications', 'session_id')) {
                    $table->string('session_id', 255)->nullable()->after('user_id')->index();
                }
            });
            DB::statement('ALTER TABLE `provider_photo_verifications` MODIFY `user_id` BIGINT UNSIGNED NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('provider_document_verifications') && Schema::hasColumn('provider_document_verifications', 'session_id')) {
            Schema::table('provider_document_verifications', function (Blueprint $table) {
                $table->dropIndex(['session_id']);
                $table->dropColumn('session_id');
            });
        }

        if (Schema::hasTable('provider_photo_verifications') && Schema::hasColumn('provider_photo_verifications', 'session_id')) {
            Schema::table('provider_photo_verifications', function (Blueprint $table) {
                $table->dropIndex(['session_id']);
                $table->dropColumn('session_id');
            });
        }
    }
};