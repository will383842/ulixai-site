@php 
  $check = Auth::check();
  $name = Auth::user()->name ?? '';
@endphp
<div id="step12" class="hidden">
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
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    
    .name-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .name-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
      transform: translateY(-2px);
    }
    
    .name-input:not(:placeholder-shown) {
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
    
    .name-input:not(:placeholder-shown) ~ .success-indicator {
      opacity: 1;
      transform: scale(1);
    }
    
    .error-shake {
      animation: shake 0.5s;
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
        <span class="text-2xl">👤</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        What's Your Name?
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Let people know who you are
    </p>
  </div>

  <!-- Info banner -->
  <div class="mb-6 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 py-3 px-5 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-base">ℹ️</span>
      </div>
      <p class="text-blue-900 font-semibold text-sm sm:text-base">Both first name and surname are required to continue</p>
    </div>
  </div>

  <!-- Input fields -->
  <div class="space-y-5 mb-8 relative z-10">
    <!-- First Name -->
    <div class="input-wrapper">
      <label class="block text-gray-900 font-bold text-base mb-2 flex items-center gap-2">
        <span class="text-xl">📝</span>
        <span class="text-blue-600">First Name</span>
      </label>
      <div class="relative">
        <input 
          id="first_name_input" 
          type="text" 
          placeholder="Enter your first name" 
          class="name-input w-full border-2 border-gray-300 rounded-xl px-5 py-3.5 focus:outline-none bg-white transition-all shadow-sm text-base font-medium placeholder:text-gray-400"
          @if($check)
            value="{{ $name }}"
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

    <!-- Last Name -->
    <div class="input-wrapper">
      <label class="block text-gray-900 font-bold text-base mb-2 flex items-center gap-2">
        <span class="text-xl">📝</span>
        <span class="text-cyan-600">Surname</span>
      </label>
      <div class="relative">
        <input 
          id="last_name_input" 
          type="text" 
          placeholder="Enter your surname" 
          class="name-input w-full border-2 border-gray-300 rounded-xl px-5 py-3.5 focus:outline-none bg-white transition-all shadow-sm text-base font-medium placeholder:text-gray-400"
          @if($check)
            value="{{ $name }}"
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
  <div id="nameError" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div>
        <p class="text-red-900 font-bold text-base">Please fill in both fields</p>
        <p class="text-red-700 text-sm font-medium mt-0.5">First name and surname are required</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container relative z-10">
    <button id="backToStep11" type="button" class="nav-btn-back bg-white text-blue-600 border-2 border-gray-200">
      Back
    </button>
    <button id="nextStep12" type="button" class="nav-btn-next bg-gradient-to-r from-blue-600 to-cyan-600" disabled>
      Continue
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const firstNameInput = document.getElementById('first_name_input');
      const lastNameInput = document.getElementById('last_name_input');
      const nextBtn = document.getElementById('nextStep12');
      const errorMsg = document.getElementById('nameError');

      // Validation
      function validateNames() {
        const firstName = firstNameInput.value.trim();
        const lastName = lastNameInput.value.trim();
        
        if (firstName && lastName) {
          nextBtn.disabled = false;
          errorMsg.classList.add('hidden');
          firstNameInput.parentElement.parentElement.classList.remove('error-shake');
          lastNameInput.parentElement.parentElement.classList.remove('error-shake');
          return true;
        } else {
          nextBtn.disabled = true;
          return false;
        }
      }

      // Auto-save localStorage
      function saveName() {
        let expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.firstName = firstNameInput.value.trim();
        expats.lastName = lastNameInput.value.trim();
        localStorage.setItem('expats', JSON.stringify(expats));
        validateNames();
      }

      // Events
      if (!firstNameInput.disabled) {
        firstNameInput.addEventListener('input', saveName);
      }
      if (!lastNameInput.disabled) {
        lastNameInput.addEventListener('input', saveName);
      }

      // Validation au clic Next
      nextBtn.addEventListener('click', function(e) {
        if (!validateNames()) {
          e.preventDefault();
          errorMsg.classList.remove('hidden');
          
          // Shake animation
          if (!firstNameInput.value.trim()) {
            firstNameInput.parentElement.parentElement.classList.add('error-shake');
          }
          if (!lastNameInput.value.trim()) {
            lastNameInput.parentElement.parentElement.classList.add('error-shake');
          }
          
          // Scroll to error
          errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
          
          // Remove shake after animation
          setTimeout(() => {
            firstNameInput.parentElement.parentElement.classList.remove('error-shake');
            lastNameInput.parentElement.parentElement.classList.remove('error-shake');
          }, 500);
        }
      });

      // Restore localStorage
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      if (expats.firstName && !firstNameInput.disabled) {
        firstNameInput.value = expats.firstName;
      }
      if (expats.lastName && !lastNameInput.disabled) {
        lastNameInput.value = expats.lastName;
      }
      validateNames();
    });
  </script>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep12');
    const stepElement = document.getElementById('step12');
    
    function checkValidation() {
        const firstName = document.getElementById('first_name_input')?.value.trim();
        const lastName = document.getElementById('last_name_input')?.value.trim();
        const isValid = firstName && lastName;
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