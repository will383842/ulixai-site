<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Navigation - @site</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
   

<!-- Navigation Bar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="text-2xl font-extrabold text-blue-700 tracking-wide">
        @site
      </div>
      <!-- Desktop Menu Button -->
      <div class="hidden md:flex items-center space-x-4">
        <button id="desktop-menu-toggle" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition">
          Pages
        </button>
      </div>
      <!-- Mobile Menu Toggle -->
      <div class="md:hidden">
        <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Fullwidth Dropdown Links -->
  <div id="desktop-menu" class="hidden md:block bg-gray-100 border-t border-gray-200 py-4 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 text-sm">
      <a href="index.php" class="block py-2 hover:text-blue-600">🏠 Home</a>
      <a href="aboutUS.php" class="block py-2 hover:text-blue-600">📘 About</a>
      <a href="serviceProvider.php" class="block py-2 hover:text-blue-600">💼 Services</a>
      <a href="sos.php" class="block py-2 hover:text-blue-600">🚨 SOS</a>
      <a href="request-for-help.php" class="block py-2 hover:text-blue-600">📝 Request for Help</a>
      <a href="legalNotice.php" class="block py-2 hover:text-blue-600">📄 Legal Notice</a>
      <a href="becomepartner.php" class="block py-2 hover:text-blue-600">🤝 Become Partner</a>
      <a href="termsNcondition.php" class="block py-2 hover:text-blue-600">📜 Terms</a>
      <a href="cookieManagment.php" class="block py-2 hover:text-blue-600">🍪 Cookies</a>
      <a href="press.php" class="block py-2 hover:text-blue-600">📰 Press</a>
      <a href="inviteFreind.php" class="block py-2 hover:text-blue-600">📧 Invite</a>
      <a href="howitWork.php" class="block py-2 hover:text-blue-600">⚙️ How It Works</a>
      <a href="contact.php" class="block py-2 hover:text-blue-600">📞 Contact</a>
      <a href="login.blade.php" class="block py-2 hover:text-blue-600">🔐 Login</a>
      <a href="signup.php" class="block py-2 hover:text-blue-600">🆕 Sign Up</a>
      <a href="trustNsecurity.php" class="block py-2 hover:text-blue-600">🔒 Trust & Security</a>
      <a href="customerReviews.php" class="block py-2 hover:text-blue-600">🌟 Reviews</a>
      <a href="/dashboardindex" class="block py-2 hover:text-blue-600">Dashboard</a>
    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-gray-100 border-t border-gray-200 p-4 space-y-2 text-sm">
    <a href="index.php" class="block hover:text-blue-600">Home</a>
    <a href="aboutUS.php" class="block hover:text-blue-600">About</a>
    <a href="serviceProvider.php" class="block hover:text-blue-600">Services</a>
    <a href="sos.php" class="block hover:text-blue-600">SOS</a>
    <a href="request-for-help.php" class="block hover:text-blue-600">Request for Help</a>
    <a href="legalNotice.php" class="block hover:text-blue-600">Legal Notice</a>
    <a href="becomepartner.php" class="block hover:text-blue-600">Become Partner</a>
    <a href="termsNcondition.php" class="block hover:text-blue-600">Terms</a>
    <a href="cookieManagment.php" class="block hover:text-blue-600">Cookies</a>
    <a href="press.php" class="block hover:text-blue-600">Press</a>
    <a href="inviteFreind.php" class="block hover:text-blue-600">Invite</a>
    <a href="howitWork.php" class="block hover:text-blue-600">How it Works</a>
    <a href="contact.php" class="block hover:text-blue-600">Contact</a>
    <a href="login.blade.php" class="block hover:text-blue-600">Login</a>
    <a href="signup.php" class="block hover:text-blue-600">Sign Up</a>
    <a href="trustNsecurity.php" class="block hover:text-blue-600">Trust & Security</a>
    <a href="customerReviews.php" class="block hover:text-blue-600">Reviews</a>
     <a href="dashboard/dashboardindex.php" class="block py-2 hover:text-blue-600">Dashboard</a>
  </div>
</nav>



<!-- Scripts -->
<script>
  const menuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const desktopToggle = document.getElementById('desktop-menu-toggle');
  const desktopMenu = document.getElementById('desktop-menu');

  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  desktopToggle.addEventListener('click', () => {
    desktopMenu.classList.toggle('hidden');
  });
</script>

</body>
</html>