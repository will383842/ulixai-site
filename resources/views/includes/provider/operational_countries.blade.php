<div id="step6" class="hidden">
    <h2 class="font-bold mb-6 text-xl text-blue-900">WHICH COUNTRIES DO YOU OPERATE IN?</h2>

    <div id="countryList" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 max-h-64 overflow-y-auto border border-gray-300 rounded-lg p-3 mb-4">
        @foreach($countries as $country)
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="countries[]" value="{{ $country->country }}" class="text-blue-600">
                <span>{{ $country->country }}</span>
            </label>
        @endforeach
    </div>

    <p id="countryError" class="text-red-600 text-sm mb-4 hidden">Please select at least 3 countries.</p>

    <div class="flex justify-between items-center">
        <button id="backToStep5" class="text-blue-700 hover:underline">Back</button>
        <button id="nextStep6" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Next</button>
    </div>
</div>
