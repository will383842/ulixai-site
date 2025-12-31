<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="en">
    
    <!-- ⚡ CRITICAL: FORCER L'AFFICHAGE IMMÉDIAT -->
    <style>
        html,body{opacity:1!important;visibility:visible!important;background:#f8fafc!important}
        .page-loader,.loader,.splash-screen,.loading-screen,.preloader,.overlay,[class*="loader"],[class*="loading"],[class*="splash"],[class*="preload"]{display:none!important;opacity:0!important;visibility:hidden!important;position:absolute!important;left:-9999px!important}
    </style>
    
    <script>
    (function(){
        document.documentElement.style.opacity = '1';
        document.documentElement.style.visibility = 'visible';
        if(document.body) {
            document.body.style.opacity = '1';
            document.body.style.visibility = 'visible';
            document.body.style.background = '#f8fafc';
        }
    })();
    </script>
    
    <style>
        .page-loader,.loader,.splash-screen,[class*="loader"]{display:none!important;opacity:0!important;visibility:hidden!important}
        body{margin:0;padding:0;background:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif}
        .main-signup{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding-top:10px}
    </style>
    
    <title>Create Account - Join Ulixai Global Community</title>
    <meta name="description" content="Create your Ulixai account in seconds. Join thousands of global helpers connecting across borders. Sign up with email or Google.">
    <meta name="keywords" content="Ulixai signup, create account, global help network, registration, community signup, expat help, international support">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Join Ulixai - Global Help Network">
    <meta property="og:description" content="Create your account and connect with helpers worldwide. Fast and secure signup.">
    <meta property="og:image" content="{{ asset('images/og-signup.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Join Ulixai - Global Help Network">
    <meta name="twitter:description" content="Create your account and connect with helpers worldwide. Fast and secure signup.">
    <meta name="twitter:image" content="{{ asset('images/og-signup.jpg') }}">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Tailwind CSS & Design System -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Create Account - Ulixai",
      "description": "Join Ulixai's global community connecting helpers and seekers worldwide. Create your account in seconds with email or Google sign-in.",
      "url": "{{ url()->current() }}",
      "image": "{{ asset('images/og-signup.jpg') }}",
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
      }
    }
    </script>
</head>
<body>

<script>
// ⚡ FORCER L'AFFICHAGE IMMÉDIAT - AVANT TOUT
(function(){
    document.documentElement.style.opacity = '1';
    document.documentElement.style.visibility = 'visible';
    document.body.style.opacity = '1';
    document.body.style.visibility = 'visible';
    document.body.style.background = '#f8fafc';
    
    var removeAll = function() {
        var selectors = [
            '.page-loader', '.loader', '.splash-screen', '.loading-screen', 
            '.preloader', '.overlay', '[class*="loader"]', '[class*="loading"]',
            '[class*="splash"]', '[class*="preload"]', '.spinner', '.loading',
            '#page-loader', '#loader', '#splash', '#preloader', '.alert',
            '.toast', '.notification', '.swal2-container', '.swal-overlay',
            '[class*="alert"]', '[class*="toast"]', '[class*="notification"]',
            '[class*="swal"]', '.error-alert', '.success-alert'
        ];
        
        selectors.forEach(function(sel) {
            try {
                var els = document.querySelectorAll(sel);
                els.forEach(function(el) {
                    el.style.display = 'none';
                    el.style.opacity = '0';
                    el.style.visibility = 'hidden';
                    el.style.position = 'absolute';
                    el.style.left = '-9999px';
                    el.remove();
                });
            } catch(e) {}
        });
    };
    
    removeAll();
    
    var count = 0;
    var interval = setInterval(function() {
        removeAll();
        count++;
        if (count > 100) clearInterval(interval);
    }, 10);
})();
</script>

<script>
// 🚫 BLOQUER TOUTES LES ALERTES/TOASTS/POPUPS
(function(){
    var removeAlerts = function() {
        var alerts = document.querySelectorAll('.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"],.alert,.toast,.notification,.swal2-container,.swal-overlay,[class*="alert"],[class*="toast"],[class*="notification"],[class*="swal"],.error-alert,.success-alert,.warning-alert,.info-alert');
        alerts.forEach(function(el){
            el.style.display = 'none';
            el.style.opacity = '0';
            el.style.visibility = 'hidden';
            el.remove();
        });
    };
    
    removeAlerts();
    
    if(window.Swal) window.Swal = {fire: function(){}, close: function(){}};
    if(window.toastr) window.toastr = {success: function(){}, error: function(){}, warning: function(){}, info: function(){}};
    if(window.showToast) window.showToast = function(){};
    if(window.showAlert) window.showAlert = function(){};
    
    var observer = new MutationObserver(function(mutations) {
        removeAlerts();
    });
    
    if(document.body) {
        observer.observe(document.body, {childList: true, subtree: true});
    }
    
    setInterval(removeAlerts, 100);
})();
</script>

@include('includes.header')

<main class="main-signup" role="main" aria-labelledby="signup-title">
  
  <div class="container">
    
    <article class="signup-card">
      
      <div class="card-content">
        
        <header class="signup-header">
          
          <div class="brand-icon" aria-hidden="true">
            <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0110.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>

          <h1 id="signup-title" class="main-title">Let's Get Started! 🚀</h1>
          
          <p class="subtitle">Join thousands of expats worldwide ✨</p>
          
        </header>

        <a href="{{ route('google.signup') }}" 
           class="google-btn" 
           aria-label="Continue with Google">
          <svg class="google-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          <span>Sign up with Google</span>
        </a>

        <div class="divider" role="separator" aria-label="Or sign up with email">
          <span>Or use email</span>
        </div>

        @php 
          $affiliateCode = request()->query('code') ?? null;
        @endphp

        <form id="signupForm" 
              method="POST" 
              action="{{route('user.signupRegister')}}" 
              class="signup-form" 
              autocomplete="off"
              novalidate
              aria-label="Sign up form">
          @csrf

          <div class="form-group">
            <label for="name" class="form-label">
              <span>Full Name</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text"
                id="name"
                name="name" 
                class="form-input"
                placeholder="John Doe"
                value="{{ old('name') }}"
                required
                autocomplete="name" />
            </div>
            <div id="error-name" class="error-msg"></div>
          </div>

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
                autocomplete="email" />
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
                minlength="6"
                autocomplete="new-password" />
              <button type="button" 
                      class="toggle-password" 
                      data-target="password">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            
            <div class="password-requirements">
              <div class="requirement" data-req="length">
                <span class="req-icon">○</span>
                <span class="req-text">At least 6 characters</span>
              </div>
              <div class="requirement" data-req="uppercase">
                <span class="req-icon">○</span>
                <span class="req-text">One uppercase letter (A-Z)</span>
              </div>
              <div class="requirement" data-req="number">
                <span class="req-icon">○</span>
                <span class="req-text">One number (0-9)</span>
              </div>
            </div>
            
            <div id="error-password" class="error-msg"></div>
          </div>

          <fieldset class="form-group">
            <legend class="form-label">
              <span>Gender</span>
            </legend>
            <div class="gender-grid">
              
              <input type="radio" 
                     name="gender" 
                     id="male" 
                     value="Male" 
                     class="gender-radio" 
                     {{ old('gender') == 'Male' ? 'checked' : '' }}>
              <label for="male" class="gender-label">
                <span class="gender-emoji">🙋‍♂️</span>
                <span class="gender-text">Male</span>
                <span class="gender-check">✨</span>
              </label>

              <input type="radio" 
                     name="gender" 
                     id="female" 
                     value="Female" 
                     class="gender-radio" 
                     {{ old('gender') == 'Female' ? 'checked' : '' }}>
              <label for="female" class="gender-label">
                <span class="gender-emoji">🙋‍♀️</span>
                <span class="gender-text">Female</span>
                <span class="gender-check">✨</span>
              </label>

            </div>
            <div id="error-gender" class="error-msg"></div>
          </fieldset>

          @if($affiliateCode)
            <input type="hidden" name="affiliate_code" value="{{ $affiliateCode }}" />
          @endif

          <button type="submit" id="signupBtnSubmit" class="submit-btn">
            <span class="submit-text">Join the Adventure! 🎉</span>
          </button>

        </form>

        <footer class="card-footer">
          <p class="footer-text">
            <span class="already-text">Already have an account?</span>
            <a href="{{ route('login') }}" class="login-link">Welcome back! 👋</a>
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
          <span class="faq-icon" aria-hidden="true">💰</span>
          <span>Is Ulixai free to use?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">Yes! Ulixai is a community-driven platform. Create your account and start connecting with helpers worldwide. We believe in accessible help for everyone.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔒</span>
          <span>How secure is my data on Ulixai?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">Your security is our top priority. We use <strong>bank-level SSL encryption</strong>, secure OAuth authentication with Google, and follow strict GDPR compliance. We never share your personal information without explicit consent and all data is encrypted both in transit and at rest.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🚀</span>
          <span>Can I sign up with Google?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">Absolutely! <strong>Sign up instantly</strong> with your Google account for quick and secure access. Using Google OAuth means you don't need to remember another password, and your account is protected by Google's world-class security. You can also sign up with your email address if you prefer.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🤔</span>
          <span>How does Ulixai work?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>It's simple!</strong> Create your account, browse helpers in your area or worldwide, post what you need help with, connect with people who can assist, and build lasting connections. Whether you're seeking local guidance or offering your expertise, Ulixai makes it easy to help and be helped across borders.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌟</span>
          <span>What kind of help can I find on Ulixai?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Almost anything!</strong> From finding apartments and navigating visa processes to local recommendations, language practice, cultural guidance, professional networking, and travel tips. Our community helps with practical tasks, administrative procedures, social connections, and settling into new countries. If you need advice or assistance abroad, someone on Ulixai can help.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">✅</span>
          <span>Do I need to verify my identity?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Basic verification is quick and optional</strong>, but we highly recommend it to build trust in the community. Verified profiles get a special badge and are prioritized in search results. You can verify via email, phone number, or connect your Google account. This helps create a safer, more trustworthy environment for everyone.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌍</span>
          <span>Can I use Ulixai in any country?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes, absolutely!</strong> Ulixai is a global platform available in <strong>195+ countries</strong>. Whether you're in Tokyo, Paris, New York, Dubai, or Buenos Aires, you can connect with helpers and seekers worldwide. Our community spans every continent, making it easy to find assistance no matter where you are.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📍</span>
          <span>How do I find helpers in my area?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Super easy!</strong> After signing up, use our location-based search to find helpers near you. Filter by distance, expertise, language, availability, and ratings. You can also post your specific need, and nearby helpers will reach out to you. Our smart matching algorithm ensures you connect with the most relevant people in your area.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📱</span>
          <span>Is there a mobile app?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes!</strong> Ulixai is available on both <strong>iOS and Android</strong>. Download our app from the App Store or Google Play to access all features on the go. Get instant notifications when someone responds to your request, message helpers directly, and manage your profile anywhere. The mobile experience is fully optimized for speed and convenience.</p>
        </div>
      </details>

      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">💪</span>
          <span>How do I become a helper?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Anyone can be a helper!</strong> Simply create your account, complete your profile with your skills and areas of expertise, specify which types of help you can offer, set your availability, and start responding to requests in your area. Building a good reputation through positive reviews helps you help more people. It's rewarding and a great way to give back to the global community.</p>
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
    <p class="footer-copyright">&copy; {{ date('Y') }} Ulixai. All rights reserved.</p>
  </div>
</footer>

<style>
.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"],.alert,.toast,.notification,.swal2-container,.swal-overlay,[class*="alert"],[class*="toast"],[class*="notification"],[class*="swal"],.error-alert,.success-alert,.warning-alert,.info-alert,.preloader,.overlay,[class*="splash"],[class*="preload"]{
  display:none!important;
  opacity:0!important;
  visibility:hidden!important;
  pointer-events:none!important;
  position:absolute!important;
  left:-9999px!important;
}

*,*::before,*::after{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

html{
  scroll-behavior:smooth;
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

.main-signup{
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

.signup-card{
  background:#fff;
  border-radius:1rem;
  box-shadow:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);
  border:1px solid #e5e7eb;
}

.card-content{
  padding:1rem;
}

.signup-header{
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

.signup-form{
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

.form-input.input-success{
  border-color:#10b981;
  background:#f0fdf4;
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
  font-weight:500;
  margin-top:0.25rem;
  padding-left:0.25rem;
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

.password-requirements{
  margin-top:0.5rem;
  padding:0.5rem;
  background:#f9fafb;
  border-radius:0.375rem;
  border:1px solid #e5e7eb;
}

.requirement{
  display:flex;
  align-items:center;
  gap:0.375rem;
  font-size:11px;
  margin:0.25rem 0;
  color:#6b7280;
  transition:color 0.2s ease;
}

.requirement.met{
  color:#10b981;
}

.req-icon{
  font-size:0.875rem;
  font-weight:700;
  transition:all 0.2s ease;
}

.requirement.met .req-icon::before{
  content:'✓';
}

.req-text{
  font-weight:500;
}

.gender-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:0.625rem;
}

.gender-radio{
  position:absolute;
  opacity:0;
  pointer-events:none;
}

.gender-label{
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  gap:0.375rem;
  padding:0.75rem 0.5rem;
  border:2px solid #d1d5db;
  border-radius:0.5rem;
  background:#f9fafb;
  cursor:pointer;
  transition:all 0.2s ease;
  position:relative;
}

.gender-label:hover{
  border-color:#06b6d4;
  transform:translateY(-1px);
  box-shadow:0 2px 8px rgba(6,182,212,0.15);
}

.gender-radio:checked+.gender-label{
  border-color:#06b6d4;
  background:linear-gradient(135deg,#ecfeff,#f0fdfa);
  box-shadow:0 4px 12px rgba(6,182,212,0.2);
}

.gender-emoji{
  font-size:1.5rem;
}

.gender-text{
  font-size:12px;
  font-weight:700;
  color:#374151;
}

.gender-check{
  position:absolute;
  top:0.25rem;
  right:0.25rem;
  font-size:0.75rem;
  opacity:0;
  transition:opacity 0.2s ease;
}

.gender-radio:checked+.gender-label .gender-check{
  opacity:1;
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

.login-link{
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

.login-link:hover{
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
  
  .main-signup{
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
  
  const form = document.getElementById('signupForm');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const genderInputs = document.querySelectorAll('input[name="gender"]');
  
  const nameError = document.getElementById('error-name');
  const emailError = document.getElementById('error-email');
  const passwordError = document.getElementById('error-password');
  const genderError = document.getElementById('error-gender');
  
  const validationState = {
    name: false,
    email: false,
    password: false,
    gender: {{ old('gender') ? 'true' : 'false' }}
  };
  
  function showError(input, errorEl, message) {
    input.classList.add('input-error');
    input.classList.remove('input-success');
    errorEl.textContent = message;
    errorEl.classList.add('show');
  }
  
  function showSuccess(input) {
    input.classList.remove('input-error');
    input.classList.add('input-success');
  }
  
  function clearError(input, errorEl) {
    input.classList.remove('input-error');
    input.classList.remove('input-success');
    errorEl.textContent = '';
    errorEl.classList.remove('show');
  }
  
  function clearAllErrors() {
    clearError(nameInput, nameError);
    clearError(emailInput, emailError);
    clearError(passwordInput, passwordError);
    genderError.textContent = '';
    genderError.classList.remove('show');
  }
  
  function parseErrorMessage(message) {
    const lowerMsg = message.toLowerCase();
    
    if (lowerMsg.includes('already') && (lowerMsg.includes('email') || lowerMsg.includes('user') || lowerMsg.includes('exists') || lowerMsg.includes('registered'))) {
      return {
        field: 'email',
        message: '😅 This email is already registered! Try logging in instead? 👉',
        showLoginLink: true
      };
    }
    
    if (lowerMsg.includes('email') && (lowerMsg.includes('valid') || lowerMsg.includes('invalid') || lowerMsg.includes('format'))) {
      return {
        field: 'email',
        message: '📧 Hmm, that doesn\'t look like a valid email address'
      };
    }
    
    if (lowerMsg.includes('password')) {
      if (lowerMsg.includes('uppercase') || lowerMsg.includes('capital')) {
        return {
          field: 'password',
          message: '🔤 Add at least one uppercase letter (A-Z)'
        };
      }
      if (lowerMsg.includes('number') || lowerMsg.includes('digit')) {
        return {
          field: 'password',
          message: '🔢 Add at least one number (0-9)'
        };
      }
      if (lowerMsg.includes('6') || lowerMsg.includes('character') || lowerMsg.includes('long')) {
        return {
          field: 'password',
          message: '⚠️ Password must be at least 6 characters long'
        };
      }
      return {
        field: 'password',
        message: '🔐 Password doesn\'t meet the requirements'
      };
    }
    
    if (lowerMsg.includes('name')) {
      return {
        field: 'name',
        message: '👋 Please enter your full name (at least 2 characters)'
      };
    }
    
    if (lowerMsg.includes('gender')) {
      return {
        field: 'gender',
        message: '🙋 Please select your gender'
      };
    }
    
    return {
      field: 'email',
      message: message.length > 100 ? '😅 Something went wrong. Please check your email and try again.' : message
    };
  }
  
  function validateName() {
    const value = nameInput.value.trim();
    
    if (!value) {
      validationState.name = false;
      clearError(nameInput, nameError);
      return false;
    }
    
    if (value.length < 2) {
      validationState.name = false;
      showError(nameInput, nameError, '🤔 Please enter your full name (at least 2 characters)');
      return false;
    }
    
    validationState.name = true;
    showSuccess(nameInput);
    clearError(nameInput, nameError);
    return true;
  }
  
  function validateEmail() {
    const value = emailInput.value.trim();
    
    if (!value) {
      validationState.email = false;
      clearError(emailInput, emailError);
      return false;
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(value)) {
      validationState.email = false;
      showError(emailInput, emailError, '😅 Hmm, that doesn\'t look like a valid email address');
      return false;
    }
    
    validationState.email = true;
    showSuccess(emailInput);
    clearError(emailInput, emailError);
    return true;
  }
  
  function updatePasswordRequirements(password) {
    const requirements = {
      length: password.length >= 6,
      uppercase: /[A-Z]/.test(password),
      number: /[0-9]/.test(password)
    };
    
    Object.keys(requirements).forEach(req => {
      const reqEl = document.querySelector(`[data-req="${req}"]`);
      if (reqEl) {
        if (requirements[req]) {
          reqEl.classList.add('met');
          reqEl.querySelector('.req-icon').textContent = '✓';
        } else {
          reqEl.classList.remove('met');
          reqEl.querySelector('.req-icon').textContent = '○';
        }
      }
    });
    
    return requirements;
  }
  
  function validatePassword() {
    const value = passwordInput.value;
    
    if (!value) {
      validationState.password = false;
      clearError(passwordInput, passwordError);
      updatePasswordRequirements('');
      return false;
    }
    
    const requirements = updatePasswordRequirements(value);
    
    if (!requirements.length) {
      validationState.password = false;
      showError(passwordInput, passwordError, '⚠️ Password must be at least 6 characters long');
      return false;
    }
    
    if (!requirements.uppercase) {
      validationState.password = false;
      showError(passwordInput, passwordError, '🔤 Add at least one uppercase letter (A-Z)');
      return false;
    }
    
    if (!requirements.number) {
      validationState.password = false;
      showError(passwordInput, passwordError, '🔢 Add at least one number (0-9)');
      return false;
    }
    
    validationState.password = true;
    showSuccess(passwordInput);
    clearError(passwordInput, passwordError);
    return true;
  }
  
  function validateGender() {
    const checked = Array.from(genderInputs).some(r => r.checked);
    validationState.gender = checked;
    
    if (checked) {
      genderError.textContent = '';
      genderError.classList.remove('show');
    }
    
    return checked;
  }
  
  nameInput.addEventListener('input', validateName);
  nameInput.addEventListener('blur', validateName);
  
  emailInput.addEventListener('input', validateEmail);
  emailInput.addEventListener('blur', validateEmail);
  
  passwordInput.addEventListener('input', validatePassword);
  passwordInput.addEventListener('blur', validatePassword);
  
  genderInputs.forEach(input => {
    input.addEventListener('change', validateGender);
  });
  
  document.addEventListener('click', function(e){
    const toggle = e.target.closest('.toggle-password');
    if (!toggle) return;
    
    const targetId = toggle.dataset.target;
    const input = document.getElementById(targetId);
    const icon = toggle.querySelector('.eye-icon');
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = '🙈';
    } else {
      input.type = 'password';
      icon.textContent = '👁️';
    }
  });
  
  form.addEventListener('submit', function(e){
    e.preventDefault();
    
    clearAllErrors();
    
    const nameValid = validateName();
    const emailValid = validateEmail();
    const passwordValid = validatePassword();
    const genderValid = validateGender();
    
    if (!nameValid) {
      if (!nameInput.value.trim()) {
        showError(nameInput, nameError, '👋 Hey! We need your name to get started');
      }
      nameInput.focus();
      return;
    }
    
    if (!emailValid) {
      if (!emailInput.value.trim()) {
        showError(emailInput, emailError, '📧 We need your email to create your account');
      }
      emailInput.focus();
      return;
    }
    
    if (!passwordValid) {
      if (!passwordInput.value) {
        showError(passwordInput, passwordError, '🔑 Create a secure password to protect your account');
      }
      passwordInput.focus();
      return;
    }
    
    if (!genderValid) {
      genderError.textContent = '🙋 Please select your gender';
      genderError.classList.add('show');
      return;
    }
    
    form.submit();
  });
  
  @if($errors->any() || session('error'))
    setTimeout(() => {
      @if($errors->has('name'))
        showError(nameInput, nameError, "{{ $errors->first('name') }}");
        nameInput.focus();
        validationState.name = false;
      @endif
      
      @if($errors->has('email'))
        var emailErrorMsg = "{{ $errors->first('email') }}";
        var parsedError = parseErrorMessage(emailErrorMsg);
        showError(emailInput, emailError, parsedError.message);
        
        if (parsedError.showLoginLink) {
          var loginLink = document.createElement('a');
          loginLink.href = "{{ route('login') }}";
          loginLink.textContent = ' Login here';
          loginLink.style.color = '#06b6d4';
          loginLink.style.fontWeight = '700';
          loginLink.style.textDecoration = 'underline';
          emailError.appendChild(loginLink);
        }
        
        if (!{{ $errors->has('name') ? 'true' : 'false' }}) emailInput.focus();
        validationState.email = false;
      @endif
      
      @if($errors->has('password'))
        showError(passwordInput, passwordError, "{{ $errors->first('password') }}");
        if (!{{ $errors->has('name') || $errors->has('email') ? 'true' : 'false' }}) passwordInput.focus();
        validationState.password = false;
        updatePasswordRequirements(passwordInput.value);
      @endif
      
      @if($errors->has('gender'))
        genderError.textContent = "{{ $errors->first('gender') }}";
        genderError.classList.add('show');
        validationState.gender = false;
      @endif
      
      @if(session('error') && !$errors->any())
        var generalError = "{{ session('error') }}";
        var parsedError = parseErrorMessage(generalError);
        
        if (parsedError.field === 'email') {
          showError(emailInput, emailError, parsedError.message);
          
          if (parsedError.showLoginLink) {
            var loginLink = document.createElement('a');
            loginLink.href = "{{ route('login') }}";
            loginLink.textContent = ' Login here';
            loginLink.style.color = '#06b6d4';
            loginLink.style.fontWeight = '700';
            loginLink.style.textDecoration = 'underline';
            emailError.appendChild(loginLink);
          }
          
          emailInput.focus();
          validationState.email = false;
        } else if (parsedError.field === 'password') {
          showError(passwordInput, passwordError, parsedError.message);
          passwordInput.focus();
          validationState.password = false;
        } else if (parsedError.field === 'name') {
          showError(nameInput, nameError, parsedError.message);
          nameInput.focus();
          validationState.name = false;
        } else if (parsedError.field === 'gender') {
          genderError.textContent = parsedError.message;
          genderError.classList.add('show');
          validationState.gender = false;
        }
      @endif
    }, 100);
  @endif
  
})();
</script>

@include('includes.footer')

</body>
</html>