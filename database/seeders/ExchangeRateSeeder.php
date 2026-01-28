<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExchangeRate;
use App\Models\Currency;

class ExchangeRateSeeder extends Seeder
{
    public function run()
    {
        // S'assurer que les devises existent
        Currency::firstOrCreate(['code' => 'EUR'], [
            'name' => 'Euro',
            'symbol' => '€',
            'is_active' => true,
        ]);

        Currency::firstOrCreate(['code' => 'USD'], [
            'name' => 'US Dollar',
            'symbol' => '$',
            'is_active' => true,
        ]);

        // Taux de change initiaux (à mettre à jour via API)
        ExchangeRate::updateOrCreate(
            ['from_currency' => 'EUR', 'to_currency' => 'USD'],
            [
                'rate' => 1.08,
                'source' => 'manual',
                'valid_from' => now(),
            ]
        );

        ExchangeRate::updateOrCreate(
            ['from_currency' => 'USD', 'to_currency' => 'EUR'],
            [
                'rate' => 0.93,
                'source' => 'manual',
                'valid_from' => now(),
            ]
        );
    }
}
