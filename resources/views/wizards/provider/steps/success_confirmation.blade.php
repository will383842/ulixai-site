<!-- 
============================================
🚀 STEP 16 - SUCCESS CONFIRMATION
🎉 Fichier: resources/views/includes/provider/success_confirmation.blade.php
============================================
-->

<div id="step16" class="hidden space-y-6 text-center">
  <h2 class="text-blue-900 font-extrabold text-2xl">YOUR PROVIDER ACCOUNT IS CREATED</h2>
  <p class="text-blue-800 font-semibold text-md">YOU ARE OFFICIALLY A ULYSSE</p>
  <p class="text-gray-600">Go check out the service requests in your area now</p>
  <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full">
    <a href="{{ route('ongoing-requests') }}"> CURRENT SERVICE REQUESTS </a>
  </button>
  <p class="text-gray-600 text-sm mt-2">You can boost your profile to have more jobs to do</p>
  <button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-6 py-2 rounded-full">
    I BOOST MY PROFILE TO BE AMONG THE FIRST SERVICE PROVIDERS
  </button>
</div>