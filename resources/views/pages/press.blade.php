<!DOCTYPE html>
<html lang="{{ $locale ?? 'en' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Ulixai Press & Media Center | International Platform Serving 195+ Countries 🌍</title>
  <meta name="description" content="Official Ulixai press resources for journalists worldwide. Download press kits, brand guidelines, HD photos in 9 languages. The only international platform connecting 304M expats across 195+ countries.">
  <meta name="keywords" content="ulixai press, media kit, press release, brand guidelines, expat platform, international startup, global marketplace, 195 countries, multilingual platform, press resources">
  <meta name="author" content="Ulixai - Press Relations Team">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  
  <link rel="canonical" href="https://ulixai.com/press/{{ $locale ?? 'en' }}" />
  <link rel="alternate" hreflang="en" href="https://ulixai.com/press/en" />
  <link rel="alternate" hreflang="fr" href="https://ulixai.com/press/fr" />
  <link rel="alternate" hreflang="de" href="https://ulixai.com/press/de" />
  <link rel="alternate" hreflang="es" href="https://ulixai.com/press/es" />
  <link rel="alternate" hreflang="pt" href="https://ulixai.com/press/pt" />
  <link rel="alternate" hreflang="ar" href="https://ulixai.com/press/ar" />
  <link rel="alternate" hreflang="ru" href="https://ulixai.com/press/ru" />
  <link rel="alternate" hreflang="zh" href="https://ulixai.com/press/zh" />
  <link rel="alternate" hreflang="hi" href="https://ulixai.com/press/hi" />
  <link rel="alternate" hreflang="x-default" href="https://ulixai.com/press/en" />
  
  <meta name="theme-color" content="#2563EB">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Ulixai Press Center - Global Expat Platform 🌍">
  <meta property="og:description" content="Access press materials for the only international platform serving expats in 195+ countries. Available in 9 languages.">
  <meta property="og:image" content="https://ulixai.com/images/press-og.jpg">
  <meta property="og:url" content="https://ulixai.com/press/{{ $locale ?? 'en' }}">
  
  <link rel="icon" type="image/png" sizes="64x64" href="/images/faviccon.png" />
  <script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    :root {
      --primary: #2563EB;
      --primary-light: #60A5FA;
      --primary-dark: #1E40AF;
      --accent: #A855F7;
      --success: #10B981;
      --warning: #F59E0B;
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
      line-height: 1.5;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      overflow-x: hidden;
      font-size: 14px;
    }
    
    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 20px;
    }
    
    @media (min-width: 640px) {
      .container { padding: 0 24px; }
    }

    /* Hero Section with Dynamic Animations */
    .hero {
      position: relative;
      min-height: 90vh;
      display: flex;
      align-items: center;
      padding: 140px 0 100px;
      background: 
        radial-gradient(circle at 20% 30%, rgba(37, 99, 235, 0.12) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.12) 0%, transparent 50%),
        linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
      overflow: hidden;
    }
    
    @media (min-width: 640px) {
      .hero {
        padding: 160px 0 120px;
      }
    }
    
    .hero::before {
      content: '';
      position: absolute;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.2) 0%, transparent 70%);
      border-radius: 50%;
      top: -250px;
      right: -150px;
      filter: blur(60px);
      animation: float 25s ease-in-out infinite;
      pointer-events: none;
      will-change: transform;
    }
    
    .hero::after {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(168, 85, 247, 0.15) 0%, transparent 70%);
      border-radius: 50%;
      bottom: -100px;
      left: -100px;
      filter: blur(50px);
      animation: float 20s ease-in-out infinite reverse;
      pointer-events: none;
      will-change: transform;
    }
    
    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(30px, -30px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse-glow {
      0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
      50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); }
    }
    
    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
      max-width: 1100px;
      margin: 0 auto;
    }
    
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      background: rgba(16, 185, 129, 0.15);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 2px solid rgba(16, 185, 129, 0.4);
      padding: 12px 24px;
      border-radius: 100px;
      font-weight: 800;
      font-size: 14px;
      color: var(--success);
      margin-bottom: 32px;
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1), pulse-glow 3s ease-in-out infinite;
    }
    
    @media (min-width: 640px) {
      .hero-badge {
        padding: 14px 28px;
        font-size: 15px;
        gap: 14px;
      }
    }
    
    .hero h1 {
      font-size: clamp(36px, 9vw, 80px);
      line-height: 1.1;
      font-weight: 900;
      letter-spacing: -0.03em;
      margin-bottom: 28px;
      color: var(--text);
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.1s backwards;
    }
    
    .hero-subtitle {
      font-size: clamp(16px, 3.5vw, 24px);
      color: var(--text-light);
      margin-bottom: 48px;
      line-height: 1.6;
      font-weight: 600;
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards;
      padding: 0 10px;
    }
    
    @media (min-width: 640px) {
      .hero-subtitle {
        margin-bottom: 56px;
        padding: 0;
      }
    }
    
    .hero-subtitle strong {
      color: var(--text);
      font-weight: 800;
      background: linear-gradient(120deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-cta-group {
      display: flex;
      flex-direction: column;
      gap: 16px;
      align-items: center;
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s backwards;
    }

    @media (min-width: 640px) {
      .hero-cta-group {
        flex-direction: row;
        justify-content: center;
        gap: 20px;
      }
    }
    
    .hero-cta {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
      padding: 20px 44px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      color: white;
      font-size: 17px;
      font-weight: 800;
      border-radius: 100px;
      text-decoration: none;
      box-shadow: 0 12px 32px rgba(37, 99, 235, 0.4);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      border: none;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      touch-action: manipulation;
      -webkit-tap-highlight-color: transparent;
    }
    
    @media (min-width: 640px) {
      .hero-cta {
        padding: 22px 56px;
        font-size: 18px;
        gap: 16px;
      }
    }
    
    .hero-cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent) 100%);
      opacity: 0;
      transition: opacity 0.4s;
    }
    
    .hero-cta:hover::before {
      opacity: 1;
    }
    
    .hero-cta:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 48px rgba(37, 99, 235, 0.5);
    }
    
    .hero-cta span {
      position: relative;
      z-index: 1;
    }

    .hero-cta-secondary {
      background: white;
      color: var(--primary);
      border: 2px solid var(--primary);
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.15);
    }

    .hero-cta-secondary:hover {
      background: var(--primary);
      color: white;
    }
    
    .hero-stats {
      display: grid;
      grid-template-columns: 1fr;
      gap: 40px;
      margin-top: 80px;
      padding-top: 80px;
      border-top: 2px solid var(--border);
      animation: slideDown 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s backwards;
      max-width: 1000px;
      margin-left: auto;
      margin-right: auto;
    }
    
    @media (min-width: 640px) {
      .hero-stats {
        grid-template-columns: repeat(3, 1fr);
        gap: 48px;
      }
    }
    
    .hero-stat {
      text-align: center;
    }
    
    .hero-stat-number {
      font-size: clamp(40px, 8vw, 72px);
      font-weight: 900;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: block;
      margin-bottom: 12px;
      line-height: 1;
      letter-spacing: -0.03em;
    }
    
    .hero-stat-label {
      font-size: 15px;
      color: var(--text-muted);
      font-weight: 700;
      letter-spacing: -0.01em;
    }
    
    @media (min-width: 640px) {
      .hero-stat-label {
        font-size: 17px;
      }
    }

    /* Section Styles */
    .section {
      padding: 80px 0;
    }
    
    @media (min-width: 768px) {
      .section {
        padding: 100px 0;
      }
    }
    
    @media (min-width: 1024px) {
      .section {
        padding: 120px 0;
      }
    }
    
    .section-header {
      text-align: center;
      max-width: 900px;
      margin: 0 auto 60px;
    }
    
    @media (min-width: 768px) {
      .section-header {
        margin-bottom: 80px;
      }
    }
    
    .section-title {
      font-size: clamp(32px, 7vw, 56px);
      font-weight: 900;
      margin-bottom: 16px;
      color: var(--text);
      letter-spacing: -0.03em;
      line-height: 1.1;
    }
    
    .section-subtitle {
      font-size: clamp(16px, 2.8vw, 24px);
      color: var(--text-light);
      line-height: 1.6;
      font-weight: 600;
    }

    /* Language Grid with Dynamic Hover Effects */
    .lang-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    @media (min-width: 640px) {
      .lang-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
      }
    }

    @media (min-width: 1024px) {
      .lang-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
      }
    }

    .lang-card {
      background: white;
      border: 2px solid var(--border);
      border-radius: 24px;
      padding: 32px 28px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
      text-decoration: none;
      display: block;
    }

    @media (min-width: 768px) {
      .lang-card {
        padding: 36px 32px;
        border-radius: 28px;
      }
    }

    .lang-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
      opacity: 0;
      transition: opacity 0.4s;
    }

    .lang-card:hover::before {
      opacity: 1;
    }

    .lang-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 24px 60px rgba(37, 99, 235, 0.18);
      border-color: var(--primary-light);
    }

    .lang-flag {
      font-size: 56px;
      margin-bottom: 20px;
      display: block;
      transition: transform 0.3s;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .lang-flag {
        font-size: 64px;
        margin-bottom: 24px;
      }
    }

    .lang-card:hover .lang-flag {
      transform: scale(1.15) rotate(-5deg);
    }

    .lang-name {
      font-size: 22px;
      font-weight: 900;
      color: var(--text);
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .lang-name {
        font-size: 24px;
        margin-bottom: 12px;
      }
    }

    .lang-desc {
      font-size: 14px;
      color: var(--text-light);
      font-weight: 500;
      line-height: 1.6;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .lang-desc {
        font-size: 15px;
      }
    }

    /* Content Cards with Modern Design */
    .content-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 24px;
    }

    @media (min-width: 640px) {
      .content-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
      }
    }

    @media (min-width: 1024px) {
      .content-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 32px;
      }
    }

    .content-card {
      background: white;
      border: 2px solid var(--border);
      border-radius: 24px;
      padding: 28px 24px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    @media (min-width: 768px) {
      .content-card {
        padding: 32px 28px;
        border-radius: 28px;
      }
    }

    .content-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.04) 0%, rgba(168, 85, 247, 0.04) 100%);
      opacity: 0;
      transition: opacity 0.4s;
    }

    .content-card:hover::before {
      opacity: 1;
    }

    .content-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 56px rgba(37, 99, 235, 0.15);
      border-color: var(--primary-light);
    }

    .content-preview {
      background: var(--bg-light);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 24px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .content-preview {
        padding: 24px;
        border-radius: 18px;
      }
    }

    .preview-box {
      position: relative;
      height: 180px;
      width: 100%;
      overflow: hidden;
      border-radius: 12px;
      background: white;
    }

    @media (min-width: 768px) {
      .preview-box {
        height: 200px;
      }
    }

    .content-title {
      font-size: 18px;
      font-weight: 900;
      color: var(--text);
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .content-title {
        font-size: 19px;
        margin-bottom: 12px;
      }
    }

    .content-desc {
      font-size: 14px;
      color: var(--text-light);
      margin-bottom: 20px;
      font-weight: 500;
      line-height: 1.6;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .content-desc {
        font-size: 14px;
        margin-bottom: 24px;
      }
    }

    .btn-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .btn-group {
        gap: 12px;
      }
    }

    .btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 20px;
      border-radius: 12px;
      font-weight: 800;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      cursor: pointer;
      border: none;
      text-align: center;
      touch-action: manipulation;
    }

    @media (min-width: 768px) {
      .btn {
        padding: 13px 22px;
        font-size: 14px;
      }
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      color: white;
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(37, 99, 235, 0.4);
    }

    .btn-secondary {
      background: white;
      color: var(--primary);
      border: 2px solid var(--primary);
    }

    .btn-secondary:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    /* Platform Cards */
    .platform-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 32px;
      max-width: 1100px;
      margin: 0 auto;
    }

    @media (min-width: 1024px) {
      .platform-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
      }
    }

    .platform-card {
      background: white;
      border: 3px solid var(--border);
      border-radius: 32px;
      padding: 40px 32px;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    @media (min-width: 768px) {
      .platform-card {
        padding: 48px 40px;
        border-radius: 36px;
      }
    }

    .platform-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.03) 0%, rgba(168, 85, 247, 0.03) 100%);
      opacity: 0;
      transition: opacity 0.4s;
    }

    .platform-card:hover::before {
      opacity: 1;
    }

    .platform-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 28px 70px rgba(37, 99, 235, 0.2);
      border-color: var(--primary-light);
    }

    .platform-header {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 32px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .platform-header {
        gap: 24px;
        margin-bottom: 36px;
      }
    }

    .platform-icon {
      width: 72px;
      height: 72px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      flex-shrink: 0;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    @media (min-width: 768px) {
      .platform-icon {
        width: 80px;
        height: 80px;
        border-radius: 22px;
        font-size: 40px;
      }
    }

    .platform-icon.red {
      background: linear-gradient(135deg, #DC2626, #EF4444);
    }

    .platform-icon.blue {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
    }

    .platform-title {
      font-size: 26px;
      font-weight: 900;
      letter-spacing: -0.02em;
    }

    @media (min-width: 768px) {
      .platform-title {
        font-size: 28px;
      }
    }

    .platform-subtitle {
      font-size: 15px;
      color: var(--text-muted);
      font-weight: 700;
      margin-top: 4px;
    }

    .mission-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .mission-list {
        gap: 24px;
      }
    }

    .mission-item {
      background: var(--bg-light);
      padding: 24px;
      border-radius: 18px;
      border-left: 4px solid;
      transition: all 0.3s;
    }

    @media (min-width: 768px) {
      .mission-item {
        padding: 28px;
        border-radius: 20px;
      }
    }

    .mission-item.mission-1 {
      border-color: #DC2626;
    }

    .mission-item.mission-2 {
      border-color: var(--success);
    }

    .mission-item:hover {
      transform: translateX(8px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .mission-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 900;
      font-size: 16px;
      margin-right: 12px;
      flex-shrink: 0;
    }

    @media (min-width: 768px) {
      .mission-number {
        width: 40px;
        height: 40px;
        font-size: 18px;
        margin-right: 14px;
      }
    }

    .mission-number.red {
      background: linear-gradient(135deg, #DC2626, #EF4444);
    }

    .mission-number.green {
      background: linear-gradient(135deg, var(--success), #34D399);
    }

    .mission-title {
      font-size: 16px;
      font-weight: 900;
      color: var(--text);
      margin-bottom: 8px;
    }

    @media (min-width: 768px) {
      .mission-title {
        font-size: 17px;
        margin-bottom: 10px;
      }
    }

    .mission-desc {
      font-size: 14px;
      color: var(--text-light);
      line-height: 1.7;
      font-weight: 500;
    }

    @media (min-width: 768px) {
      .mission-desc {
        font-size: 15px;
      }
    }

    /* FAQ Section */
    .faq-grid {
      max-width: 900px;
      margin: 0 auto;
    }

    .faq-item {
      background: white;
      border: 2px solid var(--border);
      border-radius: 20px;
      margin-bottom: 16px;
      overflow: hidden;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @media (min-width: 768px) {
      .faq-item {
        border-radius: 24px;
        margin-bottom: 20px;
      }
    }

    .faq-item:hover {
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.12);
      border-color: var(--primary-light);
    }

    .faq-item summary {
      padding: 24px 28px;
      cursor: pointer;
      font-weight: 800;
      font-size: 15px;
      color: var(--text);
      list-style: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
      user-select: none;
      letter-spacing: -0.01em;
      touch-action: manipulation;
    }

    @media (min-width: 768px) {
      .faq-item summary {
        padding: 28px 32px;
        font-size: 16px;
      }
    }

    .faq-item summary::-webkit-details-marker {
      display: none;
    }

    .faq-item summary::after {
      content: '+';
      font-size: 32px;
      color: var(--primary);
      font-weight: 900;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      line-height: 1;
      flex-shrink: 0;
      margin-left: 16px;
    }

    .faq-item[open] summary::after {
      transform: rotate(45deg);
    }

    .faq-answer {
      padding: 0 28px 28px;
      font-size: 14px;
      color: var(--text-light);
      line-height: 1.8;
      font-weight: 500;
    }

    @media (min-width: 768px) {
      .faq-answer {
        padding: 0 32px 32px;
        font-size: 15px;
      }
    }

    .faq-answer strong {
      color: var(--text);
      font-weight: 800;
    }

    /* Modals */
    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal.hidden {
      display: none;
    }

    .modal-content {
      background: white;
      border-radius: 28px;
      max-width: 900px;
      width: 100%;
      max-height: 90vh;
      overflow: hidden;
      box-shadow: 0 32px 80px rgba(0, 0, 0, 0.3);
      animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 24px 28px;
      border-bottom: 2px solid var(--border);
    }

    @media (min-width: 768px) {
      .modal-header {
        padding: 28px 32px;
      }
    }

    .modal-title {
      font-size: 20px;
      font-weight: 900;
      color: var(--text);
    }

    @media (min-width: 768px) {
      .modal-title {
        font-size: 22px;
      }
    }

    .modal-close {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--bg-light);
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: var(--text-muted);
      cursor: pointer;
      transition: all 0.3s;
    }

    .modal-close:hover {
      background: var(--primary);
      color: white;
      transform: rotate(90deg);
    }

    .modal-body {
      height: 60vh;
      min-height: 400px;
    }

    .modal-body iframe,
    .modal-body img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    /* Contact Form Modal */
    .form-modal {
      max-width: 600px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-input {
      width: 100%;
      padding: 14px 18px;
      border: 2px solid var(--border);
      border-radius: 14px;
      font-size: 14px;
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
      transition: all 0.3s;
    }

    @media (min-width: 768px) {
      .form-input {
        padding: 16px 20px;
        border-radius: 16px;
        font-size: 15px;
      }
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    textarea.form-input {
      resize: vertical;
      min-height: 120px;
    }

    .form-submit {
      width: 100%;
      padding: 16px 28px;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: white;
      font-weight: 800;
      font-size: 16px;
      border: none;
      border-radius: 16px;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
    }

    @media (min-width: 768px) {
      .form-submit {
        padding: 18px 32px;
        font-size: 17px;
        border-radius: 18px;
      }
    }

    .form-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 32px rgba(37, 99, 235, 0.4);
    }

    /* Success Popup */
    .success-popup {
      max-width: 500px;
      text-align: center;
      padding: 48px 32px;
    }

    @media (min-width: 768px) {
      .success-popup {
        padding: 56px 40px;
      }
    }

    .success-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--success), #34D399);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      font-size: 40px;
      animation: pulse-glow 2s ease-in-out infinite;
    }

    @media (min-width: 768px) {
      .success-icon {
        width: 96px;
        height: 96px;
        font-size: 48px;
        margin-bottom: 28px;
      }
    }

    .success-title {
      font-size: 26px;
      font-weight: 900;
      color: var(--text);
      margin-bottom: 12px;
    }

    @media (min-width: 768px) {
      .success-title {
        font-size: 30px;
        margin-bottom: 16px;
      }
    }

    .success-text {
      font-size: 15px;
      color: var(--text-light);
      line-height: 1.6;
      font-weight: 500;
    }

    @media (min-width: 768px) {
      .success-text {
        font-size: 16px;
      }
    }

    /* Stats Section */
    .stats-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 28px;
      max-width: 1000px;
      margin: 0 auto;
    }

    @media (min-width: 768px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
      }
    }

    .stat-card {
      background: white;
      border: 2px solid var(--border);
      border-radius: 24px;
      padding: 32px 28px;
      position: relative;
      overflow: hidden;
    }

    @media (min-width: 768px) {
      .stat-card {
        padding: 36px 32px;
        border-radius: 28px;
      }
    }

    .stat-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.04) 0%, rgba(168, 85, 247, 0.04) 100%);
    }

    .stat-icon {
      font-size: 40px;
      margin-bottom: 20px;
      display: block;
      position: relative;
      z-index: 1;
    }

    .stat-title {
      font-size: 20px;
      font-weight: 900;
      color: var(--text);
      margin-bottom: 16px;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .stat-title {
        font-size: 22px;
        margin-bottom: 18px;
      }
    }

    .stat-list {
      list-style: none;
      padding: 0;
      position: relative;
      z-index: 1;
    }

    .stat-list li {
      padding-left: 28px;
      margin-bottom: 12px;
      font-size: 14px;
      color: var(--text-light);
      line-height: 1.7;
      font-weight: 500;
      position: relative;
    }

    @media (min-width: 768px) {
      .stat-list li {
        font-size: 15px;
        margin-bottom: 14px;
      }
    }

    .stat-list li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: var(--success);
      font-weight: 900;
      font-size: 18px;
    }

    .stat-list li strong {
      color: var(--text);
      font-weight: 800;
    }

    .stat-note {
      margin-top: 20px;
      padding: 16px 20px;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(168, 85, 247, 0.08));
      border-radius: 14px;
      font-size: 14px;
      color: var(--text-light);
      line-height: 1.7;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    @media (min-width: 768px) {
      .stat-note {
        padding: 18px 22px;
        font-size: 15px;
      }
    }

    .stat-note strong {
      color: var(--text);
      font-weight: 800;
    }

    /* Utility Classes */
    .text-gradient {
      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    img {
      max-width: 100%;
      height: auto;
    }

    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    .scrollbar-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
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
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span>🌍 The Only International Platform Serving 195+ Countries</span>
        </div>

        <h1>Ulixai Press & Media Center 📰</h1>

        <p class="hero-subtitle">
          Access official press resources for <strong>the world's first truly global expat platform</strong>.<br>
          Serving <strong>304 million expats in 195+ countries</strong> with <strong>all major languages</strong>.
        </p>

        <div class="hero-cta-group">
          <a href="#languages" class="hero-cta">
            <span>Access Press Materials</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
          <button onclick="openModal()" class="hero-cta hero-cta-secondary">
            <span>Contact Press Team</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </button>
        </div>

        <div class="hero-stats">
          <div class="hero-stat">
            <span class="hero-stat-number">304M</span>
            <span class="hero-stat-label">Global Expats Served</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number">195+</span>
            <span class="hero-stat-label">Countries Worldwide</span>
          </div>
          <div class="hero-stat">
            <span class="hero-stat-number">9</span>
            <span class="hero-stat-label">Major Languages Available</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="section" style="background: var(--bg-light);">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">How to Access Press Materials ⚡</h2>
        <p class="section-subtitle">Get the information you need in 3 simple steps</p>
      </div>

      <div class="lang-grid" style="max-width: 1000px;">
        <div class="lang-card" style="pointer-events: none;">
          <span class="lang-flag">1️⃣</span>
          <h3 class="lang-name">Select Your Language</h3>
          <p class="lang-desc">Choose from 9 available languages below to access localized press materials</p>
        </div>

        <div class="lang-card" style="pointer-events: none;">
          <span class="lang-flag">2️⃣</span>
          <h3 class="lang-name">Choose Content Type</h3>
          <p class="lang-desc">Access logos, press kits, photos, guidelines, or press releases</p>
        </div>

        <div class="lang-card" style="pointer-events: none;">
          <span class="lang-flag">3️⃣</span>
          <h3 class="lang-name">View or Download</h3>
          <p class="lang-desc">Preview online or download as ZIP for your publication needs</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Languages Section -->
  <section id="languages" class="section">
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

        <a href="/press/es" class="lang-card">
          <span class="lang-flag">🇪🇸</span>
          <h3 class="lang-name">Español</h3>
          <p class="lang-desc">Kits de prensa, comunicados y directrices</p>
        </a>

        <a href="/press/pt" class="lang-card">
          <span class="lang-flag">🇵🇹</span>
          <h3 class="lang-name">Português</h3>
          <p class="lang-desc">Kits de imprensa, comunicados e diretrizes</p>
        </a>

        <a href="/press/ru" class="lang-card">
          <span class="lang-flag">🇷🇺</span>
          <h3 class="lang-name">Русский</h3>
          <p class="lang-desc">Пресс-киты, релизы и руководства</p>
        </a>

        <a href="/press/zh" class="lang-card">
          <span class="lang-flag">🇨🇳</span>
          <h3 class="lang-name">中文</h3>
          <p class="lang-desc">新闻资料包、新闻稿和品牌指南</p>
        </a>

        <a href="/press/ar" class="lang-card">
          <span class="lang-flag">🇸🇦</span>
          <h3 class="lang-name">العربية</h3>
          <p class="lang-desc">مجموعات الصحافة والبيانات والإرشادات</p>
        </a>

        <a href="/press/hi" class="lang-card">
          <span class="lang-flag">🇮🇳</span>
          <h3 class="lang-name">हिन्दी</h3>
          <p class="lang-desc">प्रेस किट, विज्ञप्ति और दिशानिर्देश</p>
        </a>
      </div>
    </div>
  </section>

  <!-- Press Materials Section (Only shown on language-specific pages) -->
  @if(isset($showContent) && $showContent)
  <section class="section" style="background: var(--bg-light);">
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
        <div style="text-align: center; padding: 60px 20px;">
          <div style="font-size: 64px; margin-bottom: 20px;">📦</div>
          <p style="font-size: 18px; color: var(--text-muted); font-weight: 600;">No press assets available yet. Please check back later or contact our press team.</p>
        </div>
      @else
        <div class="content-grid">
          
          <!-- Official Logo Card -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestIcon)
                  <img
                    src="{{ route('press.asset', [$latestIcon->id, 'icon']) }}"
                    alt="Official Ulixai Logo"
                    style="width: 100%; height: 100%; object-fit: contain;">
                @else
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 56px;">🗂️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Official Logo</h3>
            <p class="content-desc">PNG & SVG formats available</p>
            @if($latestIcon)
              <div class="btn-group">
                <button onclick="viewAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}')" class="btn btn-primary">
                  👁️ View Logo
                </button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestIcon->id, 'icon']) }}', 'ulixai-logo.zip')" class="btn btn-secondary">
                  ⬇️ Download
                </button>
              </div>
            @else
              <p style="text-align: center; color: var(--text-muted); font-size: 13px; font-weight: 600;">Coming soon</p>
            @endif
          </div>

          <!-- Press Kit PDF Card -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="pdf-preview-{{ $latestPdf ? $latestPdf->id : 'none' }}">
                @if($latestPdf)
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(239, 68, 68, 0.1)); cursor: pointer;"
                      onclick="loadPdfPreview('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'pdf-preview-{{ $latestPdf->id }}')">
                    <div style="text-align: center;">
                      <div style="font-size: 56px; margin-bottom: 12px;">📄</div>
                      <div style="font-size: 13px; color: var(--text-muted); font-weight: 700;">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 56px;">📄</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Press Kit (PDF)</h3>
            <p class="content-desc">Complete information package</p>
            @if($latestPdf)
              <div class="btn-group">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestPdf->id, 'pdf']) }}')" class="btn btn-primary">
                  👁️ View PDF
                </button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPdf->id, 'pdf']) }}', 'ulixai-press-kit.zip')" class="btn btn-secondary">
                  ⬇️ Download
                </button>
              </div>
            @else
              <p style="text-align: center; color: var(--text-muted); font-size: 13px; font-weight: 600;">Coming soon</p>
            @endif
          </div>

          <!-- Brand Guidelines Card -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box" id="guide-preview-{{ $latestGuide ? $latestGuide->id : 'none' }}">
                @if($latestGuide)
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, rgba(168, 85, 247, 0.1), rgba(192, 132, 252, 0.1)); cursor: pointer;"
                      onclick="loadPdfPreview('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'guide-preview-{{ $latestGuide->id }}')">
                    <div style="text-align: center;">
                      <div style="font-size: 56px; margin-bottom: 12px;">📘</div>
                      <div style="font-size: 13px; color: var(--text-muted); font-weight: 700;">Click to preview</div>
                    </div>
                  </div>
                @else
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 56px;">📘</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">Brand Guidelines</h3>
            <p class="content-desc">Usage rules and standards</p>
            @if($latestGuide)
              <div class="btn-group">
                <button onclick="viewPdfModal('{{ route('press.preview', [$latestGuide->id, 'guideline_pdf']) }}')" class="btn btn-primary">
                  👁️ View Guidelines
                </button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestGuide->id, 'guideline_pdf']) }}', 'ulixai-brand-guidelines.zip')" class="btn btn-secondary">
                  ⬇️ Download
                </button>
              </div>
            @else
              <p style="text-align: center; color: var(--text-muted); font-size: 13px; font-weight: 600;">Coming soon</p>
            @endif
          </div>

          <!-- HD Photos Card -->
          <div class="content-card">
            <div class="content-preview">
              <div class="preview-box">
                @if($latestPhoto)
                  <img
                    src="{{ route('press.asset', [$latestPhoto->id, 'photo']) }}"
                    alt="Ulixai HD Photo"
                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                @else
                  <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 56px;">🖼️</div>
                @endif
              </div>
            </div>
            <h3 class="content-title">HD Photos</h3>
            <p class="content-desc">High-resolution images</p>
            @if($latestPhoto)
              <div class="btn-group">
                <button onclick="viewAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}')" class="btn btn-primary">
                  👁️ View Photo
                </button>
                <button onclick="downloadAsset('{{ route('press.asset', [$latestPhoto->id, 'photo']) }}', 'ulixai-photo.zip')" class="btn btn-secondary">
                  ⬇️ Download
                </button>
              </div>
            @else
              <p style="text-align: center; color: var(--text-muted); font-size: 13px; font-weight: 600;">Coming soon</p>
            @endif
          </div>

        </div>

        <!-- Press Releases -->
        @php
          $releases = $pressItems->whereNotNull('pdf')->sortByDesc('created_at')->take(6);
        @endphp

        @if($releases->isNotEmpty())
        <div style="margin-top: 80px;">
          <div class="section-header" style="margin-bottom: 48px;">
            <h2 class="section-title">📰 Recent Press Releases</h2>
            <p class="section-subtitle">Latest news and announcements</p>
          </div>

          <div class="content-grid" style="grid-template-columns: 1fr;">
            @foreach($releases as $pr)
              <div class="content-card" style="padding: 32px; display: flex; align-items: center; gap: 24px;">
                <div style="flex-shrink: 0; width: 72px; height: 72px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 36px; box-shadow: 0 12px 32px rgba(37, 99, 235, 0.25);">
                  📰
                </div>
                <div style="flex: 1;">
                  <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <h4 style="font-size: 19px; font-weight: 900; color: var(--text); margin: 0;">
                      {{ $pr->title ?: 'Ulixai Press Release' }}
                    </h4>
                    <span style="font-size: 12px; font-weight: 800; color: var(--primary); background: rgba(37, 99, 235, 0.1); padding: 4px 12px; border-radius: 100px;">
                      {{ optional($pr->created_at)->format('M Y') }}
                    </span>
                  </div>
                  @if($pr->description)
                    <p style="font-size: 14px; color: var(--text-light); font-weight: 500; margin: 0 0 16px 0; line-height: 1.6;">
                      {{ \Illuminate\Support\Str::limit($pr->description, 180) }}
                    </p>
                  @endif
                  @if($pr->pdf)
                    <button onclick="downloadAsset('{{ route('press.asset', [$pr->id, 'pdf']) }}', '{{ $pr->title ? \Illuminate\Support\Str::slug($pr->title) : 'press-release' }}-{{ optional($pr->created_at)->format('Y-m') }}.zip')" class="btn btn-primary" style="width: auto; padding: 10px 24px;">
                      ⬇️ Download Release
                    </button>
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
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">2 Platforms, 4 Missions 🚀</h2>
        <p class="section-subtitle">Supporting expats AND creating global opportunities</p>
      </div>

      <div class="platform-grid">
        
        <!-- SOS-Expat.com -->
        <div class="platform-card">
          <div class="platform-header">
            <div class="platform-icon red">📞</div>
            <div>
              <h3 class="platform-title" style="color: #DC2626;">SOS-Expat.com</h3>
              <p class="platform-subtitle">Immediate Assistance 24/7</p>
            </div>
          </div>

          <div class="mission-list">
            <div class="mission-item mission-1">
              <div style="display: flex; align-items: start;">
                <span class="mission-number red">1</span>
                <div>
                  <h4 class="mission-title">Mission 1: Immediate Assistance</h4>
                  <p class="mission-desc">Expats, travelers, and vacationers in difficulty anywhere in the world get instant 24/7 help</p>
                </div>
              </div>
            </div>

            <div class="mission-item mission-2">
              <div style="display: flex; align-items: start;">
                <span class="mission-number green">2</span>
                <div>
                  <h4 class="mission-title">Mission 2: Guaranteed Income</h4>
                  <p class="mission-desc">Lawyers & expat helpers earn money with prepaid calls from anywhere</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ulixai.com -->
        <div class="platform-card">
          <div class="platform-header">
            <div class="platform-icon blue">💬</div>
            <div>
              <h3 class="platform-title" style="color: var(--primary);">Ulixai.com</h3>
              <p class="platform-subtitle">Services & Competitive Offers</p>
            </div>
          </div>

          <div class="mission-list">
            <div class="mission-item mission-1" style="border-color: var(--primary);">
              <div style="display: flex; align-items: start;">
                <span class="mission-number" style="background: linear-gradient(135deg, var(--primary), var(--primary-light));">1</span>
                <div>
                  <h4 class="mission-title">Mission 1: Unlimited Services & Multiple Providers</h4>
                  <p class="mission-desc">Find the right service provider anywhere in the world with competitive offers</p>
                </div>
              </div>
            </div>

            <div class="mission-item mission-2">
              <div style="display: flex; align-items: start;">
                <span class="mission-number green">2</span>
                <div>
                  <h4 class="mission-title">Mission 2: Global Income Opportunities</h4>
                  <p class="mission-desc">Expat service providers and professionals earn income wherever they are worldwide</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Global Impact Stats -->
  <section class="section" style="background: var(--bg-light);">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Global Reach & Impact 🌍</h2>
        <p class="section-subtitle">Understanding the international expatriation landscape</p>
      </div>

      <div class="stats-grid">
        
        <div class="stat-card">
          <span class="stat-icon">🌍</span>
          <h3 class="stat-title">Global Expatriation at a Glance</h3>
          <ul class="stat-list">
            <li><strong>304 million people</strong> currently live outside their country of origin (UN, 2023)</li>
            <li>Over <strong>1.645 billion international travelers</strong> every year</li>
            <li>Mobility keeps growing for work, study, retirement, and family reasons</li>
          </ul>
          <div class="stat-note">
            <strong>Key challenges:</strong> administrative procedures, housing, employment, healthcare, and cultural integration across 195+ countries
          </div>
        </div>

        <div class="stat-card">
          <span class="stat-icon">ℹ️</span>
          <h3 class="stat-title">About Ulixai & SOS Expat</h3>
          <ul class="stat-list">
            <li><strong>Ulixai.com:</strong> a digital platform that simplifies expatriates' lives by centralizing information and services across all major languages</li>
            <li><strong>SOS-Expat.com:</strong> on-demand, 24/7 assistance service for urgent needs (legal, housing, healthcare, employment)</li>
            <li><strong>Coverage:</strong> 195+ countries with support in English, French, Spanish, German, Portuguese, Russian, Chinese, Arabic, Hindi</li>
          </ul>
          <div class="stat-note">
            <strong>Our commitment:</strong> speed, confidentiality, reliability, and true international accessibility
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Frequently Asked Questions ❓</h2>
        <p class="section-subtitle">Everything journalists need to know about Ulixai</p>
      </div>

      <div class="faq-grid">
        
        <details class="faq-item">
          <summary>What makes Ulixai unique in the international marketplace?</summary>
          <div class="faq-answer">
            Ulixai is <strong>the only truly international platform</strong> serving expats across 195+ countries with support in all major world languages. Unlike regional competitors, we provide both immediate SOS assistance and long-term service marketplace solutions, making us the most comprehensive platform for the global expat community.
          </div>
        </details>

        <details class="faq-item">
          <summary>How many countries and languages does Ulixai support?</summary>
          <div class="faq-answer">
            Ulixai operates in <strong>195+ countries worldwide</strong> and supports <strong>9 major languages</strong>: English, French, Spanish, German, Portuguese, Russian, Chinese, Arabic, and Hindi. This makes us accessible to the vast majority of the 304 million people living outside their country of origin.
          </div>
        </details>

        <details class="faq-item">
          <summary>How can I download press materials in my language?</summary>
          <div class="faq-answer">
            Simply select your preferred language from the language grid above. Each language page contains <strong>localized press kits, brand guidelines, HD photos, and press releases</strong>. All materials are instantly available for viewing or download in ZIP format for easy integration into your publication.
          </div>
        </details>

        <details class="faq-item">
          <summary>What is the difference between Ulixai and SOS-Expat?</summary>
          <div class="faq-answer">
            <strong>SOS-Expat.com</strong> provides 24/7 emergency assistance for expats in difficulty anywhere in the world. <strong>Ulixai.com</strong> is our marketplace platform where expats can find and compare service providers for planned needs (housing, legal, moving, etc.). Together, they form a complete ecosystem serving both urgent and planned expatriation needs.
          </div>
        </details>

        <details class="faq-item">
          <summary>Can I interview Ulixai founders or executives?</summary>
          <div class="faq-answer">
            Absolutely! We welcome media inquiries and interview requests. Please use the <strong>"Contact Press Team"</strong> button above or email our press relations team directly. We respond to all legitimate press inquiries within 24 hours and can arrange interviews in English, French, Spanish, or other major languages.
          </div>
        </details>

        <details class="faq-item">
          <summary>Are Ulixai logos and materials free to use?</summary>
          <div class="faq-answer">
            Yes! All materials in our press kit are <strong>free to use for editorial purposes</strong>. Please refer to our brand guidelines for proper usage. For commercial use or licensing inquiries, please contact our press team. We're here to make it easy for you to cover Ulixai accurately and professionally.
          </div>
        </details>

      </div>
    </div>
  </section>

  <!-- Contact CTA -->
  <section class="section" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--accent) 100%); color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%); border-radius: 50%; top: -200px; right: -150px; filter: blur(80px);"></div>
    <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%); border-radius: 50%; bottom: -150px; left: -100px; filter: blur(70px);"></div>
    
    <div class="container" style="position: relative; z-index: 1; text-align: center;">
      <h2 style="font-size: clamp(32px, 8vw, 56px); font-weight: 900; margin-bottom: 24px; letter-spacing: -0.03em;">Need More Information? 📧</h2>
      <p style="font-size: clamp(16px, 3.5vw, 22px); opacity: 0.95; margin-bottom: 48px; font-weight: 600; line-height: 1.5;">
        Our press team responds to all inquiries within 24 hours
      </p>
      <button onclick="openModal()" style="display: inline-flex; align-items: center; gap: 14px; padding: 22px 56px; background: white; color: var(--primary); font-size: 19px; font-weight: 800; border-radius: 100px; border: none; cursor: pointer; box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2); transition: all 0.3s; text-decoration: none;">
        <span>Contact Press Team</span>
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </button>
    </div>
  </section>

  <!-- PDF Modal -->
  <div id="pdfModal" class="modal hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Document Preview</h3>
        <button onclick="closePdfModal()" class="modal-close">×</button>
      </div>
      <div class="modal-body">
        <iframe id="pdfModalFrame" src=""></iframe>
      </div>
    </div>
  </div>

  <!-- Asset Modal -->
  <div id="assetModal" class="modal hidden" style="background: rgba(0, 0, 0, 0.9);">
    <div style="position: relative; max-width: 90vw; max-height: 90vh;">
      <button onclick="closeAssetModal()" style="position: absolute; top: -50px; right: 0; width: 48px; height: 48px; border-radius: 50%; background: white; border: none; display: flex; align-items: center; justify-content: center; font-size: 28px; color: var(--text); cursor: pointer; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3); transition: all 0.3s; z-index: 10;">×</button>
      <img id="assetModalImg" style="max-width: 100%; max-height: 90vh; object-fit: contain; border-radius: 16px; box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5);" src="" alt="">
    </div>
  </div>

  <!-- Contact Form Modal -->
  <div id="contactModal" class="modal hidden">
    <div class="modal-content form-modal">
      <div class="modal-header">
        <div style="display: flex; align-items: center; gap: 12px;">
          <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;">📧</div>
          <h3 class="modal-title">Press Relations Contact</h3>
        </div>
        <button onclick="closeModal()" class="modal-close">×</button>
      </div>
      <div style="padding: 32px;">
        <form onsubmit="submitForm(event)">
          <div class="form-group">
            <input type="text" class="form-input" placeholder="Media Outlet Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-input" placeholder="Your Full Name" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-input" placeholder="Professional Email Address" required>
          </div>
          <div class="form-group">
            <input type="tel" class="form-input" placeholder="Phone Number (with country code)">
          </div>
          <div class="form-group">
            <input type="url" class="form-input" placeholder="Your Publication Website">
          </div>
          <div class="form-group">
            <input type="text" class="form-input" placeholder="Preferred Language for Communication">
          </div>
          <div class="form-group">
            <textarea class="form-input" placeholder="Your Message or Inquiry" rows="5" required></textarea>
          </div>
          <button type="submit" class="form-submit">
            📨 Send Press Inquiry
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Success Popup -->
  <div id="thankYouModal" class="modal hidden">
    <div class="modal-content success-popup">
      <div class="success-icon">✅</div>
      <h2 class="success-title">Thank You! 🎉</h2>
      <p class="success-text" style="margin-bottom: 12px;">
        We've received your press inquiry and will respond <strong>within 24 hours</strong>.
      </p>
      <p class="success-text">
        Our press team is excited to work with you on covering Ulixai's global impact! 🌍
      </p>
    </div>
  </div>

  @include('includes.footer')

  <script>
    // ZIP Download Function
    async function downloadAsset(url, suggestedZipName) {
      let zipName = suggestedZipName || 'download.zip';
      if (!zipName.toLowerCase().endsWith('.zip')) {
        zipName = zipName.replace(/\.[a-z0-9]+$/i, '') + '.zip';
      }

      try {
        const res = await fetch(url, { credentials: 'same-origin' });
        if (res.redirected || !res.ok) {
          return fallbackDirect(url, zipName);
        }

        let inner = inferInnerNameFromHeaders(res) || inferInnerNameFromUrl(url) || 'file.bin';
        if (!/\.[a-z0-9]+$/i.test(inner)) {
          const ext = mimeToExt(res.headers.get('Content-Type')) || 'bin';
          inner += '.' + ext;
        }

        const blob = await res.blob();
        if (!window.JSZip) return fallbackDirect(url, zipName);
        
        const zip = new JSZip();
        zip.file(inner, blob);
        const zipBlob = await zip.generateAsync({ type: 'blob' });

        const a = document.createElement('a');
        const blobUrl = URL.createObjectURL(zipBlob);
        a.href = blobUrl;
        a.download = zipName;
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(blobUrl);
      } catch (e) {
        fallbackDirect(url, zipName);
      }

      function inferInnerNameFromHeaders(response) {
        const cd = response.headers.get('Content-Disposition') || '';
        const m1 = cd.match(/filename\*=(?:UTF-8''|)([^;]+)/i);
        const m2 = cd.match(/filename="([^"]+)"/i);
        const raw = (m1 && m1[1]) || (m2 && m2[1]);
        return raw ? decodeURIComponent(raw.replace(/^UTF-8''/i, '').trim()) : null;
      }
      
      function inferInnerNameFromUrl(u) {
        try {
          const x = new URL(u, location.href);
          const last = x.pathname.split('/').pop() || '';
          return last.split('?')[0] || null;
        } catch {
          return null;
        }
      }
      
      function mimeToExt(ct) {
        const t = (ct || '').toLowerCase();
        if (t.includes('pdf')) return 'pdf';
        if (t.includes('svg')) return 'svg';
        if (t.includes('png')) return 'png';
        if (t.includes('jpeg') || t.includes('jpg')) return 'jpg';
        if (t.includes('webp')) return 'webp';
        if (t.includes('gif')) return 'gif';
        return null;
      }
      
      function fallbackDirect(href, name) {
        const a = document.createElement('a');
        a.href = href;
        a.download = name;
        document.body.appendChild(a);
        a.click();
        a.remove();
      }
    }

    // PDF Preview Functions
    function loadPdfPreview(url, containerId) {
      const container = document.getElementById(containerId);
      container.innerHTML = `<iframe src="${url}#toolbar=0&navpanes=0" style="width: 100%; height: 100%; border: none;" loading="lazy"></iframe>`;
    }

    function viewPdfModal(url) {
      const modal = document.getElementById('pdfModal');
      const iframe = document.getElementById('pdfModalFrame');
      
      fetch(url, {
        method: 'GET',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/pdf'
        }
      })
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.blob();
      })
      .then(blob => {
        const blobUrl = URL.createObjectURL(blob);
        iframe.src = blobUrl + '#toolbar=0&navpanes=0&scrollbar=0';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      })
      .catch(error => {
        iframe.src = url + '#view=FitH&toolbar=0&navpanes=0&scrollbar=0&statusbar=0&messages=0';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      });
    }

    function closePdfModal() {
      const modal = document.getElementById('pdfModal');
      const iframe = document.getElementById('pdfModalFrame');
      if (iframe && iframe.src.startsWith('blob:')) {
        URL.revokeObjectURL(iframe.src);
      }
      if (iframe) iframe.src = '';
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    // Asset Modal Functions
    function viewAsset(url) {
      const modal = document.getElementById('assetModal');
      const img = document.getElementById('assetModalImg');
      img.src = url;
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeAssetModal() {
      const modal = document.getElementById('assetModal');
      const img = document.getElementById('assetModalImg');
      img.src = '';
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    // Contact Modal Functions
    function openModal() {
      document.getElementById('contactModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      document.getElementById('contactModal').classList.add('hidden');
      document.body.style.overflow = '';
    }

    function submitForm(e) {
      e.preventDefault();
      closeModal();
      setTimeout(() => {
        document.getElementById('thankYouModal').classList.remove('hidden');
      }, 200);
      setTimeout(() => {
        document.getElementById('thankYouModal').classList.add('hidden');
        document.body.style.overflow = '';
      }, 5000);
    }

    // Close modals on outside click
    document.getElementById('pdfModal').addEventListener('click', function(e) {
      if (e.target === this) closePdfModal();
    });
    document.getElementById('assetModal').addEventListener('click', function(e) {
      if (e.target === this) closeAssetModal();
    });
    window.addEventListener('click', function (e) {
      if (e.target.id === 'contactModal') closeModal();
      if (e.target.id === 'thankYouModal') {
        document.getElementById('thankYouModal').classList.add('hidden');
        document.body.style.overflow = '';
      }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
          e.preventDefault();
          const target = document.querySelector(href);
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        }
      });
    });
  </script>
</body>
</html>