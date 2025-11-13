@extends('dashboard.layouts.master')
@section('title', 'Profile Picture')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-danger: #ef4444;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #475569;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Accessibility: Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    .upload-picture-container {
        max-width: 450px;
        margin: 0 auto;
        padding: 0.5rem;
        padding-bottom: 8rem;
        min-height: 100vh;
        contain: layout style paint;
    }

    .upload-picture-card {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-xl);
        padding: 1rem;
        border: 2px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        contain: layout style;
    }

    .page-header {
        margin-bottom: 1rem;
        text-align: center;
    }

    .page-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.375rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .page-subtitle {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
        line-height: 1.5;
    }

    /* Upload Zone */
    .upload-zone {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 3px dashed var(--color-primary-light);
        border-radius: var(--border-radius-xl);
        padding: 1.25rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.875rem;
        transition: var(--transition-base);
    }

    .upload-zone:hover {
        background: #dbeafe;
        border-color: var(--color-primary);
    }

    /* Profile Preview */
    .profile-preview-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: var(--transition-base);
        will-change: transform;
        transform: translateZ(0);
    }

    .profile-preview:hover {
        transform: scale(1.05) translateZ(0);
    }

    .preview-overlay {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition-base);
        cursor: pointer;
    }

    .profile-preview-wrapper:hover .preview-overlay {
        opacity: 1;
    }

    .preview-overlay-icon {
        color: white;
        font-size: 2rem;
    }

    /* Upload Buttons Grid */
    .upload-buttons-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        width: 100%;
    }

    /* Upload Button */
    .btn-upload {
        padding: 0.625rem 1rem;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-md);
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-upload:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }

    .btn-upload:active {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }

    .btn-upload:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .btn-upload i {
        font-size: 1.125rem;
    }

    /* Validate Button */
    .btn-validate {
        padding: 0.625rem 1.5rem;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 999px;
        font-size: 0.8125rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-validate:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-validate:active {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }

    .btn-validate:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: translateZ(0);
    }

    .btn-validate:focus-visible {
        outline: 3px solid var(--color-success);
        outline-offset: 3px;
    }

    .upload-input {
        display: none;
    }

    /* Selfie Modal */
    .selfie-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .selfie-modal.active {
        display: flex;
    }

    .selfie-container {
        background: white;
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        max-width: 500px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .selfie-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-align: center;
        text-transform: uppercase;
    }

    .selfie-video-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1;
        background: #000;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
    }

    .selfie-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scaleX(-1); /* Mirror effect */
    }

    .selfie-canvas {
        display: none;
    }

    .selfie-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }

    .btn-capture {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 4px solid white;
        background: var(--color-primary);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-capture:hover {
        transform: scale(1.1);
    }

    .btn-capture:active {
        transform: scale(0.95);
    }

    .btn-capture i {
        color: white;
        font-size: 1.5rem;
    }

    .btn-close-selfie {
        padding: 0.625rem 1.25rem;
        background: #f1f5f9;
        color: var(--color-text-primary);
        border: none;
        border-radius: var(--border-radius-md);
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .btn-close-selfie:hover {
        background: #e2e8f0;
    }

    .selfie-hint {
        text-align: center;
        font-size: 0.75rem;
        color: var(--color-text-tertiary);
    }

    .upload-instructions {
        text-align: center;
        max-width: 400px;
    }

    .upload-instructions-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        margin-bottom: 0.5rem;
    }

    .upload-instructions-list {
        font-size: 0.8125rem;
        color: var(--color-text-tertiary);
        line-height: 1.6;
    }

    * {
        box-sizing: border-box;
    }

    @media (min-width: 640px) {
        .upload-picture-container {
            padding: 1.5rem;
            padding-bottom: 8rem;
        }

        .upload-picture-card {
            padding: 2rem;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .profile-preview {
            width: 130px;
            height: 130px;
        }

        .upload-zone {
            padding: 2rem 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .upload-picture-container {
            padding: 2rem;
            padding-bottom: 2rem;
        }
    }
</style>

<div class="upload-picture-container">
    <div class="upload-picture-card">
        
        <!-- Header -->
        <div class="page-header">
            <h2 class="page-title">My Profile Picture</h2>
            <p class="page-subtitle">Take a photo of yourself, preferably on a white background</p>
        </div>

        <!-- Upload Form -->
        <form method="POST" action="{{ route('provider.profile.photo.ajax') }}" enctype="multipart/form-data" id="photoForm">
            @csrf
            
            <div class="upload-zone">
                <!-- Profile Preview -->
                <div class="profile-preview-wrapper">
                    <img id="preview" 
                         class="profile-preview"
                         src="{{ $user->serviceProvider && $user->serviceProvider->profile_photo ? asset($user->serviceProvider->profile_photo) . '?v=' . time() : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                         alt="Profile picture preview">
                    <label for="profile_picture" class="preview-overlay">
                        <i class="fas fa-camera preview-overlay-icon" aria-hidden="true"></i>
                    </label>
                </div>

                <!-- Upload Buttons -->
                <div class="upload-buttons-grid">
                    <label for="profile_picture_upload" class="btn-upload">
                        <i class="fas fa-upload" aria-hidden="true"></i>
                        <span>Upload Photo</span>
                    </label>
                    <input type="file" 
                           name="profile_picture" 
                           id="profile_picture_upload" 
                           accept="image/*"
                           class="upload-input"
                           aria-label="Upload profile picture from device">

                    <button type="button" id="btn-open-camera" class="btn-upload" aria-label="Take selfie with camera">
                        <i class="fas fa-camera" aria-hidden="true"></i>
                        <span>Take Selfie</span>
                    </button>
                </div>

                <!-- Instructions -->
                <div class="upload-instructions">
                    <p class="upload-instructions-list">
                        📸 White background • Face camera • Good lighting
                    </p>
                </div>

                <!-- Validate Button -->
                <button type="button" 
                        id="submitButton" 
                        class="btn-validate"
                        aria-label="Validate and submit profile picture">
                    <i class="fas fa-check" aria-hidden="true"></i>
                    I Validate
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Selfie Modal -->
<div class="selfie-modal" id="selfieModal">
    <div class="selfie-container">
        <h3 class="selfie-title">📸 Take Your Selfie</h3>
        
        <div class="selfie-video-container">
            <video id="selfieVideo" class="selfie-video" autoplay playsinline></video>
        </div>
        
        <canvas id="selfieCanvas" class="selfie-canvas"></canvas>
        
        <p class="selfie-hint">Position your face in the center and smile! 😊</p>
        
        <div class="selfie-actions">
            <button type="button" id="btnCloseSelfie" class="btn-close-selfie">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button type="button" id="btnCapture" class="btn-capture" aria-label="Capture photo">
                <i class="fas fa-camera"></i>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    const previewImg = document.getElementById('preview');
    const fileInputUpload = document.getElementById('profile_picture_upload');
    const btnOpenCamera = document.getElementById('btn-open-camera');
    const submitBtn = document.getElementById('submitButton');
    const form = document.getElementById('photoForm');
    
    // Selfie modal elements
    const selfieModal = document.getElementById('selfieModal');
    const selfieVideo = document.getElementById('selfieVideo');
    const selfieCanvas = document.getElementById('selfieCanvas');
    const btnCapture = document.getElementById('btnCapture');
    const btnCloseSelfie = document.getElementById('btnCloseSelfie');
    
    let currentFile = null;
    let stream = null;
    let isSubmitting = false; // Prevent double submit
    
    // Handle file upload
    if (fileInputUpload) {
        fileInputUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            handleFileSelect(file);
        });
    }
    
    // Open camera for selfie
    if (btnOpenCamera) {
        btnOpenCamera.addEventListener('click', async function() {
            try {
                // Request camera access with front camera preference
                stream = await navigator.mediaDevices.getUserMedia({
                    video: { 
                        facingMode: 'user', // Front camera on mobile
                        width: { ideal: 1280 },
                        height: { ideal: 1280 }
                    },
                    audio: false
                });
                
                selfieVideo.srcObject = stream;
                selfieModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                
            } catch (error) {
                console.error('Camera access error:', error);
            }
        });
    }
    
    // Capture photo from video
    if (btnCapture) {
        btnCapture.addEventListener('click', function() {
            const context = selfieCanvas.getContext('2d');
            
            // Set canvas size to video size
            selfieCanvas.width = selfieVideo.videoWidth;
            selfieCanvas.height = selfieVideo.videoHeight;
            
            // Draw the video frame to canvas (mirror effect)
            context.save();
            context.scale(-1, 1);
            context.drawImage(selfieVideo, -selfieCanvas.width, 0, selfieCanvas.width, selfieCanvas.height);
            context.restore();
            
            // Convert canvas to blob
            selfieCanvas.toBlob(function(blob) {
                if (blob) {
                    // Create file from blob
                    currentFile = new File([blob], 'selfie.jpg', { type: 'image/jpeg' });
                    
                    // Create persistent URL for preview
                    const url = URL.createObjectURL(blob);
                    
                    // Update preview BEFORE closing modal
                    requestAnimationFrame(() => {
                        previewImg.src = url;
                        previewImg.onload = function() {
                            // Close modal after image is loaded
                            closeSelfieModal();
                        };
                    });
                }
            }, 'image/jpeg', 0.95);
        });
    }
    
    // Close selfie modal
    if (btnCloseSelfie) {
        btnCloseSelfie.addEventListener('click', closeSelfieModal);
    }
    
    function closeSelfieModal() {
        // Stop camera stream
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
        
        selfieModal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Handle file selection from upload
    function handleFileSelect(file) {
        if (!file) return;
        
        // Validate file type
        if (!file.type.match('image.*')) {
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            return;
        }
        
        currentFile = file;
        
        const reader = new FileReader();
        
        reader.onload = function(event) {
            requestAnimationFrame(() => {
                previewImg.src = event.target.result;
            });
        };
        
        reader.readAsDataURL(file);
    }
    
    // Handle form submission
    if (submitBtn && form) {
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Prevent double submit
            if (isSubmitting) return;
            
            if (!currentFile && (!fileInputUpload.files || !fileInputUpload.files[0])) {
                return;
            }
            
            isSubmitting = true;
            
            // Disable button and show loading
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
            submitBtn.disabled = true;
            submitBtn.setAttribute('aria-busy', 'true');
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Use currentFile (from selfie or upload)
            if (currentFile) {
                formData.set('profile_picture', currentFile);
            }
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update image with new path from server + timestamp to avoid cache
                    const timestamp = new Date().getTime();
                    previewImg.src = data.path + '?v=' + timestamp;
                    
                    // Reset form
                    isSubmitting = false;
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Done!';
                    submitBtn.disabled = false;
                    submitBtn.removeAttribute('aria-busy');
                    
                    // Restore button after 2s
                    setTimeout(() => {
                        submitBtn.innerHTML = originalHTML;
                    }, 2000);
                } else {
                    isSubmitting = false;
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                    submitBtn.removeAttribute('aria-busy');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                isSubmitting = false;
                submitBtn.innerHTML = originalHTML;
                submitBtn.disabled = false;
                submitBtn.removeAttribute('aria-busy');
            });
        });
    }
    
    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && selfieModal.classList.contains('active')) {
            closeSelfieModal();
        }
    });
})();
</script>

@endsection