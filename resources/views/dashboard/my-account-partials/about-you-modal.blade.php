<!-- About You Modal -->
<div id="aboutYouPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl w-full max-w-xl p-6 shadow-2xl relative">
    <button onclick="closeAboutYouPopup()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl transition-colors">&times;</button>
    
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Tell us about yourself</h2>
    <p class="text-gray-600 text-sm mb-4">Share a few words about yourself to make your profile stand out and attract more clients.</p>
    
    <textarea 
      id="aboutYouText" 
      rows="5" 
      class="w-full border border-gray-300 rounded-lg p-4 text-gray-700 resize-none mb-4 placeholder:text-sm focus:border-blue-400 focus:outline-none" 
      placeholder="What you fill out here will be on your profile sheet and is important to get more missions">
    </textarea>
    
    <button onclick="submitAboutYou()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl w-full transition-colors">
      Submit
    </button>
  </div>
</div>