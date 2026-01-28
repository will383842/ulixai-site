<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    public function getProviders(Request $request): JsonResponse
    {
        try {
            // Directly fetch providers without caching
            $providers = ServiceProvider::with([
                    'user:id,name,email',
                    'reviews:id,provider_id,rating'
                ])
                ->whereHas('user', fn ($q) => $q->where('status', 'active'))
                ->whereNotNull('profile_photo')
                ->whereNotNull('country')
                ->whereNotNull('provider_address')
                ->where('profile_photo', '!=', '')
                ->where('provider_visibility', true)
                ->select([
                    'id',
                    'user_id',
                    'first_name',
                    'last_name',
                    'native_language',
                    'spoken_language',
                    'services_to_offer',
                    'services_to_offer_category',
                    'provider_address',
                    'operational_countries',
                    'communication_online',
                    'communication_inperson',
                    'profile_description',
                    'profile_photo',
                    'phone_number',
                    'country',
                    'special_status',
                    'email',
                    'slug',
                    'created_at',
                    'updated_at',
                    'provider_visibility',
                    'country_coords',
                    'city_coords'
                ])
                ->get()
                ->map(function ($provider) {
                    $reviews = $provider->reviews;
                    $averageRating = $reviews->avg('rating') ?? 0;
                    $reviewCount = $reviews->count();

                    return [
                        'id' => $provider->id,
                        'first_name' => $provider->first_name,
                        'last_name' => $provider->last_name,
                        'native_language' => $provider->native_language,
                        'spoken_language' => is_string($provider->spoken_language) ? json_decode($provider->spoken_language, true) ?? [] : ($provider->spoken_language ?? []),
                        'services_to_offer' => $provider->services_to_offer,
                        'services_to_offer_category' => $provider->services_to_offer_category,
                        'provider_address' => $provider->provider_address,
                        'operational_countries' => is_string($provider->operational_countries) ? json_decode($provider->operational_countries, true) ?? [] : ($provider->operational_countries ?? []),
                        'communication_online' => $provider->communication_online,
                        'communication_inperson' => $provider->communication_inperson,
                        'profile_description' => $provider->profile_description,
                        'profile_photo' => $provider->profile_photo,
                        'phone_number' => $provider->phone_number,
                        'country' => $provider->country,
                        'special_status' => is_string($provider->special_status) ? json_decode($provider->special_status, true) ?? [] : ($provider->special_status ?? []),
                        'email' => $provider->email,
                        'slug' => $provider->slug ?? null,
                        'average_rating' => round($averageRating, 1),
                        'reviews_count' => $reviewCount,
                        'user_id' => $provider->user_id,
                        'country_coords' => $provider->country_coords,
                        'city_coords' => $provider->city_coords,
                        'created_at' => $provider->created_at,
                        'updated_at' => $provider->updated_at,
                    ];
                });


            $filteredProviders = $this->applyFilters($providers, $request)
                ->map(function ($provider) {
                    $provider['services_to_offer_category'] = $this->fetchCategoryNames($provider['services_to_offer_category']);
                    return $provider;
                });
                
            return response()->json([
                'success' => true,
                'message' => 'Providers loaded successfully',
                'data' => $filteredProviders,
                'total' => $filteredProviders->count(),
                'filters' => $this->getAvailableFilters($providers)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading providers',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }


    private function applyFilters($providers, Request $request)
    {
        return $providers->filter(function ($provider) use ($request) {
            // Country filter
            if ($request->filled('country') && $provider['country'] !== $request->country) {
                return false;
            }

            // City filter (case-insensitive partial match)
            if ($request->filled('city')) {
                $cityQuery = strtolower($request->city);
                $providerCity = strtolower($provider['provider_address'] ?? '');
                if (!str_contains($providerCity, $cityQuery)) {
                    return false;
                }
            }

            // Category filter
            if ($request->filled('category') && $provider['services_to_offer_category'] !== $request->category) {
                return false;
            }

            // Language filter
            if ($request->filled('language')) {
                $spokenLanguages = $provider['spoken_language'] ?? [];
                if (!in_array($request->language, $spokenLanguages)) {
                    return false;
                }
            }

            // Minimum rating filter
            if ($request->filled('min_rating')) {
                if ($provider['average_rating'] < $request->min_rating) {
                    return false;
                }
            }

            // Verified providers only
            if ($request->boolean('verified_only')) {
                if (empty($provider['special_status']) && $provider['reviews_count'] < 5) {
                    return false;
                }
            }

            return true;
        });
    }

    private function getAvailableFilters($providers): array
    {
        $countries = $providers->pluck('country')->unique()->filter()->sort()->values();
        $categories = $providers->pluck('services_to_offer_category')->unique()->filter()->sort()->values();
        $categoryNames = [];

        foreach ($categories as $category) {
            // Handle both string JSON and array input
            $decoded = is_string($category) ? json_decode($category, true) : $category;

            if (is_array($decoded)) {
                foreach ($decoded as $cat) {
                    $catName = Category::where('id', $cat)->pluck('name')->first();
                    if ($catName && !in_array($catName, $categoryNames)) {
                        $categoryNames[] = $catName;
                    }
                }
            } elseif (!empty($decoded)) {
                $catName = Category::where('id', $decoded)->pluck('name')->first();
                if ($catName && !in_array($catName, $categoryNames)) {
                    $categoryNames[] = $catName;
                }
            }
        }
        $languages = $providers->pluck('spoken_language')
            ->flatten()
            ->unique()
            ->filter()
            ->sort()
            ->values();

        return [
            'countries' => $countries,
            'categories' => $categoryNames,
            'languages' => $languages,
        ];
    }

    private function fetchCategoryNames($categoryIds): string
    {
        if (empty($categoryIds)) {
            return '';
        }

        // Handle both string JSON and array input
        $categories = is_string($categoryIds) ? json_decode($categoryIds, true) : $categoryIds;

        if (!is_array($categories)) {
            return '';
        }

        $categoryName = '';
        foreach ($categories as $category) {
            if (is_array($category)) {
                foreach ($category as $cat) {
                    $catName = Category::where('id', $cat)->pluck('name')->first();
                    if (!empty($categoryName)) {
                        $categoryName .= ', ' . $catName;
                    } else {
                        $categoryName = $catName;
                    }
                }
            } else {
                $catName = Category::where('id', $category)->pluck('name')->first();

                if (!empty($categoryName)) {
                    $categoryName .= ', ' . ($catName === null ? '' : $catName);
                } else {
                    $categoryName = $catName === null ? '' : $catName;
                }
            }
        }
        return $categoryName;
    }
}
