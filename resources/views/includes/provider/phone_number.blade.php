<!-- 1) Include the library CSS & JS (keep these once on the page/layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- Step 15: WhatsApp Number -->
<div id="step14" class="hidden space-y-6">
  <h2 class="text-blue-900 font-bold text-xl">WHAT'S YOUR NUMBER ?</h2>
  <p class="text-sm text-blue-500">Your number will allow to communicate with the service requester who approves you</p>

  <div class="relative">
    <input id="phone_number_input" type="tel" placeholder="Enter your phone number"
      class="w-full border border-blue-300 rounded-full px-4 py-2 pl-20 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
  </div>

  <div class="flex justify-between items-center">
    <button id="backToStep13" class="text-blue-600 font-medium">Back</button>
    <button id="nextStep14" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
  </div>
  <div class="w-full h-2 rounded-full overflow-hidden"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const phoneInput = document.getElementById('phone_number_input');
  if (!phoneInput || !window.intlTelInput) return;

  const iti = window.intlTelInput(phoneInput, {
    initialCountry: "auto",
    geoIpLookup: function (callback) {
      fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => callback(data && data.country_code ? data.country_code : "US"))
        .catch(() => callback("US"));
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    separateDialCode: false,
    nationalMode: false,
    formatOnDisplay: true,
    autoPlaceholder: "polite",
    customPlaceholder: (placeholder) => "e.g. " + placeholder,
  });

  phoneInput.iti = iti;

  // Open upward when there's more space above than below
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

  phoneInput.addEventListener('countrychange', function () {
    // you can read the selected country if needed
    // const countryData = iti.getSelectedCountryData();
  });

  // Simple validity styling
  phoneInput.addEventListener('input', function () {
    if (iti.isValidNumber()) {
      phoneInput.classList.remove('border-red-500');
      phoneInput.classList.add('border-green-500');
    } else {
      phoneInput.classList.remove('border-green-500');
      phoneInput.classList.add('border-red-500');
    }
  });

  const nextButton = document.getElementById('nextStep14');
  if (nextButton) {
    nextButton.addEventListener('click', function () {
      if (!iti.isValidNumber()) {
        alert('Please enter a valid phone number');
        return;
      }
      const fullNumber = iti.getNumber();
      const nationalNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
      const countryData = iti.getSelectedCountryData();

      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.phone_number = fullNumber;
      expats.phone_country = countryData.name;
      expats.phone_country_code = countryData.dialCode;
      localStorage.setItem('expats', JSON.stringify(expats));
    });
  }
});
</script>
<style>
/* Keep the input filling width */
.iti { width: 100%; }

/* Don't let any custom CSS change the flag sprite sizing/positioning */
.iti__flag,
.iti__flag.iti__be,
.iti__flag.iti__us, /* (any class) — selector kept generic */
.iti__selected-flag .iti__flag {
  background-repeat: no-repeat !important;
  background-size: auto !important;    /* critical: let the library control sizes */
}

/* Force-correct sprite URL (fixes wrong/blank flags if relative path breaks) */
.iti__flag {
  background-image: url('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags.png') !important;
}

/* Hi-dpi screens use the @2x sheet */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .iti__flag {
    background-image: url('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/img/flags@2x.png') !important;
  }
}

/* Keep flag area aligned nicely inside your rounded input */
.iti__flag-container {
  position: absolute;
  inset: 0 auto 0 0;
  padding: 0 8px;
  display: flex;
  align-items: center;
}

/* Selected flag button look */
.iti__selected-flag {
  padding: 0 6px 0 8px;
  background: transparent;
  border-radius: 3px 0 0 3px;
  cursor: pointer;
  display: flex;
  align-items: center;
}

/* Arrow styling */
.iti__arrow {
  margin-left: 6px;
  width: 0; height: 0;
  border-left: 3px solid transparent;
  border-right: 3px solid transparent;
  border-top: 4px solid #666;
  transition: border-top-color 0.2s;
}
.iti__selected-flag:hover .iti__arrow { border-top-color: #333; }

/* Country list base (downward by default) */
.iti__country-list {
  position: absolute;
  z-index: 1000;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  max-height: 260px;
  overflow-y: auto;
  width: 320px;
  top: 100%;
  left: 0;
  margin-top: 6px;
}

/* When opening upwards */
.iti__country-list--up {
  top: auto !important;
  bottom: 100% !important;
  margin-top: 0 !important;
  margin-bottom: 6px !important;
}

/* Country items */
.iti__country {
  padding: 10px 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background-color 0.15s, transform 0.05s;
}
.iti__country:hover { background-color: #f8fafc; }
.iti__country.iti__highlight { background-color: #e9f3ff; }

/* Dial code style */
.iti__dial-code { color: #64748b; font-size: 0.9em; }

/* Input left padding to make room for the flag */
#phone_number_input { padding-left: 80px !important; }

/* Mobile tweaks */
@media (max-width: 640px) {
  .iti__country-list { width: 280px; }
  #phone_number_input { padding-left: 72px !important; }
}
</style>
