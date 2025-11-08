/**
 * Google Translate Module - Complete Package
 * Single entry point for all Google Translate functionality
 * 
 * Features:
 * - Loads Google Translate API
 * - Injects required CSS styles
 * - Manages language selection UI
 * - Handles language switching
 * 
 * Usage:
 *   import { initializeGoogleTranslateModule } from './modules/google-translate/index.js';
 *   await initializeGoogleTranslateModule();
 * 
 * @module google-translate
 * @version 1.0.0
 */

import { GoogleTranslateInit } from './init.js';
import { LanguageManager } from './language-manager.js';
import { injectGoogleTranslateStyles } from './styles.js';

/**
 * Main initialization function for the entire Google Translate module
 * Handles the complete setup in the correct order
 * 
 * @returns {Promise<Object>} Module instances
 */
export async function initializeGoogleTranslateModule() {
  console.log('🌐 [GoogleTranslateModule] Starting initialization...');

  try {
    // Step 0: Inject CSS styles first (must be done before Google loads)
    console.log('📦 [GoogleTranslateModule] Step 0/3: Injecting styles...');
    injectGoogleTranslateStyles();

    // Step 1: Initialize Google Translate API
    console.log('📦 [GoogleTranslateModule] Step 1/3: Loading Google Translate API...');
    const gtInit = new GoogleTranslateInit();
    await gtInit.init();

    // Step 2: Initialize Language Manager UI
    console.log('📦 [GoogleTranslateModule] Step 2/3: Initializing language UI...');
    const languageManager = new LanguageManager();
    await languageManager.init();

    // Step 3: Expose globally for debugging
    console.log('📦 [GoogleTranslateModule] Step 3/3: Exposing global references...');
    window.ulixaiGoogleTranslate = {
      init: gtInit,
      languageManager: languageManager,
      version: '1.0.0'
    };

    console.log('✅ [GoogleTranslateModule] Initialization complete');
    console.log('🔍 [GoogleTranslateModule] Available at: window.ulixaiGoogleTranslate');

    return {
      init: gtInit,
      languageManager: languageManager
    };

  } catch (error) {
    console.error('❌ [GoogleTranslateModule] Initialization failed:', error);
    throw error;
  }
}

/**
 * Check if Google Translate module is enabled
 * Useful for conditional loading
 * 
 * @returns {boolean} True if enabled
 */
export function isGoogleTranslateEnabled() {
  // Could check config, environment variables, feature flags, etc.
  return true;
}

/**
 * Unload Google Translate module (for cleanup or future replacement)
 * Removes scripts, styles, and global references
 */
export function unloadGoogleTranslateModule() {
  console.log('🗑️ [GoogleTranslateModule] Unloading...');
  
  // Remove script
  const script = document.getElementById('google-translate-script');
  if (script) {
    script.remove();
    console.log('✅ [GoogleTranslateModule] Script removed');
  }

  // Remove styles
  const styles = document.getElementById('google-translate-styles');
  if (styles) {
    styles.remove();
    console.log('✅ [GoogleTranslateModule] Styles removed');
  }

  // Clear cookies
  document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  console.log('✅ [GoogleTranslateModule] Cookies cleared');

  // Clear global references
  delete window.googleTranslateElementInit;
  delete window.googleTranslateReady;
  delete window.ulixaiGoogleTranslate;
  delete window.providerLanguageManager;
  console.log('✅ [GoogleTranslateModule] Global references cleared');

  console.log('✅ [GoogleTranslateModule] Unload complete');
}

// Export classes for advanced usage
export { GoogleTranslateInit } from './init.js';
export { LanguageManager } from './language-manager.js';
export { injectGoogleTranslateStyles, removeGoogleTranslateStyles } from './styles.js';