
  <title>Affiliate</title>
      <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
 
  <style>
    .emoji-large {
      font-size: 2.5rem;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(59, 130, 246, 0.2);
    }
  </style>

<body class="bg-white text-gray-800">

 @include('includes.header')
 @include('pages.popup')

 @include('pages.socialmediacard')

<!-- Hero Section -->
<section class="text-center py-16 px-4 bg-white">
  <div class="max-w-2xl mx-auto space-y-6">
    <h2 class="text-3xl font-bold text-blue-900">You're already part of the affiliate program 🎉</h2>
    <p class="text-gray-600">Thank you for being part of the Ulixai adventure!<br> Talk about us around you — you earn revenue, you help us grow ✨</p>
    <button class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300">🔗 Share your affiliate link</button>

    <!-- Social Buttons -->
    <div class="flex justify-center gap-4 pt-4">
      <!-- Instagram -->
      <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white hover:bg-pink-600 transition">
        <i class="fab fa-instagram text-lg"></i>
      </a>
      <!-- Facebook -->
      <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white hover:bg-blue-600 transition">
        <i class="fab fa-facebook-f text-lg"></i>
      </a>
      <!-- Twitter -->
      <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white hover:bg-sky-500 transition">
        <i class="fab fa-twitter text-lg"></i>
      </a>
      <!-- TikTok -->
      <a href="https://tiktok.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white hover:bg-black transition">
        <i class="fab fa-tiktok text-lg"></i>
      </a>
      <!-- LinkedIn -->
      <a href="https://linkedin.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
        <i class="fab fa-linkedin-in text-lg"></i>
      </a>
    </div>
  </div>
</section>

<!-- Why Recommend Section -->
<section class="py-20 px-4 text-center bg-white">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl md:text-5xl font-bold text-blue-800 mb-4">Why recommend Ulixai?</h2>
    <p class="text-xl text-blue-800 mb-8 flex justify-center items-center gap-2"><span class="text-4xl">🌍</span> The only platform that helps all people moving internationally.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-8 shadow-md border border-blue-100 card-hover">
        <div class="mb-6 flex items-center gap-4">
          <span class="emoji-large">🤝</span>
          <span class="text-blue-800 font-bold text-xl">Why Ulixai?</span>
        </div>
        <p class="text-blue-900 font-semibold bg-blue-50 p-3 rounded-lg border-l-4 border-blue-400">Are you already a member?</p>
        <p class="text-sm text-blue-700 pl-4 border-l-2 border-blue-300 mt-3">The one and only platform that meets all the needs of expats and travelers worldwide.</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-8 shadow-md border border-blue-100 card-hover">
        <div class="mb-6 flex items-center gap-4">
          <span class="emoji-large">💰</span>
          <span class="text-blue-800 font-bold text-xl">Remuneration</span>
        </div>
        <p class="text-blue-900 font-semibold bg-blue-50 p-3 rounded-lg border-l-4 border-blue-400">Exceptional affiliate commissions for life</p>
        <p class="text-sm text-blue-700 pl-4 border-l-2 border-blue-300 mt-3">75% commission on service provider fees</p>
        <p class="text-sm text-blue-700 pl-4 border-l-2 border-blue-300 mt-1">Each time one of your referrals uses our platform, you receive 75% of the fee.</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl p-8 shadow-md border border-blue-100 card-hover">
        <div class="mb-6 flex items-center gap-4">
          <span class="emoji-large">📊</span>
          <span class="text-blue-800 font-bold text-xl">The Programme</span>
        </div>
        <p class="text-blue-900 font-semibold bg-blue-50 p-3 rounded-lg border-l-4 border-blue-400">A private link to earn money</p>
        <p class="text-sm text-blue-700 pl-4 border-l-2 border-blue-300 mt-3">You receive a unique affiliate link at signup</p>
        <p class="text-sm text-blue-700 pl-4 border-l-2 border-blue-300 mt-1">Track stats, referrals, and earnings from your dashboard</p>
      </div>
    </div>
  </div>
</section>

<!-- Affiliate Link Card -->
<section class="bg-white py-12 px-6 max-w-md mx-auto rounded-2xl shadow-xl text-center relative">
  <!-- Icon -->
  <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-white rounded-full shadow flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2M5 11h14l-1 10H6L5 11z" />
    </svg>
  </div>

  <h2 class="text-xl font-bold text-blue-900 mt-10">Your Affiliate Link</h2>
  <p class="text-sm text-gray-500 mt-2">Share and earn rewards by inviting others to Ulixai!</p>

  <!-- Link Box -->
  <div class="mt-6 bg-blue-50 px-4 py-3 rounded-full flex items-center justify-between text-left">
    <span class="text-sm text-gray-700 font-mono truncate">
      @if($user?->affiliate_code)
        {{ url('/?ref=' . $user->affiliate_code) }}
      @else
        <span class="text-red-500">No affiliate link available</span>
      @endif
    </span>
    <button class="ml-4 text-blue-600 hover:text-blue-800">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-6 4v4m-2-4v4m2-16a4 4 0 018 0v6a4 4 0 01-8 0V4z" />
      </svg>
    </button>
  </div>

  <!-- Copy Button -->
  <button class="mt-6 bg-blue-800 text-white w-full py-3 rounded-full font-semibold hover:bg-blue-900 transition"
    @if(!$user?->affiliate_code) disabled style="opacity:0.5;cursor:not-allowed;" @endif>
    📋 Copy My Link
  </button>

  <!-- Social Icons -->
  <div class="mt-8 grid grid-cols-5 gap-3 justify-center">
    <!-- Facebook -->
    <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white">
      <i class="fab fa-facebook-f"></i>
    </a>
    <!-- Twitter -->
    <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white">
      <i class="fab fa-twitter"></i>
    </a>
    <!-- WhatsApp -->
    <a href="@if($user?->affiliate_code){{ 'https://wa.me/?text=' . urlencode(url('/?ref=' . $user->affiliate_code)) }}@else#@endif" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white">
      <i class="fab fa-whatsapp"></i>
    </a>
    <!-- Instagram -->
    <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white">
      <i class="fab fa-instagram"></i>
    </a>
    <!-- LinkedIn -->
    <a href="https://linkedin.com" target="_blank" class="w-10 h-10 bg-blue-900 rounded-full flex items-center justify-center text-white">
      <i class="fab fa-linkedin-in"></i>
    </a>
  </div>
</section>
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

<div class="mb-20"></div>
@include('includes.footer')

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
</body>
</html>