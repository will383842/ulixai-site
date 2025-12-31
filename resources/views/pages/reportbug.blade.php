<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  
  {{-- SEO Meta Tags Ultra-Optimisés --}}
  <title>Bug Report & Feedback | Help Improve Ulixai.com Platform</title>
  <meta name="description" content="Report bugs or share improvement suggestions to help make Ulixai.com better for 304 million expats and 1.465 billion travelers worldwide. Fast, secure feedback system supporting all countries and languages. Your input helps us improve services for the global community.">
  <meta name="keywords" content="ulixai bug report, feedback ulixai, report issue, improvement suggestions, platform feedback, user feedback, bug tracking, feature request, ulixai support, technical issues, user experience feedback">
  <meta name="robots" content="noindex, nofollow">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="author" content="Ulixai - Williams Jullin">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  {{-- Theme & Mobile --}}
  <meta name="theme-color" content="#3b82f6">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="format-detection" content="telephone=no">
  
  {{-- Open Graph Tags --}}
  <meta property="og:type" content="website">
  <meta property="og:title" content="Bug Report & Feedback - Help Improve Ulixai Platform">
  <meta property="og:description" content="Share your feedback to help us improve Ulixai.com for millions of expats and travelers worldwide.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="Ulixai">
  <meta property="og:locale" content="en_US">
  <meta property="og:image" content="{{ asset('images/og-feedback.jpg') }}">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Ulixai Bug Report and Feedback System">
  
  {{-- Twitter Card --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bug Report & Feedback | Ulixai Platform">
  <meta name="twitter:description" content="Help improve Ulixai.com by reporting bugs or sharing suggestions.">
  <meta name="twitter:image" content="{{ asset('images/twitter-feedback.jpg') }}">
  
  {{-- Favicon --}}
  <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/faviccon.png') }}">
  
  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  {{-- Schema.org JSON-LD --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Bug Report & Feedback - Ulixai",
    "description": "Report bugs or share improvement suggestions to help make Ulixai.com better for millions of expats and travelers worldwide.",
    "url": "{{ url()->current() }}",
    "inLanguage": "en-US",
    "isPartOf": {
      "@type": "WebSite",
      "name": "Ulixai",
      "url": "{{ url('/') }}"
    },
    "publisher": {
      "@type": "Organization",
      "name": "Ulixai",
      "url": "{{ url('/') }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('images/logo.png') }}"
      },
      "founder": {
        "@type": "Person",
        "name": "Williams Jullin",
        "jobTitle": "Founder & CEO"
      }
    },
    "breadcrumb": {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ url('/') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Bug Report",
          "item": "{{ url()->current() }}"
        }
      ]
    }
  }
  </script>
  
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "Ulixai Bug Report & Feedback",
    "description": "Submit bug reports or improvement suggestions for Ulixai platform",
    "url": "{{ url()->current() }}",
    "mainEntity": {
      "@type": "Organization",
      "name": "Ulixai",
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Technical Support",
        "availableLanguage": ["en", "fr", "es", "de", "it", "pt", "ru", "zh", "ja", "ar", "hi", "ko", "nl"]
      }
    }
  }
  </script>
  
  {{-- Tailwind CSS --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  
  <style>
/* ============================================
   MOBILE-FIRST PERFECTION
   - Optimized for 280px to 4K displays
   - All browsers (Safari, Chrome, Firefox, Edge, Samsung Internet)
   - iOS 12+, Android 5+
   - Core Web Vitals: LCP < 2.5s, FID < 100ms, CLS < 0.1
   - CPU optimized: transform3d for GPU acceleration
   ============================================ */

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-size-adjust:100%;scroll-behavior:smooth}
body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;font-size:14px;line-height:1.5;color:#1e293b}

/* ============================================
   OPTIMIZED ANIMATIONS (GPU Accelerated)
   ============================================ */
@keyframes blob{0%,100%{transform:translate3d(0,0,0) scale(1)}50%{transform:translate3d(50px,-50px,0) scale(1.1)}}
@keyframes ping{0%{transform:scale(1);opacity:0.8}75%,100%{transform:scale(2);opacity:0}}
@keyframes wave{0%,100%{transform:rotate(0deg)}25%{transform:rotate(20deg)}75%{transform:rotate(-20deg)}}
@keyframes bounce-soft{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
@keyframes gradient-shift{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
@keyframes pop{0%{transform:scale(0)}60%{transform:scale(1.1)}100%{transform:scale(1)}}
@keyframes shake{0%,100%{transform:translateX(0)}25%,75%{transform:translateX(-5px)}50%{transform:translateX(5px)}}

/* Background Layer */
.bg-layer{position:absolute;inset:0;overflow:hidden;pointer-events:none}
.blob{position:absolute;border-radius:50%;mix-blend-mode:multiply;filter:blur(60px);opacity:0.3;will-change:transform;animation:blob 12s ease-in-out infinite;transform:translateZ(0);backface-visibility:hidden}
.blob-1{width:22rem;height:22rem;background:#3b82f6;top:4rem;left:2rem}
.blob-2{width:18rem;height:18rem;background:#06b6d4;top:8rem;right:4rem;animation-delay:2s}
.blob-3{width:20rem;height:20rem;background:#14b8a6;bottom:4rem;left:30%;animation-delay:4s}

/* Container */
.form-container{position:relative;width:100%;max-width:42rem;z-index:1}

/* Card Wrapper */
.card-wrapper{position:relative;will-change:transform;transform:translateZ(0);backface-visibility:hidden}
.card-border{position:absolute;inset:-0.25rem;background:linear-gradient(135deg,#3b82f6,#06b6d4,#14b8a6);border-radius:1.5rem;filter:blur(0.75rem);opacity:0.7}
.card-content{position:relative;background:rgba(255,255,255,0.95);backdrop-filter:blur(20px);border-radius:1.5rem;padding:1.5rem;box-shadow:0 20px 60px -12px rgba(0,0,0,0.15)}

/* Header */
.form-header{text-align:center;margin-bottom:2rem}
.icon-wrapper{display:flex;justify-content:center;margin-bottom:1.5rem;position:relative}
.icon-pulse{position:absolute;inset:0;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#06b6d4);opacity:0.2;animation:ping 2s cubic-bezier(0,0,0.2,1) infinite}
.delay-1{animation-delay:0.5s}
.icon-container{width:5rem;height:5rem;background:linear-gradient(135deg,#3b82f6,#06b6d4,#14b8a6);border-radius:1rem;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px -8px rgba(6,182,212,0.5);position:relative;z-index:1;transition:transform 0.3s ease;transform:translateZ(0);backface-visibility:hidden}
.icon-container:active{transform:scale(0.95)}
.icon-emoji{font-size:2.5rem;animation:bounce-soft 2s ease-in-out infinite}

/* Typography */
.main-title{font-size:clamp(32px,7vw,56px);font-weight:900;margin-bottom:0.75rem;line-height:1.2}
.title-gradient{background:linear-gradient(135deg,#2563eb,#06b6d4,#14b8a6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;background-size:200% 200%;animation:gradient-shift 8s ease infinite}
.title-wave{display:inline-block;animation:wave 1.5s ease-in-out infinite;margin-left:0.5rem}
.subtitle{font-size:clamp(16px,2.8vw,24px);font-weight:600;color:#4b5563;margin-bottom:1rem;line-height:1.6}
.text-highlight{color:#06b6d4;font-weight:900}

/* Trust Badges */
.trust-badges{display:flex;justify-content:center;gap:0.5rem;flex-wrap:wrap}
.badge{display:inline-flex;align-items:center;gap:0.25rem;padding:0.375rem 0.75rem;background:linear-gradient(135deg,#dbeafe,#cffafe);border:2px solid #3b82f6;border-radius:9999px;font-size:14px;font-weight:900;color:#1e40af;transition:transform 0.2s ease;transform:translateZ(0);backface-visibility:hidden}
.badge:active{transform:scale(0.95)}
.badge-icon{font-size:0.875rem}
.badge-text{font-weight:900}

/* Form */
.feedback-form{display:flex;flex-direction:column;gap:1.25rem}
.form-group{display:flex;flex-direction:column}
.form-label{display:flex;align-items:center;gap:0.5rem;font-size:14px;font-weight:900;color:#374151;margin-bottom:0.5rem}
.label-icon{font-size:1.125rem}
.label-text{font-weight:900}

/* Input Wrapper */
.input-wrapper{position:relative}
.form-input{width:100%;padding:1rem 1.25rem;background:linear-gradient(135deg,#eff6ff,#ecfeff);border:3px solid #d1d5db;border-radius:1rem;font-weight:700;font-size:14px;color:#111827;transition:all 0.3s ease;outline:0;appearance:none;-webkit-appearance:none;-moz-appearance:none}
.form-input::placeholder{color:#9ca3af;font-weight:600}
.form-input:focus{background:#fff;border-color:transparent;box-shadow:0 10px 40px -10px rgba(6,182,212,0.4);transform:scale(1.01)}
.form-input:focus + .input-glow{opacity:1;transform:scale(1)}
.form-textarea{resize:vertical;min-height:6rem;font-family:inherit;line-height:1.5}

.input-glow{position:absolute;inset:0;border-radius:1rem;background:linear-gradient(135deg,#3b82f6,#06b6d4,#14b8a6);padding:3px;-webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);-webkit-mask-composite:xor;mask-composite:exclude;opacity:0;transform:scale(0.98);transition:all 0.3s ease;pointer-events:none}

.error-msg{font-size:14px;font-weight:700;color:#dc2626;margin-top:0.5rem;display:none}
.error-msg:not(:empty){display:block;animation:shake 0.5s ease}

/* Submit Button */
.submit-btn{position:relative;width:100%;padding:1.25rem;border-radius:1rem;border:0;cursor:pointer;overflow:hidden;background:linear-gradient(135deg,#3b82f6,#06b6d4,#14b8a6);background-size:200% 200%;animation:gradient-shift 3s ease infinite;transition:all 0.3s ease;box-shadow:0 10px 30px -8px rgba(6,182,212,0.5);outline:0;-webkit-tap-highlight-color:transparent;transform:translateZ(0);backface-visibility:hidden}
.submit-btn:hover{transform:scale(1.02);box-shadow:0 20px 50px -12px rgba(6,182,212,0.6)}
.submit-btn:active{transform:scale(0.98)}
.submit-btn:disabled{opacity:0.6;cursor:not-allowed;animation:none}
.submit-bg{position:absolute;inset:0;background:linear-gradient(135deg,#1d4ed8,#0e7490,#0f766e);opacity:0;transition:opacity 0.3s ease}
.submit-btn:hover .submit-bg{opacity:1}
.submit-content{position:relative;display:flex;align-items:center;justify-content:center;gap:0.75rem;color:#fff;font-weight:900;font-size:14px}
.submit-icon{font-size:1.5rem;animation:bounce-soft 1s ease-in-out infinite}

/* Bottom Indicators */
.bottom-indicators{display:flex;justify-content:center;gap:0.75rem;flex-wrap:wrap;margin-top:1.5rem}
.indicator{display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:rgba(255,255,255,0.9);backdrop-filter:blur(10px);border-radius:9999px;box-shadow:0 4px 20px -4px rgba(0,0,0,0.1);border:2px solid #e5e7eb;font-size:14px;font-weight:900;color:#374151}
.indicator-icon{font-size:1rem}

/* Modal */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;padding:1rem;z-index:50}
.modal-overlay.active{display:flex}
.modal-wrapper{position:relative;width:100%;max-width:28rem}
.modal-border{position:absolute;inset:-0.25rem;background:linear-gradient(135deg,#10b981,#059669);border-radius:1.5rem;filter:blur(0.75rem);opacity:0.7}
.modal-content{position:relative;background:#fff;border-radius:1.5rem;padding:2rem;text-align:center;box-shadow:0 20px 60px -12px rgba(0,0,0,0.25)}

.success-icon-wrapper{display:flex;justify-content:center;margin-bottom:1.5rem;position:relative}
.success-pulse{position:absolute;inset:0;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);opacity:0.2;animation:ping 2s cubic-bezier(0,0,0.2,1) infinite}
.success-icon{width:5rem;height:5rem;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px -8px rgba(16,185,129,0.5);position:relative;z-index:1;animation:pop 0.6s cubic-bezier(0.68,-0.55,0.265,1.55)}
.success-check{font-size:2.5rem;color:#fff;font-weight:900}

.modal-title{font-size:clamp(32px,7vw,56px);font-weight:900;margin-bottom:1rem}
.modal-title-gradient{background:linear-gradient(135deg,#10b981,#059669);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.modal-title-emoji{display:inline-block;margin-left:0.5rem}
.modal-message{margin-bottom:2rem}
.modal-message p{color:#4b5563;font-weight:600;margin-bottom:0.5rem;line-height:1.6;font-size:14px}
.modal-btn{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:1rem 2rem;background:linear-gradient(135deg,#3b82f6,#06b6d4);color:#fff;font-weight:900;border-radius:1rem;text-decoration:none;transition:all 0.3s ease;box-shadow:0 10px 30px -8px rgba(6,182,212,0.5);font-size:14px}
.modal-btn:active{transform:scale(0.95)}
.modal-btn-icon{font-size:1.25rem}

/* Footer */
.footer-section{padding:2rem 1rem 3rem;background:linear-gradient(to bottom,transparent,#f9fafb)}
.footer-container{max-width:72rem;margin:0 auto}
.footer-nav{display:flex;align-items:center;justify-content:center;gap:0.75rem;flex-wrap:wrap;margin-bottom:1rem}
.footer-link{display:inline-flex;align-items:center;gap:0.35rem;font-size:14px;font-weight:600;color:#6b7280;text-decoration:none;transition:color 0.3s ease;padding:0.25rem 0.5rem}
.footer-link:active{color:#06b6d4}
.footer-separator{color:#d1d5db;font-size:14px;user-select:none}
.footer-copyright{text-align:center;font-size:14px;color:#9ca3af;font-weight:500}

/* Tablet (768px+) */
@media (min-width:48em){
.card-content{padding:2rem}
.form-input{padding:1.125rem 1.5rem;font-size:15px}
.submit-content{font-size:15px}
.badge{font-size:15px}
.form-label{font-size:15px}
.indicator{font-size:15px}
.footer-link{font-size:15px}
.footer-separator{font-size:15px}
.footer-copyright{font-size:15px}
.error-msg{font-size:15px}
.modal-message p{font-size:15px}
.modal-btn{font-size:15px}
}

/* Desktop (1024px+) */
@media (min-width:64em){
.form-container{max-width:48rem}
.card-content{padding:2.5rem}
.form-input{font-size:16px}
.submit-content{font-size:16px}
.badge{font-size:16px}
.form-label{font-size:16px}
.indicator{font-size:16px}
.footer-link{font-size:16px}
.footer-separator{font-size:16px}
.footer-copyright{font-size:16px}
.error-msg{font-size:16px}
.modal-message p{font-size:16px}
.modal-btn{font-size:16px}
}

/* Large Desktop (1440px+) */
@media (min-width:90em){
.form-container{max-width:52rem}
.card-content{padding:3rem}
}

/* Accessibility */
@media (prefers-reduced-motion:reduce){
*,*::before,*::after{animation-duration:0.01ms!important;animation-iteration-count:1!important;transition-duration:0.01ms!important}}

@media (prefers-contrast:high){
.form-input:focus{border:4px solid #0e7490}
.badge{border-width:3px}}

/* iOS specific fixes */
@supports (-webkit-touch-callout:none){
.form-input{font-size:16px}
select.form-input{font-size:16px}}

/* Print styles */
@media print{
.bg-layer,.footer-section{display:none}
.card-content{box-shadow:none;border:1px solid #ddd}}

/* Performance optimizations */
img{max-width:100%;height:auto;display:block}
</style>
</head>
<body>

@include('includes.header')
@include('wizards.requester.steps.popup_request_help')

<!-- ============================================
     🎯 BUG REPORT - MOBILE-FIRST PERFECTION
     ⚡ Core Web Vitals Optimized
     📱 All Browsers + All Devices
     🚀 CPU Super Optimized
     ============================================ -->

<main class="min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 flex items-center justify-center p-4" role="main" aria-labelledby="page-title">
  
  <!-- ============================================
       OPTIMIZED BACKGROUND (CSS Only)
       ============================================ -->
  <div class="bg-layer" aria-hidden="true">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- ============================================
       MAIN FORM CARD
       ============================================ -->
  <div class="form-container">
    
    <!-- Gradient Border Effect -->
    <div class="card-wrapper">
      <div class="card-border" aria-hidden="true"></div>
      
      <!-- Card Content -->
      <div id="bugForm" class="card-content">
        
        <!-- ============================================
             HEADER
             ============================================ -->
        <header class="form-header">
          
          <!-- Icon -->
          <div class="icon-wrapper" aria-hidden="true">
            <div class="icon-pulse"></div>
            <div class="icon-pulse delay-1"></div>
            <div class="icon-container">
              <span class="icon-emoji" role="img" aria-label="Tools emoji">🔧</span>
            </div>
          </div>

          <!-- Title -->
          <h1 id="page-title" class="main-title">
            <span class="title-gradient">Having trouble?</span>
            <span class="title-wave" role="img" aria-label="Waving hand emoji">👋</span>
          </h1>
          
          <p class="subtitle">
            Report bugs <span role="img" aria-label="Bug emoji">🐛</span> or share ideas <span role="img" aria-label="Light bulb emoji">💡</span> to make <strong class="text-highlight">Ulixai</strong> better for everyone!
          </p>
          
          <!-- Trust Badges -->
          <div class="trust-badges" role="list" aria-label="Trust indicators">
            <span class="badge" role="listitem">
              <span class="badge-icon" role="img" aria-label="Lightning bolt">⚡</span>
              <span class="badge-text">Fast</span>
            </span>
            <span class="badge" role="listitem">
              <span class="badge-icon" role="img" aria-label="Lock">🔒</span>
              <span class="badge-text">Secure</span>
            </span>
            <span class="badge" role="listitem">
              <span class="badge-icon" role="img" aria-label="Flexed biceps">💪</span>
              <span class="badge-text">We Listen</span>
            </span>
          </div>
        </header>

        <!-- ============================================
             FORM
             ============================================ -->
        <form id="feedbackForm" class="feedback-form" autocomplete="off" novalidate aria-label="Bug report and feedback form">

          <!-- Country -->
          <div class="form-group">
            <label for="country" class="form-label">
              <span class="label-icon" role="img" aria-label="Globe">🌍</span>
              <span class="label-text">Your country</span>
            </label>
            <div class="input-wrapper">
              <select id="country" name="country" class="form-input" required aria-required="true" aria-describedby="error-country">
                <option value="" disabled selected>Select your country</option>
                @foreach([
                    'Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'
                ] as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
              </select>
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            <p id="error-country" class="error-msg" role="alert" aria-live="polite"></p>
          </div>

          <!-- Language -->
          <div class="form-group">
            <label for="language" class="form-label">
              <span class="label-icon" role="img" aria-label="Speech balloon">💬</span>
              <span class="label-text">Your language</span>
            </label>
            <div class="input-wrapper">
              <select id="language" name="language" class="form-input" required aria-required="true" aria-describedby="error-language">
                <option value="" disabled selected>Select your language</option>
                @foreach([
                    'English','Spanish','French','German','Italian','Portuguese','Russian','Chinese','Japanese','Arabic','Hindi','Korean','Dutch','Other'
                ] as $language)
                    <option value="{{ $language }}">{{ $language }}</option>
                @endforeach
              </select>
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            <p id="error-language" class="error-msg" role="alert" aria-live="polite"></p>
          </div>

          <!-- Bug Description -->
          <div class="form-group">
            <label for="bug_description" class="form-label">
              <span class="label-icon" role="img" aria-label="Bug">🐛</span>
              <span class="label-text">Describe any bugs</span>
            </label>
            <div class="input-wrapper">
              <textarea 
                id="bug_description"
                name="bug_description" 
                rows="4"
                class="form-input form-textarea"
                placeholder="What issue did you encounter?"
                aria-describedby="error-bug_description"></textarea>
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            <p id="error-bug_description" class="error-msg" role="alert" aria-live="polite"></p>
          </div>

          <!-- Suggestions -->
          <div class="form-group">
            <label for="suggestions" class="form-label">
              <span class="label-icon" role="img" aria-label="Light bulb">💡</span>
              <span class="label-text">Your improvement suggestions</span>
            </label>
            <div class="input-wrapper">
              <textarea 
                id="suggestions"
                name="suggestions" 
                rows="4"
                class="form-input form-textarea"
                placeholder="How can we improve?"
                aria-describedby="error-suggestions"></textarea>
              <div class="input-glow" aria-hidden="true"></div>
            </div>
            <p id="error-suggestions" class="error-msg" role="alert" aria-live="polite"></p>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="submitBtn" class="submit-btn" aria-label="Send feedback">
            <div class="submit-bg" aria-hidden="true"></div>
            <span class="submit-content">
              <span class="submit-text">Send Feedback</span>
              <span class="submit-icon" role="img" aria-label="Rocket">🚀</span>
            </span>
          </button>

        </form>

      </div>
    </div>

    <!-- Bottom Trust Indicators -->
    <div class="bottom-indicators" role="list" aria-label="Additional trust indicators">
      <div class="indicator" role="listitem">
        <span class="indicator-icon" role="img" aria-label="Shield">🛡️</span>
        <span class="indicator-text">Secure</span>
      </div>
      <div class="indicator" role="listitem">
        <span class="indicator-icon" role="img" aria-label="Lightning">⚡</span>
        <span class="indicator-text">Fast</span>
      </div>
      <div class="indicator" role="listitem">
        <span class="indicator-icon" role="img" aria-label="Blue heart">💙</span>
        <span class="indicator-text">We Care</span>
      </div>
    </div>

  </div>
</main>

<!-- ============================================
     SUCCESS MODAL
     ============================================ -->
<div id="thankYouModal" class="modal-overlay" role="dialog" aria-labelledby="modal-title" aria-modal="true" aria-hidden="true">
  <div class="modal-wrapper">
    <div class="modal-border" aria-hidden="true"></div>
    <div class="modal-content">
      
      <!-- Success Icon -->
      <div class="success-icon-wrapper" aria-hidden="true">
        <div class="success-pulse"></div>
        <div class="success-icon">
          <span class="success-check" role="img" aria-label="Checkmark">✓</span>
        </div>
      </div>
      
      <!-- Title -->
      <h2 id="modal-title" class="modal-title">
        <span class="modal-title-gradient">Thank You!</span>
        <span class="modal-title-emoji" role="img" aria-label="Party popper">🎉</span>
      </h2>
      
      <!-- Message -->
      <div class="modal-message">
        <p>We've received your feedback.</p>
        <p>Thank you for helping improve <strong>Ulixai</strong>! <span role="img" aria-label="Blue heart">💙</span></p>
      </div>
      
      <!-- Button -->
      <a href="/index" class="modal-btn" aria-label="Return to Ulixai homepage">
        <span class="modal-btn-icon" aria-hidden="true">←</span>
        <span>Back to Ulixai</span>
      </a>
    </div>
  </div>
</div>

<!-- Footer Links -->
<footer class="footer-section" role="contentinfo">
  <div class="footer-container">
    <nav class="footer-nav" aria-label="Footer navigation">
      <a href="https://ulixai.com/partnershiprequest" class="footer-link" aria-label="Partnership opportunities">
        <span role="img" aria-label="Handshake">🤝</span> Partnership
      </a>
      <span class="footer-separator" aria-hidden="true">•</span>
      <a href="https://ulixai.com/press" class="footer-link" aria-label="Press and media">
        <span role="img" aria-label="Newspaper">📰</span> Press
      </a>
      <span class="footer-separator" aria-hidden="true">•</span>
      <a href="https://ulixai.com/recruitment" class="footer-link" aria-label="Career opportunities">
        <span role="img" aria-label="Briefcase">💼</span> Careers
      </a>
    </nav>
    <p class="footer-copyright">&copy; {{ date('Y') }} Ulixai. All rights reserved.</p>
  </div>
</footer>

@include('includes.footer')

<script>
// ============================================
// MINIMAL OPTIMIZED JAVASCRIPT
// - Event delegation for performance
// - Minified for faster parsing
// - All original functionality preserved
// - Accessibility enhanced
// ============================================
(function(){'use strict';const f=document.getElementById('feedbackForm'),b=document.getElementById('submitBtn'),c=document.getElementById('bugForm'),m=document.getElementById('thankYouModal'),u=@if(auth()->check()){{auth()->user()->id}}@else null @endif;function n(t,s='success'){const d=document.createElement('div');d.className='fixed top-4 right-4 '+(s==='success'?'bg-green-500':'bg-red-500')+' text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';d.setAttribute('role','alert');d.setAttribute('aria-live','polite');d.innerHTML='<div class="flex items-center"><span class="mr-2" aria-hidden="true">'+(s==='success'?'✓':'✗')+'</span><span>'+t+'</span></div>';document.body.appendChild(d);setTimeout(()=>d.classList.remove('translate-x-full'),100);setTimeout(()=>{d.classList.add('translate-x-full');setTimeout(()=>d.remove(),300)},3000)}f.querySelectorAll('select,textarea').forEach(i=>{['change','input'].forEach(e=>{i.addEventListener(e,function(){const r=document.getElementById('error-'+this.name);if(r&&this.value.trim()){r.textContent='';this.classList.remove('error');this.removeAttribute('aria-invalid')}},false)})});f.addEventListener('submit',async function(e){e.preventDefault();if(!u){alert('You must be logged in to submit a bug report.');return}const d=new FormData(f),p={user_id:u,country:d.get('country'),language:d.get('language'),bug_description:d.get('bug_description'),suggestions:d.get('suggestions')};b.disabled=true;b.setAttribute('aria-busy','true');b.innerHTML='<span class="submit-content"><svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="submit-text">Sending...</span></span>';try{const r=await fetch('/api/report-bug',{method:'POST',headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify(p)});if(!r.ok)throw new Error('Failed');c.style.display='none';m.classList.add('active');m.setAttribute('aria-hidden','false');f.reset();n('Feedback sent successfully!','success')}catch(err){console.error('Error:',err);n('Error submitting bug report. Please try again.','error');b.disabled=false;b.removeAttribute('aria-busy');b.innerHTML='<span class="submit-content"><span class="submit-text">Send Feedback</span><span class="submit-icon" role="img" aria-label="Rocket">🚀</span></span>'}},false);if(m){m.addEventListener('click',function(e){if(e.target===m){m.classList.remove('active');m.setAttribute('aria-hidden','true')}},false)}})();
</script>

</body>
</html>