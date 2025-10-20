@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto py-8 px-4">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Create Fake Provider</h1>
        <p class="text-gray-600 text-sm">Add a new fake provider for testing purposes. Leave fields blank to let Faker auto-fill.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <form id="fakeProviderForm" method="POST" action="{{ route('admin.fake-content.create') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            <input type="hidden" name="type" value="provider">

            <!-- Batch Count -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">How many?</label>
                    <select name="count" id="countSelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="1" selected>1</option>
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Batch creation will auto-generate unique emails and can Faker-fill blanks.</p>
                </div>
                <div class="md:col-span-2"></div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                    <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Leave blank to use Faker">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo (optional)</label>
                    <input type="file" name="profile_photo"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           accept="image/*">
                </div>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone_number"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="+1 555 555 5555 (optional)">
                </div>

                <div></div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Communication Online</label>
                    <select name="communication_online" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Communication In Person</label>
                    <select name="communication_inperson" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <!-- Location & Languages -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select name="country" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Native Language</label>
                    <select name="native_language" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Language</label>
                    <select name="preferred_language" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Languages Spoken</label>
                    <select name="spoken_language[]" id="spoken_languages" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Leave empty for random 1–3 languages.</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Operational Countries
                    <small class="font-normal text-gray-500">(select at least 2, or leave empty for random)</small>
                </label>

                <div id="operationalCountriesChips" class="flex flex-wrap gap-2 mb-2"></div>

                <div class="relative">
                    <select multiple
                            name="operational_countries[]"
                            id="operational_countries"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-h-[300px]">
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}" class="border mt-2 bg-blue-100 hover:bg-blue-50 rounded p-2">{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Tip: Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</p>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" id="categorySelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Random</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subcategory</label>
                    <select name="subcategory_id" id="subcategorySelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Subcategory</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sub Subcategory</label>
                    <select name="subsubcategory_id" id="subsubcategorySelect" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Sub Subcategory</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Special Statuses</label>
                <div id="specialStatusesChips" class="flex flex-wrap gap-2 mb-2"></div>

                <div class="relative">
                    <select multiple
                            name="special_status[]"
                            id="special_statuses"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white min-h-[240px]">
                        @foreach($specialStatuses as $status)
                            <option value="{{ $status->stitle }}" class="border mt-2 bg-blue-100 hover:bg-blue-50 rounded p-2">{{ $status->stitle }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Leave empty to randomly assign 0–3 statuses.</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Description</label>
                <textarea name="profile_description" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Leave blank to auto-generate short description..."></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <button type="button" onclick="history.back()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Cancel
                </button>
                <button id="createProviderBtn" type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center">
                    <span class="btn-text">Create Provider</span>
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
