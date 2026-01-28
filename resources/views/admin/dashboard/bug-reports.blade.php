@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Bug Reports</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Rapports de bugs</h1>
        <p class="page-subtitle">Gérez les signalements de bugs des utilisateurs</p>
    </div>

    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <!-- Tab Navigation -->
            <nav class="flex space-x-6">
                <button id="all-tab" class="tab-button py-2 px-1 border-b-2 border-blue-600 font-medium text-sm text-blue-600">
                    Tous les rapports
                    <span id="all-count" class="ml-2 bg-blue-100 text-blue-800 py-1 px-2 rounded-full text-xs">{{ count($AllBugReports) }}</span>
                </button>
                <button id="resolved-tab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Rapports résolus
                    <span id="resolved-count" class="ml-2 bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">0</span>
                </button>
            </nav>
        </div>

        <!-- All Reports Section -->
        <div id="all-reports" class="tab-content">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Rapporteur</th>
                            <th>Suggestions</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($AllBugReports as $report)
                            <tr id="row-{{ $report->id }}" class="unresolved-row">
                                <td>
                                    <div class="text-sm font-medium text-gray-900">{{ $report->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->created_at->format('H:i') }}</div>
                                </td>
                                <td>
                                    <div class="text-sm text-gray-900 max-w-xs truncate">{{ $report->bug_description }}</div>
                                </td>
                                <td class="text-sm text-gray-900">{{ $report->user->name ?? 'Anonyme' }}</td>
                                <td>
                                    <div class="text-sm text-gray-500 max-w-xs truncate">{{ $report->suggestions ?? 'Aucune suggestion' }}</div>
                                </td>
                                <td class="text-sm text-gray-900">{{ $report->language }}</td>
                                <td>
                                    <span id="badge-{{ $report->id }}" class="badge-warning">Non résolu</span>
                                </td>
                                <td class="text-sm text-gray-900">{{ $report->country }}</td>
                                <td>
                                    <button data-id="{{ $report->id }}"
                                            class="toggle-status btn btn-ghost text-green-600 hover:bg-green-50 text-xs">
                                        Résoudre
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr id="no-reports-all">
                                <td colspan="8" class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm font-medium">Aucun rapport de bug</p>
                                    <p class="text-gray-400 text-xs mt-1">Les rapports apparaîtront ici</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Resolved Reports Section -->
        <div id="resolved-reports" class="tab-content hidden">
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Rapporteur</th>
                            <th>Suggestions</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Pays</th>
                            <th>Résolu le</th>
                        </tr>
                    </thead>
                    <tbody id="resolved-table-body">
                        <tr id="no-resolved-reports">
                            <td colspan="8" class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm font-medium">Aucun rapport résolu</p>
                                <p class="text-gray-400 text-xs mt-1">Les rapports résolus apparaîtront ici</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let resolvedCount = 0;

    const allTab = document.getElementById('all-tab');
    const resolvedTab = document.getElementById('resolved-tab');
    const allReports = document.getElementById('all-reports');
    const resolvedReports = document.getElementById('resolved-reports');

    allTab.addEventListener('click', () => {
        allTab.className = 'tab-button py-2 px-1 border-b-2 border-blue-600 font-medium text-sm text-blue-600';
        resolvedTab.className = 'tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300';
        allReports.classList.remove('hidden');
        resolvedReports.classList.add('hidden');
    });

    resolvedTab.addEventListener('click', () => {
        resolvedTab.className = 'tab-button py-2 px-1 border-b-2 border-blue-600 font-medium text-sm text-blue-600';
        allTab.className = 'tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300';
        resolvedReports.classList.remove('hidden');
        allReports.classList.add('hidden');
    });

    document.querySelectorAll('.toggle-status').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const badge = document.getElementById(`badge-${id}`);
            const row = document.getElementById(`row-${id}`);

            if (badge.textContent.trim() === 'Non résolu') {
                badge.textContent = 'Résolu';
                badge.className = 'badge-success';
                btn.textContent = 'Résolu';
                btn.className = 'btn btn-ghost text-gray-400 text-xs cursor-not-allowed';
                btn.disabled = true;

                const clonedRow = row.cloneNode(true);
                clonedRow.id = `resolved-${id}`;
                clonedRow.classList.remove('unresolved-row');
                clonedRow.classList.add('resolved-row');

                const cells = clonedRow.querySelectorAll('td');
                cells[7].innerHTML = `
                    <div class="text-sm font-medium text-gray-900">${new Date().toLocaleDateString('fr-FR')}</div>
                    <div class="text-xs text-gray-500">${new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</div>
                `;

                const resolvedTableBody = document.getElementById('resolved-table-body');
                const noResolvedReports = document.getElementById('no-resolved-reports');

                if (noResolvedReports) {
                    noResolvedReports.remove();
                }

                resolvedTableBody.appendChild(clonedRow);

                resolvedCount++;
                document.getElementById('resolved-count').textContent = resolvedCount;
            }
        });
    });
});
</script>
@endsection