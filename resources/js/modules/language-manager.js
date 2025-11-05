/**
 * Language Manager - Gestion langue desktop + mobile
 * SAFE: Code extrait exact sans modification
 */

export class LanguageManager {
  constructor() {
    this.selectedLang = 'en';
    this.selectedFlag = 'https://flagcdn.com/24x18/us.png';
  }

  init() {
    this.initDesktopLanguageSelector();
    this.initMobileLanguageSelector();
    this.initGoogleTranslate();
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
    const langBtn = document.getElementById('langBtn');
    const langMenu = document.getElementById('langMenu');
    const langFlag = document.getElementById('langFlag');

    if (!langBtn || !langMenu || !langFlag) {
      console.warn('⚠️ Language selector elements not found');
      return;
    }

    langBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      langMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
        langMenu.classList.add('hidden');
      }
    });

    langMenu.addEventListener('click', (e) => {
      const li = e.target.closest('li');
      if (li) {
        const lang = li.getAttribute('data-lang');
        const flag = li.getAttribute('data-flag');
        if (lang && flag) {
          this.setLanguage(lang, flag);
          langMenu.classList.add('hidden');
        }
      }
    });

    const savedLang = localStorage.getItem('selectedLang') || 'en';
    const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
    langFlag.src = savedFlag;
    this.alignCookiesFor(savedLang);

    if (savedLang !== 'en') {
      window.location.hash = 'googtrans(en|' + savedLang + ')';
    }
  }

  initMobileLanguageSelector() {
    const checkbox = document.getElementById('langOpen');
    const menu = document.getElementById('languageMenu');
    const flag = document.getElementById('languageFlag');
    const label = document.getElementById('languageLabel');

    if (!checkbox || !menu || !flag || !label) return;

    let pendingLang = null;

    const applyLanguage = (code) => {
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select) {
        select.value = code;
        const ev = document.createEvent('HTMLEvents');
        ev.initEvent('change', true, true);
        select.dispatchEvent(ev);
        pendingLang = null;
      } else {
        pendingLang = code;
      }
    };

    menu.addEventListener('click', (e) => {
      const li = e.target.closest('li[data-lang]');
      if (!li) return;

      const code = li.dataset.lang;
      const flagUrl = li.dataset.flag;
      const name = li.textContent.trim();

      flag.src = flagUrl;
      label.textContent = name;

      localStorage.setItem('selectedLang', code);
      localStorage.setItem('selectedFlag', flagUrl);

      this.alignCookiesFor(code);

      if (code === 'en') {
        window.location.hash = '';
      } else {
        window.location.hash = 'googtrans(en|' + code + ')';
      }

      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select) {
        select.value = code;
        select.dispatchEvent(new Event('change'));
        setTimeout(() => location.reload(), 100);
      } else {
        const start = Date.now();
        (function wait() {
          const sel = document.querySelector('#google_translate_element select.goog-te-combo');
          if (sel) {
            sel.value = code;
            sel.dispatchEvent(new Event('change'));
            setTimeout(() => location.reload(), 100);
          } else if (Date.now() - start < 2000) {
            setTimeout(wait, 100);
          } else {
            setTimeout(() => location.reload(), 100);
          }
        })();
      }

      checkbox.checked = false;
    });

    const start = Date.now();
    (function waitForSelect() {
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select) {
        if (pendingLang) applyLanguage(pendingLang);
        return;
      }
      if (Date.now() - start < 12000) setTimeout(waitForSelect, 200);
    })();

    const savedLang = localStorage.getItem('selectedLang') || 'en';
    const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
    const langNames = { en: 'English', fr: 'Français', de: 'Deutsch' };

    flag.src = savedFlag;
    label.textContent = langNames[savedLang] || 'Language';
    this.alignCookiesFor(savedLang);

    if (savedLang !== 'en') {
      window.location.hash = 'googtrans(en|' + savedLang + ')';
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select) {
        select.value = savedLang;
        select.dispatchEvent(new Event('change'));
      } else {
        const start = Date.now();
        (function wait() {
          const sel = document.querySelector('#google_translate_element select.goog-te-combo');
          if (sel) {
            sel.value = savedLang;
            sel.dispatchEvent(new Event('change'));
          } else if (Date.now() - start < 5000) {
            setTimeout(wait, 100);
          }
        })();
      }
    }
  }

  setLanguage(lang, flag) {
    localStorage.setItem('selectedLang', lang);
    localStorage.setItem('selectedFlag', flag);
    this.alignCookiesFor(lang);

    if (lang === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = 'googtrans(en|' + lang + ')';
    }

    setTimeout(() => location.reload(), 100);
  }

  initGoogleTranslate() {
    window.googleTranslateElementInit = () => {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,fr,de',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
      }, 'google_translate_element');
    };
  }
}

export function initializeLanguageManager() {
  const languageManager = new LanguageManager();

  document.addEventListener('DOMContentLoaded', () => {
    languageManager.init();
  });

  return languageManager;
}