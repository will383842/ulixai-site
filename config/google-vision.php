<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Vision API Configuration
    |--------------------------------------------------------------------------
    */

    'enabled' => env('GOOGLE_VISION_ENABLED', false),
    
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID'),
    
    // ✅ FIXED: Direct absolute path to credentials
    'credentials_path' => storage_path('app/google/vision-credentials.json'),
    
    /*
    |--------------------------------------------------------------------------
    | Document Types
    |--------------------------------------------------------------------------
    */
    'document_types' => [
        'passport',
        'license',
        'european_id'
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Confidence Thresholds
    |--------------------------------------------------------------------------
    */
    'confidence_threshold' => [
        'document' => 70,
        'face' => 80,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    */
    'max_retries' => 3,
    'retry_delay' => 5,
    
    /*
    |--------------------------------------------------------------------------
    | Storage Paths
    |--------------------------------------------------------------------------
    */
    'storage' => [
        'documents' => [
            'pending' => 'documents/pending',
            'verified' => 'documents/verified',
            'rejected' => 'documents/rejected',
        ],
        'profile_photos' => [
            'pending' => 'profile-photos/pending',
            'verified' => 'profile-photos/verified',
            'rejected' => 'profile-photos/rejected',
        ],
    ],
];