<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Transaction model for payment tracking.
 *
 * @property int $id
 * @property int|null $mission_id
 * @property int|null $provider_id
 * @property int|null $offer_id
 * @property string|null $stripe_session_id
 * @property string|null $stripe_payment_intent_id
 * @property string|null $stripe_transfer_id
 * @property string $amount_paid
 * @property string $client_fee
 * @property string|null $provider_fee
 * @property string|null $country
 * @property string $currency
 * @property string|null $user_role
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Mission|null $mission
 * @property-read \App\Models\ServiceProvider|null $provider
 * @property-read \App\Models\MissionOffer|null $offer
 * @property-read string $formatted_amount
 * @property-read string $formatted_client_fee
 * @property-read string $formatted_provider_fee
 */
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_paid' => 'decimal:2',
        'client_fee' => 'decimal:2',
        'provider_fee' => 'decimal:2',
    ];

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(MissionOffer::class, 'offer_id');
    }

    /**
     * Get the formatted amount with currency symbol.
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
     */
    public function getFormattedClientFeeAttribute(): string
    {
        return CurrencyService::format(
            $this->getRawOriginal('client_fee'),
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Get the formatted provider fee with currency symbol.
     */
    public function getFormattedProviderFeeAttribute(): string
    {
        return CurrencyService::format(
            $this->getRawOriginal('provider_fee'),
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Scope a query to filter transactions by currency.
     */
    public function scopeByCurrency(Builder $query, string $currency): Builder
    {
        return $query->where('currency', strtoupper($currency));
    }
}
