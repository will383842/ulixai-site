<div id="step8" class="hidden">
  <style>
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    @keyframes pulse-glow {
      0%, 100% { 
        transform: scale(1) translateZ(0);
        opacity: 1;
      }
      50% { 
        transform: scale(1.02) translateZ(0);
        opacity: 0.95;
      }
    }
    
    @keyframes gradient {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }
    
    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
    }
    
    @media (min-width: 768px) {
      @keyframes shimmer {
        0% { transform: translateX(-100%) translateZ(0); }
        100% { transform: translateX(100%) translateZ(0); }
      }
    }
    
    .toggle-btn {
      transition: transform 0.2s ease, border-color 0.2s ease;
      position: relative;
      overflow: hidden;
      will-change: transform;
      contain: layout style paint;
      touch-action: manipulation;
      -webkit-tap-highlight-color: transparent;
    }
    
    @media (min-width: 768px) {
      .toggle-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        transform: translate(-50%, -50%) translateZ(0);
        transition: width 0.4s ease-out, height 0.4s ease-out, opacity 0.4s ease-out;
        opacity: 0;
      }
      
      .toggle-btn:active::before {
        width: 150px;
        height: 150px;
        opacity: 1;
      }
    }
    
    .toggle-btn.active {
      transform: scale(1.05) translateZ(0);
    }
    
    .toggle-btn.yes-active {
      background: linear-gradient(90deg, #10b981, #059669);
      color: white;
      border-color: #10b981;
      box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
    }
    
    .toggle-btn.no-active {
      background: linear-gradient(90deg, #ef4444, #f43f5e);
      color: white;
      border-color: #ef4444;
      box-shadow: 0 4px 16px rgba(239, 68, 68, 0.4);
    }
    
    @media (min-width: 768px) {
      .toggle-btn.yes-active,
      .toggle-btn.no-active {
        animation: pulse-glow 2.5s ease-in-out infinite;
      }
    }
    
    .comm-card {
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
      position: relative;
      overflow: hidden;
      will-change: transform;
      contain: layout style paint;
    }
    
    @media (min-width: 768px) {
      .comm-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.06), transparent);
        transform: translateX(-100%) translateZ(0);
        pointer-events: none;
      }
      
      .comm-card:hover::before {
        animation: shimmer 0.6s ease-out;
      }
      
      .comm-card:hover {
        transform: translateY(-4px) translateZ(0);
        box-shadow: 0 12px 28px rgba(59, 130, 246, 0.2);
        border-color: #3b82f6;
      }
    }
    
    @media (max-width: 767px) {
      .comm-card {
        transition: border-color 0.2s ease;
      }
      
      .toggle-btn {
        transition: transform 0.15s ease, border-color 0.15s ease;
      }
      
      .toggle-btn.active {
        transform: scale(1.03) translateZ(0);
      }
    }
    
    .border-3 {
      border-width: 3px;
    }
  </style>

  <!-- Header -->
  <div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">💬</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Would You Like To Speak Online Or In Person?
      </h2>
    </div>
    <p class="text-gray-600 text-base font-medium">
      Choose one or both options
    </p>
  </div>

  <!-- Info Banner -->
  <div class="mb-8 rounded-xl bg-yellow-50 border-l-4 border-yellow-400 py-3 px-5 shadow-md">
    <div class="flex items-center justify-center gap-3">
      <span class="text-xl flex-shrink-0">💡</span>
      <span class="text-yellow-800 font-bold text-sm sm:text-base">You can choose both</span>
    </div>
  </div>

  <!-- Communication Options -->
  <div class="space-y-6 mb-8">
    
    <!-- Online -->
    <div class="comm-card bg-white border-3 border-blue-400 rounded-3xl p-6 sm:p-8 shadow-lg">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center space-x-4 flex-1 min-w-0">
          <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center shadow-xl flex-shrink-0">
            <span class="text-3xl sm:text-4xl">💻</span>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-gray-900 font-black text-xl sm:text-2xl leading-tight">Online</h3>
            <p class="text-gray-500 text-xs sm:text-sm font-medium mt-1">Video calls & remote sessions</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle w-full sm:w-auto justify-end">
          <button type="button" class="toggle-btn speak-btn bg-white rounded-xl sm:rounded-2xl px-6 sm:px-8 py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-green-400 flex-1 sm:flex-initial" data-label="Online" data-value="Yes">
            Yes
          </button>
          <button type="button" class="toggle-btn speak-btn bg-white rounded-xl sm:rounded-2xl px-6 sm:px-8 py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-red-400 flex-1 sm:flex-initial" data-label="Online" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>

    <!-- In Person -->
    <div class="comm-card bg-white border-3 border-blue-400 rounded-3xl p-6 sm:p-8 shadow-lg">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center space-x-4 flex-1 min-w-0">
          <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-cyan-600 to-teal-600 flex items-center justify-center shadow-xl flex-shrink-0">
            <span class="text-3xl sm:text-4xl">🤝</span>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-gray-900 font-black text-xl sm:text-2xl leading-tight">In Person</h3>
            <p class="text-gray-500 text-xs sm:text-sm font-medium mt-1">Face-to-face meetings</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle w-full sm:w-auto justify-end">
          <button type="button" class="toggle-btn speak-btn bg-white rounded-xl sm:rounded-2xl px-6 sm:px-8 py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-green-400 flex-1 sm:flex-initial" data-label="In Person" data-value="Yes">
            Yes
          </button>
          <button type="button" class="toggle-btn speak-btn bg-white rounded-xl sm:rounded-2xl px-6 sm:px-8 py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-red-400 flex-1 sm:flex-initial" data-label="In Person" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>

  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container flex items-center justify-between gap-4 mt-8">
    <button id="backToStep7" type="button" class="nav-btn-back flex-1 sm:flex-none bg-white text-blue-600 border-2 border-gray-200 hover:border-blue-400 px-8 py-3 rounded-xl font-bold text-base transition-colors hover:shadow-lg">
      Back
    </button>
    <button id="nextStep8" type="button" class="nav-btn-next flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-bold text-base shadow-lg hover:shadow-xl transition-all hover:scale-105">
      Continue
    </button>
  </div>

  <script>
    (function() {
      'use strict';
      
      let buttons, nextBtn;
      const state = { Online: null, 'In Person': null };
      
      const raf = (fn) => {
        let rid = null;
        return (...args) => {
          if (!rid) rid = requestAnimationFrame(() => { rid = null; fn(...args); });
        };
      };
      
      const debounce = (fn, ms) => {
        let tid;
        return (...args) => {
          clearTimeout(tid);
          tid = setTimeout(() => fn(...args), ms);
        };
      };
      
      const saveState = debounce(() => {
        try {
          localStorage.setItem('communicationPreference', JSON.stringify(state));
        } catch (e) {}
      }, 250);
      
      const handleClick = function() {
        const label = this.dataset.label;
        const value = this.dataset.value;
        const group = this.closest('.speak-toggle');
        const btns = group.querySelectorAll('.speak-btn');
        
        requestAnimationFrame(() => {
          btns.forEach(b => b.classList.remove('active', 'yes-active', 'no-active'));
          this.classList.add('active', value === 'Yes' ? 'yes-active' : 'no-active');
          state[label] = value;
          saveState();
        });
      };
      
      const restore = () => {
        try {
          const saved = localStorage.getItem('communicationPreference');
          if (!saved) return;
          
          const data = JSON.parse(saved);
          
          requestAnimationFrame(() => {
            buttons.forEach(btn => {
              const label = btn.dataset.label;
              const value = btn.dataset.value;
              
              if (data[label] === value) {
                btn.classList.add('active', value === 'Yes' ? 'yes-active' : 'no-active');
                state[label] = value;
              }
            });
          });
        } catch (e) {}
      };
      
      const init = () => {
        buttons = document.querySelectorAll('.speak-btn');
        nextBtn = document.getElementById('nextStep8');
        
        if (!buttons.length) return;
        
        buttons.forEach(btn => btn.addEventListener('click', handleClick, { passive: true }));
        restore();
      };
      
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
      } else {
        init();
      }
    })();
  </script>
</div>