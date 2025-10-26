<!-- Include intl-tel-input library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<div id="step14" class="hidden">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }
    .phone-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 1.125rem;
      font-weight: 600;
    }
    .phone-input:focus {
      box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.2);
      border-color: #9333ea;
      transform: translateY(-2px);
    }
    .phone-input::placeholder {
      color: #9ca3af;
      font-weight: 500;
    }
    .phone-input.border-green-500 {
      border-color: #10b981 !important;
      background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    }
    .input-wrapper {
      position: relative;
    }
    .icon-badge {
      animation: float 3s ease-in-out infinite;
    }
    .success-indicator {
      opacity: 0;
      transform: scale(0);
      transition: all 0.3s ease;
    }
    .phone-input.border-green-500 ~ .success-indicator {
      opacity: 1;
      transform: scale(1);
    }
    
    /* Fix pour intl-tel-input */
    .iti { 
      width: 100%;
      position: relative;
      z-index: 10;
    }
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
      z-index: 2;
    }
    .iti__selected-flag {
      padding: 0 8px 0 12px;
      background: transparent;
      border-radius: 16px 0 0 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      z-index: 2;
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
      z-index: 9999 !important;
      background: #fff;
      border: 2px solid #e5e7eb;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
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
    .iti__country:hover { background-color: #faf5ff; }
    .iti__country.iti__highlight { background-color: #f3e8ff; }
    .iti__dial-code { color: #9333ea; font-weight: 600; }
    #phone_number_input { padding-left: 90px !important; }
  </style>

  <!-- Header premium avec gradient et animation -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="icon-badge w-14 h-14 bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
        <span class="text-3xl">📱</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-purple-600 via-pink-500 to-purple-600 bg-clip-text text-transparent">
        What's Your Number?
      </h2>
    </div>
    <p class="text-gray-600 text-base font-semibold">
      We'll use this to communicate with you
    </p>
  </div>

  <!-- Alert premium -->
  <div class="mb-8 rounded-xl bg-gradient-to-r from-purple-50 via-pink-50 to-purple-50 border-l-4 border-purple-400 py-3 px-5 shadow-lg">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">💬</span>
      </div>
      <p class="text-purple-900 font-bold text-sm">Your number allows communication with service requesters</p>
    </div>
  </div>

  <!-- Phone Input allégé -->
  <div class="mb-8">
    <div class="input-wrapper relative bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border-2 border-purple-300 shadow-lg">
      <label class="block text-gray-900 font-bold text-lg mb-3 flex items-center gap-2">
        <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center shadow-md">
          <span class="text-xl">☎️</span>
        </div>
        <span>Phone Number</span>
      </label>
      <div class="relative">
        <input 
          id="phone_number_input" 
          type="tel" 
          placeholder="Enter your phone number"
          class="phone-input w-full border-3 border-purple-300 rounded-xl px-6 py-4 focus:outline-none bg-white transition-all shadow-sm"
        />
        <div class="success-indicator absolute right-4 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Message erreur premium -->
  <div id="phoneError" class="hidden mb-8 rounded-2xl p-5 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-lg animate-pulse">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-2xl">⚠️</span>
      </div>
      <div>
        <p class="text-red-900 font-black text-lg">Please enter at least 6 digits</p>
        <p class="text-red-700 text-sm font-semibold mt-1">Example: +33 6 12 34 56 78</p>
      </div>
    </div>
  </div>

  <!-- Message succès premium -->
  <div id="phoneSuccess" class="hidden mb-8 rounded-2xl p-5 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0 animate-bounce">
        <span class="text-2xl">✅</span>
      </div>
      <div>
        <p class="text-green-900 font-black text-lg">Valid phone number!</p>
        <p class="text-green-700 text-sm font-semibold mt-1">Ready to continue</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep13" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep14" type="button" class="nav-btn-next">
      Continue
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep14');
    const stepElement = document.getElementById('step14');
    
    function checkValidation() {
        const phone = document.getElementById('phone_number_input')?.value.trim();
        const digitsOnly = phone?.replace(/\D/g, '') || '';
        const isValid = digitsOnly.length >= 6;
        if (nextBtn) {
            nextBtn.disabled = !isValid;
        }
    }
    
    // Observer les changements
    if (stepElement) {
        stepElement.addEventListener('input', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('change', () => setTimeout(checkValidation, 100));
    }
    
    // Vérification initiale
    setTimeout(checkValidation, 200);
});
</script>