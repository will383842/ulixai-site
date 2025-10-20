<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Badge;
use App\Models\ReputationPoint;
use Illuminate\Support\Facades\DB;
use App\Services\ReputationPointService;

class ExpatsLeaderboardController extends Controller
{
    protected $reputationPointService;
    public function __construct(ReputationPointService $reputationPointService)
    {
        $this->reputationPointService = $reputationPointService;
    }
    public function index(Request $request)
    {
        $country = $request->input('country');
        $language = $request->input('language');
        $category = $request->input('category');
        $badge = $request->input('badge');

        $providersQuery = ServiceProvider::with(['user', 'user.badges'])
            ->when($country, fn($q) => $q->where('country', $country))
            ->when($language, fn($q) => $q->where('preferred_language', $language))
            ->when($category, function($q) use ($category) {
                $q->whereJsonContains('services_to_offer_category', (int)$category);
            })
            ->when($badge, function($q) use ($badge) {
                $q->whereHas('user.badges', function($bq) use ($badge) {
                    $bq->where('badges.id', $badge);
                });
            })
            ->orderByDesc('points');

        $providers = $providersQuery->get();

        // For filter dropdowns
        $countries = ServiceProvider::select('country')->distinct()->pluck('country')->filter()->sort()->values();
        $languages = ServiceProvider::select('preferred_language')->distinct()->pluck('preferred_language')->filter()->sort()->values();
        $categories = DB::table('categories')->select('id', 'name')->orderBy('name')->get();
        $badges = Badge::where('type', 'reputation')->get();

        // For event breakdown, assume you have a reputation_points table with event columns
        $reputationPointConfig = ReputationPoint::first();

        return view('admin.dashboard.reputation-points.index', compact(
            'providers', 'countries', 'languages', 'categories', 'badges', 'reputationPointConfig', 'country', 'language', 'category', 'badge'
        ));
    }

    public function adjustPoints(Request $request, $providerId)
    {
        try {
            $request->validate([
                'points' => 'required|integer',
                'reason' => 'nullable|string|max:255'
            ]);

            $provider = ServiceProvider::findOrFail($providerId);
            $provider->points = $request->input('points');
            $provider->save();
            $this->reputationPointService->updateUlysseStatusManually($provider);
            return redirect()->back()->with('success', 'Reputation points updated for provider.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Provider not found']);
        }
    }

    public function showConfig()
    {
        // Only one config row (id=1)
        $reputationPointConfig = ReputationPoint::first() ?? new ReputationPoint();
        return view('admin.dashboard.reputation-points.config', compact('reputationPointConfig'));
    }

    public function adjustReputationPoints(Request $request)
    {
        $data = $request->validate([
            'mission_with_review'     => 'required|integer',
            'five_star_review'        => 'required|integer',
            'four_star_review'        => 'required|integer',
            'response_24h'            => 'required|integer',
            'profile_complete'        => 'required|integer',
            'active_3_months'         => 'required|integer',
            'active_12_months'        => 'required|integer',
            'no_disputes'             => 'required|integer',
            'client_recommendations'  => 'required|integer',
            'client_abuse_report'     => 'required|integer',
            'dispute_refund'          => 'required|integer',
            'provider_canceled'       => 'required|integer',
            'no_reply_5_requests'     => 'required|integer',
        ]);

        $config = ReputationPoint::first();
        if (!$config) {
            $config = ReputationPoint::create($data);
        } else {
            $config->update($data);
        }

        return response()->json(['success' => true, 'message' => 'Reputation points updated!']);
    }
}
