{{-- 
  ═══════════════════════════════════════════════════════════
  📱 NAVBAR MOBILE COMPONENT - VERSION UNIFIÉE PARFAITE
  ═══════════════════════════════════════════════════════════
  
  Navigation mobile unifiée qui gère :
  - Liens du site (Aide, SOS)
  - Liens dashboard (quand connecté)
  - Badge de notifications synchronisé avec Echo/Pusher
  - Authentification (Login/Signup)
  
  @version 3.1.0 - PERFECTION
  @updated 2025-01-11
--}}

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE HEADER
     ═══════════════════════════════════════════════════════════ --}}
<header class="lg:hidden fixed top-0 left-0 w-full bg-white z-[60] shadow-md" role="banner">
  <div class="grid grid-cols-[auto_1fr_auto] items-center px-3 py-3 gap-3">
    
    {{-- Logo à gauche --}}
    <div class="flex items-center justify-start">
      <a href="/" aria-label="ULIXAI Home">
        <img src="/images/headerlogos.png" alt="ULIXAI Logo" class="w-10 h-10 object-contain" width="40" height="40" />
      </a>
    </div>

    {{-- Boutons au centre --}}
    <nav class="flex items-center justify-center gap-2.5" aria-label="Main navigation">
      <button 
        id="mobileSearchButton"
        type="button"
        class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg whitespace-nowrap" 
        aria-label="Request help">
        <span class="flex items-center gap-2">
          <i class="fas fa-hand-paper text-base" aria-hidden="true"></i>
          <span>Aide</span>
        </span>
      </button>

      <a href="https://sos-expat.com/" 
         target="_blank"
         rel="noopener noreferrer"
         class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg whitespace-nowrap"
         aria-label="Emergency SOS">
        <span class="flex items-center gap-2">
          <i class="fas fa-phone-alt text-base" aria-hidden="true"></i>
          <span>SOS</span>
        </span>
      </a>
    </nav>

    {{-- Hamburger à droite --}}
    <div class="flex items-center justify-end">
      <button id="menu-toggle-top" type="button" class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
        <div class="w-6 h-6 flex flex-col justify-center items-center gap-1.5">
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
        </div>
      </button>
    </div>
  </div>
</header>

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU OVERLAY - Fermeture instantanée
     ═══════════════════════════════════════════════════════════ --}}
<div id="mobile-menu-overlay" class="lg:hidden fixed top-[62px] left-0 right-0 bottom-0 bg-black/40 backdrop-blur-sm z-40 hidden" aria-hidden="true"></div>

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU - Animation rapide
     ═══════════════════════════════════════════════════════════ --}}
<nav id="mobile-menu" class="lg:hidden fixed top-[62px] left-0 right-0 bg-white z-50 shadow-2xl rounded-b-3xl transform -translate-y-full transition-transform duration-200 ease-out max-h-[calc(100vh-62px)] overflow-y-auto" role="navigation" aria-label="Mobile menu" aria-hidden="true">
  
  <div class="px-6 py-6 space-y-4">
    <ul class="space-y-2" role="menu">
      @if(Auth::check())
        @php
          $user = Auth::user();
          $provider = $user?->serviceProvider;
          $profilePhoto = $provider?->profile_photo ? asset($provider->profile_photo) : null;
          $avatar = $user?->avatar ? asset($user->avatar) : null;
          $default = asset('images/helpexpat.png');
          $backgroundImage = "url('{$profilePhoto}'), url('{$avatar}'), url('{$default}')";
          
          // Notifications count - EXACTEMENT comme dans la sidebar
          $unreadMessagesCount = method_exists($user, 'unreadMessagesCount') ? ($user->unreadMessagesCount() ?? 0) : 0;
        @endphp
        
        {{-- ═══════════════════════════════════════════════════════════
             👤 SECTION PROFIL
             ═══════════════════════════════════════════════════════════ --}}
        <li role="none" class="border-b border-gray-200 pb-4 mb-4">
          <div class="flex items-center gap-3 px-4 py-2">
            <div class="w-12 h-12 rounded-full border-2 border-blue-200 bg-center bg-cover shadow-sm"
                 style="background-image: {{ $backgroundImage }};"></div>
            <div class="flex-1 min-w-0">
              <p class="font-bold text-gray-900 truncate text-base">{{ $user->name }}</p>
              @php
                $rawRole = (string)($user->user_role ?? '');
                $key = strtolower(str_replace(['-', ' '], '_', $rawRole));
                $roles = [
                  'service_provider' => ['label' => 'Prestataire', 'cls' => 'bg-emerald-100 text-emerald-700'],
                  'service_requester' => ['label' => 'Demandeur', 'cls' => 'bg-indigo-100 text-indigo-700'],
                  'admin' => ['label' => 'Admin', 'cls' => 'bg-rose-100 text-rose-700'],
                ];
                $role = $roles[$key] ?? ['label' => 'Utilisateur', 'cls' => 'bg-gray-100 text-gray-700'];
              @endphp
              <span class="inline-block text-xs px-2.5 py-1 rounded-full {{ $role['cls'] }} font-semibold mt-1">
                {{ $role['label'] }}
              </span>
            </div>
          </div>
        </li>

        {{-- ═══════════════════════════════════════════════════════════
             📊 SECTION DASHBOARD
             ═══════════════════════════════════════════════════════════ --}}
        <li role="none" class="mb-3">
          <div class="px-4 py-2">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mon espace</p>
          </div>
        </li>

        <li role="none">
          <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-gauge text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li role="none">
          <a href="{{ route('user.service.requests') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-list-check text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Mes demandes</span>
          </a>
        </li>

        @if($user->user_role == 'service_provider')
        <li role="none">
          <a href="{{ route('user.joblist') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-briefcase text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Mes missions</span>
          </a>
        </li>
        @endif

        <li role="none">
          <a href="{{ route('user.earnings') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-euro-sign text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Mes revenus</span>
          </a>
        </li>

        {{-- ⚡ MESSAGERIE AVEC BADGE - SYNCHRONISÉ AVEC ECHO/PUSHER --}}
        <li role="none">
          <a href="{{ route('user.conversation') }}" 
             class="flex items-center justify-between px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <div class="flex items-center gap-3">
              <div class="relative w-5 flex items-center justify-center">
                <i class="fas fa-envelope text-blue-600" aria-hidden="true"></i>
                {{-- BADGE CRITIQUE : ID requis pour Echo/Pusher dans master.blade.php --}}
                <span class="bg-gradient-to-br from-red-500 to-red-600 rounded-full text-white text-[10px] font-bold absolute -top-1.5 -right-2 min-w-[18px] h-[18px] flex items-center justify-center shadow-lg border-2 border-white {{ $unreadMessagesCount == 0 ? 'hidden' : '' }}" 
                      data-value="{{ $unreadMessagesCount }}" 
                      id="private_messages_notification">{{ $unreadMessagesCount > 0 ? $unreadMessagesCount : '' }}</span>
              </div>
              <span>Messagerie</span>
            </div>
            {{-- Badge secondaire visible --}}
            @if($unreadMessagesCount > 0)
              <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                {{ $unreadMessagesCount }}
              </span>
            @endif
          </a>
        </li>

        <li role="none">
          <a href="{{ route('user.account') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-user text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Mon compte</span>
          </a>
        </li>

        <li role="none">
          <a href="{{ route('user.payments.validate') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-credit-card text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Paiements</span>
          </a>
        </li>

        {{-- ═══════════════════════════════════════════════════════════
             🌐 SECTION SITE / AUTRES
             ═══════════════════════════════════════════════════════════ --}}
        <li role="none" class="border-t border-gray-200 pt-4 mt-4">
          <div class="px-4 py-2">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Autres services</p>
          </div>
        </li>

        @if($user->user_role != 'service_provider')
        <li role="none">
          <a href="/become-service-provider" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-file-signature text-purple-600 w-5 text-center" aria-hidden="true"></i>
            <span>Devenir prestataire</span>
          </a>
        </li>
        @endif

        <li role="none">
          <a href="{{ route('user.affiliate.account') }}" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-handshake text-orange-600 w-5 text-center" aria-hidden="true"></i>
            <span>Programme d'affiliation</span>
          </a>
        </li>

        {{-- ═══════════════════════════════════════════════════════════
             🚪 LOGOUT
             ═══════════════════════════════════════════════════════════ --}}
        <li role="none" class="border-t border-gray-200 pt-4 mt-4">
          <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" 
                    class="w-full text-left flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-red-50 text-red-600 font-bold transition-all duration-200" 
                    role="menuitem">
              <i class="fas fa-right-from-bracket w-5 text-center" aria-hidden="true"></i>
              <span>Déconnexion</span>
            </button>
          </form>
        </li>

      @else
        {{-- ═══════════════════════════════════════════════════════════
             👥 MENU VISITEUR (NON CONNECTÉ)
             ═══════════════════════════════════════════════════════════ --}}
        <li role="none">
          <a href="/become-service-provider" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-file-signature text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Devenir prestataire</span>
          </a>
        </li>

        <li role="none">
          <a href="/login" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-user text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Se connecter</span>
          </a>
        </li>

        <li role="none">
          <button 
             id="mobileSignupBtn"
             type="button"
             class="w-full text-left flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-user-plus text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>S'inscrire</span>
          </button>
        </li>

        <li role="none">
          <a href="/affiliate" 
             class="flex items-center gap-3 px-4 py-3.5 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 text-gray-800 font-semibold group" 
             role="menuitem">
            <i class="fas fa-handshake text-blue-600 w-5 text-center" aria-hidden="true"></i>
            <span>Programme d'affiliation</span>
          </a>
        </li>
      @endif
    </ul>

    {{-- ═══════════════════════════════════════════════════════════
         🌐 LANGUAGE SELECTOR MOBILE
         ═══════════════════════════════════════════════════════════ --}}
    @include('includes.header.language-mobile')

  </div>
</nav>