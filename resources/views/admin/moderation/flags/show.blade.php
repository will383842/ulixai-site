@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header mb-6">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.moderation.flags.index') }}" class="hover:text-blue-600">Contenus</a>
            <span class="mx-2">/</span>
            <span>Detail #{{ $flag->id }}</span>
        </nav>
        <div class="flex justify-between items-start">
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Detail du contenu flagge</h1>
            <div class="flex gap-2">
                @if($flag->isPending())
                <button onclick="approveFlag({{ $flag->id }})" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i> Approuver
                </button>
                <button onclick="showRejectModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-times mr-2"></i> Rejeter
                </button>
                @else
                <span class="px-4 py-2 rounded-lg {{ $flag->isApproved() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    <i class="fas {{ $flag->isApproved() ? 'fa-check' : 'fa-times' }} mr-2"></i>
                    {{ $flag->isApproved() ? 'Approuve' : 'Rejete' }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Content Preview -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Contenu original
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($flag->flaggable)
                        <div class="mb-4">
                            <span class="text-xs text-gray-500 uppercase">Type:</span>
                            <span class="ml-2 font-medium">{{ class_basename($flag->flaggable_type) }}</span>
                        </div>
                        @if($flag->flaggable->title ?? false)
                        <div class="mb-4">
                            <span class="text-xs text-gray-500 uppercase">Titre:</span>
                            <p class="mt-1 font-medium text-lg">{{ $flag->flaggable->title }}</p>
                        </div>
                        @endif
                        @if($flag->flaggable->description ?? false)
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Description:</span>
                            <p class="mt-1 text-gray-700 whitespace-pre-wrap">{{ $flag->flaggable->description }}</p>
                        </div>
                        @endif
                    @else
                        <p class="text-gray-500">Contenu supprime ou inaccessible</p>
                    @endif
                </div>
            </div>

            <!-- Detection Details -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-search text-orange-500 mr-2"></i>
                    Details de la detection
                </h3>

                @if(!empty($flag->matched_words))
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Mots detectes</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($flag->matched_words as $word)
                        <span class="px-3 py-1 rounded-full text-sm
                            {{ ($word['severity'] ?? 'info') === 'critical' ? 'bg-red-100 text-red-700' :
                               (($word['severity'] ?? 'info') === 'warning' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }}">
                            {{ $word['word'] ?? $word }}
                            <span class="text-xs opacity-75 ml-1">({{ $word['category'] ?? 'N/A' }})</span>
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($flag->has_contact_info && !empty($flag->details['detected_contacts'] ?? []))
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Coordonnees detectees</h4>
                    <div class="bg-purple-50 rounded-lg p-3">
                        @foreach($flag->details['detected_contacts'] as $contact)
                        <div class="flex items-center gap-2 py-1">
                            <span class="text-xs font-medium text-purple-600 uppercase w-24">{{ $contact['type'] }}</span>
                            <span class="text-gray-700">{{ $contact['value'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($flag->is_spam && !empty($flag->details['spam_indicators'] ?? []))
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Indicateurs de spam</h4>
                    <div class="bg-yellow-50 rounded-lg p-3">
                        @foreach($flag->details['spam_indicators'] as $indicator)
                        <div class="flex items-center justify-between py-1">
                            <span class="text-sm text-gray-600">{{ $indicator['type'] }}</span>
                            <span class="font-medium {{ $indicator['value'] > $indicator['threshold'] ? 'text-red-600' : 'text-green-600' }}">
                                {{ $indicator['value'] }} / {{ $indicator['threshold'] }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!empty($flag->details['issues'] ?? []))
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Problemes detectes</h4>
                    <ul class="space-y-2">
                        @foreach($flag->details['issues'] as $issue)
                        <li class="flex items-start gap-2 text-sm">
                            <i class="fas fa-exclamation-circle {{ ($issue['severity'] ?? 'info') === 'critical' ? 'text-red-500' : 'text-orange-500' }} mt-0.5"></i>
                            <span>{{ $issue['message'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Related Reports -->
            @if(isset($reports) && $reports->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-flag text-red-500 mr-2"></i>
                    Signalements lies ({{ $reports->count() }})
                </h3>
                <div class="space-y-3">
                    @foreach($reports as $report)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <img src="{{ $report->reporter->avatar_url ?? '/images/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <div class="text-sm font-medium">{{ $report->reporter->name ?? 'Anonyme' }}</div>
                                <div class="text-xs text-gray-500">{{ $report->reason_label }}</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Score Card -->
            <div class="admin-card p-6 text-center">
                <div class="text-6xl font-bold mb-2
                    {{ $flag->score >= 70 ? 'text-red-600' : ($flag->score >= 30 ? 'text-orange-600' : 'text-green-600') }}">
                    {{ $flag->score }}
                </div>
                <div class="text-gray-500 text-sm mb-4">Score de risque / 100</div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="h-3 rounded-full {{ $flag->score >= 70 ? 'bg-red-500' : ($flag->score >= 30 ? 'bg-orange-500' : 'bg-green-500') }}"
                         style="width: {{ min($flag->score, 100) }}%"></div>
                </div>
                <div class="mt-2 text-xs text-gray-500">
                    @if($flag->score >= 70) Blocage automatique
                    @elseif($flag->score >= 30) Verification requise
                    @else Risque faible
                    @endif
                </div>
            </div>

            <!-- Flag Info -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Informations</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Statut</span>
                        <span class="font-medium">{{ $flag->status_label }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Type</span>
                        <span class="font-medium">{{ $flag->flag_type }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Cree le</span>
                        <span class="font-medium">{{ $flag->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($flag->reviewed_at)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Revise le</span>
                        <span class="font-medium">{{ $flag->reviewed_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Author Info -->
            @if($flag->user)
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Auteur du contenu</h3>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $flag->user->avatar_url ?? '/images/default-avatar.png' }}" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <div class="font-medium">{{ $flag->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $flag->user->email }}</div>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Score confiance</span>
                        <span class="font-medium {{ $flag->user->trust_score >= 70 ? 'text-green-600' : ($flag->user->trust_score >= 40 ? 'text-orange-600' : 'text-red-600') }}">
                            {{ $flag->user->trust_score }}/100
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Strikes</span>
                        <span class="font-medium {{ $flag->user->strike_count > 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $flag->user->strike_count }}/3
                        </span>
                    </div>
                </div>
                <a href="{{ route('admin.moderation.users.history', $flag->user) }}" class="mt-4 block text-center text-sm text-blue-600 hover:text-blue-700">
                    Voir historique complet
                </a>
            </div>
            @endif

            @if($userHistory)
            <!-- User History Summary -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Historique utilisateur</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Strikes actifs</span>
                        <span class="font-medium">{{ $userHistory['active_strikes'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Actions totales</span>
                        <span class="font-medium">{{ count($userHistory['actions'] ?? []) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Peut faire appel</span>
                        <span class="font-medium">{{ ($userHistory['can_appeal'] ?? false) ? 'Oui' : 'Non' }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4">Rejeter le contenu</h3>
        <form id="rejectForm">
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

<script>
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
            toastr.success(data.message);
            window.location.href = '{{ route("admin.moderation.flags.index") }}';
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

function showRejectModal() {
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
    const reason = document.getElementById('rejectReason').value;

    fetch(`/admin/moderation/flags/{{ $flag->id }}/reject`, {
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
            toastr.success(data.message);
            window.location.href = '{{ route("admin.moderation.flags.index") }}';
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
