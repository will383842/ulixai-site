@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.dashboard') }}">Affiliation</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Paiements</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="page-title">Historique des paiements</h1>
            <p class="page-subtitle">Tous les versements aux affilies</p>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-gray-900">{{ number_format($summaryStats['total_payouts']) }}</div>
            <div class="text-sm text-gray-500">Total paiements</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-green-400">
            <div class="text-2xl font-bold text-green-600">{{ \App\Models\Currency::format($summaryStats['total_paid'], 'EUR') }}</div>
            <div class="text-sm text-gray-500">Total verse</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-yellow-400">
            <div class="text-2xl font-bold text-yellow-600">{{ $summaryStats['pending_payouts'] }}</div>
            <div class="text-sm text-gray-500">En cours</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-red-400">
            <div class="text-2xl font-bold text-red-600">{{ $summaryStats['failed_payouts'] }}</div>
            <div class="text-sm text-gray-500">Echoues</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card mb-6">
        <form method="GET" action="{{ route('admin.affiliates.payouts') }}" class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="form-select w-full">
                        <option value="">Tous</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>En cours</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paye</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Echoue</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date debut</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-input w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date fin</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-input w-full">
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-2 md:col-span-2">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('admin.affiliates.payouts') }}" class="btn btn-outline">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="admin-card">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Beneficiaire</th>
                        <th>Montant</th>
                        <th>Methode</th>
                        <th>Statut</th>
                        <th>Date demande</th>
                        <th>Date paiement</th>
                        <th>Reference Stripe</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    <tr class="hover:bg-gray-50">
                        <td class="text-sm text-gray-500 font-mono">#{{ $payout->id }}</td>
                        <td>
                            @if($payout->user)
                            <a href="{{ route('admin.affiliates.show', $payout->user_id) }}" class="hover:text-blue-600">
                                <div class="text-sm font-medium text-gray-900">{{ $payout->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $payout->user->email }}</div>
                            </a>
                            @else
                            <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="text-sm font-bold text-gray-900">
                            {{ \App\Models\Currency::format($payout->amount, $payout->currency ?? 'EUR') }}
                        </td>
                        <td class="text-sm text-gray-500">
                            @if($payout->bank_account_type === 'connected_account')
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-purple-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Stripe Connect
                                </div>
                            @else
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Virement IBAN
                                </div>
                            @endif
                            @if($payout->bank_account_last4)
                                <span class="text-xs text-gray-400">(****{{ $payout->bank_account_last4 }})</span>
                            @endif
                        </td>
                        <td>
                            @if($payout->status === 'processing')
                                <span class="badge-warning">En cours</span>
                            @elseif($payout->status === 'paid')
                                <span class="badge-success">Paye</span>
                            @elseif($payout->status === 'failed')
                                <span class="badge-danger" title="{{ $payout->failure_reason }}">Echoue</span>
                            @endif
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $payout->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $payout->paid_at ? $payout->paid_at->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="text-xs text-gray-400 font-mono max-w-xs truncate" title="{{ $payout->stripe_payout_id ?? $payout->stripe_transfer_id ?? 'N/A' }}">
                            {{ $payout->stripe_payout_id ?? $payout->stripe_transfer_id ?? 'N/A' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucun paiement trouve</p>
                            <p class="text-gray-400 text-xs mt-1">Les paiements apparaitront ici</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($payouts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $payouts->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
