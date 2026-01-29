{{--
  ═══════════════════════════════════════════════════════════
  FLOATING BUG REPORT BUTTON + MODAL
  ═══════════════════════════════════════════════════════════

  Mobile-First Perfect Design
  - Bouton flottant discret mais accessible
  - Modal bottom-sheet sur mobile / centré sur desktop
  - Formulaire simplifié avec auto-capture du contexte
  - Animations GPU-optimisées
  - Accessibilité WCAG 2.1 AA
  - Auto-hide quand d'autres modaux sont ouverts

  Usage: @include('components.floating-bug-report')
--}}

@php
  // Ne pas afficher sur la page de bug report dédiée
  $hideBugButton = request()->is('report-bug') || request()->is('*/report-bug');
@endphp

@if(!$hideBugButton)
<style>
/* ============================================
   FLOATING BUG REPORT - MOBILE FIRST
   ============================================ */

/* Floating Button */
.fbr-btn {
  position: fixed;
  bottom: 1.25rem;
  right: 1.25rem;
  width: 3.25rem;
  height: 3.25rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
  border: none;
  cursor: pointer;
  z-index: 9990;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 20px -4px rgba(59, 130, 246, 0.5);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  -webkit-tap-highlight-color: transparent;
  outline: none;
}

.fbr-btn:hover {
  transform: scale(1.1);
  box-shadow: 0 8px 30px -4px rgba(59, 130, 246, 0.6);
}

.fbr-btn:active {
  transform: scale(0.95);
}

.fbr-btn:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 3px;
}

/* Pulse ring */
.fbr-btn::before {
  content: '';
  position: absolute;
  inset: -4px;
  border-radius: 50%;
  border: 2px solid rgba(59, 130, 246, 0.4);
  animation: fbr-pulse 2.5s ease-out infinite;
}

@keyframes fbr-pulse {
  0% { transform: scale(1); opacity: 1; }
  100% { transform: scale(1.4); opacity: 0; }
}

.fbr-btn-icon {
  font-size: 1.5rem;
  color: white;
  line-height: 1;
}

/* Tooltip */
.fbr-tooltip {
  position: absolute;
  right: calc(100% + 0.75rem);
  top: 50%;
  transform: translateY(-50%);
  background: #1f2937;
  color: white;
  padding: 0.5rem 0.75rem;
  border-radius: 0.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: all 0.2s ease;
  pointer-events: none;
}

.fbr-tooltip::after {
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  transform: translateY(-50%);
  border: 6px solid transparent;
  border-left-color: #1f2937;
}

.fbr-btn:hover .fbr-tooltip {
  opacity: 1;
  visibility: visible;
}

/* Hide button when modal is open */
.fbr-btn.hidden {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
}

/* ============================================
   MODAL OVERLAY
   ============================================ */
.fbr-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  z-index: 9995;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

.fbr-overlay.active {
  opacity: 1;
  visibility: visible;
}

/* ============================================
   MODAL CONTAINER - Bottom Sheet Mobile
   ============================================ */
.fbr-modal {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  max-height: 90vh;
  background: white;
  border-radius: 1.5rem 1.5rem 0 0;
  z-index: 9996;
  transform: translateY(100%);
  transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.fbr-modal.active {
  transform: translateY(0);
}

/* Drag handle for mobile */
.fbr-drag-handle {
  width: 100%;
  padding: 0.75rem 0 0.5rem;
  display: flex;
  justify-content: center;
  cursor: grab;
  flex-shrink: 0;
}

.fbr-drag-handle::before {
  content: '';
  width: 2.5rem;
  height: 0.25rem;
  background: #d1d5db;
  border-radius: 9999px;
}

/* Modal Header */
.fbr-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.25rem 1rem;
  border-bottom: 1px solid #f3f4f6;
  flex-shrink: 0;
}

.fbr-title {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 1.125rem;
  font-weight: 700;
  color: #111827;
}

.fbr-title-icon {
  font-size: 1.25rem;
}

.fbr-close {
  width: 2.25rem;
  height: 2.25rem;
  border-radius: 50%;
  border: none;
  background: #f3f4f6;
  color: #6b7280;
  font-size: 1.25rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  -webkit-tap-highlight-color: transparent;
}

.fbr-close:hover {
  background: #e5e7eb;
  color: #374151;
}

.fbr-close:active {
  transform: scale(0.9);
}

/* Modal Body */
.fbr-body {
  padding: 1.25rem;
  overflow-y: auto;
  flex: 1;
  -webkit-overflow-scrolling: touch;
  overscroll-behavior: contain;
}

/* Type Selector */
.fbr-types {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0.5rem;
  margin-bottom: 1.25rem;
}

.fbr-type {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
  padding: 0.625rem 0.25rem;
  border: 2px solid #e5e7eb;
  border-radius: 0.75rem;
  background: white;
  cursor: pointer;
  transition: all 0.2s ease;
  -webkit-tap-highlight-color: transparent;
}

.fbr-type:hover {
  border-color: #93c5fd;
  background: #eff6ff;
}

.fbr-type.active {
  border-color: #3b82f6;
  background: #eff6ff;
}

.fbr-type-icon {
  font-size: 1.375rem;
  line-height: 1;
}

.fbr-type-label {
  font-size: 0.6875rem;
  font-weight: 600;
  color: #6b7280;
  text-align: center;
}

.fbr-type.active .fbr-type-label {
  color: #3b82f6;
}

/* Form Group */
.fbr-group {
  margin-bottom: 1rem;
}

.fbr-label {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.fbr-label-icon {
  font-size: 0.875rem;
}

.fbr-textarea {
  width: 100%;
  min-height: 6rem;
  padding: 0.875rem;
  border: 2px solid #e5e7eb;
  border-radius: 0.75rem;
  font-family: inherit;
  font-size: 0.9375rem;
  line-height: 1.5;
  color: #111827;
  resize: vertical;
  transition: all 0.2s ease;
  -webkit-appearance: none;
}

.fbr-textarea::placeholder {
  color: #9ca3af;
}

.fbr-textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Character Counter */
.fbr-counter {
  text-align: right;
  font-size: 0.6875rem;
  color: #9ca3af;
  margin-top: 0.25rem;
}

.fbr-counter.warn {
  color: #f59e0b;
}

.fbr-counter.limit {
  color: #ef4444;
}

/* Submit Button */
.fbr-submit {
  width: 100%;
  padding: 1rem;
  border: none;
  border-radius: 0.75rem;
  background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
  color: white;
  font-size: 0.9375rem;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  transition: all 0.2s ease;
  -webkit-tap-highlight-color: transparent;
}

.fbr-submit:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px -4px rgba(59, 130, 246, 0.4);
}

.fbr-submit:active:not(:disabled) {
  transform: scale(0.98);
}

.fbr-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.fbr-submit-icon {
  font-size: 1.125rem;
}

/* Loading Spinner */
.fbr-spinner {
  width: 1.25rem;
  height: 1.25rem;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: fbr-spin 0.8s linear infinite;
}

@keyframes fbr-spin {
  to { transform: rotate(360deg); }
}

/* Success State */
.fbr-success {
  display: none;
  flex-direction: column;
  align-items: center;
  padding: 2rem 1rem;
  text-align: center;
}

.fbr-success.active {
  display: flex;
}

.fbr-success-icon {
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  color: white;
  margin-bottom: 1rem;
  animation: fbr-pop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes fbr-pop {
  0% { transform: scale(0); }
  60% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

.fbr-success-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111827;
  margin-bottom: 0.5rem;
}

.fbr-success-text {
  font-size: 0.875rem;
  color: #6b7280;
  line-height: 1.5;
}

/* Form container */
.fbr-form {
  display: block;
}

.fbr-form.hidden {
  display: none;
}

/* Info text */
.fbr-info {
  display: flex;
  align-items: flex-start;
  gap: 0.5rem;
  padding: 0.75rem;
  background: #f0f9ff;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  font-size: 0.75rem;
  color: #0369a1;
  line-height: 1.4;
}

.fbr-info-icon {
  flex-shrink: 0;
  font-size: 0.875rem;
}

/* ============================================
   TABLET & DESKTOP - Centered Modal
   ============================================ */
@media (min-width: 640px) {
  .fbr-btn {
    width: 3.5rem;
    height: 3.5rem;
    bottom: 1.5rem;
    right: 1.5rem;
  }

  .fbr-btn-icon {
    font-size: 1.625rem;
  }

  .fbr-modal {
    position: fixed;
    left: 50%;
    top: 50%;
    bottom: auto;
    right: auto;
    transform: translate(-50%, -50%) scale(0.9);
    opacity: 0;
    width: 100%;
    max-width: 28rem;
    max-height: 85vh;
    border-radius: 1.25rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }

  .fbr-modal.active {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
  }

  .fbr-drag-handle {
    display: none;
  }

  .fbr-header {
    padding: 1.25rem 1.5rem;
  }

  .fbr-body {
    padding: 1.5rem;
  }

  .fbr-types {
    gap: 0.75rem;
  }

  .fbr-type {
    padding: 0.75rem 0.5rem;
  }

  .fbr-type-icon {
    font-size: 1.5rem;
  }

  .fbr-type-label {
    font-size: 0.75rem;
  }

  .fbr-textarea {
    min-height: 7rem;
  }
}

/* ============================================
   LARGE DESKTOP
   ============================================ */
@media (min-width: 1024px) {
  .fbr-btn {
    bottom: 2rem;
    right: 2rem;
  }

  .fbr-modal {
    max-width: 30rem;
  }
}

/* ============================================
   REDUCED MOTION
   ============================================ */
@media (prefers-reduced-motion: reduce) {
  .fbr-btn::before,
  .fbr-success-icon,
  .fbr-spinner {
    animation: none;
  }

  .fbr-btn,
  .fbr-modal,
  .fbr-overlay {
    transition-duration: 0.01ms;
  }
}

/* ============================================
   SAFE AREA (iPhone X+)
   ============================================ */
@supports (padding-bottom: env(safe-area-inset-bottom)) {
  .fbr-btn {
    bottom: calc(1.25rem + env(safe-area-inset-bottom));
  }

  .fbr-body {
    padding-bottom: calc(1.25rem + env(safe-area-inset-bottom));
  }

  @media (min-width: 640px) {
    .fbr-btn {
      bottom: 1.5rem;
    }

    .fbr-body {
      padding-bottom: 1.5rem;
    }
  }
}

/* ============================================
   DARK MODE SUPPORT (optional)
   ============================================ */
@media (prefers-color-scheme: dark) {
  /* Uncomment to enable dark mode
  .fbr-modal {
    background: #1f2937;
  }
  .fbr-header {
    border-color: #374151;
  }
  .fbr-title {
    color: #f9fafb;
  }
  .fbr-close {
    background: #374151;
    color: #9ca3af;
  }
  .fbr-type {
    background: #1f2937;
    border-color: #374151;
  }
  .fbr-type.active {
    border-color: #3b82f6;
    background: #1e3a5f;
  }
  .fbr-label {
    color: #d1d5db;
  }
  .fbr-textarea {
    background: #111827;
    border-color: #374151;
    color: #f9fafb;
  }
  .fbr-info {
    background: #1e3a5f;
    color: #7dd3fc;
  }
  */
}
</style>

<!-- ============================================
     FLOATING BUTTON
     ============================================ -->
<button
  type="button"
  id="fbrButton"
  class="fbr-btn"
  aria-label="{{ __('Report a problem') }}"
  aria-haspopup="dialog"
  aria-expanded="false"
>
  <span class="fbr-btn-icon" aria-hidden="true">?</span>
  <span class="fbr-tooltip">{{ __('Report a problem') }}</span>
</button>

<!-- ============================================
     MODAL OVERLAY
     ============================================ -->
<div id="fbrOverlay" class="fbr-overlay" aria-hidden="true"></div>

<!-- ============================================
     MODAL
     ============================================ -->
<div
  id="fbrModal"
  class="fbr-modal"
  role="dialog"
  aria-labelledby="fbrTitle"
  aria-modal="true"
  aria-hidden="true"
>
  <!-- Drag Handle (mobile) -->
  <div class="fbr-drag-handle" aria-hidden="true"></div>

  <!-- Header -->
  <header class="fbr-header">
    <h2 id="fbrTitle" class="fbr-title">
      <span class="fbr-title-icon" aria-hidden="true">?</span>
      <span>{{ __('How can we help?') }}</span>
    </h2>
    <button
      type="button"
      id="fbrClose"
      class="fbr-close"
      aria-label="{{ __('Close') }}"
    >
      <span aria-hidden="true">&times;</span>
    </button>
  </header>

  <!-- Body -->
  <div class="fbr-body">
    <!-- Success State -->
    <div id="fbrSuccess" class="fbr-success" role="alert" aria-live="polite">
      <div class="fbr-success-icon" aria-hidden="true">&#10003;</div>
      <h3 class="fbr-success-title">{{ __('Thank you!') }}</h3>
      <p class="fbr-success-text">{{ __('Your feedback has been received. We appreciate you taking the time to help us improve.') }}</p>
    </div>

    <!-- Form -->
    <form id="fbrForm" class="fbr-form" novalidate>
      <!-- Type Selector -->
      <div class="fbr-types" role="group" aria-label="{{ __('Report type') }}">
        <button type="button" class="fbr-type active" data-type="bug" aria-pressed="true">
          <span class="fbr-type-icon" aria-hidden="true">&#128027;</span>
          <span class="fbr-type-label">{{ __('Bug') }}</span>
        </button>
        <button type="button" class="fbr-type" data-type="suggestion" aria-pressed="false">
          <span class="fbr-type-icon" aria-hidden="true">&#128161;</span>
          <span class="fbr-type-label">{{ __('Idea') }}</span>
        </button>
        <button type="button" class="fbr-type" data-type="question" aria-pressed="false">
          <span class="fbr-type-icon" aria-hidden="true">&#10067;</span>
          <span class="fbr-type-label">{{ __('Question') }}</span>
        </button>
        <button type="button" class="fbr-type" data-type="other" aria-pressed="false">
          <span class="fbr-type-icon" aria-hidden="true">&#128172;</span>
          <span class="fbr-type-label">{{ __('Other') }}</span>
        </button>
      </div>

      <!-- Info -->
      <div class="fbr-info">
        <span class="fbr-info-icon" aria-hidden="true">&#128274;</span>
        <span>{{ __('Your feedback is anonymous unless logged in. Page context is captured automatically.') }}</span>
      </div>

      <!-- Description -->
      <div class="fbr-group">
        <label for="fbrDescription" class="fbr-label">
          <span class="fbr-label-icon" aria-hidden="true">&#9998;</span>
          <span id="fbrDescLabel">{{ __('Describe the issue') }}</span>
        </label>
        <textarea
          id="fbrDescription"
          name="bug_description"
          class="fbr-textarea"
          placeholder="{{ __('What happened? What did you expect?') }}"
          maxlength="2000"
          aria-describedby="fbrDescCounter"
        ></textarea>
        <div id="fbrDescCounter" class="fbr-counter">0 / 2000</div>
      </div>

      <!-- Suggestion (optional) -->
      <div class="fbr-group">
        <label for="fbrSuggestion" class="fbr-label">
          <span class="fbr-label-icon" aria-hidden="true">&#128161;</span>
          <span>{{ __('Suggestion (optional)') }}</span>
        </label>
        <textarea
          id="fbrSuggestion"
          name="suggestions"
          class="fbr-textarea"
          placeholder="{{ __('How could we improve this?') }}"
          maxlength="2000"
          aria-describedby="fbrSugCounter"
          style="min-height: 4rem;"
        ></textarea>
        <div id="fbrSugCounter" class="fbr-counter">0 / 2000</div>
      </div>

      <!-- Submit -->
      <button type="submit" id="fbrSubmit" class="fbr-submit">
        <span id="fbrSubmitText">{{ __('Send feedback') }}</span>
        <span class="fbr-submit-icon" aria-hidden="true">&#128640;</span>
      </button>
    </form>
  </div>
</div>

<script>
(function() {
  'use strict';

  // Elements
  const btn = document.getElementById('fbrButton');
  const overlay = document.getElementById('fbrOverlay');
  const modal = document.getElementById('fbrModal');
  const closeBtn = document.getElementById('fbrClose');
  const form = document.getElementById('fbrForm');
  const success = document.getElementById('fbrSuccess');
  const submitBtn = document.getElementById('fbrSubmit');
  const submitText = document.getElementById('fbrSubmitText');
  const descInput = document.getElementById('fbrDescription');
  const sugInput = document.getElementById('fbrSuggestion');
  const descCounter = document.getElementById('fbrDescCounter');
  const sugCounter = document.getElementById('fbrSugCounter');
  const descLabel = document.getElementById('fbrDescLabel');
  const typeButtons = document.querySelectorAll('.fbr-type');

  let currentType = 'bug';
  let isOpen = false;

  // Labels by type
  const labels = {
    bug: '{{ __("Describe the issue") }}',
    suggestion: '{{ __("Describe your idea") }}',
    question: '{{ __("What is your question?") }}',
    other: '{{ __("How can we help?") }}'
  };

  const placeholders = {
    bug: '{{ __("What happened? What did you expect?") }}',
    suggestion: '{{ __("What feature would help you?") }}',
    question: '{{ __("What would you like to know?") }}',
    other: '{{ __("Tell us more...") }}'
  };

  // Open modal
  function openModal() {
    isOpen = true;
    btn.classList.add('hidden');
    btn.setAttribute('aria-expanded', 'true');
    overlay.classList.add('active');
    overlay.setAttribute('aria-hidden', 'false');
    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    // Focus first interactive element
    setTimeout(() => {
      descInput.focus();
    }, 100);
  }

  // Close modal
  function closeModal() {
    isOpen = false;
    btn.classList.remove('hidden');
    btn.setAttribute('aria-expanded', 'false');
    overlay.classList.remove('active');
    overlay.setAttribute('aria-hidden', 'true');
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';

    // Reset after animation
    setTimeout(() => {
      form.classList.remove('hidden');
      success.classList.remove('active');
      form.reset();
      updateCounter(descInput, descCounter);
      updateCounter(sugInput, sugCounter);
      resetButton();
    }, 350);
  }

  // Update character counter
  function updateCounter(input, counter) {
    const len = input.value.length;
    const max = 2000;
    counter.textContent = len + ' / ' + max;
    counter.classList.remove('warn', 'limit');
    if (len > 1800) {
      counter.classList.add('limit');
    } else if (len > 1500) {
      counter.classList.add('warn');
    }
  }

  // Reset submit button
  function resetButton() {
    submitBtn.disabled = false;
    submitText.textContent = '{{ __("Send feedback") }}';
    const spinner = submitBtn.querySelector('.fbr-spinner');
    if (spinner) spinner.remove();
    const icon = submitBtn.querySelector('.fbr-submit-icon');
    if (icon) icon.style.display = '';
  }

  // Show loading state
  function setLoading(loading) {
    submitBtn.disabled = loading;
    const icon = submitBtn.querySelector('.fbr-submit-icon');

    if (loading) {
      submitText.textContent = '{{ __("Sending...") }}';
      if (icon) icon.style.display = 'none';
      const spinner = document.createElement('span');
      spinner.className = 'fbr-spinner';
      submitBtn.appendChild(spinner);
    } else {
      resetButton();
    }
  }

  // Show success
  function showSuccess() {
    form.classList.add('hidden');
    success.classList.add('active');

    // Auto close after delay
    setTimeout(() => {
      closeModal();
    }, 2500);
  }

  // Notify (toast)
  function notify(message, type) {
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-[9999] transform translate-x-full transition-transform duration-300 text-white text-sm font-semibold';
    toast.style.background = type === 'success' ? '#10b981' : '#ef4444';
    toast.textContent = message;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
      toast.classList.remove('translate-x-full');
    });

    setTimeout(() => {
      toast.classList.add('translate-x-full');
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  // Event: Open button
  btn.addEventListener('click', openModal);

  // Event: Close button
  closeBtn.addEventListener('click', closeModal);

  // Event: Overlay click
  overlay.addEventListener('click', closeModal);

  // Event: Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isOpen) {
      closeModal();
    }
  });

  // Event: Type selection
  typeButtons.forEach(function(typeBtn) {
    typeBtn.addEventListener('click', function() {
      typeButtons.forEach(function(b) {
        b.classList.remove('active');
        b.setAttribute('aria-pressed', 'false');
      });
      this.classList.add('active');
      this.setAttribute('aria-pressed', 'true');
      currentType = this.dataset.type;

      // Update label and placeholder
      descLabel.textContent = labels[currentType];
      descInput.placeholder = placeholders[currentType];
    });
  });

  // Event: Character counters
  descInput.addEventListener('input', function() {
    updateCounter(this, descCounter);
  });

  sugInput.addEventListener('input', function() {
    updateCounter(this, sugCounter);
  });

  // Event: Form submit
  form.addEventListener('submit', async function(e) {
    e.preventDefault();

    const description = descInput.value.trim();
    const suggestion = sugInput.value.trim();

    if (!description && !suggestion) {
      notify('{{ __("Please describe the issue or provide a suggestion.") }}', 'error');
      descInput.focus();
      return;
    }

    setLoading(true);

    try {
      const response = await fetch('/api/report-bug', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          bug_description: description || null,
          suggestions: suggestion || null,
          report_type: currentType,
          page_url: window.location.href,
          screen_size: window.innerWidth + 'x' + window.innerHeight
        })
      });

      if (!response.ok) {
        throw new Error('Failed');
      }

      showSuccess();
      notify('{{ __("Thank you for your feedback!") }}', 'success');

    } catch (error) {
      console.error('Bug report error:', error);
      notify('{{ __("Failed to send. Please try again.") }}', 'error');
      setLoading(false);
    }
  });

  // Touch swipe to close on mobile
  let touchStartY = 0;
  let touchCurrentY = 0;

  modal.addEventListener('touchstart', function(e) {
    touchStartY = e.touches[0].clientY;
  }, { passive: true });

  modal.addEventListener('touchmove', function(e) {
    touchCurrentY = e.touches[0].clientY;
    const diff = touchCurrentY - touchStartY;

    // Only allow swipe down
    if (diff > 0 && diff < 200) {
      modal.style.transform = 'translateY(' + diff + 'px)';
    }
  }, { passive: true });

  modal.addEventListener('touchend', function() {
    const diff = touchCurrentY - touchStartY;
    modal.style.transform = '';

    // Close if swiped more than 100px
    if (diff > 100) {
      closeModal();
    }

    touchStartY = 0;
    touchCurrentY = 0;
  }, { passive: true });

  // Auto-hide button when other modals are open
  function checkOtherModals() {
    if (isOpen) return; // Don't hide if our modal is open

    // Check for common modal/overlay patterns
    const otherModals = document.querySelectorAll(
      '.modal-overlay.active, .modal.active, [role="dialog"]:not(#fbrModal)[aria-hidden="false"], ' +
      '.popup-overlay:not(.hidden), #searchPopup:not(.hidden), #expatriesPopup:not(.hidden)'
    );

    let hasVisibleModal = false;
    otherModals.forEach(m => {
      if (m.id !== 'fbrModal' && m.id !== 'fbrOverlay') {
        const style = window.getComputedStyle(m);
        if (style.display !== 'none' && style.visibility !== 'hidden' && style.opacity !== '0') {
          hasVisibleModal = true;
        }
      }
    });

    if (hasVisibleModal) {
      btn.style.opacity = '0';
      btn.style.pointerEvents = 'none';
    } else {
      btn.style.opacity = '';
      btn.style.pointerEvents = '';
    }
  }

  // Observe DOM changes for modal visibility
  const observer = new MutationObserver(checkOtherModals);
  observer.observe(document.body, {
    childList: true,
    subtree: true,
    attributes: true,
    attributeFilter: ['class', 'style', 'aria-hidden']
  });

  // Initial check
  setTimeout(checkOtherModals, 500);

})();
</script>
@endif
