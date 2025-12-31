<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  
  <title>Cookie Preferences | Ulixai & SOS-Expat - Your Privacy, Your Choice</title>
  <meta name="description" content="Manage your cookie preferences at Ulixai.com and SOS-Expat.com. We believe in transparency and giving you control over your data.">
  <meta name="robots" content="index, follow">
  
  <meta name="theme-color" content="#3b82f6">
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png">
  
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      line-height: 1.5;
      color: #1e293b;
      overflow-x: hidden;
      font-size: 14px;
    }

    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(135deg, #3b82f6, #06b6d4, #14b8a6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: gradientFlow 8s ease infinite;
      background-size: 400% 400%;
    }

    @keyframes gradientFlow {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    /* Enhanced Card Styles */
    .enhanced-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.1);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
    }

    .enhanced-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 32px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
    }

    /* Floating Animation */
    .floating-animation {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }

    /* Bounce Animation */
    .icon-bounce {
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 20%, 53%, 80%, 100% { transform: translateY(0); }
      40%, 43% { transform: translateY(-8px); }
      70% { transform: translateY(-4px); }
    }

    /* Pulse Badge */
    .pulse-badge {
      animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.7; }
    }

    /* Toggle Switch - Enhanced */
    .toggle-switch {
      position: relative;
      width: 3.5rem;
      height: 1.75rem;
      background-color: #e5e7eb;
      border-radius: 9999px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      flex-shrink: 0;
    }

    .toggle-switch.active {
      background: linear-gradient(135deg, #3b82f6, #06b6d4);
      border-color: #0ea5e9;
    }

    .toggle-switch::after {
      content: '';
      position: absolute;
      top: 2px;
      left: 2px;
      width: 1.5rem;
      height: 1.5rem;
      background: white;
      border-radius: 50%;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-switch.active::after {
      left: calc(100% - 1.5rem - 2px);
    }

    /* Glass Effect */
    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Background Pattern */
    .bg-pattern {
      background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%233b82f6" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
      opacity: 0.4;
    }

    /* Stagger Animation */
    .stagger-animation {
      animation: fadeInUp 0.8s ease-out forwards;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Performance */
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    /* Responsive */
    @media (max-width: 640px) {
      body { font-size: 13px; }
      .enhanced-card { padding: 1.25rem; }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">

@include('includes.header')

<!-- HERO SECTION -->
<section class="relative py-16 px-4 text-center overflow-hidden" role="banner">
  <div class="absolute inset-0 bg-pattern"></div>
  
  <!-- Top Banner -->
  <div class="absolute top-0 left-0 right-0 bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 py-2 px-3 overflow-hidden">
    <div class="flex items-center justify-center gap-2 text-white font-bold text-xs md:text-sm animate-pulse">
      <span class="text-lg icon-bounce" aria-hidden="true">🍪</span>
      <span>YOUR PRIVACY MATTERS TO US</span>
      <span class="text-lg" aria-hidden="true">•</span>
      <span>YOU'RE IN CONTROL</span>
      <span class="text-lg icon-bounce" aria-hidden="true">✨</span>
    </div>
  </div>
  
  <div class="relative max-w-4xl mx-auto pt-8">
    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-100 to-pink-100 border-2 border-purple-200 rounded-full px-4 py-2 mb-6 pulse-badge">
      <span class="text-3xl floating-animation" aria-hidden="true">🍪</span>
      <span class="text-purple-800 font-bold text-sm">Cookie Preferences & Privacy Control</span>
    </div>
    
    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
      <span class="gradient-text">Your Privacy, Your Choice</span>
    </h1>
    
    <p class="text-lg text-gray-700 mb-6 max-w-2xl mx-auto">
      At Ulixai.com and SOS-Expat.com, we believe transparency is key. Manage your cookie preferences below and take control of your data. <strong>No tricks, no surprises—just honest choices.</strong>
    </p>
    
    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-100 to-emerald-100 border-2 border-green-300 rounded-full px-4 py-2">
      <span class="text-lg" aria-hidden="true">✅</span>
      <span class="text-green-800 font-bold text-sm">100% Transparent • Always Optional</span>
    </div>
  </div>
</section>

<!-- WHAT ARE COOKIES SECTION -->
<section class="py-12 px-4 bg-white/50" aria-labelledby="about-cookies">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-10">
      <h2 id="about-cookies" class="text-3xl md:text-4xl font-bold text-blue-800 mb-3">
        What Are Cookies? 🤔
      </h2>
      <p class="text-base text-gray-600 max-w-2xl mx-auto">
        Think of cookies as little digital post-it notes. Your browser saves them, and we use them to recognize you, remember your preferences, and make your experience smoother. Complete transparency, always.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <article class="enhanced-card stagger-animation" style="animation-delay: 0.1s;">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 floating-animation" aria-hidden="true">📝</div>
          <div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">What We Store</h3>
            <p class="text-gray-600 text-sm leading-relaxed">User preferences, session info, language settings, and anonymized analytics. We never store passwords or credit card info in cookies.</p>
          </div>
        </div>
      </article>

      <article class="enhanced-card stagger-animation" style="animation-delay: 0.2s;">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 floating-animation" aria-hidden="true">🛡️</div>
          <div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">How We Protect You</h3>
            <p class="text-gray-600 text-sm leading-relaxed">All data is encrypted, anonymized where possible, and never sold to third parties. We follow international privacy standards and best practices.</p>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- COOKIE TYPES SECTION -->
<section class="py-12 px-4" aria-labelledby="cookie-types">
  <div class="max-w-5xl mx-auto">
    <div class="text-center mb-10">
      <h2 id="cookie-types" class="text-3xl md:text-4xl font-bold text-blue-800 mb-3">
        Four Types of Cookies
      </h2>
      <p class="text-base text-gray-600 max-w-2xl mx-auto">
        Each type serves a different purpose. You control which ones you want to accept.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
      <article class="enhanced-card stagger-animation" style="animation-delay: 0.1s;">
        <div class="w-16 h-16 bg-gradient-to-br from-red-100 to-orange-100 rounded-xl flex items-center justify-center text-4xl mb-3 mx-auto floating-animation" aria-hidden="true">🔐</div>
        <h3 class="font-bold text-gray-800 text-center mb-2">Strictly Necessary</h3>
        <p class="text-gray-600 text-center text-sm leading-relaxed mb-3">Essential for security, login, and basic site functionality. <strong>Always active</strong>—you can't turn them off!</p>
        <div class="bg-red-100 rounded-lg px-3 py-1.5 text-center text-xs font-bold text-red-700">⚡ ALWAYS ON</div>
      </article>

      <article class="enhanced-card stagger-animation" style="animation-delay: 0.2s;">
        <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center text-4xl mb-3 mx-auto floating-animation" aria-hidden="true">📊</div>
        <h3 class="font-bold text-gray-800 text-center mb-2">Performance</h3>
        <p class="text-gray-600 text-center text-sm leading-relaxed mb-3">Help us understand how visitors use our site. Which pages are popular? This helps us improve.</p>
        <div class="bg-green-100 rounded-lg px-3 py-1.5 text-center text-xs font-bold text-green-700">✓ RECOMMENDED</div>
      </article>

      <article class="enhanced-card stagger-animation" style="animation-delay: 0.3s;">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center text-4xl mb-3 mx-auto floating-animation" aria-hidden="true">⚙️</div>
        <h3 class="font-bold text-gray-800 text-center mb-2">Functionality</h3>
        <p class="text-gray-600 text-center text-sm leading-relaxed mb-3">Remember your preferences—language choice, color theme, saved filters. Makes visits personalized.</p>
        <div class="bg-blue-100 rounded-lg px-3 py-1.5 text-center text-xs font-bold text-blue-700">💝 OPTIONAL</div>
      </article>

      <article class="enhanced-card stagger-animation" style="animation-delay: 0.4s;">
        <div class="w-16 h-16 bg-gradient-to-br from-pink-100 to-rose-100 rounded-xl flex items-center justify-center text-4xl mb-3 mx-auto floating-animation" aria-hidden="true">📣</div>
        <h3 class="font-bold text-gray-800 text-center mb-2">Marketing</h3>
        <p class="text-gray-600 text-center text-sm leading-relaxed mb-3">Track activity for ads across platforms. See relevant promotions from Ulixai & SOS-Expat.</p>
        <div class="bg-pink-100 rounded-lg px-3 py-1.5 text-center text-xs font-bold text-pink-700">🚫 OPTIONAL</div>
      </article>
    </div>
  </div>
</section>

<!-- PREFERENCES FORM SECTION -->
<section class="py-12 px-4 bg-gradient-to-r from-blue-50 to-indigo-50" aria-labelledby="preferences-form">
  <div class="max-w-3xl mx-auto">
    <div class="glass-effect rounded-2xl p-8 md:p-10 shadow-xl">
      <h2 id="preferences-form" class="text-2xl md:text-3xl font-bold text-blue-800 mb-6 text-center">
        🎛️ Manage Your Preferences
      </h2>

      <form id="cookieForm" class="space-y-5">
        
        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl border-2 border-red-200">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">🔐 Strictly Necessary</h3>
            <p class="text-gray-600 text-sm">Security, login, basic functionality</p>
          </div>
          <div class="toggle-switch active" onclick="return false;" title="Always required"></div>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-2 border-green-200 hover:border-green-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">📊 Performance Analytics</h3>
            <p class="text-gray-600 text-sm">Help us understand how you use our platforms</p>
          </div>
          <div class="toggle-switch" id="performanceToggle" onclick="toggleCookie(this)"></div>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">⚙️ Functionality</h3>
            <p class="text-gray-600 text-sm">Remember your preferences & settings</p>
          </div>
          <div class="toggle-switch" id="functionalityToggle" onclick="toggleCookie(this)"></div>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl border-2 border-pink-200 hover:border-pink-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">📣 Marketing & Ads</h3>
            <p class="text-gray-600 text-sm">Personalized ads across platforms</p>
          </div>
          <div class="toggle-switch" id="marketingToggle" onclick="toggleCookie(this)"></div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-6">
          <button 
            type="submit" 
            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg flex items-center justify-center gap-2"
            aria-label="Save your cookie preferences"
          >
            <span>💾 Save My Preferences</span>
          </button>
          <button 
            type="button" 
            onclick="resetPreferences()"
            class="flex-1 bg-gradient-to-r from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500 text-gray-800 font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg flex items-center justify-center gap-2"
            aria-label="Reset to default settings"
          >
            <span>🔄 Reset to Default</span>
          </button>
        </div>

        <!-- Delete All Data Button -->
        <div class="pt-4 border-t-2 border-gray-200">
          <button 
            type="button" 
            onclick="deleteAllData()"
            class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg flex items-center justify-center gap-2"
            aria-label="Delete all stored data"
          >
            <span>🗑️ Delete All My Stored Data</span>
          </button>
        </div>
      </form>

      <div class="mt-6 p-4 bg-blue-100 border-2 border-blue-300 rounded-xl">
        <p class="text-blue-900 text-center text-sm">
          <strong>💡 Pro Tip:</strong> You can change these settings anytime. Your preferences are saved in your browser.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section class="py-12 px-4" aria-labelledby="faq-section">
  <div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
      <h2 id="faq-section" class="text-3xl md:text-4xl font-bold text-blue-800 mb-3">
        Common Questions ❓
      </h2>
    </div>

    <div class="space-y-4">
      <details class="enhanced-card cursor-pointer group">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🔒 Are my cookies secure?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform" aria-hidden="true">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Yes! All cookies are encrypted and stored securely. We follow global privacy standards and regulations. Your data is never sold to third parties without your explicit consent. We take privacy seriously—it's not just a buzzword for us.
        </p>
      </details>

      <details class="enhanced-card cursor-pointer group">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🗑️ How do I delete cookies?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform" aria-hidden="true">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Open your browser settings, go to Privacy & Security, and select "Clear Browsing Data." You can delete all cookies or just ours. On mobile, the process varies—check your device settings. After deletion, you can still use our platforms, but you may need to log back in and reset your preferences.
        </p>
      </details>

      <details class="enhanced-card cursor-pointer group">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>📵 What if I reject all optional cookies?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform" aria-hidden="true">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          No problem! The site still works perfectly. You'll just lose some personalization features—like saved preferences and optimized recommendations. Strictly necessary cookies will still be active because we need them for security and basic functionality.
        </p>
      </details>

      <details class="enhanced-card cursor-pointer group">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🌍 How long do you keep my preferences?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform" aria-hidden="true">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Your cookie preferences are stored locally in your browser using cookies with a 365-day expiration. This means you won't have to set your preferences again for a full year. You have full control: you can change them anytime on this page, clear them using the "Delete All My Stored Data" button above, or remove them through your browser settings. These preference cookies stay on your device and are not sent to external servers.
        </p>
      </details>

      <details class="enhanced-card cursor-pointer group">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>✉️ Do third parties see my data?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform" aria-hidden="true">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Never without your consent. We use Google Analytics for anonymized traffic data (no personal info). Marketing cookies are only active if you opt-in. Even then, partners like Facebook or Google only see anonymized, aggregated insights—never your personal details. It's transparent, always optional, always your choice.
        </p>
      </details>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="py-12 px-4 relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
  <div class="absolute inset-0 bg-pattern opacity-20"></div>
  
  <div class="relative max-w-3xl mx-auto text-center text-white">
    <div class="text-5xl mb-4 floating-animation" aria-hidden="true">🎉</div>
    <h2 class="text-3xl md:text-4xl font-bold mb-4">
      You're in Control
    </h2>
    <p class="text-lg mb-6 text-blue-100 max-w-xl mx-auto">
      Your privacy isn't a transaction—it's a right. We respect it, and we're transparent about it. Any questions? We're here to help.
    </p>
    
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a 
        href="mailto:privacy@ulixai.com" 
        class="inline-flex items-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-full font-bold hover:bg-blue-50 transition-all duration-300 hover:scale-105 shadow-xl"
        aria-label="Contact us about privacy"
      >
        <span>📧 Contact Us</span>
      </a>
      <a 
        href="/privacy-policy" 
        class="inline-flex items-center gap-2 bg-blue-400 text-white px-6 py-3 rounded-full font-bold hover:bg-blue-500 transition-all duration-300 hover:scale-105 shadow-xl"
        aria-label="Read our full privacy policy"
      >
        <span>📖 Privacy Policy</span>
      </a>
    </div>
  </div>
</section>

@include('includes.footer')

<script>
  // Charger les préférences au chargement de la page
  function initPreferences() {
    const preferences = getCookiePreferences();
    
    document.getElementById('performanceToggle').classList.toggle('active', preferences.performance);
    document.getElementById('functionalityToggle').classList.toggle('active', preferences.functionality);
    document.getElementById('marketingToggle').classList.toggle('active', preferences.marketing);
  }

  // Obtenir les préférences du cookie
  function getCookiePreferences() {
    const name = 'ulixai_cookie_preferences=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');
    
    for (let cookie of cookieArray) {
      cookie = cookie.trim();
      if (cookie.indexOf(name) === 0) {
        try {
          return JSON.parse(cookie.substring(name.length));
        } catch (e) {
          return { performance: true, functionality: true, marketing: false };
        }
      }
    }
    
    return { performance: true, functionality: true, marketing: false };
  }

  // Sauvegarder un cookie avec expiration
  function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
  }

  // Toggler les cookies
  function toggleCookie(element) {
    element.classList.toggle('active');
  }

  // Sauvegarder les préférences
  document.getElementById('cookieForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const preferences = {
      strictly_necessary: true,
      performance: document.getElementById('performanceToggle').classList.contains('active'),
      functionality: document.getElementById('functionalityToggle').classList.contains('active'),
      marketing: document.getElementById('marketingToggle').classList.contains('active')
    };

    // Sauvegarder dans un cookie avec expiration de 365 jours
    setCookie('ulixai_cookie_preferences', JSON.stringify(preferences), 365);
    
    showNotification('✅ Your preferences have been saved for 365 days!');
  });

  // Réinitialiser les préférences
  function resetPreferences() {
    const defaults = { performance: true, functionality: true, marketing: false };
    
    setCookie('ulixai_cookie_preferences', JSON.stringify(defaults), 365);
    
    document.getElementById('performanceToggle').classList.toggle('active', defaults.performance);
    document.getElementById('functionalityToggle').classList.toggle('active', defaults.functionality);
    document.getElementById('marketingToggle').classList.toggle('active', defaults.marketing);
    
    showNotification('🔄 Preferences reset to default!');
  }

  // Supprimer toutes les données
  function deleteAllData() {
    if (confirm('⚠️ Are you sure you want to delete all your stored preferences? This action cannot be undone.')) {
      // Supprimer le cookie en définissant une date d'expiration passée
      document.cookie = 'ulixai_cookie_preferences=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      
      // Réinitialiser l'affichage
      document.getElementById('performanceToggle').classList.toggle('active', true);
      document.getElementById('functionalityToggle').classList.toggle('active', true);
      document.getElementById('marketingToggle').classList.toggle('active', false);
      
      showNotification('🗑️ All your stored data has been deleted!');
    }
  }

  // Notification
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-6 right-6 bg-white text-gray-800 px-6 py-3 rounded-full shadow-xl font-bold z-50 animate-pulse';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => notification.remove(), 3000);
  }

  // Initialiser au chargement
  document.addEventListener('DOMContentLoaded', initPreferences);
</script>

</body>
</html>