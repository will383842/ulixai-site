<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressAsset extends Model
{
    protected $fillable = [
        'title', 'type', 'locale', 'disk', 'path',
        'filename', 'mime', 'size', 'created_by',
    ];

    protected $casts = [
        'size' => 'integer',
    ];
}
