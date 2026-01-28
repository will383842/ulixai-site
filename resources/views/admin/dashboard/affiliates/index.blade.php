@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Affiliés</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Programme d'affiliation</h1>
        <p class="page-subtitle">Suivez et gérez les performances de votre programme d'affiliation</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Revenue Card -->
        <div class="admin-card p-6 bg-gradient-to-br from-green-50 to-white border-green-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-green-700 font-medium text-sm">Revenus via affiliés</div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-green-800">{{ \App\Models\Currency::format($total, 'USD') }}</div>
            <div class="text-xs text-green-600 mt-1">USD</div>
        </div>

        <!-- Balance Given Card -->
        <div class="admin-card p-6 bg-gradient-to-br from-blue-50 to-white border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-blue-700 font-medium text-sm">Total solde distribué</div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-blue-800">{{ \App\Models\Currency::format($totalData, 'USD') }}</div>
            <div class="text-xs text-blue-600 mt-1">USD</div>
        </div>

        <!-- Amount to be Paid Card -->
        <div class="admin-card p-6 bg-gradient-to-br from-orange-50 to-white border-orange-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-orange-700 font-medium text-sm">Montant à payer</div>
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-orange-800">{{ \App\Models\Currency::format($totalAmountToPaid, 'USD') }}</div>
            <div class="text-xs text-orange-600 mt-1">USD</div>
        </div>
    </div>

    <!-- Affiliates Table -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Tous les affiliés</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $affiliates->count() }} affiliés au total</p>
        </div>

        <div class="overflow-x-auto">
            @if($affiliates->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Affilié</th>
                            <th>Parrainé par</th>
                            <th>Solde</th>
                            <th>Statut</th>
                            <th>Date d'inscription</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($affiliates as $affiliate)
                        @php
                            $referrer = $affiliate->referrer;
                            $balance  = (float) ($affiliate->pending_affiliate_balance ?? 0);
                            $href     = route('admin.affiliates.details', ['id' => $affiliate->id]);
                            $initial  = function($name){ return strtoupper(mb_substr($name ?? 'U', 0, 1, 'UTF-8')); };
                        @endphp

                        <tr class="cursor-pointer hover:bg-gray-50" onclick="window.location='{{ $href }}'">
                            <td>
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-700">
                                            {{ $initial($affiliate->name) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $affiliate->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $affiliate->email ?? 'Pas d\'email' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($referrer)
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-xs font-medium text-green-700">
                                                {{ $initial($referrer->name) }}
                                            </span>
                                        </div>
                                        <div class="ml-3 text-sm text-gray-900">
                                            {{ trim(($referrer->name ?? '').' '.($referrer->last_name ?? '')) ?: 'Inconnu' }}
                                        </div>
                                    </div>
                                @else
                                    <span class="badge-default">Direct</span>
                                @endif
                            </td>

                            <td>
                                @php
                                    $affiliateCurrency = $affiliate->preferred_currency ?? 'USD';
                                @endphp
                                <div class="text-sm font-medium text-gray-900">{{ \App\Models\Currency::format($balance, $affiliateCurrency) }}</div>
                                @if($balance > 0)
                                    <div class="text-xs text-green-600">Paiement en attente</div>
                                @else
                                    <div class="text-xs text-gray-500">Aucun solde</div>
                                @endif
                            </td>

                            <td>
                                @if($balance > 0)
                                    <span class="badge-warning">En attente</span>
                                @else
                                    <span class="badge-success">Actif</span>
                                @endif
                            </td>

                            <td class="text-sm text-gray-900">
                                {{ optional($affiliate->created_at)->format('d/m/Y') ?? '-' }}
                            </td>

                            <td class="text-right">
                                <a href="{{ $href }}" class="btn btn-ghost text-blue-600 hover:bg-blue-50 text-xs">
                                    Voir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm font-medium">Aucun affilié</p>
                    <p class="text-gray-400 text-xs mt-1">Les affiliés apparaîtront ici une fois inscrits</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
