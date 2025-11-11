/**
 * Language Manager
 * Handles language selector UI and user interactions
 * 
 * @module google-translate/language-manager
 */

export class LanguageManager {
  constructor() {
    // Configuration stricte des langues - CHEMINS ABSOLUS AVEC SLASH INITIAL
    this.languages = {
      'en': {
        code: 'en',
        label: 'English',
        flag: '/images/flags/us.svg',  // ✅ Slash initial ajouté
        country: 'United States'
      },
      'fr': {
        code: 'fr',
        label: 'Français',
        flag: '/images/flags/fr.svg',  // ✅ Slash initial ajouté
        country: 'France'
      },
      'de': {
        code: 'de',
        label: 'Deutsch',
        flag: '/images/flags/de.svg',  // ✅ Slash initial ajouté
        country: 'Deutschland'
      },
      'ru': {
        code: 'ru',
        label: 'Русский',
        flag: '/images/flags/ru.svg',  // ✅ Slash initial ajouté
        country: 'Россия'
      },
      'zh-CN': {
        code: 'zh-CN',
        label: '中文',
        flag: '/images/flags/cn.svg',  // ✅ Slash initial ajouté
        country: '中国'
      },
      'es': {
        code: 'es',
        label: 'Español',
        flag: '/images/flags/es.svg',  // ✅ Slash initial ajouté
        country: 'España'
      },
      'pt': {
        code: 'pt',
        label: 'Português',
        flag: '/images/flags/pt.svg',  // ✅ Slash initial ajouté
        country: 'Portugal'
      },
      'ar': {
        code: 'ar',
        label: 'العربية',
        flag: '/images/flags/sa.svg',  // ✅ Slash initial ajouté
        country: 'السعودية'
      },
      'hi': {
        code: 'hi',
        label: 'हिन्दी',
        flag: '/images/flags/in.svg',  // ✅ Slash initial ajouté
        country: 'भारत'
      }
    };

    // Récupérer la langue stockée (SEULE SOURCE DE VÉRITÉ)
    this.selectedLang = localStorage.getItem('ulixai_lang') || 'en';
    
    // TOUJOURS recalculer le drapeau et le label depuis la langue
    const langConfig = this.languages[this.selectedLang];
    if (langConfig) {
      this.selectedFlag = langConfig.flag;
      this.selectedLabel = langConfig.label;
    } else {
      // Fallback si langue invalide
      this.selectedLang = 'en';
      this.selectedFlag = this.languages['en'].flag;
      this.selectedLabel = this.languages['en'].label;
    }
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

      const langCode = li.getAttribute('data-lang');

      if (langCode && this.languages[langCode]) {
        console.log('🌐 [LangManager] Desktop language selected:', langCode);
        
        const langConfig = this.languages[langCode];
        
        // Update flag immédiatement
        langFlag.src = langConfig.flag;
        
        // Close menu
        langMenu.classList.add('hidden');
        isOpen = false;
        langBtn.setAttribute('aria-expanded', 'false');
        if (langChevron) {
          langChevron.style.transform = 'rotate(0deg)';
        }
        
        // Apply language
        this.setLanguage(langCode);
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
    langFlag.src = this.selectedFlag;
    
    console.log('🔍 [LangManager] Desktop restored:', {
      lang: this.selectedLang,
      flag: this.selectedFlag
    });
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
        
        const langCode = option.getAttribute('data-lang');

        if (langCode && this.languages[langCode]) {
          console.log('🌐 [LangManager] Mobile language selected:', langCode);

          const langConfig = this.languages[langCode];

          // Update UI immédiatement
          if (flag) flag.src = langConfig.flag;
          if (label) label.textContent = langConfig.label;

          // Visual feedback
          langOptions.forEach(opt => {
            opt.classList.remove('bg-blue-100', 'border-blue-300');
          });
          option.classList.add('bg-blue-100', 'border-blue-300');

          // Close modal after short delay
          setTimeout(() => {
            closeModal();
            // Apply language
            this.setLanguage(langCode);
          }, 300);
        }
      });
    });

    // Restore saved language (DEPUIS LA CONFIG)
    flag.src = this.selectedFlag;
    label.textContent = this.selectedLabel;
    
    console.log('🔍 [LangManager] Mobile restored:', {
      lang: this.selectedLang,
      flag: this.selectedFlag,
      label: this.selectedLabel
    });
  }

  /**
   * Set language and reload page
   */
  setLanguage(langCode) {
    console.log('🔄 [LangManager] Changing language to:', langCode);

    // Validation
    if (!this.languages[langCode]) {
      console.error('❌ [LangManager] Invalid language code:', langCode);
      return;
    }

    const langConfig = this.languages[langCode];

    // Update storage (SEULEMENT le code langue)
    localStorage.setItem('ulixai_lang', langCode);

    // SUPPRIMER les anciennes clés pour éviter les conflits
    localStorage.removeItem('selectedFlag');
    localStorage.removeItem('selectedLabel');
    localStorage.removeItem('ulixai_flag');

    // Set cookies for Google Translate
    this.setCookiesForLanguage(langCode);

    // Set hash for immediate translation
    window.location.hash = langCode === 'en' ? '' : `#googtrans(en|${langCode})`;

    // Reload page to apply translation
    console.log('🔄 [LangManager] Reloading page...');
    console.log('🔍 [LangManager] New config:', {
      code: langCode,
      label: langConfig.label,
      flag: langConfig.flag
    });
    
    setTimeout(() => {
      window.location.reload();
    }, 200);
  }

  /**
   * Set cookies for Google Translate
   */
  setCookiesForLanguage(langCode) {
    const expires = new Date(Date.now() + 365 * 864e5).toUTCString();
    
    if (langCode === 'en') {
      // Clear cookies for English
      document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      console.log('🗑️ [LangManager] Cookies cleared for English');
    } else {
      // Set cookies for other languages
      const val = `/en/${langCode}`;
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