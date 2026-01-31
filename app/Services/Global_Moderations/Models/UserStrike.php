<?php

namespace App\Services\Global_Moderations\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStrike extends Model
{
    protected $fillable = [
        'user_id',
        'reason',
        'details',
        'content_type',
        'content_id',
        'strike_number',
        'expires_at',
        'is_active',
        'issued_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Raisons possibles pour un strike
     */
    public const REASONS = [
        'banned_word_critical' => 'Mot interdit critique détecté',
        'contact_info' => 'Tentative de partage de coordonnées',
        'spam' => 'Comportement de spam',
        'reported_content' => 'Contenu signalé par les utilisateurs',
        'manual_admin' => 'Strike manuel par un admin',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'admin qui a émis le strike
     */
    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Scope pour les strikes actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Scope pour les strikes expirés
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', now());
    }

    /**
     * Vérifie si le strike est expiré
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Désactive le strike
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Label de la raison
     */
    public function getReasonLabelAttribute(): string
    {
        return self::REASONS[$this->reason] ?? $this->reason;
    }

    /**
     * Récupère le contenu associé (si existe)
     */
    public function getRelatedContent()
    {
        if (!$this->content_type || !$this->content_id) {
            return null;
        }

        $modelClass = match ($this->content_type) {
            'mission' => \App\Models\Mission::class,
            'message' => \App\Models\Message::class,
            'offer' => \App\Models\MissionOffer::class,
            default => null,
        };

        if (!$modelClass) {
            return null;
        }

        return $modelClass::find($this->content_id);
    }
}
