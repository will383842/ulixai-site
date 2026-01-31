<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Confirmation</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gradient-to-r from-blue-50 to-yellow-50 min-h-screen">

  <!-- Header & Breadcrumbs -->
   @include('includes.header')
     @include('wizards.requester.steps.popup_request_help')

 

  <div class="flex flex-col items-center min-h-screen py-8 px-2">
    <!-- Main Content Container -->
    <div class="w-full max-w-3xl mx-auto flex-1 flex flex-col justify-center">

      <!-- Booking Confirmation -->
      @php
        $currencySymbols = [
          'EUR' => '€',
          'USD' => '$',
          'GBP' => '£',
          'CHF' => 'CHF',
          'CAD' => 'CA$',
          'AUD' => 'A$',
          'JPY' => '¥',
          'CNY' => '¥',
          'INR' => '₹',
          'BRL' => 'R$',
          'MXN' => 'MX$',
          'KRW' => '₩',
          'RUB' => '₽',
          'ZAR' => 'R',
          'SEK' => 'kr',
          'NOK' => 'kr',
          'DKK' => 'kr',
          'PLN' => 'zł',
          'CZK' => 'Kč',
          'HUF' => 'Ft',
          'TRY' => '₺',
          'ILS' => '₪',
          'THB' => '฿',
          'SGD' => 'S$',
          'HKD' => 'HK$',
          'NZD' => 'NZ$',
          'MAD' => 'DH',
          'AED' => 'AED',
          'SAR' => 'SAR',
          'XOF' => 'CFA',
          'XAF' => 'CFA',
        ];
        $currency = $mission->budget_currency ?? 'EUR';
        $currencySymbol = $currencySymbols[$currency] ?? $currency;
      @endphp
      <div class="bg-white p-6 sm:p-8 md:p-10 rounded-2xl shadow-xl space-y-6 border border-blue-100">
        <h1 class="text-xl sm:text-2xl font-semibold text-blue-800 text-center">
          WE CONFIRM THAT YOUR BOOKING HAS BEEN TAKEN INTO ACCOUNT, YOUR ULYSSE HAS BEEN NOTIFIED
        </h1>
        <p class="text-gray-600 text-center">Here Are The Provider's Contact Details</p>

        <div class="flex flex-col md:flex-row gap-8 md:gap-6 items-center md:items-start">
          <!-- Provider Card -->
          <div class="w-full md:w-72 bg-blue-50 rounded-2xl p-6 flex flex-col items-center text-center shadow-md border border-blue-100">
          <div class="w-24 h-24 bg-gray-300 rounded-full mb-4 overflow-hidden">
              @if($mission->selectedProvider && $mission->selectedProvider->profile_photo)
                <img src="{{ asset($mission->selectedProvider->profile_photo) }}" alt="Provider Photo" class="w-full h-full object-cover rounded-full">
                @endif
            </div>
            <div class="text-blue-600 text-sm mb-1">{{$provider->first_name}}</div>
          
            <div class="text-gray-700 text-sm mb-1">
              
              ⭐ {{ $reviews->avg('rating') ?? '5.0' }} / 5
            </div>
            <div class="text-gray-700 text-sm mb-1">
              📞 {{ $provider->phone_number ?? '-' }}
            </div>
            <div class="text-blue-700 underline text-sm mb-2">
              📧 {{ $provider->email ?? '-' }}
            </div>
            <ul class="text-sm text-gray-700 space-y-1 mt-2">
              @if($mission->selectedProvider && $mission->selectedProvider->services_to_offer)
                @foreach(json_decode($mission->selectedProvider->services_to_offer, true) as $service)
                  <li>{{ $service }}</li>
                @endforeach
              @endif
            </ul>
          </div>

          <!-- Booking Info -->
          <div class="flex-1 space-y-4 w-full">
            <div class="border border-blue-200 rounded-xl p-6 shadow-sm bg-blue-50">
              <h2 class="font-semibold text-gray-600 text-sm mb-2">Mission Details</h2>
              <div class="flex justify-between items-center flex-wrap gap-2">
                <div>
                  <p class="text-gray-800 font-medium">{{ $mission->title }}</p>
                  <p class="text-sm text-gray-600">{{ $mission->service_duration ?? '-' }}</p>
                  <p class="text-xs text-gray-400">{{ $mission->created_at ? $mission->created_at->format('d/m/Y') : '-' }}</p>
                </div>
                <div class="text-xl font-semibold text-gray-700">
                  @if($mission->offer)
                    {{ $currencySymbol }}{{ number_format($mission->offer->price, 2) }}
                  @endif
                </div>
              </div>
              <div class="mt-2 text-gray-700 text-sm break-words whitespace-pre-line">
              {{ $mission->description }}
            </div>

            </div>

            <!-- <div class="text-blue-600 text-sm underline cursor-pointer text-center">PHONE TO {{ $mission->selectedProvider->first_name ?? 'Provider' }}</div> -->
            <div class="flex items-center justify-center space-x-2">
              <!-- <span class="text-gray-500 text-sm">Or</span> -->
              <a href="{{ route('user.conversation') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full transition text-sm">SEND A MESSAGE</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Popups -->
      <!-- Popup 1 -->
      <div id="bookingPopup1" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
          <button onclick="closePopup1()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
          <p class="text-sm text-blue-500 mb-2">Moving household appliances</p>
          <div class="border rounded-lg p-4 text-sm text-gray-700 mb-4">
            Moving a vending machine from one location to another. Everything is on the ground floor, etc.
          </div>
          <div class="text-sm text-gray-600 space-y-1 mb-6">
            <p><strong>Date:</strong> 15/10/2023</p>
            <p><strong>Category:</strong> Household</p>
            <p><strong>Sub category:</strong> Appliances</p>
            <p><strong>Sub Sub category:</strong> Vending Machines</p>
            <p><strong>Country:</strong> United States</p>
            <p><strong>Language:</strong> English</p>
          </div>
          <button onclick="openPopup2()" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-6 py-2 text-sm font-medium">I APPLY</button>
        </div>
      </div>

      <!-- Popup 2 -->
      <div id="bookingPopup2" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
          <button onclick="closePopup2()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
          <p class="text-sm text-blue-500 mb-2">Moving household appliances</p>
          <h2 class="text-center text-lg font-bold text-blue-900 mb-4">PLEASE INDICATE YOUR RATE FOR THIS SERVICE</h2>
          <div class="border rounded-lg p-4 text-sm text-gray-700 mb-4">
            Moving a vending machine from one location to another. Everything is on the ground floor, etc.
          </div>
          <div class="mb-6">
            <label class="block text-sm text-blue-900 mb-1">Indicate Delay to realise</label>
            <input type="text" placeholder="e.g. 2 days" class="p-2 border border-gray-300 rounded w-full" />
          </div>
          <button onclick="openPopup3()" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-6 py-2 text-sm font-medium">I APPLY</button>
        </div>
      </div>

      <!-- Popup 3 -->
      <div id="bookingPopup3" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative text-center">
          <button onclick="closePopup3()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
          <h2 class="text-lg font-bold text-blue-900 mb-3">Ulysse!</h2>
          <p class="text-base text-gray-800 mb-2">Your application has been sent to the requester</p>
          <p class="text-sm text-gray-600">You will be informed if your application is accepted via your personal messaging and email</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    function openPopup1() {
      document.getElementById('bookingPopup1').classList.remove('hidden');
    }
    function closePopup1() {
      document.getElementById('bookingPopup1').classList.add('hidden');
    }
    function openPopup2() {
      closePopup1();
      document.getElementById('bookingPopup2').classList.remove('hidden');
    }
    function closePopup2() {
      document.getElementById('bookingPopup2').classList.add('hidden');
    }
    function openPopup3() {
      closePopup2();
      document.getElementById('bookingPopup3').classList.remove('hidden');
    }
    function closePopup3() {
      document.getElementById('bookingPopup3').classList.add('hidden');
    }
  </script>
 
@include('dashboard.partials.dashboard-mobile-navbar')
{{-- Floating Bug Report Button --}}
@include('components.floating-bug-report')

</body>
</html>