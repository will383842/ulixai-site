@extends('admin.dashboard.index')

@php
    // Helper function to convert currency code to symbol
    function getCurrencySymbol($currency) {
        return match(strtoupper($currency ?? 'EUR')) {
            'EUR' => '€',
            'USD' => '$',
            'GBP' => '£',
            'CHF' => 'CHF',
            'CAD' => 'CA$',
            'AUD' => 'A$',
            'JPY' => '¥',
            'CNY' => '¥',
            'INR' => '₹',
            'BRL' => 'R$',
            'MXN' => 'MX$',
            'PLN' => 'zł',
            'SEK' => 'kr',
            'NOK' => 'kr',
            'DKK' => 'kr',
            'CZK' => 'Kč',
            'HUF' => 'Ft',
            'RON' => 'lei',
            'BGN' => 'лв',
            'HRK' => 'kn',
            'TRY' => '₺',
            'RUB' => '₽',
            'ZAR' => 'R',
            'NZD' => 'NZ$',
            'SGD' => 'S$',
            'HKD' => 'HK$',
            'KRW' => '₩',
            'THB' => '฿',
            'MYR' => 'RM',
            'PHP' => '₱',
            'IDR' => 'Rp',
            'VND' => '₫',
            'AED' => 'د.إ',
            'SAR' => '﷼',
            'ILS' => '₪',
            'EGP' => 'E£',
            'NGN' => '₦',
            'KES' => 'KSh',
            'GHS' => 'GH₵',
            'MAD' => 'د.م.',
            'TND' => 'د.ت',
            'XOF' => 'CFA',
            'XAF' => 'FCFA',
            default => strtoupper($currency ?? 'EUR')
        };
    }
@endphp

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Transactions</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Transactions</h1>
        <p class="page-subtitle">Gérez les transactions et le statut KYC des prestataires</p>
    </div>

    <!-- Filters -->
    <div class="admin-card" style="margin-bottom: 24px;">
        <div class="admin-card-body">
            <div style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 16px;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Pays</label>
                    <input type="text" id="country-filter" class="form-input" placeholder="FR, US, ..." style="width: 120px;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Mission</label>
                    <input type="text" id="mission-name-filter" class="form-input" placeholder="Nom de la mission" style="width: 180px;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Statut</label>
                    <input type="text" id="status-filter" class="form-input" placeholder="completed, pending..." style="width: 150px;">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Email prestataire</label>
                    <input type="text" id="email-filter" class="form-input" placeholder="email@exemple.com" style="width: 200px;">
                </div>
                <button id="filter-btn" class="btn btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Transaction Summary -->
    <div class="admin-card" style="margin-bottom: 24px;">
        <div class="admin-card-header">
            <h2 class="admin-card-title" style="display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="var(--admin-primary)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Transactions récentes
            </h2>
            <div id="transaction-count" style="font-size: 14px; color: var(--admin-text-muted);">
                Total : {{ $transactions->count() }} transactions
            </div>
        </div>
        <div class="admin-table-responsive">
            <table class="admin-table admin-table-mobile">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Mission</th>
                        <th>Prestataire</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th>Frais Ulixai</th>
                        <th>Frais prestataire</th>
                        <th>Statut</th>
                        <th>Pays</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="transaction-table-body">
                    @forelse($transactions as $txn)
                    <tr>
                        <td data-label="Date">
                            <div style="font-size: 14px; color: var(--admin-text);">{{ $txn->created_at->format('d M Y') }}</div>
                            <div style="font-size: 12px; color: var(--admin-text-muted);">{{ $txn->created_at->format('H:i') }}</div>
                        </td>
                        <td data-label="Mission">
                            <div style="font-size: 14px; font-weight: 500; color: var(--admin-text);">
                                {{ Str::limit($txn->mission->title ?? '-', 30) }}
                            </div>
                        </td>
                        <td data-label="Prestataire">
                            <div style="font-size: 14px; color: var(--admin-text);">{{ $txn->provider->first_name ?? '-' }}</div>
                            <div style="font-size: 12px; color: var(--admin-text-muted);">{{ $txn->provider->email ?? '-' }}</div>
                        </td>
                        <td data-label="Montant">
                            <div style="font-size: 14px; font-weight: 600; color: var(--admin-success);">{{ number_format($txn->amount_paid, 2, ',', ' ') }} {{ getCurrencySymbol($txn->currency) }}</div>
                        </td>
                        <td data-label="Devise">
                            <span class="badge badge-default" style="font-size: 12px;">{{ strtoupper($txn->currency ?? 'EUR') }}</span>
                        </td>
                        <td data-label="Frais Ulixai" style="font-size: 14px; color: var(--admin-text-secondary);">
                            {{ number_format($txn->client_fee, 2, ',', ' ') }} {{ getCurrencySymbol($txn->currency) }}
                        </td>
                        <td data-label="Frais prestataire" style="font-size: 14px; color: var(--admin-text-secondary);">
                            {{ number_format($txn->provider_fee, 2, ',', ' ') }} {{ getCurrencySymbol($txn->currency) }}
                        </td>
                        <td data-label="Statut">
                            @php
                                $statusBadge = match(strtolower($txn->status ?? '')) {
                                    'completed' => 'badge badge-success',
                                    'pending' => 'badge badge-warning',
                                    'failed' => 'badge badge-danger',
                                    default => 'badge badge-default'
                                };
                                $statusLabel = match(strtolower($txn->mission->payment_status ?? '')) {
                                    'completed', 'paid' => 'Payé',
                                    'pending' => 'En attente',
                                    'released' => 'Libéré',
                                    'refunded' => 'Remboursé',
                                    'failed' => 'Échoué',
                                    default => ucfirst($txn->mission->payment_status ?? '-')
                                };
                            @endphp
                            <span class="{{ $statusBadge }}">{{ $statusLabel }}</span>
                        </td>
                        <td data-label="Pays">
                            <div style="font-size: 14px; font-weight: 500; color: var(--admin-text);">{{ $txn->country }}</div>
                        </td>
                        <td data-label="Actions">
                            @if($txn->mission->payment_status !== 'released' && $txn->mission->payment_status !== 'refunded')
                                <button onclick="handleRefund({{ $txn->id }})" class="btn btn-ghost btn-sm" style="color: var(--admin-danger);" data-admin-tooltip="Rembourser">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                    </svg>
                                </button>
                            @else
                                <span class="badge badge-default">{{ $statusLabel }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="admin-empty-title">Aucune transaction trouvée</p>
                                <p class="admin-empty-description">Les transactions apparaîtront ici une fois créées</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- KYC/Stripe Status Section -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title" style="display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" fill="none" stroke="var(--admin-primary)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Statut Stripe/KYC des prestataires
            </h2>
            <div style="font-size: 14px; color: var(--admin-text-muted);">
                Total : {{ $providers->count() }} prestataires
            </div>
        </div>
        <div class="admin-table-responsive">
            <table class="admin-table admin-table-mobile">
                <thead>
                    <tr>
                        <th>Prestataire</th>
                        <th>Email</th>
                        <th>Compte Stripe</th>
                        <th>Charges</th>
                        <th>Payouts</th>
                        <th>Statut KYC</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($providers as $provider)
                    <tr>
                        <td data-label="Prestataire">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="admin-avatar admin-avatar-md">
                                    {{ substr($provider->first_name, 0, 1) }}{{ substr($provider->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: var(--admin-text);">
                                        {{ $provider->first_name }} {{ $provider->last_name }}
                                    </div>
                                    <div style="font-size: 12px; color: var(--admin-text-muted);">ID: {{ $provider->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email" style="font-size: 14px; color: var(--admin-text-secondary);">{{ $provider->email }}</td>
                        <td data-label="Compte Stripe">
                            @if($provider->stripe_account_id)
                                <code style="font-size: 12px; background: var(--admin-bg); padding: 4px 8px; border-radius: 4px; color: var(--admin-text-muted);">
                                    {{ Str::limit($provider->stripe_account_id, 15) }}
                                </code>
                            @else
                                <span style="color: var(--admin-text-light);">-</span>
                            @endif
                        </td>
                        <td data-label="Charges">
                            @if($provider->stripe_chg_enabled)
                                <span class="badge badge-success">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" style="margin-right: 4px;">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Activé
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" style="margin-right: 4px;">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    Désactivé
                                </span>
                            @endif
                        </td>
                        <td data-label="Payouts">
                            @if($provider->stripe_pts_enabled)
                                <span class="badge badge-success">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" style="margin-right: 4px;">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Activé
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" style="margin-right: 4px;">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    Désactivé
                                </span>
                            @endif
                        </td>
                        <td data-label="Statut KYC">
                            @php
                                $kycStatus = $provider->kyc_status ?? 'pending';
                                $kycBadge = match(strtolower($kycStatus)) {
                                    'verified' => 'badge badge-success',
                                    'pending' => 'badge badge-warning',
                                    'rejected' => 'badge badge-danger',
                                    'incomplete' => 'badge badge-info',
                                    default => 'badge badge-default'
                                };
                                $kycLabel = match(strtolower($kycStatus)) {
                                    'verified' => 'Vérifié',
                                    'pending' => 'En attente',
                                    'rejected' => 'Rejeté',
                                    'incomplete' => 'Incomplet',
                                    default => ucfirst($kycStatus)
                                };
                            @endphp
                            <span class="{{ $kycBadge }}">{{ $kycLabel }}</span>
                        </td>
                        <td data-label="Action">
                            @if(!$provider->stripe_chg_enabled || !$provider->stripe_pts_enabled)
                                <form method="POST" action="{{ route('admin.stripe.kyc.remind', $provider->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--admin-warning);" data-admin-tooltip="Rappel KYC">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.316 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Rappel
                                    </button>
                                </form>
                            @else
                                <span class="badge badge-success">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" style="margin-right: 4px;">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Complet
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="admin-empty-title">Aucun prestataire trouvé</p>
                                <p class="admin-empty-description">Les prestataires apparaîtront ici une fois inscrits</p>
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
// Helper function to convert currency code to symbol
function getCurrencySymbol(currency) {
    const symbols = {
        'EUR': '€', 'USD': '$', 'GBP': '£', 'CHF': 'CHF', 'CAD': 'CA$', 'AUD': 'A$',
        'JPY': '¥', 'CNY': '¥', 'INR': '₹', 'BRL': 'R$', 'MXN': 'MX$', 'PLN': 'zł',
        'SEK': 'kr', 'NOK': 'kr', 'DKK': 'kr', 'CZK': 'Kč', 'HUF': 'Ft', 'RON': 'lei',
        'BGN': 'лв', 'HRK': 'kn', 'TRY': '₺', 'RUB': '₽', 'ZAR': 'R', 'NZD': 'NZ$',
        'SGD': 'S$', 'HKD': 'HK$', 'KRW': '₩', 'THB': '฿', 'MYR': 'RM', 'PHP': '₱',
        'IDR': 'Rp', 'VND': '₫', 'AED': 'د.إ', 'SAR': '﷼', 'ILS': '₪', 'EGP': 'E£',
        'NGN': '₦', 'KES': 'KSh', 'GHS': 'GH₵', 'MAD': 'د.م.', 'TND': 'د.ت',
        'XOF': 'CFA', 'XAF': 'FCFA'
    };
    const code = (currency || 'EUR').toUpperCase();
    return symbols[code] || code;
}

document.getElementById('filter-btn').addEventListener('click', function() {
    let country = document.getElementById('country-filter').value;
    let missionName = document.getElementById('mission-name-filter').value;
    let status = document.getElementById('status-filter').value;
    let email = document.getElementById('email-filter').value;

    fetch('/api/transactions/filter?country=' + encodeURIComponent(country) + '&mission_name=' + encodeURIComponent(missionName) + '&status=' + encodeURIComponent(status) + '&email=' + encodeURIComponent(email))
        .then(response => response.json())
        .then(response => {
            // Handle paginated response format
            const data = response.data || response;
            const total = response.pagination?.total ?? data.length;

            let tableBody = document.getElementById('transaction-table-body');
            tableBody.innerHTML = '';

            document.getElementById('transaction-count').innerText = 'Total : ' + total + ' transactions';

            if (data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="10">
                            <div class="admin-empty-state">
                                <svg class="admin-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="admin-empty-title">Aucune transaction trouvée</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            data.forEach(txn => {
                const currencyCode = (txn.currency || 'EUR').toUpperCase();
                const currencySymbol = getCurrencySymbol(txn.currency);
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td data-label="Date">
                        <div style="font-size: 14px; color: var(--admin-text);">${new Date(txn.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}</div>
                    </td>
                    <td data-label="Mission">
                        <div style="font-size: 14px; font-weight: 500; color: var(--admin-text);">${txn.mission?.title || '-'}</div>
                    </td>
                    <td data-label="Prestataire">
                        <div style="font-size: 14px; color: var(--admin-text);">${txn.provider?.first_name || '-'}</div>
                        <div style="font-size: 12px; color: var(--admin-text-muted);">${txn.provider?.email || '-'}</div>
                    </td>
                    <td data-label="Montant">
                        <div style="font-size: 14px; font-weight: 600; color: var(--admin-success);">${Number(txn.amount_paid).toLocaleString('fr-FR', { minimumFractionDigits: 2 })} ${currencySymbol}</div>
                    </td>
                    <td data-label="Devise">
                        <span class="badge badge-default" style="font-size: 12px;">${currencyCode}</span>
                    </td>
                    <td data-label="Frais Ulixai" style="font-size: 14px; color: var(--admin-text-secondary);">${Number(txn.client_fee).toLocaleString('fr-FR', { minimumFractionDigits: 2 })} ${currencySymbol}</td>
                    <td data-label="Frais prestataire" style="font-size: 14px; color: var(--admin-text-secondary);">${Number(txn.provider_fee).toLocaleString('fr-FR', { minimumFractionDigits: 2 })} ${currencySymbol}</td>
                    <td data-label="Statut"><span class="badge badge-default">${txn.status || '-'}</span></td>
                    <td data-label="Pays" style="font-size: 14px; color: var(--admin-text);">${txn.country || '-'}</td>
                    <td data-label="Actions"></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Erreur lors du filtrage des transactions');
        });
});

function handleRefund(transactionId) {
    if (!confirm('Êtes-vous sûr de vouloir rembourser cette transaction ?')) {
        return;
    }

    fetch(`/api/admin/transactions/${transactionId}/refund`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            toastr.success('Transaction remboursée avec succès');
            location.reload();
        } else {
            toastr.error(data.message || 'Échec du remboursement');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        toastr.error('Échec du remboursement');
    });
}
</script>
@endpush
@endsection
