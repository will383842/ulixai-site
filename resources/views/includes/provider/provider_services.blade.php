<!-- 
============================================
🚀 STEP 4 - PROVIDER SERVICES (FIXED)
🔧 SOLUTION SIMPLE:
- ✅ Click "Next" → Ouvre le modal si nécessaire
- ✅ Click "Save Specialties" → Sauvegarde + Navigation directe vers Step 5
- ✅ Réinitialisation systématique quand on arrive sur Step 4
- ✅ Pas de flag compliqué, juste comme l'ancien code qui fonctionnait
============================================
-->

<div id="step4" class="hidden flex flex-col h-full" role="region" aria-label="Select your services">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What Services Do You Provide? 🛠️
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select all the services you can offer
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step4SelectedCount">0</span> service(s) selected
        </span>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <div id="step4ServiceError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select at least one service</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose the services you provide</p>
        </div>
      </div>
    </div>

    <div id="servicesGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-3 lg:gap-3.5" role="group" aria-label="Select services you provide">
      <div class="col-span-full text-center py-8 text-gray-400">
        <div class="flex flex-col items-center gap-2">
          <svg class="w-12 h-12 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <p class="text-sm font-medium">Loading services...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
#step4 {
  position: relative;
  min-height: 100%;
}

#step4 .sticky {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
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

.service-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.625rem;
  padding: 1rem 0.75rem;
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e2e8f0;
  border-radius: 1rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  min-height: 100px;
}

.service-card:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
  border-color: #60a5fa;
  background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
}

.service-card:active {
  transform: translateY(-2px) scale(1);
}

.service-card.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  border-color: #1d4ed8;
  color: white;
  box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.5);
  transform: scale(1.05);
}

.service-card.selected:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6);
}

.service-icon {
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  transition: transform 0.2s;
}

.service-card:hover .service-icon {
  transform: scale(1.15) rotate(5deg);
}

.service-card.selected .service-icon {
  transform: scale(1.2);
}

.service-name {
  font-size: 0.875rem;
  font-weight: 600;
  text-align: center;
  line-height: 1.3;
  color: #1e293b;
  transition: color 0.2s;
}

.service-card.selected .service-name {
  color: white;
}

.check-indicator {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  width: 1.375rem;
  height: 1.375rem;
  background: #22c55e;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
  box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);
}

.service-card.selected .check-indicator {
  opacity: 1;
  transform: scale(1);
}

.shake-animation {
  animation: shake 0.4s;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

@media (max-width: 639px) {
  #step4 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step4 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step4 p {
    font-size: 0.8125rem;
  }
  
  .service-card {
    padding: 0.875rem 0.625rem;
    min-height: 90px;
  }
  
  .service-icon {
    width: 2rem;
    height: 2rem;
    font-size: 1.25rem;
  }
  
  .service-name {
    font-size: 0.8125rem;
  }
}

@media (min-width: 640px) and (max-width: 1023px) {
  .service-card {
    padding: 0.875rem 0.625rem;
  }
  
  .service-icon {
    width: 2.375rem;
    height: 2.375rem;
  }
}

@media (min-width: 1024px) {
  .service-card {
    padding: 1rem 0.75rem;
  }
  
  .service-icon {
    width: 2.75rem;
    height: 2.75rem;
    font-size: 1.75rem;
  }
  
  .service-name {
    font-size: 0.9375rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  .service-card {
    border: 3px solid currentColor;
  }
  
  .service-card.selected {
    border: 3px solid #1d4ed8;
  }
}

.service-card,
.check-indicator,
.service-icon {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

.service-card {
  contain: layout style paint;
}

.service-section {
  padding: 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 1rem;
  transition: all 0.3s;
}

.service-section.complete {
  border-color: #22c55e;
  background: rgba(240, 253, 244, 0.3);
}

.service-section.incomplete {
  border-color: #fb923c;
  background: rgba(255, 247, 237, 0.3);
}

.subcat-chip {
  padding: 0.5rem 1rem;
  border-radius: 0.75rem;
  border: 2px solid #bfdbfe;
  background: white;
  color: #1e3a8a;
  font-weight: 600;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.15s;
}

.subcat-chip:hover {
  border-color: #60a5fa;
  background: #eff6ff;
}

.subcat-chip.selected {
  background: linear-gradient(to right, #2563eb, #0891b2);
  color: white;
  border-color: #1d4ed8;
}
</style>

<script>
// ============================================
// GLOBAL STATE
// ============================================
if (!window.selectedServices) {
  window.selectedServices = {};
}
if (!window.selectedSubcategories) {
  window.selectedSubcategories = {};
}
if (typeof window.specialtiesModalOpen === 'undefined') {
  window.specialtiesModalOpen = false;
}

// Pas de flag compliqué nécessaire

// Cache API
const API_CACHE = {
  categories: null,
  subcategories: {}
};

// ============================================
// EMOJI MAPPING
// ============================================
const EMOJI_MAP = {
  'Home Services': '🏡',
  'Childcare': '👶',
  'Education': '📚',
  'Health & Wellness': '💪',
  'Legal Services': '⚖️',
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

const EMOJI_POOL = [
  '🎨', '🎭', '🎪', '🎬', '🎤', '🎧', '🎮', '🎯', '🎲', '🎰',
  '🌟', '⭐', '✨', '💫', '🌈', '🦋', '🌺', '🌸', '🌻', '🌼',
  '🍕', '🍔', '🍰', '🎂', '🍩', '🧁', '🍪', '☕', '🍵', '🥤',
  '🏆', '🥇', '🎖️', '🏅', '🎗️', '🎀', '💝', '💖', '💗', '💓',
  '🚀', '✈️', '🛸', '🎈', '🎁', '🎊', '🎉', '🧩', '🎲', '🃏'
];

let emojiPoolIndex = 0;

function getEmojiForCategory(categoryName) {
  if (EMOJI_MAP[categoryName]) {
    return EMOJI_MAP[categoryName];
  }
  const emoji = EMOJI_POOL[emojiPoolIndex % EMOJI_POOL.length];
  emojiPoolIndex++;
  return emoji;
}

// ============================================
// UTILITY FUNCTIONS
// ============================================

function normalizeId(id) {
  return String(id);
}

function showFunMessage(text) {
  const existing = document.getElementById('funMessage');
  if (existing) existing.remove();
  
  const msg = document.createElement('div');
  msg.id = 'funMessage';
  msg.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[60] bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-full shadow-2xl font-bold text-sm sm:text-base animate-bounce';
  msg.textContent = text;
  document.body.appendChild(msg);
  
  setTimeout(() => msg.remove(), 3000);
}

function updateCount() {
  const selectedCount = document.getElementById('step4SelectedCount');
  if (selectedCount) {
    selectedCount.textContent = Object.keys(window.selectedServices).length;
  }
}

function hideError() {
  const errorAlert = document.getElementById('step4ServiceError');
  if (errorAlert && !errorAlert.classList.contains('hidden')) {
    errorAlert.classList.add('hidden');
  }
}

function showError() {
  const errorAlert = document.getElementById('step4ServiceError');
  if (errorAlert) {
    errorAlert.classList.remove('hidden');
    errorAlert.classList.add('shake-animation');
    setTimeout(() => {
      errorAlert.classList.remove('shake-animation');
    }, 500);
  }
}

// ============================================
// SERVICE SELECTION
// ============================================
window.selectService = function(card) {
  if (!card) return;
  
  const serviceId = normalizeId(card.getAttribute('data-service-id'));
  const serviceName = card.getAttribute('data-service-name');
  
  if (!serviceId || !serviceName) return;
  
  if (window.selectedServices[serviceId]) {
    delete window.selectedServices[serviceId];
    card.classList.remove('selected');
    card.setAttribute('aria-checked', 'false');
    
    if (window.selectedSubcategories[serviceId]) {
      delete window.selectedSubcategories[serviceId];
    }
  } else {
    window.selectedServices[serviceId] = serviceName;
    card.classList.add('selected');
    card.setAttribute('aria-checked', 'true');
  }
  
  updateCount();
  hideError();
  saveToLocalStorage();
  
  if (typeof window.updateNavigationButtons === 'function') {
    window.updateNavigationButtons();
  }
};

// ============================================
// VALIDATION - LOGIQUE SIMPLE
// ============================================
window.validateStep4 = function() {
  const serviceIds = Object.keys(window.selectedServices);
  
  // 1. Vérifier qu'au moins un service est sélectionné
  if (serviceIds.length === 0) {
    showError();
    return false;
  }
  
  // 2. Vérifier si on a déjà des sous-catégories pour tous les services
  const hasSubcatsForAll = serviceIds.every(serviceId => {
    return window.selectedSubcategories[serviceId] !== undefined;
  });
  
  // Si on n'a pas de sous-catégories pour tous → ouvrir le modal
  if (!hasSubcatsForAll) {
    showSpecialtiesModal();
    return false;
  }
  
  // 3. Tout est OK, on peut passer au step suivant
  return true;
};

// ============================================
// API CALLS WITH CACHE
// ============================================
async function loadCategories() {
  if (API_CACHE.categories) {
    return API_CACHE.categories;
  }
  
  const response = await fetch('/api/categories');
  const data = await response.json();
  API_CACHE.categories = data.categories || [];
  return API_CACHE.categories;
}

async function loadSubcategories(serviceId) {
  const normalizedId = normalizeId(serviceId);
  
  if (API_CACHE.subcategories[normalizedId]) {
    return API_CACHE.subcategories[normalizedId];
  }
  
  const response = await fetch(`/api/categories/${normalizedId}/subcategories`);
  const data = await response.json();
  const result = {
    serviceId: normalizedId,
    serviceName: data?.category?.name || window.selectedServices[normalizedId] || 'Service',
    subcategories: (data?.subcategories || []).map(sub => ({
      ...sub,
      id: normalizeId(sub.id)
    }))
  };
  
  API_CACHE.subcategories[normalizedId] = result;
  return result;
}

// ============================================
// LOAD SERVICES
// ============================================
async function loadServices() {
  const servicesGrid = document.getElementById('servicesGrid');
  
  if (!servicesGrid) return;
  
  try {
    const categories = await loadCategories();
    
    if (categories.length === 0) {
      servicesGrid.innerHTML = `
        <div class="col-span-full text-center py-8 text-gray-500">
          <p class="text-sm font-medium">No services available</p>
        </div>
      `;
      return;
    }
    
    const cardsHTML = categories.map(category => {
      const categoryId = normalizeId(category.id);
      const emoji = getEmojiForCategory(category.name);
      return `
        <button 
          type="button"
          class="service-card"
          data-service-id="${categoryId}"
          data-service-name="${category.name}"
          role="checkbox"
          aria-checked="false"
          aria-label="Select ${category.name}">
          <div class="service-icon">${emoji}</div>
          <span class="service-name">${category.name}</span>
          <span class="check-indicator">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
        </button>
      `;
    }).join('');
    
    servicesGrid.innerHTML = cardsHTML;
    
    // Restaurer les sélections si elles existent
    Object.keys(window.selectedServices).forEach(serviceId => {
      const card = servicesGrid.querySelector(`.service-card[data-service-id="${serviceId}"]`);
      if (card) {
        card.classList.add('selected');
        card.setAttribute('aria-checked', 'true');
      }
    });
    
    updateCount();
    
  } catch (error) {
    console.error('Error loading services:', error);
    servicesGrid.innerHTML = `
      <div class="col-span-full text-center py-8 text-red-500">
        <div class="flex flex-col items-center gap-2">
          <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p class="font-semibold">Unable to load services</p>
          <p class="text-sm text-gray-500">Please refresh the page</p>
        </div>
      </div>
    `;
  }
}

// ============================================
// SAVE TO LOCALSTORAGE
// ============================================
function saveToLocalStorage() {
  try {
    const data = JSON.parse(localStorage.getItem('expats') || '{}');
    data.provider_services = window.selectedServices;
    data.provider_subcategories = window.selectedSubcategories;
    localStorage.setItem('expats', JSON.stringify(data));
  } catch (e) {
    console.warn('localStorage not available:', e.message);
  }
}

// ============================================
// SPECIALTIES MODAL
// ============================================
async function showSpecialtiesModal() {
  const serviceIds = Object.keys(window.selectedServices);
  
  if (serviceIds.length === 0) {
    showFunMessage('Pick at least one service first! 🎯');
    return;
  }
  
  if (window.specialtiesModalOpen) {
    return;
  }
  
  try {
    const servicesData = await Promise.all(
      serviceIds.map(serviceId => loadSubcategories(serviceId))
    );
    
    createSpecialtiesModal(servicesData);
    
  } catch (error) {
    console.error('Error loading subcategories:', error);
    showFunMessage('Oops! Try again 🔄');
  }
}

function createSpecialtiesModal(servicesData) {
  const workingSubcats = {};
  
  servicesData.forEach(service => {
    const serviceId = normalizeId(service.serviceId);
    
    if (window.selectedSubcategories[serviceId] && Array.isArray(window.selectedSubcategories[serviceId])) {
      workingSubcats[serviceId] = [...window.selectedSubcategories[serviceId]].map(id => normalizeId(id));
    } else {
      workingSubcats[serviceId] = [];
    }
  });
  
  const modalHTML = `
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm" style="opacity: 0; transition: opacity 0.2s;">
      <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 text-white p-6">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-2xl font-black">Choose Your Specialties 🎯</h3>
            <button type="button" id="closeSpecialtiesModal" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white hover:bg-opacity-20 transition-all">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <p class="text-blue-100 text-sm">Select at least one specialty for each service</p>
        </div>
        
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)] space-y-6">
          ${servicesData.map(service => {
            const serviceId = normalizeId(service.serviceId);
            const serviceEmoji = getEmojiForCategory(service.serviceName);
            const serviceSubcats = workingSubcats[serviceId] || [];
            const hasSelection = serviceSubcats.length > 0;
            
            return `
              <div class="service-section ${hasSelection ? 'complete' : ''}" data-service-id="${serviceId}">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <span class="text-2xl">${serviceEmoji}</span>
                    <h4 class="text-lg font-bold text-gray-900">${service.serviceName}</h4>
                  </div>
                  <span class="subcat-counter text-sm font-semibold px-3 py-1 rounded-full ${hasSelection ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'}">
                    <span class="count">${serviceSubcats.length}</span> selected
                  </span>
                </div>
                ${service.subcategories.length > 0 ? `
                  <div class="flex flex-wrap gap-2">
                    ${service.subcategories.map(subcat => {
                      const subcatId = normalizeId(subcat.id);
                      const isSelected = serviceSubcats.includes(subcatId);
                      return `
                        <button 
                          type="button"
                          class="subcat-chip ${isSelected ? 'selected' : ''}"
                          data-service-id="${serviceId}"
                          data-subcat-id="${subcatId}"
                          data-subcat-name="${subcat.name}">
                          ${subcat.name}
                        </button>
                      `;
                    }).join('')}
                  </div>
                ` : `
                  <p class="text-sm text-gray-500 italic">No specialties available for this service</p>
                `}
              </div>
            `;
          }).join('')}
        </div>
        
        <div class="sticky bottom-0 border-t border-gray-200 p-6 bg-white">
          <div class="flex gap-3">
            <button type="button" id="backToServicesBtn" class="flex-1 py-3 px-6 bg-white text-gray-700 border-2 border-gray-300 font-semibold rounded-xl hover:bg-gray-50 transition-all">
              <span>Back to Services</span>
            </button>
            <button type="button" id="saveSpecialtiesBtn" class="flex-1 py-3 px-6 bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
              <span>Save Specialties</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  `;
  
  const modalContainer = document.createElement('div');
  modalContainer.innerHTML = modalHTML;
  const modal = modalContainer.firstElementChild;
  document.body.appendChild(modal);
  document.body.style.overflow = 'hidden';
  
  const navButtons = document.querySelectorAll('#mobileNavButtons, #desktopNavButtons');
  navButtons.forEach(btn => btn.style.display = 'none');
  
  setTimeout(() => modal.style.opacity = '1', 10);
  
  modal.addEventListener('click', (e) => {
    const chip = e.target.closest('.subcat-chip');
    if (!chip) return;
    
    const serviceId = normalizeId(chip.getAttribute('data-service-id'));
    const subcatId = normalizeId(chip.getAttribute('data-subcat-id'));
    
    if (!workingSubcats[serviceId]) {
      workingSubcats[serviceId] = [];
    }
    
    const index = workingSubcats[serviceId].indexOf(subcatId);
    if (index > -1) {
      workingSubcats[serviceId].splice(index, 1);
      chip.classList.remove('selected');
    } else {
      workingSubcats[serviceId].push(subcatId);
      chip.classList.add('selected');
    }
    
    const serviceSection = modal.querySelector(`.service-section[data-service-id="${serviceId}"]`);
    const counter = serviceSection?.querySelector('.subcat-counter .count');
    if (counter) {
      counter.textContent = workingSubcats[serviceId].length;
    }
    
    const badge = serviceSection?.querySelector('.subcat-counter');
    if (badge) {
      if (workingSubcats[serviceId].length > 0) {
        badge.classList.remove('bg-gray-100', 'text-gray-600');
        badge.classList.add('bg-green-100', 'text-green-700');
        serviceSection.classList.add('complete');
        serviceSection.classList.remove('incomplete');
      } else {
        badge.classList.remove('bg-green-100', 'text-green-700');
        badge.classList.add('bg-gray-100', 'text-gray-600');
        serviceSection.classList.remove('complete');
      }
    }
  });
  
  function closeModal() {
    window.specialtiesModalOpen = false;
    document.body.style.overflow = '';
    modal.style.opacity = '0';
    
    navButtons.forEach(btn => btn.style.display = '');
    
    setTimeout(() => modal.remove(), 200);
  }
  
  modal.querySelector('#closeSpecialtiesModal').onclick = closeModal;
  
  modal.querySelector('#backToServicesBtn').onclick = () => {
    closeModal();
  };
  
  modal.querySelector('#saveSpecialtiesBtn').onclick = () => {
    const servicesWithSubcats = servicesData.filter(s => s.subcategories && s.subcategories.length > 0);
    const servicesWithSubcatsIds = servicesWithSubcats.map(s => normalizeId(s.serviceId));
    
    const incompleteServices = servicesWithSubcatsIds.filter(id => {
      const subcats = workingSubcats[id];
      return !subcats || subcats.length === 0;
    });
    
    if (incompleteServices.length > 0) {
      showFunMessage('Pick specialties for all services! 🎯');
      
      incompleteServices.forEach(id => {
        const section = modal.querySelector(`.service-section[data-service-id="${id}"]`);
        if (section) {
          section.classList.add('incomplete');
          section.classList.add('shake-animation');
          setTimeout(() => {
            section.classList.remove('shake-animation');
          }, 500);
        }
      });
      
      return;
    }
    
    // ✅ Sauvegarder les sous-catégories
    window.selectedSubcategories = JSON.parse(JSON.stringify(workingSubcats));
    saveToLocalStorage();
    closeModal();
    
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
    
    // ✅ Navigation directe vers Step 5 (comme l'ancien code)
    setTimeout(() => {
      if (typeof window.showStep === 'function') {
        window.showStep(4); // Step 5 (index 4)
      } else if (typeof window.goToNextStep === 'function') {
        window.goToNextStep();
      } else {
        // Fallback: trigger event
        const event = new CustomEvent('step4Complete', { detail: { nextStep: 5 } });
        document.dispatchEvent(event);
      }
    }, 200);
  };
  
  window.specialtiesModalOpen = true;
}

// ============================================
// INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('#step4');
  if (!container) return;
  
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
        const isHidden = container.classList.contains('hidden');
        
        if (!isHidden && !container.dataset.loaded) {
          loadServices();
          container.dataset.loaded = 'true';
        }
        
        // ✅ RÉINITIALISER quand Step 4 devient visible
        if (!isHidden) {
          window.selectedServices = {};
          window.selectedSubcategories = {};
          
          // Désélectionner visuellement toutes les cartes
          const allCards = container.querySelectorAll('.service-card.selected');
          allCards.forEach(card => {
            card.classList.remove('selected');
            card.setAttribute('aria-checked', 'false');
          });
          
          // Mettre à jour le compteur
          updateCount();
          
          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }
        }
      }
    });
  });
  
  observer.observe(container, { attributes: true });
  
  container.addEventListener('click', function(e) {
    const card = e.target.closest('.service-card');
    if (card) {
      window.selectService(card);
    }
  }, { passive: true });
  
  container.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      const card = e.target.closest('.service-card');
      if (card) {
        e.preventDefault();
        window.selectService(card);
      }
    }
  });
});
</script>