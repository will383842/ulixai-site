<!-- 
============================================
🚀 STEP 9 - PROFESSIONAL BIO - SIMPLIFIED
============================================
✨ Blue/Cyan/Teal Design System STRICT
📝 Character counter: 200 min, 500 max
📊 Progress bar animation
💾 localStorage persistence
⚡ Maximum performance
🔧 FIXED: No error alerts, silent validation only
============================================
-->

<div id="step9" class="hidden flex flex-col h-full" role="region" aria-label="Write your professional bio">
  
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
          <span class="text-lg sm:text-xl">✍️</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Your Professional Bio 🌟
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Tell us about yourself and your expertise
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
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
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <span class="text-xl flex-shrink-0">✨</span>
        <div>
          <p class="text-xs font-bold text-purple-900">This appears on your profile page!</p>
          <p class="text-xs text-purple-700 mt-0.5">Make it count - this is your first impression to potential clients. Show your personality and expertise! 🚀</p>
        </div>
      </div>
    </div>

    <!-- Bio Textarea Card -->
    <div class="bg-white border-2 border-blue-400 rounded-2xl p-4 sm:p-5 shadow-sm">
      
      <!-- Textarea -->
      <div class="mb-3">
        <label for="bioTextarea" class="block text-sm font-bold text-gray-700 mb-2">
          Write your bio
        </label>
        <textarea 
          id="bioTextarea"
          class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all resize-none text-gray-800 text-sm leading-relaxed"
          rows="8"
          maxlength="500"
          placeholder="Example: Hi! I'm a friendly local who's been living in Barcelona for 5 years. I love helping newcomers discover the best tapas spots, navigate the metro system, and find the perfect neighborhood to call home. Whether you need apartment hunting tips or just want to explore the city like a local, I'm here to help! I speak English, Spanish, and Catalan. Let's make your move to Barcelona smooth and exciting! 🌊☀️"
        ></textarea>
      </div>

      <!-- Character Counter & Progress Bar -->
      <div class="space-y-2">
        
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
        <div class="relative h-3 bg-gray-200 rounded-full overflow-hidden">
          <!-- Background gradient (shows through) -->
          <div class="absolute inset-0 bg-gradient-to-r from-red-400 via-yellow-400 via-blue-400 to-green-400"></div>
          
          <!-- White overlay that shrinks as progress increases -->
          <div id="progressOverlay" class="absolute inset-0 bg-white transition-all duration-300 ease-out" style="width: 100%;"></div>
          
          <!-- Animated shimmer effect -->
          <div id="progressShimmer" class="absolute inset-0 opacity-0 transition-opacity duration-300">
            <div class="absolute inset-0 -translate-x-full animate-shimmer bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
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
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-2xl p-3 sm:p-4">
      <div class="space-y-2">
        <h3 class="text-sm font-bold text-blue-900 flex items-center gap-2">
          <span>💡</span> Tips for a great bio:
        </h3>
        <ul class="space-y-1 text-xs text-blue-700">
          <li class="flex items-start gap-2">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Mention your location and how long you've lived there</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Highlight your expertise (housing, culture, language, etc.)</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-blue-500 flex-shrink-0">•</span>
            <span>Share what makes you unique and approachable</span>
          </li>
          <li class="flex items-start gap-2">
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
   📊 PROGRESS BAR
   ============================================ */

#step9 #progressOverlay {
  transform-origin: left;
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
#step9 #progressOverlay,
#step9 #progressShimmer {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<!-- ============================================
     OPTIMIZED JAVASCRIPT - SIMPLIFIED VERSION
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
        progressOverlay: document.getElementById('progressOverlay'),
        progressShimmer: document.getElementById('progressShimmer'),
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
      // Update overlay (white bar that shrinks)
      elements.progressOverlay.style.width = `${100 - percentage}%`;
      
      // Show shimmer effect when typing
      if (state.charCount > 0) {
        elements.progressShimmer.style.opacity = '1';
      } else {
        elements.progressShimmer.style.opacity = '0';
      }
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
          <span class="text-lg">${currentMilestone.emoji}</span>
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
    
    // Debounce updates for performance
    clearTimeout(updateTimeout);
    updateTimeout = setTimeout(() => {
      state.bio = elements.textarea.value.trim();
      state.charCount = state.bio.length;
      
      // Update all UI elements
      updateCharCounter();
      updateProgressBar();
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
    
    if (data.professional_bio) {
      state.bio = data.professional_bio;
      state.charCount = state.bio.length;
      
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