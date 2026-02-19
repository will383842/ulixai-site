<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AffiliateCommission;
use App\Models\Payout;
use App\Models\Mission;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AffiliateAdminController extends Controller
{
    /**
     * Display the main affiliate dashboard with comprehensive statistics.
     */
    public function index(Request $request)
    {
        // Date filters
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subMonths(12);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get all affiliates (users who have referred at least one person)
        $referrerIds = User::whereNotNull('referred_by')
            ->distinct()
            ->pluck('referred_by');

        $affiliates = User::whereIn('id', $referrerIds)
            ->withCount('referrals')
            ->orderByDesc('affiliate_balance')
            ->get();

        // Global statistics
        $stats = $this->getGlobalStats($startDate, $endDate);

        // Monthly trends for chart
        $monthlyTrends = $this->getMonthlyTrends(12);

        // Top performers
        $topAffiliates = $affiliates->take(10);

        // Recent commissions
        $recentCommissions = AffiliateCommission::with(['referrer', 'referee', 'mission'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Pending payouts
        $pendingPayouts = User::where('pending_affiliate_balance', '>', 0)
            ->orderByDesc('pending_affiliate_balance')
            ->get();

        return view('admin.dashboard.affiliates.dashboard', compact(
            'affiliates',
            'stats',
            'monthlyTrends',
            'topAffiliates',
            'recentCommissions',
            'pendingPayouts',
            'startDate',
            'endDate'
        ));
    }

    /**
     * List all affiliates with filtering and pagination.
     */
    public function affiliatesList(Request $request)
    {
        $query = User::whereIn('id', function ($q) {
            $q->select('referred_by')
                ->from('users')
                ->whereNotNull('referred_by')
                ->distinct();
        })->withCount('referrals');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('affiliate_code', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->input('status') === 'active') {
                $query->where('pending_affiliate_balance', '>', 0);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('pending_affiliate_balance', '=', 0);
            }
        }

        // Sort
        $sortBy = $request->input('sort_by', 'affiliate_balance');
        $sortDir = $request->input('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $affiliates = $query->paginate(20);

        return view('admin.dashboard.affiliates.list', compact('affiliates'));
    }

    /**
     * Show detailed affiliate information.
     */
    public function show($id)
    {
        $affiliate = User::with(['referrals', 'referrer'])->findOrFail($id);

        // Get all commissions for this affiliate
        $commissions = AffiliateCommission::with(['referee', 'mission'])
            ->where('referrer_id', $id)
            ->orderByDesc('created_at')
            ->paginate(20);

        // Get referrals with their spending
        $referrals = $affiliate->referrals()
            ->withCount(['missions as completed_missions_count' => function ($q) {
                $q->where('status', 'completed');
            }])
            ->get()
            ->map(function ($referral) use ($id) {
                $totalSpent = Transaction::whereHas('mission', function ($q) use ($referral) {
                    $q->where('requester_id', $referral->id);
                })->where('status', 'completed')->sum('amount_paid');

                $commissionGenerated = AffiliateCommission::where('referrer_id', $id)
                    ->where('referee_id', $referral->id)
                    ->sum('amount');

                $referral->total_spent = $totalSpent;
                $referral->commission_generated = $commissionGenerated;
                return $referral;
            });

        // Payouts history
        $payouts = Payout::where('user_id', $id)
            ->where('payout_type', 'affiliate')
            ->orderByDesc('created_at')
            ->get();

        // Statistics
        $stats = [
            'total_referrals' => $affiliate->referrals->count(),
            'active_referrals' => $affiliate->referrals->where('status', 'active')->count(),
            'total_earnings' => $affiliate->affiliate_balance ?? 0,
            'pending_balance' => $affiliate->pending_affiliate_balance ?? 0,
            'paid_out' => ($affiliate->affiliate_balance ?? 0) - ($affiliate->pending_affiliate_balance ?? 0),
            'commissions_pending' => $commissions->where('status', 'pending')->count(),
            'commissions_available' => $commissions->where('status', 'available')->count(),
            'commissions_paid' => $commissions->where('status', 'paid')->count(),
            'conversion_rate' => $affiliate->referrals->count() > 0
                ? round(($affiliate->referrals->where('status', 'active')->count() / $affiliate->referrals->count()) * 100, 1)
                : 0,
        ];

        // Monthly earnings chart data
        $monthlyEarnings = AffiliateCommission::where('referrer_id', $id)
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.dashboard.affiliates.show', compact(
            'affiliate',
            'commissions',
            'referrals',
            'payouts',
            'stats',
            'monthlyEarnings'
        ));
    }

    /**
     * List all commissions with filtering.
     */
    public function commissionsList(Request $request)
    {
        $query = AffiliateCommission::with(['referrer', 'referee', 'mission']);

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Date range filter
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', Carbon::parse($request->input('start_date')));
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
        }

        // Affiliate filter
        if ($request->filled('affiliate_id')) {
            $query->where('referrer_id', $request->input('affiliate_id'));
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('referrer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('referee', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $commissions = $query->orderByDesc('created_at')->paginate(25);

        // Get affiliates for filter dropdown
        $affiliates = User::whereIn('id', function ($q) {
            $q->select('referred_by')
                ->from('users')
                ->whereNotNull('referred_by')
                ->distinct();
        })->get(['id', 'name', 'email']);

        // Summary stats
        $summaryStats = [
            'total_commissions' => AffiliateCommission::count(),
            'total_amount' => AffiliateCommission::sum('amount'),
            'pending_amount' => AffiliateCommission::where('status', 'pending')->sum('amount'),
            'available_amount' => AffiliateCommission::where('status', 'available')->sum('amount'),
            'paid_amount' => AffiliateCommission::where('status', 'paid')->sum('amount'),
        ];

        return view('admin.dashboard.affiliates.commissions', compact(
            'commissions',
            'affiliates',
            'summaryStats'
        ));
    }

    /**
     * Show commission details.
     */
    public function showCommission($id)
    {
        $commission = AffiliateCommission::with(['referrer', 'referee', 'mission.transactions'])
            ->findOrFail($id);

        return view('admin.dashboard.affiliates.commission-detail', compact('commission'));
    }

    /**
     * Update commission status.
     */
    public function updateCommission(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,available,paid',
            'reason' => 'nullable|string|max:500',
        ]);

        $commission = AffiliateCommission::findOrFail($id);
        $oldStatus = $commission->status;
        $newStatus = $request->input('status');

        DB::beginTransaction();
        try {
            $commission->status = $newStatus;
            $commission->save();

            // Update user balance if needed
            $user = User::find($commission->referrer_id);
            if ($user) {
                if ($oldStatus === 'pending' && $newStatus === 'available') {
                    // Commission becomes available - add to pending balance
                    $user->pending_affiliate_balance = ($user->pending_affiliate_balance ?? 0) + $commission->amount;
                    $user->save();
                } elseif ($oldStatus === 'available' && $newStatus === 'paid') {
                    // Already handled by payout process
                } elseif ($newStatus === 'pending' && $oldStatus === 'available') {
                    // Reverting to pending - remove from pending balance
                    $user->pending_affiliate_balance = max(0, ($user->pending_affiliate_balance ?? 0) - $commission->amount);
                    $user->save();
                }
            }

            Log::info('Commission status updated by admin', [
                'commission_id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'admin_id' => auth()->guard('admin')->id(),
                'reason' => $request->input('reason'),
            ]);

            DB::commit();

            return back()->with('success', 'Commission status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update commission status', [
                'commission_id' => $id,
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Failed to update commission: ' . $e->getMessage());
        }
    }

    /**
     * Manually create a commission (for adjustments).
     */
    public function createCommission(Request $request)
    {
        $request->validate([
            'referrer_id' => 'required|exists:users,id',
            'referee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'status' => 'required|in:pending,available,paid',
            'reason' => 'required|string|max:500',
        ]);

        // Prevent self-referral
        if ($request->input('referrer_id') === $request->input('referee_id')) {
            return back()->with('error', 'Referrer and referee cannot be the same person.');
        }

        DB::beginTransaction();
        try {
            $commission = AffiliateCommission::create([
                'referrer_id' => $request->input('referrer_id'),
                'referee_id' => $request->input('referee_id'),
                'mission_id' => $request->input('mission_id'),
                'amount' => $request->input('amount'),
                'currency' => strtoupper($request->input('currency')),
                'status' => $request->input('status'),
            ]);

            // Update user balance
            $user = User::find($request->input('referrer_id'));
            if ($user) {
                $user->affiliate_balance = ($user->affiliate_balance ?? 0) + $request->input('amount');
                if ($request->input('status') === 'available') {
                    $user->pending_affiliate_balance = ($user->pending_affiliate_balance ?? 0) + $request->input('amount');
                }
                $user->save();
            }

            Log::info('Manual commission created by admin', [
                'commission_id' => $commission->id,
                'admin_id' => auth()->guard('admin')->id(),
                'reason' => $request->input('reason'),
            ]);

            DB::commit();

            return back()->with('success', 'Commission created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create manual commission', [
                'error' => $e->getMessage(),
            ]);
            return back()->with('error', 'Failed to create commission: ' . $e->getMessage());
        }
    }

    /**
     * Delete a commission (soft or hard based on status).
     */
    public function deleteCommission(Request $request, $id)
    {
        $commission = AffiliateCommission::findOrFail($id);

        if ($commission->status === 'paid') {
            return back()->with('error', 'Cannot delete a paid commission.');
        }

        DB::beginTransaction();
        try {
            // Revert balance changes
            $user = User::find($commission->referrer_id);
            if ($user) {
                $user->affiliate_balance = max(0, ($user->affiliate_balance ?? 0) - $commission->amount);
                if ($commission->status === 'available') {
                    $user->pending_affiliate_balance = max(0, ($user->pending_affiliate_balance ?? 0) - $commission->amount);
                }
                $user->save();
            }

            Log::info('Commission deleted by admin', [
                'commission_id' => $id,
                'admin_id' => auth()->guard('admin')->id(),
                'reason' => $request->input('reason'),
            ]);

            $commission->delete();

            DB::commit();

            return back()->with('success', 'Commission deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete commission: ' . $e->getMessage());
        }
    }

    /**
     * List all payouts with filtering.
     */
    public function payoutsList(Request $request)
    {
        $query = Payout::with(['user'])
            ->where('payout_type', 'affiliate');

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Date filter
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', Carbon::parse($request->input('start_date')));
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
        }

        $payouts = $query->orderByDesc('created_at')->paginate(25);

        // Summary
        $summaryStats = [
            'total_payouts' => Payout::where('payout_type', 'affiliate')->count(),
            'total_paid' => Payout::where('payout_type', 'affiliate')->where('status', 'paid')->sum('amount'),
            'pending_payouts' => Payout::where('payout_type', 'affiliate')->where('status', 'processing')->count(),
            'failed_payouts' => Payout::where('payout_type', 'affiliate')->where('status', 'failed')->count(),
        ];

        return view('admin.dashboard.affiliates.payouts', compact('payouts', 'summaryStats'));
    }

    /**
     * Export affiliates data to CSV.
     */
    public function exportAffiliates(Request $request)
    {
        $affiliates = User::whereIn('id', function ($q) {
            $q->select('referred_by')
                ->from('users')
                ->whereNotNull('referred_by')
                ->distinct();
        })->withCount('referrals')->get();

        $filename = 'affiliates_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($affiliates) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Affiliate Code',
                'Total Referrals',
                'Total Earnings',
                'Pending Balance',
                'Paid Out',
                'Status',
                'Joined At',
            ]);

            foreach ($affiliates as $affiliate) {
                fputcsv($file, [
                    $affiliate->id,
                    $affiliate->name,
                    $affiliate->email,
                    $affiliate->affiliate_code,
                    $affiliate->referrals_count,
                    $affiliate->affiliate_balance ?? 0,
                    $affiliate->pending_affiliate_balance ?? 0,
                    ($affiliate->affiliate_balance ?? 0) - ($affiliate->pending_affiliate_balance ?? 0),
                    $affiliate->status,
                    $affiliate->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export commissions data to CSV.
     */
    public function exportCommissions(Request $request)
    {
        $query = AffiliateCommission::with(['referrer', 'referee', 'mission']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', Carbon::parse($request->input('start_date')));
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
        }

        $commissions = $query->orderByDesc('created_at')->get();

        $filename = 'commissions_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($commissions) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Referrer ID',
                'Referrer Name',
                'Referrer Email',
                'Referee ID',
                'Referee Name',
                'Mission ID',
                'Amount',
                'Currency',
                'Status',
                'Created At',
            ]);

            foreach ($commissions as $commission) {
                fputcsv($file, [
                    $commission->id,
                    $commission->referrer_id,
                    $commission->referrer->name ?? 'N/A',
                    $commission->referrer->email ?? 'N/A',
                    $commission->referee_id,
                    $commission->referee->name ?? 'N/A',
                    $commission->mission_id,
                    $commission->amount,
                    $commission->currency,
                    $commission->status,
                    $commission->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get global affiliate statistics.
     */
    private function getGlobalStats(Carbon $startDate, Carbon $endDate)
    {
        $commissionsQuery = AffiliateCommission::whereBetween('created_at', [$startDate, $endDate]);
        $usersQuery = User::whereBetween('created_at', [$startDate, $endDate]);

        return [
            // Overview
            'total_affiliates' => User::whereIn('id', function ($q) {
                $q->select('referred_by')->from('users')->whereNotNull('referred_by')->distinct();
            })->count(),
            'active_affiliates' => User::whereIn('id', function ($q) {
                $q->select('referred_by')->from('users')->whereNotNull('referred_by')->distinct();
            })->where('pending_affiliate_balance', '>', 0)->count(),
            'total_referrals' => User::whereNotNull('referred_by')->count(),
            'new_referrals_period' => $usersQuery->whereNotNull('referred_by')->count(),

            // Financial
            'total_commissions_amount' => AffiliateCommission::sum('amount'),
            'period_commissions_amount' => $commissionsQuery->sum('amount'),
            'pending_commissions' => AffiliateCommission::where('status', 'pending')->sum('amount'),
            'available_commissions' => AffiliateCommission::where('status', 'available')->sum('amount'),
            'paid_commissions' => AffiliateCommission::where('status', 'paid')->sum('amount'),

            // Performance
            'avg_commission_per_referral' => User::whereNotNull('referred_by')->count() > 0
                ? round(AffiliateCommission::sum('amount') / User::whereNotNull('referred_by')->count(), 2)
                : 0,
            'conversion_rate' => User::whereNotNull('referred_by')->count() > 0
                ? round((User::whereNotNull('referred_by')->where('status', 'active')->count() / User::whereNotNull('referred_by')->count()) * 100, 1)
                : 0,
        ];
    }

    /**
     * Get monthly trends for charts.
     */
    private function getMonthlyTrends($months = 12)
    {
        $trends = [];
        $startDate = Carbon::now()->subMonths($months)->startOfMonth();

        for ($i = 0; $i < $months; $i++) {
            $monthStart = $startDate->copy()->addMonths($i);
            $monthEnd = $monthStart->copy()->endOfMonth();
            $monthKey = $monthStart->format('Y-m');

            $trends[$monthKey] = [
                'label' => $monthStart->format('M Y'),
                'new_referrals' => User::whereNotNull('referred_by')
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->count(),
                'commissions_generated' => AffiliateCommission::whereBetween('created_at', [$monthStart, $monthEnd])
                    ->sum('amount'),
                'payouts_processed' => Payout::where('payout_type', 'affiliate')
                    ->where('status', 'paid')
                    ->whereBetween('paid_at', [$monthStart, $monthEnd])
                    ->sum('amount'),
            ];
        }

        return $trends;
    }

    /**
     * API endpoint to get stats for AJAX dashboard updates.
     */
    public function apiStats(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subMonths(12);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        return response()->json([
            'stats' => $this->getGlobalStats($startDate, $endDate),
            'trends' => $this->getMonthlyTrends(12),
        ]);
    }
}
