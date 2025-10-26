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
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5),
                    0 0 40px rgba(59, 130, 246, 0.3),
                    0 0 60px rgba(59, 130, 246, 0.2);
      }
      50% { 
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.6),
                    0 0 50px rgba(59, 130, 246, 0.4),
                    0 0 80px rgba(59, 130, 246, 0.3);
      }
    }
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    .name-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      font-size: 1.25rem;
      font-weight: 600;
    }
    .name-input:focus {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3),
                  0 8px 24px rgba(59, 130, 246, 0.4);
      border-color: #3b82f6;
      transform: translateY(-3px) scale(1.01);
      animation: glow-pulse 2s infinite;
    }
    .name-input::placeholder {
      color: #9ca3af;
      font-weight: 500;
    }
    .name-input:not(:placeholder-shown) {
      border-color: #10b981;
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
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
      box-shadow: 0 12px 40px rgba(59, 130, 246, 0.4);
    }
    .icon-badge {
      animation: float 3s ease-in-out infinite;
    }
    .success-indicator {
      opacity: 0;
      transform: scale(0) rotate(-180deg);
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .name-input:not(:placeholder-shown) ~ .success-indicator {
      opacity: 1;
      transform: scale(1) rotate(0deg);
      animation: float 2s ease-in-out infinite;
    }
    .label-badge {
      animation: glow-pulse 2s infinite;
    }
  </style>

  <!-- Header premium avec gradient et animation -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="icon-badge w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-3xl flex items-center justify-center shadow-2xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-4xl">👤</span>
      </div>
      <h2 class="font-black text-4xl sm:text-5xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent">
        What's Your Name?
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Let people know who you are
    </p>
  </div>

  <!-- Alert premium -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 border-2 border-blue-200 py-4 px-6 shadow-lg">
    <div class="flex items-center gap-4">
      <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">ℹ️</span>
      </div>
      <p class="text-blue-900 font-bold text-sm sm:text-base">Both first name and surname are required to continue</p>
    </div>
  </div>

  <!-- Input fields premium avec animations TRÈS VOYANTES -->
  <div class="space-y-6 mb-8">
    <!-- First Name -->
    <div class="input-wrapper relative bg-gradient-to-br from-blue-100 via-blue-200 to-cyan-200 rounded-3xl p-8 border-4 border-blue-500 shadow-2xl hover:shadow-blue-500/50 transition-all">
      <label class="label-badge block text-gray-900 font-black text-2xl mb-4 flex items-center gap-3">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center shadow-2xl">
          <span class="text-3xl">📝</span>
        </div>
        <span class="bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">First Name</span>
      </label>
      <div class="relative">
        <input 
          id="first_name_input" 
          type="text" 
          placeholder="✍️ Enter your first name here" 
          class="name-input w-full border-4 border-blue-400 rounded-2xl px-8 py-6 focus:outline-none bg-white transition-all shadow-lg"
          @if($check)
            value="{{ $name }}"
            disabled
          @endif
        />
        <div class="success-indicator absolute right-6 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-2xl">
          <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Last Name -->
    <div class="input-wrapper relative bg-gradient-to-br from-purple-100 via-purple-200 to-pink-200 rounded-3xl p-8 border-4 border-purple-500 shadow-2xl hover:shadow-purple-500/50 transition-all">
      <label class="label-badge block text-gray-900 font-black text-2xl mb-4 flex items-center gap-3">
        <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl flex items-center justify-center shadow-2xl">
          <span class="text-3xl">📝</span>
        </div>
        <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Surname</span>
      </label>
      <div class="relative">
        <input 
          id="last_name_input" 
          type="text" 
          placeholder="✍️ Enter your surname here" 
          class="name-input w-full border-4 border-purple-400 rounded-2xl px-8 py-6 focus:outline-none bg-white transition-all shadow-lg"
          @if($check)
            value="{{ $name }}"
            disabled
          @endif
        />
        <div class="success-indicator absolute right-6 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-2xl">
          <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Message erreur premium -->
  <div id="nameError" class="hidden mb-8 rounded-2xl p-5 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-lg animate-pulse">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-2xl">⚠️</span>
      </div>
      <div>
        <p class="text-red-900 font-black text-lg">Please fill in both fields</p>
        <p class="text-red-700 text-sm font-semibold mt-1">First name and surname are required</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep11" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep12" type="button" class="nav-btn-next">
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
      firstNameInput.addEventListener('input', saveName);
      lastNameInput.addEventListener('input', saveName);

      // Validation au clic Next
      nextBtn.addEventListener('click', function(e) {
        if (!validateNames()) {
          e.preventDefault();
          errorMsg.classList.remove('hidden');
          errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
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