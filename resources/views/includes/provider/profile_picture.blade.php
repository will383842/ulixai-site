<!-- 
============================================
🚀 STEP 10 - PROFILE PICTURE (FIXED)
🔧 FIX: Added h-full class to main div
============================================
-->

<div id="step10" class="hidden flex flex-col h-full" role="region" aria-label="Add your profile picture">
  
  <div class="bg-white pt-2 pb-2 border-b border-gray-100">
    
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="text-center space-y-2 relative">
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <span class="text-lg sm:text-xl">📸</span>
        </div>
      </div>
      
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Add Your Profile Picture 👤
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Show your authentic self
        </p>
      </div>

      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          Required
        </span>
      </div>
    </div>
  </div>

  <div class="pt-2 space-y-2">

    <div id="step10CameraError" class="hidden bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-300 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <div class="text-3xl">📷</div>
        <div class="flex-1">
          <p class="text-sm font-bold text-purple-900 mb-1">Oops! Camera Shy? 😊</p>
          <p class="text-xs text-purple-700">We couldn't access your camera. No worries though! You can still upload a photo using the "Choose Photo" button below. Looking good is just a click away! ✨</p>
        </div>
      </div>
    </div>

    <div class="flex flex-col items-center">
      <div class="relative mb-2">
        <div class="w-32 h-32 sm:w-36 sm:h-36 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative shadow-xl">
          <img id="step10Preview" src="" alt="Profile Preview" class="hidden absolute inset-0 w-full h-full object-cover">
          <canvas id="step10Canvas" class="hidden absolute inset-0 w-full h-full object-cover"></canvas>
          <div id="step10Placeholder" class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-4xl mb-1">👤</span>
            <p class="text-blue-400 font-bold text-xs">No photo yet</p>
          </div>
        </div>
        <div class="absolute -bottom-1.5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-2.5 py-0.5 rounded-full text-xs font-bold shadow-lg">
          ✓ VERIFIED
        </div>
      </div>

      <div class="flex flex-row gap-2 mb-2 w-full px-4 sm:px-0">
        <label for="step10Upload" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-2 rounded-xl cursor-pointer font-bold text-xs shadow-lg flex items-center justify-center gap-1.5 transition-all hover:shadow-xl hover:scale-105 flex-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span>Choose Photo</span>
        </label>
        
        <button type="button" id="step10TakePhoto" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-bold text-xs shadow-lg flex items-center justify-center gap-1.5 transition-all hover:shadow-xl hover:scale-105 flex-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
          </svg>
          <span>Take Photo</span>
        </button>
      </div>

      <button 
        type="button"
        id="step10Retake" 
        class="hidden upload-btn bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-bold text-xs shadow-lg items-center justify-center gap-1.5 transition-all hover:shadow-xl hover:scale-105 mb-2"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        <span>Retake Photo</span>
      </button>

      <input type="file" id="step10Upload" name="profile_picture" accept="image/*" class="hidden">

      <div id="step10Camera" class="hidden w-full flex flex-col items-center">
        <video id="step10Video" autoplay playsinline class="w-32 h-32 sm:w-36 sm:h-36 rounded-full border-4 border-green-400 mb-2 shadow-xl object-cover"></video>
        <div class="flex gap-2">
          <button type="button" id="step10Capture" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-2 rounded-xl font-bold text-xs shadow-lg hover:shadow-xl transition-all">
            📸 Capture
          </button>
          <button type="button" id="step10CancelCamera" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-xl font-bold text-xs shadow-lg hover:shadow-xl transition-all">
            ✕ Cancel
          </button>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-r from-red-50 to-orange-50 border-2 border-red-300 rounded-xl p-2">
      <div class="flex items-start gap-2">
        <div class="w-7 h-7 bg-red-500 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
          <span class="text-sm">⚠️</span>
        </div>
        <div class="flex-1">
          <h3 class="text-red-900 font-bold text-xs mb-1">⚠️ Photo Required</h3>
          <ul class="text-red-800 text-xs space-y-0.5">
            <li class="flex items-center"><span class="mr-1.5">✓</span> Clear face visible</li>
            <li class="flex items-center"><span class="mr-1.5">✓</span> Good lighting</li>
            <li class="flex items-center"><span class="mr-1.5">✓</span> Professional appearance</li>
            <li class="flex items-center"><span class="mr-1.5">✓</span> No filters or edits</li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>

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

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-8px); }
  75% { transform: translateX(8px); }
}

.shake-animation {
  animation: shake 0.5s ease-in-out;
}

.upload-btn {
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
}

.upload-btn:active {
  transform: scale(0.98);
}

#step10Video,
#step10Canvas {
  image-rendering: -webkit-optimize-contrast;
  image-rendering: crisp-edges;
}
</style>

<script>
(function() {
  'use strict';

  const STORAGE_KEY = 'expats';
  
  const state = {
    hasPhoto: false,
    cameraStream: null
  };

  let cachedElements = null;

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

  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      console.warn('localStorage error:', e.message);
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

  async function openCamera() {
    const elements = getCachedElements();
    
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      alert('Your browser does not support camera access. Please use Chrome, Firefox, Safari, or Edge.');
      return;
    }
    
    hideCameraError();
    
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ 
        video: { facingMode: 'user' },
        audio: false 
      });
      
      state.cameraStream = stream;
      elements.video.srcObject = stream;
      elements.cameraView.classList.remove('hidden');
      
    } catch (error) {
      console.error('Camera error:', error.name, error.message);
      showCameraError();
      alert('Camera Error: ' + error.name + ' - ' + error.message);
    }
  }

  function closeCamera() {
    const elements = getCachedElements();
    
    if (state.cameraStream) {
      state.cameraStream.getTracks().forEach(track => {
        track.stop();
      });
      state.cameraStream = null;
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
      return;
    }
    
    if (!elements.video.videoWidth || !elements.video.videoHeight) {
      alert('Please wait for the camera to fully load');
      return;
    }
    
    requestAnimationFrame(() => {
      const ctx = elements.canvas.getContext('2d', { alpha: false });
      elements.canvas.width = elements.video.videoWidth;
      elements.canvas.height = elements.video.videoHeight;
      ctx.drawImage(elements.video, 0, 0);
      
      const imageData = elements.canvas.toDataURL('image/jpeg', 0.92);
      
      elements.canvas.classList.remove('hidden');
      elements.preview.classList.add('hidden');
      elements.placeholder.classList.add('hidden');
      elements.retakeBtn.classList.remove('hidden');
      elements.retakeBtn.classList.add('flex');
      
      savePhotoToLocalStorage(imageData);
      
      closeCamera();
    });
  }

  function handleFileUpload(file) {
    const elements = getCachedElements();
    
    if (!file.type.startsWith('image/')) {
      return;
    }
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
      requestAnimationFrame(() => {
        const imageData = e.target.result;
        
        elements.preview.src = imageData;
        elements.preview.classList.remove('hidden');
        elements.canvas.classList.add('hidden');
        elements.placeholder.classList.add('hidden');
        elements.retakeBtn.classList.remove('hidden');
        elements.retakeBtn.classList.add('flex');
        
        savePhotoToLocalStorage(imageData);
      });
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
          img.src = imageData;
        }
      } else {
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      }
    } catch (e) {
      console.warn('Could not restore photo:', e);
      
      if (typeof window.updateNavigationButtons === 'function') {
        window.updateNavigationButtons();
      }
    }
  }

  window.validateStep10 = function() {
    const elements = getCachedElements();
    
    if (!state.hasPhoto) {
      if (elements.cameraError) {
        elements.cameraError.classList.remove('hidden');
        const errorText = elements.cameraError.querySelector('p.text-xs');
        if (errorText) {
          errorText.textContent = 'Please upload or take a profile picture to continue';
        }
        
        requestAnimationFrame(() => {
          elements.cameraError.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'nearest' 
          });
        });
        
        setTimeout(() => {
          if (elements.cameraError) {
            elements.cameraError.classList.add('hidden');
          }
        }, 5000);
      }
      
      return false;
    }
    
    return true;
  };

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

  function restoreState() {
    restorePhoto();
  }

  function cleanup() {
    closeCamera();
    hideCameraError();
  }

  function init() {
    const elements = getCachedElements();
    
    if (elements.step) {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
            if (!elements.step.classList.contains('hidden')) {
              restoreState();
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
    restoreState();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>