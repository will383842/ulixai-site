<?php

namespace App\Services;

use App\Models\User;
use App\Models\NotificationPreference;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;

class NotificationService
{
    /**
     * Types de notifications disponibles
     */
    const TYPE_DISPUTE = 'dispute';
    const TYPE_PAYMENT = 'payment';
    const TYPE_MISSION = 'mission';
    const TYPE_MESSAGE = 'message';
    const TYPE_ACCOUNT = 'account';

    /**
     * Canaux disponibles
     */
    const CHANNEL_EMAIL = 'email';
    const CHANNEL_DATABASE = 'database';

    /**
     * Envoie une notification à un utilisateur
     * Respecte les préférences utilisateur
     */
    public static function send(User $user, Notification $notification, string $type): void
    {
        $channels = self::getEnabledChannels($user, $type);

        if (empty($channels)) {
            Log::info('Notification skipped - all channels disabled', [
                'user_id' => $user->id,
                'type' => $type,
                'notification' => get_class($notification),
            ]);
            return;
        }

        try {
            $user->notify($notification);

            Log::info('Notification sent', [
                'user_id' => $user->id,
                'type' => $type,
                'channels' => $channels,
                'notification' => get_class($notification),
            ]);
        } catch (\Exception $e) {
            Log::error('Notification failed', [
                'user_id' => $user->id,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Envoie une notification à plusieurs utilisateurs
     */
    public static function sendToMany(array $users, Notification $notification, string $type): void
    {
        foreach ($users as $user) {
            if ($user instanceof User) {
                self::send($user, $notification, $type);
            }
        }
    }

    /**
     * Récupère les canaux activés pour un utilisateur et un type
     */
    public static function getEnabledChannels(User $user, string $type): array
    {
        $channels = [];

        if (NotificationPreference::isEnabled($user->id, self::CHANNEL_EMAIL, $type)) {
            $channels[] = 'mail';
        }

        if (NotificationPreference::isEnabled($user->id, self::CHANNEL_DATABASE, $type)) {
            $channels[] = 'database';
        }

        return $channels;
    }

    /**
     * Marque toutes les notifications d'un utilisateur comme lues
     */
    public static function markAllAsRead(User $user): int
    {
        return $user->unreadNotifications()->update(['read_at' => now()]);
    }

    /**
     * Marque une notification spécifique comme lue
     */
    public static function markAsRead(User $user, string $notificationId): bool
    {
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return true;
        }

        return false;
    }

    /**
     * Récupère les notifications non lues d'un utilisateur
     */
    public static function getUnread(User $user, int $limit = 10)
    {
        return $user->unreadNotifications()->take($limit)->get();
    }

    /**
     * Compte les notifications non lues
     */
    public static function countUnread(User $user): int
    {
        return $user->unreadNotifications()->count();
    }

    /**
     * Récupère toutes les notifications avec pagination
     */
    public static function getAll(User $user, int $perPage = 15)
    {
        return $user->notifications()->paginate($perPage);
    }

    /**
     * Met à jour les préférences de notification d'un utilisateur
     */
    public static function updatePreference(User $user, string $channel, string $type, bool $enabled): void
    {
        NotificationPreference::updateOrCreate(
            [
                'user_id' => $user->id,
                'channel' => $channel,
                'type' => $type,
            ],
            ['enabled' => $enabled]
        );
    }

    /**
     * Récupère toutes les préférences d'un utilisateur
     */
    public static function getPreferences(User $user): array
    {
        $preferences = NotificationPreference::where('user_id', $user->id)->get();

        $result = [];
        foreach ([self::TYPE_DISPUTE, self::TYPE_PAYMENT, self::TYPE_MISSION, self::TYPE_MESSAGE, self::TYPE_ACCOUNT] as $type) {
            foreach ([self::CHANNEL_EMAIL, self::CHANNEL_DATABASE] as $channel) {
                $pref = $preferences->where('type', $type)->where('channel', $channel)->first();
                $result[$type][$channel] = $pref ? $pref->enabled : true;
            }
        }

        return $result;
    }
}
