<!-- 
============================================
🚀 STEP 13 - EMAIL WITH EXISTENCE CHECK
✅ Vérification email existant
🚫 AUCUN alert/toastr - 100% silencieux
🔒 Bouton bloqué si email existe
🔧 VALIDATION SYNCHRONE (pas async)
📱 COMPACT & RESPONSIVE
============================================
-->

<div id="step13" class="hidden flex flex-col h-full" role="region" aria-label="Enter your email">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-1.5 relative">
      <div class="flex justify-center">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg ring-2 sm:ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-base sm:text-xl">📧</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          What's Your Email? 📬
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600">
          We'll use this to keep you updated
        </p>
      </div>

      <div class="inline-flex items-center gap-1.5 px-2 py-1 sm:px-2.5 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step13StatusText">
          Email not provided
        </span>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-2.5 sm:space-y-3 px-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-xl p-2.5 sm:p-3">
      <div class="flex items-start gap-2">
        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
          <span class="text-sm sm:text-base">ℹ️</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-black text-xs sm:text-sm">Required for communication</p>
          <p class="text-blue-700 text-xs font-semibold mt-0.5">Enter a valid email address</p>
        </div>
      </div>
    </div>

    <!-- Email Input -->
    <div class="input-container">
      <label class="input-label">
        <span class="text-base sm:text-lg">✉️</span>
        <span class="label-text label-blue">Email Address</span>
      </label>
      <div class="input-wrapper">
        <input 
          id="email_input" 
          type="email" 
          placeholder="example@email.com" 
          class="email-input"
          autocomplete="email"
          maxlength="100"
        />
        <div class="success-indicator">
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
        <!-- Checking indicator -->
        <div id="checkingIndicator" class="hidden absolute right-3 top-1/2 -translate-y-1/2">
          <svg class="animate-spin h-4 w-4 sm:h-5 sm:w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
          </svg>
        </div>
      </div>
      <p class="input-hint">We'll never share your email with anyone else</p>
    </div>

    <!-- Error Alert - Format invalide -->
    <div id="step13Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-2.5 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-red-800">Invalid email address</p>
          <p class="text-xs text-red-600 mt-0.5">Please enter a valid email</p>
        </div>
      </div>
    </div>

    <!-- Email Exists Alert - COMPACT -->
    <div id="step13EmailExists" class="hidden bg-purple-50 border-l-4 border-purple-500 rounded-xl p-3 sm:p-4 fade-in" role="alert">
      <div class="flex items-start gap-2 sm:gap-3">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-lg sm:text-xl">👋</span>
        </div>
        <div class="flex-1">
          <p class="text-sm sm:text-base font-black text-purple-900 mb-1">Hey, we know you! 🎉</p>
          <p class="text-xs sm:text-sm font-semibold text-purple-800 mb-2 sm:mb-3">
            Looks like <span class="font-mono bg-purple-200 px-1.5 py-0.5 rounded text-xs" id="existingEmail"></span> already has an account.
          </p>
          <!-- Texte conditionnel - Desktop uniquement -->
          <p class="hidden sm:block text-xs text-purple-700 mb-3">
            You can only have one account per email. But don't worry, you have options:
          </p>
          
          <!-- Action buttons -->
          <div class="flex flex-col sm:flex-row gap-2">
            <button 
              onclick="goToLogin()" 
              class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-2 sm:px-4 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm hover:from-purple-700 hover:to-pink-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2"
            >
              <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
              </svg>
              <span>Login to my account</span>
            </button>
            <button 
              onclick="tryAnotherEmail()" 
              class="flex-1 bg-white border-2 border-purple-300 text-purple-700 px-3 py-2 sm:px-4 sm:py-2.5 rounded-lg font-bold text-xs sm:text-sm hover:bg-purple-50 transition-all flex items-center justify-center gap-2"
            >
              <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
              <span>Try another email</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Alert -->
    <div id="step13Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-2.5" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-green-800">Valid email address!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>
  </div>

  <!-- NAVIGATION -->
  <div class="wizard-nav-container px-4">
    <button id="backToStep12" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="step13Continue" type="button" class="nav-btn-next" disabled>
      Next
    </button>
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

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.fade-in {
  animation: fadeIn 0.3s ease-out;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation { 
  animation: shake 0.5s ease-in-out; 
}

#step13 .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step13 .input-container:hover {
  transform: translateY(-2px);
}

#step13 .input-label {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
  font-size: 0.75rem;
}

@media (min-width: 640px) {
  #step13 .input-label { 
    font-size: 0.875rem;
    gap: 0.5rem;
  }
}

#step13 .label-text { font-weight: 800; }
#step13 .label-blue { color: #2563eb; }

#step13 .input-wrapper {
  position: relative;
  width: 100%;
}

#step13 .email-input {
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
  #step13 .email-input {
    padding: 0.875rem 3rem 0.875rem 1.25rem;
    font-size: 1rem;
  }
}

#step13 .email-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#step13 .email-input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step13 .email-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step13 .email-input.checking {
  border-color: #3b82f6;
  background-color: #eff6ff;
}

#step13 .email-input.exists {
  border-color: #a855f7;
  background-color: #faf5ff;
}

#step13 .success-indicator {
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
  #step13 .success-indicator {
    width: 2rem;
    height: 2rem;
    right: 0.75rem;
  }
}

#step13 .email-input.valid ~ .success-indicator {
  display: flex;
  opacity: 1;
  animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
  0% { transform: translateY(-50%) scale(0); }
  50% { transform: translateY(-50%) scale(1.1); }
  100% { transform: translateY(-50%) scale(1); }
}

#step13 .input-hint {
  margin-top: 0.375rem;
  font-size: 0.6875rem;
  color: #6b7280;
  font-weight: 500;
}

@media (min-width: 640px) {
  #step13 .input-hint { 
    font-size: 0.75rem;
    margin-top: 0.5rem;
  }
}

#step13 .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}

#step13Continue:disabled {
  opacity: 0.5 !important;
  cursor: not-allowed !important;
  background: #9ca3af !important;
  pointer-events: none !important;
}

#step13Continue:disabled:hover {
  transform: none !important;
  box-shadow: none !important;
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (max-width: 639px) {
  #step13 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step13 h2 {
    font-size: 1.125rem;
    line-height: 1.3;
  }
  
  #step13 p {
    font-size: 0.75rem;
  }
}
</style>

<script>
(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  const EMAIL_REGEX = /^[a-zA-Z0-9](?:[a-zA-Z0-9._+-]{0,62}[a-zA-Z0-9])?@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z]{2,})+$/;
  const CHECK_DEBOUNCE = 800;
  const NAV_UPDATE_DEBOUNCE = 300;
  
  const state = {
    email: '',
    isValid: false,
    emailExists: false,
    isChecking: false,
    saveTimeout: null,
    validationTimeout: null,
    checkTimeout: null,
    navUpdateTimeout: null
  };

  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step13'),
        emailInput: document.getElementById('email_input'),
        errorAlert: document.getElementById('step13Error'),
        successAlert: document.getElementById('step13Success'),
        emailExistsAlert: document.getElementById('step13EmailExists'),
        statusText: document.getElementById('step13StatusText'),
        checkingIndicator: document.getElementById('checkingIndicator'),
        continueBtn: document.getElementById('step13Continue')
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
        data.email = state.email;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 500);
  }

  function validateEmail(email) {
    if (!email || email.length === 0) return false;
    if (email.length < 5 || email.length > 100) return false;
    return EMAIL_REGEX.test(email);
  }

  async function checkEmailExists(email) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      
      const response = await fetch('/check-email', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ email })
      });
      
      if (!response.ok) {
        console.warn('Check email failed:', response.status);
        return false;
      }
      
      const data = await response.json();
      return data.exists === true;
      
    } catch (error) {
      console.error('Check email error:', error);
      return false;
    }
  }

  function showEmailExistsMessage() {
    const elements = getCachedElements();
    
    console.log('🚫 [Step 13] showEmailExistsMessage() - Email exists, BLOCKING button');
    
    if (elements.successAlert) elements.successAlert.classList.add('hidden');
    if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
    
    if (elements.emailExistsAlert) {
      document.getElementById('existingEmail').textContent = state.email;
      elements.emailExistsAlert.classList.remove('hidden');
      
      requestAnimationFrame(() => {
        elements.emailExistsAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
    }
    
    if (elements.emailInput) {
      elements.emailInput.classList.remove('valid', 'invalid', 'checking');
      elements.emailInput.classList.add('exists');
    }
    
    if (elements.statusText) {
      elements.statusText.textContent = 'Email already registered';
    }
    
    if (elements.continueBtn) {
      elements.continueBtn.disabled = true;
      console.log('🔒 [Step 13] Button DISABLED');
    }
    
    if (navigator.vibrate) {
      navigator.vibrate([50, 30, 50]);
    }
    
    updateLocalNavigationButton();
  }

  function updateValidationState() {
    const elements = getCachedElements();
    
    state.email = elements.emailInput.value.trim();
    state.isValid = validateEmail(state.email);
    
    if (elements.emailInput.dataset.lastChecked !== state.email) {
      state.emailExists = false;
      if (elements.emailExistsAlert) {
        elements.emailExistsAlert.classList.add('hidden');
      }
    }
    
    if (state.email.length > 0) {
      if (state.isValid && !state.emailExists) {
        elements.emailInput.classList.remove('invalid', 'exists');
        elements.emailInput.classList.add('valid');
      } else if (!state.isValid) {
        elements.emailInput.classList.remove('valid', 'exists');
        elements.emailInput.classList.add('invalid');
      }
    } else {
      elements.emailInput.classList.remove('valid', 'invalid', 'exists');
    }
    
    if (elements.statusText) {
      if (state.isValid && !state.emailExists) {
        elements.statusText.textContent = 'Valid email provided';
      } else if (state.emailExists) {
        elements.statusText.textContent = 'Email already registered';
      } else {
        elements.statusText.textContent = 'Email not provided';
      }
    }
    
    if (state.isValid && !state.emailExists) {
      if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
      if (elements.successAlert) elements.successAlert.classList.remove('hidden');
    } else {
      if (elements.successAlert) elements.successAlert.classList.add('hidden');
    }
    
    return state.isValid && !state.emailExists;
  }

  function scheduleEmailCheck() {
    const elements = getCachedElements();
    
    if (state.checkTimeout) {
      clearTimeout(state.checkTimeout);
    }
    
    if (!state.isValid) return;
    
    state.checkTimeout = setTimeout(async () => {
      console.log('🔍 [Step 13] Checking email existence...');
      
      state.isChecking = true;
      if (elements.checkingIndicator) elements.checkingIndicator.classList.remove('hidden');
      if (elements.emailInput) elements.emailInput.classList.add('checking');
      
      updateLocalNavigationButton();
      
      try {
        const exists = await checkEmailExists(state.email);
        
        elements.emailInput.dataset.lastChecked = state.email;
        state.emailExists = exists;
        
        console.log('📊 [Step 13] Check result:', { email: state.email, exists });
        
        if (exists) {
          showEmailExistsMessage();
        } else {
          updateValidationState();
        }
      } catch (error) {
        console.error('❌ [Step 13] Check failed:', error);
        state.emailExists = false;
      } finally {
        state.isChecking = false;
        if (elements.checkingIndicator) elements.checkingIndicator.classList.add('hidden');
        if (elements.emailInput) elements.emailInput.classList.remove('checking');
        
        updateLocalNavigationButton();
      }
      
    }, CHECK_DEBOUNCE);
  }

  function updateLocalNavigationButton() {
    const elements = getCachedElements();
    
    if (state.isChecking) {
      if (elements.continueBtn) {
        elements.continueBtn.disabled = true;
        console.log('🔒 [Step 13] Button DISABLED (checking...)');
      }
      return;
    }
    
    if (state.emailExists) {
      if (elements.continueBtn) {
        elements.continueBtn.disabled = true;
        console.log('🔒 [Step 13] Button DISABLED (email exists)');
      }
      return;
    }
    
    const canContinue = state.isValid;
    
    console.log('🔄 [Step 13] updateLocalNavigationButton()', {
      isValid: state.isValid,
      emailExists: state.emailExists,
      isChecking: state.isChecking,
      canContinue: canContinue
    });
    
    if (elements.continueBtn) {
      elements.continueBtn.disabled = !canContinue;
      
      if (!canContinue) {
        console.log('🔒 [Step 13] Button DISABLED (invalid format)');
      } else {
        console.log('✅ [Step 13] Button ENABLED');
      }
    }
  }

  function scheduleGlobalNavUpdate() {
    if (state.navUpdateTimeout) {
      clearTimeout(state.navUpdateTimeout);
    }
    
    state.navUpdateTimeout = setTimeout(() => {
      if (typeof window.updateNavigationButtons === 'function') {
        console.log('🌍 [Step 13] Calling global updateNavigationButtons()');
        window.updateNavigationButtons();
      }
    }, NAV_UPDATE_DEBOUNCE);
  }

  window.validateStep13 = function(showAlert) {
    const elements = getCachedElements();
    
    console.log('🔍 [Step 13] validateStep13() called (SYNC)');
    console.log('📊 Current state:', {
      email: state.email,
      isValid: state.isValid,
      emailExists: state.emailExists,
      isChecking: state.isChecking,
      lastChecked: elements.emailInput?.dataset.lastChecked
    });
    
    if (!updateValidationState()) {
      if (showAlert) {
        showError();
      }
      console.warn('❌ [Step 13] Invalid format');
      return false;
    }
    
    if (state.emailExists) {
      console.warn('🚫 [Step 13] Email already exists - BLOCKED');
      if (showAlert) {
        showEmailExistsMessage();
      }
      return false;
    }
    
    if (state.isChecking) {
      console.warn('🚫 [Step 13] Still checking - BLOCKED');
      return false;
    }
    
    saveToLocalStorage();
    console.log('✅ [Step 13] Email validation passed');
    return true;
  };

  function showError() {
    const elements = getCachedElements();
    
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      
      requestAnimationFrame(() => {
        elements.errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    
    const inputContainer = elements.emailInput?.closest('.input-container');
    if (inputContainer) {
      inputContainer.classList.add('error-shake');
      setTimeout(() => inputContainer.classList.remove('error-shake'), 500);
    }
  }

  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'email_input') return;
    
    if (state.validationTimeout) {
      clearTimeout(state.validationTimeout);
    }
    
    state.validationTimeout = setTimeout(() => {
      requestAnimationFrame(() => {
        updateValidationState();
        
        if (state.isValid) {
          saveToLocalStorage();
          scheduleEmailCheck();
        } else {
          updateLocalNavigationButton();
          scheduleGlobalNavUpdate();
        }
      });
    }, 300);
  }

  function handleBlur(e) {
    const input = e.target;
    if (!input || input.id !== 'email_input') return;
    
    requestAnimationFrame(() => {
      updateValidationState();
      
      if (state.isValid) {
        scheduleEmailCheck();
      } else {
        updateLocalNavigationButton();
        scheduleGlobalNavUpdate();
      }
    });
  }

  window.goToLogin = function() {
    console.log('🔗 [Step 13] Redirecting to login...');
    
    const popup = document.getElementById('signupPopup');
    if (popup) popup.classList.add('hidden');
    
    window.location.href = '/login';
  };

  window.tryAnotherEmail = function() {
    console.log('🔄 [Step 13] Trying another email...');
    
    const elements = getCachedElements();
    
    if (elements.emailInput) {
      elements.emailInput.value = '';
      elements.emailInput.dataset.lastChecked = '';
      elements.emailInput.classList.remove('valid', 'invalid', 'exists', 'checking');
      elements.emailInput.focus();
    }
    
    if (elements.emailExistsAlert) {
      elements.emailExistsAlert.classList.add('hidden');
    }
    if (elements.errorAlert) {
      elements.errorAlert.classList.add('hidden');
    }
    if (elements.successAlert) {
      elements.successAlert.classList.add('hidden');
    }
    
    state.email = '';
    state.isValid = false;
    state.emailExists = false;
    state.isChecking = false;
    
    console.log('🔄 [Step 13] State reset:', state);
    
    updateValidationState();
    updateLocalNavigationButton();
    scheduleGlobalNavUpdate();
  };

  function initEventDelegation() {
    const elements = getCachedElements();
    
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
      elements.step.addEventListener('blur', handleBlur, { capture: true, passive: true });
    }
  }

  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if (elements.emailInput && data.email) {
      elements.emailInput.value = data.email;
      state.email = data.email;
    }
    
    requestAnimationFrame(() => {
      updateValidationState();
      
      if (state.isValid) {
        scheduleEmailCheck();
      } else {
        updateLocalNavigationButton();
        scheduleGlobalNavUpdate();
      }
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
    
    console.log('✅ [Step 13] Email validation initialized (COMPACT & RESPONSIVE)');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>