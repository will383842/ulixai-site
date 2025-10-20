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
            ]);
            
        }
        return view('dashboard.my-earnings', [
            'user' => $user
        ]);        
    }

    public function manageUserFunds(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return back()->with('error', 'You must be logged in to withdraw.');
        }

        DB::beginTransaction();

        try {
            $affiliateAmount = $user->pending_affiliate_balance ?? 0;
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            
            // Create initial payout record
            $payoutRecord = Payout::create([
                'user_id' => $user->id,
                'provider_id' => $user->serviceProvider->id ?? null,
                'amount' => $affiliateAmount,
                'currency' => 'eur',
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
                $availableBalance = $balance->available[0]->amount / 100; 

                $totalPayoutAmount = $affiliateAmount + $availableBalance;

                if ($totalPayoutAmount < 30) {
                    return back()->with('error', 'Total balance is less than minimum withdrawal amount (30€)');
                }

                if ($affiliateAmount > 0) {
                    $transfer = $stripe->transfers->create([
                        'amount' => (int) round($affiliateAmount * 100),
                        'currency' => 'eur',
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
                        'amount' => (int) round($totalPayoutAmount * 100),
                        'currency' => 'eur',
                        'method' => 'standard',
                    ],
                    ['stripe_account' => $accountId]
                );

                if ($stripePayout && $stripePayout->id) {
                    $payoutRecord->update([
                        'amount' => $totalPayoutAmount,
                        'stripe_payout_id' => $stripePayout->id,
                        'status' => 'paid',
                        'paid_at' => now()
                    ]);

                    $user->pending_affiliate_balance = 0;
                    $user->save();

                    Mail::to($user->email)->queue(new PayoutProcessedMail($payoutRecord));
                }
            } else {
                if (!$user->hasBankingDetails()) {
                    throw new \Exception('Please add your bank account details before withdrawing.');
                }

                if ($affiliateAmount < 30) {
                    throw new \Exception('Minimum withdrawal amount is 30€');
                }

                try {
                    $stripePayoutResult = $stripe->payouts->create([
                        'amount' => (int) round($affiliateAmount * 100),
                        'currency' => 'eur',
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
                            'status' => 'processing',
                            'amount' => $affiliateAmount,
                            'paid_at' => now()
                        ]);

                        $user->pending_affiliate_balance = 0;
                        $user->save();

                        Mail::to($user->email)->queue(new PayoutProcessedMail($payoutRecord));
                    }
                } catch (\Stripe\Exception\InvalidRequestException $e) {
                    throw new \Exception('Bank payout failed: ' . $e->getMessage());
                }
            }

            DB::commit();
            return back()->with('success', 'Your withdrawal of ' . number_format($totalPayoutAmount, 2) . '€ has been processed successfully.');
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
}
