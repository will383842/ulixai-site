<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionMessage extends Model
{
    protected $fillable = [
        'mission_id', 'user_id', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
