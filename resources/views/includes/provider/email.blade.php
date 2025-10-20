<div id="step13" class="hidden space-y-6">
  <h2 class="text-blue-900 font-bold text-xl">WHAT’S YOUR E-MAIL?</h2>
  <input id="email_input" type="email" placeholder="E-mail" class="w-full border border-gray-300 rounded-full px-4 py-2"
    @if(Auth::check())
      value="{{ Auth::user()->email }}"
      disabled
    @endif
  />
  <div class="flex justify-between items-center">
    <button id="backToStep12" class="text-blue-600 font-medium"> Back</button>
    <button id="nextStep13" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
  </div>
  <div class="w-full h-2  rounded-full overflow-hidden">
    <!-- <div id="progressBar" class="h-full bg-blue-500 rounded-full" style="width: 100%;"></div> -->
  </div>
  <!-- <p id="progressText" class="text-sm text-gray-500 text-center">Step 13 of 16</p> -->
</div>