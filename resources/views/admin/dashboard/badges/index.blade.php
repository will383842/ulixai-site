@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Badges</span>
    </nav>

    <!-- Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Gestion des badges</h1>
            <p class="page-subtitle">Créez et gérez les badges et récompenses utilisateurs</p>
        </div>
        <span class="badge badge-info">{{ $badges->count() }} badges au total</span>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success" style="margin-bottom: 24px;">
            <svg class="admin-alert-icon" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Create Badge Form -->
    <div class="admin-card mb-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Créer un nouveau badge</h2>
            <p class="text-sm text-gray-500 mt-1">Ajoutez un nouveau badge au système</p>
        </div>

        <form method="POST" action="{{ route('admin.badges') }}" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Titre *</label>
                    <input name="title" class="form-input" placeholder="Titre du badge" required>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Slug</label>
                    <input name="slug" class="form-input" placeholder="slug-auto-genere">
                </div>

                <!-- Icon -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Icône</label>
                    <input name="icon" class="form-input" placeholder="icon.svg">
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Type *</label>
                    <select name="type" class="form-input" required>
                        <option value="reputation" selected>Réputation</option>
                        <option value="achievement">Accomplissement</option>
                        <option value="special">Spécial</option>
                        <option value="milestone">Jalon</option>
                    </select>
                </div>

                <!-- Threshold -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Seuil</label>
                    <input name="threshold" type="number" min="0" class="form-input" placeholder="0">
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Ordre de tri</label>
                    <input name="sort_order" type="number" class="form-input" placeholder="0" value="0">
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="flex flex-wrap gap-6 mt-6 pt-6 border-t border-gray-100">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Badge actif</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_auto" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Attribution automatique</span>
                </label>
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Créer le badge
                </button>
            </div>
        </form>
    </div>

    <!-- Badge List -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Badges existants</h2>
            <p class="text-sm text-gray-500 mt-1">Gérez vos badges actuels</p>
        </div>

        @if($badges->count() > 0)
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Badge</th>
                            <th>Détails</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($badges as $badge)
                        <tr data-badge-id="{{ $badge->id }}">
                            <form method="POST" action="{{ route('admin.badges') }}" class="contents badge-form">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $badge->id }}">

                                <td>
                                    <div class="space-y-2">
                                        <input name="title" value="{{ $badge->title }}" class="form-input text-sm" placeholder="Titre">
                                        <input name="slug" value="{{ $badge->slug }}" placeholder="Slug" class="form-input text-sm">
                                    </div>
                                </td>

                                <td>
                                    <div class="space-y-2">
                                        <input name="icon" value="{{ $badge->icon }}" placeholder="Icône" class="form-input text-sm">
                                        <div class="grid grid-cols-2 gap-2">
                                            <select name="type" class="form-input text-sm">
                                                <option value="reputation" {{ $badge->type === 'reputation' ? 'selected' : '' }}>Réputation</option>
                                                <option value="achievement" {{ $badge->type === 'achievement' ? 'selected' : '' }}>Accomplissement</option>
                                                <option value="special" {{ $badge->type === 'special' ? 'selected' : '' }}>Spécial</option>
                                                <option value="milestone" {{ $badge->type === 'milestone' ? 'selected' : '' }}>Jalon</option>
                                            </select>
                                            <input name="threshold" type="number" value="{{ $badge->threshold }}" placeholder="Seuil" class="form-input text-sm">
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="space-y-2">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="is_active" value="1" {{ $badge->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700">Actif</span>
                                        </label>
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" name="is_auto" value="1" {{ $badge->is_auto ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700">Auto</span>
                                        </label>
                                    </div>
                                </td>

                                <td>
                                    <div class="flex flex-col space-y-2">
                                        <button type="submit" class="btn btn-primary text-xs">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            Modifier
                                        </button>
                            </form>

                            <form method="POST" action="{{ route('admin.badges') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce badge ?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $badge->id }}">
                                <button type="submit" class="btn btn-ghost text-red-600 hover:bg-red-50 text-xs w-full">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="text-gray-500 text-sm font-medium">Aucun badge</p>
                <p class="text-gray-400 text-xs mt-1">Commencez par créer un nouveau badge</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            if (!slugInput.value || slugInput.placeholder.includes('auto')) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });
    }

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('input[name="title"]');
            if (title && !title.value.trim()) {
                e.preventDefault();
                toastr.error('Veuillez entrer un titre de badge');
                title.focus();
            }
        });
    });
});
</script>
@endpush
@endsection
