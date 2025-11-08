<!-- 
============================================
🚀 STEP 13 - EMAIL INPUT - VERSION PROPRE
✅ Le JS ne touche JAMAIS au style
============================================
-->

<div id="step13" class="hidden flex flex-col h-full" role="region" aria-label="Enter your email">
  
  <!-- TITRE FIXE (STICKY) -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-lg sm:text-xl">📧</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What's Your Email? 📬
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          We'll use this to keep you updated
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step13StatusText">
          Email not provided
        </span>
      </div>
    </div>
  </div>

  <!-- CONTENU SCROLLABLE -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-3">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-base">ℹ️</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-bold text-sm sm:text-base">Required for communication</p>
          <p class="text-blue-700 text-xs sm:text-sm font-medium mt-1">Enter a valid email address to receive updates and notifications</p>
        </div>
      </div>
    </div>

    <!-- Email Input -->
    <div class="input-container">
      <label class="input-label">
        <span class="text-lg sm:text-xl">✉️</span>
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
          <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
      <p class="input-hint">We'll never share your email with anyone else</p>
    </div>

    <!-- Error Alert -->
    <div id="step13Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Invalid email address</p>
          <p class="text-xs text-red-600 mt-0.5">Please enter a valid email (e.g., name@example.com)</p>
        </div>
      </div>
    </div>

    <!-- Success Alert -->
    <div id="step13Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-green-800">Valid email address!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Blob animations */
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
  will-change: transform;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Shake animation */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

/* Input Styles */
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
  gap: 0.5rem;
  margin-bottom: 0.625rem;
  font-weight: 700;
  font-size: 0.875rem;
}

@media (min-width: 640px) {
  #step13 .input-label {
    font-size: 1rem;
  }
}

#step13 .label-text {
  font-weight: 800;
}

#step13 .label-blue {
  color: #2563eb;
}

#step13 .input-wrapper {
  position: relative;
  width: 100%;
}

#step13 .email-input {
  width: 100%;
  padding: 0.875rem 3rem 0.875rem 1.25rem;
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
    padding: 1rem 3rem 1rem 1.25rem;
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
  padding-right: 3rem;
}

#step13 .email-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step13 .success-indicator {
  position: absolute;
  right: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  width: 2rem;
  height: 2rem;
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
    width: 2.25rem;
    height: 2.25rem;
  }
}

#step13 .email-input.valid ~ .success-indicator {
  display: flex;
  opacity: 1;
  animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
  0% {
    transform: translateY(-50%) scale(0);
  }
  50% {
    transform: translateY(-50%) scale(1.1);
  }
  100% {
    transform: translateY(-50%) scale(1);
  }
}

#step13 .input-hint {
  margin-top: 0.5rem;
  font-size: 0.75rem;
  color: #6b7280;
  font-weight: 500;
}

@media (min-width: 640px) {
  #step13 .input-hint {
    font-size: 0.875rem;
  }
}

/* Error shake */
#step13 .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms;
    animation-iteration-count: 1;
    transition-duration: 0.01ms;
  }
}
</style>

<script>
(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  const EMAIL_REGEX = /^[a-zA-Z0-9](?:[a-zA-Z0-9._+-]{0,62}[a-zA-Z0-9])?@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z]{2,})+$/;
  
  const state = {
    email: '',
    isValid: false,
    saveTimeout: null,
    validationTimeout: null
  };

  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step13'),
        emailInput: document.getElementById('email_input'),
        errorAlert: document.getElementById('step13Error'),
        successAlert: document.getElementById('step13Success'),
        statusText: document.getElementById('step13StatusText')
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
    if (!email || email.length === 0) {
      return false;
    }
    
    if (email.length < 5 || email.length > 100) {
      return false;
    }
    
    return EMAIL_REGEX.test(email);
  }

  function updateValidationState() {
    const elements = getCachedElements();
    
    state.email = elements.emailInput.value.trim();
    state.isValid = validateEmail(state.email);
    
    if (state.email.length > 0) {
      if (state.isValid) {
        elements.emailInput.classList.remove('invalid');
        elements.emailInput.classList.add('valid');
      } else {
        elements.emailInput.classList.remove('valid');
        elements.emailInput.classList.add('invalid');
      }
    } else {
      elements.emailInput.classList.remove('valid', 'invalid');
    }
    
    if (elements.statusText) {
      if (state.isValid) {
        elements.statusText.textContent = 'Valid email provided';
      } else {
        elements.statusText.textContent = 'Email not provided';
      }
    }
    
    if (state.isValid) {
      if (elements.errorAlert) elements.errorAlert.classList.add('hidden');
      if (elements.successAlert) elements.successAlert.classList.remove('hidden');
    } else {
      if (elements.successAlert) elements.successAlert.classList.add('hidden');
    }
    
    return state.isValid;
  }

  // ✅ Validation globale
  window.validateStep13 = function() {
    const elements = getCachedElements();
    
    if (!updateValidationState()) {
      showError();
      return false;
    }
    
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
        }
        
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      });
    }, 300);
  }

  function handleBlur(e) {
    const input = e.target;
    if (!input || input.id !== 'email_input') return;
    
    requestAnimationFrame(() => {
      updateValidationState();
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    });
  }

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
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
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
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>