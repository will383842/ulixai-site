@extends('admin.dashboard.index')

@section('admin-content')
<div class="p-6">
    <!-- Header Section -->
    <div class="admin-card p-6 mb-6">
        <div class="flex items-center space-x-6">
            <div class="flex-shrink-0">
                <div class="h-16 w-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-2xl font-semibold text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900 truncate">{{ $user->name }}</h1>
                <p class="text-gray-600 text-sm mt-1">{{ $user->email }}</p>
                <div class="flex flex-wrap items-center gap-4 mt-2">
                    <span class="{{ $user->status == 'active' ? 'badge-success' : 'badge-warning' }}">
                        {{ $user->status == 'active' ? 'Actif' : 'Suspendu' }}
                    </span>
                    <span class="text-sm text-gray-500">{{ $user->user_role === 'service_requester' ? 'Demandeur' : 'Prestataire' }}</span>
                    @if($provider)
                    <div class="flex items-center space-x-2">
                        <label class="text-sm text-gray-500">Visibilité carte :</label>
                        <input type="checkbox" id="providerVisibilityToggle" data-provider-id="{{ $provider->id }}"
                            {{ $provider->provider_visibility ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-700" id="providerVisibilityLabel">
                            {{ $provider->provider_visibility ? 'Visible' : 'Masqué' }}
                        </span>
                    </div>
                    <button type="button" onclick="openCoordsModal({{ $provider->id }})" class="btn btn-primary py-1.5 text-xs">
                        Modifier coordonnées
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="admin-card mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button class="tab-link py-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm whitespace-nowrap focus:outline-none"
                        onclick="showTab(event, 'profile')" data-tab="profile">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil</span>
                    </div>
                </button>
                <button class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                        onclick="showTab(event, 'missions')" data-tab="missions">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Missions</span>
                    </div>
                </button>
                <button class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                        onclick="showTab(event, 'transactions')" data-tab="transactions">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Transactions</span>
                    </div>
                </button>
                <a href="{{ route('admin.users.edit-profile-view', $user->id) }}"
                   class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Modifier profil</span>
                    </div>
                </a>
            </nav>
        </div>
    </div>

    <!-- Profile Tab Content -->
    <div id="profile" class="tab-content">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- User Information -->
            <div class="lg:col-span-2">
                <div class="admin-card p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Informations utilisateur</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500">Nom complet</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Adresse email</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Pays</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->country ?? 'Non spécifié' }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Genre</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->gender ?? 'Non spécifié' }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-medium text-gray-500">Rôle</label>
                                <p class="text-sm text-gray-900 mt-1">{{ ucfirst($user->user_role) }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Langue préférée</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->preferred_language ?? 'Non spécifié' }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Code affilié</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->affiliate_code ?? 'Non assigné' }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-500">Membre depuis</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Management -->
            <div class="space-y-6">
                <div class="admin-card p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Statut du compte</h3>
                    <form method="POST" action="{{ route('admin.users.manage', $user->id) }}" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="status" class="block text-xs font-medium text-gray-500 mb-2">Statut</label>
                            <select name="status" id="status" class="form-input">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <button type="submit" class="btn btn-primary w-full">Mettre à jour</button>
                            @if($user->status == 'active')
                                <button type="submit" name="status" value="suspended" class="btn btn-ghost text-red-600 hover:bg-red-50 w-full">
                                    Suspendre
                                </button>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="admin-card p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Activité</h3>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Dernière connexion</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : 'Jamais' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($provider)
        <div class="mt-6">
            <div class="admin-card p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Informations prestataire</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Prénom</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->first_name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Nom</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->last_name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Langue maternelle</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->native_language }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Téléphone</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->phone_number }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Pays</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->country }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Statut Ulysse</label>
                        <p class="text-sm text-gray-900 mt-1">{{ $provider->ulysse_status }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Missions Tab Content -->
    <div id="missions" class="tab-content hidden">
        <div class="admin-card overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Missions</h3>
            </div>
            @if($missions->count())
                <div class="overflow-x-auto">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Mission</th>
                                <th>Statut</th>
                                <th>Paiement</th>
                                <th>Prestataire</th>
                                <th>Budget</th>
                                <th>Créée le</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($missions as $mission)
                            <tr>
                                <td>
                                    <div class="font-medium text-gray-900">#{{ $mission->id }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-xs">{{ $mission->title }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusConfig = [
                                            'completed' => 'badge-success',
                                            'in_progress' => 'badge-warning',
                                            'published' => 'badge-primary'
                                        ];
                                    @endphp
                                    <span class="{{ $statusConfig[$mission->status] ?? 'badge-default' }}">
                                        {{ ucfirst(str_replace('_', ' ', $mission->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="{{ $mission->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($mission->payment_status) }}
                                    </span>
                                </td>
                                <td class="text-sm text-gray-900">
                                    @if($mission->selectedProvider)
                                        {{ $mission->selectedProvider->first_name }} {{ $mission->selectedProvider->last_name }}
                                    @else
                                        <span class="text-gray-400">Non assigné</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-900">
                                    {{ $mission->budget_min }} - {{ $mission->budget_max }} {{ $mission->budget_currency }}
                                </td>
                                <td class="text-sm text-gray-500">
                                    {{ $mission->created_at->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    <button onclick="openMissionActionModal({{ $mission->id }})" class="btn btn-ghost text-blue-600 hover:bg-blue-50 py-1.5 text-xs">
                                        Gérer
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-500 text-sm font-medium">Aucune mission</p>
                    <p class="text-gray-400 text-xs mt-1">Cet utilisateur n'a pas encore créé de mission.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Transactions Tab Content -->
    <div id="transactions" class="tab-content hidden">
        <div class="admin-card overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Transactions</h3>
            </div>
            @if($transactions->count())
                <div class="overflow-x-auto">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Mission</th>
                                <th>Prestataire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td class="font-medium text-gray-900">#{{ $transaction->id }}</td>
                                <td class="font-medium text-gray-900">{{ $transaction->getFormattedAmount() }}</td>
                                <td>
                                    <span class="{{ $transaction->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="text-sm text-gray-900">
                                    @if($transaction->mission)
                                        <div class="truncate max-w-xs">{{ $transaction->mission->title }}</div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-900">
                                    @if($transaction->provider)
                                        {{ $transaction->provider->first_name }} {{ $transaction->provider->last_name }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-gray-500 text-sm font-medium">Aucune transaction</p>
                    <p class="text-gray-400 text-xs mt-1">Cet utilisateur n'a pas encore effectué de transaction.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Affiliate Tab -->
    <div id="affiliate" class="tab-content hidden">
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Comptes affiliés</h3>
            </div>
            <div class="p-6">
                <form id="affiliate-filters-form" method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                    <input type="date" name="date" value="{{ request('date') }}" class="form-input" placeholder="Date">
                    <input type="text" name="country" value="{{ request('country') }}" class="form-input" placeholder="Pays">
                    <select name="role" class="form-input">
                        <option value="">Rôle</option>
                        <option value="service_requester" {{ request('role')=='service_requester'?'selected':'' }}>Demandeur</option>
                        <option value="service_provider" {{ request('role')=='service_provider'?'selected':'' }}>Prestataire</option>
                    </select>
                    <input type="text" name="language" value="{{ request('language') }}" class="form-input" placeholder="Langue">
                    <select name="influencer" class="form-input">
                        <option value="">Influenceur</option>
                        <option value="1" {{ request('influencer')=='1'?'selected':'' }}>Oui</option>
                        <option value="0" {{ request('influencer')=='0'?'selected':'' }}>Non</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
                <div id="affiliate-accounts-content">
                    @php
                        $referredUsers = \App\Models\User::where('referred_by', $user->id)
                            ->when(request('date'), fn($q) => $q->whereDate('created_at', request('date')))
                            ->when(request('country'), fn($q) => $q->where('country', request('country')))
                            ->when(request('role'), fn($q) => $q->where('user_role', request('role')))
                            ->when(request('language'), fn($q) => $q->where('preferred_language', request('language')))
                            ->get();
                    @endphp
                    @include('admin.dashboard.partials.affiliate-accounts-table', ['referredUsers' => $referredUsers])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Action Modal -->
<div id="missionActionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="admin-card w-full max-w-md mx-4">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-900">Gérer la mission</h3>
                <button onclick="closeMissionActionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <form id="missionActionForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            <input type="hidden" name="mission_id" id="modal_mission_id" value="">
            <div>
                <label for="modal_status" class="block text-xs font-medium text-gray-500 mb-2">Statut</label>
                <select name="status" id="modal_status" class="form-input">
                    <option value="published">Publié</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                    <option value="cancelled">Annulé</option>
                    <option value="disputed">En litige</option>
                    <option value="waiting_to_start">En attente</option>
                </select>
            </div>
            <div>
                <label for="modal_payment_status" class="block text-xs font-medium text-gray-500 mb-2">Statut paiement</label>
                <select name="payment_status" id="modal_payment_status" class="form-input">
                    <option value="unpaid">Non payé</option>
                    <option value="paid">Payé</option>
                    <option value="held">Retenu</option>
                    <option value="released">Libéré</option>
                </select>
            </div>
            <div>
                <label for="modal_selected_provider_id" class="block text-xs font-medium text-gray-500 mb-2">Assigner un prestataire</label>
                <select name="selected_provider_id" id="modal_selected_provider_id" class="form-input">
                    <option value="">-- Sélectionner --</option>
                    @foreach(\App\Models\ServiceProvider::all() as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->first_name }} {{ $prov->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeMissionActionModal()" class="btn btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@if($provider)
@php
    $countryCoords = $provider->country_coords ? preg_replace('/[\[\]]/', '', $provider->country_coords) : '';
    $cityCoords = $provider->city_coords ? preg_replace('/[\[\]]/', '', $provider->city_coords) : '';
@endphp
<div id="coordsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="admin-card w-full max-w-md mx-4 p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Coordonnées de localisation</h3>
        <form id="coordsForm">
            @csrf
            <input type="hidden" id="coordsProviderId" value="{{$provider->id}}">
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-500 mb-1">Coordonnées ville (lat, lng)</label>
                <input type="text" value="{{$cityCoords}}" id="cityCoordsInput" name="city_coords" class="form-input" placeholder="ex: 48.8566, 2.3522">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-500 mb-1">Coordonnées pays (lat, lng)</label>
                <input type="text" value="{{ $countryCoords }}" id="countryCoordsInput" name="country_coords" class="form-input" placeholder="ex: 46.6034, 1.8883">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeCoordsModal()" class="btn btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endif

@push('scripts')
<script>
function showTab(evt, tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-link').forEach(el => {
        el.classList.remove('border-blue-500', 'text-blue-600');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    var tabContent = document.getElementById(tabId);
    if (tabContent) tabContent.classList.remove('hidden');
    if (evt && evt.currentTarget) {
        evt.currentTarget.classList.remove('border-transparent', 'text-gray-500');
        evt.currentTarget.classList.add('border-blue-500', 'text-blue-600');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const firstTab = document.querySelector('.tab-link');
    if (firstTab) firstTab.click();
    // Add affiliate tab
    if (!document.querySelector('[data-tab="affiliate"]')) {
        let nav = document.querySelector('nav[aria-label="Tabs"]');
        if (nav) {
            let btn = document.createElement('button');
            btn.className = 'tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none';
            btn.setAttribute('onclick', "showTab(event, 'affiliate')");
            btn.setAttribute('data-tab', 'affiliate');
            btn.innerHTML = `<div class="flex items-center space-x-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>Affiliés</span></div>`;
            nav.appendChild(btn);
        }
    }
});

function openMissionActionModal(missionId) {
    document.getElementById('modal_mission_id').value = missionId;
    document.getElementById('missionActionForm').action = '/admin/missions/' + missionId + '/manage';
    document.getElementById('missionActionModal').classList.remove('hidden');
}
function closeMissionActionModal() {
    document.getElementById('missionActionModal').classList.add('hidden');
}
document.getElementById('missionActionModal').addEventListener('click', function(e) {
    if (e.target === this) closeMissionActionModal();
});

function openCoordsModal(providerId) { document.getElementById('coordsModal').classList.remove('hidden'); }
function closeCoordsModal() { document.getElementById('coordsModal').classList.add('hidden'); }

document.getElementById('coordsForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    var providerId = document.getElementById('coordsProviderId').value;
    var cityCoords = document.getElementById('cityCoordsInput').value.split(',').map(Number);
    var countryCoords = document.getElementById('countryCoordsInput').value.split(',').map(Number);
    fetch('/api/admin/provider/' + providerId + '/update-coords', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({
            city_coords: cityCoords.length === 2 ? JSON.stringify(cityCoords) : null,
            country_coords: countryCoords.length === 2 ? JSON.stringify(countryCoords) : null
        })
    })
    .then(res => res.json())
    .then(data => { toastr.success('Coordonnées mises à jour'); closeCoordsModal(); location.reload(); })
    .catch(() => toastr.error('Échec de la mise à jour'));
});

document.getElementById('providerVisibilityToggle')?.addEventListener('change', function() {
    var providerId = this.dataset.providerId;
    var label = document.getElementById('providerVisibilityLabel');
    this.disabled = true;
    fetch('/api/admin/provider/' + providerId + '/toggle-visibility', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(data => { if (data.success) label.textContent = data.visible ? 'Visible' : 'Masqué'; })
    .finally(() => { document.getElementById('providerVisibilityToggle').disabled = false; });
});
</script>
@endpush
@endsection
