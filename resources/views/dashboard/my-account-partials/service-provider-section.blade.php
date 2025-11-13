<!-- Service Provider Alert -->
<div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl shadow-xl p-6 sm:p-8 max-w-6xl mx-auto mb-6 relative overflow-hidden">
  <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32" aria-hidden="true"></div>
  <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24" aria-hidden="true"></div>
  
  <div class="relative z-10 text-white">
    <div class="flex items-center gap-4 mb-4">
      <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
        <i class="fas fa-briefcase text-2xl" aria-hidden="true"></i>
      </div>
      <div class="flex-1 min-w-0">
        <h1 class="text-2xl sm:text-3xl font-bold mb-1">Bienvenue, Prestataire !</h1>
        <p class="text-blue-100 text-sm">Complétez votre profil pour recevoir plus de missions</p>
      </div>
    </div>
  </div>
</div>

<!-- Profile Completion Section for Service Providers -->
<div class="max-w-6xl mx-auto pb-24 sm:pb-20 lg:pb-8">
  
  <!-- Progress Overview -->
  <section class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden mb-6" aria-labelledby="progress-heading">
    <div class="bg-gradient-to-br from-gray-50 to-gray-100/50 border-b border-gray-100 p-6">
      <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
          <h2 id="progress-heading" class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-tasks text-blue-600" aria-hidden="true"></i>
            Complétez votre profil
          </h2>
          <p class="text-sm text-gray-600 mt-1">6 étapes pour maximiser vos opportunités</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="text-right">
            <div class="text-2xl font-bold text-blue-600" aria-live="polite">60%</div>
            <div class="text-xs text-gray-500">Complété</div>
          </div>
          <div class="w-16 h-16 relative" role="img" aria-label="Progression à 60 pourcent">
            <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 64 64">
              <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="6" fill="none" />
              <circle cx="32" cy="32" r="28" stroke="#3b82f6" stroke-width="6" fill="none" 
                      stroke-dasharray="175.93" stroke-dashoffset="70.37" stroke-linecap="round" 
                      class="progress-circle" />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
              <i class="fas fa-chart-line text-blue-600 text-lg" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Progress Bar -->
    <div class="px-6 py-4 bg-blue-50/50">
      <div class="flex items-center gap-3">
        <div class="flex-1 bg-gray-200 rounded-full h-3 overflow-hidden" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" aria-label="Progression globale">
          <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-full rounded-full transition-all duration-700 shadow-lg progress-bar" style="width: 60%"></div>
        </div>
        <span class="text-sm font-semibold text-gray-700 whitespace-nowrap" aria-label="3 sur 6 étapes complétées">3 / 6</span>
      </div>
    </div>
  </section>

  <!-- Steps Grid -->
  <section class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-6" aria-labelledby="steps-heading">
    <h2 id="steps-heading" class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
      <i class="fas fa-list-check text-blue-600" aria-hidden="true"></i>
      Étapes de configuration
    </h2>

    <nav aria-label="Étapes de configuration du profil prestataire">
      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" role="list">
        
        <!-- Step 1: Personal Information -->
        <li>
          <a href="{{ route('personal-info') }}" class="step-card group bg-gradient-to-br from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200/50 border-2 border-blue-200 hover:border-blue-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 block relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
              <i class="fas fa-check" aria-hidden="true"></i>
              <span class="sr-only">Complété</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-user-edit text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-blue-700 mb-1">Informations personnelles</h3>
                  <p class="text-xs text-gray-600">Profil complété</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-blue-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Modifier <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Step 2: Documents -->
        <li>
          <a href="{{ route('my-documents') }}" class="step-card group bg-gradient-to-br from-purple-50 to-purple-100/50 hover:from-purple-100 hover:to-purple-200/50 border-2 border-purple-200 hover:border-purple-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 block relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded-full animate-pulse">
              <i class="fas fa-clock" aria-hidden="true"></i>
              <span class="sr-only">En attente</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-file-upload text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-purple-700 mb-1">Vos documents</h3>
                  <p class="text-xs text-gray-600">En attente</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Compléter <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Step 3: Terms & Conditions -->
        <li>
          <button type="button" class="step-card group bg-gradient-to-br from-green-50 to-green-100/50 hover:from-green-100 hover:to-green-200/50 border-2 border-green-200 hover:border-green-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 w-full relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
              <i class="fas fa-check" aria-hidden="true"></i>
              <span class="sr-only">Complété</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-file-contract text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-green-700 mb-1">Conditions générales</h3>
                  <p class="text-xs text-gray-600">Accepté</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-green-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Consulter <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </button>
        </li>

        <!-- Step 4: Categories -->
        <li>
          <button type="button" onclick="openCategoryPopup()" data-opens-category-modal class="step-card group bg-gradient-to-br from-orange-50 to-orange-100/50 hover:from-orange-100 hover:to-orange-200/50 border-2 border-orange-200 hover:border-orange-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 w-full relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-gray-300 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">
              <i class="fas fa-hourglass-half" aria-hidden="true"></i>
              <span class="sr-only">À définir</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-layer-group text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-orange-700 mb-1">Catégories</h3>
                  <p class="text-xs text-gray-600">À définir</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-orange-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Choisir <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </button>
        </li>

        <!-- Step 5: About You -->
        <li>
          <button type="button" onclick="openAboutYouPopup()" class="step-card group bg-gradient-to-br from-indigo-50 to-indigo-100/50 hover:from-indigo-100 hover:to-indigo-200/50 border-2 border-indigo-200 hover:border-indigo-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 w-full relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-gray-300 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">
              <i class="fas fa-hourglass-half" aria-hidden="true"></i>
              <span class="sr-only">À rédiger</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-user-tie text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-indigo-700 mb-1">À propos de vous</h3>
                  <p class="text-xs text-gray-600">À rédiger</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-indigo-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Rédiger <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </button>
        </li>

        <!-- Step 6: Special Status -->
        <li>
          <button type="button" id="openSpecialStatusModal" class="step-card group bg-gradient-to-br from-pink-50 to-pink-100/50 hover:from-pink-100 hover:to-pink-200/50 border-2 border-pink-200 hover:border-pink-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 w-full relative overflow-hidden min-h-[200px]">
            <span class="absolute top-2 right-2 flex items-center gap-1 bg-gray-300 text-gray-700 text-xs font-semibold px-2 py-1 rounded-full">
              <i class="fas fa-hourglass-half" aria-hidden="true"></i>
              <span class="sr-only">Optionnel</span>
            </span>
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-crown text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <h3 class="font-bold text-gray-800 group-hover:text-pink-700 mb-1">Statut spécial</h3>
                  <p class="text-xs text-gray-600">Optionnel</p>
                </div>
              </div>
              <span class="flex items-center gap-1 text-pink-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Définir <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </button>
        </li>

      </ul>
    </nav>
  </section>

  <!-- Benefits Section -->
  <aside class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200 p-6 mb-6" role="complementary" aria-labelledby="benefits-heading">
    <div class="flex items-start gap-4">
      <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <i class="fas fa-star text-amber-600 text-xl" aria-hidden="true"></i>
      </div>
      <div class="flex-1 min-w-0">
        <h3 id="benefits-heading" class="font-bold text-gray-800 mb-2 text-lg">Pourquoi compléter votre profil ?</h3>
        <ul class="space-y-2 text-sm text-gray-700" role="list">
          <li class="flex items-start gap-2">
            <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
            <span><strong>+300%</strong> de visibilité auprès des clients</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
            <span><strong>Priorité</strong> dans les résultats de recherche</span>
          </li>
          <li class="flex items-start gap-2">
            <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
            <span><strong>Badge</strong> de profil vérifié</span>
          </li>
        </ul>
      </div>
    </div>
  </aside>

  <!-- CTA Card -->
  <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-xl p-6 sm:p-8 text-center text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20" aria-hidden="true"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16" aria-hidden="true"></div>
    
    <div class="relative z-10">
      <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-trophy text-3xl" aria-hidden="true"></i>
      </div>
      <h2 class="text-xl sm:text-2xl font-bold mb-3">Calculez vos points Ulysse</h2>
      <p class="text-blue-100 text-sm mb-6 max-w-xl mx-auto">
        Découvrez comment améliorer votre réputation et gagner plus de points pour booster votre visibilité
      </p>
      <a href="{{ route('points-calculation') }}" class="inline-flex items-center gap-2 bg-white hover:bg-blue-50 text-blue-600 font-bold px-8 py-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 min-h-[56px]">
        <i class="fas fa-calculator" aria-hidden="true"></i>
        Calculer mes points
        <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</div>

<style>
/* Animations optimisées avec prefers-reduced-motion */
@media (prefers-reduced-motion: no-preference) {
  .progress-circle, .progress-bar {
    transition: stroke-dashoffset 0.7s ease, width 0.7s ease;
  }
  
  .step-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
  }
  
  .step-card:hover {
    transform: scale(1.02);
  }
  
  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }
  
  .animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
}

/* Focus visible pour accessibilité clavier */
.step-card:focus-visible {
  outline: 2px solid currentColor;
  outline-offset: 2px;
}

/* High contrast support */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .text-blue-100 {
    color: #dbeafe;
  }
  .border-gray-200 {
    border-color: #6b7280;
  }
}

/* Responsive */
@media (max-width: 640px) {
  .step-card {
    min-height: 180px;
  }
}

/* Touch targets minimum 44px */
.step-card, button, a {
  min-height: 44px;
  min-width: 44px;
}
</style>