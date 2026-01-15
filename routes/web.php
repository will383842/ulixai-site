<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TermsAndConditionsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\JobListController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\MissionAdminController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\ExpatsLeaderboardController;
use App\Http\Controllers\Admin\RolesAndPermissionsController;
use App\Http\Controllers\Admin\FakeContentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManageCountries;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DisputeController;
use App\Http\Controllers\ProviderReviewController;
use App\Http\Controllers\MissionMessageController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\UlixaiReviewController;
use App\Http\Controllers\ServiceFeesController;
use App\Http\Controllers\PartnershipController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\RecruitApplicationController;
use App\Http\Controllers\PressController;

// ✅ Nouvel onglet Admin "Messages" (agrégateur)
use App\Http\Controllers\Admin\MessagesController;

// ✅ Google Vision API Controllers
use App\Http\Controllers\Api\ProviderDocumentVerificationController;
use App\Http\Controllers\Api\ProviderPhotoVerificationController;

// ═══════════════════════════════════════════════════════════
// 🎯 ROUTES PRIORITAIRES - NE PAS DÉPLACER
// ═══════════════════════════════════════════════════════════

// Doit rester en premier pour éviter le catch-all
Route::get('/provider/{slug}', [ServiceProviderController::class, 'providerProfile'])
    ->name('provider.profile');

// ═══════════════════════════════════════════════════════════
// 🔐 STRIPE WEBHOOK (AVANT TOUTES LES AUTRES ROUTES)
// ═══════════════════════════════════════════════════════════
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('stripe.webhook');

// ═══════════════════════════════════════════════════════════
// 🌍 ROUTES PUBLIQUES
// ═══════════════════════════════════════════════════════════

// Auth helpers
Route::post('/check-email-login', [App\Http\Controllers\AuthController::class, 'checkEmailAndLogin']);

// ✅ Check email & verify password (utilisés par le formulaire)
if (app()->environment('local', 'development')) {
    // 🔧 DÉVELOPPEMENT : Pas de rate limiting
    Route::post('/check-email', [ServiceRequestController::class, 'checkEmail'])
        ->name('check-email');
    
    Route::post('/verify-password', [ServiceRequestController::class, 'verifyPassword'])
        ->name('verify-password');
} else {
    // 🚀 PRODUCTION : Rate limiting permissif (100 requêtes/minute)
    Route::middleware(['throttle:100,1'])->group(function () {
        Route::post('/check-email', [ServiceRequestController::class, 'checkEmail'])
            ->name('check-email');
        
        Route::post('/verify-password', [ServiceRequestController::class, 'verifyPassword'])
            ->name('verify-password');
    });
}

// Recruitment
Route::get('/recruitment', [ReviewController::class, 'recruitment'])->name('recruitment');
Route::post('/recruit/apply', [RecruitApplicationController::class, 'store'])->name('recruit.apply');

// Affiliate
Route::get('/affiliate', function () {
    $reviewController = new \App\Http\Controllers\ReviewController();
    $reviews = $reviewController->getAffiliateReviews(3);
    return view('pages.affiliate', compact('reviews'));
})->name('affiliate');

// Partnerships
Route::get('/partnerships', [ReviewController::class, 'partnerships'])->name('partnerships');
Route::post('/partnership/store', [PartnershipController::class, 'store'])->name('partnership.store');

Route::get('/cookiemanagment', function () {
    return view('pages.cookiemanagment');
})->name('cookies.show');

// ✅ CCPA Compliance - Do Not Sell My Personal Information
Route::get('/privacy/do-not-sell', function () {
    return view('pages.do-not-sell');
})->name('privacy.do-not-sell');

// ═══════════════════════════════════════════════════════════
// 🌍 PRESSE PUBLIQUE (multi-langues)
// ═══════════════════════════════════════════════════════════

// Hub press (sélecteur de langue)
Route::get('/press', function () {
    return view('pages.press', [
        'pressItems'  => collect(),
        'locale'      => 'en',
        'showContent' => false,
    ]);
})->name('press.page');

// Helper sûr: filtre par langue seulement si colonne "language" existe
$loadPressByLang = function (string $lang) {
    $q = \App\Models\Press::query();
    if (Schema::hasColumn('press', 'language')) {
        $q->where('language', $lang);
    }
    return $q->orderBy('created_at', 'desc')->get();
};

// Pages localisées
Route::get('/press/en', function () use ($loadPressByLang) {
    return view('press.en', [
        'pressItems'  => $loadPressByLang('en'),
        'locale'      => 'en',
        'showContent' => true,
    ]);
})->name('press.en');

Route::get('/press/fr', function () use ($loadPressByLang) {
    return view('press.fr', [
        'pressItems'  => $loadPressByLang('fr'),
        'locale'      => 'fr',
        'showContent' => true,
    ]);
})->name('press.fr');

Route::get('/press/de', function () use ($loadPressByLang) {
    return view('press.de', [
        'pressItems'  => $loadPressByLang('de'),
        'locale'      => 'de',
        'showContent' => true,
    ]);
})->name('press.de');

// Formulaire press public (anti-spam)
Route::post('/press/inquiry', [PressController::class, 'storeInquiry'])
    ->middleware('throttle:10,1')
    ->name('press.inquiry.store');

// Assets & Preview publics
Route::get('/press/asset/{id}/{type}', [PressController::class, 'asset'])
    ->whereIn('type', ['pdf', 'guideline_pdf', 'photo', 'icon'])
    ->name('press.asset');

Route::get('/press/preview/{id}/{type}', [PressController::class, 'preview'])
    ->whereIn('type', ['pdf', 'guideline_pdf', 'photo', 'icon'])
    ->name('press.preview');

// ═══════════════════════════════════════════════════════════
// 📝 AUTRES ROUTES PUBLIQUES
// ═══════════════════════════════════════════════════════════

Route::get('/termsnconditions', [TermsAndConditionsController::class, 'ShowTerms'])->name('terms.show');

// AJAX user signup
Route::post('/signup/store', [UserController::class, 'storeViaSignup']);

// Provider details
Route::get('providers/{id}', [ServiceProviderController::class, 'providerDetails'])->name('provider-details');

// Auth (avec rate limiting anti brute-force)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1') // 5 tentatives par minute
    ->name('user.login');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Forgot Password (avec rate limiting anti-abus)
Route::get('/forgot-password', function () {
    return view('user-auth.forgot-password');
});
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->middleware('throttle:3,1') // 3 tentatives par minute
    ->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->middleware('throttle:5,1') // 5 tentatives par minute
    ->name('password.update');

Route::get('/signup', function () {
    return view('user-auth.signup');
});
Route::get('/affiliate/sign-up', [AffiliateController::Class, 'affliateSignup']);

Route::get('/', [ServiceProviderController::class, 'main']);
Route::get('/get-providers', [ServiceProviderController::class, 'getProviders']);
Route::get('/filter-providers', [ServiceProviderController::class, 'filterProviders']);
Route::get('/get-subcategories/{categoryId}', [ServiceProviderController::class, 'getSubcategories']);

// ✅ PUBLIC : liste de tous les prestataires (toujours accessible)
Route::get('/service-providers', [ServiceProviderController::class, 'serviceproviders'])
    ->name('service-providers')
    ->withoutMiddleware(['auth', \App\Http\Middleware\Authenticate::class, 'verified', 'auth:sanctum']);

Route::get('/view-service-providers', [ServiceProviderController::class, 'serviceproviders'])
    ->name('view.service-providers')
    ->withoutMiddleware(['auth', \App\Http\Middleware\Authenticate::class, 'verified', 'auth:sanctum']);

Route::get('/become-service-provider', function () {
    return view('pages.service-provider');
})->name('become.service.provider');

// Registration (avec rate limiting anti brute-force OTP)
Route::post('/send-email-otp', [RegisterController::class, 'sendEmailOtp'])
    ->middleware('throttle:5,1') // 5 envois par minute
    ->name('send-email-otp');
Route::post('/verify-email-otp', [RegisterController::class, 'verifyEmailOtp'])
    ->middleware('throttle:10,1') // 10 tentatives par minute (OTP = 6 chiffres)
    ->name('user.verifyEmailOtp');
Route::post('/resend-email-otp', [RegisterController::class, 'resendEmailOtp'])
    ->middleware('throttle:3,1') // 3 renvois par minute
    ->name('user.resendEmailOtp');
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('user.register');
Route::post('/signup/register', [RegisterController::class, 'signupRegister'])
    ->middleware('throttle:5,1')
    ->name('user.signupRegister');

// Legal pages
Route::get('/legal-notice', function () {
    return view('pages.legal-notice');
});
Route::get('/aboutUS', function () {
    return view('pages.aboutus');
});
Route::get('/inviteFriend', function () {
    return view('pages.invitefriend');
});

// ═══════════════════════════════════════════════════════════
// 🔐 ROUTES AUTHENTIFIÉES
// ═══════════════════════════════════════════════════════════

Route::middleware(['auth'])->group(function () {
    Route::post('/restore-admin', [AdminDashboardController::class, 'restoreAdmin'])->name('restore-admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/service-request', [ServiceRequestController::class, 'index'])->name('user.service.requests');
    Route::get('/view-service-request', [ServiceRequestController::class, 'viewServiceRequest'])->name('view.request');
    Route::get('/ongoing-requests', [ServiceRequestController::class, 'ongoingServiceRequest'])->name('ongoing-requests');
    Route::get('/get-subcategories/{categoryId}', [ServiceRequestController::class, 'getSubcategories']);
    Route::get('/get-missions', [ServiceRequestController::class, 'getMissions']);
    Route::post('/api/mission/cancel', [ServiceRequestController::class, 'cancelMissionRequest'])
    ->name('api.cancel.mission.request');
    Route::get('/my-earnings', [EarningsController::class, 'index'])->name('user.earnings');

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index'])->name('user.conversation');
    Route::get('/conversations/list', [ConversationController::class, 'list'])->name('conversations.list');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/start', [ConversationController::class, 'start'])->name('conversations.start');
    Route::post('/conversations/{conversation}/message', [ConversationController::class, 'sendMessage'])->name('conversations.sendMessage');
    Route::get('/conversations/{conversation}/messages', [ConversationController::class, 'messages'])->name('conversations.messages');
    Route::get('/conversations/{conversation}/status', [ConversationController::class, 'status'])->name('conversations.status');
    Route::post('/isRead/{id}/message', [ConversationController::class, 'isRead']);
    Route::get('/attachments/{attachment}/download', [ConversationController::class, 'downloadAttachment'])->name('attachments.download');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('user.payments');
    Route::get('/payments-validate', [PaymentController::class, 'paymentValidate'])->name('user.payments.validate');
    Route::get('/my-earning-payment', [PaymentController::class, 'earningAndPayments'])->name('my-earning-payment');

    // Reviews
    Route::get('/reviews', [ReviewsController::class, 'reviews'])->name('user-reviews');
    Route::post('/review-ulysse', [ReviewsController::class, 'reviewUlysse'])->name('review-ulysse');
    Route::get('/review-options', [ReviewsController::class, 'reviewOptions'])->name('review-options');
    Route::get('/review-end', [ReviewsController::class, 'reviewEnd'])->name('review-end');

    // Jobs
    Route::get('/job-list', [JobListController::class, 'index'])->name('user.joblist');
    Route::get('/view-job', [JobListController::class, 'viewJob'])->name('view-job');
    Route::get('/quote-offer', [JobListController::class, 'quoteOffer'])->name('quote-offer');
    Route::get('/archivejobs/{user}', [JobListController::class, 'archive'])->name('provider.jobs.archive');

    // Account
    Route::get('/account', [AccountController::class, 'index'])->name('user.account');
    Route::get('/personal-info', [AccountController::class, 'personalInfo'])->name('personal-info');
    Route::get('/affiliations', [AccountController::class, 'affiliationAccounts'])->name('user.affiliate.account');
    Route::get('/my-documents', [AccountController::class, 'myDocuments'])->name('my-documents');
    Route::get('/point-calculation', [AccountController::class, 'pointCalculation'])->name('points-calculation');
    Route::get('/upload-picture', [AccountController::class, 'uploadPicture'])->name('upload-picture');
    Route::post('/update-provider-profile', [AccountController::class, 'uploadProviderProfile'])->name('provider.profile.photo.ajax');
    Route::post('/provider/upload-document', [AccountController::class, 'uploadDocuments'])->name('provider.upload.document');
    Route::post('/user/banking-details', [AccountController::class, 'updateBankingDetails'])->name('user.banking.details');
    
    // ✅ Suppression de compte
    Route::delete('/account/delete', [AccountController::class, 'delete'])->name('account.delete');

    // ✅ Export des données personnelles (GDPR Art. 20, CCPA, LGPD)
    Route::get('/account/export-my-data', [AccountController::class, 'exportUserData'])
        ->middleware('throttle:3,60') // 3 exports par heure max
        ->name('account.export-data');

    Route::get('/upload-document', [AccountController::class, 'uploadDocument'])->name('upload-document');
    Route::post('/profile/photo', [AccountController::class, 'uploadProfilePicture'])->name('profile.photo.upload');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/provider/{id}/review', [ProviderReviewController::class, 'store'])->name('provider.review');
    Route::post('/mission/{id}/offer', [JobListController::class, 'submitOffer'])->name('mission.offer');

    // Mission public messages
    Route::post('/mission/{id}/public-message', [MissionMessageController::class, 'store'])->name('mission.public-message');
    Route::get('/mission/{id}/public-messages', [MissionMessageController::class, 'list'])->name('mission.public-messages');

    // Stripe (paiement)
    Route::post('/payments/stripe/checkout', [StripePaymentController::class, 'checkout'])->name('payments.stripe.checkout');
    Route::post('/payments/stripe/process', [StripePaymentController::class, 'processPayment'])->name('payments.stripe.process');
    Route::get('/payments/success/{mission}/{credits}', [StripePaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/cancel', [StripePaymentController::class, 'cancel'])->name('payments.stripe.cancel');

    // Pusher auth
    Route::post('/broadcasting/auth', function (Request $request) {
        return Broadcast::auth($request);
    });

    // Ulixai reviews by users
    Route::post('ulixai/review', [UlixaiReviewController::class, 'userReview'])->name('submit-ulixai-review');

    // Stripe KYC
    Route::get('/provider/stripe/onboarding-link', [StripePaymentController::class, 'getOnboardingLink'])->name('stripe.kyc.link');
    Route::get('/stripe/refresh', fn () => redirect()->back())->name('stripe.refresh');
    Route::get('/stripe/return', fn () => redirect('/dashboard'))->name('stripe.return');

    // Withdraw
    Route::post('/user/funds', [EarningsController::class, 'manageUserFunds'])->name('affiliate.withdraw');

    // Compte (API)
    Route::prefix('account')->group(function () {
        Route::get('/profile', [AccountController::class, 'getProfile']);
        Route::post('/update-personal-info', [AccountController::class, 'updatePersonalInfo']);
        Route::post('/update-field', [AccountController::class, 'updateField']);
        Route::post('/update-password', [AccountController::class, 'updatePassword']);
        Route::post('/provider/special-status/save', [AccountController::class, 'saveSpecialStatus']);
    });
});

// ═══════════════════════════════════════════════════════════
// 📝 FORMULAIRE DE DEMANDE (avec rate limiting intelligent)
// ═══════════════════════════════════════════════════════════

// Page de création (pas de rate limiting - c'est juste un GET)
Route::get('/create-request', [ServiceRequestController::class, 'createRequest'])
    ->name('create-request');

// Soumission du formulaire
if (app()->environment('local', 'development')) {
    // 🔧 DÉVELOPPEMENT : Pas de rate limiting pour faciliter les tests
    Route::post('/save-request', [ServiceRequestController::class, 'saveRequestForm'])
        ->name('save-request-form');
        
} else {
    // 🚀 PRODUCTION : Rate limiting raisonnable (100 requêtes/minute au niveau route)
    // + Rate limiting intelligent (30 par IP, 10 par session) au niveau contrôleur
    Route::middleware(['throttle:100,1'])->group(function () {
        Route::post('/save-request', [ServiceRequestController::class, 'saveRequestForm'])
            ->name('save-request-form');
    });
}

// ═══════════════════════════════════════════════════════════
// 👑 ADMIN
// ═══════════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1') // 5 tentatives par minute - protection brute-force admin
        ->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin', AdminAuthenticate::class])->group(function () {
        // SEO & Analytics
        Route::get('/seo', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'index'])->name('seo.index');
        Route::get('/seo/gsc-issues', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'gscIssues'])->name('seo.gscIssues');
        Route::get('/seo/pages-to-index', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'pagesToIndex'])->name('seo.pagesToIndex');
        Route::get('/seo/backlinks', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'backlinks'])->name('seo.backlinks');
        Route::post('/seo/refresh', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'refresh'])->name('seo.refresh');
        Route::get('/seo/bing-summary', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'bingSummary'])->name('seo.bing');
        Route::get('/seo/opr-summary', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'oprSummary'])->name('seo.opr');

        // Accounting
        Route::get('/seo/export', [\App\Http\Controllers\Admin\SeoAnalyticsController::class, 'export'])->name('seo.export');
        Route::get('/accounting', [\App\Http\Controllers\Admin\AccountingController::class, 'index'])->name('accounting.index');
        Route::get('/accounting/export', [\App\Http\Controllers\Admin\AccountingController::class, 'export'])->name('accounting.export');

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/transactions', [AdminDashboardController::class, 'transactions'])->name('transactions');

        Route::match(['get', 'post', 'patch', 'delete'], '/badges', [AdminDashboardController::class, 'badges'])->name('badges');
        Route::match(['get', 'post', 'patch', 'delete'], '/point-leaderboard', [ExpatsLeaderboardController::class, 'index'])->name('reputation-points');
        Route::post('/provider/{provider}/adjust-points', [ExpatsLeaderboardController::class, 'adjustPoints'])->name('provider.adjust-points');

        Route::get('/reputation-points', [ExpatsLeaderboardController::class, 'showConfig'])->name('reputation.config');
        Route::post('/adjust-reputation-points', [ExpatsLeaderboardController::class, 'adjustReputationPoints'])->name('adjust-reputation-points');

        Route::match(['get', 'post', 'patch', 'delete'], '/settings', [AdminSettingsController::class, 'settings'])->name('settings');
        Route::match(['get', 'post', 'patch', 'delete'], '/settings/faqs', [FaqController::class, 'index'])->name('settings.faqs');

        Route::get('/users', [UserManagementController::class, 'users'])->name('users');
        Route::match(['get', 'patch'], '/users/{user}/manage', [UserManagementController::class, 'manage'])->name('users.manage');
        Route::patch('/missions/{mission}/manage', [UserManagementController::class, 'manageMission'])->name('missions.manage');
        Route::post('/secret-login/{id}', [AdminDashboardController::class, 'secretLogin'])->name('secret-login');
        Route::post('/commission/update', [AdminDashboardController::class, 'updateCommission'])->name('commission.update');
        Route::post('/stripe/kyc/remind/{provider}', [AdminDashboardController::class, 'remindKyc'])->name('stripe.kyc.remind');

        // Transactions
        Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

        // User profile admin
        Route::get('/users/{id}/edit-profile', [UserManagementController::class, 'editProfileView'])->name('users.edit-profile');
        Route::post('/users/{id}/update-profile', [UserManagementController::class, 'editUserProfile'])->name('users.update-profile');

        // Missions
        Route::get('/missions', [MissionAdminController::class, 'index'])->name('missions');
        Route::get('/missions/{id}', [MissionAdminController::class, 'show'])->name('missions.show');
        Route::get('/admin/missions/{id}', [MissionAdminController::class, 'show'])->name('missions.show');
        Route::get('/missions/{id}/edit', [MissionAdminController::class, 'edit'])->name('missions.edit');
        Route::get('/missions/{id}/conversation', [MissionAdminController::class, 'conversation'])->name('missions.conversation');
        Route::post('/missions/{id}/edit', [MissionAdminController::class, 'update'])->name('missions.update');
        Route::delete('/missions/{id}', [MissionAdminController::class, 'destroy'])->name('missions.destroy');

        // Roles
        Route::get('/roles/json', [RoleController::class, 'json'])->name('roles.json');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

        Route::post('/users/{user}/block', [UserManagementController::class, 'suspendUser'])->name('users.block');
        Route::post('/users/{user}/unblock', [UserManagementController::class, 'unblockUser'])->name('users.unblock');

        Route::get('/roles-permissions', [RolesAndPermissionsController::class, 'index'])->name('roles-permissions');
        Route::post('/roles-permissions/{id}/assign', [RolesAndPermissionsController::class, 'assignRole'])->name('roles-permissions.assign');
        Route::post('/roles-permissions/{id}/revoke', [RolesAndPermissionsController::class, 'revokeRole'])->name('roles-permissions.revoke');
        Route::post('/roles-permissions/create', [RolesAndPermissionsController::class, 'createAdmin'])->name('roles-permissions.create');

        // World Map
        Route::get('/world-map', [UserManagementController::class, 'adminWorldMap'])->name('w-map-view');

        // Fake Content
        Route::get('/fake-content-generation', [FakeContentController::class, 'index'])->name('fake-content-generation');
        Route::get('/fake-content-generation/create-requester', [FakeContentController::class, 'createRequesterForm'])->name('fake-content.create-requester-form');
        Route::get('/fake-content-generation/create-provider', [FakeContentController::class, 'createProviderForm'])->name('fake-content.create-provider-form');
        Route::get('/fake-content-generation/create-mission', [FakeContentController::class, 'createMissionForm'])->name('fake-content.create-mission-form');
        Route::post('/fake-content-generation/create', [FakeContentController::class, 'createFake'])->name('fake-content.create');
        Route::post('/fake-content-generation/{type}/{id}/update', [FakeContentController::class, 'updateFake'])->name('fake-content.update');
        Route::post('/fake-content-generation/{type}/{id}/delete', [FakeContentController::class, 'deleteFake'])->name('fake-content.delete');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.updateOrder');
        Route::post('/categories/{category}/update-order', [CategoryController::class, 'updateSingleOrder'])->name('categories.updateSingleOrder');

        // Countries
        Route::get('/countries', [ManageCountries::class, 'index'])->name('countries.index');
        Route::post('/countries/{country}/toggle-status', [ManageCountries::class, 'toggleStatus'])->name('countries.toggle-status');

        // Fees
        Route::get('/service-fees', [ServiceFeesController::class, 'index'])->name('manage-fee.index');
        Route::post('/service-fees', [ServiceFeesController::class, 'store'])->name('manage-fee.store');
        Route::put('/service-fees/{serviceFee}', [ServiceFeesController::class, 'update'])->name('manage-fee.update');

        // Bug reports (redirige vers messages)
        Route::get('/bug-reports', function () { return redirect()->route('admin.messages'); })->name('bug-reports');

        // Applications
        Route::get('/applications', [AdminDashboardController::class, 'ShowApplications'])->name('applications');
        Route::post('/applications/{application}/status', [AdminDashboardController::class, 'updateStatus'])->name('applications.update-status');
        Route::get('/applications/{application}/cv', [AdminDashboardController::class, 'showCv'])->name('applications.cv');
        Route::delete('/applications/{application}', [AdminDashboardController::class, 'destroyApplication'])->name('applications.destroy');

        // Partnerships
        Route::get('/partnerships', [AdminDashboardController::class, 'showpartnerships'])->name('partnerships');

        // Affiliations
        Route::get('/user-affiliations', [AdminDashboardController::class, 'showAffiliateSummary'])->name('affiliationss');
        Route::get('/affiliate-details/{id}', [AdminDashboardController::class, 'affiliateDetails'])->name('affiliates.details');

        // ═══════════════════════════════════════════════════════
        // 📰 PRESS MANAGEMENT (admin)
        // ═══════════════════════════════════════════════════════
        Route::get('/press', [AdminDashboardController::class, 'showPressSummary'])->name('press');
        Route::post('/press/store', [PressController::class, 'store'])->name('press.store');

        Route::get('/press/preview/{id}/{type}', [PressController::class, 'preview'])
            ->whereIn('type', ['pdf', 'guideline_pdf', 'photo', 'icon'])
            ->name('press.preview');

        Route::delete('/press/delete-all', [PressController::class, 'deleteAll'])->name('press.deleteAll');
        Route::get('/press/files', [PressController::class, 'getFiles'])->name('press.files');
        Route::post('/press/upload', [PressController::class, 'upload'])->name('press.upload');
        Route::post('/press/delete', [PressController::class, 'delete'])->name('press.delete');
        Route::delete('/press/{press}', [PressController::class, 'destroy'])->name('press.destroy');
        Route::get('/press/by-language', [PressController::class, 'getByLanguage'])->name('press.by-language');

        // Inquiries press
        Route::get('/press/inquiries', [PressController::class, 'inquiriesPage'])->name('press.inquiries');
        Route::get('/press/inquiries/list', [PressController::class, 'inquiriesList'])->name('press.inquiries.list');
        Route::patch('/press/inquiries/{inquiry}/read', [PressController::class, 'markAsRead'])->name('press.inquiries.read');

        // ═══════════════════════════════════════════════════════
        // 💬 MESSAGES (admin)
        // ═══════════════════════════════════════════════════════
        Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
        Route::get('/messages/list', [MessagesController::class, 'list'])->name('messages.list');
        Route::post('/messages/read', [MessagesController::class, 'toggle'])->name('messages.read');

        // Terms / FAQ
        Route::get('/terms', [TermsAndConditionsController::class, 'termsIndex'])->name('terms.index');
        Route::get('/terms/fetch', [TermsAndConditionsController::class, 'fetch'])->name('terms.fetch');
        Route::post('/terms', [TermsAndConditionsController::class, 'store'])->name('terms.store');

        Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
        Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
        Route::post('/faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.update-order');

        // Disputes
        Route::get('/disputes', [DisputeController::class, 'index'])->name('disputes');
        Route::post('/disputes/refund', [DisputeController::class, 'refund'])->name('disputes.refund');
        Route::post('/disputes/transfer', [DisputeController::class, 'transfer'])->name('disputes.transfer');
    });
});

// ═══════════════════════════════════════════════════════════
// 🗺️ SITEMAPS (déclarer AVANT le catch-all)
// ═══════════════════════════════════════════════════════════
Route::get('/sitemap_index.xml',     [SitemapController::class, 'index'])->name('sitemaps.index');
Route::get('/sitemap.xml',           [SitemapController::class, 'static'])->name('sitemaps.static');
Route::get('/sitemap-providers.xml', [SitemapController::class, 'providers'])->name('sitemaps.providers');

// ═══════════════════════════════════════════════════════════
// 💬 CONVERSATION REPORT (Auth)
// ═══════════════════════════════════════════════════════════
Route::post('/conversations/{conversation}/report', [ConversationController::class, 'report'])->middleware('auth');

// ═══════════════════════════════════════════════════════════
// ⭐ CUSTOMER REVIEWS
// ═══════════════════════════════════════════════════════════
Route::get('/customerreviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/{slug}', [ReviewController::class, 'show'])->name('review.show');

// ═══════════════════════════════════════════════════════════
// 🔐 GOOGLE VISION API - VERIFICATION
// ═══════════════════════════════════════════════════════════
Route::prefix('api/provider/verification')->group(function () {
    Route::post('/photo', [ProviderPhotoVerificationController::class, 'upload']);
    Route::get('/photo/status', [ProviderPhotoVerificationController::class, 'status']);
    Route::get('/photo', [ProviderPhotoVerificationController::class, 'show']);
    Route::delete('/photo', [ProviderPhotoVerificationController::class, 'destroy']);
    
    Route::post('/documents', [ProviderDocumentVerificationController::class, 'store']);
    Route::get('/documents/{id}/status', [ProviderDocumentVerificationController::class, 'status']);
    Route::get('/documents/{id}', [ProviderDocumentVerificationController::class, 'show']);
    Route::delete('/documents/{id}', [ProviderDocumentVerificationController::class, 'destroy']);
    Route::get('/documents', [ProviderDocumentVerificationController::class, 'index']);
});

// ═══════════════════════════════════════════════════════════
// ⚠️ CATCH-ALL (garder en DERNIER)
// ═══════════════════════════════════════════════════════════
Route::get('/{slug?}', [PageController::class, 'show'])
    ->where('slug', '^(?!provider|reviews|sitemap|sitemap_index\\.xml).*$');