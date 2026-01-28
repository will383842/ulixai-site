@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.dashboard') }}">Affiliation</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.list') }}">Affilies</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">{{ $affiliate->name }}</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6">
        <div class="flex items-center">
            <div class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center mr-4">
                <span class="text-2xl font-bold text-white">
                    {{ strtoupper(substr($affiliate->name, 0, 1)) }}
                </span>
            </div>
            <div>
                <h1 class="page-title">{{ $affiliate->name }}</h1>
                <p class="text-gray-500">{{ $affiliate->email }}</p>
                <div class="flex items-center gap-2 mt-1">
                    <code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $affiliate->affiliate_code ?? 'N/A' }}</code>
                    <span class="text-gray-400">|</span>
                    <span class="text-sm text-gray-500">Membre depuis {{ $affiliate->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('admin.users.manage', $affiliate->id) }}" class="btn btn-outline text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profil utilisateur
            </a>
            <button onclick="openCreateCommissionModal()" class="btn btn-primary text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Ajouter commission
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Earnings -->
        <div class="admin-card p-6 bg-gradient-to-br from-green-50 to-white border-green-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-green-700 font-medium text-sm">Revenus totaux</div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-green-800">{{ \App\Models\Currency::format($stats['total_earnings'], $affiliate->preferred_currency ?? 'EUR') }}</div>
        </div>

        <!-- Pending Balance -->
        <div class="admin-card p-6 bg-gradient-to-br from-orange-50 to-white border-orange-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-orange-700 font-medium text-sm">Solde en attente</div>
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-orange-800">{{ \App\Models\Currency::format($stats['pending_balance'], $affiliate->preferred_currency ?? 'EUR') }}</div>
        </div>

        <!-- Total Paid -->
        <div class="admin-card p-6 bg-gradient-to-br from-blue-50 to-white border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-blue-700 font-medium text-sm">Total verse</div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-blue-800">{{ \App\Models\Currency::format($stats['paid_out'], $affiliate->preferred_currency ?? 'EUR') }}</div>
        </div>

        <!-- Referrals -->
        <div class="admin-card p-6 bg-gradient-to-br from-purple-50 to-white border-purple-200">
            <div class="flex items-center justify-between mb-3">
                <div class="text-purple-700 font-medium text-sm">Filleuls</div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-purple-800">{{ $stats['total_referrals'] }}</div>
            <div class="text-xs text-purple-600 mt-1">{{ $stats['active_referrals'] }} actifs ({{ $stats['conversion_rate'] }}%)</div>
        </div>
    </div>

    <!-- Commission Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="admin-card p-4 flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Commissions en attente</div>
                <div class="text-xl font-bold text-yellow-600">{{ $stats['commissions_pending'] }}</div>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="admin-card p-4 flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Commissions disponibles</div>
                <div class="text-xl font-bold text-blue-600">{{ $stats['commissions_available'] }}</div>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
        </div>
        <div class="admin-card p-4 flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Commissions payees</div>
                <div class="text-xl font-bold text-green-600">{{ $stats['commissions_paid'] }}</div>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Two Columns: Chart & Referrals -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Earnings Chart -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Evolution des revenus</h2>
                <p class="text-sm text-gray-500">12 derniers mois</p>
            </div>
            <div class="p-6">
                <canvas id="earningsChart" height="250"></canvas>
            </div>
        </div>

        <!-- Referrals List -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-gray-900">Filleuls ({{ $referrals->count() }})</h2>
                    <p class="text-sm text-gray-500">Utilisateurs parraines</p>
                </div>
            </div>
            <div class="overflow-x-auto max-h-80 overflow-y-auto">
                <table class="admin-table">
                    <thead class="sticky top-0 bg-white">
                        <tr>
                            <th>Filleul</th>
                            <th>Missions</th>
                            <th>Depense</th>
                            <th>Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($referrals as $referral)
                        <tr class="hover:bg-gray-50">
                            <td>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $referral->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $referral->created_at->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="text-sm text-gray-900">
                                {{ $referral->completed_missions_count ?? 0 }}
                            </td>
                            <td class="text-sm text-gray-900">
                                {{ \App\Models\Currency::format($referral->total_spent ?? 0, $referral->preferred_currency ?? 'EUR') }}
                            </td>
                            <td class="text-sm font-medium text-green-600">
                                {{ \App\Models\Currency::format($referral->commission_generated ?? 0, $affiliate->preferred_currency ?? 'EUR') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Aucun filleul
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Commissions Table -->
    <div class="admin-card mb-8">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-gray-900">Historique des commissions</h2>
                <p class="text-sm text-gray-500">Toutes les commissions de cet affilie</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filleul</th>
                        <th>Mission</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                    <tr class="hover:bg-gray-50">
                        <td class="text-sm text-gray-500">#{{ $commission->id }}</td>
                        <td>
                            <div class="text-sm font-medium text-gray-900">{{ $commission->referee->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $commission->referee->email ?? '' }}</div>
                        </td>
                        <td class="text-sm text-gray-900">
                            @if($commission->mission_id)
                                <a href="{{ route('admin.missions.show', $commission->mission_id) }}" class="text-blue-600 hover:underline">
                                    #{{ $commission->mission_id }}
                                </a>
                            @else
                                <span class="text-gray-400">Manuel</span>
                            @endif
                        </td>
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
                        <td class="text-sm text-gray-500">
                            {{ $commission->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-right">
                            <button onclick="openEditCommissionModal({{ $commission->id }}, '{{ $commission->status }}')"
                                    class="btn btn-ghost text-blue-600 hover:bg-blue-50 text-xs p-2"
                                    title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucune commission</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($commissions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $commissions->links() }}
        </div>
        @endif
    </div>

    <!-- Payouts History -->
    @if($payouts->count() > 0)
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Historique des paiements</h2>
            <p class="text-sm text-gray-500">Tous les virements effectues</p>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Methode</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Reference Stripe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payouts as $payout)
                    <tr class="hover:bg-gray-50">
                        <td class="text-sm text-gray-500">#{{ $payout->id }}</td>
                        <td class="text-sm font-medium text-gray-900">
                            {{ \App\Models\Currency::format($payout->amount, $payout->currency ?? 'EUR') }}
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $payout->bank_account_type === 'connected_account' ? 'Stripe Connect' : 'Virement IBAN' }}
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
                                <span class="badge-danger">Echoue</span>
                            @endif
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $payout->paid_at ? $payout->paid_at->format('d/m/Y H:i') : $payout->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-xs text-gray-400 font-mono">
                            {{ $payout->stripe_payout_id ?? $payout->stripe_transfer_id ?? 'N/A' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<!-- Edit Commission Modal -->
<div id="editCommissionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="editCommissionForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Modifier le statut de la commission</h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau statut</label>
                    <select name="status" id="editCommissionStatus" class="form-select w-full">
                        <option value="pending">En attente</option>
                        <option value="available">Disponible</option>
                        <option value="paid">Paye</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Raison (optionnel)</label>
                    <textarea name="reason" rows="3" class="form-textarea w-full" placeholder="Raison de la modification..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="closeEditCommissionModal()" class="btn btn-outline">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Create Commission Modal -->
<div id="createCommissionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form action="{{ route('admin.affiliates.commissions.create') }}" method="POST">
            @csrf
            <input type="hidden" name="referrer_id" value="{{ $affiliate->id }}">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Creer une commission manuelle</h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filleul *</label>
                    <select name="referee_id" class="form-select w-full" required>
                        <option value="">Selectionner un filleul</option>
                        @foreach($referrals as $referral)
                            <option value="{{ $referral->id }}">{{ $referral->name }} ({{ $referral->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                        <input type="number" name="amount" step="0.01" min="0.01" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Devise</label>
                        <select name="currency" class="form-select w-full">
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="form-select w-full">
                        <option value="available">Disponible</option>
                        <option value="pending">En attente</option>
                        <option value="paid">Paye</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Raison *</label>
                    <textarea name="reason" rows="3" class="form-textarea w-full" placeholder="Raison de l'ajustement..." required></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="closeCreateCommissionModal()" class="btn btn-outline">Annuler</button>
                <button type="submit" class="btn btn-primary">Creer</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Earnings Chart
    const earningsData = @json($monthlyEarnings);
    const labels = Object.keys(earningsData);
    const values = Object.values(earningsData);

    new Chart(document.getElementById('earningsChart'), {
        type: 'bar',
        data: {
            labels: labels.map(l => {
                const [year, month] = l.split('-');
                return new Date(year, month - 1).toLocaleDateString('fr-FR', { month: 'short', year: '2-digit' });
            }),
            datasets: [{
                label: 'Commissions (EUR)',
                data: values,
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderColor: '#10B981',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' EUR';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

function openEditCommissionModal(id, status) {
    document.getElementById('editCommissionForm').action = '/admin/affiliates/commissions/' + id;
    document.getElementById('editCommissionStatus').value = status;
    document.getElementById('editCommissionModal').classList.remove('hidden');
}

function closeEditCommissionModal() {
    document.getElementById('editCommissionModal').classList.add('hidden');
}

function openCreateCommissionModal() {
    document.getElementById('createCommissionModal').classList.remove('hidden');
}

function closeCreateCommissionModal() {
    document.getElementById('createCommissionModal').classList.add('hidden');
}

// Close modals on outside click
document.getElementById('editCommissionModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditCommissionModal();
});
document.getElementById('createCommissionModal').addEventListener('click', function(e) {
    if (e.target === this) closeCreateCommissionModal();
});
</script>
@endpush
@endsection
