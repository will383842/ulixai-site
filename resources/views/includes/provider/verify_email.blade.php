@csrf
<div id="step15" class="hidden">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }
    @keyframes glow-pulse {
      0%, 100% { 
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
      }
      50% { 
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.5);
      }
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }
    
    .shake {
      animation: shake 0.5s;
    }
    
    .otp-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      letter-spacing: 0.5em;
    }
    
    .otp-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
      transform: translateY(-2px);
      animation: glow-pulse 2s infinite;
    }
    
    .otp-input::placeholder {
      letter-spacing: normal;
    }
    
    .input-wrapper {
      transition: all 0.3s ease;
    }
    
    .input-wrapper:hover {
      transform: translateY(-2px);
    }
    
    .icon-badge {
      animation: float 3s ease-in-out infinite;
    }

    .ambient-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.2;
      pointer-events: none;
      z-index: 0;
    }
    
    .ambient-blob-1 {
      width: 300px;
      height: 300px;
      background: #93c5fd;
      top: -150px;
      left: -150px;
    }
    
    .ambient-blob-2 {
      width: 250px;
      height: 250px;
      background: #67e8f9;
      top: -100px;
      right: -100px;
    }
    
    .ambient-blob-3 {
      width: 200px;
      height: 200px;
      background: #5eead4;
      bottom: -100px;
      left: 50%;
      transform: translateX(-50%);
    }
  </style>

  <!-- Ambient background blobs -->
  <div class="ambient-blob ambient-blob-1"></div>
  <div class="ambient-blob ambient-blob-2"></div>
  <div class="ambient-blob ambient-blob-3"></div>

  <!-- Header -->
  <div class="mb-8 text-center relative z-10">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="icon-badge w-12 h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
        <span class="text-2xl">📬</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        Check Your Email
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Enter the 6-digit verification code
    </p>
  </div>

  <!-- Info banner -->
  <div class="mb-6 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 py-3 px-5 shadow-sm relative z-10">
    <div class="flex items-start gap-3">
      <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-base">💡</span>
      </div>
      <div class="flex-1">
        <p class="text-blue-900 font-semibold text-sm sm:text-base">Check your inbox (and spam folder)</p>
        <p class="text-blue-700 text-xs sm:text-sm font-medium mt-0.5">The code expires in 10 minutes</p>
      </div>
    </div>
  </div>

  <!-- OTP Input -->
  <div class="mb-8 relative z-10">
    <div class="input-wrapper">
      <label class="block text-gray-900 font-bold text-base mb-2 flex items-center gap-2">
        <span class="text-xl">🔐</span>
        <span class="text-blue-600">Verification Code</span>
      </label>
      <div class="relative">
        <input 
          id="otp_input" 
          type="text" 
          placeholder="● ● ● ● ● ●" 
          class="otp-input w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-2xl font-black text-center focus:outline-none bg-white transition-all shadow-sm placeholder:text-gray-300"
          maxlength="6"
          inputmode="numeric"
          pattern="[0-9]*"
        />
      </div>
      <p class="text-center text-xs text-gray-500 mt-2 font-medium">Enter the 6-digit code sent to your email</p>
    </div>
  </div>

  <!-- Error message -->
  <div id="otp_error" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-xl">❌</span>
      </div>
      <div>
        <p class="text-red-900 font-bold text-base"></p>
        <p class="text-red-700 text-sm font-medium mt-0.5">Please check your code and try again</p>
      </div>
    </div>
  </div>

  <!-- Success message -->
  <div id="otp_success" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 animate-bounce">
        <span class="text-xl">✅</span>
      </div>
      <div>
        <p class="text-green-900 font-bold text-lg">Email verified successfully!</p>
        <p class="text-green-700 text-sm font-medium mt-0.5">Redirecting you now...</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container relative z-10">
    <button id="backToStep14" type="button" class="nav-btn-back bg-white text-blue-600 border-2 border-gray-200">
      Back
    </button>
    <button id="nextStep15" type="button" class="nav-btn-next bg-gradient-to-r from-blue-600 to-cyan-600" disabled>
      Verify & Continue
    </button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const nextStepBtn = document.getElementById('nextStep15');
  const otpInput = document.getElementById('otp_input');
  const otpError = document.getElementById('otp_error');
  const otpSuccess = document.getElementById('otp_success');
  const closePopupBtn = document.getElementById('closePopup');
  let otpVerified = false;

  // Enable/disable button based on input
  otpInput.addEventListener('input', function() {
    const value = this.value.replace(/\D/g, ''); // Only numbers
    this.value = value;
    
    if (value.length === 6) {
      nextStepBtn.disabled = false;
      otpError.classList.add('hidden');
    } else {
      nextStepBtn.disabled = true;
    }
  });

  // Prevent closing popup if not verified
  if (closePopupBtn) {
    closePopupBtn.addEventListener('click', function(e) {
      if (!otpVerified) {
        e.stopPropagation();
        showError("You must verify your email before closing.");
      }
    });
  }

  function showError(message) {
    const errorP = otpError.querySelector('div > div > p:first-child');
    errorP.textContent = message;
    otpError.classList.remove('hidden');
    otpSuccess.classList.add('hidden');
    otpInput.classList.add('shake');
    otpError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    setTimeout(() => otpInput.classList.remove('shake'), 500);
  }

  nextStepBtn?.addEventListener('click', function (e) {
    e.preventDefault();
    
    const otp = otpInput.value.trim();
    
    if (!otp || otp.length !== 6) {
      showError("Please enter the 6-digit code.");
      return;
    }

    // Show loading
    nextStepBtn.disabled = true;
    const originalText = nextStepBtn.innerHTML;
    nextStepBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    const expats = JSON.parse(localStorage.getItem('expats')) || {};
    const email = expats.email;
    const token = document.querySelector('input[name="_token"]').value;
    
    fetch('/verify-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email, otp, _token: token }),
      credentials: 'same-origin'
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        otpVerified = true;
        otpError.classList.add('hidden');
        otpSuccess.classList.remove('hidden');
        
        // Clear localStorage
        localStorage.removeItem('expats');
        
        // Move to next step after delay
        setTimeout(() => {
          document.getElementById('step15').classList.add('hidden');
          document.getElementById('step16').classList.remove('hidden');
        }, 1500);
      } else {
        otpVerified = false;
        showError(data.message || "Invalid code. Please try again.");
        nextStepBtn.disabled = false;
        nextStepBtn.innerHTML = originalText;
      }
    })
    .catch(() => {
      otpVerified = false;
      showError("Verification failed. Please try again.");
      nextStepBtn.disabled = false;
      nextStepBtn.innerHTML = originalText;
    });
  });

  // Prevent closing with ESC if not verified
  document.addEventListener('keydown', function (e) {
    if (e.key === "Escape" && !otpVerified) {
      e.preventDefault();
      showError("You must verify your email before closing.");
    }
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep15');
    const stepElement = document.getElementById('step15');
    
    function checkValidation() {
        const otp = document.getElementById('otp_input')?.value.trim();
        const isValid = otp && otp.length === 6;
        if (nextBtn) {
            nextBtn.disabled = !isValid;
        }
    }
    
    // Observer les changements
    if (stepElement) {
        stepElement.addEventListener('input', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('change', () => setTimeout(checkValidation, 100));
    }
    
    // Vérification initiale
    setTimeout(checkValidation, 200);
});
</script>