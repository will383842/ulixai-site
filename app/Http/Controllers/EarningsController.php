<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayoutProcessedMail;

use App\Models\User;
use App\Models\AffiliateCommission;
use App\Models\Transaction;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use App\Services\PaymentService;
use App\Services\CurrencyService;
use App\Models\Payout;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Account;
use Stripe\AccountLink;
use Illuminate\Support\Facades\DB;



class EarningsController extends Controller
{
    protected $PaymentService;

    public function __construct(PaymentService $PaymentService) {
        $this->PaymentService = $PaymentService;
    }

    public function index(Request $reqest) {
        $user= auth()->user();
        $provider = $user->serviceprovider;
        $currency = $user->preferred_currency ?? 'EUR';

        if ($provider && $provider->stripe_account_id) {
            try {
                $stripeBalance = $this->PaymentService->providerAccountBalance($provider);
            } catch (\Exception $e) {
                $stripeBalance = ['error' => 'Unable to fetch Stripe balance.'];
            }
            return view('dashboard.my-earnings', [
                'user' => $user,
                'provider' => $provider,
                'balance' => $stripeBalance,
                'currency' => $currency,
            ]);

        }
        return view('dashboard.my-earnings', [
            'user' => $user,
            'currency' => $currency,
        ]);
    }

    public function manageUserFunds(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return back()->with('error', 'You must be logged in to withdraw.');
        }

        // ✅ SÉCURITÉ: Vérifier que l'utilisateur est actif
        if ($user->status !== 'active') {
            return back()->with('error', 'Your account is not active. Please contact support.');
        }

        // ✅ Initialiser la variable pour éviter undefined
        $totalPayoutAmount = 0;

        // Récupérer la devise préférée de l'utilisateur (EUR ou USD)
        $currency = strtolower($user->preferred_currency ?? 'EUR');
        $currencySymbol = config('currencies.symbols.' . strtoupper($currency), '€');

        // ✅ Récupérer le minimum de retrait dynamique depuis la configuration
        $minimumWithdrawal = config('currencies.minimum_withdrawal.' . strtoupper($currency), 30);

        DB::beginTransaction();

        try {
            $affiliateAmount = $user->pending_affiliate_balance ?? 0;
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            // Create initial payout record
            $payoutRecord = Payout::create([
                'user_id' => $user->id,
                'provider_id' => optional($user->serviceProvider)->id,
                'amount' => $affiliateAmount,
                'currency' => $currency,
                'payout_type' => 'affiliate',
                'status' => 'processing'
            ]);

            if ($user->user_role === 'service_provider' && isset($user->serviceprovider->stripe_account_id)) {
                $accountId = $user->serviceprovider->stripe_account_id;
                $account = $stripe->accounts->retrieve($accountId);

                if (!$account->charges_enabled || !$account->payouts_enabled) {
                    throw new \Exception('Your Stripe account is not fully verified or payouts are disabled.');
                }

                $balance = $stripe->balance->retrieve(
                    [],
                    ['stripe_account' => $accountId]
                );

                // ✅ SÉCURITÉ: Vérifier que le tableau available n'est pas vide
                $availableBalance = 0;
                if (!empty($balance->available) && isset($balance->available[0]->amount)) {
                    $balanceCurrency = strtoupper($balance->available[0]->currency ?? 'EUR');
                    $availableBalance = CurrencyService::fromCents($balance->available[0]->amount, $balanceCurrency);
                }

                $totalPayoutAmount = $affiliateAmount + $availableBalance;

                if ($totalPayoutAmount < $minimumWithdrawal) {
                    DB::rollBack();
                    return back()->with('error', 'Total balance is less than minimum withdrawal amount (' . $minimumWithdrawal . $currencySymbol . ')');
                }

                if ($affiliateAmount > 0) {
                    $transfer = $stripe->transfers->create([
                        'amount' => CurrencyService::toCents($affiliateAmount, strtoupper($currency)),
                        'currency' => $currency,
                        'destination' => $accountId,
                        'description' => 'Affiliate commission transfer',
                        'transfer_group' => 'affiliate_transfer_' . $user->id,
                    ]);

                    $payoutRecord->update([
                        'stripe_transfer_id' => $transfer->id,
                        'bank_account_type' => 'connected_account'
                    ]);
                }

                $stripePayout = $stripe->payouts->create(
                    [
                        'amount' => CurrencyService::toCents($totalPayoutAmount, strtoupper($currency)),
                        'currency' => $currency,
                        'method' => 'standard',
                    ],
                    ['stripe_account' => $accountId]
                );

                if ($stripePayout && $stripePayout->id) {
                    $this->finalizeSuccessfulPayout($payoutRecord, $user, $totalPayoutAmount, $stripePayout->id, 'paid');
                }
            } else {
                // ✅ Assigner pour le cas non-provider
                $totalPayoutAmount = $affiliateAmount;

                if (!$user->hasBankingDetails()) {
                    throw new \Exception('Please add your bank account details before withdrawing.');
                }

                if ($affiliateAmount < $minimumWithdrawal) {
                    throw new \Exception('Minimum withdrawal amount is ' . $minimumWithdrawal . $currencySymbol);
                }

                try {
                    $stripePayoutResult = $stripe->payouts->create([
                        'amount' => CurrencyService::toCents($affiliateAmount, strtoupper($currency)),
                        'currency' => $currency,
                        'method' => 'standard',
                        'destination' => [
                            'type' => 'iban',
                            'iban' => $user->bank_account_iban,
                            'account_holder_name' => $user->bank_account_holder,
                            'account_holder_type' => 'individual',
                        ],
                        'statement_descriptor' => 'Ulix.ai Affiliate',
                        'metadata' => [
                            'user_id' => $user->id,
                            'payout_type' => 'affiliate_commission',
                            'payout_record_id' => $payoutRecord->id
                        ]
                    ]);

                    if ($stripePayoutResult && $stripePayoutResult->id) {
                        $payoutRecord->update([
                            'stripe_payout_id' => $stripePayoutResult->id,
                            'bank_account_last4' => substr($user->bank_account_iban, -4),
                            'bank_account_type' => 'external_account',
                            'amount' => $affiliateAmount,
                            'paid_at' => now()
                        ]);

                        $this->finalizeSuccessfulPayout($payoutRecord, $user, $affiliateAmount, $stripePayoutResult->id, 'processing');
                    }
                } catch (\Stripe\Exception\InvalidRequestException $e) {
                    throw new \Exception('Bank payout failed: ' . $e->getMessage());
                }
            }

            DB::commit();
            return back()->with('success', 'Your withdrawal of ' . number_format($totalPayoutAmount, 2) . $currencySymbol . ' has been processed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($payoutRecord)) {
                $payoutRecord->update([
                    'status' => 'failed',
                    'failure_reason' => $e->getMessage()
                ]);
            }
            return back()->with('error', 'Withdrawal failed: ' . $e->getMessage());
        }
    }

    /**
     * ✅ Méthode helper pour finaliser un payout réussi (évite duplication)
     */
    private function finalizeSuccessfulPayout(Payout $payoutRecord, User $user, float $amount, string $stripePayoutId, string $status): void
    {
        $payoutRecord->update([
            'amount' => $amount,
            'stripe_payout_id' => $stripePayoutId,
            'status' => $status,
            'paid_at' => now()
        ]);

        // Mettre à jour les commissions affiliées en 'paid'
        AffiliateCommission::where('referrer_id', $user->id)
            ->where('status', 'available')
            ->update(['status' => 'paid']);

        $user->pending_affiliate_balance = 0;
        $user->save();

        Mail::to($user->email)->queue(new PayoutProcessedMail($payoutRecord));
    }
}
