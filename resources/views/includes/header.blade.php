<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- SEO basics injected -->
  @php $canonical = url()->current(); @endphp
  <link rel="canonical" href="{{ $canonical }}" />
  <meta name="robots" content="{{ isset($noindex) && $noindex ? 'noindex,nofollow' : 'index,follow' }}">

  <!-- Performance hints -->
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
  <link rel="dns-prefetch" href="https://code.jquery.com">
  <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">

  <!-- PWA / Mobile -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="format-detection" content="telephone=no">
  <meta name="theme-color" content="#ffffff">

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

  <!-- ═══════════════════════════════════════════════════════════
       📦 EXTERNAL RESOURCES - CDN
       ═══════════════════════════════════════════════════════════ -->
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Custom Styles - Laravel Asset -->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  <!-- Toastr Notifications -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- International Telephone Input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  <!-- Google Translate Widget -->
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- Tailwind CSS CDN (Development Only) -->
  <script src="https://cdn.tailwindcss.com"></script>


  <!-- ═══════════════════════════════════════════════════════════
       ⚙️ TAILWIND CONFIGURATION
       ═══════════════════════════════════════════════════════════ -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.3s ease-out',
            'slide-down': 'slideDown 0.3s ease-out',
            'slide-up': 'slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1)',
            'bounce-subtle': 'bounceSubtle 0.6s ease-out',
            'glow': 'glow 2s ease-in-out infinite alternate',
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

  <!-- ═══════════════════════════════════════════════════════════
       🎨 GLOBAL STYLES
       ═══════════════════════════════════════════════════════════ -->
  <style>
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       🌐 GOOGLE TRANSLATE - HIDE UI ELEMENTS
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    /* Hide top banner frame */
    iframe.goog-te-banner-frame,
    .goog-te-banner-frame {
      display: none !important;
    }

    /* Hide skiptranslate wrapper */
    body > .skiptranslate {
      display: none !important;
      height: 0 !important;
      overflow: hidden !important;
    }

    /* Reset Google's margin adjustments */
    html {
      margin-top: 0 !important;
    }

    body {
      top: 0 !important;
      position: static !important;
    }

    /* Hide inline toolbar and popup */
    .goog-te-gadget,
    #goog-gt-tt,
    .goog-te-balloon-frame {
      height: 0 !important;
      overflow: hidden !important;
      display: none !important;
      visibility: hidden !important;
      opacity: 0 !important;
    }

    /* Hide all Google Translate UI elements */
    .VIpgJd-ZVi9od-ORHb,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
    .VIpgJd-ZVi9od-ORHb-OEVmcd,
    .VIpgJd-ZVi9od-ORHb-hFsbo,
    .VIpgJd-ZVi9od-l4eHX-hSRGPd {
      display: none !important;
      visibility: hidden !important;
      opacity: 0 !important;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       📱 MOBILE MENU - MODERN UX 2025/2026
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    /* GPU Acceleration for performance */
    #mobile-menu {
      will-change: transform, opacity;
      transform: translateZ(0);
      backface-visibility: hidden;
    }

    /* Smooth transitions for links */
    #mobile-menu a {
      transition: transform 0.2s ease, background-color 0.2s ease;
    }

    #mobile-menu a:hover {
      transform: translateX(4px);
      background-color: rgba(59, 130, 246, 0.05);
    }

    /* Navigation buttons with effects */
    .nav-button {
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                  box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .nav-button:active {
      transform: translateY(0);
    }

    /* Language selector modern styles */
    #languageMenu li {
      transition: background-color 0.2s ease;
    }

    #languageMenu li:hover {
      background-color: rgba(59, 130, 246, 0.08);
    }

    /* Hamburger menu animation */
    #menu-toggle-top,
    #menu-toggle {
      transition: transform 0.2s ease, background-color 0.2s ease;
    }

    #menu-toggle-top:active,
    #menu-toggle:active {
      transform: scale(0.95);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       🍔 HAMBURGER → X ANIMATION (ULTRA VISIBLE)
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    .hamburger-line {
      transform-origin: center;
      transition: transform 0.3s ease, opacity 0.3s ease, background-color 0.3s ease;
    }

    /* Active state - Transform to X */
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

    /* Hover effects */
    #menu-toggle-top:hover .hamburger-line {
      background-color: #2563eb;
    }

    #menu-toggle-top.menu-active:hover .hamburger-line {
      background-color: #dc2626;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       ⚡ PERFORMANCE OPTIMIZATIONS
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    /* Dynamic will-change managed by JS */
    #mobile-menu.menu-animating {
      will-change: transform, opacity;
    }

    /* Containment for isolation */
    #mobile-menu {
      contain: layout style paint;
    }

    /* Content visibility for lazy rendering */
    #mobile-menu:not(.menu-open) {
      content-visibility: hidden;
    }

    /* Reduce repaints */
    .nav-button,
    #mobile-menu a,
    #languageMenu li {
      contain: layout style;
    }

    /* Optimized GPU layers */
    .hamburger-line {
      will-change: transform, opacity;
    }

    #mobileMenuCloseBtn svg {
      will-change: transform;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       📞 INTERNATIONAL TELEPHONE INPUT - CUSTOM STYLES
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
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

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       📱 RESPONSIVE DESIGN
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    /* Mobile: Touch-friendly targets */
    @media (max-width: 768px) {
      button,
      a {
        min-height: 44px;
        min-width: 44px;
      }

      .iti__country-list {
        width: 280px;
      }

      .iti input[type="tel"] {
        padding-left: 70px !important;
      }
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       ♿ ACCESSIBILITY
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    /* Focus visible for keyboard navigation */
    *:focus-visible {
      outline: 2px solid #3b82f6;
      outline-offset: 2px;
    }
  </style>

  
  <style>
  /* ============================================
     🎯 MOBILE-FIRST POPUP 2025/2026
     ============================================ */

  /* Smooth scrolling */
  #popupContentArea { scroll-behavior: smooth; -webkit-overflow-scrolling: touch; }

  /* Custom scrollbar for desktop */
  @media (min-width: 640px) {
    #popupContentArea::-webkit-scrollbar { width: 8px; }
    #popupContentArea::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #popupContentArea::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #popupContentArea::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  }

  /* Backdrop blur effect for mobile header */
  @supports (backdrop-filter: blur(12px)) {
    @media (max-width: 639px) {
      .backdrop-blur-sm { backdrop-filter: blur(12px); }
    }
  }

  /* Animation shake for validation errors */
  @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-10px); } 75% { transform: translateX(10px); } }
  .shake { animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97); }

  /* ============================================
     🎨 NAVIGATION BUTTONS 2025 - ENHANCED
     ============================================ */

  /* Mobile: Fixed Bottom Navigation */
  @media (max-width: 639px) {
    #mobileNavButtons {
      position: fixed; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
      padding: 12px; display: flex; gap: 12px; box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
      z-index: 60; backdrop-filter: blur(8px);
    }
    #mobileNavButtons button { flex: 1; height: 48px; border-radius: 12px; font-weight: 600; font-size: 15px; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); display: flex; align-items: center; justify-content: center; gap: 8px; }
    #mobileNavButtons .btn-back { background: white; color: #64748b; border: 2px solid #e2e8f0; flex: 0.8; }
    #mobileNavButtons .btn-back:active { background: #f8fafc; transform: scale(0.98); }
    #mobileNavButtons .btn-next { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
    #mobileNavButtons .btn-next:active { transform: scale(0.98); box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); }
    #mobileNavButtons .btn-next:disabled { background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%); box-shadow: none; opacity: 0.6; }
  }

  /* Desktop: In-Flow Navigation */
  @media (min-width: 640px) {
    #desktopNavButtons {
      position: sticky; bottom: 0; display: flex; justify-content: space-between; align-items: center; gap: 16px;
      margin-top: 16px; padding: 12px 0; background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
      backdrop-filter: blur(8px); border-top: 1px solid #e5e7eb; z-index: 60;
    }
    #desktopNavButtons button { padding: 12px 32px; border-radius: 12px; font-weight: 600; font-size: 15px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: inline-flex; align-items: center; gap: 8px; }
    #desktopNavButtons .btn-back { background: white; color: #64748b; border: 2px solid #e2e8f0; }
    #desktopNavButtons .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08); }
    #desktopNavButtons .btn-back:active { transform: translateY(0); }
    #desktopNavButtons .btn-next { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
    #desktopNavButtons .btn-next:hover { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4); }
    #desktopNavButtons .btn-next:active { transform: translateY(0); }
    #desktopNavButtons .btn-next:disabled { background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%); box-shadow: none; opacity: 0.6; cursor: not-allowed; transform: none; }
    #desktopNavButtons .btn-next:disabled:hover { transform: none; }
  }

  .btn-back svg, .btn-next svg { transition: transform 0.3s ease; }
  .btn-back:hover svg { transform: translateX(-4px); }
  .btn-next:hover svg { transform: translateX(4px); }

  /* ============================================
     🎯 AJOUTS: CROIX VISIBLE & BOUTONS GRISÉS
     ============================================ */
  .close-popup {
    position: absolute; top: 1.5rem; right: 1.5rem; width: 2.5rem; height: 2.5rem;
    background-color: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease; z-index: 10; border: 2px solid #ef4444;
  }
  .close-popup:hover { background-color: #ef4444; transform: scale(1.1); }
  .close-popup svg { width: 1.25rem; height: 1.25rem; color: #ef4444; stroke-width: 3; transition: color 0.2s ease; }
  .close-popup:hover svg { color: white; }

  .btn-disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; background-color: #e5e7eb !important; color: #9ca3af !important; }
  .btn-enabled { opacity: 1; cursor: pointer; transition: all 0.2s ease; }

  @media (max-width: 768px) {
    .close-popup { top: 1rem; right: 1rem; width: 2rem; height: 2rem; }
    .close-popup svg { width: 1rem; height: 1rem; }
  }
  </style>

  <style>[x-cloak]{display:none !important}</style>
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>
  <script>
    // Re-apply fixes because Google can re-inject on language change
    (function fixGoogleTranslateGap() {
      function zap() {
        const banner = document.querySelector('iframe.goog-te-banner-frame');
        if (banner && banner.parentNode) banner.parentNode.removeChild(banner);

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

      zap();
      let n = 0;
      const id = setInterval(() => {
        zap();
        if (++n > 20) clearInterval(id); // ~4s total
      }, 200);

      window.addEventListener('resize', zap);
    })();
  </script>

  <style>
  html { scroll-behavior: auto !important; }
  .breadcrumb-container { background: transparent; border-bottom: 1px solid rgba(226, 232, 240, 0.6); padding: 12px 0; }
  .breadcrumb { display: flex; align-items: center; gap: 8px; max-width: 1280px; margin: 0 auto; padding: 0 20px; font-size: 14px; }
  .breadcrumb-item { display: flex; align-items: center; gap: 6px; }
  .breadcrumb-item svg { width: 15px; height: 15px; }
  .breadcrumb-item a { color: #64748b; text-decoration: none; padding: 6px 12px; border-radius: 20px; display: flex; align-items: center; gap: 6px; font-weight: 500; transition: all 0.25s ease; background: transparent; }
  .breadcrumb-item a:hover { background: rgba(59, 130, 246, 0.08); color: #3b82f6; transform: translateX(2px); }
  .breadcrumb-item.active { color: #1e293b; font-weight: 600; padding: 6px 12px; background: rgba(226, 232, 240, 0.4); border-radius: 20px; }
  .breadcrumb-separator { color: #cbd5e1; margin: 0 4px; font-size: 14px; }
  #scrollToTopBtn {
    position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px; background: #3b82f6; color: white;
    border: none; border-radius: 50%; cursor: pointer; display: none; align-items: center; justify-content: center; z-index: 9999; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
  }
  #scrollToTopBtn:hover { background: #2563eb; }
  #scrollToTopBtn.show { display: flex; }

  @media (max-width: 768px) {
    #scrollToTopBtn { display: none !important; }
    .breadcrumb-container { padding: 12px 0; }
    .breadcrumb { padding: 0 16px; font-size: 13px; gap: 6px; }
    .breadcrumb-item svg { width: 14px; height: 14px; }
    .breadcrumb-item a { padding: 5px 10px; }
    .breadcrumb-item.active { padding: 5px 12px; }
  }
  </style>

</head>

@php
    // récupération sûre de la configuration du site (évite erreur si pas d'enregistrement)
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings ? ($settings->legal_info ?? []) : [];
@endphp

@php 
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

<body class="min-h-screen bg-white">


<!-- 🚀 Bouton Flèche Retour en Haut -->
<button id="scrollToTopBtn" aria-label="Retour en haut">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>

<!-- //For showing toast messages across platform -->
@if (session('success'))
    <script>toastr.success('{{ session('success') }}', 'Success');</script>
@endif
@if (session('error'))
    <script>toastr.error('{{ session('error') }}', 'Error');</script>
@endif

<!-- Navbar (desktop) -->
<nav class="top-0 z-40 lg:z-50 border-b border-white/20 shadow-xl">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">

      <!-- Logo -->
      <div class="hidden lg:flex items-center space-x-3 group">
        <div class="relative">
          <div class="rounded-xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
        </div>
        <div class="flex items-center h-full">
          <a href="/">
            <img src="/images/headerlogos.png" alt="Logo ULIXAI" class="w-25 h-auto max-h-14 object-contain" width="100" height="56" />
          </a>
        </div>
      </div>

      <!-- Desktop Buttons -->
      <div class="hidden lg:flex items-center space-x-3 group">
        <button onclick="openHelpPopup()" class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover-glow transform hover:scale-105 shadow-lg" aria-label="Request Help">
          <span class="flex items-center space-x-2">
            <i class="fas fa-lock text-white-600 text-xl" aria-hidden="true"></i>
            <span>Request Help</span>
          </span>
        </button>

        <!-- SOS Button -->
        <a href="https://sos-expat.com/" 
           target="_blank"
           rel="noopener noreferrer"
           class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 animate-glow transform hover:scale-105 shadow-lg"
           aria-label="Emergency SOS">
          <span class="flex items-center space-x-2">
            <i class="fas fa-phone-alt text-white-600 text-xl" aria-hidden="true"></i>
            <span>S.O.S</span>
          </span>
        </a>

        @if(Auth::check() && Auth::user()->user_role != 'service_provider' || Auth::check() === false)
          <a href="/become-service-provider" class="nav-button border-2 border-gradient-to-r from-purple-500 to-blue-500 bg-gradient-to-r from-purple-50 to-blue-50 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-3 rounded-full text-sm font-semibold hover:bg-gradient-to-r hover:from-purple-100 hover:to-blue-100 transition-all duration-300 transform hover:scale-105 shadow-lg border-blue-300">
            <span class="flex items-center space-x-2 text-blue-600">
              <i class="fas fa-file-signature text-blue-600 text-2xl" aria-hidden="true"></i>
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
            class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-white shadow hover:bg-gray-50 transition"
            aria-label="Select language"
            aria-haspopup="menu"
            aria-expanded="false">
            <div class="w-6 h-6 rounded-full overflow-hidden border border-gray-300">
              <img id="langFlag" src="https://flagcdn.com/24x18/us.png" alt="EN" class="w-full h-full object-cover" width="24" height="18">
            </div>
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown -->
          <ul id="langMenu"
              class="absolute right-0 hidden bg-white shadow-lg border border-gray-200 rounded-lg mt-2 w-40 z-20"
              role="menu">
            <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100"
                role="menuitem">
              <img src="https://flagcdn.com/20x15/us.png" alt="" class="w-5 h-4 mr-2" width="20" height="15"> English
            </li>
            <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100"
                role="menuitem">
              <img src="https://flagcdn.com/20x15/fr.png" alt="" class="w-5 h-4 mr-2" width="20" height="15"> Français
            </li>
            <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
                class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100"
                role="menuitem">
              <img src="https://flagcdn.com/20x15/de.png" alt="" class="w-5 h-4 mr-2" width="20" height="15"> Deutsch
            </li>
          </ul>
        </div>

        <!-- Hidden Google Translate widget (single instance) -->
        <div id="google_translate_element" class="hidden"></div>

        <!-- Auth Buttons / User menu -->
        <div class="flex items-center space-x-3">
        @php 
          $isActive = Auth::check();
        @endphp

        @if(!$isActive)
          <a href="/login" class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 group">
            <i class="fas fa-user mr-2 text-lg text-blue-600" aria-hidden="true"></i>
            <span class="font-medium text-blue-600"> Log in</span>
          </a>

          <button id="signupBtn" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center space-x-2">
            <i class="fas fa-user-plus mr-2 text-lg" aria-hidden="true"></i>
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
              aria-label="User menu">
              <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                style="background-image: {{ $backgroundImage }};">
              </div>
              <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">{{ $user->name }}</span>
              <i class="fas fa-chevron-down text-gray-500 text-sm" aria-hidden="true"></i>
            </button>

            <div
              x-cloak
              x-show="open"
              x-transition
              @click.outside="open = false"
              @keydown.escape.window="open = false"
              style="display:none"
              class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50"
              role="menu">
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
                      <i class="fas {{ $role['icon'] }} text-[11px]" aria-hidden="true"></i>
                      {{ $role['label'] }}
                    </span>
                  </div>

                  @endif
                </div>
              </div>

              <nav class="py-1">
                <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" role="menuitem">
                  <i class="fas fa-gauge" aria-hidden="true"></i>
                  <span>Dashboard</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                  @csrf
                  <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" role="menuitem">
                    <i class="fas fa-right-from-bracket" aria-hidden="true"></i>
                    <span>Log out</span>
                  </button>
                </form>
              </nav>
            </div>
          </div>
        @endif
        </div> <!-- /auth buttons -->
      </div>
    </div>
  </div>
</nav>

<!-- ============================================
     🚀 POPUP MODERNISÉ 2025/2026
     ============================================ -->
<div id="signupPopup" class="fixed inset-0 bg-black/50 z-50 hidden flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6" role="dialog" aria-modal="true" aria-labelledby="signup-popup-title">
  <!-- CONTAINER RESPONSIVE -->
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] rounded-t-3xl sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col">
    <!-- HEADER STICKY -->
    <div class="sticky sm:relative top-0 z-20 bg-white/95 sm:bg-white backdrop-blur-sm sm:backdrop-blur-none border-b-0 px-4 sm:px-8 py-0 flex items-center justify-between gap-4 h-0 overflow-hidden sm:h-auto sm:overflow-visible">
      <div class="flex-1">
        <div class="sm:hidden">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-500">Step <span id="currentStepNum">1</span> of 16</span>
            <span class="text-xs font-semibold text-blue-600"><span id="progressPercentage">6</span>%</span>
          </div>
          <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100">
            <div id="mobileProgressBar" class="h-full bg-gradient-to-r from-blue-600 to-blue-500 transition-all duration-300 ease-out" style="width: 6.25%"></div>
          </div>
        </div>
      </div>

      <!-- Close Button -->
      <button id="closePopup" 
              class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 text-gray-500 hover:text-gray-800 shrink-0 absolute top-2 right-2" 
              aria-label="Close signup form">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- CONTENT -->
    <div class="flex-1 overflow-y-auto overscroll-contain px-4 sm:px-8 pt-0 pb-20 sm:pb-4" id="popupContentArea">
      <!-- Steps includes -->
      @include('includes.provider.choose_step')
      @include('includes.provider.native_language')
      @include('includes.provider.spoken_language')
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
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <div>
              <h2 id="step5-title" class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
                Where Do You Live? 🌍
              </h2>
              <p class="text-sm sm:text-base font-semibold text-gray-600">
                Select your country of residence
              </p>
            </div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
              <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="text-xs font-bold text-blue-700">
                <span id="step5SelectedCount">0</span> / 1 selected
              </span>
            </div>
          </div>
        </div>
<script>
  // Validation Step 5 : require at least one country selected
  window.validateStep5 = function() {
    const countEl = document.getElementById('step5SelectedCount');
    if (countEl && parseInt(countEl.textContent, 10) > 0) return true;
    const s5 = document.getElementById('step5');
    if (!s5) return false;
    if (s5.querySelector('[aria-checked="true"], [aria-selected="true"], .selected, .is-selected')) return true;
    return false;
  };
  // Re-évaluer lorsqu'on interagit dans Step 5 (si cartes / boutons non-input)
  document.getElementById('step5')?.addEventListener('click', () => {
    if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
  });
</script>


        <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">
          <div id="step5CountryError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
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
              <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <p class="text-sm font-semibold text-green-800">Country selected!</p>
                <p class="text-xs text-green-600 mt-0.5">Ready to continue</p>
              </div>
            </div>
          </div>

          <div class="relative">
            <label for="location-input" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
              <span class="text-lg" aria-hidden="true">🌎</span>
              <span class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">Country of Residence</span>
            </label>
            <div class="relative">
              <select 
                id="location-input" 
                name="location" 
                class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-gray-800 bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none cursor-pointer text-sm font-medium hover:border-blue-400"
                aria-required="true"
              >
                <option value="" disabled selected>Choose your country...</option>
                @foreach($countries as $country)
                  <option value="{{ $country->country }}">{{ $country->country }}</option>
                @endforeach
              </select>
              <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </div>
            </div>
          </div>

        </div>
      </div>

      @include('includes.provider.operational_countries', ['countries' => $countries])
      @include('includes.provider.special_status')
      @include('includes.provider.communication_preference')
      @include('includes.provider.profile_description')
      @include('includes.provider.profile_picture')
      @include('includes.provider.identity_documents')
      @include('includes.provider.first_last_name')
      @include('includes.provider.email')
      @include('includes.provider.verify_email')
      @include('includes.provider.phone_number')

      <!-- Step 16: Success Confirmation -->
      <div id="step16" class="hidden space-y-6 text-center">
        <h2 class="text-blue-900 font-extrabold text-2xl">YOUR PROVIDER ACCOUNT IS CREATED</h2>
        <p class="text-blue-800 font-semibold text-md">YOU ARE OFFICIALLY A ULYSSE</p>
        <p class="text-gray-600">Go check out the service requests in your area now</p>
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full">
          <a href="{{ route('ongoing-requests') }}"> CURRENT SERVICE REQUESTS </a>
        </button>
        <p class="text-gray-600 text-sm mt-2">You can boost your profile to have more jobs to do</p>
        <button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-6 py-2 rounded-full">
          I BOOST MY PROFILE TO BE AMONG THE FIRST SERVICE PROVIDERS
        </button>
      </div>
    </div>

    <!-- NAVIGATION BUTTONS -->
    <div id="mobileNavButtons" class="sm:hidden">
      <button id="mobileBackBtn" class="btn-back" style="display:none;" aria-label="Go back">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Back</span>
      </button>
      <button id="mobileNextBtn" class="btn-next" aria-label="Continue to next step">
        <span>Continue</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>
    </div>

    <div id="desktopNavButtons" class="hidden sm:flex px-8 pb-6">
      <button id="desktopBackBtn" class="btn-back" style="display:none;" aria-label="Go back">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        <span>Back</span>
      </button>
      <button id="desktopNextBtn" class="btn-next" aria-label="Continue to next step">
        <span>Continue</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>
    </div>
  </div>
</div>

  <!-- 🎨 Mobile Header - HTML5 Semantic -->
  <header class="lg:hidden fixed top-0 left-0 w-full bg-white z-[60] shadow-md" role="banner">
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

        <a href="https://sos-expat.com/" 
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

 <!-- 🎨 Mobile Menu -->
<nav id="mobile-menu" class="lg:hidden fixed top-[64px] left-0 w-full bg-white z-40 shadow-md hidden px-6 py-4 space-y-4" role="navigation" aria-label="Mobile menu" aria-hidden="true">
  <div class="flex justify-end mb-2">
    <button id="mobileMenuCloseBtn" class="p-3 rounded-full hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 hover:scale-110" aria-label="Close menu">
      <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <ul class="space-y-2" role="menu">
    @if(Auth::check())
      {{-- ============================================
           UTILISATEUR CONNECTÉ
           ============================================ --}}
      
      {{-- Profil utilisateur --}}
      <li role="none" class="border-b border-gray-200 pb-3 mb-3">
        <div class="flex items-center gap-3 px-4 py-2">
          @php
            $user = Auth::user();
            $provider = $user?->serviceProvider;
            $profilePhoto = $provider?->profile_photo ? asset($provider->profile_photo) : null;
            $avatar = $user?->avatar ? asset($user->avatar) : null;
            $default = asset('images/helpexpat.png');
            $backgroundImage = "url('{$profilePhoto}'), url('{$avatar}'), url('{$default}')";
          @endphp
          
          <div class="w-10 h-10 rounded-full border bg-center bg-cover"
               style="background-image: {{ $backgroundImage }};"></div>
          <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-800 truncate">{{ $user->name }}</p>
            @php
              $rawRole = (string)($user->user_role ?? '');
              $key = strtolower(str_replace(['-', ' '], '_', $rawRole));
              $roles = [
                'service_provider' => ['label' => 'Service Provider', 'cls' => 'bg-emerald-100 text-emerald-700'],
                'service_requester' => ['label' => 'Service Requester', 'cls' => 'bg-indigo-100 text-indigo-700'],
                'admin' => ['label' => 'Admin', 'cls' => 'bg-rose-100 text-rose-700'],
              ];
              $role = $roles[$key] ?? ['label' => 'User', 'cls' => 'bg-gray-100 text-gray-700'];
            @endphp
            <span class="inline-block text-xs px-2 py-0.5 rounded-full {{ $role['cls'] }} font-medium">
              {{ $role['label'] }}
            </span>
          </div>
        </div>
      </li>

      {{-- Dashboard --}}
      <li role="none">
        <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-gauge text-blue-600" aria-hidden="true"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Become a provider (seulement si pas déjà provider) --}}
      @if(Auth::user()->user_role != 'service_provider')
        <li role="none">
          <a href="/become-service-provider" 
             class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
             role="menuitem">
            <i class="fas fa-file-signature text-blue-600" aria-hidden="true"></i>
            <span>Become a provider</span>
          </a>
        </li>
      @endif

      {{-- Affiliate Program --}}
      <li role="none">
        <a href="/affiliate" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-handshake text-blue-600" aria-hidden="true"></i>
          <span>Affiliate Program</span>
        </a>
      </li>

      {{-- Logout --}}
      <li role="none" class="border-t border-gray-200 pt-2 mt-2">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
          @csrf
          <button type="submit" 
                  class="w-full text-left text-red-600 text-base font-semibold py-3 px-4 rounded-lg hover:bg-red-50 transition-colors flex items-center gap-3" 
                  role="menuitem">
            <i class="fas fa-right-from-bracket" aria-hidden="true"></i>
            <span>Log out</span>
          </button>
        </form>
      </li>

    @else
      {{-- ============================================
           UTILISATEUR NON CONNECTÉ
           ============================================ --}}
      
      {{-- Become a provider --}}
      <li role="none">
        <a href="/become-service-provider" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-file-signature text-blue-600" aria-hidden="true"></i>
          <span>Become a provider</span>
        </a>
      </li>

      {{-- Login --}}
      <li role="none">
        <a href="/login" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-user text-blue-600" aria-hidden="true"></i>
          <span>Log in</span>
        </a>
      </li>

      {{-- Sign up --}}
      <li role="none">
        <a href="/signup" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-user-plus text-blue-600" aria-hidden="true"></i>
          <span>Sign up</span>
        </a>
      </li>

      {{-- Affiliate Program --}}
      <li role="none">
        <a href="/affiliate" 
           class="block text-gray-800 text-base font-semibold py-3 px-4 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors flex items-center gap-3" 
           role="menuitem">
          <i class="fas fa-handshake text-blue-600" aria-hidden="true"></i>
          <span>Affiliate Program</span>
        </a>
      </li>
    @endif
  </ul>

  {{-- Sélecteur de langue --}}
  <div class="relative w-full sm:w-56">
    <input id="langOpen" type="checkbox" class="peer sr-only" />
    <label for="langOpen"
          class="flex justify-between items-center w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 bg-white cursor-pointer select-none">
      <span id="languageLabel">Language</span>
      <img id="languageFlag" src="https://flagcdn.com/24x18/us.png" alt="" class="ml-2 w-5 h-4 object-cover" width="20" height="16" />
    </label>

    <ul id="languageMenu"
        class="absolute left-0 right-0 mt-2 bg-white border border-gray-300 rounded-lg shadow-md z-50 hidden peer-checked:block"
        role="menu">
      <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2"
          role="menuitem">
        <img src="https://flagcdn.com/24x18/fr.png" alt="" class="w-5 h-4" width="20" height="16" /> Français
      </li>
      <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2"
          role="menuitem">
        <img src="https://flagcdn.com/24x18/us.png" alt="" class="w-5 h-4" width="20" height="16" /> English
      </li>
      <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
          class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2"
          role="menuitem">
        <img src="https://flagcdn.com/24x18/de.png" alt="" class="w-5 h-4" width="20" height="16" /> Deutsch
      </li>
    </ul>
  </div>

  {{-- Bouton S.O.S --}}
  <a href="https://sos-expat.com/" target="_blank" rel="noopener noreferrer" class="block w-full text-center bg-red-600 text-white font-semibold py-2 rounded-full shadow hover:bg-red-700 transition">
    <i class="fas fa-phone-alt mr-1" aria-hidden="true"></i> S.O.S
  </a>
</nav>

@include('pages.popup')

<!-- 🍞 Fil d'Ariane -->
<div class="breadcrumb-container">
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="breadcrumb-item">
      <a href="/">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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

      <span class="breadcrumb-separator" aria-hidden="true">›</span>

      @if($isLast)
        <div class="breadcrumb-item active" aria-current="page">{{ $title }}</div>
      @else
        <div class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></div>
      @endif
    @endforeach
  </nav>
</div>

@include('includes.cookie-banner')

<!-- ═══════════════════════════════════════════════════════════
     🚀 JAVASCRIPT MODULES - REFACTORISÉ
     ═══════════════════════════════════════════════════════════ -->
      <script src="{{ mix('js/app.js') }}"></script>
      <script src="{{ mix('js/header-init.js') }}"></script>

</body>
</html>