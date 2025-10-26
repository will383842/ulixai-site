<!-- STEP 3 - SPOKEN LANGUAGES -->

<div id="step3" class="hidden">
  
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-10 left-10 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-10 right-10 w-64 h-64 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

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
    
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-full">
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

  <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-8 max-w-4xl mx-auto">
    
    <button type="button" class="lang-btn spoken-language-card" data-lang="Arabic">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Chinese">
      <div class="flag-container">
        <img src="https://flagcdn.com/cn.svg" alt="Chinese" class="flag-image" />
      </div>
      <span class="language-name">Chinese</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="English">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="French">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="German">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Hindi">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Italian">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Japanese">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Korean">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Portuguese">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Russian">
      <div class="flag-container">
        <img src="https://flagcdn.com/ru.svg" alt="Russian" class="flag-image" />
      </div>
      <span class="language-name">Russian</span>
      <div class="multi-selection-indicator">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
        </svg>
      </div>
    </button>

    <button type="button" class="lang-btn spoken-language-card" data-lang="Spanish">
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

    <button type="button" class="lang-btn spoken-language-card" data-lang="Turkish">
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

  <div class="text-center mb-6">
    <p class="text-sm text-gray-500 italic">💡 You can select multiple languages</p>
  </div>

  <div class="flex justify-between items-center gap-4 pt-6">
    <button id="backToStep2" class="nav-btn-back">
      <span>Back</span>
    </button>
    <button id="nextStep3" class="nav-btn-next" disabled>
      <span>Continue</span>
    </button>
  </div>

</div>

<style>
.spoken-language-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 0.75rem;
  border-radius: 12px;
  border: 2px solid transparent;
  cursor: pointer;
  transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.spoken-language-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 20px -5px rgba(30, 64, 175, 0.4);
  border-color: rgba(59, 130, 246, 0.5);
}

.spoken-language-card.selected {
  background: linear-gradient(135deg, #1e3a8a 0%, #312e81 100%);
  border-color: #22c55e;
  box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2), 0 10px 20px -5px rgba(30, 58, 138, 0.5);
}

.flag-container {
  width: 3rem;
  height: 2rem;
  border-radius: 6px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  border: 2px solid rgba(255, 255, 255, 0.1);
}

.flag-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.language-name {
  font-size: 0.8rem;
  font-weight: 600;
  text-align: center;
  color: white;
  letter-spacing: 0.025em;
}

.multi-selection-indicator {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 1.5rem;
  height: 1.5rem;
  background: #22c55e;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  opacity: 0;
  transform: scale(0);
  transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  border: 2px solid #22c55e;
}

.spoken-language-card.selected .multi-selection-indicator {
  opacity: 1;
  transform: scale(1);
}

#selectionCount { transition: all 0.3s; }
#selectionCount .selection-number { font-size: 1.125rem; font-weight: 800; color: #2563eb; }

.nav-btn-back,
.nav-btn-next {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.875rem 1.5rem;
  font-weight: 600;
  border-radius: 16px;
  min-height: 48px;
  flex: 1;
  max-width: 180px;
  touch-action: manipulation;
  transition: all 0.3s;
  cursor: pointer;
  border: none;
  outline: none;
}

.nav-btn-back {
  color: #22c55e;
  background: white;
  border: 2px solid #e5e7eb;
}

.nav-btn-back:hover {
  background: rgba(34, 197, 94, 0.05);
  border-color: #22c55e;
}

.nav-btn-next {
  color: white;
  background: linear-gradient(135deg, #22c55e, #059669);
  box-shadow: 0 4px 6px -1px rgba(34, 197, 94, 0.3);
}

.nav-btn-next:hover {
  box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.4);
  transform: translateY(-2px);
}

.nav-btn-next:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.selected-lang-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(135deg, #22c55e, #059669);
  color: white;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
  animation: slideIn 0.2s ease-out;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob { animation: blob 7s infinite; }
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

.animate-bounce-subtle { animation: bounce-subtle 2s ease-in-out infinite; }

@media (max-width: 640px) {
  .spoken-language-card { padding: 0.75rem 0.625rem; gap: 0.375rem; }
  .flag-container { width: 2.5rem; height: 1.75rem; }
  .language-name { font-size: 0.7rem; }
  .nav-btn-back, .nav-btn-next { padding: 0.75rem 1rem; font-size: 0.875rem; max-width: none; }
  .multi-selection-indicator { width: 1.25rem; height: 1.25rem; }
}

.spoken-language-card:focus-visible,
.nav-btn-back:focus-visible,
.nav-btn-next:focus-visible {
  outline: 3px solid #22c55e;
  outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const langButtons = document.querySelectorAll('#step3 .lang-btn');
  const nextBtn = document.getElementById('nextStep3');
  const counterEl = document.querySelector('#selectionCount .selection-number');
  const selectedContainer = document.getElementById('selectedLanguages');
  
  function updateUI() {
    const selected = document.querySelectorAll('#step3 .lang-btn.selected');
    if (nextBtn) nextBtn.disabled = selected.length === 0;
    if (counterEl) counterEl.textContent = selected.length;
    
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
  
  langButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('selected');
      
      const selected = Array.from(document.querySelectorAll('#step3 .lang-btn.selected'))
        .map(el => el.dataset.lang);
      localStorage.setItem('spokenLanguages', JSON.stringify(selected));
      
      updateUI();
    });
  });
  
  const saved = localStorage.getItem('spokenLanguages');
  if (saved) {
    try {
      const languages = JSON.parse(saved);
      languages.forEach(lang => {
        const btn = document.querySelector(`#step3 .lang-btn[data-lang="${lang}"]`);
        if (btn) btn.classList.add('selected');
      });
    } catch(e) {}
  }
  
  updateUI();
});
</script>