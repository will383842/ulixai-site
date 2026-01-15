<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\JobListController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\Admin\MissionAdminController;
use App\Http\Controllers\BugReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ═══════════════════════════════════════════════════════════
// 🌍 ROUTES PUBLIQUES (lecture seule, données non sensibles)
// ═══════════════════════════════════════════════════════════
Route::get('/categories', [CategoryController::class, 'fetchMainCategories']);
Route::get('/categories/{parentId}/subcategories', [CategoryController::class, 'fetchSubCategories']);
Route::get('/categories/{parentId}/children', [CategoryController::class, 'fetchChildCategories']);
Route::get('/providers/map', [MapController::class, 'getProviders']);
Route::get('/world-map', [UserManagementController::class, 'getProviders'])->name('w-map-view');

// Bug report (avec rate limiting pour éviter le spam)
Route::post('/report-bug', [BugReportController::class, 'store'])
    ->middleware('throttle:5,1'); // 5 rapports par minute max

// ═══════════════════════════════════════════════════════════
// 🔐 ROUTES AUTHENTIFIÉES (utilisateurs connectés)
// ═══════════════════════════════════════════════════════════
Route::middleware('auth:sanctum')->group(function () {
    // User info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Provider profile updates
    Route::post('/provider/save-categories', [ServiceProviderController::class, 'updateProviderCategories']);
    Route::post('/update-about-you', [ServiceProviderController::class, 'updateAboutYou']);

    // Service Provider Job Actions
    Route::post('/provider/jobs/start', [JobListController::class, 'startMission']);
    Route::post('/provider/jobs/resolve', [JobListController::class, 'resolveMission']);
    Route::post('/provider/jobs/confirm-delivery', [JobListController::class, 'confirmDelivery']);

    // Annulation d'offre par le prestataire
    Route::delete('/offers/{offer}/cancel', [JobListController::class, 'cancelOffer'])
        ->name('offers.cancel');

    // Cancel Mission (par client ou prestataire)
    Route::post('/mission/cancel', [ServiceRequestController::class, 'cancelMissionRequest']);
    Route::post('/mission/cancel/by-provider', [ServiceRequestController::class, 'providerCancelMisssion']);
});

// ═══════════════════════════════════════════════════════════
// 👑 ROUTES ADMIN (authentification admin requise)
// ═══════════════════════════════════════════════════════════
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    // Transactions
    Route::get('/transactions/filter', [TransactionController::class, 'filterTransactions']);
    Route::post('/transactions/{id}/refund', [TransactionController::class, 'refund'])->name('admin.transactions.refund');

    // Provider management
    Route::post('/provider/{id}/toggle-visibility', [UserManagementController::class, 'toggleProviderVisibility'])->name('admin.provider.toggle-visibility');
    Route::post('/provider/{id}/update-coords', [UserManagementController::class, 'updateProviderCoords'])->name('admin.provider.update-coords');
    Route::post('/provider/{id}/toggle-pin', [UserManagementController::class, 'toggleProviderPin'])->name('admin.provider.toggle-pin');

    // User/Provider profile editing
    Route::patch('/users/{id}/edit-profile', [UserManagementController::class, 'editUserProfile'])->name('admin.users.edit-profile');
    Route::patch('/providers/{id}/edit-profile', [UserManagementController::class, 'editProviderProfile'])->name('admin.providers.edit-profile');

    // Missions API
    Route::get('/missions', [MissionAdminController::class, 'apiList']);
    Route::get('/missions/{id}', [MissionAdminController::class, 'apiShow']);
});