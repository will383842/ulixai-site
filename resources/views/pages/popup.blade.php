 <!-- Main Search Popup -->
<div id="searchPopup" class="hidden fixed inset-0 z-[60] bg-black bg-opacity-50 flex justify-center items-center p-4 overflow-hidden">

  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

    <!-- Header -->
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <h2 class="text-xl font-semibold text-gray-800">Choose Your Category</h2>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>

    <!-- Categories Grid -->
    <div class="p-6 pt-2">
      <div class="grid grid-cols-2 gap-4 main-categories">
        <!-- main categories will be dynamically loaded here based on the selected main category. -->
      </div>
    </div>
  </div>
</div>

<!-- Subcategories Popup -->
<div id="expatriesPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <div class="flex items-center">
        <button onclick="goBackToMainCategories()" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Choose Your Need</h2>
      </div>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <div class="px-6 py-4">
      <!-- <div class="flex items-center rounded-full border-2 border-gray-200 bg-gray-50 px-4 py-3">
        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="7" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input
          type="text"
          placeholder="Ex: Aide administrative"
          class="flex-grow bg-transparent text-gray-700 focus:outline-none placeholder-gray-500"
        />
      </div> -->
    </div>

    <div class="p-6 pt-2">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sub-category">
       <!-- Subcategories will be dynamically loaded here based on the selected main category. -->
      </div>
    </div>
  </div>
</div>


<!-- Vacanciers - Autres besoins sub-subcategories Popup -->
<div id="vacanciersAutresBesoinsPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
    <!-- Header with back and close buttons -->
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <div class="flex items-center">
        <button onclick="goBackToVacanciersSubcategories()" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Choose Your Need</h2>
      </div>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Search Input in Popup -->
    <!-- <div class="px-6 py-4">
      <div class="flex items-center rounded-full border-2 border-gray-200 bg-gray-50 px-4 py-3">
        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="7" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input
          type="text"
          placeholder="Ex: Aide administrative"
          class="flex-grow bg-transparent text-gray-700 focus:outline-none placeholder-gray-500"
        />
      </div>
    </div> -->

    <!-- Subcategories Grid -->
    <div class="p-6 pt-2">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 child-categories">
        <!-- Child categories will be shown here -->
      </div>
    </div>
  </div>
</div>



 