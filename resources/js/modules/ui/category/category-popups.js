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
  
  // ✅ IMPORTANT : Attribut translate="yes" pour Google Translate
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
  if (!container) {
    console.warn(`❌ Container not found: ${selector}`);
    return;
  }
  
  console.log(`🎨 Rendering ${items.length} items in ${selector}`);
  
  container.innerHTML = '';
  container.setAttribute('translate', 'yes');
  setupGrid(container);
  
  const fragment = document.createDocumentFragment();
  const allIds = items.map(i => i.id);
  
  items.forEach(item => {
    fragment.appendChild(createCard(item, level, allIds, handler, parentId));
  });
  
  container.appendChild(fragment);
  
  // ✅ ENLEVÉ : Plus d'appels à forceTranslateDynamicContent()
  // Google Translate va automatiquement détecter et traduire les éléments
  // avec translate="yes"
  
  console.log(`✅ Rendered ${items.length} categories`);
}

async function fetchData(url) {
  const cached = cache.get(url);
  if (cached && Date.now() - cached.time < CONFIG.CACHE_DURATION) {
    console.log(`📦 Using cached data for ${url}`);
    return cached.data;
  }
  
  console.log(`🌐 Fetching data from ${url}`);
  const res = await fetch(url);
  const data = await res.json();
  cache.set(url, { data, time: Date.now() });
  return data;
}

export function initializeCategoryPopups() {
  console.log('🚀 Initializing category popups...');
  
  window.openHelpPopup = async function() {
    const popup = document.getElementById(categoryLevels.main.popupId);
    const container = popup?.querySelector(`.${categoryLevels.main.containerClass}`);
    
    if (!popup || !container) {
      console.error('❌ Popup or container not found');
      return;
    }
    
    console.log('📂 Opening main categories popup');
    
    // Ouvrir immédiatement
    popup.classList.remove('hidden');
    
    // Loader
    container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
    
    try {
      const data = await fetchData('/api/categories');
      if (data?.success) {
        console.log(`✅ Loaded ${data.categories.length} main categories`);
        render(
          data.categories,
          `#${categoryLevels.main.popupId} .${categoryLevels.main.containerClass}`,
          'main',
          window.handleCategoryClick,
          'root'
        );
      } else {
        throw new Error('Invalid API response');
      }
    } catch (err) {
      console.error('❌ Error loading categories:', err);
      container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Error loading categories</div>';
    }
  };
  
  window.handleCategoryClick = async function(id, name) {
    const mainPopup = document.getElementById(categoryLevels.main.popupId);
    const subPopup = document.getElementById(categoryLevels.sub.popupId);
    const container = subPopup?.querySelector(`.${categoryLevels.sub.containerClass}`);
    
    if (mainPopup) mainPopup.classList.add('hidden');
    if (!subPopup || !container) return;
    
    console.log(`📂 Opening subcategories for: ${name} (${id})`);
    
    subPopup.classList.remove('hidden');
    container.innerHTML = '<div style="text-align:center;padding:3rem;"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div></div>';
    
    localStorage.setItem('create-request', JSON.stringify({
      category: JSON.stringify({ id, name })
    }));
    
    try {
      const data = await fetchData(`/api/categories/${id}/subcategories`);
      if (data?.success) {
        console.log(`✅ Loaded ${data.subcategories.length} subcategories`);
        render(
          data.subcategories,
          `#${categoryLevels.sub.popupId} .${categoryLevels.sub.containerClass}`,
          'sub',
          window.handleSubcategoryClick,
          id
        );
      }
    } catch (err) {
      console.error('❌ Error loading subcategories:', err);
      container.innerHTML = '<div style="text-align:center;padding:2rem;color:red;">Error loading subcategories</div>';
    }
  };
  
  window.handleSubcategoryClick = async function(id, name) {
    const req = JSON.parse(localStorage.getItem('create-request') || '{}');
    req.sub_category = JSON.stringify({ id, name });
    localStorage.setItem('create-request', JSON.stringify(req));
    
    console.log(`📂 Checking for child categories: ${name} (${id})`);
    
    try {
      const data = await fetchData(`/api/categories/${id}/children`);
      
      if (data?.success && data.subcategories?.length > 0) {
        console.log(`✅ Found ${data.subcategories.length} child categories`);
        
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
        console.log('ℹ️ No child categories, redirecting to request form');
        window.requestForHelp(id, name);
      }
    } catch (err) {
      console.error('❌ Error loading child categories:', err);
      window.requestForHelp(id, name);
    }
  };
  
  window.requestForHelp = function(id, name) {
    console.log(`✅ Final selection: ${name} (${id})`);
    
    const req = JSON.parse(localStorage.getItem('create-request') || '{}');
    req.child_category = JSON.stringify({ id, name });
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
    
    window.closeAllPopups = function() {
      console.log('❌ [CategoryPopups] Closing all category popups (fallback)');
      
      // Fermer tous les popups de catégories
      Object.values(categoryLevels).forEach(level => {
        const popup = document.getElementById(level.popupId);
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
    
    window.closeSearchPopup = function() {
      console.log('❌ [CategoryPopups] Closing main search popup (fallback)');
      
      const popup = document.getElementById(categoryLevels.main.popupId);
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
  window.addEventListener('resize', () => {
    Object.values(categoryLevels).forEach(level => {
      const container = document.querySelector(`#${level.popupId} .${level.containerClass}`);
      if (container && !document.getElementById(level.popupId)?.classList.contains('hidden')) {
        setupGrid(container);
      }
    });
  }, { passive: true });
  
  console.log('✅ Category popups initialized');
}