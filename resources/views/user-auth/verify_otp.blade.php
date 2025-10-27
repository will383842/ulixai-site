<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Verify Email - Ulixai",
      "description": "Email verification page for Ulixai. Enter your OTP code to confirm your email address.",
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
          <div class="logo-wrapper">
            <img src="/images/headerlogo.png" alt="ULIXAI Logo" class="logo-img" />
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
        <div id="otp_success" class="alert alert-success hidden" role="alert">
          <span class="alert-icon">✅</span>
          <span id="success_text"></span>
        </div>
        
        <div id="otp_error" class="alert alert-error hidden" role="alert">
          <span class="alert-icon">⚠️</span>
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
            <button id="resendOtpBtn" class="action-link resend-link">
              <span class="action-icon">🔄</span>
              <span>Resend Code</span>
            </button>
            <button id="cancelOtpBtn" class="action-link cancel-link">
              <span class="action-icon">❌</span>
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
    
    <div class="faq-grid">
      
      <!-- FAQ 1 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">📧</span>
          <span>Didn't receive the verification code?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Check your spam/junk folder! If you still don't see it, click the "Resend Code" button above. The email should arrive within a few seconds.</p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">⏰</span>
          <span>How long is the code valid?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Your verification code is valid for 10 minutes. If it expires, simply request a new one by clicking "Resend Code" - it's instant!</p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">🔐</span>
          <span>Why do I need to verify my email?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Email verification keeps your account secure and ensures you can recover it if needed. It only takes a moment and protects your privacy!</p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item">
        <summary class="faq-question">
          <span class="faq-icon">❌</span>
          <span>The code isn't working - what should I do?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer">
          <p>Make sure you're entering all 6 digits correctly. If the code has expired, request a new one. Still having issues? Contact our support team!</p>
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
          <p>Our support team is here for you 24/7! Contact us and we'll help you verify your email quickly. We're always happy to help! 💪</p>
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
.main-verify{
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
.verify-card{
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
.verify-header{
  text-align:center;
  margin-bottom:2rem;
}

.logo-wrapper{
  display:flex;
  justify-content:center;
  margin-bottom:1.5rem;
}

.logo-img{
  width:4rem;
  height:4rem;
  object-fit:contain;
  animation:pulse 2s ease-in-out infinite;
}

@keyframes pulse{
  0%,100%{transform:scale(1)}
  50%{transform:scale(1.05)}
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
  font-size:1.5rem;
  flex-shrink:0;
}

/* Form */
.verify-form{
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

.otp-input{
  text-align:center;
  font-size:1.5rem;
  letter-spacing:0.5rem;
  font-weight:700;
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

.submit-btn:disabled{
  opacity:0.6;
  cursor:not-allowed;
  transform:none;
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
  padding-top:1rem;
  border-top:1px solid #e5e7eb;
}

.action-buttons{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:1rem;
}

.action-link{
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
  font-size:0.9375rem;
  font-weight:700;
  text-decoration:none;
  transition:all 0.3s ease;
  padding:0.5rem 1rem;
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
  font-size:1.125rem;
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
document.addEventListener('DOMContentLoaded', function () {
  'use strict';
  
  const form = document.getElementById('verifyOtpForm');
  const verifyBtn = document.getElementById('verifyBtn');
  const resendBtn = document.getElementById('resendOtpBtn');
  const cancelBtn = document.getElementById('cancelOtpBtn');
  const otpError = document.getElementById('otp_error');
  const otpSuccess = document.getElementById('otp_success');
  const errorText = document.getElementById('error_text');
  const successText = document.getElementById('success_text');
  const emailInput = document.getElementById('verify_email');
  const otpInput = document.getElementById('verify_otp');

  // Prefill email if available
  const user = @json($user ?? []);
  if (user && user.email && emailInput) {
    emailInput.value = user.email;
  }

  // Only allow numbers in OTP input
  otpInput.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  // Form submission
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    otpError.classList.add('hidden');
    otpSuccess.classList.add('hidden');
    verifyBtn.disabled = true;

    const email = emailInput.value.trim();
    const otp = otpInput.value.trim();

    if (!email || !otp || otp.length !== 6) {
      errorText.textContent = "Please enter your email and the 6-digit code.";
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
        successText.textContent = data.message || "Email verified successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
        setTimeout(() => { window.location.href = '/dashboard'; }, 1500);
      } else {
        errorText.textContent = data.message || "Invalid code. Please try again.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      errorText.textContent = "Verification failed. Please try again.";
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
      errorText.textContent = "Please enter your email to resend OTP.";
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
        successText.textContent = data.message || "OTP resent successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
      } else {
        errorText.textContent = data.message || "Failed to resend OTP.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      errorText.textContent = "Failed to resend OTP. Please try again.";
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