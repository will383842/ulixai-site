@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header mb-6">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.moderation.reports.index') }}" class="hover:text-blue-600">Signalements</a>
            <span class="mx-2">/</span>
            <span>Signalement #{{ $report->id }}</span>
        </nav>
        <div class="flex justify-between items-start">
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Detail du signalement</h1>
            <div class="flex gap-2">
                @if(in_array($report->status, ['pending', 'investigating']))
                <button onclick="showResolveModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i> Resoudre
                </button>
                <button onclick="dismissReport()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-times mr-2"></i> Rejeter
                </button>
                @else
                <span class="px-4 py-2 rounded-lg {{ $report->status === 'resolved' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                    <i class="fas {{ $report->status === 'resolved' ? 'fa-check' : 'fa-times' }} mr-2"></i>
                    {{ $report->status === 'resolved' ? 'Resolu' : 'Rejete' }}
                </span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Report Details -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-flag text-red-500 mr-2"></i>
                    Signalement
                </h3>
                <div class="space-y-4">
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Raison</span>
                        <p class="font-medium text-lg mt-1">{{ $report->reason_label ?? $report->reason }}</p>
                    </div>
                    @if($report->description)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Description</span>
                        <div class="mt-1 p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $report->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Reported Content -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Contenu signale
                </h3>
                @if($report->reportable)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Type:</span>
                        <span class="ml-2 font-medium">{{ class_basename($report->reportable_type) }}</span>
                    </div>
                    @if($report->reportable->title ?? false)
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Titre:</span>
                        <p class="mt-1 font-medium text-lg">{{ $report->reportable->title }}</p>
                    </div>
                    @endif
                    @if($report->reportable->name ?? false)
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Nom:</span>
                        <p class="mt-1 font-medium text-lg">{{ $report->reportable->name }}</p>
                    </div>
                    @endif
                    @if($report->reportable->description ?? false)
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Description:</span>
                        <p class="mt-1 text-gray-700 whitespace-pre-wrap">{{ $report->reportable->description }}</p>
                    </div>
                    @endif
                    @if($report->reportable->content ?? false)
                    <div class="mb-3">
                        <span class="text-xs text-gray-500 uppercase">Contenu:</span>
                        <p class="mt-1 text-gray-700 whitespace-pre-wrap">{{ $report->reportable->content }}</p>
                    </div>
                    @endif
                </div>

                <!-- Content Author -->
                @if($report->reportable->user ?? false)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <span class="text-xs text-gray-500 uppercase mb-2 block">Auteur du contenu</span>
                    <a href="{{ route('admin.moderation.users.history', $report->reportable->user) }}" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <img src="{{ $report->reportable->user->avatar_url ?? '/images/default-avatar.png' }}" class="w-10 h-10 rounded-full" alt="">
                        <div>
                            <div class="font-medium">{{ $report->reportable->user->name }}</div>
                            <div class="text-xs text-gray-500">Score: {{ $report->reportable->user->trust_score }} | Strikes: {{ $report->reportable->user->strike_count }}</div>
                        </div>
                    </a>
                </div>
                @endif
                @else
                <p class="text-gray-500">Contenu supprime ou inaccessible</p>
                @endif
            </div>

            <!-- Related Flags -->
            @if(isset($relatedFlags) && $relatedFlags->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-orange-500 mr-2"></i>
                    Flags de moderation lies
                </h3>
                <div class="space-y-3">
                    @foreach($relatedFlags as $flag)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg {{ $flag->score >= 70 ? 'bg-red-100' : ($flag->score >= 30 ? 'bg-orange-100' : 'bg-green-100') }} flex items-center justify-center">
                                <span class="font-bold text-sm {{ $flag->score >= 70 ? 'text-red-700' : ($flag->score >= 30 ? 'text-orange-700' : 'text-green-700') }}">{{ $flag->score }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-sm">Flag #{{ $flag->id }}</span>
                                <span class="text-xs text-gray-500 ml-2">{{ $flag->flag_type }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.moderation.flags.show', $flag) }}" class="text-blue-600 hover:text-blue-700 text-sm">
                            Voir
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Other Reports -->
            @if(isset($otherReports) && $otherReports->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-flag text-purple-500 mr-2"></i>
                    Autres signalements sur ce contenu ({{ $otherReports->count() }})
                </h3>
                <div class="space-y-3">
                    @foreach($otherReports as $otherReport)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <img src="{{ $otherReport->reporter->avatar_url ?? '/images/default-avatar.png' }}" class="w-8 h-8 rounded-full" alt="">
                            <div>
                                <div class="font-medium text-sm">{{ $otherReport->reporter->name ?? 'Anonyme' }}</div>
                                <div class="text-xs text-gray-500">{{ $otherReport->reason_label ?? $otherReport->reason }}</div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $otherReport->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Resolution -->
            @if($report->status !== 'pending')
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-clipboard-check text-green-500 mr-2"></i>
                    Resolution
                </h3>
                <div class="space-y-4">
                    @if($report->resolved_by)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Resolu par</span>
                        <p class="font-medium mt-1">{{ $report->resolver->name ?? 'Admin #'.$report->resolved_by }}</p>
                    </div>
                    @endif
                    @if($report->resolved_at)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Date de resolution</span>
                        <p class="font-medium mt-1">{{ $report->resolved_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                    @if($report->resolution_action)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Action prise</span>
                        @php
                            $actionLabels = [
                                'warn_user' => 'Avertissement envoye',
                                'remove_content' => 'Contenu supprime',
                                'strike_user' => 'Strike emis',
                                'suspend_user' => 'Utilisateur suspendu',
                                'ban_user' => 'Utilisateur banni',
                                'no_action' => 'Aucune action necessaire',
                            ];
                        @endphp
                        <p class="font-medium mt-1">{{ $actionLabels[$report->resolution_action] ?? $report->resolution_action }}</p>
                    </div>
                    @endif
                    @if($report->resolution_notes)
                    <div>
                        <span class="text-xs text-gray-500 uppercase">Notes</span>
                        <div class="mt-1 p-3 {{ $report->status === 'resolved' ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $report->resolution_notes }}</p>
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
                        'investigating' => ['icon' => 'fa-search', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Investigation'],
                        'resolved' => ['icon' => 'fa-check-circle', 'bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'Resolu'],
                        'dismissed' => ['icon' => 'fa-times-circle', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'label' => 'Rejete'],
                    ];
                    $config = $statusConfig[$report->status] ?? $statusConfig['pending'];
                @endphp
                <div class="w-16 h-16 {{ $config['bg'] }} rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas {{ $config['icon'] }} {{ $config['text'] }} text-2xl"></i>
                </div>
                <div class="text-lg font-semibold {{ $config['text'] }}">{{ $config['label'] }}</div>
            </div>

            <!-- Priority -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Priorite</h3>
                @php
                    $priorityConfig = [
                        'critical' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Critique'],
                        'high' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'label' => 'Haute'],
                        'medium' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Moyenne'],
                        'low' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'label' => 'Basse'],
                    ];
                    $pConfig = $priorityConfig[$report->priority] ?? $priorityConfig['medium'];
                @endphp
                <div class="text-center">
                    <span class="px-4 py-2 rounded-full text-lg font-medium {{ $pConfig['bg'] }} {{ $pConfig['text'] }}">
                        {{ $pConfig['label'] }}
                    </span>
                </div>
            </div>

            <!-- Reporter Info -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Signale par</h3>
                @if($report->reporter)
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $report->reporter->avatar_url ?? '/images/default-avatar.png' }}" class="w-12 h-12 rounded-full" alt="">
                    <div>
                        <div class="font-medium">{{ $report->reporter->name }}</div>
                        <div class="text-xs text-gray-500">{{ $report->reporter->email }}</div>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Membre depuis</span>
                        <span class="font-medium">{{ $report->reporter->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Score confiance</span>
                        <span class="font-medium">{{ $report->reporter->trust_score }}/100</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Signalements faits</span>
                        <span class="font-medium">{{ $reporterStats['total_reports'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Signalements valides</span>
                        <span class="font-medium {{ ($reporterStats['valid_rate'] ?? 0) >= 50 ? 'text-green-600' : 'text-gray-600' }}">{{ $reporterStats['valid_rate'] ?? 0 }}%</span>
                    </div>
                </div>
                @else
                <p class="text-gray-500">Signalement anonyme</p>
                @endif
            </div>

            <!-- Quick Info -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Informations</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID</span>
                        <span class="font-medium">#{{ $report->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Cree le</span>
                        <span class="font-medium">{{ $report->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($report->status === 'investigating' && $report->investigating_since)
                    <div class="flex justify-between">
                        <span class="text-gray-500">En investigation depuis</span>
                        <span class="font-medium">{{ $report->investigating_since->diffForHumans() }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Resolve Modal -->
<div id="resolveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4">Resoudre le signalement</h3>
        <form id="resolveForm">
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

<script>
function showResolveModal() {
    document.getElementById('resolveAction').value = '';
    document.getElementById('resolveNotes').value = '';
    document.getElementById('resolveModal').classList.remove('hidden');
    document.getElementById('resolveModal').classList.add('flex');
}

function closeResolveModal() {
    document.getElementById('resolveModal').classList.add('hidden');
    document.getElementById('resolveModal').classList.remove('flex');
}

function dismissReport() {
    if (!confirm('Rejeter ce signalement ? Cette action indique que le signalement n\'est pas fonde.')) return;

    fetch(`/admin/moderation/reports/{{ $report->id }}/dismiss`, {
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
            window.location.href = '{{ route("admin.moderation.reports.index") }}';
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

document.getElementById('resolveForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const action = document.getElementById('resolveAction').value;
    const notes = document.getElementById('resolveNotes').value;

    fetch(`/admin/moderation/reports/{{ $report->id }}/resolve`, {
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
            toastr.success(data.message);
            window.location.href = '{{ route("admin.moderation.reports.index") }}';
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
