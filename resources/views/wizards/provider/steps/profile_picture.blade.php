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
          Take your selfie! 🤳
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Your photo will be visible on your profile
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          Recommended for better trust and visibility
        </span>
      </div>
    </div>
  </div>

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto pt-4 space-y-4 px-4 pb-6">

    <!-- ========================================
         SINGLE CIRCLE FOR EVERYTHING
         ======================================== -->
    <div class="flex flex-col items-center mb-8">
      <div class="relative mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6">
          
          <!-- SINGLE CIRCLE - All states overlap here -->
          <div class="relative w-40 h-40 sm:w-48 sm:h-48">
            
            <!-- 1. Initial placeholder (default state) -->
            <div id="photoCircle" class="absolute inset-0 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 shadow-2xl transition-all duration-300">
              <div id="profilePlaceholder" class="text-center">
                <div class="text-5xl sm:text-6xl mb-2 animate-float">👤</div>
                <p class="text-blue-400 font-bold text-xs sm:text-sm">No photo</p>
              </div>
            </div>

            <!-- 2. Preview image (hidden by default) -->
            <img id="profilePreview" src="" alt="Profile Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-full">

            <!-- 3. Camera video stream (hidden by default) -->
            <video id="videoStream" autoplay playsinline class="hidden absolute inset-0 w-full h-full rounded-full object-cover transform scale-x-[-1]"></video>

            <!-- 4. Verification overlay (hidden by default) -->
            <div id="verificationOverlay" class="hidden absolute inset-0 bg-white bg-opacity-95 flex flex-col items-center justify-center rounded-full z-10">
              <div class="spinner mb-3"></div>
              <p id="verificationMessage" class="text-gray-700 font-semibold text-sm text-center px-4">Verifying...</p>
              <!-- Fallback button after timeout -->
              <button type="button" id="fallbackBtn" class="hidden mt-3 px-4 py-2 bg-gray-600 text-white text-xs rounded-lg font-semibold hover:bg-gray-700 transition">
                Skip verification
              </button>
            </div>

            <!-- Circle border - Changes according to state -->
            <div id="circleBorder" class="absolute inset-0 rounded-full border-4 border-blue-400 pointer-events-none transition-all duration-300"></div>
          </div>

          <!-- SCORE BADGE DESKTOP (hidden on mobile) -->
          <div id="scoreBadgeDesktop" class="score-badge-container-desktop">
            <div class="score-badge-inner-desktop">
              <!-- Main Score Display -->
              <div class="score-main-desktop">
                <div id="scoreIconDesktop" class="score-icon-desktop">🏆</div>
                <div id="scoreNumberDesktop" class="score-number-desktop">95</div>
                <div class="score-label-desktop">/ 100</div>
              </div>
              
              <!-- Score Bar -->
              <div class="score-bar-container-desktop">
                <div id="scoreBarDesktop" class="score-bar-desktop" style="width: 95%"></div>
              </div>
              
              <!-- Score Description -->
              <div id="scoreDescriptionDesktop" class="score-description-desktop">
                Exceptional!
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SCORE BADGE MOBILE (hidden on desktop) - Horizontal layout -->
      <div id="scoreBadgeMobile" class="score-badge-container-mobile w-full max-w-lg mb-4">
        <div class="score-badge-inner-mobile">
          <!-- Left: Icon and Number -->
          <div class="score-left-mobile">
            <div id="scoreIconMobile" class="score-icon-mobile">🏆</div>
            <div class="score-number-wrapper-mobile">
              <div id="scoreNumberMobile" class="score-number-mobile">95</div>
              <div class="score-label-mobile">/ 100</div>
            </div>
          </div>
          
          <!-- Right: Bar and Description -->
          <div class="score-right-mobile">
            <div id="scoreDescriptionMobile" class="score-description-mobile">Exceptional!</div>
            <div class="score-bar-container-mobile">
              <div id="scoreBarMobile" class="score-bar-mobile" style="width: 95%"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Change photo button (below badge on mobile, next to badge on desktop) -->
      <div id="changePhotoContainer" class="hidden w-full max-w-lg mb-4">
        <button type="button" id="changePhotoBtn" class="upload-btn bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 w-full hover:shadow-xl transform hover:scale-105 transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          <span>Change photo</span>
        </button>
      </div>

      <!-- ACTION BUTTONS - SAME LINE (MOBILE INCLUDED) -->
      <div id="actionButtons" class="flex flex-row gap-2 sm:gap-3 mb-4 w-full max-w-lg">
        <!-- Photo library -->
        <label for="profileUpload" id="uploadLabel" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-2 sm:px-6 py-2.5 sm:py-3.5 rounded-xl sm:rounded-2xl cursor-pointer font-bold text-xs sm:text-base shadow-lg flex items-center justify-center space-x-1 sm:space-x-2 flex-1">
          <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span class="whitespace-nowrap">Gallery</span>
        </label>
        
        <!-- Selfie photo -->
        <button type="button" id="takePictureBtn" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-2 sm:px-6 py-2.5 sm:py-3.5 rounded-xl sm:rounded-2xl font-bold text-xs sm:text-base shadow-lg flex items-center justify-center space-x-1 sm:space-x-2 flex-1">
          <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <span class="whitespace-nowrap">Selfie</span>
        </button>
      </div>
      
      <!-- SKIP button - Visible only during verification -->
      <div id="skipVerificationContainer" class="hidden w-full sm:w-auto mb-4 max-w-lg">
        <button type="button" id="skipVerificationBtn" class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-6 sm:px-8 py-3.5 rounded-2xl font-bold text-sm sm:text-base shadow-lg flex items-center justify-center space-x-2 hover:shadow-xl transform hover:scale-105 transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
          <span>Skip verification and continue</span>
        </button>
        <p class="text-xs text-center text-gray-500 mt-2">You can verify your photo later in your profile settings</p>
      </div>

      <!-- Camera buttons (hidden by default) -->
      <div id="cameraButtons" class="hidden flex flex-row gap-2 sm:gap-3 w-full max-w-lg mb-4">
        <button type="button" id="captureBtn" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-3 sm:px-8 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl font-bold text-xs sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all flex-1">
          📸 Capture
        </button>
        <button type="button" id="cancelCameraBtn" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-3 sm:px-8 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl font-bold text-xs sm:text-base shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all flex-1">
          ✕ Cancel
        </button>
      </div>

      <input type="file" id="profileUpload" name="profile_picture" accept="image/*" class="hidden">

      <!-- Result card -->
      <div id="resultCard" class="w-full max-w-md mb-4 hidden"></div>
    </div>

    <!-- PHOTO RULES - REDUCED VERSION -->
    <div class="mb-6 rounded-2xl bg-gradient-to-br from-amber-50 to-yellow-50 border-2 border-amber-300 p-4 shadow-md text-sm">
      <div class="flex items-start gap-2.5">
        <div class="w-8 h-8 bg-amber-500 rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
          <span class="text-lg">✅</span>
        </div>
        <div>
          <h3 class="text-amber-900 font-black text-base mb-1.5">Photo rules (quick & simple)</h3>
          <ul class="text-amber-800 font-semibold space-y-1 text-xs sm:text-sm">
            <li>✓ Your face is clearly visible</li>
            <li>✓ Good lighting, no heavy filters</li>
            <li>✓ Professional / friendly appearance</li>
            <li>✓ You are alone in the photo</li>
            <li>✓ No sunglasses, masks, or hidden face</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- IMPROVED STYLES -->
<style>
/* ========================================
   SCORE BADGE - DESKTOP VERSION (VERTICAL)
   ======================================== */

.score-badge-container-desktop {
  animation: scoreAppear 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
  transform-origin: center;
}

/* Desktop badge: hidden on mobile, visible on desktop when .score-visible class is added */
#scoreBadgeDesktop {
  display: none;
}

#scoreBadgeDesktop.score-visible {
  display: none;
}

@media (min-width: 640px) {
  #scoreBadgeDesktop.score-visible {
    display: block;
  }
}

/* Mobile badge: visible on mobile, hidden on desktop when .score-visible class is added */
#scoreBadgeMobile {
  display: none;
}

#scoreBadgeMobile.score-visible {
  display: block;
}

@media (min-width: 640px) {
  #scoreBadgeMobile.score-visible {
    display: none;
  }
}

@keyframes scoreAppear {
  0% {
    opacity: 0;
    transform: scale(0.5) rotate(-10deg);
  }
  100% {
    opacity: 1;
    transform: scale(1) rotate(0deg);
  }
}

.score-badge-inner-desktop {
  position: relative;
  background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
  backdrop-filter: blur(20px);
  border-radius: 24px;
  padding: 16px 20px;
  box-shadow: 
    0 10px 40px rgba(0,0,0,0.15),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 20px 60px rgba(59, 130, 246, 0.2);
  min-width: 150px;
  border: 3px solid transparent;
  background-clip: padding-box;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.score-badge-inner-desktop:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 
    0 15px 50px rgba(0,0,0,0.2),
    0 0 0 1px rgba(255,255,255,0.6) inset,
    0 25px 80px rgba(59, 130, 246, 0.3);
}

/* Desktop badge color variants */
.score-badge-inner-desktop.score-exceptional {
  background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%);
  border-color: rgba(16, 185, 129, 0.5);
  box-shadow: 
    0 10px 40px rgba(16, 185, 129, 0.4),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 20px 60px rgba(16, 185, 129, 0.3);
}

.score-badge-inner-desktop.score-excellent {
  background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  border-color: rgba(59, 130, 246, 0.5);
  box-shadow: 
    0 10px 40px rgba(59, 130, 246, 0.4),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 20px 60px rgba(59, 130, 246, 0.3);
}

.score-badge-inner-desktop.score-good {
  background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
  border-color: rgba(245, 158, 11, 0.5);
  box-shadow: 
    0 10px 40px rgba(245, 158, 11, 0.4),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 20px 60px rgba(245, 158, 11, 0.3);
}

.score-badge-inner-desktop.score-acceptable {
  background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
  border-color: rgba(239, 68, 68, 0.5);
  box-shadow: 
    0 10px 40px rgba(239, 68, 68, 0.4),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 20px 60px rgba(239, 68, 68, 0.3);
}

.score-main-desktop {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  margin-bottom: 12px;
}

.score-icon-desktop {
  font-size: 40px;
  line-height: 1;
  animation: float 3s ease-in-out infinite;
  filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));
}

.score-number-desktop {
  font-size: 48px;
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.05em;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.score-badge-inner-desktop.score-exceptional .score-number-desktop {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-desktop.score-excellent .score-number-desktop {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-desktop.score-good .score-number-desktop {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-desktop.score-acceptable .score-number-desktop {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-label-desktop {
  font-size: 13px;
  font-weight: 700;
  color: rgba(0,0,0,0.5);
  letter-spacing: 0.05em;
  margin-top: -6px;
}

.score-bar-container-desktop {
  width: 100%;
  height: 7px;
  background: rgba(0,0,0,0.1);
  border-radius: 999px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1) inset;
  margin-bottom: 10px;
}

.score-bar-desktop {
  height: 100%;
  background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
  border-radius: 999px;
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 0 12px rgba(102, 126, 234, 0.6);
  position: relative;
  overflow: hidden;
}

.score-bar-desktop::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
  animation: shimmer 2s infinite;
}

@keyframes shimmer {
  0% { left: -100%; }
  100% { left: 100%; }
}

.score-badge-inner-desktop.score-exceptional .score-bar-desktop {
  background: linear-gradient(90deg, #10b981 0%, #059669 100%);
  box-shadow: 0 0 12px rgba(16, 185, 129, 0.6);
}

.score-badge-inner-desktop.score-excellent .score-bar-desktop {
  background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
  box-shadow: 0 0 12px rgba(59, 130, 246, 0.6);
}

.score-badge-inner-desktop.score-good .score-bar-desktop {
  background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
  box-shadow: 0 0 12px rgba(245, 158, 11, 0.6);
}

.score-badge-inner-desktop.score-acceptable .score-bar-desktop {
  background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
  box-shadow: 0 0 12px rgba(239, 68, 68, 0.6);
}

.score-description-desktop {
  font-size: 13px;
  font-weight: 800;
  text-align: center;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: rgba(0,0,0,0.7);
}

/* ========================================
   SCORE BADGE - MOBILE VERSION (HORIZONTAL)
   ======================================== */

.score-badge-inner-mobile {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
  backdrop-filter: blur(20px);
  border-radius: 16px;
  padding: 12px 16px;
  box-shadow: 
    0 6px 24px rgba(0,0,0,0.12),
    0 0 0 1px rgba(255,255,255,0.5) inset,
    0 10px 30px rgba(59, 130, 246, 0.15);
  border: 2px solid transparent;
  background-clip: padding-box;
}

/* Mobile badge color variants */
.score-badge-inner-mobile.score-exceptional {
  background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%);
  border-color: rgba(16, 185, 129, 0.5);
  box-shadow: 
    0 6px 24px rgba(16, 185, 129, 0.3),
    0 0 0 1px rgba(255,255,255,0.5) inset;
}

.score-badge-inner-mobile.score-excellent {
  background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  border-color: rgba(59, 130, 246, 0.5);
  box-shadow: 
    0 6px 24px rgba(59, 130, 246, 0.3),
    0 0 0 1px rgba(255,255,255,0.5) inset;
}

.score-badge-inner-mobile.score-good {
  background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
  border-color: rgba(245, 158, 11, 0.5);
  box-shadow: 
    0 6px 24px rgba(245, 158, 11, 0.3),
    0 0 0 1px rgba(255,255,255,0.5) inset;
}

.score-badge-inner-mobile.score-acceptable {
  background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
  border-color: rgba(239, 68, 68, 0.5);
  box-shadow: 
    0 6px 24px rgba(239, 68, 68, 0.3),
    0 0 0 1px rgba(255,255,255,0.5) inset;
}

.score-left-mobile {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
}

.score-icon-mobile {
  font-size: 36px;
  line-height: 1;
  animation: float 3s ease-in-out infinite;
  filter: drop-shadow(0 2px 6px rgba(0,0,0,0.12));
}

.score-number-wrapper-mobile {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 0;
}

.score-number-mobile {
  font-size: 36px;
  font-weight: 900;
  line-height: 0.9;
  letter-spacing: -0.05em;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.score-badge-inner-mobile.score-exceptional .score-number-mobile {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-mobile.score-excellent .score-number-mobile {
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-mobile.score-good .score-number-mobile {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-badge-inner-mobile.score-acceptable .score-number-mobile {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-label-mobile {
  font-size: 10px;
  font-weight: 700;
  color: rgba(0,0,0,0.5);
  letter-spacing: 0.05em;
  margin-top: -2px;
}

.score-right-mobile {
  display: flex;
  flex-direction: column;
  gap: 6px;
  flex: 1;
  min-width: 0;
}

.score-description-mobile {
  font-size: 11px;
  font-weight: 800;
  text-align: left;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: rgba(0,0,0,0.7);
  white-space: nowrap;
}

.score-bar-container-mobile {
  width: 100%;
  height: 6px;
  background: rgba(0,0,0,0.15);
  border-radius: 999px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.15) inset;
}

.score-bar-mobile {
  height: 100%;
  background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
  border-radius: 999px;
  transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
  position: relative;
  overflow: hidden;
}

.score-bar-mobile::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
  animation: shimmer 2s infinite;
}

.score-badge-inner-mobile.score-exceptional .score-bar-mobile {
  background: linear-gradient(90deg, #10b981 0%, #059669 100%);
  box-shadow: 0 0 8px rgba(16, 185, 129, 0.6);
}

.score-badge-inner-mobile.score-excellent .score-bar-mobile {
  background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
  box-shadow: 0 0 8px rgba(59, 130, 246, 0.6);
}

.score-badge-inner-mobile.score-good .score-bar-mobile {
  background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
  box-shadow: 0 0 8px rgba(245, 158, 11, 0.6);
}

.score-badge-inner-mobile.score-acceptable .score-bar-mobile {
  background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
  box-shadow: 0 0 8px rgba(239, 68, 68, 0.6);
}

/* ========================================
   EXISTING ANIMATIONS & STYLES
   ======================================== */

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

/* Circle states */
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

@media (min-width: 640px) {
  #actionButtons {
    flex-direction: row;
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

<!-- OPTIMIZED JAVASCRIPT -->
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
      VERIFICATION_TIMEOUT: 30000,
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
      currentMode: 'idle'
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
      // Desktop badge elements
      scoreBadgeDesktop: document.getElementById('scoreBadgeDesktop'),
      scoreNumberDesktop: document.getElementById('scoreNumberDesktop'),
      scoreBarDesktop: document.getElementById('scoreBarDesktop'),
      scoreIconDesktop: document.getElementById('scoreIconDesktop'),
      scoreDescriptionDesktop: document.getElementById('scoreDescriptionDesktop'),
      // Mobile badge elements
      scoreBadgeMobile: document.getElementById('scoreBadgeMobile'),
      scoreNumberMobile: document.getElementById('scoreNumberMobile'),
      scoreBarMobile: document.getElementById('scoreBarMobile'),
      scoreIconMobile: document.getElementById('scoreIconMobile'),
      scoreDescriptionMobile: document.getElementById('scoreDescriptionMobile'),
      resultCard: document.getElementById('resultCard')
    };

    // =======================================
    // SINGLE CIRCLE STATE MANAGEMENT
    // =======================================
    
    function setCircleState(mode) {
      state.currentMode = mode;
      
      elements.placeholder?.classList.add('hidden');
      elements.preview?.classList.add('hidden');
      elements.videoStream?.classList.add('hidden');
      elements.verificationOverlay?.classList.add('hidden');
      
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
          elements.skipVerificationContainer?.classList.remove('hidden');
          break;
      }
    }

    // =======================================
    // IMPROVED SCORE DISPLAY
    // =======================================
    
    function updateScoreBadge(score) {
      // Show badges using score-visible class (responsive behavior handled in CSS)
      if (elements.scoreBadgeDesktop) {
        elements.scoreBadgeDesktop.classList.add('score-visible');
      }
      if (elements.scoreBadgeMobile) {
        elements.scoreBadgeMobile.classList.add('score-visible');
      }
      
      // Update score numbers (both mobile and desktop)
      if (elements.scoreNumberDesktop) {
        elements.scoreNumberDesktop.textContent = score;
      }
      if (elements.scoreNumberMobile) {
        elements.scoreNumberMobile.textContent = score;
      }
      
      // Update progress bars with animation (both mobile and desktop)
      setTimeout(() => {
        if (elements.scoreBarDesktop) {
          elements.scoreBarDesktop.style.width = score + '%';
        }
        if (elements.scoreBarMobile) {
          elements.scoreBarMobile.style.width = score + '%';
        }
      }, 100);
      
      // Determine badge style based on score
      let badgeClass, icon, description;
      
      if (score >= 95) {
        badgeClass = 'score-exceptional';
        icon = '🏆';
        description = 'Exceptional!';
      } else if (score >= 80) {
        badgeClass = 'score-excellent';
        icon = '✨';
        description = 'Excellent';
      } else if (score >= 60) {
        badgeClass = 'score-good';
        icon = '👍';
        description = 'Good';
      } else {
        badgeClass = 'score-acceptable';
        icon = '⚠️';
        description = 'Acceptable';
      }
      
      // Update desktop badge styling
      const badgeInnerDesktop = elements.scoreBadgeDesktop?.querySelector('.score-badge-inner-desktop');
      if (badgeInnerDesktop) {
        badgeInnerDesktop.className = `score-badge-inner-desktop ${badgeClass}`;
      }
      
      // Update mobile badge styling
      const badgeInnerMobile = elements.scoreBadgeMobile?.querySelector('.score-badge-inner-mobile');
      if (badgeInnerMobile) {
        badgeInnerMobile.className = `score-badge-inner-mobile ${badgeClass}`;
      }
      
      // Update icons (both mobile and desktop)
      if (elements.scoreIconDesktop) {
        elements.scoreIconDesktop.textContent = icon;
      }
      if (elements.scoreIconMobile) {
        elements.scoreIconMobile.textContent = icon;
      }
      
      // Update descriptions (both mobile and desktop)
      if (elements.scoreDescriptionDesktop) {
        elements.scoreDescriptionDesktop.textContent = description;
      }
      if (elements.scoreDescriptionMobile) {
        elements.scoreDescriptionMobile.textContent = description;
      }
    }

    // =======================================
    // FALLBACK SYSTEM
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
      
      const fallbackScore = 70;
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-3 border-yellow-400 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">⚡</div>
              <p class="text-lg sm:text-xl font-black text-yellow-700">Photo accepted (verification skipped)</p>
              <p class="text-sm sm:text-base font-semibold text-yellow-600">
                Your photo has been accepted. A manual verification may take place later.
              </p>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }
      
      updateScoreBadge(fallbackScore);
      savePhotoToLocalStorage(state.currentPhotoData, fallbackScore, true);
      setCircleState('validated');
      showButtons('change');
    }

    function skipVerificationAndContinue() {
      console.log('⏩ User skipped verification');
      stopPhotoPolling();
      clearVerificationTimeout();
      
      const skipScore = 50;
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-3 border-blue-400 rounded-2xl p-4 sm:p-5 space-y-3 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">✅</div>
              <p class="text-lg sm:text-xl font-black text-blue-700">Photo saved!</p>
              <p class="text-sm sm:text-base font-semibold text-blue-600">
                Your photo has been saved. You can continue your registration.
              </p>
              <p class="text-xs text-gray-500 mt-2">
                💡 Tip: Verified photos get better visibility and customer trust
              </p>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }
      
      updateScoreBadge(skipScore);
      savePhotoToLocalStorage(state.currentPhotoData, skipScore, true);
      setCircleState('preview');
      showButtons('change');
    }

    // =======================================
    // API MANAGEMENT
    // =======================================
    
    async function sendPhotoToBackend(imageData) {
      setCircleState('verifying');
      updateVerificationMessage('📤 Uploading...');
      showButtons('skip');
      
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
        
        if (state.retryCount < CONFIG.MAX_RETRIES) {
          state.retryCount++;
          updateVerificationMessage(`⚠️ Retry attempt ${state.retryCount}/${CONFIG.MAX_RETRIES}...`);
          
          setTimeout(() => {
            sendPhotoToBackend(imageData);
          }, 2000);
          return;
        }
        
        setCircleState('error');
        displayError(error.message, 'api');
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
          displayError(message || 'A verification error occurred', 'api');
          break;

        case 'processing':
          updateVerificationMessage('🔄 Analyzing your photo...');
          break;

        case 'pending':
        default:
          updateVerificationMessage('⏳ Waiting for verification...');
          break;
      }
    }

    function updateVerificationMessage(message) {
      if (elements.verificationMessage) {
        elements.verificationMessage.textContent = message;
      }
    }

    // =======================================
    // RESULTS DISPLAY
    // =======================================
    
    function displayScore(score, message) {
      setCircleState('validated');
      clearVerificationTimeout();
      
      // Update the score badge
      updateScoreBadge(score);

      let cardClass, emoji, title, resultMessage;

      if (score >= 95) {
        cardClass = 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-400';
        emoji = '🏆';
        title = 'Exceptional selfie!';
        resultMessage = message || "This photo is perfect for inspiring trust.";
      } else if (score >= 80) {
        cardClass = 'bg-gradient-to-r from-blue-50 to-cyan-50 border-blue-400';
        emoji = '✨';
        title = 'Excellent photo!';
        resultMessage = message || "Clear, professional and welcoming for customers.";
      } else if (score >= 60) {
        cardClass = 'bg-gradient-to-r from-yellow-50 to-orange-50 border-yellow-400';
        emoji = '👍';
        title = 'Photo validated';
        resultMessage = message || "It works. You can improve it later if you wish.";
      } else {
        cardClass = 'bg-gradient-to-r from-orange-50 to-red-50 border-orange-400';
        emoji = '⚠️';
        title = 'Acceptable photo';
        resultMessage = message || "It's accepted, but you could upload a clearer one.";
      }

      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="rounded-2xl p-4 sm:p-5 space-y-3 border-3 transition-all ${cardClass} fade-in">
            <div class="text-center space-y-1">
              <p class="text-3xl sm:text-4xl font-black mb-2">${emoji}</p>
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

      if (elements.scoreBadgeDesktop) elements.scoreBadgeDesktop.classList.remove('score-visible');
      if (elements.scoreBadgeMobile) elements.scoreBadgeMobile.classList.remove('score-visible');

      let mainReason = reason || "Your photo could not be validated.";
      
      const solutionsList = suggestions && suggestions.length > 0 
        ? suggestions.map(s => `<li class="text-xs sm:text-sm text-gray-700 font-medium">✓ ${s}</li>`).join('')
        : `
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Make sure your face is fully visible</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Use good lighting (natural light preferred)</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Remove sunglasses, masks, or facial coverings</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Look directly at the camera</li>
          <li class="text-xs sm:text-sm text-gray-700 font-medium">✓ Be alone in the photo (no other people)</li>
        `;

      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-4 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">❌</div>
              <p class="text-lg sm:text-xl font-black text-red-700">Photo rejected</p>
            </div>
            
            <div class="bg-red-100 border-2 border-red-300 rounded-xl p-3 sm:p-4">
              <p class="text-xs sm:text-sm font-bold text-red-900 mb-1">Why was it rejected?</p>
              <p class="text-sm sm:text-base font-semibold text-red-700 whitespace-pre-line leading-relaxed">
                ${mainReason}
              </p>
            </div>
            
            <div class="bg-white/80 border-2 border-orange-300 rounded-xl p-3 sm:p-4 space-y-2">
              <p class="text-xs sm:text-sm font-bold text-gray-900 flex items-center gap-2">
                <span class="text-lg">💡</span> How to fix:
              </p>
              <ul class="space-y-2">${solutionsList}</ul>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
      }

      setCircleState('idle');
      showButtons('main');
    }

    function displayError(message, errorType) {
      setCircleState('error');
      
      if (elements.resultCard) {
        elements.resultCard.innerHTML = `
          <div class="bg-gradient-to-r from-red-50 to-orange-50 border-3 border-red-300 rounded-2xl p-4 sm:p-5 space-y-4 fade-in">
            <div class="text-center space-y-2">
              <div class="text-4xl mb-1">⚠️</div>
              <p class="text-lg sm:text-xl font-black text-red-700">Verification error</p>
            </div>
            
            <div class="bg-red-100 border-2 border-red-300 rounded-xl p-3 sm:p-4">
              <p class="text-sm sm:text-base font-semibold text-red-700 leading-relaxed">
                ${message}
              </p>
            </div>
            
            <div class="space-y-2">
              <button type="button" id="retryErrorBtn" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition">
                🔄 Try again
              </button>
              <button type="button" id="acceptAnywayErrorBtn" class="w-full bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition">
                ✓ Accept photo anyway
              </button>
            </div>
          </div>
        `;
        elements.resultCard.classList.remove('hidden');
        
        document.getElementById('retryErrorBtn')?.addEventListener('click', resetAndRetry);
        document.getElementById('acceptAnywayErrorBtn')?.addEventListener('click', activateFallbackMode);
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

    // =======================================
    // CAMERA MANAGEMENT
    // =======================================
    
    async function openCamera() {
      if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        alert("Your device's camera is not available. Please upload a photo from your gallery.");
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
        alert("We couldn't access your camera. Please upload a photo from your device.");
        setCircleState('idle');
        showButtons('main');
      }
    }

    function closeCamera() {
      if (state.cameraStream) {
        const tracks = state.cameraStream.getTracks();
        tracks.forEach(track => track.stop());
        state.cameraStream = null;
      }
      
      if (elements.videoStream) {
        if (elements.videoStream.srcObject) {
          const videoTracks = elements.videoStream.srcObject.getTracks();
          videoTracks.forEach(track => track.stop());
        }
        elements.videoStream.srcObject = null;
        elements.videoStream.pause();
        elements.videoStream.load();
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
      }

      state.currentPhotoData = imageData;
      closeCamera();
      
      sendPhotoToBackend(imageData);
    }

    // =======================================
    // FILE UPLOAD
    // =======================================
    
    function handleFileUpload(file) {
      if (!file || !file.type.startsWith('image/')) {
        alert('Please select an image file.');
        return;
      }

      if (file.size > CONFIG.MAX_IMAGE_SIZE) {
        alert('Your image is too large. Maximum size: 5 MB.');
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        const result = e.target?.result;
        if (!result) return;

        const img = new Image();
        img.onload = function() {
          if (elements.preview) {
            elements.preview.src = result;
          }

          state.currentPhotoData = result;
          sendPhotoToBackend(result);
        };
        img.src = result;
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
        return false;
      }
    }

    function resetPhotoUI() {
      if (elements.preview) elements.preview.src = '';
      if (elements.scoreBadgeDesktop) elements.scoreBadgeDesktop.classList.remove('score-visible');
      if (elements.scoreBadgeMobile) elements.scoreBadgeMobile.classList.remove('score-visible');
      if (elements.resultCard) {
        elements.resultCard.classList.add('hidden');
        elements.resultCard.innerHTML = '';
      }
      if (elements.upload) elements.upload.value = '';
      
      state.currentPhotoData = null;
      state.currentScore = 0;
    }

    function restorePhoto() {
      try {
        const data = getLocalStorage();
        const saved = data.profilePhoto;

        if (saved?.image) {
          const img = new Image();
          img.onload = function() {
            if (elements.preview) {
              elements.preview.src = saved.image;
            }

            state.hasPhoto = true;
            state.isValidated = !!saved.validated;
            state.currentPhotoData = saved.image;
            state.currentScore = saved.score || 75;

            if (saved.validated) {
              setCircleState('validated');
              updateScoreBadge(state.currentScore);
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
            setCircleState('idle');
            showButtons('main');
          };
          
          img.src = saved.image;
        } else {
          setCircleState('idle');
          showButtons('main');
        }
      } catch (e) {
        setCircleState('idle');
        showButtons('main');
      }
    }

    // =======================================
    // VALIDATION
    // =======================================
    
    window.validateStep10 = function(showAlert) {
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
    
    elements.upload?.addEventListener('change', e => {
      const file = e.target.files?.[0];
      if (file) handleFileUpload(file);
    });

    elements.takePictureBtn?.addEventListener('click', openCamera);
    elements.captureBtn?.addEventListener('click', capturePhoto);
    
    elements.cancelCameraBtn?.addEventListener('click', () => {
      closeCamera();
      resetPhotoUI();
      setCircleState('idle');
      showButtons('main');
    });

    elements.changePhotoBtn?.addEventListener('click', () => {
      closeCamera();
      removePhotoFromLocalStorage();
      resetPhotoUI();
      setCircleState('idle');
      showButtons('main');
    });

    elements.fallbackBtn?.addEventListener('click', activateFallbackMode);
    elements.skipVerificationBtn?.addEventListener('click', skipVerificationAndContinue);

    // Observer for step visibility
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

    // Init
    if (elements.step && !elements.step.classList.contains('hidden')) {
      restorePhoto();
    }
  })();
</script>