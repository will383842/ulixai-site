<!-- 
============================================
🚀 STEP 3 - SPOKEN LANGUAGES (2025/2026)
============================================
✨ Multi-selection with visual feedback
🎨 Real flag images with animations
💎 Modern grid layout with counters
⚡ Performance optimized
🔄 Toggle selection support
============================================
-->

<div id="step3" class="hidden">
  
  <!-- Ambient Background Effects -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <!-- Header Section -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg animate-bounce-subtle">
        <span class="text-2xl">💬</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 bg-clip-text text-transparent">
        What Languages do you Speak?
      </h2>
    </div>
    <p class="text-gray-600 text-sm sm:text-base font-medium mb-3">
      Select all the languages you can communicate in
    </p>
    
    <!-- Selection Counter Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-full">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span id="selectionCount" class="text-sm font-bold text-blue-700">
        <span class="selection-number">0</span> language(s) selected
      </span>
    </div>
  </div>

  <!-- Language Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-8 max-w-4xl mx-auto">
    
    <!-- English -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="English">
      <div class="flag-container">
        <img src="https://flagcdn.com/us.svg" alt="English" class="flag-image" />
      </div>
      <span class="language-name">English</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- French -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="French">
      <div class="flag-container">
        <img src="https://flagcdn.com/fr.svg" alt="French" class="flag-image" />
      </div>
      <span class="language-name">French</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Spanish -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Spanish">
      <div class="flag-container">
        <img src="https://flagcdn.com/es.svg" alt="Spanish" class="flag-image" />
      </div>
      <span class="language-name">Spanish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Portuguese -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Portuguese">
      <div class="flag-container">
        <img src="https://flagcdn.com/pt.svg" alt="Portuguese" class="flag-image" />
      </div>
      <span class="language-name">Portuguese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- German -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="German">
      <div class="flag-container">
        <img src="https://flagcdn.com/de.svg" alt="German" class="flag-image" />
      </div>
      <span class="language-name">German</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Italian -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Italian">
      <div class="flag-container">
        <img src="https://flagcdn.com/it.svg" alt="Italian" class="flag-image" />
      </div>
      <span class="language-name">Italian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Arabic -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Arabic">
      <div class="flag-container">
        <img src="https://flagcdn.com/sa.svg" alt="Arabic" class="flag-image" />
      </div>
      <span class="language-name">Arabic</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Japanese -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Japanese">
      <div class="flag-container">
        <img src="https://flagcdn.com/jp.svg" alt="Japanese" class="flag-image" />
      </div>
      <span class="language-name">Japanese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Korean -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Korean">
      <div class="flag-container">
        <img src="https://flagcdn.com/kr.svg" alt="Korean" class="flag-image" />
      </div>
      <span class="language-name">Korean</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Hindi -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Hindi">
      <div class="flag-container">
        <img src="https://flagcdn.com/in.svg" alt="Hindi" class="flag-image" />
      </div>
      <span class="language-name">Hindi</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Turkish -->
    <button type="button" class="lang-btn bg-blue-600 text-white spoken-language-card group" data-lang="Turkish">
      <div class="flag-container">
        <img src="https://flagcdn.com/tr.svg" alt="Turkish" class="flag-image" />
      </div>
      <span class="language-name">Turkish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

  </div>

  <!-- Helper Text -->
  <div class="text-center mb-6">
    <p class="text-sm text-gray-500 italic">
      💡 You can select multiple languages
    </p>
  </div>

  <!-- Navigation Buttons -->
  <div class="flex justify-between items-center gap-4">
    <button 
      id="backToStep2" 
      class="nav-btn-back group">
      <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep3" 
      class="nav-btn-next group">
      <span>Continue</span>
      <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

</div>

<script>
// VALIDATION STRICTE POUR STEP 3
(function() {
  'use strict';
  
  // Fonction de validation
  function validateStep3() {
    const selectedLanguages = document.querySelectorAll('#step3 .lang-btn.bg-blue-900');
    return selectedLanguages.length > 0;
  }
  
  // Bloquer le bouton Next si rien n'est sélectionné
  document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep3');
    
    if (nextBtn) {
      // Intercepter le clic AVANT que le header ne le traite
      nextBtn.addEventListener('click', function(e) {
        if (!validateStep3()) {
          e.stopImmediatePropagation(); // Bloque TOUS les handlers
          e.preventDefault();
          
          // Alert personnalisé moderne
          const alertDiv = document.createElement('div');
          alertDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-2xl z-[9999] animate-bounce-in';
          alertDiv.innerHTML = `
            <div class="flex items-center gap-3">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <div class="font-bold">Selection Required</div>
                <div class="text-sm">Please select at least one spoken language</div>
              </div>
            </div>
          `;
          document.body.appendChild(alertDiv);
          
          // Supprimer l'alert après 3 secondes
          setTimeout(() => {
            alertDiv.style.opacity = '0';
            alertDiv.style.transform = 'translateX(100px)';
            setTimeout(() => alertDiv.remove(), 300);
          }, 3000);
          
          return false;
        }
      }, true); // Capture phase pour être exécuté en premier
    }
  });
})();
</script>

<script>
// Update selection counter dynamically
document.addEventListener('DOMContentLoaded', function() {
  const updateCounter = () => {
    const selectedCount = document.querySelectorAll('#step3 .lang-btn.bg-blue-900').length;
    const counterElement = document.querySelector('#selectionCount .selection-number');
    if (counterElement) {
      counterElement.textContent = selectedCount;
      
      // Add pulse animation on change
      counterElement.parentElement.style.transform = 'scale(1.1)';
      setTimeout(() => {
        counterElement.parentElement.style.transform = 'scale(1)';
      }, 200);
    }
  };
  
  // Listen to clicks on language buttons
  const observer = new MutationObserver(updateCounter);
  const step3 = document.getElementById('step3');
  if (step3) {
    observer.observe(step3, {
      attributes: true,
      attributeFilter: ['class'],
      subtree: true
    });
  }
});
</script>

<style>
@keyframes bounce-in {
  0% {
    opacity: 0;
    transform: translateX(100px);
  }
  60% {
    opacity: 1;
    transform: translateX(-10px);
  }
  100% {
    transform: translateX(0);
  }
}

.animate-bounce-in {
  animation: bounce-in 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transition: all 0.3s;
}

/* ============================================
   🎨 SPOKEN LANGUAGE CARD STYLES (2025/2026)
   ============================================ */

.spoken-language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1.25rem 1rem;
  border: 2px solid #3b82f6;
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
  will-change: transform;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
}

.spoken-language-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(34, 197, 94, 0.05), rgba(59, 130, 246, 0.05));
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.spoken-language-card:hover {
  transform: translateY(-4px) scale(1.02);
  border-color: #22c55e;
  box-shadow: 
    0 20px 25px -5px rgba(34, 197, 94, 0.1),
    0 10px 10px -5px rgba(34, 197, 94, 0.04);
}

.spoken-language-card:hover::before {
  opacity: 1;
}

.spoken-language-card:active {
  transform: translateY(-2px) scale(0.98);
}

/* Selected state - Multiple selection */
.spoken-language-card.bg-blue-900 {
  background: linear-gradient(135deg, #059669, #22c55e);
  border-color: #059669;
  box-shadow: 
    0 20px 25px -5px rgba(34, 197, 94, 0.3),
    0 0 0 4px rgba(34, 197, 94, 0.1);
  transform: translateY(-4px) scale(1.02);
}

.spoken-language-card.bg-blue-900 .language-name {
  color: white;
  font-weight: 700;
}

.spoken-language-card.bg-blue-900 .multi-selection-indicator {
  opacity: 1;
  transform: scale(1);
}

/* Alternate state for variety */
.spoken-language-card.bg-blue-900:nth-child(even) {
  background: linear-gradient(135deg, #0284c7, #3b82f6);
  border-color: #0284c7;
}

/* ============================================
   🏴 FLAG CONTAINER & IMAGE
   ============================================ */

.flag-container {
  width: 3.5rem;
  height: 2.5rem;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  transition: all 0.3s;
  background: #f3f4f6;
}

.flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.spoken-language-card:hover .flag-container {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
  transform: scale(1.05);
}

.spoken-language-card:hover .flag-image {
  transform: scale(1.1);
}

.spoken-language-card.bg-blue-900 .flag-container {
  box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
  transform: scale(1.1);
  border: 2px solid rgba(255, 255, 255, 0.5);
}

.spoken-language-card.bg-blue-900 .flag-image {
  transform: scale(1.15);
}

/* ============================================
   📝 LANGUAGE NAME
   ============================================ */

.language-name {
  font-size: 0.875rem;
  font-weight: 600;
  transition: color 0.3s;
  text-align: center;
}

/* Keep text white on blue background (initial state) */
.spoken-language-card.bg-blue-600 .language-name {
  color: white;
}

/* Change to green on hover when not selected */
.spoken-language-card.bg-blue-600:hover .language-name {
  color: white;
}

/* White text when selected with bg-blue-900 (green gradient) */
.spoken-language-card.bg-blue-900 .language-name {
  color: white;
  font-weight: 700;
}

/* ============================================
   ✅ MULTI-SELECTION INDICATOR
   ============================================ */

.multi-selection-indicator {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  width: 1.75rem;
  height: 1.75rem;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #22c55e;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  border: 2px solid #22c55e;
}

.spoken-language-card.bg-blue-900 .multi-selection-indicator {
  animation: checkmark-pop 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes checkmark-pop {
  0% {
    opacity: 0;
    transform: scale(0) rotate(-180deg);
  }
  50% {
    transform: scale(1.2) rotate(10deg);
  }
  100% {
    opacity: 1;
    transform: scale(1) rotate(0deg);
  }
}

/* ============================================
   📊 SELECTION COUNTER BADGE
   ============================================ */

#selectionCount {
  transition: all 0.3s;
}

#selectionCount .selection-number {
  font-size: 1.125rem;
  font-weight: 800;
  color: #2563eb;
}

/* ============================================
   🎯 NAVIGATION BUTTONS
   ============================================ */

.nav-btn-back,
.nav-btn-next {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 1.5rem;
  font-weight: 600;
  border-radius: 12px;
  transition: all 0.3s;
  cursor: pointer;
  border: none;
  outline: none;
  touch-action: manipulation;
}

.nav-btn-back {
  color: #22c55e;
  background: transparent;
  border: 2px solid transparent;
}

.nav-btn-back:hover {
  background: rgba(34, 197, 94, 0.05);
  border-color: rgba(34, 197, 94, 0.2);
}

.nav-btn-next {
  color: white;
  background: linear-gradient(135deg, #22c55e, #059669);
  box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.3);
  min-width: 140px;
  justify-content: center;
}

.nav-btn-next:hover {
  box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.4);
  transform: translateY(-2px);
}

.nav-btn-next:active {
  transform: translateY(0);
}

/* ============================================
   🎭 ANIMATIONS
   ============================================ */

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

@keyframes bounce-subtle {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}

.animate-bounce-subtle {
  animation: bounce-subtle 2s ease-in-out infinite;
}

/* ============================================
   📱 RESPONSIVE
   ============================================ */

@media (max-width: 640px) {
  .spoken-language-card {
    padding: 1rem 0.75rem;
    gap: 0.5rem;
  }
  
  .flag-container {
    width: 3rem;
    height: 2rem;
  }
  
  .language-name {
    font-size: 0.75rem;
  }
  
  .nav-btn-back,
  .nav-btn-next {
    padding: 0.75rem 1.25rem;
    font-size: 0.875rem;
  }

  .multi-selection-indicator {
    width: 1.5rem;
    height: 1.5rem;
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
  .spoken-language-card {
    border-width: 3px;
  }
}

/* Focus visible */
.spoken-language-card:focus-visible,
.nav-btn-back:focus-visible,
.nav-btn-next:focus-visible {
  outline: 3px solid #22c55e;
  outline-offset: 2px;
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

.spoken-language-card,
.flag-image,
.multi-selection-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
}

.spoken-language-card {
  contain: layout style paint;
}
</style>

<script>
// Update selection counter dynamically
document.addEventListener('DOMContentLoaded', function() {
  const updateCounter = () => {
    const selectedCount = document.querySelectorAll('#step3 .lang-btn.bg-blue-900').length;
    const counterElement = document.querySelector('#selectionCount .selection-number');
    if (counterElement) {
      counterElement.textContent = selectedCount;
      
      // Add pulse animation on change
      counterElement.parentElement.style.transform = 'scale(1.1)';
      setTimeout(() => {
        counterElement.parentElement.style.transform = 'scale(1)';
      }, 200);
    }
  };
  
  // Listen to clicks on language buttons
  const observer = new MutationObserver(updateCounter);
  const step3 = document.getElementById('step3');
  if (step3) {
    observer.observe(step3, {
      attributes: true,
      attributeFilter: ['class'],
      subtree: true
    });
  }
});
</script>