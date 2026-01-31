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

        return view('admin.moderation.dashboard', compact('stats', 'reportStats', 'appealStats'));
    }

    // ============================================================
    // GESTION DES FLAGS (Contenus à réviser)
    // ============================================================

    /**
     * Liste les contenus flaggés
     */
    public function pendingFlags(Request $request)
    {
        $flags = ModerationFlag::where('status', 'pending')
            ->with(['flaggable', 'flaggable.requester'])
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.moderation.flags.index', compact('flags'));
    }

    /**
     * Détail d'un flag
     */
    public function showFlag(ModerationFlag $flag)
    {
        $flag->load(['flaggable', 'flaggable.requester', 'reviewer']);

        // Récupérer les signalements liés
        $reports = ContentReport::where('reportable_type', $flag->flaggable_type)
            ->where('reportable_id', $flag->flaggable_id)
            ->with('reporter:id,name')
            ->get();

        return view('admin.moderation.flags.show', compact('flag', 'reports'));
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
    public function pendingReports()
    {
        $reports = $this->reportService->getPendingReports(50);

        return view('admin.moderation.reports.index', compact('reports'));
    }

    /**
     * Traite un signalement
     */
    public function processReport(Request $request, ContentReport $report): JsonResponse
    {
        $request->validate([
            'decision' => 'required|in:valid,invalid,duplicate',
            'notes' => 'nullable|string|max:500',
        ]);

        $this->reportService->processReport(
            $report,
            $request->decision,
            $request->notes,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.report_processed'),
        ]);
    }

    // ============================================================
    // GESTION DES APPELS
    // ============================================================

    /**
     * Liste les appels en attente
     */
    public function pendingAppeals()
    {
        $appeals = $this->appealService->getPendingAppeals(50);

        return view('admin.moderation.appeals.index', compact('appeals'));
    }

    /**
     * Détail d'un appel
     */
    public function showAppeal(UserAppeal $appeal)
    {
        $appeal->load(['user', 'reviewer']);

        // Historique de l'utilisateur
        $userHistory = $this->sanctionManager->getUserHistory($appeal->user);

        return view('admin.moderation.appeals.show', compact('appeal', 'userHistory'));
    }

    /**
     * Traite un appel
     */
    public function processAppeal(Request $request, UserAppeal $appeal): JsonResponse
    {
        $request->validate([
            'decision' => 'required|in:approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $this->appealService->processAppeal(
            $appeal,
            $request->decision,
            $request->notes,
            auth()->id()
        );

        return response()->json([
            'success' => true,
            'message' => __('moderation.appeal_processed'),
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

        return view('admin.moderation.users.history', compact('user', 'history'));
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

        return view('admin.moderation.words.index', compact('words', 'languages'));
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
        $days = $request->input('days', 30);

        $stats = $this->moderationService->getStats($days);
        $reportStats = $this->reportService->getReportStats($days);
        $appealStats = $this->appealService->getAppealStats($days);

        return view('admin.moderation.statistics', compact('stats', 'reportStats', 'appealStats', 'days'));
    }
}
