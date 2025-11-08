{{-- 
  ═══════════════════════════════════════════════════════════
  🔧 SCRIPTS COMPONENT
  ═══════════════════════════════════════════════════════════
  
  Contient :
  - Toast messages (success/error)
  - Bouton Scroll To Top
  - Help button handlers
  - Laravel Mix/Vite assets
  
  Google Translate est géré par le module ES6 dans:
  resources/js/modules/google-translate/
  
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
<div id="google_translate_element" style="display:none;"></div>

{{-- ═══════════════════════════════════════════════════════════
     🌐 GOOGLE TRANSLATE - GÉRÉ PAR MODULE ES6
     ═══════════════════════════════════════════════════════════
     
     Tous les sélecteurs de langue et la logique Google Translate
     sont gérés dans le module ES6 :
     
     resources/js/modules/google-translate/
     ├── index.js (point d'entrée)
     ├── init.js (chargement API)
     ├── language-manager.js (sélecteurs UI)
     └── styles.js (CSS)
     
     Chargé via header-init.js
--}}

{{-- ═══════════════════════════════════════════════════════════
     📱 MOBILE MENU OVERLAY & SLIDE-DOWN SCRIPT
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('mobile-menu-overlay');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.getElementById('menu-toggle-top');
    
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    // 📱 MOBILE MENU - DESCEND DU HAUT
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    
    function openMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Afficher l'overlay
      overlay.classList.remove('hidden');
      setTimeout(() => overlay.classList.add('opacity-100'), 10);
      
      // Descendre le menu (enlever -translate-y-full)
      mobileMenu.classList.remove('-translate-y-full');
      mobileMenu.classList.add('translate-y-0');
      mobileMenu.setAttribute('aria-hidden', 'false');
      
      // Bloquer le scroll
      document.body.style.overflow = 'hidden';
      
      // Transformer hamburger en X
      if (menuToggle) {
        menuToggle.classList.add('menu-active');
        menuToggle.setAttribute('aria-expanded', 'true');
      }
      
      console.log('✅ Mobile menu opened (slide-down)');
    }
    
    function closeMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Masquer l'overlay
      overlay.classList.remove('opacity-100');
      setTimeout(() => overlay.classList.add('hidden'), 300);
      
      // Remonter le menu (ajouter -translate-y-full)
      mobileMenu.classList.remove('translate-y-0');
      mobileMenu.classList.add('-translate-y-full');
      mobileMenu.setAttribute('aria-hidden', 'true');
      
      // Rétablir le scroll
      document.body.style.overflow = '';
      
      // Transformer X en hamburger
      if (menuToggle) {
        menuToggle.classList.remove('menu-active');
        menuToggle.setAttribute('aria-expanded', 'false');
      }
      
      console.log('✅ Mobile menu closed (slide-up)');
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
    
    console.log('✅ Mobile menu script initialized');
  });
})();
</script>

{{-- ═══════════════════════════════════════════════════════════
     🔧 HELP BUTTON INITIALIZATION
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 [Header] Initializing help buttons...');
    
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
<script type="module" src="{{ asset('js/header-init.js') }}"></script>