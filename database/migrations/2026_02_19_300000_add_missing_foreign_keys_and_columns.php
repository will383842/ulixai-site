<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fix #34: FK manquante missions.subsubcategory_id → categories
     * Fix #35: FK manquante provider_reviews.mission_id → missions
     * Fix #36: Payout statut 'processing' + initiated_at
     * Fix #37: Transaction.refunded_at colonne manquante
     */
    public function up(): void
    {
        // Fix #34 — FK on missions.subsubcategory_id
        Schema::table('missions', function (Blueprint $table) {
            if (Schema::hasColumn('missions', 'subsubcategory_id')) {
                $table->foreign('subsubcategory_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('set null');
            }
        });

        // Fix #35 — FK on provider_reviews.mission_id
        Schema::table('provider_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('provider_reviews', 'mission_id')) {
                $table->foreign('mission_id')
                    ->references('id')
                    ->on('missions')
                    ->onDelete('set null');
            }
        });

        // Fix #37 — Add refunded_at to transactions
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'refunded_at')) {
                $table->timestamp('refunded_at')->nullable()->after('released_at');
            }
        });

        // Fix #36 — Add initiated_at to payouts for 'processing' tracking
        Schema::table('payouts', function (Blueprint $table) {
            if (!Schema::hasColumn('payouts', 'initiated_at')) {
                $table->timestamp('initiated_at')->nullable()->after('paid_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            if (Schema::hasColumn('missions', 'subsubcategory_id')) {
                $table->dropForeign(['subsubcategory_id']);
            }
        });

        Schema::table('provider_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('provider_reviews', 'mission_id')) {
                $table->dropForeign(['mission_id']);
            }
        });

        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'refunded_at')) {
                $table->dropColumn('refunded_at');
            }
        });

        Schema::table('payouts', function (Blueprint $table) {
            if (Schema::hasColumn('payouts', 'initiated_at')) {
                $table->dropColumn('initiated_at');
            }
        });
    }
};
