<?php

namespace App\Services\Global_Moderations\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAppeal extends Model
{
    protected $fillable = [
        'user_id',
        'appeal_type',
        'reason',
        'commitment',
        'evidence',
        'status',
        'reviewed_by',
        'reviewed_at',
        'admin_response',
        'admin_notes',
        'appeal_number',
        'submitted_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    /**
     * Statuts possibles
     */
    public const STATUSES = [
        'pending' => 'En attente',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
        'expired' => 'Expiré',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'admin qui a reviewé
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope pour les appels en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les appels récents
     */
    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Approuve l'appel
     */
    public function approve(int $adminId, string $response): bool
    {
        return $this->update([
            'status' => 'approved',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_response' => $response,
        ]);
    }

    /**
     * Rejette l'appel
     */
    public function reject(int $adminId, string $response): bool
    {
        return $this->update([
            'status' => 'rejected',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_response' => $response,
        ]);
    }

    /**
     * Marque comme expiré
     */
    public function expire(): bool
    {
        return $this->update(['status' => 'expired']);
    }

    /**
     * Vérifie si l'appel est en attente
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Vérifie si l'appel est approuvé
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Label du statut
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /**
     * Temps restant avant expiration (si pas encore reviewé)
     */
    public function getTimeRemainingAttribute(): ?string
    {
        if (!$this->isPending()) {
            return null;
        }

        $expiresAt = $this->created_at->addDays(config('moderations.ban.appeal_deadline_days', 7));

        if ($expiresAt->isPast()) {
            return 'Expiré';
        }

        return $expiresAt->diffForHumans();
    }
}
