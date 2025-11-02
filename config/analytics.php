<?php

return [
    'ga4' => [
        'property_id' => env('GA4_PROPERTY_ID'),
        'measurement_id' => env('GA4_MEASUREMENT_ID'),
        'api_secret' => env('GA4_API_SECRET'),
        // GA4 Data API (service account) — une des deux options suffit
        'service_account_json' => env('GA4_SERVICE_ACCOUNT_JSON'),
        'service_account_json_path' => env('GA4_SERVICE_ACCOUNT_JSON_PATH'),
    ],
];
