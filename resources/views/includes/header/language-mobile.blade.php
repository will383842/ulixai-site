{{-- 
  ═══════════════════════════════════════════════════════════
  🌐 LANGUAGE SELECTOR MOBILE COMPONENT
  ═══════════════════════════════════════════════════════════
  
  Bottom sheet moderne pour sélectionner la langue (mobile uniquement)
  Langues disponibles : EN, FR, DE, RU, ZH, ES, PT, AR, HI
  
  @version 2.0.0
--}}

{{-- Sélecteur de langue - Bouton moderne --}}
<button 
  id="mobileLangBtn" 
  type="button"
  class="flex items-center justify-between w-full bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl px-5 py-3.5 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 shadow-sm hover:shadow-md group"
  aria-label="Select language">
  <div class="flex items-center gap-3">
    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center border border-blue-100">
      <img id="mobileLangFlag" src="{{ asset('images/flags/us.svg') }}" alt="" class="w-6 h-5 object-cover rounded notranslate" width="24" height="20" translate="no" />
    </div>
    <div class="text-left">
      <div class="text-xs text-gray-500 font-medium">Language</div>
      <div id="mobileLangLabel" class="text-sm font-bold text-gray-800">English</div>
    </div>
  </div>
  <svg class="w-5 h-5 text-blue-600 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
  </svg>
</button>

{{-- Bottom Sheet Modal - Moderne 2025 --}}
<div id="mobileLangModal" class="fixed inset-0 z-[9999] hidden">
  {{-- Overlay avec blur --}}
  <div id="mobileLangOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300 opacity-0"></div>

  {{-- Bottom Sheet - Utilise dvh pour le viewport dynamique mobile --}}
  <div id="mobileLangSheet" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl shadow-2xl transform translate-y-full transition-transform duration-400 ease-out max-h-[90dvh] overflow-hidden" style="max-height: 90dvh;">
    
    {{-- Handle (barre de drag visuelle) --}}
    <div class="flex justify-center pt-3 pb-2">
      <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
    </div>
    
    {{-- Header --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <div>
        <h3 class="text-lg font-bold text-gray-900">Choose Language</h3>
        <p class="text-xs text-gray-500 mt-0.5">Select your preferred language</p>
      </div>
      <button id="mobileLangCloseBtn" type="button" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    
    {{-- Liste des langues - Scrollable avec espace pour tous les éléments --}}
    <div class="overflow-y-auto px-4 py-3 pb-8" style="max-height: calc(90dvh - 100px); -webkit-overflow-scrolling: touch;">
      <div class="space-y-2">
        
        {{-- Français --}}
        <button data-lang="fr" data-flag="{{ asset('images/flags/fr.svg') }}" data-label="Français"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/fr.svg') }}" alt="FR" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">Français</div>
            <div class="text-xs text-gray-500">France</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Anglais --}}
        <button data-lang="en" data-flag="{{ asset('images/flags/us.svg') }}" data-label="English"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/us.svg') }}" alt="EN" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">English</div>
            <div class="text-xs text-gray-500">United States</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Allemand --}}
        <button data-lang="de" data-flag="{{ asset('images/flags/de.svg') }}" data-label="Deutsch"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/de.svg') }}" alt="DE" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">Deutsch</div>
            <div class="text-xs text-gray-500">Deutschland</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Russe --}}
        <button data-lang="ru" data-flag="{{ asset('images/flags/ru.svg') }}" data-label="Русский"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/ru.svg') }}" alt="RU" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">Русский</div>
            <div class="text-xs text-gray-500">Россия</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Chinois --}}
        <button data-lang="zh-CN" data-flag="{{ asset('images/flags/cn.svg') }}" data-label="中文"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/cn.svg') }}" alt="CN" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">中文</div>
            <div class="text-xs text-gray-500">中国</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Espagnol --}}
        <button data-lang="es" data-flag="{{ asset('images/flags/es.svg') }}" data-label="Español"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/es.svg') }}" alt="ES" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">Español</div>
            <div class="text-xs text-gray-500">España</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Portugais --}}
        <button data-lang="pt" data-flag="{{ asset('images/flags/pt.svg') }}" data-label="Português"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/pt.svg') }}" alt="PT" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">Português</div>
            <div class="text-xs text-gray-500">Portugal</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Arabe --}}
        <button data-lang="ar" data-flag="{{ asset('images/flags/sa.svg') }}" data-label="العربية"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/sa.svg') }}" alt="AR" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">العربية</div>
            <div class="text-xs text-gray-500">السعودية</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>
        
        {{-- Hindi --}}
        <button data-lang="hi" data-flag="{{ asset('images/flags/in.svg') }}" data-label="हिन्दी"
                class="lang-option w-full flex items-center gap-4 px-4 py-4 rounded-2xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group border-2 border-transparent hover:border-blue-200 hover:shadow-sm">
          <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center border-2 border-gray-100 group-hover:border-blue-200 transition-colors flex-shrink-0">
            <img src="{{ asset('images/flags/in.svg') }}" alt="HI" class="w-7 h-6 object-cover rounded" width="28" height="24" />
          </div>
          <div class="flex-1 text-left">
            <div class="font-bold text-gray-900 text-base">हिन्दी</div>
            <div class="text-xs text-gray-500">भारत</div>
          </div>
          <svg class="w-5 h-5 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
          </svg>
        </button>

        {{-- Espace supplémentaire pour safe-area iOS --}}
        <div class="h-6" style="padding-bottom: env(safe-area-inset-bottom, 20px);"></div>

      </div>
    </div>
    
  </div>
</div>