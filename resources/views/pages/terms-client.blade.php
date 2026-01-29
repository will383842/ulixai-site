<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $title }} - Ulixai | Client Terms of Service</title>
  <meta name="description" content="Read Ulixai's Client Terms & Conditions. Understand your rights, responsibilities, and our policies when using our platform as a client.">
  <meta name="keywords" content="client terms, terms of service, client agreement, user rights, Ulixai terms">
  <meta name="author" content="Ulixai">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ route('terms.client') }}" />
  <meta name="theme-color" content="#2563EB">

  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ route('terms.client') }}">
  <meta property="og:title" content="{{ $title }} - Ulixai">
  <meta property="og:description" content="Read our Client Terms & Conditions to understand your rights and responsibilities.">
  <meta property="og:locale" content="en_US">
  <meta property="og:site_name" content="Ulixai">

  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="{{ $title }} - Ulixai">
  <meta name="twitter:description" content="Client Terms & Conditions for Ulixai platform.">

  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

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
    }

    .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
    @media (min-width: 640px) { .container { padding: 0 24px; } }

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
      font-size: clamp(32px, 8vw, 56px);
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

    .content-section { padding: 60px 0; background: white; }
    @media (min-width: 768px) { .content-section { padding: 80px 0; } }
    @media (min-width: 1024px) { .content-section { padding: 100px 0; } }

    .content-card {
      background: white;
      border-radius: 20px;
      border: 2px solid var(--border);
      padding: 32px 24px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }
    @media (min-width: 640px) { .content-card { padding: 40px 32px; border-radius: 24px; } }
    @media (min-width: 1024px) { .content-card { padding: 48px 40px; border-radius: 28px; } }

    .content-card:hover {
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.08);
      transform: translateY(-2px);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .prose { color: var(--text-light); line-height: 1.8; }
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
      color: var(--text);
      font-weight: 800;
      margin-top: 24px;
      margin-bottom: 12px;
      letter-spacing: -0.01em;
    }
    .prose h1 { font-size: 28px; }
    .prose h2 { font-size: 24px; }
    .prose h3 { font-size: 20px; }
    .prose h4 { font-size: 18px; }
    @media (min-width: 768px) {
      .prose h1 { font-size: 32px; }
      .prose h2 { font-size: 28px; }
      .prose h3 { font-size: 24px; }
      .prose h4 { font-size: 20px; }
    }
    .prose p { margin-bottom: 16px; font-size: 15px; }
    @media (min-width: 768px) { .prose p { margin-bottom: 20px; font-size: 16px; } }
    .prose p:last-child { margin-bottom: 0; }
    .prose strong { color: var(--text); font-weight: 700; }
    .prose em { font-style: italic; color: var(--primary); }
    .prose ul, .prose ol { padding-left: 28px; margin-bottom: 16px; }
    .prose li { margin-bottom: 10px; line-height: 1.8; }
    .prose blockquote {
      border-left: 4px solid var(--primary);
      padding: 16px 20px;
      margin-left: 0;
      margin-bottom: 16px;
      color: var(--text-light);
      font-style: italic;
      background: var(--bg-light);
      border-radius: 8px;
    }
    .prose a {
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }
    .prose a:hover { color: var(--primary-light); text-decoration: underline; }
    .prose hr { border: none; border-top: 2px solid var(--border); margin: 24px 0; }

    .terms-nav {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      margin-bottom: 40px;
    }
    .terms-nav a {
      padding: 10px 20px;
      border-radius: 100px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
      border: 2px solid var(--border);
      color: var(--text-light);
      background: white;
    }
    .terms-nav a:hover { border-color: var(--primary); color: var(--primary); }
    .terms-nav a.active {
      background: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--text-muted);
    }
    .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; }

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
      * { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
    }
  </style>
</head>
<body>

  <div class="progress-bar-top" id="progressBar"></div>

  @include('includes.header')

  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-badge" role="status">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span>Client Terms</span>
        </div>

        <h1>{{ $title }}</h1>

        <p class="hero-subtitle">
          Conditions applicables aux clients utilisant les services de la plateforme Ulixai.
        </p>

        <div class="last-updated">
          <div class="pulse-dot"></div>
          <span>Last Updated: {{ $lastUpdated }}</span>
        </div>
      </div>
    </div>
  </section>

  <section class="content-section">
    <div class="container">

      <nav class="terms-nav">
        <a href="{{ route('terms.show') }}">CGU</a>
        <a href="{{ route('terms.client') }}" class="active">Clients</a>
        <a href="{{ route('terms.provider') }}">Prestataires</a>
        <a href="{{ route('terms.affiliate') }}">Affiliation</a>
      </nav>

      <div class="content-card">
        <div class="prose">
          @if(!empty($content))
            @php
              $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><blockquote><hr><span><div><table><thead><tbody><tr><th><td>';
              $safeContent = strip_tags($content, $allowedTags);
              $safeContent = preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $safeContent);
              $safeContent = preg_replace('/\s*on\w+\s*=\s*[^\s>]*/i', '', $safeContent);
              $safeContent = preg_replace('/javascript\s*:/i', '', $safeContent);
              $safeContent = preg_replace('/data\s*:/i', '', $safeContent);
            @endphp
            {!! $safeContent !!}
          @else
            <div class="empty-state">
              <i class="fas fa-file-alt"></i>
              <p>Les conditions clients seront bientot disponibles.</p>
            </div>
          @endif
        </div>
      </div>

    </div>
  </section>

  @include('includes.footer')

  <script>
    (function() {
      'use strict';
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
