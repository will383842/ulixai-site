/**
 * Wizard Core - CORRIGÉ : Navigation stricte + Support affiliation
 * Version: 2.0
 */

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

    // ✅ DÉLÉGATION D'ÉVÉNEMENTS - Mode Bubble (pas Capture)
    document.addEventListener('click', (e) => {
      const t = e.target;
      if (!t || !t.closest) return;

      // ✅ PRIORITÉ 1 : Ne JAMAIS intercepter les liens <a> avec href
      const link = t.closest('a[href]');
      if (link) {
        const href = link.getAttribute('href');
        // Laisser passer tous les liens normaux (login, become-provider, etc.)
        if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
          console.log('🔗 Lien détecté, laisser passer:', href);
          return; // Ne rien faire, naviguer normalement
        }
      }

      // ✅ PRIORITÉ 2 : Ouvrir le popup signup (pour l'affiliation)
      const openSignup = t.closest('#signupBtn, #mobileSignupBtn, [data-action="open-signup"]');
      if (openSignup) {
        console.log('📝 Bouton Sign Up cliqué');
        e.preventDefault();
        e.stopPropagation();
        this.openPopup();
        return;
      }

      // ✅ PRIORITÉ 3 : Ouvrir le popup help
      const openHelp = t.closest(
        '#requestHelpBtn, #helpBtn, #mobileSearchButton, [data-open="help"]'
      );
      if (openHelp) {
        console.log('❓ Bouton Help cliqué');
        e.preventDefault();
        e.stopPropagation();
        if (typeof window.openHelpPopup === 'function') {
          window.openHelpPopup();
        } else {
          console.warn('⚠️ openHelpPopup() non disponible');
        }
        return;
      }

      // ✅ PRIORITÉ 4 : Fermer le popup
      const closeBtn = t.closest(
        '#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"]'
      );
      if (closeBtn) {
        console.log('❌ Bouton Close cliqué');
        e.preventDefault();
        e.stopPropagation();
        this.closePopup();
        return;
      }

      // ✅ PRIORITÉ 5 : Clic sur le backdrop (fond noir)
      if (popup && e.target === popup) {
        console.log('🖱️ Clic sur backdrop');
        this.closePopup();
      }
    }, false); // ✅ FALSE = mode bubble (événements montent du bas vers le haut)

    // ✅ ESC key pour fermer
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
        console.log('⌨️ ESC pressed');
        this.closePopup();
      }
    });

    // ✅ Fonctions globales pour compatibilité
    window.openSignupPopup  = () => this.openPopup();
    window.closeSignupPopup = () => this.closePopup();

    console.log('✅ Popup controls initialized (affiliation-ready)');
  }

  closePopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
    
    // Masquer le popup
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
    
    // Afficher le popup
    popup.classList.remove('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
    popup.removeAttribute('aria-hidden');
    
    // ✅ IMPORTANT : Utiliser flex pour le centrage (pas block)
    popup.style.display = 'flex';

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

  // ✅ API publique pour compatibilité + affiliation
  window.providerWizard = {
    update: () => wizard.updateUI(),
    close: () => wizard.closePopup(),
    open: () => wizard.openPopup(),
    wizard: wizard // Exposer l'instance pour debug
  };

  console.log('✅ Wizard API exposed globally');
  return window.providerWizard;
}