<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionCancellationReason extends Model
{
    /**
     * Table associée
     */
    protected $table = 'mission_cancellation_reasons';

    /**
     * Attributs mass-assignables
     */
    protected $fillable = [
        'mission_id',
        'cancelled_by',
        'reason',
        'email_sent',
        'custom_description'
    ]; // ✅ CORRECTION : Fermeture du tableau manquante

    /**
     * Attributs à caster
     */
    protected $casts = [
        'email_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the mission that this cancellation reason belongs to.
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}