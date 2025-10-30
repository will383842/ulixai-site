<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\UlixaiReviewController;
use App\Http\Controllers\ServiceFeesController;
use App\Http\Controllers\PartnershipController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\RecruitApplicationController;
use App\Http\Controllers\PressController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// ========================================
// 🎯 ROUTES PRIORITAIRES - NE PAS DÉPLACER
// ========================================

// 🔥 Route provider profile - DOIT ÊTRE EN PREMIER pour éviter le catch-all
Route::get('/provider/{slug}', [ServiceProviderController::class, 'providerProfile'])
    ->name('provider.profile');

// ========================================
// ROUTES PUBLIQUES
// ========================================

Route::post('/check-email-login', [App\Http\Controllers\AuthController::class, 'checkEmailAndLogin']);

// Recruitment Route - ✅ Utilise la méthode dédiée du ReviewController
Route::get('/recruitment', [ReviewController::class, 'recruitment'])->name('recruitment');

Route::post('/recruit/apply', [RecruitApplicationController::class, 'store'])
    ->name('recruit.apply'); 

// Affiliate Route - ✅ Utilise la méthode dédiée du ReviewController
Route::get('/affiliate', function() {
    $reviewController = new \App\Http\Controllers\ReviewController();
    $reviews = $reviewController->getAffiliateReviews(3);
    return view('pages.affiliate', compact('reviews'));
})->name('affiliate');

// Partnerships Route - ✅ CORRIGÉ : Utilise maintenant la méthode dédiée du ReviewController
Route::get('/partnerships', [ReviewController::class, 'partnerships'])->name('partnerships');

// Partnership Request
Route::post('/partnership/store', [PartnershipController::class, 'store'])->name('partnership.store');

// ========================================
// 🌍 ROUTES PRESSE PUBLIQUES - MULTILINGUES
// ========================================

// Page principale avec sélecteur de langues (pas de contenu)
Route::get('/press', function() {
    return view('pages.press', [
        'pressItems' => collect(),
        'locale' => 'en',
        'showContent' => false
    ]);
})->name('press.page');

// Page ANGLAISE - Documents en anglais uniquement
Route::get('/press/en', function() {
    $pressItems = App\Models\Press::where('language', 'en')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
    return view('press.en', [
        'pressItems' => $pressItems,
        'locale' => 'en',
        'showContent' => true
    ]);
})->name('press.en');

// Page FRANÇAISE - Documents en français uniquement
Route::get('/press/fr', function() {
    $pressItems = App\Models\Press::where('language', 'fr')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
    return view('press.fr', [
        'pressItems' => $pressItems,
        'locale' => 'fr',
        'showContent' => true
    ]);
})->name('press.fr');

// Page ALLEMANDE - Documents en allemand uniquement
Route::get('/press/de', function() {
    $pressItems = App\Models\Press::where('language', 'de')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
    return view('press.de', [
        'pressItems' => $pressItems,
        'locale' => 'de',
        'showContent' => true
    ]);
})->name('press.de');

// Routes de téléchargement/preview des fichiers presse (publiques)
Route::get('/press/asset/{press}/{field}', [PressController::class, 'asset'])
    ->whereIn('field', ['pdf','guideline_pdf','photo','icon'])
    ->name('press.asset');

Route::get('/press/preview/{press}/{field}', [PressController::class, 'preview'])
    ->whereIn('field', ['pdf','guideline_pdf','photo','icon'])
    ->name('press.preview');

// ========================================
// AUTRES ROUTES PUBLIQUES (suite)
// ========================================

Route::get('/termsnconditions', [TermsAndConditionsController::class, 'ShowTerms'])
    ->name('terms.show');

// AJAX user signup
Route::post('/signup/store', [UserController::class, 'storeViaSignup']);

//provider details 
Route::get('providers/{id}', [ServiceProviderController::class, 'providerDetails'])->name('provider-details');

// User Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Forgot Password
Route::get('/forgot-password', function() {
    return view('user-auth.forgot-password');
});
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/signup', function() {
    return view('user-auth.signup');
});
Route::get('/affiliate/sign-up', [AffiliateController::Class, 'affliateSignup']); 

Route::get('/', [ServiceProviderController::class, 'main']);
Route::get('/get-providers', [ServiceProviderController::class, 'getProviders']);
Route::get('/get-subcategories/{categoryId}', [ServiceProviderController::class, 'getSubcategories']);

Route::get('/become-service-provider',  function() {
    return view('pages.service-provider');
})->name('become.service.provider');

// User Registration
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::post('/verify-email-otp', [RegisterController::class, 'verifyEmailOtp'])->name('user.verifyEmailOtp');
Route::post('/signup/register', [RegisterController::class, 'signupRegister'])->name('user.signupRegister');
Route::post('/resend-email-otp', [RegisterController::class, 'resendEmailOtp'])->name('user.resendEmailOtp');

//Legal Information
Route::get('/legal-notice', function() {
    return view('pages.legal-notice');
});

Route::get('/aboutUS', function () {
    return view('pages.aboutus');
});

Route::get('/inviteFriend', function () {
    return view('pages.invitefriend');
});

// ========================================
// AUTHENTICATED ROUTES
// ========================================

Route::middleware(['auth'])->group(function () {
    Route::post('/restore-admin', [AdminDashboardController::class, 'restoreAdmin'])->name('restore-admin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/service-request', [ServiceRequestController::class, 'index'])->name('user.service.requests');
    Route::get('/view-service-request', [ServiceRequestController::class, 'viewServiceRequest'])->name('view.request');
    Route::get('/ongoing-requests', [ServiceRequestController::class, 'ongoingServiceRequest'])->name('ongoing-requests');
    Route::get('/get-subcategories/{categoryId}', [ServiceRequestController::class, 'getSubcategories']);
    Route::get('/get-missions', [ServiceRequestController::class, 'getMissions']);

    Route::get('/my-earnings', [EarningsController::class, 'index'])->name('user.earnings');
    Route::get('/conversations', [ConversationController::class, 'index'])->name('user.conversation');
    Route::get('/conversations/list', [ConversationController::class, 'list'])->name('conversations.list');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/start', [ConversationController::class, 'start'])->name('conversations.start');
    Route::post('/conversations/{conversation}/message', [ConversationController::class, 'sendMessage'])->name('conversations.sendMessage');
    Route::get('/conversations/{conversation}/messages', [ConversationController::class, 'messages'])->name('conversations.messages');
    Route::get('/conversations/{conversation}/status', [ConversationController::class, 'status'])->name('conversations.status');
    Route::post('/isRead/{id}/message', [ConversationController::class, 'isRead']);
    Route::get('/attachments/{attachment}/download', [ConversationController::class, 'downloadAttachment'])->name('attachments.download');
    
    Route::get('/payments', [PaymentController::class, 'index'])->name('user.payments');
    Route::get('/payments-validate', [PaymentController::class, 'paymentValidate'])->name('user.payments.validate');
    Route::get('/my-earning-payment', [PaymentController::class, 'earningAndPayments'])->name('my-earning-payment');
    Route::get('/reviews', [ReviewsController::class, 'reviews'])->name('user-reviews');
    Route::post('/review-ulysse', [ReviewsController::class, 'reviewUlysse'])->name('review-ulysse');
    Route::get('/review-options', [ReviewsController::class, 'reviewOptions'])->name('review-options');
    Route::get('/review-end', [ReviewsController::class, 'reviewEnd'])->name('review-end');
    
    // Service Provider
    Route::get('/service-providers', [ServiceProviderController::class, 'serviceproviders'])->name('service-providers');
    Route::get('/view-service-providers', [ServiceProviderController::class, 'serviceproviders'])->name('view.service-providers');

    //Job Routes
    Route::get('/job-list', [JobListController::class, 'index'])->name('user.joblist');
    Route::get('/view-job', [JobListController::class, 'viewJob'])->name('view-job');
    Route::get('/quote-offer', [JobListController::class, 'quoteOffer'])->name('qoute-offer');
    Route::get('/archivejobs/{user}', [JobListController::class, 'archive'])->name('provider.jobs.archive');

    //Account Routes
    Route::get('/account', [AccountController::class, 'index'])->name('user.account');
    Route::get('/personal-info', [AccountController::class, 'personalInfo'])->name('personal-info');
    Route::get('/affiliations', [AccountController::class, 'affiliationAccounts'])->name('user.affiliate.account');
    Route::get('/my-documents', [AccountController::class, 'myDocuments'])->name('my-documents');
    Route::get('/point-calculation', [AccountController::class, 'pointCalculation'])->name('points-calculation');
    Route::get('/upload-picture', [AccountController::class, 'uploadPicture'])->name('upload-picture');
    Route::post('/update-provider-profile', [AccountController::class, 'uploadProviderProfile'])->name('provider.profile.photo.ajax');
    Route::post('/provider/upload-document', [AccountController::class, 'uploadDocuments'])->name('provider.upload.document');
    Route::post('/user/banking-details', [AccountController::class, 'updateBankingDetails'])->name('user.banking.details');

    Route::get('/upload-document', [AccountController::class, 'uploadDocument'])->name('upload-document');
    Route::post('/profile/photo', [AccountController::class, 'uploadProfilePicture'])->name('profile.photo.upload');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/provider/{id}/review', [ProviderReviewController::class, 'store'])->name('provider.review');
    Route::post('/mission/{id}/offer', [JobListController::class, 'submitOffer'])->name('mission.offer');

    Route::post('/mission/{id}/public-message', [MissionMessageController::class, 'store'])->name('mission.public-message');
    Route::get('/mission/{id}/public-messages', [MissionMessageController::class, 'list'])->name('mission.public-messages');

    Route::post('/payments/stripe/checkout', [StripePaymentController::class, 'checkout'])->name('payments.stripe.checkout');
    Route::post('/payments/stripe/process', [StripePaymentController::class, 'processPayment'])->name('payments.stripe.process');
    Route::get('/payments/success/{mission}/{credits}', [StripePaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/cancel', [StripePaymentController::class, 'cancel'])->name('payments.stripe.cancel');
    Route::post('/broadcasting/auth', function (Request $request) {
        return Broadcast::auth($request);
    });

    // Ulixai Reviews By Users
    Route::post('ulixai/review', [UlixaiReviewController::class, 'userReview'])->name('submit-ulixai-review');

    //Stripe 
    Route::get('/provider/stripe/onboarding-link', [StripePaymentController::class, 'getOnboardingLink'])->name('stripe.kyc.link');
    Route::get('/stripe/refresh', fn() => redirect()->back())->name('stripe.refresh');
    Route::get('/stripe/return', fn() => redirect('/dashboard'))->name('stripe.return');

    // Withdraw Funds
    Route::post('/user/funds', [EarningsController::class, 'manageUserFunds'])->name('affiliate.withdraw');

    //Personal Information
    Route::prefix('account')->group(function () {
        Route::get('/profile', [AccountController::class, 'getProfile']);
        Route::post('/update-personal-info', [AccountController::class, 'updatePersonalInfo']);
        Route::post('/update-field', [AccountController::class, 'updateField']);
        Route::post('/update-password', [AccountController::class, 'updatePassword']);
        Route::post('/provider/special-status/save', [AccountController::class, 'saveSpecialStatus']);
    });
});

// Request Routes
Route::get('/create-request', [ServiceRequestController::class, 'createRequest']);
Route::post('/save-request', [ServiceRequestController::class, 'saveRequestForm'])->name('save-request-form');

// ========================================
// ADMIN ROUTES
// ========================================

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin', AdminAuthenticate::class])->group(function () {
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

        // Transaction management
        Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::get('/users/{id}/edit-profile', [UserManagementController::class, 'editProfileView'])->name('users.edit-profile');
        Route::post('/users/{id}/update-profile', [UserManagementController::class, 'editUserProfile'])->name('users.update-profile');
        
        Route::get('/missions', [MissionAdminController::class, 'index'])->name('missions');
        Route::get('/missions/{id}', [MissionAdminController::class, 'show'])->name('missions.show');
        Route::get('/admin/missions/{id}', [MissionAdminController::class, 'show'])->name('missions.show');
        Route::get('/missions/{id}/edit', [MissionAdminController::class, 'edit'])->name('missions.edit');
        Route::get('/missions/{id}/conversation', [MissionAdminController::class, 'conversation'])->name('missions.conversation');
        Route::post('/missions/{id}/edit', [MissionAdminController::class, 'update'])->name('missions.update');
        Route::delete('/missions/{id}', [MissionAdminController::class, 'destroy'])->name('missions.destroy');
        
        //Create Roles Routes
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

        // Admin World Map View
        Route::get('/world-map', [UserManagementController::class, 'adminWorldMap'])->name('w-map-view');

        // Admin Fake Content Generation
        Route::get('/fake-content-generation', [FakeContentController::class, 'index'])->name('fake-content-generation');
        Route::get('/fake-content-generation/create-requester', [FakeContentController::class, 'createRequesterForm'])->name('fake-content.create-requester-form');
        Route::get('/fake-content-generation/create-provider', [FakeContentController::class, 'createProviderForm'])->name('fake-content.create-provider-form');
        Route::get('/fake-content-generation/create-mission', [FakeContentController::class, 'createMissionForm'])->name('fake-content.create-mission-form');
        Route::post('/fake-content-generation/create', [FakeContentController::class, 'createFake'])->name('fake-content.create');
        Route::post('/fake-content-generation/{type}/{id}/update', [FakeContentController::class, 'updateFake'])->name('fake-content.update');
        Route::post('/fake-content-generation/{type}/{id}/delete', [FakeContentController::class, 'deleteFake'])->name('fake-content.delete');

        // Category Management Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.updateOrder');
        Route::post('/categories/{category}/update-order', [CategoryController::class, 'updateSingleOrder'])->name('categories.updateSingleOrder');

        // Country Management Routes
        Route::get('/countries', [ManageCountries::class, 'index'])->name('countries.index');
        Route::post('/countries/{country}/toggle-status', [ManageCountries::class, 'toggleStatus'])->name('countries.toggle-status');

        // Service Fees Management Routes
        Route::get('/service-fees', [ServiceFeesController::class, 'index'])->name('manage-fee.index');
        Route::post('/service-fees', [ServiceFeesController::class, 'store'])->name('manage-fee.store');
        Route::put('/service-fees/{serviceFee}', [ServiceFeesController::class, 'update'])->name('manage-fee.update');

        // Bug Reports Route
        Route::get('/bug-reports', [AdminDashboardController::class, 'showReports'])->name('bug-reports');
        
        Route::get('/applications', [AdminDashboardController::class, 'ShowApplications'])->name('applications');
        Route::post('/applications/{application}/status', [AdminDashboardController::class, 'updateStatus'])->name('applications.update-status'); 
        Route::get('/applications/{application}/cv', [AdminDashboardController::class, 'showCv'])->name('applications.cv');   
        Route::delete('/applications/{application}', [AdminDashboardController::class, 'destroyApplication'])->name('applications.destroy');

        //partnership Route
        Route::get('/partnerships', [AdminDashboardController::class, 'showpartnerships'])->name('partnerships');

        //Affiliations Route
        Route::get('/user-affiliations', [AdminDashboardController::class, 'showAffiliateSummary'])->name('affiliationss');
        Route::get('/affiliate-details/{id}', [AdminDashboardController::class, 'affiliateDetails'])->name('affiliates.details');

        // ========================================
        // 📰 PRESS MANAGEMENT - ADMIN ROUTES (CORRIGÉ)
        // ========================================
        Route::get('/press', [AdminDashboardController::class, 'showPressSummary'])->name('press');
        Route::post('/press/store', [PressController::class, 'store'])->name('press.store');
        Route::get('/press/preview/{press}/{field}', [PressController::class, 'preview'])
            ->whereIn('field', ['pdf','guideline_pdf','photo','icon'])
            ->name('admin.press.preview');
        Route::delete('/press/delete-all', [PressController::class, 'deleteAll'])->name('press.deleteAll');

        //Terms n conditions 
        Route::get('/terms', [TermsAndConditionsController::class, 'termsIndex'])->name('terms.index');
        Route::get('/terms/fetch', [TermsAndConditionsController::class, 'fetch'])->name('terms.fetch');
        Route::post('/terms', [TermsAndConditionsController::class, 'store'])->name('terms.store');

        // FAQ Management Routes
        Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store'); 
        Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
        Route::post('/faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.update-order');

        Route::get('/disputes', [DisputeController::class, 'index'])->name('disputes');
        Route::post('/disputes/refund', [DisputeController::class, 'refund'])->name('disputes.refund');
        Route::post('/disputes/transfer', [DisputeController::class, 'transfer'])->name('disputes.transfer');
    });
});

// ========================================
// SITEMAPS
// ========================================

// 1) Index unique des sitemaps à soumettre à Google
Route::get('/sitemap_index.xml', function () {
    $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap><loc>https://ulixai.com/sitemap.xml</loc></sitemap>
  <sitemap><loc>https://ulixai.com/sitemap-providers.xml</loc></sitemap>
  <sitemap><loc>https://blog.ulixai.com/sitemap_index.xml</loc></sitemap>
</sitemapindex>
XML;
    return response($xml, 200)->header('Content-Type', 'application/xml');
});

// 2) Sitemap des pages fixes
Route::get('/sitemap.xml', function () {
    $xml = Cache::remember('sitemap.static', 3600, function () {
        $now = now()->toAtomString();

        $urls = [
            ['loc' => 'https://ulixai.com/',                        'lastmod' => $now, 'priority' => '1.0'],
            ['loc' => 'https://ulixai.com/become-service-provider', 'lastmod' => $now, 'priority' => '0.8'],
            ['loc' => 'https://ulixai.com/service-providers',       'lastmod' => $now, 'priority' => '0.8'],
            ['loc' => 'https://ulixai.com/recruitment',             'lastmod' => $now, 'priority' => '0.7'],
            ['loc' => 'https://ulixai.com/partnerships',            'lastmod' => $now, 'priority' => '0.7'],
            ['loc' => 'https://ulixai.com/affiliate',               'lastmod' => $now, 'priority' => '0.7'],
            ['loc' => 'https://ulixai.com/affiliate/sign-up',       'lastmod' => $now, 'priority' => '0.6'],
            ['loc' => 'https://ulixai.com/customerreviews',         'lastmod' => $now, 'priority' => '0.6'],
            ['loc' => 'https://ulixai.com/aboutUS',                 'lastmod' => $now, 'priority' => '0.5'],
            ['loc' => 'https://ulixai.com/press',                   'lastmod' => $now, 'priority' => '0.5'],
        ];

        $body = '';
        foreach ($urls as $u) {
            $loc = htmlspecialchars($u['loc'], ENT_XML1);
            $lastmod = $u['lastmod'];
            $priority = $u['priority'];
            $body .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod><changefreq>daily</changefreq><priority>{$priority}</priority></url>";
        }

        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
             . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">{$body}</urlset>";
    });

    return response($xml, 200)
        ->header('Content-Type', 'application/xml')
        ->header('Cache-Control', 'public, max-age=3600');
});

// 3) Sitemap DYNAMIQUE des prestataires
Route::get('/sitemap-providers.xml', function () {
    $xml = Cache::remember('sitemap.providers', 3600, function () {

        $candidates = [
            ['table' => 'service_providers', 'slug' => 'slug', 'updated' => 'updated_at', 'public' => 'is_public'],
            ['table' => 'providers',         'slug' => 'slug', 'updated' => 'updated_at', 'public' => 'is_public'],
        ];
        $src = null;
        foreach ($candidates as $c) {
            if (Schema::hasTable($c['table']) && Schema::hasColumn($c['table'], $c['slug'])) {
                $src = $c; break;
            }
        }
        if (!$src) {
            return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"></urlset>";
        }

        $q = DB::table($src['table'])->select([$src['slug'], $src['updated']]);
        if (!empty($src['public']) && Schema::hasColumn($src['table'], $src['public'])) {
            $q->where($src['public'], 1);
        }
        if (Schema::hasColumn($src['table'], 'id')) {
            $q->orderBy('id');
        }

        $body = '';
        $q->chunk(1000, function ($rows) use (&$body, $src) {
            foreach ($rows as $r) {
                if (empty($r->{$src['slug']})) continue;
                $loc = htmlspecialchars(url('/provider/'.$r->{$src['slug']}), ENT_XML1);
                $lastmod = !empty($r->{$src['updated']})
                    ? \Illuminate\Support\Carbon::parse($r->{$src['updated']})->toAtomString()
                    : now()->toAtomString();
                $body .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod><changefreq>daily</changefreq><priority>0.7</priority></url>";
            }
        });

        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
             . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">{$body}</urlset>";
    });

    return response($xml, 200)
        ->header('Content-Type', 'application/xml')
        ->header('Cache-Control', 'public, max-age=3600');
});

// ========================================
// CONVERSATION REPORT (Auth required)
// ========================================
Route::post('/conversations/{conversation}/report', [ConversationController::class, 'report'])->middleware('auth');

// ========================================
// CUSTOMER REVIEWS ROUTES
// ========================================
Route::get('/customerreviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/{slug}', [ReviewController::class, 'show'])->name('review.show');

// ========================================
// ⚠️ CATCH-ALL ROUTE - DOIT RESTER EN DERNIER !
// ========================================
// Cette route attrape toutes les URLs non définies ci-dessus
// La regex exclut explicitement les URLs commençant par "provider" ou "reviews"
Route::get('/{slug?}', [PageController::class, 'show'])
    ->where('slug', '^(?!provider|reviews).*$');