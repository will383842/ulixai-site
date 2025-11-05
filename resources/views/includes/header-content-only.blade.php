@php
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings ? ($settings->legal_info ?? []) : [];
@endphp

@php 
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

<!-- Navbar (desktop) -->
<nav class="top-0 z-40 lg:z-50 border-b border-white/20 shadow-xl">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">

      <!-- Logo -->
      <div class="hidden lg:flex items-center space-x-3 group">
        <div class="relative">
          <div class="rounded-xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
        </div>
        <div class="flex items-center h-full">
          <a href="/">
            <img src="/images/headerlogos.png" alt="Logo" class="w-25 h-auto max-h-14 object-contain" />
          </a>
        </div>
      </div>

      <!-- Desktop Buttons -->
      <div class="hidden lg:flex items-center space-x-3 group">
        <button onclick="openHelpPopup()" class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover-glow transform hover:scale-105 shadow-lg">
          <span class="flex items-center space-x-2">
            <i class="fas fa-lock text-white-600 text-xl"></i>
            <span>Request Help</span>
          </span>
        </button>

        <!-- SOS Button -->
        <a href="https://sos-expat.com/" 
           target="_blank"
           rel="noopener"
           class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 animate-glow transform hover:scale-105 shadow-lg">
          <span class="flex items-center space-x-2">
            <i class="fas fa-phone-alt text-white-600 text-xl"></i>
            <span>S.O.S</span>
          </span>
        </a>

        @if(Auth::check() && Auth::user()->user_role != 'service_provider' || Auth::check() === false)
          <a href="/become-service-provider" class="nav-button border-2 border-gradient-to-r from-purple-500 to-blue-500 bg-gradient-to-r from-purple-50 to-blue-50 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-3 rounded-full text-sm font-semibold hover:bg-gradient-to-r hover:from-purple-100 hover:to-blue-100 transition-all duration-300 transform hover:scale-105 shadow-lg border-blue-300">
            <span class="flex items-center space-x-2 text-blue-600">
              <i class="fas fa-file-signature text-blue-600 text-2xl"></i>
              <span>Become a Provider</span>
            </span>
          </a>
        @endif
      </div>

      <!-- Desktop Right Side -->
      <div class="hidden lg:flex items-center space-x-6">
        <!-- Language Selector with Google Translate -->
        <div class="relative group inline-block">
          <button id="langBtn" type="button"
            class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-white shadow hover:bg-gray-50 transition">
            <div class="w-6 h-6 rounded-full overflow-hidden border border-gray-300">
              <img id="langFlag" src="https://flagcdn.com/24x18/us.png" alt="EN" class="w-full h-full object-cover">
            </div>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown -->
          <ul id="langMenu"
              class="absolute right-0 hidden bg-white shadow-lg border border-gray-200 rounded-lg mt-2 w-40 z-20">
            <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
              <img src="https://flagcdn.com/20x15/us.png" class="w-5 h-4 mr-2"> English
            </li>
            <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
              <img src="https://flagcdn.com/20x15/fr.png" class="w-5 h-4 mr-2"> Français
            </li>
            <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
              <img src="https://flagcdn.com/20x15/de.png" class="w-5 h-4 mr-2"> Deutsch
            </li>
          </ul>
        </div>

        <!-- Hidden Google Translate widget (single instance) -->
        <div id="google_translate_element" class="hidden"></div>

        <!-- Auth Buttons / User menu -->
        <div class="flex items-center space-x-3">
        @php 
          $isActive = Auth::check();
        @endphp

        @if(!$isActive)
          <a href="/login" class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 group">
            <i class="fas fa-user mr-2 text-lg text-blue-600"></i>
            <span class="font-medium text-blue-600"> Log in</span>
          </a>

          <button id="signupBtn" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center space-x-2">
            <i class="fas fa-user-plus mr-2 text-lg "></i>
            <span>Sign Up</span>
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
              class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100"
              aria-haspopup="menu"
              :aria-expanded="open.toString()"
            >
              <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                style="background-image: {{ $backgroundImage }};">
              </div>
              <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">{{ $user->name }}</span>
              <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
            </button>

            <div
              x-cloak
              x-show="open"
              x-transition
              @click.outside="open = false"
              @keydown.escape.window="open = false"
              style="display:none"
              class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50"
              role="menu"
            >
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
                      <i class="fas {{ $role['icon'] }} text-[11px]"></i>
                      {{ $role['label'] }}
                    </span>
                  </div>

                  @endif
                </div>
              </div>

              <nav class="py-1">
                <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" role="menuitem">
                  <i class="fas fa-gauge"></i>
                  <span>Dashboard</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                  @csrf
                  <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" role="menuitem">
                    <i class="fas fa-right-from-bracket"></i>
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

<!-- Signup Popup -->
<div id="signupPopup" class="fixed inset-0 bg-black/50 z-50 hidden flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6">
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] rounded-t-3xl sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col">
    <div class="sticky sm:relative top-0 z-20 bg-white/95 sm:bg-white backdrop-blur-sm sm:backdrop-blur-none border-b-0 px-4 sm:px-8 py-0 flex items-center justify-between gap-4 h-0 overflow-hidden sm:h-auto sm:overflow-visible">
      <div class="flex-1">
        <div class="sm:hidden">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-500">Step <span id="currentStepNum">1</span> of 16</span>
            <span class="text-xs font-semibold text-blue-600"><span id="progressPercentage">6</span>%</span>
          </div>
          <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
            <div id="mobileProgressBar" class="h-full bg-gradient-to-r from-blue-600 to-blue-500 transition-all duration-300 ease-out" style="width: 6.25%"></div>
          </div>
        </div>
      </div>

      <button id="closePopup" 
              class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 text-gray-500 hover:text-gray-800 shrink-0 absolute top-2 right-2" 
              aria-label="Close signup form">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto overscroll-contain px-4 sm:px-8 pt-0 pb-20 sm:pb-4" id="popupContentArea">
      @include('includes.provider.choose_step')
      @include('includes.provider.native_language')
      @include('includes.provider.spoken_language')
      @include('includes.provider.provider_services')

      <div id="step5" class="hidden flex flex-col h-full" role="region" aria-label="Select your country of residence">
        <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
          <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
          </div>
          <div class="text-center space-y-2 relative">
            <div class="flex justify-center">
              <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <div>
              <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
                Where Do You Live? 🌍
              </h2>
              <p class="text-sm sm:text-base font-semibold text-gray-600">
                Select your country of residence
              </p>
            </div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
              <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="text-xs font-bold text-blue-700">
                <span id="step5SelectedCount">0</span> / 1 selected
              </span>
            </div>
          </div>
        </div>

        <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">
          <div id="step5CountryError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <p class="text-sm font-semibold text-red-800">Please select your country</p>
                <p class="text-xs text-red-600 mt-0.5">You must choose one country to continue</p>
              </div>
            </div>
          </div>

          <div class="relative">
            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
              <span class="text-lg">🌎</span>
              <span class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">Country of Residence</span>
            </label>
            <div class="relative">
              <select 
                id="location-input" 
                name="location" 
                class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-gray-800 bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none cursor-pointer text-sm font-medium hover:border-blue-400"
              >
                <option value="" disabled selected>Choose your country...</option>
                @foreach($countries as $country)
                  <option value="{{ $country->country }}">{{ $country->country }}</option>
                @endforeach
              </select>
              <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </div>
            </div>
          </div>

        </div>
      </div>

      @include('includes.provider.operational_countries', ['countries' => $countries])
      @include('includes.provider.special_status')
      @include('includes.provider.communication_preference')
      @include('includes.provider.profile_description')
      @include('includes.provider.profile_picture')
      @include('includes.provider.identity_documents')
      @include('includes.provider.first_last_name')
      @include('includes.provider.email')
      @include('includes.provider.verify_email')
      @include('includes.provider.phone_number')

      <div id="step16" class="hidden space-y-6 text-center">
        <h2 class="text-blue-900 font-extrabold text-2xl">YOUR PROVIDER ACCOUNT IS CREATED</h2>
        <p class="text-blue-800 font-semibold text-md">YOU ARE OFFICIALLY A ULYSSE</p>
        <p class="text-gray-600">Go check out the service requests in your area now</p>
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full">
          <a href="{{ route('ongoing-requests') }}"> CURRENT SERVICE REQUESTS </a>
        </button>
        <p class="text-gray-600 text-sm mt-2">You can boost your profile to have more jobs to do</p>
        <button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-6 py-2 rounded-full">
          I BOOST MY PROFILE TO BE AMONG THE FIRST SERVICE PROVIDERS
        </button>
      </div>
    </div>

    <div id="mobileNavButtons" class="sm:hidden">
      <button id="mobileBackBtn" class="btn-back" style="display:none;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Back</span>
      </button>
      <button id="mobileNextBtn" class="btn-next">
        <span>Continue</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>
    </div>

    <div id="desktopNavButtons" class="hidden sm:flex px-8 pb-6">
      <button id="desktopBackBtn" class="btn-back" style="display:none;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Back</span>
      </button>
      <button id="desktopNextBtn" class="btn-next">
        <span>Continue</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Mobile Header -->
<header class="lg:hidden fixed top-0 left-0 w-full bg-white z-[60] shadow-md" role="banner">
  <div class="flex items-center justify-between px-4 py-2">
    <a href="/index.php" aria-label="ULIXAI Home">
      <img src="/images/headerlogos.png" alt="ULIXAI Logo" class="w-10 h-10 object-contain" width="40" height="40" />
    </a>

    <nav class="flex items-center gap-2" aria-label="Main navigation">
      <button id="mobileSearchButton" onclick="openHelpPopup()" class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2.5 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg" aria-label="Request help">
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

      <button id="menu-toggle-top" class="p-2.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">
        <div class="w-6 h-6 flex flex-col justify-center items-center gap-1.5">
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
          <span class="hamburger-line block w-6 h-0.5 bg-gray-800 rounded-full transition-all duration-300"></span>
        </div>
      </button>
    </nav>
  </div>
</header>

<!-- Mobile Menu -->
<nav id="mobile-menu" class="lg:hidden fixed top-[64px] left-0 w-full bg-white z-40 shadow-md hidden px-6 py-4 space-y-4" role="navigation" aria-label="Mobile menu" aria-hidden="true">
  <div class="flex justify-end mb-2">
    <button id="mobileMenuCloseBtn" class="p-3 rounded-full hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 hover:scale-110" aria-label="Close menu">
      <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <ul class="space-y-2" role="menu">
    <li role="none"><a href="/become-service-provider" class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors" role="menuitem">Become a provider</a></li>
    <li role="none"><a href="/login" class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors" role="menuitem">Log in</a></li>
    <li role="none"><a href="/signup" class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors" role="menuitem">Sign up</a></li>
    <li role="none"><a href="/affiliate" class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors" role="menuitem">Affiliate Program</a></li>
  </ul>

  <div class="relative w-full sm:w-56">
    <input id="langOpen" type="checkbox" class="peer sr-only" />
    <label for="langOpen"
          class="flex justify-between items-center w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 bg-white cursor-pointer select-none">
      <span id="languageLabel">Language</span>
      <img id="languageFlag" src="https://flagcdn.com/24x18/us.png" alt="Lang" class="ml-2 w-5 h-4 object-cover" />
    </label>

    <ul id="languageMenu"
        class="absolute left-0 right-0 mt-2 bg-white border border-gray-300 rounded-lg shadow-md z-50 hidden peer-checked:block">
      <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
        <img src="https://flagcdn.com/24x18/fr.png" class="w-5 h-4" /> Français
      </li>
      <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
        <img src="https://flagcdn.com/24x18/us.png" class="w-5 h-4" /> English
      </li>
      <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
        <img src="https://flagcdn.com/24x18/de.png" class="w-5 h-4" /> Deutsch
      </li>
    </ul>
  </div>

  <a href="https://sos-expat.com/" target="_blank"  class="block w-full text-center bg-red-600 text-white font-semibold py-2 rounded-full shadow hover:bg-red-700 transition">
    <i class="fas fa-phone-alt mr-1"></i> S.O.S
  </a>
</nav>

<!-- Breadcrumb -->
<div class="breadcrumb-container">
  <nav class="breadcrumb">
    <div class="breadcrumb-item">
      <a href="/">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Accueil</span>
      </a>
    </div>

    @php
    $segments = request()->segments();
    $url = '';
    @endphp

    @foreach($segments as $index => $segment)
      @php
      $url .= '/' . $segment;
      $isLast = $index === count($segments) - 1;
      $title = ucfirst(str_replace(['-', '_'], ' ', $segment));
      @endphp

      <span class="breadcrumb-separator">›</span>

      @if($isLast)
        <div class="breadcrumb-item active">{{ $title }}</div>
      @else
        <div class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></div>
      @endif
    @endforeach
  </nav>
</div>

@include('includes.cookie-banner')

<button id="scrollToTopBtn" aria-label="Retour en haut">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>

<script>
window.validateStep5 = function() {
  const countEl = document.getElementById('step5SelectedCount');
  if (countEl && parseInt(countEl.textContent, 10) > 0) return true;
  const s5 = document.getElementById('step5');
  if (!s5) return false;
  if (s5.querySelector('[aria-checked="true"], [aria-selected="true"], .selected, .is-selected')) return true;
  return false;
};

document.getElementById('step5')?.addEventListener('click', () => {
  if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
});

(function fixGoogleTranslateGap() {
  function zap() {
    const banner = document.querySelector('iframe.goog-te-banner-frame');
    if (banner && banner.parentNode) banner.parentNode.removeChild(banner);
    const wrapper = document.querySelector('body > .skiptranslate');
    if (wrapper) {
      wrapper.style.display = 'none';
      wrapper.style.height = '0px';
      wrapper.style.overflow = 'hidden';
    }
    document.documentElement.style.marginTop = '0px';
    document.body.style.top = '0px';
    document.body.style.position = 'static';
  }
  zap();
  let n = 0;
  const id = setInterval(() => {
    zap();
    if (++n > 20) clearInterval(id);
  }, 200);
  window.addEventListener('resize', zap);
})();

window.addEventListener('load', function() {
  const btn = document.getElementById('scrollToTopBtn');
  if (btn) {
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        btn.classList.add('show');
      } else {
        btn.classList.remove('show');
      }
    });
    btn.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
});
</script>

{{-- Popups de catégories --}}
@include('pages.popup')

{{-- Script pour les bulles colorées --}}
<script src="{{ mix('js/app.js') }}"></script>