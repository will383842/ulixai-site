/**
 * Header Initialization - Laravel Mix Compatible
 * Point d'entrée principal pour tous les modules header
 */

// Import des modules
import { initializeWizard } from './modules/wizard-core.js';
import { initializeWizardSteps } from './modules/wizard-steps.js';
import { initializeMobileMenu } from './modules/mobile-menu.js';
import { initializeLanguageManager } from './modules/language-manager.js';
import { initializeCategoryPopups } from './modules/category-popups.js';
import { initializeScrollUtils } from './modules/scroll-utils.js';

// Attendre que DOM soit prêt
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeAll);
} else {
  initializeAll();
}

function initializeAll() {
  console.log('🚀 Initializing header modules...');

  // 1. Wizard Core
  initializeWizard();

  // 2. Wizard Steps
  initializeWizardSteps();

  // 3. Mobile Menu
  initializeMobileMenu();

  // 4. Language Manager
  initializeLanguageManager();

  // 5. Category Popups
  initializeCategoryPopups();

  // 6. Scroll Utils
  initializeScrollUtils();


  // 8. Synchro boutons après interactions
  ['click', 'input', 'change'].forEach((evt) => {
    document.addEventListener(evt, () => {
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
      if (window.providerWizard && typeof window.providerWizard.update === 'function') {
        window.providerWizard.update();
      }
    }, true);
  });

  // 9. Validation Step 2 renforcée
  window.validateStep = ((orig) => {
    return function (i) {
      if (i === 1) {
        if (document.querySelector('#step2 input[type="radio"]:checked')) return true;
        if (document.querySelector('#step2 .language-card.selected, #step2 .language-card[aria-checked="true"]')) return true;
        if (document.querySelector('#step2 .lang-btn.bg-blue-900, #step2 .lang-btn[aria-pressed="true"], #step2 .lang-btn.selected, #step2 .lang-btn.text-white')) return true;
        return false;
      }
      return orig ? orig(i) : true;
    };
  })(window.validateStep);

  console.log('✅ All header modules initialized');
}