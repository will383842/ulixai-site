<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionOffer;
use App\Models\ServiceProvider;
use App\Models\Transaction;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Account as StripeAccount;
use Illuminate\Support\Facades\DB;
use App\Services\PaymentService;

class TransactionController extends Controller
{
    public function show(Request $request, $transactionId)
    {
        // Set the Stripe API key
        $stripe = new StripeClient(config('services.stripe.secret'));

        try {
            // Fetch the transaction from the database
            $transaction = Transaction::findOrFail($transactionId);

            // Fetch the payment intent from Stripe using the paymentIntentId from the transaction
            $paymentIntent = $stripe->paymentIntents->retrieve($transaction->stripe_payment_intent_id, []);
            // Return the view with the transaction and payment intent details
            return view('admin.transactions.show', compact('transaction', 'paymentIntent'));
            
        } catch (ApiErrorException $e) {
            // If the payment intent retrieval fails, catch the error and redirect back
            return redirect()->back()->with('toast_error', 'Payment intent not found: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('toast_error', 'Error: ' . $e->getMessage());
        }
    }


    public function filterTransactions(Request $request)
    {
        // Start a query to get all transactions
        $query = Transaction::query();

        // Apply filters if they are provided
        if ($request->has('country') && $request->country != '') {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->has('mission_name') && $request->mission_name != '') {
            $query->whereHas('mission', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->mission_name . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('email') && $request->email != '') {
            $query->whereHas('provider', function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->email . '%');
            });
        }

        // Get the filtered results
        $transactions = $query->get();

        $transactions->map(function ($transaction) {
            
            $transaction->mission = $transaction->mission;
            $transaction->provider = $transaction->provider;
            return $transaction;
        });
        // Return the filtered transactions as a JSON response
        return response()->json($transactions);
    }

    public function refund($id)
    {
        try {
            $transaction = Transaction::with(['mission', 'provider'])->findOrFail($id);

            if ($transaction->status === 'released' || $transaction->status === 'refunded') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot refund a released or already refunded transaction'
                ], 400);
            }

            $paymentService = new PaymentService();
            $result = $paymentService->refundTransaction($transaction);

            if ($result) {
                // Update transaction status
                $transaction->status = 'refunded';
                $transaction->save();

                // Update mission payment status
                if ($transaction->mission) {
                    $transaction->mission->payment_status = 'refunded';
                    $transaction->mission->status = 'published';
                    $transaction->mission->selected_provider_id = null;
                    $transaction->mission->save();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Transaction refunded successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to process refund'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to refund transaction: ' . $e->getMessage()
            ], 500);
        }
    }
}
