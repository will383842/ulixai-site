/**
 * Scroll To Top - Gestion du bouton de retour en haut de page
 * @module ScrollToTop
 */

export class ScrollToTop {
  constructor() {
    this.button = null;
    this.scrollThreshold = 300;
    this.isVisible = false;
  }

  /**
   * Initialise le bouton scroll to top
   */
  init() {
    console.log('🚀 [ScrollToTop] Initializing...');

    this.button = document.getElementById('scrollToTopBtn');

    if (!this.button) {
      console.warn('⚠️ [ScrollToTop] Button not found');
      return;
    }

    this.initScrollListener();
    this.initClickListener();

    console.log('✅ [ScrollToTop] Initialized successfully');
  }

  /**
   * Affiche ou masque le bouton selon le scroll
   */
  initScrollListener() {
    let ticking = false;

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          this.updateButtonVisibility();
          ticking = false;
        });
        ticking = true;
      }
    });

    // Vérification initiale
    this.updateButtonVisibility();
  }

  /**
   * Met à jour la visibilité du bouton
   */
  updateButtonVisibility() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > this.scrollThreshold && !this.isVisible) {
      this.showButton();
    } else if (scrollTop <= this.scrollThreshold && this.isVisible) {
      this.hideButton();
    }
  }

  /**
   * Affiche le bouton avec animation
   */
  showButton() {
    if (!this.button) return;
    
    this.button.classList.add('show');
    this.isVisible = true;
    console.log('👆 [ScrollToTop] Button shown');
  }

  /**
   * Masque le bouton avec animation
   */
  hideButton() {
    if (!this.button) return;
    
    this.button.classList.remove('show');
    this.isVisible = false;
    console.log('👇 [ScrollToTop] Button hidden');
  }

  /**
   * Initialise l'action du bouton
   */
  initClickListener() {
    if (!this.button) return;

    this.button.addEventListener('click', (e) => {
      e.preventDefault();
      this.scrollToTop();
    });
  }

  /**
   * Scroll vers le haut avec animation smooth
   */
  scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });

    // Vibration tactile sur mobile
    if (navigator.vibrate) {
      navigator.vibrate(10);
    }

    console.log('⬆️ [ScrollToTop] Scrolling to top');
  }

  /**
   * Permet de changer le seuil d'affichage dynamiquement
   * @param {number} threshold - Nouvelle valeur du seuil en pixels
   */
  setThreshold(threshold) {
    this.scrollThreshold = threshold;
    this.updateButtonVisibility();
  }
}

/**
 * Factory function pour initialiser le bouton scroll to top
 * @returns {ScrollToTop} Instance du scroll to top
 */
export function initializeScrollToTop() {
  const scrollToTop = new ScrollToTop();
  scrollToTop.init();
  return scrollToTop;
}