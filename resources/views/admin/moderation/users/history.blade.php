@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header mb-6">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
            <span class="mx-2">/</span>
            <span>Historique utilisateur</span>
        </nav>
        <div class="flex justify-between items-start">
            <div class="flex items-center gap-4">
                <img src="{{ $user->avatar_url ?? '/images/default-avatar.png' }}" class="w-16 h-16 rounded-full" alt="">
                <div>
                    <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">{{ $user->name }}</h1>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                @if(!$user->isBanned())
                <button onclick="showActionModal('warning')" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Avertir
                </button>
                <button onclick="showActionModal('strike')" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                    <i class="fas fa-bolt mr-2"></i> Strike
                </button>
                <button onclick="showActionModal('suspend')" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-pause mr-2"></i> Suspendre
                </button>
                <button onclick="showActionModal('ban')" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800 transition-colors">
                    <i class="fas fa-ban mr-2"></i> Bannir
                </button>
                @else
                <button onclick="unbanUser()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-undo mr-2"></i> Lever le ban
                </button>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-4 gap-4">
                <div class="admin-card p-4 text-center">
                    <div class="text-3xl font-bold {{ $user->trust_score >= 70 ? 'text-green-600' : ($user->trust_score >= 40 ? 'text-orange-600' : 'text-red-600') }}">
                        {{ $user->trust_score }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Score confiance</div>
                </div>
                <div class="admin-card p-4 text-center">
                    <div class="text-3xl font-bold {{ $user->strike_count > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $user->strike_count }}/3
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Strikes</div>
                </div>
                <div class="admin-card p-4 text-center">
                    <div class="text-3xl font-bold text-blue-600">
                        {{ $stats['total_flags'] ?? 0 }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Contenus flagges</div>
                </div>
                <div class="admin-card p-4 text-center">
                    <div class="text-3xl font-bold text-purple-600">
                        {{ $stats['total_reports'] ?? 0 }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Signalements recus</div>
                </div>
            </div>

            <!-- Moderation History Timeline -->
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-history text-blue-500 mr-2"></i>
                    Historique de moderation
                </h3>
                @if(isset($history) && count($history) > 0)
                <div class="space-y-4">
                    @foreach($history as $event)
                    <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0">
                        <div class="flex-shrink-0">
                            @php
                                $iconConfig = [
                                    'warning' => ['icon' => 'fa-exclamation-triangle', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                                    'strike' => ['icon' => 'fa-bolt', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                                    'suspension' => ['icon' => 'fa-pause-circle', 'bg' => 'bg-red-100', 'text' => 'text-red-600'],
                                    'ban' => ['icon' => 'fa-ban', 'bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                    'unban' => ['icon' => 'fa-undo', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                                    'content_removal' => ['icon' => 'fa-trash', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'],
                                    'appeal_approved' => ['icon' => 'fa-check-circle', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                                    'appeal_rejected' => ['icon' => 'fa-times-circle', 'bg' => 'bg-red-100', 'text' => 'text-red-600'],
                                ];
                                $config = $iconConfig[$event['type']] ?? ['icon' => 'fa-circle', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'];
                            @endphp
                            <div class="w-10 h-10 {{ $config['bg'] }} rounded-full flex items-center justify-center">
                                <i class="fas {{ $config['icon'] }} {{ $config['text'] }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="font-medium text-gray-900">{{ $event['title'] }}</span>
                                    @if(isset($event['admin']))
                                    <span class="text-xs text-gray-500 ml-2">par {{ $event['admin'] }}</span>
                                    @endif
                                </div>
                                <span class="text-xs text-gray-500">{{ $event['date'] }}</span>
                            </div>
                            @if(isset($event['reason']))
                            <p class="text-sm text-gray-600 mt-1">{{ $event['reason'] }}</p>
                            @endif
                            @if(isset($event['details']))
                            <div class="text-xs text-gray-500 mt-2">
                                @foreach($event['details'] as $key => $value)
                                <span class="mr-3">{{ $key }}: <strong>{{ $value }}</strong></span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-500 text-2xl"></i>
                    </div>
                    <p class="text-gray-500">Aucun historique de moderation</p>
                </div>
                @endif
            </div>

            <!-- Flagged Content -->
            @if(isset($flaggedContent) && $flaggedContent->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-flag text-orange-500 mr-2"></i>
                    Contenus flagges ({{ $flaggedContent->count() }})
                </h3>
                <div class="space-y-3">
                    @foreach($flaggedContent as $flag)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg {{ $flag->score >= 70 ? 'bg-red-100' : ($flag->score >= 30 ? 'bg-orange-100' : 'bg-green-100') }} flex items-center justify-center">
                                <span class="font-bold text-sm {{ $flag->score >= 70 ? 'text-red-700' : ($flag->score >= 30 ? 'text-orange-700' : 'text-green-700') }}">
                                    {{ $flag->score }}
                                </span>
                            </div>
                            <div>
                                <div class="font-medium text-sm">{{ $flag->flaggable->title ?? 'Contenu #'.$flag->flaggable_id }}</div>
                                <div class="text-xs text-gray-500">{{ class_basename($flag->flaggable_type) }} - {{ $flag->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <a href="{{ route('admin.moderation.flags.show', $flag) }}" class="text-blue-600 hover:text-blue-700 text-sm">
                            Voir details
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Reports Received -->
            @if(isset($reportsReceived) && $reportsReceived->count() > 0)
            <div class="admin-card p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    Signalements recus ({{ $reportsReceived->count() }})
                </h3>
                <div class="space-y-3">
                    @foreach($reportsReceived as $report)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-medium text-sm">{{ $report->reason_label ?? $report->reason }}</div>
                            <div class="text-xs text-gray-500">
                                Signale par {{ $report->reporter->name ?? 'Anonyme' }} - {{ $report->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded text-xs {{ $report->status === 'resolved' ? 'bg-green-100 text-green-700' : ($report->status === 'dismissed' ? 'bg-gray-100 text-gray-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Status -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Statut du compte</h3>
                <div class="text-center mb-4">
                    @if($user->isBanned())
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-ban text-red-600 text-2xl"></i>
                    </div>
                    <div class="text-lg font-semibold text-red-600">Banni</div>
                    @if($user->banned_until)
                    <div class="text-xs text-gray-500">Jusqu'au {{ $user->banned_until->format('d/m/Y') }}</div>
                    @else
                    <div class="text-xs text-gray-500">Permanent</div>
                    @endif
                    @elseif($user->isSuspended())
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-pause-circle text-orange-600 text-2xl"></i>
                    </div>
                    <div class="text-lg font-semibold text-orange-600">Suspendu</div>
                    <div class="text-xs text-gray-500">Jusqu'au {{ $user->suspended_until->format('d/m/Y H:i') }}</div>
                    @else
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                    <div class="text-lg font-semibold text-green-600">Actif</div>
                    @endif
                </div>
            </div>

            <!-- User Details -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Informations</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID</span>
                        <span class="font-medium">#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Membre depuis</span>
                        <span class="font-medium">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Derniere connexion</span>
                        <span class="font-medium">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Role</span>
                        <span class="font-medium">{{ ucfirst($user->role ?? 'user') }}</span>
                    </div>
                    @if($user->country)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Pays</span>
                        <span class="font-medium">{{ $user->country }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Trust Score Breakdown -->
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Details score confiance</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Score global</span>
                            <span class="font-medium">{{ $user->trust_score }}/100</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $user->trust_score >= 70 ? 'bg-green-500' : ($user->trust_score >= 40 ? 'bg-orange-500' : 'bg-red-500') }}"
                                 style="width: {{ $user->trust_score }}%"></div>
                        </div>
                    </div>
                    @if(isset($trustBreakdown))
                    @foreach($trustBreakdown as $factor => $value)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">{{ $factor }}</span>
                        <span class="font-medium {{ $value >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $value >= 0 ? '+' : '' }}{{ $value }}
                        </span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Strikes Details -->
            @if($user->strike_count > 0)
            <div class="admin-card p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Strikes actifs</h3>
                <div class="space-y-3">
                    @foreach(range(1, $user->strike_count) as $i)
                    <div class="flex items-center gap-3 p-2 bg-red-50 rounded-lg">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-bolt text-red-600 text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="font-medium text-red-700">Strike #{{ $i }}</span>
                        </div>
                    </div>
                    @endforeach
                    @if($user->strike_count >= 3)
                    <div class="mt-2 p-3 bg-red-100 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700 font-medium">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            3 strikes atteints - Ban automatique
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Action Modal -->
<div id="actionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 id="actionModalTitle" class="text-lg font-semibold mb-4"></h3>
        <form id="actionForm">
            <input type="hidden" id="actionType">

            <div id="suspendDuration" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Duree de suspension</label>
                <select id="suspendDays" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">1 jour</option>
                    <option value="3">3 jours</option>
                    <option value="7" selected>7 jours</option>
                    <option value="14">14 jours</option>
                    <option value="30">30 jours</option>
                </select>
            </div>

            <div id="banDuration" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Type de ban</label>
                <select id="banType" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="permanent">Permanent</option>
                    <option value="30">30 jours</option>
                    <option value="90">90 jours</option>
                    <option value="180">6 mois</option>
                    <option value="365">1 an</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Raison</label>
                <textarea id="actionReason" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Expliquez la raison de cette action..."></textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="notifyUser" checked class="rounded text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Notifier l'utilisateur par email</span>
                </label>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeActionModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" id="actionSubmitBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">Confirmer</button>
            </div>
        </form>
    </div>
</div>

<script>
const actionTitles = {
    'warning': 'Envoyer un avertissement',
    'strike': 'Emettre un strike',
    'suspend': 'Suspendre le compte',
    'ban': 'Bannir l\'utilisateur'
};

const actionColors = {
    'warning': 'bg-yellow-600 hover:bg-yellow-700',
    'strike': 'bg-orange-600 hover:bg-orange-700',
    'suspend': 'bg-red-600 hover:bg-red-700',
    'ban': 'bg-red-700 hover:bg-red-800'
};

function showActionModal(type) {
    document.getElementById('actionType').value = type;
    document.getElementById('actionModalTitle').textContent = actionTitles[type];
    document.getElementById('actionReason').value = '';

    // Show/hide duration fields
    document.getElementById('suspendDuration').classList.toggle('hidden', type !== 'suspend');
    document.getElementById('banDuration').classList.toggle('hidden', type !== 'ban');

    // Update button color
    const btn = document.getElementById('actionSubmitBtn');
    btn.className = `px-4 py-2 text-white rounded-lg transition-colors ${actionColors[type]}`;

    document.getElementById('actionModal').classList.remove('hidden');
    document.getElementById('actionModal').classList.add('flex');
}

function closeActionModal() {
    document.getElementById('actionModal').classList.add('hidden');
    document.getElementById('actionModal').classList.remove('flex');
}

function unbanUser() {
    if (!confirm('Lever le ban de cet utilisateur ?')) return;

    fetch(`/admin/moderation/users/{{ $user->id }}/unban`, {
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

document.getElementById('actionForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const type = document.getElementById('actionType').value;
    const reason = document.getElementById('actionReason').value;
    const notify = document.getElementById('notifyUser').checked;

    let data = { action: type, reason, notify };

    if (type === 'suspend') {
        data.days = document.getElementById('suspendDays').value;
    } else if (type === 'ban') {
        data.duration = document.getElementById('banType').value;
    }

    fetch(`/admin/moderation/users/{{ $user->id }}/action`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeActionModal();
            toastr.success(data.message);
            window.location.reload();
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('actionModal').addEventListener('click', function(e) {
    if (e.target === this) closeActionModal();
});
</script>
@endsection
