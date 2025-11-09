<!-- 
============================================
🚀 STEP 8 - COMMUNICATION PREFERENCE - FINAL
============================================
-->

<div id="step8" class="hidden flex flex-col h-full" role="region" aria-label="Select communication preference">
  
  <!-- FIXED HEADER (STICKY) -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
          </svg>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Communication Preference 💬
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600 px-2">
          Par téléphone/en ligne ou en présentiel ?
        </p>
      </div>

      <div class="hidden sm:inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          Select at least one "Yes"
        </span>
      </div>
    </div>
  </div>

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-2 sm:space-y-3 px-1">

    <!-- Info Banner - MASQUÉ SUR MOBILE -->
    <div class="hidden sm:block bg-gradient-to-r from-yellow-50 to-amber-50 border-2 border-yellow-300 rounded-xl p-3">
      <div class="flex items-start gap-2">
        <span class="text-lg flex-shrink-0">💡</span>
        <div>
          <p class="text-xs font-bold text-yellow-900">Vous pouvez choisir les deux options</p>
          <p class="text-xs text-yellow-700 mt-0.5">Choisissez ce qui vous convient le mieux</p>
        </div>
      </div>
    </div>

    <!-- Communication Options -->
    <div class="space-y-2 sm:space-y-3">
      
      <!-- Online Option -->
      <div class="comm-card bg-white border-2 border-blue-400 rounded-xl p-3 sm:p-4 shadow-sm">
        <div class="flex items-start gap-2 sm:gap-3">
          <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
            <span class="text-xl sm:text-2xl">💻</span>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-gray-900 font-bold text-sm sm:text-base mb-0.5">En ligne</h3>
            <p class="text-gray-600 text-[11px] sm:text-xs leading-tight mb-2 sm:mb-3">Par téléphone ou en ligne</p>
            <div class="flex gap-2">
              <button 
                type="button" 
                class="toggle-btn flex-1 px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
                data-option="online"
                data-value="yes">
                Oui
              </button>
              <button 
                type="button" 
                class="toggle-btn flex-1 px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
                data-option="online"
                data-value="no">
                Non
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- In Person Option -->
      <div class="comm-card bg-white border-2 border-blue-400 rounded-xl p-3 sm:p-4 shadow-sm">
        <div class="flex items-start gap-2 sm:gap-3">
          <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-cyan-600 to-teal-600 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
            <span class="text-xl sm:text-2xl">🤝</span>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-gray-900 font-bold text-sm sm:text-base mb-0.5">En personne</h3>
            <p class="text-gray-600 text-[11px] sm:text-xs leading-tight mb-2 sm:mb-3">En accompagnant, en présentiel</p>
            <div class="flex gap-2">
              <button 
                type="button" 
                class="toggle-btn flex-1 px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
                data-option="inperson"
                data-value="yes">
                Oui
              </button>
              <button 
                type="button" 
                class="toggle-btn flex-1 px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm border-2 bg-white text-gray-700 border-gray-300 transition-all"
                data-option="inperson"
                data-value="no">
                Non
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<style>
/* Blob animations */
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

/* Communication Cards */
#step8 .comm-card {
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
}

/* Toggle Buttons Base */
#step8 .toggle-btn {
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
  user-select: none;
  -webkit-tap-highlight-color: transparent;
  min-width: 60px;
}

@media (min-width: 640px) {
  #step8 .toggle-btn {
    min-width: 70px;
  }
}

#step8 .toggle-btn:hover {
  border-color: #60a5fa;
  background: #eff6ff;
  transform: translateY(-1px);
}

#step8 .toggle-btn:active {
  transform: scale(0.98);
}

/* Active YES state */
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

/* Active NO state */
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

/* Accessibility */
#step8 .toggle-btn:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
}

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms;
    animation-iteration-count: 1;
    transition-duration: 0.01ms;
  }
}
</style>

<script>
(function() {
  'use strict';

  const state = {
    communicationPreference: {
      online: null,
      inperson: null
    },
    isValid: false
  };

  let cachedElements = null;
  let saveTimeout = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step8'),
        buttons: document.querySelectorAll('#step8 .toggle-btn')
      };
    }
    return cachedElements;
  }

  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch (e) {
      return {};
    }
  }

  function saveToLocalStorage() {
    clearTimeout(saveTimeout);
    saveTimeout = setTimeout(() => {
      try {
        const data = getLocalStorage();
        data.communication_preference = state.communicationPreference;
        localStorage.setItem('expats', JSON.stringify(data));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 300);
  }

  function updateButtonStates(option, value) {
    const elements = getCachedElements();
    
    requestAnimationFrame(() => {
      // Remove active classes
      elements.buttons.forEach(btn => {
        if (btn.getAttribute('data-option') === option) {
          btn.classList.remove('active-yes', 'active-no');
        }
      });
      
      // Add active class to clicked button
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

  function handleToggleClick(button) {
    const option = button.getAttribute('data-option');
    const value = button.getAttribute('data-value');
    
    // Update state
    if (value === 'yes') {
      state.communicationPreference[option] = 'Yes';
    } else {
      state.communicationPreference[option] = 'No';
    }
    
    // Update UI
    updateButtonStates(option, value);
    
    // Validate
    state.isValid = state.communicationPreference.online === 'Yes' || 
                    state.communicationPreference.inperson === 'Yes';
    
    // Save
    saveToLocalStorage();
    
    // Notify navigation
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  }

  function initEventDelegation() {
    const elements = getCachedElements();
    
    if (elements.step) {
      elements.step.addEventListener('click', function(e) {
        const button = e.target.closest('.toggle-btn');
        if (button) {
          handleToggleClick(button);
        }
      }, { passive: true });
    }
  }

  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if (data.communication_preference) {
      state.communicationPreference = data.communication_preference;
      
      requestAnimationFrame(() => {
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
        
        state.isValid = state.communicationPreference.online === 'Yes' || 
                        state.communicationPreference.inperson === 'Yes';
      });
    } else {
      state.isValid = false;
    }
  }

  // ✅ Validation globale
  window.validateStep8 = function() {
    return state.communicationPreference.online === 'Yes' || 
           state.communicationPreference.inperson === 'Yes';
  };

  function init() {
    initEventDelegation();

    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              restoreState();
              
              if (typeof window.updateNavigationButtons === 'function') {
                window.updateNavigationButtons();
              }
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    restoreState();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>