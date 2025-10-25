<div id="step13" class="hidden">
  <style>
    .email-input:focus {
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent mb-3">
      📧 What's Your Email?
    </h2>
    <p class="text-gray-500 text-base">We'll use this to contact you</p>
  </div>

  <!-- Email Input -->
  <div class="mb-8">
    <label class="block text-gray-700 font-bold text-base mb-3 flex items-center">
      <span class="text-xl mr-2">✉️</span>
      Email Address
    </label>
    <input 
      id="email_input" 
      type="email" 
      placeholder="your.email@example.com" 
      class="email-input w-full border-3 border-gray-200 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 transition-all"
      @if(Auth::check())
        value="{{ Auth::user()->email }}"
        disabled
      @endif
    />
  </div>

  <!-- Message erreur -->
  <div id="emailError" class="hidden mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">⚠️</span>
      <p class="text-red-700 font-semibold">Please enter a valid email address</p>
    </div>
  </div>

  <!-- Message succès -->
  <div id="emailSuccess" class="hidden mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">✅</span>
      <p class="text-green-700 font-semibold">Valid email address</p>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep12" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep13" 
      class="group bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100"
      disabled
    >
      <span>Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
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
          return true;
        } else {
          nextBtn.disabled = true;
          successMsg.classList.add('hidden');
          if (email) {
            errorMsg.classList.remove('hidden');
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
      emailInput.addEventListener('input', saveEmail);
      emailInput.addEventListener('blur', function() {
        const email = emailInput.value.trim();
        if (email && !isValidEmail(email)) {
          errorMsg.classList.remove('hidden');
        }
      });

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
            errorMsg.querySelector('p').textContent = data.message || 'Failed to send verification code';
            errorMsg.classList.remove('hidden');
            nextBtn.disabled = false;
            nextBtn.innerHTML = originalText;
          }
        })
        .catch(err => {
          console.error(err);
          errorMsg.querySelector('p').textContent = 'Network error. Please try again.';
          errorMsg.classList.remove('hidden');
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