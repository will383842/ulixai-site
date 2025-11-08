/**
 * Help Buttons - Gestion des boutons "Request Help" (Desktop + Mobile)
 * @module HelpButtons
 */

export class HelpButtons {
  constructor() {
    this.helpButtons = [];
  }

  /**
   * Initialise les boutons d'aide
   */
  init() {
    console.log('❓ [HelpButtons] Initializing...');

    // Récupérer tous les boutons d'aide possibles
    this.helpButtons = [
      document.getElementById('helpBtn'), // Desktop
      document.getElementById('mobileSearchButton'), // Mobile
      document.getElementById('requestHelpBtn'), // Alternatif
    ].filter(Boolean); // Filtrer les null/undefined

    if (this.helpButtons.length === 0) {
      console.warn('⚠️ [HelpButtons] No help buttons found');
      return;
    }

    this.initClickListeners();

    console.log(`✅ [HelpButtons] Initialized with ${this.helpButtons.length} button(s)`);
  }

  /**
   * Initialise les écouteurs de clic sur tous les boutons
   */
  initClickListeners() {
    this.helpButtons.forEach((button) => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.openHelpPopup();
      });
    });
  }

  /**
   * Ouvre le popup d'aide (wizard)
   */
  openHelpPopup() {
    console.log('🆘 [HelpButtons] Opening help popup');

    // Vérifier si la fonction globale existe
    if (typeof window.openHelpPopup === 'function') {
      window.openHelpPopup();
    } else {
      console.error('❌ [HelpButtons] window.openHelpPopup() not available');
      this.showFallbackMessage();
    }

    // Vibration tactile sur mobile
    if (navigator.vibrate) {
      navigator.vibrate([10, 20, 10]);
    }
  }

  /**
   * Affiche un message de fallback si le popup n'est pas disponible
   */
  showFallbackMessage() {
    // Utiliser Toastr si disponible
    if (typeof toastr !== 'undefined') {
      toastr.info('Please wait, loading help system...', 'Info');
      
      // Réessayer après 1 seconde
      setTimeout(() => {
        if (typeof window.openHelpPopup === 'function') {
          window.openHelpPopup();
        } else {
          toastr.error('Help system not available. Please refresh the page.', 'Error');
        }
      }, 1000);
    } else {
      alert('Help system is loading. Please try again in a moment.');
    }
  }

  /**
   * Permet d'ajouter dynamiquement un bouton d'aide
   * @param {HTMLElement} button - Élément bouton à ajouter
   */
  addButton(button) {
    if (button && !this.helpButtons.includes(button)) {
      this.helpButtons.push(button);
      button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.openHelpPopup();
      });
      console.log('➕ [HelpButtons] New button added');
    }
  }

  /**
   * Expose la méthode openHelpPopup globalement pour usage externe
   */
  exposeGlobally() {
    if (!window.helpButtonsManager) {
      window.helpButtonsManager = this;
      console.log('🌍 [HelpButtons] Exposed globally as window.helpButtonsManager');
    }
  }
}

/**
 * Factory function pour initialiser les boutons d'aide
 * @returns {HelpButtons} Instance du gestionnaire de boutons
 */
export function initializeHelpButtons() {
  const helpButtons = new HelpButtons();
  helpButtons.init();
  helpButtons.exposeGlobally();
  return helpButtons;
}