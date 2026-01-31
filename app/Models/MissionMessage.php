<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Global_Moderations\Traits\HasModerationFlags;

class MissionMessage extends Model
{
    use HasModerationFlags;

    protected $fillable = [
        'mission_id',
        'user_id',
        'message',
        'is_read',
        // Moderation fields
        'moderation_status',
        'moderation_score',
        'moderation_notes',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'moderation_notes' => 'array',
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