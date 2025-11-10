<!-- 
============================================
🚀 STEP 7 - SPECIAL STATUS (SIMPLE ORDERED EMOJIS)
============================================
✨ Blue/Cyan/Teal Design System STRICT
🎨 Multi-selection of special statuses
⚡ Fixed header structure + scrollable content
🔧 Integrated with wizard-steps.js
✅ localStorage persistence
🎯 Emojis applied by order (super simple!)
⚡ Maximum performance
============================================
-->

<div id="step7" class="hidden flex flex-col h-full" role="region" aria-label="Select your special status">
  
  <!-- ============================================
       FIXED HEADER (STICKY)
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
       SCROLLABLE CONTENT
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-2 border-purple-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs font-bold text-purple-900">Stand out from the crowd</p>
          <p class="text-xs text-purple-700 mt-0.5">Choose the statuses that match you to attract more opportunities</p>
        </div>
      </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-2.5" role="group" aria-label="Select special statuses">
      
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
        <div class="status-icon-container">
          <span class="status-icon">⭐</span>
        </div>
        <span class="status-name">{{ $label }}</span>
      </button>
      @endforeach

    </div>

  </div>

</div>

<!-- ============================================
     OPTIMIZED STYLES
     ============================================ -->
<style>
/* ============================================
   🎨 BASE STYLES
   ============================================ */

/* Blob animations - GPU optimized */
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

/* ============================================
   ⭐ STATUS CARDS - HORIZONTAL DESIGN
   ============================================ */

#step7 .status-card {
  position: relative;
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 0.75rem;
  padding: 0.625rem 1rem;
  background: #ffffff;
  border: 2px solid #e5e7eb;
  border-radius: 0.75rem;
  cursor: pointer;
  transition: all 0.2s ease;
  min-height: auto;
  height: 3.5rem;
  text-align: left;
}

#step7 .status-card:hover {
  border-color: #60a5fa;
  background: #f8fafc;
}

#step7 .status-card.selected {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#step7 .status-card.selected:hover {
  background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
  border-color: #1d4ed8;
}

#step7 .status-icon-container {
  width: 2.25rem;
  height: 2.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
  flex-shrink: 0;
  transition: all 0.2s ease;
}

#step7 .status-card.selected .status-icon-container {
  background: rgba(255, 255, 255, 0.2);
}

#step7 .status-icon {
  font-size: 1.25rem;
  line-height: 1;
}

#step7 .status-name {
  flex: 1;
  font-size: 0.9375rem;
  font-weight: 600;
  color: #1f2937;
  transition: color 0.2s;
}

#step7 .status-card.selected .status-name {
  color: #ffffff;
  font-weight: 700;
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
   📱 RESPONSIVE
   ============================================ */

@media (max-width: 639px) {
  #step7 .status-card {
    padding: 0.5rem 0.75rem;
    height: 3rem;
    gap: 0.625rem;
  }
  
  #step7 .status-icon-container {
    width: 2rem;
    height: 2rem;
  }
  
  #step7 .status-icon {
    font-size: 1.125rem;
  }
  
  #step7 .status-name {
    font-size: 0.875rem;
  }
}

@media (min-width: 640px) and (max-width: 1023px) {
  #step7 .status-card {
    padding: 0.625rem 0.875rem;
  }
}

@media (min-width: 1024px) {
  #step7 .status-card {
    padding: 0.75rem 1rem;
  }
  
  #step7 .status-name {
    font-size: 0.9375rem;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

#step7 .status-card {
  contain: layout style paint;
}
</style>

<!-- ============================================
     JAVASCRIPT - SIMPLE ORDERED EMOJI ARRAY
     ============================================ -->
<script>
(function() {
  'use strict';

  // ============================================
  // 🎯 ORDERED EMOJI ARRAY
  // ============================================
  // Simply change the emojis in the order of your statuses!
  // Index 0 corresponds to the 1st status, index 1 to the 2nd, etc.
  
  const ORDERED_EMOJIS = [
    '🌍',  // 0 - Expats for 2 to 5 years
    '✈️',  // 1 - Expats for 6 to 10 years
    '🏠',  // 2 - Expats for more than 10 years
    '⚖️',  // 3 - Legal advice
    '🛡️',  // 4 - Insurance
    '🏢',  // 5 - Real estate agent
    '📝',  // 6 - Translator
    '🗺️',  // 7 - Guide
    '📚',  // 8 - Language teacher
    // Add more emojis if you have more statuses...
    '💼',  // 9
    '👨‍⚕️',  // 10
    '🔧',  // 11
    '🎨',  // 12
    '💻',  // 13
    '🚗',  // 14
    '🏋️',  // 15
    '🎓',  // 16
    '💡',  // 17
    '📊',  // 18
    '🎯',  // 19
  ];

  const DEFAULT_EMOJI = '⭐';

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
  // 🎨 APPLY EMOJIS BY ORDER/INDEX
  // ============================================
  
  function applyEmojisToCards() {
    const elements = getCachedElements();
    
    elements.cards.forEach((card, index) => {
      const iconElement = card.querySelector('.status-icon');
      
      if (iconElement) {
        // Use the emoji at the corresponding index, or the default
        const emoji = ORDERED_EMOJIS[index] || DEFAULT_EMOJI;
        iconElement.textContent = emoji;
      }
    });
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
      const data = getLocalStorage();
      data.special_statuses = state.selectedStatuses;
      localStorage.setItem('expats', JSON.stringify(data));
    } catch (e) {
      console.warn('localStorage write error:', e.message);
    }
  }

  // ============================================
  // 🔄 TOGGLE SELECTION
  // ============================================
  
  function toggleStatusSelection(status) {
    const elements = getCachedElements();
    const index = state.selectedStatuses.indexOf(status);
    const card = Array.from(elements.cards).find(c => c.getAttribute('data-status') === status);
    
    if (index > -1) {
      // Deselect
      state.selectedStatuses.splice(index, 1);
      if (card) {
        card.classList.remove('selected');
        card.setAttribute('aria-checked', 'false');
      }
    } else {
      // Select
      state.selectedStatuses.push(status);
      if (card) {
        card.classList.add('selected');
        card.setAttribute('aria-checked', 'true');
      }
    }
    
    // Update counter
    requestAnimationFrame(() => {
      if (elements.selectedCount) {
        elements.selectedCount.textContent = state.selectedStatuses.length;
      }
    });
    
    // Save
    saveToLocalStorage();
    
    // ✅ Notify wizard-steps.js
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
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
    
    // Event delegation for cards
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
    const data = getLocalStorage();
    
    // Restore statuses from localStorage
    if (data.special_statuses && Array.isArray(data.special_statuses)) {
      state.selectedStatuses = data.special_statuses;
      
      requestAnimationFrame(() => {
        // Restore card states
        state.selectedStatuses.forEach(status => {
          const card = Array.from(elements.cards).find(c => c.getAttribute('data-status') === status);
          if (card) {
            card.classList.add('selected');
            card.setAttribute('aria-checked', 'true');
          }
        });
        
        // Update counter
        if (elements.selectedCount) {
          elements.selectedCount.textContent = state.selectedStatuses.length;
        }
        
        // ✅ Notify wizard-steps.js
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      });
    }
  }

  // ============================================
  // 🎬 VALIDATION (OPTIONAL STEP)
  // ============================================
  
  // ✅ Step 7 is optional → always valid
  window.validateStep7 = function() {
    return true;
  };

  // Expose functions globally for compatibility
  window.toggleStatusSelection = toggleStatusSelection;
  window.selectedStatuses = state.selectedStatuses;

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    // ✨ Apply emojis based on order/index
    applyEmojisToCards();
    
    // Init event delegation
    initEventDelegation();

    // Observer to detect when step becomes visible
    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              // Step is visible, restore state
              restoreState();
              
              // ✅ Notify wizard-steps.js
              if (typeof window.updateNavigationButtons === 'function') {
                window.updateNavigationButtons();
              }
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restore initial state
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