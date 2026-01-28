<!-- Commission Settings Partial -->
<div class="admin-card mb-6">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Paramètres de commission
        </h3>
    </div>
    <form method="POST" action="{{ route('admin.commission.update') }}" class="p-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Commission client (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="client_fee" value="{{ config('ulixai.fees.client', 5) }}" class="form-input" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Commission prestataire (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="provider_fee" value="{{ config('ulixai.fees.provider', 15) }}" class="form-input" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Commission affilié (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="affiliate_fee" value="{{ config('ulixai.fees.affiliate', 30) }}" class="form-input" required>
            </div>
        </div>
        <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
            <button type="submit" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Mettre à jour
            </button>
        </div>
    </form>
</div>

<!-- Affiliate Program Summary -->
<div class="admin-card">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-900">Programme d'affiliation</h3>
    </div>
    <div class="p-6">
        <div class="space-y-3">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Taux affilié</span>
                <span class="font-semibold text-gray-900">{{ config('ulixai.fees.affiliate', 30) }}%</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-sm text-gray-600">Période d'éligibilité</span>
                <span class="font-semibold text-gray-900">30 jours</span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-sm text-gray-600">Rôle affilié</span>
                <span class="font-semibold text-gray-900">Tous</span>
            </div>
        </div>
    </div>
</div>
