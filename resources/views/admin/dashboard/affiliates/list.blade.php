@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.dashboard') }}">Affiliation</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Liste des affilies</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="page-title">Liste des affilies</h1>
            <p class="page-subtitle">{{ $affiliates->total() }} affilies au total</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('admin.affiliates.export') }}" class="btn btn-outline text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Exporter CSV
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card mb-6">
        <form method="GET" action="{{ route('admin.affiliates.list') }}" class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nom, email, code..."
                           class="form-input w-full">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="form-select w-full">
                        <option value="">Tous</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs (solde > 0)</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs (solde = 0)</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                    <select name="sort_by" class="form-select w-full">
                        <option value="affiliate_balance" {{ request('sort_by', 'affiliate_balance') === 'affiliate_balance' ? 'selected' : '' }}>Revenus</option>
                        <option value="referrals_count" {{ request('sort_by') === 'referrals_count' ? 'selected' : '' }}>Nombre de filleuls</option>
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date d'inscription</option>
                        <option value="pending_affiliate_balance" {{ request('sort_by') === 'pending_affiliate_balance' ? 'selected' : '' }}>Solde en attente</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filtrer
                    </button>
                    <a href="{{ route('admin.affiliates.list') }}" class="btn btn-outline">
                        Reinitialiser
                    </a>
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
                        <th>Affilie</th>
                        <th>Code</th>
                        <th>Filleuls</th>
                        <th>Revenus totaux</th>
                        <th>Solde en attente</th>
                        <th>Verse</th>
                        <th>Statut</th>
                        <th>Inscrit le</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliates as $affiliate)
                    @php
                        $balance = $affiliate->affiliate_balance ?? 0;
                        $pending = $affiliate->pending_affiliate_balance ?? 0;
                        $paid = $balance - $pending;
                        $currency = $affiliate->preferred_currency ?? 'EUR';
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td>
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ strtoupper(substr($affiliate->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $affiliate->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $affiliate->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $affiliate->affiliate_code ?? 'N/A' }}</code>
                        </td>
                        <td>
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-900">{{ $affiliate->referrals_count }}</span>
                                <svg class="w-4 h-4 text-gray-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </td>
                        <td class="text-sm font-medium text-green-600">
                            {{ \App\Models\Currency::format($balance, $currency) }}
                        </td>
                        <td class="text-sm font-medium text-orange-600">
                            {{ \App\Models\Currency::format($pending, $currency) }}
                        </td>
                        <td class="text-sm text-gray-900">
                            {{ \App\Models\Currency::format($paid, $currency) }}
                        </td>
                        <td>
                            @if($pending > 0)
                                <span class="badge-warning">Paiement en attente</span>
                            @elseif($balance > 0)
                                <span class="badge-success">Actif</span>
                            @else
                                <span class="badge-default">Inactif</span>
                            @endif
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $affiliate->created_at->format('d/m/Y') }}
                        </td>
                        <td class="text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.affiliates.show', $affiliate->id) }}"
                                   class="btn btn-ghost text-blue-600 hover:bg-blue-50 text-xs p-2"
                                   title="Voir details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.users.manage', $affiliate->id) }}"
                                   class="btn btn-ghost text-gray-600 hover:bg-gray-100 text-xs p-2"
                                   title="Gerer utilisateur">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucun affilie trouve</p>
                            <p class="text-gray-400 text-xs mt-1">Modifiez vos filtres ou attendez de nouveaux affilies</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($affiliates->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $affiliates->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
