<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('name');
            $table->string('symbol', 10);
            $table->enum('symbol_position', ['before', 'after'])->default('before');
            $table->unsignedTinyInteger('decimal_places')->default(2);
            $table->decimal('exchange_rate_to_eur', 20, 10)->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_crypto')->default(false);
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('code');
        });
        
        // Insérer les devises principales pour les 9 langues
        DB::table('currencies')->insert([
    ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€', 'symbol_position' => 'after', 'decimal_places' => 2, 'exchange_rate_to_eur' => 1, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.92, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'GBP', 'name' => 'British Pound', 'symbol' => '£', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 1.16, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'CHF', 'name' => 'Swiss Franc', 'symbol' => 'CHF', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.97, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'JPY', 'name' => 'Japanese Yen', 'symbol' => '¥', 'symbol_position' => 'before', 'decimal_places' => 0, 'exchange_rate_to_eur' => 0.0062, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'CNY', 'name' => 'Chinese Yuan', 'symbol' => '¥', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.13, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.011, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'BRL', 'name' => 'Brazilian Real', 'symbol' => 'R$', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.18, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'RUB', 'name' => 'Russian Ruble', 'symbol' => '₽', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.010, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'AED', 'name' => 'UAE Dirham', 'symbol' => 'د.إ', 'symbol_position' => 'after', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.25, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
    ['code' => 'THB', 'name' => 'Thai Baht', 'symbol' => '฿', 'symbol_position' => 'before', 'decimal_places' => 2, 'exchange_rate_to_eur' => 0.026, 'is_active' => true, 'is_crypto' => false, 'created_at' => now(), 'updated_at' => now()],
]);
    }
    
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
