@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Pays</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion des pays</h1>
        <p class="page-subtitle">Activez ou désactivez les pays disponibles sur la plateforme</p>
    </div>

    <!-- Search -->
    <div class="admin-card p-4 mb-6">
        <form action="{{ route('admin.countries.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 max-w-md">
                <label class="block text-xs font-medium text-gray-500 mb-1">Recherche</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Rechercher par nom ou code..."
                           class="form-input pl-10">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                Rechercher
            </button>
            @if($search)
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                    Effacer
                </a>
            @endif
        </form>
    </div>

    @if($search)
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-6">
            <p class="text-sm">{{ $countries->total() }} résultat(s) pour "{{ $search }}"</p>
        </div>
    @endif

    <!-- Table -->
    <div class="admin-card">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pays</th>
                        <th>Code</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr>
                        <td>
                            <div class="text-sm font-medium text-gray-900">{{ $country->country }}</div>
                        </td>
                        <td>
                            <div class="text-sm text-gray-500 font-mono">{{ $country->short_name }}</div>
                        </td>
                        <td>
                            <span class="{{ $country->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $country->status ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <button onclick="toggleCountryStatus({{ $country->id }}, this)"
                                class="btn btn-ghost {{ $country->status ? 'text-red-600 hover:bg-red-50' : 'text-green-600 hover:bg-green-50' }} text-xs">
                                {{ $country->status ? 'Désactiver' : 'Activer' }}
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $countries->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleCountryStatus(countryId, button) {
    fetch(`/admin/countries/${countryId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const isActive = data.status;
            const statusSpan = button.closest('tr').querySelector('span[class*="badge"]');
            const toggleButton = button;

            // Update status badge
            statusSpan.className = isActive ? 'badge-success' : 'badge-danger';
            statusSpan.textContent = isActive ? 'Actif' : 'Inactif';

            // Update button
            toggleButton.className = `btn btn-ghost ${isActive ? 'text-red-600 hover:bg-red-50' : 'text-green-600 hover:bg-green-50'} text-xs`;
            toggleButton.textContent = isActive ? 'Désactiver' : 'Activer';

            toastr.success(isActive ? 'Pays activé' : 'Pays désactivé');
        }
    })
    .catch(() => {
        toastr.error('Erreur lors de la mise à jour');
    });
}
</script>
@endpush
@endsection
