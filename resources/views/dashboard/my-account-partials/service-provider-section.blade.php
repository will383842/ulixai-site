<!-- Service Provider Alert -->
<div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg px-6 py-6 max-w-6xl mx-auto">
  <h2 class="text-lg font-bold">Welcome, Service Provider!</h2>
  <p class="text-blue-50 text-sm mt-1">Complete your profile to start offering services and attract more clients.</p>
</div>

<!-- Profile Completion Section for Service Providers -->
<div class="bg-white rounded-2xl shadow-lg px-4 sm:px-6 py-8 space-y-6 max-w-6xl mx-auto border border-gray-100">
  <h3 class="text-gray-800 font-bold text-lg sm:text-xl text-center sm:text-left">
    Complete Your Service Provider Profile
  </h3>

  <!-- Grid of Steps -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <a href="{{ route('personal-info') }}" class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm transition-all duration-300 hover:shadow-md">
      <div class="text-gray-700 group-hover:text-blue-600">Personal Information</div>
    </a>

    <a href="{{ route('my-documents') }}" class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm transition-all duration-300 hover:shadow-md">
      <div class="text-gray-700 group-hover:text-blue-600">Your Documents</div>
    </a>

    <div class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm transition-all duration-300 hover:shadow-md cursor-pointer">
      <div class="text-gray-700 group-hover:text-blue-600">Terms & Conditions</div>
    </div>

    <div class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm cursor-pointer transition-all duration-300 hover:shadow-md">
      <button type="button" onclick="openCategoryPopup()" class="text-gray-700 group-hover:text-blue-600">Categories</button>
    </div>

    <div class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm cursor-pointer transition-all duration-300 hover:shadow-md" onclick="openAboutYouPopup()">
      <div class="text-gray-700 group-hover:text-blue-600">About You</div>
    </div>
  <div id="aboutYouPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-2xl border border-gray-200 w-96 p-8 shadow-2xl">
    <h2 class="text-center text-xl font-bold text-gray-900 mb-6">Update About You</h2>
    <textarea id="aboutYouText" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" rows="6" placeholder="Write about yourself..."></textarea>
    <div class="flex justify-end space-x-3 mt-6">
      <button onclick="closeAboutYouPopup()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">Cancel</button>
      <button onclick="submitAboutYou()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">Save</button>
    </div>
  </div>
</div>


    <div class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-4 py-6 text-center font-semibold text-sm transition-all duration-300 hover:shadow-md">
      <a id="openSpecialStatusModal" href="#" class="text-gray-700 group-hover:text-blue-600">Special Status</a>
    </div>
  </div>

  <!-- Bottom CTA -->
  <div class="pt-4 text-center">
    <a href="{{ route('points-calculation') }}" class="inline-block px-8 py-3 bg-blue-500 hover:bg-blue-600 rounded-full text-white font-semibold text-sm transition-colors duration-300 shadow-md hover:shadow-lg">
      Calculate Ulysse Points
    </a>
  </div>
</div>
