<div id="step7" class="hidden">
  <style>
    /* Détection mobile pour désactiver animations coûteuses */
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    /* Animations optimisées GPU - uniquement transform et opacity */
    @keyframes badge-pop {
      0% { 
        transform: scale(0.95); 
        opacity: 0; 
      }
      100% { 
        transform: scale(1); 
        opacity: 1; 
      }
    }
    
    @keyframes float {
      0%, 100% { 
        transform: translateY(0) translateZ(0); 
      }
      50% { 
        transform: translateY(-5px) translateZ(0); 
      }
    }
    
    /* Shimmer simplifié - désactivé sur mobile */
    @media (min-width: 768px) {
      @keyframes shimmer {
        0% { 
          transform: translateX(-100%) translateZ(0); 
        }
        100% { 
          transform: translateX(100%) translateZ(0); 
        }
      }
    }
    
    /* Gradient header - simplifié */
    @keyframes gradient {
      0%, 100% { 
        background-position: 0% 50%; 
      }
      50% { 
        background-position: 100% 50%; 
      }
    }
    
    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
    }
    
    /* Status Card - optimisé avec GPU acceleration */
    .status-card {
      position: relative;
      overflow: hidden;
      transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1),
                  box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1),
                  border-color 0.2s ease;
      cursor: pointer;
      will-change: transform;
      contain: layout style paint;
    }
    
    /* Shimmer effect - uniquement desktop */
    @media (min-width: 768px) {
      .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.08), transparent);
        transform: translateX(-100%) translateZ(0);
        will-change: transform;
      }
      
      .status-card:hover::before {
        animation: shimmer 0.6s ease-out;
      }
    }
    
    .status-card:hover {
      transform: translateY(-3px) translateZ(0);
      box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
    }
    
    .status-card.selected {
      background: linear-gradient(135deg, #2563eb, #0891b2);
      border-color: #1d4ed8;
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }
    
    .status-card.selected .status-name {
      color: white;
    }
    
    .status-card.selected .status-subtitle {
      color: rgba(255, 255, 255, 0.9);
    }
    
    /* Float animation - uniquement desktop */
    @media (min-width: 768px) {
      .status-card.selected .status-icon {
        background: rgba(255, 255, 255, 0.25);
        animation: float 2.5s ease-in-out infinite;
        will-change: transform;
      }
    }
    
    .status-card.selected .status-check-indicator {
      background: white;
      border-color: white;
    }
    
    .status-card.selected .status-check-indicator svg {
      opacity: 1 !important;
      color: #2563eb;
    }
    
    .status-badge {
      animation: badge-pop 0.25s ease-out;
      will-change: transform, opacity;
    }
    
    /* Info banner - shimmer désactivé mobile */
    .info-banner {
      background: linear-gradient(135deg, #eff6ff 0%, #ecfeff 100%);
      position: relative;
      overflow: hidden;
    }
    
    @media (min-width: 768px) {
      .info-banner::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.04), transparent);
        animation: shimmer 4s ease-in-out infinite;
        will-change: transform;
      }
    }
    
    .border-3 {
      border-width: 3px;
    }
    
    /* Scrollbar optimisé */
    .status-scroll {
      scrollbar-width: thin;
      scrollbar-color: #3b82f6 #f1f5f9;
    }
    
    .status-scroll::-webkit-scrollbar {
      width: 6px;
    }
    
    .status-scroll::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 10px;
    }
    
    .status-scroll::-webkit-scrollbar-thumb {
      background: #3b82f6;
      border-radius: 10px;
    }
    
    .status-scroll::-webkit-scrollbar-thumb:hover {
      background: #2563eb;
    }
    
    /* Blobs - désactivés sur mobile pour économiser CPU */
    @media (min-width: 768px) {
      .ambient-blob {
        mix-blend-mode: multiply;
        filter: blur(40px);
        opacity: 0.15;
      }
    }
    
    /* Désactiver blur sur mobile (très coûteux) */
    @media (max-width: 767px) {
      .ambient-blob {
        display: none;
      }
    }
    
    /* Optimisation conteneur badges */
    .badges-container {
      contain: layout style paint;
    }
    
    /* Optimisation check indicator */
    .status-check-indicator {
      will-change: background, border-color;
    }
    
    .status-check-indicator svg {
      transition: opacity 0.2s ease;
    }
    
    /* Réduire transitions sur mobile */
    @media (max-width: 767px) {
      .status-card {
        transition: transform 0.15s ease, border-color 0.15s ease;
      }
      
      .status-card:hover {
        transform: translateY(-2px) translateZ(0);
      }
    }
  </style>

  <!-- Ambient Blobs - uniquement desktop -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 hidden md:block">
    <div class="ambient-blob absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full"></div>
    <div class="ambient-blob absolute top-20 right-10 w-64 h-64 bg-cyan-300 rounded-full"></div>
    <div class="ambient-blob absolute bottom-10 left-1/2 w-64 h-64 bg-teal-300 rounded-full"></div>
  </div>

  <!-- Header avec gradient animé -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">⭐</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Do you have a special status?
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold mb-2">
      Stand out from the crowd
    </p>
    <p class="text-sm text-gray-500">
      Optional • Boost your profile visibility
    </p>
  </div>

  <!-- Info Banner Premium -->
  <div class="info-banner mb-8 rounded-2xl border-2 border-blue-200 p-5 shadow-lg">
    <div class="flex items-center justify-center gap-4 relative z-10">
      <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-2xl">💡</span>
      </div>
      <div class="flex-1">
        <p class="text-blue-900 font-bold text-base mb-1">Pro Tip</p>
        <p class="text-blue-700 text-sm font-medium">Not mandatory but helps you stand out and get more visibility!</p>
      </div>
    </div>
  </div>

  <!-- Zone badges sélectionnés -->
  <div id="selectedBadgesContainer" class="mb-8 hidden">
    <div class="badges-container bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-5 border-2 border-blue-300 shadow-lg">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md">
            <span class="text-xl">✨</span>
          </div>
          <div>
            <h3 class="text-base font-black text-blue-900">Your Special Status</h3>
            <p class="text-xs text-blue-600 font-semibold">
              <span id="badgeCounter">0</span> selected
            </p>
          </div>
        </div>
        <button id="clearAllStatus" class="text-red-500 hover:text-red-700 text-sm font-bold hover:underline transition-colors px-3 py-1.5 rounded-lg hover:bg-red-50">
          Clear All
        </button>
      </div>
      <div id="selectedBadges" class="flex flex-wrap gap-3"></div>
    </div>
  </div>

  <!-- Liste des statuts -->
  <div class="space-y-4 mb-8 max-h-[420px] overflow-y-auto status-scroll p-2 pr-3">
    @php
      $statuses = \App\Models\SpecialStatus::all();
    @endphp

    @foreach ($statuses as $status)
    <div class="status-card group bg-white border-2 border-blue-400 rounded-2xl p-4 shadow-md hover:shadow-xl" data-status="{{ $status->stitle ?? $status->title ?? '' }}">
      <input type="checkbox" class="status-checkbox absolute opacity-0 pointer-events-none" data-label="{{ $status->stitle ?? $status->title ?? '' }}">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4 flex-1">
          <div class="status-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center flex-shrink-0 transition-transform shadow-sm">
            <span class="text-3xl">⭐</span>
          </div>
          <div class="flex-1 min-w-0">
            <span class="status-name font-bold text-gray-800 text-base leading-tight block transition-colors">{{ $status->stitle ?? $status->title ?? '' }}</span>
            <span class="status-subtitle text-xs text-gray-500 font-medium mt-1 block transition-colors">{{ $status->ssubtitle ?? $status->subtitle ?? 'Verified status' }}</span>
          </div>
        </div>
        <div class="status-check-indicator w-8 h-8 rounded-full border-3 border-blue-400 flex items-center justify-center transition-all flex-shrink-0">
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container flex items-center justify-between gap-4 mt-8">
    <button id="backToStep6" type="button" class="nav-btn-back flex-1 sm:flex-none bg-white text-blue-600 border-2 border-gray-200 hover:border-blue-400 px-8 py-3 rounded-xl font-bold text-base transition-colors hover:shadow-lg">
      Back
    </button>
    <button id="nextStep7" type="button" class="nav-btn-next flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-bold text-base shadow-lg hover:shadow-xl transition-all hover:scale-105">
      Continue
    </button>
  </div>

  <script>
    (function() {
      'use strict';
      
      // Détection mobile pour optimisations
      const isMobile = window.innerWidth < 768;
      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      
      // Cache DOM elements
      let cards, badgesContainer, badgesArea, badgeCounter, clearAllBtn;
      
      // Debounce pour optimiser les updates
      function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
          const later = () => {
            clearTimeout(timeout);
            func(...args);
          };
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
        };
      }
      
      // RAF pour animations smooth
      function rafThrottle(callback) {
        let requestId = null;
        let lastArgs;
        
        const later = (context) => () => {
          requestId = null;
          callback.apply(context, lastArgs);
        };
        
        return function(...args) {
          lastArgs = args;
          if (requestId === null) {
            requestId = requestAnimationFrame(later(this));
          }
        };
      }
      
      // Init au DOMContentLoaded
      function init() {
        // Cache tous les éléments
        cards = document.querySelectorAll('.status-card');
        badgesContainer = document.getElementById('selectedBadgesContainer');
        badgesArea = document.getElementById('selectedBadges');
        badgeCounter = document.getElementById('badgeCounter');
        clearAllBtn = document.getElementById('clearAllStatus');
        
        if (!cards.length) return;
        
        // Setup event listeners avec passive
        setupEventListeners();
        
        // Restore state
        restoreFromStorage();
      }
      
      // Créer un badge (optimisé)
      function createBadge(statusName) {
        const badge = document.createElement('div');
        badge.className = 'status-badge inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-cyan-700 text-white pl-4 pr-3 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all hover:scale-105';
        
        // Utiliser textContent pour performance
        const statusSpan = document.createElement('span');
        statusSpan.textContent = statusName;
        
        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-center gap-2';
        wrapper.innerHTML = '<span class="text-lg">⭐</span>';
        wrapper.appendChild(statusSpan);
        
        const removeBtn = document.createElement('button');
        removeBtn.className = 'remove-badge hover:bg-white hover:text-blue-600 rounded-lg p-1.5 transition-colors';
        removeBtn.setAttribute('data-status', statusName);
        removeBtn.setAttribute('aria-label', 'Remove ' + statusName);
        removeBtn.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>';
        
        badge.appendChild(wrapper);
        badge.appendChild(removeBtn);
        
        return badge;
      }
      
      // Update selection (optimisé avec RAF)
      const updateSelection = rafThrottle(function() {
        const selected = document.querySelectorAll('.status-checkbox:checked');
        
        // Clear badges area efficacement
        while (badgesArea.firstChild) {
          badgesArea.removeChild(badgesArea.firstChild);
        }
        
        if (selected.length > 0) {
          badgesContainer.classList.remove('hidden');
          badgeCounter.textContent = selected.length;
          
          // DocumentFragment pour batch DOM updates
          const fragment = document.createDocumentFragment();
          selected.forEach(checkbox => {
            const badge = createBadge(checkbox.dataset.label);
            fragment.appendChild(badge);
          });
          badgesArea.appendChild(fragment);
          
          // Setup remove listeners
          badgesArea.querySelectorAll('.remove-badge').forEach(btn => {
            btn.addEventListener('click', handleRemoveBadge, { passive: false });
          });
        } else {
          badgesContainer.classList.add('hidden');
        }
        
        // Save to localStorage (debounced)
        saveToStorage(selected);
      });
      
      // Save avec debounce
      const saveToStorage = debounce(function(selected) {
        try {
          const selectedStatuses = Array.from(selected).map(cb => cb.dataset.label);
          localStorage.setItem('specialStatuses', JSON.stringify(selectedStatuses));
        } catch (e) {
          console.warn('localStorage not available:', e);
        }
      }, 300);
      
      // Handle card click
      function handleCardClick(e) {
        // Éviter double-trigger si click sur checkbox
        if (e.target.classList.contains('status-checkbox')) return;
        
        const card = this;
        const checkbox = card.querySelector('.status-checkbox');
        
        checkbox.checked = !checkbox.checked;
        
        // Toggle class sans reflow
        requestAnimationFrame(() => {
          if (checkbox.checked) {
            card.classList.add('selected');
          } else {
            card.classList.remove('selected');
          }
          
          updateSelection();
        });
      }
      
      // Handle remove badge
      function handleRemoveBadge(e) {
        e.stopPropagation();
        const status = this.dataset.status;
        const card = document.querySelector(`.status-card[data-status="${status}"]`);
        
        if (card) {
          const checkbox = card.querySelector('.status-checkbox');
          checkbox.checked = false;
          card.classList.remove('selected');
          updateSelection();
        }
      }
      
      // Clear all
      function handleClearAll(e) {
        e.stopPropagation();
        
        requestAnimationFrame(() => {
          document.querySelectorAll('.status-checkbox:checked').forEach(cb => {
            cb.checked = false;
          });
          cards.forEach(card => {
            card.classList.remove('selected');
          });
          updateSelection();
        });
      }
      
      // Setup listeners avec passive events
      function setupEventListeners() {
        cards.forEach(card => {
          card.addEventListener('click', handleCardClick, { passive: true });
        });
        
        if (clearAllBtn) {
          clearAllBtn.addEventListener('click', handleClearAll, { passive: false });
        }
      }
      
      // Restore from localStorage
      function restoreFromStorage() {
        try {
          const saved = localStorage.getItem('specialStatuses');
          if (!saved) return;
          
          const selectedStatuses = JSON.parse(saved);
          if (!Array.isArray(selectedStatuses)) return;
          
          requestAnimationFrame(() => {
            cards.forEach(card => {
              const checkbox = card.querySelector('.status-checkbox');
              if (selectedStatuses.includes(checkbox.dataset.label)) {
                checkbox.checked = true;
                card.classList.add('selected');
              }
            });
            updateSelection();
          });
        } catch (e) {
          console.warn('Error restoring statuses:', e);
        }
      }
      
      // Init
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
      } else {
        init();
      }
    })();
  </script>
</div>