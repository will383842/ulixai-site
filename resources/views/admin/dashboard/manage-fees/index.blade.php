@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Commissions</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Gestion des commissions</h1>
        <p class="page-subtitle">Configurez et gérez les taux de commission pour les différents types d'utilisateurs</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="admin-card">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Configuration des commissions
                    </h2>
                </div>

                <form action="{{ route('admin.manage-fee.update', $commission) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Service Requester Fee -->
                        <div>
                            <label for="requester_fee" class="block text-xs font-medium text-gray-500 mb-2">
                                Commission demandeur de service
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" min="0" max="100"
                                       name="requester_fee"
                                       id="requester_fee"
                                       value="{{ old('requester_fee', $commission->requester_fee) }}"
                                       class="form-input pr-12"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">%</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Frais facturés aux utilisateurs demandant des services</p>
                        </div>

                        <!-- Service Provider Fee -->
                        <div>
                            <label for="provider_fee" class="block text-xs font-medium text-gray-500 mb-2">
                                Commission prestataire de service
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" min="0" max="100"
                                       name="provider_fee"
                                       id="provider_fee"
                                       value="{{ old('provider_fee', $commission->provider_fee) }}"
                                       class="form-input pr-12"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">%</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Frais facturés aux prestataires de services</p>
                        </div>

                        <!-- Affiliate Fee -->
                        <div>
                            <label for="affiliate_fee" class="block text-xs font-medium text-gray-500 mb-2">
                                Commission affiliation
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" min="0" max="100"
                                       name="affiliate_fee"
                                       id="affiliate_fee"
                                       value="{{ old('affiliate_fee', $commission->affiliate_fee) }}"
                                       class="form-input pr-12"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">%</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Frais alloués aux partenaires affiliés</p>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-xs font-medium text-gray-500 mb-2">
                                Description & Notes
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      placeholder="Ajoutez des notes sur ces taux de commission..."
                                      class="form-input">{{ old('description', $commission->description) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Notes optionnelles pour référence interne</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Mettre à jour les commissions
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="space-y-6">
            <!-- Commission Overview Card -->
            <div class="admin-card p-6">
                <h3 class="font-semibold text-gray-900 flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Taux actuels
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Demandeurs</span>
                        <span class="font-semibold text-blue-600">{{ $commission->requester_fee }}%</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Prestataires</span>
                        <span class="font-semibold text-green-600">{{ $commission->provider_fee }}%</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-gray-600">Affiliés</span>
                        <span class="font-semibold text-orange-600">{{ $commission->affiliate_fee }}%</span>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-blue-900 mb-2">Guide des commissions</h3>
                        <div class="space-y-2 text-sm text-blue-800">
                            <p><strong>Demandeurs :</strong> Frais lors de la réservation de services</p>
                            <p><strong>Prestataires :</strong> Commission sur les services effectués</p>
<p><strong>Affiliés :</strong> Commissions de parrainage</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
