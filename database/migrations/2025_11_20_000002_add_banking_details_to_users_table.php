<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bank_account_name')->nullable()->after('password');
            $table->string('bank_account_number')->nullable()->after('bank_account_name');
            $table->string('bank_name')->nullable()->after('bank_account_number');
            $table->string('bank_branch')->nullable()->after('bank_name');
            $table->string('bank_swift')->nullable()->after('bank_branch');
            $table->string('bank_iban')->nullable()->after('bank_swift');
            $table->string('paypal_email')->nullable()->after('bank_iban');
            $table->string('stripe_account_id')->nullable()->after('paypal_email');
            $table->enum('preferred_payout_method', ['bank', 'paypal', 'stripe'])->nullable()->after('stripe_account_id');
            $table->decimal('pending_balance', 10, 2)->default(0)->after('preferred_payout_method');
            $table->decimal('available_balance', 10, 2)->default(0)->after('pending_balance');
            $table->timestamp('last_payout_at')->nullable()->after('available_balance');
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bank_account_name',
                'bank_account_number',
                'bank_name',
                'bank_branch',
                'bank_swift',
                'bank_iban',
                'paypal_email',
                'stripe_account_id',
                'preferred_payout_method',
                'pending_balance',
                'available_balance',
                'last_payout_at'
            ]);
        });
    }
};
