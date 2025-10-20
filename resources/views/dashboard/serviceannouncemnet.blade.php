<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Service Announcement</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans">

  <!-- Header -->
 @include('includes.header')
     @include('pages.popup')
 

  <!-- Responsive Layout -->
  <div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar -->
    <div class="lg:block  w-full lg:w-64">
    @include('dashboard.sidebardash')
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6">
      <div class="bg-white rounded-2xl shadow p-4 sm:p-6 max-w-6xl mx-auto space-y-6">

        <!-- Title + Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-blue-900 font-bold text-lg sm:text-xl mb-2">PRIVATE LESSONS MY CHILD IN ENGLISH</h2>
            <p class="text-sm text-gray-700">Date: 15/10/2023</p>
            <p class="text-sm text-gray-700">Country: France</p>
            <p class="text-sm text-gray-700">City: Lyon</p>
            <p class="text-sm text-gray-700">Lng: French</p>
          </div>

          <div>
            <h3 class="text-blue-900 font-bold mb-2 text-sm sm:text-base">DETAILS ANNOUNCEMENT</h3>
            <div class="border border-blue-200 rounded-xl p-4 text-sm text-gray-700 bg-blue-50">
              Watch over my mom for part of the night. She is calm and sleeps through the night without waking up.
            </div>
          </div>
        </div>

        <!-- Image Thumbnails -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
          <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="border border-blue-200 rounded-xl p-4 flex items-center justify-center h-32 bg-blue-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M4 16l4-4a3 3 0 014 0l4 4M2 20h20M12 12a4 4 0 100-8 4 4 0 000 8z"/>
              </svg>
            </div>
          <?php endfor; ?>
        </div>

        <!-- Public Messaging -->
        <div>
          <h3 class="text-blue-900 font-bold mb-2 text-sm sm:text-base">PUBLIC MESSAGING</h3>
          <div class="border border-blue-200 rounded-xl p-4 text-sm text-gray-700 bg-blue-50">
            Watch over my mom for part of the night. She is calm and sleeps through the night without waking up. Watch over my mom for part of the night...
          </div>
        </div>

     <!-- Action Buttons -->
<div class="flex flex-wrap justify-center gap-4 pt-2">
  <button class="bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-blue-700 transition">
   <a href="{{ route('qoute-offer')}}"> I SEND PUBLIC MESSAGE </a>
  </button>

  <!-- I APPLY button triggers Popup 1 -->
  <button onclick="openPopup1()" class="border border-blue-500 text-blue-600 px-6 py-2 rounded-full text-sm font-medium hover:bg-blue-50 transition">
    I APPLY
  </button>
</div>

<!-- Popup 1 -->
<div id="bookingPopup1" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
    <button onclick="closePopup1()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
    <p class="text-sm text-blue-500 mb-2">Moving household appliances</p>
    <div class="border rounded-lg p-4 text-center text-2xl font-bold text-blue-500 mb-4">
      36&nbsp;€
    </div>
    <div class="text-sm text-gray-600 space-y-1 mb-6">
      <p><strong>Date:</strong> 15/10/2023</p>
      <p><strong>Category:</strong> Household</p>
      <p><strong>Sub category:</strong> Appliances</p>
      <p><strong>Sub Sub category:</strong> Vending Machines</p>
      <p><strong>Country:</strong> United States</p>
      <p><strong>Language:</strong> English</p>
    </div>
    <button onclick="openPopup2()" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-6 py-2 text-sm font-medium">
      I APPLY
    </button>
  </div>
</div>

<!-- Popup 2 -->
<div id="bookingPopup2" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
    <button onclick="closePopup2()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
    <p class="text-sm text-blue-500 mb-2">Moving household appliances</p>
    <h2 class="text-center text-lg font-bold text-blue-900 mb-4">PLEASE INDICATE YOUR RATE FOR THIS SERVICE</h2>
    <div class="border rounded-lg p-4 text-sm text-gray-700 mb-4">
      Moving a vending machine from one location to another. Everything is on the ground floor, etc.
    </div>
    <div class="mb-6 flex flex-col items-center">
      <label class="block text-sm text-blue-900 mb-1 w-full text-left">Indicate Delay to realise</label>
      <input type="text" placeholder="e.g. 2 days" class="p-2 border border-gray-300 rounded w-full mb-2" />
    </div>
    <button onclick="openPopup3()" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-6 py-2 text-sm font-medium">
      I APPLY
    </button>
  </div>
</div>

<!-- Popup 3 -->
<div id="bookingPopup3" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative text-center">
    <button onclick="closePopup3()" class="absolute top-3 right-4 text-gray-500 hover:text-black text-xl">&times;</button>
    <h2 class="text-lg font-bold text-blue-900 mb-3">Ulysse!</h2>
    <p class="text-base text-blue-900 mb-2 font-semibold">Your application has been sent to the requester</p>
    <p class="text-sm text-gray-600">You will be informed if your application is accepted via your personal messaging and thought email</p>
  </div>
</div>

<!-- Scripts -->
<script>
  function openPopup1() {
    document.getElementById('bookingPopup1').classList.remove('hidden');
  }
  function closePopup1() {
    document.getElementById('bookingPopup1').classList.add('hidden');
  }
  function openPopup2() {
    closePopup1();
    document.getElementById('bookingPopup2').classList.remove('hidden');
  }
  function closePopup2() {
    document.getElementById('bookingPopup2').classList.add('hidden');
  }
  function openPopup3() {
    closePopup2();
    document.getElementById('bookingPopup3').classList.remove('hidden');
  }
  function closePopup3() {
    document.getElementById('bookingPopup3').classList.add('hidden');
  }
</script>


      </div>
    </main>

  </div>
  <div class = "pb-12"></div>
@include('dashboard.bottomnavbar')
</body>
</html>
  
