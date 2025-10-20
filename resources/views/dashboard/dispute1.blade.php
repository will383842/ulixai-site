<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dispute Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col items-center justify-start p-6 text-blue-900">
   <?php include('../includes/header.php'); ?>
    <?php include('../popup.php'); ?>
  

  <!-- Heading -->
  <div class="max-w-2xl w-full">
    <h1 class="text-3xl font-bold text-blue-800 mb-2">Dispute Management</h1>
    <p class="text-base text-blue-700 mb-6">This is where you can try</p>

    <!-- Options -->
    <h2 class="text-xl font-semibold text-blue-800 mb-3">What would you like to do?</h2>
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
      <button class="flex-1 bg-blue-200 text-blue-800 py-3 px-4 rounded-lg font-medium hover:bg-blue-300 transition">
        Request an update on order
      </button>
      <button class="flex-1 bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition">
        Ask the freelancer
      </button>
    </div>

    <!-- Text Area Section -->
    <h3 class="text-lg font-medium mb-2 text-blue-800">Tell me why you are making this request</h3>
    <textarea
      class="w-full border border-blue-300 rounded-lg p-3 h-40 focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none mb-4"
      placeholder="Describe your reason here..."></textarea>

    <!-- Buttons -->
    <div class="flex justify-end space-x-3">
      <button class="bg-gray-300 text-blue-800 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
        Cancel
      </button>
      <button
        id="submitRequest"
        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
        Send Request
      </button>
    </div>
  </div>

  <!-- Success Popup -->
  <div id="successPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl text-center max-w-sm">
      <h2 class="text-xl font-semibold text-blue-800 mb-4">Your request has been submitted</h2>
      <button
        onclick="document.getElementById('successPopup').classList.add('hidden')"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        Close
      </button>
    </div>
  </div>

  <script>
    document.getElementById('submitRequest').addEventListener('click', () => {
      document.getElementById('successPopup').classList.remove('hidden');
    });
  </script>
  <?php include('bottomnavbar.php'); ?>
</body>
</html>