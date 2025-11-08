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
        .main-signup{min-height:100vh;display:flex;align-items:center;justify-content:center}
        
        .page-loader.hidden{opacity:0;pointer-events:none}
        
        
        50%{transform:translateY(-10px)}}
        
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

<!-- Page Loader -->
<p class="loader-text">Loading Ulixai...</p>
    </div>
</div>

@include('includes.header')

<main class="main-signup" role="main" aria-labelledby="signup-title">
  
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <div class="container">
    
    <article class="signup-card">
      
      <div class="card-border" aria-hidden="true"></div>
      
      <div class="card-content">
        
        <header class="signup-header">
          
          <div class="brand-icon" aria-hidden="true">
            <div class="icon-container">
              <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0110.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>

          <h1 id="signup-title" class="main-title">
            <span class="title-text">Let's Get Started!</span>
            <span class="title-emoji" aria-hidden="true">🚀</span>
          </h1>
          
          <p class="subtitle">Join thousands of expats and travelers worldwide ✨🌍</p>
          
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
          <span class="rocket" aria-hidden="true">⚡</span>
        </a>

        <div class="divider" role="separator" aria-label="Or sign up with email">
          <span>Or use your email 💌</span>
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
              <span aria-hidden="true">👤</span>
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
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            @error('name')
              <p id="error-name" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @else
              <p id="error-name" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @enderror
          </div>

          <div class="form-group">
            <label for="email" class="form-label">
              <span aria-hidden="true">✉️</span>
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
                minlength="6"
                autocomplete="new-password"
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
          </div>

          <fieldset class="form-group">
            <legend class="form-label">
              <span aria-hidden="true">🎭</span>
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
              <p id="error-gender" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @else
              <p id="error-gender" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @enderror
          </fieldset>

          @if($affiliateCode)
            <input type="hidden" name="affiliate_code" value="{{ $affiliateCode }}" />
          @endif

          <button type="submit" id="signupBtnSubmit" class="submit-btn">
            <span class="submit-bg" aria-hidden="true"></span>
            <span class="submit-text">
              <span class="submit-label">Join the Adventure! 🎉</span>
              <span class="submit-emoji" aria-hidden="true">✨</span>
            </span>
          </button>

          @if(session('success'))
            <div class="alert alert-success" role="alert" aria-live="polite" aria-atomic="true">
              ✅ {{ session('success') }}
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-error" role="alert" aria-live="assertive" aria-atomic="true">
              ⚠️ {{ session('error') }}
            </div>
          @endif

        </form>

        <footer class="card-footer">
          <p class="footer-text">
            <span class="already-text">Already part of the family? 🎊</span>
            <a href="{{ route('login') }}" class="login-link-fun">
              <span>Welcome back!</span>
              <span aria-hidden="true">👋✨</span>
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
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;font-size:14px}
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border-width:0}
.main-signup{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:0.5rem;position:relative;overflow:hidden;background:linear-gradient(135deg,#eff6ff 0%,#ecfeff 50%,#f0fdfa 100%)}
.bg-layer{position:absolute;inset:0;overflow:hidden;pointer-events:none}
.blob{position:absolute;border-radius:50%;mix-blend-mode:multiply;filter:blur(60px);opacity:0;will-change:transform;transform:translateZ(0)}
.blob-1{width:24rem;height:24rem;background:#3b82f6;top:5rem;left:2.5rem;animation:fade-in 0.8s ease-out forwards,float-1 12s ease-in-out infinite;animation-delay:0.3s}
.blob-2{width:20rem;height:20rem;background:#06b6d4;top:10rem;right:5rem;animation:fade-in 0.8s ease-out forwards,float-2 15s ease-in-out infinite;animation-delay:0.5s}
.blob-3{width:18rem;height:18rem;background:#14b8a6;bottom:8rem;left:50%;animation:fade-in 0.8s ease-out forwards,float-3 18s ease-in-out infinite;animation-delay:0.7s}
@keyframes fade-in{0%{opacity:0}100%{opacity:0.4}}
@keyframes float-1{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(2rem,-2rem) scale(1.1)}66%{transform:translate(-1rem,1rem) scale(0.9)}}
@keyframes float-2{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(-2rem,2rem) scale(0.9)}66%{transform:translate(2rem,-1rem) scale(1.1)}}
@keyframes float-3{0%,100%{transform:translate(-50%,0) scale(1)}50%{transform:translate(-50%,-2rem) scale(1.05)}}
.container{width:100%;max-width:28rem;margin:0 auto;position:relative;z-index:1}
.signup-card{position:relative;background:#fff;border-radius:1.5rem;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden}
.card-border{position:absolute;inset:-2px;background:linear-gradient(135deg,#06b6d4,#8b5cf6,#ec4899);border-radius:1.5rem;z-index:-1;opacity:0;transition:opacity 0.3s ease}
.signup-card:hover .card-border{opacity:0.7}
.card-content{padding:1rem 1.25rem;position:relative;background:#fff;border-radius:1.5rem}
.signup-header{text-align:center;margin-bottom:0.875rem}
.brand-icon{display:inline-flex;align-items:center;justify-content:center;width:2.25rem;height:2.25rem;margin:0 auto 0.5rem;position:relative}
.icon-container{width:2.25rem;height:2.25rem;background:linear-gradient(135deg,#06b6d4,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 25px rgba(6,182,212,0.3)}
.icon-svg{width:1.125rem;height:1.125rem;color:#fff}
.main-title{font-size:clamp(24px,6vw,40px);font-weight:800;background:linear-gradient(135deg,#06b6d4,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:0.25rem;letter-spacing:-0.025em}
.title-text{display:inline-block}
.title-emoji{display:inline-block;margin-left:0.3rem;font-size:clamp(20px,5vw,32px)}
.subtitle{font-size:clamp(13px,2vw,16px);color:#6b7280;font-weight:500;margin-bottom:0.75rem}
.google-btn{display:flex;align-items:center;justify-content:center;gap:0.75rem;width:100%;padding:0.625rem 1rem;background:#fff;border:2px solid #e5e7eb;border-radius:0.75rem;font-size:13px;font-weight:600;color:#1f2937;text-decoration:none;transition:all 0.3s ease;box-shadow:0 1px 3px rgba(0,0,0,0.1);margin-bottom:0.75rem;cursor:pointer}
.google-btn:hover{border-color:#06b6d4;box-shadow:0 10px 25px rgba(6,182,212,0.2);transform:translateY(-2px)}
.google-icon{width:1rem;height:1rem;flex-shrink:0}
.rocket{font-size:0.875rem}
.divider{position:relative;text-align:center;margin:0.75rem 0}
.divider::before{content:'';position:absolute;top:50%;left:0;right:0;height:2px;background:#e5e7eb;border-style:dashed}
.divider span{position:relative;display:inline-block;padding:0 1rem;background:rgba(255,255,255,0.95);font-size:13px;font-weight:600;color:#6b7280}
.signup-form{display:flex;flex-direction:column;gap:0.75rem}
.form-group{border:0;padding:0;margin:0}
.form-label{display:flex;align-items:center;gap:0.5rem;font-size:12px;font-weight:700;color:#374151;margin-bottom:0.25rem}
.input-wrapper{position:relative}
.form-input{width:100%;padding:0.625rem 0.875rem;background:#f3f4f6;border:2px solid #d1d5db;border-radius:0.75rem;font-weight:600;font-size:14px;color:#111827;transition:all 0.3s ease;font-family:inherit}
.form-input::placeholder{color:#9ca3af;font-weight:500;font-size:13px}
.form-input:focus{outline:none;border-color:#06b6d4;background:#fff;box-shadow:0 0 0 3px rgba(6,182,212,0.1)}
.input-error{border-color:#ef4444!important;background:#fef2f2!important}
.input-glow{position:absolute;inset:0;border-radius:0.75rem;opacity:0;background:linear-gradient(135deg,#06b6d4,#8b5cf6);filter:blur(20px);transition:opacity 0.3s ease;pointer-events:none;z-index:-1}
.form-input:focus+.input-glow{opacity:0.3}
.toggle-password{position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;font-size:1.1rem;padding:0.4rem;transition:transform 0.3s ease}
.toggle-password:hover{transform:translateY(-50%) scale(1.1)}
.error-msg{color:#ef4444;font-size:12px;font-weight:700;margin-top:0.25rem;min-height:1rem}
.gender-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.gender-radio{position:absolute;opacity:0;pointer-events:none}
.gender-label{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5rem;padding:1rem 0.625rem;border:2px solid #d1d5db;border-radius:0.75rem;background:#f9fafb;cursor:pointer;transition:all 0.3s ease;position:relative;overflow:hidden}
.gender-label::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,#06b6d4,#8b5cf6);opacity:0;transition:opacity 0.3s ease}
.gender-label:hover{border-color:#06b6d4;transform:translateY(-2px);box-shadow:0 4px 12px rgba(6,182,212,0.2)}
.gender-radio:checked+.gender-label{border-color:#06b6d4;background:linear-gradient(135deg,#ecfeff,#f0fdfa);box-shadow:0 8px 20px rgba(6,182,212,0.3)}
.gender-radio:checked+.gender-label::before{opacity:0.1}
.gender-emoji{font-size:1.75rem;position:relative;z-index:1}
.gender-text{font-size:12px;font-weight:700;color:#374151;position:relative;z-index:1}
.gender-check{position:absolute;top:0.4rem;right:0.4rem;font-size:0.875rem;opacity:0;transition:opacity 0.3s ease}
.gender-radio:checked+.gender-label .gender-check{opacity:1}
.submit-btn{position:relative;width:100%;padding:0.7rem 1rem;margin-top:0.125rem;background:linear-gradient(135deg,#06b6d4,#8b5cf6);border:none;border-radius:0.75rem;font-size:14px;font-weight:700;color:#fff;cursor:pointer;overflow:hidden;transition:all 0.3s ease;box-shadow:0 8px 25px -8px rgba(6,182,212,0.4);font-family:inherit}
.submit-btn:hover{transform:translateY(-2px);box-shadow:0 12px 35px -8px rgba(6,182,212,0.5)}
.submit-btn:active{transform:translateY(0)}
.submit-bg{position:absolute;inset:0;background:linear-gradient(135deg,#0891b2,#7c3aed);opacity:0;transition:opacity 0.3s ease}
.submit-btn:hover .submit-bg{opacity:1}
.submit-text{position:relative;display:flex;align-items:center;justify-content:center;gap:0.4rem}
.alert{padding:1rem 1.25rem;border-radius:0.75rem;font-size:12px;font-weight:700;margin-top:1rem;display:flex;align-items:center;gap:0.5rem}
.alert-success{background:linear-gradient(135deg,#d1fae5,#a7f3d0);color:#065f46;border:2px solid #10b981}
.alert-error{background:linear-gradient(135deg,#fee2e2,#fecaca);color:#991b1b;border:2px solid #ef4444}
.card-footer{margin-top:0.875rem;padding-top:0.875rem;border-top:2px dashed #d1d5db}
.footer-text{display:flex;flex-direction:column;gap:0.375rem;align-items:center;text-align:center}
.already-text{font-size:12px;color:#6b7280;font-weight:600}
.login-link-fun{display:inline-flex;align-items:center;gap:0.3rem;padding:0.5rem 1rem;background:linear-gradient(135deg,#06b6d4,#8b5cf6);color:#fff;font-weight:700;font-size:12px;border-radius:9999px;text-decoration:none;transition:all 0.3s ease;box-shadow:0 4px 15px rgba(6,182,212,0.3);animation:pulse-glow 2s ease-in-out infinite}
.login-link-fun:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(6,182,212,0.5);background:linear-gradient(135deg,#0891b2,#7c3aed)}
@keyframes pulse-glow{0%,100%{box-shadow:0 4px 15px rgba(6,182,212,0.3)}50%{box-shadow:0 4px 25px rgba(139,92,246,0.5)}}
.faq-section{padding:3rem 1rem;background:#fff}
.faq-title{font-size:clamp(32px,7vw,56px);font-weight:900;text-align:center;margin-bottom:2rem;background:linear-gradient(135deg,#2563eb,#06b6d4,#14b8a6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.faq-list{display:flex;flex-direction:column;gap:0.875rem;max-width:48rem;margin:0 auto}
.faq-item{background:#fff;border:2px solid #e5e7eb;border-radius:0.75rem;overflow:hidden;transition:all 0.3s ease}
.faq-item:hover{border-color:#06b6d4;box-shadow:0 4px 20px -4px rgba(6,182,212,0.2)}
.faq-item[open]{border-color:#06b6d4;box-shadow:0 8px 30px -8px rgba(6,182,212,0.3)}
.faq-question{display:flex;align-items:center;gap:0.875rem;padding:1rem 1.25rem;cursor:pointer;list-style:none;font-size:14px;font-weight:700;color:#1f2937;background:linear-gradient(135deg,#f9fafb,#fff);transition:all 0.3s ease}
.faq-question::-webkit-details-marker{display:none}
.faq-question:hover{background:linear-gradient(135deg,#ecfeff,#f0fdfa);color:#06b6d4}
.faq-icon{font-size:1.25rem;flex-shrink:0}
.faq-question span:nth-child(2){flex:1}
.faq-toggle{font-size:1.25rem;font-weight:900;color:#06b6d4;transition:transform 0.3s ease;flex-shrink:0}
.faq-item[open] .faq-toggle{transform:rotate(45deg)}
.faq-answer{padding:0 1.25rem 1rem 3rem}
.faq-answer p{line-height:1.6;color:#4b5563;font-size:14px}
.footer-links{padding:1.5rem 1rem 2.25rem;background:linear-gradient(to bottom,#fff,#f9fafb);border-top:1px solid #e5e7eb}
.links-nav{display:flex;align-items:center;justify-content:center;gap:0.5rem;flex-wrap:wrap;margin-bottom:1rem}
.footer-link{display:inline-flex;align-items:center;gap:0.3rem;font-size:13px;font-weight:600;color:#6b7280;text-decoration:none;transition:color 0.3s ease;padding:0.2rem 0.4rem}
.footer-link:hover{color:#06b6d4}
.link-icon{font-size:0.8rem;opacity:0.7}
.link-separator{color:#d1d5db;font-size:0.65rem;user-select:none}
.footer-copyright{text-align:center;font-size:12px;color:#9ca3af;font-weight:500}
@media (min-width:640px){.card-content{padding:1.5rem 1.5rem}.form-input{font-size:15px}.google-btn{font-size:14px;padding:0.7rem 1.25rem}.submit-btn{font-size:14px;padding:0.75rem 1.25rem}}
@media (min-width:1024px){.container{max-width:32rem}.card-content{padding:1.75rem 1.75rem}.form-input{font-size:16px;padding:0.7rem 1rem}.google-btn{font-size:15px;padding:0.75rem 1.5rem}.submit-btn{font-size:15px;padding:0.8rem 1.5rem}.faq-answer{font-size:15px}}
@media (prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:0.01ms!important;animation-iteration-count:1!important;transition-duration:0.01ms!important}}
@media (prefers-contrast:high){.form-input:focus{border:3px solid #1e40af}.gender-radio:checked+.gender-label{border:3px solid #1e40af}}

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

<script>
(function(){
  'use strict';
  
  // Hide page loader when everything is loaded
  window.addEventListener('load', function() {
    
  
  // Fallback - hide loader after 2 seconds max
  setTimeout(function() {
    
  
  const inputs=form.querySelectorAll('input[type="text"],input[type="email"],input[type="password"]');
  inputs.forEach(function(input){
    input.addEventListener('input',function(){
      const errorEl=document.getElementById('error-'+this.name);
      if(errorEl && this.value.trim()){
        errorEl.textContent='';
        this.classList.remove('input-error');
        this.setAttribute('aria-invalid','false');
      }
    });
  });
  
  form.addEventListener('submit',function(e){
    const errorIds=['name','email','password','gender'];
    errorIds.forEach(function(id){
      const el=document.getElementById('error-'+id);
      if(el)el.textContent='';
    });
    inputs.forEach(function(input){
      input.classList.remove('input-error');
      input.setAttribute('aria-invalid','false');
    });
    
    let valid=true;
    const name=form.elements.name.value.trim();
    const email=form.elements.email.value.trim();
    const password=form.elements.password.value;
    let gender='';
    
    if(form.elements.gender.length){
      for(const radio of form.elements.gender){
        if(radio.checked)gender=radio.value;
      }
    }else{
      gender=form.elements.gender.value;
    }
    
    if(!name){
      form.elements.name.classList.add('input-error');
      showFunToast('😊 Oops!', errorMessages.name_empty, '👤');
      valid=false;
    }
    
    if(!email){
      form.elements.email.classList.add('input-error');
      showFunToast('✉️ Hold on!', errorMessages.email_empty, '✉️');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email)){
      form.elements.email.classList.add('input-error');
      showFunToast('🤔 Hmm...', errorMessages.email_invalid, '📧');
      valid=false;
    }
    
    if(!password){
      form.elements.password.classList.add('input-error');
      showFunToast('🔐 Oops!', errorMessages.password_empty, '🔐');
      valid=false;
    }else if(password.length<6){
      form.elements.password.classList.add('input-error');
      showFunToast('🚀 Nice try!', errorMessages.password_short, '🚀');
      valid=false;
    }
    
    if(!gender){
      showFunToast('🎭 Decide!', errorMessages.gender_empty, '🎭');
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
})();

function closeFunToast(){
  document.getElementById('funToast').classList.remove('show');
}
</script>

@include('includes.footer')

</body>
</html>