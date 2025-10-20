<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Ulixai's Player Viral</title>
</head>
<body class="bg-white text-gray-800 font-sans">

  <?php include('../includes/header.php'); ?>
   <?php include('popup.php'); ?>

  <div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Top Grid: Left = Viral Info | Right = Rewards & Leaderboard -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left Column (2/3) -->
      <div class="lg:col-span-2 space-y-4">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-800 text-center lg:text-center">Ulixai's Player Viral</h1>

      <div class="flex justify-center">
  <div class="bg-blue-100 text-blue-700 px-6 py-3 rounded-xl shadow font-semibold text-lg text-center">
    💎 You currently have <strong>X points</strong>
  </div>
</div>

<div class="bg-blue-700 text-white p-6 rounded-xl w-full max-w-xl mx-auto text-center">
  <h2 class="text-lg font-semibold mb-4">Upload a profile picture stating ‘I am Ulixai’s Expat’</h2>

  <div class="flex justify-center gap-6">
    <!-- Take Photo Button -->
    <button onclick="openCamera()"
      class="bg-white text-blue-700 p-4 rounded-xl w-28 h-28 flex flex-col items-center justify-center font-bold hover:bg-gray-100 transition">
      📷<span class="text-xs mt-1">Take Photo</span>
    </button>

    <!-- Upload Custom Button -->
    <button onclick="document.getElementById('customModal').classList.remove('hidden')"
      class="bg-white text-blue-700 p-4 rounded-xl w-28 h-28 flex flex-col items-center justify-center font-bold hover:bg-gray-100 transition">
      🧢<span class="text-xs mt-1">Upload Custom</span>
    </button>
  </div>
</div>

<!-- Modal -->
<div id="customModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 w-full max-w-md text-center relative shadow-xl">

    <!-- Close Button -->
    <button onclick="document.getElementById('customModal').classList.add('hidden')"
      class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl font-bold">&times;</button>

    <h2 class="text-xl font-bold text-blue-900 mb-4">🧢 Get My Custom Logo</h2>

    <!-- Upload -->
    <div class="mb-4">
      <label class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded-full cursor-pointer hover:bg-blue-700 transition">
        Choose File
        <input type="file" id="fileInput" accept="image/*" class="hidden" />
      </label>
      <p id="fileName" class="text-sm text-gray-600 mt-1">No file chosen</p>
    </div>

    <!-- Preview -->
    <div id="previewContainer" class="hidden mb-4">
      <img id="imagePreview" class="w-24 h-24 mx-auto rounded-full object-cover border-2 border-blue-500" />
    </div>

    <!-- Country Flags -->
    <input type="text" id="expat" placeholder="Country of expatriation"
      class="w-full mb-3 border border-gray-300 rounded-lg px-4 py-2 text-sm" />
    <input type="text" id="origin" placeholder="Country of origin"
      class="w-full mb-3 border border-gray-300 rounded-lg px-4 py-2 text-sm" />

    <button onclick="generateLogo()"
      class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg">
      Submit
    </button>

    <!-- Result -->
    <div id="resultPreview" class="mt-6 hidden">
      <div class="relative w-40 h-40 mx-auto">
        <img src="https://i.imgur.com/J4xOZzA.png" id="baseLogo" class="w-full h-full object-contain" />
        <img id="flagExpat" class="w-6 h-4 absolute top-4 right-4 rounded-sm" />
        <img id="flagOrigin" class="w-6 h-4 absolute bottom-4 left-4 rounded-sm" />
      </div>
    </div>

    <p id="uploadMsg" class="mt-4 text-green-600 font-medium hidden">✅ Profile picture uploaded successfully!</p>
  </div>
</div>

<script>
  const fileInput = document.getElementById('fileInput');
  const imagePreview = document.getElementById('imagePreview');
  const previewContainer = document.getElementById('previewContainer');
  const fileNameDisplay = document.getElementById('fileName');
  const uploadMsg = document.getElementById('uploadMsg');

  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (file) {
      fileNameDisplay.textContent = file.name;
      imagePreview.src = URL.createObjectURL(file);
      previewContainer.classList.remove('hidden');
      uploadMsg.classList.add('hidden');
    }
  });

  function openCamera() {
    const cameraInput = document.createElement('input');
    cameraInput.type = 'file';
    cameraInput.accept = 'image/*';
    cameraInput.capture = 'user';
    cameraInput.onchange = (e) => {
      const file = e.target.files[0];
      if (file) {
        alert('Camera photo captured: ' + file.name);
        // Optional: add preview or upload logic
      }
    };
    cameraInput.click();
  }

  function getFlagURL(countryName) {
    const flags = {
      France: "https://flagcdn.com/fr.svg",
      USA: "https://flagcdn.com/us.svg",
      Thailand: "https://flagcdn.com/th.svg",
      SouthAfrica: "https://flagcdn.com/za.svg",
      Pakistan: "https://flagcdn.com/pk.svg",
      Germany: "https://flagcdn.com/de.svg",
      Canada: "https://flagcdn.com/ca.svg",
      UK: "https://flagcdn.com/gb.svg",
    };
    const key = countryName.replace(/\s/g, '').replace(/[^a-zA-Z]/g, '');
    return flags[key] || "";
  }

  function generateLogo() {
    const expat = document.getElementById("expat").value.trim();
    const origin = document.getElementById("origin").value.trim();
    const flagExpat = document.getElementById("flagExpat");
    const flagOrigin = document.getElementById("flagOrigin");

    const expatFlag = getFlagURL(expat);
    const originFlag = getFlagURL(origin);

    if (!expatFlag || !originFlag) {
      alert("Please enter valid country names.");
      return;
    }

    flagExpat.src = expatFlag;
    flagOrigin.src = originFlag;
    document.getElementById("resultPreview").classList.remove("hidden");

    setTimeout(() => {
      uploadMsg.classList.remove("hidden");
    }, 500);
  }
</script>




        <!-- Challenge of the Month -->
        <section class="pt-6">
          <h2 class="text-xl font-bold mb-4">🎯 Challenge of the Month</h2>
          <p class="mb-4 text-sm">Complete these fun missions to earn points and become one of Ulixai’s monthly champions 🎉</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm font-semibold">
            <div class="bg-blue-100 px-4 py-3 rounded-lg">🧑‍🤝‍🧑 Invite a friend via your link<br>+5 pts + 75% commission</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">📸 Post “Why I love Ulixai” with a photo<br>+5 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">📢 Share Ulixai in 2 FB groups<br>+5 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">➕ Add “Member of Ulixai.com” in your bio<br>+30 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">🎥 YouTube video under 5 min<br>+5 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">🎬 YouTube video over 10 min<br>+10 pts</div>
            <!-- <div class="bg-yellow-300 px-4 py-3 rounded-lg text-center">🔄 Change every month</div> -->
            <div class="bg-blue-100 px-4 py-3 rounded-lg">💬 Share your testimonial<br>+3 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">📍 Post “Ulixai in my country”<br>+25 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">🎞 Video about Ulixai in FB groups<br>+50 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">📱 Create 5 TikToks (1000+ views)<br>+100 pts</div>
            <div class="bg-blue-100 px-4 py-3 rounded-lg">🌐 Publish a video on Ulixai.com<br>+100 pts</div>
          </div>
        <!-- Map Section Below Challenge of the Month -->
<div class="relative max-w-7xl mx-auto mt-16">
  <!-- Header -->
  <div class="text-center mb-16 animate-fade-in">
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-blue-900 mb-6">
      Service <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">Providers Worldwide</span>
    </h2>
    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
      Visit us at our headquarters or get in touch. We're conveniently located in the heart of the city with easy access to public transportation.
    </p>
  </div>

  <!-- Maps Container -->
  <div class="flex justify-center animate-slide-up">
    <!-- Google Maps -->
    <div class="relative max-w-4xl w-full">
      <div class="relative overflow-hidden rounded-3xl shadow-2xl border border-white/20 group">
        <!-- Map Container -->
        <div class="aspect-[16/10] md:aspect-[16/9] lg:aspect-[16/8] relative">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.639225589593!2d-122.08424908469285!3d37.42199997982525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba02425dad8f%3A0x6c296c66619367e0!2sGoogleplex!5e0!3m2!1sen!2sus!4v1703123456789!5m2!1sen!2sus" 
            class="w-full h-full border-0 transition-all duration-500 group-hover:scale-105"
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Our Location">
          </iframe>
        </div>
        
        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent pointer-events-none"></div>
        
        <!-- Floating action -->
        <div class="absolute bottom-4 right-4">
          <a href="https://maps.google.com/?q=Googleplex,+Mountain+View,+CA" 
            target="_blank"
            class="inline-flex items-center space-x-2 bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-full shadow-lg hover:bg-white hover:scale-105 transition-all duration-300 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            <span>Open in Maps</span>
          </a>
        </div>
      </div>

      <!-- Decorative blobs -->
      <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-400/30 rounded-full blur-xl"></div>
      <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-cyan-400/30 rounded-full blur-xl"></div>
    </div>
  </div>

  <!-- Call to Action -->
  <div class="text-center mt-16 animate-fade-in" style="animation-delay: 0.5s;">
    <div class="inline-flex items-center space-x-4 bg-white/10 backdrop-blur-lg rounded-full px-8 py-4 border border-white/20">
      <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
      <span class="text-gray-700 font-medium">We're open and ready to help!</span>
    </div>
  </div>
</div>

        </section>
      </div>

      <!-- Right Column (1/3) -->
      <div class="space-y-6">
        <!-- Monthly Rewards -->
 <!-- Monthly Rewards (Updated Design) -->
<div class="bg-[#3b82f6] text-white p-5 rounded-xl shadow">
  <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
    🎁 Monthly Rewards
  </h3>
  <div class="bg-[#1e3a8a] p-4 rounded-lg space-y-2 text-sm">
    <div class="flex items-start gap-2"><span>🥇</span> <span>1st: 2-week trip to Thailand</span></div>
    <div class="flex items-start gap-2"><span>🥈</span> <span>2nd: 1-week trip to Paris</span></div>
    <div class="flex items-start gap-2"><span>🥉</span> <span>3rd: 3-day trip to Rome</span></div>
    <div class="flex items-start gap-2"><span>🎁</span> <span>4th: €100 Ulixai voucher</span></div>
    <div class="flex items-start gap-2"><span>🎁</span> <span>5th: €50 Ulixai voucher</span></div>
    <div class="flex items-start gap-2"><span>🎫</span> <span>6th: 100% off Ulixai service fees</span></div>
    <div class="flex items-start gap-2"><span>🏷️</span> <span>7th: 80% discount</span></div>
    <div class="flex items-start gap-2"><span>🏷️</span> <span>8th: 60% discount</span></div>
    <div class="flex items-start gap-2"><span>🏷️</span> <span>9th: 40% discount</span></div>
    <div class="flex items-start gap-2"><span>🏷️</span> <span>10th: 20% discount</span></div>
  </div>
</div>


       <!-- Top 10 Players (Updated Design) -->
<div class="bg-[#3b82f6] text-white p-5 rounded-xl shadow">
  <h3 class="text-lg font-bold mb-1 flex items-center gap-2">🏆 Top 10 Ulixai Players</h3>
  <p class="text-xs text-white/80 mb-4">Ranking updated in real time. Official winners will be confirmed at the end of the month.</p>

  <div class="space-y-3 text-sm">
    <!-- Player Row -->
    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">1. Sarah 🇫🇷</div>
        <div class="text-xs text-gray-600">Lives in 🇹🇭 Bangkok</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">120 pts</div>
        <div class="text-xs text-gray-500">Language: French</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">2. Pedro 🇪🇸</div>
        <div class="text-xs text-gray-600">Lives in 🇫🇷 Paris</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">110 pts</div>
        <div class="text-xs text-gray-500">Language: Spanish</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">3. Omar 🇸🇦</div>
        <div class="text-xs text-gray-600">Lives in 🇮🇹 Rome</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">105 pts</div>
        <div class="text-xs text-gray-500">Language: Arabic</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">4. Mia 🇺🇸</div>
        <div class="text-xs text-gray-600">Lives in 🇨🇦 Montréal</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">95 pts</div>
        <div class="text-xs text-gray-500">Language: English</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">5. Kenji 🇯🇵</div>
        <div class="text-xs text-gray-600">Lives in 🇩🇪 Berlin</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">92 pts</div>
        <div class="text-xs text-gray-500">Language: Japanese</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">6. Aisha 🇸🇦</div>
        <div class="text-xs text-gray-600">Lives in 🇦🇪 Dubai</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">90 pts</div>
        <div class="text-xs text-gray-500">Language: Urdu</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">7. Hans 🇩🇪</div>
        <div class="text-xs text-gray-600">Lives in 🇦🇹 Vienna</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">85 pts</div>
        <div class="text-xs text-gray-500">Language: German</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">8. Sofia R 🇧🇪</div>
        <div class="text-xs text-gray-600">Lives in 🇧🇪 Brussels</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">81 pts</div>
        <div class="text-xs text-gray-500">Language: Dutch</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">9. Leo 🇵🇹</div>
        <div class="text-xs text-gray-600">Lives in 🇵🇹 Lisbon</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">78 pts</div>
        <div class="text-xs text-gray-500">Language: Portuguese</div>
      </div>
    </div>

    <div class="bg-white text-gray-800 px-4 py-3 rounded-lg shadow flex justify-between items-center">
      <div>
        <div class="font-semibold">10. Yassine 🇲🇦</div>
        <div class="text-xs text-gray-600">Lives in 🇲🇦 Rabat</div>
      </div>
      <div class="text-right">
        <div class="font-bold text-blue-700">75 pts</div>
        <div class="text-xs text-gray-500">Language: Arabic</div>
      </div>
    </div>
  </div>
</div>

        <!-- Most Active Languages -->
        <div class="bg-blue-800 text-white p-5 rounded-xl shadow">
          <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
            🌐 Most Active Languages
          </h3>
          <ul class="space-y-2 text-sm">
            <li class="bg-white text-gray-800 px-4 py-2 rounded-lg flex justify-between items-center">
              <span class="flex items-center gap-2"><img src="https://flagcdn.com/fr.svg" class="w-5" /> French</span>
              <span class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">1</span>
            </li>
            <li class="bg-white text-gray-800 px-4 py-2 rounded-lg flex justify-between items-center">
              <span class="flex items-center gap-2"><img src="https://flagcdn.com/us.svg" class="w-5" /> English</span>
              <span class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
            </li>
            <li class="bg-white text-gray-800 px-4 py-2 rounded-lg flex justify-between items-center">
              <span class="flex items-center gap-2"><img src="https://flagcdn.com/es.svg" class="w-5" /> Spanish</span>
              <span class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">3</span>
            </li>
            <li class="bg-white text-gray-800 px-4 py-2 rounded-lg flex justify-between items-center">
              <span class="flex items-center gap-2"><img src="https://flagcdn.com/sa.svg" class="w-5" /> Arabic</span>
              <span class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">4</span>
            </li>
            <li class="bg-white text-gray-800 px-4 py-2 rounded-lg flex justify-between items-center">
              <span class="flex items-center gap-2"><img src="https://flagcdn.com/pt.svg" class="w-5" /> Portuguese</span>
              <span class="bg-blue-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">5</span>
            </li>
          </ul>
        </div>
   
      </div>
      
    </div>
    
  </div>

</body>
</html>