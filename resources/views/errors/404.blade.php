<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    
    {{-- SEO Meta Tags --}}
    <title>404 - Page Not Found | Ulixai</title>
    <meta name="description" content="Page not found. Return to Ulixai dashboard or home page.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="author" content="Ulixai - Williams Jullin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    {{-- Theme & Mobile --}}
    <meta name="theme-color" content="#3b82f6">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    
    {{-- Open Graph Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="404 - Page Not Found | Ulixai">
    <meta property="og:description" content="Page not found on Ulixai.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Ulixai">
    <meta property="og:locale" content="en_US">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="404 - Page Not Found | Ulixai">
    <meta name="twitter:description" content="Page not found on Ulixai.">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">

    {{-- Tailwind CSS - Compiled Build --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Inter', 'Segoe UI', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* ISOLÉ: Uniquement pour cette page 404 */
        .page-404-wrapper {
            position: relative;
            width: 100%;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #6366f1 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        @media (min-width: 768px) {
            .gradient-bg {
                padding: 2rem;
            }
        }

        .gradient-bg::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -150px;
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        .gradient-bg::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -100px;
            animation: float 15s ease-in-out infinite reverse;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(5deg); }
            66% { transform: translate(-20px, 20px) rotate(-5deg); }
        }

        .error-number {
            font-size: clamp(56px, 14vw, 96px);
            font-weight: 900;
            line-height: 0.9;
            background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            letter-spacing: -0.05em;
            animation: glitch 4s ease-in-out infinite;
        }

        @keyframes glitch {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
        }

        .card-404 {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 20px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @media (min-width: 768px) {
            .card-404 {
                border-radius: 24px;
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
            width: 100%;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        @media (min-width: 640px) {
            .btn-primary {
                padding: 16px 32px;
                font-size: 16px;
                width: auto;
            }
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 32px rgba(59, 130, 246, 0.5);
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
        }

        .btn-secondary {
            background: rgba(59, 130, 246, 0.12);
            color: #2563eb;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s;
            border: 2px solid rgba(59, 130, 246, 0.25);
            width: 100%;
            cursor: pointer;
        }

        @media (min-width: 640px) {
            .btn-secondary {
                padding: 14px 28px;
                font-size: 15px;
                width: auto;
            }
        }

        .btn-secondary:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .icon-404 {
            font-size: clamp(40px, 10vw, 64px);
            animation: bounce-rotate 2s ease-in-out infinite;
            display: inline-block;
        }

        @keyframes bounce-rotate {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(-5deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(-8px) rotate(5deg); }
        }

        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: sparkle-float 3s ease-in-out infinite;
            opacity: 0;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes sparkle-float {
            0%, 100% { opacity: 0; transform: translateY(0) scale(0); }
            50% { opacity: 1; transform: translateY(-100px) scale(1); }
        }

        .sparkle:nth-child(1) { left: 20%; top: 40%; animation-delay: 0s; }
        .sparkle:nth-child(2) { left: 40%; top: 50%; animation-delay: 0.5s; }
        .sparkle:nth-child(3) { left: 60%; top: 60%; animation-delay: 1s; }
        .sparkle:nth-child(4) { left: 80%; top: 45%; animation-delay: 1.5s; }

        .emoji-float {
            position: absolute;
            font-size: 28px;
            animation: emoji-drift 8s ease-in-out infinite;
            opacity: 0.3;
            pointer-events: none;
            z-index: 0;
        }

        @media (min-width: 768px) {
            .emoji-float {
                font-size: 32px;
            }
        }

        @keyframes emoji-drift {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(20px, -30px) rotate(10deg); }
            66% { transform: translate(-20px, -60px) rotate(-10deg); }
        }

        .emoji-1 { top: 35%; left: 8%; animation-delay: 0s; }
        .emoji-2 { top: 40%; right: 12%; animation-delay: 2s; }
        .emoji-3 { bottom: 35%; left: 12%; animation-delay: 4s; }
        .emoji-4 { bottom: 40%; right: 8%; animation-delay: 6s; }

        .fun-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            animation: pulse-scale 2s ease-in-out infinite;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        }

        @media (min-width: 768px) {
            .fun-badge {
                font-size: 13px;
                padding: 6px 16px;
            }
        }

        @keyframes pulse-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>

@include('includes.header')
@include('wizards.requester.steps.popup_request_help')

<div class="page-404-wrapper">
    <div class="gradient-bg">
        
        <div class="sparkle"></div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>

        <div class="emoji-float emoji-1">🚀</div>
        <div class="emoji-float emoji-2">✨</div>
        <div class="emoji-float emoji-3">🎯</div>
        <div class="emoji-float emoji-4">💫</div>
        
        <div style="max-width: 40rem; width: 100%; position: relative; z-index: 2;">
            <div class="text-center mb-3">
                <div class="fun-badge mb-3">
                    <span>⚠️</span>
                    <span>Houston, nous avons un problème !</span>
                </div>
                <div class="error-number">404</div>
            </div>

            <div class="card-404 p-4 md:p-7">
                <div class="text-center mb-5">
                    <div class="icon-404 mb-3">🔍</div>
                    <h1 class="text-xl md:text-3xl font-black text-gray-900 mb-2 leading-tight">
                        Oups ! Perdu dans l'espace
                    </h1>
                    <p class="text-sm md:text-base text-gray-600 max-w-md mx-auto leading-relaxed">
                        Cette page a fait un détour par une autre dimension. Téléportez-vous à nouveau ! 🌌
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 md:gap-3 mb-5">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Tableau de bord 🚀</span>
                        </a>
                        <a href="{{ url('/') }}" class="btn-secondary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10"/>
                            </svg>
                            <span>Accueil</span>
                        </a>
                        <button onclick="history.back()" class="btn-secondary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Retour</span>
                        </button>
                    @else
                        <a href="{{ url('/signup') }}" class="btn-primary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Rejoignez-nous 🎉</span>
                        </a>
                        <a href="{{ url('/') }}" class="btn-secondary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10"/>
                            </svg>
                            <span>Accueil</span>
                        </a>
                        <button onclick="history.back()" class="btn-secondary">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Retour</span>
                        </button>
                    @endauth
                </div>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl md:rounded-2xl p-3 md:p-4 border-2 border-blue-100">
                    <div class="flex items-center gap-2.5 md:gap-3">
                        <div class="text-2xl md:text-3xl">💡</div>
                        <div class="flex-1">
                            <p class="text-xs md:text-sm font-bold text-blue-900 mb-0.5 md:mb-1">Astuce !</p>
                            <p class="text-xs text-blue-700">
                                Vérifiez l'URL ou utilisez la navigation ci-dessus pour trouver ce que vous cherchez.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('includes.footer')

</body>
</html>