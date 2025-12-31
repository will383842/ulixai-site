<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="en">
    
    <style>
        html{background:#f8fafc}
        .page-loader,.loader,.splash-screen,[class*="loader"],.toast,.alert,.notification,[class*="toast"],[class*="alert"]{display:none!important;opacity:0!important;visibility:hidden!important}
        body{margin:0;padding:0;background:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif}
        .main-login{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding-top:10px}
    </style>
    
    <title>Login - Welcome Back to Ulixai | Secure Sign In</title>
    <meta name="description" content="Log in to your Ulixai account securely. Access your global help network, connect with helpers worldwide, and manage your profile. Sign in with email or Google.">
    <meta name="keywords" content="Ulixai login, sign in, secure login, account access, expat community login, travel help login">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Login to Ulixai - Your Global Help Network">
    <meta property="og:description" content="Access your Ulixai account and connect with helpers worldwide. Fast, secure login.">
    <meta property="og:image" content="{{ asset('images/og-login.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Login to Ulixai">
    <meta name="twitter:description" content="Access your account and connect with helpers worldwide.">
    <meta name="twitter:image" content="{{ asset('images/og-login.jpg') }}">
    
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Tailwind CSS & Design System -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
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

<script>
(function(){
  const loaders=document.querySelectorAll('.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"],.toast,.alert,.notification,[class*="toast"],[class*="alert"]');
  loaders.forEach(function(el){el.remove()});
})();
</script>

@include('includes.header')

<main class="main-login" role="main" aria-labelledby="login-title">
  
  <div class="container">
    
    <article class="login-card">
      
      <div class="card-content">
        
        <header class="login-header">
          
          <div class="brand-icon" aria-hidden="true">
            <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0110.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>

          <h1 id="login-title" class="main-title">Welcome Back! 👋</h1>
          
          <p class="subtitle">Log in to continue your adventure ✨</p>
          
        </header>

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
        </a>

        <div class="divider" role="separator" aria-label="Or sign in with email">
          <span>Or use email</span>
        </div>

        <form id="loginForm" 
              method="POST" 
              action="{{ route('user.login') }}" 
              class="login-form" 
              novalidate
              aria-label="Login form">
          @csrf

          <div class="form-group">
            <label for="email" class="form-label">
              <span>Email</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="email"
                id="email"
                name="email" 
                class="form-input"
                placeholder="you@example.com"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                aria-required="true" />
            </div>
            <div id="error-email" class="error-msg"></div>
          </div>

          <div class="form-group">
            <label for="password" class="form-label">
              <span>Password</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="password"
                id="password"
                name="password" 
                class="form-input"
                placeholder="••••••••"
                required
                autocomplete="current-password"
                aria-required="true" />
              <button type="button" 
                      class="toggle-password" 
                      data-target="password"
                      aria-label="Toggle password visibility">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            <div id="error-password" class="error-msg"></div>
            <div class="forgot-password-link">
              <a href="/forgot-password" class="forgot-link">Forgot password?</a>
            </div>
          </div>

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

          <button type="submit" id="loginBtnSubmit" class="submit-btn">
            <span class="submit-text">Login & Explore 🚀</span>
          </button>

        </form>

        <footer class="card-footer">
          <p class="footer-text">
            <span class="already-text">New to Ulixai?</span>
            <a href="/signup" class="signup-link">Start Free Trial ✨</a>
          </p>
        </footer>

      </div>
    </article>
  </div>

</main>

<section class="faq-section" aria-labelledby="faq-title">
  <div class="container">
    
    <h2 id="faq-title" class="faq-title">Frequently Asked Questions 💬</h2>
    
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
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
.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"],.toast,.alert,.notification,[class*="toast"],[class*="alert"]{
  display:none!important;
  opacity:0!important;
  visibility:hidden!important;
  pointer-events:none!important;
}

*,*::before,*::after{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

html{
  scroll-behavior:smooth;
  background:#f8fafc;
}

body{
  font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;
  font-size:14px;
  line-height:1.5;
  color:#1f2937;
  background:#f8fafc;
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

.main-login{
  min-height:calc(100vh - 80px);
  display:flex;
  align-items:center;
  justify-content:center;
  padding:0.5rem;
  padding-top:10px;
  background:#f8fafc;
}

.container{
  width:100%;
  max-width:26rem;
  margin:0 auto;
}

.login-card{
  background:#fff;
  border-radius:1rem;
  box-shadow:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);
  border:1px solid #e5e7eb;
}

.card-content{
  padding:1rem;
}

.login-header{
  text-align:center;
  margin-bottom:0.75rem;
}

.brand-icon{
  display:inline-flex;
  width:2rem;
  height:2rem;
  margin:0 auto 0.375rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  border-radius:50%;
  align-items:center;
  justify-content:center;
  box-shadow:0 4px 12px rgba(6,182,212,0.3);
}

.icon-svg{
  width:1rem;
  height:1rem;
  color:#fff;
}

.main-title{
  font-size:clamp(18px, 5vw, 24px);
  font-weight:800;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.125rem;
  letter-spacing:-0.02em;
}

.subtitle{
  font-size:clamp(11px, 2vw, 13px);
  color:#6b7280;
  font-weight:500;
  margin-bottom:0;
}

.google-btn{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
  width:100%;
  padding:0.625rem 1rem;
  margin-top:0.75rem;
  background:#fff;
  border:2px solid #4285F4;
  border-radius:0.75rem;
  font-size:13px;
  font-weight:700;
  color:#1f2937;
  text-decoration:none;
  transition:all 0.2s ease;
  box-shadow:0 2px 8px rgba(66,133,244,0.15);
  cursor:pointer;
}

.google-btn:hover{
  background:#4285F4;
  color:#fff;
  box-shadow:0 4px 12px rgba(66,133,244,0.3);
  transform:translateY(-1px);
}

.google-icon{
  width:1.125rem;
  height:1.125rem;
  flex-shrink:0;
}

.divider{
  position:relative;
  text-align:center;
  margin:0.625rem 0;
}

.divider::before{
  content:'';
  position:absolute;
  top:50%;
  left:0;
  right:0;
  height:1px;
  background:#e5e7eb;
}

.divider span{
  position:relative;
  display:inline-block;
  padding:0 0.75rem;
  background:#fff;
  font-size:12px;
  font-weight:600;
  color:#9ca3af;
}

.login-form{
  display:flex;
  flex-direction:column;
  gap:0.625rem;
}

.form-group{
  border:0;
  padding:0;
  margin:0;
}

.form-label{
  display:block;
  font-size:12px;
  font-weight:600;
  color:#374151;
  margin-bottom:0.25rem;
}

.input-wrapper{
  position:relative;
}

.form-input{
  width:100%;
  padding:0.5rem 0.75rem;
  background:#e5e7eb;
  border:2px solid #d1d5db;
  border-radius:0.5rem;
  font-weight:500;
  font-size:13px;
  color:#111827;
  transition:all 0.2s ease;
  font-family:inherit;
}

.form-input::placeholder{
  color:#9ca3af;
  font-weight:400;
}

.form-input:focus{
  outline:none;
  border-color:#06b6d4;
  background:#e5e7eb;
  box-shadow:0 0 0 3px rgba(6,182,212,0.1);
}

.form-input.input-error{
  border-color:#f87171;
  background:#fef2f2;
  animation:shake 0.3s ease;
}

@keyframes shake{
  0%,100%{transform:translateX(0)}
  25%{transform:translateX(-4px)}
  75%{transform:translateX(4px)}
}

.toggle-password{
  position:absolute;
  right:0.75rem;
  top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  cursor:pointer;
  font-size:1rem;
  padding:0.25rem;
  transition:opacity 0.2s;
}

.toggle-password:hover{
  opacity:0.7;
}

.error-msg{
  display:none;
  color:#ef4444;
  font-size:11px;
  font-weight:600;
  margin-top:0.375rem;
  padding:0.5rem 0.625rem;
  background:#fef2f2;
  border-left:3px solid #ef4444;
  border-radius:0.375rem;
}

.error-msg.show{
  display:block;
  animation:slideDown 0.2s ease;
}

@keyframes slideDown{
  from{
    opacity:0;
    transform:translateY(-4px);
  }
  to{
    opacity:1;
    transform:translateY(0);
  }
}

.forgot-password-link{
  text-align:right;
  margin-top:0.25rem;
}

.forgot-link{
  font-size:12px;
  font-weight:600;
  color:#06b6d4;
  text-decoration:none;
  transition:color 0.2s;
}

.forgot-link:hover{
  color:#0891b2;
  text-decoration:underline;
}

.checkbox-group{
  display:flex;
  align-items:center;
}

.checkbox-label{
  display:flex;
  align-items:center;
  gap:0.375rem;
  font-size:12px;
  font-weight:500;
  color:#374151;
  cursor:pointer;
}

.checkbox-input{
  width:0.875rem;
  height:0.875rem;
  cursor:pointer;
  accent-color:#06b6d4;
}

.checkbox-text{
  user-select:none;
}

.submit-btn{
  width:100%;
  padding:0.625rem 1rem;
  margin-top:0.125rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  border:none;
  border-radius:0.5rem;
  font-size:14px;
  font-weight:700;
  color:#fff;
  cursor:pointer;
  transition:all 0.2s ease;
  box-shadow:0 4px 14px rgba(6,182,212,0.3);
  font-family:inherit;
}

.submit-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 6px 20px rgba(6,182,212,0.4);
}

.submit-btn:active{
  transform:translateY(0);
}

.submit-text{
  display:block;
}

.card-footer{
  margin-top:0.75rem;
  padding-top:0.75rem;
  border-top:1px solid #e5e7eb;
  text-align:center;
}

.footer-text{
  display:flex;
  flex-direction:column;
  gap:0.375rem;
  align-items:center;
}

.already-text{
  font-size:12px;
  color:#6b7280;
  font-weight:500;
}

.signup-link{
  display:inline-block;
  padding:0.5rem 1rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  color:#fff;
  font-weight:700;
  font-size:12px;
  border-radius:9999px;
  text-decoration:none;
  transition:all 0.2s ease;
  box-shadow:0 2px 8px rgba(6,182,212,0.25);
}

.signup-link:hover{
  transform:translateY(-1px);
  box-shadow:0 4px 12px rgba(6,182,212,0.35);
}

.faq-section{
  padding:2rem 1rem 2.5rem;
  background:#fff;
}

.faq-title{
  font-size:clamp(24px, 6vw, 36px);
  font-weight:800;
  text-align:center;
  margin-bottom:1.5rem;
  background:linear-gradient(135deg,#2563eb,#06b6d4,#14b8a6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.faq-list{
  display:flex;
  flex-direction:column;
  gap:0.75rem;
  max-width:48rem;
  margin:0 auto;
}

.faq-item{
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:0.5rem;
  overflow:hidden;
  transition:all 0.2s ease;
}

.faq-item:hover{
  border-color:#06b6d4;
  box-shadow:0 2px 8px rgba(6,182,212,0.15);
}

.faq-item[open]{
  border-color:#06b6d4;
}

.faq-question{
  display:flex;
  align-items:center;
  gap:0.75rem;
  padding:0.875rem 1rem;
  cursor:pointer;
  list-style:none;
  font-size:14px;
  font-weight:600;
  color:#1f2937;
  background:#fafafa;
  transition:all 0.2s ease;
}

.faq-question::-webkit-details-marker{
  display:none;
}

.faq-question:hover{
  background:#f0f9ff;
  color:#06b6d4;
}

.faq-icon{
  font-size:1.125rem;
  flex-shrink:0;
}

.faq-question span:nth-child(2){
  flex:1;
}

.faq-toggle{
  font-size:1.125rem;
  font-weight:700;
  color:#06b6d4;
  transition:transform 0.2s ease;
  flex-shrink:0;
}

.faq-item[open] .faq-toggle{
  transform:rotate(45deg);
}

.faq-answer{
  padding:0 1rem 0.875rem 2.875rem;
}

.faq-answer p{
  line-height:1.6;
  color:#4b5563;
  font-size:13px;
}

.footer-links{
  padding:1.25rem 1rem 1.75rem;
  background:#f9fafb;
  border-top:1px solid #e5e7eb;
}

.links-nav{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
  flex-wrap:wrap;
  margin-bottom:0.75rem;
}

.footer-link{
  display:inline-flex;
  align-items:center;
  gap:0.25rem;
  font-size:12px;
  font-weight:600;
  color:#6b7280;
  text-decoration:none;
  transition:color 0.2s ease;
  padding:0.2rem 0.4rem;
}

.footer-link:hover{
  color:#06b6d4;
}

.link-icon{
  font-size:0.75rem;
  opacity:0.8;
}

.link-separator{
  color:#d1d5db;
  font-size:0.625rem;
  user-select:none;
}

.footer-copyright{
  text-align:center;
  font-size:11px;
  color:#9ca3af;
  font-weight:500;
}

@media (min-width:640px){
  .card-content{
    padding:1.25rem;
  }
  
  .main-login{
    padding:1rem;
    padding-top:40px;
  }
}

@media (min-width:1024px){
  .container{
    max-width:28rem;
  }
  
  .card-content{
    padding:1.5rem;
  }
}

@media (prefers-reduced-motion:reduce){
  *,*::before,*::after{
    animation-duration:0.01ms!important;
    animation-iteration-count:1!important;
    transition-duration:0.01ms!important;
  }
  html{
    scroll-behavior:auto;
  }
}
</style>

<script>
(function(){
  'use strict';
  
  const form = document.getElementById('loginForm');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const emailError = document.getElementById('error-email');
  const passwordError = document.getElementById('error-password');
  
  function showError(input, errorEl, message) {
    input.classList.add('input-error');
    errorEl.textContent = message;
    errorEl.classList.add('show');
  }
  
  function clearError(input, errorEl) {
    input.classList.remove('input-error');
    errorEl.textContent = '';
    errorEl.classList.remove('show');
  }
  
  function clearAllErrors() {
    clearError(emailInput, emailError);
    clearError(passwordInput, passwordError);
  }
  
  function getFunMessage(originalMessage) {
    const msg = originalMessage.toLowerCase();
    
    if (msg.includes('credentials') || msg.includes('do not match') || msg.includes('incorrect')) {
      if (msg.includes('email')) {
        return "🤔 Hmm, we don't recognize this email. Double-check?";
      } else {
        return "🔐 Oops! That password doesn't match. Try again?";
      }
    }
    
    if (msg.includes('email') && (msg.includes('invalid') || msg.includes('valid'))) {
      return "📧 Oops! That doesn't look like a real email address";
    }
    
    if (msg.includes('password') && msg.includes('required')) {
      return "🔑 Don't forget your password! Type it in";
    }
    
    if (msg.includes('email') && msg.includes('required')) {
      return "👋 Hey! We need your email address to log you in";
    }
    
    if (msg.includes('not found') || msg.includes('does not exist') || msg.includes('no account')) {
      return "😅 We can't find that email in our system. Maybe try signing up?";
    }
    
    if (msg.includes('too many')) {
      return "⏸️ Whoa there! Too many attempts. Take a quick break?";
    }
    
    return originalMessage;
  }
  
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
  
  emailInput.addEventListener('input', function(){
    if(this.value.trim()){
      clearError(this, emailError);
    }
  });
  
  passwordInput.addEventListener('input', function(){
    if(this.value){
      clearError(this, passwordError);
    }
  });
  
  form.addEventListener('submit',function(e){
    e.preventDefault();
    
    const email = emailInput.value.trim();
    const password = passwordInput.value;
    let isValid = true;
    
    clearAllErrors();
    
    if(!email){
      showError(emailInput, emailError, "👋 Hey! We need your email address to log you in");
      isValid = false;
    } else if(!/^\S+@\S+\.\S+$/.test(email)){
      showError(emailInput, emailError, "📧 Oops! That doesn't look like a real email address");
      isValid = false;
    }
    
    if(!password){
      showError(passwordInput, passwordError, "🔑 Don't forget your password! Type it in");
      isValid = false;
    }
    
    if(isValid){
      form.submit();
    }
  });
  
  @if(session('toast_error') || session('error'))
    var errorMsg = "{{ session('toast_error') ?? session('error') }}";
    var funMsg = getFunMessage(errorMsg);
    
    if(errorMsg.toLowerCase().includes('password')) {
      showError(passwordInput, passwordError, funMsg);
    } else {
      showError(emailInput, emailError, funMsg);
    }
  @elseif($errors->has('email'))
    showError(emailInput, emailError, getFunMessage("{{ $errors->first('email') }}"));
  @elseif($errors->has('password'))
    showError(passwordInput, passwordError, getFunMessage("{{ $errors->first('password') }}"));
  @elseif($errors->any())
    var errorMsg = "{{ $errors->first() }}";
    var funMsg = getFunMessage(errorMsg);
    
    if(errorMsg.toLowerCase().includes('password')) {
      showError(passwordInput, passwordError, funMsg);
    } else {
      showError(emailInput, emailError, funMsg);
    }
  @endif
})();
</script>

@include('includes.footer')

</body>
</html>