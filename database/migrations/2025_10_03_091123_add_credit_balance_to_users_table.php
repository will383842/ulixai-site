<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Use DECIMAL for money in major units (e.g., EUR)
            if (!Schema::hasColumn('users', 'credit_balance')) {
                $table->decimal('credit_balance', 12, 2)
                      ->default(0)
                      ->after('pending_affiliate_balance'); 
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'credit_balance')) {
                $table->dropColumn('credit_balance');
            }
        });
    }
};
