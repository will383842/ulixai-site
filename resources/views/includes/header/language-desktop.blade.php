{{-- 
  ═══════════════════════════════════════════════════════════
  🌐 LANGUAGE SELECTOR DESKTOP - ULTRA MODERN
  ═══════════════════════════════════════════════════════════
  
  Design minimaliste : drapeau rectangulaire arrondi + chevron
  Pas de bordure, fond transparent
  
  @version 2.3.0
--}}

<div class="relative inline-block">
  <button id="langBtn" type="button"
    class="flex items-center gap-2 px-2 py-2 rounded-lg hover:bg-gray-50 transition-all duration-200 group"
    aria-label="Select language"
    aria-haspopup="menu"
    aria-expanded="false">
    {{-- Drapeau rectangle arrondi --}}
    <div class="w-9 h-7 rounded-md overflow-hidden shadow-sm">
      <img id="langFlag" src="{{ asset('images/flags/us.svg') }}" alt="EN" class="w-full h-full object-cover" width="36" height="28">
    </div>
    {{-- Petit chevron discret --}}
    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transition-all duration-200" id="langChevron" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  {{-- Dropdown Menu - Design moderne --}}
  <ul id="langMenu"
      class="absolute right-0 hidden bg-white shadow-2xl border border-gray-100 rounded-2xl mt-2 w-52 z-20 py-2 overflow-hidden"
      role="menu">
    {{-- Anglais --}}
    <li data-lang="en" data-flag="{{ asset('images/flags/us.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/us.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">English</span>
    </li>
    
    {{-- Français --}}
    <li data-lang="fr" data-flag="{{ asset('images/flags/fr.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/fr.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">Français</span>
    </li>
    
    {{-- Allemand --}}
    <li data-lang="de" data-flag="{{ asset('images/flags/de.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/de.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">Deutsch</span>
    </li>
    
    {{-- Russe --}}
    <li data-lang="ru" data-flag="{{ asset('images/flags/ru.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/ru.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">Русский</span>
    </li>
    
    {{-- Chinois --}}
    <li data-lang="zh-CN" data-flag="{{ asset('images/flags/cn.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/cn.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">中文</span>
    </li>
    
    {{-- Espagnol --}}
    <li data-lang="es" data-flag="{{ asset('images/flags/es.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/es.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">Español</span>
    </li>
    
    {{-- Portugais --}}
    <li data-lang="pt" data-flag="{{ asset('images/flags/pt.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/pt.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">Português</span>
    </li>
    
    {{-- Arabe --}}
    <li data-lang="ar" data-flag="{{ asset('images/flags/sa.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/sa.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">العربية</span>
    </li>
    
    {{-- Hindi --}}
    <li data-lang="hi" data-flag="{{ asset('images/flags/in.svg') }}"
        class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-150 group"
        role="menuitem">
      <div class="w-8 h-6 rounded-md overflow-hidden shadow-sm flex-shrink-0">
        <img src="{{ asset('images/flags/in.svg') }}" alt="" class="w-full h-full object-cover" width="32" height="24">
      </div>
      <span class="font-medium text-gray-700 group-hover:text-blue-600">हिन्दी</span>
    </li>
  </ul>
</div>