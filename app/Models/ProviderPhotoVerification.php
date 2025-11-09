<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderPhotoVerification extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',  // ✅ AJOUTÉ
        'image_path',
        'status',
        'confidence_score',
        'rejection_reason',
        'google_vision_response',
        'verified_at',
    ];

    protected $casts = [
        'google_vision_response' => 'array',
        'verified_at' => 'datetime',
        'confidence_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}