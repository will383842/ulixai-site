/**
 * ═══════════════════════════════════════════════════════════
 * Wizard Core - VERSION PROPRE
 * ✅ Le JavaScript ne touche JAMAIS au style
 * ✅ Gère uniquement btn.disabled = true/false
 * ✅ NE SE FERME QUE AVEC LA CROIX
 * ═══════════════════════════════════════════════════════════
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
      try { 
        el.disabled = !enabled; 
      } catch (_) {}
      // ✅ Le CSS gère TOUT le reste via :disabled
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
    if (!popup) {
      console.log('ℹ️ Signup popup not found - user might be logged in');
      return;
    }

    // ═══════════════════════════════════════════════════════════
    // 🛡️ EMPÊCHER LA FERMETURE AU CLIC EXTÉRIEUR
    // ═══════════════════════════════════════════════════════════
    const popupContainer = popup.querySelector('.bg-white');
    if (popupContainer) {
      popupContainer.addEventListener('click', (e) => {
        // Empêcher la propagation vers le backdrop
        e.stopPropagation();
      }, true);
    }

    // ═══════════════════════════════════════════════════════════
    // 🔧 DÉLÉGATION D'ÉVÉNEMENTS STRICTE
    // ═══════════════════════════════════════════════════════════
    
    document.addEventListener('click', (e) => {
      const target = e.target;
      if (!target || !target.closest) return;

      // ═══════════════════════════════════════════════════════════
      // 🎯 PRIORITÉ 1 : Boutons d'ouverture du popup signup
      // ═══════════════════════════════════════════════════════════
      const signupBtn = target.closest('#signupBtn, #mobileSignupBtn, [data-action="open-signup"]');
      
      if (signupBtn) {
        console.log('📝 [Wizard] Sign Up button clicked');
        e.preventDefault();
        e.stopPropagation();
        this.openPopup();
        return;
      }

      // ═══════════════════════════════════════════════════════════
      // 🎯 PRIORITÉ 2 : Boutons de fermeture du popup
      // ═══════════════════════════════════════════════════════════
      const closeBtn = target.closest(
        '#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"]'
      );
      
      if (closeBtn) {
        console.log('❌ [Wizard] Close button clicked');
        e.preventDefault();
        e.stopPropagation();
        this.closePopup();
        return;
      }

      // ═══════════════════════════════════════════════════════════
      // ❌ CLIC SUR LE BACKDROP DÉSACTIVÉ
      // Le popup ne se ferme QUE avec la croix
      // ═══════════════════════════════════════════════════════════
      // Ancien code commenté :
      // if (popup && e.target === popup && !popup.classList.contains('hidden')) {
      //   console.log('🖱️ [Wizard] Backdrop clicked');
      //   this.closePopup();
      //   return;
      // }

    }, false);

    // ═══════════════════════════════════════════════════════════
    // ⌨️ ESC key pour fermer - DÉSACTIVÉ AUSSI
    // ═══════════════════════════════════════════════════════════
    // document.addEventListener('keydown', (e) => {
    //   if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
    //     console.log('⌨️ [Wizard] ESC pressed');
    //     this.closePopup();
    //   }
    // });

    // ═══════════════════════════════════════════════════════════
    // 🌍 Fonctions globales pour compatibilité
    // ═══════════════════════════════════════════════════════════
    window.openSignupPopup  = () => this.openPopup();
    window.closeSignupPopup = () => this.closePopup();

    console.log('✅ Popup controls initialized (backdrop click DISABLED, ESC DISABLED)');
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

// ═══════════════════════════════════════════════════════════
// 🚀 EXPORT ET INITIALISATION
// ═══════════════════════════════════════════════════════════
export function initializeWizard() {
  if (window.providerWizard) {
    console.log('⚠️ Wizard already initialized');
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

  console.log('✅ Wizard API exposed globally');
  return window.providerWizard;
}