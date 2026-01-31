<?php

namespace App\Services\Global_Notifications;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class NotificationService
{
    /**
     * Envoie une notification à un utilisateur
     */
    public function send(User $user, Notification $notification): void
    {
        try {
            $user->notify($notification);
        } catch (\Exception $e) {
            Log::error('Failed to send notification', [
                'user_id' => $user->id,
                'notification' => get_class($notification),
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Envoie une notification à plusieurs utilisateurs
     */
    public function sendToMany(Collection|array $users, Notification $notification): void
    {
        foreach ($users as $user) {
            $this->send($user, $notification);
        }
    }

    /**
     * Envoie une notification à tous les admins
     */
    public function sendToAdmins(Notification $notification): void
    {
        $admins = User::whereIn('user_role', ['super_admin', 'regional_admin', 'moderator'])->get();
        $this->sendToMany($admins, $notification);
    }

    /**
     * Envoie une notification à tous les super admins
     */
    public function sendToSuperAdmins(Notification $notification): void
    {
        $superAdmins = User::where('user_role', 'super_admin')->get();
        $this->sendToMany($superAdmins, $notification);
    }

    /**
     * Envoie une notification aux modérateurs
     */
    public function sendToModerators(Notification $notification): void
    {
        $moderators = User::whereIn('user_role', ['super_admin', 'moderator'])->get();
        $this->sendToMany($moderators, $notification);
    }

    /**
     * Marque toutes les notifications comme lues pour un utilisateur
     */
    public function markAllAsRead(User $user): int
    {
        return $user->unreadNotifications()->update(['read_at' => now()]);
    }

    /**
     * Supprime les anciennes notifications
     */
    public function pruneOldNotifications(int $daysToKeep = 90): int
    {
        return \Illuminate\Notifications\DatabaseNotification::where('created_at', '<', now()->subDays($daysToKeep))
            ->delete();
    }

    /**
     * Récupère les notifications non lues d'un utilisateur
     */
    public function getUnreadNotifications(User $user, int $limit = 10): Collection
    {
        return $user->unreadNotifications()->take($limit)->get();
    }

    /**
     * Récupère toutes les notifications d'un utilisateur
     */
    public function getAllNotifications(User $user, int $perPage = 15)
    {
        return $user->notifications()->paginate($perPage);
    }

    /**
     * Compte les notifications non lues
     */
    public function countUnread(User $user): int
    {
        return $user->unreadNotifications()->count();
    }
}
