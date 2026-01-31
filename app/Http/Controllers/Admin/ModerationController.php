<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Global_Moderations\ModerationService;
use App\Services\Global_Moderations\ReportService;
use App\Services\Global_Moderations\AppealService;
use App\Services\Global_Moderations\SanctionManager;
use App\Services\Global_Moderations\Models\ModerationFlag;
use App\Services\Global_Moderations\Models\ContentReport;
use App\Services\Global_Moderations\Models\UserAppeal;
use App\Services\Global_Moderations\Models\BannedWord;
use App\Services\Global_Moderations\Models\UserStrike;
use App\Services\Global_Moderations\WordFilter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModerationController extends Controller
{
    public function __construct(
        private ModerationService $moderationService,
        private ReportService $reportService,
        private AppealService $appealService,
        private SanctionManager $sanctionManager
    ) {}

    /**
     * Dashboard de modération
     */
    public function dashboard()
    {
        $stats = $this->moderationService->getStats(30);
        $reportStats = $this->reportService->getReportStats(30);
        $appealStats = $this->appealService->getAppealStats(30);

        // Compteurs pour le dashboard
        $pendingCounts = [
            'flags' => ModerationFlag::where('status', 'pending')->count(),
            'reports' => ContentReport::where('status', 'pending')->count(),
            'appeals' => UserAppeal::where('status', 'pending')->count(),
        ];

        return view('admin.moderation.dashboard', [
            'stats' => $stats,
            'pendingCounts' => $pendingCounts,
        ]);
    }

    // ============================================================
    // GESTION DES FLAGS (Contenus à réviser)
    // ============================================================

    /**
     * Liste les contenus flaggés
     */
    public function pendingFlags(Request $request)
    {
        $query = ModerationFlag::where('status', 'pending')
            ->with(['flaggable', 'user']);

        // Filtre par type (auto_blocked vs auto_review)
        if ($request->filled('type')) {
            $query->where('flag_type', $request->type);
        }

        // Filtre par sévérité
        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }

        // Trier par type (bloqués en premier) puis par date
        $flags = $query->orderByRaw("FIELD(flag_type, 'auto_blocked', 'auto_review') ASC")
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.moderation.flags.index', compact('flags'));
    }

    /**
     * Détail d'un flag
     */
    public function showFlag(ModerationFlag $flag)
    {
        $flag->load(['flaggable', 'user', 'reviewer']);

        // Récupérer les signalements liés
        $reports = ContentReport::where('reportable_type', $flag->flaggable_type)
            ->where('reportable_id', $flag->flaggable_id)
            ->with('reporter:id,name,avatar_url')
            ->get();

        // Historique de l'utilisateur si disponible
        $userHistory = null;
        if ($flag->user) {
            $userHistory = $this->sanctionManager->getUserHistory($flag->user);
        }

        return view('admin.moderation.flags.show', compact('flag', 'reports', 'userHistory'));
    }

    /**
     * Approuve un contenu flaggé
     */
    public function approveFlag(Request $request, ModerationFlag $flag): JsonResponse
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $this->moderationService->adminReview(
            $flag->flaggable,
            'approve',
            $request->notes,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.content_approved'),
        ]);
    }

    /**
     * Rejette un contenu flaggé
     */
    public function rejectFlag(Request $request, ModerationFlag $flag): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $this->moderationService->adminReview(
            $flag->flaggable,
            'reject',
            $request->reason,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.content_rejected'),
        ]);
    }

    // ============================================================
    // GESTION DES SIGNALEMENTS
    // ============================================================

    /**
     * Liste les signalements en attente
     */
    public function pendingReports(Request $request)
    {
        $query = ContentReport::with(['reportable', 'reporter']);

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['pending', 'investigating']);
        }

        // Filtre par priorité
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $reports = $query->orderByRaw("FIELD(priority, 'critical', 'high', 'medium', 'low')")
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.moderation.reports.index', compact('reports'));
    }

    /**
     * Détail d'un signalement
     */
    public function showReport(ContentReport $report)
    {
        $report->load(['reportable', 'reportable.user', 'reporter', 'resolver']);

        // Flags liés
        $relatedFlags = ModerationFlag::where('flaggable_type', $report->reportable_type)
            ->where('flaggable_id', $report->reportable_id)
            ->get();

        // Autres signalements sur le même contenu
        $otherReports = ContentReport::where('reportable_type', $report->reportable_type)
            ->where('reportable_id', $report->reportable_id)
            ->where('id', '!=', $report->id)
            ->with('reporter:id,name,avatar_url')
            ->get();

        // Stats du reporter
        $reporterStats = null;
        if ($report->reporter) {
            $totalReports = ContentReport::where('reporter_id', $report->reporter_id)->count();
            $validReports = ContentReport::where('reporter_id', $report->reporter_id)
                ->where('status', 'resolved')
                ->count();
            $reporterStats = [
                'total_reports' => $totalReports,
                'valid_rate' => $totalReports > 0 ? round(($validReports / $totalReports) * 100) : 0,
            ];
        }

        return view('admin.moderation.reports.show', compact('report', 'relatedFlags', 'otherReports', 'reporterStats'));
    }

    /**
     * Commence l'investigation d'un signalement
     */
    public function investigateReport(ContentReport $report): JsonResponse
    {
        $report->update([
            'status' => 'investigating',
            'investigating_since' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('moderation.report_investigating'),
        ]);
    }

    /**
     * Résout un signalement
     */
    public function resolveReport(Request $request, ContentReport $report): JsonResponse
    {
        $request->validate([
            'action' => 'required|string',
            'notes' => 'required|string|max:1000',
        ]);

        $this->reportService->processReport(
            $report,
            'valid',
            $request->notes,
            auth()->id()
        );

        // Exécuter l'action demandée
        if ($report->reportable && $report->reportable->user) {
            $this->executeReportAction($request->action, $report->reportable->user, $request->notes);
        }

        $report->update([
            'status' => 'resolved',
            'resolution_action' => $request->action,
            'resolution_notes' => $request->notes,
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('moderation.report_resolved'),
        ]);
    }

    /**
     * Rejette un signalement
     */
    public function dismissReport(ContentReport $report): JsonResponse
    {
        $this->reportService->processReport(
            $report,
            'invalid',
            'Signalement non fondé',
            auth()->id()
        );

        $report->update([
            'status' => 'dismissed',
            'resolved_by' => auth()->id(),
            'resolved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('moderation.report_dismissed'),
        ]);
    }

    /**
     * Exécute une action suite à un signalement
     */
    private function executeReportAction(string $action, User $user, string $reason): void
    {
        switch ($action) {
            case 'warn_user':
                $this->sanctionManager->warnUser($user, $reason, auth()->id());
                break;
            case 'strike_user':
                $this->sanctionManager->issueStrike($user, $reason, null, null, null, auth()->id());
                break;
            case 'suspend_user':
                $this->sanctionManager->suspendUser($user, 7, $reason, auth()->id());
                break;
            case 'ban_user':
                $this->sanctionManager->banUser($user, $reason, auth()->id());
                break;
            case 'remove_content':
                // Le contenu sera géré par le service de modération
                break;
        }
    }

    // ============================================================
    // GESTION DES APPELS
    // ============================================================

    /**
     * Liste les appels en attente
     */
    public function pendingAppeals(Request $request)
    {
        $query = UserAppeal::with(['user', 'moderationAction', 'reviewer']);

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['pending', 'under_review']);
        }

        $appeals = $query->orderBy('created_at', 'asc')->paginate(20);

        return view('admin.moderation.appeals.index', compact('appeals'));
    }

    /**
     * Détail d'un appel
     */
    public function showAppeal(UserAppeal $appeal)
    {
        $appeal->load(['user', 'moderationAction', 'moderationAction.actionable', 'moderationAction.admin', 'reviewer']);

        // Appels précédents de l'utilisateur
        $previousAppeals = UserAppeal::where('user_id', $appeal->user_id)
            ->where('id', '!=', $appeal->id)
            ->whereIn('status', ['approved', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.moderation.appeals.show', compact('appeal', 'previousAppeals'));
    }

    /**
     * Commence la révision d'un appel
     */
    public function startAppealReview(UserAppeal $appeal): JsonResponse
    {
        $appeal->update([
            'status' => 'under_review',
            'reviewed_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => __('moderation.appeal_review_started'),
        ]);
    }

    /**
     * Approuve un appel
     */
    public function approveAppeal(Request $request, UserAppeal $appeal): JsonResponse
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $this->appealService->processAppeal(
            $appeal,
            'approved',
            $request->notes,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.appeal_approved'),
        ]);
    }

    /**
     * Rejette un appel
     */
    public function rejectAppeal(Request $request, UserAppeal $appeal): JsonResponse
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $this->appealService->processAppeal(
            $appeal,
            'rejected',
            $request->notes,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.appeal_rejected'),
        ]);
    }

    // ============================================================
    // GESTION DES UTILISATEURS
    // ============================================================

    /**
     * Historique de modération d'un utilisateur
     */
    public function userHistory(User $user)
    {
        $history = $this->sanctionManager->getUserHistory($user);

        // Stats
        $stats = [
            'total_flags' => ModerationFlag::where('user_id', $user->id)->count(),
            'total_reports' => ContentReport::where('reportable_type', User::class)
                ->where('reportable_id', $user->id)
                ->count(),
        ];

        // Contenus flaggés
        $flaggedContent = ModerationFlag::where('user_id', $user->id)
            ->with('flaggable')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Signalements reçus
        $reportsReceived = ContentReport::where('reportable_type', User::class)
            ->where('reportable_id', $user->id)
            ->orWhereHas('reportable', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('reporter:id,name,avatar_url')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.moderation.users.history', compact('user', 'history', 'stats', 'flaggedContent', 'reportsReceived'));
    }

    /**
     * Action unifiée sur un utilisateur (warning, strike, suspend, ban)
     */
    public function userAction(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'action' => 'required|in:warning,strike,suspend,ban',
            'reason' => 'required|string|max:500',
            'days' => 'required_if:action,suspend|integer|min:1|max:30',
            'duration' => 'required_if:action,ban|string',
            'notify' => 'boolean',
        ]);

        switch ($request->action) {
            case 'warning':
                $this->sanctionManager->warnUser($user, $request->reason, auth()->id());
                $message = __('moderation.user_warned');
                break;

            case 'strike':
                $this->sanctionManager->issueStrike($user, $request->reason, null, null, null, auth()->id());
                $message = __('moderation.strike_issued');
                break;

            case 'suspend':
                $this->sanctionManager->suspendUser($user, $request->days, $request->reason, auth()->id());
                $message = __('moderation.user_suspended');
                break;

            case 'ban':
                $this->sanctionManager->banUser($user, $request->reason, auth()->id());
                $message = __('moderation.user_banned');
                break;

            default:
                return response()->json(['success' => false, 'message' => 'Action inconnue'], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Émet un strike manuellement
     */
    public function issueStrike(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:500',
            'details' => 'nullable|string|max:1000',
        ]);

        $strike = $this->sanctionManager->issueStrike(
            $user,
            $request->reason,
            $request->details,
            null,
            null,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.strike_issued'),
            'strike_id' => $strike->id,
            'strike_count' => $user->fresh()->strike_count,
        ]);
    }

    /**
     * Retire un strike
     */
    public function removeStrike(Request $request, UserStrike $strike): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $this->sanctionManager->removeStrike($strike, $request->reason, auth()->id());

        return response()->json([
            'success' => true,
            'message' => __('moderation.strike_removed'),
        ]);
    }

    /**
     * Bannit un utilisateur
     */
    public function banUser(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $this->sanctionManager->banUser($user, $request->reason, auth()->id());

        return response()->json([
            'success' => true,
            'message' => __('moderation.user_banned'),
        ]);
    }

    /**
     * Débannit un utilisateur
     */
    public function unbanUser(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $this->sanctionManager->unbanUser($user, $request->reason, auth()->id());

        return response()->json([
            'success' => true,
            'message' => __('moderation.user_unbanned'),
        ]);
    }

    /**
     * Suspend temporairement un utilisateur
     */
    public function suspendUser(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:30',
            'reason' => 'required|string|max:500',
        ]);

        $this->sanctionManager->suspendUser(
            $user,
            $request->days,
            $request->reason,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.user_suspended'),
        ]);
    }

    /**
     * Avertit un utilisateur
     */
    public function warnUser(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $this->sanctionManager->warnUser($user, $request->message, auth()->id());

        return response()->json([
            'success' => true,
            'message' => __('moderation.user_warned'),
        ]);
    }

    // ============================================================
    // GESTION DES MOTS INTERDITS
    // ============================================================

    /**
     * Liste les mots interdits
     */
    public function bannedWords(Request $request)
    {
        $query = BannedWord::query();

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $words = $query->orderBy('language')
            ->orderBy('category')
            ->paginate(50);

        $languages = config('moderations.supported_languages', []);

        // Stats
        $stats = [
            'total' => BannedWord::count(),
            'critical' => BannedWord::where('severity', 'critical')->count(),
            'warning' => BannedWord::where('severity', 'warning')->count(),
            'detections_today' => ModerationFlag::whereDate('created_at', today())
                ->whereNotNull('matched_words')
                ->count(),
        ];

        return view('admin.moderation.words.index', compact('words', 'languages', 'stats'));
    }

    /**
     * Toggle le statut d'un mot interdit
     */
    public function toggleBannedWord(BannedWord $word): JsonResponse
    {
        $word->update(['is_active' => !$word->is_active]);

        // Vider le cache
        WordFilter::clearCache();

        return response()->json([
            'success' => true,
            'message' => $word->is_active ? __('moderation.word_activated') : __('moderation.word_deactivated'),
            'is_active' => $word->is_active,
        ]);
    }

    /**
     * Importe des mots interdits depuis un fichier CSV
     */
    public function importBannedWords(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getPathname(), 'r');

        // Skip header
        fgetcsv($handle);

        $imported = 0;
        $errors = 0;

        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) < 4) continue;

            try {
                BannedWord::updateOrCreate(
                    ['word' => $data[0], 'language' => $data[3]],
                    [
                        'normalized_word' => app(WordFilter::class)->normalize($data[0]),
                        'category' => $data[1],
                        'severity' => $data[2],
                        'description' => $data[4] ?? null,
                        'is_active' => true,
                    ]
                );
                $imported++;
            } catch (\Exception $e) {
                $errors++;
            }
        }

        fclose($handle);

        // Vider le cache
        WordFilter::clearCache();

        return response()->json([
            'success' => true,
            'message' => "{$imported} mots importés" . ($errors > 0 ? ", {$errors} erreurs" : ''),
            'imported' => $imported,
            'errors' => $errors,
        ]);
    }

    /**
     * Ajoute un mot interdit
     */
    public function addBannedWord(Request $request): JsonResponse
    {
        $request->validate([
            'word' => 'required|string|max:100',
            'language' => 'required|string|in:' . implode(',', config('moderations.supported_languages', ['fr', 'en'])),
            'severity' => 'required|in:critical,warning,info',
            'category' => 'required|string|max:50',
            'is_regex' => 'boolean',
        ]);

        $word = BannedWord::create([
            'word' => $request->word,
            'normalized_word' => app(WordFilter::class)->normalize($request->word),
            'language' => $request->language,
            'severity' => $request->severity,
            'category' => $request->category,
            'is_regex' => $request->is_regex ?? false,
            'is_active' => true,
        ]);

        // Vider le cache
        WordFilter::clearCache();

        return response()->json([
            'success' => true,
            'message' => __('moderation.word_added'),
            'word' => $word,
        ]);
    }

    /**
     * Met à jour un mot interdit
     */
    public function updateBannedWord(Request $request, BannedWord $word): JsonResponse
    {
        $request->validate([
            'severity' => 'sometimes|in:critical,warning,info',
            'category' => 'sometimes|string|max:50',
            'is_active' => 'sometimes|boolean',
        ]);

        $word->update($request->only(['severity', 'category', 'is_active']));

        // Vider le cache
        WordFilter::clearCache();

        return response()->json([
            'success' => true,
            'message' => __('moderation.word_updated'),
        ]);
    }

    /**
     * Supprime un mot interdit
     */
    public function deleteBannedWord(BannedWord $word): JsonResponse
    {
        $word->delete();

        // Vider le cache
        WordFilter::clearCache();

        return response()->json([
            'success' => true,
            'message' => __('moderation.word_deleted'),
        ]);
    }

    // ============================================================
    // STATISTIQUES
    // ============================================================

    /**
     * Statistiques détaillées
     */
    public function statistics(Request $request)
    {
        $period = $request->input('period', 30);

        // Overview
        $overview = [
            'total_scanned' => ModerationFlag::where('created_at', '>=', now()->subDays($period))->count(),
            'blocked' => ModerationFlag::where('created_at', '>=', now()->subDays($period))
                ->where('status', 'blocked')->count(),
            'reviewed' => ModerationFlag::where('created_at', '>=', now()->subDays($period))
                ->whereIn('status', ['approved', 'rejected'])->count(),
            'strikes' => UserStrike::where('created_at', '>=', now()->subDays($period))->count(),
            'bans' => User::where('banned_at', '>=', now()->subDays($period))->count(),
            'scanned_change' => 0,
            'block_rate' => 0,
            'review_approved_rate' => 0,
        ];

        // Calculate rates
        if ($overview['total_scanned'] > 0) {
            $overview['block_rate'] = ($overview['blocked'] / $overview['total_scanned']) * 100;
        }
        $reviewed = ModerationFlag::where('created_at', '>=', now()->subDays($period))
            ->where('status', 'approved')->count();
        if ($overview['reviewed'] > 0) {
            $overview['review_approved_rate'] = ($reviewed / $overview['reviewed']) * 100;
        }

        // Top words detected
        $topWords = [];

        // Category stats
        $categoryStats = [];

        // Response times
        $responseTimes = [
            'avg_review_time' => 'N/A',
            'same_day' => 0,
            'pending_over_24h' => ModerationFlag::where('status', 'pending')
                ->where('created_at', '<', now()->subDay())
                ->count(),
        ];

        // User actions
        $userActions = [
            'warnings' => 0,
            'strikes' => UserStrike::where('created_at', '>=', now()->subDays($period))->count(),
            'suspensions' => User::where('suspended_until', '>=', now())
                ->where('updated_at', '>=', now()->subDays($period))
                ->count(),
            'bans' => User::where('banned_at', '>=', now()->subDays($period))->count(),
        ];

        // Appeal stats
        $appealStats = [
            'total' => UserAppeal::where('created_at', '>=', now()->subDays($period))->count(),
            'pending' => UserAppeal::where('status', 'pending')->count(),
            'approved' => UserAppeal::where('created_at', '>=', now()->subDays($period))
                ->where('status', 'approved')->count(),
            'rejected' => UserAppeal::where('created_at', '>=', now()->subDays($period))
                ->where('status', 'rejected')->count(),
            'approval_rate' => 0,
        ];
        if ($appealStats['approved'] + $appealStats['rejected'] > 0) {
            $appealStats['approval_rate'] = ($appealStats['approved'] / ($appealStats['approved'] + $appealStats['rejected'])) * 100;
        }

        // Reports by reason
        $reportsByReason = [];

        // Chart data
        $chartData = [
            'activity' => [
                'labels' => [],
                'scanned' => [],
                'blocked' => [],
                'pending' => [],
            ],
            'detectionTypes' => [
                'labels' => ['Mots interdits', 'Contact', 'Spam', 'Signalements'],
                'data' => [0, 0, 0, 0],
            ],
        ];

        return view('admin.moderation.statistics', compact(
            'overview', 'topWords', 'categoryStats', 'responseTimes',
            'userActions', 'appealStats', 'reportsByReason', 'chartData'
        ));
    }

    /**
     * Exporte les statistiques en CSV
     */
    public function exportStatistics(Request $request)
    {
        $period = $request->input('period', 30);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="moderation_stats_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($period) {
            $file = fopen('php://output', 'w');

            // Headers
            fputcsv($file, ['Statistiques de modération - ' . $period . ' derniers jours']);
            fputcsv($file, []);

            // Overview
            fputcsv($file, ['Métrique', 'Valeur']);
            fputcsv($file, ['Contenus scannés', ModerationFlag::where('created_at', '>=', now()->subDays($period))->count()]);
            fputcsv($file, ['Contenus bloqués', ModerationFlag::where('created_at', '>=', now()->subDays($period))->where('status', 'blocked')->count()]);
            fputcsv($file, ['Strikes émis', UserStrike::where('created_at', '>=', now()->subDays($period))->count()]);
            fputcsv($file, ['Utilisateurs bannis', User::where('banned_at', '>=', now()->subDays($period))->count()]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
