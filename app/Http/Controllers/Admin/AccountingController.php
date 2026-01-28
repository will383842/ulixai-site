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
     * ✅ SECURITY: Whitelist of allowed column names to prevent SQL injection
     * Only these column names can be used in raw SQL queries
     */
    private const ALLOWED_COLUMNS = [
        // Amount columns
        'amount_paid', 'amount', 'total_amount', 'grand_total', 'price', 'net_amount',
        // Currency columns
        'currency', 'payment_currency', 'currency_code', 'payout_currency',
        // Status columns
        'status', 'payment_status', 'payout_status',
        // Country columns
        'country', 'buyer_country', 'customer_country', 'provider_country', 'account_country',
        // Date columns
        'created_at', 'paid_at', 'date', 'updated_at', 'verified_at',
        // KYC columns
        'kyc_status', 'kyc_verified',
    ];

    /**
     * Petite aide: renvoie le premier nom de colonne existant dans $table
     * ✅ SECURITY: Returns properly quoted column name to prevent SQL injection
     */
    private function firstExistingCol(string $table, array $candidates): ?string
    {
        foreach ($candidates as $col) {
            // Validate column is in whitelist
            if (!in_array($col, self::ALLOWED_COLUMNS, true)) {
                continue;
            }
            if (Schema::hasColumn($table, $col)) {
                return $col;
            }
        }
        return null;
    }

    /**
     * ✅ SECURITY: Safely quote a column name for use in raw SQL
     */
    private function quoteColumn(?string $col): string
    {
        if ($col === null) {
            return '0';
        }
        // Validate against whitelist
        if (!in_array($col, self::ALLOWED_COLUMNS, true)) {
            return '0';
        }
        // Use backticks for MySQL column quoting
        return '`' . $col . '`';
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

        // ✅ SECURITY: Use quoted column names to prevent SQL injection
        $txAmountExpr = $this->quoteColumn($txAmountCol);

        $txQuery = DB::table($txTable)
            ->select(DB::raw('COUNT(*) as count'))
            ->selectRaw('COALESCE(SUM(' . $txAmountExpr . '),0) as total');

        $txGroupBy = [];

        // currency - use safe column reference
        if ($txCurrencyCol) {
            $txQuery->addSelect(DB::raw("COALESCE(" . $this->quoteColumn($txCurrencyCol) . ", 'EUR') as currency"));
            $txGroupBy[] = $txCurrencyCol;
            $txQuery->orderBy($txCurrencyCol);
        } else {
            // Pas de colonne currency trouvée - valeur par défaut
            $txQuery->addSelect(DB::raw("'N/A' as currency"));
        }

        // status - use safe column reference
        if ($txStatusCol) {
            $txQuery->addSelect(DB::raw($this->quoteColumn($txStatusCol) . ' as status'));
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

        // ✅ SECURITY: Use quoted column names to prevent SQL injection
        $poAmountExpr = $this->quoteColumn($poAmountCol);

        $poQuery = DB::table($poTable)
            ->select(DB::raw('COUNT(*) as count'))
            ->selectRaw('COALESCE(SUM(' . $poAmountExpr . '),0) as total');

        $poGroupBy = [];

        if ($poCurrencyCol) {
            $poQuery->addSelect(DB::raw("COALESCE(" . $this->quoteColumn($poCurrencyCol) . ", 'EUR') as currency"));
            $poGroupBy[] = $poCurrencyCol;
            $poQuery->orderBy($poCurrencyCol);
        } else {
            // Pas de colonne currency trouvée - valeur par défaut
            $poQuery->addSelect(DB::raw("'N/A' as currency"));
        }

        if ($poStatusCol) {
            $poQuery->addSelect(DB::raw($this->quoteColumn($poStatusCol) . ' as status'));
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
                $currencyCol = $this->firstExistingCol($table, ['currency','payment_currency','currency_code']);
                $statusCol   = $this->firstExistingCol($table, ['status','payment_status']);
                $dateCol     = $this->firstExistingCol($table, ['created_at','paid_at','date']);

                // ✅ SECURITY: Use quoted column names to prevent SQL injection
                $amountExpr   = $this->quoteColumn($amountCol);
                $dateExpr     = $dateCol ? "DATE(" . $this->quoteColumn($dateCol) . ")" : "DATE(NOW())";
                $currencyExpr = $currencyCol
                    ? "COALESCE(" . $this->quoteColumn($currencyCol) . ", 'EUR')"
                    : "'EUR'";

                $query = DB::table($table)
                    ->selectRaw("$dateExpr as date, $currencyExpr as currency, COALESCE(SUM($amountExpr),0) as total")
                    ->when($statusCol, fn ($q) => $q->where($statusCol, 'paid'))
                    ->when($dateCol, fn ($q) => $q->where($dateCol, '>=', now()->subDays(29)))
                    ->groupBy('date');

                // Grouper par devise si la colonne existe
                if ($currencyCol) {
                    $query->groupBy($currencyCol);
                }

                $rows = $query->orderBy('date')->get();

                fputcsv($out, ['date', 'currency', 'total']);
                foreach ($rows as $r) {
                    fputcsv($out, [$r->date, $r->currency, $r->total]);
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

                // ✅ SECURITY: Use quoted column names to prevent SQL injection
                $dateExpr  = $dateCol ? "DATE(" . $this->quoteColumn($dateCol) . ")" : "DATE(NOW())";
                $kycExpr   = $kycCol ? $this->quoteColumn($kycCol) . "='verified'" : "1=0";

                $rows = DB::table($table)
                    ->selectRaw("$dateExpr as date, SUM(CASE WHEN $kycExpr THEN 1 ELSE 0 END) as verified")
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
