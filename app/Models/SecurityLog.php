<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'event_type', 'ip_address', 'user_agent',
        'country_code', 'city', 'risk_score', 'is_suspicious',
        'browser', 'platform', 'device', 'metadata',
    ];

    protected $casts = [
        'risk_score' => 'integer',
        'is_suspicious' => 'boolean',
        'metadata' => 'array',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
