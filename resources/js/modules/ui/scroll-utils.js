/**
 * Scroll Utils - Scroll to top et autres utilitaires
 * MODIFIÉ: Bloque le bouton scroll dans le dashboard
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
        
        // 🔥 NOUVEAU: Bloquer dans le dashboard
        const isDashboard = document.body.dataset.page === 'dashboard';
        
        if (btn && window.innerWidth > 768 && !isDashboard) {
          btn.className = window.pageYOffset > 400 ? 'show' : '';
        } else if (btn && isDashboard) {
          btn.className = ''; // Force le masquage
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

    // Sanitize avatar URL - only allow safe URLs
    const sanitizeUrl = (url) => {
      if (!url) return '/images/helpexpat.webp';
      try {
        const parsed = new URL(url, window.location.origin);
        // Only allow http, https, or relative paths
        if (parsed.protocol === 'http:' || parsed.protocol === 'https:') {
          return parsed.href;
        }
        return '/images/helpexpat.webp';
      } catch {
        // If URL parsing fails, check if it's a safe relative path
        if (/^\/[a-zA-Z0-9\-_/.]+$/.test(url)) {
          return url;
        }
        return '/images/helpexpat.webp';
      }
    };

    // Create elements safely without innerHTML
    const userMenu = document.createElement('div');

    const relativeDiv = document.createElement('div');
    relativeDiv.className = 'relative';
    relativeDiv.setAttribute('x-data', '{ open:false }');

    const button = document.createElement('button');
    button.type = 'button';
    button.setAttribute('@click', 'open = !open');
    button.setAttribute('@keydown.escape.window', 'open = false');
    button.className = 'flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100';
    button.setAttribute('aria-haspopup', 'menu');
    button.setAttribute(':aria-expanded', 'open.toString()');

    const avatarDiv = document.createElement('div');
    avatarDiv.className = 'w-8 h-8 rounded-full border bg-center bg-cover';
    avatarDiv.style.backgroundImage = `url('${sanitizeUrl(userData.avatar)}')`;

    const nameSpan = document.createElement('span');
    nameSpan.id = 'header-user-name';
    nameSpan.className = 'font-medium text-gray-700 truncate max-w-[10rem]';
    nameSpan.textContent = userData.name || ''; // Safe: textContent escapes HTML

    const chevronIcon = document.createElement('i');
    chevronIcon.className = 'fas fa-chevron-down text-gray-500 text-sm';

    button.appendChild(avatarDiv);
    button.appendChild(nameSpan);
    button.appendChild(chevronIcon);
    relativeDiv.appendChild(button);
    userMenu.appendChild(relativeDiv);

    if (authButtons) {
      authButtons.replaceWith(userMenu);
    }
  };

  return scrollUtils;
}