<div id="step10" class="hidden flex flex-col h-full" role="region" aria-label="Add your profile picture">
  
  <!-- ============================================
       FIXED HEADER (STICKY) - TON STYLE
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 animated blobs -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-lg sm:text-xl">📸</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Take Your Selfie! 🤳
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Show your authentic self to future clients
        </p>
      </div>

      <!-- Status Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-300 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-red-700">
          Required for payment verification
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       SCROLLABLE CONTENT - MON CODE API
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-4 space-y-4 px-4">

    <!-- Header -->
    <div class="text-center mb-4">
      <p class="text-gray-600 text-base sm:text-lg font-semibold">
        Show your real face to build trust with clients.
      </p>
    </div>

    <!-- Photo Preview Section -->
    <div class="flex flex-col items-center mb-8">
      <div class="relative mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <!-- Preview Circle -->
          <div class="w-40 h-40 sm:w-48 sm:h-48 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative photo-preview shadow-2xl">
            <img id="profilePreview" src="" alt="Profile Preview" class="hidden absolute inset-0 w-full h-full object-cover">
            <div id="profilePlaceholder" class="text-center absolute inset-0 flex flex-col items-center justify-center z-10">
              <div class="text-5xl sm:text-6xl mb-2 animate-float">👤</div>
              <p class="text-blue-400 font-bold text-xs sm:text-sm">No photo yet</p>
            </div>

            <!-- Verification Overlay -->
            <div id="verificationOverlay" class="hidden absolute inset-0 bg-white bg-opacity-95 flex flex-col items-center justify-center z-20 rounded-full">
              <div class="spinner mb-3"></div>
              <p id="verificationMessage" class="text-gray-700 font-semibold text-sm">Verifying...</p>
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

      <!-- CHANGE PHOTO BUTTON -->
      <div id="changePhotoContainer" class="hidden w-full sm:w-auto mb-4">
        <button type="button" id="changePhotoBtn" class="upload-btn bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          <span>Change photo</span>
        </button>
      </div>

      <!-- RESULT CARD -->
      <div id="resultCard" class="w-full max-w-md mb-4 hidden"></div>
    </div>

    <!-- PHOTO REQUIREMENTS -->
    <div class="mb-8 rounded-3xl bg-gradient-to-br from-amber-50 to-yellow-50 border-3 border-amber-300 p-5 sm:p-6 shadow-lg text-sm sm:text-base">
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
  </div>

  <!-- NAVIGATION -->
  <div class="wizard-nav-container px-4">
    <button id="backToStep9" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep10" type="button" class="nav-btn-next">
      Next
    </button>
  </div>

</div>

<!-- STYLES -->
<style>
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
  animation: blob 7s infinite;
  will-change: transform;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid #e5e7eb;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}

.fade-in {
  animation: fadeIn 0.4s ease-out;
}

.photo-preview {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.photo-preview:hover {
  transform: scale(1.05) rotate(2deg);
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

@keyframes pulse-border {
  0%, 100% { border-color: rgba(59, 130, 246, 0.5); }
  50% { border-color: rgba(59, 130, 246, 1); }
}

.video-stream-pulse {
  animation: pulse-border 2s infinite;
}

#videoStream {
  object-fit: cover;
  transform: scaleX(-1);
}

.score-badge {
  animation: scaleIn 0.3s ease-out;
}

@keyframes scaleIn {
  from { opacity: 0; transform: scale(0.8); }
  to { opacity: 1; transform: scale(1); }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<!-- JAVASCRIPT - RESTE LE MÊME QUE MON CODE PRÉCÉDENT -->
<script>
  (function() {
    'use strict';

    // Configuration API
    const API_BASE_URL = '/api/provider/verification';
    
    @auth
      const API_TOKEN = '{{ auth()->user()->createToken("provider-verification")->plainTextToken }}';
      const IS_AUTHENTICATED = true;
    @else
      const API_TOKEN = '';
      const IS_AUTHENTICATED = false;
    @endauth

    const CONFIG = {
      STORAGE_KEY: 'expats',
      MAX_IMAGE_SIZE: 5 * 1024 * 1024,
      POLLING_INTERVAL: 2000
    };

    const state = {
      hasPhoto: false,
      isValidated: false,
      cameraStream: null,
      currentPhotoData: null,
      currentScore: 0,
      photoId: null,
      pollingInterval: null
    };

    const elements = {
      step: document.getElementById('step10'),
      preview: document.getElementById('profilePreview'),
      placeholder: document.getElementById('profilePlaceholder'),
      upload: document.getElementById('profileUpload'),
      verificationOverlay: document.getElementById('verificationOverlay'),
      verificationMessage: document.getElementById('verificationMessage'),
      mainButtons: document.getElementById('mainButtons'),
      takePictureBtn: document.getElementById('takePictureBtn'),
      cameraSection: document.getElementById('cameraSection'),
      videoStream: document.getElementById('videoStream'),
      captureBtn: document.getElementById('captureBtn'),
      cancelCameraBtn: document.getElementById('cancelCameraBtn'),
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
      if (elements.resultCard) {
        elements.resultCard.classList.add('hidden');
        elements.resultCard.innerHTML = '';
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

    function showChangePhotoButton() {
      hideAllStates();
      if (elements.changePhotoContainer) elements.changePhotoContainer.classList.remove('hidden');
    }

    function showVerificationOverlay(message) {
      if (elements.verificationOverlay) {
        elements.verificationOverlay.classList.remove('hidden');
      }
      if (elements.verificationMessage) {
        elements.verificationMessage.textContent = message || 'Verifying...';
      }
    }

    function hideVerificationOverlay() {
      if (elements.verificationOverlay) {
        elements.verificationOverlay.classList.add('hidden');
      }
    }

    function updateVerificationMessage(message) {
      if (elements.verificationMessage) {
        elements.verificationMessage.textContent = message;
      }
    }

    function displayScore(score, message) {
      safeCall(() => {
        if (elements.scoreBadge) elements.scoreBadge.classList.remove('hidden');
      });

      let badgeClass, cardClass, barClass, emoji, title, resultMessage;

      if (score >= 95) {
        badgeClass = 'bg-gradient-to-r from-green-600 to-emerald-600';
        cardClass = 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-400';
        barClass = 'bg-gradient-to-r from-green-600 to-emerald-600';
        emoji = '🏆';
        title = 'Outstanding selfie!';
        resultMessage = message || "This photo is perfect to inspire trust.";
      } else if (score >= 80) {
        badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
        cardClass = 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-400';
        barClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
        emoji = '✨';
        title = 'Great photo!';
        resultMessage = message || "Clear, professional and client-friendly.";
      } else if (score >= 60) {
        badgeClass = 'bg-gradient-to-r from-yellow-500 to-orange-500';
        cardClass = 'bg-gradient-to-r from-yellow-50 to-orange-50 border-yellow-400';
        barClass = 'bg-gradient-to-r from-yellow-500 to-orange-500';
        emoji = '👍';
        title = 'Photo validated';
        resultMessage = message || "It works. You can improve it later if you want.";
      } else {
        badgeClass = 'bg-gradient-to-r from-orange-600 to-red-500';
        cardClass = 'bg-gradient-to-r from-orange-50 to-red-50 border-orange-400';
        barClass = 'bg-gradient-to-r from-orange-600 to-red-500';
        emoji = '⚠️';
        title = 'Acceptable photo';
        resultMessage = message || "It is accepted, but you could upload a clearer one.";
      }

      safeCall(() => {
        if (elements.scoreBadge) {
          const badgeInner = elements.scoreBadge.querySelector('div');
          if (badgeInner) {
            badgeInner.className = `flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px] ${badgeClass}`;
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
                <p class="text-sm sm:text-base font-semibold leading-relaxed">${resultMessage}</p>
              </div>
            </div>
          `;
          elements.resultCard.classList.remove('hidden');
        }
      });

      state.currentScore = score;
      savePhotoToLocalStorage(state.currentPhotoData, score, true);
      showChangePhotoButton();
    }

    function displayRejection(reason, solutions) {
      safeCall(() => {
        if (elements.scoreBadge) elements.scoreBadge.classList.add('hidden');
        closeCamera();
        removePhotoFromLocalStorage();
        resetPhotoUI();

        if (elements.resultCard) {
          const solutionsList = solutions && solutions.length > 0 
            ? solutions.map(s => `<li class="text-xs sm:text-sm text-gray-700">• ${s}</li>`).join('')
            : '';

          elements.resultCard.innerHTML = `
            <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
              <div class="text-center space-y-2">
                <div class="text-4xl mb-1">😅</div>
                <p class="text-lg sm:text-xl font-black text-red-700">Oops... Your photo was not accepted.</p>
                <p class="text-sm sm:text-base font-semibold text-red-600 whitespace-pre-line">
                  ${reason || "Let's try again with a clearer selfie."}
                </p>
              </div>
              ${solutionsList ? `
                <div class="bg-white/80 rounded-xl p-3 sm:p-4 space-y-2">
                  <p class="text-xs sm:text-sm font-bold text-gray-800">How to fix it:</p>
                  <ul class="space-y-1">${solutionsList}</ul>
                </div>
              ` : ''}
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

    async function sendPhotoToBackend(imageData) {
      showVerificationOverlay('Uploading...');

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        const headers = {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        };

        if (IS_AUTHENTICATED && API_TOKEN) {
          headers['Authorization'] = `Bearer ${API_TOKEN}`;
        }

        const response = await fetch(`${API_BASE_URL}/photo`, {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin',
          body: JSON.stringify({
            image: imageData
          })
        });

        const data = await response.json();

        if (response.ok && data.success) {
          state.photoId = data.data?.id || null;
          updateVerificationMessage('Verifying photo...');
          startPhotoPolling();
        } else {
          throw new Error(data.message || 'Upload failed');
        }

      } catch (error) {
        console.error('Upload error:', error);
        hideVerificationOverlay();
        alert('Upload failed. Please try again.');
        showMainButtons();
      }
    }

    function startPhotoPolling() {
      if (state.pollingInterval) {
        clearInterval(state.pollingInterval);
      }

      state.pollingInterval = setInterval(async () => {
        try {
          const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
          
          const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          };

          if (IS_AUTHENTICATED && API_TOKEN) {
            headers['Authorization'] = `Bearer ${API_TOKEN}`;
          }

          const response = await fetch(`${API_BASE_URL}/photo/status`, {
            method: 'GET',
            headers: headers,
            credentials: 'same-origin'
          });

          const data = await response.json();

          if (data.success) {
            handlePhotoStatus(data);
          }

        } catch (error) {
          console.error('Polling error:', error);
        }
      }, CONFIG.POLLING_INTERVAL);
    }

    function stopPhotoPolling() {
      if (state.pollingInterval) {
        clearInterval(state.pollingInterval);
        state.pollingInterval = null;
      }
    }

    function handlePhotoStatus(data) {
      const { status, message, confidence_score, rejection_reason, suggestions } = data;

      switch (status) {
        case 'verified':
          stopPhotoPolling();
          hideVerificationOverlay();
          displayScore(confidence_score || 75, message);
          break;

        case 'rejected':
          stopPhotoPolling();
          hideVerificationOverlay();
          displayRejection(rejection_reason, suggestions);
          break;

        case 'error':
          stopPhotoPolling();
          hideVerificationOverlay();
          alert(message || 'Verification error. Please try again.');
          showMainButtons();
          break;

        case 'processing':
          updateVerificationMessage('🔄 Analyzing your photo...');
          break;

        case 'pending':
        default:
          updateVerificationMessage('⏳ Queued for verification...');
          break;
      }
    }

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
      
      sendPhotoToBackend(imageData);
    }

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
          sendPhotoToBackend(result);
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

    function restorePhoto() {
      try {
        const data = getLocalStorage();
        const saved = data.profilePhoto;

        if (saved && saved.image) {
          const imageData = saved.image;
          const score = saved.score || 75;
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
                  badgeInner.className = `flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px] ${badgeClass}`;
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

    window.validateStep10 = function(showAlert) {
      const ok = state.hasPhoto && state.isValidated;
      if (!ok && showAlert) {
        alert('To continue, please validate a clear selfie of yourself.');
      }
      return ok;
    };

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

    function cleanup() {
      closeCamera();
      stopPhotoPolling();
      hideVerificationOverlay();
    }

    if (elements.step) {
      const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            const isHidden = elements.step.classList.contains('hidden');
            if (!isHidden) {
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

    if (elements.step && !elements.step.classList.contains('hidden')) {
      restorePhoto();
    }
  })();
</script>