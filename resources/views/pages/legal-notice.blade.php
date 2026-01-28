<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Legal Notice - {{ $settings->site_name ?? 'ULIX AI' }} | Official Legal Information 2025</title>
  <meta name="description" content="Read {{ $settings->site_name ?? 'ULIX AI' }}'s Legal Notice. Understand publisher information, intellectual property, liability disclaimers, privacy, and governing law. Updated 2025.">
  <meta name="keywords" content="legal notice, publisher information, intellectual property, liability disclaimer, privacy policy, governing law, legal information">
  <meta name="author" content="{{ $settings->site_name ?? 'ULIX AI' }}">
  <meta name="robots" content="noindex, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="{{ url('/legal-notice') }}" />
  <meta name="theme-color" content="#2563EB">
  
  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/legal-notice') }}">
  <meta property="og:title" content="Legal Notice - {{ $settings->site_name ?? 'ULIX AI' }}">
  <meta property="og:description" content="Read our Legal Notice to understand publisher information, intellectual property, and legal policies.">
  <meta property="og:locale" content="en_US">
  <meta property="og:site_name" content="{{ $settings->site_name ?? 'ULIX AI' }}">
  
  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ url('/legal-notice') }}">
  <meta name="twitter:title" content="Legal Notice - {{ $settings->site_name ?? 'ULIX AI' }}">
  <meta name="twitter:description" content="Read our complete Legal Notice and understand your rights.">
  
  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    :root {
      --primary: #2563EB;
      --primary-light: #60A5FA;
      --accent: #A855F7;
      --success: #10B981;
      --text: #0F172A;
      --text-light: #64748B;
      --text-muted: #94A3B8;
      --bg: #FFFFFF;
      --bg-light: #F8FAFC;
      --border: #E2E8F0;
    }
    
    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: var(--text);
      background: var(--bg);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      overflow-x: hidden;
    }
    
    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 20px;
    }
    
    @media (min-width: 640px) {
      .container { padding: 0 24px; }
    }
    
    /* Hero Section */
    .hero {
      position: relative;
      min-height: 50vh;
      display: flex;
      align-items: center;
      padding: 120px 0 80px;
      background: 
        radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.08) 0%, transparent 50%),
        linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
      overflow: hidden;
    }
    
    @media (min-width: 768px) {
      .hero {
        min-height: 60vh;
      }
    }
    
    .hero::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
      border-radius: 50%;
      top: -200px;
      right: -100px;
      filter: blur(60px);
      animation: float 25s ease-in-out infinite;
      pointer-events: none;
    }
    
    @media (min-width: 768px) {
      .hero::before {
        width: 600px;
        height: 600px;
        top: -250px;
        right: -150px;
      }
    }
    
    .hero::after {
      content: '';
      position: absolute;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(168, 85, 247, 0.1) 0%, transparent 70%);
      border-radius: 50%;
      bottom: -80px;
      left: -80px;
      filter: blur(50px);
      animation: float 20s ease-in-out infinite reverse;
      pointer-events: none;
    }
    
    @media (min-width: 768px) {
      .hero::after {
        width: 400px;
        height: 400px;
        bottom: -100px;
        left: -100px;
      }
    }
    
    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(30px, -30px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    
    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
      max-width: 800px;
      margin: 0 auto;
    }
    
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(37, 99, 235, 0.1);
      border: 1.5px solid rgba(37, 99, 235, 0.3);
      padding: 10px 20px;
      border-radius: 100px;
      font-weight: 700;
      font-size: 13px;
      color: var(--primary);
      margin-bottom: 24px;
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1);
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.1);
    }
    
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .hero h1 {
      font-size: clamp(32px, 8vw, 64px);
      line-height: 1.1;
      font-weight: 900;
      letter-spacing: -0.03em;
      margin-bottom: 20px;
      color: var(--text);
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
    }
    
    .hero-subtitle {
      font-size: clamp(15px, 3vw, 20px);
      color: var(--text-light);
      margin-bottom: 32px;
      line-height: 1.6;
      font-weight: 500;
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
    }
    
    .last-updated {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(16, 185, 129, 0.1);
      border: 1.5px solid rgba(16, 185, 129, 0.3);
      padding: 8px 16px;
      border-radius: 100px;
      font-size: 13px;
      font-weight: 700;
      color: var(--success);
      margin-top: 20px;
    }
    
    .pulse-dot {
      width: 8px;
      height: 8px;
      background: var(--success);
      border-radius: 50%;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    
    /* Main Content */
    .content-section {
      padding: 60px 0;
      background: white;
    }
    
    @media (min-width: 768px) {
      .content-section {
        padding: 80px 0;
      }
    }
    
    @media (min-width: 1024px) {
      .content-section {
        padding: 100px 0;
      }
    }
    
    .content-card {
      background: white;
      border-radius: 20px;
      border: 2px solid var(--border);
      padding: 32px 24px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    
    @media (min-width: 640px) {
      .content-card {
        padding: 40px 32px;
        border-radius: 24px;
      }
    }
    
    @media (min-width: 1024px) {
      .content-card {
        padding: 48px 40px;
        border-radius: 28px;
      }
    }
    
    .content-card:hover {
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.08);
      transform: translateY(-2px);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    /* Typography for content */
    .prose {
      color: var(--text-light);
      line-height: 1.8;
    }
    
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
      color: var(--text);
      font-weight: 800;
      margin-top: 24px;
      margin-bottom: 12px;
      letter-spacing: -0.01em;
    }
    
    @media (min-width: 768px) {
      .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        margin-top: 28px;
        margin-bottom: 16px;
      }
    }
    
    .prose h1 { font-size: 28px; }
    .prose h2 { font-size: 24px; }
    .prose h3 { font-size: 20px; }
    .prose h4 { font-size: 18px; }
    .prose h5, .prose h6 { font-size: 16px; }
    
    @media (min-width: 768px) {
      .prose h1 { font-size: 32px; }
      .prose h2 { font-size: 28px; }
      .prose h3 { font-size: 24px; }
      .prose h4 { font-size: 20px; }
      .prose h5, .prose h6 { font-size: 18px; }
    }
    
    .prose p {
      margin-bottom: 16px;
      font-size: 15px;
    }
    
    @media (min-width: 768px) {
      .prose p {
        margin-bottom: 20px;
        font-size: 16px;
      }
    }
    
    .prose p:last-child {
      margin-bottom: 0;
    }
    
    .prose strong {
      color: var(--text);
      font-weight: 700;
    }
    
    .prose em {
      font-style: italic;
      color: var(--primary);
    }
    
    .prose ul, .prose ol {
      padding-left: 28px;
      margin-bottom: 16px;
    }
    
    @media (min-width: 768px) {
      .prose ul, .prose ol {
        padding-left: 32px;
        margin-bottom: 20px;
      }
    }
    
    .prose li {
      margin-bottom: 10px;
      line-height: 1.8;
    }
    
    @media (min-width: 768px) {
      .prose li {
        margin-bottom: 12px;
      }
    }
    
    .prose li p {
      margin-bottom: 8px;
    }
    
    .prose blockquote {
      border-left: 4px solid var(--primary);
      padding-left: 20px;
      margin-left: 0;
      margin-bottom: 16px;
      color: var(--text-light);
      font-style: italic;
      background: var(--bg-light);
      padding: 16px 20px;
      border-radius: 8px;
    }
    
    @media (min-width: 768px) {
      .prose blockquote {
        padding-left: 24px;
        margin-bottom: 20px;
        padding: 20px 24px;
      }
    }
    
    .prose code {
      background: var(--bg-light);
      color: var(--primary);
      padding: 2px 6px;
      border-radius: 4px;
      font-family: 'Courier New', monospace;
      font-size: 14px;
    }
    
    .prose pre {
      background: var(--text);
      color: #E2E8F0;
      padding: 20px;
      border-radius: 12px;
      overflow-x: auto;
      margin-bottom: 16px;
    }
    
    @media (min-width: 768px) {
      .prose pre {
        padding: 24px;
        margin-bottom: 20px;
      }
    }
    
    .prose pre code {
      background: none;
      color: inherit;
      padding: 0;
    }
    
    .prose hr {
      border: none;
      border-top: 2px solid var(--border);
      margin: 24px 0;
    }
    
    @media (min-width: 768px) {
      .prose hr {
        margin: 32px 0;
      }
    }
    
    .prose a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }
    
    .prose a:hover {
      color: var(--primary-light);
      text-decoration: underline;
    }
    
    .progress-bar-top {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
      width: 0;
      z-index: 100;
      transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    @media (prefers-reduced-motion: reduce) {
      * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>
</head>
<body>

  <div class="progress-bar-top" id="progressBar"></div>

  @include('includes.header')

  @php
    $settings = \App\Models\SiteSetting::first();
    $legalContent = $settings->legal_info ?? '';
    
    // Handle if legal_info is stored as array (JSON)
    if (is_array($legalContent)) {
      $legalContent = $legalContent['publisher'] ?? '';
    }
    
    $legalContent = (string)$legalContent;
  @endphp

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-badge" role="status">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span>Legal Document</span>
        </div>
        
        <h1>Legal Notice 📜</h1>
        
        <p class="hero-subtitle">
          Complete legal information including publisher details, intellectual property rights, liability disclaimers, and privacy policies.
        </p>
        
        <div class="last-updated">
          <div class="pulse-dot"></div>
          <span>Last Updated: 2025</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="content-section">
    <div class="container">
      
      <!-- Content Card -->
      <div class="content-card">
        <div class="prose">
          @if(!empty($legalContent))
            @php
              // ✅ SECURITY: Sanitize HTML to prevent XSS attacks
              $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><blockquote><hr><span><div>';
              $sanitizedContent = strip_tags($legalContent, $allowedTags);
              // Remove dangerous attributes
              $sanitizedContent = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $sanitizedContent);
              $sanitizedContent = preg_replace('/\s*on\w+\s*=\s*[^\s>]*/i', '', $sanitizedContent);
              $sanitizedContent = preg_replace('/javascript\s*:/i', '', $sanitizedContent);
              $sanitizedContent = preg_replace('/data\s*:/i', '', $sanitizedContent);
            @endphp
            @if($sanitizedContent != strip_tags($sanitizedContent))
              {{-- Contains safe HTML, render sanitized --}}
              {!! $sanitizedContent !!}
            @else
              {{-- Plain text, escaped and formatted with line breaks --}}
              <p>{!! nl2br(e($legalContent)) !!}</p>
            @endif
          @else
            <p style="text-align: center; color: var(--text-muted); padding: 40px 0;">
              <em>No legal notice content has been configured yet.</em>
            </p>
          @endif

          <hr>

          <!-- Data Protection Officer Section (GDPR Art. 37) -->
          <h2>Data Protection Officer (DPO)</h2>
          <p>
            In accordance with GDPR Article 37 and other international data protection regulations,
            we have appointed a Data Protection Officer to oversee our data protection strategy and compliance.
          </p>
          <p>
            <strong>Contact our DPO:</strong><br>
            Email: <a href="mailto:dpo@ulixai.com">dpo@ulixai.com</a><br>
            Response time: Within 30 days for all privacy-related requests.
          </p>
          <p>
            You may contact our DPO for:
          </p>
          <ul>
            <li>Questions about how we process your personal data</li>
            <li>Requests to access, correct, or delete your personal data</li>
            <li>Exercising your rights under GDPR, CCPA, LGPD, or other regulations</li>
            <li>Filing a complaint about our data processing practices</li>
            <li>Requesting a copy of your data (data portability)</li>
          </ul>
          <p>
            <strong>Your Privacy Rights:</strong>
            <a href="{{ route('privacy.do-not-sell') }}">Do Not Sell My Personal Information</a> |
            <a href="{{ route('cookies.show') }}">Cookie Settings</a>
            @auth
            | <a href="{{ route('account.export-data') }}">Export My Data</a>
            @endauth
          </p>
        </div>
      </div>

    </div>
  </section>

  @include('includes.footer')

  <script>
    (function() {
      'use strict';
      
      // Progress bar on scroll
      window.addEventListener('scroll', function() {
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / scrollHeight) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
      }, { passive: true });
      
    })();
  </script>

</body>
</html>