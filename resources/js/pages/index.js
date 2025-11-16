/**
 * ============================================
 * PAGE INDEX - SCRIPTS SPÉCIFIQUES
 * ============================================
 */

// Initialize AOS
AOS.init({
  duration: 600,
  once: true,
  offset: 50,
  easing: 'ease-out'
});

// Store original providers for reset
let originalProvidersHTML = document.getElementById('serviceGrid').innerHTML;
let aiPopupTimer = null;

/**
 * AI Popup Functions
 */
window.openAIPopup = function() {
  const popup = document.getElementById('aiPopup');
  const overlay = document.getElementById('aiPopupOverlay');
  popup.classList.add('show');
  overlay.classList.add('show');
  aiPopupTimer = setTimeout(() => {
    closeAIPopup();
  }, 5000);
};

window.closeAIPopup = function() {
  const popup = document.getElementById('aiPopup');
  const overlay = document.getElementById('aiPopupOverlay');
  popup.classList.remove('show');
  overlay.classList.remove('show');
  if (aiPopupTimer) {
    clearTimeout(aiPopupTimer);
    aiPopupTimer = null;
  }
};

// Close AI popup on Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeAIPopup();
  }
});

/**
 * Back to Top Button
 */
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  if (window.pageYOffset > 300) {
    backToTop.classList.add('show');
  } else {
    backToTop.classList.remove('show');
  }
});
backToTop.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

/**
 * Scroll Bubbles Navigation
 */
window.scrollBubbles = function(direction) {
  const container = document.getElementById('categoryContainer');
  const scrollAmount = 300;
  if (direction === 'next') {
    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
  } else {
    container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
  }
};

/**
 * FAQ Toggle
 */
window.toggleFAQ = function(button) {
  const content = button.nextElementSibling;
  const toggle = button;
  const isActive = content.classList.contains('active');

  document.querySelectorAll('.faq-content').forEach(item => {
    item.classList.remove('active');
  });
  document.querySelectorAll('.faq-toggle').forEach(item => {
    item.classList.remove('active');
  });

  if (!isActive) {
    content.classList.add('active');
    toggle.classList.add('active');
  }
};

/**
 * Category Filter with Subcategories
 */
document.getElementById('categorySelect').addEventListener('change', function() {
  const categoryId = this.value;
  const subcategoryWrapper = document.getElementById('subcategoryWrapper');
  const subcategorySelect = document.getElementById('subcategorySelect');
  const subsubcategoryWrapper = document.getElementById('subsubcategoryWrapper');
  
  if (categoryId) {
    fetch(`/get-subcategories/${categoryId}`)
      .then(response => response.json())
      .then(subcategories => {
        subcategorySelect.innerHTML = '<option value="">Select</option>';
        subcategories.forEach(function(subcategory) {
          const option = document.createElement('option');
          option.value = subcategory.id;
          option.textContent = subcategory.name;
          subcategorySelect.appendChild(option);
        });
        subcategoryWrapper.classList.remove('hidden');
        subsubcategoryWrapper.classList.add('hidden');
      })
      .catch(error => console.error('Error:', error));
  } else {
    subcategoryWrapper.classList.add('hidden');
    subsubcategoryWrapper.classList.add('hidden');
  }
});

/**
 * Subcategory Filter
 */
document.getElementById('subcategorySelect').addEventListener('change', function() {
  const subcategoryId = this.value;
  const subsubcategoryWrapper = document.getElementById('subsubcategoryWrapper');
  const subsubcategorySelect = document.getElementById('subsubcategorySelect');
  
  if (subcategoryId) {
    fetch(`/get-subsubcategories/${subcategoryId}`)
      .then(response => response.json())
      .then(subsubcategories => {
        if (subsubcategories && subsubcategories.length > 0) {
          subsubcategorySelect.innerHTML = '<option value="">Select</option>';
          subsubcategories.forEach(function(subsubcategory) {
            const option = document.createElement('option');
            option.value = subsubcategory.id;
            option.textContent = subsubcategory.name;
            subsubcategorySelect.appendChild(option);
          });
          subsubcategoryWrapper.classList.remove('hidden');
        } else {
          subsubcategoryWrapper.classList.add('hidden');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        subsubcategoryWrapper.classList.add('hidden');
      });
  } else {
    subsubcategoryWrapper.classList.add('hidden');
  }
});

/**
 * Reset Filters Button
 */
document.getElementById('resetFiltersButton').addEventListener('click', function() {
  document.getElementById('languageSelect').value = '';
  document.getElementById('countrySelect').value = '';
  document.getElementById('categorySelect').value = '';
  document.getElementById('subcategorySelect').value = '';
  document.getElementById('subsubcategorySelect').value = '';
  
  document.getElementById('subcategoryWrapper').classList.add('hidden');
  document.getElementById('subsubcategoryWrapper').classList.add('hidden');
  
  const serviceGrid = document.getElementById('serviceGrid');
  serviceGrid.innerHTML = originalProvidersHTML;
  
  AOS.refresh();
});

/**
 * Filter Button - Main filtering logic
 */
document.getElementById('filterButton').addEventListener('click', function() {
  const categoryId = document.getElementById('categorySelect').value;
  const subcategoryId = document.getElementById('subcategorySelect').value;
  const subsubcategoryId = document.getElementById('subsubcategorySelect').value || '';
  const language = document.getElementById('languageSelect').value;
  const country = document.getElementById('countrySelect').value;

  const serviceGrid = document.getElementById('serviceGrid');
  serviceGrid.innerHTML = `
    <div class="col-span-full flex justify-center py-16">
      <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-blue-600"></div>
    </div>
  `;

  fetch(`/filter-providers?category_id=${categoryId}&subcategory_id=${subcategoryId}&subsubcategory_id=${subsubcategoryId}&country=${country}&language=${language}`)
    .then(response => response.json())
    .then(providers => {
      serviceGrid.innerHTML = '';
      
      if (providers.length > 0) {
        providers.slice(0, 10).forEach(function(provider, index) {
          const specialStatus = provider.special_status ? JSON.parse(provider.special_status) : {};
          const operationalCountries = Array.isArray(provider.operational_countries) 
            ? provider.operational_countries 
            : (provider.operational_countries ? JSON.parse(provider.operational_countries) : []);
          
          const avgRating = provider.average_rating || 5.0;
          const reviewCount = provider.reviews_count || 0;
          const fullStars = Math.floor(avgRating);
          const firstSpecialty = Object.keys(specialStatus).length > 0 ? Object.keys(specialStatus)[0] : null;
          
          let providerCategories = [];
          if (provider.categories && Array.isArray(provider.categories)) {
            providerCategories = provider.categories.slice(0, 2).map(cat => cat.name);
          } else if (provider.categories && provider.categories.length) {
            try {
              providerCategories = provider.categories.slice(0, 2).map(cat => cat.name || cat);
            } catch(e) {
              providerCategories = [];
            }
          }
          
          const providerCard = `
            <a href="/provider-details/${provider.slug}" 
              class="profile-card card-modern bg-white rounded-3xl overflow-hidden block group"
              data-aos="fade-up"
              data-aos-delay="${index * 30}">
              
              <div class="aspect-ratio-box relative overflow-hidden bg-gradient-to-br from-blue-100 to-purple-100">
                <img
                  src="${provider.profile_photo || 'images/attachment.png'}"
                  alt="${provider.first_name}"
                  class="provider-image absolute inset-0 w-full h-full object-cover"
                  onerror="this.src='images/attachment.png';"
                />
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                ${firstSpecialty ? `
                  <div class="absolute top-3 left-3">
                    <span class="badge-specialty text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                      ${firstSpecialty}
                    </span>
                  </div>
                ` : ''}

                <div class="absolute top-3 right-3">
                  <div class="status-online w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-lg"></div>
                </div>

                ${provider.preferred_language ? `
                  <div class="absolute bottom-3 left-3">
                    <span class="bg-white/90 backdrop-blur text-gray-800 px-2.5 py-1 rounded-full text-xs font-bold">
                      🗣️ ${provider.preferred_language}
                    </span>
                  </div>
                ` : ''}
              </div>

              <div class="p-4">
                <div class="mb-2">
                  <h3 class="font-bold text-base text-gray-900 truncate mb-1">
                    ${provider.first_name || 'Provider'}
                  </h3>
                  
                  <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400 text-xs">
                      ${Array(5).fill(0).map((_, i) => `
                        <svg class="w-3 h-3 ${i < fullStars ? 'fill-current' : 'fill-gray-300'}" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      `).join('')}
                    </div>
                    <span class="ml-1 text-xs font-bold text-gray-700">${avgRating.toFixed(1)}</span>
                    <span class="ml-1 text-xs text-gray-500">(${reviewCount})</span>
                  </div>
                </div>

                ${providerCategories.length > 0 ? `
                  <div class="mb-2">
                    <p class="text-xs font-bold text-gray-500 mb-1">📂 Services:</p>
                    <div class="flex flex-wrap gap-1">
                      ${providerCategories.map(cat => `
                        <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                          ${cat}
                        </span>
                      `).join('')}
                    </div>
                  </div>
                ` : ''}

                ${operationalCountries.length > 0 ? `
                  <div class="pt-2 border-t border-gray-100">
                    <p class="text-xs font-bold text-gray-500 mb-1">🌍 Countries of operation:</p>
                    <div class="flex flex-wrap gap-1">
                      ${operationalCountries.slice(0, 2).map(country => `
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                          ${country}
                        </span>
                      `).join('')}
                      ${operationalCountries.length > 2 ? `
                        <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-lg text-xs font-medium">
                          +${operationalCountries.length - 2}
                        </span>
                      ` : ''}
                    </div>
                  </div>
                ` : ''}
              </div>
            </a>
          `;
          
          serviceGrid.innerHTML += providerCard;
        });
        
        AOS.refresh();
      } else {
        serviceGrid.innerHTML = `
          <div class="col-span-full text-center py-16">
            <div class="text-6xl mb-4">😢</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No local pro found</h3>
            <p class="text-gray-600 mb-4">Try adjusting your filters or</p>
            <button onclick="document.getElementById('resetFiltersButton').click()" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors">
              Reset filters
            </button>
          </div>
        `;
      }
    })
    .catch(error => {
      console.error('Error:', error);
      serviceGrid.innerHTML = `
        <div class="col-span-full text-center py-16">
          <div class="text-6xl mb-4">⚠️</div>
          <h3 class="text-2xl font-bold text-gray-800 mb-2">Oops! Something went wrong</h3>
          <p class="text-gray-600 mb-4">Please try again</p>
          <button onclick="location.reload()" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors">
            Reload page
          </button>
        </div>
      `;
    });
});

/**
 * Touch swipe for bubbles
 */
let startX = 0;
let endX = 0;
const categoryContainer = document.getElementById('categoryContainer');

if (categoryContainer) {
  categoryContainer.addEventListener('touchstart', function(e) {
    startX = e.touches[0].clientX;
  });

  categoryContainer.addEventListener('touchend', function(e) {
    endX = e.changedTouches[0].clientX;
    const threshold = 50;
    const diff = startX - endX;
    
    if (Math.abs(diff) > threshold) {
      if (diff > 0) {
        scrollBubbles('next');
      } else {
        scrollBubbles('prev');
      }
    }
  });
}