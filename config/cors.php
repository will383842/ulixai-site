<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    |
    | Production domains are hardcoded for security. Additional origins can be
    | added via CORS_ALLOWED_ORIGINS environment variable (comma-separated).
    | Example: CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:8080
    |
    */
    'allowed_origins' => array_filter(array_merge(
        [
            'https://ulixai.com',
            'https://www.ulixai.com',
            env('APP_URL'),
        ],
        // Additional origins from environment (for development)
        array_map('trim', explode(',', env('CORS_ALLOWED_ORIGINS', '')))
    )),

    'allowed_origins_patterns' => env('APP_ENV') === 'local' ? [
        '#^https?://localhost(:\d+)?$#',  // Dev local
        '#^https?://127\.0\.0\.1(:\d+)?$#',  // Dev local
    ] : [],

    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept', 'X-CSRF-TOKEN'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
