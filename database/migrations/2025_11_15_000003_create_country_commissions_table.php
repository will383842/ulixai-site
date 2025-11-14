<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('country_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->unique();
            $table->string('country_name');
            $table->string('region')->nullable();
            $table->decimal('platform_rate', 5, 2);
            $table->decimal('min_commission', 10, 2)->nullable();
            $table->decimal('max_commission', 10, 2)->nullable();
            $table->json('service_rates')->nullable();
            $table->decimal('vat_rate', 5, 2)->default(0);
            $table->boolean('vat_included')->default(false);
            $table->decimal('payment_processing_fee', 5, 2)->default(2.9);
            $table->boolean('is_active')->default(true);
            $table->date('effective_from');
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('region');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('country_commissions');
    }
};
