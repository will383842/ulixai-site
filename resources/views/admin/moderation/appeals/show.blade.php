@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header mb-6">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.moderation.appeals.index') }}" class="hover:text-blue-600">Appels</a>
            <span class="mx-2">/</span>
            <span>Appel #{{ $appeal->id }}</span>
        </nav>
        <div class="flex justify-between items-start">
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Detail de l'appel</h1>
            <div class="flex gap-2">
                @if(in_array($appeal->status, ['pending', 'under_review']))
                <button onclick="showApproveModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i> Approuver
                </button>
                <button onclick="showRejectModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-times mr-2"></i> Rejeter
                </button>
                @else
                <span class="px-4 py-2 rounded-lg {{ $appeal->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    <i class="fas {{ $appeal->status === 'approved' ? 'fa-check' : 'fa-times' }} mr-2"></i>
                    {{ $appeal->status === 'approved' ? 'Approuve' : 'Rejete' }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Appeal Details -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-gavel text-purple-500 mr-2"></i>
                    Demande d'appel
                </h3>
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $appeal->reason }}</p>
                </div>
                @if($appeal->evidence)
                <div class="mt-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Preuves fournies</h4>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $appeal->evidence }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Original Action -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-orange-500 mr-2"></i>
                    Sanction originale
                </h3>
                @if($appeal->moderationAction)
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Type d'action</span>
                            <p class="font-medium mt-1">
                                @php
                                    $actionLabels = [
                                        'strike' => 'Strike',
                                        'suspension' => 'Suspension',
                                        'ban' => 'Bannissement',
                                        'content_removal' => 'Suppression de contenu',
                                        'warning' => 'Avertissement',
                                    ];
                                @endphp
                                {{ $actionLabels[$appeal->moderationAction->action_type] ?? $appeal->moderationAction->action_type }}
                            </p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Date de la sanction</span>
                            <p class="font-medium mt-1">{{ $appeal->moderationAction->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    @if($appeal->moderationAction->reason)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Raison de la sanction</span>
                        <p class="mt-1 text-gray-700">{{ $appeal->moderationAction->reason }}</p>
                    </div>
                    @endif
                    @if($appeal->moderationAction->admin)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Moderateur</span>
                        <p class="mt-1 font-medium">{{ $appeal->moderationAction->admin->name }}</p>
                    </div>
                    @endif
                </div>
                @else
                <p class="text-gray-500">Action de moderation non trouvee</p>
                @endif
            </div>

            <!-- Related Content -->
            @if($appeal->moderationAction && $appeal->moderationAction->actionable)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Contenu concerne
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Type:</span>
                        <span class="ml-2 font-medium">{{ class_basename($appeal->moderationAction->actionable_type) }}</span>
                    </div>
                    @if($appeal->moderationAction->actionable->title ?? false)
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Titre:</span>
                        <p class="mt-1 font-medium text-lg">{{ $appeal->moderationAction->actionable->title }}</p>
                    </div>
                    @endif
                    @if($appeal->moderationAction->actionable->description ?? false)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Description:</span>
                        <p class="mt-1 text-gray-700">{{ Str::limit($appeal->moderationAction->actionable->description, 500) }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Admin Notes / Resolution -->
            @if($appeal->status !== 'pending')
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-clipboard-check text-green-500 mr-2"></i>
                    Resolution
                </h3>
                <div class="space-y-4">
                    @if($appeal->reviewed_by)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Revise par</span>
                        <p class="font-medium mt-1">{{ $appeal->reviewer->name ?? 'Admin #'.$appeal->reviewed_by }}</p>
                    </div>
                    @endif
                    @if($appeal->reviewed_at)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Date de revision</span>
                        <p class="font-medium mt-1">{{ $appeal->reviewed_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                    @if($appeal->admin_notes)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Notes de l'admin</span>
                        <div class="mt-1 p-3 {{ $appeal->status === 'approved' ? 'bg-green-50' : 'bg-red-50' }} rounded-lg">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $appeal->admin_notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="admin-card p-6 text-center">
                @php
                    $statusConfig = [
                        'pending' => ['icon' => 'fa-clock', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'En attente'],
                        'under_review' => ['icon' => 'fa-search', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'En cours'],
                        'approved' => ['icon' => 'fa-check-circle', 'bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'Approuve'],
                        'rejected' => ['icon' => 'fa-times-circle', 'bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Rejete'],
                    ];
                    $config = $statusConfig[$appeal->status] ?? $statusConfig['pending'];
                @endphp
                <div class="w-16 h-16 {{ $config['bg'] }} rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas {{ $config['icon'] }} {{ $config['text'] }} text-2xl"></i>
                </div>
                <div class="text-lg font-semibold {{ $config['text'] }}">{{ $config['label'] }}</div>
                <div class="text-sm text-gray-500 mt-1">
                    Soumis {{ $appeal->created_at->diffForHumans() }}
                </div>
            </div>

            <!-- User Info -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Utilisateur</h3>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $appeal->user->avatar_url ?? '/images/default-avatar.png' }}" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <div class="font-medium">{{ $appeal->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $appeal->user->email }}</div>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Membre depuis</span>
                        <span class="font-medium">{{ $appeal->user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Score confiance</span>
                        <span class="font-medium {{ $appeal->user->trust_score >= 70 ? 'text-green-600' : ($appeal->user->trust_score >= 40 ? 'text-orange-600' : 'text-red-600') }}">
                            {{ $appeal->user->trust_score }}/100
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Strikes actifs</span>
                        <span class="font-medium {{ $appeal->user->strike_count > 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $appeal->user->strike_count }}/3
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Statut compte</span>
                        <span class="font-medium {{ $appeal->user->isBanned() ? 'text-red-600' : ($appeal->user->isSuspended() ? 'text-orange-600' : 'text-green-600') }}">
                            @if($appeal->user->isBanned())
                                Banni
                            @elseif($appeal->user->isSuspended())
                                Suspendu
                            @else
                                Actif
                            @endif
                        </span>
                    </div>
                </div>
                <a href="{{ route('admin.moderation.users.history', $appeal->user) }}" class="mt-4 block text-center text-sm text-blue-600 hover:text-blue-700">
                    Voir historique complet
                </a>
            </div>

            <!-- Appeal History -->
            @if($previousAppeals && $previousAppeals->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Appels precedents ({{ $previousAppeals->count() }})</h3>
                <div class="space-y-3">
                    @foreach($previousAppeals as $prevAppeal)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg text-sm">
                        <div>
                            <span class="font-medium">#{{ $prevAppeal->id }}</span>
                            <span class="text-gray-500 ml-2">{{ $prevAppeal->created_at->format('d/m/Y') }}</span>
                        </div>
                        <span class="px-2 py-0.5 rounded text-xs {{ $prevAppeal->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $prevAppeal->status === 'approved' ? 'Approuve' : 'Rejete' }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Info -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Informations</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID Appel</span>
                        <span class="font-medium">#{{ $appeal->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Type sanction</span>
                        <span class="font-medium">{{ ucfirst($appeal->action_type) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Soumis le</span>
                        <span class="font-medium">{{ $appeal->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4 text-green-600">
            <i class="fas fa-check-circle mr-2"></i>Approuver l'appel
        </h3>
        <form id="approveForm">
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
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">Approuver</button>
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
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-red-700">
                    <strong>Attention:</strong> Rejeter cet appel maintiendra la sanction en place.
                </p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Raison du rejet</label>
                <textarea id="rejectNotes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500" required placeholder="Expliquez pourquoi l'appel est rejete..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Rejeter</button>
            </div>
        </form>
    </div>
</div>

<script>
function showApproveModal() {
    document.getElementById('approveNotes').value = '';
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveModal').classList.remove('flex');
}

function showRejectModal() {
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
    const notes = document.getElementById('approveNotes').value;

    fetch(`/admin/moderation/appeals/{{ $appeal->id }}/approve`, {
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
            toastr.success(data.message);
            window.location.href = '{{ route("admin.moderation.appeals.index") }}';
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('rejectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const notes = document.getElementById('rejectNotes').value;

    fetch(`/admin/moderation/appeals/{{ $appeal->id }}/reject`, {
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
            toastr.success(data.message);
            window.location.href = '{{ route("admin.moderation.appeals.index") }}';
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('approveModal').addEventListener('click', function(e) {
    if (e.target === this) closeApproveModal();
});
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>
@endsection
