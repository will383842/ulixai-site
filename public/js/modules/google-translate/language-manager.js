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

    // 🆕 NETTOYER les anciennes clés conflictuelles
    this.cleanLegacyStorageKeys();

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
    
    console.log('🔍 [LangManager] Constructor initialized:', {
      selectedLang: this.selectedLang,
      selectedFlag: this.selectedFlag,
      selectedLabel: this.selectedLabel
    });
  }

  /**
   * Clean legacy storage keys that may conflict with current system
   */
  cleanLegacyStorageKeys() {
    const legacyKeys = [
      'selectedLanguage',    // Ancienne clé qui causait le conflit avec 'de'
      'selectedFlag',        // Ancienne clé pour le drapeau
      'selectedLabel',       // Ancienne clé pour le label
      'ulixai_flag',         // Autre ancienne clé
      'googtrans',           // Parfois stocké à tort dans localStorage
      'googtransopt'         // Idem
    ];
    
    let cleaned = 0;
    legacyKeys.forEach(key => {
      if (localStorage.getItem(key) !== null) {
        localStorage.removeItem(key);
        cleaned++;
        console.log(`🗑️ [LangManager] Removed legacy key: ${key}`);
      }
    });
    
    if (cleaned > 0) {
      console.log(`✅ [LangManager] Cleaned ${cleaned} legacy storage keys`);
    }
  }

  /**
   * Initialize language manager
   */
  async init() {
    console.log('🌐 [LangManager] Initializing UI...');

    await this.waitForDOM();

    // 🆕 Diagnostic complet au démarrage
    this.diagnoseLanguageSetup();

    this.initDesktopLanguageSelector();
    this.initMobileLanguageSelector();
    
    // 🆕 Exposer les fonctions de traduction globalement
    window.forceTranslateDynamicContent = () => this.forceTranslateDynamicContent();
    window.cleanGoogleTranslateMarkers = (container) => this.cleanGoogleTranslateMarkers(container);

    console.log('✅ [LangManager] UI initialized');
  }

  /**
   * Diagnose language setup (cookies, localStorage, hash)
   */
  diagnoseLanguageSetup() {
    const currentLang = this.selectedLang;
    
    console.group('🔍 [LangManager] Language Setup Diagnostic');
    
    // 1. Check localStorage
    const legacySelectedLanguage = localStorage.getItem('selectedLanguage');
    console.log('📦 LocalStorage:', {
      ulixai_lang: localStorage.getItem('ulixai_lang'),
      legacyKeys: {
        selectedLanguage: legacySelectedLanguage,
        selectedFlag: localStorage.getItem('selectedFlag'),
        selectedLabel: localStorage.getItem('selectedLabel')
      }
    });
    
    // 2. Check cookies
    const cookies = document.cookie.split(';').reduce((acc, cookie) => {
      const [key, value] = cookie.trim().split('=');
      if (key.includes('googtrans')) acc[key] = value;
      return acc;
    }, {});
    console.log('🍪 Google Translate Cookies:', cookies);
    
    // 3. Check hash
    console.log('🔗 Window Hash:', window.location.hash);
    
    // 4. Check expected values
    const expectedHash = currentLang === 'en' ? '' : `#googtrans(en|${currentLang})`;
    const expectedCookie = currentLang === 'en' ? 'N/A' : `/en/${currentLang}`;
    
    console.log('✅ Expected Values:', {
      hash: expectedHash,
      cookie: expectedCookie,
      currentLang: currentLang
    });
    
    // 5. CRITICAL: Detect language conflict
    if (legacySelectedLanguage && legacySelectedLanguage !== currentLang) {
      console.error('🚨 [LangManager] CONFLICT DETECTED!', {
        legacy: legacySelectedLanguage,
        current: currentLang
      });
      console.log('🔄 [LangManager] Forcing page reload to fix conflict...');
      
      // Clean legacy keys
      this.cleanLegacyStorageKeys();
      
      // Set correct cookies and hash
      this.setCookiesForLanguage(currentLang);
      window.location.hash = expectedHash;
      
      // Force reload after a short delay
      setTimeout(() => {
        window.location.reload();
      }, 100);
      
      return; // Stop here, reload will happen
    }
    
    // 6. Check if there are mismatches
    const hasCorrectHash = window.location.hash === expectedHash;
    const hasCorrectCookie = cookies['googtrans'] === expectedCookie || currentLang === 'en';
    
    if (!hasCorrectHash || !hasCorrectCookie) {
      console.warn('⚠️ [LangManager] Mismatch detected! Fixing...');
      this.setCookiesForLanguage(currentLang);
      window.location.hash = expectedHash;
      console.log('✅ [LangManager] Fixed cookies and hash');
    } else {
      console.log('✅ [LangManager] All language settings are correct');
    }
    
    console.groupEnd();
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
   * ✅ MÉTHODE ULTRA-AGRESSIVE - Manipulation directe du DOM
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
      
      if (elements.length === 0) {
        console.warn('⚠️ [LangManager] No elements found to translate');
        return;
      }
      
      // S'assurer que les éléments sont marqués correctement
      elements.forEach(element => {
        element.classList.remove('notranslate');
        element.setAttribute('translate', 'yes');
        // Forcer Google à voir le changement
        element.style.display = 'none';
      });
      
      // Forcer un reflow
      void document.body.offsetHeight;
      
      // Remettre les éléments visibles
      setTimeout(() => {
        elements.forEach(element => {
          element.style.display = '';
        });
        
        // ✅ MÉTHODE 1 : Forcer via le widget Google Translate
        const googleTranslateCombo = document.querySelector('.goog-te-combo');
        
        if (googleTranslateCombo) {
          console.log('🔄 [LangManager] Method 1: Using Google Translate widget');
          
          // Triple reset pour être SÛR que Google détecte le changement
          googleTranslateCombo.value = 'en';
          googleTranslateCombo.dispatchEvent(new Event('change', { bubbles: true }));
          
          setTimeout(() => {
            googleTranslateCombo.value = currentLang;
            googleTranslateCombo.dispatchEvent(new Event('change', { bubbles: true }));
            
            // Double check après 500ms
            setTimeout(() => {
              if (googleTranslateCombo.value !== currentLang) {
                googleTranslateCombo.value = currentLang;
                googleTranslateCombo.dispatchEvent(new Event('change', { bubbles: true }));
              }
            }, 500);
          }, 200);
          
          console.log('✅ [LangManager] Google Translate widget triggered');
        } else {
          console.warn('⚠️ [LangManager] Google Translate combo not found, using fallback');
          
          // ✅ MÉTHODE 2 : Manipulation DOM "nuclear option"
          this.forceTranslationViaDOM(elements, currentLang);
        }
        
      }, 50);
      
      console.log('✅ [LangManager] Dynamic content translation triggered');
    } catch (error) {
      console.error('❌ [LangManager] Error forcing translation:', error);
    }
  }

  /**
   * Fallback method: Force translation by DOM manipulation
   * Cette méthode retire puis remet les éléments dans le DOM
   */
  forceTranslationViaDOM(elements, targetLang) {
    console.log('🔄 [LangManager] Method 2: Using DOM manipulation');
    
    // Re-appliquer le hash
    window.location.hash = `#googtrans(en|${targetLang})`;
    
    // Manipuler le DOM pour forcer Google à re-scanner
    const manipulations = [];
    
    elements.forEach(element => {
      if (element.parentNode) {
        manipulations.push({
          element: element,
          parent: element.parentNode,
          nextSibling: element.nextSibling
        });
      }
    });
    
    // Retirer tous les éléments
    manipulations.forEach(m => {
      m.parent.removeChild(m.element);
    });
    
    // Attendre un frame
    requestAnimationFrame(() => {
      // Remettre tous les éléments
      manipulations.forEach(m => {
        m.parent.insertBefore(m.element, m.nextSibling);
      });
      
      console.log('✅ [LangManager] DOM manipulation complete');
      
      // Forcer un dernier reflow
      void document.body.offsetHeight;
    });
  }

  /**
   * Clean Google Translate markers from containers
   * Removes font tags and restores original structure
   */
  cleanGoogleTranslateMarkers(container) {
    if (!container) return;
    
    console.log('🧹 [LangManager] Cleaning Google Translate markers...');
    
    // Supprimer tous les <font> tags ajoutés par Google Translate
    const fonts = container.querySelectorAll('font');
    fonts.forEach(font => {
      const parent = font.parentNode;
      while (font.firstChild) {
        parent.insertBefore(font.firstChild, font);
      }
      parent.removeChild(font);
    });
    
    // Supprimer les spans avec des classes Google Translate
    const spans = container.querySelectorAll('span[class*="translated"]');
    spans.forEach(span => {
      if (span.className && span.className.includes('translated')) {
        const parent = span.parentNode;
        while (span.firstChild) {
          parent.insertBefore(span.firstChild, span);
        }
        parent.removeChild(span);
      }
    });
    
    console.log('✅ [LangManager] Google Translate markers cleaned');
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