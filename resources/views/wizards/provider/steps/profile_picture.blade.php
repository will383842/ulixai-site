<div id="step10" class="hidden">
  <style>
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes pulse-border {
      0%, 100% { border-color: rgba(59, 130, 246, 0.5); }
      50% { border-color: rgba(59, 130, 246, 1); }
    }

    @keyframes gradient {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
    }

    .animate-float {
      animation: float 3s ease-in-out infinite;
    }

    .animate-spin {
      animation: spin 1s linear infinite;
    }

    .shake-animation {
      animation: shake 0.5s ease-in-out;
    }

    .photo-preview {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .photo-preview:hover {
      transform: scale(1.05) rotate(2deg);
    }

    .photo-preview img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }

    .upload-btn {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .upload-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s ease;
    }

    .upload-btn:hover::before {
      left: 100%;
    }

    .upload-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }

    .border-3 {
      border-width: 3px;
    }

    .video-stream-pulse {
      animation: pulse-border 2s infinite;
    }

    #videoStream {
      object-fit: cover;
      transform: scaleX(-1);
    }

    @media (min-width: 768px) {
      .ambient-blob {
        mix-blend-mode: multiply;
        filter: blur(40px);
        opacity: 0.15;
      }
    }

    @media (max-width: 767px) {
      .ambient-blob {
        display: none;
      }
    }

    .score-badge {
      animation: scaleIn 0.3s ease-out;
    }

    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.4s ease-out;
    }
  </style>

  <!-- LOADING OVERLAY -->
  <div id="faceApiLoading" class="fixed inset-0 z-50 hidden bg-gradient-to-br from-blue-600 via-cyan-500 to-teal-600 flex items-center justify-center">
    <div class="text-center px-6">
      <div class="relative mb-6">
        <div class="w-20 h-20 border-8 border-white/30 border-t-white rounded-full animate-spin mx-auto"></div>
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-4xl">📸</span>
        </div>
      </div>
      <div class="space-y-3">
        <p id="loadingMessage" class="text-white text-lg sm:text-xl font-bold min-h-[3rem] px-4 leading-relaxed"></p>
        <div class="flex items-center justify-center gap-2">
          <div class="w-2.5 h-2.5 bg-white rounded-full animate-bounce"></div>
          <div class="w-2.5 h-2.5 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
          <div class="w-2.5 h-2.5 bg-white rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ANALYZING OVERLAY -->
  <div id="analyzingOverlay" class="fixed inset-0 z-40 hidden bg-black/70 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-6 text-center shadow-2xl max-w-sm mx-6">
      <div class="relative mb-4">
        <div class="w-20 h-20 border-8 border-blue-200 border-t-blue-600 rounded-full animate-spin mx-auto"></div>
        <div class="absolute inset-0 flex items-center justify-center">
          <span class="text-3xl">🤖</span>
        </div>
      </div>
      <p id="analyzingMessage" class="text-gray-800 text-base font-bold"></p>
    </div>
  </div>

  <!-- AMBIENT BACKGROUND (desktop only) -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 hidden md:block">
    <div class="ambient-blob absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full"></div>
    <div class="ambient-blob absolute top-20 right-10 w-64 h-64 bg-cyan-300 rounded-full"></div>
    <div class="ambient-blob absolute bottom-10 left-1/2 w-64 h-64 bg-teal-300 rounded-full"></div>
  </div>

  <!-- HEADER -->
  <div class="mb-8 text-center relative px-4">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">📸</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Add Your Profile Picture
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Show your real face to build trust with clients.
    </p>
  </div>

  <!-- PHOTO PREVIEW SECTION -->
  <div class="flex flex-col items-center mb-8 px-4">
    <div class="relative mb-6">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <!-- Preview Circle -->
        <div class="w-40 h-40 sm:w-48 sm:h-48 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative photo-preview shadow-2xl">
          <img id="profilePreview" src="" alt="Profile Preview" class="hidden">
          <div id="profilePlaceholder" class="text-center absolute inset-0 flex flex-col items-center justify-center z-10">
            <div class="text-5xl sm:text-6xl mb-2 animate-float">👤</div>
            <p class="text-blue-400 font-bold text-xs sm:text-sm">No photo yet</p>
          </div>
        </div>

        <!-- Score Badge -->
        <div id="scoreBadge" class="hidden score-badge">
          <div class="flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px]">
            <span id="scoreText" class="text-xl sm:text-2xl font-black whitespace-nowrap"></span>
            <span class="text-[10px] sm:text-xs font-bold opacity-75">Score</span>
          </div>
        </div>
      </div>

      <!-- Verified Label -->
      <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 sm:px-4 py-1.5 rounded-full text-[9px] sm:text-xs font-black shadow-xl z-20">
        Verified after selfie check
      </div>
    </div>

    <!-- MAIN ACTION BUTTONS -->
    <div id="mainButtons" class="flex flex-col sm:flex-row gap-3 mb-4 w-full sm:w-auto">
      <label for="profileUpload" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-5 sm:px-8 py-3.5 rounded-2xl cursor-pointer font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Choose photo</span>
      </label>
      <button type="button" id="takePictureBtn" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-5 sm:px-8 py-3.5 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
        </svg>
        <span>Take a selfie</span>
      </button>
    </div>

    <input type="file" id="profileUpload" name="profile_picture" accept="image/*" class="hidden">

    <!-- CAMERA SECTION -->
    <div id="cameraSection" class="hidden mt-4 text-center w-full">
      <div class="flex flex-col items-center gap-3">
        <p class="text-xs sm:text-sm font-bold text-blue-900 mb-1 sm:mb-3">
          Center your face inside the circle.
        </p>
        <video id="videoStream" autoplay playsinline class="w-40 h-40 sm:w-48 sm:h-48 rounded-full border-4 border-green-400 mb-3 sm:mb-4 shadow-2xl video-stream-pulse object-cover"></video>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto justify-center">
          <button type="button" id="captureBtn" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all w-full sm:w-auto">
            📸 Capture
          </button>
          <button type="button" id="cancelCameraBtn" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all w-full sm:w-auto">
            ✕ Cancel
          </button>
        </div>
      </div>
    </div>

    <!-- VALIDATION BUTTONS -->
    <div id="validationButtons" class="hidden flex flex-col gap-2 sm:gap-3 w-full sm:w-auto mb-4">
      <button type="button" id="validatePhotoBtn" class="upload-btn bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 sm:px-8 py-3.5 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
        </svg>
        <span>Validate this photo</span>
      </button>
      <button type="button" id="retakePhotoBtn" class="upload-btn bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Take another photo</span>
      </button>
    </div>

    <!-- RESULT CARD -->
    <div id="resultCard" class="w-full max-w-md mb-4 hidden"></div>

    <!-- CHANGE PHOTO BUTTON -->
    <div id="changePhotoContainer" class="hidden w-full sm:w-auto mb-4">
      <button type="button" id="changePhotoBtn" class="upload-btn bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Change photo</span>
      </button>
    </div>
  </div>

  <!-- PHOTO REQUIREMENTS -->
  <div class="mb-8 mx-4 rounded-3xl bg-gradient-to-br from-amber-50 to-yellow-50 border-3 border-amber-300 p-5 sm:p-6 shadow-lg text-sm sm:text-base">
    <div class="flex items-start gap-3">
      <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-2xl">✅</span>
      </div>
      <div>
        <h3 class="text-amber-900 font-black text-lg sm:text-xl mb-2">Photo rules (quick & simple)</h3>
        <ul class="text-amber-800 font-semibold space-y-1.5">
          <li>✓ Your full face is clearly visible.</li>
          <li>✓ Good lighting, no heavy filters.</li>
          <li>✓ Professional / friendly appearance.</li>
          <li>✓ You are alone in the photo.</li>
          <li>✓ No sunglasses, masks, or hidden face.</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- NAVIGATION (optional local buttons) -->
  <div class="wizard-nav-container px-4">
    <button id="backToStep9" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep10" type="button" class="nav-btn-next">
      Next
    </button>
  </div>

  <!-- Face-api.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>

  <script>
    (function() {
      'use strict';

      const CONFIG = {
        STORAGE_KEY: 'expats',
        MODEL_URL: 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model',
        MODEL_LOAD_TIMEOUT: 7000,
        ANALYSIS_TIMEOUT: 2000,
        MAX_IMAGE_SIZE: 5 * 1024 * 1024,
        FALLBACK_SCORE: 75,
        SKIN_TONE_THRESHOLD: 0.15
      };

      const LOADING_MESSAGES = [
        "📸 Preparing your selfie check...",
        "🌍 Be visible to millions of expats worldwide.",
        "💰 A great photo helps you get more bookings.",
        "😎 Clients want to see who they work with.",
        "✨ Tip: A natural smile always works better."
      ];

      const ANALYZING_MESSAGES = [
        "🔍 Checking if we clearly see your face...",
        "🤖 Quick verification in progress...",
        "✨ Making sure this is really you...",
        "🎯 Checking framing and visibility...",
        "📊 Almost done..."
      ];

      const state = {
        hasPhoto: false,
        isValidated: false,
        cameraStream: null,
        currentPhotoData: null,
        currentScore: 0,
        modelsLoaded: false,
        fallbackMode: false
      };

      const elements = {
        step: document.getElementById('step10'),
        preview: document.getElementById('profilePreview'),
        placeholder: document.getElementById('profilePlaceholder'),
        upload: document.getElementById('profileUpload'),

        faceApiLoading: document.getElementById('faceApiLoading'),
        loadingMessage: document.getElementById('loadingMessage'),
        analyzingOverlay: document.getElementById('analyzingOverlay'),
        analyzingMessage: document.getElementById('analyzingMessage'),

        mainButtons: document.getElementById('mainButtons'),
        takePictureBtn: document.getElementById('takePictureBtn'),

        cameraSection: document.getElementById('cameraSection'),
        videoStream: document.getElementById('videoStream'),
        captureBtn: document.getElementById('captureBtn'),
        cancelCameraBtn: document.getElementById('cancelCameraBtn'),

        validationButtons: document.getElementById('validationButtons'),
        validatePhotoBtn: document.getElementById('validatePhotoBtn'),
        retakePhotoBtn: document.getElementById('retakePhotoBtn'),

        changePhotoContainer: document.getElementById('changePhotoContainer'),
        changePhotoBtn: document.getElementById('changePhotoBtn'),

        scoreBadge: document.getElementById('scoreBadge'),
        scoreText: document.getElementById('scoreText'),
        resultCard: document.getElementById('resultCard'),

        nextStepBtn: document.getElementById('nextStep10')
      };

      function safeCall(fn, fallback = null) {
        try { return fn(); }
        catch (e) {
          console.error('Error:', e);
          return fallback;
        }
      }

      function timeoutPromise(promise, ms, errorMsg) {
        return Promise.race([
          promise,
          new Promise((_, reject) => setTimeout(
            () => reject(new Error(errorMsg || 'TIMEOUT')),
            ms
          ))
        ]);
      }

      // Local storage helpers
      function getLocalStorage() {
        return safeCall(() => {
          const data = localStorage.getItem(CONFIG.STORAGE_KEY);
          return data ? JSON.parse(data) : {};
        }, {});
      }

      function savePhotoToLocalStorage(imageData, score, validated) {
        return safeCall(() => {
          const data = getLocalStorage();
          data.profilePhoto = {
            image: imageData,
            score: score,
            validated: !!validated,
            timestamp: new Date().toISOString()
          };
          localStorage.setItem(CONFIG.STORAGE_KEY, JSON.stringify(data));

          state.hasPhoto = true;
          state.isValidated = !!validated;
          state.currentPhotoData = imageData;
          state.currentScore = score;

          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }

          return true;
        }, false);
      }

      function removePhotoFromLocalStorage() {
        return safeCall(() => {
          const data = getLocalStorage();
          delete data.profilePhoto;
          localStorage.setItem(CONFIG.STORAGE_KEY, JSON.stringify(data));

          state.hasPhoto = false;
          state.isValidated = false;
          state.currentPhotoData = null;
          state.currentScore = 0;

          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }

          return true;
        }, false);
      }

      // Overlays
      let loadingMessageInterval = null;
      let analyzingMessageInterval = null;

      function showLoadingScreen() {
        if (!elements.faceApiLoading) return;
        elements.faceApiLoading.classList.remove('hidden');

        let i = 0;
        if (elements.loadingMessage) {
          elements.loadingMessage.textContent = LOADING_MESSAGES[0];
        }
        if (loadingMessageInterval) clearInterval(loadingMessageInterval);
        loadingMessageInterval = setInterval(() => {
          if (!elements.loadingMessage) return;
          i = (i + 1) % LOADING_MESSAGES.length;
          elements.loadingMessage.textContent = LOADING_MESSAGES[i];
        }, 3000);
      }

      function hideLoadingScreen() {
        if (elements.faceApiLoading) elements.faceApiLoading.classList.add('hidden');
        if (loadingMessageInterval) {
          clearInterval(loadingMessageInterval);
          loadingMessageInterval = null;
        }
      }

      function showAnalyzingOverlay() {
        if (!elements.analyzingOverlay) return;
        elements.analyzingOverlay.classList.remove('hidden');

        let i = 0;
        if (elements.analyzingMessage) {
          elements.analyzingMessage.textContent = ANALYZING_MESSAGES[0];
        }
        if (analyzingMessageInterval) clearInterval(analyzingMessageInterval);
        analyzingMessageInterval = setInterval(() => {
          if (!elements.analyzingMessage) return;
          i = (i + 1) % ANALYZING_MESSAGES.length;
          elements.analyzingMessage.textContent = ANALYZING_MESSAGES[i];
        }, 600);
      }

      function hideAnalyzingOverlay() {
        if (elements.analyzingOverlay) elements.analyzingOverlay.classList.add('hidden');
        if (analyzingMessageInterval) {
          clearInterval(analyzingMessageInterval);
          analyzingMessageInterval = null;
        }
      }

      // Face API
      async function loadFaceApiModels() {
        if (state.modelsLoaded) return true;

        if (typeof faceapi === 'undefined') {
          console.warn('face-api not available, using fallback mode.');
          state.fallbackMode = true;
          return false;
        }

        showLoadingScreen();
        try {
          await timeoutPromise(
            faceapi.nets.tinyFaceDetector.loadFromUri(CONFIG.MODEL_URL),
            CONFIG.MODEL_LOAD_TIMEOUT,
            'MODEL_LOAD_TIMEOUT'
          );
          state.modelsLoaded = true;
          state.fallbackMode = false;
          hideLoadingScreen();
          return true;
        } catch (e) {
          console.warn('face-api load failed, using fallback mode.', e);
          state.fallbackMode = true;
          hideLoadingScreen();
          return false;
        }
      }

      async function checkSkinTone(imageElement) {
        try {
          const canvas = document.createElement('canvas');
          const ctx = canvas.getContext('2d');
          if (!ctx) return false;

          canvas.width = imageElement.width || imageElement.naturalWidth;
          canvas.height = imageElement.height || imageElement.naturalHeight;
          ctx.drawImage(imageElement, 0, 0);

          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
          const data = imageData.data;
          let skinTonePixels = 0;
          const totalPixels = data.length / 4;

          for (let i = 0; i < data.length; i += 40) {
            const r = data[i], g = data[i + 1], b = data[i + 2];
            const isValidSkinTone =
              r > 95 && r < 235 &&
              g > 55 && g < 215 &&
              b > 20 && b < 185 &&
              r > g && g > b &&
              (r - g) > 15 && (r - g) < 80 &&
              (g - b) > 10 && (g - b) < 70 &&
              (r - b) > 25;
            if (isValidSkinTone) skinTonePixels++;
          }

          const sampledTotal = totalPixels / 10 || 1;
          const skinToneRatio = skinTonePixels / sampledTotal;

          return skinToneRatio >= CONFIG.SKIN_TONE_THRESHOLD;
        } catch (e) {
          console.error('Skin tone check error:', e);
          return false;
        }
      }

      function calculateScore(detections, imageElement) {
        let score = 0;
        const details = { faces: detections.length };

        // Faces count
        if (details.faces === 1) {
          score += 40;
          details.faceCount = 'single';
        } else if (details.faces === 0) {
          details.faceCount = 'none';
          details.issue = 'no_face';
          return { score: 0, details };
        } else {
          score += 20;
          details.faceCount = 'multiple';
          details.issue = 'multiple_faces';
        }

        if (details.faces === 1) {
          const detection = detections[0];
          const box = detection.box;
          const imgWidth = imageElement.width || imageElement.naturalWidth || 1;
          const imgHeight = imageElement.height || imageElement.naturalHeight || 1;

          const faceArea = box.width * box.height;
          const imageArea = imgWidth * imgHeight;
          const faceRatio = imageArea > 0 ? faceArea / imageArea : 0;
          details.faceRatio = faceRatio;

          if (faceRatio > 0.30) { score += 20; details.size = 'perfect'; }
          else if (faceRatio > 0.20) { score += 15; details.size = 'good'; }
          else if (faceRatio > 0.10) { score += 10; details.size = 'small'; details.issue ??= 'face_too_small'; }
          else { score += 5; details.size = 'very_small'; details.issue ??= 'face_too_small'; }

          // Centering
          const faceCenterX = box.x + box.width / 2;
          const faceCenterY = box.y + box.height / 2;
          const imgCenterX = imgWidth / 2;
          const imgCenterY = imgHeight / 2;

          const offsetX = Math.abs(faceCenterX - imgCenterX) / imgWidth;
          const offsetY = Math.abs(faceCenterY - imgCenterY) / imgHeight;
          const totalOffset = (offsetX + offsetY) / 2;

          if (totalOffset < 0.15) score += 15;
          else if (totalOffset < 0.25) score += 10;
          else score += 5;

          // Confidence
          const confidence = detection.score || 0;
          details.confidence = confidence;

          if (confidence > 0.8) score += 15;
          else if (confidence > 0.6) score += 10;
          else if (confidence > 0.4) score += 5;

          // Simple sharpness bonus
          score += 10;
        }

        const finalScore = Math.min(100, Math.max(0, score));
        return { score: finalScore, details };
      }

      async function analyzePhoto(imageElement) {
        try {
          const detections = await timeoutPromise(
            faceapi.detectAllFaces(imageElement, new faceapi.TinyFaceDetectorOptions()),
            CONFIG.ANALYSIS_TIMEOUT,
            'ANALYSIS_TIMEOUT'
          );

          const scoreData = calculateScore(detections, imageElement);
          const hasSkinTone = await checkSkinTone(imageElement);

          if (!hasSkinTone) {
            scoreData.details.noSkinTone = true;
            scoreData.details.faces = 0;
            scoreData.score = 0;
          }

          return scoreData;
        } catch (e) {
          console.error('Face detection error:', e);
          return { score: 0, details: { fallback: true, reason: 'detection_error', faces: 0 } };
        }
      }

      async function basicImageCheck(imageElement) {
        try {
          const canvas = document.createElement('canvas');
          const ctx = canvas.getContext('2d');
          if (!ctx) return { score: 0, details: { fallback: true, faces: 0 } };

          canvas.width = imageElement.width || imageElement.naturalWidth;
          canvas.height = imageElement.height || imageElement.naturalHeight;
          ctx.drawImage(imageElement, 0, 0);

          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
          const data = imageData.data;
          let skinTonePixels = 0;
          const totalPixels = data.length / 4;

          for (let i = 0; i < data.length; i += 40) {
            const r = data[i], g = data[i + 1], b = data[i + 2];
            const isValidSkinTone =
              r > 95 && r < 235 &&
              g > 55 && g < 215 &&
              b > 20 && b < 185 &&
              r > g && g > b &&
              (r - g) > 15 && (r - g) < 80 &&
              (g - b) > 10 && (g - b) < 70 &&
              (r - b) > 25;
            if (isValidSkinTone) skinTonePixels++;
          }

          const sampledTotal = totalPixels / 10 || 1;
          const skinToneRatio = skinTonePixels / sampledTotal;

          if (skinToneRatio < CONFIG.SKIN_TONE_THRESHOLD) {
            return {
              score: 0,
              details: { fallback: true, noSkinTone: true, faces: 0 }
            };
          }

          return {
            score: CONFIG.FALLBACK_SCORE,
            details: { fallback: true, faces: 1, skinToneDetected: true }
          };
        } catch (e) {
          console.error('Fallback check error:', e);
          return { score: 0, details: { fallback: true, faces: 0 } };
        }
      }

      function evaluatePhotoAcceptance(scoreData) {
        const { score, details } = scoreData;

        // No face or no skin tone
        if (details.faces === 0 || details.noSkinTone) {
          return {
            accepted: false,
            reason: details.noSkinTone ? 'no_skin_tone' : 'no_face',
            message: "Oops... Your photo was not accepted.",
            explanation: details.noSkinTone
              ? "This image looks more like a logo, object, or screenshot. We need a real selfie showing your face."
              : "We could not clearly detect your face. We need to see your full face to confirm who you are.",
            solutions: [
              "Use a real selfie of you (not a logo or document).",
              "Make sure your whole face is visible: eyes, nose, mouth.",
              "Avoid heavy filters or extreme shadows.",
              "Stand alone in front of the camera."
            ]
          };
        }

        // Multiple faces
        if (details.faces > 1) {
          return {
            accepted: false,
            reason: 'multiple_faces',
            message: "Oops... Your photo was not accepted.",
            explanation: "We detected several people. Clients must clearly see who they are booking.",
            solutions: [
              "Take a selfie where only you are visible.",
              "Ask other people to move out of the frame.",
              "Check reflections or posters with faces in the background."
            ]
          };
        }

        // Face too small
        if (details.size === 'very_small' || (details.faceRatio && details.faceRatio < 0.10)) {
          return {
            accepted: false,
            reason: 'face_too_small',
            message: "Oops... Your photo was not accepted.",
            explanation: "Your face is too small in the photo. We cannot clearly recognize you.",
            solutions: [
              "Move closer so your face fills at least one third of the image.",
              "Center your face inside the frame.",
              "Keep your shoulders and head visible."
            ]
          };
        }

        // Very low confidence (blurry / hidden)
        if (details.confidence && details.confidence < 0.40) {
          return {
            accepted: false,
            reason: 'low_confidence',
            message: "Oops... Your photo was not accepted.",
            explanation: "The photo looks blurry or your face is partly covered.",
            solutions: [
              "Remove sunglasses, masks, or anything hiding your face.",
              "Tie back hair if it fully covers your face.",
              "Use better lighting and hold your phone still."
            ]
          };
        }

        return { accepted: true, score, details };
      }

      // UI state helpers
      function resetPhotoUI() {
        if (elements.preview) {
          elements.preview.classList.add('hidden');
          elements.preview.src = '';
        }
        if (elements.placeholder) {
          elements.placeholder.classList.remove('hidden');
        }
        if (elements.scoreBadge) {
          elements.scoreBadge.classList.add('hidden');
        }
        if (elements.upload) {
          elements.upload.value = '';
        }
        state.currentPhotoData = null;
        state.currentScore = 0;
      }

      function hideAllStates() {
        if (elements.mainButtons) elements.mainButtons.classList.add('hidden');
        if (elements.cameraSection) elements.cameraSection.classList.add('hidden');
        if (elements.validationButtons) elements.validationButtons.classList.add('hidden');
        if (elements.changePhotoContainer) elements.changePhotoContainer.classList.add('hidden');
      }

      function showMainButtons() {
        hideAllStates();
        if (elements.mainButtons) elements.mainButtons.classList.remove('hidden');
      }

      function showCamera() {
        hideAllStates();
        if (elements.cameraSection) elements.cameraSection.classList.remove('hidden');
      }

      function showValidationButtons() {
        hideAllStates();
        if (elements.validationButtons) elements.validationButtons.classList.remove('hidden');
      }

      function showChangePhotoButton() {
        hideAllStates();
        if (elements.changePhotoContainer) elements.changePhotoContainer.classList.remove('hidden');
      }

      // Display rejection
      function displayRejection(rejection) {
        safeCall(() => {
          if (elements.scoreBadge) elements.scoreBadge.classList.add('hidden');
          closeCamera();
          removePhotoFromLocalStorage();
          resetPhotoUI();

          if (elements.resultCard) {
            elements.resultCard.innerHTML = `
              <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
                <div class="text-center space-y-2">
                  <div class="text-4xl mb-1">😅</div>
                  <p class="text-lg sm:text-xl font-black text-red-700">Oops... Your photo was not accepted.</p>
                  <p class="text-sm sm:text-base font-semibold text-red-600">
                    ${rejection.message || "Let's try again with a clearer selfie."}
                  </p>
                </div>
                <div class="bg-white/80 rounded-xl p-3 sm:p-4 space-y-2">
                  <p class="text-xs sm:text-sm font-bold text-gray-800">Why?</p>
                  <p class="text-xs sm:text-sm text-gray-700 leading-relaxed">${rejection.explanation}</p>
                  <p class="text-xs sm:text-sm font-bold text-gray-800 mt-2">How to fix it:</p>
                  <ul class="space-y-1">
                    ${rejection.solutions.map(s => `<li class="text-xs sm:text-sm text-gray-700">• ${s}</li>`).join('')}
                  </ul>
                </div>
                <p class="text-xs sm:text-sm font-bold text-red-700 text-center">
                  Please try again with a clear selfie. You can choose a photo or take a new one.
                </p>
              </div>
            `;
            elements.resultCard.classList.remove('hidden');
          }

          showMainButtons();
        });
      }

      // Display score + accept
      function displayScore(scoreData) {
        const score = scoreData.score;
        const details = scoreData.details || {};

        if (score === 0 || details.faces === 0) {
          displayRejection({
            message: "This photo does not meet the minimum requirements.",
            explanation: "We could not clearly confirm that this is a proper selfie.",
            solutions: [
              "Use a real selfie with your full face.",
              "Avoid logos, documents, or screenshots.",
              "Center your face and improve the lighting."
            ]
          });
          return;
        }

        safeCall(() => {
          if (elements.scoreBadge) elements.scoreBadge.classList.remove('hidden');
        });

        let badgeClass, cardClass, barClass, emoji, title, message;

        if (score >= 95) {
          badgeClass = 'bg-gradient-to-r from-green-600 to-emerald-600';
          cardClass = 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-400';
          barClass = 'bg-gradient-to-r from-green-600 to-emerald-600';
          emoji = '🏆';
          title = 'Outstanding selfie!';
          message = "This photo is perfect to inspire trust.";
        } else if (score >= 80) {
          badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
          cardClass = 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-400';
          barClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
          emoji = '✨';
          title = 'Great photo!';
          message = "Clear, professional and client-friendly.";
        } else if (score >= 60) {
          badgeClass = 'bg-gradient-to-r from-yellow-500 to-orange-500';
          cardClass = 'bg-gradient-to-r from-yellow-50 to-orange-50 border-yellow-400';
          barClass = 'bg-gradient-to-r from-yellow-500 to-orange-500';
          emoji = '👍';
          title = 'Photo validated';
          message = "It works. You can improve it later if you want.";
        } else {
          badgeClass = 'bg-gradient-to-r from-orange-600 to-red-500';
          cardClass = 'bg-gradient-to-r from-orange-50 to-red-50 border-orange-400';
          barClass = 'bg-gradient-to-r from-orange-600 to-red-500';
          emoji = '⚠️';
          title = 'Acceptable photo';
          message = "It is accepted, but you could upload a clearer one.";
        }

        safeCall(() => {
          if (elements.scoreBadge) {
            const badgeInner = elements.scoreBadge.querySelector('div');
            if (badgeInner) {
              badgeInner.className =
                `flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px] ${badgeClass}`;
            }
            if (elements.scoreText) {
              elements.scoreText.textContent = `${emoji} ${score}`;
            }
          }

          if (elements.resultCard) {
            elements.resultCard.innerHTML = `
              <div class="rounded-2xl p-4 sm:p-5 space-y-3 border-3 transition-all ${cardClass} fade-in">
                <div class="flex justify-between items-center">
                  <span class="text-xs sm:text-sm font-bold text-gray-700">Selfie check result</span>
                  <span class="text-3xl sm:text-4xl font-black">${emoji} ${score}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                  <div class="h-full rounded-full transition-all duration-700 ${barClass}" style="width: ${score}%;"></div>
                </div>
                <div class="text-center space-y-1">
                  <p class="text-lg sm:text-xl font-black leading-relaxed">${title}</p>
                  <p class="text-sm sm:text-base font-semibold leading-relaxed">${message}</p>
                </div>
              </div>
            `;
            elements.resultCard.classList.remove('hidden');
          }
        });

        if (score > 0) {
          state.currentScore = score;
          savePhotoToLocalStorage(state.currentPhotoData, score, true);
          showChangePhotoButton();
        }
      }

      // Camera
      async function openCamera() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
          alert("Your device camera is not available. Please upload a photo from your gallery instead.");
          return;
        }

        try {
          const stream = await navigator.mediaDevices.getUserMedia({
            video: {
              facingMode: 'user',
              width: { ideal: 1280 },
              height: { ideal: 1280 }
            },
            audio: false
          });

          state.cameraStream = stream;
          if (elements.videoStream) {
            elements.videoStream.srcObject = stream;
          }
          showCamera();
        } catch (e) {
          console.error('Camera error:', e);
          alert("We could not access your camera. Please upload a photo from your device instead.");
          showMainButtons();
        }
      }

      function closeCamera() {
        if (state.cameraStream) {
          state.cameraStream.getTracks().forEach(track => track.stop());
          state.cameraStream = null;
        }
        if (elements.videoStream) {
          elements.videoStream.srcObject = null;
        }
      }

      function capturePhoto() {
        if (!elements.videoStream || !elements.videoStream.videoWidth) return;

        const video = elements.videoStream;
        const size = Math.min(video.videoWidth, video.videoHeight);

        const canvas = document.createElement('canvas');
        canvas.width = size;
        canvas.height = size;

        const ctx = canvas.getContext('2d');
        if (!ctx) return;

        const startX = (video.videoWidth - size) / 2;
        const startY = (video.videoHeight - size) / 2;

        ctx.save();
        ctx.scale(-1, 1);
        ctx.drawImage(video, startX, startY, size, size, -size, 0, size, size);
        ctx.restore();

        const imageData = canvas.toDataURL('image/jpeg', 0.92);

        if (elements.preview) {
          elements.preview.src = imageData;
          elements.preview.classList.remove('hidden');
        }
        if (elements.placeholder) {
          elements.placeholder.classList.add('hidden');
        }

        state.currentPhotoData = imageData;
        closeCamera();
        showValidationButtons();
      }

      // Upload
      function handleFileUpload(file) {
        if (!file || !file.type.startsWith('image/')) {
          alert('Please select an image file.');
          return;
        }

        if (file.size > CONFIG.MAX_IMAGE_SIZE) {
          alert('Your image is too large. Max size: 5 MB.');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
          const result = e.target && e.target.result;
          if (!result) {
            alert('We could not read this file. Please try another photo.');
            return;
          }

          const img = new Image();
          img.onload = function() {
            if (elements.preview) {
              elements.preview.src = result;
              elements.preview.classList.remove('hidden');
            }
            if (elements.placeholder) {
              elements.placeholder.classList.add('hidden');
            }

            state.currentPhotoData = result;
            showValidationButtons();
          };
          img.onerror = function() {
            alert('We could not load this image. Please try another one.');
          };
          img.src = result;
        };
        reader.onerror = function() {
          alert('We could not read this file. Please try again.');
        };
        reader.readAsDataURL(file);
      }

      // Analyze + validate
      async function analyzeAndValidate() {
        if (!state.currentPhotoData) {
          alert('Please choose a photo or take a selfie first.');
          return;
        }

        if (!state.modelsLoaded && !state.fallbackMode) {
          await loadFaceApiModels();
        }

        showAnalyzingOverlay();

        const img = new Image();
        img.onload = async function() {
          try {
            let scoreData;
            if (state.fallbackMode) {
              scoreData = await basicImageCheck(img);
            } else {
              scoreData = await analyzePhoto(img);
            }

            hideAnalyzingOverlay();

            const evaluation = evaluatePhotoAcceptance(scoreData);
            if (evaluation.accepted) {
              displayScore(scoreData);
            } else {
              displayRejection(evaluation);
            }
          } catch (e) {
            console.error('Analysis error:', e);
            hideAnalyzingOverlay();
            alert('We could not analyze your photo. Please try again with another one.');
          }
        };
        img.onerror = function() {
          hideAnalyzingOverlay();
          alert('We could not load your photo for verification. Please try again.');
        };
        img.src = state.currentPhotoData;
      }

      // Restore previous valid photo
      function restorePhoto() {
        try {
          const data = getLocalStorage();
          const saved = data.profilePhoto;

          if (saved && saved.image) {
            const imageData = saved.image;
            const score = saved.score || CONFIG.FALLBACK_SCORE;
            const validated = !!saved.validated;

            const img = new Image();
            img.onload = function() {
              if (elements.preview) {
                elements.preview.src = imageData;
                elements.preview.classList.remove('hidden');
              }
              if (elements.placeholder) {
                elements.placeholder.classList.add('hidden');
              }

              state.hasPhoto = true;
              state.isValidated = validated;
              state.currentPhotoData = imageData;
              state.currentScore = score;

              if (validated) {
                if (elements.scoreBadge) {
                  elements.scoreBadge.classList.remove('hidden');

                  let badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
                  let emoji = '✨';
                  if (score >= 95) { badgeClass = 'bg-gradient-to-r from-green-600 to-emerald-600'; emoji = '🏆'; }
                  else if (score >= 80) { badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600'; emoji = '✨'; }
                  else if (score >= 60) { badgeClass = 'bg-gradient-to-r from-yellow-500 to-orange-500'; emoji = '👍'; }
                  else { badgeClass = 'bg-gradient-to-r from-orange-600 to-red-500'; emoji = '⚠️'; }

                  const badgeInner = elements.scoreBadge.querySelector('div');
                  if (badgeInner) {
                    badgeInner.className =
                      `flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px] ${badgeClass}`;
                  }
                  if (elements.scoreText) {
                    elements.scoreText.textContent = `${emoji} ${score}`;
                  }
                }
                showChangePhotoButton();
              } else {
                state.isValidated = false;
                showMainButtons();
              }

              if (typeof window.updateNavigationButtons === 'function') {
                window.updateNavigationButtons();
              }
            };
            img.onerror = function() {
              state.hasPhoto = false;
              state.isValidated = false;
              resetPhotoUI();
              showMainButtons();
            };
            img.src = imageData;
          } else {
            state.hasPhoto = false;
            state.isValidated = false;
            resetPhotoUI();
            showMainButtons();
          }
        } catch (e) {
          console.error('Restore error:', e);
          state.hasPhoto = false;
          state.isValidated = false;
          resetPhotoUI();
          showMainButtons();
        }
      }

      // Public validation hook
      window.validateStep10 = function(showAlert) {
        const ok = state.hasPhoto && state.isValidated;
        if (!ok && showAlert) {
          alert('To continue, please validate a clear selfie of yourself.');
        }
        return ok;
      };

      // Event listeners
      if (elements.upload) {
        elements.upload.addEventListener('change', e => {
          const file = e.target.files && e.target.files[0];
          if (file) handleFileUpload(file);
        });
      }

      if (elements.takePictureBtn) {
        elements.takePictureBtn.addEventListener('click', openCamera);
      }

      if (elements.captureBtn) {
        elements.captureBtn.addEventListener('click', capturePhoto);
      }

      if (elements.cancelCameraBtn) {
        elements.cancelCameraBtn.addEventListener('click', () => {
          closeCamera();
          resetPhotoUI();
          showMainButtons();
        });
      }

      if (elements.validatePhotoBtn) {
        elements.validatePhotoBtn.addEventListener('click', analyzeAndValidate);
      }

      if (elements.retakePhotoBtn) {
        elements.retakePhotoBtn.addEventListener('click', () => {
          closeCamera();
          resetPhotoUI();
          showMainButtons();
        });
      }

      if (elements.changePhotoBtn) {
        elements.changePhotoBtn.addEventListener('click', () => {
          closeCamera();
          removePhotoFromLocalStorage();
          resetPhotoUI();
          showMainButtons();
        });
      }

      if (elements.nextStepBtn) {
        elements.nextStepBtn.addEventListener('click', e => {
          if (!window.validateStep10(true)) {
            e.preventDefault();
            e.stopPropagation();
          }
        });
      }

      // Cleanup when leaving step or page
      function cleanup() {
        closeCamera();
        hideLoadingScreen();
        hideAnalyzingOverlay();
      }

      if (elements.step) {
        const observer = new MutationObserver(mutations => {
          mutations.forEach(mutation => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
              const isHidden = elements.step.classList.contains('hidden');
              if (!isHidden) {
                if (!state.modelsLoaded && !state.fallbackMode) {
                  loadFaceApiModels();
                }
                restorePhoto();
              } else {
                cleanup();
              }
            }
          });
        });

        observer.observe(elements.step, { attributes: true });
      }

      window.addEventListener('beforeunload', cleanup);

      // If step10 is visible on load
      if (elements.step && !elements.step.classList.contains('hidden')) {
        if (!state.modelsLoaded && !state.fallbackMode) {
          loadFaceApiModels();
        }
        restorePhoto();
      }
    })();
  </script>
</div>
