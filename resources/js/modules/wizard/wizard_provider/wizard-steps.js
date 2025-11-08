/**
 * Wizard Steps – VERSION PROPRE
 * ✅ Le JavaScript ne touche JAMAIS au style
 * ✅ Gère uniquement btn.disabled = true/false
 * ✅ Tout le style visuel → navigation-buttons-styles.blade.php
 */

export class WizardSteps {
  constructor() {
    this.currentStep = 0;
    this.totalSteps = 16;
    this.storeKey = 'expats';
    this.formData = this.loadFormData();
    console.log('🎬 WizardSteps constructor called - totalSteps:', this.totalSteps);
  }

  loadFormData() {
    try { 
      const data = JSON.parse(localStorage.getItem('expats')) || {};
      console.log('💾 Form data loaded from localStorage:', Object.keys(data));
      return data;
    } catch { 
      console.warn('⚠️ Failed to load form data from localStorage');
      return {}; 
    }
  }

  saveFormData() {
    try { 
      localStorage.setItem('expats', JSON.stringify(this.formData));
      console.log('💾 Form data saved to localStorage');
    } catch {
      console.warn('⚠️ Failed to save form data to localStorage');
    }
  }

  init() {
    console.log('🎬 WizardSteps.init() called');
    this.initNavigationButtons();
    this.initDelegatedGoTo();
    this.initStepValidation();
    this.initProgressBar();
    this.showStep(0);
    window.wizardSteps = this;
    console.log('✅ WizardSteps initialized');
  }

  initDelegatedGoTo() {
    document.addEventListener('click', (e) => {
      const go = e.target && e.target.closest && e.target.closest('[data-go-step]');
      if (!go) return;
      const to = parseInt(go.getAttribute('data-go-step'), 10);
      if (!Number.isFinite(to) || to < 1 || to > this.totalSteps) return;
      e.preventDefault();
      console.log('🎯 [data-go-step] clicked - going to step:', to);
      this.showStep(to - 1);
    }, true);
  }

  syncCurrentFromDOM() {
    for (let i = 1; i <= this.totalSteps; i++) {
      const s = document.getElementById(`step${i}`);
      if (s && !s.classList.contains('hidden')) {
        this.currentStep = i - 1;
        console.log('🔄 syncCurrentFromDOM - current step is:', i);
        return;
      }
    }
  }

  initNavigationButtons() {
    document.querySelectorAll('#mobileNextBtn, #desktopNextBtn')
      .forEach(btn => btn.addEventListener('click', (e) => { 
        e.preventDefault();
        console.log('➡️ Next button clicked from step', this.currentStep + 1);
        this.nextStep();
      }));
    document.querySelectorAll('#mobileBackBtn, #desktopBackBtn')
      .forEach(btn => btn.addEventListener('click', (e) => { 
        e.preventDefault();
        console.log('⬅️ Back button clicked from step', this.currentStep + 1);
        this.previousStep(); 
      }));
  }

  initStepValidation() {
    for (let i = 1; i <= this.totalSteps; i++) {
      const el = document.getElementById(`step${i}`); 
      if (!el) continue;
      const h = () => this.updateNavigationButtons();
      el.querySelectorAll('input, select, textarea').forEach(n => {
        n.addEventListener('input', h);
        n.addEventListener('change', h);
      });
    }
    document.addEventListener('click', (e) => {
      if (e.target && e.target.closest && e.target.closest('[id^="step"]')) {
        setTimeout(() => this.updateNavigationButtons(), 50);
      }
    }, true);
  }

  initProgressBar() { 
    this.updateProgressBar(); 
  }

  updateProgressBar() {
    const n = document.getElementById('currentStepNum');
    const p = document.getElementById('progressPercentage');
    const bar = document.getElementById('mobileProgressBar');
    if (n) n.textContent = String(this.currentStep + 1);
    const pct = Math.round(((this.currentStep + 1) / this.totalSteps) * 100);
    if (p) p.textContent = String(pct);
    if (bar) bar.style.width = `${pct}%`;
    console.log('📊 Progress bar updated - step', this.currentStep + 1, 'of', this.totalSteps, `(${pct}%)`);
  }

  showStep(i) {
    console.log('🎬 showStep() called with index:', i, '→ Will show step', i + 1);
    
    if (i < 0 || i >= this.totalSteps) {
      console.warn('❌ Invalid step index:', i, `(totalSteps: ${this.totalSteps})`);
      return;
    }
    
    console.log('🙈 Hiding all steps...');
    for (let k = 1; k <= this.totalSteps; k++) {
      const s = document.getElementById(`step${k}`);
      if (s) {
        s.classList.add('hidden');
        console.log(`  🙈 step${k} → hidden`);
      } else {
        console.warn(`  ❌ step${k} element not found in DOM`);
      }
    }
    
    const cur = document.getElementById(`step${i + 1}`);
    if (!cur) {
      console.error(`❌ Step element not found: step${i + 1}`);
      return;
    }
    
    cur.classList.remove('hidden');
    console.log(`👁️ step${i + 1} → VISIBLE`);
    
    this.currentStep = i;
    this.updateProgressBar();
    this.updateNavigationButtons();
    
    console.log('✅ showStep completed - current step is now:', this.currentStep + 1);
  }

  nextStep() {
    console.log('➡️ nextStep() called from step', this.currentStep + 1);
    
    this.saveCurrentStepData();
    
    if (this.currentStep < this.totalSteps - 1) {
      const nextStepIndex = this.currentStep + 1;
      console.log('➡️ Moving to step', nextStepIndex + 1);
      this.showStep(nextStepIndex);
    } else {
      console.log('📤 Last step reached, submitting form');
      this.submitForm();
    }
  }

  previousStep() { 
    console.log('⬅️ previousStep() called from step', this.currentStep + 1);
    
    if (this.currentStep > 0) {
      const prevStepIndex = this.currentStep - 1;
      console.log('⬅️ Moving to step', prevStepIndex + 1);
      this.showStep(prevStepIndex);
    } else {
      console.warn('⚠️ Already at Step 1 - cannot go back further');
    }
  }

  validateCurrentStep() {
    this.syncCurrentFromDOM();
    const stepNum = this.currentStep + 1;
    const el = document.getElementById(`step${stepNum}`); 
    
    console.log('🔍 validateCurrentStep() for step', stepNum);
    
    if (!el) {
      console.warn('❌ Step element not found for validation:', stepNum);
      return true;
    }

    // ✅ VALIDATION STEP 1 : toujours valide
    if (stepNum === 1) {
      console.log('✅ Step 1 - always valid (profile choice via buttons)');
      return true;
    }

    // ✅ APPELER LA VALIDATION CUSTOM - VALIDATION SILENCIEUSE
    const custom = window[`validateStep${stepNum}`];
    if (typeof custom === 'function') { 
      console.log(`🔍 Calling custom validation: validateStep${stepNum}() - silent`);
      try { 
        const result = !!custom();
        console.log(`${result ? '✅' : '❌'} validateStep${stepNum}() returned:`, result);
        return result;
      } catch (e) { 
        console.error(`❌ validateStep${stepNum} error:`, e);
        return false; 
      } 
    }

    // Validation générique
    console.log('🔍 No custom validation found, using generic validation');
    const req = el.querySelectorAll('[data-required]');
    if (!req.length) {
      console.log('✅ No required fields found - step valid');
      return true;
    }
    
    console.log('🔍 Checking', req.length, 'required fields...');
    for (const input of req) {
      if (['checkbox','radio'].includes(input.type)) { 
        if (!input.checked) {
          console.warn('❌ Required checkbox/radio not checked:', input.name);
          return false;
        }
      } else { 
        if (String(input.value || '').trim() === '') {
          console.warn('❌ Required field empty:', input.name);
          return false;
        }
      }
    }
    
    console.log('✅ All required fields valid');
    return true;
  }

  updateNavigationButtons() {
    console.log('🔄 updateNavigationButtons() called');
    this.syncCurrentFromDOM();

    const mobileWrap  = document.getElementById('mobileNavButtons');
    const desktopWrap = document.getElementById('desktopNavButtons');
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');

    // ✅ Au Step 1, masquer TOUS les boutons de navigation
    if (this.currentStep === 0) {
      if (mobileWrap)  mobileWrap.style.display  = 'none';
      if (desktopWrap) desktopWrap.style.display = 'none';
      console.log('🚫 Step 1 - Navigation buttons HIDDEN');
      return;
    }

    // À partir du Step 2 : afficher les wrappers de navigation
    if (mobileWrap)  mobileWrap.style.display  = '';
    if (desktopWrap) desktopWrap.style.display = '';
    console.log('✅ Step 2+ - Navigation buttons VISIBLE');

    // ✅ Back TOUJOURS visible
    backButtons.forEach(b => b.style.display = 'flex');
    console.log('🔘 Back button: ALWAYS visible');
    
    // Texte du bouton Next/Submit
    const isLastStep = this.currentStep === this.totalSteps - 1;
    nextButtons.forEach(btn => {
      const span = btn.querySelector('span');
      if (span) span.textContent = isLastStep ? 'Submit' : 'Continue';
    });
    console.log(`🔘 Next button text: ${isLastStep ? 'Submit' : 'Continue'}`);

    // Validation
    const isValid = this.validateCurrentStep();
    console.log(`🔘 Step ${this.currentStep + 1} validation result:`, isValid);

    // ✅ UNIQUEMENT btn.disabled - Le CSS gère TOUT le reste
    nextButtons.forEach(btn => {
      btn.disabled = !isValid;
      btn.setAttribute('aria-disabled', String(!isValid));
    });
    
    console.log('✅ Navigation buttons updated');
  }

  saveCurrentStepData() {
    const el = document.getElementById(`step${this.currentStep + 1}`); 
    if (!el) {
      console.warn('❌ Cannot save step data - element not found');
      return;
    }
    
    console.log('💾 Saving data for step', this.currentStep + 1);
    
    el.querySelectorAll('input, select, textarea').forEach(input => {
      if (!input.name) return;
      
      if (input.type === 'checkbox') {
        if (!this.formData[input.name]) this.formData[input.name] = [];
        if (input.checked) { 
          if (!this.formData[input.name].includes(input.value)) {
            this.formData[input.name].push(input.value);
            console.log(`  ✅ Checkbox "${input.name}": added "${input.value}"`);
          }
        } else { 
          this.formData[input.name] = (this.formData[input.name] || []).filter(v => v !== input.value);
          console.log(`  ❌ Checkbox "${input.name}": removed "${input.value}"`);
        }
      } else if (input.type === 'radio') {
        if (input.checked) {
          this.formData[input.name] = input.value;
          console.log(`  📻 Radio "${input.name}": "${input.value}"`);
        }
      } else {
        this.formData[input.name] = input.value || '';
        console.log(`  📝 Field "${input.name}": "${input.value}"`);
      }
    });
    
    this.saveFormData();
  }

  submitForm() {
    console.log('📤 submitForm() called');
    
    if (typeof window.onProviderSignupSubmit === 'function') { 
      console.log('✅ Calling window.onProviderSignupSubmit()');
      try { 
        window.onProviderSignupSubmit(this.formData); 
        return; 
      } catch (e) {
        console.error('❌ onProviderSignupSubmit failed:', e);
      }
    }
    
    console.log('📤 Submitting form...', this.formData);
    alert('Form submission not implemented');
  }
}

export function initializeWizardSteps() {
  console.log('🚀 initializeWizardSteps() called');
  const ws = new WizardSteps();
  ws.init();
  window.providerWizardSteps = ws;
  
  if (!window.showStep) {
    window.showStep = (i) => {
      console.log('🌍 Global showStep() called with:', i);
      ws.showStep(i);
    };
  }
  
  if (!window.updateNavigationButtons) {
    window.updateNavigationButtons = () => {
      console.log('🌍 Global updateNavigationButtons() called');
      ws.updateNavigationButtons();
    };
  }
  
  console.log('✅ WizardSteps module ready');
  return ws;
}