<!-- 
============================================
🚀 STEP 4 - VERSION FINALE ULTRA-ROBUSTE
============================================
CORRECTIONS:
✅ Sous-catégories encadrées PAR SERVICE (meilleur UX)
✅ Tailles de police NORMALES (non réduites)
✅ FIX DÉFINITIF du double-clic
✅ État ultra-sécurisé
✅ Logs détaillés
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

    <div id="servicesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-2.5" role="group" aria-label="Select services you provide">
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

  <div id="chooseSubcatButtonContainer" class="hidden sticky bottom-0 z-20 bg-white border-t border-gray-200 p-4 shadow-lg">
    <div class="flex sm:justify-end">
      <button 
        type="button" 
        id="chooseSubcatBtn"
        class="w-full sm:w-auto py-3 px-8 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
        Choose Your Specialties →
      </button>
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

.service-card {
  position: relative;
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e2e8f0;
  border-radius: 0.75rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  min-height: fit-content;
}

.service-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px -2px rgba(59, 130, 246, 0.3);
  border-color: #60a5fa;
  background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
}

.service-card:active {
  transform: translateY(-1px);
}

.service-card.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  border-color: #1d4ed8;
  box-shadow: 0 4px 12px -2px rgba(37, 99, 235, 0.5);
}

.service-card.selected:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px -2px rgba(37, 99, 235, 0.6);
}

.service-icon-circle {
  width: 2.5rem;
  height: 2.5rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: transform 0.2s;
}

.service-card:hover .service-icon-circle {
  transform: scale(1.1);
}

.service-card.selected .service-icon-circle {
  transform: scale(1.05);
}

.service-icon-svg {
  width: 1.5rem;
  height: 1.5rem;
  color: white;
}

.service-name {
  flex: 1;
  font-size: 0.875rem;
  font-weight: 600;
  text-align: left;
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
  width: 1.25rem;
  height: 1.25rem;
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
  .service-card {
    padding: 0.625rem;
  }
  
  .service-icon-circle {
    width: 2.25rem;
    height: 2.25rem;
  }
  
  .service-icon-svg {
    width: 1.25rem;
    height: 1.25rem;
  }
  
  .service-name {
    font-size: 0.8125rem;
  }
}

/* ====================================
   MODAL - SOUS-CATÉGORIES ENCADRÉES PAR SERVICE
   ==================================== */

.service-section {
  padding: 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 1rem;
  background: white;
  transition: all 0.3s;
}

.service-section.complete {
  border-color: #22c55e;
  background: linear-gradient(135deg, rgba(240, 253, 244, 0.5), rgba(220, 252, 231, 0.3));
}

.service-section.incomplete {
  border-color: #fb923c;
  background: linear-gradient(135deg, rgba(255, 247, 237, 0.5), rgba(254, 243, 199, 0.3));
  animation: pulse-border 2s infinite;
}

@keyframes pulse-border {
  0%, 100% { border-color: #fb923c; }
  50% { border-color: #f97316; }
}

.service-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid #f3f4f6;
}

.service-section.complete .service-section-header {
  border-bottom-color: #d1fae5;
}

.service-section.incomplete .service-section-header {
  border-bottom-color: #fed7aa;
}

.subcat-chip {
  padding: 0.5rem 1rem;
  border-radius: 0.625rem;
  border: 2px solid #bfdbfe;
  background: white;
  color: #1e3a8a;
  font-weight: 600;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.2s;
  line-height: 1.3;
}

.subcat-chip:hover {
  border-color: #60a5fa;
  background: #eff6ff;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
}

.subcat-chip.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  color: white;
  border-color: #1d4ed8;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
  transform: translateY(-1px);
}

.subcat-chip.selected:hover {
  box-shadow: 0 6px 16px rgba(37, 99, 235, 0.5);
}

.subcat-counter {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  font-size: 0.875rem;
  font-weight: 700;
  padding: 0.375rem 0.875rem;
  border-radius: 9999px;
  transition: all 0.3s;
}

.subcat-counter.has-selection {
  background: #d1fae5;
  color: #065f46;
}

.subcat-counter.no-selection {
  background: #fee2e2;
  color: #991b1b;
}
</style>

<script>
console.log('🔵 STEP 4 - VERSION FINALE ULTRA-ROBUSTE CHARGÉE');

// ============================================
// ÉTAT GLOBAL ULTRA-SÉCURISÉ
// ============================================

// ✅ INITIALISATION UNIQUE ET SÉCURISÉE
if (typeof window.selectedServices === 'undefined') {
  window.selectedServices = {};
  console.log('🔧 selectedServices initialisé');
}

if (typeof window.selectedSubcategories === 'undefined') {
  window.selectedSubcategories = {};
  console.log('🔧 selectedSubcategories initialisé');
}

if (typeof window.specialtiesModalOpen === 'undefined') {
  window.specialtiesModalOpen = false;
}

// ============================================
// MODULES
// ============================================

let getCategoryColorByLevel, getCategoryIcon;

document.addEventListener('DOMContentLoaded', function() {
  if (window.categoryColors?.getCategoryColorByLevel) {
    getCategoryColorByLevel = window.categoryColors.getCategoryColorByLevel;
  } else {
    getCategoryColorByLevel = (level, id, allIds) => {
      const colors = ['#2563eb', '#0891b2', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
      const hash = String(id).split('').reduce((acc, char) => acc + char.charCodeAt(0), 0);
      return colors[hash % colors.length];
    };
  }
  
  if (window.categoryIcons?.getCategoryIcon) {
    getCategoryIcon = window.categoryIcons.getCategoryIcon;
  } else {
    getCategoryIcon = () => {
      return `<svg viewBox="0 0 24 24" fill="none">
        <rect x="3" y="9" width="14" height="9" rx="0.8" fill="white"/>
        <rect x="7" y="6" width="6" height="3" rx="0.5" fill="white"/>
      </svg>`;
    };
  }
});

const API_CACHE = {
  categories: null,
  subcategories: {}
};

// ============================================
// UTILITIES
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

function updateNavigationButtonsForStep4() {
  // Trouver tous les boutons de navigation
  const continueButtons = document.querySelectorAll('[id*="continue"], [id*="Continue"], button[onclick*="showStep(4)"], button[onclick*="goToNextStep"]');
  const backButtons = document.querySelectorAll('[id*="back"], [id*="Back"], button[onclick*="showStep(2)"], button[onclick*="goToPreviousStep"]');
  
  console.log('🔧 Mise à jour boutons navigation Step 4');
  
  // ✅ CACHER ET VERROUILLER complètement Continue
  continueButtons.forEach(btn => {
    btn.style.display = 'none';
    btn.style.visibility = 'hidden';
    btn.disabled = true;
    console.log('❌ Continue caché et désactivé');
  });
  
  // ✅ ACTIVER et AFFICHER Back
  backButtons.forEach(btn => {
    btn.style.display = '';
    btn.style.visibility = 'visible';
    btn.disabled = false;
    btn.style.opacity = '1';
    btn.style.pointerEvents = 'auto';
    console.log('✅ Back activé');
  });
}

function updateCount() {
  const selectedCount = document.getElementById('step4SelectedCount');
  if (selectedCount) {
    selectedCount.textContent = Object.keys(window.selectedServices).length;
  }
  updateChooseSubcatButton();
}

function updateChooseSubcatButton() {
  const buttonContainer = document.getElementById('chooseSubcatButtonContainer');
  if (!buttonContainer) return;
  
  const hasServices = Object.keys(window.selectedServices).length > 0;
  
  if (hasServices) {
    buttonContainer.classList.remove('hidden');
    
    const currentServiceIds = Object.keys(window.selectedServices);
    const hasExistingSubcats = currentServiceIds.some(serviceId => {
      return window.selectedSubcategories[serviceId]?.length > 0;
    });
    
    const chooseBtn = document.getElementById('chooseSubcatBtn');
    if (chooseBtn) {
      if (hasExistingSubcats) {
        chooseBtn.innerHTML = 'Modify Your Specialties →';
        chooseBtn.classList.add('ring-2', 'ring-green-400');
        chooseBtn.className = 'w-full sm:w-auto py-3 px-8 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 ring-2 ring-green-400';
      } else {
        chooseBtn.innerHTML = 'Choose Your Specialties →';
        chooseBtn.classList.remove('ring-2', 'ring-green-400');
        chooseBtn.className = 'w-full sm:w-auto py-3 px-8 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200';
      }
    }
  } else {
    buttonContainer.classList.add('hidden');
  }
}

function hideError() {
  const errorAlert = document.getElementById('step4ServiceError');
  if (errorAlert) errorAlert.classList.add('hidden');
}

function showError() {
  const errorAlert = document.getElementById('step4ServiceError');
  if (errorAlert) {
    errorAlert.classList.remove('hidden');
    errorAlert.classList.add('shake-animation');
    setTimeout(() => errorAlert.classList.remove('shake-animation'), 500);
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
// RESET
// ============================================

window.resetStep4Subcategories = function() {
  console.log('🔙 RÉINITIALISATION COMPLÈTE');
  
  window.selectedServices = {};
  window.selectedSubcategories = {};
  
  saveToLocalStorage();
  
  const servicesGrid = document.getElementById('servicesGrid');
  if (servicesGrid) {
    servicesGrid.querySelectorAll('.service-card.selected').forEach(card => {
      card.classList.remove('selected');
      card.setAttribute('aria-checked', 'false');
    });
  }
  
  updateCount();
  updateChooseSubcatButton();
  
  if (typeof window.updateNavigationButtons === 'function') {
    window.updateNavigationButtons();
  }
};

// ============================================
// VALIDATION
// ============================================

window.validateStep4 = function() {
  const serviceIds = Object.keys(window.selectedServices);
  
  if (serviceIds.length === 0) {
    showError();
    return false;
  }
  
  const hasSubcatsForAll = serviceIds.every(serviceId => {
    return window.selectedSubcategories[serviceId]?.length > 0;
  });
  
  if (!hasSubcatsForAll) {
    return false;
  }
  
  return true;
};

// ============================================
// API
// ============================================

async function loadCategories() {
  if (API_CACHE.categories) return API_CACHE.categories;
  
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
      servicesGrid.innerHTML = '<div class="col-span-full text-center py-8 text-gray-500"><p class="text-sm font-medium">No services available</p></div>';
      return;
    }
    
    const allIds = categories.map(cat => normalizeId(cat.id));
    
    const cardsHTML = categories.map(category => {
      const categoryId = normalizeId(category.id);
      const iconColor = getCategoryColorByLevel('main', categoryId, allIds);
      const iconSVG = getCategoryIcon(category.name, categoryId, 'root');
      
      return `
        <button 
          type="button"
          class="service-card"
          data-service-id="${categoryId}"
          data-service-name="${category.name}"
          role="checkbox"
          aria-checked="false">
          
          <div class="service-icon-circle" style="background-color: ${iconColor};">
            <div class="service-icon-svg">${iconSVG}</div>
          </div>
          
          <span class="service-name">${category.name}</span>
          
          <span class="check-indicator">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
        </button>
      `;
    }).join('');
    
    servicesGrid.innerHTML = cardsHTML;
    updateCount();
    updateChooseSubcatButton();
    
  } catch (error) {
    console.error('Error loading services:', error);
    servicesGrid.innerHTML = '<div class="col-span-full text-center py-8 text-red-500"><p class="font-semibold">Unable to load services</p></div>';
  }
}

// ============================================
// LOCALSTORAGE
// ============================================

function saveToLocalStorage() {
  try {
    const data = JSON.parse(localStorage.getItem('expats') || '{}');
    data.provider_services = window.selectedServices;
    data.provider_subcategories = window.selectedSubcategories;
    localStorage.setItem('expats', JSON.stringify(data));
    console.log('💾 Sauvegarde localStorage OK');
  } catch (e) {
    console.warn('localStorage error:', e.message);
  }
}

// ============================================
// MODAL SOUS-CATÉGORIES
// ============================================

window.showSpecialtiesModal = async function() {
  console.log('🎨 Ouverture modal sous-catégories');
  
  const serviceIds = Object.keys(window.selectedServices);
  
  if (serviceIds.length === 0) {
    return;
  }
  
  if (window.specialtiesModalOpen) {
    console.log('⚠️ Modal déjà ouvert');
    return;
  }
  
  console.log('📊 État actuel:', {
    services: window.selectedServices,
    subcategories: window.selectedSubcategories
  });
  
  try {
    const servicesData = await Promise.all(
      serviceIds.map(serviceId => loadSubcategories(serviceId))
    );
    
    createSpecialtiesModal(servicesData);
    
  } catch (error) {
    console.error('Error loading subcategories:', error);
  }
};

function createSpecialtiesModal(servicesData) {
  console.log('🔨 Création modal avec', servicesData.length, 'services');
  
  // ✅ COPIE SÉCURISÉE de l'état actuel
  const workingSubcats = JSON.parse(JSON.stringify(window.selectedSubcategories || {}));
  
  // Initialiser les services sans sous-catégories
  servicesData.forEach(service => {
    const serviceId = normalizeId(service.serviceId);
    if (!workingSubcats[serviceId]) {
      workingSubcats[serviceId] = [];
    }
  });
  
  console.log('📋 workingSubcats initial:', workingSubcats);
  
  const serviceIcons = {};
  servicesData.forEach(service => {
    const serviceId = normalizeId(service.serviceId);
    const allServiceIds = servicesData.map(s => normalizeId(s.serviceId));
    serviceIcons[serviceId] = {
      color: getCategoryColorByLevel('main', serviceId, allServiceIds),
      svg: getCategoryIcon(service.serviceName, serviceId, 'root')
    };
  });
  
  const modalHTML = `
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm" style="opacity: 0; transition: opacity 0.2s;">
      <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 text-white p-5">
          <div class="flex items-center justify-between mb-2">
            <h3 class="text-2xl font-black">Choose Your Specialties 🎯</h3>
            <button type="button" id="closeSpecialtiesModal" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-white hover:bg-opacity-20 transition-all">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <p class="text-blue-100 text-sm font-medium">Choose at least one subcategory per selected category</p>
        </div>
        
        <div class="p-5 overflow-y-auto max-h-[calc(90vh-180px)] space-y-4">
          ${servicesData.map(service => {
            const serviceId = normalizeId(service.serviceId);
            const icon = serviceIcons[serviceId];
            const serviceSubcats = workingSubcats[serviceId] || [];
            const hasSelection = serviceSubcats.length > 0;
            
            return `
              <div class="service-section ${hasSelection ? 'complete' : ''}" data-service-id="${serviceId}">
                <div class="service-section-header">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: ${icon.color};">
                      <div class="w-5 h-5 text-white">${icon.svg}</div>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">${service.serviceName}</h4>
                  </div>
                  <div class="subcat-counter ${hasSelection ? 'has-selection' : 'no-selection'}">
                    <span class="count">${serviceSubcats.length}</span>
                    <span>selected</span>
                  </div>
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
                          data-subcat-id="${subcatId}">
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
        
        <div class="sticky bottom-0 border-t-2 border-gray-200 p-4 bg-white">
          <div class="flex gap-3">
            <button type="button" id="backToServicesBtn" class="flex-1 py-3 px-6 bg-white text-gray-700 border-2 border-gray-300 font-bold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all">
              Back
            </button>
            <button type="button" id="saveSpecialtiesBtn" class="flex-1 py-3 px-6 bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
              Next
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
  
  // ✅ GESTION DES CLICS SUR LES CHIPS
  modal.addEventListener('click', (e) => {
    const chip = e.target.closest('.subcat-chip');
    if (!chip) return;
    
    const serviceId = normalizeId(chip.getAttribute('data-service-id'));
    const subcatId = normalizeId(chip.getAttribute('data-subcat-id'));
    
    console.log('🔘 Chip cliqué:', { serviceId, subcatId });
    
    if (!workingSubcats[serviceId]) {
      workingSubcats[serviceId] = [];
    }
    
    const index = workingSubcats[serviceId].indexOf(subcatId);
    
    if (index > -1) {
      workingSubcats[serviceId].splice(index, 1);
      chip.classList.remove('selected');
      console.log('❌ Désélectionné');
    } else {
      workingSubcats[serviceId].push(subcatId);
      chip.classList.add('selected');
      console.log('✅ Sélectionné');
    }
    
    // Mise à jour UI
    const serviceSection = modal.querySelector(`.service-section[data-service-id="${serviceId}"]`);
    const counter = serviceSection?.querySelector('.subcat-counter .count');
    if (counter) {
      counter.textContent = workingSubcats[serviceId].length;
    }
    
    const badge = serviceSection?.querySelector('.subcat-counter');
    if (badge) {
      if (workingSubcats[serviceId].length > 0) {
        badge.classList.remove('no-selection');
        badge.classList.add('has-selection');
        serviceSection.classList.add('complete');
        serviceSection.classList.remove('incomplete');
      } else {
        badge.classList.remove('has-selection');
        badge.classList.add('no-selection');
        serviceSection.classList.remove('complete');
      }
    }
  });
  
  function closeModal() {
    window.specialtiesModalOpen = false;
    document.body.style.overflow = '';
    modal.style.opacity = '0';
    
    // ✅ Quand le modal se ferme, réafficher SEULEMENT Back
    navButtons.forEach(btn => btn.style.display = '');
    
    // ✅ Mais TOUJOURS cacher Continue
    setTimeout(() => {
      updateNavigationButtonsForStep4();
    }, 100);
    
    setTimeout(() => modal.remove(), 200);
  }
  
  modal.querySelector('#closeSpecialtiesModal').onclick = closeModal;
  
  modal.querySelector('#backToServicesBtn').onclick = () => {
    console.log('🔙 Back vers Step 3');
    closeModal();
    
    setTimeout(() => {
      if (typeof window.showStep === 'function') {
        window.showStep(2);
      } else if (typeof window.goToPreviousStep === 'function') {
        window.goToPreviousStep();
      }
    }, 200);
  };
  
  // ✅ BOUTON NEXT - SAUVEGARDE ET NAVIGATION
  modal.querySelector('#saveSpecialtiesBtn').onclick = () => {
    console.log('🔵 NEXT CLIQUÉ');
    console.log('📊 État avant validation:', workingSubcats);
    
    const servicesWithSubcats = servicesData.filter(s => s.subcategories?.length > 0);
    const servicesWithSubcatsIds = servicesWithSubcats.map(s => normalizeId(s.serviceId));
    
    const incompleteServices = servicesWithSubcatsIds.filter(id => {
      return !workingSubcats[id] || workingSubcats[id].length === 0;
    });
    
    if (incompleteServices.length > 0) {
      console.log('❌ Validation échouée:', incompleteServices);
      showFunMessage('Pick at least one specialty for each service! 🎯');
      
      incompleteServices.forEach(id => {
        const section = modal.querySelector(`.service-section[data-service-id="${id}"]`);
        if (section) {
          section.classList.add('incomplete');
          section.classList.add('shake-animation');
          setTimeout(() => section.classList.remove('shake-animation'), 500);
        }
      });
      
      return;
    }
    
    console.log('✅ Validation OK');
    
    // ✅ SAUVEGARDE CRITIQUE
    window.selectedSubcategories = JSON.parse(JSON.stringify(workingSubcats));
    console.log('💾 Sauvegarde window.selectedSubcategories:', window.selectedSubcategories);
    
    saveToLocalStorage();
    
    // ✅ NAVIGATION VERS STEP 5 - IMMÉDIATE
    console.log('🚀 Navigation vers Step 5');
    
    if (typeof window.showStep === 'function') {
      console.log('→ Appel window.showStep(4)');
      window.showStep(4);
    } else if (typeof window.goToNextStep === 'function') {
      console.log('→ Appel window.goToNextStep()');
      window.goToNextStep();
    }
    
    // ✅ Fermer le modal APRÈS la navigation (150ms pour éviter de voir Step 4)
    setTimeout(() => {
      closeModal();
      
      console.log('📊 État final:', {
        services: window.selectedServices,
        subcategories: window.selectedSubcategories
      });
    }, 150);
  };
  
  window.specialtiesModalOpen = true;
}

// ============================================
// INIT
// ============================================

document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('#step4');
  if (!container) return;
  
  console.log('📋 Step 4 chargé');
  
  const chooseBtn = document.getElementById('chooseSubcatBtn');
  if (chooseBtn) {
    chooseBtn.onclick = () => {
      if (typeof window.showSpecialtiesModal === 'function') {
        window.showSpecialtiesModal();
      }
    };
  }
  
  document.addEventListener('step4BackNavigation', () => {
    console.log('🔙 Navigation arrière détectée');
    window.resetStep4Subcategories();
  });
  
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
        const isHidden = container.classList.contains('hidden');
        if (!isHidden && !container.dataset.loaded) {
          loadServices();
          container.dataset.loaded = 'true';
          
          // ✅ Gérer les boutons de navigation
          updateNavigationButtonsForStep4();
        } else if (!isHidden) {
          // ✅ Réappliquer à chaque fois que Step 4 devient visible
          updateNavigationButtonsForStep4();
        }
      }
    });
  });
  
  observer.observe(container, { attributes: true });
  
  container.addEventListener('click', (e) => {
    const card = e.target.closest('.service-card');
    if (card) window.selectService(card);
  }, { passive: true });
  
  container.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      const card = e.target.closest('.service-card');
      if (card) {
        e.preventDefault();
        window.selectService(card);
      }
    }
  });
});

console.log('✅ Step 4 prêt');
</script>