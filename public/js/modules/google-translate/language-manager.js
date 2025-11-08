/**
 * Language Manager
 * Handles language selector UI and user interactions
 * 
 * @module google-translate/language-manager
 */

export class LanguageManager {
  constructor() {
    this.selectedLang = localStorage.getItem('ulixai_lang') || 'en';
    this.selectedFlag = localStorage.getItem('ulixai_flag') || 'https://flagcdn.com/24x18/us.png';
  }

  /**
   * Initialize language manager
   */
  async init() {
    console.log('🌐 [LangManager] Initializing UI...');

    await this.waitForDOM();

    this.initDesktopLanguageSelector();
    this.initMobileLanguageSelector();

    console.log('✅ [LangManager] UI initialized');
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
   * Initialize desktop language selector
   */
  initDesktopLanguageSelector() {
    const langBtn = document.getElementById('langBtn');
    const langMenu = document.getElementById('langMenu');
    const langFlag = document.getElementById('langFlag');
    const langChevron = document.getElementById('langChevron');

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
      
      // Rotate chevron
      if (langChevron) {
        langChevron.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
      }
    });

    // Select language
    langMenu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const lang = li.getAttribute('data-lang');
      const flag = li.getAttribute('data-flag');

      if (lang && flag) {
        console.log('🌐 [LangManager] Desktop language selected:', lang);
        
        // Update flag
        langFlag.src = flag;
        
        // Save to localStorage
        localStorage.setItem('selectedFlag', flag);
        
        // Close menu
        langMenu.classList.add('hidden');
        isOpen = false;
        langBtn.setAttribute('aria-expanded', 'false');
        if (langChevron) {
          langChevron.style.transform = 'rotate(0deg)';
        }
        
        // Apply language
        this.setLanguage(lang, flag);
      }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (isOpen && !langBtn.contains(e.target) && !langMenu.contains(e.target)) {
        langMenu.classList.add('hidden');
        isOpen = false;
        langBtn.setAttribute('aria-expanded', 'false');
        if (langChevron) {
          langChevron.style.transform = 'rotate(0deg)';
        }
      }
    });

    // Restore saved flag
    const savedFlag = localStorage.getItem('selectedFlag');
    if (savedFlag) {
      langFlag.src = savedFlag;
    }
  }

  /**
   * Initialize mobile language selector
   */
  initMobileLanguageSelector() {
    const modalBtn = document.getElementById('mobileLangBtn');
    const modal = document.getElementById('mobileLangModal');
    const sheet = document.getElementById('mobileLangSheet');
    const overlay = document.getElementById('mobileLangOverlay');
    const closeBtn = document.getElementById('mobileLangCloseBtn');
    const flag = document.getElementById('mobileLangFlag');
    const label = document.getElementById('mobileLangLabel');

    if (!modalBtn || !modal || !flag || !label) {
      console.warn('⚠️ [LangManager] Mobile elements not found');
      console.log('🔍 [LangManager] Missing elements:', {
        modalBtn: !!modalBtn,
        modal: !!modal,
        flag: !!flag,
        label: !!label
      });
      return;
    }

    console.log('✅ [LangManager] Mobile selector found');

    const langNames = {
      en: 'English',
      fr: 'Français',
      de: 'Deutsch',
      ru: 'Русский',
      'zh-CN': '中文',
      es: 'Español',
      pt: 'Português',
      ar: 'العربية',
      hi: 'हिन्दी'
    };

    // Open modal
    const openModal = () => {
      if (!modal || !sheet || !overlay) return;
      
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      
      setTimeout(() => {
        overlay.classList.remove('opacity-0');
        overlay.classList.add('opacity-100');
        sheet.classList.remove('translate-y-full');
        sheet.classList.add('translate-y-0');
      }, 10);
      
      console.log('✅ [LangManager] Mobile modal opened');
    };

    // Close modal
    const closeModal = () => {
      if (!modal || !sheet || !overlay) return;
      
      overlay.classList.remove('opacity-100');
      overlay.classList.add('opacity-0');
      sheet.classList.remove('translate-y-0');
      sheet.classList.add('translate-y-full');
      
      setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
      }, 400);
      
      console.log('✅ [LangManager] Mobile modal closed');
    };

    // Button click to open
    modalBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      openModal();
    });

    // Close button
    if (closeBtn) {
      closeBtn.addEventListener('click', closeModal);
    }

    // Overlay click to close
    if (overlay) {
      overlay.addEventListener('click', closeModal);
    }

    // Language selection
    const langOptions = document.querySelectorAll('.lang-option');
    
    if (langOptions.length === 0) {
      console.warn('⚠️ [LangManager] No .lang-option elements found');
      return;
    }

    console.log(`✅ [LangManager] Found ${langOptions.length} language options`);

    langOptions.forEach((option) => {
      option.addEventListener('click', (e) => {
        e.stopPropagation();
        
        const code = option.getAttribute('data-lang');
        const flagUrl = option.getAttribute('data-flag');
        const labelText = option.getAttribute('data-label');

        console.log('🌐 [LangManager] Mobile language selected:', code);

        // Update UI
        if (flag) flag.src = flagUrl;
        if (label) label.textContent = labelText;

        // Save preferences
        localStorage.setItem('selectedLabel', labelText);
        localStorage.setItem('selectedFlag', flagUrl);

        // Visual feedback
        langOptions.forEach(opt => {
          opt.classList.remove('bg-blue-100', 'border-blue-300');
        });
        option.classList.add('bg-blue-100', 'border-blue-300');

        // Close modal after short delay
        setTimeout(() => {
          closeModal();
          // Apply language
          this.setLanguage(code, flagUrl);
        }, 300);
      });
    });

    // Restore saved language
    const savedLabel = localStorage.getItem('selectedLabel');
    const savedFlag = localStorage.getItem('selectedFlag');
    
    if (savedLabel && label) {
      label.textContent = savedLabel;
    } else {
      label.textContent = langNames[this.selectedLang] || 'English';
    }
    
    if (savedFlag && flag) {
      flag.src = savedFlag;
    }
    
    console.log('✅ [LangManager] Mobile UI restored');
  }

  /**
   * Set language and reload page
   */
  setLanguage(lang, flag) {
    console.log('🔄 [LangManager] Changing language to:', lang);

    // Update storage
    localStorage.setItem('ulixai_lang', lang);
    localStorage.setItem('ulixai_flag', flag);

    // Set cookies for Google Translate
    this.setCookiesForLanguage(lang);

    // Reload page to apply translation
    console.log('🔄 [LangManager] Reloading page...');
    
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
      console.log('🗑️ [LangManager] Cookies cleared for English');
    } else {
      // Set cookies for other languages
      const val = `/en/${lang}`;
      document.cookie = `googtrans=${val}; expires=${expires}; path=/`;
      document.cookie = `googtransopt=${val}; expires=${expires}; path=/`;
      console.log('✅ [LangManager] Cookies set:', val);
    }
  }
}

/**
 * Initialize language manager (convenience function)
 */
export function initializeLanguageManager() {
  console.log('🚀 [LangManager] Starting initialization...');
  
  const languageManager = new LanguageManager();
  languageManager.init();

  // Expose globally for debugging
  window.providerLanguageManager = languageManager;

  return languageManager;
}