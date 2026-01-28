@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Rôles & Permissions</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Rôles & Permissions</h1>
        <p class="page-subtitle">Gérez les administrateurs et leurs droits d'accès</p>
    </div>

    @if(session('success'))
        <div class="admin-card border-l-4 border-green-500 p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-green-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="admin-card border-l-4 border-red-500 p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-red-700 font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="admin-card border-l-4 border-red-500 p-4 mb-6">
            <ul class="list-disc list-inside text-red-700 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create New Admin Form (Only for Super Admin) -->
    @if(auth()->user()->user_role === 'super_admin')
    <div class="admin-card mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Créer un nouvel administrateur</h2>
        </div>
        <div class="p-6">
            <form id="createAdminForm" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-500 mb-1">Nom complet</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="form-input"
                           placeholder="Entrez le nom"
                           required>
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-gray-500 mb-1">Adresse email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-input"
                           placeholder="Entrez l'email"
                           required>
                </div>

                <div>
                    <label for="user_role" class="block text-xs font-medium text-gray-500 mb-1">Rôle</label>
                    <select id="user_role"
                            name="user_role"
                            class="form-input"
                            required>
                        <option value="">Sélectionner un rôle</option>
                        <option value="regional_admin" {{ old('user_role') == 'regional_admin' ? 'selected' : '' }}>Admin régional</option>
                        <option value="moderator" {{ old('user_role') == 'moderator' ? 'selected' : '' }}>Modérateur</option>
                        <option value="super_admin" {{ old('user_role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-gray-500 mb-1">Mot de passe</label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-input"
                           placeholder="Entrez le mot de passe"
                           required>
                </div>

                <div class="md:col-span-2 lg:col-span-4">
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Créer l'administrateur
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Existing Admins Table -->
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Administrateurs existants</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Administrateur</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{ $admin->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $admin->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td>
                            @php
                                $roleConfig = [
                                    'super_admin' => ['class' => 'badge-info', 'label' => 'Super Admin'],
                                    'regional_admin' => ['class' => 'badge-primary', 'label' => 'Admin Régional'],
                                    'moderator' => ['class' => 'badge-warning', 'label' => 'Modérateur']
                                ];
                                $config = $roleConfig[$admin->user_role] ?? ['class' => 'badge-default', 'label' => ucfirst($admin->user_role)];
                            @endphp
                            <span class="{{ $config['class'] }}">{{ $config['label'] }}</span>
                        </td>

                        <td class="text-sm text-gray-500">
                            {{ $admin->created_at ? $admin->created_at->format('d M Y') : 'N/A' }}
                        </td>

                        <td>
                            @if(auth()->user()->user_role === 'super_admin' || (auth()->user()->user_role === 'regional_admin' && $admin->user_role === 'moderator'))
                                <!-- Update Role Form -->
                                <form method="POST" data-admin-id="{{ $admin->id }}" class="inline-flex items-center gap-2 assignRoleForm">
                                    @csrf
                                    <select name="user_role" class="form-input py-1.5 text-sm">
                                        @if(auth()->user()->user_role === 'super_admin')
                                            <option value="super_admin" {{ $admin->user_role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                        @endif
                                        <option value="regional_admin" {{ $admin->user_role == 'regional_admin' ? 'selected' : '' }}>Admin Régional</option>
                                        <option value="moderator" {{ $admin->user_role == 'moderator' ? 'selected' : '' }}>Modérateur</option>
                                    </select>

                                    <input type="password"
                                           name="password"
                                           placeholder="Nouveau mdp (opt.)"
                                           class="form-input py-1.5 text-sm w-32">

                                    <button type="submit" class="btn btn-primary py-1.5 text-sm">
                                        Modifier
                                    </button>
                                </form>

                                <!-- Revoke Role Button -->
                                @if($admin->user_role !== 'super_admin' && $admin->id !== auth()->user()->id)
                                <form method="POST" data-admin-id="{{ $admin->id }}" class="revokeRoleForm inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost text-red-600 hover:bg-red-50 py-1.5 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Révoquer
                                    </button>
                                </form>
                                @endif
                            @else
                                <span class="text-gray-400 text-xs">Aucune permission</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Aucun administrateur trouvé</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Role Permissions Info -->
    <div class="mt-6 admin-card bg-blue-50 border-blue-200">
        <div class="p-6">
            <h3 class="font-semibold text-blue-900 mb-4">Description des rôles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg border-l-4 border-purple-500">
                    <h4 class="font-semibold text-purple-700 mb-2">Super Admin</h4>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Accès complet au système</li>
                        <li>• Gestion de tous les admins</li>
                        <li>• Configuration système</li>
                        <li>• Gestion de tout le contenu</li>
                    </ul>
                </div>

                <div class="bg-white p-4 rounded-lg border-l-4 border-blue-500">
                    <h4 class="font-semibold text-blue-700 mb-2">Admin Régional</h4>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Gestion du contenu régional</li>
                        <li>• Création/gestion modérateurs</li>
                        <li>• Gestion utilisateurs région</li>
                        <li>• Rapports régionaux</li>
                    </ul>
                </div>

                <div class="bg-white p-4 rounded-lg border-l-4 border-yellow-500">
                    <h4 class="font-semibold text-yellow-700 mb-2">Modérateur</h4>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Modération de contenu</li>
                        <li>• Support utilisateurs</li>
                        <li>• Rapports basiques</li>
                        <li>• Actions limitées</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function showToast(msg, type = 'success') {
        if (typeof toastr !== 'undefined') {
            toastr[type](msg);
        } else {
            alert(msg);
        }
    }

    // CREATE ADMIN AJAX
    const createAdminForm = document.getElementById('createAdminForm');
    if (createAdminForm) {
        createAdminForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(createAdminForm);
            fetch('{{ route("admin.roles-permissions.create") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Administrateur créé avec succès !', 'success');
                    setTimeout(() => window.location.reload(), 1200);
                } else {
                    showToast('Erreur : ' + (data.error || 'Échec de la validation.'), 'error');
                }
            })
            .catch(err => showToast('Erreur : ' + err, 'error'));
        });
    }

    // ASSIGN ROLE AJAX
    document.querySelectorAll('.assignRoleForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const adminId = form.getAttribute('data-admin-id');
            const formData = new FormData(form);
            fetch(`/admin/roles-permissions/${adminId}/assign`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Rôle mis à jour !', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Erreur : ' + (data.error || 'Échec de la validation.'), 'error');
                }
            })
            .catch(err => showToast('Erreur : ' + err, 'error'));
        });
    });

    // REVOKE ROLE AJAX
    document.querySelectorAll('.revokeRoleForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!confirm('Êtes-vous sûr de vouloir révoquer ce rôle admin ? Cette action est irréversible.')) return;
            const adminId = form.getAttribute('data-admin-id');
            fetch(`/admin/roles-permissions/${adminId}/revoke`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Rôle révoqué !', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Erreur : ' + (data.error || 'Échec de la validation.'), 'error');
                }
            })
            .catch(err => showToast('Erreur : ' + err, 'error'));
        });
    });
});
</script>
@endpush
@endsection
