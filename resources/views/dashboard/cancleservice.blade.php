<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cancel Service</title>
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
    <div class="flex-1 p-4 sm:p-6 lg:p-8">
      <div class="bg-white rounded-2xl shadow p-4 sm:p-6 lg:p-8 max-w-3xl mx-auto space-y-6">

        <!-- Title -->
        <h2 class="text-blue-900 font-bold text-lg sm:text-xl">
          WHY DO YOU WISH TO CANCEL THIS SERVICE?
        </h2>

        <!-- Form -->
        <form action="" method="POST" class="space-y-5">
          <!-- Reason 1 -->
          <select name="reason1" class="w-full px-4 py-3 border rounded-full text-gray-700 border-gray-300 focus:outline-none">
            <option value="">I no longer want to do it</option>
            <option value="Too busy">I’m too busy</option>
            <option value="Found alternative">Requester found someone else</option>
          </select>

          <!-- Reason 2 -->
          <select name="reason2" class="w-full px-4 py-3 border rounded-full text-gray-700 border-gray-300 focus:outline-none">
            <option value="">I have another reason</option>
            <option value="Health">Health issue</option>
            <option value="Misunderstanding">Service mismatch</option>
          </select>

          <!-- Textarea -->
          <textarea name="message" rows="4" placeholder="Describe here the reason for your cancellation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl text-gray-700 bg-gray-50 resize-none focus:outline-none"></textarea>

          <!-- Info Messages -->
          <p class="text-sm text-blue-700">
            By providing this service, you increase the number of point in your account and you will be more visible.
          </p>
          <p class="text-sm text-red-600 font-medium">
            If you cancel your service, you will lose 150 points on your ranking and you will be much less visible.
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pt-4 gap-4 flex-wrap">
            <button type="submit" name="still_provide"
                    class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition">
              I WILL STILL PROVIDE THE SERVICE
            </button>
            <a href="canclemsg.php" class="text-blue-600 font-medium underline">
              I CANCEL
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php include('bottomnavbar.php'); ?>
</body>
</html>