{{-- 
  ═══════════════════════════════════════════════════════════
  🖥️ NAVBAR DESKTOP COMPONENT
  ═══════════════════════════════════════════════════════════
  
  Contient :
  - Logo ULIXAI
  - Boutons d'action (Help, S.O.S, Become Provider)
  - Language selector (dropdown)
  - Auth buttons (Login/Signup) ou User menu
  
  @version 2.0.0
--}}

<nav class="fixed top-0 left-0 right-0 bg-white z-50 border-b border-gray-200 shadow-lg">
  <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6">
    <div class="flex justify-between h-16 items-center">

      {{-- Logo --}}
      <div class="hidden lg:flex items-center space-x-3 group">
        <div class="relative">
          <div class="rounded-xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
        </div>
        <div class="flex items-center h-full">
          <a href="/">
            <picture>
              <source type="image/webp" srcset="{{ asset('images/headerlogos.webp') }}">
              <img src="{{ asset('images/headerlogos.png') }}" alt="Logo ULIXAI" class="w-32 h-auto max-h-14 object-contain" width="128" height="56" loading="eager" fetchpriority="high" />
            </picture>
          </a>
        </div>
      </div>

      {{-- Desktop Buttons --}}
      <div class="hidden lg:flex items-center space-x-2.5 group">
        <button 
          id="helpBtn"
          class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover-glow transform hover:scale-105 shadow-lg" 
          aria-label="Request Help">
          <span class="flex items-center space-x-2">
            <i class="fas fa-lock text-white-600 text-lg" aria-hidden="true"></i>
            <span>Request Help</span>
          </span>
        </button>

        {{-- SOS Button --}}
        <a href="https://sos-expat.com/" 
           target="_blank"
           rel="noopener noreferrer"
           class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 animate-glow transform hover:scale-105 shadow-lg"
           aria-label="Emergency SOS">
          <span class="flex items-center space-x-2">
            <i class="fas fa-phone-alt text-white-600 text-lg" aria-hidden="true"></i>
            <span>S.O.S</span>
          </span>
        </a>

        @if(Auth::check() && Auth::user()->user_role != 'service_provider' || Auth::check() === false)
          <a href="/become-service-provider" class="nav-button border-2 border-gradient-to-r from-purple-500 to-blue-500 bg-gradient-to-r from-purple-50 to-blue-50 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-600 px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-gradient-to-r hover:from-purple-100 hover:to-blue-100 transition-all duration-300 transform hover:scale-105 shadow-lg border-blue-300">
            <span class="flex items-center space-x-2 text-blue-600">
              <i class="fas fa-file-signature text-blue-600 text-xl" aria-hidden="true"></i>
              <span>Become a Provider</span>
            </span>
          </a>
        @endif
      </div>

      {{-- Desktop Right Side --}}
      <div class="hidden lg:flex items-center space-x-4">
        {{-- Language Selector (déplacé plus à gauche avec space-x-4 au lieu de space-x-6) --}}
        @include('includes.header.language-desktop')

        {{-- Auth Buttons / User menu --}}
        <div class="flex items-center space-x-3">
        @php 
          $isActive = Auth::check();
        @endphp

        @if(!$isActive)
          {{-- Se connecter - Icône ronde outline --}}
          <a href="/login" 
             class="flex items-center justify-center w-11 h-11 rounded-full border-2 border-blue-600 text-blue-600 hover:bg-blue-50 transition-all duration-200 group" 
             aria-label="Se connecter"
             title="Se connecter">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </a>

          {{-- S'inscrire - Icône ronde filled bleu --}}
          <button 
            id="signupBtn"
            type="button"
            class="flex items-center justify-center w-11 h-11 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
            aria-label="S'inscrire"
            title="S'inscrire">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
          </button>

        @else
        @php
            $user = Auth::user();
            $provider = $user?->serviceProvider;

            $profilePhoto = $provider?->profile_photo ? asset($provider->profile_photo) : null;
            $avatar   = $user?->avatar ? asset($user->avatar) : null;
            $default      = asset('images/helpexpat.png');

            $backgroundImage = "url('{$profilePhoto}'), url('{$avatar}'), url('{$default}')";
        @endphp

          <div class="relative" x-data="{ open:false }">
            <button 
              type="button"
              @click="open = !open"
              @keydown.escape.window="open = false"
              class="flex items-center gap-2 px-2.5 py-2 rounded-lg hover:bg-gray-100"
              aria-haspopup="menu"
              :aria-expanded="open.toString()"
              aria-label="User menu">
              <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                style="background-image: {{ $backgroundImage }};">
              </div>
              <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">{{ $user->name }}</span>
              <i class="fas fa-chevron-down text-gray-500 text-sm" aria-hidden="true"></i>
            </button>

            <div
              x-cloak
              x-show="open"
              x-transition
              @click.outside="open = false"
              @keydown.escape.window="open = false"
              style="display:none"
              class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50"
              role="menu">
              <div class="p-3 flex items-center gap-3 border-b">
                  <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                style="background-image: {{ $backgroundImage }};">
              </div>
                <div class="min-w-0">
                  <div id="header-user-fullname" class="font-semibold truncate mb-1">{{ $user->name }}</div>
                  @if($user?->email)
                    @php
                    $rawRole = (string)($user->user_role ?? '');
                    $key = strtolower(str_replace(['-', ' '], '_', $rawRole));

                    $roles = [
                      'admin' => [
                        'label' => 'Admin',
                        'cls'   => 'bg-rose-100 text-rose-700 ring-1 ring-rose-600/20',
                        'icon'  => 'fa-user-shield',
                      ],
                      'service_provider' => [
                        'label' => 'Service Provider',
                        'cls'   => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20',
                        'icon'  => 'fa-toolbox',
                      ],
                      'provider' => [
                        'label' => 'Service Provider',
                        'cls'   => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20',
                        'icon'  => 'fa-toolbox',
                      ],
                      'service_requester' => [
                        'label' => 'Service Requester',
                        'cls'   => 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-600/20',
                        'icon'  => 'fa-hand-holding',
                      ],
                      'requester' => [
                        'label' => 'Service Requester',
                        'cls'   => 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-600/20',
                        'icon'  => 'fa-hand-holding',
                      ],
                    ];

                    $role = $roles[$key] ?? [
                      'label' => ucfirst($rawRole ?: 'User'),
                      'cls'   => 'bg-gray-100 text-gray-700 ring-1 ring-gray-400/20',
                      'icon'  => 'fa-user',
                    ];
                  @endphp

                  <div class="text-xs">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-medium {{ $role['cls'] }} truncate max-w-[12rem]">
                      <i class="fas {{ $role['icon'] }} text-[11px]" aria-hidden="true"></i>
                      {{ $role['label'] }}
                    </span>
                  </div>

                  @endif
                </div>
              </div>

              <nav class="py-1">
                <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" role="menuitem">
                  <i class="fas fa-gauge" aria-hidden="true"></i>
                  <span>Dashboard</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                  @csrf
                  <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" role="menuitem">
                    <i class="fas fa-right-from-bracket" aria-hidden="true"></i>
                    <span>Log out</span>
                  </button>
                </form>
              </nav>
            </div>
          </div>
        @endif
        </div>
      </div>
    </div>
  </div>
</nav>