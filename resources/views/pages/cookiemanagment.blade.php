<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cookie Management - ULIX AI</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }

    .toggle {
      appearance: none;
      width: 2.75rem;
      height: 1.5rem;
      background-color: #d1d5db;
      border-radius: 9999px;
      position: relative;
      transition: background-color 0.3s ease;
    }

    .toggle:checked {
      background-color: #2563eb;
    }

    .toggle::before {
      content: "";
      position: absolute;
      top: 0.125rem;
      left: 0.125rem;
      width: 1.25rem;
      height: 1.25rem;
      background: white;
      border-radius: 9999px;
      transition: transform 0.3s ease;
    }

    .toggle:checked::before {
      transform: translateX(1.25rem);
    }

    .fade-in {
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-white text-gray-800 relative">

@include('includes.header')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-400 py-24 px-6 text-center text-white">
  <div class="max-w-3xl mx-auto">
    <h1 class="text-5xl font-extrabold mb-4 drop-shadow-lg">🍪 Cookie Preferences</h1>
    <p class="text-lg opacity-90">Adjust how ULIX AI uses cookies to improve your experience.</p>
  </div>
</section>

<!-- Cookie Management Section -->
<section class="py-20 px-6">
  <div class="max-w-6xl mx-auto space-y-16 fade-in">

    <!-- Cookie Info -->
    <div class="text-center max-w-3xl mx-auto">
      <h2 class="text-3xl font-bold text-blue-800 mb-4">What Are Cookies?</h2>
      <p class="text-gray-700 text-lg leading-relaxed">
        Cookies are small text files stored on your device. They help us ensure smooth functionality, analyze traffic,
        personalize content, and improve marketing.
      </p>
    </div>

    <!-- Cookie Categories -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="glass rounded-2xl p-6 shadow-xl border">
        <div class="text-2xl mb-2">🔐</div>
        <h3 class="font-semibold text-blue-800 text-lg mb-2">Strictly Necessary</h3>
        <p class="text-sm text-gray-700">Required for core site functions like security, login, and navigation.</p>
      </div>
      <div class="glass rounded-2xl p-6 shadow-xl border">
        <div class="text-2xl mb-2">📊</div>
        <h3 class="font-semibold text-green-800 text-lg mb-2">Performance</h3>
        <p class="text-sm text-gray-700">Used to analyze site performance anonymously and improve usability.</p>
      </div>
      <div class="glass rounded-2xl p-6 shadow-xl border">
        <div class="text-2xl mb-2">⚙️</div>
        <h3 class="font-semibold text-yellow-800 text-lg mb-2">Functionality</h3>
        <p class="text-sm text-gray-700">Helps remember user settings and preferences for a personalized experience.</p>
      </div>
      <div class="glass rounded-2xl p-6 shadow-xl border">
        <div class="text-2xl mb-2">📣</div>
        <h3 class="font-semibold text-red-800 text-lg mb-2">Marketing</h3>
        <p class="text-sm text-gray-700">Tracks user activity to display relevant ads across platforms.</p>
      </div>
    </div>

    <!-- Preference Form -->
    <div class="bg-white rounded-2xl shadow-xl p-10 text-center max-w-2xl mx-auto">
      <h3 class="text-2xl font-bold text-blue-800 mb-6">Manage Cookie Preferences</h3>
      <form class="space-y-6">
        <div class="flex justify-between items-center">
          <span class="text-gray-700 font-medium">Performance Cookies</span>
          <input type="checkbox" class="toggle" checked />
        </div>
        <div class="flex justify-between items-center">
          <span class="text-gray-700 font-medium">Functionality Cookies</span>
          <input type="checkbox" class="toggle" checked />
        </div>
        <div class="flex justify-between items-center">
          <span class="text-gray-700 font-medium">Marketing Cookies</span>
          <input type="checkbox" class="toggle" />
        </div>
        <div class="flex justify-center gap-4 pt-6">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow-md transition-all">
            💾 Save Preferences
          </button>
          <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition-all">
            🔄 Reset to Default
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Cookie Consent Banner -->
<div id="cookieBanner" class="fixed bottom-6 left-6 right-6 md:right-auto md:w-[400px] bg-white text-sm text-gray-800 border shadow-xl p-5 rounded-xl z-50 transition-all duration-500 fade-in hidden">
  <div class="flex items-start gap-4">
    <div class="text-2xl">🍪</div>
    <div>
      <p class="mb-2"><strong>We use cookies!</strong> This site uses cookies to enhance your browsing experience and analyze traffic.</p>
      <div class="flex justify-end gap-2">
        <button onclick="acceptCookies()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm">Accept</button>
        <button onclick="closeBanner()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-full text-sm">Decline</button>
      </div>
    </div>
  </div>
</div>

<script>
  function acceptCookies() {
    localStorage.setItem("cookieConsent", "true");
    document.getElementById("cookieBanner").classList.add("hidden");
  }

  function closeBanner() {
    document.getElementById("cookieBanner").classList.add("hidden");
  }

  // Show cookie banner if not previously accepted
  window.onload = () => {
    if (!localStorage.getItem("cookieConsent")) {
      document.getElementById("cookieBanner").classList.remove("hidden");
    }
  };
</script>

 @include('includes.footer')

</body>
</html>