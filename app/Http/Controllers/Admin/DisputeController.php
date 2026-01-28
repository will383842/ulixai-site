<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Transaction;
use App\Models\AffiliateCommission;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Transfer;
use Stripe\Refund;
use App\Services\AuditLogService;

class DisputeController extends Controller
{
    public function index()
    {
        $disputes = Mission::with(['requester', 'selectedProvider.user', 'transactions', 'cancellationReasons'])
            ->where('status', 'disputed')
            ->where('payment_status', 'held')
            ->whereNotNull('selected_provider_id')
            ->get();

        return view('admin.dashboard.mission-disputes.disputes', compact('disputes'));
    }

    public function refund(Request $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $transaction = $mission->transactions()->where('status', 'paid')->firstOrFail();
        $requester = $mission->requester;
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $refund = Refund::create([
                'payment_intent' => $transaction->stripe_payment_intent_id,
                'amount' => ($transaction->amount_paid - $transaction->client_fee) * 100, 
            ]);

            if ($refund->status === 'succeeded') {
                $transaction->update(['status' => 'refunded']);
                $mission->update([
                    'status' => 'cancelled',
                    'payment_status' => 'refunded'
                ]);

                $requester->increment('credit_balance', $transaction->client_fee);

                // Log critique pour traçabilité
                AuditLogService::logRefund($transaction, 'dispute_refund_to_requester');

                return response()->json(['message' => 'Payment successfully refunded to requester']);
            }

            return response()->json(['message' => 'Refund failed'], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function transfer(Request $request)
    {
        $mission = Mission::findOrFail($request->mission_id);
        $transaction = $mission->transactions()->where('status', 'paid')->firstOrFail();
        $commission = \App\Models\UlixCommission::first();
        $provider = $mission->selectedProvider;

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $commissionAmount = ($commission->affiliate_fee * $transaction->provider_fee)* 100 / 100;
            $payProvider = ($transaction->amount_paid - $transaction->provider_fee) - $transaction->client_fee;
            $transfer = Transfer::create([
                'amount' =>   $payProvider * 100, 
                'currency' => 'eur',
                'destination' => $provider->stripe_account_id,
                'transfer_group' => 'MISSION_' . $mission->id,
            ]);

            $referee = auth()->user() ?? User::find($mission->requester_id);

            if( $referee->referred_by) {
                $referrer = User::find($referee->referred_by);

                if ($referrer) {
                    $commissionData = [
                        'referrer_id' => $referrer->id,
                        'referee_id' => $referee->id,
                        'mission_id' => $mission->id,
                        'amount' => $commissionAmount,
                        'status' => 'available',
                    ];
                    $commissionData['status'] = 'paid';
                    $commissionData['payout_method'] = 'stripe';
                    $commissionData['stripe_transfer_id'] = null;
                    AffiliateCommission::create($commissionData);
                    $referrer->increment('affiliate_balance', $commissionAmount);
                    $referrer->increment('pending_affiliate_balance', $commissionAmount);
                }
            }
            
            $transaction->update(['status' => 'released']);
            $mission->update([
                'status' => 'completed',
                'payment_status' => 'released'
            ]);

            // Log critique pour traçabilité
            AuditLogService::logPayment($transaction, 'dispute_transfer_to_provider');

            return response()->json(['message' => 'Payment successfully transferred to provider']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
