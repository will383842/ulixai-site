<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpLocation extends Model
{
    protected $fillable = [
        'ip_start', 'ip_end', 'ip_start_numeric', 'ip_end_numeric',
        'country_code', 'region_code', 'city', 'latitude', 'longitude',
        'postal_code', 'timezone', 'isp', 'connection_type',
    ];

    protected $casts = [
        'ip_start_numeric' => 'integer',
        'ip_end_numeric' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];
}
