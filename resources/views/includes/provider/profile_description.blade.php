<div id="step9" class="hidden">
  <style>
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }
    @keyframes pulse-ring {
      0% { transform: scale(1); opacity: 1; }
      100% { transform: scale(1.5); opacity: 0; }
    }
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
      animation: pulse 1s infinite;
    }
    #profileDescription:focus {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
    }
    .textarea-wrapper {
      position: relative;
      overflow: hidden;
    }
    .textarea-wrapper::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      transition: left 0.5s;
    }
    .textarea-wrapper:hover::before {
      left: 100%;
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
  </style>

  <!-- Header premium avec gradient -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">✨</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent">
        Tell Us About Yourself
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Share your expertise and stand out!
    </p>
  </div>

  <!-- Alerte info premium -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border-2 border-amber-300 py-4 px-6 shadow-lg">
    <div class="flex items-start gap-4">
      <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div class="flex-1">
        <p class="text-amber-900 font-bold text-base">Minimum 200 characters required to continue</p>
        <p class="text-amber-700 text-sm mt-1">This will appear on your profile and help you get more missions!</p>
      </div>
    </div>
  </div>

  <!-- Zone textarea premium -->
  <div class="mb-8">
    <div class="textarea-wrapper bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-6 border-3 border-blue-300 shadow-lg hover:shadow-xl transition-all">
      <label class="block text-gray-900 font-black text-lg mb-4 flex items-center gap-2">
        <span class="text-2xl">📝</span>
        <span>Profile Description</span>
      </label>
      
      <textarea 
        id="profileDescription" 
        placeholder="Tell us about your experience, skills, and how you can help others succeed..."
        class="w-full border-3 border-blue-200 rounded-2xl px-6 py-4 text-gray-800 placeholder-gray-400 focus:outline-none resize-none bg-white text-base transition-all"
        rows="8"
        maxlength="500"
      ></textarea>
      
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mt-4">
        <div class="flex items-center space-x-2 text-gray-600 text-sm font-medium">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Minimum: <strong class="text-gray-900">200 characters</strong> • Maximum: 500</span>
        </div>
        <div class="char-counter text-xl font-black">
          <span id="charCount" class="text-gray-400">0</span>
          <span class="text-gray-400">/500</span>
        </div>
      </div>

      <!-- Barre de progression premium -->
      <div class="mt-4 h-3 bg-gray-200 rounded-full overflow-hidden shadow-inner">
        <div id="progressBar" class="h-full bg-gray-400 transition-all duration-300 relative" style="width: 0%">
          <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-30 animate-shimmer"></div>
        </div>
      </div>

      <!-- Indicateurs visuels avec labels clairs -->
      <div class="mt-3 flex items-center gap-2 text-xs font-bold">
        <div class="flex items-center gap-1">
          <div id="indicator1" class="w-2 h-2 rounded-full bg-gray-300 transition-all"></div>
          <span class="text-gray-500">Start</span>
        </div>
        <div class="flex-1 border-t border-dashed border-gray-300"></div>
        <div class="flex items-center gap-1">
          <div id="indicator2" class="w-2 h-2 rounded-full bg-gray-300 transition-all"></div>
          <span id="indicator2Label" class="text-gray-500">200 chars</span>
        </div>
        <div class="flex-1 border-t border-dashed border-gray-300"></div>
        <div class="flex items-center gap-1">
          <div id="indicator3" class="w-2 h-2 rounded-full bg-gray-300 transition-all"></div>
          <span class="text-gray-500">Full</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep8" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep9" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const textarea = document.getElementById('profileDescription');
      const charCount = document.getElementById('charCount');
      const progressBar = document.getElementById('progressBar');
      const counter = document.querySelector('.char-counter');
      const indicator1 = document.getElementById('indicator1');
      const indicator2 = document.getElementById('indicator2');
      const indicator2Label = document.getElementById('indicator2Label');
      const indicator3 = document.getElementById('indicator3');

      // Fonction de mise à jour
      function updateCounter() {
        const length = textarea.value.length;
        const percentage = (length / 500) * 100;

        charCount.textContent = length;
        progressBar.style.width = percentage + '%';

        // Changement de couleur du compteur selon progression
        counter.classList.remove('warning', 'danger');
        if (length < 200) {
          // Moins de 200 : rouge
          charCount.style.color = '#ef4444';
          progressBar.style.background = '#ef4444';
        } else if (length >= 200 && length < 400) {
          // Entre 200-399 : vert (OK)
          charCount.style.color = '#10b981';
          progressBar.style.background = 'linear-gradient(to right, #10b981, #059669)';
        } else if (length >= 400 && length < 450) {
          // Entre 400-449 : orange (warning)
          charCount.style.color = '#f59e0b';
          progressBar.style.background = 'linear-gradient(to right, #f59e0b, #d97706)';
          counter.classList.add('warning');
        } else {
          // 450+ : rouge (danger)
          charCount.style.color = '#ef4444';
          progressBar.style.background = 'linear-gradient(to right, #ef4444, #dc2626)';
          counter.classList.add('danger');
        }

        // Indicateurs visuels
        if (length > 0) {
          indicator1.style.backgroundColor = '#3b82f6';
          indicator1.style.transform = 'scale(1.3)';
        } else {
          indicator1.style.backgroundColor = '#d1d5db';
          indicator1.style.transform = 'scale(1)';
        }

        if (length >= 200) {
          indicator2.style.backgroundColor = '#10b981';
          indicator2.style.transform = 'scale(1.5)';
          indicator2Label.style.color = '#10b981';
          indicator2Label.style.fontWeight = '900';
        } else {
          indicator2.style.backgroundColor = '#d1d5db';
          indicator2.style.transform = 'scale(1)';
          indicator2Label.style.color = '#6b7280';
          indicator2Label.style.fontWeight = '700';
        }

        if (length >= 500) {
          indicator3.style.backgroundColor = '#ef4444';
          indicator3.style.transform = 'scale(1.3)';
        } else {
          indicator3.style.backgroundColor = '#d1d5db';
          indicator3.style.transform = 'scale(1)';
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep9');
    const stepElement = document.getElementById('step9');
    
    function checkValidation() {
        const isValid = document.getElementById('profileDescription')?.value.trim().length >= 200;
        if (nextBtn) {
            nextBtn.disabled = !isValid;
        }
    }
    
    // Observer les changements
    if (stepElement) {
        stepElement.addEventListener('click', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('input', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('change', () => setTimeout(checkValidation, 100));
    }
    
    // Vérification initiale
    setTimeout(checkValidation, 200);
});
</script>