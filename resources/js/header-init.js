/**
 * Header Initialization - Laravel Mix Compatible
 * Point d'entrée principal pour tous les modules header
 */

import { initializeWizard } from './modules/wizard-core.js';
import { initializeWizardSteps } from './modules/wizard-steps.js';
import { initializeMobileMenu } from './modules/mobile-menu.js';
import { initializeLanguageManager } from './modules/language-manager.js';
import { initializeCategoryPopups } from './modules/category-popups.js';
import { initializeScrollUtils } from './modules/scroll-utils.js';

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
    menu: typeof initializeMobileMenu,
    language: typeof initializeLanguageManager,
    popups: typeof initializeCategoryPopups,
    scroll: typeof initializeScrollUtils
  });

  // 1) Core (popups SignUp / croix / ESC / backdrop) d'abord
  const wizard = safeInit('Wizard', initializeWizard);

  // 2) Steps (wizard-steps) ensuite — isolé pour ne pas bloquer le reste en cas d'erreur
  const steps = safeInit('WizardSteps', initializeWizardSteps);

  // 3) Autres features du header
  safeInit('MobileMenu', initializeMobileMenu);
  
  // 4) Language Manager avec vérification
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
  
  safeInit('CategoryPopups', initializeCategoryPopups);
  safeInit('ScrollUtils', initializeScrollUtils);

  // 5) Wrappers globaux attendus par le markup (onclick="showStep(1)" etc.)
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
    } catch (e) {
      console.warn('⚠️ Wrapper exposure failed', e);
    }
  })();

  // 6) Synchroniser l'état des boutons (phase BUBBLE, sans double logique)
  ['input','change','click'].forEach((evt) => {
    document.addEventListener(evt, () => {
      try {
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      } catch(e) {}
    }, false);
  });

  // Signal spécifique Step 2 (si émis)
  document.addEventListener('pw:step2:changed', () => {
    try { if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons(); } catch(e) {}
  });

  console.log('✅ All header modules initialized');
  console.log('🔍 Global objects:', {
    providerWizard: !!window.providerWizard,
    providerWizardSteps: !!window.providerWizardSteps,
    providerLanguageManager: !!window.providerLanguageManager
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