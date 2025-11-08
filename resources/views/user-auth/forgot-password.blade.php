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
        .main-forgot{min-height:100vh;display:flex;align-items:center;justify-content:center}
        
        .page-loader.hidden{opacity:0;pointer-events:none}
        
        
        50%{transform:translateY(-10px)}}
        
    </style>
    
    <!-- SEO Meta Tags -->
    <title>Forgot Password - Reset Your Ulixai Account | Secure Password Recovery</title>
    <meta name="description" content="Reset your Ulixai password securely. Receive reset instructions via email instantly. Fast and secure password recovery for your global help network account.">
    <meta name="keywords" content="Ulixai forgot password, reset password, password recovery, account recovery, secure password reset">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Reset Your Ulixai Password - Secure Recovery">
    <meta property="og:description" content="Forgot your password? No worries! Reset it securely in seconds.">
    <meta property="og:image" content="{{ asset('images/og-forgot-password.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Reset Your Ulixai Password">
    <meta name="twitter:description" content="Forgot your password? No worries! Reset it securely in seconds.">
    <meta name="twitter:image" content="{{ asset('images/twitter-forgot-password.jpg') }}">
    
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
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Forgot Password - Ulixai",
      "description": "Secure password reset page for Ulixai. Recover your account access quickly and securely with email verification.",
      "url": "{{ url()->current() }}",
      "image": "{{ asset('images/og-forgot-password.jpg') }}",
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
      "mainEntity": {
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": "How long does it take to receive the reset email?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Usually within a few seconds! Check your inbox and spam folder. The email contains a secure link to reset your password."
            }
          },
          {
            "@type": "Question",
            "name": "Is the password reset process secure?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Absolutely! We use industry-standard encryption and secure tokens. Your reset link expires after a certain time for maximum security."
            }
          },
          {
            "@type": "Question",
            "name": "What if I don't receive the email?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Check your spam/junk folder first. Make sure you entered the correct email address. You can request a new reset link anytime."
            }
          },
          {
            "@type": "Question",
            "name": "How long is the reset link valid?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "For security reasons, the reset link is valid for 60 minutes. If it expires, simply request a new one - it's quick and easy!"
            }
          }
        ]
      }
    }
    </script>
</head>
<body>

<!-- Page Loader -->
<p class="loader-text">Preparing password reset...</p>
    </div>
</div>

@include('includes.header')

<!-- ============================================
     🔐 ULIXAI FORGOT PASSWORD - MOBILE-FIRST
     ⚡ Ultra-optimized Performance
     🔍 SEO & AI-Ready
     📱 Mobile-First Design
     ============================================ -->

<!-- Main Content -->
<main class="main-forgot" role="main" aria-labelledby="forgot-title">
  
  <!-- Background Layer - CSS only -->
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Content Container -->
  <div class="container">
    
    <!-- Forgot Password Card -->
    <article class="forgot-card">
      
      <!-- Card Border Effect -->
      <div class="card-border" aria-hidden="true"></div>
      
      <!-- Card Content -->
      <div class="card-content">
        
        <!-- Header Section -->
        <header class="forgot-header">
          
          <!-- Brand Icon -->
          <div class="brand-icon" aria-hidden="true">
            <div class="icon-container">
              <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
              </svg>
            </div>
          </div>

          <!-- Main Heading - H1 for SEO -->
          <h1 id="forgot-title" class="main-title">
            <span class="title-text">Forgot Password?</span>
            <span class="title-emoji" aria-hidden="true">🔑</span>
          </h1>
          
          <!-- Subtitle -->
          <p class="subtitle">No worries! We'll send you reset instructions 💌✨</p>
          
        </header>

        <!-- Status Messages -->
        @if(session('status'))
          <div class="alert alert-success" role="alert" aria-live="polite" aria-atomic="true">
            <span class="alert-icon" aria-hidden="true">✅</span>
            <span>{{ session('status') }}</span>
          </div>
        @endif
        
        @if($errors->any())
          <div class="alert alert-error" role="alert" aria-live="assertive" aria-atomic="true">
            <span class="alert-icon" aria-hidden="true">⚠️</span>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        <!-- Forgot Password Form -->
        <form id="forgotForm" 
              method="POST" 
              action="{{ route('password.email') }}" 
              class="forgot-form" 
              novalidate
              aria-label="Password reset form">
          @csrf

          <!-- Email -->
          <div class="form-group">
            <label for="email" class="form-label">
              <span aria-hidden="true">📧</span>
              <span>Email Address</span>
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
              <p id="error-email" class="error-msg" role="alert" aria-live="polite" aria-atomic="true">{{ $message }}</p>
            @else
              <p id="error-email" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
            @enderror
          </div>

          <!-- Submit Button -->
          <button type="submit" id="forgotBtnSubmit" class="submit-btn">
            <span class="submit-bg" aria-hidden="true"></span>
            <span class="submit-text">
              <span class="submit-label">Send Reset Link! 🚀</span>
              <span class="submit-emoji" aria-hidden="true">✨</span>
            </span>
          </button>

        </form>

        <!-- Back to Login Link -->
        <footer class="card-footer">
          <a href="/login" class="back-link" aria-label="Go back to login page">
            <span class="back-icon" aria-hidden="true">←</span>
            <span>Back to Login</span>
            <span class="back-emoji" aria-hidden="true">🔙</span>
          </a>
        </footer>

      </div>
    </article>
  </div>

</main>

<!-- FAQ Section - SEO Rich -->
<section class="faq-section" aria-labelledby="faq-title">
  <div class="container">
    
    <h2 id="faq-title" class="faq-title">Frequently Asked Questions 💬</h2>
    
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
      <!-- FAQ 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">❓</span>
          <span>How long does it take to receive the reset email?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Usually within a few seconds!</strong> Check your inbox and spam folder. The email contains a secure link to reset your password. If you don't receive it within 5 minutes, you can request a new one.</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔒</span>
          <span>Is the password reset process secure?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Absolutely!</strong> We use <strong>industry-standard encryption</strong> and secure tokens with time-limited validity. Your reset link is unique, single-use, and expires automatically for maximum security. All communications are encrypted with SSL/TLS.</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📧</span>
          <span>What if I don't receive the email?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Check these common issues:</strong> Verify your spam/junk folder first. Ensure you entered the correct email address associated with your account. Check if your email provider is blocking emails from Ulixai. You can request a new reset link anytime - there's no limit!</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⏰</span>
          <span>How long is the reset link valid?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>For security reasons, the reset link is valid for 60 minutes.</strong> If it expires, simply request a new one - it's quick and easy! This time limit prevents unauthorized access even if someone intercepts your email.</p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔐</span>
          <span>What makes a strong password?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Create a strong password with these tips:</strong> Use at least 8 characters (12+ recommended). Mix uppercase and lowercase letters. Include numbers and special characters (!@#$%). Avoid personal information, common words, or sequential patterns. Consider using a passphrase - a memorable sentence turned into a password.</p>
        </div>
      </details>

      <!-- FAQ 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🤔</span>
          <span>Can I reset my password multiple times?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes, you can!</strong> There's no limit to password reset requests. Each new request invalidates previous reset links for security. However, if you're frequently forgetting your password, consider using a password manager for secure storage.</p>
        </div>
      </details>

      <!-- FAQ 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌍</span>
          <span>Can I reset my password from anywhere?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes, from anywhere in the world!</strong> Our password reset system works globally, 24/7. Whether you're traveling, relocating, or working remotely, you can reset your password from any device with internet access in any of the 195+ countries we serve.</p>
        </div>
      </details>

      <!-- FAQ 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🆘</span>
          <span>Still need help?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>We're here for you!</strong> Contact our 24/7 support team if you're still having trouble accessing your account. We'll verify your identity and help you regain access safely and quickly. Your security is our priority. 💪</p>
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
    <p class="footer-copyright">&copy; {{ date('Y') }} Ulixai. All rights reserved.</p>
  </div>
</footer>

<style>
/* ============================================
   CSS - MOBILE-FIRST & OPTIMIZED
   Same sizes as signup/login pages
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

/* Main Container */
.main-forgot{
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
}

.blob-1{
  width:24rem;
  height:24rem;
  background:#3b82f6;
  top:5rem;
  left:2.5rem;
  animation:fade-in 0.8s ease-out forwards,float-1 12s ease-in-out infinite;
  animation-delay:0.3s;
}

.blob-2{
  width:20rem;
  height:20rem;
  background:#06b6d4;
  top:10rem;
  right:5rem;
  animation:fade-in 0.8s ease-out forwards,float-2 15s ease-in-out infinite;
  animation-delay:0.5s;
}

.blob-3{
  width:18rem;
  height:18rem;
  background:#14b8a6;
  bottom:8rem;
  left:50%;
  animation:fade-in 0.8s ease-out forwards,float-3 18s ease-in-out infinite;
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
.forgot-card{
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

.forgot-card:hover .card-border{
  opacity:0.7;
}

.card-content{
  padding:1rem 1.25rem;
  position:relative;
  background:#fff;
  border-radius:1.5rem;
}

/* Header */
.forgot-header{
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
  animation:pulse 2s ease-in-out infinite;
}

@keyframes pulse{
  0%,100%{transform:scale(1)}
  50%{transform:scale(1.05)}
}

.icon-svg{
  width:1.125rem;
  height:1.125rem;
  color:#fff;
}

/* Title - Same sizes as signup/login */
.main-title{
  font-size:clamp(24px,6vw,40px);
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
  font-size:clamp(20px,5vw,32px);
}

/* Subtitle */
.subtitle{
  font-size:clamp(13px,2vw,16px);
  color:#6b7280;
  font-weight:500;
  margin-bottom:0.75rem;
}

/* Alerts */
.alert{
  display:flex;
  align-items:center;
  gap:0.5rem;
  padding:1rem 1.25rem;
  border-radius:0.75rem;
  margin-bottom:0.75rem;
  font-size:12px;
  font-weight:700;
  animation:slideIn 0.3s ease-out;
}

@keyframes slideIn{
  from{opacity:0;transform:translateY(-10px)}
  to{opacity:1;transform:translateY(0)}
}

.alert-success{
  background:linear-gradient(135deg,#d1fae5,#a7f3d0);
  color:#065f46;
  border:2px solid #10b981;
}

.alert-error{
  background:linear-gradient(135deg,#fee2e2,#fecaca);
  color:#991b1b;
  border:2px solid #ef4444;
}

.alert-icon{
  font-size:1.25rem;
  flex-shrink:0;
}

/* Form */
.forgot-form{
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

.form-input:focus+.input-glow{
  opacity:0.3;
}

.error-msg{
  color:#ef4444;
  font-size:12px;
  font-weight:700;
  margin-top:0.25rem;
  min-height:1rem;
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
  text-align:center;
}

.back-link{
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
  padding:0.5rem 1rem;
  font-size:12px;
  font-weight:700;
  color:#6b7280;
  text-decoration:none;
  transition:all 0.3s ease;
  border-radius:0.5rem;
}

.back-link:hover{
  color:#06b6d4;
  background:rgba(6,182,212,0.1);
}

.back-icon{
  font-size:1.125rem;
  transition:transform 0.3s ease;
}

.back-link:hover .back-icon{
  transform:translateX(-4px);
}

.back-emoji{
  font-size:0.875rem;
}

/* FAQ Section */
.faq-section{
  padding:3rem 1rem;
  background:#fff;
}

.faq-title{
  font-size:clamp(32px,7vw,56px);
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
</style>

<!-- JavaScript -->
<script>
(function(){
  'use strict';
  
  // Hide page loader when everything is loaded
  window.addEventListener('load', function() {
    
  
  // Fallback - hide loader after 2 seconds max
  setTimeout(function() {
    
  
  // Form submission validation
  form.addEventListener('submit',function(e){
    const errorEl=document.getElementById('error-email');
    if(errorEl)errorEl.textContent='';
    
    emailInput.classList.remove('input-error');
    emailInput.setAttribute('aria-invalid','false');
    
    let valid=true;
    const email=emailInput.value.trim();
    
    if(!email){
      showError('📧 Email address is required.');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email)){
      showError('🤔 Please enter a valid email address.');
      valid=false;
    }
    
    if(!valid){
      e.preventDefault();
      btn.disabled=false;
      return false;
    }
  });
  
  function showError(msg){
    const errorEl=document.getElementById('error-email');
    
    if(errorEl)errorEl.textContent=msg;
    emailInput.classList.add('input-error');
    emailInput.setAttribute('aria-invalid','true');
  }
})();
</script>

@include('includes.footer')

</body>
</html>