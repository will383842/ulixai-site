@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Fake Data</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Contenu de test</h1>
        <p class="page-subtitle">Gérez les demandeurs, prestataires et missions de test</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.fake-content.create-requester-form') }}" class="admin-card p-6 hover:shadow-md transition-all hover:border-blue-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Créer un demandeur</h3>
                        <p class="mt-1 text-sm text-gray-500">Ajouter un demandeur de test</p>
                    </div>
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.fake-content.create-provider-form') }}" class="admin-card p-6 hover:shadow-md transition-all hover:border-blue-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Créer un prestataire</h3>
                        <p class="mt-1 text-sm text-gray-500">Ajouter un prestataire de test</p>
                    </div>
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.fake-content.create-mission-form') }}" class="admin-card p-6 hover:shadow-md transition-all hover:border-blue-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Créer une mission</h3>
                        <p class="mt-1 text-sm text-gray-500">Ajouter une mission de test</p>
                    </div>
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Fake Requesters Section -->
    <div class="admin-card mb-8">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Demandeurs de test</h2>
            <p class="text-sm text-gray-500 mt-1">Liste de tous les demandeurs de test</p>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr id="requester-row-{{ $user->id }}">
                        <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'requester', 'id' => $user->id]) }}">
                            @csrf
                            <td class="text-sm font-medium text-gray-900">{{ $user->id }}</td>
                            <td><input name="name" value="{{ $user->name }}" class="form-input"></td>
                            <td><input name="email" value="{{ $user->email }}" class="form-input"></td>
                            <td>
                                <select name="status" class="form-input">
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                                </select>
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <button type="submit" class="btn btn-primary text-xs">Modifier</button>
                                    <button type="button" class="btn btn-ghost text-red-600 hover:bg-red-50 text-xs ajax-delete-btn"
                                            data-type="requester" data-id="{{ $user->id }}">Supprimer</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Fake Providers Section -->
    <div class="admin-card mb-8">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Prestataires de test</h2>
            <p class="text-sm text-gray-500 mt-1">Liste de tous les prestataires de test</p>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Pays</th>
                        <th>Points</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($providers as $provider)
                    <tr id="provider-row-{{ $provider->id }}">
                        <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'provider', 'id' => $provider->id]) }}">
                            @csrf
                            <td class="text-sm font-medium text-gray-900">{{ $provider->id }}</td>
                            <td>
                                <div class="flex space-x-2">
                                    <input name="first_name" value="{{ $provider->first_name }}" class="form-input" placeholder="Prénom">
                                    <input name="last_name" value="{{ $provider->last_name }}" class="form-input" placeholder="Nom">
                                </div>
                            </td>
                            <td><input name="country" value="{{ $provider->country }}" class="form-input"></td>
                            <td><input name="points" value="{{ $provider->points }}" type="number" class="form-input w-20"></td>
                            <td>
                                <select name="status" class="form-input">
                                    <option value="active" {{ $provider->user->status == 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="suspended" {{ $provider->user->status == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                                </select>
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <button type="submit" class="btn btn-primary text-xs">Modifier</button>
                                    <button type="button" class="btn btn-ghost text-red-600 hover:bg-red-50 text-xs ajax-delete-btn"
                                            data-type="provider" data-id="{{ $provider->id }}">Supprimer</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Fake Missions Section -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Missions de test</h2>
            <p class="text-sm text-gray-500 mt-1">Liste de toutes les missions de test</p>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Demandeur</th>
                        <th>Pays</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($missions as $mission)
                    <tr id="mission-row-{{ $mission->id }}">
                        <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'mission', 'id' => $mission->id]) }}">
                            @csrf
                            <td class="text-sm font-medium text-gray-900">{{ $mission->id }}</td>
                            <td><input name="title" value="{{ $mission->title }}" class="form-input"></td>
                            <td class="text-sm text-gray-900">{{ $mission->requester_id }}</td>
                            <td><input name="location_country" value="{{ $mission->location_country }}" class="form-input"></td>
                            <td>
                                <select name="status" class="form-input">
                                    <option value="published" {{ $mission->status == 'published' ? 'selected' : '' }}>Publié</option>
                                    <option value="in_progress" {{ $mission->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                    <option value="completed" {{ $mission->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                                    <option value="cancelled" {{ $mission->status == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <button type="submit" class="btn btn-primary text-xs">Modifier</button>
                                    <button type="button" class="btn btn-ghost text-red-600 hover:bg-red-50 text-xs ajax-delete-btn"
                                            data-type="mission" data-id="{{ $mission->id }}">Supprimer</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ajax-delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm('Delete this ' + btn.dataset.type + '?')) return;
            const type = btn.dataset.type;
            const id = btn.dataset.id;
            fetch("{{ url('admin/fake-content-generation') }}/" + type + "/" + id + "/delete", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Contenu supprimé avec succès', 'Succès');
                    document.getElementById(type + '-row-' + id).remove();
                } else {
                    alert(data.message || 'Échec de la suppression.');
                }
            })
            .catch(() => alert('Échec de la suppression.'));
        });
    });
});
</script>
@endpush
@endsection