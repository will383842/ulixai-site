@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
                <span class="mx-2">/</span>
                <span>Signalements</span>
            </nav>
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Signalements utilisateurs</h1>
        </div>
        <div class="flex gap-2">
            <select id="statusFilter" class="form-select text-sm" onchange="filterByStatus()">
                <option value="">Tous statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="investigating" {{ request('status') == 'investigating' ? 'selected' : '' }}>En investigation</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolus</option>
                <option value="dismissed" {{ request('status') == 'dismissed' ? 'selected' : '' }}>Rejetes</option>
            </select>
            <select id="priorityFilter" class="form-select text-sm" onchange="filterByPriority()">
                <option value="">Toutes priorites</option>
                <option value="critical" {{ request('priority') == 'critical' ? 'selected' : '' }}>Critique</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Basse</option>
            </select>
        </div>
    </div>

    @if($reports->isEmpty())
    <div class="admin-card p-12 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-green-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun signalement</h3>
        <p class="text-gray-500">Aucun signalement ne correspond aux criteres.</p>
    </div>
    @else
    <div class="admin-card overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contenu signale</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Signale par</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Raison</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Priorite</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($reports as $report)
                <tr class="hover:bg-gray-50 transition-colors" id="report-row-{{ $report->id }}">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                @if(str_contains($report->reportable_type, 'Mission'))
                                    <i class="fas fa-briefcase text-blue-500"></i>
                                @elseif(str_contains($report->reportable_type, 'User'))
                                    <i class="fas fa-user text-purple-500"></i>
                                @elseif(str_contains($report->reportable_type, 'Message'))
                                    <i class="fas fa-comment text-green-500"></i>
                                @else
                                    <i class="fas fa-file text-gray-500"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-900 truncate max-w-xs">
                                    {{ $report->reportable->title ?? $report->reportable->name ?? 'Contenu #'.$report->reportable_id }}
                                </div>
                                <div class="text-xs text-gray-500">{{ class_basename($report->reportable_type) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        @if($report->reporter)
                        <div class="flex items-center gap-2">
                            <img src="{{ $report->reporter->avatar_url ?? '/images/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <div class="text-sm font-medium">{{ $report->reporter->name }}</div>
                                <div class="text-xs text-gray-500">{{ $report->reporter->email }}</div>
                            </div>
                        </div>
                        @else
                        <span class="text-gray-400">Anonyme</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm font-medium text-gray-700">{{ $report->reason_label ?? $report->reason }}</div>
                        @if($report->description)
                        <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($report->description, 50) }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        @php
                            $priorityColors = [
                                'critical' => 'bg-red-100 text-red-700',
                                'high' => 'bg-orange-100 text-orange-700',
                                'medium' => 'bg-yellow-100 text-yellow-700',
                                'low' => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $priorityColors[$report->priority] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($report->priority ?? 'medium') }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'investigating' => 'bg-blue-100 text-blue-700',
                                'resolved' => 'bg-green-100 text-green-700',
                                'dismissed' => 'bg-gray-100 text-gray-700',
                            ];
                            $statusLabels = [
                                'pending' => 'En attente',
                                'investigating' => 'Investigation',
                                'resolved' => 'Resolu',
                                'dismissed' => 'Rejete',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$report->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$report->status] ?? ucfirst($report->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-500">
                        {{ $report->created_at->diffForHumans() }}
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.moderation.reports.show', $report) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Voir details">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($report->status === 'pending')
                            <button onclick="startInvestigation({{ $report->id }})" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Investiguer">
                                <i class="fas fa-search"></i>
                            </button>
                            @endif
                            @if(in_array($report->status, ['pending', 'investigating']))
                            <button onclick="showResolveModal({{ $report->id }})" class="p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Resoudre">
                                <i class="fas fa-check"></i>
                            </button>
                            <button onclick="dismissReport({{ $report->id }})" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Rejeter">
                                <i class="fas fa-times"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reports->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Resolve Modal -->
<div id="resolveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4">Resoudre le signalement</h3>
        <form id="resolveForm">
            <input type="hidden" id="resolveReportId">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Action a prendre</label>
                <select id="resolveAction" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selectionnez une action</option>
                    <option value="warn_user">Avertir l'utilisateur</option>
                    <option value="remove_content">Supprimer le contenu</option>
                    <option value="strike_user">Emettre un strike</option>
                    <option value="suspend_user">Suspendre l'utilisateur</option>
                    <option value="ban_user">Bannir l'utilisateur</option>
                    <option value="no_action">Aucune action necessaire</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes de resolution</label>
                <textarea id="resolveNotes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Decrivez les actions prises..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeResolveModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">Resoudre</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-select {
    padding: 0.5rem 2rem 0.5rem 0.75rem;
    border: 1px solid var(--admin-border);
    border-radius: 0.5rem;
    background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") right 0.5rem center/1.5em 1.5em no-repeat;
    appearance: none;
}
</style>

<script>
function filterByStatus() {
    updateFilters();
}

function filterByPriority() {
    updateFilters();
}

function updateFilters() {
    const status = document.getElementById('statusFilter').value;
    const priority = document.getElementById('priorityFilter').value;
    const url = new URL(window.location.href);

    if (status) url.searchParams.set('status', status);
    else url.searchParams.delete('status');

    if (priority) url.searchParams.set('priority', priority);
    else url.searchParams.delete('priority');

    window.location.href = url.toString();
}

function startInvestigation(reportId) {
    if (!confirm('Commencer l\'investigation de ce signalement ?')) return;

    fetch(`/admin/moderation/reports/${reportId}/investigate`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
            window.location.reload();
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

function showResolveModal(reportId) {
    document.getElementById('resolveReportId').value = reportId;
    document.getElementById('resolveAction').value = '';
    document.getElementById('resolveNotes').value = '';
    document.getElementById('resolveModal').classList.remove('hidden');
    document.getElementById('resolveModal').classList.add('flex');
}

function closeResolveModal() {
    document.getElementById('resolveModal').classList.add('hidden');
    document.getElementById('resolveModal').classList.remove('flex');
}

function dismissReport(reportId) {
    if (!confirm('Rejeter ce signalement ? Cette action indique que le signalement n\'est pas fonde.')) return;

    fetch(`/admin/moderation/reports/${reportId}/dismiss`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`report-row-${reportId}`).remove();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

document.getElementById('resolveForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const reportId = document.getElementById('resolveReportId').value;
    const action = document.getElementById('resolveAction').value;
    const notes = document.getElementById('resolveNotes').value;

    fetch(`/admin/moderation/reports/${reportId}/resolve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ action, notes })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`report-row-${reportId}`).remove();
            closeResolveModal();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('resolveModal').addEventListener('click', function(e) {
    if (e.target === this) closeResolveModal();
});
</script>
@endsection
