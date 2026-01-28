<?php

namespace App\Models;

use App\Services\CurrencyService;
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
        'currency',
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

    /**
     * Get the formatted amount with currency symbol.
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return CurrencyService::format(
            $this->getRawOriginal('amount_paid'),
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Get the formatted client fee with currency symbol.
     *
     * @return string
     */
    public function getFormattedClientFeeAttribute(): string
    {
        return CurrencyService::format(
            $this->client_fee,
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Get the formatted provider fee with currency symbol.
     *
     * @return string
     */
    public function getFormattedProviderFeeAttribute(): string
    {
        return CurrencyService::format(
            $this->provider_fee,
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Scope a query to filter transactions by currency.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $currency
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCurrency($query, string $currency)
    {
        return $query->where('currency', strtoupper($currency));
    }

}
