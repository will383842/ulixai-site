<!DOCTYPE html>
<html lang="{{ $locale ?? 'en' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF for AJAX -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Ulixai Press & Media Center | International Platform Serving 197 Countries 🌍</title>
  <meta name="description" content="Official Ulixai press resources for journalists worldwide. Download press kits, brand guidelines, HD photos in all major languages. The only international platform connecting 304M expats across 197 countries.">
  <meta name="keywords" content="ulixai press, media kit, press release, brand guidelines, expat platform, international startup, global marketplace, 197 countries, multilingual platform, press resources">
  <meta name="author" content="Ulixai - Press Relations Team">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  
  <link rel="canonical" href="https://ulixai.com/press/{{ $locale ?? 'en' }}" />
  <link rel="alternate" hreflang="en" href="https://ulixai.com/press/en" />
  <link rel="alternate" hreflang="fr" href="https://ulixai.com/press/fr" />
  <link rel="alternate" hreflang="de" href="https://ulixai.com/press/de" />
  <link rel="alternate" hreflang="x-default" href="https://ulixai.com/press/en" />
  
  <meta name="theme-color" content="#2563EB">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Ulixai Press Center - Global Expat Platform 🌍">
  <meta property="og:description" content="Access press materials for the only international platform serving expats in 197 countries. Available in all major languages.">
  <meta property="og:image" content="https://ulixai.com/images/press-og.jpg">
  <meta property="og:url" content="https://ulixai.com/press/{{ $locale ?? 'en' }}">
  
  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{
      --primary:#2563EB;--primary-light:#60A5FA;--primary-dark:#1E40AF;
      --accent:#A855F7;--success:#10B981;--warning:#F59E0B;
      --text:#0F172A;--text-light:#64748B;--text-muted:#94A3B8;
      --bg:#FFFFFF;--bg-light:#F8FAFC;--border:#E2E8F0
    }
    body{font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;color:var(--text);background:var(--bg);line-height:1.5;overflow-x:hidden;font-size:14px}
    .container{max-width:1280px;margin:0 auto;padding:0 20px}
    @media (min-width:640px){.container{padding:0 24px}}

    /* Hero */
    .hero{position:relative;min-height:90vh;display:flex;align-items:center;padding:140px 0 100px;background:
      radial-gradient(circle at 20% 30%, rgba(37,99,235,.12) 0%, transparent 50%),
      radial-gradient(circle at 80% 70%, rgba(168,85,247,.12) 0%, transparent 50%),
      linear-gradient(180deg,#FFFFFF 0%,#F8FAFC 100%);overflow:hidden}
    @media (min-width:640px){.hero{padding:160px 0 120px}}
    .hero::before{content:'';position:absolute;width:600px;height:600px;background:radial-gradient(circle, rgba(37,99,235,.2) 0%, transparent 70%);border-radius:50%;top:-250px;right:-150px;filter:blur(60px);animation:float 25s ease-in-out infinite;pointer-events:none}
    .hero::after{content:'';position:absolute;width:500px;height:500px;background:radial-gradient(circle, rgba(168,85,247,.15) 0%, transparent 70%);border-radius:50%;bottom:-100px;left:-100px;filter:blur(50px);animation:float 20s ease-in-out infinite reverse;pointer-events:none}
    @keyframes float{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(30px,-30px) scale(1.1)}66%{transform:translate(-20px,20px) scale(.9)}}
    @keyframes slideDown{from{opacity:0;transform:translateY(-30px)}to{opacity:1;transform:translateY(0)}}
    @keyframes pulse-glow{0%,100%{box-shadow:0 0 20px rgba(16,185,129,.3)}50%{box-shadow:0 0 40px rgba(16,185,129,.6)}}
    .hero-content{position:relative;z-index:1;text-align:center;max-width:1100px;margin:0 auto}
    .hero-badge{display:inline-flex;align-items:center;gap:12px;background:rgba(16,185,129,.15);backdrop-filter:blur(12px);border:2px solid rgba(16,185,129,.4);padding:12px 24px;border-radius:100px;font-weight:800;font-size:14px;color:var(--success);margin-bottom:32px;animation:slideDown .8s cubic-bezier(.16,1,.3,1), pulse-glow 3s ease-in-out infinite}
    .hero h1{font-size:clamp(36px,9vw,80px);line-height:1.1;font-weight:900;letter-spacing:-.03em;margin-bottom:28px;color:var(--text);animation:slideDown .8s cubic-bezier(.16,1,.3,1) .1s backwards}
    .hero-subtitle{font-size:clamp(16px,3.5vw,24px);color:var(--text-light);margin-bottom:48px;line-height:1.6;font-weight:600;animation:slideDown .8s cubic-bezier(.16,1,.3,1) .2s backwards;padding:0 10px}
    .hero-cta-group{display:flex;flex-direction:column;gap:16px;align-items:center;animation:slideDown .8s cubic-bezier(.16,1,.3,1) .3s backwards}
    @media (min-width:640px){.hero-cta-group{flex-direction:row;justify-content:center;gap:20px}}
    .hero-cta{display:inline-flex;align-items:center;justify-content:center;gap:14px;padding:20px 44px;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);color:#fff;font-size:17px;font-weight:800;border-radius:100px;text-decoration:none;box-shadow:0 12px 32px rgba(37,99,235,.4);transition:.3s;border:none;cursor:pointer;position:relative;overflow:hidden}
    .hero-cta { pointer-events:auto; position:relative; z-index:5; } /* assure le clic */
    .hero-cta-secondary{background:#fff;color:var(--primary);border:2px solid var(--primary)}
    .hero-stats{display:grid;grid-template-columns:1fr;gap:40px;margin-top:80px;padding-top:80px;border-top:2px solid var(--border);max-width:1000px;margin-left:auto;margin-right:auto}
    @media (min-width:640px){.hero-stats{grid-template-columns:repeat(3,1fr);gap:48px}}
    .hero-stat{text-align:center}
    .hero-stat-number{font-size:clamp(40px,8vw,72px);font-weight:900;background:linear-gradient(135deg,var(--primary),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:block;margin-bottom:12px;line-height:1}

    /* Sections */
    .section{padding:80px 0}
    @media (min-width:768px){.section{padding:100px 0}}
    @media (min-width:1024px){.section{padding:120px 0}}
    .section-header{text-align:center;max-width:900px;margin:0 auto 60px}
    @media (min-width:768px){.section-header{margin-bottom:80px}}
    .section-title{font-size:clamp(32px,7vw,56px);font-weight:900;margin-bottom:16px;color:var(--text);letter-spacing:-.03em;line-height:1.1}
    .section-subtitle{font-size:clamp(16px,2.8vw,24px);color:var(--text-light);line-height:1.6;font-weight:600}

    /* Language grid */
    .lang-grid{display:grid;grid-template-columns:1fr;gap:20px;max-width:1200px;margin:0 auto}
    @media (min-width:640px){.lang-grid{grid-template-columns:repeat(2,1fr);gap:24px}}
    @media (min-width:1024px){.lang-grid{grid-template-columns:repeat(3,1fr);gap:28px}}
    .lang-card{background:#fff;border:2px solid var(--border);border-radius:24px;padding:32px 28px;transition:.2s;position:relative;overflow:hidden;text-decoration:none;display:block}
    .lang-card:hover{transform:translateY(-6px);box-shadow:0 20px 56px rgba(37,99,235,.15);border-color:var(--primary-light)}
    .lang-flag{font-size:80px;margin-bottom:18px;display:block}
    .lang-name{font-size:22px;font-weight:900;color:var(--text);margin-bottom:10px}
    .lang-desc{font-size:14px;color:var(--text-light);font-weight:500}

    /* Content grid */
    .content-grid{display:grid;grid-template-columns:1fr;gap:24px}
    @media (min-width:640px){.content-grid{grid-template-columns:repeat(2,1fr);gap:28px}}
    @media (min-width:1024px){.content-grid{grid-template-columns:repeat(4,1fr);gap:32px}}
    .content-card{background:#fff;border:2px solid var(--border);border-radius:24px;padding:28px 24px;transition:.2s}
    .content-card:hover{transform:translateY(-6px);box-shadow:0 20px 56px rgba(37,99,235,.15);border-color:var(--primary-light)}
    .content-preview{background:var(--bg-light);border-radius:16px;padding:20px;margin-bottom:24px;box-shadow:0 4px 12px rgba(0,0,0,.05)}
    .preview-box{position:relative;height:180px;width:100%;overflow:hidden;border-radius:12px;background:#fff}
    @media (min-width:768px){.preview-box{height:200px}}
    .content-title{font-size:18px;font-weight:900;color:var(--text);margin-bottom:10px}
    .content-desc{font-size:14px;color:var(--text-light);margin-bottom:18px;font-weight:500}

    /* Platforms & FAQ (inchangés) */
    .platform-grid{display:grid;grid-template-columns:1fr;gap:32px;max-width:1100px;margin:0 auto}
    @media (min-width:1024px){.platform-grid{grid-template-columns:repeat(2,1fr);gap:40px}}
    .platform-card{background:#fff;border:3px solid var(--border);border-radius:32px;padding:40px 32px;transition:.2s}
    .platform-card:hover{transform:translateY(-6px);box-shadow:0 24px 60px rgba(37,99,235,.18);border-color:var(--primary-light)}

    /* Modals */
    .modal{position:fixed;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);z-index:9999;display:flex;align-items:center;justify-content:center;padding:20px}
    .modal.hidden{display:none}
    .modal-content{background:#fff;border-radius:28px;max-width:900px;width:100%;max-height:90vh;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,.3)}
    .modal-header{display:flex;justify-content:space-between;align-items:center;padding:24px 28px;border-bottom:2px solid var(--border)}
    .modal-title{font-size:20px;font-weight:900;color:var(--text)}
    .modal-close{width:40px;height:40px;border-radius:50%;background:var(--bg-light);border:none;display:flex;align-items:center;justify-content:center;font-size:24px;color:var(--text-muted);cursor:pointer}
    .modal-body{height:60vh;min-height:400px}
    .modal-body iframe,.modal-body img{width:100%;height:100%;object-fit:contain}

    /* Contact form */
    .form-modal{max-width:640px}
    .form-group{margin-bottom:14px}
    .form-label{display:block;font-weight:800;font-size:13px;margin-bottom:6px;color:var(--text)}
    .required:after{content:' *';color:#DC2626}
    .form-input{width:100%;padding:14px 16px;border:2px solid var(--border);border-radius:14px;font-size:14px;font-family:'Poppins',sans-serif;font-weight:500;transition:.15s;background:#fff}
    .form-input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 4px rgba(37,99,235,.1)}
    .form-hint{font-size:12px;color:var(--text-muted);margin-top:6px}
    .error-text{font-size:12px;color:#DC2626;margin-top:6px;display:none}
    .has-error .form-input{border-color:#DC2626}
    .has-error .error-text{display:block}
    textarea.form-input{resize:vertical;min-height:120px}
    .form-submit{width:100%;padding:16px 28px;background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;font-weight:800;font-size:16px;border:none;border-radius:16px;cursor:pointer;transition:.2s;box-shadow:0 8px 24px rgba(37,99,235,.3)}

    /* Success popup */
    .success-popup{max-width:500px;text-align:center;padding:48px 32px}
    .success-icon{width:84px;height:84px;background:linear-gradient(135deg,var(--success),#34D399);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 22px;font-size:42px}
  </style>
</head>

<body>
  @include('includes.header')
  @include('wizards.requester.steps.popup_request_help')

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-badge">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          <span>🌍 The Only International Platform Serving 197 Countries</span>
        </div>

        <h1>Ulixai Press & Media Center 📰</h1>

        <p class="hero-subtitle">
          Access official press resources for <strong>the world's first truly global expat platform</strong>.<br>
          Serving <strong>304 million expats and 1.645 billion travelers</strong> in <strong>197 countries</strong> with <strong>all major languages</strong>.
        </p>

        <div class="hero-cta-group">
          <a href="#languages" class="hero-cta">
            <span>Access Press Materials</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <button type="button" onclick="openModal(event)" class="hero-cta hero-cta-secondary js-open-press-modal">
            <span>Contact Press Team</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </button>
        </div>

        <div class="hero-stats">
          <div class="hero-stat"><span class="hero-stat-number">304M</span><span class="hero-stat-label">Global Expats Served</span></div>
          <div class="hero-stat"><span class="hero-stat-number">1.645B</span><span class="hero-stat-label">International Travelers</span></div>
          <div class="hero-stat"><span class="hero-stat-number">197</span><span class="hero-stat-label">Countries Worldwide</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- What is Ulixai Section -->
  <section class="section" style="background: var(--bg-light);">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Ulixai — Collaborative Platform Connecting Expats & Travelers 🌐</h2>
        <p class="section-subtitle">The right service provider, in your language, wherever you are</p>
      </div>

      <div style="max-width: 900px; margin: 0 auto; background: white; border-radius: 28px; padding: 40px 32px; border: 2px solid var(--border); box-shadow: 0 8px 24px rgba(37, 99, 235, 0.1);">
        <p style="font-size: 16px; line-height: 1.8; color: var(--text-light); font-weight: 500; margin-bottom: 24px;">
          Ulixai is a <strong style="color: var(--text); font-weight: 800;">collaborative platform connecting expats and travelers</strong> with verified local service providers and helpful expats worldwide. Whether you need immediate assistance or planned services, we make international life simple.
        </p>

        <div style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(168, 85, 247, 0.08)); padding: 24px; border-radius: 18px; margin-bottom: 28px;">
          <h3 style="font-size: 18px; font-weight: 900; color: var(--text); margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 24px;">👥</span> For Clients — How It Works
          </h3>
          <ul style="list-style: none; padding: 0;">
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">Describe your need</strong> (country, language, service, timeframe)
            </li>
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">Receive multiple quotes</strong> from verified providers who speak your language
            </li>
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">Choose in-person or online</strong>. Payment, history, and reviews in one place
            </li>
          </ul>
          <p style="font-size: 14px; color: var(--text-muted); font-weight: 600; margin-top: 16px; font-style: italic;">
            Examples: visas, translations, housing, education, healthcare, administrative tasks, moving, employment...
          </p>
        </div>

        <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(52, 211, 153, 0.08)); padding: 24px; border-radius: 18px;">
          <h3 style="font-size: 18px; font-weight: 900; color: var(--text); margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 24px;">💼</span> For Service Providers
          </h3>
          <ul style="list-style: none; padding: 0;">
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">2-minute registration</strong> (expat or professional)
            </li>
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">Receive requests</strong> based on your languages and countries
            </li>
            <li style="padding-left: 28px; margin-bottom: 10px; font-size: 15px; color: var(--text-light); line-height: 1.7; font-weight: 500; position: relative;">
              <span style="position: absolute; left: 0; color: var(--success); font-weight: 900; font-size: 18px;">✓</span>
              <strong style="color: var(--text); font-weight: 800;">Quote → Service → Payment</strong>, build your reputation
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">How to Access Press Materials ⚡</h2>
        <p class="section-subtitle">Get the information you need in 3 simple steps</p>
      </div>

      <div class="lang-grid" style="max-width: 1000px;">
        <div class="lang-card" style="pointer-events:none">
          <span class="lang-flag">1️⃣</span>
          <h3 class="lang-name">Select Your Language</h3>
          <p class="lang-desc">Choose from available languages below to access localized press materials</p>
        </div>
        <div class="lang-card" style="pointer-events:none">
          <span class="lang-flag">2️⃣</span>
          <h3 class="lang-name">Choose Content Type</h3>
          <p class="lang-desc">Access logos, press kits, photos, guidelines, or press releases</p>
        </div>
        <div class="lang-card" style="pointer-events:none">
          <span class="lang-flag">3️⃣</span>
          <h3 class="lang-name">View or Download</h3>
          <p class="lang-desc">Preview online or download as ZIP for your publication needs</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Languages Section -->
  <section id="languages" class="section" style="background: var(--bg-light);">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Press Materials by Language 🌐</h2>
        <p class="section-subtitle">Select your language to access press kits, releases, and media resources</p>
      </div>

      <div class="lang-grid">
        <a href="/press/en" class="lang-card">
          <span class="lang-flag">🇬🇧</span>
          <h3 class="lang-name">English</h3>
          <p class="lang-desc">Press kits, releases, and brand guidelines</p>
        </a>

        <a href="/press/fr" class="lang-card">
          <span class="lang-flag">🇫🇷</span>
          <h3 class="lang-name">Français</h3>
          <p class="lang-desc">Dossiers de presse, communiqués, et guidelines</p>
        </a>

        <a href="/press/de" class="lang-card">
          <span class="lang-flag">🇩🇪</span>
          <h3 class="lang-name">Deutsch</h3>
          <p class="lang-desc">Pressemappen, Mitteilungen und Richtlinien</p>
        </a>
      </div>
    </div>
  </section>

  <!-- Press Materials (only if $showContent) -->
  @if(isset($showContent) && $showContent)
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">📁 Download Press Materials</h2>
        <p class="section-subtitle">High-quality assets for your publication</p>
      </div>

      @php
        $icons   = $pressItems->filter(fn($p) => !empty($p->icon))->sortByDesc('updated_at');
        $photos  = $pressItems->filter(fn($p) => !empty($p->photo))->sortByDesc('updated_at');
        $pdfs    = $pressItems->filter(fn($p) => !empty($p->pdf))->sortByDesc('updated_at');
        $guides  = $pressItems->filter(fn($p) => !empty($p->guideline_pdf))->sortByDesc('updated_at');

        $latestIcon  = $icons->first();
        $latestPhoto = $photos->first();
        $latestPdf   = $pdfs->first();
        $latestGuide = $guides->first();
      @endphp

      @if($pressItems->isEmpty())
        <div class="text-center py-16">
          <div style="font-size: 64px; margin-bottom: 16px;">📦</div>
          <p class="text-[16px] text-slate-500 font-semibold">No press assets available yet. Please check back later or contact our press team.</p>
        </div>
      @else
        <div class="content-grid">
          <!-- Official Logo -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestIcon)
                  <img src="{{ route('press.asset', [$latestIcon->id, 'icon']) }}" alt="Official Ulixai Logo" style="width:100%;height:100%;object-fit:contain">
                @else
                  <div class="flex items-center justify-center h-full text-6xl">🗂️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Official Logo</h3>
            <p class="content-desc">PNG & SVG formats available</p>
            @if($latestIcon)
              <div class="flex flex-col gap-2">
                <button onclick="viewAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}')" class="btn btn-primary">👁️ View Logo</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}', 'ulixai-logo.png')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p class="text-center text-slate-400 font-semibold text-[13px]">Coming soon</p>
            @endif
          </div>

          <!-- Press Kit PDF -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="pdf-preview-{{ $latestPdf ? $latestPdf->id : 'none' }}">
                @if($latestPdf)
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,rgba(220,38,38,.1),rgba(239,68,68,.1));cursor:pointer;"
                       onclick="loadPdfPreview('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'pdf-preview-{{ $latestPdf->id }}')">
                    <div style="text-align:center;">
                      <div style="font-size:56px;margin-bottom:12px;">📄</div>
                      <div style="font-size:13px;color:var(--text-muted);font-weight:700;">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div class="flex items-center justify-center h-full text-6xl">📄</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Press Kit (PDF)</h3>
            <p class="content-desc">Complete information package</p>
            @if($latestPdf)
              <div class="flex flex-col gap-2">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestPdf->id, 'pdf']) }}')" class="btn btn-primary">👁️ View PDF</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'ulixai-press-kit.pdf')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p class="text-center text-slate-400 font-semibold text-[13px]">Coming soon</p>
            @endif
          </div>

          <!-- Brand Guidelines -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="guide-preview-{{ $latestGuide ? $latestGuide->id : 'none' }}">
                @if($latestGuide)
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,rgba(168,85,247,.1),rgba(192,132,252,.1));cursor:pointer;"
                       onclick="loadPdfPreview('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'guide-preview-{{ $latestGuide->id }}')">
                    <div style="text-align:center;">
                      <div style="font-size:56px;margin-bottom:12px;">📘</div>
                      <div style="font-size:13px;color:var(--text-muted);font-weight:700;">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div class="flex items-center justify-center h-full text-6xl">📘</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Brand Guidelines</h3>
            <p class="content-desc">Usage rules and standards</p>
            @if($latestGuide)
              <div class="flex flex-col gap-2">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestGuide->id, 'guideline_pdf']) }}')" class="btn btn-primary">👁️ View Guidelines</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'ulixai-brand-guidelines.pdf')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p class="text-center text-slate-400 font-semibold text-[13px]">Coming soon</p>
            @endif
          </div>

          <!-- HD Photos -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestPhoto)
                  <img src="{{ route('press.asset', [$latestPhoto->id, 'photo']) }}" alt="Ulixai HD Photo" style="width:100%;height:100%;object-fit:cover;border-radius:8px">
                @else
                  <div class="flex items-center justify-center h-full text-6xl">🖼️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">HD Photos</h3>
            <p class="content-desc">High-resolution images</p>
            @if($latestPhoto)
              <div class="flex flex-col gap-2">
                <button onclick="viewAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}')" class="btn btn-primary">👁️ View Photo</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}', 'ulixai-photo.jpg')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p class="text-center text-slate-400 font-semibold text-[13px]">Coming soon</p>
            @endif
          </div>
        </div>

        @php $releases = $pressItems->whereNotNull('pdf')->sortByDesc('created_at')->take(6); @endphp
        @if($releases->isNotEmpty())
        <div class="mt-20">
          <div class="section-header" style="margin-bottom: 32px;">
            <h2 class="section-title">📰 Recent Press Releases</h2>
            <p class="section-subtitle">Latest news and announcements</p>
          </div>

          <div class="content-grid" style="grid-template-columns: 1fr;">
            @foreach($releases as $pr)
              <div class="content-card" style="padding: 28px; display: flex; align-items: center; gap: 20px;">
                <div style="flex-shrink:0;width:72px;height:72px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:36px;box-shadow:0 12px 32px rgba(37,99,235,.25);">📰</div>
                <div style="flex:1;">
                  <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                    <h4 style="font-size:19px;font-weight:900;color:var(--text);margin:0;">{{ $pr->title ?: 'Ulixai Press Release' }}</h4>
                    <span style="font-size:12px;font-weight:800;color:var(--primary);background:rgba(37,99,235,.1);padding:4px 12px;border-radius:100px;">{{ optional($pr->created_at)->format('M Y') }}</span>
                  </div>
                  @if($pr->description)
                    <p style="font-size:14px;color:var(--text-light);font-weight:500;margin:0 0 16px 0;line-height:1.6;">{{ \Illuminate\Support\Str::limit($pr->description, 180) }}</p>
                  @endif
                  @if($pr->pdf)
                    <button onclick="downloadAsset('{{ route('press.asset', [$pr->id, 'pdf']) }}', '{{ $pr->title ? \Illuminate\Support\Str::slug($pr->title) : 'press-release' }}-{{ optional($pr->created_at)->format('Y-m') }}.pdf')" class="btn btn-primary" style="width:auto;padding:10px 24px;">⬇️ Download Release</button>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif
      @endif
    </div>
  </section>
  @endif

  <!-- 2 Platforms, 4 Missions Section -->
  <section class="section" style="background: var(--bg-light);">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">2 Platforms, 4 Missions 🚀</h2>
        <p class="section-subtitle">Helping expats AND creating income opportunities for everyone, everywhere</p>
      </div>

      <div class="platform-grid">
        <!-- SOS-Expat.com -->
        <div class="platform-card">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-[72px] h-[72px] rounded-2xl flex items-center justify-center text-3xl" style="background:linear-gradient(135deg,#DC2626,#EF4444);">🆘</div>
            <div>
              <h3 class="text-[26px] font-black" style="color:#DC2626">SOS-Expat.com</h3>
              <p class="text-[15px] text-slate-500 font-bold mt-1">Immediate Assistance 24/7</p>
            </div>
          </div>

          <div style="background:linear-gradient(135deg,rgba(220,38,38,.08),rgba(239,68,68,.08));padding:22px;border-radius:18px;margin-bottom:20px;">
            <p class="text-[15px] text-slate-600 font-medium">
              <strong class="text-slate-900">In less than 5 minutes</strong>, we connect you with a trusted lawyer or helping expat.
              <strong class="text-slate-900">Guaranteed call.</strong> No stress, no surprises — just a solution, now.
            </p>
          </div>

          <div class="space-y-3">
            <div class="bg-slate-50 p-5 rounded-xl border-l-4" style="border-color:#DC2626">
              <div class="flex gap-3 items-start">
                <span class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black" style="background:linear-gradient(135deg,#DC2626,#EF4444)">1</span>
                <div>
                  <h4 class="font-black text-[16px]">Mission 1: Immediate Assistance</h4>
                  <p class="text-slate-600 text-[14px]">Expats, travelers, and vacationers in difficulty anywhere in the world get instant 24/7 help</p>
                </div>
              </div>
            </div>
            <div class="bg-slate-50 p-5 rounded-xl border-l-4 border-emerald-500">
              <div class="flex gap-3 items-start">
                <span class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black" style="background:linear-gradient(135deg,#10B981,#34D399)">2</span>
                <div>
                  <h4 class="font-black text-[16px]">Mission 2: Guaranteed Income</h4>
                  <p class="text-slate-600 text-[14px]">Lawyers & expat helpers earn money with prepaid calls from anywhere</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ulixai.com -->
        <div class="platform-card">
          <div class="flex items-center gap-4 mb-6">
            <div class="w-[72px] h-[72px] rounded-2xl flex items-center justify-center text-3xl" style="background:linear-gradient(135deg,var(--primary),var(--primary-light));">🔍</div>
            <div>
              <h3 class="text-[26px] font-black" style="color:var(--primary)">Ulixai.com</h3>
              <p class="text-[15px] text-slate-500 font-bold mt-1">Services & Competitive Offers</p>
            </div>
          </div>

          <div style="background:linear-gradient(135deg,rgba(37,99,235,.08),rgba(168,85,247,.08));padding:22px;border-radius:18px;margin-bottom:20px;">
            <p class="text-[15px] text-slate-600 font-medium">Verified expat helpers or pros, <strong class="text-slate-900">fast responses, quick quotes, simple tracking</strong>. For expats, future expats, travelers, vacationers — all nationalities, everywhere.</p>
          </div>

          <div class="space-y-3">
            <div class="bg-slate-50 p-5 rounded-xl border-l-4" style="border-color:var(--primary)">
              <div class="flex gap-3 items-start">
                <span class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black" style="background:linear-gradient(135deg,var(--primary),var(--primary-light))">1</span>
                <div>
                  <h4 class="font-black text-[16px]">Mission 1: Unlimited Services & Multiple Providers</h4>
                  <p class="text-slate-600 text-[14px]">Find the right service provider anywhere in the world with competitive offers</p>
                </div>
              </div>
            </div>
            <div class="bg-slate-50 p-5 rounded-xl border-l-4 border-emerald-500">
              <div class="flex gap-3 items-start">
                <span class="w-9 h-9 rounded-full flex items-center justify-center text-white font-black" style="background:linear-gradient(135deg,#10B981,#34D399)">2</span>
                <div>
                  <h4 class="font-black text-[16px]">Mission 2: Global Income Opportunities</h4>
                  <p class="text-slate-600 text-[14px]">Expat service providers and professionals earn income wherever they are worldwide</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="mt-10 text-center p-8 bg-white rounded-2xl border-2 border-slate-200">
        <h3 class="text-[24px] font-black text-slate-900 mb-2">🌍 Double Global Impact</h3>
        <p class="text-[16px] text-slate-600 font-medium">We help expats with their challenges <strong class="text-slate-900">AND</strong> create income opportunities for helpers and providers, everywhere in the world.</p>
      </div>
    </div>
  </section>

  <!-- Global Impact Stats -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Global Reach & Impact 🌍</h2>
        <p class="section-subtitle">Understanding the international expatriation landscape</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-7 max-w-[1000px] mx-auto">
        <div class="bg-white border-2 border-slate-200 rounded-2xl p-7 relative overflow-hidden">
          <span class="text-4xl mb-3 block">🌍</span>
          <h3 class="text-[20px] font-black mb-3 text-slate-900">Global Expatriation at a Glance</h3>
          <ul class="list-disc ml-5 text-[14px] text-slate-600 font-medium space-y-2">
            <li><strong class="text-slate-900">304 million people</strong> currently live outside their country of origin (UN, 2023)</li>
            <li>Over <strong class="text-slate-900">1.645 billion international travelers</strong> every year</li>
            <li>Mobility keeps growing for work, study, retirement, and family reasons</li>
          </ul>
          <div class="mt-3 p-4 rounded-xl" style="background:linear-gradient(135deg,rgba(37,99,235,.08),rgba(168,85,247,.08))">
            <strong class="text-slate-900">Key challenges:</strong> administrative procedures, housing, employment, healthcare, and cultural integration across 197 countries
          </div>
        </div>

        <div class="bg-white border-2 border-slate-200 rounded-2xl p-7 relative overflow-hidden">
          <span class="text-4xl mb-3 block">ℹ️</span>
          <h3 class="text-[20px] font-black mb-3 text-slate-900">About Ulixai & SOS Expat</h3>
          <ul class="list-disc ml-5 text-[14px] text-slate-600 font-medium space-y-2">
            <li><strong class="text-slate-900">Ulixai.com:</strong> collaborative digital platform centralizing information & services across all major languages</li>
            <li><strong class="text-slate-900">SOS-Expat.com:</strong> on-demand, 24/7 assistance service for urgent needs (legal, housing, healthcare, employment)</li>
            <li><strong class="text-slate-900">Coverage:</strong> 197 countries with support in all major world languages</li>
          </ul>
          <div class="mt-3 p-4 rounded-xl" style="background:linear-gradient(135deg,rgba(37,99,235,.08),rgba(168,85,247,.08))">
            <strong class="text-slate-900">Our commitment:</strong> speed, confidentiality, reliability, and true international accessibility
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact CTA -->
  <section class="section" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--accent) 100%); color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; top: -200px; right: -150px; filter: blur(80px);"></div>
    <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; bottom: -150px; left: -100px; filter: blur(70px);"></div>

    <div class="container" style="position: relative; z-index: 1; text-align: center;">
      <h2 style="font-size: clamp(32px, 8vw, 56px); font-weight: 900; margin-bottom: 24px; letter-spacing: -0.03em;">Need More Information? 📧</h2>
      <p style="font-size: clamp(16px, 3.5vw, 22px); opacity: .95; margin-bottom: 48px; font-weight: 600;">Our press team responds to all inquiries within 24 hours</p>
      <button type="button" onclick="openModal(event)" class="hero-cta hero-cta-secondary js-open-press-modal" style="background:#fff;color:var(--primary);border:0">
        <span>Contact Press Team</span>
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </div>
  </section>

  <!-- PDF Modal -->
  <div id="pdfModal" class="modal hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Document Preview</h3>
        <button onclick="closePdfModal()" class="modal-close" aria-label="Close PDF">×</button>
      </div>
      <div class="modal-body">
        <iframe id="pdfModalFrame" src="" title="PDF Preview"></iframe>
      </div>
    </div>
  </div>

  <!-- Asset Modal -->
  <div id="assetModal" class="modal hidden" style="background: rgba(0, 0, 0, 0.9);">
    <div style="position: relative; max-width: 90vw; max-height: 90vh;">
      <button onclick="closeAssetModal()" style="position: absolute; top: -50px; right: 0; width: 48px; height: 48px; border-radius: 50%; background: white; border: none; display: flex; align-items: center; justify-content: center; font-size: 28px; color: var(--text); cursor: pointer; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3); transition: .2s; z-index: 10;" aria-label="Close image">×</button>
      <img id="assetModalImg" style="max-width: 100%; max-height: 90vh; object-fit: contain; border-radius: 16px; box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5);" src="" alt="Asset preview">
    </div>
  </div>

  <!-- Contact Form Modal -->
  <div id="contactModal" class="modal hidden">
    <div class="modal-content form-modal">
      <div class="modal-header">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl text-white" style="background:linear-gradient(135deg,var(--primary),var(--accent))">📧</div>
          <h3 class="modal-title">Press Relations Contact</h3>
        </div>
        <button onclick="closeModal()" class="modal-close js-close-press-modal" aria-label="Close contact form">×</button>
      </div>

      <div class="p-8">
        <!-- global error box -->
        <div id="formGlobalErrors" class="hidden mb-4 p-3 rounded-lg border-2 border-red-200 text-red-700 bg-red-50 text-[13px] font-semibold"></div>

        <form id="pressForm" onsubmit="submitForm(event)">
          @csrf

          <div class="grid grid-cols-1 gap-3">
            <div class="form-group">
              <label class="form-label required" for="media_name">Media Outlet Name</label>
              <input type="text" class="form-input" id="media_name" name="media_name" placeholder="Media Outlet Name" required>
              <div class="form-hint">e.g. Le Monde, BBC, Die Zeit…</div>
              <div class="error-text"></div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="full_name">Your Full Name</label>
              <input type="text" class="form-input" id="full_name" name="full_name" placeholder="Your Full Name" required>
              <div class="error-text"></div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="email">Professional Email</label>
              <input type="email" class="form-input" id="email" name="email" placeholder="name@media.com" required>
              <div class="error-text"></div>
            </div>

            <div class="grid grid-cols-3 gap-2">
              <div class="form-group">
                <label class="form-label required" for="dial_code">Country Code</label>
                <select class="form-input" name="phone_country_code" id="dial_code" required>
                  <option value="">Select…</option>
                  <option value="+1">🇺🇸 +1</option>
                  <option value="+33">🇫🇷 +33</option>
                  <option value="+44">🇬🇧 +44</option>
                  <option value="+49">🇩🇪 +49</option>
                  <option value="+34">🇪🇸 +34</option>
                  <option value="+41">🇨🇭 +41</option>
                  <option value="+32">🇧🇪 +32</option>
                  <option value="+39">🇮🇹 +39</option>
                  <option value="+352">🇱🇺 +352</option>
                  <option value="+971">🇦🇪 +971</option>
                </select>
                <div class="error-text"></div>
              </div>
              <div class="form-group col-span-2">
                <label class="form-label required" for="phone">Phone Number</label>
                <input type="tel" class="form-input" id="phone" name="phone" placeholder="Include country code or use selector" required>
                <div class="form-hint">Examples: +33123456789 or 0123456789 with code</div>
                <div class="error-text"></div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Publication Website (optional)</label>
              <input type="url" class="form-input" name="website" placeholder="https://example.com">
              <div class="error-text"></div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="languages_spoken">Preferred Language(s)</label>
              <input type="text" class="form-input" id="languages_spoken" name="languages_spoken" placeholder="en, fr, de…" required>
              <div class="error-text"></div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="how_heard">How did you hear about us?</label>
              <select class="form-input" id="how_heard" name="how_heard" required>
                <option value="">Select…</option>
                <option value="press">Press / Media</option>
                <option value="search">Search engine</option>
                <option value="social">Social media</option>
                <option value="referral">Referral</option>
                <option value="other">Other</option>
              </select>
              <div class="error-text"></div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="message">Your Message</label>
              <textarea class="form-input" id="message" name="message" placeholder="Your Message or Inquiry" rows="5" required></textarea>
              <div class="error-text"></div>
            </div>

            <button type="submit" class="form-submit">📨 Send Press Inquiry</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Success Popup -->
  <div id="thankYouModal" class="modal hidden">
    <div class="modal-content success-popup">
      <div class="success-icon">✅</div>
      <h3 class="text-[26px] font-black text-slate-900 mb-2">Message sent</h3>
      <p class="text-[15px] text-slate-600">Thank you. Our press team will get back to you within 24 hours.</p>
      <div class="mt-6">
        <button onclick="document.getElementById('thankYouModal').classList.add('hidden')" class="form-submit" style="width:auto;padding:12px 22px;">Close</button>
      </div>
    </div>
  </div>

  <!-- ===== JavaScript ===== -->
  <script>
    'use strict';

    /* ---------- Modal helpers (GLOBAL) ---------- */
    window.openModal = function (ev) {
      try { ev && ev.preventDefault && ev.preventDefault(); } catch (_) {}
      try { ev && ev.stopPropagation && ev.stopPropagation(); } catch (_) {}
      const m = document.getElementById('contactModal');
      if (m) {
        m.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        if (typeof autoGuessDialCode === 'function') autoGuessDialCode();
      } else {
        console.warn('#contactModal not found on this view.');
      }
    };
    window.closeModal = function () {
      const m = document.getElementById('contactModal');
      if (m) { m.classList.add('hidden'); document.body.style.overflow = ''; }
    };

    /* ---------- Submit press inquiry ---------- */
    function setFieldError(fieldEl, msg){
      const wrapper = fieldEl.closest('.form-group');
      if(!wrapper) return;
      wrapper.classList.add('has-error');
      const err = wrapper.querySelector('.error-text');
      if(err) err.textContent = msg || 'This field is required';
    }
    function clearErrors(form){
      form.querySelectorAll('.has-error').forEach(el=>el.classList.remove('has-error'));
      const box = document.getElementById('formGlobalErrors');
      if(box){ box.classList.add('hidden'); box.textContent=''; }
    }
    function showGlobalErrors(list){
      const box = document.getElementById('formGlobalErrors');
      if(!box) return;
      box.innerHTML = 'Please fix the following:<ul class="list-disc ml-5 mt-1">'+ list.map(e=>'<li>'+e+'</li>').join('') +'</ul>';
      box.classList.remove('hidden');
    }

    function normalizePhone(dial, phone){
      phone = (phone||'').trim();
      dial = (dial||'').trim();
      if(!phone) return '';
      if(phone.startsWith('+')) return phone.replace(/\s+/g,'');
      if(dial.startsWith('+')) return dial + phone.replace(/^0+/,'').replace(/\s+/g,'');
      return phone.replace(/\s+/g,'');
    }

    async function submitForm(e){
      e.preventDefault();
      const form = e.target;
      clearErrors(form);

      const btn = form.querySelector('button[type="submit"]');
      const original = btn.innerHTML;
      btn.disabled = true; btn.innerHTML = '⏳ Sending…';

      const fd = new FormData(form);
      const dial = (fd.get('phone_country_code')||'').trim();
      const phoneRaw = fd.get('phone') || '';
      const phone = normalizePhone(dial, phoneRaw);

      // Validation côté front (alignée avec ta règle)
      const requiredFields = ['media_name','full_name','email','languages_spoken','how_heard','message'];
      const errors = [];
      requiredFields.forEach(name=>{
        const el = form.querySelector(`[name="${name}"]`);
        if(el && !String(el.value||'').trim()){
          setFieldError(el, 'Required');
          errors.push(`Field "${name}" is required`);
        }
      });
      // Dial code obligatoire
      const dialEl = form.querySelector('#dial_code');
      if(!dial){
        setFieldError(dialEl, 'Country code is required');
        errors.push('Country code is required');
      }
      // Phone obligatoire
      const phoneEl = form.querySelector('#phone');
      if(!String(phoneRaw||'').trim()){
        setFieldError(phoneEl, 'Phone is required');
        errors.push('Phone is required');
      }

      if(errors.length){
        showGlobalErrors(errors);
        btn.disabled = false; btn.innerHTML = original;
        return;
      }

      const payload = {
        media_name:       (fd.get('media_name')||'').trim(),
        full_name:        (fd.get('full_name')||'').trim(),
        email:            (fd.get('email')||'').trim(),
        phone:            phone,
        phone_country_code: dial,
        website:          (fd.get('website')||'').trim() || null,
        languages_spoken: (fd.get('languages_spoken')||'').trim(),
        how_heard:        (fd.get('how_heard')||'').trim(),
        message:          (fd.get('message')||'').trim()
      };

      try{
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const res = await fetch('/press/inquiry', {
          method:'POST',
          headers:{
            'Content-Type':'application/json',
            'Accept':'application/json',
            ...(csrf ? {'X-CSRF-TOKEN':csrf} : {})
          },
          body: JSON.stringify(payload)
        });

        const data = await res.json().catch(()=> ({}));

        if(!res.ok){
          const list = [];
          // Laravel validation: { errors: { field: [msg] } }
          if(data && data.errors){
            Object.entries(data.errors).forEach(([field, msgs])=>{
              const el = form.querySelector(`[name="${field}"]`);
              if(el) setFieldError(el, (msgs && msgs[0]) || 'Invalid');
              list.push(...(msgs||[]));
            });
          }
          if(!list.length) list.push(data?.message || 'Validation error');
          showGlobalErrors(list);
          return;
        }

        form.reset();
        closeModal();
        const t = document.getElementById('thankYouModal');
        if(t){ t.classList.remove('hidden'); setTimeout(()=>t.classList.add('hidden'), 5000); }
      }catch(err){
        console.error(err);
        showGlobalErrors(['Network error. Please try again.']);
      }finally{
        btn.disabled = false; btn.innerHTML = original;
      }
    }

    /* ---------- Assets & PDFs ---------- */
    function viewAsset(url){ const m=document.getElementById('assetModal'); const img=document.getElementById('assetModalImg'); if(m&&img){ img.src=url; m.classList.remove('hidden'); document.body.style.overflow='hidden'; } }
    function closeAssetModal(){ const m=document.getElementById('assetModal'); const img=document.getElementById('assetModalImg'); if(m){ m.classList.add('hidden'); document.body.style.overflow=''; } if(img) img.src=''; }
    function downloadAsset(url, filename){ const a=document.createElement('a'); a.href=url; if(filename) a.setAttribute('download', filename); document.body.appendChild(a); a.click(); a.remove(); }
    function viewPdfModal(url){ const m=document.getElementById('pdfModal'); const f=document.getElementById('pdfModalFrame'); if(m&&f){ f.src=url; m.classList.remove('hidden'); document.body.style.overflow='hidden'; } }
    function closePdfModal(){ const m=document.getElementById('pdfModal'); const f=document.getElementById('pdfModalFrame'); if(m){ m.classList.add('hidden'); document.body.style.overflow=''; } if(f) f.src=''; }
    function loadPdfPreview(url, containerId){ const c=document.getElementById(containerId); if(!c) return; c.innerHTML='<iframe src="'+url+'" style="width:100%;height:100%;border:0;"></iframe>'; }

    /* ---------- UX helpers ---------- */
    document.addEventListener('keydown', (e)=>{ if(e.key==='Escape'){ closeModal(); closePdfModal(); closeAssetModal(); const t=document.getElementById('thankYouModal'); if(t) t.classList.add('hidden'); } });
    document.addEventListener('click', (e)=>{
      const pdfModal=document.getElementById('pdfModal'); if(pdfModal && !pdfModal.classList.contains('hidden') && e.target===pdfModal) closePdfModal();
      const assetModal=document.getElementById('assetModal'); if(assetModal && !assetModal.classList.contains('hidden') && e.target===assetModal) closeAssetModal();
      const contactModal=document.getElementById('contactModal'); if(contactModal && !contactModal.classList.contains('hidden') && e.target===contactModal) closeModal();
      const thankModal=document.getElementById('thankYouModal'); if(thankModal && !thankModal.classList.contains('hidden') && e.target===thankModal) thankModal.classList.add('hidden');
    });

    // Ajoute aussi des listeners sans inline, pour robustesse
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.js-open-press-modal').forEach(btn => {
        btn.addEventListener('click', window.openModal, false);
      });
      document.querySelectorAll('.js-close-press-modal').forEach(btn => {
        btn.addEventListener('click', window.closeModal, false);
      });
    });

    /* ---------- Auto-guess dial code from browser language ---------- */
    function autoGuessDialCode(){
      try{
        const map = { 'fr':'+33','fr-FR':'+33','fr-BE':'+32','fr-CH':'+41', 'de':'+49','de-DE':'+49','en':'+1','en-GB':'+44','es':'+34','it':'+39' };
        const lang = (navigator.language || '').trim();
        const guess = map[lang] || map[lang.split('-')[0]];
        if(guess){
          const sel = document.getElementById('dial_code');
          if(sel && !sel.value){
            for(const opt of sel.options){ if(opt.value===guess){ sel.value=guess; break; } }
          }
        }
      }catch(_){}
    }
  </script>
</body>
</html>
