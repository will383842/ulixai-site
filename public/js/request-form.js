/******/ (() => { // webpackBootstrap
/*!*************************************************************************!*\
  !*** ./resources/js/modules/wizard/wizard_request_help/request-form.js ***!
  \*************************************************************************/
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
(function () {
  'use strict';

  // ✅ VARIABLES GLOBALES POUR L'EMAIL CHECK
  var userScenario = 'new'; // 'new', 'returning-with-cookie', 'returning-without-cookie'
  var userFirstName = '';
  var isPasswordVerificationMode = false;

  // ✅ FONCTION DE COMPRESSION D'IMAGES
  function compressImage(file) {
    var maxWidth = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1200;
    var quality = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0.8;
    return new Promise(function (resolve) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var img = new Image();
        img.onload = function () {
          var canvas = document.createElement('canvas');
          var width = img.width;
          var height = img.height;
          if (width > maxWidth) {
            height = height * maxWidth / width;
            width = maxWidth;
          }
          canvas.width = width;
          canvas.height = height;
          var ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          canvas.toBlob(function (blob) {
            var compressedFile = new File([blob], file.name.replace(/\.\w+$/, '.jpg'), {
              type: 'image/jpeg',
              lastModified: Date.now()
            });
            console.log('📸 Compression:', file.size, '→', compressedFile.size, 'bytes');
            resolve(compressedFile);
          }, 'image/jpeg', quality);
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  // Récupérer les variables globales
  var funTexts = window.formConfig.funTexts;
  var stepLabels = window.formConfig.stepLabels;
  var isAuthenticated = window.formConfig.isAuthenticated;
  var checkEmailUrl = window.formConfig.checkEmailUrl;
  var verifyPasswordUrl = window.formConfig.verifyPasswordUrl;
  var steps = document.querySelectorAll('.form-step');
  var nextBtn = document.getElementById('nextBtn');
  var prevBtn = document.getElementById('prevBtn');
  var progressBar = document.getElementById('progressBar');
  var stepLabel = document.getElementById('formStepLabel');
  var stepCounter = document.getElementById('stepCounter');
  var funText = document.getElementById('funText');
  var stickyNav = document.getElementById('stickyNav');
  var currentStep = 0;
  var totalSteps = 15;
  var requestTitle = document.getElementById('requestTitle');
  var titleCount = document.getElementById('titleCount');
  var titleCounter = document.getElementById('titleCounter');
  var moreDetails = document.getElementById('moreDetails');
  var detailsCount = document.getElementById('detailsCount');
  var detailsCounter = document.getElementById('detailsCounter');
  if (requestTitle && titleCount) {
    requestTitle.addEventListener('input', function () {
      var length = this.value.length;
      titleCount.textContent = length + '/15';
      if (length >= 15) {
        titleCounter.className = 'mt-3 text-sm text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
        titleCounter.innerHTML = '✅ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
      } else {
        titleCounter.className = 'mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
        titleCounter.innerHTML = '⚠️ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
      }
      updateNextButton();
    });
  }
  if (moreDetails && detailsCount) {
    moreDetails.addEventListener('input', function () {
      var length = this.value.length;
      detailsCount.textContent = length;
      if (length >= 50) {
        detailsCounter.className = 'mt-3 text-sm flex justify-between text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
        detailsCounter.innerHTML = '<span>✅ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
      } else {
        detailsCounter.className = 'mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
        detailsCounter.innerHTML = '<span>⚠️ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
      }
      updateNextButton();
    });
  }
  var password = document.getElementById('password');
  var strengthBar = document.getElementById('strengthBar');
  var strengthLabel = document.getElementById('strengthLabel');
  if (password && strengthBar) {
    password.addEventListener('input', function () {
      // Ne pas afficher la barre de force en mode vérification
      if (isPasswordVerificationMode) {
        updateNextButton();
        return;
      }
      var length = this.value.length;
      var strength = 0;
      var text = 'Too short';
      var color = 'bg-gray-300';
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
      strengthBar.style.width = strength + '%';
      strengthBar.setAttribute('aria-valuenow', strength);
      strengthBar.className = 'h-full transition-all duration-300 ' + color;
      strengthLabel.textContent = text;
      updateNextButton();
    });
  }
  var durationButtons = document.querySelectorAll('.option-btn');
  var durationInput = document.getElementById('durationHere');
  durationButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      durationButtons.forEach(function (btn) {
        btn.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
        btn.setAttribute('aria-pressed', 'false');
        if (btn.classList.contains('sm:col-span-2')) {
          btn.classList.add('sm:col-span-2');
        }
      });
      this.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
      this.setAttribute('aria-pressed', 'true');
      if (this.classList.contains('sm:col-span-2')) {
        this.classList.add('sm:col-span-2');
      }
      durationInput.value = this.getAttribute('data-value');
      var value = this.getAttribute('data-value');
      if (['1-2 years', '2-5 years', 'More than 5 years'].includes(value)) {
        var popup = document.getElementById('expatPopup');
        popup.classList.remove('hidden');
        popup.style.zIndex = '9999';
        setTimeout(function () {
          return popup.classList.add('hidden');
        }, 5000);
      }
      updateNextButton();
    });
  });
  var supportOptions = document.querySelectorAll('.support-option');
  supportOptions.forEach(function (option) {
    var radio = option.querySelector('input[type="radio"]');
    radio.addEventListener('change', function () {
      supportOptions.forEach(function (opt) {
        opt.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100';
      });
      if (this.checked) {
        option.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
      }
      updateNextButton();
    });
  });
  var urgencyOptions = document.querySelectorAll('.urgency-option');
  urgencyOptions.forEach(function (option) {
    var radio = option.querySelector('input[type="radio"]');
    radio.addEventListener('change', function () {
      urgencyOptions.forEach(function (opt) {
        opt.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100';
      });
      if (this.checked) {
        option.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
      }
      updateNextButton();
    });
  });
  var langOptions = document.querySelectorAll('.lang-option');
  langOptions.forEach(function (option) {
    var checkbox = option.querySelector('.lang-checkbox');
    option.addEventListener('click', function (e) {
      checkbox.checked = !checkbox.checked;
      if (checkbox.checked) {
        this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
      } else {
        this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95';
      }
      updateNextButton();
    });
    checkbox.addEventListener('click', function (e) {
      e.preventDefault();
    });
  });
  var serviceDurationBtns = document.querySelectorAll('.duration-btn');
  var serviceDurationInput = document.getElementById('serviceDuration');
  serviceDurationBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      serviceDurationBtns.forEach(function (b) {
        b.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
        b.setAttribute('aria-pressed', 'false');
      });
      this.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
      this.setAttribute('aria-pressed', 'true');
      serviceDurationInput.value = this.getAttribute('data-duration');
      updateNextButton();
    });
  });
  var termsCheckbox = document.getElementById('termsCheckbox');
  if (termsCheckbox) {
    termsCheckbox.addEventListener('change', updateNextButton);
  }

  // ✅ FONCTION POUR VÉRIFIER L'EMAIL
  function checkEmailExists(email) {
    return fetch(checkEmailUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        email: email
      })
    }).then(function (response) {
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

  // ✅ FONCTION POUR AFFICHER LE MESSAGE DE BIENVENUE AU STEP 11
  function showWelcomeMessage(scenario, firstName) {
    var welcomeMsg = document.getElementById('welcomeMessage');
    var welcomeTitle = document.getElementById('welcomeTitle');
    var welcomeText = document.getElementById('welcomeText');
    if (!welcomeMsg) return;
    if (scenario === 'new') {
      welcomeTitle.textContent = '👋 Welcome!';
      welcomeText.textContent = "Let's create your account 🎉";
      welcomeMsg.classList.remove('hidden');
    } else if (scenario === 'returning-with-cookie' || scenario === 'returning-without-cookie') {
      welcomeTitle.textContent = "Hey ".concat(firstName, "! \uD83D\uDC4B");
      welcomeText.textContent = 'Happy to see you back! ✨';
      welcomeMsg.classList.remove('hidden');
    }
  }

  // ✅ FONCTION POUR CONFIGURER LE STEP 12 EN MODE LOGIN
  function setupPasswordLoginMode(firstName) {
    isPasswordVerificationMode = true;
    var passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
    var passwordWelcomeTitle = document.getElementById('passwordWelcomeTitle');
    var passwordWelcomeText = document.getElementById('passwordWelcomeText');
    var passwordLabel = document.getElementById('passwordLabel');
    var passwordInput = document.getElementById('password');
    var passwordStrength = document.getElementById('passwordStrength');
    var passwordInfoText = document.getElementById('passwordInfoText');

    // Afficher message personnalisé
    if (passwordWelcomeMsg) {
      passwordWelcomeTitle.textContent = "Hey ".concat(firstName, "! \uD83D\uDC4B");
      passwordWelcomeText.textContent = 'Happy to see you back!';
      passwordWelcomeMsg.classList.remove('hidden');
    }

    // Changer le placeholder et label
    if (passwordInput) {
      passwordInput.placeholder = 'Enter your password';
      passwordInput.value = '';
    }
    if (passwordLabel) {
      passwordLabel.textContent = 'Password';
    }

    // Masquer la barre de force
    if (passwordStrength) {
      passwordStrength.style.display = 'none';
    }

    // Changer le message info
    if (passwordInfoText) {
      passwordInfoText.innerHTML = '🔐 For security, please enter your <strong>password</strong>';
    }
  }

  // ✅ FONCTION POUR CONFIGURER LE STEP 12 EN MODE CRÉATION
  function setupPasswordCreationMode() {
    isPasswordVerificationMode = false;
    var passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
    var passwordLabel = document.getElementById('passwordLabel');
    var passwordInput = document.getElementById('password');
    var passwordStrength = document.getElementById('passwordStrength');
    var passwordInfoText = document.getElementById('passwordInfoText');

    // Masquer message personnalisé
    if (passwordWelcomeMsg) {
      passwordWelcomeMsg.classList.add('hidden');
    }

    // Restaurer placeholder et label
    if (passwordInput) {
      passwordInput.placeholder = 'Choose a secure password (min 6 chars)';
      passwordInput.value = '';
    }
    if (passwordLabel) {
      passwordLabel.textContent = 'Choose a password (minimum 6 characters)';
    }

    // Afficher la barre de force
    if (passwordStrength) {
      passwordStrength.style.display = 'block';
    }

    // Restaurer le message info
    if (passwordInfoText) {
      passwordInfoText.innerHTML = '🔐 Use at least <strong>6 characters</strong> — 8+ recommended';
    }
  }

  // ✅ FONCTION POUR VÉRIFIER LE MOT DE PASSE
  function verifyPassword(email, password) {
    return fetch(verifyPasswordUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        email: email,
        password: password
      })
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      console.log('🔐 Password verification result:', data);
      return data;
    })["catch"](function (err) {
      console.error('❌ Error verifying password:', err);
      return {
        success: false,
        message: 'Verification failed'
      };
    });
  }
  function showStep(index) {
    if (isAuthenticated && index >= 9 && index <= 11) {
      currentStep = 12;
      index = 12;
    }
    steps.forEach(function (step, i) {
      return step.classList.toggle('hidden', i !== index);
    });
    if (index === 14) {
      setTimeout(function () {
        var adLink = document.getElementById('see-my-ad');
        var missionId = localStorage.getItem('current-mission-id');
        if (missionId && adLink) {
          adLink.href = '/quote-offer?id=' + missionId;
          console.log('✅ Lien "See My Ad" mis à jour:', adLink.href);
        } else {
          console.error('❌ Impossible de mettre à jour le lien:', {
            missionId: missionId,
            linkExists: !!adLink
          });
        }
      }, 100);
    }
    var progress = (index + 1) / totalSteps * 100;
    progressBar.style.width = progress + '%';
    progressBar.setAttribute('aria-valuenow', Math.round(progress));
    if (stepLabel && stepLabels[index]) {
      stepLabel.textContent = stepLabels[index];
    }
    if (stepCounter) {
      if (index < 12) {
        stepCounter.textContent = 'Step ' + (index + 1);
      } else if (index === 12) {
        stepCounter.textContent = 'Step 12';
      } else {
        stepCounter.textContent = '';
      }
    }
    if (funText && funTexts[index]) {
      funText.textContent = funTexts[index].text;
      funText.style.color = funTexts[index].color;
    }
    if (index === 0) {
      prevBtn.style.visibility = 'hidden';
    } else {
      prevBtn.style.visibility = 'visible';
    }
    if (index === 13 || index === 14) {
      stickyNav.classList.add('hidden');
    } else {
      stickyNav.classList.remove('hidden');
    }
    if (index === 13) {
      setTimeout(function () {
        currentStep++;
        showStep(currentStep);
      }, 2000);
    }
    var currentStepEl = steps[index];
    if (currentStepEl) {
      var firstInput = currentStepEl.querySelector('input:not([type="hidden"]):not(.lang-checkbox), select, textarea, button[type="button"]:not(.photo-menu-btn)');
      if (firstInput && index !== 13 && index !== 14) {
        setTimeout(function () {
          return firstInput.focus();
        }, 100);
      }
    }
    updateNextButton();
  }
  function validateStep(stepIndex) {
    if ([13, 14].includes(stepIndex)) return true;
    var step = steps[stepIndex];
    var valid = true;
    var message = '';
    switch (stepIndex) {
      case 0:
        var countryNeed = document.getElementById('countryNeed');
        if (!countryNeed.value) {
          message = 'Please select a country';
          valid = false;
          countryNeed.focus();
        }
        break;
      case 1:
        var originCountry = document.getElementById('originCountry');
        if (!originCountry.value) {
          message = 'Please select your country of origin';
          valid = false;
          originCountry.focus();
        }
        break;
      case 2:
        valid = true;
        break;
      case 3:
        var durationHere = document.getElementById('durationHere');
        if (!durationHere.value) {
          message = 'Please select how long you have been here';
          valid = false;
        }
        break;
      case 4:
        var title = document.getElementById('requestTitle');
        var details = document.getElementById('moreDetails');
        if (!title.value || title.value.length < 15) {
          message = 'Title must be at least 15 characters';
          valid = false;
          title.focus();
        } else if (!details.value || details.value.length < 50) {
          message = 'Details must be at least 50 characters';
          valid = false;
          details.focus();
        }
        break;
      case 5:
        valid = true;
        break;
      case 6:
        var supportType = document.querySelector('input[name="supportType"]:checked');
        if (!supportType) {
          message = 'Please select a support type';
          valid = false;
        }
        break;
      case 7:
        var urgency = document.querySelector('input[name="urgency"]:checked');
        if (!urgency) {
          message = 'Please select urgency level';
          valid = false;
        }
        break;
      case 8:
        var languages = document.querySelectorAll('input[name="languages[]"]:checked');
        if (languages.length === 0) {
          message = 'Please select at least one language';
          valid = false;
        }
        break;
      case 9:
        var firstName = document.getElementById('firstName');
        if (!firstName.value) {
          message = 'Please enter your first name';
          valid = false;
          firstName.focus();
        }
        break;
      case 10:
        // ✅ VALIDATION EMAIL + CHECK ASYNC
        var emailInput = document.getElementById('email');
        var email = emailInput.value;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailPattern.test(email)) {
          message = 'Please enter a valid email address';
          valid = false;
          emailInput.focus();
          showValidationError(message);
          return false;
        }

        // Check email de manière asynchrone
        nextBtn.disabled = true;
        nextBtn.textContent = 'Checking...';
        checkEmailExists(email).then(function (data) {
          if (data.exists && data.has_valid_cookie) {
            // Scénario 2: Email connu + cookies valides
            userScenario = 'returning-with-cookie';
            userFirstName = data.first_name || 'there';

            // Afficher message au step 10
            showWelcomeMessage('returning-with-cookie', userFirstName);

            // Skip step 11 (password) et aller direct au step 12
            setTimeout(function () {
              currentStep = 11; // On va incrémenter à 12 dans nextBtn.click()
              storeStepData(10);
              currentStep++;
              showStep(currentStep);
            }, 1500);
          } else if (data.exists && !data.has_valid_cookie) {
            // Scénario 3: Email connu + pas de cookies
            userScenario = 'returning-without-cookie';
            userFirstName = data.first_name || 'there';

            // Afficher message au step 10
            showWelcomeMessage('returning-without-cookie', userFirstName);

            // Aller au step 11 en mode login
            setTimeout(function () {
              storeStepData(10);
              currentStep++;
              setupPasswordLoginMode(userFirstName);
              showStep(currentStep);
            }, 1500);
          } else {
            // Scénario 1: Email inconnu (nouveau user)
            userScenario = 'new';

            // Afficher message welcome
            showWelcomeMessage('new', '');

            // Aller au step 11 en mode création
            setTimeout(function () {
              storeStepData(10);
              currentStep++;
              setupPasswordCreationMode();
              showStep(currentStep);
            }, 1000);
          }
          nextBtn.disabled = false;
          nextBtn.textContent = 'Next →';
        });
        return false;
      // Empêcher la progression immédiate

      case 11:
        // ✅ VALIDATION PASSWORD (création ou vérification)
        var pwd = document.getElementById('password');
        if (!pwd.value || pwd.value.length < 6) {
          message = 'Password must be at least 6 characters';
          valid = false;
          pwd.focus();
          showValidationError(message);
          return false;
        }

        // Si mode vérification, vérifier le mot de passe
        if (isPasswordVerificationMode) {
          var _email = document.getElementById('email').value;
          nextBtn.disabled = true;
          nextBtn.textContent = 'Verifying...';
          verifyPassword(_email, pwd.value).then(function (data) {
            if (data.success) {
              // Mot de passe correct
              console.log('✅ Password correct');
              storeStepData(11);
              currentStep++;
              showStep(currentStep);
            } else {
              // Mot de passe incorrect
              showValidationError(data.message || 'Wrong password, please try again');
              pwd.value = '';
              pwd.focus();
            }
            nextBtn.disabled = false;
            nextBtn.textContent = 'Next →';
          });
          return false; // Empêcher la progression immédiate
        }
        break;
      case 12:
        var duration = document.getElementById('serviceDuration');
        var terms = document.getElementById('termsCheckbox');
        if (!duration.value) {
          message = 'Please select service duration';
          valid = false;
        } else if (!terms.checked) {
          showCGVWarning();
          valid = false;
          terms.focus();
        }
        break;
    }
    if (!valid && message) {
      showValidationError(message);
    }
    return valid;
  }
  function showValidationError(message) {
    var errorDiv = document.getElementById('validationError');
    var messageEl = document.getElementById('validationMessage');
    messageEl.textContent = message;
    errorDiv.classList.remove('hidden');
    errorDiv.style.zIndex = '9999';
    setTimeout(function () {
      return errorDiv.classList.add('hidden');
    }, 3000);
  }
  function showCGVWarning() {
    var warningDiv = document.getElementById('cgvWarning');
    warningDiv.classList.remove('hidden');
    warningDiv.style.zIndex = '9999';
    setTimeout(function () {
      return warningDiv.classList.add('hidden');
    }, 3000);
  }

  // ═══════════════════════════════════════════════════════════
  // ✅ FONCTION updateNextButton() SIMPLIFIÉE
  // ═══════════════════════════════════════════════════════════
  // ✅ Le JavaScript ne gère QUE btn.disabled = true/false
  // ✅ Le CSS gère TOUTE l'apparence via #nextBtn:disabled et #nextBtn:not(:disabled)
  // ═══════════════════════════════════════════════════════════
  function updateNextButton() {
    var canProceed = false;
    switch (currentStep) {
      case 0:
        canProceed = !!document.getElementById('countryNeed').value;
        break;
      case 1:
        canProceed = !!document.getElementById('originCountry').value;
        break;
      case 2:
        canProceed = true;
        break;
      case 3:
        canProceed = !!document.getElementById('durationHere').value;
        break;
      case 4:
        var title = document.getElementById('requestTitle').value;
        var details = document.getElementById('moreDetails').value;
        canProceed = title.length >= 15 && details.length >= 50;
        break;
      case 5:
        canProceed = true;
        break;
      case 6:
        canProceed = !!document.querySelector('input[name="supportType"]:checked');
        break;
      case 7:
        canProceed = !!document.querySelector('input[name="urgency"]:checked');
        break;
      case 8:
        canProceed = document.querySelectorAll('input[name="languages[]"]:checked').length > 0;
        break;
      case 9:
        canProceed = !!document.getElementById('firstName').value;
        break;
      case 10:
        var email = document.getElementById('email').value;
        canProceed = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        break;
      case 11:
        canProceed = document.getElementById('password').value.length >= 6;
        break;
      case 12:
        canProceed = !!document.getElementById('serviceDuration').value && document.getElementById('termsCheckbox').checked;
        break;
      default:
        canProceed = true;
    }

    // ✅ UNIQUE LIGNE QUI TOUCHE AU BOUTON - Le CSS fait le reste
    nextBtn.disabled = !canProceed;
  }
  function storeStepData(stepIndex) {
    var expats = JSON.parse(localStorage.getItem('help-request')) || {};
    switch (stepIndex) {
      case 0:
        expats.countryNeed = document.getElementById('countryNeed').value;
        break;
      case 1:
        expats.originCountry = document.getElementById('originCountry').value;
        break;
      case 2:
        expats.currentCity = document.getElementById('currentCity').value;
        break;
      case 3:
        expats.durationHere = document.getElementById('durationHere').value;
        break;
      case 4:
        expats.requestTitle = document.getElementById('requestTitle').value;
        expats.moreDetails = document.getElementById('moreDetails').value;
        break;
      case 6:
        var supportType = document.querySelector('input[name="supportType"]:checked');
        expats.supportType = supportType ? supportType.value : null;
        break;
      case 7:
        var urgency = document.querySelector('input[name="urgency"]:checked');
        expats.urgency = urgency ? urgency.value : null;
        break;
      case 8:
        var languages = Array.from(document.querySelectorAll('input[name="languages[]"]:checked')).map(function (cb) {
          return cb.value;
        });
        expats.languages = languages;
        break;
      case 9:
        expats.firstName = document.getElementById('firstName').value;
        break;
      case 10:
        expats.email = document.getElementById('email').value;
        break;
      case 11:
        expats.password = document.getElementById('password').value;
        break;
      case 12:
        expats.serviceDuration = document.getElementById('serviceDuration').value;
        break;
    }
    localStorage.setItem('help-request', JSON.stringify(expats));
  }
  function restoreStepData() {
    var expats = JSON.parse(localStorage.getItem('help-request')) || {};
    if (expats.countryNeed) document.getElementById('countryNeed').value = expats.countryNeed;
    if (expats.originCountry) document.getElementById('originCountry').value = expats.originCountry;
    if (expats.currentCity) document.getElementById('currentCity').value = expats.currentCity;
    if (expats.durationHere) document.getElementById('durationHere').value = expats.durationHere;
    if (expats.requestTitle) {
      document.getElementById('requestTitle').value = expats.requestTitle;
      document.getElementById('requestTitle').dispatchEvent(new Event('input'));
    }
    if (expats.moreDetails) {
      document.getElementById('moreDetails').value = expats.moreDetails;
      document.getElementById('moreDetails').dispatchEvent(new Event('input'));
    }
    if (expats.firstName) document.getElementById('firstName').value = expats.firstName;
    if (expats.email) document.getElementById('email').value = expats.email;
    if (expats.password) {
      document.getElementById('password').value = expats.password;
      document.getElementById('password').dispatchEvent(new Event('input'));
    }
    if (expats.serviceDuration) document.getElementById('serviceDuration').value = expats.serviceDuration;
    if (expats.languages && Array.isArray(expats.languages)) {
      expats.languages.forEach(function (lang) {
        var checkbox = document.querySelector('input[name="languages[]"][value="' + lang + '"]');
        if (checkbox) {
          checkbox.checked = true;
          var option = checkbox.closest('.lang-option');
          if (option) {
            option.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
          }
        }
      });
    }
    var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
    for (var photoName in photoData) {
      var _input$closest;
      var input = document.querySelector("input[name=\"".concat(photoName, "\"]"));
      var preview = input === null || input === void 0 || (_input$closest = input.closest('.photo-upload-box')) === null || _input$closest === void 0 ? void 0 : _input$closest.querySelector('.photo-preview');
      if (preview && photoData[photoName].base64) {
        preview.src = photoData[photoName].base64;
        var photoBox = input.closest('.photo-upload-box');
        if (photoBox) {
          photoBox.classList.add('has-photo');
          var label = photoBox.querySelector('.photo-label');
          if (label) label.classList.add('hidden');
        }
        console.log('🔄 Photo preview restauré:', photoName);
      }
    }
  }
  restoreStepData();
  document.querySelectorAll('input:not([type="hidden"]):not(.lang-checkbox), select, textarea').forEach(function (el) {
    el.addEventListener('input', function () {
      storeStepData(currentStep);
      updateNextButton();
    });
    el.addEventListener('change', function () {
      storeStepData(currentStep);
      updateNextButton();
    });
  });
  nextBtn.addEventListener('click', function () {
    if (currentStep < totalSteps - 1) {
      // ✅ Pour les steps 10 et 11, validateStep gère déjà la progression async
      if (currentStep === 10 || currentStep === 11 && isPasswordVerificationMode) {
        validateStep(currentStep);
        return;
      }
      if (!validateStep(currentStep)) return;
      storeStepData(currentStep);
      if (isAuthenticated && currentStep === 8) {
        currentStep = 11;
      }
      if (currentStep === 12) {
        var form = document.getElementById('helpRequestForm');
        var formData = new FormData(form);
        var expats = JSON.parse(localStorage.getItem('help-request')) || {};
        Object.entries(expats).forEach(function (_ref) {
          var _ref2 = _slicedToArray(_ref, 2),
            key = _ref2[0],
            val = _ref2[1];
          if (!formData.has(key)) {
            if (Array.isArray(val)) {
              val.forEach(function (v) {
                return formData.append(key + '[]', v);
              });
            } else {
              formData.append(key, val);
            }
          }
        });
        var categories = JSON.parse(localStorage.getItem('create-request')) || {};
        if (categories) {
          formData.append('category', categories.category || '');
          formData.append('subcategory', categories.sub_category || '');
          formData.append('subcategory2', categories.child_category || '');
        }
        nextBtn.disabled = true;
        nextBtn.setAttribute('aria-busy', 'true');
        console.log('📤 Envoi du formulaire...');
        fetch(form.action, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        }).then(function (res) {
          console.log('📡 Statut réponse:', res.status);
          if (!res.ok) {
            throw new Error('Erreur serveur: ' + res.status);
          }
          return res.json();
        }).then(function (data) {
          console.log('✅ Données reçues du serveur:', data);
          console.log('🆔 Mission ID:', data.mission_id);
          localStorage.removeItem('help-request');
          localStorage.removeItem('create-request');
          localStorage.removeItem('photo-previews');
          if (data.mission_id) {
            localStorage.setItem('current-mission-id', data.mission_id);
            console.log('💾 Mission ID stocké dans localStorage');
          } else {
            console.warn('⚠️ Aucun mission_id reçu du serveur');
            console.warn('⚠️ Données complètes:', JSON.stringify(data));
          }
          currentStep++;
          showStep(currentStep);
        })["catch"](function (error) {
          console.error('❌ Erreur lors de la soumission:', error);
          console.error('❌ Détails:', error.message);
          showValidationError('Submission failed. Please try again.');
        })["finally"](function () {
          nextBtn.disabled = false;
          nextBtn.setAttribute('aria-busy', 'false');
        });
        return;
      }
      currentStep++;
      showStep(currentStep);
    }
  });
  prevBtn.addEventListener('click', function () {
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

  // ✅ GESTION DES PHOTOS - UPLOAD ET ZOOM
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
    menuBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (box.classList.contains('has-photo')) {
        openPhotoZoom(preview.src, box);
        return;
      }
      activePhotoInput = input;
      activePhotoPreview = preview;
      photoMenuModal.classList.remove('hidden');
      photoMenuModal.style.zIndex = '9999';
    });
    input.addEventListener('change', /*#__PURE__*/function () {
      var _ref3 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(e) {
        var file, compressedFile, dataTransfer, photoUrl, label, reader;
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              file = e.target.files[0];
              if (file) {
                _context.n = 1;
                break;
              }
              return _context.a(2);
            case 1:
              if (!(file.size > 5 * 1024 * 1024)) {
                _context.n = 2;
                break;
              }
              showValidationError('File size must be less than 5MB');
              return _context.a(2);
            case 2:
              if (file.type.startsWith('image/')) {
                _context.n = 3;
                break;
              }
              showValidationError('Only image files are allowed');
              return _context.a(2);
            case 3:
              _context.n = 4;
              return compressImage(file, 1200, 0.8);
            case 4:
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
                var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                var photoName = input.name;
                photoData[photoName] = {
                  base64: readerEvent.target.result,
                  timestamp: Date.now()
                };
                localStorage.setItem('photo-previews', JSON.stringify(photoData));
                console.log('💾 Photo preview sauvegardé:', photoName);
              };
              reader.readAsDataURL(compressedFile);
            case 5:
              return _context.a(2);
          }
        }, _callee);
      }));
      return function (_x) {
        return _ref3.apply(this, arguments);
      };
    }());
  });
  photoMenuOptions.forEach(function (option) {
    option.addEventListener('click', function () {
      var action = option.getAttribute('data-action');
      photoMenuModal.classList.add('hidden');
      if (!activePhotoInput) return;
      if (action === 'library' || action === 'file') {
        activePhotoInput.click();
      } else if (action === 'camera') {
        cameraModal.classList.remove('hidden');
        cameraModal.style.zIndex = '9999';
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
            cameraVideo.srcObject = stream;
            cameraVideo.play();
          })["catch"](function (err) {
            console.error('Camera access denied:', err);
            showValidationError('Camera access denied');
            cameraModal.classList.add('hidden');
          });
        }
      }
    });
  });
  if (closePhotoMenuModal) {
    closePhotoMenuModal.onclick = function () {
      photoMenuModal.classList.add('hidden');
    };
  }
  photoMenuModal.addEventListener('click', function (e) {
    if (e.target === this) {
      this.classList.add('hidden');
    }
  });
  function closeCameraAndStream() {
    cameraModal.classList.add('hidden');
    if (cameraStream) {
      cameraStream.getTracks().forEach(function (track) {
        return track.stop();
      });
      cameraStream = null;
    }
    if (cameraVideo.srcObject) {
      cameraVideo.srcObject.getTracks().forEach(function (track) {
        return track.stop();
      });
      cameraVideo.srcObject = null;
    }
  }
  if (closeCameraModal) {
    closeCameraModal.onclick = closeCameraAndStream;
  }
  cameraModal.addEventListener('click', function (e) {
    if (e.target === this) {
      closeCameraAndStream();
    }
  });
  if (capturePhotoBtn) {
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
                var file, dataTransfer, photoUrl, photoBox, label, reader;
                return _regenerator().w(function (_context2) {
                  while (1) switch (_context2.n) {
                    case 0:
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
                        console.log('📸 Photo capturée et compressée:', file.size, 'bytes');
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
                          var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                          var photoName = activePhotoInput.name;
                          photoData[photoName] = {
                            base64: e.target.result,
                            timestamp: Date.now()
                          };
                          localStorage.setItem('photo-previews', JSON.stringify(photoData));
                          console.log('💾 Photo preview sauvegardé:', photoName);
                        };
                        reader.readAsDataURL(file);
                      }
                      closeCameraAndStream();
                    case 2:
                      return _context2.a(2);
                  }
                }, _callee2);
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
    zoomedImage.src = imageUrl;
    currentZoomLevel = 1;
    zoomedImage.style.transform = 'scale(1)';
    photoZoomModal.classList.remove('hidden');
    photoZoomModal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  }
  function closePhotoZoom() {
    photoZoomModal.classList.add('hidden');
    photoZoomModal.classList.remove('flex');
    currentPhotoBox = null;
    currentZoomLevel = 1;
    document.body.style.overflow = '';
  }
  if (closeZoomModal) {
    closeZoomModal.addEventListener('click', closePhotoZoom);
  }
  photoZoomModal.addEventListener('click', function (e) {
    if (e.target === this) {
      closePhotoZoom();
    }
  });
  if (zoomInBtn) {
    zoomInBtn.addEventListener('click', function () {
      currentZoomLevel = Math.min(currentZoomLevel + 0.25, 3);
      zoomedImage.style.transform = "scale(".concat(currentZoomLevel, ")");
    });
  }
  if (zoomOutBtn) {
    zoomOutBtn.addEventListener('click', function () {
      currentZoomLevel = Math.max(currentZoomLevel - 0.25, 0.5);
      zoomedImage.style.transform = "scale(".concat(currentZoomLevel, ")");
    });
  }
  if (resetZoomBtn) {
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
      input.value = '';
      preview.src = preview.getAttribute('data-default-src') || '/images/uploadpng.png';
      currentPhotoBox.classList.remove('has-photo');
      if (label) label.classList.remove('hidden');
      var photoName = input.name;
      var photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
      delete photoData[photoName];
      localStorage.setItem('photo-previews', JSON.stringify(photoData));
      console.log('🗑️ Photo supprimée:', photoName);
      closePhotoZoom();
    });
  }
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && !e.shiftKey && !nextBtn.disabled) {
      var activeEl = document.activeElement;
      if (activeEl && activeEl.tagName !== 'TEXTAREA') {
        e.preventDefault();
        nextBtn.click();
      }
    }
    if (e.key === 'Escape' && !photoZoomModal.classList.contains('hidden')) {
      closePhotoZoom();
    }
  });
  showStep(currentStep);
  if (window.countrySelect) {
    document.querySelectorAll('.country-select').forEach(function (select) {
      window.countrySelect(select, {
        defaultCountry: "us",
        onlyCountries: null,
        responsiveDropdown: true
      });
    });
  }
})();
/******/ })()
;