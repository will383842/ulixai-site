<!-- 
============================================
🚀 STEP 2 - NATIVE LANGUAGE (2025/2026)
============================================
✨ Glassmorphism + Flag animations
🎨 Interactive language cards
💎 Modern grid layout with hover effects
⚡ Performance optimized
============================================
-->

<div id="step2" class="hidden">
  
  <!-- Ambient Background Effects -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <!-- Header Section -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-3">
      <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-bounce-subtle">
        <span class="text-2xl">🌍</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
        What is your native language?
      </h2>
    </div>
    <p class="text-gray-600 text-sm sm:text-base font-medium">
      Select your primary language to help us match you better
    </p>
  </div>

  <!-- Language Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-8">
    
    <!-- English -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="English">
      <div class="language-flag">🇬🇧</div>
      <span class="language-name">English</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- French -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="French">
      <div class="language-flag">🇫🇷</div>
      <span class="language-name">French</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Spanish -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Spanish">
      <div class="language-flag">🇪🇸</div>
      <span class="language-name">Spanish</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Portuguese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Portuguese">
      <div class="language-flag">🇵🇹</div>
      <span class="language-name">Portuguese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- German -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="German">
      <div class="language-flag">🇩🇪</div>
      <span class="language-name">German</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Italian -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Italian">
      <div class="language-flag">🇮🇹</div>
      <span class="language-name">Italian</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Arabic -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Arabic">
      <div class="language-flag">🇸🇦</div>
      <span class="language-name">Arabic</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Chinese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Chinese">
      <div class="language-flag">🇨🇳</div>
      <span class="language-name">Chinese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Japanese -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Japanese">
      <div class="language-flag">🇯🇵</div>
      <span class="language-name">Japanese</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Korean -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Korean">
      <div class="language-flag">🇰🇷</div>
      <span class="language-name">Korean</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Hindi -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Hindi">
      <div class="language-flag">🇮🇳</div>
      <span class="language-name">Hindi</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <!-- Turkish -->
    <button class="lang-btn bg-white text-blue-700 border border-blue-700 language-card group" data-lang="Turkish">
      <div class="language-flag">🇹🇷</div>
      <span class="language-name">Turkish</span>
      <div class="selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

  </div>

  <!-- Navigation Buttons - STANDARDIZED -->
  <div class="wizard-nav-container">
    <button id="backToStep1" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep2" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>

  <!-- Auto-validation script -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const nextBtn = document.getElementById('nextStep2');
      const stepElement = document.getElementById('step2');
      
      function checkValidation() {
          const isValid = document.querySelector('#step2 .lang-btn.bg-blue-900') !== null;
          if (nextBtn) {
              nextBtn.disabled = !isValid;
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
          alertDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-2xl z-[9999] animate-bounce-in';
          alertDiv.innerHTML = `
            <div class="flex items-center gap-3">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <div class="font-bold">Selection Required</div>
                <div class="text-sm">Please select your native language</div>
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
   🎨 LANGUAGE CARD STYLES (2025/2026)
   ============================================ */

.language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1.25rem 1rem;
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  will-change: transform;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
}

.language-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(168, 85, 247, 0.05));
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.language-card:hover {
  transform: translateY(-4px) scale(1.02);
  border-color: #3b82f6 !important;
  box-shadow: 
    0 20px 25px -5px rgba(59, 130, 246, 0.1),
    0 10px 10px -5px rgba(59, 130, 246, 0.04);
}

.language-card:hover::before {
  opacity: 1;
}

.language-card:active {
  transform: translateY(-2px) scale(0.98);
}

/* Selected state */
.language-card.bg-blue-900 {
  background: linear-gradient(135deg, #1e40af, #3b82f6);
  border-color: #1e40af;
  box-shadow: 
    0 20px 25px -5px rgba(59, 130, 246, 0.3),
    0 0 0 4px rgba(59, 130, 246, 0.1);
  transform: translateY(-4px) scale(1.02);
}

.language-card.bg-blue-900 .language-name {
  color: white;
}

.language-card.bg-blue-900 .selection-indicator {
  opacity: 1;
  transform: scale(1);
}

/* ============================================
   🌍 FLAG & NAME STYLES
   ============================================ */

.language-flag {
  font-size: 2.5rem;
  line-height: 1;
  transition: transform 0.3s;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.language-card:hover .language-flag {
  transform: scale(1.1) rotate(5deg);
}

.language-card.bg-blue-900 .language-flag {
  transform: scale(1.15);
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
}

.language-name {
  font-size: 0.875rem;
  font-weight: 600;
  transition: color 0.3s;
  text-align: center;
}

/* Blue text on white background (initial state) */
.language-card.bg-white .language-name,
.language-card.text-blue-700 .language-name {
  color: #1d4ed8;
}

.language-card:hover .language-name {
  color: #1e40af;
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
</style>