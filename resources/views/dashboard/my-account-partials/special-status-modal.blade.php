<!-- Special Status Modal -->
<div id="specialStatusModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4 modal-overlay" role="dialog" aria-modal="true" aria-labelledby="special-status-title">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden transform transition-all modal-content">
    
    <!-- Header with gradient -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 sm:p-8 text-white relative overflow-hidden flex-shrink-0">
      <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20" aria-hidden="true"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16" aria-hidden="true"></div>
      
      <button 
        id="closeSpecialStatusModal" 
        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 text-white transition-all focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600"
        aria-label="Fermer la fenêtre"
        type="button">
        <i class="fas fa-times text-lg" aria-hidden="true"></i>
      </button>
      
      <div class="relative z-10">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
          <i class="fas fa-crown text-2xl" aria-hidden="true"></i>
        </div>
        <h2 id="special-status-title" class="text-2xl sm:text-3xl font-bold mb-2">Statut spécial</h2>
        <p class="text-blue-100 text-sm">Indiquez si vous bénéficiez d'un statut particulier</p>
      </div>
    </div>

    <!-- Info Banner -->
    <div class="px-6 pt-6 pb-4 bg-gradient-to-br from-amber-50 to-orange-50 border-b border-amber-100 flex-shrink-0">
      <div class="flex items-start gap-3">
        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
          <i class="fas fa-info-circle text-amber-600" aria-hidden="true"></i>
        </div>
        <div class="flex-1 min-w-0">
          <h3 class="text-sm font-semibold text-gray-800 mb-1">Pourquoi ces informations ?</h3>
          <p class="text-xs text-gray-600">
            Ces statuts nous aident à mieux vous identifier et à vous proposer des missions adaptées à votre profil
          </p>
        </div>
      </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-y-auto p-6 status-list" role="list" aria-label="Liste des statuts spéciaux">
      <div class="space-y-4">
        @php
          $special_status = json_decode($provider->special_status, true) ?? [];
          $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
        @endphp

        @foreach ($statuses as $index => $status)
          @php
            $selected = $special_status[$status] ?? null;
            $colors = ['blue', 'purple', 'green', 'orange', 'indigo', 'pink'];
            $color = $colors[$index % count($colors)];
            $statusId = 'status-' . $index;
          @endphp
          
          <div class="special-status-item bg-white border-2 border-gray-200 rounded-2xl p-5 hover:border-{{ $color }}-300 hover:shadow-md transition-all" role="listitem">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <!-- Status Label -->
              <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-12 h-12 bg-{{ $color }}-100 rounded-xl flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-certificate text-{{ $color }}-600 text-lg" aria-hidden="true"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <label for="{{ $statusId }}" class="font-semibold text-gray-800 text-sm sm:text-base cursor-pointer">
                    {{ $status }}
                  </label>
                  <div class="text-xs text-gray-500 mt-0.5">Sélectionnez votre statut</div>
                </div>
              </div>

              <!-- Toggle Buttons -->
              <div class="flex gap-2 sm:gap-3 justify-end sm:justify-start" role="group" aria-labelledby="{{ $statusId }}">
                <button 
                  type="button"
                  class="toggle-btn yes-btn flex-1 sm:flex-initial px-6 py-2.5 rounded-xl text-sm font-semibold transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 min-h-[44px]
                    {{ $selected === true 
                      ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg border-2 border-green-600 focus:ring-green-500' 
                      : 'bg-white border-2 border-gray-300 text-gray-600 hover:border-green-400 hover:text-green-600 hover:bg-green-50 focus:ring-green-400' }}"
                  data-status="{{ $status }}" 
                  data-value="yes"
                  aria-pressed="{{ $selected === true ? 'true' : 'false' }}"
                  aria-label="Oui pour {{ $status }}">
                  <i class="fas fa-check mr-1" aria-hidden="true"></i> Oui
                </button>
                <button 
                  type="button"
                  class="toggle-btn no-btn flex-1 sm:flex-initial px-6 py-2.5 rounded-xl text-sm font-semibold transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 min-h-[44px]
                    {{ $selected === false 
                      ? 'bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg border-2 border-red-600 focus:ring-red-500' 
                      : 'bg-white border-2 border-gray-300 text-gray-600 hover:border-red-400 hover:text-red-600 hover:bg-red-50 focus:ring-red-400' }}"
                  data-status="{{ $status }}" 
                  data-value="no"
                  aria-pressed="{{ $selected === false ? 'true' : 'false' }}"
                  aria-label="Non pour {{ $status }}">
                  <i class="fas fa-times mr-1" aria-hidden="true"></i> Non
                </button>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if(count($statuses) === 0)
        <div class="flex flex-col items-center justify-center py-12 text-center" role="status">
          <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-inbox text-gray-400 text-3xl" aria-hidden="true"></i>
          </div>
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Aucun statut disponible</h3>
          <p class="text-sm text-gray-500">Les statuts spéciaux seront affichés ici</p>
        </div>
      @endif
    </div>

    <!-- Footer Actions -->
    <div class="px-6 py-5 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row gap-3 flex-shrink-0">
      <button 
        type="button"
        class="close-modal-btn order-2 sm:order-1 flex-1 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-3.5 px-6 rounded-xl transition-all border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 min-h-[44px]">
        <i class="fas fa-times mr-2" aria-hidden="true"></i>
        Annuler
      </button>
      <button 
        type="button"
        id="saveSpecialStatusBtn" 
        class="order-1 sm:order-2 flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px] flex items-center justify-center gap-2">
        <i class="fas fa-save" aria-hidden="true"></i>
        <span>Enregistrer les statuts</span>
      </button>
    </div>
  </div>
</div>

<style>
/* Modal animations */
@media (prefers-reduced-motion: no-preference) {
  .modal-overlay {
    animation: fadeIn 0.2s ease-out;
  }
  
  .modal-content {
    animation: scaleIn 0.3s ease-out;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes scaleIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }
}

/* Custom scrollbar optimisé */
.status-list {
  scrollbar-width: thin;
  scrollbar-color: #cbd5e1 #f1f5f9;
}

.status-list::-webkit-scrollbar {
  width: 8px;
}

.status-list::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

.status-list::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}

.status-list::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* Button states optimisés */
@media (prefers-reduced-motion: no-preference) {
  .toggle-btn {
    transition: all 0.2s ease;
  }
  
  .toggle-btn:active {
    transform: scale(0.95);
  }
  
  .special-status-item {
    transition: all 0.2s ease;
  }
}

/* High contrast support */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .border-gray-300 {
    border-color: #6b7280;
  }
}

/* Responsive */
@media (max-width: 640px) {
  .special-status-item {
    padding: 1rem;
  }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const statusData = @json($special_status);
    let selections = {...statusData};
    const modal = document.getElementById('specialStatusModal');

    // Toggle button handlers
    document.querySelectorAll('.special-status-item').forEach(item => {
        const yesBtn = item.querySelector('.yes-btn');
        const noBtn = item.querySelector('.no-btn');
        if (!yesBtn || !noBtn) return;

        const status = yesBtn.getAttribute('data-status');

        function updateButtonStates(activeBtn, inactiveBtn, value) {
            selections[status] = value;
            
            // Active button
            activeBtn.setAttribute('aria-pressed', 'true');
            activeBtn.classList.remove('bg-white', 'border-gray-300', 'text-gray-600', 'hover:border-green-400', 'hover:border-red-400', 'hover:text-green-600', 'hover:text-red-600', 'hover:bg-green-50', 'hover:bg-red-50');
            
            // Inactive button
            inactiveBtn.setAttribute('aria-pressed', 'false');
            inactiveBtn.classList.remove('bg-gradient-to-r', 'from-green-500', 'from-red-500', 'to-green-600', 'to-red-600', 'text-white', 'shadow-lg', 'border-2', 'border-green-600', 'border-red-600');
            inactiveBtn.classList.add('bg-white', 'border-2', 'border-gray-300', 'text-gray-600');
        }

        yesBtn.addEventListener('click', function () {
            updateButtonStates(yesBtn, noBtn, true);
            yesBtn.classList.add('bg-gradient-to-r', 'from-green-500', 'to-green-600', 'text-white', 'shadow-lg', 'border-2', 'border-green-600', 'focus:ring-green-500');
            noBtn.classList.add('hover:border-red-400', 'hover:text-red-600', 'hover:bg-red-50', 'focus:ring-red-400');
            
            // Announce for screen readers
            const announcement = document.createElement('div');
            announcement.className = 'sr-only';
            announcement.setAttribute('role', 'status');
            announcement.setAttribute('aria-live', 'polite');
            announcement.textContent = `${status} sélectionné comme Oui`;
            item.appendChild(announcement);
            setTimeout(() => announcement.remove(), 1000);
        });

        noBtn.addEventListener('click', function () {
            updateButtonStates(noBtn, yesBtn, false);
            noBtn.classList.add('bg-gradient-to-r', 'from-red-500', 'to-red-600', 'text-white', 'shadow-lg', 'border-2', 'border-red-600', 'focus:ring-red-500');
            yesBtn.classList.add('hover:border-green-400', 'hover:text-green-600', 'hover:bg-green-50', 'focus:ring-green-400');
            
            // Announce for screen readers
            const announcement = document.createElement('div');
            announcement.className = 'sr-only';
            announcement.setAttribute('role', 'status');
            announcement.setAttribute('aria-live', 'polite');
            announcement.textContent = `${status} sélectionné comme Non`;
            item.appendChild(announcement);
            setTimeout(() => announcement.remove(), 1000);
        });
    });

    // Save button handler
    document.getElementById('saveSpecialStatusBtn')?.addEventListener('click', function () {
        const btn = this;
        const originalHTML = btn.innerHTML;
        
        // Loading state
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2" aria-hidden="true"></i><span>Enregistrement...</span>';
        btn.setAttribute('aria-busy', 'true');
        
        fetch('/account/provider/special-status/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ special_status: selections })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                toastr.success('Statuts spéciaux enregistrés avec succès !', 'Succès');
                
                // Restore focus to trigger button
                const trigger = document.getElementById('openSpecialStatusModal');
                if (trigger) trigger.focus();
            } else {
                toastr.error('Erreur lors de l\'enregistrement', 'Erreur');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Une erreur est survenue', 'Erreur');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
            btn.removeAttribute('aria-busy');
        });
    });

    // Close modal handlers
    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        
        // Restore focus
        const trigger = document.getElementById('openSpecialStatusModal');
        if (trigger) trigger.focus();
    }

    document.querySelectorAll('#closeSpecialStatusModal, .close-modal-btn').forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    // Keyboard navigation - Escape key
    modal.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
        
        // Tab trap
        if (e.key === 'Tab') {
            const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstFocusable = focusableElements[0];
            const lastFocusable = focusableElements[focusableElements.length - 1];
            
            if (e.shiftKey) {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        }
    });

    // Open modal handler
    document.getElementById('openSpecialStatusModal')?.addEventListener('click', function() {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Focus first focusable element
        const firstFocusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (firstFocusable) {
            setTimeout(() => firstFocusable.focus(), 100);
        }
    });
});
</script>