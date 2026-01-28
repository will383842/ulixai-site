<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'mission_id',
        'provider_id',
        'offer_id',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'stripe_transfer_id',
        'amount_paid',
        'client_fee',
        'provider_fee',
        'country',
        'user_role',
        'status',
    ];


    function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
    function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    function offer()
    {
        return $this->belongsTo(MissionOffer::class, 'offer_id');
    }

    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 2, '.', '');
    }

}
