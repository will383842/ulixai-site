<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- SEO basics -->
  @php $canonical = url()->current(); @endphp
  <link rel="canonical" href="{{ $canonical }}" />
  <meta name="robots" content="{{ isset($noindex) && $noindex ? 'noindex,nofollow' : 'index,follow' }}">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-XXXXXXX');</script>

  <!-- Google Analytics - BLOCKED BY DEFAULT (GDPR) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-418ZTJHNX6"></script>
  <script>
    window['ga-disable-G-418ZTJHNX6'] = true;
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('consent', 'default', {'analytics_storage': 'denied','ad_storage': 'denied'});
    gtag('config', 'G-418ZTJHNX6');
  </script>

  <!-- External Resources -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
  
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>

  <!-- International Telephone Input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  <!-- Google Translate Widget -->
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- Tailwind CSS CDN (Development Only) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tailwind Config -->
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

  <!-- AlpineJS -->
  <style>[x-cloak]{display:none !important}</style>
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>

  @php
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings ? ($settings->legal_info ?? []) : [];
    use App\Models\Country;
    $countries = Country::where('status', 1)->get();
  @endphp
</head>

<body class="min-h-screen bg-white">

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" aria-label="Retour en haut">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>

<!-- Toast Messages -->
@if (session('success'))
  <script>toastr.success('{{ session('success') }}', 'Success');</script>
@endif
@if (session('error'))
  <script>toastr.error('{{ session('error') }}', 'Error');</script>
@endif

<!-- Desktop Navbar -->
@include('includes.header-nav')

<!-- Mobile Header -->
@include('includes.header-mobile')

<!-- Signup Wizard Popup -->
@include('includes.signup-wizard')

<!-- Help Popup -->
@include('pages.popup')

<!-- Breadcrumb -->
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

<!-- Hidden Google Translate widget -->
<div id="google_translate_element" class="hidden"></div>

<!-- Initialize all header components -->
<script type="module">
  import './header-init.js';
</script>

@include('includes.cookie-banner')

</body>
</html>