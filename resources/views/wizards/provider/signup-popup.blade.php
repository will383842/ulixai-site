{{-- 
  ═══════════════════════════════════════════════════════════
  PROVIDER SIGNUP POPUP - Multi-step wizard
  ═══════════════════════════════════════════════════════════
  This popup is only displayed for non-authenticated users
  Handles provider registration in 17 steps with validation
  
  @version 2.5.1
  @updated Fixed: Ne se ferme plus au clic extérieur
--}}

@php
  // Récupérer les pays pour le step operational_countries
  use App\Models\Country; 
  $countries = Country::where('status', 1)->get();
@endphp

@if(!Auth::check())

{{-- ═══════════════════════════════════════════════════════════
     STYLES - Hide scrollbar (cross-platform compatible)
     ═══════════════════════════════════════════════════════════ --}}
<style>
/* ═══════════════════════════════════════════════════════════
   Cache le scrollbar du popup - TOUS NAVIGATEURS
   ═══════════════════════════════════════════════════════════ */

/* Firefox (Desktop + Mobile) */
div#signupPopup div#popupContentArea,
#signupPopup #popupContentArea {
  -ms-overflow-style: none !important;  /* IE et Edge Legacy */
  scrollbar-width: none !important;     /* Firefox */
}

/* Chrome, Safari, Edge (Desktop + Mobile) */
div#signupPopup div#popupContentArea::-webkit-scrollbar,
#signupPopup #popupContentArea::-webkit-scrollbar {
  display: none !important;
  width: 0px !important;
  height: 0px !important;
  background: transparent !important;
}

/* Éléments webkit-scrollbar supplémentaires */
#popupContentArea::-webkit-scrollbar-track,
#popupContentArea::-webkit-scrollbar-thumb,
#popupContentArea::-webkit-scrollbar-corner,
#popupContentArea::-webkit-scrollbar-button {
  display: none !important;
  background: transparent !important;
  width: 0 !important;
  height: 0 !important;
}

/* ═══════════════════════════════════════════════════════════
   EXCEPTION : Garder les scrollbars des listes internes
   ═══════════════════════════════════════════════════════════ */
#popupContentArea .country-list-container::-webkit-scrollbar,
#popupContentArea [class*="list-container"]::-webkit-scrollbar {
  display: block !important;
  width: 6px !important;
}

#popupContentArea .country-list-container,
#popupContentArea [class*="list-container"] {
  scrollbar-width: thin !important;
}
</style>

{{-- Ne se ferme QUE avec la croix --}}
<div id="signupPopup" 
     class="fixed inset-0 bg-black/50 z-[200] hidden items-center justify-center p-0 sm:p-4" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="signup-popup-title">
  
  <!-- CONTAINER RESPONSIVE - Plein écran mobile, modal desktop -->
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col"
       onclick="event.stopPropagation()">
    
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
         CONTENT - Tous les steps du wizard (SCROLLBAR CACHÉE)
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
         BOUTON DE PARTAGE FLOTTANT - Visible sur tous les steps
         Mobile : Petit bouton sur le côté droit (milieu vertical)
         Desktop : Bouton avec texte en bas à droite
         ═══════════════════════════════════════════════════════════ --}}
    <button type="button" 
            onclick="openProviderSharePopup()"
            class="fixed 
                   
                   <!-- Position verticale : centré sur mobile, plus bas sur desktop -->
                   top-1/2 -translate-y-1/2 sm:top-auto sm:translate-y-0 sm:bottom-8
                   
                   <!-- Position horizontale : côté droit avec marge -->
                   right-1 sm:right-6
                   
                   <!-- Taille : petit sur mobile, normal sur desktop -->
                   w-8 h-8 sm:w-auto sm:h-auto
                   sm:px-5 sm:py-3 
                   
                   <!-- Style -->
                   bg-gradient-to-br from-pink-500 to-rose-500 
                   hover:from-pink-600 hover:to-rose-600 
                   text-white 
                   rounded-full sm:rounded-xl
                   shadow-md hover:shadow-lg sm:shadow-xl sm:hover:shadow-2xl
                   
                   <!-- Z-index : au-dessus du contenu mais en dessous du header -->
                   z-[150]
                   
                   <!-- Transitions et animations -->
                   transition-all duration-300 
                   transform hover:scale-110 sm:hover:scale-105 active:scale-95 
                   
                   flex items-center justify-center sm:gap-2
                   group
                   
                   <!-- Semi-transparent sur mobile pour être moins intrusif -->
                   opacity-80 hover:opacity-100 sm:opacity-100
                   
                   <!-- Animation d'apparition -->
                   animate-slideInRight"
            aria-label="Share job opportunity and earn 75% commission"
            title="Share with friends">
      
      <!-- Icône (visible sur mobile et desktop) -->
      <svg class="w-3.5 h-3.5 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform flex-shrink-0" 
           fill="currentColor" 
           viewBox="0 0 20 20"
           aria-hidden="true">
        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
      </svg>
      
      <!-- Texte (visible uniquement sur desktop) -->
      <span class="hidden sm:inline font-bold text-sm whitespace-nowrap" data-translate="shareButton">
        Share
      </span>
      
      <!-- Badge "!" (plus discret sur mobile) -->
      <span class="absolute -top-0.5 -right-0.5 sm:-top-1 sm:-right-1 
                   w-3 h-3 sm:w-5 sm:h-5 
                   bg-yellow-400 
                   text-[8px] sm:text-xs 
                   font-bold text-gray-900 
                   rounded-full 
                   flex items-center justify-center 
                   shadow-sm
                   animate-pulse-subtle">
        !
      </span>
    </button>

    {{-- ═══════════════════════════════════════════════════════════
         MODAL DE PARTAGE - Ne se ferme QUE avec la croix
         ═══════════════════════════════════════════════════════════ --}}
    <div id="providerSharePopup" 
         class="hidden fixed inset-0 z-[300] bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
      
      <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 animate-scaleIn" 
           onclick="event.stopPropagation()">
        
        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-xl font-bold text-gray-800" data-translate="shareTitle">
            💼 Share Job Opportunity
          </h3>
          <button onclick="closeProviderSharePopup()" 
                  class="text-gray-400 hover:text-gray-600 transition-colors rounded-full hover:bg-gray-100 p-1.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        {{-- Message personnalisé --}}
        <p class="text-sm text-gray-600 mb-5 leading-relaxed" data-translate="shareDescription">
          🌍 Share this opportunity with people looking for work abroad! Help expatriates worldwide and earn income in 197 countries. 💼✈️
        </p>
        
        {{-- Boutons de partage --}}
        <div class="grid grid-cols-4 gap-3 mb-5">
          
          {{-- WhatsApp --}}
          <button onclick="shareProviderVia('whatsapp')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">WhatsApp</span>
          </button>
          
          {{-- Facebook --}}
          <button onclick="shareProviderVia('facebook')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">Facebook</span>
          </button>
          
          {{-- Twitter/X --}}
          <button onclick="shareProviderVia('twitter')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">Twitter</span>
          </button>
          
          {{-- LinkedIn --}}
          <button onclick="shareProviderVia('linkedin')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">LinkedIn</span>
          </button>
          
          {{-- Telegram --}}
          <button onclick="shareProviderVia('telegram')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-blue-400 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">Telegram</span>
          </button>
          
          {{-- Email --}}
          <button onclick="shareProviderVia('email')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">Email</span>
          </button>
          
          {{-- SMS --}}
          <button onclick="shareProviderVia('sms')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group">
            <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">SMS</span>
          </button>
          
          {{-- Copy Link --}}
          <button onclick="shareProviderVia('copy')" 
                  class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50 transition-all group" 
                  id="copyLinkBtn">
            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
              </svg>
            </div>
            <span class="text-xs text-gray-700 font-medium">Copy</span>
          </button>
          
        </div>
        
        {{-- Info box --}}
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
          <p class="text-xs text-blue-800 text-center font-medium leading-relaxed" data-translate="shareInfo">
            💼 Your friends will discover work opportunities in 197 countries! Earn income helping expatriates worldwide. 🌍✈️
          </p>
        </div>
        
      </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         NAVIGATION BUTTONS (Mobile + Desktop)
         ═══════════════════════════════════════════════════════════ --}}
    @include('wizards.provider.partials.navigation-buttons')

  </div>
</div>

{{-- Hidden input pour le lien affilié --}}
@auth
<input type="hidden" id="affiliateLinkProvider" value="{{ url('/service-providers') }}?open_signup=1&ref={{ Auth::user()->affiliate_code }}">
@else
<input type="hidden" id="affiliateLinkProvider" value="{{ url('/service-providers') }}?open_signup=1">
@endauth

{{-- ═══════════════════════════════════════════════════════════
     STYLES - Animations pour le partage
     ═══════════════════════════════════════════════════════════ --}}
<style>
/* Animation d'apparition du bouton de partage depuis la droite */
@keyframes slideInRight {
  0% { 
    transform: translateX(100px) translateY(-50%);
    opacity: 0; 
  }
  100% { 
    transform: translateX(0) translateY(-50%);
    opacity: 1; 
  }
}

@media (min-width: 640px) {
  @keyframes slideInRight {
    0% { 
      transform: translateX(100px);
      opacity: 0; 
    }
    100% { 
      transform: translateX(0);
      opacity: 1; 
    }
  }
}

.animate-slideInRight {
  animation: slideInRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.8s both;
}

/* Animation pulse plus subtile pour le badge */
@keyframes pulse-subtle {
  0%, 100% { 
    opacity: 1;
    transform: scale(1);
  }
  50% { 
    opacity: 0.85;
    transform: scale(1.05);
  }
}

.animate-pulse-subtle {
  animation: pulse-subtle 2.5s ease-in-out infinite;
}

/* Animation d'apparition du modal de partage */
@keyframes scaleIn {
  from { 
    transform: scale(0.9); 
    opacity: 0; 
  }
  to { 
    transform: scale(1); 
    opacity: 1; 
  }
}

.animate-scaleIn {
  animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

/* Animation subtile intermittente pour attirer l'œil */
@keyframes gentleBounce {
  0%, 100% { transform: translateY(0) scale(1); }
  50% { transform: translateY(-8px) scale(1.05); }
}

button[onclick="openProviderSharePopup()"].animate-attention {
  animation: gentleBounce 0.6s ease-in-out;
}

/* Effet hover spécial sur desktop pour le bouton de partage */
@media (min-width: 640px) {
  button[onclick="openProviderSharePopup()"]:hover {
    box-shadow: 0 8px 30px rgba(236, 72, 153, 0.4);
  }
}
</style>

{{-- ═══════════════════════════════════════════════════════════
     SCRIPTS - Language Switcher + Share Functions
     ═══════════════════════════════════════════════════════════ --}}
<script>
// ═══════════════════════════════════════════════════════════
// Language Switcher Integration
// ═══════════════════════════════════════════════════════════
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

// ═══════════════════════════════════════════════════════════
// Share Functions - Provider Signup avec tracking affilié
// ═══════════════════════════════════════════════════════════

function openProviderSharePopup() {
  const modal = document.getElementById('providerSharePopup');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  console.log('📢 [Provider Signup] Share popup opened');
}

function closeProviderSharePopup() {
  const modal = document.getElementById('providerSharePopup');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
  console.log('📢 [Provider Signup] Share popup closed');
}

function shareProviderVia(platform) {
  // Récupérer l'URL avec le code affilié
  const affiliateInput = document.getElementById('affiliateLinkProvider');
  let url = affiliateInput ? affiliateInput.value : window.location.origin + '/service-providers?open_signup=1';
  
  // Ajouter les paramètres UTM pour le tracking
  try {
    const urlObj = new URL(url, window.location.origin);
    urlObj.searchParams.set('utm_source', 'social');
    urlObj.searchParams.set('utm_medium', 'share');
    urlObj.searchParams.set('utm_campaign', 'provider_signup');
    urlObj.searchParams.set('utm_content', platform);
    url = urlObj.toString();
  } catch (e) {
    console.error('❌ [Provider Signup] UTM error:', e);
  }
  
  // Messages adaptés au contexte "devenir prestataire"
  const messages = {
    en: '💼 Work worldwide and help expatriates! Join ULIX AI as a service provider and earn income in 197 countries. 🌍✈️',
    fr: '💼 Travaillez dans le monde entier et aidez les expatriés ! Rejoignez ULIX AI comme prestataire et gagnez un revenu dans 197 pays. 🌍✈️',
    es: '💼 ¡Trabaja en todo el mundo y ayuda a expatriados! Únete a ULIX AI como proveedor de servicios y gana ingresos en 197 países. 🌍✈️',
    de: '💼 Arbeite weltweit und hilf Expats! Tritt ULIX AI als Dienstleister bei und verdiene in 197 Ländern. 🌍✈️',
    pt: '💼 Trabalhe em todo o mundo e ajude expatriados! Junte-se ao ULIX AI como prestador de serviços e ganhe renda em 197 países. 🌍✈️',
    ru: '💼 Работайте по всему миру и помогайте экспатам! Присоединяйтесь к ULIX AI как поставщик услуг и зарабатывайте в 197 странах. 🌍✈️',
    'zh-CN': '💼 在全球工作并帮助外籍人士!加入ULIX AI作为服务提供商,在197个国家赚取收入。🌍✈️',
    ar: '💼 اعمل في جميع أنحاء العالم وساعد المغتربين! انضم إلى ULIX AI كمزود خدمة واكسب دخلاً في 197 دولة. 🌍✈️',
    hi: '💼 दुनिया भर में काम करें और प्रवासियों की मदद करें! ULIX AI में सेवा प्रदाता के रूप में शामिल हों और 197 देशों में आय अर्जित करें। 🌍✈️'
  };
  
  // Détection de la langue actuelle
  const currentLang = localStorage.getItem('ulixai_lang') || 'en';
  const text = messages[currentLang] || messages.en;
  
  // Titre pour email/SMS
  const emailSubject = {
    en: '💼 Amazing Job Opportunity - Work Worldwide with ULIX AI',
    fr: '💼 Opportunité de travail incroyable - Travaillez dans le monde entier avec ULIX AI',
    es: '💼 Increíble oportunidad de trabajo - Trabaja en todo el mundo con ULIX AI',
    de: '💼 Fantastische Arbeitsmöglichkeit - Arbeite weltweit mit ULIX AI',
    pt: '💼 Incrível oportunidade de trabalho - Trabalhe em todo o mundo com ULIX AI',
    ru: '💼 Потрясающая возможность работы - Работайте по всему миру с ULIX AI',
    'zh-CN': '💼 惊人的工作机会 - 与ULIX AI一起在全球工作',
    ar: '💼 فرصة عمل مذهلة - اعمل في جميع أنحاء العالم مع ULIX AI',
    hi: '💼 अद्भुत नौकरी का अवसर - ULIX AI के साथ दुनिया भर में काम करें'
  };
  
  const subject = emailSubject[currentLang] || emailSubject.en;
  
  let shareUrl;
  
  switch(platform) {
    case 'whatsapp':
      shareUrl = `https://wa.me/?text=${encodeURIComponent(text + '\n\n' + url)}`;
      break;
      
    case 'facebook':
      shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
      break;
      
    case 'twitter':
      shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
      break;
      
    case 'linkedin':
      shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
      break;
      
    case 'telegram':
      shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
      break;
      
    case 'email':
      shareUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(text + '\n\n' + url)}`;
      break;
      
    case 'sms':
      // iOS et Android compatible
      const smsBody = encodeURIComponent(text + '\n\n' + url);
      shareUrl = navigator.userAgent.match(/iPhone|iPad|iPod/i) 
        ? `sms:&body=${smsBody}`
        : `sms:?body=${smsBody}`;
      break;
      
    case 'copy':
      navigator.clipboard.writeText(url).then(() => {
        const btn = document.getElementById('copyLinkBtn');
        const originalHTML = btn.innerHTML;
        
        // Feedback visuel
        btn.innerHTML = `
          <div class="flex flex-col items-center gap-2 p-3">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-md">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600 font-medium">Copied!</span>
          </div>
        `;
        
        setTimeout(() => {
          btn.innerHTML = originalHTML;
        }, 2000);
        
        console.log('📋 [Provider Signup] Link copied:', url);
      }).catch(err => {
        console.error('❌ [Provider Signup] Copy failed:', err);
        alert('Failed to copy link. Please try again.');
      });
      return;
  }
  
  if (shareUrl) {
    window.open(shareUrl, '_blank', 'width=600,height=400');
    console.log('📢 [Provider Signup] Opening', platform, 'share dialog');
    
    // Fermer le modal après un court délai
    setTimeout(() => {
      closeProviderSharePopup();
    }, 500);
  }
}

// Fermer le modal avec Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    const sharePopup = document.getElementById('providerSharePopup');
    if (sharePopup && !sharePopup.classList.contains('hidden')) {
      closeProviderSharePopup();
    }
  }
});

// Vérifier si le popup doit s'ouvrir automatiquement (venant d'un lien partagé)
document.addEventListener('DOMContentLoaded', function() {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('open_signup') === '1') {
    console.log('🔗 [Provider Signup] Opening signup popup from shared link...');
    // Petit délai pour laisser la page se charger
    setTimeout(() => {
      const signupBtn = document.getElementById('openSignupPopup');
      if (signupBtn) {
        signupBtn.click();
        console.log('✅ [Provider Signup] Signup popup opened automatically');
      } else {
        console.warn('⚠️ [Provider Signup] Signup button not found');
      }
    }, 500);
  }
});

// Animation subtile intermittente (toutes les 8-12 secondes)
(function initProviderShareButtonAnimation() {
  const shareBtn = document.querySelector('button[onclick="openProviderSharePopup()"]');
  if (!shareBtn) return;
  
  function triggerAttention() {
    shareBtn.classList.add('animate-attention');
    setTimeout(() => {
      shareBtn.classList.remove('animate-attention');
    }, 600);
  }
  
  // Première animation après 5 secondes
  setTimeout(triggerAttention, 5000);
  
  // Puis toutes les 8-12 secondes (aléatoire pour être plus naturel)
  setInterval(() => {
    const delay = 8000 + Math.random() * 4000; // Entre 8 et 12 secondes
    setTimeout(triggerAttention, delay);
  }, 12000);
})();
</script>
@endif