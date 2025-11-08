<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="en">
    
    <!-- Critical CSS - Loaded immediately to prevent FOUC -->
    <style>
        body{margin:0;padding:0;background:linear-gradient(135deg,#eff6ff 0%,#ecfeff 50%,#f0fdfa 100%);font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;opacity:0;animation:fadeInBody 0.3s ease-in forwards}
        @keyframes fadeInBody{to{opacity:1}}
        .main-login{min-height:100vh;display:flex;align-items:center;justify-content:center}
        
        .page-loader.hidden{opacity:0;pointer-events:none}
        
        
        50%{transform:translateY(-10px)}}
        
    </style>
    
    <!-- SEO Meta Tags -->
    <title>Login - Welcome Back to Ulixai | Secure Sign In</title>
    <meta name="description" content="Log in to your Ulixai account securely. Access your global help network, connect with helpers worldwide, and manage your profile. Sign in with email or Google.">
    <meta name="keywords" content="Ulixai login, sign in, secure login, account access, expat community login, travel help login">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Login to Ulixai - Your Global Help Network">
    <meta property="og:description" content="Access your Ulixai account and connect with helpers worldwide. Fast, secure login.">
    <meta property="og:image" content="{{ asset('images/og-login.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Login to Ulixai">
    <meta name="twitter:description" content="Access your account and connect with helpers worldwide.">
    <meta name="twitter:image" content="{{ asset('images/og-login.jpg') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Google Fonts - Optimized loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    </noscript>
    
    <!-- Toastr CSS - Optimized loading -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print" onload="this.media='all'">
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Login - Ulixai",
      "description": "Secure login page for Ulixai global help network. Sign in to access your account and connect with helpers worldwide.",
      "url": "{{ url()->current() }}",
      "image": "{{ asset('images/og-login.jpg') }}",
      "inLanguage": "en",
      "isPartOf": {
        "@type": "WebSite",
        "name": "Ulixai",
        "url": "{{ config('app.url') }}"
      },
      "author": {
        "@type": "Organization",
        "name": "Ulixai",
        "logo": "{{ asset('images/logo.png') }}"
      },
      "potentialAction": {
        "@type": "LoginAction",
        "name": "Sign In",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "{{ route('user.login') }}",
          "actionPlatform": [
            "http://schema.org/DesktopWebPlatform",
            "http://schema.org/MobileWebPlatform"
          ]
        }
      }
    }
    </script>
</head>
<body>

<!-- Page Loader -->
<p class="loader-text">Welcome back to Ulixai...</p>
    </div>
</div>

@include('includes.header')

<!-- ============================================
     🎯 ULIXAI LOGIN - MOBILE-FIRST PERFECTION
     ⚡ Ultra-optimized Performance
     🔍 SEO & AI-Ready
     📱 Mobile-First Design
     ============================================ -->

<!-- Main Content -->
<main class="main-login" role="main" aria-labelledby="login-title">
  
  <!-- Background Layer - CSS only -->
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Content Container -->
  <div class="container">
    
    <!-- Login Card -->
    <article class="login-card">
      
      <!-- Card Border Effect -->
      <div class="card-border" aria-hidden="true"></div>
      
      <!-- Card Content -->
      <div class="card-content">
        
        <!-- Header Section -->
        <header class="login-header">
          
          <!-- Brand Icon -->
          <div class="brand-icon" aria-hidden="true">
            <div class="icon-container">
              <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0110.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>

          <!-- Main Heading - H1 for SEO -->
          <h1 id="login-title" class="main-title">
            <span class="title-text">Welcome Back!</span>
            <span class="title-emoji" aria-hidden="true">👋</span>
          </h1>
          
          <!-- Subtitle -->
          <p class="subtitle">Log in and continue your adventure! ✨🌍</p>
          
        </header>

        <!-- Google Sign In -->
        <a href="{{ route('google.login') }}" 
           class="google-btn" 
           aria-label="Continue with Google">
          <svg class="google-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          <span>Sign in with Google</span>
          <span class="rocket" aria-hidden="true">⚡</span>
        </a>

        <!-- Divider -->
        <div class="divider" role="separator" aria-label="Or sign in with email">
          <span>Or use your email 💌</span>
        </div>

        <!-- Login Form -->
        <form id="loginForm" 
              method="POST" 
              action="{{ route('user.login') }}" 
              class="login-form" 
              novalidate
              aria-label="Login form">
          @csrf

          <!-- Email -->
          <div class="form-group">
            <label for="email" class="form-label">
              <span aria-hidden="true">📧</span>
              <span>Email</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="email"
                id="email"
                name="email" 
                class="form-input @error('email') input-error @enderror"
                placeholder="you@example.com"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                aria-required="true"
                aria-invalid="@error('email')true @else false @enderror"
                aria-describedby="error-email" />
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            @error('email')
              <p id="error-email" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @else
              <p id="error-email" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @enderror
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password" class="form-label">
              <span aria-hidden="true">🔐</span>
              <span>Password</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="password"
                id="password"
                name="password" 
                class="form-input @error('password') input-error @enderror"
                placeholder="••••••••"
                required
                autocomplete="current-password"
                aria-required="true"
                aria-invalid="@error('password')true @else false @enderror"
                aria-describedby="error-password" />
              <div class="input-glow" aria-hidden="true"></div>
              <button type="button" 
                      class="toggle-password" 
                      data-target="password"
                      aria-label="Toggle password visibility">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            @error('password')
              <p id="error-password" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @else
              <p id="error-password" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @enderror
            <div class="forgot-password-link">
              <a href="/forgot-password" class="forgot-link">
                <span>Forgot password?</span>
                <span aria-hidden="true">🔑</span>
              </a>
            </div>
          </div>

          <!-- Remember Me Checkbox -->
          <div class="form-group checkbox-group">
            <label for="remember-me" class="checkbox-label">
              <input 
                type="checkbox"
                id="remember-me"
                name="remember_me"
                class="checkbox-input"
                aria-label="Remember my email and password" />
              <span class="checkbox-text">Remember me</span>
            </label>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="loginBtnSubmit" class="submit-btn">
            <span class="submit-bg" aria-hidden="true"></span>
            <span class="submit-text">
              <span class="submit-label">Login & Explore! 🚀</span>
              <span class="submit-emoji" aria-hidden="true">✨</span>
            </span>
          </button>

        </form>

        <!-- Signup Link -->
        <footer class="card-footer">
          <p class="footer-text">
            <span class="already-text">New to Ulixai? 🎊</span>
            <a href="/signup" class="signup-link-fun">
              <span>Start Free Trial</span>
              <span aria-hidden="true">🌟✨</span>
            </a>
          </p>
        </footer>

      </div>
    </article>
  </div>

</main>

<!-- Fun Error Toast -->
<div id="funToast" class="fun-toast" role="alert" aria-live="polite" aria-atomic="true">
  <div class="toast-content">
    <span class="toast-emoji" id="toastEmoji">😊</span>
    <div class="toast-message">
      <p class="toast-title" id="toastTitle">Oops!</p>
      <p class="toast-text" id="toastText">Something needs your attention</p>
    </div>
    <button type="button" class="toast-close" onclick="closeFunToast()" aria-label="Close message">✕</button>
  </div>
</div>

<!-- FAQ Section - SEO Rich -->
<section class="faq-section" aria-labelledby="faq-title">
  <div class="container">
    
    <h2 id="faq-title" class="faq-title">Frequently Asked Questions 💬</h2>
    
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
      <!-- Question 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔐</span>
          <span>Is my login secure on Ulixai?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Absolutely!</strong> We use bank-level SSL encryption, secure OAuth 2.0 authentication with Google, and follow strict GDPR compliance. Your login credentials are encrypted both in transit and at rest. We also offer two-factor authentication (2FA) for additional security.
          </p>
        </div>
      </details>

      <!-- Question 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">❓</span>
          <span>I forgot my password. What should I do?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>No worries!</strong> Click the "Forgot password?" link below the password field. Enter your email address, and we'll send you a secure reset link within minutes. Follow the instructions in the email to create a new password. If you don't receive the email, check your spam folder or contact our support team.
          </p>
        </div>
      </details>

      <!-- Question 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🚀</span>
          <span>Can I login with Google?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, absolutely!</strong> Click the "Sign in with Google" button for instant access. This method is fast, secure, and eliminates the need to remember another password. Your Google account credentials are never shared with us - we only receive basic profile information to create and authenticate your Ulixai account.
          </p>
        </div>
      </details>

      <!-- Question 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📱</span>
          <span>Can I login from multiple devices?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, of course!</strong> You can access your Ulixai account from any device - desktop, laptop, tablet, or smartphone. Your account automatically syncs across all devices. Use our mobile apps on iOS and Android for the best mobile experience, or access Ulixai through any web browser.
          </p>
        </div>
      </details>

      <!-- Question 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⚠️</span>
          <span>Why can't I login to my account?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Common solutions:</strong> Make sure you're using the correct email address registered with your account. Check that Caps Lock is off when entering your password. Clear your browser cache and cookies, or try a different browser. If you recently changed your password, use the new one. Still having issues? Use the "Forgot password?" link or contact our 24/7 support team for immediate assistance.
          </p>
        </div>
      </details>

      <!-- Question 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌍</span>
          <span>Can I login from anywhere in the world?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, from anywhere!</strong> Ulixai is accessible globally in 195+ countries. Whether you're traveling, relocating, or working remotely, you can access your account from any location with an internet connection. Our platform automatically adjusts to your timezone and location preferences.
          </p>
        </div>
      </details>

      <!-- Question 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔄</span>
          <span>How do I update my login credentials?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Easy to update!</strong> Once logged in, go to Settings > Account Security. From there, you can change your password, update your email address, enable two-factor authentication, and manage connected social accounts. We recommend updating your password every 3-6 months for optimal security.
          </p>
        </div>
      </details>

      <!-- Question 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🛡️</span>
          <span>Do you offer two-factor authentication?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, we highly recommend it!</strong> Enable two-factor authentication (2FA) in your account settings for an extra layer of security. We support SMS codes, authenticator apps (Google Authenticator, Authy), and email verification. With 2FA enabled, even if someone knows your password, they can't access your account without the second verification step.
          </p>
        </div>
      </details>

    </div>
  </div>
</section>

<!-- Footer Links -->
<footer class="footer-links" role="contentinfo">
  <div class="container">
    <nav class="links-nav" aria-label="Footer navigation">
      <a href="https://ulixai.com/partnershiprequest" class="footer-link" rel="nofollow">
        <span class="link-icon" aria-hidden="true">🤝</span>
        <span>Partnership</span>
      </a>
      <span class="link-separator" aria-hidden="true">•</span>
      <a href="https://ulixai.com/press" class="footer-link" rel="nofollow">
        <span class="link-icon" aria-hidden="true">📰</span>
        <span>Press</span>
      </a>
      <span class="link-separator" aria-hidden="true">•</span>
      <a href="https://ulixai.com/recruitment" class="footer-link" rel="nofollow">
        <span class="link-icon" aria-hidden="true">💼</span>
        <span>Careers</span>
      </a>
    </nav>
    <p class="footer-copyright">
      &copy; {{ date('Y') }} Ulixai. All rights reserved.
    </p>
  </div>
</footer>

<style>
/* ============================================
   CSS - MOBILE-FIRST & OPTIMIZED
   Tailles adaptées et responsive
   ============================================ */

*,*::before,*::after{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

body{
  font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
  font-size:14px;
  line-height:1.6;
  color:#333;
}

.sr-only{
  position:absolute;
  width:1px;
  height:1px;
  padding:0;
  margin:-1px;
  overflow:hidden;
  clip:rect(0,0,0,0);
  white-space:nowrap;
  border-width:0;
}

/* Main Login Container */
.main-login{
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:0.5rem;
  position:relative;
  overflow:hidden;
  background:linear-gradient(135deg,#eff6ff 0%,#ecfeff 50%,#f0fdfa 100%);
}

/* Background Layer */
.bg-layer{
  position:absolute;
  inset:0;
  overflow:hidden;
  pointer-events:none;
}

.blob{
  position:absolute;
  border-radius:50%;
  mix-blend-mode:multiply;
  filter:blur(60px);
  opacity:0;
  will-change:transform;
  transform:translateZ(0);
  animation:fade-in 0.8s ease-out forwards, float-1 12s ease-in-out infinite;
  animation-delay:0.3s;
}

.blob-1{
  width:24rem;
  height:24rem;
  background:#3b82f6;
  top:5rem;
  left:2.5rem;
  animation:fade-in 0.8s ease-out forwards, float-1 12s ease-in-out infinite;
  animation-delay:0.3s;
}

.blob-2{
  width:20rem;
  height:20rem;
  background:#06b6d4;
  top:10rem;
  right:5rem;
  animation:fade-in 0.8s ease-out forwards, float-2 15s ease-in-out infinite;
  animation-delay:0.5s;
}

.blob-3{
  width:18rem;
  height:18rem;
  background:#14b8a6;
  bottom:8rem;
  left:50%;
  animation:fade-in 0.8s ease-out forwards, float-3 18s ease-in-out infinite;
  animation-delay:0.7s;
}

@keyframes fade-in{
  0%{opacity:0}
  100%{opacity:0.4}
}

@keyframes float-1{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(2rem,-2rem) scale(1.1)}
  66%{transform:translate(-1rem,1rem) scale(0.9)}
}

@keyframes float-2{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(-2rem,2rem) scale(0.9)}
  66%{transform:translate(2rem,-1rem) scale(1.1)}
}

@keyframes float-3{
  0%,100%{transform:translate(-50%,0) scale(1)}
  50%{transform:translate(-50%,-2rem) scale(1.05)}
}

.container{
  width:100%;
  max-width:28rem;
  margin:0 auto;
  position:relative;
  z-index:1;
}

/* Card */
.login-card{
  position:relative;
  background:#fff;
  border-radius:1.5rem;
  box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);
  overflow:hidden;
}

.card-border{
  position:absolute;
  inset:-2px;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6,#ec4899);
  border-radius:1.5rem;
  z-index:-1;
  opacity:0;
  transition:opacity 0.3s ease;
}

.login-card:hover .card-border{
  opacity:0.7;
}

.card-content{
  padding:1rem 1.25rem;
  position:relative;
  background:#fff;
  border-radius:1.5rem;
}

/* Header */
.login-header{
  text-align:center;
  margin-bottom:0.875rem;
}

/* Brand Icon */
.brand-icon{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:2.25rem;
  height:2.25rem;
  margin:0 auto 0.5rem;
  position:relative;
}

.icon-container{
  width:2.25rem;
  height:2.25rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 10px 25px rgba(6,182,212,0.3);
}

.icon-svg{
  width:1.125rem;
  height:1.125rem;
  color:#fff;
}

/* Title - Responsive avec clamp */
.main-title{
  font-size:clamp(24px, 6vw, 40px);
  font-weight:800;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.25rem;
  letter-spacing:-0.025em;
}

.title-text{
  display:inline-block;
}

.title-emoji{
  display:inline-block;
  margin-left:0.3rem;
  font-size:clamp(20px, 5vw, 32px);
}

/* Subtitle */
.subtitle{
  font-size:clamp(13px, 2vw, 16px);
  color:#6b7280;
  font-weight:500;
  margin-bottom:0.75rem;
}

/* Google Button */
.google-btn{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.75rem;
  width:100%;
  padding:0.625rem 1rem;
  background:#fff;
  border:2px solid #e5e7eb;
  border-radius:0.75rem;
  font-size:13px;
  font-weight:600;
  color:#1f2937;
  text-decoration:none;
  transition:all 0.3s ease;
  box-shadow:0 1px 3px rgba(0,0,0,0.1);
  margin-bottom:0.75rem;
  cursor:pointer;
}

.google-btn:hover{
  border-color:#06b6d4;
  box-shadow:0 10px 25px rgba(6,182,212,0.2);
  transform:translateY(-2px);
}

.google-icon{
  width:1rem;
  height:1rem;
  flex-shrink:0;
}

.rocket{
  font-size:0.875rem;
}

/* Divider */
.divider{
  position:relative;
  text-align:center;
  margin:0.75rem 0;
}

.divider::before{
  content:'';
  position:absolute;
  top:50%;
  left:0;
  right:0;
  height:2px;
  background:#e5e7eb;
  border-style:dashed;
}

.divider span{
  position:relative;
  display:inline-block;
  padding:0 1rem;
  background:rgba(255,255,255,0.95);
  font-size:13px;
  font-weight:600;
  color:#6b7280;
}

/* Form */
.login-form{
  display:flex;
  flex-direction:column;
  gap:0.75rem;
}

.form-group{
  border:0;
  padding:0;
  margin:0;
}

.form-label{
  display:flex;
  align-items:center;
  gap:0.5rem;
  font-size:12px;
  font-weight:700;
  color:#374151;
  margin-bottom:0.25rem;
}

.input-wrapper{
  position:relative;
}

.form-input{
  width:100%;
  padding:0.625rem 0.875rem;
  background:#f3f4f6;
  border:2px solid #d1d5db;
  border-radius:0.75rem;
  font-weight:600;
  font-size:14px;
  color:#111827;
  transition:all 0.3s ease;
  font-family:inherit;
}

.form-input::placeholder{
  color:#9ca3af;
  font-weight:500;
  font-size:13px;
}

.form-input:focus{
  outline:none;
  border-color:#06b6d4;
  background:#fff;
  box-shadow:0 0 0 3px rgba(6,182,212,0.1);
}

.input-error{
  border-color:#ef4444!important;
  background:#fef2f2!important;
}

.input-glow{
  position:absolute;
  inset:0;
  border-radius:0.75rem;
  opacity:0;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  filter:blur(20px);
  transition:opacity 0.3s ease;
  pointer-events:none;
  z-index:-1;
}

.form-input:focus + .input-glow{
  opacity:0.3;
}

.toggle-password{
  position:absolute;
  right:0.75rem;
  top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  cursor:pointer;
  font-size:1.1rem;
  padding:0.4rem;
  transition:transform 0.3s ease;
}

.toggle-password:hover{
  transform:translateY(-50%) scale(1.1);
}

.error-msg{
  color:#ef4444;
  font-size:12px;
  font-weight:700;
  margin-top:0.25rem;
  min-height:1rem;
}

.forgot-password-link{
  text-align:right;
  margin-top:0.375rem;
}

.forgot-link{
  display:inline-flex;
  align-items:center;
  gap:0.25rem;
  font-size:13px;
  font-weight:600;
  color:#06b6d4;
  text-decoration:none;
  transition:all 0.3s ease;
}

.forgot-link:hover{
  color:#0891b2;
  text-decoration:underline;
}

/* Checkbox Remember Me */
.checkbox-group{
  display:flex;
  align-items:center;
}

.checkbox-label{
  display:flex;
  align-items:center;
  gap:0.5rem;
  font-size:13px;
  font-weight:600;
  color:#374151;
  cursor:pointer;
}

.checkbox-input{
  width:1.125rem;
  height:1.125rem;
  cursor:pointer;
  accent-color:#06b6d4;
}

.checkbox-text{
  user-select:none;
}

/* Submit Button */
.submit-btn{
  position:relative;
  width:100%;
  padding:0.7rem 1rem;
  margin-top:0.125rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  border:none;
  border-radius:0.75rem;
  font-size:14px;
  font-weight:700;
  color:#fff;
  cursor:pointer;
  overflow:hidden;
  transition:all 0.3s ease;
  box-shadow:0 8px 25px -8px rgba(6,182,212,0.4);
  font-family:inherit;
}

.submit-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 35px -8px rgba(6,182,212,0.5);
}

.submit-btn:active{
  transform:translateY(0);
}

.submit-bg{
  position:absolute;
  inset:0;
  background:linear-gradient(135deg,#0891b2,#7c3aed);
  opacity:0;
  transition:opacity 0.3s ease;
}

.submit-btn:hover .submit-bg{
  opacity:1;
}

.submit-text{
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.4rem;
}

.submit-label{
  font-size:14px;
}

.submit-emoji{
  font-size:0.875rem;
}

/* Footer */
.card-footer{
  margin-top:0.875rem;
  padding-top:0.875rem;
  border-top:2px dashed #d1d5db;
}

.footer-text{
  display:flex;
  flex-direction:column;
  gap:0.375rem;
  align-items:center;
  text-align:center;
}

.already-text{
  font-size:12px;
  color:#6b7280;
  font-weight:600;
}

.signup-link-fun{
  display:inline-flex;
  align-items:center;
  gap:0.3rem;
  padding:0.5rem 1rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  color:#fff;
  font-weight:700;
  font-size:12px;
  border-radius:9999px;
  text-decoration:none;
  transition:all 0.3s ease;
  box-shadow:0 4px 15px rgba(6,182,212,0.3);
  animation:pulse-glow 2s ease-in-out infinite;
}

.signup-link-fun:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 25px rgba(6,182,212,0.5);
  background:linear-gradient(135deg,#0891b2,#7c3aed);
}

@keyframes pulse-glow{
  0%,100%{box-shadow:0 4px 15px rgba(6,182,212,0.3)}
  50%{box-shadow:0 4px 25px rgba(139,92,246,0.5)}
}

/* FAQ Section */
.faq-section{
  padding:3rem 1rem;
  background:#fff;
}

.faq-title{
  font-size:clamp(32px, 7vw, 56px);
  font-weight:900;
  text-align:center;
  margin-bottom:2rem;
  background:linear-gradient(135deg,#2563eb,#06b6d4,#14b8a6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.faq-list{
  display:flex;
  flex-direction:column;
  gap:0.875rem;
  max-width:48rem;
  margin:0 auto;
}

.faq-item{
  background:#fff;
  border:2px solid #e5e7eb;
  border-radius:0.75rem;
  overflow:hidden;
  transition:all 0.3s ease;
}

.faq-item:hover{
  border-color:#06b6d4;
  box-shadow:0 4px 20px -4px rgba(6,182,212,0.2);
}

.faq-item[open]{
  border-color:#06b6d4;
  box-shadow:0 8px 30px -8px rgba(6,182,212,0.3);
}

.faq-question{
  display:flex;
  align-items:center;
  gap:0.875rem;
  padding:1rem 1.25rem;
  cursor:pointer;
  list-style:none;
  font-size:14px;
  font-weight:700;
  color:#1f2937;
  background:linear-gradient(135deg,#f9fafb,#fff);
  transition:all 0.3s ease;
}

.faq-question::-webkit-details-marker{
  display:none;
}

.faq-question:hover{
  background:linear-gradient(135deg,#ecfeff,#f0fdfa);
  color:#06b6d4;
}

.faq-icon{
  font-size:1.25rem;
  flex-shrink:0;
}

.faq-question span:nth-child(2){
  flex:1;
}

.faq-toggle{
  font-size:1.25rem;
  font-weight:900;
  color:#06b6d4;
  transition:transform 0.3s ease;
  flex-shrink:0;
}

.faq-item[open] .faq-toggle{
  transform:rotate(45deg);
}

.faq-answer{
  padding:0 1.25rem 1rem 3rem;
}

.faq-answer p{
  line-height:1.6;
  color:#4b5563;
  font-size:14px;
}

/* Footer Links */
.footer-links{
  padding:1.5rem 1rem 2.25rem;
  background:linear-gradient(to bottom,#fff,#f9fafb);
  border-top:1px solid #e5e7eb;
}

.links-nav{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
  flex-wrap:wrap;
  margin-bottom:1rem;
}

.footer-link{
  display:inline-flex;
  align-items:center;
  gap:0.3rem;
  font-size:13px;
  font-weight:600;
  color:#6b7280;
  text-decoration:none;
  transition:color 0.3s ease;
  padding:0.2rem 0.4rem;
}

.footer-link:hover{
  color:#06b6d4;
}

.link-icon{
  font-size:0.8rem;
  opacity:0.7;
}

.link-separator{
  color:#d1d5db;
  font-size:0.65rem;
  user-select:none;
}

.footer-copyright{
  text-align:center;
  font-size:12px;
  color:#9ca3af;
  font-weight:500;
}

/* Tablet */
@media (min-width:640px){
  .card-content{
    padding:1.5rem 1.5rem;
  }
  
  .form-input{
    font-size:15px;
  }
  
  .google-btn{
    font-size:14px;
    padding:0.7rem 1.25rem;
  }
  
  .submit-btn{
    font-size:14px;
    padding:0.75rem 1.25rem;
  }
}

/* Desktop */
@media (min-width:1024px){
  .container{
    max-width:32rem;
  }
  
  .card-content{
    padding:1.75rem 1.75rem;
  }
  
  .form-input{
    font-size:16px;
    padding:0.7rem 1rem;
  }
  
  .google-btn{
    font-size:15px;
    padding:0.75rem 1.5rem;
  }
  
  .submit-btn{
    font-size:15px;
    padding:0.8rem 1.5rem;
  }
  
  .faq-answer{
    font-size:15px;
  }
}

/* Accessibility */
@media (prefers-reduced-motion:reduce){
  *,*::before,*::after{
    animation-duration:0.01ms!important;
    animation-iteration-count:1!important;
    transition-duration:0.01ms!important;
  }
}

@media (prefers-contrast:high){
  .form-input:focus{
    border:3px solid #1e40af;
  }
}

/* Fun Toast */
.fun-toast{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%) scale(0);background:linear-gradient(135deg,#06b6d4,#8b5cf6);border-radius:1.5rem;padding:2rem;z-index:9999;box-shadow:0 25px 50px -12px rgba(6,182,212,0.4);opacity:0;transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1);pointer-events:none;max-width:90%;width:100%;max-width:28rem}
.fun-toast.show{transform:translate(-50%,-50%) scale(1);opacity:1;pointer-events:auto}
.toast-content{display:flex;align-items:center;gap:1.5rem;color:#fff}
.toast-emoji{font-size:3rem;animation:bounce 0.6s ease-in-out}
.toast-message{flex:1}
.toast-title{font-size:1.25rem;font-weight:800;margin:0 0 0.25rem;letter-spacing:-0.025em}
.toast-text{font-size:0.9375rem;margin:0;opacity:0.95}
.toast-close{position:absolute;top:1rem;right:1rem;background:rgba(255,255,255,0.2);border:2px solid rgba(255,255,255,0.5);color:#fff;border-radius:50%;width:2.5rem;height:2.5rem;font-size:1.25rem;cursor:pointer;transition:all 0.3s ease;font-weight:700}
.toast-close:hover{background:rgba(255,255,255,0.3);border-color:#fff;transform:rotate(90deg)}
@keyframes bounce{0%,100%{transform:scale(0)}50%{transform:scale(1.1)}}
</style>

<!-- JavaScript -->
<script>
(function(){
  'use strict';
  
  // Hide page loader when everything is loaded
  window.addEventListener('load', function() {
    
  
  // Fallback - hide loader after 2 seconds max
  setTimeout(function() {
    
  
  // Password toggle
  document.addEventListener('click',function(e){
    const toggle=e.target.closest('.toggle-password');
    if(!toggle)return;
    
    const targetId=toggle.dataset.target;
    const input=document.getElementById(targetId);
    const icon=toggle.querySelector('.eye-icon');
    
    if(input.type==='password'){
      input.type='text';
      icon.textContent='🙈';
    } else {
      input.type='password';
      icon.textContent='👁️';
    }
  });
  
  // Real-time validation
  const inputs=form.querySelectorAll('input[type="email"],input[type="password"]');
  inputs.forEach(function(input){
    input.addEventListener('input',function(){
      const errorEl=document.getElementById('error-'+this.name);
      if(errorEl && this.value.trim()){
        errorEl.textContent='';
        this.classList.remove('input-error');
      }
    });
  });
  
  // Form submission validation
  form.addEventListener('submit',function(e){
    const errorIds=['email','password'];
    errorIds.forEach(function(id){
      const el=document.getElementById('error-'+id);
      if(el)el.textContent='';
    });
    
    inputs.forEach(function(input){
      input.classList.remove('input-error');
    });
    
    let valid=true;
    const email=form.elements.email.value.trim();
    const password=form.elements.password.value;
    
    if(!email){
      form.elements.email.classList.add('input-error');
      showFunToast('✉️ Hold on!', 'We need your email address!', '✉️');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email)){
      form.elements.email.classList.add('input-error');
      showFunToast('🤔 Hmm...', 'That doesn\'t look like a valid email!', '📧');
      valid=false;
    }
    
    if(!password){
      form.elements.password.classList.add('input-error');
      showFunToast('🔐 Oops!', 'Enter your password, please!', '🔐');
      valid=false;
    }
    
    if(!valid){
      e.preventDefault();
      btn.disabled=false;
      return false;
    }
  });
  
  function showFunToast(title, message, emoji){
    document.getElementById('toastTitle').textContent=title;
    document.getElementById('toastText').textContent=message;
    document.getElementById('toastEmoji').textContent=emoji;
    funToast.classList.add('show');
    setTimeout(function(){
      closeFunToast();
    }, 4500);
  }
  
  // Initialize on load
  loadSavedCredentials();
})();

function closeFunToast(){
  document.getElementById('funToast').classList.remove('show');
}

// Signup popup function
function openSignupPopup(){
  const popup=document.getElementById('signupPopup');
  if(popup){
    popup.classList.remove('hidden');
  }
}

function closeSignupPopup(){
  const popup=document.getElementById('signupPopup');
  if(popup){
    popup.classList.add('hidden');
  }
}
</script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    @if(session('toast_success'))
        toastr.success("{{ session('toast_success') }}");
    @endif
    @if(session('toast_error'))
        toastr.error("{{ session('toast_error') }}");
    @endif
});
</script>

@include('includes.footer')

</body>
</html>