<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ✅ SÉCURITÉ: Ajoute un index unique sur stripe_payment_intent_id
     * pour garantir qu'aucun doublon de paiement ne puisse être créé
     * même en cas de race condition.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Ajouter un index unique sur stripe_payment_intent_id
            // Cela empêche les doublons au niveau de la base de données
            $table->unique('stripe_payment_intent_id', 'transactions_stripe_payment_intent_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropUnique('transactions_stripe_payment_intent_id_unique');
        });
    }
};
