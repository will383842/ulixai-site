<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="en">
    
    <!-- Critical CSS - Loaded immediately to prevent FOUC -->
    <style>
        /* Hide loaders and prevent flash */
        .page-loader,.loader,.splash-screen,[class*="loader"]{display:none!important;opacity:0!important;visibility:hidden!important}
        body{margin:0;padding:0;background:#f8fafc;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;opacity:0;animation:fadeInBody 0.2s ease-in forwards}
        @keyframes fadeInBody{to{opacity:1}}
        .main-signup{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding-top:10px}
    </style>
    
    <!-- SEO Meta Tags -->
    <title>Create Account - Join Ulixai Global Community</title>
    <meta name="description" content="Create your Ulixai account in seconds. Join thousands of global helpers connecting across borders. Sign up with email or Google.">
    <meta name="keywords" content="Ulixai signup, create account, global help network, registration, community signup, expat help, international support">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Join Ulixai - Global Help Network">
    <meta property="og:description" content="Create your account and connect with helpers worldwide. Fast and secure signup.">
    <meta property="og:image" content="{{ asset('images/og-signup.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Join Ulixai - Global Help Network">
    <meta name="twitter:description" content="Create your account and connect with helpers worldwide. Fast and secure signup.">
    <meta name="twitter:image" content="{{ asset('images/og-signup.jpg') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- Performance: Using system fonts for instant load -->
    <!-- JSON-LD Schema for SEO -->
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

<!-- Immediate loader removal script -->
<script>
(function(){
  const loaders=document.querySelectorAll('.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"]');
  loaders.forEach(function(el){el.remove()});
})();
</script>

@include('includes.header')

<!-- ============================================
     🎯 ULIXAI SIGNUP - MOBILE-FIRST & OPTIMIZED
     ============================================ -->

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
                class="form-input @error('name') input-error @enderror"
                placeholder="John Doe"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                aria-required="true"
                aria-invalid="@error('name')true @else false @enderror"
                aria-describedby="error-name" />
            </div>
            @error('name')
              <p id="error-name" class="error-msg" role="alert">{{ $message }}</p>
            @enderror
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
                class="form-input @error('email') input-error @enderror"
                placeholder="you@example.com"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                aria-required="true"
                aria-invalid="@error('email')true @else false @enderror"
                aria-describedby="error-email" />
            </div>
            @error('email')
              <p id="error-email" class="error-msg" role="alert">{{ $message }}</p>
            @enderror
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
                class="form-input @error('password') input-error @enderror"
                placeholder="••••••••"
                required
                minlength="6"
                autocomplete="new-password"
                aria-required="true"
                aria-invalid="@error('password')true @else false @enderror"
                aria-describedby="error-password" />
              <button type="button" 
                      class="toggle-password" 
                      data-target="password"
                      aria-label="Toggle password visibility">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            @error('password')
              <p id="error-password" class="error-msg" role="alert">{{ $message }}</p>
            @enderror
          </div>

          <fieldset class="form-group">
            <legend class="form-label">
              <span>Gender</span>
            </legend>
            <div class="gender-grid" role="radiogroup" aria-label="Select gender">
              
              <input type="radio" 
                     name="gender" 
                     id="male" 
                     value="Male" 
                     class="gender-radio" 
                     {{ old('gender') == 'Male' ? 'checked' : '' }}
                     required
                     aria-required="true">
              <label for="male" class="gender-label">
                <span class="gender-emoji" aria-hidden="true">🙋‍♂️</span>
                <span class="gender-text">Male</span>
                <span class="gender-check" aria-hidden="true">✨</span>
              </label>

              <input type="radio" 
                     name="gender" 
                     id="female" 
                     value="Female" 
                     class="gender-radio" 
                     {{ old('gender') == 'Female' ? 'checked' : '' }}
                     required
                     aria-required="true">
              <label for="female" class="gender-label">
                <span class="gender-emoji" aria-hidden="true">🙋‍♀️</span>
                <span class="gender-text">Female</span>
                <span class="gender-check" aria-hidden="true">✨</span>
              </label>

            </div>
            @error('gender')
              <p id="error-gender" class="error-msg" role="alert">{{ $message }}</p>
            @enderror
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

<!-- Fun Error/Success Popup Modal -->
<div id="funModal" class="fun-modal" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalMessage">
  <div class="modal-overlay" onclick="closeFunModal()"></div>
  <div class="modal-content">
    <button type="button" class="modal-close" onclick="closeFunModal()" aria-label="Close">✕</button>
    <div class="modal-icon" id="modalIcon">😅</div>
    <h3 class="modal-title" id="modalTitle">Oops!</h3>
    <p class="modal-message" id="modalMessage">Something went wrong</p>
    <button type="button" class="modal-btn" onclick="closeFunModal()">Got it! 👍</button>
  </div>
</div>

@if(session('success') || session('error') || $errors->any())
<script>
document.addEventListener('DOMContentLoaded', function(){
    @if(session('success'))
        showFunModal('🎉', 'Success!', "{{ session('success') }}", 'success');
    @elseif(session('error'))
        showFunModal('😅', 'Oops!', "{{ session('error') }}", 'error');
    @elseif($errors->has('email'))
        showFunModal('😅', 'Oops!', "{{ $errors->first('email') }}", 'error');
    @elseif($errors->has('name'))
        showFunModal('😅', 'Oops!', "{{ $errors->first('name') }}", 'error');
    @elseif($errors->has('password'))
        showFunModal('😅', 'Oops!', "{{ $errors->first('password') }}", 'error');
    @elseif($errors->has('gender'))
        showFunModal('😅', 'Oops!', "{{ $errors->first('gender') }}", 'error');
    @elseif($errors->any())
        showFunModal('😅', 'Oops!', "{{ $errors->first() }}", 'error');
    @endif
});
</script>
@endif

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
/* ============================================
   CSS - MOBILE-FIRST & ULTRA-OPTIMIZED
   ============================================ */

/* Force hide all loaders globally */
.page-loader,.loader,.splash-screen,.loading-screen,[class*="loader"],[class*="loading"]{
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

/* Main Signup Container */
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

/* Card */
.signup-card{
  background:#fff;
  border-radius:1rem;
  box-shadow:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);
  border:1px solid #e5e7eb;
}

.card-content{
  padding:1rem;
}

/* Header */
.signup-header{
  text-align:center;
  margin-bottom:0.75rem;
}

/* Brand Icon */
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

/* Title */
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

/* Subtitle */
.subtitle{
  font-size:clamp(11px, 2vw, 13px);
  color:#6b7280;
  font-weight:500;
  margin-bottom:0;
}

/* Google Button - IMPROVED */
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

/* Divider */
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

/* Form */
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

.input-error{
  border-color:#ef4444!important;
  background:#fef2f2!important;
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
  color:#ef4444;
  font-size:12px;
  font-weight:600;
  margin-top:0.25rem;
}

/* Gender Selection */
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

/* Submit Button */
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

/* Footer */
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

/* FAQ Section */
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

/* Footer Links */
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

/* Fun Modal Popup */
.fun-modal{
  position:fixed;
  top:0;
  left:0;
  right:0;
  bottom:0;
  z-index:9999;
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  visibility:hidden;
  transition:all 0.3s ease;
  padding:1rem;
}

.fun-modal.show{
  opacity:1;
  visibility:visible;
}

.modal-overlay{
  position:absolute;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background:rgba(0,0,0,0.5);
  backdrop-filter:blur(4px);
  animation:fadeIn 0.3s ease;
}

.modal-content{
  position:relative;
  background:#fff;
  border-radius:1.5rem;
  padding:2rem 1.5rem;
  max-width:24rem;
  width:100%;
  text-align:center;
  box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);
  transform:scale(0.9);
  animation:popIn 0.3s ease forwards;
  z-index:1;
}

@keyframes fadeIn{
  from{opacity:0}
  to{opacity:1}
}

@keyframes popIn{
  0%{transform:scale(0.8);opacity:0}
  50%{transform:scale(1.05)}
  100%{transform:scale(1);opacity:1}
}

.modal-close{
  position:absolute;
  top:0.75rem;
  right:0.75rem;
  background:transparent;
  border:none;
  font-size:1.5rem;
  color:#9ca3af;
  cursor:pointer;
  width:2rem;
  height:2rem;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  transition:all 0.2s ease;
}

.modal-close:hover{
  background:#f3f4f6;
  color:#374151;
  transform:rotate(90deg);
}

.modal-icon{
  font-size:4rem;
  margin-bottom:1rem;
  animation:bounce 0.6s ease;
}

@keyframes bounce{
  0%,100%{transform:scale(1)}
  50%{transform:scale(1.1)}
}

.modal-title{
  font-size:1.5rem;
  font-weight:800;
  color:#1f2937;
  margin-bottom:0.5rem;
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.modal-message{
  font-size:1rem;
  color:#6b7280;
  line-height:1.6;
  margin-bottom:1.5rem;
}

.modal-btn{
  background:linear-gradient(135deg,#06b6d4,#8b5cf6);
  color:#fff;
  border:none;
  padding:0.75rem 2rem;
  border-radius:9999px;
  font-size:1rem;
  font-weight:700;
  cursor:pointer;
  transition:all 0.2s ease;
  box-shadow:0 4px 14px rgba(6,182,212,0.3);
  font-family:inherit;
}

.modal-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 6px 20px rgba(6,182,212,0.4);
}

.modal-btn:active{
  transform:translateY(0);
}

/* Tablet */
@media (min-width:640px){
  .card-content{
    padding:1.25rem;
  }
  
  .main-signup{
    padding:1rem;
    padding-top:40px;
  }
}

/* Desktop */
@media (min-width:1024px){
  .container{
    max-width:28rem;
  }
  
  .card-content{
    padding:1.5rem;
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
</style>

<!-- JavaScript - Optimized -->
<script>
(function(){
  'use strict';
  
  const form = document.getElementById('signupForm');
  
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
  
  // Real-time validation - remove errors on input
  const inputs=form.querySelectorAll('input[type="text"],input[type="email"],input[type="password"]');
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
    let valid=true;
    const name=form.elements.name.value.trim();
    const email=form.elements.email.value.trim();
    const password=form.elements.password.value;
    let gender='';
    
    // Get gender value
    if(form.elements.gender.length){
      for(const radio of form.elements.gender){
        if(radio.checked)gender=radio.value;
      }
    }else{
      gender=form.elements.gender.value;
    }
    
    // Clear previous errors
    inputs.forEach(function(input){
      input.classList.remove('input-error');
    });
    
    // Validate name
    if(!name){
      form.elements.name.classList.add('input-error');
      showFunModal('👤', 'Hey there!', 'We need your full name to create your account! 😊', 'error');
      valid=false;
    }
    
    // Validate email
    if(!email && valid){
      form.elements.email.classList.add('input-error');
      showFunModal('📧', 'Hold on!', 'We need your email address! ✉️', 'error');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email) && valid){
      form.elements.email.classList.add('input-error');
      showFunModal('🤔', 'Hmm...', 'That doesn\'t look like a valid email address! 📧', 'error');
      valid=false;
    }
    
    // Validate password
    if(!password && valid){
      form.elements.password.classList.add('input-error');
      showFunModal('🔐', 'Almost there!', 'Don\'t forget to create a password! 🔑', 'error');
      valid=false;
    }else if(password.length<6 && valid){
      form.elements.password.classList.add('input-error');
      showFunModal('🚀', 'Make it stronger!', 'Your password needs at least 6 characters! 💪', 'error');
      valid=false;
    }
    
    // Validate gender
    if(!gender && valid){
      showFunModal('🎭', 'One more thing!', 'Please select your gender! 😊', 'error');
      valid=false;
    }
    
    if(!valid){
      e.preventDefault();
      return false;
    }
  });
})();

// Fun Modal Functions
function showFunModal(icon, title, message, type) {
  const modal = document.getElementById('funModal');
  const modalIcon = document.getElementById('modalIcon');
  const modalTitle = document.getElementById('modalTitle');
  const modalMessage = document.getElementById('modalMessage');
  
  modalIcon.textContent = icon;
  modalTitle.textContent = title;
  modalMessage.textContent = message;
  
  modal.classList.add('show');
  
  // Close on Escape key
  document.addEventListener('keydown', function escHandler(e) {
    if (e.key === 'Escape') {
      closeFunModal();
      document.removeEventListener('keydown', escHandler);
    }
  });
}

function closeFunModal() {
  const modal = document.getElementById('funModal');
  modal.classList.remove('show');
}
</script>

@include('includes.footer')

</body>
</html>