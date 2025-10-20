@extends('dashboard.layouts.master')

@section('title', 'My Account')

@section('content')
    @php 
      $user = auth()->user();
    @endphp



   <script>
  const LOGGED_IN_USER_ID = {{ auth()->user()->id }};
</script>

<!-- Main Content -->
<div class="flex flex-col lg:flex-row min-h-screen">
  <div class="flex-1 p-4 sm:p-6 space-y-10">

    <!-- Banking Information Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
      <div class="px-6 py-5 sm:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Banking Information</h3>
            <p class="mt-1 text-sm text-gray-500">
              Set up your banking details for receiving payments and withdrawals
            </p>
          </div>
          <button onclick="showBankingModal()" 
                  class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105 shadow-md">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
              </svg>
              {{ $user->hasBankingDetails() ? 'Update Banking Details' : 'Add Banking Details' }}
          </button>
        </div>

        @if($user->hasBankingDetails())
          <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-gray-100 pt-6">
            <div>
              <dt class="text-sm font-medium text-gray-500">Account Holder</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $user->bank_account_holder }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">IBAN</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ substr($user->bank_account_iban, 0, 4) . '****' }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Bank Name</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $user->bank_name }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $user->bank_details_verified_at?->diffForHumans() }}</dd>
            </div>
          </div>
        @endif
      </div>
    </div>

    <!-- Wallet Section (Empty placeholder) -->
    <div class="flex flex-wrap justify-center sm:justify-start gap-4 mt-4 lg:ml-6"></div>

    @if(auth()->user()->user_role === 'service_provider')
      @include('dashboard.my-account-partials.service-provider-section')
    @else
      @include('dashboard.my-account-partials.regular-user-section')
    @endif

  </div>
</div>

<!-- Modals for Service Providers -->
@if(auth()->user()->user_role === 'service_provider')
  @include('dashboard.my-account-partials.about-you-modal')
  @include('dashboard.my-account-partials.special-status-modal', ['provider' => auth()->user()->serviceProvider])
  @include('dashboard.my-account-partials.category-search-modal')
@endif
@include('dashboard.my-account-partials.banking-details-modal')
<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  initializeSpecialStatusModal();
  initializeToggleButtons();
});


// === MODAL FUNCTIONS ===
function openAboutYouPopup() {
  document.getElementById("aboutYouPopup").classList.remove("hidden");
}

function closeAboutYouPopup() {
  document.getElementById("aboutYouPopup").classList.add("hidden");
}
function submitAboutYou() {
  const description = document.getElementById("aboutYouText").value;

  fetch('/api/update-about-you', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      user_id: LOGGED_IN_USER_ID,
      description: description
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      toastr.success('About updated successfully!', 'Success');
      closeAboutYouPopup();
    } else {
        toastr.error('Update failed!', 'Error');
    }
  })
  .catch(error => {
    showNotification('An error occurred. Please try again.', 'error');
  });
}







function closeAboutYouPopup() {
  hideModal("aboutYouPopup");
}

function openCategoryPopup() {
    showModal('selectet-provider-category');
    fetch('/api/categories')
        .then(res => res.json())
        .then(data => {
            renderCategoryStep(data);
        });
}

function renderCategoryStep(response) {
    const modal = document.getElementById('render-selectet-provider-category');
    if (!modal) return;
    const categories = response.categories;

    let html = `
        <div class="flex flex-col h-full max-h-[70vh]">
            <!-- Header -->
            <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Select Categories</h3>
                    <span class="text-sm text-gray-500">Step 1 of 3</span>
                </div>
                <p class="text-sm text-gray-600">Choose one or more categories that match your services</p>
            </div>
            
            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-6 pt-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="categoryStep">
                    ${categories.map(cat => `
                        <label class="category-card group cursor-pointer">
                            <div class="flex items-center p-4 bg-white border-2 border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-all duration-200">
                                <input type="checkbox" class="main-category-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" value="${cat.id}">
                                ${cat.icon_image ? `
                                    <div class="ml-3 w-10 h-10 rounded-lg flex items-center justify-center bg-gray-100 group-hover:bg-blue-200 transition-colors overflow-hidden flex-shrink-0">
                                        <img src="${cat.icon_image}" alt="${cat.name}" class="w-full h-full object-cover rounded-lg">
                                    </div>
                                ` : `
                                    <div class="ml-3 w-10 h-10 rounded-lg flex items-center justify-center bg-gray-100 group-hover:bg-blue-200 transition-colors flex-shrink-0">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                `}
                                <div class="ml-3 flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-700 transition-colors truncate">${cat.name}</h4>
                                </div>
                            </div>
                        </label>
                    `).join('')}
                </div>
            </div>
            
            <!-- Footer with Actions -->
            <div class="flex-shrink-0 p-6 pt-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        <span id="selected-count">0</span> categories selected
                    </div>
                    <button type="button" onclick="proceedToSubcategories()" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg font-medium transition-colors" 
                            id="next-btn" disabled>
                        Next Step
                    </button>
                </div>
            </div>
        </div>
    `;
    
    modal.innerHTML = html;
    // Initialize empty arrays for storing selections
    modal.dataset.selectedMainCategories = '[]';
    modal.dataset.selectedSubCategories = '[]';
    modal.dataset.selectedSubSubCategories = '[]';
    
    // Add event listeners for checkbox changes
    setupCategoryListeners();
}

function setupCategoryListeners() {
    const checkboxes = document.querySelectorAll('.main-category-checkbox');
    const nextBtn = document.getElementById('next-btn');
    const countDisplay = document.getElementById('selected-count');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedCount = document.querySelectorAll('.main-category-checkbox:checked').length;
            countDisplay.textContent = selectedCount;
            nextBtn.disabled = selectedCount === 0;
        });
    });
}

function proceedToSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const checked = Array.from(modal.querySelectorAll('.main-category-checkbox:checked')).map(cb => parseInt(cb.value));

    if (!checked.length) {
        showNotification('Please select at least one category.', 'warning');
        return;
    }
    
    // Store selected main categories BEFORE replacing HTML
    modal.dataset.selectedMainCategories = JSON.stringify(checked);
    
    // Show loading state
    showLoadingState(modal);
    
    // Fetch all subcategories for selected main categories
    Promise.all(checked.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`).then(res => res.json().then(data => ({catId, subs: data.subcategories || []})))
    )).then(results => {
        renderSubcategoryStepMulti(checked, results);
    }).catch(error => {
        console.error('Error fetching subcategories:', error);
        showNotification('Failed to load subcategories. Please try again.', 'error');
    });
}

function renderSubcategoryStepMulti(mainCatIds, subcategoriesArr) {
    const modal = document.getElementById('render-selectet-provider-category');
    const hasSubcategories = subcategoriesArr.some(({subs}) => subs.length > 0);
    
    let html = `
        <div class="flex flex-col h-full max-h-[70vh]">
            <!-- Header -->
            <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Select Subcategories</h3>
                    <span class="text-sm text-gray-500">Step 2 of 3</span>
                </div>
                <p class="text-sm text-gray-600">Choose specific subcategories within your selected categories</p>
            </div>
            
            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-6 pt-4">
                ${hasSubcategories ? `
                    <div class="space-y-6" id="subcategoryStep">
                        ${subcategoriesArr.map(({catId, subs}) => subs.length ? `
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-700 mb-3 text-sm uppercase tracking-wide">${subs[0]?.parent_name || 'Category'}</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    ${subs.map(sub => `
                                        <label class="flex items-center p-3 bg-white rounded-md hover:bg-blue-50 cursor-pointer transition-colors group">
                                            <input type="checkbox" class="sub-category-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" data-main="${catId}" value="${sub.id}">
                                            ${sub.icon_image ? `
                                                <div class="ml-3 w-6 h-6 flex-shrink-0">
                                                    <img src="${sub.icon_image}" alt="${sub.name}" class="w-full h-full object-contain">
                                                </div>
                                                <span class="ml-3 text-sm text-gray-700 group-hover:text-blue-700 transition-colors">${sub.name}</span>
                                            ` : `
                                                <span class="ml-3 text-sm text-gray-700 group-hover:text-blue-700 transition-colors">${sub.name}</span>
                                            `}
                                        </label>
                                    `).join('')}
                                </div>
                            </div>
                        ` : '').join('')}
                    </div>
                ` : `
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No subcategories available</h3>
                        <p class="mt-1 text-sm text-gray-500">The selected categories don't have any subcategories.</p>
                    </div>
                `}
            </div>
            
            <!-- Footer with Actions -->
            <div class="flex-shrink-0 p-6 pt-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <button type="button" onclick="goBackToMainCategories()" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">
                        Back
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            <span id="sub-selected-count">0</span> subcategories selected
                        </div>
                        ${hasSubcategories ? `
                            <button type="button" onclick="proceedToSubSubcategories()" 
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg font-medium transition-colors" 
                                    id="next-sub-btn" disabled>
                                Next Step
                            </button>
                        ` : `
                            <button type="button" onclick="saveCategorySelectionMulti()" 
                                    class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                                Save Selection
                            </button>
                        `}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    modal.innerHTML = html;
    // Main categories are already stored, don't overwrite them
    // modal.dataset.selectedMainCategories is already set from proceedToSubcategories()
    
    if (hasSubcategories) {
        setupSubcategoryListeners();
    }
}

function setupSubcategoryListeners() {
    const checkboxes = document.querySelectorAll('.sub-category-checkbox');
    const nextBtn = document.getElementById('next-sub-btn');
    const countDisplay = document.getElementById('sub-selected-count');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedCount = document.querySelectorAll('.sub-category-checkbox:checked').length;
            countDisplay.textContent = selectedCount;
            if (nextBtn) nextBtn.disabled = selectedCount === 0;
        });
    });
}

function proceedToSubSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const checked = Array.from(modal.querySelectorAll('.sub-category-checkbox:checked')).map(cb => parseInt(cb.value));
    
    if (!checked.length) {
        showNotification('Please select at least one subcategory.', 'warning');
        return;
    }
    
    // Store selected subcategories BEFORE replacing HTML
    modal.dataset.selectedSubCategories = JSON.stringify(checked);
    
    // Show loading state
    showLoadingState(modal);
    
    // Fetch all subsubcategories for selected subcategories
    Promise.all(
        checked.map(subId =>
            fetch(`/api/categories/${subId}/subcategories`)
                .then(res => res.json())
                .then(data => ({ subId, subs: data.subcategories || [] }))
        )
    ).then(results => {
        renderSubSubcategoryStepMulti(checked, results);
    }).catch(error => {
        console.error('Error fetching sub-subcategories:', error);
        showNotification('Failed to load sub-subcategories. Please try again.', 'error');
    });
}

function renderSubSubcategoryStepMulti(subCatIds, subsubcategoriesArr) {
    const modal = document.getElementById('render-selectet-provider-category');
    const hasSubSubcategories = subsubcategoriesArr.some(({subs}) => subs.length > 0);
    
    let html = `
        <div class="flex flex-col h-full max-h-[70vh]">
            <!-- Header -->
            <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800">Select Specializations</h3>
                    <span class="text-sm text-gray-500">Step 3 of 3</span>
                </div>
                <p class="text-sm text-gray-600">Choose your specific areas of expertise</p>
            </div>
            
            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-6 pt-4">
                ${hasSubSubcategories ? `
                    <div class="space-y-6" id="subsubcategoryStep">
                        ${subsubcategoriesArr.map(({subId, subs}) => subs.length ? `
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-700 mb-3 text-sm uppercase tracking-wide">${subs[0]?.parent_name || 'Subcategory'}</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    ${subs.map(subsub => `
                                        <label class="flex items-center p-3 bg-white rounded-md hover:bg-blue-50 cursor-pointer transition-colors group">
                                            <input type="checkbox" class="subsub-category-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" data-sub="${subId}" value="${subsub.id}">
                                            ${subsub.icon_image ? `
                                                <div class="ml-3 w-6 h-6 flex-shrink-0">
                                                    <img src="${subsub.icon_image}" alt="${subsub.name}" class="w-full h-full object-contain">
                                                </div>
                                                <span class="ml-3 text-sm text-gray-700 group-hover:text-blue-700 transition-colors">${subsub.name}</span>
                                            ` : `
                                                <span class="ml-3 text-sm text-gray-700 group-hover:text-blue-700 transition-colors">${subsub.name}</span>
                                            `}
                                        </label>
                                    `).join('')}
                                </div>
                            </div>
                        ` : '').join('')}
                    </div>
                ` : `
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No specializations available</h3>
                        <p class="mt-1 text-sm text-gray-500">The selected subcategories don't have any specializations.</p>
                    </div>
                `}
            </div>
            
            <!-- Footer with Actions -->
            <div class="flex-shrink-0 p-6 pt-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <button type="button" onclick="goBackToSubcategories()" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">
                        Back
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            <span id="subsub-selected-count">0</span> specializations selected
                        </div>
                        <button type="button" onclick="saveCategorySelectionMulti()" 
                                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                            Save Selection
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    modal.innerHTML = html;
    // Subcategories are already stored, don't overwrite them
    // modal.dataset.selectedSubCategories is already set from proceedToSubSubcategories()
    
    if (hasSubSubcategories) {
        setupSubSubcategoryListeners();
    }
}

function setupSubSubcategoryListeners() {
    const checkboxes = document.querySelectorAll('.subsub-category-checkbox');
    const countDisplay = document.getElementById('subsub-selected-count');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedCount = document.querySelectorAll('.subsub-category-checkbox:checked').length;
            countDisplay.textContent = selectedCount;
        });
    });
}

// Back navigation functions that preserve selections
function goBackToMainCategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const storedMainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    
    // Re-fetch categories and restore selections
    fetch('/api/categories')
        .then(res => res.json())
        .then(data => {
            renderCategoryStep(data);
            // Restore previously selected main categories
            restoreMainCategorySelections(storedMainCats);
        });
}

function goBackToSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const storedMainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    const storedSubCats = JSON.parse(modal.dataset.selectedSubCategories || '[]');
    
    if (storedMainCats.length === 0) {
        goBackToMainCategories();
        return;
    }
    
    showLoadingState(modal);
    
    // Re-fetch subcategories for stored main categories
    Promise.all(storedMainCats.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`).then(res => res.json().then(data => ({catId, subs: data.subcategories || []})))
    )).then(results => {
        renderSubcategoryStepMulti(storedMainCats, results);
        // Restore previously selected subcategories
        setTimeout(() => restoreSubcategorySelections(storedSubCats), 100);
    });
}

function restoreMainCategorySelections(selectedIds) {
    selectedIds.forEach(id => {
        const checkbox = document.querySelector(`.main-category-checkbox[value="${id}"]`);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
    
    // Update UI
    const selectedCount = selectedIds.length;
    const countDisplay = document.getElementById('selected-count');
    const nextBtn = document.getElementById('next-btn');
    
    if (countDisplay) countDisplay.textContent = selectedCount;
    if (nextBtn) nextBtn.disabled = selectedCount === 0;
}

function restoreSubcategorySelections(selectedIds) {
    selectedIds.forEach(id => {
        const checkbox = document.querySelector(`.sub-category-checkbox[value="${id}"]`);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
    
    // Update UI
    const selectedCount = selectedIds.length;
    const countDisplay = document.getElementById('sub-selected-count');
    const nextBtn = document.getElementById('next-sub-btn');
    
    if (countDisplay) countDisplay.textContent = selectedCount;
    if (nextBtn) nextBtn.disabled = selectedCount === 0;
}

function showLoadingState(modal) {
    modal.innerHTML = `
        <div class="flex items-center justify-center p-12">
            <div class="text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-4 text-sm text-gray-600">Loading categories...</p>
            </div>
        </div>
    `;
}

function showNotification(message, type = 'info') {
    // Create a modern notification instead of alert
    const notification = document.createElement('div');
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'warning' ? 'bg-yellow-500' : type === 'success' ? 'bg-green-500' : 'bg-blue-500';
    
    notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-[60] transform translate-x-full transition-transform duration-300`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Slide in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Slide out and remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

function saveCategorySelectionMulti() {
    const modal = document.getElementById('render-selectet-provider-category');
    
    // Get stored selections from modal dataset (these persist across navigation steps)
    const mainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    const subCats = JSON.parse(modal.dataset.selectedSubCategories || '[]');
    
    // Get currently selected sub-subcategories from the DOM (if any exist)
    const subSubCats = Array.from(modal.querySelectorAll('.subsub-category-checkbox:checked')).map(cb => parseInt(cb.value));
    
    if (mainCats.length === 0) {
        showNotification('Please select at least one category.', 'warning');
        return;
    }
    
    showLoadingState(modal);
    
    // Save to backend
    fetch('/api/provider/save-categories', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            categories: mainCats,
            subcategories: subCats,
            subsubcategories: subSubCats,
            user_id: {{ $user->id }}
        })
    })
    .then(res => res.json())
    .then(resp => {
        console.log('Save response:', resp); // Debug log
        if (resp.success) {
            showNotification('Categories saved successfully!', 'success');
            closeAllPopups();
        } else {
            showNotification('Failed to save categories. Please try again.', 'error');
        }
    })
    .catch(error => {
        console.error('Save error:', error);
        showNotification('Network error. Please check your connection and try again.', 'error');
    });
}

// Keep the original single selection function for backward compatibility
function saveCategorySelection(level, mainCatId, subCatId = null, subSubCatId = null) {
    let data = {};
    if (level === 'main') {
        data = { category_id: mainCatId };
    } else if (level === 'sub') {
        data = { category_id: mainCatId, subcategory_id: subCatId };
    } else if (level === 'subsub') {
        data = { category_id: mainCatId, subcategory_id: subCatId, subsubcategory_id: subSubCatId };
    }
    
    fetch('/api/provider/save-categories', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            showNotification('Categories saved successfully!', 'success');
            closeAllPopups();
        } else {
            showNotification('Failed to save categories', 'error');
        }
    })
    .catch(() => showNotification('Failed to save categories', 'error'));
}

function openSpecialStatusModal() {
  showModal("specialStatusModal");
}

function closeAllPopups() {
  const modalIds = ['selectet-provider-category', 'aboutYouPopup', 'specialStatusModal'];
  modalIds.forEach(id => hideModal(id));
}

// === UTILITY FUNCTIONS ===
function showModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("hidden");
  }
}

function hideModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add("hidden");
  }
}

// === INITIALIZATION FUNCTIONS ===
function initializeSpecialStatusModal() {
  const openBtn = document.getElementById("openSpecialStatusModal");
  const modal = document.getElementById("specialStatusModal");
  const closeBtn = document.getElementById("closeSpecialStatusModal");

  if (openBtn && modal && closeBtn) {
    openBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openSpecialStatusModal();
    });

    closeBtn.addEventListener("click", () => {
      hideModal("specialStatusModal");
    });

    // Close modal when clicking outside
    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        hideModal("specialStatusModal");
      }
    });
  }
}

function initializeToggleButtons() {
  document.querySelectorAll(".special-status-item").forEach(group => {
    const buttons = group.querySelectorAll(".toggle-btn");

    buttons.forEach(button => {
      button.addEventListener("click", () => {
        // Reset all buttons in this group
        buttons.forEach(btn => {
          btn.classList.remove("bg-blue-500", "text-white", "border-blue-500");
          btn.classList.add("bg-white", "text-gray-600", "border-gray-300");
        });

        // Activate clicked button
        button.classList.remove("bg-white", "text-gray-600", "border-gray-300");
        button.classList.add("bg-blue-500", "text-white", "border-blue-500");
      });
    });
  });
}



// === CATEGORY FUNCTIONS ===
function showExpatriesSubcategories() {
  // Add your subcategory logic here
  console.log("Showing Expatriés subcategories");
}

function showVacanciersSubcategories() {
  // Add your subcategory logic here
  console.log("Showing Vacanciers subcategories");
}

function showInvestisseursSubcategories() {
  // Add your subcategory logic here
  console.log("Showing Investisseurs subcategories");
}

function showTravailleursFreelancesSubcategories() {
  // Add your subcategory logic here
  console.log("Showing Travailleurs & Freelances subcategories");
}

// === EVENT LISTENERS ===
document.addEventListener('keydown', function (event) {
  if (event.key === "Escape") {
    closeAllPopups();
  }
});
</script>


<div class = "mb-20"></div>



@endsection