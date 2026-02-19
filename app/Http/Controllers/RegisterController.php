<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\ServiceProvider;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Services\GeolocationService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /**
     * ═══════════════════════════════════════════════════════════
     * 🔐 PROVIDER REGISTRATION (WIZARD FINAL STEP)
     * ═══════════════════════════════════════════════════════════
     * ⚠️ RÈGLES PASSWORD: Min 8 chars + 1 majuscule + 1 chiffre
     */
    public function register(Request $request)
    {
        // ═══════════════════════════════════════════════════════════
        // 🔐 VALIDATION DU PASSWORD
        // Min 8 caractères, majuscule, chiffre
        // ═══════════════════════════════════════════════════════════
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',             // At least one uppercase
                'regex:/[0-9]/',             // At least one digit
            ],
            'email' => 'required|email|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ], [
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.regex' => 'Password must contain at least one uppercase letter and one number',
        ]);

        $expats = $request->all();
        $ip = $request->ip();
        $geoLocationService = new GeolocationService();
        $countryName = $geoLocationService->getCountryFromRequest($request);

        // ═══════════════════════════════════════════════════════════
        // 🔑 USER DÉJÀ CONNECTÉ (via verifyEmailOtp au step 15)
        // ═══════════════════════════════════════════════════════════
        $user = Auth::user();
        
        if (!$user) {
            // Fallback : chercher par email et reconnecter
            $user = User::where('email', $expats['email'])->first();
            
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found. Please verify your email first.',
                ], 404);
            }
            
            // Reconnecter si session perdue
            Auth::login($user, true);
            $request->session()->regenerate();
        }

        // ═══════════════════════════════════════════════════════════
        // 📸 PROFILE IMAGE (avant transaction — filesystem non rollbackable)
        // ═══════════════════════════════════════════════════════════
        $profileImagePath = null;
        if (!empty($expats['profile_image'])) {
            $profileImagePath = saveBase64Image($expats['profile_image'], 'assets/profileImages', 'profile-' . $user->id);
        }

        // ═══════════════════════════════════════════════════════════
        // 📄 DOCUMENTS (avant transaction — filesystem non rollbackable)
        // ═══════════════════════════════════════════════════════════
        $documents = [];
        $docTypes = ['passport', 'european_id', 'license'];
        foreach ($docTypes as $docType) {
            if (!empty($expats['documents'][$docType])) {
                $docData = $expats['documents'][$docType];
                $docArr = [];
                if (isset($docData['image'])) {
                    $docArr['image'] = saveBase64Image($docData['image'], 'assets/userDocs/docs-' . $user->id, $docType);
                }
                if (isset($docData['front'])) {
                    $docArr['front'] = saveBase64Image($docData['front'], 'assets/userDocs/docs-' . $user->id, $docType . '-front');
                }
                if (isset($docData['back'])) {
                    $docArr['back'] = saveBase64Image($docData['back'], 'assets/userDocs/docs-' . $user->id, $docType . '-back');
                }
                $docArr['uploaded_at'] = $docData['uploaded_at'] ?? now();
                $documents[$docType] = $docArr;
            }
        }

        // ═══════════════════════════════════════════════════════════
        // 🏗️ PRÉPARER LES DONNÉES PROVIDER
        // ═══════════════════════════════════════════════════════════
        $categoriesMetaData = isset($expats['provider_subcategories']) ? json_encode($expats['provider_subcategories']) : null;
        $categoriesArray = json_decode($categoriesMetaData, true);
        $category = array_keys($categoriesArray);
        $subcategoryArray = [];
        $subcategory = array_values($categoriesArray);
        foreach ($subcategory as $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    $subcategoryArray[] = $subValue;
                }
            } elseif (is_string($value)) {
                $subcategoryArray[] = json_encode($value);
            } else {
                $subcategoryArray[] = $value;
            }
        }

        $slug = $this->generateSlug($expats, $countryName);
        $countryCoords = Country::where('country', $expats['location'])->first();
        $coords = $countryCoords->coordinates ?? null;

        // ═══════════════════════════════════════════════════════════
        // 💾 TRANSACTION DB : mise à jour user + création provider
        // ═══════════════════════════════════════════════════════════
        $provider = DB::transaction(function () use ($user, $expats, $profileImagePath, $documents, $slug, $countryName, $ip, $coords, $category, $subcategoryArray) {

            // Mettre à jour le password et les infos user
            if (!empty($expats['password'])) {
                $user->password = Hash::make($expats['password']);
            }
            $user->user_role = 'service_provider';
            $user->status = 'active';
            $user->name = trim(($expats['first_name'] ?? '') . ' ' . ($expats['last_name'] ?? ''));
            $user->country = $countryName;
            $user->preferred_language = $expats['native_language'] ?? null;
            $user->last_login_at = now();
            $user->save();

            // Vérifier si provider existe déjà (dans la transaction pour éviter les races)
            $existing = ServiceProvider::where('user_id', $user->id)->first();
            if ($existing) {
                return $existing;
            }

            // Créer le provider
            return ServiceProvider::create([
                'user_id' => $user->id,
                'first_name' => $expats['first_name'] ?? null,
                'last_name' => $expats['last_name'] ?? null,
                'native_language' => $expats['native_language'] ?? null,
                'spoken_language' => $expats['spoken_language'],
                'services_to_offer' => json_encode($category) ?? null,
                'services_to_offer_category' => json_encode($subcategoryArray) ?? null,
                'provider_address' => $expats['location'] ?? null,
                'operational_countries' => $expats['operational_countries'] ?? null,
                'communication_online' => $this->truthy($expats, 'communication_preference.Online'),
                'communication_inperson' => $this->truthy($expats, 'communication_preference.In Person'),
                'profile_description' => $expats['profile_description'] ?? null,
                'profile_photo' => $profileImagePath,
                'provider_docs' => null,
                'phone_number' => $expats['phone_number'] ?? null,
                'country' => $countryName,
                'preferred_language' => $expats['native_language'] ?? null,
                'special_status' => isset($expats['special_status']) ? json_encode($expats['special_status']) : null,
                'email' => $expats['email'],
                'documents' => !empty($documents) ? json_encode($documents) : null,
                'ip_address' => $ip,
                'slug' => $slug,
                'country_coords' => $coords,
                'city_coords' => null,
            ]);
        });

        // Régénérer la session après mise à jour user
        $request->session()->regenerate();
        
        // ═══════════════════════════════════════════════════════════
        // 💳 STRIPE CONNECT
        // ═══════════════════════════════════════════════════════════
        if (!$provider->stripe_account_id) {
            try {
                $stripeAccount = $this->createStripeConnectCustomAccount($provider);
                $provider->stripe_account_id = $stripeAccount['account_id'];
                $provider->kyc_status = $stripeAccount['isKYCCompele'] ? 'verified' : 'pending';
                $provider->stripe_chg_enabled = $stripeAccount['isKYCCompele'] ? true : false;
                $provider->stripe_pts_enabled = $stripeAccount['isKYCCompele'] ? true : false;
                $provider->kyc_link = $stripeAccount['onboarding_url'] ?? null;
                $provider->save();
            } catch (\Exception $e) {
                \Log::error('Stripe account creation failed: ' . $e->getMessage());
            }
        }

        // S'assurer que le user est toujours connecté
        if (!Auth::check()) {
            Auth::login($user, true);
            $request->session()->regenerate();
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'provider' => $provider,
            'message' => 'Registration successful!',
            'redirect' => url('/dashboard')
        ]);
    }
    
    private function generateSlug($expats, $country)
    {
        $firstName = Str::slug($expats['first_name'] ?? '');
        $language = Str::slug($expats['native_language'] ?? '');
        $countrySlug = Str::slug($country);
        $baseSlug = $firstName .  '-' . $countrySlug . '-' . $language . '-' . Str::random(6);
        $slug = $baseSlug;
        return $slug;
    }

    public function signupRegister(Request $request)
    {
        try {
            $affiliateCode = $request->input('affiliate_code');
            $referrer = User::where('affiliate_code', $affiliateCode)->first();
            
            // 🔐 VALIDATION DU PASSWORD
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[A-Z]/',             // At least one uppercase
                    'regex:/[0-9]/',             // At least one digit
                ],
                'gender' => 'nullable|in:Male,Female'
            ], [
                'password.min' => 'Password must be at least 8 characters',
                'password.regex' => 'Password must contain at least one uppercase letter and one number',
            ]);

            if (User::where('email', $request->input('email'))->exists()) {
                return redirect()->back()->with('error', 'A user with this email already exists.');
            }

            $affiliateLink = $this->generateAffiliateLink($request->input('email') ?? '', $request->input('name') ?? '', $request->input('last_name') ?? '');

            $user = DB::transaction(function () use ($request, $referrer, $affiliateLink) {
                $user = new User([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'affiliate_code' => $affiliateLink,
                    'gender' => $request->input('gender'),
                    'referred_by' => $referrer ? $referrer->id : null,
                    'email_verified_at' => now(),
                    'last_login_at' => now(),
                ]);
                // Champs hors fillable — assignation directe
                $user->status = 'active';
                $user->user_role = 'service_requester';
                $user->save();
                return $user;
            });

            Auth::login($user);

            return view('dashboard.dashboard-index', [
                'user' => $user,
                'title' => 'Dashboard',
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    private function truthy($array, $keyPath)
    {
        $value = data_get($array, $keyPath, false);
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    private function generateAffiliateLink($email, $first, $last)
    {
        $base = $first . $last . explode('@', $email)[0] . rand(100, 999);
        $slug = strtolower(Str::slug($base));
        return $slug;
    }

    // ═══════════════════════════════════════════════════════════
    // 📧 ENVOYER OTP AU STEP 13
    // ═══════════════════════════════════════════════════════════
    public function sendEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => 'Temp User',
                'password' => Hash::make(Str::random(16)),
            ]
        );
        // Champs hors fillable — assignation directe sur création uniquement
        if ($user->wasRecentlyCreated) {
            $user->status = 'pending';
            $user->user_role = 'service_provider';
            $user->save();
        }

        $otp = random_int(100000, 999999);

        // ✅ SECURITY: Hash OTP before storing (like passwords)
        EmailVerification::updateOrCreate(
            ['user_id' => $user->id, 'email' => $request->email],
            [
                'otp' => Hash::make($otp),
                'is_verified' => false,
                'created_at' => now()
            ]
        );

        Mail::raw(
            "Your verification code is: {$otp}\n\nThis code is valid for 10 minutes.",
            function ($message) use ($user) {
                $fromAddress = config('mail.from.address') ?: 'noreply@ulixai.com';
                $fromName = config('mail.from.name') ?: 'Ulixai';
                $message->to($user->email)
                        ->from($fromAddress, $fromName)
                        ->subject('Email Verification Code - Ulixai');
            }
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Verification code sent to your email.'
        ]);
    }

    // ═══════════════════════════════════════════════════════════
    // ✅ VÉRIFIER OTP AU STEP 15 + AUTO-LOGIN
    // 🔐 SECURITY: Limited attempts to prevent brute-force
    // ═══════════════════════════════════════════════════════════
    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'otp' => 'required|string|size:6|regex:/^[0-9]+$/' // Only digits
        ]);

        // ✅ SECURITY: Find by email only, then verify hashed OTP
        $verification = EmailVerification::where('email', $request->email)
            ->where('is_verified', false)
            ->first();

        if (!$verification) {
            return response()->json([
                'status' => 'error',
                'message' => 'No pending verification found. Please request a new code.'
            ], 422);
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Check if account is locked due to too many attempts
        // ═══════════════════════════════════════════════════════════
        if ($verification->isLocked()) {
            $remainingMinutes = ceil($verification->getLockoutRemainingSeconds() / 60);
            return response()->json([
                'status' => 'error',
                'message' => "Too many failed attempts. Please try again in {$remainingMinutes} minutes.",
                'locked_until' => $verification->locked_until->toIso8601String(),
            ], 429);
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Check OTP expiration
        // ═══════════════════════════════════════════════════════════
        if ($verification->isExpired()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Code expired. Please request a new one.'
            ], 422);
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Verify OTP hash - increment attempts on failure
        // ═══════════════════════════════════════════════════════════
        if (!Hash::check($request->otp, $verification->otp)) {
            $isNowLocked = $verification->incrementAttempts();
            $remainingAttempts = $verification->getRemainingAttempts();

            if ($isNowLocked) {
                \Log::warning('OTP verification locked due to too many attempts', [
                    'email' => $request->email,
                    'ip' => $request->ip(),
                    'attempts' => $verification->attempts,
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Too many failed attempts. Your verification has been locked for ' . EmailVerification::LOCKOUT_MINUTES . ' minutes.',
                ], 429);
            }

            return response()->json([
                'status' => 'error',
                'message' => "Invalid code. {$remainingAttempts} attempts remaining.",
                'remaining_attempts' => $remainingAttempts,
            ], 422);
        }

        // ═══════════════════════════════════════════════════════════
        // ✅ SUCCESS: Mark as verified and reset attempts
        // ═══════════════════════════════════════════════════════════
        $verification->is_verified = true;
        $verification->verified_at = now();
        $verification->resetAttempts();

        // Mettre à jour le user
        $user = $verification->user;
        if ($user && !$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        // ✅ AUTO-LOGIN ICI - Le user reste dans le wizard
        Auth::login($user, true);
        $request->session()->regenerate();
        $user->update(['last_login_at' => now()]);

        \Log::info('OTP verification successful', [
            'email' => $request->email,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Email verified successfully.'
        ]);
    }

    public function resendEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'No user found with this email.'
            ], 404);
        }

        $otp = random_int(100000, 999999);
        // ✅ SECURITY: Hash OTP before storing (like passwords)
        EmailVerification::updateOrCreate(
            ['user_id' => $user->id, 'email' => $user->email],
            ['otp' => Hash::make($otp), 'is_verified' => false, 'created_at' => now()]
        );

        Mail::raw(
            "Welcome to Ulixai!\n\nYour new verification code is: {$otp}\n\nPlease enter this code to verify your email address.",
            function ($message) use ($user) {
                $fromAddress = config('mail.from.address') ?: 'noreply@ulixai.com';
                $fromName = config('mail.from.name') ?: 'Ulixai';
                $message->to($user->email)
                        ->from($fromAddress, $fromName)
                        ->subject('Ulixai - New Email Verification Code');
            }
        );

        return response()->json([
            'status' => 'success',
            'message' => 'A new verification code has been sent to your email.'
        ]);
    }

    private function createStripeConnectCustomAccount(ServiceProvider $provider)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $country = Country::where('country', $provider->provider_address)->first();
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $token = $stripe->tokens->create([
            'account' => [
                'business_type' => 'individual',
                'individual' => [
                    'first_name' => $provider->first_name,
                    'last_name' => $provider->last_name,
                    'email' => $provider->email,
                ],
                'tos_shown_and_accepted' => true,
            ],
        ]);
        $account = $stripe->accounts->create([
            'type' => 'custom',
            'country' => $country ? $country->short_name : 'FR',
            'email' => $provider->email,
            'account_token' => $token->id,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_profile' => [
                'product_description' => 'Ulixai Service Provider',
            ],
        ]);

        if (!$account->details_submitted) {
           
            $accountLink = $stripe->accountLinks->create([
                'account' => $account->id,
                'refresh_url' => route('stripe.refresh'), 
                'return_url' => route('stripe.return'),
                'type' => 'account_onboarding',
            ]);
            return [
                'account_id' => $account->id,
                'onboarding_url' => $accountLink->url,
                'isKYCCompele' => false
            ];
        }

        return [
            'account_id' => $account->id,
            'onboarding_url' => null,
            'isKYCCompele' => true
        ];
    }
}