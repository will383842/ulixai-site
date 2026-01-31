<?php

namespace App\Services\Global_Moderations;

use App\Models\User;
use App\Services\Global_Moderations\Models\ContentReport;
use App\Services\Global_Moderations\Models\ModerationFlag;
use App\Services\Global_Moderations\Models\ModerationAction;
use App\Services\Global_Notifications\NotificationService;
use App\Services\Global_Notifications\Admin\NewReportNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Service de gestion des signalements utilisateurs
 */
class ReportService
{
    public function __construct(
        private SanctionManager $sanctionManager,
        private SpamDetector $spamDetector,
        private NotificationService $notificationService
    ) {}

    /**
     * Soumet un signalement
     */
    public function submitReport(
        User $reporter,
        Model $content,
        string $reason,
        ?string $description = null
    ): array {
        // Vérifier le rate limiting
        $canReport = $this->spamDetector->canCreate($reporter, 'report');

        if (!$canReport['allowed']) {
            return [
                'success' => false,
                'message' => 'report_limit_exceeded',
                'remaining' => 0,
                'reset_at' => $canReport['reset_at'],
            ];
        }

        // Vérifier si l'utilisateur a déjà signalé ce contenu
        $existingReport = ContentReport::where('reporter_id', $reporter->id)
            ->where('reportable_type', get_class($content))
            ->where('reportable_id', $content->id)
            ->exists();

        if ($existingReport) {
            return [
                'success' => false,
                'message' => 'already_reported',
            ];
        }

        $report = null;

        DB::transaction(function () use ($reporter, $content, $reason, $description, &$report) {
            // Récupérer l'ID de l'auteur du contenu
            $reportedUserId = $this->getContentAuthorId($content);

            // Créer le signalement
            $report = ContentReport::create([
                'reporter_id' => $reporter->id,
                'reportable_type' => get_class($content),
                'reportable_id' => $content->id,
                'reported_user_id' => $reportedUserId,
                'reason' => $this->mapReasonToEnum($reason),
                'description' => $description,
                'status' => 'pending',
                'priority' => ContentReport::getPriorityForReason($reason),
            ]);

            // Compter le nombre total de signalements pour ce contenu
            $totalReports = ContentReport::where('reportable_type', get_class($content))
                ->where('reportable_id', $content->id)
                ->count();

            // Créer ou mettre à jour le flag de modération si seuil atteint
            $thresholdForReview = config('moderations.reports.auto_review_threshold', 3);
            $thresholdForAutoBlock = config('moderations.reports.auto_suspend_threshold', 10);

            if ($totalReports >= $thresholdForAutoBlock) {
                $this->autoBlockContent($content, $totalReports);
            } elseif ($totalReports >= $thresholdForReview) {
                $this->flagForReview($content, $totalReports);
            }

            // Logger l'action
            ModerationAction::create([
                'user_id' => $this->getContentAuthorId($content),
                'admin_id' => null,
                'action_type' => 'content_reported',
                'target_type' => get_class($content),
                'target_id' => $content->id,
                'reason' => $reason,
                'metadata' => [
                    'reporter_id' => $reporter->id,
                    'total_reports' => $totalReports,
                ],
                'ip_address' => request()->ip(),
            ]);
        });

        // Notifier les modérateurs du nouveau signalement
        if ($report) {
            $this->notificationService->sendToModerators(
                new NewReportNotification($report)
            );
        }

        return [
            'success' => true,
            'message' => 'report_submitted',
            'report_id' => $report->id,
        ];
    }

    /**
     * Flag le contenu pour révision
     */
    private function flagForReview(Model $content, int $reportCount): void
    {
        // Vérifier si un flag existe déjà
        $existingFlag = ModerationFlag::where('flaggable_type', get_class($content))
            ->where('flaggable_id', $content->id)
            ->where('status', 'pending')
            ->first();

        if ($existingFlag) {
            // Mettre à jour le compteur
            $existingFlag->update([
                'details' => array_merge($existingFlag->details ?? [], [
                    'report_count' => $reportCount,
                ]),
            ]);
        } else {
            ModerationFlag::create([
                'flaggable_type' => get_class($content),
                'flaggable_id' => $content->id,
                'flag_type' => 'user_reported',
                'reason' => "Signalé par {$reportCount} utilisateur(s)",
                'score' => min(100, $reportCount * 10),
                'details' => ['report_count' => $reportCount],
                'status' => 'pending',
            ]);
        }

        // Mettre à jour le statut du contenu
        $content->update([
            'moderation_status' => 'pending_review',
        ]);
    }

    /**
     * Bloque automatiquement le contenu (trop de signalements)
     */
    private function autoBlockContent(Model $content, int $reportCount): void
    {
        $content->update([
            'moderation_status' => 'blocked',
            'moderation_notes' => json_encode([
                'reason' => 'auto_blocked_reports',
                'report_count' => $reportCount,
            ]),
        ]);

        ModerationFlag::updateOrCreate(
            [
                'flaggable_type' => get_class($content),
                'flaggable_id' => $content->id,
            ],
            [
                'flag_type' => 'auto_blocked_reports',
                'reason' => "Auto-bloqué: {$reportCount} signalement(s)",
                'score' => 100,
                'details' => ['report_count' => $reportCount],
                'status' => 'pending',
            ]
        );

        // Émettre un avertissement à l'auteur
        $authorId = $this->getContentAuthorId($content);
        if ($authorId) {
            $author = User::find($authorId);
            if ($author) {
                $this->sanctionManager->warnUser(
                    $author,
                    "Contenu bloqué suite à de nombreux signalements ({$reportCount})"
                );
            }
        }
    }

    /**
     * Récupère l'ID de l'auteur du contenu
     */
    private function getContentAuthorId(Model $content): ?int
    {
        return $content->requester_id
            ?? $content->user_id
            ?? $content->sender_id
            ?? $content->author_id
            ?? null;
    }

    /**
     * Mappe une raison simple vers l'enum de la BDD
     */
    private function mapReasonToEnum(string $reason): string
    {
        return match ($reason) {
            'inappropriate' => 'inappropriate_content',
            'spam' => 'spam',
            'harassment' => 'harassment',
            'fraud' => 'scam',
            'other' => 'other',
            default => $reason, // Si déjà au bon format
        };
    }

    /**
     * Récupère les signalements pour un contenu
     */
    public function getReportsForContent(Model $content): array
    {
        $reports = ContentReport::where('reportable_type', get_class($content))
            ->where('reportable_id', $content->id)
            ->with('reporter:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return [
            'total' => $reports->count(),
            'by_reason' => $reports->groupBy('reason')->map->count(),
            'reports' => $reports,
        ];
    }

    /**
     * Traite un signalement (admin)
     * @param string $decision 'valid' ou 'invalid' ou 'duplicate'
     */
    public function processReport(
        ContentReport $report,
        string $decision,
        ?string $notes = null,
        ?int $adminId = null
    ): void {
        DB::transaction(function () use ($report, $decision, $notes, $adminId) {
            // Mapper la décision vers les statuts du modèle
            $status = match ($decision) {
                'valid' => 'resolved',
                'invalid', 'duplicate' => 'dismissed',
                default => 'dismissed',
            };

            $actionTaken = match ($decision) {
                'valid' => 'content_removed',
                default => 'no_action',
            };

            $report->update([
                'status' => $status,
                'resolved_by' => $adminId,
                'resolved_at' => now(),
                'resolution_notes' => $notes,
                'action_taken' => $actionTaken,
            ]);

            if ($decision === 'valid') {
                // Signalement valide - prendre des mesures sur le contenu
                $report->reportable->update([
                    'moderation_status' => 'blocked',
                ]);

                // Émettre un strike à l'auteur
                $authorId = $this->getContentAuthorId($report->reportable);
                if ($authorId) {
                    $author = User::find($authorId);
                    if ($author) {
                        $this->sanctionManager->issueStrike(
                            $author,
                            "Contenu signalé: {$report->reason}",
                            $notes,
                            get_class($report->reportable),
                            $report->reportable->id,
                            $adminId
                        );
                    }
                }

                // Améliorer le score de confiance du signaleur
                if ($report->reporter) {
                    $this->sanctionManager->improvesTrustScore($report->reporter, 2);
                }
            } elseif ($decision === 'invalid') {
                // Signalement invalide/abusif
                // Réduire légèrement le score de confiance du signaleur
                if ($report->reporter) {
                    $report->reporter->update([
                        'trust_score' => max(0, $report->reporter->trust_score - 2),
                    ]);
                }
            }

            ModerationAction::create([
                'user_id' => $report->reporter_id,
                'admin_id' => $adminId,
                'action_type' => "report_{$decision}",
                'target_type' => ContentReport::class,
                'target_id' => $report->id,
                'reason' => $notes,
                'ip_address' => request()->ip(),
            ]);
        });
    }

    /**
     * Récupère les signalements en attente
     */
    public function getPendingReports(int $limit = 50): \Illuminate\Database\Eloquent\Collection
    {
        return ContentReport::where('status', 'pending')
            ->with(['reporter:id,name', 'reportable'])
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->get();
    }

    /**
     * Statistiques des signalements
     */
    public function getReportStats(?int $days = 30): array
    {
        $since = now()->subDays($days);

        return [
            'total' => ContentReport::where('created_at', '>=', $since)->count(),
            'pending' => ContentReport::where('status', 'pending')->count(),
            'investigating' => ContentReport::where('status', 'investigating')->count(),
            'resolved' => ContentReport::where('status', 'resolved')
                ->where('created_at', '>=', $since)
                ->count(),
            'dismissed' => ContentReport::where('status', 'dismissed')
                ->where('created_at', '>=', $since)
                ->count(),
            'by_reason' => ContentReport::where('created_at', '>=', $since)
                ->selectRaw('reason, count(*) as count')
                ->groupBy('reason')
                ->pluck('count', 'reason'),
            'by_priority' => ContentReport::where('created_at', '>=', $since)
                ->selectRaw('priority, count(*) as count')
                ->groupBy('priority')
                ->pluck('count', 'priority'),
        ];
    }
}
