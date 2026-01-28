<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'channel',
        'type',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vérifie si un utilisateur a activé un type de notification sur un canal
     */
    public static function isEnabled(int $userId, string $channel, string $type): bool
    {
        $pref = self::where('user_id', $userId)
            ->where('channel', $channel)
            ->where('type', $type)
            ->first();

        // Par défaut, toutes les notifications sont activées
        return $pref ? $pref->enabled : true;
    }
}
