<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'title', 'slug', 'icon', 'type', 'threshold', 'filters', 'is_active', 'is_auto', 'sort_order'
    ];

    protected $casts = [
        'filters' => 'array',
        'is_active' => 'boolean',
        'is_auto' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withPivot(['assigned_by', 'assigned_by_id', 'meta', 'assigned_at', 'revoked_at'])
            ->withTimestamps();
    }

    public function userBadges()
    {
        return $this->hasMany(UserBadge::class);
    }
}
