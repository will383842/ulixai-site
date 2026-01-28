@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Dashboard Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Vue d'ensemble de la plateforme Ulixai</p>
        </div>
        <div class="admin-card" style="padding: 12px 16px; display: none;" data-show-md>
            <span style="font-size: 12px; color: var(--admin-text-muted);">Dernière mise à jour</span>
            <div style="font-size: 14px; font-weight: 500; color: var(--admin-text);">{{ now()->format('d M Y, H:i') }}</div>
        </div>
    </div>

    <!-- Primary Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</div>
                    <div class="text-xs text-gray-500 mt-1">+{{ $newUsersLastMonth ?? 0 }} ce mois</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Utilisateurs totaux</div>
        </div>

        <!-- Service Providers -->
        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($totalProviders) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Prestataires actifs</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Prestataires</div>
        </div>

        <!-- Service Requesters -->
        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-purple-100 rounded-xl">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($totalRequesters) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Demandeurs actifs</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Demandeurs</div>
        </div>
    </div>

    <!-- Stripe Wallet Section -->
    <div class="admin-card p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">Portefeuille Stripe</h2>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span>Données en direct</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-blue-700">Solde disponible</span>
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-blue-800">{{ number_format($stripeBalance['available'], 2) }}</div>
                <div class="text-xs text-blue-600 mt-1">{{ strtoupper($stripeBalance['currency']) }}</div>
            </div>

            <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-yellow-700">Solde en attente</span>
                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-2xl font-bold text-yellow-800">{{ number_format($stripeBalance['pending'], 2) }}</div>
                <div class="text-xs text-yellow-600 mt-1">{{ strtoupper($stripeBalance['currency']) }}</div>
            </div>

            <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-green-700">Revenus totaux</span>
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                @if(count($totalRevenueByCurrency) > 0)
                    @foreach($totalRevenueByCurrency as $currency => $total)
                        <div class="text-2xl font-bold text-green-800">{{ \App\Models\Currency::format($total, $currency) }}</div>
                    @endforeach
                @else
                    <div class="text-2xl font-bold text-green-800">0,00 {{ \App\Models\Currency::getSymbol('EUR') }}</div>
                @endif
            </div>

            <div class="p-4 bg-red-50 rounded-xl border border-red-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-red-700">Paiements en attente</span>
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                @if(count($totalPendingPayoutsByCurrency) > 0)
                    @foreach($totalPendingPayoutsByCurrency as $currency => $total)
                        <div class="text-2xl font-bold text-red-800">{{ \App\Models\Currency::format($total, $currency) }}</div>
                    @endforeach
                @else
                    <div class="text-2xl font-bold text-red-800">0,00 {{ \App\Models\Currency::getSymbol('EUR') }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">KYC en attente</div>
                    <div class="text-2xl font-bold text-orange-600">{{ number_format($pendingKycProviders) }}</div>
                </div>
                <div class="p-3 bg-orange-100 rounded-xl">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Transactions en attente</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ number_format($pendingTransactions) }}</div>
                </div>
                <div class="p-3 bg-yellow-100 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Missions récentes</div>
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($recentMissions->count()) }}</div>
                </div>
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users & Providers -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Users -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-semibold text-gray-900">Utilisateurs récents</h3>
                <a href="{{ route('admin.users')}}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</a>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @foreach($recentUsers as $user)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email ?? 'User' }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Providers -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-semibold text-gray-900">Prestataires récents</h3>
                <a href="{{ route('admin.users')}}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</a>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @foreach($recentProviders as $provider)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                                {{ strtoupper(substr($provider->first_name, 0, 1) . substr($provider->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $provider->first_name }} {{ $provider->last_name }}</div>
                                <div class="text-xs text-gray-500">Prestataire</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">{{ $provider->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="admin-card mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Transactions récentes</h3>
            <a href="{{ route('admin.transactions') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $txn)
                    <tr>
                        <td>
                            <span class="font-mono text-sm">#{{ $txn->id }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 text-xs font-medium">
                                    {{ $txn->provider->first_name ? strtoupper(substr($txn->provider->first_name, 0, 1)) : '?' }}
                                </div>
                                <span class="font-medium">{{ $txn->provider->first_name ?? 'Inconnu' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="font-semibold">{{ $txn->formatted_amount }}</span>
                        </td>
                        <td>
                            @if($txn->status == 'completed')
                                <span class="badge-success">Complété</span>
                            @elseif($txn->status == 'pending')
                                <span class="badge-warning">En attente</span>
                            @else
                                <span class="badge-default">{{ ucfirst($txn->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-sm">{{ $txn->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $txn->created_at->format('H:i') }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-8">Aucune transaction</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Missions -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Missions récentes</h3>
            <a href="{{ route('admin.missions') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Voir tout</a>
        </div>
        <div class="p-4">
            <div class="space-y-3">
                @forelse($recentMissions as $mission)
                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">{{ $mission->title ?? 'Mission #' . $mission->id }}</div>
                            <div class="text-xs text-gray-500">Mission active</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">{{ $mission->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">Aucune mission récente</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
