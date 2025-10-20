<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modification Request</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans">

  <?php include('../includes/header.php'); ?>
   <?php include('../popup.php'); ?>


  <div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Sidebar -->
    <div class=" lg:block w-full lg:w-64 bg-white shadow-md z-10">
      <?php include('sidebardash.php'); ?>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6 lg:pl-10 space-y-10">

      <!-- Wallet and Referral -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-medium flex items-center gap-2">
          My piggi bank <span class="font-bold text-lg">243 $</span>
        </div>
        <div class="bg-yellow-300 text-black px-4 py-2 rounded-full text-sm font-medium flex items-center gap-2">
          Referral earnings <span class="font-bold text-lg">243 $</span>
        </div>
      </div>

      <!-- Form Card -->
      <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-10 max-w-4xl mx-auto space-y-6">
        <h2 class="text-blue-900 font-bold text-lg sm:text-xl text-center">
          REQUEST FOR MODIFICATION TO THE SERVICE REQUESTER
        </h2>

        <form method="POST" action="" class="space-y-6">
          <!-- Inputs -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <input type="text" name="change_time" placeholder="I propose to change time"
              class="w-full px-4 py-3 border border-gray-300 rounded-full text-gray-700 focus:outline-none" />

            <input type="text" name="change_date" placeholder="I propose to change date"
              class="w-full px-4 py-3 border border-gray-300 rounded-full text-gray-700 focus:outline-none" />
          </div>

          <!-- Button -->
          <div class="text-center">
            <button type="submit"
              class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition">
              I INFORM THE REQUESTER
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include('bottomnavbar.php'); ?>
</body>
</html>