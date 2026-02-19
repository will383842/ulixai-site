<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Fix banking column names to match model expectations.
 *
 * Original migration (2025_11_20_000002) created:
 *   bank_account_name, bank_account_number, bank_branch, bank_swift, bank_iban
 *
 * But User model, AccountController, and UpdateBankingDetailsRequest expect:
 *   bank_account_holder, bank_account_iban, bank_swift_bic, account_country, bank_details_verified_at
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename mismatched columns
            $table->renameColumn('bank_account_name', 'bank_account_holder');
            $table->renameColumn('bank_iban', 'bank_account_iban');
            $table->renameColumn('bank_swift', 'bank_swift_bic');

            // Drop unused columns (not referenced anywhere in the codebase)
            $table->dropColumn(['bank_account_number', 'bank_branch']);

            // Add missing columns
            $table->string('account_country')->nullable()->after('bank_name');
            $table->timestamp('bank_details_verified_at')->nullable()->after('account_country');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse renames
            $table->renameColumn('bank_account_holder', 'bank_account_name');
            $table->renameColumn('bank_account_iban', 'bank_iban');
            $table->renameColumn('bank_swift_bic', 'bank_swift');

            // Re-add dropped columns
            $table->string('bank_account_number')->nullable()->after('bank_account_name');
            $table->string('bank_branch')->nullable()->after('bank_name');

            // Drop added columns
            $table->dropColumn(['account_country', 'bank_details_verified_at']);
        });
    }
};
