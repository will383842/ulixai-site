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
        return view('dashboard.provider.service-providers', compact('providers'));
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
