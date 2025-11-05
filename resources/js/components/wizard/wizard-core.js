/**
 * Wizard Core - Centralized wizard management
 * Gère navigation entre steps, validation, historique navigateur
 */

export class WizardCore {
  constructor(options = {}) {
    this.storeKey = options.storeKey || 'pw.state';
    this.totalSteps = options.totalSteps || 16;
    this.currentStep = 0;
    this.steps = [];
    this.state = {};
    
    this.init();
  }

  /**
   * Initialize wizard
   */
  init() {
    this.loadState();
    this.detectSteps();
    this.setupListeners();
    this.restore();
  }

  /**
   * Detect step elements in DOM
   */
  detectSteps() {
    this.steps = Array.from({ length: this.totalSteps }, (_, i) => 
      document.getElementById(`step${i + 1}`)
    ).filter(Boolean);
  }

  /**
   * Load state from storage
   * @returns {Object}
   */
  loadState() {
    try {
      const raw = sessionStorage.getItem(this.storeKey) || 
                  localStorage.getItem(this.storeKey) || 
                  '{}';
      this.state = JSON.parse(raw);
      return this.state;
    } catch (e) {
      console.warn('Failed to load wizard state:', e);
      this.state = {};
      return this.state;
    }
  }

  /**
   * Save state to storage
   */
  saveState() {
    try {
      const stateStr = JSON.stringify(this.state);
      sessionStorage.setItem(this.storeKey, stateStr);
      localStorage.setItem(this.storeKey, stateStr);
    } catch (e) {
      console.warn('Failed to save wizard state:', e);
    }
  }

  /**
   * Get step index from URL hash
   * @returns {number|null}
   */
  getIndexFromHash() {
    const match = /^#step(\d+)$/i.exec(location.hash || '');
    if (match) {
      const index = parseInt(match[1], 10) - 1;
      return Math.max(0, Math.min(this.steps.length - 1, index));
    }
    return null;
  }

  /**
   * Show specific step
   * @param {number} index - Step index (0-based)
   * @param {Object} options - Options
   */
  show(index, options = {}) {
    if (index < 0 || index >= this.steps.length) {
      console.warn(`Invalid step index: ${index}`);
      return;
    }

    // Hide all steps
    this.steps.forEach((step, i) => {
      if (step) {
        step.classList.toggle('hidden', i !== index);
      }
    });

    // Update current step
    this.currentStep = index;
    this.state.current = index;
    this.saveState();

    // Update URL hash (with history)
    if (!options || options.push !== false) {
      const hash = `#step${index + 1}`;
      if (location.hash !== hash) {
        history.pushState(
          { pw: true, i: index }, 
          '', 
          hash
        );
      }
    }

    // Update UI
    this.updateUI();

    // Scroll to top
    const contentArea = document.getElementById('popupContentArea');
    if (contentArea) {
      contentArea.scrollTop = 0;
    }
  }

  /**
   * Go to step (with validation)
   * @param {number} index - Step index
   */
  goto(index) {
    this.detectSteps();
    
    if (index < 0 || index >= this.steps.length) {
      console.warn(`Cannot goto invalid step: ${index}`);
      return;
    }

    // Validate current step before proceeding forward
    if (index > this.currentStep && !this.validate(this.currentStep)) {
      console.warn(`Cannot proceed: step ${this.currentStep} validation failed`);
      return;
    }

    this.show(index);
  }

  /**
   * Go to next step
   */
  next() {
    if (this.currentStep < this.steps.length - 1) {
      this.goto(this.currentStep + 1);
    }
  }

  /**
   * Go to previous step
   */
  prev() {
    if (this.currentStep > 0) {
      this.goto(this.currentStep - 1);
    }
  }

  /**
   * Restore wizard state from storage/hash
   */
  restore() {
    this.detectSteps();
    
    let targetIndex = this.getIndexFromHash();
    
    if (targetIndex === null) {
      if (typeof this.state.current === 'number') {
        targetIndex = Math.max(0, Math.min(this.steps.length - 1, this.state.current));
      } else {
        targetIndex = 0;
      }
    }

    // Show step without pushing to history
    this.steps.forEach((step, i) => {
      if (step) {
        step.classList.toggle('hidden', i !== targetIndex);
      }
    });

    this.currentStep = targetIndex;
    this.updateUI();
  }

  /**
   * Check if element is selected
   * @param {HTMLElement} el - Element to check
   * @returns {boolean}
   */
  elementSelected(el) {
    if (!el) return false;
    
    if (el.classList.contains('selected')) return true;
    if (el.getAttribute('aria-checked') === 'true') return true;
    
    const input = el.querySelector('input[type="checkbox"], input[type="radio"]');
    if (input) return !!input.checked;
    
    return false;
  }

  /**
   * Validate step
   * @param {number} index - Step index
   * @returns {boolean}
   */
  validate(index) {
    const step = this.steps[index];
    if (!step) return true;

    // 1) Check required fields
    const required = step.querySelectorAll('[required]');
    for (let i = 0; i < required.length; i++) {
      const field = required[i];
      
      if (field.type === 'checkbox' || field.type === 'radio') {
        const name = field.name;
        if (name) {
          const checked = step.querySelectorAll(
            `input[name="${CSS.escape(name)}"]:checked`
          );
          if (checked.length === 0) return false;
        } else if (!field.checked) {
          return false;
        }
      } else {
        if (!field.value || field.value.trim() === '') return false;
      }
    }

    // 2) Check clickable groups
    const clickable = step.querySelectorAll(
      '.language-card, .lang-btn, .service-card, [role="checkbox"], [role="radio"], [data-toggle="select"]'
    );
    
    if (clickable.length) {
      let anySelected = false;
      
      for (let i = 0; i < clickable.length; i++) {
        if (this.elementSelected(clickable[i])) {
          anySelected = true;
          break;
        }
      }
      
      if (!anySelected) {
        // Fallback: check for any checked input
        const anyInput = step.querySelector(
          'input[type="checkbox"]:checked, input[type="radio"]:checked, select option:checked'
        );
        if (!anyInput) return false;
      }
    }

    // Check custom validation functions
    if (typeof window.validateStep === 'function') {
      return window.validateStep(index);
    }

    return true;
  }

  /**
   * Update UI (buttons, progress)
   */
  updateUI() {
    const isValid = this.validate(this.currentStep);
    
    // Update navigation buttons
    this.updateButtons(isValid);
    
    // Update progress bar
    this.updateProgress();
    
    // Custom update hook
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
    
    if (typeof window.updateHeaderButtons === 'function') {
      window.updateHeaderButtons();
    }
  }

  /**
   * Update navigation buttons state
   * @param {boolean} isValid - Current step validation state
   */
  updateButtons(isValid) {
    const selectors = [
      '#mobileNextBtn',
      '#nextBtn',
      '#desktopNextBtn',
      '.btn-next',
      '[data-action="next"]',
      '[data-action="finish"]'
    ];

    selectors.forEach(selector => {
      const buttons = document.querySelectorAll(selector);
      buttons.forEach(btn => {
        if (btn.tagName === 'A') {
          btn.setAttribute('aria-disabled', (!isValid).toString());
          btn.classList.toggle('opacity-50', !isValid);
        } else {
          btn.disabled = !isValid;
          btn.setAttribute('aria-disabled', (!isValid).toString());
          btn.classList.toggle('opacity-50', !isValid);
        }
      });
    });

    // Update finish button (last step only)
    const finishButtons = document.querySelectorAll('#finishBtn, .btn-finish');
    finishButtons.forEach(btn => {
      const enabled = isValid && this.currentStep === this.steps.length - 1;
      
      if (btn.tagName === 'A') {
        btn.setAttribute('aria-disabled', (!enabled).toString());
        btn.classList.toggle('opacity-50', !enabled);
      } else {
        btn.disabled = !enabled;
        btn.setAttribute('aria-disabled', (!enabled).toString());
        btn.classList.toggle('opacity-50', !enabled);
      }
    });
  }

  /**
   * Update progress bar
   */
  updateProgress() {
    const progress = ((this.currentStep + 1) / this.steps.length) * 100;
    
    const progressEl = document.querySelector('[data-progress]');
    if (progressEl) {
      progressEl.style.width = `${progress}%`;
      progressEl.setAttribute('aria-valuenow', Math.round(progress));
    }
  }

  /**
   * Setup global event listeners
   */
  setupListeners() {
    // Click delegation for selectable cards
    document.addEventListener('click', (e) => {
      const card = e.target.closest(
        '.language-card, .lang-btn, .service-card, [data-toggle="select"], [role="checkbox"], [role="radio"]'
      );
      
      if (!card) return;
      
      // Prevent link scroll
      if (card.tagName === 'A') e.preventDefault();

      this.handleCardClick(card);
    }, true);

    // Input/change listeners
    ['input', 'change'].forEach(evt => {
      document.addEventListener(evt, () => {
        this.updateUI();
      }, true);
    });

    // Data-action buttons
    document.addEventListener('click', (e) => {
      const actionBtn = e.target.closest('[data-action]');
      if (!actionBtn) return;
      
      const action = actionBtn.getAttribute('data-action');
      
      if (action === 'next') {
        e.preventDefault();
        this.next();
      } else if (action === 'prev') {
        e.preventDefault();
        this.prev();
      } else if (action === 'finish') {
        e.preventDefault();
        if (this.validate(this.currentStep)) {
          this.goto(this.currentStep);
        }
      }
    }, true);

    // Browser back/forward
    window.addEventListener('popstate', (ev) => {
      if (ev.state && ev.state.pw === true && typeof ev.state.i === 'number') {
        this.detectSteps();
        const index = Math.max(0, Math.min(this.steps.length - 1, ev.state.i));
        
        this.steps.forEach((step, i) => {
          if (step) {
            step.classList.toggle('hidden', i !== index);
          }
        });
        
        this.currentStep = index;
        this.state.current = index;
        this.saveState();
        this.updateUI();
      } else {
        const hashIndex = this.getIndexFromHash();
        if (hashIndex !== null) {
          this.goto(hashIndex);
        }
      }
    });
  }

  /**
   * Handle card click (selection logic)
   * @param {HTMLElement} card - Clicked card element
   */
  handleCardClick(card) {
    const isRadio = card.getAttribute('role') === 'radio' || 
                    card.dataset.select === 'single' || 
                    card.querySelector('input[type="radio"]');
    
    const input = card.querySelector('input[type="checkbox"], input[type="radio"]');

    if (isRadio) {
      // Radio behavior: only one active
      if (input && input.type === 'radio' && input.name) {
        // Radio group by name
        const radios = document.querySelectorAll(
          `input[type="radio"][name="${CSS.escape(input.name)}"]`
        );
        
        radios.forEach(radio => {
          const wrapper = radio.closest(
            '.language-card, .lang-btn, .service-card, [data-toggle="select"], [role="radio"]'
          );
          
          if (wrapper) {
            wrapper.classList.toggle('selected', radio === input);
            wrapper.setAttribute('aria-checked', (radio === input).toString());
          }
        });
        
        input.checked = true;
      } else {
        // Visual radio (no input radio)
        const scope = card.parentElement || document;
        const siblings = scope.querySelectorAll(
          '.language-card, .lang-btn, .service-card, [data-toggle="select"], [role="radio"]'
        );
        
        siblings.forEach(sibling => {
          sibling.classList.remove('selected');
          sibling.setAttribute('aria-checked', 'false');
        });
        
        card.classList.add('selected');
        card.setAttribute('aria-checked', 'true');
        
        if (input) input.checked = true;
      }
    } else {
      // Checkbox behavior: toggle
      const isSelected = card.classList.contains('selected');
      const newState = !isSelected;
      
      card.classList.toggle('selected', newState);
      card.setAttribute('aria-checked', newState.toString());
      
      if (input) {
        if (input.type === 'checkbox') {
          input.checked = newState;
        } else if (input.type === 'radio') {
          input.checked = true;
        }
      }
    }

    this.updateUI();
  }
}