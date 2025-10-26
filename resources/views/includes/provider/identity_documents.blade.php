<div id="step11" class="hidden">
  <style>
    .doc-btn {
      transition: all 0.3s ease;
    }
    .doc-btn:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 35px rgba(99, 102, 241, 0.3);
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
      border-color: rgb(99, 102, 241);
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

  <!-- Header moderne -->
  <div class="mb-8 text-center">
    <h2 class="text-4xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
      🆔 Identity Documents
    </h2>
    <p class="text-gray-500 text-base">Upload at least one document <span class="text-red-600 font-bold">(Required)</span></p>
  </div>

  <!-- Sélection des documents -->
  <div class="space-y-4 mb-8">
    <button onclick="openDocumentModal('european_id')" class="doc-btn w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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

    <button onclick="openDocumentModal('passport')" class="doc-btn w-full bg-gradient-to-r from-purple-500 to-pink-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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

    <button onclick="openDocumentModal('license')" class="doc-btn w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold py-5 px-6 rounded-2xl shadow-lg flex items-center justify-between group">
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
  <div class="flex justify-between items-center pt-6 border-t-2 border-gray-100">
    <button 
      id="backToStep10" 
      class="group flex items-center space-x-2 text-gray-600 hover:text-purple-600 font-bold text-lg transition-all"
    >
      <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      <span>Back</span>
    </button>
    
    <button 
      id="nextStep11" 
      class="group bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:scale-100"
      disabled
    >
      <span>Continue</span>
      <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>
  </div>
</div>

<!-- Modal European ID -->
<div id="modal-european_id" class="modal-backdrop fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center hidden">
  <div class="bg-white rounded-3xl p-8 shadow-2xl w-full max-w-4xl relative max-h-[90vh] overflow-y-auto">
    <h3 class="text-3xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-8 text-center">
      🪪 Identity Card
    </h3>
    <div class="grid grid-cols-2 gap-6 mb-8">
      <!-- Front -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Front Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-european_id-front" class="hidden" />
            <div id="preview-european_id-front" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-indigo-100 text-indigo-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('european_id', 'front')" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('european_id', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-european_id-front">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-front" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('european_id', 'front')" class="hidden w-full bg-red-500 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-european_id-front">
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
              <span class="bg-indigo-100 text-indigo-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('european_id', 'back')" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('european_id', 'back')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-european_id-back">
              🔄 Retake
            </button>
          </div>
          <video id="camera-european_id-back" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('european_id', 'back')" class="hidden w-full bg-red-500 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-european_id-back">
            📸 Capture
          </button>
        </div>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="closeDocumentModal('european_id')" class="text-gray-600 hover:text-indigo-600 font-bold text-lg">← Back</button>
      <button id="next-european_id" onclick="saveDocument('european_id')" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold px-10 py-3 rounded-2xl disabled:opacity-40" disabled>Save & Continue</button>
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
        <label class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-72 cursor-pointer bg-gray-50 mb-3">
          <input type="file" accept="image/*" id="upload-passport-front" class="hidden" />
          <div id="preview-passport-front" class="flex flex-col items-center">
            <div class="text-7xl mb-4">📖</div>
            <span class="bg-purple-100 text-purple-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
          </div>
        </label>
        <div class="flex gap-2 w-full">
          <button onclick="openCamera('passport', 'front')" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
            📸 Take Photo
          </button>
          <button onclick="retakePhoto('passport', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-passport-front">
            🔄 Retake
          </button>
        </div>
        <video id="camera-passport-front" class="hidden w-full h-72 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
        <button onclick="capturePhoto('passport', 'front')" class="hidden w-full bg-red-500 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-passport-front">
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
    <h3 class="text-3xl font-black bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-8 text-center">
      🚗 Driver's License
    </h3>
    <div class="grid grid-cols-2 gap-6 mb-8">
      <!-- Front -->
      <div class="flex flex-col items-center">
        <span class="mb-3 text-gray-700 font-bold text-lg">Front Side</span>
        <div class="w-full">
          <label onclick="event.preventDefault(); closeCameraBeforeUpload(this);" class="upload-zone flex flex-col items-center justify-center border-4 border-dashed border-gray-300 rounded-3xl w-full h-64 cursor-pointer bg-gray-50 mb-3">
            <input type="file" accept="image/*" id="upload-license-front" class="hidden" />
            <div id="preview-license-front" class="flex flex-col items-center">
              <div class="text-6xl mb-4">📄</div>
              <span class="bg-green-100 text-green-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('license', 'front')" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('license', 'front')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-license-front">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-front" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('license', 'front')" class="hidden w-full bg-red-500 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-license-front">
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
              <span class="bg-green-100 text-green-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
            </div>
          </label>
          <div class="flex gap-2">
            <button onclick="openCamera('license', 'back')" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl font-semibold text-sm">
              📸 Take Photo
            </button>
            <button onclick="retakePhoto('license', 'back')" class="hidden flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-xl font-semibold text-sm" id="retake-license-back">
              🔄 Retake
            </button>
          </div>
          <video id="camera-license-back" class="hidden w-full h-64 rounded-2xl mt-3 border-4 border-green-400" autoplay></video>
          <button onclick="capturePhoto('license', 'back')" class="hidden w-full bg-red-500 text-white px-4 py-3 rounded-xl font-bold mt-2" id="capture-license-back">
            📸 Capture
          </button>
        </div>
      </div>
    </div>
    <div class="flex justify-between items-center">
      <button onclick="closeDocumentModal('license')" class="text-gray-600 hover:text-green-600 font-bold text-lg">← Back</button>
      <button id="next-license" onclick="saveDocument('license')" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold px-10 py-3 rounded-2xl disabled:opacity-40" disabled>Save & Continue</button>
    </div>
  </div>
</div>

<script>
// Camera streams storage
const cameraStreams = {};

function openCamera(type, side) {
  const videoId = `camera-${type}-${side}`;
  const captureId = `capture-${type}-${side}`;
  const video = document.getElementById(videoId);
  const captureBtn = document.getElementById(captureId);
  
  video.classList.remove('hidden');
  captureBtn.classList.remove('hidden');
  
  navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
    .then((stream) => {
      video.srcObject = stream;
      cameraStreams[`${type}-${side}`] = stream;
    })
    .catch((err) => {
      alert('Unable to access camera: ' + err.message);
      console.error(err);
    });
}

function capturePhoto(type, side) {
  const videoId = `camera-${type}-${side}`;
  const video = document.getElementById(videoId);
  const canvas = document.createElement('canvas');
  
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0);
  
  const dataUrl = canvas.toDataURL('image/jpeg');
  
  // Stop camera
  stopCamera(type, side);
  
  // Show preview
  const previewBox = document.getElementById(`preview-${type}-${side}`);
  renderPreview(previewBox, dataUrl);
  
  // Store in hidden input (simulate file upload)
  const input = document.getElementById(`upload-${type}-${side}`);
  fetch(dataUrl)
    .then(res => res.blob())
    .then(blob => {
      const file = new File([blob], `${type}-${side}.jpg`, { type: 'image/jpeg' });
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      input.files = dataTransfer.files;
      
      // Trigger change event
      const event = new Event('change', { bubbles: true });
      input.dispatchEvent(event);
      
      // AUTO-SAVE dans localStorage immédiatement
      autoSavePhoto(type, side, dataUrl);
    });
  
  // Show retake button
  document.getElementById(`retake-${type}-${side}`).classList.remove('hidden');
}

function stopCamera(type, side) {
  try {
    const streamKey = `${type}-${side}`;
    if (cameraStreams[streamKey]) {
      cameraStreams[streamKey].getTracks().forEach(track => track.stop());
      delete cameraStreams[streamKey];
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
  } catch(e) {
    console.warn('Error in stopCamera:', e);
  }
}

function closeCameraBeforeUpload(labelElement) {
  // Trouver le type et side depuis l'input dans le label
  const input = labelElement.querySelector('input[type="file"]');
  if (input && input.id) {
    const match = input.id.match(/upload-([^-]+)-([^-]+)/);
    if (match) {
      const type = match[1];
      const side = match[2];
      stopCamera(type, side);
    }
  }
}

function retakePhoto(type, side) {
  resetPreview(type, side);
  document.getElementById(`upload-${type}-${side}`).value = '';
  document.getElementById(`retake-${type}-${side}`).classList.add('hidden');
  
  // Supprimer du localStorage immédiatement
  let expats = JSON.parse(localStorage.getItem('expats')) || {};
  if (expats.documents && expats.documents[type]) {
    if (isTwoSided(type)) {
      // Supprimer juste le côté concerné
      delete expats.documents[type][side];
      // Si les 2 côtés sont vides, supprimer le document entier
      if (!expats.documents[type].front && !expats.documents[type].back) {
        delete expats.documents[type];
      }
    } else {
      // Document simple (passport), supprimer complètement
      delete expats.documents[type];
    }
    localStorage.setItem('expats', JSON.stringify(expats));
    updateStep11NextButton();
  }
  
  setNextStateForType(type);
}

(function () {
  const qs  = (id) => document.getElementById(id);
  const show = (el) => el && el.classList.remove('hidden');
  const hide = (el) => el && el.classList.add('hidden');

  ['modal-european_id','modal-passport','modal-license'].forEach(id => {
    const m = qs(id);
    if (m && !m.className.includes('z-')) m.classList.add('z-[9999]');
  });

  function safe(fnName, ...args) {
    if (typeof window[fnName] === 'function') return window[fnName](...args);
  }

  function openDocumentModal(type) {
    ['european_id', 'passport', 'license'].forEach(t => hide(qs('modal-' + t)));
    const modal = qs('modal-' + type);
    if (!modal) return console.warn('Modal not found:', type);

    show(modal);
    document.body.classList.add('overflow-hidden');
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');

    const firstInput = modal.querySelector('input[type="file"]');
    if (firstInput) firstInput.focus();
  }

  function closeDocumentModal(type) {
    const modal = qs('modal-' + type);
    hide(modal);
    document.body.classList.remove('overflow-hidden');
    
    // Stop all cameras for this type AVANT de réinitialiser (avec protection)
    try {
      if (type === 'european_id' || type === 'license') {
        ['front', 'back'].forEach(side => {
          stopCamera(type, side);
        });
      } else {
        stopCamera(type, 'front');
      }
    } catch(e) {
      console.warn('Error stopping camera:', e);
    }

    if (type === 'european_id' || type === 'license') {
      ['front', 'back'].forEach(side => {
        const inp = qs('upload-' + type + '-' + side);
        if (inp) inp.value = '';
        safe('resetPreview', type, side);
      });
    } else {
      const inp = qs('upload-' + type + '-front');
      if (inp) inp.value = '';
      safe('resetPreview', type, 'front');
    }

    safe('setNextButtonState', type, false);
    safe('updateStep11NextButton');
  }

  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    ['european_id','passport','license'].forEach(t => {
      const m = qs('modal-' + t);
      if (m && !m.classList.contains('hidden')) closeDocumentModal(t);
    });
  });

  ['european_id','passport','license'].forEach(t => {
    const m = qs('modal-' + t);
    if (!m) return;
    m.addEventListener('click', (e) => {
      if (e.target === m) closeDocumentModal(t);
    });
  });

  window.openDocumentModal  = openDocumentModal;
  window.closeDocumentModal = closeDocumentModal;
})();
</script>

<script>
function idParts(inputId) {
  const m = inputId.match(/^upload-([^-\s]+)(?:-(front|back))?$/);
  return m ? { type: m[1], side: m[2] || 'front' } : null;
}
function previewBoxId(type, side) { return `preview-${type}-${side}`; }
function nextBtnId(type)          { return `next-${type}`; }
function isTwoSided(type)         { return (type === 'european_id' || type === 'license'); }

function renderPreview(el, dataUrl) {
  el.innerHTML = `<img src="${dataUrl}" class="w-full h-full object-cover rounded-2xl shadow-lg" alt="preview"/>`;
  el.closest('.upload-zone').classList.add('has-file');
}
function resetPreview(type, side) {
  const box = document.getElementById(previewBoxId(type, side));
  if (!box) return;
  const colors = {
    european_id: 'indigo',
    passport: 'purple',
    license: 'green'
  };
  const color = colors[type] || 'indigo';
  const emojis = {
    european_id: '📄',
    passport: '📖',
    license: '📄'
  };
  const emoji = emojis[type] || '📄';
  box.innerHTML = `
    <div class="text-6xl mb-4">${emoji}</div>
    <span class="bg-${color}-100 text-${color}-700 rounded-full px-6 py-2 text-sm font-bold">Upload Photo</span>
  `;
  box.closest('.upload-zone').classList.remove('has-file');
}

function setNextButtonState(type, enabled) {
  const btn = document.getElementById(nextBtnId(type));
  if (btn) btn.disabled = !enabled;
}
function setNextStateForType(type) {
  if (isTwoSided(type)) {
    const front = document.getElementById(`upload-${type}-front`);
    const back  = document.getElementById(`upload-${type}-back`);
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
    // Show retake button
    document.getElementById(`retake-${type}-${side}`).classList.remove('hidden');
    
    // AUTO-SAVE dans localStorage immédiatement
    autoSavePhoto(type, side, ev.target.result);
  };
  reader.readAsDataURL(file);
});

function hasAnyDocument() {
  const expats = JSON.parse(localStorage.getItem('expats')) || {};
  const docs = expats.documents || {};
  return !!(docs.passport || docs.european_id || docs.license);
}
function updateStep11NextButton() {
  const btn = document.getElementById('nextStep11');
  if (btn) btn.disabled = !hasAnyDocument();
}
function advanceFromStep11() {
  if (typeof goToStep === 'function') { try { goToStep(12); return; } catch(e){} }
  const mainNext = document.getElementById('nextStep11');
  if (mainNext) { mainNext.disabled = false; mainNext.click(); return; }
  const s11 = document.getElementById('step11');
  const s12 = document.getElementById('step12');
  if (s11 && s12) { s11.classList.add('hidden'); s12.classList.remove('hidden'); }
}

function saveDocument(type) {
  let expats = JSON.parse(localStorage.getItem('expats')) || {};
  expats.documents = expats.documents || {};

  const finish = () => {
    localStorage.setItem('expats', JSON.stringify(expats));
    if (typeof closeDocumentModal === 'function') closeDocumentModal(type);
    updateStep11NextButton();
    advanceFromStep11();
  };

  if (isTwoSided(type)) {
    const front = document.getElementById(`upload-${type}-front`);
    const back  = document.getElementById(`upload-${type}-back`);
    if (!front?.files?.[0] || !back?.files?.[0]) {
      alert('Please upload both front and back images.');
      return;
    }
    const rf = new FileReader(), rb = new FileReader();
    rf.onload = (evF) => {
      rb.onload = (evB) => {
        expats.documents[type] = {
          front: evF.target.result,
          back : evB.target.result,
          uploaded_at: new Date().toISOString()
        };
        finish();
      };
      rb.readAsDataURL(back.files[0]);
    };
    rf.readAsDataURL(front.files[0]);
  } else {
    const one = document.getElementById(`upload-${type}-front`);
    if (!one?.files?.[0]) {
      alert('Please upload your passport image.');
      return;
    }
    const r = new FileReader();
    r.onload = (ev) => {
      expats.documents[type] = {
        image: ev.target.result,
        uploaded_at: new Date().toISOString()
      };
      finish();
    };
    r.readAsDataURL(one.files[0]);
  }
}

// AUTO-SAVE photo immédiatement dans localStorage
function autoSavePhoto(type, side, dataUrl) {
  let expats = JSON.parse(localStorage.getItem('expats')) || {};
  expats.documents = expats.documents || {};
  
  if (isTwoSided(type)) {
    // Document 2 faces (ID, license)
    if (!expats.documents[type]) {
      expats.documents[type] = {};
    }
    expats.documents[type][side] = dataUrl;
    expats.documents[type].uploaded_at = new Date().toISOString();
  } else {
    // Document simple (passport)
    expats.documents[type] = {
      image: dataUrl,
      uploaded_at: new Date().toISOString()
    };
  }
  
  localStorage.setItem('expats', JSON.stringify(expats));
  updateStep11NextButton();
}

window.saveDocument = saveDocument;
window.resetPreview = resetPreview;
window.setNextButtonState = setNextButtonState;
window.updateStep11NextButton = updateStep11NextButton;
window.openCamera = openCamera;
window.capturePhoto = capturePhoto;
window.retakePhoto = retakePhoto;
window.stopCamera = stopCamera;
window.closeCameraBeforeUpload = closeCameraBeforeUpload;

document.addEventListener('DOMContentLoaded', updateStep11NextButton);

// CRITIQUE: Arrêter TOUTES les caméras quand on quitte la page ou change de step
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

// Arrêter caméras si step11 devient hidden
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