{{-- filepath: d:\xampp\htdocs\ulixia-2\resources\views\admin\dashboard\mission-edit.blade.php --}}
@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-slate-50 py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6">
            <nav class="flex items-center space-x-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('admin.missions') }}" class="hover:text-slate-700 transition-colors">Missions</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.missions.show', $mission->id) }}" class="hover:text-slate-700 transition-colors">Mission Details</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900">Edit</span>
            </nav>
            
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Edit Mission</h1>
                    <p class="mt-1 text-sm text-slate-600">Update mission details and configuration</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.missions.update', $mission->id) }}" class="space-y-6">
            @csrf
            
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                        Basic Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Mission Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title', $mission->title) }}" 
                                class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                placeholder="Enter mission title..."
                                required
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Mission Status</label>
                            <div class="relative">
                                <select name="status" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" required>
                                    @php
                                        $statusOptions = [
                                            'published' => ['label' => 'Published', 'color' => 'text-blue-600'],
                                            'waiting_to_start' => ['label' => 'Waiting to Start', 'color' => 'text-purple-600'],
                                            'in_progress' => ['label' => 'In Progress', 'color' => 'text-yellow-600'],
                                            'completed' => ['label' => 'Completed', 'color' => 'text-green-600'],
                                            'disputed' => ['label' => 'Disputed', 'color' => 'text-red-600'],
                                            'cancelled' => ['label' => 'Cancelled', 'color' => 'text-slate-600']
                                        ];
                                    @endphp
                                    @foreach($statusOptions as $value => $config)
                                        <option value="{{ $value }}" @if($mission->status == $value) selected @endif>
                                            {{ $config['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Payment Status</label>
                            <div class="relative">
                                <select name="payment_status" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" required>
                                    @php
                                        $paymentStatusOptions = [
                                            'unpaid' => 'Unpaid',
                                            'paid' => 'Paid',
                                            'held' => 'Held',
                                            'released' => 'Released',
                                            'refunded' => 'Refunded'
                                        ];
                                    @endphp
                                    @foreach($paymentStatusOptions as $value => $label)
                                        <option value="{{ $value }}" @if($mission->payment_status == $value) selected @endif>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Service Duration -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Service Duration</label>
                            <div class="relative">
                                <select name="service_durition" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                    <option value="">Select duration...</option>
                                    <option value="1 week" {{ old('service_durition', $mission->service_durition) == '1 week' ? 'selected' : '' }}>1 Week</option>
                                    <option value="2 weeks" {{ old('service_durition', $mission->service_durition) == '2 weeks' ? 'selected' : '' }}>2 Weeks</option>
                                    <option value="1 month" {{ old('service_durition', $mission->service_durition) == '1 month' ? 'selected' : '' }}>1 Month</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Location Country -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Location Country</label>
                            <div class="relative">
                                <select name="location_country" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                    <option value="">Select a Country...</option>
                                    @php 
                                        $countries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
                                    @endphp
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ old('location_country', $mission->location_country) == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Language</label>
                            <div class="relative">
                                <select name="language" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                    <option value="">Select a Language...</option>
                                    @php 
                                        $languages = ['English','French','Spanish','Portuguese','German','Italian','Arabic','Japanese','Korean','Hindi','Turkish'];
                                    @endphp
                                    @foreach($languages as $language)
                                        <option value="{{ $language }}" {{ old('language', $mission->language) == $language ? 'selected' : '' }}>
                                            {{ $language }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Selection Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                        Category Selection
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Category -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Main Category</label>
                            <div class="relative">
                                <select name="category_id" id="mainCategorySelect" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" required>
                                    <option value="">Select Category...</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" @if($mission->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Subcategory -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Subcategory</label>
                            <div class="relative">
                                <select name="subcategory_id" id="subCategorySelect" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors disabled:bg-slate-50 disabled:text-slate-500">
                                    <option value="">Select Subcategory...</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Sub Subcategory -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Sub Subcategory</label>
                            <div class="relative">
                                <select name="subsubcategory_id" id="subSubCategorySelect" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors disabled:bg-slate-50 disabled:text-slate-500" disabled>
                                    <option value="">Select Sub Subcategory...</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment & Provider Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                        Assignment & Provider
                    </h2>
                </div>
                <div class="p-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Assigned Provider</label>
                        <div class="relative">
                            <select name="selected_provider_id" class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <option value="">-- No Provider Assigned --</option>
                                @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}" @if($mission->selected_provider_id == $provider->id) selected @endif>
                                        {{ $provider->first_name }} {{ $provider->last_name }}
                                        @if($provider->email)
                                            ({{ $provider->email }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Select a provider to assign this mission to a specific service provider</p>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                        Mission Description
                    </h2>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Detailed Description</label>
                    <textarea 
                        name="description" 
                        rows="6" 
                        class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none"
                        placeholder="Provide a detailed description of the mission requirements, objectives, and any specific instructions..."
                    >{{ old('description', $mission->description) }}</textarea>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="text-xs text-slate-500">Provide clear and detailed information to help providers understand the requirements</p>
                        <span class="text-xs text-slate-400" id="charCount">0 characters</span>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.missions.show', $mission->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categories = @json($categories);
    const mainCategorySelect = document.getElementById('mainCategorySelect');
    const subCategorySelect = document.getElementById('subCategorySelect');
    const subSubCategorySelect = document.getElementById('subSubCategorySelect');
    const selectedMain = "{{ $mission->category_id }}";
    const selectedSub = "{{ $mission->subcategory_id }}";
    const selectedSubSub = "{{ $mission->subsubcategory_id }}";
    const descriptionTextarea = document.querySelector('textarea[name="description"]');
    const charCount = document.getElementById('charCount');

    // Character counter for description
    function updateCharCount() {
        const count = descriptionTextarea.value.length;
        charCount.textContent = `${count} characters`;
        
        if (count > 500) {
            charCount.classList.add('text-amber-600');
            charCount.classList.remove('text-slate-400');
        } else {
            charCount.classList.remove('text-amber-600');
            charCount.classList.add('text-slate-400');
        }
    }

    if (descriptionTextarea && charCount) {
        descriptionTextarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }

    function populateSubcategories() {
        const mainId = parseInt(mainCategorySelect.value);
        subCategorySelect.innerHTML = '<option value="">Select Subcategory...</option>';
        subSubCategorySelect.innerHTML = '<option value="">Select Sub Subcategory...</option>';
        
        // Enable/disable subcategory select
        if (mainId) {
            subCategorySelect.disabled = false;
            subCategorySelect.classList.remove('disabled:bg-slate-50', 'disabled:text-slate-500');
        } else {
            subCategorySelect.disabled = true;
            subSubCategorySelect.disabled = true;
            subCategorySelect.classList.add('disabled:bg-slate-50', 'disabled:text-slate-500');
            subSubCategorySelect.classList.add('disabled:bg-slate-50', 'disabled:text-slate-500');
            return;
        }

        const mainCat = categories.find(c => c.id == mainId);
        if (mainCat && mainCat.subcategories) {
            mainCat.subcategories.forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.textContent = sub.name;
                if (selectedSub && sub.id == selectedSub) opt.selected = true;
                subCategorySelect.appendChild(opt);
            });
        }
        populateSubSubcategories();
    }

    function populateSubSubcategories() {
        const mainId = parseInt(mainCategorySelect.value);
        const subId = parseInt(subCategorySelect.value);
        subSubCategorySelect.innerHTML = '<option value="">Select Sub Subcategory...</option>';
        
        // Enable/disable sub subcategory select
        if (subId) {
            subSubCategorySelect.disabled = false;
            subSubCategorySelect.classList.remove('disabled:bg-slate-50', 'disabled:text-slate-500');
        } else {
            subSubCategorySelect.disabled = true;
            subSubCategorySelect.classList.add('disabled:bg-slate-50', 'disabled:text-slate-500');
            return;
        }

        if (!mainId) return;
        
        const mainCat = categories.find(c => c.id == mainId);
        if (mainCat && mainCat.subcategories) {
            const subCat = mainCat.subcategories.find(s => s.id == subId);
            if (subCat && subCat.sub_sub_categories) {
                subCat.sub_sub_categories.forEach(subsub => {
                    const opt = document.createElement('option');
                    opt.value = subsub.id;
                    opt.textContent = subsub.name;
                    if (selectedSubSub && subsub.id == selectedSubSub) opt.selected = true;
                    subSubCategorySelect.appendChild(opt);
                });
            }
        }
    }

    // Event listeners for category selection
    mainCategorySelect.addEventListener('change', function() {
        populateSubcategories();
        updateCategoryHints();
    });
    
    subCategorySelect.addEventListener('change', function() {
        populateSubSubcategories();
        updateCategoryHints();
    });

    subSubCategorySelect.addEventListener('change', function() {
        updateCategoryHints();
    });

    // Update category selection hints
    function updateCategoryHints() {
        const mainId = mainCategorySelect.value;
        const subId = subCategorySelect.value;
        const subSubId = subSubCategorySelect.value;

        // Add visual feedback for selection progress
        const indicators = document.querySelectorAll('.category-indicator');
        indicators.forEach(indicator => indicator.remove());

        if (mainId) {
            addCategoryIndicator(mainCategorySelect.parentElement, 'selected');
        }
        if (subId) {
            addCategoryIndicator(subCategorySelect.parentElement, 'selected');
        }
        if (subSubId) {
            addCategoryIndicator(subSubCategorySelect.parentElement, 'selected');
        }
    }

    function addCategoryIndicator(parent, type) {
        const indicator = document.createElement('div');
        parent.style.position = 'relative';
        parent.appendChild(indicator);
    }

    // Form validation and enhancement
    function validateForm() {
        const requiredFields = document.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            const parent = field.closest('div');
            const existingError = parent.querySelector('.field-error');
            
            if (existingError) {
                existingError.remove();
            }
            
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-300', 'focus:ring-red-500');
                field.classList.remove('border-slate-300', 'focus:ring-blue-500');
                
                const errorMsg = document.createElement('p');
                errorMsg.className = 'field-error mt-1 text-sm text-red-600';
                errorMsg.textContent = 'This field is required';
                parent.appendChild(errorMsg);
            } else {
                field.classList.remove('border-red-300', 'focus:ring-red-500');
                field.classList.add('border-slate-300', 'focus:ring-blue-500');
            }
        });
        
        return isValid;
    }

    // Form submission handling
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            
            // Scroll to first error
            const firstError = document.querySelector('.field-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            // Show loading state on submit button
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `;
            
            // Reset button after 5 seconds if form submission fails
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 5000);
        }
    });

    // Initial population of categories
    if (selectedMain) {
        mainCategorySelect.value = selectedMain;
        populateSubcategories();
        if (selectedSub) {
            subCategorySelect.value = selectedSub;
            populateSubSubcategories();
        }
        if (selectedSubSub) {
            subSubCategorySelect.value = selectedSubSub;
        }
        updateCategoryHints();
    }

    // Add smooth animations for form interactions
    const formElements = document.querySelectorAll('input, select, textarea');
    formElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.parentElement.classList.add('transform', 'scale-[1.02]');
        });
        
        element.addEventListener('blur', function() {
            this.parentElement.classList.remove('transform', 'scale-[1.02]');
        });
    });
});
</script>

<style>
/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Form element transitions */
input, select, textarea {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

button {
    transition: all 0.15s ease-in-out;
}

button:hover:not(:disabled) {
    transform: translateY(-1px);
}

button:active {
    transform: translateY(0);
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Card hover effects */
.bg-white {
    transition: box-shadow 0.15s ease-in-out;
}

/* Focus enhancement */
.scale-\[1\.02\] {
    transform: scale(1.02);
    transition: transform 0.15s ease-in-out;
}

/* Custom scrollbar */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Success states */
.field-success {
    border-color: #10b981;
}

.field-success:focus {
    ring-color: #10b981;
    border-color: #10b981;
}

/* Error states */
.field-error {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid-cols-1 {
        gap: 1rem;
    }
    
    .lg\\:col-span-2 {
        grid-column: span 1;
    }
    
    .lg\\:grid-cols-3 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
}

/* Form section animations */
.bg-white {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Status indicator animations */
.category-indicator {
    animation: popIn 0.2s ease-out;
}

@keyframes popIn {
    from {
        opacity: 0;
        transform: scale(0);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Improved select styling */
select {
    background-image: none;
}

/* Loading button state */
button:disabled .animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection