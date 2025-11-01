<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressInquiry extends Model
{
    use HasFactory;

    protected $table = 'press_inquiries';

    // Aligne exactement avec les colonnes de ta table
    protected $fillable = [
        'media_name',
        'full_name',
        'email',
        'phone',
        'website',
        'languages_spoken',
        'how_heard',
        'message',
        'status',          // <= colonne existante
        'internal_notes',
        'assigned_to',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];
}
