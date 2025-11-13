<!-- Regular User Section -->
<div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl shadow-xl p-6 sm:p-8 max-w-6xl mx-auto mb-6 relative overflow-hidden">
  <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32" aria-hidden="true"></div>
  <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24" aria-hidden="true"></div>
  
  <div class="relative z-10 text-white">
    <div class="flex items-center gap-4 mb-4">
      <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
        <i class="fas fa-user-circle text-2xl" aria-hidden="true"></i>
      </div>
      <div class="flex-1 min-w-0">
        <h1 class="text-2xl sm:text-3xl font-bold mb-1">Mon Compte</h1>
        <p class="text-blue-100 text-sm">Gérez vos informations personnelles et vos préférences</p>
      </div>
    </div>
  </div>
</div>

<!-- Personal Information Section for Regular Users -->
<div class="max-w-6xl mx-auto pb-24 sm:pb-20 lg:pb-8">
  
  <!-- Stats Overview -->
  <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6" aria-label="Vue d'ensemble du compte">
    <div class="stat-card bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
          <i class="fas fa-check-circle text-blue-600 text-xl" aria-hidden="true"></i>
        </div>
        <div class="flex-1 min-w-0">
          <div class="text-sm text-gray-600">Profil</div>
          <div class="text-lg font-bold text-gray-800">Vérifié</div>
        </div>
      </div>
    </div>

    <div class="stat-card bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
          <i class="fas fa-shield-check text-green-600 text-xl" aria-hidden="true"></i>
        </div>
        <div class="flex-1 min-w-0">
          <div class="text-sm text-gray-600">Sécurité</div>
          <div class="text-lg font-bold text-gray-800">Active</div>
        </div>
      </div>
    </div>

    <div class="stat-card bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
          <i class="fas fa-star text-purple-600 text-xl" aria-hidden="true"></i>
        </div>
        <div class="flex-1 min-w-0">
          <div class="text-sm text-gray-600">Statut</div>
          <div class="text-lg font-bold text-gray-800">Membre</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Account Settings Card -->
  <section class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden mb-6" aria-labelledby="settings-heading">
    <div class="bg-gradient-to-br from-gray-50 to-gray-100/50 border-b border-gray-100 p-6">
      <h2 id="settings-heading" class="text-xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fas fa-sliders-h text-blue-600" aria-hidden="true"></i>
        Paramètres du compte
      </h2>
      <p class="text-sm text-gray-600 mt-1">Personnalisez votre expérience sur la plateforme</p>
    </div>

    <!-- Settings Grid -->
    <nav class="p-6" aria-label="Navigation des paramètres du compte">
      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" role="list">
        
        <!-- Personal Information -->
        <li>
          <a href="{{ route('personal-info') }}" class="settings-card group bg-gradient-to-br from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200/50 border-2 border-blue-200 hover:border-blue-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-user-edit text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-blue-700 text-lg mb-1">Informations personnelles</div>
                  <div class="text-xs text-gray-600">Modifier votre profil</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-blue-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Security Settings -->
        <li>
          <a href="#" class="settings-card group bg-gradient-to-br from-green-50 to-green-100/50 hover:from-green-100 hover:to-green-200/50 border-2 border-green-200 hover:border-green-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-lock text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-green-700 text-lg mb-1">Sécurité</div>
                  <div class="text-xs text-gray-600">Mot de passe & 2FA</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-green-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Notifications -->
        <li>
          <a href="#" class="settings-card group bg-gradient-to-br from-purple-50 to-purple-100/50 hover:from-purple-100 hover:to-purple-200/50 border-2 border-purple-200 hover:border-purple-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-bell text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-purple-700 text-lg mb-1">Notifications</div>
                  <div class="text-xs text-gray-600">Préférences d'alertes</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-purple-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Privacy -->
        <li>
          <a href="#" class="settings-card group bg-gradient-to-br from-orange-50 to-orange-100/50 hover:from-orange-100 hover:to-orange-200/50 border-2 border-orange-200 hover:border-orange-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-user-shield text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-orange-700 text-lg mb-1">Confidentialité</div>
                  <div class="text-xs text-gray-600">Gérer vos données</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-orange-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Language -->
        <li>
          <a href="#" class="settings-card group bg-gradient-to-br from-indigo-50 to-indigo-100/50 hover:from-indigo-100 hover:to-indigo-200/50 border-2 border-indigo-200 hover:border-indigo-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-language text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-indigo-700 text-lg mb-1">Langue</div>
                  <div class="text-xs text-gray-600">Préférences linguistiques</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-indigo-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

        <!-- Help -->
        <li>
          <a href="#" class="settings-card group bg-gradient-to-br from-gray-50 to-gray-100/50 hover:from-gray-100 hover:to-gray-200/50 border-2 border-gray-200 hover:border-gray-400 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 block min-h-[180px]">
            <div class="flex flex-col items-center text-center space-y-3 h-full justify-between">
              <div class="flex flex-col items-center gap-3">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                  <i class="fas fa-question-circle text-white text-2xl" aria-hidden="true"></i>
                </div>
                <div>
                  <div class="font-bold text-gray-800 group-hover:text-gray-700 text-lg mb-1">Aide & Support</div>
                  <div class="text-xs text-gray-600">Besoin d'assistance ?</div>
                </div>
              </div>
              <span class="flex items-center gap-1 text-gray-600 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" aria-hidden="true">
                Accéder <i class="fas fa-arrow-right text-xs"></i>
              </span>
            </div>
          </a>
        </li>

      </ul>
    </nav>
  </section>

  <!-- Quick Actions -->
  <aside class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200 p-6" role="complementary" aria-labelledby="help-section">
    <div class="flex items-start gap-4">
      <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
        <i class="fas fa-lightbulb text-amber-600 text-xl" aria-hidden="true"></i>
      </div>
      <div class="flex-1 min-w-0">
        <h3 id="help-section" class="font-semibold text-gray-800 mb-2">Besoin d'aide ?</h3>
        <p class="text-sm text-gray-600 mb-4">Notre équipe support est disponible pour répondre à toutes vos questions</p>
        <div class="flex flex-wrap gap-2">
          <a href="#" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 min-h-[44px]">
            <i class="fas fa-comments" aria-hidden="true"></i>
            Chat en direct
          </a>
          <a href="#" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors border border-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 min-h-[44px]">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            Email
          </a>
        </div>
      </div>
    </div>
  </aside>
</div>

<style>
/* Transitions optimisées avec prefers-reduced-motion */
@media (prefers-reduced-motion: no-preference) {
  .stat-card, .settings-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  
  .stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
  }
  
  .settings-card:hover {
    transform: scale(1.02);
  }
}

/* High contrast support */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .border-gray-200 {
    border-color: #6b7280;
  }
}

/* Responsive */
@media (max-width: 640px) {
  .settings-card {
    min-height: 160px;
  }
}
</style>