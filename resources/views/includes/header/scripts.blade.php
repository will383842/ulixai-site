{{-- 
  ═══════════════════════════════════════════════════════════
  🔧 SCRIPTS COMPONENT - VERSION SIMPLE ET PRO
  ═══════════════════════════════════════════════════════════
  
  Approche simple : fermeture rapide, navigation native
  Pas d'overlay compliqué qui bug
  
  @version 2.3.0 - Keep It Simple
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
     📱 MOBILE MENU SCRIPT - SIMPLE ET RAPIDE
     ═══════════════════════════════════════════════════════════ --}}
<script>
(function() {
  'use strict';
  
  document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('mobile-menu-overlay');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.getElementById('menu-toggle-top');
    
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    // 📱 MOBILE MENU - OUVERTURE & FERMETURE
    // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    
    function openMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Afficher l'overlay
      overlay.classList.remove('hidden');
      overlay.classList.add('opacity-100');
      
      // Descendre le menu
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
    }
    
    function closeMobileMenu() {
      if (!mobileMenu || !overlay) return;
      
      // Fermeture IMMÉDIATE sans animation
      overlay.classList.add('hidden');
      overlay.classList.remove('opacity-100');
      
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
    
    // ⚡ CRITIQUE : Fermer AVANT navigation (pas d'interception)
    if (mobileMenu) {
      mobileMenu.addEventListener('click', function(e) {
        // Vérifier si c'est un lien de navigation
        const link = e.target.closest('a[href]:not([href="#"]):not([target="_blank"])');
        
        if (link) {
          // Fermer immédiatement le menu
          // La navigation se fera naturellement après
          closeMobileMenu();
        }
        
        // Gérer les formulaires (logout)
        const submitBtn = e.target.closest('button[type="submit"]');
        if (submitBtn) {
          closeMobileMenu();
        }
      });
    }
    
    // Fermer avec la touche Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const isOpen = mobileMenu && mobileMenu.classList.contains('translate-y-0');
        if (isOpen) {
          closeMobileMenu();
        }
        
        // Fermer aussi le bottom sheet de langue
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
<script defer src="{{ mix('js/app.js') }}"></script>
<script type="module" src="{{ asset('js/header-init.js') }}"></script>