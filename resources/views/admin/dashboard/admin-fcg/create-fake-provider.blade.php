@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.fake-content-generation') }}">Fake Data</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Créer Prestataire</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Créer un prestataire de test</h1>
        <p class="page-subtitle">Ajoutez un nouveau prestataire pour les tests. Laissez vide pour générer automatiquement.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-card">
        <form id="fakeProviderForm" method="POST" action="{{ route('admin.fake-content.create') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            <input type="hidden" name="type" value="provider">

            <!-- Batch Count -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Combien ?</label>
                    <select name="count" id="countSelect" class="form-input">
                        <option value="1" selected>1</option>
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Création par lot : emails auto-générés.</p>
                </div>
                <div class="md:col-span-2"></div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Prénom</label>
                    <input type="text" name="first_name" id="first_name" class="form-input">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nom</label>
                    <input type="text" name="last_name" id="last_name" class="form-input">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Genre</label>
                    <select name="gender" class="form-input">
                        <option value="">Aléatoire</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                        <option value="other">Autre</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nom complet</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Laisser vide pour auto-générer">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Photo de profil (optionnel)</label>
                    <input type="file" name="profile_photo" class="form-input" accept="image/*">
                </div>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Numéro de téléphone</label>
                    <input type="text" name="phone_number" class="form-input" placeholder="+33 6 00 00 00 00 (optionnel)">
                </div>

                <div></div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Communication en ligne</label>
                    <select name="communication_online" class="form-input">
                        <option value="">Aléatoire</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Communication en personne</label>
                    <select name="communication_inperson" class="form-input">
                        <option value="">Aléatoire</option>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
            </div>

            <!-- Location & Languages -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Pays</label>
                    <select name="country" class="form-input">
                        <option value="">Aléatoire</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Langue maternelle</label>
                    <select name="native_language" class="form-input">
                        <option value="">Aléatoire</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Langue préférée</label>
                    <select name="preferred_language" class="form-input">
                        <option value="">Aléatoire</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Langues parlées</label>
                    <select name="spoken_language[]" id="spoken_languages" class="form-input">
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Laisser vide pour 1-3 langues aléatoires.</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-medium text-gray-500 mb-1">
                    Pays d'opération
                    <small class="font-normal text-gray-400">(au moins 2, ou laisser vide pour aléatoire)</small>
                </label>

                <div id="operationalCountriesChips" class="flex flex-wrap gap-2 mb-2"></div>

                <select multiple name="operational_countries[]" id="operational_countries" class="form-input min-h-[200px]">
                    @foreach($countries as $country)
                        <option value="{{ $country->country }}">{{ $country->country }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-400 mt-1">Conseil : Ctrl+clic (Windows) ou Cmd+clic (Mac) pour sélection multiple.</p>
            </div>

            <!-- Professional Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Catégorie</label>
                    <select name="category_id" id="categorySelect" class="form-input">
                        <option value="">Aléatoire</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Sous-catégorie</label>
                    <select name="subcategory_id" id="subcategorySelect" class="form-input">
                        <option value="">Sélectionner</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Sous-sous-catégorie</label>
                    <select name="subsubcategory_id" id="subsubcategorySelect" class="form-input">
                        <option value="">Sélectionner</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-medium text-gray-500 mb-1">Statuts spéciaux</label>
                <div id="specialStatusesChips" class="flex flex-wrap gap-2 mb-2"></div>

                <select multiple name="special_status[]" id="special_statuses" class="form-input min-h-[160px]">
                    @foreach($specialStatuses as $status)
                        <option value="{{ $status->stitle }}">{{ $status->stitle }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-400 mt-1">Laisser vide pour 0-3 statuts aléatoires.</p>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-medium text-gray-500 mb-1">Description du profil</label>
                <textarea name="profile_description" rows="4" class="form-input"
                          placeholder="Laisser vide pour auto-générer..."></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                <button type="button" onclick="history.back()" class="btn btn-secondary">Annuler</button>
                <button id="createProviderBtn" type="submit" class="btn btn-primary flex items-center">
                    <span class="btn-text">Créer le prestataire</span>
                    <svg class="btn-spinner animate-spin h-5 w-5 ml-2 hidden text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 100 16v-4l-3.5 3.5L12 24v-4a8 8 0 01-8-8z"></path>
                    </svg>
                </button>
            </div>

            <div id="providerMsg" class="mt-3 text-sm"></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-fill full name from first/last
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput  = document.getElementById('last_name');
    const fullNameInput  = document.getElementById('name');
    function updateFullName() {
        const firstName = firstNameInput.value.trim();
        const lastName  = lastNameInput.value.trim();
        fullNameInput.value = (firstName || lastName) ? `${firstName} ${lastName}`.trim() : fullNameInput.value;
    }
    firstNameInput.addEventListener('input', updateFullName);
    lastNameInput.addEventListener('input', updateFullName);

    // Category cascade
    document.getElementById('categorySelect').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategorySelect   = document.getElementById('subcategorySelect');
        const subsubcategorySelect= document.getElementById('subsubcategorySelect');

        subcategorySelect.innerHTML    = '<option value="">Select Subcategory</option>';
        subsubcategorySelect.innerHTML = '<option value="">Select Sub Subcategory</option>';

        if (categoryId) {
            subcategorySelect.innerHTML = '<option value="">Loading...</option>';
            fetch('/api/categories/' + categoryId + '/subcategories')
                .then(r => r.json())
                .then(data => {
                    subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                    (data.subcategories || []).forEach(sub => {
                        const opt = document.createElement('option');
                        opt.value = sub.id; opt.textContent = sub.name;
                        subcategorySelect.appendChild(opt);
                    });
                })
                .catch(() => subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>');
        }
    });

    document.getElementById('subcategorySelect').addEventListener('change', function() {
        const subId = this.value;
        const subsubcategorySelect = document.getElementById('subsubcategorySelect');
        subsubcategorySelect.innerHTML = '<option value="">Select Sub Subcategory</option>';

        if (subId) {
            subsubcategorySelect.innerHTML = '<option value="">Loading...</option>';
            fetch('/api/categories/' + subId + '/subcategories')
                .then(r => r.json())
                .then(data => {
                    subsubcategorySelect.innerHTML = '<option value="">Select Sub Subcategory</option>';
                    (data.subcategories || []).forEach(ss => {
                        const opt = document.createElement('option');
                        opt.value = ss.id; opt.textContent = ss.name;
                        subsubcategorySelect.appendChild(opt);
                    });
                })
                .catch(() => subsubcategorySelect.innerHTML = '<option value="">Error loading sub-subcategories</option>');
        }
    });

    // Chips for multi selects
    const ocSelect = document.getElementById('operational_countries');
    const ocChips  = document.getElementById('operationalCountriesChips');
    const ssSelect = document.getElementById('special_statuses');
    const ssChips  = document.getElementById('specialStatusesChips');

    function renderChips(selectEl, chipsEl) {
        chipsEl.innerHTML = '';
        Array.from(selectEl.selectedOptions).forEach(opt => {
            const chip = document.createElement('span');
            chip.className = 'inline-flex items-center gap-1 px-2 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs';
            chip.textContent = opt.textContent;
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'ml-1 rounded-full w-4 h-4 flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-700';
            btn.innerHTML = '&times;';
            btn.addEventListener('click', () => {
                opt.selected = false;
                selectEl.dispatchEvent(new Event('change', { bubbles: true }));
                renderChips(selectEl, chipsEl);
            });
            chip.appendChild(btn);
            chipsEl.appendChild(chip);
        });
    }
    renderChips(ocSelect, ocChips);
    renderChips(ssSelect, ssChips);
    ocSelect.addEventListener('change', () => renderChips(ocSelect, ocChips));
    ssSelect.addEventListener('change', () => renderChips(ssSelect, ssChips));

    // Button loading state
    const form       = document.getElementById('fakeProviderForm');
    const submitBtn  = document.getElementById('createProviderBtn');
    const btnText    = submitBtn.querySelector('.btn-text');
    const btnSpinner = submitBtn.querySelector('.btn-spinner');
    const msg        = document.getElementById('providerMsg');

    function setLoading(isLoading) {
        if (isLoading) {
            submitBtn.disabled = true;
            btnText.textContent = 'Creating...';
            btnSpinner.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            btnText.textContent = 'Create Provider';
            btnSpinner.classList.add('hidden');
        }
    }

    // Submit with FormData (keeps file upload)
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        msg.textContent = '';
        msg.className = 'mt-3 text-sm';
        setLoading(true);

        // Optional front-end check: suggest at least 2 operational countries when user manually selects
        if (ocSelect.selectedOptions.length > 0 && ocSelect.selectedOptions.length < 2) {
            setLoading(false);
            alert('Please select at least 2 operational countries, or leave empty for random.');
            ocSelect.focus();
            return;
        }

        try {
            const fd = new FormData(form); // includes _token, type=provider, and file
            const res = await fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: fd
            });
            const data = await res.json();

            if (!res.ok) {
                const errors = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Failed to create.');
                msg.textContent = errors;
                msg.classList.add('text-red-600');
                return;
            }

            if (data.success) {
                msg.textContent = data.created_count
                    ? `Created ${data.created_count} provider(s).`
                    : 'Fake provider created!';
                msg.classList.add('text-green-600');

                // Reset form (keep count)
                const currentCount = document.getElementById('countSelect').value;
                form.reset();
                document.getElementById('countSelect').value = currentCount;
                renderChips(ocSelect, ocChips);
                renderChips(ssSelect, ssChips);
            } else {
                msg.textContent = data.message || 'Failed to create provider.';
                msg.classList.add('text-red-600');
            }
        } catch (err) {
            console.error(err);
            msg.textContent = 'Network error.';
            msg.classList.add('text-red-600');
        } finally {
            setLoading(false);
        }
    });
});
</script>
@endsection
