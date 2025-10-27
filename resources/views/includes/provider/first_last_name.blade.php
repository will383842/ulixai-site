<!-- 
============================================
🚀 STEP 12 - NAME INPUT (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 First Name + Surname avec validation
💎 Indicateurs visuels de succès
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
============================================
-->

@php 
  $check = Auth::check();
  $name = Auth::user()->name ?? '';
@endphp

<div id="step12" class="hidden flex flex-col h-full" role="region" aria-label="Enter your name">
  
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
          <span class="text-lg sm:text-xl">👤</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What's Your Name? ✍️
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Let people know who you are
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step12FieldsCompleted">0</span> / 2 fields completed
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
          <span class="text-base">ℹ️</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-bold text-sm sm:text-base">Both fields are required</p>
          <p class="text-blue-700 text-xs sm:text-sm font-medium mt-1">Enter your first name and surname to continue</p>
        </div>
      </div>
    </div>

    <!-- Input Fields -->
    <div class="space-y-3 sm:space-y-4">
      
      <!-- First Name -->
      <div class="input-container">
        <label class="input-label">
          <span class="text-lg sm:text-xl">📝</span>
          <span class="label-text label-blue">First Name</span>
        </label>
        <div class="input-wrapper">
          <input 
            id="first_name_input" 
            type="text" 
            placeholder="Enter your first name" 
            class="name-input"
            autocomplete="given-name"
            maxlength="50"
            @if($check)
              value="{{ $name }}"
              disabled
              readonly
            @endif
          />
          <div class="success-indicator">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Surname -->
      <div class="input-container">
        <label class="input-label">
          <span class="text-lg sm:text-xl">📝</span>
          <span class="label-text label-cyan">Surname</span>
        </label>
        <div class="input-wrapper">
          <input 
            id="last_name_input" 
            type="text" 
            placeholder="Enter your surname" 
            class="name-input"
            autocomplete="family-name"
            maxlength="50"
            @if($check)
              value="{{ $name }}"
              disabled
              readonly
            @endif
          />
          <div class="success-indicator">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Error Alert (Hidden by default) -->
    <div id="step12Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please fill in both fields</p>
          <p class="text-xs text-red-600 mt-0.5">First name and surname are required to continue</p>
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

#step12 .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step12 .input-container:hover {
  transform: translateY(-2px);
}

#step12 .input-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
  font-size: 0.875rem;
}

@media (min-width: 640px) {
  #step12 .input-label {
    font-size: 1rem;
  }
}

#step12 .label-text {
  background: linear-gradient(to right, var(--tw-gradient-stops));
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  font-weight: 800;
}

#step12 .label-blue {
  --tw-gradient-from: #2563eb;
  --tw-gradient-to: #0891b2;
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

#step12 .label-cyan {
  --tw-gradient-from: #0891b2;
  --tw-gradient-to: #14b8a6;
  --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

#step12 .input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

#step12 .name-input {
  width: 100%;
  padding: 0.875rem 1rem;
  padding-right: 3rem;
  border: 2px solid #cbd5e1;
  border-radius: 1rem;
  font-size: 0.875rem;
  font-weight: 600;
  color: #1e293b;
  background: white;
  transition: all 0.3s ease;
  outline: none;
}

@media (min-width: 640px) {
  #step12 .name-input {
    padding: 1rem 1.25rem;
    font-size: 1rem;
  }
}

#step12 .name-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

#step12 .name-input:disabled,
#step12 .name-input:read-only {
  background-color: #f1f5f9;
  cursor: not-allowed;
  opacity: 0.7;
}

#step12 .name-input:not(:disabled):not(:read-only):valid:not(:placeholder-shown) {
  border-color: #10b981;
  padding-right: 3rem;
}

#step12 .name-input:not(:disabled):not(:read-only):valid:not(:placeholder-shown) ~ .success-indicator {
  display: flex;
}

#step12 .success-indicator {
  display: none;
  position: absolute;
  right: 1rem;
  align-items: center;
  justify-content: center;
  width: 1.75rem;
  height: 1.75rem;
  background: linear-gradient(to right, #10b981, #14b8a6);
  border-radius: 50%;
  pointer-events: none;
}

@media (min-width: 640px) {
  #step12 .success-indicator {
    width: 2rem;
    height: 2rem;
  }
}

#step12 .error-shake {
  animation: shake 0.5s ease-in-out;
}

/* ============================================
   🎯 PERFORMANCE
   ============================================ */

#step12 .input-container,
#step12 .name-input,
#step12 .success-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

/* ============================================
   📱 ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step12 .name-input {
    border: 3px solid currentColor;
  }
  
  #step12 .name-input:focus {
    border: 3px solid #1d4ed8;
  }
}
</style>

<!-- ============================================
     SCRIPTS
     ============================================ -->
<script>
/* ============================================
   🎯 STEP 12 - NAME INPUT SCRIPT
   ============================================ */

(function() {
  'use strict';

  // ============================================
  // 💾 STATE MANAGEMENT
  // ============================================
  
  const state = {
    firstName: '',
    lastName: '',
    cachedElements: null,
    saveTimeout: null
  };

  // ============================================
  // 🎯 CACHE DOM
  // ============================================
  
  function getCachedElements() {
    if (!state.cachedElements) {
      state.cachedElements = {
        step: document.getElementById('step12'),
        firstNameInput: document.getElementById('first_name_input'),
        lastNameInput: document.getElementById('last_name_input'),
        errorAlert: document.getElementById('step12Error'),
        fieldsCounter: document.getElementById('step12FieldsCompleted')
      };
    }
    return state.cachedElements;
  }

  // ============================================
  // 🔘 FONCTION DE MISE À JOUR DES BOUTONS
  // ============================================
  
  function updateStep12Buttons() {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    const isValid = state.firstName.length > 0 && state.lastName.length > 0;
    
    if (isValid) {
      // Si les deux champs sont remplis, activer les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = false;
      if (desktopNextBtn) desktopNextBtn.disabled = false;
    } else {
      // Sinon, désactiver les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = true;
      if (desktopNextBtn) desktopNextBtn.disabled = true;
    }
  }

  // ============================================
  // 💾 LOCALSTORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch {
      return {};
    }
  }

  function saveToLocalStorage() {
    // Debouncing - sauvegarder après 300ms d'inactivité
    if (state.saveTimeout) {
      clearTimeout(state.saveTimeout);
    }
    
    state.saveTimeout = setTimeout(() => {
      try {
        const expats = getLocalStorage();
        expats.firstName = state.firstName;
        expats.lastName = state.lastName;
        localStorage.setItem('expats', JSON.stringify(expats));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 300);
  }

  // ============================================
  // ✅ VALIDATION
  // ============================================
  
  function validateFields() {
    const elements = getCachedElements();
    
    state.firstName = elements.firstNameInput.value.trim();
    state.lastName = elements.lastNameInput.value.trim();
    
    const isValid = state.firstName.length > 0 && state.lastName.length > 0;
    
    // Mise à jour du compteur
    const completedCount = (state.firstName.length > 0 ? 1 : 0) + (state.lastName.length > 0 ? 1 : 0);
    if (elements.fieldsCounter) {
      elements.fieldsCounter.textContent = completedCount;
    }
    
    // Cacher l'erreur si les champs sont valides
    if (isValid && elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
      elements.errorAlert.classList.add('hidden');
    }
    
    // Mettre à jour l'état des boutons
    updateStep12Buttons();
    
    return isValid;
  }

  window.validateStep12 = function() {
    const elements = getCachedElements();
    
    if (!validateFields()) {
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
    
    // Shake sur les inputs vides
    const firstNameContainer = elements.firstNameInput?.closest('.input-container');
    const lastNameContainer = elements.lastNameInput?.closest('.input-container');
    
    if (!state.firstName && firstNameContainer) {
      firstNameContainer.classList.add('error-shake');
      setTimeout(() => firstNameContainer.classList.remove('error-shake'), 500);
    }
    
    if (!state.lastName && lastNameContainer) {
      lastNameContainer.classList.add('error-shake');
      setTimeout(() => lastNameContainer.classList.remove('error-shake'), 500);
    }
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleInput(e) {
    const input = e.target;
    if (!input || input.disabled || input.readOnly) return;
    
    // Utiliser requestAnimationFrame pour smooth UI
    requestAnimationFrame(() => {
      validateFields();
      saveToLocalStorage();
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
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const expats = getLocalStorage();
    
    // Restaurer uniquement si les inputs ne sont pas disabled
    if (elements.firstNameInput && !elements.firstNameInput.disabled) {
      if (expats.firstName) {
        elements.firstNameInput.value = expats.firstName;
        state.firstName = expats.firstName;
      }
    }
    
    if (elements.lastNameInput && !elements.lastNameInput.disabled) {
      if (expats.lastName) {
        elements.lastNameInput.value = expats.lastName;
        state.lastName = expats.lastName;
      }
    }
    
    // Valider après restauration
    requestAnimationFrame(() => {
      validateFields();
    });
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    // Init event delegation
    initEventDelegation();

    // Observer pour détecter quand le step devient visible
    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              // Step est visible, restaurer l'état et mettre à jour les boutons
              restoreState();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

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