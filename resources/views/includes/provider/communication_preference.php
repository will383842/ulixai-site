<div id="step8" class="hidden">
  <style>
    .toggle-btn {
      transition: all 0.3s ease;
    }
    .toggle-btn.active {
      transform: scale(1.05);
    }
    .toggle-btn.yes-active {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      border-color: #10b981;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }
    .toggle-btn.no-active {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      border-color: #ef4444;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    }
    .comm-card {
      transition: all 0.3s ease;
    }
    .comm-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(99, 102, 241, 0.15);
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
      💬 How Would You Like to Connect?
    </h2>
    <p class="text-gray-500 text-base">Choose your preferred communication methods</p>
  </div>

  <!-- Choix Online/In Person -->
  <div class="space-y-6 mb-8">
    <!-- Online -->
    <div class="comm-card border-2 border-gray-200 rounded-3xl px-8 py-6 bg-white">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-5">
          <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-4xl shadow-xl">
            💻
          </div>
          <div>
            <h3 class="text-gray-900 font-bold text-2xl">Online</h3>
            <p class="text-gray-400 text-sm mt-1">Video calls & remote sessions</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle">
          <button class="toggle-btn speak-btn rounded-2xl px-8 py-3 text-lg font-bold border-2 border-gray-300 text-gray-700 hover:border-green-400 bg-white" data-label="Online" data-value="Yes">
            Yes
          </button>
          <button class="toggle-btn speak-btn rounded-2xl px-8 py-3 text-lg font-bold border-2 border-gray-300 text-gray-700 hover:border-red-400 bg-white" data-label="Online" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>

    <!-- In Person -->
    <div class="comm-card border-2 border-gray-200 rounded-3xl px-8 py-6 bg-white">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-5">
          <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-4xl shadow-xl">
            🤝
          </div>
          <div>
            <h3 class="text-gray-900 font-bold text-2xl">In Person</h3>
            <p class="text-gray-400 text-sm mt-1">Face-to-face meetings</p>
          </div>
        </div>
        <div class="flex space-x-3 speak-toggle">
          <button class="toggle-btn speak-btn rounded-2xl px-8 py-3 text-lg font-bold border-2 border-gray-300 text-gray-700 hover:border-green-400 bg-white" data-label="In Person" data-value="Yes">
            Yes
          </button>
          <button class="toggle-btn speak-btn rounded-2xl px-8 py-3 text-lg font-bold border-2 border-gray-300 text-gray-700 hover:border-red-400 bg-white" data-label="In Person" data-value="No">
            No
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep7" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep8" 
      class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-none"
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
      const speakButtons = document.querySelectorAll('.speak-btn');
      const nextBtn = document.getElementById('nextStep8');
      const selections = {
        'Online': null,
        'In Person': null
      };

      function checkValidation() {
        // Vérifier si les 2 questions ont une réponse
        if (selections['Online'] && selections['In Person']) {
          nextBtn.disabled = false;
        } else {
          nextBtn.disabled = true;
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
    });
  </script>
</div>