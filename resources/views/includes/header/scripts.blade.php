{{-- 
  ═══════════════════════════════════════════════════════════
  🔧 SCRIPTS COMPONENT
  ═══════════════════════════════════════════════════════════
  
  Contient tous les scripts JavaScript :
  - Toast messages (success/error)
  - Bouton Scroll To Top
  - Google Translate initialization
  - Language selector handlers
  - Help button handlers
  - Laravel Mix/Vite assets
  
  @version 2.0.0
--}}

{{-- 🚀 Bouton Flèche Retour en Haut --}}
<button id="scrollToTopBtn" aria-label="Retour en haut">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>

{{-- Toast Messages --}}
@if (session('success'))
  <script>toastr.success('{{ session('success') }}', 'Success');</script>
@endif
@if (session('error'))
  <script>toastr.error('{{ session('error') }}', 'Error');</script>
@endif

{{-- Hidden Google Translate widget (required by API) --}}
<div id="google_translate_element" class="hidden"></div>

{{-- ═══════════════════════════════════════════════════════════
     🌐 GOOGLE TRANSLATE INITIALIZATION
     ═══════════════════════════════════════════════════════════ --}}
<script type="text/javascript">
// Google Translate API Initialization
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,fr,de,ru,zh-CN,es,pt,ar,hi',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay: false
  }, 'google_translate_element');
  
  console.log('✅ Google Translate initialized');
}

// Fonction pour changer la langue
function changeLanguage(langCode) {
  console.log('🌐 Changing language to:', langCode);
  
  const selectField = document.querySelector('select.goog-te-combo');
  if (selectField) {
    selectField.value = langCode;
    selectField.dispatchEvent(new Event('change'));
    console.log('✅ Language changed to:', langCode);
  } else {
    console.warn('⚠️ Google Translate not ready yet, retrying...');
    setTimeout(() => changeLanguage(langCode), 500);
  }
}

// Écouter les événements de changement de langue (desktop et mobile)
document.addEventListener('languageChanged', function(e) {
  const lang = e.detail.lang;
  console.log('🌐 languageChanged event received:', lang);
  changeLanguage(lang);
});
</script>

{{-- Google Translate Script --}}
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

{{-- ═══════════════════════════════════════════════════════════
     🖥️ DESKTOP LANGUAGE SELECTOR SCRIPT
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    const langBtn = document.getElementById('langBtn');
    const langMenu = document.getElementById('langMenu');
    const langFlag = document.getElementById('langFlag');
    const langChevron = document.getElementById('langChevron');
    
    if (!langBtn || !langMenu) return;
    
    // Toggle dropdown
    langBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      const isHidden = langMenu.classList.contains('hidden');
      
      if (isHidden) {
        langMenu.classList.remove('hidden');
        langBtn.setAttribute('aria-expanded', 'true');
        if (langChevron) langChevron.style.transform = 'rotate(180deg)';
      } else {
        langMenu.classList.add('hidden');
        langBtn.setAttribute('aria-expanded', 'false');
        if (langChevron) langChevron.style.transform = 'rotate(0deg)';
      }
    });
    
    // Sélection d'une langue
    const langItems = langMenu.querySelectorAll('li[data-lang]');
    langItems.forEach(function(item) {
      item.addEventListener('click', function(e) {
        e.stopPropagation();
        const lang = this.getAttribute('data-lang');
        const flag = this.getAttribute('data-flag');
        
        // Mettre à jour le drapeau
        if (langFlag) langFlag.src = flag;
        
        // Fermer le menu
        langMenu.classList.add('hidden');
        langBtn.setAttribute('aria-expanded', 'false');
        
        // Déclencher la traduction
        console.log('🌐 Desktop language selected:', lang);
        const event = new CustomEvent('languageChanged', { detail: { lang: lang, flag: flag } });
        document.dispatchEvent(event);
      });
    });
    
    // Fermer en cliquant ailleurs
    document.addEventListener('click', function(e) {
      if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
        langMenu.classList.add('hidden');
        langBtn.setAttribute('aria-expanded', 'false');
        if (langChevron) langChevron.style.transform = 'rotate(0deg)';
      }
    });
    
    console.log('✅ Desktop language selector initialized');
  });
})();
</script>

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU OVERLAY & LANGUAGE BOTTOM SHEET SCRIPT
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('mobile-menu-overlay');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.getElementById('menu-toggle-top');
    
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    // 📱 MOBILE MENU BOTTOM SHEET
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    
    function openMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Afficher l'overlay
      overlay.classList.remove('hidden');
      setTimeout(() => overlay.classList.add('opacity-100'), 10);
      
      // Slide-up le menu
      mobileMenu.classList.remove('translate-y-full');
      mobileMenu.classList.add('translate-y-0');
      mobileMenu.setAttribute('aria-hidden', 'false');
      
      // Bloquer le scroll
      document.body.style.overflow = 'hidden';
      
      // Transformer hamburger en X
      if (menuToggle) {
        menuToggle.classList.add('menu-active');
        menuToggle.setAttribute('aria-expanded', 'true');
      }
      
      console.log('✅ Mobile menu opened (slide-up)');
    }
    
    function closeMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Masquer l'overlay
      overlay.classList.remove('opacity-100');
      setTimeout(() => overlay.classList.add('hidden'), 300);
      
      // Slide-down le menu
      mobileMenu.classList.remove('translate-y-0');
      mobileMenu.classList.add('translate-y-full');
      mobileMenu.setAttribute('aria-hidden', 'true');
      
      // Rétablir le scroll
      document.body.style.overflow = '';
      
      // Transformer X en hamburger
      if (menuToggle) {
        menuToggle.classList.remove('menu-active');
        menuToggle.setAttribute('aria-expanded', 'false');
      }
      
      console.log('✅ Mobile menu closed (slide-down)');
    }
    
    // Toggle du menu au clic sur le hamburger
    if (menuToggle) {
      menuToggle.addEventListener('click', function() {
        const isOpen = mobileMenu.classList.contains('translate-y-0');
        
        if (isOpen) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });
    }
    
    // Fermer au clic sur l'overlay
    if (overlay) {
      overlay.addEventListener('click', closeMobileMenu);
    }
    
    // Fermer avec la touche Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const isOpen = mobileMenu.classList.contains('translate-y-0');
        if (isOpen) {
          closeMobileMenu();
        }
        
        // Fermer aussi le bottom sheet de langue s'il est ouvert
        const mobileLangModal = document.getElementById('mobileLangModal');
        if (mobileLangModal && !mobileLangModal.classList.contains('hidden')) {
          const closeLangBtn = document.getElementById('mobileLangCloseBtn');
          if (closeLangBtn) closeLangBtn.click();
        }
      }
    });
    
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    // 🌐 MOBILE LANGUAGE BOTTOM SHEET
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    const mobileLangBtn = document.getElementById('mobileLangBtn');
    const mobileLangModal = document.getElementById('mobileLangModal');
    const mobileLangSheet = document.getElementById('mobileLangSheet');
    const mobileLangOverlay = document.getElementById('mobileLangOverlay');
    const mobileLangCloseBtn = document.getElementById('mobileLangCloseBtn');
    const mobileLangLabel = document.getElementById('mobileLangLabel');
    const mobileLangFlag = document.getElementById('mobileLangFlag');
    
    // Fonction pour ouvrir le bottom sheet
    function openLangModal() {
      if (!mobileLangModal || !mobileLangSheet || !mobileLangOverlay) return;
      
      mobileLangModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      
      // Animation d'ouverture
      setTimeout(() => {
        mobileLangOverlay.classList.remove('opacity-0');
        mobileLangOverlay.classList.add('opacity-100');
        mobileLangSheet.classList.remove('translate-y-full');
        mobileLangSheet.classList.add('translate-y-0');
      }, 10);
    }
    
    // Fonction pour fermer le bottom sheet
    function closeLangModal() {
      if (!mobileLangModal || !mobileLangSheet || !mobileLangOverlay) return;
      
      mobileLangOverlay.classList.remove('opacity-100');
      mobileLangOverlay.classList.add('opacity-0');
      mobileLangSheet.classList.remove('translate-y-0');
      mobileLangSheet.classList.add('translate-y-full');
      
      setTimeout(() => {
        mobileLangModal.classList.add('hidden');
        document.body.style.overflow = '';
      }, 400);
    }
    
    // Ouvrir le modal au clic sur le bouton
    if (mobileLangBtn) {
      mobileLangBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        openLangModal();
      });
    }
    
    // Fermer le modal
    if (mobileLangCloseBtn) {
      mobileLangCloseBtn.addEventListener('click', closeLangModal);
    }
    
    if (mobileLangOverlay) {
      mobileLangOverlay.addEventListener('click', closeLangModal);
    }
    
    // Sélection d'une langue
    const langOptions = document.querySelectorAll('.lang-option');
    langOptions.forEach(function(option) {
      option.addEventListener('click', function(e) {
        e.stopPropagation();
        const lang = this.getAttribute('data-lang');
        const flag = this.getAttribute('data-flag');
        const label = this.getAttribute('data-label');
        
        // Mettre à jour l'affichage du bouton
        if (mobileLangLabel) mobileLangLabel.textContent = label;
        if (mobileLangFlag) mobileLangFlag.src = flag;
        
        // Feedback visuel
        langOptions.forEach(opt => opt.classList.remove('bg-blue-100', 'border-blue-300'));
        this.classList.add('bg-blue-100', 'border-blue-300');
        
        // Fermer le modal après un court délai
        setTimeout(() => {
          closeLangModal();
        }, 300);
        
        // Déclencher la traduction
        console.log('🌐 Language selected:', lang);
        const event = new CustomEvent('languageChanged', { detail: { lang: lang, flag: flag } });
        document.dispatchEvent(event);
      });
    });
    
    console.log('✅ Mobile menu overlay & language bottom sheet initialized');
  });
})();
</script>

{{-- ═══════════════════════════════════════════════════════════
     🔧 HELP BUTTON INITIALIZATION
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  /**
   * Initialisation des boutons Help avec délégation d'événements
   */
  document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 [Header] Initializing help buttons...');
    
    // Gestion des boutons Help (desktop et mobile)
    document.addEventListener('click', function(e) {
      const helpBtn = e.target.closest('#helpBtn, #mobileSearchButton, #requestHelpBtn');
      
      if (helpBtn) {
        console.log('❓ [Header] Help button clicked');
        e.preventDefault();
        e.stopPropagation();
        
        if (typeof window.openHelpPopup === 'function') {
          window.openHelpPopup();
        } else {
          console.warn('⚠️ openHelpPopup() not available yet');
        }
      }
    });
    
    console.log('✅ [Header] Help buttons initialized');
  });
})();
</script>

{{-- ═══════════════════════════════════════════════════════════
     🚀 JAVASCRIPT MODULES
     ═══════════════════════════════════════════════════════════ --}}
<script src="{{ mix('js/app.js') }}"></script>

{{-- ✅ Chargez header-init.js comme module ES6 natif --}}
<script type="module" src="{{ asset('js/header-init.js') }}"></script>