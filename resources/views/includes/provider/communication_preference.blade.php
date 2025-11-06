<!-- 
============================================
🚀 STEP 8 - COMMUNICATION PREFERENCE (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Toggle buttons Yes/No pour Online et In Person
💎 Validation au moins 1 "Yes" requis
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
============================================
-->

<div id="step8" class="hidden flex flex-col h-full" role="region" aria-label="Select communication preference">
  
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
          <span class="text-lg sm:text-xl">💬</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Communication Preference 🌐
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Would you like to speak online or in person?
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          Select at least one "Yes"
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Error Alert (Hidden by default) -->
    <div id="step8Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select at least one "Yes"</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose at least one communication method</p>
        </div>
      </div>
    </div>

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border-2 border-yellow-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <span class="text-xl flex-shrink-0">💡</span>
        <div>
          <p class="text-xs font-bold text-yellow-900">You can choose both options</p>
          <p class="text-xs text-yellow-700 mt-0.5">Select what works best for you</p>
        </div>
      </div>
    </div>

    <!-- Communication Options -->
    <div class="space-y-3 sm:space-y-4">
      
      <!-- Online Option -->
      <div class="comm-card bg-white border-2 border-blue-400 rounded-2xl p-4 sm:p-5 shadow-sm">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
          <div class="flex items-center gap-3 flex-1">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
              <span class="text-2xl">💻</span>
            </div>
            <div class="flex-1">
              <h3 class="text-gray-900 font-bold text-base sm:text-lg">Online</h3>
              <p class="text-gray-600 text-xs sm:text-sm">Video calls & remote sessions</p>
            </div>
          </div>
          <div class="flex gap-2 w-full sm:w-auto">
            <button 
              type="button" 
              class="toggle-btn flex-1 sm:flex-none px-6 py-2.5 rounded-lg font-bold text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
              data-option="online"
              data-value="yes">
              Yes
            </button>
            <button 
              type="button" 
              class="toggle-btn flex-1 sm:flex-none px-6 py-2.5 rounded-lg font-bold text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
              data-option="online"
              data-value="no">
              No
            </button>
          </div>
        </div>
      </div>

      <!-- In Person Option -->
      <div class="comm-card bg-white border-2 border-blue-400 rounded-2xl p-4 sm:p-5 shadow-sm">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
          <div class="flex items-center gap-3 flex-1">
            <div class="w-12 h-12 bg-gradient-to-br from-cyan-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
              <span class="text-2xl">🤝</span>
            </div>
            <div class="flex-1">
              <h3 class="text-gray-900 font-bold text-base sm:text-lg">In Person</h3>
              <p class="text-gray-600 text-xs sm:text-sm">Face-to-face meetings</p>
            </div>
          </div>
          <div class="flex gap-2 w-full sm:w-auto">
            <button 
              type="button" 
              class="toggle-btn flex-1 sm:flex-none px-6 py-2.5 rounded-lg font-bold text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
              data-option="inperson"
              data-value="yes">
              Yes
            </button>
            <button 
              type="button" 
              class="toggle-btn flex-1 sm:flex-none px-6 py-2.5 rounded-lg font-bold text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
              data-option="inperson"
              data-value="no">
              No
            </button>
          </div>
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
   💬 COMMUNICATION CARDS
   ============================================ */

#step8 .comm-card {
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
}

/* ============================================
   🔘 TOGGLE BUTTONS
   ============================================ */

#step8 .toggle-btn {
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
}

#step8 .toggle-btn:hover {
  border-color: #60a5fa;
  background: #eff6ff;
  transform: translateY(-1px);
}

#step8 .toggle-btn:active {
  transform: scale(0.98);
}

/* État actif YES */
#step8 .toggle-btn.active-yes {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-color: #059669;
  color: white;
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

#step8 .toggle-btn.active-yes:hover {
  background: linear-gradient(135deg, #059669 0%, #047857 100%);
  transform: translateY(-1px);
}

/* État actif NO */
#step8 .toggle-btn.active-no {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  border-color: #dc2626;
  color: white;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

#step8 .toggle-btn.active-no:hover {
  background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
  transform: translateY(-1px);
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

#step8 .toggle-btn:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
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
  #step8 .toggle-btn {
    border: 3px solid currentColor;
  }
}

/* ============================================
   ⚡ OPTIMISATIONS PERFORMANCE
   ============================================ */

#step8 .toggle-btn,
#step8 .comm-card {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<!-- ============================================
     JAVASCRIPT OPTIMISÉ
     ============================================ -->
<script>
(function() {
  'use strict';

  // ============================================
  // 🔧 STATE MANAGEMENT
  // ============================================
  
  const state = {
    communicationPreference: {
      online: null,
      inperson: null
    },
    isValid: false
  };

  let cachedElements = null;
  let saveTimeout = null;

  // ============================================
  // 📦 CACHE DOM ELEMENTS
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step8'),
        buttons: document.querySelectorAll('#step8 .toggle-btn'),
        errorAlert: document.getElementById('step8Error')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCAL STORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch (e) {
      console.warn('localStorage read error:', e.message);
      return {};
    }
  }

  function saveToLocalStorage() {
    // Debounce pour optimisation
    clearTimeout(saveTimeout);
    saveTimeout = setTimeout(() => {
      try {
        const expats = getLocalStorage();
        expats.communication_preference = state.communicationPreference;
        localStorage.setItem('expats', JSON.stringify(expats));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 300);
  }

  // ============================================
  // 🔘 UPDATE BUTTONS
  // ============================================
  
  function updateStep8Buttons() {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    if (state.isValid) {
      // Au moins un "Yes" sélectionné → activer les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = false;
      if (desktopNextBtn) desktopNextBtn.disabled = false;
    } else {
      // Aucun "Yes" → désactiver les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = true;
      if (desktopNextBtn) desktopNextBtn.disabled = true;
    }
  }

  // ✅ EXPOSER GLOBALEMENT pour wizard-steps.js
  window.updateStep8Buttons = updateStep8Buttons;

  // ============================================
  // ✅ VALIDATION
  // ============================================
  
  function validatePreference() {
    // Au moins un "Yes" requis
    state.isValid = state.communicationPreference.online === 'Yes' || 
                    state.communicationPreference.inperson === 'Yes';
    
    // Mise à jour des boutons
    updateStep8Buttons();
    
    return state.isValid;
  }

  // ============================================
  // 🎨 UI UPDATES
  // ============================================
  
  function updateButtonStates(option, value) {
    const elements = getCachedElements();
    
    requestAnimationFrame(() => {
      // Retirer les classes actives des boutons de la même option
      elements.buttons.forEach(btn => {
        if (btn.getAttribute('data-option') === option) {
          btn.classList.remove('active-yes', 'active-no');
        }
      });
      
      // Trouver le bouton cliqué et ajouter la classe active
      elements.buttons.forEach(btn => {
        if (btn.getAttribute('data-option') === option && 
            btn.getAttribute('data-value') === value) {
          if (value === 'yes') {
            btn.classList.add('active-yes');
          } else {
            btn.classList.add('active-no');
          }
        }
      });
    });
  }

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
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleToggleClick(button) {
    const option = button.getAttribute('data-option');
    const value = button.getAttribute('data-value');
    const elements = getCachedElements();
    
    // Mettre à jour l'état
    if (value === 'yes') {
      state.communicationPreference[option] = 'Yes';
    } else {
      state.communicationPreference[option] = 'No';
    }
    
    // Mettre à jour l'UI
    updateButtonStates(option, value);
    
    // Cacher l'erreur si visible
    if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
      elements.errorAlert.classList.add('hidden');
    }
    
    // Valider et sauvegarder
    validatePreference();
    saveToLocalStorage();
  }

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const elements = getCachedElements();
    
    // Event delegation pour les boutons toggle
    if (elements.step) {
      elements.step.addEventListener('click', function(e) {
        const button = e.target.closest('.toggle-btn');
        if (button) {
          handleToggleClick(button);
        }
      }, { passive: true });
    }
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const expats = getLocalStorage();
    
    // Restaurer la préférence depuis localStorage
    if (expats.communication_preference) {
      state.communicationPreference = expats.communication_preference;
      
      requestAnimationFrame(() => {
        // Restaurer les états des boutons
        elements.buttons.forEach(button => {
          const option = button.getAttribute('data-option');
          const value = button.getAttribute('data-value');
          const savedValue = state.communicationPreference[option];
          
          if (savedValue === 'Yes' && value === 'yes') {
            button.classList.add('active-yes');
          } else if (savedValue === 'No' && value === 'no') {
            button.classList.add('active-no');
          }
        });
        
        // Valider
        validatePreference();
      });
    } else {
      // Pas de données sauvegardées, valider l'état initial
      validatePreference();
    }
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  // Fonction publique pour validation externe
  window.validateStep8 = function() {
    const isValid = validatePreference();
    if (!isValid) {
      showError();
    }
    return isValid;
  };

  // Exposer l'état globalement si nécessaire (pour compatibilité)
  window.communicationPreference = state.communicationPreference;

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
              // Step est visible, restaurer l'état
              restoreState();
              updateStep8Buttons();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restaurer l'état initial
    restoreState();
    updateStep8Buttons();
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>