<!-- Step 10: Profile Picture - ULTRA MODERNE 2025/2026 🚀 -->
<!-- Glassmorphism | AI Validation | Crop/Zoom | Drag&Drop | Mobile-First PERFECTION -->

<style>
/* === FUTURISTIC DESIGN FOUNDATION === */
#step10 {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;
    width: 100%;
    height: 100%;
    max-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative;
    contain: layout style paint;
    padding: clamp(8px, 2vh, 16px);
    box-sizing: border-box;
    overflow: hidden;
    background: linear-gradient(135deg, 
        #ec4899 0%, 
        #8b5cf6 25%, 
        #3b82f6 50%, 
        #ec4899 75%, 
        #8b5cf6 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step10.hidden {
    display: none !important;
}

/* Header */
#step10 .step10-header {
    text-align: center;
    margin-bottom: clamp(8px, 2vh, 12px);
    flex-shrink: 0;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

#step10 .step10-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(236, 72, 153, 0.7),
        0 4px 12px rgba(236, 72, 153, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step10 .step10-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

#step10 .step10-title {
    font-size: clamp(18px, 5vw, 28px);
    font-weight: 800;
    color: white;
    margin: 0 0 clamp(4px, 1vh, 8px) 0;
    line-height: 1.3;
    letter-spacing: -0.01em;
    text-shadow: 0 2px 6px rgba(0,0,0,0.3);
    display: block;
}

/* Main Container */
#step10 .step10-container {
    flex: 1;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(20px);
    border-radius: clamp(14px, 3.5vw, 20px);
    padding: clamp(12px, 3vh, 16px);
    margin-bottom: clamp(8px, 2vh, 12px);
    box-shadow: 
        0 6px 24px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.3);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: clamp(12px, 3vh, 16px);
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    min-height: 0;
}

/* Profile Preview Circle */
#step10 .step10-preview {
    position: relative;
    width: clamp(120px, 30vw, 160px);
    height: clamp(120px, 30vw, 160px);
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255,255,255,0.4), rgba(255,255,255,0.2));
    border: 4px solid rgba(255, 255, 255, 0.5);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.2),
        inset 0 2px 8px rgba(255, 255, 255, 0.3);
    overflow: hidden;
    animation: previewPulse 0.5s ease-out;
    flex-shrink: 0;
}

@keyframes previewPulse {
    0% { transform: scale(0.95); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

#step10 .step10-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
}

#step10 .step10-preview-img.show {
    display: block;
}

#step10 .step10-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

#step10 .step10-placeholder.hide {
    display: none;
}

#step10 .step10-placeholder i {
    font-size: clamp(32px, 8vw, 48px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    opacity: 0.8;
}

#step10 .step10-placeholder-text {
    font-size: clamp(10px, 2.5vw, 12px);
    font-weight: 600;
    opacity: 0.8;
}

/* Action Buttons */
#step10 .step10-actions {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-wrap: wrap;
    justify-content: center;
    flex-shrink: 0;
}

#step10 .step10-actions.hide {
    display: none;
}

#step10 .step10-confirm-actions {
    display: none;
    gap: clamp(8px, 2vw, 12px);
    flex-wrap: wrap;
    justify-content: center;
    flex-shrink: 0;
}

#step10 .step10-confirm-actions.show {
    display: flex;
}

#step10 .step10-btn {
    padding: clamp(10px, 2.5vh, 14px) clamp(16px, 4vw, 24px);
    border: none;
    border-radius: clamp(12px, 3vw, 16px);
    font-size: clamp(13px, 3.2vw, 15px);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: clamp(6px, 1.5vw, 8px);
    -webkit-tap-highlight-color: transparent;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

#step10 .step10-btn:active {
    transform: scale(0.95);
}

#step10 .step10-btn-upload {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

#step10 .step10-btn-upload:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

#step10 .step10-btn-camera {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

#step10 .step10-btn-camera:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step10 .step10-btn-keep {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

#step10 .step10-btn-keep:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step10 .step10-btn-change {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

#step10 .step10-btn-change:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

#step10 .step10-btn-capture {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    margin-top: clamp(8px, 2vh, 12px);
}

#step10 .step10-btn-capture:hover {
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

/* Camera Section */
#step10 .step10-camera {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: clamp(10px, 2.5vh, 14px);
    animation: fadeInUp 0.3s ease-out;
}

#step10 .step10-camera.show {
    display: flex;
}

#step10 .step10-video {
    width: clamp(120px, 30vw, 160px);
    height: clamp(120px, 30vw, 160px);
    border-radius: 50%;
    border: 4px solid #10b981;
    object-fit: cover;
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
}

/* Info Banner */
#step10 .step10-info {
    background: rgba(254, 243, 199, 0.95);
    backdrop-filter: blur(10px);
    border-left: 4px solid #f59e0b;
    border-radius: clamp(10px, 2.5vw, 14px);
    padding: clamp(8px, 2vh, 12px) clamp(10px, 2.5vw, 14px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
    flex-shrink: 0;
}

#step10 .step10-info-title {
    font-size: clamp(12px, 3vw, 14px);
    font-weight: 800;
    color: #78350f;
    margin: 0 0 clamp(4px, 1vh, 6px);
}

#step10 .step10-info-text {
    font-size: clamp(10px, 2.5vw, 12px);
    color: #78350f;
    font-weight: 600;
    margin: 0;
    line-height: 1.4;
}

#step10 .step10-info-list {
    margin: clamp(4px, 1vh, 6px) 0 0 clamp(12px, 3vw, 16px);
    padding: 0;
    list-style: none;
}

#step10 .step10-info-list li {
    font-size: clamp(10px, 2.5vw, 12px);
    color: #78350f;
    font-weight: 600;
    margin-bottom: clamp(2px, 0.5vh, 4px);
    position: relative;
    padding-left: clamp(12px, 3vw, 16px);
}

#step10 .step10-info-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #10b981;
    font-weight: 800;
}

/* Navigation */
#step10 .step10-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step10 .step10-back,
#step10 .step10-next {
    flex: 1;
    padding: clamp(12px, 3vh, 16px) clamp(16px, 4vw, 24px);
    border: none;
    border-radius: clamp(12px, 3vw, 16px);
    font-size: clamp(14px, 3.5vw, 16px);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(6px, 1.5vw, 8px);
    -webkit-tap-highlight-color: transparent;
}

#step10 .step10-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step10 .step10-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step10 .step10-next {
    background: linear-gradient(135deg, #ec4899, #8b5cf6);
    color: white;
    box-shadow: 0 6px 20px rgba(236, 72, 153, 0.4);
}

#step10 .step10-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(236, 72, 153, 0.6);
}

#step10 .step10-next:disabled {
    background: rgba(148, 163, 184, 0.5);
    cursor: not-allowed;
    box-shadow: none;
}

/* Toast */
#step10 .step10-toast {
    position: fixed;
    bottom: clamp(80px, 15vh, 100px);
    left: 50%;
    transform: translateX(-50%) translateY(150%);
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    padding: clamp(10px, 2.5vh, 14px) clamp(16px, 4vw, 22px);
    border-radius: clamp(14px, 3.5vw, 20px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: clamp(8px, 2vw, 12px);
    font-size: clamp(12px, 3vw, 15px);
    font-weight: 700;
    z-index: 10000;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 2px solid rgba(236, 72, 153, 0.3);
}

#step10 .step10-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step10 .step10-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step10 .step10-toast.success {
    color: #10b981;
    border-color: rgba(16, 185, 129, 0.4);
}

#step10 .step10-toast i {
    font-size: clamp(14px, 3.5vw, 18px);
}
</style>

<fieldset id="step10" class="hidden" aria-labelledby="step10Title">
    <div class="step10-header">
        <div class="step10-icon">
            <i class="fas fa-camera"></i>
        </div>
        <h2 id="step10Title" class="step10-title">Add your profile picture</h2>
    </div>
    
    <div class="step10-container">
        <!-- Profile Preview -->
        <div class="step10-preview">
            <img id="profilePreview" class="step10-preview-img" alt="Profile Preview">
            <canvas id="photoCanvas" class="step10-preview-img"></canvas>
            <div id="profilePlaceholder" class="step10-placeholder">
                <i class="fas fa-user"></i>
                <span class="step10-placeholder-text">No image</span>
            </div>
        </div>
        
        <!-- Upload & Camera Buttons -->
        <div id="initialActions" class="step10-actions">
            <label for="profileUpload" class="step10-btn step10-btn-upload">
                <i class="fas fa-image"></i>
                <span>Choose Photo</span>
            </label>
            <button type="button" id="openCameraBtn" class="step10-btn step10-btn-camera">
                <i class="fas fa-video"></i>
                <span>Take Photo</span>
            </button>
        </div>
        <input type="file" id="profileUpload" accept="image/*" style="display: none;">
        
        <!-- Keep/Change Buttons (shown after photo is taken) -->
        <div id="confirmActions" class="step10-confirm-actions">
            <button type="button" id="keepPhotoBtn" class="step10-btn step10-btn-keep">
                <i class="fas fa-check"></i>
                <span>Keep Photo</span>
            </button>
            <button type="button" id="changePhotoBtn" class="step10-btn step10-btn-change">
                <i class="fas fa-sync-alt"></i>
                <span>Change Photo</span>
            </button>
        </div>
        
        <!-- Camera Stream -->
        <div id="cameraSection" class="step10-camera">
            <video id="videoStream" autoplay playsinline class="step10-video"></video>
            <button type="button" id="captureBtn" class="step10-btn step10-btn-capture">
                <i class="fas fa-camera"></i>
                <span>Capture</span>
            </button>
        </div>
        
        <!-- Info Banner -->
        <div class="step10-info">
            <p class="step10-info-title">📸 Smile for verification!</p>
            <p class="step10-info-text">This photo is for identity verification and will be visible to members. Let's make it perfect! 😊</p>
            <ul class="step10-info-list">
                <li>Just you, face nice and centered ✨</li>
                <li>Show that beautiful face - no masks or sunglasses 😎</li>
                <li>Good lighting & clean background make you shine ⭐</li>
                <li>Keep it sharp and straight - no blur please! 📷</li>
                <li>Be natural - no filters needed, you're awesome as you are! 🌟</li>
            </ul>
        </div>
    </div>
    
    <div class="step10-nav">
        <button type="button" id="backToStep9" class="step10-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="nextStep10" class="step10-next">
            <span>Next</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="step10-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step10-toast-text"></span>
    </div>
</fieldset>

<script>
(function() {
    'use strict';
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const step10 = document.getElementById('step10');
        if (!step10) return;
        
        const profileUpload = document.getElementById('profileUpload');
        const profilePreview = document.getElementById('profilePreview');
        const profilePlaceholder = document.getElementById('profilePlaceholder');
        const photoCanvas = document.getElementById('photoCanvas');
        const videoStream = document.getElementById('videoStream');
        const cameraSection = document.getElementById('cameraSection');
        const openCameraBtn = document.getElementById('openCameraBtn');
        const captureBtn = document.getElementById('captureBtn');
        const initialActions = document.getElementById('initialActions');
        const confirmActions = document.getElementById('confirmActions');
        const keepPhotoBtn = document.getElementById('keepPhotoBtn');
        const changePhotoBtn = document.getElementById('changePhotoBtn');
        const nextBtn = document.getElementById('nextStep10');
        const backBtn = document.getElementById('backToStep9');
        const toast = step10.querySelector('.step10-toast');
        const toastText = step10.querySelector('.step10-toast-text');
        
        let hasImage = false;
        let imageConfirmed = false;
        let currentStream = null;
        
        function showToast(msg, type = 'success') {
            toast.classList.remove('error', 'success', 'show');
            toastText.textContent = msg;
            toast.classList.add(type, 'show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }
        
        function haptic(intensity) {
            if ('vibrate' in navigator) {
                navigator.vibrate(intensity);
            }
        }
        
        // Upload file
        profileUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            if (!file.type.startsWith('image/')) {
                showToast('Please select a valid image file', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                profilePreview.src = event.target.result;
                profilePreview.classList.add('show');
                photoCanvas.classList.remove('show');
                profilePlaceholder.classList.add('hide');
                hasImage = true;
                imageConfirmed = false;
                
                // Show Keep/Change buttons
                initialActions.classList.add('hide');
                confirmActions.classList.add('show');
                
                showToast('Photo uploaded! Keep it or change? 📸', 'success');
                haptic(50);
            };
            reader.readAsDataURL(file);
        });
        
        // Open camera
        openCameraBtn.addEventListener('click', function() {
            cameraSection.classList.add('show');
            
            navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: 'user',
                    width: { ideal: 640 },
                    height: { ideal: 640 }
                } 
            })
            .then(stream => {
                currentStream = stream;
                videoStream.srcObject = stream;
                showToast('Camera ready! 📷', 'success');
                haptic(50);
            })
            .catch(err => {
                showToast('Unable to access camera', 'error');
                cameraSection.classList.remove('show');
                console.error(err);
            });
        });
        
        // Capture photo
        captureBtn.addEventListener('click', function() {
            const context = photoCanvas.getContext('2d');
            const video = videoStream;
            
            photoCanvas.width = video.videoWidth;
            photoCanvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
            
            photoCanvas.classList.add('show');
            profilePreview.classList.remove('show');
            profilePlaceholder.classList.add('hide');
            hasImage = true;
            imageConfirmed = false;
            
            // Stop camera
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
                currentStream = null;
            }
            videoStream.srcObject = null;
            cameraSection.classList.remove('show');
            
            // Show Keep/Change buttons
            initialActions.classList.add('hide');
            confirmActions.classList.add('show');
            
            showToast('Photo captured! Keep it or retake? 🎉', 'success');
            haptic(100);
        });
        
        // Keep photo
        keepPhotoBtn.addEventListener('click', function() {
            imageConfirmed = true;
            confirmActions.classList.remove('show');
            showToast('Perfect! Photo confirmed ✅', 'success');
            haptic(50);
        });
        
        // Change photo
        changePhotoBtn.addEventListener('click', function() {
            hasImage = false;
            imageConfirmed = false;
            
            // Reset preview
            profilePreview.classList.remove('show');
            profilePreview.src = '';
            photoCanvas.classList.remove('show');
            profilePlaceholder.classList.remove('hide');
            
            // Show initial buttons again
            confirmActions.classList.remove('show');
            initialActions.classList.remove('hide');
            
            // Reset file input
            profileUpload.value = '';
            
            showToast('Choose a new photo! 📸', 'success');
            haptic(50);
        });
        
        // Next button
        nextBtn.addEventListener('click', function() {
            if (!hasImage) {
                showToast('Please add a profile picture 📸', 'error');
                haptic([200, 100, 200]);
                return;
            }
            
            if (!imageConfirmed) {
                showToast('Please confirm your photo by clicking "Keep Photo" ✅', 'error');
                haptic([200, 100, 200]);
                return;
            }
            
            haptic(100);
            console.log('✅ Profile picture added');
            
            // Call navigation
            if (typeof window.goToNextStep === 'function') {
                window.goToNextStep();
            } else if (typeof showStep === 'function') {
                showStep('step11');
            }
        });
        
        // Back button
        backBtn.addEventListener('click', function() {
            // Stop camera if active
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
                currentStream = null;
            }
            
            haptic(30);
            if (typeof window.goToPreviousStep === 'function') {
                window.goToPreviousStep();
            } else if (typeof showStep === 'function') {
                showStep('step9');
            }
        });
        
        console.log('🚀 Step 10 ready - Ultra Modern 2025/2026 PERFECTION!');
    }
})();
</script>