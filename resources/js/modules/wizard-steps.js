/**
 * Wizard Steps – CORRIGÉ
 */

export class WizardSteps {
  constructor() {
    this.currentStep = 0;
    this.totalSteps = 16; // ✅ CORRIGÉ : 16 steps au lieu de 15
    this.formData = this.loadFormData();
  }

  loadFormData() {
    try { return JSON.parse(localStorage.getItem('provider-signup-data')) || {}; }
    catch { return {}; }
  }
  saveFormData() {
    try { localStorage.setItem('provider-signup-data', JSON.stringify(this.formData)); } catch {}
  }

  init() {
    this.initNavigationButtons();
    this.initDelegatedGoTo();
    this.initStepValidation();
    this.initProgressBar();
    this.showStep(0);
    window.wizardSteps = this;
  }

  initDelegatedGoTo() {
    document.addEventListener('click', (e) => {
      const go = e.target && e.target.closest && e.target.closest('[data-go-step]');
      if (!go) return;
      const to = parseInt(go.getAttribute('data-go-step'), 10);
      if (!Number.isFinite(to) || to < 1 || to > this.totalSteps) return;
      e.preventDefault();
      this.showStep(to - 1);
    }, true);
  }

  syncCurrentFromDOM() {
    for (let i = 1; i <= this.totalSteps; i++) {
      const s = document.getElementById(`step${i}`);
      if (s && !s.classList.contains('hidden')) {
        this.currentStep = i - 1;
        return;
      }
    }
  }

  initNavigationButtons() {
    document.querySelectorAll('#mobileNextBtn, #desktopNextBtn')
      .forEach(btn => btn.addEventListener('click', (e) => { 
        e.preventDefault(); 
        if (this.validateCurrentStep()) this.nextStep(); 
      }));
    document.querySelectorAll('#mobileBackBtn, #desktopBackBtn')
      .forEach(btn => btn.addEventListener('click', (e) => { 
        e.preventDefault(); 
        this.previousStep(); 
      }));
  }

  initStepValidation() {
    for (let i = 1; i <= this.totalSteps; i++) {
      const el = document.getElementById(`step${i}`); if (!el) continue;
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

  initProgressBar() { this.updateProgressBar(); }
  updateProgressBar() {
    const n = document.getElementById('currentStepNum');
    const p = document.getElementById('progressPercentage');
    const bar = document.getElementById('mobileProgressBar');
    if (n) n.textContent = String(this.currentStep + 1);
    const pct = Math.round(((this.currentStep + 1) / this.totalSteps) * 100);
    if (p) p.textContent = String(pct);
    if (bar) bar.style.width = `${pct}%`;
  }

  showStep(i) {
    if (i < 0 || i >= this.totalSteps) return;
    for (let k = 1; k <= this.totalSteps; k++) {
      const s = document.getElementById(`step${k}`); if (s) s.classList.add('hidden');
    }
    const cur = document.getElementById(`step${i + 1}`); if (!cur) return;
    cur.classList.remove('hidden');
    this.currentStep = i;
    this.updateProgressBar();
    this.updateNavigationButtons();
  }

  nextStep() {
    this.saveCurrentStepData();
    if (this.currentStep < this.totalSteps - 1) this.showStep(this.currentStep + 1);
    else this.submitForm();
  }
  previousStep() { if (this.currentStep > 0) this.showStep(this.currentStep - 1); }

  validateCurrentStep() {
    this.syncCurrentFromDOM();
    const stepNum = this.currentStep + 1;
    const el = document.getElementById(`step${stepNum}`); 
    if (!el) return true;

    // ✅ VALIDATION STEP 1 : toujours valide (choix de profil)
    if (stepNum === 1) {
      return true;
    }

    // ✅ APPELER LA VALIDATION CUSTOM EN PREMIER
    const custom = window[`validateStep${stepNum}`];
    if (typeof custom === 'function') { 
      try { 
        return !!custom(); 
      } catch (e) { 
        console.error(`validateStep${stepNum} error:`, e);
        return false; 
      } 
    }

    // Validation générique
    const req = el.querySelectorAll('[data-required]');
    if (!req.length) return true;
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
    this.syncCurrentFromDOM();

    const mobileWrap  = document.getElementById('mobileNavButtons');
    const desktopWrap = document.getElementById('desktopNavButtons');
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');

    // ✅ CORRIGÉ : Afficher les boutons dès le Step 1
    if (mobileWrap)  mobileWrap.style.display  = '';
    if (desktopWrap) desktopWrap.style.display = '';

    // Back masqué uniquement au Step 1
    backButtons.forEach(b => b.style.display = (this.currentStep === 0 ? 'none' : 'flex'));
    
    nextButtons.forEach(btn => {
      const span = btn.querySelector('span');
      if (span) span.textContent = (this.currentStep === this.totalSteps - 1) ? 'Submit' : 'Continue';
    });

    // ✅ CORRIGÉ : Validation normale sans blocage du Step 1
    const isValid = this.validateCurrentStep();

    nextButtons.forEach(btn => {
      btn.disabled = !isValid;
      btn.setAttribute('aria-disabled', String(!isValid));
      btn.classList.toggle('opacity-50', !isValid);
      btn.classList.toggle('cursor-not-allowed', !isValid);
      btn.classList.toggle('pointer-events-none', !isValid);
      btn.style.pointerEvents = isValid ? 'auto' : 'none';
      btn.style.opacity = isValid ? '1' : '0.5';
    });

    [mobileWrap, desktopWrap].forEach(w => {
      if (!w) return;
      w.classList.toggle('opacity-50', !isValid);
      w.classList.toggle('pointer-events-none', !isValid);
      w.style.pointerEvents = isValid ? 'auto' : 'none';
    });
  }

  saveCurrentStepData() {
    const el = document.getElementById(`step${this.currentStep + 1}`); if (!el) return;
    el.querySelectorAll('input, select, textarea').forEach(input => {
      if (!input.name) return;
      if (input.type === 'checkbox') {
        if (!this.formData[input.name]) this.formData[input.name] = [];
        if (input.checked) { if (!this.formData[input.name].includes(input.value)) this.formData[input.name].push(input.value); }
        else { this.formData[input.name] = (this.formData[input.name] || []).filter(v => v !== input.value); }
      } else if (input.type === 'radio') {
        if (input.checked) this.formData[input.name] = input.value;
      } else {
        this.formData[input.name] = input.value || '';
      }
    });
    this.saveFormData();
  }

  submitForm() {
    if (typeof window.onProviderSignupSubmit === 'function') { try { window.onProviderSignupSubmit(this.formData); return; } catch {} }
    console.log('📤 Submitting form...', this.formData);
    alert('Form submission not implemented');
  }
}

export function initializeWizardSteps() {
  const ws = new WizardSteps();
  ws.init();
  window.providerWizardSteps = ws;
  if (!window.showStep) window.showStep = (i) => ws.showStep(i);
  if (!window.updateNavigationButtons) window.updateNavigationButtons = () => ws.updateNavigationButtons();
  return ws;
}