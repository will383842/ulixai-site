<!-- 
============================================
🚀 STEP 14 - PHONE NUMBER INPUT
============================================
✨ Design System Blue/Cyan/Teal STRICT
📱 Téléphone avec select dynamique + input
🚩 Drapeaux locaux : public/images/flags/*.svg
🚫 AUCUN alert - 100% silencieux
⚡ Solution simple et robuste - 197 PAYS
🔧 Inspiré du Step 5 - Liste dynamique
============================================
-->

@php
  use App\Models\Country;
  $countries = Country::where('status', 1)->orderBy('country', 'asc')->get();
@endphp

<div id="step14" class="hidden flex flex-col h-full" role="region" aria-label="Enter your phone number">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-1.5 relative">
      <div class="flex justify-center">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg ring-2 sm:ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-base sm:text-xl">📱</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          What's Your Number? 📞
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600">
          We'll use this to communicate with you
        </p>
      </div>

      <div class="inline-flex items-center gap-1.5 px-2 py-1 sm:px-2.5 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step14StatusText">
          Phone not provided
        </span>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-2.5 sm:space-y-3 px-4">

    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-xl p-2.5 sm:p-3">
      <div class="flex items-start gap-2">
        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
          <span class="text-sm sm:text-base">ℹ️</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-black text-xs sm:text-sm">Required for communication</p>
          <p class="text-blue-700 text-xs font-semibold mt-0.5">Select your country code and enter your number</p>
        </div>
      </div>
    </div>

    <div class="input-container">
      <label class="input-label">
        <span class="text-base sm:text-lg">📞</span>
        <span class="label-text label-blue">Phone Number</span>
      </label>
      
      <!-- Sélecteur de pays avec popup -->
      <div class="space-y-2">
        <button 
          type="button" 
          id="countryCodeButton" 
          class="w-full flex items-center justify-between px-3 py-2.5 sm:px-4 sm:py-3 bg-white border-2 border-gray-300 rounded-xl text-sm font-medium hover:border-blue-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none transition-all"
        >
          <div class="flex items-center gap-2">
            <img id="selectedCountryFlag" src="{{ asset('images/flags/fr.svg') }}" alt="FR" class="w-6 h-4 object-cover rounded-sm shadow-sm">
            <span id="selectedCountryName" class="font-semibold text-gray-700">France</span>
            <span id="selectedCountryCode" class="text-blue-600 font-bold">+33</span>
          </div>
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <!-- Phone Number Input -->
        <div class="input-wrapper">
          <input 
            id="phone_number_input" 
            type="tel" 
            placeholder="6 12 34 56 78"
            class="phone-input"
            autocomplete="tel"
          />
          <div class="success-indicator">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </div>
        </div>
      </div>
      <p class="input-hint">We'll never share your phone number without your permission</p>
    </div>

    <div id="step14Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-2.5 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-red-800">Invalid phone number</p>
          <p class="text-xs text-red-600 mt-0.5">Please enter at least 6 digits</p>
        </div>
      </div>
    </div>

    <div id="step14Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-2.5" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-green-800">Valid phone number!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>
  </div>

  <div class="wizard-nav-container px-4">
    <button id="backToStep13bis" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="step14Continue" type="button" class="nav-btn-next" disabled>
      Next
    </button>
  </div>
</div>

<!-- MODAL POPUP POUR SÉLECTION DU PAYS -->
<div id="countryCodeModal" class="hidden fixed inset-0 z-[250] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeCountryModal()">
  <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] flex flex-col" onclick="event.stopPropagation()">
    
    <!-- Header -->
    <div class="sticky top-0 bg-white border-b border-gray-200 px-4 sm:px-6 py-4 rounded-t-2xl z-10">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg sm:text-xl font-black text-gray-800">Select Country Code</h3>
        <button onclick="closeCountryModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-1 rounded-lg hover:bg-gray-100">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      
      <!-- Search -->
      <input 
        type="text" 
        id="countrySearchInput" 
        placeholder="🔍 Search country..." 
        class="w-full px-4 py-2.5 text-sm bg-blue-50 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all font-medium"
        autocomplete="off"
      >
    </div>

    <!-- Country List -->
    <div id="countryCodeList" class="flex-1 overflow-y-auto p-2 sm:p-4">
      @foreach($countries as $country)
        <button 
          type="button" 
          class="country-code-option w-full flex items-center gap-3 px-3 py-2.5 hover:bg-blue-50 rounded-lg transition-all text-left" 
          data-country="{{ $country->country }}"
          data-code="{{ $country->phone_code }}"
          data-flag="{{ strtolower($country->country_code) }}"
          onclick="selectCountryCode('{{ $country->country }}', '{{ $country->phone_code }}', '{{ strtolower($country->country_code) }}')"
        >
          <img src="{{ asset('images/flags/' . strtolower($country->country_code) . '.svg') }}" alt="{{ $country->country_code }}" class="w-6 h-4 object-cover rounded-sm shadow-sm flex-shrink-0">
          <span class="flex-1 font-semibold text-gray-700 text-sm">{{ $country->country }}</span>
          <span class="font-bold text-blue-600 text-sm">{{ $country->phone_code }}</span>
        </button>
      @endforeach
    </div>
  </div>
</div>

<style>
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
  will-change: transform;
}

.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation { 
  animation: shake 0.5s ease-in-out; 
}

#step14 .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step14 .input-container:hover {
  transform: translateY(-2px);
}

#step14 .input-label {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
  font-size: 0.75rem;
}

@media (min-width: 640px) {
  #step14 .input-label { 
    font-size: 0.875rem;
    gap: 0.5rem;
  }
}

#step14 .label-text { font-weight: 800; }
#step14 .label-blue { color: #2563eb; }

#step14 .input-wrapper {
  position: relative;
  width: 100%;
}

#step14 .phone-input {
  width: 100%;
  padding: 0.75rem 2.5rem 0.75rem 1rem;
  border: 2px solid #d1d5db;
  border-radius: 0.75rem;
  font-size: 0.875rem;
  font-weight: 500;
  background: white;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  outline: none;
}

@media (min-width: 640px) {
  #step14 .phone-input {
    padding: 0.875rem 3rem 0.875rem 1.25rem;
    font-size: 1rem;
  }
}

#step14 .phone-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#step14 .phone-input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step14 .phone-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step14 .success-indicator {
  position: absolute;
  right: 0.625rem;
  top: 50%;
  transform: translateY(-50%);
  width: 1.5rem;
  height: 1.5rem;
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 50%;
  display: none;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

@media (min-width: 640px) {
  #step14 .success-indicator {
    width: 2rem;
    height: 2rem;
    right: 0.75rem;
  }
}

#step14 .phone-input.valid ~ .success-indicator {
  display: flex;
  opacity: 1;
  animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
  0% { transform: translateY(-50%) scale(0); }
  50% { transform: translateY(-50%) scale(1.1); }
  100% { transform: translateY(-50%) scale(1); }
}

#step14 .input-hint {
  margin-top: 0.375rem;
  font-size: 0.6875rem;
  color: #6b7280;
  font-weight: 500;
}

@media (min-width: 640px) {
  #step14 .input-hint { 
    font-size: 0.75rem;
    margin-top: 0.5rem;
  }
}

#step14 .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}

#step14Continue:disabled {
  opacity: 0.5 !important;
  cursor: not-allowed !important;
  background: #9ca3af !important;
  pointer-events: none !important;
}

#step14Continue:disabled:hover {
  transform: none !important;
  box-shadow: none !important;
}

.country-code-option:hover {
  background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(96, 165, 250, 0.05) 100%);
  transform: translateX(2px);
}

.country-code-option:active {
  transform: scale(0.98);
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (max-width: 639px) {
  #step14 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step14 h2 {
    font-size: 1.125rem;
    line-height: 1.3;
  }
  
  #step14 p {
    font-size: 0.75rem;
  }
}
</style>

<script>
(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  
  const state = {
    selectedCountry: 'France',
    countryCode: '+33',
    countryFlag: 'fr',
    phone: '',
    fullPhone: '',
    isValid: false,
    saveTimeout: null,
    validationTimeout: null,
    navUpdateTimeout: null
  };

  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step14'),
        phoneInput: document.getElementById('phone_number_input'),
        countryCodeButton: document.getElementById('countryCodeButton'),
        selectedCountryName: document.getElementById('selectedCountryName'),
        selectedCountryCode: document.getElementById('selectedCountryCode'),
        selectedCountryFlag: document.getElementById('selectedCountryFlag'),
        errorAlert: document.getElementById('step14Error'),
        successAlert: document.getElementById('step14Success'),
        statusText: document.getElementById('step14StatusText'),
        continueBtn: document.getElementById('step14Continue'),
        modal: document.getElementById('countryCodeModal'),
        searchInput: document.getElementById('countrySearchInput')
      };
    }
    return cachedElements;
  }

  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      return {};
    }
  }

  function saveToLocalStorage() {
    if (state.saveTimeout) {
      clearTimeout(state.saveTimeout);
    }
    
    state.saveTimeout = setTimeout(() => {
      try {
        const data = getLocalStorage();
        data.phone_number = state.fullPhone;
        data.country_code = state.countryCode;
        data.phone_country = state.selectedCountry;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        console.log('💾 [Step 14] Phone saved:', state.fullPhone);
      } catch (e) {
        console.warn('⚠️ [Step 14] localStorage error:', e);
      }
    }, 500);
  }

  window.selectCountryCode = function(country, code, flag) {
    const elements = getCachedElements();
    
    state.selectedCountry = country;
    state.countryCode = code;
    state.countryFlag = flag;
    
    if (elements.selectedCountryName) elements.selectedCountryName.textContent = country;
    if (elements.selectedCountryCode) elements.selectedCountryCode.textContent = code;
    if (elements.selectedCountryFlag && flag) {
      elements.selectedCountryFlag.src = `/images/flags/${flag}.svg`;
      elements.selectedCountryFlag.alt = flag.toUpperCase();
    }
    
    closeCountryModal();
    
    requestAnimationFrame(() => {
      validatePhone();
      if (state.isValid) {
        saveToLocalStorage();
      }
    });
  };

  window.openCountryModal = function() {
    const elements = getCachedElements();
    if (elements.modal) {
      elements.modal.classList.remove('hidden');
      elements.modal.classList.add('flex');
      if (elements.searchInput) {
        elements.searchInput.value = '';
        elements.searchInput.focus();
        filterCountries('');
      }
    }
  };

  window.closeCountryModal = function() {
    const elements = getCachedElements();
    if (elements.modal) {
      elements.modal.classList.add('hidden');
      elements.modal.classList.remove('flex');
    }
  };

  function filterCountries(searchValue) {
    const search = searchValue.toLowerCase();
    const options = document.querySelectorAll('.country-code-option');
    
    options.forEach(option => {
      const country = (option.getAttribute('data-country') || '').toLowerCase();
      const code = (option.getAttribute('data-code') || '').toLowerCase();
      option.style.display = (country.includes(search) || code.includes(search)) ? '' : 'none';
    });
  }

  function validatePhone() {
    const elements = getCachedElements();
    
    state.phone = elements.phoneInput.value.trim();
    
    const digitsOnly = state.phone.replace(/\D/g, '');
    
    state.isValid = digitsOnly.length >= 6;
    state.fullPhone = state.isValid ? `${state.countryCode} ${state.phone}` : '';
    
    if (state.phone.length > 0) {
      if (state.isValid) {
        elements.phoneInput.classList.remove('invalid');
        elements.phoneInput.classList.add('valid');
      } else {
        elements.phoneInput.classList.remove('valid');
        elements.phoneInput.classList.add('invalid');
      }
    } else {
      elements.phoneInput.classList.remove('valid', 'invalid');
    }
    
    if (elements.statusText) {
      if (state.isValid) {
        elements.statusText.textContent = 'Valid phone provided';
      } else {
        elements.statusText.textContent = 'Phone not provided';
      }
    }
    
    if (state.isValid) {
      if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
      if (elements.successAlert) elements.successAlert.classList.remove('hidden');
    } else {
      if (elements.successAlert) elements.successAlert.classList.add('hidden');
    }
    
    updateNavigationButton();
    
    return state.isValid;
  }

  function updateNavigationButton() {
    const elements = getCachedElements();
    
    if (elements.continueBtn) {
      elements.continueBtn.disabled = !state.isValid;
    }
    
    scheduleGlobalNavUpdate();
  }

  function scheduleGlobalNavUpdate() {
    if (state.navUpdateTimeout) {
      clearTimeout(state.navUpdateTimeout);
    }
    
    state.navUpdateTimeout = setTimeout(() => {
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }, 300);
  }

  window.validateStep14 = function(showAlert) {
    console.log('🔍 [Step 14] validateStep14() called');
    const elements = getCachedElements();
    
    if (!validatePhone()) {
      console.warn('⚠️ [Step 14] Validation failed');
      
      if (showAlert && elements.errorAlert) {
        elements.errorAlert.classList.remove('hidden');
        
        requestAnimationFrame(() => {
          elements.errorAlert.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
          });
        });
      }
      
      return false;
    }
    
    console.log('✅ [Step 14] Validation passed');
    saveToLocalStorage();
    return true;
  };

  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'phone_number_input') return;
    
    if (state.validationTimeout) {
      clearTimeout(state.validationTimeout);
    }
    
    state.validationTimeout = setTimeout(() => {
      requestAnimationFrame(() => {
        validatePhone();
        if (state.isValid) {
          saveToLocalStorage();
        }
      });
    }, 300);
  }

  function handleSearchInput(e) {
    const input = e.target;
    if (!input || input.id !== 'countrySearchInput') return;
    
    filterCountries(input.value);
  }

  function initEventDelegation() {
    const elements = getCachedElements();
    
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
    }
    
    if (elements.countryCodeButton) {
      elements.countryCodeButton.addEventListener('click', window.openCountryModal);
    }
    
    if (elements.searchInput) {
      elements.searchInput.addEventListener('input', handleSearchInput, { passive: true });
    }
    
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        window.closeCountryModal();
      }
    });
  }

  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if (data.phone_country && data.country_code) {
      state.selectedCountry = data.phone_country;
      state.countryCode = data.country_code;
      
      if (elements.selectedCountryName) elements.selectedCountryName.textContent = state.selectedCountry;
      if (elements.selectedCountryCode) elements.selectedCountryCode.textContent = state.countryCode;
    }
    
    if (elements.phoneInput && data.phone_number) {
      const phoneWithoutCode = data.phone_number.replace(state.countryCode, '').trim();
      elements.phoneInput.value = phoneWithoutCode;
      state.phone = phoneWithoutCode;
      console.log('🔄 [Step 14] Phone restored:', data.phone_number);
    }
    
    requestAnimationFrame(() => {
      validatePhone();
    });
  }

  function init() {
    const elements = getCachedElements();
    
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              restoreState();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    initEventDelegation();
    restoreState();
    
    console.log('✅ [Step 14] Phone validation initialized (197 COUNTRIES + LOCAL FLAGS)');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>