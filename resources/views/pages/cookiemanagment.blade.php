@include('includes.header')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  
  <title>Cookie Preferences | Ulixai & SOS-Expat - Your Privacy, Your Choice</title>
  <meta name="description" content="Manage your cookie preferences at Ulixai.com and SOS-Expat.com. We believe in transparency and giving you control over your data.">
  
  <script src="https://cdn.tailwindcss.com"></script>
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

    /* Toggle Switch - Checkbox Stylisé */
    .toggle-checkbox {
      display: none;
    }

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
      display: inline-block;
    }

    .toggle-checkbox:checked + .toggle-switch {
      background: linear-gradient(135deg, #0ea5e9, #06b6d4);
      border-color: #0284c7;
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

    .toggle-checkbox:checked + .toggle-switch::after {
      left: calc(100% - 1.5rem - 2px);
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .bg-pattern {
      background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%233b82f6" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
      opacity: 0.4;
    }

    @media (max-width: 640px) {
      body { font-size: 13px; }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">

<!-- HERO SECTION -->
<section class="relative py-16 px-4 text-center overflow-hidden" role="banner">
  <div class="absolute inset-0 bg-pattern"></div>
  
  <div class="absolute top-0 left-0 right-0 bg-gradient-to-r from-purple-400 via-pink-400 to-blue-400 py-2 px-3 overflow-hidden">
    <div class="flex items-center justify-center gap-2 text-white font-bold text-xs md:text-sm animate-pulse">
      <span class="text-lg">🍪</span>
      <span>YOUR PRIVACY MATTERS TO US</span>
      <span class="text-lg">•</span>
      <span>YOU'RE IN CONTROL</span>
      <span class="text-lg">✨</span>
    </div>
  </div>
  
  <div class="relative max-w-4xl mx-auto pt-8">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
      <span class="gradient-text">Your Privacy, Your Choice</span>
    </h1>
    
    <p class="text-lg text-gray-700 mb-6 max-w-2xl mx-auto">
      At Ulixai.com and SOS-Expat.com, we believe transparency is key. Manage your cookie preferences below and take control of your data. <strong>No tricks, no surprises—just honest choices.</strong>
    </p>
    
    <div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-100 to-emerald-100 border-2 border-green-300 rounded-full px-4 py-2">
      <span class="text-lg">✅</span>
      <span class="text-green-800 font-bold text-sm">100% Transparent • Always Optional</span>
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
          <label class="flex items-center cursor-not-allowed opacity-60">
            <input type="checkbox" class="toggle-checkbox" disabled checked>
            <span class="toggle-switch"></span>
          </label>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border-2 border-green-200 hover:border-green-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">📊 Performance Analytics</h3>
            <p class="text-gray-600 text-sm">Help us understand how you use our platforms</p>
          </div>
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" class="toggle-checkbox" id="performanceToggle">
            <span class="toggle-switch"></span>
          </label>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">⚙️ Functionality</h3>
            <p class="text-gray-600 text-sm">Remember your preferences & settings</p>
          </div>
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" class="toggle-checkbox" id="functionalityToggle">
            <span class="toggle-switch"></span>
          </label>
        </div>

        <div class="flex items-center justify-between p-5 bg-gradient-to-r from-pink-50 to-rose-50 rounded-xl border-2 border-pink-200 hover:border-pink-400 transition-all">
          <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-lg">📣 Marketing & Ads</h3>
            <p class="text-gray-600 text-sm">Personalized ads across platforms</p>
          </div>
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" class="toggle-checkbox" id="marketingToggle">
            <span class="toggle-switch"></span>
          </label>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-6">
          <button 
            type="submit" 
            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg"
          >
            💾 Save My Preferences
          </button>
          <button 
            type="button" 
            onclick="resetPreferences()"
            class="flex-1 bg-gradient-to-r from-gray-300 to-gray-400 hover:from-gray-400 hover:to-gray-500 text-gray-800 font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg"
          >
            🔄 Reset to Default
          </button>
        </div>

        <div class="pt-4 border-t-2 border-gray-200">
          <button 
            type="button" 
            onclick="deleteAllData()"
            class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 hover:scale-105 shadow-lg"
          >
            🗑️ Delete All My Stored Data
          </button>
        </div>
      </form>

      <div id="statusMessage" class="mt-6 p-4 bg-blue-100 border-2 border-blue-300 rounded-xl">
        <p class="text-blue-900 text-center text-sm">
          <strong>💡 Pro Tip:</strong> You can change these settings anytime. Your preferences are saved locally in your browser.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section class="py-12 px-4">
  <div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
      <h2 class="text-3xl md:text-4xl font-bold text-blue-800 mb-3">
        Common Questions ❓
      </h2>
    </div>

    <div class="space-y-4">
      <details class="bg-white rounded-lg p-5 border-2 border-gray-200 cursor-pointer group hover:border-blue-400 transition-all">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🔒 Are my cookies secure?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Yes! Your preferences are stored locally in your browser (localStorage), which means they never leave your device. We follow international privacy standards and best practices. Your data is never sold to third parties.
        </p>
      </details>

      <details class="bg-white rounded-lg p-5 border-2 border-gray-200 cursor-pointer group hover:border-blue-400 transition-all">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🗑️ How do I delete cookies?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Click the "Delete All My Stored Data" button on this page, or open your browser settings, go to Privacy & Security, and select "Clear Browsing Data." On mobile, the process varies by device. After deletion, your preferences will reset to defaults.
        </p>
      </details>

      <details class="bg-white rounded-lg p-5 border-2 border-gray-200 cursor-pointer group hover:border-blue-400 transition-all">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>📵 What if I reject all optional cookies?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          No problem! The site works perfectly without optional cookies. You'll just lose some personalization features like saved preferences. Strictly necessary cookies will remain active because we need them for security and basic functionality.
        </p>
      </details>

      <details class="bg-white rounded-lg p-5 border-2 border-gray-200 cursor-pointer group hover:border-blue-400 transition-all">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>🌍 How long do you keep my preferences?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Your cookie preferences are stored locally in your browser and remain saved indefinitely until you delete them. This means you won't have to set your preferences again each time you visit. You have full control: change them anytime on this page, or remove them using "Delete All My Stored Data" or your browser settings.
        </p>
      </details>

      <details class="bg-white rounded-lg p-5 border-2 border-gray-200 cursor-pointer group hover:border-blue-400 transition-all">
        <summary class="flex items-center justify-between font-bold text-lg text-blue-800 hover:text-blue-600 transition-colors">
          <span>✉️ Do third parties see my data?</span>
          <span class="text-2xl group-open:rotate-180 transition-transform">▼</span>
        </summary>
        <p class="text-gray-600 mt-3 pt-3 border-t-2 border-gray-200">
          Never without your consent. Your preferences stay on your device. We only use Google Analytics for anonymized traffic data (no personal info). Marketing cookies are only active if you opt-in. Partners like Facebook or Google only see anonymized, aggregated insights—never your personal details.
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
    <div class="text-5xl mb-4">🎉</div>
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
      >
        <span>📧 Contact Us</span>
      </a>
      <a 
        href="/privacy-policy" 
        class="inline-flex items-center gap-2 bg-blue-400 text-white px-6 py-3 rounded-full font-bold hover:bg-blue-500 transition-all duration-300 hover:scale-105 shadow-xl"
      >
        <span>📖 Privacy Policy</span>
      </a>
    </div>
  </div>
</section>

@include('includes.footer')

<script>
  const COOKIE_STORAGE_KEY = 'cookieConsent';
  const CONSENT_VERSION = '1.0';

  const defaultPreferences = {
    strictly_necessary: true,
    performance: true,
    functionality: true,
    marketing: false
  };

  function getStoredPreferences() {
    const stored = localStorage.getItem(COOKIE_STORAGE_KEY);
    
    if (!stored) {
      return defaultPreferences;
    }

    try {
      const data = JSON.parse(stored);
      
      if (data.preferences && data.version) {
        return data.preferences;
      }
      
      if (data.strictly_necessary !== undefined) {
        return data;
      }
      
      return defaultPreferences;
    } catch (e) {
      console.error('Erreur de parsing des préférences:', e);
      return defaultPreferences;
    }
  }

  function initPreferences() {
    const prefs = getStoredPreferences();
    
    document.getElementById('performanceToggle').checked = prefs.performance;
    document.getElementById('functionalityToggle').checked = prefs.functionality;
    document.getElementById('marketingToggle').checked = prefs.marketing;
  }

  function updateToggle(elementId, isActive) {
    const toggle = document.getElementById(elementId);
    if (toggle) {
      toggle.checked = isActive;
    }
  }

  document.getElementById('cookieForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const preferences = {
      strictly_necessary: true,
      performance: document.getElementById('performanceToggle').checked,
      functionality: document.getElementById('functionalityToggle').checked,
      marketing: document.getElementById('marketingToggle').checked
    };
    
    const consentData = {
      version: CONSENT_VERSION,
      timestamp: new Date().toISOString(),
      preferences: preferences
    };
    
    localStorage.setItem(COOKIE_STORAGE_KEY, JSON.stringify(consentData));
    
    showNotification('✅ Your preferences have been saved!');
    
    window.dispatchEvent(new CustomEvent('cookieConsentUpdated', { 
      detail: preferences 
    }));
    
    console.log('✅ Préférences sauvegardées:', preferences);
  });

  function resetPreferences() {
    const consentData = {
      version: CONSENT_VERSION,
      timestamp: new Date().toISOString(),
      preferences: defaultPreferences
    };
    
    localStorage.setItem(COOKIE_STORAGE_KEY, JSON.stringify(consentData));
    
    document.getElementById('performanceToggle').checked = defaultPreferences.performance;
    document.getElementById('functionalityToggle').checked = defaultPreferences.functionality;
    document.getElementById('marketingToggle').checked = defaultPreferences.marketing;
    
    showNotification('🔄 Preferences reset to default!');
    
    window.dispatchEvent(new CustomEvent('cookieConsentUpdated', { 
      detail: defaultPreferences 
    }));
  }

  function deleteAllData() {
    if (confirm('⚠️ Are you sure you want to delete all your stored preferences? This action cannot be undone.')) {
      localStorage.removeItem(COOKIE_STORAGE_KEY);
      
      document.getElementById('performanceToggle').checked = defaultPreferences.performance;
      document.getElementById('functionalityToggle').checked = defaultPreferences.functionality;
      document.getElementById('marketingToggle').checked = defaultPreferences.marketing;
      
      showNotification('🗑️ All your stored data has been deleted!');
      
      window.dispatchEvent(new CustomEvent('cookieConsentUpdated', { 
        detail: defaultPreferences 
      }));
    }
  }

  function showNotification(message) {
    const statusDiv = document.getElementById('statusMessage');
    const originalContent = statusDiv.innerHTML;
    
    statusDiv.innerHTML = `<p class="text-center text-sm font-bold">${message}</p>`;
    statusDiv.classList.remove('bg-blue-100', 'border-blue-300');
    statusDiv.classList.add('bg-green-100', 'border-green-300', 'text-green-900');
    
    setTimeout(() => {
      statusDiv.innerHTML = originalContent;
      statusDiv.classList.add('bg-blue-100', 'border-blue-300');
      statusDiv.classList.remove('bg-green-100', 'border-green-300', 'text-green-900');
    }, 3000);
  }

  document.addEventListener('DOMContentLoaded', initPreferences);
</script>

</body>
</html>