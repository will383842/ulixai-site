<!-- STEP 4 - PROVIDER SERVICES - FINAL OPTIMIZED -->

<div id="step4" class="hidden">
  
  <div class="ambient-bg" aria-hidden="true"></div>

  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="header-icon">
        <span class="text-3xl">🛠️</span>
      </div>
      <h2 class="header-title">
        What kind of help do you provide?
      </h2>
    </div>
    <p class="header-subtitle">
      Select your services and specialties
    </p>
    
    <div id="selectionBadge" class="selection-badge" style="opacity: 0;">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span id="categoryCount" class="text-sm font-bold text-blue-700">0 service(s) selected</span>
    </div>
  </div>

  <div id="categoriesContainer" class="categories-grid"></div>

  <div class="nav-container">
    <button id="backToStep3" class="nav-btn-back">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button id="chooseSubcatBtn" class="nav-btn-next" disabled>
      <span>Choose Subcategories</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
      </svg>
    </button>

    <button id="nextStep4" class="nav-btn-next" style="display: none;">
      <span>Next Step</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
      </svg>
    </button>
  </div>
</div>

<style>
/* Critical CSS */
#step4{position:relative;min-height:400px}
.ambient-bg{position:absolute;inset:0;z-index:-10;overflow:hidden;pointer-events:none}
.ambient-bg::before,.ambient-bg::after{content:'';position:absolute;width:16rem;height:16rem;border-radius:50%;mix-blend-mode:multiply;filter:blur(64px);opacity:.2}
.ambient-bg::before{top:2.5rem;left:2.5rem;background:#93c5fd;animation:blob 7s infinite}
.ambient-bg::after{top:2.5rem;right:2.5rem;background:#67e8f9;animation:blob 7s 2s infinite}

.header-icon{width:3.5rem;height:3.5rem;border-radius:1rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.1);background:linear-gradient(to bottom right,#3b82f6,#06b6d4,#14b8a6);display:flex;align-items:center;justify-content:center}
.header-title{font-size:clamp(1.5rem,5vw,2.25rem);font-weight:900;background:linear-gradient(to right,#2563eb,#06b6d4,#14b8a6);-webkit-background-clip:text;background-clip:text;color:transparent}
.header-subtitle{font-size:clamp(0.875rem,2vw,1.125rem);font-weight:600;color:#4b5563;margin-bottom:.75rem}

.selection-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;background:linear-gradient(to right,#eff6ff,#cffafe);border:1px solid #bfdbfe;border-radius:9999px;transition:opacity .2s}

.categories-grid{display:flex;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;justify-content:center}

.help-icon{position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.75rem;padding:1rem;border-radius:1rem;border:2px solid transparent;cursor:pointer;background:linear-gradient(to bottom right,#2563eb,#0891b2);box-shadow:0 4px 6px -1px rgba(0,0,0,.1);color:#fff;font-weight:600;text-align:center;width:140px;min-height:96px;transition:transform .2s,box-shadow .2s}
.help-icon:hover{transform:translateY(-.5rem) scale(1.02);box-shadow:0 20px 25px -5px rgba(0,0,0,.2)}
.help-icon.selected{background:linear-gradient(to bottom right,#16a34a,#059669);border-color:#22c55e;box-shadow:0 8px 16px -4px rgba(34,197,94,.4);transform:scale(1.05)}

.check-indicator{position:absolute;top:.5rem;right:.5rem;width:1.5rem;height:1.5rem;background:#22c55e;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;opacity:0;transform:scale(0);transition:all .2s;font-size:.75rem;font-weight:700}
.help-icon.selected .check-indicator{opacity:1;transform:scale(1)}

.nav-container{display:flex;justify-content:space-between;align-items:center;gap:1rem;padding-top:1.5rem;border-top:2px solid #f3f4f6}

.nav-btn-back,.nav-btn-next{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.875rem 1.5rem;font-weight:600;border-radius:1rem;min-height:48px;flex:1;max-width:200px;transition:all .2s;cursor:pointer;outline:none}
.nav-btn-back{color:#2563eb;background:#fff;border:2px solid #e5e7eb}
.nav-btn-back:hover{background:rgba(59,130,246,.05);border-color:#2563eb}
.nav-btn-next{color:#fff;background:linear-gradient(to right,#2563eb,#0891b2);box-shadow:0 4px 6px -1px rgba(59,130,246,.3);border:none}
.nav-btn-next:hover:not(:disabled){box-shadow:0 10px 15px -3px rgba(59,130,246,.4);transform:translateY(-2px)}
.nav-btn-next:disabled{opacity:.5;cursor:not-allowed;transform:none}

.subcat-chip{position:relative;padding:.625rem 1rem;border-radius:.75rem;border:2px solid #bfdbfe;background:#fff;color:#1e3a8a;font-weight:600;font-size:.875rem;cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:.5rem}
.subcat-chip:hover{border-color:#60a5fa;background:#eff6ff}
.subcat-chip.selected{background:linear-gradient(to right,#2563eb,#0891b2);color:#fff;border-color:#1d4ed8}
.subcat-chip.selected::before{content:'✓';display:inline-flex;align-items:center;justify-content:center;width:1.25rem;height:1.25rem;background:#fff;color:#2563eb;border-radius:50%;font-size:.75rem;font-weight:700;margin-right:-.25rem}

.category-section{background:#fff;border:2px solid #e5e7eb;border-radius:1rem;padding:1.25rem;transition:all .3s}
.category-section.complete{border-color:#22c55e;background:rgba(240,253,244,.5)}
.category-section.incomplete{border-color:#fb923c;background:rgba(255,247,237,.5)}
.category-section.shake{animation:shake .4s}

@keyframes shake{0%,100%{transform:translateX(0)}10%,30%,50%,70%,90%{transform:translateX(-4px)}20%,40%,60%,80%{transform:translateX(4px)}}

.subcat-counter-badge{display:inline-flex;align-items:center;gap:.375rem;padding:.375rem .75rem;border-radius:9999px;font-size:.875rem;font-weight:600;transition:all .2s}
.subcat-counter-badge.empty{background:#e5e7eb;color:#6b7280}
.subcat-counter-badge.filled{background:linear-gradient(to right,#22c55e,#10b981);color:#fff;box-shadow:0 4px 6px -1px rgba(34,197,94,.3)}

.toast-warning{position:fixed;top:1.5rem;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#fb923c,#f97316);color:#fff;padding:1rem 1.5rem;border-radius:1rem;box-shadow:0 10px 25px rgba(251,146,60,.4);font-weight:600;z-index:10000;animation:slideDown .3s}

@keyframes slideDown{from{opacity:0;transform:translateX(-50%) translateY(-20px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}
@keyframes blob{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(30px,-50px) scale(1.1)}66%{transform:translate(-20px,20px) scale(.9)}}

@media (max-width:640px){
  .categories-grid{gap:.75rem}
  .help-icon{width:120px;min-height:88px;font-size:.8rem}
}
</style>

<script>
(function() {
  'use strict';
  
  const PREV_STEP_ID = 'step3';
  const NEXT_STEP_ID = 'step5';
  
  // Pool d'emojis fun et variés pour futures catégories
  const EMOJI_POOL = [
    '🎨', '🎭', '🎪', '🎬', '🎤', '🎧', '🎮', '🎯', '🎲', '🎰',
    '🌟', '⭐', '✨', '💫', '🌈', '🦋', '🌺', '🌸', '🌻', '🌼',
    '🍕', '🍔', '🍰', '🎂', '🍩', '🧁', '🍪', '☕', '🍵', '🥤',
    '🏆', '🥇', '🎖️', '🏅', '🎗️', '🎀', '💝', '💖', '💗', '💓',
    '🚀', '✈️', '🛸', '🎈', '🎁', '🎊', '🎉', '🧩', '🎲', '🃏',
    '📱', '💻', '⌨️', '🖥️', '🖨️', '📷', '📸', '🎥', '📹', '🎬'
  ];
  
  // Mapping catégories connues avec emojis fun
  const EMOJI_MAP = {
    'Home Services': '🏡',
    'Childcare': '👶',
    'Education': '📚',
    'Health & Wellness': '💪',
    'Legal Services': '📋',
    'Financial Services': '💰',
    'Technology': '💻',
    'Transportation': '🚗',
    'Language Services': '🌍',
    'Pet Care': '🐾',
    'Event Planning': '🎉',
    'Business Services': '💼',
    'Beauty & Spa': '💅',
    'Fitness': '🏋️',
    'Coaching': '🎯',
    'Consulting': '📊',
    'Real Estate': '🏘️',
    'Marketing': '📱',
    'Design': '🎨',
    'Photography': '📸',
    'Music': '🎵',
    'Arts & Crafts': '🎭',
    'Food & Catering': '🍽️',
    'Cleaning': '✨',
    'Gardening': '🌻',
    'Plumbing': '🚰',
    'Electrical': '💡',
    'Carpentry': '🪵',
    'Painting': '🖌️',
    'Moving': '📦'
  };
  
  let emojiPoolIndex = 0;
  let selectedCategories = {};
  let categoriesCache = null;
  
  let step4, backToStep3, nextStep4, categoriesContainer, selectionBadge, categoryCount, chooseSubcatBtn;

  const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => fn(...args), delay);
    };
  };

  const goToStep = (stepId) => {
    document.querySelectorAll('[id^="step"]').forEach(el => el.classList.add('hidden'));
    const target = document.getElementById(stepId);
    if (target) {
      target.classList.remove('hidden');
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.dispatchEvent(new CustomEvent('wizard:stepchange', { detail: { stepId } }));
    }
  };

  const safeShow = (el) => el && (el.style.display = '');
  const safeHide = (el) => el && (el.style.display = 'none');

  const getEmoji = (name) => {
    // Si catégorie connue, utiliser mapping
    if (EMOJI_MAP[name]) return EMOJI_MAP[name];
    
    // Sinon prendre du pool et incrémenter
    const emoji = EMOJI_POOL[emojiPoolIndex % EMOJI_POOL.length];
    emojiPoolIndex++;
    return emoji;
  };

  const updateSelectionDisplay = debounce(() => {
    if (!categoryCount || !selectionBadge || !chooseSubcatBtn) return;
    
    const count = Object.keys(selectedCategories).length;
    categoryCount.textContent = `${count} service(s) selected`;
    selectionBadge.style.opacity = count > 0 ? '1' : '0';
    chooseSubcatBtn.disabled = count === 0;
  }, 100);

  const renderCategories = (categories) => {
    if (!categoriesContainer) return;
    
    categoriesContainer.innerHTML = '';

    categories.forEach((cat) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'help-icon';
      btn.dataset.id = cat.id;

      const emoji = getEmoji(cat.name);
      
      if (cat.icon_image) {
        btn.innerHTML = `<div class="check-indicator">✓</div><div style="width:2rem;height:2rem;display:flex;align-items:center;justify-content:center;margin-bottom:.25rem"><img src="${cat.icon_image}" alt="${cat.name}" style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 1px 2px rgba(0,0,0,.1))" loading="lazy"></div><span style="font-size:.875rem;font-weight:600;line-height:1.25">${cat.name}</span>`;
      } else {
        btn.innerHTML = `<div class="check-indicator">✓</div><span style="font-size:1.875rem;filter:drop-shadow(0 1px 2px rgba(0,0,0,.1))">${emoji}</span><span style="font-size:.875rem;font-weight:600;line-height:1.25">${cat.name}</span>`;
      }

      btn.addEventListener('click', function() {
        this.classList.toggle('selected');
        const catId = this.dataset.id;
        
        if (selectedCategories[catId]) {
          delete selectedCategories[catId];
        } else {
          selectedCategories[catId] = cat.name;
        }
        
        updateSelectionDisplay();
      });

      categoriesContainer.appendChild(btn);
    });
  };

  const fetchCategories = async () => {
    if (categoriesCache) return categoriesCache;
    
    try {
      const res = await fetch('/api/categories');
      const data = await res.json();
      if (data?.success && Array.isArray(data.categories)) {
        categoriesCache = data.categories;
        return categoriesCache;
      }
    } catch (err) {
      console.error('Error fetching categories:', err);
    }
    return [];
  };

  const showToast = (message) => {
    const existing = document.querySelector('.toast-warning');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = 'toast-warning';
    toast.innerHTML = `<div style="display:flex;align-items:center;gap:.5rem"><svg style="width:1.25rem;height:1.25rem" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg><span>${message}</span></div>`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  };

  const showSubcategoryModal = (subcategoriesByCat) => {
    const existingModal = document.getElementById('subcategoriesModal');
    if (existingModal) existingModal.remove();

    const modal = document.createElement('div');
    modal.id = 'subcategoriesModal';
    modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4';
    modal.style.cssText = 'background:rgba(0,0,0,.5);backdrop-filter:blur(4px);opacity:0;transition:opacity .2s';

    const totalCategories = Object.keys(subcategoriesByCat).length;
    const selectedSubcats = {};
    let completedCategories = 0;

    // Modal plus large sur desktop (max-w-7xl), full sur mobile
    const modalHTML = `
      <div class="bg-white rounded-3xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl" style="max-width:min(80rem,95vw)">
        <div class="bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 text-white p-6 flex items-center justify-between flex-wrap gap-4">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
              <span class="text-2xl">🎯</span>
            </div>
            <div>
              <h3 class="text-2xl font-black">Choose Your Specialties</h3>
              <p class="text-sm text-white/90 font-medium mt-0.5">Select at least one for each service</p>
            </div>
          </div>
          <div class="flex items-center gap-3">
            <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2 flex items-center gap-2">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              <span id="progressText" class="font-black text-lg">${completedCategories}/${totalCategories}</span>
            </div>
            <button type="button" id="closeSubcatModal" class="w-10 h-10 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-sm flex items-center justify-center transition-all">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
          </div>
        </div>
        
        <div id="subcatContent" class="flex-1 overflow-y-auto p-6" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,400px),1fr));gap:1.25rem"></div>
        
        <div class="p-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row gap-3 justify-between">
          <button type="button" id="backToCategoriesBtn" class="w-full sm:flex-1 sm:max-w-[240px] bg-white text-gray-700 border-2 border-gray-200 font-semibold py-3 px-6 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Change Services</span>
          </button>
          <button type="button" id="saveSubcatBtn" class="w-full sm:flex-1 sm:max-w-[240px] bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-3 px-6 rounded-xl hover:shadow-xl hover:scale-105 transition-all flex items-center justify-center gap-2" disabled style="opacity:.5;cursor:not-allowed">
            <span>Save & Continue</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </div>
      </div>
    `;

    modal.innerHTML = modalHTML;
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';

    setTimeout(() => modal.style.opacity = '1', 10);

    const subcatContent = modal.querySelector('#subcatContent');
    const saveBtn = modal.querySelector('#saveSubcatBtn');
    const progressText = modal.querySelector('#progressText');

    const updateProgress = debounce(() => {
      completedCategories = Object.keys(selectedSubcats).filter(catId => 
        Array.isArray(selectedSubcats[catId]) && selectedSubcats[catId].length > 0
      ).length;
      progressText.textContent = `${completedCategories}/${totalCategories}`;
      
      if (completedCategories === totalCategories) {
        saveBtn.disabled = false;
        saveBtn.style.opacity = '1';
        saveBtn.style.cursor = 'pointer';
      } else {
        saveBtn.disabled = true;
        saveBtn.style.opacity = '.5';
        saveBtn.style.cursor = 'not-allowed';
      }

      Object.entries(subcategoriesByCat).forEach(([catId]) => {
        const section = document.querySelector(`[data-section="${catId}"]`);
        const hasSubcats = selectedSubcats[catId] && selectedSubcats[catId].length > 0;
        
        if (section) {
          section.classList.remove('complete', 'incomplete');
          section.classList.add(hasSubcats ? 'complete' : 'incomplete');
        }
      });
    }, 50);

    Object.entries(subcategoriesByCat).forEach(([catId, subcats], index) => {
      const categoryName = subcats.categoryName || selectedCategories[catId] || 'Service';
      
      const catDiv = document.createElement('div');
      catDiv.className = 'category-section';
      catDiv.dataset.section = catId;
      
      catDiv.innerHTML = `
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="relative w-10 h-10">
              <svg class="w-full h-full" viewBox="0 0 36 36" style="transform:rotate(-90deg)">
                <circle cx="18" cy="18" r="16" fill="none" stroke="#e5e7eb" stroke-width="3"/>
                <circle cx="18" cy="18" r="16" fill="none" stroke="#2563eb" stroke-width="3" stroke-dasharray="100" stroke-dashoffset="100" stroke-linecap="round"/>
              </svg>
              <div class="absolute inset-0 flex items-center justify-center">
                <span class="font-black text-sm text-blue-600">${index + 1}</span>
              </div>
            </div>
            <div>
              <h3 class="text-base font-semibold text-gray-900">${categoryName}</h3>
              <p class="text-xs text-orange-600 font-semibold flex items-center gap-1 mt-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                Required
              </p>
            </div>
          </div>
          <span class="subcat-counter-${catId} subcat-counter-badge empty"><span>0</span></span>
        </div>
        <div class="mb-3 p-2.5 bg-blue-50 border-l-4 border-blue-400 rounded-r">
          <p class="text-xs text-blue-900 leading-snug">
            💡 <strong>Select at least 1 specialty</strong> or go back to 
            <button type="button" onclick="document.querySelector('#backToCategoriesBtn').click()" class="underline font-semibold hover:text-blue-700">
              change your services selection
            </button>
          </p>
        </div>
      `;

      const grid = document.createElement('div');
      grid.className = 'flex flex-wrap gap-2 mt-3';

      (subcats.subcategories || []).forEach(subcat => {
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'subcat-chip';
        chip.innerHTML = `<span>${subcat.name}</span>`;
        chip.dataset.catId = catId;
        chip.dataset.subcatId = subcat.id;

        chip.addEventListener('click', function() {
          this.classList.toggle('selected');

          selectedSubcats[catId] = selectedSubcats[catId] || [];
          const exists = selectedSubcats[catId].includes(subcat.id);
          selectedSubcats[catId] = exists
            ? selectedSubcats[catId].filter(id => id !== subcat.id)
            : [...selectedSubcats[catId], subcat.id];

          const counter = document.querySelector(`.subcat-counter-${catId}`);
          const count = selectedSubcats[catId].length;
          
          if (count > 0) {
            counter.className = `subcat-counter-${catId} subcat-counter-badge filled`;
            counter.innerHTML = `<svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span>${count}</span>`;
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
    });

    modal.querySelector('#closeSubcatModal').onclick = () => {
      document.body.style.overflow = '';
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    modal.querySelector('#backToCategoriesBtn').onclick = () => {
      const hasSelections = Object.values(selectedSubcats).some(arr => arr && arr.length > 0);
      
      if (hasSelections) {
        const confirmModal = document.createElement('div');
        confirmModal.className = 'fixed inset-0 z-[60] flex items-center justify-center p-4';
        confirmModal.style.cssText = 'background:rgba(0,0,0,.6);backdrop-filter:blur(4px);opacity:0;transition:opacity .2s';
        
        confirmModal.innerHTML = `
          <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
            <div class="flex items-start gap-4 mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
              </div>
              <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Go back to change services?</h3>
                <p class="text-sm text-gray-600">Your specialty selections will be lost if you go back to modify your services.</p>
              </div>
            </div>
            <div class="flex gap-3">
              <button type="button" class="confirm-cancel flex-1 bg-white text-gray-700 border-2 border-gray-200 font-semibold py-2.5 px-4 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all">Stay Here</button>
              <button type="button" class="confirm-ok flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold py-2.5 px-4 rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all">Go Back</button>
            </div>
          </div>
        `;
        
        document.body.appendChild(confirmModal);
        setTimeout(() => confirmModal.style.opacity = '1', 10);
        
        confirmModal.querySelector('.confirm-cancel').onclick = () => {
          confirmModal.style.opacity = '0';
          setTimeout(() => confirmModal.remove(), 200);
        };
        
        confirmModal.querySelector('.confirm-ok').onclick = () => {
          const expats = JSON.parse(localStorage.getItem('expats') || '{}');
          delete expats.provider_subcategories;
          localStorage.setItem('expats', JSON.stringify(expats));
          
          confirmModal.style.opacity = '0';
          setTimeout(() => confirmModal.remove(), 200);
          
          document.body.style.overflow = '';
          modal.style.opacity = '0';
          setTimeout(() => modal.remove(), 200);
        };
        
        return;
      }
      
      document.body.style.overflow = '';
      modal.style.opacity = '0';
      setTimeout(() => modal.remove(), 200);
    };

    saveBtn.onclick = () => {
      const completed = Object.keys(selectedSubcats).filter(catId => 
        Array.isArray(selectedSubcats[catId]) && selectedSubcats[catId].length > 0
      ).length;
      
      if (completed !== totalCategories) {
        showToast('⚠️ Please select at least one specialty for each service');
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
        safeShow(backToStep3);
        safeShow(nextStep4);
        safeHide(chooseSubcatBtn);
        goToStep(NEXT_STEP_ID);
      }, 200);
    };

    updateProgress();
  };

  const init = async () => {
    step4 = document.getElementById('step4');
    if (!step4) return;

    backToStep3 = document.getElementById('backToStep3');
    nextStep4 = document.getElementById('nextStep4');
    categoriesContainer = document.getElementById('categoriesContainer');
    selectionBadge = document.getElementById('selectionBadge');
    categoryCount = document.getElementById('categoryCount');
    chooseSubcatBtn = document.getElementById('chooseSubcatBtn');

    const mutationObserver = new MutationObserver(() => {
      if (!step4.classList.contains('hidden')) {
        if (!step4.dataset.loaded) {
          fetchCategories().then(categories => {
            renderCategories(categories);
            step4.dataset.loaded = '1';
          });
        }
        // Sur step4 : back visible, chooseSubcat visible, nextStep caché
        safeShow(backToStep3);
        safeShow(chooseSubcatBtn);
        safeHide(nextStep4);
      }
    });
    mutationObserver.observe(step4, { attributes: true, attributeFilter: ['class'] });

    chooseSubcatBtn?.addEventListener('click', async () => {
      const catIds = Object.keys(selectedCategories);
      if (catIds.length === 0) {
        showToast('⚠️ Please select at least one service');
        return;
      }

      chooseSubcatBtn.disabled = true;

      try {
        const results = await Promise.all(
          catIds.map(catId =>
            fetch(`/api/categories/${catId}/subcategories`)
              .then(res => res.json())
              .then(data => ({
                catId,
                categoryName: data?.category?.name || selectedCategories[catId] || 'Service',
                subcategories: data?.subcategories || []
              }))
          )
        );

        const subcategoriesByCat = {};
        results.forEach(r => {
          subcategoriesByCat[r.catId] = {
            categoryName: r.categoryName,
            subcategories: r.subcategories
          };
        });
        
        showSubcategoryModal(subcategoriesByCat);
      } finally {
        chooseSubcatBtn.disabled = false;
      }
    });

    nextStep4?.addEventListener('click', () => goToStep(NEXT_STEP_ID));
    backToStep3?.addEventListener('click', () => goToStep(PREV_STEP_ID));
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>