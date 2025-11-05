/**
 * Header Initialization
 * Point d'entrée central pour tous les composants du header
 */

import { GoogleTranslateManager } from './utils/google-translate.js';
import { MobileMenu } from './components/mobile-menu.js';
import { WizardCore } from './components/wizard/wizard-core.js';
import { CategoryManager } from './components/category-manager.js';

/**
 * Initialize all header components
 */
document.addEventListener('DOMContentLoaded', function() {
  
  // ============================================
  // 1. Google Translate
  // ============================================
  const translator = new GoogleTranslateManager();
  translator.init();
  
  // Setup desktop language menu
  translator.setupListeners('langMenu');
  
  // Setup mobile language menu
  translator.setupListeners('languageMenu');

  // ============================================
  // 2. Mobile Menu
  // ============================================
  const mobileMenu = new MobileMenu({
    menuId: 'mobile-menu',
    toggleIds: ['menu-toggle-top'],
    closeButtonId: 'mobileMenuCloseBtn'
  });

  // ============================================
  // 3. Signup Wizard
  // ============================================
  const wizard = new WizardCore({
    storeKey: 'pw.state',
    totalSteps: 16
  });

  // Expose wizard globally for compatibility
  window.providerWizard = {
    next: () => wizard.next(),
    prev: () => wizard.prev(),
    goto: (stepNumber) => wizard.goto(stepNumber - 1), // Convert 1-based to 0-based
    update: () => wizard.updateUI()
  };

  // Legacy aliases
  window.goToStep = (n) => wizard.goto(n - 1);
  window.nextStep = () => wizard.next();
  window.prevStep = () => wizard.prev();
  window.refreshWizardUI = () => wizard.updateUI();

  // ============================================
  // 4. Category Manager (Help Popup)
  // ============================================
  const categoryManager = new CategoryManager();
  categoryManager.init();

  // ============================================
  // 5. Signup Popup Controls
  // ============================================
  const popup = document.getElementById('signupPopup');
  const closePopupBtn = document.getElementById('closePopup');
  const signupBtn = document.getElementById('signupBtn');

  if (signupBtn && popup) {
    signupBtn.addEventListener('click', () => {
      popup.classList.remove('hidden');
      wizard.goto(0);
    });
  }

  if (closePopupBtn && popup) {
    closePopupBtn.addEventListener('click', () => {
      popup.classList.add('hidden');
    });
  }

  if (popup) {
    popup.addEventListener('click', (e) => {
      if (e.target === popup) {
        popup.classList.add('hidden');
      }
    });
  }

  // Intercept "Become a provider" links
  document.addEventListener('click', function(e) {
    const link = e.target.closest('a[href="/become-service-provider"]');
    if (!link) return;
    
    if (popup) {
      e.preventDefault();
      popup.classList.remove('hidden');
      wizard.goto(0);
    }
  }, true);

  // ============================================
  // 6. Scroll to Top Button
  // ============================================
  const scrollBtn = document.getElementById('scrollToTopBtn');
  
  if (scrollBtn) {
    let scrollTimer;
    
    window.addEventListener('scroll', () => {
      clearTimeout(scrollTimer);
      
      scrollTimer = setTimeout(() => {
        if (window.innerWidth > 768) {
          scrollBtn.className = window.pageYOffset > 400 ? 'show' : '';
        }
      }, 100);
    });

    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ============================================
  // 7. User Display Names (Truncation)
  // ============================================
  function extractFirstName(fullName) {
    const cleanName = fullName.replace(/[^\w\s]/g, '').trim();
    const nameParts = cleanName.split(/\s+/);
    return nameParts[0] || cleanName;
  }

  function updateUserDisplayNames() {
    const headerUserName = document.getElementById('header-user-name');
    if (headerUserName) {
      const fullName = headerUserName.textContent.trim();
      headerUserName.textContent = extractFirstName(fullName);
    }

    const headerUserFullname = document.getElementById('header-user-fullname');
    if (headerUserFullname) {
      const fullName = headerUserFullname.textContent.trim();
      headerUserFullname.textContent = extractFirstName(fullName);
    }

    const sidebarGreeting = document.getElementById('user-greeting');
    if (sidebarGreeting) {
      const fullGreeting = sidebarGreeting.textContent.trim();
      const firstName = extractFirstName(fullGreeting);
      sidebarGreeting.textContent = firstName + '!';
    }
  }

  updateUserDisplayNames();

  // ============================================
  // 8. Coming Soon Popup (SOS)
  // ============================================
  window.showComingSoonPopup = function(e) {
    if (e && e.preventDefault) e.preventDefault();
    const sosPopup = document.getElementById('sos-popup');
    if (sosPopup) sosPopup.classList.remove('hidden');
  };

  window.closeComingSoonPopup = function() {
    const sosPopup = document.getElementById('sos-popup');
    if (sosPopup) sosPopup.classList.add('hidden');
  };

  // ============================================
  // 9. Language Selector Dropdown (Desktop)
  // ============================================
  const langBtn = document.getElementById('langBtn');
  const langMenu = document.getElementById('langMenu');

  if (langBtn && langMenu) {
    langBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      langMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(e) {
      if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
        langMenu.classList.add('hidden');
      }
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && !langMenu.classList.contains('hidden')) {
        langMenu.classList.add('hidden');
      }
    });
  }

  // ============================================
  // 10. Prevent Scroll Restoration
  // ============================================
  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
  }
  
  window.addEventListener('load', () => {
    window.scrollTo(0, 0);
  });
});