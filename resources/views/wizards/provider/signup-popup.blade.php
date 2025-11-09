{{-- 
  ═══════════════════════════════════════════════════════════
  PROVIDER SIGNUP POPUP - Multi-step wizard
  ═══════════════════════════════════════════════════════════
  This popup is only displayed for non-authenticated users
  Handles provider registration in 17 steps with validation
  
  @version 2.2.0
  @updated FIX #2 - Style Airbnb + Language selector intégré
--}}

@php
  // Récupérer les pays pour le step operational_countries
  use App\Models\Country; 
  $countries = Country::where('status', 1)->get();
@endphp

@if(!Auth::check())
<div id="signupPopup" 
     class="fixed inset-0 bg-black/50 z-[200] hidden items-center justify-center p-0 sm:p-4" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="signup-popup-title">
  
  <!-- CONTAINER RESPONSIVE - Plein écran mobile, modal desktop -->
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col">
    
    <!-- ═══════════════════════════════════════════════════════════
         HEADER VISIBLE - Progress bar + Language + Close button
         ═══════════════════════════════════════════════════════════ -->
    <div class="sticky sm:relative top-0 z-20 bg-white/95 sm:bg-white backdrop-blur-sm sm:backdrop-blur-none border-b border-gray-200 px-4 sm:px-6 py-3 sm:py-4">
      
      <div class="flex items-center justify-between gap-3">
        
        <!-- Progress Bar (flex-1 pour prendre l'espace) -->
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-600 truncate">
              Step <span id="currentStepNum">1</span> / 17
            </span>
            <span class="text-xs font-bold text-blue-600 ml-2">
              <span id="progressPercentage">6</span>%
            </span>
          </div>
          <div class="h-2 bg-gray-200 rounded-full overflow-hidden" 
               role="progressbar" 
               aria-valuenow="6" 
               aria-valuemin="0" 
               aria-valuemax="100">
            <div id="mobileProgressBar" 
                 class="h-full bg-gradient-to-r from-blue-600 to-blue-500 transition-all duration-300 ease-out" 
                 style="width: 6.25%"></div>
          </div>
        </div>

        <!-- Language Selector Compact (Mobile uniquement) -->
        <div class="flex-shrink-0 relative sm:hidden" x-data="{ open: false }">
          <button 
            @click="open = !open"
            @keydown.escape.window="open = false"
            type="button"
            class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg hover:bg-gray-100 active:bg-gray-200 transition-colors"
            aria-label="Change language"
            aria-haspopup="menu"
            :aria-expanded="open.toString()">
            
            <!-- Drapeau avec coins arrondis -->
            <div class="w-6 h-5 rounded-md overflow-hidden shadow-sm">
              <img id="popupLangFlag" 
                   src="{{ asset('images/flags/us.svg') }}" 
                   alt="EN" 
                   class="w-full h-full object-cover">
            </div>
            
            <!-- Chevron -->
            <svg class="w-3.5 h-3.5 text-gray-600 transition-transform duration-200"
                 :class="{ 'rotate-180': open }"
                 fill="none" 
                 stroke="currentColor" 
                 stroke-width="2" 
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          
          <!-- Dropdown Menu -->
          <div x-cloak
     x-show="open" 
     x-transition
     @click.away="open = false"
     class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-[100] max-h-96 overflow-y-auto"
     role="menu"
     style="display: none;">
            
            <!-- Anglais -->
            <button type="button"
                    data-lang="en" 
                    data-flag="{{ asset('images/flags/us.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/us.svg') }}" alt="EN" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">English</span>
            </button>
            
            <!-- Français -->
            <button type="button"
                    data-lang="fr" 
                    data-flag="{{ asset('images/flags/fr.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/fr.svg') }}" alt="FR" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">Français</span>
            </button>
            
            <!-- Allemand -->
            <button type="button"
                    data-lang="de" 
                    data-flag="{{ asset('images/flags/de.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/de.svg') }}" alt="DE" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">Deutsch</span>
            </button>
            
            <!-- Russe -->
            <button type="button"
                    data-lang="ru" 
                    data-flag="{{ asset('images/flags/ru.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/ru.svg') }}" alt="RU" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">Русский</span>
            </button>
            
            <!-- Chinois -->
            <button type="button"
                    data-lang="zh-CN" 
                    data-flag="{{ asset('images/flags/cn.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/cn.svg') }}" alt="CN" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">中文</span>
            </button>
            
            <!-- Espagnol -->
            <button type="button"
                    data-lang="es" 
                    data-flag="{{ asset('images/flags/es.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/es.svg') }}" alt="ES" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">Español</span>
            </button>
            
            <!-- Portugais -->
            <button type="button"
                    data-lang="pt" 
                    data-flag="{{ asset('images/flags/pt.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/pt.svg') }}" alt="PT" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">Português</span>
            </button>
            
            <!-- Arabe -->
            <button type="button"
                    data-lang="ar" 
                    data-flag="{{ asset('images/flags/sa.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/sa.svg') }}" alt="AR" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">العربية</span>
            </button>
            
            <!-- Hindi -->
            <button type="button"
                    data-lang="hi" 
                    data-flag="{{ asset('images/flags/in.svg') }}"
                    @click="open = false"
                    class="popup-lang-option w-full flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
                    role="menuitem">
              <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
                <img src="{{ asset('images/flags/in.svg') }}" alt="HI" class="w-full h-full object-cover">
              </div>
              <span class="font-medium text-gray-700 group-hover:text-blue-600">हिन्दी</span>
            </button>
            
          </div>
        </div>

        <!-- Close Button -->
        <button id="closePopup" 
                type="button"
                class="flex-shrink-0 w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 text-gray-500 hover:text-gray-800" 
                aria-label="Close signup form">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        
      </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         CONTENT - Tous les steps du wizard
         ═══════════════════════════════════════════════════════════ -->
    <div class="flex-1 overflow-y-auto overscroll-contain px-4 sm:px-8 pt-4 pb-20 sm:pb-4" id="popupContentArea">
      
      {{-- Step 1: Choose profile type --}}
      @include('wizards.provider.steps.choose_step')
      
      {{-- Step 2: Native language --}}
      @include('wizards.provider.steps.native_language')
      
      {{-- Step 3: Spoken languages --}}
      @include('wizards.provider.steps.spoken_language')
      
      {{-- Step 4: Provider services --}}
      @include('wizards.provider.steps.provider_services')
      
      {{-- Step 5: Country selection --}}
      @include('wizards.provider.steps.country_selection')
      
      {{-- Step 6: Operational countries --}}
      @include('wizards.provider.steps.operational_countries', ['countries' => $countries])
      
      {{-- Step 7: Special status --}}
      @include('wizards.provider.steps.special_status')
      
      {{-- Step 8: Communication preference --}}
      @include('wizards.provider.steps.communication_preference')
      
      {{-- Step 9: Profile description --}}
      @include('wizards.provider.steps.profile_description')
      
      {{-- Step 10: Profile picture --}}
      @include('wizards.provider.steps.profile_picture')
      
      {{-- Step 11: Identity documents --}}
      @include('wizards.provider.steps.identity_documents')
      
      {{-- Step 12: First and last name --}}
      @include('wizards.provider.steps.first_last_name')
      
      {{-- Step 13: Email --}}
      @include('wizards.provider.steps.email')
      
      {{-- Step 13bis: Password (NOUVEAU) --}}
      @include('wizards.provider.steps.password')
      
      {{-- Step 14: Phone number --}}
      @include('wizards.provider.steps.phone_number')
      
      {{-- Step 15: Verify email (OTP) - AUTO-LOGIN APRÈS VALIDATION --}}
      @include('wizards.provider.steps.verify_email')
      
      {{-- Step 16: Success confirmation --}}
      @include('wizards.provider.steps.success_confirmation')
      
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         NAVIGATION BUTTONS (Mobile + Desktop)
         ═══════════════════════════════════════════════════════════ --}}
    @include('wizards.provider.partials.navigation-buttons')

  </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     SCRIPTS - Language Switcher Integration
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    console.log('🌐 [Popup] Initializing language selector...');
    
    // Attendre que Google Translate soit prêt
    const waitForGoogleTranslate = (callback, maxWait = 5000) => {
      const startTime = Date.now();
      const checkInterval = setInterval(() => {
        if (window.ulixaiGoogleTranslate && window.ulixaiGoogleTranslate.languageManager) {
          clearInterval(checkInterval);
          console.log('✅ [Popup] Google Translate ready');
          callback();
        } else if (Date.now() - startTime > maxWait) {
          clearInterval(checkInterval);
          console.warn('⚠️ [Popup] Google Translate timeout, continuing anyway');
          callback();
        }
      }, 100);
    };
    
    waitForGoogleTranslate(() => {
      const mainLangFlag = document.getElementById('langFlag');
      const popupLangFlag = document.getElementById('popupLangFlag');
      
      // Synchroniser avec le localStorage (source de vérité)
      const savedLang = localStorage.getItem('ulixai_lang') || 'en';
      
      // Map des drapeaux
      const flagMap = {
        'en': 'images/flags/us.svg',
        'fr': 'images/flags/fr.svg',
        'de': 'images/flags/de.svg',
        'ru': 'images/flags/ru.svg',
        'zh-CN': 'images/flags/cn.svg',
        'es': 'images/flags/es.svg',
        'pt': 'images/flags/pt.svg',
        'ar': 'images/flags/sa.svg',
        'hi': 'images/flags/in.svg'
      };
      
      // Mettre à jour le drapeau du popup au chargement
      if (popupLangFlag && flagMap[savedLang]) {
        popupLangFlag.src = flagMap[savedLang];
        popupLangFlag.alt = savedLang.toUpperCase();
        console.log('✅ [Popup] Initial language:', savedLang);
      }
      
      // Gérer les clics sur les options de langue
      document.addEventListener('click', function(e) {
        const langOption = e.target.closest('.popup-lang-option');
        if (!langOption) return;
        
        const lang = langOption.getAttribute('data-lang');
        
        console.log('🌐 [Popup] Language change requested:', lang);
        
        // Vérifier que Google Translate est disponible
        if (!window.ulixaiGoogleTranslate || !window.ulixaiGoogleTranslate.languageManager) {
          console.error('❌ [Popup] Google Translate not available');
          alert('Translation system not ready. Please try again in a moment.');
          return;
        }
        
        // Appeler la bonne méthode : setLanguage (pas switchLanguage)
        try {
          window.ulixaiGoogleTranslate.languageManager.setLanguage(lang);
          console.log('✅ [Popup] Language change initiated, page will reload');
        } catch (error) {
          console.error('❌ [Popup] Error changing language:', error);
          alert('Error changing language. Please refresh the page and try again.');
        }
      });
      
      console.log('✅ [Popup] Language selector initialized');
      console.log('🔍 [Popup] Available:', {
        googleTranslate: !!window.ulixaiGoogleTranslate,
        languageManager: !!(window.ulixaiGoogleTranslate && window.ulixaiGoogleTranslate.languageManager),
        currentLang: savedLang
      });
    });
  });
})();
</script>
@endif