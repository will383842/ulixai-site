<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionCancellationReason extends Model
{
    protected $fillable = [
        'mission_id',
        'cancelled_by',
        'reason',
        'email_sent',
        'custum_description'
    ];

    /**
     * Get the mission that this cancellation reason belongs to.
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
