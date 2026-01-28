@extends('admin.dashboard.index')

@section('admin-content')
@php
    /**
     * Formate un montant avec son symbole de devise
     * @param float $amount Le montant à formater
     * @param string $currency Le code de la devise (eur, usd, gbp, etc.)
     * @return string Le montant formaté avec le symbole
     */
    function formatCurrency($amount, $currency) {
        $symbols = [
            'eur' => '€',
            'usd' => '$',
            'gbp' => '£',
            'chf' => 'CHF',
            'cad' => 'CA$',
            'aud' => 'A$',
            'jpy' => '¥',
            'cny' => '¥',
            'inr' => '₹',
            'brl' => 'R$',
            'mxn' => 'MX$',
            'pln' => 'zł',
            'sek' => 'kr',
            'nok' => 'kr',
            'dkk' => 'kr',
            'czk' => 'Kč',
            'huf' => 'Ft',
            'ron' => 'lei',
            'bgn' => 'лв',
            'hrk' => 'kn',
            'rub' => '₽',
            'try' => '₺',
            'zar' => 'R',
            'sgd' => 'S$',
            'hkd' => 'HK$',
            'nzd' => 'NZ$',
            'krw' => '₩',
            'thb' => '฿',
            'myr' => 'RM',
            'php' => '₱',
            'idr' => 'Rp',
            'vnd' => '₫',
            'aed' => 'د.إ',
            'sar' => '﷼',
            'ils' => '₪',
            'egp' => 'E£',
            'ngn' => '₦',
            'kes' => 'KSh',
            'xof' => 'CFA',
            'xaf' => 'FCFA',
            'mad' => 'DH',
            'tnd' => 'DT',
            'dzd' => 'DA',
        ];

        $curr = strtolower($currency ?? 'eur');
        $symbol = $symbols[$curr] ?? strtoupper($currency ?? '');

        // Devises sans décimales
        $noDecimals = ['jpy', 'krw', 'vnd', 'idr', 'huf'];
        $decimals = in_array($curr, $noDecimals) ? 0 : 2;

        $formatted = number_format($amount, $decimals, ',', ' ');

        // Position du symbole (avant ou après le montant)
        $symbolAfter = ['eur', 'chf', 'pln', 'sek', 'nok', 'dkk', 'czk', 'huf', 'ron', 'bgn', 'hrk', 'rub', 'try'];

        if (in_array($curr, $symbolAfter)) {
            return $formatted . ' ' . $symbol;
        }
        return $symbol . ' ' . $formatted;
    }
@endphp
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Comptabilité</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Comptabilité</h1>
        <p class="page-subtitle">Vue d'ensemble des transactions et paiements</p>
    </div>

    <!-- Filters -->
    <div class="admin-card" style="margin-bottom: 24px;">
        <div class="admin-card-body">
            <form method="get" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 12px; color: var(--admin-text-muted);">Pays</label>
                    <input type="text" name="country" value="{{ $filters['country'] ?? '' }}" class="form-input" placeholder="FR, US, ..." style="width: 120px;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 12px; color: var(--admin-text-muted);">Devise</label>
                    <input type="text" name="currency" value="{{ $filters['currency'] ?? '' }}" class="form-input" placeholder="eur, usd, ..." style="width: 120px;">
                </div>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtrer
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-bottom: 24px;">
        <!-- Transactions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Transactions par devise & statut</h2>
            </div>
            <div class="admin-table-responsive">
                <table class="admin-table admin-table-mobile">
                    <thead>
                        <tr>
                            <th>Devise</th>
                            <th>Statut</th>
                            <th style="text-align: right;">#</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tx as $row)
                        <tr>
                            <td data-label="Devise"><span style="font-family: monospace; text-transform: uppercase;">{{ $row->currency ?? '-' }}</span></td>
                            <td data-label="Statut">
                                @if(($row->status ?? '') == 'completed')
                                    <span class="badge badge-success">{{ $row->status }}</span>
                                @elseif(($row->status ?? '') == 'pending')
                                    <span class="badge badge-warning">{{ $row->status }}</span>
                                @else
                                    <span class="badge badge-default">{{ $row->status ?? '-' }}</span>
                                @endif
                            </td>
                            <td data-label="Nombre" style="text-align: right; font-weight: 500;">{{ $row->count ?? 0 }}</td>
                            <td data-label="Total" style="text-align: right; font-weight: 600;">{{ formatCurrency($row->total ?? 0, $row->currency ?? 'eur') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="admin-empty-state">
                                    <p class="admin-empty-title">Aucune donnée</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payouts -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Payouts par devise & statut</h2>
            </div>
            <div class="admin-table-responsive">
                <table class="admin-table admin-table-mobile">
                    <thead>
                        <tr>
                            <th>Devise</th>
                            <th>Statut</th>
                            <th style="text-align: right;">#</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payouts as $row)
                        <tr>
                            <td data-label="Devise"><span style="font-family: monospace; text-transform: uppercase;">{{ $row->currency ?? '-' }}</span></td>
                            <td data-label="Statut">
                                @if(($row->status ?? '') == 'paid')
                                    <span class="badge badge-success">{{ $row->status }}</span>
                                @elseif(($row->status ?? '') == 'pending')
                                    <span class="badge badge-warning">{{ $row->status }}</span>
                                @else
                                    <span class="badge badge-default">{{ $row->status ?? '-' }}</span>
                                @endif
                            </td>
                            <td data-label="Nombre" style="text-align: right; font-weight: 500;">{{ $row->count ?? 0 }}</td>
                            <td data-label="Total" style="text-align: right; font-weight: 600;">{{ formatCurrency($row->total ?? 0, $row->currency ?? 'eur') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="admin-empty-state">
                                    <p class="admin-empty-title">Aucune donnée</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Totals by Currency Summary -->
    @php
        // Calculer les totaux par devise pour les transactions
        $txTotalsByCurrency = collect($tx)->groupBy('currency')->map(function($items) {
            return $items->sum('total');
        });
        // Calculer les totaux par devise pour les payouts
        $payoutTotalsByCurrency = collect($payouts)->groupBy('currency')->map(function($items) {
            return $items->sum('total');
        });
    @endphp

    @if($txTotalsByCurrency->count() > 1 || $payoutTotalsByCurrency->count() > 1)
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 24px;">
        @if($txTotalsByCurrency->count() > 1)
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Total Transactions par devise</h2>
            </div>
            <div class="admin-card-body" style="padding-top: 0;">
                <div style="display: flex; flex-wrap: wrap; gap: 16px;">
                    @foreach($txTotalsByCurrency as $currency => $total)
                    <div style="background: var(--admin-bg-tertiary); padding: 12px 20px; border-radius: 8px; min-width: 120px;">
                        <div style="font-size: 12px; color: var(--admin-text-muted); text-transform: uppercase; margin-bottom: 4px;">{{ strtoupper($currency ?: '-') }}</div>
                        <div style="font-size: 18px; font-weight: 600; color: var(--admin-text);">{{ formatCurrency($total, $currency) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($payoutTotalsByCurrency->count() > 1)
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title">Total Payouts par devise</h2>
            </div>
            <div class="admin-card-body" style="padding-top: 0;">
                <div style="display: flex; flex-wrap: wrap; gap: 16px;">
                    @foreach($payoutTotalsByCurrency as $currency => $total)
                    <div style="background: var(--admin-bg-tertiary); padding: 12px 20px; border-radius: 8px; min-width: 120px;">
                        <div style="font-size: 12px; color: var(--admin-text-muted); text-transform: uppercase; margin-bottom: 4px;">{{ strtoupper($currency ?: '-') }}</div>
                        <div style="font-size: 18px; font-weight: 600; color: var(--admin-text);">{{ formatCurrency($total, $currency) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Charts -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px;">
        <!-- Revenue Chart -->
        <div class="admin-card">
            <div class="admin-card-body">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <h2 class="admin-card-title">Revenus — 30 jours</h2>
                    <a href="{{ route('admin.accounting.export', ['section' => 'revenue']) }}" class="btn btn-ghost btn-sm" style="color: var(--admin-primary);">
                        Exporter CSV
                    </a>
                </div>
                <div class="chart-area sm">
                    <canvas id="revenueChart" aria-label="Graphique des revenus" role="img"></canvas>
                </div>
            </div>
        </div>

        <!-- KYC Chart -->
        <div class="admin-card">
            <div class="admin-card-body">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <h2 class="admin-card-title">KYC vérifiés — 30 jours</h2>
                    <a href="{{ route('admin.accounting.export', ['section' => 'kyc']) }}" class="btn btn-ghost btn-sm" style="color: var(--admin-primary);">
                        Exporter CSV
                    </a>
                </div>
                <div class="chart-area sm">
                    <canvas id="kycChart" aria-label="Graphique KYC" role="img"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function(){
    const rev = @json(($revenueTrend ?? collect())->toArray());
    const kyc = @json(($kycTrend ?? collect())->toArray());
    const rlabels = Object.keys(rev), rdata = Object.values(rev);
    const klabels = Object.keys(kyc), kdata = Object.values(kyc);

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#9CA3AF', font: { size: 11 } }
            },
            y: {
                grid: { color: '#F3F4F6' },
                ticks: { color: '#9CA3AF', font: { size: 11 } }
            }
        }
    };

    const revenueCanvas = document.getElementById('revenueChart');
    const kycCanvas = document.getElementById('kycChart');

    if (revenueCanvas) {
        if (window._revenueChart) { try { window._revenueChart.destroy(); } catch(e){} }
        window._revenueChart = new Chart(revenueCanvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: rlabels,
                datasets: [{
                    label: 'Revenus',
                    data: rdata,
                    borderWidth: 2,
                    tension: 0.4,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 4
                }]
            },
            options: chartOptions
        });
    }

    if (kycCanvas) {
        if (window._kycChart) { try { window._kycChart.destroy(); } catch(e){} }
        window._kycChart = new Chart(kycCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: klabels,
                datasets: [{
                    label: 'KYC vérifiés',
                    data: kdata,
                    backgroundColor: '#10B981',
                    borderRadius: 4
                }]
            },
            options: chartOptions
        });
    }
})();
</script>
@endpush
@endsection
