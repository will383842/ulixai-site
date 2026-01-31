@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
        <div>
            <h1 class="page-title" style="font-size: 1.75rem; font-weight: 700; color: var(--admin-text);">Centre de Moderation</h1>
            <p class="page-subtitle" style="color: var(--admin-text-muted); margin-top: 0.25rem;">Gestion du contenu et des utilisateurs</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.moderation.statistics') }}" class="btn-secondary">
                <i class="fas fa-chart-bar mr-2"></i> Statistiques
            </a>
            <a href="{{ route('admin.moderation.words.index') }}" class="btn-secondary">
                <i class="fas fa-ban mr-2"></i> Mots interdits
            </a>
        </div>
    </div>

    <!-- Pending Counts -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Pending Flags -->
        <a href="{{ route('admin.moderation.flags.index') }}" class="admin-card p-6 hover:shadow-lg transition-all cursor-pointer border-l-4 {{ $pendingCounts['flags'] > 0 ? 'border-orange-500' : 'border-green-500' }}">
            <div class="flex items-center justify-between">
                <div class="p-3 {{ $pendingCounts['flags'] > 0 ? 'bg-orange-100' : 'bg-green-100' }} rounded-xl">
                    <i class="fas fa-flag {{ $pendingCounts['flags'] > 0 ? 'text-orange-600' : 'text-green-600' }} text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold {{ $pendingCounts['flags'] > 0 ? 'text-orange-600' : 'text-green-600' }}">{{ $pendingCounts['flags'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">En attente</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Contenus a verifier</div>
        </a>

        <!-- Pending Reports -->
        <a href="{{ route('admin.moderation.reports.index') }}" class="admin-card p-6 hover:shadow-lg transition-all cursor-pointer border-l-4 {{ $pendingCounts['reports'] > 0 ? 'border-red-500' : 'border-green-500' }}">
            <div class="flex items-center justify-between">
                <div class="p-3 {{ $pendingCounts['reports'] > 0 ? 'bg-red-100' : 'bg-green-100' }} rounded-xl">
                    <i class="fas fa-exclamation-triangle {{ $pendingCounts['reports'] > 0 ? 'text-red-600' : 'text-green-600' }} text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold {{ $pendingCounts['reports'] > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $pendingCounts['reports'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">En attente</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Signalements</div>
        </a>

        <!-- Pending Appeals -->
        <a href="{{ route('admin.moderation.appeals.index') }}" class="admin-card p-6 hover:shadow-lg transition-all cursor-pointer border-l-4 {{ $pendingCounts['appeals'] > 0 ? 'border-purple-500' : 'border-green-500' }}">
            <div class="flex items-center justify-between">
                <div class="p-3 {{ $pendingCounts['appeals'] > 0 ? 'bg-purple-100' : 'bg-green-100' }} rounded-xl">
                    <i class="fas fa-gavel {{ $pendingCounts['appeals'] > 0 ? 'text-purple-600' : 'text-green-600' }} text-xl"></i>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold {{ $pendingCounts['appeals'] > 0 ? 'text-purple-600' : 'text-green-600' }}">{{ $pendingCounts['appeals'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">En attente</div>
                </div>
            </div>
            <div class="mt-4 text-sm font-medium text-gray-600">Appels</div>
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Moderation Stats -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-shield-alt text-blue-500 mr-2"></i>
                Moderation (30 derniers jours)
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Contenus bloques automatiquement</span>
                    <span class="font-semibold text-red-600">{{ $stats['moderation']['blocked_today'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Strikes emis</span>
                    <span class="font-semibold text-orange-600">{{ $stats['moderation']['strikes_issued'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Utilisateurs bannis</span>
                    <span class="font-semibold text-red-700">{{ $stats['moderation']['users_banned'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">Total flags traites</span>
                    <span class="font-semibold text-gray-700">{{ $stats['moderation']['total_flags'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- Reports Stats -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-flag text-orange-500 mr-2"></i>
                Signalements (30 derniers jours)
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Total signalements</span>
                    <span class="font-semibold">{{ $stats['reports']['total'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Resolus</span>
                    <span class="font-semibold text-green-600">{{ $stats['reports']['resolved'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-600">Rejetes</span>
                    <span class="font-semibold text-gray-500">{{ $stats['reports']['dismissed'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-gray-600">En investigation</span>
                    <span class="font-semibold text-blue-600">{{ $stats['reports']['investigating'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Appeals Stats -->
    <div class="admin-card p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4 flex items-center">
            <i class="fas fa-balance-scale text-purple-500 mr-2"></i>
            Appels (30 derniers jours)
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl font-bold text-gray-700">{{ $stats['appeals']['total'] ?? 0 }}</div>
                <div class="text-sm text-gray-500">Total</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ $stats['appeals']['approved'] ?? 0 }}</div>
                <div class="text-sm text-gray-500">Approuves</div>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <div class="text-2xl font-bold text-red-600">{{ $stats['appeals']['rejected'] ?? 0 }}</div>
                <div class="text-sm text-gray-500">Rejetes</div>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['appeals']['approval_rate'] ?? 0 }}%</div>
                <div class="text-sm text-gray-500">Taux approbation</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card p-6">
        <h3 class="text-lg font-semibold mb-4">Actions rapides</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.moderation.flags.index') }}?severity=critical" class="flex items-center gap-3 p-4 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span class="text-sm font-medium">Flags critiques</span>
            </a>
            <a href="{{ route('admin.moderation.reports.index') }}?priority=critical" class="flex items-center gap-3 p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors">
                <i class="fas fa-fire text-orange-500"></i>
                <span class="text-sm font-medium">Signalements urgents</span>
            </a>
            <a href="{{ route('admin.moderation.appeals.index') }}" class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                <i class="fas fa-clock text-purple-500"></i>
                <span class="text-sm font-medium">Appels en attente</span>
            </a>
            <a href="{{ route('admin.moderation.words.index') }}" class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <i class="fas fa-plus text-blue-500"></i>
                <span class="text-sm font-medium">Ajouter mot interdit</span>
            </a>
        </div>
    </div>
</div>

<style>
.btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: white;
    border: 1px solid var(--admin-border);
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--admin-text-secondary);
    transition: all 0.2s;
    text-decoration: none;
}
.btn-secondary:hover {
    background: var(--admin-bg);
    border-color: var(--admin-primary);
    color: var(--admin-primary);
}
</style>
@endsection
