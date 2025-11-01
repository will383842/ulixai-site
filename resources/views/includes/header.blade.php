<!DOCTYPE html>
<html lang="en">
<head>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
<!-- End Google Tag Manager -->
<!-- Google Analytics - BLOQUÉ PAR DÉFAUT (RGPD) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-418ZTJHNX6"></script>
<script>
  // ⚠️ BLOQUER Google Analytics par défaut (conforme RGPD)
  window['ga-disable-G-418ZTJHNX6'] = true;
  
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  
  // Mode "denied" par défaut
  gtag('consent', 'default', {
    'analytics_storage': 'denied',
    'ad_storage': 'denied'
  });
  
  gtag('config', 'G-418ZTJHNX6');
</script>
<!-- End Google Analytics -->
  <!-- CDN (Free version) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<link rel="stlesheet" href="css/styles.css">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- International Telephone Input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <!-- Google Translate widget script -->
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.3s ease-out',
            'slide-down': 'slideDown 0.3s ease-out',
            'bounce-subtle': 'bounceSubtle 0.6s ease-out',
            'glow': 'glow 2s ease-in-out infinite alternate',
            'slideUp': 'slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1)',
            'fadeIn': 'fadeIn 0.3s ease-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(-10px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            slideDown: {
              '0%': { opacity: '0', transform: 'translateY(-20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(100%)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            bounceSubtle: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-5px)' }
            },
            glow: {
              '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
              '100%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8)' }
            }
          }
        }
      }
    }
  </script>
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

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   🎨 UX 2025/2026 MOBILE MENU - CSS MODERNE
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

/* GPU Acceleration pour performances */
#mobile-menu {
  will-change: transform, opacity;
  transform: translateZ(0);
  backface-visibility: hidden;
}

/* Smooth transitions */
#mobile-menu a {
  transition: all 0.2s ease;
}

#mobile-menu a:hover {
  transform: translateX(4px);
  background-color: rgba(59, 130, 246, 0.05);
}

/* Boutons avec effects */
.nav-button {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.nav-button:active {
  transform: translateY(0);
}

/* Language selector moderne */
#languageMenu li {
  transition: background-color 0.2s ease;
}

#languageMenu li:hover {
  background-color: rgba(59, 130, 246, 0.08);
}

/* Hamburger animation */
#menu-toggle-top,
#menu-toggle {
  transition: transform 0.2s ease;
}

#menu-toggle-top:active,
#menu-toggle:active {
  transform: scale(0.95);
}

/* Responsive touch targets */
@media (max-width: 768px) {
  button, a {
    min-height: 44px;
    min-width: 44px;
  }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   🍔 HAMBURGER → X ANIMATION (ULTRA VISIBLE)
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.hamburger-line {
  transform-origin: center;
}

#menu-toggle-top.menu-active .hamburger-line:nth-child(1) {
  transform: translateY(8px) rotate(45deg);
  background-color: #1f2937;
}

#menu-toggle-top.menu-active .hamburger-line:nth-child(2) {
  opacity: 0;
  transform: scaleX(0);
}

#menu-toggle-top.menu-active .hamburger-line:nth-child(3) {
  transform: translateY(-8px) rotate(-45deg);
  background-color: #1f2937;
}

/* Effet hover amélioré */
#menu-toggle-top:hover .hamburger-line {
  background-color: #2563eb;
}

#menu-toggle-top.menu-active:hover .hamburger-line {
  background-color: #dc2626;
}
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   ⚡ ULTRA PERFORMANCE OPTIMIZATIONS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

/* Remplacement de "transition: all" par propriétés spécifiques */
#mobile-menu a {
  transition: transform 0.2s ease, background-color 0.2s ease;
}

.nav-button {
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#languageMenu li {
  transition: background-color 0.2s ease;
}

#menu-toggle-top,
#menu-toggle {
  transition: transform 0.2s ease, background-color 0.2s ease;
}

/* will-change dynamique géré par JS - pas ici */
#mobile-menu.menu-animating {
  will-change: transform, opacity;
}

/* Containment pour isolation */
#mobile-menu {
  contain: layout style paint;
}

/* Content visibility pour lazy rendering */
#mobile-menu:not(.menu-open) {
  content-visibility: hidden;
}

/* Réduire les repaints */
.nav-button,
#mobile-menu a,
#languageMenu li {
  contain: layout style;
}

/* GPU layers optimisés */
.hamburger-line {
  will-change: transform, opacity;
}

#mobileMenuCloseBtn svg {
  will-change: transform;
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

<!-- International Telephone Input Custom Styles -->
<style>
/* Custom styling for intl-tel-input to match the design */
.iti {
  width: 100%;
  position: relative;
}

.iti__flag-container {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 0 8px;
  display: flex;
  align-items: center;
  z-index: 1;
}

.iti__selected-flag {
  padding: 0 6px 0 8px;
  background: transparent;
  border-radius: 3px 0 0 3px;
  cursor: pointer;
  display: flex;
  align-items: center;
  transition: background-color 0.2s;
}

.iti__selected-flag:hover {
  background-color: rgba(59, 130, 246, 0.1);
}

.iti__arrow {
  margin-left: 6px;
  width: 0;
  height: 0;
  border-left: 3px solid transparent;
  border-right: 3px solid transparent;
  border-top: 4px solid #666;
  transition: border-top-color 0.2s;
}

.iti__selected-flag:hover .iti__arrow {
  border-top-color: #333;
}

.iti__country-list {
  position: absolute;
  z-index: 1000;
  background: white;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  max-height: 200px;
  overflow-y: auto;
  width: 320px;
  top: 100%;
  left: 0;
  margin-top: 4px;
}

.iti__country {
  padding: 10px 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  transition: background-color 0.2s;
  border-radius: 4px;
  margin: 2px 4px;
}

.iti__country:hover {
  background-color: #f3f4f6;
}

.iti__country.iti__highlight {
  background-color: #eff6ff;
}

.iti__flag {
  margin-right: 8px;
  width: 20px;
  height: 15px;
  background-size: cover;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.iti__country-name {
  flex: 1;
  font-size: 14px;
  color: #374151;
}

.iti__dial-code {
  color: #6b7280;
  font-size: 13px;
  font-weight: 500;
}

/* Input field styling */
.iti input[type="tel"] {
  padding-left: 80px !important;
  border-radius: 9999px !important;
  border: 1px solid #d1d5db !important;
  transition: all 0.2s ease;
}

.iti input[type="tel"]:focus {
  outline: none !important;
  ring: 2px !important;
  ring-color: #3b82f6 !important;
  border-color: #3b82f6 !important;
}

.iti input[type="tel"].border-red-500 {
  border-color: #ef4444 !important;
}

.iti input[type="tel"].border-green-500 {
  border-color: #10b981 !important;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .iti__country-list {
    width: 280px;
  }

  .iti input[type="tel"] {
    padding-left: 70px !important;
  }
}
</style>

<style>
/* ============================================
   🎯 MOBILE-FIRST POPUP 2025/2026
   ============================================ */

/* Smooth scrolling */
#popupContentArea {
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}

/* Custom scrollbar for desktop */
@media (min-width: 640px) {
  #popupContentArea::-webkit-scrollbar {
    width: 8px;
  }
  
  #popupContentArea::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
  }
  
  #popupContentArea::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
  }
  
  #popupContentArea::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }
}

/* Backdrop blur effect for mobile header */
@supports (backdrop-filter: blur(12px)) {
  @media (max-width: 639px) {
    .backdrop-blur-sm {
      backdrop-filter: blur(12px);
    }
  }
}

/* Animation shake for validation errors */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-10px); }
  75% { transform: translateX(10px); }
}

.shake {
  animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97);
}

/* ============================================
   🎨 NAVIGATION BUTTONS 2025 - ENHANCED
   ============================================ */

/* Mobile: Fixed Bottom Navigation */
@media (max-width: 639px) {
  #mobileNavButtons {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
    padding: 12px; /* 🆕 Réduit de 16px à 12px */
    display: flex;
    gap: 12px;
    box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
    z-index: 60;
    backdrop-filter: blur(8px);
  }
  
  #mobileNavButtons button {
    flex: 1;
    height: 48px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
  
  #mobileNavButtons .btn-back {
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
    flex: 0.8;
  }
  
  #mobileNavButtons .btn-back:active {
    background: #f8fafc;
    transform: scale(0.98);
  }
  
  #mobileNavButtons .btn-next {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
  }
  
  #mobileNavButtons .btn-next:active {
    transform: scale(0.98);
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
  }
  
  #mobileNavButtons .btn-next:disabled {
    background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%);
    box-shadow: none;
    opacity: 0.6;
  }
}

/* Desktop: In-Flow Navigation */
@media (min-width: 640px) {
  #desktopNavButtons {
    position: sticky;
    bottom: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-top: 16px; /* 🆕 Réduit de 32px à 16px */
    padding: 12px 0; /* 🆕 Réduit de 24px à 12px */
    background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
    backdrop-filter: blur(8px);
    border-top: 1px solid #e5e7eb;
    z-index: 60;
  }
  
  #desktopNavButtons button {
    padding: 12px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }
  
  #desktopNavButtons .btn-back {
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
  }
  
  #desktopNavButtons .btn-back:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
  }
  
  #desktopNavButtons .btn-back:active {
    transform: translateY(0);
  }
  
  #desktopNavButtons .btn-next {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
  }
  
  #desktopNavButtons .btn-next:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
  }
  
  #desktopNavButtons .btn-next:active {
    transform: translateY(0);
  }
  
  #desktopNavButtons .btn-next:disabled {
    background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%);
    box-shadow: none;
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
  }
  
  #desktopNavButtons .btn-next:disabled:hover {
    transform: none;
  }
}

/* Icon animations */
.btn-back svg {
  transition: transform 0.3s ease;
}

.btn-back:hover svg {
  transform: translateX(-4px);
}

.btn-next svg {
  transition: transform 0.3s ease;
}

.btn-next:hover svg {
  transform: translateX(4px);
}

/* ============================================
   🎯 AJOUTS: CROIX VISIBLE & BOUTONS GRISÉS
   ============================================ */

.close-popup {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  width: 2.5rem;
  height: 2.5rem;
  background-color: rgba(239, 68, 68, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  z-index: 10;
  border: 2px solid #ef4444;
}

.close-popup:hover {
  background-color: #ef4444;
  transform: scale(1.1);
}

.close-popup svg {
  width: 1.25rem;
  height: 1.25rem;
  color: #ef4444;
  stroke-width: 3;
  transition: color 0.2s ease;
}

.close-popup:hover svg {
  color: white;
}

.btn-disabled {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
  background-color: #e5e7eb !important;
  color: #9ca3af !important;
}

.btn-enabled {
  opacity: 1;
  cursor: pointer;
  transition: all 0.2s ease;
}

@media (max-width: 768px) {
  .close-popup {
    top: 1rem;
    right: 1rem;
    width: 2rem;
    height: 2rem;
  }
  
  .close-popup svg {
    width: 1rem;
    height: 1rem;
  }
}
</style>

{{-- keep these 2 lines somewhere globally once --}}
<style>[x-cloak]{display:none !important}</style>
<script src="https://unpkg.com/alpinejs@3.x.x" defer></script>
<script>
  // Re-apply fixes because Google can re-inject on language change
  (function fixGoogleTranslateGap() {
    function zap() {
      // remove banner iframe if present
      const banner = document.querySelector('iframe.goog-te-banner-frame');
      if (banner && banner.parentNode) banner.parentNode.removeChild(banner);

      // hide wrapper + reset spacing
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

    // run now and a few times after (GT re-applies on change)
    zap();
    let n = 0;
    const id = setInterval(() => {
      zap();
      if (++n > 20) clearInterval(id); // ~4s total
    }, 200);

    // also on resize/orientation changes
    window.addEventListener('resize', zap);
  })();
</script>



<style>
html { scroll-behavior: auto !important; }

.breadcrumb-container {
  background: transparent;
  border-bottom: 1px solid rgba(226, 232, 240, 0.6);
  padding: 12px 0;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 20px;
  font-size: 14px;
}

.breadcrumb-item { 
  display: flex; 
  align-items: center; 
  gap: 6px;
}

.breadcrumb-item svg { 
  width: 15px; 
  height: 15px;
}

.breadcrumb-item a {
  color: #64748b;
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 500;
  transition: all 0.25s ease;
  background: transparent;
}

.breadcrumb-item a:hover { 
  background: rgba(59, 130, 246, 0.08);
  color: #3b82f6;
  transform: translateX(2px);
}

.breadcrumb-item.active { 
  color: #1e293b; 
  font-weight: 600;
  padding: 6px 12px;
  background: rgba(226, 232, 240, 0.4);
  border-radius: 20px;
}

.breadcrumb-separator { 
  color: #cbd5e1; 
  margin: 0 4px;
  font-size: 14px;
}

#scrollToTopBtn {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  background: #3b82f6;
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

#scrollToTopBtn:hover { background: #2563eb; }
#scrollToTopBtn.show { display: flex; }

@media (max-width: 768px) {
  #scrollToTopBtn { display: none !important; }
  .breadcrumb-container { 
    padding: 12px 0;
  }
  .breadcrumb { 
    padding: 0 16px; 
    font-size: 13px;
    gap: 6px;
  }
  .breadcrumb-item svg {
    width: 14px;
    height: 14px;
  }
  .breadcrumb-item a {
    padding: 5px 10px;
  }
  .breadcrumb-item.active {
    padding: 5px 12px;
  }
}
</style>

<script>
if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
window.onload = () => window.scrollTo(0, 0);

let scrollTimer;
window.onscroll = function() {
  clearTimeout(scrollTimer);
  scrollTimer = setTimeout(() => {
    const btn = document.getElementById('scrollToTopBtn');
    if (btn && window.innerWidth > 768) {
      btn.className = window.pageYOffset > 400 ? 'show' : '';
    }
  }, 100);
};

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('scrollToTopBtn')?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
</script>
</head>
@php
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings->legal_info ?? [];
@endphp

@php 
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp
<body class="min-h-screen bg-white">

<!-- 🚀 Bouton Flèche Retour en Haut -->
<button id="scrollToTopBtn" aria-label="Retour en haut">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>
<!-- //For showing toast messages across platform -->
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

<!-- Navbar (keeping original navbar as is) -->
<nav class="top-0 z-50 border-b border-white/20 shadow-xl">
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
<a href="http://sos-expat.com/" 
   target="_blank"
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

<!-- Hidden Google Translate widget -->
<div id="google_translate_element" class="hidden"></div>

  <script type="text/javascript">
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

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,fr,de',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        // Load Google Translate script
        (function() {
            var gt = document.createElement('script');
            gt.type = 'text/javascript';
            gt.async = true;
            gt.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gt, s);
        })();

        // Language selector functionality
        const langBtn = document.getElementById('langBtn');
        const langMenu = document.getElementById('langMenu');
        const langFlag = document.getElementById('langFlag');

        // Toggle dropdown
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            langMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            langMenu.classList.add('hidden');
        });

        // Handle language selection
        langMenu.addEventListener('click', function(e) {
            if (e.target.closest('li')) {
                const li = e.target.closest('li');
                const lang = li.getAttribute('data-lang');
                const flag = li.getAttribute('data-flag');
                setLanguage(lang, flag);
                langMenu.classList.add('hidden');
            }
        });

        function setLanguage(lang, flag) {
            localStorage.setItem('selectedLang', lang);
            localStorage.setItem('selectedFlag', flag);
            langFlag.src = flag;
            alignCookiesFor(lang);
            if (lang === 'en') {
                window.location.hash = '';
            } else {
                window.location.hash = 'googtrans(en|' + lang + ')';
            }
            waitForSelect(select => {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
                setTimeout(() => location.reload(), 100);
            }, 2000);
            setTimeout(() => {
                if (!document.querySelector('#google_translate_element select')) {
                    location.reload();
                }
            }, 2100);
        }

        function waitForSelect(callback, timeout = 5000) {
            const start = Date.now();
            const check = () => {
                const select = document.querySelector('#google_translate_element select.goog-te-combo');
                if (select) {
                    callback(select);
                } else if (Date.now() - start < timeout) {
                    setTimeout(check, 100);
                } else {
                    const savedLang = localStorage.getItem('selectedLang') || 'en';
                    if (savedLang !== 'en') {
                        window.location.hash = 'googtrans(en|' + savedLang + ')';
                    }
                }
            };
            check();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('selectedLang') || 'en';
            const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
            langFlag.src = savedFlag;
            alignCookiesFor(savedLang);
            if (savedLang !== 'en') {
                window.location.hash = 'googtrans(en|' + savedLang + ')';
                waitForSelect(select => {
                    select.value = savedLang;
                    select.dispatchEvent(new Event('change'));
                });
            }
        });
    </script>

 <!-- Auth Buttons -->
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

<!-- ============================================
     🚀 POPUP MODERNISÉ 2025/2026
     ============================================ -->
<div id="signupPopup" class="fixed inset-0 bg-black/50 z-50 hidden flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6">
  
  <!-- CONTAINER RESPONSIVE -->
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] rounded-t-3xl sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col">
    
    <!-- ============================================
         HEADER STICKY MOBILE / NORMAL DESKTOP
         ============================================ -->
    <div class="sticky sm:relative top-0 z-20 bg-white/95 sm:bg-white backdrop-blur-sm sm:backdrop-blur-none border-b-0 px-4 sm:px-8 py-0 flex items-center justify-between gap-4 h-0 overflow-hidden sm:h-auto sm:overflow-visible">
      
      <!-- LEFT: Progress Mobile / Badge Desktop -->
      <div class="flex-1">
        <!-- Mobile: Progress -->
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
      
      <!-- RIGHT: Close Button -->
      <button id="closePopup" 
              class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 text-gray-500 hover:text-gray-800 shrink-0 absolute top-2 right-2" 
              aria-label="Close signup form">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    
    <!-- ============================================
         CONTENT SCROLLABLE AREA
         ============================================ -->
    <div class="flex-1 overflow-y-auto overscroll-contain px-4 sm:px-8 pt-0 pb-20 sm:pb-4" id="popupContentArea">
      
		<!-- Step 1 -->
		@include('includes.provider.choose_step')
    
    <!-- Step 2 -->
    @include('includes.provider.native_language')

    <!-- Step 3 -->
    @include('includes.provider.spoken_language')

    <!-- Step 4 -->
		@include('includes.provider.provider_services')

    <!-- Step 5: Country Selection -->
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

    <div id="step5CountrySuccess" class="hidden bg-green-50 border-l-4 border-green-500 rounded-xl p-3" role="status">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-green-800">Country selected!</p>
          <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
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

<style>
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(20px, -50px) scale(1.1); }
  50% { transform: translate(-20px, 20px) scale(0.9); }
  75% { transform: translate(50px, 50px) scale(1.05); }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
  20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.shake-animation {
  animation: shake 0.5s;
}

#step5 select:focus {
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step5 select {
    border: 3px solid currentColor;
  }
  
  #step5 select:focus {
    border: 3px solid #1d4ed8;
  }
}
</style>

<script>
window.selectedCountry = null;
let cachedElementsStep5 = null;

function getCachedElementsStep5() {
  if (!cachedElementsStep5) {
    cachedElementsStep5 = {
      select: document.getElementById('location-input'),
      errorAlert: document.getElementById('step5CountryError'),
      successAlert: document.getElementById('step5CountrySuccess'),
      selectedCount: document.getElementById('step5SelectedCount')
    };
  }
  return cachedElementsStep5;
}

function updateStep5Buttons() {
  const mobileNextBtn = document.getElementById('mobileNextBtn');
  const desktopNextBtn = document.getElementById('desktopNextBtn');
  
  if (window.selectedCountry) {
    if (mobileNextBtn) mobileNextBtn.disabled = false;
    if (desktopNextBtn) desktopNextBtn.disabled = false;
  } else {
    if (mobileNextBtn) mobileNextBtn.disabled = true;
    if (desktopNextBtn) desktopNextBtn.disabled = true;
  }
}

window.selectCountry = function(country) {
  if (!country) return;
  
  const elements = getCachedElementsStep5();
  window.selectedCountry = country;
  
  if (elements.selectedCount) {
    elements.selectedCount.textContent = '1';
  }
  
  if (elements.successAlert) {
    elements.successAlert.classList.remove('hidden');
  }
  
  if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
    elements.errorAlert.classList.add('hidden');
  }
  
  try {
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    expats.country = country;
    localStorage.setItem('expats', JSON.stringify(expats));
  } catch (e) {
    console.warn('localStorage not available:', e.message);
  }
  
  updateStep5Buttons();
};

window.validateStep5 = function() {
  const elements = getCachedElementsStep5();
  
  if (!window.selectedCountry) {
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    
    if (elements.successAlert) {
      elements.successAlert.classList.add('hidden');
    }
    
    if (elements.select) {
      elements.select.focus();
    }
    
    return false;
  }
  
  return true;
};

document.addEventListener('DOMContentLoaded', function() {
  const elements = getCachedElementsStep5();
  
  if (!elements.select) return;
  
  elements.select.addEventListener('change', function() {
    if (this.value) {
      window.selectCountry(this.value);
    }
  });
  
  const container = document.querySelector('#step5');
  if (container) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
          if (!container.classList.contains('hidden')) {
            updateStep5Buttons();
          }
        }
      });
    });
    
    observer.observe(container, { attributes: true });
  }
  
  updateStep5Buttons();
});
</script>

 		<!-- Step 6 -->
		@include('includes.provider.operational_countries', ['countries' => $countries])
 
    <!-- Step 7: Special Status -->
    @include('includes.provider.special_status')
   
    <!-- Step 8: Speak Online or In Person -->
    @include('includes.provider.communication_preference')

    <!-- Step 9: Profile Description -->
    @include('includes.provider.profile_description')

   <!-- Step 10: Profile Picture -->
		@include('includes.provider.profile_picture')

		<!-- Step 11: Identity Documents -->
		@include('includes.provider.identity_documents')

		<!-- Step 12: First and Last Name -->
		@include('includes.provider.first_last_name')

		<!-- Step 13: Email and Phone Number -->
		@include('includes.provider.email')

		<!-- Step 14: Password Creation -->
		@include('includes.provider.verify_email')

		<!-- Step 15: Phone Number -->
		@include('includes.provider.phone_number')

		<!-- Step 16: Success Confirmation -->
		<div id="step16" class="hidden space-y-6 text-center">
			<h2 class="text-blue-900 font-extrabold text-2xl">YOUR PROVIDER ACCOUNT IS CREATED</h2>
			<p class="text-blue-800 font-semibold text-md">YOU ARE OFFICIALLY A ULYSSE</p>
			<p class="text-gray-600">Go check out the service requests in your area now</p>

			<button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full">
			<a href="{{ route('ongoing-requests') }}"> CURRENT SERVICE REQUESTS </a></button>

			<p class="text-gray-600 text-sm mt-2">You can boost your profile to have more jobs to do</p>

			<button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-6 py-2 rounded-full">
				I BOOST MY PROFILE TO BE AMONG THE FIRST SERVICE PROVIDERS
			</button>
		</div>

    </div>
    
    <!-- ============================================
         NAVIGATION BUTTONS
         Mobile: Fixed Bottom
         Desktop: In Flow
         ============================================ -->
    
    <!-- MOBILE NAVIGATION (Fixed Bottom) -->
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
    
    <!-- DESKTOP NAVIGATION (In Flow) -->
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

	<!-- 🎨 Mobile Header - HTML5 Semantic -->
	<header class="lg:hidden fixed top-0 left-0 w-full bg-white z-50 shadow-md" role="banner">
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

				<a href="http://sos-expat.com/" 
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


<!-- 🎨 Mobile Menu - HTML5 Semantic with ARIA -->
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

<div id="google_translate_element" class="hidden"></div>
<div id="google_translate_element" class="hidden"></div>

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

<script>
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
      { pageLanguage: 'en', includedLanguages: 'en,fr,de', autoDisplay: false },
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

  <a href="http://sos-expat.com/" target="_blank"  class="block w-full text-center bg-red-600 text-white font-semibold py-2 rounded-full shadow hover:bg-red-700 transition">
    <i class="fas fa-phone-alt mr-1"></i> S.O.S
  </a>
</div>

@include('pages.popup')
</nav>

<!-- 🍞 Fil d'Ariane -->
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

<script>
function showComingSoonPopup(e) {
  e.preventDefault();
  document.getElementById('sos-popup').classList.remove('hidden');
}
function closeComingSoonPopup() {
  document.getElementById('sos-popup').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
  const popup = document.getElementById('signupPopup');
  const closePopupBtn = document.getElementById('closePopup');
  const signupBtn = document.getElementById('signupBtn');

  const steps = Array.from({ length: 16 }, (_, i) => document.getElementById('step' + (i + 1)));
  let currentStep = 0;

  // ============================================
  // 🎯 UNIFIED NAVIGATION SYSTEM
  // ============================================
  
  function updateProgress() {
    const progress = ((currentStep + 1) / steps.length) * 100;
    const stepNum = currentStep + 1;
    
    // Update mobile progress
    const mobileBar = document.getElementById('mobileProgressBar');
    const mobileStepNum = document.getElementById('currentStepNum');
    const mobilePercentage = document.getElementById('progressPercentage');
    
    if (mobileBar) mobileBar.style.width = progress + '%';
    if (mobileStepNum) mobileStepNum.textContent = stepNum;
    if (mobilePercentage) mobilePercentage.textContent = Math.round(progress);
    
    // Update buttons visibility
    updateNavigationButtons();
  }
  
  function updateNavigationButtons() {
    const isValid = validateStep(currentStep);
    const isStep1 = currentStep === 0;
    
    const mobileNavButtons = document.getElementById('mobileNavButtons');
    const desktopNavButtons = document.getElementById('desktopNavButtons');
    const mobileBackBtn = document.getElementById('mobileBackBtn');
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopBackBtn = document.getElementById('desktopBackBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    
    // Sur Step 1 : Masquer complètement les containers
    if (isStep1) {
      if (mobileNavButtons) mobileNavButtons.style.display = 'none';
      if (desktopNavButtons) desktopNavButtons.style.display = 'none';
      return;
    }
    
    // Sur Step 2+ : Afficher les containers
    if (mobileNavButtons) mobileNavButtons.style.display = '';
    if (desktopNavButtons) desktopNavButtons.style.display = '';
    
    // Masquer le bouton Back uniquement sur Step 1
    if (mobileBackBtn) mobileBackBtn.style.display = isStep1 ? 'none' : 'flex';
    if (desktopBackBtn) desktopBackBtn.style.display = isStep1 ? 'none' : 'inline-flex';
    
    // Gérer l'état disabled des boutons Continue
    if (mobileNextBtn) mobileNextBtn.disabled = !isValid;
    if (desktopNextBtn) desktopNextBtn.disabled = !isValid;
  }
  
  // ============================================
  // 🎯 UPDATE HEADER BUTTONS (pour Step 4)
  // ============================================
  function updateHeaderButtons() {
    const mobileNextBtn = document.getElementById('mobileNextBtn');
    const desktopNextBtn = document.getElementById('desktopNextBtn');
    const mobileBackBtn = document.getElementById('mobileBackBtn');
    const desktopBackBtn = document.getElementById('desktopBackBtn');
    
    const isLastStep = currentStep === steps.length - 1;
    
    // Default Back button text for all steps
    if (mobileBackBtn) {
      const span = mobileBackBtn.querySelector('span');
      if (span) span.textContent = 'Back';
    }
    if (desktopBackBtn) {
      const span = desktopBackBtn.querySelector('span');
      if (span) span.textContent = 'Back';
    }
    
    // Step 4 logic
    if (currentStep === 3) {
      const hasServices = window.selectedServices && 
                         Object.keys(window.selectedServices).length > 0;
      
      // Vérifier si des services ont des sous-catégories disponibles
      const servicesWithSubcats = window.servicesData?.filter(s => 
        window.selectedServices[s.serviceId] && 
        s.subcategories && 
        s.subcategories.length > 0
      ) || [];
      
      // Vérifier si toutes les sous-catégories sont sélectionnées
      const allSubcatsSelected = servicesWithSubcats.every(service => 
        window.selectedSubcategories && 
        window.selectedSubcategories[service.serviceId] && 
        window.selectedSubcategories[service.serviceId].length > 0
      );
      
      let buttonText = 'Continue';
      
      // Si des services avec sous-catégories existent et ne sont pas tous complétés
      if (hasServices && servicesWithSubcats.length > 0 && !allSubcatsSelected) {
        buttonText = 'Choose Sub categories';
      }
      
      if (mobileNextBtn) {
        const span = mobileNextBtn.querySelector('span');
        if (span) span.textContent = buttonText;
      }
      
      if (desktopNextBtn) {
        const span = desktopNextBtn.querySelector('span');
        if (span) span.textContent = buttonText;
      }
      return;
    }
    
    // All other steps - default behavior
    const defaultText = isLastStep ? 'Finish' : 'Continue';
    
    if (mobileNextBtn) {
      const span = mobileNextBtn.querySelector('span');
      if (span) span.textContent = defaultText;
    }
    
    if (desktopNextBtn) {
      const span = desktopNextBtn.querySelector('span');
      if (span) span.textContent = defaultText;
    }
  }

  function showStep(stepIndex) {
    if (stepIndex === 11 && document.querySelector('.user-menu')) { 
      currentStep = 12;
      stepIndex = 12;
    }

    steps.forEach((step, i) => step?.classList.toggle('hidden', i !== stepIndex));
    currentStep = stepIndex;
    updateProgress();
    updateHeaderButtons();
    
    // 🆕 IMPORTANT : Appeler updateNavigationButtons pour gérer Step 1
    updateNavigationButtons();
    
    // Scroll to top of content area
    const contentArea = document.getElementById('popupContentArea');
    if (contentArea) {
      contentArea.scrollTop = 0;
    }
  }
  
  // Expose showStep globally for Step 4 modal
  window.showStep = showStep;
  window.updateHeaderButtons = updateHeaderButtons;
  window.updateNavigationButtons = updateNavigationButtons;

  function validateStep(index) {
    // ============================================
    // 🚀 SYSTÈME MODERNE AVEC FALLBACK SÉCURISÉ
    // ============================================
    
    switch(index) {
      case 1:
        // Step 2: Native Language
        if (typeof window.validateStep2 === 'function') {
          return window.validateStep2();
        }
        return !!document.querySelector('#step2 .language-card.selected');
        
      case 2:
        // Step 3: Spoken Languages
        if (typeof window.validateStep3 === 'function') {
          return window.validateStep3();
        }
        return document.querySelectorAll('#step3 .lang-btn.selected').length > 0;
        
      case 3:
        // Step 4: Provider Services
        if (typeof window.validateStep4 === 'function') {
          const result = window.validateStep4();
          // Pour le bouton disabled, on considère 'show_subcategories' comme valide
          return result === true || result === 'show_subcategories';
        }
        return document.querySelectorAll('#step4 .service-card.selected').length > 0;
        
      case 4:
        // Step 5: Country
        if (typeof window.validateStep5 === 'function') {
          return window.validateStep5();
        }
        return document.getElementById('location-input')?.value.trim().length > 0;
        
      case 5:
        // Step 6: Operational Countries
        if (typeof window.validateStep6 === 'function') {
          return window.validateStep6();
        }
        return document.querySelectorAll('#countryList input[type="checkbox"]:checked').length >= 1;
        
      case 6:
        // Step 7: Special Status
        if (typeof window.validateStep7 === 'function') {
          return window.validateStep7();
        }
        return Array.from(document.querySelectorAll('#step7 .special-status-item'));
        
      case 7:
        // Step 8: Communication Preference
        if (typeof window.validateStep8 === 'function') {
          return window.validateStep8();
        }
        return Array.from(document.querySelectorAll('#step8 .speak-toggle')).every(group =>
          group.querySelector('.bg-green-500')
        );
        
      case 8:
        // Step 9: Profile Description
        if (typeof window.validateStep9 === 'function') {
          return window.validateStep9();
        }
        return document.getElementById('profileDescription')?.value.trim().length > 0;
        
      case 9:
        // Step 10: Profile Picture
        if (typeof window.validateStep10 === 'function') {
          return window.validateStep10();
        }
        return document.getElementById('profileUpload')?.files.length > 0;
        
      case 11:
        // Step 12: First/Last Name
        if (typeof window.validateStep12 === 'function') {
          return window.validateStep12();
        }
        return document.getElementById('first_name_input')?.value.trim().length > 0;
        
      case 12:
        // Step 13: Email
        if (typeof window.validateStep13 === 'function') {
          return window.validateStep13();
        }
        return document.getElementById('email_input')?.value.trim().length > 0;
        
      case 13:
        // Step 14: Phone Number
        if (typeof window.validateStep14 === 'function') {
          return window.validateStep14();
        }
        const phoneInput = document.getElementById('phone_number_input');
        if (phoneInput && phoneInput.iti) {
          return phoneInput.iti.isValidNumber();
        }
        return phoneInput && phoneInput.value.trim().length > 0;
          
      case 14:
        // Step 15: OTP Verification
        if (typeof window.validateStep15 === 'function') {
          return window.validateStep15();
        }
        return document.getElementById('otp_input')?.value.trim().length > 0;
        
      default:
        return true;
    }
  }

  // ============================================
  // 🎯 NAVIGATION HANDLERS
  // ============================================
  
  function handleNext() {
    if (!validateStep(currentStep)) {
      return;
    }
    
    // Special handling for Step 4
    if (currentStep === 3 && typeof window.validateStep4 === 'function') {
      const result = window.validateStep4();
      if (result === 'show_subcategories') {
        // Ouvrir le modal des sous-catégories
        if (typeof window.openSubcategoriesModal === 'function') {
          window.openSubcategoriesModal();
        }
        return;
      } else if (!result) {
        return;
      }
    }
    
    if (currentStep < steps.length - 1) {
      showStep(currentStep + 1);
    } else {
      // Handle completion (submit form)
    }
  }
  
  function handleBack() {
    if (currentStep > 0) {
      showStep(currentStep - 1);
    }
  }
  
  // Attach handlers to both mobile and desktop buttons
  const mobileNextBtn = document.getElementById('mobileNextBtn');
  const mobileBackBtn = document.getElementById('mobileBackBtn');
  const desktopNextBtn = document.getElementById('desktopNextBtn');
  const desktopBackBtn = document.getElementById('desktopBackBtn');
  
  if (mobileNextBtn) mobileNextBtn.addEventListener('click', handleNext);
  if (mobileBackBtn) mobileBackBtn.addEventListener('click', handleBack);
  if (desktopNextBtn) desktopNextBtn.addEventListener('click', handleNext);
  if (desktopBackBtn) desktopBackBtn.addEventListener('click', handleBack);

  signupBtn?.addEventListener('click', () => {
    popup.classList.remove('hidden');
    showStep(0); // 🆕 Commencer au Step 2 (Native Language) au lieu de Step 1
  });

  closePopupBtn?.addEventListener('click', () => {
    popup.classList.add('hidden');
  });

  popup.addEventListener('click', (e) => {
    if (e.target === popup) popup.classList.add('hidden');
  });

  const stepNavigation = [
    ['whiteCardBtn', 1], ['backToStep1', 0], ['nextStep2', 2], ['backToStep2', 1],
    ['nextStep3', 3], ['backToStep3', 2], ['nextStep4', 4], ['backToStep4', 3],
    ['nextStep5', 5], ['backToStep5', 4], ['nextStep6', 6], ['backToStep6', 5],
    ['nextStep7', 7], ['backToStep7', 6], ['nextStep8', 8], ['backToStep8', 7],
    ['nextStep9', 9], ['backToStep9', 8], ['nextStep10', 10], ['backToStep10', 9],
    ['nextStep11', 11], ['backToStep11', 10], ['nextStep12', 12], ['backToStep12', 11],
    ['nextStep13', 13], ['backToStep13', 12], ['nextStep14', 14], ['backToStep14', 13],
    ['nextStep15', 15], ['backToStep15', 14]
  ];

  stepNavigation.forEach(([btnId, stepIndex]) => {
    document.getElementById(btnId)?.addEventListener('click', () => {
      if (stepIndex > currentStep && !validateStep(currentStep)) {
        return;
      }
      showStep(stepIndex);
    });
  });

  // Step 2: Language selection (ancien système - à remplacer par le nouveau fichier step2)
  document.querySelectorAll('#step2 .lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#step2 .lang-btn').forEach(b => {
        b.classList.remove('bg-blue-900', 'text-white');
        b.classList.add('bg-white', 'text-blue-700');
      });
      btn.classList.remove('bg-white', 'text-blue-700');
      btn.classList.add('bg-blue-900', 'text-white');
      const selectedLanguage = btn.textContent.trim();
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.native_language = selectedLanguage;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  });

  // Step 3: Multiple selection (ancien système - à remplacer par le nouveau fichier step3)
  let selectedLanguage = [];

  document.querySelectorAll('#step3 .lang-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const lang = btn.textContent.trim();
      const isSelected = btn.classList.contains('bg-blue-900');

      if (isSelected) {
        btn.classList.remove('bg-blue-900', 'text-white', 'bg-blue-600');
        btn.classList.add('bg-blue-600', 'text-white');
        selectedLanguage = selectedLanguage.filter(item => item !== lang);
      } else {
        btn.classList.remove('bg-white', 'text-blue-700', 'bg-blue-600');
        btn.classList.add('bg-blue-900', 'text-white');
        selectedLanguage.push(lang);
      }

      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.spoken_language = selectedLanguage;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  });

  // Step 4: Help icon toggle
  document.querySelectorAll('#step4 .help-icon').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('ring-4');
      btn.classList.toggle('ring-white');
      btn.classList.toggle('ring-offset-2');
    });
  });

  const location = document.querySelector('#step5 #location-input');
  if (location) {
    location.addEventListener('change', () => {
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.location = location.value;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }

  const countryList = document.querySelector('#step6 #countryList');
  if (countryList) {
    countryList.addEventListener('change', () => {
      const selectedCountries = Array.from(
        countryList.querySelectorAll('input[type="checkbox"]:checked')
      ).map(input => input.value);
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.operational_countries = selectedCountries;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }

  let specialStatus = {};

  document.querySelectorAll('#step7 .status-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      const label = checkbox.dataset.label;
      specialStatus[label] = checkbox.checked;
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.special_status = specialStatus;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  });

  communicationPreference = {};
  document.querySelectorAll('#step8 .speak-toggle').forEach(group => {
    const yesBtn = group.children[0];
    const noBtn = group.children[1];
    [yesBtn, noBtn].forEach(btn => {
      btn.addEventListener('click', () => {
        const label = btn.dataset.label;
        yesBtn.classList.remove('bg-green-500', 'text-white');
        yesBtn.classList.add('bg-white', 'text-green-600');
        noBtn.classList.remove('bg-green-500', 'text-white');
        noBtn.classList.add('bg-white', 'text-green-600');
        btn.classList.remove('bg-white', 'text-green-600');
        btn.classList.add('bg-green-500', 'text-white');
        communicationPreference[label] = btn.textContent === 'Yes' ? 'true' : 'false';
        const expats = JSON.parse(localStorage.getItem('expats') || '{}');
        expats.communication_preference = communicationPreference;
        localStorage.setItem('expats', JSON.stringify(expats));
      });
    });
  });

  const textarea = document.getElementById('profileDescription');
  const charCount = document.getElementById('charCount');
  if (textarea && charCount) {
    textarea.addEventListener('input', () => {
      charCount.textContent = textarea.value.length;
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.profile_description = textarea.value;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }

  const profileUpload = document.getElementById('profileUpload');
  const profilePreview = document.getElementById('profilePreview');
  const profilePlaceholder = document.getElementById('profilePlaceholder');

  if (profileUpload) {
    profileUpload.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          const imageDataUrl = e.target.result;
          profilePreview.src = imageDataUrl;
          profilePreview.classList.remove('hidden');
          profilePlaceholder.classList.add('hidden');
          const expats = JSON.parse(localStorage.getItem('expats') || '{}');
          expats.profile_image = imageDataUrl;
          localStorage.setItem('expats', JSON.stringify(expats));
        };
        reader.readAsDataURL(file);
      }
    });
  }

  const firstNameInput = document.querySelector('#step12 #first_name_input');
  const lastNameInput = document.querySelector('#step12 #last_name_input');
  const nextStep12 = document.getElementById('nextStep12');

  if (nextStep12) {
    nextStep12.addEventListener('click', () => {
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.first_name = firstNameInput.value.trim();
      expats.last_name = lastNameInput.value.trim();
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }

  const emailInput = document.querySelector('#step13 #email_input');
  const nextStep13 = document.getElementById('nextStep13');

  if (nextStep13) {
    nextStep13.addEventListener('click', () => {
      const expats = JSON.parse(localStorage.getItem('expats') || '{}');
      expats.email = emailInput.value.trim();
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }

  const phoneNumberInput = document.querySelector('#step14 #phone_number_input');
  const nextStep14 = document.getElementById('nextStep14');
  if (nextStep14 && phoneNumberInput) {
    nextStep14.addEventListener('click', () => {
      if (phoneNumberInput.iti) {
        const iti = phoneNumberInput.iti;

        if (iti.isValidNumber()) {
          const fullNumber = iti.getNumber();
          const countryData = iti.getSelectedCountryData();

          const expats = JSON.parse(localStorage.getItem('expats') || '{}');
          expats.phone_number = fullNumber;
          expats.phone_country = countryData.name;
          expats.phone_country_code = countryData.dialCode;
          localStorage.setItem('expats', JSON.stringify(expats));
          createProviderAccount();
        } else {
          toastr.error('Please enter a valid phone number');
          return false;
        }
      } else {
        const expats = JSON.parse(localStorage.getItem('expats') || '{}');
        expats.phone_number = phoneNumberInput.value.trim();
        localStorage.setItem('expats', JSON.stringify(expats));
        createProviderAccount();
      }
    });
  }

  function createProviderAccount() {
    const expats = JSON.parse(localStorage.getItem('expats') || '{}');
    const nextBtn = document.getElementById('nextStep14');
    nextBtn.disabled = true;
    nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';

    return fetch('/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify(expats)
    })
    .then(response => {
      if (!response.ok) throw response;
      return response.json();
    })
    .then(data => {
      toastr.success(data.message || 'Account created successfully!');
      document.getElementById('step14').classList.add('hidden');
      document.getElementById('step15').classList.remove('hidden');
    })
    .catch(async error => {
      let errorMessage = 'Failed to create account. Please try again.';
      try {
        const errData = await error.json();
        errorMessage = errData.message || errorMessage;
      } catch (_) {}
      console.error('Error creating account:', errorMessage);
      toastr.error(errorMessage);
    })
    .finally(() => {
      nextBtn.disabled = false;
      nextBtn.innerHTML = 'Next';
    });
  }

  // ============================================
  // 🎨 MOBILE MENU UX 2025/2026 - MODERNE & FLUIDE
  // ============================================
  const toggleButtons = [
    // Plus de menu-toggle, seulement menu-toggle-top
    document.getElementById("menu-toggle-top"),
    null
  ];
  const mobileMenu = document.getElementById("mobile-menu");
  const mobileMenuCloseBtn = document.getElementById("mobileMenuCloseBtn");
  const langToggle = document.getElementById("languageToggle");
  const langMenu = document.getElementById("languageMenu");
  
  let isMenuOpen = false;


  function openMobileMenu() {
    if (!mobileMenu) return;
    isMenuOpen = true;
    
    // Ajouter will-change avant animation
    mobileMenu.classList.add("menu-animating");
    mobileMenu.classList.remove("hidden");
    
    // Animations fluides optimisées
    requestAnimationFrame(() => {
      mobileMenu.style.opacity = '0';
      mobileMenu.style.transform = 'translateY(-10px)';
      requestAnimationFrame(() => {
        mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        mobileMenu.style.opacity = '1';
        mobileMenu.style.transform = 'translateY(0)';
      });
    });
    
    // Animer hamburger en X
    toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.add("menu-active");
        btn.setAttribute('aria-expanded', 'true');
      }
    });
    
    // Retirer will-change après animation
    setTimeout(() => {
      mobileMenu.classList.remove("menu-animating");
    }, 300);
    
    // Haptic feedback
    if (navigator.vibrate) navigator.vibrate(10);
    
    // Accessibilité
    if (mobileMenu) mobileMenu.setAttribute('aria-hidden', 'false');
  }

  function closeMobileMenu() {
    if (!mobileMenu) return;
    isMenuOpen = false;
    
    // Ajouter will-change avant animation
    mobileMenu.classList.add("menu-animating");
    
    mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    mobileMenu.style.opacity = '0';
    mobileMenu.style.transform = 'translateY(-10px)';
    
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
      mobileMenu.classList.remove("menu-animating");
      mobileMenu.style.opacity = '';
      mobileMenu.style.transform = '';
      mobileMenu.style.transition = '';
    }, 300);
    
    // Restaurer hamburger
    toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.remove("menu-active");
        btn.setAttribute('aria-expanded', 'false');
      }
    });
    
    // Haptic feedback
    if (navigator.vibrate) navigator.vibrate(5);
    
    // Accessibilité
    if (mobileMenu) mobileMenu.setAttribute('aria-hidden', 'true');
  }

  function toggleMobileMenu() {
    if (isMenuOpen) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  }

  // Event listeners
  toggleButtons.forEach(btn => {
    if (btn) {
      btn.addEventListener("click", toggleMobileMenu);
      btn.setAttribute('aria-expanded', 'false');
    }
  });

  if (mobileMenuCloseBtn) {
    mobileMenuCloseBtn.addEventListener("click", closeMobileMenu);
  }

  // Fermer en cliquant sur un lien
  if (mobileMenu) {
    const menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => setTimeout(closeMobileMenu, 100));
    });
  }

  // ESC pour fermer
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isMenuOpen) closeMobileMenu();
  });

  // Clic extérieur pour fermer
  document.addEventListener('click', (e) => {
    if (isMenuOpen && mobileMenu && 
        !mobileMenu.contains(e.target) && 
        !toggleButtons.some(btn => btn && btn.contains(e.target))) {
      closeMobileMenu();
    }
  });

  // Language toggle
  if (langToggle && langMenu) {
    langToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      langMenu.classList.toggle("hidden");
    });
  }

  window.addEventListener("click", (e) => {
    if (!e.target.closest("#languageToggle") && langMenu) {
      langMenu.classList.add("hidden");
    }
  });


  // ============================================
  // 🎯 GLOBAL EXPORTS
  // ============================================
  window.showStep = showStep;
  window.nextStep = handleNext;
  window.previousStep = handleBack;
  window.validateStep = validateStep;
  window.updateHeaderButtons = updateHeaderButtons;
  window.updateNavigationButtons = updateNavigationButtons;
  
  // ============================================
  // 🎯 INITIAL STATE - Important pour griser les boutons par défaut
  // ============================================
  updateProgress();
  updateHeaderButtons();
  updateNavigationButtons(); // 🆕 AJOUTÉ pour initialiser correctement Step 1
});
	function openModal() {
		document.getElementById('modal')?.classList.remove('hidden');
	}
	function closeModal() {
		document.getElementById('modal')?.classList.add('hidden');
	}
	function nextStep(stepNumber) {
		document.querySelectorAll('.step-content').forEach(step => step.classList.add('hidden'));
		document.getElementById('step' + stepNumber)?.classList.remove('hidden');
	}
</script>

<script>
  document.addEventListener('keydown', function (e) {
    if (e.key === "Escape") closeSearchPopup();
  });

  document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.getElementById('closeSearchPopupBtn');
    if (closeBtn) {
      closeBtn.addEventListener('click', closeSearchPopup);
    }
  });
</script>

<script>
  document.querySelectorAll(".faq-toggle").forEach((btn) => {
  btn.addEventListener("click", () => {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector(".faq-icon");

    document.querySelectorAll(".faq-content").forEach((item) => {
      if (item !== content) {
        item.classList.add("hidden");
      }
    });

    document.querySelectorAll(".faq-icon").forEach((item) => {
      if (item !== icon) {
        item.textContent = "+";
      }
    });

    content.classList.toggle("hidden");
    icon.textContent = content.classList.contains("hidden") ? "+" : "–";
  });
});
</script>

  <script>
        const faqToggles = document.querySelectorAll('.faq-toggle');

        faqToggles.forEach((toggle, index) => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                const isActive = toggle.classList.contains('active');

                faqToggles.forEach((otherToggle, otherIndex) => {
                    if (otherIndex !== index) {
                        const otherContent = otherToggle.nextElementSibling;
                        otherToggle.classList.remove('active');
                        otherContent.classList.remove('active');
                    }
                });

                if (isActive) {
                    toggle.classList.remove('active');
                    content.classList.remove('active');
                } else {
                    toggle.classList.add('active');
                    content.classList.add('active');
                }
            });
        });
    </script>

     <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slideDown': 'slideDown 0.3s ease-out',
                        'slideUp': 'slideUp 0.3s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '100%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.8)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' },
                            '100%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
<script>
  function toggleExpatPopup() {
    const popup = document.getElementById("expat-popup");
    popup.classList.toggle("hidden");
  }
</script>
<script>
  function toggleCategoryPopup() {
    const popup = document.getElementById("search-category-popup");
    popup.classList.toggle("hidden");
  }
</script>

 <script>
  function goBackToMainCategories() {
    closeAllPopups();
    openHelpPopup();
  }

  function closeAllPopups() {
    const popups = [
      'searchPopup',
      'expatriesPopup',
      'vacanciersPopup',
      'vacanciersPreparationPopup',
      'vacanciersUrgencePopup',
      'vacanciersProblemesVoyagesPopup',
      'expatriesUrgencePopup',
      'expatriesPreparationPopup',
      'expatriesAssurancePopup',
      'expatriesBesoinsPopup',
      'expatriesSantePopup',
      "vacanciersAutresBesoinsPopup",
      'investisseursPopup',
      'investisseurBienImmobilierPopup',
      "Acheter un bien immobilier",
      "investirMarchesFinanciersPopup",
      "investisseurSecuriserInvestissementsPopup",
      "investisseurOptimisationFiscalePopup",
      "investisseurObligationsLegalesPopup",
      "travailleursFreelancesPopup",
      "travailleursCreerEntreprisePopup",
      "travailleursDevelopperReseauPopup",
      "travailleursGestionFinancierePopup",
      "travailleursProtectionSocialePopup",
      "travailleursTrouverEmploiPopup",
      "travailleursVisaAutorisationsPopup",
      "travailleursCreerEntrepriseSubSubcategoriesPopup",
      "travailleursDevelopperReseauSubSubcategoriesPopup",
      "travailleursGestionFinanciereSubSubcategoriesPopup",
      "travailleursProtectionSocialeSubSubcategoriesPopup",
      "travailleursTrouverEmploiSubSubcategoriesPopup",
      "travailleursVisaAutorisationsSubSubcategoriesPopup"
    ];
    popups.forEach(id => {
      const el = document.getElementById(id);
      if (el) el.classList.add('hidden');
    });
    localStorage.removeItem('create-request');
  }

// ============================================
// 🎯 FONCTION POUR GÉRER BOUTONS GRISÉS
// ============================================
// À utiliser dans tes fichiers steps pour activer/désactiver les boutons

function enableButtonIfValid(buttonId, conditionMet) {
  const button = document.getElementById(buttonId);
  if (!button) return;
  
  if (conditionMet) {
    button.disabled = false;
    button.classList.remove('btn-disabled');
    button.classList.add('btn-enabled');
  } else {
    button.disabled = true;
    button.classList.add('btn-disabled');
    button.classList.remove('btn-enabled');
  }
}

/* EXEMPLE D'UTILISATION:
   Dans ton fichier step, tu peux faire:
   
   // Vérifier si le formulaire est valide
   const formIsValid = email.value && phone.value;
   
   // Activer/désactiver le bouton selon la condition
   enableButtonIfValid('nextStepBtn', formIsValid);
*/


  document.addEventListener('click', function(event) {
    const popups = [
      document.getElementById('searchPopup'),
      document.getElementById('expatriesPopup'),
      document.getElementById('vacanciersPopup')
    ];
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');

    const isAnyPopupVisible = popups.some(popup => popup && !popup.classList.contains('hidden'));
    if (isAnyPopupVisible) {
      const clickedInsidePopup = popups.some(popup => popup && popup.contains(event.target));
      if (!clickedInsidePopup && !searchInput.contains(event.target) && !searchButton.contains(event.target)) {
        closeAllPopups();
      }
    }
  });
</script>

<script>
function openHelpPopup() {
  document.getElementById('searchPopup')?.classList.remove('hidden');
  fetch('/api/categories')
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const category = document.querySelector('#searchPopup .main-categories');
        category.innerHTML = '';

        data.categories.forEach(cat => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";

          const color =
            typeof cat.bg_color === 'string' && cat.bg_color.trim() !== ''
              ? cat.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          const iconHtml = cat.icon_image
            ? `
              <div class="w-12 h-12 rounded-full overflow-hidden mb-2 group-hover:scale-110 transition-transform bg-gray-100">
                <img src="/${cat.icon_image}" alt="${cat.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <h3 class="text-sm font-semibold  text-gray-800">${cat.name}</h3>
          `;

          div.addEventListener('click', () =>
            handleCategoryClick(cat.id, cat.name)
          );
          category.appendChild(div);
        });
      }
    })
    .catch(err => console.error('Failed to load categories:', err));
}

 function handleCategoryClick(categoryId, categoryName) {
  document.getElementById('searchPopup')?.classList.add('hidden');
  document.getElementById('expatriesPopup')?.classList.remove('hidden');

  const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
  createRequest.category = JSON.stringify({
    id: categoryId,
    name: categoryName
  });
  localStorage.setItem('create-request', JSON.stringify(createRequest));

  fetch(`/api/categories/${categoryId}/subcategories`)
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const subcategory = document.querySelector('#expatriesPopup .sub-category');
        subcategory.innerHTML = '';

        data.subcategories.forEach(sub => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          const color =
            typeof sub.bg_color === 'string' && sub.bg_color.trim() !== ''
              ? sub.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          const iconHtml = sub.icon_image
            ? `
              <div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">
                <img src="${sub.icon_image}" alt="${sub.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden flex-none shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <div class="flex-grow font-semibold  text-gray-800">${sub.name}</div>
            <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </div>
          `;

          div.addEventListener('click', () => handleSubcategoryClick(sub.id, sub.name));
          subcategory.appendChild(div);
        });

        document.getElementById('expatriesPopup')?.classList.remove('hidden');
      }
    })
    .catch(err => {
      console.error('Error fetching subcategories:', err);
    });
}

function handleSubcategoryClick(parentId, categoryName) {
  const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};

  createRequest.sub_category = JSON.stringify({
    id: parentId,
    name: categoryName
  });

  localStorage.setItem('create-request', JSON.stringify(createRequest));

  fetch(`/api/categories/${parentId}/children`)
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const grid = document.querySelector('#vacanciersAutresBesoinsPopup .child-categories');
        grid.innerHTML = '';

        data.subcategories.forEach(child => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          const color =
            typeof child.bg_color === 'string' && child.bg_color.trim() !== ''
              ? child.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          const iconHtml = child.icon_image
            ? `
              <div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">
                <img src="${child.icon_image}" alt="${child.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden flex-none shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <div class="flex-grow font-semibold text-gray-800">${child.name}</div>
            <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </div>
          `;

          div.addEventListener('click', () => requestForHelp(child.id, child.name));
          grid.appendChild(div);
        });

        document.getElementById('vacanciersAutresBesoinsPopup')?.classList.remove('hidden');
      }
    })
    .catch(err => {
      console.error('Error loading child categories:', err);
    });
}

  function requestForHelp(childId, childName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({
      id: childId,
      name: childName
    });

    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  }

  function extractFirstName(fullName) {
    const cleanName = fullName.replace(/[^\w\s]/g, '').trim();
    const nameParts = cleanName.split(/\s+/);
    return nameParts[0] || cleanName;
  }

  function updateUserDisplayNames() {
    const headerUserName = document.getElementById('header-user-name');
    if (headerUserName) {
      const fullName = headerUserName.textContent.trim();
      headerUserName.textContent = extractFirstName(fullName);
    }

    const headerUserFullname = document.getElementById('header-user-fullname');
    if (headerUserFullname) {
      const fullName = headerUserFullname.textContent.trim();
      headerUserFullname.textContent = extractFirstName(fullName);
    }

    const sidebarGreeting = document.getElementById('user-greeting');
    if (sidebarGreeting) {
      const fullGreeting = sidebarGreeting.textContent.trim();
      const firstName = extractFirstName(fullGreeting);
      sidebarGreeting.textContent = firstName + '!';
    }
  }

  function closeSearchPopup() {
    document.getElementById('searchPopup')?.classList.add('hidden');
  }

  function goBackToVacanciersSubcategories() {
    document.getElementById('vacanciersAutresBesoinsPopup')?.classList.add('hidden');
    document.getElementById('expatriesPopup')?.classList.remove('hidden');
  }

  document.addEventListener('DOMContentLoaded', function() {
    updateUserDisplayNames();
  });

</script>

<script>
function updateHeaderAfterLogin(userData) {
  const authButtons = document.querySelector('.auth-buttons');
  const userMenu = document.createElement('div');
  
  userMenu.innerHTML = `
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
          style="background-image: url('${userData.avatar || '/images/helpexpat.png'}');">
        </div>
        <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">
          ${userData.name}
        </span>
        <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
      </button>
    </div>
  `;
  
  if (authButtons) {
    authButtons.replaceWith(userMenu);
  }
}
</script>

@include('includes.cookie-banner')
</body>
</html>