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


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $expats = $request->all();
        $ip = $request->ip();
        $geoLocationService = new GeolocationService();
        $countryName = $geoLocationService->getCountryFromRequest($request);

        // ═══════════════════════════════════════════════════════════
        // 🔑 USER DÉJÀ CONNECTÉ (via verifyEmailOtp)
        // ═══════════════════════════════════════════════════════════
        $user = Auth::user();
        
        if (!$user) {
            // Fallback : chercher par email
            $user = User::where('email', $expats['email'])->first();
            
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found. Please verify your email first.',
                ], 404);
            }
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 METTRE À JOUR LE PASSWORD
        // ═══════════════════════════════════════════════════════════
        if (!empty($expats['password'])) {
            $user->password = Hash::make($expats['password']);
        }
        
        // Mettre à jour le statut et autres infos
        $user->user_role = 'service_provider';
        $user->status = 'active';
        $user->name = trim(($expats['first_name'] ?? '') . ' ' . ($expats['last_name'] ?? ''));
        $user->country = $countryName;
        $user->preferred_language = $expats['native_language'] ?? null;
        $user->last_login_at = now();
        $user->save();

        // ═══════════════════════════════════════════════════════════
        // 📸 PROFILE IMAGE
        // ═══════════════════════════════════════════════════════════
        $profileImagePath = null;
        if (!empty($expats['profile_image'])) {
            $profileImagePath = saveBase64Image($expats['profile_image'], 'assets/profileImages', 'profile-' . $user->id);
        }

        // ═══════════════════════════════════════════════════════════
        // 📄 DOCUMENTS
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
        // 🏢 CRÉER OU METTRE À JOUR LE PROVIDER
        // ═══════════════════════════════════════════════════════════
        $provider = ServiceProvider::where('user_id', $user->id)->where('email', $expats['email'])->first();

        if($provider) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'provider' => $provider,
                'message' => 'Provider Already Exists',
            ]);
        }
        
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
       
        $provider = ServiceProvider::create([
            'user_id' => $user->id,
            'first_name' => $expats['first_name'] ?? null,
            'last_name' => $expats['last_name'] ?? null,
            'native_language' => $expats['native_language'] ?? null,
            'spoken_language' => $expats['spoken_language'],
            'services_to_offer' =>  json_encode($category) ?? null,
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
            'city_coords' => null 
        ]);
        
        // ═══════════════════════════════════════════════════════════
        // 💳 STRIPE CONNECT
        // ═══════════════════════════════════════════════════════════
        if (!$provider->stripe_account_id) {
            $stripeAccount = $this->createStripeConnectCustomAccount($provider);
            $provider->stripe_account_id = $stripeAccount['account_id'];
            $provider->kyc_status = $stripeAccount['isKYCCompele'] ? 'verified' : 'pending';
            $provider->stripe_chg_enabled = $stripeAccount['isKYCCompele'] ? true : false;
            $provider->stripe_pts_enabled = $stripeAccount['isKYCCompele'] ? true : false;
            $provider->kyc_link = $stripeAccount['onboarding_url'] ?? null;
            $provider->save();
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
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'gender' => 'nullable|in:Male,Female'
            ]);

            if (User::where('email', $request->input('email'))->exists()) {
                return redirect()->back()->with('error', 'A user with this email already exists.');
            }

            $affiliateLink = $this->generateAffiliateLink($request->input('email') ?? '', $request->input('name') ?? '', $request->input('last_name') ?? '');
            
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'user_role' => 'service_requester',
                'status' => 'active',
                'affiliate_code' => $affiliateLink,
                'gender' => $request->input('gender'),
                'referred_by' => $referrer ? $referrer->id : null,
                'email_verified_at' => now()
            ]);

            Auth::login($user);
            $user->update(['last_login_at' => now()]);

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

        // Chercher ou créer un user temporaire
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => 'Temp User',
                'password' => Hash::make(Str::random(16)),
                'user_role' => 'service_provider',
                'status' => 'pending'
            ]
        );

        // Générer OTP
        $otp = random_int(100000, 999999);
        
        // Sauvegarder avec expiration 10 min
        EmailVerification::updateOrCreate(
            ['user_id' => $user->id, 'email' => $request->email],
            [
                'otp' => $otp,
                'is_verified' => false,
                'created_at' => now()
            ]
        );

        // Envoyer email
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
    // ═══════════════════════════════════════════════════════════
    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('is_verified', false)
            ->first();

        if (!$verification) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired code.'
            ], 422);
        }

        // Vérifier expiration (10 minutes)
        if ($verification->created_at->addMinutes(10)->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Code expired. Please request a new one.'
            ], 422);
        }

        // Marquer comme vérifié
        $verification->is_verified = true;
        $verification->verified_at = now();
        $verification->save();
        
        // Mettre à jour le user
        $user = $verification->user;
        if ($user && !$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }
        
        // ✅ AUTO-LOGIN ICI
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();
        Auth::user()->update(['last_login_at' => now()]);
        
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
        $verification = EmailVerification::updateOrCreate(
            ['user_id' => $user->id, 'email' => $user->email],
            ['otp' => $otp, 'is_verified' => false]
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