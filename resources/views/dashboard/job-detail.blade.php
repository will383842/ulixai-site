<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Service Edit Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans">
  <?php include('../includes/header.php'); ?>
  <?php include('../popup.php'); ?>

  <!-- Wrapper for Sidebar + Content -->
  <div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar (included separately) -->
    <?php include('sidebardash.php'); ?>

    <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6">
      <?php include('walletmoney.php'); ?>

      <div class="bg-white rounded-2xl shadow p-4 sm:p-6 lg:p-8 max-w-6xl mx-auto space-y-10">

        <!-- Top Service Summary -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-blue-900 font-bold mb-3 text-lg sm:text-xl">NIGHT BABYSITTING MOM</h2>
            <!-- <p class="text-gray-700">Price proposed <strong>$36</strong></p> -->
            <p class="text-gray-700 text-sm">Duration: 1 hour</p>
            <p class="text-gray-700 text-sm mb-2">France</p>
            <p class="text-gray-700 text-sm mb-2">Lyon</p>
            <p class="text-gray-700 text-sm mb-2">French</p>
            <!-- <p class="text-gray-700 text-sm mb-2">Mission Ends In: 45:20</p> -->
          </div>
          <div class="border rounded-xl p-4 text-sm text-gray-700">
            Watch over my mom for part of the night. She is calm and sleeps through the night without waking up.
          </div>
        </section>

        <!-- Editable Section -->
        <section>
          <h3 class="text-blue-900 font-bold mb-4 text-lg">I MODIFY MY SERVICE REQUEST</h3>
          <div class="space-y-3 text-sm text-gray-700">
            <div class="flex justify-between items-center">
              <span>Date: 15/10/2023</span>
              <a href="#" class="text-blue-500 font-medium text-xs">Edit</a>
            </div>
            <div class="flex justify-between items-center">
              <span>Time: from 9h00 to 18h00</span>
              <a href="#" class="text-blue-500 font-medium text-xs">Edit</a>
            </div>
            <div class="flex justify-between items-center">
              <span>The price I propose</span>
              <a href="#" class="text-blue-500 font-medium text-xs">Edit</a>
            </div>
            <div class="flex justify-between items-center">
              <span>My phone number: 00 00 00 00 00</span>
              <a href="#" class="text-blue-500 font-medium text-xs">Edit</a>
            </div>
            <div class="flex justify-between items-center">
              <span>I am adding photos</span>
              <a href="#" class="text-blue-500 font-medium text-xs">Edit</a>
            </div>
          </div>
        </section>

        <!-- Upload Photos -->
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          <?php for ($i = 1; $i <= 4; $i++): ?>
          <div class="border rounded-xl p-4 text-center">
            <div class="text-sm text-gray-500 mb-1">Photo <?= $i ?></div>
            <form enctype="multipart/form-data" class="w-full">
              <label class="w-full h-28 flex items-center justify-center bg-gray-100 rounded-lg mb-2 cursor-pointer hover:bg-blue-50 transition">
                <input type="file" name="photo<?= $i ?>" accept="image/*" class="hidden" onchange="previewPhoto(event, <?= $i ?>)">
                <img id="preview<?= $i ?>" src="" alt="" class="hidden w-full h-28 object-cover rounded-lg" />
                <svg id="icon<?= $i ?>" class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12M7 16h10m-5 4v-4" />
                </svg>
              </label>
              <button type="button" onclick="document.querySelector('input[name=photo<?= $i ?>]').click()" class="text-blue-600 text-sm font-medium">Upload photo</button>
            </form>
            <div class="mt-2">
              <button class="text-blue-500 text-xs font-medium">Edit</button>
            </div>
          </div>
          <?php endfor; ?>
        </section>
<script>
function previewPhoto(event, idx) {
  const input = event.target;
  const file = input.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview' + idx).src = e.target.result;
      document.getElementById('preview' + idx).classList.remove('hidden');
      document.getElementById('icon' + idx).classList.add('hidden');
    };
    reader.readAsDataURL(file);
  }
}
</script>

        <!-- Footer Buttons -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
          <a href="canclerequest.php" class="text-sm text-blue-600 font-medium underline">CANCEL MY REQUEST</a>
          <!-- <a href="dispute1.php" class="text-sm text-red-600 font-medium underline">DISPUTE</a> -->
          <a href="editecomplete.php">
            <button class="bg-blue-600 text-white font-medium px-6 py-2 rounded-full hover:bg-blue-700 transition text-sm">
              COMPLETED
            </button>
          </a>
        </div>

      </div>
    </div>
  </div>

  <?php include('bottomnavbar.php'); ?>
</body>
</html>