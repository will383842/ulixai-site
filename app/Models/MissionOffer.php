<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionOffer extends Model
{
    protected $table = 'mission_offers';

    protected $fillable = [
        'mission_id',
        'provider_id',
        'price',
        'message',
        'delivery_time',
        'status',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===========================================
    // RELATIONSHIPS
    // ===========================================

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    // ===========================================
    // HELPER METHODS
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
}