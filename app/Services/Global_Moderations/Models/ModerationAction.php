<?php

namespace App\Services\Global_Moderations\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModerationAction extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'action_type',
        'target_type',
        'target_id',
        'reason',
        'metadata',
        'ip_address',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Types d'actions
     */
    public const ACTION_TYPES = [
        'content_blocked' => 'Contenu bloqué automatiquement',
        'content_approved' => 'Contenu approuvé',
        'content_rejected' => 'Contenu rejeté',
        'strike_issued' => 'Strike émis',
        'strike_removed' => 'Strike retiré',
        'user_warned' => 'Utilisateur averti',
        'user_suspended' => 'Utilisateur suspendu',
        'user_banned' => 'Utilisateur banni',
        'user_unbanned' => 'Utilisateur débanni',
        'appeal_submitted' => 'Appel soumis',
        'appeal_approved' => 'Appel approuvé',
        'appeal_rejected' => 'Appel rejeté',
    ];

    /**
     * Relation avec l'utilisateur concerné
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'admin qui a effectué l'action
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope pour un type d'action
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('action_type', $type);
    }

    /**
     * Scope pour les actions d'un utilisateur
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope pour les actions récentes
     */
    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Crée une action de contenu bloqué
     */
    public static function logContentBlocked(int $userId, string $targetType, int $targetId, string $reason, ?array $metadata = null): self
    {
        return self::create([
            'user_id' => $userId,
            'action_type' => 'content_blocked',
            'target_type' => $targetType,
            'target_id' => $targetId,
            'reason' => $reason,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Crée une action de strike émis
     */
    public static function logStrikeIssued(int $userId, int $strikeId, string $reason, ?int $adminId = null): self
    {
        return self::create([
            'user_id' => $userId,
            'admin_id' => $adminId,
            'action_type' => 'strike_issued',
            'target_type' => 'strike',
            'target_id' => $strikeId,
            'reason' => $reason,
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Crée une action de bannissement
     */
    public static function logUserBanned(int $userId, string $reason, ?int $adminId = null): self
    {
        return self::create([
            'user_id' => $userId,
            'admin_id' => $adminId,
            'action_type' => 'user_banned',
            'reason' => $reason,
            'ip_address' => request()->ip(),
        ]);
    }

    /**
     * Label du type d'action
     */
    public function getActionTypeLabelAttribute(): string
    {
        return self::ACTION_TYPES[$this->action_type] ?? $this->action_type;
    }

    /**
     * Récupère la cible de l'action
     */
    public function getTarget()
    {
        if (!$this->target_type || !$this->target_id) {
            return null;
        }

        $modelClass = match ($this->target_type) {
            'mission' => \App\Models\Mission::class,
            'message' => \App\Models\Message::class,
            'offer' => \App\Models\MissionOffer::class,
            'strike' => UserStrike::class,
            'user' => User::class,
            default => null,
        };

        if (!$modelClass) {
            return null;
        }

        return $modelClass::find($this->target_id);
    }

    /**
     * Vérifie si c'est une action punitive
     */
    public function isPunitive(): bool
    {
        return in_array($this->action_type, [
            'content_blocked',
            'content_rejected',
            'strike_issued',
            'user_warned',
            'user_suspended',
            'user_banned',
        ]);
    }
}
