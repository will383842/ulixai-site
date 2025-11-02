<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payout;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index(Request $request)
    {
        $country = $request->get('country');
        $currency = $request->get('currency'); // Note: Transactions lack currency, fallback to 'eur'

        // Aggregate transactions by country
        $txQuery = Transaction::query();
        if ($country) $txQuery->where('country', $country);
        $tx = $txQuery->select(
                'country',
                DB::raw('COUNT(*) as tx_count'),
                DB::raw('SUM(amount_paid) as gross_amount'),
                DB::raw('SUM(client_fee) as client_fee_total'),
                DB::raw('SUM(provider_fee) as provider_fee_total')
            )
            ->groupBy('country')
            ->orderByDesc('gross_amount')
            ->get();

        // Aggregate payouts by currency/status
        $payoutQuery = Payout::query();
        if ($currency) $payoutQuery->where('currency', $currency);
        $payouts = $payoutQuery->select(
                'currency',
                'status',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('currency', 'status')
            ->orderBy('currency')
            ->orderBy('status')
            ->get();

        return view('admin.accounting.index', [
            'tx' => $tx,
            'payouts' => $payouts,
            'filters' => ['country' => $country, 'currency' => $currency],
        ]);
    }
}
