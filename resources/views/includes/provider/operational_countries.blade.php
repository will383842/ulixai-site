<!-- 
============================================
🚀 STEP 6 - WHERE DO YOU OPERATE
============================================
-->

<div id="step6" class="hidden flex flex-col h-full" role="region" aria-label="Select countries where you operate">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Where Do You Operate? 🌍
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select all countries where you provide services <span class="text-red-500">*</span>
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step6SelectedCount">0</span> country(ies) selected
        </span>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <div id="step6CountryError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select at least one country</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose where you provide services</p>
        </div>
      </div>
    </div>

    <div class="relative">
      <input 
        type="text" 
        id="step6Search" 
        placeholder="🔍 Search for a country..." 
        class="w-full px-4 py-3 text-sm bg-gray-200 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all font-medium placeholder:text-gray-600"
        autocomplete="off"
      >
      <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
    </div>

    <div id="step6CountryList" class="country-list-container" role="group" aria-label="Select operational countries">
      @foreach($countries as $country)
      <button type="button" class="country-card" data-country="{{ $country->country }}" role="checkbox" aria-checked="false" aria-label="Select {{ $country->country }}" tabindex="0">
        <span class="country-name">{{ $country->country }}</span>
        <span class="check-indicator">
          <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>
      @endforeach
    </div>

  </div>
</div>

<style>
/* Ajout pour forcer une largeur minimale adaptée au contenu */
#step6 {
  min-width: 100%;
  width: 100%;
}

@media (min-width: 640px) {
  #step6 {
    min-width: 700px;
    max-width: 100%;
  }
}

@media (min-width: 1024px) {
  #step6 {
    min-width: 900px;
    max-width: 1200px;
  }
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

#step6Search {
  transition: all 0.2s ease;
}

#step6Search:hover {
  background-color: #e5e7eb;
  border-color: #60a5fa;
}

#step6Search:focus {
  background-color: white;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
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
  scrollbar-color: #3b82f6 #f1f5f9;
  background: white;
}

/* DESKTOP: Grid avec cards encadrées - LARGEUR ADAPTÉE */
@media (min-width: 640px) {
  .country-list-container {
    display: grid;
    grid-template-columns: repeat(3, minmax(200px, 1fr));
    gap: 0.75rem;
    max-height: 460px;
    background: transparent;
    width: 100%;
  }
}

@media (min-width: 1024px) {
  .country-list-container {
    grid-template-columns: repeat(3, minmax(250px, 1fr));
    gap: 0.875rem;
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
  background: #3b82f6;
  border-radius: 10px;
  transition: background 0.2s;
}

.country-list-container::-webkit-scrollbar-thumb:hover {
  background: #2563eb;
}

/* MOBILE: Style liste épuré sans bordure - DISPOSITION CENTRÉE UNIQUE */
.country-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 1.25rem 0.75rem;
  background: white;
  border: none;
  border-bottom: 1px solid #f1f5f9;
  cursor: pointer;
  text-align: center;
  min-height: 4rem;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  transform: translateZ(0);
  backface-visibility: hidden;
  -webkit-tap-highlight-color: rgba(59, 130, 246, 0.1);
  user-select: none;
  pointer-events: auto !important;
  touch-action: manipulation;
  width: 100%;
}

.country-card * {
  pointer-events: none;
}

.country-card::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 0;
  bottom: auto;
  width: 60%;
  height: 3px;
  background: linear-gradient(90deg, #3b82f6 0%, #06b6d4 100%);
  transform: translateX(-50%) scaleX(0);
  transform-origin: center;
  transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 0 0 3px 3px;
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

.country-card.selected {
  background: linear-gradient(180deg, rgba(59, 130, 246, 0.08) 0%, rgba(6, 182, 212, 0.05) 100%);
  border-bottom-color: rgba(59, 130, 246, 0.1);
}

.country-card.selected::before {
  transform: translateX(-50%) scaleX(1);
}

/* DESKTOP: Style card avec bordure - MEILLEURE GESTION DU TEXTE */
@media (min-width: 640px) {
  .country-card {
    flex-direction: row;
    justify-content: space-between;
    padding: 0.875rem 1rem;
    background: white;
    border: 2px solid #3b82f6;
    border-radius: 0.75rem;
    min-height: 3.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    text-align: left;
    min-width: 0;
  }
  
  .country-card .country-name {
    text-align: left;
    order: 0;
  }
  
  .country-card .check-indicator {
    order: 0;
    margin-bottom: 0;
    margin-left: 0.5rem;
  }
  
  .country-card::before {
    display: none;
  }

  .country-card:hover {
    border-color: #2563eb;
    background: #eff6ff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
  }

  .country-card:active {
    transform: translateY(0) scale(0.98);
    background: #eff6ff;
  }

  .country-card.selected {
    background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
    border-color: #2563eb;
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
  }

  .country-card.selected:hover {
    background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
  }
  
  .country-card.selected .country-name {
    font-weight: 600;
  }
}

.country-card .country-name {
  flex: 1;
  font-size: 0.9375rem;
  font-weight: 600;
  color: #1e293b;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  transition: color 0.2s;
  width: 100%;
  text-align: center;
  order: 2;
  min-width: 0;
}

.country-card.selected .country-name {
  color: #0f172a;
  font-weight: 700;
}

/* DESKTOP: Texte blanc pour selected + meilleure gestion */
@media (min-width: 640px) {
  .country-card .country-name {
    max-width: 100%;
  }
  
  .country-card.selected .country-name {
    color: white;
  }
}

.country-card .check-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 1.75rem;
  height: 1.75rem;
  margin-left: 0;
  margin-bottom: 0.375rem;
  border-radius: 50%;
  background: transparent;
  flex-shrink: 0;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  order: 1;
}

/* MOBILE: Icône visible avec cercle coloré quand sélectionné */
.country-card .check-indicator svg {
  color: transparent;
  transform: scale(0);
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.country-card.selected .check-indicator {
  background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
}

.country-card.selected .check-indicator svg {
  color: white;
  transform: scale(1);
}

/* DESKTOP: Style différent */
@media (min-width: 640px) {
  .country-card .check-indicator {
    width: 1.25rem;
    height: 1.25rem;
    margin-left: 0.5rem;
    background: rgba(59, 130, 246, 0.1);
    opacity: 0;
    transform: scale(0.8);
  }
  
  .country-card .check-indicator svg {
    color: #2563eb;
    transform: scale(0.8);
  }

  .country-card.selected .check-indicator {
    opacity: 1;
    transform: scale(1);
    background: rgba(255, 255, 255, 0.2);
  }

  .country-card.selected .check-indicator svg {
    color: white;
    transform: scale(1);
  }
}

.country-card:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
}

@media (min-width: 640px) {
  .country-card:focus-visible {
    border-color: #2563eb;
  }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Optimisation pour éviter les dépassements */
@media (max-width: 639px) {
  .country-list-container {
    margin-left: -0.25rem;
    margin-right: -0.25rem;
  }
  
  .country-card {
    padding-left: 1rem;
    padding-right: 1rem;
  }
}
</style>

<script>
(function() {
  'use strict';
  
  // Initialiser la variable globale
  if (!window.selectedCountries) {
    window.selectedCountries = [];
  }

  // Fonction pour toggle la sélection
  window.toggleCountrySelection = function(country) {
    console.log('Step 6: toggleCountrySelection called with:', country);
    
    const container = document.querySelector('#step6');
    if (!container) {
      console.warn('Step 6: Container not found');
      return;
    }
    
    const errorAlert = document.getElementById('step6CountryError');
    const selectedCount = document.getElementById('step6SelectedCount');
    const card = container.querySelector(`.country-card[data-country="${CSS.escape(country)}"]`);
    
    if (!card) {
      console.warn('Step 6: Card not found for country:', country);
      return;
    }
    
    const index = window.selectedCountries.indexOf(country);
    
    if (index > -1) {
      // Désélectionner
      window.selectedCountries.splice(index, 1);
      card.classList.remove('selected');
      card.setAttribute('aria-checked', 'false');
      console.log('Step 6: Deselected', country);
    } else {
      // Sélectionner
      window.selectedCountries.push(country);
      card.classList.add('selected');
      card.setAttribute('aria-checked', 'true');
      console.log('Step 6: Selected', country);
    }
    
    // Mettre à jour le compteur
    if (selectedCount) {
      selectedCount.textContent = window.selectedCountries.length;
    }
    
    // Masquer l'erreur si au moins un pays est sélectionné
    if (errorAlert && window.selectedCountries.length > 0) {
      errorAlert.classList.add('hidden');
    }
    
    // Sauvegarder dans localStorage
    try {
      const data = JSON.parse(localStorage.getItem('expats') || '{}');
      data.operational_countries = window.selectedCountries;
      localStorage.setItem('expats', JSON.stringify(data));
      console.log('Step 6: Saved to localStorage:', window.selectedCountries);
    } catch (e) {
      console.error('Step 6: Error saving to localStorage:', e);
    }
    
    // Notifier le wizard
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  };

  // Fonction de validation
  window.validateStep6 = function() {
    console.log('Step 6: Validating... Selected countries:', window.selectedCountries);
    
    const errorAlert = document.getElementById('step6CountryError');
    
    if (!window.selectedCountries || window.selectedCountries.length === 0) {
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

  // Fonction debounce pour la recherche
  function debounce(func, wait) {
    let timeout;
    return function(...args) {
      clearTimeout(timeout);
      timeout = setTimeout(() => func(...args), wait);
    };
  }

  // Restaurer depuis localStorage
  function restoreFromStorage() {
    try {
      const data = JSON.parse(localStorage.getItem('expats') || '{}');
      
      if (data.operational_countries && Array.isArray(data.operational_countries)) {
        window.selectedCountries = data.operational_countries;
        console.log('Step 6: Restored from localStorage:', window.selectedCountries);
        
        requestAnimationFrame(() => {
          const container = document.querySelector('#step6');
          if (!container) return;
          
          const selectedCount = document.getElementById('step6SelectedCount');
          
          window.selectedCountries.forEach(country => {
            const card = container.querySelector(`.country-card[data-country="${CSS.escape(country)}"]`);
            if (card) {
              card.classList.add('selected');
              card.setAttribute('aria-checked', 'true');
            }
          });
          
          if (selectedCount) {
            selectedCount.textContent = window.selectedCountries.length;
          }
          
          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }
        });
      }
    } catch (e) {
      console.error('Step 6: Error restoring from localStorage:', e);
    }
  }

  // Initialisation
  function init() {
    console.log('Step 6: Initializing...');
    
    const container = document.querySelector('#step6');
    if (!container) {
      console.warn('Step 6: Container not found');
      return;
    }

    // Event delegation pour les clics - SANS passive pour permettre preventDefault
    container.addEventListener('click', function(e) {
      const card = e.target.closest('.country-card');
      if (card) {
        e.preventDefault();
        e.stopPropagation();
        const country = card.getAttribute('data-country');
        if (country) {
          console.log('Step 6: Card clicked:', country);
          window.toggleCountrySelection(country);
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
            console.log('Step 6: Keyboard selection:', country);
            window.toggleCountrySelection(country);
          }
        }
      }
    });

    // Recherche de pays
    const searchInput = document.getElementById('step6Search');
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

    // Observer pour restaurer quand le step devient visible
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
          if (!container.classList.contains('hidden')) {
            console.log('Step 6: Now visible, restoring...');
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
    
    console.log('Step 6: Initialization complete');
  }

  // Lancer l'initialisation
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>