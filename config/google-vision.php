<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Vision API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Google Cloud Vision API used for document verification
    | and profile photo validation during provider registration.
    |
    */

    'enabled' => env('GOOGLE_VISION_ENABLED', false),
    
    'project_id' => env('GOOGLE_CLOUD_PROJECT_ID'),
    
    'credentials_path' => storage_path(env('GOOGLE_VISION_CREDENTIALS_PATH', 'app/google/vision-credentials.json')),
    
    /*
    |--------------------------------------------------------------------------
    | Document Types
    |--------------------------------------------------------------------------
    |
    | Supported identity document types for verification
    |
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
    |
    | Minimum confidence scores required for acceptance
    |
    */
    'confidence_threshold' => [
        'document' => 70, // Minimum score to accept document
        'face' => 80,     // Minimum score for face detection
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Settings for automatic retry on failure
    |
    */
    'max_retries' => 3,
    'retry_delay' => 5, // seconds between retries
    
    /*
    |--------------------------------------------------------------------------
    | Storage Paths
    |--------------------------------------------------------------------------
    |
    | Paths for storing document images
    |
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