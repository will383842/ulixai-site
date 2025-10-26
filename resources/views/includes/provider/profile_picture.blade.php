<div id="step10" class="hidden">
  <style>
    @keyframes pulse-border {
      0%, 100% { border-color: rgba(59, 130, 246, 0.5); }
      50% { border-color: rgba(59, 130, 246, 1); }
    }
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
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
      transition: left 0.5s;
    }
    .upload-btn:hover::before {
      left: 100%;
    }
    .upload-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }
  </style>

  <!-- Header premium avec gradient -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">📸</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent">
        Add Your Profile Picture
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Show your authentic self
    </p>
  </div>

  <!-- Photo Preview Section -->
  <div class="flex flex-col items-center mb-8">
    <!-- Circle Preview avec effet premium -->
    <div class="relative mb-6">
      <div class="w-48 h-48 rounded-full border-4 border-blue-400 flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 to-cyan-50 relative photo-preview shadow-2xl">
        <img id="profilePreview" src="" alt="Profile Preview" class="w-full h-full object-cover hidden">
        <canvas id="photoCanvas" class="hidden absolute w-full h-full object-cover"></canvas>
        <div id="profilePlaceholder" class="text-center">
          <div class="text-6xl mb-2 animate-float">👤</div>
          <p class="text-blue-400 font-bold text-sm">No photo yet</p>
        </div>
      </div>
      <!-- Badge verified premium -->
      <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-1.5 rounded-full text-xs font-black shadow-xl">
        ✓ VERIFIED
      </div>
    </div>

    <!-- Upload Buttons Premium -->
    <div class="flex flex-col sm:flex-row gap-3 mb-4 w-full sm:w-auto px-4 sm:px-0">
      <label for="profileUpload" onclick="closeCamera()" class="upload-btn bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 sm:px-8 py-3.5 rounded-2xl cursor-pointer font-bold text-base shadow-lg flex items-center justify-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Choose Photo</span>
      </label>
      <button onclick="openCamera()" class="upload-btn bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 sm:px-8 py-3.5 rounded-2xl font-bold text-base shadow-lg flex items-center justify-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
        </svg>
        <span>Take Photo</span>
      </button>
    </div>

    <!-- Retake Button -->
    <button 
      id="retakePhotoBtn" 
      onclick="retakeProfilePhoto()" 
      class="hidden upload-btn bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 sm:px-8 py-3 rounded-2xl font-bold text-base shadow-lg flex items-center space-x-2 mb-4"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
      </svg>
      <span>Retake Photo</span>
    </button>

    <input type="file" id="profileUpload" accept="image/*" class="hidden">

    <!-- Camera Stream -->
    <div id="cameraSection" class="hidden mt-4 text-center">
      <div class="relative inline-block">
        <video id="videoStream" autoplay class="w-48 h-48 rounded-full border-4 border-green-400 mx-auto mb-4 shadow-2xl" style="animation: pulse-border 2s infinite;"></video>
        <button onclick="capturePhoto()" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-2xl font-bold shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all">
          📸 Capture
        </button>
      </div>
    </div>
  </div>

  <!-- Instructions premium -->
  <div class="mb-8 rounded-3xl bg-gradient-to-br from-amber-50 to-yellow-50 border-3 border-amber-300 p-6 shadow-lg">
    <div class="flex items-start mb-4">
      <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md flex-shrink-0 mr-4">
        <span class="text-2xl">✅</span>
      </div>
      <div>
        <h3 class="text-amber-900 font-black text-xl mb-2">Photo Requirements</h3>
        <p class="text-amber-800 text-sm font-bold">These photos are visible to all members</p>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
      <div class="flex items-center space-x-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
        <span class="text-2xl">👤</span>
        <span class="text-gray-800 font-semibold text-sm">Alone in photo</span>
      </div>
      <div class="flex items-center space-x-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
        <span class="text-2xl">🚫</span>
        <span class="text-gray-800 font-semibold text-sm">No filters</span>
      </div>
      <div class="flex items-center space-x-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
        <span class="text-2xl">😊</span>
        <span class="text-gray-800 font-semibold text-sm">Face visible</span>
      </div>
      <div class="flex items-center space-x-3 bg-white rounded-xl px-4 py-3 shadow-sm hover:shadow-md transition-shadow">
        <span class="text-2xl">📷</span>
        <span class="text-gray-800 font-semibold text-sm">Face photo only</span>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep9" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep10" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>
</div>

<script>
  const profileUpload = document.getElementById('profileUpload');
  const profilePreview = document.getElementById('profilePreview');
  const profilePlaceholder = document.getElementById('profilePlaceholder');
  const photoCanvas = document.getElementById('photoCanvas');
  const videoStream = document.getElementById('videoStream');
  const cameraSection = document.getElementById('cameraSection');
  const retakeBtn = document.getElementById('retakePhotoBtn');
  let currentStream = null;

  // AUTO-SAVE dans localStorage
  function saveProfilePhoto(dataUrl) {
    let expats = JSON.parse(localStorage.getItem('expats')) || {};
    expats.profilePhoto = {
      image: dataUrl,
      uploaded_at: new Date().toISOString()
    };
    localStorage.setItem('expats', JSON.stringify(expats));
  }

  // Upload fichier
  profileUpload.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
      const dataUrl = event.target.result;
      profilePreview.src = dataUrl;
      profilePreview.classList.remove('hidden');
      photoCanvas.classList.add('hidden');
      profilePlaceholder.classList.add('hidden');
      retakeBtn.classList.remove('hidden');
      
      // AUTO-SAVE
      saveProfilePhoto(dataUrl);
    };
    reader.readAsDataURL(file);
  });

  // Ouvrir caméra (selfie mode pour photo de profil)
  function openCamera() {
    cameraSection.classList.remove('hidden');
    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
      .then((stream) => {
        videoStream.srcObject = stream;
        currentStream = stream;
      })
      .catch((err) => {
        alert('Unable to access camera: ' + err.message);
        console.error(err);
      });
  }

  // Fermer caméra
  function closeCamera() {
    if (currentStream) {
      currentStream.getTracks().forEach(track => track.stop());
      currentStream = null;
    }
    videoStream.srcObject = null;
    cameraSection.classList.add('hidden');
  }

  // Capturer photo
  function capturePhoto() {
    const context = photoCanvas.getContext('2d');
    const video = videoStream;
    photoCanvas.width = video.videoWidth;
    photoCanvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

    const dataUrl = photoCanvas.toDataURL('image/jpeg');

    photoCanvas.classList.remove('hidden');
    profilePreview.classList.add('hidden');
    profilePlaceholder.classList.add('hidden');
    retakeBtn.classList.remove('hidden');

    // Stop camera
    closeCamera();

    // AUTO-SAVE
    saveProfilePhoto(dataUrl);
  }

  // Retake photo
  function retakeProfilePhoto() {
    // Reset UI
    profilePreview.classList.add('hidden');
    profilePreview.src = '';
    photoCanvas.classList.add('hidden');
    profilePlaceholder.classList.remove('hidden');
    retakeBtn.classList.add('hidden');
    profileUpload.value = '';

    // Supprimer du localStorage
    let expats = JSON.parse(localStorage.getItem('expats')) || {};
    delete expats.profilePhoto;
    localStorage.setItem('expats', JSON.stringify(expats));
  }

  // Restore depuis localStorage au chargement
  document.addEventListener('DOMContentLoaded', function() {
    const expats = JSON.parse(localStorage.getItem('expats')) || {};
    if (expats.profilePhoto && expats.profilePhoto.image) {
      profilePreview.src = expats.profilePhoto.image;
      profilePreview.classList.remove('hidden');
      profilePlaceholder.classList.add('hidden');
      retakeBtn.classList.remove('hidden');
    }
  });

  // IMPORTANT: Observer pour restaurer la photo quand on revient sur le step
  const step10Observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.target.id === 'step10' && !mutation.target.classList.contains('hidden')) {
        // Le step devient visible, on restaure la photo si elle existe
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        if (expats.profilePhoto && expats.profilePhoto.image) {
          profilePreview.src = expats.profilePhoto.image;
          profilePreview.classList.remove('hidden');
          photoCanvas.classList.add('hidden');
          profilePlaceholder.classList.add('hidden');
          retakeBtn.classList.remove('hidden');
        }
      }
    });
  });

  const step10Element = document.getElementById('step10');
  if (step10Element) {
    step10Observer.observe(step10Element, { attributes: true, attributeFilter: ['class'] });
  }

  // CRITIQUE: Arrêter caméra à la fermeture de page
  window.addEventListener('beforeunload', function() {
    try {
      if (currentStream) {
        currentStream.getTracks().forEach(track => track.stop());
      }
    } catch(e) {
      console.warn('Error stopping camera on unload:', e);
    }
  });

  // Arrêter caméra si step10 devient hidden
  try {
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.target.id === 'step10' && mutation.target.classList.contains('hidden')) {
          try {
            closeCamera();
          } catch(e) {
            console.warn('Error closing camera:', e);
          }
        }
      });
    });

    const step10 = document.getElementById('step10');
    if (step10) {
      observer.observe(step10, { attributes: true, attributeFilter: ['class'] });
    }
  } catch(e) {
    console.warn('Error setting up observer:', e);
  }

  // Expose globalement
  window.openCamera = openCamera;
  window.closeCamera = closeCamera;
  window.capturePhoto = capturePhoto;
  window.retakeProfilePhoto = retakeProfilePhoto;
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Step 10 : Photo optionnelle, pas de validation obligatoire
    // Le bouton Continue est toujours activé
    const nextBtn = document.getElementById('nextStep10');
    if (nextBtn) {
        nextBtn.disabled = false;
    }
});
</script>