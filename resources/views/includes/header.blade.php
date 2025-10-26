<!DOCTYPE html>
<html lang="en">
<head>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CDN (Free version) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<link rel="stlesheet" href="css/styles.css">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- International Telephone Input -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <!-- Google Translate widget script -->
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.3s ease-out',
            'slide-down': 'slideDown 0.3s ease-out',
            'bounce-subtle': 'bounceSubtle 0.6s ease-out',
            'glow': 'glow 2s ease-in-out infinite alternate',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(-10px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            slideDown: {
              '0%': { opacity: '0', transform: 'translateY(-20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            bounceSubtle: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-5px)' }
            },
            glow: {
              '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
              '100%': { boxShadow: '0 0 30px rgba(59, 130, 246, 0.8)' }
            }
          }
        }
      }
    }
  </script>
  <style>
  /* hide the top banner frame Google injects */
  iframe.goog-te-banner-frame {
    display: none !important;
  }
  body > .skiptranslate {
    display: none !important;
  }
  html {
    margin-top: 0 !important;
  }

  /* hide the inline toolbar / popup */
  .goog-te-gadget {
    height: 0 !important;
    overflow: hidden !important;
  }
  .VIpgJd-ZVi9od-ORHb, 
  .VIpgJd-ZVi9od-aZ2wEe-wOHMyf, /* common toolbar wrapper */
  .VIpgJd-ZVi9od-ORHb-OEVmcd,
  .VIpgJd-ZVi9od-ORHb-hFsbo,
  .VIpgJd-ZVi9od-l4eHX-hSRGPd {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
  }
</style>
<style>
  /* Kill the top banner and any wrapper space */
  iframe.goog-te-banner-frame,
  .goog-te-banner-frame { display: none !important; }

  /* Google wraps the page with a div.skiptranslate that still takes space */
  body > .skiptranslate {
    display: none !important;
    height: 0 !important;
    overflow: hidden !important;
  }

  /* Google sometimes adds a top margin to html */
  html { margin-top: 0 !important; }

  /* Google sometimes sets body { top: 40px } */
  body { top: 0 !important; position: static !important; }

  /* Optional: hide floating tooltip/mini-toolbar */
  #goog-gt-tt, .goog-te-balloon-frame, .goog-te-gadget { display: none !important; }
</style>

<!-- International Telephone Input Custom Styles -->
<style>
/* Custom styling for intl-tel-input to match the design */
.iti {
  width: 100%;
  position: relative;
}

.iti__flag-container {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 0 8px;
  display: flex;
  align-items: center;
  z-index: 1;
}

.iti__selected-flag {
  padding: 0 6px 0 8px;
  background: transparent;
  border-radius: 3px 0 0 3px;
  cursor: pointer;
  display: flex;
  align-items: center;
  transition: background-color 0.2s;
}

.iti__selected-flag:hover {
  background-color: rgba(59, 130, 246, 0.1);
}

.iti__arrow {
  margin-left: 6px;
  width: 0;
  height: 0;
  border-left: 3px solid transparent;
  border-right: 3px solid transparent;
  border-top: 4px solid #666;
  transition: border-top-color 0.2s;
}

.iti__selected-flag:hover .iti__arrow {
  border-top-color: #333;
}

.iti__country-list {
  position: absolute;
  z-index: 1000;
  background: white;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  max-height: 200px;
  overflow-y: auto;
  width: 320px;
  top: 100%;
  left: 0;
  margin-top: 4px;
}

.iti__country {
  padding: 10px 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  transition: background-color 0.2s;
  border-radius: 4px;
  margin: 2px 4px;
}

.iti__country:hover {
  background-color: #f3f4f6;
}

.iti__country.iti__highlight {
  background-color: #eff6ff;
}

.iti__flag {
  margin-right: 8px;
  width: 20px;
  height: 15px;
  background-size: cover;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.iti__country-name {
  flex: 1;
  font-size: 14px;
  color: #374151;
}

.iti__dial-code {
  color: #6b7280;
  font-size: 13px;
  font-weight: 500;
}

/* Input field styling */
.iti input[type="tel"] {
  padding-left: 80px !important;
  border-radius: 9999px !important;
  border: 1px solid #d1d5db !important;
  transition: all 0.2s ease;
}

.iti input[type="tel"]:focus {
  outline: none !important;
  ring: 2px !important;
  ring-color: #3b82f6 !important;
  border-color: #3b82f6 !important;
}

.iti input[type="tel"].border-red-500 {
  border-color: #ef4444 !important;
}

.iti input[type="tel"].border-green-500 {
  border-color: #10b981 !important;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .iti__country-list {
    width: 280px;
  }

  .iti input[type="tel"] {
    padding-left: 70px !important;
  }
}

/* ============================================
   📱 MOBILE OPTIMIZATIONS FOR SIGNUP POPUP
   ============================================ */

/* Touch-friendly interactive elements */
@media (max-width: 640px) {
  /* Ensure all buttons are touch-friendly (min 44x44px) */
  #signupPopup button:not(#closePopup) {
    min-height: 44px;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
  }
  
  /* Full-width buttons on mobile for easier tapping */
  #signupPopup button[id^="nextStep"],
  #signupPopup button[id^="backToStep"] {
    width: 100%;
  }
  
  /* Slightly larger text on mobile for better readability */
  #signupPopup input,
  #signupPopup select,
  #signupPopup textarea {
    font-size: 16px; /* Prevents zoom on iOS */
  }
}

/* Smooth transitions for popup */
#signupPopup {
  transition: opacity 0.3s ease-in-out;
}

#signupPopup:not(.hidden) {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Smooth height adaptation */
#signupPopup > div {
  transition: all 0.3s ease-in-out;
}

</style>
<style>
/* ============================================
   🎯 WIZARD NAVIGATION BUTTONS - STANDARDIZED
   ============================================ */

/* Container pour les boutons de navigation */
.wizard-nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  margin-top: 2rem;
  padding: 1rem 0;
}

/* Bouton Back standardisé */
.nav-btn-back {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  color: white;
  border: none;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.nav-btn-back svg {
  width: 1.25rem;
  height: 1.25rem;
  transition: transform 0.3s ease;
}

.nav-btn-back:hover {
  background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  transform: translateY(-2px);
}

.nav-btn-back:hover svg {
  transform: translateX(-3px);
}

.nav-btn-back:active {
  transform: translateY(0);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Bouton Next standardisé */
.nav-btn-next {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  color: white;
  border: none;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
}

.nav-btn-next svg {
  width: 1.25rem;
  height: 1.25rem;
  transition: transform 0.3s ease;
}

.nav-btn-next:hover {
  background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
  box-shadow: 0 6px 12px rgba(59, 130, 246, 0.4);
  transform: translateY(-2px);
}

.nav-btn-next:hover svg {
  transform: translateX(3px);
}

.nav-btn-next:active {
  transform: translateY(0);
  box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
}

/* État désactivé */
.nav-btn-next:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
  box-shadow: none;
  pointer-events: none;
}

/* Responsive - Mobile */
@media (max-width: 640px) {
  .wizard-nav-container {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    padding: 1rem;
    box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
    z-index: 50;
    gap: 0.75rem;
  }

  .nav-btn-back,
  .nav-btn-next {
    flex: 1;
    justify-content: center;
    padding: 0.875rem 1rem;
    font-size: 0.8125rem;
  }

  .nav-btn-back svg,
  .nav-btn-next svg {
    width: 1rem;
    height: 1rem;
  }

  /* Ajouter du padding en bas pour éviter que le contenu soit masqué */
  #signupPopup .step-content {
    padding-bottom: 6rem;
  }
}

/* Animations douces */
@keyframes buttonEnable {
  0% { transform: scale(0.95); opacity: 0.7; }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); opacity: 1; }
}

.nav-btn-next:not(:disabled) {
  animation: buttonEnable 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
</style>
{{-- keep these 2 lines somewhere globally once --}}
<style>[x-cloak]{display:none !important}</style>
<script src="https://unpkg.com/alpinejs@3.x.x" defer></script>
<script>
  // Re-apply fixes because Google can re-inject on language change
  (function fixGoogleTranslateGap() {
    function zap() {
      // remove banner iframe if present
      const banner = document.querySelector('iframe.goog-te-banner-frame');
      if (banner && banner.parentNode) banner.parentNode.removeChild(banner);

      // hide wrapper + reset spacing
      const wrapper = document.querySelector('body > .skiptranslate');
      if (wrapper) {
        wrapper.style.display = 'none';
        wrapper.style.height = '0px';
        wrapper.style.overflow = 'hidden';
      }
      document.documentElement.style.marginTop = '0px';
      document.body.style.top = '0px';
      document.body.style.position = 'static';
    }

    // run now and a few times after (GT re-applies on change)
    zap();
    let n = 0;
    const id = setInterval(() => {
      zap();
      if (++n > 20) clearInterval(id); // ~4s total
    }, 200);

    // also on resize/orientation changes
    window.addEventListener('resize', zap);
  })();
</script>


</head>
@php
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings->legal_info ?? [];
@endphp

@php 
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp
<body class="min-h-screen bg-white">
<!-- //For showuing toast meassages across plateform -->
@if (session('success'))
    <script>
        toastr.success('{{ session('success') }}', 'Success');
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error('{{ session('error') }}', 'Error');
    </script>
@endif
<!-- Navbar -->
<nav class="top-0 z-50 border-b border-white/20 shadow-xl">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">

      <!-- Logo -->
   <div class="hidden lg:flex items-center space-x-3 group">
  <div class="relative">
    <div class="rounded-xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
  </div>
  <div class="flex items-center h-full">
  <a href="/">
    <img src="/images/headerlogos.png" alt="Logo" class="w-25 h-auto max-h-14 object-contain" />
  </a>
</div>

</div>

      <!-- Desktop Buttons -->
     
<div class="hidden lg:flex items-center space-x-3 group">
  <button onclick="openHelpPopup()" class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover-glow transform hover:scale-105 shadow-lg">
  <span class="flex items-center space-x-2">
    <i class="fas fa-lock text-white-600 text-xl"></i>
    <span>Request Help</span>
  </span>
</button>








<div id="travailleursProtectionSocialeSubSubcategoriesPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">

    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <div class="flex items-center">
        <button onclick="goBackToTravailleursProtectionSocialeSubcategories()" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors" aria-label="Back">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Travailleurs & Freelances - Protection sociale</h2>
      </div>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Close">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Sub-Subcategories Grid -->
    <div class="p-6 pt-2">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Autres protections sociales </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-yellow-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Je cherche une assurance invalidité freelance </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

       
        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-peach-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Je veux une assurance retraite internationale </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- Travailleurs Trouver un emploi ou une mission Sub-Subcategories Popup -->
<div id="travailleursTrouverEmploiSubSubcategoriesPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
    <!-- Header -->
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <div class="flex items-center">
        <button onclick="goBackToTravailleursTrouverEmploiSubcategories()" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors" aria-label="Back">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Travailleurs & Freelances - Trouver un emploi ou une mission</h2>
      </div>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Close">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Sub-Subcategories Grid -->
    <div class="p-6 pt-2">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-green-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Autres recherches d’emploi ou missions </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Je cherche des agences de recrutement </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

    

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-purple-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Je veux trouver des missions freelance en ligne </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Travailleurs Visa et autorisations de travail Sub-Subcategories Popup -->
<div id="travailleursVisaAutorisationsSubSubcategoriesPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
    <!-- Header -->
    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-100 p-6 flex items-center justify-between">
      <div class="flex items-center">
        <button onclick="goBackToTravailleursVisaAutorisationsSubcategories()" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors" aria-label="Back">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="15,18 9,12 15,6"></polyline>
          </svg>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Travailleurs & Freelances - Visa et autorisations de travail</h2>
      </div>
      <button onclick="closeAllPopups()" class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Close">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <!-- Sub-Subcategories Grid -->
    <div class="p-6 pt-2">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-purple-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Autres démarches de visas et permis </a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>


        <div class="category-card bg-white rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group">
          <div class="w-14 h-14 bg-cyan-200 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform"></div>
          <div class="flex-grow font-semibold text-gray-800">
           <a href="request-for-help.php"> Je veux obtenir une carte professionnelle locale</a></div>
          <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>






        
<!-- SOS Button -->
<a href="http://sos-expat.com/" 
   target="_blank"
   class="nav-button bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 animate-glow transform hover:scale-105 shadow-lg">
  <span class="flex items-center space-x-2">
    	<i class="fas fa-phone-alt text-white-600 text-xl"></i>
    <span>S.O.S</span>
  </span>
</a>

<!-- Popup Modal -->
<div id="sos-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-4 hidden">
  <div class="bg-white rounded-xl p-6 shadow-2xl max-w-md w-full text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-3">Coming Soon</h2>
    <p class="text-gray-600 italic mb-4 leading-relaxed">
      Service available in the coming weeks.<br>
    </p>
    <button onclick="closeComingSoonPopup()" 
            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md transition-all duration-200">
      Close
    </button>
  </div>
</div>

      @if(Auth::check() && Auth::user()->user_role != 'service_provider' || Auth::check() === false)
        <a href="/become-service-provider" class="nav-button border-2 border-gradient-to-r from-purple-500 to-blue-500 bg-gradient-to-r from-purple-50 to-blue-50 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-3 rounded-full text-sm font-semibold hover:bg-gradient-to-r hover:from-purple-100 hover:to-blue-100 transition-all duration-300 transform hover:scale-105 shadow-lg border-blue-300">
          <span class="flex items-center space-x-2 text-blue-600">
            <!-- Simple Icon -->
            <i class="fas fa-file-signature text-blue-600 text-2xl"></i>
            <span>Become a Provider</span>
          </span>
        </a>
      @endif
      </div>

      <!-- Desktop Right Side -->
      <div class="hidden lg:flex items-center space-x-6">
<!-- Language Selector with Google Translate -->
<div class="relative group inline-block">
  <button id="langBtn" type="button"
    class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-white shadow hover:bg-gray-50 transition">
    <div class="w-6 h-6 rounded-full overflow-hidden border border-gray-300">
      <img id="langFlag" src="https://flagcdn.com/24x18/us.png" alt="EN" class="w-full h-full object-cover">
    </div>
    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <ul id="langMenu"
      class="absolute right-0 hidden bg-white shadow-lg border border-gray-200 rounded-lg mt-2 w-40 z-20">
    <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
      <img src="https://flagcdn.com/20x15/us.png" class="w-5 h-4 mr-2"> English
    </li>
    <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
      <img src="https://flagcdn.com/20x15/fr.png" class="w-5 h-4 mr-2"> Français
    </li>
    <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
        class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
      <img src="https://flagcdn.com/20x15/de.png" class="w-5 h-4 mr-2"> Deutsch
    </li>
  </ul>
</div>

<!-- Hidden Google Translate widget -->
<div id="google_translate_element" class="hidden"></div>
<!-- keep your existing HTML as-is -->



  <script type="text/javascript">
        // Cookie helpers
        function domains() {
            const host = location.hostname;
            const naked = host.replace(/^www\./, '');
            const list = [undefined];
            if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) list.push(naked);
            if (naked !== host) list.push(host);
            return list;
        }
        function setCookie(name, value, days = 365) {
            const exp = new Date(Date.now() + days * 864e5).toUTCString();
            domains().forEach(d => {
                document.cookie = `${name}=${value}; expires=${exp}; path=/` + (d ? `; domain=${d}` : '');
            });
        }
        function clearCookie(name) {
            const past = 'Thu, 01 Jan 1970 00:00:01 GMT';
            domains().forEach(d => {
                document.cookie = `${name}=; expires=${past}; path=/` + (d ? `; domain=${d}` : '');
            });
        }
        function alignCookiesFor(lang) {
            if (!lang || lang === 'en') {
                clearCookie('googtrans');
                clearCookie('googtransopt');
            } else {
                const val = `/auto/${lang}`;
                setCookie('googtrans', val);
                setCookie('googtransopt', val);
            }
        }

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,fr,de',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        // Load Google Translate script
        (function() {
            var gt = document.createElement('script');
            gt.type = 'text/javascript';
            gt.async = true;
            gt.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gt, s);
        })();

        // Language selector functionality
        const langBtn = document.getElementById('langBtn');
        const langMenu = document.getElementById('langMenu');
        const langFlag = document.getElementById('langFlag');

        // Toggle dropdown
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            langMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            langMenu.classList.add('hidden');
        });

        // Handle language selection
        langMenu.addEventListener('click', function(e) {
            if (e.target.closest('li')) {
                const li = e.target.closest('li');
                const lang = li.getAttribute('data-lang');
                const flag = li.getAttribute('data-flag');
                setLanguage(lang, flag);
                langMenu.classList.add('hidden');
            }
        });

        function setLanguage(lang, flag) {
            // Save to localStorage
            localStorage.setItem('selectedLang', lang);
            localStorage.setItem('selectedFlag', flag);
            // Update flag
            langFlag.src = flag;
            // Align cookies
            alignCookiesFor(lang);
            // Set hash to trigger translation
            if (lang === 'en') {
                window.location.hash = '';
            } else {
                window.location.hash = 'googtrans(en|' + lang + ')';
            }
            // Try to set select and reload
            waitForSelect(select => {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
                setTimeout(() => location.reload(), 100);
            }, 2000);
            // If select not found within timeout, reload anyway
            setTimeout(() => {
                if (!document.querySelector('#google_translate_element select')) {
                    location.reload();
                }
            }, 2100);
            console.log('Translation triggered for:', lang);
        }

        // Wait for select element
        function waitForSelect(callback, timeout = 5000) {
            const start = Date.now();
            const check = () => {
                const select = document.querySelector('#google_translate_element select.goog-te-combo');
                if (select) {
                    callback(select);
                } else if (Date.now() - start < timeout) {
                    setTimeout(check, 100);
                } else {
                    // Fallback to hash
                    const savedLang = localStorage.getItem('selectedLang') || 'en';
                    if (savedLang !== 'en') {
                        window.location.hash = 'googtrans(en|' + savedLang + ')';
                    }
                }
            };
            check();
        }

        // Initialize with default language
        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('selectedLang') || 'en';
            const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
            langFlag.src = savedFlag;
            alignCookiesFor(savedLang);
            // Set hash immediately for saved language if not English
            if (savedLang !== 'en') {
                window.location.hash = 'googtrans(en|' + savedLang + ')';
                // Also try to set select if available
                waitForSelect(select => {
                    select.value = savedLang;
                    select.dispatchEvent(new Event('change'));
                });
            }
        });
    </script>







 <!-- Auth Buttons -->
<div class="flex items-center space-x-3">
 
@php 
  $isActive = Auth::check();
@endphp

@if(!$isActive)
  {{-- ===== YOUR EXACT CODE (unchanged) ===== --}}
  <a href="/login" class="flex items-center space-x-2 px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 group">
   <i class="fas fa-user mr-2 text-lg text-blue-600"></i>
    <span class="font-medium text-blue-600"> Log in</span>
  </a>

  <button id="signupBtn" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center space-x-2">
    <i class="fas fa-user-plus mr-2 text-lg "></i>
    <span>Sign Up</span>
  </button>

@else
@php
    $user = Auth::user();
    $provider = $user?->serviceProvider;

    // Collect possible image sources
    $profilePhoto = $provider?->profile_photo ? asset($provider->profile_photo) : null;
    $avatar   = $user?->avatar ? asset($user->avatar) : null;
    $default      = asset('images/helpexpat.png');

    // Build CSS background-image fallback chain
    $backgroundImage = "url('{$profilePhoto}'), url('{$avatar}'), url('{$default}')";
@endphp



  {{-- dropdown lives in its own wrapper so it won't affect your buttons layout --}}
  <div class="relative" x-data="{ open:false }">
    <!-- Trigger -->
    <button 
      type="button"
      @click="open = !open"
      @keydown.escape.window="open = false"
      class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100"
      aria-haspopup="menu"
      :aria-expanded="open.toString()"
    >
      <div class="w-8 h-8 rounded-full border bg-center bg-cover"
     style="background-image: {{ $backgroundImage }};">
</div>
      <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">{{ $user->name }}</span>
      <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
    </button>

    <!-- Menu (hidden by default, even if Alpine fails) -->
    <div
      x-cloak
      x-show="open"
      x-transition
      @click.outside="open = false"
      @keydown.escape.window="open = false"
      style="display:none"
      class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50"
      role="menu"
    >
      <div class="p-3 flex items-center gap-3 border-b">
          <div class="w-8 h-8 rounded-full border bg-center bg-cover"
     style="background-image: {{ $backgroundImage }};">
</div>
        <div class="min-w-0">
          <div id="header-user-fullname" class="font-semibold truncate mb-1">{{ $user->name }}</div>
          @if($user?->email)
            @php
            $rawRole = (string)($user->user_role ?? '');
            $key = strtolower(str_replace(['-', ' '], '_', $rawRole));

            $roles = [
              // Admin → bold, attention color
              'admin' => [
                'label' => 'Admin',
                'cls'   => 'bg-rose-100 text-rose-700 ring-1 ring-rose-600/20',
                'icon'  => 'fa-user-shield',
              ],
              // Service Provider → productive/“action” color
              'service_provider' => [
                'label' => 'Service Provider',
                'cls'   => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20',
                'icon'  => 'fa-toolbox',
              ],
              'provider' => [
                'label' => 'Service Provider',
                'cls'   => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20',
                'icon'  => 'fa-toolbox',
              ],
              // Service Requester → trustworthy/communication color
              'service_requester' => [
                'label' => 'Service Requester',
                'cls'   => 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-600/20',
                'icon'  => 'fa-hand-holding',
              ],
              'requester' => [
                'label' => 'Service Requester',
                'cls'   => 'bg-indigo-100 text-indigo-700 ring-1 ring-indigo-600/20',
                'icon'  => 'fa-hand-holding',
              ],
            ];

            $role = $roles[$key] ?? [
              'label' => ucfirst($rawRole ?: 'User'),
              'cls'   => 'bg-gray-100 text-gray-700 ring-1 ring-gray-400/20',
              'icon'  => 'fa-user',
            ];
          @endphp

          <div class="text-xs">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-medium {{ $role['cls'] }} truncate max-w-[12rem]">
              <i class="fas {{ $role['icon'] }} text-[11px]"></i>
              {{ $role['label'] }}
            </span>
          </div>

          @endif
        </div>
      </div>

      <nav class="py-1">
        <a href="{{ Route::has('dashboard') ? route('dashboard') : '/dashboard' }}" class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" role="menuitem">
          <i class="fas fa-gauge"></i>
          <span>Dashboard</span>
        </a>
       
        <form method="POST" action="{{ route('logout') }}" class="mt-1">
          @csrf
          <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" role="menuitem">
            <i class="fas fa-right-from-bracket"></i>
            <span>Log out</span>
          </button>
        </form>
      </nav>
    </div>
  </div>
@endif
</div>

<!-- Popup Overlay -->
<!-- 
============================================
🎯 POPUP SIGNUP - MOBILE FIRST OPTIMIZED
============================================
✨ Responsive adaptatif selon taille écran
📱 Mobile: padding réduit pour plus d'espace
💻 Desktop: identique à l'original
🔄 Hauteur adaptative selon contenu du step
============================================
-->
<div id="signupPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-2 sm:p-4 md:p-6 hidden z-50 overflow-y-auto py-4 sm:py-8">
  <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 max-w-3xl w-full relative shadow-lg my-auto">
    <!-- Close button - Optimisé pour touch sur mobile -->
    <button id="closePopup" class="absolute top-2 sm:top-4 right-2 sm:right-4 w-10 h-10 sm:w-auto sm:h-auto flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 active:bg-gray-200 rounded-full sm:rounded-none text-xl sm:text-2xl font-bold transition-all active:scale-95" aria-label="Close signup form">&times;</button>
		<!-- Step 1 -->
		@include('includes.provider.choose_step')
    <!-- Step 2 -->
    @include('includes.provider.native_language')

    <!-- Step 3 -->
    @include('includes.provider.spoken_language')

    <!-- Step 4 -->
		@include('includes.provider.provider_services')

    <!-- Step 5: Country Selection - MODERN 2025/2026 -->
    <div id="step5" class="hidden">
      
      <!-- Header -->
      <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center gap-3 mb-3">
          <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg animate-pulse-slow">
            <span class="text-2xl">🌍</span>
          </div>
          <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 bg-clip-text text-transparent">
            In which country do you live?
          </h2>
        </div>
        <p class="text-gray-600 text-sm sm:text-base font-medium">
          Select your country of residence
        </p>
      </div>

      <!-- Country Select -->
      <div class="max-w-2xl mx-auto mb-8">
        <div class="relative">
          <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-2xl pointer-events-none">
            🌎
          </div>
          <select id="location-input" name="location" class="w-full border-2 border-purple-200 rounded-2xl pl-14 pr-5 py-4 text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all appearance-none cursor-pointer text-lg font-medium">
            <option value="" disabled selected>Choose your country...</option>
            @foreach($countries as $country)
              <option value="{{ $country->country }}">{{ $country->country }}</option>
            @endforeach
          </select>
          <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </div>
        
        <!-- Error message -->
        <div id="countryError" class="hidden mt-2 text-red-600 text-sm font-semibold flex items-center gap-2">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          <span>Please select your country to continue</span>
        </div>
        
        <!-- Success message -->
        <div id="countrySuccess" class="hidden mt-2 text-green-600 text-sm font-semibold flex items-center gap-2">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span>Country selected ✓</span>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="flex justify-between items-center gap-4">
        <button id="backToStep4" class="flex items-center gap-2 px-6 py-3 text-purple-600 font-semibold hover:bg-purple-50 rounded-lg transition-all group">
          <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
          <span>Back</span>
        </button>
        
        <button id="nextStep5" class="flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all group">
          <span>Continue</span>
          <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </button>
      </div>
    </div>

    <style>
    /* Modern Country Select Styles */
    #location-input:hover {
      border-color: #a855f7;
      box-shadow: 0 4px 12px rgba(168, 85, 247, 0.15);
    }
    
    #location-input:focus {
      box-shadow: 0 8px 20px rgba(168, 85, 247, 0.25);
    }
    
    #location-input option {
      padding: 12px;
      font-size: 16px;
    }
    
    @keyframes pulse-slow {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    
    .animate-pulse-slow {
      animation: pulse-slow 3s ease-in-out infinite;
    }
    </style>

    <script>
    // Step 5 Validation & UX
    (function() {
      'use strict';
      
      document.addEventListener('DOMContentLoaded', function() {
        const locationInput = document.getElementById('location-input');
        const nextBtn = document.getElementById('nextStep5');
        const countryError = document.getElementById('countryError');
        const countrySuccess = document.getElementById('countrySuccess');
        
        if (!locationInput || !nextBtn) return;
        
        // Show success when country selected
        locationInput.addEventListener('change', function() {
          if (this.value) {
            countryError.classList.add('hidden');
            countrySuccess.classList.remove('hidden');
            
            // Save to localStorage
            const expats = JSON.parse(localStorage.getItem('expats') || '{}');
            expats.country = this.value;
            localStorage.setItem('expats', JSON.stringify(expats));
          }
        });
        
        // Restore saved country
        const expats = JSON.parse(localStorage.getItem('expats') || '{}');
        if (expats.country) {
          locationInput.value = expats.country;
          countrySuccess.classList.remove('hidden');
        }
        
        // Validation on Next button
        nextBtn.addEventListener('click', function(e) {
          if (!locationInput.value) {
            e.stopImmediatePropagation();
            e.preventDefault();
            
            // Show error
            countryError.classList.remove('hidden');
            countrySuccess.classList.add('hidden');
            
            // Shake animation
            locationInput.style.animation = 'shake 0.5s';
            setTimeout(() => {
              locationInput.style.animation = '';
            }, 500);
            
            // Focus the select
            locationInput.focus();
            
            return false;
          }
        }, true);
      });
    })();
    </script>
    
    <style>
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }
    </style>

    <!-- Step 6: Operational Countries -->


 		<!-- Step 6 -->
		@include('includes.provider.operational_countries', ['countries' => $countries])
 
    <!-- Step 7: Special Status -->
    @include('includes.provider.special_status')
   
    <!-- Step 8: Speak Online or In Person -->
    @include('includes.provider.communication_preference')

    <!-- Step 9: Profile Description -->
    @include('includes.provider.profile_description')

   <!-- Step 10: Profile Picture -->
		@include('includes.provider.profile_picture')

		<!-- Step 11: Identity Documents -->
		@include('includes.provider.identity_documents')

		<!-- Step 12: First and Last Name -->
		@include('includes.provider.first_last_name')

		<!-- Step 13: Email and Phone Number -->
		@include('includes.provider.email')

		<!-- Step 14: Password Creation -->
		@include('includes.provider.verify_email')

		<!-- Step 15: Phone Number -->
		@include('includes.provider.phone_number')
		


		<!-- Step 16: Success Confirmation -->
		<div id="step16" class="hidden space-y-6 text-center">
			<h2 class="text-blue-900 font-extrabold text-2xl">
YOUR PROVIDER ACCOUNT IS CREATED</h2>
			<p class="text-blue-800 font-semibold text-md">YOU ARE OFFICIALLY A ULYSSE</p>
			<p class="text-gray-600">Go check out the service requests in your area now</p>

			<button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full">
			<a href="{{ route('ongoing-requests') }}"> CURRENT SERVICE REQUESTS </a></button>

			<p class="text-gray-600 text-sm mt-2">You can boost your profile to have more jobs to do</p>

			<button class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-bold px-6 py-2 rounded-full">
				I BOOTS MY PROFILE TO BE AMONG THE FIRST SERVICE PROVIDERS
			</button>
		</div>

	</div>
		<!-- Mobile Controls -->
		<div class="lg:hidden flex items-center space-x-2">
			<div class="w-8 h-8 rounded-full overflow-hidden border-2 border-white shadow-sm">
				<img src="https://flagcdn.com/24x18/fr.png" alt="FR" class="w-full h-full object-cover" />
			</div>
			<button id="menu-toggle" class="p-2 rounded-lg bg-blue-600 hover:bg-sky-400 transition-colors shadow">

				<svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
			</button>
		</div>
	</div>
</div>

	<!-- Mobile Header -->
	<div class="lg:hidden fixed top-0 left-0 w-full bg-white z-50 flex items-center justify-between  py-2 shadow-md">
		<!-- Logo -->
	<a href="/index.php">
		<img src="/images/headerlogo.png" alt="ULIXAI Logo" class="w-10 h-10 object-contain" />
	</a>


  <!-- Request Help Button -->
   <button id="mobileSearchButton" onclick="openHelpPopup()" class="nav-button bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full text-sm font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover-glow transform hover:scale-105 shadow-lg">
    <span class="flex items-center space-x-2">
      <i class="fas fa-lock text-white-600 text-xl"></i>
      <span>Request Help</span>
    </span>
</button>

  <!-- Hamburger -->
<button id="menu-toggle-top" class="p-2 rounded-lg hover:bg-white/50 transition-colors">
  <!-- Hamburger Icon -->
  <svg class="icon-hamburger w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
  </svg>
  <!-- X Icon -->
  <svg class="icon-close w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
  </svg>
</button>

</div>

<!-- Mobile Dropdown Menu -->
<div id="mobile-menu" class="lg:hidden fixed top-[64px] left-0 w-full bg-white z-40 shadow-md hidden px-6 py-4 space-y-4 animate-slide-down">

  <!-- Close (X) Button for mobile menu -->
  <div class="flex justify-end mb-2">
    <button id="mobileMenuCloseBtn" class="p-2 rounded-full hover:bg-blue-200 focus:outline-none" aria-label="Close menu">
      <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <a href="/become-service-provider" class="block text-gray-800 text-base font-semibold hover:text-blue-600">Become a provider</a>
  <a href="/login" class="block text-gray-800 text-base font-semibold hover:text-blue-600">Log in</a>
  <a href="/signup"class="block text-gray-800 text-base font-semibold hover:text-blue-600">Sign up</a>
  <a href="/affiliate" class="block text-gray-800 text-base font-semibold hover:text-blue-600">Affiliate Program</a> <!-- New link added here -->


<!-- Hidden Google widget host -->
<div id="google_translate_element" class="hidden"></div>

<!-- Checkbox-driven mobile-friendly dropdown -->
<div class="relative w-full sm:w-56">
  <!-- Hidden checkbox controls open/close -->
  <input id="langOpen" type="checkbox" class="peer sr-only" />

  <!-- Toggle button -->
  <label for="langOpen"
         class="flex justify-between items-center w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 bg-white cursor-pointer select-none">
    <span id="languageLabel">Language</span>
    <img id="languageFlag" src="https://flagcdn.com/24x18/us.png" alt="Lang" class="ml-2 w-5 h-4 object-cover" />
  </label>

  <!-- Menu (shown when checkbox is checked) -->
  <ul id="languageMenu"
      class="absolute left-0 right-0 mt-2 bg-white border border-gray-300 rounded-lg shadow-md z-50 hidden peer-checked:block">
    <li data-lang="fr" data-flag="https://flagcdn.com/24x18/fr.png"
        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
      <img src="https://flagcdn.com/24x18/fr.png" class="w-5 h-4" /> Français
    </li>
    <li data-lang="en" data-flag="https://flagcdn.com/24x18/us.png"
        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
      <img src="https://flagcdn.com/24x18/us.png" class="w-5 h-4" /> English
    </li>
    <li data-lang="de" data-flag="https://flagcdn.com/24x18/de.png"
        class="px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
      <img src="https://flagcdn.com/24x18/de.png" class="w-5 h-4" /> Deutsch
    </li>
  </ul>
</div>

<script>
// Cookie helpers
function domains() {
  const host = location.hostname;
  const naked = host.replace(/^www\./, '');
  const list = [undefined];
  if (naked && !/^(\d{1,3}\.){3}\d{1,3}$/.test(naked)) list.push(naked);
  if (naked !== host) list.push(host);
  return list;
}
function setCookie(name, value, days = 365) {
  const exp = new Date(Date.now() + days * 864e5).toUTCString();
  domains().forEach(d => {
    document.cookie = `${name}=${value}; expires=${exp}; path=/` + (d ? `; domain=${d}` : '');
  });
}
function clearCookie(name) {
  const past = 'Thu, 01 Jan 1970 00:00:01 GMT';
  domains().forEach(d => {
    document.cookie = `${name}=; expires=${past}; path=/` + (d ? `; domain=${d}` : '');
  });
}
function alignCookiesFor(lang) {
  if (!lang || lang === 'en') {
    clearCookie('googtrans');
    clearCookie('googtransopt');
  } else {
    const val = `/auto/${lang}`;
    setCookie('googtrans', val);
    setCookie('googtransopt', val);
  }
}

(function () {
  const checkbox = document.getElementById('langOpen');
  const menu     = document.getElementById('languageMenu');
  const flag     = document.getElementById('languageFlag');
  const label    = document.getElementById('languageLabel');

  // Apply language (queue if Google select not ready yet)
  let pendingLang = null;
  function applyLanguage(code) {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      // iOS/Safari-safe change event
      const ev = document.createEvent('HTMLEvents');
      ev.initEvent('change', true, true);
      select.dispatchEvent(ev);
      pendingLang = null;
    } else {
      pendingLang = code;
    }
  }

  // Handle item clicks using delegation
  menu.addEventListener('click', function (e) {
    const li = e.target.closest('li[data-lang]');
    if (!li) return;

    const code    = li.dataset.lang;
    const flagUrl = li.dataset.flag;
    const name    = li.textContent.trim();

    // Update UI
    flag.src = flagUrl;
    label.textContent = name;

    // Save to localStorage
    localStorage.setItem('selectedLang', code);
    localStorage.setItem('selectedFlag', flagUrl);

    // Align cookies
    alignCookiesFor(code);

    // Set hash
    if (code === 'en') {
      window.location.hash = '';
    } else {
      window.location.hash = 'googtrans(en|' + code + ')';
    }

    // Try to set select and reload
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = code;
      select.dispatchEvent(new Event('change'));
      setTimeout(() => location.reload(), 100);
    } else {
      // Wait for it
      const start = Date.now();
      (function wait() {
        const sel = document.querySelector('#google_translate_element select.goog-te-combo');
        if (sel) {
          sel.value = code;
          sel.dispatchEvent(new Event('change'));
          setTimeout(() => location.reload(), 100);
        } else if (Date.now() - start < 2000) {
          setTimeout(wait, 100);
        } else {
          setTimeout(() => location.reload(), 100);
        }
      })();
    }

    // Close dropdown by unchecking checkbox
    checkbox.checked = false;
  });

  // Initialize Google Translate
  window.googleTranslateElementInit = function () {
    new google.translate.TranslateElement(
      { pageLanguage: 'en', includedLanguages: 'en,fr,de', autoDisplay: false },
      'google_translate_element'
    );
  };

  // Load Google script once
  if (!document.getElementById('gt-script')) {
    const s = document.createElement('script');
    s.id = 'gt-script';
    s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
    s.async = true;
    document.body.appendChild(s);
  }

  // If user selects before widget is ready, apply later
  const start = Date.now();
  (function waitForSelect() {
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      if (pendingLang) applyLanguage(pendingLang);
      return;
    }
    if (Date.now() - start < 12000) setTimeout(waitForSelect, 200);
  })();

  // Load saved language on page load
  const savedLang = localStorage.getItem('selectedLang') || 'en';
  const savedFlag = localStorage.getItem('selectedFlag') || 'https://flagcdn.com/24x18/us.png';
  const langNames = { en: 'English', fr: 'Français', de: 'Deutsch' };
  flag.src = savedFlag;
  label.textContent = langNames[savedLang] || 'Language';
  // Align cookies
  alignCookiesFor(savedLang);
  // Set hash if not en
  if (savedLang !== 'en') {
    window.location.hash = 'googtrans(en|' + savedLang + ')';
    // Try to set select
    const select = document.querySelector('#google_translate_element select.goog-te-combo');
    if (select) {
      select.value = savedLang;
      select.dispatchEvent(new Event('change'));
    } else {
      // Wait for it
      const start = Date.now();
      (function wait() {
        const sel = document.querySelector('#google_translate_element select.goog-te-combo');
        if (sel) {
          sel.value = savedLang;
          sel.dispatchEvent(new Event('change'));
        } else if (Date.now() - start < 5000) {
          setTimeout(wait, 100);
        }
      })();
    }
  }
})();
</script>

<style>
  /* Hide Google banner & mini-toolbar chrome */
  iframe.goog-te-banner-frame, body > .skiptranslate { display: none !important; }
  html { margin-top: 0 !important; }
  .goog-te-gadget, .VIpgJd-ZVi9od-ORHb { display: none !important; }
</style>

  <!-- SOS Button -->
  <a href="/sos"  class="block w-full text-center bg-red-600 text-white font-semibold py-2 rounded-full shadow hover:bg-red-700 transition">
    <i class="fas fa-phone-alt mr-1"></i> S.O.S
  </a>
</div>

@include('pages.popup')
</nav>
<script>
	function showComingSoonPopup(e) {
		e.preventDefault();
		document.getElementById('sos-popup').classList.remove('hidden');
	}
	function closeComingSoonPopup() {
		document.getElementById('sos-popup').classList.add('hidden');
	}

	document.addEventListener('DOMContentLoaded', function () {
		const popup = document.getElementById('signupPopup');
		const closePopup = document.getElementById('closePopup');
		const signupBtn = document.getElementById('signupBtn');
		const progressText = document.getElementById('progressText');

		const steps = Array.from({ length: 16 }, (_, i) => document.getElementById('step' + (i + 1)));
		let currentStep = 0;

		function showStep(stepIndex) {

      // Skip password step for existing users
  if (stepIndex === 11 && document.querySelector('.user-menu')) { 
    currentStep = 12;
    stepIndex = 12;
  }

  steps.forEach((step, i) => step.classList.toggle('hidden', i !== stepIndex));
  prevBtn.disabled = stepIndex === 0;
  progressBar.value = ((stepIndex + 1) / steps.length) * 100;
  if (stepLabel) stepLabel.textContent = stepLabels[stepIndex] || "";

			steps.forEach((step, i) => step?.classList.toggle('hidden', i !== stepIndex));
			currentStep = stepIndex;
			const progress = ((stepIndex + 1) / steps.length) * 100;
			progressBar.style.width = progress + '%';
			progressText.textContent = `Step ${stepIndex + 1} of ${steps.length}`;
		}

		function validateStep(index) {
			switch(index) {
				case 1: // Step 2 - language selected
					return !!document.querySelector('#step2 .lang-btn.bg-blue-900');
				case 2: // Step 3 - multiple selected
					return document.querySelectorAll('#step3 .lang-btn.bg-blue-900').length > 0;
				case 3: // Step 4 - help icon selected
					return document.querySelectorAll('#step4 .help-icon.ring-4').length > 0;
          	case 4: // Step 9 - text filled
					return document.getElementById('location-input').value.trim().length > 0;
          	case 5: // Step 6 - validate selected countries (at least 2)
          return document.querySelectorAll('#countryList input[type="checkbox"]:checked').length >= 1;
				case 6: // Step 7 - one toggle selected in each group
					return Array.from(document.querySelectorAll('#step7 .special-status-item'));
				case 7: // Step 8 - yes/no selected in each group
					return Array.from(document.querySelectorAll('#step8 .speak-toggle')).every(group =>
						group.querySelector('.bg-green-500')
					);
				case 8: // Step 9 - text filled
					return document.getElementById('profileDescription').value.trim().length > 0;
				case 9: // Step 10 - image uploaded
					return document.getElementById('profileUpload').files.length > 0;
          case 11:
          return document.getElementById('first_name_input').value.trim().length > 0;
           case 12:
          return document.getElementById('email_input').value.trim().length > 0;
          case 13:
            const phoneInput = document.getElementById('phone_number_input');
            if (phoneInput && phoneInput.iti) {
              return phoneInput.iti.isValidNumber();
            }
            return phoneInput && phoneInput.value.trim().length > 0;
          case 14:
          return document.getElementById('otp_input').value.trim().length > 0;
				default:
					return true;
			}
		}

	

		signupBtn?.addEventListener('click', () => {
			popup.classList.remove('hidden');
		});

		closePopup?.addEventListener('click', () => {
			popup.classList.add('hidden');
		});

		popup.addEventListener('click', (e) => {
			if (e.target === popup) popup.classList.add('hidden');
		});

		const stepNavigation = [
			['whiteCardBtn', 1], ['backToStep1', 0], ['nextStep2', 2], ['backToStep2', 1],
			['nextStep3', 3], ['backToStep3', 2], ['nextStep4', 4], ['backToStep4', 3],
			['nextStep5', 5], ['backToStep5', 4], ['nextStep6', 6], ['backToStep6', 5],
			['nextStep7', 7], ['backToStep7', 6], ['nextStep8', 8], ['backToStep8', 7],
			['nextStep9', 9], ['backToStep9', 8], ['nextStep10', 10], ['backToStep10', 9],
			['nextStep11', 11], ['backToStep11', 10], ['nextStep12', 12], ['backToStep12', 11],
			['nextStep13', 13], ['backToStep13', 12], ['nextStep14', 14], ['backToStep14', 13],
			['nextStep15', 15], ['backToStep15', 14]
		];

		stepNavigation.forEach(([btnId, stepIndex]) => {
			document.getElementById(btnId)?.addEventListener('click', () => {
				if (stepIndex > currentStep && !validateStep(currentStep)) {
					alert("Please complete this step before continuing.");
					return;
				}
				showStep(stepIndex);
			});
		});

		document.getElementById('completeSignup')?.addEventListener('click', () => {
			if (!validateStep(currentStep)) {
				alert("Please complete this step before finishing.");
				return;
			}
			showStep(15);
		});

		// Step 2: Language selection
		document.querySelectorAll('#step2 .lang-btn').forEach(btn => {
			btn.addEventListener('click', () => {
				document.querySelectorAll('#step2 .lang-btn').forEach(b => {
					b.classList.remove('bg-blue-900', 'text-white');
					b.classList.add('bg-white', 'text-blue-700');
				});
				btn.classList.remove('bg-white', 'text-blue-700');
				btn.classList.add('bg-blue-900', 'text-white');
        // Get the text/content of the clicked button
        const selectedLanguage = btn.textContent.trim();

        // Get current session object or create new
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.native_language = selectedLanguage;
        localStorage.setItem('expats', JSON.stringify(expats));

			});
		});

		// Step 3: Multiple selection
   let selectedLanguage = [];

document.querySelectorAll('#step3 .lang-btn').forEach(btn => {

  btn.addEventListener('click', () => {
    const lang = btn.textContent.trim();

    const isSelected = btn.classList.contains('bg-blue-900');

    if (isSelected) {
      // Unselect
      btn.classList.remove('bg-blue-900', 'text-white', 'bg-blue-600');
      btn.classList.add('bg-blue-600', 'text-white');

      selectedLanguage = selectedLanguage.filter(item => item !== lang);
    } else {
      // Select
      btn.classList.remove('bg-white', 'text-blue-700', 'bg-blue-600');
      btn.classList.add('bg-blue-900', 'text-white');

      selectedLanguage.push(lang);
    }

    // Store in localStorage
    const expats = JSON.parse(localStorage.getItem('expats')) || {};
    expats.spoken_language = selectedLanguage;
    localStorage.setItem('expats', JSON.stringify(expats));
  });

});

		// Step 4: Help icon toggle
		document.querySelectorAll('#step4 .help-icon').forEach(btn => {
			btn.addEventListener('click', () => {
        // console.log("Button clicked", btn.textContent.trim())
				btn.classList.toggle('ring-4');
				btn.classList.toggle('ring-white');
				btn.classList.toggle('ring-offset-2');
			});
		});

    //Step 5
      const location = document.querySelector('#step5 #location-input');
			if (location) {
        location.addEventListener('change', () => {
          const expats = JSON.parse(localStorage.getItem('expats')) || {};
          expats.location = location.value;
          localStorage.setItem('expats', JSON.stringify(expats));
        });
      }

    //Step 6
      const countryList = document.querySelector('#step6 #countryList');
      if (countryList) {
        countryList.addEventListener('change', () => {
          const selectedCountries = Array.from(
            countryList.querySelectorAll('input[type="checkbox"]:checked')
          ).map(input => input.value);
          const expats = JSON.parse(localStorage.getItem('expats')) || {};
          expats.operational_countries = selectedCountries;
          localStorage.setItem('expats', JSON.stringify(expats));
        });
      }
    
		// Step 7: Toggle logic
		let specialStatus = {};

    document.querySelectorAll('#step7 .status-checkbox').forEach(checkbox => {
      checkbox.addEventListener('change', () => {
        const label = checkbox.dataset.label;
        specialStatus[label] = checkbox.checked;
        // Save to localStorage
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.special_status = specialStatus;
        localStorage.setItem('expats', JSON.stringify(expats));
      });
    });

    
		// Step 8: Speak toggle
    communicationPreference = {};
		document.querySelectorAll('#step8 .speak-toggle').forEach(group => {
			const yesBtn = group.children[0];
			const noBtn = group.children[1];
			[yesBtn, noBtn].forEach(btn => {
				btn.addEventListener('click', () => {
          const label = btn.dataset.label;
					yesBtn.classList.remove('bg-green-500', 'text-white');
					yesBtn.classList.add('bg-white', 'text-green-600');
					noBtn.classList.remove('bg-green-500', 'text-white');
					noBtn.classList.add('bg-white', 'text-green-600');
					btn.classList.remove('bg-white', 'text-green-600');
					btn.classList.add('bg-green-500', 'text-white');
          communicationPreference[label] = btn.textContent === 'Yes' ? 'true' : 'false';
          const expats = JSON.parse(localStorage.getItem('expats')) || {};
          expats.communication_preference = communicationPreference;
          localStorage.setItem('expats', JSON.stringify(expats));
				});
			});
		});

		// Step 9: Character counter
		const textarea = document.getElementById('profileDescription');
		const charCount = document.getElementById('charCount');
		if (textarea && charCount) {
			textarea.addEventListener('input', () => {
				charCount.textContent = textarea.value.length;

        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.profile_description = textarea.value;
        localStorage.setItem('expats', JSON.stringify(expats));
			});
		}


		
		// Step 10: Profile image preview
    const profileUpload = document.getElementById('profileUpload');
    const profilePreview = document.getElementById('profilePreview');
    const profilePlaceholder = document.getElementById('profilePlaceholder');

    if (profileUpload) {
      profileUpload.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            const imageDataUrl = e.target.result;

            // Show preview
            profilePreview.src = imageDataUrl;
            profilePreview.classList.remove('hidden');
            profilePlaceholder.classList.add('hidden');

            // Save to localStorage
            const expats = JSON.parse(localStorage.getItem('expats')) || {};
            expats.profile_image = imageDataUrl; // Store as base64 URL
            localStorage.setItem('expats', JSON.stringify(expats));
          };
          reader.readAsDataURL(file);
        }
      });
    }

    //Step 11: Identity Documents

    //Step:12 Username
    const firstNameInput = document.querySelector('#step12 #first_name_input');
    const lastNameInput = document.querySelector('#step12 #last_name_input');
    const nextStep12 = document.getElementById('nextStep12');

    if (nextStep12) {
      nextStep12.addEventListener('click', () => {
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.first_name = firstNameInput.value.trim();
        expats.last_name = lastNameInput.value.trim();
        localStorage.setItem('expats', JSON.stringify(expats));
      });
    }

    // Step13: Email 
    const emailInput = document.querySelector('#step13 #email_input');
    const nextStep13 = document.getElementById('nextStep13');

    if (nextStep13) {
      nextStep13.addEventListener('click', () => {
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        expats.email = emailInput.value.trim();
        localStorage.setItem('expats', JSON.stringify(expats));

        // createProviderAccount()
      });
    }

    const phoneNumberInput = document.querySelector('#step14 #phone_number_input');
    const nextStep14 = document.getElementById('nextStep14');
    if (nextStep14 && phoneNumberInput) {
      nextStep14.addEventListener('click', () => {
        if (phoneNumberInput.iti) {
          const iti = phoneNumberInput.iti;

          if (iti.isValidNumber()) {
            const fullNumber = iti.getNumber();
            const countryData = iti.getSelectedCountryData();

            const expats = JSON.parse(localStorage.getItem('expats')) || {};
            expats.phone_number = fullNumber;
            expats.phone_country = countryData.name;
            expats.phone_country_code = countryData.dialCode;
            localStorage.setItem('expats', JSON.stringify(expats));
            createProviderAccount();
          } else {
            toastr.error('Please enter a valid phone number');
            return false;
          }
        } else {
          const expats = JSON.parse(localStorage.getItem('expats')) || {};
          expats.phone_number = phoneNumberInput.value.trim();
          localStorage.setItem('expats', JSON.stringify(expats));
          createProviderAccount();
        }
      });
    }

    function createProviderAccount() {
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      const nextBtn = document.getElementById('nextStep14');
      nextBtn.disabled = true;
      nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';

      return fetch('/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: JSON.stringify(expats)
      })
      .then(response => {
        if (!response.ok) throw response;
        return response.json();
      })
      .then(data => {
        toastr.success(data.message || 'Account created successfully!');
        document.getElementById('step14').classList.add('hidden');
        document.getElementById('step15').classList.remove('hidden');
      })
      .catch(async error => {
        let errorMessage = 'Failed to create account. Please try again.';
        try {
          const errData = await error.json();
          errorMessage = errData.message || errorMessage;
        } catch (_) {}
        console.error('Error creating account:', errorMessage);
        toastr.error(errorMessage);
      })
      .finally(() => {
        nextBtn.disabled = false;
        nextBtn.innerHTML = 'Next';
      });
    }




		// Mobile nav toggles
		const toggleButtons = [
			document.getElementById("menu-toggle-top"),
			document.getElementById("menu-toggle")
		];
		const mobileMenu = document.getElementById("mobile-menu");
		const langToggle = document.getElementById("languageToggle");
		const langMenu = document.getElementById("languageMenu");

		// Add close button logic for mobile menu
		const mobileMenuCloseBtn = document.getElementById("mobileMenuCloseBtn");
		if (mobileMenuCloseBtn) {
			mobileMenuCloseBtn.addEventListener("click", () => {
				mobileMenu.classList.add("hidden");
			});
		}

		toggleButtons.forEach(btn => {
			if (btn) btn.addEventListener("click", () => {
				mobileMenu.classList.toggle("hidden");
			});
		});

		if (langToggle) {
			langToggle.addEventListener("click", (e) => {
				e.stopPropagation();
				langMenu.classList.toggle("hidden");
			});
		}

		document.addEventListener("click", (e) => {
			if (langToggle && langMenu && !langToggle.contains(e.target) && !langMenu.contains(e.target)) {
				langMenu.classList.add('hidden');
			}
		});

		// Desktop language dropdown open/close on click
		const desktopLangBtn = document.getElementById('desktopLangBtn');
		const desktopLangMenu = document.getElementById('desktopLangMenu');
		if (desktopLangBtn && desktopLangMenu) {
			desktopLangBtn.addEventListener('click', function (e) {
				e.stopPropagation();
				desktopLangMenu.classList.toggle('hidden');
			});
			// Close dropdown when clicking outside
			document.addEventListener('click', function (e) {
				if (!desktopLangBtn.contains(e.target) && !desktopLangMenu.contains(e.target)) {
					desktopLangMenu.classList.add('hidden');
				}
			});
		}
	});

	// Modal functions
	function openModal() {
		document.getElementById('modal')?.classList.remove('hidden');
	}
	function closeModal() {
		document.getElementById('modal')?.classList.add('hidden');
	}
	function nextStep(stepNumber) {
		document.querySelectorAll('.step-content').forEach(step => step.classList.add('hidden'));
		document.getElementById('step' + stepNumber)?.classList.remove('hidden');
	}
</script>

<script>
  // function openHelpPopup() {
  //   document.getElementById('searchPopup').classList.remove('hidden');
  // }

  // function closeSearchPopup() {
  //   document.getElementById('searchPopup').classList.add('hidden');
  // }

  // Optional: close on ESC key
  document.addEventListener('keydown', function (e) {
    if (e.key === "Escape") closeSearchPopup();
  });

  // Optional: attach close button
  document.addEventListener('DOMContentLoaded', () => {
    const closeBtn = document.getElementById('closeSearchPopupBtn');
    if (closeBtn) {
      closeBtn.addEventListener('click', closeSearchPopup);
    }
  });
</script>



<script>
  document.querySelectorAll(".faq-toggle").forEach((btn) => {
  btn.addEventListener("click", () => {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector(".faq-icon");

    // Close all other FAQ items
    document.querySelectorAll(".faq-content").forEach((item) => {
      if (item !== content) {
        item.classList.add("hidden");
      }
    });

    document.querySelectorAll(".faq-icon").forEach((item) => {
      if (item !== icon) {
        item.textContent = "+";
      }
    });

    // Toggle current item
    content.classList.toggle("hidden");
    icon.textContent = content.classList.contains("hidden") ? "+" : "–";
  });
});

</script>

  <script>
  


        // FAQ Toggle Functionality
        const faqToggles = document.querySelectorAll('.faq-toggle');

        faqToggles.forEach((toggle, index) => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                const isActive = toggle.classList.contains('active');

                // Close all other FAQ items
                faqToggles.forEach((otherToggle, otherIndex) => {
                    if (otherIndex !== index) {
                        const otherContent = otherToggle.nextElementSibling;
                        otherToggle.classList.remove('active');
                        otherContent.classList.remove('active');
                    }
                });

                // Toggle current FAQ item
                if (isActive) {
                    toggle.classList.remove('active');
                    content.classList.remove('active');
                } else {
                    toggle.classList.add('active');
                    content.classList.add('active');
                }
            });
        });

    //     // Add some interactive particles effect
    //     function createParticle() {
    //         const particle = document.createElement('div');
    //         particle.className = 'fixed w-2 h-2 bg-white/20 rounded-full pointer-events-none';
    //         particle.style.left = Math.random() * window.innerWidth + 'px';
    //         particle.style.top = window.innerHeight + 'px';
    //         document.body.appendChild(particle);

    //         const animation = particle.animate([
    //             { transform: 'translateY(0px) rotate(0deg)', opacity: 1 },
    //             { transform: `translateY(-${window.innerHeight + 100}px) rotate(360deg)`, opacity: 0 }
    //         ], {
    //             duration: Math.random() * 3000 + 2000,
    //             easing: 'linear'
    //         });

    //         animation.onfinish = () => particle.remove();
    //     }

    //     // Create particles periodically
    //     setInterval(createParticle, 300);
    // </script>

     <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slideDown': 'slideDown 0.3s ease-out',
                        'slideUp': 'slideUp 0.3s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '100%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.8)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' },
                            '100%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
<script>
  function toggleExpatPopup() {
    const popup = document.getElementById("expat-popup");
    popup.classList.toggle("hidden");
  }
</script>
<!-- JavaScript to toggle popup -->
<script>
  function toggleCategoryPopup() {
    const popup = document.getElementById("search-category-popup");
    popup.classList.toggle("hidden");
  }
</script>




 <script>
  // Back to main categories
  function goBackToMainCategories() {
    closeAllPopups();
    openHelpPopup();
  }

  function closeAllPopups() {
    document.getElementById('searchPopup').classList.add('hidden');
    document.getElementById('expatriesPopup').classList.add('hidden');
    document.getElementById('vacanciersPopup').classList.add('hidden');
    document.getElementById('vacanciersPreparationPopup').classList.add('hidden');
    // Add other popups here as well if needed
  }



  function closeAllPopups() {
    const popups = [
      'searchPopup',
      'expatriesPopup',
      'vacanciersPopup',
      'vacanciersPreparationPopup',
      'vacanciersUrgencePopup',
      'vacanciersProblemesVoyagesPopup',
      'expatriesUrgencePopup',
      'expatriesPreparationPopup',
      'expatriesAssurancePopup',
      'expatriesBesoinsPopup',
      'expatriesSantePopup',
      "vacanciersAutresBesoinsPopup",
      'investisseursPopup',
      'investisseurBienImmobilierPopup',
      "Acheter un bien immobilier",
      "investirMarchesFinanciersPopup",
      "investisseurSecuriserInvestissementsPopup",
      "investisseurOptimisationFiscalePopup",
      "investisseurObligationsLegalesPopup",
      "travailleursFreelancesPopup",
      "travailleursCreerEntreprisePopup",
      "travailleursDevelopperReseauPopup",
      "travailleursGestionFinancierePopup",
      "travailleursProtectionSocialePopup",
      "travailleursTrouverEmploiPopup",
      "travailleursVisaAutorisationsPopup",
      "travailleursCreerEntrepriseSubSubcategoriesPopup",
      "travailleursDevelopperReseauSubSubcategoriesPopup",
      "travailleursGestionFinanciereSubSubcategoriesPopup",
      "travailleursProtectionSocialeSubSubcategoriesPopup",
      "travailleursTrouverEmploiSubSubcategoriesPopup",
      "travailleursVisaAutorisationsSubSubcategoriesPopup"
      // Add more popup IDs here if you have them
    ];
    popups.forEach(id => {
      const el = document.getElementById(id);
      if (el) el.classList.add('hidden');
    });
    localStorage.removeItem('create-request');
  }


    // Close popups when clicking outside
  document.addEventListener('click', function(event) {
    const popups = [
      document.getElementById('searchPopup'),
      document.getElementById('expatriesPopup'),
      document.getElementById('vacanciersPopup')
    ];
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');

    const isAnyPopupVisible = popups.some(popup => popup && !popup.classList.contains('hidden'));
    if (isAnyPopupVisible) {
      const clickedInsidePopup = popups.some(popup => popup && popup.contains(event.target));
      if (!clickedInsidePopup && !searchInput.contains(event.target) && !searchButton.contains(event.target)) {
        closeAllPopups();
      }
    }
  });
</script>

<script>
function openHelpPopup() {
  document.getElementById('searchPopup')?.classList.remove('hidden');
  fetch('/api/categories')
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const category = document.querySelector('#searchPopup .main-categories');
        category.innerHTML = '';

        data.categories.forEach(cat => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col items-center text-center group";

          // Card background (bg_color if set, else white)
          const color =
            typeof cat.bg_color === 'string' && cat.bg_color.trim() !== ''
              ? cat.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          // Text color: white if card has bg_color, else dark gray
          // const textColor =
          //   typeof cat.bg_color === 'string' && cat.bg_color.trim() !== ''
          //     ? 'text-white'
          //     : 'text-gray-800';

          // Icon circle
          const iconHtml = cat.icon_image
            ? `
              <div class="w-12 h-12 rounded-full overflow-hidden mb-2 group-hover:scale-110 transition-transform bg-gray-100">
                <img src="/${cat.icon_image}" alt="${cat.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <h3 class="text-sm font-semibold  text-gray-800">${cat.name}</h3>
          `;

          div.addEventListener('click', () =>
            handleCategoryClick(cat.id, cat.name)
          );
          category.appendChild(div);
        });
      }
    })
    .catch(err => console.error('Failed to load categories:', err));
}


 function handleCategoryClick(categoryId, categoryName) {
  document.getElementById('searchPopup')?.classList.add('hidden');
  document.getElementById('expatriesPopup')?.classList.remove('hidden');

  const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
  createRequest.category = JSON.stringify({
    id: categoryId,
    name: categoryName
  });
  localStorage.setItem('create-request', JSON.stringify(createRequest));

  fetch(`/api/categories/${categoryId}/subcategories`)
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const subcategory = document.querySelector('#expatriesPopup .sub-category');
        subcategory.innerHTML = '';

        data.subcategories.forEach(sub => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          // Card background (sub.bg_color if set, else white)
          const color =
            typeof sub.bg_color === 'string' && sub.bg_color.trim() !== ''
              ? sub.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');
          // Icon circle
          const iconHtml = sub.icon_image
            ? `
              <div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">
                <img src="${sub.icon_image}" alt="${sub.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden flex-none shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <div class="flex-grow font-semibold  text-gray-800">${sub.name}</div>
            <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </div>
          `;

          div.addEventListener('click', () => handleSubcategoryClick(sub.id, sub.name));
          subcategory.appendChild(div);
        });

        document.getElementById('expatriesPopup')?.classList.remove('hidden');
      }
    })
    .catch(err => {
      console.error('Error fetching subcategories:', err);
    });
}

function handleSubcategoryClick(parentId, categoryName) {
  const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};

  createRequest.sub_category = JSON.stringify({
    id: parentId,
    name: categoryName
  });

  localStorage.setItem('create-request', JSON.stringify(createRequest));

  fetch(`/api/categories/${parentId}/children`)
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        const grid = document.querySelector('#vacanciersAutresBesoinsPopup .child-categories');
        grid.innerHTML = '';

        data.subcategories.forEach(child => {
          const div = document.createElement('div');
          div.className =
            "category-card rounded-xl p-6 border border-gray-100 shadow-sm hover:shadow-md cursor-pointer flex items-center group";

          // Card background (child.bg_color if set, else white)
          const color =
            typeof child.bg_color === 'string' && child.bg_color.trim() !== ''
              ? child.bg_color
              : '#ffffff';
          div.style.setProperty('background-color', color, 'important');

          // Text color (white if bg_color exists, else gray-800)
          // const textColor =
          //   typeof child.bg_color === 'string' && child.bg_color.trim() !== ''
          //     ? 'text-white'
          //     : 'text-gray-800';

          // Icon circle
          const iconHtml = child.icon_image
            ? `
              <div class="w-14 h-14 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden bg-gray-100">
                <img src="${child.icon_image}" alt="${child.name}" class="w-full h-full object-cover rounded-full">
              </div>`
            : `
              <div class="w-14 h-14 bg-cyan-300 rounded-full flex items-center justify-center mr-4 group-hover:scale-110 transition-transform overflow-hidden flex-none shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9A2,2 0 0,1 12,7Z"/>
                </svg>
              </div>`;

          div.innerHTML = `
            ${iconHtml}
            <div class="flex-grow font-semibold text-gray-800">${child.name}</div>
            <div class="text-gray-400 group-hover:text-gray-600 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
              </svg>
            </div>
          `;

          div.addEventListener('click', () => requestForHelp(child.id, child.name));
          grid.appendChild(div);
        });

        document.getElementById('vacanciersAutresBesoinsPopup')?.classList.remove('hidden');
      }
    })
    .catch(err => {
      console.error('Error loading child categories:', err);
    });


}

  function requestForHelp(childId, childName) {
    const createRequest = JSON.parse(localStorage.getItem('create-request')) || {};
    createRequest.child_category = JSON.stringify({
      id: childId,
      name: childName
    });

    localStorage.setItem('create-request', JSON.stringify(createRequest));

    // Redirect to the request creation page
    window.location.href = '/create-request';
  }

  // Utility function to extract first name using JavaScript split method
  function extractFirstName(fullName) {
    // Remove punctuation and extra spaces, then split and return first name
    const cleanName = fullName.replace(/[^\w\s]/g, '').trim();
    const nameParts = cleanName.split(/\s+/);
    return nameParts[0] || cleanName;
  }

  // Extract and display first name only in header and sidebar
  function updateUserDisplayNames() {
    // Update header user name (truncated version)
    const headerUserName = document.getElementById('header-user-name');
    if (headerUserName) {
      const fullName = headerUserName.textContent.trim();
      headerUserName.textContent = extractFirstName(fullName);
    }

    // Update header dropdown full name
    const headerUserFullname = document.getElementById('header-user-fullname');
    if (headerUserFullname) {
      const fullName = headerUserFullname.textContent.trim();
      headerUserFullname.textContent = extractFirstName(fullName);
    }

    // Update sidebar greeting
    const sidebarGreeting = document.getElementById('user-greeting');
    if (sidebarGreeting) {
      const fullGreeting = sidebarGreeting.textContent.trim();
      const firstName = extractFirstName(fullGreeting);
      sidebarGreeting.textContent = firstName + '!';
    }
  }

  function closeSearchPopup() {
    document.getElementById('searchPopup')?.classList.add('hidden');
  }

  function goBackToVacanciersSubcategories() {
    document.getElementById('vacanciersAutresBesoinsPopup')?.classList.add('hidden');
    document.getElementById('expatriesPopup')?.classList.remove('hidden');
  }

  // Initialize user name updates when DOM is loaded
  document.addEventListener('DOMContentLoaded', function() {
    updateUserDisplayNames();
  });

</script>
<script>

// Add this to your existing header JavaScript
function updateHeaderAfterLogin(userData) {
  const authButtons = document.querySelector('.auth-buttons');
  const userMenu = document.createElement('div');
  
  userMenu.innerHTML = `
    <div class="relative" x-data="{ open:false }">
      <button 
        type="button"
        @click="open = !open"
        @keydown.escape.window="open = false"
        class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100"
        aria-haspopup="menu"
        :aria-expanded="open.toString()"
      >
        <div class="w-8 h-8 rounded-full border bg-center bg-cover"
          style="background-image: url('${userData.avatar || '/images/helpexpat.png'}');">
        </div>
        <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">
          ${userData.name}
        </span>
        <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
      </button>
      
      <!-- Rest of your existing user menu HTML -->
    </div>
  `;
  
  if (authButtons) {
    authButtons.replaceWith(userMenu);
  }
}



</script>

</body>
</html>