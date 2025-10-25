@php 
  $check = Auth::check();
  $name = Auth::user()->name ?? '';
@endphp
<div id="step12" class="hidden">
  <style>
    .name-input:focus {
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
      👤 What's Your Name?
    </h2>
    <p class="text-gray-500 text-base">Let people know who you are</p>
  </div>

  <!-- Input fields modernes -->
  <div class="space-y-5 mb-8">
    <!-- First Name -->
    <div class="relative">
      <label class="block text-gray-700 font-bold text-base mb-2 flex items-center">
        <span class="text-xl mr-2">📝</span>
        First Name
      </label>
      <input 
        id="first_name_input" 
        type="text" 
        placeholder="Enter your first name" 
        class="name-input w-full border-3 border-gray-200 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 transition-all"
        @if($check)
          value="{{ $name }}"
          disabled
        @endif
      />
    </div>

    <!-- Last Name -->
    <div class="relative">
      <label class="block text-gray-700 font-bold text-base mb-2 flex items-center">
        <span class="text-xl mr-2">📝</span>
        Surname
      </label>
      <input 
        id="last_name_input" 
        type="text" 
        placeholder="Enter your surname" 
        class="name-input w-full border-3 border-gray-200 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-indigo-500 transition-all"
        @if($check)
          value="{{ $name }}"
          disabled
        @endif
      />
    </div>
  </div>

  <!-- Message erreur -->
  <div id="nameError" class="hidden mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">⚠️</span>
      <p class="text-red-700 font-semibold">Please fill in both fields</p>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep11" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep12" 
      class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100"
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