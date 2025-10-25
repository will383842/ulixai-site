<!-- Step 9: Profile Description - ZERO SCROLL MOBILE-FIRST PERFECTION 🚀 -->
<!-- 200% Mobile-First | NO SCROLL | Lightning Fast | Textarea with Counter -->

<style>
/* === ZERO SCROLL MOBILE-FIRST FOUNDATION === */
#step9 {
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
        #06b6d4 0%, 
        #0891b2 25%, 
        #22d3ee 50%, 
        #06b6d4 75%, 
        #0891b2 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step9.hidden {
    display: none !important;
}

/* Header ultra-compact mobile-first */
#step9 .step9-header {
    text-align: center;
    margin-bottom: clamp(8px, 2vh, 12px);
    flex-shrink: 0;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Icon badge compact */
#step9 .step9-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(6, 182, 212, 0.7),
        0 4px 12px rgba(6, 182, 212, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step9 .step9-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

/* Titre compact */
#step9 .step9-title {
    font-size: clamp(18px, 5vw, 28px);
    font-weight: 800;
    color: white;
    margin: 0 0 clamp(4px, 1vh, 8px) 0;
    line-height: 1.3;
    letter-spacing: -0.01em;
    text-shadow: 0 2px 6px rgba(0,0,0,0.3);
    display: block;
}

/* Info banner compact */
#step9 .step9-info-banner {
    background: rgba(254, 243, 199, 0.95);
    backdrop-filter: blur(10px);
    border-left: 4px solid #f59e0b;
    border-radius: clamp(10px, 2.5vw, 14px);
    padding: clamp(6px, 1.5vh, 10px) clamp(10px, 2.5vw, 14px);
    margin-bottom: clamp(8px, 2vh, 12px);
    flex-shrink: 0;
    animation: bannerSlide 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
}

@keyframes bannerSlide {
    0% { opacity: 0; transform: translateX(-20px); }
    100% { opacity: 1; transform: translateX(0); }
}

#step9 .step9-info-text {
    font-size: clamp(10px, 2.3vw, 12px);
    color: #78350f;
    font-weight: 700;
    text-align: center;
    margin: 0;
    line-height: 1.3;
}

/* Form container */
#step9 .step9-form-container {
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
    min-height: 0;
}

/* Label */
#step9 .step9-label {
    font-size: clamp(12px, 3vw, 15px);
    font-weight: 700;
    color: white;
    margin-bottom: clamp(6px, 1.5vh, 10px);
    display: block;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Textarea wrapper */
#step9 .step9-textarea-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 0;
}

/* Textarea */
#step9 .step9-textarea {
    width: 100%;
    flex: 1;
    background: white;
    border: 2px solid rgba(6, 182, 212, 0.3);
    border-radius: clamp(12px, 3vw, 16px);
    padding: clamp(10px, 2.5vh, 14px) clamp(12px, 3vw, 16px);
    font-size: clamp(13px, 3.2vw, 15px);
    font-family: inherit;
    color: #1e293b;
    resize: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.15);
    line-height: 1.5;
    min-height: clamp(120px, 25vh, 200px);
}

#step9 .step9-textarea::placeholder {
    color: #94a3b8;
    opacity: 1;
}

#step9 .step9-textarea:focus {
    outline: none;
    border-color: #06b6d4;
    box-shadow: 
        0 0 0 3px rgba(6, 182, 212, 0.2),
        0 4px 16px rgba(6, 182, 212, 0.3);
}

#step9 .step9-textarea:hover {
    border-color: rgba(6, 182, 212, 0.5);
}

/* Counter row */
#step9 .step9-counter-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: clamp(6px, 1.5vh, 10px);
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step9 .step9-counter-label,
#step9 .step9-counter-value {
    font-size: clamp(10px, 2.3vw, 12px);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
}

#step9 .step9-counter-value {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: clamp(4px, 1vh, 6px) clamp(8px, 2vw, 12px);
    border-radius: clamp(8px, 2vw, 12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

#step9 .step9-counter-value.warning {
    background: rgba(251, 191, 36, 0.9);
    color: #78350f;
    font-weight: 700;
    animation: pulse 0.5s ease;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

#step9 .step9-counter-value.danger {
    background: rgba(239, 68, 68, 0.9);
    color: white;
    font-weight: 700;
    animation: shake 0.5s ease;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Navigation - Harmonisé Step 2 */
#step9 .step9-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step9 .step9-back,
#step9 .step9-next {
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
    position: relative;
    overflow: hidden;
}

#step9 .step9-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step9 .step9-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step9 .step9-back:active {
    transform: translateY(0);
}

#step9 .step9-next {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step9 .step9-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(16, 185, 129, 0.6);
}

#step9 .step9-next:active {
    transform: translateY(0);
}

/* Spinner */
.step9-spinner {
    display: inline-block;
    width: clamp(14px, 3.5vw, 18px);
    height: clamp(14px, 3.5vw, 18px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Toast notification */
#step9 .step9-toast {
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
    border: 2px solid rgba(6, 182, 212, 0.3);
}

#step9 .step9-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step9 .step9-toast.success {
    color: #10b981;
    border-color: rgba(16, 185, 129, 0.4);
}

#step9 .step9-toast.success i {
    color: #10b981;
    font-size: clamp(14px, 3.5vw, 18px);
}

#step9 .step9-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step9 .step9-toast.error i {
    color: #ef4444;
    font-size: clamp(14px, 3.5vw, 18px);
}
</style>

<fieldset id="step9" class="hidden" aria-labelledby="step9Title">
    <div class="step9-header">
        <div class="step9-icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <h2 id="step9Title" class="step9-title">Tell us about yourself</h2>
    </div>
    
    <div class="step9-info-banner">
        <p class="step9-info-text">what you fill out here will be on your profile sheet and important to get more missions</p>
    </div>
    
    <div class="step9-form-container">
        <label for="profileDescription" class="step9-label">Profile Description</label>
        
        <div class="step9-textarea-wrapper">
            <textarea 
                id="profileDescription" 
                name="profile_description"
                class="step9-textarea"
                placeholder="Write a brief description about yourself, your experience, and how you can help others..."
                maxlength="500"
                rows="6"></textarea>
        </div>
        
        <div class="step9-counter-row">
            <span class="step9-counter-label">Maximum 500 characters</span>
            <span class="step9-counter-value">
                <span id="charCount">0</span>/500
            </span>
        </div>
    </div>
    
    <div class="step9-nav">
        <button type="button" id="backToStep8" class="step9-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="nextStep9" class="step9-next">
            <span id="nextStep9Text">Next</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="step9-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step9-toast-text"></span>
    </div>
</fieldset>

<script>
// === ULTRA-OPTIMIZED ZERO SCROLL JS 🚀 ===
(function() {
    'use strict';
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const step9 = document.getElementById('step9');
        if (!step9) return;
        
        const textarea = document.getElementById('profileDescription');
        const charCount = document.getElementById('charCount');
        const counterValue = document.querySelector('.step9-counter-value');
        const nextBtn = document.getElementById('nextStep9');
        const backBtn = document.getElementById('backToStep8');
        const nextText = document.getElementById('nextStep9Text');
        const toast = step9.querySelector('.step9-toast');
        const toastText = step9.querySelector('.step9-toast-text');
        
        if (!textarea || !charCount || !nextBtn || !backBtn) return;
        
        function showToast(msg, type = 'success') {
            toast.classList.remove('error', 'success', 'show');
            toastText.textContent = msg;
            toast.classList.add(type, 'show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        
        function haptic(intensity) {
            if ('vibrate' in navigator) {
                navigator.vibrate(intensity);
            }
        }
        
        function updateCounter() {
            const count = textarea.value.length;
            charCount.textContent = count;
            
            // Update counter styling
            counterValue.classList.remove('warning', 'danger');
            
            if (count >= 500) {
                counterValue.classList.add('danger');
            } else if (count >= 450) {
                counterValue.classList.add('warning');
            }
        }
        
        let saveTimer;
        function save() {
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => {
                try {
                    localStorage.setItem('profileDescription', textarea.value);
                } catch(e) {}
            }, 500);
        }
        
        // Update counter on input
        textarea.addEventListener('input', function() {
            updateCounter();
            save();
        });
        
        // Prevent new lines after max length (optional, for better UX)
        textarea.addEventListener('keydown', function(e) {
            if (this.value.length >= 500 && e.key !== 'Backspace' && e.key !== 'Delete') {
                if (!e.ctrlKey && !e.metaKey) {
                    e.preventDefault();
                    haptic(30);
                }
            }
        });
        
        nextBtn.addEventListener('click', function() {
            if (nextText) {
                const originalText = nextText.textContent;
                nextText.innerHTML = '<div class="step9-spinner"></div>Loading...';
                setTimeout(() => nextText.textContent = originalText, 800);
            }
            
            haptic(100);
            console.log('✅ Profile description:', textarea.value);
            
            // Call navigation function
            if (typeof window.goToNextStep === 'function') {
                window.goToNextStep();
            } else if (typeof showStep === 'function') {
                showStep('step10');
            }
        });
        
        backBtn.addEventListener('click', function() {
            haptic(30);
            if (typeof window.goToPreviousStep === 'function') {
                window.goToPreviousStep();
            } else if (typeof showStep === 'function') {
                showStep('step8');
            }
        });
        
        // Restore
        try {
            const saved = localStorage.getItem('profileDescription');
            if (saved) {
                textarea.value = saved;
                updateCounter();
            }
        } catch(e) {}
        
        // Initial counter update
        updateCounter();
        
        console.log('🚀 Step 9 ready - Zero Scroll Mobile-First PERFECTION!');
    }
})();
</script>