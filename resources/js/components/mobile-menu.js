/**
 * Mobile Menu Manager
 * Gère l'ouverture/fermeture du menu mobile avec animations
 */

export class MobileMenu {
  constructor(options = {}) {
    this.menuId = options.menuId || 'mobile-menu';
    this.toggleIds = options.toggleIds || ['menu-toggle-top'];
    this.closeButtonId = options.closeButtonId || 'mobileMenuCloseBtn';
    
    this.menu = null;
    this.toggleButtons = [];
    this.closeButton = null;
    this.isOpen = false;
    
    this.init();
  }

  /**
   * Initialize mobile menu
   */
  init() {
    this.menu = document.getElementById(this.menuId);
    if (!this.menu) {
      console.warn(`Mobile menu #${this.menuId} not found`);
      return;
    }

    // Get toggle buttons
    this.toggleButtons = this.toggleIds
      .map(id => document.getElementById(id))
      .filter(Boolean);

    // Get close button
    this.closeButton = document.getElementById(this.closeButtonId);

    // Setup listeners
    this.setupListeners();
  }

  /**
   * Setup event listeners
   */
  setupListeners() {
    // Toggle buttons
    this.toggleButtons.forEach(btn => {
      btn.addEventListener('click', () => this.toggle());
      btn.setAttribute('aria-expanded', 'false');
      btn.setAttribute('aria-controls', this.menuId);
    });

    // Close button
    if (this.closeButton) {
      this.closeButton.addEventListener('click', () => this.close());
    }

    // Close on menu link click
    const menuLinks = this.menu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        setTimeout(() => this.close(), 100);
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen) {
        this.close();
      }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (this.isOpen && 
          !this.menu.contains(e.target) && 
          !this.toggleButtons.some(btn => btn && btn.contains(e.target))) {
        this.close();
      }
    });
  }

  /**
   * Open menu
   */
  open() {
    if (!this.menu || this.isOpen) return;

    this.isOpen = true;
    
    // Add animation class
    this.menu.classList.add('menu-animating');
    
    // Remove hidden class
    this.menu.classList.remove('hidden');
    this.menu.classList.add('menu-open');
    
    // Animate in
    requestAnimationFrame(() => {
      this.menu.style.opacity = '0';
      this.menu.style.transform = 'translateY(-10px)';
      
      requestAnimationFrame(() => {
        this.menu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        this.menu.style.opacity = '1';
        this.menu.style.transform = 'translateY(0)';
      });
    });

    // Update toggle buttons
    this.toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.add('menu-active');
        btn.setAttribute('aria-expanded', 'true');
      }
    });

    // Vibration feedback (if supported)
    if (navigator.vibrate) {
      navigator.vibrate(10);
    }

    // Accessibility
    this.menu.setAttribute('aria-hidden', 'false');

    // Remove animation class after animation
    setTimeout(() => {
      this.menu.classList.remove('menu-animating');
    }, 300);
  }

  /**
   * Close menu
   */
  close() {
    if (!this.menu || !this.isOpen) return;

    this.isOpen = false;

    // Add animation class
    this.menu.classList.add('menu-animating');
    this.menu.classList.remove('menu-open');

    // Animate out
    this.menu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    this.menu.style.opacity = '0';
    this.menu.style.transform = 'translateY(-10px)';

    // Hide after animation
    setTimeout(() => {
      this.menu.classList.add('hidden');
      this.menu.classList.remove('menu-animating');
      this.menu.style.opacity = '';
      this.menu.style.transform = '';
      this.menu.style.transition = '';
    }, 300);

    // Update toggle buttons
    this.toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.remove('menu-active');
        btn.setAttribute('aria-expanded', 'false');
      }
    });

    // Vibration feedback
    if (navigator.vibrate) {
      navigator.vibrate(5);
    }

    // Accessibility
    this.menu.setAttribute('aria-hidden', 'true');
  }

  /**
   * Toggle menu
   */
  toggle() {
    if (this.isOpen) {
      this.close();
    } else {
      this.open();
    }
  }
}