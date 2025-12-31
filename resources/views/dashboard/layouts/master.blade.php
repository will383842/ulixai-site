<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>
    <script src="https://js.stripe.com/basil/stripe.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/country-select-js@1.0.8/dist/countrySelect.min.js"></script>
    
    <style>
        /* ========================================
           DASHBOARD LAYOUT OPTIMISÉ 2025/2026
           ======================================== */
        
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --success-500: #10b981;
            --success-600: #059669;
            --warning-500: #f59e0b;
            --warning-600: #d97706;
            --error-500: #ef4444;
            --error-600: #dc2626;
        }
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        
        /* ========================================
           TOASTR MODERNE 2025/2026
           ======================================== */
        
        #toast-container {
            pointer-events: none;
        }
        
        #toast-container > div {
            pointer-events: auto;
            opacity: 0.98;
            border-radius: 16px;
            padding: 16px 20px;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.12),
                0 10px 10px -5px rgba(0, 0, 0, 0.06);
            animation: slideInRight 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            min-width: 280px;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .toast-success {
            background: linear-gradient(135deg, 
                rgba(16, 185, 129, 0.95) 0%, 
                rgba(5, 150, 105, 0.95) 100%) !important;
        }
        
        .toast-error {
            background: linear-gradient(135deg, 
                rgba(239, 68, 68, 0.95) 0%, 
                rgba(220, 38, 38, 0.95) 100%) !important;
        }
        
        .toast-info {
            background: linear-gradient(135deg, 
                rgba(14, 165, 233, 0.95) 0%, 
                rgba(2, 132, 199, 0.95) 100%) !important;
        }
        
        .toast-warning {
            background: linear-gradient(135deg, 
                rgba(245, 158, 11, 0.95) 0%, 
                rgba(217, 119, 6, 0.95) 100%) !important;
        }
        
        #toast-container > div:hover {
            box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        
        .toast-message {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .toast-title {
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 4px;
        }
        
        /* ========================================
           IMPERSONATION BANNER - ISLAND STYLE
           ======================================== */
        
        .impersonation-container {
            position: fixed;
            top: 5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 40;
            max-width: 90vw;
            animation: slideDown 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        @keyframes slideDown {
            from {
                transform: translateX(-50%) translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }
        
        .impersonation-island {
            background: rgba(254, 243, 199, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 2rem;
            padding: 0.875rem 1.5rem;
            box-shadow: 
                0 20px 25px -5px rgba(245, 158, 11, 0.2),
                0 10px 10px -5px rgba(245, 158, 11, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .impersonation-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.4);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .impersonation-text {
            font-size: 0.875rem;
            color: #78350f;
        }
        
        .impersonation-email {
            font-weight: 600;
            color: #92400e;
        }
        
        .btn-restore-admin {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.4);
        }
        
        .btn-restore-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.5);
        }
        
        .btn-restore-admin:active {
            transform: translateY(0);
        }
        
        /* ========================================
           MAIN CONTENT
           ======================================== */
        
        .main-content {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* ========================================
           FOCUS STATES
           ======================================== */
        
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 2px solid var(--primary-500);
            outline-offset: 2px;
        }
        
        /* ========================================
           REDUCED MOTION SUPPORT
           ======================================== */
        
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* ========================================
           RESPONSIVE
           ======================================== */
        
        @media (max-width: 768px) {
            .main-content {
                padding-top: 5rem !important;
            }
            
            .impersonation-container {
                top: 5.5rem;
            }
            
            .impersonation-island {
                padding: 0.75rem 1rem;
                border-radius: 1.5rem;
            }
            
            .impersonation-text {
                font-size: 0.8125rem;
            }
        }
        
        @media (max-width: 480px) {
            .impersonation-island {
                flex-direction: column;
                text-align: center;
            }
        }
        
        /* ========================================
           PERFORMANCE OPTIMIZATIONS
           ======================================== */
        
        .impersonation-island,
        #toast-container > div {
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        /* ========================================
           🔧 CORRECTIONS DASHBOARD USER 2025/2026
           ======================================== */

        /* 1. SUPPRESSION COMPLÈTE DU FIL D'ARIANE */
        .breadcrumbs,
        .breadcrumb,
        nav[aria-label="breadcrumb"],
        nav[aria-label="Breadcrumb"],
        .dashboard-breadcrumb,
        ol.breadcrumb,
        .breadcrumb-container,
        .breadcrumbs-wrapper {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        /* 2. RÉDUCTION MARGE HEADER-CONTENU */
        main.main-content {
            padding-top: 0.5rem !important;
            margin-top: 0 !important;
        }

        @media (min-width: 1024px) {
            main.main-content {
                padding-top: 1rem !important;
                padding-left: 19rem !important; /* 18rem sidebar + 1rem gap */
            }
        }

        /* Supprimer espaces inutiles */
        main.main-content > .max-w-7xl {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        main.main-content > .max-w-7xl > *:first-child {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* 3. CORRECTION SIDEBAR - AFFICHAGE COMPLET */
        #sidebar {
            height: 100vh !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            width: 18rem !important;
        }

        #sidebar > div {
            padding: 1rem 1.5rem !important;
            height: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 0 !important;
        }

        /* Section greeting - TOUJOURS VISIBLE */
        #sidebar .flex.items-center.space-x-3:first-of-type,
        #sidebar > div > .flex.items-center.space-x-3 {
            flex-shrink: 0 !important;
            margin-bottom: 1.5rem !important;
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            min-height: 3rem !important;
        }

        /* Avatar et nom utilisateur */
        #sidebar .w-12.h-12.rounded-full,
        #sidebar .w-8.h-8.rounded-full {
            flex-shrink: 0 !important;
            display: block !important;
        }

        #user-greeting {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            white-space: nowrap !important;
            overflow: visible !important;
            font-size: 1.25rem !important;
            line-height: 1.75rem !important;
        }

        /* Navigation - scroll si nécessaire */
        #sidebar nav {
            flex: 1 1 auto !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            margin-bottom: 1rem !important;
            min-height: 0 !important;
        }

        /* Cards promotionnelles et logout */
        #sidebar .space-y-4,
        #sidebar .pt-4.border-t {
            flex-shrink: 0 !important;
        }

        #sidebar .pt-4.border-t {
            margin-top: auto !important;
        }

        /* Scrollbar personnalisée sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        #sidebar nav::-webkit-scrollbar {
            width: 4px;
        }

        #sidebar nav::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar nav::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        /* 4. MOBILE OPTIMISÉ */
        @media (max-width: 1023px) {
            .lg\:hidden.sticky.top-0 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
                min-height: 3.5rem !important;
            }

            #sidebar {
                top: 5rem !important; /* Sous le header mobile */
                height: calc(100vh - 5rem) !important;
                width: 18rem !important;
            }

            main.main-content {
                padding-top: 0.5rem !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        /* 5. DESKTOP LAYOUT */
        @media (min-width: 1024px) {
            #sidebar {
                position: fixed !important;
                top: 4rem !important; /* Sous le header desktop */
                left: 0 !important;
                height: calc(100vh - 4rem) !important;
            }

            .flex.flex-col.lg\:flex-row {
                position: relative;
            }
        }

        /* 6. TITRES ET HEADERS */
        h1, h2.text-2xl, h2.text-3xl,
        main.main-content h1:first-child {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* 7. CARDS ET SECTIONS */
        .bg-white.rounded-lg.shadow:first-child,
        .card:first-child {
            margin-top: 0 !important;
        }

        /* 8. BADGE NOTIFICATIONS */
        #private_messages_notification {
            position: absolute !important;
            top: -0.5rem !important;
            right: -0.5rem !important;
            z-index: 10 !important;
        }

        /* 9. SMOOTH SCROLL */
        #sidebar,
        #sidebar nav {
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
        }

        /* 10. PERFORMANCE */
        #sidebar {
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50 text-gray-800 antialiased" data-page="dashboard">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <!-- Google Translate Element -->
    <div id="google_translate_element" class="hidden"></div>
   
    <!-- Pusher & Echo Configuration -->
    <script>
        // Configuration Toastr moderne
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: true,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("MIX_PUSHER_APP_KEY") }}',
            cluster: '{{ env("MIX_PUSHER_APP_CLUSTER") }}', 
            forceTLS: true,
            
            auth: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            },
            enabledTransports: ['ws', 'wss'],
        });
    </script>
    
    <!-- Session Messages -->
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Succès');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', 'Erreur');
        </script>
    @endif

    <!-- Real-time Notifications Listener -->
    <script>
        const listen = window.Echo.channel(`notify-user-{{ auth()->id() }}`)
            .listen('NotifyUser', (data) => {
                const navReadElement = document.getElementById('private_messages_notification');
                if(navReadElement) {
                    navReadElement.classList.remove('hidden');
                    const navValue = navReadElement.dataset.value || "0";
                    navReadElement.dataset.value = parseInt(navValue, 10) + 1;
                    navReadElement.textContent = navReadElement.dataset.value;
                }
                toastr.info(data.title, 'Nouvelle Notification');
            })
            .error((error) => {
                console.error('Channel subscription error:', error);
            });
    </script>

    <!-- Header Content (without HTML structure) -->
    @include('includes.header')
    
    <!-- Popup Request Help -->
    @include('wizards.requester.steps.popup_request_help')
    
    <!-- Impersonation Banner - Island Style -->
    @if(session('is_impersonating'))
        <div class="impersonation-container">
            <div class="impersonation-island">
                <span class="impersonation-badge">
                    <i class="fas fa-user-secret"></i>
                    <span>Mode Admin</span>
                </span>
                <div>
                    <span class="impersonation-text">Connecté en tant que</span>
                    <span class="impersonation-email">{{ auth()->user()->email }}</span>
                </div>
                <form method="POST" action="{{ route('restore-admin') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-restore-admin">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour Admin</span>
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Main Layout -->
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        @include('dashboard.partials.sidebar')
    
        <!-- Content Area -->
        <main class="main-content flex-1 p-4 lg:p-6 min-h-screen">
            <!-- KYC Banner -->
            @include('dashboard.banners.kyc-banner')
            
            <!-- Page Content -->
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile Navigation -->
    @include('dashboard.partials.dashboard-mobile-navbar')
    
    <!-- Scripts supplémentaires -->
    @yield('scripts')
    
    <!-- Script d'amélioration UX optimisé -->
    <script>
    (function() {
        'use strict';
        
        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Loading state pour les formulaires
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Chargement...';
                    
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 30000);
                }
            });
        });
        
        // Performance: Lazy loading pour les images
        if ('loading' in HTMLImageElement.prototype) {
            document.querySelectorAll('img:not([loading])').forEach(img => {
                img.loading = 'lazy';
            });
        }
        
        // Gestion de la connexion réseau
        window.addEventListener('online', () => {
            toastr.success('Connexion rétablie', 'En ligne');
        });
        
        window.addEventListener('offline', () => {
            toastr.warning('Connexion perdue', 'Hors ligne');
        });
        
    })();
    </script>
</body>
</html>