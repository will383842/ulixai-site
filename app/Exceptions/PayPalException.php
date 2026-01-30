<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Exception personnalisée pour les erreurs PayPal.
 */
class PayPalException extends Exception
{
    protected ?string $paypalErrorCode = null;
    protected ?string $orderId = null;
    protected ?string $batchId = null;

    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        ?string $paypalErrorCode = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->paypalErrorCode = $paypalErrorCode;
    }

    /**
     * Erreur d'authentification OAuth.
     */
    public static function authenticationFailed(string $reason = ''): static
    {
        return new static(
            "PayPal authentication failed: {$reason}",
            401,
            null,
            'AUTHENTICATION_FAILURE'
        );
    }

    /**
     * Échec de création de commande.
     */
    public static function orderCreationFailed(string $reason = ''): static
    {
        return new static(
            "PayPal order creation failed: {$reason}",
            400,
            null,
            'ORDER_CREATION_FAILED'
        );
    }

    /**
     * Capture de paiement rejetée.
     */
    public static function captureRejected(string $orderId, string $reason = ''): static
    {
        $exception = new static(
            "PayPal capture rejected for order {$orderId}: {$reason}",
            400,
            null,
            'CAPTURE_REJECTED'
        );
        $exception->orderId = $orderId;
        return $exception;
    }

    /**
     * Échec de payout.
     */
    public static function payoutFailed(string $batchId, string $reason = ''): static
    {
        $exception = new static(
            "PayPal payout failed for batch {$batchId}: {$reason}",
            400,
            null,
            'PAYOUT_FAILED'
        );
        $exception->batchId = $batchId;
        return $exception;
    }

    /**
     * Vérification de webhook échouée.
     */
    public static function webhookVerificationFailed(): static
    {
        return new static(
            'PayPal webhook signature verification failed',
            401,
            null,
            'WEBHOOK_VERIFICATION_FAILED'
        );
    }

    /**
     * Erreur API générique.
     */
    public static function apiError(string $message, ?Throwable $previous = null): static
    {
        return new static(
            "PayPal API error: {$message}",
            503,
            $previous,
            'API_ERROR'
        );
    }

    /**
     * Commande non trouvée.
     */
    public static function orderNotFound(string $orderId): static
    {
        $exception = new static(
            "PayPal order not found: {$orderId}",
            404,
            null,
            'ORDER_NOT_FOUND'
        );
        $exception->orderId = $orderId;
        return $exception;
    }

    /**
     * Devise non supportée.
     */
    public static function unsupportedCurrency(string $currency): static
    {
        return new static(
            "Currency not supported by PayPal: {$currency}",
            400,
            null,
            'UNSUPPORTED_CURRENCY'
        );
    }

    /**
     * Configuration manquante.
     */
    public static function configurationMissing(string $key): static
    {
        return new static(
            "PayPal configuration missing: {$key}",
            500,
            null,
            'CONFIGURATION_MISSING'
        );
    }

    // =========================================================================
    // GETTERS
    // =========================================================================

    public function getPayPalErrorCode(): ?string
    {
        return $this->paypalErrorCode;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function getBatchId(): ?string
    {
        return $this->batchId;
    }

    /**
     * Retourne les données contextuelles pour le logging.
     */
    public function getContext(): array
    {
        return array_filter([
            'paypal_error_code' => $this->paypalErrorCode,
            'order_id' => $this->orderId,
            'batch_id' => $this->batchId,
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ]);
    }
}
