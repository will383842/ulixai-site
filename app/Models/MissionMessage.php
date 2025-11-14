<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionMessage extends Model
{
    protected $fillable = [
        'mission_id', 
        'user_id', 
        'message',
        'is_read'  // ✅ AJOUTÉ
    ];

    protected $casts = [
        'is_read' => 'boolean'  // ✅ AJOUTÉ
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function mission()
    {
        return $this->belongsTo(\App\Models\Mission::class, 'mission_id');
    }
}