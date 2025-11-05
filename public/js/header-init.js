/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/modules/category-popups.js":
/*!*************************************************!*\
  !*** ./resources/js/modules/category-popups.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initializeCategoryPopups: () => (/* binding */ initializeCategoryPopups)
/* harmony export */ });
function initializeCategoryPopups() {
  console.log('🎯 Category popups: START');

  // ========================================
  // FONCTION PRINCIPALE : OUVRIR LE POPUP
  // ========================================
  window.openHelpPopup = function () {
    console.log('✅ openHelpPopup CALLED');
    var popup = document.getElementById('searchPopup');
    if (!popup) {
      console.error('❌ searchPopup not found');
      return;
    }
    popup.classList.remove('hidden');
    console.log('✅ Popup is now visible');
    fetch('/api/categories').then(function (res) {
      return res.json();
    }).then(function (data) {
      console.log('Categories data:', data);
      if (data.success) {
        var container = document.querySelector('#searchPopup .main-categories');
        if (!container) {
          console.error('❌ .main-categories not found');
          return;
        }
        container.innerHTML = '';
        console.log('✅ Building categories...');
        data.categories.forEach(function (cat) {
          var div = document.createElement('div');
          div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";

          // Couleur de fond
          var color = cat.bg_color || '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          // Icône avec image
          var iconHtml = '';
          if (cat.icon_image) {
            iconHtml = '<div class="w-12 h-12 rounded-full overflow-hidden mb-2 group-hover:scale-110 transition-transform bg-gray-100">' + '<img src="/' + cat.icon_image + '" alt="' + cat.name + '" class="w-full h-full object-cover rounded-full">' + '</div>';
          } else {
            iconHtml = '<div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">' + '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' + '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' + '</svg></div>';
          }
          div.innerHTML = iconHtml + '<h3 class="text-sm font-semibold text-gray-800">' + cat.name + '</h3>';
          div.onclick = function () {
            window.handleCategoryClick(cat.id, cat.name);
          };
          container.appendChild(div);
        });
        console.log('✅ Categories rendered');
      }
    })["catch"](function (err) {
      return console.error('❌ Fetch error:', err);
    });
  };

  // ========================================
  // CLIC SUR CATÉGORIE → SOUS-CATÉGORIES
  // ========================================
  window.handleCategoryClick = function (categoryId, categoryName) {
    var _document$getElementB, _document$getElementB2;
    console.log('Category clicked:', categoryId, categoryName);
    (_document$getElementB = document.getElementById('searchPopup')) === null || _document$getElementB === void 0 || _document$getElementB.classList.add('hidden');
    (_document$getElementB2 = document.getElementById('expatriesPopup')) === null || _document$getElementB2 === void 0 || _document$getElementB2.classList.remove('hidden');
    var createRequest = {
      category: JSON.stringify({
        id: categoryId,
        name: categoryName
      })
    };
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    fetch('/api/categories/' + categoryId + '/subcategories').then(function (res) {
      return res.json();
    }).then(function (data) {
      if (data.success) {
        var subContainer = document.querySelector('#expatriesPopup .sub-category');
        if (!subContainer) {
          console.error('❌ .sub-category not found');
          return;
        }
        subContainer.innerHTML = '';
        data.subcategories.forEach(function (sub) {
          var div = document.createElement('div');
          div.className = "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          // Couleur de fond
          var color = sub.bg_color || '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          // Icône avec image
          var iconHtml = '';
          if (sub.icon_image) {
            iconHtml = '<div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">' + '<img src="' + sub.icon_image + '" alt="" class="w-full h-full object-cover rounded-full">' + '</div>';
          } else {
            iconHtml = '<div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">' + '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' + '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' + '</svg></div>';
          }
          div.innerHTML = iconHtml + '<div class="flex-grow font-semibold text-gray-800">' + sub.name + '</div>' + '<div class="text-gray-400 group-hover:text-gray-600 transition-colors">' + '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' + '<polyline points="9,18 15,12 9,6"></polyline>' + '</svg></div>';
          div.onclick = function () {
            window.handleSubcategoryClick(sub.id, sub.name);
          };
          subContainer.appendChild(div);
        });
        console.log('✅ Subcategories rendered');
      }
    })["catch"](function (err) {
      return console.error('❌ Error:', err);
    });
  };

  // ========================================
  // CLIC SUR SOUS-CATÉGORIE → ENFANTS
  // ========================================
  window.handleSubcategoryClick = function (parentId, categoryName) {
    console.log('Subcategory clicked:', parentId, categoryName);
    var createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.sub_category = JSON.stringify({
      id: parentId,
      name: categoryName
    });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    fetch('/api/categories/' + parentId + '/children').then(function (res) {
      return res.json();
    }).then(function (data) {
      if (data.success && data.subcategories.length > 0) {
        var _document$getElementB3, _document$getElementB4;
        // Il y a des sous-sous-catégories
        (_document$getElementB3 = document.getElementById('expatriesPopup')) === null || _document$getElementB3 === void 0 || _document$getElementB3.classList.add('hidden');
        (_document$getElementB4 = document.getElementById('vacanciersAutresBesoinsPopup')) === null || _document$getElementB4 === void 0 || _document$getElementB4.classList.remove('hidden');
        var childContainer = document.querySelector('#vacanciersAutresBesoinsPopup .child-categories');
        if (!childContainer) {
          console.error('❌ .child-categories not found');
          return;
        }
        childContainer.innerHTML = '';
        data.subcategories.forEach(function (child) {
          var div = document.createElement('div');
          div.className = "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          // Couleur de fond
          var color = child.bg_color || '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          // Icône avec image
          var iconHtml = '';
          if (child.icon_image) {
            iconHtml = '<div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">' + '<img src="' + child.icon_image + '" alt="" class="w-full h-full object-cover rounded-full">' + '</div>';
          } else {
            iconHtml = '<div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">' + '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' + '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' + '</svg></div>';
          }
          div.innerHTML = iconHtml + '<div class="flex-grow font-semibold text-gray-800">' + child.name + '</div>' + '<div class="text-gray-400 group-hover:text-gray-600 transition-colors">' + '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' + '<polyline points="9,18 15,12 9,6"></polyline>' + '</svg></div>';
          div.onclick = function () {
            window.requestForHelp(child.id, child.name);
          };
          childContainer.appendChild(div);
        });
        console.log('✅ Child categories rendered');
      } else {
        // Pas de sous-sous-catégories → redirection directe
        console.log('No children, redirecting...');
        window.requestForHelp(parentId, categoryName);
      }
    })["catch"](function (err) {
      return console.error('❌ Error:', err);
    });
  };

  // ========================================
  // REDIRECTION FINALE
  // ========================================
  window.requestForHelp = function (childId, childName) {
    console.log('Request help:', childId, childName);
    var createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({
      id: childId,
      name: childName
    });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  };

  // ========================================
  // FONCTIONS UTILITAIRES
  // ========================================
  window.closeSearchPopup = function () {
    var _document$getElementB5;
    (_document$getElementB5 = document.getElementById('searchPopup')) === null || _document$getElementB5 === void 0 || _document$getElementB5.classList.add('hidden');
  };
  window.closeAllPopups = function () {
    ['searchPopup', 'expatriesPopup', 'vacanciersPopup', 'vacanciersAutresBesoinsPopup'].forEach(function (id) {
      var el = document.getElementById(id);
      if (el) el.classList.add('hidden');
    });
    localStorage.removeItem('create-request');
  };
  window.goBackToVacanciersSubcategories = function () {
    var _document$getElementB6, _document$getElementB7;
    (_document$getElementB6 = document.getElementById('vacanciersAutresBesoinsPopup')) === null || _document$getElementB6 === void 0 || _document$getElementB6.classList.add('hidden');
    (_document$getElementB7 = document.getElementById('expatriesPopup')) === null || _document$getElementB7 === void 0 || _document$getElementB7.classList.remove('hidden');
  };
  console.log('✅ Category popups: READY');
}

/***/ }),

/***/ "./resources/js/modules/language-manager.js":
/*!**************************************************!*\
  !*** ./resources/js/modules/language-manager.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   LanguageManager: () => (/* binding */ LanguageManager),
/* harmony export */   initializeLanguageManager: () => (/* binding */ initializeLanguageManager)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Language Manager - Gestion langue desktop + mobile
 * SAFE: Code extrait exact sans modification
 */

var LanguageManager = /*#__PURE__*/function () {
  function LanguageManager() {
    _classCallCheck(this, LanguageManager);
    this.selectedLang = 'en';
    this.selectedFlag = 'https://flagcdn.com/24x18/us.png';
  }
  return _createClass(LanguageManager, [{
    key: "init",
    value: function init() {
      this.initDesktopLanguageSelector();
      this.initMobileLanguageSelector();
      this.initGoogleTranslate();
    }
  }, {
    key: "domains",
    value: function domains() {
      var host = location.hostname;
      var naked = host.replace(/^www\./, '');
      var list = [undefined];
      if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) list.push(naked);
      if (naked !== host) list.push(host);
      return list;
    }
  }, {
    key: "setCookie",
    value: function setCookie(name, value) {
      var days = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 365;
      var exp = new Date(Date.now() + days * 864e5).toUTCString();
      this.domains().forEach(function (d) {
        document.cookie = "".concat(name, "=").concat(value, "; expires=").concat(exp, "; path=/") + (d ? "; domain=".concat(d) : '');
      });
    }
  }, {
    key: "clearCookie",
    value: function clearCookie(name) {
      var past = 'Thu, 01 Jan 1970 00:00:01 GMT';
      this.domains().forEach(function (d) {
        document.cookie = "".concat(name, "=; expires=").concat(past, "; path=/") + (d ? "; domain=".concat(d) : '');
      });
    }
  }, {
    key: "alignCookiesFor",
    value: function alignCookiesFor(lang) {
      if (!lang || lang === 'en') {
        this.clearCookie('googtrans');
        this.clearCookie('googtransopt');
      } else {
        var val = "/auto/".concat(lang);
        this.setCookie('googtrans', val);
        this.setCookie('googtransopt', val);
      }
    }
  }, {
    key: "initDesktopLanguageSelector",
    value: function initDesktopLanguageSelector() {
      var _this = this;
      var langBtn = document.getElementById('langBtn');
      var langMenu = document.getElementById('langMenu');
      var langFlag = document.getElementById('langFlag');
      if (!langBtn || !langMenu || !langFlag) {
        console.warn('⚠️ Language selector elements not found');
        return;
      }
      langBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        langMenu.classList.toggle('hidden');
      });
      document.addEventListener('click', function (e) {
        if (!langBtn.contains(e.target) && !langMenu.contains(e.target)) {
          langMenu.classList.add('hidden');
        }
      });
      langMenu.addEventListener('click', function (e) {
        var li = e.target.closest('li');
        if (li) {
          var lang = li.getAttribute('data-lang');
          var flag = li.getAttribute('data-flag');
          if (lang && flag) {
            _this.setLanguage(lang, flag);
            langMenu.classList.add('hidden');
          }
        }
      });
      var savedLang = localStorage.getItem('selectedLang') || 'en';
      var savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
      langFlag.src = savedFlag;
      this.alignCookiesFor(savedLang);
      if (savedLang !== 'en') {
        window.location.hash = 'googtrans(en|' + savedLang + ')';
      }
    }
  }, {
    key: "initMobileLanguageSelector",
    value: function initMobileLanguageSelector() {
      var _this2 = this;
      var checkbox = document.getElementById('langOpen');
      var menu = document.getElementById('languageMenu');
      var flag = document.getElementById('languageFlag');
      var label = document.getElementById('languageLabel');
      if (!checkbox || !menu || !flag || !label) return;
      var pendingLang = null;
      var applyLanguage = function applyLanguage(code) {
        var select = document.querySelector('#google_translate_element select.goog-te-combo');
        if (select) {
          select.value = code;
          var ev = document.createEvent('HTMLEvents');
          ev.initEvent('change', true, true);
          select.dispatchEvent(ev);
          pendingLang = null;
        } else {
          pendingLang = code;
        }
      };
      menu.addEventListener('click', function (e) {
        var li = e.target.closest('li[data-lang]');
        if (!li) return;
        var code = li.dataset.lang;
        var flagUrl = li.dataset.flag;
        var name = li.textContent.trim();
        flag.src = flagUrl;
        label.textContent = name;
        localStorage.setItem('selectedLang', code);
        localStorage.setItem('selectedFlag', flagUrl);
        _this2.alignCookiesFor(code);
        if (code === 'en') {
          window.location.hash = '';
        } else {
          window.location.hash = 'googtrans(en|' + code + ')';
        }
        var select = document.querySelector('#google_translate_element select.goog-te-combo');
        if (select) {
          select.value = code;
          select.dispatchEvent(new Event('change'));
          setTimeout(function () {
            return location.reload();
          }, 100);
        } else {
          var _start = Date.now();
          (function wait() {
            var sel = document.querySelector('#google_translate_element select.goog-te-combo');
            if (sel) {
              sel.value = code;
              sel.dispatchEvent(new Event('change'));
              setTimeout(function () {
                return location.reload();
              }, 100);
            } else if (Date.now() - _start < 2000) {
              setTimeout(wait, 100);
            } else {
              setTimeout(function () {
                return location.reload();
              }, 100);
            }
          })();
        }
        checkbox.checked = false;
      });
      var start = Date.now();
      (function waitForSelect() {
        var select = document.querySelector('#google_translate_element select.goog-te-combo');
        if (select) {
          if (pendingLang) applyLanguage(pendingLang);
          return;
        }
        if (Date.now() - start < 12000) setTimeout(waitForSelect, 200);
      })();
      var savedLang = localStorage.getItem('selectedLang') || 'en';
      var savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
      var langNames = {
        en: 'English',
        fr: 'Français',
        de: 'Deutsch'
      };
      flag.src = savedFlag;
      label.textContent = langNames[savedLang] || 'Language';
      this.alignCookiesFor(savedLang);
      if (savedLang !== 'en') {
        window.location.hash = 'googtrans(en|' + savedLang + ')';
        var select = document.querySelector('#google_translate_element select.goog-te-combo');
        if (select) {
          select.value = savedLang;
          select.dispatchEvent(new Event('change'));
        } else {
          var _start2 = Date.now();
          (function wait() {
            var sel = document.querySelector('#google_translate_element select.goog-te-combo');
            if (sel) {
              sel.value = savedLang;
              sel.dispatchEvent(new Event('change'));
            } else if (Date.now() - _start2 < 5000) {
              setTimeout(wait, 100);
            }
          })();
        }
      }
    }
  }, {
    key: "setLanguage",
    value: function setLanguage(lang, flag) {
      localStorage.setItem('selectedLang', lang);
      localStorage.setItem('selectedFlag', flag);
      this.alignCookiesFor(lang);
      if (lang === 'en') {
        window.location.hash = '';
      } else {
        window.location.hash = 'googtrans(en|' + lang + ')';
      }
      setTimeout(function () {
        return location.reload();
      }, 100);
    }
  }, {
    key: "initGoogleTranslate",
    value: function initGoogleTranslate() {
      window.googleTranslateElementInit = function () {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,fr,de',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
          autoDisplay: false
        }, 'google_translate_element');
      };
    }
  }]);
}();
function initializeLanguageManager() {
  var languageManager = new LanguageManager();
  document.addEventListener('DOMContentLoaded', function () {
    languageManager.init();
  });
  return languageManager;
}

/***/ }),

/***/ "./resources/js/modules/mobile-menu.js":
/*!*********************************************!*\
  !*** ./resources/js/modules/mobile-menu.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   MobileMenu: () => (/* binding */ MobileMenu),
/* harmony export */   initializeMobileMenu: () => (/* binding */ initializeMobileMenu)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Mobile Menu - Gestion complète du menu mobile
 */

var MobileMenu = /*#__PURE__*/function () {
  function MobileMenu() {
    _classCallCheck(this, MobileMenu);
    this.isMenuOpen = false;
    this.toggleButtons = [];
    this.mobileMenu = null;
    this.mobileMenuCloseBtn = null;
  }
  return _createClass(MobileMenu, [{
    key: "init",
    value: function init() {
      this.toggleButtons = [document.getElementById("menu-toggle-top"), null];
      this.mobileMenu = document.getElementById("mobile-menu");
      this.mobileMenuCloseBtn = document.getElementById("mobileMenuCloseBtn");
      if (!this.mobileMenu) {
        console.warn('Mobile menu not found');
        return;
      }
      this.initToggleListeners();
      this.initCloseButton();
      this.initLinkListeners();
      this.initKeyboardListeners();
      this.initOutsideClickListener();
      console.log('✅ Mobile menu initialized');
    }
  }, {
    key: "openMobileMenu",
    value: function openMobileMenu() {
      var _this = this;
      if (!this.mobileMenu) return;
      this.isMenuOpen = true;
      this.mobileMenu.classList.add("menu-animating");
      this.mobileMenu.classList.remove("hidden");
      this.mobileMenu.classList.add("menu-open");
      requestAnimationFrame(function () {
        _this.mobileMenu.style.opacity = '0';
        _this.mobileMenu.style.transform = 'translateY(-10px)';
        requestAnimationFrame(function () {
          _this.mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
          _this.mobileMenu.style.opacity = '1';
          _this.mobileMenu.style.transform = 'translateY(0)';
        });
      });
      this.toggleButtons.forEach(function (btn) {
        if (btn) {
          btn.classList.add("menu-active");
          btn.setAttribute('aria-expanded', 'true');
        }
      });
      setTimeout(function () {
        _this.mobileMenu.classList.remove("menu-animating");
      }, 300);
      if (navigator.vibrate) navigator.vibrate(10);
      this.mobileMenu.setAttribute('aria-hidden', 'false');
    }
  }, {
    key: "closeMobileMenu",
    value: function closeMobileMenu() {
      var _this2 = this;
      if (!this.mobileMenu) return;
      this.isMenuOpen = false;
      this.mobileMenu.classList.add("menu-animating");
      this.mobileMenu.classList.remove("menu-open");
      this.mobileMenu.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
      this.mobileMenu.style.opacity = '0';
      this.mobileMenu.style.transform = 'translateY(-10px)';
      setTimeout(function () {
        _this2.mobileMenu.classList.add("hidden");
        _this2.mobileMenu.classList.remove("menu-animating");
        _this2.mobileMenu.style.opacity = '';
        _this2.mobileMenu.style.transform = '';
        _this2.mobileMenu.style.transition = '';
      }, 300);
      this.toggleButtons.forEach(function (btn) {
        if (btn) {
          btn.classList.remove("menu-active");
          btn.setAttribute('aria-expanded', 'false');
        }
      });
      if (navigator.vibrate) navigator.vibrate(5);
      this.mobileMenu.setAttribute('aria-hidden', 'true');
    }
  }, {
    key: "toggleMobileMenu",
    value: function toggleMobileMenu() {
      if (this.isMenuOpen) {
        this.closeMobileMenu();
      } else {
        this.openMobileMenu();
      }
    }
  }, {
    key: "initToggleListeners",
    value: function initToggleListeners() {
      var _this3 = this;
      this.toggleButtons.forEach(function (btn) {
        if (btn) {
          btn.addEventListener("click", function () {
            return _this3.toggleMobileMenu();
          });
          btn.setAttribute('aria-expanded', 'false');
        }
      });
    }
  }, {
    key: "initCloseButton",
    value: function initCloseButton() {
      var _this4 = this;
      if (this.mobileMenuCloseBtn) {
        this.mobileMenuCloseBtn.addEventListener("click", function () {
          return _this4.closeMobileMenu();
        });
      }
    }
  }, {
    key: "initLinkListeners",
    value: function initLinkListeners() {
      var _this5 = this;
      if (this.mobileMenu) {
        var menuLinks = this.mobileMenu.querySelectorAll('a');
        menuLinks.forEach(function (link) {
          link.addEventListener('click', function () {
            setTimeout(function () {
              return _this5.closeMobileMenu();
            }, 100);
          });
        });
      }
    }
  }, {
    key: "initKeyboardListeners",
    value: function initKeyboardListeners() {
      var _this6 = this;
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && _this6.isMenuOpen) {
          _this6.closeMobileMenu();
        }
      });
    }
  }, {
    key: "initOutsideClickListener",
    value: function initOutsideClickListener() {
      var _this7 = this;
      document.addEventListener('click', function (e) {
        if (_this7.isMenuOpen && _this7.mobileMenu && !_this7.mobileMenu.contains(e.target) && !_this7.toggleButtons.some(function (btn) {
          return btn && btn.contains(e.target);
        })) {
          _this7.closeMobileMenu();
        }
      });
    }
  }]);
}();
function initializeMobileMenu() {
  var mobileMenu = new MobileMenu();
  mobileMenu.init();
  return mobileMenu;
}

/***/ }),

/***/ "./resources/js/modules/scroll-utils.js":
/*!**********************************************!*\
  !*** ./resources/js/modules/scroll-utils.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ScrollUtils: () => (/* binding */ ScrollUtils),
/* harmony export */   initializeScrollUtils: () => (/* binding */ initializeScrollUtils)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Scroll Utils - Scroll to top et autres utilitaires
 * SAFE: Code extrait exact
 */

var ScrollUtils = /*#__PURE__*/function () {
  function ScrollUtils() {
    _classCallCheck(this, ScrollUtils);
  }
  return _createClass(ScrollUtils, [{
    key: "init",
    value: function init() {
      this.initScrollRestore();
      this.initScrollToTop();
      this.initUserNameUpdates();
    }
  }, {
    key: "initScrollRestore",
    value: function initScrollRestore() {
      if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
      }
      window.onload = function () {
        return window.scrollTo(0, 0);
      };
      var scrollTimer;
      window.onscroll = function () {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(function () {
          var btn = document.getElementById('scrollToTopBtn');
          if (btn && window.innerWidth > 768) {
            btn.className = window.pageYOffset > 400 ? 'show' : '';
          }
        }, 100);
      };
    }
  }, {
    key: "initScrollToTop",
    value: function initScrollToTop() {
      document.addEventListener('DOMContentLoaded', function () {
        var btn = document.getElementById('scrollToTopBtn');
        if (btn) {
          btn.addEventListener('click', function () {
            window.scrollTo({
              top: 0,
              behavior: 'smooth'
            });
          });
        }
      });
    }
  }, {
    key: "initUserNameUpdates",
    value: function initUserNameUpdates() {
      var _this = this;
      document.addEventListener('DOMContentLoaded', function () {
        _this.updateUserDisplayNames();
      });
    }
  }, {
    key: "extractFirstName",
    value: function extractFirstName(fullName) {
      var cleanName = fullName.replace(/[^\w\s]/g, '').trim();
      var nameParts = cleanName.split(/\s+/);
      return nameParts[0] || cleanName;
    }
  }, {
    key: "updateUserDisplayNames",
    value: function updateUserDisplayNames() {
      var headerUserName = document.getElementById('header-user-name');
      if (headerUserName) {
        var fullName = headerUserName.textContent.trim();
        headerUserName.textContent = this.extractFirstName(fullName);
      }
      var headerUserFullname = document.getElementById('header-user-fullname');
      if (headerUserFullname) {
        var _fullName = headerUserFullname.textContent.trim();
        headerUserFullname.textContent = this.extractFirstName(_fullName);
      }
      var sidebarGreeting = document.getElementById('user-greeting');
      if (sidebarGreeting) {
        var fullGreeting = sidebarGreeting.textContent.trim();
        var firstName = this.extractFirstName(fullGreeting);
        sidebarGreeting.textContent = firstName + '!';
      }
    }
  }]);
}();

// Fonctions globales nécessaires
function initializeScrollUtils() {
  var scrollUtils = new ScrollUtils();
  scrollUtils.init();
  window.updateHeaderAfterLogin = function (userData) {
    var authButtons = document.querySelector('.auth-buttons');
    var userMenu = document.createElement('div');
    userMenu.innerHTML = "\n      <div class=\"relative\" x-data=\"{ open:false }\">\n        <button \n          type=\"button\"\n          @click=\"open = !open\"\n          @keydown.escape.window=\"open = false\"\n          class=\"flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100\"\n          aria-haspopup=\"menu\"\n          :aria-expanded=\"open.toString()\"\n        >\n          <div class=\"w-8 h-8 rounded-full border bg-center bg-cover\"\n            style=\"background-image: url('".concat(userData.avatar || '/images/helpexpat.png', "');\">\n          </div>\n          <span id=\"header-user-name\" class=\"font-medium text-gray-700 truncate max-w-[10rem]\">\n            ").concat(userData.name, "\n          </span>\n          <i class=\"fas fa-chevron-down text-gray-500 text-sm\"></i>\n        </button>\n      </div>\n    ");
    if (authButtons) {
      authButtons.replaceWith(userMenu);
    }
  };
  return scrollUtils;
}

/***/ }),

/***/ "./resources/js/modules/wizard-core.js":
/*!*********************************************!*\
  !*** ./resources/js/modules/wizard-core.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   WizardCore: () => (/* binding */ WizardCore),
/* harmony export */   initializeWizard: () => (/* binding */ initializeWizard)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Wizard Core - Gestion de base du wizard provider
 * Gère l'état, la validation et les boutons
 */

var WizardCore = /*#__PURE__*/function () {
  function WizardCore() {
    _classCallCheck(this, WizardCore);
    this.storeKey = 'pw.state';
    this.steps = [];
    this.current = 0;
    this.state = this.loadState();
  }
  return _createClass(WizardCore, [{
    key: "loadState",
    value: function loadState() {
      try {
        var raw = sessionStorage.getItem(this.storeKey) || localStorage.getItem(this.storeKey) || '{}';
        return JSON.parse(raw);
      } catch (e) {
        return {};
      }
    }
  }, {
    key: "saveState",
    value: function saveState(state) {
      try {
        sessionStorage.setItem(this.storeKey, JSON.stringify(state));
        localStorage.setItem(this.storeKey, JSON.stringify(state));
      } catch (e) {
        console.error('Failed to save state', e);
      }
    }
  }, {
    key: "detectSteps",
    value: function detectSteps() {
      this.steps = Array.from(document.querySelectorAll('[id^="step"]')).filter(function (el) {
        return /^step\d+$/i.test(el.id);
      });
    }
  }, {
    key: "updateUI",
    value: function updateUI() {
      this.detectSteps();
      var ok = this.validate(this.current);
      this.setBtnEnabled('#mobileNextBtn, #nextBtn, .btn-next, [data-action="next"]', ok);
    }
  }, {
    key: "setBtnEnabled",
    value: function setBtnEnabled(selector, enabled) {
      var nodes = document.querySelectorAll(selector);
      nodes.forEach(function (el) {
        el.disabled = !enabled;
        el.classList.toggle('opacity-50', !enabled);
      });
    }
  }, {
    key: "validate",
    value: function validate(i) {
      var step = this.steps[i];
      if (!step) return true;
      var required = step.querySelectorAll('[required]');
      for (var r = 0; r < required.length; r++) {
        var f = required[r];
        if (!f.value) return false;
      }
      return true;
    }
  }, {
    key: "init",
    value: function init() {
      this.detectSteps();
      this.updateUI();
      this.initCloseButtons();
      console.log('✅ Wizard core initialized');
    }
  }, {
    key: "initCloseButtons",
    value: function initCloseButtons() {
      var _this = this;
      var closeBtn = document.getElementById('closePopup');
      var popup = document.getElementById('signupPopup');
      var signupBtn = document.getElementById('signupBtn');

      // Bouton close (X)
      if (closeBtn && popup) {
        closeBtn.addEventListener('click', function () {
          console.log('🔒 Closing signup popup via close button');
          _this.closePopup();
        });
        console.log('✅ Close button attached');
      } else {
        console.warn('⚠️ Close button or popup not found');
      }

      // Bouton Sign Up dans le header
      if (signupBtn && popup) {
        signupBtn.addEventListener('click', function (e) {
          e.preventDefault();
          console.log('🔓 Opening signup popup via Sign Up button');
          _this.openPopup();
        });
        console.log('✅ Sign Up button attached');
      }

      // Fermer avec Escape
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
          console.log('⌨️ Closing popup with Escape');
          _this.closePopup();
        }
      });

      // Fermer en cliquant sur le backdrop
      if (popup) {
        popup.addEventListener('click', function (e) {
          if (e.target === popup) {
            console.log('🖱️ Closing popup via backdrop');
            _this.closePopup();
          }
        });
      }

      // Exposer globalement pour usage depuis HTML (onclick="openSignupPopup()")
      window.closeSignupPopup = function () {
        return _this.closePopup();
      };
      window.openSignupPopup = function () {
        return _this.openPopup();
      };
      console.log('✅ Popup controls initialized');
    }
  }, {
    key: "closePopup",
    value: function closePopup() {
      var popup = document.getElementById('signupPopup');
      if (!popup) {
        console.warn('⚠️ Popup not found');
        return;
      }
      popup.classList.add('hidden');
      console.log('✅ Popup closed');

      // Réinitialiser à l'étape 1
      this.resetToFirstStep();
    }
  }, {
    key: "openPopup",
    value: function openPopup() {
      var popup = document.getElementById('signupPopup');
      if (!popup) {
        console.warn('⚠️ Popup not found');
        return;
      }
      popup.classList.remove('hidden');
      console.log('✅ Popup opened');

      // Afficher step 1
      this.resetToFirstStep();
    }
  }, {
    key: "resetToFirstStep",
    value: function resetToFirstStep() {
      var allSteps = document.querySelectorAll('[id^="step"]');
      allSteps.forEach(function (step) {
        return step.classList.add('hidden');
      });
      var step1 = document.getElementById('step1');
      if (step1) {
        step1.classList.remove('hidden');
        this.current = 0;
        console.log('✅ Reset to step 1');
      }
    }
  }]);
}();
function initializeWizard() {
  if (window.providerWizard) {
    console.log('⚠️ Wizard already initialized');
    return window.providerWizard;
  }
  var wizard = new WizardCore();
  wizard.init();
  window.providerWizard = {
    update: function update() {
      return wizard.updateUI();
    },
    close: function close() {
      return wizard.closePopup();
    },
    open: function open() {
      return wizard.openPopup();
    }
  };
  return window.providerWizard;
}

/***/ }),

/***/ "./resources/js/modules/wizard-steps.js":
/*!**********************************************!*\
  !*** ./resources/js/modules/wizard-steps.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   WizardSteps: () => (/* binding */ WizardSteps),
/* harmony export */   initializeWizardSteps: () => (/* binding */ initializeWizardSteps)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Wizard Steps - Logique complète des 16 étapes du formulaire provider
 */

var WizardSteps = /*#__PURE__*/function () {
  function WizardSteps() {
    _classCallCheck(this, WizardSteps);
    this.currentStep = 0;
    this.totalSteps = 16;
    this.formData = this.loadFormData();
  }
  return _createClass(WizardSteps, [{
    key: "loadFormData",
    value: function loadFormData() {
      try {
        var data = localStorage.getItem('provider-signup-data');
        return data ? JSON.parse(data) : {};
      } catch (e) {
        return {};
      }
    }
  }, {
    key: "saveFormData",
    value: function saveFormData() {
      try {
        localStorage.setItem('provider-signup-data', JSON.stringify(this.formData));
      } catch (e) {
        console.error('Failed to save form data', e);
      }
    }
  }, {
    key: "init",
    value: function init() {
      console.log('🎯 Wizard steps: initializing...');
      this.initNavigationButtons();
      this.initStepValidation();
      this.initProgressBar();
      this.showStep(0);

      // Exposer globalement
      window.wizardSteps = this;
      console.log('✅ Wizard steps initialized');
    }
  }, {
    key: "showStep",
    value: function showStep(stepIndex) {
      console.log("\uD83D\uDCCD Showing step ".concat(stepIndex + 1, "/").concat(this.totalSteps));

      // Vérifier que l'index est valide
      if (stepIndex < 0 || stepIndex >= this.totalSteps) {
        console.warn("\u26A0\uFE0F Invalid step index: ".concat(stepIndex));
        return;
      }

      // Cacher toutes les étapes
      for (var i = 0; i < this.totalSteps; i++) {
        var step = document.getElementById("step".concat(i + 1));
        if (step) {
          step.classList.add('hidden');
        }
      }

      // Afficher l'étape courante
      var currentStep = document.getElementById("step".concat(stepIndex + 1));
      if (currentStep) {
        currentStep.classList.remove('hidden');
        this.currentStep = stepIndex;
        this.updateProgressBar();
        this.updateNavigationButtons();
        console.log("\u2705 Step ".concat(stepIndex + 1, " displayed"));
      } else {
        console.error("\u274C Step ".concat(stepIndex + 1, " not found in DOM"));
      }
    }
  }, {
    key: "nextStep",
    value: function nextStep() {
      console.log("\u27A1\uFE0F Next clicked from step ".concat(this.currentStep + 1));
      if (!this.validateCurrentStep()) {
        console.warn("\u26A0\uFE0F Validation failed for step ".concat(this.currentStep + 1));
        return;
      }
      this.saveCurrentStepData();
      if (this.currentStep < this.totalSteps - 1) {
        this.showStep(this.currentStep + 1);
      } else {
        console.log('🎉 Last step reached, submitting...');
        this.submitForm();
      }
    }
  }, {
    key: "previousStep",
    value: function previousStep() {
      console.log("\u2B05\uFE0F Back clicked from step ".concat(this.currentStep + 1));
      if (this.currentStep > 0) {
        this.showStep(this.currentStep - 1);
      }
    }
  }, {
    key: "validateCurrentStep",
    value: function validateCurrentStep() {
      var currentStepEl = document.getElementById("step".concat(this.currentStep + 1));
      if (!currentStepEl) {
        console.warn("Step ".concat(this.currentStep + 1, " element not found"));
        return true;
      }

      // Pour l'instant, on retourne toujours true pour permettre la navigation
      // La vraie validation sera ajoutée plus tard step par step
      return true;
    }
  }, {
    key: "saveCurrentStepData",
    value: function saveCurrentStepData() {
      var _this = this;
      var currentStepEl = document.getElementById("step".concat(this.currentStep + 1));
      if (!currentStepEl) return;
      var inputs = currentStepEl.querySelectorAll('input, select, textarea');
      inputs.forEach(function (input) {
        if (input.type === 'checkbox' || input.type === 'radio') {
          if (input.checked) {
            if (!_this.formData[input.name]) _this.formData[input.name] = [];
            if (Array.isArray(_this.formData[input.name])) {
              if (!_this.formData[input.name].includes(input.value)) {
                _this.formData[input.name].push(input.value);
              }
            }
          }
        } else {
          if (input.value) {
            _this.formData[input.name] = input.value;
          }
        }
      });
      this.saveFormData();
      console.log("\uD83D\uDCBE Step ".concat(this.currentStep + 1, " data saved"));
    }
  }, {
    key: "updateProgressBar",
    value: function updateProgressBar() {
      var percentage = (this.currentStep + 1) / this.totalSteps * 100;

      // Mobile progress bar
      var mobileBar = document.getElementById('mobileProgressBar');
      if (mobileBar) {
        mobileBar.style.width = "".concat(percentage, "%");
      }

      // Step number
      var stepNum = document.getElementById('currentStepNum');
      if (stepNum) {
        stepNum.textContent = this.currentStep + 1;
      }

      // Percentage
      var percentageEl = document.getElementById('progressPercentage');
      if (percentageEl) {
        percentageEl.textContent = Math.round(percentage);
      }
      console.log("\uD83D\uDCCA Progress: ".concat(Math.round(percentage), "%"));
    }
  }, {
    key: "updateNavigationButtons",
    value: function updateNavigationButtons() {
      var _this2 = this;
      // Boutons Back
      var backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
      backButtons.forEach(function (btn) {
        if (_this2.currentStep === 0) {
          btn.style.display = 'none';
        } else {
          btn.style.display = 'flex';
        }
      });

      // Boutons Next
      var nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
      nextButtons.forEach(function (btn) {
        if (_this2.currentStep === _this2.totalSteps - 1) {
          btn.querySelector('span').textContent = 'Submit';
        } else {
          btn.querySelector('span').textContent = 'Continue';
        }

        // Pour l'instant on garde les boutons toujours actifs
        btn.disabled = false;
        btn.classList.remove('opacity-50');
      });
      console.log("\uD83D\uDD18 Navigation buttons updated for step ".concat(this.currentStep + 1));
    }
  }, {
    key: "initNavigationButtons",
    value: function initNavigationButtons() {
      var _this3 = this;
      // Boutons Next
      var nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
      nextButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          console.log('🖱️ Next button clicked');
          _this3.nextStep();
        });
      });

      // Boutons Back
      var backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
      backButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          console.log('🖱️ Back button clicked');
          _this3.previousStep();
        });
      });
      console.log('✅ Navigation buttons attached');
    }
  }, {
    key: "initStepValidation",
    value: function initStepValidation() {
      var _this4 = this;
      // Écouter les changements dans tous les steps
      for (var i = 1; i <= this.totalSteps; i++) {
        var step = document.getElementById("step".concat(i));
        if (step) {
          step.addEventListener('input', function () {
            _this4.updateNavigationButtons();
          });
          step.addEventListener('change', function () {
            _this4.updateNavigationButtons();
          });
        }
      }
      console.log('✅ Step validation listeners attached');
    }
  }, {
    key: "initProgressBar",
    value: function initProgressBar() {
      this.updateProgressBar();
      console.log('✅ Progress bar initialized');
    }
  }, {
    key: "submitForm",
    value: function submitForm() {
      console.log('📤 Submitting form...', this.formData);
      // Logique de soumission à implémenter
      alert('Form submission not yet implemented');
    }
  }]);
}();
function initializeWizardSteps() {
  var wizardSteps = new WizardSteps();
  wizardSteps.init();

  // Exposer globalement pour usage externe
  window.providerWizardSteps = wizardSteps;
  return wizardSteps;
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*************************************!*\
  !*** ./resources/js/header-init.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_wizard_core_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/wizard-core.js */ "./resources/js/modules/wizard-core.js");
/* harmony import */ var _modules_wizard_steps_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/wizard-steps.js */ "./resources/js/modules/wizard-steps.js");
/* harmony import */ var _modules_mobile_menu_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/mobile-menu.js */ "./resources/js/modules/mobile-menu.js");
/* harmony import */ var _modules_language_manager_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/language-manager.js */ "./resources/js/modules/language-manager.js");
/* harmony import */ var _modules_category_popups_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/category-popups.js */ "./resources/js/modules/category-popups.js");
/* harmony import */ var _modules_scroll_utils_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/scroll-utils.js */ "./resources/js/modules/scroll-utils.js");
/**
 * Header Initialization - Laravel Mix Compatible
 * Point d'entrée principal pour tous les modules header
 */

// Import des modules







// Attendre que DOM soit prêt
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeAll);
} else {
  initializeAll();
}
function initializeAll() {
  console.log('🚀 Initializing header modules...');

  // 1. Wizard Core
  (0,_modules_wizard_core_js__WEBPACK_IMPORTED_MODULE_0__.initializeWizard)();

  // 2. Wizard Steps
  (0,_modules_wizard_steps_js__WEBPACK_IMPORTED_MODULE_1__.initializeWizardSteps)();

  // 3. Mobile Menu
  (0,_modules_mobile_menu_js__WEBPACK_IMPORTED_MODULE_2__.initializeMobileMenu)();

  // 4. Language Manager
  (0,_modules_language_manager_js__WEBPACK_IMPORTED_MODULE_3__.initializeLanguageManager)();

  // 5. Category Popups
  (0,_modules_category_popups_js__WEBPACK_IMPORTED_MODULE_4__.initializeCategoryPopups)();

  // 6. Scroll Utils
  (0,_modules_scroll_utils_js__WEBPACK_IMPORTED_MODULE_5__.initializeScrollUtils)();

  // 8. Synchro boutons après interactions
  ['click', 'input', 'change'].forEach(function (evt) {
    document.addEventListener(evt, function () {
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
      if (window.providerWizard && typeof window.providerWizard.update === 'function') {
        window.providerWizard.update();
      }
    }, true);
  });

  // 9. Validation Step 2 renforcée
  window.validateStep = function (orig) {
    return function (i) {
      if (i === 1) {
        if (document.querySelector('#step2 input[type="radio"]:checked')) return true;
        if (document.querySelector('#step2 .language-card.selected, #step2 .language-card[aria-checked="true"]')) return true;
        if (document.querySelector('#step2 .lang-btn.bg-blue-900, #step2 .lang-btn[aria-pressed="true"], #step2 .lang-btn.selected, #step2 .lang-btn.text-white')) return true;
        return false;
      }
      return orig ? orig(i) : true;
    };
  }(window.validateStep);
  console.log('✅ All header modules initialized');
}
})();

/******/ })()
;