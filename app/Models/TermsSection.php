<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsSection extends Model
{
    protected $fillable = [
        'number', 'title', 'slug', 'body', 'is_active', 'version', 'effective_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'effective_date' => 'date',
    ];
}
