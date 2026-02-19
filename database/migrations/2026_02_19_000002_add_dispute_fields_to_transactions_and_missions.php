<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ajoute les colonnes de dispute sur transactions et étend les enums status
     * pour supporter les états de dispute Stripe.
     */
    public function up(): void
    {
        // ====================================================
        // 1. Étendre l'enum status de transactions
        // ====================================================
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM(
            'pending_payment',
            'paid',
            'released',
            'refunded',
            'dispute_pending',
            'disputed',
            'dispute_funds_withdrawn'
        ) NOT NULL DEFAULT 'pending_payment'");

        // ====================================================
        // 2. Ajouter les colonnes de dispute sur transactions
        // ====================================================
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('dispute_id')->nullable()->after('release_blocked_reason');
            $table->string('dispute_reason')->nullable()->after('dispute_id');
            $table->string('dispute_status', 50)->nullable()->after('dispute_reason');
            $table->timestamp('disputed_at')->nullable()->after('dispute_status');

            $table->index('dispute_id');
        });

        // ====================================================
        // 3. Étendre l'enum status de missions (ajoute 'refunded')
        // ====================================================
        DB::statement("ALTER TABLE missions MODIFY COLUMN status ENUM(
            'draft',
            'published',
            'waiting_to_start',
            'in_progress',
            'completed',
            'cancelled',
            'disputed',
            'refunded'
        ) NOT NULL DEFAULT 'published'");
    }

    public function down(): void
    {
        // Supprimer les colonnes dispute de transactions
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['dispute_id']);
            $table->dropColumn(['dispute_id', 'dispute_reason', 'dispute_status', 'disputed_at']);
        });

        // Restaurer l'enum status de transactions
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM(
            'pending_payment',
            'paid',
            'released',
            'refunded',
            'dispute_pending'
        ) NOT NULL DEFAULT 'pending_payment'");

        // Restaurer l'enum status de missions
        DB::statement("ALTER TABLE missions MODIFY COLUMN status ENUM(
            'draft',
            'published',
            'waiting_to_start',
            'in_progress',
            'completed',
            'cancelled',
            'disputed'
        ) NOT NULL DEFAULT 'published'");
    }
};
