<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'code', 'name', 'native_name', 'direction',
        'date_format', 'time_format', 'datetime_format',
        'decimal_separator', 'thousands_separator',
        'currency_code', 'is_active', 'is_default',
        'fallback_locale', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'sort_order' => 'integer',
    ];
}
