@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Messages</span>
    </nav>

    <!-- Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Messages reçus</h1>
            <p class="page-subtitle">Gérez tous les messages entrants de la plateforme</p>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--admin-text-muted);">
            <span style="width: 8px; height: 8px; background: var(--admin-success); border-radius: 50%; animation: pulse 2s infinite;"></span>
            <span>En direct</span>
        </div>
    </div>

    <!-- Tabs -->
    <div class="admin-card p-4 mb-6">
        <div class="flex flex-wrap gap-2" id="tabs">
            <button data-type="all" class="btn btn-primary">Général</button>
            <button data-type="press" class="btn btn-ghost">Presse</button>
            <button data-type="reportbug" class="btn btn-ghost">Bug</button>
            <button data-type="partner" class="btn btn-ghost">Partenaire</button>
            <button data-type="recruitment" class="btn btn-ghost">Recrutement</button>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card p-4 mb-6">
        <div class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Statut</label>
                <select id="filterStatus" class="form-input">
                    <option value="all">Tous les statuts</option>
                    <option value="unread">Non lus</option>
                    <option value="read">Lus</option>
                    <option value="unprocessed">À traiter</option>
                    <option value="processed">Traités</option>
                </select>
            </div>
            <div class="flex-1 max-w-xs">
                <label class="block text-xs font-medium text-gray-500 mb-1">Recherche</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Rechercher..." id="search" class="form-input pl-10">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Trier par</label>
                <select id="sort" class="form-input">
                    <option value="created_at">Date</option>
                    <option value="name">Nom</option>
                    <option value="email">Email</option>
                    <option value="native_status">Statut natif</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Ordre</label>
                <select id="direction" class="form-input">
                    <option value="desc">Décroissant</option>
                    <option value="asc">Croissant</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-center">Lu</th>
                        <th class="text-center">Traité</th>
                    </tr>
                </thead>
                <tbody id="rows">
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-500 border-t-transparent mx-auto mb-3"></div>
                            <span class="text-gray-500 text-sm">Chargement...</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="pager" class="px-6 py-4 border-t border-gray-100 flex items-center justify-center gap-2" hidden>
            <button class="btn btn-ghost" id="prev">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <span id="pageLabel" class="text-sm text-gray-600 px-3">1 / 1</span>
            <button class="btn btn-ghost" id="next">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
(() => {
    const state = {
        type: 'all',
        status: 'all',
        search: '',
        sort: 'created_at',
        direction: 'desc',
        page: 1,
        per_page: 20,
        total_pages: 1
    };

    const rowsEl = document.getElementById('rows');
    const pager = document.getElementById('pager');
    const pageLabel = document.getElementById('pageLabel');

    function qs(id) { return document.getElementById(id); }
    function csrf() { return document.querySelector('meta[name="csrf-token"]').content; }

    function bindFilters() {
        qs('filterStatus').onchange = () => { state.status = qs('filterStatus').value; state.page = 1; fetchList(); };
        qs('sort').onchange = () => { state.sort = qs('sort').value; state.page = 1; fetchList(); };
        qs('direction').onchange = () => { state.direction = qs('direction').value; state.page = 1; fetchList(); };

        let t;
        qs('search').oninput = () => {
            clearTimeout(t);
            t = setTimeout(() => { state.search = qs('search').value; state.page = 1; fetchList(); }, 300);
        };

        document.getElementById('tabs').querySelectorAll('button').forEach(btn => {
            btn.onclick = () => {
                document.getElementById('tabs').querySelectorAll('button').forEach(b => {
                    b.className = 'btn btn-ghost';
                });
                btn.className = 'btn btn-primary';
                state.type = btn.getAttribute('data-type');
                state.page = 1;
                fetchList();
            };
        });

        qs('prev').onclick = () => { if (state.page > 1) { state.page--; fetchList(); } };
        qs('next').onclick = () => { if (state.page < state.total_pages) { state.page++; fetchList(); } };
    }

    function fetchList() {
        rowsEl.innerHTML = `<tr><td colspan="8" class="text-center py-12">
            <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-500 border-t-transparent mx-auto mb-3"></div>
            <span class="text-gray-500 text-sm">Chargement...</span>
        </td></tr>`;

        const params = new URLSearchParams({
            type: state.type,
            status: state.status,
            search: state.search,
            sort: state.sort,
            direction: state.direction,
            page: state.page,
            per_page: state.per_page
        });

        fetch('{{ route('admin.messages.list') }}?' + params.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(renderList)
        .catch(() => {
            rowsEl.innerHTML = `<tr><td colspan="8" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-red-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 text-sm">Erreur de chargement</p>
                <button onclick="fetchList()" class="mt-2 text-blue-600 hover:text-blue-700 text-sm font-medium">Réessayer</button>
            </td></tr>`;
        });
    }

    function renderList(res) {
        const data = res.data || [];
        const pag = res.pagination || { total: 0, page: 1, pages: 1 };
        state.total_pages = pag.pages;
        pageLabel.textContent = pag.page + ' / ' + pag.pages;
        pager.hidden = !(pag.pages > 1);

        if (!data.length) {
            rowsEl.innerHTML = `<tr><td colspan="8" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500 text-sm font-medium">Aucun message</p>
            </td></tr>`;
            return;
        }

        const label = {
            press: 'Presse',
            reportbug: 'Bug',
            partner: 'Partenaire',
            recruitment: 'Recrutement',
            all: 'Général'
        };

        const badgeClass = {
            press: 'badge-info',
            reportbug: 'badge-warning',
            partner: 'badge-primary',
            recruitment: 'badge-success',
            all: 'badge-default'
        };

        rowsEl.innerHTML = data.map(row => `
            <tr>
                <td><span class="${badgeClass[row.type] || 'badge-default'}">${label[row.type] || row.type}</span></td>
                <td class="font-medium text-gray-900">${escapeHtml(row.name || '—')}</td>
                <td>${row.email ? `<a href="mailto:${encodeURIComponent(row.email)}" class="text-blue-600 hover:text-blue-700">${escapeHtml(row.email)}</a>` : '—'}</td>
                <td class="max-w-xs truncate text-gray-600" title="${escapeHtml(row.message || '')}">${escapeHtml((row.message || '').slice(0, 80))}${(row.message || '').length > 80 ? '…' : ''}</td>
                <td><span class="text-xs text-gray-500">${escapeHtml(row.native_status || '—')}</span></td>
                <td class="text-sm text-gray-500">${new Date(row.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}</td>
                <td class="text-center">
                    <input type="checkbox" ${row.is_read ? 'checked' : ''} onchange="toggleStatus('${row.type}', ${row.id}, 'is_read', this.checked)" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td class="text-center">
                    <input type="checkbox" ${row.is_processed ? 'checked' : ''} onchange="toggleStatus('${row.type}', ${row.id}, 'is_processed', this.checked)" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                </td>
            </tr>
        `).join('');
    }

    window.toggleStatus = function(type, id, field, value) {
        const fd = new FormData();
        fd.append('type', type);
        fd.append('id', id);
        if (field === 'is_read') fd.append('is_read', value ? 1 : 0);
        if (field === 'is_processed') fd.append('is_processed', value ? 1 : 0);

        fetch('{{ route('admin.messages.read') }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf() },
            body: fd
        }).catch(() => {});
    };

    function escapeHtml(str) {
        return String(str).replace(/[&<>"']/g, s => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[s]));
    }

    bindFilters();
    fetchList();
})();
</script>
@endpush
@endsection
