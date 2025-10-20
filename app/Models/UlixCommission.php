<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlixCommission extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'requester_fee',
        'provider_fee',
        'org_fee',
        'affiliate_fee',
        'description',
        'is_active'
    ];
}
