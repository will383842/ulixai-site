<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>SOS Emergency Help - Ulixai</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <script>document.documentElement.classList.add('js');</script>
  <style>
    :root {
      --primary: #DC2626;
      --primary-dark: #B91C1C;
      --primary-light: #F87171;
      --secondary: #2563EB;
      --secondary-dark: #1E40AF;
      --accent: #10B981;
      --warning: #F59E0B;
      --text: #0F172A;
      --text-light: #64748B;
      --text-muted: #94A3B8;
      --bg: #FFFFFF;
      --bg-light: #F8FAFC;
      --bg-alt: #F1F5F9;
      --border: #E2E8F0;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: var(--text);
      background: var(--bg);
      line-height: 1.6;
      font-size: 14px;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      text-align: center;
      padding: clamp(60px, 12vw, 120px) 20px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero h1 {
      font-size: clamp(28px, 5vw, 48px);
      font-weight: 800;
      margin-bottom: 16px;
      position: relative;
      z-index: 1;
    }

    .hero p {
      font-size: clamp(15px, 2.5vw, 18px);
      font-weight: 500;
      opacity: 0.95;
      max-width: 600px;
      margin: 0 auto 8px;
      position: relative;
      z-index: 1;
    }

    /* Share Bar */
    .share-bar {
      max-width: 1100px;
      margin: 0 auto;
      padding: clamp(20px, 4vw, 40px) 20px;
    }

    .share-card {
      background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
      border-radius: 16px;
      padding: 16px 24px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px;
      box-shadow: 0 4px 20px rgba(37, 99, 235, 0.2);
    }

    .share-card .check-icon {
      width: 24px;
      height: 24px;
      flex-shrink: 0;
    }

    .share-card .text {
      flex: 1;
      min-width: 200px;
    }

    .share-card .text p {
      color: white;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .share-card .text span {
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
    }

    .share-icons {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .share-icons a,
    .share-icons button {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .share-icons a:hover,
    .share-icons button:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    .share-icons img {
      width: 20px;
      height: 20px;
      filter: invert(1);
    }

    .copy-link-btn {
      padding: 10px 16px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .copy-link-btn:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    /* Reach Section */
    .reach-section {
      background: var(--bg-light);
      padding: clamp(40px, 8vw, 80px) 20px;
      text-align: center;
    }

    .reach-section h2 {
      font-size: clamp(22px, 4vw, 32px);
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 24px;
    }

    .warning-badge {
      display: inline-block;
      background: #FEF3C7;
      border: 1px solid #FDE68A;
      color: #92400E;
      font-size: 14px;
      padding: 12px 24px;
      border-radius: 12px;
      margin-bottom: 40px;
    }

    .reach-grid {
      max-width: 700px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .reach-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .reach-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    }

    .reach-card .emoji {
      font-size: 40px;
      margin-bottom: 16px;
    }

    .reach-card h3 {
      font-size: clamp(18px, 2.5vw, 22px);
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 8px;
    }

    .reach-card p {
      font-size: 14px;
      color: var(--text-light);
    }

    /* Signup Cards Section */
    .signup-section {
      background: var(--bg);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .signup-grid {
      max-width: 900px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 24px;
    }

    .signup-card {
      border-radius: 20px;
      padding: clamp(24px, 4vw, 40px);
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }

    .signup-card.lawyer {
      background: #FEF2F2;
      border: 1px solid #FECACA;
    }

    .signup-card.expat {
      background: #EFF6FF;
      border: 1px solid #BFDBFE;
    }

    .signup-card .emoji {
      font-size: 32px;
      margin-bottom: 12px;
    }

    .signup-card h3 {
      font-size: clamp(16px, 2.5vw, 20px);
      font-weight: 700;
      margin-bottom: 8px;
    }

    .signup-card.lawyer h3 { color: var(--primary); }
    .signup-card.expat h3 { color: var(--secondary); }

    .signup-card .subtitle {
      font-size: 15px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 12px;
    }

    .signup-card p {
      font-size: 14px;
      color: var(--text-light);
      margin-bottom: 8px;
    }

    .signup-card .highlight {
      font-weight: 600;
      margin: 12px 0;
    }

    .signup-card.lawyer .highlight { color: var(--primary); }
    .signup-card.expat .highlight { color: var(--secondary); }

    .signup-card .note {
      font-size: 13px;
      color: #EC4899;
      margin-bottom: 20px;
    }

    .signup-btn {
      padding: 14px 28px;
      border: none;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .signup-btn.red {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
    }

    .signup-btn.red:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
    }

    /* Expert Cards Section */
    .experts-section {
      background: var(--bg-alt);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .experts-grid {
      max-width: 1100px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 24px;
    }

    .expert-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease;
    }

    .expert-card:hover {
      transform: translateY(-4px);
    }

    .expert-card .image {
      position: relative;
      height: 140px;
    }

    .expert-card .image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .expert-card .badge {
      position: absolute;
      font-size: 11px;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 20px;
    }

    .expert-card .badge.lang {
      top: 8px;
      left: 8px;
      background: #FCE7F3;
      color: #9D174D;
    }

    .expert-card .badge.lang.green {
      background: #D1FAE5;
      color: #065F46;
    }

    .expert-card .badge.type {
      bottom: 8px;
      right: 8px;
      color: white;
    }

    .expert-card .badge.type.lawyer { background: var(--primary); }
    .expert-card .badge.type.expat { background: #059669; }

    .expert-card .badge.online {
      top: 8px;
      right: 8px;
      background: #059669;
      color: white;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .expert-card .badge.online::before {
      content: '';
      width: 6px;
      height: 6px;
      background: #34D399;
      border-radius: 50%;
    }

    .expert-card .content {
      padding: 16px;
    }

    .expert-card .name {
      font-size: 16px;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 4px;
    }

    .expert-card .country {
      font-size: 12px;
      color: var(--text-light);
      margin-bottom: 8px;
    }

    .expert-card .rating {
      font-size: 12px;
      color: var(--text);
      margin-bottom: 12px;
    }

    .expert-card .rating .star {
      color: #F59E0B;
    }

    .expert-card .tags {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .expert-card .tag {
      font-size: 11px;
      padding: 4px 10px;
      background: var(--bg-alt);
      color: var(--text-light);
      border-radius: 20px;
    }

    /* Emergencies Section */
    .emergencies-section {
      background: var(--bg-light);
      padding: clamp(40px, 8vw, 80px) 20px;
    }

    .emergencies-content {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

    .emergencies-content h2 {
      font-size: clamp(22px, 4vw, 32px);
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 40px;
      line-height: 1.4;
    }

    .emergencies-list {
      list-style: none;
      text-align: left;
      max-width: 500px;
      margin: 0 auto;
    }

    .emergencies-list li {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0;
      font-size: 15px;
      color: var(--text);
      border-bottom: 1px solid var(--border);
    }

    .emergencies-list li:last-child {
      border-bottom: none;
    }

    /* Call Section */
    .call-section {
      background: var(--bg);
      padding: clamp(40px, 8vw, 80px) 20px;
      text-align: center;
    }

    .call-section h2 {
      font-size: clamp(22px, 4vw, 32px);
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 24px;
    }

    .call-btn {
      padding: 16px 32px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 15px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
    }

    .call-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
    }

    /* Popups */
    .popup-modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 50;
      align-items: center;
      justify-content: center;
      padding: 20px;
      overflow-y: auto;
    }

    .popup-modal.is-open {
      display: flex;
    }

    .popup-content {
      background: white;
      border-radius: 20px;
      padding: clamp(20px, 4vw, 32px);
      max-width: 500px;
      width: 100%;
      text-align: center;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .popup-content h2 {
      font-size: clamp(18px, 3vw, 24px);
      font-weight: 700;
      color: var(--text);
      margin-bottom: 16px;
    }

    .popup-content p {
      font-size: 15px;
      color: var(--text-light);
      margin-bottom: 24px;
    }

    .popup-close {
      padding: 12px 24px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .popup-close:hover {
      background: var(--primary-dark);
    }

    /* Form Popups */
    .form-popup {
      max-width: 550px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .form-popup .close-btn {
      position: absolute;
      top: 16px;
      right: 16px;
      width: 32px;
      height: 32px;
      background: var(--bg-alt);
      border: none;
      border-radius: 50%;
      font-size: 20px;
      color: var(--text-light);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .form-popup .close-btn:hover {
      background: var(--border);
      color: var(--text);
    }

    .form-popup form {
      text-align: left;
    }

    .form-popup .form-header {
      text-align: center;
      margin-bottom: 24px;
    }

    .form-popup .form-header h2 {
      font-size: clamp(18px, 3vw, 22px);
      font-weight: 700;
      margin-bottom: 8px;
    }

    .form-popup .form-header.lawyer h2 { color: var(--primary); }
    .form-popup .form-header.expat h2 { color: var(--secondary); }

    .form-popup .form-header p {
      font-size: 13px;
      color: var(--text-light);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 16px;
    }

    @media (max-width: 480px) {
      .form-row {
        grid-template-columns: 1fr;
      }
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group.full {
      grid-column: 1 / -1;
    }

    .form-group label {
      font-size: 12px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 6px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 10px 12px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 13px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--secondary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 80px;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px solid var(--border);
    }

    .form-actions .cancel-btn {
      padding: 10px 20px;
      background: var(--bg-alt);
      color: var(--text);
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .form-actions .cancel-btn:hover {
      background: var(--border);
    }

    .form-actions .submit-btn {
      padding: 10px 20px;
      border: none;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .form-actions .submit-btn.red {
      background: var(--primary);
      color: white;
    }

    .form-actions .submit-btn.green {
      background: var(--accent);
      color: white;
    }

    .form-actions .submit-btn:hover {
      transform: translateY(-2px);
    }

    /* Confirmation Popup */
    .confirm-popup {
      background: linear-gradient(180deg, white 0%, #FEF2F2 100%);
    }

    .confirm-popup h2 {
      color: var(--primary);
    }
  </style>
</head>
<body>
@include('includes.header')
@include('wizards.requester.steps.popup_request_help')

<!-- Hero Section -->
<section class="hero">
  <h1>SOS Emergency Help</h1>
  <p>Talk to a trusted expert in under 5 minutes.</p>
  <p>Legal, medical, real estate, or personal help - we're here when it matters most.</p>
</section>

<!-- Share Bar -->
<div class="share-bar">
  <div class="share-card">
    <svg class="check-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
      <path d="M16 9l-5 5-3-3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="text">
      <p>Share this page & earn rewards in $/</p>
      <span>(if you are logged in)</span>
      @auth
      <span style="display: block; margin-top: 4px;">{{ Auth::user()->affiliate_code }}</span>
      @endauth
    </div>
    <div class="share-icons">
      <a href="#"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" alt="Facebook"></a>
      <a href="#"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" alt="Instagram"></a>
      <a href="#"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/tiktok.svg" alt="TikTok"></a>
      <a href="#"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/youtube.svg" alt="YouTube"></a>
      <a href="#"><img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/twitter.svg" alt="Twitter"></a>
      <button id="copyLinkBtn" class="copy-link-btn">Copy Link</button>
    </div>
    @auth
    <input type="hidden" id="affiliateLink" value="{{ url('/signup?code=' . Auth::user()->affiliate_code) }}">
    @endauth
  </div>
</div>

<!-- Reach Section -->
<section class="reach-section">
  <h2>Who Can You Reach?</h2>
  <div class="warning-badge">These services will be available soon. Stay tuned.</div>
  <div class="reach-grid">
    <div class="reach-card">
      <div class="emoji">👨‍⚖️</div>
      <h3>Lawyer</h3>
      <p>Legal assistance for emergencies abroad</p>
    </div>
    <div class="reach-card">
      <div class="emoji">🌍</div>
      <h3>Expat Support</h3>
      <p>General help & local orientation</p>
    </div>
  </div>
</section>

<!-- Signup Section -->
<section class="signup-section">
  <div class="signup-grid">
    <div class="signup-card lawyer">
      <div class="emoji">🧑‍⚖️</div>
      <h3>Are you a lawyer?</h3>
      <div class="subtitle">Join SOS Urgence</div>
      <p>Offer <strong>20-minute calls</strong> whenever and wherever you want, in the language and country of your choice.</p>
      <p>Activate or deactivate your availability in <strong>1 click</strong>.</p>
      <div class="highlight">Paid mission.</div>
      <div class="note">Our travelers will thank you</div>
      <button class="signup-btn red" onclick="openLawyerSignupPopup(event)">Sign up as a lawyer</button>
    </div>
    <div class="signup-card expat">
      <div class="emoji">🌍</div>
      <h3>Are you an expat? Help other travelers!</h3>
      <div class="subtitle">By joining SOS Urgence,</div>
      <p>you can take <strong>30-minute calls</strong> to help people who need it, instantly.</p>
      <p>Choose your language, your country, your availability. Turn your status on or off in just 1 click.</p>
      <div class="highlight">Every call is paid.</div>
      <div class="note">Expats around the world will thank you</div>
      <button class="signup-btn red" onclick="openExpatSignupPopup(event)">I'm signing up to help by phone</button>
    </div>
  </div>
</section>

<!-- Expert Cards Section -->
<section class="experts-section">
  <div class="experts-grid">
    <div class="expert-card">
      <div class="image">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elisa">
        <span class="badge lang">Francais</span>
        <span class="badge type lawyer">Lawyer</span>
      </div>
      <div class="content">
        <div class="name">Elisa</div>
        <div class="country">Country service: <strong>Thailande</strong></div>
        <div class="rating"><span class="star">*</span> 4.91 (366 avis)</div>
        <div class="tags">
          <span class="tag">Super pro</span>
          <span class="tag">Top</span>
          <span class="tag">Sympa</span>
        </div>
      </div>
    </div>
    <div class="expert-card">
      <div class="image">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Thomas">
        <span class="badge lang green">Japanese</span>
        <span class="badge online">Online</span>
        <span class="badge type expat">Expatriate</span>
      </div>
      <div class="content">
        <div class="name">Thomas</div>
        <div class="country">Country service: <strong>Japan</strong></div>
        <div class="rating"><span class="star">*</span> 4.87 (142 avis)</div>
        <div class="tags">
          <span class="tag">Super pro</span>
          <span class="tag">Top</span>
        </div>
      </div>
    </div>
    <div class="expert-card">
      <div class="image">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Sophie">
        <span class="badge lang">Francais</span>
        <span class="badge type lawyer">Lawyer</span>
      </div>
      <div class="content">
        <div class="name">Sophie</div>
        <div class="country">Country service: <strong>Vietnam</strong></div>
        <div class="rating"><span class="star">*</span> 4.95 (289 avis)</div>
        <div class="tags">
          <span class="tag">Expert</span>
          <span class="tag">Sympa</span>
        </div>
      </div>
    </div>
    <div class="expert-card">
      <div class="image">
        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Marco">
        <span class="badge lang green">English</span>
        <span class="badge online">Online</span>
        <span class="badge type expat">Expatriate</span>
      </div>
      <div class="content">
        <div class="name">Marco</div>
        <div class="country">Country service: <strong>Spain</strong></div>
        <div class="rating"><span class="star">*</span> 4.82 (98 avis)</div>
        <div class="tags">
          <span class="tag">Helpful</span>
          <span class="tag">Fast</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Emergencies Section -->
<section class="emergencies-section">
  <div class="emergencies-content">
    <h2>Examples of common emergency situations<br>Whatever your need, be connected to the phone in seconds.</h2>
    <ul class="emergencies-list">
      <li>Border or airport issue</li>
      <li>Rental dispute or blocked deposit</li>
      <li>Filing a local complaint</li>
      <li>Unpaid salary or sudden job loss</li>
      <li>Injuries or accidents abroad</li>
    </ul>
  </div>
</section>

<!-- Call Section -->
<section class="call-section">
  <h2>Your Emergency Call</h2>
  <button class="call-btn" onclick="showComingSoonPopup(event)">Call a Professional (Coming Soon)</button>
</section>

<!-- Coming Soon Popup -->
<div id="sos-popup" class="popup-modal">
  <div class="popup-content">
    <h2>Coming Soon</h2>
    <p>Service available in the coming weeks.</p>
    <button class="popup-close" onclick="closeComingSoonPopup()">Close</button>
  </div>
</div>

<!-- Lawyer Signup Popup -->
<div id="lawyer-signup-popup" class="popup-modal">
  <div class="popup-content form-popup" style="position: relative; text-align: left;">
    <button type="button" class="close-btn" onclick="closeLawyerSignupPopup()">&times;</button>
    <form id="lawyer-signup-form" onsubmit="submitLawyerSignup(event)" enctype="multipart/form-data">
      @csrf
      <div class="form-header lawyer">
        <h2>Join Ulixai SOS - Lawyer Registration</h2>
        <p>Fill out this form to be available on-demand for 20-minute legal calls.</p>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <input name="first_name" type="text" required placeholder="Your first name" value="{{ Auth::check() ? Auth::user()->name : '' }}">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input name="last_name" type="text" required placeholder="Your last name">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Date of Birth</label>
          <input name="dob" type="date" required>
        </div>
        <div class="form-group">
          <label>Country of Origin</label>
          <select name="country_origin" required>
            <option value="">Select your country</option>
            <option value="USA">United States</option>
            <option value="Canada">Canada</option>
            <option value="UK">United Kingdom</option>
            <option value="Australia">Australia</option>
            <option value="Germany">Germany</option>
            <option value="France">France</option>
            <option value="India">India</option>
            <option value="Japan">Japan</option>
            <option value="Brazil">Brazil</option>
            <option value="Mexico">Mexico</option>
            <option value="Italy">Italy</option>
            <option value="Spain">Spain</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Phone Number</label>
          <input name="phone_number" type="text" required placeholder="Your phone number">
        </div>
        <div class="form-group">
          <label>WhatsApp Number (required)</label>
          <input name="whats_app" type="text" required placeholder="Your WhatsApp number">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Professional Email</label>
          <input name="email" type="email" required placeholder="example@yourfirm.com">
        </div>
        <div class="form-group">
          <label>Bar Association Name</label>
          <input name="assosiate_name" type="text" required placeholder="e.g. Paris Bar">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>License / Registration Number</label>
          <input name="reg_number" type="text" required placeholder="Official bar number">
        </div>
        <div class="form-group">
          <label>Upload Your Bar Card / License</label>
          <input name="bar_card" type="file" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Countries Where You Practice</label>
          <select name="country_practice" multiple>
            <option>France</option>
            <option>USA</option>
            <option>Canada</option>
            <option>Morocco</option>
            <option>UK</option>
            <option>Germany</option>
          </select>
        </div>
        <div class="form-group">
          <label>Legal Practice Areas</label>
          <select name="legal_area" multiple>
            <option>Family Law</option>
            <option>Corporate Law</option>
            <option>Immigration</option>
            <option>Tax Law</option>
            <option>Criminal Law</option>
            <option>Real Estate</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Years of Experience</label>
          <input name="experience" type="number" required placeholder="e.g. 5">
        </div>
        <div class="form-group">
          <label>Personal Website or LinkedIn</label>
          <input name="website" type="url" placeholder="https://yourlink.com">
        </div>
      </div>
      <div class="form-group full">
        <label>Short Biography</label>
        <textarea name="bio" required placeholder="Tell us briefly about your background, and why you want to help."></textarea>
      </div>
      <div class="form-actions">
        <button type="button" class="cancel-btn" onclick="closeLawyerSignupPopup()">Cancel</button>
        <button type="submit" class="submit-btn red">Finish Registration</button>
      </div>
    </form>
  </div>
</div>

<!-- Lawyer Confirmation Popup -->
<div id="lawyer-confirm-popup" class="popup-modal">
  <div class="popup-content confirm-popup">
    <h2>Thank you for registering with Ulixai SOS</h2>
    <p>You should have received a confirmation email with your login credentials. You can now access your personal dashboard to manage your account and respond to requests.</p>
    <button class="popup-close" onclick="closeLawyerConfirmPopup()">Close</button>
  </div>
</div>

<!-- Expat Signup Popup -->
<div id="expat-signup-popup" class="popup-modal">
  <div class="popup-content form-popup" style="position: relative; text-align: left;">
    <button type="button" class="close-btn" onclick="closeExpatSignupPopup()">&times;</button>
    <form id="expat-signup-form" onsubmit="submitExpatSignup(event)">
      @csrf
      <div class="form-header expat">
        <h2>Join SOS Urgence - Expatriate Helper</h2>
        <p>Sign up to receive 30-minute calls and assist other travelers or expatriates around the world. Paid missions, availability toggled in 1 click.</p>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" required placeholder="Your first name">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" required placeholder="Your last name">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Date of Birth</label>
          <input type="date" required>
        </div>
        <div class="form-group">
          <label>Country of Origin</label>
          <select required>
            <option value="">Select your country</option>
            <option>USA</option>
            <option>Canada</option>
            <option>UK</option>
            <option>Australia</option>
            <option>Germany</option>
            <option>France</option>
            <option>India</option>
            <option>Japan</option>
            <option>Brazil</option>
            <option>Mexico</option>
            <option>Italy</option>
            <option>Spain</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Current Country of Residence</label>
          <select required>
            <option value="">Select where you live</option>
            <option>USA</option>
            <option>Canada</option>
            <option>UK</option>
            <option>Australia</option>
            <option>Germany</option>
            <option>France</option>
            <option>India</option>
            <option>Japan</option>
            <option>Brazil</option>
            <option>Mexico</option>
            <option>Italy</option>
            <option>Spain</option>
          </select>
        </div>
        <div class="form-group">
          <label>Languages You Can Help In</label>
          <select multiple required>
            <option>English</option>
            <option>French</option>
            <option>Spanish</option>
            <option>Portuguese</option>
            <option>German</option>
            <option>Italian</option>
            <option>Arabic</option>
            <option>Russian</option>
            <option>Chinese</option>
            <option>Japanese</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>WhatsApp Number (required)</label>
          <input type="text" required placeholder="Your WhatsApp number">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" required placeholder="you@example.com">
        </div>
      </div>
      <div class="form-group full">
        <label>Short Bio</label>
        <textarea required placeholder="I'm an expat based in Thailand. I love helping newcomers settle and find their way..."></textarea>
      </div>
      <div class="form-group full">
        <label>LinkedIn or Website (optional)</label>
        <input type="url" placeholder="https://yourprofile.com">
      </div>
      <div class="form-actions">
        <button type="button" class="cancel-btn" onclick="closeExpatSignupPopup()">Cancel</button>
        <button type="submit" class="submit-btn green">Complete My Registration</button>
      </div>
    </form>
  </div>
</div>

<!-- Expat Confirmation Popup -->
<div id="expat-confirm-popup" class="popup-modal">
  <div class="popup-content confirm-popup">
    <h2>Thank you for registering with Ulixai SOS</h2>
    <p>You should have received a confirmation email with your login credentials. You can now access your personal dashboard to manage your account and respond to requests.</p>
    <button class="popup-close" onclick="closeExpatConfirmPopup()">Close</button>
  </div>
</div>

@include('includes.footer')

<script>
function showComingSoonPopup(e) {
  if (e) e.preventDefault();
  document.getElementById('sos-popup').style.display = 'flex';
}

function closeComingSoonPopup() {
  document.getElementById('sos-popup').style.display = 'none';
}

function openLawyerSignupPopup(e) {
  if (e) e.preventDefault();
  document.getElementById('lawyer-signup-popup').style.display = 'flex';
}

function closeLawyerSignupPopup() {
  document.getElementById('lawyer-signup-popup').style.display = 'none';
}

function submitLawyerSignup(e) {
  e.preventDefault();
  closeLawyerSignupPopup();
  document.getElementById('lawyer-confirm-popup').style.display = 'flex';
}

function closeLawyerConfirmPopup() {
  document.getElementById('lawyer-confirm-popup').style.display = 'none';
}

function openExpatSignupPopup(e) {
  if (e) e.preventDefault();
  document.getElementById('expat-signup-popup').style.display = 'flex';
}

function closeExpatSignupPopup() {
  document.getElementById('expat-signup-popup').style.display = 'none';
}

function submitExpatSignup(e) {
  e.preventDefault();
  closeExpatSignupPopup();
  document.getElementById('expat-confirm-popup').style.display = 'flex';
}

function closeExpatConfirmPopup() {
  document.getElementById('expat-confirm-popup').style.display = 'none';
}

// Copy link functionality
document.addEventListener('DOMContentLoaded', function() {
  var copyBtn = document.getElementById('copyLinkBtn');
  var affiliateLink = document.getElementById('affiliateLink');

  if (copyBtn && affiliateLink) {
    copyBtn.addEventListener('click', function() {
      navigator.clipboard.writeText(affiliateLink.value).then(function() {
        toastr.success('Affiliate link copied to clipboard!');
      }).catch(function() {
        toastr.error('Failed to copy link!');
      });
    });
  }
});
</script>
</body>
</html>
