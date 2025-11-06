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
/* harmony import */ var _categoryColors_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./categoryColors.js */ "./resources/js/modules/categoryColors.js");
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
    DESKTOP_SIZE: 'w-14 h-14',
    PADDING: '0.4rem'
  },
  TEXT: {
    MOBILE_SIZE: 'text-xs',
    DESKTOP_SIZE: 'text-xs'
  },
  ANIMATION: {
    HOVER_TRANSFORM: 'translateY(-8px) scale(1.02)',
    DEFAULT_TRANSFORM: 'translateY(0) scale(1)'
  },
  CACHE: {
    ENABLED: true,
    DURATION: 300000
  }
};
var API_ENDPOINTS = {
  CATEGORIES: '/api/categories',
  SUBCATEGORIES: function SUBCATEGORIES(id) {
    return "/api/categories/".concat(id, "/subcategories");
  },
  CHILDREN: function CHILDREN(id) {
    return "/api/categories/".concat(id, "/children");
  }
};
var cache = {
  data: new Map(),
  get: function get(key) {
    if (!CONFIG.CACHE.ENABLED) return null;
    var cached = this.data.get(key);
    if (!cached || Date.now() - cached.timestamp > CONFIG.CACHE.DURATION) {
      this.data["delete"](key);
      return null;
    }
    return cached.value;
  },
  set: function set(key, value) {
    if (CONFIG.CACHE.ENABLED) {
      this.data.set(key, {
        value: value,
        timestamp: Date.now()
      });
    }
  }
};
var imageCache = new Set();
function debounce(func, wait) {
  var timeout;
  return function () {
    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      return func.apply(void 0, args);
    }, wait);
  };
}
function setupResponsiveGrid(container) {
  var columns = window.innerWidth >= CONFIG.GRID.BREAKPOINT ? CONFIG.GRID.DESKTOP_COLUMNS : CONFIG.GRID.MOBILE_COLUMNS;
  container.style.cssText = "display: grid; grid-template-columns: ".concat(columns, "; gap: ").concat(CONFIG.GRID.GAP, ";");
}
function getResponsiveSize(mobileValue, desktopValue) {
  return window.innerWidth >= CONFIG.GRID.BREAKPOINT ? desktopValue : mobileValue;
}
function createShineEffect() {
  return '<div class="shine-effect" aria-hidden="true"></div>';
}
function preloadImage(src) {
  if (imageCache.has(src)) return Promise.resolve(src);
  return new Promise(function (resolve, reject) {
    var img = new Image();
    img.onload = function () {
      imageCache.add(src);
      resolve(src);
    };
    img.onerror = reject;
    img.src = src;
  });
}
function createIconHtml(item, iconColor) {
  var iconSize = getResponsiveSize(CONFIG.ICONS.MOBILE_SIZE, CONFIG.ICONS.DESKTOP_SIZE);
  var escapedName = item.name.replace(/"/g, '&quot;');
  if (item.icon_image) {
    var imagePath = item.icon_image.startsWith('/') ? item.icon_image : '/' + item.icon_image;
    preloadImage(imagePath)["catch"](function () {});
    return "<div class=\"".concat(iconSize, " rounded-full mb-2 group-hover:scale-110 transition-transform flex-shrink-0\" style=\"background-color: ").concat(iconColor, "; padding: ").concat(CONFIG.ICONS.PADDING, "; display: flex; align-items: center; justify-content: center; overflow: hidden;\" role=\"img\" aria-label=\"").concat(escapedName, "\">") + "<img src=\"".concat(imagePath, "\" alt=\"").concat(escapedName, "\" class=\"w-full h-full object-contain rounded-full\" loading=\"lazy\" decoding=\"async\">") + '</div>';
  }
  return "<div class=\"".concat(iconSize, " rounded-full mb-2 group-hover:scale-110 transition-transform flex-shrink-0\" style=\"background-color: ").concat(iconColor, "; display: flex; align-items: center; justify-content: center;\" role=\"img\" aria-label=\"").concat(escapedName, "\">") + '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">' + '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' + '</svg></div>';
}
function createCategoryCard(item, level, allIds, onClickHandler) {
  var _categoryLevels$level;
  var div = document.createElement('button');
  div.type = 'button';
  div.className = "category-card rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-xl cursor-pointer group transition-all duration-300";
  div.setAttribute('aria-label', "S\xE9lectionner ".concat(item.name));
  div.setAttribute('role', 'button');
  div.style.cssText = "\n    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);\n    transform-style: preserve-3d;\n    position: relative;\n    overflow: visible;\n    display: flex;\n    flex-direction: column;\n    align-items: center;\n    text-align: center;\n    min-height: fit-content;\n    height: auto;\n  ";
  if (window.innerWidth >= CONFIG.GRID.BREAKPOINT) {
    div.style.padding = '1rem';
  }
  var iconColor = (0,_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.getCategoryColorByLevel)(level, item.id, allIds);
  var shadowColor = ((_categoryLevels$level = _categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels[level]) === null || _categoryLevels$level === void 0 ? void 0 : _categoryLevels$level.shadowColor) || 'rgba(59, 130, 246, 0.15)';
  var onMouseEnter = function onMouseEnter() {
    div.style.willChange = 'transform, box-shadow';
    div.style.transform = CONFIG.ANIMATION.HOVER_TRANSFORM;
    div.style.boxShadow = "0 20px 40px ".concat(shadowColor);
    var shine = div.querySelector('.shine-effect');
    if (shine) shine.style.left = '100%';
  };
  var onMouseLeave = function onMouseLeave() {
    div.style.transform = CONFIG.ANIMATION.DEFAULT_TRANSFORM;
    div.style.boxShadow = '';
    div.style.willChange = 'auto';
    var shine = div.querySelector('.shine-effect');
    if (shine) shine.style.left = '-100%';
  };
  div.addEventListener('mouseenter', onMouseEnter, {
    passive: true
  });
  div.addEventListener('mouseleave', onMouseLeave, {
    passive: true
  });
  var shineEffect = createShineEffect();
  var iconHtml = createIconHtml(item, iconColor);
  var textSize = getResponsiveSize(CONFIG.TEXT.MOBILE_SIZE, CONFIG.TEXT.DESKTOP_SIZE);
  var textHtml = "<div class=\"".concat(textSize, " font-semibold text-gray-800 category-text\">").concat(item.name, "</div>");
  div.innerHTML = shineEffect + iconHtml + textHtml;
  div.addEventListener('click', function () {
    return onClickHandler(item.id, item.name);
  }, {
    passive: true
  });
  return div;
}
function renderCategories(items, containerSelector, level, clickHandler) {
  var container = document.querySelector(containerSelector);
  if (!container) return;
  var fragment = document.createDocumentFragment();
  container.innerHTML = '';
  setupResponsiveGrid(container);
  var allIds = items.map(function (item) {
    return item.id;
  });
  requestAnimationFrame(function () {
    var len = items.length;
    for (var i = 0; i < len; i++) {
      var card = createCategoryCard(items[i], level, allIds, clickHandler);
      fragment.appendChild(card);
    }
    container.appendChild(fragment);
  });
}
function fetchWithCache(_x) {
  return _fetchWithCache.apply(this, arguments);
}
function _fetchWithCache() {
  _fetchWithCache = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(url) {
    var cached, response, data;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.n) {
        case 0:
          cached = cache.get(url);
          if (!cached) {
            _context.n = 1;
            break;
          }
          return _context.a(2, cached);
        case 1:
          _context.n = 2;
          return fetch(url);
        case 2:
          response = _context.v;
          _context.n = 3;
          return response.json();
        case 3:
          data = _context.v;
          cache.set(url, data);
          return _context.a(2, data);
      }
    }, _callee);
  }));
  return _fetchWithCache.apply(this, arguments);
}
function initializeCategoryPopups() {
  window.openHelpPopup = function () {
    var popup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId);
    if (!popup) return;
    popup.classList.remove('hidden');
    popup.setAttribute('aria-hidden', 'false');
    fetchWithCache(API_ENDPOINTS.CATEGORIES).then(function (data) {
      if (data.success) {
        renderCategories(data.categories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.containerClass), 'main', window.handleCategoryClick);
      }
    })["catch"](function (err) {
      return console.error('Fetch error:', err);
    });
  };
  window.handleCategoryClick = function (categoryId, categoryName) {
    var mainPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.main.popupId);
    var subPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId);
    if (mainPopup) {
      mainPopup.classList.add('hidden');
      mainPopup.setAttribute('aria-hidden', 'true');
    }
    if (subPopup) {
      subPopup.classList.remove('hidden');
      subPopup.setAttribute('aria-hidden', 'false');
    }
    var createRequest = {
      category: JSON.stringify({
        id: categoryId,
        name: categoryName
      })
    };
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    fetchWithCache(API_ENDPOINTS.SUBCATEGORIES(categoryId)).then(function (data) {
      if (data.success) {
        renderCategories(data.subcategories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.containerClass), 'sub', window.handleSubcategoryClick);
      }
    })["catch"](function (err) {
      return console.error('Error:', err);
    });
  };
  window.handleSubcategoryClick = function (parentId, categoryName) {
    var createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.sub_category = JSON.stringify({
      id: parentId,
      name: categoryName
    });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    fetchWithCache(API_ENDPOINTS.CHILDREN(parentId)).then(function (data) {
      if (data.success && data.subcategories.length > 0) {
        var subPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.sub.popupId);
        var childPopup = document.getElementById(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.popupId);
        if (subPopup) {
          subPopup.classList.add('hidden');
          subPopup.setAttribute('aria-hidden', 'true');
        }
        if (childPopup) {
          childPopup.classList.remove('hidden');
          childPopup.setAttribute('aria-hidden', 'false');
        }
        renderCategories(data.subcategories, "#".concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.popupId, " .").concat(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels.child.containerClass), 'child', window.requestForHelp);
      } else {
        window.requestForHelp(parentId, categoryName);
      }
    })["catch"](function (err) {
      return console.error('Error:', err);
    });
  };
  window.requestForHelp = function (childId, childName) {
    var createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({
      id: childId,
      name: childName
    });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  };
  var debouncedResize = debounce(function () {
    Object.values(_categoryColors_js__WEBPACK_IMPORTED_MODULE_0__.categoryLevels).forEach(function (level) {
      var container = document.querySelector("#".concat(level.popupId, " .").concat(level.containerClass));
      if (container && !container.classList.contains('hidden')) {
        setupResponsiveGrid(container);
      }
    });
  }, 250);
  window.addEventListener('resize', debouncedResize, {
    passive: true
  });
}

/***/ }),

/***/ "./resources/js/modules/categoryColors.js":
/*!************************************************!*\
  !*** ./resources/js/modules/categoryColors.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   categoryColors: () => (/* binding */ categoryColors),
/* harmony export */   categoryLevels: () => (/* binding */ categoryLevels),
/* harmony export */   getCategoryColor: () => (/* binding */ getCategoryColor),
/* harmony export */   getCategoryColorByLevel: () => (/* binding */ getCategoryColorByLevel),
/* harmony export */   testColorSystem: () => (/* binding */ testColorSystem)
/* harmony export */ });
// Palette étendue de 80 couleurs uniques et distinctes visuellement
var categoryColors = {
  // Palette principale : 80 couleurs variées et distinctes
  palette: [
  // Rouges (8)
  '#E74C3C', '#C0392B', '#E63946', '#D62828', '#F77F00', '#DC2F02', '#D00000', '#9D0208',
  // Oranges (8)
  '#E67E22', '#D35400', '#F39C12', '#F4A261', '#E76F51', '#EE6C4D', '#F08080', '#FF6B6B',
  // Jaunes (8)
  '#F1C40F', '#F39C12', '#FFB703', '#FFBA08', '#FBBF24', '#FCD34D', '#FDE047', '#FACC15',
  // Verts clairs (8)
  '#2ECC71', '#27AE60', '#16A085', '#06D6A0', '#10B981', '#14B8A6', '#22D3EE', '#06B6D4',
  // Verts foncés (8)
  '#1ABC9C', '#00B894', '#00D9A5', '#26DE81', '#20BF6B', '#118AB2', '#0D9488', '#059669',
  // Bleus clairs (8)
  '#3498DB', '#2980B9', '#0984E3', '#74B9FF', '#60A5FA', '#3B82F6', '#2563EB', '#4F46E5',
  // Bleus foncés (8)
  '#1E3A8A', '#1E40AF', '#1D4ED8', '#2563EB', '#0369A1', '#075985', '#0C4A6E', '#1F2937',
  // Violets (8)
  '#9B59B6', '#8E44AD', '#6C5CE7', '#A29BFE', '#7C3AED', '#6D28D9', '#5B21B6', '#4C1D95',
  // Roses (8)
  '#E91E63', '#D81B60', '#C2185B', '#FD79A8', '#F687B3', '#EC4899', '#DB2777', '#BE185D',
  // Bruns/Neutres (8)
  '#795548', '#6D4C41', '#5D4037', '#4E342E', '#78716C', '#57534E', '#44403C', '#292524']
};

/**
 * Génère un hash stable à partir d'un ID
 * Garantit que le même ID produit toujours le même hash
 */
function generateStableHash(id) {
  // Convertir l'ID en chaîne pour le traitement
  var str = String(id);
  var hash = 0;
  for (var i = 0; i < str.length; i++) {
    var _char = str.charCodeAt(i);
    hash = (hash << 5) - hash + _char;
    hash = hash & hash; // Convertir en entier 32bit
  }
  return Math.abs(hash);
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
  return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase();
}

/**
 * Applique une variation à une couleur pour la rendre distincte
 * @param {string} color - Couleur hex de base
 * @param {number} variation - Niveau de variation (1-5)
 */
function applyColorVariation(color, variation) {
  var rgb = hexToRgb(color);
  if (!rgb) return color;

  // Appliquer des variations subtiles mais visibles
  var factor = variation * 15; // 15, 30, 45, 60, 75

  // Alterner entre éclaircir et assombrir
  var modifier = variation % 2 === 0 ? factor : -factor;
  var r = Math.max(0, Math.min(255, rgb.r + modifier));
  var g = Math.max(0, Math.min(255, rgb.g + modifier));
  var b = Math.max(0, Math.min(255, rgb.b + modifier));
  return rgbToHex(r, g, b);
}

/**
 * Calcule la distance de couleur entre deux couleurs (simplicité)
 */
function colorDistance(color1, color2) {
  var rgb1 = hexToRgb(color1);
  var rgb2 = hexToRgb(color2);
  if (!rgb1 || !rgb2) return 1000;
  return Math.sqrt(Math.pow(rgb1.r - rgb2.r, 2) + Math.pow(rgb1.g - rgb2.g, 2) + Math.pow(rgb1.b - rgb2.b, 2));
}

/**
 * Obtient la couleur d'une catégorie basée sur son ID
 * @param {string} level - Le niveau de catégorie ('main', 'sub', 'child')
 * @param {number|string} id - L'ID unique de la catégorie
 * @param {Array} allIds - Tous les IDs à afficher sur la page actuelle
 * @returns {string} Code couleur hexadécimal
 */
function getCategoryColor(level, id) {
  var allIds = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  var colors = categoryColors.palette;

  // Générer un hash stable pour cet ID
  var hash = generateStableHash(id);
  var baseColorIndex = hash % colors.length;
  var baseColor = colors[baseColorIndex];

  // Si on n'a pas la liste complète, retourner la couleur de base
  if (allIds.length === 0) {
    return baseColor;
  }

  // Créer un mapping de tous les IDs vers leurs couleurs de base
  var colorMapping = new Map();
  var colorUsageCount = new Map();
  allIds.forEach(function (itemId) {
    var itemHash = generateStableHash(itemId);
    var itemColorIndex = itemHash % colors.length;
    var itemBaseColor = colors[itemColorIndex];
    colorMapping.set(itemId, itemBaseColor);

    // Compter combien de fois chaque couleur est utilisée
    var count = colorUsageCount.get(itemBaseColor) || 0;
    colorUsageCount.set(itemBaseColor, count + 1);
  });

  // Si la couleur de base n'est utilisée qu'une fois, la retourner telle quelle
  if (colorUsageCount.get(baseColor) === 1) {
    return baseColor;
  }

  // Si plusieurs catégories ont la même couleur de base, appliquer des variations
  var idsWithSameColor = allIds.filter(function (itemId) {
    return colorMapping.get(itemId) === baseColor;
  });
  var indexInGroup = idsWithSameColor.indexOf(id);

  // Appliquer une variation si ce n'est pas le premier de la couleur
  if (indexInGroup > 0) {
    return applyColorVariation(baseColor, indexInGroup);
  }
  return baseColor;
}

/**
 * Obtient une couleur pour un niveau spécifique (pour compatibilité)
 * Applique une légère teinte selon le niveau pour différencier visuellement
 */
function getCategoryColorByLevel(level, id) {
  var allIds = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  var baseColor = getCategoryColor(level, id, allIds);
  var rgb = hexToRgb(baseColor);
  if (!rgb) return baseColor;

  // Appliquer une légère modification selon le niveau
  var r = rgb.r,
    g = rgb.g,
    b = rgb.b;
  switch (level) {
    case 'main':
      // Catégories principales : couleurs plus saturées
      r = Math.min(255, r + 10);
      g = Math.min(255, g + 10);
      b = Math.min(255, b + 10);
      break;
    case 'sub':
      // Sous-catégories : couleurs moyennes (pas de modification)
      break;
    case 'child':
      // Sous-sous-catégories : couleurs légèrement plus sombres
      r = Math.max(0, r - 15);
      g = Math.max(0, g - 15);
      b = Math.max(0, b - 15);
      break;
  }
  return rgbToHex(r, g, b);
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
 * Fonction de test pour vérifier le système de couleurs
 */
function testColorSystem() {
  console.log('=== TEST DU SYSTÈME DE COULEURS ===');
  console.log("Nombre de couleurs disponibles: ".concat(categoryColors.palette.length));

  // Tester avec des IDs typiques
  var testIds = [1, 2, 3, 50, 100, 150, 200, 250, 300, 350, 400];
  console.log('\n--- Couleurs de base (sans doublons) ---');
  testIds.forEach(function (id) {
    var color = getCategoryColor('main', id, []);
    console.log("ID ".concat(id, " \u2192 ").concat(color));
  });

  // Tester avec des IDs qui pourraient avoir la même couleur
  var conflictIds = [1, 81, 161, 241]; // Ces IDs auront la même couleur de base

  console.log('\n--- Gestion des doublons ---');
  conflictIds.forEach(function (id) {
    var color = getCategoryColor('main', id, conflictIds);
    console.log("ID ".concat(id, " \u2192 ").concat(color, " (avec variations)"));
  });
  console.log('\n--- Stabilité (même ID = même couleur) ---');
  var stableId = 42;
  for (var i = 0; i < 5; i++) {
    var color = getCategoryColor('main', stableId, []);
    console.log("Appel ".concat(i + 1, ": ID ").concat(stableId, " \u2192 ").concat(color));
  }
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
 * Language Manager - Professional Architecture
 * Manages UI interactions only, Google Translate init handled in header
 */

var LanguageManager = /*#__PURE__*/function () {
  function LanguageManager() {
    _classCallCheck(this, LanguageManager);
    this.selectedLang = localStorage.getItem('ulixai_lang') || 'en';
    this.selectedFlag = localStorage.getItem('ulixai_flag') || 'https://flagcdn.com/24x18/us.png';
    this.googleTranslateReady = false;
    this.initPromise = null;
  }

  /**
   * Initialize language manager
   * Waits for DOM and Google Translate to be ready
   */
  return _createClass(LanguageManager, [{
    key: "init",
    value: (function () {
      var _init = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              console.log('🌐 [LangManager] Initializing...');

              // Wait for DOM
              _context.n = 1;
              return this.waitForDOM();
            case 1:
              _context.n = 2;
              return this.waitForGoogleTranslate();
            case 2:
              // Initialize UI
              this.initDesktopLanguageSelector();
              this.initMobileLanguageSelector();
              console.log('✅ [LangManager] Initialized');
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
     * Wait for Google Translate to be ready
     */
  }, {
    key: "waitForGoogleTranslate",
    value: function waitForGoogleTranslate() {
      var _this = this;
      var timeout = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 10000;
      return new Promise(function (resolve) {
        if (window.googleTranslateReady) {
          console.log('✅ [LangManager] Google Translate already ready');
          resolve();
          return;
        }
        var timeoutId = setTimeout(function () {
          console.warn('⚠️ [LangManager] Google Translate timeout');
          resolve(); // Continue anyway
        }, timeout);
        window.addEventListener('googleTranslateReady', function () {
          clearTimeout(timeoutId);
          _this.googleTranslateReady = true;
          console.log('✅ [LangManager] Google Translate ready event received');
          resolve();
        }, {
          once: true
        });
      });
    }

    /**
     * Initialize desktop language selector
     */
  }, {
    key: "initDesktopLanguageSelector",
    value: function initDesktopLanguageSelector() {
      var _this2 = this;
      var langBtn = document.getElementById('langBtn');
      var langMenu = document.getElementById('langMenu');
      var langFlag = document.getElementById('langFlag');
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
      });

      // Select language
      langMenu.addEventListener('click', function (e) {
        var li = e.target.closest('li[data-lang]');
        if (!li) return;
        var lang = li.getAttribute('data-lang');
        var flag = li.getAttribute('data-flag');
        if (lang && flag) {
          console.log('🌐 [LangManager] Language selected:', lang);
          langFlag.src = flag;
          _this2.setLanguage(lang, flag);
          langMenu.classList.add('hidden');
          isOpen = false;
        }
      });

      // Close on outside click
      document.addEventListener('click', function (e) {
        if (isOpen && !langBtn.contains(e.target) && !langMenu.contains(e.target)) {
          langMenu.classList.add('hidden');
          isOpen = false;
          langBtn.setAttribute('aria-expanded', 'false');
        }
      });

      // Restore saved language
      langFlag.src = this.selectedFlag;
    }

    /**
     * Initialize mobile language selector
     */
  }, {
    key: "initMobileLanguageSelector",
    value: function initMobileLanguageSelector() {
      var _this3 = this;
      var checkbox = document.getElementById('langOpen');
      var menu = document.getElementById('languageMenu');
      var flag = document.getElementById('languageFlag');
      var label = document.getElementById('languageLabel');
      if (!checkbox || !menu || !flag || !label) {
        console.warn('⚠️ [LangManager] Mobile elements not found');
        return;
      }
      console.log('✅ [LangManager] Mobile selector found');
      var langNames = {
        en: 'English',
        fr: 'Français',
        de: 'Deutsch'
      };

      // Handle language selection
      menu.addEventListener('click', function (e) {
        var li = e.target.closest('li[data-lang]');
        if (!li) return;
        var code = li.dataset.lang;
        var flagUrl = li.dataset.flag;
        var name = langNames[code] || code;
        console.log('🌐 [LangManager] Mobile language selected:', code);

        // Update UI
        flag.src = flagUrl;
        label.textContent = name;

        // Save and apply
        _this3.setLanguage(code, flagUrl);

        // Close menu
        checkbox.checked = false;
      });

      // Restore saved language
      flag.src = this.selectedFlag;
      label.textContent = langNames[this.selectedLang] || 'Language';
    }

    /**
     * Set language and reload page
     */
  }, {
    key: "setLanguage",
    value: function setLanguage(lang, flag) {
      console.log('🔄 [LangManager] Changing language to:', lang);

      // Update storage
      localStorage.setItem('ulixai_lang', lang);
      localStorage.setItem('ulixai_flag', flag);

      // Update cookies for Google Translate
      this.setCookiesForLanguage(lang);

      // Reload page to apply
      console.log('🔄 [LangManager] Reloading page...');

      // Small delay to ensure cookies are set
      setTimeout(function () {
        window.location.reload();
      }, 100);
    }

    /**
     * Set cookies for Google Translate
     */
  }, {
    key: "setCookiesForLanguage",
    value: function setCookiesForLanguage(lang) {
      var expires = new Date(Date.now() + 365 * 864e5).toUTCString();
      if (lang === 'en') {
        // Clear cookies for English
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = 'googtransopt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      } else {
        // Set cookies for other languages
        var val = "/auto/".concat(lang);
        document.cookie = "googtrans=".concat(val, "; expires=").concat(expires, "; path=/");
        document.cookie = "googtransopt=".concat(val, "; expires=").concat(expires, "; path=/");
      }
      console.log('✅ [LangManager] Cookies set for language:', lang);
    }
  }]);
}();

/**
 * Initialize and expose globally
 */
function initializeLanguageManager() {
  console.log('🚀 [LangManager] Starting initialization...');
  var languageManager = new LanguageManager();
  languageManager.init();

  // Expose globally for debugging
  window.ulixaiLanguageManager = languageManager;
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
        el.classList.toggle('opacity-50', !enabled);
        el.classList.toggle('cursor-not-allowed', !enabled);
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
      var popup = document.getElementById('signupPopup');

      // --- DÉLÉGATION ROBUSTE (capture) ---
      document.addEventListener('click', function (e) {
        var t = e.target;
        if (!t || !t.closest) return;

        // OUVRIR SIGN UP (toutes variantes courantes)
        var openSignup = t.closest('#signupBtn, [data-open="signup"], .js-open-signup, [data-action="open-signup"], a[href="#signupPopup"], [data-target="#signupPopup"], [aria-controls="signupPopup"]');
        if (openSignup) {
          e.preventDefault();
          _this.openPopup();
          return;
        }

        // OUVRIR REQUEST HELP (délégué à category-popups.js)
        var openHelp = t.closest('#requestHelpBtn, #helpBtn, [data-open="help"], .js-open-help, [data-action="open-help"], a[href="#helpPopup"], [data-target="#helpPopup"]');
        if (openHelp) {
          e.preventDefault();
          if (typeof window.openHelpPopup === 'function') {
            window.openHelpPopup();
          } else {
            console.warn('openHelpPopup() non disponible – vérifier initializeCategoryPopups()');
          }
          return;
        }

        // FERMER SIGN UP (croix + variantes)
        var closeBtn = t.closest('#closePopup, [data-close="signup"], .js-close-signup, [data-action="close-signup"], .modal-close, [aria-label="Close"]');
        if (closeBtn) {
          e.preventDefault();
          _this.closePopup();
          return;
        }

        // FERMETURE via BACKDROP
        if (popup && e.target === popup) {
          _this.closePopup();
        }
      }, true); // capture=true pour intercepter tôt

      // Fallback direct si éléments présents à l'init (au cas où)
      var directOpen = document.getElementById('signupBtn');
      if (directOpen) {
        directOpen.addEventListener('click', function (e) {
          e.preventDefault();
          _this.openPopup();
        });
      }
      var directClose = document.getElementById('closePopup');
      if (directClose) {
        directClose.addEventListener('click', function (e) {
          e.preventDefault();
          _this.closePopup();
        });
      }

      // ESC pour fermer
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
          _this.closePopup();
        }
      });

      // Globals pour compatibilité HTML inline
      window.openSignupPopup = function () {
        return _this.openPopup();
      };
      window.closeSignupPopup = function () {
        return _this.closePopup();
      };
      console.log('✅ Popup controls initialized (delegated, signup + help)');
    }
  }, {
    key: "closePopup",
    value: function closePopup() {
      var popup = document.getElementById('signupPopup');
      if (!popup) {
        console.warn('⚠️ Popup not found');
        return;
      }
      // Ajoute toutes les classes de masquage usuelles
      popup.classList.add('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
      popup.setAttribute('aria-hidden', 'true');
      popup.style.display = 'none';
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
      // Retire toutes les classes de masquage usuelles
      popup.classList.remove('hidden', 'invisible', 'opacity-0', 'pointer-events-none');
      popup.removeAttribute('aria-hidden');
      popup.style.display = 'block';
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
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Wizard Steps – version anti-conflit
 * - Step 1 : nav masquée
 * - Click [data-go-step] : navigation fiable (ex: bloc bleu → data-go-step="2")
 * - Auto-sync : si un step est montré par le DOM, on met à jour currentStep
 * - Déverrouillage centralisé
 */

var WizardSteps = /*#__PURE__*/function () {
  function WizardSteps() {
    _classCallCheck(this, WizardSteps);
    this.currentStep = 0;
    this.totalSteps = 15;
    this.formData = this.loadFormData();
  }
  return _createClass(WizardSteps, [{
    key: "loadFormData",
    value: function loadFormData() {
      try {
        return JSON.parse(localStorage.getItem('provider-signup-data')) || {};
      } catch (_unused) {
        return {};
      }
    }
  }, {
    key: "saveFormData",
    value: function saveFormData() {
      try {
        localStorage.setItem('provider-signup-data', JSON.stringify(this.formData));
      } catch (_unused2) {}
    }
  }, {
    key: "init",
    value: function init() {
      this.initNavigationButtons();
      this.initDelegatedGoTo(); // <— NEW
      this.initStepValidation();
      this.initProgressBar();
      this.showStep(0);
      window.wizardSteps = this;
    }

    // Délégation globale : tout élément avec data-go-step="N" provoque showStep(N)
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
        _this.showStep(to - 1);
      }, true); // capture pour passer avant d’éventuels stopPropagation
    }

    // Mets à jour currentStep à partir du DOM (si quelqu’un a affiché un step sans passer par showStep)
  }, {
    key: "syncCurrentFromDOM",
    value: function syncCurrentFromDOM() {
      for (var i = 1; i <= this.totalSteps; i++) {
        var s = document.getElementById("step".concat(i));
        if (s && !s.classList.contains('hidden')) {
          this.currentStep = i - 1;
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
          if (_this2.validateCurrentStep()) _this2.nextStep();
        });
      });
      document.querySelectorAll('#mobileBackBtn, #desktopBackBtn').forEach(function (btn) {
        return btn.addEventListener('click', function (e) {
          e.preventDefault();
          _this2.previousStep();
        });
      });
    }
  }, {
    key: "initStepValidation",
    value: function initStepValidation() {
      var _this3 = this;
      var _loop = function _loop() {
        var el = document.getElementById("step".concat(i));
        if (!el) return 1; // continue
        var h = function h() {
          return _this3.updateNavigationButtons();
        };
        el.querySelectorAll('input, select, textarea').forEach(function (n) {
          n.addEventListener('input', h);
          n.addEventListener('change', h);
        });
      };
      for (var i = 1; i <= this.totalSteps; i++) {
        if (_loop()) continue;
      }
      // sécurise Step 2 : recalcule après n’importe quel clic dans #step2
      document.addEventListener('click', function (e) {
        if (e.target && e.target.closest && e.target.closest('#step2')) {
          setTimeout(function () {
            return _this3.updateNavigationButtons();
          }, 0);
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
    }
  }, {
    key: "showStep",
    value: function showStep(i) {
      if (i < 0 || i >= this.totalSteps) return;
      for (var k = 1; k <= this.totalSteps; k++) {
        var s = document.getElementById("step".concat(k));
        if (s) s.classList.add('hidden');
      }
      var cur = document.getElementById("step".concat(i + 1));
      if (!cur) return;
      cur.classList.remove('hidden');
      this.currentStep = i;
      this.updateProgressBar();
      this.updateNavigationButtons();
    }
  }, {
    key: "nextStep",
    value: function nextStep() {
      this.saveCurrentStepData();
      if (this.currentStep < this.totalSteps - 1) this.showStep(this.currentStep + 1);else this.submitForm();
    }
  }, {
    key: "previousStep",
    value: function previousStep() {
      if (this.currentStep > 0) this.showStep(this.currentStep - 1);
    }
  }, {
    key: "validateCurrentStep",
    value: function validateCurrentStep() {
      // TRES IMPORTANT : si quelqu’un a montré un autre step sans passer par showStep, on se resynchronise
      this.syncCurrentFromDOM();
      var stepNum = this.currentStep + 1;
      var el = document.getElementById("step".concat(stepNum));
      if (!el) return true;
      var custom = window["validateStep".concat(stepNum)];
      if (typeof custom === 'function') {
        try {
          return !!custom();
        } catch (_unused3) {
          return false;
        }
      }
      if (stepNum === 2) {
        var hidden = el.querySelector('input[name="native_language"], #nativeLanguage, #native_language');
        var hasHidden = !!(hidden && String(hidden.value || '').trim());
        var hasCard = !!el.querySelector('.language-card.selected, .language-card[aria-checked="true"], [data-selected="true"], .active, [aria-selected="true"]');
        var countEl = el.querySelector('#selectedCount, .selected-count, [data-selected-count], #step2SelectedCount');
        var hasCount = false;
        if (countEl) {
          var n = parseInt((countEl.textContent || '').replace(/[^\d]/g, ''), 10);
          hasCount = Number.isFinite(n) && n > 0;
        }
        return hasHidden || hasCard || hasCount;
      }
      var req = el.querySelectorAll('[data-required]');
      if (!req.length) return true;
      var _iterator = _createForOfIteratorHelper(req),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var input = _step.value;
          if (['checkbox', 'radio'].includes(input.type)) {
            if (!input.checked) return false;
          } else {
            if (String(input.value || '').trim() === '') return false;
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
      return true;
    }
  }, {
    key: "updateNavigationButtons",
    value: function updateNavigationButtons() {
      var _this4 = this;
      // resync au cas où le DOM montre un autre step
      this.syncCurrentFromDOM();
      var mobileWrap = document.getElementById('mobileNavButtons');
      var desktopWrap = document.getElementById('desktopNavButtons');
      var backButtons = document.querySelectorAll('#mobileBackBtn, #desktopBackBtn');
      var nextButtons = document.querySelectorAll('#mobileNextBtn, #desktopNextBtn');
      if (this.currentStep === 0) {
        if (mobileWrap) mobileWrap.style.display = 'none';
        if (desktopWrap) desktopWrap.style.display = 'none';
      } else {
        if (mobileWrap) mobileWrap.style.display = '';
        if (desktopWrap) desktopWrap.style.display = '';
      }
      backButtons.forEach(function (b) {
        return b.style.display = _this4.currentStep === 0 ? 'none' : 'flex';
      });
      nextButtons.forEach(function (btn) {
        var span = btn.querySelector('span');
        if (span) span.textContent = _this4.currentStep === _this4.totalSteps - 1 ? 'Submit' : 'Continue';
      });
      var isValid = this.currentStep === 0 ? false : this.validateCurrentStep();
      nextButtons.forEach(function (btn) {
        try {
          btn.disabled = !isValid;
        } catch (_unused4) {}
        btn.setAttribute('aria-disabled', String(!isValid));
        btn.classList.toggle('opacity-50', !isValid);
        btn.classList.toggle('cursor-not-allowed', !isValid);
        btn.classList.toggle('pointer-events-none', !isValid);
        btn.style.pointerEvents = isValid ? 'auto' : 'none';
      });
      [mobileWrap, desktopWrap].forEach(function (w) {
        if (!w) return;
        w.classList.toggle('opacity-50', !isValid && _this4.currentStep !== 0);
        w.classList.toggle('pointer-events-none', !isValid && _this4.currentStep !== 0);
        w.style.pointerEvents = !isValid && _this4.currentStep !== 0 ? 'none' : 'auto';
      });
    }
  }, {
    key: "saveCurrentStepData",
    value: function saveCurrentStepData() {
      var _this5 = this;
      var el = document.getElementById("step".concat(this.currentStep + 1));
      if (!el) return;
      el.querySelectorAll('input, select, textarea').forEach(function (input) {
        if (!input.name) return;
        if (input.type === 'checkbox') {
          if (!_this5.formData[input.name]) _this5.formData[input.name] = [];
          if (input.checked) {
            if (!_this5.formData[input.name].includes(input.value)) _this5.formData[input.name].push(input.value);
          } else {
            _this5.formData[input.name] = (_this5.formData[input.name] || []).filter(function (v) {
              return v !== input.value;
            });
          }
        } else if (input.type === 'radio') {
          if (input.checked) _this5.formData[input.name] = input.value;
        } else {
          _this5.formData[input.name] = input.value || '';
        }
      });
      this.saveFormData();
    }
  }, {
    key: "submitForm",
    value: function submitForm() {
      if (typeof window.onProviderSignupSubmit === 'function') {
        try {
          window.onProviderSignupSubmit(this.formData);
          return;
        } catch (_unused5) {}
      }
      console.log('📤 Submitting form...', this.formData);
      alert('Form submission not implemented');
    }
  }]);
}();
function initializeWizardSteps() {
  var ws = new WizardSteps();
  ws.init();
  window.providerWizardSteps = ws;
  if (!window.showStep) window.showStep = function (i) {
    return ws.showStep(i);
  };
  if (!window.updateNavigationButtons) window.updateNavigationButtons = function () {
    return ws.updateNavigationButtons();
  };
  return ws;
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
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/**
 * Header Initialization - Laravel Mix Compatible
 * Point d'entrée principal pour tous les modules header
 */








/** Exécute une init en isolant les erreurs pour ne pas bloquer les autres modules */
function safeInit(name, fn) {
  try {
    console.log("\uD83D\uDD04 Initializing ".concat(name, "..."));
    var result = fn();
    console.log("\u2705 ".concat(name, " initialized successfully"));
    return result;
  } catch (e) {
    console.error("\u274C ".concat(name, " failed:"), e);
    return null;
  }
}
function initializeAll() {
  console.log('🚀 Initializing header modules...');
  console.log('📦 Available modules:', {
    wizard: _typeof(_modules_wizard_core_js__WEBPACK_IMPORTED_MODULE_0__.initializeWizard),
    steps: _typeof(_modules_wizard_steps_js__WEBPACK_IMPORTED_MODULE_1__.initializeWizardSteps),
    menu: _typeof(_modules_mobile_menu_js__WEBPACK_IMPORTED_MODULE_2__.initializeMobileMenu),
    language: _typeof(_modules_language_manager_js__WEBPACK_IMPORTED_MODULE_3__.initializeLanguageManager),
    popups: _typeof(_modules_category_popups_js__WEBPACK_IMPORTED_MODULE_4__.initializeCategoryPopups),
    scroll: _typeof(_modules_scroll_utils_js__WEBPACK_IMPORTED_MODULE_5__.initializeScrollUtils)
  });

  // 1) Core (popups SignUp / croix / ESC / backdrop) d'abord
  var wizard = safeInit('Wizard', _modules_wizard_core_js__WEBPACK_IMPORTED_MODULE_0__.initializeWizard);

  // 2) Steps (wizard-steps) ensuite — isolé pour ne pas bloquer le reste en cas d'erreur
  var steps = safeInit('WizardSteps', _modules_wizard_steps_js__WEBPACK_IMPORTED_MODULE_1__.initializeWizardSteps);

  // 3) Autres features du header
  safeInit('MobileMenu', _modules_mobile_menu_js__WEBPACK_IMPORTED_MODULE_2__.initializeMobileMenu);

  // 4) Language Manager avec vérification
  var langManager = safeInit('LanguageManager', function () {
    var manager = (0,_modules_language_manager_js__WEBPACK_IMPORTED_MODULE_3__.initializeLanguageManager)();

    // Vérifier après 500ms si les éléments sont bien initialisés
    setTimeout(function () {
      var langBtn = document.getElementById('langBtn');
      console.log('🔍 Language button check:', {
        exists: !!langBtn,
        manager: !!window.providerLanguageManager
      });
      if (!langBtn) {
        console.error('❌ Language button not found in DOM!');
      }
      if (!window.providerLanguageManager) {
        console.error('❌ Language manager not exposed globally!');
      }
    }, 500);
    return manager;
  });
  safeInit('CategoryPopups', _modules_category_popups_js__WEBPACK_IMPORTED_MODULE_4__.initializeCategoryPopups);
  safeInit('ScrollUtils', _modules_scroll_utils_js__WEBPACK_IMPORTED_MODULE_5__.initializeScrollUtils);

  // 5) Wrappers globaux attendus par le markup (onclick="showStep(1)" etc.)
  (function exposeWrappers() {
    try {
      if (!window.showStep) {
        window.showStep = function (i) {
          if (window.providerWizardSteps && typeof window.providerWizardSteps.showStep === 'function') {
            window.providerWizardSteps.showStep(i);
          } else if (steps && typeof steps.showStep === 'function') {
            steps.showStep(i);
          }
        };
      }
      if (!window.updateNavigationButtons) {
        window.updateNavigationButtons = function () {
          if (window.providerWizardSteps && typeof window.providerWizardSteps.updateNavigationButtons === 'function') {
            window.providerWizardSteps.updateNavigationButtons();
          } else if (steps && typeof steps.updateNavigationButtons === 'function') {
            steps.updateNavigationButtons();
          }
        };
      }
    } catch (e) {
      console.warn('⚠️ Wrapper exposure failed', e);
    }
  })();

  // 6) Synchroniser l'état des boutons (phase BUBBLE, sans double logique)
  ['input', 'change', 'click'].forEach(function (evt) {
    document.addEventListener(evt, function () {
      try {
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      } catch (e) {}
    }, false);
  });

  // Signal spécifique Step 2 (si émis)
  document.addEventListener('pw:step2:changed', function () {
    try {
      if (typeof window.updateNavigationButtons === 'function') window.updateNavigationButtons();
    } catch (e) {}
  });
  console.log('✅ All header modules initialized');
  console.log('🔍 Global objects:', {
    providerWizard: !!window.providerWizard,
    providerWizardSteps: !!window.providerWizardSteps,
    providerLanguageManager: !!window.providerLanguageManager
  });
}

// Lancer l'init quand le DOM est prêt
if (document.readyState === 'loading') {
  console.log('⏳ DOM is loading, waiting for DOMContentLoaded...');
  document.addEventListener('DOMContentLoaded', initializeAll, {
    once: true
  });
} else {
  console.log('✅ DOM already loaded, initializing now');
  initializeAll();
}
})();

/******/ })()
;