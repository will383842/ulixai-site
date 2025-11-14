<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('mission_offers')->onDelete('cascade');
            $table->string('stripe_session_id')->nullable()->change();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('client_fee', 10, 2);
            $table->decimal('provider_fee', 10, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('user_role')->nullable();
            $table->enum('status', ['pending_payment', 'paid', 'released', 'refunded', 'dispute_pending'])->default('pending_payment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}
