<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>Admin Dashboard - ULIXAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon spécifique à l'admin : ancien favicon -->
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/logoblue-64.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Libs -->
    <script src="https://cdn.tailwindcss.com"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    @stack('head')

    <!-- Styles pour Google Translate (caché) -->
    <style>
      /* Cacher la bannière et les wrappers injectés par Google */
      iframe.goog-te-banner-frame,
      .goog-te-banner-frame { display: none !important; }
      body > .skiptranslate { display: none !important; height: 0 !important; overflow: hidden !important; }
      html { margin-top: 0 !important; }
      body { top: 0 !important; position: static !important; }

      /* Cacher la toolbar/tooltip */
      #goog-gt-tt, .goog-te-balloon-frame, .goog-te-gadget { display: none !important; }
      .VIpgJd-ZVi9od-ORHb,
      .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
      .VIpgJd-ZVi9od-ORHb-OEVmcd,
      .VIpgJd-ZVi9od-ORHb-hFsbo,
      .VIpgJd-ZVi9od-l4eHX-hSRGPd {
        display: none !important; visibility: hidden !important; opacity: 0 !important;
      }

      /* --- Empilement sûr : header toujours au-dessus --- */
      .admin-header { position: sticky; top: 0; z-index: 99999; background: #fff; isolation: isolate; }
      .admin-main   { position: relative; z-index: 0; padding-top: var(--admin-header-h, 64px); min-height: calc(100vh - var(--admin-header-h, 64px)); }

      /* Filet discret pour détacher le header */
      .admin-header { border-bottom: 1px solid rgba(0,0,0,.06); }
    
      /* Sticky sidebar below header */
      .admin-sidebar { position: sticky; top: var(--admin-header-h, 64px); height: calc(100vh - var(--admin-header-h, 64px)); overflow-y: auto; }

      /* Chart containers with fixed height to prevent growth loops */
      .chart-area { position: relative; height: 360px; }
      .chart-area.sm  { height: 220px; }
      .chart-area.lg  { height: 480px; }

      /* Keep main below header and avoid overlay */
      .admin-main { contain: layout paint; z-index: 1; }
      .admin-shell { position: relative; z-index: 0; }
</style>
    <link rel="stylesheet" href="{{ asset('css/admin-compat.css') }}">
    <script src="{{ asset('js/admin-layout.js') }}" defer></script>

    <style>

      /* Cacher la bannière et les wrappers injectés par Google */
      iframe.goog-te-banner-frame,
      .goog-te-banner-frame { display: none !important; }
      body > .skiptranslate { display: none !important; height: 0 !important; overflow: hidden !important; }
      html { margin-top: 0 !important; }
      body { top: 0 !important; position: static !important; }

      /* Cacher la toolbar/tooltip */
      #goog-gt-tt, .goog-te-balloon-frame, .goog-te-gadget { display: none !important; }
      .VIpgJd-ZVi9od-ORHb,
      .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
      .VIpgJd-ZVi9od-ORHb-OEVmcd,
      .VIpgJd-ZVi9od-ORHb-hFsbo,
      .VIpgJd-ZVi9od-l4eHX-hSRGPd {
        display: none !important; visibility: hidden !important; opacity: 0 !important;
      }

      /* --- Empilement sûr : header toujours au-dessus --- */
      .admin-header { position: sticky; top: 0; z-index: 99999; background: #fff; isolation: isolate; }
      .admin-main   { position: relative; z-index: 0; padding-top: var(--admin-header-h, 64px); min-height: calc(100vh - var(--admin-header-h, 64px)); }

      /* Filet discret pour détacher le header */
      .admin-header { border-bottom: 1px solid rgba(0,0,0,.06); }
    
      /* Sticky sidebar below header */
      .admin-sidebar { position: sticky; top: var(--admin-header-h, 64px); height: calc(100vh - var(--admin-header-h, 64px)); overflow-y: auto; }

      /* Chart containers with fixed height to prevent growth loops */
      .chart-area { position: relative; height: 360px; }
      .chart-area.sm  { height: 220px; }
      .chart-area.lg  { height: 480px; }

      /* Keep main below header and avoid overlay */
      .admin-main { contain: layout paint; z-index: 1; }
      .admin-shell { position: relative; z-index: 0; }


      /* --- Admin Grid Layout (robuste) --- */
      .admin-grid { 
        min-height: 100vh; 
        display: grid;
        grid-template-rows: auto 1fr;
        grid-template-columns: 16rem 1fr; /* sidebar 256px + content */
      }
      .admin-header { 
        grid-row: 1; 
        grid-column: 1 / -1; 
        position: sticky; top: 0; z-index: 99999; background: #fff; isolation: isolate; 
        border-bottom: 1px solid rgba(0,0,0,.06);
      }
      .admin-sidebar { 
        grid-row: 2; grid-column: 1; 
        position: sticky; top: var(--admin-header-h, 64px);
        height: calc(100vh - var(--admin-header-h, 64px));
        overflow-y: auto;
        background: #fff;
        border-right: 1px solid #f3f4f6;
      }
      .admin-main { 
        grid-row: 2; grid-column: 2; 
        position: relative; z-index: 1;
        padding-top: 0; /* header est hors flux, pas besoin de padding ici */
        contain: layout paint;
      }

      /* Chart containers */
      .chart-area { position: relative; height: 360px; }
      .chart-area.sm { height: 220px; }
      .chart-area.lg { height: 480px; }

      /* Sécurité overlay: contenu sous le header */
      .admin-main, .admin-main * { z-index: initial; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin-compat.css') }}">
    <script src="{{ asset('js/admin-layout.js') }}" defer></script>
</head>
<body class="bg-gray-50">

@if (session('success'))
<script>toastr.success('{{ session('success') }}', 'Success');</script>
@endif
@if (session('error'))
<script>toastr.error('{{ session('error') }}', 'Error');</script>
@endif

<!-- Admin Grid: header full width, then sidebar + main -->
<div class="admin-grid">

  <!-- Admin Navbar -->
  <nav role="navigation" aria-label="Admin header" class="admin-header px-6 py-4 flex justify-between items-center">
    <!-- Left side -->
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logoblue-64.png') }}" alt="Ulixai" class="w-10 h-10 object-contain rounded-full">
      <span class="font-bold text-blue-700 text-xl">Administrateur Ulixai</span>
    </div>

    <!-- Right side (lang + disconnect) -->
    <div class="flex items-center gap-2">
      <div id="google_translate_element" class="hidden"></div>
      <div class="flex items-center gap-2">
        <div id="langDropdown" class="relative">
          <input type="checkbox" id="langToggle" class="peer hidden" aria-hidden="true">
          <label for="langToggle" class="border rounded px-3 py-1 text-sm cursor-pointer select-none flex items-center gap-2" aria-haspopup="listbox" aria-expanded="false">
            <span id="currentLangLabel">Français</span>
            <span class="fi fi-fr" aria-hidden="true"></span>
          </label>
          <div class="absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-md z-50 hidden peer-checked:block" role="listbox" aria-label="Choisir la langue">
            <button type="button" data-lang="fr" class="w-full flex justify-between items-center px-3 py-2 hover:bg-gray-50 text-left">
              <span>Français</span><span class="fi fi-fr"></span>
            </button>
            <button type="button" data-lang="en" class="w-full flex justify-between items-center px-3 py-2 hover:bg-gray-50 text-left">
              <span>English</span><span class="fi fi-gb"></span>
            </button>
            <button type="button" data-lang="de" class="w-full flex justify-between items-center px-3 py-2 hover:bg-gray-50 text-left">
              <span>Deutsch</span><span class="fi fi-de"></span>
            </button>
            <button type="button" data-lang="es" class="w-full flex justify-between items-center px-3 py-2 hover:bg-gray-50 text-left">
              <span>Español</span><span class="fi fi-es"></span>
            </button>
            <button type="button" data-lang="pt" class="w-full flex justify-between items-center px-3 py-2 hover:bg-gray-50 text-left">
              <span>Português</span><span class="fi fi-pt"></span>
            </button>
          </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="ml-2">
          @csrf
          <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" type="submit">Déconnexion</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  @include('admin.dashboard.sidebar')

  <!-- Main Content Area -->
  <main class="admin-main p-2" role="main" id="main-content" tabindex="-1">
      @yield('admin-content')
  </main>
</div>

@stack('scripts')

<!-- Lang / Google Translate logic -->
<script>
/* ... (inchangé : ton JS existant) ... */
function domains() {
  const host = location.hostname;
  const naked = host.replace(/^www\./, '');
  const list = [undefined];
  if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) list.push(naked);
  if (naked !== host) list.push(host);
  return list;
}
function setCookie(name, value, days = 365) {
  const exp = new Date(Date.now() + days * 864e5).toUTCString();
  domains().forEach(d => {
    document.cookie = `${name}=${value}; expires=${exp}; path=/` + (d ? `; domain=${d}` : '');
  });
}
function clearCookie(name) {
  const past = 'Thu, 01 Jan 1970 00:00:01 GMT';
  domains().forEach(d => {
    document.cookie = `${name}=; expires=${past}; path=/` + (d ? `; domain=${d}` : '');
  });
}
function alignCookiesFor(lang) {
  if (!lang || lang === 'en') {
    clearCookie('googtrans');
    clearCookie('googtransopt');
  } else {
    const val = `/auto/${lang}`;
    setCookie('googtrans', val);
    setCookie('googtransopt', val);
  }
}

(function () {
  const checkbox = document.getElementById('langOpen');
  const menu     = document.getElementById('languageMenu');
  const flag     = document.getElementById('languageFlag');
  const label    = document.getElementById('languageLabel');

  let pendingLang = null;
  function applyLanguage(code) {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      const ev = document.createEvent('HTMLEvents');
      ev.initEvent('change', true, true);
      select.dispatchEvent(ev);
      pendingLang = null;
    } else {
      pendingLang = code;
    }
  }

  menu.addEventListener('click', function (e) {
    const li = e.target.closest('li[data-lang]');
    if (!li) return;

    const code    = li.dataset.lang;
    const flagUrl = li.dataset.flag;
    const name    = li.textContent.trim();

    flag.src = flagUrl;
    label.textContent = name;

    localStorage.setItem('selectedLang', code);
    localStorage.setItem('selectedFlag', flagUrl);

    alignCookiesFor(code);

    if (code === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = 'googtrans(en|' + code + ')';
    }

    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      select.dispatchEvent(new Event('change'));
      setTimeout(() => location.reload(), 100);
    } else {
      const start = Date.now();
      (function wait() {
        const sel = document.querySelector('#google_translate_element select.goog-te-combo');
        if (sel) {
          sel.value = code;
          sel.dispatchEvent(new Event('change'));
          setTimeout(() => location.reload(), 100);
        } else if (Date.now() - start < 2000) {
          setTimeout(wait, 100);
        } else {
          setTimeout(() => location.reload(), 100);
        }
      })();
    }

    checkbox.checked = false;
  });

  window.googleTranslateElementInit = function () {
    new google.translate.TranslateElement(
      { pageLanguage: 'en', includedLanguages: 'en,fr,de,ru,zh-CN,es,pt,ar,hi', autoDisplay: false },
      'google_translate_element'
    );
  };

  if (!document.getElementById('gt-script')) {
    const s = document.createElement('script');
    s.id = 'gt-script';
    s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.body.appendChild(s);
  }

  const start = Date.now();
  (function waitForSelect() {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      if (pendingLang) applyLanguage(pendingLang);
      return;
    }
    if (Date.now() - start < 12000) setTimeout(waitForSelect, 200);
  })();

  const savedLang = localStorage.getItem('selectedLang') || 'en';
  const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
  const langNames = { en: 'English', fr: 'Français', de: 'Deutsch' };
  flag.src = savedFlag;
  label.textContent = langNames[savedLang] || 'Language';
  alignCookiesFor(savedLang);
  if (savedLang !== 'en') {
    window.location.hash = 'googtrans(en|' + savedLang + ')';
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = savedLang;
      select.dispatchEvent(new Event('change'));
    } else {
      const start = Date.now();
      (function wait() {
        const sel = document.querySelector('#google_translate_element select.goog-te-combo');
        if (sel) {
          sel.value = savedLang;
          sel.dispatchEvent(new Event('change'));
        } else if (Date.now() - start < 5000) {
          setTimeout(wait, 100);
        }
      })();
    }
  }
})();
</script>

</body>
</html>
