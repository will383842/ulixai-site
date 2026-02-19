<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ModerationApiController;

/*
|--------------------------------------------------------------------------
| Moderation Routes
|--------------------------------------------------------------------------
|
| Routes API frontend pour le système de modération.
| Les routes admin back-office sont définies dans routes/web.php
| (préfixe 'admin/moderation', nom 'admin.moderation.*').
|
*/

// ============================================================
// ROUTES API (Frontend — auth:sanctum)
// ============================================================

Route::middleware(['auth:sanctum', 'throttle:60,1'])->prefix('api/moderation')->group(function () {
    // Vérification de publication
    Route::get('/can-publish', [ModerationApiController::class, 'canPublish']);
    Route::get('/publish-limits', [ModerationApiController::class, 'getPublishLimits']);

    // Pré-validation en temps réel
    Route::post('/quick-check', [ModerationApiController::class, 'quickCheck']);

    // Signalements
    Route::post('/report', [ModerationApiController::class, 'submitReport']);

    // Appels
    Route::get('/can-appeal', [ModerationApiController::class, 'canAppeal']);
    Route::post('/appeal', [ModerationApiController::class, 'submitAppeal']);

    // Statut utilisateur
    Route::get('/my-status', [ModerationApiController::class, 'getUserStatus']);
    Route::get('/my-strikes', [ModerationApiController::class, 'getMyStrikes']);
});
