<!-- 
============================================
🚀 STEP 5 - COUNTRY SELECTION - VERSION PROPRE
✅ Le JS ne touche JAMAIS au style
============================================
-->

<div id="step5" class="hidden flex flex-col h-full" role="region" aria-label="Select your country of residence">
  
  <!-- Sticky Header -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Content -->
    <div class="text-center sm:text-center space-y-2 relative mobile-step5-header">
      <div class="flex justify-center sm:justify-center mobile-step5-icon">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      
      <div class="mobile-step5-title">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Where Do You Live? 🌍
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select your country of residence
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step5SelectedCount">0</span> / 1 selected
        </span>
      </div>
    </div>
  </div>

  <!-- Scrollable Content -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">
    
    <!-- Error Message -->
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

    <!-- Success Message -->
    <div id="step5CountrySuccess" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-green-800">Country selected!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>

    <!-- Country Select -->
    <div class="relative">
      <label for="location-input" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
        <span class="text-lg" aria-hidden="true">🌎</span>
        <span class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">Country of Residence</span>
      </label>
      
      <div class="relative">
        <select 
          id="location-input" 
          name="location" 
          class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-gray-800 bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none cursor-pointer text-sm font-medium hover:border-blue-400"
          aria-required="true"
        >
          <option value="" disabled selected>Choose your country...</option>
          @foreach($countries as $country)
            <option value="{{ $country->country }}">{{ $country->country }}</option>
          @endforeach
        </select>
        
        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
/* Mobile layout unique pour Step 5 */
@media (max-width: 639px) {
  .mobile-step5-header {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    text-align: left;
    gap: 0.75rem;
  }
  
  .mobile-step5-icon {
    order: 1;
    flex-shrink: 0;
    justify-content: flex-start;
  }
  
  .mobile-step5-title {
    order: 2;
    flex: 1;
    text-align: left;
  }
  
  .mobile-step5-title h2 {
    text-align: left;
    font-size: 1.125rem;
    line-height: 1.3;
  }
  
  .mobile-step5-title p {
    text-align: left;
    font-size: 0.8125rem;
  }
  
  .mobile-step5-header .inline-flex {
    order: 3;
    margin-left: auto;
    margin-top: 0.25rem;
  }
}

/* Animations */
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(20px, -50px) scale(1.1); }
  50% { transform: translate(-20px, 20px) scale(0.9); }
  75% { transform: translate(50px, 50px) scale(1.05); }
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

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
  20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake-animation {
  animation: shake 0.5s;
}
</style>

<script>
(function() {
  'use strict';

  const select = document.getElementById('location-input');
  const countEl = document.getElementById('step5SelectedCount');
  const errorEl = document.getElementById('step5CountryError');
  const successEl = document.getElementById('step5CountrySuccess');

  if (!select) {
    console.warn('Step 5: location-input not found');
    return;
  }

  select.addEventListener('change', function() {
    const value = this.value;
    console.log('Step 5: Country selected:', value);
    
    if (countEl) {
      countEl.textContent = value ? '1' : '0';
    }
    
    if (value) {
      if (errorEl) errorEl.classList.add('hidden');
      if (successEl) successEl.classList.remove('hidden');
    } else {
      if (errorEl) errorEl.classList.remove('hidden');
      if (successEl) successEl.classList.add('hidden');
    }
    
    try {
      const data = JSON.parse(localStorage.getItem('expats') || '{}');
      data.location = value;
      localStorage.setItem('expats', JSON.stringify(data));
      console.log('Step 5: Saved to localStorage');
    } catch(e) {
      console.error('Step 5: Error saving to localStorage:', e);
    }
    
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  });

  function restoreSelection() {
    try {
      const data = JSON.parse(localStorage.getItem('expats') || '{}');
      if (data.location) {
        select.value = data.location;
        if (countEl) countEl.textContent = '1';
        if (successEl) successEl.classList.remove('hidden');
        if (errorEl) errorEl.classList.add('hidden');
        console.log('Step 5: Restored from localStorage:', data.location);
      }
    } catch(e) {
      console.error('Step 5: Error restoring from localStorage:', e);
    }
  }

  restoreSelection();

  const step5Container = document.getElementById('step5');
  if (step5Container) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
          if (!step5Container.classList.contains('hidden')) {
            console.log('Step 5: Now visible, restoring selection');
            restoreSelection();
            
            if (typeof window.updateNavigationButtons === 'function') {
              window.updateNavigationButtons();
            }
          }
        }
      });
    });
    
    observer.observe(step5Container, { attributes: true });
  }
})();

// ✅ Validation globale
window.validateStep5 = function() {
  console.log('Step 5: Validating...');
  
  const select = document.getElementById('location-input');
  if (!select) {
    console.warn('Step 5: Select not found for validation');
    return false;
  }
  
  const value = select.value;
  const isValid = value && value !== '';
  
  console.log('Step 5: Valid =', isValid, 'Value =', value);
  
  if (!isValid) {
    const errorEl = document.getElementById('step5CountryError');
    if (errorEl) {
      errorEl.classList.remove('hidden');
      errorEl.classList.add('shake-animation');
      setTimeout(() => {
        errorEl.classList.remove('shake-animation');
      }, 500);
    }
  }
  
  return isValid;
};
</script>