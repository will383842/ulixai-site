<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abroad Ease Guide - Support platform for expats | International multilingual services</title>
  <meta name="description" content="Collaborative platform for expats around the world. Find local professionals and helping expats: visa, translation, housing, relocation.">
  <meta name="keywords" content="expat help, expat services, helping expat, international local pro, travel assistance, international mutual aid, expat community, multilingual solutions">
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  
  <!-- Leaflet for Map -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
  
  <!-- Tailwind CSS v3 - Build local production (safelist complet) -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  

  {{-- Google Translate est géré par header-init.js via @include('includes.header-content') --}}


  <style>
    /* CSS Variables */
    :root {
      --primary: #3B82F6;
      --primary-dark: #2563EB;
      --secondary: #8B5CF6;
      --accent: #EC4899;
      --success: #10B981;
      --warning: #F59E0B;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow-x: hidden;
      background: #FFFFFF;
    }

    html {
      scroll-behavior: smooth;
    }

    .font-display {
      font-family: 'Outfit', sans-serif;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #F1F5F9;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 4px;
    }

    /* Modern Card - Very light shadow */
    .card-modern {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }

    .card-modern:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 16px rgba(59, 130, 246, 0.15);
    }

    /* Animations - REDUCED */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes pulse-glow {
      0%, 100% { 
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
      }
      50% { 
        box-shadow: 0 0 25px rgba(139, 92, 246, 0.4);
      }
    }

    .animate-float {
      animation: float 8s ease-in-out infinite;
    }

    .animate-pulse-glow {
      animation: pulse-glow 4s ease-in-out infinite;
    }

    /* Button Effects */
    .btn-shine {
      position: relative;
      overflow: hidden;
    }

    .btn-shine::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: 0.5s;
    }

    .btn-shine:hover::before {
      left: 100%;
    }

    /* Category Bubbles */
    .category-bubble {
      width: 110px;
      height: 110px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 11px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      flex-shrink: 0;
      padding: 12px;
      line-height: 1.2;
    }

    .category-bubble:hover {
      transform: translateY(-10px) scale(1.1);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    .category-bubble span {
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      word-wrap: break-word;
      max-width: 100%;
    }

    /* Category Scroll */
    .category-scroll {
      scroll-behavior: smooth;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .category-scroll::-webkit-scrollbar {
      display: none;
    }

    /* Provider Image Hover */
    .provider-image {
      transition: transform 0.4s ease;
    }

    .card-modern:hover .provider-image {
      transform: scale(1.05);
    }

    /* Badge Styles */
    .badge-verified {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .badge-specialty {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* FAQ Accordion */
    .faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-content.active {
      max-height: 500px;
      transition: max-height 0.5s ease-in;
    }

    .faq-icon {
      transition: transform 0.3s ease;
    }

    .faq-toggle.active .faq-icon {
      transform: rotate(180deg);
    }

    /* Status Pulse */
    @keyframes status-pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    .status-online {
      animation: status-pulse 2s ease-in-out infinite;
    }

    /* Back to Top */
    #backToTop {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 56px;
      height: 56px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 9999;
      box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
    }

    #backToTop.show {
      opacity: 1;
      visibility: visible;
    }

    #backToTop:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(59, 130, 246, 0.6);
    }

    /* Custom Select */
    select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233B82F6'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 1.25rem;
      padding-right: 2.5rem;
    }

    /* Testimonial Card */
    .testimonial-card {
      background: white;
      border-radius: 24px;
      padding: 32px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
    }

    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(59, 130, 246, 0.15);
    }

    /* Number Badge */
    .number-badge {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 18px;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Horizontal Scroll for Mobile */
    .horizontal-scroll-mobile {
      overflow-x: auto;
      overflow-y: hidden;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .horizontal-scroll-mobile::-webkit-scrollbar {
      display: none;
    }

    .horizontal-scroll-mobile > div {
      scroll-snap-align: start;
      flex-shrink: 0;
    }

    /* How It Works Cards - Fixed size and increased contrast */
    .how-it-works-card {
      min-height: 320px;
      height: 320px;
      display: flex;
      flex-direction: column;
      background: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .how-it-works-card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
    }

    /* Profile Cards - Reduced height */
    .profile-card {
      height: 420px;
    }

    .profile-card .aspect-ratio-box {
      height: 260px;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem !important;
      }

      .category-bubble {
        width: 90px;
        height: 90px;
        font-size: 11px;
      }

      .category-bubble svg {
        width: 32px;
        height: 32px;
      }

      #backToTop {
        width: 48px;
        height: 48px;
        bottom: 20px;
        right: 20px;
      }

      .how-it-works-card {
        min-height: 280px;
        height: auto;
      }
    }

    /* AI Popup */
    .ai-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.9);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      z-index: 10000;
      max-width: 90%;
      width: 500px;
    }

    .ai-popup.show {
      opacity: 1;
      visibility: visible;
      transform: translate(-50%, -50%) scale(1);
    }

    .ai-popup-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 9999;
      backdrop-filter: blur(4px);
    }

    .ai-popup-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    @keyframes aiRobot {
      0%, 100% { transform: rotate(-5deg); }
      50% { transform: rotate(5deg); }
    }

    .ai-robot {
      animation: aiRobot 2s ease-in-out infinite;
    }

    /* Featured Badge */
    .featured-badge {
      background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
      animation: pulse-glow 2s ease-in-out infinite;
    }

    /* Why Choose Cards */
    .why-choose-card {
      background: white;
      border-radius: 20px;
      padding: 32px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      height: 100%;
    }

    .why-choose-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15);
    }


    /* Google Translate Styles */
#google_translate_element {
  position: relative;
  z-index: 1000;
}

.goog-te-banner-frame.skiptranslate {
  display: none !important;
}

body {
  top: 0px !important;
}

.goog-te-gadget {
  color: transparent !important;
  font-size: 0 !important;
}

.goog-te-gadget img {
  display: none !important;
}

.goog-te-combo {
  background: white;
  border: 2px solid #3B82F6;
  border-radius: 0.75rem;
  padding: 0.5rem 2.5rem 0.5rem 0.75rem;
  font-size: 0.875rem;
  font-weight: 500;
  color: #1F2937;
  cursor: pointer;
  transition: all 0.3s ease;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%233B82F6'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 1.25rem;
}

.goog-te-combo:hover {
  border-color: #2563EB;
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);
}

.goog-te-combo:focus {
  outline: none;
  border-color: #2563EB;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.goog-logo-link {
  display: none !important;
}

.goog-te-gadget span {
  display: none !important;
}

.goog-te-menu-value {
  color: #1F2937 !important;
}

.goog-te-menu-value:before {
  content: '🌐 ';
  font-size: 1rem;
}


    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>

  {{-- Tailwind config removed - using compiled CSS (mix('css/app.css')) --}}

  {{-- ═══════════════════════════════════════════════════════════
       DÉPENDANCES REQUISES POUR LE HEADER
       ═══════════════════════════════════════════════════════════ --}}

  {{-- CSRF Token --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- jQuery (required for Toastr and other components) --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  {{-- Font Awesome Icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- Toastr Notifications --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  {{-- International Telephone Input --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

  {{-- Alpine.js --}}
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>

  {{-- Header Styles (nav-button, hover-glow, etc.) --}}
  @include('includes.header.styles')

  {{-- Wizard Navigation Buttons Styles --}}
  @include('wizards.navigation-buttons-styles')

</head>

<body class="bg-white overflow-x-hidden pt-20 lg:pt-20">

  {{-- Header Content - SANS structure HTML (navbars, breadcrumb, popups) --}}
  @include('includes.header-content')

  {{-- Google Translate Widget géré par le header --}}

  <!-- HERO SECTION -->
  <section id="main-content" class="relative bg-blue-600 pt-20 pb-32 px-4 overflow-hidden" style="background-color: #3B82F6;">
    <div class="max-w-5xl mx-auto text-center relative z-10">
      <!-- Title -->
      <h1 class="hero-title font-display font-black text-white mb-6 leading-tight text-3xl sm:text-4xl lg:text-6xl" data-aos="fade-up" data-aos-duration="800">
        Need help, a service abroad?
      </h1>

      <!-- Subtitle -->
      <p class="text-white/90 text-lg sm:text-xl mb-10 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
        The platform that connects expats, travelers & helping expats or local pros wherever you are 🌍
      </p>

      <!-- Search Box -->
      <div class="max-w-3xl mx-auto mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
        <div class="bg-white rounded-full p-2 shadow-2xl">
          <div class="flex items-center gap-2">
            <input
              id="searchInput"
              type="text"
              placeholder="Find international help in one click 😉"
              class="flex-1 px-6 py-4 text-gray-700 bg-transparent rounded-full focus:outline-none text-base"
              onclick="openHelpPopup()"
              readonly
            />
            <button class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full btn-shine transition-all shadow-lg flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" stroke-width="2"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Search Example -->
      <p class="text-white/80 text-sm mb-8" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        💡 Ex: Portugal visa, certified multilingual translation, international relocation, work...
      </p>

      <!-- AI Button -->
      <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
        <button onclick="openAIPopup()" class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-8 py-4 rounded-full font-bold text-base btn-shine shadow-2xl inline-flex items-center space-x-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span>AI Assistant for expats</span>
        </button>
      </div>
    </div>
  </section>

  <!-- <!-- CATEGORY BUBBLES - Overlapping Hero -->
<section class="relative -mt-16 z-30 px-4 mb-12">
  <div class="max-w-7xl mx-auto">
    <!-- Categories Container -->
    <div class="relative">
      <div class="category-scroll flex gap-12 overflow-x-auto pb-4 justify-center items-center" id="categoryContainer">
        @foreach($category as $index => $cat)
          @php
            $colorIndex = ((int) $index) % 9; // ✅ Force la conversion en entier
            $gradients = [
              'linear-gradient(135deg, #3B82F6 0%, #2563EB 100%)',
              'linear-gradient(135deg, #F97316 0%, #EA580C 100%)',
              'linear-gradient(135deg, #A855F7 0%, #9333EA 100%)',
              'linear-gradient(135deg, #10B981 0%, #059669 100%)',
              'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)',
              'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)',
              'linear-gradient(135deg, #6366F1 0%, #4F46E5 100%)',
              'linear-gradient(135deg, #14B8A6 0%, #0D9488 100%)',
              'linear-gradient(135deg, #EC4899 0%, #DB2777 100%)'
            ];
          @endphp
          
          <div onclick="openHelpPopup()" 
               class="category-bubble" 
               style="background: {{ $gradients[$colorIndex] }};"
               data-aos="zoom-in" 
               data-aos-delay="{{ $index * 30 }}"
               data-aos-duration="600">
            <span>{{ $cat->name }}</span>
          </div>
        @endforeach
      </div>

        <!-- Navigation Arrows -->
        <button id="prevBubble" onclick="scrollBubbles('prev')" class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-6 bg-white rounded-full p-3 shadow-xl hover:bg-gray-50 transition-all z-10">
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button id="nextBubble" onclick="scrollBubbles('next')" class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-6 bg-white rounded-full p-3 shadow-xl hover:bg-gray-50 transition-all z-10">
          <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="py-16 px-4 bg-slate-50">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
        <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
          <span class="gradient-text">How does it work for expats?</span>
        </h2>
        <p class="text-gray-600 text-lg">Simple as hello, anywhere in the world! 🎯</p>
      </div>

      <!-- Desktop Grid -->
      <div class="hidden lg:flex items-stretch justify-center gap-0 mb-12">
        <!-- Card 1 -->
        <div class="relative" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
          <div class="how-it-works-card rounded-3xl p-8 w-52 hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
            <div class="absolute -top-3 -right-3 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">
              1
            </div>
            <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" stroke-width="2"/>
                <line x1="11" y1="7" x2="11" y2="11" stroke-width="2" stroke-linecap="round"/>
                <line x1="11" y1="11" x2="14" y2="14" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 mb-3 text-center">📝 Describe</h3>
            <p class="text-gray-600 text-sm text-center leading-relaxed">
              Post your expat need for free in 2 minutes
            </p>
          </div>
          <div class="absolute top-1/2 -right-6 transform -translate-y-1/2 text-blue-600 z-0">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
            </svg>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="relative ml-12" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
          <div class="how-it-works-card rounded-3xl p-8 w-52 hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
            <div class="absolute -top-3 -right-3 w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">
              2
            </div>
            <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 mb-3 text-center">💼 Receive offers</h3>
            <p class="text-gray-600 text-sm text-center leading-relaxed">
              Local pros and helping expats offer you their rates and you can communicate with them via public messaging
            </p>
          </div>
          <div class="absolute top-1/2 -right-6 transform -translate-y-1/2 text-green-600 z-0">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
            </svg>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="relative ml-12" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
          <div class="how-it-works-card rounded-3xl p-8 w-52 hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
            <div class="absolute -top-3 -right-3 w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">
              3
            </div>
            <div class="w-20 h-20 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 mb-3 text-center">✓ Choose</h3>
            <p class="text-gray-600 text-sm text-center leading-relaxed">
              Select the helping expat or local pro based on price, reviews and multilingual skills
            </p>
          </div>
          <div class="absolute top-1/2 -right-6 transform -translate-y-1/2 text-purple-600 z-0">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
            </svg>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="relative ml-12" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
          <div class="how-it-works-card rounded-3xl p-8 w-52 hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
            <div class="absolute -top-3 -right-3 w-12 h-12 bg-orange-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">
              4
            </div>
            <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 mb-3 text-center">🚀 In progress</h3>
            <p class="text-gray-600 text-sm text-center leading-relaxed">
              A helping expat or local pro completes the mission wherever you are in the world - private messaging is available
            </p>
          </div>
          <div class="absolute top-1/2 -right-6 transform -translate-y-1/2 text-orange-600 z-0">
            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
            </svg>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="relative ml-12" data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
          <div class="how-it-works-card rounded-3xl p-8 w-52 hover:shadow-xl transition-all duration-300 border-2 border-gray-200">
            <div class="absolute -top-3 -right-3 w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">
              5
            </div>
            <div class="w-20 h-20 bg-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 mb-3 text-center">⭐ Rate</h3>
            <p class="text-gray-600 text-sm text-center leading-relaxed">
              Rate the service and trigger secure payment
            </p>
          </div>
        </div>
      </div>

      <!-- Mobile Horizontal Scroll -->
      <div class="lg:hidden relative">
        <div class="absolute left-0 top-1/2 -translate-y-1/2 z-10 pointer-events-none">
          <div class="bg-gradient-to-r from-blue-50 to-transparent w-12 h-full flex items-center">
            <svg class="w-8 h-8 text-purple-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
            </svg>
          </div>
        </div>
        
        <div class="absolute right-0 top-1/2 -translate-y-1/2 z-10 pointer-events-none">
          <div class="bg-gradient-to-l from-purple-50 to-transparent w-12 h-full flex items-center justify-end">
            <svg class="w-8 h-8 text-purple-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
            </svg>
          </div>
        </div>
        
        <div class="text-center mb-4">
          <p class="text-sm text-gray-600 font-semibold flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
            </svg>
            Swipe to see the steps
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </p>
        </div>
        
        <div class="horizontal-scroll-mobile flex gap-6 pb-4 mb-8">
          <!-- Mobile Cards (1-5) -->
          <div class="relative flex-shrink-0 w-72">
            <div class="how-it-works-card rounded-3xl p-8 shadow-lg border-2 border-gray-200">
              <div class="absolute -top-3 -right-3 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">1</div>
              <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="8" stroke-width="2"/>
                </svg>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-3 text-center">📝 Describe</h3>
              <p class="text-gray-600 text-sm text-center leading-relaxed">Post your expat need for free in 2 minutes</p>
            </div>
          </div>

          <div class="relative flex-shrink-0 w-72">
            <div class="how-it-works-card rounded-3xl p-8 shadow-lg border-2 border-gray-200">
              <div class="absolute -top-3 -right-3 w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">2</div>
              <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-3 text-center">💼 Receive offers</h3>
              <p class="text-gray-600 text-sm text-center leading-relaxed">Local pros and helping expats offer you their rates and you can communicate with them via public messaging</p>
            </div>
          </div>

          <div class="relative flex-shrink-0 w-72">
            <div class="how-it-works-card rounded-3xl p-8 shadow-lg border-2 border-gray-200">
              <div class="absolute -top-3 -right-3 w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">3</div>
              <div class="w-20 h-20 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-3 text-center">✓ Choose</h3>
              <p class="text-gray-600 text-sm text-center leading-relaxed">Select the helping expat or local pro based on price, reviews and multilingual skills</p>
            </div>
          </div>

          <div class="relative flex-shrink-0 w-72">
            <div class="how-it-works-card rounded-3xl p-8 shadow-lg border-2 border-gray-200">
              <div class="absolute -top-3 -right-3 w-12 h-12 bg-orange-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">4</div>
              <div class="w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-3 text-center">🚀 In progress</h3>
              <p class="text-gray-600 text-sm text-center leading-relaxed">A helping expat or local pro completes the mission wherever you are in the world - private messaging is available</p>
            </div>
          </div>

          <div class="relative flex-shrink-0 w-72">
            <div class="how-it-works-card rounded-3xl p-8 shadow-lg border-2 border-gray-200">
              <div class="absolute -top-3 -right-3 w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-lg z-10">5</div>
              <div class="w-20 h-20 bg-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-3 text-center">⭐ Rate</h3>
              <p class="text-gray-600 text-sm text-center leading-relaxed">Rate the service and trigger secure payment</p>
            </div>
          </div>
        </div>
        
        <div class="flex justify-center gap-2">
          <div class="w-2 h-2 rounded-full bg-purple-600"></div>
          <div class="w-2 h-2 rounded-full bg-purple-300"></div>
          <div class="w-2 h-2 rounded-full bg-purple-300"></div>
          <div class="w-2 h-2 rounded-full bg-purple-300"></div>
          <div class="w-2 h-2 rounded-full bg-purple-300"></div>
        </div>
      </div>

      <!-- CTA Button -->
      <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        <button onclick="openHelpPopup()" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-12 py-4 rounded-full font-bold text-lg btn-shine shadow-2xl inline-flex items-center space-x-2 transform hover:scale-105 transition-all">
          <span>Start now</span>
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </button>
      </div>
    </div>
  </section>

<!-- FILTERS & PROVIDERS -->
@php
  use App\Models\Country; 
  $countries = Country::where('status', 1)->pluck('country');
  $languages = ['English', 'French', 'Spanish', 'Portuguese', 'German', 'Italian', 'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'];
@endphp

<section class="py-16 px-4 bg-gradient-to-b from-white to-gray-50">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10" data-aos="fade-up" data-aos-duration="800">
      <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
        <span class="gradient-text">Local pros and multilingual helping expats</span>
      </h2>
      <p class="text-gray-600 text-lg">Find help in all countries around the world 🌍</p>
    </div>

 <!-- Filters -->
<div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-3xl p-6 mb-10 shadow-lg" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div>
      <label class="block text-sm font-bold text-gray-700 mb-2">🗣️ Spoken languages</label>
      <select id="languageSelect" class="notranslate w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all text-gray-800" translate="no">
        <option value="">Select</option>
        @foreach($languages as $lang)
          <option value="{{ $lang }}">{{ $lang }}</option>
        @endforeach
        <option value="Others">Others</option>
      </select>
    </div>

    <div>
      <label class="block text-sm font-bold text-gray-700 mb-2">🌍 Countries of operation</label>
      <select id="countrySelect" class="notranslate w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all text-gray-800" translate="no">
        <option value="">Select</option>
        @foreach($countries as $country)
          <option value="{{ $country }}">{{ $country }}</option>
        @endforeach
        <option value="Others">Others</option>
      </select>
    </div>

    <div>
      <label class="block text-sm font-bold text-gray-700 mb-2">📋 Category</label>
      <select id="categorySelect" class="notranslate w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all text-gray-800" translate="no">
        <option value="">Select</option>
        @foreach($category as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach  
      </select>
    </div>

    <div class="flex items-end">
      <button id="filterButton" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 rounded-xl btn-shine transition-all shadow-lg hover:shadow-xl">
        🔍 Filter
      </button>
    </div>
  </div>

  <div id="subcategoryWrapper" class="hidden mt-4">
    <label class="block text-sm font-bold text-gray-700 mb-2">🎯 Subcategory</label>
    <select id="subcategorySelect" class="notranslate w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all text-gray-800" translate="no">
      <option value="">Select</option>
    </select>
  </div>

  <div id="subsubcategoryWrapper" class="hidden mt-4">
    <label class="block text-sm font-bold text-gray-700 mb-2">🎯 Sub-subcategory</label>
    <select id="subsubcategorySelect" class="notranslate w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-all text-gray-800" translate="no">
      <option value="">Select</option>
    </select>
  </div>

  <!-- Reset Button -->
  <div class="mt-4 text-center">
    <button id="resetFiltersButton" class="text-blue-600 hover:text-blue-800 font-semibold underline">
      Reset filters
    </button>
  </div>
</div>

    <!-- Providers Grid - Limited to 2 rows of 5 (10 profiles) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="serviceGrid">
      @foreach ($providers->take(10) as $provider)
        @php
          $avgRating = $provider->reviews()->avg('rating') ?? 5.0;
          $reviewCount = $provider->reviews()->count();
          $statuses = json_decode($provider->special_status, true) ?? [];
          $firstSpecialty = !empty($statuses) ? array_key_first($statuses) : null;
          
          $providerCategories = [];
          if (isset($provider->categories) && is_string($provider->categories)) {
            $categoryIds = json_decode($provider->categories, true);
            if (is_array($categoryIds)) {
              $providerCategories = $category->whereIn('id', $categoryIds)->take(2)->pluck('name')->toArray();
            }
          }
          elseif (isset($provider->categories) && is_array($provider->categories)) {
            $providerCategories = array_slice($provider->categories, 0, 2);
          }
          elseif (method_exists($provider, 'categories')) {
            try {
              $providerCategories = $provider->categories()->take(2)->pluck('name')->toArray();
            } catch (\Exception $e) {
              $providerCategories = [];
            }
          }
          elseif (isset($provider->category_id)) {
            $cat = $category->where('id', $provider->category_id)->first();
            if ($cat) {
              $providerCategories = [$cat->name];
            }
          }
        @endphp

        <a href="{{ route('provider-details', ['id' => $provider->slug]) }}" 
          class="profile-card card-modern bg-white rounded-3xl overflow-hidden block group"
          data-aos="fade-up"
          data-aos-delay="{{ $loop->index * 30 }}"
          data-aos-duration="600">
          
          @php
            $src = trim((string)($provider->profile_photo ?? ''));
            $fallback = asset('images/attachment.png');
            $path = $src ? parse_url($src, PHP_URL_PATH) : '';
            $ext  = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : null;
            $isSvg = $ext === 'svg';
          @endphp

          <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100">
            <img
              src="{{ $src ?: $fallback }}"
              alt="{{ $provider->first_name }}"
              class="provider-image absolute inset-0 w-full h-full {{ $isSvg ? 'object-contain bg-white p-6' : 'object-cover' }}"
              onerror="this.onerror=null;this.src='{{ $fallback }}';"
            />
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            @if($firstSpecialty)
              <div class="absolute top-3 left-3">
                <span class="badge-specialty text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                  {{ $firstSpecialty }}
                </span>
              </div>
            @endif

            <div class="absolute top-3 right-3">
              <div class="status-online w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-lg"></div>
            </div>

            @if($provider->preferred_language)
              <div class="absolute bottom-3 left-3">
                <span class="bg-white/90 backdrop-blur text-gray-800 px-2.5 py-1 rounded-full text-xs font-bold">
                  🗣️ {{ $provider->preferred_language }}
                </span>
              </div>
            @endif
          </div>

          <div class="p-4">
            <div class="mb-2">
              <h3 class="font-bold text-base text-gray-900 truncate mb-1">
                {{ $provider->first_name ?? 'Provider' }}
                @if($provider->last_name)
                  {{ substr($provider->last_name, 0, 1) }}.
                @endif
              </h3>
              
              <div class="flex items-center mb-2">
                <div class="flex text-yellow-400 text-xs">
                  @php
                    $fullStars = floor($avgRating);
                  @endphp
                  @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-3 h-3 {{ $i <= $fullStars ? 'fill-current' : 'fill-gray-300' }}" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                  @endfor
                </div>
                <span class="ml-1 text-xs font-bold text-gray-700">{{ number_format($avgRating, 1) }}</span>
                <span class="ml-1 text-xs text-gray-500">({{ $reviewCount }})</span>
              </div>
            </div>

            @if(!empty($providerCategories))
              <div class="mb-2">
                <p class="text-xs font-bold text-gray-500 mb-1">📂 Services:</p>
                <div class="flex flex-wrap gap-1">
                  @foreach($providerCategories as $cat)
                    <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      {{ $cat }}
                    </span>
                  @endforeach
                </div>
              </div>
            @endif

            @php 
              $operationalCountriesRaw = $provider->operational_countries ?? [];
              if (is_string($operationalCountriesRaw)) {
                $operationalCountries = json_decode($operationalCountriesRaw, true) ?? [];
              } else {
                $operationalCountries = $operationalCountriesRaw;
              }
            @endphp

            @if(!empty($operationalCountries))
              <div class="pt-2 border-t border-gray-100">
                <p class="text-xs font-bold text-gray-500 mb-1">🌍 Countries of operation:</p>
                <div class="flex flex-wrap gap-1">
                  @foreach(array_slice($operationalCountries, 0, 2) as $country)
                    <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      {{ $country }}
                    </span>
                  @endforeach
                  @if(count($operationalCountries) > 2)
                    <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      +{{ count($operationalCountries) - 2 }}
                    </span>
                  @endif
                </div>
              </div>
            @endif
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- EXPERTS AVAILABLE BAR -->
<section class="py-6 px-4 bg-gradient-to-r from-green-500 to-emerald-600">
  <div class="max-w-6xl mx-auto">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-white" data-aos="fade-up" data-aos-duration="800">
      <div class="flex items-center space-x-4">
        <div class="flex -space-x-3">
          @php
            $randomProviders = App\Models\ServiceProvider::whereNotNull('profile_photo')
              ->where('profile_photo', '!=', '')
              ->whereHas('user', function($q) {
                  $q->where('status', 'active');
              })
              ->inRandomOrder()
              ->take(3)
              ->get();
            
            $totalProviders = App\Models\ServiceProvider::whereHas('user', function($q) {
                $q->where('status', 'active');
            })->count();
          @endphp
          
          @foreach($randomProviders as $rp)
            <div class="w-12 h-12 rounded-full border-2 border-white bg-gray-300 overflow-hidden">
              <img src="{{ asset($rp->profile_photo) }}" alt="{{ $rp->first_name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('images/attachment.png') }}';">
            </div>
          @endforeach
          
          @if($totalProviders > 3)
          <div class="w-12 h-12 rounded-full border-2 border-white bg-white/20 backdrop-blur flex items-center justify-center font-bold">
            +{{ $totalProviders - 3 }}
          </div>
          @endif
        </div>
        <div>
          <div class="font-bold text-lg">🟢 {{ $totalProviders }} Helping expats & local pros available</div>
          <div class="text-sm text-white/80">Multilingual, ready to help you in all countries</div>
        </div>
      </div>
      <a href="{{ route('service-providers') }}" class="bg-white text-green-600 px-8 py-3 rounded-full font-bold hover:bg-gray-50 transition-all btn-shine">
        Discover all profiles →
      </a>
    </div>
  </div>
</section>

<!-- FEATURED PROVIDERS SECTION - 5 profiles on 1 line -->
<section class="py-16 px-4 bg-amber-50">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10" data-aos="fade-up" data-aos-duration="800">
      <div class="inline-block bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-2 rounded-full font-bold text-sm mb-4">
        ⭐ Quality selection
      </div>
      <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
        <span class="gradient-text">Featured providers</span>
      </h2>
      <p class="text-gray-600 text-lg">Selection based on responsiveness, quality and customer reviews 🏆</p>
    </div>

    <!-- Featured Providers Grid - 5 profiles on 1 line -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="featuredProvidersGrid">
      @php
        // Get providers with best ratings (random among top)
        $featuredProviders = $providers
          ->sortByDesc(function($provider) {
            return $provider->reviews()->avg('rating') ?? 0;
          })
          ->take(20)
          ->shuffle()
          ->take(5);
      @endphp

      @foreach ($featuredProviders as $provider)
        @php
          $avgRating = $provider->reviews()->avg('rating') ?? 5.0;
          $reviewCount = $provider->reviews()->count();
          $statuses = json_decode($provider->special_status, true) ?? [];
          $firstSpecialty = !empty($statuses) ? array_key_first($statuses) : null;
          
          $providerCategories = [];
          if (isset($provider->categories) && is_string($provider->categories)) {
            $categoryIds = json_decode($provider->categories, true);
            if (is_array($categoryIds)) {
              $providerCategories = $category->whereIn('id', $categoryIds)->take(2)->pluck('name')->toArray();
            }
          }
          elseif (isset($provider->categories) && is_array($provider->categories)) {
            $providerCategories = array_slice($provider->categories, 0, 2);
          }
          elseif (method_exists($provider, 'categories')) {
            try {
              $providerCategories = $provider->categories()->take(2)->pluck('name')->toArray();
            } catch (\Exception $e) {
              $providerCategories = [];
            }
          }
          elseif (isset($provider->category_id)) {
            $cat = $category->where('id', $provider->category_id)->first();
            if ($cat) {
              $providerCategories = [$cat->name];
            }
          }
        @endphp

        <a href="{{ route('provider-details', ['id' => $provider->slug]) }}" 
          class="profile-card card-modern bg-white rounded-3xl overflow-hidden block group relative"
          data-aos="fade-up"
          data-aos-delay="{{ $loop->index * 30 }}"
          data-aos-duration="600">
          
          <!-- Featured Badge -->
          <div class="absolute top-2 left-2 z-20">
            <span class="featured-badge text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
              ⭐ Featured
            </span>
          </div>

          @php
            $src = trim((string)($provider->profile_photo ?? ''));
            $fallback = asset('images/attachment.png');
            $path = $src ? parse_url($src, PHP_URL_PATH) : '';
            $ext  = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : null;
            $isSvg = $ext === 'svg';
          @endphp

          <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-yellow-100 to-orange-100">
            <img
              src="{{ $src ?: $fallback }}"
              alt="{{ $provider->first_name }}"
              class="provider-image absolute inset-0 w-full h-full {{ $isSvg ? 'object-contain bg-white p-6' : 'object-cover' }}"
              onerror="this.onerror=null;this.src='{{ $fallback }}';"
            />
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            @if($firstSpecialty)
              <div class="absolute top-12 left-3">
                <span class="badge-specialty text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                  {{ $firstSpecialty }}
                </span>
              </div>
            @endif

            <div class="absolute top-3 right-3">
              <div class="status-online w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-lg"></div>
            </div>

            @if($provider->preferred_language)
              <div class="absolute bottom-3 left-3">
                <span class="bg-white/90 backdrop-blur text-gray-800 px-2.5 py-1 rounded-full text-xs font-bold">
                  🗣️ {{ $provider->preferred_language }}
                </span>
              </div>
            @endif
          </div>

          <div class="p-4">
            <div class="mb-2">
              <h3 class="font-bold text-base text-gray-900 truncate mb-1">
                {{ $provider->first_name ?? 'Provider' }}
                @if($provider->last_name)
                  {{ substr($provider->last_name, 0, 1) }}.
                @endif
              </h3>
              
              <div class="flex items-center mb-2">
                <div class="flex text-yellow-400 text-xs">
                  @php
                    $fullStars = floor($avgRating);
                  @endphp
                  @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-3 h-3 {{ $i <= $fullStars ? 'fill-current' : 'fill-gray-300' }}" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                  @endfor
                </div>
                <span class="ml-1 text-xs font-bold text-gray-700">{{ number_format($avgRating, 1) }}</span>
                <span class="ml-1 text-xs text-gray-500">({{ $reviewCount }})</span>
              </div>
            </div>

            @if(!empty($providerCategories))
              <div class="mb-2">
                <p class="text-xs font-bold text-gray-500 mb-1">📂 Services:</p>
                <div class="flex flex-wrap gap-1">
                  @foreach($providerCategories as $cat)
                    <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      {{ $cat }}
                    </span>
                  @endforeach
                </div>
              </div>
            @endif

            @php 
              $operationalCountriesRaw = $provider->operational_countries ?? [];
              if (is_string($operationalCountriesRaw)) {
                $operationalCountries = json_decode($operationalCountriesRaw, true) ?? [];
              } else {
                $operationalCountries = $operationalCountriesRaw;
              }
            @endphp

            @if(!empty($operationalCountries))
              <div class="pt-2 border-t border-gray-100">
                <p class="text-xs font-bold text-gray-500 mb-1">🌍 Countries of operation:</p>
                <div class="flex flex-wrap gap-1">
                  @foreach(array_slice($operationalCountries, 0, 2) as $country)
                    <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      {{ $country }}
                    </span>
                  @endforeach
                  @if(count($operationalCountries) > 2)
                    <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                      +{{ count($operationalCountries) - 2 }}
                    </span>
                  @endif
                </div>
              </div>
            @endif
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- WHY CHOOSE US - NEW SECTION -->
<section class="py-16 px-4 bg-indigo-50">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
      <div class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full font-bold text-sm mb-4">
        ✨ WHY ULIXAI
      </div>
      <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
        Why Ulixai
      </h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">
        The one and only platform that connects traveler seekers and service providers in a benevolent competition
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card 1: Security -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">Security</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          Payment held in escrow until service delivery or help
        </p>
      </div>

      <!-- Card 2: Speed -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-orange-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">Post... Find!</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          Post your service request ad (visa, bank, work, storage, etc.) and wait for offers from providers, compare and choose!
        </p>
      </div>

      <!-- Card 3: International -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-teal-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">International 197+ countries</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          Global presence in all countries
        </p>
      </div>

      <!-- Card 4: Trust -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-purple-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">Trust</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          Verified reviews and certified providers
        </p>
      </div>

      <!-- Card 5: Transparency -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-green-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">Transparency</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          Clear prices, no hidden fees
        </p>
      </div>

      <!-- Card 6: Excellence -->
      <div class="why-choose-card" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-pink-100 flex items-center justify-center">
          <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
          </svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 mb-2 text-center">Excellence</h3>
        <p class="text-gray-600 text-sm text-center leading-relaxed">
          100% verified providers
        </p>
      </div>
    </div>
  </div>
</section>


  <!-- WORLD MAP -->
@include('pages.ulixai-map')

<!-- SECURITY & ESCROW - NEW SECTION -->
<section class="py-16 px-4 bg-emerald-50">
  <div class="max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div data-aos="fade-right" data-aos-duration="800">
        <div class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-bold text-sm mb-4">
          🔒 Maximum Security
        </div>
        <h2 class="text-4xl sm:text-5xl font-display font-black mb-6">
          Your money is protected
        </h2>
        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
          Payment is held in escrow until your validation. 3DS protection, supervised disputes, fast refunds.
        </p>

        <div class="space-y-4">
          <div class="flex items-start space-x-4 bg-white rounded-2xl p-4 shadow-md">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1">Escrow payment</h4>
              <p class="text-gray-600 text-sm">Your money is securely held until service validation</p>
            </div>
          </div>

          <div class="flex items-start space-x-4 bg-white rounded-2xl p-4 shadow-md">
            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1">3D Secure & SSL</h4>
              <p class="text-gray-600 text-sm">Military-grade banking encryption for all your transactions</p>
            </div>
          </div>

          <div class="flex items-start space-x-4 bg-white rounded-2xl p-4 shadow-md">
            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-gray-900 mb-1">Validation before release</h4>
              <p class="text-gray-600 text-sm">You validate the service before the provider receives payment within 7 days after delivery of your service</p>
            </div>
          </div>

          
        </div>
      </div>

      <div data-aos="fade-left" data-aos-duration="800" class="relative">
        <div class="bg-white rounded-3xl p-8 shadow-2xl border-2 border-blue-100">
          <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center animate-pulse-glow">
              <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">How does Escrow payment work?</h3>
          </div>

          <div class="space-y-4">
            <div class="flex items-center space-x-4 bg-blue-50 rounded-xl p-4 border-2 border-blue-100">
              <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">1</div>
              <div class="text-sm text-gray-700 font-medium">You pay → money is held in a secure account</div>
            </div>
            <div class="flex items-center space-x-4 bg-blue-50 rounded-xl p-4 border-2 border-blue-100">
              <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">2</div>
              <div class="text-sm text-gray-700 font-medium">The provider performs the service</div>
            </div>
            <div class="flex items-center space-x-4 bg-green-50 rounded-xl p-4 border-2 border-green-200">
              <div class="flex-shrink-0 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">3</div>
              <div class="text-sm text-gray-700 font-medium">You validate → payment is released to the provider</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOR PROVIDERS CTA -->
<section class="py-12 px-4 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-10 right-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
  </div>

  <div class="max-w-5xl mx-auto text-center relative z-10">
    <div data-aos="zoom-in" data-aos-duration="800">
      <div class="inline-block bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-full font-bold text-sm mb-6">
        💼 For local pros and helping expats
      </div>
      <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-black text-white mb-6 leading-tight">
        Become a multilingual helping expat & <br class="hidden sm:block">Develop your international activity
      </h2>
      <p class="text-white/90 text-xl mb-10 max-w-3xl mx-auto leading-relaxed">
        Join thousands of verified helping expats serving other expats and travelers in all countries around the world. 
        Set your rates, choose your clients, and get paid securely.
      </p>

      <div class="grid sm:grid-cols-3 gap-6 mb-10">
        <div class="bg-white/10 backdrop-blur rounded-2xl p-6 border border-white/20">
          <div class="text-4xl mb-3">💰</div>
          <h4 class="font-bold text-white mb-2">Set your rates</h4>
          <p class="text-white/80 text-sm">You decide your prices</p>
        </div>
        <div class="bg-white/10 backdrop-blur rounded-2xl p-6 border border-white/20">
          <div class="text-4xl mb-3">🌍</div>
          <h4 class="font-bold text-white mb-2">Global reach</h4>
          <p class="text-white/80 text-sm">Expat clients in 197 countries</p>
        </div>
        <div class="bg-white/10 backdrop-blur rounded-2xl p-6 border border-white/20">
          <div class="text-4xl mb-3">⚡</div>
          <h4 class="font-bold text-white mb-2">Fast payments</h4>
          <p class="text-white/80 text-sm">Secure international system</p>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('service-providers') }}" class="bg-white text-blue-600 px-10 py-4 rounded-full font-bold text-lg btn-shine hover:scale-105 transition-transform shadow-2xl">
          Start earning →
        </a>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-16 px-4 bg-purple-50">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
      <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
        <span class="gradient-text">Expat stories, Real impact</span>
      </h2>
      <p class="text-gray-600 text-lg">Listen to travelers who found their solution 💬</p>
    </div>

    <div class="overflow-x-auto md:overflow-visible pb-4 scrollbar-hide">
      <div class="flex md:grid md:grid-cols-3 gap-8 min-w-max md:min-w-0">
        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Sarah M.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">🏠 Storage with an expat for 6 months</h5>
          <p class="text-gray-600 leading-relaxed">
            Between two assignments, I needed to store my belongings in Barcelona. A French expat offered me secure space at his place for a fraction of the price of traditional storage. Simple and reassuring!
          </p>
        </div>

        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="Marcus" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Marcus K.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">💼 Obtaining work visa in Japan</h5>
          <p class="text-gray-600 leading-relaxed">
            Japanese administrative procedures seemed impossible to me. A bilingual expat consultant guided me from start to finish. Visa obtained in 3 weeks instead of 3 months!
          </p>
        </div>

        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Elena" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Elena R.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">🔧 Emergency apartment repair in Dubai</h5>
          <p class="text-gray-600 leading-relaxed">
            Major water leak on a Friday evening in Dubai. A French-speaking expat plumber intervened in 2 hours, negotiated with the local landlord and fixed everything. Pure happiness!
          </p>
        </div>

        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Thomas" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Thomas B.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">🚗 Car rental between expats in Lisbon</h5>
          <p class="text-gray-600 leading-relaxed">
            Rather than renting from Hertz, I found an expat who rented his car. Half price, local tips included and a real human connection. Top!
          </p>
        </div>

        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Amira" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Amira T.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">📋 Certified translation of marriage documents</h5>
          <p class="text-gray-600 leading-relaxed">
            Urgent need to translate my marriage documents into Mandarin. A certified expat translator did everything in 24 hours with apostille. Marriage validated in Shanghai!
          </p>
        </div>

        <div class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Carlos" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
            <div>
              <div class="flex items-center gap-2 mb-1 flex-wrap">
                <h4 class="font-bold text-gray-900">Carlos P.</h4>
                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
              </div>
              <div class="flex text-yellow-400 text-sm">
                ⭐⭐⭐⭐⭐
              </div>
            </div>
          </div>
          <h5 class="font-bold text-gray-800 mb-2">🏥 Medical assistance in Bangkok</h5>
          <p class="text-gray-600 leading-relaxed">
            Medical emergency in Thailand without speaking Thai. An expat nursing assistant accompanied me to the hospital, translated everything and negotiated rates. A guardian angel!
          </p>
        </div>
      </div>
    </div>

    <div class="mt-12" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-8 sm:p-12 text-center text-white shadow-2xl">
        <div class="max-w-3xl mx-auto">
          <div class="flex justify-center mb-6">
            <div class="relative">
              <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Featured" class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
              <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-purple-700 text-white text-xs px-3 py-1 rounded-full font-semibold whitespace-nowrap border-2 border-white">Early Beta User</span>
            </div>
          </div>
          <div class="text-yellow-300 text-2xl mb-4">⭐⭐⭐⭐⭐</div>
          <h3 class="text-3xl font-black mb-4">Bank account opening made simple!</h3>
          <p class="text-xl text-white/90 leading-relaxed">
            "Opening a bank account in Germany without speaking German seemed impossible. An expat advisor physically accompanied me to the bank, translated and explained everything. <strong>Account opened in 1 hour instead of several weeks of hassle.</strong> This platform is a gem for expats!"
          </p>
          <p class="mt-6 font-semibold">— Marie D., Expat in Germany 🇩🇪</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="py-16 px-4 bg-sky-50">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
      <h2 class="text-4xl sm:text-5xl font-display font-black mb-4">
        <span class="gradient-text">Frequently asked questions from expats</span>
      </h2>
      <p class="text-gray-600 text-lg">Everything you need to know 🤔</p>
    </div>

    <div class="space-y-4">
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="0" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">1</span>
            <span>How does the platform work to find a helping expat?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            It's very simple! You describe your need (visa, translation, relocation, repair, storage, etc.), we connect you with verified and multilingual helping expats in your country. You choose the profile that suits you, discuss directly with them, and validate the service. Payment is secure and you benefit from 24/7 support.
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">2</span>
            <span>What types of services can I find on the platform?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            We cover all expat needs: administrative procedures (visas, work permits, bank account opening), certified translations, medical assistance, work and repairs, property storage, vehicle rental between expats, language courses, moving assistance, and much more. If you have a specific need, there is definitely a helping expat to assist you!
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">3</span>
            <span>Are helping expats verified and reliable?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            Absolutely! All our helping expats go through a rigorous verification process: identity validation, skill verification, professional certification control if necessary, and customer review system. In addition, each transaction is secured and our moderation team monitors service quality 24/7.
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">4</span>
            <span>How are service rates set?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            Each helping expat sets their own rates based on their expertise, type of service, and the country where they operate. You can compare profiles, read reviews, and choose the one that fits your budget. Generally, our rates are 30 to 50% cheaper than traditional services, as we eliminate intermediaries.
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern border-2 border-purple-200" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="bg-purple-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0 text-sm">5</span>
            <span class="flex items-center gap-2 flex-wrap">
              What is an "Early Beta User"?
              <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full font-semibold">Early Beta User</span>
            </span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            "Early Beta Users" are our first platform testers! They are pioneer expats who agreed to test our features in preview, give us constructive feedback, and help us improve the user experience. In exchange, they benefit from lifetime preferential rates, priority access to new features, and a distinctive badge on their profile. Their reviews are particularly valuable because they know the platform inside out!
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="250" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">6</span>
            <span>In which countries is the platform available?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            Our helping expat network currently covers 197 countries around the world! From the United States to Japan, from Australia to Brazil, including all countries in Europe, Africa and Asia. Wherever you are as an expat, you will find a multilingual professional ready to help you. And our community grows every day!
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">7</span>
            <span>How can I become a helping expat and offer my services?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            If you are an expat or multilingual local professional, join us! Create your profile in a few minutes, describe your skills and services, set your rates, and start receiving requests. We take a small commission on each transaction, but you keep total control of your activity. It's an excellent way to generate additional income while helping other expats!
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-modern" data-aos="fade-up" data-aos-delay="350" data-aos-duration="600">
        <button class="w-full flex items-center justify-between p-6 text-left faq-toggle" onclick="toggleFAQ(this)">
          <span class="flex items-center text-lg font-bold text-gray-800 flex-1 pr-4">
            <span class="number-badge mr-4 flex-shrink-0 w-10 h-10 text-sm">8</span>
            <span>What happens if I am not satisfied with the service?</span>
          </span>
          <svg class="w-6 h-6 text-gray-600 transition-transform duration-300 faq-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="faq-content px-6 pb-0">
          <div class="pb-6 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
            Your satisfaction is our priority! We have put in place a satisfaction guarantee: if the service does not match what was agreed, contact our support within 48 hours. We will analyze the situation and, depending on the case, offer a partial or full refund, or connect you with another helping expat. Our review system also helps maintain service quality.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- FINAL CTA -->
<section class="py-12 px-4 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-20 left-20 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
  </div>

  <div class="max-w-4xl mx-auto text-center relative z-10" data-aos="zoom-in" data-aos-duration="800">
    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-3xl p-12 sm:p-16">
      <div class="text-6xl mb-6">🚀</div>
      <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-black text-white mb-6 leading-tight">
        Ready to simplify <br class="hidden sm:block">your expat life?
      </h2>
      <p class="text-white/90 text-xl sm:text-2xl mb-10 leading-relaxed">
        Join 304 millions expats and 1,645 milliard travelers who love life in the world
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
              </div>
      <p class="text-white/70 text-sm mt-6">✓ No credit card required  •  ✓ 100% free only fees on each operate  •  ✓ Multilingual</p>
    </div>
  </div>
</section>



@include('includes.footer')

<!-- AI POPUP -->
<div class="ai-popup-overlay" id="aiPopupOverlay" onclick="closeAIPopup()"></div>
<div class="ai-popup" id="aiPopup">
  <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-6 relative">
      <button onclick="closeAIPopup()" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      <div class="text-center">
        <div class="text-6xl mb-3 ai-robot">🤖</div>
        <h3 class="text-2xl font-black text-white">Ulysses coming soon!</h3>
      </div>
    </div>
    
    <div class="p-8 text-center">
      <div class="mb-6">
        <div class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-bold text-sm mb-4">
          🚀 Coming very soon
        </div>
      </div>
      <p class="text-gray-700 text-lg leading-relaxed mb-6">
        The AI <strong class="text-purple-600">Ulysses</strong> is learning all the languages of the world! 🌍
      </p>
      <p class="text-gray-600 text-base leading-relaxed">
        Stay connected, Ulysses is coming soon with plenty of superpowers for expats, travelers and vacationers around the world! ✨
      </p>
      
      <div class="flex justify-center space-x-2 mt-6 text-3xl">
        <span class="animate-bounce" style="animation-delay: 0s;">📚</span>
        <span class="animate-bounce" style="animation-delay: 0.1s;">🗣️</span>
        <span class="animate-bounce" style="animation-delay: 0.2s;">🌐</span>
        <span class="animate-bounce" style="animation-delay: 0.3s;">💬</span>
      </div>
    </div>
    
    <div class="bg-gray-50 px-8 py-4 text-center">
      <p class="text-sm text-gray-500">The AI that makes expat life even simpler 🎉</p>
    </div>
  </div>
</div>

<!-- BACK TO TOP -->
<div id="backToTop">
  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
  </svg>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ mix('js/app.js') }}"></script>

<script>
  // Initialize AOS with reduced effects
  AOS.init({
    duration: 600,
    once: true,
    offset: 50,
    easing: 'ease-out'
  });

  // Store original providers for reset
  let originalProvidersHTML = document.getElementById('serviceGrid').innerHTML;

  // AI Popup Functions
  let aiPopupTimer = null;

  function openAIPopup() {
    const popup = document.getElementById('aiPopup');
    const overlay = document.getElementById('aiPopupOverlay');
    
    popup.classList.add('show');
    overlay.classList.add('show');
    
    aiPopupTimer = setTimeout(() => {
      closeAIPopup();
    }, 5000);
  }

  function closeAIPopup() {
    const popup = document.getElementById('aiPopup');
    const overlay = document.getElementById('aiPopupOverlay');
    
    popup.classList.remove('show');
    overlay.classList.remove('show');
    
    if (aiPopupTimer) {
      clearTimeout(aiPopupTimer);
      aiPopupTimer = null;
    }
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeAIPopup();
    }
  });

  // Back to Top
  const backToTop = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      backToTop.classList.add('show');
    } else {
      backToTop.classList.remove('show');
    }
  });
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Scroll Bubbles
  function scrollBubbles(direction) {
    const container = document.getElementById('categoryContainer');
    const scrollAmount = 300;
    if (direction === 'next') {
      container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    } else {
      container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }
  }

  // FAQ Toggle
  function toggleFAQ(button) {
    const content = button.nextElementSibling;
    const toggle = button;
    const isActive = content.classList.contains('active');

    document.querySelectorAll('.faq-content').forEach(item => {
      item.classList.remove('active');
    });
    document.querySelectorAll('.faq-toggle').forEach(item => {
      item.classList.remove('active');
    });

    if (!isActive) {
      content.classList.add('active');
      toggle.classList.add('active');
    }
  }

  // Category Filter with Subcategories
  document.getElementById('categorySelect').addEventListener('change', function() {
    const categoryId = this.value;
    const subcategoryWrapper = document.getElementById('subcategoryWrapper');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const subsubcategoryWrapper = document.getElementById('subsubcategoryWrapper');
    
    if (categoryId) {
      fetch(`/get-subcategories/${categoryId}`)
        .then(response => response.json())
        .then(subcategories => {
          subcategorySelect.innerHTML = '<option value="">Select</option>';
          subcategories.forEach(function(subcategory) {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.textContent = subcategory.name;
            subcategorySelect.appendChild(option);
          });
          subcategoryWrapper.classList.remove('hidden');
          subsubcategoryWrapper.classList.add('hidden');
        })
        .catch(error => console.error('Error:', error));
    } else {
      subcategoryWrapper.classList.add('hidden');
      subsubcategoryWrapper.classList.add('hidden');
    }
  });

  // Subcategory Filter
  document.getElementById('subcategorySelect').addEventListener('change', function() {
    const subcategoryId = this.value;
    const subsubcategoryWrapper = document.getElementById('subsubcategoryWrapper');
    const subsubcategorySelect = document.getElementById('subsubcategorySelect');
    
    if (subcategoryId) {
      fetch(`/get-subsubcategories/${subcategoryId}`)
        .then(response => response.json())
        .then(subsubcategories => {
          if (subsubcategories && subsubcategories.length > 0) {
            subsubcategorySelect.innerHTML = '<option value="">Select</option>';
            subsubcategories.forEach(function(subsubcategory) {
              const option = document.createElement('option');
              option.value = subsubcategory.id;
              option.textContent = subsubcategory.name;
              subsubcategorySelect.appendChild(option);
            });
            subsubcategoryWrapper.classList.remove('hidden');
          } else {
            subsubcategoryWrapper.classList.add('hidden');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          subsubcategoryWrapper.classList.add('hidden');
        });
    } else {
      subsubcategoryWrapper.classList.add('hidden');
    }
  });

  // Reset Filters Button
  document.getElementById('resetFiltersButton').addEventListener('click', function() {
    document.getElementById('languageSelect').value = '';
    document.getElementById('countrySelect').value = '';
    document.getElementById('categorySelect').value = '';
    document.getElementById('subcategorySelect').value = '';
    document.getElementById('subsubcategorySelect').value = '';
    
    document.getElementById('subcategoryWrapper').classList.add('hidden');
    document.getElementById('subsubcategoryWrapper').classList.add('hidden');
    
    const serviceGrid = document.getElementById('serviceGrid');
    serviceGrid.innerHTML = originalProvidersHTML;
    
    AOS.refresh();
  });

  // Filter Button
  document.getElementById('filterButton').addEventListener('click', function() {
    const categoryId = document.getElementById('categorySelect').value;
    const subcategoryId = document.getElementById('subcategorySelect').value;
    const subsubcategoryId = document.getElementById('subsubcategorySelect').value || '';
    const language = document.getElementById('languageSelect').value;
    const country = document.getElementById('countrySelect').value;

    const serviceGrid = document.getElementById('serviceGrid');
    serviceGrid.innerHTML = `
      <div class="col-span-full flex justify-center py-16">
        <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-blue-600"></div>
      </div>
    `;

    fetch(`/filter-providers?category_id=${categoryId}&subcategory_id=${subcategoryId}&subsubcategory_id=${subsubcategoryId}&country=${country}&language=${language}`)
      .then(response => response.json())
      .then(providers => {
        serviceGrid.innerHTML = '';
        
        if (providers.length > 0) {
          providers.slice(0, 10).forEach(function(provider, index) {
            const specialStatus = provider.special_status ? JSON.parse(provider.special_status) : {};
            const operationalCountries = Array.isArray(provider.operational_countries) 
              ? provider.operational_countries 
              : (provider.operational_countries ? JSON.parse(provider.operational_countries) : []);
            
            const avgRating = provider.average_rating || 5.0;
            const reviewCount = provider.reviews_count || 0;
            const fullStars = Math.floor(avgRating);
            const firstSpecialty = Object.keys(specialStatus).length > 0 ? Object.keys(specialStatus)[0] : null;
            
            let providerCategories = [];
            if (provider.categories && Array.isArray(provider.categories)) {
              providerCategories = provider.categories.slice(0, 2).map(cat => cat.name);
            } else if (provider.categories && provider.categories.length) {
              try {
                providerCategories = provider.categories.slice(0, 2).map(cat => cat.name || cat);
              } catch(e) {
                providerCategories = [];
              }
            }
            
            const providerCard = `
              <a href="/provider-details/${provider.slug}" 
                class="profile-card card-modern bg-white rounded-3xl overflow-hidden block group"
                data-aos="fade-up"
                data-aos-delay="${index * 30}">
                
                <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100">
                  <img
                    src="${provider.profile_photo || 'images/attachment.png'}"
                    alt="${provider.first_name}"
                    class="provider-image absolute inset-0 w-full h-full object-cover"
                    onerror="this.src='images/attachment.png';"
                  />
                  
                  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                  
                  ${firstSpecialty ? `
                    <div class="absolute top-3 left-3">
                      <span class="badge-specialty text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                        ${firstSpecialty}
                      </span>
                    </div>
                  ` : ''}

                  <div class="absolute top-3 right-3">
                    <div class="status-online w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-lg"></div>
                  </div>

                  ${provider.preferred_language ? `
                    <div class="absolute bottom-3 left-3">
                      <span class="bg-white/90 backdrop-blur text-gray-800 px-2.5 py-1 rounded-full text-xs font-bold">
                        🗣️ ${provider.preferred_language}
                      </span>
                    </div>
                  ` : ''}
                </div>

                <div class="p-4">
                  <div class="mb-2">
                    <h3 class="font-bold text-base text-gray-900 truncate mb-1">
                      ${provider.first_name || 'Provider'}
                    </h3>
                    
                    <div class="flex items-center mb-2">
                      <div class="flex text-yellow-400 text-xs">
                        ${Array(5).fill(0).map((_, i) => `
                          <svg class="w-3 h-3 ${i < fullStars ? 'fill-current' : 'fill-gray-300'}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                          </svg>
                        `).join('')}
                      </div>
                      <span class="ml-1 text-xs font-bold text-gray-700">${avgRating.toFixed(1)}</span>
                      <span class="ml-1 text-xs text-gray-500">(${reviewCount})</span>
                    </div>
                  </div>

                  ${providerCategories.length > 0 ? `
                    <div class="mb-2">
                      <p class="text-xs font-bold text-gray-500 mb-1">📂 Services:</p>
                      <div class="flex flex-wrap gap-1">
                        ${providerCategories.map(cat => `
                          <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                            ${cat}
                          </span>
                        `).join('')}
                      </div>
                    </div>
                  ` : ''}

                  ${operationalCountries.length > 0 ? `
                    <div class="pt-2 border-t border-gray-100">
                      <p class="text-xs font-bold text-gray-500 mb-1">🌍 Countries of operation:</p>
                      <div class="flex flex-wrap gap-1">
                        ${operationalCountries.slice(0, 2).map(country => `
                          <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                            ${country}
                          </span>
                        `).join('')}
                        ${operationalCountries.length > 2 ? `
                          <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                            +${operationalCountries.length - 2}
                          </span>
                        ` : ''}
                      </div>
                    </div>
                  ` : ''}
                </div>
              </a>
            `;
            
            serviceGrid.innerHTML += providerCard;
          });
          
          AOS.refresh();
        } else {
          serviceGrid.innerHTML = `
            <div class="col-span-full text-center py-16">
              <div class="text-6xl mb-4">😢</div>
              <h3 class="text-2xl font-bold text-gray-800 mb-2">No local pro found</h3>
              <p class="text-gray-600 mb-4">Try adjusting your filters or</p>
              <button onclick="document.getElementById('resetFiltersButton').click()" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors">
                Reset filters
              </button>
            </div>
          `;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        serviceGrid.innerHTML = `
          <div class="col-span-full text-center py-16">
            <div class="text-6xl mb-4">⚠️</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Oops! Something went wrong</h3>
            <p class="text-gray-600 mb-4">Please try again</p>
            <button onclick="location.reload()" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors">
              Reload page
            </button>
          </div>
        `;
      });
  });

  // Touch swipe for bubbles
  let startX = 0;
  let endX = 0;
  const categoryContainer = document.getElementById('categoryContainer');

  if (categoryContainer) {
    categoryContainer.addEventListener('touchstart', function(e) {
      startX = e.touches[0].clientX;
    });

    categoryContainer.addEventListener('touchend', function(e) {
      endX = e.changedTouches[0].clientX;
      const threshold = 50;
      const diff = startX - endX;
      
      if (Math.abs(diff) > threshold) {
        if (diff > 0) {
          scrollBubbles('next');
        } else {
          scrollBubbles('prev');
        }
      }
    });
  }
</script>

</body>
</html>