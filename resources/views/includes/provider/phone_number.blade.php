<!-- 
============================================
🚀 STEP 14 - PHONE NUMBER INPUT (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Téléphone avec intl-tel-input
💎 Indicateurs visuels de succès
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
✅ CONFORME AU GUIDE SYSTÈME WIZARD
🔧 MODIFIED: localStorage key changed to 'expats'
============================================
-->

<!-- Include intl-tel-input library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<div id="step14" class="hidden flex flex-col h-full" role="region" aria-label="Enter your phone number">
  
  <!-- ============================================
       TITRE FIXE (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 blobs animés -->
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
          <span class="text-lg sm:text-xl">📱</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What's Your Number? ☎️
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          We'll use this to communicate with you
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step14StatusText">
          Phone not provided
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-3">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-base">💬</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-bold text-sm sm:text-base">Required for communication</p>
          <p class="text-blue-700 text-xs sm:text-sm font-medium mt-1">Your number allows communication with service requesters</p>
        </div>
      </div>
    </div>

    <!-- Phone Input -->
    <div class="input-container">
      <label class="input-label">
        <span class="text-lg sm:text-xl">📞</span>
        <span class="label-text label-blue">Phone Number</span>
      </label>
      <div class="input-wrapper">
        <input 
          id="phone_number_input" 
          type="tel" 
          placeholder="Enter your phone number"
          class="phone-input"
          autocomplete="tel"
        />
        <div class="success-indicator">
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
      <p class="input-hint">We'll never share your phone number without your permission</p>
    </div>

    <!-- Error Alert (Hidden by default) -->
    <div id="step14Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please enter at least 6 digits</p>
          <p class="text-xs text-red-600 mt-0.5">Example: +33 6 12 34 56 78</p>
        </div>
      </div>
    </div>

    <!-- Success Alert (Hidden by default) -->
    <div id="step14Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-green-800">Valid phone number!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ============================================
     STYLES OPTIMISÉS
     ============================================ -->
<style>
/* ============================================
   🎨 BASE STYLES
   ============================================ */

/* Animations des blobs - optimisé GPU */
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
  will-change: transform;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Shake animation pour les erreurs */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

/* ============================================
   📝 INPUT STYLES
   ============================================ */

#step14 .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step14 .input-container:hover {
  transform: translateY(-2px);
}

#step14 .input-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.625rem;
  font-weight: 700;
  font-size: 0.875rem;
}

@media (min-width: 640px) {
  #step14 .input-label {
    font-size: 1rem;
  }
}

#step14 .label-text {
  font-weight: 800;
}

#step14 .label-blue {
  color: #2563eb;
}

#step14 .input-wrapper {
  position: relative;
  width: 100%;
}

#step14 .phone-input {
  width: 100%;
  padding: 0.875rem 3rem 0.875rem 1.25rem;
  border: 2px solid #d1d5db;
  border-radius: 0.75rem;
  font-size: 0.875rem;
  font-weight: 500;
  background: white;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  outline: none;
}

@media (min-width: 640px) {
  #step14 .phone-input {
    padding: 1rem 3rem 1rem 1.25rem;
    font-size: 1rem;
  }
}

#step14 .phone-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#step14 .phone-input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
  padding-right: 3rem;
}

#step14 .phone-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step14 .success-indicator {
  position: absolute;
  right: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  width: 2rem;
  height: 2rem;
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 50%;
  display: none;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

@media (min-width: 640px) {
  #step14 .success-indicator {
    width: 2.25rem;
    height: 2.25rem;
  }
}

#step14 .phone-input.valid ~ .success-indicator {
  display: flex;
  opacity: 1;
  animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
  0% {
    transform: translateY(-50%) scale(0);
  }
  50% {
    transform: translateY(-50%) scale(1.1);
  }
  100% {
    transform: translateY(-50%) scale(1);
  }
}

#step14 .input-hint {
  margin-top: 0.5rem;
  font-size: 0.75rem;
  color: #6b7280;
  font-weight: 500;
}

@media (min-width: 640px) {
  #step14 .input-hint {
    font-size: 0.875rem;
  }
}

/* Error shake animation */
#step14 .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}

/* ============================================
   📱 INTL-TEL-INPUT OVERRIDES
   ============================================ */

#step14 .iti {
  width: 100%;
  display: block;
}

#step14 .iti__flag-container {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
}

#step14 .iti__selected-flag {
  padding: 0 0.5rem;
  border-radius: 0.5rem;
  background: transparent;
  border: none;
  outline: none;
  transition: background-color 0.2s ease;
}

#step14 .iti__selected-flag:hover,
#step14 .iti__selected-flag:focus {
  background-color: rgba(59, 130, 246, 0.1);
}

#step14 .iti__country-list {
  max-height: 250px;
  background: white;
  border: 2px solid #d1d5db;
  border-radius: 0.75rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  margin-top: 0.25rem;
  z-index: 999;
}

#step14 .iti__country {
  padding: 0.625rem 1rem;
  transition: background-color 0.2s ease;
}

#step14 .iti__country:hover {
  background-color: rgba(59, 130, 246, 0.1);
}

#step14 .iti__country.iti__highlight {
  background-color: rgba(59, 130, 246, 0.15);
}

#step14 .iti__selected-flag .iti__arrow {
  border-top-color: #6b7280;
  margin-left: 0.25rem;
}

#step14 .iti--allow-dropdown input {
  padding-left: 4.5rem !important;
}

@media (min-width: 640px) {
  #step14 .iti--allow-dropdown input {
    padding-left: 5rem !important;
  }
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step14 .phone-input {
    border: 3px solid currentColor;
  }
  
  #step14 .phone-input:focus {
    border: 3px solid #1d4ed8;
  }
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

#step14 .input-container,
#step14 .phone-input,
#step14 .success-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<script>
/* ============================================
   🎯 STEP 14 - PHONE VALIDATION
   ✅ CONFORME AU GUIDE SYSTÈME WIZARD
   ✅ Validation téléphone (min 6 chiffres)
   ✅ Persistance localStorage
   ✅ intl-tel-input integration
   🔧 MODIFIED: localStorage key 'expats'
   ============================================ */

(function() {
  'use strict';

  // ============================================
  // 📦 STATE & CONSTANTS
  // ============================================
  
  const STORAGE_KEY = 'expats';
  
  const state = {
    phone: '',
    isValid: false,
    saveTimeout: null,
    validationTimeout: null,
    iti: null
  };

  let cachedElements = null;

  // ============================================
  // 🗄️ CACHE DOM ELEMENTS
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step14'),
        phoneInput: document.getElementById('phone_number_input'),
        errorAlert: document.getElementById('step14Error'),
        successAlert: document.getElementById('step14Success'),
        statusText: document.getElementById('step14StatusText')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCAL STORAGE - expats
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      return {};
    }
  }

  function saveToLocalStorage() {
    // Debouncing - sauvegarder après 500ms d'inactivité
    if (state.saveTimeout) {
      clearTimeout(state.saveTimeout);
    }
    
    state.saveTimeout = setTimeout(() => {
      try {
        const data = getLocalStorage();
        data.phone_number = state.phone;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 500);
  }

  // ============================================
  // 📱 INTL-TEL-INPUT
  // ============================================
  
  function initIntlTelInput() {
    const elements = getCachedElements();
    if (!elements.phoneInput) return false;

    try {
      state.iti = window.intlTelInput(elements.phoneInput, {
        initialCountry: 'fr',
        preferredCountries: ['fr', 'be', 'ch', 'ca', 'us', 'gb'],
        separateDialCode: true,
        autoPlaceholder: 'aggressive',
        nationalMode: false,
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js'
      });
      
      return true;
    } catch (e) {
      console.error('Error initializing intl-tel-input:', e);
      return false;
    }
  }

  // ============================================
  // ✅ VALIDATION
  // ============================================
  
  function validatePhone() {
    const elements = getCachedElements();
    
    state.phone = elements.phoneInput.value.trim();
    const digitsOnly = state.phone.replace(/\D/g, '');
    
    // Validation assouplie: au moins 6 chiffres
    state.isValid = digitsOnly.length >= 6;
    
    // Mise à jour des classes CSS
    if (state.phone.length > 0) {
      if (state.isValid) {
        elements.phoneInput.classList.remove('invalid');
        elements.phoneInput.classList.add('valid');
      } else {
        elements.phoneInput.classList.remove('valid');
        elements.phoneInput.classList.add('invalid');
      }
    } else {
      elements.phoneInput.classList.remove('valid', 'invalid');
    }
    
    // Mise à jour du texte de statut
    if (elements.statusText) {
      if (state.isValid) {
        elements.statusText.textContent = 'Valid phone provided';
      } else {
        elements.statusText.textContent = 'Phone not provided';
      }
    }
    
    // Gestion des alertes
    if (state.isValid) {
      if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
      if (elements.successAlert) elements.successAlert.classList.remove('hidden');
    } else {
      if (elements.successAlert) elements.successAlert.classList.add('hidden');
    }
    
    return state.isValid;
  }

  // ============================================
  // 🌍 FONCTION DE VALIDATION GLOBALE
  // ============================================
  
  window.validateStep14 = function() {
    const elements = getCachedElements();
    
    if (!validatePhone()) {
      showError();
      return false;
    }
    
    return true;
  };

  // ============================================
  // 🎨 UI UPDATES
  // ============================================
  
  function showError() {
    const elements = getCachedElements();
    
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      
      // Scroll vers l'erreur
      requestAnimationFrame(() => {
        elements.errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      // Retirer l'animation après
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    
    // Shake sur l'input
    const inputContainer = elements.phoneInput?.closest('.input-container');
    if (inputContainer) {
      inputContainer.classList.add('error-shake');
      setTimeout(() => inputContainer.classList.remove('error-shake'), 500);
    }
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'phone_number_input') return;
    
    // Debouncing pour la validation
    if (state.validationTimeout) {
      clearTimeout(state.validationTimeout);
    }
    
    state.validationTimeout = setTimeout(() => {
      requestAnimationFrame(() => {
        validatePhone();
        if (state.isValid) {
          saveToLocalStorage();
        }
        
        // ✅ Notifier wizard-steps.js
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      });
    }, 300);
  }

  function handleCountryChange() {
    requestAnimationFrame(() => {
      validatePhone();
      if (state.isValid) {
        saveToLocalStorage();
      }
      
      // ✅ Notifier wizard-steps.js
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    });
  }

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const elements = getCachedElements();
    
    // Event delegation sur le step
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
    }
    
    // Event spécifique pour le changement de pays
    if (elements.phoneInput) {
      elements.phoneInput.addEventListener('countrychange', handleCountryChange);
      
      // Gestion de la direction du dropdown (up/down)
      elements.phoneInput.addEventListener('open:countrydropdown', function() {
        const list = document.querySelector('.iti__country-list');
        if (!list) return;
        
        const rect = elements.phoneInput.getBoundingClientRect();
        const spaceBelow = window.innerHeight - rect.bottom;
        const spaceAbove = rect.top;
        
        if (spaceAbove > spaceBelow && spaceAbove > 300) {
          list.classList.add('iti__country-list--up');
        } else {
          list.classList.remove('iti__country-list--up');
        }
      });
    }
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    // Restaurer le téléphone depuis localStorage
    if (elements.phoneInput && data.phone_number) {
      elements.phoneInput.value = data.phone_number;
      state.phone = data.phone_number;
    }
    
    // Valider après restauration
    requestAnimationFrame(() => {
      validatePhone();
      
      // ✅ Notifier wizard-steps.js
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    });
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    // Vérifier que intl-tel-input est chargé
    if (!window.intlTelInput) {
      console.warn('intl-tel-input library not loaded');
      return;
    }

    // Init intl-tel-input
    const itiSuccess = initIntlTelInput();
    if (!itiSuccess) {
      console.error('Failed to initialize intl-tel-input');
      return;
    }

    // Observer pour détecter quand le step devient visible
    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              // Step est visible, restaurer l'état et valider
              restoreState();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Init event delegation
    initEventDelegation();

    // Restaurer l'état initial
    restoreState();
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>