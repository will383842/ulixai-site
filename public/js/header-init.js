/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/modules/google-translate/index.js":
/*!********************************************************!*\
  !*** ./resources/js/modules/google-translate/index.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   GoogleTranslateInit: () => (/* reexport safe */ _init_js__WEBPACK_IMPORTED_MODULE_0__.GoogleTranslateInit),
/* harmony export */   LanguageManager: () => (/* reexport safe */ _language_manager_js__WEBPACK_IMPORTED_MODULE_1__.LanguageManager),
/* harmony export */   initializeGoogleTranslateModule: () => (/* binding */ initializeGoogleTranslateModule),
/* harmony export */   injectGoogleTranslateStyles: () => (/* reexport safe */ _styles_js__WEBPACK_IMPORTED_MODULE_2__.injectGoogleTranslateStyles),
/* harmony export */   isGoogleTranslateEnabled: () => (/* binding */ isGoogleTranslateEnabled),
/* harmony export */   removeGoogleTranslateStyles: () => (/* reexport safe */ _styles_js__WEBPACK_IMPORTED_MODULE_2__.removeGoogleTranslateStyles),
/* harmony export */   unloadGoogleTranslateModule: () => (/* binding */ unloadGoogleTranslateModule)
/* harmony export */ });
/* harmony import */ var _init_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./init.js */ "./resources/js/modules/google-translate/init.js");
/* harmony import */ var _language_manager_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./language-manager.js */ "./resources/js/modules/google-translate/language-manager.js");
/* harmony import */ var _styles_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./styles.js */ "./resources/js/modules/google-translate/styles.js");
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
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





/**
 * Main initialization function for the entire Google Translate module
 * Handles the complete setup in the correct order
 * 
 * @returns {Promise<Object>} Module instances
 */
function initializeGoogleTranslateModule() {
  return _initializeGoogleTranslateModule.apply(this, arguments);
}

/**
 * Check if Google Translate module is enabled
 * Useful for conditional loading
 * 
 * @returns {boolean} True if enabled
 */
function _initializeGoogleTranslateModule() {
  _initializeGoogleTranslateModule = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
    var gtInit, languageManager, _t;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.p = _context.n) {
        case 0:
          console.log('🌐 [GoogleTranslateModule] Starting initialization...');
          _context.p = 1;
          // Step 0: Inject CSS styles first (must be done before Google loads)
          console.log('📦 [GoogleTranslateModule] Step 0/3: Injecting styles...');
          (0,_styles_js__WEBPACK_IMPORTED_MODULE_2__.injectGoogleTranslateStyles)();

          // Step 1: Initialize Google Translate API
          console.log('📦 [GoogleTranslateModule] Step 1/3: Loading Google Translate API...');
          gtInit = new _init_js__WEBPACK_IMPORTED_MODULE_0__.GoogleTranslateInit();
          _context.n = 2;
          return gtInit.init();
        case 2:
          // Step 2: Initialize Language Manager UI
          console.log('📦 [GoogleTranslateModule] Step 2/3: Initializing language UI...');
          languageManager = new _language_manager_js__WEBPACK_IMPORTED_MODULE_1__.LanguageManager();
          _context.n = 3;
          return languageManager.init();
        case 3:
          // Step 3: Expose globally for debugging
          console.log('📦 [GoogleTranslateModule] Step 3/3: Exposing global references...');
          window.ulixaiGoogleTranslate = {
            init: gtInit,
            languageManager: languageManager,
            version: '1.0.0'
          };
          console.log('✅ [GoogleTranslateModule] Initialization complete');
          console.log('🔍 [GoogleTranslateModule] Available at: window.ulixaiGoogleTranslate');
          return _context.a(2, {
            init: gtInit,
            languageManager: languageManager
          });
        case 4:
          _context.p = 4;
          _t = _context.v;
          console.error('❌ [GoogleTranslateModule] Initialization failed:', _t);
          throw _t;
        case 5:
          return _context.a(2);
      }
    }, _callee, null, [[1, 4]]);
  }));
  return _initializeGoogleTranslateModule.apply(this, arguments);
}
function isGoogleTranslateEnabled() {
  // Could check config, environment variables, feature flags, etc.
  return true;
}

/**
 * Unload Google Translate module (for cleanup or future replacement)
 * Removes scripts, styles, and global references
 */
function unloadGoogleTranslateModule() {
  console.log('🗑️ [GoogleTranslateModule] Unloading...');

  // Remove script
  var script = document.getElementById('google-translate-script');
  if (script) {
    script.remove();
    console.log('✅ [GoogleTranslateModule] Script removed');
  }

  // Remove styles
  var styles = document.getElementById('google-translate-styles');
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




/***/ }),

/***/ "./resources/js/modules/google-translate/init.js":
/*!*******************************************************!*\
  !*** ./resources/js/modules/google-translate/init.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   GoogleTranslateInit: () => (/* binding */ GoogleTranslateInit),
/* harmony export */   initializeGoogleTranslate: () => (/* binding */ initializeGoogleTranslate)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Google Translate Initialization
 * Loads and configures the Google Translate API
 * 
 * @module google-translate/init
 */

var GoogleTranslateInit = /*#__PURE__*/function () {
  function GoogleTranslateInit() {
    _classCallCheck(this, GoogleTranslateInit);
    this.isReady = false;
    this.scriptLoaded = false;
  }

  /**
   * Initialize Google Translate
   */
  return _createClass(GoogleTranslateInit, [{
    key: "init",
    value: (function () {
      var _init = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              console.log('🌐 [GoogleTranslateInit] Starting initialization...');

              // Setup callback
              this.setupCallback();

              // Load script
              _context.n = 1;
              return this.loadScript();
            case 1:
              _context.n = 2;
              return this.waitForReady();
            case 2:
              // Apply stored language
              this.applyStoredLanguage();
              console.log('✅ [GoogleTranslateInit] Initialization complete');
            case 3:
              return _context.a(2);
          }
        }, _callee, this);
      }));
      function init() {
        return _init.apply(this, arguments);
      }
      return init;
    }()
    /**
     * Setup global callback for Google Translate
     */
    )
  }, {
    key: "setupCallback",
    value: function setupCallback() {
      var _this = this;
      window.googleTranslateElementInit = function () {
        console.log('🌐 [GoogleTranslate] Callback triggered by Google');
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,fr,de,ru,zh-CN,es,pt,ar,hi',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
          autoDisplay: false
        }, 'google_translate_element');
        window.googleTranslateReady = true;
        window.dispatchEvent(new Event('googleTranslateReady'));
        _this.isReady = true;
        console.log('✅ [GoogleTranslate] API ready');
      };
    }

    /**
     * Load Google Translate script
     */
  }, {
    key: "loadScript",
    value: function loadScript() {
      var _this2 = this;
      return new Promise(function (resolve, reject) {
        // Check if already loaded
        if (document.getElementById('google-translate-script')) {
          console.log('ℹ️ [GoogleTranslate] Script already loaded');
          resolve();
          return;
        }
        console.log('📥 [GoogleTranslate] Loading script...');
        var script = document.createElement('script');
        script.id = 'google-translate-script';
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        script.async = true;
        script.onload = function () {
          _this2.scriptLoaded = true;
          console.log('✅ [GoogleTranslate] Script loaded');
          resolve();
        };
        script.onerror = function () {
          console.error('❌ [GoogleTranslate] Failed to load script');
          reject(new Error('Failed to load Google Translate'));
        };
        document.body.appendChild(script);
      });
    }

    /**
     * Wait for Google Translate to be ready
     */
  }, {
    key: "waitForReady",
    value: function waitForReady() {
      var _this3 = this;
      var timeout = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 10000;
      return new Promise(function (resolve) {
        if (window.googleTranslateReady) {
          _this3.isReady = true;
          resolve();
          return;
        }
        var timeoutId = setTimeout(function () {
          console.warn('⚠️ [GoogleTranslate] Timeout waiting for ready');
          resolve(); // Continue anyway
        }, timeout);
        window.addEventListener('googleTranslateReady', function () {
          clearTimeout(timeoutId);
          _this3.isReady = true;
          resolve();
        }, {
          once: true
        });
      });
    }

    /**
     * Apply stored language on page load
     */
  }, {
    key: "applyStoredLanguage",
    value: function applyStoredLanguage() {
      var savedLang = localStorage.getItem('ulixai_lang') || 'en';
      if (savedLang !== 'en') {
        window.location.hash = "googtrans(en|".concat(savedLang, ")");
        console.log("\uD83C\uDF10 [GoogleTranslate] Applied stored language: ".concat(savedLang));
      }
    }
  }]);
}();

/**
 * Initialize Google Translate (convenience function)
 */
function initializeGoogleTranslate() {
  return _initializeGoogleTranslate.apply(this, arguments);
}
function _initializeGoogleTranslate() {
  _initializeGoogleTranslate = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2() {
    var gtInit;
    return _regenerator().w(function (_context2) {
      while (1) switch (_context2.n) {
        case 0:
          gtInit = new GoogleTranslateInit();
          _context2.n = 1;
          return gtInit.init();
        case 1:
          return _context2.a(2, gtInit);
      }
    }, _callee2);
  }));
  return _initializeGoogleTranslate.apply(this, arguments);
}

/***/ }),

/***/ "./resources/js/modules/google-translate/language-manager.js":
/*!*******************************************************************!*\
  !*** ./resources/js/modules/google-translate/language-manager.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   LanguageManager: () => (/* binding */ LanguageManager),
/* harmony export */   initializeLanguageManager: () => (/* binding */ initializeLanguageManager)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Language Manager
 * Handles language selector UI and user interactions
 * 
 * @module google-translate/language-manager
 */

var LanguageManager = /*#__PURE__*/function () {
  function LanguageManager() {
    _classCallCheck(this, LanguageManager);
    // Configuration stricte des langues - CHEMINS ABSOLUS AVEC SLASH INITIAL
    this.languages = {
      'en': {
        code: 'en',
        label: 'English',
        flag: '/images/flags/us.svg',
        // ✅ Slash initial ajouté
        country: 'United States'
      },
      'fr': {
        code: 'fr',
        label: 'Français',
        flag: '/images/flags/fr.svg',
        // ✅ Slash initial ajouté
        country: 'France'
      },
      'de': {
        code: 'de',
        label: 'Deutsch',
        flag: '/images/flags/de.svg',
        // ✅ Slash initial ajouté
        country: 'Deutschland'
      },
      'ru': {
        code: 'ru',
        label: 'Русский',
        flag: '/images/flags/ru.svg',
        // ✅ Slash initial ajouté
        country: 'Россия'
      },
      'zh-CN': {
        code: 'zh-CN',
        label: '中文',
        flag: '/images/flags/cn.svg',
        // ✅ Slash initial ajouté
        country: '中国'
      },
      'es': {
        code: 'es',
        label: 'Español',
        flag: '/images/flags/es.svg',
        // ✅ Slash initial ajouté
        country: 'España'
      },
      'pt': {
        code: 'pt',
        label: 'Português',
        flag: '/images/flags/pt.svg',
        // ✅ Slash initial ajouté
        country: 'Portugal'
      },
      'ar': {
        code: 'ar',
        label: 'العربية',
        flag: '/images/flags/sa.svg',
        // ✅ Slash initial ajouté
        country: 'السعودية'
      },
      'hi': {
        code: 'hi',
        label: 'हिन्दी',
        flag: '/images/flags/in.svg',
        // ✅ Slash initial ajouté
        country: 'भारत'
      }
    };

    // Récupérer la langue stockée (SEULE SOURCE DE VÉRITÉ)
    this.selectedLang = localStorage.getItem('ulixai_lang') || 'en';

    // TOUJOURS recalculer le drapeau et le label depuis la langue
    var langConfig = this.languages[this.selectedLang];
    if (langConfig) {
      this.selectedFlag = langConfig.flag;
      this.selectedLabel = langConfig.label;
    } else {
      // Fallback si langue invalide
      this.selectedLang = 'en';
      this.selectedFlag = this.languages['en'].flag;
      this.selectedLabel = this.languages['en'].label;
    }
  }

  /**
   * Initialize language manager
   */
  return _createClass(LanguageManager, [{
    key: "init",
    value: (function () {
      var _init = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              console.log('🌐 [LangManager] Initializing UI...');
              _context.n = 1;
              return this.waitForDOM();
            case 1:
              this.initDesktopLanguageSelector();
              this.initMobileLanguageSelector();
              console.log('✅ [LangManager] UI initialized');
            case 2:
              return _context.a(2);
          }
        }, _callee, this);
      }));
      function init() {
        return _init.apply(this, arguments);
      }
      return init;
    }()
    /**
     * Wait for DOM to be ready
     */
    )
  }, {
    key: "waitForDOM",
    value: function waitForDOM() {
      return new Promise(function (resolve) {
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', resolve, {
            once: true
          });
        } else {
          resolve();
        }
      });
    }

    /**
     * Initialize desktop language selector
     */
  }, {
    key: "initDesktopLanguageSelector",
    value: function initDesktopLanguageSelector() {
      var _this = this;
      var langBtn = document.getElementById('langBtn');
      var langMenu = document.getElementById('langMenu');
      var langFlag = document.getElementById('langFlag');
      var langChevron = document.getElementById('langChevron');
      if (!langBtn || !langMenu || !langFlag) {
        console.warn('⚠️ [LangManager] Desktop elements not found');
        return;
      }
      console.log('✅ [LangManager] Desktop selector found');
      var isOpen = false;

      // Toggle menu
      langBtn.addEventListener('click', function (e) {
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
      langMenu.addEventListener('click', function (e) {
        var li = e.target.closest('li[data-lang]');
        if (!li) return;
        var langCode = li.getAttribute('data-lang');
        if (langCode && _this.languages[langCode]) {
          console.log('🌐 [LangManager] Desktop language selected:', langCode);
          var langConfig = _this.languages[langCode];

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
          _this.setLanguage(langCode);
        }
      });

      // Close on outside click
      document.addEventListener('click', function (e) {
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
  }, {
    key: "initMobileLanguageSelector",
    value: function initMobileLanguageSelector() {
      var _this2 = this;
      var modalBtn = document.getElementById('mobileLangBtn');
      var modal = document.getElementById('mobileLangModal');
      var sheet = document.getElementById('mobileLangSheet');
      var overlay = document.getElementById('mobileLangOverlay');
      var closeBtn = document.getElementById('mobileLangCloseBtn');
      var flag = document.getElementById('mobileLangFlag');
      var label = document.getElementById('mobileLangLabel');
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
      var openModal = function openModal() {
        if (!modal || !sheet || !overlay) return;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
          overlay.classList.remove('opacity-0');
          overlay.classList.add('opacity-100');
          sheet.classList.remove('translate-y-full');
          sheet.classList.add('translate-y-0');
        }, 10);
        console.log('✅ [LangManager] Mobile modal opened');
      };

      // Close modal
      var closeModal = function closeModal() {
        if (!modal || !sheet || !overlay) return;
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');
        sheet.classList.remove('translate-y-0');
        sheet.classList.add('translate-y-full');
        setTimeout(function () {
          modal.classList.add('hidden');
          document.body.style.overflow = '';
        }, 400);
        console.log('✅ [LangManager] Mobile modal closed');
      };

      // Button click to open
      modalBtn.addEventListener('click', function (e) {
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
      var langOptions = document.querySelectorAll('.lang-option');
      if (langOptions.length === 0) {
        console.warn('⚠️ [LangManager] No .lang-option elements found');
        return;
      }
      console.log("\u2705 [LangManager] Found ".concat(langOptions.length, " language options"));
      langOptions.forEach(function (option) {
        option.addEventListener('click', function (e) {
          e.stopPropagation();
          var langCode = option.getAttribute('data-lang');
          if (langCode && _this2.languages[langCode]) {
            console.log('🌐 [LangManager] Mobile language selected:', langCode);
            var langConfig = _this2.languages[langCode];

            // Update UI immédiatement
            if (flag) flag.src = langConfig.flag;
            if (label) label.textContent = langConfig.label;

            // Visual feedback
            langOptions.forEach(function (opt) {
              opt.classList.remove('bg-blue-100', 'border-blue-300');
            });
            option.classList.add('bg-blue-100', 'border-blue-300');

            // Close modal after short delay
            setTimeout(function () {
              closeModal();
              // Apply language
              _this2.setLanguage(langCode);
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
  }, {
    key: "setLanguage",
    value: function setLanguage(langCode) {
      console.log('🔄 [LangManager] Changing language to:', langCode);

      // Validation
      if (!this.languages[langCode]) {
        console.error('❌ [LangManager] Invalid language code:', langCode);
        return;
      }
      var langConfig = this.languages[langCode];

      // Update storage (SEULEMENT le code langue)
      localStorage.setItem('ulixai_lang', langCode);

      // SUPPRIMER les anciennes clés pour éviter les conflits
      localStorage.removeItem('selectedFlag');
      localStorage.removeItem('selectedLabel');
      localStorage.removeItem('ulixai_flag');

      // Set cookies for Google Translate
      this.setCookiesForLanguage(langCode);

      // Set hash for immediate translation
      window.location.hash = langCode === 'en' ? '' : "#googtrans(en|".concat(langCode, ")");

      // Reload page to apply translation
      console.log('🔄 [LangManager] Reloading page...');
      console.log('🔍 [LangManager] New config:', {
        code: langCode,
        label: langConfig.label,
        flag: langConfig.flag
      });
      setTimeout(function () {
        window.location.reload();
      }, 200);
    }

    /**
     * Set cookies for Google Translate
     */
  }, {
    key: "setCookiesForLanguage",
    value: function setCookiesForLanguage(langCode) {
      var expires = new Date(Date.now() + 365 * 864e5).toUTCString();
      if (langCode === 'en') {
        // Clear cookies for English
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        console.log('🗑️ [LangManager] Cookies cleared for English');
      } else {
        // Set cookies for other languages
        var val = "/en/".concat(langCode);
        document.cookie = "googtrans=".concat(val, "; expires=").concat(expires, "; path=/");
        document.cookie = "googtransopt=".concat(val, "; expires=").concat(expires, "; path=/");
        console.log('✅ [LangManager] Cookies set:', val);
      }
    }
  }]);
}();

/**
 * Initialize language manager (convenience function)
 */
function initializeLanguageManager() {
  console.log('🚀 [LangManager] Starting initialization...');
  var languageManager = new LanguageManager();
  languageManager.init();

  // Expose globally for debugging
  window.providerLanguageManager = languageManager;
  return languageManager;
}

/***/ }),

/***/ "./resources/js/modules/google-translate/styles.js":
/*!*********************************************************!*\
  !*** ./resources/js/modules/google-translate/styles.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   injectGoogleTranslateStyles: () => (/* binding */ injectGoogleTranslateStyles),
/* harmony export */   removeGoogleTranslateStyles: () => (/* binding */ removeGoogleTranslateStyles)
/* harmony export */ });
/**
 * Google Translate CSS Styles
 * Hides all Google Translate UI elements for a clean interface
 */

/**
 * Inject Google Translate styles into the document
 * These styles hide Google's default UI elements
 */
function injectGoogleTranslateStyles() {
  var styleId = 'google-translate-styles';

  // Don't inject twice
  if (document.getElementById(styleId)) {
    console.log('ℹ️ [GoogleTranslate] Styles already injected');
    return;
  }
  console.log('🎨 [GoogleTranslate] Injecting styles...');
  var styles = "\n    /* \u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\n       \uD83C\uDF10 GOOGLE TRANSLATE - HIDE UI ELEMENTS\n       \u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501\u2501 */\n\n    /* Hide top banner frame */\n    iframe.goog-te-banner-frame,\n    .goog-te-banner-frame {\n      display: none !important;\n    }\n\n    /* Hide skiptranslate wrapper */\n    body > .skiptranslate {\n      display: none !important;\n      height: 0 !important;\n      overflow: hidden !important;\n    }\n\n    /* Reset Google's margin adjustments */\n    html {\n      margin-top: 0 !important;\n    }\n\n    body {\n      top: 0 !important;\n      position: static !important;\n    }\n\n    /* Hide inline toolbar and popup */\n    .goog-te-gadget,\n    #goog-gt-tt,\n    .goog-te-balloon-frame {\n      height: 0 !important;\n      overflow: hidden !important;\n      display: none !important;\n      visibility: hidden !important;\n      opacity: 0 !important;\n    }\n\n    /* Hide all Google Translate UI elements */\n    .VIpgJd-ZVi9od-ORHb,\n    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,\n    .VIpgJd-ZVi9od-ORHb-OEVmcd,\n    .VIpgJd-ZVi9od-ORHb-hFsbo,\n    .VIpgJd-ZVi9od-l4eHX-hSRGPd {\n      display: none !important;\n      visibility: hidden !important;\n      opacity: 0 !important;\n    }\n  ";
  var styleElement = document.createElement('style');
  styleElement.id = styleId;
  styleElement.textContent = styles;
  document.head.appendChild(styleElement);
  console.log('✅ [GoogleTranslate] Styles injected');
}

/**
 * Remove Google Translate styles (for cleanup)
 */
function removeGoogleTranslateStyles() {
  var styleElement = document.getElementById('google-translate-styles');
  if (styleElement) {
    styleElement.remove();
    console.log('🗑️ [GoogleTranslate] Styles removed');
  }
}

/***/ }),

/***/ "./resources/js/modules/ui/category/category-popups.js":
/*!*************************************************************!*\
  !*** ./resources/js/modules/ui/category/category-popups.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initializeCategoryPopups: () => (/* binding */ initializeCategoryPopups)
/* harmony export */ });
/* harmony import */ var _categoryColors_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./categoryColors.js */ "./resources/js/modules/ui/category/categoryColors.js");
/* harmony import */ var _categoryIcons_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./categoryIcons.js */ "./resources/js/modules/ui/category/categoryIcons.js");
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }


var CONFIG = {
  GRID: {
    MOBILE_COLUMNS: 'repeat(2, 1fr)',
    DESKTOP_COLUMNS: 'repeat(3, 1fr)',
    GAP: '0.75rem',
    BREAKPOINT: 768
  },
  ICONS: {
    MOBILE_SIZE: 'w-12 h-12',
    DESKTOP_SIZE: 'w-14 h-14'
  },
  CACHE_DURATION: 300000
};
var cache = new Map();
function isMobile() {
  return window.innerWidth < CONFIG.GRID.BREAKPOINT;
}
function setupGrid(container) {
  var cols = isMobile() ? CONFIG.GRID.MOBILE_COLUMNS : CONFIG.GRID.DESKTOP_COLUMNS;
  container.style.cssText = "display: grid; grid-template-columns: ".concat(cols, "; gap: ").concat(CONFIG.GRID.GAP, ";");
}
function createCard(item, level, allIds, onClick) {
  var parentId = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 'root';
  var card = document.createElement('button');
  card.type = 'button';
  card.className = 'category-card rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-xl cursor-pointer group transition-all duration-300';

  // ✅ IMPORTANT : Attribut translate="yes" pour Google Translate
  card.setAttribute('translate', 'yes');
  var iconColor = (0,_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.getCategoryColorByLevel)(level, item.id, allIds);
  var iconSize = isMobile() ? CONFIG.ICONS.MOBILE_SIZE : CONFIG.ICONS.DESKTOP_SIZE;
  var iconSVG = (0,_categoryIcons_js__WEBPACK_IMPORTED_MODULE_1__.getCategoryIcon)(item.name, item.id, parentId);
  card.style.cssText = "\n    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);\n    display: flex;\n    flex-direction: column;\n    align-items: center;\n    text-align: center;\n  ";
  card.innerHTML = "\n    <div class=\"".concat(iconSize, " rounded-full mb-2 flex-shrink-0\" style=\"background-color: ").concat(iconColor, "; display: flex; align-items: center; justify-content: center;\">\n      <div class=\"w-8 h-8 text-white\">").concat(iconSVG, "</div>\n    </div>\n    <div class=\"text-xs font-semibold text-gray-800\" translate=\"yes\">").concat(item.name, "</div>\n  ");
  card.onclick = function () {
    return onClick(item.id, item.name);
  };
  return card;
}
function render(items, selector, level, handler) {
  var parentId = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : 'root';
  var container = document.querySelector(selector);
  if (!container) {
    console.warn("\u274C Container not found: ".concat(selector));
    return;
  }
  console.log("\uD83C\uDFA8 Rendering ".concat(items.length, " items in ").concat(selector));
  container.innerHTML = '';
  container.setAttribute('translate', 'yes');
  setupGrid(container);
  var fragment = document.createDocumentFragment();
  var allIds = items.map(function (i) {
    return i.id;
  });
  items.forEach(function (item) {
    fragment.appendChild(createCard(item, level, allIds, handler, parentId));
  });
  container.appendChild(fragment);

  // ✅ ENLEVÉ : Plus d'appels à forceTranslateDynamicContent()
  // Google Translate va automatiquement détecter et traduire les éléments
  // avec translate="yes"

  console.log("\u2705 Rendered ".concat(items.length, " categories"));
}
function fetchData(_x) {
  return _fetchData.apply(this, arguments);
}
function _fetchData() {
  _fetchData = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee4(url) {
    var cached, res, data;
    return _regenerator().w(function (_context4) {
      while (1) switch (_context4.n) {
        case 0:
          cached = cache.get(url);
          if (!(cached && Date.now() - cached.time < CONFIG.CACHE_DURATION)) {
            _context4.n = 1;
            break;
          }
          console.log("\uD83D\uDCE6 Using cached data for ".concat(url));
          return _context4.a(2, cached.data);
        case 1:
          console.log("\uD83C\uDF10 Fetching data from ".concat(url));
          _context4.n = 2;
          return fetch(url);
        case 2:
          res = _context4.v;
          _context4.n = 3;
          return res.json();
        case 3:
          data = _context4.v;
          cache.set(url, {
            data: data,
            time: Date.now()
          });
          return _context4.a(2, data);
      }
    }, _callee4);
  }));
  return _fetchData.apply(this, arguments);
}
function initializeCategoryPopups() {
  console.log('🚀 Initializing category popups...');
  window.openHelpPopup = /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
    var popup, container, data, _t;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.p = _context.n) {
        case 0:
          popup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId);
          container = popup === null || popup === void 0 ? void 0 : popup.querySelector(".".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.containerClass));
          if (!(!popup || !container)) {
            _context.n = 1;
            break;
          }
          console.error('❌ Popup or container not found');
          return _context.a(2);
        case 1:
          console.log('📂 Opening main categories popup');

          // Ouvrir immédiatement
          popup.classList.remove('hidden');

          // Loader
          container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
          _context.p = 2;
          _context.n = 3;
          return fetchData('/api/categories');
        case 3:
          data = _context.v;
          if (!(data !== null && data !== void 0 && data.success)) {
            _context.n = 4;
            break;
          }
          console.log("\u2705 Loaded ".concat(data.categories.length, " main categories"));
          render(data.categories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.containerClass), 'main', window.handleCategoryClick, 'root');
          _context.n = 5;
          break;
        case 4:
          throw new Error('Invalid API response');
        case 5:
          _context.n = 7;
          break;
        case 6:
          _context.p = 6;
          _t = _context.v;
          console.error('❌ Error loading categories:', _t);
          container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Error loading categories</div>';
        case 7:
          return _context.a(2);
      }
    }, _callee, null, [[2, 6]]);
  }));
  window.handleCategoryClick = /*#__PURE__*/function () {
    var _ref2 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2(id, name) {
      var mainPopup, subPopup, container, data, _t2;
      return _regenerator().w(function (_context2) {
        while (1) switch (_context2.p = _context2.n) {
          case 0:
            mainPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId);
            subPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId);
            container = subPopup === null || subPopup === void 0 ? void 0 : subPopup.querySelector(".".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.containerClass));
            if (mainPopup) mainPopup.classList.add('hidden');
            if (!(!subPopup || !container)) {
              _context2.n = 1;
              break;
            }
            return _context2.a(2);
          case 1:
            console.log("\uD83D\uDCC2 Opening subcategories for: ".concat(name, " (").concat(id, ")"));
            subPopup.classList.remove('hidden');
            container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
            localStorage.setItem('create-request', JSON.stringify({
              category: JSON.stringify({
                id: id,
                name: name
              })
            }));
            _context2.p = 2;
            _context2.n = 3;
            return fetchData("/api/categories/".concat(id, "/subcategories"));
          case 3:
            data = _context2.v;
            if (data !== null && data !== void 0 && data.success) {
              console.log("\u2705 Loaded ".concat(data.subcategories.length, " subcategories"));
              render(data.subcategories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.containerClass), 'sub', window.handleSubcategoryClick, id);
            }
            _context2.n = 5;
            break;
          case 4:
            _context2.p = 4;
            _t2 = _context2.v;
            console.error('❌ Error loading subcategories:', _t2);
            container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Error loading subcategories</div>';
          case 5:
            return _context2.a(2);
        }
      }, _callee2, null, [[2, 4]]);
    }));
    return function (_x2, _x3) {
      return _ref2.apply(this, arguments);
    };
  }();
  window.handleSubcategoryClick = /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3(id, name) {
      var req, _data$subcategories, data, subPopup, childPopup, container, _t3;
      return _regenerator().w(function (_context3) {
        while (1) switch (_context3.p = _context3.n) {
          case 0:
            req = JSON.parse(localStorage.getItem('create-request') || '{}');
            req.sub_category = JSON.stringify({
              id: id,
              name: name
            });
            localStorage.setItem('create-request', JSON.stringify(req));
            console.log("\uD83D\uDCC2 Checking for child categories: ".concat(name, " (").concat(id, ")"));
            _context3.p = 1;
            _context3.n = 2;
            return fetchData("/api/categories/".concat(id, "/children"));
          case 2:
            data = _context3.v;
            if (!(data !== null && data !== void 0 && data.success && ((_data$subcategories = data.subcategories) === null || _data$subcategories === void 0 ? void 0 : _data$subcategories.length) > 0)) {
              _context3.n = 4;
              break;
            }
            console.log("\u2705 Found ".concat(data.subcategories.length, " child categories"));
            subPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId);
            childPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.popupId);
            container = childPopup === null || childPopup === void 0 ? void 0 : childPopup.querySelector(".".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.containerClass));
            if (subPopup) subPopup.classList.add('hidden');
            if (!(!childPopup || !container)) {
              _context3.n = 3;
              break;
            }
            return _context3.a(2);
          case 3:
            childPopup.classList.remove('hidden');
            container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
            render(data.subcategories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.containerClass), 'child', window.requestForHelp, id);
            _context3.n = 5;
            break;
          case 4:
            console.log('ℹ️ No child categories, redirecting to request form');
            window.requestForHelp(id, name);
          case 5:
            _context3.n = 7;
            break;
          case 6:
            _context3.p = 6;
            _t3 = _context3.v;
            console.error('❌ Error loading child categories:', _t3);
            window.requestForHelp(id, name);
          case 7:
            return _context3.a(2);
        }
      }, _callee3, null, [[1, 6]]);
    }));
    return function (_x4, _x5) {
      return _ref3.apply(this, arguments);
    };
  }();
  window.requestForHelp = function (id, name) {
    console.log("\u2705 Final selection: ".concat(name, " (").concat(id, ")"));
    var req = JSON.parse(localStorage.getItem('create-request') || '{}');
    req.child_category = JSON.stringify({
      id: id,
      name: name
    });
    localStorage.setItem('create-request', JSON.stringify(req));
    window.location.href = '/create-request';
  };

  // ═══════════════════════════════════════════════════════════
  // 🔁 FALLBACKS POUR LES FONCTIONS DE FERMETURE
  // ═══════════════════════════════════════════════════════════
  // Si pour une raison quelconque le <script> de popup_request_help.blade.php
  // ne s'exécute pas jusqu'au bout, on recrée ici les fonctions globales
  // attendues par les boutons "croix".

  if (typeof window.closeAllPopups !== 'function') {
    console.log('⚠️ [CategoryPopups] closeAllPopups not defined - creating fallback');
    window.closeAllPopups = function () {
      console.log('❌ [CategoryPopups] Closing all category popups (fallback)');

      // Fermer tous les popups de catégories
      Object.values(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels).forEach(function (level) {
        var popup = document.getElementById(level.popupId);
        if (popup) {
          popup.classList.add('hidden');
          popup.setAttribute('aria-hidden', 'true');
        }
      });

      // Clear localStorage
      localStorage.removeItem('create-request');

      // Rétablir le scroll du body
      document.body.style.overflow = '';
    };
  }
  if (typeof window.closeSearchPopup !== 'function') {
    console.log('⚠️ [CategoryPopups] closeSearchPopup not defined - creating fallback');
    window.closeSearchPopup = function () {
      console.log('❌ [CategoryPopups] Closing main search popup (fallback)');
      var popup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId);
      if (popup) {
        popup.classList.add('hidden');
        popup.setAttribute('aria-hidden', 'true');
      }

      // Rétablir le scroll du body
      document.body.style.overflow = '';
    };
  }

  // ═══════════════════════════════════════════════════════════
  // 🔁 Resize : recalcul de la grille si le popup est ouvert
  // ═══════════════════════════════════════════════════════════
  window.addEventListener('resize', function () {
    Object.values(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels).forEach(function (level) {
      var _document$getElementB;
      var container = document.querySelector("#".concat(level.popupId, " .").concat(level.containerClass));
      if (container && !((_document$getElementB = document.getElementById(level.popupId)) !== null && _document$getElementB !== void 0 && _document$getElementB.classList.contains('hidden'))) {
        setupGrid(container);
      }
    });
  }, {
    passive: true
  });
  console.log('✅ Category popups initialized');
}

/***/ }),

/***/ "./resources/js/modules/ui/category/categoryColors.js":
/*!************************************************************!*\
  !*** ./resources/js/modules/ui/category/categoryColors.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   categoryColors: () => (/* binding */ categoryColors),
/* harmony export */   categoryLevels: () => (/* binding */ categoryLevels),
/* harmony export */   getCategoryColor: () => (/* binding */ getCategoryColor),
/* harmony export */   getCategoryColorByLevel: () => (/* binding */ getCategoryColorByLevel),
/* harmony export */   testColorSystem: () => (/* binding */ testColorSystem),
/* harmony export */   validateColorDistinctness: () => (/* binding */ validateColorDistinctness)
/* harmony export */ });
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
// Système de couleurs optimisé avec distribution maximale et distinction visuelle
// Palette chaude et vive pour les catégories
var categoryColors = {
  // Palette de base : 100 couleurs chaudes et vives organisées par groupes de teintes
  palette: [
  // === ROUGES CHAUDS (10) - Tons vifs et énergiques ===
  '#FF4444', '#E63946', '#DC2626', '#EF4444', '#F87171', '#DC143C', '#FF6B6B', '#E74C3C', '#C0392B', '#D32F2F',
  // === ORANGES VIFS (10) - Tons chaleureux et dynamiques ===
  '#FF6B35', '#FF8C42', '#FFA500', '#FF8C00', '#FF7F50', '#F77F00', '#FB8500', '#FF9E40', '#FF8E53', '#FF9966',
  // === JAUNES DORÉS (10) - Tons lumineux et chaleureux ===
  '#FFD700', '#FFC300', '#FFB300', '#FFBA08', '#FAA307', '#FFC107', '#FFD54F', '#FFCA28', '#FFB74D', '#FFE082',
  // === CORAILS/SAUMONS (10) - Tons doux et chaleureux ===
  '#FF6F61', '#FA8072', '#FF7F7F', '#FFB6AB', '#FF9999', '#FFA07A', '#FFB6C1', '#FF9AA2', '#FFB3B3', '#FF8787',
  // === BLEUS VIFS (10) - Tons clairs et lumineux ===
  '#4A90E2', '#5DADE2', '#3498DB', '#5DADE2', '#85C1E9', '#6BB6FF', '#4FC3F7', '#42A5F5', '#64B5F6', '#7EC8E3',
  // === BLEUS PROFONDS (10) - Tons riches et intenses ===
  '#2E86DE', '#1E88E5', '#1976D2', '#2C3E50', '#1565C0', '#0D47A1', '#34495E', '#2471A3', '#1F618D', '#154360',
  // === VIOLETS/POURPRES (10) - Tons chauds et sophistiqués ===
  '#9B59B6', '#8E44AD', '#A569BD', '#AF7AC5', '#BB8FCE', '#7D3C98', '#6C3483', '#5B2C6F', '#884EA0', '#9C27B0',
  // === ROSES/FUCHSIAS (10) - Tons vibrants et énergiques ===
  '#E91E63', '#EC407A', '#F06292', '#F48FB1', '#FF4081', '#D81B60', '#C2185B', '#FF6B9D', '#FF69B4', '#DA70D6',
  // === MARRONS CHAUDS (10) - Tons terreux et confortables ===
  '#8B4513', '#A0522D', '#CD853F', '#D2691E', '#BC8F8F', '#A0826D', '#8D6E63', '#6D4C41', '#795548', '#937264',
  // === GRIS/TAUPES (10) - Tons neutres et élégants ===
  '#95A5A6', '#7F8C8D', '#546E7A', '#607D8B', '#78909C', '#90A4AE', '#B0BEC5', '#8E8E93', '#9E9E9E', '#BDBDBD']
};

/**
 * Génère un index stable basé sur un ID
 * Utilise une distribution uniforme pour maximiser l'écart entre les couleurs consécutives
 */
function generateOptimalColorIndex(id, totalColors) {
  var usedIndices = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : new Set();
  var str = String(id);
  var hash = 0;

  // Générer un hash stable
  for (var i = 0; i < str.length; i++) {
    var _char = str.charCodeAt(i);
    hash = (hash << 5) - hash + _char;
    hash = hash & hash;
  }
  hash = Math.abs(hash);

  // Distribution en saut d'indices pour maximiser la distinction
  // Utiliser un nombre premier pour garantir une bonne distribution
  var step = 37; // Nombre premier pour meilleure distribution
  var index = hash * step % totalColors;

  // Si l'index est déjà utilisé, trouver le suivant disponible
  var attempts = 0;
  while (usedIndices.has(index) && attempts < totalColors) {
    index = (index + step) % totalColors;
    attempts++;
  }
  return index;
}

/**
 * Calcule la luminosité d'une couleur (0-255)
 */
function getLuminance(hex) {
  var rgb = hexToRgb(hex);
  if (!rgb) return 128;

  // Formule de luminosité perceptuelle
  return 0.299 * rgb.r + 0.587 * rgb.g + 0.114 * rgb.b;
}

/**
 * Convertit une couleur hex en RGB
 */
function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

/**
 * Convertit RGB en hex
 */
function rgbToHex(r, g, b) {
  var toHex = function toHex(n) {
    var hex = Math.round(Math.max(0, Math.min(255, n))).toString(16);
    return hex.length === 1 ? '0' + hex : hex;
  };
  return "#".concat(toHex(r)).concat(toHex(g)).concat(toHex(b)).toUpperCase();
}

/**
 * Calcule la distance perceptuelle entre deux couleurs
 * Utilise la formule CIEDE2000 simplifiée
 */
function calculateColorDistance(color1, color2) {
  var rgb1 = hexToRgb(color1);
  var rgb2 = hexToRgb(color2);
  if (!rgb1 || !rgb2) return 1000;

  // Distance euclidienne pondérée dans l'espace RGB
  // Les coefficients reflètent la perception humaine
  var rDiff = rgb1.r - rgb2.r;
  var gDiff = rgb1.g - rgb2.g;
  var bDiff = rgb1.b - rgb2.b;
  var rMean = (rgb1.r + rgb2.r) / 2;

  // Formule de distance perceptuelle améliorée
  var weightR = 2 + rMean / 256;
  var weightG = 4.0;
  var weightB = 2 + (255 - rMean) / 256;
  return Math.sqrt(weightR * rDiff * rDiff + weightG * gDiff * gDiff + weightB * bDiff * bDiff);
}

/**
 * Ajuste la saturation et la luminosité d'une couleur selon le niveau
 */
function adjustColorForLevel(hex, level) {
  var rgb = hexToRgb(hex);
  if (!rgb) return hex;

  // Convertir en HSL pour manipuler saturation et luminosité
  var r = rgb.r / 255;
  var g = rgb.g / 255;
  var b = rgb.b / 255;
  var max = Math.max(r, g, b);
  var min = Math.min(r, g, b);
  var h,
    s,
    l = (max + min) / 2;
  if (max === min) {
    h = s = 0; // Gris
  } else {
    var d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    switch (max) {
      case r:
        h = ((g - b) / d + (g < b ? 6 : 0)) / 6;
        break;
      case g:
        h = ((b - r) / d + 2) / 6;
        break;
      case b:
        h = ((r - g) / d + 4) / 6;
        break;
    }
  }

  // Ajuster selon le niveau
  switch (level) {
    case 'main':
      // Catégories principales : saturation maximale, luminosité moyenne-haute
      s = Math.min(1, s * 1.2); // +20% saturation
      l = Math.max(0.45, Math.min(0.65, l)); // Luminosité contrôlée
      break;
    case 'sub':
      // Sous-catégories : saturation légèrement réduite
      s = Math.min(1, s * 1.0); // Saturation normale
      l = Math.max(0.40, Math.min(0.60, l * 0.95)); // Légèrement plus sombre
      break;
    case 'child':
      // Sous-sous-catégories : saturation réduite, plus sombre
      s = Math.min(1, s * 0.85); // -15% saturation
      l = Math.max(0.35, Math.min(0.55, l * 0.85)); // Plus sombre
      break;
  }

  // Convertir HSL vers RGB
  var r2, g2, b2;
  if (s === 0) {
    r2 = g2 = b2 = l;
  } else {
    var hue2rgb = function hue2rgb(p, q, t) {
      if (t < 0) t += 1;
      if (t > 1) t -= 1;
      if (t < 1 / 6) return p + (q - p) * 6 * t;
      if (t < 1 / 2) return q;
      if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
      return p;
    };
    var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
    var p = 2 * l - q;
    r2 = hue2rgb(p, q, h + 1 / 3);
    g2 = hue2rgb(p, q, h);
    b2 = hue2rgb(p, q, h - 1 / 3);
  }
  return rgbToHex(r2 * 255, g2 * 255, b2 * 255);
}

/**
 * Sélectionne les couleurs les plus distinctes pour un ensemble d'IDs
 * Garantit une distance maximale entre toutes les couleurs utilisées
 */
function selectDistinctColors(ids, level) {
  var colors = categoryColors.palette;
  var selectedColors = new Map();
  var usedIndices = new Set();

  // Trier les IDs pour garantir une attribution stable
  var sortedIds = _toConsumableArray(ids).sort(function (a, b) {
    var aStr = String(a);
    var bStr = String(b);
    return aStr.localeCompare(bStr, undefined, {
      numeric: true
    });
  });

  // Pour chaque ID, trouver la couleur la plus distincte
  sortedIds.forEach(function (id) {
    var bestIndex = -1;
    var bestMinDistance = -1;

    // Essayer plusieurs candidats
    var candidates = [];
    for (var i = 0; i < 5; i++) {
      var index = generateOptimalColorIndex(id + i * 1000, colors.length, usedIndices);
      if (!usedIndices.has(index)) {
        candidates.push(index);
      }
    }

    // Sélectionner le candidat avec la distance minimale maximale
    for (var _i = 0, _candidates = candidates; _i < _candidates.length; _i++) {
      var candidateIndex = _candidates[_i];
      var candidateColor = colors[candidateIndex];

      // Calculer la distance minimale avec toutes les couleurs déjà sélectionnées
      var minDistance = Infinity;
      var _iterator = _createForOfIteratorHelper(selectedColors),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var _step$value = _slicedToArray(_step.value, 2),
            selectedId = _step$value[0],
            selectedColor = _step$value[1];
          var distance = calculateColorDistance(candidateColor, selectedColor);
          minDistance = Math.min(minDistance, distance);
        }

        // Si c'est la première couleur ou si cette couleur est plus distincte
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
      if (selectedColors.size === 0 || minDistance > bestMinDistance) {
        bestMinDistance = minDistance;
        bestIndex = candidateIndex;
      }
    }

    // Si aucun candidat n'est satisfaisant, prendre le premier disponible
    if (bestIndex === -1) {
      bestIndex = generateOptimalColorIndex(id, colors.length, usedIndices);
    }
    usedIndices.add(bestIndex);
    var baseColor = colors[bestIndex];
    var adjustedColor = adjustColorForLevel(baseColor, level);
    selectedColors.set(id, adjustedColor);
  });
  return selectedColors;
}

/**
 * Obtient la couleur d'une catégorie
 * @param {string} level - Le niveau ('main', 'sub', 'child')
 * @param {number|string} id - L'ID de la catégorie
 * @param {Array} allIds - Tous les IDs du contexte actuel
 * @returns {string} Code couleur hexadécimal
 */
function getCategoryColor(level, id) {
  var allIds = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  // Si pas d'IDs fournis, utiliser une couleur de base ajustée
  if (!allIds || allIds.length === 0) {
    var colors = categoryColors.palette;
    var index = generateOptimalColorIndex(id, colors.length);
    return adjustColorForLevel(colors[index], level);
  }

  // Sélectionner toutes les couleurs distinctes pour ce contexte
  var colorMap = selectDistinctColors(allIds, level);

  // Retourner la couleur pour cet ID
  return colorMap.get(id) || adjustColorForLevel(categoryColors.palette[0], level);
}

/**
 * Obtient une couleur pour un niveau spécifique
 * Alias de getCategoryColor pour compatibilité
 */
function getCategoryColorByLevel(level, id) {
  var allIds = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  return getCategoryColor(level, id, allIds);
}

/**
 * Validation du système : vérifie que toutes les couleurs sont distinctes
 */
function validateColorDistinctness(ids) {
  var level = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'main';
  var colorMap = selectDistinctColors(ids, level);
  var colors = Array.from(colorMap.values());
  var minDistance = Infinity;
  var problematicPairs = [];
  for (var i = 0; i < colors.length; i++) {
    for (var j = i + 1; j < colors.length; j++) {
      var distance = calculateColorDistance(colors[i], colors[j]);
      if (distance < minDistance) {
        minDistance = distance;
      }

      // Seuil de distinction : 50 est considéré comme trop proche
      if (distance < 50) {
        problematicPairs.push({
          color1: colors[i],
          color2: colors[j],
          distance: distance.toFixed(2)
        });
      }
    }
  }
  return {
    valid: problematicPairs.length === 0,
    minDistance: minDistance.toFixed(2),
    problematicPairs: problematicPairs,
    totalColors: colors.length,
    averageDistance: colors.length > 1 ? (colors.reduce(function (sum, c1, i) {
      return sum + colors.slice(i + 1).reduce(function (s, c2) {
        return s + calculateColorDistance(c1, c2);
      }, 0);
    }, 0) / (colors.length * (colors.length - 1) / 2)).toFixed(2) : 0
  };
}

// Configuration des niveaux de catégories
var categoryLevels = {
  main: {
    name: 'Main Categories',
    shadowColor: 'rgba(59, 130, 246, 0.15)',
    containerClass: 'main-categories',
    popupId: 'searchPopup'
  },
  sub: {
    name: 'Subcategories',
    shadowColor: 'rgba(16, 185, 129, 0.15)',
    containerClass: 'sub-category',
    popupId: 'expatriesPopup'
  },
  child: {
    name: 'Specific Needs',
    shadowColor: 'rgba(251, 146, 60, 0.15)',
    containerClass: 'child-categories',
    popupId: 'vacanciersAutresBesoinsPopup'
  }
};

/**
 * Fonction de test complète du système
 */
function testColorSystem() {
  console.log('=== TEST DU SYSTÈME DE COULEURS AMÉLIORÉ ===\n');

  // Test 1 : Stabilité
  console.log('--- Test 1 : Stabilité (même ID = même couleur) ---');
  var testId = 42;
  var colors = [];
  for (var i = 0; i < 5; i++) {
    var color = getCategoryColor('main', testId, [testId, 43, 44]);
    colors.push(color);
    console.log("Appel ".concat(i + 1, ": ID ").concat(testId, " \u2192 ").concat(color));
  }
  var allSame = colors.every(function (c) {
    return c === colors[0];
  });
  console.log("\u2713 Stabilit\xE9: ".concat(allSame ? 'OK' : 'ÉCHEC', "\n"));

  // Test 2 : Distinction avec beaucoup de catégories
  console.log('--- Test 2 : Distinction avec 50 catégories ---');
  var manyIds = Array.from({
    length: 50
  }, function (_, i) {
    return i + 1;
  });
  var validation = validateColorDistinctness(manyIds, 'main');
  console.log("Nombre de couleurs: ".concat(validation.totalColors));
  console.log("Distance minimale: ".concat(validation.minDistance));
  console.log("Distance moyenne: ".concat(validation.averageDistance));
  console.log("Paires probl\xE9matiques: ".concat(validation.problematicPairs.length));
  console.log("\u2713 Validation: ".concat(validation.valid ? 'OK' : 'ATTENTION', "\n"));

  // Test 3 : Différences entre niveaux
  console.log('--- Test 3 : Ajustement par niveau ---');
  var testIds = [10, 20, 30];
  ['main', 'sub', 'child'].forEach(function (level) {
    console.log("\nNiveau \"".concat(level, "\":"));
    testIds.forEach(function (id) {
      var color = getCategoryColor(level, id, testIds);
      var luminance = getLuminance(color);
      console.log("  ID ".concat(id, " \u2192 ").concat(color, " (luminosit\xE9: ").concat(luminance.toFixed(0), ")"));
    });
  });

  // Test 4 : Scénario réel (ajout/suppression)
  console.log('\n--- Test 4 : Ajout/suppression dynamique ---');
  var dynamicIds = [1, 2, 3, 4, 5];
  console.log('Couleurs initiales (IDs 1-5):');
  dynamicIds.forEach(function (id) {
    console.log("  ID ".concat(id, " \u2192 ").concat(getCategoryColor('main', id, dynamicIds)));
  });

  // Ajouter des IDs
  dynamicIds = [1, 2, 3, 4, 5, 6, 7];
  console.log('\nAprès ajout des IDs 6-7:');
  [6, 7].forEach(function (id) {
    console.log("  ID ".concat(id, " \u2192 ").concat(getCategoryColor('main', id, dynamicIds)));
  });

  // Vérifier que les anciennes couleurs n'ont pas changé
  console.log('\nVérification des couleurs existantes (doivent être identiques):');
  [1, 2, 3, 4, 5].forEach(function (id) {
    console.log("  ID ".concat(id, " \u2192 ").concat(getCategoryColor('main', id, dynamicIds)));
  });
  console.log('\n=== FIN DES TESTS ===');
}

/***/ }),

/***/ "./resources/js/modules/ui/category/categoryIcons.js":
/*!***********************************************************!*\
  !*** ./resources/js/modules/ui/category/categoryIcons.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   clearIconCache: () => (/* binding */ clearIconCache),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   getCategoryIcon: () => (/* binding */ getCategoryIcon),
/* harmony export */   getCategoryIconName: () => (/* binding */ getCategoryIconName),
/* harmony export */   iconLibrary: () => (/* binding */ iconLibrary),
/* harmony export */   keywordToIcon: () => (/* binding */ keywordToIcon)
/* harmony export */ });
var _keywordToIcon;
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * ===================================================================
 * SYSTÈME D'ICÔNES INTELLIGENT ET STABLE
 * ===================================================================
 * 
 * Garantit :
 * 1. Correspondance sémantique (icône = sens de la catégorie)
 * 2. Stabilité absolue (même catégorie = même icône toujours)
 * 3. Pas de doublons dans une famille
 */

// ==================== BIBLIOTHÈQUE D'ICÔNES ====================

var iconLibrary = {
  // ==================== ADMINISTRATIVE & VISAS ====================
  passport: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"6\" y=\"3\" width=\"9\" height=\"13\" rx=\"0.8\" stroke=\"white\" stroke-width=\"1.2\" fill=\"white\"/>\n    <circle cx=\"10.5\" cy=\"7\" r=\"1.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"9.5\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"11\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M16 12 L21 12 L21 20 L16 20 Z\" fill=\"white\"/>\n    <circle cx=\"18.5\" cy=\"15\" r=\"1.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"17\" y=\"17\" width=\"3\" height=\"0.3\" rx=\"0.15\" fill=\"white\" opacity=\"0.3\"/>\n  </svg>",
  visa: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"8\" width=\"11\" height=\"9\" rx=\"0.5\" stroke=\"white\" stroke-width=\"1\" fill=\"white\"/>\n    <rect x=\"6\" y=\"10\" width=\"2.5\" height=\"3\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"10.5\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"12\" width=\"3\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"10.5\" cy=\"14.5\" r=\"1\" fill=\"white\" opacity=\"0.2\"/>\n    <circle cx=\"18\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M16 10 L18 12 L20 8\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  document: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M6 3 L6 21 L14 21 L14 8 L9 3 Z\" fill=\"white\"/>\n    <path d=\"M9 3 L9 8 L14 8\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"11\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"13\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"15\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M16 12 L20 12 L20 20 L16 20 Z\" fill=\"white\"/>\n    <path d=\"M17 14 L19 16 L17 18\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  certificate: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"5\" width=\"14\" height=\"9\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"11\" cy=\"9.5\" r=\"1.3\" stroke=\"white\" stroke-width=\"0.8\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M9 15 L10 19 L10.5 17 L12 17 L10.5 15.5 Z\" fill=\"white\"/>\n    <path d=\"M13 15 L12 19 L11.5 17 L10 17 L11.5 15.5 Z\" fill=\"white\"/>\n    <circle cx=\"18.5\" cy=\"16\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17 16 L18.5 17.5 L20 15\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  embassy: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L5 6.5 L5 7.5 L17 7.5 L17 6.5 Z\" fill=\"white\"/>\n    <rect x=\"6.5\" y=\"8.5\" width=\"1.5\" height=\"7\" fill=\"white\"/>\n    <rect x=\"10\" y=\"8.5\" width=\"1.5\" height=\"7\" fill=\"white\"/>\n    <rect x=\"13.5\" y=\"8.5\" width=\"1.5\" height=\"7\" fill=\"white\"/>\n    <rect x=\"5\" y=\"15.5\" width=\"12\" height=\"1.5\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M19 8 L19 12 M17 10 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  stamp: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"7\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M10 4.5 L10 9.5 M7.5 7 L12.5 7\" stroke=\"white\" stroke-width=\"0.8\"/>\n    <rect x=\"5\" y=\"11\" width=\"10\" height=\"1.2\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"4\" y=\"12.5\" width=\"12\" height=\"1.2\" rx=\"0.6\" fill=\"white\"/>\n    <rect x=\"3\" y=\"14\" width=\"14\" height=\"1.8\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M18 6 L21 6 L21 16 L18 16\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"1.5\" fill=\"white\"/>\n  </svg>",
  // ==================== BANKS & MONEY ====================
  bank: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L4 6.5 L4 7.5 L18 7.5 L18 6.5 Z\" fill=\"white\"/>\n    <rect x=\"5.5\" y=\"8.5\" width=\"1.5\" height=\"6\" fill=\"white\"/>\n    <rect x=\"10.5\" y=\"8.5\" width=\"1.5\" height=\"6\" fill=\"white\"/>\n    <rect x=\"15.5\" y=\"8.5\" width=\"1.5\" height=\"6\" fill=\"white\"/>\n    <rect x=\"4\" y=\"14.5\" width=\"14\" height=\"1.5\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"10\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M18.5 10 L19.5 11 L21 9\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  money: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"9\" width=\"14\" height=\"7\" rx=\"0.8\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"12.5\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"6\" cy=\"12.5\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"14\" cy=\"12.5\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M18 8 L22 8 L22 18 L18 18\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M19 11 L21 11 M19 13 L21 13 M19 15 L21 15\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\"/>\n  </svg>",
  card: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"2\" y=\"7\" width=\"16\" height=\"9\" rx=\"1\" fill=\"white\"/>\n    <rect x=\"2\" y=\"9\" width=\"16\" height=\"1.8\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"4\" y=\"12.5\" width=\"3\" height=\"2\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"11.5\" r=\"2.5\" fill=\"white\"/>\n    <rect x=\"18.5\" y=\"11\" width=\"3\" height=\"1\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n  </svg>",
  tax: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"3\" width=\"10\" height=\"14\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"7\" y=\"6\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"8\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"10\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M12 12 L14 14 L12 16\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\"/>\n    <circle cx=\"18.5\" cy=\"13\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M18.5 11.5 L18.5 14.5\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <path d=\"M17 13 L20 13\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n  </svg>",
  insurance: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L5 5.5 L5 11 Q5 15 11 18 Q17 15 17 11 L17 5.5 Z\" fill=\"white\"/>\n    <path d=\"M8 11 L10 13 L14 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"16\" r=\"2\" fill=\"white\"/>\n    <path d=\"M18 16 L19 17 L20.5 15\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  investment: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M3 15 L7 11 L11 13 L18 6\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <path d=\"M14 6 L18 6 L18 10\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <circle cx=\"20.5\" cy=\"15\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M20.5 13.5 L20.5 16.5 M18.5 15 L22.5 15\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n  </svg>",
  pension: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"8\" width=\"12\" height=\"10\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"11.5\" r=\"1.5\" stroke=\"white\" stroke-width=\"0.8\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M7 14.5 Q10 13 13 14.5\" stroke=\"white\" stroke-width=\"1\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 10 L19 14 M17 12 L21 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  loan: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"8\" width=\"14\" height=\"8\" rx=\"1\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M18 12 L22 12 M20 10 L20 14\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M8.5 12 L9.5 12 M10.5 12 L11.5 12\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n  </svg>",
  // ==================== MOVING & LOGISTICS ====================
  box: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M4 8 L11 4 L18 8 L18 15 L11 19 L4 15 Z\" fill=\"white\"/>\n    <path d=\"M4 8 L11 12 L18 8 M11 12 L11 19\" stroke=\"white\" stroke-width=\"1\" opacity=\"0.3\"/>\n    <path d=\"M19 10 L22 12 L22 16 L19 18\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n    <path d=\"M19 14 L22 14\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  truck: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"2\" y=\"9\" width=\"11\" height=\"6\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M13 10 L16 10 L18 13 L18 15 L13 15 Z\" fill=\"white\"/>\n    <circle cx=\"6\" cy=\"16\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"15\" cy=\"16\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"20.5\" cy=\"11\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M19 11 L20.5 12.5 L22 10\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  storage: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"5\" width=\"12\" height=\"12\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"4\" y=\"9\" width=\"12\" height=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"4\" y=\"13\" width=\"12\" height=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"11\" r=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"15\" r=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M17 8 L21 10 L21 16 L17 14 Z\" fill=\"white\"/>\n    <path d=\"M17 11 L21 13\" stroke=\"white\" stroke-width=\"0.5\" opacity=\"0.3\"/>\n  </svg>",
  "package": "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"6\" width=\"10\" height=\"10\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M5 9 L15 9 M10 6 L10 16\" stroke=\"white\" stroke-width=\"1\" opacity=\"0.3\"/>\n    <circle cx=\"18.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17 13 L18.5 14.5 L20 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  customs: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"6\" width=\"12\" height=\"10\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M8 10 L10 12 L13 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"13\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M17 8 L21 8 L21 16 L17 16\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n    <path d=\"M18 12 L20 12\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n  </svg>",
  international_moving: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M4 8 L10 5 L16 8 L16 14 L10 17 L4 14 Z\" fill=\"white\"/>\n    <path d=\"M4 8 L10 11 L16 8 M10 11 L10 17\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"11.5\" r=\"4\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M14.5 11.5 L24.5 11.5 M19.5 6.5 Q17 11.5 19.5 16.5 M19.5 6.5 Q22 11.5 19.5 16.5\" stroke=\"white\" stroke-width=\"0.6\" opacity=\"0.3\"/>\n  </svg>",
  packing: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"6\" width=\"12\" height=\"11\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M4 9 L16 9 M10 6 L10 17\" stroke=\"white\" stroke-width=\"1\" opacity=\"0.3\"/>\n    <path d=\"M7 12 L9 12 M11 12 L13 12 M7 14 L9 14\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"12.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 12.5 L19.5 14 L21 11.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== TRANSPORT ====================
  car: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M5 12 L7 8 L14 8 L16 12 L16 16 L5 16 Z\" fill=\"white\"/>\n    <rect x=\"6\" y=\"9\" width=\"3\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"11\" y=\"9\" width=\"3\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"16\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"13\" cy=\"16\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  license: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"7\" width=\"13\" height=\"9\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"6\" y=\"9\" width=\"3\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"9.5\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"11\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"12.5\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"11.5\" r=\"2\" fill=\"white\"/>\n    <path d=\"M18.5 11.5 L19.5 12.5 L20.5 10.5\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  scooter: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"6\" cy=\"16\" r=\"1.8\" fill=\"white\"/>\n    <circle cx=\"15\" cy=\"16\" r=\"1.8\" fill=\"white\"/>\n    <path d=\"M7.5 16 L10.5 10 L13 10\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"13\" cy=\"8\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"10\" r=\"2.2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M18 10 L19.5 11.5 L21 9\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  ticket: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"8\" width=\"14\" height=\"7\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"3\" cy=\"11.5\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"17\" cy=\"11.5\" r=\"0.8\" fill=\"white\"/>\n    <rect x=\"8.5\" y=\"10\" width=\"0.4\" height=\"3\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"10\" width=\"0.4\" height=\"3\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 11.5 L20 12.5 L21.5 10.5\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  transport: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"8\" width=\"12\" height=\"7\" rx=\"0.8\" fill=\"white\"/>\n    <circle cx=\"8\" cy=\"16\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"13\" cy=\"16\" r=\"1.2\" fill=\"white\"/>\n    <rect x=\"6\" y=\"10\" width=\"2.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"10\" width=\"2.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M17 9 L21 11 L21 15 L17 13 Z\" fill=\"white\"/>\n  </svg>",
  metro: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"6\" width=\"10\" height=\"10\" rx=\"1.8\" fill=\"white\"/>\n    <rect x=\"7\" y=\"8\" width=\"3\" height=\"4\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"11.5\" y=\"8\" width=\"2\" height=\"4\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"8\" cy=\"17\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"13\" cy=\"17\" r=\"0.8\" fill=\"white\"/>\n    <path d=\"M16 9 L20 11 L20 14 L16 12 Z\" fill=\"white\"/>\n  </svg>",
  bus: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"7\" width=\"12\" height=\"9\" rx=\"1.2\" fill=\"white\"/>\n    <rect x=\"6\" y=\"9\" width=\"2.5\" height=\"3\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"9.5\" y=\"9\" width=\"2.5\" height=\"3\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"13\" y=\"9\" width=\"2\" height=\"3\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"17\" r=\"1\" fill=\"white\"/>\n    <circle cx=\"13\" cy=\"17\" r=\"1\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11.5 L19.5 13 L21 10.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  ferry: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M4 12 L4 14 L16 14 L16 12 L10 8 Z\" fill=\"white\"/>\n    <rect x=\"7\" y=\"9\" width=\"2\" height=\"3\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M3 15 Q10 13 17 15\" stroke=\"white\" stroke-width=\"1.2\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 10 L20 11.5 L21.5 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  taxi: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"9\" y=\"5\" width=\"3.5\" height=\"1.8\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M5 10 L7 7.5 L14 7.5 L16 10 L16 14.5 L5 14.5 Z\" fill=\"white\"/>\n    <rect x=\"6\" y=\"8.5\" width=\"3.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"11.5\" y=\"8.5\" width=\"3.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"15\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"15\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2\" fill=\"white\"/>\n    <path d=\"M18.5 11 L20 12.5 L21.5 10\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  // ==================== HEALTH ====================
  health: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z\" fill=\"white\"/>\n    <path d=\"M11 8 L11 12 M9 10 L13 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"18.5\" cy=\"14\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17 14 L18.5 15.5 L20 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  medicine: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"7\" y=\"6\" width=\"7\" height=\"11\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M10.5 9 L10.5 14 M8 11.5 L13 11.5\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"18\" cy=\"13\" r=\"2.2\" fill=\"white\"/>\n    <path d=\"M16.5 13 L17.5 14 L19.5 12\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  hospital: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"5\" width=\"10\" height=\"14\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M10 8 L10 13 M7.5 10.5 L12.5 10.5\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <rect x=\"7.5\" y=\"15\" width=\"1.5\" height=\"4\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"11\" y=\"15\" width=\"1.5\" height=\"4\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 9 L19 13 M17 11 L21 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  wellbeing: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 4 Q7 6.5 7 10.5 Q7 14.5 11 17 Q15 14.5 15 10.5 Q15 6.5 11 4\" fill=\"white\"/>\n    <path d=\"M9 10 Q11 8 13 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"14\" r=\"2\" fill=\"white\"/>\n    <path d=\"M18 14 L19 15 L20.5 13\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  dentist: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M10 5 Q8 6 8 8 L8 13 Q8 15 9 16.5 L9 19\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <path d=\"M13 5 Q15 6 15 8 L15 13 Q15 15 14 16.5 L14 19\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  optician: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"7\" cy=\"11\" r=\"3.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"14\" cy=\"11\" r=\"3.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M10.5 11 L10.5 11\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  physiotherapy: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"9\" cy=\"6\" r=\"2\" fill=\"white\"/>\n    <path d=\"M9 8 L9 12 M6.5 10 L11.5 10\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M9 12 L7 16 M9 12 L11 16\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M15 9 L18 9 M15 12 L18 12 M15 15 L18 15\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"20\" cy=\"12\" r=\"1.5\" fill=\"white\"/>\n  </svg>",
  spa: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 4 Q7 6.5 7 10.5 Q7 14.5 11 17 Q15 14.5 15 10.5 Q15 6.5 11 4\" fill=\"white\"/>\n    <path d=\"M9 11 Q11 9 13 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"1\" fill=\"white\"/>\n  </svg>",
  massage: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"9\" cy=\"6\" r=\"2.2\" fill=\"white\"/>\n    <path d=\"M9 8.5 L9 13 M6.5 11 L11.5 11\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <ellipse cx=\"9\" cy=\"15.5\" rx=\"3\" ry=\"1.8\" fill=\"white\"/>\n    <circle cx=\"18\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"18\" cy=\"11\" r=\"1\" fill=\"white\"/>\n  </svg>",
  // ==================== FAMILY & EDUCATION ====================
  child: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"6\" r=\"2\" fill=\"white\"/>\n    <path d=\"M10 8.5 L10 13 M7 10.5 L13 10.5\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <path d=\"M10 13 L7.5 17 M10 13 L12.5 17\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <circle cx=\"18\" cy=\"8\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M18 11 L18 15 M15.5 13 L20.5 13\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n  </svg>",
  school: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L4 6.5 L4 15 L11 18.5 L18 15 L18 6.5 Z\" fill=\"white\"/>\n    <path d=\"M11 6.5 L11 18.5\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"11\" cy=\"5\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M19 9 L22 9 M19 12 L22 12 M19 15 L22 15\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  book: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M5 4 L5 18 L15 18 L15 4 Z\" fill=\"white\"/>\n    <path d=\"M10 4 L10 18\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"7\" width=\"2.5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"9\" width=\"2.5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M17.5 11 L19 12.5 L20.5 10\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  language: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"11\" r=\"7\" fill=\"white\"/>\n    <path d=\"M3 11 L17 11 M10 4 Q7 11 10 18 M10 4 Q13 11 10 18\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <path d=\"M18 8 L21 8 M18 11 L21 11 M18 14 L21 14\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  teacher: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"6\" width=\"12\" height=\"9\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"6\" y=\"8\" width=\"3.5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"10\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M11 10 L13 12 L15 10\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2\" fill=\"white\"/>\n    <path d=\"M19 9 L19 11 L21 11\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n  </svg>",
  university: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L3 6.5 L3 16 L11 19.5 L19 16 L19 6.5 Z\" fill=\"white\"/>\n    <path d=\"M11 6.5 L11 19.5\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <path d=\"M7 8.5 L7 15\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <path d=\"M15 8.5 L15 15\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"2\" width=\"4\" height=\"1.5\" rx=\"0.5\" fill=\"white\"/>\n  </svg>",
  training_center: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"6\" width=\"12\" height=\"12\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"11\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"14.5\" width=\"8\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11 L19 12.5 L20.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  wedding: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"7\" cy=\"7\" r=\"2\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"7\" r=\"2\" fill=\"white\"/>\n    <path d=\"M4 13 Q7 11 10.5 13\" fill=\"white\"/>\n    <path d=\"M10.5 13 Q14 11 17.5 13\" fill=\"white\"/>\n    <path d=\"M7 13 L7 17 M14 13 L14 17\" stroke=\"white\" stroke-width=\"1.2\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2\" fill=\"white\"/>\n    <path d=\"M19 11 L20 12 L21.5 10\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  birthday: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"12\" width=\"10\" height=\"6\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"7\" y=\"9\" width=\"2\" height=\"3\" rx=\"0.3\" fill=\"white\"/>\n    <rect x=\"11\" y=\"9\" width=\"2\" height=\"3\" rx=\"0.3\" fill=\"white\"/>\n    <path d=\"M8 7 L8 9 M12 7 L12 9\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 13 L19 14.5 L20.5 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== WORK & BUSINESS ====================
  briefcase: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"9\" width=\"14\" height=\"9\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"7\" y=\"6\" width=\"6\" height=\"3\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"3\" y=\"12\" width=\"14\" height=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"13.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13.5 L19.5 15 L21 12.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  cv: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"3\" width=\"10\" height=\"16\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"6.5\" r=\"1.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"9\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"11\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"13\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"15\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M16 7 L20 7 L20 17 L16 17\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n    <circle cx=\"18\" cy=\"12\" r=\"1.5\" fill=\"white\"/>\n  </svg>",
  company: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"8\" width=\"12\" height=\"11\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"7\" y=\"11\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"11\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"14\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"14\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8.5\" y=\"5\" width=\"3\" height=\"3\" rx=\"0.3\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 11 L19 15 M17 13 L21 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  interview: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"7\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M5 15 Q10 12 15 15\" fill=\"white\"/>\n    <rect x=\"7\" y=\"17\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2\" fill=\"white\"/>\n    <rect x=\"17.5\" y=\"13\" width=\"3\" height=\"0.8\" rx=\"0.3\" fill=\"white\"/>\n    <path d=\"M19 13 L19 15\" stroke=\"white\" stroke-width=\"0.8\"/>\n  </svg>",
  freelance: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"7\" width=\"12\" height=\"9\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"6\" y=\"9\" width=\"3.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M11 10 L15 10 M11 12 L14 12\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"13\" width=\"8\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"19\" cy=\"11.5\" r=\"1\" fill=\"white\"/>\n  </svg>",
  architect: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M4 8 L4 18 L12 18 L12 8\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M2 8 L14 8 L13 5 L3 5 Z\" fill=\"white\"/>\n    <rect x=\"6\" y=\"11\" width=\"2\" height=\"2\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"11\" width=\"2\" height=\"2\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M15 10 L22 10 M15 13 L20 13 M15 16 L21 16\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  engineer: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"8\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M10 10.5 L10 13.5\" stroke=\"white\" stroke-width=\"1.2\"/>\n    <circle cx=\"10\" cy=\"15\" r=\"1.5\" fill=\"white\"/>\n    <path d=\"M8.5 15 L5 18 M11.5 15 L15 18\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n    <path d=\"M16 6 L22 9 L22 13 L16 10 Z\" fill=\"white\"/>\n    <path d=\"M16 8 L22 11\" stroke=\"white\" stroke-width=\"0.5\" opacity=\"0.3\"/>\n  </svg>",
  accountant: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"5\" width=\"12\" height=\"14\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"6\" y=\"8\" width=\"8\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"10\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"12\" width=\"7\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"14\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M17 9 L21 9 M17 12 L21 12 M17 15 L21 15\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n  </svg>",
  consultant: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"9\" cy=\"7\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M5 13.5 Q9 11 13 13.5 L13 17 L5 17 Z\" fill=\"white\"/>\n    <rect x=\"7.5\" y=\"9.5\" width=\"3\" height=\"1.5\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"16\" y=\"8\" width=\"6\" height=\"9\" rx=\"0.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11 L20.5 11 M17.5 13 L20.5 13 M17.5 15 L19.5 15\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n  </svg>",
  // ==================== HOME ====================
  home: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L4 9 L4 18 L18 18 L18 9 Z\" fill=\"white\"/>\n    <rect x=\"9\" y=\"13\" width=\"3\" height=\"5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"10\" width=\"2.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"13\" y=\"10\" width=\"2.5\" height=\"2.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M19 7 L22 9 L22 16 L19 14 Z\" fill=\"white\"/>\n  </svg>",
  key: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"15\" cy=\"7\" r=\"3.5\" fill=\"white\"/>\n    <rect x=\"3\" y=\"12\" width=\"9\" height=\"1.8\" rx=\"0.9\" fill=\"white\"/>\n    <rect x=\"6\" y=\"11\" width=\"0.7\" height=\"3.5\" rx=\"0.35\" fill=\"white\"/>\n    <rect x=\"9\" y=\"11\" width=\"0.7\" height=\"3.5\" rx=\"0.35\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"16\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M19 16 L20 17 L21.5 15\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  cleaning: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"7\" cy=\"5\" r=\"1.8\" fill=\"white\"/>\n    <rect x=\"6\" y=\"7\" width=\"2\" height=\"9\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M4.5 16 L9.5 16 L8 18 L6 18 Z\" fill=\"white\"/>\n    <circle cx=\"17\" cy=\"9\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M15.5 9 L17 10.5 L18.5 8\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <path d=\"M16 12 L16 17\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n  </svg>",
  repair: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M7 7 L14 14 M7 14 L14 7\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <circle cx=\"7\" cy=\"7\" r=\"1.8\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"14\" r=\"1.8\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"16\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 16 L19 17.5 L20.5 15\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  renovation: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"8\" width=\"12\" height=\"9\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M7 11 L10 11 M12 11 L15 11 M7 13 L10 13 M12 13 L15 13\" stroke=\"white\" stroke-width=\"1.2\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"5\" width=\"3\" height=\"3\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13 L19 14 L21 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  inspection: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"9\" cy=\"10\" r=\"6\" fill=\"white\"/>\n    <path d=\"M14 14 L18 18\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <path d=\"M7 10 L9 12 L12 8\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"8\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M19 8 L20 9 L21.5 7\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  gardening: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M10 14 L10 18\" stroke=\"white\" stroke-width=\"1.5\"/>\n    <path d=\"M7 7 Q7 4 10 4 Q13 4 13 7\" fill=\"white\"/>\n    <path d=\"M5 10 Q5 7 10 7 Q15 7 15 10\" fill=\"white\"/>\n    <rect x=\"8.5\" y=\"17.5\" width=\"3\" height=\"1.5\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11 L19 12.5 L20.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  plumbing: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M5 8 L5 15\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M5 11 L12 11\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <path d=\"M12 8 L12 15\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <circle cx=\"8.5\" cy=\"13\" r=\"1.5\" fill=\"white\"/>\n    <path d=\"M16 8 L20 8 M16 11 L20 11 M16 14 L20 14\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n  </svg>",
  painting: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"7\" y=\"4\" width=\"3\" height=\"8\" rx=\"0.3\" fill=\"white\"/>\n    <path d=\"M8.5 12 L8.5 18\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <rect x=\"6\" y=\"18\" width=\"5\" height=\"2\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"17\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M15.5 11 L17 12.5 L18.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  carpentry: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M5 7 L12 14 M5 14 L12 7\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <circle cx=\"5\" cy=\"7\" r=\"1.5\" fill=\"white\"/>\n    <circle cx=\"12\" cy=\"14\" r=\"1.5\" fill=\"white\"/>\n    <path d=\"M15 9 L19 9 M15 12 L19 12 M15 15 L19 15\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"21\" cy=\"12\" r=\"1.2\" fill=\"white\"/>\n  </svg>",
  // ==================== SERVICES ====================
  phone: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"6\" y=\"3\" width=\"9\" height=\"16\" rx=\"0.8\" fill=\"white\"/>\n    <circle cx=\"10.5\" cy=\"16.5\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"5\" width=\"5\" height=\"9\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"18.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17 13 L18.5 14.5 L20 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  wifi: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M3 9 Q10 4 17 9\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" fill=\"none\"/>\n    <path d=\"M6 12 Q10 9 14 12\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" fill=\"none\"/>\n    <path d=\"M8.5 15 Q10 13.5 11.5 15\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" fill=\"none\"/>\n    <circle cx=\"10\" cy=\"17\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 11 L20 12.5 L21.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  mail: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"2\" y=\"6\" width=\"16\" height=\"11\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M2 6 L10 12 L18 6\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"20.5\" cy=\"14\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 14 L20.5 15.5 L22 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  translation: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"6\" width=\"7\" height=\"5.5\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"10.5\" y=\"11.5\" width=\"7\" height=\"5.5\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M5 8.5 L7 8.5 M6 7.5 L6 9.5 M5 12.5 L7 12.5\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <path d=\"M12.5 14 L14.5 14 M13.5 13 L13.5 15\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"9\" r=\"2\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M18.5 9 L20 10.5 L21.5 8\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  interpreter: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"8\" cy=\"7\" r=\"2.2\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"15\" r=\"2.2\" fill=\"white\"/>\n    <path d=\"M8 9.5 L8 13.5 L14 12\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== ANIMALS ====================
  pet: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"7\" cy=\"7\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"7\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"5\" cy=\"11\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"16\" cy=\"11\" r=\"1.3\" fill=\"white\"/>\n    <ellipse cx=\"10.5\" cy=\"13\" rx=\"3.5\" ry=\"4.5\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 13 L20 14.5 L21.5 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  veterinary: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z\" fill=\"white\"/>\n    <ellipse cx=\"11\" cy=\"16\" rx=\"2.2\" ry=\"1.3\" fill=\"white\"/>\n    <path d=\"M11 8.5 L11 12 M9 10.25 L13 10.25\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11 L19 12.5 L20.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== CONCIERGE ====================
  calendar: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"5\" width=\"12\" height=\"12\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"4\" y=\"5\" width=\"12\" height=\"2.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"10\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"10\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"13\" y=\"10\" width=\"1.5\" height=\"1.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"13.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13.5 L19.5 15 L21 12.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  shopping: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M5 6 L7 16 L16 16 L18 6 Z\" fill=\"white\"/>\n    <path d=\"M8 6 L8 4.5 Q8 3.5 9 3.5 L12 3.5 Q13 3.5 13 4.5 L13 6\" stroke=\"white\" stroke-width=\"1.3\" fill=\"none\"/>\n    <circle cx=\"9\" cy=\"17.5\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"17.5\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 12 L20 13.5 L21.5 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  food: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M4 8 L4 18 M7 8 L7 18 M10 8 L10 11.5 Q10 14 7 14\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <path d=\"M13 8 Q16 8 16 10.5 L16 18\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <path d=\"M13 10.5 L16 10.5\" stroke=\"white\" stroke-width=\"1.3\"/>\n    <circle cx=\"20\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 13 L20 14.5 L21.5 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  delivery: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"10\" width=\"7\" height=\"5.5\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M11 11.5 L14 11.5 L16 14 L16 15.5 L11 15.5 Z\" fill=\"white\"/>\n    <circle cx=\"7\" cy=\"16.5\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"16.5\" r=\"1.2\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 10 L19.5 11.5 L21 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  concierge: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"6.5\" r=\"2.2\" fill=\"white\"/>\n    <path d=\"M6 13.5 Q10 11 14 13.5 L14 17 L6 17 Z\" fill=\"white\"/>\n    <rect x=\"8.5\" y=\"9\" width=\"3\" height=\"1.8\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"19\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11.5 L19 13 L20.5 10.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== TECH ====================
  computer: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"2\" y=\"5\" width=\"16\" height=\"10\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"4\" y=\"7\" width=\"12\" height=\"6\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"16\" width=\"7\" height=\"0.8\" rx=\"0.4\" fill=\"white\"/>\n    <rect x=\"9\" y=\"15\" width=\"3\" height=\"1\" fill=\"white\"/>\n    <circle cx=\"20.5\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 10 L20.5 11.5 L22 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  settings: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"11\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M10 5 L10 7 M10 15 L10 17 M4 11 L6 11 M14 11 L16 11\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <path d=\"M6 6 L7.5 7.5 M12.5 14.5 L14 16 M14 6 L12.5 7.5 M7.5 14.5 L6 16\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M20 9 L20 13 M18 11 L22 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  software: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"5\" width=\"12\" height=\"12\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M8 9.5 L10 11.5 L8 13.5 M11 9.5 L13 11.5 L11 13.5\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  backup: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M6 13 Q6 9 10.5 9 Q15 9 15 13\" fill=\"white\"/>\n    <path d=\"M10.5 9 L10.5 16 M8 14 L10.5 11.5 L13 14\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <rect x=\"4\" y=\"16.5\" width=\"12\" height=\"1.8\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13 L19.5 14.5 L21 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== LEGAL ====================
  lawyer: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M7 10 L7 18 L14 18 L14 10\" fill=\"white\"/>\n    <path d=\"M5 10 L16 10 L15 6.5 L6 6.5 Z\" fill=\"white\"/>\n    <rect x=\"9 13\" width=\"3\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 13 L19 14.5 L20.5 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  contract: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"3\" width=\"10\" height=\"16\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"7\" y=\"6\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"8\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"10\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M8 15 Q10 13 12 15\" stroke=\"white\" stroke-width=\"1.3\" fill=\"none\"/>\n    <circle cx=\"18.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17 13 L18.5 14.5 L20 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  notary: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"5\" width=\"10\" height=\"12\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"10\" r=\"1.8\" stroke=\"white\" stroke-width=\"0.8\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M10 12 L10 14\" stroke=\"white\" stroke-width=\"1\"/>\n    <rect x=\"7\" y=\"14.5\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11.5 L19 13 L20.5 10.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  complaint: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L3 18 L19 18 Z\" fill=\"white\"/>\n    <rect x=\"10\" y=\"9\" width=\"2\" height=\"4.5\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"11\" cy=\"15\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M20.5 9.5 L20.5 12.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  dispute: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"11\" r=\"8\" fill=\"white\"/>\n    <path d=\"M7 11 L15 11 M11 7 L11 15\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"15\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M20 13 L20 17\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  hearing: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M7 10 L7 18 L14 18 L14 10\" fill=\"white\"/>\n    <path d=\"M5 10 L16 10 L15 6.5 L6 6.5 Z\" fill=\"white\"/>\n    <circle cx=\"10.5\" cy=\"13.5\" r=\"1.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 12 L19.5 13.5 L21 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== TRAVEL ====================
  plane: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M2 11 L9 11 L9 7.5 L12.5 7.5 L12.5 11 L19 11 L17.5 13.5 L12.5 13.5 L12.5 16 L11 17 L9.5 16 L9.5 13.5 L4.5 13.5 Z\" fill=\"white\"/>\n    <circle cx=\"21\" cy=\"7\" r=\"2\" fill=\"white\"/>\n    <path d=\"M19.5 7 L21 8.5 L22.5 6.5\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  hotel: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"6\" width=\"14\" height=\"12\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"6\" y=\"9\" width=\"2.5\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"9\" width=\"2.5\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"6\" y=\"13.5\" width=\"2.5\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"13.5\" width=\"2.5\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 11 L20 12.5 L21.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  suitcase: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"9\" width=\"12\" height=\"9\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"8\" y=\"6\" width=\"5\" height=\"3\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"9.5\" y=\"9\" width=\"1.8\" height=\"9\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"13.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13.5 L19.5 15 L21 12.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  train: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"6\" width=\"10\" height=\"9\" rx=\"1.5\" fill=\"white\"/>\n    <rect x=\"7\" y=\"8\" width=\"3.5\" height=\"3.5\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"12\" y=\"8\" width=\"1.5\" height=\"3.5\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"8\" cy=\"16\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"13\" cy=\"16\" r=\"0.8\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11 L19.5 12.5 L21 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== GARDEN ====================
  garden: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 15 L11 18.5\" stroke=\"white\" stroke-width=\"1.8\"/>\n    <path d=\"M7.5 7.5 Q7.5 4 11 4 Q14.5 4 14.5 7.5\" fill=\"white\"/>\n    <path d=\"M5 11 Q5 7.5 11 7.5 Q17 7.5 17 11\" fill=\"white\"/>\n    <rect x=\"9\" y=\"18\" width=\"4\" height=\"1.8\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 12 L20 13.5 L21.5 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  outdoor: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L5 11 L7 11 L4 16 L8.5 14.5 L9.5 18 L11 13.5 L12.5 18 L13.5 14.5 L18 16 L15 11 L17 11 Z\" fill=\"white\"/>\n    <circle cx=\"20.5\" cy=\"9\" r=\"2\" fill=\"white\"/>\n    <path d=\"M19 9 L20.5 10.5 L22 8.5\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  pool: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"10\" width=\"12\" height=\"7\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M6 12.5 Q8 10.5 10 12.5 Q12 14.5 14 12.5 Q16 10.5 18 12.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"7\" r=\"1.3\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"13.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13.5 L19.5 15 L21 12.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== ENERGY ====================
  electricity: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M13 3 L6 11 L10 11 L9 19 L16 11 L12 11 Z\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 12 L20 13.5 L21.5 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  water: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 Q7 7.5 7 12 Q7 16.5 11 19 Q15 16.5 15 12 Q15 7.5 11 3\" fill=\"white\"/>\n    <path d=\"M9 13 Q11 11 13 13\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13 L19.5 14.5 L21 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  gas: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M8 17 L8 10 Q8 8 10 8 L12 8 Q14 8 14 10 L14 17\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\"/>\n    <circle cx=\"11\" cy=\"12.5\" r=\"1.8\" fill=\"white\"/>\n    <rect x=\"6\" y=\"17\" width=\"9\" height=\"1.8\" rx=\"0.9\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"12.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 12.5 L19.5 14 L21 11.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== FOLDER ====================
  folder: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M3 6 L3 17 L18 17 L18 8 L11 8 L9 6 Z\" fill=\"white\"/>\n    <path d=\"M3 8 L18 8\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"20.5\" cy=\"12.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19 12.5 L20.5 14 L22 11.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  file: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M6 3 L6 19 L15 19 L15 8 L11 3 Z\" fill=\"white\"/>\n    <path d=\"M11 3 L11 8 L15 8\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"11\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"8\" y=\"13\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 12 L19 13.5 L20.5 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== EMERGENCY ====================
  alert: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L3 18 L19 18 Z\" fill=\"white\"/>\n    <rect x=\"10\" y=\"9\" width=\"2\" height=\"4.5\" rx=\"0.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"11\" cy=\"15\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20.5\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M20.5 8.5 L20.5 11.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  emergency: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"11\" r=\"8\" fill=\"white\"/>\n    <path d=\"M11 6 L11 12 M11 14 L11 16\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"15\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M20 13 L20 17\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  accident: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z\" fill=\"white\"/>\n    <path d=\"M11 8 L11 11.5 M11 12.5 L11 13.5\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19.5 9 L19.5 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>",
  // ==================== REGISTRATION ====================
  registration: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"4\" width=\"12\" height=\"14\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"8.5\" r=\"1.8\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"12\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"14\" width=\"5\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <path d=\"M14 16 L15.5 17.5 L18 15\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <circle cx=\"19.5\" cy=\"9\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 9 L19.5 10.5 L21 8\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  identifier: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"8\" width=\"14\" height=\"7\" rx=\"0.8\" fill=\"white\"/>\n    <rect x=\"5\" y=\"10\" width=\"2.5\" height=\"3.5\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"10.5\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"9\" y=\"12.5\" width=\"4\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"12\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 12 L20 13.5 L21.5 11\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  // ==================== OTHER ====================
  assistance: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"11\" r=\"8\" fill=\"white\"/>\n    <path d=\"M11 7.5 Q13 7.5 13 9.5 Q13 10.5 11 11.5 L11 13\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"11\" cy=\"15\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"15\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 15 L20 16.5 L21.5 14\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  support: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 4 Q7 6.5 7 11 Q7 15.5 11 18 Q15 15.5 15 11 Q15 6.5 11 4\" fill=\"white\"/>\n    <circle cx=\"11\" cy=\"11\" r=\"2.5\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 13 L19.5 14.5 L21 12\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  guide: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"9\" cy=\"7.5\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M5 14.5 Q9 12 13 14.5 L13 18 L5 18 Z\" fill=\"white\"/>\n    <path d=\"M15 7.5 L19 7.5 M17 5.5 L17 9.5\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"14\" r=\"2\" fill=\"white\"/>\n  </svg>",
  meeting: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"8\" cy=\"7.5\" r=\"1.8\" fill=\"white\"/>\n    <circle cx=\"14\" cy=\"7.5\" r=\"1.8\" fill=\"white\"/>\n    <path d=\"M4.5 14 Q8 11.5 11.5 14\" fill=\"white\"/>\n    <path d=\"M10.5 14 Q14 11.5 17.5 14\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 11 L20 12.5 L21.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  subscription: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"7\" width=\"12\" height=\"9\" rx=\"0.8\" fill=\"white\"/>\n    <path d=\"M8 11 L10 13 L14 9\" stroke=\"white\" stroke-width=\"1.3\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n    <rect x=\"7\" y=\"4\" width=\"1.5\" height=\"3\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"12.5\" y=\"4\" width=\"1.5\" height=\"3\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"19.5\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 11.5 L19.5 13 L21 10.5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  cancellation: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"11\" r=\"8\" fill=\"white\"/>\n    <path d=\"M7 7 L15 15 M15 7 L7 15\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"15\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 13.5 L21.5 16.5 M21.5 13.5 L18.5 16.5\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\"/>\n  </svg>",
  forwarding: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"3\" y=\"7\" width=\"9\" height=\"9\" rx=\"0.5\" fill=\"white\"/>\n    <path d=\"M12 7 L18 11.5 L12 16\" stroke=\"white\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <circle cx=\"20.5\" cy=\"11.5\" r=\"2\" fill=\"white\"/>\n    <path d=\"M19 11.5 L20.5 13 L22 10.5\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  diplomatic: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"8\" cy=\"8\" r=\"5.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M3 8 L13 8 M8 2.5 Q5.5 8 8 13.5 M8 2.5 Q10.5 8 8 13.5\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n    <circle cx=\"17\" cy=\"15\" r=\"5.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <path d=\"M12 15 L22 15 M17 9.5 Q14.5 15 17 20.5 M17 9.5 Q19.5 15 17 20.5\" stroke=\"white\" stroke-width=\"0.8\" opacity=\"0.3\"/>\n  </svg>",
  apostille: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"5\" y=\"4\" width=\"10\" height=\"14\" rx=\"0.5\" fill=\"white\"/>\n    <circle cx=\"10\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M8 15 Q10 13 12 15\" stroke=\"white\" stroke-width=\"1\" fill=\"none\"/>\n    <rect x=\"7\" y=\"16.5\" width=\"6\" height=\"0.4\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"18.5\" cy=\"12\" r=\"2.5\" fill=\"white\"/>\n    <path d=\"M17 12 L18.5 13.5 L20 11\" stroke=\"white\" stroke-width=\"0.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\" opacity=\"0.3\"/>\n  </svg>",
  museum: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L4 6.5 L4 7.5 L18 7.5 L18 6.5 Z\" fill=\"white\"/>\n    <rect x=\"6\" y=\"8.5\" width=\"2\" height=\"8\" fill=\"white\"/>\n    <rect x=\"10\" y=\"8.5\" width=\"2\" height=\"8\" fill=\"white\"/>\n    <rect x=\"14\" y=\"8.5\" width=\"2\" height=\"8\" fill=\"white\"/>\n    <rect x=\"4\" y=\"16.5\" width=\"14\" height=\"1.5\" fill=\"white\"/>\n    <circle cx=\"20\" cy=\"11\" r=\"2\" fill=\"white\"/>\n  </svg>",
  cinema: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <rect x=\"4\" y=\"6\" width=\"12\" height=\"12\" rx=\"0.5\" fill=\"white\"/>\n    <rect x=\"6\" y=\"8\" width=\"8\" height=\"6\" rx=\"0.3\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"7\" cy=\"16\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"11\" cy=\"16\" r=\"0.8\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"19\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M17.5 11 L19 12.5 L20.5 10\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  theater: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"7\" cy=\"9\" r=\"3\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M6 8 Q7 7 8 8\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M7 11 Q7 12 7 12\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n    <circle cx=\"15\" cy=\"9\" r=\"3\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M14 10 Q15 11 16 10\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <path d=\"M15 7 Q15 6 15 6\" stroke=\"white\" stroke-width=\"1\" stroke-linecap=\"round\" opacity=\"0.3\"/>\n  </svg>",
  vip: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"9\" r=\"3\" fill=\"white\"/>\n    <path d=\"M6 16 Q11 13 16 16 L16 19 L6 19 Z\" fill=\"white\"/>\n    <path d=\"M8 5 L11 9 L14 5\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <circle cx=\"19.5\" cy=\"13\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"19.5\" cy=\"13\" r=\"1\" fill=\"white\"/>\n  </svg>",
  limousine: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M3 11 L5 9 L16 9 L18 11 L18 14 L3 14 Z\" fill=\"white\"/>\n    <rect x=\"6\" y=\"10\" width=\"2\" height=\"2\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"10\" y=\"10\" width=\"2\" height=\"2\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <rect x=\"14\" y=\"10\" width=\"2\" height=\"2\" rx=\"0.2\" fill=\"white\" opacity=\"0.3\"/>\n    <circle cx=\"5\" cy=\"15\" r=\"1\" fill=\"white\"/>\n    <circle cx=\"16\" cy=\"15\" r=\"1\" fill=\"white\"/>\n    <circle cx=\"20.5\" cy=\"11.5\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"20.5\" cy=\"11.5\" r=\"1\" fill=\"white\"/>\n  </svg>",
  security: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <path d=\"M11 3 L5 5.5 L5 11 Q5 15 11 18 Q17 15 17 11 L17 5.5 Z\" fill=\"white\"/>\n    <circle cx=\"11\" cy=\"11\" r=\"2.5\" stroke=\"white\" stroke-width=\"1\" fill=\"none\" opacity=\"0.3\"/>\n    <circle cx=\"20\" cy=\"14\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18.5 14 L20 15.5 L21.5 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  surveillance: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"10\" cy=\"11\" r=\"4.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <circle cx=\"10\" cy=\"11\" r=\"2\" fill=\"white\"/>\n    <path d=\"M13 14 L16 17\" stroke=\"white\" stroke-width=\"1.5\" stroke-linecap=\"round\"/>\n    <circle cx=\"19.5\" cy=\"10\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M18 10 L19.5 11.5 L21 9\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n  </svg>",
  alarm: "<svg viewBox=\"0 0 24 24\" fill=\"none\">\n    <circle cx=\"11\" cy=\"11\" r=\"7\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M11 7 L11 11 L14 13\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n    <circle cx=\"19.5\" cy=\"15\" r=\"2.5\" stroke=\"white\" stroke-width=\"1.2\" fill=\"none\"/>\n    <path d=\"M19.5 13 L19.5 17\" stroke=\"white\" stroke-width=\"1.2\" stroke-linecap=\"round\"/>\n  </svg>"
};

// ==================== MAPPING MOTS-CLÉS ====================

var keywordToIcon = (_keywordToIcon = {
  // Administrative
  'passport': 'passport',
  'passeport': 'passport',
  'passaporte': 'passport',
  'visa': 'visa',
  'residence': 'visa',
  'permit': 'visa',
  'immigration': 'visa',
  'document': 'document',
  'paper': 'document',
  'file': 'file',
  'papers': 'document',
  'certificate': 'certificate',
  'certificat': 'certificate',
  'birth': 'certificate',
  'marriage': 'certificate',
  'divorce': 'certificate',
  'embassy': 'embassy',
  'consulate': 'embassy',
  'ambassade': 'embassy',
  'consulat': 'embassy',
  'consular': 'embassy',
  'stamp': 'stamp',
  'tampon': 'stamp',
  'seal': 'stamp',
  'lost': 'alert',
  'stolen': 'alert',
  'theft': 'alert',
  'civil': 'certificate',
  'status': 'document',
  'official': 'document',
  'registration': 'registration',
  'register': 'registration',
  'enroll': 'registration',
  'identifier': 'identifier',
  'identifiers': 'identifier',
  'identifiant': 'identifier',
  'expatriation': 'passport',
  'expat': 'passport',
  'diplomatic': 'diplomatic',
  'diplomatie': 'diplomatic',
  'diplomacy': 'diplomatic',
  'apostille': 'apostille',
  'legalization': 'apostille',
  // Banking
  'bank': 'bank',
  'banking': 'bank',
  'banque': 'bank',
  'account': 'bank',
  'money': 'money',
  'argent': 'money',
  'transfer': 'money',
  'currency': 'money',
  'exchange': 'money',
  'card': 'card',
  'carte': 'card',
  'credit': 'card',
  'debit': 'card',
  'tax': 'tax',
  'taxation': 'tax',
  'impot': 'tax',
  'fiscal': 'tax',
  'return': 'tax',
  'insurance': 'insurance',
  'assurance': 'insurance',
  'investment': 'investment',
  'investissement': 'investment',
  'invest': 'investment',
  'pension': 'pension',
  'retraite': 'pension',
  'retirement': 'pension',
  'loan': 'loan',
  'pret': 'loan'
}, _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, "credit", 'loan'), 'mortgage', 'loan'), 'box', 'box'), 'boite', 'box'), 'packaging', 'box'), 'boxes', 'box'), 'truck', 'truck'), 'camion', 'truck'), 'moving', 'truck'), 'demenagement', 'truck'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'move', 'truck'), 'storage', 'storage'), 'entreposage', 'storage'), 'warehouse', 'storage'), 'warehousing', 'storage'), 'package', 'package'), 'colis', 'package'), 'parcel', 'package'), 'parcels', 'package'), 'customs', 'customs'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'douane', 'customs'), 'clearance', 'customs'), 'duty', 'customs'), 'logistics', 'truck'), 'logistique', 'truck'), 'delivery', 'delivery'), 'livraison', 'delivery'), 'international', 'international_moving'), 'overseas', 'international_moving'), 'packing', 'packing'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'emballage', 'packing'), 'car', 'car'), 'voiture', 'car'), 'vehicle', 'car'), 'auto', 'car'), 'license', 'license'), 'permis', 'license'), 'driving', 'license'), 'driver', 'license'), 'scooter', 'scooter'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'motorcycle', 'scooter'), 'moto', 'scooter'), 'ticket', 'ticket'), 'billet', 'ticket'), 'fine', 'ticket'), 'violation', 'ticket'), 'transport', 'transport'), 'mobility', 'transport'), 'accident', 'accident'), 'accidente', 'accident'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'impound', 'car'), 'immobilization', 'car'), 'metro', 'metro'), 'subway', 'metro'), 'underground', 'metro'), 'bus', 'bus'), 'autobus', 'bus'), 'ferry', 'ferry'), 'boat', 'ferry'), 'bateau', 'ferry'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'taxi', 'taxi'), 'health', 'health'), 'sante', 'health'), 'medical', 'health'), 'medicine', 'medicine'), 'medication', 'medicine'), 'medicament', 'medicine'), 'pharmacy', 'medicine'), 'hospital', 'hospital'), 'hopital', 'hospital'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'clinic', 'hospital'), 'emergency', 'hospital'), 'wellbeing', 'wellbeing'), 'wellness', 'wellbeing'), 'coaching', 'wellbeing'), 'fitness', 'wellbeing'), 'consultation', 'health'), 'doctor', 'health'), 'treatment', 'medicine'), 'traitement', 'medicine'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'dentist', 'dentist'), 'dentiste', 'dentist'), 'dental', 'dentist'), 'optician', 'optician'), 'opticien', 'optician'), 'glasses', 'optician'), 'physiotherapy', 'physiotherapy'), 'physio', 'physiotherapy'), 'kine', 'physiotherapy'), 'spa', 'spa'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'thermes', 'spa'), 'massage', 'massage'), 'masseur', 'massage'), 'child', 'child'), 'enfant', 'child'), 'childcare', 'child'), 'kid', 'child'), 'children', 'child'), 'school', 'school'), 'ecole', 'school'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'education', 'school'), 'schooling', 'school'), 'book', 'book'), 'livre', 'book'), 'study', 'book'), 'language', 'language'), 'langue', 'language'), 'cours', 'language'), 'courses', 'language'), 'teacher', 'teacher'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'professeur', 'teacher'), 'tutor', 'teacher'), 'lesson', 'teacher'), 'elderly', 'child'), 'senior', 'child'), 'care', 'child'), 'student', 'school'), 'etudiant', 'school'), 'exam', 'certificate'), 'diploma', 'certificate'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'certification', 'certificate'), 'university', 'university'), 'universite', 'university'), 'college', 'university'), 'training', 'training_center'), 'formation', 'training_center'), 'wedding', 'wedding'), 'mariage', 'wedding'), 'birthday', 'birthday'), 'anniversaire', 'birthday'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'briefcase', 'briefcase'), 'work', 'briefcase'), 'job', 'briefcase'), 'travail', 'briefcase'), 'cv', 'cv'), 'resume', 'cv'), 'curriculum', 'cv'), 'company', 'company'), 'entreprise', 'company'), 'business', 'company'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'interview', 'interview'), 'entretien', 'interview'), 'freelance', 'freelance'), 'freelancing', 'freelance'), 'self-employment', 'freelance'), 'employment', 'briefcase'), 'emploi', 'briefcase'), 'recruit', 'interview'), 'payroll', 'money'), 'incorporation', 'company'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'creation', 'company'), 'compliance', 'document'), 'legal', 'lawyer'), 'legislation', 'document'), 'trademark', 'stamp'), 'patent', 'certificate'), 'architect', 'architect'), 'architecte', 'architect'), 'engineer', 'engineer'), 'ingenieur', 'engineer'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'accountant', 'accountant'), 'comptable', 'accountant'), 'consultant', 'consultant'), 'conseil', 'consultant'), 'home', 'home'), 'maison', 'home'), 'housing', 'home'), 'logement', 'home'), 'key', 'key'), 'cle', 'key'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'clef', 'key'), 'cleaning', 'cleaning'), 'menage', 'cleaning'), 'housekeeping', 'cleaning'), 'repair', 'repair'), 'reparation', 'repair'), 'maintenance', 'repair'), 'renovation', 'renovation'), 'renovations', 'renovation'), 'works', 'renovation'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'inspection', 'inspection'), 'inventory', 'inspection'), 'lease', 'contract'), 'bail', 'contract'), 'rental', 'home'), 'purchase', 'home'), 'sale', 'home'), 'buy', 'home'), 'sell', 'home'), "mortgage", 'bank'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'hypotheque', 'bank'), 'handover', 'key'), 'check-in', 'key'), 'check-out', 'key'), 'ironing', 'cleaning'), 'repassage', 'cleaning'), 'window', 'cleaning'), 'fenetre', 'cleaning'), 'gardening', 'gardening'), 'jardinage', 'gardening'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'plumbing', 'plumbing'), 'plomberie', 'plumbing'), 'painting', 'painting'), 'peinture', 'painting'), 'carpentry', 'carpentry'), 'menuiserie', 'carpentry'), 'security', 'security'), 'securite', 'security'), 'surveillance', 'surveillance'), 'camera', 'surveillance'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'alarm', 'alarm'), 'alarme', 'alarm'), 'phone', 'phone'), 'telephone', 'phone'), 'mobile', 'phone'), 'wifi', 'wifi'), 'internet', 'wifi'), 'network', 'wifi'), 'mail', 'mail'), 'email', 'mail'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'courrier', 'mail'), 'letter', 'mail'), 'translation', 'translation'), 'traduction', 'translation'), 'translate', 'translation'), 'interpreter', 'interpreter'), 'interprete', 'interpreter'), 'interpreting', 'interpreter'), 'pet', 'pet'), 'animal', 'pet'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'dog', 'pet'), 'cat', 'pet'), 'veterinarian', 'veterinary'), 'veterinary', 'veterinary'), 'vet', 'veterinary'), 'vaccination', 'medicine'), 'vaccines', 'medicine'), 'calendar', 'calendar'), 'calendrier', 'calendar'), 'agenda', 'calendar'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'appointment', 'calendar'), 'shopping', 'shopping'), "courses", 'shopping'), 'groceries', 'shopping'), 'food', 'food'), 'meal', 'food'), 'repas', 'food'), 'nourriture', 'food'), 'concierge', 'concierge'), 'conciergerie', 'concierge'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'sitting', 'concierge'), "surveillance", 'inspection'), 'errands', 'delivery'), 'pickup', 'delivery'), 'computer', 'computer'), 'ordinateur', 'computer'), 'laptop', 'computer'), 'settings', 'settings'), 'parametres', 'settings'), 'configuration', 'settings'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'software', 'software'), 'logiciel', 'software'), 'application', 'software'), 'backup', 'backup'), 'sauvegarde', 'backup'), 'antivirus', 'settings'), "security", 'insurance'), 'troubleshoot', 'repair'), 'install', 'settings'), 'lawyer', 'lawyer'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'avocat', 'lawyer'), 'notary', 'notary'), 'notaire', 'notary'), 'contract', 'contract'), 'contrat', 'contract'), 'complaint', 'complaint'), 'plainte', 'complaint'), 'dispute', 'dispute'), 'litige', 'dispute'), 'hearing', 'hearing'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'audience', 'hearing'), 'rights', 'document'), 'obligations', 'document'), 'appeal', 'document'), 'recours', 'document'), 'scam', 'alert'), 'arnaque', 'alert'), 'plane', 'plane'), 'avion', 'plane'), 'flight', 'plane'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'hotel', 'hotel'), 'accommodation', 'hotel'), 'suitcase', 'suitcase'), 'valise', 'suitcase'), 'luggage', 'suitcase'), 'train', 'train'), 'booking', 'calendar'), 'reservation', 'calendar'), 'garden', 'garden'), 'jardin', 'garden'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'outdoor', 'outdoor'), 'mowing', 'garden'), 'weeding', 'garden'), 'hedges', 'garden'), 'pool', 'pool'), 'piscine', 'pool'), 'electricity', 'electricity'), 'electric', 'electricity'), 'energy', 'electricity'), 'water', 'water'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'eau', 'water'), 'gas', 'gas'), 'gaz', 'gas'), 'folder', 'folder'), 'dossier', 'folder'), 'alert', 'alert'), 'urgence', 'emergency'), 'urgent', 'emergency'), 'incident', 'alert'), 'incidents', 'alert'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'museum', 'museum'), 'musee', 'museum'), 'cinema', 'cinema'), 'movie', 'cinema'), 'film', 'cinema'), 'theater', 'theater'), 'theatre', 'theater'), 'vip', 'vip'), 'premium', 'vip'), 'luxury', 'vip'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'limousine', 'limousine'), 'limo', 'limousine'), 'assistance', 'assistance'), 'aide', 'assistance'), 'help', 'assistance'), 'support', 'support'), 'soutien', 'support'), 'guide', 'guide'), 'accompany', 'guide'), 'assist', 'assistance'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_keywordToIcon, 'meeting', 'meeting'), 'reunion', 'meeting'), 'subscription', 'subscription'), 'abonnement', 'subscription'), 'subscribe', 'subscription'), 'cancellation', 'cancellation'), 'cancel', 'cancellation'), 'terminate', 'cancellation'), 'forwarding', 'forwarding'), 'redirection', 'forwarding'));

// ==================== SYSTÈME DE CACHE ET TRACKING ====================

// Cache global pour garantir la stabilité
var iconCache = new Map();

// Tracking des icônes utilisées par famille (par catégorie parente)
var familyIconUsage = new Map();

// ==================== FONCTIONS UTILITAIRES ====================

function generateStableHash(str) {
  var hash = 0;
  for (var i = 0; i < str.length; i++) {
    hash = (hash << 5) - hash + str.charCodeAt(i);
  }
  return Math.abs(hash);
}
function normalizeString(str) {
  return str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim();
}
function getAvailableIcons() {
  var usedIcons = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var allIcons = Object.keys(iconLibrary);
  return allIcons.filter(function (icon) {
    return !usedIcons.includes(icon);
  });
}

// ==================== SYSTÈME DE SCORING ====================

function findBestMatchingIcon(categoryName) {
  var excludedIcons = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
  var normalized = normalizeString(categoryName);
  var words = normalized.split(/[\s\-_&,/()]+/);
  var iconScores = new Map();
  var availableIcons = Object.keys(iconLibrary).filter(function (icon) {
    return !excludedIcons.includes(icon);
  });
  availableIcons.forEach(function (iconName) {
    var score = 0;

    // 1. Correspondance exacte de mot (score max: 100)
    words.forEach(function (word) {
      if (keywordToIcon[word] === iconName) {
        score += 100;
      }
    });

    // 2. Correspondance partielle dans le nom de catégorie (score: 50)
    Object.entries(keywordToIcon).forEach(function (_ref) {
      var _ref2 = _slicedToArray(_ref, 2),
        keyword = _ref2[0],
        icon = _ref2[1];
      if (icon === iconName) {
        if (normalized.includes(keyword)) {
          score += 50;
        }
        // 3. Correspondance partielle des mots (score: 20)
        words.forEach(function (word) {
          if (word.includes(keyword) || keyword.includes(word)) {
            score += 20;
          }
        });
      }
    });
    if (score > 0) {
      iconScores.set(iconName, score);
    }
  });
  if (iconScores.size > 0) {
    var sortedIcons = _toConsumableArray(iconScores.entries()).sort(function (a, b) {
      return b[1] - a[1];
    });
    return sortedIcons[0][0];
  }
  return null;
}

// ==================== FONCTION PRINCIPALE ====================

/**
 * Obtient une icône stable et unique pour une catégorie
 * @param {string} categoryName - Nom de la catégorie
 * @param {number|string} categoryId - ID unique de la catégorie
 * @param {string} parentId - ID de la catégorie parente (pour tracking de famille)
 * @returns {string} SVG de l'icône
 */
function getCategoryIcon(categoryName, categoryId) {
  var parentId = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'root';
  // Créer une clé stable unique
  var stableKey = "".concat(parentId, "/").concat(categoryId);

  // 1. Vérifier le cache (garantit la stabilité)
  if (iconCache.has(stableKey)) {
    return iconCache.get(stableKey);
  }

  // 2. Obtenir les icônes déjà utilisées dans cette famille
  if (!familyIconUsage.has(parentId)) {
    familyIconUsage.set(parentId, new Set());
  }
  var usedInFamily = Array.from(familyIconUsage.get(parentId));

  // 3. Chercher la meilleure correspondance sémantique
  var selectedIconName = findBestMatchingIcon(categoryName, usedInFamily);

  // 4. Si pas de match, utiliser un hash stable sur les icônes disponibles
  if (!selectedIconName) {
    var availableIcons = getAvailableIcons(usedInFamily);
    if (availableIcons.length === 0) {
      // Si toutes les icônes sont utilisées, réinitialiser pour cette famille
      familyIconUsage.get(parentId).clear();
      selectedIconName = 'folder'; // Icône par défaut
    } else {
      var hashSource = "".concat(categoryName, "_").concat(categoryId);
      var hash = generateStableHash(hashSource);
      selectedIconName = availableIcons[hash % availableIcons.length];
    }
  }

  // 5. Enregistrer l'icône utilisée
  familyIconUsage.get(parentId).add(selectedIconName);
  var iconSVG = iconLibrary[selectedIconName] || iconLibrary['folder'];
  iconCache.set(stableKey, iconSVG);
  return iconSVG;
}

/**
 * Réinitialise le cache (utile pour tests ou développement)
 */
function clearIconCache() {
  iconCache.clear();
  familyIconUsage.clear();
}

/**
 * Pour la compatibilité avec l'ancien code
 */
function getCategoryIconName(categoryName, categoryId) {
  var parentId = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'root';
  var stableKey = "".concat(parentId, "/").concat(categoryId);
  if (iconCache.has(stableKey)) {
    // Trouver le nom de l'icône depuis le SVG
    var svg = iconCache.get(stableKey);
    for (var _i = 0, _Object$entries = Object.entries(iconLibrary); _i < _Object$entries.length; _i++) {
      var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
        name = _Object$entries$_i[0],
        svgContent = _Object$entries$_i[1];
      if (svgContent === svg) {
        return name;
      }
    }
  }

  // Si pas en cache, calculer
  getCategoryIcon(categoryName, categoryId, parentId);
  return getCategoryIconName(categoryName, categoryId, parentId);
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  iconLibrary: iconLibrary,
  keywordToIcon: keywordToIcon,
  getCategoryIcon: getCategoryIcon,
  getCategoryIconName: getCategoryIconName,
  clearIconCache: clearIconCache
});

/***/ }),

/***/ "./resources/js/modules/ui/mobile-menu.js":
/*!************************************************!*\
  !*** ./resources/js/modules/ui/mobile-menu.js ***!
  \************************************************/
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

/***/ "./resources/js/modules/ui/scroll-utils.js":
/*!*************************************************!*\
  !*** ./resources/js/modules/ui/scroll-utils.js ***!
  \*************************************************/
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

/***/ "./resources/js/modules/wizard/wizard_provider/wizard-core.js":
/*!********************************************************************!*\
  !*** ./resources/js/modules/wizard/wizard_provider/wizard-core.js ***!
  \********************************************************************/
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
 * ═══════════════════════════════════════════════════════════
 * Wizard Core - VERSION CORRIGÉE
 * ✅ CORRECTIONS MAJEURES :
 * - Suppression du stopPropagation agressif
 * - Event listeners directs au lieu de délégation
 * - Meilleure gestion des clics
 * ═══════════════════════════════════════════════════════════
 */

var WizardCore = /*#__PURE__*/function () {
  function WizardCore() {
    _classCallCheck(this, WizardCore);
    this.storeKey = 'expats';
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
      this.setBtnEnabled('#mobileNextBtn, #desktopNextBtn', ok);
    }
  }, {
    key: "setBtnEnabled",
    value: function setBtnEnabled(selector, enabled) {
      var nodes = document.querySelectorAll(selector);
      nodes.forEach(function (el) {
        try {
          el.disabled = !enabled;
        } catch (_) {}
        // ✅ Le CSS gère TOUT le reste via :disabled
      });
    }
  }, {
    key: "validate",
    value: function validate(i) {
      var stepNum = i + 1;
      var step = this.steps[i];
      if (!step) return true;

      // Appeler la validation custom en premier
      var customValidate = window["validateStep".concat(stepNum)];
      if (typeof customValidate === 'function') {
        try {
          return !!customValidate();
        } catch (e) {
          console.error("validateStep".concat(stepNum, " error:"), e);
          return false;
        }
      }

      // Validation générique
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
      var popup = document.getElementById('signupPopup');
      if (!popup) {
        console.log('ℹ️ Signup popup not found - user might be logged in');
        return;
      }

      // ═══════════════════════════════════════════════════════════
      // ✅ CORRECTION #1 : SUPPRIMER LE STOP PROPAGATION AGRESSIF
      // On ne bloque plus tous les clics internes
      // ═══════════════════════════════════════════════════════════

      // ❌ ANCIEN CODE - SUPPRIMÉ :
      // const popupContainer = popup.querySelector('.bg-white');
      // if (popupContainer) {
      //   popupContainer.addEventListener('click', (e) => {
      //     e.stopPropagation();
      //   }, true);
      // }

      // ✅ NOUVEAU CODE - Bloquer uniquement les clics sur le backdrop
      popup.addEventListener('click', function (e) {
        // Si le clic est exactement sur le backdrop (pas sur le contenu)
        if (e.target === popup) {
          e.preventDefault();
          // Ne pas fermer automatiquement - seulement avec la croix
          console.log('🖱️ Backdrop clicked - popup remains open');
        }
      }, false);

      // ═══════════════════════════════════════════════════════════
      // ✅ CORRECTION #2 : EVENT LISTENERS DIRECTS
      // Au lieu de délégation d'événements complexe
      // ═══════════════════════════════════════════════════════════

      // Boutons de fermeture
      var closeButtons = document.querySelectorAll('#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"]');
      closeButtons.forEach(function (btn) {
        if (btn) {
          btn.addEventListener('click', function (e) {
            console.log('❌ [Wizard] Close button clicked:', btn.id || btn.className);
            e.preventDefault();
            e.stopPropagation();
            _this.closePopup();
          }, false);
        }
      });

      // Boutons d'ouverture
      var openButtons = document.querySelectorAll('#signupBtn, #mobileSignupBtn, [data-action="open-signup"]');
      openButtons.forEach(function (btn) {
        if (btn) {
          btn.addEventListener('click', function (e) {
            console.log('📝 [Wizard] Sign Up button clicked:', btn.id || btn.className);
            e.preventDefault();
            e.stopPropagation();
            _this.openPopup();
          }, false);
        }
      });

      // ═══════════════════════════════════════════════════════════
      // ⌨️ ESC key pour fermer (optionnel - peut être activé)
      // ═══════════════════════════════════════════════════════════
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
          console.log('⌨️ [Wizard] ESC pressed');
          _this.closePopup();
        }
      });

      // ═══════════════════════════════════════════════════════════
      // 🌍 Fonctions globales pour compatibilité
      // ═══════════════════════════════════════════════════════════
      window.openSignupPopup = function () {
        return _this.openPopup();
      };
      window.closeSignupPopup = function () {
        return _this.closePopup();
      };
      console.log('✅ Popup controls initialized (direct event listeners)');
      console.log('   - Close buttons found:', closeButtons.length);
      console.log('   - Open buttons found:', openButtons.length);
    }
  }, {
    key: "closePopup",
    value: function closePopup() {
      var popup = document.getElementById('signupPopup');
      if (!popup) {
        console.warn('⚠️ Popup not found');
        return;
      }
      popup.classList.add('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
      popup.setAttribute('aria-hidden', 'true');
      popup.style.display = 'none';

      // Restaurer le scroll du body
      document.body.style.overflow = '';
      console.log('✅ Popup closed');
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
      popup.classList.remove('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
      popup.removeAttribute('aria-hidden');
      popup.style.display = 'flex';

      // Bloquer le scroll du body
      document.body.style.overflow = 'hidden';
      console.log('✅ Popup opened');
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

// ═══════════════════════════════════════════════════════════
// 🚀 EXPORT ET INITIALISATION
// ═══════════════════════════════════════════════════════════
function initializeWizard() {
  if (window.providerWizard) {
    console.log('⚠️ Wizard already initialized');
    return window.providerWizard;
  }
  var wizard = new WizardCore();
  wizard.init();

  // API publique pour compatibilité
  window.providerWizard = {
    update: function update() {
      return wizard.updateUI();
    },
    close: function close() {
      return wizard.closePopup();
    },
    open: function open() {
      return wizard.openPopup();
    },
    wizard: wizard
  };
  console.log('✅ Wizard API exposed globally');
  return window.providerWizard;
}

/***/ }),

/***/ "./resources/js/modules/wizard/wizard_provider/wizard-steps.js":
/*!*********************************************************************!*\
  !*** ./resources/js/modules/wizard/wizard_provider/wizard-steps.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   WizardSteps: () => (/* binding */ WizardSteps),
/* harmony export */   initializeWizardSteps: () => (/* binding */ initializeWizardSteps)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Wizard Steps – VERSION CORRIGÉE
 * ✅ totalSteps = 17
 * ✅ Gère step13bis en plus des IDs numériques
 * ✅ Le JavaScript ne touche JAMAIS au style
 * ✅ Gère uniquement btn.disabled = true/false
 * ✅ HARMONISATION localStorage - pas de conflit entre steps
 */

var WizardSteps = /*#__PURE__*/function () {
  function WizardSteps() {
    _classCallCheck(this, WizardSteps);
    this.currentStep = 0;
    this.totalSteps = 17;
    this.storeKey = 'expats';
    this.formData = this.loadFormData();

    // ═══════════════════════════════════════════════════════════
    // MAPPING DES STEPS (pour gérer step13bis)
    // ═══════════════════════════════════════════════════════════
    this.stepIds = ['step1',
    // 0
    'step2',
    // 1
    'step3',
    // 2
    'step4',
    // 3
    'step5',
    // 4
    'step6',
    // 5
    'step7',
    // 6
    'step8',
    // 7
    'step9',
    // 8
    'step10',
    // 9
    'step11',
    // 10
    'step12',
    // 11
    'step13',
    // 12 - Email
    'step13bis',
    // 13 - Password ← STEP SPÉCIAL
    'step14',
    // 14 - Phone
    'step15',
    // 15 - OTP
    'step16' // 16 - Success
    ];
    console.log('🎬 WizardSteps constructor called - totalSteps:', this.totalSteps);
    console.log('📋 Step IDs mapping:', this.stepIds);
  }
  return _createClass(WizardSteps, [{
    key: "loadFormData",
    value: function loadFormData() {
      try {
        var data = JSON.parse(localStorage.getItem('expats')) || {};
        console.log('💾 Form data loaded from localStorage:', Object.keys(data));
        return data;
      } catch (_unused) {
        console.warn('⚠️ Failed to load form data from localStorage');
        return {};
      }
    }
  }, {
    key: "saveFormData",
    value: function saveFormData() {
      try {
        // ✅ NE PAS écraser - merger avec l'existant
        var existing = JSON.parse(localStorage.getItem(this.storeKey) || '{}');
        var merged = _objectSpread(_objectSpread({}, existing), this.formData);
        localStorage.setItem(this.storeKey, JSON.stringify(merged));
        console.log('💾 Form data merged into localStorage');
      } catch (_unused2) {
        console.warn('⚠️ Failed to save form data to localStorage');
      }
    }

    /**
     * Récupérer l'ID du step à partir de l'index
     */
  }, {
    key: "getStepId",
    value: function getStepId(index) {
      return this.stepIds[index] || "step".concat(index + 1);
    }

    /**
     * Récupérer l'élément DOM du step à partir de l'index
     */
  }, {
    key: "getStepElement",
    value: function getStepElement(index) {
      var stepId = this.getStepId(index);
      return document.getElementById(stepId);
    }
  }, {
    key: "init",
    value: function init() {
      console.log('🎬 WizardSteps.init() called');
      this.initNavigationButtons();
      this.initDelegatedGoTo();
      this.initStepValidation();
      this.initProgressBar();
      this.showStep(0);
      window.wizardSteps = this;
      console.log('✅ WizardSteps initialized');
    }
  }, {
    key: "initDelegatedGoTo",
    value: function initDelegatedGoTo() {
      var _this = this;
      document.addEventListener('click', function (e) {
        var go = e.target && e.target.closest && e.target.closest('[data-go-step]');
        if (!go) return;
        var to = parseInt(go.getAttribute('data-go-step'), 10);
        if (!Number.isFinite(to) || to < 1 || to > _this.totalSteps) return;
        e.preventDefault();
        console.log('🎯 [data-go-step] clicked - going to step:', to);
        _this.showStep(to - 1);
      }, true);
    }
  }, {
    key: "syncCurrentFromDOM",
    value: function syncCurrentFromDOM() {
      for (var i = 0; i < this.totalSteps; i++) {
        var s = this.getStepElement(i);
        if (s && !s.classList.contains('hidden')) {
          this.currentStep = i;
          console.log('🔄 syncCurrentFromDOM - current step index:', i, '- ID:', this.getStepId(i));
          return;
        }
      }
    }
  }, {
    key: "initNavigationButtons",
    value: function initNavigationButtons() {
      var _this2 = this;
      document.querySelectorAll('#mobileNextBtn, #desktopNextBtn').forEach(function (btn) {
        return btn.addEventListener('click', function (e) {
          e.preventDefault();
          console.log('➡️ Next button clicked from step index', _this2.currentStep, '(', _this2.getStepId(_this2.currentStep), ')');
          _this2.nextStep();
        });
      });
      document.querySelectorAll('#mobileBackBtn, #desktopBackBtn').forEach(function (btn) {
        return btn.addEventListener('click', function (e) {
          e.preventDefault();
          console.log('⬅️ Back button clicked from step index', _this2.currentStep, '(', _this2.getStepId(_this2.currentStep), ')');
          _this2.previousStep();
        });
      });
    }
  }, {
    key: "initStepValidation",
    value: function initStepValidation() {
      var _this3 = this;
      var _loop = function _loop() {
        var el = _this3.getStepElement(i);
        if (!el) return 1; // continue
        var h = function h() {
          return _this3.updateNavigationButtons();
        };
        el.querySelectorAll('input, select, textarea').forEach(function (n) {
          n.addEventListener('input', h);
          n.addEventListener('change', h);
        });
      };
      for (var i = 0; i < this.totalSteps; i++) {
        if (_loop()) continue;
      }
      document.addEventListener('click', function (e) {
        if (e.target && e.target.closest && e.target.closest('[id^="step"]')) {
          setTimeout(function () {
            return _this3.updateNavigationButtons();
          }, 50);
        }
      }, true);
    }
  }, {
    key: "initProgressBar",
    value: function initProgressBar() {
      this.updateProgressBar();
    }
  }, {
    key: "updateProgressBar",
    value: function updateProgressBar() {
      var n = document.getElementById('currentStepNum');
      var p = document.getElementById('progressPercentage');
      var bar = document.getElementById('mobileProgressBar');
      if (n) n.textContent = String(this.currentStep + 1);
      var pct = Math.round((this.currentStep + 1) / this.totalSteps * 100);
      if (p) p.textContent = String(pct);
      if (bar) bar.style.width = "".concat(pct, "%");
      console.log('📊 Progress bar updated - step index', this.currentStep, '(', this.getStepId(this.currentStep), ')', 'of', this.totalSteps, "(".concat(pct, "%)"));
    }
  }, {
    key: "showStep",
    value: function showStep(i) {
      console.log('🎬 showStep() called with index:', i, '→ Will show', this.getStepId(i));
      if (i < 0 || i >= this.totalSteps) {
        console.warn('❌ Invalid step index:', i, "(totalSteps: ".concat(this.totalSteps, ")"));
        return;
      }

      // ═══════════════════════════════════════════════════════════
      // 🔄 STEP 4 : Auto-reset quand on y arrive
      // ═══════════════════════════════════════════════════════════
      if (i === 3) {
        // step4
        this.resetStep4();
      }
      console.log('🙈 Hiding all steps...');
      for (var k = 0; k < this.totalSteps; k++) {
        var s = this.getStepElement(k);
        if (s) {
          s.classList.add('hidden');
          console.log("  \uD83D\uDE48 ".concat(this.getStepId(k), " \u2192 hidden"));
        } else {
          console.warn("  \u274C ".concat(this.getStepId(k), " element not found in DOM"));
        }
      }
      var cur = this.getStepElement(i);
      if (!cur) {
        console.error("\u274C Step element not found: ".concat(this.getStepId(i)));
        return;
      }
      cur.classList.remove('hidden');
      console.log("\uD83D\uDC41\uFE0F ".concat(this.getStepId(i), " \u2192 VISIBLE"));
      this.currentStep = i;
      this.updateProgressBar();
      this.updateNavigationButtons();
      console.log('✅ showStep completed - current step is now:', this.getStepId(this.currentStep));
    }
  }, {
    key: "resetStep4",
    value: function resetStep4() {
      console.log('🔄 Resetting step4...');
      var step4 = this.getStepElement(3);
      if (!step4) return;

      // Reset tous les inputs du step 4
      step4.querySelectorAll('input, select, textarea').forEach(function (input) {
        if (input.type === 'checkbox' || input.type === 'radio') {
          input.checked = false;
        } else {
          input.value = '';
        }
      });

      // Supprimer les données du step 4 de localStorage
      try {
        var data = JSON.parse(localStorage.getItem(this.storeKey) || '{}');

        // Supprimer toutes les clés liées au step 4
        step4.querySelectorAll('input, select, textarea').forEach(function (input) {
          if (input.name) {
            delete data[input.name];
          }
        });
        localStorage.setItem(this.storeKey, JSON.stringify(data));
        console.log('✅ Step 4 reset - data removed from localStorage');
      } catch (e) {
        console.warn('⚠️ Failed to reset step4 in localStorage');
      }
    }
  }, {
    key: "nextStep",
    value: function nextStep() {
      console.log('➡️ nextStep() called from', this.getStepId(this.currentStep));
      this.saveCurrentStepData();
      if (this.currentStep < this.totalSteps - 1) {
        var nextStepIndex = this.currentStep + 1;
        console.log('➡️ Moving to', this.getStepId(nextStepIndex));
        this.showStep(nextStepIndex);
      } else {
        console.log('📤 Last step reached, submitting form');
        this.submitForm();
      }
    }
  }, {
    key: "previousStep",
    value: function previousStep() {
      console.log('⬅️ previousStep() called from', this.getStepId(this.currentStep));
      if (this.currentStep > 0) {
        var prevStepIndex = this.currentStep - 1;
        console.log('⬅️ Moving to', this.getStepId(prevStepIndex));
        this.showStep(prevStepIndex);
      } else {
        console.warn('⚠️ Already at Step 1 - cannot go back further');
      }
    }
  }, {
    key: "validateCurrentStep",
    value: function validateCurrentStep() {
      this.syncCurrentFromDOM();
      var stepId = this.getStepId(this.currentStep);
      var el = this.getStepElement(this.currentStep);
      console.log('🔍 validateCurrentStep() for', stepId, '(index:', this.currentStep, ')');
      if (!el) {
        console.warn('❌ Step element not found for validation:', stepId);
        return true;
      }

      // ✅ VALIDATION STEP 1 : toujours valide
      if (this.currentStep === 0) {
        console.log('✅ Step 1 - always valid (profile choice via buttons)');
        return true;
      }

      // ✅ APPELER LA VALIDATION CUSTOM
      // Pour step13bis, on cherche validateStep13bis()
      var validationFunctionName = "validate".concat(stepId.charAt(0).toUpperCase() + stepId.slice(1));
      var custom = window[validationFunctionName];
      if (typeof custom === 'function') {
        console.log("\uD83D\uDD0D Calling custom validation: ".concat(validationFunctionName, "() - silent"));
        try {
          var result = !!custom();
          console.log("".concat(result ? '✅' : '❌', " ").concat(validationFunctionName, "() returned:"), result);
          return result;
        } catch (e) {
          console.error("\u274C ".concat(validationFunctionName, " error:"), e);
          return false;
        }
      }

      // Validation générique
      console.log('🔍 No custom validation found, using generic validation');
      var req = el.querySelectorAll('[data-required]');
      if (!req.length) {
        console.log('✅ No required fields found - step valid');
        return true;
      }
      console.log('🔍 Checking', req.length, 'required fields...');
      var _iterator = _createForOfIteratorHelper(req),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var input = _step.value;
          if (['checkbox', 'radio'].includes(input.type)) {
            if (!input.checked) {
              console.warn('❌ Required checkbox/radio not checked:', input.name);
              return false;
            }
          } else {
            if (String(input.value || '').trim() === '') {
              console.warn('❌ Required field empty:', input.name);
              return false;
            }
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
      console.log('✅ All required fields valid');
      return true;
    }
  }, {
    key: "updateNavigationButtons",
    value: function updateNavigationButtons() {
      console.log('🔄 updateNavigationButtons() called');
      this.syncCurrentFromDOM();
      var mobileWrap = document.getElementById('mobileNavButtons');
      var desktopWrap = document.getElementById('desktopNavButtons');
      var backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
      var nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');

      // ✅ Au Step 1, masquer TOUS les boutons de navigation
      if (this.currentStep === 0) {
        if (mobileWrap) mobileWrap.style.display = 'none';
        if (desktopWrap) desktopWrap.style.display = 'none';
        console.log('🚫 Step 1 - Navigation buttons HIDDEN');
        return;
      }

      // À partir du Step 2 : afficher les wrappers de navigation
      if (mobileWrap) mobileWrap.style.display = '';
      if (desktopWrap) desktopWrap.style.display = '';
      console.log('✅ Step 2+ - Navigation buttons VISIBLE');

      // ✅ Back TOUJOURS visible
      backButtons.forEach(function (b) {
        return b.style.display = 'flex';
      });
      console.log('🔘 Back button: ALWAYS visible');

      // Texte du bouton Next/Submit
      var isLastStep = this.currentStep === this.totalSteps - 1;
      nextButtons.forEach(function (btn) {
        var span = btn.querySelector('span');
        if (span) span.textContent = isLastStep ? 'Submit' : 'Continue';
      });
      console.log("\uD83D\uDD18 Next button text: ".concat(isLastStep ? 'Submit' : 'Continue'));

      // Validation
      var isValid = this.validateCurrentStep();
      console.log("\uD83D\uDD18 ".concat(this.getStepId(this.currentStep), " validation result:"), isValid);

      // ✅ UNIQUEMENT btn.disabled - Le CSS gère TOUT le reste
      nextButtons.forEach(function (btn) {
        btn.disabled = !isValid;
        btn.setAttribute('aria-disabled', String(!isValid));
      });
      console.log('✅ Navigation buttons updated');
    }
  }, {
    key: "saveCurrentStepData",
    value: function saveCurrentStepData() {
      var _this4 = this;
      var el = this.getStepElement(this.currentStep);
      if (!el) {
        console.warn('❌ Cannot save step data - element not found');
        return;
      }
      var stepId = this.getStepId(this.currentStep);

      // ═══════════════════════════════════════════════════════════
      // ✅ STEPS avec gestion CUSTOM de localStorage
      // Ces steps gèrent leur propre sauvegarde, on ne fait rien ici
      // ═══════════════════════════════════════════════════════════
      var customStorageSteps = ['step3', 'step13bis', 'step14', 'step15'];
      if (customStorageSteps.includes(stepId)) {
        console.log("\uD83D\uDCBE ".concat(stepId, " handles its own storage - skipping automatic save"));
        return;
      }

      // ═══════════════════════════════════════════════════════════
      // ✅ Step 11 (Documents) - Utilise l'API, pas localStorage
      // ═══════════════════════════════════════════════════════════
      if (stepId === 'step11') {
        console.log('💾 step11 uses API backend - skipping localStorage save');
        return;
      }
      console.log('💾 Saving data for', stepId);
      el.querySelectorAll('input, select, textarea').forEach(function (input) {
        if (!input.name) return;
        if (input.type === 'checkbox') {
          if (!_this4.formData[input.name]) _this4.formData[input.name] = [];
          if (input.checked) {
            if (!_this4.formData[input.name].includes(input.value)) {
              _this4.formData[input.name].push(input.value);
              console.log("  \u2705 Checkbox \"".concat(input.name, "\": added \"").concat(input.value, "\""));
            }
          } else {
            _this4.formData[input.name] = (_this4.formData[input.name] || []).filter(function (v) {
              return v !== input.value;
            });
            console.log("  \u274C Checkbox \"".concat(input.name, "\": removed \"").concat(input.value, "\""));
          }
        } else if (input.type === 'radio') {
          if (input.checked) {
            _this4.formData[input.name] = input.value;
            console.log("  \uD83D\uDCFB Radio \"".concat(input.name, "\": \"").concat(input.value, "\""));
          }
        } else {
          _this4.formData[input.name] = input.value || '';
          console.log("  \uD83D\uDCDD Field \"".concat(input.name, "\": \"").concat(input.value, "\""));
        }
      });
      this.saveFormData();
    }
  }, {
    key: "submitForm",
    value: function submitForm() {
      console.log('📤 submitForm() called');
      if (typeof window.onProviderSignupSubmit === 'function') {
        console.log('✅ Calling window.onProviderSignupSubmit()');
        try {
          window.onProviderSignupSubmit(this.formData);
          return;
        } catch (e) {
          console.error('❌ onProviderSignupSubmit failed:', e);
        }
      }
      console.log('📤 Submitting form...', this.formData);
      alert('Form submission not implemented');
    }
  }]);
}();
function initializeWizardSteps() {
  console.log('🚀 initializeWizardSteps() called');
  var ws = new WizardSteps();
  ws.init();
  window.providerWizardSteps = ws;
  if (!window.showStep) {
    window.showStep = function (i) {
      console.log('🌍 Global showStep() called with:', i);
      ws.showStep(i);
    };
  }
  if (!window.updateNavigationButtons) {
    window.updateNavigationButtons = function () {
      console.log('🌍 Global updateNavigationButtons() called');
      ws.updateNavigationButtons();
    };
  }
  console.log('✅ WizardSteps module ready');
  return ws;
}

/***/ }),

/***/ "./resources/js/modules/wizard/wizard_provider/wizard-submission.js":
/*!**************************************************************************!*\
  !*** ./resources/js/modules/wizard/wizard_provider/wizard-submission.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   WizardSubmission: () => (/* binding */ WizardSubmission),
/* harmony export */   initializeWizardSubmission: () => (/* binding */ initializeWizardSubmission)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * ═══════════════════════════════════════════════════════════
 * WIZARD SUBMISSION - Soumission finale vers /register
 * ═══════════════════════════════════════════════════════════
 * Le user est déjà connecté à ce stade (Auth::login fait au step 15)
 * Cette étape crée juste le provider en BDD
 */

var WizardSubmission = /*#__PURE__*/function () {
  function WizardSubmission() {
    var _document$querySelect;
    _classCallCheck(this, WizardSubmission);
    this.endpoint = '/register';
    this.storageKey = 'expats';
    this.csrfToken = ((_document$querySelect = document.querySelector('meta[name="csrf-token"]')) === null || _document$querySelect === void 0 ? void 0 : _document$querySelect.content) || '';
  }
  return _createClass(WizardSubmission, [{
    key: "submit",
    value: function () {
      var _submit = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        var formData, response, errorData, data, _t, _t2;
        return _regenerator().w(function (_context) {
          while (1) switch (_context.p = _context.n) {
            case 0:
              console.log('📤 [WizardSubmission] Starting provider signup submission...');

              // Récupérer les données
              _context.p = 1;
              formData = JSON.parse(localStorage.getItem(this.storageKey)) || {};
              console.log('📦 [WizardSubmission] Data to send:', formData);
              _context.n = 3;
              break;
            case 2:
              _context.p = 2;
              _t = _context.v;
              console.error('❌ [WizardSubmission] Failed to parse expats data:', _t);
              this.handleError(new Error('Invalid data format'));
              return _context.a(2);
            case 3:
              if (formData.email) {
                _context.n = 4;
                break;
              }
              this.handleError(new Error('Email is required'));
              return _context.a(2);
            case 4:
              if (formData.password) {
                _context.n = 5;
                break;
              }
              this.handleError(new Error('Password is required'));
              return _context.a(2);
            case 5:
              // Loader
              this.showLoader();
              _context.p = 6;
              _context.n = 7;
              return fetch(this.endpoint, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify(formData)
              });
            case 7:
              response = _context.v;
              console.log('📡 [WizardSubmission] Response status:', response.status);
              if (response.ok) {
                _context.n = 9;
                break;
              }
              _context.n = 8;
              return response.json()["catch"](function () {
                return {};
              });
            case 8:
              errorData = _context.v;
              throw new Error(errorData.message || "Server error: ".concat(response.status));
            case 9:
              _context.n = 10;
              return response.json();
            case 10:
              data = _context.v;
              console.log('✅ [WizardSubmission] Server response:', data);
              this.handleSuccess(data);
              _context.n = 12;
              break;
            case 11:
              _context.p = 11;
              _t2 = _context.v;
              console.error('❌ [WizardSubmission] Registration failed:', _t2);
              this.handleError(_t2);
            case 12:
              _context.p = 12;
              this.hideLoader();
              return _context.f(12);
            case 13:
              return _context.a(2);
          }
        }, _callee, this, [[6, 11, 12, 13], [1, 2]]);
      }));
      function submit() {
        return _submit.apply(this, arguments);
      }
      return submit;
    }()
  }, {
    key: "handleSuccess",
    value: function handleSuccess(data) {
      console.log('✅ [WizardSubmission] Registration successful:', data);

      // Vider localStorage
      localStorage.removeItem(this.storageKey);
      console.log('🗑️ [WizardSubmission] Cleared localStorage');

      // Afficher step 16
      this.showStep16();

      // Rediriger après 3 secondes
      var redirectUrl = data.redirect || '/dashboard';
      setTimeout(function () {
        console.log('🔄 [WizardSubmission] Redirecting to:', redirectUrl);
        window.location.href = redirectUrl;
      }, 3000);
    }
  }, {
    key: "handleError",
    value: function handleError(error) {
      console.error('❌ [WizardSubmission] Error:', error);
      var message = error.message || 'Failed to create account. Please try again.';

      // Message inline uniquement
      var errorAlert = document.getElementById('step15Error');
      var errorMessage = document.getElementById('step15ErrorMessage');
      if (errorAlert && errorMessage) {
        errorMessage.textContent = message;
        errorAlert.classList.remove('hidden');
        errorAlert.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      } else {
        alert("Error: ".concat(message));
      }
      if (navigator.vibrate) {
        navigator.vibrate([100, 50, 100]);
      }
    }
  }, {
    key: "showStep16",
    value: function showStep16() {
      console.log('🎉 [WizardSubmission] Showing step 16');

      // Masquer tous les steps
      for (var i = 1; i <= 16; i++) {
        var step = document.getElementById("step".concat(i));
        if (step) step.classList.add('hidden');
      }

      // Afficher step 16
      var step16 = document.getElementById('step16');
      if (step16) {
        step16.classList.remove('hidden');
      }

      // Masquer les boutons de navigation
      var mobileNav = document.getElementById('mobileNavButtons');
      var desktopNav = document.getElementById('desktopNavButtons');
      if (mobileNav) mobileNav.style.display = 'none';
      if (desktopNav) desktopNav.style.display = 'none';

      // Progress bar à 100%
      var progressBar = document.getElementById('mobileProgressBar');
      var progressPercentage = document.getElementById('progressPercentage');
      var currentStepNum = document.getElementById('currentStepNum');
      if (progressBar) progressBar.style.width = '100%';
      if (progressPercentage) progressPercentage.textContent = '100';
      if (currentStepNum) currentStepNum.textContent = '16';
    }
  }, {
    key: "showLoader",
    value: function showLoader() {
      var buttons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
      buttons.forEach(function (btn) {
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        btn.innerHTML = "\n        <svg class=\"animate-spin h-5 w-5 text-white inline-block mr-2\" fill=\"none\" viewBox=\"0 0 24 24\">\n          <circle class=\"opacity-25\" cx=\"12\" cy=\"12\" r=\"10\" stroke=\"currentColor\" stroke-width=\"4\"></circle>\n          <path class=\"opacity-75\" fill=\"currentColor\" d=\"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\"></path>\n        </svg>\n        <span>Creating Account...</span>\n      ";
      });
    }
  }, {
    key: "hideLoader",
    value: function hideLoader() {
      var buttons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
      buttons.forEach(function (btn) {
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        btn.innerHTML = "\n        <span>Continue</span>\n        <svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" viewBox=\"0 0 24 24\">\n          <path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M9 5l7 7-7 7\"/>\n        </svg>\n      ";
      });
    }
  }]);
}();
function initializeWizardSubmission() {
  var submission = new WizardSubmission();
  window.onProviderSignupSubmit = function () {
    submission.submit();
  };
  console.log('✅ [WizardSubmission] Module initialized');
  return submission;
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
/* harmony import */ var _modules_google_translate_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/google-translate/index.js */ "./resources/js/modules/google-translate/index.js");
/* harmony import */ var _modules_wizard_wizard_provider_wizard_core_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/wizard/wizard_provider/wizard-core.js */ "./resources/js/modules/wizard/wizard_provider/wizard-core.js");
/* harmony import */ var _modules_wizard_wizard_provider_wizard_steps_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/wizard/wizard_provider/wizard-steps.js */ "./resources/js/modules/wizard/wizard_provider/wizard-steps.js");
/* harmony import */ var _modules_wizard_wizard_provider_wizard_submission_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/wizard/wizard_provider/wizard-submission.js */ "./resources/js/modules/wizard/wizard_provider/wizard-submission.js");
/* harmony import */ var _modules_ui_mobile_menu_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/ui/mobile-menu.js */ "./resources/js/modules/ui/mobile-menu.js");
/* harmony import */ var _modules_ui_category_category_popups_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/ui/category/category-popups.js */ "./resources/js/modules/ui/category/category-popups.js");
/* harmony import */ var _modules_ui_scroll_utils_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./modules/ui/scroll-utils.js */ "./resources/js/modules/ui/scroll-utils.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Header Initialization - Professional Modular Architecture
 * Each feature is a self-contained module with a single entry point
 * 
 * @version 2.1.0 - CORRECTION BOUCLE INFINIE
 * @author ULIXAI Team
 */

// ═══════════════════════════════════════════════════════════
// IMPORTS - Feature Modules
// ═══════════════════════════════════════════════════════════

// Google Translate Module (complete package)


// Wizard Modules (Provider signup flow)




// UI Modules




// ═══════════════════════════════════════════════════════════
// UTILITY FUNCTIONS
// ═══════════════════════════════════════════════════════════

/**
 * Safe initialization wrapper
 * Isolates errors to prevent one module from breaking others
 * 
 * @param {string} name - Module name for logging
 * @param {Function} fn - Initialization function
 * @returns {*} Result of initialization or null on error
 */
function safeInit(_x, _x2) {
  return _safeInit.apply(this, arguments);
} // ═══════════════════════════════════════════════════════════
// MAIN INITIALIZATION
// ═══════════════════════════════════════════════════════════
/**
 * Initialize all header modules in the correct order
 * Handles conditional loading based on user state
 */
function _safeInit() {
  _safeInit = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(name, fn) {
    var result, _t;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.p = _context.n) {
        case 0:
          _context.p = 0;
          console.log("\uD83D\uDD04 [Header] Initializing ".concat(name, "..."));
          _context.n = 1;
          return fn();
        case 1:
          result = _context.v;
          console.log("\u2705 [Header] ".concat(name, " initialized successfully"));
          return _context.a(2, result);
        case 2:
          _context.p = 2;
          _t = _context.v;
          console.error("\u274C [Header] ".concat(name, " failed:"), _t);
          return _context.a(2, null);
      }
    }, _callee, null, [[0, 2]]);
  }));
  return _safeInit.apply(this, arguments);
}
function initializeAll() {
  return _initializeAll.apply(this, arguments);
} // ═══════════════════════════════════════════════════════════
// WIZARD HELPER FUNCTIONS
// ═══════════════════════════════════════════════════════════
/**
 * Expose wizard functions globally for legacy compatibility
 * Some inline scripts may still reference these functions
 * 
 * @param {Object} steps - WizardSteps instance
 */
function _initializeAll() {
  _initializeAll = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee9() {
    var popupExists, wizard, steps;
    return _regenerator().w(function (_context9) {
      while (1) switch (_context9.n) {
        case 0:
          console.log('🚀 [Header] Starting initialization...');
          console.log('📦 [Header] Available modules:', {
            googleTranslate: _typeof(_modules_google_translate_index_js__WEBPACK_IMPORTED_MODULE_0__.initializeGoogleTranslateModule),
            wizard: _typeof(_modules_wizard_wizard_provider_wizard_core_js__WEBPACK_IMPORTED_MODULE_1__.initializeWizard),
            steps: _typeof(_modules_wizard_wizard_provider_wizard_steps_js__WEBPACK_IMPORTED_MODULE_2__.initializeWizardSteps),
            submission: _typeof(_modules_wizard_wizard_provider_wizard_submission_js__WEBPACK_IMPORTED_MODULE_3__.initializeWizardSubmission),
            menu: _typeof(_modules_ui_mobile_menu_js__WEBPACK_IMPORTED_MODULE_4__.initializeMobileMenu),
            popups: _typeof(_modules_ui_category_category_popups_js__WEBPACK_IMPORTED_MODULE_5__.initializeCategoryPopups),
            scroll: _typeof(_modules_ui_scroll_utils_js__WEBPACK_IMPORTED_MODULE_6__.initializeScrollUtils)
          });

          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          // CHECK: Is signup popup present? (indicates logged out user)
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          popupExists = !!document.getElementById('signupPopup');
          console.log("\uD83D\uDCCA [Header] Signup popup ".concat(popupExists ? '✅ FOUND' : '⚠️ NOT FOUND', " in DOM"));

          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          // 1. GOOGLE TRANSLATE MODULE (always initialize first)
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          _context9.n = 1;
          return safeInit('GoogleTranslateModule', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2() {
            return _regenerator().w(function (_context2) {
              while (1) switch (_context2.n) {
                case 0:
                  _context2.n = 1;
                  return (0,_modules_google_translate_index_js__WEBPACK_IMPORTED_MODULE_0__.initializeGoogleTranslateModule)();
                case 1:
                  return _context2.a(2, _context2.v);
              }
            }, _callee2);
          })));
        case 1:
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          // 2. WIZARD MODULES (conditional - only if popup exists)
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          wizard = null;
          steps = null;
          if (!popupExists) {
            _context9.n = 5;
            break;
          }
          console.log('👤 [Header] User not logged in - initializing wizard...');

          // Core wizard (popup open/close, backdrop, ESC key)
          _context9.n = 2;
          return safeInit('Wizard', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3() {
            return _regenerator().w(function (_context3) {
              while (1) switch (_context3.n) {
                case 0:
                  return _context3.a(2, (0,_modules_wizard_wizard_provider_wizard_core_js__WEBPACK_IMPORTED_MODULE_1__.initializeWizard)());
              }
            }, _callee3);
          })));
        case 2:
          wizard = _context9.v;
          _context9.n = 3;
          return safeInit('WizardSteps', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee4() {
            return _regenerator().w(function (_context4) {
              while (1) switch (_context4.n) {
                case 0:
                  return _context4.a(2, (0,_modules_wizard_wizard_provider_wizard_steps_js__WEBPACK_IMPORTED_MODULE_2__.initializeWizardSteps)());
              }
            }, _callee4);
          })));
        case 3:
          steps = _context9.v;
          _context9.n = 4;
          return safeInit('WizardSubmission', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee5() {
            return _regenerator().w(function (_context5) {
              while (1) switch (_context5.n) {
                case 0:
                  return _context5.a(2, (0,_modules_wizard_wizard_provider_wizard_submission_js__WEBPACK_IMPORTED_MODULE_3__.initializeWizardSubmission)());
              }
            }, _callee5);
          })));
        case 4:
          _context9.n = 6;
          break;
        case 5:
          console.log('ℹ️ [Header] User logged in - skipping wizard initialization');
        case 6:
          _context9.n = 7;
          return safeInit('MobileMenu', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee6() {
            return _regenerator().w(function (_context6) {
              while (1) switch (_context6.n) {
                case 0:
                  return _context6.a(2, (0,_modules_ui_mobile_menu_js__WEBPACK_IMPORTED_MODULE_4__.initializeMobileMenu)());
              }
            }, _callee6);
          })));
        case 7:
          _context9.n = 8;
          return safeInit('CategoryPopups', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee7() {
            return _regenerator().w(function (_context7) {
              while (1) switch (_context7.n) {
                case 0:
                  return _context7.a(2, (0,_modules_ui_category_category_popups_js__WEBPACK_IMPORTED_MODULE_5__.initializeCategoryPopups)());
              }
            }, _callee7);
          })));
        case 8:
          _context9.n = 9;
          return safeInit('ScrollUtils', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee8() {
            return _regenerator().w(function (_context8) {
              while (1) switch (_context8.n) {
                case 0:
                  return _context8.a(2, (0,_modules_ui_scroll_utils_js__WEBPACK_IMPORTED_MODULE_6__.initializeScrollUtils)());
              }
            }, _callee8);
          })));
        case 9:
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          // 4. WIZARD GLOBAL WRAPPERS (conditional)
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          if (popupExists) {
            exposeWizardWrappers(steps);
            setupWizardEventListeners();
          } else {
            console.log('ℹ️ [Header] Skipping wizard wrappers (user logged in)');
          }

          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          // INITIALIZATION COMPLETE
          // ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
          console.log('✅ [Header] All modules initialized');
          console.log('🔍 [Header] Global objects:', {
            providerWizard: !!window.providerWizard,
            providerWizardSteps: !!window.providerWizardSteps,
            providerLanguageManager: !!window.providerLanguageManager,
            ulixaiGoogleTranslate: !!window.ulixaiGoogleTranslate,
            onProviderSignupSubmit: !!window.onProviderSignupSubmit
          });
          console.log('📋 [Header] Initialization Summary:', {
            popupInDOM: popupExists,
            wizardInitialized: !!wizard,
            stepsInitialized: !!steps,
            mobileMenuInitialized: true,
            googleTranslateInitialized: !!window.ulixaiGoogleTranslate
          });
        case 10:
          return _context9.a(2);
      }
    }, _callee9);
  }));
  return _initializeAll.apply(this, arguments);
}
function exposeWizardWrappers(steps) {
  try {
    // Global showStep function
    if (!window.showStep) {
      window.showStep = function (i) {
        if (window.providerWizardSteps && typeof window.providerWizardSteps.showStep === 'function') {
          window.providerWizardSteps.showStep(i);
        } else if (steps && typeof steps.showStep === 'function') {
          steps.showStep(i);
        } else {
          console.warn('⚠️ [Header] showStep called but no implementation available');
        }
      };
    }

    // Global updateNavigationButtons function
    if (!window.updateNavigationButtons) {
      window.updateNavigationButtons = function () {
        if (window.providerWizardSteps && typeof window.providerWizardSteps.updateNavigationButtons === 'function') {
          window.providerWizardSteps.updateNavigationButtons();
        } else if (steps && typeof steps.updateNavigationButtons === 'function') {
          steps.updateNavigationButtons();
        } else {
          console.warn('⚠️ [Header] updateNavigationButtons called but no implementation available');
        }
      };
    }
    console.log('✅ [Header] Wizard global wrappers exposed');
  } catch (e) {
    console.warn('⚠️ [Header] Failed to expose wizard wrappers:', e);
  }
}

/**
 * Setup event listeners for wizard functionality
 * Handles form changes and custom wizard events
 * 
 * ✅ CORRECTION: Guard anti-boucle infinie ajouté
 */
function setupWizardEventListeners() {
  // ═══════════════════════════════════════════════════════════
  // 🛡️ PROTECTION CONTRE LA BOUCLE INFINIE
  // ═══════════════════════════════════════════════════════════
  var isUpdating = false;
  var updateTimeout = null;

  // Update navigation buttons on any form change
  document.addEventListener('change', function (e) {
    // ✅ GUARD #1: Si on est déjà en train de mettre à jour, ignorer
    if (isUpdating) {
      console.log('⚠️ [Header] Already updating navigation - skipping');
      return;
    }

    // ✅ GUARD #2: Ignorer les événements sur les éléments disabled
    if (e.target && e.target.disabled) {
      return;
    }
    if (typeof window.updateNavigationButtons === 'function') {
      // ✅ DEBOUNCE: Éviter les appels répétés
      if (updateTimeout) {
        clearTimeout(updateTimeout);
      }
      updateTimeout = setTimeout(function () {
        isUpdating = true;
        try {
          console.log('🔄 [Header] Updating navigation buttons (debounced)');
          window.updateNavigationButtons();
        } catch (e) {
          console.error('❌ [Header] Error updating navigation:', e);
        } finally {
          // ✅ Toujours réinitialiser le flag, même en cas d'erreur
          setTimeout(function () {
            isUpdating = false;
            updateTimeout = null;
          }, 100);
        }
      }, 150); // 150ms de délai
    }
  }, {
    passive: true
  });

  // Handle Step 2 specific change events
  document.addEventListener('pw:step2:changed', function () {
    try {
      if (typeof window.updateNavigationButtons === 'function' && !isUpdating) {
        isUpdating = true;
        window.updateNavigationButtons();
        setTimeout(function () {
          isUpdating = false;
        }, 100);
      }
    } catch (e) {
      console.warn('⚠️ [Header] Step2 event handler failed:', e);
      isUpdating = false;
    }
  });
  console.log('✅ [Header] Wizard event listeners setup (with anti-loop protection)');
}

// ═══════════════════════════════════════════════════════════
// BOOTSTRAP - Initialize when DOM is ready
// ═══════════════════════════════════════════════════════════

if (document.readyState === 'loading') {
  console.log('⏳ [Header] DOM is loading, waiting for DOMContentLoaded...');
  document.addEventListener('DOMContentLoaded', initializeAll, {
    once: true
  });
} else {
  console.log('✅ [Header] DOM already loaded, initializing now');
  initializeAll();
}
})();

/******/ })()
;