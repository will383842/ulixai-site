<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>Create Your Help Request - Find Qualified Service Providers Worldwide | ULIX AI</title>
    <meta name="description" content="Get help from qualified local and expat service providers in 197 countries. Create your help request in minutes and receive offers from verified professionals. Free to post.">
    <meta name="keywords" content="help request, service providers, expat helpers, international assistance, 197 countries, local help, verified professionals">
    <meta name="author" content="ULIX AI">
    <meta name="robots" content="index, follow, max-image-preview:large">
    
    <!-- Canonical & Language Alternates -->
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
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
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/faviccon.png') }}">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://cdn.tailwindcss.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Tailwind CSS (TODO: Replace with compiled CSS in production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print" onload="this.media='all'">
    
    <!-- Country Select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css">
    
    <style>
        /* Performance & Touch Optimization */
        * {
            -webkit-tap-highlight-color: rgba(37, 99, 235, 0.1);
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            font-display: swap;
            min-block-size: 100dvh;
            padding-block-start: env(safe-area-inset-top);
            padding-block-end: env(safe-area-inset-bottom);
            padding-inline-start: env(safe-area-inset-left);
            padding-inline-end: env(safe-area-inset-right);
        }
        
        /* Prevent iOS zoom on input focus */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            font-size: 16px;
        }
        
        /* Touch targets minimum 44x44px */
        button,
        a,
        input[type="radio"],
        input[type="checkbox"] {
            min-block-size: 44px;
            min-inline-size: 44px;
            touch-action: manipulation;
        }
        
        /* Alpine Cloak */
        [x-cloak] {
            display: none !important;
        }
        
        /* Skip to content link */
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
        }
        
        .skip-link:focus {
            top: 0;
        }
        
        /* Custom Animations */
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
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .animate-slideUp {
            animation: slideUp 0.5s ease;
        }
        
        .animate-slideDown {
            animation: slideDown 0.3s ease;
        }
        
        .loader {
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }
        
        /* Backdrop Blur Support */
        @supports (backdrop-filter: blur(12px)) or (-webkit-backdrop-filter: blur(12px)) {
            .backdrop-blur-md {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
        }
        
        /* Reduced Motion */
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
        }
        
        /* Performance: Content Visibility */
        .below-fold {
            content-visibility: auto;
            contain-intrinsic-size: auto 500px;
        }
        
        /* Focus Visible */
        *:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
        }
        
        /* Custom Progress Bar Animation */
        #progressBar {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Touch targets - minimum 44x44px */
        button,
        a,
        input[type="radio"],
        input[type="checkbox"],
        .clickable {
            min-block-size: 44px;
            min-inline-size: 44px;
            touch-action: manipulation;
        }
        
        /* Logical properties for RTL support */
        .section-spacing {
            padding-block: clamp(0.5rem, 2vw, 1rem);
            padding-inline: clamp(0.5rem, 2vw, 0.75rem);
        }
        
        /* Container query support with fallback */
        @supports (container-type: inline-size) {
            .responsive-container {
                container-type: inline-size;
            }
        }
        
        /* High contrast support */
        @media (prefers-contrast: high) {
            button,
            .btn {
                border-width: 2px;
            }
        }
        
        /* Fix z-index for sticky header - lower than modals */
        .sticky-header {
            z-index: 30 !important;
        }
        
        /* Ensure modals are above everything */
        .modal-overlay {
            z-index: 9999 !important;
        }

        /* Compact spacing for desktop */
        @media (min-width: 768px) {
            .form-step {
                max-height: 65vh;
                overflow-y: auto;
            }
            .info-box {
                padding: 0.75rem !important;
                margin-top: 0.75rem !important;
            }
            .info-box p {
                font-size: 0.875rem !important;
                line-height: 1.4 !important;
            }
            input, select, textarea {
                padding: 0.75rem !important;
            }
            .option-btn, .duration-btn {
                padding: 0.75rem 1rem !important;
            }
            .support-option, .urgency-option {
                padding: 0.75rem 1rem !important;
            }
            .lang-option {
                padding: 0.5rem 0.75rem !important;
            }
        }
    </style>
    
    <!-- JSON-LD Structured Data -->
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

    <!-- 💫 LOADING SCREEN -->
    <div id="pageLoader" class="fixed inset-0 z-[99999] bg-white flex items-center justify-center">
      <div class="text-center">
        <div class="relative">
          <div class="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 border-t-blue-600 mx-auto mb-4"></div>
          <div class="absolute inset-0 animate-ping rounded-full h-16 w-16 border-4 border-blue-300 mx-auto opacity-20"></div>
        </div>
        <h2 class="text-gray-800 font-bold text-lg mb-1">Loading your form...</h2>
        <p class="text-gray-500 text-sm">Just a moment ✨</p>
      </div>
    </div>
    <script>
      window.addEventListener("load", function() {
        const loader = document.getElementById("pageLoader");
        if (loader) {
          loader.style.opacity = "0";
          loader.style.transition = "opacity 0.3s ease";
          setTimeout(() => loader.style.display = "none", 300);
        }
      });
      setTimeout(() => {
        const loader = document.getElementById("pageLoader");
        if (loader) loader.style.display = "none";
      }, 5000);
    </script>
</head>

<body class="min-h-screen bg-gradient-to-tr from-white to-blue-50 pb-20 sm:pb-24">
    <!-- Skip to content link -->
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
            ['name' => 'English', 'flag' => 'us'],
            ['name' => 'Français', 'flag' => 'fr'],
            ['name' => 'Español', 'flag' => 'es'],
            ['name' => 'Português', 'flag' => 'pt'],
            ['name' => 'Deutsch', 'flag' => 'de'],
            ['name' => 'Italiano', 'flag' => 'it'],
            ['name' => 'العربية', 'flag' => 'sa'],
            ['name' => '日本語', 'flag' => 'jp'],
            ['name' => '한국어', 'flag' => 'kr'],
            ['name' => 'हिन्दी', 'flag' => 'in'],
            ['name' => '中文', 'flag' => 'cn'],
            ['name' => 'Русский', 'flag' => 'ru']
        ];
    @endphp
    
    <!-- Sticky Header with Progress -->
    <header class="sticky top-0 sticky-header bg-white/98 backdrop-blur-md border-b-2 border-gray-200 section-spacing shadow-sm">
        <div class="max-w-3xl mx-auto">
            <div class="w-full bg-gray-200 h-1.5 rounded-full mb-2 overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div id="progressBar" class="h-full bg-blue-600 rounded-full" style="width: 0%"></div>
            </div>
            
            <div class="flex items-center justify-between mb-1">
                <span id="stepCounter" class="text-sm font-semibold text-gray-700">Step 1</span>
                <span id="funText" class="text-xs font-semibold transition-colors duration-300" style="color: #2563eb" aria-live="polite">Let's go! 🚀</span>
            </div>
            <h1 id="formStepLabel" class="text-lg sm:text-xl md:text-2xl font-bold text-blue-700 leading-tight">Which country do you need help in?</h1>
        </div>
    </header>
    
    <!-- Main Content -->
    <main id="main-content" class="max-w-3xl mx-auto section-spacing py-3 sm:py-4">
        <div class="md:border-4 md:border-blue-300 md:rounded-3xl md:p-4 lg:p-6 md:bg-white md:shadow-xl">
            <form action="{{ route('save-request-form') }}" id="helpRequestForm" method="POST" novalidate>
                @csrf
                
                <!-- Step 1: Country Need -->
                <fieldset class="form-step">
                    <legend class="sr-only">Select the country where you need help</legend>
                    <label for="countryNeed" class="sr-only">Country where you need help</label>
                    <select 
                        id="countryNeed" 
                        name="countryNeed" 
                        class="w-full p-4 text-base bg-white border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                
                <!-- Step 2: Origin Country -->
                <fieldset class="form-step hidden">
                    <legend class="sr-only">Select your country of origin</legend>
                    <label for="originCountry" class="sr-only">Country of origin</label>
                    <select 
                        id="originCountry" 
                        name="originCountry" 
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                
                <!-- Step 3: Current City -->
                <fieldset class="form-step hidden">
                    <legend class="sr-only">Enter your current city</legend>
                    <label for="currentCity" class="sr-only">Current city</label>
                    <input 
                        type="text"
                        id="currentCity"
                        name="currentCity"
                        placeholder="E.g.: Paris, Lyon, Marseille..."
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                
                <!-- Step 4: Duration -->
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
                
                <!-- Step 5: Request Details -->
                <fieldset class="form-step hidden space-y-4">
                    <legend class="sr-only">Describe your help request</legend>
                    <div>
                        <label for="requestTitle" class="sr-only">Request title (minimum 15 characters)</label>
                        <input
                            type="text"
                            id="requestTitle"
                            name="requestTitle"
                            placeholder="E.g.: Help with moving, Document translation..."
                            class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                            class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl resize-none focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- Step 6: Photos -->
                <fieldset class="form-step hidden space-y-4">
                    <legend class="sr-only">Add photos to your request (optional)</legend>
                    <div class="grid grid-cols-2 gap-3">
                        @for ($i = 1; $i <= 4; $i++)
                        <div class="photo-upload-box border-2 border-blue-400 rounded-2xl p-4 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-100 hover:border-blue-500 transition-all min-h-[120px] active:scale-95 bg-blue-50 shadow-sm">
                            <button type="button" class="photo-menu-btn w-full h-full flex flex-col items-center justify-center focus:outline-none" aria-label="Upload photo {{ $i }}">
                                <img src="{{ asset('images/uploadpng.png') }}" alt="" class="w-10 h-10 mb-2 photo-preview" loading="lazy" decoding="async" />
                                <span class="text-sm text-blue-700 font-semibold">Add photo</span>
                            </button>
                            <input type="file" name="photo{{ $i }}" class="hidden photo-input" accept="image/*" aria-label="Photo {{ $i }}" />
                        </div>
                        @endfor
                    </div>
                    <div class="info-box bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-200 rounded-2xl p-3 shadow-sm">
                        <p class="text-sm text-indigo-900 leading-relaxed">
                            🖼️ <strong>Optional</strong> — Only <strong>photos</strong> are accepted
                        </p>
                    </div>
                </fieldset>
                
                <!-- Step 7: Support Type -->
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
                
                <!-- Step 8: Urgency -->
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
                
                <!-- Step 9: Languages -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">What languages do you speak?</legend>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-w-2xl mx-auto" role="group" aria-labelledby="languages-label">
                        <span id="languages-label" class="sr-only">Select languages you speak</span>
                        @foreach($languages as $lang)
                        <label class="lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95">
                            <img src="https://flagcdn.com/{{ $lang['flag'] }}.svg" alt="{{ $lang['name'] }} flag" class="w-5 h-3 rounded pointer-events-none" loading="lazy" decoding="async" />
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
                
                <!-- Step 10: First Name -->
                <fieldset class="form-step hidden" id="step10-name">
                    <legend class="sr-only">Enter your first name</legend>
                    <label for="firstName" class="sr-only">First name</label>
                    <input
                        type="text"
                        id="firstName"
                        name="firstName"
                        placeholder="Your first name"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                
                <!-- Step 11: Email -->
                <fieldset class="form-step hidden" id="step11-email">
                    <legend class="sr-only">Enter your email address</legend>
                    <label for="email" class="sr-only">Email address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your-email@example.com"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
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
                
                <!-- Step 12: Password -->
                <fieldset class="form-step hidden" id="step12-password">
                    <legend class="sr-only">Choose a password</legend>
                    <label for="password" class="sr-only">Password (minimum 6 characters)</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Choose a secure password (min 6 chars)"
                        class="w-full p-4 text-base bg-blue-50 border-2 border-blue-300 rounded-2xl focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition-all shadow-sm"
                        required
                        aria-required="true"
                        aria-describedby="passwordStrength"
                        autocomplete="new-password"
                        @if(Auth::check())
                            value="{{ Auth::user()->password }}"
                            disabled
                        @endif
                    />
                    <div id="passwordStrength" class="mt-3">
                        <div class="flex justify-between text-xs mb-1">
                            <span id="strengthText" class="font-semibold text-gray-700">Password strength</span>
                            <span id="strengthLabel" class="font-semibold text-gray-500">Too short</span>
                        </div>
                        <div class="w-full bg-gray-200 h-1.5 rounded-full overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-live="polite">
                            <div id="strengthBar" class="h-full bg-gray-300 transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="info-box bg-gradient-to-r from-fuchsia-50 to-pink-50 border-2 border-fuchsia-200 rounded-2xl p-4 mt-4 shadow-sm">
                        <p class="text-sm text-fuchsia-900 leading-relaxed">
                            🔐 Use at least <strong>6 characters</strong> — 8+ recommended
                        </p>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- Step 13: Service Duration -->
                <fieldset class="form-step hidden space-y-3">
                    <legend class="sr-only">How long should your request remain visible?</legend>
                    <div class="flex flex-col sm:flex-row justify-center gap-3" role="group" aria-labelledby="duration-label-13">
                        <span id="duration-label-13" class="sr-only">Select service duration</span>
                        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="1 week" aria-pressed="false">1 week</button>
                        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="2 weeks" aria-pressed="false">2 weeks</button>
                        <button type="button" class="duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100" data-duration="1 month" aria-pressed="false">1 month</button>
                    </div>
                    <input type="hidden" id="serviceDuration" name="serviceDuration" />
                    
                    <div class="bg-yellow-100 border-l-4 border-yellow-400 p-3 rounded-xl shadow-sm" role="note">
                        <p class="text-sm text-gray-800 leading-relaxed">
                            <strong>Note:</strong> Your request will be automatically deleted after you choose a service provider. You'll need to submit a new request if you need help again.
                        </p>
                    </div>
                    
                    <div class="bg-yellow-100 border-l-4 border-yellow-400 p-3 rounded-xl shadow-sm flex items-start gap-2">
                        <input type="checkbox" id="termsCheckbox" class="mt-0.5 w-4 h-4 rounded border-gray-300" required aria-required="true" />
                        <label for="termsCheckbox" class="text-sm text-gray-800 leading-relaxed cursor-pointer">
                            By clicking next I acknowledge that I have read and understood the <span class="font-semibold">terms & conditions</span> for service requests.
                        </label>
                    </div>
                    <p class="text-xs text-red-500 mt-2 font-semibold text-center" aria-live="polite">* Required</p>
                </fieldset>
                
                <!-- Step 14: Loading -->
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
                
                <!-- Step 15: Success -->
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
    
    <!-- Popup for Expat Helper -->
    <aside id="expatPopup" class="fixed bottom-28 right-4 left-4 md:left-auto md:right-6 max-w-sm bg-gradient-to-br from-purple-600 to-indigo-600 text-white p-4 rounded-2xl shadow-2xl hidden animate-slideUp modal-overlay" role="complementary" aria-labelledby="popup-title">
        <button type="button" onclick="document.getElementById('expatPopup').classList.add('hidden')" class="absolute top-1 right-1 text-white text-2xl font-bold hover:bg-white/20 w-7 h-7 rounded-full flex items-center justify-center" aria-label="Close popup">×</button>
        <p id="popup-title" class="text-sm font-bold mb-1">👋 Hey! Did you know?</p>
        <p class="text-xs leading-relaxed">
            If you become an <strong>expat helper</strong>, you can earn income! 💰<br><br>
            You take the missions you want and earn income. <strong>Cool, right?</strong> 😎
        </p>
    </aside>
    
    <!-- Validation Error Popup -->
    <div id="validationError" class="fixed top-20 left-1/2 transform -translate-x-1/2 max-w-md bg-gradient-to-r from-orange-500 to-red-500 text-white px-5 py-3 rounded-2xl shadow-2xl hidden animate-slideDown modal-overlay" role="alert" aria-live="assertive">
        <p id="validationMessage" class="text-sm font-bold text-center"></p>
    </div>
    
    <!-- CGV Warning Popup -->
    <div id="cgvWarning" class="fixed top-20 left-1/2 transform -translate-x-1/2 max-w-md bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 px-5 py-3 rounded-2xl shadow-2xl hidden animate-slideDown modal-overlay" role="alert" aria-live="assertive">
        <p class="text-sm font-bold text-center">⚠️ Don't forget to check the T&C below! 📝✅</p>
    </div>
    
    <!-- Sticky Footer Navigation -->
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
                class="px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md bg-gray-300 text-gray-500"
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
                    <i class="fa fa-image text-blue-600" aria-hidden="true"></i>
                    <span class="text-sm font-medium">Photo library</span>
                </button>
                <button type="button" class="photo-menu-option w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 transition-all border-2 border-transparent hover:border-blue-200" data-action="camera">
                    <i class="fa fa-camera text-blue-600" aria-hidden="true"></i>
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
    
    <!-- Share Button -->
    <button id="shareBtn" onclick="openSimpleShare()" class="fixed bottom-20 right-6 z-50 w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center group" aria-label="Share this page">
      <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
      </svg>
    </button>

    <div id="sharePopup" class="hidden fixed inset-0 z-[9999] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeSimpleShare()">
      <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-5" style="animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-lg font-bold text-gray-800">Share</h3>
          <button onclick="closeSimpleShare()" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        <div class="grid grid-cols-4 gap-2 mb-3">
          <button onclick="shareVia('whatsapp')" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">WhatsApp</span>
          </button>
          
          <button onclick="shareVia('facebook')" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Facebook</span>
          </button>
          
          <button onclick="shareVia('twitter')" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group">
            <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Twitter</span>
          </button>
          
          <button onclick="shareVia('copy')" class="flex flex-col items-center gap-1 p-2 rounded-xl hover:bg-gray-50 transition-colors group">
            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
              </svg>
            </div>
            <span class="text-xs text-gray-600 font-medium">Copy</span>
          </button>
        </div>
        
        <div class="bg-blue-50 rounded-xl p-2 text-xs text-blue-700 text-center">
          <p class="font-medium">💡 Share with your friends!</p>
        </div>
      </div>
    </div>

    <style>
      @keyframes scaleIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
      }
    </style>

    <script>
      function openSimpleShare() { document.getElementById('sharePopup').classList.remove('hidden'); }
      function closeSimpleShare() { document.getElementById('sharePopup').classList.add('hidden'); }
      function shareVia(platform) {
        const url = window.location.href;
        const text = 'I found this amazing help request form!';
        let shareUrl;
        switch(platform) {
          case 'whatsapp': shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`; break;
          case 'facebook': shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`; break;
          case 'twitter': shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`; break;
          case 'copy':
            navigator.clipboard.writeText(url).then(() => {
              const btn = event.target.closest('button');
              const original = btn.innerHTML;
              btn.innerHTML = '<div class="flex flex-col items-center gap-1 p-2"><div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center"><svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></div><span class="text-xs text-green-600 font-medium">Copied!</span></div>';
              setTimeout(() => btn.innerHTML = original, 2000);
            });
            return;
        }
        if (shareUrl) window.open(shareUrl, '_blank', 'width=600,height=400');
        setTimeout(() => closeSimpleShare(), 500);
      }
      document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSimpleShare(); });
    </script>

    <div id="shareSuccessPopup" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="success-title">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-5 transform transition-all scale-95 opacity-0" id="popupContent">
            <div class="text-center mb-3">
                <div class="inline-block bg-gradient-to-br from-green-400 to-emerald-500 rounded-full p-3 mb-2 animate-bounce">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 id="success-title" class="text-xl font-bold text-gray-900 mb-1">Awesome! 🎉</h3>
                <p class="text-gray-600 text-xs">Thank you for sharing!</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-3 mb-3 border border-green-200">
                <div class="flex items-center justify-center">
                    <span class="text-base font-bold text-green-600 text-center">Share and earn 75% affiliate commission</span>
                </div>
            </div>
            <button onclick="closeSharePopup()" class="w-full bg-gradient-to-r from-green-400 to-emerald-500 hover:from-green-500 hover:to-emerald-600 text-white font-bold py-2.5 rounded-xl transition-all text-sm">
                Got it!
            </button>
        </div>
    </div>
    
    <!-- Scripts -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/js/countrySelect.min.js"></script>
    
    <script>
    (function() {
        'use strict';
        
        const funTexts = @json($funTexts);
        const stepLabels = @json($stepLabels);
        
        const steps = document.querySelectorAll('.form-step');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const progressBar = document.getElementById('progressBar');
        const stepLabel = document.getElementById('formStepLabel');
        const stepCounter = document.getElementById('stepCounter');
        const funText = document.getElementById('funText');
        const stickyNav = document.getElementById('stickyNav');
        
        let currentStep = 0;
        const totalSteps = 15;
        
        // Character counters
        const requestTitle = document.getElementById('requestTitle');
        const titleCount = document.getElementById('titleCount');
        const titleCounter = document.getElementById('titleCounter');
        const moreDetails = document.getElementById('moreDetails');
        const detailsCount = document.getElementById('detailsCount');
        const detailsCounter = document.getElementById('detailsCounter');
        
        if (requestTitle && titleCount) {
            requestTitle.addEventListener('input', function() {
                const length = this.value.length;
                titleCount.textContent = length + '/15';
                if (length >= 15) {
                    titleCounter.className = 'mt-3 text-sm text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                    titleCounter.innerHTML = '✅ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
                } else {
                    titleCounter.className = 'mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                    titleCounter.innerHTML = '⚠️ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
                }
                updateNextButton();
            });
        }
        
        if (moreDetails && detailsCount) {
            moreDetails.addEventListener('input', function() {
                const length = this.value.length;
                detailsCount.textContent = length;
                if (length >= 50) {
                    detailsCounter.className = 'mt-3 text-sm flex justify-between text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                    detailsCounter.innerHTML = '<span>✅ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
                } else {
                    detailsCounter.className = 'mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                    detailsCounter.innerHTML = '<span>⚠️ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
                }
                updateNextButton();
            });
        }
        
        // Password strength
        const password = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthLabel = document.getElementById('strengthLabel');
        
        if (password && strengthBar) {
            password.addEventListener('input', function() {
                const length = this.value.length;
                let strength = 0;
                let text = 'Too short';
                let color = 'bg-gray-300';
                
                if (length < 6) {
                    strength = 0;
                    text = 'Too short';
                    color = 'bg-gray-300';
                } else if (length < 8) {
                    strength = 33;
                    text = 'Weak';
                    color = 'bg-red-500';
                } else if (length < 10) {
                    strength = 66;
                    text = 'Medium';
                    color = 'bg-yellow-500';
                } else {
                    strength = 100;
                    text = 'Strong';
                    color = 'bg-green-500';
                }
                
                strengthBar.style.width = strength + '%';
                strengthBar.setAttribute('aria-valuenow', strength);
                strengthBar.className = 'h-full transition-all duration-300 ' + color;
                strengthLabel.textContent = text;
                updateNextButton();
            });
        }
        
        // Duration buttons
        const durationButtons = document.querySelectorAll('.option-btn');
        const durationInput = document.getElementById('durationHere');
        
        durationButtons.forEach(button => {
            button.addEventListener('click', function() {
                durationButtons.forEach(btn => {
                    btn.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                    btn.setAttribute('aria-pressed', 'false');
                    if (btn.classList.contains('sm:col-span-2')) {
                        btn.classList.add('sm:col-span-2');
                    }
                });
                this.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
                this.setAttribute('aria-pressed', 'true');
                if (this.classList.contains('sm:col-span-2')) {
                    this.classList.add('sm:col-span-2');
                }
                durationInput.value = this.getAttribute('data-value');
                
                // Show popup for long durations
                const value = this.getAttribute('data-value');
                if (['1-2 years', '2-5 years', 'More than 5 years'].includes(value)) {
                    const popup = document.getElementById('expatPopup');
                    popup.classList.remove('hidden');
                    popup.style.zIndex = '9999';
                    setTimeout(() => popup.classList.add('hidden'), 5000);
                }
                updateNextButton();
            });
        });
        
        // Support type radios
        const supportOptions = document.querySelectorAll('.support-option');
        supportOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            radio.addEventListener('change', function() {
                supportOptions.forEach(opt => {
                    opt.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100';
                });
                if (this.checked) {
                    option.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
                }
                updateNextButton();
            });
        });
        
        // Urgency radios
        const urgencyOptions = document.querySelectorAll('.urgency-option');
        urgencyOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            radio.addEventListener('change', function() {
                urgencyOptions.forEach(opt => {
                    opt.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100';
                });
                if (this.checked) {
                    option.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
                }
                updateNextButton();
            });
        });
        
        // Language selection
        const langOptions = document.querySelectorAll('.lang-option');
        langOptions.forEach(option => {
            const checkbox = option.querySelector('.lang-checkbox');
            
            option.addEventListener('click', function(e) {
                checkbox.checked = !checkbox.checked;
                
                if (checkbox.checked) {
                    this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
                } else {
                    this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95';
                }
                
                updateNextButton();
            });
            
            checkbox.addEventListener('click', function(e) {
                e.preventDefault();
            });
        });
        
        // Service duration buttons
        const serviceDurationBtns = document.querySelectorAll('.duration-btn');
        const serviceDurationInput = document.getElementById('serviceDuration');
        
        serviceDurationBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                serviceDurationBtns.forEach(b => {
                    b.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                    b.setAttribute('aria-pressed', 'false');
                });
                this.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
                this.setAttribute('aria-pressed', 'true');
                serviceDurationInput.value = this.getAttribute('data-duration');
                updateNextButton();
            });
        });
        
        // Terms checkbox
        const termsCheckbox = document.getElementById('termsCheckbox');
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', updateNextButton);
        }
        
        // Show step
        function showStep(index) {
            @if(Auth::check())
            if (index >= 9 && index <= 11) {
                currentStep = 12;
                index = 12;
            }
            @endif
            
            steps.forEach((step, i) => step.classList.toggle('hidden', i !== index));
            
            const progress = ((index + 1) / totalSteps) * 100;
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', Math.round(progress));
            
            if (stepLabel && stepLabels[index]) {
                stepLabel.textContent = stepLabels[index];
            }
            
            if (stepCounter) {
                if (index < 12) {
                    stepCounter.textContent = 'Step ' + (index + 1);
                } else if (index === 12) {
                    stepCounter.textContent = 'Step 12b';
                } else {
                    stepCounter.textContent = '';
                }
            }
            
            if (funText && funTexts[index]) {
                funText.textContent = funTexts[index].text;
                funText.style.color = funTexts[index].color;
            }
            
            // Navigation visibility
            if (index === 0) {
                prevBtn.style.visibility = 'hidden';
            } else {
                prevBtn.style.visibility = 'visible';
            }
            
            if (index === 13 || index === 14) {
                stickyNav.classList.add('hidden');
            } else {
                stickyNav.classList.remove('hidden');
            }
            
            // Auto-advance on loading step
            if (index === 13) {
                setTimeout(() => {
                    currentStep++;
                    showStep(currentStep);
                }, 2000);
            }
            
            // Focus management
            const currentStepEl = steps[index];
            if (currentStepEl) {
                const firstInput = currentStepEl.querySelector('input:not([type="hidden"]):not(.lang-checkbox), select, textarea, button[type="button"]:not(.photo-menu-btn)');
                if (firstInput && index !== 13 && index !== 14) {
                    setTimeout(() => firstInput.focus(), 100);
                }
            }
            
            updateNextButton();
        }
        
        // Validate step
        function validateStep(stepIndex) {
            if ([13, 14].includes(stepIndex)) return true;
            
            const step = steps[stepIndex];
            let valid = true;
            let message = '';
            
            switch(stepIndex) {
                case 0:
                    const countryNeed = document.getElementById('countryNeed');
                    if (!countryNeed.value) {
                        message = 'Please select a country';
                        valid = false;
                        countryNeed.focus();
                    }
                    break;
                    
                case 1:
                    const originCountry = document.getElementById('originCountry');
                    if (!originCountry.value) {
                        message = 'Please select your country of origin';
                        valid = false;
                        originCountry.focus();
                    }
                    break;
                    
                case 2:
                    valid = true;
                    break;
                    
                case 3:
                    const durationHere = document.getElementById('durationHere');
                    if (!durationHere.value) {
                        message = 'Please select how long you have been here';
                        valid = false;
                    }
                    break;
                    
                case 4:
                    const title = document.getElementById('requestTitle');
                    const details = document.getElementById('moreDetails');
                    if (!title.value || title.value.length < 15) {
                        message = 'Title must be at least 15 characters';
                        valid = false;
                        title.focus();
                    } else if (!details.value || details.value.length < 50) {
                        message = 'Details must be at least 50 characters';
                        valid = false;
                        details.focus();
                    }
                    break;
                    
                case 5:
                    valid = true;
                    break;
                    
                case 6:
                    const supportType = document.querySelector('input[name="supportType"]:checked');
                    if (!supportType) {
                        message = 'Please select a support type';
                        valid = false;
                    }
                    break;
                    
                case 7:
                    const urgency = document.querySelector('input[name="urgency"]:checked');
                    if (!urgency) {
                        message = 'Please select urgency level';
                        valid = false;
                    }
                    break;
                    
                case 8:
                    const languages = document.querySelectorAll('input[name="languages[]"]:checked');
                    if (languages.length === 0) {
                        message = 'Please select at least one language';
                        valid = false;
                    }
                    break;
                    
                case 9:
                    const firstName = document.getElementById('firstName');
                    if (!firstName.value) {
                        message = 'Please enter your first name';
                        valid = false;
                        firstName.focus();
                    }
                    break;
                    
                case 10:
                    const email = document.getElementById('email');
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!email.value || !emailPattern.test(email.value)) {
                        message = 'Please enter a valid email address';
                        valid = false;
                        email.focus();
                    } else {
                        checkEmailAndLogin(email.value);
                    }
                    break;
                    
                case 11:
                    const pwd = document.getElementById('password');
                    if (!pwd.value || pwd.value.length < 6) {
                        message = 'Password must be at least 6 characters';
                        valid = false;
                        pwd.focus();
                    }
                    break;
                    
                case 12:
                    const duration = document.getElementById('serviceDuration');
                    const terms = document.getElementById('termsCheckbox');
                    if (!duration.value) {
                        message = 'Please select service duration';
                        valid = false;
                    } else if (!terms.checked) {
                        showCGVWarning();
                        valid = false;
                        terms.focus();
                    }
                    break;
            }
            
            if (!valid && message) {
                showValidationError(message);
            }
            
            return valid;
        }
        
        // Show validation error
        function showValidationError(message) {
            const errorDiv = document.getElementById('validationError');
            const messageEl = document.getElementById('validationMessage');
            messageEl.textContent = message;
            errorDiv.classList.remove('hidden');
            errorDiv.style.zIndex = '9999';
            setTimeout(() => errorDiv.classList.add('hidden'), 3000);
        }
        
        // Show CGV warning
        function showCGVWarning() {
            const warningDiv = document.getElementById('cgvWarning');
            warningDiv.classList.remove('hidden');
            warningDiv.style.zIndex = '9999';
            setTimeout(() => warningDiv.classList.add('hidden'), 3000);
        }
        
        // Update next button
        function updateNextButton() {
            let canProceed = false;
            
            switch(currentStep) {
                case 0:
                    canProceed = !!document.getElementById('countryNeed').value;
                    break;
                case 1:
                    canProceed = !!document.getElementById('originCountry').value;
                    break;
                case 2:
                    canProceed = true;
                    break;
                case 3:
                    canProceed = !!document.getElementById('durationHere').value;
                    break;
                case 4:
                    const title = document.getElementById('requestTitle').value;
                    const details = document.getElementById('moreDetails').value;
                    canProceed = title.length >= 15 && details.length >= 50;
                    break;
                case 5:
                    canProceed = true;
                    break;
                case 6:
                    canProceed = !!document.querySelector('input[name="supportType"]:checked');
                    break;
                case 7:
                    canProceed = !!document.querySelector('input[name="urgency"]:checked');
                    break;
                case 8:
                    canProceed = document.querySelectorAll('input[name="languages[]"]:checked').length > 0;
                    break;
                case 9:
                    canProceed = !!document.getElementById('firstName').value;
                    break;
                case 10:
                    const email = document.getElementById('email').value;
                    canProceed = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                    break;
                case 11:
                    canProceed = document.getElementById('password').value.length >= 6;
                    break;
                case 12:
                    canProceed = !!document.getElementById('serviceDuration').value && document.getElementById('termsCheckbox').checked;
                    break;
                default:
                    canProceed = true;
            }
            
            if (canProceed) {
                nextBtn.className = 'px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md bg-blue-600 text-white hover:bg-blue-700 hover:shadow-lg active:scale-95 cursor-pointer';
                nextBtn.disabled = false;
            } else {
                nextBtn.className = 'px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md bg-gray-300 text-gray-500 cursor-not-allowed';
                nextBtn.disabled = true;
            }
        }
        
        // Store step data
        function storeStepData(stepIndex) {
            const expats = JSON.parse(localStorage.getItem('help-request')) || {};
            
            switch (stepIndex) {
                case 0:
                    expats.countryNeed = document.getElementById('countryNeed').value;
                    break;
                case 1:
                    expats.originCountry = document.getElementById('originCountry').value;
                    break;
                case 2:
                    expats.currentCity = document.getElementById('currentCity').value;
                    break;
                case 3:
                    expats.durationHere = document.getElementById('durationHere').value;
                    break;
                case 4:
                    expats.requestTitle = document.getElementById('requestTitle').value;
                    expats.moreDetails = document.getElementById('moreDetails').value;
                    break;
                case 6:
                    const supportType = document.querySelector('input[name="supportType"]:checked');
                    expats.supportType = supportType ? supportType.value : null;
                    break;
                case 7:
                    const urgency = document.querySelector('input[name="urgency"]:checked');
                    expats.urgency = urgency ? urgency.value : null;
                    break;
                case 8:
                    const languages = Array.from(document.querySelectorAll('input[name="languages[]"]:checked')).map(cb => cb.value);
                    expats.languages = languages;
                    break;
                case 9:
                    expats.firstName = document.getElementById('firstName').value;
                    break;
                case 10:
                    expats.email = document.getElementById('email').value;
                    break;
                case 11:
                    expats.password = document.getElementById('password').value;
                    break;
                case 12:
                    expats.serviceDuration = document.getElementById('serviceDuration').value;
                    break;
            }
            
            localStorage.setItem('help-request', JSON.stringify(expats));
        }
        
        // Restore step data
        function restoreStepData() {
            const expats = JSON.parse(localStorage.getItem('help-request')) || {};
            
            if (expats.countryNeed) document.getElementById('countryNeed').value = expats.countryNeed;
            if (expats.originCountry) document.getElementById('originCountry').value = expats.originCountry;
            if (expats.currentCity) document.getElementById('currentCity').value = expats.currentCity;
            if (expats.durationHere) document.getElementById('durationHere').value = expats.durationHere;
            if (expats.requestTitle) {
                document.getElementById('requestTitle').value = expats.requestTitle;
                document.getElementById('requestTitle').dispatchEvent(new Event('input'));
            }
            if (expats.moreDetails) {
                document.getElementById('moreDetails').value = expats.moreDetails;
                document.getElementById('moreDetails').dispatchEvent(new Event('input'));
            }
            if (expats.firstName) document.getElementById('firstName').value = expats.firstName;
            if (expats.email) document.getElementById('email').value = expats.email;
            if (expats.password) {
                document.getElementById('password').value = expats.password;
                document.getElementById('password').dispatchEvent(new Event('input'));
            }
            if (expats.serviceDuration) document.getElementById('serviceDuration').value = expats.serviceDuration;
            
            // Restore language selections
            if (expats.languages && Array.isArray(expats.languages)) {
                expats.languages.forEach(lang => {
                    const checkbox = document.querySelector('input[name="languages[]"][value="' + lang + '"]');
                    if (checkbox) {
                        checkbox.checked = true;
                        const option = checkbox.closest('.lang-option');
                        if (option) {
                            option.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
                        }
                    }
                });
            }
        }
        
        restoreStepData();
        
        // Input listeners for real-time button updates
        document.querySelectorAll('input:not([type="hidden"]):not(.lang-checkbox), select, textarea').forEach(el => {
            el.addEventListener('input', updateNextButton);
            el.addEventListener('change', updateNextButton);
        });
        
        // Next button
        nextBtn.addEventListener('click', () => {
            if (currentStep < totalSteps - 1) {
                if (!validateStep(currentStep)) return;
                
                storeStepData(currentStep);
                
                @if(Auth::check())
                if (currentStep === 8) {
                    currentStep = 11;
                }
                @endif
                
                if (currentStep === 12) {
                    // AJAX submit
                    const form = document.getElementById('helpRequestForm');
                    const formData = new FormData(form);
                    const expats = JSON.parse(localStorage.getItem('help-request')) || {};
                    
                    Object.entries(expats).forEach(([key, val]) => {
                        if (!formData.has(key)) {
                            if (Array.isArray(val)) {
                                val.forEach(v => formData.append(key + '[]', v));
                            } else {
                                formData.append(key, val);
                            }
                        }
                    });
                    
                    const categories = JSON.parse(localStorage.getItem('create-request')) || {};
                    if (categories) {
                        formData.append('category', categories.category || '');
                        formData.append('subcategory', categories.sub_category || '');
                        formData.append('subcategory2', categories.child_category || '');
                    }
                    
                    nextBtn.disabled = true;
                    nextBtn.setAttribute('aria-busy', 'true');
                    
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        localStorage.removeItem('help-request');
                        localStorage.removeItem('create-request');
                        currentStep++;
                        showStep(currentStep);
                        const adLink = document.getElementById('see-my-ad');
                        if (data.mission_id && adLink) {
                            adLink.href = '/quote-offer?id=' + data.mission_id;
                        }
                    })
                    .catch((error) => {
                        console.error('Submission failed:', error);
                        showValidationError('Submission failed. Please try again.');
                    })
                    .finally(() => {
                        nextBtn.disabled = false;
                        nextBtn.setAttribute('aria-busy', 'false');
                    });
                    return;
                }
                
                currentStep++;
                showStep(currentStep);
            }
        });
        
        // Previous button
        prevBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                storeStepData(currentStep);
                currentStep--;
                showStep(currentStep);
            }
        });
        
        // Photo upload
        const photoBoxes = document.querySelectorAll('.photo-upload-box');
        const photoMenuModal = document.getElementById('photoMenuModal');
        const photoMenuOptions = document.querySelectorAll('.photo-menu-option');
        const closePhotoMenuModal = document.getElementById('closePhotoMenuModal');
        let activePhotoInput = null;
        let activePhotoPreview = null;
        
        const cameraModal = document.getElementById('cameraModal');
        const cameraVideo = document.getElementById('cameraVideo');
        const capturePhotoBtn = document.getElementById('capturePhotoBtn');
        const closeCameraModal = document.getElementById('closeCameraModal');
        let cameraStream = null;
        
        photoBoxes.forEach(box => {
            const menuBtn = box.querySelector('.photo-menu-btn');
            const input = box.querySelector('.photo-input');
            const preview = box.querySelector('.photo-preview');
            
            menuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                activePhotoInput = input;
                activePhotoPreview = preview;
                photoMenuModal.classList.remove('hidden');
                photoMenuModal.style.zIndex = '9999';
            });
            
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                // Validate file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showValidationError('File size must be less than 5MB');
                    return;
                }
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    showValidationError('Only image files are allowed');
                    return;
                }
                
                preview.src = URL.createObjectURL(file);
            });
        });
        
        photoMenuOptions.forEach(option => {
            option.addEventListener('click', function() {
                const action = option.getAttribute('data-action');
                photoMenuModal.classList.add('hidden');
                if (!activePhotoInput) return;
                
                if (action === 'library' || action === 'file') {
                    activePhotoInput.click();
                } else if (action === 'camera') {
                    cameraModal.classList.remove('hidden');
                    cameraModal.style.zIndex = '9999';
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        navigator.mediaDevices.getUserMedia({ 
                            video: { 
                                facingMode: 'environment',
                                width: { ideal: 1280 },
                                height: { ideal: 720 }
                            } 
                        })
                        .then(function(stream) {
                            cameraStream = stream;
                            cameraVideo.srcObject = stream;
                            cameraVideo.play();
                        })
                        .catch(function(err) {
                            console.error('Camera access denied:', err);
                            showValidationError('Camera access denied');
                            cameraModal.classList.add('hidden');
                        });
                    }
                }
            });
        });
        
        if (closePhotoMenuModal) {
            closePhotoMenuModal.onclick = function() {
                photoMenuModal.classList.add('hidden');
            };
        }
        
        photoMenuModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
        
        // Close camera modal properly
        function closeCameraAndStream() {
            cameraModal.classList.add('hidden');
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
            if (cameraVideo.srcObject) {
                cameraVideo.srcObject.getTracks().forEach(track => track.stop());
                cameraVideo.srcObject = null;
            }
        }
        
        if (closeCameraModal) {
            closeCameraModal.onclick = closeCameraAndStream;
        }
        
        cameraModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCameraAndStream();
            }
        });
        
        if (capturePhotoBtn) {
            capturePhotoBtn.onclick = function() {
                if (!cameraVideo.srcObject) return;
                const canvas = document.createElement('canvas');
                canvas.width = cameraVideo.videoWidth;
                canvas.height = cameraVideo.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(cameraVideo, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL('image/png');
                if (activePhotoPreview) {
                    activePhotoPreview.src = dataURL;
                }
                closeCameraAndStream();
            };
        }
        
        // Check email and login
        function checkEmailAndLogin(email) {
            fetch('/check-email-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateHeaderUI(data.user);
                    currentStep = 12;
                    showStep(currentStep);
                }
            })
            .catch(err => {
                console.error('Error checking email:', err);
            });
        }
        
        // Update header UI
        function updateHeaderUI(user) {
            const authButtonsContainer = document.querySelector('.flex.items-center.space-x-3');
            if (!authButtonsContainer) return;
            
            const userMenuHTML = `
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
                             style="background-image: url('${user.avatar || '/images/helpexpat.png'}');">
                        </div>
                        <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">
                            ${user.name || 'User'}
                        </span>
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
                                 style="background-image: url('${user.avatar || '/images/helpexpat.png'}');">
                            </div>
                            <div class="min-w-0">
                                <div id="header-user-fullname" class="font-semibold truncate mb-1">
                                    ${user.name || 'User'}
                                </div>
                                <div class="text-xs">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-medium bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20 truncate max-w-[12rem]">
                                        <i class="fas fa-toolbox text-[11px]"></i>
                                        Service Provider
                                    </span>
                                </div>
                            </div>
                        </div>
                        <nav class="py-1">
                            <a href="/dashboard" 
                               class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" 
                               role="menuitem">
                                <i class="fas fa-gauge"></i>
                                <span>Dashboard</span>
                            </a>
                            <form method="POST" action="/logout" class="mt-1">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" 
                                        role="menuitem">
                                    <i class="fas fa-right-from-bracket"></i>
                                    <span>Log out</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            `;
            
            authButtonsContainer.innerHTML = userMenuHTML;
            if (window.Alpine) {
                window.Alpine.initTree(authButtonsContainer);
            }
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Enter key on Next button
            if (e.key === 'Enter' && !e.shiftKey && !nextBtn.disabled) {
                const activeEl = document.activeElement;
                if (activeEl && activeEl.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    nextBtn.click();
                }
            }
        });
        
        // Initialize
        showStep(currentStep);
        
        // Country select
        if (window.countrySelect) {
            document.querySelectorAll('.country-select').forEach(function(select) {
                window.countrySelect(select, {
                    defaultCountry: "us",
                    onlyCountries: null,
                    responsiveDropdown: true
                });
            });
        }
    })();
    </script>
</body>
</html>