/**
 * Language Manager - Professional Architecture
 * Manages UI interactions only, Google Translate init handled in header
 */

export class LanguageManager {
  constructor() {
    this.selectedLang = localStorage.getItem('ulixai_lang') || 'en';
    this.selectedFlag = localStorage.getItem('ulixai_flag') || 'https://flagcdn.com/24x18/us.png';
    this.googleTranslateReady = false;
    this.initPromise = null;
  }

  /**
   * Initialize language manager
   * Waits for DOM and Google Translate to be ready
   */
  async init() {
    console.log('🌐 [LangManager] Initializing...');

    // Wait for DOM
    await this.waitForDOM();

    // Wait for Google Translate
    await this.waitForGoogleTranslate();

    // Initialize UI
    this.initDesktopLanguageSelector();
    this.initMobileLanguageSelector();

    console.log('✅ [LangManager] Initialized');
  }

  /**
   * Wait for DOM to be ready
   */
  waitForDOM() {
    return new Promise((resolve) => {
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', resolve, { once: true });
      } else {
        resolve();
      }
    });
  }

  /**
   * Wait for Google Translate to be ready
   */
  waitForGoogleTranslate(timeout = 10000) {
    return new Promise((resolve) => {
      if (window.googleTranslateReady) {
        console.log('✅ [LangManager] Google Translate already ready');
        resolve();
        return;
      }

      const timeoutId = setTimeout(() => {
        console.warn('⚠️ [LangManager] Google Translate timeout');
        resolve(); // Continue anyway
      }, timeout);

      window.addEventListener('googleTranslateReady', () => {
        clearTimeout(timeoutId);
        this.googleTranslateReady = true;
        console.log('✅ [LangManager] Google Translate ready event received');
        resolve();
      }, { once: true });
    });
  }

  /**
   * Initialize desktop language selector
   */
  initDesktopLanguageSelector() {
    const langBtn = document.getElementById('langBtn');
    const langMenu = document.getElementById('langMenu');
    const langFlag = document.getElementById('langFlag');

    if (!langBtn || !langMenu || !langFlag) {
      console.warn('⚠️ [LangManager] Desktop elements not found');
      return;
    }

    console.log('✅ [LangManager] Desktop selector found');

    let isOpen = false;

    // Toggle menu
    langBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      isOpen = !isOpen;
      langMenu.classList.toggle('hidden', !isOpen);
      langBtn.setAttribute('aria-expanded', isOpen);
    });

    // Select language
    langMenu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const lang = li.getAttribute('data-lang');
      const flag = li.getAttribute('data-flag');

      if (lang && flag) {
        console.log('🌐 [LangManager] Language selected:', lang);
        langFlag.src = flag;
        this.setLanguage(lang, flag);
        langMenu.classList.add('hidden');
        isOpen = false;
      }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (isOpen && !langBtn.contains(e.target) && !langMenu.contains(e.target)) {
        langMenu.classList.add('hidden');
        isOpen = false;
        langBtn.setAttribute('aria-expanded', 'false');
      }
    });

    // Restore saved language
    langFlag.src = this.selectedFlag;
  }

  /**
   * Initialize mobile language selector
   */
  initMobileLanguageSelector() {
    const checkbox = document.getElementById('langOpen');
    const menu = document.getElementById('languageMenu');
    const flag = document.getElementById('languageFlag');
    const label = document.getElementById('languageLabel');

    if (!checkbox || !menu || !flag || !label) {
      console.warn('⚠️ [LangManager] Mobile elements not found');
      return;
    }

    console.log('✅ [LangManager] Mobile selector found');

    const langNames = {
      en: 'English',
      fr: 'Français',
      de: 'Deutsch'
    };

    // Handle language selection
    menu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const code = li.dataset.lang;
      const flagUrl = li.dataset.flag;
      const name = langNames[code] || code;

      console.log('🌐 [LangManager] Mobile language selected:', code);

      // Update UI
      flag.src = flagUrl;
      label.textContent = name;

      // Save and apply
      this.setLanguage(code, flagUrl);

      // Close menu
      checkbox.checked = false;
    });

    // Restore saved language
    flag.src = this.selectedFlag;
    label.textContent = langNames[this.selectedLang] || 'Language';
  }

  /**
   * Set language and reload page
   */
  setLanguage(lang, flag) {
    console.log('🔄 [LangManager] Changing language to:', lang);

    // Update storage
    localStorage.setItem('ulixai_lang', lang);
    localStorage.setItem('ulixai_flag', flag);

    // Update cookies for Google Translate
    this.setCookiesForLanguage(lang);

    // Reload page to apply
    console.log('🔄 [LangManager] Reloading page...');
    
    // Small delay to ensure cookies are set
    setTimeout(() => {
      window.location.reload();
    }, 100);
  }

  /**
   * Set cookies for Google Translate
   */
  setCookiesForLanguage(lang) {
    const expires = new Date(Date.now() + 365 * 864e5).toUTCString();
    
    if (lang === 'en') {
      // Clear cookies for English
      document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    } else {
      // Set cookies for other languages
      const val = `/auto/${lang}`;
      document.cookie = `googtrans=${val}; expires=${expires}; path=/`;
      document.cookie = `googtransopt=${val}; expires=${expires}; path=/`;
    }

    console.log('✅ [LangManager] Cookies set for language:', lang);
  }
}

/**
 * Initialize and expose globally
 */
export function initializeLanguageManager() {
  console.log('🚀 [LangManager] Starting initialization...');
  
  const languageManager = new LanguageManager();
  languageManager.init();

  // Expose globally for debugging
  window.ulixaiLanguageManager = languageManager;

  return languageManager;
}