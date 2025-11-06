/**
 * Wizard Core - CORRIGÉ
 */

export class WizardCore {
  constructor() {
    this.storeKey = 'provider-signup-data'; // ✅ CORRIGÉ : Harmonisé avec wizard-steps.js
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
    this.setBtnEnabled('#mobileNextBtn, #desktopNextBtn', ok);
  }

  setBtnEnabled(selector, enabled) {
    const nodes = document.querySelectorAll(selector);
    nodes.forEach(el => {
      try { el.disabled = !enabled; } catch (_) {}
      el.classList.toggle('opacity-50', !enabled);
      el.classList.toggle('cursor-not-allowed', !enabled);
      el.style.pointerEvents = enabled ? 'auto' : 'none';
      el.style.opacity = enabled ? '1' : '0.5';
    });
  }

  validate(i) {
    const stepNum = i + 1;
    const step = this.steps[i];
    if (!step) return true;
    
    // ✅ APPELER LA VALIDATION CUSTOM EN PREMIER
    const customValidate = window[`validateStep${stepNum}`];
    if (typeof customValidate === 'function') {
      try {
        return !!customValidate();
      } catch (e) {
        console.error(`validateStep${stepNum} error:`, e);
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
    console.log('✅ Wizard core initialized');
  }

  initCloseButtons() {
    const popup = document.getElementById('signupPopup');

    document.addEventListener('click', (e) => {
      const t = e.target;
      if (!t || !t.closest) return;

      const openSignup = t.closest(
        '#signupBtn, [data-open="signup"], .js-open-signup, [data-action="open-signup"], a[href="#signupPopup"], [data-target="#signupPopup"], [aria-controls="signupPopup"]'
      );
      if (openSignup) {
        e.preventDefault();
        this.openPopup();
        return;
      }

      const openHelp = t.closest(
        '#requestHelpBtn, #helpBtn, [data-open="help"], .js-open-help, [data-action="open-help"], a[href="#helpPopup"], [data-target="#helpPopup"]'
      );
      if (openHelp) {
        e.preventDefault();
        if (typeof window.openHelpPopup === 'function') {
          window.openHelpPopup();
        } else {
          console.warn('openHelpPopup() non disponible');
        }
        return;
      }

      const closeBtn = t.closest(
        '#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"], .modal-close, [aria-label="Close"]'
      );
      if (closeBtn) {
        e.preventDefault();
        this.closePopup();
        return;
      }

      if (popup && e.target === popup) {
        this.closePopup();
      }
    }, true);

    const directOpen = document.getElementById('signupBtn');
    if (directOpen) {
      directOpen.addEventListener('click', (e) => { e.preventDefault(); this.openPopup(); });
    }
    const directClose = document.getElementById('closePopup');
    if (directClose) {
      directClose.addEventListener('click', (e) => { e.preventDefault(); this.closePopup(); });
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
        this.closePopup();
      }
    });

    window.openSignupPopup  = () => this.openPopup();
    window.closeSignupPopup = () => this.closePopup();

    console.log('✅ Popup controls initialized');
  }

  closePopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
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