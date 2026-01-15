/**
 * ═══════════════════════════════════════════════════════════
 * Wizard Core - VERSION CORRIGÉE
 * CORRECTIONS MAJEURES :
 * - Suppression du stopPropagation agressif
 * - Event listeners directs au lieu de délégation
 * - Meilleure gestion des clics
 * - Production-safe logging (v2.0)
 * ═══════════════════════════════════════════════════════════
 */

import logger from '../../../utils/logger.js';

export class WizardCore {
  constructor() {
    this.storeKey = 'expats';
    this.steps = [];
    this.current = 0;
    this.state = this.loadState();
  }

  loadState() {
    try {
      const raw = sessionStorage.getItem(this.storeKey) || localStorage.getItem(this.storeKey) || '{}';
      return JSON.parse(raw);
    } catch (e) {
      return {};
    }
  }

  saveState(state) {
    try {
      sessionStorage.setItem(this.storeKey, JSON.stringify(state));
      localStorage.setItem(this.storeKey, JSON.stringify(state));
    } catch (e) {
      logger.error('[Wizard] Failed to save state', e);
    }
  }

  detectSteps() {
    this.steps = Array.from(document.querySelectorAll('[id^="step"]'))
      .filter(el => /^step\d+$/i.test(el.id));
  }

  updateUI() {
    this.detectSteps();
    const ok = this.validate(this.current);
    this.setBtnEnabled('#mobileNextBtn, #desktopNextBtn', ok);
  }

  setBtnEnabled(selector, enabled) {
    const nodes = document.querySelectorAll(selector);
    nodes.forEach(el => {
      try {
        el.disabled = !enabled;
      } catch (_) {}
      // Le CSS gère TOUT le reste via :disabled
    });
  }

  validate(i) {
    const stepNum = i + 1;
    const step = this.steps[i];
    if (!step) return true;

    // Appeler la validation custom en premier
    const customValidate = window[`validateStep${stepNum}`];
    if (typeof customValidate === 'function') {
      try {
        return !!customValidate();
      } catch (e) {
        logger.error(`[Wizard] validateStep${stepNum} error:`, e);
        return false;
      }
    }

    // Validation générique
    const required = step.querySelectorAll('[required]');
    for (let r = 0; r < required.length; r++) {
      const f = required[r];
      if (!f.value) return false;
    }
    return true;
  }

  init() {
    this.detectSteps();
    this.updateUI();
    this.initCloseButtons();
    logger.log('[Wizard] Core initialized');
  }

  initCloseButtons() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      logger.debug('[Wizard] Signup popup not found - user might be logged in');
      return;
    }

    // ═══════════════════════════════════════════════════════════
    // CORRECTION #1 : Bloquer uniquement les clics sur le backdrop
    // ═══════════════════════════════════════════════════════════
    popup.addEventListener('click', (e) => {
      // Si le clic est exactement sur le backdrop (pas sur le contenu)
      if (e.target === popup) {
        e.preventDefault();
        // Ne pas fermer automatiquement - seulement avec la croix
        logger.debug('[Wizard] Backdrop clicked - popup remains open');
      }
    }, false);

    // ═══════════════════════════════════════════════════════════
    // CORRECTION #2 : EVENT LISTENERS DIRECTS
    // Au lieu de délégation d'événements complexe
    // ═══════════════════════════════════════════════════════════

    // Boutons de fermeture
    const closeButtons = document.querySelectorAll(
      '#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"]'
    );

    closeButtons.forEach(btn => {
      if (btn) {
        btn.addEventListener('click', (e) => {
          logger.debug('[Wizard] Close button clicked:', btn.id || btn.className);
          e.preventDefault();
          e.stopPropagation();
          this.closePopup();
        }, false);
      }
    });

    // Boutons d'ouverture
    const openButtons = document.querySelectorAll(
      '#signupBtn, #mobileSignupBtn, [data-action="open-signup"]'
    );

    openButtons.forEach(btn => {
      if (btn) {
        btn.addEventListener('click', (e) => {
          logger.debug('[Wizard] Sign Up button clicked:', btn.id || btn.className);
          e.preventDefault();
          e.stopPropagation();
          this.openPopup();
        }, false);
      }
    });

    // ═══════════════════════════════════════════════════════════
    // ESC key pour fermer
    // ═══════════════════════════════════════════════════════════
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
        logger.debug('[Wizard] ESC pressed');
        this.closePopup();
      }
    });

    // ═══════════════════════════════════════════════════════════
    // Fonctions globales pour compatibilité
    // ═══════════════════════════════════════════════════════════
    window.openSignupPopup  = () => this.openPopup();
    window.closeSignupPopup = () => this.closePopup();

    logger.debug('[Wizard] Popup controls initialized', {
      closeButtons: closeButtons.length,
      openButtons: openButtons.length
    });
  }

  closePopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      logger.warn('[Wizard] Popup not found');
      return;
    }

    popup.classList.add('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
    popup.setAttribute('aria-hidden', 'true');
    popup.style.display = 'none';

    // Restaurer le scroll du body
    document.body.style.overflow = '';

    logger.debug('[Wizard] Popup closed');
    this.resetToFirstStep();
  }

  openPopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      logger.warn('[Wizard] Popup not found');
      return;
    }

    popup.classList.remove('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
    popup.removeAttribute('aria-hidden');
    popup.style.display = 'flex';

    // Bloquer le scroll du body
    document.body.style.overflow = 'hidden';

    logger.debug('[Wizard] Popup opened');
    this.resetToFirstStep();
  }

  resetToFirstStep() {
    const allSteps = document.querySelectorAll('[id^="step"]');
    allSteps.forEach(step => step.classList.add('hidden'));

    const step1 = document.getElementById('step1');
    if (step1) {
      step1.classList.remove('hidden');
      this.current = 0;
      logger.debug('[Wizard] Reset to step 1');
    }
  }
}

// ═══════════════════════════════════════════════════════════
// EXPORT ET INITIALISATION
// ═══════════════════════════════════════════════════════════
export function initializeWizard() {
  if (window.providerWizard) {
    logger.debug('[Wizard] Already initialized');
    return window.providerWizard;
  }

  const wizard = new WizardCore();
  wizard.init();

  // API publique pour compatibilité
  window.providerWizard = {
    update: () => wizard.updateUI(),
    close: () => wizard.closePopup(),
    open: () => wizard.openPopup(),
    wizard: wizard
  };

  logger.log('[Wizard] API exposed globally');
  return window.providerWizard;
}
