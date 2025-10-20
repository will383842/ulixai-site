<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['site_name', 'legal_info'];

    protected $casts = [
        'legal_info' => 'array',
    ];
}
