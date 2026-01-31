<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\CurrencyService;
use App\Services\Global_Moderations\Traits\HasModerationFlags;

class MissionOffer extends Model
{
    use HasFactory, SoftDeletes, HasModerationFlags;

    /**
     * Table associée
     */
    protected $table = 'mission_offers';

    /**
     * Attributs mass-assignables
     */
    protected $fillable = [
        'mission_id',
        'provider_id',
        'price',
        'currency',
        'message',
        'delivery_time',
        'status',
        'read_at',
        // Moderation fields
        'moderation_status',
        'moderation_score',
        'moderation_notes',
    ];

    /**
     * Attributs à caster
     */
    protected $casts = [
        'read_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'moderation_notes' => 'array',
    ];

    // ===========================================
    // RELATIONSHIPS
    // ===========================================

    /**
     * Relation avec la mission
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    /**
     * Relation avec le prestataire
     */
    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    // ===========================================
    // HELPER METHODS - STATUS
    // ===========================================

    /**
     * Check if offer is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if offer is accepted
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if offer is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Mark offer as accepted
     */
    public function markAsAccepted(): void
    {
        $this->update(['status' => 'accepted']);
    }

    /**
     * Mark offer as rejected
     */
    public function markAsRejected(): void
    {
        $this->update(['status' => 'rejected']);
    }

    // ===========================================
    // HELPER METHODS - READ STATUS
    // ===========================================

    /**
     * Check if the offer has been read
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * Mark the offer as read
     */
    public function markAsRead(): void
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    // ===========================================
    // HELPER METHODS - SOFT DELETE
    // ===========================================

    /**
     * Vérifier si l'offre est supprimée (soft deleted)
     */
    public function isCancelled(): bool
    {
        return $this->trashed();
    }

    // ===========================================
    // SCOPES
    // ===========================================

    /**
     * Scope pour les offres en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope pour les offres acceptées
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope pour les offres rejetées
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope pour les offres non lues
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope pour les offres d'une mission spécifique
     */
    public function scopeForMission($query, $missionId)
    {
        return $query->where('mission_id', $missionId);
    }

    /**
     * Scope pour les offres d'un prestataire spécifique
     */
    public function scopeForProvider($query, $providerId)
    {
        return $query->where('provider_id', $providerId);
    }

    /**
     * Scope pour récupérer les offres annulées (soft deleted)
     */
    public function scopeCancelled($query)
    {
        return $query->onlyTrashed();
    }

    /**
     * Scope pour récupérer toutes les offres (y compris annulées)
     */
    public function scopeWithCancelled($query)
    {
        return $query->withTrashed();
    }

    /**
     * Scope pour filtrer par devise
     */
    public function scopeByCurrency($query, string $currency)
    {
        return $query->where('currency', strtoupper($currency));
    }

    // ===========================================
    // ACCESSORS
    // ===========================================

    /**
     * Obtenir le prix formaté avec la devise
     *
     * @return string
     */
    public function getFormattedPriceAttribute(): string
    {
        $currency = $this->currency ?? $this->mission?->budget_currency ?? 'EUR';
        return CurrencyService::format($this->price, $currency, true);
    }

    // ===========================================
    // VALIDATION METHODS
    // ===========================================

    /**
     * Valide que la devise de l'offre correspond à celle de la mission
     *
     * @return bool
     */
    public function validateCurrencyMatchesMission(): bool
    {
        if (!$this->currency || !$this->mission) {
            return true; // Pas de validation si pas de devise ou pas de mission
        }

        return strtoupper($this->currency) === strtoupper($this->mission->budget_currency);
    }

    /**
     * Boot method pour ajouter les observers du modèle
     */
    protected static function boot()
    {
        parent::boot();

        // Validation avant création/mise à jour
        static::saving(function (MissionOffer $offer) {
            if (!$offer->validateCurrencyMatchesMission()) {
                throw new \InvalidArgumentException(
                    "La devise de l'offre ({$offer->currency}) ne correspond pas à celle de la mission ({$offer->mission->budget_currency})."
                );
            }
        });
    }
}