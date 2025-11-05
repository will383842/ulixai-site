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
          console.log('✅ Building categories...');
          
          data.categories.forEach(cat => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";
            
            // Couleur de fond
            const color = cat.bg_color || '#ffffff';
            div.style.setProperty('background-color', color, 'important');
            
            // Icône avec image
            let iconHtml = '';
            if (cat.icon_image) {
              iconHtml = '<div class="w-12 h-12 rounded-full overflow-hidden mb-2 group-hover:scale-110 transition-transform bg-gray-100">' +
                         '<img src="/' + cat.icon_image + '" alt="' + cat.name + '" class="w-full h-full object-cover rounded-full">' +
                         '</div>';
            } else {
              iconHtml = '<div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">' +
                         '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            div.innerHTML = iconHtml + '<h3 class="text-sm font-semibold text-gray-800">' + cat.name + '</h3>';
            
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
          
          data.subcategories.forEach(sub => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";
            
            // Couleur de fond
            const color = sub.bg_color || '#ffffff';
            div.style.setProperty('background-color', color, 'important');
            
            // Icône avec image
            let iconHtml = '';
            if (sub.icon_image) {
              iconHtml = '<div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">' +
                         '<img src="' + sub.icon_image + '" alt="" class="w-full h-full object-cover rounded-full">' +
                         '</div>';
            } else {
              iconHtml = '<div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">' +
                         '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            div.innerHTML = iconHtml +
                           '<div class="flex-grow font-semibold text-gray-800">' + sub.name + '</div>' +
                           '<div class="text-gray-400 group-hover:text-gray-600 transition-colors">' +
                           '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                           '<polyline points="9,18 15,12 9,6"></polyline>' +
                           '</svg></div>';
            
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
          
          data.subcategories.forEach(child => {
            const div = document.createElement('div');
            div.className = "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";
            
            // Couleur de fond
            const color = child.bg_color || '#ffffff';
            div.style.setProperty('background-color', color, 'important');
            
            // Icône avec image
            let iconHtml = '';
            if (child.icon_image) {
              iconHtml = '<div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">' +
                         '<img src="' + child.icon_image + '" alt="" class="w-full h-full object-cover rounded-full">' +
                         '</div>';
            } else {
              iconHtml = '<div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">' +
                         '<svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">' +
                         '<path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>' +
                         '</svg></div>';
            }
            
            div.innerHTML = iconHtml +
                           '<div class="flex-grow font-semibold text-gray-800">' + child.name + '</div>' +
                           '<div class="text-gray-400 group-hover:text-gray-600 transition-colors">' +
                           '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">' +
                           '<polyline points="9,18 15,12 9,6"></polyline>' +
                           '</svg></div>';
            
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