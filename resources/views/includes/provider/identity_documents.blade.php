<div id="step11" class="hidden">
  <style>
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
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
    
    @keyframes pulse-border {
      0%, 100% { 
        border-color: rgba(34, 197, 94, 0.5); 
      }
      50% { 
        border-color: rgba(34, 197, 94, 1); 
      }
    }
    
    .animate-gradient {
      background-size: 200% auto;
      animation: gradient 4s ease infinite;
    }
    
    .doc-btn {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .doc-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s ease;
    }
    
    .doc-btn:hover::before {
      left: 100%;
    }
    
    .doc-btn:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }
    
    .modal-backdrop {
      backdrop-filter: blur(8px);
    }
    
    .upload-zone {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .upload-zone:hover {
      transform: scale(1.02);
      border-color: rgb(59, 130, 246);
    }
    
    .upload-zone.has-file {
      border-color: rgb(34, 197, 94);
      background: linear-gradient(to bottom right, #f0fdf4, #d1fae5);
    }
    
    .upload-zone img,
    .upload-zone video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: center;
      max-width: 100%;
      max-height: 100%;
    }
    
    .video-stream-pulse {
      animation: pulse-border 2s infinite;
    }
    
    .border-3 {
      border-width: 3px;
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
  </style>

  <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 hidden md:block">
    <div class="ambient-blob absolute top-10 left-10 w-64 h-64 bg-blue-300 rounded-full"></div>
    <div class="ambient-blob absolute top-20 right-10 w-64 h-64 bg-cyan-300 rounded-full"></div>
    <div class="ambient-blob absolute bottom-10 left-1/2 w-64 h-64 bg-teal-300 rounded-full"></div>
  </div>

  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">🆔</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent animate-gradient">
        Identity Documents
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Upload at least one document to verify your identity
    </p>
  </div>

  <div class="mb-8 rounded-2xl bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-300 py-4 px-6 shadow-lg">
    <div class="flex items-start gap-4">
      <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">💡</span>
      </div>
      <div class="flex-1">
        <p class="text-amber-900 font-bold text-base">Not mandatory but increases trust</p>
        <p class="text-amber-700 text-sm font-medium mt-1">Upload at least one identity document to boost your profile verification</p>
      </div>
    </div>
  </div>

  <div class="space-y-4 mb-8">
    <button type="button" onclick="openDocumentModal('european_id')" class="doc-btn w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg hover:shadow-xl flex items-center justify-between group">
      <div class="flex items-center space-x-4">
        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
          🪪
        </div>
        <span class="text-xl">European Identity Card</span>
      </div>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>

    <button type="button" onclick="openDocumentModal('passport')" class="doc-btn w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg hover:shadow-xl flex items-center justify-between group">
      <div class="flex items-center space-x-4">
        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
          🛂
        </div>
        <span class="text-xl">Passport</span>
      </div>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>

    <button type="button" onclick="openDocumentModal('license')" class="doc-btn w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg hover:shadow-xl flex items-center justify-between group">
      <div class="flex items-center space-x-4">
        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center text-3xl">
          🚗
        </div>
        <span class="text-xl">Driver's License</span>
      </div>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>

  <div class="wizard-nav-container flex items-center justify-between gap-4 mt-8">
    <button id="backToStep10" type="button" class="nav-btn-back flex-1 sm:flex-none bg-white text-blue-600 border-2 border-gray-200 hover:border-blue-400 px-8 py-3 rounded-xl font-bold text-base transition-colors hover:shadow-lg">
      Back
    </button>
    <button id="nextStep11" type="button" class="nav-btn-next flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-bold text-base shadow-lg hover:shadow-xl transition-all hover:scale-105">
      Continue
    </button>
  </div>
</div>

<!-- Modal European ID (2 sides) -->
<div id="modal-european_id" class="modal-backdrop fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
    <button type="button" onclick="closeDocumentModal('european_id')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold">×</button>
    
    <h3 class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-8 text-center">
      🪪 European Identity Card
    </h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
      <!-- Front Side -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Front Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-european_id-front" class="hidden" />
            <div id="preview-european_id-front" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-blue-100 text-blue-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button type="button" onclick="openCamera('european_id', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              📸 Take Photo
            </button>
            <button type="button" onclick="retakePhoto('european_id', 'front')" id="retake-european_id-front" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-front" class="hidden mt-3 w-full rounded-2xl border-4 border-green-500 shadow-xl video-stream-pulse" autoplay playsinline></video>
          <button type="button" onclick="capturePhoto('european_id', 'front')" id="capture-european_id-front" class="hidden mt-3 w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
            📷 Capture
          </button>
        </div>
      </div>

      <!-- Back Side -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Back Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-european_id-back" class="hidden" />
            <div id="preview-european_id-back" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-cyan-100 text-cyan-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button type="button" onclick="openCamera('european_id', 'back')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              📸 Take Photo
            </button>
            <button type="button" onclick="retakePhoto('european_id', 'back')" id="retake-european_id-back" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-back" class="hidden mt-3 w-full rounded-2xl border-4 border-green-500 shadow-xl video-stream-pulse" autoplay playsinline></video>
          <button type="button" onclick="capturePhoto('european_id', 'back')" id="capture-european_id-back" class="hidden mt-3 w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
            📷 Capture
          </button>
        </div>
      </div>
    </div>
    
    <button type="button" onclick="saveDocument('european_id')" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-4 rounded-2xl font-black text-lg shadow-xl hover:shadow-2xl transition-all hover:scale-105">
      💾 Save & Continue
    </button>
  </div>
</div>

<!-- Modal Passport (1 side) -->
<div id="modal-passport" class="modal-backdrop fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-2xl relative max-h-[90vh] overflow-y-auto">
    <button type="button" onclick="closeDocumentModal('passport')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold">×</button>
    
    <h3 class="text-3xl font-black bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-8 text-center">
      🛂 Passport
    </h3>
    
    <div class="flex flex-col items-center mb-8">
      <div class="w-full max-w-md">
        <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-80 cursor-pointer bg-gray-50 mb-3">
          <input type="file" accept="image/*" id="upload-passport-front" class="hidden" />
          <div id="preview-passport-front" class="flex flex-col items-center">
            <div class="text-7xl mb-4">📖</div>
            <span class="bg-cyan-100 text-cyan-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
          </div>
        </label>
        <div class="flex gap-2">
          <button type="button" onclick="openCamera('passport', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
            📸 Take Photo
          </button>
          <button type="button" onclick="retakePhoto('passport', 'front')" id="retake-passport-front" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
            🔄 Retake
          </button>
        </div>
        <video id="camera-passport-front" class="hidden mt-3 w-full rounded-2xl border-4 border-green-500 shadow-xl video-stream-pulse" autoplay playsinline></video>
        <button type="button" onclick="capturePhoto('passport', 'front')" id="capture-passport-front" class="hidden mt-3 w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
          📷 Capture
        </button>
      </div>
    </div>
    
    <button type="button" onclick="saveDocument('passport')" class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white px-8 py-4 rounded-2xl font-black text-lg shadow-xl hover:shadow-2xl transition-all hover:scale-105">
      💾 Save & Continue
    </button>
  </div>
</div>

<!-- Modal License (2 sides) -->
<div id="modal-license" class="modal-backdrop fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
    <button type="button" onclick="closeDocumentModal('license')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold">×</button>
    
    <h3 class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-8 text-center">
      🚗 Driver's License
    </h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
      <!-- Front Side -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Front Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-license-front" class="hidden" />
            <div id="preview-license-front" class="flex flex-col items-center">
              <div class="text-6xl mb-4">🎫</div>
              <span class="bg-emerald-100 text-emerald-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button type="button" onclick="openCamera('license', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              📸 Take Photo
            </button>
            <button type="button" onclick="retakePhoto('license', 'front')" id="retake-license-front" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-front" class="hidden mt-3 w-full rounded-2xl border-4 border-green-500 shadow-xl video-stream-pulse" autoplay playsinline></video>
          <button type="button" onclick="capturePhoto('license', 'front')" id="capture-license-front" class="hidden mt-3 w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
            📷 Capture
          </button>
        </div>
      </div>

      <!-- Back Side -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Back Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-license-back" class="hidden" />
            <div id="preview-license-back" class="flex flex-col items-center">
              <div class="text-6xl mb-4">🎫</div>
              <span class="bg-teal-100 text-teal-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button type="button" onclick="openCamera('license', 'back')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              📸 Take Photo
            </button>
            <button type="button" onclick="retakePhoto('license', 'back')" id="retake-license-back" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm hover:shadow-lg transition-all">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-back" class="hidden mt-3 w-full rounded-2xl border-4 border-green-500 shadow-xl video-stream-pulse" autoplay playsinline></video>
          <button type="button" onclick="capturePhoto('license', 'back')" id="capture-license-back" class="hidden mt-3 w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition-all">
            📷 Capture
          </button>
        </div>
      </div>
    </div>
    
    <button type="button" onclick="saveDocument('license')" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-4 rounded-2xl font-black text-lg shadow-xl hover:shadow-2xl transition-all hover:scale-105">
      💾 Save & Continue
    </button>
  </div>
</div>

<script>
(function() {
  const cameraStreams = {};
  
  window.openDocumentModal = function(type) {
    const modal = document.getElementById(`modal-${type}`);
    if (modal) {
      modal.classList.remove('hidden');
      restoreDocumentFromStorage(type);
    }
  };
  
  window.closeDocumentModal = function(type) {
    const modal = document.getElementById(`modal-${type}`);
    if (modal) {
      modal.classList.add('hidden');
    }
    
    if (isTwoSided(type)) {
      stopCamera(type, 'front');
      stopCamera(type, 'back');
    } else {
      stopCamera(type, 'front');
    }
    
    setNextStateForType(type);
  };
  
  function isTwoSided(type) {
    return type === 'european_id' || type === 'license';
  }
  
  function previewBoxId(type, side) {
    return `preview-${type}-${side}`;
  }
  
  function idParts(id) {
    const match = id.match(/upload-([^-]+)-([^-]+)/);
    return match ? { type: match[1], side: match[2] } : null;
  }
  
  function setNextStateForType(type) {
    const nextBtn = document.getElementById('nextStep11');
    if (nextBtn) {
      nextBtn.disabled = false;
    }
  }
  
  function resetPreview(type, side) {
    const box = document.getElementById(previewBoxId(type, side));
    if (!box) return;
    
    const icon = type === 'european_id' ? '📄' : type === 'passport' ? '📖' : '🎫';
    const color = side === 'front' ? (type === 'european_id' ? 'blue' : type === 'passport' ? 'cyan' : 'emerald') : (type === 'european_id' ? 'cyan' : 'teal');
    
    box.innerHTML = `
      <div class="text-6xl mb-4">${icon}</div>
      <span class="bg-${color}-100 text-${color}-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
    `;
    box.closest('.upload-zone').classList.remove('has-file');
  }
  
  function renderPreview(box, dataUrl) {
    box.innerHTML = `<img src="${dataUrl}" alt="Preview" class="rounded-2xl" />`;
    box.closest('.upload-zone').classList.add('has-file');
  }
  
  document.addEventListener('change', function(e) {
    if (e.target.type === 'file' && e.target.id.startsWith('upload-')) {
      const meta = idParts(e.target.id);
      if (!meta) return;
      
      const file = e.target.files[0];
      if (!file) return;
      
      const reader = new FileReader();
      reader.onload = function(ev) {
        const box = document.getElementById(previewBoxId(meta.type, meta.side));
        if (box) {
          renderPreview(box, ev.target.result);
          const retakeBtn = document.getElementById(`retake-${meta.type}-${meta.side}`);
          if (retakeBtn) {
            retakeBtn.classList.remove('hidden');
          }
          autoSavePhoto(meta.type, meta.side, ev.target.result);
          setNextStateForType(meta.type);
        }
      };
      reader.readAsDataURL(file);
    }
  });
  
  window.openCamera = async function(type, side) {
    const video = document.getElementById(`camera-${type}-${side}`);
    const captureBtn = document.getElementById(`capture-${type}-${side}`);
    if (!video || !captureBtn) return;
    
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ 
        video: { facingMode: 'environment', width: { ideal: 1920 }, height: { ideal: 1080 } }
      });
      
      video.srcObject = stream;
      video.classList.remove('hidden');
      captureBtn.classList.remove('hidden');
      
      const key = `${type}-${side}`;
      cameraStreams[key] = stream;
    } catch (err) {
      console.warn('Camera access denied or unavailable');
    }
  };
  
  window.capturePhoto = function(type, side) {
    const video = document.getElementById(`camera-${type}-${side}`);
    const box = document.getElementById(previewBoxId(type, side));
    if (!video || !box) return;
    
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0);
    
    const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
    renderPreview(box, dataUrl);
    
    const input = document.getElementById(`upload-${type}-${side}`);
    if (input) {
      fetch(dataUrl)
        .then(res => res.blob())
        .then(blob => {
          const file = new File([blob], `${type}-${side}.jpg`, { type: 'image/jpeg' });
          const dt = new DataTransfer();
          dt.items.add(file);
          input.files = dt.files;
          setNextStateForType(type);
        });
    }
    
    stopCamera(type, side);
    const retakeBtn = document.getElementById(`retake-${type}-${side}`);
    if (retakeBtn) {
      retakeBtn.classList.remove('hidden');
    }
    autoSavePhoto(type, side, dataUrl);
  };
  
  window.retakePhoto = function(type, side) {
    resetPreview(type, side);
    const input = document.getElementById(`upload-${type}-${side}`);
    if (input) {
      input.value = '';
    }
    const retakeBtn = document.getElementById(`retake-${type}-${side}`);
    if (retakeBtn) {
      retakeBtn.classList.add('hidden');
    }
    setNextStateForType(type);
    
    try {
      let expats = JSON.parse(localStorage.getItem('expats')) || {};
      if (expats.documents && expats.documents[type]) {
        if (isTwoSided(type)) {
          delete expats.documents[type][side];
          if (!expats.documents[type].front && !expats.documents[type].back) {
            delete expats.documents[type];
          }
        } else {
          delete expats.documents[type];
        }
        localStorage.setItem('expats', JSON.stringify(expats));
      }
    } catch (e) {
      console.warn('Error removing photo:', e);
    }
  };
  
  window.stopCamera = function(type, side) {
    const key = `${type}-${side}`;
    if (cameraStreams[key]) {
      cameraStreams[key].getTracks().forEach(track => track.stop());
      delete cameraStreams[key];
    }
    const video = document.getElementById(`camera-${type}-${side}`);
    const captureBtn = document.getElementById(`capture-${type}-${side}`);
    if (video) {
      video.classList.add('hidden');
      video.srcObject = null;
    }
    if (captureBtn) {
      captureBtn.classList.add('hidden');
    }
  };
  
  window.closeCameraBeforeUpload = function(label) {
    const input = label.querySelector('input[type="file"]');
    if (!input) return;
    
    const meta = idParts(input.id);
    if (meta) {
      stopCamera(meta.type, meta.side);
    }
    
    input.click();
  };
  
  function autoSavePhoto(type, side, dataUrl) {
    try {
      let expats = JSON.parse(localStorage.getItem('expats')) || {};
      expats.documents = expats.documents || {};
      
      if (isTwoSided(type)) {
        if (!expats.documents[type]) {
          expats.documents[type] = {};
        }
        expats.documents[type][side] = dataUrl;
        expats.documents[type].uploaded_at = new Date().toISOString();
      } else {
        expats.documents[type] = {
          image: dataUrl,
          uploaded_at: new Date().toISOString()
        };
      }
      
      localStorage.setItem('expats', JSON.stringify(expats));
    } catch (e) {
      console.warn('Error saving photo:', e);
    }
  }
  
  function restoreDocumentFromStorage(type) {
    try {
      const expats = JSON.parse(localStorage.getItem('expats')) || {};
      const doc = expats.documents && expats.documents[type];
      if (!doc) return;
      
      if (isTwoSided(type)) {
        if (doc.front) {
          const boxFront = document.getElementById(previewBoxId(type, 'front'));
          if (boxFront) {
            renderPreview(boxFront, doc.front);
            const retakeBtnFront = document.getElementById(`retake-${type}-front`);
            if (retakeBtnFront) {
              retakeBtnFront.classList.remove('hidden');
            }
          }
        }
        if (doc.back) {
          const boxBack = document.getElementById(previewBoxId(type, 'back'));
          if (boxBack) {
            renderPreview(boxBack, doc.back);
            const retakeBtnBack = document.getElementById(`retake-${type}-back`);
            if (retakeBtnBack) {
              retakeBtnBack.classList.remove('hidden');
            }
          }
        }
      } else {
        if (doc.image) {
          const boxFront = document.getElementById(previewBoxId(type, 'front'));
          if (boxFront) {
            renderPreview(boxFront, doc.image);
            const retakeBtnFront = document.getElementById(`retake-${type}-front`);
            if (retakeBtnFront) {
              retakeBtnFront.classList.remove('hidden');
            }
          }
        }
      }
      
      setNextStateForType(type);
    } catch (e) {
      console.warn('Error restoring document:', e);
    }
  }
  
  window.saveDocument = function(type) {
    closeDocumentModal(type);
  };
  
  window.addEventListener('beforeunload', function() {
    Object.keys(cameraStreams).forEach(key => {
      if (cameraStreams[key]) {
        cameraStreams[key].getTracks().forEach(track => track.stop());
      }
    });
  });
  
  const step11Element = document.getElementById('step11');
  if (step11Element) {
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.target.id === 'step11' && mutation.target.classList.contains('hidden')) {
          Object.keys(cameraStreams).forEach(key => {
            if (cameraStreams[key]) {
              cameraStreams[key].getTracks().forEach(track => track.stop());
            }
          });
        }
      });
    });
    
    observer.observe(step11Element, { 
      attributes: true, 
      attributeFilter: ['class'] 
    });
  }
  
  const nextBtn = document.getElementById('nextStep11');
  if (nextBtn) {
    nextBtn.disabled = false;
  }
})();
</script>