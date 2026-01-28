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
];
