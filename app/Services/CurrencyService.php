<?php

namespace App\Services;

use App\Exceptions\CurrencyException;
use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service for currency management including conversion, formatting, and exchange rates
 */
class CurrencyService
{
    /**
     * Cache key prefix for exchange rates
     */
    protected const CACHE_PREFIX = 'currency_exchange_rate_';

    /**
     * Cache duration in seconds (1 hour)
     */
    protected const CACHE_DURATION = 3600;

    /**
     * Exchange Rate API base URL
     */
    protected const API_BASE_URL = 'https://v6.exchangerate-api.com/v6';

    /**
     * Supported currencies
     */
    protected array $supportedCurrencies = ['EUR', 'USD'];

    /**
     * Currency symbols mapping
     */
    protected static array $symbols = [
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
        'XOF' => 'CFA',
        'XAF' => 'FCFA',
        'MAD' => 'DH',
        'TND' => 'DT',
        'DZD' => 'DA',
    ];

    /**
     * Currencies where symbol comes before amount
     */
    protected array $symbolBeforeCurrencies = ['USD', 'GBP', 'CAD', 'AUD', 'JPY', 'CNY', 'INR', 'BRL', 'MXN'];

    /**
     * Currencies that don't use decimals
     */
    protected static array $zeroDecimalCurrencies = [
        'JPY', 'KRW', 'VND', 'XOF', 'XAF', 'CLP', 'PYG', 'UGX', 'RWF',
    ];

    /**
     * Get the list of supported currencies
     *
     * @return array
     */
    public function getSupportedCurrencies(): array
    {
        return config('currencies.supported', ['EUR', 'USD']);
    }

    /**
     * Get the default currency
     *
     * @return string
     */
    public function getDefaultCurrency(): string
    {
        return config('currencies.default', 'EUR');
    }

    /**
     * Get the symbol for a currency code
     *
     * @param string $currencyCode
     * @return string
     * @throws CurrencyException
     */
    public function getSymbol(string $currencyCode): string
    {
        $code = strtoupper(trim($currencyCode));

        if (!$this->isValidCurrencyFormat($code)) {
            throw CurrencyException::invalidCurrencyCode($currencyCode);
        }

        // Try to get from database first
        $currency = Currency::where('code', $code)->first();

        if ($currency && $currency->symbol) {
            return $currency->symbol;
        }

        // Fallback to config symbols
        $configSymbols = config('currencies.symbols', []);
        if (isset($configSymbols[$code])) {
            return $configSymbols[$code];
        }

        // Fallback to local mapping
        if (isset(static::$symbols[$code])) {
            return static::$symbols[$code];
        }

        // Return the code itself as fallback
        return $code;
    }

    /**
     * Format an amount with the currency symbol
     *
     * @param float|int $amount
     * @param string $currencyCode
     * @param int|null $decimals
     * @return string
     * @throws CurrencyException
     */
    public function format(float|int $amount, string $currencyCode, ?int $decimals = null): string
    {
        $code = strtoupper(trim($currencyCode));

        if (!$this->isValidCurrencyFormat($code)) {
            throw CurrencyException::invalidCurrencyCode($currencyCode);
        }

        $symbol = $this->getSymbol($code);

        // Determine decimals based on currency if not specified
        if ($decimals === null) {
            $decimals = in_array($code, static::$zeroDecimalCurrencies) ? 0 : 2;
        }

        // Determine decimal and thousand separators
        $decimalSeparator = '.';
        $thousandSeparator = ',';

        // European style for EUR
        if ($code === 'EUR') {
            $decimalSeparator = ',';
            $thousandSeparator = ' ';
        }

        // Format the number
        $formattedAmount = number_format($amount, $decimals, $decimalSeparator, $thousandSeparator);

        // Determine symbol position
        if (in_array($code, $this->symbolBeforeCurrencies)) {
            return $symbol . $formattedAmount;
        }

        // Symbol after amount (European style)
        return $formattedAmount . ' ' . $symbol;
    }

    /**
     * Convert an amount from one currency to another
     *
     * @param float|int $amount
     * @param string $fromCurrency
     * @param string $toCurrency
     * @param int $decimals
     * @return float
     * @throws CurrencyException
     */
    public function convert(float|int $amount, string $fromCurrency, string $toCurrency, int $decimals = 2): float
    {
        $from = strtoupper(trim($fromCurrency));
        $to = strtoupper(trim($toCurrency));

        // Validate currency codes
        if (!$this->isValidCurrencyFormat($from)) {
            throw CurrencyException::invalidCurrencyCode($fromCurrency);
        }

        if (!$this->isValidCurrencyFormat($to)) {
            throw CurrencyException::invalidCurrencyCode($toCurrency);
        }

        // Same currency, no conversion needed
        if ($from === $to) {
            return round($amount, $decimals);
        }

        // Get exchange rate
        $rate = $this->getExchangeRate($from, $to);

        return round($amount * $rate, $decimals);
    }

    /**
     * Get the exchange rate between two currencies
     *
     * @param string $from
     * @param string $to
     * @return float
     * @throws CurrencyException
     */
    public function getExchangeRate(string $from, string $to): float
    {
        $from = strtoupper(trim($from));
        $to = strtoupper(trim($to));

        // Validate currency codes
        if (!$this->isValidCurrencyFormat($from)) {
            throw CurrencyException::invalidCurrencyCode($from);
        }

        if (!$this->isValidCurrencyFormat($to)) {
            throw CurrencyException::invalidCurrencyCode($to);
        }

        // Same currency
        if ($from === $to) {
            return 1.0;
        }

        // Try to get from cache first
        $cacheKey = self::CACHE_PREFIX . "{$from}_{$to}";
        $cachedRate = Cache::get($cacheKey);

        if ($cachedRate !== null) {
            return (float) $cachedRate;
        }

        // Try to get from database
        $rate = $this->getRateFromDatabase($from, $to);

        if ($rate !== null) {
            // Cache the rate
            Cache::put($cacheKey, $rate, self::CACHE_DURATION);
            return $rate;
        }

        // Try to fetch from API
        try {
            $rate = $this->fetchRateFromApi($from, $to);

            if ($rate !== null) {
                // Store in database and cache
                $this->storeExchangeRate($from, $to, $rate);
                Cache::put($cacheKey, $rate, self::CACHE_DURATION);
                return $rate;
            }
        } catch (\Exception $e) {
            Log::warning('Failed to fetch exchange rate from API', [
                'from' => $from,
                'to' => $to,
                'error' => $e->getMessage(),
            ]);
        }

        // If we still don't have a rate, throw an exception
        throw CurrencyException::exchangeRateNotFound($from, $to);
    }

    /**
     * Update exchange rates from external API (exchangerate-api.com)
     *
     * @param string|null $baseCurrency Base currency to update rates from (defaults to EUR)
     * @return array Updated rates
     * @throws CurrencyException
     */
    public function updateExchangeRates(?string $baseCurrency = null): array
    {
        $base = $baseCurrency ? strtoupper(trim($baseCurrency)) : 'EUR';

        if (!$this->isValidCurrencyFormat($base)) {
            throw CurrencyException::invalidCurrencyCode($base);
        }

        $apiKey = config('services.exchangerate_api.key');

        if (empty($apiKey)) {
            throw CurrencyException::apiError('Exchange rate API key is not configured. Please set EXCHANGERATE_API_KEY in your .env file.');
        }

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->get(self::API_BASE_URL . "/{$apiKey}/latest/{$base}");

            if (!$response->successful()) {
                throw CurrencyException::apiError(
                    "API returned status code: {$response->status()}"
                );
            }

            $data = $response->json();

            if (!isset($data['result']) || $data['result'] !== 'success') {
                $errorType = $data['error-type'] ?? 'unknown';
                throw CurrencyException::apiError("API error: {$errorType}");
            }

            if (!isset($data['conversion_rates'])) {
                throw CurrencyException::apiError('Invalid API response format.');
            }

            $rates = $data['conversion_rates'];
            $updatedRates = [];

            // Update rates for all supported currencies
            foreach ($this->supportedCurrencies as $targetCurrency) {
                if ($targetCurrency === $base) {
                    continue;
                }

                if (isset($rates[$targetCurrency])) {
                    $rate = (float) $rates[$targetCurrency];
                    $this->storeExchangeRate($base, $targetCurrency, $rate);

                    // Also store the reverse rate
                    if ($rate > 0) {
                        $reverseRate = 1 / $rate;
                        $this->storeExchangeRate($targetCurrency, $base, $reverseRate);
                    }

                    // Clear cache for both directions
                    Cache::forget(self::CACHE_PREFIX . "{$base}_{$targetCurrency}");
                    Cache::forget(self::CACHE_PREFIX . "{$targetCurrency}_{$base}");

                    $updatedRates[$targetCurrency] = $rate;

                    Log::info('Exchange rate updated', [
                        'from' => $base,
                        'to' => $targetCurrency,
                        'rate' => $rate,
                    ]);
                }
            }

            return $updatedRates;

        } catch (CurrencyException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to update exchange rates', [
                'base' => $base,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw CurrencyException::apiError($e->getMessage(), $e);
        }
    }

    /**
     * Get the minimum withdrawal amount for a currency
     *
     * @param string $currency
     * @return int|float
     */
    public function getMinimumWithdrawal(string $currency): int|float
    {
        return config('currencies.minimum_withdrawal.' . strtoupper($currency), 30);
    }

    /**
     * Get the minimum service fee for a currency
     *
     * If the calculated provider commission is less than this minimum,
     * this minimum fee will be charged instead.
     *
     * @param string $currency
     * @return int|float
     */
    public function getMinimumServiceFee(string $currency): int|float
    {
        return config('currencies.minimum_service_fee.' . strtoupper($currency), 10);
    }

    /**
     * Get the minimum service fee (static version for backward compatibility)
     *
     * @param string $currency
     * @return int|float
     */
    public static function getMinimumServiceFeeStatic(string $currency): int|float
    {
        return config('currencies.minimum_service_fee.' . strtoupper($currency), 10);
    }

    /**
     * Calculate the provider fee with minimum applied
     *
     * @param float $amount The transaction amount
     * @param float $feeRate The fee rate (e.g., 0.15 for 15%)
     * @param string $currency The currency code
     * @return float The fee amount (max of calculated fee and minimum)
     */
    public function calculateProviderFeeWithMinimum(float $amount, float $feeRate, string $currency): float
    {
        $calculatedFee = round($amount * $feeRate, 2);
        $minimumFee = $this->getMinimumServiceFee($currency);

        return max($calculatedFee, $minimumFee);
    }

    /**
     * Check if a currency code is supported
     *
     * @param string $code
     * @return bool
     */
    public function isValidCurrency(string $code): bool
    {
        $code = strtoupper(trim($code));

        return in_array($code, $this->supportedCurrencies);
    }

    /**
     * Validate currency code format (3 uppercase letters)
     *
     * @param string $code
     * @return bool
     */
    protected function isValidCurrencyFormat(string $code): bool
    {
        return (bool) preg_match('/^[A-Z]{3}$/', $code);
    }

    /**
     * Get exchange rate from database
     *
     * @param string $from
     * @param string $to
     * @return float|null
     */
    protected function getRateFromDatabase(string $from, string $to): ?float
    {
        // Try direct rate with from_currency/to_currency columns
        $rate = ExchangeRate::where('from_currency', $from)
            ->where('to_currency', $to)
            ->orderBy('valid_from', 'desc')
            ->first();

        if ($rate) {
            return (float) $rate->rate;
        }

        // Try with base_currency/target_currency columns (alternative schema)
        $rate = ExchangeRate::where('base_currency', $from)
            ->where('target_currency', $to)
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($rate) {
            return (float) $rate->rate;
        }

        // Try reverse rate
        $reverseRate = ExchangeRate::where('from_currency', $to)
            ->where('to_currency', $from)
            ->orderBy('valid_from', 'desc')
            ->first();

        if (!$reverseRate) {
            $reverseRate = ExchangeRate::where('base_currency', $to)
                ->where('target_currency', $from)
                ->orderBy('updated_at', 'desc')
                ->first();
        }

        if ($reverseRate && (float) $reverseRate->rate > 0) {
            return 1 / (float) $reverseRate->rate;
        }

        // Try through EUR as intermediary
        if ($from !== 'EUR' && $to !== 'EUR') {
            $fromToEur = $this->getRateFromDatabase($from, 'EUR');
            $eurToTarget = $this->getRateFromDatabase('EUR', $to);

            if ($fromToEur !== null && $eurToTarget !== null) {
                return $fromToEur * $eurToTarget;
            }
        }

        return null;
    }

    /**
     * Fetch exchange rate from external API
     *
     * @param string $from
     * @param string $to
     * @return float|null
     */
    protected function fetchRateFromApi(string $from, string $to): ?float
    {
        $apiKey = config('services.exchangerate_api.key');

        if (empty($apiKey)) {
            return null;
        }

        try {
            $response = Http::timeout(15)
                ->get(self::API_BASE_URL . "/{$apiKey}/pair/{$from}/{$to}");

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();

            if (isset($data['result']) && $data['result'] === 'success' && isset($data['conversion_rate'])) {
                return (float) $data['conversion_rate'];
            }

            return null;

        } catch (\Exception $e) {
            Log::warning('Exchange rate API request failed', [
                'from' => $from,
                'to' => $to,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Store exchange rate in database
     *
     * @param string $from
     * @param string $to
     * @param float $rate
     * @return void
     */
    protected function storeExchangeRate(string $from, string $to, float $rate): void
    {
        try {
            ExchangeRate::updateOrCreate(
                [
                    'from_currency' => $from,
                    'to_currency' => $to,
                ],
                [
                    'rate' => $rate,
                    'source' => 'exchangerate-api',
                    'valid_from' => now(),
                    'valid_until' => now()->addDay(),
                ]
            );
        } catch (\Exception $e) {
            // Try alternative schema (base_currency/target_currency)
            try {
                ExchangeRate::updateOrCreate(
                    [
                        'base_currency' => $from,
                        'target_currency' => $to,
                    ],
                    [
                        'rate' => $rate,
                    ]
                );
            } catch (\Exception $innerException) {
                Log::error('Failed to store exchange rate', [
                    'from' => $from,
                    'to' => $to,
                    'rate' => $rate,
                    'error' => $innerException->getMessage(),
                ]);
            }
        }
    }

    /**
     * Clear cached exchange rates
     *
     * @return void
     */
    public function clearCache(): void
    {
        foreach ($this->supportedCurrencies as $from) {
            foreach ($this->supportedCurrencies as $to) {
                if ($from !== $to) {
                    Cache::forget(self::CACHE_PREFIX . "{$from}_{$to}");
                }
            }
        }
    }

    /**
     * Get all exchange rates as an array
     *
     * @return array
     */
    public function getAllRates(): array
    {
        $rates = [];

        foreach ($this->supportedCurrencies as $from) {
            foreach ($this->supportedCurrencies as $to) {
                if ($from !== $to) {
                    try {
                        $rate = $this->getExchangeRate($from, $to);
                        $rates["{$from}_to_{$to}"] = $rate;
                    } catch (CurrencyException $e) {
                        $rates["{$from}_to_{$to}"] = null;
                    }
                }
            }
        }

        return $rates;
    }

    /**
     * Convert and format an amount in a single call
     *
     * @param float|int $amount
     * @param string $fromCurrency
     * @param string $toCurrency
     * @param int $decimals
     * @return string
     * @throws CurrencyException
     */
    public function convertAndFormat(float|int $amount, string $fromCurrency, string $toCurrency, int $decimals = 2): string
    {
        $convertedAmount = $this->convert($amount, $fromCurrency, $toCurrency, $decimals);

        return $this->format($convertedAmount, $toCurrency, $decimals);
    }

    // =========================================================================
    // Static methods (kept for backward compatibility with existing code)
    // =========================================================================

    /**
     * Get the number of decimal places for a currency
     *
     * @param string $currency
     * @return int
     */
    public static function getDecimals(string $currency): int
    {
        return in_array(strtoupper($currency), static::$zeroDecimalCurrencies) ? 0 : 2;
    }

    /**
     * Convert amount to cents (for Stripe)
     *
     * @param float $amount
     * @param string $currency
     * @return int
     */
    public static function toCents(float $amount, string $currency = 'EUR'): int
    {
        if (in_array(strtoupper($currency), static::$zeroDecimalCurrencies)) {
            return (int) round($amount);
        }
        return (int) round($amount * 100);
    }

    /**
     * Convert cents to amount (from Stripe)
     *
     * @param int $cents
     * @param string $currency
     * @return float
     */
    public static function fromCents(int $cents, string $currency = 'EUR'): float
    {
        if (in_array(strtoupper($currency), static::$zeroDecimalCurrencies)) {
            return (float) $cents;
        }
        return $cents / 100;
    }

    /**
     * Static method to get symbol (for backward compatibility)
     *
     * @param string $currency
     * @return string
     */
    public static function getSymbolStatic(string $currency): string
    {
        $currency = strtoupper($currency);
        return static::$symbols[$currency] ?? $currency;
    }

    /**
     * Static format method (for backward compatibility)
     *
     * @param float|int|string|null $amount
     * @param string $currency
     * @param bool $symbolAfter
     * @return string
     */
    public static function formatStatic($amount, string $currency = 'EUR', bool $symbolAfter = false): string
    {
        if ($amount === null) {
            return static::getSymbolStatic($currency) . '0.00';
        }

        $amount = (float) $amount;
        $currency = strtoupper($currency);
        $symbol = static::getSymbolStatic($currency);
        $decimals = in_array($currency, static::$zeroDecimalCurrencies) ? 0 : 2;

        // Format the number
        $formattedNumber = number_format($amount, $decimals, ',', ' ');

        // Return with symbol position based on locale preference
        if ($symbolAfter) {
            return $formattedNumber . ' ' . $symbol;
        }

        return $symbol . $formattedNumber;
    }
}
