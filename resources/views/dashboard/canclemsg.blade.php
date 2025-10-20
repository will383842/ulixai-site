<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cancellation Feedback</title>
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
    <div class="flex-1 p-4 sm:p-6 lg:p-8 flex items-center justify-center">
      <div class="bg-white rounded-2xl shadow-lg px-6 sm:px-8 py-10 sm:py-12 max-w-2xl w-full text-center space-y-4">

        <h1 class="text-xl sm:text-2xl font-bold text-blue-900">
          TOO BAD. THE SERVICE REQUESTER <br class="hidden sm:block" />
          WILL BE DISAPPOINTED
        </h1>

        <p class="text-sm text-red-600 font-medium">You have lost some points</p>

      </div>
    </div>

  </div>
<?php include('bottomnavbar.php'); ?>
</body>
</html>