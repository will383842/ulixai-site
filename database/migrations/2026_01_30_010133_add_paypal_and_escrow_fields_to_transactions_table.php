<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ajoute le support multi-gateway (Stripe + PayPal) et améliore le système d'escrow.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // ============================================
            // MULTI-GATEWAY SUPPORT
            // ============================================

            // Passerelle de paiement utilisée ('stripe' ou 'paypal')
            $table->string('payment_gateway', 20)->default('stripe')->after('status');

            // PayPal Order ID (équivalent de stripe_payment_intent_id)
            $table->string('paypal_order_id')->nullable()->unique()->after('stripe_transfer_id');

            // PayPal Capture ID (après capture du paiement)
            $table->string('paypal_capture_id')->nullable()->after('paypal_order_id');

            // PayPal Payout Batch ID (pour le transfert au prestataire)
            $table->string('paypal_payout_batch_id')->nullable()->after('paypal_capture_id');

            // PayPal Payout Item ID (item spécifique dans le batch)
            $table->string('paypal_payout_item_id')->nullable()->after('paypal_payout_batch_id');

            // ============================================
            // ESCROW AMÉLIORÉ
            // ============================================

            // Timestamp de l'autorisation initiale (AUTHORIZE)
            $table->timestamp('authorized_at')->nullable()->after('paypal_payout_item_id');

            // Timestamp de la capture (CAPTURE) - fonds bloqués
            $table->timestamp('captured_at')->nullable()->after('authorized_at');

            // Date prévue de libération automatique (RELEASE)
            $table->timestamp('release_scheduled_at')->nullable()->after('captured_at');

            // Timestamp de libération effective
            $table->timestamp('released_at')->nullable()->after('release_scheduled_at');

            // Raison si libération bloquée ou retardée
            $table->string('release_blocked_reason')->nullable()->after('released_at');

            // ============================================
            // INDEX POUR PERFORMANCE
            // ============================================

            $table->index('payment_gateway');
            $table->index('release_scheduled_at');
            $table->index(['payment_gateway', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['payment_gateway']);
            $table->dropIndex(['release_scheduled_at']);
            $table->dropIndex(['payment_gateway', 'status']);

            // Drop columns
            $table->dropColumn([
                'payment_gateway',
                'paypal_order_id',
                'paypal_capture_id',
                'paypal_payout_batch_id',
                'paypal_payout_item_id',
                'authorized_at',
                'captured_at',
                'release_scheduled_at',
                'released_at',
                'release_blocked_reason',
            ]);
        });
    }
};
