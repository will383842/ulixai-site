<!-- 
============================================
🚀 STEP 5 - COUNTRY OF RESIDENCE - GREEN THEME
============================================
-->

<div id="step5" class="hidden flex flex-col h-full" role="region" aria-label="Select your country of residence">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-500 via-green-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-emerald-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-emerald-600 via-green-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Where Do You Live? 📍
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select your country of residence <span class="text-red-500">*</span>
        </p>
      </div>

      <div class="hidden sm:inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-emerald-700">
          <span id="step5SelectedCount">0</span> / 1 selected
        </span>
      </div>

      <!-- AFFICHAGE DU PAYS SÉLECTIONNÉ -->
      <div id="step5SelectedDisplay" class="hidden mt-2 px-2 sm:px-3">
        <div class="flex justify-center items-center">
          <!-- Le badge sera inséré ici dynamiquement -->
        </div>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4 px-1">

    <div id="step5CountryError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select your country</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose one country to continue</p>
        </div>
      </div>
    </div>

    <div class="relative">
      <input 
        type="text" 
        id="step5Search" 
        placeholder="🔍 Search for your country..." 
        class="w-full px-4 py-3 text-sm bg-emerald-50 border-2 border-emerald-200 rounded-xl focus:border-emerald-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-200 transition-all font-medium placeholder:text-gray-600"
        autocomplete="off"
      >
      <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-emerald-500 pointer-events-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
    </div>

    <div id="step5CountryList" class="country-list-container" role="radiogroup" aria-label="Select your country">
      @foreach($countries as $country)
      <button type="button" class="country-card" data-country="{{ $country->country }}" role="radio" aria-checked="false" aria-label="Select {{ $country->country }}" tabindex="0">
        <span class="country-name">{{ $country->country }}</span>
        <span class="check-indicator">
          <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>
      @endforeach
    </div>

  </div>
</div>

<style>
#step5 {
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
}

@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(20px, -50px) scale(1.1); }
  50% { transform: translate(-20px, 20px) scale(0.9); }
  75% { transform: translate(50px, 50px) scale(1.05); }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
  20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes pulse-glow-green {
  0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
  50% { box-shadow: 0 0 20px 4px rgba(16, 185, 129, 0.6); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.shake-animation {
  animation: shake 0.5s;
}

#step5Search {
  transition: all 0.2s ease;
}

#step5Search:hover {
  background-color: #d1fae5;
  border-color: #34d399;
}

#step5Search:focus {
  background-color: white;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
}

/* BADGE DU PAYS SÉLECTIONNÉ - VERT/ORANGE */
.selected-country-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(135deg, #10b981 0%, #f59e0b 100%);
  color: white;
  font-size: 0.875rem;
  font-weight: 600;
  border-radius: 0.5rem;
  white-space: nowrap;
  box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
  animation: slideIn 0.2s ease-out;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* MOBILE FIRST: Design épuré sans bordure */
.country-list-container {
  display: flex;
  flex-direction: column;
  gap: 0;
  max-height: 420px;
  overflow-y: auto;
  contain: layout style paint;
  scrollbar-width: thin;
  scrollbar-color: #10b981 #f1f5f9;
  background: white;
  width: 100%;
  box-sizing: border-box;
}

/* DESKTOP: Grid avec cards encadrées */
@media (min-width: 640px) {
  .country-list-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 0.625rem;
    max-height: 460px;
    background: transparent;
  }
}

@media (min-width: 1024px) {
  .country-list-container {
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 0.75rem;
    max-height: 480px;
  }
}

.country-list-container::-webkit-scrollbar {
  width: 6px;
}

.country-list-container::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

.country-list-container::-webkit-scrollbar-thumb {
  background: #10b981;
  border-radius: 10px;
  transition: background 0.2s;
}

.country-list-container::-webkit-scrollbar-thumb:hover {
  background: #059669;
}

/* MOBILE: Style liste épuré */
.country-card {
  position: relative;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-start;
  padding: 1rem 0.75rem;
  background: white;
  border: none;
  border-bottom: 1px solid #f1f5f9;
  cursor: pointer;
  text-align: left;
  min-height: 3.5rem;
  gap: 0.75rem;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  transform: translateZ(0);
  backface-visibility: hidden;
  -webkit-tap-highlight-color: rgba(16, 185, 129, 0.1);
  user-select: none;
  pointer-events: auto !important;
  touch-action: manipulation;
  width: 100%;
  box-sizing: border-box;
}

.country-card * {
  pointer-events: none;
}

/* MOBILE: Barre latérale gauche VERTE pour la sélection */
.country-card::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  background: linear-gradient(180deg, #10b981 0%, #14b8a6 100%);
  transform: scaleY(0);
  transform-origin: center;
  transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 0 4px 4px 0;
}

@media (min-width: 640px) {
  .country-card::before {
    display: none;
  }
}

.country-card:active {
  background: #f8fafc;
  transform: scale(0.98);
}

/* MOBILE: Sélection TRÈS visible avec fond VERT */
.country-card.selected {
  background: linear-gradient(90deg, rgba(16, 185, 129, 0.15) 0%, rgba(20, 184, 166, 0.08) 100%);
  border-bottom-color: rgba(16, 185, 129, 0.2);
}

.country-card.selected::before {
  transform: scaleY(1);
}

/* DESKTOP: Style card avec bordure */
@media (min-width: 640px) {
  .country-card {
    flex-direction: row;
    justify-content: space-between;
    padding: 0.625rem 0.75rem;
    background: white;
    border: 2.5px solid #e2e8f0;
    border-radius: 0.625rem;
    min-height: 3rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    text-align: left;
    min-width: 0;
    gap: 0.375rem;
  }
  
  .country-card .country-name {
    text-align: left;
    order: 0;
  }
  
  .country-card .check-indicator {
    order: 0;
    margin-bottom: 0;
    margin-left: 0;
  }
  
  .country-card::before {
    display: none;
  }

  .country-card:hover {
    border-color: #34d399;
    background: #ecfdf5;
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(16, 185, 129, 0.12);
  }

  .country-card:active {
    transform: translateY(0) scale(0.98);
    background: #ecfdf5;
  }

  /* DESKTOP: Sélection ULTRA visible avec VERT */
  .country-card.selected {
    background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
    border-color: #059669;
    border-width: 3px;
    color: white;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    transform: translateY(-2px) scale(1.02);
    animation: pulse-glow-green 2s infinite;
  }

  .country-card.selected:hover {
    background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.5);
    transform: translateY(-3px) scale(1.03);
  }
  
  .country-card.selected .country-name {
    font-weight: 700;
  }
}

.country-card .country-name {
  flex: 1;
  font-size: 0.875rem;
  font-weight: 600;
  color: #1e293b;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  transition: color 0.2s;
  text-align: left;
  order: 2;
  min-width: 0;
}

/* MOBILE: Texte plus visible en sélection - VERT */
.country-card.selected .country-name {
  color: #047857;
  font-weight: 700;
}

/* DESKTOP: Texte blanc pour selected */
@media (min-width: 640px) {
  .country-card .country-name {
    max-width: 100%;
    font-size: 0.8125rem;
  }
  
  .country-card.selected .country-name {
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  }
}

/* MOBILE: Icône visible à gauche */
.country-card .check-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 1.75rem;
  height: 1.75rem;
  margin: 0;
  border-radius: 50%;
  background: #f1f5f9;
  border: 2px solid #cbd5e1;
  flex-shrink: 0;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  order: 1;
}

.country-card .check-indicator svg {
  color: transparent;
  transform: scale(0);
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

/* MOBILE: Icône très visible quand sélectionné - VERT */
.country-card.selected .check-indicator {
  background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
  border-color: #059669;
  box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
  transform: scale(1.1);
}

.country-card.selected .check-indicator svg {
  color: white;
  transform: scale(1.1);
}

/* DESKTOP: Style différent et compact */
@media (min-width: 640px) {
  .country-card .check-indicator {
    width: 1.125rem;
    height: 1.125rem;
    background: rgba(16, 185, 129, 0.08);
    border: 1.5px solid rgba(16, 185, 129, 0.2);
    opacity: 0.7;
    transform: scale(0.9);
  }
  
  .country-card .check-indicator svg {
    color: #059669;
    transform: scale(0.7);
  }

  .country-card.selected .check-indicator {
    opacity: 1;
    transform: scale(1);
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .country-card.selected .check-indicator svg {
    color: white;
    transform: scale(1);
  }
}

.country-card:focus-visible {
  outline: 3px solid #10b981;
  outline-offset: 2px;
}

@media (min-width: 640px) {
  .country-card:focus-visible {
    border-color: #059669;
  }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<script>
(function() {
  'use strict';
  
  // Variable globale pour le pays sélectionné (UN SEUL)
  if (typeof window.selectedCountry === 'undefined') {
    window.selectedCountry = null;
  }

  // Fonction pour sauvegarder dans localStorage
  function saveToLocalStorage() {
    try {
      const existingData = JSON.parse(localStorage.getItem('expats') || '{}');
      existingData.location = window.selectedCountry;
      localStorage.setItem('expats', JSON.stringify(existingData));
    } catch (e) {
      console.error('Step 5: Error saving to localStorage:', e);
    }
  }

  // Fonction pour mettre à jour l'affichage du badge
  function updateSelectedDisplay() {
    const displayContainer = document.getElementById('step5SelectedDisplay');
    if (!displayContainer) return;
    
    const wrapper = displayContainer.querySelector('div');
    if (!wrapper) return;
    
    if (!window.selectedCountry) {
      displayContainer.classList.add('hidden');
      wrapper.innerHTML = '';
      return;
    }
    
    displayContainer.classList.remove('hidden');
    wrapper.innerHTML = `
      <span class="selected-country-badge">
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        ${window.selectedCountry}
      </span>
    `;
  }

  // Fonction pour désélectionner tous les pays visuellement
  function clearAllVisualSelections() {
    const container = document.querySelector('#step5');
    if (!container) return;
    
    const allCards = container.querySelectorAll('.country-card');
    allCards.forEach(card => {
      card.classList.remove('selected');
      card.setAttribute('aria-checked', 'false');
    });
  }

  // Fonction pour sélectionner un pays (UNIQUE)
  window.selectCountry = function(country) {
    const container = document.querySelector('#step5');
    if (!container) return;
    
    const errorAlert = document.getElementById('step5CountryError');
    const selectedCount = document.getElementById('step5SelectedCount');
    
    // Trouver la carte
    let card = container.querySelector(`[data-country="${country}"]`);
    if (!card) {
      try {
        card = container.querySelector(`[data-country="${CSS.escape(country)}"]`);
      } catch (e) {}
    }
    
    if (!card) return;
    
    // Si c'est déjà le pays sélectionné, ne rien faire
    if (window.selectedCountry === country) {
      return;
    }
    
    // Désélectionner tous les pays d'abord
    clearAllVisualSelections();
    
    // Sélectionner le nouveau pays
    window.selectedCountry = country;
    card.classList.add('selected');
    card.setAttribute('aria-checked', 'true');
    
    // Mettre à jour le compteur
    if (selectedCount) {
      selectedCount.textContent = '1';
    }
    
    // Mettre à jour le badge
    updateSelectedDisplay();
    
    // Masquer l'erreur
    if (errorAlert) {
      errorAlert.classList.add('hidden');
    }
    
    // Sauvegarder
    saveToLocalStorage();
    
    // Notifier
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  };

  // Fonction de validation
  window.validateStep5 = function() {
    const errorAlert = document.getElementById('step5CountryError');
    
    if (!window.selectedCountry) {
      if (errorAlert) {
        errorAlert.classList.remove('hidden');
        errorAlert.classList.add('shake-animation');
        setTimeout(() => errorAlert.classList.remove('shake-animation'), 500);
      }
      return false;
    }
    
    if (errorAlert) {
      errorAlert.classList.add('hidden');
    }
    
    return true;
  };

  // Fonction debounce
  function debounce(func, wait) {
    let timeout;
    return function(...args) {
      clearTimeout(timeout);
      timeout = setTimeout(() => func(...args), wait);
    };
  }

  // Fonction de restauration
  function restoreFromStorage() {
    try {
      const data = JSON.parse(localStorage.getItem('expats') || '{}');
      
      if (data.location) {
        window.selectedCountry = data.location;
        
        requestAnimationFrame(() => {
          const container = document.querySelector('#step5');
          if (!container) return;
          
          clearAllVisualSelections();
          
          // Restaurer la sélection visuelle
          let card = container.querySelector(`[data-country="${data.location}"]`);
          if (!card) {
            try {
              card = container.querySelector(`[data-country="${CSS.escape(data.location)}"]`);
            } catch (e) {}
          }
          
          if (card) {
            card.classList.add('selected');
            card.setAttribute('aria-checked', 'true');
          }
          
          const selectedCount = document.getElementById('step5SelectedCount');
          if (selectedCount) {
            selectedCount.textContent = '1';
          }
          
          updateSelectedDisplay();
          
          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }
        });
      }
    } catch (e) {
      console.error('Step 5: Error restoring from localStorage:', e);
    }
  }

  // Initialisation
  function init() {
    const container = document.querySelector('#step5');
    if (!container) return;

    // Event delegation pour les clics
    container.addEventListener('click', function(e) {
      const card = e.target.closest('.country-card');
      if (card) {
        e.preventDefault();
        e.stopPropagation();
        const country = card.getAttribute('data-country');
        if (country) {
          window.selectCountry(country);
        }
      }
    });

    // Support clavier
    container.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        const card = e.target.closest('.country-card');
        if (card) {
          e.preventDefault();
          const country = card.getAttribute('data-country');
          if (country) {
            window.selectCountry(country);
          }
        }
      }
    });

    // Recherche
    const searchInput = document.getElementById('step5Search');
    if (searchInput) {
      const performSearch = debounce(function(searchValue) {
        const search = searchValue.toLowerCase();
        const cards = container.querySelectorAll('.country-card');
        
        requestAnimationFrame(() => {
          cards.forEach(card => {
            const country = (card.getAttribute('data-country') || '').toLowerCase();
            card.style.display = country.includes(search) ? '' : 'none';
          });
        });
      }, 150);
      
      searchInput.addEventListener('input', function() {
        performSearch(this.value);
      });
    }

    // Observer pour restaurer quand visible
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
          if (!container.classList.contains('hidden')) {
            if (searchInput) searchInput.value = '';
            const cards = container.querySelectorAll('.country-card');
            cards.forEach(card => card.style.display = '');
            restoreFromStorage();
          }
        }
      });
    });

    observer.observe(container, { 
      attributes: true,
      attributeFilter: ['class']
    });

    // Restauration initiale
    restoreFromStorage();
  }

  // Lancer l'initialisation
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>