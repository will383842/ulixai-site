<!-- 
============================================
🚀 STEP 15 - OTP VERIFICATION (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Code OTP 6 chiffres avec validation
💎 Indicateurs visuels de succès/erreur
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Fetch API pour vérification
⚡ Performance maximale
🔑 Code de test: 111111 (pour développement)
============================================
-->

@csrf
<div id="step15" class="hidden flex flex-col h-full" role="region" aria-label="Verify your email">
  
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
    <div class="text-center space-y-2 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-lg sm:text-xl">📬</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Check Your Email 📧
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Enter the verification code
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700" id="step15StatusText">
          Awaiting verification
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-3">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-base">💡</span>
        </div>
        <div class="flex-1">
          <p class="text-blue-900 font-bold text-sm sm:text-base">Check your inbox (and spam folder)</p>
          <p class="text-blue-700 text-xs sm:text-sm font-medium mt-1">The code expires in 10 minutes • Test code: 111111</p>
        </div>
      </div>
    </div>

    <!-- OTP Input -->
    <div class="input-container">
      <label class="input-label">
        <span class="text-lg sm:text-xl">🔐</span>
        <span class="label-text label-blue">Verification Code</span>
      </label>
      <div class="input-wrapper">
        <input 
          id="otp_input" 
          type="text" 
          placeholder="● ● ● ● ● ●" 
          class="otp-input"
          maxlength="6"
          inputmode="numeric"
          pattern="[0-9]{6}"
          autocomplete="one-time-code"
        / name="otp">
      </div>
      <p class="input-hint">Enter the 6-digit code sent to your email (or 111111 for testing)</p>
    </div>

    <!-- Error Alert (Hidden by default) -->
    <div id="step15Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800" id="step15ErrorMessage">Invalid code</p>
          <p class="text-xs text-red-600 mt-0.5">Please check your code and try again</p>
        </div>
      </div>
    </div>

    <!-- Success Alert (Hidden by default) -->
    <div id="step15Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-green-800">Email verified successfully!</p>
          <p class="text-xs text-green-600 mt-0.5">Redirecting you now...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ============================================
     STYLES OPTIMISÉS
     ============================================ -->
<style>
/* ============================================
   🎨 BASE STYLES
   ============================================ */

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

/* Glow pulse animation pour le focus */
@keyframes glow-pulse {
  0%, 100% { 
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 0 15px rgba(59, 130, 246, 0.2);
  }
  50% { 
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15), 0 0 25px rgba(59, 130, 246, 0.3);
  }
}

/* ============================================
   📝 INPUT STYLES
   ============================================ */

#step15 .input-container {
  width: 100%;
  transition: transform 0.3s ease;
}

#step15 .input-container:hover {
  transform: translateY(-2px);
}

#step15 .input-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.625rem;
  font-weight: 700;
  font-size: 0.875rem;
}

@media (min-width: 640px) {
  #step15 .input-label {
    font-size: 1rem;
  }
}

#step15 .label-text {
  font-weight: 800;
}

#step15 .label-blue {
  color: #2563eb;
}

#step15 .input-wrapper {
  position: relative;
  width: 100%;
}

#step15 .otp-input {
  width: 100%;
  padding: 1rem 1.25rem;
  border: 2px solid #d1d5db;
  border-radius: 0.75rem;
  font-size: 1.5rem;
  font-weight: 600;
  background: white;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  outline: none;
  text-align: center;
  letter-spacing: 0.5em;
  font-family: 'Courier New', monospace;
}

@media (min-width: 640px) {
  #step15 .otp-input {
    padding: 1.25rem;
    font-size: 2rem;
    letter-spacing: 0.6em;
  }
}

#step15 .otp-input:focus {
  border-color: #3b82f6;
  animation: glow-pulse 2s ease-in-out infinite;
}

#step15 .otp-input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step15 .otp-input.invalid {
  border-color: #ef4444;
  background-color: #fef2f2;
}

#step15 .otp-input::placeholder {
  letter-spacing: 0.5em;
  color: #d1d5db;
}

#step15 .input-hint {
  margin-top: 0.5rem;
  font-size: 0.75rem;
  color: #6b7280;
  font-weight: 500;
  text-align: center;
}

@media (min-width: 640px) {
  #step15 .input-hint {
    font-size: 0.875rem;
  }
}

/* Error shake animation */
#step15 .input-container.error-shake {
  animation: shake 0.5s ease-in-out;
}
</style>

<script>
/* ============================================
   🎯 STEP 15 - OTP VERIFICATION
   ✅ Activation/désactivation des boutons
   ✅ Validation OTP (6 chiffres ou code test 111111)
   ✅ Code de test pour développement: 111111
   ✅ Fetch API pour vérification réelle
   ============================================ */

(function() {
  'use strict';

  // ============================================
  // 📦 STATE & CONSTANTS
  // ============================================
  
  const TEST_CODE = '111111'; // Code de test pour le développement
  
  const state = {
    otp: '',
    isValid: false,
    isVerifying: false,
    isVerified: false,
    originalButtonText: ''
  };

  // ============================================
  // 🗄️ CACHE DOM ELEMENTS
  // ============================================
  
  let cachedElements = null;

  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step15'),
        otpInput: document.getElementById('otp_input'),
        errorAlert: document.getElementById('step15Error'),
        errorMessage: document.getElementById('step15ErrorMessage'),
        successAlert: document.getElementById('step15Success'),
        statusText: document.getElementById('step15StatusText'),
        csrfToken: document.querySelector('input[name="_token"]')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCAL STORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch {
      return {};
    }
  }

  function clearLocalStorage() {
    try {
      localStorage.removeItem('step15_otp');
    } catch (e) {
      console.warn('localStorage error:', e);
    }
  }

  // ============================================
  // ✅ VALIDATION
  // ============================================
  
  function validateOTP() {
    const elements = getCachedElements();
    
    state.otp = elements.otpInput.value.trim();
    
    // Validation: 6 chiffres OU code de test (8 chiffres)
    const is6Digits = /^\d{6}$/.test(state.otp);
    const isTestCode = state.otp === TEST_CODE;
    state.isValid = is6Digits || isTestCode;
    
    // Mise à jour des classes CSS
    if (state.otp.length > 0) {
      if (state.isValid) {
        elements.otpInput.classList.remove('invalid');
        elements.otpInput.classList.add('valid');
      } else {
        elements.otpInput.classList.remove('valid');
        elements.otpInput.classList.add('invalid');
      }
    } else {
      elements.otpInput.classList.remove('valid', 'invalid');
    }
    
    // Mise à jour du texte de statut
    if (elements.statusText) {
      if (state.isValid) {
        if (isTestCode) {
          elements.statusText.textContent = 'Test code entered';
        } else {
          elements.statusText.textContent = 'Code ready for verification';
        }
      } else {
        elements.statusText.textContent = 'Awaiting verification';
      }
    }
    
    // Mettre à jour l'état des boutons
    updateStep15Buttons();
    
    return state.isValid;
  }

  // ============================================
  // 🔘 BUTTON STATE MANAGEMENT
  // ============================================
  
  function updateStep15Buttons() {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    if (state.isValid && !state.isVerifying) {
      // Si le code est valide et qu'on n'est pas en train de vérifier, activer les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = false;
      if (desktopNextBtn) desktopNextBtn.disabled = false;
    } else {
      // Sinon, désactiver les boutons
      if (mobileNextBtn) mobileNextBtn.disabled = true;
      if (desktopNextBtn) desktopNextBtn.disabled = true;
    }
  }

  // ============================================
  // 🎨 UI UPDATES
  // ============================================
  
  function showError(message) {
    const elements = getCachedElements();
    
    if (elements.errorMessage) {
      elements.errorMessage.textContent = message || 'Invalid code';
    }
    
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      
      // Scroll vers l'erreur
      requestAnimationFrame(() => {
        elements.errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      // Retirer l'animation après
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    
    if (elements.successAlert) {
      elements.successAlert.classList.add('hidden');
    }
    
    // Shake sur l'input container
    const inputContainer = elements.otpInput?.closest('.input-container');
    if (inputContainer) {
      inputContainer.classList.add('error-shake');
      setTimeout(() => inputContainer.classList.remove('error-shake'), 500);
    }
    
    // Marquer l'input comme invalide
    elements.otpInput.classList.remove('valid');
    elements.otpInput.classList.add('invalid');
  }

  function showSuccess() {
    const elements = getCachedElements();
    
    if (elements.successAlert) {
      elements.successAlert.classList.remove('hidden');
    }
    
    if (elements.errorAlert) {
      elements.errorAlert.classList.add('hidden');
    }
    
    if (elements.statusText) {
      elements.statusText.textContent = 'Verified successfully!';
    }
  }

  // ============================================
  // 🌐 API VERIFICATION
  // ============================================
  
  async function verifyOTP() {
    const elements = getCachedElements();
    const expats = getLocalStorage();
    
    // Si c'est le code de test, valider directement
    if (state.otp === TEST_CODE) {
      state.isVerified = true;
      showSuccess();
      
      // Clear localStorage
      clearLocalStorage();
      
      // Redirection après délai
      setTimeout(() => {
        const step15 = document.getElementById('step15');
        const step16 = document.getElementById('step16');
        
        if (step15) step15.classList.add('hidden');
        if (step16) step16.classList.remove('hidden');
      }, 1500);
      
      return;
    }
    
    // Sinon, vérifier via API
    if (!expats.email) {
      showError('Email not found. Please go back and enter your email.');
      return;
    }
    
    if (!elements.csrfToken) {
      showError('Security token not found. Please refresh the page.');
      return;
    }
    
    state.isVerifying = true;
    updateStep15Buttons(); // Désactiver les boutons pendant la vérification
    
    try {
      const response = await fetch('/verify-email-otp', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': elements.csrfToken.value,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ 
          email: expats.email, 
          otp: state.otp,
          _token: elements.csrfToken.value
        }),
        credentials: 'same-origin'
      });
      
      const data = await response.json();
      
      if (data.status === 'success') {
        state.isVerified = true;
        showSuccess();
        
        // Clear localStorage
        clearLocalStorage();
        
        // Redirection après délai
        setTimeout(() => {
          const step15 = document.getElementById('step15');
          const step16 = document.getElementById('step16');
          
          if (step15) step15.classList.add('hidden');
          if (step16) step16.classList.remove('hidden');
        }, 1500);
      } else {
        state.isVerified = false;
        showError(data.message || 'Invalid code. Please try again.');
      }
    } catch (error) {
      console.error('Verification error:', error);
      state.isVerified = false;
      showError('Verification failed. Please check your connection and try again.');
    } finally {
      state.isVerifying = false;
      updateStep15Buttons(); // Réactiver les boutons
    }
  }

  // Fonction globale pour la vérification (appelée par le bouton du header)
  window.verifyStep15OTP = function() {
    if (!validateOTP()) {
      showError('Please enter a valid code (6 digits or test code 111111).');
      return false;
    }
    
    if (state.isVerifying) {
      return false;
    }
    
    verifyOTP();
    return true;
  };

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleInput(e) {
    const input = e.target;
    if (!input || input.id !== 'otp_input') return;
    
    // Ne garder que les chiffres
    const value = input.value.replace(/\D/g, '');
    input.value = value;
    
    // Valider en temps réel
    requestAnimationFrame(() => {
      validateOTP();
    });
    
    // Auto-verify si code complet (6 ou 8 chiffres)
    if (value.length === 6 || value.length === 8) {
      setTimeout(() => {
        if (validateOTP()) {
          // Le code est valide, on peut activer le bouton
          // L'utilisateur devra cliquer sur le bouton pour vérifier
        }
      }, 300);
    }
  }

  // Empêcher la fermeture si non vérifié
  function handleEscapeKey(e) {
    if (e.key === 'Escape' && !state.isVerified) {
      e.preventDefault();
      showError('You must verify your email before closing.');
    }
  }

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const elements = getCachedElements();
    
    // Event delegation sur le step
    if (elements.step) {
      elements.step.addEventListener('input', handleInput, { passive: true });
    }
    
    // Touche Escape
    document.addEventListener('keydown', handleEscapeKey);
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    
    // Focus automatique sur l'input
    if (elements.otpInput) {
      requestAnimationFrame(() => {
        elements.otpInput.focus();
      });
    }
    
    // Valider l'état initial
    validateOTP();
  }

  // ============================================
  // 🧹 CLEANUP
  // ============================================
  
  function cleanup() {
    document.removeEventListener('keydown', handleEscapeKey);
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    // Init event delegation
    initEventDelegation();

    // Observer pour détecter quand le step devient visible
    const elements = getCachedElements();
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              // Step est visible, restaurer l'état
              restoreState();
            } else {
              // Step est caché, cleanup
              cleanup();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restaurer l'état initial si visible
    if (elements.step && !elements.step.classList.contains('hidden')) {
      restoreState();
    }
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>
<script>
document.addEventListener('input',  function(){ if (window.providerWizard) providerWizard.update(); }, true);
document.addEventListener('change', function(){ if (window.providerWizard) providerWizard.update(); }, true);
document.addEventListener('click',  function(){ if (window.providerWizard) providerWizard.update(); }, true);
</script>

<script>
  // Validation Step 15: OTP code present (6-8 digits)
  window.validateStep15 = function() {
    const el = document.getElementById('otp_input');
    if (!el) return false;
    const v = (el.value || '').trim();
    return /^\d{6,8}$/.test(v);
  };
  document.getElementById('otp_input')?.addEventListener('input', () => {
    if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
  });
</script>
