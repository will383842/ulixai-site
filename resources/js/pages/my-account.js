/**
 * My Account Page JavaScript
 * Extracted from inline scripts for better performance and maintainability
 * @module pages/my-account
 */

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
  initializeSpecialStatusModal();
  initializeToggleButtons();
  initializeEscapeKeyHandler();
});

// === MODAL FUNCTIONS ===

/**
 * Opens the About You popup modal
 */
function openAboutYouPopup() {
  showModal("aboutYouPopup");
}

/**
 * Closes the About You popup modal
 */
function closeAboutYouPopup() {
  hideModal("aboutYouPopup");
}

/**
 * Submits the About You form via AJAX
 */
function submitAboutYou() {
  const description = document.getElementById("aboutYouText")?.value;
  const userId = window.LOGGED_IN_USER_ID;

  if (!userId) {
    showNotification('User not authenticated', 'error');
    return;
  }

  fetch('/api/update-about-you', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCSRFToken()
    },
    body: JSON.stringify({
      user_id: userId,
      description: description
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      if (typeof toastr !== 'undefined') {
        toastr.success('About updated successfully!', 'Success');
      }
      closeAboutYouPopup();
    } else {
      showNotification('Update failed!', 'error');
    }
  })
  .catch(() => {
    showNotification('An error occurred. Please try again.', 'error');
  });
}

/**
 * Opens the category selection popup and loads categories
 */
function openCategoryPopup() {
  showModal('selectet-provider-category');
  fetch('/api/categories')
    .then(res => res.json())
    .then(data => {
      renderCategoryStep(data);
    })
    .catch(() => {
      showNotification('Failed to load categories', 'error');
    });
}

/**
 * Renders the main category selection step
 * @param {Object} response - API response with categories
 */
function renderCategoryStep(response) {
  const modal = document.getElementById('render-selectet-provider-category');
  if (!modal) return;

  const categories = response.categories || [];

  const html = `
    <div class="flex flex-col h-full max-h-[70vh]">
      <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-lg font-semibold text-gray-800">Select Categories</h3>
          <span class="text-sm text-gray-500">Step 1 of 3</span>
        </div>
        <p class="text-sm text-gray-600">Choose one or more categories that match your services</p>
      </div>

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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
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
  modal.dataset.selectedMainCategories = '[]';
  modal.dataset.selectedSubCategories = '[]';
  modal.dataset.selectedSubSubCategories = '[]';

  setupCategoryListeners();
}

/**
 * Sets up event listeners for category checkboxes
 */
function setupCategoryListeners() {
  const checkboxes = document.querySelectorAll('.main-category-checkbox');
  const nextBtn = document.getElementById('next-btn');
  const countDisplay = document.getElementById('selected-count');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const selectedCount = document.querySelectorAll('.main-category-checkbox:checked').length;
      if (countDisplay) countDisplay.textContent = selectedCount;
      if (nextBtn) nextBtn.disabled = selectedCount === 0;
    });
  });
}

/**
 * Proceeds to subcategory selection step
 */
function proceedToSubcategories() {
  const modal = document.getElementById('render-selectet-provider-category');
  const checked = Array.from(modal.querySelectorAll('.main-category-checkbox:checked')).map(cb => parseInt(cb.value));

  if (!checked.length) {
    showNotification('Please select at least one category.', 'warning');
    return;
  }

  modal.dataset.selectedMainCategories = JSON.stringify(checked);
  showLoadingState(modal);

  Promise.all(checked.map(catId =>
    fetch(`/api/categories/${catId}/subcategories`)
      .then(res => res.json())
      .then(data => ({ catId, subs: data.subcategories || [] }))
  ))
  .then(results => {
    renderSubcategoryStepMulti(checked, results);
  })
  .catch(() => {
    showNotification('Failed to load subcategories. Please try again.', 'error');
  });
}

/**
 * Renders the subcategory selection step
 * @param {Array} mainCatIds - Selected main category IDs
 * @param {Array} subcategoriesArr - Subcategories data
 */
function renderSubcategoryStepMulti(mainCatIds, subcategoriesArr) {
  const modal = document.getElementById('render-selectet-provider-category');
  const hasSubcategories = subcategoriesArr.some(({ subs }) => subs.length > 0);

  const html = `
    <div class="flex flex-col h-full max-h-[70vh]">
      <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-lg font-semibold text-gray-800">Select Subcategories</h3>
          <span class="text-sm text-gray-500">Step 2 of 3</span>
        </div>
        <p class="text-sm text-gray-600">Choose specific subcategories within your selected categories</p>
      </div>

      <div class="flex-1 overflow-y-auto p-6 pt-4">
        ${hasSubcategories ? `
          <div class="space-y-6" id="subcategoryStep">
            ${subcategoriesArr.map(({ catId, subs }) => subs.length ? `
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

  if (hasSubcategories) {
    setupSubcategoryListeners();
  }
}

/**
 * Sets up event listeners for subcategory checkboxes
 */
function setupSubcategoryListeners() {
  const checkboxes = document.querySelectorAll('.sub-category-checkbox');
  const nextBtn = document.getElementById('next-sub-btn');
  const countDisplay = document.getElementById('sub-selected-count');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const selectedCount = document.querySelectorAll('.sub-category-checkbox:checked').length;
      if (countDisplay) countDisplay.textContent = selectedCount;
      if (nextBtn) nextBtn.disabled = selectedCount === 0;
    });
  });
}

/**
 * Proceeds to sub-subcategory selection step
 */
function proceedToSubSubcategories() {
  const modal = document.getElementById('render-selectet-provider-category');
  const checked = Array.from(modal.querySelectorAll('.sub-category-checkbox:checked')).map(cb => parseInt(cb.value));

  if (!checked.length) {
    showNotification('Please select at least one subcategory.', 'warning');
    return;
  }

  modal.dataset.selectedSubCategories = JSON.stringify(checked);
  showLoadingState(modal);

  Promise.all(
    checked.map(subId =>
      fetch(`/api/categories/${subId}/subcategories`)
        .then(res => res.json())
        .then(data => ({ subId, subs: data.subcategories || [] }))
    )
  )
  .then(results => {
    renderSubSubcategoryStepMulti(checked, results);
  })
  .catch(() => {
    showNotification('Failed to load sub-subcategories. Please try again.', 'error');
  });
}

/**
 * Renders the sub-subcategory selection step
 * @param {Array} subCatIds - Selected subcategory IDs
 * @param {Array} subsubcategoriesArr - Sub-subcategories data
 */
function renderSubSubcategoryStepMulti(subCatIds, subsubcategoriesArr) {
  const modal = document.getElementById('render-selectet-provider-category');
  const hasSubSubcategories = subsubcategoriesArr.some(({ subs }) => subs.length > 0);

  const html = `
    <div class="flex flex-col h-full max-h-[70vh]">
      <div class="flex-shrink-0 p-6 pb-4 border-b border-gray-100">
        <div class="flex items-center justify-between mb-2">
          <h3 class="text-lg font-semibold text-gray-800">Select Specializations</h3>
          <span class="text-sm text-gray-500">Step 3 of 3</span>
        </div>
        <p class="text-sm text-gray-600">Choose your specific areas of expertise</p>
      </div>

      <div class="flex-1 overflow-y-auto p-6 pt-4">
        ${hasSubSubcategories ? `
          <div class="space-y-6" id="subsubcategoryStep">
            ${subsubcategoriesArr.map(({ subId, subs }) => subs.length ? `
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

  if (hasSubSubcategories) {
    setupSubSubcategoryListeners();
  }
}

/**
 * Sets up event listeners for sub-subcategory checkboxes
 */
function setupSubSubcategoryListeners() {
  const checkboxes = document.querySelectorAll('.subsub-category-checkbox');
  const countDisplay = document.getElementById('subsub-selected-count');

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const selectedCount = document.querySelectorAll('.subsub-category-checkbox:checked').length;
      if (countDisplay) countDisplay.textContent = selectedCount;
    });
  });
}

/**
 * Goes back to main category selection
 */
function goBackToMainCategories() {
  fetch('/api/categories')
    .then(res => res.json())
    .then(data => {
      renderCategoryStep(data);
    });
}

/**
 * Goes back to subcategory selection
 */
function goBackToSubcategories() {
  const modal = document.getElementById('render-selectet-provider-category');
  const mainCategories = JSON.parse(modal.dataset.selectedMainCategories || '[]');

  if (mainCategories.length) {
    Promise.all(mainCategories.map(catId =>
      fetch(`/api/categories/${catId}/subcategories`)
        .then(res => res.json())
        .then(data => ({ catId, subs: data.subcategories || [] }))
    ))
    .then(results => {
      renderSubcategoryStepMulti(mainCategories, results);
    });
  }
}

/**
 * Shows a loading state in the modal
 * @param {HTMLElement} modal - Modal element
 */
function showLoadingState(modal) {
  modal.innerHTML = `
    <div class="flex items-center justify-center h-64">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
    </div>
  `;
}

/**
 * Saves the selected categories
 */
function saveCategorySelectionMulti() {
  const modal = document.getElementById('render-selectet-provider-category');

  const mainCategories = JSON.parse(modal.dataset.selectedMainCategories || '[]');
  const subCategories = JSON.parse(modal.dataset.selectedSubCategories || '[]');
  const subSubCategories = Array.from(modal.querySelectorAll('.subsub-category-checkbox:checked')).map(cb => parseInt(cb.value));

  const data = {
    main_categories: mainCategories,
    sub_categories: subCategories,
    sub_sub_categories: subSubCategories
  };

  fetch('/api/provider/save-categories', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCSRFToken()
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

/**
 * Opens the special status modal
 */
function openSpecialStatusModal() {
  showModal("specialStatusModal");
}

/**
 * Closes all popups
 */
function closeAllPopups() {
  const modalIds = ['selectet-provider-category', 'aboutYouPopup', 'specialStatusModal'];
  modalIds.forEach(id => hideModal(id));
}

// === UTILITY FUNCTIONS ===

/**
 * Shows a modal by ID
 * @param {string} modalId - Modal element ID
 */
function showModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("hidden");
  }
}

/**
 * Hides a modal by ID
 * @param {string} modalId - Modal element ID
 */
function hideModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add("hidden");
  }
}

/**
 * Gets the CSRF token from meta tag
 * @returns {string} CSRF token
 */
function getCSRFToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

/**
 * Shows a notification using toastr or fallback
 * @param {string} message - Notification message
 * @param {string} type - Notification type (success, error, warning, info)
 */
function showNotification(message, type = 'info') {
  if (typeof toastr !== 'undefined') {
    toastr[type](message);
  } else {
    alert(message);
  }
}

// === INITIALIZATION FUNCTIONS ===

/**
 * Initializes the special status modal
 */
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

    window.addEventListener("click", (e) => {
      if (e.target === modal) {
        hideModal("specialStatusModal");
      }
    });
  }
}

/**
 * Initializes toggle buttons for special status items
 */
function initializeToggleButtons() {
  document.querySelectorAll(".special-status-item").forEach(group => {
    const buttons = group.querySelectorAll(".toggle-btn");

    buttons.forEach(button => {
      button.addEventListener("click", () => {
        buttons.forEach(btn => {
          btn.classList.remove("bg-blue-500", "text-white", "border-blue-500");
          btn.classList.add("bg-white", "text-gray-600", "border-gray-300");
        });

        button.classList.remove("bg-white", "text-gray-600", "border-gray-300");
        button.classList.add("bg-blue-500", "text-white", "border-blue-500");
      });
    });
  });
}

/**
 * Initializes Escape key handler for closing modals
 */
function initializeEscapeKeyHandler() {
  document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
      closeAllPopups();
    }
  });
}

// Export functions to window for onclick handlers
window.openAboutYouPopup = openAboutYouPopup;
window.closeAboutYouPopup = closeAboutYouPopup;
window.submitAboutYou = submitAboutYou;
window.openCategoryPopup = openCategoryPopup;
window.proceedToSubcategories = proceedToSubcategories;
window.proceedToSubSubcategories = proceedToSubSubcategories;
window.goBackToMainCategories = goBackToMainCategories;
window.goBackToSubcategories = goBackToSubcategories;
window.saveCategorySelectionMulti = saveCategorySelectionMulti;
window.openSpecialStatusModal = openSpecialStatusModal;
window.closeAllPopups = closeAllPopups;
