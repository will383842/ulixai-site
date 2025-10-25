<!-- 
============================================
🚀 STEP 4 - PROVIDER SERVICES (2025/2026)
✨ Ultra Modern Design + Enhanced UX
============================================
-->

<div id="step4" class="hidden">
  
  <!-- Header -->
  <div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg animate-pulse-slow">
        <span class="text-2xl">🛠️</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
        What kind of help do you provide?
      </h2>
    </div>
    <p class="text-gray-600 text-sm sm:text-base font-medium mb-3">
      Select your services and specialties
    </p>
    
    <!-- Selection Counter -->
    <div id="selectionBadge" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-full" style="opacity: 0;">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span id="categoryCount" class="text-sm font-bold text-blue-700">0 service(s) selected</span>
    </div>
  </div>

  <!-- Categories Container -->
  <div id="categoriesContainer" class="space-y-4 mb-8"></div>

  <!-- Navigation Buttons -->
  <div class="flex justify-between items-center gap-4">
    <button id="backToStep3" class="flex items-center gap-2 px-6 py-3 text-blue-600 font-semibold hover:bg-blue-50 rounded-lg transition-all group">
      <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button id="chooseSubcatBtn" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 group" disabled>
      <span>Choose Subcategories</span>
      <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>
</div>

<style>
/* Categories Cards */
.help-icon {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.help-icon::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition: left 0.5s;
}

.help-icon:hover::before {
  left: 100%;
}

.help-icon:hover {
  transform: translateY(-4px) scale(1.05);
}

.help-icon.selected {
  background: linear-gradient(135deg, #1e40af 0%, #0891b2 100%) !important;
  color: white !important;
  border-color: #0e7490 !important;
  box-shadow: 0 10px 25px rgba(8, 145, 178, 0.4) !important;
  transform: scale(1.05);
}

.help-icon.selected::after {
  content: '✓';
  position: absolute;
  top: 8px;
  right: 8px;
  width: 24px;
  height: 24px;
  background: white;
  color: #0891b2;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 14px;
  animation: checkPop 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes checkPop {
  0% { transform: scale(0) rotate(-180deg); }
  50% { transform: scale(1.2) rotate(10deg); }
  100% { transform: scale(1) rotate(0); }
}

@keyframes pulse-slow {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.animate-pulse-slow {
  animation: pulse-slow 3s ease-in-out infinite;
}

/* Modal Animations */
@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.modal-content {
  animation: modalFadeIn 0.3s ease-out;
}

/* Subcategory buttons */
.subcat-btn {
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
}

.subcat-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.subcat-btn.selected {
  background: linear-gradient(135deg, #1e40af, #0891b2) !important;
  color: white !important;
  border-color: #0e7490 !important;
  transform: scale(1.05);
}

.subcat-btn.selected::before {
  content: '✓ ';
  font-weight: bold;
}

/* Smooth transitions */
* {
  -webkit-tap-highlight-color: transparent;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // ====== CONFIG ======
  const PREV_STEP_ID = 'step3';
  const NEXT_STEP_ID = 'step5';

  // ====== ELEMENTS ======
  const step4 = document.getElementById('step4');
  if (!step4) return;

  const backToStep3 = document.getElementById('backToStep3');
  const chooseSubcatBtn = document.getElementById('chooseSubcatBtn');
  const categoriesContainer = document.getElementById('categoriesContainer');
  const categoryCount = document.getElementById('categoryCount');
  const selectionBadge = document.getElementById('selectionBadge');

  // ====== STATE ======
  let selectedCategories = {}; // {catId: catName}

  // ====== HELPERS ======
  function goToStep(stepId) {
    document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
    const target = document.getElementById(stepId);
    if (target) {
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.dispatchEvent(new CustomEvent('wizard:stepchange', { detail: { stepId } }));
    }
  }

  function updateCounter() {
    const count = Object.keys(selectedCategories).length;
    categoryCount.textContent = count + ' service(s) selected';
    
    if (count > 0) {
      selectionBadge.style.opacity = '1';
      selectionBadge.style.transform = 'scale(1.1)';
      setTimeout(() => {
        selectionBadge.style.transform = 'scale(1)';
      }, 200);
    } else {
      selectionBadge.style.opacity = '0';
    }
  }

  // ----- Render main categories -----
  function renderCategories(categories) {
    if (!categoriesContainer) return;
    categoriesContainer.innerHTML = '';
    let row = null;

    categories.forEach((cat, idx) => {
      if (idx % 3 === 0) {
        row = document.createElement('div');
        row.className = 'flex justify-center gap-6 mb-4';
        categoriesContainer.appendChild(row);
      }

      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'help-icon w-40 h-24 flex flex-col items-center justify-center rounded-2xl bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 border-2 border-blue-200 shadow-md text-blue-900 text-base font-semibold';

      if (cat.icon_image) {
        btn.innerHTML = `
          <div class="w-8 h-8 mb-1 flex items-center justify-center">
            <img src="${cat.icon_image}" alt="${cat.name}" class="w-full h-full object-contain">
          </div>
          <span class="text-center leading-tight">${cat.name}</span>
        `;
      } else {
        btn.textContent = cat.name;
      }

      btn.dataset.id = cat.id;

      btn.addEventListener('click', function () {
        const catId = btn.dataset.id;
        
        if (selectedCategories[catId]) {
          delete selectedCategories[catId];
          btn.classList.remove('selected');
        } else {
          selectedCategories[catId] = cat.name;
          btn.classList.add('selected');
        }
        
        updateCounter();
        chooseSubcatBtn.disabled = Object.keys(selectedCategories).length === 0;
      });

      row.appendChild(btn);
    });
  }

  function fetchCategoriesAndRender() {
    fetch('/api/categories')
      .then(res => res.json())
      .then(data => {
        if (data?.success && Array.isArray(data.categories)) {
          renderCategories(data.categories);
        }
      })
      .catch(() => {});
  }

  // ----- MODERN Subcategory Modal -----
  function showSubcategoryModal(subcategoriesByCat) {
    document.getElementById('subcategoriesModal')?.remove();

    // Clean up orphaned subcategories in localStorage
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    if (expats.provider_subcategories) {
      const validCatIds = Object.keys(subcategoriesByCat);
      const cleanedSubcats = {};
      
      Object.keys(expats.provider_subcategories).forEach(catId => {
        if (validCatIds.includes(catId)) {
          cleanedSubcats[catId] = expats.provider_subcategories[catId];
        }
      });
      
      expats.provider_subcategories = cleanedSubcats;
      localStorage.setItem('expats', JSON.stringify(expats));
    }

    const modal = document.createElement('div');
    modal.id = 'subcategoriesModal';
    modal.className = 'fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4';
    modal.style.backdropFilter = 'blur(4px)';
    
    modal.innerHTML = `
      <div class="modal-content bg-white rounded-3xl shadow-2xl max-w-3xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
        <!-- Close Button -->
        <button id="closeSubcatModal" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-800 transition-all">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        
        <!-- Header -->
        <div class="mb-6">
          <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
              <span class="text-xl">🎯</span>
            </div>
            <h2 class="text-2xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
              Choose your specialties
            </h2>
          </div>
          <p class="text-gray-500 text-sm ml-13">Select at least one subcategory for each service</p>
        </div>
        
        <!-- Progress Indicator -->
        <div class="mb-6 bg-gray-100 rounded-full h-2 overflow-hidden">
          <div id="progressBar" class="h-full bg-gradient-to-r from-blue-600 to-cyan-600 transition-all duration-300" style="width: 0%"></div>
        </div>
        
        <!-- Subcategories Content -->
        <div id="subcatContent" class="space-y-8"></div>
        
        <!-- Footer -->
        <div class="flex justify-between items-center mt-8 pt-6 border-t">
          <button id="backToCategoriesBtn" class="flex items-center gap-2 px-6 py-3 text-gray-600 font-semibold hover:bg-gray-100 rounded-full transition-all group">
            <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Back to Categories</span>
          </button>
          
          <div class="flex items-center gap-4">
            <div class="text-sm text-gray-500">
              <span id="progressText">0 / 0 categories completed</span>
            </div>
            <button id="saveSubcatBtn" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed group" disabled>
              <span>Continue</span>
              <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(modal);

    const subcatContent = modal.querySelector('#subcatContent');
    const saveBtn = modal.querySelector('#saveSubcatBtn');
    const progressBar = modal.querySelector('#progressBar');
    const progressText = modal.querySelector('#progressText');
    const selectedSubcats = {};

    // Restore previous selections from localStorage if they exist
    if (expats.provider_subcategories) {
      Object.keys(expats.provider_subcategories).forEach(catId => {
        if (subcategoriesByCat[catId]) {
          selectedSubcats[catId] = expats.provider_subcategories[catId];
        }
      });
    }

    const totalCategories = Object.keys(subcategoriesByCat).length;

    function updateProgress() {
      const completed = Object.keys(selectedSubcats).filter(catId => 
        Array.isArray(selectedSubcats[catId]) && selectedSubcats[catId].length > 0
      ).length;
      
      const percentage = (completed / totalCategories) * 100;
      progressBar.style.width = percentage + '%';
      progressText.textContent = `${completed} / ${totalCategories} categories completed`;
      
      const allSelected = completed === totalCategories;
      saveBtn.disabled = !allSelected;
    }

    Object.entries(subcategoriesByCat).forEach(([catId, subcats], index) => {
      const catDiv = document.createElement('div');
      catDiv.className = 'bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl p-6 border border-blue-100';

      const categoryName = subcats.categoryName || 'Category';
      catDiv.innerHTML = `
        <div class="flex items-center gap-3 mb-4">
          <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-600 text-white rounded-lg flex items-center justify-center font-bold text-sm">
            ${index + 1}
          </div>
          <h3 class="font-bold text-lg text-gray-800">${categoryName}</h3>
          <div class="ml-auto">
            <span class="subcat-counter-${catId} text-xs font-semibold px-3 py-1 bg-white rounded-full text-gray-500 border">
              0 selected
            </span>
          </div>
        </div>
      `;

      const grid = document.createElement('div');
      grid.className = 'flex flex-wrap gap-3';

      (subcats.subcategories || []).forEach(subcat => {
        const sbtn = document.createElement('button');
        sbtn.type = 'button';
        sbtn.className = 'subcat-btn px-4 py-2 rounded-xl border-2 border-blue-200 bg-white text-blue-700 font-medium hover:bg-blue-50';
        sbtn.textContent = subcat.name;
        sbtn.dataset.catId = catId;
        sbtn.dataset.subcatId = subcat.id;

        // Restore selection if it was previously selected
        if (selectedSubcats[catId] && selectedSubcats[catId].includes(subcat.id)) {
          sbtn.classList.add('selected');
        }

        sbtn.addEventListener('click', function () {
          sbtn.classList.toggle('selected');

          selectedSubcats[catId] = selectedSubcats[catId] || [];
          const exists = selectedSubcats[catId].includes(subcat.id);
          selectedSubcats[catId] = exists
            ? selectedSubcats[catId].filter(id => id !== subcat.id)
            : selectedSubcats[catId].concat(subcat.id);

          // Update counter for this category
          const counter = document.querySelector(`.subcat-counter-${catId}`);
          const count = selectedSubcats[catId].length;
          counter.textContent = count + ' selected';
          counter.className = count > 0 
            ? 'subcat-counter-' + catId + ' text-xs font-semibold px-3 py-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full'
            : 'subcat-counter-' + catId + ' text-xs font-semibold px-3 py-1 bg-white rounded-full text-gray-500 border';

          updateProgress();
        });

        grid.appendChild(sbtn);
      });

      catDiv.appendChild(grid);
      subcatContent.appendChild(catDiv);
      
      // Initialize counter for this category
      const counter = document.querySelector(`.subcat-counter-${catId}`);
      const count = selectedSubcats[catId]?.length || 0;
      counter.textContent = count + ' selected';
      if (count > 0) {
        counter.className = 'subcat-counter-' + catId + ' text-xs font-semibold px-3 py-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full';
      }
    });

    // Close modal
    modal.querySelector('#closeSubcatModal').onclick = () => {
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    // Back to categories button - with confirmation
    modal.querySelector('#backToCategoriesBtn').onclick = () => {
      // Check if user has made subcategory selections
      const hasSelections = Object.values(selectedSubcats).some(arr => arr && arr.length > 0);
      
      if (hasSelections) {
        const confirmBack = confirm('⚠️ Going back will reset your subcategory selections. Continue?');
        if (!confirmBack) return;
      }
      
      // Clear subcategories from localStorage to avoid inconsistencies
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      delete expats.provider_subcategories;
      localStorage.setItem('expats', JSON.stringify(expats));
      
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    // Click outside to close
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.style.opacity = '0';
        setTimeout(() => modal.remove(), 200);
      }
    });

    // Save and continue
    saveBtn.onclick = function () {
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.provider_services = selectedCategories;
      expats.provider_subcategories = selectedSubcats;
      localStorage.setItem('expats', JSON.stringify(expats));

      modal.style.opacity = '0';
      setTimeout(() => {
        modal.remove();
        goToStep(NEXT_STEP_ID);
      }, 200);
    };

    updateProgress();
  }

  // ----- Show Step 4: fetch categories once -----
  const observer = new MutationObserver(() => {
    if (!step4.classList.contains('hidden')) {
      if (!step4.dataset.loaded) {
        fetchCategoriesAndRender();
        step4.dataset.loaded = '1';
      }
    }
  });
  observer.observe(step4, { attributes: true, attributeFilter: ['class'] });

  // ----- Choose Subcategories click -----
  chooseSubcatBtn?.addEventListener('click', function () {
    const catIds = Object.keys(selectedCategories);
    if (catIds.length === 0) {
      alert('⚠️ Please select at least one category.');
      return;
    }

    chooseSubcatBtn.disabled = true;
    chooseSubcatBtn.innerHTML = `
      <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      <span>Loading...</span>
    `;

    Promise.all(
      catIds.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`)
          .then(res => res.json())
          .then(data => ({
            catId,
            categoryName: data?.category?.name || '',
            subcategories: data?.subcategories || []
          }))
      )
    ).then(results => {
      const subcategoriesByCat = {};
      results.forEach(r => {
        subcategoriesByCat[r.catId] = {
          categoryName: r.categoryName,
          subcategories: r.subcategories
        };
      });
      showSubcategoryModal(subcategoriesByCat);
    }).finally(() => {
      chooseSubcatBtn.disabled = false;
      chooseSubcatBtn.innerHTML = `
        <span>Choose Subcategories</span>
        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      `;
    });
  });

  // ----- Back Button -----
  backToStep3?.addEventListener('click', function () {
    goToStep(PREV_STEP_ID);
  });
});
</script>