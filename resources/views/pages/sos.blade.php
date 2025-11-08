<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr + JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>ULIX AI - SOS Help</title>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .glass {
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(14px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    }
  </style>
  <!-- Put this in <head> BEFORE any HTML paints -->
<script>document.documentElement.classList.add('js');</script>
<style>
  /* Modals are hidden by default to prevent flash */
  .popup-modal { display: none; }
  /* When explicitly opened, show as flex */
  .popup-modal.is-open { display: flex; }
</style>

</head>
<body class="bg-white  text-gray-800">
 @include('includes.header')
     @include('wizards.requester.steps.popup_request_help')

<!-- 🔴 HERO -->
<section class="bg-gradient-to-br from-red-700 to-red-600 text-white py-24 px-4 text-center">
  <div class="max-w-3xl mx-auto animate-fade-in">
    <h1 class="text-4xl font-extrabold mb-4">🚨  @site SOS Emergency Help</h1>
    <p class="text-lg font-medium mb-2">Talk to a trusted expert in under 5 minutes.</p>
    <p class="text-base text-white/90">Legal, medical, real estate, or personal help — we're here when it matters most.</p>
  </div>
</section>

<!-- Social Media Share Card (below red cards, right side, more down) -->
<div class="flex justify-end max-w-7xl mx-auto px-4 mt-12 mb-4">
  <div class="flex flex-wrap items-center bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl px-4 py-3 shadow-lg space-x-2 sm:space-x-4 w-full sm:w-auto">
     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
  <path d="M16 9l-5 5-3-3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

    <!-- Left Text -->
    <div class="text-sm leading-snug">
    <p class="font-semibold text-white">
        Share this page & earn rewards in €/$ 
        <span class="text-xs font-normal text-white">(if you are logged in)</span>
    </p>

    @auth
        <p 
            class="text-xs text-white"
            value="{{ env('APP_URL') . '/affiliate/sign-up/?code=' . Auth::user()->affiliate_code }}">
            {{ Auth::user()->affiliate_code }}
        </p>
    @endauth
</div>

    
    <div class="flex gap-2 flex-wrap">
      <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 transition">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" alt="Facebook" class="w-5 h-5 invert" />
      </a>
      <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 transition">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" alt="Instagram" class="w-5 h-5 invert" />
      </a>
      <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 transition">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/tiktok.svg" alt="TikTok" class="w-5 h-5 invert" />
      </a>
      <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 transition">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/youtube.svg" alt="YouTube" class="w-5 h-5 invert" />
      </a>
      <a href="#" class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/10 hover:bg-white/20 transition">
        <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/twitter.svg" alt="Twitter" class="w-5 h-5 invert" />
      </a>
      
      <!-- Copy Link Button -->
     <!-- Copy Link Button -->
<button id="copyLinkBtn" 
    class="flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M8 17l4 4 4-4m-4-5v9" />
    </svg>
    Copy Link
</button>

<!-- Hidden input with the link -->
@auth
    <input 
        type="text" 
        id="affiliateLink" 
        value="{{ url('/signup?code=' . Auth::user()->affiliate_code) }}" 
        hidden
    >
@endauth

    </div>
  </div>
</div>

<!-- 🧑‍💼 WHO CAN YOU REACH -->
<section class="py-20 px-4 text-center bg-white">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-red-700 mb-8">Who Can You Reach?</h2>

    <div class="bg-yellow-300 border border-red-300 text-red-800 text-sm py-3 px-6 rounded-xl inline-block shadow-sm mb-10">
      ⚠️ These services will be available soon. Stay tuned.
    </div>

    <!-- Center the cards horizontally using justify-center -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-10 justify-center">
      
      <!-- Card 1 -->
      <div class="glass rounded-2xl p-6 hover:scale-105 transition-all duration-300 flex flex-col items-center">
        <div class="text-3xl mb-2">👨‍⚖️</div>
        <h3 class="text-red-700 text-xl font-bold mb-2">Lawyer</h3>
        <p class="text-sm text-gray-700 text-center">Legal assistance for emergencies abroad</p>
      </div>

      <!-- Card 2 -->
      <div class="glass rounded-2xl p-6 hover:scale-105 transition-all duration-300 flex flex-col items-center">
        <div class="text-3xl mb-2">🌍</div>
        <h3 class="text-red-700 text-xl font-bold mb-2">Expat Support</h3>
        <p class="text-sm text-gray-700 text-center">General help & local orientation</p>
      </div>

    </div>
  </div>
</section>
<!-- 👩‍⚖️ LAWYER & EXPAT SIGNUP CARDS -->
<section class="py-10 px-2 sm:px-4 flex flex-col md:flex-row gap-2 justify-center items-stretch bg-white"> <!-- Reduced gap from 4 to 2 -->
  <!-- Lawyer Card -->
  <div class="flex-1 bg-red-50 rounded-2xl p-8 shadow-md flex flex-col items-center border border-red-100 max-w-md ">
    <div class="text-2xl mb-2">🧑‍⚖️</div>
    <h3 class="text-red-700 text-lg font-bold mb-1">Are you a lawyer?</h3>
    <div class="font-semibold mb-2">Join SOS Urgence</div>
    <p class="text-gray-700 text-sm mb-2">
      Offer <span class="font-bold">20-minute calls</span><br>
      whenever and wherever you want,<br>
      in the language and country of your choice.
    </p>
    <p class="text-gray-700 text-sm mb-2">
      Activate or deactivate your availability in <span class="font-bold">1 click</span>.
    </p>
    <div class="text-red-700 font-semibold mb-1">Paid mission.</div>
    <div class="text-pink-500 text-sm mb-4">Our travelers will thank you <span class="align-middle">💗</span></div>
    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-semibold text-sm shadow transition-all duration-200"
      onclick="openLawyerSignupPopup(event)">
      🧑‍⚖️ Sign up as a lawyer
    </button>
  </div>
  <!-- Expat Card -->
  <div class="flex-1 bg-blue-50 rounded-2xl p-8 shadow-md flex flex-col items-center border border-blue-100 max-w-md ">
    <div class="text-2xl mb-2">🌍</div>
    <h3 class="text-blue-700 text-lg font-bold mb-1">Are you an expat? Help other travelers!</h3>
    <div class="font-semibold mb-2">By joining SOS Urgence,</div>
    <p class="text-gray-700 text-sm mb-2">
      you can take <span class="font-bold">30-minute calls</span><br>
      to help people who need it, instantly.
    </p>
    <p class="text-gray-700 text-sm mb-2">
      Choose your language, your country, your availability.<br>
      Turn your status on or off in just 1 click.
    </p>
    <div class="text-blue-700 font-semibold mb-1">Every call is paid.</div>
    <div class="text-gray-700 text-sm mb-4">Expats around the world will thank you <span class="align-middle">🙏</span></div>
    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-semibold text-sm shadow transition-all duration-200"
      onclick="openExpatSignupPopup(event)">
      📞 I'm signing up to help by phone
    </button>
  </div>
</section>


<!-- 🧑‍💼 EXPERT CARDS SECTION (as shown in your screenshot) -->
<section class="py-8 px-2 sm:px-4 bg-white">
  <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <!-- Card 1: Lawyer -->
    <div class="rounded-2xl shadow-md bg-white overflow-hidden border border-gray-100 flex flex-col">
      <div class="relative">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elisa" class="w-full h-36 object-cover">
        <span class="absolute top-2 left-2 bg-pink-200 text-pink-800 text-xs px-2 py-0.5 rounded-full font-semibold">Français</span>
        <span class="absolute bottom-2 right-2 bg-red-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow">Lawyer</span>
      </div>
      <div class="p-4 flex-1 flex flex-col">
        <div class="font-bold text-lg mb-1">Elisa</div>
        <div class="text-xs text-gray-500 mb-1">Country service: <span class="font-semibold text-gray-700">Thailande</span></div>
        <div class="flex items-center text-xs text-gray-700 mb-2">
          <span class="text-yellow-500 mr-1">★</span>4,91 <span class="text-gray-400 ml-1">(366 avis)</span>
        </div>
        <div class="flex flex-wrap gap-1 mb-2">
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Super pro</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Top</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Sympa</span>
        </div>
        <div class="flex items-center justify-between mt-auto">
          <span class="text-gray-700 font-semibold">€/h</span>
        </div>
      </div>
    </div>
    <!-- Card 2: Expat Online -->
    <div class="rounded-2xl shadow-md bg-white overflow-hidden border border-gray-100 flex flex-col">
      <div class="relative">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elisa" class="w-full h-36 object-cover">
        <span class="absolute top-2 left-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full font-semibold">Japanese</span>
        <span class="absolute top-2 right-2 bg-green-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow flex items-center gap-1">
          <span class="w-2 h-2 bg-green-400 rounded-full inline-block"></span>Online
        </span>
        <span class="absolute bottom-2 right-2 bg-green-700 text-white text-xs px-3 py-1 rounded-full font-bold shadow">expatriate</span>
      </div>
      <div class="p-4 flex-1 flex flex-col">
        <div class="font-bold text-lg mb-1">Elisa</div>
        <div class="text-xs text-gray-500 mb-1">Country service: <span class="font-semibold text-gray-700">Thailande</span></div>
        <div class="flex items-center text-xs text-gray-700 mb-2">
          <span class="text-yellow-500 mr-1">★</span>4,91 <span class="text-gray-400 ml-1">(366 avis)</span>
        </div>
        <div class="flex flex-wrap gap-1 mb-2">
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Super pro</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Top</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Sympa</span>
        </div>
        <div class="flex items-center justify-between mt-auto">
          <span class="flex items-center gap-1 text-green-700 font-semibold">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884l2-3A1 1 0 015 2h10a1 1 0 01.832.445l2 3A1 1 0 0118 6v8a1 1 0 01-.168.555l-2 3A1 1 0 0115 18H5a1 1 0 01-.832-.445l-2-3A1 1 0 012 14V6a1 1 0 01.003-.116z"/></svg>
            Online
          </span>
          <span class="text-blue-700 font-bold flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884l2-3A1 1 0 015 2h10a1 1 0 01.832.445l2 3A1 1 0 0118 6v8a1 1 0 01-.168.555l-2 3A1 1 0 0115 18H5a1 1 0 01-.832-.445l-2-3A1 1 0 012 14V6a1 1 0 01.003-.116z"/></svg>
            32
          </span>
        </div>
      </div>
    </div>
    <!-- Card 3: Lawyer (duplicate for demo) -->
    <div class="rounded-2xl shadow-md bg-white overflow-hidden border border-gray-100 flex flex-col">
      <div class="relative">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elisa" class="w-full h-36 object-cover">
        <span class="absolute top-2 left-2 bg-pink-200 text-pink-800 text-xs px-2 py-0.5 rounded-full font-semibold">Français</span>
        <span class="absolute bottom-2 right-2 bg-red-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow">Lawyer</span>
      </div>
      <div class="p-4 flex-1 flex flex-col">
        <div class="font-bold text-lg mb-1">Elisa</div>
        <div class="text-xs text-gray-500 mb-1">Country service: <span class="font-semibold text-gray-700">Thailande</span></div>
        <div class="flex items-center text-xs text-gray-700 mb-2">
          <span class="text-yellow-500 mr-1">★</span>4,91 <span class="text-gray-400 ml-1">(366 avis)</span>
        </div>
        <div class="flex flex-wrap gap-1 mb-2">
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Super pro</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Top</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Sympa</span>
        </div>
        <div class="flex items-center justify-between mt-auto">
          <span class="text-gray-700 font-semibold">€/h</span>
        </div>
      </div>
    </div>
    <!-- Card 4: Expat Online (duplicate for demo) -->
    <div class="rounded-2xl shadow-md bg-white overflow-hidden border border-gray-100 flex flex-col">
      <div class="relative">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Elisa" class="w-full h-36 object-cover">
        <span class="absolute top-2 left-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full font-semibold">Japanese</span>
        <span class="absolute top-2 right-2 bg-green-600 text-white text-xs px-3 py-1 rounded-full font-bold shadow flex items-center gap-1">
          <span class="w-2 h-2 bg-green-400 rounded-full inline-block"></span>Online
        </span>
        <span class="absolute bottom-2 right-2 bg-green-700 text-white text-xs px-3 py-1 rounded-full font-bold shadow">expatriate</span>
      </div>
      <div class="p-4 flex-1 flex flex-col">
        <div class="font-bold text-lg mb-1">Elisa</div>
        <div class="text-xs text-gray-500 mb-1">Country service: <span class="font-semibold text-gray-700">Thailande</span></div>
        <div class="flex items-center text-xs text-gray-700 mb-2">
          <span class="text-yellow-500 mr-1">★</span>4,91 <span class="text-gray-400 ml-1">(366 avis)</span>
        </div>
        <div class="flex flex-wrap gap-1 mb-2">
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Super pro</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Top</span>
          <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Sympa</span>
        </div>
        <div class="flex items-center justify-between mt-auto">
          <span class="flex items-center gap-1 text-green-700 font-semibold">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884l2-3A1 1 0 015 2h10a1 1 0 01.832.445l2 3A1 1 0 0118 6v8a1 1 0 01-.168.555l-2 3A1 1 0 0115 18H5a1 1 0 01-.832-.445l-2-3A1 1 0 012 14V6a1 1 0 01.003-.116z"/></svg>
            Online
          </span>
          <span class="text-blue-700 font-bold flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884l2-3A1 1 0 015 2h10a1 1 0 01.832.445l2 3A1 1 0 0118 6v8a1 1 0 01-.168.555l-2 3A1 1 0 0115 18H5a1 1 0 01-.832-.445l-2-3A1 1 0 012 14V6a1 1 0 01.003-.116z"/></svg>
            32
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 🆘 COMMON EMERGENCIES -->
<section class="bg-gray-50 py-20 px-2 sm:px-4">
  <div class="max-w-6xl mx-auto flex justify-center items-center">
    <div class="text-center">
      <h2 class="text-2xl md:text-3xl font-bold text-red-700 mb-8 max-w-2xl mx-auto leading-snug">
        Examples of common emergency situations<br>
        Whatever your need, be connected to the phone in seconds.
      </h2>

      <ul class="space-y-4 text-gray-800 text-base text-left inline-block max-w-xs sm:max-w-full">
        <li class="flex items-center gap-3"><span class="text-red-600 text-sm  px-1 py-0.5  font-bold">🆘</span> Border or airport issue</li>
        <li class="flex items-center gap-3"><span class="text-red-600 text-sm   px-1 py-0.5  font-bold">🆘</span> Rental dispute or blocked deposit</li>
        <li class="flex items-center gap-3"><span class="text-red-600 text-sm   px-1 py-0.5  font-bold">🆘</span> Filing a local complaint</li>
        <li class="flex items-center gap-3"><span class="text-red-600 text-sm   px-1 py-0.5  font-bold">🆘</span> Unpaid salary or sudden job loss</li>
        <li class="flex items-center gap-3"><span class="text-red-600 text-sm  px-1 py-0.5  font-bold">🆘</span> Injuries or accidents abroad</li>
      </ul>
    </div>
  </div>
</section>

<!-- 📞 EMERGENCY CALL -->
<section class="bg-white py-20 px-2 sm:px-4 text-center">
  <div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold text-red-700 flex items-center justify-center gap-2 mb-6">
      📞 Your Emergency Call
    </h2>
    <button 
      onclick="showComingSoonPopup(event)" 
      class="bg-gradient-to-r from-red-600 to-red-500 text-white text-sm px-6 py-3 rounded-full shadow-lg hover:opacity-90 transition-all duration-200">
      Call a Professional (Coming Soon)
    </button>
  </div>
</section>

<!-- Popup Modal -->
<div id="sos-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-2 sm:px-4 hidden" style="display:none;">
  <div class="bg-white rounded-xl p-4 sm:p-6 shadow-2xl max-w-md w-full text-center">
    <h2 class="text-xl font-bold text-gray-800 mb-3">Coming Soon</h2>
    <p class="text-gray-600 italic mb-4 leading-relaxed">
      Service available in the coming weeks.
    </p>
    <button onclick="closeComingSoonPopup()" 
            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md transition-all duration-200">
      Close
    </button>
  </div>
</div>

<!-- Lawyer Signup Popup Modal -->
<div id="lawyer-signup-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-2 sm:px-4 overflow-y-auto">
  <div class="bg-white rounded-xl p-3 sm:p-4 shadow-2xl w-full max-w-lg my-8 relative">
    <!-- Close (X) button -->
    <button type="button" onclick="closeLawyerSignupPopup()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold z-10" aria-label="Close">&times;</button>
    <form id="lawyer-signup-form" class="bg-red-100 rounded-xl p-3 sm:p-4" onsubmit="submitLawyerSignup(event)" enctype="multipart/form-data">
      @csrf
      <h2 class="text-xl md:text-2xl font-bold text-red-700 mb-1 flex items-center gap-2">🧑‍⚖️ Join  @site  SOS – Lawyer Registration</h2>
      <div class="text-gray-700 text-xs md:text-sm mb-3">Fill out this form to be available on-demand for 20-minute legal calls.</div>
      <div class="grid grid-cols-1 gap-3 mb-3">
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1" >First Name</label>
            <input name="first_name" type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your first name" value="{{ Auth::check() ? Auth::user()->name : '' }}">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Last Name</label>
            <input name = "last_name" type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your last name">
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label name = "dob" class="block text-xs font-semibold mb-1">Date of Birth</label>
            <input type="date" class="w-full rounded border px-2 py-1 text-xs" required>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Country of Origin</label>
          <select name="country_origin" class="w-full rounded border px-2 py-1 text-xs" required>
  <option value={{ Auth::check() ? (Auth::user()->service_provider->country ?? '') : ''  }}
>Select your country</option>
  <option value="USA">United States</option>
  <option value="Canada">Canada</option>
  <option value="UK">United Kingdom</option>
  <option value="Australia">Australia</option>
  <option value="Germany">Germany</option>
  <option value="France">France</option>
  <option value="India">India</option>
  <option value="Pakistan">Pakistan</option>
  <option value="Japan">Japan</option>
  <option value="South Korea">South Korea</option>
  <option value="Brazil">Brazil</option>
  <option value="Mexico">Mexico</option>
  <option value="Italy">Italy</option>
  <option value="Spain">Spain</option>
</select>

          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label  class="block text-xs font-semibold mb-1">Phone Number</label>
            <input name ="phone_number" type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your phone number">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">WhatsApp Number (required)</label>
            <input name = "whats_app" type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your WhatsApp number">
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">Professional Email</label>
            <input name = "email" type="email" class="w-full rounded border px-2 py-1 text-xs" required placeholder="example@yourfirm.com">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Bar Association Name</label>
            <input name ="assosiate_name" type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="e.g. Paris Bar">
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">License / Registration Number</label>
            <input type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Official bar number">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Upload Your Bar Card / License</label>
            <input name ="reg_number" type="file" class="w-full rounded border px-2 py-1 text-xs" required>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">Countries Where You Practice</label>
            <select name ="country_practice" class="w-full rounded border px-2 py-1 text-xs" multiple>
              <option>France</option>
              <option>USA</option>
              <option>Canada</option>
              <option>Morocco</option>
              <!-- Add more countries -->
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Legal Practice Areas</label>
            <select name = "legal_area" class="w-full rounded border px-2 py-1 text-xs" multiple>
              <option>Family Law</option>
              <option>Corporate Law</option>
              <option>Immigration</option>
              <option>Tax Law</option>
              <!-- Add more areas -->
            </select>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">Years of Experience</label>
            <input name = "experience" type="number" class="w-full rounded border px-2 py-1 text-xs" required placeholder="e.g. 5">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Personal Website or LinkedIn</label>
            <input name ="website" type="url" class="w-full rounded border px-2 py-1 text-xs" placeholder="https://yourlink.com">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-semibold mb-1">Short Biography</label>
        <textarea name = "bio" class="w-full rounded border px-2 py-1 text-xs" rows="2" required placeholder="Tell us briefly about your background, and why you want to help."></textarea>
      </div>
      <div class="flex justify-between items-center mt-2">
        <button type="button" onclick="closeLawyerSignupPopup()" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-semibold text-xs">Cancel</button>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-full font-semibold text-xs shadow transition-all duration-200 flex items-center gap-2">
          <span class="material-icons" style="font-size:16px;"></span> Finish Registration
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Registration Confirmation Popup -->
<div id="lawyer-confirm-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-2 sm:px-4 hidden">
  <div class="bg-white rounded-xl p-4 sm:p-6 shadow-2xl max-w-lg w-full text-center" style="background: repeating-linear-gradient(0deg, #fff, #fff 28px, #f8dada 28px, #f8dada 29px);">
    <h2 class="text-2xl font-bold text-red-700 mb-2">Thank you for registering with  @site SOS <span class="align-middle">🙏</span></h2>
    <div class="text-gray-700 text-base mb-2">You should have received a confirmation email with your login credentials.</div>
    <div class="text-gray-700 text-base mb-2">You can now access your personal dashboard to manage your account and respond to requests.</div>
    <div class="text-gray-700 text-base mb-4">We're glad to have you on board to help expatriates around the world.</div>
    <button onclick="closeLawyerConfirmPopup()" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full font-semibold">Close</button>
  </div>
</div>

<!-- Expat Signup Popup Modal -->
<div id="expat-signup-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-2 sm:px-4 overflow-y-auto hidden">
  <div class="bg-white rounded-xl p-3 sm:p-4 shadow-2xl w-full max-w-lg my-8 relative">
    <!-- Close (X) button -->
    <button type="button" onclick="closeExpatSignupPopup()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold z-10" aria-label="Close">&times;</button>
    <form id="expat-signup-form" class="bg-red-100 rounded-xl p-3 sm:p-4" onsubmit="submitExpatSignup(event)">
      <h2 class="text-xl md:text-2xl font-bold text-red-700 mb-1 flex items-center gap-2">
        <span class="align-middle">🌍</span> Join <span class="text-red-600">SOS Urgence</span> – Expatriate Helper
      </h2>
      <div class="text-gray-700 text-xs md:text-sm mb-3">
        Sign up to receive <span class="font-bold">30-minute calls</span><br>
        and assist other travelers or expatriates around the world.<br>
        <span class="font-bold">Paid missions, availability toggled in 1 click.</span>
      </div>
      <div class="grid grid-cols-1 gap-3 mb-3">
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">First Name</label>
            <input type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your first name">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Last Name</label>
            <input type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your last name">
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">Date of Birth</label>
            <input type="date" class="w-full rounded border px-2 py-1 text-xs" required>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Country of Origin</label>
            <select class="w-full rounded border px-2 py-1 text-xs" required>
              <option value="">Select your country</option>
              <option>USA</option>
              <option>Canada</option>
              <option>UK</option>
              <option>Australia</option>
              <option>Germany</option>
              <option>France</option>
              <option>India</option>
              <option>Pakistan</option>
              <option>Japan</option>
              <option>South Korea</option>
              <option>Brazil</option>
              <option>Mexico</option>
              <option>Italy</option>
              <option>Spain</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">Current Country of Residence</label>
            <select class="w-full rounded border px-2 py-1 text-xs" required>
              <option value="">Select where you live</option>
              <option>USA</option>
              <option>Canada</option>
              <option>UK</option>
              <option>Australia</option>
              <option>Germany</option>
              <option>France</option>
              <option>India</option>
              <option>Pakistan</option>
              <option>Japan</option>
              <option>South Korea</option>
              <option>Brazil</option>
              <option>Mexico</option>
              <option>Italy</option>
              <option>Spain</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Languages You Can Help In</label>
            <select class="w-full rounded border px-2 py-1 text-xs" multiple required>
              <option>English</option>
              <option>French</option>
              <option>Spanish</option>
              <option>Portuguese</option>
              <option>German</option>
              <option>Italian</option>
              <option>Arabic</option>
              <option>Russian</option>
              <option>Chinese</option>
              <option>Japanese</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <div>
            <label class="block text-xs font-semibold mb-1">WhatsApp Number (required)</label>
            <input type="text" class="w-full rounded border px-2 py-1 text-xs" required placeholder="Your WhatsApp number">
          </div>
          <div>
            <label class="block text-xs font-semibold mb-1">Email</label>
            <input type="email" class="w-full rounded border px-2 py-1 text-xs" required placeholder="you@example.com">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-semibold mb-1">Short Bio</label>
        <textarea class="w-full rounded border px-2 py-1 text-xs" rows="2" required placeholder="I'm an expat based in Thailand. I love helping newcomers settle and find their way..."></textarea>
      </div>
      <div class="mb-3">
        <label class="block text-xs font-semibold mb-1">LinkedIn or Website (optional)</label>
        <input type="url" class="w-full rounded border px-2 py-1 text-xs" placeholder="https://yourprofile.com">
      </div>
      <div class="flex justify-end items-center mt-2">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full font-semibold text-sm shadow transition-all duration-200 flex items-center gap-2">
          <span class="material-icons" style="font-size:18px;"></span> Complete My Registration
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Expat Registration Confirmation Popup -->
<div id="expat-confirm-popup" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center min-h-screen px-2 sm:px-4 hidden" style="display:none;">
  <div class="bg-white rounded-xl p-4 sm:p-6 shadow-2xl max-w-lg w-full text-center" style="background: repeating-linear-gradient(0deg, #fff, #fff 28px, #f8dada 28px, #f8dada 29px);">
    <h2 class="text-2xl font-bold text-red-700 mb-2">Thank you for registering with  @site SOS <span class="align-middle">🙏</span></h2>
    <div class="text-gray-700 text-base mb-2">You should have received a confirmation email with your login credentials.</div>
    <div class="text-gray-700 text-base mb-2">You can now access your personal dashboard to manage your account and respond to requests.</div>
    <div class="text-gray-700 text-base mb-4">We're glad to have you on board to help expatriates around the world.</div>
    <button onclick="closeExpatConfirmPopup()" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full font-semibold">Close</button>
  </div>
</div>

<style>
  /* Hide all popups by default */
  #sos-popup, #lawyer-signup-popup, #lawyer-confirm-popup, #expat-signup-popup, #expat-confirm-popup {
    display: none;
  }
  /* Responsive tweaks */
  @media (max-width: 640px) {
    .rounded-2xl, .rounded-xl, .rounded-lg {
      border-radius: 1rem !important;
    }
    .p-6, .p-8, .p-4 {
      padding: 1rem !important;
    }
    .max-w-md, .max-w-lg, .max-w-2xl, .max-w-3xl, .max-w-6xl {
      max-width: 100vw !important;
    }
    .shadow-xl, .shadow-2xl, .shadow-lg, .shadow-md {
      box-shadow: 0 2px 8px rgba(0,0,0,0.10) !important;
    }
    .flex.items-center.justify-center {
      align-items: flex-start !important;
    }
  }
</style>

<script>
  // Show/hide popup functions
  function showComingSoonPopup(e) {
    if (e) e.preventDefault();
    var el = document.getElementById('sos-popup');
    if (el) el.style.display = 'flex';
  }

  function closeComingSoonPopup() {
    var el = document.getElementById('sos-popup');
    if (el) el.style.display = 'none';
  }

  function openLawyerSignupPopup(e) {
    if (e) e.preventDefault();
    var el = document.getElementById('lawyer-signup-popup');
    if (el) el.style.display = 'flex';
  }
  function closeLawyerSignupPopup() {
    var el = document.getElementById('lawyer-signup-popup');
    if (el) el.style.display = 'none';
  }

  function submitLawyerSignup(e) {
    e.preventDefault();
    closeLawyerSignupPopup();
    var el = document.getElementById('lawyer-confirm-popup');
    if (el) el.style.display = 'flex';
  }

  function closeLawyerConfirmPopup() {
    var el = document.getElementById('lawyer-confirm-popup');
    if (el) el.style.display = 'none';
  }

  function openExpatSignupPopup(e) {
    if (e) e.preventDefault();
    var el = document.getElementById('expat-signup-popup');
    if (el) el.style.display = 'flex';
  }

  function closeExpatSignupPopup() {
    var el = document.getElementById('expat-signup-popup');
    if (el) el.style.display = 'none';
  }

  function submitExpatSignup(e) {
    e.preventDefault();
    closeExpatSignupPopup();
    var el = document.getElementById('expat-confirm-popup');
    if (el) el.style.display = 'flex';
  }

  function closeExpatConfirmPopup() {
    var el = document.getElementById('expat-confirm-popup');
    if (el) el.style.display = 'none';
  }

  // Ensure all popups are hidden on page load
  document.addEventListener('DOMContentLoaded', function() {
    var ids = [
      'sos-popup',
      'lawyer-signup-popup',
      'lawyer-confirm-popup',
      'expat-signup-popup',
      'expat-confirm-popup'
    ];

    // Ensure all popups are hidden on page load
    ids.forEach(function(id) {
      var el = document.getElementById(id);
      if (el) el.style.display = 'none'; // Hide on page load
    });
  });
</script>
<script>
document.getElementById("copyLinkBtn").addEventListener("click", function () {
    const link = document.getElementById("affiliateLink").value;
    navigator.clipboard.writeText(link).then(() => {
        toastr.success("Affiliate link copied to clipboard!");
    }).catch(() => {
        toastr.error("Failed to copy link!");
    });
});
</script>

</script>

  @include('includes.footer')

</body>
</html>