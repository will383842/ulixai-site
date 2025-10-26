<!-- 
============================================
🚀 STEP 3 - SPOKEN LANGUAGES (2025/2026)
============================================
✨ Multi-sélection avec images drapeaux réels
🎨 Design System Blue/Cyan/Teal STRICT
💎 13 langues disponibles
⚡ Validation et localStorage
============================================
-->

<div id="step3" class="hidden space-y-6 sm:space-y-8 relative" role="region" aria-label="Select languages you speak">
  
  <!-- Ambient Background Effects - 3 blobs animés -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <!-- Header Section -->
  <div class="text-center space-y-4">
    <!-- Icon Badge -->
    <div class="flex justify-center">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
      </div>
    </div>
    
    <!-- Title & Subtitle -->
    <div>
      <h2 class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-2 tracking-tight">
        What Languages Do You Speak? 💬
      </h2>
      <p class="text-base sm:text-lg font-semibold text-gray-600">
        Select all the languages you can communicate in
      </p>
    </div>

    <!-- Counter Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span class="text-sm font-bold text-blue-700">
        <span id="selectionCount">0</span> language(s) selected
      </span>
    </div>

    <!-- Selected Languages Display -->
    <div id="selectedLanguages" class="flex flex-wrap justify-center gap-2 min-h-[32px]"></div>
  </div>

  <!-- Error Alert (Hidden by default) -->
  <div id="languageError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-4 shake-animation" role="alert">
    <div class="flex items-start gap-3">
      <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
      </svg>
      <div>
        <p class="text-sm font-semibold text-red-800">Please select at least one language</p>
        <p class="text-xs text-red-600 mt-1">You must choose the languages you can speak</p>
      </div>
    </div>
  </div>

  <!-- Languages Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4" role="group" aria-label="Select languages you speak">
    
    <!-- Arabic -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Arabic" aria-label="Select Arabic">
      <div class="flag-container">
        <img src="https://flagcdn.com/sa.svg" alt="Arabic flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Arabic</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Chinese -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Chinese" aria-label="Select Chinese">
      <div class="flag-container">
        <img src="https://flagcdn.com/cn.svg" alt="Chinese flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Chinese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- English -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="English" aria-label="Select English">
      <div class="flag-container">
        <img src="https://flagcdn.com/us.svg" alt="English flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">English</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- French -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="French" aria-label="Select French">
      <div class="flag-container">
        <img src="https://flagcdn.com/fr.svg" alt="French flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">French</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- German -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="German" aria-label="Select German">
      <div class="flag-container">
        <img src="https://flagcdn.com/de.svg" alt="German flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">German</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Hindi -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Hindi" aria-label="Select Hindi">
      <div class="flag-container">
        <img src="https://flagcdn.com/in.svg" alt="Hindi flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Hindi</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Italian -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Italian" aria-label="Select Italian">
      <div class="flag-container">
        <img src="https://flagcdn.com/it.svg" alt="Italian flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Italian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Japanese -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Japanese" aria-label="Select Japanese">
      <div class="flag-container">
        <img src="https://flagcdn.com/jp.svg" alt="Japanese flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Japanese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Korean -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Korean" aria-label="Select Korean">
      <div class="flag-container">
        <img src="https://flagcdn.com/kr.svg" alt="Korean flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Korean</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Portuguese -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Portuguese" aria-label="Select Portuguese">
      <div class="flag-container">
        <img src="https://flagcdn.com/pt.svg" alt="Portuguese flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Portuguese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Russian -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Russian" aria-label="Select Russian">
      <div class="flag-container">
        <img src="https://flagcdn.com/ru.svg" alt="Russian flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Russian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Spanish -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Spanish" aria-label="Select Spanish">
      <div class="flag-container">
        <img src="https://flagcdn.com/es.svg" alt="Spanish flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Spanish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Turkish -->
    <button type="button" class="lang-btn spoken-language-card" data-lang="Turkish" aria-label="Select Turkish">
      <div class="flag-container">
        <img src="https://flagcdn.com/tr.svg" alt="Turkish flag" class="flag-image" loading="lazy" />
      </div>
      <span class="language-name">Turkish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

  </div>

  <!-- Hidden input pour stocker les langues sélectionnées -->
  <input type="hidden" id="spokenLanguages" name="spoken_languages" value="">

  <!-- Navigation Buttons -->
  <div class="wizard-nav-container">
    <button 
      type="button"
      id="backToStep2"
      class="nav-btn-back"
      aria-label="Go back to previous step">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      type="button"
      id="nextStep3"
      class="nav-btn-next"
      disabled
      aria-label="Continue to next step">
      <span>Continue</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

</div>

<style>
/* ============================================
   🎨 DESIGN SYSTEM STRICT - STEP 3
   Palette: Blue/Cyan/Teal uniquement
   ============================================ */

/* SPOKEN LANGUAGE CARDS - Multi-sélection */
.spoken-language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1rem 1.25rem; /* p-4 sm:p-5 */
  background: white;
  border: 2px solid #60a5fa; /* border-2 border-blue-400 exact */
  border-radius: 1rem; /* rounded-2xl exact */
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 
    0 4px 6px -1px rgba(59, 130, 246, 0.1),
    0 2px 4px -1px rgba(59, 130, 246, 0.06); /* shadow-md exact */
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
  will-change: transform;
}

@media (min-width: 640px) {
  .spoken-language-card {
    padding: 1.25rem; /* p-5 sur sm: */
  }
}

/* Hover State - Specs exactes */
.spoken-language-card:hover {
  transform: translateY(-0.5rem) scale(1.02); /* -translate-y-2 scale-[1.02] exact */
  box-shadow: 
    0 20px 25px -5px rgba(59, 130, 246, 0.2),
    0 10px 10px -5px rgba(59, 130, 246, 0.1); /* hover:shadow-xl exact */
  border-color: #3b82f6;
}

/* Focus State - Accessibilité */
.spoken-language-card:focus-visible {
  outline: none;
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.5);
}

/* Selected State - Gradient exact from-blue-600 to-cyan-700 */
.spoken-language-card.selected {
  background: linear-gradient(135deg, #2563eb 0%, #0e7490 100%); /* bg-gradient-to-br from-blue-600 to-cyan-700 */
  border-color: #1d4ed8; /* border-blue-700 exact */
  color: white; /* text-white exact */
  transform: translateY(-0.5rem) scale(1.02);
  box-shadow: 
    0 20px 25px -5px rgba(37, 99, 235, 0.3),
    0 10px 10px -5px rgba(37, 99, 235, 0.2);
}

/* Flag Container */
.flag-container {
  width: 3rem;
  height: 2rem;
  border-radius: 0.375rem;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  flex-shrink: 0;
}

.flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Language Name - text-sm sm:text-base font-semibold exact */
.language-name {
  font-size: 0.875rem; /* text-sm */
  line-height: 1.25rem;
  font-weight: 600; /* font-semibold exact */
  color: #111827; /* text-gray-900 exact */
  transition: color 0.3s;
}

@media (min-width: 640px) {
  .language-name {
    font-size: 1rem; /* text-base sur sm: */
    line-height: 1.5rem;
  }
}

.spoken-language-card.selected .language-name {
  color: white;
}

/* Multi-Selection Indicator - w-6 h-6 rounded-full bg-white */
.multi-selection-indicator {
  position: absolute;
  top: 0.5rem; /* top-2 exact */
  right: 0.5rem; /* right-2 exact */
  width: 1.5rem; /* w-6 exact */
  height: 1.5rem; /* h-6 exact */
  background: white; /* bg-white exact */
  border-radius: 9999px; /* rounded-full exact */
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.spoken-language-card.selected .multi-selection-indicator {
  opacity: 1;
  transform: scale(1);
}

.multi-selection-indicator svg {
  color: #2563eb; /* blue-600 */
}

/* Selected Language Badges */
.selected-lang-badge {
  display: inline-flex;
  align-items: center;
  padding: 0.375rem 0.875rem;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  color: white;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 600;
  box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
  transition: all 0.3s;
}

.selected-lang-badge:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(59, 130, 246, 0.4);
}

/* ============================================
   🔘 NAVIGATION BUTTONS - Specs exactes
   ============================================ */

/* Container - flex justify-between gap-4 */
.wizard-nav-container {
  display: flex;
  justify-content: space-between;
  gap: 1rem; /* gap-4 exact */
  margin-top: 2rem;
}

/* Base Button Style - px-6 py-3 rounded-2xl font-bold exact */
.nav-btn-back,
.nav-btn-next {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem; /* px-6 py-3 exact */
  border-radius: 1rem; /* rounded-2xl exact */
  font-weight: 700; /* font-bold exact */
  font-size: 0.875rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  border: 2px solid transparent; /* border-2 exact */
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
}

/* Back Button - bg-white text-blue-600 border-gray-200 exact */
.nav-btn-back {
  background: white; /* bg-white exact */
  color: #2563eb; /* text-blue-600 exact */
  border-color: #e5e7eb; /* border-gray-200 exact */
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.nav-btn-back:hover {
  background: #f9fafb;
  border-color: #d1d5db;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.nav-btn-back:active {
  transform: translateY(0);
}

/* Next Button - bg-gradient-to-r from-blue-600 to-cyan-600 exact */
.nav-btn-next {
  background: linear-gradient(to right, #2563eb 0%, #0891b2 100%); /* from-blue-600 to-cyan-600 exact */
  color: white;
  border-color: transparent;
  box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
  flex: 1;
  justify-content: center;
}

.nav-btn-next:hover:not(:disabled) {
  background: linear-gradient(to right, #1d4ed8 0%, #0e7490 100%);
  transform: translateY(-2px);
  box-shadow: 0 10px 15px rgba(37, 99, 235, 0.4);
}

.nav-btn-next:active:not(:disabled) {
  transform: translateY(0);
}

/* Disabled State */
.nav-btn-next:disabled {
  background: #e5e7eb;
  color: #9ca3af;
  cursor: not-allowed;
  box-shadow: none;
  opacity: 0.6;
}

/* ============================================
   ⚠️ ERROR ALERT - Specs exactes
   ============================================ */

/* bg-red-50 border-l-4 border-red-500 rounded-xl p-4 exact */
#languageError {
  background: #fef2f2; /* bg-red-50 exact */
  border-left: 4px solid #ef4444; /* border-l-4 border-red-500 exact */
  border-radius: 0.75rem; /* rounded-xl exact */
  padding: 1rem; /* p-4 exact */
}

/* Shake Animation */
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
  20%, 40%, 60%, 80% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

/* ============================================
   🎭 ANIMATIONS - Réutilisées
   ============================================ */

/* Animation Blob - Pour ambient background */
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

/* ============================================
   📱 RESPONSIVE OPTIMIZATIONS
   ============================================ */

@media (max-width: 640px) {
  .wizard-nav-container {
    flex-direction: column;
  }
  
  .nav-btn-back,
  .nav-btn-next {
    width: 100%;
    justify-content: center;
  }
  
  .spoken-language-card {
    padding: 0.875rem 1rem;
  }
  
  .flag-container {
    width: 2.5rem;
    height: 1.75rem;
  }
  
  .selected-lang-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.625rem;
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

/* High contrast mode */
@media (prefers-contrast: high) {
  .spoken-language-card {
    border: 3px solid currentColor;
  }
  
  .spoken-language-card.selected {
    border: 3px solid #1d4ed8;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

/* GPU acceleration */
.spoken-language-card,
.multi-selection-indicator,
.flag-container {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

/* Reduce repaints */
.spoken-language-card {
  contain: layout style paint;
}
</style>

<script>
/* ============================================
   🎯 SPOKEN LANGUAGES LOGIC - STEP 3
   ============================================ */

// État global
window.spokenLanguages = [];

// Fonction de mise à jour de l'UI
function updateStep3UI() {
  const selectedCards = document.querySelectorAll('#step3 .spoken-language-card.selected');
  const nextBtn = document.getElementById('nextStep3');
  const counterEl = document.getElementById('selectionCount');
  const selectedContainer = document.getElementById('selectedLanguages');
  const hiddenInput = document.getElementById('spokenLanguages');
  const errorAlert = document.getElementById('languageError');
  
  // Compter les sélections
  const count = selectedCards.length;
  window.spokenLanguages = Array.from(selectedCards).map(card => card.dataset.lang);
  
  // Mettre à jour le compteur
  if (counterEl) {
    counterEl.textContent = count;
  }
  
  // Mettre à jour l'input hidden
  if (hiddenInput) {
    hiddenInput.value = JSON.stringify(window.spokenLanguages);
  }
  
  // Activer/désactiver le bouton Next
  if (nextBtn) {
    nextBtn.disabled = count === 0;
  }
  
  // Cacher l'erreur si visible
  if (errorAlert && !errorAlert.classList.contains('hidden')) {
    errorAlert.classList.add('hidden');
  }
  
  // Afficher les badges des langues sélectionnées
  if (selectedContainer) {
    selectedContainer.innerHTML = '';
    window.spokenLanguages.forEach(lang => {
      const badge = document.createElement('span');
      badge.className = 'selected-lang-badge';
      badge.textContent = lang;
      selectedContainer.appendChild(badge);
    });
  }
  
  // Sauvegarder dans localStorage
  if (window.spokenLanguages.length > 0) {
    localStorage.setItem('spokenLanguages', JSON.stringify(window.spokenLanguages));
  }
}

// Fonction de validation
window.validateStep3 = function() {
  const errorAlert = document.getElementById('languageError');
  
  if (window.spokenLanguages.length === 0) {
    errorAlert.classList.remove('hidden');
    errorAlert.classList.add('shake-animation');
    setTimeout(() => {
      errorAlert.classList.remove('shake-animation');
    }, 500);
    return false;
  }
  
  return true;
};

// Initialisation au chargement
document.addEventListener('DOMContentLoaded', function() {
  const languageCards = document.querySelectorAll('#step3 .spoken-language-card');
  
  // Event listener pour chaque carte de langue
  languageCards.forEach(card => {
    card.addEventListener('click', function() {
      this.classList.toggle('selected');
      updateStep3UI();
    });
    
    // Support clavier
    card.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.classList.toggle('selected');
        updateStep3UI();
      }
    });
  });
  
  // Restaurer depuis localStorage
  const saved = localStorage.getItem('spokenLanguages');
  if (saved) {
    try {
      const languages = JSON.parse(saved);
      languages.forEach(lang => {
        const card = document.querySelector(`#step3 .spoken-language-card[data-lang="${lang}"]`);
        if (card) card.classList.add('selected');
      });
    } catch(e) {
      console.error('Error restoring languages:', e);
    }
  }
  
  // Mise à jour initiale de l'UI
  updateStep3UI();
});
</script>