{{-- Provider Details Page - V7.1 FINAL - Socialmediacard correctement positionné --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, viewport-fit=cover">
    <meta name="description" content="{{ $provider->profile_description }}">
    <title>Provider Detail</title>

    <!-- Tailwind CSS - Local Build -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" defer></script>
    
    
    
    <!-- Performance & Mobile Optimization -->
    <meta name="theme-color" content="#667eea">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Ulixai">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="format-detection" content="telephone=no">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preload" href="https://code.jquery.com/jquery-3.6.0.min.js" as="script">
    <link rel="dns-prefetch" href="https://code.jquery.com">
    
    <!-- SEO Meta Tags Enhanced -->
    <meta name="keywords" content="helper, expat services, local expert, professional services, international assistance, 197 countries, multilingual helper, global services, expatriate support, relocation help, {{ $provider->first_name }} {{ $provider->last_name }}, international helper, worldwide services">
    <meta name="author" content="Ulixai">
    <meta http-equiv="content-language" content="en">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <!-- Geographic Coverage -->
    <meta name="geo.region" content="WORLD">
    <meta name="geo.placename" content="Global">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="global">
    <meta name="target" content="all">
    
    <!-- Favicon & Icons -->
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    
    <!-- Canonical & Multilingual Links -->
    <link rel="canonical" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'en']) }}">
    <link rel="alternate" hreflang="en" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'en']) }}">
    <link rel="alternate" hreflang="fr" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'fr']) }}">
    <link rel="alternate" hreflang="de" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'de']) }}">
    <link rel="alternate" hreflang="es" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'es']) }}">
    <link rel="alternate" hreflang="pt" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'pt']) }}">
    <link rel="alternate" hreflang="ar" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'ar']) }}">
    <link rel="alternate" hreflang="ru" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'ru']) }}">
    <link rel="alternate" hreflang="zh" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'zh']) }}">
    <link rel="alternate" hreflang="hi" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'hi']) }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('provider.profile', ['slug' => $provider->slug, 'locale' => 'en']) }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ route('provider.profile', ['slug' => $provider->slug]) }}">
    <meta property="og:title" content="{{ $provider->first_name }} {{ $provider->last_name }} - Professional Helper on Ulixai">
    <meta property="og:description" content="{{ Str::limit($provider->profile_description ?? 'Verified professional helper providing quality services worldwide', 150) }}">
    <meta property="og:image" content="{{ $provider->profile_photo ? asset($provider->profile_photo) : asset('images/default-profile-og.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="fr_FR">
    <meta property="og:locale:alternate" content="de_DE">
    <meta property="og:locale:alternate" content="es_ES">
    <meta property="og:locale:alternate" content="pt_PT">
    <meta property="og:locale:alternate" content="ar_AR">
    <meta property="og:locale:alternate" content="ru_RU">
    <meta property="og:locale:alternate" content="zh_CN">
    <meta property="og:locale:alternate" content="hi_IN">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ route('provider.profile', ['slug' => $provider->slug]) }}">
    <meta name="twitter:title" content="{{ $provider->first_name }} {{ $provider->last_name }} - Helper Profile">
    <meta name="twitter:description" content="{{ Str::limit($provider->profile_description ?? 'Professional helper on Ulixai', 150) }}">
    <meta name="twitter:image" content="{{ $provider->profile_photo ? asset($provider->profile_photo) : asset('images/default-profile-twitter.jpg') }}">
    
    <!-- JSON-LD Structured Data -->
    @php
        $reviewCount = $reviewCount ?? 0;
        $avgRating = $avgRating ?? 0;
    @endphp
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "{{ $provider->first_name }} {{ $provider->last_name }}",
      "description": "{{ $provider->profile_description ?? 'Professional helper on Ulixai providing quality services' }}",
      "url": "{{ route('provider.profile', ['slug' => $provider->slug]) }}",
      "image": "{{ $provider->profile_photo ? asset($provider->profile_photo) : asset('images/default-profile.jpg') }}",
      "inLanguage": "en"
      @if(isset($reviewCount) && $reviewCount > 0)
      ,
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $avgRating }}",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "{{ $reviewCount }}"
      }
      @endif
    }
    </script>
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ProfilePage",
      "name": "{{ $provider->first_name }} {{ $provider->last_name }} - Professional Helper Profile",
      "description": "Professional helper profile on Ulixai. Verified, trusted, and ready to help.",
      "url": "{{ route('provider.profile', ['slug' => $provider->slug]) }}",
      "inLanguage": "en",
      "isPartOf": {
        "@type": "WebSite",
        "name": "Ulixai",
        "url": "{{ config('app.url') }}"
      },
      "mainEntity": {
        "@type": "Person",
        "name": "{{ $provider->first_name }} {{ $provider->last_name }}"
      }
    }
    </script>
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ config('app.url') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Providers",
          "item": "{{ config('app.url') }}/providers"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ $provider->first_name }} {{ $provider->last_name }}",
          "item": "{{ route('provider.profile', ['slug' => $provider->slug]) }}"
        }
      ]
    }
    </script>
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Ulixai",
      "url": "{{ config('app.url') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "sameAs": [
        "https://facebook.com/ulixai",
        "https://twitter.com/ulixai",
        "https://linkedin.com/company/ulixai",
        "https://instagram.com/ulixai"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer support",
        "availableLanguage": ["en", "fr", "de", "es", "pt", "ar", "ru", "zh", "hi"]
      }
    }
    </script>

    <style>
        /* CLASSES ULTRA-SPÉCIFIQUES POUR ÉVITER TOUS LES CONFLITS */
        
        /* Wrapper principal - NE PAS toucher au body */
        .provider-profile-page-wrapper {
            background: linear-gradient(145deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 1rem;
        }

        .provider-profile-main-container {
            max-width: 72rem;
            margin: 2rem auto 0;
        }

        .provider-profile-flex-layout {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .provider-profile-flex-layout {
                flex-direction: row;
            }
        }

        /* SIDEBAR */
        .provider-profile-sidebar {
            flex: 1;
            min-width: 0;
        }

        .provider-profile-sidebar-card {
            background: linear-gradient(145deg, #ffffff 0%, #fafbff 100%);
            border-radius: 28px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        .provider-profile-sidebar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #0066FF 0%, #00D9FF 33%, #7C3AED 66%, #EC4899 100%);
            background-size: 300% 100%;
            animation: provider-gradient-flow 6s ease infinite;
        }

        @keyframes provider-gradient-flow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .provider-profile-image-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 1.5rem;
        }

        .provider-profile-image-wrapper::before {
            content: '';
            position: absolute;
            inset: -10px;
            background: conic-gradient(from 0deg, #0066FF, #00D9FF, #7C3AED, #EC4899, #FF1744, #0066FF);
            border-radius: 50%;
            animation: provider-spin-gradient 6s linear infinite;
        }

        @keyframes provider-spin-gradient {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .provider-profile-image {
            position: relative;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid white;
            overflow: hidden;
            background: white;
            box-shadow: 0 12px 32px rgba(0, 102, 255, 0.3);
            z-index: 1;
            cursor: pointer;
        }

        .provider-profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .provider-profile-image:hover img {
            transform: scale(1.1);
        }

        .provider-profile-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: linear-gradient(135deg, #00E676 0%, #00C853 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
            margin-top: 1rem;
            box-shadow: 0 6px 20px rgba(0, 230, 118, 0.4);
        }

        .provider-profile-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            margin-top: 1.25rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: #0066FF;
        }

        .provider-profile-rating i {
            color: #FFD700;
            font-size: 1.75rem;
        }

        .provider-profile-member-since {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 3px solid #E2E8F0;
        }

        .provider-profile-service-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-height: 48px;
            padding: 1.125rem 1.25rem;
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            border-radius: 16px;
            border: 2.5px solid #3385FF;
            margin: 0.875rem 0;
            transition: all 0.3s;
            cursor: pointer;
        }

        .provider-profile-service-item:hover {
            transform: translateX(4px);
        }

        .provider-profile-service-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0066FF 0%, #00D9FF 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .provider-profile-btn-cta {
            width: 100%;
            min-height: 56px;
            background: linear-gradient(135deg, #FF1744 0%, #D50000 100%);
            color: white;
            font-weight: 800;
            font-size: 1.125rem;
            border-radius: 18px;
            border: none;
            cursor: pointer;
            margin-top: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s;
        }

        .provider-profile-btn-cta:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 32px rgba(255, 23, 68, 0.4);
        }

        /* CONTENT */
        .provider-profile-content {
            flex: 2;
            min-width: 0;
        }

        .provider-profile-content-card {
            background: white;
            border-radius: 28px;
            padding: 1.75rem;
            position: relative;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        .provider-profile-content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #0066FF 0%, #7C3AED 50%, #EC4899 100%);
            border-radius: 28px 28px 0 0;
        }

        .provider-profile-name {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #0066FF 0%, #7C3AED 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
        }

        .provider-profile-description-box {
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border-radius: 20px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border: 2.5px solid #E2E8F0;
        }

        .provider-profile-status-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 2.5px solid #E2E8F0;
            margin-bottom: 1.5rem;
        }

        .provider-profile-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border-radius: 14px;
            border: 2.5px solid #FFB300;
            font-weight: 700;
            font-size: 0.875rem;
            color: #78350F;
            margin: 0.5rem 0.5rem 0 0;
        }

        /* FILTER SECTION */
        .provider-profile-filter-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
            border-radius: 20px;
            border: 2.5px solid #0066FF;
        }

        .provider-profile-filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .provider-profile-filter-label {
            font-weight: 700;
            color: #1E293B;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .provider-profile-filter-dropdown-wrapper {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .provider-profile-filter-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 48px;
            padding: 0 1.25rem;
            background: white;
            border: 2.5px solid #0066FF;
            border-radius: 14px;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #0066FF;
            cursor: pointer;
            transition: all 0.3s;
        }

        .provider-profile-filter-btn:hover {
            background: #0066FF;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
        }

        .provider-profile-filter-dropdown {
            position: absolute;
            top: calc(100% + 0.75rem);
            left: 0;
            right: 0;
            background: white;
            border: 2.5px solid #0066FF;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            z-index: 100;
            overflow: hidden;
            display: none;
        }

        .provider-profile-filter-dropdown.show {
            display: block;
            animation: provider-slideDown 0.3s ease;
        }

        @keyframes provider-slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .provider-profile-filter-dropdown button {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            width: 100%;
            min-height: 48px;
            padding: 0 1.25rem;
            background: white;
            border: none;
            font-size: 0.9375rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
        }

        .provider-profile-filter-dropdown button:hover {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #0066FF;
        }

        .provider-profile-filter-dropdown button i {
            width: 20px;
            text-align: center;
        }

        .provider-profile-results-count {
            padding: 0.625rem 1.125rem;
            background: linear-gradient(135deg, #0066FF 0%, #00D9FF 100%);
            color: white;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 6px 16px rgba(0, 102, 255, 0.35);
            white-space: nowrap;
        }

        .provider-profile-review-card {
            display: flex;
            gap: 1rem;
            background: white;
            border: 2.5px solid #E2E8F0;
            border-radius: 20px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .provider-profile-review-card:hover {
            border-color: #0066FF;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 102, 255, 0.15);
        }

        .provider-profile-review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid #3385FF;
            flex-shrink: 0;
            object-fit: cover;
        }

        .provider-profile-star-yellow {
            color: #FFD700;
        }

        /* STYLES POUR POPUP - SCOPÉS */
        .provider-profile-page-wrapper .star {
            cursor: pointer;
            font-size: 1.5rem;
            color: #d1d5db;
        }
        
        .provider-profile-page-wrapper .loader {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #0066FF;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: provider-spin 1s linear infinite;
        }
        
        @keyframes provider-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .provider-profile-page-wrapper .social-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #fff;
            font-size: 1.25rem;
            transition: transform 0.2s;
            box-shadow: 0 2px 8px 0 rgba(59, 130, 246, 0.07);
            border: none;
            outline: none;
        }
        
        .provider-profile-page-wrapper .social-btn:hover {
            transform: scale(1.13) rotate(-6deg);
            box-shadow: 0 4px 16px 0 rgba(59, 130, 246, 0.18);
            filter: brightness(1.08);
        }
        
        .provider-profile-page-wrapper .photo-upload-box {
            min-width: 140px;
            min-height: 140px;
        }
        
        .provider-profile-page-wrapper .group:hover .border-blue-200 {
            border-color: #2563eb !important;
        }
        
        .provider-profile-page-wrapper .urgency-btn.selected {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
        
        .provider-profile-page-wrapper .urgency-btn.selected .urgency-radio {
            background: #fff;
            border: 2px solid #fff;
            box-shadow: 0 0 0 4px #2563eb;
        }
        
        .provider-profile-page-wrapper .urgency-btn .urgency-radio {
            border: 2px solid #2563eb;
        }
        
        .provider-profile-page-wrapper .lang-btn.selected,
        .provider-profile-page-wrapper .lang-btn:active {
            background: #1e40af !important;
            color: #fff !important;
            border-color: #1e40af !important;
        }

        .provider-profile-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            backdrop-filter: blur(8px);
        }

        .provider-profile-modal.show {
            display: flex;
        }

        .provider-profile-modal-content {
            position: relative;
            animation: provider-zoomIn 0.3s ease;
        }

        @keyframes provider-zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .provider-profile-modal-close {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .provider-profile-modal-close:hover {
            background: #FF1744;
            color: white;
            transform: rotate(90deg);
        }

        .provider-profile-modal-image {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .provider-profile-no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: #94A3B8;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .provider-profile-spacer {
            padding-bottom: 3rem;
        }

        @media (max-width: 640px) {
            .provider-profile-name {
                font-size: 1.5rem;
            }
            .provider-profile-page-wrapper {
                padding: 0.5rem;
            }
            .provider-profile-sidebar-card,
            .provider-profile-content-card {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    
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

    @include('includes.header')
    @include('wizards.requester.steps.popup_request_help')

    @php
        $reviews = \App\Models\ProviderReview::where('provider_id', $provider->id ?? 0)->with('user')->latest()->get();
        $reviewCount = $reviews->count();
        $avgRating = $reviewCount ? round($reviews->avg('rating'), 2) : 5;
        $isProviderSelf = (auth()->check() && $provider->user_id == auth()->id());
        $shareUrl = route('provider.profile', ['slug' => $provider->slug]);
    @endphp

    <div class="provider-profile-page-wrapper">
        
        
        <!-- 🔥🔥🔥 VIRAL SHARE COMPONENT - FLOATING BUTTON + SLIDE PANEL 🔥🔥🔥 -->
        
        <!-- 💰 FLOATING BUTTON - Bottom Right -->
        <button id="floatingShareBtn" onclick="openSharePanel()" class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-green-400 to-emerald-500 hover:from-green-500 hover:to-emerald-600 text-white font-bold px-6 py-4 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center gap-3 group animate-pulse hover:animate-none">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
            </svg>
            <span class="hidden sm:inline">Share & Earn</span>
            <span class="sm:hidden">Share</span>
            <span class="ml-1">💰</span>
        </button>

        <!-- 🎨 OVERLAY (Dark background when panel is open) -->
        <div id="shareOverlay" onclick="closeSharePanel()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300"></div>

        <!-- 📱 SLIDE PANEL (from right) -->
        <div id="sharePanel" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 overflow-y-auto">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-6 sticky top-0 z-10">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-white font-bold text-xl flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                        Share & Earn
                    </h2>
                    <button onclick="closeSharePanel()" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                @auth
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white">
                        <p class="text-sm font-semibold mb-1">Your affiliate code</p>
                        <p class="text-lg font-bold font-mono tracking-wider">{{ Auth::user()->affiliate_code }}</p>
                    </div>
                @else
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white text-sm">
                        <p class="font-semibold mb-2">🎁 Create a free account</p>
                        <p class="text-xs opacity-90 mb-3">Get your affiliate link and earn money!</p>
                        <a href="/signup" class="block w-full bg-white text-green-600 font-bold py-2 px-4 rounded-lg text-center hover:bg-green-50 transition-colors">
                            Sign Up Now
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Share Buttons -->
            <div class="p-6">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    Share Now
                </h3>

                <!-- Grid 2 colonnes -->
                <div class="grid grid-cols-2 gap-3">
                    
                    <!-- WhatsApp -->
                    <a id="shareWhatsAppSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 rounded-xl p-4 border-2 border-green-200 hover:border-green-500 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fab fa-whatsapp text-4xl text-green-600 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-green-700 group-hover:text-white uppercase tracking-wide transition-colors">WhatsApp</span>
                    </a>

                    <!-- Messenger -->
                    <a id="shareMessengerSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-400 hover:to-blue-500 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-400 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fab fa-facebook-messenger text-4xl text-blue-500 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-blue-600 group-hover:text-white uppercase tracking-wide transition-colors">Messenger</span>
                    </a>

                    <!-- Facebook -->
                    <a id="shareFacebookSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-500 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fab fa-facebook text-4xl text-blue-600 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">Facebook</span>
                    </a>

                    <!-- Twitter -->
                    <a id="shareTwitterSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-800 hover:to-black rounded-xl p-4 border-2 border-gray-200 hover:border-gray-800 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fab fa-x-twitter text-4xl text-gray-800 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-white uppercase tracking-wide transition-colors">Twitter</span>
                    </a>

                    <!-- LinkedIn -->
                    <a id="shareLinkedInSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-600 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fab fa-linkedin text-4xl text-blue-600 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">LinkedIn</span>
                    </a>

                    <!-- Email -->
                    <a id="shareEmailSlide" href="#" class="bg-gradient-to-br from-red-50 to-red-100 hover:from-red-500 hover:to-red-600 rounded-xl p-4 border-2 border-red-200 hover:border-red-500 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fas fa-envelope text-4xl text-red-600 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-red-700 group-hover:text-white uppercase tracking-wide transition-colors">Email</span>
                    </a>

                    <!-- Copy Link -->
                    <button id="copyBtnSlide" class="bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-xl p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-2 transition-all duration-200 group">
                        <i class="fas fa-link text-4xl text-purple-600 group-hover:text-white transition-colors"></i>
                        <span class="text-sm font-bold text-purple-700 group-hover:text-white uppercase tracking-wide transition-colors">Copy</span>
                    </button>

                </div>

                <!-- Bottom Message -->
                <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border-2 border-green-200">
                    <div class="flex items-center gap-3 text-green-700">
                        <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                        <div class="flex-1">
                            <p class="font-bold text-sm">
                                @auth
                                    Earn € or $ for each share!
                                @else
                                    Create an account to earn money
                                @endauth
                            </p>
                            <p class="text-xs text-green-600 mt-1">Every person who clicks your link counts!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🎉 SUCCESS POPUP -->
        <div id="shareSuccessPopup" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-95 opacity-0" id="popupContent">
                <div class="text-center mb-4">
                    <div class="inline-block bg-gradient-to-br from-green-400 to-emerald-500 rounded-full p-4 mb-3 animate-bounce">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Awesome! 🎉</h3>
                    <p class="text-gray-600 text-sm">You're helping someone find the perfect helper!</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 mb-4 border-2 border-green-200">
                    <div class="flex items-center justify-center mb-2">
                        <span class="text-lg font-bold text-green-600 text-center">Share and earn 75% affiliate commission</span>
                    </div>
                    <div class="h-2 bg-green-200 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-green-400 to-emerald-500 rounded-full animate-pulse" style="width: 75%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">💡 Each signup via your link earns you rewards!</p>
                </div>
                <div class="space-y-2">
                    <button onclick="shareAgain()" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                        Share Again & Earn More 💰
                    </button>
                    <button onclick="closeSharePopup()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-6 rounded-xl transition-all">
                        Close
                    </button>
                </div>
            </div>
        </div>
        
        <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes shimmer { 100% { transform: translateX(100%); } }
        .animate-shimmer { animation: shimmer 3s infinite; }
        </style>
        
        @auth
        <input type="text" id="affiliateLinkShareNew" value="{{ route('provider.profile', ['slug' => $provider->slug]) }}?ref={{ Auth::user()->affiliate_code }}" hidden>
        @else
        <input type="text" id="affiliateLinkShareNew" value="{{ route('provider.profile', ['slug' => $provider->slug]) }}" hidden>
        @endauth
        
        <script>
        // VIRAL SHARE SYSTEM - Slide Panel Version
        document.addEventListener('DOMContentLoaded', function() {
            'use strict';
            
            // Global functions for panel control
            window.openSharePanel = function() {
                const panel = document.getElementById('sharePanel');
                const overlay = document.getElementById('shareOverlay');
                const floatingBtn = document.getElementById('floatingShareBtn');
                
                if (overlay) {
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.add('opacity-100'), 10);
                }
                if (panel) {
                    panel.classList.remove('translate-x-full');
                }
                if (floatingBtn) {
                    floatingBtn.style.display = 'none';
                }
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
                
                console.log('✅ Share panel opened');
            };
            
            window.closeSharePanel = function() {
                const panel = document.getElementById('sharePanel');
                const overlay = document.getElementById('shareOverlay');
                const floatingBtn = document.getElementById('floatingShareBtn');
                
                if (panel) {
                    panel.classList.add('translate-x-full');
                }
                if (overlay) {
                    overlay.classList.remove('opacity-100');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
                if (floatingBtn) {
                    setTimeout(() => floatingBtn.style.display = 'flex', 300);
                }
                // Re-enable body scroll
                document.body.style.overflow = '';
                
                console.log('✅ Share panel closed');
            };
            
            window.showShareSuccessPopup = function() {
                const popup = document.getElementById('shareSuccessPopup');
                const content = document.getElementById('popupContent');
                if (popup && content) {
                    popup.classList.remove('hidden');
                    popup.classList.add('flex');
                    setTimeout(() => {
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                    console.log('✅ Success popup shown');
                }
            };
            
            window.closeSharePopup = function() {
                const popup = document.getElementById('shareSuccessPopup');
                const content = document.getElementById('popupContent');
                if (popup && content) {
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        popup.classList.remove('flex');
                        popup.classList.add('hidden');
                    }, 200);
                    console.log('✅ Success popup closed');
                }
            };
            
            window.shareAgain = function() {
                closeSharePopup();
                setTimeout(() => openSharePanel(), 300);
            };
            
            // Get share URL with UTM
            function getShareUrl() {
                const input = document.getElementById('affiliateLinkShareNew');
                if (!input) return window.location.href;
                
                let shareUrl = input.value;
                try {
                    const urlObj = new URL(shareUrl, window.location.origin);
                    urlObj.searchParams.set('utm_source', 'social');
                    urlObj.searchParams.set('utm_medium', 'share');
                    urlObj.searchParams.set('utm_campaign', 'referral');
                    shareUrl = urlObj.toString();
                } catch (e) {
                    console.error('UTM error:', e);
                }
                return shareUrl;
            }
            
            const finalUrl = getShareUrl();
            const enc = encodeURIComponent(finalUrl);
            
            // Viral messages (English)
            const viralText = encodeURIComponent(`🌟 I found an amazing local/expat helper!\n\n👉 Check out their profile:\n\n💡 Need help abroad? Perfect!\n🚀 Want to help & earn money? Join us!\n\nShare this with your network! 💰`);
            const subject = encodeURIComponent("🎯 Amazing Local/Expat Helper - Check This Out!");
            const viralEmailBody = encodeURIComponent(`Hi! 👋\n\nI found this incredible local/expat helper that might interest you:\n\n${finalUrl}\n\nWhether you're looking to:\n✅ Get help abroad\n✅ Become a helper and earn money\n\nCheck out their profile!\n\n---\n💡 TIP: Share this profile with your network and earn rewards! 💰`);
            
            // Social share links for slide panel
            const socialLinks = {
                shareWhatsAppSlide: `https://api.whatsapp.com/send?text=${viralText}%20${enc}`,
                shareMessengerSlide: `fb-messenger://share/?link=${enc}`,
                shareFacebookSlide: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
                shareTwitterSlide: `https://twitter.com/intent/tweet?url=${enc}&text=${viralText}`,
                shareLinkedInSlide: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
                shareEmailSlide: `mailto:?subject=${subject}&body=${viralEmailBody}`
            };
            
            // Apply links to buttons
            Object.entries(socialLinks).forEach(([id, href]) => {
                const link = document.getElementById(id);
                if (link) {
                    link.href = href;
                    console.log(`✅ Link set for ${id}`);
                }
            });
            
            // Copy button setup
            const copyBtn = document.getElementById('copyBtnSlide');
            if (copyBtn) {
                copyBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    navigator.clipboard.writeText(finalUrl).then(() => {
                        const originalHTML = copyBtn.innerHTML;
                        
                        copyBtn.className = 'bg-green-500 rounded-xl p-4 border-2 border-green-500 flex flex-col items-center gap-2 transition-all duration-200';
                        copyBtn.innerHTML = `
                            <i class="fas fa-check text-4xl text-white"></i>
                            <span class="text-sm font-bold text-white uppercase tracking-wide">Copied!</span>
                        `;
                        
                        if (typeof toastr !== 'undefined') {
                            toastr.success('✅ Link copied! 🚀');
                        }
                        
                        // Show success popup after copy
                        setTimeout(() => {
                            closeSharePanel();
                            showShareSuccessPopup();
                        }, 800);
                        
                        setTimeout(() => {
                            copyBtn.className = 'bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-xl p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-2 transition-all duration-200 group';
                            copyBtn.innerHTML = originalHTML;
                        }, 1500);
                        
                    }).catch(() => {
                        if (typeof toastr !== 'undefined') {
                            toastr.error('😅 Échec de la copie, réessayez !');
                        }
                    });
                });
            }
            
            // Show popup ONLY after clicking a share button (not the floating button)
            const shareButtons = document.querySelectorAll('a[id^="share"]');
            shareButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    console.log('🚀 Share button clicked:', btn.id);
                    
                    // Let the link open (don't prevent default)
                    // Then show popup and close panel after a short delay
                    setTimeout(() => {
                        closeSharePanel();
                        showShareSuccessPopup();
                    }, 800);
                });
            });
            
            // Close popup when clicking outside
            const popup = document.getElementById('shareSuccessPopup');
            if (popup) {
                popup.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        closeSharePopup();
                    }
                });
            }
            
            console.log('✅ Viral share system (slide panel) initialized!');
        });
        </script>
        
        <!-- 🔥🔥🔥 FIN DU COMPOSANT VIRAL 🔥🔥🔥 -->
        
            <div class="provider-profile-flex-layout">
                
                <!-- SIDEBAR -->
                <div class="provider-profile-sidebar">
                    <div class="provider-profile-sidebar-card">
                        <div style="text-align: center;">
                            <div class="provider-profile-image-wrapper">
                                <button id="profileImgBtn" class="provider-profile-image" style="border: none; background: none; padding: 0;">
                                    @if(isset($provider) && $provider->profile_photo)
                                        <img loading="lazy" src="{{ asset($provider->profile_photo) }}" alt="Profile">
                                    @else
                                        <img loading="lazy" src="https://i.pravatar.cc/300?img=3" alt="Profile">
                                    @endif
                                </button>
                            </div>
                            
                            <div class="provider-profile-verified-badge">
                                <i class="fas fa-check-circle"></i>
                                <span>Profile verified</span>
                            </div>
                            
                            <div class="provider-profile-rating">
                                <i class="fas fa-star"></i>
                                <span>{{ number_format($avgRating, 1) }} / 5</span>
                            </div>
                        </div>
                        
                        <div class="provider-profile-member-since">
                            @if(isset($provider) && $provider->user && $provider->user->created_at)
                                ULYSSE SINCE {{ strtoupper($provider->user->created_at->diffForHumans(null, true)) }}
                            @else
                                ULYSSE SINCE 3 MONTHS
                            @endif
                        </div>
                        
                        @php
                            $services = $provider->services_to_offer ? json_decode($provider->services_to_offer, true) : [];
                        @endphp

                        @if(is_array($services) && count($services) > 0)
                            @foreach($services as $service)
                                @php
                                    $category = \App\Models\Category::find($service);
                                @endphp
                                @if($category)
                                    <div class="provider-profile-service-item">
                                        <div class="provider-profile-service-icon"><i class="fas fa-briefcase"></i></div>
                                        <span style="font-weight: 700; color: #1E293B;">{{ $category->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="provider-profile-service-item">
                                <div class="provider-profile-service-icon"><i class="fas fa-briefcase"></i></div>
                                <span style="font-weight: 700; color: #94A3B8;">No services listed</span>
                            </div>
                        @endif
                        
                        <button onclick="openHelpPopup()" class="provider-profile-btn-cta">
                            <i class="fas fa-paper-plane"></i>
                            Suggest A Mission
                        </button>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="provider-profile-content">
                    <div class="provider-profile-content-card">
                        
                        <h1 class="provider-profile-name">
                            {{ isset($provider) ? ($provider->first_name . ' ' . $provider->last_name) : 'NAME' }}
                        </h1>
                        <p style="color: #64748B; margin-bottom: 1.5rem; font-weight: 600;">
                            NUMBER OF SERVICES PROVIDED: {{ isset($provider) && isset($provider->services_to_offer) ? (is_array($services) ? count($services) : 1) : 0 }}
                        </p>
                        
                        <div class="provider-profile-description-box">
                            <p style="color: #334155; line-height: 1.75;">
                                {{ $provider->profile_description ?? 'A few words presentation of the Ulysse...' }}
                            </p>
                        </div>
                        
                        <div class="provider-profile-status-section">
                            <p style="font-weight: 700; color: #1E293B; margin-bottom: 1rem;">Special Status</p>
                            <div>
                                @php
                                    $specialStatus = $provider->special_status ?? [];
                                    if (is_string($specialStatus)) {
                                        $decoded = json_decode($specialStatus, true);
                                        $specialStatus = is_array($decoded) ? $decoded : [];
                                    }
                                @endphp
                                @if($specialStatus && count($specialStatus) > 0)
                                    @foreach($specialStatus as $status => $val)
                                        @if($val)
                                        <div class="provider-profile-status-badge">
                                            <i class="fas fa-certificate"></i>
                                            <span>{{ $status }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="provider-profile-status-badge">
                                        <i class="fas fa-certificate"></i>
                                        <span>No special status</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        
                        <!-- LANGUAGES SPOKEN SECTION -->
                        @if(isset($provider->spoken_language) && $provider->spoken_language)
                        <div style="background: white; border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <p style="font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-language" style="color: #0066FF;"></i>
                                Languages Spoken
                            </p>
                            
                            <div style="line-height: 2;">
                                @php
                                    if (is_string($provider->spoken_language)) {
                                        $languages = json_decode($provider->spoken_language, true);
                                    } else {
                                        $languages = $provider->spoken_language;
                                    }
                                    if (!is_array($languages)) {
                                        $languages = [$provider->spoken_language];
                                    }
                                @endphp
                                
                                @foreach($languages as $language)
                                <span style="color: #2563EB; font-weight: 600; font-size: 0.9375rem; margin-right: 1rem; white-space: nowrap;">
                                    <i class="fas fa-comments" style="margin-right: 0.25rem;"></i>{{ $language }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- COUNTRIES OF INTERVENTION SECTION -->
                        @if(isset($provider->operational_countries) && $provider->operational_countries)
                        <div style="background: white; border-radius: 20px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <p style="font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-globe-americas" style="color: #16A34A;"></i>
                                Countries of Intervention
                            </p>
                            
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                @php
                                    if (is_string($provider->operational_countries)) {
                                        $countries = json_decode($provider->operational_countries, true);
                                    } else {
                                        $countries = $provider->operational_countries;
                                    }
                                    if (!is_array($countries)) {
                                        $countries = [$provider->operational_countries];
                                    }
                                @endphp
                                
                                @foreach($countries as $country)
                                <div style="
                                    background: transparent;
                                    border: 2px solid #BBF7D0;
                                    border-radius: 12px;
                                    padding: 0.5rem 1rem;
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                ">
                                    <i class="fas fa-map-marker-alt" style="color: #16A34A;"></i>
                                    <span style="font-weight: 600; color: #166534; font-size: 0.9375rem;">{{ $country }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

<!-- FILTER SECTION -->
                        <div class="provider-profile-filter-section">
                            <div class="provider-profile-filter-header">
                                <span class="provider-profile-filter-label">
                                    <i class="fas fa-filter"></i>
                                    Filter by:
                                </span>
                                
                                <div class="provider-profile-filter-dropdown-wrapper">
                                    <button id="filter-dropdown-btn" onclick="toggleDropdown()" class="provider-profile-filter-btn">
                                        <span id="selected-filter">All Reviews</span>
                                        <i class="fas fa-chevron-down" id="dropdown-arrow"></i>
                                    </button>
                                    
                                    <div id="filter-dropdown" class="provider-profile-filter-dropdown">
                                        <button onclick="selectFilter('all', 'All Reviews')">
                                            <i class="fas fa-list"></i>
                                            All Reviews
                                        </button>
                                        <button onclick="selectFilter('newest', 'Newest First')">
                                            <i class="fas fa-clock"></i>
                                            Newest First
                                        </button>
                                        <button onclick="selectFilter('oldest', 'Oldest First')">
                                            <i class="fas fa-history"></i>
                                            Oldest First
                                        </button>
                                        <button onclick="selectFilter('high_rating', 'High Rating (4-5 ⭐)')">
                                            <i class="fas fa-star"></i>
                                            High Rating (4-5 ⭐)
                                        </button>
                                        <button onclick="selectFilter('low_rating', 'Low Rating (1-3 ⭐)')">
                                            <i class="fas fa-star-half-alt"></i>
                                            Low Rating (1-3 ⭐)
                                        </button>
                                    </div>
                                </div>

                                <span id="results-count" class="provider-profile-results-count">Showing {{ count($reviews) }} reviews</span>
                            </div>
                        </div>

                        <h3 style="font-weight: 800; color: #1E293B; margin-bottom: 1rem;">
                            <i class="fas fa-comments" style="color: #0066FF; margin-right: 0.5rem;"></i>
                            Client Reviews
                        </h3>
                        
                        <!-- REVIEWS CONTAINER -->
                        <div id="reviews-container">
                            @forelse($reviews as $review)
                            <div class="provider-profile-review-card review-item" 
                                data-rating="{{ $review->rating }}" 
                                data-date="{{ $review->created_at->timestamp }}">
                                @if($review->user && $review->user->profile_photo)
                                    <img loading="lazy" src="{{ asset($review->user->profile_photo) }}" alt="User" class="provider-profile-review-avatar">
                                @else
                                    <img loading="lazy" src="{{ asset('images/helpexpat.webp') }}" alt="User" class="provider-profile-review-avatar">
                                @endif
                                <div style="flex: 1;">
                                    <div style="font-weight: 800; color: #0066FF; margin-bottom: 0.5rem;">
                                        {{ $review->user->name ?? 'User' }}
                                        <span style="color: #94A3B8; font-size: 0.8125rem; margin-left: 0.5rem;">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div style="color: #FFD700; margin: 0.5rem 0;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'provider-profile-star-yellow' : '' }}" style="{{ $i > $review->rating ? 'color: #D1D5DB;' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <p style="color: #475569; line-height: 1.65;">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="provider-profile-no-results" id="no-reviews-message">
                                <i class="fas fa-comment-slash" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                No reviews yet.
                            </div>
                            @endforelse
                        </div>

                        <!-- NO RESULTS MESSAGE -->
                        <div id="no-results-message" class="provider-profile-no-results" style="display: none;">
                            <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                            No reviews match the selected filter.
                        </div>

                        <!-- SPACER -->
                        <div class="provider-profile-spacer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR ENLARGED PROFILE IMAGE -->
    <div id="profileImgModal" class="provider-profile-modal">
        <div class="provider-profile-modal-content">
            <button id="closeProfileImgModal" class="provider-profile-modal-close">
                <i class="fas fa-times" style="font-size: 1.25rem;"></i>
            </button>
            @if(isset($provider) && $provider->profile_photo)
                <img loading="lazy" src="{{ asset($provider->profile_photo) }}" alt="Profile Large" class="provider-profile-modal-image">
            @else
                <img loading="lazy" src="https://i.pravatar.cc/300?img=3" alt="Profile Large" class="provider-profile-modal-image">
            @endif
        </div>
    </div>

    <script>
        // PROFILE IMAGE MODAL
        document.getElementById('profileImgBtn').addEventListener('click', function() {
            document.getElementById('profileImgModal').classList.add('show');
        });

        document.getElementById('closeProfileImgModal').addEventListener('click', function() {
            document.getElementById('profileImgModal').classList.remove('show');
        });

        document.getElementById('profileImgModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });

        // FILTER DROPDOWN
        function toggleDropdown() {
            const dropdown = document.getElementById('filter-dropdown');
            const arrow = document.getElementById('dropdown-arrow');
            
            dropdown.classList.toggle('show');
            arrow.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        function selectFilter(filterType, filterLabel) {
            document.getElementById('selected-filter').textContent = filterLabel;
            document.getElementById('filter-dropdown').classList.remove('show');
            document.getElementById('dropdown-arrow').style.transform = 'rotate(0deg)';
            
            filterReviews(filterType);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('filter-dropdown');
            const button = document.getElementById('filter-dropdown-btn');
            
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.remove('show');
                document.getElementById('dropdown-arrow').style.transform = 'rotate(0deg)';
            }
        });

        function filterReviews(filterType) {
            const reviewItems = document.querySelectorAll('.review-item');
            const resultsCount = document.getElementById('results-count');
            const noResultsMessage = document.getElementById('no-results-message');
            const noReviewsMessage = document.getElementById('no-reviews-message');
            
            let visibleCount = 0;
            const reviewsArray = Array.from(reviewItems);
            
            switch(filterType) {
                case 'all':
                    reviewItems.forEach(item => {
                        item.style.display = 'flex';
                        visibleCount++;
                    });
                    break;
                    
                case 'newest':
                    reviewsArray.sort((a, b) => 
                        parseInt(b.dataset.date) - parseInt(a.dataset.date)
                    );
                    reorderAndShow(reviewsArray);
                    visibleCount = reviewsArray.length;
                    break;
                    
                case 'oldest':
                    reviewsArray.sort((a, b) => 
                        parseInt(a.dataset.date) - parseInt(b.dataset.date)
                    );
                    reorderAndShow(reviewsArray);
                    visibleCount = reviewsArray.length;
                    break;
                    
                case 'high_rating':
                    reviewItems.forEach(item => {
                        const rating = parseInt(item.dataset.rating);
                        if (rating >= 4) {
                            item.style.display = 'flex';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    break;
                    
                case 'low_rating':
                    reviewItems.forEach(item => {
                        const rating = parseInt(item.dataset.rating);
                        if (rating <= 3) {
                            item.style.display = 'flex';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    break;
            }
            
            resultsCount.textContent = `Showing ${visibleCount} reviews`;
            
            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
                if (noReviewsMessage) {
                    noReviewsMessage.style.display = 'none';
                }
            } else {
                noResultsMessage.style.display = 'none';
                if (noReviewsMessage) {
                    noReviewsMessage.style.display = 'none';
                }
            }
        }

        function reorderAndShow(sortedArray) {
            const container = document.getElementById('reviews-container');
            
            sortedArray.forEach(item => {
                container.removeChild(item);
            });
            
            sortedArray.forEach(item => {
                item.style.display = 'flex';
                container.appendChild(item);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const initialCount = document.querySelectorAll('.review-item').length;
            document.getElementById('results-count').textContent = `Showing ${initialCount} reviews`;
        });

        // STARS HANDLER FOR POPUP
        const stars = document.querySelectorAll('.star');
        
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const currentRating = this.getAttribute('data-index');
                stars.forEach(s => {
                    s.classList.remove('provider-profile-star-yellow');
                    if (s.getAttribute('data-index') <= currentRating) {
                        s.classList.add('provider-profile-star-yellow');
                    }
                });
            });

            star.addEventListener('mouseleave', function() {
                stars.forEach(s => s.classList.remove('provider-profile-star-yellow'));
                const selectedRating = document.querySelector('input[name="rating"]:checked');
                if (selectedRating) {
                    stars.forEach(s => {
                        if (s.getAttribute('data-index') <= selectedRating.value) {
                            s.classList.add('provider-profile-star-yellow');
                        }
                    });
                }
            });

            star.addEventListener('click', function() {
                const selectedRating = this.getAttribute('data-index');
                const ratingInput = document.querySelector('input[name="rating"][value="' + selectedRating + '"]');
                if (ratingInput) {
                    ratingInput.checked = true;
                }
            });
        });
    </script>
</body>
</html>