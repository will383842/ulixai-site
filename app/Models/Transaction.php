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
 * @property string $payment_gateway
 * @property string|null $paypal_order_id
 * @property string|null $paypal_capture_id
 * @property string|null $paypal_payout_batch_id
 * @property string|null $paypal_payout_item_id
 * @property string $amount_paid
 * @property string $client_fee
 * @property string|null $provider_fee
 * @property string|null $country
 * @property string $currency
 * @property string|null $user_role
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $authorized_at
 * @property \Illuminate\Support\Carbon|null $captured_at
 * @property \Illuminate\Support\Carbon|null $release_scheduled_at
 * @property \Illuminate\Support\Carbon|null $released_at
 * @property string|null $release_blocked_reason
 * @property string|null $dispute_id
 * @property string|null $dispute_reason
 * @property string|null $dispute_status
 * @property \Illuminate\Support\Carbon|null $disputed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Mission|null $mission
 * @property-read \App\Models\ServiceProvider|null $provider
 * @property-read \App\Models\MissionOffer|null $offer
 * @property-read string $formatted_amount
 * @property-read string $formatted_client_fee
 * @property-read string $formatted_provider_fee
 * @property-read bool $is_paypal
 * @property-read bool $is_stripe
 * @property-read bool $is_releasable
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
        'payment_gateway',
        'paypal_order_id',
        'paypal_capture_id',
        'paypal_payout_batch_id',
        'paypal_payout_item_id',
        'amount_paid',
        'client_fee',
        'provider_fee',
        'country',
        'currency',
        'user_role',
        'status',
        'authorized_at',
        'captured_at',
        'release_scheduled_at',
        'released_at',
        'release_blocked_reason',
        'dispute_id',
        'dispute_reason',
        'dispute_status',
        'disputed_at',
        'refunded_at',
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
        'authorized_at' => 'datetime',
        'captured_at' => 'datetime',
        'release_scheduled_at' => 'datetime',
        'released_at' => 'datetime',
        'disputed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    /**
     * Payment gateway constants.
     */
    public const GATEWAY_STRIPE = 'stripe';
    public const GATEWAY_PAYPAL = 'paypal';

    /**
     * Check if this transaction uses PayPal.
     */
    public function getIsPaypalAttribute(): bool
    {
        return $this->payment_gateway === self::GATEWAY_PAYPAL;
    }

    /**
     * Check if this transaction uses Stripe.
     */
    public function getIsStripeAttribute(): bool
    {
        return $this->payment_gateway === self::GATEWAY_STRIPE;
    }

    /**
     * Check if this transaction is ready for release.
     */
    public function getIsReleasableAttribute(): bool
    {
        // Must be paid and past scheduled release date
        if ($this->status !== 'paid') {
            return false;
        }

        if ($this->release_blocked_reason) {
            return false;
        }

        if (!$this->release_scheduled_at) {
            return false;
        }

        return now()->gte($this->release_scheduled_at);
    }

    /**
     * Get the unique payment identifier regardless of gateway.
     */
    public function getPaymentIdentifierAttribute(): ?string
    {
        return $this->is_paypal
            ? $this->paypal_order_id
            : $this->stripe_payment_intent_id;
    }

    /**
     * Get the transfer identifier regardless of gateway.
     */
    public function getTransferIdentifierAttribute(): ?string
    {
        return $this->is_paypal
            ? $this->paypal_payout_batch_id
            : $this->stripe_transfer_id;
    }

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

    /**
     * Scope a query to filter transactions by gateway.
     */
    public function scopeByGateway(Builder $query, string $gateway): Builder
    {
        return $query->where('payment_gateway', $gateway);
    }

    /**
     * Scope a query to get Stripe transactions.
     */
    public function scopeStripe(Builder $query): Builder
    {
        return $query->where('payment_gateway', self::GATEWAY_STRIPE);
    }

    /**
     * Scope a query to get PayPal transactions.
     */
    public function scopePaypal(Builder $query): Builder
    {
        return $query->where('payment_gateway', self::GATEWAY_PAYPAL);
    }

    /**
     * Scope a query to get transactions ready for release.
     */
    public function scopeReleasable(Builder $query): Builder
    {
        return $query->where('status', 'paid')
            ->whereNull('release_blocked_reason')
            ->whereNotNull('release_scheduled_at')
            ->where('release_scheduled_at', '<=', now());
    }

    /**
     * Scope a query to get pending escrow transactions.
     */
    public function scopePendingEscrow(Builder $query): Builder
    {
        return $query->where('status', 'paid')
            ->whereNull('released_at')
            ->whereNotNull('captured_at');
    }
}
