<!-- Step 3: Languages - COMPATIBLE AVEC CODE EXISTANT -->
<style>
/* CSS ISOLÉ pour Step 3 - Aucun conflit avec autres styles */
#step3 {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', system-ui, sans-serif !important;
    width: 100% !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    padding: 20px !important;
    position: relative !important;
}

#step3.hidden {
    display: none !important;
}

/* Header moderne */
#step3 .step3-modern-header {
    text-align: center !important;
    margin-bottom: 24px !important;
    animation: step3FadeIn 0.5s ease-out !important;
}

@keyframes step3FadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

#step3 .step3-icon-container {
    width: 64px !important;
    height: 64px !important;
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    border-radius: 18px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 16px !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
    animation: step3Float 3s ease-in-out infinite !important;
}

@keyframes step3Float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

#step3 .step3-icon-container i {
    color: white !important;
    font-size: 32px !important;
}

#step3 .step3-main-title {
    font-size: 28px !important;
    font-weight: 800 !important;
    color: #1e293b !important;
    margin: 0 0 8px !important;
    line-height: 1.2 !important;
    letter-spacing: -0.02em !important;
}

#step3 .step3-subtitle-text {
    font-size: 16px !important;
    color: #64748b !important;
    margin: 0 !important;
    line-height: 1.5 !important;
    font-weight: 500 !important;
}

/* Grid langues - Responsive intelligent */
#step3 .lang-grid-container {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 12px !important;
    margin-bottom: 24px !important;
    padding: 0 !important;
}

@media (min-width: 480px) {
    #step3 .lang-grid-container {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

@media (min-width: 768px) {
    #step3 .lang-grid-container {
        grid-template-columns: repeat(4, 1fr) !important;
    }
}

/* Boutons langues COMPATIBLES avec classe .lang-btn */
#step3 .lang-btn {
    all: unset !important;
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    color: white !important;
    border: 3px solid transparent !important;
    border-radius: 14px !important;
    padding: 16px 12px !important;
    cursor: pointer !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    position: relative !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    -webkit-tap-highlight-color: transparent !important;
    touch-action: manipulation !important;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3) !important;
    min-height: 110px !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
}

#step3 .lang-btn:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.45) !important;
}

#step3 .lang-btn:active {
    transform: translateY(-2px) scale(0.98) !important;
}

#step3 .lang-btn.selected {
    background: linear-gradient(135deg, #10b981, #059669) !important;
    border-color: #10b981 !important;
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.5) !important;
    transform: translateY(-4px) scale(1.02) !important;
}

/* Flag container */
#step3 .lang-btn img {
    width: 52px !important;
    height: 35px !important;
    object-fit: cover !important;
    border-radius: 6px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
    flex-shrink: 0 !important;
    background: #f1f5f9 !important;
    display: block !important;
}

/* Text langue */
#step3 .lang-btn span {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: white !important;
    text-align: center !important;
    line-height: 1.2 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    display: block !important;
}

/* Checkmark selection */
#step3 .lang-btn::before {
    content: '✓' !important;
    position: absolute !important;
    top: 8px !important;
    right: 8px !important;
    width: 26px !important;
    height: 26px !important;
    background: white !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-weight: 900 !important;
    color: #10b981 !important;
    font-size: 14px !important;
    opacity: 0 !important;
    transform: scale(0) !important;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
}

#step3 .lang-btn.selected::before {
    opacity: 1 !important;
    transform: scale(1) !important;
}

/* Ripple effect */
#step3 .step3-ripple {
    position: absolute !important;
    border-radius: 50% !important;
    background: rgba(255, 255, 255, 0.6) !important;
    pointer-events: none !important;
    transform: scale(0) !important;
    animation: step3Ripple 0.6s ease-out !important;
}

@keyframes step3Ripple {
    to {
        transform: scale(2.5);
        opacity: 0;
    }
}

/* Navigation - GARDE LES IDs ORIGINAUX */
#step3 .step3-nav-container {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    gap: 16px !important;
    margin-top: 24px !important;
}

#step3 #backToStep2 {
    all: unset !important;
    color: #64748b !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.3s !important;
    padding: 12px 20px !important;
    border-radius: 12px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    background: white !important;
    border: 2px solid #e2e8f0 !important;
    box-sizing: border-box !important;
}

#step3 #backToStep2:hover {
    background: #f1f5f9 !important;
    color: #475569 !important;
}

#step3 #backToStep2::before {
    content: '←' !important;
    font-size: 18px !important;
}

#step3 #nextStep3 {
    all: unset !important;
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    color: white !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    padding: 14px 32px !important;
    border-radius: 12px !important;
    cursor: pointer !important;
    transition: all 0.3s !important;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4) !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    box-sizing: border-box !important;
}

#step3 #nextStep3:hover:not(:disabled) {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5) !important;
}

#step3 #nextStep3:active:not(:disabled) {
    transform: translateY(0) !important;
}

#step3 #nextStep3:disabled {
    background: #e2e8f0 !important;
    color: #94a3b8 !important;
    cursor: not-allowed !important;
    box-shadow: none !important;
}

#step3 #nextStep3::after {
    content: '→' !important;
    font-size: 18px !important;
}

#step3 .step3-spinner {
    display: inline-block !important;
    width: 16px !important;
    height: 16px !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    border-top-color: white !important;
    border-radius: 50% !important;
    animation: step3Spin 0.6s linear infinite !important;
}

@keyframes step3Spin {
    to { transform: rotate(360deg); }
}

/* Toast notifications */
#step3 .step3-toast-notification {
    position: fixed !important;
    top: 24px !important;
    left: 50% !important;
    transform: translateX(-50%) translateY(-150px) !important;
    background: linear-gradient(135deg, #10b981, #059669) !important;
    color: white !important;
    padding: 16px 24px !important;
    border-radius: 14px !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.5) !important;
    z-index: 99999 !important;
    opacity: 0 !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    max-width: calc(100% - 32px) !important;
    pointer-events: none !important;
}

#step3 .step3-toast-notification.show {
    opacity: 1 !important;
    transform: translateX(-50%) translateY(0) !important;
}

#step3 .step3-toast-notification.error {
    background: linear-gradient(135deg, #ef4444, #dc2626) !important;
}

/* Shake animation pour erreur */
@keyframes step3Shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-12px); }
    75% { transform: translateX(12px); }
}

#step3.shake {
    animation: step3Shake 0.5s !important;
}

/* Responsive optimizations */
@media (max-width: 480px) {
    #step3 {
        padding: 16px !important;
    }
    #step3 .step3-main-title {
        font-size: 24px !important;
    }
    #step3 .step3-subtitle-text {
        font-size: 14px !important;
    }
    #step3 .lang-btn {
        min-height: 100px !important;
        padding: 12px 10px !important;
    }
    #step3 .lang-btn img {
        width: 44px !important;
        height: 29px !important;
    }
    #step3 .lang-btn span {
        font-size: 13px !important;
    }
}

@media (max-height: 700px) {
    #step3 .step3-icon-container {
        width: 56px !important;
        height: 56px !important;
        margin-bottom: 12px !important;
    }
    #step3 .step3-icon-container i {
        font-size: 28px !important;
    }
    #step3 .step3-modern-header {
        margin-bottom: 20px !important;
    }
    #step3 .lang-btn {
        min-height: 95px !important;
    }
}
</style>

<div id="step3" class="hidden">
    <div class="step3-modern-header">
        <div class="step3-icon-container">
            <i class="fas fa-comments"></i>
        </div>
        <div class="step3-main-title">What languages do you speak? 💬</div>
        <div class="step3-subtitle-text">Select all that apply - multilingual is awesome! ✨</div>
    </div>
    
    <div class="lang-grid-container">
        <button type="button" class="lang-btn" data-lang="English">
            <img src="https://flagcdn.com/us.svg" alt="English" />
            <span>English</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="French">
            <img src="https://flagcdn.com/fr.svg" alt="French" />
            <span>French</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Spanish">
            <img src="https://flagcdn.com/es.svg" alt="Spanish" />
            <span>Spanish</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Portuguese">
            <img src="https://flagcdn.com/pt.svg" alt="Portuguese" />
            <span>Portuguese</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="German">
            <img src="https://flagcdn.com/de.svg" alt="German" />
            <span>German</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Italian">
            <img src="https://flagcdn.com/it.svg" alt="Italian" />
            <span>Italian</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Arabic">
            <img src="https://flagcdn.com/sa.svg" alt="Arabic" />
            <span>Arabic</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Japanese">
            <img src="https://flagcdn.com/jp.svg" alt="Japanese" />
            <span>Japanese</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Korean">
            <img src="https://flagcdn.com/kr.svg" alt="Korean" />
            <span>Korean</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Hindi">
            <img src="https://flagcdn.com/in.svg" alt="Hindi" />
            <span>Hindi</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Turkish">
            <img src="https://flagcdn.com/tr.svg" alt="Turkish" />
            <span>Turkish</span>
        </button>
    </div>
    
    <div class="step3-nav-container">
        <button id="backToStep2">Back</button>
        <button id="nextStep3" disabled>Continue</button>
    </div>
    
    <div class="step3-toast-notification">
        <span class="step3-toast-text"></span>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // Messages fun et variés
    const funMessages = [
        "Great choice! 🎉",
        "Perfect! 🌟",
        "Awesome! ✨",
        "Nice one! 💫",
        "Excellent! 🎯",
        "Love it! 🔥",
        "Brilliant! 💡",
        "Fantastic! 🚀"
    ];

    const errorMessages = [
        "Oops! Pick at least one language 😊",
        "Hey! Choose your languages first 🗣️",
        "Hold on! Select at least one 🌍",
        "Not so fast! Pick a language 💬",
        "Wait! Tell us your languages 😄"
    ];
    
    const selectedLanguages = new Set();
    let errorAttempts = 0;
    
    const step3 = document.getElementById('step3');
    if (!step3) return;
    
    const langButtons = step3.querySelectorAll('.lang-btn');
    const nextButton = document.getElementById('nextStep3');
    const backButton = document.getElementById('backToStep2');
    const toast = step3.querySelector('.step3-toast-notification');
    const toastText = step3.querySelector('.step3-toast-text');
    
    if (!langButtons.length || !nextButton || !backButton) return;
    
    function showToast(message, isError = false) {
        toast.classList.remove('error', 'show');
        toastText.textContent = message;
        
        if (isError) {
            toast.classList.add('error');
        }
        
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }
    
    function createRipple(event, element) {
        const ripple = document.createElement('span');
        ripple.className = 'step3-ripple';
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height) * 1.5;
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
        ripple.style.top = (event.clientY - rect.top - size / 2) + 'px';
        element.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    }
    
    function hapticFeedback(intensity = 50) {
        if ('vibrate' in navigator) {
            navigator.vibrate(intensity);
        }
    }
    
    function updateNextButton() {
        if (selectedLanguages.size > 0) {
            nextButton.disabled = false;
            const count = selectedLanguages.size;
            nextButton.textContent = count === 1 ? 'Continue' : `Continue (${count})`;
        } else {
            nextButton.disabled = true;
            nextButton.textContent = 'Continue';
        }
    }
    
    function toggleLanguage(button) {
        const lang = button.dataset.lang;
        const langName = button.querySelector('span').textContent;
        
        if (selectedLanguages.has(lang)) {
            selectedLanguages.delete(lang);
            button.classList.remove('selected');
            showToast(`${langName} removed ❌`);
        } else {
            selectedLanguages.add(lang);
            button.classList.add('selected');
            const message = funMessages[Math.floor(Math.random() * funMessages.length)];
            showToast(`${langName} - ${message}`);
        }
        
        updateNextButton();
        hapticFeedback(50);
        
        // Sauvegarde localStorage
        try {
            localStorage.setItem('selectedLanguages', JSON.stringify(Array.from(selectedLanguages)));
        } catch(e) {}
    }
    
    // Event listeners pour boutons langues
    langButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            createRipple(event, this);
            toggleLanguage(this);
        });
        
        button.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleLanguage(this);
            }
        });
    });
    
    // VALIDATION OBLIGATOIRE sur Next
    nextButton.addEventListener('click', function(event) {
        event.preventDefault();
        
        if (selectedLanguages.size === 0) {
            errorAttempts++;
            
            // Animation shake
            step3.classList.add('shake');
            setTimeout(() => step3.classList.remove('shake'), 500);
            
            // Message d'erreur varié
            const errorMsg = errorMessages[errorAttempts % errorMessages.length];
            showToast(errorMsg, true);
            
            // Haptic fort pour erreur
            hapticFeedback(200);
            
            return false;
        }
        
        // Success - Afficher spinner
        const originalText = nextButton.textContent;
        nextButton.innerHTML = '<span class="step3-spinner"></span>Loading...';
        hapticFeedback(100);
        
        // Simulation navigation
        setTimeout(() => {
            console.log('✅ Languages selected:', Array.from(selectedLanguages));
            showToast('Perfect! Moving forward 🚀');
            
            // Restaurer le texte après 800ms
            setTimeout(() => {
                nextButton.textContent = originalText;
            }, 800);
            
            // ICI : Déclencher la navigation vers step4
            // Exemple: showStep(4); ou document.getElementById('step4').classList.remove('hidden');
        }, 500);
    });
    
    // Back button
    backButton.addEventListener('click', function() {
        hapticFeedback(30);
        console.log('Going back to step 2');
        // ICI : Déclencher le retour à step2
    });
    
    // Charger les sélections sauvegardées
    try {
        const saved = localStorage.getItem('selectedLanguages');
        if (saved) {
            const savedLangs = JSON.parse(saved);
            savedLangs.forEach(lang => {
                const button = step3.querySelector(`.lang-btn[data-lang="${lang}"]`);
                if (button) {
                    selectedLanguages.add(lang);
                    button.classList.add('selected');
                }
            });
            updateNextButton();
        }
    } catch(e) {}
    
    console.log('🚀 Step 3 Languages - Ready (REQUIRED FIELD)');
})();
</script>