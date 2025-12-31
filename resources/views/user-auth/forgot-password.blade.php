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
        .main-forgot{min-height:calc(100vh - 80px);display:flex;align-items:center;justify-content:center;padding-top:10px}
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
    <meta name="twitter:image" content="{{ asset('images/og-forgot-password.jpg') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Tailwind CSS & Design System -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Performance: Using system fonts for instant load -->
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
     🔐 ULIXAI FORGOT PASSWORD - MOBILE-FIRST & OPTIMIZED
     ============================================ -->

<!-- Main Content -->
<main class="main-forgot" role="main" aria-labelledby="forgot-title">
  
  <!-- Content Container -->
  <div class="container">
    
    <!-- Forgot Password Card -->
    <article class="forgot-card">
      
      <!-- Card Content -->
      <div class="card-content">
        
        <!-- Header Section -->
        <header class="forgot-header">
          
          <!-- Brand Icon -->
          <div class="brand-icon" aria-hidden="true">
            <svg class="icon-svg" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
          </div>

          <!-- Main Heading -->
          <h1 id="forgot-title" class="main-title">Forgot Password? 🔑</h1>
          
          <!-- Subtitle -->
          <p class="subtitle">No worries! We'll send you reset instructions ✨</p>
          
        </header>

        <!-- Status Messages (shown in modal via JavaScript) -->

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
            </div>
            @error('email')
              <p id="error-email" class="error-msg" role="alert">{{ $message }}</p>
            @enderror
          </div>

          <!-- Submit Button -->
          <button type="submit" id="forgotBtnSubmit" class="submit-btn">
            <span class="submit-text">Send Reset Link! 🚀</span>
          </button>

        </form>

        <!-- Back to Login Link -->
        <footer class="card-footer">
          <p class="footer-text">
            <a href="/login" class="back-link">← Back to Login</a>
          </p>
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
      
      <!-- Question 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⏱️</span>
          <span>How long does it take to receive the reset email?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Usually within a few seconds!</strong> Check your inbox and spam folder. The email contains a secure link to reset your password. If you don't receive it within 5 minutes, you can request a new one.
          </p>
        </div>
      </details>

      <!-- Question 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔐</span>
          <span>Is the password reset process secure?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Absolutely!</strong> We use industry-standard encryption and secure tokens with time-limited validity. Your reset link is unique, single-use, and expires automatically for maximum security. All communications are encrypted with SSL/TLS.
          </p>
        </div>
      </details>

      <!-- Question 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">📧</span>
          <span>What if I don't receive the email?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Check these common issues:</strong> Verify your spam/junk folder first. Ensure you entered the correct email address associated with your account. Check if your email provider is blocking emails from Ulixai. You can request a new reset link anytime - there's no limit!
          </p>
        </div>
      </details>

      <!-- Question 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">⏰</span>
          <span>How long is the reset link valid?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>For security reasons, the reset link is valid for 60 minutes.</strong> If it expires, simply request a new one - it's quick and easy! This time limit prevents unauthorized access even if someone intercepts your email.
          </p>
        </div>
      </details>

      <!-- Question 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔑</span>
          <span>What makes a strong password?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Create a strong password with these tips:</strong> Use at least 8 characters (12+ recommended). Mix uppercase and lowercase letters. Include numbers and special characters (!@#$%). Avoid personal information, common words, or sequential patterns. Consider using a passphrase - a memorable sentence turned into a password.
          </p>
        </div>
      </details>

      <!-- Question 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🔄</span>
          <span>Can I reset my password multiple times?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, you can!</strong> There's no limit to password reset requests. Each new request invalidates previous reset links for security. However, if you're frequently forgetting your password, consider using a password manager for secure storage.
          </p>
        </div>
      </details>

      <!-- Question 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🌍</span>
          <span>Can I reset my password from anywhere?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, from anywhere in the world!</strong> Our password reset system works globally, 24/7. Whether you're traveling, relocating, or working remotely, you can reset your password from any device with internet access in any of the 195+ countries we serve.
          </p>
        </div>
      </details>

      <!-- Question 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon" aria-hidden="true">🆘</span>
          <span>Still need help?</span>
          <span class="faq-toggle" aria-hidden="true">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>We're here for you!</strong> Contact our 24/7 support team if you're still having trouble accessing your account. We'll verify your identity and help you regain access safely and quickly. Your security is our priority.
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

/* Main Forgot Container */
.main-forgot{
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
.forgot-card{
  background:#fff;
  border-radius:1rem;
  box-shadow:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06);
  border:1px solid #e5e7eb;
}

.card-content{
  padding:1rem;
}

/* Header */
.forgot-header{
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

/* Form */
.forgot-form{
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

.error-msg{
  color:#ef4444;
  font-size:12px;
  font-weight:600;
  margin-top:0.25rem;
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
  font-size:12px;
  color:#6b7280;
  font-weight:500;
}

.back-link{
  display:inline-block;
  color:#06b6d4;
  font-weight:600;
  text-decoration:none;
  transition:all 0.2s ease;
}

.back-link:hover{
  color:#0891b2;
  text-decoration:underline;
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
  
  .main-forgot{
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
  
  const form = document.getElementById('forgotForm');
  
  // Real-time validation - remove errors on input
  const emailInput = form.elements.email;
  emailInput.addEventListener('input',function(){
    const errorEl=document.getElementById('error-email');
    if(errorEl && this.value.trim()){
      errorEl.textContent='';
      this.classList.remove('input-error');
    }
  });
  
  // Form submission validation
  form.addEventListener('submit',function(e){
    let valid=true;
    const email=form.elements.email.value.trim();
    
    // Clear previous errors
    emailInput.classList.remove('input-error');
    
    if(!email){
      emailInput.classList.add('input-error');
      showFunModal('📧', 'Hey there!', 'We need your email address to send the reset link! 😊', 'error');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email)){
      emailInput.classList.add('input-error');
      showFunModal('🤔', 'Hmm...', 'That doesn\'t look like a valid email address! 📧', 'error');
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

@if(session('status') || session('error') || $errors->any())
<script>
document.addEventListener('DOMContentLoaded', function(){
    @if(session('status'))
        showFunModal('🎉', 'Success!', "{{ session('status') }}", 'success');
    @elseif(session('error'))
        showFunModal('😅', 'Oops!', "{{ session('error') }}", 'error');
    @elseif($errors->has('email'))
        showFunModal('😅', 'Oops!', "{{ $errors->first('email') }}", 'error');
    @elseif($errors->any())
        showFunModal('😅', 'Oops!', "{{ $errors->first() }}", 'error');
    @endif
});
</script>
@endif

@include('includes.footer')

</body>
</html>