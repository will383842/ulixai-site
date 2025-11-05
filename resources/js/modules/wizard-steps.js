/**
 * Wizard Steps – version anti-conflit
 * - Step 1 : nav masquée
 * - Click [data-go-step] : navigation fiable (ex: bloc bleu → data-go-step="2")
 * - Auto-sync : si un step est montré par le DOM, on met à jour currentStep
 * - Déverrouillage centralisé
 */

export class WizardSteps {
  constructor() {
    this.currentStep = 0;
    this.totalSteps = 16;
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
    this.initDelegatedGoTo();        // <— NEW
    this.initStepValidation();
    this.initProgressBar();
    this.showStep(0);
    window.wizardSteps = this;
  }

  // Délégation globale : tout élément avec data-go-step="N" provoque showStep(N)
  initDelegatedGoTo() {
    document.addEventListener('click', (e) => {
      const go = e.target && e.target.closest && e.target.closest('[data-go-step]');
      if (!go) return;
      const to = parseInt(go.getAttribute('data-go-step'), 10);
      if (!Number.isFinite(to) || to < 1 || to > this.totalSteps) return;
      e.preventDefault();
      this.showStep(to - 1);
    }, true); // capture pour passer avant d’éventuels stopPropagation
  }

  // Mets à jour currentStep à partir du DOM (si quelqu’un a affiché un step sans passer par showStep)
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
      .forEach(btn => btn.addEventListener('click', (e) => { e.preventDefault(); if (this.validateCurrentStep()) this.nextStep(); }));
    document.querySelectorAll('#mobileBackBtn, #desktopBackBtn')
      .forEach(btn => btn.addEventListener('click', (e) => { e.preventDefault(); this.previousStep(); }));
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
    // sécurise Step 2 : recalcule après n’importe quel clic dans #step2
    document.addEventListener('click', (e) => {
      if (e.target && e.target.closest && e.target.closest('#step2')) {
        setTimeout(() => this.updateNavigationButtons(), 0);
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
    // TRES IMPORTANT : si quelqu’un a montré un autre step sans passer par showStep, on se resynchronise
    this.syncCurrentFromDOM();

    const stepNum = this.currentStep + 1;
    const el = document.getElementById(`step${stepNum}`); if (!el) return true;

    const custom = window[`validateStep${stepNum}`];
    if (typeof custom === 'function') { try { return !!custom(); } catch { return false; } }

    if (stepNum === 2) {
      const hidden = el.querySelector('input[name="native_language"], #nativeLanguage, #native_language');
      const hasHidden = !!(hidden && String(hidden.value || '').trim());
      const hasCard = !!el.querySelector(
        '.language-card.selected, .language-card[aria-checked="true"], [data-selected="true"], .active, [aria-selected="true"]'
      );
      const countEl = el.querySelector('#selectedCount, .selected-count, [data-selected-count], #step2SelectedCount');
      let hasCount = false;
      if (countEl) {
        const n = parseInt((countEl.textContent || '').replace(/[^\d]/g, ''), 10);
        hasCount = Number.isFinite(n) && n > 0;
      }
      return hasHidden || hasCard || hasCount;
    }

    const req = el.querySelectorAll('[data-required]');
    if (!req.length) return true;
    for (const input of req) {
      if (['checkbox','radio'].includes(input.type)) { if (!input.checked) return false; }
      else { if (String(input.value || '').trim() === '') return false; }
    }
    return true;
  }

  updateNavigationButtons() {
    // resync au cas où le DOM montre un autre step
    this.syncCurrentFromDOM();

    const mobileWrap  = document.getElementById('mobileNavButtons');
    const desktopWrap = document.getElementById('desktopNavButtons');
    const backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
    const nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');

    if (this.currentStep === 0) {
      if (mobileWrap)  mobileWrap.style.display  = 'none';
      if (desktopWrap) desktopWrap.style.display = 'none';
    } else {
      if (mobileWrap)  mobileWrap.style.display  = '';
      if (desktopWrap) desktopWrap.style.display = '';
    }

    backButtons.forEach(b => b.style.display = (this.currentStep === 0 ? 'none' : 'flex'));
    nextButtons.forEach(btn => {
      const span = btn.querySelector('span');
      if (span) span.textContent = (this.currentStep === this.totalSteps - 1) ? 'Submit' : 'Continue';
    });

    const isValid = (this.currentStep === 0) ? false : this.validateCurrentStep();

    nextButtons.forEach(btn => {
      try { btn.disabled = !isValid; } catch {}
      btn.setAttribute('aria-disabled', String(!isValid));
      btn.classList.toggle('opacity-50', !isValid);
      btn.classList.toggle('cursor-not-allowed', !isValid);
      btn.classList.toggle('pointer-events-none', !isValid);
      btn.style.pointerEvents = isValid ? 'auto' : 'none';
    });
    [mobileWrap, desktopWrap].forEach(w => {
      if (!w) return;
      w.classList.toggle('opacity-50', !isValid && this.currentStep !== 0);
      w.classList.toggle('pointer-events-none', !isValid && this.currentStep !== 0);
      w.style.pointerEvents = (!isValid && this.currentStep !== 0) ? 'none' : 'auto';
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
