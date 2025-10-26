@csrf
<div id="step15" class="hidden">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }
    @keyframes glow-pulse {
      0%, 100% { 
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.5),
                    0 0 40px rgba(16, 185, 129, 0.3),
                    0 0 60px rgba(16, 185, 129, 0.2);
      }
      50% { 
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.6),
                    0 0 50px rgba(16, 185, 129, 0.4),
                    0 0 80px rgba(16, 185, 129, 0.3);
      }
    }
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
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
      position: relative;
      letter-spacing: 0.5em;
    }
    .otp-input:focus {
      box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.3),
                  0 8px 24px rgba(16, 185, 129, 0.4);
      border-color: #10b981;
      transform: translateY(-3px) scale(1.01);
      animation: glow-pulse 2s infinite;
    }
    .otp-input::placeholder {
      color: #9ca3af;
      letter-spacing: normal;
    }
    .input-wrapper {
      position: relative;
      overflow: hidden;
      animation: glow-pulse 3s infinite;
    }
    .input-wrapper::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
      animation: shimmer 2s infinite;
    }
    .input-wrapper:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4);
    }
    .icon-badge {
      animation: float 3s ease-in-out infinite;
    }
    .label-badge {
      animation: glow-pulse 2s infinite;
    }
  </style>

  <!-- Header premium avec gradient et animation -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="icon-badge w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-3xl flex items-center justify-center shadow-2xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-4xl">📬</span>
      </div>
      <h2 class="font-black text-4xl sm:text-5xl bg-gradient-to-r from-green-600 via-emerald-500 to-green-600 bg-clip-text text-transparent">
        Check Your Email
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Enter the 6-digit verification code
    </p>
  </div>

  <!-- Alert premium -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 border-2 border-blue-200 py-4 px-6 shadow-lg">
    <div class="flex items-start gap-4">
      <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">💡</span>
      </div>
      <div class="flex-1">
        <p class="text-blue-900 font-bold text-sm sm:text-base">Check your inbox (and spam folder)</p>
        <p class="text-blue-700 text-sm font-semibold mt-1">The code expires in 10 minutes</p>
      </div>
    </div>
  </div>

  <!-- OTP Input TRÈS VOYANT -->
  <div class="mb-8">
    <div class="input-wrapper relative bg-gradient-to-br from-green-100 via-emerald-200 to-teal-200 rounded-3xl p-8 border-4 border-green-500 shadow-2xl hover:shadow-green-500/50 transition-all">
      <label class="label-badge block text-gray-900 font-black text-2xl mb-4 flex items-center gap-3">
        <div class="w-14 h-14 bg-gradient-to-br from-green-600 to-emerald-800 rounded-2xl flex items-center justify-center shadow-2xl">
          <span class="text-3xl">🔐</span>
        </div>
        <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">Verification Code</span>
      </label>
      <div class="relative">
        <input 
          id="otp_input" 
          type="text" 
          placeholder="● ● ● ● ● ●" 
          class="otp-input w-full border-4 border-green-400 rounded-2xl px-8 py-6 text-3xl font-black text-center focus:outline-none bg-white transition-all shadow-lg"
          maxlength="6"
          inputmode="numeric"
          pattern="[0-9]*"
        />
      </div>
      <p class="text-center text-sm text-gray-600 mt-3 font-semibold">Enter the 6-digit code sent to your email</p>
    </div>
  </div>

  <!-- Message erreur premium -->
  <div id="otp_error" class="hidden mb-8 rounded-2xl p-5 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-lg animate-pulse">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-2xl">❌</span>
      </div>
      <div>
        <p class="text-red-900 font-black text-lg"></p>
        <p class="text-red-700 text-sm font-semibold mt-1">Please check your code and try again</p>
      </div>
    </div>
  </div>

  <!-- Message succès premium -->
  <div id="otp_success" class="hidden mb-8 rounded-2xl p-5 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0 animate-bounce">
        <span class="text-2xl">✅</span>
      </div>
      <div>
        <p class="text-green-900 font-black text-xl">Email verified successfully!</p>
        <p class="text-green-700 text-sm font-semibold mt-1">Redirecting you now...</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep14" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep15" type="button" class="nav-btn-next bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700">
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
    const errorP = otpError.querySelector('div > p:first-child');
    errorP.textContent = message;
    otpError.classList.remove('hidden');
    otpSuccess.classList.add('hidden');
    otpInput.classList.add('shake');
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