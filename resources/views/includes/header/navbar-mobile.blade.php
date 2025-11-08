{{-- 
  ═══════════════════════════════════════════════════════════
  📱 NAVBAR MOBILE COMPONENT
  ═══════════════════════════════════════════════════════════
  
  Contient :
  - Header mobile fixé en haut
  - Boutons Help & S.O.S
  - Hamburger menu
  - Overlay (backdrop blur)
  - Bottom sheet menu avec navigation
  - Language selector mobile (bottom sheet)
  
  @version 2.0.0
--}}

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE HEADER
     ═══════════════════════════════════════════════════════════ --}}
<header class="lg:hidden fixed top-0 left-0 w-full bg-white z-[60] shadow-md" role="banner">
  <div class="flex items-center justify-between px-4 py-2">
    <a href="/" aria-label="ULIXAI Home">
      <img src="/images/headerlogos.png" alt="ULIXAI Logo" class="w-10 h-10 object-contain" width="40" height="40" />
    </a>

    <nav class="flex items-center gap-2" aria-label="Main navigation">
      <button 
        id="mobileSearchButton"
        type="button"
        class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2.5 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg" 
        aria-label="Request help">
        <span class="flex items-center gap-2">
          <i class="fas fa-hand-paper text-white text-base" aria-hidden="true"></i>
          <span class="hidden xs:inline">Request Help</span>
          <span class="xs:hidden">Help</span>
        </span>
      </button>

      <a href="https://sos-expat.com/" 
         target="_blank"
         rel="noopener noreferrer"
         class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2.5 rounded-full text-sm font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg"
         aria-label="Emergency SOS">
        <span class="flex items-center gap-1.5">
          <i class="fas fa-phone-alt text-white text-base" aria-hidden="true"></i>
          <span>S.O.S</span>
        </span>
      </a>

      <button id="menu-toggle-top" type="button" class="p-2.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
        <div class="w-6 h-6 flex flex-col justify-center items-center gap-1.5">
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
        </div>
      </button>
    </nav>
  </div>
</header>

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU OVERLAY (Backdrop blur)
     ═══════════════════════════════════════════════════════════ --}}
<div id="mobile-menu-overlay" class="lg:hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden opacity-0 transition-opacity duration-300" aria-hidden="true"></div>

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU - Bottom Sheet
     ═══════════════════════════════════════════════════════════ --}}
<nav id="mobile-menu" class="lg:hidden fixed bottom-0 left-0 right-0 bg-white z-40 shadow-2xl rounded-t-3xl transform translate-y-full transition-transform duration-400 ease-out max-h-[85vh] overflow-y-auto" role="navigation" aria-label="Mobile menu" aria-hidden="true">
  
  {{-- Handle (barre de drag visuelle) --}}
  <div class="flex justify-center pt-3 pb-2 sticky top-0 bg-white z-10">
    <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
  </div>

  <div class="px-6 pb-6 space-y-4">
  <ul class="space-y-2" role="menu">
    @if(Auth::check())
      {{-- Profil utilisateur --}}
      <li role="none" class="border-b border-gray-200 pb-3 mb-3">
        <div class="flex items-center gap-3 px-4 py-2">
          @php
            $user = Auth::user();
            $provider = $user?->serviceProvider;
            $profilePhoto = $provider?->profile_photo ? asset($provider->profile_photo) : null;
            $avatar = $user?->avatar ? asset($user->avatar) : null;
            $default = asset('images/helpexpat.png');
            $backgroundImage = "url('{$profilePhoto}'), url('{$avatar}'), url('{$default}')";
          @endphp
          
          <div class="w-10 h-10 rounded-full border bg-center bg-cover"
               style="background-image: {{ $backgroundImage }};"></div>
          <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-800 truncate">{{ $user->name }}</p>
            @php
              $rawRole = (string)($user->user_role ?? '');
              $key = strtolower(str_replace(['-', ' '], '_', $rawRole));
              $roles = [
                'service_provider' => ['label' => 'Service Provider', 'cls' => 'bg-emerald-100 text-emerald-700'],
                'service_requester' => ['label' => 'Service Requester', 'cls' => 'bg-indigo-100 text-indigo-700'],
                'admin' => ['label' => 'Admin', 'cls' => 'bg-rose-100 text-rose-700'],
              ];
              $role = $roles[$key] ?? ['label' => 'User', 'cls' => 'bg-gray-100 text-gray-700'];
            @endphp
            <span class="inline-block text-xs px-2 py-0.5 rounded-full {{ $role['cls'] }} font-medium">
              {{ $role['label'] }}
            </span>
          </div>
        </div>
      </li>

      {{-- Dashboard --}}
      <li role="none">
        <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-gauge text-blue-600" aria-hidden="true"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Become a provider (si pas déjà provider) --}}
      @if(Auth::user()->user_role != 'service_provider')
        <li role="none">
          <a href="/become-service-provider" 
             class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
             role="menuitem">
            <i class="fas fa-file-signature text-blue-600" aria-hidden="true"></i>
            <span>Become a provider</span>
          </a>
        </li>
      @endif

      {{-- Affiliate Program --}}
      <li role="none">
        <a href="/affiliate" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-handshake text-blue-600" aria-hidden="true"></i>
          <span>Affiliate Program</span>
        </a>
      </li>

      {{-- Logout --}}
      <li role="none" class="border-t border-gray-200 pt-2 mt-2">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
          @csrf
          <button type="submit" 
                  class="w-full text-left text-red-600 text-base font-semibold py-3 px-4 rounded-lg hover:bg-red-50 transition-colors flex items-center gap-3" 
                  role="menuitem">
            <i class="fas fa-right-from-bracket" aria-hidden="true"></i>
            <span>Log out</span>
          </button>
        </form>
      </li>

    @else
      {{-- Become a provider --}}
      <li role="none">
        <a href="/become-service-provider" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-file-signature text-blue-600" aria-hidden="true"></i>
          <span>Become a provider</span>
        </a>
      </li>

      {{-- Login --}}
      <li role="none">
        <a href="/login" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-user text-blue-600" aria-hidden="true"></i>
          <span>Log in</span>
        </a>
      </li>

      {{-- Sign up --}}
      <li role="none">
        <button 
           id="mobileSignupBtn"
           type="button"
           class="w-full text-left block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-user-plus text-blue-600" aria-hidden="true"></i>
          <span>Sign up</span>
        </button>
      </li>

      {{-- Affiliate Program --}}
      <li role="none">
        <a href="/affiliate" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-handshake text-blue-600" aria-hidden="true"></i>
          <span>Affiliate Program</span>
        </a>
      </li>
    @endif
  </ul>

  {{-- Language Selector Mobile --}}
  @include('includes.header.language-mobile')

  {{-- Bouton S.O.S --}}
  <a href="https://sos-expat.com/" target="_blank" rel="noopener noreferrer" class="block w-full text-center bg-red-600 text-white font-semibold py-3 rounded-full shadow hover:bg-red-700 transition">
    <i class="fas fa-phone-alt mr-1" aria-hidden="true"></i> S.O.S
  </a>
  
  </div>{{-- Fin du container px-6 pb-6 --}}
</nav>