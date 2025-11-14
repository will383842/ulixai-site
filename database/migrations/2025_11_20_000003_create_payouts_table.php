<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('EUR');
            $table->enum('method', ['bank', 'paypal', 'stripe']);
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled']);
            $table->string('transaction_id')->nullable();
            $table->json('payment_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index(['provider_id', 'status']);
            $table->index('status');
            $table->index('processed_at');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
