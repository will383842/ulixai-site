<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Api\ModerationApiController;

/*
|--------------------------------------------------------------------------
| Moderation Routes
|--------------------------------------------------------------------------
|
| Routes pour le système de modération
| - Routes admin pour le back-office
| - Routes API pour les interactions frontend
|
*/

// ============================================================
// ROUTES API (Frontend)
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

// ============================================================
// ROUTES ADMIN (Back-office)
// ============================================================

Route::middleware(['auth', 'admin'])->prefix('admin/moderation')->name('admin.moderation.')->group(function () {
    // Dashboard
    Route::get('/', [ModerationController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [ModerationController::class, 'statistics'])->name('statistics');

    // Flags (contenus à réviser)
    Route::prefix('flags')->name('flags.')->group(function () {
        Route::get('/', [ModerationController::class, 'pendingFlags'])->name('index');
        Route::get('/{flag}', [ModerationController::class, 'showFlag'])->name('show');
        Route::post('/{flag}/approve', [ModerationController::class, 'approveFlag'])->name('approve');
        Route::post('/{flag}/reject', [ModerationController::class, 'rejectFlag'])->name('reject');
    });

    // Signalements
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ModerationController::class, 'pendingReports'])->name('index');
        Route::post('/{report}/process', [ModerationController::class, 'processReport'])->name('process');
    });

    // Appels
    Route::prefix('appeals')->name('appeals.')->group(function () {
        Route::get('/', [ModerationController::class, 'pendingAppeals'])->name('index');
        Route::get('/{appeal}', [ModerationController::class, 'showAppeal'])->name('show');
        Route::post('/{appeal}/process', [ModerationController::class, 'processAppeal'])->name('process');
    });

    // Gestion des utilisateurs
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}/history', [ModerationController::class, 'userHistory'])->name('history');
        Route::post('/{user}/strike', [ModerationController::class, 'issueStrike'])->name('strike');
        Route::post('/{user}/warn', [ModerationController::class, 'warnUser'])->name('warn');
        Route::post('/{user}/ban', [ModerationController::class, 'banUser'])->name('ban');
        Route::post('/{user}/unban', [ModerationController::class, 'unbanUser'])->name('unban');
        Route::post('/{user}/suspend', [ModerationController::class, 'suspendUser'])->name('suspend');
    });

    // Strikes
    Route::delete('/strikes/{strike}', [ModerationController::class, 'removeStrike'])->name('strikes.remove');

    // Mots interdits
    Route::prefix('words')->name('words.')->group(function () {
        Route::get('/', [ModerationController::class, 'bannedWords'])->name('index');
        Route::post('/', [ModerationController::class, 'addBannedWord'])->name('store');
        Route::put('/{word}', [ModerationController::class, 'updateBannedWord'])->name('update');
        Route::delete('/{word}', [ModerationController::class, 'deleteBannedWord'])->name('destroy');
    });
});
