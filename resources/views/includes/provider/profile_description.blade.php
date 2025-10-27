<!-- 
============================================
🚀 STEP 9 - PROFILE DESCRIPTION (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Textarea avec compteur et validation
💎 Indicateurs visuels de progression
⚡ Structure header fixe + contenu sans scroll
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
============================================
-->

<div id="step9" class="hidden flex flex-col" role="region" aria-label="Tell us about yourself">
  
  <!-- ============================================
       TITRE FIXE (STICKY) - NON MODIFIÉ
       ============================================ -->
  <div class="bg-white pt-2 pb-2 border-b border-gray-100">
    
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
          <span class="text-lg sm:text-xl">✨</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Tell Us About Yourself 📝
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Share your expertise and stand out!
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step9CharCount">0</span>/500 characters
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SANS SCROLL - RÉDUIT
       ============================================ -->
  <div class="pt-2 space-y-1.5">

    <!-- Error Alert (Hidden by default) -->
    <div id="step9Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-2 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs font-semibold text-red-800">Minimum 200 characters required</p>
          <p class="text-xs text-red-600">Please write more about yourself</p>
        </div>
      </div>
    </div>

    <!-- Warning Info Banner -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-300 rounded-xl p-1.5">
      <div class="flex items-start gap-1.5">
        <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs font-bold text-amber-900">Minimum 200 characters required</p>
          <p class="text-xs text-amber-700">This will appear on your profile!</p>
        </div>
      </div>
    </div>

    <!-- Textarea Container -->
    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-2 border-2 border-blue-300">
      <label class="block text-gray-900 font-bold text-xs mb-1 flex items-center gap-1.5">
        <span class="text-base">📝</span>
        <span>Profile Description</span>
      </label>
      
      <textarea 
        id="step9Description" 
        name="profile_description"
        placeholder="Tell us about your experience, skills, and how you can help others succeed..."
        class="w-full border-2 border-blue-200 rounded-lg px-3 py-2 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-500 resize-none bg-white text-xs sm:text-sm transition-all"
        rows="4"
        maxlength="500"
      ></textarea>
      
      <!-- Character Counter Info -->
      <div class="flex flex-row justify-between items-center gap-2 mt-1">
        <div class="flex items-center gap-1.5 text-xs text-gray-600">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Min: <strong class="text-gray-900">200</strong> • Max: 500</span>
        </div>
        <div class="text-sm font-bold">
          <span id="step9Counter" class="text-gray-400">0</span>
          <span class="text-gray-400">/500</span>
        </div>
      </div>

      <!-- Progress Bar -->
      <div class="mt-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
        <div id="step9ProgressBar" class="h-full bg-gray-400 transition-all duration-300" style="width: 0%"></div>
      </div>

      <!-- Indicators -->
      <div class="mt-1 flex items-center justify-between text-xs font-bold">
        <div class="flex items-center gap-1">
          <div id="step9Indicator1" class="w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="step9Indicator1Label" class="text-gray-500 transition-colors">Start</span>
        </div>
        <div class="flex items-center gap-1">
          <div id="step9Indicator2" class="w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="step9Indicator2Label" class="text-gray-500 transition-colors">200</span>
        </div>
        <div class="flex items-center gap-1">
          <div id="step9Indicator3" class="w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="step9Indicator3Label" class="text-gray-500 transition-colors">Full</span>
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

/* Pulse animation pour le compteur */
@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

.pulse-animation {
  animation: pulse 1s ease-in-out infinite;
}

/* ============================================
   📝 TEXTAREA
   ============================================ */

#step9 textarea {
  font-feature-settings: 'kern' 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

#step9 textarea:focus {
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  #step9 *,
  #step9 *::before,
  #step9 *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step9 textarea {
    border: 3px solid currentColor;
  }
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

#step9 .animate-blob {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

#step9 textarea,
#step9 #step9ProgressBar {
  contain: layout style paint;
}
</style>

<!-- ============================================
     JAVASCRIPT OPTIMISÉ
     ============================================ -->
<script>
(function() {
  'use strict';

  // ============================================
  // 🎯 STATE MANAGEMENT
  // ============================================
  
  const state = {
    description: '',
    length: 0,
    isValid: false,
    updateTimeout: null
  };

  // ============================================
  // 💾 CACHE DOM
  // ============================================
  
  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step9'),
        textarea: document.getElementById('step9Description'),
        counter: document.getElementById('step9Counter'),
        charCount: document.getElementById('step9CharCount'),
        progressBar: document.getElementById('step9ProgressBar'),
        indicator1: document.getElementById('step9Indicator1'),
        indicator2: document.getElementById('step9Indicator2'),
        indicator3: document.getElementById('step9Indicator3'),
        indicator1Label: document.getElementById('step9Indicator1Label'),
        indicator2Label: document.getElementById('step9Indicator2Label'),
        indicator3Label: document.getElementById('step9Indicator3Label'),
        errorAlert: document.getElementById('step9Error')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCALSTORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch (e) {
      console.warn('localStorage error:', e.message);
      return {};
    }
  }

  function saveToLocalStorage() {
    try {
      const expats = getLocalStorage();
      expats.profile_description = state.description;
      localStorage.setItem('expats', JSON.stringify(expats));
    } catch (e) {
      console.warn('localStorage save error:', e.message);
    }
  }

  // ============================================
  // 🔘 BUTTON STATE MANAGEMENT
  // ============================================
  
  function updateStep9Buttons() {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    if (state.isValid) {
      if (mobileNextBtn) mobileNextBtn.disabled = false;
      if (desktopNextBtn) desktopNextBtn.disabled = false;
    } else {
      if (mobileNextBtn) mobileNextBtn.disabled = true;
      if (desktopNextBtn) desktopNextBtn.disabled = true;
    }
  }

  // ============================================
  // ✅ VALIDATION
  // ============================================
  
  function validateDescription() {
    const elements = getCachedElements();
    
    if (!elements.textarea) {
      state.isValid = false;
      return false;
    }
    
    state.description = elements.textarea.value.trim();
    state.length = state.description.length;
    state.isValid = state.length >= 200;
    
    updateStep9Buttons();
    
    return state.isValid;
  }

  // ============================================
  // 🎨 UI UPDATE
  // ============================================
  
  function updateUI() {
    const elements = getCachedElements();
    
    // Mettre à jour les compteurs
    if (elements.counter) elements.counter.textContent = state.length;
    if (elements.charCount) elements.charCount.textContent = state.length;
    
    // Progress bar
    const progress = Math.min((state.length / 500) * 100, 100);
    if (elements.progressBar) {
      elements.progressBar.style.width = `${progress}%`;
    }
    
    // Retirer pulse si existant
    if (elements.counter) {
      elements.counter.classList.remove('pulse-animation');
    }
    
    // Couleurs dynamiques basées sur la longueur
    if (state.length < 200) {
      if (elements.counter) elements.counter.style.color = '#9ca3af';
      if (elements.progressBar) elements.progressBar.style.background = 'linear-gradient(to right, #9ca3af, #6b7280)';
    } else if (state.length >= 200 && state.length < 400) {
      if (elements.counter) elements.counter.style.color = '#10b981';
      if (elements.progressBar) elements.progressBar.style.background = 'linear-gradient(to right, #10b981, #059669)';
    } else if (state.length >= 400 && state.length < 450) {
      if (elements.counter) elements.counter.style.color = '#f59e0b';
      if (elements.progressBar) elements.progressBar.style.background = 'linear-gradient(to right, #f59e0b, #d97706)';
    } else {
      if (elements.counter) {
        elements.counter.style.color = '#ef4444';
        elements.counter.classList.add('pulse-animation');
      }
      if (elements.progressBar) elements.progressBar.style.background = 'linear-gradient(to right, #ef4444, #f43f5e)';
    }

    // Indicateur 1 (Start - 0+)
    if (state.length > 0) {
      if (elements.indicator1) {
        elements.indicator1.style.backgroundColor = '#2563eb';
        elements.indicator1.style.transform = 'scale(1.3)';
      }
      if (elements.indicator1Label) {
        elements.indicator1Label.style.color = '#2563eb';
        elements.indicator1Label.style.fontWeight = '900';
      }
    } else {
      if (elements.indicator1) {
        elements.indicator1.style.backgroundColor = '#d1d5db';
        elements.indicator1.style.transform = 'scale(1)';
      }
      if (elements.indicator1Label) {
        elements.indicator1Label.style.color = '#6b7280';
        elements.indicator1Label.style.fontWeight = '700';
      }
    }

    // Indicateur 2 (200 chars)
    if (state.length >= 200) {
      if (elements.indicator2) {
        elements.indicator2.style.backgroundColor = '#10b981';
        elements.indicator2.style.transform = 'scale(1.5)';
      }
      if (elements.indicator2Label) {
        elements.indicator2Label.style.color = '#10b981';
        elements.indicator2Label.style.fontWeight = '900';
      }
    } else {
      if (elements.indicator2) {
        elements.indicator2.style.backgroundColor = '#d1d5db';
        elements.indicator2.style.transform = 'scale(1)';
      }
      if (elements.indicator2Label) {
        elements.indicator2Label.style.color = '#6b7280';
        elements.indicator2Label.style.fontWeight = '700';
      }
    }

    // Indicateur 3 (500 - Full)
    if (state.length >= 500) {
      if (elements.indicator3) {
        elements.indicator3.style.backgroundColor = '#ef4444';
        elements.indicator3.style.transform = 'scale(1.3)';
      }
      if (elements.indicator3Label) {
        elements.indicator3Label.style.color = '#ef4444';
        elements.indicator3Label.style.fontWeight = '900';
      }
    } else {
      if (elements.indicator3) {
        elements.indicator3.style.backgroundColor = '#d1d5db';
        elements.indicator3.style.transform = 'scale(1)';
      }
      if (elements.indicator3Label) {
        elements.indicator3Label.style.color = '#6b7280';
        elements.indicator3Label.style.fontWeight = '700';
      }
    }

    // Cacher l'erreur si visible
    if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
      elements.errorAlert.classList.add('hidden');
    }
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
  
  function handleInput(e) {
    const textarea = e.target;
    if (!textarea || textarea.id !== 'step9Description') return;
    
    // Debouncing pour l'UI update
    if (state.updateTimeout) {
      clearTimeout(state.updateTimeout);
    }
    
    state.updateTimeout = setTimeout(() => {
      // Utiliser requestAnimationFrame pour smooth UI
      requestAnimationFrame(() => {
        validateDescription();
        updateUI();
        saveToLocalStorage();
      });
    }, 100);
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
    
    // Restaurer la description depuis localStorage
    if (elements.textarea && expats.profile_description) {
      elements.textarea.value = expats.profile_description;
      state.description = expats.profile_description;
    }
    
    // Valider et mettre à jour l'UI
    requestAnimationFrame(() => {
      validateDescription();
      updateUI();
    });
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  // Fonction publique pour validation externe
  window.validateStep9 = function() {
    const isValid = validateDescription();
    if (!isValid) {
      showError();
    }
    return isValid;
  };

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
              updateStep9Buttons();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restaurer l'état initial
    restoreState();
    updateStep9Buttons();
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>