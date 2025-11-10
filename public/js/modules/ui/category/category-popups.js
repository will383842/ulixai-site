import { getCategoryColorByLevel, categoryLevels } from './categoryColors.js';
import { getCategoryIcon } from './categoryIcons.js';

const CONFIG = {
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

const API_ENDPOINTS = {
  CATEGORIES: '/api/categories',
  SUBCATEGORIES: (id) => `/api/categories/${id}/subcategories`,
  CHILDREN: (id) => `/api/categories/${id}/children`
};

const cache = {
  data: new Map(),
  get(key) {
    if (!CONFIG.CACHE.ENABLED) return null;
    const cached = this.data.get(key);
    if (!cached || Date.now() - cached.timestamp > CONFIG.CACHE.DURATION) {
      this.data.delete(key);
      return null;
    }
    return cached.value;
  },
  set(key, value) {
    if (CONFIG.CACHE.ENABLED) {
      this.data.set(key, { value, timestamp: Date.now() });
    }
  }
};

function debounce(func, wait) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), wait);
  };
}

function setupResponsiveGrid(container) {
  const columns = window.innerWidth >= CONFIG.GRID.BREAKPOINT 
    ? CONFIG.GRID.DESKTOP_COLUMNS 
    : CONFIG.GRID.MOBILE_COLUMNS;
  container.style.cssText = `display: grid; grid-template-columns: ${columns}; gap: ${CONFIG.GRID.GAP};`;
}

function getResponsiveSize(mobileValue, desktopValue) {
  return window.innerWidth >= CONFIG.GRID.BREAKPOINT ? desktopValue : mobileValue;
}

function createShineEffect() {
  return '<div class="shine-effect" aria-hidden="true"></div>';
}

function createIconHtml(item, iconColor, parentId = 'root') {
  const iconSize = getResponsiveSize(CONFIG.ICONS.MOBILE_SIZE, CONFIG.ICONS.DESKTOP_SIZE);
  const escapedName = item.name.replace(/"/g, '&quot;');
  
  const iconSVG = getCategoryIcon(item.name, item.id, parentId);
  
  return `<div class="${iconSize} rounded-full mb-2 group-hover:scale-110 transition-transform flex-shrink-0" style="background-color: ${iconColor}; display: flex; align-items: center; justify-content: center;" role="img" aria-label="${escapedName}">` +
         `<div class="w-8 h-8 text-white" style="width: 2rem; height: 2rem;">${iconSVG}</div>` +
         '</div>';
}

function createCategoryCard(item, level, allIds, onClickHandler, parentId = 'root') {
  const div = document.createElement('button');
  div.type = 'button';
  div.className = "category-card rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-xl cursor-pointer group transition-all duration-300";
  div.setAttribute('aria-label', `Sélectionner ${item.name}`);
  div.setAttribute('role', 'button');
  div.setAttribute('translate', 'yes'); // 🆕 Pour Google Translate
  
  div.style.cssText = `
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    transform-style: preserve-3d;
    position: relative;
    overflow: visible;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    min-height: fit-content;
    height: auto;
  `;
  
  if (window.innerWidth >= CONFIG.GRID.BREAKPOINT) {
    div.style.padding = '1rem';
  }
  
  const iconColor = getCategoryColorByLevel(level, item.id, allIds);
  const shadowColor = categoryLevels[level]?.shadowColor || 'rgba(59, 130, 246, 0.15)';
  
  const onMouseEnter = () => {
    div.style.willChange = 'transform, box-shadow';
    div.style.transform = CONFIG.ANIMATION.HOVER_TRANSFORM;
    div.style.boxShadow = `0 20px 40px ${shadowColor}`;
    const shine = div.querySelector('.shine-effect');
    if (shine) shine.style.left = '100%';
  };
  
  const onMouseLeave = () => {
    div.style.transform = CONFIG.ANIMATION.DEFAULT_TRANSFORM;
    div.style.boxShadow = '';
    div.style.willChange = 'auto';
    const shine = div.querySelector('.shine-effect');
    if (shine) shine.style.left = '-100%';
  };
  
  div.addEventListener('mouseenter', onMouseEnter, { passive: true });
  div.addEventListener('mouseleave', onMouseLeave, { passive: true });
  
  const shineEffect = createShineEffect();
  const iconHtml = createIconHtml(item, iconColor, parentId);
  const textSize = getResponsiveSize(CONFIG.TEXT.MOBILE_SIZE, CONFIG.TEXT.DESKTOP_SIZE);
  const textHtml = `<div class="${textSize} font-semibold text-gray-800 category-text" translate="yes">${item.name}</div>`; // 🆕 translate="yes"
  
  div.innerHTML = shineEffect + iconHtml + textHtml;
  div.addEventListener('click', () => onClickHandler(item.id, item.name), { passive: true });
  
  return div;
}

/**
 * ✅ MÉTHODE AMÉLIORÉE : Force la traduction avec des tentatives multiples et délais optimisés
 */
function forceTranslationWhenReady() {
  const currentLang = localStorage.getItem('ulixai_lang') || 'en';
  
  // Pas besoin de traduire si c'est de l'anglais
  if (currentLang === 'en') {
    console.log('ℹ️ [CategoryPopups] Current language is English, no translation needed');
    return;
  }
  
  console.log('🔄 [CategoryPopups] Starting translation process...');
  
  // 🆕 DÉLAIS AUGMENTÉS pour laisser plus de temps à Google Translate
  // Les catégories principales ont besoin de plus de temps car le popup vient de s'ouvrir
  const delays = [800, 1500, 2500, 3500]; // 4 tentatives avec délais croissants
  
  delays.forEach((delay, index) => {
    setTimeout(() => {
      if (typeof window.forceTranslateDynamicContent === 'function') {
        console.log(`🔄 [CategoryPopups] Translation attempt ${index + 1}/${delays.length} (delay: ${delay}ms)`);
        window.forceTranslateDynamicContent();
        
        if (index === delays.length - 1) {
          console.log('✅ [CategoryPopups] All translation attempts completed');
          
          // 🆕 VÉRIFICATION FINALE : Si toujours pas traduit, log un warning
          setTimeout(() => {
            const categoryCards = document.querySelectorAll('.category-card .category-text');
            if (categoryCards.length > 0) {
              const firstCard = categoryCards[0];
              const isTranslated = firstCard.querySelector('font') !== null || 
                                  firstCard.textContent !== firstCard.getAttribute('data-original-text');
              
              if (!isTranslated) {
                console.warn('⚠️ [CategoryPopups] Categories may not be translated. Debug info:', {
                  currentLang: currentLang,
                  sampleText: firstCard.textContent,
                  hasGoogleFont: firstCard.querySelector('font') !== null,
                  googleComboValue: document.querySelector('.goog-te-combo')?.value
                });
              } else {
                console.log('✅ [CategoryPopups] Categories appear to be translated');
              }
            }
          }, 1000);
        }
      } else {
        console.warn('⚠️ [CategoryPopups] forceTranslateDynamicContent not available');
      }
    }, delay);
  });
}

function renderCategories(items, containerSelector, level, clickHandler, parentId = 'root') {
  const container = document.querySelector(containerSelector);
  if (!container) return;
  
  console.log('🎨 [CategoryPopups] Rendering categories in:', containerSelector);
  
  // 🆕 Nettoyer les marqueurs Google Translate du container
  if (typeof window.cleanGoogleTranslateMarkers === 'function') {
    window.cleanGoogleTranslateMarkers(container);
    console.log('🧹 [CategoryPopups] Cleaned Google Translate markers from container');
  }
  
  // 🆕 S'assurer que le container ET son parent sont marqués pour traduction
  container.setAttribute('translate', 'yes');
  container.classList.remove('notranslate');
  
  if (container.parentElement) {
    container.parentElement.setAttribute('translate', 'yes');
    container.parentElement.classList.remove('notranslate');
  }
  
  const fragment = document.createDocumentFragment();
  container.innerHTML = ''; // Clear complètement le container
  setupResponsiveGrid(container);
  
  const allIds = items.map(item => item.id);
  
  requestAnimationFrame(() => {
    const len = items.length;
    for (let i = 0; i < len; i++) {
      const card = createCategoryCard(items[i], level, allIds, clickHandler, parentId);
      fragment.appendChild(card);
    }
    container.appendChild(fragment);
    
    console.log(`✅ [CategoryPopups] Rendered ${len} categories`);
    
    // 🆕 Log des éléments créés pour debug
    const categoryTexts = container.querySelectorAll('.category-text');
    if (categoryTexts.length > 0) {
      console.log('📝 [CategoryPopups] Sample category texts:', 
        Array.from(categoryTexts).slice(0, 3).map(el => el.textContent)
      );
    }
    
    // 🆕 Forcer la retraduction avec la méthode améliorée
    forceTranslationWhenReady();
  });
}

async function fetchWithCache(url) {
  const cached = cache.get(url);
  if (cached) return cached;
  
  const response = await fetch(url);
  const data = await response.json();
  cache.set(url, data);
  return data;
}

/**
 * ✅ Attendre que Google Translate soit prêt avant toute action
 */
function waitForGoogleTranslateReady(callback, maxWait = 5000) {
  const startTime = Date.now();
  const currentLang = localStorage.getItem('ulixai_lang') || 'en';
  
  // Si c'est de l'anglais, pas besoin d'attendre
  if (currentLang === 'en') {
    callback();
    return;
  }
  
  const checkReady = () => {
    const isReady = window.google?.translate?.TranslateElement && 
                    document.querySelector('.goog-te-combo') &&
                    typeof window.forceTranslateDynamicContent === 'function';
    
    if (isReady) {
      console.log('✅ [CategoryPopups] Google Translate is ready');
      callback();
    } else if (Date.now() - startTime < maxWait) {
      setTimeout(checkReady, 100);
    } else {
      console.warn('⚠️ [CategoryPopups] Google Translate timeout, continuing anyway');
      callback();
    }
  };
  
  checkReady();
}

/**
 * ✅ Attendre que le popup soit complètement visible et rendu
 */
function waitForPopupVisible(popupElement, callback) {
  console.log('🔄 [CategoryPopups] Waiting for popup to be fully visible...');
  
  // Vérifier que le popup est bien visible
  const checkVisible = () => {
    const isVisible = popupElement && 
                     !popupElement.classList.contains('hidden') &&
                     popupElement.offsetHeight > 0;
    
    if (isVisible) {
      console.log('✅ [CategoryPopups] Popup is visible');
      // Attendre encore un peu pour les animations CSS
      setTimeout(callback, 300);
    } else {
      setTimeout(checkVisible, 50);
    }
  };
  
  checkVisible();
}

export function initializeCategoryPopups() {
  
  window.openHelpPopup = function() {
    const popup = document.getElementById(categoryLevels.main.popupId);
    if (!popup) return;
    
    console.log('🎨 [CategoryPopups] Opening help popup...');
    
    // 1️⃣ Ouvrir le popup IMMÉDIATEMENT
    popup.classList.remove('hidden');
    popup.setAttribute('aria-hidden', 'false');
    
    // 2️⃣ Attendre que le popup soit visible ET que Google Translate soit prêt
    waitForPopupVisible(popup, () => {
      console.log('✅ [CategoryPopups] Popup visible, now checking Google Translate...');
      
      waitForGoogleTranslateReady(() => {
        console.log('✅ [CategoryPopups] Google Translate ready, loading categories...');
        
        // 3️⃣ Maintenant on peut charger les catégories
        fetchWithCache(API_ENDPOINTS.CATEGORIES)
          .then(data => {
            if (data.success) {
              renderCategories(
                data.categories,
                `#${categoryLevels.main.popupId} .${categoryLevels.main.containerClass}`,
                'main',
                window.handleCategoryClick,
                'root'
              );
            }
          })
          .catch(err => console.error('Fetch error:', err));
      });
    });
  };
  
  window.handleCategoryClick = function(categoryId, categoryName) {
    const mainPopup = document.getElementById(categoryLevels.main.popupId);
    const subPopup = document.getElementById(categoryLevels.sub.popupId);
    
    if (mainPopup) {
      mainPopup.classList.add('hidden');
      mainPopup.setAttribute('aria-hidden', 'true');
    }
    if (subPopup) {
      subPopup.classList.remove('hidden');
      subPopup.setAttribute('aria-hidden', 'false');
    }
    
    const createRequest = { category: JSON.stringify({ id: categoryId, name: categoryName }) };
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    // ✅ ATTENDRE que Google Translate soit prêt
    waitForGoogleTranslateReady(() => {
      fetchWithCache(API_ENDPOINTS.SUBCATEGORIES(categoryId))
        .then(data => {
          if (data.success) {
            renderCategories(
              data.subcategories,
              `#${categoryLevels.sub.popupId} .${categoryLevels.sub.containerClass}`,
              'sub',
              window.handleSubcategoryClick,
              categoryId
            );
          }
        })
        .catch(err => console.error('Error:', err));
    });
  };
  
  window.handleSubcategoryClick = function(parentId, categoryName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.sub_category = JSON.stringify({ id: parentId, name: categoryName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    // ✅ ATTENDRE que Google Translate soit prêt
    waitForGoogleTranslateReady(() => {
      fetchWithCache(API_ENDPOINTS.CHILDREN(parentId))
        .then(data => {
          if (data.success && data.subcategories.length > 0) {
            const subPopup = document.getElementById(categoryLevels.sub.popupId);
            const childPopup = document.getElementById(categoryLevels.child.popupId);
            
            if (subPopup) {
              subPopup.classList.add('hidden');
              subPopup.setAttribute('aria-hidden', 'true');
            }
            if (childPopup) {
              childPopup.classList.remove('hidden');
              childPopup.setAttribute('aria-hidden', 'false');
            }
            
            renderCategories(
              data.subcategories,
              `#${categoryLevels.child.popupId} .${categoryLevels.child.containerClass}`,
              'child',
              window.requestForHelp,
              parentId
            );
          } else {
            window.requestForHelp(parentId, categoryName);
          }
        })
        .catch(err => console.error('Error:', err));
    });
  };
  
  window.requestForHelp = function(childId, childName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({ id: childId, name: childName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  };
  
  const debouncedResize = debounce(() => {
    Object.values(categoryLevels).forEach(level => {
      const container = document.querySelector(`#${level.popupId} .${level.containerClass}`);
      if (container && !container.classList.contains('hidden')) {
        setupResponsiveGrid(container);
      }
    });
  }, 250);
  
  window.addEventListener('resize', debouncedResize, { passive: true });
}