<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('transactions')) {
            return;
        }

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mission_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('offer_id');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('client_fee', 10, 2);
            $table->decimal('provider_fee', 10, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('user_role')->nullable();
            $table->enum('status', [
                'pending_payment',
                'paid',
                'released',
                'refunded',
                'dispute_pending',
            ])->default('pending_payment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
