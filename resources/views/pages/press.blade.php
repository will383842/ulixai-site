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
    .hero{position:relative;min-height:85vh;display:flex;align-items:center;padding:120px 0 60px;background:
      radial-gradient(circle at 20% 30%, rgba(37,99,235,.12) 0%, transparent 50%),
      radial-gradient(circle at 80% 70%, rgba(168,85,247,.12) 0%, transparent 50%),
      linear-gradient(180deg,#FFFFFF 0%,#F8FAFC 100%);overflow:hidden}
    @media (min-width:640px){.hero{padding:140px 0 80px}}
    .hero::before{content:'';position:absolute;width:600px;height:600px;background:radial-gradient(circle, rgba(37,99,235,.2) 0%, transparent 70%);border-radius:50%;top:-250px;right:-150px;filter:blur(60px);animation:float 25s ease-in-out infinite;pointer-events:none}
    .hero::after{content:'';position:absolute;width:500px;height:500px;background:radial-gradient(circle, rgba(168,85,247,.15) 0%, transparent 70%);border-radius:50%;bottom:-100px;left:-100px;filter:blur(50px);animation:float 20s ease-in-out infinite reverse;pointer-events:none}
    @keyframes float{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(30px,-30px) scale(1.1)}66%{transform:translate(-20px,20px) scale(.9)}}
    @keyframes slideDown{from{opacity:0;transform:translateY(-30px)}to{opacity:1;transform:translateY(0)}}
    @keyframes pulse-glow{0%,100%{box-shadow:0 0 20px rgba(16,185,129,.3)}50%{box-shadow:0 0 40px rgba(16,185,129,.6)}}
    .hero-content{position:relative;z-index:1;text-align:center;max-width:1000px;margin:0 auto}
    .hero-badge{display:inline-flex;align-items:center;gap:12px;background:rgba(16,185,129,.15);backdrop-filter:blur(12px);border:2px solid rgba(16,185,129,.4);padding:12px 24px;border-radius:100px;font-weight:800;font-size:13px;color:var(--success);margin-bottom:24px;animation:slideDown .8s cubic-bezier(.16,1,.3,1), pulse-glow 3s ease-in-out infinite}
    .hero h1{font-size:clamp(32px,8vw,68px);line-height:1.1;font-weight:900;letter-spacing:-.03em;margin-bottom:20px;color:var(--text);animation:slideDown .8s cubic-bezier(.16,1,.3,1) .1s backwards}
    .hero-subtitle{font-size:clamp(15px,3vw,20px);color:var(--text-light);margin-bottom:36px;line-height:1.5;font-weight:600;animation:slideDown .8s cubic-bezier(.16,1,.3,1) .2s backwards;padding:0 10px}
    .hero-cta-group{display:flex;flex-direction:column;gap:12px;align-items:center;animation:slideDown .8s cubic-bezier(.16,1,.3,1) .3s backwards}
    @media (min-width:640px){.hero-cta-group{flex-direction:row;justify-content:center;gap:16px}}
    .hero-cta{display:inline-flex;align-items:center;justify-content:center;gap:12px;padding:16px 36px;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);color:#fff;font-size:15px;font-weight:800;border-radius:100px;text-decoration:none;box-shadow:0 12px 32px rgba(37,99,235,.4);transition:.3s;border:none;cursor:pointer;position:relative;overflow:hidden}
    .hero-cta:hover{transform:translateY(-2px);box-shadow:0 16px 40px rgba(37,99,235,.5)}
    .hero-cta-secondary{background:#fff;color:var(--primary);border:2px solid var(--primary);box-shadow:0 8px 24px rgba(37,99,235,.2)}
    .hero-stats{display:grid;grid-template-columns:1fr;gap:24px;margin-top:48px;padding-top:48px;border-top:2px solid var(--border);max-width:900px;margin-left:auto;margin-right:auto}
    @media (min-width:640px){.hero-stats{grid-template-columns:repeat(3,1fr);gap:32px}}
    .hero-stat{text-align:center}
    .hero-stat-number{font-size:clamp(32px,7vw,56px);font-weight:900;background:linear-gradient(135deg,var(--primary),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;display:block;margin-bottom:8px;line-height:1}
    .hero-stat-label{font-size:clamp(12px,2vw,14px);color:var(--text-light);font-weight:700}

    /* Sections - SPACING RÉDUIT */
    .section{padding:40px 0}
    @media (min-width:768px){.section{padding:50px 0}}
    @media (min-width:1024px){.section{padding:60px 0}}
    .section-header{text-align:center;max-width:800px;margin:0 auto 32px}
    @media (min-width:768px){.section-header{margin-bottom:40px}}
    .section-title{font-size:clamp(28px,6vw,44px);font-weight:900;margin-bottom:12px;color:var(--text);letter-spacing:-.03em;line-height:1.1}
    .section-subtitle{font-size:clamp(14px,2.5vw,18px);color:var(--text-light);line-height:1.5;font-weight:600}

    /* What is Ulixai - VERSION CONDENSÉE */
    .what-card{background:#fff;border:2px solid var(--border);border-radius:24px;padding:28px 24px;max-width:900px;margin:0 auto;box-shadow:0 4px 16px rgba(37,99,235,.08)}
    .what-intro{font-size:15px;line-height:1.6;color:var(--text-light);font-weight:600;margin-bottom:24px;text-align:center}
    .mission-row{display:grid;grid-template-columns:1fr;gap:16px}
    @media (min-width:768px){.mission-row{grid-template-columns:repeat(2,1fr);gap:20px}}
    .mission-box{background:linear-gradient(135deg,rgba(37,99,235,.06),rgba(168,85,247,.06));padding:20px;border-radius:16px;border:1px solid rgba(37,99,235,.15)}
    .mission-box h3{font-size:16px;font-weight:900;color:var(--text);margin-bottom:10px;display:flex;align-items:center;gap:8px}
    .mission-box ul{list-style:none;padding:0;margin:0}
    .mission-box li{padding-left:22px;margin-bottom:6px;font-size:13px;color:var(--text-light);line-height:1.5;font-weight:600;position:relative}
    .mission-box li::before{content:'✓';position:absolute;left:0;color:var(--success);font-weight:900;font-size:16px}

    /* 2 Platforms 4 Missions - VERSION COMPACTE */
    .platform-grid{display:grid;grid-template-columns:1fr;gap:20px;max-width:1000px;margin:0 auto}
    @media (min-width:768px){.platform-grid{grid-template-columns:repeat(2,1fr);gap:24px}}
    .platform-card{background:#fff;border:2px solid var(--border);border-radius:24px;padding:28px 24px;transition:.2s;position:relative;overflow:hidden}
    .platform-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(37,99,235,.15);border-color:var(--primary-light)}
    .platform-header{display:flex;align-items:center;gap:12px;margin-bottom:16px}
    .platform-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;flex-shrink:0}
    .platform-title{font-size:22px;font-weight:900;line-height:1.2}
    .platform-subtitle{font-size:13px;font-weight:700;margin-top:2px;opacity:.8}
    .platform-desc{font-size:14px;color:var(--text-light);font-weight:600;line-height:1.5;margin-bottom:16px;padding:16px;border-radius:12px}
    .mission-mini{display:flex;gap:10px;align-items:start;padding:12px;background:var(--bg-light);border-radius:10px;margin-bottom:8px;border-left:3px solid}
    .mission-mini-num{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:14px;flex-shrink:0}
    .mission-mini-text{flex:1}
    .mission-mini-text strong{display:block;font-size:13px;font-weight:900;color:var(--text);margin-bottom:2px}
    .mission-mini-text span{font-size:12px;color:var(--text-light);font-weight:600}

    /* Impact Stats - VERSION COMPACTE */
    .impact-grid{display:grid;grid-template-columns:1fr;gap:16px;max-width:900px;margin:0 auto}
    @media (min-width:768px){.impact-grid{grid-template-columns:repeat(2,1fr);gap:20px}}
    .impact-card{background:#fff;border:2px solid var(--border);border-radius:20px;padding:24px 20px}
    .impact-card-icon{font-size:36px;margin-bottom:12px;display:block}
    .impact-card-title{font-size:18px;font-weight:900;margin-bottom:12px;color:var(--text)}
    .impact-card ul{list-style:disc;margin-left:20px;font-size:13px;color:var(--text-light);font-weight:600;line-height:1.6}
    .impact-card ul li{margin-bottom:6px}

    /* Language grid */
    .lang-grid{display:grid;grid-template-columns:1fr;gap:16px;max-width:1000px;margin:0 auto}
    @media (min-width:640px){.lang-grid{grid-template-columns:repeat(2,1fr);gap:20px}}
    @media (min-width:1024px){.lang-grid{grid-template-columns:repeat(3,1fr);gap:24px}}
    .lang-card{background:#fff;border:2px solid var(--border);border-radius:20px;padding:24px 20px;transition:.2s;text-decoration:none;display:block;text-align:center}
    .lang-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(37,99,235,.15);border-color:var(--primary-light)}
    .lang-flag{font-size:56px;margin-bottom:12px;display:block}
    .lang-name{font-size:18px;font-weight:900;color:var(--text);margin-bottom:6px}
    .lang-desc{font-size:13px;color:var(--text-light);font-weight:600}

    /* Content grid */
    .content-grid{display:grid;grid-template-columns:1fr;gap:20px}
    @media (min-width:640px){.content-grid{grid-template-columns:repeat(2,1fr)}
    @media (min-width:1024px){.content-grid{grid-template-columns:repeat(4,1fr);gap:24px}}
    .content-card{background:#fff;border:2px solid var(--border);border-radius:20px;padding:20px;transition:.2s}
    .content-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(37,99,235,.15);border-color:var(--primary-light)}
    .content-preview{background:var(--bg-light);border-radius:14px;padding:16px;margin-bottom:16px;box-shadow:0 4px 12px rgba(0,0,0,.05)}
    .preview-box{position:relative;height:160px;width:100%;overflow:hidden;border-radius:10px;background:#fff}
    @media (min-width:768px){.preview-box{height:180px}}
    .content-title{font-size:16px;font-weight:900;color:var(--text);margin-bottom:6px}
    .content-desc{font-size:13px;color:var(--text-light);margin-bottom:14px;font-weight:600}
    .btn{display:block;width:100%;padding:10px 20px;border-radius:12px;font-size:13px;font-weight:800;text-align:center;transition:.2s;cursor:pointer;border:none}
    .btn-primary{background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;box-shadow:0 6px 16px rgba(37,99,235,.3)}
    .btn-primary:hover{box-shadow:0 8px 20px rgba(37,99,235,.4)}
    .btn-secondary{background:#fff;color:var(--primary);border:2px solid var(--primary)}
    .btn-secondary:hover{background:var(--bg-light)}

    /* Photos Section */
    .photos-grid{display:grid;grid-template-columns:1fr;gap:16px;max-width:1100px;margin:0 auto}@media(min-width:640px){.photos-grid{grid-template-columns:repeat(2,1fr);gap:20px}}@media(min-width:1024px){.photos-grid{grid-template-columns:repeat(3,1fr);gap:24px}}
    .photo-card{position:relative;border-radius:18px;overflow:hidden;aspect-ratio:16/10;cursor:pointer;transition:.3s;box-shadow:0 4px 16px rgba(0,0,0,.1)}@media(min-width:640px){.photo-card{border-radius:20px}}
    .photo-card:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(0,0,0,.2)}
    .photo-card img{width:100%;height:100%;object-fit:cover;transition:.3s}
    .photo-card:hover img{transform:scale(1.05)}
    .photo-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.7) 0%,transparent 60%);display:flex;align-items:flex-end;padding:16px;opacity:0;transition:.3s}@media(min-width:640px){.photo-overlay{padding:20px}}
    .photo-card:hover .photo-overlay{opacity:1}
    .photo-title{color:#fff;font-size:clamp(13px,2.5vw,16px);font-weight:800;text-shadow:0 2px 8px rgba(0,0,0,.3)}

    /* Contact CTA - VERSION COMPACTE */
    .cta-section{background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 50%,var(--accent) 100%);color:#fff;position:relative;overflow:hidden;padding:48px 0}
    @media (min-width:768px){.cta-section{padding:60px 0}}
    .cta-content{position:relative;z-index:1;text-align:center;max-width:700px;margin:0 auto}
    .cta-title{font-size:clamp(24px,6vw,40px);font-weight:900;margin-bottom:16px;letter-spacing:-.02em}
    .cta-text{font-size:clamp(14px,3vw,18px);opacity:.95;margin-bottom:32px;font-weight:600}

    /* Modals - AVEC 4 COINS ARRONDIS */
    .modal{position:fixed;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);z-index:9999;opacity:0;pointer-events:none;transition:opacity .3s;overflow-y:auto;-webkit-overflow-scrolling:touch;padding:0}
    .modal:not(.hidden){opacity:1;pointer-events:auto}
    .modal-wrapper{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:16px}
    @media(min-width:640px){.modal-wrapper{padding:24px}}
    @media(max-height:700px){.modal-wrapper{align-items:flex-start;padding-top:20px}}
    .modal-content{background:#fff;border-radius:24px;max-width:900px;width:100%;box-shadow:0 32px 80px rgba(0,0,0,.3);transform:scale(.95);transition:transform .3s;margin:auto 0}
    .modal:not(.hidden) .modal-content{transform:scale(1)}
    .modal-header{display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:2px solid var(--border)}
    .modal-title{font-size:18px;font-weight:900;color:var(--text)}
    .modal-close{width:36px;height:36px;border-radius:50%;background:var(--bg-light);border:none;display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--text-muted);cursor:pointer;transition:.2s}
    .modal-close:hover{background:var(--border)}
    .modal-body{height:60vh;min-height:400px}
    .modal-body iframe,.modal-body img{width:100%;height:100%;object-fit:contain}

    /* Contact form - MOBILE FIRST */
    .form-modal{max-width:600px;border-radius:24px}
    .form-container{padding:24px}
    @media (min-width:640px){.form-container{padding:32px}}
    .form-group{margin-bottom:12px}
    .form-label{display:block;font-weight:800;font-size:13px;margin-bottom:6px;color:var(--text)}
    .required:after{content:' *';color:#DC2626}
    .form-input{width:100%;padding:12px 14px;border:2px solid var(--border);border-radius:12px;font-size:14px;font-family:'Poppins',sans-serif;font-weight:600;transition:all .25s cubic-bezier(.4,0,.2,1);background:#fff;position:relative}
    .form-input:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 4px rgba(37,99,235,.1);transform:translateY(-1px)}
    .form-input:disabled{opacity:.6;cursor:not-allowed;background:var(--bg-light)}
    .form-hint{font-size:11px;color:var(--text-muted);margin-top:4px;font-weight:600;display:flex;align-items:center;gap:4px}
    .error-text{font-size:11px;color:#DC2626;margin-top:4px;display:none;font-weight:700;animation:shake .4s}
    .success-text{font-size:11px;color:var(--success);margin-top:4px;display:none;font-weight:700;align-items:center;gap:4px}
    .has-error .form-input{border-color:#DC2626;background:#FEF2F2}
    .has-error .error-text{display:block}
    .has-success .form-input{border-color:var(--success);background:rgba(16,185,129,.03)}
    .has-success .success-text{display:flex}
    @keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-8px)}75%{transform:translateX(8px)}}
    textarea.form-input{resize:vertical;min-height:100px}
    .form-submit{width:100%;padding:14px 24px;background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;font-weight:800;font-size:15px;border:none;border-radius:14px;cursor:pointer;transition:all .2s;box-shadow:0 8px 24px rgba(37,99,235,.3);position:relative;overflow:hidden}
    .form-submit:hover:not(:disabled){box-shadow:0 10px 28px rgba(37,99,235,.4);transform:translateY(-1px)}
    .form-submit:active:not(:disabled){transform:translateY(0);box-shadow:0 6px 20px rgba(37,99,235,.3)}
    .form-submit:disabled{cursor:not-allowed;opacity:.7}
    .form-submit::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent);transition:left .6s}
    .form-submit:hover:not(:disabled)::before{left:100%}

    /* Success popup - 4 COINS ARRONDIS */
    .success-popup{max-width:450px;text-align:center;padding:40px 28px;border-radius:24px}
    .success-icon{width:72px;height:72px;background:linear-gradient(135deg,var(--success),#34D399);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;font-size:36px}
  </style>
</head>

<body>
  @include('includes.header')
  @include('pages.popup')

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-badge">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          <span>🌍 197 Countries Worldwide</span>
        </div>

        <h1>Ulixai Press Center 📰</h1>

        <p class="hero-subtitle">
          Official press resources for the <strong>world's first truly global expat platform</strong> serving <strong>304M expats</strong> and <strong>1.6B travelers</strong> in all major languages.
        </p>

        <div class="hero-cta-group">
          <a href="#languages" class="hero-cta">
            <span>Access Press Kit</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <button type="button" onclick="openModal(event)" class="hero-cta hero-cta-secondary js-open-press-modal">
            <span>Contact Press</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </button>
        </div>

        <div class="hero-stats">
          <div class="hero-stat"><span class="hero-stat-number">304M</span><span class="hero-stat-label">Global Expats</span></div>
          <div class="hero-stat"><span class="hero-stat-number">1.6B</span><span class="hero-stat-label">Travelers</span></div>
          <div class="hero-stat"><span class="hero-stat-number">197</span><span class="hero-stat-label">Countries</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- What is Ulixai - VERSION CONDENSÉE -->
  <section class="section" style="background:var(--bg-light)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Ulixai — Connecting Expats & Travelers 🌐</h2>
        <p class="section-subtitle">The right service, in your language, wherever you are</p>
      </div>

      <div class="what-card">
        <p class="what-intro">
          Ulixai connects <strong style="color:var(--text)">expats and travelers</strong> with verified local providers and helpful expats worldwide for immediate or planned services.
        </p>

        <div class="mission-row">
          <div class="mission-box">
            <h3><span style="font-size:20px">👥</span> For Clients</h3>
            <ul>
              <li>Describe your need</li>
              <li>Receive verified quotes</li>
              <li>Choose provider & pay securely</li>
            </ul>
          </div>

          <div class="mission-box">
            <h3><span style="font-size:20px">💼</span> For Providers</h3>
            <ul>
              <li>2-min registration</li>
              <li>Receive client requests</li>
              <li>Quote, serve & earn income</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2 Platforms, 4 Missions - VERSION COMPACTE -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">2 Platforms, 4 Missions 🚀</h2>
        <p class="section-subtitle">Helping expats & creating income opportunities everywhere</p>
      </div>

      <div class="platform-grid">
        <!-- SOS-Expat -->
        <div class="platform-card">
          <div class="platform-header">
            <div class="platform-icon" style="background:linear-gradient(135deg,#DC2626,#EF4444)">🆘</div>
            <div>
              <div class="platform-title" style="color:#DC2626">SOS-Expat.com</div>
              <div class="platform-subtitle" style="color:#DC2626">24/7 Immediate Help</div>
            </div>
          </div>

          <div class="platform-desc" style="background:linear-gradient(135deg,rgba(220,38,38,.08),rgba(239,68,68,.08))">
            <strong style="color:var(--text)">In &lt;5 minutes</strong>, connect with a trusted lawyer or helper. Guaranteed call. No stress, just solutions.
          </div>

          <div class="mission-mini" style="border-color:#DC2626">
            <div class="mission-mini-num" style="background:linear-gradient(135deg,#DC2626,#EF4444)">1</div>
            <div class="mission-mini-text">
              <strong>Immediate Assistance</strong>
              <span>24/7 help for expats & travelers worldwide</span>
            </div>
          </div>

          <div class="mission-mini" style="border-color:var(--success)">
            <div class="mission-mini-num" style="background:linear-gradient(135deg,#10B981,#34D399)">2</div>
            <div class="mission-mini-text">
              <strong>Guaranteed Income</strong>
              <span>Lawyers & helpers earn from anywhere</span>
            </div>
          </div>
        </div>

        <!-- Ulixai -->
        <div class="platform-card">
          <div class="platform-header">
            <div class="platform-icon" style="background:linear-gradient(135deg,var(--primary),var(--primary-light))">🔍</div>
            <div>
              <div class="platform-title" style="color:var(--primary)">Ulixai.com</div>
              <div class="platform-subtitle" style="color:var(--primary)">Services & Offers</div>
            </div>
          </div>

          <div class="platform-desc" style="background:linear-gradient(135deg,rgba(37,99,235,.08),rgba(168,85,247,.08))">
            Verified providers, <strong style="color:var(--text)">fast quotes, simple tracking</strong>. For expats, travelers, all nationalities.
          </div>

          <div class="mission-mini" style="border-color:var(--primary)">
            <div class="mission-mini-num" style="background:linear-gradient(135deg,var(--primary),var(--primary-light))">1</div>
            <div class="mission-mini-text">
              <strong>Unlimited Services</strong>
              <span>Find providers worldwide with competitive offers</span>
            </div>
          </div>

          <div class="mission-mini" style="border-color:var(--success)">
            <div class="mission-mini-num" style="background:linear-gradient(135deg,#10B981,#34D399)">2</div>
            <div class="mission-mini-text">
              <strong>Global Income</strong>
              <span>Providers earn wherever they are</span>
            </div>
          </div>
        </div>
      </div>

      <div style="margin-top:24px;text-align:center;padding:20px;background:#fff;border-radius:20px;border:2px solid var(--border);max-width:800px;margin-left:auto;margin-right:auto">
        <h3 style="font-size:20px;font-weight:900;color:var(--text);margin-bottom:8px">🌍 Double Global Impact</h3>
        <p style="font-size:14px;color:var(--text-light);font-weight:600">We help expats <strong style="color:var(--text)">AND</strong> create income opportunities worldwide.</p>
      </div>
    </div>
  </section>

  <!-- Global Impact - VERSION COMPACTE -->
  <section class="section" style="background:var(--bg-light)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Global Impact 🌍</h2>
      </div>

      <div class="impact-grid">
        <div class="impact-card">
          <span class="impact-card-icon">🌍</span>
          <h3 class="impact-card-title">The Landscape</h3>
          <ul>
            <li><strong>304M</strong> people live abroad (UN 2023)</li>
            <li><strong>1.6B</strong> international travelers yearly</li>
            <li>Growing mobility for work, study, retirement</li>
          </ul>
        </div>

        <div class="impact-card">
          <span class="impact-card-icon">ℹ️</span>
          <h3 class="impact-card-title">About Us</h3>
          <ul>
            <li><strong>Ulixai:</strong> collaborative platform in all languages</li>
            <li><strong>SOS-Expat:</strong> 24/7 urgent assistance</li>
            <li><strong>197 countries</strong> covered worldwide</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Press Photos Section -->
  <section class="section" style="background:linear-gradient(135deg,#F8FAFC 0%,#EFF6FF 50%,#F8FAFC 100%)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Press Photos 📸</h2>
        <p class="section-subtitle">High-resolution images for your publication</p>
      </div>

      <div class="photos-grid">
        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=500&fit=crop&q=80" alt="Team collaboration at Ulixai - diverse group working together" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">🤝 Team Collaboration</span>
          </div>
        </div>

        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=500&fit=crop&q=80" alt="Global connectivity - Ulixai platform connecting expats worldwide" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">🌍 Global Connectivity</span>
          </div>
        </div>

        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&h=500&fit=crop&q=80" alt="Business meeting - Ulixai service providers and clients" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">💼 Service Providers</span>
          </div>
        </div>

        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&h=500&fit=crop&q=80" alt="Mobile app interface - Ulixai platform on smartphone" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">📱 Mobile Platform</span>
          </div>
        </div>

        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=500&fit=crop&q=80" alt="Community support - Ulixai expat helpers working together" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">🙌 Community Support</span>
          </div>
        </div>

        <div class="photo-card" onclick="viewPhoto('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1200&q=80')">
          <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&h=500&fit=crop&q=80" alt="Virtual meeting - Remote collaboration through Ulixai" loading="lazy">
          <div class="photo-overlay">
            <span class="photo-title">💻 Virtual Collaboration</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Languages Section -->
  <section id="languages" class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Press Materials by Language 🌐</h2>
        <p class="section-subtitle">Select your language to access kits & resources</p>
      </div>

      <div class="lang-grid">
        <a href="/press/en" class="lang-card">
          <div class="lang-flag" style="display:flex;justify-content:center;align-items:center;height:100px">
            <svg width="100" height="60" viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg">
              <clipPath id="s"><path d="M0,0 v30 h60 v-30 z"/></clipPath>
              <clipPath id="t"><path d="M30,15 h30 v15 z v-15 h-30 z h-30 v15 z v-15 h30 z"/></clipPath>
              <g clip-path="url(#s)">
                <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                <path d="M0,0 L60,30 M60,0 L0,30" clip-path="url(#t)" stroke="#C8102E" stroke-width="4"/>
                <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
                <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
              </g>
            </svg>
          </div>
          <h3 class="lang-name">English</h3>
          <p class="lang-desc">Press kits & guidelines</p>
        </a>

        <a href="/press/fr" class="lang-card">
          <div class="lang-flag" style="display:flex;justify-content:center;align-items:center;height:100px">
            <svg width="100" height="67" viewBox="0 0 900 600" xmlns="http://www.w3.org/2000/svg">
              <rect width="900" height="600" fill="#ED2939"/>
              <rect width="600" height="600" fill="#fff"/>
              <rect width="300" height="600" fill="#002395"/>
            </svg>
          </div>
          <h3 class="lang-name">Français</h3>
          <p class="lang-desc">Dossiers & guidelines</p>
        </a>

        <a href="/press/de" class="lang-card">
          <div class="lang-flag" style="display:flex;justify-content:center;align-items:center;height:100px">
            <svg width="100" height="60" viewBox="0 0 5 3" xmlns="http://www.w3.org/2000/svg">
              <rect width="5" height="3" fill="#000"/>
              <rect width="5" height="2" y="1" fill="#D00"/>
              <rect width="5" height="1" y="2" fill="#FFCE00"/>
            </svg>
          </div>
          <h3 class="lang-name">Deutsch</h3>
          <p class="lang-desc">Pressemappen & Richtlinien</p>
        </a>
      </div>
    </div>
  </section>

  <!-- Press Materials (only if $showContent) -->
  @if(isset($showContent) && $showContent)
  <section class="section" style="background:var(--bg-light)">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">📁 Download Materials</h2>
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
        <div style="text-align:center;padding:48px 20px">
          <div style="font-size:56px;margin-bottom:16px">📦</div>
          <p style="font-size:15px;color:var(--text-light);font-weight:700">No assets yet. Check back soon or contact press team.</p>
        </div>
      @else
        <div class="content-grid">
          <!-- Logo -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestIcon)
                  <img src="{{ route('press.asset', [$latestIcon->id, 'icon']) }}" alt="Logo" style="width:100%;height:100%;object-fit:contain">
                @else
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:48px">🗂️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Official Logo</h3>
            <p class="content-desc">PNG & SVG formats</p>
            @if($latestIcon)
              <div style="display:flex;flex-direction:column;gap:8px">
                <button onclick="viewAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}')" class="btn btn-primary">👁️ View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}', 'ulixai-logo.png')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p style="text-align:center;color:var(--text-muted);font-weight:700;font-size:12px">Coming soon</p>
            @endif
          </div>

          <!-- Press Kit -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="pdf-preview-{{ $latestPdf ? $latestPdf->id : 'none' }}">
                @if($latestPdf)
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,rgba(220,38,38,.1),rgba(239,68,68,.1));cursor:pointer"
                       onclick="loadPdfPreview('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'pdf-preview-{{ $latestPdf->id }}')">
                    <div style="text-align:center">
                      <div style="font-size:48px;margin-bottom:8px">📄</div>
                      <div style="font-size:12px;color:var(--text-muted);font-weight:700">Click preview</div>
                    </div>
                  </div>
                @else
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:48px">📄</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Press Kit</h3>
            <p class="content-desc">Complete info package</p>
            @if($latestPdf)
              <div style="display:flex;flex-direction:column;gap:8px">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestPdf->id, 'pdf']) }}')" class="btn btn-primary">👁️ View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'ulixai-press-kit.pdf')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p style="text-align:center;color:var(--text-muted);font-weight:700;font-size:12px">Coming soon</p>
            @endif
          </div>

          <!-- Guidelines -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="guide-preview-{{ $latestGuide ? $latestGuide->id : 'none' }}">
                @if($latestGuide)
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,rgba(168,85,247,.1),rgba(192,132,252,.1));cursor:pointer"
                       onclick="loadPdfPreview('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'guide-preview-{{ $latestGuide->id }}')">
                    <div style="text-align:center">
                      <div style="font-size:48px;margin-bottom:8px">📘</div>
                      <div style="font-size:12px;color:var(--text-muted);font-weight:700">Click preview</div>
                    </div>
                  </div>
                @else
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:48px">📘</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Guidelines</h3>
            <p class="content-desc">Brand standards</p>
            @if($latestGuide)
              <div style="display:flex;flex-direction:column;gap:8px">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestGuide->id, 'guideline_pdf']) }}')" class="btn btn-primary">👁️ View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'ulixai-guidelines.pdf')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p style="text-align:center;color:var(--text-muted);font-weight:700;font-size:12px">Coming soon</p>
            @endif
          </div>

          <!-- Photos -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestPhoto)
                  <img src="{{ route('press.asset', [$latestPhoto->id, 'photo']) }}" alt="Photo" style="width:100%;height:100%;object-fit:cover;border-radius:8px">
                @else
                  <div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:48px">🖼️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">HD Photos</h3>
            <p class="content-desc">High-res images</p>
            @if($latestPhoto)
              <div style="display:flex;flex-direction:column;gap:8px">
                <button onclick="viewAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}')" class="btn btn-primary">👁️ View</button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}', 'ulixai-photo.jpg')" class="btn btn-secondary">⬇️ Download</button>
              </div>
            @else
              <p style="text-align:center;color:var(--text-muted);font-weight:700;font-size:12px">Coming soon</p>
            @endif
          </div>
        </div>

        @php $releases = $pressItems->whereNotNull('pdf')->sortByDesc('created_at')->take(6); @endphp
        @if($releases->isNotEmpty())
        <div style="margin-top:48px">
          <div class="section-header" style="margin-bottom:24px">
            <h2 class="section-title">📰 Recent Releases</h2>
          </div>

          <div style="display:grid;grid-template-columns:1fr;gap:16px">
            @foreach($releases as $pr)
              <div class="content-card" style="padding:20px;display:flex;align-items:center;gap:16px">
                <div style="flex-shrink:0;width:56px;height:56px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;box-shadow:0 8px 24px rgba(37,99,235,.25)">📰</div>
                <div style="flex:1">
                  <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;flex-wrap:wrap">
                    <h4 style="font-size:16px;font-weight:900;color:var(--text);margin:0">{{ $pr->title ?: 'Press Release' }}</h4>
                    <span style="font-size:11px;font-weight:800;color:var(--primary);background:rgba(37,99,235,.1);padding:3px 10px;border-radius:100px">{{ optional($pr->created_at)->format('M Y') }}</span>
                  </div>
                  @if($pr->description)
                    <p style="font-size:13px;color:var(--text-light);font-weight:600;margin:0 0 12px 0;line-height:1.5">{{ \Illuminate\Support\Str::limit($pr->description, 140) }}</p>
                  @endif
                  @if($pr->pdf)
                    <button onclick="downloadAsset('{{ route('press.asset', [$pr->id, 'pdf']) }}', '{{ $pr->title ? \Illuminate\Support\Str::slug($pr->title) : 'release' }}.pdf')" class="btn btn-primary" style="width:auto;padding:8px 20px;display:inline-block">⬇️ Download</button>
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

  <!-- Contact CTA - VERSION COMPACTE -->
  <section class="cta-section">
    <div style="position:absolute;width:600px;height:600px;background:radial-gradient(circle,rgba(255,255,255,.1) 0%,transparent 70%);border-radius:50%;top:-200px;right:-150px;filter:blur(80px)"></div>
    <div style="position:absolute;width:500px;height:500px;background:radial-gradient(circle,rgba(255,255,255,.08) 0%,transparent 70%);border-radius:50%;bottom:-150px;left:-100px;filter:blur(70px)"></div>

    <div class="container">
      <div class="cta-content">
        <h2 class="cta-title">Need More Info? 📧</h2>
        <p class="cta-text">Our press team responds within 24 hours</p>
        <button type="button" onclick="openModal(event)" class="hero-cta hero-cta-secondary js-open-press-modal" style="background:#fff;color:var(--primary);border:0">
          <span>Contact Press Team</span>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  </section>

  <!-- PDF Modal - 4 COINS ARRONDIS -->
  <div id="pdfModal" class="modal hidden">
    <div class="modal-wrapper">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Document Preview</h3>
          <button onclick="closePdfModal()" class="modal-close" aria-label="Close">×</button>
        </div>
        <div class="modal-body">
          <iframe id="pdfModalFrame" src="" title="PDF"></iframe>
        </div>
      </div>
    </div>
  </div>

  <!-- Asset Modal -->
  <div id="assetModal" class="modal hidden" style="background:rgba(0,0,0,.9)">
    <div class="modal-wrapper">
      <div style="position:relative;max-width:90vw;max-height:90vh">
        <button onclick="closeAssetModal()" style="position:absolute;top:-50px;right:0;width:44px;height:44px;border-radius:50%;background:#fff;border:none;display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--text);cursor:pointer;box-shadow:0 8px 24px rgba(0,0,0,.3);transition:.2s;z-index:10" aria-label="Close">×</button>
        <img id="assetModalImg" style="max-width:100%;max-height:90vh;object-fit:contain;border-radius:16px;box-shadow:0 32px 80px rgba(0,0,0,.5)" src="" alt="Preview">
      </div>
    </div>
  </div>

  <!-- Contact Form Modal - 4 COINS ARRONDIS MOBILE FIRST -->
  <div id="contactModal" class="modal hidden">
    <div class="modal-wrapper">
      <div class="modal-content form-modal">
      <div class="modal-header">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;color:#fff;background:linear-gradient(135deg,var(--primary),var(--accent))">📧</div>
          <h3 class="modal-title">Press Contact</h3>
        </div>
        <button onclick="closeModal()" class="modal-close js-close-press-modal" aria-label="Close">×</button>
      </div>

      <div class="form-container">
        <div id="formGlobalErrors" class="hidden" style="margin-bottom:12px;padding:12px;border-radius:10px;border:2px solid #FCA5A5;color:#DC2626;background:#FEF2F2;font-size:12px;font-weight:700"></div>

        <form id="pressForm" onsubmit="submitForm(event)">
          @csrf

          <div style="display:grid;grid-template-columns:1fr;gap:10px">
            <div class="form-group">
              <label class="form-label required" for="media_name">Media Outlet</label>
              <input type="text" class="form-input" id="media_name" name="media_name" placeholder="Media name" required>
              <div class="form-hint">e.g. Le Monde, BBC, Die Zeit</div>
              <div class="error-text"></div>
              <div class="success-text">✓ Looks good!</div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="full_name">Your Name</label>
              <input type="text" class="form-input" id="full_name" name="full_name" placeholder="Full name" required>
              <div class="error-text"></div>
              <div class="success-text">✓ Looks good!</div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="email">Email</label>
              <input type="email" class="form-input" id="email" name="email" placeholder="name@media.com" required>
              <div class="error-text"></div>
              <div class="success-text">✓ Valid email!</div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 2fr;gap:8px">
              <div class="form-group">
                <label class="form-label required" for="dial_code">Code</label>
                <select class="form-input" name="phone_country_code" id="dial_code" required>
                  <option value="">…</option>
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
                <div class="success-text">✓</div>
              </div>
              <div class="form-group">
                <label class="form-label required" for="phone">Phone</label>
                <input type="tel" class="form-input" id="phone" name="phone" placeholder="123456789" required>
                <div class="error-text"></div>
                <div class="success-text">✓ Valid phone!</div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Website (optional)</label>
              <input type="url" class="form-input" name="website" placeholder="https://example.com">
              <div class="error-text"></div>
              <div class="success-text">✓ Valid URL!</div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="languages_spoken">Language(s)</label>
              <input type="text" class="form-input" id="languages_spoken" name="languages_spoken" placeholder="en, fr, de" required>
              <div class="error-text"></div>
              <div class="success-text">✓ Looks good!</div>
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
              <div class="success-text">✓ Selected!</div>
            </div>

            <div class="form-group">
              <label class="form-label required" for="message">Message</label>
              <textarea class="form-input" id="message" name="message" placeholder="Your inquiry" rows="4" required></textarea>
              <div class="error-text"></div>
              <div class="success-text">✓ Looks good!</div>
            </div>

            <button type="submit" class="form-submit">📨 Send Inquiry</button>
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>

  <!-- Success Popup - 4 COINS ARRONDIS -->
  <div id="thankYouModal" class="modal hidden">
    <div class="modal-wrapper">
    <div class="modal-content success-popup">
      <div class="success-icon">✅</div>
      <h3 style="font-size:22px;font-weight:900;color:var(--text);margin-bottom:8px">Message Sent!</h3>
      <p style="font-size:14px;color:var(--text-light);font-weight:600">Our team will respond within 24 hours.</p>
      <div style="margin-top:20px">
        <button onclick="document.getElementById('thankYouModal').classList.add('hidden')" class="form-submit" style="width:auto;padding:10px 20px">Close</button>
      </div>
    </div>
    </div>
  </div>

  <!-- Photo Modal -->
  <div id="photoModal" class="modal hidden" style="background:rgba(0,0,0,.95)" onclick="if(event.target===this)closePhotoModal()">
    <div class="modal-wrapper" style="padding:40px 20px">
      <button onclick="closePhotoModal()" style="position:absolute;top:20px;right:20px;width:48px;height:48px;border-radius:50%;background:#fff;border:none;font-size:28px;cursor:pointer;z-index:100;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(0,0,0,.3);transition:.2s" aria-label="Close photo" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">×</button>
      <img id="photoModalImg" style="max-width:100%;max-height:90vh;border-radius:16px;box-shadow:0 32px 80px rgba(0,0,0,.7)" src="" alt="Press photo preview" loading="lazy">
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    'use strict';

    /* ========== MODAL MANAGEMENT ========== */
    window.openModal = function(ev){
      try{ev&&ev.preventDefault&&ev.preventDefault()}catch(_){}
      try{ev&&ev.stopPropagation&&ev.stopPropagation()}catch(_){}
      const m=document.getElementById('contactModal');
      if(m){
        m.classList.remove('hidden');
        document.body.style.overflow='hidden';
        if(typeof autoGuessDialCode==='function')autoGuessDialCode();
        // Focus premier champ pour UX rapide
        setTimeout(()=>{
          const first=m.querySelector('input:not([type="hidden"])');
          if(first)first.focus();
        },100);
      }
    };
    
    window.closeModal=function(){
      const m=document.getElementById('contactModal');
      if(m){m.classList.add('hidden');document.body.style.overflow='';clearAllErrors()}
    };

    /* ========== VALIDATION EN TEMPS RÉEL ========== */
    function clearFieldError(fieldEl){
      const w=fieldEl.closest('.form-group');
      if(w){
        w.classList.remove('has-error');
        w.classList.remove('has-success');
      }
    }

    function setFieldError(fieldEl,msg){
      const w=fieldEl.closest('.form-group');
      if(!w)return;
      w.classList.remove('has-success');
      w.classList.add('has-error');
      const e=w.querySelector('.error-text');
      if(e)e.textContent=msg||'Required';
    }

    function setFieldSuccess(fieldEl){
      const w=fieldEl.closest('.form-group');
      if(!w)return;
      w.classList.remove('has-error');
      w.classList.add('has-success');
    }

    function clearAllErrors(){
      document.querySelectorAll('.has-error').forEach(el=>el.classList.remove('has-error'));
      document.querySelectorAll('.has-success').forEach(el=>el.classList.remove('has-success'));
      const box=document.getElementById('formGlobalErrors');
      if(box){box.classList.add('hidden');box.textContent=''}
    }

    function showGlobalErrors(list){
      const box=document.getElementById('formGlobalErrors');
      if(!box)return;
      box.innerHTML='<strong style="display:block;margin-bottom:6px">⚠️ Please correct:</strong><ul style="list-style:disc;margin-left:20px">'+list.map(e=>'<li>'+e+'</li>').join('')+'</ul>';
      box.classList.remove('hidden');
      // Scroll vers le haut du formulaire pour voir l'erreur
      box.scrollIntoView({behavior:'smooth',block:'nearest'});
    }

    // Validation instantanée sur blur
    function validateField(field){
      const name=field.name;
      const value=(field.value||'').trim();

      // Email validation
      if(name==='email'){
        if(!value){
          setFieldError(field,'Email is required');
          return false;
        }
        const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(value)){
          setFieldError(field,'Please enter a valid email');
          return false;
        }
        setFieldSuccess(field);
        return true;
      }

      // Phone validation
      if(name==='phone'){
        if(!value){
          setFieldError(field,'Phone number is required');
          return false;
        }
        // Au moins 6 chiffres
        const digits=value.replace(/\D/g,'');
        if(digits.length<6){
          setFieldError(field,'Phone must have at least 6 digits');
          return false;
        }
        setFieldSuccess(field);
        return true;
      }

      // Dial code validation
      if(name==='phone_country_code'){
        if(!value){
          setFieldError(field,'Country code is required');
          return false;
        }
        setFieldSuccess(field);
        return true;
      }

      // URL validation (optional field)
      if(name==='website'&&value){
        try{
          new URL(value);
          setFieldSuccess(field);
          return true;
        }catch(_){
          setFieldError(field,'Please enter a valid URL');
          return false;
        }
      }

      // Champs requis génériques
      if(field.hasAttribute('required')&&!value){
        setFieldError(field,'This field is required');
        return false;
      }

      // Si tout est bon et qu'il y a une valeur
      if(value){
        setFieldSuccess(field);
      }else{
        clearFieldError(field);
      }
      return true;
    }

    /* ========== AUTO-FORMAT TÉLÉPHONE ========== */
    function formatPhoneInput(input){
      let val=input.value.replace(/\D/g,''); // Garde que les chiffres
      // Format visuel pour France: XX XX XX XX XX
      if(val.length>2){
        val=val.match(/.{1,2}/g).join(' ');
      }
      input.value=val;
    }

    function normalizePhone(dial,phone){
      phone=(phone||'').trim().replace(/\s+/g,''); // Retire espaces
      dial=(dial||'').trim();
      if(!phone)return '';
      if(phone.startsWith('+'))return phone;
      if(dial.startsWith('+')){
        // Retire le 0 initial si présent
        phone=phone.replace(/^0+/,'');
        return dial+phone;
      }
      return phone;
    }

    /* ========== SOUMISSION FORMULAIRE ========== */
    async function submitForm(e){
      e.preventDefault();
      const form=e.target;
      clearAllErrors();

      const btn=form.querySelector('button[type="submit"]');
      const original=btn.innerHTML;
      
      // Animation bouton
      btn.disabled=true;
      btn.style.position='relative';
      btn.innerHTML='<span style="display:inline-flex;align-items:center;gap:8px"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="animation:spin 1s linear infinite"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg>Sending...</span>';

      const fd=new FormData(form);
      const dial=(fd.get('phone_country_code')||'').trim();
      const phoneRaw=(fd.get('phone')||'').trim();
      const phone=normalizePhone(dial,phoneRaw);

      // Validation finale
      const errors=[];
      let firstErrorField=null;

      const requiredFields=['media_name','full_name','email','languages_spoken','how_heard','message'];
      requiredFields.forEach(name=>{
        const el=form.querySelector(`[name="${name}"]`);
        if(el&&!String(el.value||'').trim()){
          setFieldError(el,'Required');
          if(!firstErrorField)firstErrorField=el;
          errors.push(`${el.previousElementSibling?.textContent||name} is required`);
        }
      });

      // Validation dial code
      const dialEl=form.querySelector('#dial_code');
      if(!dial){
        setFieldError(dialEl,'Required');
        if(!firstErrorField)firstErrorField=dialEl;
        errors.push('Country code is required');
      }

      // Validation téléphone
      const phoneEl=form.querySelector('#phone');
      if(!phoneRaw){
        setFieldError(phoneEl,'Required');
        if(!firstErrorField)firstErrorField=phoneEl;
        errors.push('Phone number is required');
      }else{
        const digits=phoneRaw.replace(/\D/g,'');
        if(digits.length<6){
          setFieldError(phoneEl,'At least 6 digits');
          if(!firstErrorField)firstErrorField=phoneEl;
          errors.push('Phone must have at least 6 digits');
        }
      }

      // Validation email format
      const emailEl=form.querySelector('#email');
      const emailValue=(emailEl?.value||'').trim();
      if(emailValue){
        const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(emailValue)){
          setFieldError(emailEl,'Invalid email format');
          if(!firstErrorField)firstErrorField=emailEl;
          errors.push('Please enter a valid email address');
        }
      }

      if(errors.length){
        showGlobalErrors(errors);
        btn.disabled=false;
        btn.innerHTML=original;
        // Focus sur le premier champ en erreur
        if(firstErrorField){
          firstErrorField.focus();
          firstErrorField.scrollIntoView({behavior:'smooth',block:'center'});
        }
        return;
      }

      const payload={
        media_name:(fd.get('media_name')||'').trim(),
        full_name:(fd.get('full_name')||'').trim(),
        email:emailValue,
        phone:phone,
        phone_country_code:dial,
        website:(fd.get('website')||'').trim()||null,
        languages_spoken:(fd.get('languages_spoken')||'').trim(),
        how_heard:(fd.get('how_heard')||'').trim(),
        message:(fd.get('message')||'').trim()
      };

      try{
        const csrf=document.querySelector('meta[name="csrf-token"]')?.content||'';
        const res=await fetch('/press/inquiry',{
          method:'POST',
          headers:{
            'Content-Type':'application/json',
            'Accept':'application/json',
            ...(csrf?{'X-CSRF-TOKEN':csrf}:{})
          },
          body:JSON.stringify(payload)
        });

        const data=await res.json().catch(()=>({}));

        if(!res.ok){
          const list=[];
          if(data&&data.errors){
            Object.entries(data.errors).forEach(([field,msgs])=>{
              const el=form.querySelector(`[name="${field}"]`);
              if(el){
                setFieldError(el,(msgs&&msgs[0])||'Invalid value');
                if(!firstErrorField)firstErrorField=el;
              }
              list.push(...(msgs||[]));
            });
          }
          if(!list.length)list.push(data?.message||'An error occurred. Please try again.');
          showGlobalErrors(list);
          if(firstErrorField){
            firstErrorField.focus();
            firstErrorField.scrollIntoView({behavior:'smooth',block:'center'});
          }
          return;
        }

        // Succès!
        form.reset();
        closeModal();
        const t=document.getElementById('thankYouModal');
        if(t){
          t.classList.remove('hidden');
          // Auto-close après 6 secondes
          setTimeout(()=>t.classList.add('hidden'),6000);
        }
      }catch(err){
        // Erreur réseau - feedback utilisateur uniquement
        showGlobalErrors(['Network error. Please check your connection and try again.']);
      }finally{
        btn.disabled=false;
        btn.innerHTML=original;
        btn.style.opacity='1';
      }
    }

    /* ========== ASSETS & MODALS ========== */
    function viewAsset(url){
      const m=document.getElementById('assetModal');
      const img=document.getElementById('assetModalImg');
      if(m&&img){
        img.src=url;
        m.classList.remove('hidden');
        document.body.style.overflow='hidden';
      }
    }

    function closeAssetModal(){
      const m=document.getElementById('assetModal');
      const img=document.getElementById('assetModalImg');
      if(m){
        m.classList.add('hidden');
        document.body.style.overflow='';
      }
      if(img)img.src='';
    }

    /* Photo Modal Functions */
    function viewPhoto(url){
      const m=document.getElementById('photoModal');
      const img=document.getElementById('photoModalImg');
      if(m&&img){
        img.src=url;
        m.classList.remove('hidden');
        document.body.style.overflow='hidden';
      }
    }

    function closePhotoModal(){
      const m=document.getElementById('photoModal');
      const img=document.getElementById('photoModalImg');
      if(m){
        m.classList.add('hidden');
        document.body.style.overflow='';
      }
      if(img)img.src='';
    }

    function downloadAsset(url,filename){
      const a=document.createElement('a');
      a.href=url;
      if(filename)a.setAttribute('download',filename);
      document.body.appendChild(a);
      a.click();
      a.remove();
    }

    function viewPdfModal(url){
      const m=document.getElementById('pdfModal');
      const f=document.getElementById('pdfModalFrame');
      if(m&&f){
        f.src=url;
        m.classList.remove('hidden');
        document.body.style.overflow='hidden';
      }
    }

    function closePdfModal(){
      const m=document.getElementById('pdfModal');
      const f=document.getElementById('pdfModalFrame');
      if(m){
        m.classList.add('hidden');
        document.body.style.overflow='';
      }
      if(f)f.src='';
    }

    function loadPdfPreview(url,containerId){
      const c=document.getElementById(containerId);
      if(!c)return;
      c.innerHTML='<iframe src="'+url+'" style="width:100%;height:100%;border:0"></iframe>';
    }

    /* ========== AUTO-GUESS DIAL CODE ========== */
    function autoGuessDialCode(){
      try{
        const map={
          'fr':'+33','fr-FR':'+33','fr-BE':'+32','fr-CH':'+41',
          'de':'+49','de-DE':'+49','de-AT':'+43','de-CH':'+41',
          'en':'+44','en-US':'+1','en-GB':'+44','en-CA':'+1',
          'es':'+34','es-ES':'+34','es-MX':'+52',
          'it':'+39','it-IT':'+39',
          'nl':'+31','nl-NL':'+31','nl-BE':'+32',
          'pt':'+351','pt-PT':'+351','pt-BR':'+55',
          'ar':'+971','ar-AE':'+971'
        };
        const lang=(navigator.language||'').trim();
        const guess=map[lang]||map[lang.split('-')[0]];
        if(guess){
          const sel=document.getElementById('dial_code');
          if(sel&&!sel.value){
            for(const opt of sel.options){
              if(opt.value===guess){
                sel.value=guess;
                break;
              }
            }
          }
        }
      }catch(_){}
    }

    /* ========== EVENT LISTENERS ========== */
    document.addEventListener('keydown',e=>{
      if(e.key==='Escape'){
        closeModal();
        closePdfModal();
        closeAssetModal();
        closePhotoModal();
        const t=document.getElementById('thankYouModal');
        if(t)t.classList.add('hidden');
      }
    });

    document.addEventListener('click',e=>{
      const pdfModal=document.getElementById('pdfModal');
      if(pdfModal&&!pdfModal.classList.contains('hidden')&&e.target===pdfModal)closePdfModal();
      
      const assetModal=document.getElementById('assetModal');
      if(assetModal&&!assetModal.classList.contains('hidden')&&e.target===assetModal)closeAssetModal();
      
      const contactModal=document.getElementById('contactModal');
      if(contactModal&&!contactModal.classList.contains('hidden')&&e.target===contactModal)closeModal();
      
      const thankModal=document.getElementById('thankYouModal');
      if(thankModal&&!thankModal.classList.contains('hidden')&&e.target===thankModal)thankModal.classList.add('hidden');
    });

    document.addEventListener('DOMContentLoaded',function(){
      // Boutons modals
      document.querySelectorAll('.js-open-press-modal').forEach(btn=>
        btn.addEventListener('click',window.openModal,false)
      );
      document.querySelectorAll('.js-close-press-modal').forEach(btn=>
        btn.addEventListener('click',window.closeModal,false)
      );

      // Validation en temps réel sur blur
      const form=document.getElementById('pressForm');
      if(form){
        const validatableFields=form.querySelectorAll('input[required], select[required], textarea[required]');
        validatableFields.forEach(field=>{
          field.addEventListener('blur',()=>validateField(field));
          // Clear error on input
          field.addEventListener('input',()=>clearFieldError(field));
        });

        // Auto-format téléphone
        const phoneInput=form.querySelector('#phone');
        if(phoneInput){
          phoneInput.addEventListener('input',()=>formatPhoneInput(phoneInput));
        }
      }
    });

    // Animation pulse pour le loading
    const style=document.createElement('style');
    style.textContent='@keyframes pulse{0%,100%{opacity:1}50%{opacity:.5}}@keyframes spin{to{transform:rotate(360deg)}}';
    document.head.appendChild(style);
  </script>
</body>
</html>