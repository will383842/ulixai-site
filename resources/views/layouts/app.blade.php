{{--
  ═══════════════════════════════════════════════════════════
  🏗️ LAYOUT PRINCIPAL - APP.BLADE.PHP
  ═══════════════════════════════════════════════════════════

  Layout de base pour toutes les pages publiques.

  Usage dans les pages :
  @extends('layouts.app')

  @section('title', 'Titre de la page')
  @section('description', 'Description SEO')

  @section('content')
    <!-- Contenu de la page -->
  @endsection

  @section('scripts')
    <!-- Scripts spécifiques à la page -->
  @endsection

  @version 1.0.0
  @created 2025-12-31
--}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

{{-- ═══════════════════════════════════════════════════════════
     📦 HEAD - Meta, CSS, Scripts externes
     ═══════════════════════════════════════════════════════════ --}}
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO --}}
  <title>@yield('title', 'Ulixai - Global Help Network')</title>
  <meta name="description" content="@yield('description', 'Ulixai connects helpers and seekers worldwide. Get help from locals anywhere in the world.')">
  <meta name="keywords" content="@yield('keywords', 'help, global, expat, travel, assistance, community')">
  <meta name="author" content="Ulixai">
  <meta name="robots" content="@yield('robots', 'index, follow')">
  <link rel="canonical" href="{{ url()->current() }}">

  {{-- Open Graph --}}
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', 'Ulixai - Global Help Network')">
  <meta property="og:description" content="@yield('og_description', 'Connect with helpers worldwide')">
  <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
  <meta property="og:site_name" content="Ulixai">

  {{-- Twitter --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('twitter_title', 'Ulixai')">
  <meta name="twitter:description" content="@yield('twitter_description', 'Connect with helpers worldwide')">
  <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">

  {{-- Favicons --}}
  <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

  {{-- PWA / Mobile --}}
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#ffffff">

  {{-- Performance hints --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://code.jquery.com" crossorigin>
  <link rel="preconnect" href="https://unpkg.com" crossorigin>

  {{-- jQuery (required by some components) - kept on CDN for better caching --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

  {{-- Vendor CSS (Font Awesome + Toastr) - bundled locally --}}
  <link rel="preload" href="{{ mix('css/vendor.css') }}" as="style">
  <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">

  {{-- International Telephone Input --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" defer></script>

  {{-- Tailwind CSS (compiled) --}}
  <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Custom Styles --}}
  @if(file_exists(public_path('css/styles.css')))
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  @endif

  {{-- Global Styles --}}
  @include('includes.header.styles')

  {{-- Wizard Navigation Buttons Styles --}}
  @include('wizards.navigation-buttons-styles')

  {{-- Alpine.js --}}
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>

  {{-- Google Analytics (blocked by default for GDPR) --}}
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-418ZTJHNX6"></script>
  <script>
    window['ga-disable-G-418ZTJHNX6'] = true;
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('consent', 'default', {
      'analytics_storage': 'denied',
      'ad_storage': 'denied'
    });
    gtag('config', 'G-418ZTJHNX6');
  </script>

  {{-- Page-specific head content --}}
  @yield('head')
</head>

@php
  // Récupération sûre de la configuration du site
  $settings = \App\Models\SiteSetting::first();
  $legal = $settings ? ($settings->legal_info ?? []) : [];

  // Récupérer les pays pour les wizards
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

<body class="min-h-screen bg-white antialiased @yield('body_class')">

  {{-- Google Tag Manager (noscript) --}}
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>

  {{-- Skip to content (Accessibility) --}}
  <a href="#main-content" class="skip-to-content sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-lg z-50">
    Aller au contenu principal
  </a>

  {{-- ═══════════════════════════════════════════════════════════
       🖥️ NAVBAR DESKTOP
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.header.navbar-desktop')

  {{-- ═══════════════════════════════════════════════════════════
       📱 NAVBAR MOBILE
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.header.navbar-mobile')

  {{-- ═══════════════════════════════════════════════════════════
       🍞 BREADCRUMB (optional)
       ═══════════════════════════════════════════════════════════ --}}
  @hasSection('breadcrumb')
    @yield('breadcrumb')
  @else
    @include('includes.header.breadcrumb')
  @endif

  {{-- ═══════════════════════════════════════════════════════════
       📄 MAIN CONTENT
       ═══════════════════════════════════════════════════════════ --}}
  <main id="main-content" class="@yield('main_class', 'pt-20')">
    @yield('content')
  </main>

  {{-- ═══════════════════════════════════════════════════════════
       🦶 FOOTER
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.footer')

  {{-- ═══════════════════════════════════════════════════════════
       🎯 WIZARDS POPUPS
       ═══════════════════════════════════════════════════════════ --}}
  @include('wizards.provider.signup-popup')
  @include('wizards.requester.steps.popup_request_help')

  {{-- ═══════════════════════════════════════════════════════════
       🍪 COOKIE BANNER
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.cookie-banner')

  {{-- ═══════════════════════════════════════════════════════════
       🐛 FLOATING BUG REPORT
       ═══════════════════════════════════════════════════════════ --}}
  @include('components.floating-bug-report')

  {{-- ═══════════════════════════════════════════════════════════
       🔧 SCRIPTS
       ═══════════════════════════════════════════════════════════ --}}
  @include('includes.header.scripts')

  {{-- Session Messages --}}
  @if (session('success'))
    <script>toastr.success('{{ session('success') }}', 'Success');</script>
  @endif
  @if (session('error'))
    <script>toastr.error('{{ session('error') }}', 'Error');</script>
  @endif

  {{-- Main JS --}}
  <script src="{{ mix('js/app.js') }}"></script>

  {{-- Page-specific scripts --}}
  @yield('scripts')

</body>
</html>
