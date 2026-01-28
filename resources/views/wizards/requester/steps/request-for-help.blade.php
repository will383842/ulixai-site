<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Create Your Help Request - Find Qualified Service Providers Worldwide | ULIX AI</title>
    <meta name="description" content="Get help from qualified local and expat service providers in 197 countries. Create your help request in minutes and receive offers from verified professionals. Free to post.">
    <meta name="keywords" content="help request, service providers, expat helpers, international assistance, 197 countries, local help, verified professionals">
    <meta name="author" content="ULIX AI">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#2563eb">
    
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Need Help Abroad? Create Your Request - ULIX AI">
    <meta property="og:description" content="Get help from qualified service providers in 197 countries. Create your request and receive offers from verified helpers!">
    <meta property="og:image" content="{{ asset('images/share-form-request.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="ULIX AI">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Need Help Abroad? Create Your Request">
    <meta name="twitter:description" content="Get help from qualified service providers in 197 countries.">
    <meta name="twitter:image" content="{{ asset('images/share-form-request.jpg') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/faviccon.png') }}">
    
    <!-- DNS Prefetch & Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Critical CSS inliné -->
    <style>
        /* Reset & Base - Critical CSS */
        * {
            -webkit-tap-highlight-color: rgba(37, 99, 235, 0.1);
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            font-display: swap;
            min-height: 100vh;
            background: linear-gradient(to top right, #fff, #eff6ff);
            padding-bottom: 5rem;
        }
        
        /* Skip to content - Accessibilité */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #2563eb;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            z-index: 100;
            border-radius: 0 0 4px 0;
            font-weight: 600;
        }
        
        .skip-link:focus {
            top: 0;
            outline: 2px solid #fff;
            outline-offset: 2px;
        }
        
        /* Alpine.js cloak */
        [x-cloak] {
            display: none !important;
        }
        
        /* Focus visible - Accessibilité */
        *:focus-visible {
            outline: 3px solid #2563eb;
            outline-offset: 2px;
        }
        
        /* Minimum touch target - Mobile UX */
        button, a, input[type="radio"], input[type="checkbox"], .clickable {
            min-height: 44px;
            min-width: 44px;
            touch-action: manipulation;
        }
        
        /* Progress bar transition */
        #progressBar {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
    
    <!-- ✅ Tailwind CSS compilé par Laravel Mix -->
    <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <!-- Styles externes - Chargement différé -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print" onload="this.media='all'">
    
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css" as="style">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css" media="print" onload="this.media='all'">
    
    <!-- Fallback pour navigateurs sans JS -->
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css">
    </noscript>
    
    <!-- Alpine.js - Defer -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Structured Data - SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "ULIX AI Help Request Form",
        "description": "Create your help request and connect with qualified service providers in 197 countries",
        "url": "{{ url()->current() }}",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Any",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        }
    }
    </script>

    <!-- Styles personnalisés -->
    <style>
        /* ═══════════════════════════════════════════════════════════
           🎨 CUSTOM STYLES - Request Form
           ═══════════════════════════════════════════════════════════ */

        /* Navigation buttons */
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

        /* Hamburger menu animation */
        .hamburger-line {
            transform-origin: center;
            transition: transform 0.3s ease, opacity 0.3s ease, background-color 0.3s ease;
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

        /* Breadcrumb */
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

        /* Scroll to top button */
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
            transition: all 0.3s ease;
        }

        #scrollToTopBtn:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        #scrollToTopBtn.show {
            display: flex;
        }

        /* Photo upload boxes - Mobile First */
        .photo-upload-box {
            aspect-ratio: 1 / 1;
            position: relative;
            overflow: hidden;
            min-height: 110px;
            max-height: 130px;
            border-radius: 1rem;
        }

        .photo-upload-box .photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .photo-upload-box.has-photo .photo-menu-btn {
            position: absolute;
            inset: 0;
            background: transparent;
        }

        .photo-upload-box.has-photo .photo-preview {
            cursor: pointer;
        }

        .photo-upload-box:not(.has-photo) .photo-preview {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .photo-upload-box:not(.has-photo) .photo-label {
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        /* Zoom modal */
        #photoZoomModal {
            backdrop-filter: blur(8px);
        }

        #photoZoomModal img {
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
        }

        .zoom-controls {
            gap: 0.5rem;
        }

        .zoom-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
        }

        .zoom-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        /* Inputs - Style unifié */
        input:not([type="checkbox"]):not([type="radio"]):not([type="file"]), 
        select, 
        textarea {
            border: 2px solid #93c5fd;
            transition: all 0.2s ease;
            padding: 0.875rem;
            font-size: 1rem;
            border-radius: 1rem;
        }

        input:not([type="checkbox"]):not([type="radio"]):not([type="file"]):focus, 
        select:focus, 
        textarea:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Message de bienvenue animé */
        .welcome-message {
            animation: slideInDown 0.5s ease-out;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Animations */
        @keyframes slideUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animate-slideUp {
            animation: slideUp 0.5s ease;
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease;
        }

        /* ═══════════════════════════════════════════════════════════
           🎨 NAVIGATION BUTTONS - Request Form
           ═══════════════════════════════════════════════════════════ */

        /* Bouton Next - État ENABLED */
        #nextBtn:not(:disabled) {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 0.9375rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        #nextBtn:not(:disabled):hover {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.5);
            transform: translateY(-2px);
        }

        #nextBtn:not(:disabled):active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }

        /* Bouton Next - État DISABLED */
        #nextBtn:disabled {
            background: #9ca3af;
            color: #6b7280;
            cursor: not-allowed;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 0.9375rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0.6;
        }

        #nextBtn:disabled:hover {
            transform: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Bouton Previous */
        #prevBtn {
            color: #2563eb;
            font-weight: 700;
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9375rem;
            cursor: pointer;
            background: transparent;
        }

        #prevBtn:hover {
            background: #eff6ff;
        }

        #prevBtn:active {
            transform: scale(0.95);
        }

        /* Desktop optimizations */
        @media (min-width: 768px) {
            body {
                padding-bottom: 0;
            }

            .form-step {
                max-height: 70vh;
                overflow-y: auto;
                padding: 0.5rem;
            }
            
            .info-box {
                padding: 0.625rem !important;
                margin-top: 0.625rem !important;
            }
            
            .info-box p {
                font-size: 0.8125rem !important;
                line-height: 1.35 !important;
            }
            
            input:not([type="checkbox"]):not([type="radio"]):not([type="file"]), 
            select, 
            textarea {
                padding: 0.625rem !important;
                font-size: 0.9375rem !important;
            }
            
            .option-btn, .duration-btn {
                padding: 0.625rem 0.875rem !important;
                font-size: 0.8125rem !important;
            }
            
            .support-option, .urgency-option {
                padding: 0.625rem 0.875rem !important;
            }
            
            .lang-option {
                padding: 0.5rem 0.625rem !important;
                font-size: 0.75rem !important;
            }
            
            h1 {
                font-size: 1.25rem !important;
            }
            
            .max-w-3xl {
                max-width: 56rem;
            }
            
            .photo-upload-box {
                max-height: 120px;
                min-height: 100px;
            }

            #nextBtn:not(:disabled),
            #nextBtn:disabled {
                padding: 0.75rem 2rem;
                font-size: 0.875rem;
            }
            
            #prevBtn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 767px) {
            #scrollToTopBtn {
                display: none !important;
            }

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

            header.sticky-header {
                padding: 0.625rem 1rem !important;
            }
            
            #formStepLabel {
                font-size: 1rem !important;
                line-height: 1.3 !important;
            }
            
            #stepCounter, #funText {
                font-size: 0.75rem !important;
            }
        }

        /* Accessibility - Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            html {
                scroll-behavior: auto;
            }

            #nextBtn,
            #prevBtn {
                transition: none;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            button,
            .btn {
                border-width: 2px;
            }
        }

        /* Sticky header z-index */
        .sticky-header {
            z-index: 30 !important;
        }
        
        .modal-overlay {
            z-index: 9999 !important;
        }

        /* Section spacing - Responsive */
        .section-spacing {
            padding: clamp(0.5rem, 2vw, 1rem) clamp(0.5rem, 2vw, 0.75rem);
        }

        /* Share button animations */
        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .animate-scaleIn {
            animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes gentleBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(1.05); }
        }

        #shareBtn.animate-attention {
            animation: gentleBounce 0.6s ease-in-out;
        }

        /* Below fold - Performance */
        .below-fold {
            content-visibility: auto;
            contain-intrinsic-size: auto 500px;
        }

        /* Container queries support */
        @supports (container-type: inline-size) {
            .responsive-container {
                container-type: inline-size;
            }
        }

        /* Backdrop filter support */
        @supports (backdrop-filter: blur(12px)) or (-webkit-backdrop-filter: blur(12px)) {
            .backdrop-blur-md {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-tr from-white to-blue-50 pb-20 sm:pb-24">
    <a href="#main-content" class="skip-link">Skip to content</a>
    
    @include('includes.header')
    
    @php 
        use App\Models\Country;
        $countries = Country::where('status', 1)->get();
        
        $funTexts = [
            ['text' => "Let's go! 🚀", 'color' => '#2563eb'],
            ['text' => "Question 2! 😊", 'color' => '#8b5cf6'],
            ['text' => "Almost there! 💪", 'color' => '#f59e0b'],
            ['text' => "You got this! 🎯", 'color' => '#10b981'],
            ['text' => "Well done! ✨", 'color' => '#ec4899'],
            ['text' => "Photo time! 📸", 'color' => '#6366f1'],
            ['text' => "Moving on! 🏃", 'color' => '#14b8a6'],
            ['text' => "Quick! ⚡", 'color' => '#f97316'],
            ['text' => "Great! 🌟", 'color' => '#a855f7'],
            ['text' => "A bit more! 💫", 'color' => '#3b82f6'],
            ['text' => "Yes! 🎊", 'color' => '#ef4444'],
            ['text' => "Almost done! 🏁", 'color' => '#10b981'],
            ['text' => "Last one! 🎉", 'color' => '#8b5cf6'],
            ['text' => "...", 'color' => '#6b7280'],
            ['text' => "Congrats! 🎉", 'color' => '#10b981']
        ];
        
        $stepLabels = [
            "Which country do you need help in?",
            "What is your country of origin?",
            "Which city are you currently in?",
            "How long have you been in this country?",
            "Describe your help request",
            "Add photos if you wish",
            "How would you like to be helped?",
            "How soon do you need this service?",
            "What language(s) do you speak?",
            "What is your first name?",
            "What is your email address?",
            "Choose a password",
            "How long do you want your request to remain visible?",
            "",
            ""
        ];
        
        $durations = ["Not arrived yet", "1-7 days", "1-4 weeks", "1-12 months", "1-2 years", "2-5 years", "More than 5 years"];
        
        $languages = [
            ['name' => 'English', 'code' => 'us'],
            ['name' => 'Français', 'code' => 'fr'],
            ['name' => 'Español', 'code' => 'es'],
            ['name' => 'Português', 'code' => 'pt'],
            ['name' => 'Deutsch', 'code' => 'de'],
            ['name' => 'Italiano', 'code' => 'it'],
            ['name' => 'العربية', 'code' => 'sa'],
            ['name' => '日本語', 'code' => 'jp'],
            ['name' => '한국어', 'code' => 'kr'],
            ['name' => 'हिन्दी', 'code' => 'in'],
            ['name' => '中文', 'code' => 'cn'],
            ['name' => 'Русский', 'code' => 'ru']
        ];
    @endphp
    
    <header class="sticky top-0 sticky-header bg-white/98 backdrop-blur-md border-b-2 border-gray-200 section-spacing shadow-sm" role="banner">
        <div class="max-w-3xl mx-auto">
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-2 overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-label="Form progress">
                <div id="progressBar" class="h-full bg-blue-600 rounded-full" style="width: 0%"></div>
            </div>
            
            <div class="flex items-center justify-between mb-1">
                <span id="stepCounter" class="text-sm font-semibold text-gray-700">Step 1</span>
                <span id="funText" class="text-xs font-semibold transition-colors duration-300" style="color: #2563eb" aria-live="polite">Let's go! 🚀</span>
            </div>
            <h1 id="formStepLabel" class="text-lg sm:text-xl md:text-2xl font-bold text-blue-700 leading-tight">Which country do you need help in?</h1>
        </div>
    </header>
    
    <main id="main-content" class="max-w-3xl mx-auto section-spacing py-3 sm:py-4" role="main">
        <div class="md:border-4 md:border-blue-300 md:rounded-3xl md:p-4 lg:p-6 md:bg-white md:shadow-xl">
            <form action="{{ route('save-request-form') }}" id="helpRequestForm" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                
                <!-- STEP 1: Country Need -->
                <fieldset class="form-step">
                    <legend class="sr-only">Select the country where you need help</legend>
                    <label for="countryNeed" class="sr-only">Country where you need help</label>
                    <select 
                        id="countryNeed" 
                        name="countryNeed" 
                        class="w-full p-4 text-base bg-white border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        required
                        aria-required="true"
                        aria-describedby="countryNeed-help">
                        <option value="">Select a country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <div class="info-box bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl p-4 mt-4 shadow-sm" id="countryNeed-help">
                        <p class="text-sm text-blue-900 leading-relaxed">
                            🎯 <strong>A few quick questions</strong> to properly post your help request and receive offers from qualified service providers... You will just have to <strong>choose the one you prefer</strong>! 🚀
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 2: Origin Country -->
                <fieldset class="form-step hidden">
                    <legend class="sr-only">Select your country of origin</legend>
                    <label for="originCountry" class="sr-only">Country of origin</label>
                    <select 
                        id="originCountry" 
                        name="originCountry" 
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        required
                        aria-required="true"
                        aria-describedby="originCountry-help">
                        <option value="">Select your country of origin</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <div class="info-box bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-200 rounded-2xl p-4 mt-4 shadow-sm" id="originCountry-help">
                        <p class="text-sm text-purple-900 leading-relaxed">
                            😏 It's because we are <strong>very curious</strong>... Yes I know, bad habit!
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 3: Current City -->
                <fieldset class="form-step hidden">
                    <legend class="sr-only">Enter your current city</legend>
                    <label for="currentCity" class="sr-only">Current city</label>
                    <input 
                        type="text"
                        id="currentCity"
                        name="currentCity"
                        placeholder="E.g.: Paris, Lyon, Marseille..."
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        autocomplete="address-level2"
                        aria-describedby="currentCity-help"
                    />
                    <div class="info-box bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-4 mt-4 shadow-sm" id="currentCity-help">
                        <p class="text-sm text-green-900 leading-relaxed">
                            💡 Or the name of the nearest larger town — <strong>essential if you need physical help</strong>!
                        </p>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 italic text-center">⚠️ Optional but recommended for local help</p>
                </fieldset>
                
                <!-- STEP 4: Duration Here -->
                <fieldset class="form-step hidden">
                    <legend class="sr-only">How long have you been in this country?</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" role="group" aria-labelledby="duration-label">
                        <span id="duration-label" class="sr-only">Select duration</span>
                        @foreach($durations as $index => $duration)
                        <button
                            type="button"
                            class="option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100 {{ $index === count($durations) - 1 ? 'sm:col-span-2' : '' }}"
                            data-value="{{ $duration }}"
                            aria-pressed="false">
                            {{ $duration }}
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="durationHere" name="durationHere" />
                    <p class="text-xs text-red-500 mt-3 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 5: Request Details -->
                <fieldset class="form-step hidden space-y-4">
                    <legend class="sr-only">Describe your help request</legend>
                    <div>
                        <label for="requestTitle" class="sr-only">Request title (minimum 15 characters)</label>
                        <input
                            type="text"
                            id="requestTitle"
                            name="requestTitle"
                            placeholder="E.g.: Help with moving, Document translation..."
                            class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                            required
                            aria-required="true"
                            aria-describedby="titleCounter"
                            maxlength="200"
                        />
                        <div id="titleCounter" class="mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm" role="status" aria-live="polite">
                            ⚠️ Minimum 15 characters • <span id="titleCount">0/15</span>
                        </div>
                    </div>
                    
                    <div>
                        <label for="moreDetails" class="sr-only">Additional details (minimum 50 characters)</label>
                        <textarea
                            id="moreDetails"
                            name="moreDetails"
                            rows="5"
                            maxlength="1500"
                            placeholder="Describe the circumstances, dates, locations, people involved..."
                            class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl resize-none transition-all shadow-sm"
                            required
                            aria-required="true"
                            aria-describedby="detailsCounter"
                        ></textarea>
                        <div id="detailsCounter" class="mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm" role="status" aria-live="polite">
                            <span>⚠️ Min 50 chars</span>
                            <span class="text-gray-700"><span id="detailsCount">0</span>/50 (max 1500)</span>
                        </div>
                        <div class="info-box bg-gradient-to-r from-cyan-50 to-blue-50 border-2 border-cyan-200 rounded-2xl p-3 mt-3 shadow-sm">
                            <p class="text-sm text-cyan-900 leading-relaxed">
                                💰 <strong>The more you provide, the better</strong> service providers will be able to give you the <strong>best price quote</strong>!
                            </p>
                        </div>
                    </div>

                    <!-- Budget Section -->
                    <div class="mt-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">💰 Your budget range (optional)</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="relative">
                                <label for="budget_min" class="sr-only">Minimum budget</label>
                                <input
                                    type="number"
                                    id="budget_min"
                                    name="budget_min"
                                    placeholder="Min"
                                    min="0"
                                    class="w-full p-3 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                                    aria-describedby="budget-help"
                                />
                            </div>
                            <div class="relative">
                                <label for="budget_max" class="sr-only">Maximum budget</label>
                                <input
                                    type="number"
                                    id="budget_max"
                                    name="budget_max"
                                    placeholder="Max"
                                    min="0"
                                    class="w-full p-3 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                                    aria-describedby="budget-help"
                                />
                            </div>
                            <div class="relative">
                                <label for="budget_currency" class="sr-only">Currency</label>
                                <select
                                    id="budget_currency"
                                    name="budget_currency"
                                    class="w-full p-3 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm appearance-none cursor-pointer"
                                    aria-describedby="budget-help"
                                >
                                    <option value="EUR" selected>EUR (€)</option>
                                    <option value="USD">USD ($)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <p id="budget-help" class="mt-2 text-xs text-gray-500 italic text-center">⚠️ Optional - helps providers give you better quotes</p>
                    </div>

                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 6: Photos -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">Add photos to your request (optional)</legend>
                    <div class="grid grid-cols-2 gap-2 max-w-md mx-auto">
                        @for ($i = 1; $i <= 4; $i++)
                        <div class="photo-upload-box border-2 border-blue-400 rounded-xl p-2 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-100 hover:border-blue-500 transition-all active:scale-95 bg-blue-50 shadow-sm" data-photo-index="{{ $i }}">
                            <button type="button" class="photo-menu-btn w-full h-full flex flex-col items-center justify-center focus:outline-none" aria-label="Upload photo {{ $i }}">
                                <img src="{{ asset('images/uploadpng.png') }}" alt="" class="photo-preview" loading="lazy" decoding="async" width="32" height="32" data-default-src="{{ asset('images/uploadpng.png') }}" />
                                <span class="text-xs text-blue-700 font-semibold photo-label">Add photo</span>
                            </button>
                            <input type="file" name="photo{{ $i }}" class="hidden photo-input" accept="image/*" aria-label="Photo {{ $i }}" />
                        </div>
                        @endfor
                    </div>
                    <div class="info-box bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-xl p-2.5 shadow-sm">
                        <p class="text-xs text-indigo-900 leading-relaxed">
                            🖼️ <strong>Optional</strong> — Click on a photo to view it larger.
                        </p>
                    </div>
                </fieldset>
                
                <!-- STEP 7: Support Type -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">How would you like to be helped?</legend>
                    <div class="grid grid-cols-1 gap-3 max-w-md mx-auto" role="radiogroup" aria-labelledby="support-type-label">
                        <span id="support-type-label" class="sr-only">Support type</span>
                        <label class="support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100">
                            <span class="font-bold text-sm">Phone support is sufficient</span>
                            <input type="radio" name="supportType" value="phone" class="w-5 h-5 text-blue-600" required aria-required="true" />
                        </label>
                        <label class="support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100">
                            <span class="font-bold text-sm">Help with physical intervention</span>
                            <input type="radio" name="supportType" value="physical" class="w-5 h-5 text-blue-600" />
                        </label>
                        <label class="support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100">
                            <span class="font-bold text-sm">I don't know yet</span>
                            <input type="radio" name="supportType" value="unknown" class="w-5 h-5 text-blue-600" />
                        </label>
                    </div>
                    <div class="info-box bg-gradient-to-r from-rose-50 to-pink-50 border-2 border-rose-200 rounded-2xl p-3 text-center shadow-sm">
                        <p class="text-sm text-rose-900 leading-relaxed">
                            ⚠️ <strong>Important:</strong> Select <strong>only one</strong> option
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 8: Urgency -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">How soon do you need this service?</legend>
                    <div class="grid grid-cols-1 gap-3 max-w-lg mx-auto" role="radiogroup" aria-labelledby="urgency-label">
                        <span id="urgency-label" class="sr-only">Urgency level</span>
                        <label class="urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl" aria-hidden="true">🔥</span>
                                <span class="font-bold text-sm text-red-500">It's urgent</span>
                            </div>
                            <input type="radio" name="urgency" value="urgent" class="w-5 h-5" required aria-required="true" />
                        </label>
                        <label class="urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl" aria-hidden="true">📅</span>
                                <span class="font-bold text-sm text-blue-500">Within the week</span>
                            </div>
                            <input type="radio" name="urgency" value="within_week" class="w-5 h-5" />
                        </label>
                        <label class="urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl" aria-hidden="true">⏳</span>
                                <span class="font-bold text-sm text-amber-500">Between 1-2 weeks</span>
                            </div>
                            <input type="radio" name="urgency" value="1_2_weeks" class="w-5 h-5" />
                        </label>
                        <label class="urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl" aria-hidden="true">📆</span>
                                <span class="font-bold text-sm text-green-500">Between 2 weeks - 1 month</span>
                            </div>
                            <input type="radio" name="urgency" value="2_weeks_1_month" class="w-5 h-5" />
                        </label>
                        <label class="urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xl" aria-hidden="true">🗓️</span>
                                <span class="font-bold text-sm text-purple-500">More than a month</span>
                            </div>
                            <input type="radio" name="urgency" value="more_than_month" class="w-5 h-5" />
                        </label>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 9: Languages -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">What languages do you speak?</legend>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-w-2xl mx-auto" role="group" aria-labelledby="languages-label">
                        <span id="languages-label" class="sr-only">Select languages you speak</span>
                        @foreach($languages as $lang)
                        <label class="lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95">
                            <img src="{{ asset('images/flags/' . $lang['code'] . '.svg') }}" 
                                 alt="" 
                                 class="w-6 h-4 pointer-events-none" 
                                 loading="lazy"
                                 width="24"
                                 height="16" />
                            <span class="font-semibold text-xs pointer-events-none">{{ $lang['name'] }}</span>
                            <input type="checkbox" name="languages[]" value="{{ $lang['name'] }}" class="hidden lang-checkbox" />
                        </label>
                        @endforeach
                    </div>
                    <div class="info-box bg-gradient-to-r from-violet-50 to-purple-50 border-2 border-violet-200 rounded-2xl p-3 text-center shadow-sm">
                        <p class="text-sm text-violet-900 leading-relaxed">
                            🌍 <strong>Select all languages</strong> you can communicate in
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required (at least one)</p>
                </fieldset>
                
                <!-- STEP 10: First Name -->
                <fieldset class="form-step hidden" id="step10-name">
                    <legend class="sr-only">Enter your first name</legend>
                    <label for="firstName" class="sr-only">First name</label>
                    <input
                        type="text"
                        id="firstName"
                        name="firstName"
                        placeholder="Your first name"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        required
                        aria-required="true"
                        autocomplete="given-name"
                        @if(Auth::check())
                            value="{{ Auth::user()->name }}"
                            disabled
                        @endif
                    />
                    <div class="info-box bg-gradient-to-r from-sky-50 to-blue-50 border-2 border-sky-200 rounded-2xl p-4 mt-4 shadow-sm">
                        <p class="text-sm text-sky-900 leading-relaxed">
                            👤 We need <strong>your first name</strong> to personalize your experience
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 11: Email -->
                <fieldset class="form-step hidden" id="step11-email">
                    <legend class="sr-only">Enter your email address</legend>
                    
                    <!-- Message de bienvenue dynamique (caché par défaut) -->
                    <div id="welcomeMessage" class="welcome-message hidden mb-4" role="status">
                        <p class="text-base font-bold mb-1" id="welcomeTitle">👋 Welcome!</p>
                        <p class="text-sm" id="welcomeText">Let's create your account 🎉</p>
                    </div>
                    
                    <label for="email" class="sr-only">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your-email@example.com"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        required
                        aria-required="true"
                        autocomplete="email"
                        inputmode="email"
                        @if(Auth::check())
                            value="{{ Auth::user()->email }}"
                            disabled
                        @endif
                    />
                    <div class="info-box bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-200 rounded-2xl p-4 mt-4 shadow-sm">
                        <p class="text-sm text-emerald-900 leading-relaxed">
                            📧 We'll send you <strong>notifications</strong> about your request here
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 12: Password -->
                <fieldset class="form-step hidden" id="step12-password">
                    <legend class="sr-only">Password</legend>
                    
                    <!-- Message personnalisé (caché par défaut) -->
                    <div id="passwordWelcomeMessage" class="welcome-message hidden mb-4" role="status">
                        <p class="text-base font-bold mb-1" id="passwordWelcomeTitle"></p>
                        <p class="text-sm" id="passwordWelcomeText"></p>
                    </div>
                    
                    <label for="password" class="sr-only" id="passwordLabel">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Choose a secure password (min 6 chars)"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl transition-all shadow-sm"
                        required
                        aria-required="true"
                        aria-describedby="passwordStrength"
                        autocomplete="new-password"
                        @if(Auth::check())
                            value="{{ Auth::user()->password }}"
                            disabled
                        @endif
                    />
                    
                    <!-- Barre de force du mot de passe (visible uniquement en mode création) -->
                    <div id="passwordStrength" class="mt-3">
                        <div class="flex justify-between text-xs mb-1">
                            <span id="strengthText" class="font-semibold text-gray-700">Password strength</span>
                            <span id="strengthLabel" class="font-semibold text-gray-500">Too short</span>
                        </div>
                        <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-live="polite" aria-label="Password strength indicator">
                            <div id="strengthBar" class="h-full bg-gray-300 transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <div class="info-box bg-gradient-to-r from-fuchsia-50 to-pink-50 border-2 border-fuchsia-200 rounded-2xl p-4 mt-4 shadow-sm" id="passwordInfoBox">
                        <p class="text-sm text-fuchsia-900 leading-relaxed" id="passwordInfoText">
                            🔐 Use at least <strong>6 characters</strong> — 8+ recommended
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- STEP 13: Service Duration -->
<fieldset class="form-step hidden space-y-3">
    <legend class="sr-only">How long should your request remain visible?</legend>
    <div class="flex flex-col sm:flex-row justify-center gap-3" role="group" aria-labelledby="duration-label-13">
        <span id="duration-label-13" class="sr-only">Select service duration</span>
        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="1 week" aria-pressed="false">1 week</button>
        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="2 weeks" aria-pressed="false">2 weeks</button>
        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="1 month" aria-pressed="false">1 month</button>
    </div>
    <input type="hidden" id="serviceDuration" name="serviceDuration" />
    
    <div class="bg-slate-50 border border-slate-200 p-4 shadow-sm" style="border-radius: 1rem; display: flex; align-items: flex-start; gap: 0.75rem;">
        <input type="checkbox" 
               id="termsCheckbox" 
               style="-webkit-appearance: none; -moz-appearance: none; appearance: none; width: 22px; height: 22px; min-width: 22px; min-height: 22px; max-width: 22px; max-height: 22px; margin-top: 2px; border: 2.5px solid #3b82f6; border-radius: 7px; cursor: pointer; flex-shrink: 0; position: relative; background: white; transition: all 0.3s ease; box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);"
               required 
               aria-required="true" />
        <label for="termsCheckbox" class="text-sm text-slate-600 leading-relaxed cursor-pointer" style="flex: 1;">
            By clicking next I acknowledge that I have read and understood the <span class="font-medium text-slate-700">terms & conditions</span> for service requests.
        </label>
    </div>
    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
</fieldset>

<style>
/* Checkbox plus grosse et visible */
#termsCheckbox {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    width: 22px !important;
    height: 22px !important;
    min-width: 22px !important;
    min-height: 22px !important;
    max-width: 22px !important;
    max-height: 22px !important;
    animation: pulseCheckbox 2s ease-in-out infinite;
}

/* Animation d'attention douce */
@keyframes pulseCheckbox {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
    }
    50% {
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
    }
}

#termsCheckbox:hover {
    border-color: #2563eb !important;
    background: #eff6ff !important;
    transform: scale(1.1);
    animation: none;
}

#termsCheckbox:checked {
    background: #3b82f6 !important;
    border-color: #3b82f6 !important;
    animation: none;
}

#termsCheckbox:checked::after {
    content: '' !important;
    position: absolute !important;
    left: 6px !important;
    top: 2px !important;
    width: 6px !important;
    height: 11px !important;
    border: solid white !important;
    border-width: 0 3px 3px 0 !important;
    transform: rotate(45deg) !important;
}

#termsCheckbox:focus {
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25) !important;
    animation: none;
}

/* Bouton sélectionné */
.duration-btn[aria-pressed="true"] {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
    border-color: #2563eb !important;
    color: white !important;
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3) !important;
    transform: translateY(-2px) !important;
}
</style>
                
                <!-- STEP 14: Processing -->
                <div class="form-step hidden flex flex-col items-center justify-center space-y-4 py-8" role="status" aria-live="polite" aria-label="Processing your request">
                    <div class="relative">
                        <div class="w-20 h-20 border-8 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 bg-blue-100 rounded-full"></div>
                        </div>
                    </div>
                    <div class="text-center max-w-md">
                        <h2 class="text-xl font-bold text-blue-900 mb-2">Processing your request...</h2>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            We are notifying <strong>service providers</strong> near you. This will only take a moment! ⏳
                        </p>
                    </div>
                </div>
                
                <!-- STEP 15: Success -->
                <div class="form-step hidden flex flex-col items-center space-y-4 py-6" role="status" aria-live="polite">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-3 shadow-lg">
                        <svg class="w-14 h-14 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-blue-900 text-center">Your request is created! 🎉</h2>
                    <p class="text-sm text-gray-600 text-center max-w-md">
                        Your ad is now <strong>visible to service providers</strong> near you. You'll receive offers very soon! 🚀
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 w-full max-w-md">
                        <a id="see-my-ad" href="#" class="flex-1 px-6 py-3 bg-blue-600 rounded-2xl text-white font-bold text-sm hover:bg-blue-700 transition-all shadow-md hover:shadow-lg active:scale-95 text-center">
                            View my ad
                        </a>
                        <a href="{{ route('service-providers') }}" class="flex-1 px-6 py-3 bg-white border-2 border-blue-600 rounded-2xl text-blue-600 font-bold text-sm hover:bg-blue-50 transition-all shadow-md hover:shadow-lg active:scale-95 text-center">
                            View providers
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
    <!-- Expat Popup -->
    <aside id="expatPopup" class="fixed bottom-28 right-4 left-4 md:left-auto md:right-6 max-w-sm bg-gradient-to-br from-purple-600 to-indigo-600 text-white p-4 rounded-2xl shadow-2xl hidden animate-slideUp modal-overlay" role="complementary" aria-labelledby="popup-title">
        <button type="button" onclick="document.getElementById('expatPopup').classList.add('hidden')" class="absolute top-1 right-1 text-white text-2xl font-bold hover:bg-white/20 w-7 h-7 rounded-full flex items-center justify-center" aria-label="Close popup">×</button>
        <p id="popup-title" class="text-sm font-bold mb-1">👋 Hey! Did you know?</p>
        <p class="text-xs leading-relaxed">
            If you become an <strong>expat helper</strong>, you can earn income! 💰<br><br>
            You take the missions you want and earn income. <strong>Cool, right?</strong> 😎
        </p>
    </aside>
    
    <!-- Validation Error -->
    <div id="validationError" class="fixed top-20 left-1/2 transform -translate-x-1/2 max-w-md bg-gradient-to-r from-orange-500 to-red-500 text-white px-5 py-3 rounded-2xl shadow-2xl hidden animate-slideDown modal-overlay z-[10000]" role="alert" aria-live="assertive">
        <p id="validationMessage" class="text-sm font-bold text-center"></p>
    </div>
    
    <!-- CGV Warning -->
    <div id="cgvWarning" class="fixed top-20 left-1/2 transform -translate-x-1/2 max-w-md bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 px-5 py-3 rounded-2xl shadow-2xl hidden animate-slideDown modal-overlay z-[10000]" role="alert" aria-live="assertive">
        <p class="text-sm font-bold text-center">⚠️ Don't forget to check the T&C below! 📝✅</p>
    </div>
    
    <!-- Sticky Navigation -->
    <nav id="stickyNav" class="fixed md:sticky bottom-0 left-0 right-0 z-40 bg-white/98 backdrop-blur-md border-t-2 border-gray-200 section-spacing shadow-lg" aria-label="Form navigation">
        <div class="max-w-3xl mx-auto flex items-center justify-between gap-3">
            <button
                type="button"
                id="prevBtn"
                class="text-blue-600 font-bold px-4 py-2 rounded-xl hover:bg-blue-50 transition-all flex items-center gap-2 text-sm active:scale-95"
                style="visibility: hidden"
                aria-label="Go to previous step">
                ← Back
            </button>
            <button
                type="button"
                id="nextBtn"
                class="px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md"
                disabled
                aria-label="Go to next step">
                Next →
            </button>
        </div>
    </nav>
    
    <!-- Photo Menu Modal -->
    <div id="photoMenuModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center px-4 hidden modal-overlay" role="dialog" aria-modal="true" aria-labelledby="photo-modal-title">
        <div class="bg-white rounded-3xl shadow-2xl p-6 w-96 max-w-full">
            <h2 id="photo-modal-title" class="text-lg font-bold mb-3 text-gray-900">Choose a source</h2>
            <div class="space-y-2">
                <button type="button" class="photo-menu-option w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 transition-all border-2 border-transparent hover:border-blue-200" data-action="library">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">Photo library</span>
                </button>
                <button type="button" class="photo-menu-option w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 transition-all border-2 border-transparent hover:border-blue-200" data-action="camera">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">Take photo</span>
                </button>
                <button type="button" id="closePhotoMenuModal" class="w-full mt-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all text-sm font-medium">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Camera Modal -->
    <div id="cameraModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center px-4 hidden modal-overlay" role="dialog" aria-modal="true" aria-labelledby="camera-modal-title">
        <div class="bg-white rounded-3xl shadow-2xl p-6 w-full max-w-lg">
            <h2 id="camera-modal-title" class="text-lg font-bold mb-3 text-gray-900">Take a photo</h2>
            <video id="cameraVideo" class="w-full h-64 bg-gray-900 rounded-xl mb-4" autoplay playsinline></video>
            <div class="flex gap-3">
                <button type="button" id="capturePhotoBtn" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all font-semibold text-sm">Capture</button>
                <button type="button" id="closeCameraModal" class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all font-semibold text-sm">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Photo Zoom Modal -->
    <div id="photoZoomModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center p-4 modal-overlay" role="dialog" aria-modal="true" aria-labelledby="zoom-title" style="z-index: 10000;">
        <div class="relative max-w-full max-h-full">
            <button type="button" id="closeZoomModal" class="absolute top-4 right-4 text-white text-3xl font-bold hover:bg-white/20 w-12 h-12 rounded-full flex items-center justify-center z-10 transition-all" aria-label="Close preview">
                ×
            </button>
            
            <div class="zoom-controls absolute bottom-4 left-1/2 transform -translate-x-1/2 flex items-center gap-3">
                <button type="button" id="zoomOut" class="zoom-btn" aria-label="Zoom out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"/>
                    </svg>
                </button>
                <button type="button" id="resetZoom" class="zoom-btn" aria-label="Reset zoom">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                </button>
                <button type="button" id="zoomIn" class="zoom-btn" aria-label="Zoom in">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                </button>
                <button type="button" id="deletePhoto" class="zoom-btn bg-red-500 text-white hover:bg-red-600" aria-label="Delete photo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
            
            <img id="zoomedImage" src="" alt="Preview" class="rounded-lg shadow-2xl" style="transform-origin: center; transition: transform 0.2s ease;" />
        </div>
    </div>
    
    <!-- Share Button -->
    <button id="shareBtn" 
            onclick="openSimpleShare()" 
            class="fixed 
                   top-1/2 -translate-y-1/2 sm:top-auto sm:translate-y-0 sm:bottom-24
                   right-1 sm:right-6
                   w-8 h-8 sm:w-12 sm:h-12
                   bg-gradient-to-br from-blue-500 to-blue-600 
                   hover:from-blue-600 hover:to-blue-700 
                   text-white rounded-full 
                   shadow-md hover:shadow-lg sm:shadow-lg sm:hover:shadow-xl 
                   transition-all duration-300 
                   transform hover:scale-110 
                   flex items-center justify-center 
                   group
                   z-[100]
                   opacity-80 hover:opacity-100 sm:opacity-100" 
            aria-label="Share this form and earn 75% commission">
      
      <svg class="w-3.5 h-3.5 sm:w-5 sm:h-5 group-hover:scale-110 transition-transform" 
           fill="currentColor" 
           viewBox="0 0 20 20"
           aria-hidden="true">
        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
      </svg>
    </button>

    <!-- Share Popup -->
    <div id="sharePopup" 
         class="hidden fixed inset-0 z-[9999] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" 
         onclick="closeSimpleShare()">
      
      <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-5 animate-scaleIn" 
           onclick="event.stopPropagation()">
        
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-lg font-bold text-gray-800">💡 Share & Earn</h3>
          <button onclick="closeSimpleShare()" 
                  class="text-gray-400 hover:text-gray-600 transition-colors"
                  aria-label="Close share dialog">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
          🌍 Share this form with people who need help abroad and earn <strong>75% commission</strong> on every transaction!
        </p>
        
        <div class="grid grid-cols-4 gap-2 mb-3">
          
          <!-- WhatsApp -->
          <button onclick="shareVia('whatsapp')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via WhatsApp">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">WhatsApp</span>
          </button>
          
          <!-- Facebook -->
          <button onclick="shareVia('facebook')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via Facebook">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Facebook</span>
          </button>
          
          <!-- Twitter -->
          <button onclick="shareVia('twitter')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via Twitter">
            <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Twitter</span>
          </button>
          
          <!-- LinkedIn -->
          <button onclick="shareVia('linkedin')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via LinkedIn">
            <div class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">LinkedIn</span>
          </button>
          
          <!-- Telegram -->
          <button onclick="shareVia('telegram')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via Telegram">
            <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Telegram</span>
          </button>
          
          <!-- Email -->
          <button onclick="shareVia('email')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via Email">
            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Email</span>
          </button>
          
          <!-- SMS -->
          <button onclick="shareVia('sms')" 
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Share via SMS">
            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">SMS</span>
          </button>
          
          <!-- Copy -->
          <button onclick="shareVia('copy')" 
                  id="copyRequestBtn"
                  class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group"
                  aria-label="Copy link">
            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Copy</span>
          </button>
          
        </div>
        
        <div class="bg-blue-50 rounded-xl p-2 text-xs text-blue-700 text-center">
          <p class="font-medium">💰 Earn 75% commission on every referral!</p>
        </div>
      </div>
    </div>

    <!-- Hidden input pour le lien affilié -->
    @auth
    <input type="hidden" id="affiliateLinkRequest" value="{{ url()->current() }}?ref={{ Auth::user()->affiliate_code }}">
    @else
    <input type="hidden" id="affiliateLinkRequest" value="{{ url()->current() }}">
    @endauth

    <!-- Scripts externes - Chargement différé -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/js/countrySelect.min.js"></script>
    
    <!-- Variables globales pour request-form.js -->
    <script>
        window.formConfig = {
            funTexts: @json($funTexts),
            stepLabels: @json($stepLabels),
            isAuthenticated: @json(Auth::check()),
            checkEmailUrl: "{{ route('check-email') }}",
            verifyPasswordUrl: "{{ route('verify-password') }}"
        };
    </script>
    
    <!-- ✅ JavaScript principal compilé par Laravel Mix -->
    <link rel="preload" href="{{ mix('js/request-form.js') }}" as="script">
    <script defer src="{{ mix('js/request-form.js') }}"></script>

    <!-- Share functionality -->
    <script>
        // Système de partage avec tracking affilié
        function openSimpleShare() { 
            document.getElementById('sharePopup').classList.remove('hidden'); 
        }

        function closeSimpleShare() { 
            document.getElementById('sharePopup').classList.add('hidden'); 
        }

        function shareVia(platform) {
            const affiliateInput = document.getElementById('affiliateLinkRequest');
            let url = affiliateInput ? affiliateInput.value : window.location.href;
            
            try {
                const urlObj = new URL(url);
                urlObj.searchParams.set('utm_source', 'social');
                urlObj.searchParams.set('utm_medium', 'share');
                urlObj.searchParams.set('utm_campaign', 'request_form');
                urlObj.searchParams.set('utm_content', platform);
                url = urlObj.toString();
            } catch (e) {
                console.error('UTM error:', e);
            }
            
            const messages = {
                en: '🆘 Need help abroad? This form connects you with verified service providers in 197 countries. Post your request for FREE and receive offers in minutes! 🌍',
                fr: '🆘 Besoin d\'aide à l\'étranger ? Ce formulaire vous connecte avec des prestataires vérifiés dans 197 pays. Postez votre demande GRATUITEMENT et recevez des offres en quelques minutes ! 🌍'
            };
            
            const currentLang = localStorage.getItem('ulixai_lang') || 'en';
            const text = messages[currentLang] || messages.en;
            
            const emailSubject = {
                en: '🆘 Get Help Abroad - Connect with Service Providers in 197 Countries',
                fr: '🆘 Obtenez de l\'aide à l\'étranger - Connectez-vous avec des prestataires dans 197 pays'
            };
            
            const subject = emailSubject[currentLang] || emailSubject.en;
            
            let shareUrl;
            
            switch(platform) {
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodeURIComponent(text + '\n\n' + url)}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(text + '\n\n' + url)}`;
                    break;
                case 'sms':
                    const smsBody = encodeURIComponent(text + '\n\n' + url);
                    shareUrl = navigator.userAgent.match(/iPhone|iPad|iPod/i) 
                        ? `sms:&body=${smsBody}`
                        : `sms:?body=${smsBody}`;
                    break;
                case 'copy':
                    navigator.clipboard.writeText(url).then(() => {
                        const btn = document.getElementById('copyRequestBtn');
                        const originalHTML = btn.innerHTML;
                        
                        btn.innerHTML = `
                            <div class="flex flex-col items-center gap-1 p-2">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-xs text-green-600 font-medium">Copied!</span>
                            </div>
                        `;
                        
                        setTimeout(() => {
                            btn.innerHTML = originalHTML;
                        }, 2000);
                    }).catch(err => {
                        console.error('Copy failed:', err);
                    });
                    return;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
                setTimeout(() => closeSimpleShare(), 500);
            }
        }

        // Fermer avec Escape
        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape') closeSimpleShare(); 
        });

        // Animation subtile intermittente du bouton share
        (function() {
            const shareBtn = document.getElementById('shareBtn');
            if (!shareBtn) return;
            
            function triggerAttention() {
                shareBtn.classList.add('animate-attention');
                setTimeout(() => {
                    shareBtn.classList.remove('animate-attention');
                }, 600);
            }
            
            setTimeout(triggerAttention, 5000);
            
            setInterval(() => {
                const delay = 8000 + Math.random() * 4000;
                setTimeout(triggerAttention, delay);
            }, 12000);
        })();
    </script>
</body>
</html>