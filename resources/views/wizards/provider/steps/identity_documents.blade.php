<div id="step11" class="hidden flex flex-col h-full" role="region" aria-label="Identity Verification">
  
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
          <span class="text-xl sm:text-2xl">🪪</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Identity Verification 🔐
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Choose one type of ID and upload clear photos
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          At least 1 document required
        </span>
      </div>
    </div>
  </div>

  <!-- SCROLLABLE CONTENT -->
  <div class="flex-1 overflow-y-auto pt-4 space-y-4 px-4">

    <!-- Document Type Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <!-- Passport Card -->
      <div class="doc-card bg-white rounded-xl p-6 border-2 border-gray-200 shadow-sm" onclick="openDocumentModal('passport')">
        <div class="text-center">
          <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mb-4">
            <span class="text-3xl">🛂</span>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Passport</h3>
          <p class="text-sm text-gray-600 mb-3">1 photo needed</p>
          <div id="passportStatus" class="text-sm font-semibold text-gray-400">Not uploaded</div>
        </div>
      </div>

      <!-- European ID Card -->
      <div class="doc-card bg-white rounded-xl p-6 border-2 border-gray-200 shadow-sm" onclick="openDocumentModal('european_id')">
        <div class="text-center">
          <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-4">
            <span class="text-3xl">🪪</span>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">European ID</h3>
          <p class="text-sm text-gray-600 mb-3">Front + Back</p>
          <div id="european_idStatus" class="text-sm font-semibold text-gray-400">Not uploaded</div>
        </div>
      </div>

      <!-- Driver's License Card -->
      <div class="doc-card bg-white rounded-xl p-6 border-2 border-gray-200 shadow-sm" onclick="openDocumentModal('license')">
        <div class="text-center">
          <div class="w-16 h-16 mx-auto bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mb-4">
            <span class="text-3xl">🚗</span>
          </div>
          <h3 class="text-lg font-bold text-gray-900 mb-2">Driver's License</h3>
          <p class="text-sm text-gray-600 mb-3">Front + Back</p>
          <div id="licenseStatus" class="text-sm font-semibold text-gray-400">Not uploaded</div>
        </div>
      </div>
    </div>

    <!-- Info Box -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-3 border-amber-300 rounded-xl p-5 sm:p-6 shadow-lg">
      <div class="flex items-start gap-3">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0">
          <span class="text-2xl">💡</span>
        </div>
        <div>
          <h3 class="text-amber-900 font-black text-lg sm:text-xl mb-2">Important Tips</h3>
          <ul class="text-amber-800 font-semibold space-y-1.5 text-sm sm:text-base">
            <li>✓ All text must be clearly readable</li>
            <li>✓ Take photos in good lighting</li>
            <li>✓ Avoid shadows, glare and blur</li>
            <li>✓ Show the full document in frame</li>
            <li>✓ Documents will be verified automatically</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- NAVIGATION -->
  <div class="wizard-nav-container px-4">
    <button id="backToStep10" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="continueBtn" type="button" class="nav-btn-next" disabled>
      Next
    </button>
  </div>

  <!-- Document Upload Modal -->
  <div id="documentModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="modal-overlay flex items-center justify-center min-h-screen p-4">
      <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6 rounded-t-2xl z-10">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <span id="modalIcon" class="text-4xl">🛂</span>
              <div>
                <h3 id="modalTitle" class="text-xl font-bold">Upload Passport</h3>
                <p id="modalSubtitle" class="text-sm text-blue-100">Front side only</p>
              </div>
            </div>
            <button onclick="closeDocumentModal()" class="text-white hover:text-gray-200 transition">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-6">
          
          <!-- Error message inline (file type or size) -->
          <div id="fileErrorMessage" class="hidden bg-red-50 border-2 border-red-500 rounded-lg p-3 fade-in">
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
              </svg>
              <div>
                <p id="fileErrorTitle" class="text-sm font-bold text-red-800"></p>
                <p id="fileErrorDetails" class="text-xs text-red-600 mt-1"></p>
              </div>
            </div>
          </div>

          <!-- Camera error message inline -->
          <div id="cameraErrorMessage" class="hidden bg-orange-50 border-2 border-orange-500 rounded-lg p-3 fade-in">
            <div class="flex items-start gap-2">
              <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              <div>
                <p class="text-sm font-bold text-orange-800">Camera not accessible</p>
                <p class="text-xs text-orange-600 mt-1">Please use the "Choose Photo" button to upload from your device instead.</p>
              </div>
            </div>
          </div>

          <!-- Front Side -->
          <div id="frontSection">
            <h4 class="text-lg font-bold text-gray-900 mb-3">
              <span id="frontLabel">Front Side</span>
            </h4>
            
            <div id="frontPreview" class="preview-box mb-4">
              <div class="text-center p-8">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 font-semibold mb-4">No photo yet</p>
              </div>

              <!-- Verification Overlay -->
              <div id="frontVerificationOverlay" class="upload-overlay hidden">
                <div class="spinner mb-3"></div>
                <p id="frontVerificationMessage" class="text-gray-700 font-semibold">Verifying...</p>
              </div>
            </div>

            <!-- Front Status Badge -->
            <div id="frontStatusBadge" class="hidden mb-4"></div>

            <!-- Front Upload Buttons -->
            <div id="frontUploadButtons" class="flex gap-3">
              <input type="file" id="frontFileInput" accept="image/*" class="hidden" onchange="handleFrontUpload(event)">
              <button onclick="document.getElementById('frontFileInput').click()" 
                      class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold">
                📁 Choose Photo
              </button>
              <button onclick="takeFrontPhoto()" 
                      class="flex-1 px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg hover:from-emerald-600 hover:to-teal-600 transition font-semibold">
                📸 Take Photo
              </button>
            </div>
          </div>

          <!-- Back Side (hidden for passport) -->
          <div id="backSection" class="hidden">
            <h4 class="text-lg font-bold text-gray-900 mb-3">Back Side</h4>
            
            <div id="backPreview" class="preview-box mb-4">
              <div class="text-center p-8">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-500 font-semibold mb-4">No photo yet</p>
              </div>

              <!-- Verification Overlay -->
              <div id="backVerificationOverlay" class="upload-overlay hidden">
                <div class="spinner mb-3"></div>
                <p id="backVerificationMessage" class="text-gray-700 font-semibold">Verifying...</p>
              </div>
            </div>

            <!-- Back Status Badge -->
            <div id="backStatusBadge" class="hidden mb-4"></div>

            <!-- Back Upload Buttons -->
            <div id="backUploadButtons" class="flex gap-3">
              <input type="file" id="backFileInput" accept="image/*" class="hidden" onchange="handleBackUpload(event)">
              <button onclick="document.getElementById('backFileInput').click()" 
                      class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold">
                📁 Choose Photo
              </button>
              <button onclick="takeBackPhoto()" 
                      class="flex-1 px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg hover:from-emerald-600 hover:to-teal-600 transition font-semibold">
                📸 Take Photo
              </button>
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-gray-50 p-6 rounded-b-2xl border-t">
          <div class="flex gap-3">
            <button onclick="closeDocumentModal()" 
                    class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
              Cancel
            </button>
            <button id="modalContinueBtn" onclick="closeDocumentModal()" disabled
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-lg hover:from-green-700 hover:to-emerald-700 transition font-semibold disabled:opacity-50 disabled:cursor-not-allowed">
              ✓ Continue
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Camera Modal -->
  <div id="cameraModal" class="hidden fixed inset-0 z-[60] bg-black bg-opacity-90 flex items-center justify-center">
    <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4">
      <div class="text-center mb-4">
        <h3 class="text-xl font-bold text-gray-900" id="cameraTitle">Take Photo</h3>
      </div>
      <video id="cameraStream" autoplay playsinline class="w-full rounded-lg mb-4"></video>
      <div class="flex gap-3 justify-center">
        <button onclick="captureDocument()"
                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:from-blue-700 hover:to-cyan-700 transition font-semibold">
          📸 Capture
        </button>
        <button onclick="closeCameraModal()"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
          Cancel
        </button>
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

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid #e5e7eb;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.border-3 {
  border-width: 3px;
}

.doc-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.doc-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.doc-card.selected {
  border-color: #3b82f6;
  background-color: #eff6ff;
}

.modal-overlay {
  backdrop-filter: blur(4px);
}

.preview-box {
  min-height: 200px;
  border: 3px dashed #d1d5db;
  border-radius: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  background: #f9fafb;
}

.preview-box img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
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

/* Responsive adjustments */
@media (max-width: 639px) {
  #step11 .sticky {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }
  
  #step11 h2 {
    font-size: 1.375rem;
    line-height: 1.3;
  }
  
  #step11 p {
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
  #step11 .doc-card {
    border: 3px solid currentColor;
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
      currentSide: null,
      cameraStream: null,
      documents: {
        passport: { front: null, frontId: null, frontStatus: null },
        european_id: { front: null, back: null, frontId: null, backId: null, frontStatus: null, backStatus: null },
        license: { front: null, back: null, frontId: null, backId: null, frontStatus: null, backStatus: null }
      },
      pollingIntervals: {}
    };

    const DOC_CONFIG = {
      passport: {
        icon: '🛂',
        title: 'Upload Passport',
        subtitle: 'Front side only',
        needsBack: false,
        frontLabel: 'Passport Photo'
      },
      european_id: {
        icon: '🪪',
        title: 'Upload European ID',
        subtitle: 'Front and back required',
        needsBack: true,
        frontLabel: 'Front Side'
      },
      license: {
        icon: '🚗',
        title: 'Upload Driver\'s License',
        subtitle: 'Front and back required',
        needsBack: true,
        frontLabel: 'Front Side'
      }
    };

    // ============================================
    // Error Display - SILENT (NO ALERTS)
    // ============================================
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

    function showCameraError() {
      const errorDiv = document.getElementById('cameraErrorMessage');
      if (errorDiv) {
        errorDiv.classList.remove('hidden');
        setTimeout(() => {
          errorDiv.classList.add('hidden');
        }, 5000);
      }
    }

    function hideAllErrors() {
      const fileError = document.getElementById('fileErrorMessage');
      const cameraError = document.getElementById('cameraErrorMessage');
      
      if (fileError) fileError.classList.add('hidden');
      if (cameraError) cameraError.classList.add('hidden');
    }

    // ============================================
    // Modal Management
    // ============================================
    window.openDocumentModal = function(type) {
      documentState.currentType = type;
      const config = DOC_CONFIG[type];

      hideAllErrors();

      document.getElementById('modalIcon').textContent = config.icon;
      document.getElementById('modalTitle').textContent = config.title;
      document.getElementById('modalSubtitle').textContent = config.subtitle;
      document.getElementById('frontLabel').textContent = config.frontLabel;

      const backSection = document.getElementById('backSection');
      if (config.needsBack) {
        backSection.classList.remove('hidden');
      } else {
        backSection.classList.add('hidden');
      }

      restoreDocumentPreviews(type);
      document.getElementById('documentModal').classList.remove('hidden');
      updateModalContinueButton();
    };

    window.closeDocumentModal = function() {
      document.getElementById('documentModal').classList.add('hidden');
      documentState.currentType = null;
      hideAllErrors();
      updateCardStatuses();
      updateMainContinueButton();
    };

    // ============================================
    // File Upload - SILENT VALIDATION
    // ============================================
    window.handleFrontUpload = function(event) {
      const file = event.target.files[0];
      if (file) processImageFile(file, 'front');
    };

    window.handleBackUpload = function(event) {
      const file = event.target.files[0];
      if (file) processImageFile(file, 'back');
    };

    function processImageFile(file, side) {
      hideAllErrors();

      if (!file.type.startsWith('image/')) {
        showFileError('Invalid file type', 'Please select an image file (JPG, PNG, etc.)');
        return;
      }

      if (file.size > 5 * 1024 * 1024) {
        showFileError('File too large', 'Image size must be less than 5 MB. Please choose a smaller file.');
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
    // Camera - SILENT ERROR HANDLING
    // ============================================
    window.takeFrontPhoto = async function() {
      documentState.currentSide = 'front';
      await openCameraModal();
    };

    window.takeBackPhoto = async function() {
      documentState.currentSide = 'back';
      await openCameraModal();
    };

    async function openCameraModal() {
      hideAllErrors();

      try {
        const stream = await navigator.mediaDevices.getUserMedia({
          video: { facingMode: 'environment' },
          audio: false
        });

        documentState.cameraStream = stream;
        document.getElementById('cameraStream').srcObject = stream;
        document.getElementById('cameraModal').classList.remove('hidden');
      } catch (error) {
        console.error('Camera error:', error);
        showCameraError();
      }
    }

    window.closeCameraModal = function() {
      if (documentState.cameraStream) {
        documentState.cameraStream.getTracks().forEach(track => track.stop());
        documentState.cameraStream = null;
      }
      document.getElementById('cameraStream').srcObject = null;
      document.getElementById('cameraModal').classList.add('hidden');
    };

    window.captureDocument = function() {
      const video = document.getElementById('cameraStream');
      const canvas = document.createElement('canvas');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      
      const ctx = canvas.getContext('2d');
      ctx.drawImage(video, 0, 0);
      
      const imageData = canvas.toDataURL('image/jpeg', 0.9);
      
      displayImage(imageData, documentState.currentSide);
      sendDocumentToBackend(imageData, documentState.currentSide);
      
      closeCameraModal();
    };

    function displayImage(imageData, side) {
      const previewId = side === 'front' ? 'frontPreview' : 'backPreview';
      const preview = document.getElementById(previewId);
      
      preview.innerHTML = `<img src="${imageData}" alt="${side} preview">`;
      
      const type = documentState.currentType;
      documentState.documents[type][side] = imageData;
    }

    // ============================================
    // Backend Communication
    // ============================================
    async function sendDocumentToBackend(imageData, side) {
      const type = documentState.currentType;
      showVerificationOverlay(side, 'Uploading...');

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
          
          updateVerificationMessage(side, 'Verifying document...');
          startDocumentPolling(data.data.id, type, side);
        } else {
          throw new Error(data.message || 'Upload failed');
        }

      } catch (error) {
        console.error('Upload error:', error);
        hideVerificationOverlay(side);
        showErrorBadge(side, 'Upload failed. Please try again.');
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
          showSuccessBadge(side, message, confidence_score);
          updateModalContinueButton();
          break;

        case 'rejected':
          stopDocumentPolling(type, side);
          hideVerificationOverlay(side);
          showRejectionBadge(side, rejection_reason);
          break;

        case 'error':
          stopDocumentPolling(type, side);
          hideVerificationOverlay(side);
          showErrorBadge(side, message);
          break;

        case 'processing':
          updateVerificationMessage(side, '🔄 Analyzing document...');
          break;

        case 'pending':
        default:
          updateVerificationMessage(side, '⏳ Queued for verification...');
          break;
      }
    }

    function showVerificationOverlay(side, message) {
      const overlayId = side === 'front' ? 'frontVerificationOverlay' : 'backVerificationOverlay';
      const messageId = side === 'front' ? 'frontVerificationMessage' : 'backVerificationMessage';
      
      document.getElementById(overlayId).classList.remove('hidden');
      document.getElementById(messageId).textContent = message;
    }

    function hideVerificationOverlay(side) {
      const overlayId = side === 'front' ? 'frontVerificationOverlay' : 'backVerificationOverlay';
      document.getElementById(overlayId).classList.add('hidden');
    }

    function updateVerificationMessage(side, message) {
      const messageId = side === 'front' ? 'frontVerificationMessage' : 'backVerificationMessage';
      document.getElementById(messageId).textContent = message;
    }

    function showSuccessBadge(side, message, score) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      badge.className = 'bg-green-50 border-2 border-green-500 rounded-lg p-4 fade-in';
      badge.innerHTML = `
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-green-900 font-bold">✅ Verified</p>
            <p class="text-green-700 text-sm">${message || 'Document verified successfully'}</p>
            ${score ? `<p class="text-green-600 text-xs mt-1">Confidence: ${score}/100</p>` : ''}
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function showRejectionBadge(side, reason) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      badge.className = 'bg-red-50 border-2 border-red-500 rounded-lg p-4 fade-in';
      badge.innerHTML = `
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-red-900 font-bold">❌ Not Accepted</p>
            <p class="text-red-700 text-sm whitespace-pre-line">${reason || 'Please retake the photo'}</p>
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function showErrorBadge(side, message) {
      const badgeId = side === 'front' ? 'frontStatusBadge' : 'backStatusBadge';
      const badge = document.getElementById(badgeId);
      
      badge.className = 'bg-orange-50 border-2 border-orange-500 rounded-lg p-4 fade-in';
      badge.innerHTML = `
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
          </div>
          <div class="flex-1">
            <p class="text-orange-900 font-bold">⚠️ Error</p>
            <p class="text-orange-700 text-sm">${message || 'Please try again'}</p>
          </div>
        </div>
      `;
      badge.classList.remove('hidden');
    }

    function updateModalContinueButton() {
      const btn = document.getElementById('modalContinueBtn');
      const type = documentState.currentType;
      const config = DOC_CONFIG[type];
      const doc = documentState.documents[type];

      let isComplete = false;

      if (config.needsBack) {
        isComplete = doc.frontStatus === 'verified' && doc.backStatus === 'verified';
      } else {
        isComplete = doc.frontStatus === 'verified';
      }

      btn.disabled = !isComplete;
    }

    function updateCardStatuses() {
      Object.keys(DOC_CONFIG).forEach(type => {
        updateCardStatus(type);
      });
    }

    function updateCardStatus(type) {
      const statusDiv = document.getElementById(`${type}Status`);
      const doc = documentState.documents[type];
      const config = DOC_CONFIG[type];

      let status = 'Not uploaded';
      let className = 'text-gray-400';

      if (config.needsBack) {
        if (doc.frontStatus === 'verified' && doc.backStatus === 'verified') {
          status = '✅ Verified';
          className = 'text-green-600';
        } else if (doc.frontStatus || doc.backStatus) {
          const parts = [];
          if (doc.frontStatus === 'verified') parts.push('Front ✓');
          if (doc.backStatus === 'verified') parts.push('Back ✓');
          if (parts.length > 0) {
            status = parts.join(', ');
            className = 'text-blue-600';
          } else {
            status = 'In progress...';
            className = 'text-blue-600';
          }
        }
      } else {
        if (doc.frontStatus === 'verified') {
          status = '✅ Verified';
          className = 'text-green-600';
        } else if (doc.frontStatus) {
          status = 'In progress...';
          className = 'text-blue-600';
        }
      }

      statusDiv.textContent = status;
      statusDiv.className = `text-sm font-semibold ${className}`;
    }

    function updateMainContinueButton() {
      const btn = document.getElementById('continueBtn');
      
      const hasVerifiedDoc = Object.keys(DOC_CONFIG).some(type => {
        const doc = documentState.documents[type];
        const config = DOC_CONFIG[type];
        
        if (config.needsBack) {
          return doc.frontStatus === 'verified' && doc.backStatus === 'verified';
        } else {
          return doc.frontStatus === 'verified';
        }
      });

      btn.disabled = !hasVerifiedDoc;
    }

    function restoreDocumentPreviews(type) {
      const doc = documentState.documents[type];
      
      if (doc.front) {
        displayImage(doc.front, 'front');
        if (doc.frontStatus === 'verified') {
          showSuccessBadge('front', 'Document verified');
        }
      }

      if (doc.back) {
        displayImage(doc.back, 'back');
        if (doc.backStatus === 'verified') {
          showSuccessBadge('back', 'Document verified');
        }
      }
    }

    // ============================================
    // Validation - NO ALERTS
    // ============================================
    window.validateStep11 = function(showAlert) {
      const hasVerifiedDoc = Object.keys(DOC_CONFIG).some(type => {
        const doc = documentState.documents[type];
        const config = DOC_CONFIG[type];
        
        if (config.needsBack) {
          return doc.frontStatus === 'verified' && doc.backStatus === 'verified';
        } else {
          return doc.frontStatus === 'verified';
        }
      });

      return hasVerifiedDoc;
    };

    window.addEventListener('beforeunload', () => {
      Object.keys(documentState.pollingIntervals).forEach(key => {
        clearInterval(documentState.pollingIntervals[key]);
      });
      closeCameraModal();
    });

    updateCardStatuses();
    updateMainContinueButton();
  })();
</script>