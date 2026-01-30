<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ajoute le champ paypal_email pour les payouts PayPal aux prestataires.
     */
    public function up(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            // Email PayPal pour recevoir les payouts
            // Si null, on utilisera l'email du compte utilisateur
            $table->string('paypal_email')->nullable()->after('stripe_account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            $table->dropColumn('paypal_email');
        });
    }
};
