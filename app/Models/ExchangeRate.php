<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_currency',
        'to_currency',
        'rate',
        'source',
        'valid_from',
        'valid_until',
    ];

    protected $casts = [
        'rate' => 'decimal:6',
    ];

    /**
     * Get the base currency model
     */
    public function baseCurrencyModel(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'from_currency', 'code');
    }

    /**
     * Get the target currency model
     */
    public function targetCurrencyModel(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'to_currency', 'code');
    }

    /**
     * Scope to find rates by base currency
     */
    public function scopeFromCurrency($query, string $code)
    {
        return $query->where('from_currency', strtoupper($code));
    }

    /**
     * Scope to find rates by target currency
     */
    public function scopeToCurrency($query, string $code)
    {
        return $query->where('to_currency', strtoupper($code));
    }

    /**
     * Scope to find a specific exchange rate pair
     */
    public function scopePair($query, string $from, string $to)
    {
        return $query->where('from_currency', strtoupper($from))
                     ->where('to_currency', strtoupper($to));
    }

    /**
     * Scope to get the latest rates (most recent)
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * Convert an amount from one currency to another
     *
     * @param float|int $amount The amount to convert
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @param int $decimals Number of decimal places for the result
     * @return float|null Converted amount or null if rate not found
     */
    public static function convert(float|int $amount, string $from, string $to, int $decimals = 2): ?float
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        // Same currency, no conversion needed
        if ($from === $to) {
            return round($amount, $decimals);
        }

        // Try direct conversion
        $rate = static::getRate($from, $to);

        if ($rate !== null) {
            return round($amount * $rate, $decimals);
        }

        // Try reverse conversion
        $reverseRate = static::getRate($to, $from);

        if ($reverseRate !== null && $reverseRate != 0) {
            return round($amount / $reverseRate, $decimals);
        }

        // Try conversion through EUR as intermediary
        $toEur = static::getRate($from, 'EUR') ?? (static::getRate('EUR', $from) ? 1 / static::getRate('EUR', $from) : null);
        $fromEur = static::getRate('EUR', $to) ?? (static::getRate($to, 'EUR') ? 1 / static::getRate($to, 'EUR') : null);

        if ($toEur !== null && $fromEur !== null) {
            return round($amount * $toEur * $fromEur, $decimals);
        }

        return null;
    }

    /**
     * Get the exchange rate between two currencies
     *
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @return float|null Exchange rate or null if not found
     */
    public static function getRate(string $from, string $to): ?float
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        if ($from === $to) {
            return 1.0;
        }

        $rate = static::pair($from, $to)->first();

        return $rate ? (float) $rate->rate : null;
    }

    /**
     * Get or calculate exchange rate (tries reverse if direct not found)
     *
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @return float|null Exchange rate or null if not available
     */
    public static function getRateOrReverse(string $from, string $to): ?float
    {
        $rate = static::getRate($from, $to);

        if ($rate !== null) {
            return $rate;
        }

        $reverseRate = static::getRate($to, $from);

        if ($reverseRate !== null && $reverseRate != 0) {
            return 1 / $reverseRate;
        }

        return null;
    }

    /**
     * Update or create an exchange rate
     *
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @param float $rate The exchange rate
     * @return ExchangeRate
     */
    public static function setRate(string $from, string $to, float $rate): self
    {
        return static::updateOrCreate(
            [
                'from_currency' => strtoupper($from),
                'to_currency' => strtoupper($to),
            ],
            ['rate' => $rate]
        );
    }

    /**
     * Get all rates from a base currency
     *
     * @param string $baseCurrency Base currency code
     * @return array Key-value array of to_currency => rate
     */
    public static function getRatesFrom(string $baseCurrency): array
    {
        return static::fromCurrency($baseCurrency)
            ->pluck('rate', 'to_currency')
            ->toArray();
    }

    /**
     * Get all rates to a target currency
     *
     * @param string $targetCurrency Target currency code
     * @return array Key-value array of from_currency => rate
     */
    public static function getRatesTo(string $targetCurrency): array
    {
        return static::toCurrency($targetCurrency)
            ->pluck('rate', 'from_currency')
            ->toArray();
    }

    /**
     * Convert and format an amount
     *
     * @param float|int $amount Amount to convert
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @param int $decimals Number of decimal places
     * @return string|null Formatted converted amount or null if conversion failed
     */
    public static function convertAndFormat(float|int $amount, string $from, string $to, int $decimals = 2): ?string
    {
        $converted = static::convert($amount, $from, $to, $decimals);

        if ($converted === null) {
            return null;
        }

        return Currency::format($converted, $to, $decimals);
    }

    /**
     * Check if a rate exists for a currency pair
     *
     * @param string $from Source currency code
     * @param string $to Target currency code
     * @param bool $checkReverse Also check for reverse rate
     * @return bool
     */
    public static function hasRate(string $from, string $to, bool $checkReverse = true): bool
    {
        if (strtoupper($from) === strtoupper($to)) {
            return true;
        }

        if (static::pair($from, $to)->exists()) {
            return true;
        }

        if ($checkReverse && static::pair($to, $from)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Get all available currency pairs
     *
     * @return array Array of ['from' => code, 'to' => code, 'rate' => value]
     */
    public static function getAllPairs(): array
    {
        return static::all()
            ->map(function ($rate) {
                return [
                    'from' => $rate->from_currency,
                    'to' => $rate->to_currency,
                    'rate' => (float) $rate->rate,
                ];
            })
            ->toArray();
    }
}
