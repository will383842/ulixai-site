@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Signalements</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Signalements reçus</h1>
        <p class="page-subtitle">Gérez les signalements de conversations et d'utilisateurs</p>
    </div>

    <!-- Table -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Liste des signalements</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Signalé par</th>
                        <th>Utilisateur signalé</th>
                        <th>Raison</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports ?? [] as $report)
                    <tr>
                        <td class="text-sm font-medium text-gray-900">#{{ $report->id }}</td>
                        <td>
                            <div class="text-sm text-gray-900">{{ $report->reporter->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $report->reporter->email ?? '' }}</div>
                        </td>
                        <td>
                            <div class="text-sm text-gray-900">{{ $report->reported->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $report->reported->email ?? '' }}</div>
                        </td>
                        <td class="text-sm text-gray-500 max-w-xs truncate">{{ $report->reason ?? '-' }}</td>
                        <td class="text-sm text-gray-500">{{ $report->created_at->format('d/m/Y H:i') ?? '-' }}</td>
                        <td>
                            @if(($report->status ?? 'pending') === 'resolved')
                                <span class="badge-success">Résolu</span>
                            @elseif(($report->status ?? 'pending') === 'dismissed')
                                <span class="badge-default">Rejeté</span>
                            @else
                                <span class="badge-warning">En attente</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <button class="btn btn-ghost text-blue-600 hover:bg-blue-50 text-xs">
                                    Voir
                                </button>
                                <button class="btn btn-ghost text-green-600 hover:bg-green-50 text-xs">
                                    Résoudre
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Aucun signalement</p>
                            <p class="text-gray-400 text-xs mt-1">Les signalements apparaîtront ici</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
