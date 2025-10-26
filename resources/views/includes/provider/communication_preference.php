<div id="step8" class="hidden">
  <style>
    @keyframes pulse-glow {
      0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
      50% { box-shadow: 0 0 0 8px rgba(59, 130, 246, 0); }
    }
    @keyframes slide-in {
      from { transform: translateX(-20px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    .toggle-btn {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    .toggle-btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }
    .toggle-btn:active::before {
      width: 300px;
      height: 300px;
    }
    .toggle-btn.active {
      transform: scale(1.05);
    }
    .toggle-btn.yes-active {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      border-color: #10b981;
      box-shadow: 0 4px 20px rgba(16, 185, 129, 0.5);
      animation: pulse-glow 2s infinite;
    }
    .toggle-btn.no-active {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      border-color: #ef4444;
      box-shadow: 0 4px 20px rgba(239, 68, 68, 0.5);
      animation: pulse-glow 2s infinite;
    }
    .comm-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    .comm-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      transition: left 0.5s;
    }
    .comm-card:hover::before {
      left: 100%;
    }
    .comm-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 32px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
    }
    .icon-wrapper {
      animation: slide-in 0.5s ease-out;
    }
  </style>

  <!-- Header premium avec gradient -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">💬</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent">
        Would You Like To Speak Online Or In Person?
      </h2>
    </div>
  </div>

  <!-- Info banner -->
  <div class="mb-8 rounded-xl bg-yellow-50 border-l-4 border-yellow-400 py-3 px-5">
    <div class="flex items-center justify-center gap-3">
      <span class="text-xl">⚠️</span>
      <span class="text-yellow-800 font-bold text-sm sm:text-base">You must select "Yes" for at least one option to continue</span>
    </div>
  </div>

  <!-- Choix Online/In Person avec design premium -->
  <div class="space-y-6 mb-8">
    <!-- Online -->
    <div class="comm-card border-3 border-blue-400 rounded-3xl px-6 sm:px-8 py-6 bg-white shadow-lg">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center space-x-4 flex-1">
          <div class="icon-wrapper w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-3xl sm:text-4xl shadow-xl flex-shrink-0">
            💻
          </div>
          <div>
            <h3 class="text-gray-900 font-black text-xl sm:text-2xl">Online</h3>
            <p class="text-gray-500 text-xs sm:text-sm mt-1 font-medium">Video calls & remote sessions</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle w-full sm:w-auto justify-end">
          <button class="toggle-btn speak-btn rounded-xl sm:rounded-2xl px-6 sm:px-8 py-2.5 sm:py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-green-400 bg-white flex-1 sm:flex-initial" data-label="Online" data-value="Yes">
            Yes
          </button>
          <button class="toggle-btn speak-btn rounded-xl sm:rounded-2xl px-6 sm:px-8 py-2.5 sm:py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-red-400 bg-white flex-1 sm:flex-initial" data-label="Online" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>

    <!-- In Person -->
    <div class="comm-card border-3 border-blue-400 rounded-3xl px-6 sm:px-8 py-6 bg-white shadow-lg">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center space-x-4 flex-1">
          <div class="icon-wrapper w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-3xl sm:text-4xl shadow-xl flex-shrink-0">
            🤝
          </div>
          <div>
            <h3 class="text-gray-900 font-black text-xl sm:text-2xl">In Person</h3>
            <p class="text-gray-500 text-xs sm:text-sm mt-1 font-medium">Face-to-face meetings</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle w-full sm:w-auto justify-end">
          <button class="toggle-btn speak-btn rounded-xl sm:rounded-2xl px-6 sm:px-8 py-2.5 sm:py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-green-400 bg-white flex-1 sm:flex-initial" data-label="In Person" data-value="Yes">
            Yes
          </button>
          <button class="toggle-btn speak-btn rounded-xl sm:rounded-2xl px-6 sm:px-8 py-2.5 sm:py-3 text-base sm:text-lg font-bold border-3 border-gray-300 text-gray-700 hover:border-red-400 bg-white flex-1 sm:flex-initial" data-label="In Person" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep7" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep8" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const speakButtons = document.querySelectorAll('.speak-btn');
      const nextBtn = document.getElementById('nextStep8');
      const selections = {
        'Online': null,
        'In Person': null
      };

      function checkValidation() {
        // Vérifier si au moins un "Yes" a été sélectionné
        const hasAtLeastOneYes = selections['Online'] === 'Yes' || selections['In Person'] === 'Yes';
        
        if (nextBtn) {
          nextBtn.disabled = !hasAtLeastOneYes;
        }

        // Save localStorage
        localStorage.setItem('communicationPreference', JSON.stringify(selections));
      }

      speakButtons.forEach(btn => {
        btn.addEventListener('click', function() {
          const label = this.dataset.label;
          const value = this.dataset.value;
          const toggleGroup = this.closest('.speak-toggle');
          const buttons = toggleGroup.querySelectorAll('.speak-btn');

          // Reset autres boutons du groupe
          buttons.forEach(b => {
            b.classList.remove('active', 'yes-active', 'no-active');
          });

          // Activer le bouton cliqué
          this.classList.add('active');
          if (value === 'Yes') {
            this.classList.add('yes-active');
          } else {
            this.classList.add('no-active');
          }

          // Enregistrer
          selections[label] = value;
          checkValidation();
        });
      });

      // Restore localStorage
      const saved = localStorage.getItem('communicationPreference');
      if (saved) {
        const savedSelections = JSON.parse(saved);
        speakButtons.forEach(btn => {
          const label = btn.dataset.label;
          const value = btn.dataset.value;
          if (savedSelections[label] === value) {
            btn.classList.add('active');
            if (value === 'Yes') {
              btn.classList.add('yes-active');
            } else {
              btn.classList.add('no-active');
            }
            selections[label] = value;
          }
        });
        checkValidation();
      }

      // Vérification initiale
      setTimeout(checkValidation, 200);
    });
  </script>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep8');
    const stepElement = document.getElementById('step8');
    
    function checkValidation() {
        // Vérifier qu'au moins un bouton "Yes" est actif
        const hasYes = document.querySelector('#step8 .yes-active') !== null;
        if (nextBtn) {
            nextBtn.disabled = !hasYes;
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