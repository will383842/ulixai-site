/**
 * Language Manager
 * Handles language selector UI and user interactions
 * 
 * @module google-translate/language-manager
 */

export class LanguageManager {
  constructor() {
    // Configuration stricte des langues
    this.languages = {
      'en': {
        code: 'en',
        label: 'English',
        flag: 'images/flags/us.svg',
        country: 'United States'
      },
      'fr': {
        code: 'fr',
        label: 'Français',
        flag: 'images/flags/fr.svg',
        country: 'France'
      },
      'de': {
        code: 'de',
        label: 'Deutsch',
        flag: 'images/flags/de.svg',
        country: 'Deutschland'
      },
      'ru': {
        code: 'ru',
        label: 'Русский',
        flag: 'images/flags/ru.svg',
        country: 'Россия'
      },
      'zh-CN': {
        code: 'zh-CN',
        label: '中文',
        flag: 'images/flags/cn.svg',
        country: '中国'
      },
      'es': {
        code: 'es',
        label: 'Español',
        flag: 'images/flags/es.svg',
        country: 'España'
      },
      'pt': {
        code: 'pt',
        label: 'Português',
        flag: 'images/flags/pt.svg',
        country: 'Portugal'
      },
      'ar': {
        code: 'ar',
        label: 'العربية',
        flag: 'images/flags/sa.svg',
        country: 'السعودية'
      },
      'hi': {
        code: 'hi',
        label: 'हिन्दी',
        flag: 'images/flags/in.svg',
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
    
    // 🆕 Exposer la fonction de retraduction globalement
    window.forceTranslateDynamicContent = () => this.forceTranslateDynamicContent();

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

  /**
   * Force Google Translate to re-translate dynamic content
   * Call this after injecting new content into the DOM
   * 
   * ✅ MÉTHODE DOCUMENTÉE QUI FONCTIONNE
   */
  forceTranslateDynamicContent() {
    console.log('🔄 [LangManager] Forcing translation of dynamic content...');
    
    try {
      const currentLang = localStorage.getItem('ulixai_lang') || 'en';
      
      // Si la langue est l'anglais, pas besoin de traduire
      if (currentLang === 'en') {
        console.log('ℹ️ [LangManager] Current language is English, no translation needed');
        return;
      }
      
      // Marquer tous les nouveaux éléments pour traduction
      const selectors = [
        '[translate="yes"]',
        '.language-card',
        '.service-card',
        '.category-card',
        '.service-name',
        '.language-name',
        '.category-text',
        '.subcat-chip',
        '.service-section h4',
        '.service-section-header'
      ];
      
      const elements = document.querySelectorAll(selectors.join(', '));
      console.log(`🔍 [LangManager] Found ${elements.length} elements to translate`);
      
      // S'assurer que les éléments sont marqués correctement
      elements.forEach(element => {
        element.classList.remove('notranslate');
        element.setAttribute('translate', 'yes');
      });
      
      // ✅ LA MÉTHODE QUI FONCTIONNE : Forcer le widget Google Translate à re-traduire
      // en changeant la valeur du select et en déclenchant l'événement 'change'
      const restoreGoogleTranslate = () => {
        const googleTranslateCombo = document.querySelector('.goog-te-combo');
        
        if (googleTranslateCombo) {
          // Si la langue actuelle est différente de celle stockée, on force le changement
          if (googleTranslateCombo.value !== currentLang) {
            console.log('🔄 [LangManager] Setting Google Translate combo to:', currentLang);
            googleTranslateCombo.value = currentLang;
            googleTranslateCombo.dispatchEvent(new Event('change'));
            console.log('✅ [LangManager] Google Translate widget triggered');
          } else {
            // Sinon, on force quand même une re-traduction en réinitialisant
            console.log('🔄 [LangManager] Forcing re-translation (same language)');
            googleTranslateCombo.value = 'en'; // Reset to English
            googleTranslateCombo.dispatchEvent(new Event('change'));
            
            setTimeout(() => {
              googleTranslateCombo.value = currentLang; // Back to target language
              googleTranslateCombo.dispatchEvent(new Event('change'));
              console.log('✅ [LangManager] Google Translate widget re-triggered');
            }, 50);
          }
        } else {
          console.warn('⚠️ [LangManager] Google Translate combo not found');
          
          // Fallback : Re-appliquer le hash et forcer un refresh du DOM
          window.location.hash = `#googtrans(en|${currentLang})`;
          
          setTimeout(() => {
            elements.forEach(element => {
              if (element.parentNode) {
                const parent = element.parentNode;
                const next = element.nextSibling;
                parent.removeChild(element);
                parent.insertBefore(element, next);
              }
            });
            console.log('🔄 [LangManager] DOM elements re-inserted as fallback');
          }, 100);
        }
      };
      
      // Attendre un peu que Google Translate soit prêt
      if (window.google?.translate?.TranslateElement) {
        setTimeout(restoreGoogleTranslate, 150);
      } else {
        // Si Google Translate n'est pas encore chargé, attendre l'événement
        window.addEventListener('googleTranslateReady', () => {
          setTimeout(restoreGoogleTranslate, 150);
        }, { once: true });
      }
      
      console.log('✅ [LangManager] Dynamic content translation triggered');
    } catch (error) {
      console.error('❌ [LangManager] Error forcing translation:', error);
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