<?php

namespace App\Services\Global_Moderations;

use App\Models\User;
use App\Services\Global_Moderations\Models\ModerationFlag;
use App\Services\Global_Moderations\Models\ModerationAction;
use App\Services\Global_Notifications\NotificationService;
use App\Services\Global_Notifications\Moderation\ContentFlaggedNotification;
use App\Services\Global_Notifications\Moderation\ContentApprovedNotification;
use App\Services\Global_Notifications\Moderation\ContentRejectedNotification;
use App\Services\Global_Notifications\Admin\NewContentToReviewNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Service principal de modération
 * Orchestre tous les détecteurs et gère le workflow complet
 */
class ModerationService
{
    public function __construct(
        private WordFilter $wordFilter,
        private ContactDetector $contactDetector,
        private SpamDetector $spamDetector,
        private SanctionManager $sanctionManager,
        private NotificationService $notificationService
    ) {}

    /**
     * Analyse complète du contenu
     * Combine tous les détecteurs et retourne un résultat unifié
     */
    public function analyze(string $content, ?User $user = null): ModerationResult
    {
        $result = new ModerationResult();

        // 1. Analyse des mots interdits (toutes langues)
        $wordResult = $this->wordFilter->analyze($content);
        $this->mergeResults($result, $wordResult);

        // 2. Détection des coordonnées
        $contactResult = $this->contactDetector->analyze($content);
        $this->mergeResults($result, $contactResult);

        // 3. Détection du spam
        $spamResult = $this->spamDetector->analyze($content, $user);
        $this->mergeResults($result, $spamResult);

        // 4. Vérifier le score de confiance de l'utilisateur
        if ($user && $user->trust_score < 50) {
            $result->addScore(10);
            $result->addIssue('Score de confiance bas', 'info');
        }

        return $result;
    }

    /**
     * Modère un contenu et enregistre le résultat
     * Retourne le statut final (clean, review, blocked)
     */
    public function moderate(
        Model $content,
        string $textToAnalyze,
        User $author,
        string $contentType = 'mission'
    ): array {
        // Vérifier si l'utilisateur peut créer du contenu
        $canCreate = $this->spamDetector->canCreate($author, $contentType);

        if (!$canCreate['allowed']) {
            return [
                'allowed' => false,
                'status' => 'limit_exceeded',
                'message' => 'daily_limit_reached',
                'remaining' => 0,
                'limit' => $canCreate['limit'],
                'reset_at' => $canCreate['reset_at'],
            ];
        }

        // Analyser le contenu
        $result = $this->analyze($textToAnalyze, $author);
        $status = $result->getStatus();

        // Enregistrer la création pour le rate limiting
        $this->spamDetector->recordCreation($author);

        // Traiter selon le statut
        return match ($status) {
            ModerationResult::STATUS_BLOCKED => $this->handleBlocked($content, $result, $author),
            ModerationResult::STATUS_REVIEW => $this->handleReview($content, $result, $author),
            default => $this->handleClean($content, $result, $author, $canCreate),
        };
    }

    /**
     * Gère un contenu bloqué (score >= 70)
     */
    private function handleBlocked(Model $content, ModerationResult $result, User $author): array
    {
        DB::transaction(function () use ($content, $result, $author) {
            // Marquer le contenu comme bloqué
            $content->update([
                'moderation_status' => 'blocked',
                'moderation_score' => $result->getScore(),
                'moderation_notes' => json_encode($result->toArray()),
            ]);

            // Créer un flag de modération
            ModerationFlag::create([
                'flaggable_type' => get_class($content),
                'flaggable_id' => $content->id,
                'flag_type' => 'auto_blocked',
                'reason' => $result->getSummary(),
                'score' => $result->getScore(),
                'details' => $result->toArray(),
                'status' => 'pending',
            ]);

            // Logger l'action
            ModerationAction::create([
                'user_id' => $author->id,
                'action_type' => 'content_blocked',
                'target_type' => get_class($content),
                'target_id' => $content->id,
                'reason' => $result->getSummary(),
                'metadata' => $result->toArray(),
                'ip_address' => request()->ip(),
            ]);

            // Émettre un strike si mots critiques ou coordonnées critiques
            if ($result->hasCriticalWords() || $this->hasCriticalContacts($result)) {
                $this->sanctionManager->issueStrike(
                    $author,
                    $this->getStrikeReason($result),
                    $result->getSummary(),
                    get_class($content),
                    $content->id
                );
            }
        });

        Log::warning('Content blocked by moderation', [
            'content_type' => get_class($content),
            'content_id' => $content->id,
            'user_id' => $author->id,
            'score' => $result->getScore(),
            'issues' => $result->getIssues(),
        ]);

        return [
            'allowed' => false,
            'status' => 'blocked',
            'message' => 'content_blocked',
            'score' => $result->getScore(),
            'issues' => $this->getPublicIssues($result),
        ];
    }

    /**
     * Gère un contenu à réviser (score 30-69)
     */
    private function handleReview(Model $content, ModerationResult $result, User $author): array
    {
        $flag = null;
        $contentType = $this->getContentType($content);

        DB::transaction(function () use ($content, $result, $author, &$flag) {
            // Marquer le contenu pour révision
            $content->update([
                'moderation_status' => 'pending_review',
                'moderation_score' => $result->getScore(),
                'moderation_notes' => json_encode($result->toArray()),
            ]);

            // Créer un flag de modération
            $flag = ModerationFlag::create([
                'flaggable_type' => get_class($content),
                'flaggable_id' => $content->id,
                'flag_type' => 'auto_review',
                'reason' => $result->getSummary(),
                'score' => $result->getScore(),
                'details' => $result->toArray(),
                'status' => 'pending',
            ]);

            // Logger l'action
            ModerationAction::create([
                'user_id' => $author->id,
                'action_type' => 'content_pending_review',
                'target_type' => get_class($content),
                'target_id' => $content->id,
                'reason' => $result->getSummary(),
                'metadata' => $result->toArray(),
                'ip_address' => request()->ip(),
            ]);
        });

        // Notifier l'utilisateur que son contenu est en review
        $this->notificationService->send(
            $author,
            new ContentFlaggedNotification($flag, $contentType)
        );

        // Notifier les modérateurs qu'un nouveau contenu nécessite review
        $this->notificationService->sendToModerators(
            new NewContentToReviewNotification($flag)
        );

        Log::info('Content sent to review', [
            'content_type' => get_class($content),
            'content_id' => $content->id,
            'user_id' => $author->id,
            'score' => $result->getScore(),
        ]);

        return [
            'allowed' => true,
            'status' => 'pending_review',
            'message' => 'content_pending_review',
            'score' => $result->getScore(),
        ];
    }

    /**
     * Gère un contenu propre (score < 30)
     */
    private function handleClean(Model $content, ModerationResult $result, User $author, array $canCreate): array
    {
        // Marquer le contenu comme approuvé
        $content->update([
            'moderation_status' => 'approved',
            'moderation_score' => $result->getScore(),
        ]);

        // Améliorer légèrement le score de confiance
        $this->sanctionManager->improvesTrustScore($author, 1);

        return [
            'allowed' => true,
            'status' => 'approved',
            'message' => 'content_approved',
            'remaining' => $canCreate['remaining'] - 1,
            'limit' => $canCreate['limit'],
        ];
    }

    /**
     * Fusionne deux résultats de modération
     */
    private function mergeResults(ModerationResult $target, ModerationResult $source): void
    {
        // Ajouter le score
        $target->addScore($source->getScore());

        // Fusionner les mots trouvés
        foreach ($source->getMatchedWords() as $word) {
            $target->addMatchedWord($word['word'], $word['severity'], $word['category']);
        }

        // Fusionner les contacts détectés
        foreach ($source->getDetectedContacts() as $contact) {
            $target->addDetectedContact($contact['type'], $contact['value'], $contact['severity']);
        }

        // Fusionner les indicateurs de spam
        foreach ($source->getSpamIndicators() as $indicator) {
            $target->addSpamIndicator($indicator['type'], $indicator['value'], $indicator['threshold']);
        }

        // Fusionner les issues
        foreach ($source->getIssues() as $issue) {
            $target->addIssue($issue['message'], $issue['severity']);
        }
    }

    /**
     * Vérifie si le résultat contient des contacts critiques
     */
    private function hasCriticalContacts(ModerationResult $result): bool
    {
        foreach ($result->getDetectedContacts() as $contact) {
            if ($contact['severity'] === 'critical') {
                return true;
            }
        }
        return false;
    }

    /**
     * Génère la raison du strike
     */
    private function getStrikeReason(ModerationResult $result): string
    {
        $reasons = [];

        if ($result->hasCriticalWords()) {
            $reasons[] = 'Contenu interdit';
        }

        if ($this->hasCriticalContacts($result)) {
            $reasons[] = 'Partage de coordonnées';
        }

        return implode(' + ', $reasons);
    }

    /**
     * Retourne les issues publiques (sans détails sensibles)
     */
    private function getPublicIssues(ModerationResult $result): array
    {
        $publicIssues = [];

        if ($result->hasCriticalWords()) {
            $publicIssues[] = 'inappropriate_content';
        }

        if ($result->hasContactInfo()) {
            $publicIssues[] = 'contact_info_detected';
        }

        if ($result->isSpam()) {
            $publicIssues[] = 'spam_detected';
        }

        return $publicIssues;
    }

    /**
     * Pré-validation rapide (sans enregistrement)
     * Utile pour validation en temps réel côté frontend
     */
    public function quickCheck(string $content): array
    {
        $hasProblems = false;
        $warnings = [];

        // Vérifier les mots critiques
        if ($this->wordFilter->hasCriticalWords($content)) {
            $hasProblems = true;
            $warnings[] = 'inappropriate_content';
        }

        // Vérifier les coordonnées critiques
        if ($this->contactDetector->hasCriticalContact($content)) {
            $hasProblems = true;
            $warnings[] = 'contact_info_not_allowed';
        }

        return [
            'valid' => !$hasProblems,
            'warnings' => $warnings,
        ];
    }

    /**
     * Vérifie si un utilisateur peut publier
     */
    public function canUserPublish(User $user, string $type = 'mission'): array
    {
        // Vérifier si banni
        if ($user->isBanned()) {
            return [
                'allowed' => false,
                'reason' => 'account_banned',
                'message' => $user->ban_reason,
            ];
        }

        // Vérifier si suspendu
        if ($user->isSuspended()) {
            return [
                'allowed' => false,
                'reason' => 'account_suspended',
                'until' => $user->appeal_until,
            ];
        }

        // Vérifier les limites quotidiennes
        return $this->spamDetector->canCreate($user, $type);
    }

    /**
     * Révision manuelle par un admin
     */
    public function adminReview(
        Model $content,
        string $decision,
        ?string $reason = null,
        ?int $adminId = null
    ): void {
        $author = $content->requester ?? $content->user ?? $content->sender;
        $contentType = $this->getContentType($content);
        $contentTitle = $content->title ?? $content->subject ?? 'Contenu';
        $strikeIssued = false;

        DB::transaction(function () use ($content, $decision, $reason, $adminId, $author, &$strikeIssued) {
            if ($decision === 'approve') {
                $content->update([
                    'moderation_status' => 'approved',
                ]);

                // Mettre à jour le flag
                ModerationFlag::where('flaggable_type', get_class($content))
                    ->where('flaggable_id', $content->id)
                    ->where('status', 'pending')
                    ->update([
                        'status' => 'approved',
                        'reviewed_by' => $adminId,
                        'reviewed_at' => now(),
                        'review_notes' => $reason,
                    ]);

                ModerationAction::create([
                    'user_id' => $author?->id,
                    'admin_id' => $adminId,
                    'action_type' => 'content_approved_manually',
                    'target_type' => get_class($content),
                    'target_id' => $content->id,
                    'reason' => $reason,
                    'ip_address' => request()->ip(),
                ]);
            } elseif ($decision === 'reject') {
                $content->update([
                    'moderation_status' => 'rejected',
                ]);

                // Mettre à jour le flag
                ModerationFlag::where('flaggable_type', get_class($content))
                    ->where('flaggable_id', $content->id)
                    ->where('status', 'pending')
                    ->update([
                        'status' => 'rejected',
                        'reviewed_by' => $adminId,
                        'reviewed_at' => now(),
                        'review_notes' => $reason,
                    ]);

                ModerationAction::create([
                    'user_id' => $author?->id,
                    'admin_id' => $adminId,
                    'action_type' => 'content_rejected_manually',
                    'target_type' => get_class($content),
                    'target_id' => $content->id,
                    'reason' => $reason,
                    'ip_address' => request()->ip(),
                ]);

                // Émettre un strike si rejeté
                if ($author) {
                    $this->sanctionManager->issueStrike(
                        $author,
                        $reason ?? 'Contenu rejeté par la modération',
                        null,
                        get_class($content),
                        $content->id,
                        $adminId
                    );
                    $strikeIssued = true;
                }
            }
        });

        // Envoyer les notifications à l'auteur
        if ($author) {
            if ($decision === 'approve') {
                $this->notificationService->send(
                    $author,
                    new ContentApprovedNotification($contentType, $content->id, $contentTitle)
                );
            } elseif ($decision === 'reject') {
                $this->notificationService->send(
                    $author,
                    new ContentRejectedNotification(
                        $contentType,
                        $contentTitle,
                        $reason ?? 'Contenu non conforme',
                        $strikeIssued
                    )
                );
            }
        }
    }

    /**
     * Statistiques de modération
     */
    public function getStats(?int $days = 30): array
    {
        $since = now()->subDays($days);

        return Cache::remember("moderation_stats_{$days}", 300, function () use ($since) {
            return [
                'total_flags' => ModerationFlag::where('created_at', '>=', $since)->count(),
                'pending_flags' => ModerationFlag::where('status', 'pending')->count(),
                'blocked_today' => ModerationAction::where('action_type', 'content_blocked')
                    ->whereDate('created_at', today())
                    ->count(),
                'strikes_issued' => ModerationAction::where('action_type', 'strike_issued')
                    ->where('created_at', '>=', $since)
                    ->count(),
                'users_banned' => ModerationAction::where('action_type', 'user_banned')
                    ->where('created_at', '>=', $since)
                    ->count(),
                'by_type' => ModerationFlag::where('created_at', '>=', $since)
                    ->selectRaw('flag_type, count(*) as count')
                    ->groupBy('flag_type')
                    ->pluck('count', 'flag_type'),
            ];
        });
    }

    /**
     * Détermine le type de contenu à partir du modèle
     */
    private function getContentType(Model $content): string
    {
        $className = class_basename($content);

        return match ($className) {
            'Mission' => 'mission',
            'MissionOffer' => 'offer',
            'Message' => 'message',
            default => 'content',
        };
    }
}
