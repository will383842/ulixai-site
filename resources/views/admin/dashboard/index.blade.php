<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - ULIXAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="64x64" href="images/logoblue-64.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-50">
@if (session('success'))
    <script>
        toastr.success('{{ session('success') }}', 'Success');
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error('{{ session('error') }}', 'Error');
    </script>
@endif

    <!-- Admin Navbar -->
 <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
  <!-- Left side -->
  <div class="flex items-center gap-3">
    <img src="/images/headerlogo.png" alt="Logo" class="w-10 h-10 object-contain" />
    <span class="font-bold text-blue-700 text-xl">@site Admin</span>
  </div>

  <!-- Right side: Language + Logout -->
  <div class="flex items-center gap-4">
 <div class="relative w-full sm:w-56">
  <!-- Hidden checkbox controls open/close -->
  <input id="langOpen" type="checkbox" class="peer sr-only" />

  <!-- Toggle button -->
  <label for="langOpen"
         class="flex justify-between items-center w-[140px] border border-gray-300 rounded-lg px-4 py-2 text-gray-800 bg-white cursor-pointer select-none">
    <span id="languageLabel">Language</span>
    <img id="languageFlag" src="https://flagcdn.com/24x18/us.png" alt="Lang" class="ml-2 w-5 h-4 object-cover" />
 </label>

  <!-- Menu (shown when checkbox is checked) -->
  <ul  id="languageMenu"
      class="absolute left-0 right-0 mt-2 bg-white border border-gray-300 rounded-lg shadow-md z-50 hidden peer-checked:block">

        <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
      <img src="https://flagcdn.com/24x18/us.png" class="w-5 h-4" /> English
    </li>
    <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
      <img src="https://flagcdn.com/24x18/fr.png" class="w-5 h-4" /> Français
    </li>
  
   
  </ul>
</div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit"
        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold">
        Logout
      </button>
    </form>
  </div>
</nav>

<!-- Hidden Google Translate widget -->
<div id="google_translate_element" class="hidden"></div>

    <!-- Admin Layout with Sidebar -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('admin.dashboard.sidebar')
        <!-- Main Content Area -->
        <main class="flex-1 p-2">
            {{-- Child admin components will load here --}}
            @yield('admin-content')
        </main>
    </div>
</body>
<script>
// Cookie helpers
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

  // Apply language (queue if Google select not ready yet)
  let pendingLang = null;
  function applyLanguage(code) {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      // iOS/Safari-safe change event
      const ev = document.createEvent('HTMLEvents');
      ev.initEvent('change', true, true);
      select.dispatchEvent(ev);
      pendingLang = null;
    } else {
      pendingLang = code;
    }
  }

  // Handle item clicks using delegation
  menu.addEventListener('click', function (e) {
    const li = e.target.closest('li[data-lang]');
    if (!li) return;

    const code    = li.dataset.lang;
    const flagUrl = li.dataset.flag;
    const name    = li.textContent.trim();

    // Update UI
    flag.src = flagUrl;
    label.textContent = name;

    // Save to localStorage
    localStorage.setItem('selectedLang', code);
    localStorage.setItem('selectedFlag', flagUrl);

    // Align cookies
    alignCookiesFor(code);

    // Set hash
    if (code === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = 'googtrans(en|' + code + ')';
    }

    // Try to set select and reload
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      select.dispatchEvent(new Event('change'));
      setTimeout(() => location.reload(), 100);
    } else {
      // Wait for it
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

    // Close dropdown by unchecking checkbox
    checkbox.checked = false;
  });

  // Initialize Google Translate
  window.googleTranslateElementInit = function () {
    new google.translate.TranslateElement(
      { pageLanguage: 'en', includedLanguages: 'en,fr,de', autoDisplay: false },
      'google_translate_element'
    );
  };

  // Load Google script once
  if (!document.getElementById('gt-script')) {
    const s = document.createElement('script');
    s.id = 'gt-script';
    s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.body.appendChild(s);
  }

  // If user selects before widget is ready, apply later
  const start = Date.now();
  (function waitForSelect() {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      if (pendingLang) applyLanguage(pendingLang);
      return;
    }
    if (Date.now() - start < 12000) setTimeout(waitForSelect, 200);
  })();

  // Load saved language on page load
  const savedLang = localStorage.getItem('selectedLang') || 'en';
  const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
  const langNames = { en: 'English', fr: 'Français', de: 'Deutsch' };
  flag.src = savedFlag;
  label.textContent = langNames[savedLang] || 'Language';
  // Align cookies
  alignCookiesFor(savedLang);
  // Set hash if not en
  if (savedLang !== 'en') {
    window.location.hash = 'googtrans(en|' + savedLang + ')';
    // Try to set select
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = savedLang;
      select.dispatchEvent(new Event('change'));
    } else {
      // Wait for it
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



 <style>
      <style>
  /* hide the top banner frame Google injects */
  iframe.goog-te-banner-frame {
    display: none !important;
  }
  body > .skiptranslate {
    display: none !important;
  }
  html {
    margin-top: 0 !important;
  }

  /* hide the inline toolbar / popup */
  .goog-te-gadget {
    height: 0 !important;
    overflow: hidden !important;
  }
  .VIpgJd-ZVi9od-ORHb, 
  .VIpgJd-ZVi9od-aZ2wEe-wOHMyf, /* common toolbar wrapper */
  .VIpgJd-ZVi9od-ORHb-OEVmcd,
  .VIpgJd-ZVi9od-ORHb-hFsbo,
  .VIpgJd-ZVi9od-l4eHX-hSRGPd {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
  }
</style>
<style>
  /* Kill the top banner and any wrapper space */
  iframe.goog-te-banner-frame,
  .goog-te-banner-frame { display: none !important; }

  /* Google wraps the page with a div.skiptranslate that still takes space */
  body > .skiptranslate {
    display: none !important;
    height: 0 !important;
    overflow: hidden !important;
  }

  /* Google sometimes adds a top margin to html */
  html { margin-top: 0 !important; }

  /* Google sometimes sets body { top: 40px } */
  body { top: 0 !important; position: static !important; }

  /* Optional: hide floating tooltip/mini-toolbar */
  #goog-gt-tt, .goog-te-balloon-frame, .goog-te-gadget { display: none !important; }
</style>



</html>
