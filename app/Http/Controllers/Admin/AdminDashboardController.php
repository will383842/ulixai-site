<?php

namespace App\Http\Controllers\Admin;
use App\Models\PartnershipRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Press;
use App\Models\Transaction;
use App\Models\ServiceProvider;
use App\Models\Mission;
use App\Models\Badge;
use App\Models\BugReport;
use App\Models\RecruitApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Illuminate\Support\Facades\Cache;
use App\Services\Analytics\GoogleAnalyticsClient;
class AdminDashboardController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        
        $now = Carbon::now();
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();
        // Total users
        $totalUsers = User::count();
        $totalProviders = ServiceProvider::count();
        $totalRequesters = User::where('user_role', 'service_requester')->count();

        $newUsersLastMonth = User::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        // Recent users
        $recentUsers = User::latest()->limit(5)->get();

        // Recent providers
        $recentProviders = ServiceProvider::with('user')->latest()->limit(5)->get();

        // Recent transactions
        $recentTransactions = Transaction::with(['mission', 'provider'])->latest()->limit(5)->get();

        // Stripe balance (simulate, replace with actual Stripe API call in production)
        $stripeBalance = $this->paymentService->ulixaiPlatformBalance();

        // Pending KYC providers
        $pendingKycProviders = ServiceProvider::where('kyc_status', 'pending')->count();

        // Pending transactions
        $pendingTransactions = Transaction::where('status', 'pending')->count();

        // Total revenue grouped by currency
        $totalRevenueByCurrency = Transaction::where('status', 'completed')
            ->selectRaw('COALESCE(currency, "EUR") as currency, SUM(amount_paid) as total')
            ->groupBy('currency')
            ->pluck('total', 'currency')
            ->toArray();

        // Total pending payouts grouped by currency
        $totalPendingPayoutsByCurrency = Transaction::where('status', 'pending')
            ->selectRaw('COALESCE(currency, "EUR") as currency, SUM(amount_paid) as total')
            ->groupBy('currency')
            ->pluck('total', 'currency')
            ->toArray();

        // Recent missions
        $recentMissions = Mission::latest()->limit(5)->get();

        // ---- Extra KPIs (fail-safe) ----
        try {
            $seoMetrics = Cache::get('seo.metrics.latest', []);
            $backlinksTotal = (int) (data_get($seoMetrics, 'bing.summary.approxTotalLinks', 0) ?? 0);
            $domainAuthority = data_get($seoMetrics, 'opr.rank');
        } catch (\Throwable $e) {
            $backlinksTotal = 0;
            $domainAuthority = null;
        }

        try {
            $ga = new GoogleAnalyticsClient();
            $visitorsThisMonth = $ga->visitorsThisMonth();
        } catch (\Throwable $e) {
            $visitorsThisMonth = null;
        }

        return view('admin.dashboard.admin-dashboard', compact(
            'totalUsers',
            'totalProviders',
            'totalRequesters',
            'recentUsers',
            'recentProviders',
            'recentTransactions',
            'stripeBalance',
            'pendingKycProviders',
            'pendingTransactions',
            'totalRevenueByCurrency',
            'totalPendingPayoutsByCurrency',
            'recentMissions',
            'newUsersLastMonth',
            'backlinksTotal',
            'domainAuthority',
            'visitorsThisMonth',
        ));
    }
    
    public function secretLogin(Request $request, $id)
    {
        try {
            if (!auth()->guard('admin')->check()) {
                return redirect()->route('admin.login')->with('error', 'Admin authentication required');
            }
            $adminId = auth()->guard('admin')->id();
            
            // Find user to impersonate
            $user = User::findOrFail($id);

            auth()->guard('admin')->logout();
            auth()->guard('web')->logout();
            
            session()->forget('password_hash');
            session(['admin_id' => $adminId]);
            session(['is_impersonating' => true]);

            auth()->guard('web')->login($user, true);
            
            session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Now impersonating ' . $user->name);

        } catch (\Exception $e) {
            Log::error('Secret login failed:', [
                'admin_id' => auth()->guard('admin')->id() ?? null,
                'target_user_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Failed to impersonate user: ' . $e->getMessage());
        }
    }

    public function restoreAdmin()
    {
        try {
            if (!session()->has('admin_id')) {
                return redirect()->route('admin.login');
            }

            $adminId = session()->get('admin_id');
            auth()->guard('web')->logout();
            session()->forget(['admin_id', 'is_impersonating']);
            auth()->guard('admin')->loginUsingId($adminId, true);
            session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Returned to admin account');
        } catch (\Exception $e) {
            Log::error('Restore admin failed:', ['error' => $e->getMessage()]);
            return redirect()->route('admin.login')->with('error', 'Could not restore admin session');
        }
    }

    public function updateCommission(Request $request)
    {
        // Save to config or DB as needed
        // Example: config(['ulixai.fees.client' => $request->client_fee, ...]);
        // Or update a settings table
        // ...
        return back()->with('success', 'Commission rates updated!');
    }

    public function remindKyc($providerId)
    {
        $provider = ServiceProvider::findOrFail($providerId);
        $user = $provider->user;

        // Send KYC reminder email to provider
        Mail::send([], [], function ($message) use ($provider, $user) {
            $message->to($provider->email)
                ->subject('KYC Verification Reminder')
                ->html("
                    Dear {$provider->first_name},<br><br>
                    This is a reminder to complete your KYC verification on Ulixai.<br>
                    Please log in to your account and complete the required steps.<br><br>
                    If you have any questions, contact support.<br><br>
                    Thank you,<br>
                    Ulixai Team
                ");
        });

        return back()->with('success', 'KYC reminder sent!');
    }


    public function transactions()
    {
        $transactions = Transaction::with(['mission', 'provider'])->latest()->limit(20)->get();
        $providers = ServiceProvider::all();
        return view('admin.dashboard.transactions', compact('transactions', 'providers'));
    }

    

    public function badges(Request $request)
    {
        // Handle create
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:badges,slug',
                'icon' => 'nullable|string|max:1000',
                'type' => 'required|string|max:50',
                'threshold' => 'nullable|integer',
                'is_active' => 'boolean',
                'is_auto' => 'boolean',
                'sort_order' => 'integer',
            ]);
            $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
            Badge::create($validated);
            return redirect()->route('admin.badges')->with('success', 'Badge created!');
        }

        // Handle update
        if ($request->isMethod('patch')) {
            $badge = Badge::findOrFail($request->input('id'));
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:badges,slug,' . $badge->id,
                'icon' => 'nullable|string|max:255',
                'type' => 'required|string|max:50',
                'threshold' => 'nullable|integer',
                'is_active' => 'boolean',
                'is_auto' => 'boolean',
                'sort_order' => 'integer',
            ]);
            $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
            $badge->update($validated);
            return redirect()->route('admin.badges')->with('success', 'Badge updated!');
        }

        // Handle delete
        if ($request->isMethod('delete')) {
            $badge = Badge::findOrFail($request->input('id'));
            $badge->delete();
            return redirect()->route('admin.badges')->with('success', 'Badge deleted!');
        }

        // Show all badges
        $badges = Badge::orderBy('sort_order')->get();
        return view('admin.dashboard.badges.index', compact('badges'));
    }

    public function ShowReports(Request $request){
         
        //Bug Reports 
      $AllBugReports = BugReport::orderByDesc('created_at')->get();

     
        return view('admin.dashboard.bug-reports',compact('AllBugReports'));

    }

       public function ShowApplications()
    {
        $applications = RecruitApplication::latest()->paginate(10);
        return view('admin.applications', compact('applications'));
    }

    public function updateStatus(Request $request, RecruitApplication $application)
    {
        $request->validate([
            'status' => 'required|in:new,reviewing,rejected,hired',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated!');
    }
  public function showCv(RecruitApplication $application)
    {
        $path = $application->cv_path;               // e.g. 'recruit-cv/abc.pdf'
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404);
        }

        // Absolute path on disk
        $fullPath = Storage::disk('public')->path($path);

        // Detect mime (pdf, docx, jpg, etc.)
        $mime = File::mimeType($fullPath) ?: 'application/octet-stream';
        $filename = basename($fullPath);

        // Stream inline so it renders in <iframe>
        return response()->make(
            file_get_contents($fullPath),
            200,
            [
                'Content-Type'        => $mime,
                'Content-Disposition' => 'inline; filename="'.$filename.'"',
                'Content-Length'      => filesize($fullPath),
            ]
        );
    }

    public function destroyApplication(RecruitApplication $application)
    {
        // delete CV file if exists
        if ($application->cv_path && \Storage::disk('public')->exists($application->cv_path)) {
            \Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return back()->with('success', 'Application deleted successfully.');
    }

    public function showpartnerships(){
        $partnerships = PartnershipRequest::get();
        return view('admin.partnerships' , compact('partnerships'));
    }

    public function showAffiliateSummary()
    {
        // Get unique referrer IDs and fetch them in a single query (avoids N+1)
        $referrerIds = User::whereNotNull('referred_by')
            ->distinct()
            ->pluck('referred_by');

        $affiliates = User::whereIn('id', $referrerIds)->get();
        
        $total = (int) User::sum('affiliate_balance');

        $totalData = (int) (User::sum('affiliate_balance') - User::sum('pending_affiliate_balance'));
        $totalAmountToPaid = (int) User::sum('pending_affiliate_balance');
        return view('admin.dashboard.affiliates.index', compact('total', 'totalData', 'totalAmountToPaid', 'affiliates'));
    }

    public function affiliateDetails(Request $request, $id)
    {
        $affiliate = User::findOrFail($id);
        $referrals = $affiliate->referrals()
            ->with([
                'missions:id,requester_id', 
                'missions.transactions:id,mission_id,amount_paid'
            ])
            ->get(['id','name','email','created_at']);  

        $referrals = $referrals->map(function ($ref) {
            $total = $ref->missions
                ->flatMap->transactions
                ->sum('amount_paid');
            $ref->total_spent = (float) $total;
            return $ref;
        });

        $totalRevenue   = (float) ($affiliate->affiliate_balance ?? 0);
        $totalAmountPaid = (float) ($affiliate->affiliate_balance ?? 0) - (float) ($affiliate->pending_affiliate_balance ?? 0);
        return view(
            'admin.dashboard.affiliates.affiliate-info',
            compact('affiliate', 'totalAmountPaid', 'referrals', 'totalRevenue')
        );
    }



    public function showPressSummary()
    {
        $pressItems = Press::latest()->paginate(12);
        return view('admin.press', compact('pressItems'));
    }

    public function storePress(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'pdf'            => 'nullable|file|mimes:pdf|max:8192',
            'guideline_pdf'  => 'nullable|file|mimes:pdf|max:8192',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'icon'           => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:4096',
        ]);

        $data = [
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
        ];

        foreach (['pdf', 'photo', 'icon', 'guideline_pdf'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store("press/$fileField", 'public');
            }
        }

        $press = Press::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Press entry saved successfully.',
            'data'    => $press,
        ]);
    }


    public function previewPress(Press $press, string $field, Request $request)
    {
        $allowed = ['pdf','guideline_pdf','photo','icon'];
        if (!in_array($field, $allowed, true)) abort(404);

        $path = $press->{$field};
        if (!$path || !Storage::disk('public')->exists($path)) abort(404);

        $fullPath = Storage::disk('public')->path($path);

        // Force PDF mime for pdf fields (avoids "nosniff" issues)
        $mime = in_array($field, ['pdf','guideline_pdf'], true)
            ? 'application/pdf'
            : (File::mimeType($fullPath) ?: 'application/octet-stream');

        $filename = basename($fullPath);

        // Check if this is a download request
        $isDownload = $request->has('download');
        
        $disposition = $isDownload ? 'attachment' : 'inline';

        // Additional headers to prevent IDM interception for preview
        $headers = [
            'Content-Type'              => $mime,
            'Content-Disposition'       => $disposition . '; filename="'.$filename.'"',
            'Content-Length'            => filesize($fullPath),
            'Cache-Control'             => 'public, max-age=604800',
            'Accept-Ranges'             => 'bytes',
            'X-Frame-Options'           => 'SAMEORIGIN',
            'Content-Security-Policy'   => "frame-ancestors 'self'",
            'X-Content-Type-Options'    => 'nosniff',
            'Referrer-Policy'           => 'same-origin',
        ];

        // Add IDM-specific headers to prevent interception for inline viewing
        if (!$isDownload) {
            $headers['X-Robots-Tag'] = 'noindex, nofollow';
            $headers['X-Download-Options'] = 'noopen';
            $headers['X-Permitted-Cross-Domain-Policies'] = 'none';
            // This header specifically tells IDM not to intercept
            $headers['X-Download-Initiator'] = 'browser-inline-view';
        }

        // Stream the file (no memory spike, reliable with iframes)
        return response()->stream(function () use ($fullPath) {
            $fh = fopen($fullPath, 'rb');
            fpassthru($fh);
            fclose($fh);
        }, 200, $headers);
    }

    public function deleteAllPress()
    {
        // Fetch all press entries
        $pressItems = Press::all();

        foreach ($pressItems as $item) {
            foreach (['pdf', 'guideline_pdf', 'photo', 'icon'] as $field) {
                if ($item->$field && Storage::disk('public')->exists($item->$field)) {
                    Storage::disk('public')->delete($item->$field);
                }
            }
        }

        // Delete all records
        Press::truncate();

        return redirect()->route('admin.press')
            ->with('success', 'All press entries and files have been deleted successfully.');
    }

    public function publicPress()
    {
        // Show all (or limit to latest X if you prefer)
        $pressItems = Press::latest()->get();
        return view('pages.press', compact('pressItems'));
    }


}
