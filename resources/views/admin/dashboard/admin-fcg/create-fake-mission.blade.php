@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="space-x-3 mb-2">
                <h1 class="text-3xl font-bold text-gray-900">Create Fake Mission</h1>
            </div>
            <p class="text-gray-600">Fill out the form below to create a new fake mission for testing purposes.</p>
        </div>
        <!-- Main Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form method="POST" action="{{ route('admin.fake-content.create') }}" class="divide-y divide-gray-200">
                @csrf
                <input type="hidden" name="type" value="mission">

                <!-- Mission Requester Section -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mission Requester
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="requester_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select a requester...</option>
                                @foreach($fakeRequesters as $requester)
                                    <option value="{{ $requester->id }}">
                                        {{ $requester->name }} (ID: {{ $requester->id }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-7">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="p-6 space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Category
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="category_id" id="categorySelect" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subcategory</label>
                            <select name="subcategory_id" id="subcategorySelect" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50"
                                    disabled>
                                <option value="">Select subcategory...</option>
                            </select>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sub-subcategory</label>
                            <select name="subsubcategory_id" id="subsubcategorySelect"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50"
                                    disabled>
                                <option value="">Select sub-subcategory...</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Mission Details Section -->
                <div class="p-6 space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mission Title
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text" name="title" required
                                   placeholder="Enter a descriptive mission title..."
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Duration</label>
                            <div class="relative">
                                <select name="service_durition"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white appearance-none">
                                    <option value="">Select duration...</option>
                                    <option value="1 week">1 Week</option>
                                    <option value="2 weeks">2 Weeks</option>
                                    <option value="1 month">1 Month</option>
                                    <option value="2 months">2 Months</option>
                                    <option value="3 months">3 Months</option>
                                    <option value="6 months">6 Months</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mission Description</label>
                        <div class="relative">
                            <textarea name="description" rows="4" 
                                      placeholder="Provide a detailed description of the mission requirements, objectives, and expected deliverables..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical"></textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                Optional but recommended
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location & Language Section -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Service Country
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="location_country" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select country...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service City</label>
                            <input type="text" name="location_city"
                                   placeholder="Enter city name..."
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Language Required</label>
                            <select name="language"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select language...</option>
                                @foreach($languages as $lang)
                                    <option value="{{ $lang }}">{{ $lang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Service Type & Budget Section -->
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Service Type</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="is_remote" value="1" class="rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-3 text-sm font-medium text-gray-700">Remote Work</span>
                                    <div class="ml-auto">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="in_person" value="1" class="rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
                                    <span class="ml-3 text-sm font-medium text-gray-700">In-Person Service</span>
                                    <div class="ml-auto">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Budget Range</label>
                            <div class="space-y-3">
                                <div class="relative">
                                    <input type="number" name="budget_min" placeholder="Minimum budget"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 text-sm">EUR</span>
                                    </div>
                                </div>
                                <div class="relative">
                                    <input type="number" name="budget_max" placeholder="Maximum budget"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 text-sm">EUR</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Currency</label>
                            <div class="relative">
                                <select name="budget_currency"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white appearance-none">
                                    <option value="EUR">EUR (Euro)</option>
                                    <!-- <option value="USD">USD (US Dollar)</option>
                                    <option value="GBP">GBP (British Pound)</option> -->
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Default currency for all missions</p>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        All required fields must be completed before submission
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="history.back()"
                                class="px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Mission
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Tips for Creating Missions</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Use descriptive titles that clearly indicate the mission's purpose</li>
                        <li>• Select the most specific category available to improve discoverability</li>
                        <li>• Include both remote and in-person options when applicable</li>
                        <li>• Set realistic budget ranges based on market standards</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const subsubcategorySelect = document.getElementById('subsubcategorySelect');

    // Category change handler
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        
        // Reset and disable subsequent dropdowns
        subcategorySelect.innerHTML = '<option value="">Select subcategory...</option>';
        subsubcategorySelect.innerHTML = '<option value="">Select sub-subcategory...</option>';
        
        if (categoryId) {
            subcategorySelect.disabled = false;
            subcategorySelect.classList.remove('bg-gray-50');
            subcategorySelect.classList.add('bg-white');
            
            fetch(`/api/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    data.subcategories.forEach(subcat => {
                        const option = document.createElement('option');
                        option.value = subcat.id;
                        option.textContent = subcat.name;
                        subcategorySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching subcategories:', error);
                });
        } else {
            subcategorySelect.disabled = true;
            subcategorySelect.classList.remove('bg-white');
            subcategorySelect.classList.add('bg-gray-50');
            subsubcategorySelect.disabled = true;
            subsubcategorySelect.classList.remove('bg-white');
            subsubcategorySelect.classList.add('bg-gray-50');
        }
    });

    // Subcategory change handler
    subcategorySelect.addEventListener('change', function() {
        const subcategoryId = this.value;
        
        subsubcategorySelect.innerHTML = '<option value="">Select sub-subcategory...</option>';
        
        if (subcategoryId) {
            subsubcategorySelect.disabled = false;
            subsubcategorySelect.classList.remove('bg-gray-50');
            subsubcategorySelect.classList.add('bg-white');
            
            fetch(`/api/categories/${subcategoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    data.subcategories.forEach(subsubcat => {
                        const option = document.createElement('option');
                        option.value = subsubcat.id;
                        option.textContent = subsubcat.name;
                        subsubcategorySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching sub-subcategories:', error);
                });
        } else {
            subsubcategorySelect.disabled = true;
            subsubcategorySelect.classList.remove('bg-white');
            subsubcategorySelect.classList.add('bg-gray-50');
        }
    });

    // Form validation feedback
    const form = document.querySelector('form');
    const requiredFields = form.querySelectorAll('[required]');
    
    form.addEventListener('submit', function(e) {
        let hasErrors = false;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'ring-red-500');
                hasErrors = true;
            } else {
                field.classList.remove('border-red-500', 'ring-red-500');
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            // Scroll to first error
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });

    // Real-time validation
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-500', 'ring-red-500');
            }
        });
    });
});
</script>

<style>
.transition-colors {
    transition-property: color, background-color, border-color;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.appearance-none {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

select:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

.resize-vertical {
    resize: vertical;
}
</style>
@endsection