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
✅ Persistance localStorage avec clé 'expats'
⚡ Performance maximale
🔑 Code de test: 111111 (pour développement)
✅ CONFORME AU GUIDE SYSTÈME WIZARD
🔧 Appel de la soumission finale après vérification OTP
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
          Check Your Email
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
  <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4">

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
    <div class="space-y-2">
      <label for="otp_input" class="block text-sm font-semibold text-gray-700">
        <span class="text-lg">🔐</span> Verification Code <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <input 
          id="otp_input" 
          type="text" 
          placeholder="● ● ● ● ● ●" 
          class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-2xl text-center font-bold
                 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                 transition-all duration-200 tracking-widest"
          maxlength="6"
          inputmode="numeric"
          pattern="[0-9]{6}"
          autocomplete="one-time-code"
          name="otp"
        />
      </div>
      <p class="text-xs text-gray-500 text-center mt-1">Enter the 6-digit code sent to your email</p>
    </div>

    <!-- Verify Button -->
    <div class="flex justify-center">
      <button 
        type="button" 
        id="verifyOtpBtn" 
        class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
        disabled
      >
        Verify Code
      </button>
    </div>

    <!-- Resend Button -->
    <div class="flex justify-center">
      <button 
        type="button" 
        id="resendOtpBtn" 
        class="text-blue-600 hover:text-blue-700 font-semibold text-sm underline transition-colors"
      >
        Resend Code
      </button>
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
          <p class="text-xs text-green-600 mt-0.5">Creating your account...</p>
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

/* Glow pulse animation pour le focus */
@keyframes glow-pulse {
  0%, 100% { 
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 0 15px rgba(59, 130, 246, 0.2);
  }
  50% { 
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15), 0 0 25px rgba(59, 130, 246, 0.3);
  }
}

#step15 #otp_input:focus {
  animation: glow-pulse 2s ease-in-out infinite;
}

#step15 #otp_input.valid {
  border-color: #10b981;
  background-color: #f0fdf4;
}

#step15 #otp_input.invalid {
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
</style>

<script>
/**
 * ═══════════════════════════════════════════════════════════
 * STEP 15: Vérification OTP + Soumission Finale
 * ═══════════════════════════════════════════════════════════
 */

(function() {
  'use strict';
  
  const STORAGE_KEY = 'expats';
  
  const otpInput = document.getElementById('otp_input');
  const verifyBtn = document.getElementById('verifyOtpBtn');
  const resendBtn = document.getElementById('resendOtpBtn');
  const errorAlert = document.getElementById('step15Error');
  const successAlert = document.getElementById('step15Success');
  const errorMessage = document.getElementById('step15ErrorMessage');
  const statusText = document.getElementById('step15StatusText');
  
  if (!otpInput) {
    console.warn('⚠️ [Step 15] OTP input not found');
    return;
  }
  
  /**
   * Validation du format OTP
   */
  function validateOtpFormat(otp) {
    return /^\d{6}$/.test(otp);
  }
  
  /**
   * Activer/désactiver le bouton verify
   */
  function updateVerifyButton() {
    const otp = otpInput.value.trim();
    const isValid = validateOtpFormat(otp);
    
    if (verifyBtn) {
      verifyBtn.disabled = !isValid;
    }
    
    // Mise à jour des classes CSS
    if (otp.length > 0) {
      if (isValid) {
        otpInput.classList.remove('invalid');
        otpInput.classList.add('valid');
      } else {
        otpInput.classList.remove('valid');
        otpInput.classList.add('invalid');
      }
    } else {
      otpInput.classList.remove('valid', 'invalid');
    }
  }
  
  /**
   * Afficher une erreur
   */
  function showError(message) {
    if (errorMessage) {
      errorMessage.textContent = message || 'Invalid code';
    }
    
    if (errorAlert) {
      errorAlert.classList.remove('hidden');
      errorAlert.classList.add('shake-animation');
      
      setTimeout(() => {
        errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    
    if (successAlert) {
      successAlert.classList.add('hidden');
    }
    
    if (statusText) {
      statusText.textContent = 'Verification failed';
    }
  }
  
  /**
   * Afficher le succès
   */
  function showSuccess() {
    if (successAlert) {
      successAlert.classList.remove('hidden');
    }
    
    if (errorAlert) {
      errorAlert.classList.add('hidden');
    }
    
    if (statusText) {
      statusText.textContent = 'Verified successfully!';
    }
  }
  
  /**
   * Vérifier l'OTP auprès du serveur
   */
  async function verifyOTP() {
    const otpCode = otpInput.value.trim();
    
    if (!validateOtpFormat(otpCode)) {
      if (typeof toastr !== 'undefined') {
        toastr.error('Please enter a valid 6-digit code', 'Invalid Code');
      }
      showError('Please enter a valid 6-digit code');
      return;
    }
    
    // Récupérer l'email depuis localStorage
    let data;
    try {
      data = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
      console.error('❌ [Step 15] Failed to read localStorage:', e);
      if (typeof toastr !== 'undefined') {
        toastr.error('System error. Please refresh the page.', 'Error');
      }
      return;
    }
    
    if (!data.email) {
      if (typeof toastr !== 'undefined') {
        toastr.error('Email not found. Please go back to Step 13.', 'Error');
      }
      showError('Email not found');
      return;
    }
    
    console.log('🔐 [Step 15] Verifying OTP:', otpCode, 'for email:', data.email);
    
    // Désactiver le bouton et afficher le loader
    if (verifyBtn) {
      verifyBtn.disabled = true;
      verifyBtn.innerHTML = '<svg class="animate-spin h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Verifying...';
    }
    
    try {
      // Appeler l'API de vérification OTP
      const response = await fetch('/verify-email-otp', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          email: data.email,
          otp: otpCode
        })
      });
      
      const result = await response.json();
      
      if (response.ok) {
        console.log('✅ [Step 15] OTP verified successfully');
        
        showSuccess();
        
        if (typeof toastr !== 'undefined') {
          toastr.success('Email verified successfully!', 'Success');
        }
        
        // ═══════════════════════════════════════════════════════════
        // CRITIQUE: Appeler la soumission finale
        // ═══════════════════════════════════════════════════════════
        console.log('📤 [Step 15] Calling final submission...');
        
        setTimeout(() => {
          if (typeof window.onProviderSignupSubmit === 'function') {
            console.log('✅ [Step 15] Calling window.onProviderSignupSubmit()');
            window.onProviderSignupSubmit();
          } else {
            console.error('❌ [Step 15] window.onProviderSignupSubmit is not defined!');
            if (typeof toastr !== 'undefined') {
              toastr.error('System error. Please refresh the page.', 'Error');
            }
          }
        }, 1500); // Délai de 1.5s pour montrer le message de succès
        
      } else {
        // OTP invalide
        console.error('❌ [Step 15] OTP verification failed:', result.message);
        
        showError(result.message || 'Invalid verification code');
        
        if (typeof toastr !== 'undefined') {
          toastr.error(result.message || 'Invalid verification code', 'Error');
        }
        
        // Réactiver le bouton
        if (verifyBtn) {
          verifyBtn.disabled = false;
          verifyBtn.innerHTML = 'Verify Code';
        }
        
        // Effacer l'input
        otpInput.value = '';
        otpInput.focus();
        updateVerifyButton();
      }
      
    } catch (error) {
      console.error('❌ [Step 15] Network error:', error);
      
      showError('Network error. Please try again.');
      
      if (typeof toastr !== 'undefined') {
        toastr.error('Failed to verify code. Please try again.', 'Network Error');
      }
      
      // Réactiver le bouton
      if (verifyBtn) {
        verifyBtn.disabled = false;
        verifyBtn.innerHTML = 'Verify Code';
      }
    }
  }
  
  /**
   * Renvoyer le code OTP
   */
  async function resendOTP() {
    let data;
    try {
      data = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
      console.error('❌ [Step 15] Failed to read localStorage:', e);
      if (typeof toastr !== 'undefined') {
        toastr.error('System error. Please refresh the page.', 'Error');
      }
      return;
    }
    
    if (!data.email) {
      if (typeof toastr !== 'undefined') {
        toastr.error('Email not found', 'Error');
      }
      return;
    }
    
    console.log('📧 [Step 15] Resending OTP to:', data.email);
    
    if (resendBtn) {
      resendBtn.disabled = true;
      resendBtn.innerHTML = 'Sending...';
    }
    
    try {
      const response = await fetch('/resend-email-otp', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ email: data.email })
      });
      
      const result = await response.json();
      
      if (response.ok) {
        console.log('✅ [Step 15] OTP resent successfully');
        
        if (typeof toastr !== 'undefined') {
          toastr.success('New code sent to your email!', 'Success');
        }
      } else {
        console.error('❌ [Step 15] Failed to resend OTP:', result.message);
        
        if (typeof toastr !== 'undefined') {
          toastr.error(result.message || 'Failed to resend code', 'Error');
        }
      }
      
    } catch (error) {
      console.error('❌ [Step 15] Network error:', error);
      
      if (typeof toastr !== 'undefined') {
        toastr.error('Failed to resend code', 'Network Error');
      }
    } finally {
      if (resendBtn) {
        resendBtn.disabled = false;
        resendBtn.innerHTML = 'Resend Code';
      }
    }
  }
  
  /**
   * Event listeners
   */
  
  // Input OTP - mise à jour du bouton verify
  if (otpInput) {
    otpInput.addEventListener('input', updateVerifyButton);
    
    // Soumission avec Enter
    otpInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter' && !verifyBtn.disabled) {
        verifyOTP();
      }
    });
  }
  
  // Bouton verify
  if (verifyBtn) {
    verifyBtn.addEventListener('click', verifyOTP);
  }
  
  // Bouton resend
  if (resendBtn) {
    resendBtn.addEventListener('click', resendOTP);
  }
  
  console.log('✅ [Step 15] OTP verification initialized');
})();
</script>