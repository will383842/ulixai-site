@php
$popupConfig = [
    'main' => [
        'title' => 'What Type of Help Do You Need? 🎯',
        'subtitle' => 'Choose the main category that fits your situation',
        'badge_color' => 'orange'
    ],
    'sub' => [
        'title' => 'Which Subcategory Fits Best? 🎨',
        'subtitle' => 'Help us understand your needs better',
        'badge_color' => 'orange'
    ],
    'child' => [
        'title' => 'What Exactly Do You Need? 🔍',
        'subtitle' => 'Pick the most specific option that matches your request',
        'badge_color' => 'orange'
    ]
];
@endphp

{{-- ═══════════════════════════════════════════════════════════
     ✅ Fonctions de navigation back - Nécessaires pour les boutons "Back"
     Note: Les autres fonctions (openHelpPopup, handleCategoryClick, etc.) 
     sont gérées par category-popups.js
     ═══════════════════════════════════════════════════════════ --}}

<script>
(function() {
  'use strict';
  
  // ✅ VÉRIFIER QUE LES FONCTIONS NE SONT PAS DÉJÀ DÉFINIES
  if (window.categoryPopupsLoaded) {
    console.log('⚠️ Category popups already loaded, skipping...');
    return;
  }
  
  window.categoryPopupsLoaded = true;
  console.log('🚀 Loading category popups...');
  
  /**
   * Retour aux catégories principales depuis les sous-catégories
   */
  window.goBackToMainCategories = function() {
    console.log('🔙 Going back to main categories');
    
    const subPopup = document.getElementById('expatriesPopup');
    const mainPopup = document.getElementById('searchPopup');
    
    if (subPopup) {
      subPopup.classList.add('hidden');
      subPopup.setAttribute('aria-hidden', 'true');
    }
    if (mainPopup) {
      mainPopup.classList.remove('hidden');
      mainPopup.setAttribute('aria-hidden', 'false');
    }
  };

  /**
   * Retour aux sous-catégories depuis les catégories enfants
   */
  window.goBackToSubcategories = function() {
    console.log('🔙 Going back to subcategories');
    
    const childPopup = document.getElementById('vacanciersAutresBesoinsPopup');
    const subPopup = document.getElementById('expatriesPopup');
    
    if (childPopup) {
      childPopup.classList.add('hidden');
      childPopup.setAttribute('aria-hidden', 'true');
    }
    if (subPopup) {
      subPopup.classList.remove('hidden');
      subPopup.setAttribute('aria-hidden', 'false');
    }
  };

  /**
   * Alias pour compatibilité
   */
  window.goBackToVacanciersSubcategories = window.goBackToSubcategories;

  /**
   * Fermer tous les popups de catégories
   */
  window.closeAllPopups = function() {
    console.log('❌ Closing all category popups');
    
    ['searchPopup', 'expatriesPopup', 'vacanciersAutresBesoinsPopup'].forEach(id => {
      const popup = document.getElementById(id);
      if (popup) {
        popup.classList.add('hidden');
        popup.setAttribute('aria-hidden', 'true');
      }
    });
    
    // Clear localStorage
    localStorage.removeItem('create-request');
    
    // ✅ Restaurer le scroll du body
    document.body.style.overflow = '';
  };

  /**
   * Fermer uniquement le popup principal
   */
  window.closeSearchPopup = function() {
    console.log('❌ Closing search popup');
    
    const popup = document.getElementById('searchPopup');
    if (popup) {
      popup.classList.add('hidden');
      popup.setAttribute('aria-hidden', 'true');
    }
    
    // ✅ Restaurer le scroll du body
    document.body.style.overflow = '';
  };

  console.log('✅ Popup navigation functions loaded');
})();
</script>

<!-- Main Search Popup -->
<div id="searchPopup" 
     class="hidden fixed inset-0 z-[9998] bg-black/60 backdrop-blur-sm flex justify-center items-end sm:items-center p-0 sm:p-4"
     role="dialog"
     aria-modal="true"
     aria-labelledby="main-popup-title"
     aria-hidden="true"
     data-popup-level="main"
     data-container-class="main-categories"
     style="pointer-events: auto;">
  <div class="bg-white w-full sm:max-w-2xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform"
       onclick="event.stopPropagation();">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]" aria-hidden="true">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex-1 min-w-0 mr-4">
        <h2 id="main-popup-title" class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight">
          {{ $popupConfig['main']['title'] }}
        </h2>
        <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug">
          {{ $popupConfig['main']['subtitle'] }}
        </p>
      </div>
      <div class="flex items-center gap-2 sm:gap-3">
        <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-xs font-semibold rounded-full shadow-lg shadow-orange-500/30" aria-label="Service Request Badge">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Service Request
        </span>
        <button type="button" onclick="closeAllPopups(); return false;" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl hover:bg-gray-100 active:bg-gray-200 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" aria-label="Close popup">
          <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </button>
      </div>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6" role="list">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 main-categories auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden" aria-hidden="true"></div>
    </div>
  </div>
</div>

<!-- Subcategories Popup -->
<div id="expatriesPopup" 
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9998] flex items-end sm:items-center justify-center p-0 sm:p-4"
     role="dialog"
     aria-modal="true"
     aria-labelledby="sub-popup-title"
     aria-hidden="true"
     data-popup-level="sub"
     data-container-class="sub-category"
     style="pointer-events: auto;">
  <div class="bg-white w-full sm:max-w-4xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform"
       onclick="event.stopPropagation();">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]" aria-hidden="true">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex items-center min-w-0 flex-1 gap-3 sm:gap-4 mr-3">
        <button 
          type="button"
          onclick="goBackToMainCategories(); return false;" 
          class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" 
          aria-label="Go back to main categories">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <div class="min-w-0 flex-1">
          <h2 id="sub-popup-title" class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight truncate">
            {{ $popupConfig['sub']['title'] }}
          </h2>
          <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug truncate">
            {{ $popupConfig['sub']['subtitle'] }}
          </p>
        </div>
      </div>
      <div class="flex items-center gap-2 sm:gap-3">
        <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-xs font-semibold rounded-full shadow-lg shadow-orange-500/30" aria-label="Service Request Badge">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Service Request
        </span>
        <button type="button" onclick="closeAllPopups(); return false;" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl hover:bg-gray-100 active:bg-gray-200 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" aria-label="Close popup">
          <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6" role="list">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 sub-category auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden" aria-hidden="true"></div>
    </div>
  </div>
</div>

<!-- Expat & Traveler - Specific Needs Popup -->
<div id="vacanciersAutresBesoinsPopup" 
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[9998] flex items-end sm:items-center justify-center p-0 sm:p-4"
     role="dialog"
     aria-modal="true"
     aria-labelledby="child-popup-title"
     aria-hidden="true"
     data-popup-level="child"
     data-container-class="child-categories"
     style="pointer-events: auto;">
  <div class="bg-white w-full sm:max-w-4xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform"
       onclick="event.stopPropagation();">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]" aria-hidden="true">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex items-center min-w-0 flex-1 gap-3 sm:gap-4 mr-3">
        <button 
          type="button"
          onclick="goBackToSubcategories(); return false;" 
          class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" 
          aria-label="Go back to subcategories">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <div class="min-w-0 flex-1">
          <h2 id="child-popup-title" class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight truncate">
            {{ $popupConfig['child']['title'] }}
          </h2>
          <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug truncate">
            {{ $popupConfig['child']['subtitle'] }}
          </p>
        </div>
      </div>
      <div class="flex items-center gap-2 sm:gap-3">
        <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-xs font-semibold rounded-full shadow-lg shadow-orange-500/30" aria-label="Service Request Badge">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          Service Request
        </span>
        <button type="button" onclick="closeAllPopups(); return false;" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl hover:bg-gray-100 active:bg-gray-200 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" aria-label="Close popup">
          <svg class="w-6 h-6 text-blue-900" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6" role="list">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 child-categories auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden" aria-hidden="true"></div>
    </div>
  </div>
</div>

<style>
.min-h-0 { min-height: 0; }
.auto-rows-fr { grid-auto-rows: 1fr; }

@supports (height: 100dvh) {
  .max-h-\[95dvh\] { max-height: 95dvh; }
  .max-h-\[90dvh\] { max-height: 90dvh; }
}

.scroll-smooth {
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}

.shine-effect {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
  transition: left 0.5s ease-out;
  pointer-events: none;
  z-index: 1;
  will-change: left;
}

.category-text {
  position: relative;
  z-index: 2;
  word-wrap: break-word;
  overflow-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
  white-space: normal;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
  overflow: hidden;
  width: 100%;
  max-width: 100%;
  line-height: 1.3;
  max-height: calc(1.3em * 3);
}

.category-card {
  transform: translateZ(0);
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  -webkit-font-smoothing: subpixel-antialiased;
  overflow: visible !important;
  height: auto !important;
  min-height: fit-content !important;
  will-change: auto;
  contain: layout style paint;
}

.category-card:hover {
  will-change: transform, box-shadow;
}

img[loading="lazy"] {
  content-visibility: auto;
}

.auto-rows-fr {
  grid-auto-rows: minmax(min-content, max-content) !important;
}

@media (min-width: 640px) {
  .overflow-y-auto::-webkit-scrollbar { width: 8px; }
  .overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
  .overflow-y-auto::-webkit-scrollbar-thumb {
    background: rgba(156, 163, 175, 0.3);
    border-radius: 4px;
  }
  .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(156, 163, 175, 0.5);
  }
}

@media (max-width: 639px) {
  .backdrop-blur-sm { backdrop-filter: none; }
  .category-card { will-change: auto !important; }
}

@media (min-width: 640px) {
  .backdrop-blur-sm { backdrop-filter: blur(8px); }
  .backdrop-blur-xl { backdrop-filter: blur(20px); }
}

@media (hover: none) {
  button:hover {
    transform: none !important;
    box-shadow: inherit !important;
  }
  .shine-effect { display: none; }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

button:focus-visible {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}

@supports not (backdrop-filter: blur(8px)) {
  .backdrop-blur-sm { background-color: rgba(0, 0, 0, 0.7); }
  .backdrop-blur-xl { background-color: rgba(255, 255, 255, 0.98); }
}
</style>

<script>
(function() {
  'use strict';
  
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
          }
          imageObserver.unobserve(img);
        }
      });
    }, { rootMargin: '50px', threshold: 0.01 });

    const observeLazyImages = () => {
      document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
      });
    };

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', observeLazyImages);
    } else {
      observeLazyImages();
    }

    new MutationObserver(observeLazyImages).observe(document.body, {
      childList: true,
      subtree: true
    });
  }

  let ticking = false;
  document.querySelectorAll('.overflow-y-auto').forEach(container => {
    container.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => { ticking = false; });
        ticking = true;
      }
    }, { passive: true });
  });

  if ('connection' in navigator) {
    const conn = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    if (conn && (conn.saveData || conn.effectiveType === 'slow-2g' || conn.effectiveType === '2g')) {
      document.documentElement.style.setProperty('--animation-duration', '0.01ms');
    }
  }
})();
</script>