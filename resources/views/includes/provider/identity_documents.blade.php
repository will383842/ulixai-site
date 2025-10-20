<div id="step11" class="hidden space-y-6">
  <h2 class="text-blue-900 font-bold text-xl mb-2">MY IDENTITY DOCUMENTS</h2>
  <p class="text-sm text-blue-600 mb-6">Click on the document you are going to send us</p>

  <div class="space-y-4">
    <button onclick="openDocumentModal('european_id')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
      European identity card
    </button>
    <button onclick="openDocumentModal('passport')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
      Passport
    </button>
    <button onclick="openDocumentModal('license')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
      Driver’s license
    </button>
  </div>

  <div class="flex justify-between items-center mt-6">
    <button id="backToStep10" class="text-blue-600 font-medium"> Back</button>
    <button id="nextStep11" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full" disabled>Next</button>
  </div>
  <div class="mt-6">
    <div class="w-full h-2 rounded-full overflow-hidden">
    </div>
  </div>
</div>

<!-- European Identity Card Modal -->
<div id="modal-european_id" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl p-8 shadow-xl w-full max-w-xl relative">
    <h3 class="text-xl font-bold mb-6 text-blue-900">I SEND MY IDENTITY CARD</h3>
    <div class="flex justify-center gap-8 mb-8">
      <div class="flex flex-col items-center">
        <span class="mb-2 text-blue-700 font-semibold">Front</span>
        <label class="flex flex-col items-center justify-center border-2 border-blue-200 rounded-xl w-48 h-48 cursor-pointer hover:border-blue-400 transition">
          <input type="file" accept="image/*" id="upload-european_id-front" class="hidden" />
          <div id="preview-european_id-front" class="flex flex-col items-center">
            <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
            <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
          </div>
        </label>
      </div>
      <div class="flex flex-col items-center">
        <span class="mb-2 text-blue-700 font-semibold">Back</span>
        <label class="flex flex-col items-center justify-center border-2 border-blue-200 rounded-xl w-48 h-48 cursor-pointer hover:border-blue-400 transition">
          <input type="file" accept="image/*" id="upload-european_id-back" class="hidden" />
          <div id="preview-european_id-back" class="flex flex-col items-center">
            <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
            <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
          </div>
        </label>
      </div>
    </div>
    <div class="flex justify-between items-center mt-6">
      <button onclick="closeDocumentModal('european_id')" class="text-blue-600 font-semibold">BACK</button>
      <button id="next-european_id" onclick="saveDocument('european_id')" class="bg-blue-500 text-white font-semibold px-8 py-2 rounded-full disabled:opacity-50" disabled>NEXT</button>
    </div>
    <div class="w-full mt-6">
      <div class="h-2 rounded-full bg-blue-100">
        <div class="h-full bg-blue-400 rounded-full" style="width: 65%;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Passport Modal -->
<div id="modal-passport" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl p-8 shadow-xl w-full max-w-xl relative">
    <h3 class="text-xl font-bold mb-6 text-blue-900">I SEND MY PASSPORT</h3>
    <div class="flex justify-center mb-8">
      <div class="flex flex-col items-center">
        <label class="flex flex-col items-center justify-center border-2 border-blue-200 rounded-xl w-48 h-48 cursor-pointer hover:border-blue-400 transition">
          <input type="file" accept="image/*" id="upload-passport-front" class="hidden" />
          <div id="preview-passport-front" class="flex flex-col items-center">
            <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
            <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
          </div>
        </label>
      </div>
    </div>
    <div class="flex justify-between items-center mt-6">
      <button onclick="closeDocumentModal('passport')" class="text-blue-600 font-semibold">BACK</button>
      <button id="next-passport" onclick="saveDocument('passport')" class="bg-blue-500 text-white font-semibold px-8 py-2 rounded-full disabled:opacity-50" disabled>NEXT</button>
    </div>
    <div class="w-full mt-6">
      <div class="h-2 rounded-full bg-blue-100">
        <div class="h-full bg-blue-400 rounded-full" style="width: 65%;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Driver's License Modal -->
<div id="modal-license" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-xl p-8 shadow-xl w-full max-w-xl relative">
    <h3 class="text-xl font-bold mb-6 text-blue-900">I SEND MY DRIVER'S LICENCE</h3>
    <div class="flex justify-center gap-8 mb-8">
      <div class="flex flex-col items-center">
        <span class="mb-2 text-blue-700 font-semibold">Front</span>
        <label class="flex flex-col items-center justify-center border-2 border-blue-200 rounded-xl w-48 h-48 cursor-pointer hover:border-blue-400 transition">
          <input type="file" accept="image/*" id="upload-license-front" class="hidden" />
          <div id="preview-license-front" class="flex flex-col items-center">
            <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
            <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
          </div>
        </label>
      </div>
      <div class="flex flex-col items-center">
        <span class="mb-2 text-blue-700 font-semibold">Back</span>
        <label class="flex flex-col items-center justify-center border-2 border-blue-200 rounded-xl w-48 h-48 cursor-pointer hover:border-blue-400 transition">
          <input type="file" accept="image/*" id="upload-license-back" class="hidden" />
          <div id="preview-license-back" class="flex flex-col items-center">
            <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
            <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
          </div>
        </label>
      </div>
    </div>
    <div class="flex justify-between items-center mt-6">
      <button onclick="closeDocumentModal('license')" class="text-blue-600 font-semibold">BACK</button>
      <button id="next-license" onclick="saveDocument('license')" class="bg-blue-500 text-white font-semibold px-8 py-2 rounded-full disabled:opacity-50" disabled>NEXT</button>
    </div>
    <div class="w-full mt-6">
      <div class="h-2 rounded-full bg-blue-100">
        <div class="h-full bg-blue-400 rounded-full" style="width: 65%;"></div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  // Helpers
  const qs  = (id) => document.getElementById(id);
  const show = (el) => el && el.classList.remove('hidden');
  const hide = (el) => el && el.classList.add('hidden');

  // Make sure your modals sit above everything else
  ['modal-european_id','modal-passport','modal-license'].forEach(id => {
    const m = qs(id);
    if (m && !m.className.includes('z-')) m.classList.add('z-[9999]');
  });

  // Keep your existing resetPreview/setNextButtonState/updateStep11NextButton
  // (we call them below if present)
  function safe(fnName, ...args) {
    if (typeof window[fnName] === 'function') return window[fnName](...args);
  }

  function openDocumentModal(type) {
    ['european_id', 'passport', 'license'].forEach(t => hide(qs('modal-' + t)));
    const modal = qs('modal-' + type);
    if (!modal) return console.warn('Modal not found:', type);

    show(modal);
    document.body.classList.add('overflow-hidden'); // prevent background scroll
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');

    // Focus the first file input for accessibility
    const firstInput = modal.querySelector('input[type="file"]');
    if (firstInput) firstInput.focus();
  }

  function closeDocumentModal(type) {
    const modal = qs('modal-' + type);
    hide(modal);
    document.body.classList.remove('overflow-hidden');

    // Clear inputs + previews exactly like your old function
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

  // Close on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    ['european_id','passport','license'].forEach(t => {
      const m = qs('modal-' + t);
      if (m && !m.classList.contains('hidden')) closeDocumentModal(t);
    });
  });

  // Close on backdrop click
  ['european_id','passport','license'].forEach(t => {
    const m = qs('modal-' + t);
    if (!m) return;
    m.addEventListener('click', (e) => {
      if (e.target === m) closeDocumentModal(t);
    });
  });

  // EXPOSE globally for your inline onclick="..."
  window.openDocumentModal  = openDocumentModal;
  window.closeDocumentModal = closeDocumentModal;
})();
</script>

<script>
/* ========= helpers ========= */
function idParts(inputId) {
  // "upload-european_id-front" -> {type:"european_id", side:"front"}
  const m = inputId.match(/^upload-([^-\s]+)(?:-(front|back))?$/);
  return m ? { type: m[1], side: m[2] || 'front' } : null;
}
function previewBoxId(type, side) { return `preview-${type}-${side}`; }
function nextBtnId(type)          { return `next-${type}`; }
function isTwoSided(type)         { return (type === 'european_id' || type === 'license'); }

function renderPreview(el, dataUrl) {
  el.innerHTML = `<img src="${dataUrl}" class="w-full h-40 object-contain rounded shadow" alt="preview"/>`;
}
function resetPreview(type, side) {
  const box = document.getElementById(previewBoxId(type, side));
  if (!box) return;
  box.innerHTML = `
    <i class="fa-regular fa-image text-4xl text-blue-300 mb-2"></i>
    <span class="border border-blue-200 rounded-full px-4 py-1 text-blue-600 text-sm bg-blue-50">Upload photo</span>
  `;
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

/* ========= event delegation for ALL file inputs ========= */
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
  // optional safety: only images
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
  };
  reader.readAsDataURL(file);
});

/* ========= store + advance ========= */
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

/* ========= expose globals needed by your HTML ========= */
window.saveDocument = saveDocument;
window.resetPreview = resetPreview;           // used by your closeModal
window.setNextButtonState = setNextButtonState;
window.updateStep11NextButton = updateStep11NextButton;

/* ========= initial state ========= */
document.addEventListener('DOMContentLoaded', updateStep11NextButton);
</script>
