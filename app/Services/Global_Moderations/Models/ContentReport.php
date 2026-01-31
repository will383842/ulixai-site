<?php

namespace App\Services\Global_Moderations\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ContentReport extends Model
{
    protected $fillable = [
        'reporter_id',
        'reportable_type',
        'reportable_id',
        'reported_user_id',
        'reason',
        'description',
        'screenshots',
        'status',
        'priority',
        'assigned_to',
        'resolved_by',
        'resolved_at',
        'resolution_notes',
        'action_taken',
    ];

    protected $casts = [
        'screenshots' => 'array',
        'resolved_at' => 'datetime',
    ];

    /**
     * Raisons de signalement
     */
    public const REASONS = [
        'inappropriate_content' => 'Contenu inapproprié',
        'spam' => 'Spam',
        'harassment' => 'Harcèlement',
        'contact_info' => 'Partage de coordonnées',
        'scam' => 'Arnaque',
        'fake_profile' => 'Faux profil',
        'hate_speech' => 'Discours haineux',
        'illegal_content' => 'Contenu illégal',
        'other' => 'Autre',
    ];

    /**
     * Priorités
     */
    public const PRIORITIES = [
        'low' => 'Basse',
        'medium' => 'Moyenne',
        'high' => 'Haute',
        'critical' => 'Critique',
    ];

    /**
     * Actions possibles
     */
    public const ACTIONS = [
        'no_action' => 'Aucune action',
        'content_removed' => 'Contenu supprimé',
        'user_warned' => 'Utilisateur averti',
        'user_suspended' => 'Utilisateur suspendu',
        'user_banned' => 'Utilisateur banni',
    ];

    /**
     * Relation avec le signalant
     */
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    /**
     * Relation polymorphique avec le contenu signalé
     */
    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation avec l'utilisateur signalé
     */
    public function reportedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    /**
     * Relation avec l'admin assigné
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relation avec l'admin qui a résolu
     */
    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    /**
     * Scope pour les signalements en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les signalements en investigation
     */
    public function scopeInvestigating($query)
    {
        return $query->where('status', 'investigating');
    }

    /**
     * Scope pour les signalements non résolus
     */
    public function scopeUnresolved($query)
    {
        return $query->whereIn('status', ['pending', 'investigating']);
    }

    /**
     * Scope par priorité
     */
    public function scopePriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope pour les signalements critiques
     */
    public function scopeCritical($query)
    {
        return $query->where('priority', 'critical');
    }

    /**
     * Assigne un signalement à un admin
     */
    public function assignTo(int $adminId): bool
    {
        return $this->update([
            'assigned_to' => $adminId,
            'status' => 'investigating',
        ]);
    }

    /**
     * Résout le signalement
     */
    public function resolve(int $adminId, string $action, ?string $notes = null): bool
    {
        return $this->update([
            'resolved_by' => $adminId,
            'resolved_at' => now(),
            'status' => 'resolved',
            'action_taken' => $action,
            'resolution_notes' => $notes,
        ]);
    }

    /**
     * Rejette le signalement (non fondé)
     */
    public function dismiss(int $adminId, ?string $notes = null): bool
    {
        return $this->update([
            'resolved_by' => $adminId,
            'resolved_at' => now(),
            'status' => 'dismissed',
            'action_taken' => 'no_action',
            'resolution_notes' => $notes,
        ]);
    }

    /**
     * Label de la raison
     */
    public function getReasonLabelAttribute(): string
    {
        return self::REASONS[$this->reason] ?? $this->reason;
    }

    /**
     * Label de la priorité
     */
    public function getPriorityLabelAttribute(): string
    {
        return self::PRIORITIES[$this->priority] ?? $this->priority;
    }

    /**
     * Label de l'action prise
     */
    public function getActionTakenLabelAttribute(): string
    {
        return self::ACTIONS[$this->action_taken] ?? $this->action_taken ?? 'N/A';
    }

    /**
     * Vérifie si c'est résolu
     */
    public function isResolved(): bool
    {
        return in_array($this->status, ['resolved', 'dismissed']);
    }

    /**
     * Définit la priorité automatiquement selon la raison
     */
    public static function getPriorityForReason(string $reason): string
    {
        return match ($reason) {
            'hate_speech', 'illegal_content' => 'critical',
            'harassment', 'scam' => 'high',
            'inappropriate_content', 'fake_profile' => 'medium',
            default => 'low',
        };
    }
}
