/**
 * Google Translate Initialization
 * Loads and configures the Google Translate API
 * 
 * @module google-translate/init
 */

export class GoogleTranslateInit {
  constructor() {
    this.isReady = false;
    this.scriptLoaded = false;
  }

  /**
   * Initialize Google Translate
   */
  async init() {
    console.log('🌐 [GoogleTranslateInit] Starting initialization...');

    // Setup callback
    this.setupCallback();

    // Load script
    await this.loadScript();

    // Wait for ready
    await this.waitForReady();

    // Apply stored language
    this.applyStoredLanguage();

    console.log('✅ [GoogleTranslateInit] Initialization complete');
  }

  /**
   * Setup global callback for Google Translate
   */
  setupCallback() {
    window.googleTranslateElementInit = () => {
      console.log('🌐 [GoogleTranslate] Callback triggered by Google');

      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,fr,de',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
      }, 'google_translate_element');

      window.googleTranslateReady = true;
      window.dispatchEvent(new Event('googleTranslateReady'));

      this.isReady = true;
      console.log('✅ [GoogleTranslate] API ready');
    };
  }

  /**
   * Load Google Translate script
   */
  loadScript() {
    return new Promise((resolve, reject) => {
      // Check if already loaded
      if (document.getElementById('google-translate-script')) {
        console.log('ℹ️ [GoogleTranslate] Script already loaded');
        resolve();
        return;
      }

      console.log('📥 [GoogleTranslate] Loading script...');

      const script = document.createElement('script');
      script.id = 'google-translate-script';
      script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
      script.async = true;
      
      script.onload = () => {
        this.scriptLoaded = true;
        console.log('✅ [GoogleTranslate] Script loaded');
        resolve();
      };

      script.onerror = () => {
        console.error('❌ [GoogleTranslate] Failed to load script');
        reject(new Error('Failed to load Google Translate'));
      };

      document.body.appendChild(script);
    });
  }

  /**
   * Wait for Google Translate to be ready
   */
  waitForReady(timeout = 10000) {
    return new Promise((resolve) => {
      if (window.googleTranslateReady) {
        this.isReady = true;
        resolve();
        return;
      }

      const timeoutId = setTimeout(() => {
        console.warn('⚠️ [GoogleTranslate] Timeout waiting for ready');
        resolve(); // Continue anyway
      }, timeout);

      window.addEventListener('googleTranslateReady', () => {
        clearTimeout(timeoutId);
        this.isReady = true;
        resolve();
      }, { once: true });
    });
  }

  /**
   * Apply stored language on page load
   */
  applyStoredLanguage() {
    const savedLang = localStorage.getItem('ulixai_lang') || 'en';

    if (savedLang !== 'en') {
      window.location.hash = `googtrans(en|${savedLang})`;
      console.log(`🌐 [GoogleTranslate] Applied stored language: ${savedLang}`);
    }
  }
}

/**
 * Initialize Google Translate (convenience function)
 */
export async function initializeGoogleTranslate() {
  const gtInit = new GoogleTranslateInit();
  await gtInit.init();
  return gtInit;
}