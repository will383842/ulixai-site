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
        .main-verify{min-height:100vh;display:flex;align-items:center;justify-content:center}
        
        .page-loader.hidden{opacity:0;pointer-events:none}
        
        
        50%{transform:translateY(-10px)}}
        
    </style>
    
    <!-- SEO Meta Tags -->
    <title>Verify Your Email - Ulixai Account Verification | Secure OTP</title>
    <meta name="description" content="Verify your Ulixai email address with the 6-digit code sent to your inbox. Complete your account setup and access your global help network.">
    <meta name="keywords" content="Ulixai email verification, OTP verification, account verification, email confirmation, secure verification">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Verify Your Email - Ulixai">
    <meta property="og:description" content="Complete your email verification to access your Ulixai account.">
    <meta property="og:image" content="{{ asset('images/og-verify-email.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Verify Your Email - Ulixai">
    <meta name="twitter:description" content="Complete your email verification to access your Ulixai account.">
    <meta name="twitter:image" content="{{ asset('images/twitter-verify-email.jpg') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Tailwind CSS & Design System -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
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
      "name": "Verify Email - Ulixai",
      "description": "Email verification page for Ulixai. Enter your OTP code to confirm your email address and complete your account setup.",
      "url": "{{ url()->current() }}",
      "image": "{{ asset('images/og-verify-email.jpg') }}",
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
            "name": "Didn't receive the verification code?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Check your spam/junk folder! If you still don't see it, click the 'Resend Code' button. The email should arrive within a few seconds."
            }
          },
          {
            "@type": "Question",
            "name": "How long is the code valid?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Your verification code is valid for 10 minutes. If it expires, simply request a new one by clicking 'Resend Code' - it's instant!"
            }
          },
          {
            "@type": "Question",
            "name": "Why do I need to verify my email?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Email verification keeps your account secure and ensures you can recover it if needed. It only takes a moment and protects your privacy!"
            }
          }
        ]
      }
    }
    </script>
</head>
<body>

<!-- Page Loader -->
<p class="loader-text">Loading verification...</p>
    </div>
</div>

@include('includes.header')

<!-- ============================================
     📧 ULIXAI EMAIL VERIFICATION - MOBILE-FIRST
     ⚡ Ultra-optimized Performance
     🔍 SEO & AI-Ready
     📱 Mobile-First Design
     ============================================ -->

<!-- Main Content -->
<main class="main-verify" role="main" aria-labelledby="verify-title">
  
  <!-- Background Layer - CSS only -->
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Content Container -->
  <div class="container">
    
    <!-- Verify Email Card -->
    <article class="verify-card">
      
      <!-- Card Border Effect -->
      <div class="card-border" aria-hidden="true"></div>
      
      <!-- Card Content -->
      <div class="card-content">
        
        <!-- Header Section -->
        <header class="verify-header">
          
          <!-- Logo -->
          <div class="logo-wrapper" aria-hidden="true">
            <img src="/images/headerlogo.png" alt="ULIXAI Logo" class="logo-img" width="64" height="64" loading="eager" />
          </div>

          <!-- Main Heading - H1 for SEO -->
          <h1 id="verify-title" class="main-title">
            <span class="title-text">Verify Your Email</span>
            <span class="title-emoji" aria-hidden="true">📧</span>
          </h1>
          
          <!-- Subtitle -->
          <p class="subtitle">Enter the 6-digit code sent to your email address 🔐✨</p>
          
        </header>

        <!-- Success & Error Messages -->
        <div id="otp_success" class="alert alert-success hidden" role="alert" aria-live="polite" aria-atomic="true">
          <span class="alert-icon" aria-hidden="true">✅</span>
          <span id="success_text"></span>
        </div>
        
        <div id="otp_error" class="alert alert-error hidden" role="alert" aria-live="assertive" aria-atomic="true">
          <span class="alert-icon" aria-hidden="true">⚠️</span>
          <span id="error_text"></span>
        </div>

        <!-- Verify OTP Form -->
        <form id="verifyOtpForm" 
              class="verify-form" 
              novalidate
              aria-label="Email verification form">

          <!-- Email -->
          <div class="form-group">
            <label for="verify_email" class="form-label">
              <span aria-hidden="true">📧</span>
              <span>Email Address</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="email"
                id="verify_email"
                name="email" 
                class="form-input"
                placeholder="your@email.com"
                required
                autocomplete="email"
                aria-required="true"
                aria-invalid="false"
                aria-describedby="otp_error" />
              <div class="input-glow" aria-hidden="true"></div>
            </div>
          </div>

          <!-- OTP Code -->
          <div class="form-group">
            <label for="verify_otp" class="form-label">
              <span aria-hidden="true">🔢</span>
              <span>Verification Code</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text"
                id="verify_otp"
                name="otp" 
                maxlength="6"
                class="form-input otp-input"
                placeholder="000000"
                required
                autocomplete="one-time-code"
                aria-required="true"
                aria-invalid="false"
                aria-describedby="otp_error"
                inputmode="numeric"
                pattern="[0-9]{6}" />
              <div class="input-glow" aria-hidden="true"></div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="verifyBtn" class="submit-btn">
            <span class="submit-bg" aria-hidden="true"></span>
            <span class="submit-text">
              <span class="submit-label">Verify Email! 🚀</span>
              <span class="submit-emoji" aria-hidden="true">✨</span>
            </span>
          </button>

        </form>

        <!-- Action Buttons -->
        <footer class="card-footer">
          <div class="action-buttons">
            <button id="resendOtpBtn" class="action-link resend-link" aria-label="Resend verification code">
              <span class="action-icon" aria-hidden="true">🔄</span>
              <span>Resend Code</span>
            </button>
            <button id="cancelOtpBtn" class="action-link cancel-link" aria-label="Cancel verification">
              <span class="action-icon" aria-hidden="true">❌</span>
              <span>Cancel</span>
            </button>
          </div>
        </footer>

      </div>
    </article>
  </div>

</main>

<!-- FAQ Section - SEO Rich -->
<section class="faq-section" aria-labelledby="faq-title">
  <div class="container">
    
    <h2 id="faq-title" class="faq-title">Email Verification Help 💬</h2>
    
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
      <!-- FAQ 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📧</span>
          <span>Didn't receive the verification code?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Check these common places:</strong> First, look in your spam/junk folder - verification emails sometimes get filtered there. Check your Promotions or Social tabs if using Gmail. If you still don't see it after 5 minutes, click the <strong>"Resend Code"</strong> button above. The email should arrive within seconds!</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⏰</span>
          <span>How long is the code valid?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Your verification code is valid for 10 minutes.</strong> This short timeframe is a security measure to protect your account. If your code expires, don't worry - simply click "Resend Code" and you'll receive a fresh one instantly. There's no limit to how many times you can request a new code.</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔐</span>
          <span>Why do I need to verify my email?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Email verification is crucial for your security!</strong> It ensures that: (1) You own the email address, (2) You can recover your account if you forget your password, (3) We can send you important security alerts, (4) Your account stays protected from unauthorized access. It only takes a moment and significantly enhances your account security!</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">❌</span>
          <span>The code isn't working - what should I do?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Try these troubleshooting steps:</strong> (1) Make sure you're entering all 6 digits correctly without spaces, (2) Check if the code has expired (10-minute limit), (3) Verify you're using the most recent code if you requested multiple, (4) Request a new code using the "Resend Code" button. Still having issues? Our support team is here 24/7 to help!</p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔄</span>
          <span>Can I change my email address?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes, you can!</strong> If you entered the wrong email address during registration, you'll need to complete the signup process again with the correct email. Once your account is verified and active, you can change your email address in your account settings. We'll send a verification code to your new email address for security.</p>
        </div>
      </details>

      <!-- FAQ 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌍</span>
          <span>Does verification work worldwide?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Absolutely!</strong> Our email verification system works globally in all 195+ countries. Whether you're in Tokyo, London, New York, or anywhere else, you'll receive your verification code within seconds. Our servers are optimized for fast delivery worldwide, ensuring a smooth verification experience no matter your location.</p>
        </div>
      </details>

      <!-- FAQ 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🛡️</span>
          <span>Is my verification code secure?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Your security is our priority!</strong> Verification codes are: (1) Unique and randomly generated, (2) Valid for only 10 minutes, (3) Single-use only - they become invalid after one successful verification, (4) Sent through encrypted email channels, (5) Never stored in plain text. Never share your verification code with anyone, including Ulixai staff.</p>
        </div>
      </details>

      <!-- FAQ 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🆘</span>
          <span>Need more help?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>We're here 24/7!</strong> Our support team is always ready to help you verify your email and get started with Ulixai. Contact us through live chat, email, or phone support. We'll respond quickly and help you complete the verification process. Your success is our mission! 💪</p>
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
   Same sizes as all previous pages
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
.main-verify{
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
.verify-card{
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

.verify-card:hover .card-border{
  opacity:0.7;
}

.card-content{
  padding:1rem 1.25rem;
  position:relative;
  background:#fff;
  border-radius:1.5rem;
}

/* Header */
.verify-header{
  text-align:center;
  margin-bottom:0.875rem;
}

/* Logo */
.logo-wrapper{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  margin:0 auto 0.5rem;
  position:relative;
}

.logo-img{
  width:2.25rem;
  height:2.25rem;
  object-fit:contain;
  animation:pulse 2s ease-in-out infinite;
}

@keyframes pulse{
  0%,100%{transform:scale(1)}
  50%{transform:scale(1.05)}
}

/* Title - Same sizes as other pages */
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

.alert.hidden{
  display:none;
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
.verify-form{
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

.otp-input{
  text-align:center;
  font-size:1.5rem;
  letter-spacing:0.5rem;
  font-weight:700;
  padding:0.75rem;
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

.submit-btn:disabled{
  opacity:0.6;
  cursor:not-allowed;
  transform:none;
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

.action-buttons{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:0.5rem;
  flex-wrap:wrap;
}

.action-link{
  display:inline-flex;
  align-items:center;
  gap:0.35rem;
  font-size:12px;
  font-weight:700;
  text-decoration:none;
  transition:all 0.3s ease;
  padding:0.5rem 0.75rem;
  border-radius:0.5rem;
  border:none;
  background:none;
  cursor:pointer;
}

.resend-link{
  color:#06b6d4;
}

.resend-link:hover{
  background:rgba(6,182,212,0.1);
}

.cancel-link{
  color:#6b7280;
}

.cancel-link:hover{
  color:#ef4444;
  background:rgba(239,68,68,0.1);
}

.action-link:disabled{
  opacity:0.5;
  cursor:not-allowed;
}

.action-icon{
  font-size:1rem;
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
  
  .logo-img{
    width:2.75rem;
    height:2.75rem;
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
  
  .logo-img{
    width:3rem;
    height:3rem;
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
document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // DOM Elements
  var form = document.getElementById('verifyOtpForm');
  var emailInput = document.getElementById('verify_email');
  var otpInput = document.getElementById('verify_otp');
  var otpSuccess = document.getElementById('otp_success');
  var otpError = document.getElementById('otp_error');
  var successText = document.getElementById('success_text');
  var errorText = document.getElementById('error_text');
  var verifyBtn = document.getElementById('verifyBtn');
  var resendBtn = document.getElementById('resendOtpBtn');
  var cancelBtn = document.getElementById('cancelOtpBtn');

  // Guard clause - exit if elements not found
  if (!form || !emailInput || !otpInput || !verifyBtn) {
    console.warn('Verify OTP form elements not found');
    return;
  }

  // Form submission
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    otpError.classList.add('hidden');
    otpSuccess.classList.add('hidden');
    verifyBtn.disabled = true;

    const email = emailInput.value.trim();
    const otp = otpInput.value.trim();

    if (!email || !otp || otp.length !== 6) {
      errorText.textContent = "📧 Please enter your email and the 6-digit code.";
      otpError.classList.remove('hidden');
      verifyBtn.disabled = false;
      return;
    }

    fetch('/verify-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email, otp })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        successText.textContent = data.message || "✅ Email verified successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
        setTimeout(() => { window.location.href = '/dashboard'; }, 1500);
      } else {
        errorText.textContent = data.message || "❌ Invalid code. Please try again.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      errorText.textContent = "⚠️ Verification failed. Please try again.";
      otpError.classList.remove('hidden');
      otpSuccess.classList.add('hidden');
    })
    .finally(() => {
      verifyBtn.disabled = false;
    });
  });

  // Resend OTP
  resendBtn.addEventListener('click', function () {
    otpError.classList.add('hidden');
    otpSuccess.classList.add('hidden');
    const email = emailInput.value.trim();
    
    if (!email) {
      errorText.textContent = "📧 Please enter your email to resend OTP.";
      otpError.classList.remove('hidden');
      return;
    }
    
    resendBtn.disabled = true;
    
    fetch('/resend-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        successText.textContent = data.message || "✅ OTP resent successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
      } else {
        errorText.textContent = data.message || "⚠️ Failed to resend OTP.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      errorText.textContent = "⚠️ Failed to resend OTP. Please try again.";
      otpError.classList.remove('hidden');
      otpSuccess.classList.add('hidden');
    })
    .finally(() => {
      resendBtn.disabled = false;
    });
  });

  // Cancel button
  cancelBtn.addEventListener('click', function () {
    window.location.href = '/';
  });
});
</script>

@include('includes.footer')

</body>
</html>