@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-light text-gray-900">Profile Management</h1>
                    <p class="text-sm text-gray-600 mt-1">Update user profile information</p>
                </div>
                <a href="{{ route('admin.users.manage', $user->id) }}" class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">
                        {{ ucfirst(str_replace('_', ' ', $user->user_role)) }}
                    </span>
                </a>
            </div>
        </div>
        @php
            $countries = $country ?? [];
            $languages = ['English','French','Spanish','Portuguese','German','Italian','Arabic','Japanese','Korean','Hindi','Turkish'];
            $specialStatuses = [
                'Expatriates for 2 to 5 years',
                'Expatriates for 6 to 10 years',
                'Expatriates for more than 10 years',
                'Lawyer',
                'Legal advice',
                'Insurer',
                'Real estate agent',
                'Translator',
                'Guide',
                'Language teacher',
            ];
            if($provider) {
                    $allCategories = \App\Models\Category::where('level', 1)
                ->with(['subcategories' => function ($query) {
                    $query->where('level', 2)
                        ->with(['subcategories' => function ($q) {
                            $q->where('level', 3); 
                        }]);
                }])
                ->get();
                $selectedStatuses = $selectedStatuses = $provider->special_status ? json_decode($provider->special_status, true) : [];

                $selectedCategories = is_array($provider->services_to_offer ?? null) ? $provider->services_to_offer : (json_decode($provider->services_to_offer, true) ?? []);
                $selectedSubcategories = is_array($provider->services_to_offer_category ?? null) ? $provider->services_to_offer_category : (json_decode($provider->services_to_offer_category, true) ?? []);
                $selectedSubSubcategories = is_array($provider->services_to_offer_subcategory ?? null) ? $provider->services_to_offer_subcategory : (json_decode($provider->services_to_offer_subcategory, true) ?? []);
            }
            
        @endphp
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if($user->user_role === 'service_requester')
            <!-- Service Requester Form -->
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-lg font-medium text-gray-900">Personal Information</h2>
                <p class="text-sm text-gray-500 mt-1">Basic profile details</p>
            </div>
            
            <form method="POST" action="{{ route('admin.users.update-profile', $user->id) }}" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="dob" value="{{ $user->dob ?? '' }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select Gender</option>
                                <option value="male" @if($user->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if($user->gender == 'female') selected @endif>Female</option>
                                <option value="other" @if($user->gender == 'other') selected @endif>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <select name="country" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country }}" @if($user->country == $country->country) selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Language</label>
                            <select name="preferred_language" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                @foreach($languages as $lang)
                                    <option value="{{ $lang }}" @if($user->preferred_language == $lang) selected @endif>{{ $lang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        Save Changes
                    </button>
                </div>
            </form>
            
            @elseif($provider)
            <!-- Service Provider Form -->
            <div class="px-8 py-6 border-b border-gray-100">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="/{{ $provider->profile_photo ?? '/images/default-avatar.png' }}" 
                             alt="Profile Photo" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-blue-100 shadow-sm">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-lg font-medium text-gray-900">{{ $provider->first_name }} {{ $provider->last_name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Service Provider Profile</p>
                        @if($selectedStatuses)
                            <div class="flex flex-wrap gap-2 mt-3">
                                @foreach($selectedStatuses as $status => $value)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $status }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('admin.providers.edit-profile', $provider->id) }}" class="p-8">
                @csrf
                @method('PATCH')
                
                <!-- Basic Information -->
                <div class="mb-10">
                    <h3 class="text-base font-medium text-gray-900 mb-6">Basic Information</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ $provider->first_name }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ $provider->last_name }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <select name="country" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country }}" @if($provider->country == $country->country) selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Service Address</label>
                            <select name="provider_address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country }}" @if($provider->provider_address == $country->country) selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Language</label>
                            <select name="preferred_language" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                @foreach($languages as $lang)
                                    <option value="{{ $lang }}" @if($provider->preferred_language == $lang) selected @endif>{{ $lang }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ $provider->phone_number }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Description</label>
                        <textarea name="profile_description" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                  placeholder="Brief description of your professional background and expertise...">{{ $provider->profile_description }}</textarea>
                    </div>
                </div>
                
                <!-- Communication Preferences -->
                <div class="mb-10">
                    <h3 class="text-base font-medium text-gray-900 mb-6">Communication Preferences</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Online Communication</label>
                            <div class="flex space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="communication_online" value="1" @if($provider->communication_online) checked @endif 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Available</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="communication_online" value="0" @if(!$provider->communication_online) checked @endif 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Not Available</span>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">In-Person Communication</label>
                            <div class="flex space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="communication_inperson" value="1" @if($provider->communication_inperson) checked @endif 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Available</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="communication_inperson" value="0" @if(!$provider->communication_inperson) checked @endif 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Not Available</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Special Status -->
                <div class="mb-10">
                    <h3 class="text-base font-medium text-gray-900 mb-6">Special Status & Qualifications</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Select applicable statuses</label>
                        <div id="specialStatusContainer" class="space-y-2">
                            @foreach($specialStatuses as $status)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="special_status[]" value="{{ $status }}" 
                                       @if(in_array($status, $selectedStatuses)) checked @endif
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <span class="ml-3 text-sm text-gray-700">{{ $status }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Services Categories -->
                <div class="mb-10">
                    <h3 class="text-base font-medium text-gray-900 mb-6">Service Categories</h3>
                    
                    <!-- Categories Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Main Categories</label>
                        <div id="categoriesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($allCategories as $cat)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-all duration-200">
                                <input type="checkbox" name="services_to_offer[]" value="{{ $cat->id }}" 
                                       @if(in_array($cat->id, $selectedCategories)) checked @endif
                                       class="category-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                       data-category-id="{{ $cat->id }}">
                                <span class="ml-3 text-sm text-gray-700 font-medium">{{ $cat->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Subcategories Selection -->
                    <div id="subcategoriesSection" class="mb-6" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Subcategories</label>
                        <div id="subcategoriesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Sub-subcategories Selection -->
                    <div id="subsubcategoriesSection" class="mb-6" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-3"></label>
                        <div id="subsubcategoriesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                          
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                        Save Changes
                    </button>
                </div>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const allCategories = @json($allCategories);
                    const selectedCategories = @json($selectedCategories);
                    const selectedSubcategories = @json($selectedSubcategories);
                    const selectedSubSubcategories = @json($selectedSubSubcategories);
                    
                    const subcategoriesSection = document.getElementById('subcategoriesSection');
                    const subcategoriesContainer = document.getElementById('subcategoriesContainer');
                    const subsubcategoriesSection = document.getElementById('subsubcategoriesSection');
                    const subsubcategoriesContainer = document.getElementById('subsubcategoriesContainer');
                    
                    function updateSubcategories() {
                        const selectedCategoryIds = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                            .map(cb => parseInt(cb.value));
                        
                        subcategoriesContainer.innerHTML = '';
                        
                        if (selectedCategoryIds.length === 0) {
                            subcategoriesSection.style.display = 'none';
                            subsubcategoriesSection.style.display = 'none';
                            return;
                        }
                        
                        subcategoriesSection.style.display = 'block';
                        
                        let subcategories = [];
                        allCategories.forEach(cat => {
                            if (selectedCategoryIds.includes(cat.id) && cat.subcategories) {
                                cat.subcategories.forEach(sub => {
                                    subcategories.push(sub);
                                });
                            }
                        });
                        
                        subcategories.forEach(sub => {
                            const label = document.createElement('label');
                            label.className = 'flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-all duration-200';
                            
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'services_to_offer_category[]';
                            checkbox.value = sub.id;
                            checkbox.className = 'subcategory-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded';
                            checkbox.setAttribute('data-subcategory-id', sub.id);
                            
                            if (selectedSubcategories && selectedSubcategories.includes(sub.id)) {
                                checkbox.checked = true;
                            }
                            
                            const span = document.createElement('span');
                            span.className = 'ml-3 text-sm text-gray-600';
                            span.textContent = sub.name;
                            
                            label.appendChild(checkbox);
                            label.appendChild(span);
                            subcategoriesContainer.appendChild(label);
                            
                            checkbox.addEventListener('change', updateSubSubcategories);
                        });
                        
                        updateSubSubcategories();
                    }
                    
                    function updateSubSubcategories() {
                        const selectedSubcategoryIds = Array.from(document.querySelectorAll('.subcategory-checkbox:checked'))
                            .map(cb => parseInt(cb.value));
                        
                        subsubcategoriesContainer.innerHTML = '';
                        
                        if (selectedSubcategoryIds.length === 0) {
                            subsubcategoriesSection.style.display = 'none';
                            return;
                        }
                        
                        subsubcategoriesSection.style.display = 'block';
                        
                        let subsubcategories = [];
                        allCategories.forEach(cat => {
                            if (cat.subcategories) {
                                cat.subcategories.forEach(sub => {
                                    if (selectedSubcategoryIds.includes(sub.id) && sub.subcategories) {
                                        sub.subcategories.forEach(subsub => {
                                            subsubcategories.push(subsub);
                                        });
                                    }
                                });
                            }
                        });
                        
                        subsubcategories.forEach(subsub => {
                            const label = document.createElement('label');
                            label.className = 'flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-all duration-200';
                            
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'services_to_offer_subcategory[]';
                            checkbox.value = subsub.id;
                            checkbox.className = 'h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded';
                            
                            if (selectedSubSubcategories && selectedSubSubcategories.includes(subsub.id)) {
                                checkbox.checked = true;
                            }
                            
                            const span = document.createElement('span');
                            span.className = 'ml-3 text-sm text-gray-600';
                            span.textContent = subsub.name;
                            
                            label.appendChild(checkbox);
                            label.appendChild(span);
                            subsubcategoriesContainer.appendChild(label);
                        });
                    }
                    
                    // Event listeners
                    document.querySelectorAll('.category-checkbox').forEach(cb => {
                        cb.addEventListener('change', updateSubcategories);
                    });
                    
                    // Initial population
                    updateSubcategories();
                });
            </script>
            @endif
        </div>
    </div>
</div>
@endsection