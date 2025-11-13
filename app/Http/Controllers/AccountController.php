<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Country;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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


    public function updatePersonalInfo(Request $request)
    {
        try {
            $user = User::findorfail($request->user_id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Validation rules
            $rules = [
                'name' => 'required|string|max:255',
                'dob' => 'nullable|date|before:today',
                'gender' => 'nullable|in:Male,Female',
                'address' => 'nullable|string|max:500',
                'country' => 'nullable|string|max:255',
                'preferred_language' => 'nullable|string|max:255',
                'whatsapp_number' => 'nullable|string|max:20',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id)
                ]
            ];

            // Add service provider specific validation
            if ($user->user_role === 'service_provider') {
                $rules['provider_native_language'] = 'nullable|string|max:255';
                $rules['spoken_languages'] = 'nullable|array';
                $rules['spoken_languages.*'] = 'string|max:255';
            } else {
                $rules['spoken_languages_text'] = 'nullable|string|max:500';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
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

            return response()->json([
                'success' => true,
                'message' => 'Personal information updated successfully',
                'data' => [
                    'user' => $user->fresh(),
                    'service_provider' => $user->user_role === 'service_provider' ? $user->serviceProvider : null
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
    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

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
        // Validate the incoming request
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        try {
            $user = auth()->user();
            $provider = $user->serviceprovider;

            if ($provider->profile_photo && File::exists(public_path($provider->profile_photo))) {
                File::delete(public_path($provider->profile_photo));
            }

            $image = $request->file('profile_picture');
            $filename = 'profile-' . $user->id . '-' . time() . '.' . $image->getClientOriginalExtension();

            $path = 'assets/profileImages/' . $filename;
            $image->move(public_path('assets/profileImages'), $filename);

            $provider->profile_photo = $path;
            $provider->save();

            return response()->json([
                'success' => true,
                'path' => asset($path) 
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
            if (!empty($provider->documents)) {
                $documents = json_decode($provider->documents, true);
                $docTypes = ['passport', 'european_id', 'license'];
                foreach ($docTypes as $docType) {
                    if (isset($documents[$docType])) {
                        if (File::exists(public_path($documents[$docType]['front']))) {
                            File::delete(public_path($documents[$docType]['front']));
                        }
                        if (isset($documents[$docType]['back']) && File::exists(public_path($documents[$docType]['back']))) {
                            File::delete(public_path($documents[$docType]['back']));
                        }
                    }
                }
            }
            $docType = $request->document_type;
            $docData = [];
            $frontImage = $request->file('front');
            if ($frontImage) {
                $frontImageName = 'docs-' . $user->id . '-' . $docType . '-front.' . $frontImage->getClientOriginalExtension();
                $frontImagePath = $frontImage->move(public_path('assets/userDocs'), $frontImageName);
                $docData['front'] = 'assets/userDocs/' . $frontImageName;
            }

            if ($request->hasFile('back')) {
                $backImage = $request->file('back');
                $backImageName = 'docs-' . $user->id . '-' . $docType . '-back.' . $backImage->getClientOriginalExtension();
                $backImagePath = $backImage->move(public_path('assets/userDocs'), $backImageName);
                $docData['back'] = 'assets/userDocs/' . $backImageName;
            }
            $newDocuments[$docType] = $docData;
            $provider->update(['documents' =>  !empty($newDocuments) ? json_encode($newDocuments) : null]);

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
}