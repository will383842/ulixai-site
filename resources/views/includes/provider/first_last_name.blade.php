@php 
  $check = Auth::check();
  $name = Auth::user()->name ?? '';
@endphp
<div id="step12" class="hidden space-y-6">
  <h2 class="text-blue-900 font-bold text-xl">WHAT’S YOUR FIRST NAME AND SURNAME?</h2>
  <p class="text-sm text-blue-600">Describe your project in a few words</p>
  <div class="flex gap-4">
    <input id="first_name_input" type="text" placeholder="Your first name" class="w-full border border-gray-300 rounded-full px-4 py-2"
      @if($check)
        value="{{ $name }}"
        disabled
      @endif
    />
    <input id="last_name_input" type="text" placeholder="Your surname" class="w-full border border-gray-300 rounded-full px-4 py-2"
      @if($check)
        value="{{$name}}"
        disabled
      @endif
    />
  </div>
  <div class="flex justify-between items-center">
    <button id="backToStep11" class="text-blue-600 font-medium"> Back</button>
    <button id="nextStep12" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
  </div>
  <div class="w-full h-2 rounded-full overflow-hidden">
    <!-- <div id="progressBar" class="h-full bg-blue-500 rounded-full" style="width: 92%;"></div> -->
  </div>
  <!-- <p id="progressText" class="text-sm text-gray-500 text-center">Step 12 of 16</p> -->
</div>
