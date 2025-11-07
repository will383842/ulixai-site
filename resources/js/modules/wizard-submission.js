/**
 * ═══════════════════════════════════════════════════════════
 * WIZARD SUBMISSION - Soumission finale vers /register
 * ═══════════════════════════════════════════════════════════
 * Aligné avec RegisterController (ligne 20)
 * Le user est déjà connecté à ce stade (Auth::login fait au step 15)
 */

export class WizardSubmission {
  constructor() {
    this.endpoint = '/register';
    this.storageKey = 'expats';
    this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
  }

  async submit() {
    console.log('📤 [WizardSubmission] Starting provider signup submission...');

    // 1. Récupérer les données
    let formData;
    try {
      formData = JSON.parse(localStorage.getItem(this.storageKey)) || {};
      console.log('📦 [WizardSubmission] Data to send:', formData);
    } catch (e) {
      console.error('❌ [WizardSubmission] Failed to parse expats data:', e);
      this.handleError(new Error('Invalid data format'));
      return;
    }

    // 2. Validation
    if (!formData.email) {
      this.handleError(new Error('Email is required'));
      return;
    }

    // 3. Loader
    this.showLoader();

    try {
      // 4. Envoyer à /register
      const response = await fetch(this.endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': this.csrfToken
        },
        body: JSON.stringify(formData)
      });

      console.log('📡 [WizardSubmission] Response status:', response.status);

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || `Server error: ${response.status}`);
      }

      const data = await response.json();
      this.handleSuccess(data);

    } catch (error) {
      console.error('❌ [WizardSubmission] Registration failed:', error);
      this.handleError(error);
    } finally {
      this.hideLoader();
    }
  }

  handleSuccess(data) {
    console.log('✅ [WizardSubmission] Registration successful:', data);
    
    // Vider localStorage
    localStorage.removeItem(this.storageKey);
    console.log('🗑️ [WizardSubmission] Cleared localStorage');
    
    // Message de succès
    if (typeof toastr !== 'undefined') {
      toastr.success(data.message || 'Account created successfully!', 'Success');
    }
    
    // Afficher Step 16
    this.showStep16();
    
    // ⚠️ ADAPTÉ: Le controller ne retourne pas de champ 'redirect'
    // On hardcode la redirection vers /dashboard
    setTimeout(() => {
      const redirectUrl = '/dashboard'; // Hardcodé
      console.log('🔄 [WizardSubmission] Redirecting to:', redirectUrl);
      window.location.href = redirectUrl;
    }, 3000);
  }

  handleError(error) {
    console.error('❌ [WizardSubmission] Error:', error);
    
    const message = error.message || 'Failed to create account. Please try again.';
    
    if (typeof toastr !== 'undefined') {
      toastr.error(message, 'Error');
    } else {
      alert(`Error: ${message}`);
    }
    
    if (navigator.vibrate) {
      navigator.vibrate([100, 50, 100]);
    }
  }

  showStep16() {
    console.log('🎉 [WizardSubmission] Showing step 16');
    
    for (let i = 1; i <= 16; i++) {
      const step = document.getElementById(`step${i}`);
      if (step) step.classList.add('hidden');
    }
    
    const step16 = document.getElementById('step16');
    if (step16) step16.classList.remove('hidden');
    
    const progressBar = document.getElementById('progress-bar');
    if (progressBar) progressBar.style.width = '100%';
  }

  showLoader() {
    const buttons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
    buttons.forEach(btn => {
      btn.disabled = true;
      btn.classList.add('opacity-50', 'cursor-not-allowed');
      btn.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-white inline-block mr-2" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Creating Account...</span>
      `;
    });
  }

  hideLoader() {
    const buttons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
    buttons.forEach(btn => {
      btn.disabled = false;
      btn.classList.remove('opacity-50', 'cursor-not-allowed');
      btn.innerHTML = `
        <span>Continue</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      `;
    });
  }
}

export function initializeWizardSubmission() {
  const submission = new WizardSubmission();
  
  window.onProviderSignupSubmit = () => {
    submission.submit();
  };

  console.log('✅ [WizardSubmission] Module initialized');
  return submission;
}