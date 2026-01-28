@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Utilisateurs</span>
    </nav>

    <!-- Header Section -->
    <div class="page-header" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 16px;">
        <div>
            <h1 class="page-title">Gestion des utilisateurs</h1>
            <p class="page-subtitle">Gérez tous les utilisateurs et leurs permissions</p>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('admin.w-map-view') }}" class="btn btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                Carte mondiale
            </a>
            @if(session('admin_id'))
            <form method="POST" action="{{ route('admin.restore-admin') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                    Retour Admin
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Users Card -->
    <div class="admin-card">
        <!-- Filters & Stats -->
        <div class="admin-card-header" style="flex-wrap: wrap; gap: 16px;">
            <div class="admin-tabs" style="margin-bottom: 0; border-bottom: none;">
                <button class="admin-tab active user-filter-btn" data-role="all">Tous</button>
                <button class="admin-tab user-filter-btn" data-role="service_provider">Prestataires</button>
                <button class="admin-tab user-filter-btn" data-role="service_requester">Demandeurs</button>
            </div>
            <div style="font-size: 14px; color: var(--admin-text-muted);">
                Total: <span id="userCount" style="font-weight: 600; color: var(--admin-text);">{{ $users->total() }}</span> utilisateurs
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="admin-table-responsive">
            <table class="admin-table admin-table-mobile">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Inscription</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td data-label="Utilisateur">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="admin-avatar admin-avatar-md" style="background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark)); color: white;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div style="min-width: 0;">
                                    <div style="font-weight: 500; color: var(--admin-text);">{{ $user->name }}</div>
                                    <div style="font-size: 12px; color: var(--admin-text-muted);">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Rôle">
                            @if($user->user_role == 'admin')
                                <span class="badge badge-info">Admin</span>
                            @elseif($user->user_role == 'service_provider')
                                <span class="badge badge-primary">Prestataire</span>
                            @else
                                <span class="badge badge-default">{{ ucfirst(str_replace('_', ' ', $user->user_role)) }}</span>
                            @endif
                        </td>
                        <td data-label="Statut">
                            @if($user->status == 'active')
                                <span class="badge badge-success">Actif</span>
                            @else
                                <span class="badge badge-danger">{{ ucfirst($user->status) }}</span>
                            @endif
                        </td>
                        <td data-label="Inscription">
                            <div style="font-size: 14px; color: var(--admin-text);">{{ $user->created_at->format('d M Y') }}</div>
                            <div style="font-size: 12px; color: var(--admin-text-muted);">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                        <td data-label="Actions">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <form method="POST" action="{{ route('admin.secret-login', $user->id) }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--admin-primary);" data-admin-tooltip="Se connecter en tant que">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.users.manage', $user->id) }}" class="btn btn-ghost btn-sm" style="color: var(--admin-text-secondary);" data-admin-tooltip="Gérer">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                @php
                                    $provider = \App\Models\ServiceProvider::where('user_id', $user->id)->first();
                                @endphp
                                @if($provider)
                                <button type="button"
                                    class="btn btn-ghost btn-sm"
                                    style="color: {{ $provider->pinned ? 'var(--admin-warning)' : 'var(--admin-text-light)' }};"
                                    data-admin-tooltip="{{ $provider->pinned ? 'Désépingler' : 'Épingler' }}"
                                    onclick="togglePinProvider({{ $provider->id }}, this)">
                                    <svg width="16" height="16" fill="{{ $provider->pinned ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                                <p class="admin-empty-title">Aucun utilisateur</p>
                                <p class="admin-empty-description">Aucun utilisateur enregistré.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div style="margin-top: 24px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
        <div style="font-size: 14px; color: var(--admin-text-muted);">
            Affichage de <span style="font-weight: 500; color: var(--admin-text);">{{ $users->firstItem() }}</span> à <span style="font-weight: 500; color: var(--admin-text);">{{ $users->lastItem() }}</span> sur <span style="font-weight: 500; color: var(--admin-text);">{{ $users->total() }}</span> résultats
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.user-filter-btn');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const role = this.getAttribute('data-role');

            // Update button styles
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            filterUserRows(role);
        });
    });

    function filterUserRows(role) {
        const rows = document.querySelectorAll('tbody tr');
        let count = 0;
        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty state row
            const roleSpan = row.querySelector('td:nth-child(2) span');
            const userRole = roleSpan?.textContent?.trim().toLowerCase() || '';

            if (role === 'all') {
                row.style.display = '';
                count++;
            } else if (role === 'service_provider' && userRole.includes('prestataire')) {
                row.style.display = '';
                count++;
            } else if (role === 'service_requester' && (userRole.includes('requester') || userRole.includes('demandeur'))) {
                row.style.display = '';
                count++;
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('userCount').textContent = count;
    }
});

function togglePinProvider(providerId, btn) {
    btn.disabled = true;
    fetch('/api/admin/provider/' + providerId + '/toggle-pin', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            if (data.pinned) {
                btn.classList.add('text-yellow-600', 'bg-yellow-50');
                btn.classList.remove('text-gray-400');
                btn.title = 'Désépingler';
                btn.querySelector('svg').setAttribute('fill', 'currentColor');
            } else {
                btn.classList.remove('text-yellow-600', 'bg-yellow-50');
                btn.classList.add('text-gray-400');
                btn.title = 'Épingler';
                btn.querySelector('svg').setAttribute('fill', 'none');
            }
        } else {
            alert('Échec de la mise à jour');
        }
    })
    .catch(() => alert('Échec de la mise à jour'))
    .finally(() => { btn.disabled = false; });
}
</script>
@endpush
@endsection
