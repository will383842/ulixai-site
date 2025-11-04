<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Découvrez des Prestataires Vérifiés - Ulixai | Services dans 197 Pays</title>
    <meta name="description" content="Connectez-vous avec des prestataires de services vérifiés dans 197 pays. Toutes les langues supportées. Trouvez des helpers de confiance pour visa, logement, déménagement et plus.">
    <meta name="keywords" content="prestataires services, helpers vérifiés, services internationaux, assistance visa, logement étranger, déménagement international, services multilingues, prestataires de confiance">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#2563EB">
    <meta name="author" content="Ulixai">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/providers') }}">
    <meta property="og:title" content="Découvrez des Prestataires Vérifiés - Ulixai">
    <meta property="og:description" content="Connectez-vous avec des prestataires de services vérifiés dans 197 pays. Toutes les langues supportées.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/providers') }}">
    <meta property="twitter:title" content="Découvrez des Prestataires Vérifiés - Ulixai">
    <meta property="twitter:description" content="Connectez-vous avec des prestataires de services vérifiés dans 197 pays.">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://cdn.tailwindcss.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    
    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    
    <!-- Critical inline CSS to prevent FOUC -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary: #2563EB;
            --primary-light: #60A5FA;
            --primary-dark: #1E40AF;
            --accent: #A855F7;
            --success: #10B981;
            --text: #0F172A;
            --text-light: #64748B;
            --text-muted: #94A3B8;
            --bg: #FFFFFF;
            --bg-light: #F8FAFC;
            --border: #E2E8F0;
        }
        
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text);
            background: var(--bg-light);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        /* Prevent flash of unstyled content */
        .hero-providers,
        .provider-card,
        .filters-bar {
            opacity: 1;
            visibility: visible;
        }
        
        /* Modern Hero Section - Inspired by affiliate page */
        .hero-providers {
            position: relative;
            min-height: 60vh;
            display: flex;
            align-items: center;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 50%, #fce7f3 100%);
            overflow: hidden;
        }
        
        .hero-providers::before {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -300px;
            right: -200px;
            filter: blur(80px);
            animation: float 25s ease-in-out infinite;
        }
        
        .hero-providers::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            filter: blur(70px);
            animation: float 20s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        /* Filter Bar */
        .filters-bar {
            background: white;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border);
            margin-bottom: 40px;
            position: sticky;
            top: 80px;
            z-index: 30;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .filter-dropdown {
            position: relative;
        }
        
        .filter-button {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid var(--border);
            background: white;
            color: var(--text);
            border-radius: 16px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        
        .filter-button:hover {
            border-color: var(--primary);
            background: rgba(37, 99, 235, 0.03);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }
        
        .filter-button.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .filter-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: white;
            border: 2px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            max-height: 400px;
            overflow: hidden;
            z-index: 50;
            display: none;
            flex-direction: column;
        }
        
        .filter-menu.show {
            display: flex;
            animation: slideDown 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        @keyframes slideDown {
            from { 
                opacity: 0; 
                transform: translateY(-10px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .filter-search {
            padding: 16px;
            border-bottom: 2px solid var(--border);
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }
        
        .filter-search input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
            background: var(--bg-light);
        }
        
        .filter-search input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .filter-search i {
            position: absolute;
            left: 32px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        
        .filter-options {
            overflow-y: auto;
            max-height: 320px;
            padding: 8px;
        }
        
        .filter-option {
            padding: 12px 16px;
            cursor: pointer;
            border-radius: 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: var(--text);
        }
        
        .filter-option:hover {
            background: rgba(37, 99, 235, 0.06);
            transform: translateX(4px);
        }
        
        .filter-option.selected {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            font-weight: 600;
        }
        
        .filter-option .flag {
            font-size: 20px;
        }
        
        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            margin-left: auto;
        }
        
        .reset-filters {
            padding: 12px 24px;
            background: var(--bg-light);
            border: 2px solid var(--border);
            color: var(--text-light);
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .reset-filters:hover {
            background: #fee2e2;
            border-color: #ef4444;
            color: #dc2626;
        }
        
        /* Provider Cards */
        .provider-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 28px;
            margin-top: 40px;
        }
        
        @media (min-width: 640px) {
            .provider-grid {
                gap: 32px;
            }
        }
        
        .provider-card {
            background: white;
            border-radius: 24px;
            padding: 32px 28px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1.5px solid #e5e7eb;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .provider-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, rgba(168, 85, 247, 0.02) 100%);
            opacity: 0;
            transition: opacity 0.4s;
        }
        
        .provider-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.12);
            border-color: #c7d2fe;
        }
        
        .provider-card:hover::before {
            opacity: 1;
        }
        
        .provider-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.2);
            position: relative;
            z-index: 1;
            overflow: hidden;
            border: 4px solid white;
        }
        
        .provider-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1.5px solid rgba(16, 185, 129, 0.3);
            padding: 6px 14px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 12px;
            color: var(--success);
            margin-bottom: 12px;
        }
        
        .rating-display {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            margin-bottom: 16px;
        }
        
        .star-icon {
            color: #FCD34D;
            font-size: 18px;
        }
        
        .rating-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }
        
        .provider-name {
            font-size: 13px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }
        
        .service-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 16px 0;
            padding-top: 16px;
            border-top: 1.5px solid var(--border);
            position: relative;
            z-index: 1;
        }
        
        .service-tag {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(168, 85, 247, 0.08) 100%);
            border: 1.5px solid var(--primary-light);
            color: var(--primary);
            padding: 7px 15px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 700;
            transition: all 0.3s;
        }
        
        .service-tag:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
        }
        
        .service-tag.more {
            background: var(--bg-light);
            border-color: var(--border);
            color: var(--text-muted);
        }
        
        .btn-see-more {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            font-size: 15px;
            font-weight: 800;
            border-radius: 100px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
            margin-top: auto;
            position: relative;
            z-index: 1;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
        }
        
        .btn-see-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.35);
        }
        
        /* Stats Bar */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
            background: white;
            border-radius: 24px;
            padding: 32px 24px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1.5px solid var(--border);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 40px;
            font-weight: 900;
            color: var(--primary);
            display: block;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
        }
        
        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 600;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
        
        .empty-state-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }
        
        .empty-state h3 {
            font-size: 28px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 12px;
        }
        
        .empty-state p {
            font-size: 16px;
            color: var(--text-light);
            max-width: 500px;
            margin: 0 auto;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-providers {
                padding: 100px 0 60px;
                min-height: 50vh;
            }
            
            .provider-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .filters-bar {
                padding: 20px;
            }
            
            .filter-button {
                font-size: 14px;
                padding: 12px 16px;
            }
        }
        
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 8px;
        }
        
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Scroll reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Performance optimizations */
        .provider-card,
        .filter-button,
        .btn-see-more {
            will-change: transform;
        }
        
        /* Prevent layout shift */
        img {
            height: auto;
        }
        
        /* Share button styles */
        #floatingShareBtn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 50;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-weight: 700;
            padding: 16px 24px;
            border-radius: 100px;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }
        
        #floatingShareBtn:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 32px rgba(16, 185, 129, 0.5);
        }
    </style>
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Prestataires de Services Vérifiés",
        "description": "Liste de prestataires de services vérifiés disponibles dans 197 pays",
        "numberOfItems": "{{ count($providers ?? []) }}",
        "itemListElement": [
            @foreach($providers ?? [] as $index => $provider)
            {
                "@type": "Service",
                "position": {{ $index + 1 }},
                "name": "{{ $provider->first_name }} {{ $provider->last_name }}",
                "provider": {
                    "@type": "Person",
                    "name": "{{ $provider->first_name }} {{ $provider->last_name }}"
                },
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "{{ number_format($provider->reviews()->avg('rating') ?? 5, 1) }}",
                    "bestRating": "5",
                    "worstRating": "1"
                }
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
</head>
<body>
    @include('includes.header')
    @include('pages.popup')

    <!-- Floating Share Button -->
    <button id="floatingShareBtn" onclick="openSharePanel()" aria-label="Partager cette page et gagner une commission">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
        </svg>
        <span class="hidden sm:inline">Partager & Gagner</span>
        <span class="sm:hidden">Partager</span>
        <span aria-hidden="true">💰</span>
    </button>

    <!-- Overlay -->
    <div id="shareOverlay" onclick="closeSharePanel()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" aria-hidden="true"></div>

    <!-- Share Panel Sidebar -->
    <aside id="sharePanel" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 overflow-y-auto" style="overscroll-behavior: contain;" role="dialog" aria-labelledby="share-panel-title" aria-modal="true">
        <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-6 sticky top-0 z-10">
            <div class="flex items-center justify-between mb-4">
                <h2 id="share-panel-title" class="text-white font-bold text-xl flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    Partager & Gagner
                </h2>
                <button onclick="closeSharePanel()" class="text-white/80 hover:text-white transition-colors p-1" aria-label="Fermer le panneau de partage">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            @auth
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white">
                    <p class="text-sm font-semibold mb-1">Votre code d'affiliation</p>
                    <p class="text-lg font-bold font-mono tracking-wider">{{ Auth::user()->affiliate_code }}</p>
                </div>
            @else
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white text-sm">
                    <p class="font-semibold mb-2">🎁 Créez un compte gratuit</p>
                    <p class="text-xs opacity-90 mb-3">Obtenez votre lien d'affiliation et gagnez des commissions !</p>
                    <a href="/signup" class="block w-full bg-white text-green-600 font-bold py-2 px-4 rounded-lg text-center hover:bg-green-50 transition-colors">
                        S'inscrire maintenant
                    </a>
                </div>
            @endauth
        </div>

        <div class="p-6">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2 text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                Partager maintenant
            </h3>

            <div class="grid grid-cols-2 gap-3">
                <a id="shareWhatsAppSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 rounded-xl p-4 border-2 border-green-200 hover:border-green-500 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager sur WhatsApp">
                    <i class="fab fa-whatsapp text-4xl text-green-600 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-green-700 group-hover:text-white uppercase tracking-wide transition-colors">WhatsApp</span>
                </a>

                <a id="shareMessengerSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-400 hover:to-blue-500 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-400 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager sur Messenger">
                    <i class="fab fa-facebook-messenger text-4xl text-blue-500 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-blue-600 group-hover:text-white uppercase tracking-wide transition-colors">Messenger</span>
                </a>

                <a id="shareFacebookSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-500 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager sur Facebook">
                    <i class="fab fa-facebook text-4xl text-blue-600 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">Facebook</span>
                </a>

                <a id="shareTwitterSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-800 hover:to-black rounded-xl p-4 border-2 border-gray-200 hover:border-gray-800 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager sur Twitter">
                    <i class="fab fa-x-twitter text-4xl text-gray-800 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-white uppercase tracking-wide transition-colors">Twitter</span>
                </a>

                <a id="shareLinkedInSlide" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 rounded-xl p-4 border-2 border-blue-200 hover:border-blue-600 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager sur LinkedIn">
                    <i class="fab fa-linkedin text-4xl text-blue-600 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">LinkedIn</span>
                </a>

                <a id="shareEmailSlide" href="#" class="bg-gradient-to-br from-red-50 to-red-100 hover:from-red-500 hover:to-red-600 rounded-xl p-4 border-2 border-red-200 hover:border-red-500 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Partager par Email">
                    <i class="fas fa-envelope text-4xl text-red-600 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-red-700 group-hover:text-white uppercase tracking-wide transition-colors">Email</span>
                </a>

                <button id="copyBtnSlide" class="bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-xl p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-2 transition-all duration-200 group" aria-label="Copier le lien">
                    <i class="fas fa-link text-4xl text-purple-600 group-hover:text-white transition-colors"></i>
                    <span class="text-sm font-bold text-purple-700 group-hover:text-white uppercase tracking-wide transition-colors">Copier</span>
                </button>
            </div>

            <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border-2 border-green-200">
                <div class="flex items-center gap-3 text-green-700">
                    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex-1">
                        <p class="font-bold text-sm">
                            @auth
                                Gagnez des commissions sur chaque inscription !
                            @else
                                Créez un compte pour commencer à gagner
                            @endauth
                        </p>
                        <p class="text-xs text-green-600 mt-1">Partagez cette page et gagnez des récompenses !</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Success Popup -->
    <div id="shareSuccessPopup" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-95 opacity-0" id="popupContent">
            <div class="text-center mb-4">
                <div class="inline-block bg-gradient-to-br from-green-400 to-emerald-500 rounded-full p-4 mb-3 animate-bounce">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Génial ! 🎉</h3>
                <p class="text-gray-600 text-sm">Merci d'avoir partagé !</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 mb-4 border-2 border-green-200">
                <p class="text-sm text-gray-700 text-center">
                    💡 Chaque personne qui s'inscrit via votre lien vous aide à gagner des récompenses !
                </p>
            </div>
            <div class="space-y-2">
                <button onclick="shareAgain()" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105 shadow-lg">
                    Partager encore & Gagner plus 💰
                </button>
                <button onclick="closeSharePopup()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-6 rounded-xl transition-all">
                    Fermer
                </button>
            </div>
        </div>
    </div>

    @auth
    <input type="hidden" id="affiliateLinkShareNew" value="{{ url('/providers') }}?ref={{ Auth::user()->affiliate_code }}">
    @else
    <input type="hidden" id="affiliateLinkShareNew" value="{{ url('/providers') }}">
    @endauth

    <!-- Hero Section -->
    <section class="hero-providers">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-md border border-indigo-200 px-6 py-3 rounded-full mb-8 shadow-lg">
                    <i class="fas fa-users text-indigo-600"></i>
                    <span class="text-indigo-900 font-bold text-sm">@if(isset($providers)) {{ count($providers) }} @else 1,247 @endif Prestataires Vérifiés</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-black text-gray-900 mb-6 leading-tight" style="letter-spacing: -0.03em;">
                    Trouvez Votre<br>
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">Prestataire Idéal</span> ✨
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-700 font-medium mb-8 max-w-3xl mx-auto">
                    Connectez-vous avec des <strong class="text-indigo-600">prestataires vérifiés</strong> dans 197 pays.<br>
                    Toutes les langues supportées. Des personnes réelles prêtes à vous aider.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Stats Bar -->
        <div class="stats-bar scroll-reveal">
            <div class="stat-item">
                <span class="stat-number">@if(isset($providers)) {{ count($providers) }} @else 1,247 @endif</span>
                <span class="stat-label">Prestataires Actifs</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">197</span>
                <span class="stat-label">Pays</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.9</span>
                <span class="stat-label">Note Moyenne</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Support</span>
            </div>
        </div>

        <!-- Filters Bar -->
        <div class="filters-bar scroll-reveal">
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-filter text-primary"></i>
                    Filtrer les prestataires
                </h2>
                <div class="ml-auto">
                    <button class="reset-filters" onclick="resetFilters()">
                        <i class="fas fa-redo-alt mr-2"></i>
                        Réinitialiser
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Languages Filter -->
                <div class="filter-dropdown">
                    <button class="filter-button" onclick="toggleFilter('languages')">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-language"></i>
                            <span id="languagesLabel">Langues</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform" id="languagesIcon"></i>
                    </button>
                    <div class="filter-menu" id="languagesMenu">
                        <div class="filter-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Rechercher une langue..." oninput="filterOptions('languages', this.value)">
                        </div>
                        <div class="filter-options" id="languagesOptions">
                            <div class="filter-option" onclick="selectFilter('languages', 'fr')">
                                <span class="flag">🇫🇷</span>
                                <span>Français</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'en')">
                                <span class="flag">🇬🇧</span>
                                <span>Anglais</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'es')">
                                <span class="flag">🇪🇸</span>
                                <span>Espagnol</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'de')">
                                <span class="flag">🇩🇪</span>
                                <span>Allemand</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'it')">
                                <span class="flag">🇮🇹</span>
                                <span>Italien</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'pt')">
                                <span class="flag">🇵🇹</span>
                                <span>Portugais</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'ar')">
                                <span class="flag">🇸🇦</span>
                                <span>Arabe</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'zh')">
                                <span class="flag">🇨🇳</span>
                                <span>Chinois</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'ja')">
                                <span class="flag">🇯🇵</span>
                                <span>Japonais</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('languages', 'ru')">
                                <span class="flag">🇷🇺</span>
                                <span>Russe</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Countries Filter -->
                <div class="filter-dropdown">
                    <button class="filter-button" onclick="toggleFilter('countries')">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-globe"></i>
                            <span id="countriesLabel">Pays</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform" id="countriesIcon"></i>
                    </button>
                    <div class="filter-menu" id="countriesMenu">
                        <div class="filter-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Rechercher un pays..." oninput="filterOptions('countries', this.value)">
                        </div>
                        <div class="filter-options" id="countriesOptions">
                            <div class="filter-option" onclick="selectFilter('countries', 'fr')">
                                <span class="flag">🇫🇷</span>
                                <span>France</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'us')">
                                <span class="flag">🇺🇸</span>
                                <span>États-Unis</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'uk')">
                                <span class="flag">🇬🇧</span>
                                <span>Royaume-Uni</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'de')">
                                <span class="flag">🇩🇪</span>
                                <span>Allemagne</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'es')">
                                <span class="flag">🇪🇸</span>
                                <span>Espagne</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'it')">
                                <span class="flag">🇮🇹</span>
                                <span>Italie</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'ca')">
                                <span class="flag">🇨🇦</span>
                                <span>Canada</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'au')">
                                <span class="flag">🇦🇺</span>
                                <span>Australie</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'jp')">
                                <span class="flag">🇯🇵</span>
                                <span>Japon</span>
                            </div>
                            <div class="filter-option" onclick="selectFilter('countries', 'br')">
                                <span class="flag">🇧🇷</span>
                                <span>Brésil</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="filter-dropdown">
                    <button class="filter-button" onclick="toggleFilter('categories')">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-tags"></i>
                            <span id="categoriesLabel">Spécialités</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform" id="categoriesIcon"></i>
                    </button>
                    <div class="filter-menu" id="categoriesMenu">
                        <div class="filter-search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Rechercher une spécialité..." oninput="filterOptions('categories', this.value)">
                        </div>
                        <div class="filter-options" id="categoriesOptions">
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach($categories as $category)
                            <div class="filter-option" onclick="selectFilter('categories', '{{ $category->id }}')">
                                <i class="fas fa-briefcase text-primary"></i>
                                <span>{{ $category->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Active Filters Display -->
            <div id="activeFilters" class="mt-4 flex flex-wrap gap-2 hidden">
                <!-- Active filter badges will be inserted here -->
            </div>
            
            <!-- Results Counter -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    <span id="resultsCount" class="font-bold text-primary">{{ count($providers ?? []) }}</span> 
                    prestataire(s) trouvé(s)
                </p>
            </div>
        </div>

        <!-- Provider Cards Grid -->
        <div class="provider-grid" id="providerGrid">
            @forelse($providers as $provider)
            <article class="provider-card scroll-reveal" data-provider-id="{{ $provider->id }}" 
                     data-languages="{{ json_encode($provider->languages ?? []) }}"
                     data-country="{{ $provider->country ?? '' }}"
                     data-categories="{{ $provider->services_to_offer ?? '[]' }}">
                <!-- Avatar -->
                <div class="provider-avatar">
                    @if($provider->profile_photo)
                        <img src="{{ asset($provider->profile_photo) }}" alt="{{ $provider->first_name }} {{ $provider->last_name }}" loading="lazy">
                    @else
                        <i class="fas fa-user text-5xl text-white"></i>
                    @endif
                </div>
                
                <!-- Verified Badge -->
                <div class="flex justify-center">
                    <div class="verified-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Vérifié</span>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="rating-display">
                    <i class="fas fa-star star-icon"></i>
                    <span class="rating-text">{{ number_format($provider->reviews()->avg('rating') ?? 5, 1) }} / 5</span>
                </div>
                
                <!-- Provider Name & Join Date -->
                <div class="provider-name">
                    {{ strtoupper($provider->first_name . ' ' . $provider->last_name) }}
                    @if($provider->user && $provider->user->created_at)
                        <span class="text-xs opacity-75">• Inscrit {{ $provider->user->created_at->format('M Y') }}</span>
                    @endif
                </div>
                
                <!-- Service Tags -->
                <div class="service-tags">
                    @php
                        $services = $provider->services_to_offer ? json_decode($provider->services_to_offer, true) : [];
                    @endphp
                    
                    @if(is_array($services) && count($services) > 0)
                        @foreach(array_slice($services, 0, 2) as $service)
                            @php
                                $category = \App\Models\Category::find($service);
                            @endphp
                            @if($category)
                                <span class="service-tag">
                                    {{ $category->name }}
                                </span>
                            @endif
                        @endforeach
                        
                        @if(count($services) > 2)
                            <span class="service-tag more">
                                +{{ count($services) - 2 }}
                            </span>
                        @endif
                    @else
                        <span class="service-tag more">
                            Aucun service listé
                        </span>
                    @endif
                </div>
                
                <!-- CTA Button -->
                <a href="{{ route('provider-details', ['id' => $provider->slug]) }}" class="btn-see-more">
                    <span>Voir le Profil</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </article>
            @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-search text-primary"></i>
                    </div>
                    <h3>Aucun Prestataire Trouvé</h3>
                    <p>Nous n'avons trouvé aucun prestataire correspondant à vos critères. Essayez d'ajuster vos filtres ou revenez plus tard.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    @include('dashboard.partials.dashboard-mobile-navbar')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script>
        // Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        // Filter State
        let activeFilters = {
            languages: null,
            countries: null,
            categories: null
        };

        // Toggle Filter Dropdown
        function toggleFilter(filterType) {
            const menu = document.getElementById(`${filterType}Menu`);
            const icon = document.getElementById(`${filterType}Icon`);
            const isOpen = menu.classList.contains('show');
            
            // Close all other dropdowns
            document.querySelectorAll('.filter-menu').forEach(m => {
                if (m !== menu) {
                    m.classList.remove('show');
                }
            });
            
            document.querySelectorAll('.filter-button i.fa-chevron-down').forEach(i => {
                if (i !== icon) {
                    i.style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current dropdown
            if (isOpen) {
                menu.classList.remove('show');
                icon.style.transform = 'rotate(0deg)';
            } else {
                menu.classList.add('show');
                icon.style.transform = 'rotate(180deg)';
            }
        }

        // Select Filter
        function selectFilter(filterType, value) {
            const options = document.querySelectorAll(`#${filterType}Options .filter-option`);
            
            // Toggle selection
            options.forEach(opt => {
                if (opt.getAttribute('onclick').includes(value)) {
                    const isSelected = opt.classList.contains('selected');
                    
                    if (isSelected) {
                        opt.classList.remove('selected');
                        activeFilters[filterType] = null;
                    } else {
                        // Remove selection from all options
                        options.forEach(o => o.classList.remove('selected'));
                        opt.classList.add('selected');
                        activeFilters[filterType] = value;
                    }
                }
            });
            
            updateFilterLabel(filterType);
            applyFilters();
            updateActiveFiltersDisplay();
        }

        // Update Filter Label
        function updateFilterLabel(filterType) {
            const label = document.getElementById(`${filterType}Label`);
            const selectedOption = document.querySelector(`#${filterType}Options .filter-option.selected`);
            
            if (selectedOption) {
                const text = selectedOption.querySelector('span:last-child').textContent;
                label.innerHTML = `<span class="font-bold text-primary">${text}</span>`;
            } else {
                const labels = {
                    languages: 'Langues',
                    countries: 'Pays',
                    categories: 'Spécialités'
                };
                label.textContent = labels[filterType];
            }
        }

        // Filter Options (Search within dropdown)
        function filterOptions(filterType, searchTerm) {
            const options = document.querySelectorAll(`#${filterType}Options .filter-option`);
            const term = searchTerm.toLowerCase();
            
            options.forEach(option => {
                const text = option.textContent.toLowerCase();
                option.style.display = text.includes(term) ? 'flex' : 'none';
            });
        }

        // Apply Filters
        function applyFilters() {
            const cards = document.querySelectorAll('.provider-card');
            let visibleCount = 0;
            
            cards.forEach(card => {
                let shouldShow = true;
                
                // Check language filter
                if (activeFilters.languages) {
                    const languages = JSON.parse(card.dataset.languages || '[]');
                    shouldShow = shouldShow && languages.includes(activeFilters.languages);
                }
                
                // Check country filter
                if (activeFilters.countries) {
                    const country = card.dataset.country;
                    shouldShow = shouldShow && (country === activeFilters.countries);
                }
                
                // Check category filter
                if (activeFilters.categories) {
                    const categories = JSON.parse(card.dataset.categories || '[]');
                    shouldShow = shouldShow && categories.includes(parseInt(activeFilters.categories));
                }
                
                if (shouldShow) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update results count
            document.getElementById('resultsCount').textContent = visibleCount;
            
            // Show empty state if no results
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Update Active Filters Display
        function updateActiveFiltersDisplay() {
            const container = document.getElementById('activeFilters');
            container.innerHTML = '';
            
            let hasFilters = false;
            
            Object.keys(activeFilters).forEach(filterType => {
                if (activeFilters[filterType]) {
                    hasFilters = true;
                    const selectedOption = document.querySelector(`#${filterType}Options .filter-option.selected`);
                    if (selectedOption) {
                        const text = selectedOption.querySelector('span:last-child').textContent;
                        const badge = document.createElement('div');
                        badge.className = 'filter-badge';
                        badge.innerHTML = `
                            ${text}
                            <button onclick="removeFilter('${filterType}')" class="ml-1 hover:text-red-200">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        container.appendChild(badge);
                    }
                }
            });
            
            container.classList.toggle('hidden', !hasFilters);
        }

        // Remove Filter
        function removeFilter(filterType) {
            activeFilters[filterType] = null;
            const options = document.querySelectorAll(`#${filterType}Options .filter-option`);
            options.forEach(opt => opt.classList.remove('selected'));
            updateFilterLabel(filterType);
            applyFilters();
            updateActiveFiltersDisplay();
        }

        // Reset Filters
        function resetFilters() {
            activeFilters = {
                languages: null,
                countries: null,
                categories: null
            };
            
            document.querySelectorAll('.filter-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            updateFilterLabel('languages');
            updateFilterLabel('countries');
            updateFilterLabel('categories');
            
            applyFilters();
            updateActiveFiltersDisplay();
            
            toastr.success('Filtres réinitialisés');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.filter-dropdown')) {
                document.querySelectorAll('.filter-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
                document.querySelectorAll('.filter-button i.fa-chevron-down').forEach(icon => {
                    icon.style.transform = 'rotate(0deg)';
                });
            }
        });

        // Share Panel Functions
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
            document.body.style.overflow = 'hidden';
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
            document.body.style.overflow = '';
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
            }
        };
        
        window.shareAgain = function() {
            closeSharePopup();
            setTimeout(() => openSharePanel(), 300);
        };

        // Get Share URL
        function getShareUrl() {
            const input = document.getElementById('affiliateLinkShareNew');
            if (!input) return window.location.href;
            
            let shareUrl = input.value;
            try {
                const urlObj = new URL(shareUrl, window.location.origin);
                urlObj.searchParams.set('utm_source', 'social');
                urlObj.searchParams.set('utm_medium', 'share');
                urlObj.searchParams.set('utm_campaign', 'helpers');
                shareUrl = urlObj.toString();
            } catch (e) {
                console.error('UTM error:', e);
            }
            return shareUrl;
        }

        // Setup Social Sharing Links
        const finalUrl = getShareUrl();
        const enc = encodeURIComponent(finalUrl);
        
        const viralText = encodeURIComponent(`🌟 J'ai trouvé d'incroyables prestataires vérifiés sur Ulixai !\n\n👉 Découvrez-les :\n\n✅ Profils vérifiés\n✅ Vrais avis\n✅ 197 pays\n✅ Toutes les langues\n\n🚀 Trouvez votre prestataire idéal maintenant !`);
        const subject = encodeURIComponent("🌟 Prestataires Vérifiés sur Ulixai !");
        const viralEmailBody = encodeURIComponent(`Salut ! 👋\n\nJ'ai découvert une plateforme incroyable avec des prestataires vérifiés :\n\n${finalUrl}\n\nPourquoi c'est génial :\n✅ Tous les prestataires sont vérifiés\n✅ Vrais avis de vraies personnes\n✅ Disponible dans 197 pays\n✅ Support dans toutes les langues\n\nDécouvrez et trouvez l'aide dont vous avez besoin !\n\n---\n💡 ASTUCE : Ils ont des prestataires pour visa, logement, déménagement et bien plus encore !`);
        
        const socialLinks = {
            shareWhatsAppSlide: `https://api.whatsapp.com/send?text=${viralText}%20${enc}`,
            shareMessengerSlide: `https://m.me/?link=${enc}`,
            shareFacebookSlide: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
            shareTwitterSlide: `https://twitter.com/intent/tweet?url=${enc}&text=${viralText}`,
            shareLinkedInSlide: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
            shareEmailSlide: `mailto:?subject=${subject}&body=${viralEmailBody}`
        };
        
        Object.entries(socialLinks).forEach(([id, href]) => {
            const link = document.getElementById(id);
            if (link) {
                link.href = href;
            }
        });

        // Copy Link Button
        const copyBtn = document.getElementById('copyBtnSlide');
        if (copyBtn) {
            copyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                navigator.clipboard.writeText(finalUrl).then(() => {
                    const originalHTML = copyBtn.innerHTML;
                    
                    copyBtn.className = 'bg-green-500 rounded-xl p-4 border-2 border-green-500 flex flex-col items-center gap-2 transition-all duration-200';
                    copyBtn.innerHTML = `
                        <i class="fas fa-check text-4xl text-white"></i>
                        <span class="text-sm font-bold text-white uppercase tracking-wide">Copié !</span>
                    `;
                    
                    setTimeout(() => {
                        closeSharePanel();
                        showShareSuccessPopup();
                    }, 800);
                    
                    setTimeout(() => {
                        copyBtn.className = 'bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-xl p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-2 transition-all duration-200 group';
                        copyBtn.innerHTML = originalHTML;
                    }, 1500);
                    
                }).catch(() => {
                    console.error('Copy failed');
                    toastr.error('Échec de la copie du lien !');
                });
            });
        }

        // Share buttons success feedback
        const shareButtons = document.querySelectorAll('a[id^="share"]');
        shareButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                setTimeout(() => {
                    closeSharePanel();
                    showShareSuccessPopup();
                }, 800);
            });
        });

        // Scroll Reveal Animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');
            
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('revealed');
                }
            });
        }

        // Initialize on load
        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', () => {
            revealOnScroll();
        });

        // Lazy load images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('skeleton');
                            observer.unobserve(img);
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Service Worker for offline support (optional)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(() => {
                    // Silent fail - not critical
                });
            });
        }
    </script><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <!-- SEO Meta Tags -->
  <title>Ulixai - Plateforme d'Entraide Internationale pour Expatriés | Services Multilingues dans 197 Pays</title>
  <meta name="description" content="Trouvez des prestataires vérifiés pour tous vos besoins d'expatriation : visa, logement, déménagement, traduction. Présence dans 197 pays, support multilingue 24/7.">
  <meta name="keywords" content="expatriation 2025, services expatriés, prestataires internationaux vérifiés, aide voyage monde entier, visa étranger express, logement international, déménagement expatrié, traduction assermentée multilingue, assistance professionnelle, communauté expats mondiale, services certifiés, aide administrative étrangère, relocation internationale">
  <meta name="author" content="Ulixai - Williams Jullin">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="https://ulixai.com/" />
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://ulixai.com/">
  <meta property="og:title" content="Ulixai - Prestataires de Services d'Expatriation dans 197 Pays">
  <meta property="og:description" content="Plateforme internationale connectant expatriés et prestataires vérifiés. Visa, logement, déménagement et plus dans tous les pays du monde.">
  <meta property="og:image" content="https://ulixai.com/images/og-home.jpg">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="Ulixai">
  
  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://ulixai.com/">
  <meta name="twitter:title" content="Ulixai - Services d'Expatriation Mondiaux">
  <meta name="twitter:description" content="Connectez-vous avec des prestataires vérifiés dans 197 pays pour tous vos besoins d'expatriation">
  <meta name="twitter:image" content="https://ulixai.com/images/twitter-home.jpg">
  
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  
  <!-- Preconnect & DNS Prefetch for Performance -->
  <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdn.tailwindcss.com" crossorigin>
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
  
  <!-- Leaflet for Map -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts - Preload -->
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  
  <!-- Structured Data / Schema.org -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Ulixai",
    "url": "https://ulixai.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://ulixai.com/images/logo.png",
      "width": 512,
      "height": 512
    },
    "description": "Plateforme internationale connectant expatriés et prestataires vérifiés dans 197 pays. Services de visa, logement, déménagement, traduction et plus.",
    "foundingDate": "2024",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "FR"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "Customer Service",
      "email": "support@ulixai.com",
      "availableLanguage": ["fr", "en", "es", "de", "pt", "ar", "zh", "ja", "ko", "hi", "tr"]
    },
    "sameAs": [
      "https://facebook.com/ulixai",
      "https://twitter.com/ulixai",
      "https://linkedin.com/company/ulixai",
      "https://instagram.com/ulixai"
    ]
  }
  </script>
  
  <style>
    /* Critical CSS for Fast First Paint */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
      background: #FFFFFF;
    }

    html {
      scroll-behavior: smooth;
    }

    /* CSS Variables */
    :root {
      --primary: #3B82F6;
      --primary-dark: #2563EB;
      --secondary: #8B5CF6;
      --accent: #EC4899;
      --success: #10B981;
      --warning: #F59E0B;
    }

    .font-display {
      font-family: 'Outfit', sans-serif;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #F1F5F9;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 4px;
    }

    /* Modern Card - Ombre légère et bordure */
    .card-modern {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      border: 2px solid #E5E7EB;
    }

    .card-modern:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(59, 130, 246, 0.20);
      border-color: #3B82F6;
    }

    /* Provider Cards Enhanced with Border and Shadow */
    .profile-card {
      height: 420px;
      border: 2px solid #E5E7EB;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .profile-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 24px rgba(59, 130, 246, 0.20);
      border-color: #3B82F6;
    }

    .profile-card .aspect-ratio-box {
      height: 260px;
    }

    /* Fix Flash Noir - Image Loading */
    .provider-image {
      opacity: 0;
      transition: opacity 0.4s ease-in;
    }

    .provider-image.loaded {
      opacity: 1;
    }

    /* Animations - RÉDUITES */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes pulse-glow {
      0%, 100% { 
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
      }
      50% { 
        box-shadow: 0 0 25px rgba(139, 92, 246, 0.4);
      }
    }

    .animate-float {
      animation: float 8s ease-in-out infinite;
    }

    .animate-pulse-glow {
      animation: pulse-glow 4s ease-in-out infinite;
    }

    /* Button Effects */
    .btn-shine {
      position: relative;
      overflow: hidden;
    }

    .btn-shine::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: 0.5s;
    }

    .btn-shine:hover::before {
      left: 100%;
    }

    /* Category Bubbles */
    .category-bubble {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 11px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      flex-shrink: 0;
      padding: 12px;
      line-height: 1.2;
    }

    .category-bubble:hover {
      transform: translateY(-10px) scale(1.1);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    .category-bubble span {
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      word-wrap: break-word;
      max-width: 100%;
    }

    /* Category Scroll */
    .category-scroll {
      scroll-behavior: smooth;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .category-scroll::-webkit-scrollbar {
      display: none;
    }

    /* Provider Image Hover */
    .provider-image {
      transition: transform 0.4s ease;
    }

    .card-modern:hover .provider-image {
      transform: scale(1.05);
    }

    /* Badge Styles */
    .badge-verified {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .badge-specialty {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* FAQ Accordion */
    .faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-content.active {
      max-height: 500px;
      transition: max-height 0.5s ease-in;
    }

    .faq-icon {
      transition: transform 0.3s ease;
    }

    .faq-toggle.active .faq-icon {
      transform: rotate(180deg);
    }

    /* Status Pulse */
    @keyframes status-pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    .status-online {
      animation: status-pulse 2s ease-in-out infinite;
    }

    /* Back to Top */
    #backToTop {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 9999;
      box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
    }

    #backToTop.show {
      opacity: 1;
      visibility: visible;
    }

    #backToTop:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(59, 130, 246, 0.6);
    }

    /* Custom Select */
    select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233B82F6'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 1.25rem;
      padding-right: 2.5rem;
    }

    /* Testimonial Card */
    .testimonial-card {
      background: white;
      border-radius: 24px;
      padding: 32px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
      border: 2px solid #E5E7EB;
    }

    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
      border-color: #3B82F6;
    }

    /* Number Badge */
    .number-badge {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 18px;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Horizontal Scroll for Mobile */
    .horizontal-scroll-mobile {
      overflow-x: auto;
      overflow-y: hidden;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .horizontal-scroll-mobile::-webkit-scrollbar {
      display: none;
    }

    .horizontal-scroll-mobile > div {
      scroll-snap-align: start;
      flex-shrink: 0;
    }

    /* How It Works Cards */
    .how-it-works-card {
      min-height: 320px;
      height: 320px;
      display: flex;
      flex-direction: column;
      background: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
      border: 2px solid #E5E7EB;
    }

    .how-it-works-card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
      border-color: #3B82F6;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem !important;
      }

      .category-bubble {
        width: 90px;
        height: 90px;
        font-size: 11px;
      }

      .category-bubble svg {
        width: 32px;
        height: 32px;
      }

      #backToTop {
        width: 48px;
        height: 48px;
        bottom: 20px;
        right: 20px;
      }

      .how-it-works-card {
        min-height: 280px;
        height: auto;
      }
    }

    /* AI Popup */
    .ai-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.9);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      z-index: 10000;
      max-width: 90%;
      width: 500px;
    }

    .ai-popup.show {
      opacity: 1;
      visibility: visible;
      transform: translate(-50%, -50%) scale(1);
    }

    .ai-popup-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 9999;
      backdrop-filter: blur(4px);
    }

    .ai-popup-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    @keyframes aiRobot {
      0%, 100% { transform: rotate(-5deg); }
      50% { transform: rotate(5deg); }
    }

    .ai-robot {
      animation: aiRobot 2s ease-in-out infinite;
    }

    /* Featured Badge */
    .featured-badge {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
      animation: pulse-glow 2s ease-in-out infinite;
    }

    /* Why Choose Cards */
    .why-choose-card {
      background: white;
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
      border: 2px solid #E5E7EB;
    }

    .why-choose-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15);
      border-color: #3B82F6;
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
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',
            'primary-dark': '#2563EB',
            secondary: '#8B5CF6',
            accent: '#EC4899',
          },
          fontFamily: {
            display: ['Outfit', 'sans-serif'],
          },
        }
      }
    }
  </script>
</head>

<body class="bg-white overflow-x-hidden">
  
  @include('includes.header')
  @include('pages.popup')

  <!-- HERO SECTION - MODERN GRADIENT -->
  <section class="relative pt-20 pb-32 px-4 overflow-hidden" style="background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);">
    <!-- Animated Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-10 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-10 left-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-5xl mx-auto text-center relative z-10">
      <!-- Title -->
      <h1 class="hero-title font-display font-black text-white mb-6 leading-tight text-3xl sm:text-4xl lg:text-6xl" data-aos="fade-up" data-aos-duration="800">
        Besoin d'aide à l'étranger ? Envie d'aider des expatriés et voyageurs ?
      </h1>

      <!-- Subtitle -->
      <p class="text-white/90 text-lg sm:text-xl mb-10 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
        La plateforme multilingue qui connecte expatriés, voyageurs et prestataires locaux dans tous les pays du monde 🌍
      </p>

      <!-- Search Box -->
      <div class="max-w-3xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
        <div class="bg-white rounded-full p-2 shadow-2xl">
          <div class="flex items-center gap-2">
            <input
              id="searchInput"
              type="text"
              placeholder="Trouvez de l'aide internationale en un clic 😉"
              class="flex-1 px-6 py-4 text-gray-700 bg-transparent rounded-full focus:outline-none text-base"
              onclick="openHelpPopup()"
              readonly
            />
            <button class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full btn-shine transition-all shadow-lg flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" stroke-width="2"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Search Example -->
      <p class="text-white/80 text-sm mb-8" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        💡 Ex: Visa Portugal, traduction assermentée multilingue, déménagement international, travaux...
      </p>

      <!-- AI Button -->
      <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
        <button onclick="openAIPopup()" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-8 py-4 rounded-full font-bold text-base btn-shine shadow-2xl inline-flex items-center space-x-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span>Assistant IA pour expatriés</span>
        </button>
      </div>
    </div>
  </section>

  <!-- CATEGORY BUBBLES - Overlapping Hero -->
  <section class="relative -mt-16 z-30 px-4 mb-12">
    <div class="max-w-7xl mx-auto">
      <div class="relative">
        <div class="category-scroll flex gap-12 overflow-x-auto pb-4 justify-center items-center" id="categoryContainer">
@foreach($category as $cat)
    @if($cat && is_object($cat) && isset($cat->name))
        <div onclick="openHelpPopup()" class="category-bubble"
             style="background: {{
               $loop->index % 9 == 0 ? 'linear-gradient(135deg, #3B82F6 0%, #2563EB 100%)' :
               ($loop->index % 9 == 1 ? 'linear-gradient(135deg, #F97316 0%, #EA580C 100%)' :
               ($loop->index % 9 == 2 ? 'linear-gradient(135deg, #A855F7 0%, #9333EA 100%)' :
               ($loop->index % 9 == 3 ? 'linear-gradient(135deg, #10B981 0%, #059669 100%)' :
               ($loop->index % 9 == 4 ? 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)' :
               ($loop->index % 9 == 5 ? 'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)' :
               ($loop->index % 9 == 6 ? 'linear-gradient(135deg, #6366F1 0%, #4F46E5 100%)' :
               ($loop->index % 9 == 7 ? 'linear-gradient(135deg, #14B8A6 0%, #0D9488 100%)' :
               'linear-gradient(135deg, #EC4899 0%, #DB2777 100%)'))))))) }};"
             data-aos="zoom-in"
             data-aos-delay="{{ $loop->index * 30 }}"
             data-aos-duration="600">
          <span>{{ $cat->name }}</span>
        </div>
    @endif
@endforeach
        </div>

        <!-- Navigation Arrows -->
        <button id="prevBubble" onclick="scrollBubbles('prev')" class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 bg-white rounded-full p-3 shadow-xl hover:bg-gray-50 transition-all z-10">
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button id="nextBubble" onclick="scrollBubbles('next')" class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 bg-white rounded-full p-3 shadow-xl hover:bg-gray-50 transition-all z-10">
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </div>
  </section>
</body>
</html>