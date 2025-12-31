<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>Partnership Request - Join Ulixai Global Network</title>
    <meta name="description" content="Partner with Ulixai to reach millions worldwide. Join our global network of content creators, distributors, and sponsors. Submit your partnership request today.">
    <meta name="keywords" content="Ulixai partnership, business collaboration, content partnership, distribution partner, sponsorship opportunities, global network, business alliance">
    <meta name="author" content="Ulixai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Partner With Ulixai - Global Collaboration Opportunities">
    <meta property="og:description" content="Join Ulixai's global partnership network. Collaborate with us in content creation, distribution, or sponsorship.">
    <meta property="og:image" content="{{ asset('images/og-partnership.jpg') }}">
    <meta property="og:site_name" content="Ulixai">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Partner With Ulixai - Global Collaboration">
    <meta name="twitter:description" content="Join Ulixai's global partnership network. Submit your collaboration request today.">
    <meta name="twitter:image" content="{{ asset('images/twitter-partnership.jpg') }}">
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    
    <!-- JSON-LD Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Partnership Request - Ulixai",
      "description": "Submit a partnership request to collaborate with Ulixai's global network",
      "url": "{{ url()->current() }}",
      "inLanguage": "en",
      "isPartOf": {
        "@type": "WebSite",
        "name": "Ulixai",
        "url": "{{ config('app.url') }}"
      },
      "mainEntity": {
        "@type": "Organization",
        "name": "Ulixai",
        "url": "{{ config('app.url') }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('images/logo.png') }}"
        },
        "contactPoint": {
          "@type": "ContactPoint",
          "contactType": "Partnership Inquiries",
          "email": "partnerships@ulixai.com"
        }
      },
      "potentialAction": {
        "@type": "CommunicateAction",
        "name": "Submit Partnership Request",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "{{ route('partnership.store') }}",
          "actionPlatform": [
            "http://schema.org/DesktopWebPlatform",
            "http://schema.org/MobileWebPlatform"
          ]
        }
      },
      "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ config('app.url') }}"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "Partnership Request",
            "item": "{{ url()->current() }}"
          }
        ]
      }
    }
    </script>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

@include('includes.header')

<!-- ============================================
     🤝 PARTNERSHIP REQUEST - MOBILE-FIRST
     ⚡ SEO Optimized
     🎨 Fun & Professional
     ============================================ -->

<main class="min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-8 sm:py-12 px-4">
  
  <!-- Background Blobs -->
  <div class="bg-layer">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Main Container -->
  <div class="relative max-w-4xl mx-auto z-10">
    
    <!-- ============================================
         PARTNERSHIP FORM CARD
         ============================================ -->
    <article class="form-card-wrapper">
      <div class="form-card-border"></div>
      
      <div id="partnershipForm" class="form-card-content">
        
        <!-- Header -->
        <header class="form-header">
          <!-- Icon -->
          <div class="icon-wrapper">
            <div class="icon-ring"></div>
            <div class="icon-ring delay-1"></div>
            <div class="icon-container">
              <span class="icon-emoji">🤝</span>
            </div>
          </div>

          <!-- Title -->
          <h1 class="main-title">
            <span class="title-gradient">Let's Build Together!</span>
            <span class="title-emoji">🚀</span>
          </h1>
          
          <p class="subtitle">
            Join <strong class="text-highlight">Ulixai</strong>'s global network of partners and grow your impact worldwide 🌍
          </p>
          
          <!-- Trust Badges -->
          <div class="trust-badges">
            <span class="badge">
              <span class="badge-icon">⚡</span>
              <span class="badge-text">24h Response</span>
            </span>
            <span class="badge">
              <span class="badge-icon">🌍</span>
              <span class="badge-text">Global Reach</span>
            </span>
            <span class="badge">
              <span class="badge-icon">💼</span>
              <span class="badge-text">Professional</span>
            </span>
          </div>
        </header>

        <!-- Form -->
        <form class="partnership-form partnership-request-form" onsubmit="submitForm(event)">
          @csrf

          <!-- Entity Name -->
          <div class="form-group">
            <label for="first_name" class="form-label">
              <span class="label-icon">🏢</span>
              <span class="label-text">Entity Name</span>
              <span class="label-required">*</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="first_name"
                name="first_name" 
                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                required
                placeholder="Your company or organization name"
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Full Name -->
          <div class="form-group">
            <label for="last_name" class="form-label">
              <span class="label-icon">👤</span>
              <span class="label-text">Your Full Name</span>
              <span class="label-required">*</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="last_name"
                name="last_name" 
                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                required
                placeholder="John Doe"
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Phone Number -->
          <div class="form-group">
            <label for="phone" class="form-label">
              <span class="label-icon">📱</span>
              <span class="label-text">Phone Number</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="phone"
                name="phone" 
                value="{{ Auth::check() ? Auth::user()->serviceProvider->phone_number ?? '' : '' }}"
                placeholder="+1 234 567 8900"
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Country -->
          <div class="form-group">
            <label for="country" class="form-label">
              <span class="label-icon">🌍</span>
              <span class="label-text">Country of Activity</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="country"
                name="country" 
                value="{{ Auth::check() ? Auth::user()->serviceProvider->country ?? '' : '' }}"
                placeholder="United States"
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Sector of Activity -->
          <div class="form-group">
            <label for="sector_of_activity" class="form-label">
              <span class="label-icon">💼</span>
              <span class="label-text">Sector of Activity</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="sector_of_activity"
                name="sector_of_activity" 
                placeholder="Technology, Healthcare, Education..."
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Languages Spoken -->
          <div class="form-group">
            <label for="language_spoken" class="form-label">
              <span class="label-icon">💬</span>
              <span class="label-text">Languages Spoken</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="language_spoken"
                name="language_spoken" 
                value="{{ Auth::check() ? Auth::user()->serviceProvider->preferred_language ?? '' : '' }}"
                placeholder="English, Spanish, French..."
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Preferred Time -->
          <div class="form-group">
            <label for="preferred_time" class="form-label">
              <span class="label-icon">⏰</span>
              <span class="label-text">Preferred Time for Reply</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="preferred_time"
                name="preferred_time" 
                placeholder="Morning, Afternoon, Evening..."
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Partnership Type -->
          <div class="form-group">
            <label for="partnership_type" class="form-label">
              <span class="label-icon">🎯</span>
              <span class="label-text">Type of Partnership</span>
            </label>
            <div class="input-wrapper">
              <select 
                id="partnership_type" 
                name="partnership_type" 
                class="form-input">
                <option disabled selected>— Choose an option —</option>
                <option value="Content Collaboration">Content Collaboration 📝</option>
                <option value="Distribution Partner">Distribution Partner 🚀</option>
                <option value="Sponsorship">Sponsorship 💰</option>
              </select>
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- How did you hear -->
          <div class="form-group">
            <label for="how_heard_about" class="form-label">
              <span class="label-icon">📢</span>
              <span class="label-text">How Did You Hear About Us?</span>
            </label>
            <div class="input-wrapper">
              <input 
                type="text" 
                id="how_heard_about"
                name="how_heard_about" 
                placeholder="Google, Social Media, Friend..."
                class="form-input">
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Motivation -->
          <div class="form-group">
            <label for="motivation" class="form-label">
              <span class="label-icon">💡</span>
              <span class="label-text">What Motivates You?</span>
            </label>
            <div class="input-wrapper">
              <textarea 
                id="motivation"
                name="motivation" 
                rows="4"
                placeholder="Tell us why you want to collaborate with Ulixai..."
                class="form-input form-textarea"></textarea>
              <div class="input-glow"></div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="submit-btn">
            <div class="submit-bg"></div>
            <span class="submit-content">
              <span class="submit-icon">✅</span>
              <span class="submit-text">Submit Partnership Request</span>
              <span class="submit-emoji">🚀</span>
            </span>
          </button>

        </form>

      </div>
    </article>

    <!-- ============================================
         THANK YOU MESSAGE
         ============================================ -->
    <div id="thankYouMessage" class="hidden">
      <article class="thank-you-wrapper">
        <div class="thank-you-border"></div>
        
        <div class="thank-you-content">
          <!-- Success Icon -->
          <div class="success-icon-wrapper">
            <div class="success-ring"></div>
            <div class="success-icon">
              <span class="success-check">✓</span>
            </div>
          </div>
          
          <!-- Title -->
          <h2 class="thank-you-title">
            <span class="thank-you-gradient">Thank You!</span>
            <span class="thank-you-emoji">🎉</span>
          </h2>
          
          <!-- Message -->
          <div class="thank-you-message">
            <p>We've received your partnership request.</p>
            <p>Our team will get back to you <strong>within 24 hours</strong>.</p>
            <p class="thank-you-footer">
              See you soon on this exciting <strong>Ulixai</strong> journey! 🌍✨
            </p>
          </div>
          
          <!-- Globe Icon -->
          <div class="globe-icon">
            <span class="text-6xl">🌎</span>
          </div>
        </div>
      </article>
    </div>

  </div>
</main>

<!-- ============================================
     FAQ SECTION - SEO OPTIMIZED
     ============================================ -->
<section class="faq-section" aria-labelledby="faq-title">
  <div class="faq-container">
    
    <h2 id="faq-title" class="faq-main-title">
      <span class="faq-title-gradient">Partnership FAQs</span>
      <span class="faq-title-emoji">❓</span>
    </h2>
    
    <p class="faq-subtitle">Everything you need to know about partnering with Ulixai</p>
    
    <!-- FAQ List -->
    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
      
      <!-- FAQ 1 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">🤝</span>
          <span>What types of partnerships does Ulixai offer?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            Ulixai offers <strong>three main partnership types</strong>: Content Collaboration (co-create valuable content with our global community), Distribution Partners (help us expand our reach in new markets), and Sponsorship opportunities (support our mission while gaining brand visibility). Each partnership is tailored to create mutual value and long-term success.
          </p>
        </div>
      </details>

      <!-- FAQ 2 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">⏱️</span>
          <span>How long does it take to get a response?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            We typically respond to partnership requests <strong>within 24 hours</strong>. Our dedicated partnerships team reviews each submission carefully to ensure we can provide you with the most relevant information and next steps. During high-volume periods, it may take up to 48 hours, but we always aim to be as prompt as possible.
          </p>
        </div>
      </details>

      <!-- FAQ 3 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">💰</span>
          <span>Is there a cost to become a partner?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Absolutely not!</strong> Submitting a partnership request and becoming a Ulixai partner is completely free. We believe in creating mutually beneficial relationships where both parties grow together. Our partnerships are based on shared goals, values, and the value each party brings to the collaboration.
          </p>
        </div>
      </details>

      <!-- FAQ 4 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">🌍</span>
          <span>Do you accept international partnerships?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            <strong>Yes, definitely!</strong> Ulixai is a global platform and we actively seek partnerships from all around the world. We work with partners in North America, Europe, Asia, Africa, South America, and Oceania. Our international approach helps us better serve our diverse global community and expand our impact worldwide.
          </p>
        </div>
      </details>

      <!-- FAQ 5 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">📋</span>
          <span>What information should I prepare before applying?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            To expedite your partnership request, please have ready: <strong>your entity/company name, contact details, country and sector of activity, languages you work in, and a brief explanation of your motivation</strong> to collaborate. The more details you provide, the better we can tailor a partnership that meets both our needs.
          </p>
        </div>
      </details>

      <!-- FAQ 6 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">✅</span>
          <span>What happens after I submit my request?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            After submission, our partnerships team will <strong>review your request within 24 hours</strong>. If there's a potential fit, we'll reach out to schedule a call to discuss opportunities in detail. We'll explore how we can work together, define clear goals, and outline the next steps. Every partnership is customized to ensure maximum value for both parties.
          </p>
        </div>
      </details>

      <!-- FAQ 7 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">🎯</span>
          <span>What makes a good partnership with Ulixai?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            A great Ulixai partnership is built on <strong>shared values, complementary strengths, and mutual growth</strong>. We look for partners who are committed to helping people connect globally, provide value to our community, and share our vision of making the world more accessible. Whether you bring content expertise, distribution channels, or resources, we can create something amazing together.
          </p>
        </div>
      </details>

      <!-- FAQ 8 -->
      <details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <summary class="faq-question" itemprop="name">
          <span class="faq-icon">📞</span>
          <span>Can I speak with someone before submitting?</span>
          <span class="faq-toggle">+</span>
        </summary>
        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <p itemprop="text">
            While we encourage you to <strong>submit the form first</strong> to help us understand your needs better, you can also reach our partnerships team at <strong>partnerships@ulixai.com</strong>. The form helps us prepare for our conversation and ensures we can provide you with the most relevant information when we connect.
          </p>
        </div>
      </details>

    </div>
  </div>
</section>

<!-- Footer Links -->
<footer class="footer-section">
  <div class="footer-container">
    <nav class="footer-nav">
      <a href="https://ulixai.com/partnershiprequest" class="footer-link">
        <span>🤝</span> Partnership
      </a>
      <span class="footer-separator">•</span>
      <a href="https://ulixai.com/press" class="footer-link">
        <span>📰</span> Press
      </a>
      <span class="footer-separator">•</span>
      <a href="https://ulixai.com/recruitment" class="footer-link">
        <span>💼</span> Careers
      </a>
    </nav>
    <p class="footer-copyright">&copy; {{ date('Y') }} Ulixai. All rights reserved.</p>
  </div>
</footer>

@include('includes.footer')

<style>
/* ============================================
   MOBILE-FIRST OPTIMIZED STYLES
   ============================================ */

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-size-adjust:100%}
body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif}

/* Animations */
@keyframes blob{0%,100%{transform:translate3d(0,0,0) scale(1)}50%{transform:translate3d(50px,-50px,0) scale(1.1)}}
@keyframes bounce-soft{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
@keyframes gradient-shift{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
@keyframes pop{0%{transform:scale(0)}60%{transform:scale(1.1)}100%{transform:scale(1)}}
@keyframes shake{0%,100%{transform:translateX(0)}25%,75%{transform:translateX(-5px)}50%{transform:translateX(5px)}}

/* Background */
.bg-layer{position:absolute;inset:0;overflow:hidden;pointer-events:none}
.blob{position:absolute;border-radius:50%;mix-blend-mode:multiply;filter:blur(60px);opacity:0.3;will-change:transform;animation:blob 12s ease-in-out infinite}
.blob-1{width:22rem;height:22rem;background:#3b82f6;top:4rem;left:2rem}
.blob-2{width:18rem;height:18rem;background:#a855f7;top:8rem;right:4rem;animation-delay:2s}
.blob-3{width:20rem;height:20rem;background:#ec4899;bottom:4rem;left:30%;animation-delay:4s}

/* Form Card */
.form-card-wrapper{position:relative;will-change:transform}
.form-card-border{position:absolute;inset:-0.25rem;background:linear-gradient(135deg,#3b82f6,#a855f7,#ec4899);border-radius:1.5rem;filter:blur(0.75rem);opacity:0.7}
.form-card-content{position:relative;background:rgba(255,255,255,0.95);backdrop-filter:blur(20px);border-radius:1.5rem;padding:1.5rem;box-shadow:0 20px 60px -12px rgba(0,0,0,0.15)}

/* Header */
.form-header{text-align:center;margin-bottom:2rem}
.icon-wrapper{display:flex;justify-content:center;margin-bottom:1.5rem;position:relative}
.icon-ring{position:absolute;inset:0;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#a855f7);opacity:0.2}
.delay-1{animation-delay:0.5s}
.icon-container{width:5rem;height:5rem;background:linear-gradient(135deg,#3b82f6,#a855f7,#ec4899);border-radius:1rem;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px -8px rgba(168,85,247,0.5);position:relative;z-index:1;transition:transform 0.3s ease}
.icon-container:active{transform:scale(0.95)}
.icon-emoji{font-size:2.5rem;animation:bounce-soft 2s ease-in-out infinite}

/* Typography */
.main-title{font-size:2rem;font-weight:900;margin-bottom:0.75rem;line-height:1.2}
.title-gradient{background:linear-gradient(135deg,#2563eb,#a855f7,#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.title-emoji{display:inline-block;margin-left:0.5rem}
.subtitle{font-size:1rem;font-weight:600;color:#4b5563;margin-bottom:1rem;line-height:1.6}
.text-highlight{color:#a855f7;font-weight:900}

/* Trust Badges */
.trust-badges{display:flex;justify-content:center;gap:0.5rem;flex-wrap:wrap}
.badge{display:inline-flex;align-items:center;gap:0.25rem;padding:0.375rem 0.75rem;background:linear-gradient(135deg,#dbeafe,#f3e8ff);border:2px solid #a855f7;border-radius:9999px;font-size:0.75rem;font-weight:900;color:#7c3aed;transition:transform 0.2s ease}
.badge:active{transform:scale(0.95)}
.badge-icon{font-size:0.875rem}

/* Form */
.partnership-form{display:flex;flex-direction:column;gap:1.25rem}
.form-group{display:flex;flex-direction:column}
.form-label{display:flex;align-items:center;gap:0.5rem;font-size:0.875rem;font-weight:900;color:#374151;margin-bottom:0.5rem}
.label-icon{font-size:1.125rem}
.label-required{color:#ef4444;font-weight:900;margin-left:0.125rem}

/* Inputs */
.input-wrapper{position:relative}
.form-input{width:100%;padding:1rem 1.25rem;background:linear-gradient(135deg,#f0f9ff,#faf5ff);border:3px solid #d1d5db;border-radius:1rem;font-weight:700;font-size:1rem;color:#111827;transition:all 0.3s ease;outline:0;appearance:none;-webkit-appearance:none}
.form-input::placeholder{color:#9ca3af;font-weight:600}
.form-input:focus{background:#fff;border-color:transparent;box-shadow:0 10px 40px -10px rgba(168,85,247,0.4);transform:scale(1.01)}
.form-input:focus + .input-glow{opacity:1;transform:scale(1)}
.form-textarea{resize:vertical;min-height:6rem;font-family:inherit;line-height:1.5}

.input-glow{position:absolute;inset:0;border-radius:1rem;background:linear-gradient(135deg,#3b82f6,#a855f7,#ec4899);padding:3px;-webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);-webkit-mask-composite:xor;mask-composite:exclude;opacity:0;transform:scale(0.98);transition:all 0.3s ease;pointer-events:none}

/* Submit Button */
.submit-btn{position:relative;width:100%;padding:1.25rem;border-radius:1rem;border:0;cursor:pointer;overflow:hidden;background:linear-gradient(135deg,#3b82f6,#a855f7,#ec4899);background-size:200% 200%;animation:gradient-shift 3s ease infinite;transition:all 0.3s ease;box-shadow:0 10px 30px -8px rgba(168,85,247,0.5);outline:0;-webkit-tap-highlight-color:transparent}
.submit-btn:hover{transform:scale(1.02);box-shadow:0 20px 50px -12px rgba(168,85,247,0.6)}
.submit-btn:active{transform:scale(0.98)}
.submit-bg{position:absolute;inset:0;background:linear-gradient(135deg,#1d4ed8,#7c3aed,#be185d);opacity:0;transition:opacity 0.3s ease}
.submit-btn:hover .submit-bg{opacity:1}
.submit-content{position:relative;display:flex;align-items:center;justify-content:center;gap:0.75rem;color:#fff;font-weight:900;font-size:1rem}
.submit-icon,.submit-emoji{font-size:1.5rem}

/* Thank You */
.thank-you-wrapper{position:relative;will-change:transform}
.thank-you-border{position:absolute;inset:-0.25rem;background:linear-gradient(135deg,#10b981,#059669);border-radius:1.5rem;filter:blur(0.75rem);opacity:0.7}
.thank-you-content{position:relative;background:rgba(255,255,255,0.95);backdrop-filter:blur(20px);border-radius:1.5rem;padding:2rem;text-align:center;box-shadow:0 20px 60px -12px rgba(0,0,0,0.15)}

.success-icon-wrapper{display:flex;justify-content:center;margin-bottom:1.5rem;position:relative}
.success-ring{position:absolute;inset:0;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);opacity:0.2}
.success-icon{width:5rem;height:5rem;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px -8px rgba(16,185,129,0.5);position:relative;z-index:1;animation:pop 0.6s cubic-bezier(0.68,-0.55,0.265,1.55)}
.success-check{font-size:2.5rem;color:#fff;font-weight:900}

.thank-you-title{font-size:2rem;font-weight:900;margin-bottom:1rem}
.thank-you-gradient{background:linear-gradient(135deg,#10b981,#059669);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.thank-you-emoji{display:inline-block;margin-left:0.5rem}
.thank-you-message{margin-bottom:2rem}
.thank-you-message p{color:#4b5563;font-weight:600;margin-bottom:0.5rem;line-height:1.6}
.thank-you-footer{color:#059669;font-weight:900;margin-top:1rem}
.globe-icon{animation:bounce-soft 2s ease-in-out infinite}

/* FAQ Section */
.faq-section{padding:4rem 1rem;background:#fff}
.faq-container{max-width:48rem;margin:0 auto}
.faq-main-title{font-size:2rem;font-weight:900;text-align:center;margin-bottom:1rem}
.faq-title-gradient{background:linear-gradient(135deg,#2563eb,#a855f7,#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.faq-title-emoji{display:inline-block;margin-left:0.5rem}
.faq-subtitle{text-align:center;font-size:1rem;font-weight:600;color:#6b7280;margin-bottom:2rem}

.faq-list{display:flex;flex-direction:column;gap:1rem}
.faq-item{background:#fff;border:2px solid #e5e7eb;border-radius:1rem;overflow:hidden;transition:all 0.3s ease}
.faq-item:hover{border-color:#a855f7;box-shadow:0 10px 30px -8px rgba(168,85,247,0.2)}
.faq-item[open]{border-color:#a855f7;box-shadow:0 10px 30px -8px rgba(168,85,247,0.3)}

.faq-question{display:flex;align-items:center;gap:0.75rem;padding:1.25rem 1.5rem;font-weight:900;font-size:1.125rem;color:#111827;cursor:pointer;list-style:none;transition:all 0.3s ease}
.faq-question::-webkit-details-marker{display:none}
.faq-question:hover{background:linear-gradient(135deg,#f0f9ff,#faf5ff)}
.faq-icon{font-size:1.5rem;flex-shrink:0}
.faq-toggle{margin-left:auto;font-size:1.5rem;font-weight:700;color:#a855f7;transition:transform 0.3s ease}
.faq-item[open] .faq-toggle{transform:rotate(45deg)}

.faq-answer{padding:0 1.5rem 1.5rem 4rem}
.faq-answer p{line-height:1.7;color:#4b5563;font-size:0.9375rem}

/* Footer */
.footer-section{padding:2rem 1rem 3rem;background:linear-gradient(to bottom,transparent,#f9fafb)}
.footer-container{max-width:72rem;margin:0 auto}
.footer-nav{display:flex;align-items:center;justify-content:center;gap:0.75rem;flex-wrap:wrap;margin-bottom:1rem}
.footer-link{display:inline-flex;align-items:center;gap:0.35rem;font-size:0.8125rem;font-weight:600;color:#6b7280;text-decoration:none;transition:color 0.3s ease;padding:0.25rem 0.5rem}
.footer-link:active{color:#a855f7}
.footer-separator{color:#d1d5db;font-size:0.75rem;user-select:none}
.footer-copyright{text-align:center;font-size:0.75rem;color:#9ca3af;font-weight:500}

/* Responsive */
@media (min-width:48em){
.form-card-content{padding:2rem}
.main-title{font-size:2.5rem}
.subtitle{font-size:1.125rem}
.form-input{padding:1.125rem 1.5rem}
.submit-content{font-size:1.125rem}
}

@media (min-width:64em){
.form-card-content{padding:2.5rem}
}

/* Accessibility */
@media (prefers-reduced-motion:reduce){
*,*::before,*::after{animation-duration:0.01ms!important;animation-iteration-count:1!important;transition-duration:0.01ms!important}}

@media (prefers-contrast:high){
.form-input:focus{border:4px solid #7c3aed}}

/* iOS fixes */
@supports (-webkit-touch-callout:none){
.form-input{font-size:16px}}
</style>

<script>
function submitForm(event) {
  event.preventDefault();

  const formData = new FormData(document.querySelector(".partnership-request-form"));

  fetch("{{ route('partnership.store') }}", {
    method: "POST",
    body: formData,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}",
    },
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      document.getElementById('partnershipForm').classList.add('hidden');
      document.getElementById('thankYouMessage').classList.remove('hidden');
      window.scrollTo({top: 0, behavior: 'smooth'});
    } else {
      alert("Something went wrong, please try again.");
    }
  })
  .catch(error => {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  });
}
</script>

</body>
</html>