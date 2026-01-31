<?php

namespace App\Services\Global_Moderations\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ModerationFlag extends Model
{
    protected $fillable = [
        'flaggable_type',
        'flaggable_id',
        'user_id',
        'flag_type',
        'status',
        'severity',
        'reason',
        'score',
        'details',
        'detected_issues',
        'matched_words',
        'has_contact_info',
        'is_spam',
        'original_content',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
    ];

    protected $casts = [
        'details' => 'array',
        'detected_issues' => 'array',
        'matched_words' => 'array',
        'has_contact_info' => 'boolean',
        'is_spam' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Statuts possibles
     */
    public const STATUSES = [
        'pending' => 'En attente de review',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
        'auto_rejected' => 'Rejeté automatiquement',
    ];

    /**
     * Relation polymorphique avec le contenu flaggé
     */
    public function flaggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation avec l'auteur du contenu
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
     * Scope pour les flags en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les flags critiques
     */
    public function scopeCritical($query)
    {
        return $query->where('severity', 'critical');
    }

    /**
     * Scope pour les flags warning
     */
    public function scopeWarning($query)
    {
        return $query->where('severity', 'warning');
    }

    /**
     * Scope pour filtrer par score minimum
     */
    public function scopeMinScore($query, int $minScore)
    {
        return $query->where('score', '>=', $minScore);
    }

    /**
     * Approuve le contenu
     */
    public function approve(int $adminId, ?string $notes = null): bool
    {
        return $this->update([
            'status' => 'approved',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'review_notes' => $notes,
        ]);
    }

    /**
     * Rejette le contenu
     */
    public function reject(int $adminId, ?string $notes = null): bool
    {
        return $this->update([
            'status' => 'rejected',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'review_notes' => $notes,
        ]);
    }

    /**
     * Vérifie si le flag est en attente
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Vérifie si le flag est approuvé
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Vérifie si le flag est rejeté
     */
    public function isRejected(): bool
    {
        return in_array($this->status, ['rejected', 'auto_rejected']);
    }

    /**
     * Label du statut
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /**
     * Résumé des problèmes détectés
     */
    public function getIssuesSummaryAttribute(): string
    {
        $issues = [];

        if ($this->has_contact_info) {
            $issues[] = 'Coordonnées détectées';
        }

        if ($this->is_spam) {
            $issues[] = 'Spam détecté';
        }

        if (!empty($this->matched_words)) {
            $count = count($this->matched_words);
            $issues[] = "$count mot(s) interdit(s)";
        }

        return implode(', ', $issues) ?: 'Aucun problème spécifique';
    }
}
