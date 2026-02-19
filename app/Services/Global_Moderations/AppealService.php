<?php

namespace App\Services\Global_Moderations;

use App\Models\User;
use App\Services\Global_Moderations\Models\UserAppeal;
use App\Services\Global_Moderations\Models\ModerationAction;
use App\Services\Global_Notifications\NotificationService;
use App\Services\Global_Notifications\Moderation\AppealApprovedNotification;
use App\Services\Global_Notifications\Moderation\AppealRejectedNotification;
use App\Services\Global_Notifications\Admin\NewAppealNotification;
use Illuminate\Support\Facades\DB;

/**
 * Service de gestion des appels (contestations de sanctions)
 */
class AppealService
{
    public function __construct(
        private SanctionManager $sanctionManager,
        private NotificationService $notificationService
    ) {}

    /**
     * Soumet un appel
     */
    public function submitAppeal(User $user, string $reason, ?string $evidence = null): array
    {
        // Vérifier si l'utilisateur peut faire appel
        if (!$user->can_appeal) {
            return [
                'success' => false,
                'message' => 'appeal_not_allowed',
            ];
        }

        // Vérifier la deadline d'appel
        if ($user->appeal_until && now()->isAfter($user->appeal_until)) {
            return [
                'success' => false,
                'message' => 'appeal_deadline_passed',
                'deadline' => $user->appeal_until,
            ];
        }

        // Vérifier s'il y a déjà un appel en cours
        $existingAppeal = UserAppeal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($existingAppeal) {
            return [
                'success' => false,
                'message' => 'appeal_already_pending',
            ];
        }

        return DB::transaction(function () use ($user, $reason, $evidence) {
            $appealType = $user->status === 'banned' ? 'ban' : ($user->status === 'suspended' ? 'suspension' : 'strike');

            $appeal = UserAppeal::create([
                'user_id' => $user->id,
                'appeal_type' => $appealType,
                'reason' => $reason,
                'evidence' => $evidence,
                'status' => 'pending',
                'submitted_at' => now(),
            ]);

            // Marquer que l'utilisateur ne peut plus faire appel (un seul appel autorisé)
            $user->forceFill(['can_appeal' => false])->save();

            ModerationAction::create([
                'user_id' => $user->id,
                'action_type' => 'appeal_submitted',
                'target_type' => UserAppeal::class,
                'target_id' => $appeal->id,
                'reason' => $reason,
                'ip_address' => request()->ip(),
            ]);

            // Notifier les admins qu'un nouvel appel a été soumis
            $this->notificationService->sendToModerators(
                new NewAppealNotification($appeal)
            );

            return [
                'success' => true,
                'message' => 'appeal_submitted',
                'appeal_id' => $appeal->id,
            ];
        });
    }

    /**
     * Traite un appel (décision admin)
     */
    public function processAppeal(
        UserAppeal $appeal,
        string $decision,
        ?string $notes = null,
        ?int $adminId = null
    ): void {
        DB::transaction(function () use ($appeal, $decision, $notes, $adminId) {
            $appeal->update([
                'status' => $decision,
                'reviewed_by' => $adminId,
                'reviewed_at' => now(),
                'admin_notes' => $notes,
            ]);

            $user = $appeal->user;

            if ($decision === 'approved') {
                // Appel accepté - lever la sanction
                if ($appeal->appeal_type === 'ban') {
                    $this->sanctionManager->unbanUser(
                        $user,
                        "Appel accepté: {$notes}",
                        $adminId
                    );
                } elseif ($appeal->appeal_type === 'suspension') {
                    // Lever la suspension
                    $user->forceFill([
                        'status' => 'active',
                        'ban_reason' => null,
                        'banned_at' => null,
                        'appeal_until' => null,
                    ])->save();
                } else {
                    // Retirer le dernier strike actif
                    $lastStrike = $user->activeStrikes()->latest()->first();
                    if ($lastStrike) {
                        $this->sanctionManager->removeStrike(
                            $lastStrike,
                            "Appel accepté: {$notes}",
                            $adminId
                        );
                    }
                }

                ModerationAction::create([
                    'user_id' => $user->id,
                    'admin_id' => $adminId,
                    'action_type' => 'appeal_approved',
                    'target_type' => UserAppeal::class,
                    'target_id' => $appeal->id,
                    'reason' => $notes,
                    'ip_address' => request()->ip(),
                ]);

                // Notifier l'utilisateur que son appel a été accepté
                $this->notificationService->send(
                    $user,
                    new AppealApprovedNotification($appeal, $notes)
                );
            } else {
                // Appel rejeté
                ModerationAction::create([
                    'user_id' => $user->id,
                    'admin_id' => $adminId,
                    'action_type' => 'appeal_rejected',
                    'target_type' => UserAppeal::class,
                    'target_id' => $appeal->id,
                    'reason' => $notes,
                    'ip_address' => request()->ip(),
                ]);

                // Notifier l'utilisateur que son appel a été rejeté
                // Un utilisateur ne peut pas faire d'autre appel après un rejet
                $this->notificationService->send(
                    $user,
                    new AppealRejectedNotification($appeal, false, 0)
                );
            }
        });
    }

    /**
     * Récupère les appels en attente
     */
    public function getPendingAppeals(int $limit = 50): \Illuminate\Database\Eloquent\Collection
    {
        return UserAppeal::where('status', 'pending')
            ->with(['user:id,name,email,status,banned_at'])
            ->orderBy('submitted_at', 'asc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère l'historique des appels d'un utilisateur
     */
    public function getUserAppeals(User $user): \Illuminate\Database\Eloquent\Collection
    {
        return UserAppeal::where('user_id', $user->id)
            ->orderBy('submitted_at', 'desc')
            ->get();
    }

    /**
     * Vérifie si un utilisateur peut faire appel
     */
    public function canAppeal(User $user): array
    {
        if (!$user->isBanned() && !$user->isSuspended() && $user->strike_count === 0) {
            return [
                'allowed' => false,
                'reason' => 'no_sanction_to_appeal',
            ];
        }

        if (!$user->can_appeal) {
            return [
                'allowed' => false,
                'reason' => 'appeal_already_used',
            ];
        }

        if ($user->appeal_until && now()->isAfter($user->appeal_until)) {
            return [
                'allowed' => false,
                'reason' => 'deadline_passed',
                'deadline' => $user->appeal_until,
            ];
        }

        $pendingAppeal = UserAppeal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingAppeal) {
            return [
                'allowed' => false,
                'reason' => 'appeal_pending',
            ];
        }

        return [
            'allowed' => true,
            'deadline' => $user->appeal_until,
        ];
    }

    /**
     * Statistiques des appels
     */
    public function getAppealStats(?int $days = 30): array
    {
        $since = now()->subDays($days);

        $total = UserAppeal::where('created_at', '>=', $since)->count();
        $approved = UserAppeal::where('status', 'approved')
            ->where('created_at', '>=', $since)
            ->count();
        $rejected = UserAppeal::where('status', 'rejected')
            ->where('created_at', '>=', $since)
            ->count();

        return [
            'total' => $total,
            'pending' => UserAppeal::where('status', 'pending')->count(),
            'approved' => $approved,
            'rejected' => $rejected,
            'approval_rate' => $total > 0 ? round(($approved / $total) * 100, 1) : 0,
            'by_type' => UserAppeal::where('created_at', '>=', $since)
                ->selectRaw('appeal_type, count(*) as count')
                ->groupBy('appeal_type')
                ->pluck('count', 'appeal_type'),
        ];
    }
}
