<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    <meta property="og:title" content="Reset Your Ulixai Password">
    <meta property="og:description" content="Forgot your password? No worries! Reset it securely in seconds.">
    <meta property="og:image" content="{{ asset('images/og-forgot-password.jpg') }}">
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
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Forgot Password - Ulixai",
      "description": "Secure password reset page for Ulixai. Recover your account access quickly and securely.",
      "url": "{{ url()->current() }}",
      "inLanguage": "en",
      "isPartOf": {
        "@type": "WebSite",
        "name": "Ulixai",
        "url": "{{ config('app.url') }}"
      }
    }
    </script>
</head>
<body>

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
          <div class="alert alert-success" role="alert">
            <span class="alert-icon">✅</span>
            <span>{{ session('status') }}</span>
          </div>
        @endif
        
        @if($errors->any())
          <div class="alert alert-error" role="alert">
            <span class="alert-icon">⚠️</span>
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
              <p id="error-email" class="error-msg" role="alert">{{ $message }}</p>
            @else
              <p id="error-email" class="error-msg" role="alert"></p>
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
          <a href="/login" class="back-link">
            <span class="back-icon">←</span>
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
    
    <div class="faq-grid">
      
      <!-- FAQ 1 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">❓</span>
          <span>How long does it take to receive the reset email?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Usually within a few seconds! Check your inbox and spam folder. The email contains a secure link to reset your password.</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🔒</span>
          <span>Is the password reset process secure?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Absolutely! We use industry-standard encryption and secure tokens. Your reset link expires after a certain time for maximum security.</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">📧</span>
          <span>What if I don't receive the email?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Check your spam/junk folder first. Make sure you entered the correct email address. You can request a new reset link anytime.</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">⏰</span>
          <span>How long is the reset link valid?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>For security reasons, the reset link is valid for 60 minutes. If it expires, simply request a new one - it's quick and easy!</p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🆘</span>
          <span>Need more help?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Contact our support team anytime! We're here to help you get back into your account safely and quickly. 💪</p>
        </div>
      </details>

    </div>
  </div>
</section>

<!-- Footer Links -->
<nav class="footer-links" aria-label="Footer navigation">
  <div class="links-nav">
    <a href="/privacy" class="footer-link">
      <span class="link-icon">🔒</span>
      <span>Privacy</span>
    </a>
    <span class="link-separator">•</span>
    <a href="/terms" class="footer-link">
      <span class="link-icon">📜</span>
      <span>Terms</span>
    </a>
    <span class="link-separator">•</span>
    <a href="/contact" class="footer-link">
      <span class="link-icon">💌</span>
      <span>Contact</span>
    </a>
  </div>
  <p class="footer-copyright">© 2024 Ulixai. All rights reserved.</p>
</nav>

<style>
*,*::before,*::after{
  box-sizing:border-box;
  margin:0;
  padding:0;
}

body{
  font-family:'Poppins',sans-serif;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  overflow-x:hidden;
}

/* Main Container */
.main-forgot{
  position:relative;
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:2rem 1rem;
  overflow:hidden;
}

/* Background Blobs */
.bg-layer{
  position:absolute;
  inset:0;
  z-index:0;
  background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 50%,#fef3c7 100%);
  overflow:hidden;
}

.blob{
  position:absolute;
  border-radius:50%;
  filter:blur(80px);
  opacity:0.5;
  animation:float 20s ease-in-out infinite;
}

.blob-1{
  width:400px;
  height:400px;
  background:linear-gradient(135deg,#06b6d4,#3b82f6);
  top:-10%;
  left:-10%;
  animation-delay:0s;
}

.blob-2{
  width:500px;
  height:500px;
  background:linear-gradient(135deg,#8b5cf6,#ec4899);
  bottom:-15%;
  right:-15%;
  animation-delay:5s;
}

.blob-3{
  width:350px;
  height:350px;
  background:linear-gradient(135deg,#f59e0b,#10b981);
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  animation-delay:10s;
}

@keyframes float{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(30px,-30px) scale(1.1)}
  66%{transform:translate(-30px,30px) scale(0.9)}
}

/* Container */
.container{
  position:relative;
  z-index:1;
  width:100%;
  max-width:28rem;
  margin:0 auto;
}

/* Card */
.forgot-card{
  position:relative;
  width:100%;
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(20px);
  border-radius:1.5rem;
  box-shadow:0 25px 50px -12px rgba(0,0,0,0.15);
  overflow:hidden;
}

.card-border{
  position:absolute;
  inset:0;
  border-radius:1.5rem;
  padding:2px;
  background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6);
  -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
  mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
  -webkit-mask-composite:xor;
  mask-composite:exclude;
  opacity:0.6;
  animation:borderGlow 3s ease-in-out infinite;
}

@keyframes borderGlow{
  0%,100%{opacity:0.6}
  50%{opacity:1}
}

.card-content{
  position:relative;
  padding:2rem 1.5rem;
}

/* Header */
.forgot-header{
  text-align:center;
  margin-bottom:2rem;
}

.brand-icon{
  display:flex;
  justify-content:center;
  margin-bottom:1.5rem;
}

.icon-container{
  width:5rem;
  height:5rem;
  background:linear-gradient(135deg,#06b6d4,#3b82f6);
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 10px 25px -5px rgba(6,182,212,0.4);
  animation:pulse 2s ease-in-out infinite;
}

@keyframes pulse{
  0%,100%{transform:scale(1)}
  50%{transform:scale(1.05)}
}

.icon-svg{
  width:2.5rem;
  height:2.5rem;
  color:#fff;
  stroke-width:2.5;
}

.main-title{
  font-size:2rem;
  font-weight:900;
  line-height:1.2;
  margin-bottom:0.75rem;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
  flex-wrap:wrap;
}

.title-text{
  background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.title-emoji{
  font-size:2rem;
  animation:bounce 2s ease-in-out infinite;
}

@keyframes bounce{
  0%,100%{transform:translateY(0)}
  50%{transform:translateY(-10px)}
}

.subtitle{
  font-size:1rem;
  color:#6b7280;
  font-weight:500;
  line-height:1.6;
}

/* Alerts */
.alert{
  display:flex;
  align-items:center;
  gap:0.75rem;
  padding:1rem 1.25rem;
  border-radius:0.75rem;
  margin-bottom:1.5rem;
  font-size:0.9375rem;
  font-weight:600;
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
  font-size:1.5rem;
  flex-shrink:0;
}

/* Form */
.forgot-form{
  margin-bottom:1.5rem;
}

.form-group{
  margin-bottom:1.5rem;
}

.form-label{
  display:flex;
  align-items:center;
  gap:0.5rem;
  font-size:0.9375rem;
  font-weight:700;
  color:#1f2937;
  margin-bottom:0.5rem;
}

.input-wrapper{
  position:relative;
}

.form-input{
  width:100%;
  padding:0.875rem 1rem;
  font-size:1rem;
  font-family:'Poppins',sans-serif;
  border:2px solid #e5e7eb;
  border-radius:0.75rem;
  outline:none;
  background:#fff;
  transition:all 0.3s ease;
}

.form-input:focus{
  border-color:#06b6d4;
  box-shadow:0 0 0 4px rgba(6,182,212,0.1);
}

.form-input.input-error{
  border-color:#ef4444;
  background:#fef2f2;
}

.input-glow{
  position:absolute;
  inset:0;
  border-radius:0.75rem;
  background:linear-gradient(135deg,#06b6d4,#3b82f6);
  opacity:0;
  filter:blur(10px);
  transition:opacity 0.3s ease;
  pointer-events:none;
  z-index:-1;
}

.form-input:focus ~ .input-glow{
  opacity:0.2;
}

.error-msg{
  display:block;
  margin-top:0.5rem;
  font-size:0.8125rem;
  color:#ef4444;
  font-weight:600;
  min-height:1.25rem;
}

/* Submit Button */
.submit-btn{
  position:relative;
  width:100%;
  padding:1rem;
  font-size:1.0625rem;
  font-weight:800;
  color:#fff;
  border:none;
  border-radius:0.75rem;
  cursor:pointer;
  overflow:hidden;
  transition:transform 0.2s ease;
}

.submit-btn:hover{
  transform:translateY(-2px);
}

.submit-btn:active{
  transform:translateY(0);
}

.submit-bg{
  position:absolute;
  inset:0;
  background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6);
  background-size:200% 200%;
  animation:gradientShift 3s ease infinite;
}

@keyframes gradientShift{
  0%{background-position:0% 50%}
  50%{background-position:100% 50%}
  100%{background-position:0% 50%}
}

.submit-text{
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
}

.submit-label{
  font-weight:800;
}

.submit-emoji{
  font-size:1.25rem;
}

/* Footer */
.card-footer{
  text-align:center;
  padding-top:1rem;
  border-top:1px solid #e5e7eb;
}

.back-link{
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
  font-size:0.9375rem;
  font-weight:700;
  color:#6b7280;
  text-decoration:none;
  transition:all 0.3s ease;
  padding:0.5rem 1rem;
  border-radius:0.5rem;
}

.back-link:hover{
  color:#06b6d4;
  background:rgba(6,182,212,0.1);
}

.back-icon{
  font-size:1.25rem;
  transition:transform 0.3s ease;
}

.back-link:hover .back-icon{
  transform:translateX(-4px);
}

.back-emoji{
  font-size:1rem;
}

/* FAQ Section */
.faq-section{
  padding:4rem 1rem;
  background:linear-gradient(to bottom,rgba(255,255,255,0.8),rgba(249,250,251,0.8));
  backdrop-filter:blur(10px);
}

.faq-title{
  text-align:center;
  font-size:2rem;
  font-weight:900;
  background:linear-gradient(135deg,#06b6d4,#3b82f6);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:2.5rem;
}

.faq-grid{
  max-width:50rem;
  margin:0 auto;
  display:flex;
  flex-direction:column;
  gap:1rem;
}

.faq-item{
  background:#fff;
  border:2px solid #e5e7eb;
  border-radius:1rem;
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
  gap:1rem;
  padding:1.25rem 1.5rem;
  cursor:pointer;
  list-style:none;
  font-size:1rem;
  font-weight:900;
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
  font-size:1.5rem;
  flex-shrink:0;
}

.faq-question span:nth-child(2){
  flex:1;
}

.faq-toggle{
  font-size:1.5rem;
  font-weight:900;
  color:#06b6d4;
  transition:transform 0.3s ease;
  flex-shrink:0;
}

.faq-item[open] .faq-toggle{
  transform:rotate(45deg);
}

.faq-answer{
  padding:0 1.5rem 1.5rem 4rem;
}

.faq-answer p{
  line-height:1.7;
  color:#4b5563;
  font-size:0.9375rem;
}

/* Footer Links */
.footer-links{
  padding:2rem 1rem 3rem;
  background:linear-gradient(to bottom,#fff,#f9fafb);
  border-top:1px solid #e5e7eb;
}

.links-nav{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.75rem;
  flex-wrap:wrap;
  margin-bottom:1rem;
}

.footer-link{
  display:inline-flex;
  align-items:center;
  gap:0.35rem;
  font-size:0.8125rem;
  font-weight:600;
  color:#6b7280;
  text-decoration:none;
  transition:color 0.3s ease;
  padding:0.25rem 0.5rem;
}

.footer-link:hover{
  color:#06b6d4;
}

.link-icon{
  font-size:0.875rem;
  opacity:0.7;
}

.link-separator{
  color:#d1d5db;
  font-size:0.75rem;
  user-select:none;
}

.footer-copyright{
  text-align:center;
  font-size:0.75rem;
  color:#9ca3af;
  font-weight:500;
}

/* Tablet */
@media (min-width:640px){
  .card-content{padding:2.5rem}
  .main-title{font-size:2.5rem}
  .subtitle{font-size:1.25rem}
}

/* Desktop */
@media (min-width:1024px){
  .container{max-width:50rem}
  .card-content{padding:3rem}
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
  .form-input:focus{border:4px solid #1e40af}
}
</style>

<!-- JavaScript -->
<script>
(function(){
  'use strict';
  
  const form=document.getElementById('forgotForm');
  const btn=document.getElementById('forgotBtnSubmit');
  
  // Real-time validation
  const emailInput=form.elements.email;
  emailInput.addEventListener('input',function(){
    const errorEl=document.getElementById('error-email');
    if(errorEl && this.value.trim()){
      errorEl.textContent='';
      this.classList.remove('input-error');
      this.setAttribute('aria-invalid','false');
    }
  });
  
  // Form submission validation
  form.addEventListener('submit',function(e){
    const errorEl=document.getElementById('error-email');
    if(errorEl)errorEl.textContent='';
    
    emailInput.classList.remove('input-error');
    emailInput.setAttribute('aria-invalid','false');
    
    let valid=true;
    const email=emailInput.value.trim();
    
    if(!email){
      showError('Email is required.');
      valid=false;
    }else if(!/^\S+@\S+\.\S+$/.test(email)){
      showError('Invalid email address.');
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