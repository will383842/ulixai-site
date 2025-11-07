<!-- 
============================================
🚀 STEP 10 - PROFILE PICTURE (SELFIE) - FIXED
============================================
✨ Blue/Cyan/Teal Design System STRICT
📸 Selfie only with clear requirements
💰 Payment verification essential
⚡ Easy camera mechanism
✅ localStorage persistence
🔧 FIXED: Validation doesn't show alert on page load
============================================
-->

<div id="step10" class="hidden flex flex-col h-full" role="region" aria-label="Add your profile picture">
  
  <!-- ============================================
       FIXED HEADER (STICKY)
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
       SCROLLABLE CONTENT
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Camera Error Alert -->
    <div id="step10CameraError" class="hidden bg-gradient-to-r from-orange-50 to-red-50 border-2 border-orange-400 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <div class="text-2xl flex-shrink-0">📷</div>
        <div class="flex-1">
          <p class="text-sm font-bold text-orange-900 mb-1">Camera Not Available 😊</p>
          <p class="text-xs text-orange-800">No worries! You can upload a selfie using the "Choose Photo" button below. Make sure it's a clear selfie of just you! ✨</p>
        </div>
      </div>
    </div>

    <!-- Payment Verification Notice -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-400 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
          <span class="text-xl">💰</span>
        </div>
        <div class="flex-1">
          <p class="text-sm font-bold text-amber-900 mb-1">Why we need your selfie</p>
          <p class="text-xs text-amber-800">
            <strong class="font-bold">This photo is essential to receive payments!</strong> It will appear on your public profile and is used to verify your identity for secure transactions. Clients want to see who they're working with! 🤝
          </p>
        </div>
      </div>
    </div>

    <!-- Photo Preview Area -->
    <div class="flex flex-col items-center space-y-3">
      
      <!-- Preview Circle -->
      <div class="relative">
        <div class="w-40 h-40 sm:w-44 sm:h-44 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative shadow-2xl">
          <img id="step10Preview" src="" alt="Profile Preview" class="hidden absolute inset-0 w-full h-full object-cover">
          <canvas id="step10Canvas" class="hidden absolute inset-0 w-full h-full object-cover"></canvas>
          <div id="step10Placeholder" class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-5xl mb-2">🤳</span>
            <p class="text-blue-500 font-bold text-sm">No photo yet</p>
            <p class="text-blue-400 text-xs mt-1">Take or upload</p>
          </div>
        </div>
        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-xl ring-2 ring-white">
          <span class="flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            PUBLIC PROFILE
          </span>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-2 w-full px-4 sm:px-0">
        <button 
          type="button" 
          id="step10TakePhoto" 
          class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-5 py-3 rounded-xl cursor-pointer font-bold text-sm shadow-lg flex items-center justify-center gap-2 transition-all hover:shadow-xl hover:scale-105 flex-1 ring-2 ring-blue-200"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>Take Selfie</span>
        </button>
        
        <label for="step10Upload" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-5 py-3 rounded-xl cursor-pointer font-bold text-sm shadow-lg flex items-center justify-center gap-2 transition-all hover:shadow-xl hover:scale-105 flex-1 ring-2 ring-emerald-200">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span>Choose Photo</span>
        </label>
      </div>

      <!-- Retake Button (Hidden by default) -->
      <button 
        type="button"
        id="step10Retake" 
        class="hidden upload-btn bg-gradient-to-r from-orange-500 to-red-500 text-white px-5 py-3 rounded-xl font-bold text-sm shadow-lg items-center justify-center gap-2 transition-all hover:shadow-xl hover:scale-105 ring-2 ring-orange-200"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Retake Selfie</span>
      </button>

      <input type="file" id="step10Upload" name="profile_picture" accept="image/*" capture="user" class="hidden">

      <!-- Camera View (Hidden by default) -->
      <div id="step10Camera" class="hidden w-full flex flex-col items-center space-y-3 bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-2xl border-2 border-blue-300">
        <p class="text-sm font-bold text-blue-900 text-center">📸 Position yourself in the frame</p>
        <video id="step10Video" autoplay playsinline class="w-56 h-56 sm:w-64 sm:h-64 rounded-2xl border-4 border-green-400 shadow-2xl object-cover bg-black"></video>
        <div class="flex gap-3">
          <button type="button" id="step10Capture" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all ring-2 ring-green-200 flex items-center gap-2">
            <span class="text-lg">📸</span>
            <span>Capture</span>
          </button>
          <button type="button" id="step10CancelCamera" class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all ring-2 ring-gray-300 flex items-center gap-2">
            <span class="text-lg">✕</span>
            <span>Cancel</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Photo Requirements -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-2">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
          <span class="text-xl">✓</span>
        </div>
        <div class="flex-1">
          <h3 class="text-blue-900 font-bold text-sm mb-2">📋 Selfie Requirements:</h3>
          <ul class="text-blue-800 text-xs space-y-1.5">
            <li class="flex items-start gap-2">
              <span class="text-blue-600 flex-shrink-0 font-bold">✓</span>
              <span><strong class="font-bold">Clear face visible</strong> - your face should be clearly visible</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-blue-600 flex-shrink-0 font-bold">✓</span>
              <span><strong class="font-bold">Good lighting</strong> - natural light works best</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-blue-600 flex-shrink-0 font-bold">✓</span>
              <span><strong class="font-bold">You alone</strong> - only you should appear in the photo</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-blue-600 flex-shrink-0 font-bold">✓</span>
              <span><strong class="font-bold">Look professional</strong> - present yourself well</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-blue-600 flex-shrink-0 font-bold">✓</span>
              <span><strong class="font-bold">No filters</strong> - use your natural appearance</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>

</div>

<!-- ============================================
     OPTIMIZED STYLES
     ============================================ -->
<style>
/* ============================================
   🎨 BASE ANIMATIONS
   ============================================ */

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

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

/* ============================================
   🔘 BUTTONS
   ============================================ */

.upload-btn {
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
  contain: layout style paint;
  transform: translateZ(0);
  backface-visibility: hidden;
}

.upload-btn:active {
  transform: scale(0.98);
}

/* ============================================
   📸 VIDEO & CANVAS
   ============================================ */

#step10Video,
#step10Canvas,
#step10Preview {
  image-rendering: -webkit-optimize-contrast;
  image-rendering: crisp-edges;
}

#step10Video {
  transform: scaleX(-1); /* Mirror effect for selfie */
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  .upload-btn {
    border: 3px solid currentColor;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

#step10Video,
#step10Canvas,
#step10Preview {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}
</style>

<!-- ============================================
     OPTIMIZED JAVASCRIPT - FIXED VERSION
     ============================================ -->
<script>
(function() {
  'use strict';

  // ============================================
  // 🔧 CONSTANTS
  // ============================================
  
  const STORAGE_KEY = 'expats';
  
  // ============================================
  // 🔧 STATE MANAGEMENT
  // ============================================
  
  const state = {
    hasPhoto: false,
    cameraStream: null,
    isCameraActive: false
  };

  let cachedElements = null;

  // ============================================
  // 📦 CACHE DOM ELEMENTS
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step10'),
        preview: document.getElementById('step10Preview'),
        canvas: document.getElementById('step10Canvas'),
        placeholder: document.getElementById('step10Placeholder'),
        upload: document.getElementById('step10Upload'),
        takePhotoBtn: document.getElementById('step10TakePhoto'),
        retakeBtn: document.getElementById('step10Retake'),
        cameraView: document.getElementById('step10Camera'),
        video: document.getElementById('step10Video'),
        captureBtn: document.getElementById('step10Capture'),
        cancelBtn: document.getElementById('step10CancelCamera'),
        cameraError: document.getElementById('step10CameraError')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCAL STORAGE
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      console.warn('localStorage read error:', e.message);
      return {};
    }
  }

  function savePhotoToLocalStorage(imageData) {
    try {
      const data = getLocalStorage();
      data.profile_photo = {
        image: imageData,
        timestamp: new Date().toISOString()
      };
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      state.hasPhoto = true;
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    } catch (e) {
      console.warn('localStorage save error:', e.message);
      alert('Could not save photo. Please try again.');
    }
  }

  function removePhotoFromLocalStorage() {
    try {
      const data = getLocalStorage();
      delete data.profile_photo;
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      state.hasPhoto = false;
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    } catch (e) {
      console.warn('localStorage remove error:', e.message);
    }
  }

  // ============================================
  // 🎨 UI UPDATES
  // ============================================
  
  function showCameraError() {
    const elements = getCachedElements();
    
    if (elements.cameraError) {
      elements.cameraError.classList.remove('hidden');
      elements.cameraError.classList.add('shake-animation');
      
      requestAnimationFrame(() => {
        elements.cameraError.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'nearest' 
        });
      });
      
      setTimeout(() => {
        elements.cameraError.classList.remove('shake-animation');
      }, 500);

      setTimeout(() => {
        if (elements.cameraError) {
          elements.cameraError.classList.add('hidden');
        }
      }, 8000);
    }
  }

  function hideCameraError() {
    const elements = getCachedElements();
    if (elements.cameraError) {
      elements.cameraError.classList.add('hidden');
    }
  }

  // ============================================
  // 📸 CAMERA FUNCTIONS
  // ============================================
  
  async function openCamera() {
    const elements = getCachedElements();
    
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      showCameraError();
      return;
    }
    
    hideCameraError();
    
    try {
      const constraints = {
        video: { 
          facingMode: 'user',
          width: { ideal: 1280 },
          height: { ideal: 720 }
        },
        audio: false 
      };
      
      const stream = await navigator.mediaDevices.getUserMedia(constraints);
      
      state.cameraStream = stream;
      state.isCameraActive = true;
      
      requestAnimationFrame(() => {
        elements.video.srcObject = stream;
        elements.cameraView.classList.remove('hidden');
        
        elements.cameraView.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
      
    } catch (error) {
      console.error('Camera error:', error.name, error.message);
      state.isCameraActive = false;
      showCameraError();
      
      let errorMsg = 'Could not access camera. ';
      if (error.name === 'NotAllowedError') {
        errorMsg += 'Please allow camera access in your browser settings.';
      } else if (error.name === 'NotFoundError') {
        errorMsg += 'No camera found on your device.';
      } else {
        errorMsg += 'Please try uploading a photo instead.';
      }
      
      alert(errorMsg);
    }
  }

  function closeCamera() {
    const elements = getCachedElements();
    
    if (state.cameraStream) {
      state.cameraStream.getTracks().forEach(track => {
        track.stop();
      });
      state.cameraStream = null;
      state.isCameraActive = false;
    }
    
    if (elements.video) {
      elements.video.srcObject = null;
    }
    
    if (elements.cameraView) {
      elements.cameraView.classList.add('hidden');
    }
  }

  function capturePhoto() {
    const elements = getCachedElements();
    
    if (!elements.video || !elements.canvas) {
      alert('Camera not ready. Please try again.');
      return;
    }
    
    if (!elements.video.videoWidth || !elements.video.videoHeight) {
      alert('Please wait for the camera to fully load, then try again.');
      return;
    }
    
    requestAnimationFrame(() => {
      const ctx = elements.canvas.getContext('2d', { 
        alpha: false,
        willReadFrequently: false 
      });
      
      elements.canvas.width = elements.video.videoWidth;
      elements.canvas.height = elements.video.videoHeight;
      
      ctx.save();
      ctx.scale(-1, 1);
      ctx.drawImage(elements.video, -elements.canvas.width, 0);
      ctx.restore();
      
      const imageData = elements.canvas.toDataURL('image/jpeg', 0.92);
      
      elements.canvas.classList.remove('hidden');
      elements.preview.classList.add('hidden');
      elements.placeholder.classList.add('hidden');
      elements.retakeBtn.classList.remove('hidden');
      elements.retakeBtn.classList.add('flex');
      
      savePhotoToLocalStorage(imageData);
      
      closeCamera();
      
      requestAnimationFrame(() => {
        elements.canvas.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'center' 
        });
      });
    });
  }

  // ============================================
  // 📁 FILE UPLOAD
  // ============================================
  
  function handleFileUpload(file) {
    const elements = getCachedElements();
    
    if (!file.type.startsWith('image/')) {
      alert('Please select an image file (JPG, PNG, etc.)');
      return;
    }
    
    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
      alert('Image is too large. Please choose an image smaller than 5MB.');
      return;
    }
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
      const imageData = e.target.result;
      
      const img = new Image();
      img.onload = function() {
        requestAnimationFrame(() => {
          elements.preview.src = imageData;
          elements.preview.classList.remove('hidden');
          elements.canvas.classList.add('hidden');
          elements.placeholder.classList.add('hidden');
          elements.retakeBtn.classList.remove('hidden');
          elements.retakeBtn.classList.add('flex');
          
          savePhotoToLocalStorage(imageData);
          
          elements.preview.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
          });
        });
      };
      
      img.onerror = function() {
        alert('Could not load image. Please try a different photo.');
      };
      
      img.src = imageData;
    };
    
    reader.onerror = function() {
      alert('Could not read file. Please try again.');
    };
    
    reader.readAsDataURL(file);
    
    closeCamera();
  }

  function retakePhoto() {
    const elements = getCachedElements();
    
    requestAnimationFrame(() => {
      elements.preview.classList.add('hidden');
      elements.preview.src = '';
      elements.canvas.classList.add('hidden');
      elements.placeholder.classList.remove('hidden');
      elements.retakeBtn.classList.add('hidden');
      elements.retakeBtn.classList.remove('flex');
      
      if (elements.upload) {
        elements.upload.value = '';
      }

      removePhotoFromLocalStorage();
    });
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restorePhoto() {
    const elements = getCachedElements();
    
    try {
      const data = getLocalStorage();
      if (data.profile_photo && data.profile_photo.image) {
        const imageData = data.profile_photo.image;
        
        if (imageData.startsWith('data:image')) {
          const img = new Image();
          img.onload = function() {
            requestAnimationFrame(() => {
              const ctx = elements.canvas.getContext('2d');
              elements.canvas.width = img.width;
              elements.canvas.height = img.height;
              ctx.drawImage(img, 0, 0);
              elements.canvas.classList.remove('hidden');
              elements.preview.classList.add('hidden');
              elements.placeholder.classList.add('hidden');
              elements.retakeBtn.classList.remove('hidden');
              elements.retakeBtn.classList.add('flex');
              state.hasPhoto = true;
              
              if (typeof window.updateNavigationButtons === 'function') {
                window.updateNavigationButtons();
              }
            });
          };
          img.onerror = function() {
            console.warn('Could not load saved photo');
            state.hasPhoto = false;
          };
          img.src = imageData;
        }
      } else {
        state.hasPhoto = false;
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      }
    } catch (e) {
      console.warn('Could not restore photo:', e);
      state.hasPhoto = false;
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }
  }

  // ============================================
  // ✅ VALIDATION - FIXED
  // showAlert parameter: true = show alert, false = silent validation
  // ============================================
  
  window.validateStep10 = function(showAlert = false) {
    const hasPhoto = state.hasPhoto;
    
    // Show alert ONLY if showAlert is true (when user clicks Next)
    if (!hasPhoto && showAlert) {
      alert('⚠️ Selfie Required!\n\nPlease take or upload a selfie to continue.\n\nThis photo is essential for payment verification and will appear on your public profile.');
    }
    
    return hasPhoto;
  };

  // ============================================
  // 🎬 EVENT HANDLERS
  // ============================================
  
  function handleUploadChange(e) {
    const file = e.target.files[0];
    if (file) {
      handleFileUpload(file);
    }
  }

  function handleTakePhotoClick() {
    openCamera();
  }

  function handleCaptureClick() {
    capturePhoto();
  }

  function handleCancelClick() {
    closeCamera();
  }

  function handleRetakeClick() {
    retakePhoto();
  }

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const elements = getCachedElements();
    
    if (elements.upload) {
      elements.upload.addEventListener('change', handleUploadChange);
    }
    
    if (elements.takePhotoBtn) {
      elements.takePhotoBtn.addEventListener('click', handleTakePhotoClick);
    }
    
    if (elements.captureBtn) {
      elements.captureBtn.addEventListener('click', handleCaptureClick);
    }
    
    if (elements.cancelBtn) {
      elements.cancelBtn.addEventListener('click', handleCancelClick);
    }
    
    if (elements.retakeBtn) {
      elements.retakeBtn.addEventListener('click', handleRetakeClick);
    }
  }

  // ============================================
  // 🧹 CLEANUP
  // ============================================
  
  function cleanup() {
    closeCamera();
    hideCameraError();
  }

  // ============================================
  // 🎬 INITIALIZATION
  // ============================================
  
  function init() {
    const elements = getCachedElements();
    
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
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

    initEventDelegation();
    
    restorePhoto();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>