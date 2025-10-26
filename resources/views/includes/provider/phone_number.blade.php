<!-- Include intl-tel-input library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<div id="step14" class="hidden">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }
    @keyframes glow-pulse {
      0%, 100% { 
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
      }
      50% { 
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.5);
      }
    }
    
    .phone-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .phone-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
      border-color: #3b82f6;
      transform: translateY(-2px);
    }
    
    .phone-input.valid {
      border-color: #10b981 !important;
      background: linear-gradient(to bottom right, #f0fdf4 0%, #dcfce7 100%);
    }
    
    .input-wrapper {
      transition: all 0.3s ease;
    }
    
    .input-wrapper:hover {
      transform: translateY(-2px);
    }
    
    .icon-badge {
      animation: float 3s ease-in-out infinite;
    }
    
    .success-indicator {
      opacity: 0;
      transform: scale(0);
      transition: all 0.3s ease;
      pointer-events: none;
    }
    
    .phone-input.valid ~ .success-indicator {
      opacity: 1;
      transform: scale(1);
    }

    .ambient-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.2;
      pointer-events: none;
      z-index: 0;
    }
    
    .ambient-blob-1 {
      width: 300px;
      height: 300px;
      background: #93c5fd;
      top: -150px;
      left: -150px;
    }
    
    .ambient-blob-2 {
      width: 250px;
      height: 250px;
      background: #67e8f9;
      top: -100px;
      right: -100px;
    }
    
    .ambient-blob-3 {
      width: 200px;
      height: 200px;
      background: #5eead4;
      bottom: -100px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    /* Intl-tel-input custom styling */
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
      border-radius: 12px 0 0 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      z-index: 2;
    }
    
    .iti__arrow {
      margin-left: 6px;
      width: 0;
      height: 0;
      border-left: 3px solid transparent;
      border-right: 3px solid transparent;
      border-top: 4px solid #2563eb;
    }
    
    .iti__country-list {
      position: absolute;
      z-index: 9999 !important;
      background: #fff;
      border: 2px solid #dbeafe;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.15);
      max-height: 280px;
      overflow-y: auto;
      width: 320px;
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
      padding: 10px 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s;
    }
    
    .iti__country:hover {
      background-color: #dbeafe;
    }
    
    .iti__country.iti__highlight {
      background-color: #bfdbfe;
    }
    
    .iti__dial-code {
      color: #2563eb;
      font-weight: 600;
    }
    
    #phone_number_input {
      padding-left: 88px !important;
    }
  </style>

  <!-- Ambient background blobs -->
  <div class="ambient-blob ambient-blob-1"></div>
  <div class="ambient-blob ambient-blob-2"></div>
  <div class="ambient-blob ambient-blob-3"></div>

  <!-- Header -->
  <div class="mb-8 text-center relative z-10">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="icon-badge w-12 h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
        <span class="text-2xl">📱</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent">
        What's Your Number?
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      We'll use this to communicate with you
    </p>
  </div>

  <!-- Info banner -->
  <div class="mb-6 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 py-3 px-5 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-base">💬</span>
      </div>
      <p class="text-blue-900 font-semibold text-sm sm:text-base">Your number allows communication with service requesters</p>
    </div>
  </div>

  <!-- Phone Input -->
  <div class="mb-8 relative z-10">
    <div class="input-wrapper">
      <label class="block text-gray-900 font-bold text-base mb-2 flex items-center gap-2">
        <span class="text-xl">☎️</span>
        <span class="text-blue-600">Phone Number</span>
      </label>
      <div class="relative">
        <input 
          id="phone_number_input" 
          type="tel" 
          placeholder="Enter your phone number"
          class="phone-input w-full border-2 border-gray-300 rounded-xl px-5 py-3.5 focus:outline-none bg-white transition-all shadow-sm text-base font-medium"
        />
        <div class="success-indicator absolute right-4 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Error message -->
  <div id="phoneError" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div>
        <p class="text-red-900 font-bold text-base">Please enter at least 6 digits</p>
        <p class="text-red-700 text-sm font-medium mt-0.5">Example: +33 6 12 34 56 78</p>
      </div>
    </div>
  </div>

  <!-- Success message -->
  <div id="phoneSuccess" class="hidden mb-8 rounded-xl p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-sm relative z-10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 animate-bounce">
        <span class="text-xl">✅</span>
      </div>
      <div>
        <p class="text-green-900 font-bold text-base">Valid phone number!</p>
        <p class="text-green-700 text-sm font-medium mt-0.5">Ready to continue</p>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container relative z-10">
    <button id="backToStep13" type="button" class="nav-btn-back bg-white text-blue-600 border-2 border-gray-200">
      Back
    </button>
    <button id="nextStep14" type="button" class="nav-btn-next bg-gradient-to-r from-blue-600 to-cyan-600" disabled>
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

  // Validation assouplie (6+ digits)
  function validatePhone() {
    const phoneValue = phoneInput.value.trim();
    const digitsOnly = phoneValue.replace(/\D/g, '');
    const isValid = digitsOnly.length >= 6;
    
    if (isValid) {
      phoneInput.classList.remove('border-red-500');
      phoneInput.classList.add('valid');
      errorMsg.classList.add('hidden');
      successMsg.classList.remove('hidden');
      nextBtn.disabled = false;
      return true;
    } else {
      phoneInput.classList.remove('valid');
      successMsg.classList.add('hidden');
      nextBtn.disabled = true;
      return false;
    }
  }

  // Auto-save localStorage
  function savePhone() {
    const phoneValue = phoneInput.value.trim();
    const digitsOnly = phoneValue.replace(/\D/g, '');
    
    if (digitsOnly.length >= 6) {
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

  // Dropdown direction (auto up/down)
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