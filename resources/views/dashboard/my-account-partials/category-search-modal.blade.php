<!-- Category Search Popup -->
<div id="selectet-provider-category" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex justify-center items-center p-4 modal-overlay" style="display: none; visibility: visible; opacity: 1;" role="dialog" aria-modal="true" aria-labelledby="category-title">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden transform transition-all modal-content">
    
    <!-- Header with gradient -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 sm:p-8 text-white relative overflow-hidden flex-shrink-0">
      <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20" aria-hidden="true"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16" aria-hidden="true"></div>
      
      <button 
        onclick="closeAllPopups()" 
        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 text-white transition-all focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600"
        aria-label="Fermer la fenêtre"
        type="button">
        <i class="fas fa-times text-lg" aria-hidden="true"></i>
      </button>
      
      <div class="relative z-10">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
          <i class="fas fa-layer-group text-2xl" aria-hidden="true"></i>
        </div>
        <h2 id="category-title" class="text-2xl sm:text-3xl font-bold mb-2">Choisissez votre catégorie</h2>
        <p class="text-blue-100 text-sm">Sélectionnez le service qui correspond à votre expertise</p>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="px-6 pt-6 pb-4 bg-gray-50 border-b border-gray-100 flex-shrink-0">
      <div class="relative">
        <label for="categorySearchInput" class="sr-only">Rechercher une catégorie</label>
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fas fa-search text-gray-400" aria-hidden="true"></i>
        </div>
        <input 
          type="search" 
          id="categorySearchInput"
          name="category_search"
          autocomplete="off"
          placeholder="Rechercher une catégorie..." 
          aria-label="Rechercher parmi les catégories disponibles"
          class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors text-sm min-h-[44px]"
        />
      </div>
      <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
        <i class="fas fa-info-circle text-blue-500" aria-hidden="true"></i>
        Vous pourrez ajouter plusieurs catégories à votre profil
      </p>
    </div>

    <!-- Categories Content (scrollable) -->
    <div class="flex-1 overflow-y-auto p-6 category-list" id="render-selectet-provider-category" role="list" aria-live="polite" aria-label="Liste des catégories">
      <!-- Le contenu sera injecté dynamiquement ici -->
      <div class="flex flex-col items-center justify-center py-12 text-center" role="status">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-4">
          <i class="fas fa-spinner fa-spin text-blue-600 text-3xl" aria-hidden="true"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Chargement des catégories...</h3>
        <p class="text-sm text-gray-500">Veuillez patienter un instant</p>
      </div>
    </div>

    <!-- Footer info -->
    <aside class="px-6 py-4 bg-gradient-to-br from-blue-50 to-indigo-50 border-t border-blue-100 flex-shrink-0" role="complementary" aria-label="Conseil">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
          <i class="fas fa-star text-blue-600" aria-hidden="true"></i>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs text-gray-600">
            <span class="font-semibold text-blue-700">Astuce :</span> Choisissez les catégories où vous excellez pour maximiser vos opportunités de missions
          </p>
        </div>
      </div>
    </aside>
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
}

/* Custom scrollbar optimisé */
.category-list {
  scrollbar-width: thin;
  scrollbar-color: #cbd5e1 #f1f5f9;
}

.category-list::-webkit-scrollbar {
  width: 8px;
}

.category-list::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

.category-list::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}

.category-list::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}

/* Category card hover avec prefers-reduced-motion */
@media (prefers-reduced-motion: no-preference) {
  .category-card {
    transition: all 0.2s ease;
  }
  
  .category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }
}

.category-card:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}

/* Responsive */
@media (max-width: 640px) {
  #selectet-provider-category > div {
    max-height: 95vh;
    margin: 0.5rem;
    border-radius: 1.5rem;
  }
}

/* High contrast mode */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .border-gray-200 {
    border-color: #6b7280;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('categorySearchInput');
  const categoriesList = document.getElementById('render-selectet-provider-category');
  
  if (searchInput) {
    // Debounce pour optimiser les performances
    let debounceTimer;
    searchInput.addEventListener('input', function(e) {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        const searchTerm = e.target.value.toLowerCase().trim();
        const categoryCards = categoriesList.querySelectorAll('.category-card');
        let visibleCount = 0;
        
        categoryCards.forEach(card => {
          const categoryName = card.textContent.toLowerCase();
          const shouldShow = categoryName.includes(searchTerm);
          card.style.display = shouldShow ? '' : 'none';
          if (shouldShow) visibleCount++;
        });
        
        // Annoncer les résultats pour les lecteurs d'écran
        const announcement = document.createElement('div');
        announcement.className = 'sr-only';
        announcement.setAttribute('role', 'status');
        announcement.setAttribute('aria-live', 'polite');
        announcement.textContent = `${visibleCount} catégorie${visibleCount > 1 ? 's' : ''} trouvée${visibleCount > 1 ? 's' : ''}`;
        categoriesList.appendChild(announcement);
        setTimeout(() => announcement.remove(), 1000);
      }, 300);
    });
    
    // Gérer Escape pour fermer
    searchInput.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAllPopups();
      }
    });
  }
  
  // Focus trap
  const modal = document.getElementById('selectet-provider-category');
  if (modal) {
    modal.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAllPopups();
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
  }
});

function closeAllPopups() {
  const modal = document.getElementById('selectet-provider-category');
  modal.classList.add('hidden');
  document.body.style.overflow = '';
  
  // Restaurer le focus sur l'élément qui a ouvert le modal
  const trigger = document.querySelector('[data-opens-category-modal]');
  if (trigger) trigger.focus();
}
</script>