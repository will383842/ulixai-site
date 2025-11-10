<div id="step11" class="hidden flex flex-col h-full" role="region" aria-label="Identity Verification">
  
  <!-- FIXED HEADER -->
  <div class="sticky top-0 z-10 bg-white pt-3 pb-3 border-b border-gray-100">
    
    <!-- Ambient Background Effects -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-1.5 relative px-4">
      <div class="flex justify-center">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-xl">🪪</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-lg sm:text-xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-0.5 tracking-tight">
          Identity Verification 🔐
        </h2>
        <p class="text-xs sm:text-sm font-bold text-gray-700">
          Pick your favorite document! 🎯
        </p>
      </div>
    </div>
  </div>

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto pt-3 pb-4 px-4">

    <!-- Document Type Cards -->
    <div class="grid grid-cols-1 gap-2.5 max-w-md mx-auto mb-4">
      
      <!-- Passport Card -->
      <div id="passportCard" class="doc-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-3 border-2 border-blue-300 shadow-md hover:shadow-xl transition-all" onclick="openDocumentModal('passport')">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
            <span class="text-2xl">🛂</span>
          </div>
          <div class="flex-1 text-left">
            <h3 class="text-sm sm:text-base font-bold text-gray-900">Passport</h3>
            <p class="text-xs text-gray-600">1 photo • Quick</p>
          </div>
          <div class="flex-shrink-0">
            <div id="passportStatus" class="text-sm font-semibold text-gray-500">📸</div>
          </div>
        </div>
      </div>

      <!-- European ID Card -->
      <div id="european_idCard" class="doc-card bg-gradient-to-br from-emerald-50 to-teal-100 rounded-xl p-3 border-2 border-emerald-300 shadow-md hover:shadow-xl transition-all" onclick="openDocumentModal('european_id')">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
            <span class="text-2xl">🪪</span>
          </div>
          <div class="flex-1 text-left">
            <h3 class="text-sm sm:text-base font-bold text-gray-900">ID Card</h3>
            <p class="text-xs text-gray-600">Front + Back</p>
          </div>
          <div class="flex-shrink-0">
            <div id="european_idStatus" class="text-sm font-semibold text-gray-500">📸</div>
          </div>
        </div>
      </div>

      <!-- Driver's License Card -->
      <div id="licenseCard" class="doc-card bg-gradient-to-br from-purple-50 to-pink-100 rounded-xl p-3 border-2 border-purple-300 shadow-md hover:shadow-xl transition-all" onclick="openDocumentModal('license')">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
            <span class="text-2xl">🚗</span>
          </div>
          <div class="flex-1 text-left">
            <h3 class="text-sm sm:text-base font-bold text-gray-900">Driver's License</h3>
            <p class="text-xs text-gray-600">Front + Back</p>
          </div>
          <div class="flex-shrink-0">
            <div id="licenseStatus" class="text-sm font-semibold text-gray-500">📸</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Info Box -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-300 rounded-xl p-3 max-w-md mx-auto">
      <div class="flex items-start gap-2">
        <div class="w-7 h-7 bg-amber-500 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
          <span class="text-base">💡</span>
        </div>
        <div>
          <h3 class="text-amber-900 font-bold text-xs mb-0.5">Quick Tips</h3>
          <ul class="text-amber-800 text-xs space-y-0.5">
            <li>✓ Clear & readable photo</li>
            <li>✓ Good lighting, no glare</li>
            <li>✓ Full document in frame</li>
          </ul>
        </div>
      </div>
    </div>

  </div>

  <!-- Document Upload Modal - MUCH SMALLER, RESPONSIVE LAYOUT -->
  <div id="documentModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="modal-overlay flex items-center justify-center min-h-screen p-2">
      <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[95vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-2.5 rounded-t-2xl z-10">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
              <span id="modalIcon" class="text-xl">🛂</span>
              <div>
                <h3 id="modalTitle" class="text-sm font-bold">Upload Passport</h3>
                <p id="modalSubtitle" class="text-xs text-blue-100">Front side only</p>
              </div>
            </div>
            <button onclick="closeDocumentModal()" class="text-white hover:text-gray-200 transition">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Modal Body - RESPONSIVE GRID -->
        <div class="p-3 space-y-2">
          
          <!-- Error message -->
          <div id="fileErrorMessage" class="hidden bg-red-50 border-2 border-red-500 rounded-lg p-2 fade-in">
            <div class="flex items-start gap-2">
              <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <p id="fileErrorTitle" class="text-xs font-bold text-red-800"></p>
                <p id="fileErrorDetails" class="text-xs text-red-600 mt-0.5"></p>
              </div>
            </div>
          </div>

          <!-- RESPONSIVE CONTAINER: Vertical on mobile, Horizontal on desktop -->
          <div id="photosContainer" class="flex flex-col sm:flex-row gap-3">
            
            <!-- Front Photo Block -->
            <div id="frontSection" class="flex-1">
              <h4 class="text-xs font-bold text-gray-900 mb-1">
                <span id="frontLabel">Photo page passeport avec photo</span>
              </h4>
              
              <!-- SMALLER SQUARE BLOCK -->
              <div id="frontPreview" class="preview-box-tiny-square mb-1.5">
                <div id="frontPlaceholder" class="text-center p-2">
                  <p class="text-xs text-gray-600 font-semibold leading-tight" id="frontPlaceholderText">📄 Photo page passeport avec photo</p>
                </div>

                <!-- Camera View -->
                <video id="frontCameraStream" class="hidden w-full h-full object-cover" autoplay playsinline muted></video>
                <canvas id="frontCaptureCanvas" class="hidden"></canvas>

                <!-- Verification Overlay - ONLY shown during upload -->
                <div id="frontVerificationOverlay" class="upload-overlay hidden">
                  <div class="spinner-tiny mb-1"></div>
                  <p id="frontVerificationMessage" class="text-gray-700 font-semibold text-xs">Vérification...</p>
                </div>
              </div>

              <!-- Status Badge -->
              <div id="frontStatusBadge" class="hidden mb-1.5"></div>

              <!-- Change Photo Button -->
              <div id="frontChangeContainer" class="hidden mb-1.5">
                <button onclick="changeFrontPhoto()" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg hover:from-gray-700 hover:to-gray-800 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                  <span>Changer</span>
                </button>
              </div>

              <!-- Main Action Buttons -->
              <div id="frontActionButtons" class="flex flex-row gap-1.5 mb-1.5">
                <input type="file" id="frontFileInput" accept="image/*" class="hidden" onchange="handleFrontUpload(event)">
                <button onclick="document.getElementById('frontFileInput').click()" 
                        class="flex-1 px-2 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  <span>Galerie</span>
                </button>
                <button onclick="takeFrontPhoto()" 
                        id="frontSelfieBtn"
                        class="flex-1 px-2 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg hover:from-emerald-600 hover:to-teal-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                  </svg>
                  <span>Photo</span>
                </button>
              </div>

              <!-- Camera Buttons -->
              <div id="frontCameraButtons" class="hidden mb-1.5">
                <div class="flex flex-row gap-1.5 mb-1.5">
                  <button onclick="captureFrontPhoto()" 
                          class="flex-1 px-2 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold text-xs">
                    📸 Capturer
                  </button>
                  <button onclick="cancelFrontCamera()" 
                          class="flex-1 px-2 py-1.5 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg hover:from-gray-600 hover:to-gray-700 transition font-semibold text-xs">
                    ✕ Annuler
                  </button>
                </div>
                <button onclick="flipCamera('front')" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                  <span>Inverser caméra</span>
                </button>
              </div>

              <!-- Skip Verification -->
              <div id="frontSkipContainer" class="hidden mb-1.5">
                <button onclick="skipFrontVerification()" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-yellow-600 hover:to-orange-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                  </svg>
                  <span>Passer</span>
                </button>
              </div>
            </div>

            <!-- Back Photo Block (hidden for passport) -->
            <div id="backSection" class="hidden flex-1">
              <h4 class="text-xs font-bold text-gray-900 mb-1">
                <span id="backLabel">Verso pièce d'identité</span>
              </h4>
              
              <!-- SMALLER SQUARE BLOCK -->
              <div id="backPreview" class="preview-box-tiny-square mb-1.5">
                <div id="backPlaceholder" class="text-center p-2">
                  <p class="text-xs text-gray-600 font-semibold leading-tight" id="backPlaceholderText">📄 Verso pièce d'identité</p>
                </div>

                <!-- Camera View -->
                <video id="backCameraStream" class="hidden w-full h-full object-cover" autoplay playsinline muted></video>
                <canvas id="backCaptureCanvas" class="hidden"></canvas>

                <!-- Verification Overlay -->
                <div id="backVerificationOverlay" class="upload-overlay hidden">
                  <div class="spinner-tiny mb-1"></div>
                  <p id="backVerificationMessage" class="text-gray-700 font-semibold text-xs">Vérification...</p>
                </div>
              </div>

              <!-- Status Badge -->
              <div id="backStatusBadge" class="hidden mb-1.5"></div>

              <!-- Change Photo Button -->
              <div id="backChangeContainer" class="hidden mb-1.5">
                <button onclick="changeBackPhoto()" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg hover:from-gray-700 hover:to-gray-800 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                  <span>Changer</span>
                </button>
              </div>

              <!-- Main Action Buttons -->
              <div id="backActionButtons" class="flex flex-row gap-1.5 mb-1.5">
                <input type="file" id="backFileInput" accept="image/*" class="hidden" onchange="handleBackUpload(event)">
                <button onclick="document.getElementById('backFileInput').click()" 
                        class="flex-1 px-2 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  <span>Galerie</span>
                </button>
                <button onclick="takeBackPhoto()" 
                        id="backSelfieBtn"
                        class="flex-1 px-2 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg hover:from-emerald-600 hover:to-teal-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                  </svg>
                  <span>Photo</span>
                </button>
              </div>

              <!-- Camera Buttons -->
              <div id="backCameraButtons" class="hidden mb-1.5">
                <div class="flex flex-row gap-1.5 mb-1.5">
                  <button onclick="captureBackPhoto()" 
                          class="flex-1 px-2 py-1.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold text-xs">
                    📸 Capturer
                  </button>
                  <button onclick="cancelBackCamera()" 
                          class="flex-1 px-2 py-1.5 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg hover:from-gray-600 hover:to-gray-700 transition font-semibold text-xs">
                    ✕ Annuler
                  </button>
                </div>
                <button onclick="flipCamera('back')" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                  </svg>
                  <span>Inverser caméra</span>
                </button>
              </div>

              <!-- Skip Verification -->
              <div id="backSkipContainer" class="hidden mb-1.5">
                <button onclick="skipBackVerification()" 
                        class="w-full px-2 py-1.5 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-yellow-600 hover:to-orange-600 transition font-semibold text-xs flex items-center justify-center gap-1">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                  </svg>
                  <span>Passer</span>
                </button>
              </div>
            </div>

          </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gray-50 p-2.5 rounded-b-2xl border-t">
          <div class="flex gap-2">
            <button onclick="closeDocumentModal()" 
                    class="flex-1 px-3 py-1.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-xs">
              Retour
            </button>
            <button id="modalContinueBtn" onclick="closeDocumentModal()" disabled
                    class="flex-1 px-3 py-1.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition font-semibold disabled:opacity-50 disabled:cursor-not-allowed text-xs">
              ✓ Continuer
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- STYLES -->
<style>
/* Blob animations */
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

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.fade-in {
  animation: fadeIn 0.3s ease-out;
}

.spinner-tiny {
  width: 16px;
  height: 16px;
  border: 2px solid #e5e7eb;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.doc-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.doc-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2);
}

.doc-card:active {
  transform: translateY(0);
}

.doc-card.highlighted {
  border-width: 3px;
  box-shadow: 0 8px 16px -2px rgba(59, 130, 246, 0.4);
  transform: scale(1.02);
}

.modal-overlay {
  backdrop-filter: blur(4px);
}

/* TINY SQUARE preview boxes - much smaller, responsive */
.preview-box-tiny-square {
  width: 100%;
  max-width: 150px;
  aspect-ratio: 1 / 1;
  margin: 0 auto;
  border: 2px dashed #d1d5db;
  border-radius: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  background: #f9fafb;
}

.preview-box-tiny-square img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.upload-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.95);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.upload-overlay.hidden {
  display: none !important;
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<!-- JAVASCRIPT -->
<script>
  (function() {
    'use strict';

    const API_BASE_URL = '/api/provider/verification';
    
    @auth
      const API_TOKEN = '{{ auth()->user()->createToken("provider-verification")->plainTextToken }}';
      const IS_AUTHENTICATED = true;
    @else
      const API_TOKEN = '';
      const IS_AUTHENTICATED = false;
    @endauth
    
    const documentState = {
      currentType: null,
      lastSelectedType: null,
      documents: {
        passport: { front: null, frontId: null, frontStatus: null },
        european_id: { front: null, back: null, frontId: null, backId: null, frontStatus: null, backStatus: null },
        license: { front: null, back: null, frontId: null, backId: null, frontStatus: null, backStatus: null }
      },
      pollingIntervals: {},
      cameraStreams: { front: null, back: null },
      cameraFacingMode: { front: 'environment', back: 'environment' } // Default to back camera for documents
    };

    const DOC_CONFIG = {
      passport: {
        icon: '🛂',
        title: 'Upload Passport',
        subtitle: 'Front side only',
        needsBack: false,
        frontLabel: 'Photo page passeport avec photo',
        frontPlaceholder: '📄 Photo page passeport avec photo'
      },
      european_id: {
        icon: '🪪',
        title: 'Upload ID Card',
        subtitle: 'Front and back required',
        needsBack: true,
        frontLabel: 'Recto pièce d\'identité',
        frontPlaceholder: '📄 Recto pièce d\'identité',
        backLabel: 'Verso pièce d\'identité',
        backPlaceholder: '📄 Verso pièce d\'identité'
      },
      license: {
        icon: '🚗',
        title: 'Upload Driver\'s License',
        subtitle: 'Front and back required',
        needsBack: true,
        frontLabel: 'Recto permis de conduire',
        frontPlaceholder: '📄 Recto permis de conduire',
        backLabel: 'Verso permis de conduire',
        backPlaceholder: '📄 Verso permis de conduire'
      }
    };

    // ============================================
    // UI Management
    // ============================================
    function showButtonsForSide(side, type) {
      const actionButtons = document.getElementById(`${side}ActionButtons`);
      const cameraButtons = document.getElementById(`${side}CameraButtons`);
      const changeContainer = document.getElementById(`${side}ChangeContainer`);
      const skipContainer = document.getElementById(`${side}SkipContainer`);

      if (actionButtons) actionButtons.classList.add('hidden');
      if (cameraButtons) cameraButtons.classList.add('hidden');
      if (changeContainer) changeContainer.classList.add('hidden');
      if (skipContainer) skipContainer.classList.add('hidden');

      switch(type) {
        case 'main':
          if (actionButtons) actionButtons.classList.remove('hidden');
          break;
        case 'camera':
          if (cameraButtons) cameraButtons.classList.remove('hidden');
          break;
        case 'change':
          if (changeContainer) changeContainer.classList.remove('hidden');
          break;
        case 'skip':
          if (skipContainer) skipContainer.classList.remove('hidden');
          break;
      }
    }

    function showFileError(title, details) {
      const errorDiv = document.getElementById('fileErrorMessage');
      const errorTitle = document.getElementById('fileErrorTitle');
      const errorDetails = document.getElementById('fileErrorDetails');
      
      if (errorDiv && errorTitle && errorDetails) {
        errorTitle.textContent = title;
        errorDetails.textContent = details;
        errorDiv.classList.remove('hidden');
        
        setTimeout(() => {
          errorDiv.classList.add('hidden');
        }, 5000);
      }
    }

    function hideAllErrors() {
      const fileError = document.getElementById('fileErrorMessage');
      if (fileError) fileError.classList.add('hidden');
    }

    function highlightCard(type) {
      ['passport', 'european_id', 'license'].forEach(t => {
        const card = document.getElementById(`${t}Card`);
        if (card) card.classList.remove('highlighted');
      });
      
      if (type) {
        const card = document.getElementById(`${type}Card`);
        if (card) card.classList.add('highlighted');
      }
    }

    // ============================================
    // Modal Management
    // ============================================
    window.openDocumentModal = function(type) {
      console.log(`📂 Opening modal for ${type}`);
      
      documentState.currentType = type;
      documentState.lastSelectedType = type;
      const config = DOC_CONFIG[type];

      hideAllErrors();
      highlightCard(type);

      document.getElementById('modalIcon').textContent = config.icon;
      document.getElementById('modalTitle').textContent = config.title;
      document.getElementById('modalSubtitle').textContent = config.subtitle;
      document.getElementById('frontLabel').textContent = config.frontLabel;
      
      const frontPlaceholderText = document.getElementById('frontPlaceholderText');
      if (frontPlaceholderText) {
        frontPlaceholderText.textContent = config.frontPlaceholder;
      }

      const backSection = document.getElementById('backSection');
      if (config.needsBack) {
        backSection.classList.remove('hidden');
        document.getElementById('backLabel').textContent = config.backLabel;
        const backPlaceholderText = document.getElementById('backPlaceholderText');
        if (backPlaceholderText) {
          backPlaceholderText.textContent = config.backPlaceholder;
        }
      } else {
        backSection.classList.add('hidden');
      }

      // FORCE HIDE ALL VERIFICATION OVERLAYS
      const frontOverlay = document.getElementById('frontVerificationOverlay');
      const backOverlay = document.getElementById('backVerificationOverlay');
      if (frontOverlay) {
        frontOverlay.classList.add('hidden');
        frontOverlay.style.display = 'none';
      }
      if (backOverlay) {
        backOverlay.classList.add('hidden');
        backOverlay.style.display = 'none';
      }

      restoreDocumentPreviews(type);
      document.getElementById('documentModal').classList.remove('hidden');
      
      // UPDATE BUTTON STATE (will be called again in restoreDocumentPreviews but that's ok)
      updateModalContinueButton();
      
      console.log('✅ Modal opened');
    };

    window.closeDocumentModal = function() {
      console.log('🚪 Closing document modal');
      stopAllCameras();
      document.getElementById('documentModal').classList.add('hidden');
      documentState.currentType = null;
      hideAllErrors();
      updateCardStatuses();
      
      if (documentState.lastSelectedType) {
        highlightCard(documentState.lastSelectedType);
      }
      
      console.log('✅ Modal closed');
    };

    // ============================================
    // File Upload
    // ============================================
    window.handleFrontUpload = function(event) {
      const file = event.target.files[0];
      if (file) {
        resetSideState('front');
        processImageFile(file, 'front');
      }
      event.target.value = '';
    };

    window.handleBackUpload = function(event) {
      const file = event.target.files[0];
      if (file) {
        resetSideState('back');
        processImageFile(file, 'back');
      }
      event.target.value = '';
    };

    function processImageFile(file, side) {
      hideAllErrors();

      if (!file.type.startsWith('image/')) {
        showFileError('Type invalide', 'Sélectionnez une image (JPG, PNG)');
        return;
      }

      if (file.size > 5 * 1024 * 1024) {
        showFileError('Fichier trop gros', 'Taille max: 5 Mo');
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        const imageData = e.target.result;
        displayImage(imageData, side);
        sendDocumentToBackend(imageData, side);
      };
      reader.readAsDataURL(file);
    }

    // ============================================
    // Camera
    // ============================================
    
    // Reset side state before any action
    function resetSideState(side) {
      console.log(`🔄 Resetting state for ${side}`);
      
      // Stop camera using dedicated function
      stopCamera(side);
      
      const placeholder = document.getElementById(`${side}Placeholder`);
      const verificationOverlay = document.getElementById(`${side}VerificationOverlay`);
      
      // FORCE HIDE verification overlay
      if (verificationOverlay) {
        verificationOverlay.classList.add('hidden');
        verificationOverlay.style.display = 'none';
      }
      
      // Show placeholder if no image
      const type = documentState.currentType;
      const hasImage = type && documentState.documents[type][side];
      if (!hasImage && placeholder) {
        placeholder.classList.remove('hidden');
      }
      
      console.log(`✅ State reset complete for ${side}`);
    }
    
    window.takeFrontPhoto = async function() {
      resetSideState('front');
      await openInlineCamera('front');
    };

    window.takeBackPhoto = async function() {
      resetSideState('back');
      await openInlineCamera('back');
    };

    async function openInlineCamera(side) {
      hideAllErrors();
      
      console.log(`Opening camera for ${side}...`);
      
      const facingMode = documentState.cameraFacingMode[side];

      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: { 
            facingMode: facingMode,
            width: { ideal: 1280 },
            height: { ideal: 720 }
          },
          audio: false
        });

        console.log(`Camera stream obtained for ${side}`);
        
        documentState.cameraStreams[side] = stream;
        const videoElement = document.getElementById(`${side}CameraStream`);
        const placeholder = document.getElementById(`${side}Placeholder`);
        
        if (!videoElement) {
          console.error('Video element not found');
          return;
        }
        
        videoElement.srcObject = stream;
        
        // Wait for video to be ready
        await new Promise((resolve, reject) => {
          videoElement.onloadedmetadata = () => {
            console.log(`Video metadata loaded for ${side}`);
            videoElement.play().then(() => {
              console.log(`Video playing for ${side}`);
              resolve();
            }).catch(reject);
          };
          
          // Timeout after 5 seconds
          setTimeout(() => reject(new Error('Video load timeout')), 5000);
        });
        
        // Hide placeholder, show video
        if (placeholder) placeholder.classList.add('hidden');
        videoElement.classList.remove('hidden');
        
        // Switch to camera buttons
        showButtonsForSide(side, 'camera');
        
        console.log(`Camera opened successfully for ${side}`);
        
      } catch (error) {
        console.error('Camera error:', error);
        showFileError('Erreur caméra', 'Impossible d\'accéder à la caméra. Utilisez la galerie.');
        resetSideState(side);
        showButtonsForSide(side, 'main');
      }
    }

    // Flip camera between front and back
    window.flipCamera = async function(side) {
      // Toggle facing mode
      documentState.cameraFacingMode[side] = documentState.cameraFacingMode[side] === 'user' ? 'environment' : 'user';
      
      // Stop current camera
      if (documentState.cameraStreams[side]) {
        documentState.cameraStreams[side].getTracks().forEach(track => track.stop());
        documentState.cameraStreams[side] = null;
      }
      
      // Reopen with new facing mode
      await openInlineCamera(side);
    };

    window.captureFrontPhoto = function() {
      captureInlinePhoto('front');
    };

    window.captureBackPhoto = function() {
      captureInlinePhoto('back');
    };

    function captureInlinePhoto(side) {
      const video = document.getElementById(`${side}CameraStream`);
      const canvas = document.getElementById(`${side}CaptureCanvas`);
      
      if (!video || !canvas) {
        console.error('Video or canvas element not found');
        return;
      }
      
      canvas.width = video.videoWidth || 1280;
      canvas.height = video.videoHeight || 720;
      
      const ctx = canvas.getContext('2d');
      if (!ctx) {
        console.error('Could not get canvas context');
        return;
      }
      
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      const imageData = canvas.toDataURL('image/jpeg', 0.85);
      
      // IMPORTANT: Stop camera BEFORE displaying image
      stopCamera(side);
      
      displayImage(imageData, side);
      sendDocumentToBackend(imageData, side);
    }

    window.cancelFrontCamera = function() {
      console.log('❌ User cancelled front camera');
      stopCamera('front');
      
      // Ensure placeholder is visible
      const placeholder = document.getElementById('frontPlaceholder');
      if (placeholder) {
        placeholder.classList.remove('hidden');
      }
      
      showButtonsForSide('front', 'main');
    };

    window.cancelBackCamera = function() {
      console.log('❌ User cancelled back camera');
      stopCamera('back');
      
      // Ensure placeholder is visible
      const placeholder = document.getElementById('backPlaceholder');
      if (placeholder) {
        placeholder.classList.remove('hidden');
      }
      
      showButtonsForSide('back', 'main');
    };

    function stopCamera(side) {
      console.log(`🔴 Stopping camera for ${side}`);
      
      // Stop media stream
      if (documentState.cameraStreams[side]) {
        const tracks = documentState.cameraStreams[side].getTracks();
        tracks.forEach(track => {
          track.stop();
          console.log(`Stopped track: ${track.kind}`);
        });
        documentState.cameraStreams[side] = null;
      }
      
      // Clean video element
      const videoElement = document.getElementById(`${side}CameraStream`);
      if (videoElement) {
        if (videoElement.srcObject) {
          const videoTracks = videoElement.srcObject.getTracks();
          videoTracks.forEach(track => track.stop());
        }
        videoElement.srcObject = null;
        videoElement.pause();
        videoElement.load();
        videoElement.classList.add('hidden');
      }
      
      console.log(`✅ Camera ${side} fully stopped`);
    }

    function stopAllCameras() {
      console.log('🛑 Stopping all cameras');
      stopCamera('front');
      stopCamera('back');
    }

    // ============================================
    // Change Photo
    // ============================================
    window.changeFrontPhoto = function() {
      const type = documentState.currentType;
      
      console.log(`🗑️ Deleting front photo for ${type}`);
      
      // FULL CLEANUP
      stopDocumentPolling(type, 'front');
      resetSideState('front');
      
      if (type) {
        documentState.documents[type].front = null;
        documentState.documents[type].frontStatus = null;
        documentState.documents[type].frontId = null;
        
        // REMOVE FROM LOCALSTORAGE (like step10)
        try {
          const data = getLocalStorage();
          if (data.documents && data.documents[type]) {
            delete data.documents[type].front;
            delete data.documents[type].frontStatus;
            delete data.documents[type].frontScore;
            
            // If both sides are empty, remove the whole type
            const hasBack = data.documents[type].back;
            if (!hasBack) {
              console.log(`🗑️ No images left for ${type}, removing entire entry`);
              delete data.documents[type];
            }
            
            localStorage.setItem('expats', JSON.stringify(data));
            console.log('✅ LocalStorage updated after deletion');
          }
        } catch (e) {
          console.error('❌ Error removing from localStorage:', e);
        }
      }
      
      // Reset preview to placeholder
      const preview = document.getElementById('frontPreview');
      if (preview) {
        preview.innerHTML = `
          <div id="frontPlaceholder" class="text-center p-2">
            <p class="text-xs text-gray-600 font-semibold leading-tight" id="frontPlaceholderText">${DOC_CONFIG[type]?.frontPlaceholder || '📄 Photo'}</p>
          </div>
        `;
      }
      
      // Hide status badge
      const statusBadge = document.getElementById('frontStatusBadge');
      if (statusBadge) {
        statusBadge.classList.add('hidden');
        statusBadge.innerHTML = '';
      }
      
      // Show main buttons again
      showButtonsForSide('front', 'main');
      
      // UPDATE BUTTON STATES
      updateModalContinueButton();
      updateCardStatuses();
      
      console.log('✅ Front photo deleted - ready for new photo');
    };

    window.changeBackPhoto = function() {
      const type = documentState.currentType;
      
      console.log(`🗑️ Deleting back photo for ${type}`);
      
      // FULL CLEANUP
      stopDocumentPolling(type, 'back');
      resetSideState('back');
      
      if (type) {
        documentState.documents[type].back = null;
        documentState.documents[type].backStatus = null;
        documentState.documents[type].backId = null;
        
        // REMOVE FROM LOCALSTORAGE (like step10)
        try {
          const data = getLocalStorage();
          if (data.documents && data.documents[type]) {
            delete data.documents[type].back;
            delete data.documents[type].backStatus;
            delete data.documents[type].backScore;
            
            // If both sides are empty, remove the whole type
            const hasFront = data.documents[type].front;
            if (!hasFront) {
              console.log(`🗑️ No images left for ${type}, removing entire entry`);
              delete data.documents[type];
            }
            
            localStorage.setItem('expats', JSON.stringify(data));
            console.log('✅ LocalStorage updated after deletion');
          }
        } catch (e) {
          console.error('❌ Error removing from localStorage:', e);
        }
      }
      
      // Reset preview to placeholder
      const preview = document.getElementById('backPreview');
      if (preview) {
        preview.innerHTML = `
          <div id="backPlaceholder" class="text-center p-2">
            <p class="text-xs text-gray-600 font-semibold leading-tight" id="backPlaceholderText">${DOC_CONFIG[type]?.backPlaceholder || '📄 Photo'}</p>
          </div>
        `;
      }
      
      // Hide status badge
      const statusBadge = document.getElementById('backStatusBadge');
      if (statusBadge) {
        statusBadge.classList.add('hidden');
        statusBadge.innerHTML = '';
      }
      
      // Show main buttons again
      showButtonsForSide('back', 'main');
      
      // UPDATE BUTTON STATES
      updateModalContinueButton();
      updateCardStatuses();
      
      console.log('✅ Back photo deleted - ready for new photo');
    };

    // ============================================
    // LocalStorage Management (like step10)
    // ============================================
    function getLocalStorage() {
      try {
        const data = localStorage.getItem('expats');
        return data ? JSON.parse(data) : {};
      } catch (e) {
        return {};
      }
    }

    function saveDocumentToLocalStorage(type, side, imageData, status, score) {
      try {
        const data = getLocalStorage();
        if (!data.documents) data.documents = {};
        if (!data.documents[type]) data.documents[type] = {};
        
        data.documents[type][side] = imageData;
        data.documents[type][`${side}Status`] = status || 'skipped';
        data.documents[type][`${side}Score`] = score || 50;
        data.documents[type].uploaded_at = new Date().toISOString();
        
        localStorage.setItem('expats', JSON.stringify(data));
        
        // Update state
        documentState.documents[type][side] = imageData;
        documentState.documents[type][`${side}Status`] = status || 'skipped';
        
        return true;
      } catch (e) {
        console.error('LocalStorage error:', e);
        return false;
      }
    }

    function hasAnyDocument() {
      try {
        const data = getLocalStorage();
        const docs = data.documents || {};
        return !!(docs.passport || docs.european_id || docs.license);
      } catch (e) {
        return false;
      }
    }

    function restoreFromLocalStorage() {
      try {
        const data = getLocalStorage();
        const docs = data.documents || {};
        
        // Restore each document type
        Object.keys(DOC_CONFIG).forEach(type => {
          if (docs[type]) {
            const doc = docs[type];
            
            // Restore images to state
            if (doc.front) {
              documentState.documents[type].front = doc.front;
              documentState.documents[type].frontStatus = doc.frontStatus || 'skipped';
            }
            if (doc.back) {
              documentState.documents[type].back = doc.back;
              documentState.documents[type].backStatus = doc.backStatus || 'skipped';
            }
          }
        });
        
        updateCardStatuses();
      } catch (e) {
        console.error('Restore error:', e);
      }
    }

    // ============================================
    // Skip Verification
    // ============================================
    window.skipFrontVerification = function() {
      const type = documentState.currentType;
      stopDocumentPolling(type, 'front');
      
      if (type && documentState.documents[type].front) {
        const skipScore = 50;
        saveDocumentToLocalStorage(type, 'front', documentState.documents[type].front, 'skipped', skipScore);
        documentState.documents[type].frontStatus = 'skipped';
      }
      
      hideVerificationOverlay('front');
      showSuccessBadge('front', 'Photo enregistrée', null);
      showButtonsForSide('front', 'change');
      
      // UPDATE BUTTON STATE
      updateModalContinueButton();
      updateCardStatuses();
      
      console.log('⏩ Front verification skipped');
    };

    window.skipBackVerification = function() {
      const type = documentState.currentType;
      stopDocumentPolling(type, 'back');
      
      if (type && documentState.documents[type].back) {
        const skipScore = 50;
        saveDocumentToLocalStorage(type, 'back', documentState.documents[type].back, 'skipped', skipScore);
        documentState.documents[type].backStatus = 'skipped';
      }
      
      hideVerificationOverlay('back');
      showSuccessBadge('back', 'Photo enregistrée', null);
      showButtonsForSide('back', 'change');
      
      // UPDATE BUTTON STATE
      updateModalContinueButton();
      updateCardStatuses();
      
      console.log('⏩ Back verification skipped');
    };

    function displayImage(imageData, side) {
      console.log(`🖼️ Displaying image for ${side}`);
      
      const previewId = side === 'front' ? 'frontPreview' : 'backPreview';
      const placeholder = document.getElementById(`${side}Placeholder`);
      const preview = document.getElementById(previewId);
      const verificationOverlay = document.getElementById(`${side}VerificationOverlay`);
      
      // STOP CAMERA FIRST (important!)
      stopCamera(side);
      
      // FORCE HIDE verification overlay
      if (verificationOverlay) {
        verificationOverlay.classList.add('hidden');
        verificationOverlay.style.display = 'none';
      }
      
      // Hide placeholder
      if (placeholder) {
        placeholder.classList.add('hidden');
      }
      
      // Show image
      if (preview) {
        preview.innerHTML = `<img src="${imageData}" alt="${side}">`;
      }
      
      const type = documentState.currentType;
      if (type) {
        documentState.documents[type][side] = imageData;
        // SAVE TO LOCALSTORAGE IMMEDIATELY (like step10)
        saveDocumentToLocalStorage(type, side, imageData, 'pending', 0);
        
        // UPDATE BUTTON STATE
        updateModalContinueButton();
      }
      
      console.log(`✅ Image displayed for ${side}`);
    }

    // ============================================
    // Backend Communication - HYBRID MODE (localStorage first, API second)
    // ============================================
    async function sendDocumentToBackend(imageData, side) {
      const type = documentState.currentType;
      
      // STEP 1: SAVE TO LOCALSTORAGE IMMEDIATELY (like step10)
      saveDocumentToLocalStorage(type, side, imageData, 'pending');
      
      // STEP 2: Show verification overlay
      showVerificationOverlay(side, 'Envoi...');
      showButtonsForSide(side, 'skip');

      // STEP 3: Try API in background (optional)
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

        const response = await fetch(`${API_BASE_URL}/documents`, {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin',
          body: JSON.stringify({
            document_type: type,
            document_side: side,
            image: imageData
          })
        });

        const data = await response.json();

        if (response.ok && data.success) {
          const idKey = side === 'front' ? 'frontId' : 'backId';
          documentState.documents[type][idKey] = data.data.id;
          
          updateVerificationMessage(side, 'Vérification...');
          startDocumentPolling(data.data.id, type, side);
        } else {
          throw new Error(data.message || 'Échec');
        }

      } catch (error) {
        console.error('⚠️ API not available, falling back to localStorage-only mode:', error);
        
        // FALLBACK: Mark as accepted with lower score (like step10)
        const fallbackScore = 50;
        saveDocumentToLocalStorage(type, side, imageData, 'skipped', fallbackScore);
        
        hideVerificationOverlay(side);
        showSuccessBadge(side, 'Photo enregistrée', fallbackScore);
        showButtonsForSide(side, 'change');
        
        // UPDATE BUTTON STATE
        updateModalContinueButton();
        updateCardStatuses();
        
        console.log(`✅ Fallback mode activated for ${side}`);
      }
    }

    function startDocumentPolling(documentId, type, side) {
      const key = `${type}_${side}`;
      
      if (documentState.pollingIntervals[key]) {
        clearInterval(documentState.pollingIntervals[key]);
      }

      documentState.pollingIntervals[key] = setInterval(async () => {
        try {
          const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
          
          const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          };

          if (IS_AUTHENTICATED && API_TOKEN) {
            headers['Authorization'] = `Bearer ${API_TOKEN}`;
          }

          const response = await fetch(`${API_BASE_URL}/documents/${documentId}/status`, {
            method: 'GET',
            headers: headers,
            credentials: 'same-origin'
          });

          const data = await response.json();

          if (data.success) {
            handleDocumentStatus(data, type, side, documentId);
          }

        } catch (error) {
          console.error('Polling error:', error);
        }
      }, 2000);
    }

    function stopDocumentPolling(type, side) {
      const key = `${type}_${side}`;
      if (documentState.pollingIntervals[key]) {
        clearInterval(documentState.pollingIntervals[key]);
        delete documentState.pollingIntervals[key];
      }
    }

    function handleDocumentStatus(data, type, side, documentId) {
      const { status, message, confidence_score, rejection_reason } = data;
      
      const statusKey = side === 'front' ? 'frontStatus' : 'backStatus';
      documentState.documents[type][statusKey] = status;

      switch (status) {
        case 'verified':
          stopDocumentPolling(type, side);
          hideVerificationOverlay(side);
          
          // SAVE TO LOCALSTORAGE with verified status (like step10)
          const imageData = documentState.documents[type][side];
          if (imageData) {
            saveDocumentToLocalStorage(type, side, imageData, 'verified', confidence_score || 75);
          }
          
          showSuccessBadge(side, message, confidence_score);
          showButtonsForSide(side, 'change');
          updateModalContinueButton();
          updateCardStatuses();
          break;

        case 'rejected':
          stopDocumentPolling(type, side);
          hideVerificationOverlay(side);
          showRejectionBadge(side, rejection_reason);
          showButtonsForSide(side, 'change');
          updateCardStatuses();
          break;

        case 'error':
          stopDocumentPolling(type, side);
          hideVerificationOverlay(side);
          showErrorBadge(side, message);
          showButtonsForSide(side, 'change');
          updateCardStatuses();
          break;

        case 'processing':
          updateVerificationMessage(side, '🔄 Analyse...');
          break;

        case 'pending':
        default:
          updateVerificationMessage(side, '⏳ Attente...');
          break;
      }
    }

    function showVerificationOverlay(side, message) {
      const overlayId = side === 'front' ? 'frontVerificationOverlay' : 'backVerificationOverlay';
      const messageId = side === 'front' ? 'frontVerificationMessage' : 'backVerificationMessage';
      
      const overlay = document.getElementById(overlayId);
      const messageEl = document.getElementById(messageId);
      
      if (overlay) {
        overlay.classList.remove('hidden');
        overlay.style.display = ''; // Remove inline style
      }
      if (messageEl) messageEl.textContent = message;
    }

    function hideVerificationOverlay(side) {
      const overlayId = side === 'front' ? 'frontVerificationOverlay' : 'backVerificationOverlay';
      const overlay = document.getElementById(overlayId);
      if (overlay) {
        overlay.classList.add('hidden');
        overlay.style.display = 'none';
      }
    }

    function updateVerificationMessage(side, message) {
      const messageId = side === 'front' ? 'frontVerificationMessage' : 'backVerificationMessage';
      const messageEl = document.getElementById(messageId);
      if (messageEl) messageEl.textContent = message;
    }

    function showSuccessBadge(side, message, score) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      if (!badge) return;
      
      badge.className = 'bg-green-50 border-2 border-green-500 rounded-lg p-1.5 fade-in';
      badge.innerHTML = `
        <div class="flex items-center gap-1.5">
          <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-green-900 font-bold text-xs">✅ OK</p>
            ${score ? `<p class="text-green-600 text-xs">${score}/100</p>` : ''}
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function showRejectionBadge(side, reason) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      if (!badge) return;
      
      badge.className = 'bg-red-50 border-2 border-red-500 rounded-lg p-1.5 fade-in';
      badge.innerHTML = `
        <div class="flex items-start gap-1.5">
          <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-red-900 font-bold text-xs">❌ Refusé</p>
            <p class="text-red-700 text-xs">${reason || 'Réessayez'}</p>
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function showErrorBadge(side, message) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      if (!badge) return;
      
      badge.className = 'bg-orange-50 border-2 border-orange-500 rounded-lg p-1.5 fade-in';
      badge.innerHTML = `
        <div class="flex items-start gap-1.5">
          <div class="w-4 h-4 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-orange-900 font-bold text-xs">⚠️ Erreur</p>
            <p class="text-orange-700 text-xs">${message || 'Réessayez'}</p>
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function updateModalContinueButton() {
      const btn = document.getElementById('modalContinueBtn');
      if (!btn) return;
      
      const type = documentState.currentType;
      if (!type) {
        btn.disabled = true;
        return;
      }
      
      // CHECK LOCALSTORAGE (like step10) - not just memory state
      const data = getLocalStorage();
      const doc = (data.documents && data.documents[type]) || {};
      const config = DOC_CONFIG[type];

      let isComplete = false;

      if (config.needsBack) {
        // Need both front and back
        const hasFront = !!doc.front;
        const hasBack = !!doc.back;
        isComplete = hasFront && hasBack;
      } else {
        // Need only front
        isComplete = !!doc.front;
      }

      btn.disabled = !isComplete;
      
      console.log(`📋 Continue button ${isComplete ? 'ENABLED' : 'DISABLED'} for ${type}`);
    }

    function updateCardStatuses() {
      Object.keys(DOC_CONFIG).forEach(type => {
        updateCardStatus(type);
      });
    }

    function updateCardStatus(type) {
      const statusDiv = document.getElementById(`${type}Status`);
      if (!statusDiv) return;
      
      // CHECK LOCALSTORAGE (like step10)
      const data = getLocalStorage();
      const doc = (data.documents && data.documents[type]) || {};
      const config = DOC_CONFIG[type];

      let status = '📸';
      let className = 'text-gray-500';

      if (config.needsBack) {
        const frontDone = doc.front && (doc.frontStatus === 'verified' || doc.frontStatus === 'skipped' || doc.frontStatus === 'pending');
        const backDone = doc.back && (doc.backStatus === 'verified' || doc.backStatus === 'skipped' || doc.backStatus === 'pending');
        
        if (frontDone && backDone) {
          status = '✅';
          className = 'text-green-600';
        } else if (doc.front || doc.back) {
          status = '⏳';
          className = 'text-blue-600';
        }
      } else {
        if (doc.front && (doc.frontStatus === 'verified' || doc.frontStatus === 'skipped' || doc.frontStatus === 'pending')) {
          status = '✅';
          className = 'text-green-600';
        } else if (doc.front) {
          status = '⏳';
          className = 'text-blue-600';
        }
      }

      statusDiv.textContent = status;
      statusDiv.className = `text-sm font-semibold ${className}`;
    }

    function restoreDocumentPreviews(type) {
      console.log(`📦 Restoring previews for ${type}`);
      
      const doc = documentState.documents[type];
      
      // FORCE HIDE verification overlays initially
      const frontOverlay = document.getElementById('frontVerificationOverlay');
      const backOverlay = document.getElementById('backVerificationOverlay');
      if (frontOverlay) {
        frontOverlay.classList.add('hidden');
        frontOverlay.style.display = 'none';
      }
      if (backOverlay) {
        backOverlay.classList.add('hidden');
        backOverlay.style.display = 'none';
      }
      
      if (doc.front) {
        displayImage(doc.front, 'front');
        if (doc.frontStatus === 'verified' || doc.frontStatus === 'skipped') {
          showSuccessBadge('front', 'OK');
          showButtonsForSide('front', 'change');
        } else {
          showButtonsForSide('front', 'main');
        }
      } else {
        // Make sure placeholder is visible
        const frontPlaceholder = document.getElementById('frontPlaceholder');
        if (frontPlaceholder) frontPlaceholder.classList.remove('hidden');
        showButtonsForSide('front', 'main');
      }

      if (doc.back) {
        displayImage(doc.back, 'back');
        if (doc.backStatus === 'verified' || doc.backStatus === 'skipped') {
          showSuccessBadge('back', 'OK');
          showButtonsForSide('back', 'change');
        } else {
          showButtonsForSide('back', 'main');
        }
      } else {
        // Make sure placeholder is visible
        const backPlaceholder = document.getElementById('backPlaceholder');
        if (backPlaceholder) backPlaceholder.classList.remove('hidden');
        showButtonsForSide('back', 'main');
      }
      
      // UPDATE BUTTON STATE
      updateModalContinueButton();
      
      console.log('✅ Previews restored');
    }

    // ============================================
    // Validation
    // ============================================
    window.validateStep11 = function(showAlert) {
      // Check localStorage (like step10)
      const hasVerifiedDoc = hasAnyDocument();
      
      if (!hasVerifiedDoc && showAlert) {
        alert('Please upload at least one identity document to continue.');
      }

      return hasVerifiedDoc;
    };

    // ============================================
    // Cleanup
    // ============================================
    window.addEventListener('beforeunload', () => {
      Object.keys(documentState.pollingIntervals).forEach(key => {
        clearInterval(documentState.pollingIntervals[key]);
      });
      stopAllCameras();
    });

    // Initialize
    restoreFromLocalStorage();
    updateCardStatuses();
    
    if (documentState.lastSelectedType) {
      highlightCard(documentState.lastSelectedType);
    }
  })();
</script>