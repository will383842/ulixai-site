@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.dashboard') }}">Affiliation</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Commissions</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="page-title">Gestion des commissions</h1>
            <p class="page-subtitle">Toutes les commissions d'affiliation</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('admin.affiliates.commissions.export', request()->query()) }}" class="btn btn-outline text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Exporter CSV
            </a>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-gray-900">{{ number_format($summaryStats['total_commissions']) }}</div>
            <div class="text-sm text-gray-500">Total commissions</div>
        </div>
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ \App\Models\Currency::format($summaryStats['total_amount'], 'EUR') }}</div>
            <div class="text-sm text-gray-500">Montant total</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-yellow-400">
            <div class="text-2xl font-bold text-yellow-600">{{ \App\Models\Currency::format($summaryStats['pending_amount'], 'EUR') }}</div>
            <div class="text-sm text-gray-500">En attente</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-blue-400">
            <div class="text-2xl font-bold text-blue-600">{{ \App\Models\Currency::format($summaryStats['available_amount'], 'EUR') }}</div>
            <div class="text-sm text-gray-500">Disponible</div>
        </div>
        <div class="admin-card p-4 text-center border-l-4 border-l-green-400">
            <div class="text-2xl font-bold text-green-600">{{ \App\Models\Currency::format($summaryStats['paid_amount'], 'EUR') }}</div>
            <div class="text-sm text-gray-500">Paye</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card mb-6">
        <form method="GET" action="{{ route('admin.affiliates.commissions') }}" class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nom, email..."
                           class="form-input w-full">
                </div>

                <!-- Affiliate Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Affilie</label>
                    <select name="affiliate_id" class="form-select w-full">
                        <option value="">Tous</option>
                        @foreach($affiliates as $affiliate)
                            <option value="{{ $affiliate->id }}" {{ request('affiliate_id') == $affiliate->id ? 'selected' : '' }}>
                                {{ $affiliate->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="form-select w-full">
                        <option value="">Tous</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paye</option>
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
                <div class="flex items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-1">Filtrer</button>
                    <a href="{{ route('admin.affiliates.commissions') }}" class="btn btn-outline">Reset</a>
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
                        <th>Affilie (parrain)</th>
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
                        <td class="text-sm text-gray-500 font-mono">#{{ $commission->id }}</td>
                        <td>
                            <a href="{{ route('admin.affiliates.show', $commission->referrer_id) }}" class="hover:text-blue-600">
                                <div class="text-sm font-medium text-gray-900">{{ $commission->referrer->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ $commission->referrer->email ?? '' }}</div>
                            </a>
                        </td>
                        <td>
                            <div class="text-sm font-medium text-gray-900">{{ $commission->referee->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $commission->referee->email ?? '' }}</div>
                        </td>
                        <td class="text-sm">
                            @if($commission->mission_id)
                                <a href="{{ route('admin.missions.show', $commission->mission_id) }}" class="text-blue-600 hover:underline">
                                    #{{ $commission->mission_id }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Manuel</span>
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
                            <div class="flex items-center justify-end gap-1">
                                <button onclick="openEditModal({{ $commission->id }}, '{{ $commission->status }}')"
                                        class="btn btn-ghost text-blue-600 hover:bg-blue-50 text-xs p-2"
                                        title="Modifier statut">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                @if($commission->status !== 'paid')
                                <form action="{{ route('admin.affiliates.commissions.delete', $commission->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Supprimer cette commission ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost text-red-600 hover:bg-red-50 text-xs p-2" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucune commission trouvee</p>
                            <p class="text-gray-400 text-xs mt-1">Modifiez vos filtres</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($commissions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $commissions->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Modifier le statut</h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau statut</label>
                    <select name="status" id="editStatus" class="form-select w-full">
                        <option value="pending">En attente</option>
                        <option value="available">Disponible</option>
                        <option value="paid">Paye</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Raison (optionnel)</label>
                    <textarea name="reason" rows="3" class="form-textarea w-full" placeholder="Raison de la modification..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="btn btn-outline">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditModal(id, status) {
    document.getElementById('editForm').action = '/admin/affiliates/commissions/' + id;
    document.getElementById('editStatus').value = status;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>
@endpush
@endsection
