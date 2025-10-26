<div id="step7" class="hidden">
  <style>
    @keyframes badge-pop {
      0% { transform: scale(0.95); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }
    .status-card {
      position: relative;
      overflow: hidden;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
    }
    .status-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      transition: left 0.5s;
    }
    .status-card:hover::before {
      left: 100%;
    }
    .status-card:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 12px 24px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
    }
    .status-card.selected {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      border-color: #1d4ed8;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
    }
    .status-card.selected .status-name {
      color: white;
      font-weight: 700;
    }
    .status-card.selected .status-icon {
      background: rgba(255, 255, 255, 0.25);
      animation: float 2s ease-in-out infinite;
    }
    .status-card.selected .status-check-indicator {
      background: white;
      border-color: white;
    }
    .status-card.selected .status-check-indicator svg {
      opacity: 1 !important;
      color: #3b82f6;
    }
    .status-badge {
      animation: badge-pop 0.3s ease-out;
    }
    .info-banner {
      background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
      position: relative;
      overflow: hidden;
    }
    .info-banner::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.05), transparent);
      animation: shimmer 3s infinite;
    }
  </style>

  <!-- Header avec gradient et animation -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">⭐</span>
      </div>
      <h2 class="font-black text-4xl sm:text-5xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent animate-gradient">
        Special Status
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold mb-2">
      Stand out from the crowd
    </p>
    <p class="text-gray-500 text-sm">
      Optional • Boost your profile visibility
    </p>
  </div>

  <!-- Alerte info premium -->
  <div class="info-banner mb-8 rounded-2xl border-2 border-blue-200 py-4 px-6 shadow-lg">
    <div class="flex items-center justify-center gap-4 relative z-10">
      <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center shadow-md">
        <span class="text-2xl">💡</span>
      </div>
      <div class="flex-1">
        <p class="text-blue-900 font-bold text-base mb-1">Pro Tip</p>
        <p class="text-blue-700 text-sm font-medium">Not mandatory but helps you stand out and get more visibility!</p>
      </div>
    </div>
  </div>

  <!-- Zone badges sélectionnés premium -->
  <div id="selectedBadgesContainer" class="mb-8 hidden">
    <div class="bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 rounded-2xl p-5 border-2 border-blue-300 shadow-lg">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md">
            <span class="text-xl">✨</span>
          </div>
          <div>
            <h3 class="text-base font-black text-blue-900">Your Special Status</h3>
            <p class="text-xs text-blue-600 font-semibold">
              <span id="badgeCounter">0</span> selected
            </p>
          </div>
        </div>
        <button id="clearAllStatus" class="text-red-500 hover:text-red-700 text-sm font-bold hover:underline transition-all px-3 py-1.5 rounded-lg hover:bg-red-50">
          Clear All
        </button>
      </div>
      <div id="selectedBadges" class="flex flex-wrap gap-3"></div>
    </div>
  </div>

  <!-- Liste des statuts avec design premium -->
  <div class="space-y-4 mb-8 max-h-[420px] overflow-y-auto p-2 pr-3">
    @php
      $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
    @endphp

    @foreach ($statuses as $label)
    <div class="status-card group border-2 border-blue-400 rounded-2xl p-4 bg-white hover:border-blue-500 shadow-md hover:shadow-xl" data-status="{{ $label }}">
      <input type="checkbox" class="status-checkbox absolute opacity-0" data-label="{{ $label }}">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4 flex-1">
          <div class="status-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center flex-shrink-0 transition-all shadow-sm">
            <span class="text-3xl">⭐</span>
          </div>
          <div class="flex-1">
            <span class="status-name font-bold text-gray-800 text-base leading-tight block transition-colors">{{ $label }}</span>
            <span class="text-xs text-gray-500 font-medium mt-1 block">Verified status</span>
          </div>
        </div>
        <div class="status-check-indicator w-8 h-8 rounded-full border-3 border-blue-400 flex items-center justify-center transition-all">
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
          </svg>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep6" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep7" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.status-card');
      const badgesContainer = document.getElementById('selectedBadgesContainer');
      const badgesArea = document.getElementById('selectedBadges');
      const badgeCounter = document.getElementById('badgeCounter');
      const clearAllBtn = document.getElementById('clearAllStatus');

      // Créer un badge premium
      function createBadge(statusName) {
        const badge = document.createElement('div');
        badge.className = 'status-badge inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white pl-4 pr-3 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all hover:scale-105';
        badge.innerHTML = `
          <div class="flex items-center gap-2">
            <span class="text-lg">⭐</span>
            <span>${statusName}</span>
          </div>
          <button class="remove-badge hover:bg-white hover:text-blue-600 rounded-lg p-1.5 transition-all" data-status="${statusName}">
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
          
          checkbox.checked = !checkbox.checked;
          
          if (checkbox.checked) {
            this.classList.add('selected');
          } else {
            this.classList.remove('selected');
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
          }
        });
        updateSelection();
      }
    });
  </script>
</div>