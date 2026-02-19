@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Litiges</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Litiges de missions</h1>
        <p class="page-subtitle">Liste des missions en litige nécessitant une révision</p>
    </div>

    <!-- Table -->
    <div class="admin-card">
        <div class="admin-table-responsive">
            <table class="admin-table admin-table-mobile">
                <thead>
                    <tr>
                        <th>ID Mission</th>
                        <th>Titre</th>
                        <th>Demandeur</th>
                        <th>Prestataire</th>
                        <th>Montant</th>
                        <th>Raison du litige</th>
                        <th>Annulé par</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($disputes as $dispute)
                    <tr>
                        <td data-label="ID Mission" style="font-weight: 500; color: var(--admin-text);">#{{ $dispute->id }}</td>
                        <td data-label="Titre" style="color: var(--admin-text);">{{ Str::limit($dispute->title, 30) }}</td>
                        <td data-label="Demandeur" style="color: var(--admin-text);">{{ $dispute->requester->name }}</td>
                        <td data-label="Prestataire" style="color: var(--admin-text);">{{ optional($dispute->selectedProvider->user)->name ?? '-' }}</td>
                        @php
                            $paidTransaction = $dispute->transactions->where('status', 'paid')->first();
                            $currency = $dispute->budget_currency ?? 'EUR';
                        @endphp
                        <td data-label="Montant" style="font-weight: 500; color: var(--admin-text);">
                            @if($paidTransaction)
                                {{ \App\Models\Currency::format($paidTransaction->amount_paid, $currency) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td data-label="Raison" style="color: var(--admin-text-muted); max-width: 200px;" title="{{ $dispute->cancellationReasons->first()->custom_description ?? $dispute->cancellationReasons->first()->reason }}">
                            {{ Str::limit($dispute->cancellationReasons->first()->custom_description ?? $dispute->cancellationReasons->first()->reason, 40) }}
                        </td>
                        <td data-label="Annulé par">
                            <span class="badge badge-default">{{ ucfirst($dispute->cancelled_by) }}</span>
                        </td>
                        <td data-label="Actions">
                            <div style="display: flex; gap: 8px;">
                                <button class="transfer-btn btn btn-ghost btn-sm" style="color: var(--admin-success);"
                                        data-mission-id="{{ $dispute->id }}"
                                        data-provider-id="{{ $dispute->selected_provider_id }}"
                                        data-admin-tooltip="Transférer au prestataire">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </button>
                                <button class="refund-btn btn btn-ghost btn-sm" style="color: var(--admin-danger);"
                                        data-mission-id="{{ $dispute->id }}"
                                        data-admin-tooltip="Rembourser le demandeur">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="admin-empty-title">Aucun litige en cours</p>
                                <p class="admin-empty-description">Les litiges de mission apparaîtront ici</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.refund-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir rembourser ce montant au demandeur ?')) {
                const missionId = this.dataset.missionId;
                fetch('/admin/disputes/refund', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ mission_id: missionId })
                })
                .then(res => res.json())
                .then(data => {
                    toastr.success(data.message || 'Remboursement effectué');
                    setTimeout(() => location.reload(), 1500);
                })
                .catch(() => toastr.error('Erreur lors du remboursement'));
            }
        });
    });

    document.querySelectorAll('.transfer-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir transférer ce montant au prestataire ?')) {
                const missionId = this.dataset.missionId;
                const providerId = this.dataset.providerId;
                fetch('/admin/disputes/transfer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ mission_id: missionId, provider_id: providerId })
                })
                .then(res => res.json())
                .then(data => {
                    toastr.success(data.message || 'Transfert effectué');
                    setTimeout(() => location.reload(), 1500);
                })
                .catch(() => toastr.error('Erreur lors du transfert'));
            }
        });
    });
});
</script>
@endpush
@endsection
