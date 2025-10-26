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
      0%, 100% { 
        transform: translateY(0px); 
      }
      50% { 
        transform: translateY(-10px); 
      }
    }
    
    @keyframes pulse-border {
      0%, 100% { 
        border-color: rgba(59, 130, 246, 0.5); 
      }
      50% { 
        border-color: rgba(59, 130, 246, 1); 
      }
    }
    
    @keyframes shimmer {
      0% { 
        background-position: -1000px 0; 
      }
      100% { 
        background-position: 1000px 0; 
      }
    }
    
    @keyframes gradient {
      0%, 100% { 
        background-position: 0% 50%; 
      }
      50% { 
        background-position: 100% 50%; 
      }
    }
    
    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
    }
    
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    .photo-preview {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    
    .photo-preview:hover {
      transform: scale(1.05) rotate(2deg);
    }
    
    .photo-preview img,
    .photo-preview canvas {
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

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .animate-spin {
      animation: spin 1s linear infinite;
    }
  </style>

  <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 hidden md:block">
    <div class="ambient-blob absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full"></div>
    <div class="ambient-blob absolute top-20 right-10 w-64 h-64 bg-cyan-300 rounded-full"></div>
    <div class="ambient-blob absolute bottom-10 left-1/2 w-64 h-64 bg-teal-300 rounded-full"></div>
  </div>

  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">📸</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Add Your Profile Picture
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Show your authentic self
    </p>
  </div>

  <div class="flex flex-col items-center mb-8">
    <div class="relative mb-6">
      <div class="w-48 h-48 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative photo-preview shadow-2xl">
        <img id="profilePreview" src="" alt="Profile Preview" class="hidden">
        <canvas id="photoCanvas" class="hidden"></canvas>
        <div id="profilePlaceholder" class="text-center absolute inset-0 flex flex-col items-center justify-center z-10">
          <div class="text-6xl mb-2 animate-float">👤</div>
          <p class="text-blue-400 font-bold text-sm">No photo yet</p>
        </div>
      </div>
      <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-1.5 rounded-full text-xs font-black shadow-xl z-20">
        ✓ VERIFIED
      </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 mb-4 w-full sm:w-auto px-4 sm:px-0">
      <label for="profileUpload" onclick="closeCamera()" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 sm:px-8 py-3.5 rounded-2xl cursor-pointer font-bold text-base shadow-lg flex items-center justify-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Choose Photo</span>
      </label>
      <button type="button" id="takePictureBtn" onclick="openCamera()" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 sm:px-8 py-3.5 rounded-2xl font-bold text-base shadow-lg flex items-center justify-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
        </svg>
        <span>Take Photo</span>
      </button>
    </div>

    <button 
      type="button"
      id="retakePhotoBtn" 
      onclick="retakeProfilePhoto()" 
      class="hidden upload-btn bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-base shadow-lg items-center space-x-2 mb-4"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      <span>Retake Photo</span>
    </button>

    <input type="file" id="profileUpload" name="profile_picture" accept="image/*" class="hidden">

    <div id="cameraSection" class="hidden mt-4 text-center w-full">
      <div class="flex flex-col items-center">
        <video id="videoStream" autoplay playsinline class="w-48 h-48 rounded-full border-4 border-green-400 mb-4 shadow-2xl video-stream-pulse object-cover"></video>
        <div class="flex gap-3">
          <button type="button" onclick="capturePhoto()" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-2xl font-bold shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
            📸 Capture
          </button>
          <button type="button" onclick="closeCamera()" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-3 rounded-2xl font-bold shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
            ✕ Cancel
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="mb-8 rounded-3xl bg-gradient-to-br from-amber-50 to-yellow-50 border-3 border-amber-300 p-6 shadow-lg">
    <div class="flex items-start mb-4">
      <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0 mr-4">
        <span class="text-2xl">✅</span>
      </div>
      <div>
        <h3 class="text-amber-900 font-black text-xl mb-2">Photo Requirements</h3>
        <ul class="text-amber-800 font-semibold space-y-2 text-sm">
          <li class="flex items-center"><span class="mr-2">✓</span> Clear face visible</li>
          <li class="flex items-center"><span class="mr-2">✓</span> Good lighting</li>
          <li class="flex items-center"><span class="mr-2">✓</span> Professional appearance</li>
          <li class="flex items-center"><span class="mr-2">✓</span> No filters or edits</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="wizard-nav-container">
    <button id="backToStep9" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep10" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>

  <script>
    (function() {
      'use strict';

      let currentStream = null;
      const profileUpload = document.getElementById('profileUpload');
      const profilePreview = document.getElementById('profilePreview');
      const profilePlaceholder = document.getElementById('profilePlaceholder');
      const photoCanvas = document.getElementById('photoCanvas');
      const cameraSection = document.getElementById('cameraSection');
      const videoStream = document.getElementById('videoStream');
      const retakeBtn = document.getElementById('retakePhotoBtn');

      function saveProfilePhoto(dataUrl) {
        try {
          let expats = JSON.parse(localStorage.getItem('expats')) || {};
          expats.profilePhoto = {
            image: dataUrl,
            uploaded_at: new Date().toISOString()
          };
          localStorage.setItem('expats', JSON.stringify(expats));
        } catch (e) {
          console.warn('Error saving photo:', e);
        }
      }

      if (profileUpload) {
        profileUpload.addEventListener('change', function(e) {
          const file = e.target.files[0];
          if (!file) return;

          const reader = new FileReader();
          reader.onload = function(event) {
            const dataUrl = event.target.result;
            profilePreview.src = dataUrl;
            profilePreview.classList.remove('hidden');
            photoCanvas.classList.add('hidden');
            profilePlaceholder.classList.add('hidden');
            retakeBtn.classList.remove('hidden');
            retakeBtn.classList.add('flex');
            
            saveProfilePhoto(dataUrl);
          };
          reader.readAsDataURL(file);
        });
      }

      window.openCamera = async function() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
          return;
        }

        try {
          const constraints = {
            video: {
              width: { ideal: 1280 },
              height: { ideal: 1280 }
            },
            audio: false
          };

          const stream = await navigator.mediaDevices.getUserMedia(constraints);
          
          currentStream = stream;
          videoStream.srcObject = stream;
          cameraSection.classList.remove('hidden');

        } catch (err) {
          cameraSection.classList.add('hidden');
        }
      };

      window.closeCamera = function() {
        if (currentStream) {
          currentStream.getTracks().forEach(function(track) {
            track.stop();
          });
          currentStream = null;
        }
        if (videoStream) {
          videoStream.srcObject = null;
        }
        if (cameraSection) {
          cameraSection.classList.add('hidden');
        }
      };

      window.capturePhoto = function() {
        if (!videoStream.videoWidth || !videoStream.videoHeight) {
          return;
        }
        
        const context = photoCanvas.getContext('2d');
        const video = videoStream;
        
        const size = Math.min(video.videoWidth, video.videoHeight);
        photoCanvas.width = size;
        photoCanvas.height = size;
        
        const startX = (video.videoWidth - size) / 2;
        const startY = (video.videoHeight - size) / 2;
        
        context.drawImage(video, startX, startY, size, size, 0, 0, size, size);

        const dataUrl = photoCanvas.toDataURL('image/jpeg', 0.9);

        photoCanvas.classList.remove('hidden');
        profilePreview.classList.add('hidden');
        profilePlaceholder.classList.add('hidden');
        retakeBtn.classList.remove('hidden');
        retakeBtn.classList.add('flex');

        window.closeCamera();

        saveProfilePhoto(dataUrl);
      };

      window.retakeProfilePhoto = function() {
        profilePreview.classList.add('hidden');
        profilePreview.src = '';
        photoCanvas.classList.add('hidden');
        profilePlaceholder.classList.remove('hidden');
        retakeBtn.classList.add('hidden');
        retakeBtn.classList.remove('flex');
        if (profileUpload) {
          profileUpload.value = '';
        }

        try {
          let expats = JSON.parse(localStorage.getItem('expats')) || {};
          delete expats.profilePhoto;
          localStorage.setItem('expats', JSON.stringify(expats));
        } catch (e) {
          console.warn('Error removing photo:', e);
        }
      };

      function restorePhoto() {
        try {
          const expats = JSON.parse(localStorage.getItem('expats')) || {};
          if (expats.profilePhoto && expats.profilePhoto.image) {
            const dataUrl = expats.profilePhoto.image;
            
            if (dataUrl.startsWith('data:image')) {
              const img = new Image();
              img.onload = function() {
                const context = photoCanvas.getContext('2d');
                photoCanvas.width = img.width;
                photoCanvas.height = img.height;
                context.drawImage(img, 0, 0);
                photoCanvas.classList.remove('hidden');
                profilePreview.classList.add('hidden');
                profilePlaceholder.classList.add('hidden');
                retakeBtn.classList.remove('hidden');
                retakeBtn.classList.add('flex');
              };
              img.src = dataUrl;
            }
          }
        } catch (e) {
          console.warn('Error restoring photo:', e);
        }
      }

      const step10Element = document.getElementById('step10');
      if (step10Element) {
        const step10Observer = new MutationObserver(function(mutations) {
          mutations.forEach(function(mutation) {
            if (mutation.target.id === 'step10') {
              if (!mutation.target.classList.contains('hidden')) {
                restorePhoto();
              } else {
                window.closeCamera();
              }
            }
          });
        });
        
        step10Observer.observe(step10Element, { 
          attributes: true, 
          attributeFilter: ['class'] 
        });
      }

      window.addEventListener('beforeunload', function() {
        window.closeCamera();
      });

      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', restorePhoto);
      } else {
        restorePhoto();
      }

      const nextBtn = document.getElementById('nextStep10');
      if (nextBtn) {
        nextBtn.disabled = false;
      }
    })();
  </script>
</div>