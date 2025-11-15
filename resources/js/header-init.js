/**
 * Header Initialization - Professional Modular Architecture
 * Each feature is a self-contained module with a single entry point
 * 
 * @version 2.1.0 - CORRECTION BOUCLE INFINIE
 * @author ULIXAI Team
 */

// ═══════════════════════════════════════════════════════════
// IMPORTS - Feature Modules
// ═══════════════════════════════════════════════════════════

// Google Translate Module (complete package)
import { initializeGoogleTranslateModule } from './modules/google-translate/index.js';

// Wizard Modules (Provider signup flow)
import { initializeWizard } from './modules/wizard/wizard_provider/wizard-core.js';
import { initializeWizardSteps } from './modules/wizard/wizard_provider/wizard-steps.js';
import { initializeWizardSubmission } from './modules/wizard/wizard_provider/wizard-submission.js';

// UI Modules
import { initializeMobileMenu } from './modules/ui/mobile-menu.js';
import { initializeCategoryPopups } from './modules/ui/category/category-popups.js';
import { initializeScrollUtils } from './modules/ui/scroll-utils.js';

// ═══════════════════════════════════════════════════════════
// UTILITY FUNCTIONS
// ═══════════════════════════════════════════════════════════

/**
 * Safe initialization wrapper
 * Isolates errors to prevent one module from breaking others
 * 
 * @param {string} name - Module name for logging
 * @param {Function} fn - Initialization function
 * @returns {*} Result of initialization or null on error
 */
async function safeInit(name, fn) {
  try {
    console.log(`🔄 [Header] Initializing ${name}...`);
    const result = await fn();
    console.log(`✅ [Header] ${name} initialized successfully`);
    return result;
  } catch (e) {
    console.error(`❌ [Header] ${name} failed:`, e);
    return null;
  }
}

// ═══════════════════════════════════════════════════════════
// MAIN INITIALIZATION
// ═══════════════════════════════════════════════════════════

/**
 * Initialize all header modules in the correct order
 * Handles conditional loading based on user state
 */
async function initializeAll() {
  console.log('🚀 [Header] Starting initialization...');
  console.log('📦 [Header] Available modules:', {
    googleTranslate: typeof initializeGoogleTranslateModule,
    wizard: typeof initializeWizard,
    steps: typeof initializeWizardSteps,
    submission: typeof initializeWizardSubmission,
    menu: typeof initializeMobileMenu,
    popups: typeof initializeCategoryPopups,
    scroll: typeof initializeScrollUtils
  });

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // CHECK: Is signup popup present? (indicates logged out user)
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  const popupExists = !!document.getElementById('signupPopup');
  console.log(`📊 [Header] Signup popup ${popupExists ? '✅ FOUND' : '⚠️ NOT FOUND'} in DOM`);

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // 1. GOOGLE TRANSLATE MODULE (always initialize first)
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  await safeInit('GoogleTranslateModule', async () => {
    return await initializeGoogleTranslateModule();
  });

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // 2. WIZARD MODULES (conditional - only if popup exists)
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  let wizard = null;
  let steps = null;

  if (popupExists) {
    console.log('👤 [Header] User not logged in - initializing wizard...');
    
    // Core wizard (popup open/close, backdrop, ESC key)
    wizard = await safeInit('Wizard', async () => initializeWizard());
    
    // Wizard steps (navigation, validation)
    steps = await safeInit('WizardSteps', async () => initializeWizardSteps());
    
    // Wizard submission (form processing)
    await safeInit('WizardSubmission', async () => initializeWizardSubmission());
  } else {
    console.log('ℹ️ [Header] User logged in - skipping wizard initialization');
  }

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // 3. UI MODULES (always initialize)
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  
  // Mobile hamburger menu
  await safeInit('MobileMenu', async () => initializeMobileMenu());
  
  // Category selection popups (help request flow)
  await safeInit('CategoryPopups', async () => initializeCategoryPopups());
  
  // Scroll utilities (back to top button, etc.)
  await safeInit('ScrollUtils', async () => initializeScrollUtils());

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // 4. WIZARD GLOBAL WRAPPERS (conditional)
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  if (popupExists) {
    exposeWizardWrappers(steps);
    setupWizardEventListeners();
  } else {
    console.log('ℹ️ [Header] Skipping wizard wrappers (user logged in)');
  }

  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  // INITIALIZATION COMPLETE
  // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  console.log('✅ [Header] All modules initialized');
  console.log('🔍 [Header] Global objects:', {
    providerWizard: !!window.providerWizard,
    providerWizardSteps: !!window.providerWizardSteps,
    providerLanguageManager: !!window.providerLanguageManager,
    ulixaiGoogleTranslate: !!window.ulixaiGoogleTranslate,
    onProviderSignupSubmit: !!window.onProviderSignupSubmit
  });

  console.log('📋 [Header] Initialization Summary:', {
    popupInDOM: popupExists,
    wizardInitialized: !!wizard,
    stepsInitialized: !!steps,
    mobileMenuInitialized: true,
    googleTranslateInitialized: !!window.ulixaiGoogleTranslate
  });
}

// ═══════════════════════════════════════════════════════════
// WIZARD HELPER FUNCTIONS
// ═══════════════════════════════════════════════════════════

/**
 * Expose wizard functions globally for legacy compatibility
 * Some inline scripts may still reference these functions
 * 
 * @param {Object} steps - WizardSteps instance
 */
function exposeWizardWrappers(steps) {
  try {
    // Global showStep function
    if (!window.showStep) {
      window.showStep = function(i) {
        if (window.providerWizardSteps && typeof window.providerWizardSteps.showStep === 'function') {
          window.providerWizardSteps.showStep(i);
        } else if (steps && typeof steps.showStep === 'function') {
          steps.showStep(i);
        } else {
          console.warn('⚠️ [Header] showStep called but no implementation available');
        }
      };
    }

    // Global updateNavigationButtons function
    if (!window.updateNavigationButtons) {
      window.updateNavigationButtons = function() {
        if (window.providerWizardSteps && typeof window.providerWizardSteps.updateNavigationButtons === 'function') {
          window.providerWizardSteps.updateNavigationButtons();
        } else if (steps && typeof steps.updateNavigationButtons === 'function') {
          steps.updateNavigationButtons();
        } else {
          console.warn('⚠️ [Header] updateNavigationButtons called but no implementation available');
        }
      };
    }

    console.log('✅ [Header] Wizard global wrappers exposed');
  } catch (e) {
    console.warn('⚠️ [Header] Failed to expose wizard wrappers:', e);
  }
}

/**
 * Setup event listeners for wizard functionality
 * Handles form changes and custom wizard events
 * 
 * ✅ CORRECTION: Guard anti-boucle infinie ajouté
 */
function setupWizardEventListeners() {
  // ═══════════════════════════════════════════════════════════
  // 🛡️ PROTECTION CONTRE LA BOUCLE INFINIE
  // ═══════════════════════════════════════════════════════════
  let isUpdating = false;
  let updateTimeout = null;

  // Update navigation buttons on any form change
  document.addEventListener('change', (e) => {
    // ✅ GUARD #1: Si on est déjà en train de mettre à jour, ignorer
    if (isUpdating) {
      console.log('⚠️ [Header] Already updating navigation - skipping');
      return;
    }

    // ✅ GUARD #2: Ignorer les événements sur les éléments disabled
    if (e.target && e.target.disabled) {
      return;
    }

    if (typeof window.updateNavigationButtons === 'function') {
      // ✅ DEBOUNCE: Éviter les appels répétés
      if (updateTimeout) {
        clearTimeout(updateTimeout);
      }

      updateTimeout = setTimeout(() => {
        isUpdating = true;
        
        try {
          console.log('🔄 [Header] Updating navigation buttons (debounced)');
          window.updateNavigationButtons();
        } catch (e) {
          console.error('❌ [Header] Error updating navigation:', e);
        } finally {
          // ✅ Toujours réinitialiser le flag, même en cas d'erreur
          setTimeout(() => {
            isUpdating = false;
            updateTimeout = null;
          }, 100);
        }
      }, 150); // 150ms de délai
    }
  }, { passive: true });

  // Handle Step 2 specific change events
  document.addEventListener('pw:step2:changed', () => {
    try {
      if (typeof window.updateNavigationButtons === 'function' && !isUpdating) {
        isUpdating = true;
        window.updateNavigationButtons();
        setTimeout(() => { isUpdating = false; }, 100);
      }
    } catch (e) {
      console.warn('⚠️ [Header] Step2 event handler failed:', e);
      isUpdating = false;
    }
  });

  console.log('✅ [Header] Wizard event listeners setup (with anti-loop protection)');
}

// ═══════════════════════════════════════════════════════════
// BOOTSTRAP - Initialize when DOM is ready
// ═══════════════════════════════════════════════════════════

if (document.readyState === 'loading') {
  console.log('⏳ [Header] DOM is loading, waiting for DOMContentLoaded...');
  document.addEventListener('DOMContentLoaded', initializeAll, { once: true });
} else {
  console.log('✅ [Header] DOM already loaded, initializing now');
  initializeAll();
}