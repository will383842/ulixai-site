/**
 * Scroll Utils - Scroll to top et autres utilitaires
 * SAFE: Code extrait exact
 */

export class ScrollUtils {
  init() {
    this.initScrollRestore();
    this.initScrollToTop();
    this.initUserNameUpdates();
  }

  initScrollRestore() {
    if ('scrollRestoration' in history) {
      history.scrollRestoration = 'manual';
    }

    window.onload = () => window.scrollTo(0, 0);

    let scrollTimer;
    window.onscroll = function () {
      clearTimeout(scrollTimer);
      scrollTimer = setTimeout(() => {
        const btn = document.getElementById('scrollToTopBtn');
        if (btn && window.innerWidth > 768) {
          btn.className = window.pageYOffset > 400 ? 'show' : '';
        }
      }, 100);
    };
  }

  initScrollToTop() {
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('scrollToTopBtn');
      if (btn) {
        btn.addEventListener('click', () => {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    });
  }

  initUserNameUpdates() {
    document.addEventListener('DOMContentLoaded', () => {
      this.updateUserDisplayNames();
    });
  }

  extractFirstName(fullName) {
    const cleanName = fullName.replace(/[^\w\s]/g, '').trim();
    const nameParts = cleanName.split(/\s+/);
    return nameParts[0] || cleanName;
  }

  updateUserDisplayNames() {
    const headerUserName = document.getElementById('header-user-name');
    if (headerUserName) {
      const fullName = headerUserName.textContent.trim();
      headerUserName.textContent = this.extractFirstName(fullName);
    }

    const headerUserFullname = document.getElementById('header-user-fullname');
    if (headerUserFullname) {
      const fullName = headerUserFullname.textContent.trim();
      headerUserFullname.textContent = this.extractFirstName(fullName);
    }

    const sidebarGreeting = document.getElementById('user-greeting');
    if (sidebarGreeting) {
      const fullGreeting = sidebarGreeting.textContent.trim();
      const firstName = this.extractFirstName(fullGreeting);
      sidebarGreeting.textContent = firstName + '!';
    }
  }
}

// Fonctions globales nécessaires
export function initializeScrollUtils() {
  const scrollUtils = new ScrollUtils();
  scrollUtils.init();

  window.updateHeaderAfterLogin = (userData) => {
    const authButtons = document.querySelector('.auth-buttons');
    const userMenu = document.createElement('div');

    userMenu.innerHTML = `
      <div class="relative" x-data="{ open:false }">
        <button 
          type="button"
          @click="open = !open"
          @keydown.escape.window="open = false"
          class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100"
          aria-haspopup="menu"
          :aria-expanded="open.toString()"
        >
          <div class="w-8 h-8 rounded-full border bg-center bg-cover"
            style="background-image: url('${userData.avatar || '/images/helpexpat.webp'}');">
          </div>
          <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">
            ${userData.name}
          </span>
          <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
        </button>
      </div>
    `;

    if (authButtons) {
      authButtons.replaceWith(userMenu);
    }
  };

  return scrollUtils;
}