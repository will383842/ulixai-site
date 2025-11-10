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
============================================
-->

<div id="step13bis" class="hidden flex flex-col h-full" role="region" aria-label="Create your password">
  
  <!-- ============================================
       TITRE FIXE (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 blobs animés -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-1.5 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg ring-2 sm:ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-base sm:text-lg">🔒</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-lg sm:text-xl lg:text-2xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          Create Your Password
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600">
          Choose a strong password to secure your account
        </p>
      </div>

      <!-- Status Badge -->
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

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto px-4 py-3 space-y-2.5 sm:space-y-3">

    <!-- Info Banner -->
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

    <!-- Password Input -->
    <div class="space-y-1.5 sm:space-y-2">
      <label for="password_input" class="flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-gray-700">
        <span class="text-base sm:text-lg">🔐</span> Password <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <input
          type="password"
          id="password_input"
          name="password"
          autocomplete="new-password"
          placeholder="Enter your password"
          class="w-full px-3 py-2.5 sm:px-4 sm:py-3 pr-10 sm:pr-12 bg-white border-2 border-gray-200 rounded-xl text-sm sm:text-base
                 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                 transition-all duration-200"
          required
        />
        <button
          type="button"
          id="togglePasswordBtn"
          class="absolute right-2.5 sm:right-3 top-1/2 -translate-y-1/2 p-1.5 sm:p-2 text-gray-400 hover:text-gray-600 transition-colors"
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
      </div>

      <!-- Password Strength Indicator -->
      <div class="space-y-1.5">
        <div class="flex items-center gap-1">
          <div id="strengthBar1" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
          <div id="strengthBar2" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
          <div id="strengthBar3" class="h-1 sm:h-1.5 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
        </div>
        <p class="text-xs text-gray-500">Strength: <span id="strengthLevel" class="font-semibold">None</span></p>
      </div>

      <!-- Password Requirements -->
      <div class="mt-2 space-y-1.5 text-xs">
        <div id="reqLength" class="flex items-center gap-1.5 text-gray-500 transition-colors">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span class="text-xs">At least 6 characters</span>
        </div>
        <div id="reqUppercase" class="flex items-center gap-1.5 text-gray-500 transition-colors">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span class="text-xs">One uppercase letter</span>
        </div>
        <div id="reqNumber" class="flex items-center gap-1.5 text-gray-500 transition-colors">
          <span class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all flex-shrink-0">
            <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 hidden text-green-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <span class="text-xs">One number</span>
        </div>
      </div>
    </div>

    <!-- Error Alert (Hidden by default) -->
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

    <!-- Success Alert (Hidden by default) -->
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
</div>

<!-- ============================================
     STYLES OPTIMISÉS
     ============================================ -->
<style>
/* Animations des blobs - optimisé GPU */
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

/* Shake animation pour les erreurs */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

/* Password input validation states */
#step13bis #password_input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step13bis #password_input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  * {
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
}
</style>

<script>
/**
 * ═══════════════════════════════════════════════════════════
 * STEP 13BIS: Password Validation
 * ═══════════════════════════════════════════════════════════
 * ⚠️ RÈGLES: Min 6 caractères + 1 majuscule + 1 chiffre
 * ⚠️ FONCTION DE VALIDATION: validateStep13bis()
 * 🔇 100% SILENCIEUX - AUCUN TOASTR
 * ⚡ OPTIMISÉ - Debounce sur updateNavigationButtons
 */

(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  
  const passwordInput = document.getElementById('password_input');
  const toggleBtn = document.getElementById('togglePasswordBtn');
  const eyeOpen = document.getElementById('passwordEyeOpen');
  const eyeClosed = document.getElementById('passwordEyeClosed');
  
  const strengthBars = [
    document.getElementById('strengthBar1'),
    document.getElementById('strengthBar2'),
    document.getElementById('strengthBar3')
  ];
  const strengthLevel = document.getElementById('strengthLevel');
  
  const requirements = {
    length: document.getElementById('reqLength'),
    uppercase: document.getElementById('reqUppercase'),
    number: document.getElementById('reqNumber')
  };
  
  const errorAlert = document.getElementById('step13bisError');
  const successAlert = document.getElementById('step13bisSuccess');
  const statusText = document.getElementById('step13bisStatusText');
  
  if (!passwordInput) {
    console.warn('⚠️ [Step 13bis] Password input not found');
    return;
  }
  
  console.log('🔐 [Step 13bis] Password rules: Min 6 chars + 1 uppercase + 1 number');
  
  /**
   * Toggle password visibility
   */
  function togglePasswordVisibility() {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeOpen.classList.add('hidden');
      eyeClosed.classList.remove('hidden');
    } else {
      passwordInput.type = 'password';
      eyeOpen.classList.remove('hidden');
      eyeClosed.classList.add('hidden');
    }
  }
  
  if (toggleBtn) {
    toggleBtn.addEventListener('click', togglePasswordVisibility);
  }
  
  /**
   * Check password strength and requirements
   * ⚠️ RÈGLES: >= 6 caractères + majuscule + chiffre
   */
  function checkPasswordStrength(password) {
    let strength = 0;
    
    const checks = {
      length: password.length >= 6,        // ✅ Min 6 caractères
      uppercase: /[A-Z]/.test(password),   // ✅ Au moins 1 majuscule
      number: /[0-9]/.test(password)       // ✅ Au moins 1 chiffre
    };
    
    console.log('🔍 [Step 13bis] Password checks:', checks);
    
    // Update requirement indicators
    Object.keys(checks).forEach(key => {
      const req = requirements[key];
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
    
    // Update strength bars (3 bars pour 3 conditions)
    const colors = [
      { bg: 'bg-red-500', text: 'Weak', color: 'text-red-600' },
      { bg: 'bg-yellow-500', text: 'Fair', color: 'text-yellow-600' },
      { bg: 'bg-green-500', text: 'Strong', color: 'text-green-600' }
    ];
    
    strengthBars.forEach((bar, index) => {
      bar.className = 'h-1 sm:h-1.5 flex-1 rounded-full transition-all duration-300';
      if (index < strength) {
        bar.classList.add(colors[Math.min(strength - 1, 2)].bg);
      } else {
        bar.classList.add('bg-gray-200');
      }
    });
    
    // Update strength level text
    if (strength === 0) {
      strengthLevel.textContent = 'None';
      strengthLevel.className = 'text-gray-500 font-semibold';
    } else {
      const level = colors[Math.min(strength - 1, 2)];
      strengthLevel.textContent = level.text;
      strengthLevel.className = level.color + ' font-semibold';
    }
    
    // Update input styling
    if (password.length > 0) {
      if (strength >= 3) {
        passwordInput.classList.remove('invalid');
        passwordInput.classList.add('valid');
      } else {
        passwordInput.classList.remove('valid');
        passwordInput.classList.add('invalid');
      }
    } else {
      passwordInput.classList.remove('valid', 'invalid');
    }
    
    // Update status text
    if (statusText) {
      if (strength >= 3) {
        statusText.textContent = 'Strong password set';
      } else {
        statusText.textContent = 'Password not set';
      }
    }
    
    // Update alerts
    if (strength >= 3) {
      if (errorAlert) errorAlert.classList.add('hidden');
      if (successAlert) successAlert.classList.remove('hidden');
    } else {
      if (successAlert) successAlert.classList.add('hidden');
    }
    
    console.log('📊 [Step 13bis] Strength:', strength, '/3 -', strength >= 3 ? 'VALID ✅' : 'INVALID ❌');
    
    return strength >= 3;  // Les 3 conditions doivent être remplies
  }
  
  /**
   * Show error - SILENCIEUX (pas de toastr)
   */
  function showError() {
    console.log('🔴 [Step 13bis] Showing inline error (NO TOASTR)');
    
    if (errorAlert) {
      errorAlert.classList.remove('hidden');
      errorAlert.classList.add('shake-animation');
      
      // Scroll vers l'erreur
      requestAnimationFrame(() => {
        errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      setTimeout(() => {
        errorAlert.classList.remove('shake-animation');
      }, 500);
    }
  }
  
  /**
   * Save to localStorage
   */
  function saveToLocalStorage(password) {
    try {
      const data = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
      data.password = password;
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      console.log('💾 [Step 13bis] Password saved to localStorage');
    } catch (e) {
      console.warn('⚠️ [Step 13bis] Failed to save to localStorage:', e);
    }
  }
  
  /**
   * ═══════════════════════════════════════════════════════════
   * VALIDATION GLOBALE: validateStep13bis()
   * 🔇 100% SILENCIEUX - AUCUN TOASTR
   * ⚠️ RÈGLES: >= 6 chars + majuscule + chiffre
   * ═══════════════════════════════════════════════════════════
   */
  window.validateStep13bis = function() {
    console.log('🔍 [Step 13bis] validateStep13bis() called');
    
    const password = passwordInput.value;
    
    if (!password) {
      console.warn('⚠️ [Step 13bis] Password is empty');
      showError();
      return false;
    }
    
    const isValid = checkPasswordStrength(password);
    
    if (!isValid) {
      console.warn('⚠️ [Step 13bis] Password does not meet requirements');
      console.warn('   Required: >= 6 chars + 1 uppercase + 1 number');
      showError();
      return false;
    }
    
    saveToLocalStorage(password);
    console.log('✅ [Step 13bis] Password validation passed');
    return true;
  };
  
  /**
   * Input event listener - OPTIMISÉ avec debounce
   */
  let inputDebounceTimeout = null;
  
  passwordInput.addEventListener('input', function() {
    const password = this.value;
    
    // Mise à jour immédiate de l'UI (pas de lag)
    checkPasswordStrength(password);
    
    // Sauvegarder avec debounce
    if (checkPasswordStrength(password)) {
      saveToLocalStorage(password);
    }
    
    // ⚡ OPTIMISATION : Debounce pour updateNavigationButtons
    if (inputDebounceTimeout) {
      clearTimeout(inputDebounceTimeout);
    }
    
    inputDebounceTimeout = setTimeout(() => {
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }, 300); // Appel retardé de 300ms
  });
  
  /**
   * Restore data from localStorage
   */
  function restoreData() {
    try {
      const data = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
      if (data.password) {
        passwordInput.value = data.password;
        checkPasswordStrength(data.password);
        console.log('🔄 [Step 13bis] Password restored from localStorage');
      }
    } catch (e) {
      console.warn('⚠️ [Step 13bis] Failed to restore from localStorage:', e);
    }
  }
  
  // Observer pour restaurer les données quand le step devient visible
  const step13bis = document.getElementById('step13bis');
  if (step13bis) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
          if (!step13bis.classList.contains('hidden')) {
            restoreData();
          }
        }
      });
    });
    
    observer.observe(step13bis, { attributes: true });
  }
  
  restoreData();
  
  console.log('✅ [Step 13bis] Password validation initialized (SILENT MODE - NO TOASTR - OPTIMIZED - COMPACT)');
  console.log('🔐 Rules: Min 6 characters + 1 uppercase + 1 number');
})();
</script>