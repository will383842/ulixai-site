/**
 * Mobile Menu - Gestion complète du menu mobile
 */

export class MobileMenu {
  constructor() {
    this.isMenuOpen = false;
    this.toggleButtons = [];
    this.mobileMenu = null;
    this.mobileMenuCloseBtn = null;
  }

  init() {
    this.toggleButtons = [
      document.getElementById("menu-toggle-top"),
      null
    ];
    this.mobileMenu = document.getElementById("mobile-menu");
    this.mobileMenuCloseBtn = document.getElementById("mobileMenuCloseBtn");

    if (!this.mobileMenu) {
      console.warn('Mobile menu not found');
      return;
    }

    this.initToggleListeners();
    this.initCloseButton();
    this.initLinkListeners();
    this.initKeyboardListeners();
    this.initOutsideClickListener();
    
    console.log('✅ Mobile menu initialized');
  }

  openMobileMenu() {
    if (!this.mobileMenu) return;

    this.isMenuOpen = true;
    this.mobileMenu.classList.add("menu-animating");
    this.mobileMenu.classList.remove("hidden");
    this.mobileMenu.classList.add("menu-open");

    requestAnimationFrame(() => {
      this.mobileMenu.style.opacity = '0';
      this.mobileMenu.style.transform = 'translateY(-10px)';

      requestAnimationFrame(() => {
        this.mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        this.mobileMenu.style.opacity = '1';
        this.mobileMenu.style.transform = 'translateY(0)';
      });
    });

    this.toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.add("menu-active");
        btn.setAttribute('aria-expanded', 'true');
      }
    });

    setTimeout(() => {
      this.mobileMenu.classList.remove("menu-animating");
    }, 300);

    if (navigator.vibrate) navigator.vibrate(10);
    this.mobileMenu.setAttribute('aria-hidden', 'false');
  }

  closeMobileMenu() {
    if (!this.mobileMenu) return;

    this.isMenuOpen = false;
    this.mobileMenu.classList.add("menu-animating");
    this.mobileMenu.classList.remove("menu-open");

    this.mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    this.mobileMenu.style.opacity = '0';
    this.mobileMenu.style.transform = 'translateY(-10px)';

    setTimeout(() => {
      this.mobileMenu.classList.add("hidden");
      this.mobileMenu.classList.remove("menu-animating");
      this.mobileMenu.style.opacity = '';
      this.mobileMenu.style.transform = '';
      this.mobileMenu.style.transition = '';
    }, 300);

    this.toggleButtons.forEach(btn => {
      if (btn) {
        btn.classList.remove("menu-active");
        btn.setAttribute('aria-expanded', 'false');
      }
    });

    if (navigator.vibrate) navigator.vibrate(5);
    this.mobileMenu.setAttribute('aria-hidden', 'true');
  }

  toggleMobileMenu() {
    if (this.isMenuOpen) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  initToggleListeners() {
    this.toggleButtons.forEach(btn => {
      if (btn) {
        btn.addEventListener("click", () => this.toggleMobileMenu());
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  }

  initCloseButton() {
    if (this.mobileMenuCloseBtn) {
      this.mobileMenuCloseBtn.addEventListener("click", () => this.closeMobileMenu());
    }
  }

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

  initKeyboardListeners() {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isMenuOpen) {
        this.closeMobileMenu();
      }
    });
  }

  initOutsideClickListener() {
    document.addEventListener('click', (e) => {
      if (this.isMenuOpen &&
          this.mobileMenu &&
          !this.mobileMenu.contains(e.target) &&
          !this.toggleButtons.some(btn => btn && btn.contains(e.target))) {
        this.closeMobileMenu();
      }
    });
  }
}

export function initializeMobileMenu() {
  const mobileMenu = new MobileMenu();
  mobileMenu.init();
  return mobileMenu;
}