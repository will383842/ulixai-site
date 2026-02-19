<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCommission extends Model
{
    protected $fillable = [
        'country_code', 'country_name', 'region',
        'platform_rate', 'min_commission', 'max_commission',
        'service_rates', 'vat_rate', 'vat_included',
        'payment_processing_fee', 'is_active', 'effective_from',
    ];

    protected $casts = [
        'platform_rate' => 'decimal:2',
        'min_commission' => 'decimal:2',
        'max_commission' => 'decimal:2',
        'service_rates' => 'array',
        'vat_rate' => 'decimal:2',
        'vat_included' => 'boolean',
        'payment_processing_fee' => 'decimal:2',
        'is_active' => 'boolean',
        'effective_from' => 'date',
    ];
}
