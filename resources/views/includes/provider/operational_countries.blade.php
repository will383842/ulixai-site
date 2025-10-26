<div id="step6" class="hidden max-w-7xl mx-auto px-3 sm:px-4">
  
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <div class="mb-6 sm:mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-2 sm:gap-3 mb-2 sm:mb-3">
      <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl shadow-xl bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 flex items-center justify-center animate-bounce-subtle">
        <span class="text-2xl sm:text-3xl">🌍</span>
      </div>
      <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        Where Do You Operate?
      </h2>
    </div>
    <p class="text-sm sm:text-base lg:text-lg font-semibold text-gray-600 px-4">
      Select at least 1 country • Click to add/remove
    </p>
  </div>

  <div id="selectedChipsContainer" class="mb-6 hidden">
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-3 sm:p-4 border-2 border-blue-200">
      <div class="flex items-center justify-between mb-2 sm:mb-3 gap-2">
        <h3 class="text-xs sm:text-sm font-bold text-blue-900 flex items-center flex-wrap gap-1.5">
          <span>Selected Countries</span>
          <span id="chipCounter" class="bg-blue-600 text-white text-xs px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full font-bold">0</span>
        </h3>
        <button id="clearAll" class="text-red-500 hover:text-red-700 text-xs sm:text-sm font-semibold hover:underline transition-all whitespace-nowrap">
          Clear All
        </button>
      </div>
      <div id="selectedChips" class="flex flex-wrap gap-1.5 sm:gap-2"></div>
    </div>
  </div>

  <div class="mb-5">
    <div class="relative">
      <input 
        type="text" 
        id="countrySearch" 
        placeholder="🔍 Search for a country..." 
        class="w-full px-4 py-3 sm:px-6 sm:py-4 text-sm sm:text-base bg-gray-200 border-3 border-blue-300 rounded-2xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all font-medium placeholder:text-gray-600 placeholder:font-semibold"
        autocomplete="off"
      >
      <div class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
    </div>
  </div>

  <div id="countryList" class="country-list-container">
    @foreach($countries as $country)
    <div class="country-card" data-country="{{ $country->country }}">
      <input type="checkbox" name="countries[]" value="{{ $country->country }}" class="country-checkbox">
      <span class="country-name">{{ $country->country }}</span>
    </div>
    @endforeach
  </div>

  <div id="countryError" class="hidden mb-5 p-3 sm:p-5 bg-red-50 border-l-4 border-red-500 rounded-xl">
    <div class="flex items-center gap-3 sm:gap-4">
      <span class="text-2xl sm:text-3xl flex-shrink-0">⚠️</span>
      <p class="text-red-700 font-bold text-sm sm:text-lg">Please select at least 1 country!</p>
    </div>
  </div>

  <div id="countrySuccess" class="hidden mb-5 p-3 sm:p-5 bg-blue-50 border-l-4 border-blue-500 rounded-xl">
    <div class="flex items-center gap-3 sm:gap-4">
      <span class="text-2xl sm:text-3xl flex-shrink-0">🎉</span>
      <p class="text-blue-700 font-bold text-sm sm:text-lg">Perfect! <span id="successCount"></span> country(ies) selected</p>
    </div>
  </div>

  <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 sm:gap-4 pt-6 border-t-2 border-gray-100">
    <button id="backToStep5" type="button" class="flex items-center justify-center gap-2 px-4 sm:px-6 py-2.5 sm:py-3 bg-white text-blue-600 border-2 border-gray-200 font-semibold rounded-xl hover:bg-blue-50 hover:border-blue-400 transition-all order-2 sm:order-1 min-h-[48px]">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button id="nextStep6" type="button" class="flex items-center justify-center gap-2 px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold rounded-xl hover:shadow-xl hover:scale-105 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none order-1 sm:order-2 min-h-[48px]">
      <span>Continue</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
      </svg>
    </button>
  </div>
</div>

<style>
@keyframes popIn {
  0% { transform: scale(0.8); opacity: 0; }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); opacity: 1; }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
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

.animate-bounce-subtle {
  animation: bounce-subtle 2s infinite;
}

.country-chip {
  animation: popIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.shake-animation {
  animation: shake 0.5s;
}

#countrySearch {
  background-color: #d1d5db;
  transition: all 0.2s ease;
  will-change: background-color, border-color, box-shadow;
}

#countrySearch:hover {
  background-color: #9ca3af;
  border-color: #60a5fa;
}

#countrySearch:focus {
  background-color: white;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3) !important;
  border-color: #3b82f6;
}

#countrySearch::placeholder {
  color: #4b5563;
  font-weight: 600;
}

.country-list-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.625rem;
  max-height: 420px;
  max-width: 1400px;
  margin: 0 auto 1.5rem;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0.625rem;
  will-change: scroll-position;
  contain: layout style paint;
  scrollbar-width: thin;
  scrollbar-color: #3b82f6 #f1f5f9;
}

@media (max-width: 374px) {
  .country-list-container {
    grid-template-columns: repeat(1, 1fr);
    gap: 0.5rem;
    padding: 0.5rem;
  }
}

@media (min-width: 640px) {
  .country-list-container {
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    padding: 0.75rem;
    max-height: 460px;
  }
}

@media (min-width: 1024px) {
  .country-list-container {
    grid-template-columns: repeat(4, 1fr);
    gap: 0.875rem;
    padding: 1rem;
    max-height: 480px;
  }
}

@media (min-width: 1280px) {
  .country-list-container {
    grid-template-columns: repeat(5, 1fr);
    max-height: 500px;
    gap: 1rem;
  }
}

@media (min-width: 1536px) {
  .country-list-container {
    grid-template-columns: repeat(5, 1fr);
    max-height: 520px;
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
}

.country-list-container::-webkit-scrollbar-thumb:hover {
  background: #2563eb;
}

@media (min-width: 640px) {
  .country-list-container::-webkit-scrollbar {
    width: 8px;
  }
}

.country-card {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 1rem 0.875rem;
  background: white;
  border: 2px solid #93c5fd;
  border-radius: 0.75rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: visible;
  min-height: 72px;
  height: auto;
  will-change: transform, box-shadow, background;
  transform: translateZ(0);
  backface-visibility: hidden;
  contain: layout style;
}

@media (min-width: 640px) {
  .country-card {
    padding: 1.125rem 1rem;
    gap: 0.625rem;
    min-height: 76px;
  }
}

@media (min-width: 1024px) {
  .country-card {
    padding: 1.25rem 1.125rem;
    min-height: 80px;
  }
}

.country-card:hover {
  transform: translateY(-2px) scale(1.02);
  border-color: #60a5fa;
  box-shadow: 0 4px 12px -2px rgba(59, 130, 246, 0.3);
}

.country-card:active {
  transform: translateY(0) scale(0.98);
}

.country-card.selected {
  background: linear-gradient(to bottom right, #2563eb, #0891b2);
  border-color: #1d4ed8;
  box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.4);
}

.country-card.selected .country-name {
  color: white;
  font-weight: 700;
}

.country-checkbox {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

.country-name {
  flex: 1;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #374151;
  line-height: 1.35;
  text-align: center;
  transition: color 0.2s;
  word-wrap: break-word;
  overflow-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
  display: block;
  width: 100%;
}

@media (max-width: 374px) {
  .country-name {
    font-size: 0.875rem;
    line-height: 1.4;
  }
}

@media (min-width: 640px) {
  .country-name {
    font-size: 0.875rem;
    line-height: 1.4;
  }
}

@media (min-width: 1024px) {
  .country-name {
    font-size: 0.9375rem;
  }
}

@media (min-width: 1280px) {
  .country-name {
    font-size: 1rem;
  }
}

.country-card:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
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
  .country-card {
    border-width: 3px;
  }
}

.country-chip {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(to right, #2563eb, #0891b2);
  color: white;
  border-radius: 0.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
  animation: popIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

@media (min-width: 640px) {
  .country-chip {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    gap: 0.5rem;
  }
}

.country-chip .remove-chip {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.125rem;
  border-radius: 0.25rem;
  transition: background-color 0.2s;
  flex-shrink: 0;
}

.country-chip .remove-chip:hover {
  background-color: rgba(0, 0, 0, 0.2);
}

.country-card,
#countrySearch {
  transform: translateZ(0);
  backface-visibility: hidden;
}

.country-card {
  contain: layout style paint;
}

.country-list-container {
  contain: layout style paint;
}

.country-card {
  content-visibility: auto;
  contain-intrinsic-size: 0 72px;
}

@media (min-width: 640px) {
  .country-card {
    contain-intrinsic-size: 0 76px;
  }
}

@media (min-width: 1024px) {
  .country-card {
    contain-intrinsic-size: 0 80px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.country-card');
  const chipsContainer = document.getElementById('selectedChipsContainer');
  const chipsArea = document.getElementById('selectedChips');
  const chipCounter = document.getElementById('chipCounter');
  const clearAllBtn = document.getElementById('clearAll');
  const errorMsg = document.getElementById('countryError');
  const successMsg = document.getElementById('countrySuccess');
  const searchInput = document.getElementById('countrySearch');
  const nextBtn = document.getElementById('nextStep6');
  const backBtn = document.getElementById('backToStep5');
  const step6 = document.getElementById('step6');

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

  function createChip(countryName) {
    const chip = document.createElement('div');
    chip.className = 'country-chip';
    chip.innerHTML = `
      <span class="leading-tight">${countryName}</span>
      <button class="remove-chip hover:bg-blue-700 rounded p-0.5 transition-all flex-shrink-0" data-country="${countryName}" type="button" aria-label="Remove ${countryName}">
        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </button>
    `;
    return chip;
  }

  function updateSelection() {
    const selected = document.querySelectorAll('.country-checkbox:checked');
    const fragment = document.createDocumentFragment();
    
    if (selected.length > 0) {
      chipsContainer.classList.remove('hidden');
      chipCounter.textContent = selected.length;
      
      selected.forEach(checkbox => {
        const chip = createChip(checkbox.value);
        fragment.appendChild(chip);
      });
      
      chipsArea.innerHTML = '';
      chipsArea.appendChild(fragment);

      chipsArea.querySelectorAll('.remove-chip').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          const country = this.dataset.country;
          const card = document.querySelector(`.country-card[data-country="${country}"]`);
          if (card) {
            const checkbox = card.querySelector('.country-checkbox');
            checkbox.checked = false;
            card.classList.remove('selected');
            updateSelection();
          }
        });
      });
    } else {
      chipsContainer.classList.add('hidden');
      chipsArea.innerHTML = '';
    }

    errorMsg.classList.add('hidden');
    errorMsg.classList.remove('shake-animation');
    successMsg.classList.add('hidden');
    
    if (selected.length >= 1) {
      successMsg.classList.remove('hidden');
      document.getElementById('successCount').textContent = selected.length;
    }

    const selectedCountries = Array.from(selected).map(cb => cb.value);
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    expats.operational_countries = selectedCountries;
    localStorage.setItem('expats', JSON.stringify(expats));
    
    checkValidation();
  }

  function checkValidation() {
    const selected = document.querySelectorAll('.country-checkbox:checked').length;
    if (nextBtn) {
      nextBtn.disabled = selected < 1;
    }
  }

  cards.forEach(card => {
    card.addEventListener('click', function() {
      const checkbox = this.querySelector('.country-checkbox');
      checkbox.checked = !checkbox.checked;
      
      if (checkbox.checked) {
        this.classList.add('selected');
      } else {
        this.classList.remove('selected');
      }
      
      updateSelection();
    });
  });

  if (clearAllBtn) {
    clearAllBtn.addEventListener('click', function() {
      if (confirm('⚠️ Clear all selected countries?')) {
        document.querySelectorAll('.country-checkbox:checked').forEach(cb => {
          cb.checked = false;
        });
        cards.forEach(card => {
          card.classList.remove('selected');
        });
        updateSelection();
      }
    });
  }

  if (searchInput) {
    const performSearch = debounce(function(searchValue) {
      const search = searchValue.toLowerCase();
      requestAnimationFrame(() => {
        cards.forEach(card => {
          const country = card.dataset.country.toLowerCase();
          const matches = country.includes(search);
          card.style.display = matches ? '' : 'none';
        });
      });
    }, 150);

    searchInput.addEventListener('input', function() {
      performSearch(this.value);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', function(e) {
      const selected = document.querySelectorAll('.country-checkbox:checked').length;
      
      if (selected < 1) {
        e.preventDefault();
        errorMsg.classList.remove('hidden');
        errorMsg.classList.add('shake-animation');
        successMsg.classList.add('hidden');
        errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        setTimeout(() => {
          errorMsg.classList.remove('shake-animation');
        }, 500);
      } else if (typeof goToStep === 'function') {
        goToStep('step7');
      }
    });
  }

  const observer = new MutationObserver(() => {
    if (!step6.classList.contains('hidden') && !step6.dataset.loaded) {
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      const saved = expats.operational_countries;
      
      if (saved && Array.isArray(saved)) {
        requestAnimationFrame(() => {
          cards.forEach(card => {
            const checkbox = card.querySelector('.country-checkbox');
            if (saved.includes(checkbox.value)) {
              checkbox.checked = true;
              card.classList.add('selected');
            }
          });
          updateSelection();
        });
      }
      
      step6.dataset.loaded = '1';
      checkValidation();
    }
  });
  
  if (step6) {
    observer.observe(step6, { attributes: true, attributeFilter: ['class'] });
  }

  if (backBtn) {
    backBtn.addEventListener('click', function() {
      if (typeof goToStep === 'function') {
        goToStep('step5');
      }
    });
  }

  setTimeout(checkValidation, 200);
});
</script>