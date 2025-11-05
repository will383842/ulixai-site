/**
 * Wizard Steps - Logique complète des 16 étapes du formulaire provider
 */

export class WizardSteps {
  constructor() {
    this.currentStep = 0;
    this.totalSteps = 16;
    this.formData = this.loadFormData();
  }

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

  init() {
    console.log('🎯 Wizard steps: initializing...');
    
    this.initNavigationButtons();
    this.initStepValidation();
    this.initProgressBar();
    this.showStep(0);
    
    // Exposer globalement
    window.wizardSteps = this;
    
    console.log('✅ Wizard steps initialized');
  }

  showStep(stepIndex) {
    console.log(`📍 Showing step ${stepIndex + 1}/${this.totalSteps}`);
    
    // Vérifier que l'index est valide
    if (stepIndex < 0 || stepIndex >= this.totalSteps) {
      console.warn(`⚠️ Invalid step index: ${stepIndex}`);
      return;
    }
    
    // Cacher toutes les étapes
    for (let i = 0; i < this.totalSteps; i++) {
      const step = document.getElementById(`step${i + 1}`);
      if (step) {
        step.classList.add('hidden');
      }
    }
    
    // Afficher l'étape courante
    const currentStep = document.getElementById(`step${stepIndex + 1}`);
    if (currentStep) {
      currentStep.classList.remove('hidden');
      this.currentStep = stepIndex;
      this.updateProgressBar();
      this.updateNavigationButtons();
      console.log(`✅ Step ${stepIndex + 1} displayed`);
    } else {
      console.error(`❌ Step ${stepIndex + 1} not found in DOM`);
    }
  }

  nextStep() {
    console.log(`➡️ Next clicked from step ${this.currentStep + 1}`);
    
    if (!this.validateCurrentStep()) {
      console.warn(`⚠️ Validation failed for step ${this.currentStep + 1}`);
      return;
    }
    
    this.saveCurrentStepData();
    
    if (this.currentStep < this.totalSteps - 1) {
      this.showStep(this.currentStep + 1);
    } else {
      console.log('🎉 Last step reached, submitting...');
      this.submitForm();
    }
  }

  previousStep() {
    console.log(`⬅️ Back clicked from step ${this.currentStep + 1}`);
    
    if (this.currentStep > 0) {
      this.showStep(this.currentStep - 1);
    }
  }

  validateCurrentStep() {
    const currentStepEl = document.getElementById(`step${this.currentStep + 1}`);
    if (!currentStepEl) {
      console.warn(`Step ${this.currentStep + 1} element not found`);
      return true;
    }
    
    // Pour l'instant, on retourne toujours true pour permettre la navigation
    // La vraie validation sera ajoutée plus tard step par step
    return true;
  }

  saveCurrentStepData() {
    const currentStepEl = document.getElementById(`step${this.currentStep + 1}`);
    if (!currentStepEl) return;
    
    const inputs = currentStepEl.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      if (input.type === 'checkbox' || input.type === 'radio') {
        if (input.checked) {
          if (!this.formData[input.name]) this.formData[input.name] = [];
          if (Array.isArray(this.formData[input.name])) {
            if (!this.formData[input.name].includes(input.value)) {
              this.formData[input.name].push(input.value);
            }
          }
        }
      } else {
        if (input.value) {
          this.formData[input.name] = input.value;
        }
      }
    });
    
    this.saveFormData();
    console.log(`💾 Step ${this.currentStep + 1} data saved`);
  }

  updateProgressBar() {
    const percentage = ((this.currentStep + 1) / this.totalSteps) * 100;
    
    // Mobile progress bar
    const mobileBar = document.getElementById('mobileProgressBar');
    if (mobileBar) {
      mobileBar.style.width = `${percentage}%`;
    }
    
    // Step number
    const stepNum = document.getElementById('currentStepNum');
    if (stepNum) {
      stepNum.textContent = this.currentStep + 1;
    }
    
    // Percentage
    const percentageEl = document.getElementById('progressPercentage');
    if (percentageEl) {
      percentageEl.textContent = Math.round(percentage);
    }
    
    console.log(`📊 Progress: ${Math.round(percentage)}%`);
  }

  updateNavigationButtons() {
    // Boutons Back
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    backButtons.forEach(btn => {
      if (this.currentStep === 0) {
        btn.style.display = 'none';
      } else {
        btn.style.display = 'flex';
      }
    });
    
    // Boutons Next
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
    nextButtons.forEach(btn => {
      if (this.currentStep === this.totalSteps - 1) {
        btn.querySelector('span').textContent = 'Submit';
      } else {
        btn.querySelector('span').textContent = 'Continue';
      }
      
      // Pour l'instant on garde les boutons toujours actifs
      btn.disabled = false;
      btn.classList.remove('opacity-50');
    });
    
    console.log(`🔘 Navigation buttons updated for step ${this.currentStep + 1}`);
  }

  initNavigationButtons() {
    // Boutons Next
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
    nextButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        console.log('🖱️ Next button clicked');
        this.nextStep();
      });
    });
    
    // Boutons Back
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    backButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        console.log('🖱️ Back button clicked');
        this.previousStep();
      });
    });
    
    console.log('✅ Navigation buttons attached');
  }

  initStepValidation() {
    // Écouter les changements dans tous les steps
    for (let i = 1; i <= this.totalSteps; i++) {
      const step = document.getElementById(`step${i}`);
      if (step) {
        step.addEventListener('input', () => {
          this.updateNavigationButtons();
        });
        
        step.addEventListener('change', () => {
          this.updateNavigationButtons();
        });
      }
    }
    
    console.log('✅ Step validation listeners attached');
  }

  initProgressBar() {
    this.updateProgressBar();
    console.log('✅ Progress bar initialized');
  }

  submitForm() {
    console.log('📤 Submitting form...', this.formData);
    // Logique de soumission à implémenter
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