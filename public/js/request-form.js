/******/ (() => { // webpackBootstrap
/*!*************************************************************************!*\
  !*** ./resources/js/modules/wizard/wizard_request_help/request-form.js ***!
  \*************************************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
(function (_window$formConfig, _window$formConfig2, _window$formConfig3, _window$formConfig4, _window$formConfig5) {
  'use strict';

  // ═══════════════════════════════════════════════════════════
  // 🎯 CONFIGURATION
  // ═══════════════════════════════════════════════════════════
  var CONFIG = {
    DEBOUNCE_DELAY: 300,
    SUBMIT_COOLDOWN: 5000,
    MIN_FORM_TIME: 10,
    IMAGE_MAX_SIZE: 5 * 1024 * 1024,
    IMAGE_MAX_WIDTH: 1200,
    IMAGE_QUALITY: 0.8,
    VALID_IMAGE_TYPES: ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']
  };

  // ═══════════════════════════════════════════════════════════
  // 🔒 VARIABLES GLOBALES
  // ═══════════════════════════════════════════════════════════
  var userScenario = 'new';
  var userFirstName = '';
  var isPasswordVerificationMode = false;
  var formSubmitting = false;
  var lastSubmitTime = 0;
  var currentStep = 0;
  var totalSteps = 15;
  var DOM = {
    steps: null,
    nextBtn: null,
    prevBtn: null,
    progressBar: null,
    stepLabel: null,
    stepCounter: null,
    funText: null,
    stickyNav: null,
    requestTitle: null,
    titleCount: null,
    titleCounter: null,
    moreDetails: null,
    detailsCount: null,
    detailsCounter: null,
    password: null,
    strengthBar: null,
    strengthLabel: null,
    cachedSelectors: {
      supportType: null,
      urgency: null,
      languages: null,
      lastUpdate: 0
    }
  };
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // localStorage cache
  var localStorageCache = null;
  var cacheTimestamp = 0;
  var CACHE_DURATION = 500;

  // ═══════════════════════════════════════════════════════════
  // ♿ ACCESSIBILITÉ
  // ═══════════════════════════════════════════════════════════
  function announce(message) {
    var priority = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'polite';
    var announcer = document.getElementById('a11y-announcer');
    if (!announcer) {
      announcer = document.createElement('div');
      announcer.id = 'a11y-announcer';
      announcer.className = 'sr-only';
      announcer.setAttribute('aria-live', priority);
      announcer.setAttribute('aria-atomic', 'true');
      document.body.appendChild(announcer);
    }
    announcer.textContent = '';
    setTimeout(function () {
      announcer.textContent = message;
    }, 100);
    setTimeout(function () {
      announcer.textContent = '';
    }, 3000);
  }

  // ═══════════════════════════════════════════════════════════
  // ⚡ PERFORMANCE
  // ═══════════════════════════════════════════════════════════
  function debounce(func, wait) {
    var timeout;
    return function executedFunction() {
      var _this = this;
      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }
      var later = function later() {
        clearTimeout(timeout);
        func.apply(_this, args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }
  function throttle(func, limit) {
    var inThrottle;
    return function () {
      if (!inThrottle) {
        for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
          args[_key2] = arguments[_key2];
        }
        func.apply(this, args);
        inThrottle = true;
        setTimeout(function () {
          return inThrottle = false;
        }, limit);
      }
    };
  }
  function getCachedSelector(name, selector) {
    var maxAge = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1000;
    var now = Date.now();
    if (DOM.cachedSelectors[name] && now - DOM.cachedSelectors.lastUpdate < maxAge) {
      return DOM.cachedSelectors[name];
    }
    DOM.cachedSelectors[name] = document.querySelector(selector);
    DOM.cachedSelectors.lastUpdate = now;
    return DOM.cachedSelectors[name];
  }

  // ═══════════════════════════════════════════════════════════
  // 🛡️ SÉCURITÉ
  // ═══════════════════════════════════════════════════════════
  function sanitizeHTML(str) {
    if (typeof str !== 'string') return '';
    var temp = document.createElement('div');
    temp.textContent = str;
    return temp.innerHTML;
  }
  function isValidEmail(email) {
    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return emailRegex.test(email) && email.length <= 254;
  }
  function validateImageFile(file) {
    if (!file) throw new Error('No file provided');
    if (!CONFIG.VALID_IMAGE_TYPES.includes(file.type)) {
      throw new Error('Invalid file type. Only images (JPG, PNG, GIF, WebP) are allowed.');
    }
    if (file.size > CONFIG.IMAGE_MAX_SIZE) {
      throw new Error('File size must be less than 5MB');
    }
    return true;
  }

  // ═══════════════════════════════════════════════════════════
  // 🖼️ COMPRESSION D'IMAGES
  // ═══════════════════════════════════════════════════════════
  function compressImage(file) {
    var maxWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : CONFIG.IMAGE_MAX_WIDTH;
    var quality = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : CONFIG.IMAGE_QUALITY;
    return new Promise(function (resolve, reject) {
      try {
        validateImageFile(file);
        var reader = new FileReader();
        reader.onerror = function () {
          return reject(new Error('Failed to read file'));
        };
        reader.onload = function (e) {
          var img = new Image();
          img.onerror = function () {
            return reject(new Error('Failed to load image'));
          };
          img.onload = function () {
            var canvas = document.createElement('canvas');
            var width = img.width,
              height = img.height;
            if (width > maxWidth) {
              height = Math.round(height * maxWidth / width);
              width = maxWidth;
            }
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext('2d', {
              alpha: false
            });
            if (!ctx) {
              reject(new Error('Failed to get canvas context'));
              return;
            }
            ctx.imageSmoothingEnabled = true;
            ctx.imageSmoothingQuality = 'high';
            ctx.drawImage(img, 0, 0, width, height);
            canvas.toBlob(function (blob) {
              if (!blob) {
                reject(new Error('Failed to compress image'));
                return;
              }
              var compressedFile = new File([blob], file.name.replace(/\.\w+$/, '.jpg'), {
                type: 'image/jpeg',
                lastModified: Date.now()
              });
              console.log('📸 Compression:', Math.round(file.size / 1024) + 'KB →', Math.round(compressedFile.size / 1024) + 'KB');
              resolve(compressedFile);
            }, 'image/jpeg', quality);
          };
          img.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } catch (error) {
        reject(error);
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 📦 CONFIGURATION GLOBALE (depuis Blade)
  // ═══════════════════════════════════════════════════════════
  var funTexts = ((_window$formConfig = window.formConfig) === null || _window$formConfig === void 0 ? void 0 : _window$formConfig.funTexts) || [];
  var stepLabels = ((_window$formConfig2 = window.formConfig) === null || _window$formConfig2 === void 0 ? void 0 : _window$formConfig2.stepLabels) || [];
  var isAuthenticated = ((_window$formConfig3 = window.formConfig) === null || _window$formConfig3 === void 0 ? void 0 : _window$formConfig3.isAuthenticated) || false;
  var checkEmailUrl = ((_window$formConfig4 = window.formConfig) === null || _window$formConfig4 === void 0 ? void 0 : _window$formConfig4.checkEmailUrl) || '';
  var verifyPasswordUrl = ((_window$formConfig5 = window.formConfig) === null || _window$formConfig5 === void 0 ? void 0 : _window$formConfig5.verifyPasswordUrl) || '';

  // ═══════════════════════════════════════════════════════════
  // 🎯 INITIALISATION DOM
  // ═══════════════════════════════════════════════════════════
  function initDOMElements() {
    console.log('🔍 [DOM] Searching for elements...');
    DOM.steps = document.querySelectorAll('.form-step');
    DOM.nextBtn = document.getElementById('nextBtn');
    DOM.prevBtn = document.getElementById('prevBtn');
    DOM.progressBar = document.getElementById('progressBar');
    DOM.stepLabel = document.getElementById('formStepLabel');
    DOM.stepCounter = document.getElementById('stepCounter');
    DOM.funText = document.getElementById('funText');
    DOM.stickyNav = document.getElementById('stickyNav');
    DOM.requestTitle = document.getElementById('requestTitle');
    DOM.titleCount = document.getElementById('titleCount');
    DOM.titleCounter = document.getElementById('titleCounter');
    DOM.moreDetails = document.getElementById('moreDetails');
    DOM.detailsCount = document.getElementById('detailsCount');
    DOM.detailsCounter = document.getElementById('detailsCounter');
    DOM.password = document.getElementById('password');
    DOM.strengthBar = document.getElementById('strengthBar');
    DOM.strengthLabel = document.getElementById('strengthLabel');
    if (!DOM.steps || DOM.steps.length === 0) {
      console.error('❌ [DOM] Form steps not found!');
      return false;
    }
    console.log('✅ [DOM] Found', DOM.steps.length, 'steps');
    return true;
  }

  // ═══════════════════════════════════════════════════════════
  // 🔤 COMPTEURS DE CARACTÈRES
  // ═══════════════════════════════════════════════════════════
  function setupCharacterCounters() {
    if (DOM.requestTitle && DOM.titleCount) {
      var updateTitleCounter = debounce(function () {
        var length = this.value.length;
        DOM.titleCount.textContent = length + '/15';
        if (length >= 15) {
          DOM.titleCounter.className = 'mt-3 text-sm text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
          DOM.titleCounter.innerHTML = '✅ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
        } else {
          DOM.titleCounter.className = 'mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
          DOM.titleCounter.innerHTML = '⚠️ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
        }
        updateNextButton();
      }, CONFIG.DEBOUNCE_DELAY);
      DOM.requestTitle.addEventListener('input', updateTitleCounter);
    }
    if (DOM.moreDetails && DOM.detailsCount) {
      var updateDetailsCounter = debounce(function () {
        var length = this.value.length;
        DOM.detailsCount.textContent = length;
        if (length >= 50) {
          DOM.detailsCounter.className = 'mt-3 text-sm flex justify-between text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
          DOM.detailsCounter.innerHTML = '<span>✅ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
        } else {
          DOM.detailsCounter.className = 'mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
          DOM.detailsCounter.innerHTML = '<span>⚠️ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
        }
        updateNextButton();
      }, CONFIG.DEBOUNCE_DELAY);
      DOM.moreDetails.addEventListener('input', updateDetailsCounter);
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 🔐 MOT DE PASSE
  // ═══════════════════════════════════════════════════════════
  function setupPasswordStrength() {
    if (!DOM.password || !DOM.strengthBar) return;
    var updatePasswordStrength = debounce(function () {
      if (isPasswordVerificationMode) {
        updateNextButton();
        return;
      }
      var length = this.value.length;
      var strength = 0,
        text = 'Too short',
        color = 'bg-gray-300';
      if (length < 6) {
        strength = 0;
        text = 'Too short';
        color = 'bg-gray-300';
      } else if (length < 8) {
        strength = 33;
        text = 'Weak';
        color = 'bg-red-500';
      } else if (length < 10) {
        strength = 66;
        text = 'Medium';
        color = 'bg-yellow-500';
      } else {
        strength = 100;
        text = 'Strong';
        color = 'bg-green-500';
      }
      if (!prefersReducedMotion) DOM.strengthBar.style.transition = 'width 0.3s ease, background-color 0.3s ease';
      DOM.strengthBar.style.width = strength + '%';
      DOM.strengthBar.setAttribute('aria-valuenow', strength);
      DOM.strengthBar.className = 'h-full transition-all duration-300 ' + color;
      DOM.strengthLabel.textContent = text;
      updateNextButton();
    }, 100);
    DOM.password.addEventListener('input', updatePasswordStrength);
  }

  // ═══════════════════════════════════════════════════════════
  // ⏱️ BOUTONS DE DURÉE
  // ═══════════════════════════════════════════════════════════
  function setupDurationButtons() {
    var durationButtons = document.querySelectorAll('.option-btn');
    var durationInput = document.getElementById('durationHere');
    if (!durationInput) return;
    durationButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        durationButtons.forEach(function (btn) {
          btn.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
          btn.setAttribute('aria-pressed', 'false');
          if (btn.classList.contains('sm:col-span-2')) btn.classList.add('sm:col-span-2');
        });
        this.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
        this.setAttribute('aria-pressed', 'true');
        if (this.classList.contains('sm:col-span-2')) this.classList.add('sm:col-span-2');
        var value = this.getAttribute('data-value');
        durationInput.value = sanitizeHTML(value);
        if (['1-2 years', '2-5 years', 'More than 5 years'].includes(value)) {
          var popup = document.getElementById('expatPopup');
          if (popup) {
            popup.classList.remove('hidden');
            popup.style.zIndex = '9999';
            announce('You might be interested in becoming an expat helper', 'polite');
            if (!prefersReducedMotion) setTimeout(function () {
              return popup.classList.add('hidden');
            }, 5000);
          }
        }
        updateNextButton();
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 📞 TYPE DE SUPPORT
  // ═══════════════════════════════════════════════════════════
  function setupSupportOptions() {
    var supportOptions = document.querySelectorAll('.support-option');
    supportOptions.forEach(function (option) {
      var radio = option.querySelector('input[type="radio"]');
      if (!radio) return;
      radio.addEventListener('change', function () {
        supportOptions.forEach(function (opt) {
          opt.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100';
        });
        if (this.checked) {
          option.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
          var label = option.querySelector('span');
          if (label) announce('Selected: ' + label.textContent, 'polite');
        }
        DOM.cachedSelectors.supportType = null;
        updateNextButton();
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⚡ URGENCE
  // ═══════════════════════════════════════════════════════════
  function setupUrgencyOptions() {
    var urgencyOptions = document.querySelectorAll('.urgency-option');
    urgencyOptions.forEach(function (option) {
      var radio = option.querySelector('input[type="radio"]');
      if (!radio) return;
      radio.addEventListener('change', function () {
        urgencyOptions.forEach(function (opt) {
          opt.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100';
        });
        if (this.checked) {
          option.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
          var label = option.querySelector('span');
          if (label) announce('Selected: ' + label.textContent, 'polite');
        }
        DOM.cachedSelectors.urgency = null;
        updateNextButton();
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🌍 LANGUES
  // ═══════════════════════════════════════════════════════════
  function setupLanguageOptions() {
    var langOptions = document.querySelectorAll('.lang-option');
    langOptions.forEach(function (option) {
      var checkbox = option.querySelector('.lang-checkbox');
      if (!checkbox) return;
      option.addEventListener('click', function (e) {
        e.preventDefault();
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
          this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
        } else {
          this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95';
        }
        DOM.cachedSelectors.languages = null;
        updateNextButton();
      });
      checkbox.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 📅 DURÉE DU SERVICE
  // ═══════════════════════════════════════════════════════════
  function setupServiceDurationButtons() {
    var serviceDurationBtns = document.querySelectorAll('.duration-btn');
    var serviceDurationInput = document.getElementById('serviceDuration');
    if (!serviceDurationInput) return;
    serviceDurationBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        serviceDurationBtns.forEach(function (b) {
          b.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
          b.setAttribute('aria-pressed', 'false');
        });
        this.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
        this.setAttribute('aria-pressed', 'true');
        var duration = this.getAttribute('data-duration');
        serviceDurationInput.value = sanitizeHTML(duration);
        announce('Selected: ' + duration, 'polite');
        updateNextButton();
      });
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ✅ CONDITIONS GÉNÉRALES
  // ═══════════════════════════════════════════════════════════
  function setupTermsCheckbox() {
    var termsCheckbox = document.getElementById('termsCheckbox');
    if (termsCheckbox) {
      termsCheckbox.addEventListener('change', function () {
        if (this.checked) announce('Terms and conditions accepted', 'polite');
        updateNextButton();
      });
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 📧 VÉRIFICATION EMAIL
  // ═══════════════════════════════════════════════════════════
  function checkEmailExists(email) {
    if (!checkEmailUrl) {
      console.error('❌ checkEmailUrl not configured');
      return Promise.resolve({
        exists: false,
        has_valid_cookie: false
      });
    }
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
      console.error('❌ CSRF token not found');
      return Promise.resolve({
        exists: false,
        has_valid_cookie: false
      });
    }
    return fetch(checkEmailUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({
        email: sanitizeHTML(email)
      })
    }).then(function (response) {
      if (!response.ok) throw new Error('Network error: ' + response.status);
      return response.json();
    }).then(function (data) {
      console.log('📧 Email check result:', data);
      return data;
    })["catch"](function (err) {
      console.error('❌ Error checking email:', err);
      return {
        exists: false,
        has_valid_cookie: false
      };
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 🔑 VÉRIFICATION MOT DE PASSE
  // ═══════════════════════════════════════════════════════════
  function verifyPassword(email, password) {
    if (!verifyPasswordUrl) {
      console.error('❌ verifyPasswordUrl not configured');
      return Promise.resolve({
        success: false,
        message: 'Configuration error'
      });
    }
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
      console.error('❌ CSRF token not found');
      return Promise.resolve({
        success: false,
        message: 'Security error'
      });
    }
    return fetch(verifyPasswordUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({
        email: sanitizeHTML(email),
        password: password
      })
    }).then(function (response) {
      if (!response.ok) throw new Error('Network error: ' + response.status);
      return response.json();
    }).then(function (data) {
      console.log('🔐 Password verification result:', data);
      return data;
    })["catch"](function (err) {
      console.error('❌ Error verifying password:', err);
      return {
        success: false,
        message: 'Verification failed. Please try again.'
      };
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 👋 MESSAGES DE BIENVENUE
  // ═══════════════════════════════════════════════════════════
  function showWelcomeMessage(scenario, firstName) {
    var welcomeMsg = document.getElementById('welcomeMessage');
    var welcomeTitle = document.getElementById('welcomeTitle');
    var welcomeText = document.getElementById('welcomeText');
    if (!welcomeMsg || !welcomeTitle || !welcomeText) return;
    var safeName = sanitizeHTML(firstName);
    switch (scenario) {
      case 'new':
        welcomeTitle.textContent = '👋 Welcome!';
        welcomeText.textContent = "Let's create your account 🎉";
        announce('Welcome! Creating your account', 'polite');
        break;
      case 'returning-with-cookie':
      case 'returning-without-cookie':
        welcomeTitle.textContent = "Hey ".concat(safeName, "! \uD83D\uDC4B");
        welcomeText.textContent = 'Happy to see you back! ✨';
        announce("Welcome back ".concat(safeName, "!"), 'polite');
        break;
    }
    welcomeMsg.classList.remove('hidden');
    if (!prefersReducedMotion) welcomeMsg.style.animation = 'slideInDown 0.5s ease-out';
  }
  function setupPasswordLoginMode(firstName) {
    isPasswordVerificationMode = true;
    var passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
    var passwordWelcomeTitle = document.getElementById('passwordWelcomeTitle');
    var passwordWelcomeText = document.getElementById('passwordWelcomeText');
    var passwordLabel = document.getElementById('passwordLabel');
    var passwordInput = document.getElementById('password');
    var passwordStrength = document.getElementById('passwordStrength');
    var passwordInfoText = document.getElementById('passwordInfoText');
    var safeName = sanitizeHTML(firstName);
    if (passwordWelcomeMsg && passwordWelcomeTitle && passwordWelcomeText) {
      passwordWelcomeTitle.textContent = "Hey ".concat(safeName, "! \uD83D\uDC4B");
      passwordWelcomeText.textContent = 'Happy to see you back!';
      passwordWelcomeMsg.classList.remove('hidden');
    }
    if (passwordInput) {
      passwordInput.placeholder = 'Enter your password';
      passwordInput.value = '';
    }
    if (passwordLabel) passwordLabel.textContent = 'Password';
    if (passwordStrength) passwordStrength.style.display = 'none';
    if (passwordInfoText) passwordInfoText.innerHTML = '🔐 For security, please enter your <strong>password</strong>';
    announce('Please enter your password to continue', 'polite');
  }
  function setupPasswordCreationMode() {
    isPasswordVerificationMode = false;
    var passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
    var passwordLabel = document.getElementById('passwordLabel');
    var passwordInput = document.getElementById('password');
    var passwordStrength = document.getElementById('passwordStrength');
    var passwordInfoText = document.getElementById('passwordInfoText');
    if (passwordWelcomeMsg) passwordWelcomeMsg.classList.add('hidden');
    if (passwordInput) {
      passwordInput.placeholder = 'Choose a secure password (min 6 chars)';
      passwordInput.value = '';
    }
    if (passwordLabel) passwordLabel.textContent = 'Choose a password (minimum 6 characters)';
    if (passwordStrength) passwordStrength.style.display = 'block';
    if (passwordInfoText) passwordInfoText.innerHTML = '🔐 Use at least <strong>6 characters</strong> — 8+ recommended';
    announce('Create a secure password for your account', 'polite');
  }

  // ═══════════════════════════════════════════════════════════
  // 📄 AFFICHAGE DES ÉTAPES (PARTIE 2 DANS LE PROCHAIN MESSAGE)
  // ═══════════════════════════════════════════════════════════
  // ═══════════════════════════════════════════════════════════
  // 📄 AFFICHAGE DES ÉTAPES
  // ═══════════════════════════════════════════════════════════
  function showStep(index) {
    if (index < 0 || index >= totalSteps) {
      console.error('❌ Invalid step index:', index);
      return;
    }
    if (isAuthenticated && index >= 9 && index <= 11) {
      currentStep = 12;
      index = 12;
    }
    DOM.steps.forEach(function (step, i) {
      if (i === index) {
        step.classList.remove('hidden');
        step.setAttribute('aria-hidden', 'false');
      } else {
        step.classList.add('hidden');
        step.setAttribute('aria-hidden', 'true');
      }
    });
    if (index === 14) {
      setTimeout(function () {
        var adLink = document.getElementById('see-my-ad');
        var missionId = localStorage.getItem('current-mission-id');
        if (missionId && adLink) {
          adLink.href = '/quote-offer?id=' + encodeURIComponent(missionId);
          console.log('✅ Ad link updated:', adLink.href);
        }
      }, 100);
    }
    var progress = (index + 1) / totalSteps * 100;
    if (DOM.progressBar) {
      if (prefersReducedMotion) {
        DOM.progressBar.style.width = progress + '%';
      } else {
        var _animateProgress = function animateProgress() {
          frame++;
          var easeProgress = frame / totalFrames;
          var easeWidth = currentWidth + (targetWidth - currentWidth) * easeProgress;
          DOM.progressBar.style.width = easeWidth + '%';
          DOM.progressBar.setAttribute('aria-valuenow', Math.round(easeWidth));
          if (frame < totalFrames) requestAnimationFrame(_animateProgress);
        };
        var currentWidth = parseFloat(DOM.progressBar.style.width) || 0;
        var targetWidth = progress;
        var frame = 0;
        var totalFrames = 20;
        requestAnimationFrame(_animateProgress);
      }
    }
    if (DOM.stepLabel && stepLabels[index]) {
      DOM.stepLabel.textContent = stepLabels[index];
    }
    if (DOM.stepCounter) {
      if (index < 12) {
        DOM.stepCounter.textContent = 'Step ' + (index + 1);
      } else if (index === 12) {
        DOM.stepCounter.textContent = 'Step 12';
      } else {
        DOM.stepCounter.textContent = '';
      }
    }
    if (DOM.funText && funTexts[index]) {
      DOM.funText.textContent = funTexts[index].text;
      if (!prefersReducedMotion) DOM.funText.style.transition = 'color 0.3s ease';
      DOM.funText.style.color = funTexts[index].color;
    }
    if (DOM.prevBtn) {
      DOM.prevBtn.style.visibility = index === 0 ? 'hidden' : 'visible';
    }
    if (DOM.stickyNav) {
      if (index === 13 || index === 14) {
        DOM.stickyNav.classList.add('hidden');
      } else {
        DOM.stickyNav.classList.remove('hidden');
      }
    }
    if (index === 13) {
      var delay = prefersReducedMotion ? 0 : 2000;
      setTimeout(function () {
        currentStep++;
        showStep(currentStep);
      }, delay);
    }
    var currentStepEl = DOM.steps[index];
    if (currentStepEl && index !== 13 && index !== 14) {
      var firstFocusable = currentStepEl.querySelector('input:not([type="hidden"]):not(.lang-checkbox):not([disabled]), select:not([disabled]), textarea:not([disabled]), button[type="button"]:not(.photo-menu-btn):not([disabled])');
      if (firstFocusable) setTimeout(function () {
        firstFocusable.focus();
      }, 100);
    }
    if (stepLabels[index]) {
      var stepNumber = index < 12 ? "Step ".concat(index + 1, " of ").concat(totalSteps) : 'Final step';
      announce("".concat(stepNumber, ": ").concat(stepLabels[index]), 'polite');
    }
    updateNextButton();
  }

  // ═══════════════════════════════════════════════════════════
  // ✅ VALIDATION DES ÉTAPES
  // ═══════════════════════════════════════════════════════════
  function validateStep(stepIndex) {
    if ([13, 14].includes(stepIndex)) return true;
    var valid = true;
    var message = '';
    switch (stepIndex) {
      case 0:
        {
          var countryNeed = document.getElementById('countryNeed');
          if (!countryNeed || !countryNeed.value) {
            message = 'Please select a country';
            valid = false;
            if (countryNeed) countryNeed.focus();
          }
          break;
        }
      case 1:
        {
          var originCountry = document.getElementById('originCountry');
          if (!originCountry || !originCountry.value) {
            message = 'Please select your country of origin';
            valid = false;
            if (originCountry) originCountry.focus();
          }
          break;
        }
      case 2:
        {
          valid = true;
          break;
        }
      case 3:
        {
          var durationHere = document.getElementById('durationHere');
          if (!durationHere || !durationHere.value) {
            message = 'Please select how long you have been here';
            valid = false;
          }
          break;
        }
      case 4:
        {
          var title = document.getElementById('requestTitle');
          var details = document.getElementById('moreDetails');
          if (!title || !title.value || title.value.trim().length < 15) {
            message = 'Title must be at least 15 characters';
            valid = false;
            if (title) title.focus();
          } else if (!details || !details.value || details.value.trim().length < 50) {
            message = 'Details must be at least 50 characters';
            valid = false;
            if (details) details.focus();
          }
          break;
        }
      case 5:
        {
          valid = true;
          break;
        }
      case 6:
        {
          var supportType = getCachedSelector('supportType', 'input[name="supportType"]:checked');
          if (!supportType) {
            message = 'Please select a support type';
            valid = false;
          }
          break;
        }
      case 7:
        {
          var urgency = getCachedSelector('urgency', 'input[name="urgency"]:checked');
          if (!urgency) {
            message = 'Please select urgency level';
            valid = false;
          }
          break;
        }
      case 8:
        {
          var languages = document.querySelectorAll('input[name="languages[]"]:checked');
          if (languages.length === 0) {
            message = 'Please select at least one language';
            valid = false;
          }
          break;
        }
      case 9:
        {
          var firstName = document.getElementById('firstName');
          if (!firstName || !firstName.value.trim()) {
            message = 'Please enter your first name';
            valid = false;
            if (firstName) firstName.focus();
          }
          break;
        }
      case 10:
        {
          var emailInput = document.getElementById('email');
          var email = emailInput ? emailInput.value.trim() : '';
          if (!email || !isValidEmail(email)) {
            message = 'Please enter a valid email address';
            valid = false;
            if (emailInput) emailInput.focus();
            showValidationError(message);
            return false;
          }
          if (DOM.nextBtn) {
            DOM.nextBtn.disabled = true;
            DOM.nextBtn.textContent = 'Checking...';
          }
          checkEmailExists(email).then(function (data) {
            if (data.exists && data.has_valid_cookie) {
              userScenario = 'returning-with-cookie';
              userFirstName = data.first_name || 'there';
              showWelcomeMessage('returning-with-cookie', userFirstName);
              setTimeout(function () {
                currentStep = 11;
                storeStepData(10);
                currentStep++;
                showStep(currentStep);
              }, 1500);
            } else if (data.exists && !data.has_valid_cookie) {
              userScenario = 'returning-without-cookie';
              userFirstName = data.first_name || 'there';
              showWelcomeMessage('returning-without-cookie', userFirstName);
              setTimeout(function () {
                storeStepData(10);
                currentStep++;
                setupPasswordLoginMode(userFirstName);
                showStep(currentStep);
              }, 1500);
            } else {
              userScenario = 'new';
              showWelcomeMessage('new', '');
              setTimeout(function () {
                storeStepData(10);
                currentStep++;
                setupPasswordCreationMode();
                showStep(currentStep);
              }, 1000);
            }
            if (DOM.nextBtn) {
              DOM.nextBtn.disabled = false;
              DOM.nextBtn.textContent = 'Next →';
            }
          })["catch"](function (err) {
            console.error('Email check error:', err);
            if (DOM.nextBtn) {
              DOM.nextBtn.disabled = false;
              DOM.nextBtn.textContent = 'Next →';
            }
          });
          return false;
        }
      case 11:
        {
          var pwd = document.getElementById('password');
          if (!pwd || !pwd.value || pwd.value.length < 6) {
            message = 'Password must be at least 6 characters';
            valid = false;
            if (pwd) pwd.focus();
            showValidationError(message);
            return false;
          }
          if (isPasswordVerificationMode) {
            var emailForVerif = document.getElementById('email');
            if (!emailForVerif) return false;
            if (DOM.nextBtn) {
              DOM.nextBtn.disabled = true;
              DOM.nextBtn.textContent = 'Verifying...';
            }
            verifyPassword(emailForVerif.value, pwd.value).then(function (data) {
              if (data.success) {
                console.log('✅ Password correct');
                storeStepData(11);
                currentStep++;
                showStep(currentStep);
              } else {
                showValidationError(data.message || 'Wrong password, please try again');
                pwd.value = '';
                pwd.focus();
              }
              if (DOM.nextBtn) {
                DOM.nextBtn.disabled = false;
                DOM.nextBtn.textContent = 'Next →';
              }
            })["catch"](function (err) {
              console.error('Password verification error:', err);
              if (DOM.nextBtn) {
                DOM.nextBtn.disabled = false;
                DOM.nextBtn.textContent = 'Next →';
              }
            });
            return false;
          }
          break;
        }
      case 12:
        {
          var duration = document.getElementById('serviceDuration');
          var terms = document.getElementById('termsCheckbox');
          if (!duration || !duration.value) {
            message = 'Please select service duration';
            valid = false;
          } else if (!terms || !terms.checked) {
            showCGVWarning();
            valid = false;
            if (terms) terms.focus();
          }
          break;
        }
    }
    if (!valid && message) showValidationError(message);
    return valid;
  }

  // ═══════════════════════════════════════════════════════════
  // ⚠️ AFFICHAGE DES ERREURS
  // ═══════════════════════════════════════════════════════════
  function showValidationError(message) {
    var errorDiv = document.getElementById('validationError');
    var messageEl = document.getElementById('validationMessage');
    if (errorDiv && messageEl) {
      messageEl.textContent = sanitizeHTML(message);
      errorDiv.classList.remove('hidden');
      errorDiv.style.zIndex = '10000';
      announce('Error: ' + message, 'assertive');
      var hideDelay = prefersReducedMotion ? 2000 : 3000;
      setTimeout(function () {
        errorDiv.classList.add('hidden');
      }, hideDelay);
    }
  }
  function showCGVWarning() {
    var warningDiv = document.getElementById('cgvWarning');
    if (warningDiv) {
      warningDiv.classList.remove('hidden');
      warningDiv.style.zIndex = '10000';
      announce("Don't forget to accept the terms and conditions", 'assertive');
      var hideDelay = prefersReducedMotion ? 2000 : 3000;
      setTimeout(function () {
        warningDiv.classList.add('hidden');
      }, hideDelay);
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 🔘 MISE À JOUR DU BOUTON NEXT
  // ═══════════════════════════════════════════════════════════
  var updateNextButton = throttle(function () {
    if (!DOM.nextBtn) return;
    var canProceed = false;
    switch (currentStep) {
      case 0:
        {
          var c0 = document.getElementById('countryNeed');
          canProceed = !!(c0 && c0.value);
          break;
        }
      case 1:
        {
          var c1 = document.getElementById('originCountry');
          canProceed = !!(c1 && c1.value);
          break;
        }
      case 2:
        {
          canProceed = true;
          break;
        }
      case 3:
        {
          var c3 = document.getElementById('durationHere');
          canProceed = !!(c3 && c3.value);
          break;
        }
      case 4:
        {
          var title = document.getElementById('requestTitle');
          var details = document.getElementById('moreDetails');
          canProceed = !!(title && details && title.value.trim().length >= 15 && details.value.trim().length >= 50);
          break;
        }
      case 5:
        {
          canProceed = true;
          break;
        }
      case 6:
        {
          var supportType = getCachedSelector('supportType', 'input[name="supportType"]:checked', 500);
          canProceed = !!supportType;
          break;
        }
      case 7:
        {
          var urgency = getCachedSelector('urgency', 'input[name="urgency"]:checked', 500);
          canProceed = !!urgency;
          break;
        }
      case 8:
        {
          var languages = document.querySelectorAll('input[name="languages[]"]:checked');
          canProceed = languages.length > 0;
          break;
        }
      case 9:
        {
          var c9 = document.getElementById('firstName');
          canProceed = !!(c9 && c9.value.trim());
          break;
        }
      case 10:
        {
          var emailEl = document.getElementById('email');
          var email = emailEl ? emailEl.value.trim() : '';
          canProceed = isValidEmail(email);
          break;
        }
      case 11:
        {
          var pwdEl = document.getElementById('password');
          canProceed = !!(pwdEl && pwdEl.value.length >= 6);
          break;
        }
      case 12:
        {
          var durEl = document.getElementById('serviceDuration');
          var termEl = document.getElementById('termsCheckbox');
          canProceed = !!(durEl && durEl.value && termEl && termEl.checked);
          break;
        }
      default:
        {
          canProceed = true;
        }
    }
    DOM.nextBtn.disabled = !canProceed;
    DOM.nextBtn.setAttribute('aria-disabled', !canProceed);
  }, 100);

  // ═══════════════════════════════════════════════════════════
  // 💾 STOCKAGE DES DONNÉES
  // ═══════════════════════════════════════════════════════════
  function getLocalStorageData() {
    var now = Date.now();
    if (localStorageCache && now - cacheTimestamp < CACHE_DURATION) {
      return _objectSpread({}, localStorageCache);
    }
    try {
      localStorageCache = JSON.parse(localStorage.getItem('help-request')) || {};
      cacheTimestamp = now;
      return _objectSpread({}, localStorageCache);
    } catch (e) {
      console.error('Error reading localStorage:', e);
      return {};
    }
  }
  function setLocalStorageData(data) {
    try {
      localStorage.setItem('help-request', JSON.stringify(data));
      localStorageCache = _objectSpread({}, data);
      cacheTimestamp = Date.now();
    } catch (e) {
      console.error('Error writing localStorage:', e);
      if (e.name === 'QuotaExceededError') {
        showValidationError('Storage quota exceeded. Please clear some data.');
      }
    }
  }
  function storeStepData(stepIndex) {
    var expats = getLocalStorageData();
    switch (stepIndex) {
      case 0:
        {
          var c0 = document.getElementById('countryNeed');
          expats.countryNeed = c0 ? sanitizeHTML(c0.value) : '';
          break;
        }
      case 1:
        {
          var c1 = document.getElementById('originCountry');
          expats.originCountry = c1 ? sanitizeHTML(c1.value) : '';
          break;
        }
      case 2:
        {
          var c2 = document.getElementById('currentCity');
          expats.currentCity = c2 ? sanitizeHTML(c2.value) : '';
          break;
        }
      case 3:
        {
          var c3 = document.getElementById('durationHere');
          expats.durationHere = c3 ? sanitizeHTML(c3.value) : '';
          break;
        }
      case 4:
        {
          var title = document.getElementById('requestTitle');
          var details = document.getElementById('moreDetails');
          expats.requestTitle = title ? sanitizeHTML(title.value) : '';
          expats.moreDetails = details ? sanitizeHTML(details.value) : '';
          break;
        }
      case 6:
        {
          var supportType = document.querySelector('input[name="supportType"]:checked');
          expats.supportType = supportType ? supportType.value : null;
          break;
        }
      case 7:
        {
          var urgency = document.querySelector('input[name="urgency"]:checked');
          expats.urgency = urgency ? urgency.value : null;
          break;
        }
      case 8:
        {
          var languages = Array.from(document.querySelectorAll('input[name="languages[]"]:checked')).map(function (cb) {
            return sanitizeHTML(cb.value);
          });
          expats.languages = languages;
          break;
        }
      case 9:
        {
          var fname = document.getElementById('firstName');
          expats.firstName = fname ? sanitizeHTML(fname.value) : '';
          break;
        }
      case 10:
        {
          var email = document.getElementById('email');
          expats.email = email ? sanitizeHTML(email.value) : '';
          break;
        }
      case 11:
        {
          break;
        }
      case 12:
        {
          var dur = document.getElementById('serviceDuration');
          expats.serviceDuration = dur ? sanitizeHTML(dur.value) : '';

          // ✅ GDPR: Sauvegarder le consentement CGV
          var terms = document.getElementById('termsCheckbox');
          if (terms) {
            expats.termsAccepted = terms.checked;
            if (terms.checked) {
              expats.termsAcceptedAt = new Date().toISOString();
              console.log('✅ [GDPR] Terms accepted at:', expats.termsAcceptedAt);
            }
          }
          break;
        }
    }
    setLocalStorageData(expats);
  }

  // ═══════════════════════════════════════════════════════════
  // 🔄 RESTAURATION DES DONNÉES
  // ═══════════════════════════════════════════════════════════
  function restoreStepData() {
    var expats = getLocalStorageData();
    var fields = {
      'countryNeed': expats.countryNeed,
      'originCountry': expats.originCountry,
      'currentCity': expats.currentCity,
      'durationHere': expats.durationHere,
      'requestTitle': expats.requestTitle,
      'moreDetails': expats.moreDetails,
      'firstName': expats.firstName,
      'email': expats.email,
      'serviceDuration': expats.serviceDuration
    };
    for (var _i = 0, _Object$entries = Object.entries(fields); _i < _Object$entries.length; _i++) {
      var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
        id = _Object$entries$_i[0],
        value = _Object$entries$_i[1];
      if (value) {
        var el = document.getElementById(id);
        if (el) {
          el.value = value;
          if (['requestTitle', 'moreDetails'].includes(id)) {
            el.dispatchEvent(new Event('input', {
              bubbles: true
            }));
          }
        }
      }
    }

    // ✅ GDPR: Restaurer la checkbox CGV
    if (expats.termsAccepted !== undefined) {
      var terms = document.getElementById('termsCheckbox');
      if (terms) {
        terms.checked = expats.termsAccepted;
        console.log('🔄 [GDPR] Terms checkbox restored:', expats.termsAccepted);
        if (expats.termsAcceptedAt) {
          console.log('📅 [GDPR] Originally accepted at:', expats.termsAcceptedAt);
        }
      }
    }
    if (expats.languages && Array.isArray(expats.languages)) {
      expats.languages.forEach(function (lang) {
        try {
          var checkbox = document.querySelector("input[name=\"languages[]\"][value=\"".concat(CSS.escape(lang), "\"]"));
          if (checkbox) {
            checkbox.checked = true;
            var option = checkbox.closest('.lang-option');
            if (option) {
              option.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
            }
          }
        } catch (e) {
          console.error('Error restoring language:', lang, e);
        }
      });
    }
    try {
      var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
      for (var photoName in photoData) {
        var _input$closest;
        var input = document.querySelector("input[name=\"".concat(CSS.escape(photoName), "\"]"));
        var preview = input === null || input === void 0 || (_input$closest = input.closest('.photo-upload-box')) === null || _input$closest === void 0 ? void 0 : _input$closest.querySelector('.photo-preview');
        if (preview && photoData[photoName].base64) {
          preview.src = photoData[photoName].base64;
          var photoBox = input.closest('.photo-upload-box');
          if (photoBox) {
            photoBox.classList.add('has-photo');
            var label = photoBox.querySelector('.photo-label');
            if (label) label.classList.add('hidden');
          }
        }
      }
    } catch (e) {
      console.error('Error restoring photos:', e);
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 🎧 ÉCOUTE GLOBALE DES ÉVÉNEMENTS
  // ═══════════════════════════════════════════════════════════
  function setupGlobalListeners() {
    var debouncedStoreAndUpdate = debounce(function (e) {
      storeStepData(currentStep);
      updateNextButton();
    }, CONFIG.DEBOUNCE_DELAY);
    document.querySelectorAll('input:not([type="hidden"]):not(.lang-checkbox):not([type="radio"]):not([type="checkbox"]), select, textarea').forEach(function (el) {
      el.addEventListener('input', debouncedStoreAndUpdate);
    });
    document.querySelectorAll('input[type="radio"], input[type="checkbox"]:not(.lang-checkbox)').forEach(function (el) {
      el.addEventListener('change', function () {
        storeStepData(currentStep);
        updateNextButton();
      });
    });

    // ✅ GDPR: Listener spécifique pour la checkbox CGV
    var termsCheckbox = document.getElementById('termsCheckbox');
    if (termsCheckbox) {
      termsCheckbox.addEventListener('change', function () {
        var isChecked = this.checked;
        console.log('✅ [GDPR] Terms checkbox changed:', isChecked);
        if (isChecked) {
          console.log('📅 [GDPR] User accepted terms at:', new Date().toISOString());
        }
        storeStepData(currentStep);
        updateNextButton();
      });
    }
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey && DOM.nextBtn && !DOM.nextBtn.disabled) {
        var activeEl = document.activeElement;
        if (activeEl && activeEl.tagName !== 'TEXTAREA') {
          e.preventDefault();
          DOM.nextBtn.click();
        }
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // ⬅️➡️ NAVIGATION
  // ═══════════════════════════════════════════════════════════
  function setupNavigation() {
    if (!DOM.nextBtn || !DOM.prevBtn) {
      console.error('❌ Navigation buttons not found');
      return;
    }
    DOM.nextBtn.addEventListener('click', function () {
      if (this.disabled || formSubmitting) return;
      if (currentStep < totalSteps - 1) {
        if (currentStep === 10 || currentStep === 11 && isPasswordVerificationMode) {
          validateStep(currentStep);
          return;
        }
        if (!validateStep(currentStep)) return;
        storeStepData(currentStep);
        if (isAuthenticated && currentStep === 8) currentStep = 11;
        if (currentStep === 12) {
          handleFormSubmission();
          return;
        }
        currentStep++;
        showStep(currentStep);
      }
    });
    DOM.prevBtn.addEventListener('click', function () {
      if (currentStep > 0) {
        storeStepData(currentStep);
        if (isAuthenticated && currentStep === 12) {
          currentStep = 8;
        } else {
          currentStep--;
        }
        showStep(currentStep);
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 📤 SOUMISSION DU FORMULAIRE
  // ═══════════════════════════════════════════════════════════
  function handleFormSubmission() {
    var now = Date.now();
    if (now - lastSubmitTime < CONFIG.SUBMIT_COOLDOWN) {
      showValidationError('Please wait a few seconds before submitting again');
      return;
    }
    var honeypot = document.getElementById('website');
    if (honeypot && honeypot.value !== '') {
      console.warn('🍯 Honeypot triggered - possible bot');
      currentStep++;
      showStep(currentStep);
      return;
    }
    var timestampField = document.getElementById('timestamp');
    if (timestampField) {
      var timestamp = parseInt(timestampField.value);
      var elapsed = Math.floor(Date.now() / 1000) - timestamp;
      if (elapsed < CONFIG.MIN_FORM_TIME) {
        showValidationError('Please take your time to fill the form properly');
        return;
      }
    }
    formSubmitting = true;
    lastSubmitTime = now;
    var form = document.getElementById('helpRequestForm');
    if (!form) {
      console.error('❌ Form not found');
      formSubmitting = false;
      return;
    }
    var formData = new FormData(form);
    var expats = getLocalStorageData();
    Object.entries(expats).forEach(function (_ref) {
      var _ref2 = _slicedToArray(_ref, 2),
        key = _ref2[0],
        val = _ref2[1];
      if (!formData.has(key) && key !== 'password') {
        if (Array.isArray(val)) {
          val.forEach(function (v) {
            return formData.append(key + '[]', v);
          });
        } else if (val) {
          formData.append(key, val);
        }
      }
    });
    try {
      var categories = JSON.parse(localStorage.getItem('create-request')) || {};
      if (categories) {
        formData.append('category', categories.category || '');
        formData.append('subcategory', categories.sub_category || '');
        formData.append('subcategory2', categories.child_category || '');
      }
    } catch (e) {
      console.error('Error adding categories:', e);
    }

    // ✅ GDPR: Ajouter la version des CGV et timestamp
    formData.append('terms_version', '1.0'); // À incrémenter si tu changes tes CGV
    formData.append('terms_accepted_at', expats.termsAcceptedAt || new Date().toISOString());
    console.log('📋 [GDPR] Submitting with terms version 1.0');
    if (DOM.nextBtn) {
      DOM.nextBtn.disabled = true;
      DOM.nextBtn.setAttribute('aria-busy', 'true');
      DOM.nextBtn.textContent = 'Submitting...';
    }
    announce('Submitting your request, please wait', 'polite');
    console.log('📤 Submitting form...');
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
      console.error('❌ CSRF token not found');
      showValidationError('Security error. Please refresh the page.');
      formSubmitting = false;
      if (DOM.nextBtn) {
        DOM.nextBtn.disabled = false;
        DOM.nextBtn.setAttribute('aria-busy', 'false');
        DOM.nextBtn.textContent = 'Next →';
      }
      return;
    }
    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken.getAttribute('content')
      },
      body: formData
    }).then(function (res) {
      console.log('📡 Response status:', res.status);
      if (!res.ok) throw new Error('Server error: ' + res.status);
      return res.json();
    }).then(function (data) {
      console.log('✅ Server response:', data);
      localStorage.removeItem('help-request');
      localStorage.removeItem('create-request');
      localStorage.removeItem('photo-previews');
      if (data.mission_id) {
        localStorage.setItem('current-mission-id', data.mission_id);
        console.log('💾 Mission ID saved:', data.mission_id);
      }
      announce('Your request has been submitted successfully!', 'polite');
      formSubmitting = false;
      currentStep++;
      showStep(currentStep);
    })["catch"](function (error) {
      console.error('❌ Submission error:', error);
      showValidationError('Submission failed. Please check your connection and try again.');
      announce('Submission failed. Please try again.', 'assertive');
      formSubmitting = false;
    })["finally"](function () {
      if (DOM.nextBtn) {
        DOM.nextBtn.disabled = false;
        DOM.nextBtn.setAttribute('aria-busy', 'false');
        DOM.nextBtn.textContent = 'Next →';
      }
    });
  }

  // ═══════════════════════════════════════════════════════════
  // 📸 GESTION DES PHOTOS
  // ═══════════════════════════════════════════════════════════
  function setupPhotoHandling() {
    var photoBoxes = document.querySelectorAll('.photo-upload-box');
    var photoMenuModal = document.getElementById('photoMenuModal');
    var photoMenuOptions = document.querySelectorAll('.photo-menu-option');
    var closePhotoMenuModal = document.getElementById('closePhotoMenuModal');
    var activePhotoInput = null;
    var activePhotoPreview = null;
    var cameraModal = document.getElementById('cameraModal');
    var cameraVideo = document.getElementById('cameraVideo');
    var capturePhotoBtn = document.getElementById('capturePhotoBtn');
    var closeCameraModal = document.getElementById('closeCameraModal');
    var cameraStream = null;
    var currentZoomLevel = 1;
    var currentPhotoBox = null;
    var photoZoomModal = document.getElementById('photoZoomModal');
    var zoomedImage = document.getElementById('zoomedImage');
    var closeZoomModal = document.getElementById('closeZoomModal');
    var zoomInBtn = document.getElementById('zoomIn');
    var zoomOutBtn = document.getElementById('zoomOut');
    var resetZoomBtn = document.getElementById('resetZoom');
    var deletePhotoBtn = document.getElementById('deletePhoto');
    photoBoxes.forEach(function (box) {
      var menuBtn = box.querySelector('.photo-menu-btn');
      var input = box.querySelector('.photo-input');
      var preview = box.querySelector('.photo-preview');
      if (menuBtn && input && preview) {
        menuBtn.addEventListener('click', function (e) {
          e.preventDefault();
          if (box.classList.contains('has-photo')) {
            openPhotoZoom(preview.src, box);
            return;
          }
          activePhotoInput = input;
          activePhotoPreview = preview;
          if (photoMenuModal) {
            photoMenuModal.classList.remove('hidden');
            photoMenuModal.style.zIndex = '9999';
          }
        });
        input.addEventListener('change', /*#__PURE__*/function () {
          var _ref3 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(e) {
            var file, compressedFile, dataTransfer, photoUrl, label, reader, _t;
            return _regenerator().w(function (_context) {
              while (1) switch (_context.p = _context.n) {
                case 0:
                  file = e.target.files[0];
                  if (file) {
                    _context.n = 1;
                    break;
                  }
                  return _context.a(2);
                case 1:
                  _context.p = 1;
                  validateImageFile(file);
                  _context.n = 2;
                  return compressImage(file, 1200, 0.8);
                case 2:
                  compressedFile = _context.v;
                  dataTransfer = new DataTransfer();
                  dataTransfer.items.add(compressedFile);
                  input.files = dataTransfer.files;
                  photoUrl = URL.createObjectURL(compressedFile);
                  preview.src = photoUrl;
                  box.classList.add('has-photo');
                  label = box.querySelector('.photo-label');
                  if (label) label.classList.add('hidden');
                  reader = new FileReader();
                  reader.onload = function (readerEvent) {
                    try {
                      var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                      photoData[input.name] = {
                        base64: readerEvent.target.result,
                        timestamp: Date.now()
                      };
                      localStorage.setItem('photo-previews', JSON.stringify(photoData));
                      console.log('💾 Photo saved:', input.name);
                    } catch (err) {
                      console.error('Error saving photo:', err);
                    }
                  };
                  reader.readAsDataURL(compressedFile);
                  _context.n = 4;
                  break;
                case 3:
                  _context.p = 3;
                  _t = _context.v;
                  showValidationError(_t.message);
                  input.value = '';
                case 4:
                  return _context.a(2);
              }
            }, _callee, null, [[1, 3]]);
          }));
          return function (_x) {
            return _ref3.apply(this, arguments);
          };
        }());
      }
    });
    photoMenuOptions.forEach(function (option) {
      option.addEventListener('click', function () {
        var action = option.getAttribute('data-action');
        if (photoMenuModal) photoMenuModal.classList.add('hidden');
        if (!activePhotoInput) return;
        if (action === 'library' || action === 'file') {
          activePhotoInput.click();
        } else if (action === 'camera') {
          if (cameraModal) {
            cameraModal.classList.remove('hidden');
            cameraModal.style.zIndex = '9999';
          }
          if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
              video: {
                facingMode: 'environment',
                width: {
                  ideal: 1280
                },
                height: {
                  ideal: 720
                }
              }
            }).then(function (stream) {
              cameraStream = stream;
              if (cameraVideo) {
                cameraVideo.srcObject = stream;
                cameraVideo.play();
              }
            })["catch"](function (err) {
              console.error('Camera access denied:', err);
              showValidationError('Camera access denied');
              if (cameraModal) cameraModal.classList.add('hidden');
            });
          }
        }
      });
    });
    if (closePhotoMenuModal) {
      closePhotoMenuModal.onclick = function () {
        if (photoMenuModal) photoMenuModal.classList.add('hidden');
      };
    }
    if (photoMenuModal) {
      photoMenuModal.addEventListener('click', function (e) {
        if (e.target === this) this.classList.add('hidden');
      });
    }
    function closeCameraAndStream() {
      if (cameraModal) cameraModal.classList.add('hidden');
      if (cameraStream) {
        cameraStream.getTracks().forEach(function (track) {
          return track.stop();
        });
        cameraStream = null;
      }
      if (cameraVideo && cameraVideo.srcObject) {
        cameraVideo.srcObject.getTracks().forEach(function (track) {
          return track.stop();
        });
        cameraVideo.srcObject = null;
      }
    }
    if (closeCameraModal) closeCameraModal.onclick = closeCameraAndStream;
    if (cameraModal) {
      cameraModal.addEventListener('click', function (e) {
        if (e.target === this) closeCameraAndStream();
      });
    }
    if (capturePhotoBtn && cameraVideo) {
      capturePhotoBtn.onclick = /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3() {
        var canvas, ctx;
        return _regenerator().w(function (_context3) {
          while (1) switch (_context3.n) {
            case 0:
              if (cameraVideo.srcObject) {
                _context3.n = 1;
                break;
              }
              return _context3.a(2);
            case 1:
              canvas = document.createElement('canvas');
              canvas.width = cameraVideo.videoWidth;
              canvas.height = cameraVideo.videoHeight;
              ctx = canvas.getContext('2d');
              ctx.drawImage(cameraVideo, 0, 0, canvas.width, canvas.height);
              canvas.toBlob(/*#__PURE__*/function () {
                var _ref5 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2(blob) {
                  var file, dataTransfer, photoUrl, photoBox, label, reader, _t2;
                  return _regenerator().w(function (_context2) {
                    while (1) switch (_context2.p = _context2.n) {
                      case 0:
                        _context2.p = 0;
                        file = new File([blob], 'camera-photo-' + Date.now() + '.png', {
                          type: 'image/png',
                          lastModified: Date.now()
                        });
                        _context2.n = 1;
                        return compressImage(file, 1200, 0.8);
                      case 1:
                        file = _context2.v;
                        dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        if (activePhotoInput) {
                          activePhotoInput.files = dataTransfer.files;
                          console.log('📸 Photo captured:', file.size, 'bytes');
                          photoUrl = URL.createObjectURL(file);
                          if (activePhotoPreview) {
                            activePhotoPreview.src = photoUrl;
                            photoBox = activePhotoInput.closest('.photo-upload-box');
                            if (photoBox) {
                              photoBox.classList.add('has-photo');
                              label = photoBox.querySelector('.photo-label');
                              if (label) label.classList.add('hidden');
                            }
                          }
                          reader = new FileReader();
                          reader.onload = function (e) {
                            try {
                              var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                              photoData[activePhotoInput.name] = {
                                base64: e.target.result,
                                timestamp: Date.now()
                              };
                              localStorage.setItem('photo-previews', JSON.stringify(photoData));
                              console.log('💾 Camera photo saved');
                            } catch (err) {
                              console.error('Error saving camera photo:', err);
                            }
                          };
                          reader.readAsDataURL(file);
                        }
                        closeCameraAndStream();
                        _context2.n = 3;
                        break;
                      case 2:
                        _context2.p = 2;
                        _t2 = _context2.v;
                        console.error('Error processing camera photo:', _t2);
                        showValidationError('Failed to process photo');
                      case 3:
                        return _context2.a(2);
                    }
                  }, _callee2, null, [[0, 2]]);
                }));
                return function (_x2) {
                  return _ref5.apply(this, arguments);
                };
              }(), 'image/png', 0.95);
            case 2:
              return _context3.a(2);
          }
        }, _callee3);
      }));
    }
    function openPhotoZoom(imageUrl, photoBox) {
      currentPhotoBox = photoBox;
      if (zoomedImage) zoomedImage.src = imageUrl;
      currentZoomLevel = 1;
      if (zoomedImage) zoomedImage.style.transform = 'scale(1)';
      if (photoZoomModal) {
        photoZoomModal.classList.remove('hidden');
        photoZoomModal.classList.add('flex');
      }
      document.body.style.overflow = 'hidden';
    }
    function closePhotoZoom() {
      if (photoZoomModal) {
        photoZoomModal.classList.add('hidden');
        photoZoomModal.classList.remove('flex');
      }
      currentPhotoBox = null;
      currentZoomLevel = 1;
      document.body.style.overflow = '';
    }
    if (closeZoomModal) closeZoomModal.addEventListener('click', closePhotoZoom);
    if (photoZoomModal) {
      photoZoomModal.addEventListener('click', function (e) {
        if (e.target === this) closePhotoZoom();
      });
    }
    if (zoomInBtn && zoomedImage) {
      zoomInBtn.addEventListener('click', function () {
        currentZoomLevel = Math.min(currentZoomLevel + 0.25, 3);
        zoomedImage.style.transform = "scale(".concat(currentZoomLevel, ")");
      });
    }
    if (zoomOutBtn && zoomedImage) {
      zoomOutBtn.addEventListener('click', function () {
        currentZoomLevel = Math.max(currentZoomLevel - 0.25, 0.5);
        zoomedImage.style.transform = "scale(".concat(currentZoomLevel, ")");
      });
    }
    if (resetZoomBtn && zoomedImage) {
      resetZoomBtn.addEventListener('click', function () {
        currentZoomLevel = 1;
        zoomedImage.style.transform = 'scale(1)';
      });
    }
    if (deletePhotoBtn) {
      deletePhotoBtn.addEventListener('click', function () {
        if (!currentPhotoBox) return;
        var input = currentPhotoBox.querySelector('.photo-input');
        var preview = currentPhotoBox.querySelector('.photo-preview');
        var label = currentPhotoBox.querySelector('.photo-label');
        if (input) input.value = '';
        if (preview) preview.src = preview.getAttribute('data-default-src') || '/images/uploadpng.png';
        currentPhotoBox.classList.remove('has-photo');
        if (label) label.classList.remove('hidden');
        if (input) {
          try {
            var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
            delete photoData[input.name];
            localStorage.setItem('photo-previews', JSON.stringify(photoData));
            console.log('🗑️ Photo deleted:', input.name);
          } catch (e) {
            console.error('Error deleting photo:', e);
          }
        }
        closePhotoZoom();
      });
    }
  }

  // ═══════════════════════════════════════════════════════════
  // 🚀 INITIALISATION PRINCIPALE
  // ═══════════════════════════════════════════════════════════
  function initializeForm() {
    console.log('🚀 [RequestForm] Starting initialization...');
    if (!initDOMElements()) {
      console.error('❌ [RequestForm] Failed to initialize DOM elements');
      return;
    }
    restoreStepData();
    setupCharacterCounters();
    setupPasswordStrength();
    setupDurationButtons();
    setupSupportOptions();
    setupUrgencyOptions();
    setupLanguageOptions();
    setupServiceDurationButtons();
    setupTermsCheckbox();
    setupNavigation();
    setupGlobalListeners();
    setupPhotoHandling();
    showStep(0);
    console.log('✅ [RequestForm] Initialization complete');
  }

  // ═══════════════════════════════════════════════════════════
  // 🎬 DÉMARRAGE QUAND LE DOM EST PRÊT
  // ═══════════════════════════════════════════════════════════
  if (document.readyState === 'loading') {
    console.log('⏳ [RequestForm] DOM is loading, waiting for DOMContentLoaded...');
    document.addEventListener('DOMContentLoaded', initializeForm, {
      once: true
    });
  } else {
    console.log('✅ [RequestForm] DOM already loaded, initializing immediately');
    initializeForm();
  }
})();
/******/ })()
;