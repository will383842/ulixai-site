<div id="step9" class="hidden">
      <h2 class="font-bold mb-6 text-xl text-blue-900 text-center">Tell us about yourself</h2>
      <!-- Note: Not obligatory but better for you -->
      <div class="w-full mb-4 rounded-lg bg-yellow-100 border-l-4 border-yellow-400 py-2 px-4 text-center">
        <span class="text-brown-700" style="color:#8B5C00;font-weight:500;">what you fill out here will be on your profile sheet and important to get more missions </span>
      </div>
      <div class="mb-6">
        <label class="block text-blue-900 font-medium mb-2">Profile Description</label>
        <textarea id="profileDescription" 
                  placeholder="Write a brief description about yourself, your experience, and how you can help others..."
                  class="w-full border border-blue-400 rounded-lg px-4 py-3 text-blue-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 resize-none"
                  rows="6"
                  value=""
                  maxlength="500"></textarea>
        <div class="flex justify-between items-center mt-2">
          <span class="text-sm text-gray-500">Maximum 500 characters</span>
          <span class="text-sm text-gray-500"><span id="charCount">0</span>/500</span>
        </div>
      </div>

      <!-- Navigation -->
      <div class="flex justify-between items-center">
        <button id="backToStep8" class="text-blue-700 hover:underline">Back</button>
        <button id="nextStep9" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Next</button>
      </div>
    </div>