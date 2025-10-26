<!-- STEP 4 - PROVIDER SERVICES - VERSION AMÉLIORÉE -->

<div id="step4" class="hidden">
  
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg animate-bounce-subtle">
        <span class="text-2xl">🛠️</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 bg-clip-text text-transparent">
        What kind of help do you provide?
      </h2>
    </div>
    <p class="text-gray-600 text-sm sm:text-base font-medium mb-3">
      Select your services and specialties
    </p>
    
    <div id="selectionBadge" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-full transition-all" style="opacity: 0;">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span id="categoryCount" class="text-sm font-bold text-blue-700">0 service(s) selected</span>
    </div>
    
    <div id="selectedServices" class="mt-4 flex flex-wrap justify-center gap-2 min-h-[32px]"></div>
  </div>

  <div id="categoriesContainer" class="space-y-4 mb-8"></div>

  <div class="flex justify-between items-center gap-4 pt-6 border-t-2 border-gray-100">
    <button id="backToStep3" class="nav-btn-back">
      <span>Back</span>
    </button>
    
    <button id="chooseSubcatBtn" class="nav-btn-next" disabled>
      <span>Choose Subcategories</span>
    </button>
  </div>
</div>

<style>
.help-icon {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 1rem 0.75rem;
  border-radius: 16px;
  border: 2px solid transparent;
  cursor: pointer;
  transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  color: white;
  font-weight: 600;
  font-size: 0.8rem;
  text-align: center;
  min-width: 110px;
  min-height: 100px;
}

.help-icon:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 8px 16px -4px rgba(59, 130, 246, 0.4);
  border-color: rgba(96, 165, 250, 0.5);
}

.help-icon.selected {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-color: #047857;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3), 0 8px 16px -4px rgba(5, 150, 105, 0.5);
  transform: scale(1.03);
}

.help-icon.selected .check-indicator {
  opacity: 1;
  transform: scale(1);
}

.check-indicator {
  position: absolute;
  top: 6px;
  right: 6px;
  width: 1.5rem;
  height: 1.5rem;
  background: #10b981;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
  border: 2px solid white;
  font-size: 0.75rem;
  font-weight: bold;
}

.selected-service-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(135deg, #3b82f6, #0891b2);
  color: white;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
  animation: slideIn 0.2s ease-out;
}

.nav-btn-back,
.nav-btn-next {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.875rem 1.5rem;
  font-weight: 600;
  border-radius: 16px;
  min-height: 48px;
  flex: 1;
  max-width: 180px;
  touch-action: manipulation;
  transition: all 0.15s;
  cursor: pointer;
  border: none;
  outline: none;
}

.nav-btn-back {
  color: #3b82f6;
  background: white;
  border: 2px solid #e5e7eb;
}

.nav-btn-back:hover {
  background: rgba(59, 130, 246, 0.05);
  border-color: #3b82f6;
}

.nav-btn-next {
  color: white;
  background: linear-gradient(135deg, #3b82f6, #0891b2);
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.nav-btn-next:hover {
  box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
  transform: translateY(-2px);
}

.nav-btn-next:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.subcat-chip {
  position: relative;
  padding: 0.625rem 1.125rem;
  border-radius: 12px;
  border: 2px solid #e0f2fe;
  background: white;
  color: #0c4a6e;
  font-weight: 600;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.12s cubic-bezier(0.4, 0, 0.2, 1);
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.subcat-chip:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(14, 165, 233, 0.15);
  border-color: #0ea5e9;
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
}

.subcat-chip.selected {
  background: linear-gradient(135deg, #0ea5e9, #06b6d4);
  color: white;
  border-color: #0e7490;
  box-shadow: 0 4px 16px rgba(14, 165, 233, 0.4);
  transform: scale(1.02);
}

.subcat-chip.selected::before {
  content: '✓';
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 1.25rem;
  height: 1.25rem;
  background: white;
  color: #0ea5e9;
  border-radius: 50%;
  font-size: 0.75rem;
  font-weight: bold;
  margin-right: -0.25rem;
}

/* ===== AMÉLIORATION : Sections de catégories avec meilleur feedback ===== */
.category-section {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e2e8f0;
  border-radius: 16px;
  padding: 1.25rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-section.complete {
  border-color: #22c55e;
  background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
  box-shadow: 0 4px 20px rgba(34, 197, 94, 0.15);
}

.category-section.incomplete {
  border-color: #f97316;
  background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
  box-shadow: 0 4px 20px rgba(249, 115, 22, 0.1);
}

/* Animation shake améliorée */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

.shake {
  animation: shake 0.4s cubic-bezier(.36,.07,.19,.97);
}

/* ===== Badge de compteur amélioré ===== */
.subcat-counter-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.5rem 0.875rem;
  border-radius: 9999px;
  font-weight: 700;
  font-size: 0.8rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  min-width: 50px;
  justify-content: center;
}

.subcat-counter-badge.empty {
  background: #f3f4f6;
  color: #9ca3af;
  border: 2px solid #e5e7eb;
}

.subcat-counter-badge.filled {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  box-shadow: 0 3px 12px rgba(16, 185, 129, 0.35);
}

/* Indicateur de progression amélioré */
.progress-ring {
  transform: rotate(-90deg);
}

.progress-ring-circle {
  transition: stroke-dashoffset 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  transform-origin: 50% 50%;
}

/* Bouton de sauvegarde avec meilleur feedback */
.save-btn {
  background: linear-gradient(135deg, #3b82f6, #0891b2);
  color: white;
  padding: 1rem 2rem;
  border-radius: 16px;
  font-weight: 700;
  font-size: 1rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
  min-width: 200px;
}

.save-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
}

.save-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

/* Success checkmark animation */
@keyframes checkmark {
  0% {
    transform: scale(0) rotate(45deg);
  }
  50% {
    transform: scale(1.2) rotate(45deg);
  }
  100% {
    transform: scale(1) rotate(45deg);
  }
}

.success-check {
  animation: checkmark 0.4s ease-out;
}

@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}

.animate-bounce-subtle {
  animation: bounce-subtle 2s ease-in-out infinite;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const step4 = document.getElementById('step4');
  const chooseSubcatBtn = document.getElementById('chooseSubcatBtn');
  const backToStep3 = document.getElementById('backToStep3');
  const PREV_STEP_ID = 'step3';
  const NEXT_STEP_ID = 'step5';

  let selectedCategories = {};
  let categoryNames = {};
  
  // Stock d'emojis fun et sympas pour les catégories
  const emojiPool = [
    '🎯', '✨', '🚀', '💼', '🏠', '🌟', '💡', '🎨', '📚', '🎭',
    '🎪', '🎬', '🎸', '🎮', '🎲', '🎰', '🎳', '⚽', '🏀', '🏈',
    '⚾', '🎾', '🏐', '🏉', '🎱', '🏓', '🏸', '🏒', '🏑', '🏏',
    '⛳', '🏹', '🎣', '🥊', '🥋', '🎿', '⛷️', '🏂', '🏋️', '🤸',
    '🚴', '🏊', '🤽', '🚣', '🧗', '🚵', '🚴', '🏇', '🧘', '🏄',
    '🌈', '🌺', '🌸', '🌼', '🌻', '🌷', '🏵️', '🌹', '🥀', '💐',
    '🍀', '🌿', '🌱', '🍃', '🌾', '🌲', '🌳', '🌴', '🌵', '🌾',
    '🦋', '🐝', '🐞', '🦗', '🕷️', '🦂', '🦟', '🦠', '🐢', '🐸',
    '🦎', '🐊', '🐢', '🐍', '🐉', '🦕', '🦖', '🦀', '🦞', '🦐',
    '🌊', '💧', '💦', '☔', '⛱️', '⛄', '☃️', '🌬️', '💨', '☁️',
    '🌤️', '⛅', '🌥️', '☀️', '🌞', '⭐', '🌟', '✨', '💫', '🌙'
  ];
  
  // Mapper les emojis aux catégories de manière cohérente
  const categoryEmojiMap = {};
  
  function getEmojiForCategory(catId) {
    if (!categoryEmojiMap[catId]) {
      // Utiliser l'ID de la catégorie comme seed pour avoir toujours le même emoji
      const index = parseInt(catId, 10) % emojiPool.length;
      categoryEmojiMap[catId] = emojiPool[index];
    }
    return categoryEmojiMap[catId];
  }

  // Fonction pour changer de step
  function goToStep(stepId) {
    document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
    const target = document.getElementById(stepId);
    if (target) {
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      // Dispatch event pour informer le wizard
      document.dispatchEvent(new CustomEvent('wizard:stepchange', { detail: { stepId } }));
    }
  }

  function fetchCategoriesAndRender() {
    const container = document.getElementById('categoriesContainer');
    const badge = document.getElementById('selectionBadge');
    const categoryCount = document.getElementById('categoryCount');
    const selectedServices = document.getElementById('selectedServices');

    if (!container) return;

    fetch('/api/categories')
      .then(res => res.json())
      .then(data => {
        container.innerHTML = '';
        selectedServices.innerHTML = '';

        const expats = JSON.parse(localStorage.getItem('expats') || '{}');
        selectedCategories = expats.provider_services || {};

        const categories = data?.categories || [];
        categories.forEach(cat => {
          categoryNames[cat.id] = cat.name;
        });

        const wrapper = document.createElement('div');
        wrapper.className = 'flex flex-wrap gap-3 justify-center';

        categories.forEach(cat => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'help-icon';
          btn.innerHTML = `
            <span class="check-indicator">✓</span>
            <div class="text-3xl mb-1 filter drop-shadow-sm">${getEmojiForCategory(cat.id)}</div>
            <span class="leading-tight">${cat.name}</span>
          `;
          btn.dataset.catId = cat.id;

          if (selectedCategories[cat.id]) {
            btn.classList.add('selected');
          }

          btn.addEventListener('click', function () {
            btn.classList.toggle('selected');

            if (btn.classList.contains('selected')) {
              selectedCategories[cat.id] = true;
            } else {
              delete selectedCategories[cat.id];
            }

            updateSelectionDisplay();
          });

          wrapper.appendChild(btn);
        });

        container.appendChild(wrapper);
        updateSelectionDisplay();
      })
      .catch(err => {
        console.error('Error loading categories:', err);
        container.innerHTML = '<p class="text-red-500 text-center">⚠️ Unable to load categories. Please refresh.</p>';
      });

    function updateSelectionDisplay() {
      const count = Object.keys(selectedCategories).length;
      categoryCount.textContent = `${count} service(s) selected`;

      if (count > 0) {
        badge.style.opacity = '1';
        chooseSubcatBtn.disabled = false;
      } else {
        badge.style.opacity = '0';
        chooseSubcatBtn.disabled = true;
      }

      selectedServices.innerHTML = '';
      Object.keys(selectedCategories).forEach(catId => {
        const span = document.createElement('span');
        span.className = 'selected-service-badge';
        span.textContent = categoryNames[catId] || 'Service';
        selectedServices.appendChild(span);
      });
    }
  }

  function showSubcategoryModal(subcategoriesByCat, selectedCategories) {
    // Bloquer le scroll du body
    document.body.style.overflow = 'hidden';
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
    modal.style.opacity = '0';
    modal.style.transition = 'opacity 0.2s';

    const totalCategories = Object.keys(subcategoriesByCat).length;
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    let selectedSubcats = expats.provider_subcategories || {};

    modal.innerHTML = `
      <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 text-white p-6 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
              <span class="text-2xl">🎯</span>
            </div>
            <div>
              <h2 class="text-2xl font-black">Choose Your Specialties</h2>
              <p class="text-blue-100 text-sm font-medium">Select at least one option for each service</p>
            </div>
          </div>
          <button id="closeSubcatModal" class="w-10 h-10 rounded-full bg-white bg-opacity-20 hover:bg-opacity-30 flex items-center justify-center backdrop-blur-sm transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <!-- Toast temporaire pour avertissement -->
        <div id="toastMessage" class="fixed top-6 left-1/2 -translate-x-1/2 px-6 py-3 bg-orange-500 text-white rounded-lg shadow-xl font-semibold text-sm z-50 hidden transition-all">
          You must select at least one specialty for each service you chose
        </div>

        <div id="subcatContent" class="flex-1 overflow-y-auto p-6 space-y-4"></div>

        <div class="p-6 bg-gradient-to-r from-gray-50 to-blue-50 border-t-2 border-gray-200 flex justify-between items-center gap-4">
          <button id="backToCategoriesBtn" type="button" class="nav-btn-back">
            Back
          </button>
          
          <div class="flex items-center gap-4">
            <div class="text-right">
              <div class="text-xs text-gray-500 font-medium">Progress</div>
              <div class="text-lg font-black text-blue-600">
                <span id="completedCount">0</span>/<span id="totalCount">${totalCategories}</span>
              </div>
            </div>
            <button id="saveSubcategoriesBtn" type="button" class="nav-btn-next">
              Continue
            </button>
          </div>
        </div>
      </div>
    `;

    document.body.appendChild(modal);
    setTimeout(() => modal.style.opacity = '1', 10);

    const subcatContent = modal.querySelector('#subcatContent');
    const toastMessage = modal.querySelector('#toastMessage');
    const saveBtn = modal.querySelector('#saveSubcategoriesBtn');
    const completedCountEl = modal.querySelector('#completedCount');

    function showToast() {
      toastMessage.classList.remove('hidden');
      setTimeout(() => {
        toastMessage.classList.add('hidden');
      }, 3000);
    }

    function updateProgress() {
      const completed = Object.keys(selectedSubcats).filter(catId => 
        Array.isArray(selectedSubcats[catId]) && selectedSubcats[catId].length > 0
      ).length;
      
      completedCountEl.textContent = completed;
      
      Object.entries(subcategoriesByCat).forEach(([catId, data]) => {
        const section = document.querySelector(`[data-section="${catId}"]`);
        if (section) {
          section.classList.remove('complete', 'incomplete');
          if (selectedSubcats[catId] && selectedSubcats[catId].length > 0) {
            section.classList.add('complete');
          } else {
            section.classList.add('incomplete');
          }
        }
      });
    }

    Object.entries(subcategoriesByCat).forEach(([catId, subcats], index) => {
      const catDiv = document.createElement('div');
      catDiv.className = 'category-section incomplete';
      catDiv.dataset.section = catId;

      const categoryName = subcats.categoryName || categoryNames[catId] || 'Category';
      const currentCount = selectedSubcats[catId]?.length || 0;
      
      catDiv.innerHTML = `
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center gap-2">
            <div class="relative">
              <svg class="w-10 h-10 progress-ring" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="16" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                <circle class="progress-ring-circle" cx="18" cy="18" r="16" fill="none" stroke="#0ea5e9" stroke-width="3" 
                  stroke-dasharray="100" stroke-dashoffset="100" stroke-linecap="round"/>
              </svg>
              <div class="absolute inset-0 flex items-center justify-center">
                <span class="font-black text-sm text-blue-600">${index + 1}</span>
              </div>
            </div>
            <div>
              <h3 class="font-bold text-base text-gray-900">${categoryName}</h3>
              <p class="text-xs text-orange-600 font-semibold flex items-center gap-1 mt-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                Required
              </p>
            </div>
          </div>
          <span class="subcat-counter-${catId} subcat-counter-badge ${currentCount > 0 ? 'filled' : 'empty'}">
            ${currentCount > 0 ? `<svg class="w-3.5 h-3.5 success-check" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>` : ''}
            <span>${currentCount}</span>
          </span>
        </div>
        <div class="mb-3 p-2.5 bg-blue-50 border-l-3 border-blue-400 rounded-r">
          <p class="text-xs text-blue-900 leading-snug">
            💡 Select at least 1 specialty or 
            <button type="button" onclick="document.querySelector('#backToCategoriesBtn').click()" class="underline font-semibold hover:text-blue-700">
              remove this service
            </button>
          </p>
        </div>
      `;

      const grid = document.createElement('div');
      grid.className = 'flex flex-wrap gap-2';

      (subcats.subcategories || []).forEach(subcat => {
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'subcat-chip';
        chip.innerHTML = `<span>${subcat.name}</span>`;
        chip.dataset.catId = catId;
        chip.dataset.subcatId = subcat.id;

        if (selectedSubcats[catId] && selectedSubcats[catId].includes(subcat.id)) {
          chip.classList.add('selected');
        }

        chip.addEventListener('click', function () {
          chip.classList.toggle('selected');

          selectedSubcats[catId] = selectedSubcats[catId] || [];
          const exists = selectedSubcats[catId].includes(subcat.id);
          selectedSubcats[catId] = exists
            ? selectedSubcats[catId].filter(id => id !== subcat.id)
            : selectedSubcats[catId].concat(subcat.id);

          const counter = document.querySelector(`.subcat-counter-${catId}`);
          const count = selectedSubcats[catId].length;
          
          // AMÉLIORATION : Badge avec icône de succès
          if (count > 0) {
            counter.className = `subcat-counter-${catId} subcat-counter-badge filled`;
            counter.innerHTML = `
              <svg class="w-4 h-4 success-check" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span>${count}</span>
            `;
          } else {
            counter.className = `subcat-counter-${catId} subcat-counter-badge empty`;
            counter.textContent = '0';
          }

          updateProgress();
        });

        grid.appendChild(chip);
      });

      catDiv.appendChild(grid);
      subcatContent.appendChild(catDiv);
      
      // Initialiser le compteur
      const counter = document.querySelector(`.subcat-counter-${catId}`);
      const count = selectedSubcats[catId]?.length || 0;
      if (count > 0) {
        counter.className = `subcat-counter-${catId} subcat-counter-badge filled`;
        counter.innerHTML = `
          <svg class="w-4 h-4 success-check" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
          <span>${count}</span>
        `;
      }
    });

    modal.querySelector('#closeSubcatModal').onclick = () => {
      document.body.style.overflow = '';
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    modal.querySelector('#backToCategoriesBtn').onclick = () => {
      const hasSelections = Object.values(selectedSubcats).some(arr => arr && arr.length > 0);
      
      if (hasSelections) {
        const confirmBack = confirm('⚠️ Your specialty selections will be lost.\n\nAre you sure you want to go back?');
        if (!confirmBack) return;
      }
      
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      delete expats.provider_subcategories;
      localStorage.setItem('expats', JSON.stringify(expats));
      
      document.body.style.overflow = '';
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        document.body.style.overflow = '';
        modal.style.opacity = '0';
        setTimeout(() => modal.remove(), 200);
      }
    });

    saveBtn.onclick = function () {
      const completed = Object.keys(selectedSubcats).filter(catId => 
        Array.isArray(selectedSubcats[catId]) && selectedSubcats[catId].length > 0
      ).length;
      
      if (completed !== totalCategories) {
        showToast();
        
        // Trouver la première section manquante et scroller
        const missing = Object.entries(subcategoriesByCat).find(([catId, data]) => 
          !selectedSubcats[catId] || selectedSubcats[catId].length === 0
        );
        
        if (missing) {
          const [catId] = missing;
          const section = document.querySelector(`[data-section="${catId}"]`);
          if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'center' });
            section.classList.add('shake');
            setTimeout(() => section.classList.remove('shake'), 400);
          }
        }
        
        return;
      }
      
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.provider_services = selectedCategories;
      expats.provider_subcategories = selectedSubcats;
      localStorage.setItem('expats', JSON.stringify(expats));

      document.body.style.overflow = '';
      modal.style.opacity = '0';
      setTimeout(() => {
        modal.remove();
        goToStep(NEXT_STEP_ID);
      }, 200);
    };

    updateProgress();
  }

  const observer = new MutationObserver(() => {
    if (!step4.classList.contains('hidden')) {
      if (!step4.dataset.loaded) {
        fetchCategoriesAndRender();
        step4.dataset.loaded = '1';
      }
    }
  });
  observer.observe(step4, { attributes: true, attributeFilter: ['class'] });

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
      showSubcategoryModal(subcategoriesByCat, selectedCategories);
    }).finally(() => {
      chooseSubcatBtn.disabled = false;
      chooseSubcatBtn.innerHTML = '<span>Choose Subcategories</span>';
    });
  });

  backToStep3?.addEventListener('click', function () {
    goToStep(PREV_STEP_ID);
  });
});
</script>