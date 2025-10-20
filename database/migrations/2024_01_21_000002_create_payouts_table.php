<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('provider_id')->nullable()->constrained('service_providers')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('eur');
            $table->string('payout_type')->default('affiliate'); // affiliate, mission
            $table->string('stripe_transfer_id')->nullable();
            $table->string('stripe_payout_id')->nullable();
            $table->string('bank_account_last4')->nullable();
            $table->string('bank_account_type')->nullable(); // connected_account, external_account
            $table->string('status'); // processing, paid, failed, cancelled
            $table->text('failure_reason')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            // Indexes for faster queries
            $table->index(['user_id', 'status']);
            $table->index(['provider_id', 'status']);
            $table->index(['stripe_payout_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
