<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referee_id',
        'mission_id',
        'amount',
        'status',
        'payout_method',
        'stripe_transfer_id',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
