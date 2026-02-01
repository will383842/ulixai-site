<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * SECURITY: Add attempts tracking for OTP verification.
 *
 * This prevents brute-force attacks on OTP codes by:
 * 1. Tracking failed attempts
 * 2. Locking out after max attempts (5)
 * 3. Recording lockout timestamp
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_verifications', function (Blueprint $table) {
            // Track verification attempts to prevent brute-force
            $table->unsignedTinyInteger('attempts')->default(0)->after('is_verified');

            // Lock verification after too many failed attempts
            $table->timestamp('locked_until')->nullable()->after('attempts');

            // Index for faster lookups
            $table->index(['email', 'is_verified']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_verifications', function (Blueprint $table) {
            $table->dropIndex(['email', 'is_verified']);
            $table->dropColumn(['attempts', 'locked_until']);
        });
    }
};
