{{--
  LANGUAGE SELECTOR MOBILE - Bottom Sheet
  Langues : EN, FR, DE, RU, ZH, ES, PT, AR, HI
--}}

{{-- Bouton sélecteur de langue --}}
<button
  id="mobileLangBtn"
  type="button"
  class="flex items-center justify-between w-full bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm"
  aria-label="Select language">
  <div class="flex items-center gap-3">
    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
      <img id="mobileLangFlag" src="{{ asset('images/flags/us.svg') }}" alt="" class="w-5 h-4 object-cover rounded notranslate" width="20" height="16" translate="no" />
    </div>
    <div class="text-left">
      <div id="mobileLangLabel" class="text-sm font-semibold text-gray-800">English</div>
    </div>
  </div>
  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
  </svg>
</button>

{{-- Bottom Sheet Modal --}}
<div id="mobileLangModal" class="fixed inset-0 z-[9999] hidden">
  {{-- Overlay --}}
  <div id="mobileLangOverlay" class="absolute inset-0 bg-black/50"></div>

  {{-- Bottom Sheet - Hauteur limitée à 65% max --}}
  <div id="mobileLangSheet" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl shadow-2xl transform translate-y-full" style="max-height: 65vh;">

    {{-- Handle --}}
    <div class="flex justify-center pt-3 pb-1">
      <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
    </div>

    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-2 border-b border-gray-100">
      <span class="text-base font-bold text-gray-900">Language</span>
      <button id="mobileLangCloseBtn" type="button" class="p-2 rounded-full hover:bg-gray-100">
        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    {{-- Liste des langues --}}
    <div class="overflow-y-auto p-2" style="max-height: calc(65vh - 80px); -webkit-overflow-scrolling: touch;">

      {{-- English --}}
      <button data-lang="en" data-flag="{{ asset('images/flags/us.svg') }}" data-label="English"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/us.svg') }}" alt="EN" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">English</span>
      </button>

      {{-- Français --}}
      <button data-lang="fr" data-flag="{{ asset('images/flags/fr.svg') }}" data-label="Français"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/fr.svg') }}" alt="FR" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">Français</span>
      </button>

      {{-- Deutsch --}}
      <button data-lang="de" data-flag="{{ asset('images/flags/de.svg') }}" data-label="Deutsch"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/de.svg') }}" alt="DE" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">Deutsch</span>
      </button>

      {{-- Español --}}
      <button data-lang="es" data-flag="{{ asset('images/flags/es.svg') }}" data-label="Español"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/es.svg') }}" alt="ES" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">Español</span>
      </button>

      {{-- Português --}}
      <button data-lang="pt" data-flag="{{ asset('images/flags/pt.svg') }}" data-label="Português"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/pt.svg') }}" alt="PT" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">Português</span>
      </button>

      {{-- Русский --}}
      <button data-lang="ru" data-flag="{{ asset('images/flags/ru.svg') }}" data-label="Русский"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/ru.svg') }}" alt="RU" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">Русский</span>
      </button>

      {{-- 中文 --}}
      <button data-lang="zh-CN" data-flag="{{ asset('images/flags/cn.svg') }}" data-label="中文"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/cn.svg') }}" alt="CN" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">中文</span>
      </button>

      {{-- العربية --}}
      <button data-lang="ar" data-flag="{{ asset('images/flags/sa.svg') }}" data-label="العربية"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/sa.svg') }}" alt="AR" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">العربية</span>
      </button>

      {{-- हिन्दी --}}
      <button data-lang="hi" data-flag="{{ asset('images/flags/in.svg') }}" data-label="हिन्दी"
              class="lang-option w-full flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-blue-50 active:bg-blue-100">
        <img src="{{ asset('images/flags/in.svg') }}" alt="HI" class="w-8 h-6 object-cover rounded border" />
        <span class="font-semibold text-gray-800">हिन्दी</span>
      </button>

      {{-- Safe area --}}
      <div class="h-4" style="padding-bottom: env(safe-area-inset-bottom, 0);"></div>

    </div>
  </div>
</div>

<style>
#mobileLangSheet {
  transition: transform 0.3s ease-out;
}
#mobileLangOverlay {
  transition: opacity 0.2s ease;
  opacity: 0;
}
#mobileLangModal:not(.hidden) #mobileLangOverlay {
  opacity: 1;
}
#mobileLangModal:not(.hidden) #mobileLangSheet {
  transform: translateY(0);
}
</style>
