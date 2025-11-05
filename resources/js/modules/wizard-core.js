/**
 * Wizard Core - Gestion de base du wizard provider
 * Gère l'état, la validation et les boutons
 */

export class WizardCore {
  constructor() {
    this.storeKey = 'pw.state';
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
      console.error('Failed to save state', e);
    }
  }

  detectSteps() {
    this.steps = Array.from(document.querySelectorAll('[id^="step"]'))
      .filter(el => /^step\d+$/i.test(el.id));
  }

  updateUI() {
    this.detectSteps();
    const ok = this.validate(this.current);
    this.setBtnEnabled('#mobileNextBtn, #nextBtn, .btn-next, [data-action="next"]', ok);
  }

  setBtnEnabled(selector, enabled) {
    const nodes = document.querySelectorAll(selector);
    nodes.forEach(el => {
      try { el.disabled = !enabled; } catch (_) {}
      el.classList.toggle('opacity-50', !enabled);
      el.classList.toggle('cursor-not-allowed', !enabled);
    });
  }

  validate(i) {
    const step = this.steps[i];
    if (!step) return true;
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
    console.log('✅ Wizard core initialized');
  }

  initCloseButtons() {
    const popup = document.getElementById('signupPopup');

    // --- DÉLÉGATION ROBUSTE (capture) ---
    document.addEventListener('click', (e) => {
      const t = e.target;
      if (!t || !t.closest) return;

      // OUVRIR SIGN UP (toutes variantes courantes)
      const openSignup = t.closest(
        '#signupBtn, [data-open="signup"], .js-open-signup, [data-action="open-signup"], a[href="#signupPopup"], [data-target="#signupPopup"], [aria-controls="signupPopup"]'
      );
      if (openSignup) {
        e.preventDefault();
        this.openPopup();
        return;
      }

      // OUVRIR REQUEST HELP (délégué à category-popups.js)
      const openHelp = t.closest(
        '#requestHelpBtn, #helpBtn, [data-open="help"], .js-open-help, [data-action="open-help"], a[href="#helpPopup"], [data-target="#helpPopup"]'
      );
      if (openHelp) {
        e.preventDefault();
        if (typeof window.openHelpPopup === 'function') {
          window.openHelpPopup();
        } else {
          console.warn('openHelpPopup() non disponible – vérifier initializeCategoryPopups()');
        }
        return;
      }

      // FERMER SIGN UP (croix + variantes)
      const closeBtn = t.closest(
        '#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"], .modal-close, [aria-label="Close"]'
      );
      if (closeBtn) {
        e.preventDefault();
        this.closePopup();
        return;
      }

      // FERMETURE via BACKDROP
      if (popup && e.target === popup) {
        this.closePopup();
      }
    }, true); // capture=true pour intercepter tôt

    // Fallback direct si éléments présents à l'init (au cas où)
    const directOpen = document.getElementById('signupBtn');
    if (directOpen) {
      directOpen.addEventListener('click', (e) => { e.preventDefault(); this.openPopup(); });
    }
    const directClose = document.getElementById('closePopup');
    if (directClose) {
      directClose.addEventListener('click', (e) => { e.preventDefault(); this.closePopup(); });
    }

    // ESC pour fermer
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
        this.closePopup();
      }
    });

    // Globals pour compatibilité HTML inline
    window.openSignupPopup  = () => this.openPopup();
    window.closeSignupPopup = () => this.closePopup();

    console.log('✅ Popup controls initialized (delegated, signup + help)');
  }

  closePopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
    // Ajoute toutes les classes de masquage usuelles
    popup.classList.add('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
    popup.setAttribute('aria-hidden', 'true');
    popup.style.display = 'none';

    console.log('✅ Popup closed');
    this.resetToFirstStep();
  }

  openPopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
    // Retire toutes les classes de masquage usuelles
    popup.classList.remove('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
    popup.removeAttribute('aria-hidden');
    popup.style.display = 'block';

    console.log('✅ Popup opened');
    this.resetToFirstStep();
  }

  resetToFirstStep() {
    const allSteps = document.querySelectorAll('[id^="step"]');
    allSteps.forEach(step => step.classList.add('hidden'));
    const step1 = document.getElementById('step1');
    if (step1) {
      step1.classList.remove('hidden');
      this.current = 0;
      console.log('✅ Reset to step 1');
    }
  }
}

export function initializeWizard() {
  if (window.providerWizard) {
    console.log('⚠️ Wizard already initialized');
    return window.providerWizard;
  }

  const wizard = new WizardCore();
  wizard.init();

  window.providerWizard = {
    update: () => wizard.updateUI(),
    close: () => wizard.closePopup(),
    open: () => wizard.openPopup(),
  };

  return window.providerWizard;
}
