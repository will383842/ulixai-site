@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
                <span class="mx-2">/</span>
                <span>Contenus a verifier</span>
            </nav>
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Contenus en attente de verification</h1>
        </div>
        <div class="flex gap-2">
            <select id="typeFilter" class="form-select text-sm" onchange="filterByType()">
                <option value="">Tous les types</option>
                <option value="auto_blocked" {{ request('type') == 'auto_blocked' ? 'selected' : '' }}>Bloques automatiquement</option>
                <option value="auto_review" {{ request('type') == 'auto_review' ? 'selected' : '' }}>En attente de review</option>
            </select>
            <select id="severityFilter" class="form-select text-sm" onchange="filterBySeverity()">
                <option value="">Toutes severites</option>
                <option value="critical" {{ request('severity') == 'critical' ? 'selected' : '' }}>Critique</option>
                <option value="warning" {{ request('severity') == 'warning' ? 'selected' : '' }}>Avertissement</option>
                <option value="info" {{ request('severity') == 'info' ? 'selected' : '' }}>Info</option>
            </select>
        </div>
    </div>

    @if($flags->isEmpty())
    <div class="admin-card p-12 text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-green-500 text-2xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun contenu en attente</h3>
        <p class="text-gray-500">Tous les contenus ont ete verifies.</p>
    </div>
    @else
    <div class="admin-card overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Contenu</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Auteur</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Score</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Severite</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Problemes</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($flags as $flag)
                <tr class="hover:bg-gray-50 transition-colors" id="flag-row-{{ $flag->id }}">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                @if(str_contains($flag->flaggable_type, 'Mission'))
                                    <i class="fas fa-briefcase text-blue-500"></i>
                                @elseif(str_contains($flag->flaggable_type, 'Offer'))
                                    <i class="fas fa-hand-holding-usd text-green-500"></i>
                                @else
                                    <i class="fas fa-comment text-purple-500"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-900 truncate max-w-xs">
                                    {{ $flag->flaggable->title ?? $flag->flaggable->subject ?? 'Contenu #'.$flag->flaggable_id }}
                                </div>
                                <div class="text-xs text-gray-500">{{ class_basename($flag->flaggable_type) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        @if($flag->user)
                        <a href="{{ route('admin.moderation.users.history', $flag->user) }}" class="flex items-center gap-2 hover:text-blue-600">
                            <img src="{{ $flag->user->avatar_url ?? '/images/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <div class="text-sm font-medium">{{ $flag->user->name }}</div>
                                <div class="text-xs text-gray-500">Score: {{ $flag->user->trust_score }}</div>
                            </div>
                        </a>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full
                            {{ $flag->score >= 70 ? 'bg-red-100 text-red-700' : ($flag->score >= 30 ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700') }}">
                            <span class="font-bold">{{ $flag->score }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center">
                        @php
                            $severityColors = [
                                'critical' => 'bg-red-100 text-red-700',
                                'warning' => 'bg-orange-100 text-orange-700',
                                'info' => 'bg-blue-100 text-blue-700',
                            ];
                            $typeColors = [
                                'auto_blocked' => 'bg-red-500 text-white',
                                'auto_review' => 'bg-yellow-500 text-white',
                            ];
                        @endphp
                        <div class="flex flex-col gap-1 items-center">
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $typeColors[$flag->flag_type] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $flag->flag_type === 'auto_blocked' ? 'BLOQUE' : 'REVIEW' }}
                            </span>
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $severityColors[$flag->severity] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($flag->severity) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex flex-wrap gap-1">
                            @if($flag->has_contact_info)
                                <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded text-xs">Contact</span>
                            @endif
                            @if($flag->is_spam)
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-xs">Spam</span>
                            @endif
                            @if(!empty($flag->matched_words))
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded text-xs">{{ count($flag->matched_words) }} mot(s)</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-500">
                        {{ $flag->created_at->diffForHumans() }}
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.moderation.flags.show', $flag) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Voir details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button onclick="approveFlag({{ $flag->id }})" class="p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Approuver">
                                <i class="fas fa-check"></i>
                            </button>
                            <button onclick="showRejectModal({{ $flag->id }})" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Rejeter">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $flags->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4">Rejeter le contenu</h3>
        <form id="rejectForm">
            <input type="hidden" id="rejectFlagId">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Raison du rejet</label>
                <textarea id="rejectReason" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Expliquez pourquoi ce contenu est rejete..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Rejeter</button>
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
function filterByType() {
    const type = document.getElementById('typeFilter').value;
    const url = new URL(window.location.href);
    if (type) {
        url.searchParams.set('type', type);
    } else {
        url.searchParams.delete('type');
    }
    window.location.href = url.toString();
}

function filterBySeverity() {
    const severity = document.getElementById('severityFilter').value;
    const url = new URL(window.location.href);
    if (severity) {
        url.searchParams.set('severity', severity);
    } else {
        url.searchParams.delete('severity');
    }
    window.location.href = url.toString();
}

function approveFlag(flagId) {
    if (!confirm('Approuver ce contenu ?')) return;

    fetch(`/admin/moderation/flags/${flagId}/approve`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notes: '' })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`flag-row-${flagId}`).remove();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

function showRejectModal(flagId) {
    document.getElementById('rejectFlagId').value = flagId;
    document.getElementById('rejectReason').value = '';
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
}

document.getElementById('rejectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const flagId = document.getElementById('rejectFlagId').value;
    const reason = document.getElementById('rejectReason').value;

    fetch(`/admin/moderation/flags/${flagId}/reject`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ reason })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`flag-row-${flagId}`).remove();
            closeRejectModal();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endsection
