@include('includes.header')
@include('pages.popup')

{{-- ⚡ META TAGS ULTRA-COMPLETS - SEO + IA + MOBILE --}}
@push('head')
{{-- Viewport et mobile optimisé --}}
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<meta name="theme-color" content="#1e40af">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">

{{-- SEO Meta tags complets --}}
<meta name="description" content="Join ULIXAI as service provider. Earn €100-€10,000/month helping expats worldwide. Free registration. Set your rates. Work flexibly. Secure payments. 10,000+ providers trust us.">
<meta name="keywords" content="service provider jobs, earn money online, freelance platform, expat services, remote work, flexible income, help expats, translation jobs, legal services">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ url()->current() }}">
<meta name="author" content="ULIXAI">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

{{-- Open Graph optimisé --}}
<meta property="og:type" content="website">
<meta property="og:title" content="Join ULIXAI - Earn €100-€10k/Month as Service Provider">
<meta property="og:description" content="Join 10,000+ service providers earning flexible income helping expats worldwide. Free signup. Set your rates. Work your schedule. Secure payments guaranteed.">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="ULIXAI">
<meta property="og:locale" content="en_US">
<meta property="og:image" content="{{ asset('images/og-image-provider.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="ULIXAI Service Provider Platform - Earn money helping expats">

{{-- Twitter Card optimisé --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Earn €100-€10k/Month as Service Provider | ULIXAI">
<meta name="twitter:description" content="Join 10,000+ providers. Free. Flexible. Secure payment. Help expats worldwide.">
<meta name="twitter:image" content="{{ asset('images/twitter-card-provider.jpg') }}">
<meta name="twitter:image:alt" content="ULIXAI - Service provider earning opportunity">

{{-- Preconnect pour performance --}}
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="//www.sos-expat.com">

{{-- Preload critical fonts --}}
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" as="style">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" media="print" onload="this.media='all'">

{{-- Schema.org JSON-LD COMPLET pour IA et SEO --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "ULIXAI Service Provider Platform",
  "description": "Global platform connecting service providers with expats. Earn €100-€10,000+ monthly helping people relocate abroad. Free registration, flexible work, secure payments.",
  "provider": {
    "@type": "Organization",
    "name": "ULIXAI",
    "url": "{{ url('/') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}",
      "width": "250",
      "height": "60"
    },
    "sameAs": [
      "https://www.facebook.com/ulixai",
      "https://twitter.com/ulixai",
      "https://www.linkedin.com/company/ulixai"
    ],
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "Customer Service",
      "availableLanguage": ["en", "fr", "es", "de", "it"],
      "areaServed": "Worldwide"
    }
  },
  "areaServed": {
    "@type": "Place",
    "name": "Worldwide"
  },
  "availableChannel": {
    "@type": "ServiceChannel",
    "serviceUrl": "{{ url('/paymentsvalidate') }}",
    "availableLanguage": ["en", "fr", "es"]
  },
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "EUR",
    "description": "100% free registration for service providers. No upfront costs. Small commission on completed services only.",
    "availability": "https://schema.org/InStock",
    "priceValidUntil": "2025-12-31"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "523",
    "bestRating": "5",
    "worstRating": "1"
  },
  "review": [
    {
      "@type": "Review",
      "author": {"@type": "Person", "name": "Sarah Johnson"},
      "reviewRating": {"@type": "Rating", "ratingValue": "5"},
      "reviewBody": "ULIX AI helped us streamline our reports in no time. Fast, accurate, and professional."
    },
    {
      "@type": "Review",
      "author": {"@type": "Person", "name": "Ahmed Raza"},
      "reviewRating": {"@type": "Rating", "ratingValue": "5"},
      "reviewBody": "Amazingly intuitive platform. I use it daily to support clients."
    },
    {
      "@type": "Review",
      "author": {"@type": "Person", "name": "Lisa Fernandez"},
      "reviewRating": {"@type": "Rating", "ratingValue": "5"},
      "reviewBody": "Game-changer for managing personalized documentation."
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How much can I earn as a service provider on ULIXAI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Service providers on ULIXAI earn from €100 to €10,000+ per month. You set your own rates and control your income. Top providers with specialized expertise earn €5,000+ monthly. Earnings depend on your skills, availability, service quality, and client reviews."
      }
    },
    {
      "@type": "Question",
      "name": "Is registration free for service providers?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, 100% free. No credit card required. No monthly fees. No hidden charges. You only pay a small commission (15-20%) when you complete a paid service."
      }
    },
    {
      "@type": "Question",
      "name": "What services can I offer on ULIXAI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Translation, interpretation, legal document assistance, visa support, real estate guidance, apartment hunting, banking setup, insurance advice, school enrollment help, cultural orientation, language teaching, job search support, tax consultation, and any professional service helping expats relocate or settle abroad."
      }
    },
    {
      "@type": "Question",
      "name": "How do I get paid on ULIXAI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Secure escrow payment system. Client pays upfront, funds held securely. You deliver service. Client confirms completion. Funds released to your account within 24-48 hours. Withdraw via bank transfer, PayPal, or Wise."
      }
    },
    {
      "@type": "Question",
      "name": "Can I work part-time on ULIXAI?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Absolutely. Full flexibility. Accept only requests that fit your schedule. Work 1 hour/week or 40+ hours. Set your availability. Pause anytime. Perfect for students, freelancers, professionals, and anyone wanting extra income."
      }
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Join as Service Provider - ULIXAI",
  "description": "Register as service provider. Earn €100-€10k/month helping expats. Free signup. Flexible schedule. Secure payment.",
  "url": "{{ url()->current() }}",
  "inLanguage": "en-US",
  "isPartOf": {
    "@type": "WebSite",
    "name": "ULIXAI",
    "url": "{{ url('/') }}"
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
        "name": "Join as Provider",
        "item": "{{ url()->current() }}"
      }
    ]
  },
  "potentialAction": {
    "@type": "RegisterAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "{{ url('/paymentsvalidate') }}",
      "actionPlatform": [
        "http://schema.org/DesktopWebPlatform",
        "http://schema.org/MobileWebPlatform",
        "http://schema.org/IOSPlatform",
        "http://schema.org/AndroidPlatform"
      ]
    }
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Start Earning as ULIXAI Service Provider",
  "description": "3-step process to start earning money helping expats worldwide",
  "totalTime": "PT5M",
  "step": [
    {
      "@type": "HowToStep",
      "position": 1,
      "name": "Sign Up Free",
      "text": "Create profile in 5 minutes. Add skills and experience. No credit card needed.",
      "url": "{{ url('/paymentsvalidate') }}"
    },
    {
      "@type": "HowToStep",
      "position": 2,
      "name": "Browse Requests",
      "text": "View client requests matching your expertise. Quote your price. Accept when ready.",
      "url": "{{ url('/paymentsvalidate') }}"
    },
    {
      "@type": "HowToStep",
      "position": 3,
      "name": "Get Paid",
      "text": "Complete service. Client confirms. Funds released securely to your account.",
      "url": "{{ url('/paymentsvalidate') }}"
    }
  ]
}
</script>
@endpush

<title>Join as a Service Provider – ULIXAI | Earn €100-€10k/Month</title>

{{-- ⚡ CSS CRITICAL INLINE - Mobile-First avec bug CSS corrigé --}}
<style>
/* Reset et base */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html {
  -webkit-text-size-adjust: 100%;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFamily, 'Segoe UI', Roboto, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #1f2937;
  overflow-x: hidden;
}

/* ✅ CORRECTION CRITIQUE - Pas de user-select: none qui bloque les taps mobile */
a, button {
  touch-action: manipulation;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
  cursor: pointer;
  text-decoration: none;
}

.glass {
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* Hero Section - Mobile First */
.hero-section {
  min-height: 100vh;
  min-height: 100dvh;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url('data:image/svg+xml,%3Csvg width="100" height="100" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"%3E%3Cpath d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100" height="100" fill="url(%23grid)"/%3E%3C/svg%3E');
  opacity: 0.3;
  pointer-events: none;
}

.hero-content {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 1000px;
  color: #fff;
  width: 100%;
}

.hero-tag {
  background: rgba(255, 255, 255, 0.25);
  display: inline-block;
  padding: 0.6rem 1.5rem;
  border-radius: 50px;
  font-size: 0.9rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  border: 1px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

.hero-title {
  font-size: clamp(1.75rem, 5vw, 3.75rem);
  font-weight: 900;
  line-height: 1.1;
  margin-bottom: 1rem;
  letter-spacing: -0.02em;
}

.hero-highlight {
  color: #fbbf24;
  display: block;
  margin-top: 0.5rem;
  font-size: clamp(1.5rem, 4vw, 3rem);
}

.hero-description {
  font-size: clamp(1rem, 2.5vw, 1.5rem);
  margin-bottom: 2rem;
  opacity: 0.95;
  line-height: 1.5;
  max-width: 42rem;
  margin-left: auto;
  margin-right: auto;
}

.hero-cta-container {
  display: flex;
  flex-direction: column;
  gap: 0.875rem;
  max-width: 500px;
  margin: 0 auto 2rem;
}

.hero-cta-btn {
  padding: 1.25rem 2rem;
  font-size: clamp(1.1rem, 3vw, 1.35rem);
  font-weight: 900;
  text-align: center;
  border-radius: 9999px;
  border: none;
  transition: transform 0.15s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  display: block;
  width: 100%;
  font-family: inherit;
  letter-spacing: -0.01em;
  min-height: 44px;
}

.hero-cta-btn:active {
  transform: scale(0.97);
}

.hero-cta-primary {
  background: #fff;
  color: #667eea;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.hero-cta-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
}

.hero-cta-secondary {
  background: transparent;
  color: #fff;
  border: 2px solid rgba(255, 255, 255, 0.9);
}

.hero-cta-secondary:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: #fff;
}

.hero-benefits {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 1rem;
  font-size: 0.875rem;
  font-weight: 600;
}

.hero-benefit {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  white-space: nowrap;
}

/* Sections communes */
.section {
  padding: clamp(3rem, 8vw, 5rem) clamp(1rem, 4vw, 1.5rem);
}

.section-container {
  max-width: 75rem;
  margin: 0 auto;
}

.section-header {
  text-align: center;
  margin-bottom: clamp(2.5rem, 6vw, 4rem);
}

.section-title {
  font-size: clamp(2rem, 5vw, 3.5rem);
  font-weight: 900;
  color: #1f2937;
  margin-bottom: 0.75rem;
  line-height: 1.15;
  letter-spacing: -0.02em;
}

.section-subtitle {
  color: #6b7280;
  font-size: clamp(1rem, 2.5vw, 1.25rem);
  max-width: 48rem;
  margin: 0 auto;
  line-height: 1.6;
}

/* Grid responsive */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 280px), 1fr));
  gap: clamp(1.5rem, 4vw, 2rem);
}

/* Feature cards */
.feature-card {
  background: #fff;
  border-radius: 1rem;
  padding: clamp(1.5rem, 4vw, 2rem);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  border: 1px solid #f3f4f6;
}

.feature-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.feature-icon {
  font-size: clamp(2.5rem, 6vw, 3rem);
  margin-bottom: 1rem;
  line-height: 1;
}

.feature-title {
  font-size: clamp(1.25rem, 3vw, 1.5rem);
  font-weight: 700;
  margin-bottom: 0.75rem;
  color: #1f2937;
  line-height: 1.3;
}

.feature-description {
  color: #4b5563;
  line-height: 1.7;
  font-size: clamp(0.95rem, 2vw, 1rem);
}

/* Stats section */
.stats-section {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 200px), 1fr));
  gap: clamp(1.5rem, 4vw, 2rem);
}

.stat-card {
  padding: clamp(1rem, 3vw, 1.5rem);
  text-align: center;
}

.stat-number {
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: 900;
  margin-bottom: 0.5rem;
  line-height: 1;
}

.stat-label {
  color: rgba(255, 255, 255, 0.95);
  font-size: clamp(0.95rem, 2vw, 1.15rem);
  font-weight: 500;
}

/* Steps (How it Works) */
.steps-container {
  max-width: 56rem;
  margin: 0 auto;
}

.steps-list {
  display: flex;
  flex-direction: column;
  gap: clamp(1.5rem, 4vw, 2rem);
}

.step-card {
  display: flex;
  align-items: flex-start;
  gap: clamp(1rem, 3vw, 1.5rem);
  background: #fff;
  padding: clamp(1.5rem, 4vw, 2rem);
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border-left: 4px solid #667eea;
}

.step-icon {
  font-size: clamp(2.5rem, 6vw, 3.5rem);
  flex-shrink: 0;
  line-height: 1;
}

.step-content h3 {
  font-size: clamp(1.25rem, 3vw, 1.75rem);
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.step-content p {
  color: #4b5563;
  font-size: clamp(0.95rem, 2vw, 1.125rem);
  line-height: 1.7;
}

/* Table responsive */
.table-wrapper {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.comparison-table {
  width: 100%;
  min-width: 600px;
  border-collapse: collapse;
  background: #fff;
}

.comparison-table thead {
  background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
  color: #fff;
}

.comparison-table th {
  padding: clamp(0.75rem, 2vw, 1rem);
  font-weight: 700;
  font-size: clamp(0.95rem, 2vw, 1.125rem);
  text-align: left;
}

.comparison-table th:not(:first-child) {
  text-align: center;
}

.comparison-table tbody tr {
  border-bottom: 1px solid #e5e7eb;
  transition: background 0.15s ease;
}

.comparison-table tbody tr:hover {
  background: #f9fafb;
}

.comparison-table td,
.comparison-table th[scope="row"] {
  padding: clamp(0.75rem, 2vw, 1rem);
  font-size: clamp(0.9rem, 2vw, 1rem);
}

.comparison-table th[scope="row"] {
  font-weight: 400;
  color: #374151;
}

.comparison-table td {
  text-align: center;
  font-weight: 700;
}

/* Testimonials */
.testimonials-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));
  gap: clamp(1.5rem, 4vw, 2rem);
}

.testimonial-card {
  background: #fff;
  border-radius: 1rem;
  padding: clamp(1.5rem, 4vw, 2rem);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: transform 0.2s, box-shadow 0.2s;
}

.testimonial-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.testimonial-img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
  border: 3px solid;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.testimonial-rating {
  color: #fbbf24;
  font-size: 1.25rem;
  margin-bottom: 0.5rem;
}

.testimonial-name {
  font-size: clamp(1.1rem, 2.5vw, 1.25rem);
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.25rem;
}

.testimonial-role {
  font-size: clamp(0.85rem, 2vw, 0.95rem);
  color: #6b7280;
  margin-bottom: 1rem;
}

.testimonial-text {
  color: #374151;
  line-height: 1.7;
  font-size: clamp(0.95rem, 2vw, 1rem);
}

/* CTA buttons */
.cta-section {
  text-align: center;
  margin-top: clamp(2rem, 5vw, 3rem);
}

.cta-btn {
  background: #1e40af;
  color: #fff;
  padding: clamp(1rem, 3vw, 1.25rem) clamp(2rem, 5vw, 2.5rem);
  font-size: clamp(1rem, 2.5vw, 1.2rem);
  font-weight: 700;
  border-radius: 9999px;
  border: none;
  box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  font-family: inherit;
  display: inline-block;
  min-height: 44px;
}

.cta-btn:hover {
  background: #1e3a8a;
  transform: scale(1.05);
  box-shadow: 0 15px 40px rgba(30, 64, 175, 0.4);
}

.cta-btn:active {
  transform: scale(0.98);
}

/* Media queries */
@media (min-width: 768px) {
  .hero-cta-container {
    flex-direction: row;
    max-width: 700px;
  }
  
  .hero-benefits {
    gap: 1.5rem;
    font-size: 0.95rem;
  }
}

/* Utility colors */
.text-blue-800 { color: #1e40af; }
.text-blue-900 { color: #1e3a8a; }
.text-green-600 { color: #10b981; }
.text-red-500 { color: #ef4444; }
.text-purple-500 { color: #a855f7; }
.text-pink-500 { color: #ec4899; }
.bg-blue-50 { background: #eff6ff; }
.bg-white { background: #fff; }
.bg-gray-50 { background: #f9fafb; }
</style>

<body class="bg-gradient-to-tr from-blue-50 to-white text-gray-800">

<main itemscope itemtype="https://schema.org/Service">

{{-- 🚀 Hero Section - Accroche principale --}}
<section class="hero-section" aria-labelledby="hero-title">
  <div class="hero-content">
    <div class="hero-tag" role="status" aria-live="polite">✅ 100% FREE - NO CREDIT CARD</div>
    
    <h1 id="hero-title" class="hero-title" itemprop="name">
      Earn Money Helping Expats Worldwide
      <span class="hero-highlight" itemprop="description">💰 €100 to €10,000+/month</span>
    </h1>

    <p class="hero-description">
      Join 10,000+ service providers on ULIXAI. Turn your local knowledge into global income. Set your own rates. Work on your terms. Get paid securely.
    </p>

    <div class="hero-cta-container">
      <a href="javascript:void(0)" 
         onclick="openSignupPopup()" 
         class="hero-cta-btn hero-cta-primary"
         aria-label="Start earning now - Free registration">
        START EARNING NOW 🚀
      </a>
      
      <a href="javascript:void(0)" 
         onclick="openSignupPopup()" 
         class="hero-cta-btn hero-cta-secondary"
         aria-label="Free registration as service provider">
        FREE REGISTRATION 💼
      </a>
    </div>

    <div class="hero-benefits" role="list" aria-label="Key benefits">
      <div class="hero-benefit" role="listitem"><span aria-hidden="true">✅</span> Zero upfront costs</div>
      <div class="hero-benefit" role="listitem"><span aria-hidden="true">💳</span> Secure payments</div>
      <div class="hero-benefit" role="listitem"><span aria-hidden="true">🌍</span> Global reach</div>
      <div class="hero-benefit" role="listitem"><span aria-hidden="true">⏰</span> Flexible schedule</div>
    </div>
  </div>
</section>

{{-- 💡 Why Join Section --}}
<section class="section bg-white" aria-labelledby="why-join-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="why-join-heading" class="section-title">Why Join @site?</h2>
    </header>

    {{-- Mobile Register Button --}}
    <div class="block md:hidden text-center mb-12">
      <a href="javascript:void(0)" 
         onclick="openSignupPopup()" 
         class="cta-btn"
         aria-label="Register as service provider">
        Register as provider
      </a>
    </div>

    <div class="grid" role="list">
      <article class="glass feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">🎯</div>
        <h3 class="feature-title text-blue-800">Targeted Missions</h3>
        <p class="feature-description">Get only those requests that match your profile. Save time, earn more.</p>
      </article>
      
      <article class="glass feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">⚡</div>
        <h3 class="feature-title text-blue-800">Daily Global Opportunities</h3>
        <p class="feature-description">Connect with clients worldwide – online or in-person.</p>
      </article>
      
      <article class="glass feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">🛡️</div>
        <h3 class="feature-title text-blue-800">Peace of Mind</h3>
        <p class="feature-description">Verified identity, secure payments, and dedicated support.</p>
      </article>
    </div>

    <div style="max-width: 48rem; margin: 2rem auto; text-align: center;">
      <p class="feature-description" style="margin-bottom: 1rem;">
        Whether you're a <strong class="text-blue-800">expat, lawyer, real estate agent, translator or teacher</strong>, join us and offer your assistance worldwide, regardless of your spoken languages.
      </p>
      
      <p class="feature-description" style="margin-bottom: 1rem;">
        Receive instant job <strong class="text-blue-800">alerts</strong>, submit your rate offer, and start earning money with your expertise.
      </p>
      
      <p class="feature-description" style="margin-bottom: 2rem;">
        <strong class="text-blue-800">Flexible income:</strong> Whether you work full time or part time, you alone decide your monthly income (<strong class="text-blue-800">€100, €1,000, €10,000</strong>? You decide).
      </p>

      <a href="javascript:void(0)" 
         onclick="openSignupPopup()" 
         class="cta-btn"
         aria-label="Create free provider profile">
        Create My Free Profile
      </a>
    </div>
  </div>
</section>

{{-- 🎯 Features Section - 6 cards complètes --}}
<section class="section" style="background: #f9fafb;" aria-labelledby="features-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="features-heading" class="section-title">🎯 Why Choose ULIXAI</h2>
      <p class="section-subtitle">
        Join thousands of professionals earning consistent income while helping expats worldwide
      </p>
    </header>

    <div class="grid" role="list" aria-label="Platform features">
      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">💰</div>
        <h3 class="feature-title">Set Your Own Rates</h3>
        <p class="feature-description">
          Control your pricing. Earn €20-€500+ per service. No commission limits. Keep 80-85% of earnings.
        </p>
      </article>

      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">🌍</div>
        <h3 class="feature-title">Global Client Base</h3>
        <p class="feature-description">
          Access clients from 150+ countries seeking translation, legal help, housing, and local guidance.
        </p>
      </article>

      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">🛡️</div>
        <h3 class="feature-title">Secure Payments</h3>
        <p class="feature-description">
          Escrow system protects both parties. Funds released after service completion. Zero disputes.
        </p>
      </article>

      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">⏰</div>
        <h3 class="feature-title">Work When You Want</h3>
        <p class="feature-description">
          Complete flexibility. Accept requests fitting your schedule. Part-time or full-time.
        </p>
      </article>

      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">⭐</div>
        <h3 class="feature-title">Build Your Reputation</h3>
        <p class="feature-description">
          Earn 5-star reviews. Showcase expertise. Higher ratings = more clients = more income.
        </p>
      </article>

      <article class="feature-card" role="listitem">
        <div class="feature-icon" aria-hidden="true">🤝</div>
        <h3 class="feature-title">24/7 Support</h3>
        <p class="feature-description">
          Dedicated provider support team. Quick response times. We've got your back always.
        </p>
      </article>
    </div>
  </div>
</section>

{{-- 📈 Stats Section --}}
<section class="section stats-section" aria-labelledby="stats-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="stats-heading" class="section-title">📊 ULIXAI By The Numbers</h2>
    </header>

    <div class="stats-grid" role="list" aria-label="Platform statistics">
      <div class="stat-card" role="listitem">
        <div class="stat-number" aria-label="Over 10,000 service providers">10,000+</div>
        <div class="stat-label">Active Providers</div>
      </div>

      <div class="stat-card" role="listitem">
        <div class="stat-number" aria-label="Serving 150+ countries">150+</div>
        <div class="stat-label">Countries Served</div>
      </div>

      <div class="stat-card" role="listitem">
        <div class="stat-number" aria-label="Over 2 million euros paid">€2M+</div>
        <div class="stat-label">Earnings Paid Out</div>
      </div>

      <div class="stat-card" role="listitem">
        <div class="stat-number" aria-label="4.8 out of 5 satisfaction">4.8/5</div>
        <div class="stat-label">Provider Satisfaction</div>
      </div>
    </div>
  </div>
</section>

{{-- 🔄 How It Works Section --}}
<section class="section bg-white" aria-labelledby="how-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="how-heading" class="section-title">🔄 How It Works</h2>
      <p class="section-subtitle">
        Start earning in 3 simple steps. No complexity. No hidden fees.
      </p>
    </header>

    <div class="steps-container">
      <div class="steps-list" role="list" aria-label="Getting started steps">
        <article class="step-card" role="listitem">
          <div class="step-icon" aria-hidden="true">1️⃣</div>
          <div class="step-content">
            <h3>Sign Up for Free</h3>
            <p>
              Create profile in 5 minutes. Add skills, experience, and availability. Zero cost to join.
            </p>
          </div>
        </article>

        <article class="step-card" role="listitem">
          <div class="step-icon" aria-hidden="true">2️⃣</div>
          <div class="step-content">
            <h3>Browse Client Requests</h3>
            <p>
              View requests matching your expertise. Quote your price. Accept when ready to work.
            </p>
          </div>
        </article>

        <article class="step-card" role="listitem">
          <div class="step-icon" aria-hidden="true">3️⃣</div>
          <div class="step-content">
            <h3>Get Paid Securely</h3>
            <p>
              Complete service. Client confirms satisfaction. Funds released to your account within 48h.
            </p>
          </div>
        </article>
      </div>

      <div class="cta-section">
        <a href="javascript:void(0)" 
           onclick="openSignupPopup()" 
           class="cta-btn"
           aria-label="Join 10,000+ service providers">
          JOIN 10,000+ PROVIDERS 🚀
        </a>
      </div>
    </div>
  </div>
</section>

{{-- 📊 Comparison Table --}}
<section class="section bg-blue-50" aria-labelledby="comparison-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="comparison-heading" class="section-title text-blue-900">
        Individual or Professional? Help and Earn Money
      </h2>
    </header>
    
    <div class="table-wrapper">
      <table class="comparison-table" role="table" aria-label="Service comparison">
        <thead>
          <tr>
            <th scope="col">@site Services</th>
            <th scope="col">Individual</th>
            <th scope="col">Professional</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Access to client requests</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row">Expertise badge by field</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row">Statistics tracking</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row">Secure payment</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row">Client/provider reviews</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row">Affiliate link</th>
            <td class="text-green-600" aria-label="Available">✅</td>
            <td class="text-green-600" aria-label="Available">✅</td>
          </tr>
          <tr>
            <th scope="row" style="color: #6b7280; font-style: italic;">
              SOS Emergency Call<br>
              <span style="font-size: 0.75rem;">(coming soon)</span>
            </th>
            <td class="text-red-500" aria-label="Not available">❌</td>
            <td class="text-red-500" aria-label="Not available">❌</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <div class="cta-section">
      <a href="javascript:void(0)" 
         onclick="openSignupPopup()" 
         class="cta-btn"
         aria-label="Register as service provider">
        Register as provider
      </a>
    </div>
  </div>
</section>

{{-- 💬 Testimonials Section --}}
<section class="section bg-gray-50" aria-labelledby="testimonials-heading">
  <div class="section-container">
    <header class="section-header">
      <h2 id="testimonials-heading" class="section-title">💬 What our clients say</h2>
      <p class="section-subtitle">
        Real feedback from our happy users around the world.
      </p>
    </header>

    <div class="testimonials-grid" role="list" aria-label="Client testimonials">
      <article class="testimonial-card" role="listitem" itemscope itemtype="https://schema.org/Review">
        <img src="images/test1.jpg" 
             alt="Sarah Johnson - Marketing Manager at BrightCorp" 
             class="testimonial-img"
             style="border-color: #a855f7;"
             width="80"
             height="80"
             loading="lazy"
             decoding="async">
        <div class="testimonial-rating" role="img" aria-label="5 out of 5 stars">★★★★★</div>
        <h3 class="testimonial-name" itemprop="author">Sarah Johnson</h3>
        <p class="testimonial-role">Marketing Manager, BrightCorp</p>
        <p class="testimonial-text" itemprop="reviewBody">
          "ULIX AI helped us streamline our reports in no time. The service is fast, accurate, and extremely professional. Highly recommended!"
        </p>
        <meta itemprop="ratingValue" content="5">
      </article>

      <article class="testimonial-card" role="listitem" itemscope itemtype="https://schema.org/Review">
        <img src="images/test2.jpg" 
             alt="Ahmed Raza - Founder of TechVerse" 
             class="testimonial-img"
             style="border-color: #ec4899;"
             width="80"
             height="80"
             loading="lazy"
             decoding="async">
        <div class="testimonial-rating" role="img" aria-label="5 out of 5 stars">★★★★★</div>
        <h3 class="testimonial-name" itemprop="author">Ahmed Raza</h3>
        <p class="testimonial-role">Founder, TechVerse</p>
        <p class="testimonial-text" itemprop="reviewBody">
          "I'm amazed by how intuitive and effective this platform is. I use it daily to support clients and generate deliverables with ease."
        </p>
        <meta itemprop="ratingValue" content="5">
      </article>

      <article class="testimonial-card" role="listitem" itemscope itemtype="https://schema.org/Review">
        <img src="images/test3.jpg" 
             alt="Lisa Fernandez - Operations Head at Medline Group" 
             class="testimonial-img"
             style="border-color: #10b981;"
             width="80"
             height="80"
             loading="lazy"
             decoding="async">
        <div class="testimonial-rating" role="img" aria-label="5 out of 5 stars">★★★★★</div>
        <h3 class="testimonial-name" itemprop="author">Lisa Fernandez</h3>
        <p class="testimonial-role">Operations Head, Medline Group</p>
        <p class="testimonial-text" itemprop="reviewBody">
          "We were struggling to manage personalized documentation until we found ULIX AI. It's a game-changer for businesses like ours."
        </p>
        <meta itemprop="ratingValue" content="5">
      </article>
    </div>
  </div>
</section>

</main>

@include('includes.footer')

{{-- ✅ JavaScript SIMPLE (comme l'original qui fonctionnait) --}}
<script>
function openSignupPopup() {
  document.getElementById('signupPopup').classList.remove('hidden');
}

function closeSignupPopup() {
  document.getElementById('signupPopup').classList.add('hidden');
}
</script>

</body>
</html>