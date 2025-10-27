<!-- 
============================================
🚀 STEP 7 - SPECIAL STATUS (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Multi-sélection de statuses spéciaux
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
============================================
-->

<div id="step7" class="hidden flex flex-col h-full" role="region" aria-label="Select your special status">
  
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
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Special Status? ⭐
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select any special status you have (optional)
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step7SelectedCount">0</span> status(es) selected
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs font-bold text-blue-900">Stand out from the crowd</p>
          <p class="text-xs text-blue-700 mt-0.5">Choose statuses that apply to you to attract more opportunities</p>
        </div>
      </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3" role="group" aria-label="Select special statuses">
      
      @php
        $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
      @endphp
      @foreach ($statuses as $label)
      <button 
        type="button"
        class="status-card"
        data-status="{{ $label }}"
        role="checkbox"
        aria-checked="false"
        aria-label="Select {{ $label }}">
        <div class="flex items-center gap-3 flex-1">
          <div class="status-icon w-12 h-12 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <span class="text-2xl">⭐</span>
          </div>
          <div class="text-left flex-1">
            <div class="status-name text-sm font-bold text-gray-900">{{ $label }}</div>
            <div class="status-subtitle text-xs text-gray-600 mt-0.5">Special recognition</div>
          </div>
        </div>
        <span class="status-check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>
      @endforeach

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

/* Float animation pour les icônes sélectionnées */
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

/* ============================================
   ⭐ STATUS CARDS
   ============================================ */

#step7 .status-card {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  background: white;
  border: 2px solid #3b82f6;
  border-radius: 0.875rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  text-align: left;
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
  content-visibility: auto;
  contain-intrinsic-size: 0 80px;
}

#step7 .status-card:hover {
  border-color: #2563eb;
  background: #eff6ff;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(59, 130, 246, 0.15);
}

#step7 .status-card.selected {
  background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
  border-color: #0ea5e9;
  box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35);
}

#step7 .status-card.selected .status-name,
#step7 .status-card.selected .status-subtitle {
  color: white;
}

#step7 .status-card.selected .status-icon {
  background: rgba(255, 255, 255, 0.2);
  animation: float 2s ease-in-out infinite;
}

/* Status check indicator */
#step7 .status-check-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 1.5rem;
  height: 1.5rem;
  border-radius: 50%;
  background: rgba(59, 130, 246, 0.1);
  opacity: 0;
  transform: scale(0.8) translateZ(0);
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  backface-visibility: hidden;
  will-change: transform, opacity;
}

#step7 .status-card.selected .status-check-indicator {
  opacity: 1;
  transform: scale(1) translateZ(0);
  background: rgba(255, 255, 255, 0.2);
}

#step7 .status-check-indicator svg {
  color: #2563eb;
}

#step7 .status-card.selected .status-check-indicator svg {
  color: white;
}

/* Status name et subtitle */
#step7 .status-name {
  font-feature-settings: 'kern' 1, 'liga' 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

#step7 .status-subtitle {
  font-feature-settings: 'kern' 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

#step7 .status-card:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  border-color: #2563eb;
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
  #step7 .status-card {
    border: 3px solid currentColor;
  }
  
  #step7 .status-card.selected {
    border: 3px solid #1d4ed8;
  }
}

/* ============================================
   ⚡ OPTIMISATIONS PERFORMANCE
   ============================================ */

#step7 .status-card,
#step7 .status-check-indicator,
#step7 .status-icon {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

#step7 .status-card {
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
  // 🔧 STATE MANAGEMENT
  // ============================================
  
  const state = {
    selectedStatuses: []
  };

  let cachedElements = null;

  // ============================================
  // 📦 CACHE DOM ELEMENTS
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step7'),
        cards: document.querySelectorAll('#step7 .status-card'),
        selectedCount: document.getElementById('step7SelectedCount')
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
    try {
      const expats = getLocalStorage();
      expats.special_statuses = state.selectedStatuses;
      localStorage.setItem('expats', JSON.stringify(expats));
    } catch (e) {
      console.warn('localStorage write error:', e.message);
    }
  }

  // ============================================
  // 🔘 UPDATE BUTTONS
  // ============================================
  
  function updateStep7Buttons() {
    // Step 7 est optionnel, donc les boutons sont toujours activés
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    if (mobileNextBtn) mobileNextBtn.disabled = false;
    if (desktopNextBtn) desktopNextBtn.disabled = false;
  }

  // ============================================
  // 🔄 TOGGLE SELECTION
  // ============================================
  
  function toggleStatusSelection(status) {
    const elements = getCachedElements();
    const index = state.selectedStatuses.indexOf(status);
    const card = Array.from(elements.cards).find(c => c.getAttribute('data-status') === status);
    
    if (index > -1) {
      // Désélectionner
      state.selectedStatuses.splice(index, 1);
      if (card) {
        card.classList.remove('selected');
        card.setAttribute('aria-checked', 'false');
      }
    } else {
      // Sélectionner
      state.selectedStatuses.push(status);
      if (card) {
        card.classList.add('selected');
        card.setAttribute('aria-checked', 'true');
      }
    }
    
    // Mettre à jour le compteur
    requestAnimationFrame(() => {
      if (elements.selectedCount) {
        elements.selectedCount.textContent = state.selectedStatuses.length;
      }
    });
    
    // Sauvegarder
    saveToLocalStorage();
    
    // Mettre à jour les boutons
    updateStep7Buttons();
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleCardClick(e) {
    const card = e.target.closest('.status-card');
    if (card) {
      const status = card.getAttribute('data-status');
      toggleStatusSelection(status);
    }
  }

  function handleKeyDown(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      const card = e.target.closest('.status-card');
      if (card) {
        e.preventDefault();
        const status = card.getAttribute('data-status');
        toggleStatusSelection(status);
      }
    }
  }

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const elements = getCachedElements();
    
    // Event delegation pour les cartes
    if (elements.step) {
      elements.step.addEventListener('click', handleCardClick, { passive: true });
      elements.step.addEventListener('keydown', handleKeyDown);
    }
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const expats = getLocalStorage();
    
    // Restaurer les statuses depuis localStorage
    if (expats.special_statuses && Array.isArray(expats.special_statuses)) {
      state.selectedStatuses = expats.special_statuses;
      
      requestAnimationFrame(() => {
        // Restaurer les états des cartes
        state.selectedStatuses.forEach(status => {
          const card = Array.from(elements.cards).find(c => c.getAttribute('data-status') === status);
          if (card) {
            card.classList.add('selected');
            card.setAttribute('aria-checked', 'true');
          }
        });
        
        // Mettre à jour le compteur
        if (elements.selectedCount) {
          elements.selectedCount.textContent = state.selectedStatuses.length;
        }
        
        // Mettre à jour les boutons
        updateStep7Buttons();
      });
    } else {
      // Aucune sélection sauvegardée → activer les boutons quand même (step optionnel)
      updateStep7Buttons();
    }
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  // Fonction publique pour validation externe (optionnel, toujours valide)
  window.validateStep7 = function() {
    return true;
  };

  // Exposer la fonction globalement pour compatibilité
  window.toggleStatusSelection = toggleStatusSelection;
  window.selectedStatuses = state.selectedStatuses;

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
              updateStep7Buttons();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restaurer l'état initial
    restoreState();
    
    // Activer les boutons (step optionnel)
    updateStep7Buttons();
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>