<!-- Include intl-tel-input library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<div id="step14" class="hidden">
  <style>
    .phone-input:focus {
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .iti { width: 100%; }
    .iti__flag, .iti__flag.iti__be, .iti__flag.iti__us, .iti__selected-flag .iti__flag {
      background-repeat: no-repeat !important;
      background-size: auto !important;
    }
    .iti__flag {
      background-image: url('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags.png') !important;
    }
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .iti__flag {
        background-image: url('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags@2x.png') !important;
      }
    }
    .iti__flag-container {
      position: absolute;
      inset: 0 auto 0 0;
      padding: 0 12px;
      display: flex;
      align-items: center;
    }
    .iti__selected-flag {
      padding: 0 8px 0 12px;
      background: transparent;
      border-radius: 16px 0 0 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }
    .iti__arrow {
      margin-left: 6px;
      width: 0; height: 0;
      border-left: 3px solid transparent;
      border-right: 3px solid transparent;
      border-top: 4px solid #666;
    }
    .iti__country-list {
      position: absolute;
      z-index: 1000;
      background: #fff;
      border: 2px solid #e5e7eb;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      max-height: 280px;
      overflow-y: auto;
      width: 340px;
      top: 100%;
      left: 0;
      margin-top: 8px;
    }
    .iti__country-list--up {
      top: auto !important;
      bottom: 100% !important;
      margin-top: 0 !important;
      margin-bottom: 8px !important;
    }
    .iti__country {
      padding: 12px 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s;
    }
    .iti__country:hover { background-color: #f0f9ff; }
    .iti__country.iti__highlight { background-color: #dbeafe; }
    .iti__dial-code { color: #6366f1; font-weight: 600; }
    #phone_number_input { padding-left: 90px !important; }
  </style>

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 bg-clip-text text-transparent mb-3">
      📱 What's Your Number?
    </h2>
    <p class="text-gray-500 text-base">We'll use this to communicate with you</p>
  </div>

  <!-- Info box -->
  <div class="mb-6 rounded-2xl bg-gradient-to-r from-purple-50 to-pink-50 border-l-4 border-purple-400 py-4 px-6">
    <div class="flex items-start">
      <span class="text-2xl mr-3">💬</span>
      <p class="text-purple-900 font-semibold text-sm">Your number allows communication with service requesters</p>
    </div>
  </div>

  <!-- Phone Input -->
  <div class="mb-8">
    <label class="block text-gray-700 font-bold text-base mb-3 flex items-center">
      <span class="text-xl mr-2">☎️</span>
      Phone Number
    </label>
    <div class="relative">
      <input 
        id="phone_number_input" 
        type="tel" 
        placeholder="Enter your phone number"
        class="phone-input w-full border-3 border-gray-200 rounded-2xl px-6 py-4 text-lg focus:outline-none focus:border-purple-500 transition-all"
      />
    </div>
  </div>

  <!-- Message erreur -->
  <div id="phoneError" class="hidden mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">⚠️</span>
      <p class="text-red-700 font-semibold">Please enter at least 6 digits</p>
    </div>
  </div>

  <!-- Message succès -->
  <div id="phoneSuccess" class="hidden mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
    <div class="flex items-center">
      <span class="text-2xl mr-3">✅</span>
      <p class="text-green-700 font-semibold">Valid phone number</p>
    </div>
  </div>

  <!-- Navigation -->
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep13" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep14" 
      class="group bg-gradient-to-r from-purple-600 to-pink-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100"
      disabled
    >
      <span>Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const phoneInput = document.getElementById('phone_number_input');
  const nextBtn = document.getElementById('nextStep14');
  const errorMsg = document.getElementById('phoneError');
  const successMsg = document.getElementById('phoneSuccess');
  
  if (!phoneInput || !window.intlTelInput) return;

  const iti = window.intlTelInput(phoneInput, {
    initialCountry: "auto",
    geoIpLookup: function (callback) {
      fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => callback(data && data.country_code ? data.country_code : "FR"))
        .catch(() => callback("FR"));
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    separateDialCode: false,
    nationalMode: false,
    formatOnDisplay: true,
    autoPlaceholder: "polite"
  });

  phoneInput.iti = iti;

  // Validation assouplie
  function validatePhone() {
    const phoneValue = phoneInput.value.trim();
    
    // Accepter si au moins 6 chiffres (format minimum international)
    const digitsOnly = phoneValue.replace(/\D/g, '');
    const isValid = digitsOnly.length >= 6;
    
    if (isValid) {
      phoneInput.classList.remove('border-red-500');
      phoneInput.classList.add('border-green-500');
      errorMsg.classList.add('hidden');
      successMsg.classList.remove('hidden');
      nextBtn.disabled = false;
      return true;
    } else {
      phoneInput.classList.remove('border-green-500');
      phoneInput.classList.add('border-red-500');
      successMsg.classList.add('hidden');
      nextBtn.disabled = true;
      return false;
    }
  }

  // Auto-save
  function savePhone() {
    const phoneValue = phoneInput.value.trim();
    const digitsOnly = phoneValue.replace(/\D/g, '');
    
    if (digitsOnly.length >= 6) {
      // Toujours sauvegarder le numéro complet formaté par intl-tel-input
      const fullNumber = iti.getNumber();
      const countryData = iti.getSelectedCountryData();
      
      let expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.phone_number = fullNumber;
      expats.phone_country = countryData.name;
      expats.phone_country_code = countryData.dialCode;
      localStorage.setItem('expats', JSON.stringify(expats));
    }
    validatePhone();
  }

  // Events
  phoneInput.addEventListener('input', savePhone);
  phoneInput.addEventListener('countrychange', savePhone);

  // Validation au clic Next
  nextBtn.addEventListener('click', function(e) {
    if (!validatePhone()) {
      e.preventDefault();
      errorMsg.classList.remove('hidden');
      errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Dropdown direction
  phoneInput.addEventListener('open:countrydropdown', function () {
    const list = phoneInput.parentElement.querySelector('.iti__country-list');
    if (!list) return;
    const rect = phoneInput.getBoundingClientRect();
    const spaceBelow = window.innerHeight - rect.bottom;
    const spaceAbove = rect.top;

    if (spaceAbove > spaceBelow) {
      list.classList.add('iti__country-list--up');
    } else {
      list.classList.remove('iti__country-list--up');
    }
  });

  // Restore localStorage
  const expats = JSON.parse(localStorage.getItem('expats')) || {};
  if (expats.phone_number) {
    phoneInput.value = expats.phone_number;
    validatePhone();
  }
});
</script>