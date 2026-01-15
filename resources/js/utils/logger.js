/**
 * Production-Safe Logger Utility
 * Only logs in development mode (when APP_DEBUG is true or localhost)
 *
 * @module utils/logger
 * @version 1.0.0
 */

// Detect if we're in development mode
const isDev = () => {
  // Check for localhost
  if (typeof window !== 'undefined') {
    const host = window.location.hostname;
    if (host === 'localhost' || host === '127.0.0.1' || host.includes('.test') || host.includes('.local')) {
      return true;
    }
  }

  // Check for Laravel debug mode (injected via blade)
  if (typeof window !== 'undefined' && window.APP_DEBUG === true) {
    return true;
  }

  // Check for Node.js environment
  if (typeof process !== 'undefined' && process.env && process.env.NODE_ENV === 'development') {
    return true;
  }

  return false;
};

// Cache the result for performance
let _isDev = null;
const isDevMode = () => {
  if (_isDev === null) {
    _isDev = isDev();
  }
  return _isDev;
};

/**
 * Logger object with conditional methods
 * In production, all methods are no-ops
 */
const logger = {
  /**
   * Log informational message (only in dev)
   */
  log: (...args) => {
    if (isDevMode()) {
      console.log(...args);
    }
  },

  /**
   * Log warning message (only in dev)
   */
  warn: (...args) => {
    if (isDevMode()) {
      console.warn(...args);
    }
  },

  /**
   * Log error message (always logs - errors should be visible)
   */
  error: (...args) => {
    console.error(...args);
  },

  /**
   * Log debug message (only in dev)
   */
  debug: (...args) => {
    if (isDevMode()) {
      console.debug(...args);
    }
  },

  /**
   * Log info message (only in dev)
   */
  info: (...args) => {
    if (isDevMode()) {
      console.info(...args);
    }
  },

  /**
   * Log group start (only in dev)
   */
  group: (...args) => {
    if (isDevMode()) {
      console.group(...args);
    }
  },

  /**
   * Log group end (only in dev)
   */
  groupEnd: () => {
    if (isDevMode()) {
      console.groupEnd();
    }
  },

  /**
   * Log table (only in dev)
   */
  table: (...args) => {
    if (isDevMode()) {
      console.table(...args);
    }
  },

  /**
   * Check if dev mode is enabled
   */
  isDevMode
};

// Export for ES modules
export { logger, isDevMode };

// Export default
export default logger;

// Also expose globally for legacy scripts
if (typeof window !== 'undefined') {
  window.ulixaiLogger = logger;
}
