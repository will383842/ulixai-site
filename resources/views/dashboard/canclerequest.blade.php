<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cancel Request</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans">
  <?php include('../includes/header.php'); ?>
  <?php include('../popup.php'); ?>

  <!-- Main Layout -->
  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full lg:w-auto">
      <?php include('sidebardash.php'); ?>
    </div>

    <!-- Main Content Area -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
      <?php include('walletmoney.php'); ?>

      <!-- Form Container -->
      <div id="formContainer" class="bg-white rounded-2xl shadow p-4 sm:p-6 lg:p-8 max-w-2xl w-full mx-auto">
        <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-6 text-center sm:text-left">
          WHY DO YOU CANCEL?
        </h2>

        <!-- Form -->
        <form id="cancelForm" onsubmit="showSuccessPopup(event)">
          <div class="mb-8">
            <select name="cancel_reason" required
              class="w-full px-4 py-3 border border-blue-300 rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm sm:text-base">
              <option value="">Be sure to choose a reason</option>
              <option value="The service provider is no longer responding">The service provider is no longer responding</option>
              <option value="The service provider is unreachable after validation">The service provider is unreachable after validation</option>
              <option value="The service provider canceled without notice">The service provider canceled without notice</option>
              <option value="The work delivered is empty or unusable">The work delivered is empty or unusable</option>
              <option value="The service provider refuses to complete the mission">The service provider refuses to complete the mission</option>
            </select>
          </div>
            <!-- New Textarea Field -->
  <div class="mb-8">
    <textarea name="additional_comments" rows="4" placeholder="Write in detail why do you want to cancel..."
      class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm sm:text-base resize-none"></textarea>
  </div>

          <!-- Submit Button -->
          <div class="text-center sm:text-right">
            <button type="submit"
              class="bg-blue-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-600 transition text-sm sm:text-base">
              I confirm my dispute
            </button>
          </div>
        </form>
      </div>

      <!-- Success Popup -->
      <div id="successPopup" class="hidden bg-white border border-gray-200 rounded-2xl shadow-md max-w-xl w-full mx-auto p-8 text-center mt-12">
        <div class="flex justify-center mb-4">
          <div class="bg-green-100 p-3 rounded-full">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-bold text-blue-900 mb-2">Your decision has been sent!</h3>
        <p class="text-gray-600 mb-1">The service provider has just received your message.</p>
        <p class="text-gray-600 mb-4">We’ll keep you in the loop for what happens next.</p>
        <p class="text-gray-700 font-semibold">Thanks a bunch for your trust! 🙌</p>
      </div>

    </main>
  </div>

  <?php include('bottomnavbar.php'); ?>

  <!-- JS to Toggle Success Popup -->
  <script>
    function showSuccessPopup(event) {
      event.preventDefault(); // Stop normal form submission

      const form = document.getElementById('formContainer');
      const popup = document.getElementById('successPopup');

      form.classList.add('hidden');
      popup.classList.remove('hidden');
    }
  </script>
</body>
</html>