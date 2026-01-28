@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.settings') }}">Paramètres</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Conditions générales</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Conditions générales</h1>
        <p class="page-subtitle">Modifiez les conditions générales d'utilisation de la plateforme</p>
    </div>

    <form id="termsForm">
        <!-- Terms & Conditions -->
        <div class="admin-card mb-6">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Conditions générales d'utilisation
                </h2>
                <p class="text-sm text-gray-500 mt-1">Modifiez le texte complet des conditions ci-dessous</p>
            </div>

            <div class="p-6">
                <div>
                    <label for="content" class="block text-xs font-medium text-gray-500 mb-2">
                        Contenu des conditions générales
                    </label>
                    <textarea id="content" name="content"
                        class="form-input font-mono text-sm"
                        rows="25" placeholder="Écrivez vos conditions générales ici..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">
                        Astuce : Vous pouvez utiliser le formatage HTML comme &lt;h2&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;p&gt;, etc.
                    </p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-4">
            <span id="saveMsg" class="text-sm text-gray-500"></span>
            <button type="button" id="cancelBtn" class="btn btn-secondary">
                Annuler
            </button>
            <button type="submit" id="saveBtn" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Enregistrer
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
(() => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const form = document.getElementById('termsForm');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveBtn = document.getElementById('saveBtn');
    const saveMsg = document.getElementById('saveMsg');
    const contentField = document.getElementById('content');

    let sectionId = null;

    async function load() {
        saveMsg.textContent = 'Chargement...';
        try {
            const res = await fetch(`{{ route('admin.terms.fetch') }}`);
            const data = await res.json();
            if (!data.success) throw new Error('fetch failed');

            const section = (data.sections || [])[0];
            sectionId = section?.id ?? null;
            contentField.value = typeof section?.body === 'string' ? section.body : '';

            saveMsg.textContent = '';
        } catch (e) {
            console.error(e);
            saveMsg.textContent = 'Erreur de chargement';
        }
    }

    async function saveAll(e) {
        e.preventDefault();
        saveBtn.disabled = true;
        saveMsg.textContent = 'Enregistrement...';

        const payload = {
            id: sectionId ?? null,
            number: 1,
            title: 'Terms and Conditions',
            body: contentField.value || '',
            is_active: 1,
            slug: 'terms-and-conditions',
            version: null,
            effective_date: null,
        };

        try {
            const res = await fetch(`{{ route('admin.terms.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            }).then(r => r.json());

            if (res?.success && res.section) {
                sectionId = res.section.id;
            }

            saveMsg.textContent = 'Enregistré';
            toastr.success('Conditions générales enregistrées');
            setTimeout(() => saveMsg.textContent = '', 1500);
        } catch (e) {
            console.error(e);
            saveMsg.textContent = 'Échec de l\'enregistrement';
            toastr.error('Échec de l\'enregistrement');
        } finally {
            saveBtn.disabled = false;
        }
    }

    function cancel() {
        load();
    }

    form.addEventListener('submit', saveAll);
    cancelBtn.addEventListener('click', cancel);
    load();
})();
</script>
@endpush
@endsection
