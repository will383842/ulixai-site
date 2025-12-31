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
        .main-reset{min-height:100vh;display:flex;align-items:center;justify-content:center}
        
        .page-loader.hidden{opacity:0;pointer-events:none}
        
        
        50%{transform:translateY(-10px)}}
        
    </style>
    
    <!-- SEO Meta Tags -->
    <title>Reset Password - Create New Ulixai Password | Secure Account Recovery</title>
    <meta name="description" content="Create a new secure password for your Ulixai account. Complete your password reset and regain access to your global help network account.">
    <meta name="keywords" content="Ulixai reset password, new password, account recovery, secure password, password change">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Reset Your Ulixai Password - Secure Recovery">
    <meta property="og:description" content="Create a new secure password for your account.">
    <meta property="og:image" content="{{ asset('images/og-reset-password.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Reset Your Ulixai Password">
    <meta name="twitter:description" content="Create a new secure password for your account.">
    <meta name="twitter:image" content="{{ asset('images/twitter-reset-password.jpg') }}">
    
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
      "name": "Reset Password - Ulixai",
      "description": "Secure password reset completion page for Ulixai. Create a new password and regain access to your account.",
      "url": "{{ url()->current() }}",
      "image": "{{ asset('images/og-reset-password.jpg') }}",
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
            "name": "What makes a strong password?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Use at least 8 characters with a mix of uppercase, lowercase, numbers, and symbols. Avoid common words or personal info like birthdays!"
            }
          },
          {
            "@type": "Question",
            "name": "Should I use the same password everywhere?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Never! Use unique passwords for each account. Consider using a password manager to keep track of them securely."
            }
          },
          {
            "@type": "Question",
            "name": "How often should I change my password?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Change it every 3-6 months, or immediately if you suspect your account has been compromised."
            }
          },
          {
            "@type": "Question",
            "name": "What happens after I reset my password?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "You'll be redirected to login with your new password. All your data and settings remain intact - only your password changes!"
            }
          }
        ]
      }
    }
    </script>
</head>
<body>

<!-- Page Loader -->
<p class="loader-text">Setting up password reset...</p>
    </div>
</div>

@include('includes.header')

<!-- ============================================
     🔐 ULIXAI RESET PASSWORD - MOBILE-FIRST
     ⚡ Ultra-optimized Performance
     🔍 SEO & AI-Ready
     📱 Mobile-First Design
     ============================================ -->

<!-- Main Content -->
<main class="main-reset" role="main" aria-labelledby="reset-title">
  
  <!-- Background Layer - CSS only -->
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Content Container -->
  <div class="container">
    
    <!-- Reset Password Card -->
    <article class="reset-card">
      
      <!-- Card Border Effect -->
      <div class="card-border" aria-hidden="true"></div>
      
      <!-- Card Content -->
      <div class="card-content">
        
        <!-- Header Section -->
        <header class="reset-header">
          
          <!-- Brand Icon -->
          <div class="brand-icon" aria-hidden="true">
            <div class="icon-container">
              <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
          </div>

          <!-- Main Heading - H1 for SEO -->
          <h1 id="reset-title" class="main-title">
            <span class="title-text">Reset Your Password</span>
            <span class="title-emoji" aria-hidden="true">🔐</span>
          </h1>
          
          <!-- Subtitle -->
          <p class="subtitle">Enter your new password below 💪✨</p>
          
        </header>

        <!-- Error Messages -->
        @if($errors->any())
          <div class="alert alert-error" role="alert" aria-live="assertive" aria-atomic="true">
            <span class="alert-icon" aria-hidden="true">⚠️</span>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        <!-- Reset Password Form -->
        <form id="resetPasswordForm" 
              method="POST" 
              action="{{ route('password.update') }}" 
              class="reset-form" 
              novalidate
              aria-label="Password reset form">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}">

          <!-- New Password -->
          <div class="form-group">
            <label for="password" class="form-label">
              <span aria-hidden="true">🔒</span>
              <span>New Password</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="password"
                id="password"
                name="password" 
                class="form-input"
                placeholder="Enter new password"
                required
                minlength="6"
                autocomplete="new-password"
                aria-required="true"
                aria-invalid="false"
                aria-describedby="error-password" />
              <div class="input-glow" aria-hidden="true"></div>
              <button type="button" 
                      class="toggle-password" 
                      data-target="password"
                      aria-label="Toggle password visibility">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            <p id="error-password" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="password_confirmation" class="form-label">
              <span aria-hidden="true">🔐</span>
              <span>Confirm Password</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="password"
                id="password_confirmation"
                name="password_confirmation" 
                class="form-input"
                placeholder="Confirm new password"
                required
                minlength="6"
                autocomplete="new-password"
                aria-required="true"
                aria-invalid="false"
                aria-describedby="error-password-confirmation" />
              <div class="input-glow" aria-hidden="true"></div>
              <button type="button" 
                      class="toggle-password" 
                      data-target="password_confirmation"
                      aria-label="Toggle password visibility">
                <span class="eye-icon">👁️</span>
              </button>
            </div>
            <p id="error-password-confirmation" class="error-msg" role="alert" aria-live="polite" aria-atomic="true"></p>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="resetBtnSubmit" class="submit-btn">
            <span class="submit-bg" aria-hidden="true"></span>
            <span class="submit-text">
              <span class="submit-label">Reset Password! 🚀</span>
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
    
    <h2 id="faq-title" class="faq-title">Password Security Tips 🛡️</h2>
    
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
      <!-- FAQ 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔐</span>
          <span>What makes a strong password?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Create a fortress-strong password!</strong> Use at least 8 characters (12+ recommended) with a mix of uppercase letters, lowercase letters, numbers, and special symbols (!@#$%). Avoid common words, personal information like birthdays, names, or sequential patterns like "123456". A good trick: turn a memorable sentence into a password using first letters and substitutions.</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">💡</span>
          <span>Should I use the same password everywhere?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Never, ever reuse passwords!</strong> Using the same password across multiple accounts is like using the same key for your house, car, and office - if one gets compromised, everything is at risk. Consider using a <strong>password manager</strong> like 1Password, LastPass, or Bitwarden to securely store and generate unique passwords for each account.</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔄</span>
          <span>How often should I change my password?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Regular updates keep you secure!</strong> Change your password every 3-6 months as a best practice. However, change it <strong>immediately</strong> if you suspect your account has been compromised, receive a security alert, or if a website you use reports a data breach. Better safe than sorry!</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⚡</span>
          <span>What happens after I reset my password?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Smooth transition guaranteed!</strong> After resetting your password, you'll be redirected to the login page. Use your new password to sign in. All your data, settings, connections, and conversations remain completely intact - only your login credentials change. You'll stay logged in on your current device unless you choose to log out.</p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🛡️</span>
          <span>How can I make my account even more secure?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Layer your security!</strong> Enable <strong>two-factor authentication (2FA)</strong> in your account settings for an extra layer of protection. Use biometric authentication where available. Regularly review active sessions and logout from devices you no longer use. Never share your password with anyone, and be wary of phishing emails asking for your credentials.</p>
        </div>
      </details>

      <!-- FAQ 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📱</span>
          <span>Will I be logged out of my mobile app?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Yes, for your security!</strong> Changing your password will log you out of all devices except the one you're currently using. This is a security measure to protect your account. Simply log back in with your new password on your mobile devices, tablets, and other computers. This ensures no one else has access to your account with the old password.</p>
        </div>
      </details>

      <!-- FAQ 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⏰</span>
          <span>How long is the reset link valid?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>Act quickly for security!</strong> Password reset links are valid for 60 minutes from the time they're sent. If your link expires, simply request a new one - the process is quick and easy. This time limit is a security feature that prevents unauthorized access even if someone intercepts your reset email.</p>
        </div>
      </details>

      <!-- FAQ 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🆘</span>
          <span>Still having trouble?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text"><strong>We're here to help 24/7!</strong> Our support team is always ready to assist you. Contact us anytime and we'll help you regain access to your account safely and securely. Your account security is our top priority! 💪</p>
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
   Same sizes as signup/login/forgot pages
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
.main-reset{
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
.reset-card{
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

.reset-card:hover .card-border{
  opacity:0.7;
}

.card-content{
  padding:1rem 1.25rem;
  position:relative;
  background:#fff;
  border-radius:1.5rem;
}

/* Header */
.reset-header{
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

/* Alert */
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
.reset-form{
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
  padding:0.625rem 2.5rem 0.625rem 0.875rem;
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

.eye-icon{
  display:block;
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
    padding:0.7rem 2.5rem 0.7rem 1rem;
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

  // DOM Elements
  var form = document.getElementById('resetPasswordForm');
  var passwordInput = document.getElementById('password');
  var confirmInput = document.getElementById('password_confirmation');
  var btn = document.getElementById('resetBtnSubmit');

  // Guard clause - exit if elements not found
  if (!form || !passwordInput || !confirmInput || !btn) {
    console.warn('Password reset form elements not found');
    return;
  }

  // Real-time validation
  passwordInput.addEventListener('input',function(){
    const errorEl=document.getElementById('error-password');
    if(errorEl && this.value.trim()){
      errorEl.textContent='';
      this.classList.remove('input-error');
      this.setAttribute('aria-invalid','false');
    }
  });
  
  confirmInput.addEventListener('input',function(){
    const errorEl=document.getElementById('error-password-confirmation');
    if(errorEl && this.value.trim()){
      errorEl.textContent='';
      this.classList.remove('input-error');
      this.setAttribute('aria-invalid','false');
    }
  });
  
  // Form submission validation
  form.addEventListener('submit',function(e){
    const errorPassword=document.getElementById('error-password');
    const errorConfirm=document.getElementById('error-password-confirmation');
    
    if(errorPassword)errorPassword.textContent='';
    if(errorConfirm)errorConfirm.textContent='';
    
    passwordInput.classList.remove('input-error');
    confirmInput.classList.remove('input-error');
    passwordInput.setAttribute('aria-invalid','false');
    confirmInput.setAttribute('aria-invalid','false');
    
    let valid=true;
    const password=passwordInput.value;
    const confirm=confirmInput.value;
    
    if(!password){
      showError('password','🔒 Password is required.');
      valid=false;
    }else if(password.length<6){
      showError('password','🚀 Password must be at least 6 characters.');
      valid=false;
    }
    
    if(!confirm){
      showError('password-confirmation','🔐 Please confirm your password.');
      valid=false;
    }else if(password!==confirm){
      showError('password-confirmation','⚠️ Passwords do not match.');
      valid=false;
    }
    
    if(!valid){
      e.preventDefault();
      btn.disabled=false;
      return false;
    }
  });
  
  function showError(field,msg){
    const errorEl=document.getElementById('error-'+field);
    const inputEl=document.getElementById(field.replace('-','_'));
    
    if(errorEl)errorEl.textContent=msg;
    if(inputEl){
      inputEl.classList.add('input-error');
      inputEl.setAttribute('aria-invalid','true');
    }
  }
})();
</script>

@include('includes.footer')

</body>
</html>