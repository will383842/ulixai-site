<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Zelpissime Thank You</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans">

  <!-- Header -->
  <?php include('../includes/header.php'); ?>
   <?php include('../popup.php'); ?>

  <!-- Breadcrumbs -->
 

  <!-- Page Layout -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include('sidebardash.php'); ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 flex justify-center items-center">
      <div class="bg-white rounded-2xl shadow-xl p-10 max-w-4xl w-full flex flex-col md:flex-row items-center justify-between text-center md:text-left">
        
        <!-- Left: Message -->
        <div class="mb-6 md:mb-0 md:mr-6">
          <h2 class="text-2xl font-extrabold text-blue-900 uppercase mb-2">You are zelpissime !!!</h2>
          <p class="text-xl text-blue-900 font-bold mb-6">Thank you</p>
          <a href="reviewzeply.php" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold text-sm transition">
            CONTINUE
          </a>
        </div>

        <!-- Right: Image -->
        <div>
          <img src="zelpissime-character.png" alt="Zelpissime Mascot" class="w-40 md:w-52" />
        </div>

      </div>
    </main>

  </div>
<?php include('bottomnavbar.php'); ?>
</body>
</html>