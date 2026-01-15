<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Country;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Mission;
use App\Models\Transaction;
use App\Models\Conversation;
use App\Models\MissionOffer;
use App\Http\Requests\User\UpdatePersonalInfoRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ServiceProviderResource;

class AccountController extends Controller
{
    public function index(Request $request) {
        return view('dashboard.account.my-account');
    }

    public function personalInfo(Request $request) {
        $user = auth()->user();
        $countries = Country::where('status', 1)->get();

        $languages = ['Afrikaans','Albanian','Amharic','Arabic','Armenian','Azerbaijani','Basque','Belarusian','Bengali','Bosnian','Bulgarian','Catalan','Chinese (Simplified)','Chinese (Traditional)','Croatian','Czech','Danish','Dutch','English','Estonian','Filipino','Finnish','French','Galician','Georgian','German','Greek','Gujarati','Hausa','Hebrew','Hindi','Hungarian','Icelandic','Igbo','Indonesian','Irish','Italian','Japanese','Javanese','Kannada','Kazakh','Khmer','Korean','Kurdish','Kyrgyz','Lao','Latin','Latvian','Lithuanian','Luxembourgish','Macedonian','Malagasy','Malay','Malayalam','Maltese','Maori','Marathi','Mongolian','Myanmar (Burmese)','Nepali','Norwegian','Pashto','Persian','Polish','Portuguese','Punjabi','Romanian','Russian','Samoan','Serbian','Sesotho','Shona','Sindhi','Sinhala','Slovak','Slovenian','Somali','Spanish','Sundanese','Swahili','Swedish','Tajik','Tamil','Telugu','Thai','Turkish','Ukrainian','Urdu','Uzbek','Vietnamese','Welsh','Xhosa','Yiddish','Yoruba','Zulu'];

        $provider = null;
        if ($user->user_role === 'service_provider') {
            
            $provider = $user->serviceProvider;
        }
        return view('dashboard.account.my-personal-info', compact('user', 'provider', 'countries', 'languages'));
    }


    public function updatePersonalInfo(UpdatePersonalInfoRequest $request)
    {
        try {
            $user = Auth::user();

            // Security: Prevent unauthorized access to other users' data
            if ($request->has('user_id') && $request->user_id != $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            // Update user information
            $userData = [
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'country' => $request->country,
                'preferred_language' => $request->preferred_language,
                'email' => $request->email,
            ];

            // Add phone number if provided
            if ($request->whatsapp_number) {
                $userData['phone_number'] = $request->whatsapp_number;
            }

            $user->update(array_filter($userData));

            // Update service provider information if applicable
            if ($user->user_role === 'service_provider' && $user->serviceProvider) {
                $providerData = [];
                
                if ($request->provider_native_language) {
                    $providerData['native_language'] = $request->provider_native_language;
                }
                
                if ($request->spoken_languages) {
                    $providerData['spoken_language'] = $request->spoken_languages;
                }

                if (!empty($providerData)) {
                    $user->serviceProvider->update($providerData);
                }
            }

            $freshUser = $user->fresh();

            return response()->json([
                'success' => true,
                'message' => 'Personal information updated successfully',
                'data' => [
                    'user' => new UserResource($freshUser),
                    'service_provider' => $freshUser->user_role === 'service_provider'
                        ? new ServiceProviderResource($freshUser->serviceProvider)
                        : null
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating information',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update individual field
     */
    public function updateField(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Get the field name and value
            $allowedFields = ['email', 'whatsapp_number'];
            $fieldName = null;
            $fieldValue = null;

            foreach ($allowedFields as $field) {
                if ($request->has($field)) {
                    $fieldName = $field;
                    $fieldValue = $request->input($field);
                    break;
                }
            }

            if (!$fieldName) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid field provided'
                ], 400);
            }

            // Validation based on field
            $rules = [];
            switch ($fieldName) {
                case 'email':
                    $rules['email'] = [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($user->id)
                    ];
                    break;
                case 'whatsapp_number':
                    $rules['whatsapp_number'] = 'nullable|string|max:20';
                    break;
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Update the field
            if ($fieldName === 'whatsapp_number') {
                $user->update(['phone_number' => $fieldValue]);
            } else {
                $user->update([$fieldName => $fieldValue]);
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst(str_replace('_', ' ', $fieldName)) . ' updated successfully',
                'data' => [
                    'field' => $fieldName,
                    'value' => $fieldValue
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the field',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user profile information
     */
    public function getProfile()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $data = [
                'user' => $user
            ];

            if ($user->user_role === 'service_provider' && $user->serviceProvider) {
                $data['service_provider'] = $user->serviceProvider;
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update password
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $user = Auth::user();

            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 400);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating password',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function myDocuments(Request $request) {
        $user = Auth::user();
        $provider = $user->serviceProvider;
        $documents = $provider->documents ?? [];
        
        return view('dashboard.account.my-documents', compact('documents'));
    }


    public function pointCalculation(Request $request) {
        return view('dashboard.account.points-calculation');
    }

    public function uploadPicture(Request $request) {
        $user = Auth::user();
        return view('dashboard.account.upload-picture', compact('user'));
    }

    public function uploadProviderProfile(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $user = auth()->user();
            $provider = $user->serviceprovider;
            $disk = Storage::disk(config('filesystems.uploads_disk', 'public'));

            // Delete old photo if exists
            if ($provider->profile_photo) {
                $disk->delete($provider->profile_photo);
            }

            $image = $request->file('profile_picture');
            $filename = 'profile-' . $user->id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'profileImages/' . $filename;

            // Store using Storage facade (works with local or R2)
            $disk->putFileAs('profileImages', $image, $filename, 'public');

            $provider->profile_photo = $path;
            $provider->save();

            return response()->json([
                'success' => true,
                'path' => $disk->url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading the profile photo: ' . $e->getMessage()
            ]);
        }
    }

    public function uploadDocument(Request $request) {
        $user = Auth::user();
        $provider = $user->serviceProvider;
        $documents = $provider->documents ?? [];
        
        return view('dashboard.account.upload-document', compact('user', 'documents'));
    }


    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string|in:passport,european_id,license',
            'front' => 'required|image|mimes:jpeg,png,jpg',
            'back' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $user = auth()->user();
            $provider = $user->serviceProvider;
            $disk = Storage::disk(config('filesystems.uploads_disk', 'public'));

            // Delete old documents if they exist
            if (!empty($provider->documents)) {
                $documents = json_decode($provider->documents, true);
                $docTypes = ['passport', 'european_id', 'license'];
                foreach ($docTypes as $type) {
                    if (isset($documents[$type])) {
                        if (isset($documents[$type]['front'])) {
                            $disk->delete($documents[$type]['front']);
                        }
                        if (isset($documents[$type]['back'])) {
                            $disk->delete($documents[$type]['back']);
                        }
                    }
                }
            }

            $docType = $request->document_type;
            $docData = [];

            // Upload front image
            $frontImage = $request->file('front');
            if ($frontImage) {
                $frontImageName = 'docs-' . $user->id . '-' . $docType . '-front.' . $frontImage->getClientOriginalExtension();
                $disk->putFileAs('userDocs', $frontImage, $frontImageName, 'public');
                $docData['front'] = 'userDocs/' . $frontImageName;
            }

            // Upload back image if provided
            if ($request->hasFile('back')) {
                $backImage = $request->file('back');
                $backImageName = 'docs-' . $user->id . '-' . $docType . '-back.' . $backImage->getClientOriginalExtension();
                $disk->putFileAs('userDocs', $backImage, $backImageName, 'public');
                $docData['back'] = 'userDocs/' . $backImageName;
            }

            $newDocuments[$docType] = $docData;
            $provider->update(['documents' => !empty($newDocuments) ? json_encode($newDocuments) : null]);

            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error occurred: ' . $e->getMessage(),
            ]);
        }
    }


    public function affiliationAccounts(Request $request) {
        $user = Auth::user();
        if($user) {
            $affiliates = $user->referrals()->get() ?? [];
            return view('dashboard.my-affiliate-account', compact('affiliates', 'user'));
        }
    }

    public function saveSpecialStatus(Request $request)
    {
        $user = auth()->user();
        $provider = $user->serviceProvider;
        $statuses = $request->input('special_status', []);
        $provider->special_status = json_encode($statuses);
        $provider->save();

        return response()->json(['success' => true]);
    }

    public function updateBankingDetails(Request $request)
    {
        $request->validate([
            'bank_account_holder' => 'required|string|max:255',
            'bank_account_iban' => 'required|string|max:50',
            'bank_swift_bic' => 'required|string|max:11',
            'bank_name' => 'required|string|max:255',
            'account_country' => 'required|string|exists:countries,short_name',
        ]);

        try {
            $user = auth()->user();
            $user->update([
                'bank_account_holder' => $request->bank_account_holder,
                'bank_account_iban' => $request->bank_account_iban,
                'bank_swift_bic' => $request->bank_swift_bic,
                'bank_name' => $request->bank_name,
                'account_country' => $request->account_country,
                'bank_details_verified_at' => now(),
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating banking details',
            ], 500);
        }
    }

    /**
     * Update About You section for service providers
     */
    public function updateAboutYou(Request $request)
    {
        $user = User::find($request->user_id);
        
        if (!$user || !$user->serviceProvider) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
        
        $user->serviceProvider->update([
            'profile_description' => $request->description
        ]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Récupérer les informations "About You" du prestataire
     * ✅ MÉTHODE AJOUTÉE POUR CHARGER LES DONNÉES
     */
    public function getAboutYou(Request $request)
    {
        try {
            $userId = $request->input('user_id', Auth::id());
            $provider = ServiceProvider::where('user_id', $userId)->first();
            
            return response()->json([
                'success' => true,
                'about_you' => $provider ? $provider->profile_description : ''
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupérer les catégories sélectionnées par le prestataire
     * ✅ MÉTHODE AJOUTÉE POUR CHARGER LES CATÉGORIES
     */
    public function getProviderCategories(Request $request)
    {
        try {
            $userId = $request->input('user_id', Auth::id());
            $provider = ServiceProvider::where('user_id', $userId)->first();
            
            if (!$provider) {
                return response()->json(['success' => false, 'message' => 'Provider not found'], 404);
            }

            // Décodage sécurisé des JSON
            $categories = is_string($provider->services_to_offer) 
                ? json_decode($provider->services_to_offer, true) 
                : $provider->services_to_offer;
                
            $subcategories = is_string($provider->services_to_offer_category) 
                ? json_decode($provider->services_to_offer_category, true) 
                : $provider->services_to_offer_category;
            
            return response()->json([
                'success' => true,
                'categories' => $categories ?? [],
                'subcategories' => $subcategories ?? []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving categories: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete user account
     */
    public function delete(Request $request)
    {
        $request->validate([
            'confirm_delete' => 'required|accepted',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            // If service provider, soft delete the service_providers record
            if ($user->user_role === 'service_provider' && $user->serviceProvider) {
                $user->serviceProvider()->update([
                    'is_active' => false,
                    'deleted_at' => now(),
                ]);
                
                // Delete provider categories
                DB::table('service_provider_categories')->where('service_provider_id', $user->serviceProvider->id)->delete();
                DB::table('service_provider_subcategories')->where('service_provider_id', $user->serviceProvider->id)->delete();
                DB::table('service_provider_sub_subcategories')->where('service_provider_id', $user->serviceProvider->id)->delete();
            }

            // Soft delete the user
            $user->update([
                'deleted_at' => now(),
                'email' => $user->email . '_deleted_' . time(),
            ]);

            DB::commit();

            // Logout the user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('success', 'Your account has been successfully deleted.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while deleting your account. Please try again.');
        }
    }

    /**
     * Export all user data (GDPR Article 20 - Right to Data Portability)
     * Also compliant with CCPA, LGPD, and other international data protection regulations
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function exportUserData(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Collect all user data
            $exportData = [
                'export_info' => [
                    'generated_at' => now()->toIso8601String(),
                    'platform' => 'Ulixai.com',
                    'data_subject_id' => $user->id,
                    'format_version' => '1.0',
                    'legal_basis' => 'GDPR Article 20, CCPA, LGPD',
                ],

                // Personal Information
                'personal_data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number,
                    'date_of_birth' => $user->dob,
                    'gender' => $user->gender,
                    'address' => $user->address,
                    'country' => $user->country,
                    'preferred_language' => $user->preferred_language,
                    'user_role' => $user->user_role,
                    'account_created_at' => $user->created_at?->toIso8601String(),
                    'email_verified_at' => $user->email_verified_at?->toIso8601String(),
                    'last_login_at' => $user->last_login_at?->toIso8601String(),
                    'referral_code' => $user->referral_code,
                ],

                // Banking Details (masked for security)
                'banking_data' => [
                    'bank_name' => $user->bank_name,
                    'account_holder' => $user->bank_account_holder,
                    'iban_masked' => $user->bank_account_iban ? $this->maskIban($user->bank_account_iban) : null,
                    'swift_bic' => $user->bank_swift_bic,
                    'account_country' => $user->account_country,
                    'verified_at' => $user->bank_details_verified_at?->toIso8601String(),
                ],
            ];

            // Service Provider Data (if applicable)
            if ($user->user_role === 'service_provider' && $user->serviceProvider) {
                $provider = $user->serviceProvider;
                $exportData['service_provider_data'] = [
                    'id' => $provider->id,
                    'profile_description' => $provider->profile_description,
                    'native_language' => $provider->native_language,
                    'spoken_languages' => $provider->spoken_language,
                    'services_offered' => $provider->services_to_offer,
                    'service_categories' => $provider->services_to_offer_category,
                    'latitude' => $provider->latitude,
                    'longitude' => $provider->longitude,
                    'is_active' => $provider->is_active,
                    'is_visible' => $provider->is_visible,
                    'special_status' => $provider->special_status,
                    'stripe_account_id' => $provider->stripe_account_id ? 'Connected' : null,
                    'stripe_kyc_completed' => $provider->stripe_kyc_completed,
                    'created_at' => $provider->created_at?->toIso8601String(),
                ];
            }

            // Missions (as requester)
            $missionsAsRequester = Mission::where('user_id', $user->id)
                ->select(['id', 'title', 'description', 'status', 'amount', 'created_at', 'completed_at'])
                ->get()
                ->map(function ($mission) {
                    return [
                        'id' => $mission->id,
                        'title' => $mission->title,
                        'description' => $mission->description,
                        'status' => $mission->status,
                        'amount' => $mission->amount,
                        'created_at' => $mission->created_at?->toIso8601String(),
                        'completed_at' => $mission->completed_at?->toIso8601String(),
                    ];
                });
            $exportData['missions_as_requester'] = $missionsAsRequester;

            // Mission Offers (as provider)
            if ($user->serviceProvider) {
                $offers = MissionOffer::where('service_provider_id', $user->serviceProvider->id)
                    ->select(['id', 'mission_id', 'price', 'status', 'message', 'created_at'])
                    ->get()
                    ->map(function ($offer) {
                        return [
                            'id' => $offer->id,
                            'mission_id' => $offer->mission_id,
                            'price' => $offer->price,
                            'status' => $offer->status,
                            'message' => $offer->message,
                            'created_at' => $offer->created_at?->toIso8601String(),
                        ];
                    });
                $exportData['mission_offers_as_provider'] = $offers;
            }

            // Transactions
            $transactions = Transaction::where('user_id', $user->id)
                ->orWhere('provider_id', $user->serviceProvider?->id)
                ->select(['id', 'type', 'amount', 'status', 'description', 'created_at'])
                ->get()
                ->map(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'type' => $transaction->type,
                        'amount' => $transaction->amount,
                        'status' => $transaction->status,
                        'description' => $transaction->description,
                        'created_at' => $transaction->created_at?->toIso8601String(),
                    ];
                });
            $exportData['transactions'] = $transactions;

            // Conversations (metadata only - not message content to protect other users' privacy)
            $conversations = Conversation::where('user_id', $user->id)
                ->orWhere('provider_id', $user->serviceProvider?->id)
                ->select(['id', 'mission_id', 'created_at', 'updated_at'])
                ->get()
                ->map(function ($conversation) {
                    return [
                        'id' => $conversation->id,
                        'mission_id' => $conversation->mission_id,
                        'created_at' => $conversation->created_at?->toIso8601String(),
                        'last_activity' => $conversation->updated_at?->toIso8601String(),
                    ];
                });
            $exportData['conversations_metadata'] = $conversations;

            // Referrals (affiliate data)
            $referrals = $user->referrals()
                ->select(['id', 'name', 'email', 'created_at'])
                ->get()
                ->map(function ($referral) {
                    return [
                        'id' => $referral->id,
                        'name' => $referral->name,
                        'email_masked' => $this->maskEmail($referral->email),
                        'referred_at' => $referral->created_at?->toIso8601String(),
                    ];
                });
            $exportData['referrals'] = $referrals;

            // Commissions
            $commissions = $user->commissions()
                ->select(['id', 'amount', 'status', 'created_at'])
                ->get()
                ->map(function ($commission) {
                    return [
                        'id' => $commission->id,
                        'amount' => $commission->amount,
                        'status' => $commission->status,
                        'created_at' => $commission->created_at?->toIso8601String(),
                    ];
                });
            $exportData['affiliate_commissions'] = $commissions;

            // Return as downloadable JSON file
            $filename = 'ulixai_data_export_' . $user->id . '_' . now()->format('Y-m-d_His') . '.json';

            return response()->json($exportData)
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Content-Type', 'application/json');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while exporting your data',
                'error' => config('app.debug') ? $e->getMessage() : 'Please try again later'
            ], 500);
        }
    }

    /**
     * Mask IBAN for security (show only last 4 characters)
     */
    private function maskIban(?string $iban): ?string
    {
        if (!$iban || strlen($iban) < 8) {
            return $iban;
        }
        return str_repeat('*', strlen($iban) - 4) . substr($iban, -4);
    }

    /**
     * Mask email for privacy (show only first 2 chars and domain)
     */
    private function maskEmail(?string $email): ?string
    {
        if (!$email || !str_contains($email, '@')) {
            return $email;
        }
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1];
        $masked = substr($name, 0, 2) . str_repeat('*', max(strlen($name) - 2, 3));
        return $masked . '@' . $domain;
    }
}