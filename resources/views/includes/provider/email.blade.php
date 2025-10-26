<div id="step13" class="hidden">
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
    
    .email-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .email-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
      transform: translateY(-2px);
      animation: glow-pulse 2s infinite;
    }
    
    .email-input.valid {
      border-color: #10b981 !important;
      background: linear-gradient(to bottom right, #f0fdf4 0%, #dcfce7 100%);
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
    
    .success-indicator {
      opacity: 0;
      transform: scale(0);
      transition: all 0.3s ease;
      pointer-events: none;
    }
    
    .email-input.valid ~ .success-indicator {
      opacity: 1;
      transform: scale(1);
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
        <span class="text-2xl">📧</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        What's Your Email?
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      We'll use this to contact you
    </p>
  </div>

  <!-- Info banner -->
  <div class="mb-6 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 py-3 px-5 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-base">💡</span>
      </div>
      <p class="text-blue-900 font-semibold text-sm sm:text-base">A verification code will be sent to your email</p>
    </div>
  </div>

  <!-- Email Input -->
  <div class="mb-8 relative z-10">
    <div class="input-wrapper">
      <label class="block text-gray-900 font-bold text-base mb-2 flex items-center gap-2">
        <span class="text-xl">✉️</span>
        <span class="text-blue-600">Email Address</span>
      </label>
      <div class="relative">
        <input 
          id="email_input" 
          type="email" 
          placeholder="your.email@example.com" 
          class="email-input w-full border-2 border-gray-300 rounded-xl px-5 py-3.5 focus:outline-none bg-white transition-all shadow-sm text-base font-medium placeholder:text-gray-400"
          @if(Auth::check())
            value="{{ Auth::user()->email }}"
            disabled
          @endif
        />
        <div class="success-indicator absolute right-4 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Error message -->
  <div id="emailError" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div>
        <p class="text-red-900 font-bold text-base">Please enter a valid email address</p>
        <p class="text-red-700 text-sm font-medium mt-0.5">Format: email@example.com</p>
      </div>
    </div>
  </div>

  <!-- Success message -->
  <div id="emailSuccess" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 animate-bounce">
        <span class="text-xl">✅</span>
      </div>
      <div>
        <p class="text-green-900 font-bold text-base">Valid email address!</p>
        <p class="text-green-700 text-sm font-medium mt-0.5">Ready to send verification code</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container relative z-10">
    <button id="backToStep12" type="button" class="nav-btn-back bg-white text-blue-600 border-2 border-gray-200">
      Back
    </button>
    <button id="nextStep13" type="button" class="nav-btn-next bg-gradient-to-r from-blue-600 to-cyan-600" disabled>
      Send Verification Code
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const emailInput = document.getElementById('email_input');
      const nextBtn = document.getElementById('nextStep13');
      const errorMsg = document.getElementById('emailError');
      const successMsg = document.getElementById('emailSuccess');

      // Validation email
      function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
      }

      function validateEmail() {
        const email = emailInput.value.trim();
        
        if (email && isValidEmail(email)) {
          nextBtn.disabled = false;
          errorMsg.classList.add('hidden');
          successMsg.classList.remove('hidden');
          emailInput.classList.add('valid');
          return true;
        } else {
          nextBtn.disabled = true;
          successMsg.classList.add('hidden');
          emailInput.classList.remove('valid');
          if (email) {
            errorMsg.classList.remove('hidden');
          } else {
            errorMsg.classList.add('hidden');
          }
          return false;
        }
      }

      // Auto-save localStorage
      function saveEmail() {
        let expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.email = emailInput.value.trim();
        localStorage.setItem('expats', JSON.stringify(expats));
        validateEmail();
      }

      // Events
      if (!emailInput.disabled) {
        emailInput.addEventListener('input', saveEmail);
        emailInput.addEventListener('blur', function() {
          const email = emailInput.value.trim();
          if (email && !isValidEmail(email)) {
            errorMsg.classList.remove('hidden');
          }
        });
      }

      // Validation au clic Next
      nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (!validateEmail()) {
          errorMsg.classList.remove('hidden');
          errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }

        // Envoyer OTP par email
        nextBtn.disabled = true;
        const originalText = nextBtn.innerHTML;
        nextBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

        const email = emailInput.value.trim();
        const token = document.querySelector('input[name="_token"]')?.value || '';

        fetch('/send-email-otp', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email, _token: token }),
          credentials: 'same-origin'
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            // Passer au step suivant (verification)
            if (typeof goToStep === 'function') {
              goToStep(14);
            } else {
              document.getElementById('step13').classList.add('hidden');
              document.getElementById('step14').classList.remove('hidden');
            }
          } else {
            errorMsg.querySelector('div > div > p:first-child').textContent = data.message || 'Failed to send verification code';
            errorMsg.classList.remove('hidden');
            successMsg.classList.add('hidden');
            nextBtn.disabled = false;
            nextBtn.innerHTML = originalText;
          }
        })
        .catch(err => {
          console.error(err);
          errorMsg.querySelector('div > div > p:first-child').textContent = 'Network error. Please try again.';
          errorMsg.classList.remove('hidden');
          successMsg.classList.add('hidden');
          nextBtn.disabled = false;
          nextBtn.innerHTML = originalText;
        });
      });

      // Restore localStorage
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      if (expats.email && !emailInput.disabled) {
        emailInput.value = expats.email;
      }
      validateEmail();
    });
  </script>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep13');
    const stepElement = document.getElementById('step13');
    
    function checkValidation() {
        const email = document.getElementById('email_input')?.value.trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = email && regex.test(email);
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