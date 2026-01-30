<?php

declare(strict_types=1);

namespace App\Services\Gateways;

use App\Exceptions\PayPalException;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service PayPal - Simple Flow (Payouts API).
 *
 * Gère les paiements PayPal avec le flux simple:
 * - Les fonds transitent par Ulixai
 * - Payout vers le prestataire via Payouts API
 *
 * Ce n'est PAS PayPal Commerce Platform (pas de split direct).
 */
class PayPalGateway
{
    private CurrencyService $currencyService;
    private ?string $accessToken = null;
    private ?int $tokenExpiresAt = null;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    // =========================================================================
    // AUTHENTICATION
    // =========================================================================

    /**
     * Obtient un access token OAuth2.
     *
     * @throws PayPalException
     */
    public function getAccessToken(): string
    {
        // Vérifier le cache mémoire
        if ($this->accessToken && $this->tokenExpiresAt && time() < $this->tokenExpiresAt) {
            return $this->accessToken;
        }

        // Vérifier le cache Laravel
        $cacheKey = 'paypal_access_token_' . config('services.paypal.mode');
        $cached = Cache::get($cacheKey);

        if ($cached) {
            $this->accessToken = $cached['token'];
            $this->tokenExpiresAt = $cached['expires_at'];
            return $this->accessToken;
        }

        // Obtenir un nouveau token
        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');
        $apiUrl = config('services.paypal.api_url');

        if (!$clientId || !$clientSecret) {
            throw PayPalException::authenticationFailed('PayPal credentials not configured');
        }

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withBasicAuth($clientId, $clientSecret)
                ->asForm()
                ->post("{$apiUrl}/v1/oauth2/token", [
                    'grant_type' => 'client_credentials',
                ]);

            if (!$response->successful()) {
                Log::error('PayPal OAuth failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw PayPalException::authenticationFailed('OAuth request failed');
            }

            $data = $response->json();
            $this->accessToken = $data['access_token'];
            $this->tokenExpiresAt = time() + ($data['expires_in'] - 60); // 60s buffer

            // Mettre en cache
            Cache::put($cacheKey, [
                'token' => $this->accessToken,
                'expires_at' => $this->tokenExpiresAt,
            ], $data['expires_in'] - 60);

            Log::info('PayPal OAuth token obtained', [
                'expires_in' => $data['expires_in'],
            ]);

            return $this->accessToken;

        } catch (\Exception $e) {
            Log::error('PayPal OAuth exception', ['error' => $e->getMessage()]);
            throw PayPalException::authenticationFailed($e->getMessage());
        }
    }

    // =========================================================================
    // ORDERS API - CRÉATION DE COMMANDE
    // =========================================================================

    /**
     * Crée une commande PayPal pour une mission.
     *
     * @return array{order_id: string, approval_url: string, status: string}
     * @throws PayPalException
     */
    public function createOrder(
        Mission $mission,
        MissionOffer $offer,
        float $amount,
        float $clientFee,
        string $currency,
        string $returnUrl,
        string $cancelUrl
    ): array {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        $total = round($amount + $clientFee, 2);

        $payload = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => "MISSION_{$mission->id}",
                    'description' => "Mission: {$mission->title}",
                    'custom_id' => json_encode([
                        'mission_id' => $mission->id,
                        'provider_id' => $offer->provider_id,
                        'offer_id' => $offer->id,
                        'client_fee' => $clientFee,
                        'mission_amount' => $amount,
                    ]),
                    'amount' => [
                        'currency_code' => strtoupper($currency),
                        'value' => number_format($total, 2, '.', ''),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => strtoupper($currency),
                                'value' => number_format($amount, 2, '.', ''),
                            ],
                            'handling' => [
                                'currency_code' => strtoupper($currency),
                                'value' => number_format($clientFee, 2, '.', ''),
                            ],
                        ],
                    ],
                    'items' => [
                        [
                            'name' => substr($mission->title, 0, 127),
                            'description' => substr($mission->description ?? '', 0, 127) ?: 'Service mission',
                            'quantity' => '1',
                            'unit_amount' => [
                                'currency_code' => strtoupper($currency),
                                'value' => number_format($amount, 2, '.', ''),
                            ],
                            'category' => 'DIGITAL_GOODS',
                        ],
                    ],
                ],
            ],
            'payment_source' => [
                'paypal' => [
                    'experience_context' => [
                        'brand_name' => config('app.name', 'Ulixai'),
                        'locale' => app()->getLocale() . '-' . strtoupper(app()->getLocale()),
                        'landing_page' => 'LOGIN',
                        'shipping_preference' => 'NO_SHIPPING',
                        'user_action' => 'PAY_NOW',
                        'return_url' => $returnUrl,
                        'cancel_url' => $cancelUrl,
                    ],
                ],
            ],
        ];

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withToken($token)
                ->post("{$apiUrl}/v2/checkout/orders", $payload);

            if (!$response->successful()) {
                Log::error('PayPal create order failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'mission_id' => $mission->id,
                ]);
                throw PayPalException::orderCreationFailed($response->body());
            }

            $data = $response->json();
            $approvalUrl = collect($data['links'] ?? [])
                ->firstWhere('rel', 'payer-action')['href'] ?? null;

            if (!$approvalUrl) {
                $approvalUrl = collect($data['links'] ?? [])
                    ->firstWhere('rel', 'approve')['href'] ?? null;
            }

            Log::info('PayPal order created', [
                'order_id' => $data['id'],
                'mission_id' => $mission->id,
                'amount' => $total,
                'currency' => $currency,
            ]);

            return [
                'order_id' => $data['id'],
                'approval_url' => $approvalUrl,
                'status' => $data['status'],
            ];

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('PayPal create order exception', [
                'error' => $e->getMessage(),
                'mission_id' => $mission->id,
            ]);
            throw PayPalException::orderCreationFailed($e->getMessage());
        }
    }

    /**
     * Récupère les détails d'une commande PayPal.
     *
     * @throws PayPalException
     */
    public function getOrder(string $orderId): array
    {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        try {
            $response = Http::timeout(30)
                ->withToken($token)
                ->get("{$apiUrl}/v2/checkout/orders/{$orderId}");

            if (!$response->successful()) {
                throw PayPalException::apiError("Failed to get order: {$response->body()}");
            }

            return $response->json();

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw PayPalException::apiError($e->getMessage());
        }
    }

    // =========================================================================
    // ORDERS API - CAPTURE
    // =========================================================================

    /**
     * Capture une commande PayPal approuvée.
     *
     * @return array{capture_id: string, status: string, amount: float}
     * @throws PayPalException
     */
    public function captureOrder(string $orderId): array
    {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withToken($token)
                ->withHeaders(['PayPal-Request-Id' => "capture_{$orderId}_" . time()])
                ->post("{$apiUrl}/v2/checkout/orders/{$orderId}/capture", []);

            if (!$response->successful()) {
                Log::error('PayPal capture failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'order_id' => $orderId,
                ]);
                throw PayPalException::captureRejected($orderId, $response->body());
            }

            $data = $response->json();
            $capture = $data['purchase_units'][0]['payments']['captures'][0] ?? null;

            if (!$capture) {
                throw PayPalException::captureRejected($orderId, 'No capture data in response');
            }

            Log::info('PayPal order captured', [
                'order_id' => $orderId,
                'capture_id' => $capture['id'],
                'status' => $capture['status'],
                'amount' => $capture['amount']['value'] ?? 0,
            ]);

            return [
                'capture_id' => $capture['id'],
                'status' => $capture['status'],
                'amount' => (float) ($capture['amount']['value'] ?? 0),
                'currency' => $capture['amount']['currency_code'] ?? 'EUR',
                'custom_id' => $data['purchase_units'][0]['custom_id'] ?? null,
            ];

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('PayPal capture exception', [
                'error' => $e->getMessage(),
                'order_id' => $orderId,
            ]);
            throw PayPalException::captureRejected($orderId, $e->getMessage());
        }
    }

    // =========================================================================
    // PAYOUTS API - TRANSFERT AU PRESTATAIRE
    // =========================================================================

    /**
     * Envoie un payout au prestataire.
     *
     * @return array{batch_id: string, item_id: string, status: string}
     * @throws PayPalException
     */
    public function sendPayout(
        ServiceProvider $provider,
        float $amount,
        string $currency,
        string $note,
        array $metadata = []
    ): array {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        // Le prestataire doit avoir un email PayPal configuré
        $paypalEmail = $provider->paypal_email ?? $provider->user?->email;

        if (!$paypalEmail) {
            throw PayPalException::payoutFailed('', 'Provider has no PayPal email configured');
        }

        $senderBatchId = 'ULIXAI_' . time() . '_' . $provider->id;
        $senderItemId = 'ITEM_' . ($metadata['mission_id'] ?? time()) . '_' . $provider->id;

        $payload = [
            'sender_batch_header' => [
                'sender_batch_id' => $senderBatchId,
                'recipient_type' => 'EMAIL',
                'email_subject' => 'Ulixai - Payment for your service',
                'email_message' => $note,
            ],
            'items' => [
                [
                    'recipient_type' => 'EMAIL',
                    'amount' => [
                        'value' => number_format($amount, 2, '.', ''),
                        'currency' => strtoupper($currency),
                    ],
                    'receiver' => $paypalEmail,
                    'note' => $note,
                    'sender_item_id' => $senderItemId,
                    'notification_language' => 'en-US',
                ],
            ],
        ];

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withToken($token)
                ->withHeaders(['PayPal-Request-Id' => $senderBatchId])
                ->post("{$apiUrl}/v1/payments/payouts", $payload);

            if (!$response->successful()) {
                Log::error('PayPal payout failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'provider_id' => $provider->id,
                ]);
                throw PayPalException::payoutFailed($senderBatchId, $response->body());
            }

            $data = $response->json();
            $batchId = $data['batch_header']['payout_batch_id'] ?? null;

            Log::info('PayPal payout initiated', [
                'batch_id' => $batchId,
                'provider_id' => $provider->id,
                'amount' => $amount,
                'currency' => $currency,
                'email' => $paypalEmail,
            ]);

            return [
                'batch_id' => $batchId,
                'sender_batch_id' => $senderBatchId,
                'item_id' => $senderItemId,
                'status' => $data['batch_header']['batch_status'] ?? 'PENDING',
            ];

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('PayPal payout exception', [
                'error' => $e->getMessage(),
                'provider_id' => $provider->id,
            ]);
            throw PayPalException::payoutFailed($senderBatchId, $e->getMessage());
        }
    }

    /**
     * Vérifie le statut d'un payout batch.
     *
     * @throws PayPalException
     */
    public function getPayoutStatus(string $batchId): array
    {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        try {
            $response = Http::timeout(30)
                ->withToken($token)
                ->get("{$apiUrl}/v1/payments/payouts/{$batchId}");

            if (!$response->successful()) {
                throw PayPalException::apiError("Failed to get payout status: {$response->body()}");
            }

            $data = $response->json();

            return [
                'batch_id' => $batchId,
                'status' => $data['batch_header']['batch_status'] ?? 'UNKNOWN',
                'amount' => $data['batch_header']['amount']['value'] ?? 0,
                'fees' => $data['batch_header']['fees']['value'] ?? 0,
                'items' => $data['items'] ?? [],
            ];

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw PayPalException::apiError($e->getMessage());
        }
    }

    // =========================================================================
    // REFUNDS
    // =========================================================================

    /**
     * Effectue un remboursement.
     *
     * @throws PayPalException
     */
    public function refund(string $captureId, ?float $amount = null, string $currency = 'EUR'): array
    {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');

        $payload = [];
        if ($amount !== null) {
            $payload['amount'] = [
                'value' => number_format($amount, 2, '.', ''),
                'currency_code' => strtoupper($currency),
            ];
        }

        try {
            $response = Http::timeout(30)
                ->retry(3, 1000)
                ->withToken($token)
                ->withHeaders(['PayPal-Request-Id' => "refund_{$captureId}_" . time()])
                ->post("{$apiUrl}/v2/payments/captures/{$captureId}/refund", $payload);

            if (!$response->successful()) {
                Log::error('PayPal refund failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'capture_id' => $captureId,
                ]);
                throw PayPalException::apiError("Refund failed: {$response->body()}");
            }

            $data = $response->json();

            Log::info('PayPal refund successful', [
                'refund_id' => $data['id'],
                'capture_id' => $captureId,
                'status' => $data['status'],
            ]);

            return [
                'refund_id' => $data['id'],
                'status' => $data['status'],
                'amount' => $data['amount']['value'] ?? $amount,
            ];

        } catch (PayPalException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw PayPalException::apiError($e->getMessage());
        }
    }

    // =========================================================================
    // WEBHOOKS
    // =========================================================================

    /**
     * Vérifie la signature d'un webhook PayPal.
     */
    public function verifyWebhookSignature(
        array $headers,
        string $rawBody
    ): bool {
        $token = $this->getAccessToken();
        $apiUrl = config('services.paypal.api_url');
        $webhookId = config('services.paypal.webhook_id');

        if (!$webhookId) {
            Log::warning('PayPal webhook ID not configured');
            return false;
        }

        $payload = [
            'auth_algo' => $headers['PAYPAL-AUTH-ALGO'] ?? '',
            'cert_url' => $headers['PAYPAL-CERT-URL'] ?? '',
            'transmission_id' => $headers['PAYPAL-TRANSMISSION-ID'] ?? '',
            'transmission_sig' => $headers['PAYPAL-TRANSMISSION-SIG'] ?? '',
            'transmission_time' => $headers['PAYPAL-TRANSMISSION-TIME'] ?? '',
            'webhook_id' => $webhookId,
            'webhook_event' => json_decode($rawBody, true),
        ];

        try {
            $response = Http::timeout(30)
                ->withToken($token)
                ->post("{$apiUrl}/v1/notifications/verify-webhook-signature", $payload);

            if (!$response->successful()) {
                Log::warning('PayPal webhook signature verification failed', [
                    'status' => $response->status(),
                ]);
                return false;
            }

            $data = $response->json();
            $isValid = ($data['verification_status'] ?? '') === 'SUCCESS';

            if (!$isValid) {
                Log::warning('PayPal webhook signature invalid', [
                    'verification_status' => $data['verification_status'] ?? 'UNKNOWN',
                ]);
            }

            return $isValid;

        } catch (\Exception $e) {
            Log::error('PayPal webhook verification exception', [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
