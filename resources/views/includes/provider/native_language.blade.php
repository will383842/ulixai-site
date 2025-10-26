<!-- 
============================================
🚀 STEP 2 - NATIVE LANGUAGE (2025/2026)
============================================
✨ Glassmorphism + Flag animations
🎨 Design System Blue/Cyan/Teal
💎 Modern grid layout with hover effects
⚡ Performance optimized
============================================
-->

<div id="step2" class="hidden">
  
  <!-- Ambient Background Effects -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <!-- Header Section -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl animate-bounce-subtle">
        <span class="text-2xl">🌍</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        What is your native language?
      </h2>
    </div>
    <p class="text-base sm:text-lg font-semibold text-gray-600">
      Select your primary language to help us match you better
    </p>
  </div>

  <!-- Selection Counter Badge -->
  <div class="flex justify-center mb-6">
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
      <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <span class="text-sm font-bold text-blue-700" id="languageCounter">0/1 selected</span>
    </div>
  </div>

  <!-- Language Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-8">
    
    <!-- English -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="English" aria-label="Select English">
      <div class="language-flag text-3xl sm:text-4xl">🇬🇧</div>
      <span class="language-name text-sm sm:text-base font-semibold">English</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- French -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="French" aria-label="Select French">
      <div class="language-flag text-3xl sm:text-4xl">🇫🇷</div>
      <span class="language-name text-sm sm:text-base font-semibold">French</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Spanish -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Spanish" aria-label="Select Spanish">
      <div class="language-flag text-3xl sm:text-4xl">🇪🇸</div>
      <span class="language-name text-sm sm:text-base font-semibold">Spanish</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Portuguese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Portuguese" aria-label="Select Portuguese">
      <div class="language-flag text-3xl sm:text-4xl">🇵🇹</div>
      <span class="language-name text-sm sm:text-base font-semibold">Portuguese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- German -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="German" aria-label="Select German">
      <div class="language-flag text-3xl sm:text-4xl">🇩🇪</div>
      <span class="language-name text-sm sm:text-base font-semibold">German</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Italian -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Italian" aria-label="Select Italian">
      <div class="language-flag text-3xl sm:text-4xl">🇮🇹</div>
      <span class="language-name text-sm sm:text-base font-semibold">Italian</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Arabic -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Arabic" aria-label="Select Arabic">
      <div class="language-flag text-3xl sm:text-4xl">🇸🇦</div>
      <span class="language-name text-sm sm:text-base font-semibold">Arabic</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Chinese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Chinese" aria-label="Select Chinese">
      <div class="language-flag text-3xl sm:text-4xl">🇨🇳</div>
      <span class="language-name text-sm sm:text-base font-semibold">Chinese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Japanese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Japanese" aria-label="Select Japanese">
      <div class="language-flag text-3xl sm:text-4xl">🇯🇵</div>
      <span class="language-name text-sm sm:text-base font-semibold">Japanese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Korean -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Korean" aria-label="Select Korean">
      <div class="language-flag text-3xl sm:text-4xl">🇰🇷</div>
      <span class="language-name text-sm sm:text-base font-semibold">Korean</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Hindi -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Hindi" aria-label="Select Hindi">
      <div class="language-flag text-3xl sm:text-4xl">🇮🇳</div>
      <span class="language-name text-sm sm:text-base font-semibold">Hindi</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Turkish -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Turkish" aria-label="Select Turkish">
      <div class="language-flag text-3xl sm:text-4xl">🇹🇷</div>
      <span class="language-name text-sm sm:text-base font-semibold">Turkish</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

  </div>

  <!-- Navigation Buttons -->
  <div class="wizard-nav-container flex justify-between gap-4">
    <button id="backToStep1" type="button" class="nav-btn-back px-6 py-3 rounded-2xl font-bold bg-white text-blue-600 border-2 border-gray-200 hover:shadow-lg transition-all duration-300">
      <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      Back
    </button>
    <button id="nextStep2" type="button" class="nav-btn-next px-6 py-3 rounded-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 text-white hover:shadow-xl transition-all duration-300" disabled>
      Continue
      <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

  <!-- Auto-validation script -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const nextBtn = document.getElementById('nextStep2');
      const stepElement = document.getElementById('step2');
      const counterElement = document.getElementById('languageCounter');
      
      function checkValidation() {
          // Check for BOTH .selected AND .bg-blue-900 to support external JS
          const selectedCards = document.querySelectorAll('#step2 .lang-btn.bg-blue-900, #step2 .lang-btn.selected');
          const isValid = selectedCards.length > 0;
          
          if (nextBtn) {
              nextBtn.disabled = !isValid;
              if (isValid) {
                  nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
              } else {
                  nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
              }
          }
          
          if (counterElement) {
              counterElement.textContent = `${selectedCards.length}/1 selected`;
          }
      }
      
      // Observer les changements
      if (stepElement) {
          stepElement.addEventListener('click', () => setTimeout(checkValidation, 100));
          stepElement.addEventListener('input', () => setTimeout(checkValidation, 100));
          stepElement.addEventListener('change', () => setTimeout(checkValidation, 100));
      }
      
      // Vérification initiale
      setTimeout(checkValidation, 200);
  });
  </script>

</div>

<script>
// VALIDATION STRICTE POUR STEP 2
(function() {
  'use strict';
  
  // Fonction de validation
  function validateStep2() {
    const selectedLanguage = document.querySelector('#step2 .lang-btn.bg-blue-900');
    return selectedLanguage !== null;
  }
  
  // Bloquer le bouton Next si rien n'est sélectionné
  document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep2');
    
    if (nextBtn) {
      // Intercepter le clic AVANT que le header ne le traite
      nextBtn.addEventListener('click', function(e) {
        if (!validateStep2()) {
          e.stopImmediatePropagation(); // Bloque TOUS les handlers
          e.preventDefault();
          
          // Alert personnalisé moderne
          const alertDiv = document.createElement('div');
          alertDiv.className = 'fixed top-4 right-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-2xl z-[9999] animate-shake';
          alertDiv.innerHTML = `
            <div class="flex items-center gap-3">
              <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
              </svg>
              <div>
                <p class="font-bold">Selection Required</p>
                <p class="text-sm">Please select your native language to continue</p>
              </div>
              <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-red-500 hover:text-red-700">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </button>
            </div>
          `;
          document.body.appendChild(alertDiv);
          
          // Animation de shake sur les cards
          const langCards = document.querySelectorAll('#step2 .language-card');
          langCards.forEach(card => {
            card.classList.add('animate-shake');
            setTimeout(() => card.classList.remove('animate-shake'), 500);
          });
          
          // Auto-remove après 5 secondes
          setTimeout(() => {
            if (alertDiv && alertDiv.parentElement) {
              alertDiv.remove();
            }
          }, 5000);
          
          return false;
        }
      }, true); // Capture phase pour être le premier
    }
  });
})();
</script>

<style>
/* ============================================
   🎭 SHAKE ANIMATION
   ============================================ */

@keyframes shake {
  0%, 100% {
    transform: translateX(0);
  }
  10%, 30%, 50%, 70%, 90% {
    transform: translateX(-5px);
  }
  20%, 40%, 60%, 80% {
    transform: translateX(5px);
  }
}

.animate-shake {
  animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97);
}

@keyframes bounce-in {
  0% {
    opacity: 0;
    transform: scale(0.3) translateY(-20px);
  }
  50% {
    opacity: 1;
    transform: scale(1.05);
  }
  70% {
    transform: scale(0.9);
  }
  100% {
    transform: scale(1) translateX(0);
  }
}

/* ============================================
   🎨 LANGUAGE CARD STYLES (2025/2026)
   Design System: Blue/Cyan/Teal
   ============================================ */

.language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1rem 1.25rem;
  background: white;
  border: 2px solid #60a5fa;
  border-radius: 1rem;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);
  will-change: transform;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
}

.language-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(8, 145, 178, 0.05));
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.language-card:hover {
  transform: translateY(-8px) scale(1.02);
  border-color: #3b82f6;
  box-shadow: 
    0 20px 25px -5px rgba(59, 130, 246, 0.2),
    0 10px 10px -5px rgba(59, 130, 246, 0.1);
}

.language-card:hover::before {
  opacity: 1;
}

.language-card:active {
  transform: translateY(-4px) scale(0.98);
}

/* Selected state - Design System (supports both .selected and .bg-blue-900) */
.language-card.selected,
.language-card.bg-blue-900 {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%) !important;
  border-color: #1d4ed8 !important;
  box-shadow: 
    0 20px 25px -5px rgba(37, 99, 235, 0.4),
    0 0 0 4px rgba(59, 130, 246, 0.2);
  transform: translateY(-8px) scale(1.02);
}

.language-card.selected .language-name,
.language-card.bg-blue-900 .language-name,
.language-card.text-white .language-name {
  color: white !important;
}

.language-card.selected .selection-indicator,
.language-card.bg-blue-900 .selection-indicator {
  opacity: 1;
  transform: scale(1);
}

/* ============================================
   🌍 FLAG & NAME STYLES
   ============================================ */

.language-flag {
  line-height: 1;
  transition: transform 0.3s;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.language-card:hover .language-flag {
  transform: scale(1.1) rotate(5deg);
}

.language-card.selected .language-flag,
.language-card.bg-blue-900 .language-flag {
  transform: scale(1.15);
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
}

.language-name {
  transition: color 0.3s;
  text-align: center;
  color: #1e40af;
}

.language-card:hover .language-name {
  color: #1d4ed8;
}

/* ============================================
   ✅ SELECTION INDICATOR
   ============================================ */

.selection-indicator {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  width: 1.5rem;
  height: 1.5rem;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #3b82f6;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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
  .language-card {
    padding: 1rem 0.75rem;
    gap: 0.5rem;
  }
  
  .language-flag {
    font-size: 2rem;
  }
  
  .language-name {
    font-size: 0.75rem;
  }
  
  .selection-indicator {
    width: 1.25rem;
    height: 1.25rem;
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
  .language-card {
    border-width: 3px;
  }
}

/* Focus visible */
.language-card:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

.language-card,
.language-flag,
.selection-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
}

.language-card {
  contain: layout style paint;
}

/* ============================================
   🔘 BUTTON STATES
   ============================================ */

.nav-btn-next:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
}

.nav-btn-back:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1);
}

.nav-btn-next:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
}
</style>