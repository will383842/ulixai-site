@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Programme d'affiliation</span>
    </nav>

    <!-- Header with Actions -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="page-title">Programme d'affiliation</h1>
            <p class="page-subtitle">Pilotage et suivi complet de votre programme d'affiliation</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('admin.affiliates.export') }}" class="btn btn-outline text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Exporter
            </a>
            <a href="{{ route('admin.affiliates.commissions') }}" class="btn btn-primary text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Gestion commissions
            </a>
        </div>
    </div>

    <!-- KPIs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Affiliates -->
        <div class="admin-card p-6 bg-gradient-to-br from-blue-50 to-white border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-blue-700 font-medium text-sm">Total Affilies</div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-blue-800">{{ number_format($stats['total_affiliates']) }}</div>
            <div class="text-xs text-blue-600 mt-1">
                <span class="text-green-600 font-medium">{{ $stats['active_affiliates'] }}</span> actifs
            </div>
        </div>

        <!-- Total Referrals -->
        <div class="admin-card p-6 bg-gradient-to-br from-purple-50 to-white border-purple-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-purple-700 font-medium text-sm">Total Filleuls</div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-purple-800">{{ number_format($stats['total_referrals']) }}</div>
            <div class="text-xs text-purple-600 mt-1">
                +{{ $stats['new_referrals_period'] }} cette periode
            </div>
        </div>

        <!-- Total Commissions -->
        <div class="admin-card p-6 bg-gradient-to-br from-green-50 to-white border-green-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-green-700 font-medium text-sm">Commissions Totales</div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-green-800">{{ \App\Models\Currency::format($stats['total_commissions_amount'], 'EUR') }}</div>
            <div class="text-xs text-green-600 mt-1">
                {{ \App\Models\Currency::format($stats['period_commissions_amount'], 'EUR') }} cette periode
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="admin-card p-6 bg-gradient-to-br from-orange-50 to-white border-orange-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-orange-700 font-medium text-sm">Taux de Conversion</div>
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-orange-800">{{ $stats['conversion_rate'] }}%</div>
            <div class="text-xs text-orange-600 mt-1">
                Moy. {{ \App\Models\Currency::format($stats['avg_commission_per_referral'], 'EUR') }}/filleul
            </div>
        </div>
    </div>

    <!-- Financial Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="admin-card p-6 border-l-4 border-l-yellow-400">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Commissions en attente</div>
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Currency::format($stats['pending_commissions'], 'EUR') }}</div>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-l-blue-400">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Disponible pour retrait</div>
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Currency::format($stats['available_commissions'], 'EUR') }}</div>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card p-6 border-l-4 border-l-green-400">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Total verse</div>
                    <div class="text-2xl font-bold text-gray-900">{{ \App\Models\Currency::format($stats['paid_commissions'], 'EUR') }}</div>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Trends Chart -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Evolution mensuelle</h2>
                <p class="text-sm text-gray-500">Filleuls et commissions sur 12 mois</p>
            </div>
            <div class="p-6">
                <canvas id="monthlyTrendsChart" height="300"></canvas>
            </div>
        </div>

        <!-- Commission Status Breakdown -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Repartition des commissions</h2>
                <p class="text-sm text-gray-500">Par statut</p>
            </div>
            <div class="p-6">
                <canvas id="commissionStatusChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Two Column Layout: Top Affiliates & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Top Affiliates -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-gray-900">Top 10 Affilies</h2>
                    <p class="text-sm text-gray-500">Par revenus generes</p>
                </div>
                <a href="{{ route('admin.affiliates.list') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Voir tout
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Affilie</th>
                            <th>Filleuls</th>
                            <th class="text-right">Revenus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topAffiliates as $index => $affiliate)
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('admin.affiliates.show', $affiliate->id) }}'">
                            <td class="text-gray-500 font-medium">{{ $index + 1 }}</td>
                            <td>
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-xs font-medium text-blue-700">
                                            {{ strtoupper(substr($affiliate->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $affiliate->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $affiliate->affiliate_code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-sm text-gray-900">{{ $affiliate->referrals_count }}</td>
                            <td class="text-right text-sm font-medium text-green-600">
                                {{ \App\Models\Currency::format($affiliate->affiliate_balance ?? 0, $affiliate->preferred_currency ?? 'EUR') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Aucun affilie pour le moment
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Commissions -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-gray-900">Commissions recentes</h2>
                    <p class="text-sm text-gray-500">Dernieres transactions</p>
                </div>
                <a href="{{ route('admin.affiliates.commissions') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Voir tout
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Affilie</th>
                            <th>Filleul</th>
                            <th>Montant</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentCommissions as $commission)
                        <tr class="hover:bg-gray-50">
                            <td class="text-sm text-gray-900">{{ $commission->referrer->name ?? 'N/A' }}</td>
                            <td class="text-sm text-gray-500">{{ $commission->referee->name ?? 'N/A' }}</td>
                            <td class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Currency::format($commission->amount, $commission->currency ?? 'EUR') }}
                            </td>
                            <td>
                                @if($commission->status === 'pending')
                                    <span class="badge-warning">En attente</span>
                                @elseif($commission->status === 'available')
                                    <span class="badge-info">Disponible</span>
                                @elseif($commission->status === 'paid')
                                    <span class="badge-success">Paye</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Aucune commission recente
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pending Payouts Alert -->
    @if($pendingPayouts->count() > 0)
    <div class="admin-card border-l-4 border-l-orange-400 mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Paiements en attente</h3>
                    <p class="text-sm text-gray-500">{{ $pendingPayouts->count() }} affilies attendent un paiement</p>
                </div>
            </div>
            <a href="{{ route('admin.affiliates.payouts') }}" class="btn btn-warning text-sm">
                Gerer les paiements
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Affilie</th>
                        <th>Email</th>
                        <th class="text-right">Montant en attente</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingPayouts->take(5) as $affiliate)
                    <tr>
                        <td class="font-medium text-gray-900">{{ $affiliate->name }}</td>
                        <td class="text-sm text-gray-500">{{ $affiliate->email }}</td>
                        <td class="text-right font-medium text-orange-600">
                            {{ \App\Models\Currency::format($affiliate->pending_affiliate_balance, $affiliate->preferred_currency ?? 'EUR') }}
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.affiliates.show', $affiliate->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Quick Navigation -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.affiliates.list') }}" class="admin-card p-4 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <div class="font-medium text-gray-900">Liste des affilies</div>
                <div class="text-sm text-gray-500">Gerer tous les affilies</div>
            </div>
        </a>

        <a href="{{ route('admin.affiliates.commissions') }}" class="admin-card p-4 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 bg-green-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <div class="font-medium text-gray-900">Commissions</div>
                <div class="text-sm text-gray-500">Gerer les commissions</div>
            </div>
        </a>

        <a href="{{ route('admin.affiliates.payouts') }}" class="admin-card p-4 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <div class="font-medium text-gray-900">Paiements</div>
                <div class="text-sm text-gray-500">Historique des paiements</div>
            </div>
        </a>

        <a href="{{ route('admin.affiliates.export') }}" class="admin-card p-4 hover:shadow-md transition-shadow flex items-center">
            <div class="p-3 bg-gray-100 rounded-lg mr-4">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <div class="font-medium text-gray-900">Exporter</div>
                <div class="text-sm text-gray-500">Telecharger les donnees</div>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Trends Chart
    const trendsData = @json($monthlyTrends);
    const labels = Object.values(trendsData).map(t => t.label);
    const referralsData = Object.values(trendsData).map(t => t.new_referrals);
    const commissionsData = Object.values(trendsData).map(t => t.commissions_generated);

    new Chart(document.getElementById('monthlyTrendsChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Nouveaux filleuls',
                    data: referralsData,
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                },
                {
                    label: 'Commissions (EUR)',
                    data: commissionsData,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Filleuls'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Commissions (EUR)'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Commission Status Chart
    new Chart(document.getElementById('commissionStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['En attente', 'Disponible', 'Paye'],
            datasets: [{
                data: [
                    {{ $stats['pending_commissions'] }},
                    {{ $stats['available_commissions'] }},
                    {{ $stats['paid_commissions'] }}
                ],
                backgroundColor: [
                    '#F59E0B',
                    '#3B82F6',
                    '#10B981'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '60%'
        }
    });
});
</script>
@endpush
@endsection
