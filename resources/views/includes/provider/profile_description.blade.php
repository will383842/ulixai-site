<div id="step9" class="hidden">
  <style>
    .char-counter {
      transition: all 0.3s ease;
    }
    .char-counter.warning {
      color: #f59e0b;
      font-weight: 700;
    }
    .char-counter.danger {
      color: #ef4444;
      font-weight: 700;
    }
    #profileDescription:focus {
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
      ✨ Tell Us About Yourself
    </h2>
    <p class="text-gray-500 text-base">Share your expertise and stand out!</p>
  </div>

  <!-- Alerte info -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-400 py-4 px-6">
    <div class="flex items-start">
      <span class="text-3xl mr-3 flex-shrink-0">💡</span>
      <span class="text-amber-900 font-semibold text-base">This will appear on your profile and help you get more missions!</span>
    </div>
  </div>

  <!-- Zone textarea moderne -->
  <div class="mb-8">
    <div class="bg-gradient-to-br from-gray-50 to-indigo-50 rounded-3xl p-6 border-2 border-gray-200">
      <label class="block text-gray-800 font-bold text-lg mb-4 flex items-center">
        <span class="text-2xl mr-2">📝</span>
        Profile Description
      </label>
      
      <textarea 
        id="profileDescription" 
        placeholder="Tell us about your experience, skills, and how you can help others succeed..."
        class="w-full border-3 border-indigo-200 rounded-2xl px-6 py-4 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-indigo-500 resize-none bg-white text-base transition-all"
        rows="8"
        maxlength="500"
      ></textarea>
      
      <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2 text-gray-500 text-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Maximum 500 characters</span>
        </div>
        <div class="char-counter text-lg font-semibold">
          <span id="charCount" class="text-indigo-600">0</span>
          <span class="text-gray-400">/500</span>
        </div>
      </div>

      <!-- Barre de progression -->
      <div class="mt-3 h-2 bg-gray-200 rounded-full overflow-hidden">
        <div id="progressBar" class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-300" style="width: 0%"></div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep8" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep9" 
      class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3"
    >
      <span>Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const textarea = document.getElementById('profileDescription');
      const charCount = document.getElementById('charCount');
      const progressBar = document.getElementById('progressBar');
      const counter = document.querySelector('.char-counter');

      // Fonction de mise à jour
      function updateCounter() {
        const length = textarea.value.length;
        const percentage = (length / 500) * 100;

        charCount.textContent = length;
        progressBar.style.width = percentage + '%';

        // Changement de couleur selon progression
        counter.classList.remove('warning', 'danger');
        if (length >= 450) {
          counter.classList.add('danger');
        } else if (length >= 400) {
          counter.classList.add('warning');
        }

        // Save localStorage
        localStorage.setItem('profileDescription', textarea.value);
      }

      // Event listener
      textarea.addEventListener('input', updateCounter);

      // Restore localStorage
      const saved = localStorage.getItem('profileDescription');
      if (saved) {
        textarea.value = saved;
        updateCounter();
      }
    });
  </script>
</div>