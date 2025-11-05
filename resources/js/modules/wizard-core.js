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
    } catch(e) { 
      return {}; 
    }
  }

  saveState(state) {
    try {
      sessionStorage.setItem(this.storeKey, JSON.stringify(state));
      localStorage.setItem(this.storeKey, JSON.stringify(state));
    } catch(e) {
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
      el.disabled = !enabled;
      el.classList.toggle('opacity-50', !enabled);
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
    const closeBtn = document.getElementById('closePopup');
    const popup = document.getElementById('signupPopup');
    const signupBtn = document.getElementById('signupBtn');
    
    // Bouton close (X)
    if (closeBtn && popup) {
      closeBtn.addEventListener('click', () => {
        console.log('🔒 Closing signup popup via close button');
        this.closePopup();
      });
      console.log('✅ Close button attached');
    } else {
      console.warn('⚠️ Close button or popup not found');
    }
    
    // Bouton Sign Up dans le header
    if (signupBtn && popup) {
      signupBtn.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('🔓 Opening signup popup via Sign Up button');
        this.openPopup();
      });
      console.log('✅ Sign Up button attached');
    }
    
    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
        console.log('⌨️ Closing popup with Escape');
        this.closePopup();
      }
    });
    
    // Fermer en cliquant sur le backdrop
    if (popup) {
      popup.addEventListener('click', (e) => {
        if (e.target === popup) {
          console.log('🖱️ Closing popup via backdrop');
          this.closePopup();
        }
      });
    }
    
    // Exposer globalement pour usage depuis HTML (onclick="openSignupPopup()")
    window.closeSignupPopup = () => this.closePopup();
    window.openSignupPopup = () => this.openPopup();
    
    console.log('✅ Popup controls initialized');
  }

  closePopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
    
    popup.classList.add('hidden');
    console.log('✅ Popup closed');
    
    // Réinitialiser à l'étape 1
    this.resetToFirstStep();
  }

  openPopup() {
    const popup = document.getElementById('signupPopup');
    if (!popup) {
      console.warn('⚠️ Popup not found');
      return;
    }
    
    popup.classList.remove('hidden');
    console.log('✅ Popup opened');
    
    // Afficher step 1
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
    open: () => wizard.openPopup()
  };
  
  return window.providerWizard;
}