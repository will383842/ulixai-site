<?php

return [
    'bing' => [
        'api_key'  => env('BING_WEBMASTER_API_KEY'),
        'site_url' => env('BING_SITE_URL'), // e.g. https://ulixai.com/
        'base_url' => env('BING_WEBMASTER_BASE_URL', 'https://ssl.bing.com/webmaster/api.svc/json/'),
        // Safety limits to avoid heavy requests
        'max_pages' => env('BING_MAX_PAGES', 5), // how many pages of GetLinkCounts to aggregate
        'timeout'   => env('BING_HTTP_TIMEOUT', 20),
    ],
    'openpagerank' => [
        'api_key'  => env('OPEN_PAGERANK_API_KEY'),
        'base_url' => env('OPEN_PAGERANK_BASE_URL', 'https://openpagerank.com/api/v1.0/'),
        'timeout'  => env('OPR_HTTP_TIMEOUT', 15),
    ],
];
