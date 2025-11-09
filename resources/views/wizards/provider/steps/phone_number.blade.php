<!-- 
============================================
🚀 STEP 14 - PHONE NUMBER INPUT (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Téléphone avec intl-tel-input
💎 Indicateurs visuels de succès
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage avec clé 'expats'
⚡ Performance maximale
✅ CONFORME AU GUIDE SYSTÈME WIZARD
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
          What's Your Number?
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
  <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4">

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
    <div class="space-y-2">
      <label for="phone_number_input" class="block text-sm font-semibold text-gray-700">
        <span class="text-lg">📞</span> Phone Number <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <input 
          id="phone_number_input" 
          type="tel" 
          name="phone_number"
          placeholder="Enter your phone number"
          class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-base
                 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                 transition-all duration-200"
          autocomplete="tel"
        />
      </div>
      <p class="text-xs text-gray-500 mt-1">We'll never share your phone number without your permission</p>
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

/* Phone input validation states */
#step14 #phone_number_input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step14 #phone_number_input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

/* intl-tel-input overrides */
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

#step14 .iti--allow-dropdown input {
  padding-left: 4.5rem !important;
}

@media (min-width: 640px) {
  #step14 .iti--allow-dropdown input {
    padding-left: 5rem !important;
  }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<script>
/* ============================================
   🎯 STEP 14 - PHONE VALIDATION
   ✅ CONFORME AU GUIDE SYSTÈME WIZARD
   ✅ Validation téléphone (min 6 chiffres)
   ✅ Persistance localStorage avec clé 'expats'
   ✅ intl-tel-input integration
   ============================================ */

(function() {
  'use strict';

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
  // 💾 LOCAL STORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      return {};
    }
  }

  function saveToLocalStorage() {
    if (state.saveTimeout) {
      clearTimeout(state.saveTimeout);
    }
    
    state.saveTimeout = setTimeout(() => {
      try {
        const data = getLocalStorage();
        data.phone_number = state.phone;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        console.log('💾 [Step 14] Phone saved to localStorage:', state.phone);
      } catch (e) {
        console.warn('⚠️ [Step 14] localStorage error:', e);
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
      
      console.log('✅ [Step 14] intl-tel-input initialized');
      return true;
    } catch (e) {
      console.error('❌ [Step 14] Error initializing intl-tel-input:', e);
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
    
    // Validation: au moins 6 chiffres
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
    console.log('🔍 [Step 14] validateStep14() called');
    const elements = getCachedElements();
    
    if (!validatePhone()) {
      console.warn('⚠️ [Step 14] Validation failed');
      showError();
      return false;
    }
    
    console.log('✅ [Step 14] Validation passed');
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
      
      requestAnimationFrame(() => {
        elements.errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'phone_number_input') return;
    
    if (state.validationTimeout) {
      clearTimeout(state.validationTimeout);
    }
    
    state.validationTimeout = setTimeout(() => {
      requestAnimationFrame(() => {
        validatePhone();
        if (state.isValid) {
          saveToLocalStorage();
        }
        
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
    
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
    }
    
    if (elements.phoneInput) {
      elements.phoneInput.addEventListener('countrychange', handleCountryChange);
    }
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if (elements.phoneInput && data.phone_number) {
      elements.phoneInput.value = data.phone_number;
      state.phone = data.phone_number;
      console.log('🔄 [Step 14] Phone restored from localStorage:', data.phone_number);
    }
    
    requestAnimationFrame(() => {
      validatePhone();
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    });
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    if (!window.intlTelInput) {
      console.warn('⚠️ [Step 14] intl-tel-input library not loaded');
      return;
    }

    const itiSuccess = initIntlTelInput();
    if (!itiSuccess) {
      console.error('❌ [Step 14] Failed to initialize intl-tel-input');
      return;
    }

    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              restoreState();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    initEventDelegation();
    restoreState();
    
    console.log('✅ [Step 14] Phone validation initialized');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>