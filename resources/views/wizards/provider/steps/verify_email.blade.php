<!-- 
============================================
🚀 STEP 15 - OTP VERIFICATION
============================================
✨ Design System Blue/Cyan/Teal STRICT
🔐 Code OTP 6 chiffres
🚫 AUCUN toastr/alert - 100% silencieux
✅ Messages inline uniquement
⚡ AUTO-LOGIN après validation OTP
============================================
-->

@csrf
<div id="step15" class="hidden flex flex-col h-full" role="region" aria-label="Verify your email">
  
  <!-- FIXED HEADER -->
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
          <span class="text-xl sm:text-2xl">📬</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Check Your Email 📧
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Enter the verification code we sent you
        </p>
      </div>

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

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto px-4 pt-4 space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-3 border-amber-300 rounded-xl p-5 sm:p-6 shadow-lg">
      <div class="flex items-start gap-3">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0">
          <span class="text-2xl">💡</span>
        </div>
        <div>
          <h3 class="text-amber-900 font-black text-lg sm:text-xl mb-2">Check your inbox</h3>
          <p class="text-amber-800 font-semibold text-sm sm:text-base">Don't forget to check your spam folder!</p>
          <p class="text-amber-700 font-medium text-xs sm:text-sm mt-1">The code expires in 10 minutes • Test code: <span class="font-mono bg-amber-200 px-2 py-0.5 rounded">111111</span></p>
        </div>
      </div>
    </div>

    <!-- OTP Input -->
    <div class="space-y-2">
      <label for="otp_input" class="flex items-center gap-2 text-sm sm:text-base font-bold text-gray-700">
        <span class="text-lg sm:text-xl">🔐</span>
        <span>Verification Code</span>
        <span class="text-red-500">*</span>
      </label>
      <div class="relative">
        <input 
          id="otp_input" 
          type="text" 
          placeholder="● ● ● ● ● ●" 
          class="w-full px-4 py-4 sm:py-5 bg-white border-2 border-gray-300 rounded-xl text-xl sm:text-2xl text-center font-bold
                 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                 transition-all duration-200 tracking-[0.5em]"
          maxlength="6"
          inputmode="numeric"
          pattern="[0-9]{6}"
          autocomplete="one-time-code"
          name="otp"
        />
      </div>
      <p class="text-xs sm:text-sm text-gray-500 text-center font-medium">Enter the 6-digit code sent to your email</p>
    </div>

    <!-- Verify Button -->
    <div class="flex justify-center">
      <button 
        type="button" 
        id="verifyOtpBtn" 
        class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 sm:px-10 py-3 sm:py-4 rounded-xl font-bold text-sm sm:text-base shadow-xl hover:shadow-2xl transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
        disabled
      >
        🔓 Verify Code
      </button>
    </div>

    <!-- Resend Button -->
    <div class="flex justify-center">
      <button 
        type="button" 
        id="resendOtpBtn" 
        class="text-blue-600 hover:text-blue-700 font-bold text-sm sm:text-base underline transition-colors flex items-center gap-2"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Didn't receive the code? Resend</span>
      </button>
    </div>

    <!-- Error Alert - SILENCIEUX -->
    <div id="step15Error" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 sm:p-4 fade-in" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-bold text-red-800" id="step15ErrorMessage">Invalid code</p>
          <p class="text-xs text-red-600 mt-1">Please check your code and try again</p>
        </div>
      </div>
    </div>

    <!-- Resend Success - SILENCIEUX -->
    <div id="step15ResendSuccess" class="hidden bg-blue-50 border-l-4 border-blue-500 rounded-xl p-3 sm:p-4 fade-in" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-bold text-blue-800">New code sent!</p>
          <p class="text-xs text-blue-600 mt-1">Check your email inbox (and spam folder)</p>
        </div>
      </div>
    </div>

    <!-- Success Alert -->
    <div id="step15Success" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3 sm:p-4 fade-in" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-bold text-green-800">Email verified successfully! 🎉</p>
          <p class="text-xs text-green-600 mt-1">Logging you in...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- STYLES -->
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

.border-3 {
  border-width: 3px;
}

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

@media (max-width: 639px) {
  #step15 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step15 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step15 p {
    font-size: 0.8125rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<script>
/**
 * ═══════════════════════════════════════════════════════════
 * STEP 15: Vérification OTP + AUTO-LOGIN
 * 🚫 AUCUN toastr/alert - 100% SILENCIEUX
 * 🔐 Connexion automatique après validation OTP
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
  const resendSuccessAlert = document.getElementById('step15ResendSuccess');
  const errorMessage = document.getElementById('step15ErrorMessage');
  const statusText = document.getElementById('step15StatusText');
  
  if (!otpInput) {
    console.warn('⚠️ [Step 15] OTP input not found');
    return;
  }
  
  function validateOtpFormat(otp) {
    return /^\d{6}$/.test(otp);
  }
  
  function updateVerifyButton() {
    const otp = otpInput.value.trim();
    const isValid = validateOtpFormat(otp);
    
    if (verifyBtn) {
      verifyBtn.disabled = !isValid;
    }
    
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
  
  function showError(message) {
    if (errorMessage) {
      errorMessage.textContent = message || 'Invalid code';
    }
    
    if (errorAlert) {
      errorAlert.classList.remove('hidden');
      
      requestAnimationFrame(() => {
        errorAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
    }
    
    if (successAlert) {
      successAlert.classList.add('hidden');
    }
    
    if (resendSuccessAlert) {
      resendSuccessAlert.classList.add('hidden');
    }
    
    if (statusText) {
      statusText.textContent = 'Verification failed';
    }
  }
  
  function showSuccess() {
    if (successAlert) {
      successAlert.classList.remove('hidden');
      
      requestAnimationFrame(() => {
        successAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
    }
    
    if (errorAlert) {
      errorAlert.classList.add('hidden');
    }
    
    if (resendSuccessAlert) {
      resendSuccessAlert.classList.add('hidden');
    }
    
    if (statusText) {
      statusText.textContent = 'Verified successfully!';
    }
  }
  
  function showResendSuccess() {
    if (resendSuccessAlert) {
      resendSuccessAlert.classList.remove('hidden');
      
      requestAnimationFrame(() => {
        resendSuccessAlert.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
      setTimeout(() => {
        resendSuccessAlert.classList.add('hidden');
      }, 5000);
    }
    
    if (errorAlert) {
      errorAlert.classList.add('hidden');
    }
  }
  
  async function verifyOTP() {
    const otpCode = otpInput.value.trim();
    
    if (!validateOtpFormat(otpCode)) {
      showError('Please enter a valid 6-digit code');
      return;
    }
    
    let data;
    try {
      data = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
      console.error('❌ [Step 15] Failed to read localStorage:', e);
      showError('System error. Please refresh the page.');
      return;
    }
    
    if (!data.email) {
      showError('Email not found. Please go back to Step 13.');
      return;
    }
    
    console.log('🔐 [Step 15] Verifying OTP:', otpCode, 'for email:', data.email);
    
    if (verifyBtn) {
      verifyBtn.disabled = true;
      verifyBtn.innerHTML = '<svg class="animate-spin h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Verifying...';
    }
    
    try {
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
      
      // ✅ OTP valide = auto-login côté serveur déjà fait
      if (response.ok && (result.status === 'success' || result.success)) {
        console.log('✅ [Step 15] OTP verified - User is now authenticated');
        
        showSuccess();
        
        // ✅ FORCER LE RECHARGEMENT DE LA PAGE pour afficher l'utilisateur connecté
        setTimeout(() => {
          console.log('🔄 [Step 15] Reloading page to show authenticated user...');
          window.location.reload();
        }, 1500);
        
      } else {
        console.error('❌ [Step 15] OTP verification failed:', result.message);
        
        showError(result.message || 'Invalid verification code');
        
        if (verifyBtn) {
          verifyBtn.disabled = false;
          verifyBtn.innerHTML = '🔓 Verify Code';
        }
        
        otpInput.value = '';
        otpInput.focus();
        updateVerifyButton();
      }
      
    } catch (error) {
      console.error('❌ [Step 15] Network error:', error);
      
      showError('Network error. Please try again.');
      
      if (verifyBtn) {
        verifyBtn.disabled = false;
        verifyBtn.innerHTML = '🔓 Verify Code';
      }
    }
  }
  
  async function resendOTP() {
    let data;
    try {
      data = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
    } catch (e) {
      console.error('❌ [Step 15] Failed to read localStorage:', e);
      showError('System error. Please refresh the page.');
      return;
    }
    
    if (!data.email) {
      showError('Email not found. Please go back to Step 13.');
      return;
    }
    
    console.log('📧 [Step 15] Resending OTP to:', data.email);
    
    if (resendBtn) {
      resendBtn.disabled = true;
      resendBtn.innerHTML = '<svg class="animate-spin h-4 w-4 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Sending...';
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
        showResendSuccess();
      } else {
        console.error('❌ [Step 15] Failed to resend OTP:', result.message);
        showError(result.message || 'Failed to resend code');
      }
      
    } catch (error) {
      console.error('❌ [Step 15] Network error:', error);
      showError('Failed to resend code. Please try again.');
      
    } finally {
      if (resendBtn) {
        resendBtn.disabled = false;
        resendBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg><span>Didn\'t receive the code? Resend</span>';
      }
    }
  }
  
  if (otpInput) {
    otpInput.addEventListener('input', updateVerifyButton);
    
    otpInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter' && verifyBtn && !verifyBtn.disabled) {
        verifyOTP();
      }
    });
  }
  
  if (verifyBtn) {
    verifyBtn.addEventListener('click', verifyOTP);
  }
  
  if (resendBtn) {
    resendBtn.addEventListener('click', resendOTP);
  }
  
  console.log('✅ [Step 15] OTP verification initialized (AUTO-LOGIN)');
})();
</script>