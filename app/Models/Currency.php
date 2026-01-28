<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'symbol',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Default symbols for common currencies
     */
    protected static array $defaultSymbols = [
        'EUR' => '€',
        'USD' => '$',
        'GBP' => '£',
        'CHF' => 'CHF',
        'CAD' => 'CA$',
        'AUD' => 'A$',
        'JPY' => '¥',
        'CNY' => '¥',
        'INR' => '₹',
        'BRL' => 'R$',
        'MXN' => 'MX$',
        'RUB' => '₽',
        'KRW' => '₩',
        'TRY' => '₺',
        'PLN' => 'zł',
        'SEK' => 'kr',
        'NOK' => 'kr',
        'DKK' => 'kr',
        'CZK' => 'Kč',
        'HUF' => 'Ft',
        'RON' => 'lei',
        'BGN' => 'лв',
        'HRK' => 'kn',
        'MAD' => 'DH',
        'TND' => 'DT',
        'XOF' => 'CFA',
        'XAF' => 'FCFA',
    ];

    /**
     * Get exchange rates where this currency is the base
     */
    public function exchangeRatesAsBase(): HasMany
    {
        return $this->hasMany(ExchangeRate::class, 'base_currency', 'code');
    }

    /**
     * Get exchange rates where this currency is the target
     */
    public function exchangeRatesAsTarget(): HasMany
    {
        return $this->hasMany(ExchangeRate::class, 'target_currency', 'code');
    }

    /**
     * Scope to get active currencies only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get inactive currencies only
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope to find by currency code
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where('code', strtoupper($code));
    }

    /**
     * Get the symbol for a currency code
     *
     * @param string $code Currency code (e.g., 'EUR', 'USD')
     * @return string Currency symbol
     */
    public static function getSymbol(string $code): string
    {
        $code = strtoupper($code);

        // Try to get from database first
        $currency = static::where('code', $code)->first();

        if ($currency && $currency->symbol) {
            return $currency->symbol;
        }

        // Fallback to default symbols
        return static::$defaultSymbols[$code] ?? $code;
    }

    /**
     * Format an amount with the currency symbol
     *
     * @param float|int $amount The amount to format
     * @param string $code Currency code (e.g., 'EUR', 'USD')
     * @param int $decimals Number of decimal places
     * @param bool $symbolBefore Whether to place symbol before the amount
     * @return string Formatted amount with currency symbol
     */
    public static function format(float|int $amount, string $code, int $decimals = 2, ?bool $symbolBefore = null): string
    {
        $code = strtoupper($code);
        $symbol = static::getSymbol($code);

        // Determine decimal and thousand separators based on currency
        $decimalSeparator = ',';
        $thousandSeparator = ' ';

        // US/UK style currencies
        $usStyleCurrencies = ['USD', 'GBP', 'CAD', 'AUD', 'MXN', 'INR', 'JPY', 'CNY', 'KRW'];
        if (in_array($code, $usStyleCurrencies)) {
            $decimalSeparator = '.';
            $thousandSeparator = ',';
        }

        // Format the number
        $formattedAmount = number_format($amount, $decimals, $decimalSeparator, $thousandSeparator);

        // Determine symbol position if not specified
        if ($symbolBefore === null) {
            // Currencies that typically have symbol before the amount
            $symbolBeforeCurrencies = ['USD', 'GBP', 'CAD', 'AUD', 'MXN', 'JPY', 'CNY', 'INR', 'KRW', 'BRL'];
            $symbolBefore = in_array($code, $symbolBeforeCurrencies);
        }

        if ($symbolBefore) {
            return $symbol . $formattedAmount;
        }

        return $formattedAmount . ' ' . $symbol;
    }

    /**
     * Get a currency by its code
     *
     * @param string $code Currency code
     * @return Currency|null
     */
    public static function findByCode(string $code): ?self
    {
        return static::where('code', strtoupper($code))->first();
    }

    /**
     * Get all active currencies as a key-value array (code => name)
     *
     * @return array
     */
    public static function getActiveList(): array
    {
        return static::active()
            ->orderBy('code')
            ->pluck('name', 'code')
            ->toArray();
    }

    /**
     * Get all active currencies as options for select dropdowns
     *
     * @return array
     */
    public static function getSelectOptions(): array
    {
        return static::active()
            ->orderBy('name')
            ->get()
            ->map(function ($currency) {
                return [
                    'value' => $currency->code,
                    'label' => "{$currency->name} ({$currency->symbol})",
                ];
            })
            ->toArray();
    }

    /**
     * Check if a currency code exists and is active
     *
     * @param string $code Currency code
     * @return bool
     */
    public static function isValidCode(string $code): bool
    {
        return static::where('code', strtoupper($code))
            ->where('is_active', true)
            ->exists();
    }

    /**
     * Get the default currency (EUR)
     *
     * @return Currency|null
     */
    public static function getDefault(): ?self
    {
        return static::findByCode('EUR');
    }
}
