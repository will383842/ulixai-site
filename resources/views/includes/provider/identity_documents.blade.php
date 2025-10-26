<div id="step11" class="hidden">
  <style>
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
      transition: left 0.5s;
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
    }
    .upload-zone:hover {
      transform: scale(1.02);
      border-color: rgb(59, 130, 246);
    }
    .upload-zone.has-file {
      border-color: rgb(34, 197, 94);
      background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    }
    .upload-zone img {
      object-fit: cover !important;
      object-position: center !important;
      width: 100% !important;
      height: 100% !important;
    }
    @keyframes pulse-ring {
      0% { transform: scale(1); opacity: 1; }
      100% { transform: scale(1.5); opacity: 0; }
    }
    .camera-active {
      animation: pulse-ring 2s infinite;
    }
  </style>

  <!-- Header premium avec gradient -->
  <div class="mb-8 text-center relative">
    <div class="inline-flex items-center justify-center gap-3 mb-4">
      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:rotate-12 transition-transform duration-300">
        <span class="text-3xl">🆔</span>
      </div>
      <h2 class="font-black text-3xl sm:text-4xl bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 bg-clip-text text-transparent">
        Identity Documents
      </h2>
    </div>
    <p class="text-gray-600 text-base sm:text-lg font-semibold">
      Upload at least one document to verify your identity
    </p>
  </div>

  <!-- Info banner obligatoire -->
  <div class="mb-8 rounded-2xl bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border-2 border-amber-300 py-4 px-6 shadow-lg">
    <div class="flex items-start gap-4">
      <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
        <span class="text-xl">⚠️</span>
      </div>
      <div class="flex-1">
        <p class="text-amber-900 font-bold text-base">Required to verify your identity</p>
        <p class="text-amber-700 text-sm mt-1">💡 Not mandatory but increases trust and profile verification</p>
      </div>
    </div>
  </div>

  <!-- Sélection des documents -->
  <div class="space-y-4 mb-8">
    <button onclick="openDocumentModal('european_id')" class="doc-btn w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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

    <button onclick="openDocumentModal('passport')" class="doc-btn w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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

    <button onclick="openDocumentModal('license')" class="doc-btn w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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

  <!-- Navigation -->
  <div class="wizard-nav-container">
    <button id="backToStep10" type="button" class="nav-btn-back">
      Back
    </button>
    <button id="nextStep11" type="button" class="nav-btn-next">
      Continue
    </button>
  </div>
</div>

<!-- Modal European ID -->
<div id="modal-european_id" class="modal-backdrop fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
    <h3 class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-8 text-center">
      🪪 Identity Card
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
      <!-- Front -->
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
            <button onclick="openCamera('european_id', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('european_id', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-european_id-front">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-front" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('european_id', 'front')" class="hidden w-full bg-blue-600 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-european_id-front">
            📸 Capture
          </button>
        </div>
      </div>
      <!-- Back -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Back Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-european_id-back" class="hidden" />
            <div id="preview-european_id-back" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-blue-100 text-blue-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('european_id', 'back')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('european_id', 'back')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-european_id-back">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-back" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('european_id', 'back')" class="hidden w-full bg-blue-600 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-european_id-back">
            📸 Capture
          </button>
        </div>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="closeDocumentModal('european_id')" class="text-gray-600 hover:text-blue-600 font-bold text-lg">← Back</button>
      <button id="next-european_id" onclick="saveDocument('european_id')" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-bold px-10 py-3 rounded-2xl disabled:opacity-40" disabled>Save & Continue</button>
    </div>
  </div>
</div>

<!-- Modal Passport -->
<div id="modal-passport" class="modal-backdrop fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-2xl relative max-h-[90vh] overflow-y-auto">
    <h3 class="text-3xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-8 text-center">
      🛂 Passport
    </h3>
    <div class="flex justify-center mb-8">
      <div class="flex flex-col items-center w-full max-w-md">
        <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-72 cursor-pointer bg-gray-50 mb-3">
          <input type="file" accept="image/*" id="upload-passport-front" class="hidden" />
          <div id="preview-passport-front" class="flex flex-col items-center">
            <div class="text-6xl mb-4">📄</div>
            <span class="bg-purple-100 text-purple-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
          </div>
        </label>
        <div class="flex gap-2 w-full">
          <button onclick="openCamera('passport', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
            📸 Take Photo
          </button>
          <button onclick="retakePhoto('passport', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-passport-front">
            🔄 Retake
          </button>
        </div>
        <video id="camera-passport-front" class="hidden w-full h-72 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
        <button onclick="capturePhoto('passport', 'front')" class="hidden w-full bg-purple-600 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-passport-front">
          📸 Capture
        </button>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="closeDocumentModal('passport')" class="text-gray-600 hover:text-purple-600 font-bold text-lg">← Back</button>
      <button id="next-passport" onclick="saveDocument('passport')" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold px-10 py-3 rounded-2xl disabled:opacity-40" disabled>Save & Continue</button>
    </div>
  </div>
</div>

<!-- Modal License -->
<div id="modal-license" class="modal-backdrop fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
    <h3 class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-8 text-center">
      🚗 Driver's License
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
      <!-- Front -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Front Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-license-front" class="hidden" />
            <div id="preview-license-front" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-emerald-100 text-emerald-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('license', 'front')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('license', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-license-front">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-front" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('license', 'front')" class="hidden w-full bg-emerald-600 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-license-front">
            📸 Capture
          </button>
        </div>
      </div>
      <!-- Back -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Back Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-license-back" class="hidden" />
            <div id="preview-license-back" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-emerald-100 text-emerald-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('license', 'back')" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('license', 'back')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-license-back">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-back" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('license', 'back')" class="hidden w-full bg-emerald-600 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-license-back">
            📸 Capture
          </button>
        </div>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="closeDocumentModal('license')" class="text-gray-600 hover:text-emerald-600 font-bold text-lg">← Back</button>
      <button id="next-license" onclick="saveDocument('license')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-10 py-3 rounded-2xl disabled:opacity-40" disabled>Save & Continue</button>
    </div>
  </div>
</div>

<script>
const cameraStreams = {};

function openDocumentModal(type) {
  const modal = document.getElementById(`modal-${type}`);
  if (modal) modal.classList.remove('hidden');
  
  // Restore saved data
  const expats = JSON.parse(localStorage.getItem('expats')) || {};
  const docs = expats.documents || {};
  if (docs[type]) {
    if (isTwoSided(type)) {
      if (docs[type].front) renderPreview(document.getElementById(`preview-${type}-front`), docs[type].front);
      if (docs[type].back) renderPreview(document.getElementById(`preview-${type}-back`), docs[type].back);
    } else {
      if (docs[type].image) renderPreview(document.getElementById(`preview-${type}-front`), docs[type].image);
    }
    setNextStateForType(type);
  }
}

function closeDocumentModal(type) {
  const modal = document.getElementById(`modal-${type}`);
  if (modal) modal.classList.add('hidden');
  stopCamera(type, 'front');
  stopCamera(type, 'back');
}

function isTwoSided(type) {
  return type === 'european_id' || type === 'license';
}

function idParts(inputId) {
  const match = /^upload-(\w+)-(\w+)$/.exec(inputId);
  if (!match) return null;
  return { type: match[1], side: match[2] };
}

function previewBoxId(type, side) {
  return `preview-${type}-${side}`;
}

function renderPreview(box, dataUrl) {
  if (!box) return;
  const label = box.closest('label');
  if (label) label.classList.add('has-file');
  
  box.innerHTML = `<img src="${dataUrl}" alt="preview" class="rounded-2xl" />`;
}

function resetPreview(type, side) {
  const box = document.getElementById(previewBoxId(type, side));
  if (!box) return;
  
  const label = box.closest('label');
  if (label) label.classList.remove('has-file');
  
  const colors = {
    european_id: 'blue',
    passport: 'purple',
    license: 'emerald'
  };
  const color = colors[type] || 'blue';
  
  box.innerHTML = `
    <div class="text-6xl mb-4">📄</div>
    <span class="bg-${color}-100 text-${color}-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
  `;
}

function setNextButtonState(type, enabled) {
  const btn = document.getElementById(`next-${type}`);
  if (btn) btn.disabled = !enabled;
}

function setNextStateForType(type) {
  if (isTwoSided(type)) {
    const front = document.getElementById(`upload-${type}-front`);
    const back = document.getElementById(`upload-${type}-back`);
    setNextButtonState(type, !!(front?.files?.length && back?.files?.length));
  } else {
    const one = document.getElementById(`upload-${type}-front`);
    setNextButtonState(type, !!(one?.files?.length));
  }
}

document.addEventListener('change', function (e) {
  const t = e.target;
  if (!(t instanceof HTMLInputElement)) return;
  if (t.type !== 'file') return;
  if (!/^upload-/.test(t.id)) return;

  const meta = idParts(t.id);
  if (!meta) return;
  const { type, side } = meta;

  const file = t.files && t.files[0];
  const box  = document.getElementById(previewBoxId(type, side));
  if (!box) return;

  if (!file) {
    resetPreview(type, side);
    setNextStateForType(type);
    return;
  }
  if (!/^image\//i.test(file.type)) {
    alert('Please select an image file.');
    t.value = '';
    resetPreview(type, side);
    setNextStateForType(type);
    return;
  }

  const reader = new FileReader();
  reader.onload = (ev) => {
    renderPreview(box, ev.target.result);
    setNextStateForType(type);
    document.getElementById(`retake-${type}-${side}`)?.classList.remove('hidden');
    autoSavePhoto(type, side, ev.target.result);
  };
  reader.readAsDataURL(file);
});

function openCamera(type, side) {
  const video = document.getElementById(`camera-${type}-${side}`);
  const captureBtn = document.getElementById(`capture-${type}-${side}`);
  if (!video) return;

  video.classList.remove('hidden');
  if (captureBtn) captureBtn.classList.remove('hidden');

  navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
    .then(stream => {
      video.srcObject = stream;
      cameraStreams[`${type}-${side}`] = stream;
    })
    .catch(err => alert('Unable to access camera: ' + err.message));
}

function capturePhoto(type, side) {
  const video = document.getElementById(`camera-${type}-${side}`);
  const box = document.getElementById(previewBoxId(type, side));
  if (!video || !box) return;

  const canvas = document.createElement('canvas');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0);

  const dataUrl = canvas.toDataURL('image/jpeg');
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
  document.getElementById(`retake-${type}-${side}`)?.classList.remove('hidden');
  autoSavePhoto(type, side, dataUrl);
}

function retakePhoto(type, side) {
  resetPreview(type, side);
  const input = document.getElementById(`upload-${type}-${side}`);
  if (input) input.value = '';
  document.getElementById(`retake-${type}-${side}`)?.classList.add('hidden');
  setNextStateForType(type);
  
  let expats = JSON.parse(localStorage.getItem('expats')) || {};
  if (expats.documents && expats.documents[type]) {
    if (isTwoSided(type)) {
      delete expats.documents[type][side];
    } else {
      delete expats.documents[type];
    }
    localStorage.setItem('expats', JSON.stringify(expats));
  }
}

function stopCamera(type, side) {
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
  if (captureBtn) captureBtn.classList.add('hidden');
}

function closeCameraBeforeUpload(label) {
  const input = label.querySelector('input[type="file"]');
  if (!input) return;
  
  const meta = idParts(input.id);
  if (meta) stopCamera(meta.type, meta.side);
  
  input.click();
}

function autoSavePhoto(type, side, dataUrl) {
  let expats = JSON.parse(localStorage.getItem('expats')) || {};
  expats.documents = expats.documents || {};
  
  if (isTwoSided(type)) {
    if (!expats.documents[type]) expats.documents[type] = {};
    expats.documents[type][side] = dataUrl;
    expats.documents[type].uploaded_at = new Date().toISOString();
  } else {
    expats.documents[type] = {
      image: dataUrl,
      uploaded_at: new Date().toISOString()
    };
  }
  
  localStorage.setItem('expats', JSON.stringify(expats));
}

function saveDocument(type) {
  closeDocumentModal(type);
}

window.openDocumentModal = openDocumentModal;
window.closeDocumentModal = closeDocumentModal;
window.saveDocument = saveDocument;
window.resetPreview = resetPreview;
window.openCamera = openCamera;
window.capturePhoto = capturePhoto;
window.retakePhoto = retakePhoto;
window.stopCamera = stopCamera;
window.closeCameraBeforeUpload = closeCameraBeforeUpload;

window.addEventListener('beforeunload', function() {
  try {
    Object.keys(cameraStreams).forEach(key => {
      if (cameraStreams[key]) {
        cameraStreams[key].getTracks().forEach(track => track.stop());
      }
    });
  } catch(e) {
    console.warn('Error stopping cameras on unload:', e);
  }
});

try {
  const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.target.id === 'step11' && mutation.target.classList.contains('hidden')) {
        try {
          Object.keys(cameraStreams).forEach(key => {
            if (cameraStreams[key]) {
              cameraStreams[key].getTracks().forEach(track => track.stop());
            }
          });
        } catch(e) {
          console.warn('Error stopping cameras:', e);
        }
      }
    });
  });

  const step11 = document.getElementById('step11');
  if (step11) {
    observer.observe(step11, { attributes: true, attributeFilter: ['class'] });
  }
} catch(e) {
  console.warn('Error setting up observer:', e);
}
</script>

<script>
// Step 11 : Au moins un document requis pour continuer
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep11');
    
    function hasAnyDocument() {
        const expats = JSON.parse(localStorage.getItem('expats')) || {};
        const docs = expats.documents || {};
        return !!(docs.passport || docs.european_id || docs.license);
    }
    
    function checkValidation() {
        const isValid = hasAnyDocument();
        if (nextBtn) {
            nextBtn.disabled = !isValid;
        }
    }
    
    // Vérification périodique pour détecter l'ajout de documents
    setInterval(checkValidation, 500);
    
    // Vérification initiale
    setTimeout(checkValidation, 200);
});
</script>