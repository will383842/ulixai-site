<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\MissionCancellationReason;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Transfer;
use Stripe\Account as StripeAccount;
use Carbon\Carbon;
use App\Models\MissionOffer;
use App\Services\ReputationPointService;
use App\Services\ProviderMatcher;
use App\Mail\MissionInviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class ServiceRequestController extends Controller
{
    protected $ReputationPointService;
    
    public function __construct(ReputationPointService $ReputationPointService)
    {
        $this->ReputationPointService = $ReputationPointService;
    }
    
    /**
     * Liste des demandes de service de l'utilisateur connecté
     */
    public function index(Request $request) 
    {
        $user = auth()->user();
        $missions = [];
        
        if ($user) {
            $missions = Mission::where('requester_id', $user->id)
                ->orderByDesc('created_at')
                ->get();
        }
        
        return view('dashboard.service.service-requests', compact('user', 'missions'));
    } 

    /**
     * Voir une demande de service spécifique
     */
    public function viewServiceRequest(Request $request)
    {
        $id = $request->query('id') ?? $request->route('id');
        $mission = null;
        
        if ($id) {
            $mission = Mission::find($id);
        }
        
        return view('dashboard.service.view-request', compact('mission'));
    }

    /**
     * Liste des demandes de service en cours
     */
    public function ongoingServiceRequest(Request $request) 
    {
        $missions = Mission::orderByDesc('created_at')
            ->with('requester') 
            ->where('status', 'published')     
            ->where('payment_status', 'unpaid')
            ->get();  

        $category = Category::where('level', 1)->with('subcategories')->get();
    
        return view('dashboard.service.ongoing-service-requests', compact('missions', 'category'));
    }
    
    /**
     * Page de création d'une demande
     */
    public function createRequest(Request $request) 
    {
        return view('wizards.requester.steps.request-for-help');
    }

    /**
     * ✅ Vérifier si l'email existe et si les cookies sont valides
     */
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'exists' => false,
                'has_valid_cookie' => false
            ]);
        }

        // Vérifier les cookies
        $hasValidCookie = false;
        $cookieName = 'user_session_' . $user->id;
        
        if ($request->hasCookie($cookieName)) {
            try {
                $cookieValue = $request->cookie($cookieName);
                $decrypted = decrypt($cookieValue);
                list($userId, $timestamp) = explode('|', $decrypted);
                
                $cookieAge = now()->timestamp - $timestamp;
                $thirtyDaysInSeconds = 60 * 60 * 24 * 30;
                
                if ($userId == $user->id && $cookieAge < $thirtyDaysInSeconds) {
                    $hasValidCookie = true;
                }
            } catch (\Exception $e) {
                $hasValidCookie = false;
            }
        }

        return response()->json([
            'exists' => true,
            'has_valid_cookie' => $hasValidCookie,
            'first_name' => $user->name,
            'user_id' => $user->id
        ]);
    }

    /**
     * ✅ Vérifier le mot de passe
     */
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong password, please try again'
            ], 401);
        }

        // Login automatique + cookie
        \Auth::login($user, true);
        $request->session()->regenerate();
        $user->update(['last_login_at' => now()]);

        $cookieName = 'user_session_' . $user->id;
        $cookieValue = encrypt($user->id . '|' . now()->timestamp);
        $cookie = cookie($cookieName, $cookieValue, 60 * 24 * 30);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ])->cookie($cookie);
    }

    /**
     * ✅ Sauvegarder le formulaire de demande (PRODUCTION)
     */
    public function saveRequestForm(Request $request)
    {
        // ═══════════════════════════════════════════════════════
        // 📊 LOGS : Entrée de la requête
        // ═══════════════════════════════════════════════════════
        Log::info('📥 [FORM] Request received', [
            'ip' => $request->ip(),
            'user_id' => auth()->id(),
        ]);
        
        // ═══════════════════════════════════════════════════════
        // 🛡️ SÉCURITÉ 1 : Rate Limiting INTELLIGENT (permissif)
        // ═══════════════════════════════════════════════════════
        $ipKey = 'request-form:ip:' . $request->ip();
        $sessionKey = 'request-form:session:' . $request->session()->getId();
        
        // Protection par IP (50 soumissions/heure - gère IP partagées)
        if (RateLimiter::tooManyAttempts($ipKey, 50)) {
            $seconds = RateLimiter::availableIn($ipKey);
            $minutes = ceil($seconds / 60);
            
            Log::warning('⏱️ [FORM] IP rate limit exceeded', [
                'ip' => $request->ip(),
                'attempts' => RateLimiter::attempts($ipKey)
            ]);
            
            return response()->json([
                'success' => false,
                'message' => "Too many submissions from this network. Please wait {$minutes} minute(s)."
            ], 429);
        }
        
        // Protection par session (15 soumissions/heure - autorise erreurs multiples)
        if (RateLimiter::tooManyAttempts($sessionKey, 15)) {
            $seconds = RateLimiter::availableIn($sessionKey);
            $minutes = ceil($seconds / 60);
            
            Log::warning('⏱️ [FORM] Session rate limit exceeded', [
                'session' => $request->session()->getId(),
                'attempts' => RateLimiter::attempts($sessionKey)
            ]);
            
            return response()->json([
                'success' => false,
                'message' => "You've submitted too many forms. Please wait {$minutes} minute(s)."
            ], 429);
        }
        
        // Incrémenter les compteurs
        RateLimiter::hit($ipKey, 3600);    // 1 heure
        RateLimiter::hit($sessionKey, 3600); // 1 heure
        
        // ═══════════════════════════════════════════════════════
        // 🛡️ SÉCURITÉ 2 : Honeypot (détection bot)
        // ═══════════════════════════════════════════════════════
        if (!empty($request->website)) {
            Log::warning('🍯 [FORM] Honeypot triggered', ['ip' => $request->ip()]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Request submitted successfully!',
                'mission_id' => 0
            ]);
        }
        
        // ═══════════════════════════════════════════════════════
        // 🛡️ SÉCURITÉ 3 : Timestamp (min 10 secondes de remplissage)
        // ═══════════════════════════════════════════════════════
        $timestamp = $request->timestamp;
        if ($timestamp && (time() - $timestamp < 10)) {
            Log::warning('⚡ [FORM] Form filled too quickly', [
                'time_elapsed' => time() - $timestamp
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Form filled too quickly. Please take your time.'
            ], 400);
        }
        
        // ═══════════════════════════════════════════════════════
        // 🛡️ SÉCURITÉ 4 : Vérification reCAPTCHA v3
        // ═══════════════════════════════════════════════════════
        $recaptchaToken = $request->recaptcha_token;
        
        if ($recaptchaToken) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $recaptchaToken,
                'remoteip' => $request->ip()
            ]);
            
            $recaptchaResult = $response->json();
            
            if (!$recaptchaResult['success'] || ($recaptchaResult['score'] ?? 0) < 0.5) {
                Log::warning('🤖 [FORM] reCAPTCHA failed', [
                    'score' => $recaptchaResult['score'] ?? null
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Security verification failed. Please try again.'
                ], 403);
            }
        }
        
        // ═══════════════════════════════════════════════════════
        // 🛡️ SÉCURITÉ 5 : Validation des données
        // ═══════════════════════════════════════════════════════
        try {
            $validated = $request->validate([
                'countryNeed' => 'required|string|max:100',
                'originCountry' => 'nullable|string|max:100',
                'currentCity' => 'nullable|string|max:100',
                'durationHere' => 'nullable|string|max:100',
                'requestTitle' => 'required|string|min:15|max:200',
                'moreDetails' => 'required|string|min:50|max:1500',
                'supportType' => 'nullable|string|max:100',
                'urgency' => 'required|in:urgent,within_week,1_2_weeks,2_weeks_1_month,more_than_month',
                'languages' => 'nullable|array',
                'languages.*' => 'string|max:50',
                'firstName' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:255',
                'password' => 'nullable|string|min:6|max:255',
                'serviceDuration' => 'nullable|in:1 week,2 weeks,1 month',
                'photo1' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
                'photo2' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
                'photo3' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
                'photo4' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
                
                // ✅ GDPR: Validation CGV
                'terms_accepted_at' => 'nullable|string',
                'terms_version' => 'nullable|string|max:10',
            ]);
            
            Log::info('✅ [FORM] Validation passed');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            Log::error('❌ [FORM] Validation failed', [
                'errors' => $e->errors(),
                'ip' => $request->ip()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        // ═══════════════════════════════════════════════════════
        // 👤 GESTION UTILISATEUR + MISSION
        // ═══════════════════════════════════════════════════════
        try {
            $user = auth()->user();
            $affiliateLink = $this->generateAffiliateLink(
                $request->email ?? '', 
                $request->firstName ?? ''
            );
            
            // Créer l'utilisateur si nécessaire
            if (!$user) {
                Log::info('👤 [FORM] Creating new user', ['email' => $request->email]);
                
                $user = User::create([
                    'name' => trim($request->firstName ?? 'User'),
                    'email' => $request->email,
                    'password' => Hash::make($request->password ?? Str::random(16)),
                    'country' => $request->countryNeed,
                    'user_role' => 'service_requester',
                    'status' => 'active',
                    'affiliate_code' => $affiliateLink,
                    'preferred_language' => $request->input('languages.0') ?? null,
                    'last_login_at' => now(),
                ]);
                
                Log::info('✅ [FORM] User created', ['user_id' => $user->id]);
            }

            // Mapper l'urgence
            $urgencyLevels = [
                'within_week' => 'high',
                'urgent' => 'high',
                '1_2_weeks' => 'medium',
                '2_weeks_1_month' => 'low',
                'more_than_month' => 'low',
            ];
            $urgency = $urgencyLevels[$request->urgency] ?? 'medium';

            // Parser les catégories (JSON)
            $category = json_decode($request->category, true) ?? [];
            $subcategory = json_decode($request->subcategory, true) ?? [];
            $subcategory2 = json_decode($request->subcategory2, true) ?? [];

            // ═══════════════════════════════════════════════════════
            // 📸 GESTION DES PHOTOS
            // ═══════════════════════════════════════════════════════
            $imagePaths = [];

            foreach (['photo1', 'photo2', 'photo3', 'photo4'] as $photoKey) {
                if ($request->hasFile($photoKey) && $request->file($photoKey)->isValid()) {
                    $file = $request->file($photoKey);

                    $destinationPath = public_path('assets/mission');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $fileName = $photoKey . '_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $fileName);
                    $imagePaths[] = 'assets/mission/' . $fileName;
                }
            }

            // ═══════════════════════════════════════════════════════
            // ✅ CRÉATION DE LA MISSION (AVEC GDPR)
            // ═══════════════════════════════════════════════════════
            $mission = Mission::create([
                'requester_id' => $user->id,
                'category_id' => $category['id'] ?? null,
                'subcategory_id' => $subcategory['id'] ?? null, 
                'subsubcategory_id' => $subcategory2['id'] ?? null,
                'title' => strip_tags($request->requestTitle),
                'description' => strip_tags($request->moreDetails),
                'budget_min' => null,
                'budget_max' => null,
                'budget_currency' => 'EUR',
                'service_duration' => $request->serviceDuration ?? null,
                'location_country' => $request->countryNeed,
                'location_city' => strip_tags($request->currentCity),
                'is_remote' => $request->supportOnline === 'yes',
                'language' => $request->input('languages.0') ?? null,
                'urgency' => $urgency,
                'status' => 'published',
                'selected_provider_id' => null,
                'payment_status' => 'unpaid',
                'is_fake' => false,
                'attachments' => json_encode($imagePaths),
                
                // ✅ GDPR: Tracking consentement CGV
                'terms_accepted' => $request->filled('terms_accepted_at') ? true : null,
                'terms_accepted_at' => $request->terms_accepted_at ?? null,
                'terms_version' => $request->terms_version ?? null,
                'terms_accepted_ip' => $request->ip(),
            ]);

            Log::info('✅ [FORM] Mission created', [
                'mission_id' => $mission->id,
                'user_id' => $user->id
            ]);

            // ✅ GDPR: Logger pour audit trail
            if ($request->filled('terms_accepted_at')) {
                Log::info('📋 [GDPR] Consent recorded', [
                    'mission_id' => $mission->id,
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'terms_version' => $request->terms_version,
                    'accepted_at' => $request->terms_accepted_at,
                    'ip_address' => $request->ip(),
                ]);
            }

            // ═══════════════════════════════════════════════════════
            // 🔐 AUTO-LOGIN (si pas encore connecté)
            // ═══════════════════════════════════════════════════════
            if (!auth()->check()) {
                \Auth::login($user, true);
                $request->session()->regenerate();
                $user->update(['last_login_at' => now()]); 
                
                $cookieName = 'user_session_' . $user->id;
                $cookieValue = encrypt($user->id . '|' . now()->timestamp);
                cookie()->queue($cookieName, $cookieValue, 60 * 24 * 30);
                
                Log::info('🔐 [FORM] User auto-logged in', ['user_id' => $user->id]);
            }

            // ═══════════════════════════════════════════════════════
            // 📧 ENVOI D'EMAILS AUX PRESTATAIRES MATCHÉS
            // ═══════════════════════════════════════════════════════
            try {
                $topProviders = ProviderMatcher::topForMission($mission, 10);
                
                foreach ($topProviders as $sp) {
                    if ($sp->match_score < 0.50) continue;
                    
                    $to = $sp->email ?: optional($sp->user)->email;
                    if (!$to) continue;
                    
                    Mail::to($to)->queue(new MissionInviteMail($mission, $sp, $sp->match_score));
                }
                
                Log::info('📧 [FORM] Emails queued', [
                    'providers_count' => $topProviders->count()
                ]);
            } catch (\Exception $e) {
                Log::error('📧 [FORM] Email error (non-blocking)', [
                    'error' => $e->getMessage()
                ]);
                // Ne pas bloquer la soumission si emails échouent
                $topProviders = collect();
            }
            
            // ═══════════════════════════════════════════════════════
            // ✅ RETOUR SUCCÈS
            // ═══════════════════════════════════════════════════════
            Log::info('🎉 [FORM] Request completed successfully', [
                'mission_id' => $mission->id
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Your request has been submitted successfully!',
                'mission_id' => $mission->id,
                'top_providers' => $topProviders->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'name' => trim(($p->first_name ?? '') . ' ' . ($p->last_name ?? '')),
                        'email' => $p->email ?? optional($p->user)->email,
                        'score' => $p->match_score,
                    ];
                }),
            ]);
            
        } catch (\Exception $e) {
            Log::error('💥 [FORM] Unexpected error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again.'
            ], 500);
        }
    }

    /**
     * Générer un lien d'affiliation
     */
    private function generateAffiliateLink($email, $first, $last = null)
    {
        $emailPart = $email ? explode('@', $email)[0] : 'user';
        $base = $first . $last . $emailPart . rand(100, 999);
        $slug = strtolower(Str::slug($base));
        return $slug ?: 'user-' . rand(1000, 9999);
    }

    /**
     * Récupérer les sous-catégories d'une catégorie
     */
    public function getSubcategories($categoryId)
    {
        $subcategories = Category::where('parent_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    /**
     * Récupérer les missions filtrées
     */
    public function getMissions(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategoryId = $request->input('subcategory_id');
        $country = $request->input('country');
        $language = $request->input('language');
        
        $missions = Mission::where('category_id', $categoryId)
            ->where('subcategory_id', $subcategoryId)
            ->where('location_country', $country)
            ->where('language', $language)
            ->where('status', 'published')
            ->with(['category', 'subcategory', 'requester'])
            ->get();
            
        return response()->json($missions);
    }

    /**
     * ✅ ANNULER UNE DEMANDE DE MISSION (PAR LE REQUESTER) - AVEC SOFT DELETE
     */
    public function cancelMissionRequest(Request $request) 
    {
        // ═══════════════════════════════════════════════════════
        // 📊 LOGS : Entrée de la requête
        // ═══════════════════════════════════════════════════════
        Log::info('🔴 [CANCEL] Cancel request received', [
            'mission_id' => $request->mission_id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
        ]);

        // ═══════════════════════════════════════════════════════
        // 🛡️ VALIDATION DES DONNÉES
        // ═══════════════════════════════════════════════════════
        $validated = $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cancelled_by' => 'required|in:requester,provider,admin',
            'cancelled_on' => 'required|date',
        ]);

        try {
            // ═══════════════════════════════════════════════════════
            // 🔍 RÉCUPÉRATION DE LA MISSION
            // ═══════════════════════════════════════════════════════
            $mission = Mission::findOrFail($request->mission_id);
            
            // ✅ Vérification des permissions
            if ($mission->requester_id !== auth()->id()) {
                Log::warning('⚠️ [CANCEL] Unauthorized access attempt', [
                    'mission_id' => $mission->id,
                    'mission_owner' => $mission->requester_id,
                    'attempting_user' => auth()->id(),
                ]);
                
                return response()->json([
                    'success' => false,
                    'error' => 'Unauthorized - You can only cancel your own missions'
                ], 403);
            }

            Log::info('🔍 [CANCEL] Mission found', [
                'mission_id' => $mission->id,
                'status' => $mission->status,
                'payment_status' => $mission->payment_status,
            ]);

            // ═══════════════════════════════════════════════════════
            // 🎯 CAS 1 : Mission publiée, pas encore payée → SOFT DELETE
            // ═══════════════════════════════════════════════════════
            if ($mission->payment_status === 'unpaid' && $mission->status === 'published') {
                
                Log::info('🗑️ [CANCEL] Case 1: Published & Unpaid - Soft deleting');
                
                // Enregistrer la raison AVANT de supprimer
                MissionCancellationReason::create([
                    'mission_id' => $mission->id,
                    'cancelled_by' => $request->cancelled_by,
                    'reason' => $request->reason,
                    'email_sent' => false,
                    'custum_description' => $request->description ?? null,
                ]);

                // Mettre à jour les infos d'annulation
                $mission->cancelled_by = $request->cancelled_by;
                $mission->cancelled_on = Carbon::parse($request->cancelled_on);
                $mission->status = 'cancelled_by_requester';
                $mission->save();

                // ✅ SOFT DELETE : La mission disparaît de l'interface mais reste en BDD
                $mission->delete();

                Log::info('✅ [CANCEL] Mission soft deleted', [
                    'mission_id' => $mission->id
                ]);

                return response()->json([
                    'success' => true, 
                    'message' => 'Mission cancelled and removed successfully'
                ], 200);
            }

            // ═══════════════════════════════════════════════════════
            // 🎯 CAS 2 : Mission payée, en attente de début → REMBOURSEMENT + SOFT DELETE
            // ═══════════════════════════════════════════════════════
            if ($mission->status === 'waiting_to_start' && $mission->payment_status === 'paid') {
                
                Log::info('💰 [CANCEL] Case 2: Waiting to start & Paid - Refunding and soft deleting');
                
                try {
                    // Rembourser
                    $this->refundMissionPayment($mission, $request);
                    
                    // Enregistrer la raison
                    MissionCancellationReason::create([
                        'mission_id' => $mission->id,
                        'cancelled_by' => $request->cancelled_by,
                        'reason' => $request->reason,
                        'email_sent' => false,
                        'custum_description' => $request->description ?? null,
                    ]);

                    // Mettre à jour avant suppression
                    $mission->cancelled_by = $request->cancelled_by;
                    $mission->cancelled_on = Carbon::parse($request->cancelled_on);
                    $mission->status = 'cancelled_by_requester';
                    $mission->save();

                    // ✅ SOFT DELETE
                    $mission->delete();

                    Log::info('✅ [CANCEL] Mission refunded and soft deleted', [
                        'mission_id' => $mission->id
                    ]);

                    return response()->json([
                        'success' => true, 
                        'message' => 'Mission cancelled with refund and removed successfully'
                    ], 200);
                    
                } catch (\Exception $e) {
                    Log::error('💥 [CANCEL] Refund failed', [
                        'mission_id' => $mission->id,
                        'error' => $e->getMessage()
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'error' => 'Refund failed: ' . $e->getMessage()
                    ], 500);
                }
            }

            // ═══════════════════════════════════════════════════════
            // 🎯 CAS 3 : Mission en cours → LITIGE (PAS DE SUPPRESSION)
            // ═══════════════════════════════════════════════════════
            if ($mission->status === 'in_progress') {
                
                Log::info('🚧 [CANCEL] Case 3: In progress - Creating dispute (NO DELETION)');
                
                try {
                    MissionCancellationReason::create([
                        'mission_id' => $mission->id,
                        'cancelled_by' => $request->cancelled_by,
                        'reason' => $request->reason,
                        'email_sent' => false,
                        'custum_description' => $request->description ?? null,
                    ]);

                    $mission->update([
                        'status' => 'disputed',
                        'payment_status' => 'held',
                        'cancelled_by' => $request->cancelled_by,
                        'cancelled_on' => Carbon::parse($request->cancelled_on),
                    ]);

                    // ⚠️ PAS DE SUPPRESSION : reste visible pour résolution du litige

                    Log::info('✅ [CANCEL] Mission marked as disputed (kept visible)', [
                        'mission_id' => $mission->id
                    ]);

                    return response()->json([
                        'success' => true, 
                        'message' => 'Mission marked as disputed successfully'
                    ], 200);
                    
                } catch (\Exception $e) {
                    Log::error('💥 [CANCEL] Failed to create dispute', [
                        'mission_id' => $mission->id,
                        'error' => $e->getMessage()
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'error' => 'Cancellation failed: ' . $e->getMessage()
                    ], 500);
                }
            }

            // ═══════════════════════════════════════════════════════
            // ❌ CAS PAR DÉFAUT : Mission non annulable
            // ═══════════════════════════════════════════════════════
            Log::warning('⚠️ [CANCEL] Mission cannot be cancelled', [
                'mission_id' => $mission->id,
                'status' => $mission->status,
                'payment_status' => $mission->payment_status,
            ]);
            
            return response()->json([
                'success' => false,
                'error' => 'Mission cannot be cancelled at this stage',
                'current_status' => $mission->status,
                'payment_status' => $mission->payment_status,
            ], 400);
            
        } catch (\Exception $e) {
            Log::error('💥 [CANCEL] Unexpected error', [
                'mission_id' => $request->mission_id ?? null,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            
            return response()->json([
                'success' => false,
                'error' => 'An unexpected error occurred while cancelling the mission'
            ], 500);
        }
    }

    /**
     * Annuler une mission (par le provider)
     */
    public function providerCancelMisssion(Request $request) 
    {
        $request->validate([
            'mission_id' => 'required|exists:missions,id',
            'reason' => 'required|string|max:255',
            'cancelled_by' => 'required|in:requester,provider,admin',
            'cancelled_on' => 'required|date',
        ]);

        $mission = Mission::findOrFail($request->mission_id);
        $provider = $mission->selectedProvider;
        
        if ($mission) {
            $this->refundMissionPayment($mission, $request);
            
            MissionCancellationReason::create([
                'mission_id' => $mission->id,
                'cancelled_by' => $request->cancelled_by,
                'reason' => $request->reason,
                'email_sent' => false,
                'custum_description' => $request->description ?? null,
            ]);
            
            $this->ReputationPointService->updateReputationPointsBasedOnMissionCancellationByProvider($provider);
        }
        
        return response()->json([
            'success' => true,  
            'message' => 'Mission canceled successfully'
        ]);
    }

    /**
     * Rembourser le paiement d'une mission
     */
    private function refundMissionPayment($mission, $request) 
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $transaction = $mission->transactions()
            ->where('status', 'paid')
            ->first();
            
        $paymentIntent = PaymentIntent::retrieve($transaction->stripe_payment_intent_id);
        
        $refundAmountInCents = ($paymentIntent->metadata->mission_amount ?? null) * 100;
        $user = $mission->requester;

        if ($user) {
            $user->increment('credit_balance', $transaction->client_fee);
        }

        if (!$refundAmountInCents) {
            return response()->json([
                'error' => 'Refund amount not found in metadata'
            ], 400);
        }

        $refund = Refund::create([
            'payment_intent' => $paymentIntent->id,
            'amount' => (int) $refundAmountInCents,
        ]);
        
        if ($refund->status !== 'succeeded') {
            return response()->json(['error' => 'Refund failed'], 500);
        }

        MissionOffer::where('provider_id', $mission->selected_provider_id)
            ->where('mission_id', $mission->id)
            ->first()
            ?->delete();
            
        $mission->status = 'published';
        $mission->payment_status = 'unpaid';
        $mission->selected_provider_id = null;
        $mission->cancelled_by = $request->cancelled_by;
        $mission->cancelled_on = Carbon::parse($request->cancelled_on);
        $mission->save();
        
        $transaction->update(['status' => 'refunded']); 
    }
}