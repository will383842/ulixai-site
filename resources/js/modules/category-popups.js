import { categoryColors, getCategoryColor, categoryLevels } from './categoryColors.js';

// Configuration
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
    DEFAULT_TRANSFORM: 'translateY(0) scale(1)',
    TRANSITION: '0.5s'
  },
  CACHE: {
    ENABLED: true,
    DURATION: 5 * 60 * 1000 // 5 minutes
  }
};

const API_ENDPOINTS = {
  CATEGORIES: '/api/categories',
  SUBCATEGORIES: (id) => `/api/categories/${id}/subcategories`,
  CHILDREN: (id) => `/api/categories/${id}/children`
};

// Cache system
const cache = {
  data: new Map(),
  
  get(key) {
    if (!CONFIG.CACHE.ENABLED) return null;
    const cached = this.data.get(key);
    if (!cached) return null;
    const now = Date.now();
    if (now - cached.timestamp > CONFIG.CACHE.DURATION) {
      this.data.delete(key);
      return null;
    }
    return cached.value;
  },
  
  set(key, value) {
    if (!CONFIG.CACHE.ENABLED) return;
    this.data.set(key, { value, timestamp: Date.now() });
  },
  
  clear() {
    this.data.clear();
  }
};

// Utility functions
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
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
  return '<div class="shine-effect"></div>';
}

function preloadImage(src) {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve(src);
    img.onerror = reject;
    img.src = src;
  });
}

function createIconHtml(item, iconColor) {
  const iconSize = getResponsiveSize(CONFIG.ICONS.MOBILE_SIZE, CONFIG.ICONS.DESKTOP_SIZE);
  
  if (item.icon_image) {
    const imagePath = item.icon_image.startsWith('/') ? item.icon_image : '/' + item.icon_image;
    preloadImage(imagePath).catch(() => {});
    
    return `<div class="${iconSize} rounded-full mb-2 group-hover:scale-110 transition-transform flex-shrink-0" style="background-color: ${iconColor}; padding: ${CONFIG.ICONS.PADDING}; display: flex; align-items: center; justify-content: center; overflow: hidden;">` +
           `<img src="${imagePath}" alt="${item.name}" class="w-full h-full object-contain rounded-full" loading="lazy">` +
           '</div>';
  } else {
    return `<div class="${iconSize} rounded-full mb-2 group-hover:scale-110 transition-transform flex-shrink-0" style="background-color: ${iconColor}; display: flex; align-items: center; justify-content: center;">` +
           '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' +
           '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
           '</svg></div>';
  }
}

function createCategoryCard(item, index, level, onClickHandler) {
  const div = document.createElement('div');
  div.className = "category-card rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-xl cursor-pointer group transition-all duration-300";
  
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
  
  const iconColor = getCategoryColor(level, index);
  const shadowColor = categoryLevels[level]?.shadowColor || 'rgba(59, 130, 246, 0.15)';
  
  div.onmouseenter = function() {
    this.style.willChange = 'transform, box-shadow';
    this.style.transform = CONFIG.ANIMATION.HOVER_TRANSFORM;
    this.style.boxShadow = `0 20px 40px ${shadowColor}`;
    const shine = this.querySelector('.shine-effect');
    if (shine) shine.style.left = '100%';
  };
  
  div.onmouseleave = function() {
    this.style.transform = CONFIG.ANIMATION.DEFAULT_TRANSFORM;
    this.style.boxShadow = '';
    this.style.willChange = 'auto';
    const shine = this.querySelector('.shine-effect');
    if (shine) shine.style.left = '-100%';
  };
  
  const shineEffect = createShineEffect();
  const iconHtml = createIconHtml(item, iconColor);
  const textSize = getResponsiveSize(CONFIG.TEXT.MOBILE_SIZE, CONFIG.TEXT.DESKTOP_SIZE);
  const textHtml = `<div class="${textSize} font-semibold text-gray-800 category-text">${item.name}</div>`;
  
  div.innerHTML = shineEffect + iconHtml + textHtml;
  div.onclick = function() {
    onClickHandler(item.id, item.name);
  };
  
  return div;
}

function renderCategories(items, containerSelector, level, clickHandler) {
  const container = document.querySelector(containerSelector);
  if (!container) {
    console.error('Container not found:', containerSelector);
    return;
  }
  
  const fragment = document.createDocumentFragment();
  container.innerHTML = '';
  setupResponsiveGrid(container);
  
  requestAnimationFrame(() => {
    items.forEach((item, index) => {
      const card = createCategoryCard(item, index, level, clickHandler);
      fragment.appendChild(card);
    });
    container.appendChild(fragment);
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

// Module initialization
export function initializeCategoryPopups() {
  
  // Open popup
  window.openHelpPopup = function() {
    const popup = document.getElementById(categoryLevels.main.popupId);
    if (!popup) return;
    
    popup.classList.remove('hidden');
    
    fetchWithCache(API_ENDPOINTS.CATEGORIES)
      .then(data => {
        if (data.success) {
          renderCategories(
            data.categories,
            `#${categoryLevels.main.popupId} .${categoryLevels.main.containerClass}`,
            'main',
            window.handleCategoryClick
          );
        }
      })
      .catch(err => console.error('Fetch error:', err));
  };
  
  // Category click
  window.handleCategoryClick = function(categoryId, categoryName) {
    document.getElementById(categoryLevels.main.popupId)?.classList.add('hidden');
    document.getElementById(categoryLevels.sub.popupId)?.classList.remove('hidden');
    
    const createRequest = { category: JSON.stringify({ id: categoryId, name: categoryName }) };
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    fetchWithCache(API_ENDPOINTS.SUBCATEGORIES(categoryId))
      .then(data => {
        if (data.success) {
          renderCategories(
            data.subcategories,
            `#${categoryLevels.sub.popupId} .${categoryLevels.sub.containerClass}`,
            'sub',
            window.handleSubcategoryClick
          );
        }
      })
      .catch(err => console.error('Error:', err));
  };
  
  // Subcategory click
  window.handleSubcategoryClick = function(parentId, categoryName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.sub_category = JSON.stringify({ id: parentId, name: categoryName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    fetchWithCache(API_ENDPOINTS.CHILDREN(parentId))
      .then(data => {
        if (data.success && data.subcategories.length > 0) {
          document.getElementById(categoryLevels.sub.popupId)?.classList.add('hidden');
          document.getElementById(categoryLevels.child.popupId)?.classList.remove('hidden');
          
          renderCategories(
            data.subcategories,
            `#${categoryLevels.child.popupId} .${categoryLevels.child.containerClass}`,
            'child',
            window.requestForHelp
          );
        } else {
          window.requestForHelp(parentId, categoryName);
        }
      })
      .catch(err => console.error('Error:', err));
  };
  
  // Final redirect
  window.requestForHelp = function(childId, childName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({ id: childId, name: childName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  };
  
  // Debounced resize
  const debouncedResize = debounce(function() {
    Object.values(categoryLevels).forEach(level => {
      const container = document.querySelector(`#${level.popupId} .${level.containerClass}`);
      if (container && !container.classList.contains('hidden')) {
        setupResponsiveGrid(container);
      }
    });
  }, 250);
  
  window.addEventListener('resize', debouncedResize);
}