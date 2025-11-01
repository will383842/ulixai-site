<!-- COOKIE BANNER - À INCLURE DANS LE LAYOUT -->

<div id="ulixaiCookieBanner" class="fixed bottom-0 left-0 right-0 bg-white shadow-2xl z-50 border-t-4 border-blue-600" style="display: none;">
  <div class="max-w-7xl mx-auto px-4 py-6 md:py-5">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
      
      <div class="flex-1 flex items-start gap-3">
        <div class="text-3xl flex-shrink-0 mt-1" aria-hidden="true">🍪</div>
        <div>
          <h3 class="font-bold text-gray-800 text-base md:text-lg mb-1">Your Privacy Matters to Us</h3>
          <p class="text-gray-600 text-sm md:text-base leading-relaxed">
            We use cookies to enhance your experience, analyze traffic, and show relevant content. You're in control.
            <a href="{{ route('cookies.show') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline transition-colors">Learn more →</a>
          </p>
        </div>
      </div>

      <div class="flex gap-2 w-full md:w-auto flex-shrink-0">
        <button onclick="rejectAllCookies()" class="flex-1 md:flex-none px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-full text-sm transition-all duration-300 hover:scale-105 whitespace-nowrap">🚫 Reject</button>
        <button onclick="acceptAllCookies()" class="flex-1 md:flex-none px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-full text-sm transition-all duration-300 hover:scale-105 whitespace-nowrap">✅ Accept All</button>
        <a href="{{ route('cookies.show') }}" class="flex-1 md:flex-none px-4 py-2.5 bg-blue-100 hover:bg-blue-200 text-blue-800 font-bold rounded-full text-sm transition-all duration-300 hover:scale-105 whitespace-nowrap text-center">⚙️ Settings</a>
      </div>
    </div>
  </div>
</div>

<script>
  class UlixaiCookieManager {
    constructor() {
      this.cookieName = 'ulixai_cookie_preferences';
      this.bannerElement = document.getElementById('ulixaiCookieBanner');
      this.init();
    }

    init() {
      if (this.hasCookieConsent()) {
        this.hideBanner();
      } else {
        this.showBanner();
      }
    }

    hasCookieConsent() {
      const cookie = this.getCookie(this.cookieName);
      return cookie !== null;
    }

    getCookie(name) {
      const nameEQ = name + '=';
      const cookies = document.cookie.split(';');
      for (let cookie of cookies) {
        cookie = cookie.trim();
        if (cookie.indexOf(nameEQ) === 0) {
          return cookie.substring(nameEQ.length);
        }
      }
      return null;
    }

    showBanner() {
      if (this.bannerElement) {
        this.bannerElement.style.display = 'flex';
      }
    }

    hideBanner() {
      if (this.bannerElement) {
        this.bannerElement.style.display = 'none';
      }
    }

    acceptAll() {
      this.sendPreferences({
        strictly_necessary: true,
        performance: true,
        functionality: true,
        marketing: true
      });
    }

    rejectAll() {
      this.sendPreferences({
        strictly_necessary: true,
        performance: false,
        functionality: false,
        marketing: false
      });
    }

    sendPreferences(preferences) {
      fetch('{{ route("cookies.save") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(preferences)
      })
      .then(response => response.json())
      .then(data => {
        this.hideBanner();
      })
      .catch(error => console.error('Error:', error));
    }
  }

  let cookieManager;
  document.addEventListener('DOMContentLoaded', function() {
    cookieManager = new UlixaiCookieManager();
  });

  function acceptAllCookies() {
    if (cookieManager) cookieManager.acceptAll();
  }

  function rejectAllCookies() {
    if (cookieManager) cookieManager.rejectAll();
  }
</script>