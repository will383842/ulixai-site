<!-- 
============================================
🚀 STEP 3 - SPOKEN LANGUAGES (CORRECTED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 11 langues avec drapeaux
💎 Validation et états interactifs
⚡ Responsive 2 cols mobile / 3 cols / 4 cols desktop
🔧 Intégré avec wizard-steps.js
✅ Persistance des sélections au retour en arrière
============================================
-->

<div id="step3" class="hidden flex flex-col h-full" role="region" aria-label="Select languages you speak">
  
  <!-- ============================================
       TITRE FIXE (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 blobs animés -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
          </svg>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What Languages Do You Speak? 💬
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select all the languages you can communicate in
        </p>
      </div>

      <!-- Counter Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step3SelectedCount">0</span> language(s) selected
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Error Alert (Hidden by default) -->
    <div id="step3LanguageError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select at least one language</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose the languages you can speak</p>
        </div>
      </div>
    </div>

    <!-- Languages Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-3 lg:gap-3.5" role="group" aria-label="Select languages you speak">
      
      <!-- English -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="English"
        role="checkbox"
        aria-checked="false"
        aria-label="Select English">
        <div class="flag-container">
          <img src="https://flagcdn.com/us.svg" alt="English flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">English</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- French -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="French"
        role="checkbox"
        aria-checked="false"
        aria-label="Select French">
        <div class="flag-container">
          <img src="https://flagcdn.com/fr.svg" alt="French flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">French</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Spanish -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Spanish"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Spanish">
        <div class="flag-container">
          <img src="https://flagcdn.com/es.svg" alt="Spanish flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Spanish</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Portuguese -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Portuguese"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Portuguese">
        <div class="flag-container">
          <img src="https://flagcdn.com/pt.svg" alt="Portuguese flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Portuguese</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- German -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="German"
        role="checkbox"
        aria-checked="false"
        aria-label="Select German">
        <div class="flag-container">
          <img src="https://flagcdn.com/de.svg" alt="German flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">German</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Italian -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Italian"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Italian">
        <div class="flag-container">
          <img src="https://flagcdn.com/it.svg" alt="Italian flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Italian</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Arabic -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Arabic"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Arabic">
        <div class="flag-container">
          <img src="https://flagcdn.com/sa.svg" alt="Arabic flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Arabic</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Russian -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Russian"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Russian">
        <div class="flag-container">
          <img src="https://flagcdn.com/ru.svg" alt="Russian flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Russian</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Chinese -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Chinese"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Chinese">
        <div class="flag-container">
          <img src="https://flagcdn.com/cn.svg" alt="Chinese flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Chinese</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Japanese -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Japanese"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Japanese">
        <div class="flag-container">
          <img src="https://flagcdn.com/jp.svg" alt="Japanese flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Japanese</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Hindi -->
      <button 
        type="button"
        class="lang-btn language-card"
        data-lang="Hindi"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Hindi">
        <div class="flag-container">
          <img src="https://flagcdn.com/in.svg" alt="Hindi flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Hindi</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>
      
    </div>
  </div>
</div>

<style>
/* ============================================
   🎨 STEP 3 - MODERN DESIGN SYSTEM
   Consistent with Step 2
   ============================================ */

/* Container */
#step3 {
  position: relative;
  min-height: 100%;
}

/* Sticky Header */
#step3 .sticky {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Language Card Base */
#step3 .lang-btn,
#step3 .language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.625rem;
  padding: 0.875rem 0.625rem;
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e2e8f0;
  border-radius: 1rem;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  min-height: 100px;
}

#step3 .lang-btn:hover,
#step3 .language-card:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
  border-color: #60a5fa;
  background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
}

#step3 .lang-btn:active,
#step3 .language-card:active {
  transform: translateY(-2px) scale(1);
}

/* Selected State */
#step3 .lang-btn.selected,
#step3 .language-card.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  border-color: #1d4ed8;
  color: white;
  box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.5);
  transform: scale(1.05);
}

#step3 .lang-btn.selected:hover,
#step3 .language-card.selected:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6);
}

/* Flag Container */
#step3 .flag-container {
  width: 3rem;
  height: 2.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 0.375rem;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}

#step3 .lang-btn:hover .flag-container,
#step3 .language-card:hover .flag-container {
  transform: scale(1.1) rotate(5deg);
}

#step3 .lang-btn.selected .flag-container,
#step3 .language-card.selected .flag-container {
  transform: scale(1.15);
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
}

#step3 .flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Language Name */
#step3 .language-name {
  font-size: 0.875rem;
  font-weight: 600;
  text-align: center;
  line-height: 1.3;
  color: #1e293b;
  transition: color 0.2s;
}

#step3 .lang-btn.selected .language-name,
#step3 .language-card.selected .language-name {
  color: white;
}

/* Check Indicator */
#step3 .check-indicator {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  width: 1.375rem;
  height: 1.375rem;
  background: #22c55e;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
  box-shadow: 0 2px 8px rgba(34, 197, 94, 0.4);
}

#step3 .lang-btn.selected .check-indicator,
#step3 .language-card.selected .check-indicator {
  opacity: 1;
  transform: scale(1);
}

/* ============================================
   📱 RESPONSIVE
   ============================================ */

/* Mobile - 2 colonnes */
@media (max-width: 639px) {
  #step3 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step3 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step3 p {
    font-size: 0.8125rem;
  }
  
  #step3 .lang-btn,
  #step3 .language-card {
    padding: 0.75rem 0.5rem;
    min-height: 90px;
  }
  
  #step3 .flag-container {
    width: 2.75rem;
    height: 2rem;
  }
  
  #step3 .language-name {
    font-size: 0.8125rem;
  }
}

/* Tablette - 3 colonnes */
@media (min-width: 640px) and (max-width: 1023px) {
  #step3 .lang-btn,
  #step3 .language-card {
    padding: 0.875rem 0.625rem;
  }
  
  #step3 .flag-container {
    width: 3.25rem;
    height: 2.375rem;
  }
}

/* Desktop - 4 colonnes */
@media (min-width: 1024px) {
  #step3 .lang-btn,
  #step3 .language-card {
    padding: 1rem 0.75rem;
  }
  
  #step3 .flag-container {
    width: 3.5rem;
    height: 2.5rem;
  }
  
  #step3 .language-name {
    font-size: 0.9375rem;
  }
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step3 .lang-btn,
  #step3 .language-card {
    border: 3px solid currentColor;
  }
  
  #step3 .lang-btn.selected,
  #step3 .language-card.selected {
    border: 3px solid #1d4ed8;
  }
}
</style>

<script>
/* ============================================
   🎯 STEP 3 - CORRECTED VERSION
   ✅ Intégré avec wizard-steps.js
   ✅ Persistance des sélections
   ============================================ */

// État global
window.spokenLanguages = [];

// Cache des éléments DOM
let cachedElementsStep3 = null;

function getCachedElementsStep3() {
  if (!cachedElementsStep3) {
    cachedElementsStep3 = {
      cards: document.querySelectorAll('#step3 .lang-btn'),
      errorAlert: document.getElementById('step3LanguageError'),
      selectedCount: document.getElementById('step3SelectedCount')
    };
  }
  return cachedElementsStep3;
}

// Fonction de sélection de langue (accessible depuis le header)
window.selectSpokenLanguage = function(card) {
  if (!card) return;
  
  const elements = getCachedElementsStep3();
  const language = card.getAttribute('data-lang');
  
  // Toggle sélection (multi-sélection)
  const index = window.spokenLanguages.indexOf(language);
  
  if (index > -1) {
    // Désélectionner
    window.spokenLanguages.splice(index, 1);
    card.classList.remove('selected');
    card.setAttribute('aria-checked', 'false');
  } else {
    // Sélectionner
    window.spokenLanguages.push(language);
    card.classList.add('selected');
    card.setAttribute('aria-checked', 'true');
  }
  
  // Mettre à jour le compteur
  if (elements.selectedCount) {
    elements.selectedCount.textContent = window.spokenLanguages.length;
  }
  
  // Sauvegarder dans localStorage
  try {
    const data = JSON.parse(localStorage.getItem('provider-signup-data') || '{}');
    data.spoken_languages = window.spokenLanguages;
    localStorage.setItem('provider-signup-data', JSON.stringify(data));
  } catch (e) {
    console.warn('localStorage not available:', e.message);
  }
  
  // Cacher l'erreur si visible
  if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
    elements.errorAlert.classList.add('hidden');
  }
  
  // ✅ Notifier wizard-steps.js
  if (typeof window.updateNavigationButtons === 'function') {
    window.updateNavigationButtons();
  }
};

// Fonction de validation (accessible depuis le header)
window.validateStep3 = function() {
  const elements = getCachedElementsStep3();
  
  if (!window.spokenLanguages || window.spokenLanguages.length === 0) {
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    return false;
  }
  
  return true;
};

// Initialisation optimisée (event delegation + passive listeners)
document.addEventListener('DOMContentLoaded', function() {
  const elements = getCachedElementsStep3();
  
  // Event delegation pour meilleure performance
  const container = document.querySelector('#step3');
  if (!container) return;
  
  // Un seul listener au lieu de 11 (optimisation CPU)
  container.addEventListener('click', function(e) {
    const card = e.target.closest('.lang-btn');
    if (card) {
      window.selectSpokenLanguage(card);
    }
  }, { passive: true });
  
  // Support clavier avec event delegation
  container.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      const card = e.target.closest('.lang-btn');
      if (card) {
        e.preventDefault();
        window.selectSpokenLanguage(card);
      }
    }
  });
  
  // Observer pour détecter quand le step devient visible
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
        if (!container.classList.contains('hidden')) {
          // ✅ Notifier wizard-steps.js
          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }
        }
      }
    });
  });
  
  observer.observe(container, { attributes: true });
  
  // Restaurer la sélection depuis localStorage
  try {
    const data = JSON.parse(localStorage.getItem('provider-signup-data') || '{}');
    if (data.spoken_languages && Array.isArray(data.spoken_languages)) {
      window.spokenLanguages = data.spoken_languages;
      
      // Utiliser requestAnimationFrame pour éviter layout thrashing
      requestAnimationFrame(() => {
        window.spokenLanguages.forEach(lang => {
          const savedCard = document.querySelector(`#step3 .lang-btn[data-lang="${lang}"]`);
          if (savedCard) {
            savedCard.classList.add('selected');
            savedCard.setAttribute('aria-checked', 'true');
          }
        });
        
        // Mise à jour de l'UI
        if (elements.selectedCount) {
          elements.selectedCount.textContent = window.spokenLanguages.length;
        }
        
        // ✅ Notifier wizard-steps.js
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      });
    }
  } catch (e) {
    console.warn('Could not restore selection:', e.message);
  }
});
</script>