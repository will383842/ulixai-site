<?php

return [
    'default' => env('DEFAULT_CURRENCY', 'EUR'),

    'supported' => ['EUR', 'USD'],

    'symbols' => [
        'EUR' => '€',
        'USD' => '$',
    ],

    'decimals' => [
        'EUR' => 2,
        'USD' => 2,
    ],

    'symbol_before' => ['USD'], // Devises avec symbole avant le montant

    'exchange_rate_api' => [
        'provider' => env('EXCHANGE_RATE_PROVIDER', 'exchangerate-api'),
        'key' => env('EXCHANGERATE_API_KEY'),
        'cache_ttl' => 3600, // 1 heure
    ],

    'minimum_withdrawal' => [
        'EUR' => 30,
        'USD' => 35,
    ],

    /*
    |--------------------------------------------------------------------------
    | Minimum Service Fee
    |--------------------------------------------------------------------------
    |
    | The minimum service fee charged to providers per transaction.
    | If the calculated commission (provider_fee * amount) is less than this
    | minimum, the minimum fee will be applied instead.
    |
    */
    'minimum_service_fee' => [
        'EUR' => 10,
        'USD' => 12,
    ],
];
