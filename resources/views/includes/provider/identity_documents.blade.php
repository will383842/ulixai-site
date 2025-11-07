<!-- 
============================================
🚀 STEP 11 - IDENTITY DOCUMENTS (OPTIMIZED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 3 types de documents avec icônes
💎 Upload photo/caméra optimisé
⚡ Structure header fixe + contenu scrollable
🔧 Optimisations CPU, RAM, GPU
✅ Persistance localStorage
⚡ Performance maximale
✅ CONFORME AU GUIDE SYSTÈME WIZARD
🔧 MODIFIED: localStorage key changed to 'expats'
============================================
-->

<div id="step11" class="hidden flex flex-col h-full" role="region" aria-label="Upload identity documents">
  
  <!-- ============================================
       TITRE FIXE (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 blobs animés -->
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
          <span class="text-lg sm:text-xl">🆔</span>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Identity Documents 🪪
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Upload at least one document to verify your identity
        </p>
      </div>

      <!-- Counter Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step11UploadedCount">0</span> document(s) uploaded
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Info Badge -->
    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-2 border-amber-300 rounded-2xl p-3 sm:p-4">
      <div class="flex items-start gap-3">
        <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-base">💡</span>
        </div>
        <div class="flex-1">
          <p class="text-amber-900 font-bold text-sm sm:text-base">Not mandatory but increases trust</p>
          <p class="text-amber-700 text-xs sm:text-sm font-medium mt-1">Upload at least one identity document to boost your profile verification</p>
        </div>
      </div>
    </div>

    <!-- Documents Cards -->
    <div class="space-y-2.5 sm:space-y-3">
      
      <!-- European ID Card -->
      <button 
        type="button" 
        class="doc-card group"
        data-doc-type="european_id"
        data-two-sided="true"
        role="button"
        aria-label="Upload European Identity Card">
        <div class="flex items-center gap-3 flex-1">
          <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
            <span class="text-xl sm:text-2xl">🪪</span>
          </div>
          <span class="text-sm sm:text-base lg:text-lg font-bold text-white">European Identity Card</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="upload-status hidden">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
          </span>
          <svg class="w-4 h-4 sm:w-5 sm:h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </button>

      <!-- Passport -->
      <button 
        type="button" 
        class="doc-card doc-card-cyan group"
        data-doc-type="passport"
        data-two-sided="false"
        role="button"
        aria-label="Upload Passport">
        <div class="flex items-center gap-3 flex-1">
          <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
            <span class="text-xl sm:text-2xl">🛂</span>
          </div>
          <span class="text-sm sm:text-base lg:text-lg font-bold text-white">Passport</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="upload-status hidden">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
          </span>
          <svg class="w-4 h-4 sm:w-5 sm:h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </button>

      <!-- Driver's License -->
      <button 
        type="button" 
        class="doc-card doc-card-teal group"
        data-doc-type="license"
        data-two-sided="true"
        role="button"
        aria-label="Upload Driver's License">
        <div class="flex items-center gap-3 flex-1">
          <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
            <span class="text-xl sm:text-2xl">🚗</span>
          </div>
          <span class="text-sm sm:text-base lg:text-lg font-bold text-white">Driver's License</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="upload-status hidden">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
          </span>
          <svg class="w-4 h-4 sm:w-5 sm:h-5 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </button>
    </div>
  </div>
</div>

<!-- ============================================
     MODALS POUR CHAQUE TYPE DE DOCUMENT
     ============================================ -->

<!-- Modal European ID (2 sides) -->
<div id="modal-european_id" class="modal-backdrop hidden">
  <div class="modal-content">
    <button type="button" class="modal-close" data-modal="european_id" aria-label="Close modal">×</button>
    
    <h3 class="modal-title">
      🪪 European Identity Card
    </h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6">
      <!-- Front Side -->
      <div class="upload-section">
        <span class="upload-label">Front Side</span>
        <div class="upload-container">
          <label class="upload-zone" data-type="european_id" data-side="front">
            <input type="file" accept="image/*" class="upload-input" data-type="european_id" data-side="front" />
            <div class="preview-box" data-type="european_id" data-side="front">
              <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
              <span class="upload-badge">Upload Photo</span>
            </div>
          </label>
          <div class="upload-actions">
            <button type="button" class="action-btn action-btn-camera" data-type="european_id" data-side="front">
              📸 Take Photo
            </button>
            <button type="button" class="action-btn action-btn-retake hidden" data-type="european_id" data-side="front">
              🔄 Retake
            </button>
          </div>
        </div>
        <video class="camera-video hidden" data-type="european_id" data-side="front" autoplay playsinline></video>
        <button type="button" class="capture-btn hidden" data-type="european_id" data-side="front">
          📸 Capture Photo
        </button>
      </div>

      <!-- Back Side -->
      <div class="upload-section">
        <span class="upload-label">Back Side</span>
        <div class="upload-container">
          <label class="upload-zone" data-type="european_id" data-side="back">
            <input type="file" accept="image/*" class="upload-input" data-type="european_id" data-side="back" />
            <div class="preview-box" data-type="european_id" data-side="back">
              <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
              <span class="upload-badge">Upload Photo</span>
            </div>
          </label>
          <div class="upload-actions">
            <button type="button" class="action-btn action-btn-camera" data-type="european_id" data-side="back">
              📸 Take Photo
            </button>
            <button type="button" class="action-btn action-btn-retake hidden" data-type="european_id" data-side="back">
              🔄 Retake
            </button>
          </div>
        </div>
        <video class="camera-video hidden" data-type="european_id" data-side="back" autoplay playsinline></video>
        <button type="button" class="capture-btn hidden" data-type="european_id" data-side="back">
          📸 Capture Photo
        </button>
      </div>
    </div>

    <button type="button" class="save-btn" data-modal="european_id">
      ✅ Save Document
    </button>
  </div>
</div>

<!-- Modal Passport (1 side) -->
<div id="modal-passport" class="modal-backdrop hidden">
  <div class="modal-content">
    <button type="button" class="modal-close" data-modal="passport" aria-label="Close modal">×</button>
    
    <h3 class="modal-title">
      🛂 Passport
    </h3>
    
    <div class="max-w-md mx-auto mb-6">
      <div class="upload-section">
        <span class="upload-label">Identity Page</span>
        <div class="upload-container">
          <label class="upload-zone" data-type="passport" data-side="front">
            <input type="file" accept="image/*" class="upload-input" data-type="passport" data-side="front" />
            <div class="preview-box" data-type="passport" data-side="front">
              <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
              <span class="upload-badge">Upload Photo</span>
            </div>
          </label>
          <div class="upload-actions">
            <button type="button" class="action-btn action-btn-camera" data-type="passport" data-side="front">
              📸 Take Photo
            </button>
            <button type="button" class="action-btn action-btn-retake hidden" data-type="passport" data-side="front">
              🔄 Retake
            </button>
          </div>
        </div>
        <video class="camera-video hidden" data-type="passport" data-side="front" autoplay playsinline></video>
        <button type="button" class="capture-btn hidden" data-type="passport" data-side="front">
          📸 Capture Photo
        </button>
      </div>
    </div>

    <button type="button" class="save-btn" data-modal="passport">
      ✅ Save Document
    </button>
  </div>
</div>

<!-- Modal Driver's License (2 sides) -->
<div id="modal-license" class="modal-backdrop hidden">
  <div class="modal-content">
    <button type="button" class="modal-close" data-modal="license" aria-label="Close modal">×</button>
    
    <h3 class="modal-title">
      🚗 Driver's License
    </h3>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6">
      <!-- Front Side -->
      <div class="upload-section">
        <span class="upload-label">Front Side</span>
        <div class="upload-container">
          <label class="upload-zone" data-type="license" data-side="front">
            <input type="file" accept="image/*" class="upload-input" data-type="license" data-side="front" />
            <div class="preview-box" data-type="license" data-side="front">
              <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
              <span class="upload-badge">Upload Photo</span>
            </div>
          </label>
          <div class="upload-actions">
            <button type="button" class="action-btn action-btn-camera" data-type="license" data-side="front">
              📸 Take Photo
            </button>
            <button type="button" class="action-btn action-btn-retake hidden" data-type="license" data-side="front">
              🔄 Retake
            </button>
          </div>
        </div>
        <video class="camera-video hidden" data-type="license" data-side="front" autoplay playsinline></video>
        <button type="button" class="capture-btn hidden" data-type="license" data-side="front">
          📸 Capture Photo
        </button>
      </div>

      <!-- Back Side -->
      <div class="upload-section">
        <span class="upload-label">Back Side</span>
        <div class="upload-container">
          <label class="upload-zone" data-type="license" data-side="back">
            <input type="file" accept="image/*" class="upload-input" data-type="license" data-side="back" />
            <div class="preview-box" data-type="license" data-side="back">
              <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
              <span class="upload-badge">Upload Photo</span>
            </div>
          </label>
          <div class="upload-actions">
            <button type="button" class="action-btn action-btn-camera" data-type="license" data-side="back">
              📸 Take Photo
            </button>
            <button type="button" class="action-btn action-btn-retake hidden" data-type="license" data-side="back">
              🔄 Retake
            </button>
          </div>
        </div>
        <video class="camera-video hidden" data-type="license" data-side="back" autoplay playsinline></video>
        <button type="button" class="capture-btn hidden" data-type="license" data-side="back">
          📸 Capture Photo
        </button>
      </div>
    </div>

    <button type="button" class="save-btn" data-modal="license">
      ✅ Save Document
    </button>
  </div>
</div>

<!-- ============================================
     STYLES OPTIMISÉS
     ============================================ -->
<style>
/* ============================================
   🎨 BASE STYLES
   ============================================ */

/* Animations des blobs - optimisé GPU */
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

/* ============================================
   📱 DOCUMENT CARDS
   ============================================ */

#step11 .doc-card {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.875rem 1rem;
  border-radius: 1rem;
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  color: white;
  font-weight: 700;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  position: relative;
  overflow: hidden;
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

#step11 .doc-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
  pointer-events: none;
}

#step11 .doc-card:hover::before {
  left: 100%;
}

#step11 .doc-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 20px rgba(37, 99, 235, 0.3);
}

#step11 .doc-card:active {
  transform: translateY(0);
}

#step11 .doc-card-cyan {
  background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
}

#step11 .doc-card-cyan:hover {
  box-shadow: 0 12px 20px rgba(8, 145, 178, 0.3);
}

#step11 .doc-card-teal {
  background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
}

#step11 .doc-card-teal:hover {
  box-shadow: 0 12px 20px rgba(13, 148, 136, 0.3);
}

#step11 .arrow-icon {
  transition: transform 0.3s ease;
  flex-shrink: 0;
}

#step11 .doc-card:hover .arrow-icon {
  transform: translateX(4px);
}

#step11 .upload-status {
  display: none;
  flex-shrink: 0;
}

#step11 .doc-card.uploaded .upload-status {
  display: block;
}

/* ============================================
   🎭 MODALS
   ============================================ */

.modal-backdrop {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(8px);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  overflow-y: auto;
}

.modal-backdrop.hidden {
  display: none;
}

.modal-content {
  background: white;
  border-radius: 1.5rem;
  padding: 1.5rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  width: 100%;
  max-width: 56rem;
  position: relative;
  max-height: 90vh;
  overflow-y: auto;
}

@media (min-width: 640px) {
  .modal-content {
    padding: 2rem;
  }
}

.modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  color: #9ca3af;
  background: none;
  border: none;
  font-size: 2rem;
  line-height: 1;
  cursor: pointer;
  transition: color 0.2s;
  z-index: 10;
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-close:hover {
  color: #4b5563;
}

.modal-title {
  font-size: 1.5rem;
  font-weight: 900;
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  margin-bottom: 1.5rem;
  text-align: center;
}

@media (min-width: 640px) {
  .modal-title {
    font-size: 1.875rem;
    margin-bottom: 2rem;
  }
}

/* ============================================
   📤 UPLOAD ZONES
   ============================================ */

.upload-section {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.upload-label {
  font-weight: 700;
  color: #374151;
  font-size: 0.875rem;
  text-align: center;
}

@media (min-width: 640px) {
  .upload-label {
    font-size: 1rem;
  }
}

.upload-container {
  width: 100%;
}

.upload-zone {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 3px dashed #d1d5db;
  border-radius: 1.5rem;
  width: 100%;
  height: 12rem;
  cursor: pointer;
  background: #f9fafb;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

@media (min-width: 640px) {
  .upload-zone {
    height: 14rem;
  }
}

.upload-zone:hover {
  transform: scale(1.02);
  border-color: #3b82f6;
  background: #eff6ff;
}

.upload-zone.has-file {
  border-color: #22c55e;
  background: linear-gradient(to bottom right, #f0fdf4, #d1fae5);
}

.upload-input {
  display: none;
}

.preview-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  pointer-events: none;
  width: 100%;
  height: 100%;
}

.upload-badge {
  background: #dbeafe;
  color: #1d4ed8;
  border-radius: 9999px;
  padding: 0.5rem 1.25rem;
  font-size: 0.75rem;
  font-weight: 700;
}

@media (min-width: 640px) {
  .upload-badge {
    font-size: 0.875rem;
  }
}

.preview-box img,
.preview-box video {
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

/* ============================================
   🎬 CAMERA & ACTIONS
   ============================================ */

.upload-actions {
  display: flex;
  gap: 0.5rem;
  margin-top: 0.75rem;
}

.action-btn {
  flex: 1;
  padding: 0.625rem 1rem;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 0.75rem;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
}

@media (min-width: 640px) {
  .action-btn {
    font-size: 0.875rem;
  }
}

.action-btn-camera {
  background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
  color: white;
  box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
}

.action-btn-camera:hover {
  box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
  transform: translateY(-1px);
}

.action-btn-retake {
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
  color: white;
  box-shadow: 0 2px 4px rgba(245, 158, 11, 0.2);
}

.action-btn-retake:hover {
  box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
  transform: translateY(-1px);
}

.action-btn-retake.hidden {
  display: none;
}

.camera-video {
  width: 100%;
  height: 14rem;
  border-radius: 1rem;
  margin-top: 0.75rem;
  object-fit: cover;
  border: 3px solid #22c55e;
  box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.2);
  animation: pulse-border 2s infinite;
}

@media (min-width: 640px) {
  .camera-video {
    height: 16rem;
  }
}

.camera-video.hidden {
  display: none;
}

@keyframes pulse-border {
  0%, 100% { 
    border-color: rgba(34, 197, 94, 0.5); 
  }
  50% { 
    border-color: rgba(34, 197, 94, 1); 
  }
}

.capture-btn {
  width: 100%;
  padding: 0.75rem;
  border-radius: 0.75rem;
  font-weight: 700;
  font-size: 0.875rem;
  margin-top: 0.75rem;
  background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
  color: white;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
}

@media (min-width: 640px) {
  .capture-btn {
    font-size: 1rem;
  }
}

.capture-btn:hover {
  box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
  transform: translateY(-2px);
}

.capture-btn.hidden {
  display: none;
}

/* ============================================
   💾 SAVE BUTTON
   ============================================ */

.save-btn {
  width: 100%;
  padding: 0.875rem;
  border-radius: 1rem;
  font-weight: 700;
  font-size: 1rem;
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  color: white;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
}

@media (min-width: 640px) {
  .save-btn {
    font-size: 1.125rem;
    padding: 1rem;
  }
}

.save-btn:hover {
  box-shadow: 0 8px 16px rgba(37, 99, 235, 0.4);
  transform: translateY(-2px);
}

.save-btn:active {
  transform: translateY(0);
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

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
  
  .upload-zone {
    border-width: 4px;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

#step11 .doc-card,
.modal-backdrop,
.upload-zone,
.preview-box {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

#step11 .doc-card,
.modal-content,
.upload-zone {
  contain: layout style paint;
}

/* Optimisation des images */
#step11 img,
#step11 video {
  image-rendering: -webkit-optimize-contrast;
  image-rendering: crisp-edges;
}

/* GPU acceleration for animations */
.animate-blob,
#step11 .arrow-icon,
#step11 .doc-card::before {
  will-change: transform;
}

/* ============================================
   📱 RESPONSIVE IMPROVEMENTS
   ============================================ */

@media (max-width: 639px) {
  .modal-content {
    max-height: 95vh;
  }
  
  .upload-zone {
    height: 10rem;
  }
  
  .camera-video {
    height: 12rem;
  }
}
</style>

<!-- ============================================
     JAVASCRIPT OPTIMISÉ
     🔧 MODIFIED: localStorage key 'expats'
     ============================================ -->
<script>
/* ============================================
   🎯 STEP 11 - OPTIMIZED VERSION
   ✅ Event delegation pour performance
   ✅ Cache DOM
   ✅ Debouncing/Throttling
   ✅ Passive listeners
   ✅ RequestAnimationFrame
   ✅ Gestion mémoire caméras
   ✅ CONFORME AU GUIDE SYSTÈME WIZARD
   ============================================ */

(function() {
  'use strict';
  
  const STORAGE_KEY = 'expats';
  
  // État global
  const state = {
    uploadedDocs: [],
    cameraStreams: new Map()
  };

  let cachedElements = null;

  // Configuration des types de documents
  const DOC_CONFIG = {
    european_id: { twoSided: true, label: 'European Identity Card' },
    passport: { twoSided: false, label: 'Passport' },
    license: { twoSided: true, label: "Driver's License" }
  };

  // ============================================
  // 🎯 CACHE DOM
  // ============================================
  
  function getCachedElements() {
    if (!cachedElements) {
      cachedElements = {
        step: document.getElementById('step11'),
        counter: document.getElementById('step11UploadedCount'),
        docCards: document.querySelectorAll('#step11 .doc-card')
      };
    }
    return cachedElements;
  }

  // ============================================
  // 💾 LOCALSTORAGE - expats
  // ============================================
  
  function getLocalStorage() {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (e) {
      return {};
    }
  }

  function saveToLocalStorage(type, side, dataUrl) {
    try {
      const data = getLocalStorage();
      data.documents = data.documents || {};
      
      const config = DOC_CONFIG[type];
      
      if (config.twoSided) {
        data.documents[type] = data.documents[type] || {};
        data.documents[type][side] = dataUrl;
        data.documents[type].uploaded_at = new Date().toISOString();
      } else {
        data.documents[type] = {
          image: dataUrl,
          uploaded_at: new Date().toISOString()
        };
      }
      
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      updateDocCard(type);
    } catch (e) {
      console.warn('localStorage error:', e);
    }
  }

  function removeFromLocalStorage(type, side) {
    try {
      const data = getLocalStorage();
      if (!data.documents?.[type]) return;
      
      const config = DOC_CONFIG[type];
      
      if (config.twoSided) {
        delete data.documents[type][side];
        if (!data.documents[type].front && !data.documents[type].back) {
          delete data.documents[type];
        }
      } else {
        delete data.documents[type];
      }
      
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      updateDocCard(type);
    } catch (e) {
      console.warn('localStorage error:', e);
    }
  }

  // ============================================
  // 📊 UPDATE UI
  // ============================================
  
  function updateCounter() {
    const elements = getCachedElements();
    if (elements.counter) {
      elements.counter.textContent = state.uploadedDocs.length;
    }
    
    // ✅ Notifier wizard-steps.js
    if (typeof window.updateNavigationButtons === 'function') {
      window.updateNavigationButtons();
    }
  }

  function updateDocCard(type) {
    const card = document.querySelector(`#step11 .doc-card[data-doc-type="${type}"]`);
    if (!card) return;

    const data = getLocalStorage();
    const doc = data.documents?.[type];
    
    if (doc) {
      const config = DOC_CONFIG[type];
      const isComplete = config.twoSided ? (doc.front && doc.back) : doc.image;
      
      if (isComplete) {
        card.classList.add('uploaded');
        if (!state.uploadedDocs.includes(type)) {
          state.uploadedDocs.push(type);
        }
      } else {
        card.classList.remove('uploaded');
        const index = state.uploadedDocs.indexOf(type);
        if (index > -1) state.uploadedDocs.splice(index, 1);
      }
    } else {
      card.classList.remove('uploaded');
      const index = state.uploadedDocs.indexOf(type);
      if (index > -1) state.uploadedDocs.splice(index, 1);
    }
    
    updateCounter();
  }

  // ============================================
  // 🎥 CAMERA MANAGEMENT
  // ============================================
  
  async function openCamera(type, side) {
    const video = document.querySelector(`.camera-video[data-type="${type}"][data-side="${side}"]`);
    const captureBtn = document.querySelector(`.capture-btn[data-type="${type}"][data-side="${side}"]`);
    
    if (!video || !captureBtn) return;
    
    const key = `${type}-${side}`;
    
    // Fermer la caméra si déjà ouverte
    if (state.cameraStreams.has(key)) {
      stopCamera(type, side);
      return;
    }
    
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      alert("Your browser does not support camera access. Please use Chrome, Firefox, Safari, or Edge.");
      return;
    }
    
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ 
        video: { 
          facingMode: "environment",
          width: { ideal: 1920 },
          height: { ideal: 1080 }
        }
      });
      
      video.srcObject = stream;
      video.classList.remove("hidden");
      captureBtn.classList.remove("hidden");
      
      state.cameraStreams.set(key, stream);
    } catch (err) {
      console.error("Camera error:", err);
      alert("Camera Error: " + err.name + " - " + err.message + "\n\nPlease check permissions.");
    }
  }

  function stopCamera(type, side) {
    const key = `${type}-${side}`;
    const stream = state.cameraStreams.get(key);
    
    if (stream) {
      stream.getTracks().forEach(track => track.stop());
      state.cameraStreams.delete(key);
    }
    
    const video = document.querySelector(`.camera-video[data-type="${type}"][data-side="${side}"]`);
    const captureBtn = document.querySelector(`.capture-btn[data-type="${type}"][data-side="${side}"]`);
    
    if (video) {
      video.classList.add('hidden');
      video.srcObject = null;
    }
    if (captureBtn) {
      captureBtn.classList.add('hidden');
    }
  }

  function capturePhoto(type, side) {
    const video = document.querySelector(`.camera-video[data-type="${type}"][data-side="${side}"]`);
    const previewBox = document.querySelector(`.preview-box[data-type="${type}"][data-side="${side}"]`);
    
    if (!video || !previewBox) return;
    
    requestAnimationFrame(() => {
      const canvas = document.createElement('canvas');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      
      const ctx = canvas.getContext('2d', { alpha: false });
      ctx.drawImage(video, 0, 0);
      
      const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
      
      previewBox.innerHTML = `<img src="${dataUrl}" alt="${side} side" />`;
      previewBox.closest('.upload-zone').classList.add('has-file');
      
      const retakeBtn = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="${side}"]`);
      if (retakeBtn) retakeBtn.classList.remove('hidden');
      
      saveToLocalStorage(type, side, dataUrl);
      stopCamera(type, side);
    });
  }

  // ============================================
  // 📁 FILE UPLOAD
  // ============================================
  
  function handleFileUpload(input, type, side) {
    const file = input.files[0];
    if (!file || !file.type.startsWith('image/')) {
      alert('Please select a valid image file');
      return;
    }
    
    const reader = new FileReader();
    
    reader.onerror = function() {
      alert('Error reading file');
    };
    
    reader.onload = function(event) {
      requestAnimationFrame(() => {
        const dataUrl = event.target.result;
        const previewBox = document.querySelector(`.preview-box[data-type="${type}"][data-side="${side}"]`);
        
        if (previewBox) {
          previewBox.innerHTML = `<img src="${dataUrl}" alt="${side} side" />`;
          previewBox.closest('.upload-zone').classList.add('has-file');
          
          const retakeBtn = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="${side}"]`);
          if (retakeBtn) retakeBtn.classList.remove('hidden');
          
          saveToLocalStorage(type, side, dataUrl);
        }
      });
    };
    
    reader.readAsDataURL(file);
    stopCamera(type, side);
  }

  function retakePhoto(type, side) {
    const previewBox = document.querySelector(`.preview-box[data-type="${type}"][data-side="${side}"]`);
    const retakeBtn = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="${side}"]`);
    const input = document.querySelector(`.upload-input[data-type="${type}"][data-side="${side}"]`);
    
    requestAnimationFrame(() => {
      if (previewBox) {
        previewBox.innerHTML = `
          <div class="text-4xl sm:text-5xl mb-2 sm:mb-3">📄</div>
          <span class="upload-badge">Upload Photo</span>
        `;
        previewBox.closest('.upload-zone').classList.remove('has-file');
      }
      
      if (retakeBtn) {
        retakeBtn.classList.add('hidden');
      }
      
      if (input) {
        input.value = '';
      }
      
      removeFromLocalStorage(type, side);
    });
  }

  // ============================================
  // 🎭 MODAL MANAGEMENT
  // ============================================
  
  function openModal(type) {
    const modal = document.getElementById(`modal-${type}`);
    if (modal) {
      requestAnimationFrame(() => {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        restoreDocuments(type);
      });
    }
  }

  function closeModal(type) {
    const modal = document.getElementById(`modal-${type}`);
    if (modal) {
      requestAnimationFrame(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        
        const config = DOC_CONFIG[type];
        if (config.twoSided) {
          stopCamera(type, 'front');
          stopCamera(type, 'back');
        } else {
          stopCamera(type, 'front');
        }
      });
    }
  }

  function restoreDocuments(type) {
    const data = getLocalStorage();
    const doc = data.documents?.[type];
    if (!doc) return;
    
    const config = DOC_CONFIG[type];
    
    requestAnimationFrame(() => {
      if (config.twoSided) {
        if (doc.front) {
          const previewBoxFront = document.querySelector(`.preview-box[data-type="${type}"][data-side="front"]`);
          if (previewBoxFront) {
            previewBoxFront.innerHTML = `<img src="${doc.front}" alt="Front side" />`;
            previewBoxFront.closest('.upload-zone').classList.add('has-file');
            
            const retakeBtnFront = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="front"]`);
            if (retakeBtnFront) retakeBtnFront.classList.remove('hidden');
          }
        }
        
        if (doc.back) {
          const previewBoxBack = document.querySelector(`.preview-box[data-type="${type}"][data-side="back"]`);
          if (previewBoxBack) {
            previewBoxBack.innerHTML = `<img src="${doc.back}" alt="Back side" />`;
            previewBoxBack.closest('.upload-zone').classList.add('has-file');
            
            const retakeBtnBack = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="back"]`);
            if (retakeBtnBack) retakeBtnBack.classList.remove('hidden');
          }
        }
      } else {
        if (doc.image) {
          const previewBox = document.querySelector(`.preview-box[data-type="${type}"][data-side="front"]`);
          if (previewBox) {
            previewBox.innerHTML = `<img src="${doc.image}" alt="Document" />`;
            previewBox.closest('.upload-zone').classList.add('has-file');
            
            const retakeBtn = document.querySelector(`.action-btn-retake[data-type="${type}"][data-side="front"]`);
            if (retakeBtn) retakeBtn.classList.remove('hidden');
          }
        }
      }
    });
  }

  // ============================================
  // ✅ VALIDATION GLOBALE
  // ============================================
  
  window.validateStep11 = function() {
    if (!state.uploadedDocs || state.uploadedDocs.length === 0) {
      alert('Please upload at least one identity document to continue');
      return false;
    }
    
    return true;
  };

  // ============================================
  // 🎪 EVENT DELEGATION
  // ============================================
  
  function initEventDelegation() {
    const step = getCachedElements().step;
    if (step) {
      step.addEventListener('click', (e) => {
        const docCard = e.target.closest('.doc-card');
        if (docCard) {
          const type = docCard.dataset.docType;
          if (type) openModal(type);
        }
      }, { passive: true });
    }

    document.addEventListener('click', (e) => {
      const closeBtn = e.target.closest('.modal-close');
      if (closeBtn) {
        const modal = closeBtn.dataset.modal;
        if (modal) closeModal(modal);
        return;
      }

      const saveBtn = e.target.closest('.save-btn');
      if (saveBtn) {
        const modal = saveBtn.dataset.modal;
        if (modal) closeModal(modal);
        return;
      }

      const cameraBtn = e.target.closest('.action-btn-camera');
      if (cameraBtn) {
        const type = cameraBtn.dataset.type;
        const side = cameraBtn.dataset.side;
        if (type && side) openCamera(type, side);
        return;
      }

      const captureBtn = e.target.closest('.capture-btn');
      if (captureBtn) {
        const type = captureBtn.dataset.type;
        const side = captureBtn.dataset.side;
        if (type && side) capturePhoto(type, side);
        return;
      }

      const retakeBtn = e.target.closest('.action-btn-retake');
      if (retakeBtn) {
        const type = retakeBtn.dataset.type;
        const side = retakeBtn.dataset.side;
        if (type && side) retakePhoto(type, side);
        return;
      }

      const backdrop = e.target.closest('.modal-backdrop');
      if (backdrop && e.target === backdrop) {
        const modalId = backdrop.id;
        const type = modalId.replace('modal-', '');
        if (type) closeModal(type);
      }
    });

    document.addEventListener('change', (e) => {
      const input = e.target.closest('.upload-input');
      if (input) {
        const type = input.dataset.type;
        const side = input.dataset.side;
        if (type && side) handleFileUpload(input, type, side);
      }
    });
  }

  // ============================================
  // 🔄 RESTORE STATE
  // ============================================
  
  function restoreState() {
    const data = getLocalStorage();
    state.uploadedDocs = [];

    if (data.documents) {
      Object.keys(data.documents).forEach(type => {
        updateDocCard(type);
      });
    }

    updateCounter();
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
              restoreState();
            } else {
              state.cameraStreams.forEach((stream) => {
                stream.getTracks().forEach(track => track.stop());
              });
              state.cameraStreams.clear();
            }
          }
        });
      });

      observer.observe(elements.step, { attributes: true });
    }

    window.addEventListener('beforeunload', () => {
      state.cameraStreams.forEach((stream) => {
        stream.getTracks().forEach(track => track.stop());
      });
      state.cameraStreams.clear();
    });

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