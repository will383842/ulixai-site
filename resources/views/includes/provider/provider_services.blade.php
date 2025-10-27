<!-- 
============================================
🚀 STEP 4 - PROVIDER SERVICES
============================================
✨ Blue/Cyan/Teal Design System
🎨 Dynamic services with emojis
💎 Interactive validation and states
⚡ Responsive: 2 cols mobile / 3 cols tablet / 4 cols desktop
🔧 Modern system: window.validateStep4() and window.selectService()
✅ Consistent with Steps 2 & 3 (no internal buttons)
🎯 Dynamic header button integration (Next ↔ Choose Specialties)
============================================
-->

<div id="step4" class="hidden flex flex-col h-full" role="region" aria-label="Select your services">
  
  <!-- ============================================
       STICKY HEADER
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 animated blobs -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What Services Do You Provide? 🛠️
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select all the services you can offer
        </p>
      </div>

      <!-- Counter Badge -->
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

  <!-- ============================================
       SCROLLABLE CONTENT
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Services Grid -->
    <div id="servicesGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-3 lg:gap-3.5" role="group" aria-label="Select services you provide">
      <!-- Services will be loaded dynamically -->
    </div>
  </div>
</div>

<style>
/* ============================================
   🎨 STEP 4 - MODERN DESIGN SYSTEM
   Consistent with Steps 2 & 3
   ============================================ */

/* Container */
#step4 {
  position: relative;
  min-height: 100%;
}

/* Sticky Header */
#step4 .sticky {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Ambient Background Animation */
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

/* Service Card Styling */
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

/* Selected State */
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

/* Service Icon */
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

/* Service Name */
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

/* Check Indicator */
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

/* Error Alert */
.shake-animation {
  animation: shake 0.4s;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

/* ============================================
   📱 RESPONSIVE
   ============================================ */

/* Mobile - 2 columns */
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

/* Tablet - 3 columns */
@media (min-width: 640px) and (max-width: 1023px) {
  .service-card {
    padding: 0.875rem 0.625rem;
  }
  
  .service-icon {
    width: 2.375rem;
    height: 2.375rem;
  }
}

/* Desktop - 4 columns */
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

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

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

/* Performance */
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
</style>

<script>
/* ============================================
   🎯 STEP 4 - OPTIMIZED VERSION WITH DYNAMIC BUTTON
   Performance: ⚡ Web Vitals Ready | CPU Optimized | Error Safe
   Consistent with Steps 2 & 3
   ============================================ */

// Global state
window.selectedServices = {};
window.selectedSubcategories = {};
window.specialtiesModalOpen = false;

// DOM elements cache
let cachedElementsStep4 = null;

function getCachedElementsStep4() {
  if (!cachedElementsStep4) {
    cachedElementsStep4 = {
      servicesGrid: document.getElementById('servicesGrid'),
      selectedCount: document.getElementById('selectedCount')
    };
  }
  return cachedElementsStep4;
}

// Emoji mapping for categories
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

// Emoji pool for categories without defined emoji
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
// 🔥 DYNAMIC BUTTON CONTROL
// ============================================

function updateHeaderButtons() {
  const serviceCount = Object.keys(window.selectedServices).length;
  const hasSubcategories = window.selectedSubcategories && 
                           Object.keys(window.selectedSubcategories).length > 0 &&
                           Object.values(window.selectedSubcategories).some(arr => arr && arr.length > 0);
  
  // Get all Next buttons (mobile & desktop)
  const nextButtons = [
    document.getElementById('mobileNextBtn'),
    document.getElementById('desktopNextBtn')
  ];
  
  nextButtons.forEach(btn => {
    if (!btn) return;
    
    const textSpan = btn.querySelector('span');
    if (!textSpan) return;
    
    if (serviceCount === 0) {
      // No services selected: disable button
      btn.disabled = true;
      textSpan.textContent = 'Continue';
    } else if (!hasSubcategories) {
      // Services selected but no subcategories: show "Choose Specialties"
      btn.disabled = false;
      textSpan.textContent = 'Choose Specialties';
      btn.classList.add('btn-specialties'); // Add marker class
    } else {
      // Services + subcategories: show "Continue"
      btn.disabled = false;
      textSpan.textContent = 'Continue';
      btn.classList.remove('btn-specialties'); // Remove marker class
    }
  });
}

// Service selection function (accessible from header)
window.selectService = function(card) {
  if (!card) return;
  
  const elements = getCachedElementsStep4();
  const serviceId = card.getAttribute('data-service-id');
  const serviceName = card.getAttribute('data-service-name');
  
  // Toggle selection
  if (window.selectedServices[serviceId]) {
    // Deselect
    delete window.selectedServices[serviceId];
    card.classList.remove('selected');
    card.setAttribute('aria-checked', 'false');
    
    // Also remove subcategories for this service
    if (window.selectedSubcategories[serviceId]) {
      delete window.selectedSubcategories[serviceId];
    }
  } else {
    // Select
    window.selectedServices[serviceId] = serviceName;
    card.classList.add('selected');
    card.setAttribute('aria-checked', 'true');
  }
  
  // Update counter
  const count = Object.keys(window.selectedServices).length;
  if (elements.selectedCount) {
    elements.selectedCount.textContent = count;
  }
  
  // Save to localStorage
  try {
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    expats.provider_services = window.selectedServices;
    expats.provider_subcategories = window.selectedSubcategories;
    localStorage.setItem('expats', JSON.stringify(expats));
  } catch (e) {
    console.warn('localStorage not available:', e.message);
  }
  
  // Hide error if visible
  if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
    elements.errorAlert.classList.add('hidden');
  }
  
  // Update header buttons dynamically
  updateHeaderButtons();
  
  // Activer le bouton Next si au moins un service est sélectionné
  const serviceCount = Object.keys(window.selectedServices).length;
  if (serviceCount > 0) {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    if (mobileNextBtn) mobileNextBtn.disabled = false;
    if (desktopNextBtn) desktopNextBtn.disabled = false;
  }
};

// ============================================
// 🎯 VALIDATION FUNCTION
// ============================================

window.validateStep4 = function() {
  const serviceCount = Object.keys(window.selectedServices).length;
  
  // No service selected → show fun message
  if (serviceCount === 0) {
    showFunMessage('Pick at least one service! 🎯');
    return false;
  }
  
  // Check if ALL services have been processed (have entry in selectedSubcategories, even if empty)
  const allProcessed = Object.keys(window.selectedServices).every(serviceId => {
    return window.selectedSubcategories.hasOwnProperty(serviceId);
  });
  
  // If not all processed → open modal
  if (!allProcessed) {
    showSpecialtiesModal();
    return 'show_specialties';
  }
  
  // All processed → proceed to next step
  return true;
};

// Fun centered message (3s auto-hide)
function showFunMessage(text) {
  const existing = document.getElementById('funMessage');
  if (existing) existing.remove();
  
  const msg = document.createElement('div');
  msg.id = 'funMessage';
  msg.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-full shadow-2xl font-bold text-sm sm:text-base animate-bounce';
  msg.textContent = text;
  document.body.appendChild(msg);
  
  setTimeout(() => msg.remove(), 3000);
}

// Load categories from API
async function loadServices() {
  const elements = getCachedElementsStep4();
  
  if (!elements.servicesGrid) return;
  
  try {
    const response = await fetch('/api/categories');
    const data = await response.json();
    const categories = data.categories || [];
    
    // Create service cards
    const cardsHTML = categories.map(category => {
      const emoji = getEmojiForCategory(category.name);
      return `
        <button 
          type="button"
          class="service-card"
          data-service-id="${category.id}"
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
    
    elements.servicesGrid.innerHTML = cardsHTML;
    
    // Restore selection from localStorage
    restoreSelection();
    
  } catch (error) {
    console.error('Error loading services:', error);
    elements.servicesGrid.innerHTML = `
      <div class="col-span-full text-center py-8 text-gray-500">
        <p>Unable to load services. Please try again later.</p>
      </div>
    `;
  }
}

// Restore selection from localStorage
function restoreSelection() {
  try {
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    if (expats.provider_services && typeof expats.provider_services === 'object') {
      window.selectedServices = expats.provider_services;
    }
    if (expats.provider_subcategories && typeof expats.provider_subcategories === 'object') {
      window.selectedSubcategories = expats.provider_subcategories;
    }
    
    // Visually restore selections
    requestAnimationFrame(() => {
      Object.keys(window.selectedServices).forEach(serviceId => {
        const card = document.querySelector(`.service-card[data-service-id="${serviceId}"]`);
        if (card) {
          card.classList.add('selected');
          card.setAttribute('aria-checked', 'true');
        }
      });
      
      // Update UI
      const elements = getCachedElementsStep4();
      const count = Object.keys(window.selectedServices).length;
      if (elements.selectedCount) {
        elements.selectedCount.textContent = count;
      }
      
      // Update header buttons
      updateHeaderButtons();
    });
  } catch (e) {
    console.warn('Could not restore selection:', e.message);
  }
}

// Show subcategories modal
async function showSpecialtiesModal() {
  const serviceIds = Object.keys(window.selectedServices);
  
  if (serviceIds.length === 0) {
    const elements = getCachedElementsStep4();
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
    }
    return;
  }
  
  try {
    // Load subcategories for each selected service
    const results = await Promise.all(
      serviceIds.map(serviceId =>
        fetch(`/api/categories/${serviceId}/subcategories`)
          .then(res => res.json())
          .then(data => ({
            serviceId,
            serviceName: data?.category?.name || window.selectedServices[serviceId] || 'Service',
            subcategories: data?.subcategories || []
          }))
      )
    );
    
    // Create modal
    createSpecialtiesModal(results);
    
  } catch (error) {
    console.error('Error loading subcategories:', error);
    showFunMessage('Oops! Try again 🔄');
  }
}

// Create subcategories modal
function createSpecialtiesModal(servicesData) {
  // Selected subcategories state
  const selectedSubcats = JSON.parse(JSON.stringify(window.selectedSubcategories || {}));
  
  // Initialize empty arrays for all services (including those without subcats)
  servicesData.forEach(service => {
    if (!selectedSubcats[service.serviceId]) {
      selectedSubcats[service.serviceId] = [];
    }
  });
  
  // Create modal HTML
  const modalHTML = `
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm" style="opacity: 0; transition: opacity 0.2s;">
      <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <!-- Header -->
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
        
        <!-- Content -->
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-200px)] space-y-6">
          ${servicesData.map(service => {
            const serviceEmoji = getEmojiForCategory(service.serviceName);
            const serviceSubcats = selectedSubcats[service.serviceId] || [];
            const hasSelection = serviceSubcats.length > 0;
            
            return `
              <div class="service-section ${hasSelection ? 'complete' : ''}" data-service-id="${service.serviceId}">
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <span class="text-2xl">${serviceEmoji}</span>
                    <h4 class="text-lg font-bold text-gray-900">${service.serviceName}</h4>
                  </div>
                  <span class="subcat-counter text-sm font-semibold px-3 py-1 rounded-full ${hasSelection ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'}">
                    <span class="count">${serviceSubcats.length}</span> selected
                  </span>
                </div>
                <div class="flex flex-wrap gap-2">
                  ${service.subcategories.map(subcat => {
                    const isSelected = serviceSubcats.includes(subcat.id);
                    return `
                      <button 
                        type="button"
                        class="subcat-chip ${isSelected ? 'selected' : ''}"
                        data-service-id="${service.serviceId}"
                        data-subcat-id="${subcat.id}"
                        data-subcat-name="${subcat.name}">
                        ${subcat.name}
                      </button>
                    `;
                  }).join('')}
                </div>
              </div>
            `;
          }).join('')}
        </div>
        
        <!-- Footer with Buttons -->
        <div class="sticky bottom-0 border-t border-gray-200 p-6 bg-white">
          <div class="flex gap-3">
            <button type="button" id="backToServicesBtn" class="flex-1 py-3 px-6 bg-white text-gray-700 border-2 border-gray-300 font-semibold rounded-xl hover:bg-gray-50 transition-all">
              <span>Back to Services</span>
            </button>
            <button type="button" id="saveSpecialtiesBtn" class="flex-1 py-3 px-6 bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
              <span>Save & Continue</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  `;
  
  // Add modal to DOM
  const modalContainer = document.createElement('div');
  modalContainer.innerHTML = modalHTML;
  const modal = modalContainer.firstElementChild;
  document.body.appendChild(modal);
  document.body.style.overflow = 'hidden';
  
  // Animate appearance
  setTimeout(() => modal.style.opacity = '1', 10);
  
  // Event listeners for subcategories
  modal.addEventListener('click', (e) => {
    const chip = e.target.closest('.subcat-chip');
    if (!chip) return;
    
    const serviceId = chip.getAttribute('data-service-id');
    const subcatId = chip.getAttribute('data-subcat-id');
    
    // Initialize array if needed
    if (!selectedSubcats[serviceId]) {
      selectedSubcats[serviceId] = [];
    }
    
    // Toggle selection
    const index = selectedSubcats[serviceId].indexOf(subcatId);
    if (index > -1) {
      selectedSubcats[serviceId].splice(index, 1);
      chip.classList.remove('selected');
    } else {
      selectedSubcats[serviceId].push(subcatId);
      chip.classList.add('selected');
    }
    
    // Update counter
    const serviceSection = modal.querySelector(`.service-section[data-service-id="${serviceId}"]`);
    const counter = serviceSection?.querySelector('.subcat-counter .count');
    if (counter) {
      counter.textContent = selectedSubcats[serviceId].length;
    }
    
    // Update counter badge
    const badge = serviceSection?.querySelector('.subcat-counter');
    if (badge) {
      if (selectedSubcats[serviceId].length > 0) {
        badge.classList.remove('bg-gray-100', 'text-gray-600');
        badge.classList.add('bg-green-100', 'text-green-700');
        serviceSection.classList.add('complete');
      } else {
        badge.classList.remove('bg-green-100', 'text-green-700');
        badge.classList.add('bg-gray-100', 'text-gray-600');
        serviceSection.classList.remove('complete');
      }
    }
  });
  
  // Close modal with X button
  modal.querySelector('#closeSpecialtiesModal').onclick = () => {
    window.specialtiesModalOpen = false;
    updateHeaderButtons();
    document.body.style.overflow = '';
    modal.style.opacity = '0';
    setTimeout(() => modal.remove(), 200);
  };
  
  // Back to services button
  modal.querySelector('#backToServicesBtn').onclick = () => {
    window.selectedSubcategories = {};
    window.specialtiesModalOpen = false;
    updateHeaderButtons();
    
    document.body.style.overflow = '';
    modal.style.opacity = '0';
    setTimeout(() => modal.remove(), 200);
  };
  
  // Save and continue button
  modal.querySelector('#saveSpecialtiesBtn').onclick = () => {
    // Get all service IDs and their available subcategories
    const serviceIds = Object.keys(window.selectedServices);
    const servicesWithSubcats = servicesData.filter(s => s.subcategories && s.subcategories.length > 0);
    const servicesWithSubcatsIds = servicesWithSubcats.map(s => s.serviceId);
    
    // Only check services that actually have subcategories available
    const incompleteServices = servicesWithSubcatsIds.filter(id => 
      !selectedSubcats[id] || selectedSubcats[id].length === 0
    );
    
    if (incompleteServices.length > 0) {
      showFunMessage('Pick specialties for all services! 🎯');
      
      // Highlight incomplete sections
      incompleteServices.forEach(id => {
        const section = modal.querySelector(`.service-section[data-service-id="${id}"]`);
        if (section) {
          section.classList.add('incomplete');
          section.classList.add('shake-animation');
          setTimeout(() => {
            section.classList.remove('shake-animation');
            section.classList.remove('incomplete');
          }, 500);
        }
      });
      
      return;
    }
    
    // Save to global state and localStorage
    window.selectedSubcategories = selectedSubcats;
    try {
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.provider_services = window.selectedServices;
      expats.provider_subcategories = window.selectedSubcategories;
      localStorage.setItem('expats', JSON.stringify(expats));
    } catch (e) {
      console.warn('Could not save to localStorage:', e.message);
    }
    
    window.specialtiesModalOpen = false;
    
    // Close modal
    document.body.style.overflow = '';
    modal.style.opacity = '0';
    setTimeout(() => {
      modal.remove();
      // Go to next step directly
      window.showStep(4); // Step 5 (index 4)
    }, 200);
  };
  
  // Keep global functions for potential header button usage
  window.specialtiesModalSave = () => modal.querySelector('#saveSpecialtiesBtn')?.click();
  window.specialtiesModalBack = () => modal.querySelector('#backToServicesBtn')?.click();
  
  // Mark modal as open and update header buttons
  window.specialtiesModalOpen = true;
  updateHeaderButtons();
}

// Style for modal
const modalStyle = document.createElement('style');
modalStyle.textContent = `
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
`;
document.head.appendChild(modalStyle);

// Optimized initialization (event delegation + passive listeners)
document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('#step4');
  if (!container) return;
  
  // Load services on first display
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
        if (!container.classList.contains('hidden') && !container.dataset.loaded) {
          loadServices();
          container.dataset.loaded = 'true';
        }
        
        // Update buttons when step becomes visible
        if (!container.classList.contains('hidden')) {
          updateHeaderButtons();
        }
      }
    });
  });
  
  observer.observe(container, { attributes: true });
  
  // Event delegation for service cards
  container.addEventListener('click', function(e) {
    const card = e.target.closest('.service-card');
    if (card) {
      window.selectService(card);
    }
  }, { passive: true });
  
  // Keyboard support
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