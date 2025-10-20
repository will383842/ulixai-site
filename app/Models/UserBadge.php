<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    protected $fillable = [
        'user_id', 'badge_id', 'assigned_by', 'assigned_by_id', 'meta', 'assigned_at', 'revoked_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'assigned_at' => 'datetime',
        'revoked_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
