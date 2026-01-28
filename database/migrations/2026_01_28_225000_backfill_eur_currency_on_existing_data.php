<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Backfill EUR on transactions without currency
        DB::table('transactions')
            ->whereNull('currency')
            ->orWhere('currency', '')
            ->update(['currency' => 'EUR']);

        // Backfill EUR on mission_offers without currency
        DB::table('mission_offers')
            ->whereNull('currency')
            ->orWhere('currency', '')
            ->update(['currency' => 'EUR']);

        // Backfill EUR on affiliate_commissions without currency
        DB::table('affiliate_commissions')
            ->whereNull('currency')
            ->orWhere('currency', '')
            ->update(['currency' => 'EUR']);

        // Backfill EUR on users without preferred_currency
        DB::table('users')
            ->whereNull('preferred_currency')
            ->orWhere('preferred_currency', '')
            ->update(['preferred_currency' => 'EUR']);

        // Backfill EUR on missions without budget_currency
        DB::table('missions')
            ->whereNull('budget_currency')
            ->orWhere('budget_currency', '')
            ->update(['budget_currency' => 'EUR']);
    }

    public function down()
    {
        // Ne rien faire en rollback - les données restent avec EUR
    }
};
