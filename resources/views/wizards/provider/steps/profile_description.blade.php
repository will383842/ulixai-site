<!-- 
============================================
🚀 STEP 9 - PROFESSIONAL BIO - POPUP COMPACT
============================================
✨ Blue/Cyan/Teal Design System STRICT
📝 Character counter: 200 min, 500 max
📊 Progress bar animation
💾 localStorage persistence
⚡ Maximum performance
🔧 FIXED: No error alerts, silent validation only
📦 TOUT LE CONTENU CONSERVÉ - juste plus compact
============================================
-->

<div id="step9" class="hidden flex flex-col h-full" role="region" aria-label="Write your professional bio">
  
  <!-- ============================================
       COMPACT HEADER (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-1 pb-1 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 animated blobs -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-48 h-48 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-48 h-48 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-48 h-48 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-1 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-8 h-8 sm:w-9 sm:h-9 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-base sm:text-lg">✍️</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-base sm:text-lg lg:text-xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          Your Professional Bio 🌟
        </h2>
        <p class="text-xs sm:text-sm font-semibold text-gray-600">
          Tell us about yourself and your expertise
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-1.5 px-2 py-0.5 sm:px-2.5 sm:py-1 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          200-500 characters required
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       SCROLLABLE CONTENT
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-2">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-300 rounded-xl p-2 sm:p-2.5">
      <div class="flex items-start gap-1.5">
        <span class="text-base flex-shrink-0">✨</span>
        <div>
          <p class="text-xs font-bold text-purple-900">This appears on your profile page!</p>
          <p class="text-xs text-purple-700 mt-0.5">Make it count - this is your first impression to potential clients. Show your personality and expertise! 🚀</p>
        </div>
      </div>
    </div>

    <!-- Bio Textarea Card -->
    <div class="bg-white border-2 border-blue-400 rounded-xl p-3 sm:p-3.5 shadow-sm">
      
      <!-- Textarea -->
      <div class="mb-2">
        <label for="bioTextarea" class="block text-xs font-bold text-gray-700 mb-1.5">
          Write your bio
        </label>
        <textarea 
          id="bioTextarea"
          class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all resize-none text-gray-800 text-xs leading-relaxed"
          rows="6"
          maxlength="500"
          placeholder="Example: Hi! I'm a friendly local who's been living in Barcelona for 5 years. I love helping newcomers discover the best tapas spots, navigate the metro system, and find the perfect neighborhood to call home. Whether you need apartment hunting tips or just want to explore the city like a local, I'm here to help! I speak English, Spanish, and Catalan. Let's make your move to Barcelona smooth and exciting! 🌊☀️"
        ></textarea>
      </div>

      <!-- Character Counter & Progress Bar -->
      <div class="space-y-1.5">
        
        <!-- Counter Display -->
        <div class="flex items-center justify-between text-xs font-bold">
          <span id="charCountLabel" class="text-gray-500">
            <span id="charCount">0</span> / 500 characters
          </span>
          <span id="charStatus" class="text-gray-400">
            Keep writing...
          </span>
        </div>

        <!-- Progress Bar Container -->
        <div class="relative h-2 bg-gray-200 rounded-full overflow-hidden shadow-inner">
          <!-- Colored progress bar that grows -->
          <div id="progressBar" class="absolute inset-y-0 left-0 bg-gradient-to-r from-red-500 via-yellow-500 via-blue-500 to-green-500 rounded-full transition-all duration-500 ease-out" style="width: 0%;">
            <!-- Shimmer effect on the bar -->
            <div class="absolute inset-0 overflow-hidden rounded-full">
              <div class="absolute inset-0 -translate-x-full animate-shimmer bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
            </div>
          </div>
        </div>

        <!-- Milestone Messages -->
        <div id="milestoneMessage" class="text-xs font-semibold text-center transition-all duration-300 opacity-0">
          <span id="milestoneText" class="inline-flex items-center gap-1">
            <!-- Dynamic content -->
          </span>
        </div>

      </div>

    </div>

    <!-- Tips Card -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl p-2 sm:p-2.5">
      <div class="space-y-1.5">
        <h3 class="text-xs font-bold text-blue-900 flex items-center gap-1.5">
          <span>💡</span> Tips for a great bio:
        </h3>
        <ul class="space-y-0.5 text-xs text-blue-700">
          <li class="flex items-start gap-1.5">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Mention your location and how long you've lived there</span>
          </li>
          <li class="flex items-start gap-1.5">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Highlight your expertise (housing, culture, language, etc.)</span>
          </li>
          <li class="flex items-start gap-1.5">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Share what makes you unique and approachable</span>
          </li>
          <li class="flex items-start gap-1.5">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Add languages you speak and a friendly emoji or two! 😊</span>
          </li>
        </ul>
      </div>
    </div>

  </div>

</div>

<!-- ============================================
     OPTIMIZED STYLES
     ============================================ -->
<style>
/* ============================================
   🎨 BASE ANIMATIONS
   ============================================ */

/* Blob animations - GPU optimized */
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
  will-change: transform;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Shimmer animation for progress bar */
@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.animate-shimmer {
  animation: shimmer 2s infinite;
}

/* ============================================
   📝 TEXTAREA STYLES
   ============================================ */

#step9 textarea {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
}

#step9 textarea::placeholder {
  color: #9ca3af;
  opacity: 0.8;
}

#step9 textarea:focus::placeholder {
  opacity: 0.5;
}

/* ============================================
   📊 PROGRESS BAR - SMOOTH ANIMATION
   ============================================ */

#step9 #progressBar {
  transform-origin: left;
  transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
  #step9 textarea {
    border: 3px solid currentColor;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

#step9 textarea,
#step9 #progressBar {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<!-- ============================================
     OPTIMIZED JAVASCRIPT - COMPLETE VERSION
     ============================================ -->
<script>
(function() {
  'use strict';

  // ============================================
  // 🔧 CONSTANTS
  // ============================================
  
  const MIN_CHARS = 200;
  const MAX_CHARS = 500;
  
  const MILESTONES = [
    { at: 50, emoji: '🌱', message: 'Great start!' },
    { at: 100, emoji: '🚀', message: 'Keep going!' },
    { at: 150, emoji: '💪', message: 'Almost there!' },
    { at: 200, emoji: '✅', message: 'Minimum reached!' },
    { at: 300, emoji: '🌟', message: 'Looking good!' },
    { at: 400, emoji: '🔥', message: 'Excellent bio!' },
    { at: 500, emoji: '🎉', message: 'Perfect length!' }
  ];

  // ============================================
  // 🔧 STATE MANAGEMENT
  // ============================================
  
  const state = {
    bio: '',
    charCount: 0,
    isValid: false,
    lastMilestone: 0
  };

  let cachedElements = null;
  let saveTimeout = null;
  let updateTimeout = null;

  // ============================================
  // 📦 CACHE DOM ELEMENTS
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step9'),
        textarea: document.getElementById('bioTextarea'),
        charCount: document.getElementById('charCount'),
        charCountLabel: document.getElementById('charCountLabel'),
        charStatus: document.getElementById('charStatus'),
        progressBar: document.getElementById('progressBar'),
        milestoneMessage: document.getElementById('milestoneMessage'),
        milestoneText: document.getElementById('milestoneText')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCAL STORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem('expats') || '{}');
    } catch (e) {
      console.warn('localStorage read error:', e.message);
      return {};
    }
  }

  function saveToLocalStorage() {
    clearTimeout(saveTimeout);
    saveTimeout = setTimeout(() => {
      try {
        const data = getLocalStorage();
        data.professional_bio = state.bio;
        localStorage.setItem('expats', JSON.stringify(data));
      } catch (e) {
        console.warn('localStorage error:', e);
      }
    }, 500);
  }

  // ============================================
  // 🎨 UI UPDATES
  // ============================================
  
  function updateCharCounter() {
    const elements = getCachedElements();
    elements.charCount.textContent = state.charCount;
    
    // Update color based on progress
    if (state.charCount < MIN_CHARS) {
      elements.charCountLabel.className = 'text-gray-500';
      elements.charStatus.textContent = `${MIN_CHARS - state.charCount} more to go...`;
      elements.charStatus.className = 'text-orange-500 font-bold';
    } else if (state.charCount >= MIN_CHARS && state.charCount < MAX_CHARS) {
      elements.charCountLabel.className = 'text-green-600';
      elements.charStatus.textContent = 'Perfect! ✨';
      elements.charStatus.className = 'text-green-600 font-bold';
    } else {
      elements.charCountLabel.className = 'text-blue-600';
      elements.charStatus.textContent = 'Maximum reached!';
      elements.charStatus.className = 'text-blue-600 font-bold';
    }
  }

  function updateProgressBar() {
    const elements = getCachedElements();
    const percentage = Math.min((state.charCount / MAX_CHARS) * 100, 100);
    
    requestAnimationFrame(() => {
      elements.progressBar.style.width = `${percentage}%`;
    });
  }

  function checkMilestones() {
    const elements = getCachedElements();
    
    // Find current milestone
    let currentMilestone = null;
    for (let i = MILESTONES.length - 1; i >= 0; i--) {
      if (state.charCount >= MILESTONES[i].at) {
        currentMilestone = MILESTONES[i];
        break;
      }
    }
    
    // Show milestone message if we reached a new one
    if (currentMilestone && currentMilestone.at > state.lastMilestone) {
      state.lastMilestone = currentMilestone.at;
      
      requestAnimationFrame(() => {
        elements.milestoneText.innerHTML = `
          <span class="text-base">${currentMilestone.emoji}</span>
          <span class="text-${currentMilestone.at >= MIN_CHARS ? 'green' : 'blue'}-700">${currentMilestone.message}</span>
        `;
        
        elements.milestoneMessage.style.opacity = '1';
        elements.milestoneMessage.style.transform = 'translateY(0)';
        
        // Fade out after 2 seconds
        setTimeout(() => {
          elements.milestoneMessage.style.opacity = '0';
          elements.milestoneMessage.style.transform = 'translateY(-10px)';
        }, 2000);
      });
    }
  }

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleTextareaInput(e) {
    const elements = getCachedElements();
    
    // Update immediately for smooth progress bar
    state.bio = elements.textarea.value;
    state.charCount = state.bio.trim().length;
    
    // Update progress bar immediately
    updateProgressBar();
    updateCharCounter();
    
    // Debounce other updates
    clearTimeout(updateTimeout);
    updateTimeout = setTimeout(() => {
      checkMilestones();
      
      // Validate and save
      state.isValid = state.charCount >= MIN_CHARS && state.charCount <= MAX_CHARS;
      saveToLocalStorage();
      
      // Notify navigation
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }, 100);
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const elements = getCachedElements();
    const data = getLocalStorage();
    
    if ('professional_bio' in data) {
      state.bio = data.professional_bio || '';
      state.charCount = state.bio.trim().length;
      
      requestAnimationFrame(() => {
        elements.textarea.value = state.bio;
        updateCharCounter();
        updateProgressBar();
        
        // Set last milestone without showing message
        for (let i = MILESTONES.length - 1; i >= 0; i--) {
          if (state.charCount >= MILESTONES[i].at) {
            state.lastMilestone = MILESTONES[i].at;
            break;
          }
        }
        
        state.isValid = state.charCount >= MIN_CHARS && state.charCount <= MAX_CHARS;
      });
    } else {
      state.isValid = false;
    }
  }

  // ============================================
  // ✅ VALIDATION - SIMPLIFIED
  // ============================================
  
  window.validateStep9 = function() {
    return state.charCount >= MIN_CHARS && state.charCount <= MAX_CHARS;
  };

  // Expose state globally
  window.professionalBio = state.bio;

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    const elements = getCachedElements();
    
    // Attach event listener
    if (elements.textarea) {
      elements.textarea.addEventListener('input', handleTextareaInput, { passive: true });
    }

    // Observer to detect when step becomes visible
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              restoreState();
              
              if (typeof window.updateNavigationButtons === 'function') {
                window.updateNavigationButtons();
              }
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    // Restore initial state
    restoreState();
  }

  // Start when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>