{{-- 
  ═══════════════════════════════════════════════════════════
  📦 HEAD COMPONENT - Meta tags, CSS, Scripts, Analytics
  ═══════════════════════════════════════════════════════════
  
  Contient :
  - Meta tags (charset, viewport, SEO)
  - Performance hints (preconnect, dns-prefetch)
  - Google Tag Manager & Analytics
  - External CSS & JS (Font Awesome, Toastr, intl-tel-input, Tailwind)
  - Tailwind configuration
  - Styles globaux (mobile menu, hamburger, scroll, etc.)
  - Alpine.js
  
  @version 2.0.0
--}}

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO basics injected --}}
  @php $canonical = url()->current(); @endphp
  <link rel="canonical" href="{{ $canonical }}" />
  <meta name="robots" content="{{ isset($noindex) && $noindex ? 'noindex,nofollow' : 'index,follow' }}">

  {{-- Performance hints --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
  <link rel="dns-prefetch" href="https://code.jquery.com">
  {{-- dns-prefetch for cdn.tailwindcss.com removed - using local build --}}

  {{-- PWA / Mobile --}}
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="format-detection" content="telephone=no">
  <meta name="theme-color" content="#ffffff">

  {{-- Google Tag Manager --}}
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-XXXXXXX');</script>

  {{-- Google Analytics - BLOQUÉ PAR DÉFAUT (GDPR) --}}
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-418ZTJHNX6"></script>
  <script>
    // ⚠️ BLOQUER Google Analytics par défaut (conforme GDPR)
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

  {{-- ═══════════════════════════════════════════════════════════
       📦 EXTERNAL RESOURCES - CDN
       ═══════════════════════════════════════════════════════════ --}}
  
  {{-- Font Awesome Icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  {{-- Custom Styles - Laravel Asset --}}
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  {{-- Toastr Notifications --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- International Telephone Input --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  {{-- ═══════════════════════════════════════════════════════════
       🎨 TAILWIND CSS - Compiled Build (Production Ready)
       ═══════════════════════════════════════════════════════════ --}}
  <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- ═══════════════════════════════════════════════════════════
       🌐 GOOGLE TRANSLATE - PROTECTION CONTRE BOUCLES INFINIES
       ═══════════════════════════════════════════════════════════ --}}
  <style>
    /* Empêcher Google Translate de traduire ces éléments */
    .notranslate,
    script,
    style,
    code,
    pre,
    [data-lang],
    [data-flag],
    #google_translate_element,
    #langBtn,
    #langMenu,
    #langFlag,
    #mobileLangBtn,
    #mobileLangModal,
    #mobileLangSheet,
    #mobileLangFlag,
    #mobileLangLabel,
    .lang-option {
      translate: no !important;
    }
    
    /* Attribut HTML5 pour désactiver la traduction */
    [translate="no"] {
      translate: no !important;
    }
  </style>

  {{-- ═══════════════════════════════════════════════════════════
       🎨 GLOBAL STYLES
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.header.styles')

  {{-- ═══════════════════════════════════════════════════════════
       🎨 WIZARD NAVIGATION BUTTONS STYLES
       ═══════════════════════════════════════════════════════════ --}}
  @include('wizards.navigation-buttons-styles')

  {{-- Alpine.js for reactive components --}}
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>
</head>