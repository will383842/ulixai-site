<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country',
        'short_name',
        'coordinates',
        'status',
    ];

    protected $casts = [
        'coordinates' => 'array',
        'status'      => 'boolean',
    ];
}
