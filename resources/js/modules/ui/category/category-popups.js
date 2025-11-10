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
    DESKTOP_SIZE: 'w-14 h-14'
  },
  CACHE_DURATION: 300000
};

const cache = new Map();

function isMobile() {
  return window.innerWidth < CONFIG.GRID.BREAKPOINT;
}

function setupGrid(container) {
  const cols = isMobile() ? CONFIG.GRID.MOBILE_COLUMNS : CONFIG.GRID.DESKTOP_COLUMNS;
  container.style.cssText = `display: grid; grid-template-columns: ${cols}; gap: ${CONFIG.GRID.GAP};`;
}

function createCard(item, level, allIds, onClick, parentId = 'root') {
  const card = document.createElement('button');
  card.type = 'button';
  card.className = 'category-card rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-xl cursor-pointer group transition-all duration-300';
  card.setAttribute('translate', 'yes');
  
  const iconColor = getCategoryColorByLevel(level, item.id, allIds);
  const iconSize = isMobile() ? CONFIG.ICONS.MOBILE_SIZE : CONFIG.ICONS.DESKTOP_SIZE;
  const iconSVG = getCategoryIcon(item.name, item.id, parentId);
  
  card.style.cssText = `
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  `;
  
  card.innerHTML = `
    <div class="${iconSize} rounded-full mb-2 flex-shrink-0" style="background-color: ${iconColor}; display: flex; align-items: center; justify-content: center;">
      <div class="w-8 h-8 text-white">${iconSVG}</div>
    </div>
    <div class="text-xs font-semibold text-gray-800" translate="yes">${item.name}</div>
  `;
  
  card.onclick = () => onClick(item.id, item.name);
  return card;
}

function render(items, selector, level, handler, parentId = 'root') {
  const container = document.querySelector(selector);
  if (!container) return;
  
  container.innerHTML = '';
  container.setAttribute('translate', 'yes');
  setupGrid(container);
  
  const fragment = document.createDocumentFragment();
  const allIds = items.map(i => i.id);
  
  items.forEach(item => {
    fragment.appendChild(createCard(item, level, allIds, handler, parentId));
  });
  
  container.appendChild(fragment);
  
  // Forcer traduction immédiatement
  setTimeout(() => {
    if (typeof window.forceTranslateDynamicContent === 'function') {
      window.forceTranslateDynamicContent();
    }
  }, 300);
  
  setTimeout(() => {
    if (typeof window.forceTranslateDynamicContent === 'function') {
      window.forceTranslateDynamicContent();
    }
  }, 800);
}

async function fetchData(url) {
  const cached = cache.get(url);
  if (cached && Date.now() - cached.time < CONFIG.CACHE_DURATION) {
    return cached.data;
  }
  
  const res = await fetch(url);
  const data = await res.json();
  cache.set(url, { data, time: Date.now() });
  return data;
}

export function initializeCategoryPopups() {
  
  window.openHelpPopup = async function() {
    const popup = document.getElementById(categoryLevels.main.popupId);
    const container = popup?.querySelector(`.${categoryLevels.main.containerClass}`);
    if (!popup || !container) return;
    
    // Ouvrir immédiatement
    popup.classList.remove('hidden');
    
    // Loader
    container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
    
    try {
      const data = await fetchData('/api/categories');
      if (data?.success) {
        render(
          data.categories,
          `#${categoryLevels.main.popupId} .${categoryLevels.main.containerClass}`,
          'main',
          window.handleCategoryClick,
          'root'
        );
      }
    } catch (err) {
      container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Erreur</div>';
    }
  };
  
  window.handleCategoryClick = async function(id, name) {
    const mainPopup = document.getElementById(categoryLevels.main.popupId);
    const subPopup = document.getElementById(categoryLevels.sub.popupId);
    const container = subPopup?.querySelector(`.${categoryLevels.sub.containerClass}`);
    
    if (mainPopup) mainPopup.classList.add('hidden');
    if (!subPopup || !container) return;
    
    subPopup.classList.remove('hidden');
    container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
    
    localStorage.setItem('create-request', JSON.stringify({
      category: JSON.stringify({ id, name })
    }));
    
    try {
      const data = await fetchData(`/api/categories/${id}/subcategories`);
      if (data?.success) {
        render(
          data.subcategories,
          `#${categoryLevels.sub.popupId} .${categoryLevels.sub.containerClass}`,
          'sub',
          window.handleSubcategoryClick,
          id
        );
      }
    } catch (err) {
      container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Erreur</div>';
    }
  };
  
  window.handleSubcategoryClick = async function(id, name) {
    const req = JSON.parse(localStorage.getItem('create-request') || '{}');
    req.sub_category = JSON.stringify({ id, name });
    localStorage.setItem('create-request', JSON.stringify(req));
    
    try {
      const data = await fetchData(`/api/categories/${id}/children`);
      
      if (data?.success && data.subcategories?.length > 0) {
        const subPopup = document.getElementById(categoryLevels.sub.popupId);
        const childPopup = document.getElementById(categoryLevels.child.popupId);
        const container = childPopup?.querySelector(`.${categoryLevels.child.containerClass}`);
        
        if (subPopup) subPopup.classList.add('hidden');
        if (!childPopup || !container) return;
        
        childPopup.classList.remove('hidden');
        container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
        
        render(
          data.subcategories,
          `#${categoryLevels.child.popupId} .${categoryLevels.child.containerClass}`,
          'child',
          window.requestForHelp,
          id
        );
      } else {
        window.requestForHelp(id, name);
      }
    } catch (err) {
      window.requestForHelp(id, name);
    }
  };
  
  window.requestForHelp = function(id, name) {
    const req = JSON.parse(localStorage.getItem('create-request') || '{}');
    req.child_category = JSON.stringify({ id, name });
    localStorage.setItem('create-request', JSON.stringify(req));
    window.location.href = '/create-request';
  };
  
  window.addEventListener('resize', () => {
    Object.values(categoryLevels).forEach(level => {
      const container = document.querySelector(`#${level.popupId} .${level.containerClass}`);
      if (container && !document.getElementById(level.popupId)?.classList.contains('hidden')) {
        setupGrid(container);
      }
    });
  }, { passive: true });
}