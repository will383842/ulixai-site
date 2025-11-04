<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceProvider;
use App\Models\Category;
use App\Models\User;
use App\Models\SpecialStatus;
use App\Models\Faq;


class ServiceProviderController extends Controller
{
    public function main(Request $request) {
        $providers = ServiceProvider::with(['user', 'reviews'])
            ->wherehas('user', function ($query) {
                $query->where('status', 'active');
            })
            ->orderByDesc('pinned')
            ->latest()
            ->get();
        $faqs = Faq::where('status', true)
          ->latest()
          ->take(5)
          ->get();

        $category = Category::where('level', 1)->with('subcategories')->get();
        return view('pages.index', compact('providers', 'faqs', 'category'));
    }
    
    public function serviceproviders(Request $request) {
    // Fetch all service providers with their user info
    if($request->input('providers')) {
        $providers = ServiceProvider::with('user')->whereIn('slug', json_decode($request->input('providers')))->latest()->get();
    } else {
        $providers = ServiceProvider::with('user')->latest()->get();
    }
    
    // ✅ AJOUT : Récupération des catégories pour la vue
    $category = Category::all();
    
    return view('dashboard.provider.service-providers', compact('providers', 'category'));
}

    public function providerDetails(Request $request)
    {
        $id = $request->query('id') ?? $request->route('id');
        $provider = null;
        if ($id) {
            $provider = ServiceProvider::with('user')->where('slug', $id)->first();
        }
        if (!$provider) {
            abort(404, 'Provider not found');
        }
        return view('dashboard.provider.provider-details', compact('provider'));
    }

   
    public function providerProfile($slug) {
        $provider = ServiceProvider::with('user')->where('slug', $slug)->first();

        if (!$provider) {
            abort(404, 'Provider not found');
        }

        return view('dashboard.provider.provider-details', compact('provider'));
    }


    public function getSubcategories($categoryId)
    {
        // Fetch the subcategories for the selected category
        $subcategories = Category::where('parent_id', $categoryId)->get();

        return response()->json($subcategories);
    }

    /**
     * ✅ ANCIENNE MÉTHODE - NE PAS MODIFIER (utilisée ailleurs dans l'app)
     */
    public function getProviders(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategoryId = $request->input('subcategory_id');
        $country = $request->input('country');
        $language = $request->input('language');

        // Convert to integers to match your JSON data
        $categoryId = (int) $categoryId;
        $subcategoryId = (int) $subcategoryId;

        $providers = ServiceProvider::whereJsonContains('services_to_offer', $categoryId)
                                    ->whereJsonContains('services_to_offer_category', $subcategoryId)
                                    ->where('spoken_language', 'LIKE', '%"' . $language . '"%')
                                    ->where('operational_countries', 'LIKE', '%"' . $country . '"%')
                                    ->with(['user', 'reviews'])
                                    ->withAvg('reviews', 'rating') // This adds avg_rating to each provider
                                    ->get();
        // Transform the collection to include avgRating
        $providers = $providers->map(function ($provider) {
            $provider->avgRating = round($provider->reviews()->avg('rating') ?? 5, 1);
            $provider->reviewCount = $provider->reviews->count() ?? 1; // Add review count
            return $provider;
        });
        
        return response()->json($providers);
    }

    /**
     * 🆕 NOUVELLE MÉTHODE - Filtrage avancé avec mapping des langues
     */
    public function filterProviders(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategoryId = $request->input('subcategory_id');
        $subsubcategoryId = $request->input('subsubcategory_id');
        $country = $request->input('country');
        $language = $request->input('language');

        // 🔄 MAPPING ANGLAIS → FRANÇAIS (Frontend → BDD)
        // Conversion des noms de langues de l'interface vers les valeurs de la BDD
        $languageMapping = [
            'English' => 'Anglais',
            'French' => 'Français',
            'Spanish' => 'Espagnol',
            'Portuguese' => 'Portugais',
            'German' => 'Allemand',
            'Italian' => 'Italien',
            'Arabic' => 'Arabe',
            'Chinese' => 'Chinois',
            'Japanese' => 'Japonais',
            'Korean' => 'Coréen',
            'Russian' => 'Russe',
            'Hindi' => 'Hindi',
            'Turkish' => 'Turc'
        ];

        // Convertir la langue si elle existe dans le mapping
        if (!empty($language) && isset($languageMapping[$language])) {
            $language = $languageMapping[$language];
        }

        // Log pour debug (optionnel, tu peux le retirer plus tard)
        \Log::info('Filter Request:', [
            'category' => $categoryId,
            'subcategory' => $subcategoryId,
            'subsubcategory' => $subsubcategoryId,
            'country' => $country,
            'language' => $language // Maintenant converti en français
        ]);

        // 🔍 Début de la requête
        $query = ServiceProvider::with(['user', 'reviews'])
            ->whereHas('user', function ($q) {
                $q->where('status', 'active');
            });

        // 🎯 Filtre par catégorie (colonne JSON services_to_offer)
        if ($categoryId) {
            $categoryId = (int) $categoryId;
            $query->where(function ($q) use ($categoryId) {
                $q->whereJsonContains('services_to_offer', $categoryId)
                  ->orWhere('services_to_offer', 'LIKE', '%"' . $categoryId . '"%');
            });
        }

        // 🎯 Filtre par sous-catégorie (colonne JSON services_to_offer_category)
        if ($subcategoryId) {
            $subcategoryId = (int) $subcategoryId;
            $query->where(function ($q) use ($subcategoryId) {
                $q->whereJsonContains('services_to_offer_category', $subcategoryId)
                  ->orWhere('services_to_offer_category', 'LIKE', '%"' . $subcategoryId . '"%');
            });
        }

        // 🎯 Filtre par sous-sous-catégorie (colonne JSON services_to_offer_category)
        if ($subsubcategoryId) {
            $subsubcategoryId = (int) $subsubcategoryId;
            $query->where(function ($q) use ($subsubcategoryId) {
                $q->whereJsonContains('services_to_offer_category', $subsubcategoryId)
                  ->orWhere('services_to_offer_category', 'LIKE', '%"' . $subsubcategoryId . '"%');
            });
        }

        // 🌍 Filtre par pays (colonne JSON operational_countries)
        if ($country && $country !== 'Others') {
            $query->where(function ($q) use ($country) {
                $q->whereJsonContains('operational_countries', $country)
                  ->orWhere('operational_countries', 'LIKE', '%' . $country . '%');
            });
        }

        // 🗣️ Filtre par langue (maintenant avec la valeur convertie)
        if ($language && $language !== 'Others') {
            $query->where(function ($q) use ($language) {
                $q->where('preferred_language', $language)
                  ->orWhereJsonContains('spoken_language', $language)
                  ->orWhere('spoken_language', 'LIKE', '%' . $language . '%');
            });
        }

        // 📊 Récupération avec moyenne des notes
        $providers = $query->withAvg('reviews', 'rating')
            ->orderByDesc('pinned')
            ->latest()
            ->take(10)
            ->get();

        // 📦 Formatage des données pour le frontend
        $formattedProviders = $providers->map(function ($provider) {
            // Décodage sécurisé de operational_countries
            $operationalCountries = $provider->operational_countries;
            if (is_string($operationalCountries)) {
                $operationalCountries = json_decode($operationalCountries, true) ?? [];
            }

            // Décodage sécurisé de special_status
            $specialStatus = $provider->special_status;
            if (is_string($specialStatus)) {
                $specialStatus = json_decode($specialStatus, true) ?? [];
            }

            // 🔧 Récupération des noms de catégories depuis les IDs JSON
            $categoryIds = $provider->services_to_offer;
            if (is_string($categoryIds)) {
                $categoryIds = json_decode($categoryIds, true) ?? [];
            }
            
            $categories = [];
            if (!empty($categoryIds) && is_array($categoryIds)) {
                $categories = Category::whereIn('id', $categoryIds)
                    ->take(2)
                    ->get()
                    ->map(function ($cat) {
                        return [
                            'id' => $cat->id,
                            'name' => $cat->name
                        ];
                    })
                    ->toArray();
            }

            return [
                'id' => $provider->id,
                'slug' => $provider->slug,
                'first_name' => $provider->first_name,
                'last_name' => $provider->last_name,
                'profile_photo' => $provider->profile_photo,
                'preferred_language' => $provider->preferred_language,
                'operational_countries' => $operationalCountries,
                'special_status' => $specialStatus,
                'categories' => $categories,
                'average_rating' => round($provider->reviews_avg_rating ?? 5.0, 1),
                'reviews_count' => $provider->reviews->count()
            ];
        });

        return response()->json($formattedProviders);
    }

    public function updateProviderCategories(Request $request) {
        $user = User::findorFail($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $provider = ServiceProvider::where('user_id', $user->id)->first();
        if (!$provider) {
            return response()->json(['error' => 'Provider not found'], 404);
        }
        $provider->services_to_offer = $request->categories;
        $provider->services_to_offer_category = $request->subcategories;
        $provider->save();

        return response()->json(['success' => true, 'message' => 'Categories updated successfully']);
    }



    public function updateAboutYou(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string|max:1000',
        ]);

        $provider = ServiceProvider::where('user_id', $request->user_id)->first();

        if (!$provider) {
            return response()->json(['success' => false, 'message' => 'Service provider not found'], 404);
        }

        // ✅ Fixed column name
        $provider->profile_description = $request->description;
        $provider->save();

        return response()->json(['success' => true, 'message' => 'About You updated successfully']);
    }
}