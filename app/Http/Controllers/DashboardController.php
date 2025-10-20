<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceProvider;
use App\Models\Mission;
use App\Services\PaymentService;
class DashboardController extends Controller
{
    protected $PaymentService;

    public function __construct(PaymentService $PaymentService) {
        $this->PaymentService = $PaymentService;
    }

    public function index(Request $request)
    {
        if (!Auth::check() || !Auth::user()) {
            return redirect()->route('login')->with('toast_error', 'Please log in to access the dashboard.');
        }

        $user = Auth::user();

        if ($user->user_role === 'service_requester') {
            // Fetch requester-related info (example: missions)
            $missions = Mission::where('requester_id', $user->id)->get();
            return view('dashboard.dashboard-index', [
                'user' => $user,
                'missions' => $missions,
            ]);
        } elseif ($user->user_role === 'service_provider') {
            // Fetch provider-related info (example: jobs)
            $provider = ServiceProvider::where('user_id', $user->id)->first();
            $jobs = $provider ? Mission::where('selected_provider_id', $provider->id)->get() : collect();
            
            $stripeBalance = null;

            if ($provider && $provider->stripe_account_id) {
                try {
                    $stripeBalance = $this->PaymentService->providerAccountBalance($provider);
                } catch (\Exception $e) {
                    $stripeBalance = ['error' => 'Unable to fetch Stripe balance.'];
                }
            }

            return view('dashboard.dashboard-index', [
                'user' => $user,
                'provider' => $provider,
                'jobs' => $jobs,
                'balance' => $stripeBalance,
                'reputationPoints' => $provider->points ?? 0,
                'progressLevel' => min(100, round(($provider->points ?? 0) / 300 * 100)),
            ]);
        }

        return view('dashboard.dashboardindex', ['user' => $user]);
    }
}
