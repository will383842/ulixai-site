<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_badge_id', 'admin_id', 'action', 'changes', 'created_at'
    ];

    protected $casts = [
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    public function userBadge()
    {
        return $this->belongsTo(UserBadge::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
