{{-- 🍪 BANNER COOKIES FUN & VOYANT - OPTIMISÉ CPU + SYNCHRONISÉ --}}
<div id="cookieBanner" class="cookie-banner-hidden fixed bottom-0 left-0 right-0 z-[9998] p-2 sm:p-3 pointer-events-none" role="dialog" aria-labelledby="cookieBannerTitle" aria-describedby="cookieBannerDesc">
  <div class="max-w-4xl mx-auto pointer-events-auto">
    <div class="cookie-card relative">
      
      {{-- Icônes Modernes Animées --}}
      <div class="arrow-left">
        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7m0 0l7-7m-7 7h12"/>
        </svg>
        <span class="arrow-text">Glissez!</span>
      </div>
      
      <div class="arrow-right">
        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7m0 0l-7 7m7-7H6"/>
        </svg>
        <span class="arrow-text">Go!</span>
      </div>
      
      {{-- ✨ BOUTON FERMER --}}
      <button 
        onclick="cookieBannerRejectAll()" 
        class="close-btn"
        aria-label="Close and reject optional cookies"
        title="❌ Rejeter & Fermer"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
      
      {{-- Contenu Compact --}}
      <div class="p-3 sm:p-4 pr-12">
        
        {{-- Header Compact --}}
        <div class="flex items-center gap-2 sm:gap-3 mb-3">
          <div class="icon-container flex-shrink-0">
            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
          </div>
          <div class="flex-1 min-w-0">
            <h2 id="cookieBannerTitle" class="text-sm sm:text-base font-black text-gray-900 mb-0.5">
              🍪 Quick Choice!
            </h2>
            <p id="cookieBannerDesc" class="text-xs sm:text-sm text-gray-800 leading-tight">
              Cookies = Better experience. <strong class="hidden sm:inline">Pick one!</strong>
            </p>
          </div>
        </div>
        
        {{-- Action Buttons --}}
        <div class="grid grid-cols-3 gap-2">
          
          {{-- Accept Button --}}
          <button 
            onclick="cookieBannerAcceptAll()" 
            class="btn-main btn-accept"
            aria-label="Accept all cookies"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-black text-xs sm:text-sm">Accept</span>
          </button>
          
          {{-- Reject Button --}}
          <button 
            onclick="cookieBannerRejectAll()" 
            class="btn-main btn-reject"
            aria-label="Reject optional cookies"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="font-black text-xs sm:text-sm">Reject</span>
          </button>
          
          {{-- Customize Button --}}
          <a 
            href="/cookiemanagment" 
            class="btn-main btn-customize"
            aria-label="Customize preferences"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="font-bold text-xs sm:text-sm hidden xs:inline">Settings</span>
            <span class="font-bold text-xs xs:hidden">⚙️</span>
          </a>
          
        </div>
        
        {{-- Footer Links --}}
        <div class="mt-2 flex flex-wrap gap-2 justify-center text-[10px] sm:text-xs text-gray-700">
          <a href="/cookiemanagment" class="hover:text-blue-600 font-medium">Policy</a>
          <span>•</span>
          <a href="/privacy-policy" class="hover:text-blue-600 font-medium">Privacy</a>
          <span class="hidden sm:inline">•</span>
          <span class="hidden sm:inline font-bold text-green-700">✓ GDPR</span>
        </div>
        
      </div>
    </div>
  </div>
</div>

<style>
/* ============================================
   🎯 COOKIE BANNER FUN JAUNE - OPTIMISÉ CPU
   ============================================ */

.cookie-banner-hidden {
  display: none;
}

.cookie-banner-visible {
  display: block;
  animation: slideUpBounce 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes slideUpBounce {
  0% {
    transform: translateY(100%) translateZ(0);
    opacity: 0;
  }
  60% {
    transform: translateY(-8px) translateZ(0);
  }
  100% {
    transform: translateY(0) translateZ(0);
    opacity: 1;
  }
}

/* Main Card - DESIGN MODERNE & ÉPURÉ */
.cookie-card {
  background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f5f3ff 100%);
  border-radius: 16px;
  border: 1px solid rgba(14, 165, 233, 0.3);
  box-shadow: 
    0 10px 30px rgba(14, 165, 233, 0.15),
    0 0 1px rgba(14, 165, 233, 0.1);
  max-height: 160px;
  will-change: transform;
  animation: subtleFloat 3s ease-in-out infinite;
}

/* Animation Flottante Douce & Contemporaine - GPU Optimisée */
@keyframes subtleFloat {
  0%, 100% {
    transform: translateY(0) translateZ(0);
  }
  50% {
    transform: translateY(-6px) translateZ(0);
  }
}

/* ✨ FLÈCHES MODERNES ANIMÉES - Minimaliste */
.arrow-left,
.arrow-right {
  position: absolute;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  color: #0ea5e9;
  font-weight: 700;
  pointer-events: none;
  will-change: transform;
  opacity: 0.8;
}

.arrow-left {
  left: -70px;
  top: 50%;
  transform: translateY(-50%) translateZ(0);
  animation: slideInLeft 1.8s ease-in-out infinite;
}

.arrow-right {
  right: -70px;
  top: 50%;
  transform: translateY(-50%) translateZ(0);
  animation: slideInRight 1.8s ease-in-out infinite;
}

.arrow-text {
  font-size: 12px;
  text-shadow: 
    0 2px 8px rgba(14, 165, 233, 0.2);
  letter-spacing: 0.3px;
  font-weight: 700;
}

@keyframes slideInLeft {
  0%, 100% {
    transform: translateY(-50%) translateX(-12px) translateZ(0);
    opacity: 0.6;
  }
  50% {
    transform: translateY(-50%) translateX(0) translateZ(0);
    opacity: 1;
  }
}

@keyframes slideInRight {
  0%, 100% {
    transform: translateY(-50%) translateX(12px) translateZ(0);
    opacity: 0.6;
  }
  50% {
    transform: translateY(-50%) translateX(0) translateZ(0);
    opacity: 1;
  }
}

/* Masquer flèches sur mobile */
@media (max-width: 768px) {
  .arrow-left,
  .arrow-right {
    display: none;
  }
}

/* ✨ BOUTON FERMER - Design Moderne */
.close-btn {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(71, 85, 105, 0.1);
  color: #475569;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: none;
  z-index: 10;
  flex-shrink: 0;
  will-change: transform;
}

.close-btn:hover {
  background: rgba(71, 85, 105, 0.2);
  transform: scale(1.1) translateZ(0);
}

.close-btn:active {
  transform: scale(0.95) translateZ(0);
}

/* Icon Container - Moderne */
.icon-container {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0ea5e9, #06b6d4);
  border-radius: 10px;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(14, 165, 233, 0.2);
}

/* Main Buttons - Optimisés */
.btn-main {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  padding: 10px 12px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), 
              box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  min-height: 44px;
  touch-action: manipulation;
  will-change: transform;
  font-weight: 900;
}

.btn-main:hover {
  transform: translateY(-2px) translateZ(0) scale(1.02);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.btn-main:active {
  transform: translateY(0) translateZ(0) scale(0.98);
}

/* Accept Button - Design Moderne & Épuré */
.btn-accept {
  background: linear-gradient(135deg, #0ea5e9, #06b6d4);
  color: white;
  box-shadow: 
    0 4px 12px rgba(14, 165, 233, 0.3),
    0 0 1px rgba(14, 165, 233, 0.1);
  animation: gentleShimmer 2.5s ease-in-out infinite;
}

@keyframes gentleShimmer {
  0%, 100% {
    box-shadow: 
      0 4px 12px rgba(14, 165, 233, 0.3),
      0 0 1px rgba(14, 165, 233, 0.1);
  }
  50% {
    box-shadow: 
      0 6px 16px rgba(14, 165, 233, 0.4),
      0 0 1px rgba(14, 165, 233, 0.15);
  }
}

.btn-accept:hover {
  background: linear-gradient(135deg, #0284c7, #0891b2);
  animation: none;
}

/* Reject Button - Gris moderne */
.btn-reject {
  background: linear-gradient(135deg, #94a3b8, #64748b);
  color: white;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.btn-reject:hover {
  background: linear-gradient(135deg, #64748b, #475569);
}

/* Customize Button - Blanc moderne */
.btn-customize {
  background: white;
  color: #0ea5e9;
  border: 1px solid rgba(14, 165, 233, 0.3);
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.btn-customize:hover {
  background: rgba(14, 165, 233, 0.05);
  border-color: #0ea5e9;
}

/* Desktop Improvements */
@media (min-width: 640px) {
  .cookie-card {
    border-radius: 14px;
    max-height: 180px;
  }
  
  .close-btn {
    width: 36px;
    height: 36px;
    top: 10px;
    right: 10px;
  }
  
  .icon-container {
    width: 36px;
    height: 36px;
  }
  
  .btn-main {
    padding: 12px 16px;
    gap: 6px;
  }
}

/* Reduced Motion - Désactive animations si préféré */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
  
  .cookie-card {
    animation: none !important;
  }
  
  .arrow-left,
  .arrow-right {
    animation: none !important;
  }
}

/* High Contrast */
@media (prefers-contrast: high) {
  .cookie-card {
    border: 4px solid #000;
  }
  
  .btn-main {
    border: 2px solid currentColor;
  }
}

/* Touch optimization */
@media (pointer: coarse) {
  .btn-main {
    min-height: 48px;
  }
  
  .close-btn {
    min-width: 44px;
    min-height: 44px;
  }
}

/* GPU Acceleration - Force Hardware Acceleration */
.cookie-card,
.btn-main,
.close-btn,
.arrow-left,
.arrow-right {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<script>
  // ========== SYSTÈME DE CONSENTEMENT COOKIES INTERNATIONAL ==========
  // SYNCHRONISÉ avec la page de management
  
  const COOKIE_CONSENT_KEY = 'cookieConsent';
  const CONSENT_VERSION = '1.0';
  
  function blockNonEssentialCookies() {
    window['ga-disable-G-418ZTJHNX6'] = true;
    if (window.fbq) window.fbq = function() {};
  }
  
  function hasValidConsent() {
    const stored = localStorage.getItem(COOKIE_CONSENT_KEY);
    if (!stored) return false;
    
    try {
      const data = JSON.parse(stored);
      return data.version === CONSENT_VERSION && data.timestamp && data.preferences;
    } catch {
      return false;
    }
  }
  
  function showCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    if (banner) {
      banner.classList.remove('cookie-banner-hidden');
      banner.classList.add('cookie-banner-visible');
    }
  }
  
  function hideCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    if (banner) {
      banner.style.animation = 'slideDown 0.3s ease-out forwards';
      setTimeout(() => {
        banner.classList.remove('cookie-banner-visible');
        banner.classList.add('cookie-banner-hidden');
        banner.style.animation = '';
      }, 300);
    }
  }
  
  function saveConsent(preferences) {
    const consentData = {
      version: CONSENT_VERSION,
      timestamp: new Date().toISOString(),
      preferences: preferences
    };
    
    localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify(consentData));
    enableServices(preferences);
    
    window.dispatchEvent(new CustomEvent('cookieConsentUpdated', { 
      detail: preferences 
    }));
    
    console.log('✅ Consentement sauvegardé:', preferences);
  }
  
  function enableServices(preferences) {
    if (preferences.performance) {
      window['ga-disable-G-418ZTJHNX6'] = false;
      
      if (typeof gtag === 'function') {
        gtag('consent', 'update', {
          'analytics_storage': 'granted'
        });
      }
    }
    
    if (preferences.marketing) {
      if (typeof gtag === 'function') {
        gtag('consent', 'update', {
          'ad_storage': 'granted'
        });
      }
    }
  }
  
  function cookieBannerAcceptAll() {
    saveConsent({
      strictly_necessary: true,
      performance: true,
      functionality: true,
      marketing: true
    });
    hideCookieBanner();
  }
  
  function cookieBannerRejectAll() {
    saveConsent({
      strictly_necessary: true,
      performance: false,
      functionality: false,
      marketing: false
    });
    hideCookieBanner();
  }
  
  // Animation de fermeture
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideDown {
      to {
        transform: translateY(100%);
        opacity: 0;
      }
    }
  `;
  document.head.appendChild(style);
  
  // Écoute les changements depuis n'importe où (banner ou page management)
  window.addEventListener('cookieConsentUpdated', function(event) {
    console.log('🔄 Consentement mis à jour:', event.detail);
    hideCookieBanner();
    console.log('✅ Banner fermé automatiquement');
  });
  
  // Escape key to reject cookies
  document.addEventListener('keydown', function(e) {
    const banner = document.getElementById('cookieBanner');
    if (e.key === 'Escape' && banner && banner.classList.contains('cookie-banner-visible')) {
      e.preventDefault();
      cookieBannerRejectAll();
    }
  });

  // Initialisation
  document.addEventListener('DOMContentLoaded', function() {
    blockNonEssentialCookies();

    if (!hasValidConsent()) {
      showCookieBanner();
    } else {
      const stored = JSON.parse(localStorage.getItem(COOKIE_CONSENT_KEY));
      enableServices(stored.preferences);
      console.log('✅ Consentement existant chargé:', stored.preferences);
    }
  });
  
  // Révocation - permet de revenir au banner
  window.revokeCookieConsent = function() {
    localStorage.removeItem(COOKIE_CONSENT_KEY);
    location.reload();
  };
</script>