<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('name');
            $table->string('native_name');
            $table->enum('direction', ['ltr', 'rtl'])->default('ltr');
            $table->string('date_format')->default('Y-m-d');
            $table->string('time_format')->default('H:i');
            $table->string('datetime_format')->default('Y-m-d H:i');
            $table->string('decimal_separator', 2)->default('.');
            $table->string('thousands_separator', 2)->default(',');
            $table->string('currency_code', 3)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->string('fallback_locale', 5)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('is_default');
        });
        
        // Insertion des 9 langues avec TOUTES les colonnes
        DB::table('locales')->insert([
            [
                'code' => 'en',
                'name' => 'English',
                'native_name' => 'English',
                'direction' => 'ltr',
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i',
                'datetime_format' => 'Y-m-d H:i',
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'currency_code' => 'USD',
                'is_active' => true,
                'is_default' => true,
                'fallback_locale' => null,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'fr',
                'name' => 'French',
                'native_name' => 'Français',
                'direction' => 'ltr',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'decimal_separator' => ',',
                'thousands_separator' => ' ',
                'currency_code' => 'EUR',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'de',
                'name' => 'German',
                'native_name' => 'Deutsch',
                'direction' => 'ltr',
                'date_format' => 'd.m.Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd.m.Y H:i',
                'decimal_separator' => ',',
                'thousands_separator' => '.',
                'currency_code' => 'EUR',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'es',
                'name' => 'Spanish',
                'native_name' => 'Español',
                'direction' => 'ltr',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'decimal_separator' => ',',
                'thousands_separator' => '.',
                'currency_code' => 'EUR',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'pt',
                'name' => 'Portuguese',
                'native_name' => 'Português',
                'direction' => 'ltr',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'decimal_separator' => ',',
                'thousands_separator' => '.',
                'currency_code' => 'EUR',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'ru',
                'name' => 'Russian',
                'native_name' => 'Русский',
                'direction' => 'ltr',
                'date_format' => 'd.m.Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd.m.Y H:i',
                'decimal_separator' => ',',
                'thousands_separator' => ' ',
                'currency_code' => 'RUB',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'zh',
                'name' => 'Chinese',
                'native_name' => '中文',
                'direction' => 'ltr',
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i',
                'datetime_format' => 'Y-m-d H:i',
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'currency_code' => 'CNY',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'ar',
                'name' => 'Arabic',
                'native_name' => 'العربية',
                'direction' => 'rtl',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'currency_code' => 'AED',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'hi',
                'name' => 'Hindi',
                'native_name' => 'हिन्दी',
                'direction' => 'ltr',
                'date_format' => 'd/m/Y',
                'time_format' => 'H:i',
                'datetime_format' => 'd/m/Y H:i',
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'currency_code' => 'INR',
                'is_active' => true,
                'is_default' => false,
                'fallback_locale' => 'en',
                'sort_order' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
    
    public function down(): void
    {
        Schema::dropIfExists('locales');
    }
};
