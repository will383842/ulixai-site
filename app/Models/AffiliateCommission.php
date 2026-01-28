<?php

namespace App\Models;

use App\Services\CurrencyService;
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
        'currency',
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

    /**
     * Get the formatted amount with currency symbol.
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return CurrencyService::formatStatic(
            $this->amount,
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Scope a query to filter commissions by currency.
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
