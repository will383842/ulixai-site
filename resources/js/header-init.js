/**
 * Header Initialization - Laravel Mix Compatible
 * Point d'entrée principal pour tous les modules header
 * Version optimisée avec protection popup
 */

import { initializeWizard } from './modules/wizard/wizard_provider/wizard-core.js';
import { initializeWizardSteps } from './modules/wizard/wizard_provider/wizard-steps.js';
import { initializeWizardSubmission } from './modules/wizard/wizard_provider/wizard-submission.js';
import { initializeMobileMenu } from './modules/ui/mobile-menu.js';
import { initializeLanguageManager } from './modules/ui/language-manager.js';
import { initializeCategoryPopups } from './modules/ui/category/category-popups.js';
import { initializeScrollUtils } from './modules/ui/scroll-utils.js';


/** Exécute une init en isolant les erreurs pour ne pas bloquer les autres modules */
function safeInit(name, fn) {
  try {
    console.log(`🔄 Initializing ${name}...`);
    const result = fn();
    console.log(`✅ ${name} initialized successfully`);
    return result;
  } catch (e) {
    console.error(`❌ ${name} failed:`, e);
    return null;
  }
}

function initializeAll() {
  console.log('🚀 Initializing header modules...');
  console.log('📦 Available modules:', {
    wizard: typeof initializeWizard,
    steps: typeof initializeWizardSteps,
    submission: typeof initializeWizardSubmission,
    menu: typeof initializeMobileMenu,
    language: typeof initializeLanguageManager,
    popups: typeof initializeCategoryPopups,
    scroll: typeof initializeScrollUtils
  });

  // ✅ VÉRIFICATION: Le popup existe-t-il dans le DOM ?
  const popupExists = !!document.getElementById('signupPopup');
  console.log(`📊 Signup popup ${popupExists ? '✅ FOUND' : '⚠️ NOT FOUND'} in DOM`);

  // 1) Core (popups SignUp / croix / ESC / backdrop) - Seulement si popup existe
  let wizard = null;
  if (popupExists) {
    wizard = safeInit('Wizard', initializeWizard);
  } else {
    console.log('ℹ️ Skipping Wizard initialization (user is logged in)');
  }

  // 2) Steps (wizard-steps) - Seulement si popup existe
  let steps = null;
  if (popupExists) {
    steps = safeInit('WizardSteps', initializeWizardSteps);
  } else {
    console.log('ℹ️ Skipping WizardSteps initialization (user is logged in)');
  }

  // 3) Wizard Submission - Seulement si popup existe
  if (popupExists) {
    safeInit('WizardSubmission', initializeWizardSubmission);
  } else {
    console.log('ℹ️ Skipping WizardSubmission initialization (user is logged in)');
  }

  // 4) Mobile Menu - TOUJOURS INITIALISER (indépendant du popup)
  safeInit('MobileMenu', initializeMobileMenu);
  
  // 5) Language Manager - TOUJOURS INITIALISER
  const langManager = safeInit('LanguageManager', () => {
    const manager = initializeLanguageManager();
    
    // Vérifier après 500ms si les éléments sont bien initialisés
    setTimeout(() => {
      const langBtn = document.getElementById('langBtn');
      console.log('🔍 Language button check:', {
        exists: !!langBtn,
        manager: !!window.providerLanguageManager
      });
      
      if (!langBtn) {
        console.error('❌ Language button not found in DOM!');
      }
      
      if (!window.providerLanguageManager) {
        console.error('❌ Language manager not exposed globally!');
      }
    }, 500);
    
    return manager;
  });
  
  // 6) Category Popups - TOUJOURS INITIALISER
  safeInit('CategoryPopups', initializeCategoryPopups);
  
  // 7) Scroll Utils - TOUJOURS INITIALISER
  safeInit('ScrollUtils', initializeScrollUtils);

  // 8) Wrappers globaux - Seulement si popup existe
  if (popupExists) {
    (function exposeWrappers() {
      try {
        if (!window.showStep) {
          window.showStep = function (i) {
            if (window.providerWizardSteps && typeof window.providerWizardSteps.showStep === 'function') {
              window.providerWizardSteps.showStep(i);
            } else if (steps && typeof steps.showStep === 'function') {
              steps.showStep(i);
            }
          };
        }
        if (!window.updateNavigationButtons) {
          window.updateNavigationButtons = function () {
            if (window.providerWizardSteps && typeof window.providerWizardSteps.updateNavigationButtons === 'function') {
              window.providerWizardSteps.updateNavigationButtons();
            } else if (steps && typeof steps.updateNavigationButtons === 'function') {
              steps.updateNavigationButtons();
            }
          };
        }
        console.log('✅ Global wrappers exposed');
      } catch (e) {
        console.warn('⚠️ Wrapper exposure failed', e);
      }
    })();

    // 9) Event listeners pour le wizard - Seulement si popup existe
    document.addEventListener('change', () => {
      if (typeof window.updateNavigationButtons === 'function') {
        requestAnimationFrame(() => window.updateNavigationButtons());
      }
    }, { passive: true });

    // Signal spécifique Step 2
    document.addEventListener('pw:step2:changed', () => {
      try { 
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons(); 
        }
      } catch(e) {
        console.warn('⚠️ Step2 event handler failed', e);
      }
    });
  } else {
    console.log('ℹ️ Skipping wizard event listeners (user is logged in)');
  }

  console.log('✅ All header modules initialized');
  console.log('🔍 Global objects:', {
    providerWizard: !!window.providerWizard,
    providerWizardSteps: !!window.providerWizardSteps,
    providerLanguageManager: !!window.providerLanguageManager,
    onProviderSignupSubmit: !!window.onProviderSignupSubmit
  });

  // ✅ RÉSUMÉ DE L'INITIALISATION
  console.log('📋 Initialization Summary:', {
    popupInDOM: popupExists,
    wizardInitialized: !!wizard,
    stepsInitialized: !!steps,
    mobileMenuInitialized: true,
    languageManagerInitialized: !!langManager
  });
}

// Lancer l'init quand le DOM est prêt
if (document.readyState === 'loading') {
  console.log('⏳ DOM is loading, waiting for DOMContentLoaded...');
  document.addEventListener('DOMContentLoaded', initializeAll, { once: true });
} else {
  console.log('✅ DOM already loaded, initializing now');
  initializeAll();
}