/**
 * Language Manager - Gestion langue desktop + mobile
 * FIXED: Initialisation améliorée avec attente du DOM
 */

export class LanguageManager {
  constructor() {
    this.selectedLang = 'en';
    this.selectedFlag = 'https://flagcdn.com/24x18/us.png';
    this.googleTranslateReady = false;
  }

  init() {
    console.log('🌐 Language Manager init() called');
    
    // Fonction d'initialisation
    const initialize = () => {
      console.log('🔄 Attempting to initialize language selectors...');
      this.initDesktopLanguageSelector();
      this.initMobileLanguageSelector();
      this.initGoogleTranslate();
    };
    
    // Attendre que le DOM soit vraiment prêt
    if (document.readyState === 'loading') {
      console.log('⏳ DOM is loading, waiting for DOMContentLoaded...');
      document.addEventListener('DOMContentLoaded', () => {
        console.log('✅ DOMContentLoaded fired');
        // Double sécurité : attendre encore 100ms après DOMContentLoaded
        setTimeout(initialize, 100);
      });
    } else {
      console.log('✅ DOM already loaded');
      // Si DOM déjà chargé, attendre quand même 100ms pour être sûr
      setTimeout(initialize, 100);
    }
  }

  domains() {
    const host = location.hostname;
    const naked = host.replace(/^www\./, '');
    const list = [undefined];
    if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) list.push(naked);
    if (naked !== host) list.push(host);
    return list;
  }

  setCookie(name, value, days = 365) {
    const exp = new Date(Date.now() + days * 864e5).toUTCString();
    this.domains().forEach(d => {
      document.cookie = `${name}=${value}; expires=${exp}; path=/` + (d ? `; domain=${d}` : '');
    });
  }

  clearCookie(name) {
    const past = 'Thu, 01 Jan 1970 00:00:01 GMT';
    this.domains().forEach(d => {
      document.cookie = `${name}=; expires=${past}; path=/` + (d ? `; domain=${d}` : '');
    });
  }

  alignCookiesFor(lang) {
    if (!lang || lang === 'en') {
      this.clearCookie('googtrans');
      this.clearCookie('googtransopt');
    } else {
      const val = `/auto/${lang}`;
      this.setCookie('googtrans', val);
      this.setCookie('googtransopt', val);
    }
  }

  initDesktopLanguageSelector() {
    console.log('🖥️ Initializing desktop language selector...');
    
    // Retry mechanism si éléments pas trouvés
    let retryCount = 0;
    const maxRetries = 5;
    
    const attemptInit = () => {
      const langBtn = document.getElementById('langBtn');
      const langMenu = document.getElementById('langMenu');
      const langFlag = document.getElementById('langFlag');

      if (!langBtn || !langMenu || !langFlag) {
        retryCount++;
        console.warn(`⚠️ Desktop language selector elements not found (attempt ${retryCount}/${maxRetries}):`, {
          langBtn: !!langBtn,
          langMenu: !!langMenu,
          langFlag: !!langFlag
        });
        
        if (retryCount < maxRetries) {
          setTimeout(attemptInit, 200);
        } else {
          console.error('❌ Failed to initialize desktop language selector after', maxRetries, 'attempts');
        }
        return;
      }

      console.log('✅ Desktop language elements found');

      // ⚡ Utiliser event delegation sur document pour éviter conflits avec Alpine.js
      let isOpen = false;

      // Event delegation sur le document entier (capture phase)
      document.addEventListener('click', (e) => {
        // Clic sur le bouton de langue
        if (e.target.closest('#langBtn')) {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          
          console.log('🖱️ Language button clicked (delegated)');
          
          isOpen = !isOpen;
          if (isOpen) {
            langMenu.classList.remove('hidden');
          } else {
            langMenu.classList.add('hidden');
          }
          return false;
        }
        
        // Clic sur un élément de langue
        const langItem = e.target.closest('#langMenu li[data-lang]');
        if (langItem) {
          e.preventDefault();
          e.stopPropagation();
          
          const lang = langItem.getAttribute('data-lang');
          const flag = langItem.getAttribute('data-flag');
          
          if (lang && flag) {
            console.log('🌐 Desktop language selected:', lang);
            langFlag.src = flag;
            this.setLanguage(lang, flag);
            langMenu.classList.add('hidden');
            isOpen = false;
          }
          return false;
        }
        
        // Fermer si clic en dehors
        if (isOpen && !e.target.closest('#langMenu')) {
          langMenu.classList.add('hidden');
          isOpen = false;
        }
      }, true); // ⚡ IMPORTANT: true = capture phase (avant Alpine.js)

      // Restore saved language
      const savedLang = localStorage.getItem('selectedLang') || 'en';
      const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
      langFlag.src = savedFlag;
      this.alignCookiesFor(savedLang);

      if (savedLang !== 'en') {
        window.location.hash = 'googtrans(en|' + savedLang + ')';
      }

      console.log('✅ Desktop language selector initialized with event delegation');
    };
    
    // Démarrer la tentative
    attemptInit();
  }

  initMobileLanguageSelector() {
    console.log('📱 Initializing mobile language selector...');
    
    const checkbox = document.getElementById('langOpen');
    const menu = document.getElementById('languageMenu');
    const flag = document.getElementById('languageFlag');
    const label = document.getElementById('languageLabel');

    if (!checkbox || !menu || !flag || !label) {
      console.warn('⚠️ Mobile language selector elements not found:', {
        checkbox: !!checkbox,
        menu: !!menu,
        flag: !!flag,
        label: !!label
      });
      return;
    }

    console.log('✅ Mobile language elements found');

    // Handle language selection
    menu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const code = li.dataset.lang;
      const flagUrl = li.dataset.flag;
      const name = li.textContent.trim();

      console.log('🌐 Mobile language selected:', code);

      // Update UI
      flag.src = flagUrl;
      label.textContent = name;

      // Save to localStorage
      localStorage.setItem('selectedLang', code);
      localStorage.setItem('selectedFlag', flagUrl);

      // Update cookies
      this.alignCookiesFor(code);

      // Apply language change
      this.setLanguage(code, flagUrl);

      // Close menu
      checkbox.checked = false;
    });

    // Restore saved language
    const savedLang = localStorage.getItem('selectedLang') || 'en';
    const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
    const langNames = { en: 'English', fr: 'Français', de: 'Deutsch' };

    flag.src = savedFlag;
    label.textContent = langNames[savedLang] || 'Language';
    this.alignCookiesFor(savedLang);

    if (savedLang !== 'en') {
      window.location.hash = 'googtrans(en|' + savedLang + ')';
    }

    console.log('✅ Mobile language selector initialized');
  }

  setLanguage(lang, flag) {
    console.log('🔄 Changing language to:', lang);

    // Update storage
    localStorage.setItem('selectedLang', lang);
    localStorage.setItem('selectedFlag', flag);

    // Update cookies
    this.alignCookiesFor(lang);

    // Update hash
    if (lang === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = 'googtrans(en|' + lang + ')';
    }

    // Wait for Google Translate then reload
    this.waitForGoogleTranslate(() => {
      console.log('✅ Google Translate ready, triggering change');
      
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select) {
        select.value = lang;
        select.dispatchEvent(new Event('change', { bubbles: true }));
      }
      
      setTimeout(() => {
        console.log('🔄 Reloading page...');
        location.reload();
      }, 100);
    });
  }

  waitForGoogleTranslate(callback, timeout = 5000) {
    const startTime = Date.now();
    
    const check = () => {
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      
      if (select) {
        console.log('✅ Google Translate widget found');
        callback();
        return;
      }

      if (Date.now() - startTime < timeout) {
        setTimeout(check, 100);
      } else {
        console.warn('⚠️ Google Translate timeout, reloading anyway');
        callback();
      }
    };

    check();
  }

  initGoogleTranslate() {
    console.log('🌐 Initializing Google Translate...');

    // Define the callback for Google Translate
    window.googleTranslateElementInit = () => {
      console.log('✅ Google Translate callback triggered');
      
      try {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,fr,de',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
          autoDisplay: false
        }, 'google_translate_element');
        
        this.googleTranslateReady = true;
        console.log('✅ Google Translate initialized successfully');
      } catch (error) {
        console.error('❌ Google Translate initialization failed:', error);
      }
    };

    // If Google Translate script is already loaded, initialize immediately
    if (typeof google !== 'undefined' && google.translate) {
      console.log('🔄 Google Translate already loaded, initializing now');
      window.googleTranslateElementInit();
    }
  }
}

export function initializeLanguageManager() {
  console.log('🚀 Starting Language Manager...');
  const languageManager = new LanguageManager();

  // Toujours appeler init(), qui gère lui-même l'attente du DOM
  languageManager.init();

  // ⚡ EXPOSER GLOBALEMENT
  window.providerLanguageManager = languageManager;

  return languageManager;
}