<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hello Olivia! - Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
  <?php include('../includes/header.php'); ?>
   <?php include('../popup.php'); ?>
  <?php include('breadcrumbs.php'); ?>

  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar -->
    <div class="w-full lg:w-72 bg-white shadow-md">
     
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6">
      <!-- Profile Header -->
      <div class="bg-white rounded-lg p-6 mb-6 shadow">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
          <div class="flex items-center">
            <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center text-white font-bold text-lg border-2 border-white mr-4"></div>
            <h2 class="text-xl font-semibold">SERVICE PROVIDER</h2>
          </div>

          <div class="flex gap-3 flex-wrap justify-start md:justify-end">
            <!-- Social Media Buttons -->
            <a href="https://www.facebook.com/profile.php?id=61575873886727" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition hover:scale-110">
              <i class="fab fa-facebook-f text-sm"></i>
            </a>
            <a href="https://fr.pinterest.com/ulixai/" class="w-10 h-10 bg-red-600 hover:bg-red-700 text-white rounded-full flex items-center justify-center transition hover:scale-110">
              <i class="fab fa-pinterest-p text-sm"></i>
            </a>
            <a href="https://www.instagram.com/ulixai_officiel/" class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-full flex items-center justify-center transition hover:scale-110">
              <i class="fab fa-instagram text-sm"></i>
            </a>
            <a href="#" class="w-10 h-10 bg-black hover:bg-gray-800 text-white rounded-full flex items-center justify-center transition hover:scale-110">
              <i class="fab fa-tiktok text-sm"></i>
            </a>
            <a href="https://x.com/Ulixai_officiel" class="w-10 h-10 bg-blue-400 hover:bg-blue-500 text-white rounded-full flex items-center justify-center transition hover:scale-110">
              <i class="fab fa-twitter text-sm"></i>
            </a>
          </div>
        </div>

        <p class="mt-4 text-sm text-gray-600">A busy service professional at the Palace... This is the resume that will make your eyes pop!</p>
      </div>

      <!-- Profile Statistics -->
      <div class="bg-white rounded-lg p-6 mb-6 shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Column 1 -->
          <div>
            <h3 class="font-semibold mb-4">Profile verified</h3>
            <div class="space-y-2 text-sm text-gray-600">
              <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>€48/h</div>
              <div class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>1 vote</div>
            </div>

            <h3 class="font-semibold mt-6 mb-4">PROFESSIONAL OASIS</h3>
            <div class="space-y-2 text-sm">
              <div class="flex items-center"><i class="fas fa-user text-blue-500 mr-2"></i>Aide à la préparation</div>
              <div class="flex items-center"><i class="fas fa-utensils text-blue-500 mr-2"></i>Accounting</div>
            </div>
          </div>

          <!-- Column 2 -->
          <div>
            <h3 class="font-semibold mb-4">My areas of expertise</h3>
            <div class="grid grid-cols-2 gap-2 text-sm">
              <?php
              $skills = ["Babysitt", "Babies", "Work experience", "Maths matterning", "Coocking", "Education", "Homework", "Accounting", "Laundry"];
              foreach ($skills as $skill) {
                echo "<div class='flex items-center'><i class='fas fa-circle text-blue-500 mr-2 text-xs'></i>$skill</div>";
              }
              ?>
            </div>
          </div>
        </div>

        <div class="mt-6">
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg text-sm font-medium">Contact TW</button>
        </div>
      </div>

      <!-- Reviews Section -->
      <div class="bg-white rounded-lg p-6 shadow">
        <h3 class="font-semibold mb-4">REVIEWS AND COMMENTS</h3>

        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400 mr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <span class="text-lg font-semibold">4.98</span>
        </div>

        <p class="text-sm text-gray-600 mb-4">See all 5 for 15 reviews</p>

        <div class="flex flex-wrap items-center gap-4 mb-6">
          <button class="bg-yellow-400 text-black px-4 py-2 rounded-lg text-sm font-medium">SHOW THE 5*</button>
          <div class="flex items-center space-x-2 text-sm text-gray-600">
            <span>1,203</span>
            <i class="fas fa-thumbs-up text-blue-500"></i>
            <span>5.15</span>
            <i class="fas fa-star text-yellow-400"></i>
          </div>
        </div>

        <!-- Review Cards -->
        <div class="space-y-4">
          <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="border-b pb-4">
              <div class="flex items-start">
                <div class="w-10 h-10 bg-gray-300 rounded-full mr-3"></div>
                <div class="flex-1">
                  <div class="flex items-center justify-between mb-2">
                    <span class="font-medium">NAME SECURED</span>
                    <div class="flex text-yellow-400">
                      <?php for ($s = 0; $s < 5; $s++) echo "<i class='fas fa-star text-xs'></i>"; ?>
                    </div>
                  </div>
                  <p class="text-sm text-gray-600 mb-2">Perfect !!!</p>
                  <span class="text-xs text-gray-400">a few days</span>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>

        <div class="mt-6 text-center">
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg text-sm font-medium">See more reviews</button>
        </div>
      </div>
    </main>
  </div>
  <?php include('bottomnavbar.php'); ?>
</body>
</html>