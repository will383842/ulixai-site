<div id="step10" class="hidden flex flex-col h-full" role="region" aria-label="Add your profile picture">
  
  <!-- FIXED HEADER -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-xl sm:text-2xl">📸</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Take Your Selfie! 🤳
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Show your authentic self to future clients
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          Recommended for better trust & visibility
        </span>
      </div>
    </div>
  </div>

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto pt-4 space-y-4 px-4">

    <div class="text-center mb-4">
      <p class="text-gray-600 text-base sm:text-lg font-semibold">
        Show your real face to build trust with clients.
      </p>
    </div>

    <!-- ========================================
         UN SEUL CERCLE POUR TOUT
         ======================================== -->
    <div class="flex flex-col items-center mb-8">
      <div class="relative mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          
          <!-- CERCLE UNIQUE - Tous les états se superposent ici -->
          <div class="relative w-40 h-40 sm:w-48 sm:h-48">
            
            <!-- 1. Placeholder initial (état par défaut) -->
            <div id="photoCircle" class="absolute inset-0 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 shadow-2xl transition-all duration-300">
              <div id="profilePlaceholder" class="text-center">
                <div class="text-5xl sm:text-6xl mb-2 animate-float">👤</div>
                <p class="text-blue-400 font-bold text-xs sm:text-sm">No photo yet</p>
              </div>
            </div>

            <!-- 2. Image de prévisualisation (masquée par défaut) -->
            <img id="profilePreview" src="" alt="Profile Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-full">

            <!-- 3. Flux vidéo caméra (masqué par défaut) -->
            <video id="videoStream" autoplay playsinline class="hidden absolute inset-0 w-full h-full rounded-full object-cover transform scale-x-[-1]"></video>

            <!-- 4. Overlay de vérification (masqué par défaut) -->
            <div id="verificationOverlay" class="hidden absolute inset-0 bg-white bg-opacity-95 flex flex-col items-center justify-center rounded-full z-10">
              <div class="spinner mb-3"></div>
              <p id="verificationMessage" class="text-gray-700 font-semibold text-sm text-center px-4">Verifying...</p>
              <!-- Bouton de secours après timeout -->
              <button type="button" id="fallbackBtn" class="hidden mt-3 px-4 py-2 bg-gray-600 text-white text-xs rounded-lg font-semibold hover:bg-gray-700 transition">
                Skip verification
              </button>
            </div>

            <!-- Bordure du cercle - Change selon l'état -->
            <div id="circleBorder" class="absolute inset-0 rounded-full border-4 border-blue-400 pointer-events-none transition-all duration-300"></div>
          </div>

          <!-- Score Badge -->
          <div id="scoreBadge" class="hidden score-badge">
            <div class="flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px]">
              <span id="scoreText" class="text-xl sm:text-2xl font-black whitespace-nowrap"></span>
              <span class="text-[10px] sm:text-xs font-bold opacity-75">Score</span>
            </div>
          </div>
        </div>


      </div>

      <!-- BOUTONS D'ACTION -->
      <div id="actionButtons" class="flex flex-col sm:flex-row gap-3 mb-4 w-full sm:w-auto">
        <!-- Choisir une photo -->
        <label for="profileUpload" id="uploadLabel" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-5 sm:px-8 py-3.5 rounded-2xl cursor-pointer font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span>Choose photo</span>
        </label>
        
        <!-- Prendre une photo -->
        <button type="button" id="takePictureBtn" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-5 sm:px-8 py-3.5 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <span>Take a selfie</span>
        </button>
      </div>
      
      <!-- Bouton SKIP - Visible uniquement pendant la vérification -->
      <div id="skipVerificationContainer" class="hidden w-full sm:w-auto mb-4">
        <button type="button" id="skipVerificationBtn" class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-6 sm:px-8 py-3.5 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 hover:shadow-xl transform hover:scale-105 transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
          <span>Skip verification & continue</span>
        </button>
        <p class="text-xs text-center text-gray-500 mt-2">You can verify your photo later in your profile settings</p>
      </div>

      <!-- Boutons caméra (masqués par défaut) -->
      <div id="cameraButtons" class="hidden flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto mb-4">
        <button type="button" id="captureBtn" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all w-full sm:w-auto">
          📸 Capture
        </button>
        <button type="button" id="cancelCameraBtn" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all w-full sm:w-auto">
          ✕ Cancel
        </button>
      </div>

      <!-- Bouton changer photo (masqué par défaut) -->
      <div id="changePhotoContainer" class="hidden w-full sm:w-auto mb-4">
        <button type="button" id="changePhotoBtn" class="upload-btn bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full sm:w-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          <span>Change photo</span>
        </button>
      </div>

      <input type="file" id="profileUpload" name="profile_picture" accept="image/*" class="hidden">

      <!-- Carte de résultat -->
      <div id="resultCard" class="w-full max-w-md mb-4 hidden"></div>
    </div>

    <!-- RÈGLES PHOTO -->
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

.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

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

.score-badge {
  animation: scaleIn 0.3s ease-out;
}

@keyframes scaleIn {
  from { opacity: 0; transform: scale(0.8); }
  to { opacity: 1; transform: scale(1); }
}

/* États du cercle */
.circle-camera {
  border-color: #10b981 !important;
  animation: pulse-green 2s infinite;
}

.circle-verifying {
  border-color: #3b82f6 !important;
  animation: pulse-blue 2s infinite;
}

.circle-success {
  border-color: #10b981 !important;
}

.circle-error {
  border-color: #ef4444 !important;
}

@keyframes pulse-green {
  0%, 100% { border-color: rgba(16, 185, 129, 0.5); }
  50% { border-color: rgba(16, 185, 129, 1); }
}

@keyframes pulse-blue {
  0%, 100% { border-color: rgba(59, 130, 246, 0.5); }
  50% { border-color: rgba(59, 130, 246, 1); }
}

/* Responsive adjustments */
@media (max-width: 639px) {
  #step10 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step10 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step10 p {
    font-size: 0.8125rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  #step10 .upload-btn {
    border: 3px solid currentColor;
  }
}
</style>

<!-- JAVASCRIPT OPTIMISÉ -->
<script>
  (function() {
    'use strict';

    // Configuration
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
      POLLING_INTERVAL: 2000,
      VERIFICATION_TIMEOUT: 30000, // 30 secondes timeout
      MAX_RETRIES: 3
    };

    const state = {
      hasPhoto: false,
      isValidated: false,
      cameraStream: null,
      currentPhotoData: null,
      currentScore: 0,
      photoId: null,
      pollingInterval: null,
      verificationTimeout: null,
      retryCount: 0,
      currentMode: 'idle' // idle, camera, verifying, validated
    };

    const elements = {
      step: document.getElementById('step10'),
      photoCircle: document.getElementById('photoCircle'),
      circleBorder: document.getElementById('circleBorder'),
      preview: document.getElementById('profilePreview'),
      placeholder: document.getElementById('profilePlaceholder'),
      videoStream: document.getElementById('videoStream'),
      upload: document.getElementById('profileUpload'),
      verificationOverlay: document.getElementById('verificationOverlay'),
      verificationMessage: document.getElementById('verificationMessage'),
      fallbackBtn: document.getElementById('fallbackBtn'),
      actionButtons: document.getElementById('actionButtons'),
      uploadLabel: document.getElementById('uploadLabel'),
      takePictureBtn: document.getElementById('takePictureBtn'),
      skipVerificationContainer: document.getElementById('skipVerificationContainer'),
      skipVerificationBtn: document.getElementById('skipVerificationBtn'),
      cameraButtons: document.getElementById('cameraButtons'),
      captureBtn: document.getElementById('captureBtn'),
      cancelCameraBtn: document.getElementById('cancelCameraBtn'),
      changePhotoContainer: document.getElementById('changePhotoContainer'),
      changePhotoBtn: document.getElementById('changePhotoBtn'),
      scoreBadge: document.getElementById('scoreBadge'),
      scoreText: document.getElementById('scoreText'),
      resultCard: document.getElementById('resultCard'),
      nextStepBtn: document.getElementById('nextStep10')
    };

    // =======================================
    // GESTION DES ÉTATS DU CERCLE UNIQUE
    // =======================================
    
    function setCircleState(mode) {
      state.currentMode = mode;
      
      // Reset tous les états
      elements.placeholder?.classList.add('hidden');
      elements.preview?.classList.add('hidden');
      elements.videoStream?.classList.add('hidden');
      elements.verificationOverlay?.classList.add('hidden');
      
      // Reset classes bordure
      elements.circleBorder?.classList.remove('circle-camera', 'circle-verifying', 'circle-success', 'circle-error');
      
      switch(mode) {
        case 'idle':
          elements.placeholder?.classList.remove('hidden');
          break;
          
        case 'camera':
          elements.videoStream?.classList.remove('hidden');
          elements.circleBorder?.classList.add('circle-camera');
          break;
          
        case 'preview':
          elements.preview?.classList.remove('hidden');
          break;
          
        case 'verifying':
          if (elements.preview?.src) {
            elements.preview?.classList.remove('hidden');
          }
          elements.verificationOverlay?.classList.remove('hidden');
          elements.circleBorder?.classList.add('circle-verifying');
          break;
          
        case 'validated':
          elements.preview?.classList.remove('hidden');
          elements.circleBorder?.classList.add('circle-success');
          break;
          
        case 'error':
          elements.circleBorder?.classList.add('circle-error');
          break;
      }
    }

    function showButtons(type) {
      elements.actionButtons?.classList.add('hidden');
      elements.cameraButtons?.classList.add('hidden');
      elements.changePhotoContainer?.classList.add('hidden');
      elements.skipVerificationContainer?.classList.add('hidden');
      
      switch(type) {
        case 'main':
          elements.actionButtons?.classList.remove('hidden');
          break;
        case 'camera':
          elements.cameraButtons?.classList.remove('hidden');
          break;
        case 'change':
          elements.changePhotoContainer?.classList.remove('hidden');
          break;
        case 'skip':
          // Afficher le bouton Skip pendant la vérification
          elements.skipVerificationContainer?.classList.remove('hidden');
          break;
        case 'none':
          // Ne rien afficher
          break;
      }
    }

    // =======================================
    // SYSTÈME DE FALLBACK
    // =======================================
    
    function startVerificationTimeout() {
      clearVerificationTimeout();
      
      state.verificationTimeout = setTimeout(() => {
        console.warn('⏱️ Verification timeout - activating fallback');
        
        if (elements.verificationMessage) {
          elements.verificationMessage.innerHTML = `
            <span class="text-orange-600">⚠️ Verification is taking longer than expected</span>
          `;
        }
        
        if (elements.fallbackBtn) {
          elements.fallbackBtn.classList.remove('hidden');
        }
      }, CONFIG.VERIFICATION_TIMEOUT);
    }

    function clearVerificationTimeout() {
      if (state.verificationTimeout) {
        clearTimeout(state.verificationTimeout);
        state.verificationTimeout = null;
      }
    }

    function activateFallbackMode() {
      stopPhotoPolling();
      clearVerificationTimeout();
      
      // Accepter la photo sans vérification complète
      const fallbackScore = 70; // Score par défaut en mode fallback
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-3 border-yellow-400 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">⚡</div>
              <p class="text-lg sm:text-xl font-black text-yellow-700">Photo accepted (verification skipped)</p>
              <p class="text-sm sm:text-base font-semibold text-yellow-600">
                Your photo has been accepted. Manual verification may occur later.
              </p>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }
      
      savePhotoToLocalStorage(state.currentPhotoData, fallbackScore, true);
      setCircleState('validated');
      showButtons('change');
    }

    function skipVerificationAndContinue() {
      console.log('⏩ User skipped verification');
      stopPhotoPolling();
      clearVerificationTimeout();
      
      // Accepter la photo immédiatement sans attendre la vérification
      const skipScore = 50; // Score minimal pour photo non-vérifiée
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-3 border-blue-400 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">✅</div>
              <p class="text-lg sm:text-xl font-black text-blue-700">Photo saved!</p>
              <p class="text-sm sm:text-base font-semibold text-blue-600">
                Your photo has been saved. You can continue with your registration.
              </p>
              <p class="text-xs text-gray-500 mt-2">
                💡 Tip: Verified photos get better visibility and trust from clients
              </p>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }
      
      // Sauvegarder avec validated=true pour permettre de continuer
      savePhotoToLocalStorage(state.currentPhotoData, skipScore, true);
      setCircleState('preview');
      showButtons('change');
    }

    // =======================================
    // GESTION API AVEC RETRY
    // =======================================
    
    async function sendPhotoToBackend(imageData) {
      setCircleState('verifying');
      updateVerificationMessage('📤 Uploading...');
      showButtons('skip'); // Afficher le bouton Skip dès le début
      
      startVerificationTimeout();

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
          body: JSON.stringify({ image: imageData })
        });

        const data = await response.json();

        if (response.ok && data.success) {
          state.photoId = data.data?.id || null;
          state.retryCount = 0;
          updateVerificationMessage('🔍 Verifying photo...');
          startPhotoPolling();
        } else {
          throw new Error(data.message || 'Upload failed');
        }

      } catch (error) {
        console.error('❌ Upload error:', error);
        clearVerificationTimeout();
        
        // Déterminer le type d'erreur pour un message approprié
        let errorType = 'network';
        let errorMessage = error.message;
        
        if (error.message.includes('fetch') || error.message.includes('Failed to fetch')) {
          errorType = 'network';
          errorMessage = 'Cannot reach the server. Please check your internet connection.';
        } else if (error.message.includes('timeout')) {
          errorType = 'timeout';
          errorMessage = 'The upload request timed out. Please try again.';
        } else if (error.message.includes('413') || error.message.includes('too large')) {
          errorType = 'upload';
          errorMessage = 'The image file is too large. Please use a smaller image (max 5MB).';
        } else if (error.message.includes('401') || error.message.includes('403')) {
          errorType = 'api';
          errorMessage = 'Authentication error. Please refresh the page and try again.';
        } else if (error.message.includes('500') || error.message.includes('502') || error.message.includes('503')) {
          errorType = 'api';
          errorMessage = 'Server error. Our verification service is temporarily unavailable.';
        }
        
        // Retry logique
        if (state.retryCount < CONFIG.MAX_RETRIES) {
          state.retryCount++;
          updateVerificationMessage(`⚠️ Retry ${state.retryCount}/${CONFIG.MAX_RETRIES}...`);
          
          setTimeout(() => {
            sendPhotoToBackend(imageData);
          }, 2000);
          return;
        }
        
        // Échec après tous les retries
        setCircleState('error');
        displayError(errorMessage, errorType);
      }
    }

    function resetAndRetry() {
      state.retryCount = 0;
      closeCamera();
      removePhotoFromLocalStorage();
      resetPhotoUI();
      setCircleState('idle');
      showButtons('main');
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
          clearVerificationTimeout();
          displayScore(confidence_score || 75, message);
          break;

        case 'rejected':
          stopPhotoPolling();
          clearVerificationTimeout();
          displayRejection(rejection_reason, suggestions);
          break;

        case 'error':
          stopPhotoPolling();
          clearVerificationTimeout();
          displayError(message || 'Verification error occurred during processing', 'api');
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

    function updateVerificationMessage(message) {
      if (elements.verificationMessage) {
        elements.verificationMessage.textContent = message;
      }
    }

    // =======================================
    // AFFICHAGE DES RÉSULTATS
    // =======================================
    
    function displayScore(score, message) {
      setCircleState('validated');
      clearVerificationTimeout();
      
      if (elements.scoreBadge) elements.scoreBadge.classList.remove('hidden');

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

      state.currentScore = score;
      savePhotoToLocalStorage(state.currentPhotoData, score, true);
      showButtons('change');
    }

    function displayRejection(reason, suggestions) {
      setCircleState('error');
      closeCamera();
      removePhotoFromLocalStorage();
      resetPhotoUI();

      if (elements.scoreBadge) elements.scoreBadge.classList.add('hidden');

      // Construire un message détaillé et explicite
      let mainReason = reason || "Your photo could not be validated.";
      
      // Si le backend a fourni des suggestions précises
      const solutionsList = suggestions && suggestions.length > 0 
        ? suggestions.map(s => `<li class="text-xs sm:text-sm text-gray-700 font-medium">✓ ${s}</li>`).join('')
        : `
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Make sure your face is fully visible</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Use good lighting (natural light is best)</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Remove sunglasses, masks, or face coverings</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Look directly at the camera</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Be alone in the photo (no other people)</li>
        `;

      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-4 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">❌</div>
              <p class="text-lg sm:text-xl font-black text-red-700">Photo Rejected</p>
            </div>
            
            <!-- Raison détaillée de refus -->
            <div class="bg-red-100 border-2 border-red-300 rounded-xl p-3 sm:p-4">
              <p class="text-xs sm:text-sm font-bold text-red-900 mb-1">Why was it rejected?</p>
              <p class="text-sm sm:text-base font-semibold text-red-700 whitespace-pre-line leading-relaxed">
                ${mainReason}
              </p>
            </div>
            
            <!-- Solutions concrètes -->
            <div class="bg-white/80 border-2 border-orange-300 rounded-xl p-3 sm:p-4 space-y-2">
              <p class="text-xs sm:text-sm font-bold text-gray-900 flex items-center gap-2">
                <span class="text-lg">💡</span> How to fix it:
              </p>
              <ul class="space-y-2">${solutionsList}</ul>
            </div>
            
            <p class="text-xs sm:text-sm font-bold text-center text-red-700 bg-red-100 py-2 px-3 rounded-lg">
              📸 Please take a new selfie following these guidelines
            </p>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }

      setCircleState('idle');
      showButtons('main');
    }

    function displayError(message, errorType = 'unknown') {
      setCircleState('error');
      
      // Messages détaillés selon le type d'erreur
      let errorTitle = 'Verification Error';
      let errorIcon = '⚠️';
      let errorDetails = message || 'An unknown error occurred.';
      let troubleshooting = [];
      
      // Catégoriser les erreurs pour donner des instructions précises
      if (errorType === 'timeout') {
        errorTitle = 'Verification Timeout';
        errorIcon = '⏱️';
        errorDetails = 'The verification process took too long (over 30 seconds).';
        troubleshooting = [
          'Check your internet connection',
          'Try again with a smaller image',
          'Use the "Skip verification" option if problem persists'
        ];
      } else if (errorType === 'network') {
        errorTitle = 'Connection Error';
        errorIcon = '📡';
        errorDetails = 'Could not connect to the verification server.';
        troubleshooting = [
          'Check your internet connection',
          'Make sure you\'re not using a VPN that blocks requests',
          'Try refreshing the page',
          'Wait a moment and try again'
        ];
      } else if (errorType === 'upload') {
        errorTitle = 'Upload Failed';
        errorIcon = '📤';
        errorDetails = message || 'The photo could not be uploaded to the server.';
        troubleshooting = [
          'Check your internet connection',
          'Make sure the image is under 5MB',
          'Try a different photo format (JPG/PNG)',
          'Try again in a few seconds'
        ];
      } else if (errorType === 'api') {
        errorTitle = 'Server Error';
        errorIcon = '🔧';
        errorDetails = message || 'The verification service encountered an error.';
        troubleshooting = [
          'This is likely a temporary issue',
          'Try again in a few minutes',
          'Use the "Accept anyway" option below',
          'Contact support if problem persists'
        ];
      }
      
      const troubleshootingList = troubleshooting.length > 0
        ? troubleshooting.map(tip => `<li class="text-xs sm:text-sm text-gray-700 font-medium">→ ${tip}</li>`).join('')
        : '';
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-4 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">${errorIcon}</div>
              <p class="text-lg sm:text-xl font-black text-red-700">${errorTitle}</p>
            </div>
            
            <!-- Détails de l'erreur -->
            <div class="bg-red-100 border-2 border-red-300 rounded-xl p-3 sm:p-4">
              <p class="text-xs sm:text-sm font-bold text-red-900 mb-1">What happened?</p>
              <p class="text-sm sm:text-base font-semibold text-red-700 leading-relaxed">
                ${errorDetails}
              </p>
            </div>
            
            ${troubleshootingList ? `
              <div class="bg-blue-50 border-2 border-blue-300 rounded-xl p-3 sm:p-4 space-y-2">
                <p class="text-xs sm:text-sm font-bold text-blue-900 flex items-center gap-2">
                  <span class="text-lg">💡</span> Troubleshooting:
                </p>
                <ul class="space-y-1.5">${troubleshootingList}</ul>
              </div>
            ` : ''}
            
            <!-- Action buttons -->
            <div class="space-y-2">
              <button type="button" id="retryErrorBtn" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition">
                🔄 Try again
              </button>
              <button type="button" id="acceptAnywayErrorBtn" class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition">
                ✓ Accept photo anyway
              </button>
            </div>
            
            <p class="text-[10px] sm:text-xs text-center text-gray-500">
              Error details: ${errorType.toUpperCase()} - ${new Date().toLocaleTimeString()}
            </p>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
        
        // Event listeners pour les boutons d'erreur
        document.getElementById('retryErrorBtn')?.addEventListener('click', resetAndRetry);
        document.getElementById('acceptAnywayErrorBtn')?.addEventListener('click', activateFallbackMode);
      }
    }

    // =======================================
    // GESTION CAMÉRA
    // =======================================
    
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
        
        setCircleState('camera');
        showButtons('camera');
        
      } catch (e) {
        console.error('Camera error:', e);
        alert("We could not access your camera. Please upload a photo from your device instead.");
        setCircleState('idle');
        showButtons('main');
      }
    }

    function closeCamera() {
      console.log('🔴 Closing camera...');
      
      // Arrêter TOUS les tracks du stream principal
      if (state.cameraStream) {
        const tracks = state.cameraStream.getTracks();
        console.log(`🔴 Stopping ${tracks.length} tracks from main stream`);
        tracks.forEach(track => {
          console.log(`  → Track ${track.kind}: ${track.label}`);
          track.stop();
          track.enabled = false;
        });
        state.cameraStream = null;
      }
      
      // Nettoyer COMPLÈTEMENT le video element
      if (elements.videoStream) {
        // Arrêter les tracks du srcObject si présents
        if (elements.videoStream.srcObject) {
          const videoTracks = elements.videoStream.srcObject.getTracks();
          console.log(`🔴 Stopping ${videoTracks.length} tracks from video element`);
          videoTracks.forEach(track => {
            console.log(`  → Track ${track.kind}: ${track.label}`);
            track.stop();
            track.enabled = false;
          });
        }
        
        // Détacher complètement le srcObject
        elements.videoStream.srcObject = null;
        elements.videoStream.pause();
        elements.videoStream.load(); // Force reload pour libérer les ressources
        
        // Supprimer les attributs src aussi
        elements.videoStream.removeAttribute('src');
      }
      
      console.log('✅ Camera fully closed and released');
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
      }

      state.currentPhotoData = imageData;
      closeCamera();
      
      sendPhotoToBackend(imageData);
    }

    // =======================================
    // GESTION UPLOAD FICHIER
    // =======================================
    
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

    // =======================================
    // LOCAL STORAGE
    // =======================================
    
    function getLocalStorage() {
      try {
        const data = localStorage.getItem(CONFIG.STORAGE_KEY);
        return data ? JSON.parse(data) : {};
      } catch (e) {
        console.error('Storage error:', e);
        return {};
      }
    }

    function savePhotoToLocalStorage(imageData, score, validated) {
      try {
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
      } catch (e) {
        console.error('Save error:', e);
        return false;
      }
    }

    function removePhotoFromLocalStorage() {
      try {
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
      } catch (e) {
        console.error('Remove error:', e);
        return false;
      }
    }

    function resetPhotoUI() {
      if (elements.preview) {
        elements.preview.src = '';
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
            }

            state.hasPhoto = true;
            state.isValidated = validated;
            state.currentPhotoData = imageData;
            state.currentScore = score;

            if (validated) {
              setCircleState('validated');
              
              if (elements.scoreBadge) {
                elements.scoreBadge.classList.remove('hidden');

                let badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600';
                let emoji = '✨';
                
                if (score >= 95) { 
                  badgeClass = 'bg-gradient-to-r from-green-600 to-emerald-600'; 
                  emoji = '🏆'; 
                } else if (score >= 80) { 
                  badgeClass = 'bg-gradient-to-r from-blue-600 to-cyan-600'; 
                  emoji = '✨'; 
                } else if (score >= 60) { 
                  badgeClass = 'bg-gradient-to-r from-yellow-500 to-orange-500'; 
                  emoji = '👍'; 
                } else { 
                  badgeClass = 'bg-gradient-to-r from-orange-600 to-red-500'; 
                  emoji = '⚠️'; 
                }

                const badgeInner = elements.scoreBadge.querySelector('div');
                if (badgeInner) {
                  badgeInner.className = `flex flex-col items-center justify-center gap-2 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow-2xl ring-4 ring-white min-w-[80px] ${badgeClass}`;
                }
                if (elements.scoreText) {
                  elements.scoreText.textContent = `${emoji} ${score}`;
                }
              }
              
              showButtons('change');
            } else {
              setCircleState('preview');
              showButtons('main');
            }

            if (typeof window.updateNavigationButtons === 'function') {
              window.updateNavigationButtons();
            }
          };
          
          img.onerror = function() {
            state.hasPhoto = false;
            state.isValidated = false;
            resetPhotoUI();
            setCircleState('idle');
            showButtons('main');
          };
          
          img.src = imageData;
        } else {
          setCircleState('idle');
          showButtons('main');
        }
      } catch (e) {
        console.error('Restore error:', e);
        setCircleState('idle');
        showButtons('main');
      }
    }

    // =======================================
    // VALIDATION & CLEANUP
    // =======================================
    
    window.validateStep10 = function(showAlert) {
      // ✅ STEP NON-BLOQUANT : On vérifie juste qu'une photo est présente
      // La validation Google Vision n'est PAS obligatoire pour continuer
      const ok = state.hasPhoto;
      
      if (!ok && showAlert) {
        alert('To continue, please upload or take a selfie. Verification is optional and can be completed later.');
      }
      
      return ok;
    };

    function cleanup() {
      closeCamera();
      stopPhotoPolling();
      clearVerificationTimeout();
      setCircleState('idle');
    }

    // =======================================
    // EVENT LISTENERS
    // =======================================
    
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
        setCircleState('idle');
        showButtons('main');
      });
    }

    if (elements.changePhotoBtn) {
      elements.changePhotoBtn.addEventListener('click', () => {
        closeCamera();
        removePhotoFromLocalStorage();
        resetPhotoUI();
        setCircleState('idle');
        showButtons('main');
      });
    }

    if (elements.fallbackBtn) {
      elements.fallbackBtn.addEventListener('click', activateFallbackMode);
    }

    if (elements.skipVerificationBtn) {
      elements.skipVerificationBtn.addEventListener('click', skipVerificationAndContinue);
    }

    if (elements.nextStepBtn) {
      elements.nextStepBtn.addEventListener('click', e => {
        if (!window.validateStep10(true)) {
          e.preventDefault();
          e.stopPropagation();
        }
      });
    }

    // Observer pour détecter quand le step devient visible
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

    // Init au chargement si step visible
    if (elements.step && !elements.step.classList.contains('hidden')) {
      restorePhoto();
    }
  })();
</script>