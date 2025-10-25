<!-- Step 8: Speak Preference - ZERO SCROLL MOBILE-FIRST ULTRA FUN 🚀 -->
<!-- 200% Mobile-First | NO SCROLL | Lightning Fast | Toggle Yes/No -->

<style>
/* === ZERO SCROLL MOBILE-FIRST FOUNDATION === */
#step8 {
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
        #8b5cf6 0%, 
        #6366f1 25%, 
        #a78bfa 50%, 
        #8b5cf6 75%, 
        #6366f1 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step8.hidden {
    display: none !important;
}

/* Header ultra-compact mobile-first */
#step8 .step8-header {
    text-align: center;
    margin-bottom: clamp(8px, 2vh, 12px);
    flex-shrink: 0;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Icon badge compact avec GLOW */
#step8 .step8-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(139, 92, 246, 0.7),
        0 4px 12px rgba(139, 92, 246, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step8 .step8-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

/* Titre compact */
#step8 .step8-title {
    font-size: clamp(16px, 4vw, 24px);
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #ede9fe 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 clamp(3px, 1vh, 6px);
    line-height: 1.2;
    letter-spacing: -0.02em;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
}

#step8 .step8-subtitle {
    font-size: clamp(11px, 2.5vw, 14px);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    margin: 0;
    line-height: 1.3;
}

/* Info banner compact */
#step8 .step8-info-banner {
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

#step8 .step8-info-text {
    font-size: clamp(10px, 2.3vw, 12px);
    color: #78350f;
    font-weight: 700;
    text-align: center;
    margin: 0;
    line-height: 1.3;
}

/* Main content container */
#step8 .step8-container {
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
    justify-content: center;
    gap: clamp(12px, 3vh, 16px);
    min-height: 0;
}

/* Option row */
#step8 .step8-option {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(139, 92, 246, 0.3);
    border-radius: clamp(16px, 4vw, 24px);
    padding: clamp(12px, 3vh, 16px) clamp(14px, 3.5vw, 20px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: clamp(12px, 3vw, 16px);
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.15);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    animation: optionPop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes optionPop {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}

#step8 .step8-option:hover {
    border-color: rgba(139, 92, 246, 0.5);
    box-shadow: 0 6px 24px rgba(139, 92, 246, 0.25);
}

/* Option label avec icône */
#step8 .step8-option-label {
    display: flex;
    align-items: center;
    gap: clamp(8px, 2vw, 12px);
    flex: 1;
    min-width: 0;
}

#step8 .step8-option-icon {
    width: clamp(28px, 6vw, 36px);
    height: clamp(28px, 6vw, 36px);
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

#step8 .step8-option-icon i {
    color: white;
    font-size: clamp(12px, 3vw, 16px);
}

#step8 .step8-option-text {
    font-size: clamp(13px, 3.2vw, 16px);
    font-weight: 700;
    color: #1e293b;
}

/* Toggle buttons container */
#step8 .step8-toggle {
    display: flex;
    gap: clamp(4px, 1vw, 6px);
    flex-shrink: 0;
}

/* Toggle button */
#step8 .step8-toggle-btn {
    padding: clamp(6px, 1.5vh, 9px) clamp(12px, 3vw, 18px);
    border: 2px solid #10b981;
    border-radius: clamp(12px, 3vw, 18px);
    background: white;
    color: #10b981;
    font-size: clamp(12px, 3vw, 14px);
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.15);
}

#step8 .step8-toggle-btn:hover {
    background: #f0fdf4;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
}

#step8 .step8-toggle-btn:active {
    transform: translateY(0);
}

/* État actif */
#step8 .step8-toggle-btn.active {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border-color: #10b981;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);
    transform: translateY(-2px);
}

/* État inactif (No sélectionné) */
#step8 .step8-toggle-btn.inactive {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border-color: #ef4444;
    box-shadow: 0 4px 16px rgba(239, 68, 68, 0.4);
    transform: translateY(-2px);
}

/* Ripple effect */
.step8-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(139, 92, 246, 0.5);
    transform: scale(0);
    animation: rippleEffect 0.6s ease-out;
    pointer-events: none;
}

@keyframes rippleEffect {
    to {
        transform: scale(2.5);
        opacity: 0;
    }
}

/* Navigation - Harmonisé Step 2 */
#step8 .step8-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step8 .step8-back,
#step8 .step8-next {
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

#step8 .step8-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step8 .step8-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step8 .step8-back:active {
    transform: translateY(0);
}

#step8 .step8-next {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step8 .step8-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(16, 185, 129, 0.6);
}

#step8 .step8-next:active {
    transform: translateY(0);
}

/* Spinner */
.step8-spinner {
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
#step8 .step8-toast {
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
    border: 2px solid rgba(139, 92, 246, 0.3);
}

#step8 .step8-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step8 .step8-toast.success {
    color: #10b981;
    border-color: rgba(16, 185, 129, 0.4);
}

#step8 .step8-toast.success i {
    color: #10b981;
    font-size: clamp(14px, 3.5vw, 18px);
}

#step8 .step8-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step8 .step8-toast.error i {
    color: #ef4444;
    font-size: clamp(14px, 3.5vw, 18px);
}

#step8 .step8-toast.info {
    color: #8b5cf6;
    border-color: rgba(139, 92, 246, 0.4);
}

#step8 .step8-toast.info i {
    color: #8b5cf6;
    font-size: clamp(14px, 3.5vw, 18px);
}
</style>

<fieldset id="step8" class="hidden" aria-labelledby="step8Title">
    <div class="step8-header">
        <div class="step8-icon">
            <i class="fas fa-comments"></i>
        </div>
        <h2 id="step8Title" class="step8-title">Would You Like To Speak Online Or In Person?</h2>
    </div>
    
    <div class="step8-info-banner">
        <p class="step8-info-text">You can Choose both</p>
    </div>
    
    <div class="step8-container">
        <!-- Online Option -->
        <div class="step8-option">
            <div class="step8-option-label">
                <div class="step8-option-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <span class="step8-option-text">Online</span>
            </div>
            <div class="step8-toggle" data-option="online">
                <button type="button" class="step8-toggle-btn" data-value="yes">Yes</button>
                <button type="button" class="step8-toggle-btn" data-value="no">No</button>
            </div>
        </div>
        
        <!-- In Person Option -->
        <div class="step8-option">
            <div class="step8-option-label">
                <div class="step8-option-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <span class="step8-option-text">In person</span>
            </div>
            <div class="step8-toggle" data-option="inperson">
                <button type="button" class="step8-toggle-btn" data-value="yes">Yes</button>
                <button type="button" class="step8-toggle-btn" data-value="no">No</button>
            </div>
        </div>
    </div>
    
    <div class="step8-nav">
        <button type="button" id="backToStep7" class="step8-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="nextStep8" class="step8-next">
            <span id="nextStep8Text">Next</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <input type="hidden" id="onlinePreference" name="online_preference" value="">
    <input type="hidden" id="inpersonPreference" name="inperson_preference" value="">
    
    <div class="step8-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step8-toast-text"></span>
    </div>
</fieldset>

<script>
// === ULTRA-OPTIMIZED ZERO SCROLL JS 🚀 ===
(function() {
    'use strict';
    
    const msgs = {
        yes: ["Perfect choice! 🎉", "Great! 🌟", "Awesome! ✨", "Love it! 💫"],
        no: ["Got it! 👍", "Noted! 📝", "Okay! ✓", "Understood! 💯"],
        both: ["Both selected! 🎯", "Double power! 💪", "All options! 🚀"],
        none: ["Pick at least one! 🤔", "Choose an option! 👆", "Make a choice! 🎯"]
    };
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const preferences = {
            online: null,
            inperson: null
        };
        
        const step8 = document.getElementById('step8');
        if (!step8) return;
        
        const toggles = step8.querySelectorAll('.step8-toggle');
        const nextBtn = document.getElementById('nextStep8');
        const backBtn = document.getElementById('backToStep7');
        const nextText = document.getElementById('nextStep8Text');
        const onlineInput = document.getElementById('onlinePreference');
        const inpersonInput = document.getElementById('inpersonPreference');
        const toast = step8.querySelector('.step8-toast');
        const toastText = step8.querySelector('.step8-toast-text');
        
        if (!toggles.length || !nextBtn || !backBtn) return;
        
        function showToast(msg, type = 'success') {
            toast.classList.remove('error', 'success', 'info', 'show');
            toastText.textContent = msg;
            toast.classList.add(type, 'show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        
        function createRipple(e, el) {
            const ripple = document.createElement('span');
            ripple.className = 'step8-ripple';
            const rect = el.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            el.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        }
        
        function haptic(intensity) {
            if ('vibrate' in navigator) {
                navigator.vibrate(intensity);
            }
        }
        
        function updateUI() {
            requestAnimationFrame(() => {
                // Update hidden inputs
                if (onlineInput) onlineInput.value = preferences.online || '';
                if (inpersonInput) inpersonInput.value = preferences.inperson || '';
            });
        }
        
        let saveTimer;
        function save() {
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => {
                try {
                    localStorage.setItem('speakPreferences', JSON.stringify(preferences));
                } catch(e) {}
            }, 300);
        }
        
        function handleToggle(toggle, value) {
            const option = toggle.dataset.option;
            const buttons = toggle.querySelectorAll('.step8-toggle-btn');
            
            // Remove active/inactive from all buttons in this toggle
            buttons.forEach(btn => {
                btn.classList.remove('active', 'inactive');
            });
            
            // Set preference
            preferences[option] = value;
            
            // Add active class to selected button
            const selectedBtn = toggle.querySelector(`[data-value="${value}"]`);
            if (selectedBtn) {
                if (value === 'yes') {
                    selectedBtn.classList.add('active');
                } else {
                    selectedBtn.classList.add('inactive');
                }
            }
            
            updateUI();
            save();
            
            // Show toast
            const optionName = option === 'online' ? 'Online' : 'In person';
            const msg = value === 'yes' 
                ? msgs.yes[Math.floor(Math.random() * msgs.yes.length)]
                : msgs.no[Math.floor(Math.random() * msgs.no.length)];
            
            showToast(`${optionName}: ${value.toUpperCase()} - ${msg}`, value === 'yes' ? 'success' : 'info');
            haptic(50);
            
            if (typeof window.updateNextButton === 'function') {
                window.updateNextButton();
            }
        }
        
        // Setup toggle buttons
        toggles.forEach(toggle => {
            const buttons = toggle.querySelectorAll('.step8-toggle-btn');
            
            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    createRipple(e, this);
                    const value = this.dataset.value;
                    handleToggle(toggle, value);
                });
            });
        });
        
        nextBtn.addEventListener('click', function() {
            // Check if BOTH options have been answered
            if (preferences.online === null || preferences.inperson === null) {
                const missing = [];
                if (preferences.online === null) missing.push('Online');
                if (preferences.inperson === null) missing.push('In person');
                
                showToast(`Please answer: ${missing.join(' and ')} 🎯`, 'error');
                haptic([200, 100, 200]);
                return;
            }
            
            if (nextText) {
                const originalText = nextText.textContent;
                nextText.innerHTML = '<div class="step8-spinner"></div>Loading...';
                setTimeout(() => nextText.textContent = originalText, 800);
            }
            
            haptic(100);
            console.log('✅ Speak preferences:', preferences);
            
            // Call navigation function
            if (typeof window.goToNextStep === 'function') {
                window.goToNextStep();
            } else if (typeof showStep === 'function') {
                showStep('step9');
            }
        });
        
        backBtn.addEventListener('click', function() {
            haptic(30);
            if (typeof window.goToPreviousStep === 'function') {
                window.goToPreviousStep();
            } else if (typeof showStep === 'function') {
                showStep('step7');
            }
        });
        
        // Restore
        try {
            const saved = localStorage.getItem('speakPreferences');
            if (saved) {
                const savedPrefs = JSON.parse(saved);
                
                Object.keys(savedPrefs).forEach(option => {
                    const value = savedPrefs[option];
                    if (value) {
                        preferences[option] = value;
                        const toggle = step8.querySelector(`.step8-toggle[data-option="${option}"]`);
                        if (toggle) {
                            const btn = toggle.querySelector(`[data-value="${value}"]`);
                            if (btn) {
                                if (value === 'yes') {
                                    btn.classList.add('active');
                                } else {
                                    btn.classList.add('inactive');
                                }
                            }
                        }
                    }
                });
                
                updateUI();
            }
        } catch(e) {}
        
        updateUI();
        console.log('🚀 Step 8 ready - Zero Scroll Mobile-First ULTRA FUN!');
    }
})();
</script>