<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AffiliateCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AffiliateController extends Controller
{
    /**
     * Handle affiliate signup with code validation.
     * Validates the affiliate code and stores it in session for registration.
     */
    public function affiliateSignup(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return redirect()->route('login')
                ->with('error', 'Affiliate code is missing.');
        }

        // Validate the affiliate code exists and belongs to an active user
        $referrer = User::where('affiliate_code', $code)
            ->where('status', 'active')
            ->first();

        if (!$referrer) {
            Log::warning('Invalid affiliate code attempt', [
                'code' => $code,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('login')
                ->with('error', 'Invalid or expired affiliate code.');
        }

        // Store the affiliate information in session for the registration process
        Session::put('affiliate_code', $code);
        Session::put('referrer_id', $referrer->id);
        Session::put('affiliate_session_started', now()->toDateTimeString());

        Log::info('Affiliate signup initiated', [
            'referrer_id' => $referrer->id,
            'code' => $code,
        ]);

        return view('user-auth.signup', [
            'referrer' => $referrer,
            'affiliate_code' => $code,
            'is_affiliate_signup' => true,
        ]);
    }

    /**
     * Validate an affiliate code via AJAX.
     */
    public function validateCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
        ]);

        $code = $request->input('code');

        $referrer = User::where('affiliate_code', $code)
            ->where('status', 'active')
            ->first();

        if (!$referrer) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid or expired affiliate code.',
            ], 404);
        }

        return response()->json([
            'valid' => true,
            'referrer' => [
                'name' => $referrer->name,
                'avatar' => $referrer->profile_picture ?? null,
            ],
            'message' => 'Valid affiliate code.',
        ]);
    }

    /**
     * Clear affiliate session data.
     */
    public function clearAffiliateSession(Request $request)
    {
        Session::forget(['affiliate_code', 'referrer_id', 'affiliate_session_started']);

        return response()->json([
            'success' => true,
            'message' => 'Affiliate session cleared.',
        ]);
    }

    /**
     * Get the current user's affiliate statistics.
     */
    public function getMyAffiliateStats(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        $referrals = $user->referrals()->get();
        $commissions = AffiliateCommission::where('referrer_id', $user->id)->get();

        $stats = [
            'affiliate_code' => $user->affiliate_code,
            'affiliate_link' => url('/affiliate/sign-up?code=' . $user->affiliate_code),
            'total_referrals' => $referrals->count(),
            'active_referrals' => $referrals->where('status', 'active')->count(),
            'total_earnings' => $user->affiliate_balance ?? 0,
            'pending_balance' => $user->pending_affiliate_balance ?? 0,
            'available_balance' => ($user->affiliate_balance ?? 0) - ($user->pending_affiliate_balance ?? 0),
            'commissions' => [
                'total' => $commissions->count(),
                'pending' => $commissions->where('status', 'pending')->count(),
                'available' => $commissions->where('status', 'available')->count(),
                'paid' => $commissions->where('status', 'paid')->count(),
            ],
        ];

        return response()->json($stats);
    }

    /**
     * Get the user's referral list with earnings.
     */
    public function getMyReferrals(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        $referrals = $user->referrals()
            ->with([
                'missions' => function ($query) {
                    $query->select('id', 'requester_id', 'status');
                },
                'serviceProvider' => function ($query) {
                    $query->select('id', 'user_id');
                },
            ])
            ->get(['id', 'name', 'email', 'status', 'created_at'])
            ->map(function ($referral) use ($user) {
                $commissions = AffiliateCommission::where('referrer_id', $user->id)
                    ->where('referee_id', $referral->id)
                    ->get();

                return [
                    'id' => $referral->id,
                    'name' => $referral->name,
                    'email' => $referral->email,
                    'status' => $referral->status,
                    'joined_at' => $referral->created_at->format('Y-m-d'),
                    'missions_count' => $referral->missions->count(),
                    'completed_missions' => $referral->missions->where('status', 'completed')->count(),
                    'total_commission_earned' => $commissions->sum('amount'),
                    'pending_commission' => $commissions->where('status', 'pending')->sum('amount'),
                ];
            });

        return response()->json([
            'referrals' => $referrals,
            'total' => $referrals->count(),
        ]);
    }

    /**
     * Generate a new affiliate code for the user (if they don't have one).
     */
    public function generateAffiliateCode(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        if ($user->affiliate_code) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an affiliate code.',
                'affiliate_code' => $user->affiliate_code,
                'affiliate_link' => url('/affiliate/sign-up?code=' . $user->affiliate_code),
            ]);
        }

        // Generate a unique affiliate code
        do {
            $code = strtoupper(substr(md5(uniqid($user->id, true)), 0, 8));
        } while (User::where('affiliate_code', $code)->exists());

        $user->affiliate_code = $code;
        $user->save();

        Log::info('Affiliate code generated', [
            'user_id' => $user->id,
            'code' => $code,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Affiliate code generated successfully.',
            'affiliate_code' => $code,
            'affiliate_link' => url('/affiliate/sign-up?code=' . $code),
        ]);
    }
}
