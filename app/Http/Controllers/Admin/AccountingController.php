<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AccountingController extends Controller
{
    /**
     * Petite aide: renvoie le premier nom de colonne existant dans $table
     */
    private function firstExistingCol(string $table, array $candidates): ?string
    {
        foreach ($candidates as $col) {
            if (Schema::hasColumn($table, $col)) {
                return $col;
            }
        }
        return null;
    }

    /**
     * Page comptabilité (agrégats)
     */
    public function index(Request $request)
    {
        $country  = $request->input('country');    // optionnel
        $currency = $request->input('currency');   // optionnel

        // ------- TRANSACTIONS -------
        $txTable         = 'transactions';
        $txAmountCol     = $this->firstExistingCol($txTable, ['amount_paid','amount','total_amount','grand_total','price']);
        $txCurrencyCol   = $this->firstExistingCol($txTable, ['currency','payment_currency','currency_code']);
        $txStatusCol     = $this->firstExistingCol($txTable, ['status','payment_status']);
        $txCountryCol    = $this->firstExistingCol($txTable, ['country','buyer_country','customer_country']);

        $txAmountExpr = $txAmountCol ? $txAmountCol : '0';

        $txQuery = DB::table($txTable)
            ->select(DB::raw('COUNT(*) as count'))
            ->selectRaw('COALESCE(SUM(' . $txAmountExpr . '),0) as total');

        $txGroupBy = [];

        // currency
        if ($txCurrencyCol) {
            $txQuery->addSelect($txCurrencyCol . ' as currency');
            $txGroupBy[] = $txCurrencyCol;
            $txQuery->orderBy($txCurrencyCol);
        } else {
            // valeur par défaut pour affichage
            $txQuery->addSelect(DB::raw("'EUR' as currency"));
        }

        // status
        if ($txStatusCol) {
            $txQuery->addSelect($txStatusCol . ' as status');
            $txGroupBy[] = $txStatusCol;
            $txQuery->orderBy($txStatusCol);
        } else {
            $txQuery->addSelect(DB::raw("'all' as status"));
        }

        if (!empty($txGroupBy)) {
            $txQuery->groupBy($txGroupBy);
        }

        // filtres optionnels seulement si colonnes présentes
        if ($country && $txCountryCol) {
            $txQuery->where($txCountryCol, $country);
        }
        if ($currency && $txCurrencyCol) {
            $txQuery->where($txCurrencyCol, $currency);
        }

        $tx = $txQuery->get();

        // ------- PAYOUTS -------
        $poTable         = 'payouts';
        $poAmountCol     = $this->firstExistingCol($poTable, ['amount','amount_paid','net_amount','total_amount']);
        $poCurrencyCol   = $this->firstExistingCol($poTable, ['currency','currency_code','payout_currency']);
        $poStatusCol     = $this->firstExistingCol($poTable, ['status','payout_status']);
        $poCountryCol    = $this->firstExistingCol($poTable, ['country','provider_country','account_country']);

        $poAmountExpr = $poAmountCol ? $poAmountCol : '0';

        $poQuery = DB::table($poTable)
            ->select(DB::raw('COUNT(*) as count'))
            ->selectRaw('COALESCE(SUM(' . $poAmountExpr . '),0) as total');

        $poGroupBy = [];

        if ($poCurrencyCol) {
            $poQuery->addSelect($poCurrencyCol . ' as currency');
            $poGroupBy[] = $poCurrencyCol;
            $poQuery->orderBy($poCurrencyCol);
        } else {
            $poQuery->addSelect(DB::raw("'EUR' as currency"));
        }

        if ($poStatusCol) {
            $poQuery->addSelect($poStatusCol . ' as status');
            $poGroupBy[] = $poStatusCol;
            $poQuery->orderBy($poStatusCol);
        } else {
            $poQuery->addSelect(DB::raw("'all' as status"));
        }

        if (!empty($poGroupBy)) {
            $poQuery->groupBy($poGroupBy);
        }

        if ($country && $poCountryCol) {
            $poQuery->where($poCountryCol, $country);
        }
        if ($currency && $poCurrencyCol) {
            $poQuery->where($poCurrencyCol, $currency);
        }

        $payouts = $poQuery->get();

        return view('admin.accounting.index', [
            'tx'       => $tx,
            'payouts'  => $payouts,
            'filters'  => ['country' => $country, 'currency' => $currency],
        ]);
    }

    /**
     * Export CSV (revenus / kyc)
     */
    public function export(Request $request): StreamedResponse
    {
        $section  = $request->get('section', 'revenue'); // 'revenue' | 'kyc'
        $filename = "accounting_export_{$section}_" . now()->format('Ymd_His') . ".csv";

        return response()->streamDownload(function () use ($section) {
            $out = fopen('php://output', 'w');

            if ($section === 'revenue') {
                $table       = 'transactions';
                $amountCol   = $this->firstExistingCol($table, ['amount_paid','amount','total_amount','grand_total','price']);
                $statusCol   = $this->firstExistingCol($table, ['status','payment_status']);
                $dateCol     = $this->firstExistingCol($table, ['created_at','paid_at','date']);

                $amountExpr  = $amountCol ? $amountCol : '0';
                $dateExpr    = $dateCol ? "DATE($dateCol)" : "DATE(NOW())";

                $rows = DB::table($table)
                    ->selectRaw("$dateExpr as date, COALESCE(SUM($amountExpr),0) as total")
                    ->when($statusCol, fn ($q) => $q->where($statusCol, 'paid'))
                    ->when($dateCol, fn ($q) => $q->where($dateCol, '>=', now()->subDays(29)))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                fputcsv($out, ['date','total_eur']);
                foreach ($rows as $r) {
                    fputcsv($out, [$r->date, $r->total]);
                }

            } elseif ($section === 'kyc') {
                $table     = Schema::hasTable('service_providers') ? 'service_providers' : null;
                if (!$table) {
                    fputcsv($out, ['date','verified']);
                    // pas de table -> pas de lignes
                    fclose($out);
                    return;
                }

                $kycCol    = $this->firstExistingCol($table, ['kyc_status','kyc_verified']);
                $dateCol   = $this->firstExistingCol($table, ['updated_at','created_at','verified_at']);
                $dateExpr  = $dateCol ? "DATE($dateCol)" : "DATE(NOW())";

                $rows = DB::table($table)
                    ->selectRaw("$dateExpr as date, SUM(CASE WHEN " . ($kycCol ? "$kycCol='verified'" : "1=0") . " THEN 1 ELSE 0 END) as verified")
                    ->when($dateCol, fn ($q) => $q->where($dateCol, '>=', now()->subDays(29)))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                fputcsv($out, ['date','verified']);
                foreach ($rows as $r) {
                    fputcsv($out, [$r->date, $r->verified]);
                }

            } else {
                fputcsv($out, ['message']);
                fputcsv($out, ['Unknown section']);
            }

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
