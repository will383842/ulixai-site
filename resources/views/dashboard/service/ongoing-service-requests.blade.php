<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- SEO Meta Tags --}}
    <title>Browse Active Service Requests | Find Your Next Project | {{ config('app.name') }}</title>
    <meta name="description" content="Discover {{ isset($missions) ? count($missions) : '100+' }} active service requests across 197 countries. Connect with clients seeking professional services in education, technology, healthcare, and business.">
    <meta name="keywords" content="service requests, freelance jobs, remote work, international projects, service marketplace, expat services, professional opportunities">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Browse Active Service Requests | Find Your Next Project">
    <meta property="og:description" content="Discover {{ isset($missions) ? count($missions) : '100+' }} active service requests worldwide. Connect with clients seeking professional services.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:image" content="{{ asset('images/og-service-requests.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Service Requests Marketplace">
    <meta property="og:locale" content="en_US">
    
    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Browse Active Service Requests | Find Your Next Project">
    <meta name="twitter:description" content="Discover {{ isset($missions) ? count($missions) : '100+' }} active service requests worldwide.">
    <meta name="twitter:image" content="{{ asset('images/og-service-requests.jpg') }}">
    <meta name="twitter:image:alt" content="Service Requests Marketplace">
    <meta name="twitter:site" content="@{{ config('app.twitter_handle') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    {{-- DNS Prefetch --}}
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    {{-- Stylesheets --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"></noscript>
    
    @php
        use App\Models\Country; 
        $countries = Country::where('status', 1)->pluck('country');
        $languages = [
            'English', 'French', 'Spanish', 'Portuguese', 'German', 
            'Italian', 'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'
        ];
        $totalMissions = isset($missions) ? count($missions) : 0;
    @endphp
    
    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Browse Service Requests",
        "description": "Discover active service requests from clients worldwide",
        "url": "{{ url()->current() }}",
        "inLanguage": "en",
        "isPartOf": {
            "@type": "WebSite",
            "name": "{{ config('app.name') }}",
            "url": "{{ url('/') }}"
        },
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Service Requests",
                    "item": "{{ url()->current() }}"
                }
            ]
        }
    }
    </script>
    
    @if(isset($missions) && count($missions) > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($missions->take(10) as $index => $mission)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "JobPosting",
                    "title": "{{ $mission->title ?? 'Service Request' }}",
                    "description": "{{ Str::limit($mission->description ?? 'Professional service opportunity', 200) }}",
                    "datePosted": "{{ $mission->created_at->toIso8601String() }}",
                    "validThrough": "{{ \Carbon\Carbon::parse($mission->created_at)->addWeeks(4)->toIso8601String() }}",
                    "employmentType": "CONTRACTOR",
                    "hiringOrganization": {
                        "@type": "Organization",
                        "name": "{{ config('app.name') }}"
                    },
                    "jobLocation": {
                        "@type": "Place",
                        "address": {
                            "@type": "PostalAddress",
                            "addressCountry": "{{ $mission->location_country ?? 'Worldwide' }}",
                            "addressLocality": "{{ $mission->location_city ?? '' }}"
                        }
                    },
                    "baseSalary": {
                        "@type": "MonetaryAmount",
                        "currency": "EUR",
                        "value": {
                            "@type": "QuantitativeValue",
                            "minValue": 0,
                            "maxValue": 10000,
                            "unitText": "PROJECT"
                        }
                    }
                }
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
    @endif
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "How do I apply to service requests?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Click the 'See Details' button on any request to view full details and submit your proposal. You'll need to create a free account to apply."
                }
            },
            {
                "@type": "Question",
                "name": "Are these service requests worldwide?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, we feature service requests from clients in 197 countries across all continents. Use our filters to find opportunities in specific locations."
                }
            },
            {
                "@type": "Question",
                "name": "How long do requests stay active?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Requests typically stay active for 1 week to 3 months depending on the client's timeline. Check the 'Expires in' field on each card."
                }
            }
        ]
    }
    </script>
    
    <style>
        :root {
            --color-primary: #2563eb;
            --color-primary-light: #3b82f6;
            --color-secondary: #06b6d4;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger: #ef4444;
            --color-text-primary: #0f172a;
            --color-text-secondary: #64748b;
            --color-text-tertiary: #94a3b8;
            --color-bg-primary: #ffffff;
            --color-bg-secondary: #f8fafc;
            --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* CONTAINER - Mobile First */
        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem;
            min-height: 100vh;
        }
        
        /* HERO HEADER */
        .hero-header {
            text-align: center;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 1.5rem;
            border: 2px solid #93c5fd;
        }
        
        .hero-title {
            font-size: 1.875rem;
            font-weight: 900;
            color: var(--color-text-primary);
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1rem;
            color: var(--color-text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .hero-stats {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 999px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: 2px solid #dbeafe;
        }
        
        .stats-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-text-secondary);
        }
        
        .stats-counter {
            font-size: 1.875rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            min-width: 3ch;
            text-align: center;
        }
        
        .stats-pulse {
            width: 12px;
            height: 12px;
            background: var(--color-success);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        
        /* TRUST SIGNALS */
        .trust-signals {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--color-text-secondary);
        }
        
        .trust-icon {
            color: var(--color-success);
            font-size: 1.125rem;
        }
        
        /* FILTERS - Mobile First */
        .filters-card {
            background: white;
            border-radius: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            border: 2px solid #e5e7eb;
        }
        
        .filters-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--color-text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filters-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-text-primary);
        }
        
        .filter-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            background: white;
            transition: var(--transition-base);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .filter-button {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition-base);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .filter-button:hover,
        .filter-button:focus {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }
        
        .filter-button:active {
            transform: translateY(0);
        }
        
        .filter-button:focus {
            outline: 3px solid rgba(37, 99, 235, 0.5);
            outline-offset: 2px;
        }
        
        /* REQUESTS GRID - MOBILE FIRST RESPONSIVE */
        .requests-grid {
            display: grid;
            grid-template-columns: 1fr; /* 1 colonne sur mobile */
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        
        /* REQUEST CARD */
        .request-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 1.5rem;
            padding: 1.5rem;
            transition: var(--transition-base);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .request-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 0 0 0 100%;
            opacity: 0.3;
            transition: var(--transition-base);
        }
        
        .request-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.15);
            border-color: #93c5fd;
        }
        
        .request-card:hover::before {
            opacity: 0.5;
            transform: scale(1.1);
        }
        
        .request-card-urgent::after {
            content: '';
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 12px;
            height: 12px;
            background: var(--color-danger);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
            z-index: 10;
        }
        
        .request-header {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .request-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        }
        
        .request-content {
            flex: 1;
            min-width: 0;
        }
        
        .request-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--color-text-primary);
            margin-bottom: 0.75rem;
            word-break: break-word;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .request-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: var(--color-text-secondary);
        }
        
        .meta-icon {
            width: 16px;
            height: 16px;
            color: var(--color-primary);
            flex-shrink: 0;
        }
        
        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.75rem;
            background: #dbeafe;
            color: #1e40af;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            width: fit-content;
        }
        
        .category-dot {
            width: 8px;
            height: 8px;
            background: currentColor;
            border-radius: 50%;
        }
        
        /* REQUEST FOOTER - MOBILE FIRST */
        .request-footer {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: stretch;
            padding-top: 1rem;
            border-top: 2px solid #f1f5f9;
            margin-top: auto;
            position: relative;
            z-index: 1;
            gap: 0.75rem;
        }
        
        .requester-info {
            font-size: 0.8125rem;
            color: var(--color-text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .requester-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
        }
        
        .requester-label {
            font-weight: 600;
        }
        
        /* BTN SEE REQUEST - MOBILE FIRST */
        .btn-see-request {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.8125rem;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition-base);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            width: 100%; /* Full width sur mobile */
        }
        
        .btn-see-request:hover,
        .btn-see-request:focus {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }
        
        .btn-see-request:active {
            transform: translateY(0) scale(1);
        }
        
        .btn-see-request:focus {
            outline: 3px solid rgba(37, 99, 235, 0.5);
            outline-offset: 2px;
        }
        
        /* EMPTY STATE */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed #cbd5e1;
            border-radius: 1.5rem;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: var(--color-text-tertiary);
            margin-bottom: 1.5rem;
            opacity: 0.4;
        }
        
        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-text-primary);
            margin-bottom: 0.75rem;
        }
        
        .empty-text {
            font-size: 1rem;
            color: var(--color-text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .empty-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, #1d4ed8 100%);
            color: white;
            text-decoration: none;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: var(--transition-base);
        }
        
        .empty-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }
        
        /* LOADING OVERLAY */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
        }
        
        .loading-overlay.show {
            display: flex;
        }
        
        .loading-spinner {
            width: 64px;
            height: 64px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: white;
            font-size: 1rem;
            font-weight: 600;
        }
        
        /* SCREEN READER ONLY */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        /* RESPONSIVE - TABLET (640px+) */
        @media (min-width: 640px) {
            .page-container {
                padding: 1.5rem;
            }
            
            .hero-header {
                padding: 3rem 2rem;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.125rem;
            }
            
            .filters-card {
                padding: 2rem;
            }
            
            .filters-row {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .filter-button {
                grid-column: 1 / -1;
            }
            
            /* 2 colonnes sur tablet */
            .requests-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            
            .request-card {
                padding: 1.75rem;
            }
            
            .request-footer {
                flex-direction: row;
                align-items: center;
            }
            
            .btn-see-request {
                width: auto; /* Auto width sur desktop */
            }
        }
        
        /* RESPONSIVE - DESKTOP (1024px+) */
        @media (min-width: 1024px) {
            .page-container {
                padding: 2rem;
            }
            
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
            }
            
            .filters-row {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .filter-button {
                grid-column: auto;
            }
            
            /* 3 colonnes sur desktop */
            .requests-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
            
            .request-card {
                padding: 2rem;
            }
        }
        
        /* PRINT STYLES */
        @media print {
            .filters-card,
            .hero-stats,
            .trust-signals,
            .btn-see-request,
            .loading-overlay {
                display: none !important;
            }
            
            .request-card {
                break-inside: avoid;
            }
        }
        
        /* REDUCED MOTION */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* HIGH CONTRAST MODE */
        @media (prefers-contrast: high) {
            .request-card {
                border-width: 3px;
            }
            
            .btn-see-request {
                border: 2px solid white;
            }
        }
    </style>
</head>
<body>
    
    @include('includes.header')
    @include('wizards.requester.steps.popup_request_help')
    
    <main class="page-container" role="main">
        
        {{-- Hero Header with SEO-optimized content --}}
        <header class="hero-header">
            <h1 class="hero-title">Browse Active Service Requests Worldwide</h1>
            <p class="hero-subtitle">
                Connect with clients across 197 countries seeking professional services in education, technology, healthcare, business, and more. Find your next opportunity today.
            </p>
            
            <div class="hero-stats" role="status" aria-live="polite">
                <span class="stats-label">Active Requests:</span>
                <span class="stats-counter" id="missionsCounter" aria-label="{{ $totalMissions }} active requests">{{ $totalMissions }}</span>
                <span class="stats-pulse" aria-hidden="true" title="Live updates"></span>
            </div>
            
            {{-- Trust Signals for SEO --}}
            <div class="trust-signals" aria-label="Platform features">
                <div class="trust-item">
                    <i class="fas fa-check-circle trust-icon" aria-hidden="true"></i>
                    <span>Verified Clients</span>
                </div>
                <div class="trust-item">
                    <i class="fas fa-shield-alt trust-icon" aria-hidden="true"></i>
                    <span>Secure Payments</span>
                </div>
                <div class="trust-item">
                    <i class="fas fa-globe trust-icon" aria-hidden="true"></i>
                    <span>197 Countries</span>
                </div>
                <div class="trust-item">
                    <i class="fas fa-headset trust-icon" aria-hidden="true"></i>
                    <span>24/7 Support</span>
                </div>
            </div>
        </header>
        
        {{-- Filters Section --}}
        <section class="filters-card" aria-labelledby="filters-title">
            <h2 class="filters-title" id="filters-title">
                <i class="fas fa-filter" aria-hidden="true"></i>
                Filter Service Requests
            </h2>
            
            <form id="filterForm" class="filters-row" role="search">
                
                <div class="filter-group">
                    <label for="languageSelect" class="filter-label">Language</label>
                    <select id="languageSelect" 
                            class="filter-select" 
                            aria-label="Filter by language"
                            aria-describedby="language-hint">
                        <option value="">All Languages</option>
                        @foreach($languages as $lang)
                            <option value="{{ $lang }}">{{ $lang }}</option>
                        @endforeach
                    </select>
                    <span id="language-hint" class="sr-only">Select a language to filter requests</span>
                </div>
                
                <div class="filter-group">
                    <label for="countrySelect" class="filter-label">Country</label>
                    <select id="countrySelect" 
                            class="filter-select" 
                            aria-label="Filter by country"
                            aria-describedby="country-hint">
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                    <span id="country-hint" class="sr-only">Select a country to filter requests</span>
                </div>
                
                <div class="filter-group">
                    <label for="categorySelect" class="filter-label">Category</label>
                    <select id="categorySelect" 
                            class="filter-select" 
                            aria-label="Filter by category"
                            aria-describedby="category-hint">
                        <option value="">All Categories</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach  
                    </select>
                    <span id="category-hint" class="sr-only">Select a category to filter requests</span>
                </div>
                
                <div class="filter-group" style="display: none;" id="subcategoryGroup">
                    <label for="subcategorySelect" class="filter-label">Sub-category</label>
                    <select id="subcategorySelect" 
                            class="filter-select" 
                            aria-label="Filter by sub-category"
                            aria-describedby="subcategory-hint">
                        <option value="">All Sub-categories</option>
                    </select>
                    <span id="subcategory-hint" class="sr-only">Select a sub-category to filter requests</span>
                </div>
                
                <button type="button" 
                        id="filterButton" 
                        class="filter-button"
                        aria-label="Apply selected filters">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span>Apply Filters</span>
                </button>
                
            </form>
        </section>
        
        {{-- Requests Grid --}}
        <section class="requests-grid" id="serviceGrid" aria-live="polite" aria-label="Service requests list">
            @if(isset($missions) && count($missions) > 0)
                @foreach($missions as $mission)
                    @php
                        $createdDate = \Carbon\Carbon::parse($mission->created_at);
                        
                        if($mission->service_durition === '1 week') {
                            $endTime = $createdDate->copy()->addWeek();
                        } elseif($mission->service_durition === '2 weeks') {
                            $endTime = $createdDate->copy()->addWeeks(2);
                        } elseif($mission->service_durition === '1 month') {
                            $endTime = $createdDate->copy()->addMonth();
                        } elseif($mission->service_durition === '3 months') {
                            $endTime = $createdDate->copy()->addMonths(3);
                        } else {
                            $endTime = $createdDate->copy()->addWeek();
                        }
                        
                        $remainingDays = \Carbon\Carbon::now()->diffInDays($endTime, false);
                        $remainingDays = max(0, $remainingDays);
                        
                        $isUrgent = ($mission->urgency === 'high' || $remainingDays <= 3);
                        
                        // GDPR: Display only initial + "Demandeur d'aide" (SAFE for any name format)
                        $requesterName = $mission->requester->name ?? 'Anonymous';
                        $requesterInitial = strtoupper(substr($requesterName, 0, 1));
                        $displayName = 'Demandeur d\'aide ' . $requesterInitial . '.';
                    @endphp
                    
                    <article class="request-card {{ $isUrgent ? 'request-card-urgent' : '' }}" 
                             data-mission-id="{{ $mission->id }}"
                             itemscope 
                             itemtype="https://schema.org/JobPosting"
                             aria-label="Service request: {{ $mission->title ?? 'Untitled' }}">
                        
                        <meta itemprop="datePosted" content="{{ $mission->created_at->toIso8601String() }}">
                        <meta itemprop="validThrough" content="{{ $endTime->toIso8601String() }}">
                        <meta itemprop="employmentType" content="CONTRACTOR">
                        
                        <div class="request-header">
                            <div class="request-icon" aria-hidden="true" role="img" aria-label="Service icon">✈️</div>
                            
                            <div class="request-content">
                                <h3 class="request-title" itemprop="title">{{ $mission->title ?? 'Service Request' }}</h3>
                                
                                <div class="request-meta">
                                    <div class="category-badge" role="status">
                                        <span class="category-dot" aria-hidden="true"></span>
                                        <span itemprop="industry">{{ $mission->category->name ?? 'Category' }}</span>
                                    </div>
                                    
                                    @if($mission->subcategory)
                                        <div class="meta-item">
                                            <i class="fas fa-tag meta-icon" aria-hidden="true"></i>
                                            <span>{{ $mission->subcategory->name }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="meta-item" itemprop="jobLocation" itemscope itemtype="https://schema.org/Place">
                                        <i class="fas fa-map-marker-alt meta-icon" aria-hidden="true"></i>
                                        <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                            <span itemprop="addressCountry">{{ $mission->location_country ?? $mission->location_city ?? 'Worldwide' }}</span>
                                        </span>
                                    </div>
                                    
                                    <div class="meta-item">
                                        <i class="fas fa-language meta-icon" aria-hidden="true"></i>
                                        <span itemprop="workLanguage">{{ $mission->language ?? 'Not specified' }}</span>
                                    </div>
                                    
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-times meta-icon" aria-hidden="true"></i>
                                        <span>
                                            <strong>{{ $remainingDays }}</strong> 
                                            {{ $remainingDays === 1 ? 'day' : 'days' }} remaining
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <footer class="request-footer">
                            <div class="requester-info" itemprop="hiringOrganization" itemscope itemtype="https://schema.org/Person">
                                <div class="requester-avatar" aria-hidden="true">{{ $requesterInitial }}</div>
                                <div>
                                    <span class="requester-label">Requested by:</span>
                                    <span itemprop="name">{{ $displayName }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('quote-offer', ['id' => $mission->id]) }}"> 
                               class="btn-see-request"
                               aria-label="View full details and submit proposal for {{ $mission->title ?? 'this request' }}"
                               rel="nofollow">
                                <span>See Details</span>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </footer>
                        
                    </article>
                @endforeach
            @else
                <div class="empty-state" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="empty-title">No Service Requests Found</h2>
                    <p class="empty-text">
                        We couldn't find any requests matching your filters. Try adjusting your search criteria or check back later for new opportunities.
                    </p>
                    <a href="{{ url()->current() }}" class="empty-cta" aria-label="Reset filters and view all requests">
                        <i class="fas fa-redo" aria-hidden="true"></i>
                        <span>View All Requests</span>
                    </a>
                </div>
            @endif
        </section>
        
    </main>
    
    {{-- Loading Overlay --}}
    <aside class="loading-overlay" id="loadingOverlay" role="alert" aria-live="assertive" aria-busy="true">
        <div class="loading-spinner" aria-hidden="true"></div>
        <p class="loading-text">Loading requests...</p>
    </aside>
    
    @include('pages.socialmediacard')
    @include('dashboard.partials.dashboard-mobile-navbar')
    
    {{-- Vanilla JavaScript - NO jQuery or toastr --}}
    <script>
    (function() {
        'use strict';
        
        // Performance: Mark page load
        if (window.performance && window.performance.mark) {
            window.performance.mark('app-init');
        }
        
        // Update counter with animation
        function animateCounter(element, target) {
            const duration = 1200;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 16);
        }
        
        // Initialize counter on load
        document.addEventListener('DOMContentLoaded', function() {
            const counter = document.getElementById('missionsCounter');
            if (counter) {
                const targetCount = parseInt(counter.textContent) || 0;
                counter.textContent = '0';
                setTimeout(() => animateCounter(counter, targetCount), 300);
            }
        });
        
        // Loading overlay management
        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
            announceToScreenReader('Loading requests');
        }
        
        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
        
        // Category change handler - load subcategories
        document.getElementById('categorySelect').addEventListener('change', function() {
            const categoryId = this.value;
            const subcategoryGroup = document.getElementById('subcategoryGroup');
            const subcategorySelect = document.getElementById('subcategorySelect');
            
            if (categoryId) {
                showLoading();
                
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to fetch subcategories');
                        return response.json();
                    })
                    .then(subcategories => {
                        subcategorySelect.innerHTML = '<option value="">All Sub-categories</option>';
                        
                        subcategories.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                        
                        subcategoryGroup.style.display = '';
                        hideLoading();
                        announceToScreenReader(`${subcategories.length} sub-categories loaded`);
                    })
                    .catch(error => {
                        console.error('Error loading subcategories:', error);
                        hideLoading();
                    });
            } else {
                subcategoryGroup.style.display = 'none';
                subcategorySelect.innerHTML = '<option value="">All Sub-categories</option>';
            }
        });
        
        // Filter button handler
        document.getElementById('filterButton').addEventListener('click', function() {
            const categoryId = document.getElementById('categorySelect').value;
            const subcategoryId = document.getElementById('subcategorySelect').value;
            const language = document.getElementById('languageSelect').value;
            const country = document.getElementById('countrySelect').value;
            
            showLoading();
            
            const params = new URLSearchParams({
                category_id: categoryId,
                subcategory_id: subcategoryId,
                language: language,
                country: country
            });
            
            fetch(`/get-missions?${params.toString()}`)
                .then(response => {
                    if (!response.ok) throw new Error('Failed to fetch missions');
                    return response.json();
                })
                .then(missions => {
                    renderMissions(missions);
                    hideLoading();
                    announceToScreenReader(`${missions.length} requests found`);
                })
                .catch(error => {
                    console.error('Error loading missions:', error);
                    hideLoading();
                });
        });
        
        // Render missions dynamically
        function renderMissions(missions) {
            const grid = document.getElementById('serviceGrid');
            grid.innerHTML = '';
            
            if (!missions || missions.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state" role="status">
                        <div class="empty-icon" aria-hidden="true">
                            <i class="fas fa-search"></i>
                        </div>
                        <h2 class="empty-title">No Service Requests Found</h2>
                        <p class="empty-text">
                            We couldn't find any requests matching your filters. Try adjusting your search criteria or check back later for new opportunities.
                        </p>
                        <a href="${window.location.pathname}" class="empty-cta" aria-label="Reset filters and view all requests">
                            <i class="fas fa-redo" aria-hidden="true"></i>
                            <span>View All Requests</span>
                        </a>
                    </div>
                `;
                updateCounter(0);
                return;
            }
            
            missions.forEach(mission => {
                const card = createMissionCard(mission);
                grid.appendChild(card);
            });
            
            updateCounter(missions.length);
        }
        
        // Create mission card element
        function createMissionCard(mission) {
            const article = document.createElement('article');
            article.className = 'request-card';
            article.setAttribute('data-mission-id', mission.id);
            article.setAttribute('itemscope', '');
            article.setAttribute('itemtype', 'https://schema.org/JobPosting');
            
            // Calculate remaining days
            const createdDate = new Date(mission.created_at);
            const endDate = new Date(createdDate);
            
            switch(mission.service_durition) {
                case '1 week': endDate.setDate(endDate.getDate() + 7); break;
                case '2 weeks': endDate.setDate(endDate.getDate() + 14); break;
                case '1 month': endDate.setMonth(endDate.getMonth() + 1); break;
                case '3 months': endDate.setMonth(endDate.getMonth() + 3); break;
                default: endDate.setDate(endDate.getDate() + 7);
            }
            
            const remainingDays = Math.max(0, Math.ceil((endDate - new Date()) / (1000 * 60 * 60 * 24)));
            const isUrgent = mission.urgency === 'high' || remainingDays <= 3;
            
            if (isUrgent) {
                article.classList.add('request-card-urgent');
            }
            
            // GDPR: Display only initial + "Demandeur d'aide" (SAFE for any name format)
            const requesterName = mission.requester?.name || 'Anonymous';
            const requesterInitial = requesterName.charAt(0).toUpperCase();
            const displayName = 'Demandeur d\'aide ' + requesterInitial + '.';
            
            article.innerHTML = `
                <meta itemprop="datePosted" content="${mission.created_at}">
                <meta itemprop="validThrough" content="${endDate.toISOString()}">
                <meta itemprop="employmentType" content="CONTRACTOR">
                
                <div class="request-header">
                    <div class="request-icon" aria-hidden="true" role="img" aria-label="Service icon">✈️</div>
                    
                    <div class="request-content">
                        <h3 class="request-title" itemprop="title">${escapeHtml(mission.title || 'Service Request')}</h3>
                        
                        <div class="request-meta">
                            <div class="category-badge" role="status">
                                <span class="category-dot" aria-hidden="true"></span>
                                <span itemprop="industry">${escapeHtml(mission.category?.name || 'Category')}</span>
                            </div>
                            
                            ${mission.subcategory ? `
                                <div class="meta-item">
                                    <i class="fas fa-tag meta-icon" aria-hidden="true"></i>
                                    <span>${escapeHtml(mission.subcategory.name)}</span>
                                </div>
                            ` : ''}
                            
                            <div class="meta-item" itemprop="jobLocation" itemscope itemtype="https://schema.org/Place">
                                <i class="fas fa-map-marker-alt meta-icon" aria-hidden="true"></i>
                                <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                    <span itemprop="addressCountry">${escapeHtml(mission.location_country || mission.location_city || 'Worldwide')}</span>
                                </span>
                            </div>
                            
                            <div class="meta-item">
                                <i class="fas fa-language meta-icon" aria-hidden="true"></i>
                                <span itemprop="workLanguage">${escapeHtml(mission.language || 'Not specified')}</span>
                            </div>
                            
                            <div class="meta-item">
                                <i class="fas fa-calendar-times meta-icon" aria-hidden="true"></i>
                                <span>
                                    <strong>${remainingDays}</strong> 
                                    ${remainingDays === 1 ? 'day' : 'days'} remaining
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <footer class="request-footer">
                    <div class="requester-info" itemprop="hiringOrganization" itemscope itemtype="https://schema.org/Person">
                        <div class="requester-avatar" aria-hidden="true">${requesterInitial}</div>
                        <div>
                            <span class="requester-label">Requested by:</span>
                            <span itemprop="name">${escapeHtml(displayName)}</span>
                        </div>
                    </div>
                    
                    <a href="/quote-offer/${mission.id}"> 
                       class="btn-see-request"
                       aria-label="View full details and submit proposal for ${escapeHtml(mission.title || 'this request')}"
                       rel="nofollow">
                        <span>See Details</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </footer>
            `;
            
            return article;
        }
        
        // Update counter with animation
        function updateCounter(count) {
            const counter = document.getElementById('missionsCounter');
            if (counter) {
                animateCounter(counter, count);
            }
        }
        
        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Screen reader announcements
        function announceToScreenReader(message) {
            const announcement = document.createElement('div');
            announcement.setAttribute('role', 'status');
            announcement.setAttribute('aria-live', 'polite');
            announcement.className = 'sr-only';
            announcement.textContent = message;
            document.body.appendChild(announcement);
            setTimeout(() => announcement.remove(), 1000);
        }
        
        // Performance mark
        if (window.performance && window.performance.measure) {
            window.addEventListener('load', function() {
                window.performance.mark('app-ready');
                window.performance.measure('app-init-time', 'app-init', 'app-ready');
            });
        }
        
    })();
    </script>
    
</body>
</html>