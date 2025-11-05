/**
 * Wizard Steps - Logique complète des 16 étapes du formulaire provider
 * Version corrigée (navigation Step 1 masquée, validation réelle Steps 2+)
 * ESM compatible
 */

export class WizardSteps {
  constructor() {
    this.currentStep = 0;
    this.totalSteps = 16;
    this.formData = this.loadFormData();
  }

  // =============== STATE PERSISTENCE ===============
  loadFormData() {
    try {
      const data = localStorage.getItem('provider-signup-data');
      return data ? JSON.parse(data) : {};
    } catch (e) {
      return {};
    }
  }

  saveFormData() {
    try {
      localStorage.setItem('provider-signup-data', JSON.stringify(this.formData));
    } catch (e) {
      console.error('Failed to save form data', e);
    }
  }

  // =============== INIT ===============
  init() {
    console.log('🎯 Wizard steps: initializing...');

    this.initNavigationButtons();
    this.initStepValidation();
    this.initProgressBar();
    this.showStep(0);

    // Exposer globalement (back-compat)
    window.wizardSteps = this;

    console.log('✅ Wizard steps initialized');
  }

  // Branche les boutons Next/Back (mobile & desktop)
  initNavigationButtons() {
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
    nextButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.nextStep();
      });
    });

    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    backButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.previousStep();
      });
    });
  }

  // Écoute les inputs pour revalider dynamiquement
  initStepValidation() {
    for (let i = 1; i <= this.totalSteps; i++) {
      const stepEl = document.getElementById(`step${i}`);
      if (!stepEl) continue;

      const handler = () => this.updateNavigationButtons();
      stepEl.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('input', handler);
        el.addEventListener('change', handler);
      });
    }
  }

  // =============== PROGRESS BAR ===============
  initProgressBar() {
    this.updateProgressBar();
  }

  updateProgressBar() {
    const currentNum = document.getElementById('currentStepNum');
    const percentage = document.getElementById('progressPercentage');
    const mobileBar = document.getElementById('mobileProgressBar');

    if (currentNum) currentNum.textContent = String(this.currentStep + 1);
    const pct = Math.round(((this.currentStep + 1) / this.totalSteps) * 100);
    if (percentage) percentage.textContent = String(pct);
    if (mobileBar) mobileBar.style.width = `${pct}%`;
  }

  // =============== NAVIGATION ===============
  showStep(stepIndex) {
    if (stepIndex < 0 || stepIndex >= this.totalSteps) {
      console.warn(`⚠️ Invalid step index: ${stepIndex}`);
      return;
    }

    // Cacher toutes les étapes
    for (let i = 1; i <= this.totalSteps; i++) {
      const step = document.getElementById(`step${i}`);
      if (step) step.classList.add('hidden');
    }

    // Afficher l'étape demandée
    const currentStep = document.getElementById(`step${stepIndex + 1}`);
    if (!currentStep) {
      console.error(`❌ Step ${stepIndex + 1} not found in DOM`);
      return;
    }
    currentStep.classList.remove('hidden');
    this.currentStep = stepIndex;

    this.updateProgressBar();
    this.updateNavigationButtons();
  }

  nextStep() {
    if (!this.validateCurrentStep()) {
      console.warn(`⚠️ Validation failed for step ${this.currentStep + 1}`);
      return;
    }
    this.saveCurrentStepData();

    if (this.currentStep < this.totalSteps - 1) {
      this.showStep(this.currentStep + 1);
    } else {
      this.submitForm();
    }
  }

  previousStep() {
    if (this.currentStep > 0) {
      this.showStep(this.currentStep - 1);
    }
  }

  // =============== VALIDATION & UI ===============
  validateCurrentStep() {
    const stepNum = this.currentStep + 1;
    const el = document.getElementById(`step${stepNum}`);
    if (!el) return true;

    // Validateur spécifique : window.validateStepX
    const custom = window[`validateStep${stepNum}`];
    if (typeof custom === 'function') {
      try { return !!custom(); }
      catch (e) {
        console.warn('validateStep error', e);
        return false;
      }
    }

    // Fallback : tous les [data-required] doivent être remplis/cochés
    const req = el.querySelectorAll('[data-required]');
    if (req.length === 0) return true;

    for (const input of req) {
      if (['checkbox','radio'].includes(input.type)) {
        if (!input.checked) return false;
      } else {
        if (String(input.value || '').trim() === '') return false;
      }
    }
    return true;
  }

  updateNavigationButtons() {
    const mobileWrap  = document.getElementById('mobileNavButtons');
    const desktopWrap = document.getElementById('desktopNavButtons');
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');

    // Step 1 : cacher totalement la navigation
    if (this.currentStep === 0) {
      if (mobileWrap)  mobileWrap.style.display  = 'none';
      if (desktopWrap) desktopWrap.style.display = 'none';
    } else {
      if (mobileWrap)  mobileWrap.style.display  = '';
      if (desktopWrap) desktopWrap.style.display = '';
    }

    // Back visible à partir du Step 2
    backButtons.forEach(btn => { btn.style.display = (this.currentStep === 0 ? 'none' : 'flex'); });

    // Libellé du bouton Next
    nextButtons.forEach(btn => {
      const span = btn.querySelector('span');
      if (span) span.textContent = (this.currentStep === this.totalSteps - 1) ? 'Submit' : 'Continue';
    });

    // Déverrouiller selon la validation du step courant
    const isValid = (this.currentStep === 0) ? false : this.validateCurrentStep();
    nextButtons.forEach(btn => {
      btn.disabled = !isValid;
      btn.classList.toggle('opacity-50', !isValid);
      btn.classList.toggle('cursor-not-allowed', !isValid);
    });

    console.log(`🔘 Navigation buttons updated (step ${this.currentStep + 1}, valid=${isValid})`);
  }

  // =============== DATA CAPTURE ===============
  saveCurrentStepData() {
    const el = document.getElementById(`step${this.currentStep + 1}`);
    if (!el) return;

    const inputs = el.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      if (!input.name) return;

      if (input.type === 'checkbox') {
        if (!this.formData[input.name]) this.formData[input.name] = [];
        if (input.checked) {
          if (!this.formData[input.name].includes(input.value)) {
            this.formData[input.name].push(input.value);
          }
        } else {
          this.formData[input.name] = (this.formData[input.name] || []).filter(v => v !== input.value);
        }
      } else if (input.type === 'radio') {
        if (input.checked) {
          this.formData[input.name] = input.value;
        }
      } else {
        this.formData[input.name] = input.value || '';
      }
    });

    this.saveFormData();
  }

  // =============== SUBMIT ===============
  submitForm() {
    // Hook custom optionnel
    if (typeof window.onProviderSignupSubmit === 'function') {
      try {
        window.onProviderSignupSubmit(this.formData);
        return;
      } catch (e) {
        console.warn('onProviderSignupSubmit error', e);
      }
    }
    console.log('📤 Submitting form...', this.formData);
    alert('Form submission not yet implemented');
  }
}

export function initializeWizardSteps() {
  const wizardSteps = new WizardSteps();
  wizardSteps.init();

  // Exposer globalement pour usage externe
  window.providerWizardSteps = wizardSteps;

  return wizardSteps;
}
