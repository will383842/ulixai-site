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
        Schema::create('affiliate_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referrer_id');
            $table->unsignedBigInteger('referee_id');
            $table->unsignedBigInteger('mission_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'available', 'paid'])->default('pending');
            $table->string('payout_method')->nullable();
            $table->string('stripe_transfer_id')->nullable();
            $table->timestamps();

            $table->foreign('referrer_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('referee_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('mission_id')->references('id')->on('missions')->nullOnDelete();

            $table->index(['referrer_id', 'referee_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_commissions');
    }
};
