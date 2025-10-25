<!-- Step 6: Countries - ZERO SCROLL MOBILE-FIRST ULTRA OPTIMIZED 🚀 -->
<!-- 200% Mobile-First | NO SCROLL | Lightning Fast Performance -->

<style>
/* === ZERO SCROLL MOBILE-FIRST FOUNDATION === */
#step6 {
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
        #3b82f6 0%, 
        #2563eb 25%, 
        #60a5fa 50%, 
        #4facfe 75%, 
        #3b82f6 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step6.hidden {
    display: none !important;
}

/* Header ultra-compact mobile-first */
#step6 .step6-header {
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
#step6 .step6-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(59, 130, 246, 0.6),
        0 4px 12px rgba(59, 130, 246, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step6 .step6-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

/* Titre compact */
#step6 .step6-title {
    font-size: clamp(16px, 4vw, 24px);
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 clamp(3px, 1vh, 6px);
    line-height: 1.2;
    letter-spacing: -0.02em;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
}

#step6 .step6-subtitle {
    font-size: clamp(11px, 2.5vw, 14px);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    margin: 0;
    line-height: 1.3;
}

/* Selected container - COMPACT et visible */
#step6 .step6-selected-wrapper {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: clamp(12px, 3vw, 18px);
    padding: clamp(8px, 2vh, 12px);
    margin-bottom: clamp(8px, 2vh, 12px);
    box-shadow: 
        0 4px 16px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    border: 2px solid rgba(59, 130, 246, 0.3);
    flex-shrink: 0;
    animation: containerBounce 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    flex-direction: column;
    gap: clamp(6px, 1.5vh, 8px);
}

@keyframes containerBounce {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}

/* Counter badge compact */
#step6 .step6-counter {
    display: inline-flex;
    align-items: center;
    gap: clamp(6px, 1.5vw, 8px);
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: clamp(6px, 1.5vh, 9px) clamp(10px, 2.5vw, 14px);
    border-radius: clamp(14px, 3.5vw, 20px);
    font-size: clamp(11px, 2.5vw, 13px);
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    align-self: flex-start;
}

#step6 .step6-counter.active {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
}

#step6 .step6-counter i {
    font-size: clamp(10px, 2.5vw, 12px);
}

/* Selected tags container - scrollable si besoin */
#step6 #step6Selected {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: clamp(5px, 1.2vw, 8px);
    max-height: clamp(60px, 12vh, 80px);
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    align-content: start;
}

#step6 #step6Selected::-webkit-scrollbar {
    width: 3px;
}

#step6 #step6Selected::-webkit-scrollbar-track {
    background: rgba(59, 130, 246, 0.1);
    border-radius: 10px;
}

#step6 #step6Selected::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.4);
    border-radius: 10px;
}

/* Tags compact */
#step6 .step6-tag {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border: none;
    border-radius: clamp(10px, 2.5vw, 14px);
    padding: clamp(5px, 1.2vh, 8px) clamp(8px, 2vw, 12px);
    font-size: clamp(10px, 2.3vw, 13px);
    font-weight: 700;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: clamp(5px, 1.2vw, 8px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 3px 10px rgba(59, 130, 246, 0.4);
    animation: tagPopIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    height: fit-content;
}

@keyframes tagPopIn {
    0% { opacity: 0; transform: translateY(-8px) scale(0.85); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

#step6 .step6-tag::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.3), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

#step6 .step6-tag:hover::before {
    opacity: 1;
}

#step6 .step6-tag:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.6);
}

#step6 .step6-tag:active {
    transform: scale(0.95);
}

#step6 .step6-tag i {
    font-size: clamp(9px, 2.2vw, 11px);
    transition: transform 0.3s;
}

#step6 .step6-tag:hover i {
    transform: rotate(180deg);
}

#step6 .step6-empty {
    color: #94a3b8;
    font-size: clamp(11px, 2.5vw, 13px);
    font-weight: 600;
    font-style: italic;
}

/* Grid container - flex: 1 pour prendre l'espace */
#step6 .step6-container {
    flex: 1;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(20px);
    border-radius: clamp(14px, 3.5vw, 20px);
    padding: clamp(8px, 2vh, 12px);
    margin-bottom: clamp(8px, 2vh, 12px);
    box-shadow: 
        0 6px 24px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.3);
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    min-height: 0;
}

#step6 .step6-container::-webkit-scrollbar {
    width: 4px;
}

#step6 .step6-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}

#step6 .step6-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
}

/* Grid NO SCROLL - Auto-adaptive */
#step6 .step6-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(clamp(70px, 20vw, 110px), 1fr));
    gap: clamp(6px, 1.5vw, 10px);
    padding: 2px;
}

/* Ajustements responsive intelligents */
@media (max-width: 360px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 361px) and (max-width: 480px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 481px) and (max-width: 768px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 769px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(4, 1fr);
        max-width: 800px;
        margin: 0 auto;
    }
}

/* Petits écrans en hauteur */
@media (max-height: 600px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-height: 500px) {
    #step6 .step6-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

/* Country card - Taille adaptive comme Step 2 */
#step6 .step6-card {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(59, 130, 246, 0.2);
    border-radius: clamp(12px, 3vw, 18px);
    padding: clamp(8px, 2vw, 14px) clamp(6px, 1.5vw, 10px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: clamp(4px, 1vh, 6px);
    aspect-ratio: 1 / 1.15;
    overflow: hidden;
    -webkit-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    will-change: transform;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
}

#step6 .step6-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(37, 99, 235, 0.08));
    opacity: 0;
    transition: opacity 0.3s;
    border-radius: inherit;
}

#step6 .step6-card:hover::before {
    opacity: 1;
}

#step6 .step6-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.25);
    border-color: rgba(59, 130, 246, 0.4);
}

#step6 .step6-card:active {
    transform: translateY(-1px) scale(0.98);
}

/* État sélectionné */
#step6 .step6-card.selected {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border-color: #3b82f6;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
    transform: translateY(-3px) scale(1.02);
}

#step6 .step6-card.selected::before {
    opacity: 1;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
}

#step6 .step6-card.selected::after {
    content: '✓';
    position: absolute;
    top: clamp(4px, 1vw, 6px);
    right: clamp(4px, 1vw, 6px);
    width: clamp(16px, 4vw, 22px);
    height: clamp(16px, 4vw, 22px);
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(10px, 2.5vw, 13px);
    font-weight: 900;
    color: #3b82f6;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    animation: checkPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes checkPop {
    0% { transform: scale(0) rotate(-180deg); opacity: 0; }
    100% { transform: scale(1) rotate(0deg); opacity: 1; }
}

#step6 .step6-card.selected .step6-card-name {
    color: white;
    font-weight: 800;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
}

#step6 .step6-checkbox {
    display: none;
}

#step6 .step6-card-name {
    font-size: clamp(10px, 2.5vw, 13px);
    font-weight: 700;
    color: #1e293b;
    text-align: center;
    line-height: 1.2;
    transition: color 0.3s;
    word-break: break-word;
    hyphens: auto;
}

/* Ripple effect optimisé */
.step6-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
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
#step6 .step6-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step6 .step6-back,
#step6 .step6-next {
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

#step6 .step6-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step6 .step6-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step6 .step6-back:active {
    transform: translateY(0);
}

#step6 .step6-next {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step6 .step6-next:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(16, 185, 129, 0.6);
}

#step6 .step6-next:active:not(:disabled) {
    transform: translateY(0);
}

#step6 .step6-next:disabled {
    background: rgba(148, 163, 184, 0.5);
    cursor: not-allowed;
    box-shadow: none;
}

/* Spinner */
.step6-spinner {
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

/* Toast notification compact */
#step6 .step6-toast {
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
    border: 2px solid rgba(59, 130, 246, 0.3);
}

#step6 .step6-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step6 .step6-toast.success {
    color: #10b981;
    border-color: rgba(16, 185, 129, 0.4);
}

#step6 .step6-toast.success i {
    color: #10b981;
    font-size: clamp(14px, 3.5vw, 18px);
}

#step6 .step6-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step6 .step6-toast.error i {
    color: #ef4444;
    font-size: clamp(14px, 3.5vw, 18px);
}
</style>

<fieldset id="step6" class="hidden" aria-labelledby="step6Title">
    <div class="step6-header">
        <div class="step6-icon">
            <i class="fas fa-globe-americas"></i>
        </div>
        <h2 id="step6Title" class="step6-title">Select Countries</h2>
        <p class="step6-subtitle">Choose your target destinations</p>
    </div>
    
    <div class="step6-selected-wrapper">
        <div class="step6-counter">
            <i class="fas fa-flag"></i>
            <span id="step6Counter">No selection</span>
        </div>
        <div id="step6Selected">
            <span class="step6-empty">Tap countries below ✨</span>
        </div>
    </div>
    
    <div class="step6-container">
        <div class="step6-grid">
            @foreach($countries as $country)
                <div class="step6-card" data-country="{{ $country->country }}" role="checkbox" aria-checked="false" tabindex="0">
                    <input type="checkbox" 
                           name="countries[]" 
                           value="{{ $country->country }}" 
                           class="step6-checkbox">
                    <span class="step6-card-name">{{ $country->country }}</span>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="step6-nav">
        <button type="button" id="backToStep5" class="step6-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="nextStep6" class="step6-next" disabled>
            <span id="nextStep6Text">Select country</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="step6-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step6-toast-text"></span>
    </div>
</fieldset>

<script>
// === ULTRA-OPTIMIZED ZERO SCROLL JS 🚀 ===
(function() {
    'use strict';
    
    const msgs = {
        success: ["Perfect! 🎉", "Excellent! 🌟", "Great pick! ✨", "Love it! 💫", "Awesome! 🎯"],
        error: ["Oops! Pick one 🌍", "Hey! Choose one 🗺️", "Hold on! Select one 📍"]
    };
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const selected = new Set();
        const MIN = 1;
        
        const step6 = document.getElementById('step6');
        if (!step6) return;
        
        const cards = step6.querySelectorAll('.step6-card');
        const nextBtn = document.getElementById('nextStep6');
        const backBtn = document.getElementById('backToStep5');
        const nextText = document.getElementById('nextStep6Text');
        const counter = document.getElementById('step6Counter');
        const selectedContainer = document.getElementById('step6Selected');
        const toast = step6.querySelector('.step6-toast');
        const toastText = step6.querySelector('.step6-toast-text');
        
        if (!cards.length || !nextBtn || !backBtn) return;
        
        function showToast(msg, type = 'success') {
            toast.classList.remove('error', 'success', 'show');
            toastText.textContent = msg;
            toast.classList.add(type, 'show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        
        function createRipple(e, el) {
            const ripple = document.createElement('span');
            ripple.className = 'step6-ripple';
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
                const count = selected.size;
                const counterEl = counter.parentElement;
                
                // Counter
                if (count === 0) {
                    counter.textContent = 'No selection';
                    counterEl.classList.remove('active');
                } else if (count === 1) {
                    counter.textContent = '1 country';
                    counterEl.classList.add('active');
                } else {
                    counter.textContent = `${count} countries`;
                    counterEl.classList.add('active');
                }
                
                // Selected list
                if (count === 0) {
                    selectedContainer.innerHTML = '<span class="step6-empty">Tap countries below ✨</span>';
                } else {
                    selectedContainer.innerHTML = '';
                    selected.forEach(name => {
                        const tag = document.createElement('div');
                        tag.className = 'step6-tag';
                        tag.innerHTML = `${name}<i class="fas fa-times"></i>`;
                        tag.addEventListener('click', () => {
                            const card = step6.querySelector(`.step6-card[data-country="${name}"]`);
                            if (card) toggleCountry(card);
                        });
                        selectedContainer.appendChild(tag);
                    });
                }
                
                // Next button
                if (count >= MIN) {
                    nextBtn.disabled = false;
                    nextText.textContent = count === 1 ? 'Continue' : `Continue (${count})`;
                } else {
                    nextBtn.disabled = true;
                    nextText.textContent = 'Select country';
                }
            });
        }
        
        let saveTimer;
        function save() {
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => {
                try {
                    localStorage.setItem('selectedCountries', JSON.stringify([...selected]));
                } catch(e) {}
            }, 300);
        }
        
        function toggleCountry(card) {
            const name = card.dataset.country;
            const checkbox = card.querySelector('.step6-checkbox');
            
            if (selected.has(name)) {
                selected.delete(name);
                card.classList.remove('selected');
                card.setAttribute('aria-checked', 'false');
                checkbox.checked = false;
                showToast(`${name} removed ❌`, 'error');
                haptic(40);
            } else {
                selected.add(name);
                card.classList.add('selected');
                card.setAttribute('aria-checked', 'true');
                checkbox.checked = true;
                const msg = msgs.success[Math.floor(Math.random() * msgs.success.length)];
                showToast(`${name} - ${msg}`, 'success');
                haptic(50);
            }
            
            updateUI();
            save();
            
            if (typeof window.updateNextButton === 'function') {
                window.updateNextButton();
            }
        }
        
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                createRipple(e, this);
                toggleCountry(this);
            });
            
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleCountry(this);
                }
            });
        });
        
        nextBtn.addEventListener('click', function() {
            if (selected.size < MIN) {
                const msg = msgs.error[Math.floor(Math.random() * msgs.error.length)];
                showToast(msg, 'error');
                haptic([200, 100, 200]);
                return;
            }
            
            if (nextText) {
                const originalText = nextText.textContent;
                nextText.innerHTML = '<div class="step6-spinner"></div>Loading...';
                setTimeout(() => nextText.textContent = originalText, 800);
            }
            
            haptic(100);
        });
        
        backBtn.addEventListener('click', () => haptic(30));
        
        // Restore
        try {
            const saved = localStorage.getItem('selectedCountries');
            if (saved) {
                JSON.parse(saved).forEach(name => {
                    const card = step6.querySelector(`.step6-card[data-country="${name}"]`);
                    if (card) {
                        const checkbox = card.querySelector('.step6-checkbox');
                        selected.add(name);
                        card.classList.add('selected');
                        card.setAttribute('aria-checked', 'true');
                        if (checkbox) checkbox.checked = true;
                    }
                });
                updateUI();
            }
        } catch(e) {}
        
        updateUI();
        console.log('🚀 Step 6 ready - Zero Scroll Mobile-First Perfect');
    }
})();
</script>