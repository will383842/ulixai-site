/**
 * Cookie Manager - Centralized cookie handling
 * Utilisé par Google Translate et autres composants
 */

export class CookieManager {
  /**
   * Get all relevant domains for cookie setting
   * @returns {Array<string|undefined>}
   */
  static getDomains() {
    const host = location.hostname;
    const naked = host.replace(/^www\./, '');
    const list = [undefined];
    
    if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) {
      list.push(naked);
    }
    
    if (naked !== host) {
      list.push(host);
    }
    
    return list;
  }

  /**
   * Set cookie across all domains
   * @param {string} name - Cookie name
   * @param {string} value - Cookie value
   * @param {number} days - Expiration days (default: 365)
   */
  static set(name, value, days = 365) {
    const exp = new Date(Date.now() + days * 864e5).toUTCString();
    
    this.getDomains().forEach(domain => {
      document.cookie = `${name}=${value}; expires=${exp}; path=/` + 
        (domain ? `; domain=${domain}` : '');
    });
  }

  /**
   * Clear cookie from all domains
   * @param {string} name - Cookie name
   */
  static clear(name) {
    const past = 'Thu, 01 Jan 1970 00:00:01 GMT';
    
    this.getDomains().forEach(domain => {
      document.cookie = `${name}=; expires=${past}; path=/` + 
        (domain ? `; domain=${domain}` : '');
    });
  }

  /**
   * Get cookie value
   * @param {string} name - Cookie name
   * @returns {string|null}
   */
  static get(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
  }
}