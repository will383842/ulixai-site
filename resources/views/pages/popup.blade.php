<!-- Main Search Popup -->
<div id="searchPopup" class="hidden fixed inset-0 z-[60] bg-black/60 backdrop-blur-sm flex justify-center items-end sm:items-center p-0 sm:p-4">
  <div class="bg-white w-full sm:max-w-2xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex-1 min-w-0 mr-4">
        <h2 class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight">Choose Your Category</h2>
        <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug">Select a category to continue</p>
      </div>
      <button onclick="closeAllPopups()" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 active:from-blue-700 active:to-blue-800 text-white shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/30" aria-label="Close popup">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 main-categories auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden"></div>
    </div>
  </div>
</div>

<!-- Subcategories Popup -->
<div id="expatriesPopup" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4">
  <div class="bg-white w-full sm:max-w-4xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex items-center min-w-0 flex-1 gap-3 sm:gap-4 mr-3">
        <button onclick="goBackToMainCategories()" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" aria-label="Go back">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <div class="min-w-0 flex-1">
          <h2 class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight truncate">Choose Your Need</h2>
          <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug truncate">Select a service option</p>
        </div>
      </div>
      <button onclick="closeAllPopups()" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 active:from-blue-700 active:to-blue-800 text-white shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/30" aria-label="Close popup">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 sub-category auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden"></div>
    </div>
  </div>
</div>

<!-- Vacanciers - Autres besoins sub-subcategories Popup -->
<div id="vacanciersAutresBesoinsPopup" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4">
  <div class="bg-white w-full sm:max-w-4xl sm:rounded-[2rem] rounded-t-[2rem] shadow-[0_-4px_60px_rgba(0,0,0,0.3)] sm:shadow-[0_20px_60px_rgba(0,0,0,0.3)] max-h-[95dvh] sm:max-h-[90dvh] flex flex-col overflow-hidden will-change-transform">
    <div class="sm:hidden flex justify-center pt-3 pb-2 bg-white rounded-t-[2rem]">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex-shrink-0 bg-gradient-to-b from-white via-white to-gray-50/30 border-b border-gray-200/60 px-5 pt-4 pb-5 sm:p-6 flex items-center justify-between backdrop-blur-xl bg-white/95 sticky top-0 z-10">
      <div class="flex items-center min-w-0 flex-1 gap-3 sm:gap-4 mr-3">
        <button onclick="goBackToVacanciersSubcategories()" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300/50" aria-label="Go back">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <div class="min-w-0 flex-1">
          <h2 class="text-[1.375rem] sm:text-2xl font-bold text-gray-900 tracking-tight leading-tight truncate">Choose Your Need</h2>
          <p class="text-[0.8125rem] sm:text-sm text-gray-500 mt-1 leading-snug truncate">Select a specific service</p>
        </div>
      </div>
      <button onclick="closeAllPopups()" class="flex-shrink-0 w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 active:from-blue-700 active:to-blue-800 text-white shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transition-all duration-300 active:scale-95 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-500/30" aria-label="Close popup">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto overscroll-contain scroll-smooth px-4 sm:px-6">
      <div class="py-5 sm:py-6 pb-6 sm:pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 child-categories auto-rows-fr"></div>
      </div>
      <div class="h-[env(safe-area-inset-bottom,1rem)] sm:hidden"></div>
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

@media (min-width: 640px) {
  .overflow-y-auto::-webkit-scrollbar { width: 8px; }
  .overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
  .overflow-y-auto::-webkit-scrollbar-thumb {
    background: rgba(156, 163, 175, 0.3);
    border-radius: 4px;
    transition: background 0.2s;
  }
  .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(156, 163, 175, 0.5);
  }
}

@media (max-width: 639px) {
  .backdrop-blur-sm { backdrop-filter: none; }
  .shadow-lg { box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); }
  button:hover { transform: none; }
}

@media (min-width: 640px) {
  .backdrop-blur-sm { backdrop-filter: blur(8px); }
  .backdrop-blur-xl { backdrop-filter: blur(20px); }
  .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
}

@media (hover: none) {
  button {
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none;
    user-select: none;
  }
  button:hover {
    transform: none !important;
    box-shadow: inherit !important;
  }
}

.will-change-transform { will-change: transform; }

@media (prefers-reduced-motion: no-preference) {
  .transition-all {
    transform: translateZ(0);
    backface-visibility: hidden;
  }
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

.shadow-\[0_-4px_60px_rgba\(0\,0\,0\,0\.3\)\] {
  box-shadow: 0 -4px 60px rgba(0, 0, 0, 0.3);
}

.shadow-\[0_20px_60px_rgba\(0\,0\,0\,0\.3\)\] {
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

@supports not (backdrop-filter: blur(8px)) {
  .backdrop-blur-sm { background-color: rgba(0, 0, 0, 0.7); }
  .backdrop-blur-xl { background-color: rgba(255, 255, 255, 0.98); }
}
</style>