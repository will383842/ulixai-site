<?php

declare(strict_types=1);

namespace App\Services\Gateways;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * Service de sélection automatique de passerelle de paiement.
 *
 * Détermine automatiquement si Stripe ou PayPal doit être utilisé
 * en fonction du pays de l'utilisateur/mission.
 */
class PaymentGatewaySelector
{
    public const GATEWAY_STRIPE = 'stripe';
    public const GATEWAY_PAYPAL = 'paypal';

    /**
     * Sélectionne la passerelle de paiement optimale pour une mission.
     */
    public function selectForMission(Mission $mission): string
    {
        // Priorité 1: Pays de la mission
        $countryCode = $mission->location_country;

        if ($countryCode) {
            return $this->selectForCountry($countryCode);
        }

        // Priorité 2: Pays du requester
        $requester = $mission->requester;
        if ($requester && $requester->country) {
            return $this->selectForCountry($requester->country);
        }

        // Fallback: Stripe par défaut
        return $this->getDefaultGateway();
    }

    /**
     * Sélectionne la passerelle de paiement optimale pour un utilisateur.
     */
    public function selectForUser(User $user): string
    {
        $countryCode = $user->country ?? $user->location_country ?? null;

        if ($countryCode) {
            return $this->selectForCountry($countryCode);
        }

        return $this->getDefaultGateway();
    }

    /**
     * Sélectionne la passerelle de paiement pour un code pays.
     *
     * Logique:
     * 1. Si le pays est dans la liste Stripe (~40 pays) → Stripe
     * 2. Pour TOUS les autres pays (~160+ pays) → PayPal
     *
     * PayPal couvre ~200 pays, donc c'est le fallback mondial.
     */
    public function selectForCountry(string $countryCode): string
    {
        $countryCode = strtoupper(trim($countryCode));

        // Pays où PayPal ne fonctionne pas (sanctions, etc.)
        $paypalBlocked = config('ulixai.payment.paypal_blocked_countries', [
            'CU', 'IR', 'KP', 'SY', 'SD', 'RU', 'BY', // Sanctions
        ]);

        if (in_array($countryCode, $paypalBlocked, true)) {
            Log::debug('PaymentGatewaySelector: Stripe selected (PayPal blocked)', [
                'country' => $countryCode,
            ]);
            return self::GATEWAY_STRIPE;
        }

        // Vérifier si le pays est dans la liste Stripe préférée (~40 pays)
        $stripePreferred = config('ulixai.payment.stripe_preferred_countries', []);
        if (in_array($countryCode, $stripePreferred, true)) {
            Log::debug('PaymentGatewaySelector: Stripe selected for country', [
                'country' => $countryCode,
                'reason' => 'stripe_preferred_list',
            ]);
            return self::GATEWAY_STRIPE;
        }

        // TOUS les autres pays (~160+) → PayPal par défaut
        // PayPal couvre ~200 pays dans le monde
        if ($this->isPayPalAvailable()) {
            Log::debug('PaymentGatewaySelector: PayPal selected for country', [
                'country' => $countryCode,
                'reason' => 'worldwide_coverage',
            ]);
            return self::GATEWAY_PAYPAL;
        }

        // Fallback si PayPal non configuré
        return self::GATEWAY_STRIPE;
    }

    /**
     * Retourne la passerelle par défaut.
     */
    public function getDefaultGateway(): string
    {
        return config('ulixai.payment.default_gateway', self::GATEWAY_STRIPE);
    }

    /**
     * Vérifie si PayPal est disponible.
     */
    public function isPayPalAvailable(): bool
    {
        return !empty(config('services.paypal.client_id'))
            && !empty(config('services.paypal.client_secret'));
    }

    /**
     * Vérifie si Stripe est disponible.
     */
    public function isStripeAvailable(): bool
    {
        return !empty(config('services.stripe.key'))
            && !empty(config('services.stripe.secret'));
    }

    /**
     * Retourne les passerelles disponibles.
     */
    public function getAvailableGateways(): array
    {
        $gateways = [];

        if ($this->isStripeAvailable()) {
            $gateways[] = self::GATEWAY_STRIPE;
        }

        if ($this->isPayPalAvailable()) {
            $gateways[] = self::GATEWAY_PAYPAL;
        }

        return $gateways;
    }

    /**
     * Vérifie si une passerelle spécifique est supportée pour un pays.
     */
    public function isGatewaySupportedForCountry(string $gateway, string $countryCode): bool
    {
        $countryCode = strtoupper(trim($countryCode));

        if ($gateway === self::GATEWAY_STRIPE) {
            // Stripe est supporté dans ~46 pays listés
            $stripeCountries = config('ulixai.payment.stripe_preferred_countries', []);
            return in_array($countryCode, $stripeCountries, true);
        }

        if ($gateway === self::GATEWAY_PAYPAL) {
            // PayPal couvre ~200 pays sauf ceux sous sanctions
            $paypalBlocked = config('ulixai.payment.paypal_blocked_countries', []);
            return !in_array($countryCode, $paypalBlocked, true);
        }

        return false;
    }

    /**
     * Retourne les informations de la passerelle pour l'affichage frontend.
     */
    public function getGatewayInfo(string $gateway): array
    {
        $info = [
            self::GATEWAY_STRIPE => [
                'name' => 'Stripe',
                'icon' => 'stripe-logo.svg',
                'supports_cards' => true,
                'supports_sepa' => true,
                'supports_ideal' => true,
                'instant_capture' => true,
            ],
            self::GATEWAY_PAYPAL => [
                'name' => 'PayPal',
                'icon' => 'paypal-logo.svg',
                'supports_cards' => true,
                'supports_paypal_balance' => true,
                'supports_venmo' => true, // US only
                'instant_capture' => true,
            ],
        ];

        return $info[$gateway] ?? [];
    }

    /**
     * Retourne les deux passerelles avec leurs infos pour le frontend.
     */
    public function getAllGatewaysInfo(string $countryCode): array
    {
        $recommended = $this->selectForCountry($countryCode);
        $gateways = [];

        foreach ($this->getAvailableGateways() as $gateway) {
            $info = $this->getGatewayInfo($gateway);
            $info['code'] = $gateway;
            $info['recommended'] = ($gateway === $recommended);
            $info['supported'] = $this->isGatewaySupportedForCountry($gateway, $countryCode);
            $gateways[] = $info;
        }

        // Trier: recommandé en premier
        usort($gateways, fn($a, $b) => $b['recommended'] <=> $a['recommended']);

        return $gateways;
    }
}
