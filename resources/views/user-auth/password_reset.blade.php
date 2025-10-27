<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    <meta property="og:title" content="Reset Your Ulixai Password">
    <meta property="og:description" content="Create a new secure password for your account.">
    <meta property="og:image" content="{{ asset('images/og-reset-password.jpg') }}">
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
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Reset Password - Ulixai",
      "description": "Secure password reset completion page for Ulixai. Create a new password and regain access to your account.",
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
          <div class="alert alert-error" role="alert">
            <span class="alert-icon">⚠️</span>
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
            <p id="error-password" class="error-msg" role="alert"></p>
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
            <p id="error-password-confirmation" class="error-msg" role="alert"></p>
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
    
    <h2 id="faq-title" class="faq-title">Password Security Tips 🛡️</h2>
    
    <div class="faq-grid">
      
      <!-- FAQ 1 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🔐</span>
          <span>What makes a strong password?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Use at least 8 characters with a mix of uppercase, lowercase, numbers, and symbols. Avoid common words or personal info like birthdays!</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">💡</span>
          <span>Should I use the same password everywhere?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Never! Use unique passwords for each account. Consider using a password manager to keep track of them securely.</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🔄</span>
          <span>How often should I change my password?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Change it every 3-6 months, or immediately if you suspect your account has been compromised. Better safe than sorry!</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">⚡</span>
          <span>What happens after I reset my password?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>You'll be redirected to login with your new password. All your data and settings remain intact - only your password changes!</p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🆘</span>
          <span>Still having trouble?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Our support team is here to help! Contact us anytime and we'll get you back into your account safely. 💪</p>
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
.main-reset{
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
.reset-card{
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
.reset-header{
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

/* Alert */
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
.reset-form{
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
  padding:0.875rem 3rem 0.875rem 1rem;
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

.toggle-password{
  position:absolute;
  right:0.75rem;
  top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  cursor:pointer;
  padding:0.5rem;
  font-size:1.25rem;
  transition:transform 0.2s ease;
}

.toggle-password:hover{
  transform:translateY(-50%) scale(1.1);
}

.eye-icon{
  display:block;
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
  
  const form=document.getElementById('resetPasswordForm');
  const btn=document.getElementById('resetBtnSubmit');
  const passwordInput=document.getElementById('password');
  const confirmInput=document.getElementById('password_confirmation');
  
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
    }else{
      input.type='password';
      icon.textContent='👁️';
    }
  });
  
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
      showError('password','Password is required.');
      valid=false;
    }else if(password.length<6){
      showError('password','Password must be at least 6 characters.');
      valid=false;
    }
    
    if(!confirm){
      showError('password-confirmation','Please confirm your password.');
      valid=false;
    }else if(password!==confirm){
      showError('password-confirmation','Passwords do not match.');
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
    if(inputEl && inputEl.classList){
      inputEl.classList.add('input-error');
      inputEl.setAttribute('aria-invalid','true');
    }
  }
})();
</script>

@include('includes.footer')

</body>
</html>