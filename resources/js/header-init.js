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
    return fn();
  } catch (e) {
    console.error(`❌ ${name} failed`, e);
    return null;
  }
}

function initializeAll() {
  console.log('🚀 Initializing header modules...');

  // 1) Core (popups SignUp / croix / ESC / backdrop) d'abord
  const wizard = safeInit('initializeWizard', initializeWizard);

  // 2) Steps (wizard-steps) ensuite — isolé pour ne pas bloquer le reste en cas d’erreur
  const steps = safeInit('initializeWizardSteps', initializeWizardSteps);

  // 3) Autres features du header
  safeInit('initializeMobileMenu', initializeMobileMenu);
  safeInit('initializeLanguageManager', initializeLanguageManager);
  safeInit('initializeCategoryPopups', initializeCategoryPopups);
  safeInit('initializeScrollUtils', initializeScrollUtils);

  // 4) Wrappers globaux attendus par le markup (onclick="showStep(1)" etc.)
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

  // 5) Synchroniser l'état des boutons quand l'utilisateur interagit
  ['click', 'input', 'change'].forEach((evt) => {
    document.addEventListener(evt, () => {
      try {
        if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
        if (window.providerWizard && typeof window.providerWizard.update === 'function') window.providerWizard.update();
      } catch(e) { console.debug('sync buttons skipped', e); }
    }, true);
  });

  console.log('✅ All header modules initialized');
}

// Lancer l’init quand le DOM est prêt
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeAll, { once: true });
} else {
  initializeAll();
}
