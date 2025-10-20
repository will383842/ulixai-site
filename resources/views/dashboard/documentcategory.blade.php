<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Step Modal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .step-content { display: none; }
    .step-content.active { display: block; }
  </style>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 min-h-screen font-sans flex">
   <?php include('../includes/header.php'); ?>
    <?php include('../popup.php'); ?>
   

  <?php include('sidebardash.php'); ?>

  <div class="flex-1 p-6">
    <h2 class="text-blue-900 font-bold mb-4 text-md uppercase">In what areas do you want to help?</h2>
    <div class="grid grid-cols-3 gap-4 mb-10">
      <div class="category bg-orange-400 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">👨‍👩‍👧</div>
      <div class="category bg-blue-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">🌐</div>
      <div class="category bg-green-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">👶</div>
      <div class="category bg-gray-400 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">💼</div>
      <div class="category bg-red-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">🚲</div>
      <div class="category bg-purple-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">💻</div>
      <div class="category bg-orange-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">👷</div>
      <div class="category bg-blue-400 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">🚴</div>
      <div class="category bg-teal-500 rounded-full w-20 h-20 flex items-center justify-center text-white text-3xl cursor-pointer">💡</div>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[95vh] overflow-y-auto relative p-6">
      <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

      <!-- Step 1 -->
      <div class="step-content active" id="step1">
        <h3 class="text-blue-900 font-bold text-md mb-4 uppercase">I Send My Identity Card</h3>
        <div class="flex gap-6 justify-center">
          <div class="text-center">
            <p class="text-sm text-gray-700 mb-1">Front</p>
            <label class="border-2 border-blue-400 rounded-xl w-40 h-40 flex flex-col items-center justify-center cursor-pointer">
              <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-10 h-10 mb-1 opacity-70" />
              <span class="text-blue-400 text-sm">Upload photo</span>
              <input type="file" class="hidden" />
            </label>
          </div>
          <div class="text-center">
            <p class="text-sm text-gray-700 mb-1">Back</p>
            <label class="border-2 border-blue-400 rounded-xl w-40 h-40 flex flex-col items-center justify-center cursor-pointer">
              <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-10 h-10 mb-1 opacity-70" />
              <span class="text-blue-400 text-sm">Upload photo</span>
              <input type="file" class="hidden" />
            </label>
          </div>
        </div>
        <div class="flex justify-end mt-6">
          <button onclick="nextStep(2)" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step-content" id="step2">
        <h3 class="text-blue-900 font-bold text-md mb-6 uppercase">Do You Have a Special Status?</h3>
        <div class="space-y-4" id="specialStatusList"></div>
        <div class="flex justify-between items-center mt-6">
          <button onclick="nextStep(1)" class="text-blue-600 text-sm font-medium underline">Back</button>
          <button onclick="nextStep(3)" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-content" id="step3">
        <h3 class="text-blue-900 font-bold text-md mb-2 uppercase">Say a few words about yourself to make your profile stand out</h3>
        <p class="text-sm text-blue-500 mb-4">The better you describe yourself, the more jobs you will get (watch out for spelling mistakes)</p>
        <div class="relative">
          <textarea 
            id="profileText"
            maxlength="600"
            rows="5"
            class="w-full p-4 border rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none placeholder-gray-400"
            placeholder="I am a conscientious, highly professional, and friendly individual... I specialize in..."></textarea>
          <span id="charCount" class="absolute bottom-2 right-4 text-xs text-gray-400">0/600</span>
        </div>
        <div class="flex justify-between items-center mt-6">
          <button onclick="nextStep(2)" class="text-blue-600 text-sm font-medium underline">Back</button>
          <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">
        <a href="pointscalculation.php">    Submit </a>
        </button>
        </div>
        <div class="mt-4">
          <div class="w-full bg-gray-200 h-1 rounded-full overflow-hidden">
            <div id="progressBar" class="h-full bg-blue-500 w-full transition-all duration-300"></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Scripts -->
  <script>
    const specialStatuses = [
      { label: "Expatriates for 2 to 5 years", color: "bg-pink-500" },
      { label: "Expatriates for more 10 years", color: "bg-green-400" },
      { label: "Lawyer", color: "bg-green-400" },
      { label: "Legal advice", color: "bg-pink-500" },
      { label: "Insurer", color: "bg-blue-600" },
      { label: "Real estate agent", color: "bg-blue-600" },
      { label: "Translator", color: "bg-pink-500" },
      { label: "Guide", color: "bg-pink-500" },
      { label: "Language teacher", color: "bg-pink-500" },
    ];

    function nextStep(stepNumber) {
      document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
      document.getElementById('step' + stepNumber).classList.add('active');
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
      nextStep(1);
    }

    document.querySelectorAll('.category').forEach(item => {
      item.addEventListener('click', () => {
        document.getElementById('modal').classList.remove('hidden');
        nextStep(1);
      });
    });

    document.addEventListener("DOMContentLoaded", () => {
      const container = document.getElementById("specialStatusList");
      specialStatuses.forEach((item, index) => {
        const row = document.createElement("div");
        row.className = "flex items-center justify-between px-4 py-3 rounded-full border";

        row.innerHTML = `
          <span class="flex items-center gap-2 text-sm font-medium text-gray-800">
            <span class="w-4 h-4 rounded-full ${item.color}"></span>
            ${item.label}
          </span>
          <div class="flex gap-2">
            <button class="toggle-btn px-4 py-1 rounded-full text-sm border border-green-500 text-green-500 bg-white hover:bg-green-50" data-index="${index}" data-value="yes">Yes</button>
            <button class="toggle-btn px-4 py-1 rounded-full text-sm border border-green-500 text-green-500 bg-white hover:bg-green-50" data-index="${index}" data-value="no">No</button>
          </div>
        `;
        container.appendChild(row);
      });

      document.querySelectorAll(".toggle-btn").forEach(btn => {
        btn.addEventListener("click", () => {
          const index = btn.dataset.index;
          document.querySelectorAll(`.toggle-btn[data-index="${index}"]`).forEach(b => {
            b.classList.remove("bg-green-500", "text-white");
            b.classList.add("bg-white", "text-green-500");
          });
          btn.classList.remove("bg-white", "text-green-500");
          btn.classList.add("bg-green-500", "text-white");
        });
      });

      const textarea = document.getElementById("profileText");
      const charCount = document.getElementById("charCount");
      textarea.addEventListener("input", () => {
        charCount.textContent = `${textarea.value.length}/600`;
      });
    });
  </script>
  <?php include('bottomnavbar.php'); ?>
</body>
</html>