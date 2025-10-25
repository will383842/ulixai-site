@csrf
<div id="step15" class="hidden">
  <style>
    .otp-input:focus {
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }
    .shake {
      animation: shake 0.5s;
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 bg-clip-text text-transparent mb-3">
      📬 Check Your Email
    </h2>
    <p class="text-gray-500 text-base">Enter the 6-digit verification code</p>
  </div>

  <!-- Info box -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-400 py-4 px-6">
    <div class="flex items-start">
      <span class="text-3xl mr-3 flex-shrink-0">💡</span>
      <div>
        <p class="text-blue-900 font-semibold text-base">Check your inbox (and spam folder)</p>
        <p class="text-blue-700 text-sm mt-1">The code expires in 10 minutes</p>
      </div>
    </div>
  </div>

  <!-- OTP Input -->
  <div class="mb-8">
    <label class="block text-gray-700 font-bold text-base mb-3 flex items-center">
      <span class="text-xl mr-2">🔐</span>
      Verification Code
    </label>
    <input 
      id="otp_input" 
      type="text" 
      placeholder="Enter 6-digit code" 
      class="otp-input w-full border-3 border-gray-200 rounded-2xl px-6 py-4 text-2xl font-bold text-center tracking-widest focus:outline-none focus:border-green-500 transition-all"
      maxlength="6"
      inputmode="numeric"
      pattern="[0-9]*"
    />
  </div>

  <!-- Message erreur -->
  <div id="otp_error" class="hidden mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">❌</span>
      <p class="text-red-700 font-semibold"></p>
    </div>
  </div>

  <!-- Message succès -->
  <div id="otp_success" class="hidden mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-3xl mr-3">✅</span>
      <p class="text-green-700 font-bold text-lg">Email verified successfully!</p>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep14" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-green-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep15" 
      class="group bg-gradient-to-r from-green-600 to-emerald-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100"
      disabled
    >
      <span>Verify & Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
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
    const errorP = otpError.querySelector('p');
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