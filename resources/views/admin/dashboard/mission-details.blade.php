@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.missions') }}">Missions</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Détails</span>
    </nav>

    <!-- Header Section -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Aperçu de la mission</h1>
        </div>
        <a href="{{ route('admin.missions') }}" class="btn btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux missions
        </a>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="admin-card p-8">
        <div class="flex items-center justify-center">
            <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-500 border-t-transparent"></div>
            <span class="ml-3 text-gray-600">Chargement des détails...</span>
        </div>
    </div>

    <!-- Mission Details Content -->
    <div id="missionContent" class="hidden space-y-6">
        <!-- Status and Quick Info Card -->
        <div class="admin-card p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4" id="quickInfo">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Mission Information -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Informations de la mission</h2>
                    </div>
                    <div class="p-6" id="missionInfo">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Description -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Description</h2>
                    </div>
                    <div class="p-6" id="missionDescription">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Transactions -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Historique des transactions</h2>
                    </div>
                    <div class="p-6" id="transactionHistory">
                        <!-- Dynamic content -->
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Participants -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Participants</h3>
                    </div>
                    <div class="p-6" id="participants">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Résumé financier</h3>
                    </div>
                    <div class="p-6" id="financialSummary">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Timeline -->
                <div class="admin-card">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Chronologie</h3>
                    </div>
                    <div class="p-6" id="timeline">
                        <!-- Dynamic content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error State -->
    <div id="errorState" class="hidden admin-card p-8">
        <div class="text-center">
            <svg class="h-12 w-12 text-red-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Échec du chargement</h3>
            <p class="text-gray-600 mb-4">Impossible de récupérer les détails de la mission. Veuillez réessayer.</p>
            <button onclick="loadMissionDetails()" class="btn btn-primary">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Réessayer
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function getStatusConfig(status) {
    const configs = {
        'completed': {
            class: 'badge-success',
            dot: 'bg-green-500',
            label: 'Terminé',
            icon: 'M5 13l4 4L19 7'
        },
        'in_progress': {
            class: 'badge-warning',
            dot: 'bg-yellow-500',
            label: 'En cours',
            icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
        },
        'pending': {
            class: 'badge-info',
            dot: 'bg-blue-500',
            label: 'En attente',
            icon: 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        },
        'published': {
            class: 'badge-primary',
            dot: 'bg-blue-600',
            label: 'Publié',
            icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
        },
        'cancelled': {
            class: 'badge-default',
            dot: 'bg-gray-500',
            label: 'Annulé',
            icon: 'M6 18L18 6M6 6l12 12'
        }
    };
    return configs[status] || configs['cancelled'];
}

function formatCurrency(amount, currency = 'EUR') {
    if (amount === null || amount === undefined) return '-';
    const currencyCode = currency || 'EUR';
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: currencyCode
    }).format(amount);
}

function formatDate(dateString, options = {}) {
    if (!dateString) return '-';
    const defaultOptions = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString('fr-FR', { ...defaultOptions, ...options });
}

function loadMissionDetails() {
    // Show loading state
    document.getElementById('loadingState').classList.remove('hidden');
    document.getElementById('missionContent').classList.add('hidden');
    document.getElementById('errorState').classList.add('hidden');

    fetch(`/api/admin/missions/{{ $missionId }}`)
        .then(res => {
            if (!res.ok) throw new Error('Failed to fetch mission details');
            return res.json();
        })
        .then(m => {
            const statusConfig = getStatusConfig(m.status);

            // Quick Info Section
            document.getElementById('quickInfo').innerHTML = `
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">${m.title || '(Sans titre)'}</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="h-2 w-2 ${statusConfig.dot} rounded-full mr-2"></div>
                            <span class="${statusConfig.class}">
                                <svg class="h-4 w-4 mr-1.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${statusConfig.icon}"></path>
                                </svg>
                                ${statusConfig.label}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">ID:</span> #${m.id}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.missions.conversation', $missionId) }}" class="btn btn-primary">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01
                                    M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.2-3.6A7.93 7.93 0 013 12
                                    c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        Conversations
                    </a>
                    <a href="{{ route('admin.missions.edit', $missionId) }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                </div>
            `;

            // Mission Information
            document.getElementById('missionInfo').innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Titre :</dt>
                            <dd class="text-sm text-gray-900 font-medium">${m.title || '(Sans titre)'}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Statut :</dt>
                            <dd><span class="${statusConfig.class}">${statusConfig.label}</span></dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Catégorie :</dt>
                            <dd class="text-sm text-gray-900">${m.category || 'Général'}</dd>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Créée le :</dt>
                            <dd class="text-sm text-gray-900">${formatDate(m.created_at)}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Modifiée le :</dt>
                            <dd class="text-sm text-gray-900">${formatDate(m.updated_at)}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-gray-500 w-24">Priorité :</dt>
                            <dd>
                                <span class="${
                                    (m.priority === 'high') ? 'badge-warning' :
                                    (m.priority === 'medium') ? 'badge-info' :
                                    'badge-success'
                                }">
                                    ${m.priority === 'high' ? 'Haute' : m.priority === 'medium' ? 'Moyenne' : 'Normale'}
                                </span>
                            </dd>
                        </div>
                    </div>
                </div>
            `;

            // Description
            document.getElementById('missionDescription').innerHTML = `
                <div class="prose prose-gray max-w-none">
                    ${m.description ?
                        `<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-700 leading-relaxed">${m.description}</div>` :
                        `<div class="text-center py-8 text-gray-400">
                            <svg class="h-12 w-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-sm">Aucune description fournie</p>
                        </div>`
                    }
                </div>
            `;

            // Participants
            document.getElementById('participants').innerHTML = `
                <div class="space-y-4">
                    <!-- Requester -->
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900">Demandeur</div>
                            <div class="text-sm text-gray-600">${m.requester?.name || 'Inconnu'}</div>
                            <div class="text-xs text-gray-500">${m.requester?.email || ''}</div>
                        </div>
                    </div>

                    <!-- Provider -->
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 ${m.selected_provider ? 'bg-green-100' : 'bg-gray-100'} rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 ${m.selected_provider ? 'text-green-600' : 'text-gray-400'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900">Prestataire</div>
                            <div class="text-sm text-gray-600">
                                ${m.selected_provider ?
                                    (m.selected_provider.first_name + ' ' + m.selected_provider.last_name) :
                                    '<span class="italic text-gray-400">Non assigné</span>'
                                }
                            </div>
                            <div class="text-xs text-gray-500">${m.selected_provider?.email || ''}</div>
                        </div>
                    </div>
                </div>
            `;

            // Financial Summary
            document.getElementById('financialSummary').innerHTML = `
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-700 mb-2">Fourchette budgétaire</div>
                        <div class="text-lg font-semibold text-gray-900">
                            ${formatCurrency(m.budget_min, m.budget_currency)} - ${formatCurrency(m.budget_max, m.budget_currency)}
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm text-gray-600">Statut du paiement</span>
                        <span class="text-sm font-medium ${
                            m.payment_status === 'paid' ? 'text-green-700' :
                            m.payment_status === 'pending' ? 'text-yellow-700' :
                            'text-gray-700'
                        }">
                            ${m.payment_status === 'paid' ? 'Payé' : m.payment_status === 'pending' ? 'En attente' : m.payment_status || 'Inconnu'}
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-gray-600">Total transactions</span>
                        <span class="text-sm font-medium text-gray-900">${(m.transactions || []).length}</span>
                    </div>
                </div>
            `;

            // Timeline
            document.getElementById('timeline').innerHTML = `
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 h-6 w-6 bg-blue-100 rounded-full flex items-center justify-center">
                            <div class="h-2 w-2 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">Mission créée</div>
                            <div class="text-xs text-gray-500">${formatDate(m.created_at, { hour: '2-digit', minute: '2-digit' })}</div>
                        </div>
                    </div>
                    ${m.selected_provider ? `
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 h-6 w-6 bg-green-100 rounded-full flex items-center justify-center">
                                <div class="h-2 w-2 bg-green-600 rounded-full"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">Prestataire assigné</div>
                                <div class="text-xs text-gray-500">${m.selected_provider.first_name} ${m.selected_provider.last_name}</div>
                            </div>
                        </div>
                    ` : ''}
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 h-6 w-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <div class="h-2 w-2 bg-gray-400 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">Dernière mise à jour</div>
                            <div class="text-xs text-gray-500">${formatDate(m.updated_at, { hour: '2-digit', minute: '2-digit' })}</div>
                        </div>
                    </div>
                </div>
            `;

            // Transaction History
            const transactions = m.transactions || [];
            if (transactions.length === 0) {
                document.getElementById('transactionHistory').innerHTML = `
                    <div class="text-center py-8">
                        <svg class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-sm text-gray-500">Aucune transaction enregistrée</p>
                        <p class="text-xs text-gray-400 mt-1">L'historique des transactions apparaîtra ici une fois les paiements effectués</p>
                    </div>
                `;
            } else {
                const transactionRows = transactions.map(t => `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900">#${t.id}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900">${formatCurrency(t.amount_paid, m.budget_currency)}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="${
                                t.status === 'completed' ? 'badge-success' :
                                t.status === 'pending' ? 'badge-warning' :
                                'badge-default'
                            }">
                                ${t.status === 'completed' ? 'Terminé' : t.status === 'pending' ? 'En attente' : t.status || 'Inconnu'}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-600">${formatDate(t.created_at, { month: 'short', day: 'numeric' })}</div>
                        </td>
                    </tr>
                `).join('');

                document.getElementById('transactionHistory').innerHTML = `
                    <div class="overflow-hidden">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${transactionRows}
                            </tbody>
                        </table>
                    </div>
                `;
            }

            // Show content, hide loading
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('missionContent').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading mission details:', error);

            // Show error state
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('missionContent').classList.add('hidden');
            document.getElementById('errorState').classList.remove('hidden');
        });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    loadMissionDetails();
});
</script>
@endpush
@endsection
