<div id="step9" class="hidden">
  <style>
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    @keyframes shimmer {
      0% { 
        background-position: -1000px 0; 
      }
      100% { 
        background-position: 1000px 0; 
      }
    }
    
    @keyframes pulse {
      0%, 100% { 
        transform: scale(1); 
        opacity: 1; 
      }
      50% { 
        transform: scale(1.05); 
        opacity: 0.9; 
      }
    }
    
    @keyframes gradient {
      0%, 100% { 
        background-position: 0% 50%; 
      }
      50% { 
        background-position: 100% 50%; 
      }
    }
    
    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
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
      transition: left 0.5s ease;
    }
    
    .textarea-wrapper:hover::before {
      left: 100%;
    }
    
    .shimmer-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      background-size: 200% 100%;
      animation: shimmer 2s infinite linear;
    }
    
    .char-counter.pulse-animation {
      animation: pulse 1s infinite;
    }
    
    #profileDescription:focus {
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
      border-color: #3b82f6;
    }
    
    .border-3 {
      border-width: 3px;
    }
    
    @media (min-width: 768px) {
      .ambient-blob {
        mix-blend-mode: multiply;
        filter: blur(40px);
        opacity: 0.15;
      }
    }
    
    @media (max-width: 767px) {
      .ambient-blob {
        display: none;
      }
    }
  </style>

  <!-- Ambient Blobs -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 hidden md:block">
    <div class="ambient-blob absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full"></div>
    <div class="ambient-blob absolute top-20 right-10 w-64 h-64 bg-cyan-300 rounded-full"></div>
    <div class="ambient-blob absolute bottom-10 left-1/2 w-64 h-64 bg-teal-300 rounded-full"></div>
  </div>

  <!-- Header premium avec gradient -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">✨</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Tell Us About Yourself
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Share your expertise and stand out!
    </p>
  </div>

  <!-- Alerte info premium -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-300 p-4 sm:p-6 shadow-lg">
    <div class="flex items-start gap-4">
      <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div class="flex-1">
        <p class="text-amber-900 font-bold text-base">Minimum 200 characters required to continue</p>
        <p class="text-amber-700 text-sm font-medium mt-1">This will appear on your profile and help you get more missions!</p>
      </div>
    </div>
  </div>

  <!-- Zone textarea premium -->
  <div class="mb-8">
    <div class="textarea-wrapper bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-6 border-3 border-blue-300 shadow-lg hover:shadow-xl transition-all">
      <label class="block text-gray-900 font-black text-lg mb-4 flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-md">
          <span class="text-2xl">📝</span>
        </div>
        <span>Profile Description</span>
      </label>
      
      <textarea 
        id="profileDescription" 
        name="profile_description"
        placeholder="Tell us about your experience, skills, and how you can help others succeed. What makes you unique? Share your story and let your personality shine through..."
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
      <div class="mt-4 h-3 bg-gray-200 rounded-full overflow-hidden shadow-inner relative">
        <div id="progressBar" class="h-full bg-gray-400 transition-all duration-300 relative" style="width: 0%">
          <div class="shimmer-overlay"></div>
        </div>
      </div>

      <!-- Indicateurs visuels avec labels clairs -->
      <div class="mt-3 flex items-center gap-2 text-xs font-bold">
        <div class="flex items-center gap-1">
          <div id="indicator1" class="w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="indicator1Label" class="text-gray-500 transition-colors">Start</span>
        </div>
        <div class="flex-1 border-t border-dashed border-gray-300"></div>
        <div class="flex items-center gap-1">
          <div id="indicator2" class="w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="indicator2Label" class="text-gray-500 transition-colors">200 chars</span>
        </div>
        <div class="flex-1 border-t border-dashed border-gray-300"></div>
        <div class="flex items-center gap-1">
          <div id="indicator3" class="w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></div>
          <span id="indicator3Label" class="text-gray-500 transition-colors">Full</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container flex items-center justify-between gap-4 mt-8">
    <button id="backToStep8" type="button" class="nav-btn-back flex-1 sm:flex-none bg-white text-blue-600 border-2 border-gray-200 hover:border-blue-400 px-8 py-3 rounded-xl font-bold text-base transition-colors hover:shadow-lg">
      Back
    </button>
    <button id="nextStep9" type="button" class="nav-btn-next flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-bold text-base shadow-lg hover:shadow-xl transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
      Continue
    </button>
  </div>

  <script>
    (function() {
      'use strict';
      
      const textarea = document.getElementById('profileDescription');
      const charCount = document.getElementById('charCount');
      const progressBar = document.getElementById('progressBar');
      const counter = document.querySelector('.char-counter');
      const nextBtn = document.getElementById('nextStep9');
      
      const indicator1 = document.getElementById('indicator1');
      const indicator1Label = document.getElementById('indicator1Label');
      const indicator2 = document.getElementById('indicator2');
      const indicator2Label = document.getElementById('indicator2Label');
      const indicator3 = document.getElementById('indicator3');
      const indicator3Label = document.getElementById('indicator3Label');

      function updateCounter() {
        const length = textarea.value.length;
        const percentage = (length / 500) * 100;

        charCount.textContent = length;
        progressBar.style.width = percentage + '%';

        // Validation du bouton Next
        if (nextBtn) {
          nextBtn.disabled = length < 200;
        }

        // Changement de couleur du compteur et progress bar selon progression
        counter.classList.remove('pulse-animation');
        
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
        } else {
          // 450+ : rouge (danger) avec pulse
          charCount.style.color = '#ef4444';
          progressBar.style.background = 'linear-gradient(to right, #ef4444, #f43f5e)';
          counter.classList.add('pulse-animation');
        }

        // Indicateur 1 (Start - 0+)
        if (length > 0) {
          indicator1.style.backgroundColor = '#2563eb';
          indicator1.style.transform = 'scale(1.3)';
          indicator1Label.style.color = '#2563eb';
          indicator1Label.style.fontWeight = '900';
        } else {
          indicator1.style.backgroundColor = '#d1d5db';
          indicator1.style.transform = 'scale(1)';
          indicator1Label.style.color = '#6b7280';
          indicator1Label.style.fontWeight = '700';
        }

        // Indicateur 2 (200 chars)
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

        // Indicateur 3 (500 - Full)
        if (length >= 500) {
          indicator3.style.backgroundColor = '#ef4444';
          indicator3.style.transform = 'scale(1.3)';
          indicator3Label.style.color = '#ef4444';
          indicator3Label.style.fontWeight = '900';
        } else {
          indicator3.style.backgroundColor = '#d1d5db';
          indicator3.style.transform = 'scale(1)';
          indicator3Label.style.color = '#6b7280';
          indicator3Label.style.fontWeight = '700';
        }

        // Save to localStorage
        try {
          localStorage.setItem('profileDescription', textarea.value);
        } catch (e) {
          console.warn('localStorage not available:', e);
        }
      }

      // Event listener sur textarea
      if (textarea) {
        textarea.addEventListener('input', updateCounter);
        
        // Restore from localStorage
        try {
          const saved = localStorage.getItem('profileDescription');
          if (saved) {
            textarea.value = saved;
            updateCounter();
          }
        } catch (e) {
          console.warn('Error restoring description:', e);
        }
        
        // Initial check
        updateCounter();
      }
    })();
  </script>
</div>