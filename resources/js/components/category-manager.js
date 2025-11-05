/**
 * Category Manager - Gestion des catégories/sous-catégories avec bulles colorées
 * Gère les popups de sélection de services (Request Help)
 */

export class CategoryManager {
  constructor() {
    this.selectedCategory = null;
    this.selectedSubcategory = null;
    this.selectedChild = null;
  }

  /**
   * Initialize category manager
   */
  init() {
    // Make functions available globally for backward compatibility
    window.openHelpPopup = () => this.openHelpPopup();
    window.handleCategoryClick = (id, name) => this.handleCategoryClick(id, name);
    window.handleSubcategoryClick = (id, name) => this.handleSubcategoryClick(id, name);
    window.requestForHelp = (id, name) => this.requestForHelp(id, name);
    window.closeSearchPopup = () => this.closeSearchPopup();
    window.closeAllPopups = () => this.closeAllPopups();
    window.goBackToVacanciersSubcategories = () => this.goBackToVacanciersSubcategories();
    
    // Setup close on outside click
    this.setupOutsideClickListener();
  }

  /**
   * Open main help popup and load categories
   */
  openHelpPopup() {
    const popup = document.getElementById('searchPopup');
    if (!popup) {
      console.warn('Search popup not found');
      return;
    }

    popup.classList.remove('hidden');
    
    // Load categories from API
    fetch('/api/categories')
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.renderCategories(data.categories);
        }
      })
      .catch(err => {
        console.error('Failed to load categories:', err);
        this.showError('Unable to load categories. Please try again.');
      });
  }

  /**
   * Render main categories with colored bubbles
   * @param {Array} categories - Array of category objects
   */
  renderCategories(categories) {
    const container = document.querySelector('#searchPopup .main-categories');
    if (!container) return;

    container.innerHTML = '';

    categories.forEach(cat => {
      const card = this.createCategoryCard(cat);
      card.addEventListener('click', () => this.handleCategoryClick(cat.id, cat.name));
      container.appendChild(card);
    });
  }

  /**
   * Create category card element with colored bubble
   * @param {Object} category - Category object
   * @returns {HTMLElement}
   */
  createCategoryCard(category) {
    const div = document.createElement('div');
    div.className = "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group transition-all duration-300";

    // Apply background color
    const bgColor = this.validateColor(category.bg_color) || '#ffffff';
    div.style.setProperty('background-color', bgColor, 'important');

    // Create icon (image or default SVG)
    const iconHtml = category.icon_image
      ? this.createImageIcon(category.icon_image, category.name)
      : this.createDefaultIcon();

    // Create title
    const title = document.createElement('h3');
    title.className = 'text-sm font-semibold text-gray-800';
    title.textContent = category.name;

    div.innerHTML = iconHtml;
    div.appendChild(title);

    return div;
  }

  /**
   * Create subcategory card element with colored bubble
   * @param {Object} subcategory - Subcategory object
   * @returns {HTMLElement}
   */
  createSubcategoryCard(subcategory) {
    const div = document.createElement('div');
    div.className = "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group transition-all duration-300";

    // Apply background color
    const bgColor = this.validateColor(subcategory.bg_color) || '#ffffff';
    div.style.setProperty('background-color', bgColor, 'important');

    // Create icon
    const iconHtml = subcategory.icon_image
      ? this.createImageIcon(subcategory.icon_image, subcategory.name, 'mr-4')
      : this.createDefaultIcon('mr-4');

    // Create content
    const content = document.createElement('div');
    content.className = 'flex-grow font-semibold text-gray-800';
    content.textContent = subcategory.name;

    // Create arrow
    const arrow = this.createArrow();

    div.innerHTML = iconHtml;
    div.appendChild(content);
    div.appendChild(arrow);

    return div;
  }

  /**
   * Create image icon HTML
   * @param {string} imagePath - Path to image
   * @param {string} alt - Alt text
   * @param {string} extraClass - Extra CSS classes
   * @returns {string}
   */
  createImageIcon(imagePath, alt = '', extraClass = '') {
    // Ensure path starts with /
    const path = imagePath.startsWith('/') ? imagePath : `/${imagePath}`;
    
    return `
      <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full overflow-hidden ${extraClass} group-hover:scale-110 transition-transform bg-gray-100 flex-shrink-0">
        <img src="${path}" alt="${this.escapeHtml(alt)}" class="w-full h-full object-cover rounded-full" loading="lazy" onerror="this.parentElement.innerHTML='${this.createDefaultIcon(extraClass)}'">
      </div>
    `;
  }

  /**
   * Create default icon HTML (fallback)
   * @param {string} extraClass - Extra CSS classes
   * @returns {string}
   */
  createDefaultIcon(extraClass = '') {
    return `
      <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-500 rounded-full flex items-center justify-center ${extraClass} group-hover:scale-110 transition-transform flex-shrink-0">
        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
        </svg>
      </div>
    `;
  }

  /**
   * Create arrow icon
   * @returns {HTMLElement}
   */
  createArrow() {
    const arrow = document.createElement('div');
    arrow.className = 'text-gray-400 group-hover:text-gray-600 transition-colors flex-shrink-0';
    arrow.innerHTML = `
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <polyline points="9,18 15,12 9,6"></polyline>
      </svg>
    `;
    return arrow;
  }

  /**
   * Validate and sanitize color value
   * @param {string} color - Color value
   * @returns {string|null}
   */
  validateColor(color) {
    if (typeof color !== 'string' || !color.trim()) {
      return null;
    }

    const trimmed = color.trim();
    
    // Valid hex color
    if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(trimmed)) {
      return trimmed;
    }

    // Valid rgb/rgba
    if (/^rgba?\([\d\s,./]+\)$/.test(trimmed)) {
      return trimmed;
    }

    // Valid named color (basic validation)
    if (/^[a-z]+$/i.test(trimmed)) {
      return trimmed;
    }

    return null;
  }

  /**
   * Escape HTML to prevent XSS
   * @param {string} text - Text to escape
   * @returns {string}
   */
  escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  /**
   * Handle category click - Load subcategories
   * @param {number} categoryId - Category ID
   * @param {string} categoryName - Category name
   */
  handleCategoryClick(categoryId, categoryName) {
    // Hide main popup
    const mainPopup = document.getElementById('searchPopup');
    if (mainPopup) mainPopup.classList.add('hidden');

    // Store selection
    this.selectedCategory = { id: categoryId, name: categoryName };
    this.saveToLocalStorage('category', this.selectedCategory);

    // Show subcategories popup
    const subPopup = document.getElementById('expatriesPopup');
    if (subPopup) subPopup.classList.remove('hidden');

    // Load subcategories
    fetch(`/api/categories/${categoryId}/subcategories`)
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.renderSubcategories(data.subcategories);
        }
      })
      .catch(err => {
        console.error('Error fetching subcategories:', err);
        this.showError('Unable to load subcategories. Please try again.');
      });
  }

  /**
   * Render subcategories
   * @param {Array} subcategories - Array of subcategory objects
   */
  renderSubcategories(subcategories) {
    const container = document.querySelector('#expatriesPopup .sub-category');
    if (!container) return;

    container.innerHTML = '';

    subcategories.forEach(sub => {
      const card = this.createSubcategoryCard(sub);
      card.addEventListener('click', () => this.handleSubcategoryClick(sub.id, sub.name));
      container.appendChild(card);
    });
  }

  /**
   * Handle subcategory click - Load child categories
   * @param {number} parentId - Subcategory ID
   * @param {string} categoryName - Subcategory name
   */
  handleSubcategoryClick(parentId, categoryName) {
    // Store selection
    this.selectedSubcategory = { id: parentId, name: categoryName };
    this.saveToLocalStorage('sub_category', this.selectedSubcategory);

    // Load child categories
    fetch(`/api/categories/${parentId}/children`)
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.renderChildCategories(data.subcategories);
          
          // Show child categories popup
          const childPopup = document.getElementById('vacanciersAutresBesoinsPopup');
          if (childPopup) childPopup.classList.remove('hidden');
        }
      })
      .catch(err => {
        console.error('Error loading child categories:', err);
        this.showError('Unable to load options. Please try again.');
      });
  }

  /**
   * Render child categories
   * @param {Array} children - Array of child category objects
   */
  renderChildCategories(children) {
    const container = document.querySelector('#vacanciersAutresBesoinsPopup .child-categories');
    if (!container) return;

    container.innerHTML = '';

    children.forEach(child => {
      const card = this.createSubcategoryCard(child);
      card.addEventListener('click', () => this.requestForHelp(child.id, child.name));
      container.appendChild(card);
    });
  }

  /**
   * Final selection - Navigate to create request
   * @param {number} childId - Child category ID
   * @param {string} childName - Child category name
   */
  requestForHelp(childId, childName) {
    // Store final selection
    this.selectedChild = { id: childId, name: childName };
    this.saveToLocalStorage('child_category', this.selectedChild);

    // Navigate to create request page
    window.location.href = '/create-request';
  }

  /**
   * Save selection to localStorage
   * @param {string} key - Storage key
   * @param {Object} value - Value to store
   */
  saveToLocalStorage(key, value) {
    try {
      const createRequest = JSON.parse(localStorage.getItem('create-request') || '{}');
      createRequest[key] = JSON.stringify(value);
      localStorage.setItem('create-request', JSON.stringify(createRequest));
    } catch (e) {
      console.warn('Failed to save to localStorage:', e);
    }
  }

  /**
   * Close search popup
   */
  closeSearchPopup() {
    const popup = document.getElementById('searchPopup');
    if (popup) popup.classList.add('hidden');
  }

  /**
   * Close all popups and clear selection
   */
  closeAllPopups() {
    const popupIds = [
      'searchPopup',
      'expatriesPopup',
      'vacanciersPopup',
      'vacanciersPreparationPopup',
      'vacanciersUrgencePopup',
      'vacanciersProblemesVoyagesPopup',
      'expatriesUrgencePopup',
      'expatriesPreparationPopup',
      'expatriesAssurancePopup',
      'expatriesBesoinsPopup',
      'expatriesSantePopup',
      'vacanciersAutresBesoinsPopup',
      'investisseursPopup',
      'investisseurBienImmobilierPopup',
      'investirMarchesFinanciersPopup',
      'investisseurSecuriserInvestissementsPopup',
      'investisseurOptimisationFiscalePopup',
      'investisseurObligationsLegalesPopup',
      'travailleursFreelancesPopup',
      'travailleursCreerEntreprisePopup',
      'travailleursDevelopperReseauPopup',
      'travailleursGestionFinancierePopup',
      'travailleursProtectionSocialePopup',
      'travailleursTrouverEmploiPopup',
      'travailleursVisaAutorisationsPopup'
    ];

    popupIds.forEach(id => {
      const popup = document.getElementById(id);
      if (popup) popup.classList.add('hidden');
    });

    // Clear localStorage
    localStorage.removeItem('create-request');
  }

  /**
   * Go back to subcategories from child categories
   */
  goBackToVacanciersSubcategories() {
    const childPopup = document.getElementById('vacanciersAutresBesoinsPopup');
    if (childPopup) childPopup.classList.add('hidden');

    const subPopup = document.getElementById('expatriesPopup');
    if (subPopup) subPopup.classList.remove('hidden');
  }

  /**
   * Setup click outside listener to close popups
   */
  setupOutsideClickListener() {
    document.addEventListener('click', (event) => {
      const popups = [
        document.getElementById('searchPopup'),
        document.getElementById('expatriesPopup'),
        document.getElementById('vacanciersPopup')
      ].filter(Boolean);

      const searchInput = document.getElementById('searchInput');
      const searchButton = document.getElementById('searchButton');

      const isAnyPopupVisible = popups.some(popup => 
        popup && !popup.classList.contains('hidden')
      );

      if (isAnyPopupVisible) {
        const clickedInsidePopup = popups.some(popup => popup.contains(event.target));
        const clickedSearchElements = 
          (searchInput && searchInput.contains(event.target)) ||
          (searchButton && searchButton.contains(event.target));

        if (!clickedInsidePopup && !clickedSearchElements) {
          this.closeAllPopups();
        }
      }
    });
  }

  /**
   * Show error message to user
   * @param {string} message - Error message
   */
  showError(message) {
    if (typeof toastr !== 'undefined') {
      toastr.error(message, 'Error');
    } else {
      alert(message);
    }
  }
}