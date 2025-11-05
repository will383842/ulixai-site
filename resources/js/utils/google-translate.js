/**
 * Google Translate Manager
 * Centralise toute la logique de traduction (élimine les duplications)
 */

import { CookieManager } from './cookie-manager.js';

export class GoogleTranslateManager {
  constructor() {
    this.currentLang = 'en';
    this.pendingLang = null;
    this.initTimeout = 12000; // 12s timeout for widget init
    
    this.langMap = {
      en: { name: 'English', flag: 'https://flagcdn.com/24x18/us.png' },
      fr: { name: 'Français', flag: 'https://flagcdn.com/24x18/fr.png' },
      de: { name: 'Deutsch', flag: 'https://flagcdn.com/24x18/de.png' }
    };
  }

  /**
   * Initialize Google Translate
   */
  init() {
    // Load saved language
    const savedLang = localStorage.getItem('selectedLang') || 'en';
    const savedFlag = localStorage.getItem('selectedFlag') || this.langMap.en.flag;
    
    this.currentLang = savedLang;
    this.updateUI(savedLang, savedFlag);
    this.alignCookies(savedLang);
    
    if (savedLang !== 'en') {
      window.location.hash = `googtrans(en|${savedLang})`;
    }
    
    // Remove Google Translate UI elements
    this.removeGoogleUI();
    
    // Poll for widget initialization
    this.waitForWidget();
  }

  /**
   * Align cookies for language
   * @param {string} lang - Language code
   */
  alignCookies(lang) {
    if (!lang || lang === 'en') {
      CookieManager.clear('googtrans');
      CookieManager.clear('googtransopt');
    } else {
      const val = `/auto/${lang}`;
      CookieManager.set('googtrans', val);
      CookieManager.set('googtransopt', val);
    }
  }

  /**
   * Change language
   * @param {string} lang - Language code
   */
  changeLanguage(lang) {
    if (!this.langMap[lang]) {
      console.warn(`Language ${lang} not supported`);
      return;
    }

    const { name, flag } = this.langMap[lang];
    
    // Save to localStorage
    localStorage.setItem('selectedLang', lang);
    localStorage.setItem('selectedFlag', flag);
    
    // Update UI
    this.updateUI(lang, flag);
    
    // Align cookies
    this.alignCookies(lang);
    
    // Update hash
    if (lang === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = `googtrans(en|${lang})`;
    }
    
    // Apply to widget
    const select = this.getWidget();
    if (select) {
      select.value = lang;
      select.dispatchEvent(new Event('change'));
      setTimeout(() => location.reload(), 100);
    } else {
      // Widget not ready, wait for it
      this.pendingLang = lang;
      this.waitForWidget(() => {
        const widget = this.getWidget();
        if (widget) {
          widget.value = lang;
          widget.dispatchEvent(new Event('change'));
          setTimeout(() => location.reload(), 100);
        }
      });
    }
  }

  /**
   * Get Google Translate widget select element
   * @returns {HTMLSelectElement|null}
   */
  getWidget() {
    return document.querySelector('#google_translate_element select.goog-te-combo');
  }

  /**
   * Wait for Google Translate widget to load
   * @param {Function} callback - Callback when widget is ready
   */
  waitForWidget(callback) {
    const start = Date.now();
    
    const check = () => {
      const widget = this.getWidget();
      
      if (widget) {
        if (this.pendingLang) {
          widget.value = this.pendingLang;
          widget.dispatchEvent(new Event('change'));
          this.pendingLang = null;
        }
        
        if (callback) callback();
        return;
      }
      
      if (Date.now() - start < this.initTimeout) {
        setTimeout(check, 200);
      }
    };
    
    check();
  }

  /**
   * Update UI elements with language
   * @param {string} lang - Language code
   * @param {string} flag - Flag URL
   */
  updateUI(lang, flag) {
    // Desktop flag
    const desktopFlag = document.getElementById('langFlag');
    if (desktopFlag) desktopFlag.src = flag;
    
    // Mobile flag
    const mobileFlag = document.getElementById('languageFlag');
    if (mobileFlag) mobileFlag.src = flag;
    
    // Mobile label
    const mobileLabel = document.getElementById('languageLabel');
    if (mobileLabel && this.langMap[lang]) {
      mobileLabel.textContent = this.langMap[lang].name;
    }
  }

  /**
   * Remove Google Translate UI pollution
   */
  removeGoogleUI() {
    const cleanup = () => {
      // Remove banner iframe
      const banner = document.querySelector('iframe.goog-te-banner-frame');
      if (banner && banner.parentNode) {
        banner.parentNode.removeChild(banner);
      }

      // Hide skiptranslate wrapper
      const wrapper = document.querySelector('body > .skiptranslate');
      if (wrapper) {
        wrapper.style.display = 'none';
        wrapper.style.height = '0px';
        wrapper.style.overflow = 'hidden';
      }

      // Reset body/html styles
      document.documentElement.style.marginTop = '0px';
      document.body.style.top = '0px';
      document.body.style.position = 'static';
    };

    // Initial cleanup
    cleanup();

    // Repeated cleanup (Google re-injects)
    let count = 0;
    const interval = setInterval(() => {
      cleanup();
      if (++count > 20) clearInterval(interval);
    }, 200);

    // Cleanup on resize
    window.addEventListener('resize', cleanup);
  }

  /**
   * Setup language selector listeners
   * @param {string} menuId - Language menu element ID
   */
  setupListeners(menuId) {
    const menu = document.getElementById(menuId);
    if (!menu) return;

    menu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const lang = li.getAttribute('data-lang');
      this.changeLanguage(lang);

      // Close menu
      const checkbox = document.getElementById('langOpen');
      if (checkbox) checkbox.checked = false;
      
      menu.classList.add('hidden');
    });
  }
}

// Global init function for Google Translate widget
window.googleTranslateElementInit = function() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,fr,de',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay: false
  }, 'google_translate_element');
};