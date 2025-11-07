<!-- 
============================================
🚀 STEP 2 - NATIVE LANGUAGE SELECTION (CORRECTED)
============================================
✨ Blue/Cyan/Teal Design System STRICT
🎨 13 languages with flags
💎 Validation and interactive states
⚡ Responsive 2 cols mobile / 3 cols desktop
🔧 Proper button management (enable/disable)
✅ Selection persistence on back navigation
============================================
-->

<div id="step2" class="hidden flex flex-col h-full" role="region" aria-label="Select your native language">
  
  <!-- ============================================
       FIXED HEADER (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 animated blobs -->
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
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          What's Your Native Language? 🌍
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select the language you speak fluently
        </p>
      </div>

      <!-- Counter Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step2SelectedCount">0</span> / 1 selected
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       SCROLLABLE CONTENT
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Error Alert (Hidden by default) -->
    <div id="step2LanguageError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select your native language</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose one language to continue</p>
        </div>
      </div>
    </div>

    <!-- Languages Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-3 lg:gap-3.5" role="radiogroup" aria-label="Select your native language">
      
      <!-- English -->
      <button 
        type="button"
        class="language-card"
        data-language="English"
        role="radio"
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

      <!-- Spanish -->
      <button 
        type="button"
        class="language-card"
        data-language="Spanish"
        role="radio"
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

      <!-- French -->
      <button 
        type="button"
        class="language-card"
        data-language="French"
        role="radio"
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

      <!-- German -->
      <button 
        type="button"
        class="language-card"
        data-language="German"
        role="radio"
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
        class="language-card"
        data-language="Italian"
        role="radio"
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

      <!-- Portuguese -->
      <button 
        type="button"
        class="language-card"
        data-language="Portuguese"
        role="radio"
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

      <!-- Russian -->
      <button 
        type="button"
        class="language-card"
        data-language="Russian"
        role="radio"
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
        class="language-card"
        data-language="Chinese"
        role="radio"
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
        class="language-card"
        data-language="Japanese"
        role="radio"
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

      <!-- Arabic -->
      <button 
        type="button"
        class="language-card"
        data-language="Arabic"
        role="radio"
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

      <!-- Hindi -->
      <button 
        type="button"
        class="language-card"
        data-language="Hindi"
        role="radio"
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

      <!-- Korean -->
      <button 
        type="button"
        class="language-card"
        data-language="Korean"
        role="radio"
        aria-checked="false"
        aria-label="Select Korean">
        <div class="flag-container">
          <img src="https://flagcdn.com/kr.svg" alt="Korean flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Korean</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Dutch -->
      <button 
        type="button"
        class="language-card"
        data-language="Dutch"
        role="radio"
        aria-checked="false"
        aria-label="Select Dutch">
        <div class="flag-container">
          <img src="https://flagcdn.com/nl.svg" alt="Dutch flag" class="flag-image" loading="lazy" />
        </div>
        <span class="language-name">Dutch</span>
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
   🎨 STEP 2 - MODERN DESIGN SYSTEM
   ============================================ */

/* Container */
#step2 {
  position: relative;
  min-height: 100%;
}

/* Sticky Header */
#step2 .sticky {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Ambient Background Animation */
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Language Card Base */
#step2 .language-card {
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

#step2 .language-card:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
  border-color: #60a5fa;
  background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
}

#step2 .language-card:active {
  transform: translateY(-2px) scale(1);
}

/* Selected State */
#step2 .language-card.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  border-color: #1d4ed8;
  color: white;
  box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.5);
  transform: scale(1.05);
}

#step2 .language-card.selected:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6);
}

/* Flag Container */
#step2 .flag-container {
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

#step2 .language-card:hover .flag-container {
  transform: scale(1.1) rotate(5deg);
}

#step2 .language-card.selected .flag-container {
  transform: scale(1.15);
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
}

#step2 .flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Language Name */
#step2 .language-name {
  font-size: 0.875rem;
  font-weight: 600;
  text-align: center;
  line-height: 1.3;
  color: #1e293b;
  transition: color 0.2s;
}

#step2 .language-card.selected .language-name {
  color: white;
}

/* Check Indicator */
#step2 .check-indicator {
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

#step2 .language-card.selected .check-indicator {
  opacity: 1;
  transform: scale(1);
}

/* Error Alert */
.shake-animation {
  animation: shake 0.4s;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

/* ============================================
   📱 RESPONSIVE
   ============================================ */

/* Mobile - 2 columns */
@media (max-width: 639px) {
  #step2 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step2 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step2 p {
    font-size: 0.8125rem;
  }
  
  #step2 .language-card {
    padding: 0.75rem 0.5rem;
    min-height: 90px;
  }
  
  #step2 .flag-container {
    width: 2.75rem;
    height: 2rem;
  }
  
  #step2 .language-name {
    font-size: 0.8125rem;
  }
}

/* Tablet - 3 columns */
@media (min-width: 640px) and (max-width: 1023px) {
  #step2 .language-card {
    padding: 0.875rem 0.625rem;
  }
  
  #step2 .flag-container {
    width: 3.25rem;
    height: 2.375rem;
  }
}

/* Desktop - 4 columns, popup adaptation */
@media (min-width: 1024px) {
  #step2 .language-card {
    padding: 1rem 0.75rem;
  }
  
  #step2 .flag-container {
    width: 3.5rem;
    height: 2.5rem;
  }
  
  #step2 .language-name {
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
  #step2 .language-card {
    border: 3px solid currentColor;
  }
  
  #step2 .language-card.selected {
    border: 3px solid #1d4ed8;
  }
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

#step2 .language-card,
#step2 .check-indicator,
#step2 .flag-container {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

#step2 .language-card {
  contain: layout style paint;
}
</style>

<script>
/**
 * STEP 2 - Native Language (Hardened)
 * - capture-phase delegation (survives stopPropagation)
 * - toggles .selected + aria-checked
 * - stores in hidden #nativeLanguage + localStorage (expats)
 * - exposes window.validateStep2()
 * - triggers window.updateNavigationButtons() after selection
 */
(function(){
  var step2 = document.getElementById('step2');
  if (!step2) return;
  var storageKey = 'expats';
  var countEl = document.getElementById('step2SelectedCount');

  function setCount(n){ if (countEl) countEl.textContent = String(n); }
  function cards(){ return Array.prototype.slice.call(step2.querySelectorAll('.language-card')); }
  function langFromCard(card){
    if (!card) return '';
    var byData = (card.getAttribute('data-language') || '').trim();
    if (byData) return byData;
    var byChild = card.querySelector('[data-language]');
    if (byChild) { var v = (byChild.getAttribute('data-language') || '').trim(); if (v) return v; }
    var byName = card.querySelector('.language-name');
    return byName ? (byName.textContent || '').trim() : '';
  }
  function ensureHidden(){
    var el = document.getElementById('nativeLanguage') || step2.querySelector('input[name="native_language"]');
    if (!el) {
      el = document.createElement('input');
      el.type = 'hidden';
      el.id = 'nativeLanguage';
      el.name = 'native_language';
      step2.appendChild(el);
    }
    return el;
  }
  function setState(lang){
    try {
      var raw = localStorage.getItem(storageKey) || '{}';
      var s = JSON.parse(raw);
      s.native_language = lang;
      localStorage.setItem(storageKey, JSON.stringify(s));
    } catch(_) {}
  }
  function select(card){
    var lang = langFromCard(card);
    if (!lang) return;
    // reset
    cards().forEach(function(c){ 
      c.classList.remove('selected'); 
      c.setAttribute('aria-checked','false'); 
      c.removeAttribute('data-selected');
    });
    // mark
    card.classList.add('selected');
    card.setAttribute('aria-checked','true');
    card.setAttribute('data-selected','true');
    // hidden + state
    var hidden = ensureHidden();
    hidden.value = lang;
    window.selectedLanguage = lang;
    setState(lang);
    setCount(1);
    
    // ✅ NOTIFICATION + NAV RECALCULATION (applied correction)
    try { 
      document.dispatchEvent(new CustomEvent('pw:step2:changed')); 
    } catch(_) {}
    
    // ✅ Update navigation buttons
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  }

  // Validator consulted by wizard-steps.js
  window.validateStep2 = function(){
    if (window.selectedLanguage && String(window.selectedLanguage).trim()) return true;
    var hidden = document.getElementById('nativeLanguage') || step2.querySelector('input[name="native_language"]');
    if (hidden && String(hidden.value||'').trim()) return true;
    if (step2.querySelector('.language-card.selected, .language-card[aria-checked="true"], .language-card[data-selected="true"]')) return true;
    return false;
  };

  // Capture-phase click + keyboard (survives stopPropagation)
  document.addEventListener('click', function(e){
    var t = e.target;
    var card = t && t.closest ? t.closest('#step2 .language-card') : null;
    if (card) { e.preventDefault(); select(card); }
  }, true);
  document.addEventListener('keydown', function(e){
    if (e.key === 'Enter' || e.key === ' ') {
      var t = e.target;
      var card = t && t.closest ? t.closest('#step2 .language-card') : null;
      if (card) { e.preventDefault(); select(card); }
    }
  }, true);

  // Restore previous selection
  document.addEventListener('DOMContentLoaded', function(){
    try {
      var raw = localStorage.getItem(storageKey) || '{}';
      var s = JSON.parse(raw);
      var lang = (s.native_language || '').trim();
      if (lang) {
        var all = cards();
        var match = null;
        for (var i=0;i<all.length;i++){ if (langFromCard(all[i]) === lang) { match = all[i]; break; } }
        if (match) select(match); else setCount(0);
      } else {
        setCount(0);
        if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
      }
    } catch(_) {
      setCount(0);
      if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
    }
  }, { once: true });
})();
</script>