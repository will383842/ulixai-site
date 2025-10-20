<!-- Category Search Popup -->
<div id="selectet-provider-category" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center p-4 overflow-hidden">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-hidden">
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <h2 class="text-xl font-semibold text-gray-800">Choose Your Category</h2>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>

    <div id="render-selectet-provider-category">

    </div>
  </div>
</div>