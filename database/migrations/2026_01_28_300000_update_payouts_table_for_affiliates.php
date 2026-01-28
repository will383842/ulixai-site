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
        Schema::table('payouts', function (Blueprint $table) {
            // Make provider_id nullable for affiliate payouts
            $table->unsignedBigInteger('provider_id')->nullable()->change();

            // Add user_id for affiliate payouts
            if (!Schema::hasColumn('payouts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            // Add payout_type to distinguish between provider and affiliate payouts
            if (!Schema::hasColumn('payouts', 'payout_type')) {
                $table->string('payout_type', 20)->default('provider')->after('currency');
            }

            // Add Stripe-specific columns
            if (!Schema::hasColumn('payouts', 'stripe_transfer_id')) {
                $table->string('stripe_transfer_id')->nullable()->after('payout_type');
            }
            if (!Schema::hasColumn('payouts', 'stripe_payout_id')) {
                $table->string('stripe_payout_id')->nullable()->after('stripe_transfer_id');
            }

            // Add bank account tracking
            if (!Schema::hasColumn('payouts', 'bank_account_last4')) {
                $table->string('bank_account_last4', 4)->nullable()->after('stripe_payout_id');
            }
            if (!Schema::hasColumn('payouts', 'bank_account_type')) {
                $table->string('bank_account_type', 50)->nullable()->after('bank_account_last4');
            }

            // Add failure reason
            if (!Schema::hasColumn('payouts', 'failure_reason')) {
                $table->text('failure_reason')->nullable()->after('status');
            }

            // Add paid_at timestamp
            if (!Schema::hasColumn('payouts', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('failure_reason');
            }
        });

        // Update existing status enum to include 'paid'
        // Note: This may require running a raw query depending on your database
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'payout_type',
                'stripe_transfer_id',
                'stripe_payout_id',
                'bank_account_last4',
                'bank_account_type',
                'failure_reason',
                'paid_at'
            ]);
        });
    }
};
