<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="theme-color" content="#1d4ed8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    
    <!-- SEO Meta Tags -->
    <title>Login - ULIX AI | Secure Authentication Portal</title>
    <meta name="description" content="Log in to your ULIX AI account securely. Access your AI-powered platform with email or Google authentication.">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Login - ULIX AI">
    <meta property="og:description" content="Log in to your ULIX AI account securely">
    <meta property="og:image" content="{{ asset('images/faviccon.png') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
    <link rel="apple-touch-icon" href="images/faviccon.png">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* ========================================
           DESIGN SYSTEM - ULIX AI 2025
        ======================================== */
        :root {
            /* Colors - Matching design file */
            --primary: #1d4ed8;
            --primary-dark: #1e40af;
            --primary-light: #3b82f6;
            --secondary-blue: #2563eb;
            --light-blue: #60a5fa;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --border: #e2e8f0;
            
            /* Spacing - 8px grid system */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            
            /* Border radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            
            /* Transitions - 60fps smooth */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: 350ms cubic-bezier(0.4, 0, 0.2, 1);
            
            /* Shadows */
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 16px 32px rgba(0, 0, 0, 0.12);
            --shadow-2xl: 0 24px 48px rgba(0, 0, 0, 0.15);
            --shadow-3xl: 0 40px 80px rgba(0, 0, 0, 0.2);
            
            /* Safe area insets */
            --safe-area-top: env(safe-area-inset-top, 0);
            --safe-area-bottom: env(safe-area-inset-bottom, 0);
            
            /* Dynamic viewport */
            --vh: 1vh;
        }

        /* ========================================
           RESET & BASE - MOBILE PERFECT
        ======================================== */
        *, *::before, *::after {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
        }

        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
            scroll-behavior: smooth;
            height: 100%;
            height: -webkit-fill-available;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            overscroll-behavior: none;
            min-height: 100vh;
            min-height: -webkit-fill-available;
            min-height: calc(var(--vh, 1vh) * 100);
        }

        /* Remove default input styling */
        input, button, textarea, select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Better focus for accessibility */
        :focus-visible {
            outline: 3px solid var(--primary);
            outline-offset: 2px;
        }

        /* ========================================
           ANIMATED BACKGROUND
        ======================================== */
        .gradient-bg {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary-blue) 50%, var(--primary) 100%);
            opacity: 0.15;
            animation: gradientShift 20s ease-in-out infinite;
            z-index: 0;
            will-change: transform;
        }

        @keyframes gradientShift {
            0%, 100% { 
                transform: scale(1) rotate(0deg);
                filter: hue-rotate(0deg);
            }
            50% { 
                transform: scale(1.15) rotate(3deg);
                filter: hue-rotate(10deg);
            }
        }

        /* ========================================
           FLOATING PARTICLES
        ======================================== */
        .particle {
            position: fixed;
            width: 3px;
            height: 3px;
            background: var(--primary-light);
            border-radius: 50%;
            animation: float 25s infinite ease-in-out;
            z-index: 0;
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.6);
            will-change: transform, opacity;
            pointer-events: none;
        }

        .particle:nth-child(1) { left: 15%; top: 20%; animation-delay: 0s; animation-duration: 18s; }
        .particle:nth-child(2) { left: 85%; top: 25%; animation-delay: 3s; animation-duration: 22s; width: 4px; height: 4px; }
        .particle:nth-child(3) { left: 25%; top: 65%; animation-delay: 6s; animation-duration: 20s; }
        .particle:nth-child(4) { left: 75%; top: 75%; animation-delay: 9s; animation-duration: 19s; width: 5px; height: 5px; }
        .particle:nth-child(5) { left: 50%; top: 15%; animation-delay: 12s; animation-duration: 24s; }

        @keyframes float {
            0%, 100% {
                transform: translate3d(0, 0, 0) scale(1);
                opacity: 0;
            }
            5% { opacity: 0.8; }
            95% { opacity: 0.8; }
            25% { transform: translate3d(80px, 100px, 0) scale(1.4); }
            50% { transform: translate3d(-60px, 180px, 0) scale(1); }
            75% { transform: translate3d(120px, 60px, 0) scale(1.2); }
        }

        /* ========================================
           MAIN CONTAINER
        ======================================== */
        .login-container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-3xl);
            border: 1px solid rgba(255, 255, 255, 0.5);
            overflow: hidden;
            position: relative;
            animation: slideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Glowing effect */
        .login-card::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 25%, var(--light-blue) 50%, var(--primary-light) 75%, var(--primary) 100%);
            background-size: 200% 200%;
            border-radius: var(--radius-2xl);
            z-index: -1;
            opacity: 0.4;
            filter: blur(24px);
            animation: glowPulse 4s ease-in-out infinite, gradientMove 8s linear infinite;
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.7; }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ========================================
           LOGO & HEADER
        ======================================== */
        .logo-container {
            text-align: center;
            margin-bottom: var(--space-8);
            animation: fadeInDown 0.6s var(--transition-smooth) 0.1s both;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto var(--space-4);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(29, 78, 216, 0.25), 0 4px 12px rgba(59, 130, 246, 0.15);
            animation: logoPulse 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        @keyframes logoPulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 8px 24px rgba(29, 78, 216, 0.25), 0 4px 12px rgba(59, 130, 246, 0.15);
            }
            50% { 
                transform: scale(1.04);
                box-shadow: 0 12px 32px rgba(29, 78, 216, 0.35), 0 6px 16px rgba(59, 130, 246, 0.25);
            }
        }

        .logo-icon::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
            animation: logoShine 3s infinite;
        }

        @keyframes logoShine {
            0% { transform: translate(-100%, -100%) rotate(45deg); }
            100% { transform: translate(100%, 100%) rotate(45deg); }
        }

        .page-title {
            font-size: clamp(1.5rem, 5vw, 1.75rem);
            font-weight: 800;
            color: var(--primary);
            margin-bottom: var(--space-2);
            letter-spacing: -0.02em;
            animation: fadeIn 0.6s var(--transition-smooth) 0.2s both;
        }

        .page-subtitle {
            font-size: clamp(0.875rem, 3vw, 0.9375rem);
            color: var(--text-gray);
            font-weight: 500;
            margin-bottom: var(--space-6);
            animation: fadeIn 0.6s var(--transition-smooth) 0.3s both;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fun-emoji {
            display: inline-block;
            animation: wave 2.5s ease-in-out infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            40%, 100% { transform: rotate(0deg); }
        }

        /* ========================================
           SOCIAL BUTTON (GOOGLE)
        ======================================== */
        .social-btn {
            min-height: 48px;
            animation: fadeIn 0.6s var(--transition-smooth) 0.4s both;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.08), transparent);
            transform: translateX(-100%);
            transition: transform 0.7s var(--transition-smooth);
        }

        .social-btn:hover::before {
            transform: translateX(100%);
        }

        /* ========================================
           DIVIDER
        ======================================== */
        .divider {
            animation: fadeIn 0.6s var(--transition-smooth) 0.5s both;
        }

        .divider::before,
        .divider::after {
            background: linear-gradient(to right, transparent, var(--border) 20%, var(--border) 80%, transparent);
        }

        /* ========================================
           FORM ELEMENTS
        ======================================== */
        .form-group {
            animation: fadeIn 0.6s var(--transition-smooth) both;
        }

        .form-group:nth-child(1) { animation-delay: 0.6s; }
        .form-group:nth-child(2) { animation-delay: 0.7s; }

        .form-label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            margin-bottom: var(--space-2);
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.875rem;
        }

        .form-label i {
            color: var(--primary);
            width: 16px;
            text-align: center;
        }

        .form-input {
            min-height: 52px;
            font-size: max(16px, 1rem); /* Prevent zoom on iOS */
            transition: all var(--transition-base);
        }

        .form-input:focus {
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.08), 0 4px 12px rgba(29, 78, 216, 0.1);
            transform: translateY(-1px);
        }

        .form-input:hover {
            border-color: var(--primary-light);
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: var(--space-4);
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            cursor: pointer;
            transition: all var(--transition-base);
            padding: var(--space-2);
            border-radius: var(--radius-sm);
            min-width: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--primary);
            background: rgba(29, 78, 216, 0.06);
        }

        /* ========================================
           SUBMIT BUTTON
        ======================================== */
        .submit-btn {
            min-height: 52px;
            animation: fadeIn 0.6s var(--transition-smooth) 0.8s both;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transform: translateX(-100%);
            transition: transform 0.7s var(--transition-smooth);
        }

        .submit-btn:hover::before {
            transform: translateX(100%);
        }

        .submit-btn.loading {
            pointer-events: none;
        }

        .submit-btn.loading span {
            opacity: 0;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* ========================================
           SIGNUP LINK
        ======================================== */
        .signup-link {
            animation: fadeIn 0.6s var(--transition-smooth) 0.9s both;
        }

        /* ========================================
           RESPONSIVE BREAKPOINTS
        ======================================== */
        @media (max-width: 374px) {
            .login-card {
                padding: 1.5rem 1rem !important;
            }
        }

        @media (min-width: 768px) {
            .logo-icon {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-height: 700px) {
            .logo-icon {
                width: 56px;
                height: 56px;
                margin-bottom: var(--space-3);
            }
            
            .page-title {
                font-size: 1.375rem;
                margin-bottom: var(--space-1);
            }
            
            .page-subtitle {
                margin-bottom: var(--space-4);
            }
        }

        /* Landscape mode */
        @media (orientation: landscape) and (max-height: 500px) {
            .logo-icon {
                width: 40px;
                height: 40px;
            }
        }

        /* ========================================
           ACCESSIBILITY - REDUCED MOTION
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
           TOASTR CUSTOMIZATION
        ======================================== */
        #toast-container > div {
            opacity: 0.97;
            box-shadow: var(--shadow-2xl);
            border-radius: var(--radius-lg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            font-weight: 600;
            padding: var(--space-4) var(--space-5);
        }

        #toast-container .toast-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
        }

        #toast-container .toast-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
        }

        @media (max-width: 767px) {
            #toast-container {
                width: 100%;
                max-width: calc(100vw - 2rem);
                left: 50% !important;
                transform: translateX(-50%);
                top: max(1rem, var(--safe-area-top)) !important;
            }
        }

        /* ========================================
           SELECTION STYLING
        ======================================== */
        ::selection {
            background: var(--primary-light);
            color: white;
        }

        ::-moz-selection {
            background: var(--primary-light);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Animated Background -->
    <div class="gradient-bg"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    @include('includes.header')
    @include('pages.popup')

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-4 login-container">
        <div class="w-full max-w-xl login-card shadow-2xl">
            
            <!-- Login Form Section -->
            <section class="p-10 bg-white flex items-center justify-center" aria-labelledby="login-title">
                <div class="w-full">
                    
                    <!-- Logo & Header -->
                    <header class="logo-container">
                        <div class="logo-icon" role="img" aria-label="ULIX AI Logo">
                            <svg width="38" height="38" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M16 2L2 9L16 16L30 9L16 2Z" fill="white" fill-opacity="0.95"/>
                                <path d="M2 23L16 30L30 23V9L16 16V30" fill="white" fill-opacity="0.75"/>
                            </svg>
                        </div>
                    </header>

                    <h1 id="login-title" class="page-title text-center">
                        <!-- i18n:welcome -->Welcome!<!-- /i18n --> <span class="fun-emoji" role="img" aria-label="sparkles">✨</span>
                    </h1>
                    <p class="page-subtitle text-center">
                        <!-- i18n:login_subtitle -->Log in with your email and password.<!-- /i18n -->
                    </p>

                    <!-- Social Login -->
                    <div class="space-y-3 mb-6">
                        <a href="{{ route('google.login') }}" class="social-btn w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition" aria-label="Continue with Google">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="" width="20" height="20" loading="eager">
                            <span><!-- i18n:continue_with_google -->Continue with Google<!-- /i18n --></span>
                        </a>
                    </div>

                    <!-- Divider -->
                    <div class="divider flex items-center my-6" role="separator" aria-label="or">
                        <div class="flex-1 h-px"></div>
                        <span class="px-4 text-sm text-gray-500 font-semibold uppercase tracking-wide">
                            <!-- i18n:or -->or<!-- /i18n -->
                        </span>
                        <div class="flex-1 h-px"></div>
                    </div>

                    <!-- Login Form -->
                    <form id="loginForm" class="space-y-4" method="POST" action="{{ route('user.login') }}" novalidate>
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="form-label block text-sm text-gray-700">
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                <span><!-- i18n:email -->Email<!-- /i18n --></span>
                            </label>
                            <input 
                                id="email"
                                name="email" 
                                type="email" 
                                value="{{ old('email') }}" 
                                required 
                                class="form-input w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" 
                                placeholder="you@example.com"
                                autocomplete="email"
                                inputmode="email"
                                aria-required="true"
                                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}"
                            />
                            @error('email')
                                <p id="email-error" class="text-xs text-red-600 mt-1 font-semibold" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="form-label block text-sm text-gray-700">
                                <i class="fas fa-lock" aria-hidden="true"></i>
                                <span><!-- i18n:password -->Password<!-- /i18n --></span>
                            </label>
                            <div class="relative">
                                <input 
                                    id="password"
                                    name="password" 
                                    type="password" 
                                    required 
                                    class="form-input w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none pr-12" 
                                    placeholder="••••••••"
                                    autocomplete="current-password"
                                    aria-required="true"
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}"
                                />
                                <button 
                                    type="button" 
                                    class="password-toggle" 
                                    id="togglePassword" 
                                    aria-label="Show password"
                                    tabindex="0"
                                >
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                            @error('password')
                                <p id="password-error" class="text-xs text-red-600 mt-1 font-semibold" role="alert">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                                </p>
                            @enderror
                            <div class="text-right mt-1">
                                <a href="/forgot-password" class="text-xs text-blue-600 hover:underline font-semibold transition">
                                    <!-- i18n:forgot_password -->Forgot password?<!-- /i18n -->
                                </a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="submit-btn w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md transition shadow-lg"
                            aria-label="Login"
                        >
                            <span><!-- i18n:login_button -->Login<!-- /i18n --> <span role="img" aria-label="rocket">🚀</span></span>
                        </button>
                    </form>

                    <!-- Signup Link -->
                    <p class="signup-link mt-6 text-xs text-center text-gray-600">
                        <!-- i18n:no_account -->Don't have an account?<!-- /i18n -->
                        <a href="javascript:void(0)" onclick="openSignupPopup()" class="text-blue-600 font-medium hover:underline transition ml-1">
                            <!-- i18n:start_free_trial -->Start Free Trial<!-- /i18n -->
                        </a>
                    </p>
                </div>
            </section>
        </div>
    </main>

    @include('includes.footer')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    
    <script>
        'use strict';

        // ========================================
        // VIEWPORT HEIGHT FIX - MOBILE PERFECT
        // ========================================
        function setVH() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
        setVH();
        
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(setVH, 100);
        });
        
        window.addEventListener('orientationchange', () => {
            setTimeout(setVH, 100);
        });

        // ========================================
        // TOASTR CONFIGURATION & MESSAGES
        // ========================================
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: true,
                    progressBar: true,
                    positionClass: 'toast-top-center',
                    preventDuplicates: true,
                    onclick: null,
                    showDuration: '250',
                    hideDuration: '800',
                    timeOut: '4000',
                    extendedTimeOut: '1000',
                    showEasing: 'easeOutCubic',
                    hideEasing: 'easeInCubic',
                    showMethod: 'fadeIn',
                    hideMethod: 'fadeOut',
                    tapToDismiss: true
                };

                @if(session('toast_success'))
                    toastr.success("{{ session('toast_success') }}");
                @endif

                @if(session('toast_error'))
                    toastr.error("{{ session('toast_error') }}");
                @endif
            }
        });

        // ========================================
        // PASSWORD TOGGLE
        // ========================================
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                
                this.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
                
                if ('vibrate' in navigator) {
                    navigator.vibrate(8);
                }
            });

            togglePassword.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        }

        // ========================================
        // FORM SUBMISSION - LOADING STATE
        // ========================================
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        let isSubmitting = false;

        if (loginForm && submitBtn) {
            loginForm.addEventListener('submit', function(e) {
                if (isSubmitting) {
                    e.preventDefault();
                    return false;
                }

                isSubmitting = true;
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitBtn.setAttribute('aria-busy', 'true');

                if ('vibrate' in navigator) {
                    navigator.vibrate(15);
                }
            });
        }

        // ========================================
        // SIGNUP POPUP FUNCTIONS (PRESERVED)
        // ========================================
        function openSignupPopup() {
            const popup = document.getElementById('signupPopup');
            if (popup) {
                popup.classList.remove('hidden');
                
                if ('vibrate' in navigator) {
                    navigator.vibrate(8);
                }
            }
        }

        function closeSignupPopup() {
            const popup = document.getElementById('signupPopup');
            if (popup) {
                popup.classList.add('hidden');
            }
        }

        // ========================================
        // KEYBOARD NAVIGATION
        // ========================================
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSignupPopup();
            }
        });

        // ========================================
        // PARTICLE SPARKLE EFFECT
        // ========================================
        setInterval(() => {
            const particles = document.querySelectorAll('.particle');
            if (particles.length > 0) {
                const randomParticle = particles[Math.floor(Math.random() * particles.length)];
                const blue1 = 50 + Math.random() * 120;
                const blue2 = 120 + Math.random() * 120;
                randomParticle.style.background = `rgba(${blue1}, ${blue2}, 246, ${0.6 + Math.random() * 0.4})`;
            }
        }, 2500);

        // ========================================
        // PERFORMANCE MONITORING
        // ========================================
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    if (perfData) {
                        const loadTime = perfData.loadEventEnd - perfData.fetchStart;
                        console.log(`⚡ Page loaded in ${Math.round(loadTime)}ms`);
                    }
                }, 0);
            });
        }
    </script>
</body>
</html>