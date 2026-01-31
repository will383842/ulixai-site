@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
                <span class="mx-2">/</span>
                <span>Appels</span>
            </nav>
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Appels des utilisateurs</h1>
        </div>
        <div class="flex gap-2">
            <select id="statusFilter" class="form-select text-sm" onchange="filterByStatus()">
                <option value="">Tous statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>En cours</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approuves</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejetes</option>
            </select>
        </div>
    </div>

    @if($appeals->isEmpty())
    <div class="admin-card p-12 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-green-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun appel</h3>
        <p class="text-gray-500">Aucun appel ne correspond aux criteres.</p>
    </div>
    @else
    <div class="admin-card overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Utilisateur</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Type de sanction</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Raison de l'appel</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($appeals as $appeal)
                <tr class="hover:bg-gray-50 transition-colors" id="appeal-row-{{ $appeal->id }}">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $appeal->user->avatar_url ?? '/images/default-avatar.png' }}" class="w-10 h-10 rounded-full" alt="">
                            <div>
                                <div class="font-medium text-gray-900">{{ $appeal->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $appeal->user->email }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs {{ $appeal->user->trust_score >= 50 ? 'text-green-600' : 'text-red-600' }}">
                                        Score: {{ $appeal->user->trust_score }}
                                    </span>
                                    @if($appeal->user->strike_count > 0)
                                    <span class="text-xs text-orange-600">
                                        {{ $appeal->user->strike_count }} strike(s)
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        @php
                            $actionLabels = [
                                'strike' => 'Strike',
                                'suspension' => 'Suspension',
                                'ban' => 'Bannissement',
                                'content_removal' => 'Suppression contenu',
                            ];
                            $actionColors = [
                                'strike' => 'bg-orange-100 text-orange-700',
                                'suspension' => 'bg-red-100 text-red-700',
                                'ban' => 'bg-red-200 text-red-800',
                                'content_removal' => 'bg-gray-100 text-gray-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $actionColors[$appeal->action_type] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $actionLabels[$appeal->action_type] ?? ucfirst($appeal->action_type) }}
                        </span>
                        @if($appeal->moderationAction)
                        <div class="text-xs text-gray-500 mt-1">
                            Action #{{ $appeal->moderationAction->id }}
                        </div>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-700 max-w-xs">
                            {{ Str::limit($appeal->reason, 100) }}
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'under_review' => 'bg-blue-100 text-blue-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ];
                            $statusLabels = [
                                'pending' => 'En attente',
                                'under_review' => 'En cours',
                                'approved' => 'Approuve',
                                'rejected' => 'Rejete',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$appeal->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$appeal->status] ?? ucfirst($appeal->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-500">
                        {{ $appeal->created_at->diffForHumans() }}
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.moderation.appeals.show', $appeal) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Voir details">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($appeal->status === 'pending')
                            <button onclick="startReview({{ $appeal->id }})" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Commencer revision">
                                <i class="fas fa-search"></i>
                            </button>
                            @endif
                            @if(in_array($appeal->status, ['pending', 'under_review']))
                            <button onclick="showApproveModal({{ $appeal->id }})" class="p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Approuver">
                                <i class="fas fa-check"></i>
                            </button>
                            <button onclick="showRejectModal({{ $appeal->id }})" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Rejeter">
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
        {{ $appeals->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4 text-green-600">
            <i class="fas fa-check-circle mr-2"></i>Approuver l'appel
        </h3>
        <form id="approveForm">
            <input type="hidden" id="approveAppealId">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-green-700">
                    <strong>Attention:</strong> Approuver cet appel annulera la sanction et restaurera le compte/contenu de l'utilisateur.
                </p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Raison de l'approbation</label>
                <textarea id="approveNotes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500" required placeholder="Expliquez pourquoi l'appel est accepte..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeApproveModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">Approuver l'appel</button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4 text-red-600">
            <i class="fas fa-times-circle mr-2"></i>Rejeter l'appel
        </h3>
        <form id="rejectForm">
            <input type="hidden" id="rejectAppealId">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-red-700">
                    <strong>Attention:</strong> Rejeter cet appel maintiendra la sanction en place. L'utilisateur sera notifie.
                </p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Raison du rejet</label>
                <textarea id="rejectNotes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500" required placeholder="Expliquez pourquoi l'appel est rejete..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Rejeter l'appel</button>
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
    const status = document.getElementById('statusFilter').value;
    const url = new URL(window.location.href);
    if (status) url.searchParams.set('status', status);
    else url.searchParams.delete('status');
    window.location.href = url.toString();
}

function startReview(appealId) {
    fetch(`/admin/moderation/appeals/${appealId}/start-review`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.href = `/admin/moderation/appeals/${appealId}`;
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

function showApproveModal(appealId) {
    document.getElementById('approveAppealId').value = appealId;
    document.getElementById('approveNotes').value = '';
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveModal').classList.remove('flex');
}

function showRejectModal(appealId) {
    document.getElementById('rejectAppealId').value = appealId;
    document.getElementById('rejectNotes').value = '';
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
}

document.getElementById('approveForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const appealId = document.getElementById('approveAppealId').value;
    const notes = document.getElementById('approveNotes').value;

    fetch(`/admin/moderation/appeals/${appealId}/approve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notes })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`appeal-row-${appealId}`).remove();
            closeApproveModal();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('rejectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const appealId = document.getElementById('rejectAppealId').value;
    const notes = document.getElementById('rejectNotes').value;

    fetch(`/admin/moderation/appeals/${appealId}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notes })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`appeal-row-${appealId}`).remove();
            closeRejectModal();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

// Close modals on outside click
document.getElementById('approveModal').addEventListener('click', function(e) {
    if (e.target === this) closeApproveModal();
});
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endsection
