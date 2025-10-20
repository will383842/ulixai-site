<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invite Friends - ULIX AI</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

 @include('includes.header')
     @include('pages.popup')

<!-- Hero Section -->
<section class="bg-gradient-to-b from-blue-500 to-blue-300 text-center py-24 px-4">
  <div class="max-w-2xl mx-auto">
    <h1 class="text-4xl font-bold text-white mb-2">🎉 Invite Friends to Ulixai</h1>
    <p class="text-white text-lg">Share your dashboard or invite people via email to join your team.</p>
  </div>
</section>

<!-- Main Invite Section -->
<section class="py-16 px-4">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <!-- Dashboard Link & QR Code -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Your dashboard is published</h2>
      <p class="text-sm text-gray-500 mb-4">Future changes will be published automatically.</p>

      <div class="flex items-center mb-4 gap-2">
        <input type="text" readonly value="sales.ulixai.com" class="flex-1 px-4 py-2 border rounded-md text-sm" />
        <button onclick="copyDashboard()" class="text-blue-700 text-sm hover:underline">📋 Copy</button>
      </div>

      <button class="text-blue-600 text-sm font-medium hover:underline mb-6">+ Add custom domain</button>

      <div class="text-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=sales.ulixai.com" alt="QR Code" class="mx-auto mb-2" />
        <p class="text-sm text-gray-600">Scan this code with your phone to open your dashboard in the app.</p>
      </div>
    </div>

    <!-- Invite by Email -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Invite people to your dashboard</h2>
      <p class="text-sm text-gray-500 mb-4">We'll email them instructions and a link to create an account.</p>

      <div class="flex gap-2 mb-6">
        <input type="email" placeholder="Enter email address" class="flex-1 px-4 py-2 border rounded-md text-sm" />
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">Send invite</button>
      </div>

      <!-- List of invited users -->
      <ul class="text-sm text-gray-700 space-y-2 mb-4">
        <li class="flex justify-between items-center">jack@ulixai.com <span class="text-gray-500">Invite sent</span></li>
        <li class="flex justify-between items-center">sienna@ulixai.com <span class="text-gray-500">Invite sent</span></li>
        <li class="flex justify-between items-center">frankie@ulixai.com <span class="text-gray-500">Invite sent</span></li>
        <li class="flex justify-between items-center">matt@ulixai.com <span class="text-gray-500">Invite sent</span></li>
        <li class="flex justify-between items-center">
          <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/24?u=amelie" alt="Amélie" class="w-6 h-6 rounded-full" />
            amelie@ulixai.com
          </div>
          <span class="text-green-600">Invited accepted</span>
        </li>
      </ul>

      <!-- Seats used info -->
      <div class="text-sm text-gray-600 mt-6">
        <p class="mb-2">6/10 team seats used</p>
        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
          <div class="bg-blue-500 h-2 rounded-full w-[60%]"></div>
        </div>
        <a href="#" class="text-blue-700 hover:underline text-sm">Manage</a>
      </div>
    </div>

  </div>
</section>

<script>
  function copyDashboard() {
    const input = document.querySelector('input[readonly]');
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value);
    alert('Dashboard link copied to clipboard!');
  }
</script>

 @include('includes.footer')

</body>
</html>