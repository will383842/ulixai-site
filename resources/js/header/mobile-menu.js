/**
 * Mobile Menu - Gestion complète du menu mobile avec Bottom Sheet moderne
 * @module MobileMenu
 */

export class MobileMenu {
  constructor() {
    this.isMenuOpen = false;
    this.menuToggle = null;
    this.mobileMenu = null;
    this.mobileMenuOverlay = null;
  }

  /**
   * Initialise le menu mobile
   */
  init() {
    console.log('🔧 [MobileMenu] Initializing...');
    
    this.menuToggle = document.getElementById('menu-toggle-top');
    this.mobileMenu = document.getElementById('mobile-menu');
    this.mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    if (!this.mobileMenu) {
      console.warn('⚠️ [MobileMenu] Menu element not found');
      return;
    }

    if (!this.menuToggle) {
      console.warn('⚠️ [MobileMenu] Toggle button not found');
      return;
    }

    this.initToggleListener();
    this.initOverlayListener();
    this.initLinkListeners();
    this.initKeyboardListeners();
    
    console.log('✅ [MobileMenu] Initialized successfully');
  }

  /**
   * Ouvre le menu mobile avec animation bottom sheet
   */
  openMobileMenu() {
    if (!this.mobileMenu || !this.mobileMenuOverlay) return;

    console.log('📱 [MobileMenu] Opening menu');
    this.isMenuOpen = true;

    // Afficher l'overlay avec fade-in
    this.mobileMenuOverlay.classList.remove('hidden');
    setTimeout(() => {
      this.mobileMenuOverlay.classList.add('opacity-100');
    }, 10);

    // Slide-up le menu depuis le bas
    this.mobileMenu.classList.remove('translate-y-full');
    this.mobileMenu.classList.add('translate-y-0');
    this.mobileMenu.setAttribute('aria-hidden', 'false');

    // Bloquer le scroll du body
    document.body.style.overflow = 'hidden';

    // Transformer le hamburger en X
    if (this.menuToggle) {
      this.menuToggle.classList.add('menu-active');
      this.menuToggle.setAttribute('aria-expanded', 'true');
    }

    // Vibration tactile sur mobile
    if (navigator.vibrate) {
      navigator.vibrate(10);
    }
  }

  /**
   * Ferme le menu mobile avec animation
   */
  closeMobileMenu() {
    if (!this.mobileMenu || !this.mobileMenuOverlay) return;

    console.log('📱 [MobileMenu] Closing menu');
    this.isMenuOpen = false;

    // Masquer l'overlay avec fade-out
    this.mobileMenuOverlay.classList.remove('opacity-100');
    setTimeout(() => {
      this.mobileMenuOverlay.classList.add('hidden');
    }, 300);

    // Slide-down le menu vers le bas
    this.mobileMenu.classList.remove('translate-y-0');
    this.mobileMenu.classList.add('translate-y-full');
    this.mobileMenu.setAttribute('aria-hidden', 'true');

    // Rétablir le scroll
    document.body.style.overflow = '';

    // Restaurer le hamburger
    if (this.menuToggle) {
      this.menuToggle.classList.remove('menu-active');
      this.menuToggle.setAttribute('aria-expanded', 'false');
    }

    // Petite vibration de confirmation
    if (navigator.vibrate) {
      navigator.vibrate(5);
    }
  }

  /**
   * Toggle du menu
   */
  toggleMobileMenu() {
    if (this.isMenuOpen) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  /**
   * Initialise le bouton toggle
   */
  initToggleListener() {
    if (this.menuToggle) {
      this.menuToggle.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.toggleMobileMenu();
      });
    }
  }

  /**
   * Fermer le menu en cliquant sur l'overlay
   */
  initOverlayListener() {
    if (this.mobileMenuOverlay) {
      this.mobileMenuOverlay.addEventListener('click', () => {
        this.closeMobileMenu();
      });
    }
  }

  /**
   * Fermer le menu automatiquement après un clic sur un lien
   */
  initLinkListeners() {
    if (this.mobileMenu) {
      const menuLinks = this.mobileMenu.querySelectorAll('a');
      menuLinks.forEach(link => {
        link.addEventListener('click', () => {
          setTimeout(() => this.closeMobileMenu(), 100);
        });
      });
    }
  }

  /**
   * Support clavier (Escape pour fermer)
   */
  initKeyboardListeners() {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isMenuOpen) {
        this.closeMobileMenu();
      }
    });
  }
}

/**
 * Factory function pour initialiser le menu mobile
 * @returns {MobileMenu} Instance du menu mobile
 */
export function initializeMobileMenu() {
  const mobileMenu = new MobileMenu();
  mobileMenu.init();
  return mobileMenu;
}