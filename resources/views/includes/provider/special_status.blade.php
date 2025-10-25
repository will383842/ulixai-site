<div id="step7" class="hidden">
  <style>
    @keyframes badge-pop {
      0% { transform: scale(0); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }
    .status-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
    }
    .status-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }
    .status-card.selected {
      background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
      border-color: #8b5cf6;
      transform: scale(1.03);
    }
    .status-card.selected span {
      color: white;
      font-weight: 600;
    }
    .status-badge {
      animation: badge-pop 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
  </style>

  <!-- Header moderne -->
  <div class="mb-6 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-violet-600 via-purple-500 to-pink-500 bg-clip-text text-transparent mb-3">
      ⭐ Special Status
    </h2>
    <p class="text-gray-600 text-base font-medium">Optional • Boost your profile</p>
  </div>

  <!-- Alerte info stylée -->
  <div class="mb-6 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-400 py-4 px-6">
    <div class="flex items-center">
      <span class="text-3xl mr-3">💡</span>
      <span class="text-blue-900 font-semibold text-base">Not mandatory but helps you stand out!</span>
    </div>
  </div>

  <!-- Zone badges sélectionnés -->
  <div id="selectedBadgesContainer" class="mb-6 hidden">
    <div class="bg-gradient-to-r from-violet-50 to-purple-50 rounded-2xl p-5 border-2 border-violet-200">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg font-bold text-violet-900 flex items-center">
          ✨ Your Status 
          <span id="badgeCounter" class="ml-2 bg-violet-600 text-white text-sm px-3 py-1 rounded-full">0</span>
        </h3>
        <button id="clearAllStatus" class="text-red-500 hover:text-red-700 text-sm font-semibold hover:underline">
          Clear All
        </button>
      </div>
      <div id="selectedBadges" class="flex flex-wrap gap-2"></div>
    </div>
  </div>

  <!-- Liste des statuts -->
  <div class="space-y-3 mb-6 max-h-96 overflow-y-auto p-1">
    @php
      $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
    @endphp

    @foreach ($statuses as $label)
    <div class="status-card border-3 border-gray-200 rounded-2xl px-6 py-4 bg-white hover:border-violet-400" data-status="{{ $label }}">
      <input type="checkbox" class="status-checkbox absolute opacity-0" data-label="{{ $label }}">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <div class="w-12 h-12 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-2xl shadow-lg">
            ⭐
          </div>
          <span class="font-semibold text-gray-700 text-base">{{ $label }}</span>
        </div>
        <div class="checkmark w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-lg hidden">
          <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-200">
    <button 
      id="backToStep6" 
      class="group flex items-center space-x-2 text-gray-700 hover:text-violet-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep7" 
      class="group bg-gradient-to-r from-violet-600 to-purple-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3"
    >
      <span>Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.status-card');
      const badgesContainer = document.getElementById('selectedBadgesContainer');
      const badgesArea = document.getElementById('selectedBadges');
      const badgeCounter = document.getElementById('badgeCounter');
      const clearAllBtn = document.getElementById('clearAllStatus');

      // Créer un badge
      function createBadge(statusName) {
        const badge = document.createElement('div');
        badge.className = 'status-badge flex items-center space-x-2 bg-gradient-to-r from-violet-500 to-purple-500 text-white px-4 py-2 rounded-full font-semibold shadow-lg';
        badge.innerHTML = `
          <span>⭐ ${statusName}</span>
          <button class="remove-badge hover:bg-white hover:text-violet-600 rounded-full p-1 transition-all" data-status="${statusName}">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </button>
        `;
        return badge;
      }

      // Update selection
      function updateSelection() {
        const selected = document.querySelectorAll('.status-checkbox:checked');
        badgesArea.innerHTML = '';
        
        if (selected.length > 0) {
          badgesContainer.classList.remove('hidden');
          badgeCounter.textContent = selected.length;
          
          selected.forEach(checkbox => {
            const badge = createBadge(checkbox.dataset.label);
            badgesArea.appendChild(badge);
          });

          // Events remove
          document.querySelectorAll('.remove-badge').forEach(btn => {
            btn.addEventListener('click', function(e) {
              e.stopPropagation();
              const status = this.dataset.status;
              const card = document.querySelector(`.status-card[data-status="${status}"]`);
              const checkbox = card.querySelector('.status-checkbox');
              checkbox.checked = false;
              card.classList.remove('selected');
              card.querySelector('.checkmark').classList.add('hidden');
              updateSelection();
            });
          });
        } else {
          badgesContainer.classList.add('hidden');
        }

        // Save localStorage
        const selectedStatuses = Array.from(selected).map(cb => cb.dataset.label);
        localStorage.setItem('specialStatuses', JSON.stringify(selectedStatuses));
      }

      // Click sur cards
      cards.forEach(card => {
        card.addEventListener('click', function() {
          const checkbox = this.querySelector('.status-checkbox');
          const checkmark = this.querySelector('.checkmark');
          
          checkbox.checked = !checkbox.checked;
          
          if (checkbox.checked) {
            this.classList.add('selected');
            checkmark.classList.remove('hidden');
          } else {
            this.classList.remove('selected');
            checkmark.classList.add('hidden');
          }
          
          updateSelection();
        });
      });

      // Clear All
      clearAllBtn.addEventListener('click', function() {
        document.querySelectorAll('.status-checkbox:checked').forEach(cb => {
          cb.checked = false;
        });
        cards.forEach(card => {
          card.classList.remove('selected');
          card.querySelector('.checkmark').classList.add('hidden');
        });
        updateSelection();
      });

      // Restore localStorage
      const saved = localStorage.getItem('specialStatuses');
      if (saved) {
        const selectedStatuses = JSON.parse(saved);
        cards.forEach(card => {
          const checkbox = card.querySelector('.status-checkbox');
          if (selectedStatuses.includes(checkbox.dataset.label)) {
            checkbox.checked = true;
            card.classList.add('selected');
            card.querySelector('.checkmark').classList.remove('hidden');
          }
        });
        updateSelection();
      }
    });
  </script>
</div>