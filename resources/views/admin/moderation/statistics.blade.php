@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
                <span class="mx-2">/</span>
                <span>Statistiques</span>
            </nav>
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Statistiques de moderation</h1>
        </div>
        <div class="flex gap-2">
            <select id="periodFilter" class="form-select" onchange="changePeriod()">
                <option value="7" {{ request('period', 30) == 7 ? 'selected' : '' }}>7 derniers jours</option>
                <option value="30" {{ request('period', 30) == 30 ? 'selected' : '' }}>30 derniers jours</option>
                <option value="90" {{ request('period', 30) == 90 ? 'selected' : '' }}>90 derniers jours</option>
                <option value="365" {{ request('period', 30) == 365 ? 'selected' : '' }}>1 an</option>
            </select>
            <button onclick="exportStats()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-download mr-2"></i> Exporter
            </button>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-blue-100 rounded-xl">
                    <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-gray-700">{{ number_format($overview['total_scanned'] ?? 0) }}</div>
                    <div class="text-xs text-gray-500">Contenus scannes</div>
                </div>
            </div>
            <div class="mt-3 flex items-center text-sm">
                @if(($overview['scanned_change'] ?? 0) >= 0)
                <span class="text-green-600"><i class="fas fa-arrow-up mr-1"></i>{{ $overview['scanned_change'] ?? 0 }}%</span>
                @else
                <span class="text-red-600"><i class="fas fa-arrow-down mr-1"></i>{{ abs($overview['scanned_change'] ?? 0) }}%</span>
                @endif
                <span class="text-gray-500 ml-2">vs periode precedente</span>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-red-100 rounded-xl">
                    <i class="fas fa-ban text-red-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-red-600">{{ number_format($overview['blocked'] ?? 0) }}</div>
                    <div class="text-xs text-gray-500">Contenus bloques</div>
                </div>
            </div>
            <div class="mt-3 text-sm text-gray-500">
                Taux de blocage: <strong>{{ number_format($overview['block_rate'] ?? 0, 1) }}%</strong>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-orange-100 rounded-xl">
                    <i class="fas fa-eye text-orange-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-orange-600">{{ number_format($overview['reviewed'] ?? 0) }}</div>
                    <div class="text-xs text-gray-500">Verifies manuellement</div>
                </div>
            </div>
            <div class="mt-3 text-sm text-gray-500">
                Approuves: <strong>{{ number_format($overview['review_approved_rate'] ?? 0, 1) }}%</strong>
            </div>
        </div>

        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-purple-100 rounded-xl">
                    <i class="fas fa-bolt text-purple-600 text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-purple-600">{{ number_format($overview['strikes'] ?? 0) }}</div>
                    <div class="text-xs text-gray-500">Strikes emis</div>
                </div>
            </div>
            <div class="mt-3 text-sm text-gray-500">
                Bans: <strong>{{ $overview['bans'] ?? 0 }}</strong>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Activity Chart -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                Activite de moderation
            </h3>
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Detection Types -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-chart-pie text-green-500 mr-2"></i>
                Types de detections
            </h3>
            <div class="h-64">
                <canvas id="detectionTypesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Top Detected Words -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-list text-orange-500 mr-2"></i>
                Mots les plus detectes
            </h3>
            <div class="space-y-3">
                @forelse($topWords ?? [] as $word)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded text-xs font-medium {{ $word['severity'] === 'critical' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ $word['severity'] === 'critical' ? 'C' : 'W' }}
                        </span>
                        <code class="text-sm bg-gray-100 px-2 py-0.5 rounded">{{ $word['word'] }}</code>
                    </div>
                    <span class="font-medium text-gray-700">{{ $word['count'] }}</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune detection</p>
                @endforelse
            </div>
        </div>

        <!-- Detection by Category -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-tags text-purple-500 mr-2"></i>
                Detections par categorie
            </h3>
            <div class="space-y-3">
                @php
                    $categoryLabels = [
                        'politics' => ['label' => 'Politique', 'color' => 'bg-purple-500'],
                        'contact' => ['label' => 'Contact', 'color' => 'bg-blue-500'],
                        'scam' => ['label' => 'Arnaque', 'color' => 'bg-red-500'],
                        'spam' => ['label' => 'Spam', 'color' => 'bg-yellow-500'],
                        'offensive' => ['label' => 'Offensant', 'color' => 'bg-orange-500'],
                        'adult' => ['label' => 'Adulte', 'color' => 'bg-pink-500'],
                    ];
                    $maxCategory = max(array_column($categoryStats ?? [['count' => 1]], 'count'));
                @endphp
                @forelse($categoryStats ?? [] as $cat)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">{{ $categoryLabels[$cat['category']]['label'] ?? $cat['category'] }}</span>
                        <span class="font-medium">{{ $cat['count'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="{{ $categoryLabels[$cat['category']]['color'] ?? 'bg-gray-500' }} h-2 rounded-full" style="width: {{ ($cat['count'] / $maxCategory) * 100 }}%"></div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Aucune donnee</p>
                @endforelse
            </div>
        </div>

        <!-- Response Times -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-clock text-green-500 mr-2"></i>
                Temps de reponse
            </h3>
            <div class="space-y-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-3xl font-bold text-gray-700">{{ $responseTimes['avg_review_time'] ?? 'N/A' }}</div>
                    <div class="text-sm text-gray-500">Temps moyen de revision</div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-3 bg-green-50 rounded-lg">
                        <div class="text-xl font-bold text-green-600">{{ $responseTimes['same_day'] ?? 0 }}%</div>
                        <div class="text-xs text-gray-500">Traite le jour meme</div>
                    </div>
                    <div class="text-center p-3 bg-orange-50 rounded-lg">
                        <div class="text-xl font-bold text-orange-600">{{ $responseTimes['pending_over_24h'] ?? 0 }}</div>
                        <div class="text-xs text-gray-500">En attente > 24h</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Actions -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-users text-blue-500 mr-2"></i>
                Actions sur les utilisateurs
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">{{ $userActions['warnings'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Avertissements</div>
                </div>
                <div class="text-center p-4 bg-orange-50 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600">{{ $userActions['strikes'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Strikes</div>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">{{ $userActions['suspensions'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Suspensions</div>
                </div>
                <div class="text-center p-4 bg-red-100 rounded-lg">
                    <div class="text-2xl font-bold text-red-700">{{ $userActions['bans'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Bannissements</div>
                </div>
            </div>
        </div>

        <!-- Appeals Stats -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-gavel text-purple-500 mr-2"></i>
                Statistiques des appels
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-700">{{ $appealStats['total'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Total appels</div>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">{{ $appealStats['pending'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">En attente</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $appealStats['approved'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Approuves</div>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">{{ $appealStats['rejected'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Rejetes</div>
                </div>
            </div>
            @if(($appealStats['total'] ?? 0) > 0)
            <div class="mt-4 p-3 bg-blue-50 rounded-lg text-center">
                <span class="text-sm text-gray-600">Taux d'approbation:</span>
                <span class="font-bold text-blue-600 ml-2">{{ number_format($appealStats['approval_rate'] ?? 0, 1) }}%</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Reports by Reason -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold mb-4 flex items-center">
            <i class="fas fa-flag text-red-500 mr-2"></i>
            Signalements par raison
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Raison</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Total</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Resolus</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Rejetes</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Taux validation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reportsByReason ?? [] as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-700">{{ $report['reason_label'] ?? $report['reason'] }}</td>
                        <td class="px-4 py-3 text-center">{{ $report['total'] }}</td>
                        <td class="px-4 py-3 text-center text-green-600">{{ $report['resolved'] }}</td>
                        <td class="px-4 py-3 text-center text-gray-500">{{ $report['dismissed'] }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $report['validation_rate'] >= 50 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ number_format($report['validation_rate'], 1) }}%
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">Aucun signalement</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function changePeriod() {
    const period = document.getElementById('periodFilter').value;
    const url = new URL(window.location.href);
    url.searchParams.set('period', period);
    window.location.href = url.toString();
}

function exportStats() {
    const period = document.getElementById('periodFilter').value;
    window.location.href = `/admin/moderation/statistics/export?period=${period}`;
}

// Activity Chart
const activityCtx = document.getElementById('activityChart').getContext('2d');
new Chart(activityCtx, {
    type: 'line',
    data: {
        labels: @json($chartData['activity']['labels'] ?? []),
        datasets: [
            {
                label: 'Scannes',
                data: @json($chartData['activity']['scanned'] ?? []),
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Bloques',
                data: @json($chartData['activity']['blocked'] ?? []),
                borderColor: '#EF4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'En revision',
                data: @json($chartData['activity']['pending'] ?? []),
                borderColor: '#F59E0B',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Detection Types Chart
const detectionCtx = document.getElementById('detectionTypesChart').getContext('2d');
new Chart(detectionCtx, {
    type: 'doughnut',
    data: {
        labels: @json($chartData['detectionTypes']['labels'] ?? ['Mots interdits', 'Contact', 'Spam', 'Signalements']),
        datasets: [{
            data: @json($chartData['detectionTypes']['data'] ?? [0, 0, 0, 0]),
            backgroundColor: [
                '#EF4444',
                '#8B5CF6',
                '#F59E0B',
                '#3B82F6'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection
