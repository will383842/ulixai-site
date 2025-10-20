<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('affiliate_balance', 10, 2)->default(0)->after('referral_stats');
            $table->decimal('pending_affiliate_balance', 10, 2)->default(0)->after('affiliate_balance');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['affiliate_balance', 'pending_affiliate_balance']);
        });
    }

};
