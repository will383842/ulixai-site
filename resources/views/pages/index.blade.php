<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abroad Ease Guide - Support platform for expats | International multilingual services</title>
  <meta name="description" content="Collaborative platform for e...ls and helping expats: visa, translation, housing, relocation.">
  <meta name="keywords" content="expat help, expat services, hel...ernational mutual aid, expat community, multilingual solutions">
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  
  <!-- Leaflet for Map -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  

  <!-- Google Translate -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement(
      {
        pageLanguage: 'en',
        includedLanguages: 'en,fr,de,ru,zh-CN,es,pt,ar,hi',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
      },
      'google_translate_element'
    );
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


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
      font-family: 'Outfit', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background-color: #0F172A;
      color: #0F172A;
    }

    /* Smooth Background Gradient */
    .gradient-bg {
      background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.18), transparent 60%),
                  radial-gradient(circle at top right, rgba(139, 92, 246, 0.15), transparent 55%),
                  radial-gradient(circle at bottom, rgba(16, 185, 129, 0.12), transparent 55%);
    }

    /* Glass Morphism Card */
    .glass-card {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 24px;
      backdrop-filter: blur(12px);
      border: 1px solid rgba(148, 163, 184, 0.3);
    }

    /* Stat Card */
    .stat-card {
      position: relative;
      overflow: hidden;
    }

    .stat-card::before {
      content: '';
      position: absolute;
      width: 120%;
      height: 120%;
      background: conic-gradient(from 220deg, rgba(59, 130, 246, 0.12), transparent 40%, rgba(16, 185, 129, 0.12));
      top: -10%;
      left: -10%;
      opacity: 0;
      z-index: -1;
      transition: opacity 0.4s ease;
    }

    .stat-card:hover::before {
      opacity: 1;
    }

    .stat-card:hover .stat-number {
      transform: translateY(-2px);
    }

    .stat-number {
      transition: transform 0.3s ease;
    }

    /* Badge Glow */
    .badge-glow {
      border-radius: 999px;
      border: 1px solid rgba(96, 165, 250, 0.6);
      background: rgba(15, 23, 42, 0.9);
      box-shadow: 0 0 0 1px rgba(148, 163, 184, 0.5), 0 18px 45px rgba(15, 23, 42, 0.8);
    }

    .badge-light {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 999px;
      border: 1px solid rgba(148, 163, 184, 0.5);
    }

    /* Scrolling Testimonials */
    .testimonial-track {
      display: flex;
      animation: auto-scroll 40s linear infinite;
      width: max-content;
    }

    .testimonial-row {
      display: flex;
      gap: 24px;
      padding-block: 8px;
    }

    .testimonial-card {
      background: white;
      border-radius: 24px;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
      padding: 20px;
    }

    .testimonial-card p {
      position: relative;
      padding-left: 24px;
    }

    .testimonial-card p::before {
      content: '“';
      position: absolute;
      left: 0;
      top: -8px;
      font-size: 32px;
      color: rgba(59, 130, 246, 0.4);
      line-height: 1;
    }

    @keyframes auto-scroll {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    /* Scrollbar */
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
      background: white;
      border: 1px solid rgba(148, 163, 184, 0.4);
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .category-bubble:hover {
      transform: translateY(-4px);
      border-color: rgba(59, 130, 246, 0.6);
      box-shadow: 0 18px 40px rgba(37, 99, 235, 0.18);
    }

    .category-bubble-icon {
      width: 42px;
      height: 42px;
      border-radius: 999px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 6px;
    }

    /* Provider card */
    .provider-card {
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid rgba(203, 213, 225, 0.7);
      box-shadow: 0 16px 35px rgba(15, 23, 42, 0.12);
      transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .provider-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 24px 50px rgba(15, 23, 42, 0.24);
      border-color: rgba(59, 130, 246, 0.7);
    }

    .provider-image-wrapper {
      position: relative;
      padding-top: 60%;
      overflow: hidden;
      background: radial-gradient(circle at top, rgba(59, 130, 246, 0.15), rgba(15, 23, 42, 0.85));
    }

    .provider-image-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(15, 23, 42, 0.8), transparent 50%);
      opacity: 0.8;
    }

    .provider-image {
      transition: transform 0.4s ease;
    }

    .provider-card:hover .provider-image {
      transform: scale(1.04);
    }

    .provider-rating {
      display: inline-flex;
      align-items: center;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(15, 23, 42, 0.88);
      color: #FACC15;
      font-weight: 600;
      font-size: 0.8rem;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(148, 163, 184, 0.5);
    }

    /* Tags */
    .tag-chip {
      display: inline-flex;
      align-items: center;
      padding: 4px 10px;
      border-radius: 999px;
      background: #EFF6FF;
      color: #1D4ED8;
      font-weight: 500;
      font-size: 0.8rem;
    }

    .tag-chip.secondary {
      background: #F5F3FF;
      color: #6D28D9;
    }

    .tag-chip.neutral {
      background: #F1F5F9;
      color: #0F172A;
    }

    /* Map container */
    #map {
      height: 100%;
      min-height: 280px;
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid rgba(148, 163, 184, 0.6);
      box-shadow: 0 18px 45px rgba(15, 23, 42, 0.35);
    }

    /* Pill Buttons */
    .pill-button {
      border-radius: 999px;
      padding: 10px 16px;
      font-weight: 500;
      border: 1px solid transparent;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .pill-button:hover {
      transform: translateY(-1px);
      box-shadow: 0 12px 28px rgba(15, 23, 42, 0.18);
    }

    /* CTA Gradient */
    .cta-gradient {
      background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.4), transparent 55%),
                  radial-gradient(circle at top right, rgba(139, 92, 246, 0.4), transparent 55%),
                  linear-gradient(135deg, #1D4ED8, #4F46E5);
    }

    /* Divider line */
    .soft-divider {
      height: 1px;
      background: linear-gradient(to right, transparent, rgba(148, 163, 184, 0.4), transparent);
    }

    /* AOS triggered elements */
    [data-aos] {
      will-change: transform, opacity;
    }

    /* Hero background blur for the right side card */
    .hero-floating-card {
      backdrop-filter: blur(12px);
      background: rgba(15, 23, 42, 0.88);
      border-radius: 24px;
      border: 1px solid rgba(148, 163, 184, 0.4);
      box-shadow: 0 22px 60px rgba(15, 23, 42, 0.5);
    }

    /* Trust bar */
    .trust-badge {
      border-radius: 999px;
      padding: 6px 12px;
      border: 1px solid rgba(148, 163, 184, 0.7);
      background: rgba(15, 23, 42, 0.9);
      backdrop-filter: blur(10px);
    }

    /* Horizontal scroll container */
    .scroll-container {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      scroll-behavior: smooth;
      padding-bottom: 4px;
    }

    .scroll-container::-webkit-scrollbar {
      height: 6px;
    }

    .scroll-container::-webkit-scrollbar-thumb {
      background: rgba(148, 163, 184, 0.7);
      border-radius: 999px;
    }

    /* Aspect Ratio Helper */
    .aspect-ratio-box {
      position: relative;
      width: 100%;
      padding-top: 60%;
    }

    .aspect-ratio-box > * {
      position: absolute;
      inset: 0;
    }

    /* Status Badge */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: 999px;
      background: rgba(34, 197, 94, 0.08);
      border: 1px solid rgba(34, 197, 94, 0.35);
      color: #16A34A;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .status-dot {
      width: 8px;
      height: 8px;
      border-radius: 999px;
      background: #22C55E;
      box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.35);
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
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4)
    }

    /* AI Popup Styles */
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
      color: #92400E;
      border-radius: 999px;
      padding: 4px 10px;
      display: inline-flex;
      align-items: center;
      font-size: 0.7rem;
      font-weight: 700;
      box-shadow: 0 12px 30px rgba(245, 158, 11, 0.35);
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .ai-popup {
      position: fixed;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      visibility: hidden;
      transform: translateY(20px);
      transition: all 0.3s ease;
      z-index: 10000;
      padding: 16px;
    }

    .ai-popup.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    /* Steps Connector */
    .steps-connector {
      position: absolute;
      top: 24px;
      left: 24px;
      right: 24px;
      height: 2px;
      background: repeating-linear-gradient(
        to right,
        rgba(148, 163, 184, 0.6),
        rgba(148, 163, 184, 0.6) 10px,
        transparent 10px,
        transparent 18px
      );
      z-index: -1;
    }

    /* Tooltip Style */
    .tooltip {
      position: relative;
    }

    .tooltip-text {
      position: absolute;
      bottom: 100%;
      left: 50%;
      transform: translateX(-50%);
      padding: 6px 10px;
      border-radius: 999px;
      background: rgba(15, 23, 42, 0.98);
      color: white;
      font-size: 0.7rem;
      white-space: nowrap;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s ease;
      margin-bottom: 6px;
      pointer-events: none;
    }

    .tooltip:hover .tooltip-text {
      opacity: 1;
      visibility: visible;
      transform: translate(-50%, -3px);
    }

    /* Back to top button */
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
      color: white;
      cursor: pointer;
      border: none;
      outline: none;
      box-shadow: 0 18px 40px rgba(37, 99, 235, 0.35);
      opacity: 0;
      visibility: hidden;
      transform: translateY(20px);
      transition: all 0.25s ease;
      z-index: 9980;
    }

    #backToTop.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    #backToTop:hover {
      transform: translateY(-2px);
      box-shadow: 0 22px 55px rgba(37, 99, 235, 0.45);
    }

    /* FAQ accordion */
    .faq-item {
      border-radius: 20px;
      background: white;
      border: 1px solid rgba(148, 163, 184, 0.5);
      transition: box-shadow 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
    }

    .faq-item.active {
      border-color: rgba(37, 99, 235, 0.7);
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.18);
      transform: translateY(-2px);
    }

    .faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.35s ease-out;
    }

    .faq-content.active {
      max-height: 600px;
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
      50% { opacity: 0.4; }
    }

    .status-pulse {
      animation: status-pulse 1.5s ease-in-out infinite;
    }

    /* Device optimization */
    @media (max-width: 768px) {
      .hide-on-mobile {
        display: none !important;
      }
    }

    @media (max-width: 1024px) {
      .hero-layout {
        flex-direction: column;
      }
    }

    /* Google translate override */
    .goog-te-gadget-simple {
      background-color: white !important;
      border: 1px solid rgba(148, 163, 184, 0.8) !important;
      border-radius: 999px !important;
      padding: 4px 10px !important;
      font-size: 0.8rem !important;
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.18);
    }

    .goog-te-gadget img {
      display: none !important;
    }

    .goog-te-gadget-simple span {
      color: #1F2937 !important;
    }

    .goog-te-gadget-simple .goog-te-menu-value span {
      border: none !important;
    }

    .goog-te-gadget-simple .goog-te-menu-value span:nth-child(5) {
      display: none !important;
    }

    .goog-te-gadget-simple .goog-te-menu-value:before {
      content: '🌐 ';
      font-size: 1rem;
    }

    .goog-logo-link,
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

    /* Performance: disable non-critical animations and heavy blur */
    .animate-float,
    .animate-pulse-glow,
    .animate-pulse,
    .animate-bounce,
    .animate-spin,
    .ai-robot {
      animation: none !important;
    }

    .backdrop-blur,
    .backdrop-blur-sm,
    .ai-popup-overlay {
      -webkit-backdrop-filter: none !important;
      backdrop-filter: none !important;
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

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',
            'primary-dark': '#2563EB',
            secondary: '#8B5CF6',
            accent: '#EC4899',
          },
          fontFamily: {
            display: ['Outfit', 'sans-serif'],
          },
        }
      }
    }
  </script>
</head>

<body class="bg-white overflow-x-hidden pt-20 lg:pt-20">

  <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-white focus:text-blue-600 focus:px-4 focus:py-2 focus:rounded">
    Skip to main content
  </a>
  
  @include('includes.header')
  <!-- Google Translate Widget -->
<div class="fixed top-20 right-4 z-50">
  <div id="google_translate_element"></div>
</div>


  <!-- HERO SECTION -->
  <main id="main-content">
    <section class="relative bg-blue-600 pt-20 pb-32 px-4 overflow-hidden" style="background-color: #3B82F6;">
    <div class="max-w-5xl mx-auto text-center relative z-10">
      <!-- Title -->
      <h1 class="hero-title font-display font-black text-white mb-6 text-3xl sm:text-4xl md:text-5xl leading-tight">
        International <span class="text-yellow-300">support platform</span> for expats & travellers, <span class="text-yellow-300">available worldwide</span>.
      </h1>
    
      <!-- Subtitle -->
      <p class="max-w-2xl mx-auto text-blue-100 mb-8 text-base sm:text-lg">
        Wherever you are, connect with local experts, helpers and pros ready to assist you in your language, in minutes:
        <span class="font-semibold text-white">housing, relocation, paperwork, emergencies, and more.</span>
      </p>
    
      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-8">
        <a href="#search" class="btn-shine inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 rounded-full bg-white text-blue-700 font-semibold shadow-lg hover:shadow-xl transition">
          <span>Find an expat helper</span>
          <span class="text-xl">🌍</span>
        </a>
        <a href="#become-helper" class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 rounded-full bg-blue-800/40 text-white border border-blue-200/40 hover:bg-blue-900/60 transition">
          <span>Become a helper</span>
          <span class="text-xl">🤝</span>
        </a>
      </div>
    
      <!-- Trust indicators -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-blue-100 text-xs sm:text-sm">
        <div class="inline-flex items-center gap-2 badge-glow px-3 py-1">
          <span class="w-2 h-2 rounded-full bg-emerald-400 status-pulse"></span>
          <span>Expat request answered every day</span>
        </div>
        <div class="inline-flex items-center gap-2 badge-light px-3 py-1">
          <span class="text-yellow-500">★ ★ ★ ★ ★</span>
          <span class="text-gray-700">Trusted by expats searching for help in 190+ countries</span>
        </div>
      </div>
    </div>
  
    <!-- Background gradient shapes -->
    <div class="absolute inset-0 opacity-40 gradient-bg pointer-events-none"></div>
    <div class="absolute -top-40 -left-40 w-80 h-80 bg-blue-500/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-32 w-80 h-80 bg-indigo-500/40 rounded-full blur-3xl"></div>
  </section>
  

  <!-- QUICK SEARCH SECTION -->
  <section id="search" class="relative -mt-20 pb-16 px-4">
    <div class="max-w-6xl mx-auto">
      <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 sm:p-8 md:p-10 relative overflow-hidden">
        <!-- Banner -->
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-start md:items-center mb-6">
          <div class="flex-1">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold mb-3">
              <span class="w-2 h-2 bg-emerald-400 rounded-full status-pulse"></span>
              <span>Free & instant help guidance – multilingual</span>
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-slate-900 mb-3">
              First time here? Get your expat situation understood in minutes.
            </h2>
            <p class="text-sm sm:text-base text-slate-600">
              Fill one form, and we route you to the best helpers available. No spam, no hidden fees: you choose if you want to go further.
            </p>
          </div>
          <div class="hidden md:flex flex-col items-center justify-center px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200">
            <div class="flex items-center gap-2 mb-1">
              <span class="text-2xl">⚡</span>
              <span class="text-sm font-semibold text-slate-800">Smart routing</span>
            </div>
            <p class="text-xs text-slate-500 text-center max-w-[170px]">
              We show your request to helpers matching your country, language & need.
            </p>
          </div>
        </div>

        <!-- FILTERS -->
        <div class="space-y-6">
          <!-- Categories row -->
          <div class="flex flex-wrap gap-2">
            <button 
              id="filterAllButton"
              class="pill-button text-xs sm:text-sm bg-blue-600 text-white shadow-md flex items-center gap-2">
              <span>All situations</span>
            </button>

            <button 
              id="filterEmergencyButton"
              class="pill-button text-xs sm:text-sm bg-white text-slate-700 border-slate-200 flex items-center gap-2">
              <span>Emergencies</span>
              <span class="w-1.5 h-1.5 rounded-full bg-red-500 status-pulse"></span>
            </button>

            <button 
              id="filterHousingButton"
              class="pill-button text-xs sm:text-sm bg-white text-slate-700 border-slate-200 flex items-center gap-2">
              <span>Housing</span>
            </button>

            <button 
              id="filterLegalButton"
              class="pill-button text-xs sm:text-sm bg-white text-slate-700 border-slate-200 flex items-center gap-2">
              <span>Legal & papers</span>
            </button>

            <button 
              id="filterOtherButton"
              class="pill-button text-xs sm:text-sm bg-white text-slate-700 border-slate-200 flex items-center gap-2">
              <span>Other questions</span>
            </button>
          </div>

          <!-- Smart search form -->
<form id="filterProvidersForm" action="{{ url('/filter-providers') }}" method="GET" class="space-y-4">
    {{-- @csrf pas nécessaire en GET, tu peux le retirer --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <!-- Country -->
        <div class="flex flex-col gap-1">
            <label for="countrySelect" class="text-xs font-semibold text-slate-600">
                Country where you need help
            </label>
    <select
    id="countrySelect"
    name="country"
    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
>
    <option value="">Any country</option>

    @foreach ($countries as $country)
        <option value="{{ $country->id }}">
            {{ $country->country }}
        </option>
    @endforeach
</select>
        </div>

              <!-- Language -->
              <div class="flex flex-col gap-1">
                <label for="languageSelect" class="text-xs font-semibold text-slate-600">
                  Language you want to speak
                </label>
                <select
                  id="languageSelect"
                  name="language"
                  class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Any language</option>
                  @foreach ($languages as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Category -->
              <div class="flex flex-col gap-1">
                <label for="categorySelect" class="text-xs font-semibold text-slate-600">
                  Type of help
                </label>
                <select
                  id="categorySelect"
                  name="category_id"
                  class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Any situation</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Subcategory -->
              <div id="subcategoryWrapper" class="flex flex-col gap-1 hidden">
                <label for="subcategorySelect" class="text-xs font-semibold text-slate-600">
                  More precise (optional)
                </label>
                <select
                  id="subcategorySelect"
                  name="subcategory_id"
                  class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Any</option>
                </select>
              </div>
            </div>

            <!-- Sub-subcategory wrapper -->
            <div id="subsubcategoryWrapper" class="hidden">
              <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1">
                  <label for="subsubcategorySelect" class="text-xs font-semibold text-slate-600">
                    Even more precise (optional)
                  </label>
                  <select
                    id="subsubcategorySelect"
                    name="subsubcategory_id"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">Any</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Free text -->
            <div class="space-y-2">
              <label for="description" class="text-xs font-semibold text-slate-600">
                Describe your situation (optional, but helps a lot)
              </label>
              <textarea
                id="description"
                name="description"
                rows="3"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Example: 'I just arrived in Lisbon, my visa is still in process and I need help finding a room for 3 months, plus someone to explain local registration.'"
              ></textarea>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
              <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                <div class="inline-flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 status-pulse"></span>
                  <span>Real humans, not a bot.</span>
                </div>
                <div class="inline-flex items-center gap-2">
                  <span class="text-yellow-500">★ 4.9</span>
                  <span>Average satisfaction from expats helped.</span>
                </div>
              </div>

              <div class="flex flex-col sm:flex-row gap-3">
                <button
                  type="button"
                  id="resetFiltersButton"
                  class="inline-flex items-center justify-center px-4 py-2.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 transition"
                >
                  Reset all filters
                </button>
                <button
                  type="submit"
                  class="btn-shine inline-flex items-center justify-center px-6 sm:px-8 py-2.5 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition shadow-lg"
                >
                  <span>Show me helpers</span>
                  <span class="ml-2 text-lg">➡️</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- CATEGORIES BUBBLES -->
  <section class="py-10 px-4">
    <div class="max-w-6xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-2">
            All situations covered, step by step.
          </h2>
          <p class="text-sm text-slate-600 max-w-xl">
            From “I’m landing next week” to “I’ve been here 3 years, but this paperwork is crazy” –
            pick the situation that looks the most like yours.
          </p>
        </div>
        <div class="flex gap-2 text-xs text-slate-500">
          <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-50 border border-slate-200">
            <span class="w-2 h-2 rounded-full bg-emerald-400 status-pulse"></span>
            <span>Helpers active now</span>
          </div>
          <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-slate-50 border border-slate-200">
            <span class="text-blue-500">190+</span>
            <span>Countries possible</span>
          </div>
        </div>
      </div>

      <!-- BUBBLES -->
      <div class="scroll-container pb-1">
        <button class="category-bubble" data-category="all">
          <div class="category-bubble-icon bg-blue-50 text-blue-700">
            🌍
          </div>
          <span class="text-xs font-semibold text-slate-800">Any situation</span>
          <span class="text-[11px] text-slate-500">Don't know yet</span>
        </button>

        <button class="category-bubble" data-category="housing">
          <div class="category-bubble-icon bg-emerald-50 text-emerald-700">
            🏠
          </div>
          <span class="text-xs font-semibold text-slate-800">Housing</span>
          <span class="text-[11px] text-slate-500">Flat, room, etc.</span>
        </button>

        <button class="category-bubble" data-category="papers">
          <div class="category-bubble-icon bg-yellow-50 text-yellow-700">
            📄
          </div>
          <span class="text-xs font-semibold text-slate-800">Visas, papers</span>
          <span class="text-[11px] text-slate-500">Local rules</span>
        </button>

        <button class="category-bubble" data-category="emergency">
          <div class="category-bubble-icon bg-red-50 text-red-700">
            🚑
          </div>
          <span class="text-xs font-semibold text-slate-800">Emergency</span>
          <span class="text-[11px] text-slate-500">Urgent help</span>
        </button>

        <button class="category-bubble" data-category="relocation">
          <div class="category-bubble-icon bg-purple-50 text-purple-700">
            ✈️
          </div>
          <span class="text-xs font-semibold text-slate-800">Relocation</span>
          <span class="text-[11px] text-slate-500">Arrival & setup</span>
        </button>

        <button class="category-bubble" data-category="translation">
          <div class="category-bubble-icon bg-pink-50 text-pink-700">
            🗣️
          </div>
          <span class="text-xs font-semibold text-slate-800">Translation</span>
          <span class="text-[11px] text-slate-500">Forms & calls</span>
        </button>

        <button class="category-bubble" data-category="business">
          <div class="category-bubble-icon bg-indigo-50 text-indigo-700">
            💼
          </div>
          <span class="text-xs font-semibold text-slate-800">Business</span>
          <span class="text-[11px] text-slate-500">Company, taxes</span>
        </button>

        <button class="category-bubble" data-category="family">
          <div class="category-bubble-icon bg-teal-50 text-teal-700">
            👨‍👩‍👧
          </div>
          <span class="text-xs font-semibold text-slate-800">Family</span>
          <span class="text-[11px] text-slate-500">Kids, school, etc.</span>
        </button>

        <button class="category-bubble" data-category="health">
          <div class="category-bubble-icon bg-rose-50 text-rose-700">
            🏥
          </div>
          <span class="text-xs font-semibold text-slate-800">Health</span>
          <span class="text-[11px] text-slate-500">Doctors, clinics</span>
        </button>

        <button class="category-bubble" data-category="other">
          <div class="category-bubble-icon bg-slate-50 text-slate-700">
            ❓
          </div>
          <span class="text-xs font-semibold text-slate-800">Other</span>
          <span class="text-[11px] text-slate-500">Anything else</span>
        </button>
      </div>
    </div>
  </section>

  <!-- PROVIDERS + MAP SECTION -->
  <section class="py-10 px-4 bg-slate-50">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- PROVIDERS LIST -->
        <div class="lg:col-span-2 space-y-6">
          <div class="flex items-center justify-between gap-3">
            <div>
              <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-1">
                Helpers & experts matching your filters
              </h2>
              <p class="text-sm text-slate-600">
                We highlight helpers that speak your language, know your target country, and can explain local rules.
              </p>
            </div>
            <div class="hidden sm:flex flex-col items-end text-xs text-slate-500">
              <span>{{ $providers->count() }} profiles visible</span>
              <span>Sorted by relevance & reviews.</span>
            </div>
          </div>

          <!-- Providers grid -->
          <div id="serviceGrid" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse($providers as $provider)
              @php
                $specialStatus = $provider->special_status ? json_decode($provider->special_status, true) : [];
                $avatar = optional($provider->user)->avatar;
                $rp = optional($provider->user)->rp;
                $src = null;
                $fallback = asset('images/attachment.png');

                if ($avatar) {
                    $src = asset('storage/'.$avatar);
                } elseif ($rp && isset($rp->original_name) && isset($rp->extension)) {
                    $src = asset('storage/uploads/'.$rp->original_name.'.'.$rp->extension);
                }

                $ext = $rp && isset($rp->extension) ? strtolower($rp->extension) : null;
                $isSvg = $ext === 'svg';
              @endphp

              <article class="provider-card bg-white flex flex-col">
                <div class="provider-image-wrapper">
                  <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100">
                    <img loading="lazy"
              src="{{ $src ?: $fallback }}"
              alt="{{ $provider->first_name }}"
              class="provider-image absolute inset-0 w-full h-full {{ $isSvg ? 'object-contain bg-white p-6' : 'object-cover' }}"
              onerror="this.onerror=null;this.src='{{ $fallback }}';"
                    />
                    <div class="provider-image-overlay"></div>

                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                      @if(isset($specialStatus['featured']) && $specialStatus['featured'])
                        <span class="featured-badge">
                          <span class="text-xs">⭐ Featured Helper</span>
                        </span>
                      @endif
                      <span class="provider-rating">
                        <span class="mr-1">★</span> {{ number_format($provider->average_rating ?? 4.8, 1) }}
                      </span>
                    </div>

                    @if(isset($specialStatus['quick_reply']) && $specialStatus['quick_reply'])
                      <div class="absolute bottom-3 left-3 status-badge status-pulse">
                        <span class="status-dot"></span>
                        <span>Replies fast</span>
                      </div>
                    @endif
                  </div>
                </div>

                <div class="p-4 flex-1 flex flex-col">
                  <div class="flex items-start justify-between gap-3 mb-2">
                    <div>
                      <div class="flex items-center gap-2 mb-1">
                        <h3 class="text-base font-black text-slate-900">
                          {{ $provider->first_name }} {{ $provider->last_name }}
                        </h3>
                        @if(isset($specialStatus['verified']) && $specialStatus['verified'])
                          <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 text-[10px] font-bold" title="Verified identity">
                            ✓
                          </span>
                        @endif
                      </div>
                      <p class="text-xs font-medium text-blue-700">
                        {{ $provider->title ?? 'Local expat helper' }}
                      </p>
                    </div>
                  </div>

                  <div class="flex flex-wrap gap-2 mb-3">
                    @if(!empty($provider->operational_countries))
                      @php
                        $operationalCountries = is_array($provider->operational_countries)
                          ? $provider->operational_countries
                          : json_decode($provider->operational_countries, true) ?? [];
                      @endphp
                      @foreach($operationalCountries as $countryCode)
                        <span class="tag-chip">
                          🌍 {{ $countryCode }}
                        </span>
                      @endforeach
                    @endif

                    @if(!empty($provider->speaks))
                      @php
                        $languagesSpoken = is_array($provider->speaks)
                          ? $provider->speaks
                          : json_decode($provider->speaks, true) ?? [];
                      @endphp
                      @foreach($languagesSpoken as $lang)
                        <span class="tag-chip secondary">
                          🗣️ {{ $lang }}
                        </span>
                      @endforeach
                    @endif
                  </div>

                  <p class="text-xs text-slate-600 mb-4 line-clamp-3">
                    {{ Str::limit($provider->bio ?? 'No description yet, but available to help with your situation.', 160) }}
                  </p>

                  <div class="mt-auto flex items-center justify-between gap-2 pt-2 border-t border-slate-100">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-slate-50 border border-slate-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 status-pulse"></span>
                        <span>Usually replies in &lt; 24h</span>
                      </span>
                    </div>
                    <a 
                      href="{{ route('providers.show', $provider->id) }}"
                      class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition"
                    >
                      View profile
                    </a>
                  </div>
                </div>
              </article>
            @empty
              <div class="col-span-2 text-center py-10">
                <p class="text-sm text-slate-600 mb-2">
                  No helpers match your filters yet.
                </p>
                <p class="text-xs text-slate-500">
                  Try with fewer filters or choose “Any situation” and “Any country”.
                </p>
              </div>
            @endforelse
          </div>
        </div>

        <!-- MAP & STATS -->
        <aside class="space-y-5">
          <!-- Map -->
          <div class="bg-slate-900 rounded-3xl p-4 text-white h-full flex flex-col">
            <div class="flex items-center justify-between mb-3">
              <div>
                <h3 class="text-sm font-semibold">Helpers worldwide</h3>
                <p class="text-xs text-slate-300">
                  Where other expats like you are getting help.
                </p>
              </div>
              <div class="inline-flex flex-col items-end text-xs">
                <span class="text-slate-200 font-semibold">Live</span>
                <span class="inline-flex items-center gap-1 text-emerald-400">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 status-pulse"></span>
                  Now
                </span>
              </div>
            </div>
            <div id="map" class="flex-1 min-h-[260px] rounded-2xl overflow-hidden"></div>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-2 gap-3">
            <div class="stat-card bg-white rounded-2xl p-4 border border-slate-100 relative">
              <p class="text-[11px] text-slate-500 mb-1">Expats already helped</p>
              <p class="stat-number text-xl font-black text-slate-900">1,250+</p>
              <p class="text-[11px] text-emerald-600 mt-1">Growing daily</p>
            </div>
            <div class="stat-card bg-white rounded-2xl p-4 border border-slate-100 relative">
              <p class="text-[11px] text-slate-500 mb-1">Average satisfaction</p>
              <p class="stat-number text-xl font-black text-slate-900">4.9/5</p>
              <p class="text-[11px] text-yellow-500 mt-1">Based on reviews</p>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="py-12 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-2">
            Stories from expats who got help
          </h2>
          <p class="text-sm text-slate-600 max-w-xl">
            Every story below started with one simple form and a human on the other side of the screen.
          </p>
        </div>
        <div class="inline-flex items-center gap-2 text-xs text-slate-500">
          <span class="text-green-500">✔</span>
          <span>Verified by our team</span>
        </div>
      </div>

      <div class="overflow-hidden">
        <div class="testimonial-track">
          <div class="testimonial-row">
            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="50" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/women/32.jpg" alt="Maria, moved from Brazil to Portugal" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Maria</h3>
                    <span class="text-xs text-slate-500">Brazil → Portugal</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                My residence card was delayed and I had no clue what to do. My helper explained the local rules in Portuguese & English, and even came with me to the office.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: paperwork & registration</p>
            </article>

            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="80" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/men/44.jpg" alt="Maxime, moved from France to Canada" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Maxime</h3>
                    <span class="text-xs text-slate-500">France → Canada</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                I landed in Montréal with no flat. One helper visited places for me, sent videos and negotiated with the landlord. I signed a lease without being scammed.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: housing & local calls</p>
            </article>

            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="110" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lina, moved from Germany to Spain" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Lina</h3>
                    <span class="text-xs text-slate-500">Germany → Spain</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                I needed medical help but my Spanish was terrible. My helper booked appointments, translated on phone and came with me to the clinic.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: health & translation</p>
            </article>

            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="140" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/men/22.jpg" alt="Tom, moved from UK to Thailand" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Tom</h3>
                    <span class="text-xs text-slate-500">UK → Thailand</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                I had a work contract issue and got answers in English from someone who knew both local law and expat reality.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: work & legal doubts</p>
            </article>

            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="170" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sara, moved from Italy to UAE" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Sara</h3>
                    <span class="text-xs text-slate-500">Italy → UAE</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                I didn’t want to ask my company for every little question. Having someone “neutral” to ask about local life & rules was priceless.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: daily life & culture</p>
            </article>

            <article class="testimonial-card w-80 md:w-auto flex-shrink-0" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/men/67.jpg" alt="Carlos, moved from Mexico to USA" class="w-14 h-14 rounded-full mr-4 border-2 border-blue-200">
                <div>
                  <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h3 class="font-semibold text-slate-900 text-sm">Carlos</h3>
                    <span class="text-xs text-slate-500">Mexico → USA</span>
                  </div>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                My helper guided me through banking, phone plans and local bureaucracy in Spanish. I saved days of stress.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: setup & paperwork</p>
            </article>
          </div>

          <!-- Duplicate row for continuous scroll -->
          <div class="testimonial-row">
            <article class="testimonial-card w-80 md:w-auto flex-shrink-0">
              <div class="flex items-center mb-4">
                <img loading="lazy" src="https://randomuser.me/api/portraits/women/29.jpg" alt="Anna, moved from Poland to Netherlands" class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                <div class="ml-4">
                  <h3 class="font-semibold text-slate-900 text-sm mb-1">Anna</h3>
                  <p class="text-xs text-slate-500 mb-1">Poland → Netherlands</p>
                  <p class="text-xs text-yellow-500">★ ★ ★ ★ ★</p>
                </div>
              </div>
              <p class="text-sm text-slate-700 mb-3">
                I used the platform twice: first for finding a room, then months later for a tricky immigration question. Both times I felt listened to, not rushed.
              </p>
              <p class="text-[11px] text-slate-500">Helped with: housing & immigration</p>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="py-12 px-4 bg-slate-50">
    <div class="max-w-6xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-2">
            How it works (for expats & travellers)
          </h2>
          <p class="text-sm text-slate-600 max-w-xl">
            We designed the process to be as simple as sending a message to a friend who “knows someone on the ground”.
          </p>
        </div>
        <div class="inline-flex items-center gap-2 text-xs text-slate-500">
          <span class="w-2 h-2 rounded-full bg-emerald-400 status-pulse"></span>
          <span>No subscription. You pay helpers only if you choose to work with them.</span>
        </div>
      </div>

      <div class="relative bg-white rounded-3xl border border-slate-100 shadow-lg p-6 sm:p-8">
        <div class="steps-connector hidden sm:block"></div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 relative z-10">
          <!-- Step 1 -->
          <div class="faq-item p-5 sm:p-6">
            <div class="flex items-center gap-3 mb-4">
              <div class="number-badge">1</div>
              <div>
                <h3 class="font-semibold text-slate-900 text-sm mb-1">Tell us where you are & what you need</h3>
                <p class="text-xs text-slate-500">Country, language, situation. Takes 1–2 minutes.</p>
              </div>
            </div>
            <p class="text-xs text-slate-600 mb-3">
              Use the form above or pick “Any situation” if you’re not sure. You can stay vague at first and add details later.
            </p>
            <ul class="text-xs text-slate-500 space-y-1">
              <li>• No need to know the right legal words or forms.</li>
              <li>• You can mention if it’s urgent or sensitive.</li>
            </ul>
          </div>

          <!-- Step 2 -->
          <div class="faq-item p-5 sm:p-6">
            <div class="flex items-center gap-3 mb-4">
              <div class="number-badge">2</div>
              <div>
                <h3 class="font-semibold text-slate-900 text-sm mb-1">We match you with 1–3 helpers</h3>
                <p class="text-xs text-slate-500">Local expats, helpers, or pros familiar with your case.</p>
              </div>
            </div>
            <p class="text-xs text-slate-600 mb-3">
              You’ll see profiles that match your filters: languages, country, type of need. You can read reviews, prices and availability.
            </p>
            <ul class="text-xs text-slate-500 space-y-1">
              <li>• Some helpers reply in under 1 hour.</li>
              <li>• You can ask questions before booking anything.</li>
            </ul>
          </div>

          <!-- Step 3 -->
          <div class="faq-item p-5 sm:p-6">
            <div class="flex items-center gap-3 mb-4">
              <div class="number-badge">3</div>
              <div>
                <h3 class="font-semibold text-slate-900 text-sm mb-1">If you like someone, you book safely</h3>
                <p class="text-xs text-slate-500">Payment is held in escrow until the help is delivered.</p>
              </div>
            </div>
            <p class="text-xs text-slate-600 mb-3">
              You choose how you want to be helped: messaging, one-off call, long-term follow-up. We release the payment only once it’s done.
            </p>
            <ul class="text-xs text-slate-500 space-y-1">
              <li>• If something goes wrong, we’re here to mediate.</li>
              <li>• You can leave a review to help the next expat.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BECOME HELPER -->
  <section id="become-helper" class="py-12 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div data-aos="fade-right">
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-3">
            Lived abroad? You can turn your experience into meaningful help.
          </h2>
          <p class="text-sm text-slate-600 mb-4">
            If you’re an expat, local, or professional who knows how to navigate your country, you can help others avoid the same mistakes.
          </p>
          <ul class="space-y-2 text-sm text-slate-600 mb-5">
            <li>• Answer questions from people preparing to come.</li>
            <li>• Help with housing searches, visits, and contracts.</li>
            <li>• Offer “buddy” support for the first weeks or months.</li>
            <li>• If you’re a pro (lawyer, relocation agent, etc.), receive high-intent requests.</li>
          </ul>
          <a href="{{ route('providers.register') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition shadow-md">
            Become a helper
          </a>
        </div>

        <div class="hero-floating-card p-5 sm:p-6 lg:p-7 text-white" data-aos="fade-left">
          <div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
            <div>
              <h3 class="text-lg font-semibold mb-1">Helpers & pros benefit too</h3>
              <p class="text-xs text-slate-300 max-w-xs">
                We bring you motivated expats who actually need help, not random followers.
              </p>
            </div>
            <div class="inline-flex flex-col items-end text-xs text-slate-300">
              <span>From side-income to full-time activity</span>
              <span class="text-sm text-emerald-400 font-semibold">Up to 80% of fee kept by you</span>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
            <div class="bg-slate-900/50 rounded-2xl p-3">
              <p class="text-xs text-slate-300 mb-1">For expats & locals</p>
              <p class="text-sm font-semibold">Share your knowledge, on your schedule.</p>
            </div>
            <div class="bg-slate-900/50 rounded-2xl p-3">
              <p class="text-xs text-slate-300 mb-1">For lawyers & pros</p>
              <p class="text-sm font-semibold">Receive pre-qualified, detailed requests.</p>
            </div>
          </div>

          <div class="bg-slate-900/80 rounded-2xl p-3 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
              <div class="relative">
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-400 rounded-full status-pulse border border-slate-900"></span>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-800 text-lg">
                  💬
                </span>
              </div>
              <div>
                <p class="text-xs text-slate-300">We support you with pricing & structure.</p>
                <p class="text-[11px] text-slate-400">You’re not alone. We want helpers to succeed.</p>
              </div>
            </div>
            <div class="text-right text-xs text-slate-300">
              <p>Start for free</p>
              <p>No obligation, you keep control.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="py-12 px-4 bg-slate-50">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-8">
        <h2 class="text-xl sm:text-2xl font-black text-slate-900 mb-2">
          Questions you might have right now
        </h2>
        <p class="text-sm text-slate-600 max-w-2xl mx-auto">
          If you’re still reading, it probably means you’re serious about getting help or helping others. Let’s clear the last doubts.
        </p>
      </div>

      <div class="space-y-3">
        <!-- FAQ item -->
        <div class="faq-item p-4 sm:p-5" data-faq>
          <button type="button" class="faq-toggle w-full flex items-center justify-between text-left">
            <div class="flex-1">
              <p class="text-sm font-semibold text-slate-900">
                Is this a visa or legal service?
              </p>
            </div>
            <div class="faq-icon ml-3 flex-shrink-0">
              <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </button>
          <div class="faq-content mt-3">
            <p class="text-xs text-slate-600">
              Not directly. We are a platform that connects you with people who know the local rules: expats, helpers, and professionals.
              Some are lawyers or certified experts, others are experienced expats or locals. You always see who you are talking to before accepting anything.
            </p>
          </div>
        </div>

        <div class="faq-item p-4 sm:p-5" data-faq>
          <button type="button" class="faq-toggle w-full flex items-center justify-between text-left">
            <div class="flex-1">
              <p class="text-sm font-semibold text-slate-900">
                How much does it cost?
              </p>
            </div>
            <div class="faq-icon ml-3 flex-shrink-0">
              <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </button>
          <div class="faq-content mt-3">
            <p class="text-xs text-slate-600 mb-2">
              Browsing helpers and sending your situation is free. Helpers can answer some questions for free or propose a paid plan.
            </p>
            <p class="text-xs text-slate-600">
              You always see the price and format (call, follow-up, document review…) before paying. Payments are secured and held in escrow until the help is delivered.
            </p>
          </div>
        </div>

        <div class="faq-item p-4 sm:p-5" data-faq>
          <button type="button" class="faq-toggle w-full flex items-center justify-between text-left">
            <div class="flex-1">
              <p class="text-sm font-semibold text-slate-900">
                What if I’m not satisfied?
              </p>
            </div>
            <div class="faq-icon ml-3 flex-shrink-0">
              <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </button>
          <div class="faq-content mt-3">
            <p class="text-xs text-slate-600">
              We encourage you to talk with the helper before booking to be sure they understand your case.
              If something goes wrong, you can contact us: we’ll look at the situation, and if the service was clearly not delivered, we can decide a refund.
            </p>
          </div>
        </div>

        <div class="faq-item p-4 sm:p-5" data-faq>
          <button type="button" class="faq-toggle w-full flex items-center justify-between text-left">
            <div class="flex-1">
              <p class="text-sm font-semibold text-slate-900">
                I’m shy / my situation is complex. Is this for me?
              </p>
            </div>
            <div class="faq-icon ml-3 flex-shrink-0">
              <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </button>
          <div class="faq-content mt-3">
            <p class="text-xs text-slate-600">
              Absolutely. Many helpers are expats themselves who went through rough patches.
              You can say “I’m not ready to share everything yet” and start slowly. You decide what you share and when.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section class="py-12 px-4 bg-gradient-to-b from-blue-900 to-slate-900 text-white">
    <div class="max-w-4xl mx-auto text-center">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 mb-4">
        <span class="w-2 h-2 rounded-full bg-emerald-400 status-pulse"></span>
        <span class="text-xs text-slate-100">Still reading? That might mean you’re ready to move forward.</span>
      </div>
      <h2 class="text-2xl sm:text-3xl font-black mb-3">
        Share your situation. Let humans who’ve been there help you.
      </h2>
      <p class="text-sm text-slate-100 mb-6 max-w-2xl mx-auto">
        Whatever your stage—just landed, long-term, or “thinking about it”—you don’t have to figure it out alone.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="#search" class="btn-shine inline-flex items-center justify-center px-6 sm:px-8 py-3 rounded-full bg-white text-blue-700 text-sm font-semibold shadow-lg hover:shadow-xl transition">
          <span>Describe my situation</span>
          <span class="ml-2 text-lg">✍️</span>
        </a>
        <button
          type="button"
          onclick="openAIPopup()"
          class="inline-flex items-center justify-center px-6 sm:px-8 py-3 rounded-full bg-blue-700/60 text-white text-sm font-semibold border border-blue-300/40 hover:bg-blue-700 transition"
        >
          <span>Get a sneak peek of our AI helper</span>
          <span class="ml-2 text-lg">🤖</span>
        </button>
      </div>
      <p class="mt-4 text-[11px] text-slate-300">
        No newsletter forced, no hidden terms. Just a safer, clearer path to your next step abroad.
      </p>
    </div>
  </section>



@include('includes.footer')

<!-- AI POPUP -->
<div class="ai-popup-overlay" id="aiPopupOverlay" onclick="closeAIPopup()"></div>
<div class="ai-popup" id="aiPopup" role="dialog" aria-modal="true" aria-labelledby="aiPopupTitle">
  <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-6 relative">
      <button onclick="closeAIPopup()" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      <div class="text-center">
        <div class="text-6xl mb-3 ai-robot">🤖</div>
        <h3 id="aiPopupTitle" class="text-2xl font-black text-white">Ulysses coming soon!</h3>
      </div>
    </div>
    
    <div class="p-8 text-center">
      <div class="mb-6">
        <div class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-xs font-semibold">
          Coming next: AI + humans, not AI instead of humans.
        </div>
      </div>
      <p class="text-sm text-slate-700 mb-4">
        Soon, you’ll be able to describe your situation in natural language and let Ulysses summarize it for you, suggest options,
        and connect you faster to the right helpers.
      </p>
      <p class="text-xs text-slate-500 mb-6 max-w-md mx-auto">
        Our promise: AI will never decide alone on your future. It will simply make the path clearer and smoother.
      </p>
      <div class="flex justify-center">
        <button
          type="button"
          onclick="closeAIPopup()"
          class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</div>

</main>

<!-- BACK TO TOP -->
<button id="backToTop" type="button" aria-label="Back to top">
  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
  </svg>
</button>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ mix('js/app.js') }}" defer></script>

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
    
    if (aiPopupTimer) {
      clearTimeout(aiPopupTimer);
    }
    
    // Auto-close after 30s for UX
    aiPopupTimer = setTimeout(() => {
      closeAIPopup();
    }, 30000);
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

  // FAQ Accordion
  const faqItems = document.querySelectorAll('[data-faq]');
  
  faqItems.forEach(item => {
    const toggle = item.querySelector('.faq-toggle');
    const content = item.querySelector('.faq-content');
    
    toggle.addEventListener('click', () => {
      const isActive = toggle.classList.contains('active');
      
      faqItems.forEach(otherItem => {
        if (otherItem !== item) {
          otherItem.querySelector('.faq-toggle').classList.remove('active');
          otherItem.querySelector('.faq-content').classList.remove('active');
          otherItem.classList.remove('active');
        }
      });
      
      if (!isActive) {
        toggle.classList.add('active');
        content.classList.add('active');
        item.classList.add('active');
      } else {
        toggle.classList.remove('active');
        content.classList.remove('active');
        item.classList.remove('active');
      }
    });
  });

  // Category bubble filters (front only UI)
  const categoryBubbles = document.querySelectorAll('.category-bubble');

  categoryBubbles.forEach(bubble => {
    bubble.addEventListener('click', () => {
      const cat = bubble.getAttribute('data-category');

      // Active state
      categoryBubbles.forEach(b => b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50'));
      bubble.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');

      // Simple mapping to select fields if needed (optional)
      const categorySelect = document.getElementById('categorySelect');
      if (!categorySelect) return;

      if (cat === 'all') {
        categorySelect.value = '';
      } else {
        // Mapping à faire côté back si besoin
      }
    });
  });

  // FAQ simplified open/close function for manual controls
  function toggleFAQ(index) {
    const all = document.querySelectorAll('[data-faq]');
    if (index < 0 || index >= all.length) return;

    const item = all[index];
    const content = item.querySelector('.faq-content');
    const toggle = item.querySelector('.faq-toggle');
    const isActive = content.classList.contains('active');

    all.forEach(faq => {
      faq.classList.remove('active');
      faq.querySelector('.faq-content').classList.remove('active');
      faq.querySelector('.faq-toggle').classList.remove('active');
    });

    if (!isActive) {
      content.classList.add('active');
      toggle.classList.add('active');
      item.classList.add('active');
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
          if (subcategoryWrapper) subcategoryWrapper.classList.remove('hidden');
          if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
        })
        .catch(error => {
          console.error('Error:', error);
          if (subcategoryWrapper) subcategoryWrapper.classList.add('hidden');
          if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
        });
    } else {
      if (subcategoryWrapper) subcategoryWrapper.classList.add('hidden');
      if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
    }
  });

  // Subcategory change handler
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
            if (subsubcategoryWrapper) subsubcategoryWrapper.classList.remove('hidden');
          } else {
            if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
        });
    } else {
      if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');
    }
  });

  // Reset Filters Button
  document.getElementById('resetFiltersButton').addEventListener('click', function() {
    document.getElementById('languageSelect').value = '';
    document.getElementById('countrySelect').value = '';
    document.getElementById('categorySelect').value = '';
    document.getElementById('subcategorySelect').value = '';
    document.getElementById('subsubcategorySelect').value = '';

    const subcategoryWrapper = document.getElementById('subcategoryWrapper');
    const subsubcategoryWrapper = document.getElementById('subsubcategoryWrapper');
    if (subcategoryWrapper) subcategoryWrapper.classList.add('hidden');
    if (subsubcategoryWrapper) subsubcategoryWrapper.classList.add('hidden');

    // Reset providers HTML if needed
    if (originalProvidersHTML) {
      document.getElementById('serviceGrid').innerHTML = originalProvidersHTML;
    }
  });

  // Filter providers with fetch
  const filterForm = document.getElementById('filterProvidersForm');
  if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const language = document.getElementById('languageSelect').value;
      const country = document.getElementById('countrySelect').value;
      const categoryId = document.getElementById('categorySelect').value;
      const subcategoryId = document.getElementById('subcategorySelect').value;
      const subsubcategoryId = document.getElementById('subsubcategorySelect').value;
      const description = document.getElementById('description').value;

      const serviceGrid = document.getElementById('serviceGrid');
      serviceGrid.innerHTML = `
        <div class="col-span-2 text-center py-10">
          <p class="text-sm text-slate-600 mb-2">Looking for helpers matching your situation...</p>
          <p class="text-xs text-slate-500">Please wait a few seconds.</p>
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
              
              const speaks = Array.isArray(provider.speaks) 
                ? provider.speaks 
                : (provider.speaks ? JSON.parse(provider.speaks) : []);

              const fallbackImage = 'images/attachment.png';
              const srcImage = provider.profile_photo || fallbackImage;

              const cardHtml = `
                <article class="provider-card bg-white flex flex-col" data-aos="fade-up" data-aos-delay="${index * 50}">
                  <div class="provider-image-wrapper">
                    <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100">
                      <img
                        loading="lazy"
                        src="${srcImage}"
                        alt="${provider.first_name}"
                        class="provider-image absolute inset-0 w-full h-full object-cover"
                        onerror="this.src='${fallbackImage}';"
                      />
                      <div class="provider-image-overlay"></div>
                      <div class="absolute top-3 left-3 flex flex-col gap-2">
                        ${specialStatus.featured ? `
                          <span class="featured-badge">
                            <span class="text-xs">⭐ Featured Helper</span>
                          </span>
                        ` : ''}
                        <span class="provider-rating">
                          <span class="mr-1">★</span> ${Number(provider.average_rating || 4.8).toFixed(1)}
                        </span>
                      </div>
                      ${specialStatus.quick_reply ? `
                        <div class="absolute bottom-3 left-3 status-badge status-pulse">
                          <span class="status-dot"></span>
                          <span>Replies fast</span>
                        </div>
                      ` : ''}
                    </div>
                  </div>
                  <div class="p-4 flex-1 flex flex-col">
                    <div class="flex items-start justify-between gap-3 mb-2">
                      <div>
                        <div class="flex items-center gap-2 mb-1">
                          <h3 class="text-base font-black text-slate-900">
                            ${provider.first_name} ${provider.last_name || ''}
                          </h3>
                          ${specialStatus.verified ? `
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-600 text-[10px] font-bold" title="Verified identity">
                              ✓
                            </span>
                          ` : ''}
                        </div>
                        <p class="text-xs font-medium text-blue-700">
                          ${provider.title || 'Local expat helper'}
                        </p>
                      </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-3">
                      ${operationalCountries.map(country => `
                        <span class="tag-chip">
                          🌍 ${country}
                        </span>
                      `).join('')}
                      ${speaks.map(lang => `
                        <span class="tag-chip secondary">
                          🗣️ ${lang}
                        </span>
                      `).join('')}
                    </div>
                    <p class="text-xs text-slate-600 mb-4">
                      ${provider.bio ? provider.bio.substring(0, 160) + (provider.bio.length > 160 ? '…' : '') : 'No description yet, but available to help with your situation.'}
                    </p>
                    <div class="mt-auto flex items-center justify-between gap-2 pt-2 border-t border-slate-100">
                      <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-slate-50 border border-slate-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 status-pulse"></span>
                          <span>Usually replies in &lt; 24h</span>
                        </span>
                      </div>
                      <a 
                        href="/providers/${provider.id}"
                        class="inline-flex items-center justify-center px-4 py-1.5 rounded-full bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition"
                      >
                        View profile
                      </a>
                    </div>
                  </div>
                </article>
              `;
              serviceGrid.insertAdjacentHTML('beforeend', cardHtml);
            });

            // Refresh AOS for new elements
            AOS.refresh();
          } else {
            serviceGrid.innerHTML = `
              <div class="col-span-2 text-center py-10">
                <p class="text-sm text-slate-600 mb-2">
                  No helpers match your filters yet.
                </p>
                <p class="text-xs text-slate-500">
                  Try with fewer filters or choose “Any situation” and “Any country”.
                </p>
              </div>
            `;
          }
        })
        .catch(error => {
          console.error('Error:', error);
          serviceGrid.innerHTML = `
            <div class="col-span-2 text-center py-10">
              <p class="text-sm text-red-600 mb-2">
                Something went wrong while searching.
              </p>
              <p class="text-xs text-slate-500">
                Please try again in a moment or refresh the page.
              </p>
            </div>
          `;
        });
    });
  }

  // Horizontal scroll support for categories on mobile (swipe)
  const scrollContainer = document.querySelector('.scroll-container');
  if (scrollContainer) {
    let isDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
      isDown = true;
      scrollContainer.classList.add('cursor-grabbing');
      startX = e.pageX - scrollContainer.offsetLeft;
      scrollLeft = scrollContainer.scrollLeft;
    });
    scrollContainer.addEventListener('mouseleave', () => {
      isDown = false;
      scrollContainer.classList.remove('cursor-grabbing');
    });
    scrollContainer.addEventListener('mouseup', () => {
      isDown = false;
      scrollContainer.classList.remove('cursor-grabbing');
    });
    scrollContainer.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - scrollContainer.offsetLeft;
      const walk = (x - startX) * 1.5;
      scrollContainer.scrollLeft = scrollLeft - walk;
    });

    // Touch support
    let touchStartX;
    scrollContainer.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].pageX;
    });
    scrollContainer.addEventListener('touchmove', (e) => {
      const touch = e.touches[0];
      const moveX = touch.pageX - touchStartX;
      scrollContainer.scrollLeft -= moveX * 0.6;
      touchStartX = touch.pageX;
    });
  }
</script>

</body>
</html>
