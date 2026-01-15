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
 * @version 1.1.0 - Production-safe logging
 */

import { GoogleTranslateInit } from './init.js';
import { LanguageManager } from './language-manager.js';
import { injectGoogleTranslateStyles } from './styles.js';
import logger from '../../utils/logger.js';

/**
 * Main initialization function for the entire Google Translate module
 * Handles the complete setup in the correct order
 *
 * @returns {Promise<Object>} Module instances
 */
export async function initializeGoogleTranslateModule() {
  logger.log('[GoogleTranslate] Starting initialization...');

  try {
    // Step 0: Inject CSS styles first (must be done before Google loads)
    logger.debug('[GoogleTranslate] Step 0/3: Injecting styles...');
    injectGoogleTranslateStyles();

    // Step 1: Initialize Google Translate API
    logger.debug('[GoogleTranslate] Step 1/3: Loading Google Translate API...');
    const gtInit = new GoogleTranslateInit();
    await gtInit.init();

    // Step 2: Initialize Language Manager UI
    logger.debug('[GoogleTranslate] Step 2/3: Initializing language UI...');
    const languageManager = new LanguageManager();
    await languageManager.init();

    // Step 3: Expose globally for debugging
    logger.debug('[GoogleTranslate] Step 3/3: Exposing global references...');
    window.ulixaiGoogleTranslate = {
      init: gtInit,
      languageManager: languageManager,
      version: '1.1.0'
    };

    logger.log('[GoogleTranslate] Initialization complete');

    return {
      init: gtInit,
      languageManager: languageManager
    };

  } catch (error) {
    logger.error('[GoogleTranslate] Initialization failed:', error);
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
  logger.log('[GoogleTranslate] Unloading...');

  // Remove script
  const script = document.getElementById('google-translate-script');
  if (script) {
    script.remove();
  }

  // Remove styles
  const styles = document.getElementById('google-translate-styles');
  if (styles) {
    styles.remove();
  }

  // Clear cookies
  document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

  // Clear global references
  delete window.googleTranslateElementInit;
  delete window.googleTranslateReady;
  delete window.ulixaiGoogleTranslate;
  delete window.providerLanguageManager;

  logger.log('[GoogleTranslate] Unload complete');
}

// Export classes for advanced usage
export { GoogleTranslateInit } from './init.js';
export { LanguageManager } from './language-manager.js';
export { injectGoogleTranslateStyles, removeGoogleTranslateStyles } from './styles.js';