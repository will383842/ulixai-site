import { categoryColors } from './categoryColors.js';

export function initializeCategoryPopups() {
  console.log('🎯 Category popups: START');
  
  // ========================================
  // FONCTION PRINCIPALE : OUVRIR LE POPUP
  // ========================================
  window.openHelpPopup = function() {
    console.log('✅ openHelpPopup CALLED');
    const popup = document.getElementById('searchPopup');
    if (!popup) {
      console.error('❌ searchPopup not found');
      return;
    }
    
    popup.classList.remove('hidden');
    console.log('✅ Popup is now visible');
    
    fetch('/api/categories')
      .then(res => res.json())
      .then(data => {
        console.log('Categories data:', data);
        if (data.success) {
          const container = document.querySelector('#searchPopup .main-categories');
          if (!container) {
            console.error('❌ .main-categories not found');
            return;
          }
          
          container.innerHTML = '';
          // Ajout du style pour la grille 2 colonnes
          container.style.cssText = 'display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;';
          console.log('✅ Building categories...');
          
          data.categories.forEach((cat, index) => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";
            div.style.backgroundColor = '#ffffff';
            
            // Padding adaptatif
            if (window.innerWidth >= 768) {
              div.style.padding = '2rem';
            }
            
            // Icône avec couleur de bulle
            let iconHtml = '';
            const iconSize = window.innerWidth >= 768 ? 'w-20 h-20' : 'w-16 h-16';
            const iconColor = categoryColors.main[index % categoryColors.main.length];
            
            if (cat.icon_image) {
              iconHtml = `<div class="${iconSize} rounded-full overflow-hidden mb-3 group-hover:scale-110 transition-transform" style="background-color: ${iconColor}; padding: 0.5rem;">` +
                         '<img src="/' + cat.icon_image + '" alt="' + cat.name + '" class="w-full h-full object-contain rounded-full">' +
                         '</div>';
            } else {
              iconHtml = `<div class="${iconSize} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform" style="background-color: ${iconColor};">` +
                         '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            const textSize = window.innerWidth >= 768 ? 'text-base' : 'text-sm';
            div.innerHTML = iconHtml + `<h3 class="${textSize} font-semibold text-gray-800">` + cat.name + '</h3>';
            
            div.onclick = function() {
              window.handleCategoryClick(cat.id, cat.name);
            };
            
            container.appendChild(div);
          });
          
          console.log('✅ Categories rendered');
        }
      })
      .catch(err => console.error('❌ Fetch error:', err));
  };
  
  // ========================================
  // CLIC SUR CATÉGORIE → SOUS-CATÉGORIES
  // ========================================
  window.handleCategoryClick = function(categoryId, categoryName) {
    console.log('Category clicked:', categoryId, categoryName);
    
    document.getElementById('searchPopup')?.classList.add('hidden');
    document.getElementById('expatriesPopup')?.classList.remove('hidden');
    
    const createRequest = { category: JSON.stringify({ id: categoryId, name: categoryName }) };
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    fetch('/api/categories/' + categoryId + '/subcategories')
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const subContainer = document.querySelector('#expatriesPopup .sub-category');
          if (!subContainer) {
            console.error('❌ .sub-category not found');
            return;
          }
          
          subContainer.innerHTML = '';
          // Ajout du style pour la grille 2 colonnes
          subContainer.style.cssText = 'display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;';
          
          data.subcategories.forEach((sub, index) => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";
            div.style.backgroundColor = '#ffffff';
            
            // Padding adaptatif
            if (window.innerWidth >= 768) {
              div.style.padding = '2rem';
            }
            
            // Icône avec couleur de bulle
            let iconHtml = '';
            const iconSize = window.innerWidth >= 768 ? 'w-20 h-20' : 'w-16 h-16';
            const iconColor = categoryColors.sub[index % categoryColors.sub.length];
            
            if (sub.icon_image) {
              iconHtml = `<div class="${iconSize} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform overflow-hidden" style="background-color: ${iconColor}; padding: 0.5rem;">` +
                         '<img src="' + sub.icon_image + '" alt="" class="w-full h-full object-contain rounded-full">' +
                         '</div>';
            } else {
              iconHtml = `<div class="${iconSize} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform" style="background-color: ${iconColor};">` +
                         '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            const textSize = window.innerWidth >= 768 ? 'text-base' : 'text-sm';
            div.innerHTML = iconHtml + `<div class="${textSize} font-semibold text-gray-800">` + sub.name + '</div>';
            
            div.onclick = function() {
              window.handleSubcategoryClick(sub.id, sub.name);
            };
            
            subContainer.appendChild(div);
          });
          
          console.log('✅ Subcategories rendered');
        }
      })
      .catch(err => console.error('❌ Error:', err));
  };
  
  // ========================================
  // CLIC SUR SOUS-CATÉGORIE → ENFANTS
  // ========================================
  window.handleSubcategoryClick = function(parentId, categoryName) {
    console.log('Subcategory clicked:', parentId, categoryName);
    
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.sub_category = JSON.stringify({ id: parentId, name: categoryName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    
    fetch('/api/categories/' + parentId + '/children')
      .then(res => res.json())
      .then(data => {
        if (data.success && data.subcategories.length > 0) {
          // Il y a des sous-sous-catégories
          document.getElementById('expatriesPopup')?.classList.add('hidden');
          document.getElementById('vacanciersAutresBesoinsPopup')?.classList.remove('hidden');
          
          const childContainer = document.querySelector('#vacanciersAutresBesoinsPopup .child-categories');
          if (!childContainer) {
            console.error('❌ .child-categories not found');
            return;
          }
          
          childContainer.innerHTML = '';
          // Ajout du style pour la grille 2 colonnes
          childContainer.style.cssText = 'display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;';
          
          data.subcategories.forEach((child, index) => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";
            div.style.backgroundColor = '#ffffff';
            
            // Padding adaptatif
            if (window.innerWidth >= 768) {
              div.style.padding = '2rem';
            }
            
            // Icône avec couleur de bulle
            let iconHtml = '';
            const iconSize = window.innerWidth >= 768 ? 'w-20 h-20' : 'w-16 h-16';
            const iconColor = categoryColors.child[index % categoryColors.child.length];
            
            if (child.icon_image) {
              iconHtml = `<div class="${iconSize} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform overflow-hidden" style="background-color: ${iconColor}; padding: 0.5rem;">` +
                         '<img src="' + child.icon_image + '" alt="" class="w-full h-full object-contain rounded-full">' +
                         '</div>';
            } else {
              iconHtml = `<div class="${iconSize} rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform" style="background-color: ${iconColor};">` +
                         '<svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            const textSize = window.innerWidth >= 768 ? 'text-base' : 'text-sm';
            div.innerHTML = iconHtml + `<div class="${textSize} font-semibold text-gray-800">` + child.name + '</div>';
            
            div.onclick = function() {
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
      })
      .catch(err => console.error('❌ Error:', err));
  };
  
  // ========================================
  // REDIRECTION FINALE
  // ========================================
  window.requestForHelp = function(childId, childName) {
    console.log('Request help:', childId, childName);
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({ id: childId, name: childName });
    localStorage.setItem('create-request', JSON.stringify(createRequest));
    window.location.href = '/create-request';
  };
  
  // ========================================
  // FONCTIONS UTILITAIRES
  // ========================================
  window.closeSearchPopup = function() {
    document.getElementById('searchPopup')?.classList.add('hidden');
  };
  
  window.closeAllPopups = function() {
    ['searchPopup', 'expatriesPopup', 'vacanciersPopup', 'vacanciersAutresBesoinsPopup'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.classList.add('hidden');
    });
    localStorage.removeItem('create-request');
  };
  
  window.goBackToVacanciersSubcategories = function() {
    document.getElementById('vacanciersAutresBesoinsPopup')?.classList.add('hidden');
    document.getElementById('expatriesPopup')?.classList.remove('hidden');
  };
  
  console.log('✅ Category popups: READY');
}