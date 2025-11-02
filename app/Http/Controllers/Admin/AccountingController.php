<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

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

    public function export(\Illuminate\Http\Request $request)
    {
        $section = $request->get('section','revenue');
        $filename = "accounting_export_{$section}_" . now()->format('Ymd_His') . ".csv";
        return new StreamedResponse(function () use ($section) {
            $out = fopen('php://output','w');
            if ($section==='revenue') {
                $rows = DB::table('transactions')->selectRaw('DATE(created_at) as date, SUM(amount_paid) as total')
                    ->where('status','paid')->where('created_at','>=', now()->subDays(29))
                    ->groupBy('date')->orderBy('date')->get();
                fputcsv($out, ['date','total_eur']);
                foreach ($rows as $r) fputcsv($out, [$r->date, $r->total]);
            } elseif ($section==='kyc') {
                $rows = DB::table('service_providers')->selectRaw("DATE(updated_at) as date, SUM(CASE WHEN kyc_status='verified' THEN 1 ELSE 0 END) as verified")
                    ->where('updated_at','>=', now()->subDays(29))
                    ->groupBy('date')->orderBy('date')->get();
                fputcsv($out, ['date','verified']);
                foreach ($rows as $r) fputcsv($out, [$r->date, $r->verified]);
            } else {
                fputcsv($out, ['info','Section not supported']);
            }
            fclose($out);
        }, 200, ['Content-Type'=>'text/csv','Content-Disposition'=>"attachment; filename=\"$filename\""]);
    }
}