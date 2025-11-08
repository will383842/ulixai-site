/**
 * Language Selector - Gestion de la traduction multilingue (Desktop + Mobile)
 * @module LanguageSelector
 */

export class LanguageSelector {
  constructor() {
    // Desktop elements
    this.desktopLangBtn = null;
    this.desktopLangMenu = null;
    this.desktopLangFlag = null;

    // Mobile elements
    this.mobileLangBtn = null;
    this.mobileLangModal = null;
    this.mobileLangSheet = null;
    this.mobileLangOverlay = null;
    this.mobileLangCloseBtn = null;
    this.mobileLangLabel = null;
    this.mobileLangFlag = null;

    // État
    this.currentLang = 'en';
  }

  /**
   * Initialise le sélecteur de langue
   */
  init() {
    console.log('🌐 [LanguageSelector] Initializing...');

    this.initDesktopElements();
    this.initMobileElements();

    if (!this.desktopLangBtn && !this.mobileLangBtn) {
      console.warn('⚠️ [LanguageSelector] No language selector found');
      return;
    }

    this.initDesktopSelector();
    this.initMobileSelector();
    this.initGoogleTranslate();

    console.log('✅ [LanguageSelector] Initialized successfully');
  }

  /**
   * Récupère les éléments desktop
   */
  initDesktopElements() {
    this.desktopLangBtn = document.getElementById('langBtn');
    this.desktopLangMenu = document.getElementById('langMenu');
    this.desktopLangFlag = document.getElementById('langFlag');
  }

  /**
   * Récupère les éléments mobile
   */
  initMobileElements() {
    this.mobileLangBtn = document.getElementById('mobileLangBtn');
    this.mobileLangModal = document.getElementById('mobileLangModal');
    this.mobileLangSheet = document.getElementById('mobileLangSheet');
    this.mobileLangOverlay = document.getElementById('mobileLangOverlay');
    this.mobileLangCloseBtn = document.getElementById('mobileLangCloseBtn');
    this.mobileLangLabel = document.getElementById('mobileLangLabel');
    this.mobileLangFlag = document.getElementById('mobileLangFlag');
  }

  /**
   * Initialise le sélecteur desktop
   */
  initDesktopSelector() {
    if (!this.desktopLangBtn || !this.desktopLangMenu) return;

    // Toggle dropdown
    this.desktopLangBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isHidden = this.desktopLangMenu.classList.contains('hidden');

      if (isHidden) {
        this.desktopLangMenu.classList.remove('hidden');
        this.desktopLangBtn.setAttribute('aria-expanded', 'true');
      } else {
        this.desktopLangMenu.classList.add('hidden');
        this.desktopLangBtn.setAttribute('aria-expanded', 'false');
      }
    });

    // Sélection d'une langue
    const langItems = this.desktopLangMenu.querySelectorAll('li[data-lang]');
    langItems.forEach((item) => {
      item.addEventListener('click', (e) => {
        e.stopPropagation();
        const lang = item.getAttribute('data-lang');
        const flag = item.getAttribute('data-flag');

        this.changeLanguage(lang, flag, 'desktop');
        this.desktopLangMenu.classList.add('hidden');
        this.desktopLangBtn.setAttribute('aria-expanded', 'false');
      });
    });

    // Fermer en cliquant ailleurs
    document.addEventListener('click', (e) => {
      if (
        this.desktopLangBtn &&
        !this.desktopLangBtn.contains(e.target) &&
        this.desktopLangMenu &&
        !this.desktopLangMenu.contains(e.target)
      ) {
        this.desktopLangMenu.classList.add('hidden');
        this.desktopLangBtn.setAttribute('aria-expanded', 'false');
      }
    });

    console.log('✅ [LanguageSelector] Desktop selector initialized');
  }

  /**
   * Initialise le sélecteur mobile (bottom sheet)
   */
  initMobileSelector() {
    if (!this.mobileLangBtn || !this.mobileLangModal) return;

    // Ouvrir le bottom sheet
    this.mobileLangBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      this.openMobileLangModal();
    });

    // Fermer le modal
    if (this.mobileLangCloseBtn) {
      this.mobileLangCloseBtn.addEventListener('click', () => {
        this.closeMobileLangModal();
      });
    }

    if (this.mobileLangOverlay) {
      this.mobileLangOverlay.addEventListener('click', () => {
        this.closeMobileLangModal();
      });
    }

    // Sélection d'une langue
    const langOptions = document.querySelectorAll('.lang-option');
    langOptions.forEach((option) => {
      option.addEventListener('click', (e) => {
        e.stopPropagation();
        const lang = option.getAttribute('data-lang');
        const flag = option.getAttribute('data-flag');
        const label = option.getAttribute('data-label');

        this.changeLanguage(lang, flag, 'mobile', label);

        // Feedback visuel
        langOptions.forEach((opt) => {
          opt.classList.remove('bg-blue-100', 'border-blue-300');
        });
        option.classList.add('bg-blue-100', 'border-blue-300');

        // Fermer après un délai
        setTimeout(() => {
          this.closeMobileLangModal();
        }, 300);
      });
    });

    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
      if (
        e.key === 'Escape' &&
        this.mobileLangModal &&
        !this.mobileLangModal.classList.contains('hidden')
      ) {
        this.closeMobileLangModal();
      }
    });

    console.log('✅ [LanguageSelector] Mobile selector initialized');
  }

  /**
   * Ouvre le modal mobile
   */
  openMobileLangModal() {
    if (!this.mobileLangModal || !this.mobileLangSheet || !this.mobileLangOverlay)
      return;

    this.mobileLangModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
      this.mobileLangOverlay.classList.remove('opacity-0');
      this.mobileLangOverlay.classList.add('opacity-100');
      this.mobileLangSheet.classList.remove('translate-y-full');
      this.mobileLangSheet.classList.add('translate-y-0');
    }, 10);

    console.log('📱 [LanguageSelector] Mobile modal opened');
  }

  /**
   * Ferme le modal mobile
   */
  closeMobileLangModal() {
    if (!this.mobileLangModal || !this.mobileLangSheet || !this.mobileLangOverlay)
      return;

    this.mobileLangOverlay.classList.remove('opacity-100');
    this.mobileLangOverlay.classList.add('opacity-0');
    this.mobileLangSheet.classList.remove('translate-y-0');
    this.mobileLangSheet.classList.add('translate-y-full');

    setTimeout(() => {
      this.mobileLangModal.classList.add('hidden');
      document.body.style.overflow = '';
    }, 400);

    console.log('📱 [LanguageSelector] Mobile modal closed');
  }

  /**
   * Change la langue (appelle Google Translate)
   */
  changeLanguage(lang, flag, source = 'unknown', label = null) {
    console.log(`🌐 [LanguageSelector] Changing language to: ${lang} (source: ${source})`);

    this.currentLang = lang;

    // Mettre à jour l'affichage desktop
    if (this.desktopLangFlag && source === 'desktop') {
      this.desktopLangFlag.src = flag;
    }

    // Mettre à jour l'affichage mobile
    if (this.mobileLangFlag && this.mobileLangLabel && source === 'mobile' && label) {
      this.mobileLangFlag.src = flag;
      this.mobileLangLabel.textContent = label;
    }

    // Déclencher la traduction Google
    this.triggerGoogleTranslate(lang);

    // Émettre un événement personnalisé
    const event = new CustomEvent('languageChanged', {
      detail: { lang, flag, source },
    });
    document.dispatchEvent(event);
  }

  /**
   * Déclenche Google Translate
   */
  triggerGoogleTranslate(langCode) {
    const selectField = document.querySelector('select.goog-te-combo');
    if (selectField) {
      selectField.value = langCode;
      selectField.dispatchEvent(new Event('change'));
      console.log('✅ [LanguageSelector] Google Translate triggered');
    } else {
      console.warn('⚠️ [LanguageSelector] Google Translate not ready, retrying...');
      setTimeout(() => this.triggerGoogleTranslate(langCode), 500);
    }
  }

  /**
   * Initialise Google Translate (si pas déjà fait)
   */
  initGoogleTranslate() {
    // Si Google Translate n'est pas déjà initialisé, on peut le faire ici
    // Mais normalement c'est déjà fait dans le HTML avec googleTranslateElementInit()
    console.log('🌐 [LanguageSelector] Google Translate initialization checked');
  }
}

/**
 * Factory function pour initialiser le sélecteur de langue
 * @returns {LanguageSelector} Instance du sélecteur
 */
export function initializeLanguageSelector() {
  const languageSelector = new LanguageSelector();
  languageSelector.init();
  return languageSelector;
}