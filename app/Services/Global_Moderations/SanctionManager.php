<?php

namespace App\Services\Global_Moderations;

use App\Models\User;
use App\Services\Global_Moderations\Models\UserStrike;
use App\Services\Global_Moderations\Models\ModerationAction;
use App\Services\Global_Notifications\NotificationService;
use App\Services\Global_Notifications\Moderation\StrikeNotification;
use App\Services\Global_Notifications\Moderation\UserBannedNotification;
use Illuminate\Support\Facades\DB;

class SanctionManager
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    /**
     * Émet un strike à un utilisateur
     */
    public function issueStrike(
        User $user,
        string $reason,
        ?string $details = null,
        ?string $contentType = null,
        ?int $contentId = null,
        ?int $issuedBy = null
    ): UserStrike {
        return DB::transaction(function () use ($user, $reason, $details, $contentType, $contentId, $issuedBy) {
            // Compter les strikes actifs actuels
            $activeStrikes = $user->activeStrikes()->count();
            $newStrikeNumber = $activeStrikes + 1;
            $maxStrikes = config('moderations.strikes.max_before_ban', 3);

            // Calculer la date d'expiration du strike
            $expiryMonths = config('moderations.strikes.expiry_months', 6);
            $expiresAt = $expiryMonths ? now()->addMonths($expiryMonths) : null;

            // Créer le strike
            $strike = UserStrike::create([
                'user_id' => $user->id,
                'reason' => $reason,
                'details' => $details,
                'content_type' => $contentType,
                'content_id' => $contentId,
                'strike_number' => $newStrikeNumber,
                'expires_at' => $expiresAt,
                'is_active' => true,
                'issued_by' => $issuedBy,
            ]);

            // Mettre à jour le compteur et la date sur l'utilisateur
            $user->update([
                'strike_count' => $newStrikeNumber,
                'last_strike_at' => now(),
            ]);

            // Réduire le score de confiance
            $trustPenalty = config('moderations.strikes.trust_score_penalty', 20);
            $newTrustScore = max(0, $user->trust_score - $trustPenalty);
            $user->update(['trust_score' => $newTrustScore]);

            // Logger l'action
            ModerationAction::logStrikeIssued($user->id, $strike->id, $reason, $issuedBy);

            // Vérifier si on doit bannir l'utilisateur
            if ($newStrikeNumber >= $maxStrikes) {
                $this->banUser($user, "3 strikes atteints: {$reason}", $issuedBy);
            } else {
                // Notifier l'utilisateur du strike
                $this->notificationService->send(
                    $user,
                    new StrikeNotification($strike, $newStrikeNumber, $maxStrikes)
                );
            }

            return $strike;
        });
    }

    /**
     * Bannit un utilisateur
     */
    public function banUser(User $user, string $reason, ?int $bannedBy = null): void
    {
        DB::transaction(function () use ($user, $reason, $bannedBy) {
            $appealDeadlineDays = config('moderations.ban.appeal_deadline_days', 7);

            $user->update([
                'status' => 'banned',
                'ban_reason' => $reason,
                'banned_at' => now(),
                'can_appeal' => true,
                'appeal_until' => now()->addDays($appealDeadlineDays),
            ]);

            // Logger l'action
            ModerationAction::logUserBanned($user->id, $reason, $bannedBy);

            // Notifier l'utilisateur
            $this->notificationService->send(
                $user,
                new UserBannedNotification(
                    $reason,
                    $user->can_appeal,
                    $user->appeal_until
                )
            );
        });
    }

    /**
     * Débannit un utilisateur
     */
    public function unbanUser(User $user, string $reason, ?int $unbannedBy = null): void
    {
        DB::transaction(function () use ($user, $reason, $unbannedBy) {
            $user->update([
                'status' => 'active',
                'ban_reason' => null,
                'banned_at' => null,
                'can_appeal' => true,
                'appeal_until' => null,
                'strike_count' => 0, // Reset les strikes
            ]);

            // Désactiver tous les strikes
            UserStrike::where('user_id', $user->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            // Restaurer le score de confiance (partiellement)
            $user->update(['trust_score' => 50]); // Score de confiance réduit après débannissement

            // Logger l'action
            ModerationAction::create([
                'user_id' => $user->id,
                'admin_id' => $unbannedBy,
                'action_type' => 'user_unbanned',
                'reason' => $reason,
                'ip_address' => request()->ip(),
            ]);
        });
    }

    /**
     * Suspend temporairement un utilisateur
     */
    public function suspendUser(User $user, int $days, string $reason, ?int $suspendedBy = null): void
    {
        DB::transaction(function () use ($user, $days, $reason, $suspendedBy) {
            $user->update([
                'status' => 'suspended',
                'ban_reason' => $reason,
                'banned_at' => now(),
                'appeal_until' => now()->addDays($days),
            ]);

            ModerationAction::create([
                'user_id' => $user->id,
                'admin_id' => $suspendedBy,
                'action_type' => 'user_suspended',
                'reason' => $reason,
                'metadata' => ['duration_days' => $days],
                'ip_address' => request()->ip(),
            ]);
        });
    }

    /**
     * Retire un strike
     */
    public function removeStrike(UserStrike $strike, string $reason, ?int $removedBy = null): void
    {
        DB::transaction(function () use ($strike, $reason, $removedBy) {
            $strike->update(['is_active' => false]);

            $user = $strike->user;
            $activeCount = $user->activeStrikes()->count();
            $user->update(['strike_count' => $activeCount]);

            // Restaurer un peu de score de confiance
            $trustBonus = config('moderations.strikes.trust_score_penalty', 20) / 2;
            $newTrustScore = min(100, $user->trust_score + $trustBonus);
            $user->update(['trust_score' => $newTrustScore]);

            ModerationAction::create([
                'user_id' => $user->id,
                'admin_id' => $removedBy,
                'action_type' => 'strike_removed',
                'target_type' => 'strike',
                'target_id' => $strike->id,
                'reason' => $reason,
                'ip_address' => request()->ip(),
            ]);
        });
    }

    /**
     * Avertit un utilisateur (sans strike)
     */
    public function warnUser(User $user, string $message, ?int $warnedBy = null): void
    {
        ModerationAction::create([
            'user_id' => $user->id,
            'admin_id' => $warnedBy,
            'action_type' => 'user_warned',
            'reason' => $message,
            'ip_address' => request()->ip(),
        ]);

        // Réduire légèrement le score de confiance
        $newTrustScore = max(0, $user->trust_score - 5);
        $user->update(['trust_score' => $newTrustScore]);
    }

    /**
     * Vérifie et nettoie les strikes expirés
     */
    public function cleanupExpiredStrikes(): int
    {
        $expiredStrikes = UserStrike::where('is_active', true)
            ->where('expires_at', '<=', now())
            ->get();

        $count = 0;

        foreach ($expiredStrikes as $strike) {
            $strike->update(['is_active' => false]);

            $user = $strike->user;
            $activeCount = $user->activeStrikes()->count();
            $user->update(['strike_count' => $activeCount]);

            $count++;
        }

        return $count;
    }

    /**
     * Récupère l'historique des sanctions d'un utilisateur
     */
    public function getUserHistory(User $user): array
    {
        return [
            'strikes' => $user->strikes()->orderBy('created_at', 'desc')->get(),
            'active_strikes' => $user->activeStrikes()->count(),
            'actions' => ModerationAction::forUser($user->id)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get(),
            'trust_score' => $user->trust_score,
            'status' => $user->status,
            'is_banned' => $user->isBanned(),
            'can_appeal' => $user->can_appeal,
        ];
    }

    /**
     * Vérifie si un utilisateur peut effectuer une action
     */
    public function canUserAct(User $user): array
    {
        if ($user->isBanned()) {
            return [
                'allowed' => false,
                'reason' => 'account_banned',
                'message' => $user->ban_reason,
                'can_appeal' => $user->can_appeal,
                'appeal_until' => $user->appeal_until,
            ];
        }

        if ($user->isSuspended()) {
            return [
                'allowed' => false,
                'reason' => 'account_suspended',
                'message' => $user->ban_reason,
                'until' => $user->appeal_until,
            ];
        }

        return [
            'allowed' => true,
            'trust_score' => $user->trust_score,
            'requires_review' => $user->requires_review || $user->trust_score < 50,
        ];
    }

    /**
     * Met à jour le score de confiance après une action positive
     */
    public function improvesTrustScore(User $user, int $points = 1): void
    {
        $maxScore = 100;
        $newScore = min($maxScore, $user->trust_score + $points);
        $user->update(['trust_score' => $newScore]);

        // Si le score remonte assez, désactiver la review obligatoire
        if ($newScore >= 70 && $user->requires_review) {
            $user->update(['requires_review' => false]);
        }
    }
}
