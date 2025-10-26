<!-- 
============================================
🚀 STEP 3 - SPOKEN LANGUAGES (2025/2026)
============================================
✨ Multi-selection + Real flag images
🎨 Design System Blue/Cyan/Teal
💎 Modern grid with hover effects
⚡ Performance optimized
============================================
-->

<div id="step3" class="hidden">
  
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
        <span class="text-2xl">💬</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        What Languages do you Speak?
      </h2>
    </div>
    <p class="text-base sm:text-lg font-semibold text-gray-600 mb-3">
      Select all the languages you can communicate in
    </p>
    
    <!-- Selection Counter Badge -->
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
      <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
      </svg>
      <span id="selectionCount" class="text-sm font-bold text-blue-700">
        <span class="selection-number">0</span> language(s) selected
      </span>
    </div>
    
    <!-- Selected Languages Display -->
    <div id="selectedLanguages" class="mt-4 flex flex-wrap justify-center gap-2 min-h-[32px]"></div>
  </div>

  <!-- Languages Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-8 max-w-4xl mx-auto">
    
    <button type="button" class="lang-btn spoken-language-card" data-lang="Arabic" aria-label="Select Arabic">
      <div class="flag-container">
        <img src="https://flagcdn.com/sa.svg" alt="Arabic" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Arabic</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Chinese" aria-label="Select Chinese">
      <div class="flag-container">
        <img src="https://flagcdn.com/cn.svg" alt="Chinese" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Chinese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="English" aria-label="Select English">
      <div class="flag-container">
        <img src="https://flagcdn.com/us.svg" alt="English" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">English</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="French" aria-label="Select French">
      <div class="flag-container">
        <img src="https://flagcdn.com/fr.svg" alt="French" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">French</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="German" aria-label="Select German">
      <div class="flag-container">
        <img src="https://flagcdn.com/de.svg" alt="German" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">German</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Hindi" aria-label="Select Hindi">
      <div class="flag-container">
        <img src="https://flagcdn.com/in.svg" alt="Hindi" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Hindi</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Italian" aria-label="Select Italian">
      <div class="flag-container">
        <img src="https://flagcdn.com/it.svg" alt="Italian" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Italian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Japanese" aria-label="Select Japanese">
      <div class="flag-container">
        <img src="https://flagcdn.com/jp.svg" alt="Japanese" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Japanese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Korean" aria-label="Select Korean">
      <div class="flag-container">
        <img src="https://flagcdn.com/kr.svg" alt="Korean" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Korean</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Portuguese" aria-label="Select Portuguese">
      <div class="flag-container">
        <img src="https://flagcdn.com/pt.svg" alt="Portuguese" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Portuguese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Russian" aria-label="Select Russian">
      <div class="flag-container">
        <img src="https://flagcdn.com/ru.svg" alt="Russian" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Russian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Spanish" aria-label="Select Spanish">
      <div class="flag-container">
        <img src="https://flagcdn.com/es.svg" alt="Spanish" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Spanish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Turkish" aria-label="Select Turkish">
      <div class="flag-container">
        <img src="https://flagcdn.com/tr.svg" alt="Turkish" class="flag-image" />
      </div>
      <span class="language-name text-sm sm:text-base font-semibold">Turkish</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

  </div>

  <!-- Helper Text -->
  <div class="text-center mb-6">
    <p class="text-sm text-gray-500 italic">💡 You can select multiple languages</p>
  </div>

  <!-- Navigation Buttons -->
  <div class="flex justify-between items-center gap-4 pt-6">
    <button id="backToStep2" class="nav-btn-back px-6 py-3 rounded-2xl font-bold">
      <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    <button id="nextStep3" class="nav-btn-next px-6 py-3 rounded-2xl font-bold" disabled>
      <span>Continue</span>
      <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

</div>

<style>
/* ============================================
   🎨 SPOKEN LANGUAGE CARDS (2025/2026)
   Design System: Blue/Cyan/Teal
   ============================================ */

.spoken-language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1rem 0.875rem;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  border: 2px solid #60a5fa;
  border-radius: 1rem;
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
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(8, 145, 178, 0.1));
  opacity: 0;
  transition: opacity 0.3s;
  pointer-events: none;
}

.spoken-language-card:hover {
  transform: translateY(-8px) scale(1.02);
  border-color: #2563eb;
  box-shadow: 
    0 20px 25px -5px rgba(59, 130, 246, 0.3),
    0 10px 10px -5px rgba(59, 130, 246, 0.15);
}

.spoken-language-card:hover::before {
  opacity: 1;
}

.spoken-language-card:active {
  transform: translateY(-4px) scale(0.98);
}

/* Selected state - Design System Blue/Cyan */
.spoken-language-card.selected {
  background: linear-gradient(135deg, #1e40af 0%, #0e7490 100%);
  border-color: #1d4ed8;
  box-shadow: 
    0 0 0 3px rgba(59, 130, 246, 0.3),
    0 10px 20px -5px rgba(30, 64, 175, 0.5);
  transform: translateY(-8px) scale(1.02);
}

/* ============================================
   🏳️ FLAG CONTAINER
   ============================================ */

.flag-container {
  width: 3rem;
  height: 2rem;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  border: 2px solid rgba(255, 255, 255, 0.2);
  transition: transform 0.3s;
}

.spoken-language-card:hover .flag-container {
  transform: scale(1.1);
}

.flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* ============================================
   📝 LANGUAGE NAME
   ============================================ */

.language-name {
  text-align: center;
  color: white;
  letter-spacing: 0.025em;
  transition: transform 0.3s;
}

.spoken-language-card:hover .language-name {
  transform: scale(1.05);
}

/* ============================================
   ✅ MULTI-SELECTION INDICATOR
   ============================================ */

.multi-selection-indicator {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 1.5rem;
  height: 1.5rem;
  background: linear-gradient(135deg, #3b82f6, #0891b2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  border: 2px solid white;
}

.spoken-language-card.selected .multi-selection-indicator {
  opacity: 1;
  transform: scale(1);
  background: white;
  color: #2563eb;
}

/* ============================================
   📊 SELECTION COUNTER
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
   🏷️ SELECTED LANGUAGE BADGES
   ============================================ */

.selected-lang-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  color: white;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
  animation: slideIn 0.3s ease-out;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: scale(0.8) translateY(-10px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

/* ============================================
   🔘 NAVIGATION BUTTONS
   ============================================ */

.nav-btn-back,
.nav-btn-next {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  flex: 1;
  max-width: 180px;
  touch-action: manipulation;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  border: none;
  outline: none;
}

.nav-btn-back {
  color: #2563eb;
  background: white;
  border: 2px solid #e5e7eb;
}

.nav-btn-back:hover {
  background: rgba(59, 130, 246, 0.05);
  border-color: #3b82f6;
  transform: translateY(-2px);
  box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.2);
}

.nav-btn-next {
  color: white;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.nav-btn-next:hover:not(:disabled) {
  box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.5);
  transform: translateY(-2px);
}

.nav-btn-next:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
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
    padding: 0.75rem 0.625rem; 
    gap: 0.5rem; 
  }
  
  .flag-container { 
    width: 2.5rem; 
    height: 1.75rem; 
  }
  
  .language-name { 
    font-size: 0.75rem; 
  }
  
  .nav-btn-back, 
  .nav-btn-next { 
    padding: 0.75rem 1rem; 
    font-size: 0.875rem; 
    max-width: none; 
  }
  
  .multi-selection-indicator { 
    width: 1.25rem; 
    height: 1.25rem; 
  }
  
  .selected-lang-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.625rem;
  }
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

.spoken-language-card:focus-visible,
.nav-btn-back:focus-visible,
.nav-btn-next:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.3);
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

@media (prefers-contrast: high) {
  .spoken-language-card {
    border-width: 3px;
  }
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

.spoken-language-card,
.flag-container,
.multi-selection-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
}

.spoken-language-card {
  contain: layout style paint;
}
</style>

<script>
// ============================================
// STEP 3 - SPOKEN LANGUAGES LOGIC
// ============================================
document.addEventListener('DOMContentLoaded', function() {
  const langButtons = document.querySelectorAll('#step3 .lang-btn');
  const nextBtn = document.getElementById('nextStep3');
  const counterEl = document.querySelector('#selectionCount .selection-number');
  const selectedContainer = document.getElementById('selectedLanguages');
  
  function updateUI() {
    const selected = document.querySelectorAll('#step3 .lang-btn.selected');
    
    // Enable/disable next button
    if (nextBtn) {
      nextBtn.disabled = selected.length === 0;
    }
    
    // Update counter
    if (counterEl) {
      counterEl.textContent = selected.length;
    }
    
    // Update selected languages display
    if (selectedContainer) {
      selectedContainer.innerHTML = '';
      selected.forEach(btn => {
        const badge = document.createElement('span');
        badge.className = 'selected-lang-badge';
        badge.textContent = btn.dataset.lang;
        selectedContainer.appendChild(badge);
      });
    }
  }
  
  // Handle language selection
  langButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('selected');
      
      // Save to localStorage
      const selected = Array.from(document.querySelectorAll('#step3 .lang-btn.selected'))
        .map(el => el.dataset.lang);
      localStorage.setItem('spokenLanguages', JSON.stringify(selected));
      
      updateUI();
    });
  });
  
  // Restore from localStorage
  const saved = localStorage.getItem('spokenLanguages');
  if (saved) {
    try {
      const languages = JSON.parse(saved);
      languages.forEach(lang => {
        const btn = document.querySelector(`#step3 .lang-btn[data-lang="${lang}"]`);
        if (btn) btn.classList.add('selected');
      });
    } catch(e) {
      console.error('Error restoring languages:', e);
    }
  }
  
  // Initial UI update
  updateUI();
});
</script>