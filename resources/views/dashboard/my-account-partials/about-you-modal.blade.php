<!-- About You Modal -->
<div id="aboutYouPopup" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 modal-overlay" role="dialog" aria-modal="true" aria-labelledby="about-you-title">
  <div class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl relative transform transition-all modal-content overflow-hidden">
    
    <!-- Header with gradient -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 sm:p-8 text-white relative overflow-hidden">
      <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20" aria-hidden="true"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16" aria-hidden="true"></div>
      
      <button 
        onclick="closeAboutYouPopup()" 
        class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 text-white transition-all focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600"
        aria-label="Close about you modal"
        type="button">
        <i class="fas fa-times text-lg" aria-hidden="true"></i>
      </button>
      
      <div class="relative z-10">
        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4">
          <i class="fas fa-user-edit text-2xl" aria-hidden="true"></i>
        </div>
        <h2 id="about-you-title" class="text-2xl sm:text-3xl font-bold mb-2">Tell us about yourself</h2>
        <p class="text-blue-100 text-sm">A few words to make a difference</p>
      </div>
    </div>

    <!-- Content -->
    <div class="p-6 sm:p-8">
      <!-- Info cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6" role="list">
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100" role="listitem">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-eye text-blue-600" aria-hidden="true"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="text-xs text-gray-600 mb-0.5">Visibility</div>
              <div class="text-sm font-semibold text-gray-800">Complete profile</div>
            </div>
          </div>
        </div>

        <div class="bg-green-50 rounded-xl p-4 border border-green-100" role="listitem">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
              <i class="fas fa-handshake text-green-600" aria-hidden="true"></i>
            </div>
            <div class="flex-1 min-w-0">
              <div class="text-xs text-gray-600 mb-0.5">Trust</div>
              <div class="text-sm font-semibold text-gray-800">More missions</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tips -->
      <aside class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 mb-6 border border-amber-100" role="complementary" aria-label="Writing tips">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
            <i class="fas fa-lightbulb text-amber-600 text-sm" aria-hidden="true"></i>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-sm font-semibold text-gray-800 mb-2">Tips for a great description:</h3>
            <ul class="space-y-1.5 text-xs text-gray-600" role="list">
              <li class="flex items-start gap-2">
                <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                <span>Present your experience and skills</span>
              </li>
              <li class="flex items-start gap-2">
                <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                <span>Explain what makes you unique</span>
              </li>
              <li class="flex items-start gap-2">
                <i class="fas fa-check text-green-600 mt-0.5 flex-shrink-0" aria-hidden="true"></i>
                <span>Be authentic and professional</span>
              </li>
            </ul>
          </div>
        </div>
      </aside>

      <!-- Textarea with character counter -->
      <div class="relative mb-6">
        <label for="aboutYouText" class="block text-sm font-semibold text-gray-700 mb-2">
          Your presentation <span class="text-red-500" aria-label="required">*</span>
        </label>
        <div class="relative">
          <textarea 
            id="aboutYouText" 
            name="about_you"
            rows="6" 
            maxlength="1000"
            required
            aria-required="true"
            aria-describedby="about-you-help about-you-count"
            class="w-full border-2 border-gray-200 rounded-xl p-4 text-gray-700 resize-none placeholder:text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-colors" 
            placeholder="Example: Hello! I've been passionate about my profession for over 5 years. I love helping expats settle comfortably in their new country. My expertise and attention to detail make me a trusted service provider...">{{ $user->serviceProvider->profile_description ?? '' }}</textarea>
          <div id="about-you-count" class="absolute bottom-3 right-3 text-xs text-gray-400 bg-white px-2 py-1 rounded-lg" aria-live="polite">
            <span id="charCount">0</span> / 1000
          </div>
        </div>
        <p id="about-you-help" class="text-xs text-gray-500 mt-2 flex items-center gap-1">
          <i class="fas fa-info-circle text-blue-500" aria-hidden="true"></i>
          This description will appear on your public profile
        </p>
      </div>

      <!-- Action buttons -->
      <div class="flex flex-col sm:flex-row gap-3">
        <button 
          onclick="closeAboutYouPopup()" 
          type="button"
          class="order-2 sm:order-1 flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3.5 px-6 rounded-xl transition-all focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 min-h-[44px]">
          Cancel
        </button>
        <button 
          onclick="submitAboutYou()" 
          type="button"
          class="order-1 sm:order-2 flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3.5 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px] flex items-center justify-center gap-2">
          <i class="fas fa-check" aria-hidden="true"></i>
          Save
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Modal animations with prefers-reduced-motion */
@media (prefers-reduced-motion: no-preference) {
  .modal-overlay {
    animation: fadeIn 0.2s ease-out;
  }
  
  .modal-content {
    animation: scaleIn 0.3s ease-out;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes scaleIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }
}

#aboutYouText:focus {
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* High contrast mode improvements */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .text-blue-100 {
    color: #dbeafe;
  }
}
</style>

<script>
// Character counter with debounce for performance
document.addEventListener('DOMContentLoaded', function() {
  const textarea = document.getElementById('aboutYouText');
  const charCount = document.getElementById('charCount');
  
  if (textarea && charCount) {
    // Set initial count
    charCount.textContent = textarea.value.length;
    
    textarea.addEventListener('input', function() {
      charCount.textContent = this.value.length;
      
      // Visual validation
      if (this.value.length > 950) {
        charCount.classList.add('text-orange-600', 'font-semibold');
      } else {
        charCount.classList.remove('text-orange-600', 'font-semibold');
      }
    });
    
    // Focus trap for accessibility
    const modal = document.getElementById('aboutYouPopup');
    const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    
    modal.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAboutYouPopup();
      }
      
      if (e.key === 'Tab') {
        const firstFocusable = modal.querySelectorAll(focusableElements)[0];
        const focusableContent = modal.querySelectorAll(focusableElements);
        const lastFocusable = focusableContent[focusableContent.length - 1];
        
        if (e.shiftKey) {
          if (document.activeElement === firstFocusable) {
            lastFocusable.focus();
            e.preventDefault();
          }
        } else {
          if (document.activeElement === lastFocusable) {
            firstFocusable.focus();
            e.preventDefault();
          }
        }
      }
    });
  }
});

function closeAboutYouPopup() {
  const modal = document.getElementById('aboutYouPopup');
  modal.classList.add('hidden');
  document.body.style.overflow = '';
}

function submitAboutYou() {
  const textarea = document.getElementById('aboutYouText');
  const btn = event.target;
  
  if (!textarea.value.trim()) {
    textarea.focus();
    textarea.setAttribute('aria-invalid', 'true');
    return;
  }
  
  // Loading state
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2" aria-hidden="true"></i>Saving...';
  
  // Save logic here
  
  // Restore state after success/error
  setTimeout(() => {
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-check" aria-hidden="true"></i>Save';
  }, 2000);
}
</script>