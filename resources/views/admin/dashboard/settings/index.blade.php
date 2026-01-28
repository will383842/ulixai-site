@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Paramètres</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Paramètres du site</h1>
        <p class="page-subtitle">Configuration générale et informations légales</p>
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

    <!-- Quick Links -->
    <div class="admin-card p-4 mb-6">
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Gérer FAQ
            </a>
            <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Conditions d'utilisation
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.settings') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- Site Configuration Section -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Configuration du site</h2>
                        <p class="text-sm text-gray-500">Informations générales et branding</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Nom du site</label>
                    <input
                        type="text"
                        id="site_name"
                        name="site_name"
                        value="{{ old('site_name', $settings->site_name ?? '') }}"
                        class="form-input"
                        placeholder="Entrez le nom du site"
                        required
                    >
                </div>
            </div>
        </div>

        <!-- Legal Information Section -->
        <div class="admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-50 mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Mentions légales</h2>
                        <p class="text-sm text-gray-500">Informations juridiques et conformité</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div>
                    <label for="legal_info" class="block text-sm font-medium text-gray-700 mb-2">Contenu des mentions légales</label>
                    <p class="text-xs text-gray-500 mb-3">Le HTML est supporté (h1, h2, h3, p, ul, li, strong, em, a, etc.)</p>
                    <textarea
                        id="legal_info"
                        name="legal_info"
                        class="form-input font-mono text-sm"
                        rows="16"
                        placeholder="Entrez le contenu des mentions légales. Vous pouvez utiliser du HTML..."
                    >@php
    $legalValue = old('legal_info', $settings->legal_info ?? '');
    if (is_array($legalValue)) {
        $legalValue = json_encode($legalValue, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    echo $legalValue;
@endphp</textarea>
                    <p class="text-xs text-gray-500 mt-2">Conseil : Utilisez des balises HTML sémantiques pour une meilleure structure</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3 pt-4">
            <button
                type="button"
                class="btn btn-secondary"
                onclick="window.location.reload()"
            >
                Annuler
            </button>
            <button type="submit" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
