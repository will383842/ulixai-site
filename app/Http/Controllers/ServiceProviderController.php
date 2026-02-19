<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\ServiceProvider;
use App\Models\Category;
use App\Models\User;
use App\Models\SpecialStatus;
use App\Models\Faq;
use App\Models\Country;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ServiceProviderResource;

class ServiceProviderController extends Controller
{
    public function main(Request $request) {
        // Providers actifs (avec slug valide pour éviter les erreurs de route)
        // ✅ Limité à 50 pour la homepage (performance)
        $providers = ServiceProvider::with(['user', 'reviews'])
            ->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('pinned')
            ->latest()
            ->take(50)
            ->get();
        
        // FAQs
        $faqs = Faq::where('status', true)
            ->latest()
            ->take(5)
            ->get();

        // Catégories niveau 1
        $category = Category::where('level', 1)->with('subcategories')->get();
        
 // 🔹 Pays pour le select
$countries = Country::where('status', 1)
    ->orderBy('country')
    ->pluck('country', 'id');

// 🔹 Langues pour le select
$languages = \App\Models\Language::where('status', 1)
    ->orderBy('name')
    ->get();

return view('pages.index', compact('providers', 'faqs', 'category', 'countries', 'languages'));
    }
    
    public function serviceproviders(Request $request) {
        // Fetch service providers with their user info
        // ✅ Limité à 100 pour performance
        if ($request->input('providers')) {
            $providers = ServiceProvider::with(['user', 'reviews'])
                ->whereIn('slug', json_decode($request->input('providers')))
                ->latest()
                ->take(100)
                ->get();
        } else {
            $providers = ServiceProvider::with(['user', 'reviews'])
                ->latest()
                ->take(100)
                ->get();
        }

        // ✅ Récupération des catégories pour la vue
        $category = Category::all();

        return view('dashboard.provider.service-providers', compact('providers', 'category'));
    }

    public function providerDetails(Request $request)
    {
        $id = $request->query('id') ?? $request->route('id');
        $provider = null;

        if ($id) {
            $provider = ServiceProvider::with(['user', 'reviews.user'])->where('slug', $id)->first();
        }

        if (!$provider) {
            abort(404, 'Provider not found');
        }

        return view('dashboard.provider.provider-details', compact('provider'));
    }

    /**
     * 🎉 MÉTHODE MODIFIÉE : Afficher le profil public d'un provider
     *
     * @param string $slug
     */
    public function providerProfile($slug) 
    {
        Log::info('🔍 Provider profile accessed: ' . $slug);
        
        // Chercher le provider par son slug
        $provider = ServiceProvider::with(['user', 'reviews.user'])->where('slug', $slug)->first();

        // CAS 1 : Provider n'existe pas du tout
        if (!$provider) {
            Log::info('👻 Provider not found: ' . $slug);
            abort(404, 'Provider not found');
        }

        // CAS 2 : Provider existe mais est supprimé/inactif
        if ($provider->deleted_at !== null || $provider->is_active === false) {
            Log::info('😅 Deleted/inactive provider accessed', [
                'provider_id' => $provider->id,
                'slug' => $slug,
                'deleted_at' => $provider->deleted_at,
                'is_active' => $provider->is_active,
            ]);
            
            // Trouver des providers similaires
            $similarProviders = $this->getSimilarProviders($provider, 4);
            
            // Page "Provider Not Available"
            return response()->view('pages.not-available', [
                'provider_name' => $provider->business_name
                    ?? ($provider->first_name . ' ' . $provider->last_name)
                    ?? 'This awesome provider',
                'category' => $this->getMainCategory($provider),
                'similar_providers' => $similarProviders,
            ], 410); // HTTP 410 Gone
        }

        // CAS 3 : Provider actif et visible
        Log::info('✅ Active provider viewed: ' . ($provider->business_name ?? $provider->first_name));

        return view('dashboard.provider.provider-details', compact('provider'));
    }

    /**
     * Trouver des providers similaires
     */
    private function getSimilarProviders($deletedProvider, $limit = 4)
    {
        Log::info('🔍 Searching for similar providers...');
        
        // Récupérer la catégorie principale
        $mainCategory = $this->getMainCategory($deletedProvider);
        
        // Requête de base
        $query = ServiceProvider::with(['user', 'reviews'])
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->where('id', '!=', $deletedProvider->id)
            ->whereHas('user', function ($q) {
                $q->where('status', 'active');
            });
        
        // Filtre catégorie
        if ($mainCategory) {
            $categoryId = (int) $mainCategory->id;
            $query->where(function ($q) use ($categoryId) {
                $q->whereJsonContains('services_to_offer', $categoryId)
                  ->orWhere('services_to_offer', 'LIKE', '%"' . $categoryId . '"%');
            });
            
            Log::info('📂 Filtering by category: ' . $mainCategory->name);
        }
        
        // Décodage pays
        $operationalCountries = $deletedProvider->operational_countries;
        if (is_string($operationalCountries)) {
            $operationalCountries = json_decode($operationalCountries, true) ?? [];
        }
        
        // Filtre pays si dispo
        if (!empty($operationalCountries) && is_array($operationalCountries)) {
            $firstCountry = $operationalCountries[0] ?? null;
            if ($firstCountry) {
                $query->where(function ($q) use ($firstCountry) {
                    $q->whereJsonContains('operational_countries', $firstCountry)
                      ->orWhere('operational_countries', 'LIKE', '%' . $firstCountry . '%');
                });
                
                Log::info('🌍 Filtering by country: ' . $firstCountry);
            }
        }
        
        // Trier par rating
        $similarProviders = $query->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderBy('reviews_count', 'desc')
            ->limit($limit)
            ->get();
        
        Log::info('✅ Found ' . $similarProviders->count() . ' similar providers');
        
        // FALLBACK 1 : même catégorie sans filtre pays
        if ($similarProviders->isEmpty() && $mainCategory) {
            Log::info('🔄 Fallback 1: Removing country filter, keeping category');
            
            $categoryId = (int) $mainCategory->id;
            $similarProviders = ServiceProvider::with(['user', 'reviews'])
                ->where('is_active', true)
                ->whereNull('deleted_at')
                ->where('id', '!=', $deletedProvider->id)
                ->whereHas('user', function ($q) {
                    $q->where('status', 'active');
                })
                ->where(function ($q) use ($categoryId) {
                    $q->whereJsonContains('services_to_offer', $categoryId)
                      ->orWhere('services_to_offer', 'LIKE', '%"' . $categoryId . '"%');
                })
                ->withAvg('reviews', 'rating')
                ->orderByDesc('reviews_avg_rating')
                ->limit($limit)
                ->get();
        }
        
        // FALLBACK 2 : meilleurs providers globalement
        if ($similarProviders->isEmpty()) {
            Log::info('🌟 Fallback 2: Showing top rated providers globally');
            
            $similarProviders = ServiceProvider::with(['user', 'reviews'])
                ->where('is_active', true)
                ->whereNull('deleted_at')
                ->where('id', '!=', $deletedProvider->id)
                ->whereHas('user', function ($q) {
                    $q->where('status', 'active');
                })
                ->withAvg('reviews', 'rating')
                ->orderByDesc('reviews_avg_rating')
                ->orderBy('reviews_count', 'desc')
                ->limit($limit)
                ->get();
        }
        
        return $similarProviders;
    }

    /**
     * Helper : Récupérer la catégorie principale d'un provider
     */
    private function getMainCategory($provider)
    {
        // Décodage du JSON services_to_offer
        $categoryIds = $provider->services_to_offer;
        if (is_string($categoryIds)) {
            $categoryIds = json_decode($categoryIds, true) ?? [];
        }
        
        // Récupérer la première catégorie
        if (!empty($categoryIds) && is_array($categoryIds)) {
            $firstCategoryId = $categoryIds[0] ?? null;
            if ($firstCategoryId) {
                return Category::find($firstCategoryId);
            }
        }
        
        return null;
    }

    public function getSubcategories($categoryId)
    {
        // Fetch the subcategories for the selected category
        $subcategories = Category::where('parent_id', $categoryId)->get();

        return CategoryResource::collection($subcategories);
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
                                    ->withAvg('reviews', 'rating')
                                    ->get();

        // Transform the collection to include avgRating (withAvg already computed reviews_avg_rating)
        $providers = $providers->map(function ($provider) {
            $provider->avgRating = round($provider->reviews_avg_rating ?? 5, 1);
            $provider->reviewCount = $provider->reviews->count() ?? 1;
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

                
        // Convertir la langue si elle existe dans le mapping
        if (!empty($language) && isset($languageMapping[$language])) {
            $language = $languageMapping[$language];
        }

        \Log::info('Filter Request:', [
            'category' => $categoryId,
            'subcategory' => $subcategoryId,
            'subsubcategory' => $subsubcategoryId,
            'country' => $country,
            'language' => $language
        ]);

        // Début de la requête
        $query = ServiceProvider::with(['user', 'reviews'])
            ->whereHas('user', function ($q) {
                $q->where('status', 'active');
            });

        // Filtre catégorie
        if ($categoryId) {
            $categoryId = (int) $categoryId;
            $query->where(function ($q) use ($categoryId) {
                $q->whereJsonContains('services_to_offer', $categoryId)
                  ->orWhere('services_to_offer', 'LIKE', '%"' . $categoryId . '"%');
            });
        }

        // Filtre sous-catégorie
        if ($subcategoryId) {
            $subcategoryId = (int) $subcategoryId;
            $query->where(function ($q) use ($subcategoryId) {
                $q->whereJsonContains('services_to_offer_category', $subcategoryId)
                  ->orWhere('services_to_offer_category', 'LIKE', '%"' . $subcategoryId . '"%');
            });
        }

        // Filtre sous-sous-catégorie
        if ($subsubcategoryId) {
            $subsubcategoryId = (int) $subsubcategoryId;
            $query->where(function ($q) use ($subsubcategoryId) {
                $q->whereJsonContains('services_to_offer_category', $subsubcategoryId)
                  ->orWhere('services_to_offer_category', 'LIKE', '%"' . $subsubcategoryId . '"%');
            });
        }

        // Filtre pays
        if ($country && $country !== 'Others') {
            $query->where(function ($q) use ($country) {
                $q->whereJsonContains('operational_countries', $country)
                  ->orWhere('operational_countries', 'LIKE', '%' . $country . '%');
            });
        }

        // Filtre langue
        if ($language && $language !== 'Others') {
            $query->where(function ($q) use ($language) {
                $q->where('preferred_language', $language)
                  ->orWhereJsonContains('spoken_language', $language)
                  ->orWhere('spoken_language', 'LIKE', '%' . $language . '%');
            });
        }

        // Récupération avec moyenne des notes
        $providers = $query->withAvg('reviews', 'rating')
            ->orderByDesc('pinned')
            ->latest()
            ->take(10)
            ->get();

        // Formatage pour le frontend
        $formattedProviders = $providers->map(function ($provider) {
            // Décodage operational_countries
            $operationalCountries = $provider->operational_countries;
            if (is_string($operationalCountries)) {
                $operationalCountries = json_decode($operationalCountries, true) ?? [];
            }

            // Décodage special_status
            $specialStatus = $provider->special_status;
            if (is_string($specialStatus)) {
                $specialStatus = json_decode($specialStatus, true) ?? [];
            }

            // Récupération noms catégories
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
                            'name' => $cat->name,
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
                'reviews_count' => $provider->reviews->count(),
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

        abort_if(auth()->id() !== (int)$request->user_id, 403);

        $provider = ServiceProvider::where('user_id', $request->user_id)->first();

        if (!$provider) {
            return response()->json(['success' => false, 'message' => 'Service provider not found'], 404);
        }

        // Colonne correcte
        $provider->profile_description = $request->description;
        $provider->save();

        return response()->json(['success' => true, 'message' => 'About You updated successfully']);
    }
}
