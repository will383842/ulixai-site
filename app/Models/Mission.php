<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\Global_Moderations\Traits\HasModerationFlags;

class Mission extends Model
{
    use HasFactory, SoftDeletes, HasModerationFlags;

    /**
     * Table associée
     */
    protected $table = 'missions';

    /**
     * Attributs mass-assignables
     */
    protected $fillable = [
        'requester_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'title',
        'description',
        'budget_min',
        'budget_max',
        'budget_currency',
        'service_duration',
        'location_country',
        'location_city',
        'requester_duration_in_country',
        'is_remote',
        'language',
        'spoken_languages',
        'urgency',
        'status',
        'selected_provider_id',
        'payment_status',
        'is_fake',
        'attachments',
        'cancelled_by',
        'cancelled_on',
        
        // ✅ GDPR: Tracking consentement CGV
        'terms_accepted',
        'terms_accepted_at',
        'terms_version',
        'terms_accepted_ip',
        // Moderation fields
        'moderation_status',
        'moderation_score',
        'moderation_notes',
    ];

    /**
     * Attributs à caster
     */
    protected $casts = [
        'is_remote' => 'boolean',
        'is_fake' => 'boolean',
        'cancelled_on' => 'datetime',
        'deleted_at' => 'datetime', 
        'spoken_languages' => 'array',
        
        // ✅ GDPR: Cast consentement
        'terms_accepted' => 'boolean',
        'terms_accepted_at' => 'datetime',
    ];

    // ============================================================
    // RELATIONSHIPS
    // ============================================================
    
    /**
     * Relation avec l'utilisateur qui a créé la mission
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    /**
     * Relation avec la catégorie principale
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relation avec la sous-catégorie
     */
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    /**
     * Relation avec le prestataire sélectionné
     */
    public function selectedProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'selected_provider_id');
    }

    /**
     * Relation avec les offres/propositions reçues
     */
    public function offers()
    {
        return $this->hasMany(MissionOffer::class, 'mission_id');
    }
    
    /**
     * Relation avec les raisons d'annulation
     */
    public function cancellationReasons()
    {
        return $this->hasMany(MissionCancellationReason::class, 'mission_id');
    }

    /**
     * Vérifie si la mission est en attente de modération
     */
    public function isPendingModeration(): bool
    {
        return $this->moderation_status === 'pending';
    }

    /**
     * Vérifie si la mission est approuvée
     */
    public function isModerationApproved(): bool
    {
        return $this->moderation_status === 'approved';
    }

    /**
     * Relation avec les transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'mission_id');
    }
    
    /**
     * Relation avec la conversation (messagerie privée)
     */
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }

    // ============================================================
    // ✅ MÉTHODES POUR BADGES MESSAGES PUBLICS
    // ============================================================
    
    /**
     * Relation avec les messages publics (sur l'annonce)
     */
    public function publicMessages()
    {
        return $this->hasMany(MissionMessage::class, 'mission_id');
    }

    /**
     * Compter les messages publics non lus (pour le requester)
     */
    public function unreadPublicMessagesCount()
    {
        return $this->publicMessages()
            ->where('is_read', false)
            ->where('user_id', '!=', $this->requester_id) // Pas ses propres messages
            ->count();
    }

    /**
     * Compter les propositions récentes (dernières 24h = "nouvelles")
     */
    public function unreadOffersCount()
    {
        return $this->offers()
            ->where('created_at', '>=', now()->subDay())
            ->count();
    }

    // ============================================================
    // ✅ MÉTHODES UTILITAIRES GDPR
    // ============================================================
    
    /**
     * Vérifier si les CGV ont été acceptées
     */
    public function hasAcceptedTerms(): bool
    {
        return $this->terms_accepted === true 
            && $this->terms_accepted_at !== null;
    }

    /**
     * Obtenir les détails du consentement GDPR
     */
    public function getConsentDetails(): array
    {
        return [
            'accepted' => $this->terms_accepted,
            'accepted_at' => $this->terms_accepted_at?->toIso8601String(),
            'version' => $this->terms_version,
            'ip_address' => $this->terms_accepted_ip,
        ];
    }

    /**
     * Scope pour filtrer les missions avec CGV acceptées
     */
    public function scopeWithValidConsent($query)
    {
        return $query->where('terms_accepted', true)
                    ->whereNotNull('terms_accepted_at');
    }

    // ============================================================
    // ✅ MÉTHODES UTILITAIRES SOFT DELETE
    // ============================================================
    
    /**
     * Vérifier si la mission est supprimée (soft deleted)
     */
    public function isCancelled(): bool
    {
        return $this->trashed();
    }

    /**
     * Scope pour récupérer les missions annulées
     */
    public function scopeCancelled($query)
    {
        return $query->onlyTrashed();
    }

    /**
     * Scope pour récupérer toutes les missions (y compris annulées)
     */
    public function scopeWithCancelled($query)
    {
        return $query->withTrashed();
    }
}