<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\Mission;
use App\Models\Category;
use App\Models\Country;
use App\Models\SpecialStatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Services\ReputationPointService;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FakeContentController extends Controller
{
    protected $reputationPointService;
    public function __construct(ReputationPointService $reputationPointService)
    {
        $this->reputationPointService = $reputationPointService;
    }

    public function index(Request $request)
    {
        // Only super_admin can access
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        $users = User::where('is_fake', true)->where('user_role', 'service_requester')->get();
        $providers = ServiceProvider::whereHas('user', function ($query) {
        $query->where('is_fake', true)
            ->where('user_role', 'service_provider');
            })
            ->with('user')
            ->get();

        $missions = Mission::where('is_fake', true)->with(['requester', 'selectedProvider'])->get();

        return view('admin.dashboard.admin-fcg.fake-dashboard', compact('users', 'providers', 'missions'));
    }

    public function createRequesterForm()
    {
        return view('admin.dashboard.admin-fcg.create-fake-requester');
    }

    public function createProviderForm()
    {
        $categories = Category::where('level', 1)->with('subcategories.subSubCategories')->get();
        $countries = Country::where('status', true)->get();
        $languages = [
            'English', 'French', 'Spanish', 'Portuguese', 'German', 'Italian',
            'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'
        ];
        $specialStatuses = SpecialStatus::all();

        return view('admin.dashboard.admin-fcg.create-fake-provider', compact(
            'categories', 'countries', 'languages', 'specialStatuses'
        ));
    }

    public function createMissionForm()
    {
        $categories = Category::where('level', 1)->with('subcategories.subSubCategories')->get();
        $countries = Country::where('status', true)->get();
        $languages = [
            'English', 'French', 'Spanish', 'Portuguese', 'German', 'Italian',
            'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'
        ];
        $fakeRequesters = User::where('is_fake', true)->get();

        return view('admin.dashboard.admin-fcg.create-fake-mission', compact(
            'categories', 
            'countries', 
            'languages',
            'fakeRequesters'
        ));
    }

   public function createFake(Request $request)
{
    if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
        abort(403, 'Unauthorized');
    }

    // Validate common inputs (count supports 1,5,10; default 1)
    $request->validate([
        'type'   => 'required|in:provider,requester,mission',
        'count'  => 'nullable|integer|in:5,20,50',
        'gender' => 'nullable|in:male,female,other',
        'email'  => 'nullable|email', // only meaningful when count=1
    ]);

    $type  = $request->input('type');
    $count = (int)($request->input('count', 1));
    $faker = Faker::create();

    // Helper: generate a guaranteed-unique fake email
    $uniqueEmail = function () {
        do {
            $email = Str::lower(Str::random(10)) . '@fake.com';
        } while (\App\Models\User::where('email', $email)->exists());
        return $email;
    };

    if ($type === 'requester') {
        $created = [];

        DB::transaction(function () use ($request, $count, $faker, $uniqueEmail, &$created) {
            for ($i = 1; $i <= $count; $i++) {
                // Name: keep readable for batches
              $baseName = $request->filled('name')
    ? $request->input('name')
    : $faker->name();

$gender = $request->filled('gender')
    ? $request->input('gender')
    : $faker->randomElement(['male', 'female', 'other']);

$name = $count > 1 ? "{$baseName}" : $baseName;


                // Email: if admin provided AND count==1 AND it's free, use it; otherwise generate unique
                $email = null;
                if ($count === 1 && $request->filled('email') && !\App\Models\User::where('email', $request->input('email'))->exists()) {
                    $email = $request->input('email');
                } else {
                    $email = $uniqueEmail();
                }

                $gender = $request->input('gender') ?: $faker->randomElement(['male','female','other']);

                $user = \App\Models\User::create([
                    'name'       => $name,
                    'email'      => $email,
                    'password'   => bcrypt('fake12345'),
                    'user_role'  => 'service_requester',
                    'is_fake'    => true,
                    'status'     => 'active',
                    'gender'     => $gender,
                ]);

                $created[] = $user;
            }
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success'       => true,
                'created_count' => count($created),
                'users' => collect($created)->map(fn($u) => [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'gender' => $u->gender,
                    'status' => $u->status,
                ])->values(),
            ]);
        }

        return redirect()
            ->route('admin.fake-content-generation')
            ->with('success', "Created ".count($created)." fake requester(s).");
    }
if ($type === 'provider') {
    // Validate provider-specific inputs (all optional; Faker will fill blanks)
    $request->validate([
        'count'                  => 'nullable|integer|in:1,5,20,50',
        'name'                   => 'nullable|string|max:255',
        'gender'                 => 'nullable|in:male,female,other',
        'phone_number'           => 'nullable|string|max:50',
        'country'                => 'nullable|string|max:255',
        'native_language'        => 'nullable|string|max:100',
        'preferred_language'     => 'nullable|string|max:100',
        'spoken_language'        => 'nullable|array',
        'operational_countries'  => 'nullable|array',
        'special_status'         => 'nullable|array',
        'category_id'            => 'nullable|integer',
        'subcategory_id'         => 'nullable|integer',
        'subsubcategory_id'      => 'nullable|integer',
        'communication_online'   => 'nullable|boolean',
        'communication_inperson' => 'nullable|boolean',
        'profile_description'    => 'nullable|string|max:5000',
        'profile_photo'          => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    $count = (int)($request->input('count', 1));
    $faker = \Faker\Factory::create();

    // If a single photo is uploaded, reuse it by copying for each created user
    $hasPhoto = $request->hasFile('profile_photo');
    $tmpPhotoPath = null;
    if ($hasPhoto) {
        $uploaded = $request->file('profile_photo');
        $tmpPhotoPath = storage_path('app/tmp/' . uniqid('fake_profile_', true) . '.' . $uploaded->getClientOriginalExtension());
        \Illuminate\Support\Facades\File::ensureDirectoryExists(dirname($tmpPhotoPath));
        $uploaded->move(dirname($tmpPhotoPath), basename($tmpPhotoPath));
    }

    // -------- Random-photo pool (add some seed images in this folder) --------
    $fakerPhotosDir = public_path('assets/profileImages/faker');
    $fakerPhotos = collect(glob($fakerPhotosDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE));
    $defaultFallback = public_path('assets/profileImages/default.png'); // optional single fallback

    // -------- Helpers --------
    $normalizeCoords = function ($raw) {
        if (is_array($raw) && count($raw) >= 2) return [(float)$raw[0], (float)$raw[1]];
        if (is_string($raw)) {
            $json = json_decode($raw, true);
            if (is_array($json) && count($json) >= 2) return [(float)$json[0], (float)$json[1]];
            $s = trim($raw, " \t\n\r\0\x0B[]");
            $parts = array_map('trim', explode(',', $s));
            if (count($parts) >= 2) return [(float)$parts[0], (float)$parts[1]];
        }
        return null;
    };

    $getRandomCategoryChain = function () {
        static $level1 = null, $byParent = null;
        if ($level1 === null || $byParent === null) {
            $all = \App\Models\Category::where('is_active', 1)->get(['id','parent_id','level']);
            $level1   = $all->where('level', 1)->values();
            $byParent = $all->groupBy('parent_id');
        }
        $cat = $level1->isNotEmpty() ? $level1->random() : null;
        $sub = null; $subsub = null;
        if ($cat) {
            $subs = ($byParent->get($cat->id, collect()))->where('level', 2)->values();
            if ($subs->isNotEmpty()) {
                $sub = $subs->random();
                $subs2 = ($byParent->get($sub->id, collect()))->where('level', 3)->values();
                if ($subs2->isNotEmpty()) $subsub = $subs2->random();
            }
        }
        return [
            'category_id'       => $cat?->id,
            'subcategory_id'    => $sub?->id,
            'subsubcategory_id' => $subsub?->id,
        ];
    };

    $languagesPool = ['English','French','German','Spanish','Arabic','Urdu','Hindi','Italian','Dutch','Polish'];
    $specialPool   = [
        'Expatriates for 2 to 5 years','Expatriates for 6 to 10 years','Expatriates for more than 10 years',
        'Lawyer','Legal advice','Insurer','Real estate agent','Translator'
    ];

    $created = [];

    \Illuminate\Support\Facades\DB::transaction(function () use (
        $request, $count, $faker, $uniqueEmail, $hasPhoto, $tmpPhotoPath,
        $getRandomCategoryChain, $languagesPool, $specialPool, $normalizeCoords,
        $fakerPhotos, $defaultFallback, &$created
    ) {
        $spokenLanguagesReq = $request->input('spoken_language', []);
        if (!is_array($spokenLanguagesReq)) $spokenLanguagesReq = [$spokenLanguagesReq];

        $operationalReq = $request->input('operational_countries', []);
        if (!is_array($operationalReq)) $operationalReq = [$operationalReq];

        for ($i = 1; $i <= $count; $i++) {
            // ---- User basics ----
            $baseName = $request->filled('name') ? $request->input('name') : $faker->name();
            $name = $count > 1 ? "{$baseName} #{$i}" : $baseName;

            $email  = $uniqueEmail();
            $gender = $request->filled('gender') ? $request->input('gender') : $faker->randomElement(['male','female','other']);
            $phone  = $request->filled('phone_number') ? $request->input('phone_number') : $faker->e164PhoneNumber();

            $user = \App\Models\User::create([
                'name'         => $name,
                'email'        => $email,
                'password'     => bcrypt('fake12345'),
                'user_role'    => 'service_provider',
                'is_fake'      => true,
                'status'       => 'active',
                'gender'       => $gender,
                'phone_number' => $phone,
            ]);

            // ---- Photo per user ----
            $profilePhoto = null;
            $destDir = public_path('assets/profileImages');
            \Illuminate\Support\Facades\File::ensureDirectoryExists($destDir);

            if ($hasPhoto && $tmpPhotoPath && \Illuminate\Support\Facades\File::exists($tmpPhotoPath)) {
                $ext = pathinfo($tmpPhotoPath, PATHINFO_EXTENSION);
                $filename = 'profile-' . $user->id . '-' . time() . '.' . $ext;
                \Illuminate\Support\Facades\File::copy($tmpPhotoPath, $destDir . DIRECTORY_SEPARATOR . $filename);
                $profilePhoto = 'assets/profileImages/' . $filename;
            } else {
                // pick a random faker image (or fallback)
                $sourcePath = null;
                if ($fakerPhotos->isNotEmpty()) {
                    $sourcePath = $fakerPhotos->random();
                } elseif (is_file($defaultFallback)) {
                    $sourcePath = $defaultFallback;
                }

                if ($sourcePath) {
                    $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
                    $filename = 'profile-' . $user->id . '-' . time() . '.' . $ext;
                    \Illuminate\Support\Facades\File::copy($sourcePath, $destDir . DIRECTORY_SEPARATOR . $filename);
                    $profilePhoto = 'assets/profileImages/' . $filename;
                }
            }

            // ---- Countries & coords ----
            $countryName = $request->filled('country')
                ? $request->input('country')
                : (\App\Models\Country::where('status', 1)->inRandomOrder()->value('country') ?? null);

            $coordsRaw = $countryName
                ? \App\Models\Country::where('country', $countryName)->value('coordinates')
                : null;
            $countryCoords = $normalizeCoords($coordsRaw);

            // ---- Operational countries ----
            $operationalCountries = count(array_filter($operationalReq)) >= 2
                ? array_values(array_filter($operationalReq))
                : \App\Models\Country::where('status', 1)->inRandomOrder()
                    ->limit($faker->numberBetween(2,5))
                    ->pluck('country')->filter()->values()->toArray();

            // ---- Languages ----
            $nativeLanguage = $request->filled('native_language') ? $request->input('native_language') : $faker->randomElement($languagesPool);
            $preferredLanguage = $request->filled('preferred_language') ? $request->input('preferred_language') : $faker->randomElement($languagesPool);
            $spokenLanguages = count($spokenLanguagesReq) ? $spokenLanguagesReq : $faker->randomElements($languagesPool, $faker->numberBetween(1,3));

            // ---- Special statuses ----
            $specialStatuses = $request->input('special_status', []);
            if (!is_array($specialStatuses) || !count($specialStatuses)) {
                $specialStatuses = $faker->randomElements($specialPool, $faker->numberBetween(0,3));
            }
            $specialStatusesJson = json_encode(array_fill_keys($specialStatuses, true), JSON_UNESCAPED_UNICODE);

            // ---- Categories ----
            $categoryId      = $request->filled('category_id')      ? (int)$request->input('category_id')      : null;
            $subcategoryId   = $request->filled('subcategory_id')   ? (int)$request->input('subcategory_id')   : null;
            $subsubcategoryId= $request->filled('subsubcategory_id')? (int)$request->input('subsubcategory_id'): null;

            if (!$categoryId) {
                $chain = $getRandomCategoryChain();
                $categoryId       = $chain['category_id'];
                $subcategoryId    = $subcategoryId    ?: $chain['subcategory_id'];
                $subsubcategoryId = $subsubcategoryId ?: $chain['subsubcategory_id'];
            }

            $services_to_offer          = $categoryId    ? json_encode([$categoryId])    : null;
            $services_to_offer_category = $subcategoryId ? json_encode([$subcategoryId]) : null;

            // ---- Misc ----
            $commOnline   = $request->has('communication_online')   ? (bool)$request->boolean('communication_online')   : $faker->boolean(80);
            $commInPerson = $request->has('communication_inperson') ? (bool)$request->boolean('communication_inperson') : $faker->boolean(60);
            $profileDescription = $request->filled('profile_description') ? $request->input('profile_description') : $faker->paragraphs($faker->numberBetween(2,4), true);

            \App\Models\ServiceProvider::create([
                'user_id'                   => $user->id,
                'first_name'                => $faker->firstName(),
                'last_name'                 => $faker->lastName(),
                'country'                   => $countryName,
                'provider_address'          => $countryName,
                'native_language'           => $nativeLanguage,
                'spoken_language'           => $spokenLanguages,
                'preferred_language'        => $preferredLanguage,
                'operational_countries'     => $operationalCountries,
                'special_status'            => $specialStatusesJson,
                'provider_visibility'       => true,
                'points'                    => 0,
                'slug'                      => \Illuminate\Support\Str::slug($name . '-' . \Illuminate\Support\Str::random(4)),
                'profile_description'       => $profileDescription,
                'profile_photo'             => $profilePhoto, // <- always set if we have seeds/fallback
                'services_to_offer'         => $services_to_offer,
                'services_to_offer_category'=> $services_to_offer_category,
                'communication_online'      => $commOnline,
                'communication_inperson'    => $commInPerson,
                'phone_number'              => $user->phone_number,
                'country_coords'            => $countryCoords ? json_encode($countryCoords) : null,
                'email'                     => $user->email,
            ]);

            $created[] = $user;
        }
    });

    if ($hasPhoto && $tmpPhotoPath && \Illuminate\Support\Facades\File::exists($tmpPhotoPath)) {
        \Illuminate\Support\Facades\File::delete($tmpPhotoPath);
    }

    if ($request->expectsJson()) {
        return response()->json([
            'success'       => true,
            'created_count' => count($created),
            'users' => collect($created)->map(fn($u) => [
                'id' => $u->id, 'name' => $u->name, 'email' => $u->email,
            ])->values(),
        ]);
    }

    return redirect()
        ->route('admin.fake-content-generation')
        ->with('success', 'Created ' . count($created) . ' fake provider(s).');
}



    if ($type === 'mission') {
        // (Single create as per your original)
        $mission = \App\Models\Mission::create([
            'requester_id'        => $request->input('requester_id'),
            'category_id'         => $request->input('category_id', 1),
            'subcategory_id'      => $request->input('subcategory_id', 1),
            'subsubcategory_id'   => $request->input('subsubcategory_id', 1),
            'title'               => $request->input('title', 'Fake Mission'),
            'description'         => $request->input('description', 'Fake mission description'),
            'budget_min'          => $request->input('budget_min', 10),
            'budget_max'          => $request->input('budget_max', 100),
            'budget_currency'     => $request->input('budget_currency', 'EUR'),
            'service_duration'    => $request->input('service_duration', '1 week'),
            'location_country'    => $request->input('location_country', 'France'),
            'location_city'       => $request->input('location_city', 'Paris'),
            'is_remote'           => $request->boolean('is_remote', false),
            'language'            => $request->input('language', 'en'),
            'urgency'             => $request->input('urgency', 'medium'),
            'status'              => $request->input('status', 'published'),
            'selected_provider_id'=> $request->input('selected_provider_id'),
            'payment_status'      => $request->input('payment_status', 'unpaid'),
            'is_fake'             => true,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'mission_id' => $mission->id]);
        }

        return redirect()->route('admin.fake-content-generation')->with('success', 'Fake mission created.');
    }

    // Fallback (should not hit because of 'type' validation)
    return redirect()->route('admin.fake-content-generation')->with('success', 'Fake content created.');
}


    public function updateFake(Request $request, $type, $id)
    {
        
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        if ($type === 'requester') {
            $user = User::where('is_fake', true)->where('user_role', 'service_requester')->findOrFail($id);
            $user->forceFill($request->only(['name', 'email', 'status']))->save();
        } elseif ($type === 'provider') {
            $provider = ServiceProvider::findOrFail($id);
            $provider->update($request->only(['first_name', 'last_name', 'country', 'ulysse_status', 'points']));
            $provider->user->forceFill($request->only(['name', 'email', 'status']))->save();
            $this->reputationPointService->updateUlysseStatusManually($provider);
        } elseif ($type === 'mission') {
            $mission = Mission::where('is_fake', true)->findOrFail($id);
            $mission->update($request->only([
                'title', 'description', 'budget_min', 'budget_max', 'budget_currency',
                'service_duration', 'location_country', 'location_city', 'is_remote',
                'language', 'urgency', 'status', 'payment_status'
            ]));
        }

        return redirect()->route('admin.fake-content-generation')->with('success', 'Fake content updated.');
    }

    public function deleteFake(Request $request, $type, $id)
    {
        // Only super_admin can access
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        $success = false;
        if ($type === 'requester') {
            $success = (bool) User::where('is_fake', true)->where('user_role', 'service_requester')->findOrFail($id)->delete();
        } elseif ($type === 'provider') {
            $provider = ServiceProvider::findOrFail($id);
            if ($provider->profile_photo && File::exists(public_path($provider->profile_photo))) {
                File::delete(public_path($provider->profile_photo));
            }

            $provider->user()->delete();
            $success = (bool) $provider->delete();
        } elseif ($type === 'mission') {
            $success = (bool) Mission::where('is_fake', true)->findOrFail($id)->delete();
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => $success]);
        }

        return redirect()->route('admin.fake-content-generation')->with('success', 'Fake content deleted.');
    }
}
