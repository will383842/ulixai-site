<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'missions';

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
        'service_durition',
        'location_country',
        'location_city',
        'is_remote',
        'language',
        'urgency',
        'status',
        'selected_provider_id',
        'payment_status',
        'is_fake',
        'attachments',
        'cancelled_by',
        'cancelled_on',
    ];

    // ============================================================
    // RELATIONSHIPS
    // ============================================================
    
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function selectedProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'selected_provider_id');
    }

    public function offers()
    {
        return $this->hasMany(MissionOffer::class, 'mission_id');
    }
    
    public function cancellationReasons()
    {
        return $this->hasMany(MissionCancellationReason::class, 'mission_id');
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'mission_id');
    }
    
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }

    // ============================================================
    // ✅ NOUVELLES MÉTHODES POUR BADGES MESSAGES PUBLICS
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
}