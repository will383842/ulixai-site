<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'mission_id', 
        'requester_id', 
        'provider_id', 
        'type',
        'last_message_at'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    // ===========================================
    // RELATIONSHIPS
    // ===========================================

    public function mission() 
    { 
        return $this->belongsTo(Mission::class); 
    }

    public function requester() 
    { 
        return $this->belongsTo(User::class, 'requester_id'); 
    }

    public function provider() 
    { 
        return $this->belongsTo(ServiceProvider::class, 'provider_id'); 
    }

    public function messages() 
    { 
        return $this->hasMany(Message::class); 
    }

    public function reports() 
    { 
        return $this->hasMany(ConversationReport::class, 'conversation_id'); 
    }

    // ===========================================
    // HELPER METHODS
    // ===========================================

    /**
     * Check if conversation is for a service
     */
    public function isService(): bool
    {
        return $this->type === 'service';
    }

    /**
     * Check if conversation is for a job
     */
    public function isJob(): bool
    {
        return $this->type === 'job';
    }
}