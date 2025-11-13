<!-- 
============================================
🚀 STEP 13BIS - PASSWORD INPUT
============================================
✨ Design System Blue/Cyan/Teal STRICT
🔒 Password avec validation de force
💎 Indicateurs visuels de sécurité
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage avec clé 'expats'
✅ CONFORME AU GUIDE SYSTÈME WIZARD
🔇 100% SILENCIEUX - AUCUN TOASTR
📱 COMPACT & RESPONSIVE
⚠️ RÈGLES: Min 6 caractères + 1 majuscule + 1 chiffre
⚠️ ID: step13bis
⚠️ VALIDATION: validateStep13bis()
⚡ FIX: Bouton navigation local + debounce agressif
============================================
-->

<div id="step13bis" class="hidden flex flex-col h-full" role="region" aria-label="Create your password">
  
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-1.5 relative">
      <div class="flex justify-center">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg ring-2 sm:ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-base sm:text-lg">🔒</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          Create Your Password
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600">
          Choose a strong password to secure your account
        </p>
      </div>

      <div class="inline-flex items-center gap-1.5 px-2 py-1 sm:px-2.5 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step13bisStatusText">
          Password not set
        </span>
      </div>
    </div>
  </div>

  <div class="flex-1 overflow-y-auto pt-0 space-y-2.5 sm:space-y-3 px-4">

    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-xl p-2.5 sm:p-3">
      <div class="flex items-start gap-2">
        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
          <span class="text-sm sm:text-base">🛡️</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-black text-xs sm:text-sm">Secure your account</p>
          <p class="text-blue-700 text-xs font-semibold mt-0.5">Use at least 6 characters with uppercase and numbers</p>
        </div>
      </div>
    </div>

    <div class="input-container">
      <label class="input-label">
        <span class="text-base sm:text-lg">🔐</span>
        <span class="label-text label-blue">Password</span>
      </label>
      <div class="input-wrapper">
        <input
          type="password"
          id="password_input"
          autocomplete="new-password"
          placeholder="Enter your password"
          class="password-input"
        />
        <button
          type="button"
          id="togglePasswordBtn"
          class="absolute right-2.5 sm:right-3 top-1/2 -translate-y-1/2 p-1.5 sm:p-2 text-gray-400 hover:text-gray-600 transition-colors z-10"
          aria-label="Toggle password visibility"
        >
          <svg id="passwordEyeOpen" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="passwordEyeClosed" class="w-4 h-4 sm:w-5 sm:h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
          </svg>
        </button>
        <div class="success-indicator">
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>

      <div class="space-y-1.5 mt-2">
        <div class="flex items-center gap-1">
          <div id="strengthBar1" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
          <div id="strengthBar2" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
          <div id="strengthBar3" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
        </div>
        <p class="text-xs text-gray-500">Strength: <span id="strengthLevel" class="font-semibold">None</span></p>
      </div>

      <div class="mt-2 space-y-1.5">
        <div id="reqLength" class="flex items-center gap-1.5 text-gray-500 transition-colors text-xs">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span>At least 6 characters</span>
        </div>
        <div id="reqUppercase" class="flex items-center gap-1.5 text-gray-500 transition-colors text-xs">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span>One uppercase letter</span>
        </div>
        <div id="reqNumber" class="flex items-center gap-1.5 text-gray-500 transition-colors text-xs">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span>One number</span>
        </div>
      </div>
      <p class="input-hint mt-2">Use a strong password to protect your account</p>
    </div>

    <div id="step13bisError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-2.5 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-red-800">Please meet all password requirements</p>
          <p class="text-xs text-red-600 mt-0.5">Your password must be secure to continue</p>
        </div>
      </div>
    </div>

    <div id="step13bisSuccess" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-2.5" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-xs sm:text-sm font-semibold text-green-800">Strong password!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>
  </div>

  <div class="wizard-nav-container px-4">
    <button id="backToStep13" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="step13bisContinue" type="button" class="nav-btn-next" disabled>
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

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

#step13bis .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step13bis .input-container:hover {
  transform: translateY(-2px);
}

#step13bis .input-label {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  margin-bottom: 0.5rem;
  font-weight: 700;
  font-size: 0.75rem;
}

@media (min-width: 640px) {
  #step13bis .input-label { 
    font-size: 0.875rem;
    gap: 0.5rem;
  }
}

#step13bis .label-text { font-weight: 800; }
#step13bis .label-blue { color: #2563eb; }

#step13bis .input-wrapper {
  position: relative;
  width: 100%;
}

#step13bis .password-input {
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
  #step13bis .password-input {
    padding: 0.875rem 3rem 0.875rem 1.25rem;
    font-size: 1rem;
  }
}

#step13bis .password-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

#step13bis .password-input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step13bis .password-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step13bis .success-indicator {
  position: absolute;
  right: 2.75rem;
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
  #step13bis .success-indicator {
    width: 2rem;
    height: 2rem;
    right: 3.25rem;
  }
}

#step13bis .password-input.valid ~ .success-indicator {
  display: flex;
  opacity: 1;
  animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
  0% { transform: translateY(-50%) scale(0); }
  50% { transform: translateY(-50%) scale(1.1); }
  100% { transform: translateY(-50%) scale(1); }
}

#step13bis .input-hint {
  margin-top: 0.375rem;
  font-size: 0.6875rem;
  color: #6b7280;
  font-weight: 500;
}

@media (min-width: 640px) {
  #step13bis .input-hint { 
    font-size: 0.75rem;
    margin-top: 0.5rem;
  }
}

#step13bis .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}

#step13bisContinue:disabled {
  opacity: 0.5 !important;
  cursor: not-allowed !important;
  background: #9ca3af !important;
  pointer-events: none !important;
}

#step13bisContinue:disabled:hover {
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
  #step13bis .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step13bis h2 {
    font-size: 1.125rem;
    line-height: 1.3;
  }
  
  #step13bis p {
    font-size: 0.75rem;
  }
}
</style>

<script>
(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  
  const state = {
    password: '',
    isValid: false,
    saveTimeout: null,
    validationTimeout: null,
    navUpdateTimeout: null
  };

  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step13bis'),
        passwordInput: document.getElementById('password_input'),
        toggleBtn: document.getElementById('togglePasswordBtn'),
        eyeOpen: document.getElementById('passwordEyeOpen'),
        eyeClosed: document.getElementById('passwordEyeClosed'),
        strengthBars: [
          document.getElementById('strengthBar1'),
          document.getElementById('strengthBar2'),
          document.getElementById('strengthBar3')
        ],
        strengthLevel: document.getElementById('strengthLevel'),
        requirements: {
          length: document.getElementById('reqLength'),
          uppercase: document.getElementById('reqUppercase'),
          number: document.getElementById('reqNumber')
        },
        errorAlert: document.getElementById('step13bisError'),
        successAlert: document.getElementById('step13bisSuccess'),
        statusText: document.getElementById('step13bisStatusText'),
        continueBtn: document.getElementById('step13bisContinue')
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
        data.password = state.password;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 500);
  }

  function togglePasswordVisibility() {
    const elements = getCachedElements();
    
    if (elements.passwordInput.type === 'password') {
      elements.passwordInput.type = 'text';
      elements.eyeOpen.classList.add('hidden');
      elements.eyeClosed.classList.remove('hidden');
    } else {
      elements.passwordInput.type = 'password';
      elements.eyeOpen.classList.remove('hidden');
      elements.eyeClosed.classList.add('hidden');
    }
  }

  function checkPasswordStrength(password) {
    const elements = getCachedElements();
    let strength = 0;
    
    const checks = {
      length: password.length >= 6,
      uppercase: /[A-Z]/.test(password),
      number: /[0-9]/.test(password)
    };
    
    Object.keys(checks).forEach(key => {
      const req = elements.requirements[key];
      const icon = req.querySelector('svg');
      const circle = req.querySelector('span');
      
      if (checks[key]) {
        strength++;
        req.classList.remove('text-gray-500');
        req.classList.add('text-green-600');
        circle.classList.remove('border-gray-300');
        circle.classList.add('border-green-500', 'bg-green-500');
        icon.classList.remove('hidden');
      } else {
        req.classList.remove('text-green-600');
        req.classList.add('text-gray-500');
        circle.classList.remove('border-green-500', 'bg-green-500');
        circle.classList.add('border-gray-300');
        icon.classList.add('hidden');
      }
    });
    
    const colors = [
      { bg: 'bg-red-500', text: 'Weak', color: 'text-red-600' },
      { bg: 'bg-yellow-500', text: 'Fair', color: 'text-yellow-600' },
      { bg: 'bg-green-500', text: 'Strong', color: 'text-green-600' }
    ];
    
    elements.strengthBars.forEach((bar, index) => {
      bar.className = 'h-1 sm:h-1.5 flex-1 rounded-full transition-all duration-300';
      if (index < strength) {
        bar.classList.add(colors[Math.min(strength - 1, 2)].bg);
      } else {
        bar.classList.add('bg-gray-200');
      }
    });
    
    if (strength === 0) {
      elements.strengthLevel.textContent = 'None';
      elements.strengthLevel.className = 'text-gray-500 font-semibold';
    } else {
      const level = colors[Math.min(strength - 1, 2)];
      elements.strengthLevel.textContent = level.text;
      elements.strengthLevel.className = level.color + ' font-semibold';
    }
    
    if (password.length > 0) {
      if (strength >= 3) {
        elements.passwordInput.classList.remove('invalid');
        elements.passwordInput.classList.add('valid');
      } else {
        elements.passwordInput.classList.remove('valid');
        elements.passwordInput.classList.add('invalid');
      }
    } else {
      elements.passwordInput.classList.remove('valid', 'invalid');
    }
    
    if (elements.statusText) {
      if (strength >= 3) {
        elements.statusText.textContent = 'Strong password set';
      } else {
        elements.statusText.textContent = 'Password not set';
      }
    }
    
    if (strength >= 3) {
      if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
      if (elements.successAlert) elements.successAlert.classList.remove('hidden');
    } else {
      if (elements.successAlert) elements.successAlert.classList.add('hidden');
    }
    
    state.isValid = strength >= 3;
    return state.isValid;
  }

  function updateLocalNavigationButton() {
    const elements = getCachedElements();
    
    if (elements.continueBtn) {
      elements.continueBtn.disabled = !state.isValid;
    }
  }

  function scheduleGlobalNavUpdate() {
    if (state.navUpdateTimeout) {
      clearTimeout(state.navUpdateTimeout);
    }
    
    state.navUpdateTimeout = setTimeout(() => {
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }, 500);
  }

  window.validateStep13bis = function(showAlert) {
    const elements = getCachedElements();
    
    console.log('🔍 [Step 13bis] validateStep13bis() called');
    
    state.password = elements.passwordInput.value;
    
    if (!state.password) {
      if (showAlert) showError();
      return false;
    }
    
    const isValid = checkPasswordStrength(state.password);
    
    if (!isValid) {
      if (showAlert) showError();
      return false;
    }
    
    saveToLocalStorage();
    console.log('✅ [Step 13bis] Password validation passed');
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
    
    const inputContainer = elements.passwordInput?.closest('.input-container');
    if (inputContainer) {
      inputContainer.classList.add('error-shake');
      setTimeout(() => inputContainer.classList.remove('error-shake'), 500);
    }
  }

  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'password_input') return;
    
    if (state.validationTimeout) {
      clearTimeout(state.validationTimeout);
    }
    
    state.validationTimeout = setTimeout(() => {
      requestAnimationFrame(() => {
        state.password = input.value;
        checkPasswordStrength(state.password);
        
        if (state.isValid) {
          saveToLocalStorage();
        }
        
        updateLocalNavigationButton();
        scheduleGlobalNavUpdate();
      });
    }, 150);
  }

  function initEventDelegation() {
    const elements = getCachedElements();
    
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
    }
    
    if (elements.toggleBtn) {
      elements.toggleBtn.addEventListener('click', togglePasswordVisibility);
    }
  }

  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if (elements.passwordInput && data.password) {
      elements.passwordInput.value = data.password;
      state.password = data.password;
    }
    
    requestAnimationFrame(() => {
      checkPasswordStrength(state.password);
      updateLocalNavigationButton();
      scheduleGlobalNavUpdate();
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
    
    console.log('✅ [Step 13bis] Password validation initialized');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>