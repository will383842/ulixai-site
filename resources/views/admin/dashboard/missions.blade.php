@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Missions</span>
    </nav>

    <!-- Header Section -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Missions</h1>
            <p class="page-subtitle">Gérez et suivez toutes les missions de la plateforme</p>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--admin-text-muted);">
            <span style="width: 8px; height: 8px; background: var(--admin-success); border-radius: 50%; animation: pulse 2s infinite;"></span>
            <span>En direct</span>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="admin-card" style="margin-bottom: 24px;">
        <div class="admin-card-body">
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
                <div style="display: flex; flex-wrap: wrap; gap: 12px; flex: 1;">
                    <!-- Search Input -->
                    <div style="position: relative; flex: 1; max-width: 320px;">
                        <div style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                            <svg width="16" height="16" fill="none" stroke="var(--admin-text-light)" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="missionSearch" class="form-input" style="padding-left: 40px;" placeholder="Rechercher une mission...">
                    </div>

                    <!-- Status Filter -->
                    <select id="missionStatus" class="form-input" style="width: auto; min-width: 160px;">
                        <option value="">Tous les statuts</option>
                        <option value="published">Publié</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                </div>

                <!-- Quick Stats Legend -->
                <div style="display: flex; align-items: center; gap: 16px; font-size: 12px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span style="width: 8px; height: 8px; background: var(--admin-success); border-radius: 50%;"></span>
                        <span style="color: var(--admin-text-secondary);">Terminé</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span style="width: 8px; height: 8px; background: var(--admin-warning); border-radius: 50%;"></span>
                        <span style="color: var(--admin-text-secondary);">En cours</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span style="width: 8px; height: 8px; background: var(--admin-primary); border-radius: 50%;"></span>
                        <span style="color: var(--admin-text-secondary);">Publié</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div id="missionsTableWrapper">
        <div class="admin-card">
            <div class="admin-table-responsive">
                <table class="admin-table admin-table-mobile" id="missionsTable">
                    <thead>
                        <tr>
                            <th>Mission</th>
                            <th>Demandeur</th>
                            <th>Prestataire</th>
                            <th>Statut</th>
                            <th>Créée le</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="missionsTableBody">
                        <!-- AJAX content -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div id="missionsPagination" style="padding: 16px 24px; border-top: 1px solid var(--admin-border-light); display: flex; align-items: center; justify-content: center; gap: 4px;">
                <!-- Pagination buttons will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="hidden admin-card">
        <div class="admin-loading">
            <div class="admin-spinner"></div>
            <span class="admin-loading-text">Chargement des missions...</span>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>

@push('scripts')
<script>
function showLoading() {
    document.getElementById('missionsTableWrapper').classList.add('hidden');
    document.getElementById('loadingState').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingState').classList.add('hidden');
    document.getElementById('missionsTableWrapper').classList.remove('hidden');
}

function fetchMissions(page = 1) {
    showLoading();

    const search = document.getElementById('missionSearch').value;
    const status = document.getElementById('missionStatus').value;

    let url = `/api/admin/missions?page=${page}`;
    if (search) url += `&search=${encodeURIComponent(search)}`;
    if (status) url += `&status=${encodeURIComponent(status)}`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('missionsTableBody');
            tbody.innerHTML = '';

            if (data.missions.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="admin-empty-title">Aucune mission trouvée</p>
                                <p class="admin-empty-description">Essayez de modifier vos critères de recherche</p>
                            </div>
                        </td>
                    </tr>
                `;
            } else {
                data.missions.forEach(m => {
                    const statusConfig = {
                        'completed': { class: 'badge badge-success', label: 'Terminé' },
                        'in_progress': { class: 'badge badge-warning', label: 'En cours' },
                        'published': { class: 'badge badge-primary', label: 'Publié' },
                        'pending': { class: 'badge badge-info', label: 'En attente' },
                        'cancelled': { class: 'badge badge-default', label: 'Annulé' }
                    };

                    const config = statusConfig[m.status] || statusConfig['cancelled'];

                    tbody.innerHTML += `
                        <tr>
                            <td data-label="Mission">
                                <div style="font-weight: 500; color: var(--admin-text);">${m.title || '(Sans titre)'}</div>
                                <div style="font-size: 12px; color: var(--admin-text-muted);">#${m.id}</div>
                            </td>
                            <td data-label="Demandeur">
                                <span style="color: var(--admin-text-secondary);">${m.requester?.name || '-'}</span>
                            </td>
                            <td data-label="Prestataire">
                                ${m.selected_provider_id ?
                                    `<span style="color: var(--admin-text-secondary);">${m.selected_provider?.first_name || ''} ${m.selected_provider?.last_name || ''}</span>` :
                                    '<span style="color: var(--admin-text-light);">Non assigné</span>'
                                }
                            </td>
                            <td data-label="Statut">
                                <span class="${config.class}">${config.label}</span>
                            </td>
                            <td data-label="Créée le">
                                <div style="font-size: 14px;">${(new Date(m.created_at)).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}</div>
                            </td>
                            <td data-label="Actions">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                    <a href="/admin/missions/${m.id}" class="btn btn-ghost btn-sm" style="color: var(--admin-primary);" data-admin-tooltip="Voir">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="deleteMission(${m.id})" class="btn btn-ghost btn-sm" style="color: var(--admin-danger);" data-admin-tooltip="Supprimer">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            // Pagination
            const pag = data.pagination;
            let pagHtml = '';

            if (pag.last_page > 1) {
                if (pag.current_page > 1) {
                    pagHtml += `<button onclick="fetchMissions(${pag.current_page - 1})" class="btn btn-ghost btn-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>`;
                }

                const startPage = Math.max(1, pag.current_page - 2);
                const endPage = Math.min(pag.last_page, pag.current_page + 2);

                if (startPage > 1) {
                    pagHtml += `<button onclick="fetchMissions(1)" class="btn btn-ghost btn-sm">1</button>`;
                    if (startPage > 2) pagHtml += `<span style="padding: 0 8px; color: var(--admin-text-light);">...</span>`;
                }

                for (let i = startPage; i <= endPage; i++) {
                    pagHtml += `<button onclick="fetchMissions(${i})" class="btn ${i === pag.current_page ? 'btn-primary' : 'btn-ghost'} btn-sm">${i}</button>`;
                }

                if (endPage < pag.last_page) {
                    if (endPage < pag.last_page - 1) pagHtml += `<span style="padding: 0 8px; color: var(--admin-text-light);">...</span>`;
                    pagHtml += `<button onclick="fetchMissions(${pag.last_page})" class="btn btn-ghost btn-sm">${pag.last_page}</button>`;
                }

                if (pag.current_page < pag.last_page) {
                    pagHtml += `<button onclick="fetchMissions(${pag.current_page + 1})" class="btn btn-ghost btn-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>`;
                }
            }

            document.getElementById('missionsPagination').innerHTML = pagHtml;
            hideLoading();
        })
        .catch(error => {
            console.error('Error fetching missions:', error);
            hideLoading();

            document.getElementById('missionsTableBody').innerHTML = `
                <tr>
                    <td colspan="6">
                        <div class="admin-empty-state">
                            <svg class="admin-empty-icon" fill="none" stroke="var(--admin-danger)" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="admin-empty-title">Échec du chargement</p>
                            <button onclick="fetchMissions()" class="btn btn-primary btn-sm" style="margin-top: 12px;">Réessayer</button>
                        </div>
                    </td>
                </tr>
            `;
        });
}

let searchTimeout;
document.getElementById('missionSearch').addEventListener('input', () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => fetchMissions(), 300);
});

document.getElementById('missionStatus').addEventListener('change', () => fetchMissions());

function deleteMission(missionId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette mission ? Cette action est irréversible.')) {
        fetch(`/admin/missions/${missionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success('Mission supprimée avec succès');
                fetchMissions();
            } else {
                toastr.error(data.message || 'Échec de la suppression');
            }
        })
        .catch(() => toastr.error('Échec de la suppression'));
    }
}

document.addEventListener('DOMContentLoaded', () => fetchMissions());
</script>
@endpush
@endsection
