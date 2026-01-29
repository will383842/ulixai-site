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
        <h1 class="page-title">Rapports & Feedbacks</h1>
        <p class="page-subtitle">Gérez les signalements et suggestions des utilisateurs</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                    <span class="text-yellow-600 text-lg">&#128027;</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Bugs</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['bugs'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600 text-lg">&#128161;</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Idées</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['suggestions'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                    <span class="text-purple-600 text-lg">&#10067;</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Questions</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['questions'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <span class="text-green-600 text-lg">&#10003;</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Résolus</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['resolved'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <!-- Filters & Tabs -->
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Tab Navigation -->
                <nav class="flex space-x-4 overflow-x-auto">
                    <button data-filter="all" class="filter-tab tab-button py-2 px-3 rounded-lg font-medium text-sm bg-blue-100 text-blue-700">
                        Tous
                        <span class="ml-1 text-xs">({{ count($AllBugReports) }})</span>
                    </button>
                    <button data-filter="pending" class="filter-tab tab-button py-2 px-3 rounded-lg font-medium text-sm text-gray-500 hover:bg-gray-100">
                        En attente
                    </button>
                    <button data-filter="resolved" class="filter-tab tab-button py-2 px-3 rounded-lg font-medium text-sm text-gray-500 hover:bg-gray-100">
                        Résolus
                    </button>
                </nav>

                <!-- Type Filter -->
                <div class="flex items-center gap-2">
                    <select id="type-filter" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Tous les types</option>
                        <option value="bug">Bug</option>
                        <option value="suggestion">Idée</option>
                        <option value="question">Question</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="w-16">Type</th>
                        <th>Description</th>
                        <th class="hidden md:table-cell">Page</th>
                        <th class="hidden lg:table-cell">Utilisateur</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="w-24">Actions</th>
                    </tr>
                </thead>
                <tbody id="reports-tbody">
                    @forelse($AllBugReports as $report)
                        <tr id="row-{{ $report->id }}"
                            class="report-row"
                            data-status="{{ $report->status ?? 'pending' }}"
                            data-type="{{ $report->report_type ?? 'bug' }}">
                            <td>
                                @php
                                    $typeConfig = match($report->report_type ?? 'bug') {
                                        'bug' => ['icon' => '&#128027;', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Bug'],
                                        'suggestion' => ['icon' => '&#128161;', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'label' => 'Idée'],
                                        'question' => ['icon' => '&#10067;', 'bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'label' => 'Question'],
                                        default => ['icon' => '&#128172;', 'bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => 'Autre'],
                                    };
                                @endphp
                                <div class="flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-lg {{ $typeConfig['bg'] }} flex items-center justify-center text-base">
                                        {!! $typeConfig['icon'] !!}
                                    </span>
                                    <span class="hidden sm:inline text-xs font-medium {{ $typeConfig['text'] }}">{{ $typeConfig['label'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="max-w-md">
                                    <p class="text-sm text-gray-900 line-clamp-2">{{ $report->bug_description ?: $report->suggestions ?: 'Aucune description' }}</p>
                                    @if($report->suggestions && $report->bug_description)
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                                            <span class="font-medium">Suggestion:</span> {{ $report->suggestions }}
                                        </p>
                                    @endif
                                </div>
                            </td>
                            <td class="hidden md:table-cell">
                                @if($report->page_url)
                                    <a href="{{ $report->page_url }}" target="_blank" class="text-xs text-blue-600 hover:underline truncate block max-w-32" title="{{ $report->page_url }}">
                                        {{ Str::limit(parse_url($report->page_url, PHP_URL_PATH) ?: '/', 25) }}
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                                @if($report->screen_size)
                                    <span class="text-xs text-gray-400 block">{{ $report->screen_size }}</span>
                                @endif
                            </td>
                            <td class="hidden lg:table-cell">
                                @if($report->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium text-gray-600">
                                            {{ strtoupper(substr($report->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $report->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $report->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Anonyme</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusConfig = match($report->status ?? 'pending') {
                                        'pending' => ['class' => 'bg-yellow-100 text-yellow-800', 'label' => 'En attente'],
                                        'in_progress' => ['class' => 'bg-blue-100 text-blue-800', 'label' => 'En cours'],
                                        'resolved' => ['class' => 'bg-green-100 text-green-800', 'label' => 'Résolu'],
                                        'dismissed' => ['class' => 'bg-gray-100 text-gray-800', 'label' => 'Rejeté'],
                                        default => ['class' => 'bg-gray-100 text-gray-800', 'label' => 'Inconnu'],
                                    };
                                @endphp
                                <span id="badge-{{ $report->id }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['class'] }}">
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">{{ $report->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $report->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-1">
                                    <!-- View Details -->
                                    <button type="button"
                                            class="view-details p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
                                            data-report='@json($report)'
                                            title="Voir les détails">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>

                                    <!-- Resolve -->
                                    @if(($report->status ?? 'pending') !== 'resolved')
                                        <button type="button"
                                                class="resolve-btn p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors"
                                                data-id="{{ $report->id }}"
                                                title="Marquer comme résolu">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Dismiss -->
                                    @if(($report->status ?? 'pending') !== 'dismissed')
                                        <button type="button"
                                                class="dismiss-btn p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors"
                                                data-id="{{ $report->id }}"
                                                title="Rejeter">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="no-reports">
                            <td colspan="7" class="text-center py-12">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-3xl">&#128077;</span>
                                </div>
                                <p class="text-gray-500 text-sm font-medium">Aucun rapport</p>
                                <p class="text-gray-400 text-xs mt-1">Les rapports des utilisateurs apparaîtront ici</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div id="details-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" id="modal-backdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Détails du rapport</h3>
                <button id="close-modal" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]" id="modal-content">
                <!-- Content will be injected here -->
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.report-row.hidden { display: none; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const typeFilter = document.getElementById('type-filter');
    const rows = document.querySelectorAll('.report-row');
    const modal = document.getElementById('details-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModal = document.getElementById('close-modal');
    const modalBackdrop = document.getElementById('modal-backdrop');

    let currentStatusFilter = 'all';
    let currentTypeFilter = '';

    // Filter function
    function applyFilters() {
        rows.forEach(row => {
            const status = row.dataset.status;
            const type = row.dataset.type;

            let showByStatus = currentStatusFilter === 'all' ||
                (currentStatusFilter === 'pending' && status !== 'resolved' && status !== 'dismissed') ||
                (currentStatusFilter === 'resolved' && (status === 'resolved' || status === 'dismissed'));

            let showByType = !currentTypeFilter || type === currentTypeFilter;

            row.classList.toggle('hidden', !(showByStatus && showByType));
        });
    }

    // Tab clicks
    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => t.classList.remove('bg-blue-100', 'text-blue-700'));
            filterTabs.forEach(t => t.classList.add('text-gray-500'));
            tab.classList.add('bg-blue-100', 'text-blue-700');
            tab.classList.remove('text-gray-500');

            currentStatusFilter = tab.dataset.filter;
            applyFilters();
        });
    });

    // Type filter
    typeFilter.addEventListener('change', () => {
        currentTypeFilter = typeFilter.value;
        applyFilters();
    });

    // View details
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', () => {
            const report = JSON.parse(btn.dataset.report);

            const typeLabels = { bug: 'Bug', suggestion: 'Idée', question: 'Question', other: 'Autre' };
            const statusLabels = { pending: 'En attente', in_progress: 'En cours', resolved: 'Résolu', dismissed: 'Rejeté' };

            modalContent.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                            ${typeLabels[report.report_type] || 'Bug'}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium ${report.status === 'resolved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                            ${statusLabels[report.status] || 'En attente'}
                        </span>
                    </div>

                    ${report.bug_description ? `
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Description</h4>
                            <p class="text-gray-900 whitespace-pre-wrap">${report.bug_description}</p>
                        </div>
                    ` : ''}

                    ${report.suggestions ? `
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Suggestion</h4>
                            <p class="text-gray-900 whitespace-pre-wrap">${report.suggestions}</p>
                        </div>
                    ` : ''}

                    ${report.page_url ? `
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Page</h4>
                            <a href="${report.page_url}" target="_blank" class="text-blue-600 hover:underline text-sm break-all">${report.page_url}</a>
                        </div>
                    ` : ''}

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 mb-1">Utilisateur</h4>
                            <p class="text-sm text-gray-900">${report.user ? report.user.name : 'Anonyme'}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 mb-1">Date</h4>
                            <p class="text-sm text-gray-900">${new Date(report.created_at).toLocaleDateString('fr-FR')} à ${new Date(report.created_at).toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit'})}</p>
                        </div>
                        ${report.screen_size ? `
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 mb-1">Écran</h4>
                                <p class="text-sm text-gray-900">${report.screen_size}</p>
                            </div>
                        ` : ''}
                        ${report.language ? `
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 mb-1">Langue</h4>
                                <p class="text-sm text-gray-900">${report.language}</p>
                            </div>
                        ` : ''}
                    </div>

                    ${report.user_agent ? `
                        <div class="pt-4 border-t border-gray-100">
                            <h4 class="text-xs font-medium text-gray-500 mb-1">User Agent</h4>
                            <p class="text-xs text-gray-600 break-all">${report.user_agent}</p>
                        </div>
                    ` : ''}
                </div>
            `;

            modal.classList.remove('hidden');
        });
    });

    // Close modal
    function hideModal() {
        modal.classList.add('hidden');
    }

    closeModal.addEventListener('click', hideModal);
    modalBackdrop.addEventListener('click', hideModal);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') hideModal();
    });

    // Resolve/Dismiss actions
    document.querySelectorAll('.resolve-btn').forEach(btn => {
        btn.addEventListener('click', () => updateStatus(btn.dataset.id, 'resolved'));
    });

    document.querySelectorAll('.dismiss-btn').forEach(btn => {
        btn.addEventListener('click', () => updateStatus(btn.dataset.id, 'dismissed'));
    });

    async function updateStatus(id, status) {
        try {
            const response = await fetch(`/admin/bug-reports/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            });

            if (response.ok) {
                const row = document.getElementById(`row-${id}`);
                const badge = document.getElementById(`badge-${id}`);

                row.dataset.status = status;

                if (status === 'resolved') {
                    badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
                    badge.textContent = 'Résolu';
                } else if (status === 'dismissed') {
                    badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800';
                    badge.textContent = 'Rejeté';
                }

                // Remove action buttons
                row.querySelectorAll('.resolve-btn, .dismiss-btn').forEach(b => b.remove());

                // Reapply filters
                applyFilters();

                // Show toast
                if (typeof toastr !== 'undefined') {
                    toastr.success('Statut mis à jour');
                }
            }
        } catch (error) {
            console.error('Error updating status:', error);
            if (typeof toastr !== 'undefined') {
                toastr.error('Erreur lors de la mise à jour');
            }
        }
    }
});
</script>
@endsection
