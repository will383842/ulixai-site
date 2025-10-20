<?php

return [
    'fees' => [
        'client' => env('ULIXAI_CLIENT_FEE', 5),      
        'provider' => env('ULIXAI_PROVIDER_FEE', 15), 
        'affiliate' => env('ULIXAI_AFFILIATE_FEE', 30),
    ],
];
