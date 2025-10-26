/**
 * ============================================
 * 🎯 WIZARD VALIDATION - CENTRALIZED
 * ============================================
 * Gestion centralisée des validations de steps
 */

class WizardValidator {
    constructor() {
        this.validators = {};
        this.currentStep = 0;
    }

    /**
     * Enregistrer une fonction de validation pour un step
     * @param {number} stepNumber - Numéro du step
     * @param {Function} validatorFn - Fonction qui retourne true/false
     * @param {string} errorMessage - Message d'erreur personnalisé
     */
    registerValidator(stepNumber, validatorFn, errorMessage = 'Please complete this step') {
        this.validators[stepNumber] = {
            validate: validatorFn,
            errorMessage: errorMessage
        };
    }

    /**
     * Activer/désactiver le bouton Next selon la validation
     * @param {number} stepNumber - Numéro du step
     * @param {string} nextBtnId - ID du bouton Next
     */
    setupAutoValidation(stepNumber, nextBtnId) {
        const nextBtn = document.getElementById(nextBtnId);
        if (!nextBtn) return;

        const validator = this.validators[stepNumber];
        if (!validator) return;

        // Fonction de vérification
        const checkValidation = () => {
            const isValid = validator.validate();
            nextBtn.disabled = !isValid;
            
            // Animation de déverrouillage
            if (isValid && nextBtn.hasAttribute('disabled') === false) {
                nextBtn.style.animation = 'buttonEnable 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                setTimeout(() => {
                    nextBtn.style.animation = '';
                }, 400);
            }
        };

        // Observer les changements dans le step
        const stepElement = document.getElementById(`step${stepNumber}`);
        if (stepElement) {
            // Observer les clics
            stepElement.addEventListener('click', () => {
                setTimeout(checkValidation, 100);
            });

            // Observer les changements de valeur des inputs
            stepElement.addEventListener('input', () => {
                setTimeout(checkValidation, 100);
            });

            // Observer les changements de sélection
            stepElement.addEventListener('change', () => {
                setTimeout(checkValidation, 100);
            });

            // Vérification initiale
            setTimeout(checkValidation, 200);
        }

        // Validation au clic sur Next
        nextBtn.addEventListener('click', (e) => {
            if (!validator.validate()) {
                e.stopImmediatePropagation();
                e.preventDefault();
                this.showError(validator.errorMessage);
                return false;
            }
        }, true);
    }

    /**
     * Afficher un message d'erreur moderne
     * @param {string} message - Message à afficher
     */
    showError(message) {
        // Supprimer les anciennes alertes
        document.querySelectorAll('.wizard-validation-alert').forEach(el => el.remove());

        const alertDiv = document.createElement('div');
        alertDiv.className = 'wizard-validation-alert fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-2xl z-[9999]';
        alertDiv.style.animation = 'slideInRight 0.3s ease-out';
        alertDiv.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <div class="font-bold">Validation Required</div>
                    <div class="text-sm">${message}</div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 hover:bg-red-600 rounded p-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(alertDiv);

        // Auto-remove après 5 secondes
        setTimeout(() => {
            alertDiv.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => alertDiv.remove(), 300);
        }, 5000);
    }

    /**
     * Valider un step (utilisé par le système de navigation)
     * @param {number} stepNumber - Numéro du step
     * @returns {boolean}
     */
    validateStep(stepNumber) {
        const validator = this.validators[stepNumber];
        if (!validator) return true; // Pas de validation = toujours valide
        return validator.validate();
    }
}

// Instance globale
window.wizardValidator = new WizardValidator();

// Animations CSS
if (!document.getElementById('wizard-validation-styles')) {
    const style = document.createElement('style');
    style.id = 'wizard-validation-styles';
    style.textContent = `
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
        
        @keyframes buttonEnable {
            0% { transform: scale(0.95); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);
}