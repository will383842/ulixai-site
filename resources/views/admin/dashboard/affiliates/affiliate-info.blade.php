@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliationss') }}">Affiliés</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">{{ $affiliate->name }}</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">{{ $affiliate->name }}</h1>
        <p class="page-subtitle">Membre depuis {{ $affiliate->created_at->format('d/m/Y') }}</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Revenue Card -->
        <div class="admin-card p-6 bg-gradient-to-br from-purple-50 to-white border-purple-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-purple-700 font-medium text-sm">Revenus générés</div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-purple-800">{{ \App\Models\Currency::format($totalRevenue, $affiliate->preferred_currency ?? 'USD') }}</div>
        </div>

        <!-- Total Balance Given -->
        <div class="admin-card p-6 bg-gradient-to-br from-blue-50 to-white border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-blue-700 font-medium text-sm">Solde en attente</div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-blue-800">{{ \App\Models\Currency::format($affiliate->pending_affiliate_balance, $affiliate->preferred_currency ?? 'USD') }}</div>
        </div>

        <!-- Total Amount Paid -->
        <div class="admin-card p-6 bg-gradient-to-br from-green-50 to-white border-green-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-green-700 font-medium text-sm">Montant total payé</div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-green-800">{{ \App\Models\Currency::format($totalAmountPaid, $affiliate->preferred_currency ?? 'USD') }}</div>
        </div>
    </div>

    <!-- Referrals Table -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Parrainages ({{ $referrals->count() }})</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Date d'inscription</th>
                        <th>Total dépensé</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $referral)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-600">
                                        {{ strtoupper(substr($referral->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $referral->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $referral->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $referral->created_at->format('d/m/Y') }}
                        </td>
                        <td class="text-sm font-medium text-gray-900">
                            {{ \App\Models\Currency::format($referral->total_spent, $referral->preferred_currency ?? 'USD') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucun parrainage</p>
                            <p class="text-gray-400 text-xs mt-1">Les parrainages apparaîtront ici</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
