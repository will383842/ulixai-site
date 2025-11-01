<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_name',
        'full_name',
        'phone',
        'website',
        'email',
        'languages_spoken',
        'how_heard',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}