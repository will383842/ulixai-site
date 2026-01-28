<?php

namespace App\Exceptions;

use Exception;

/**
 * Exception for currency-related errors
 */
class CurrencyException extends Exception
{
    /**
     * The currency code that caused the exception
     */
    protected ?string $currencyCode;

    /**
     * Create a new CurrencyException instance
     *
     * @param string $message
     * @param string|null $currencyCode
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        ?string $currencyCode = null,
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $this->currencyCode = $currencyCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the currency code that caused the exception
     *
     * @return string|null
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    /**
     * Create an exception for an unsupported currency
     *
     * @param string $currencyCode
     * @return static
     */
    public static function unsupportedCurrency(string $currencyCode): static
    {
        return new static(
            "The currency '{$currencyCode}' is not supported.",
            $currencyCode,
            400
        );
    }

    /**
     * Create an exception for an invalid currency code format
     *
     * @param string $currencyCode
     * @return static
     */
    public static function invalidCurrencyCode(string $currencyCode): static
    {
        return new static(
            "The currency code '{$currencyCode}' is invalid. Currency codes must be 3 uppercase letters.",
            $currencyCode,
            400
        );
    }

    /**
     * Create an exception when exchange rate is not found
     *
     * @param string $from
     * @param string $to
     * @return static
     */
    public static function exchangeRateNotFound(string $from, string $to): static
    {
        return new static(
            "Exchange rate from '{$from}' to '{$to}' could not be found or calculated.",
            "{$from}->{$to}",
            404
        );
    }

    /**
     * Create an exception for API errors
     *
     * @param string $message
     * @param \Throwable|null $previous
     * @return static
     */
    public static function apiError(string $message, ?\Throwable $previous = null): static
    {
        return new static(
            "Exchange rate API error: {$message}",
            null,
            503,
            $previous
        );
    }

    /**
     * Create an exception for conversion errors
     *
     * @param string $from
     * @param string $to
     * @param string $reason
     * @return static
     */
    public static function conversionError(string $from, string $to, string $reason): static
    {
        return new static(
            "Cannot convert from '{$from}' to '{$to}': {$reason}",
            "{$from}->{$to}",
            422
        );
    }
}
