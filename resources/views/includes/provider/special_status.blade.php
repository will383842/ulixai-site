<!-- Step 7: Special Status - ZERO SCROLL MOBILE-FIRST PERFECTION 🚀 -->
<!-- 200% Mobile-First | NO SCROLL | Lightning Fast | 2 Columns Desktop -->

<style>
/* === ZERO SCROLL MOBILE-FIRST FOUNDATION === */
#step7 {
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
        #f59e0b 0%, 
        #d97706 25%, 
        #fbbf24 50%, 
        #f59e0b 75%, 
        #d97706 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#step7.hidden {
    display: none !important;
}

/* Header ultra-compact mobile-first */
#step7 .step7-header {
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
#step7 .step7-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 
        0 0 30px rgba(245, 158, 11, 0.7),
        0 4px 12px rgba(245, 158, 11, 0.4);
    animation: iconFloat 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step7 .step7-icon i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

/* Titre compact */
#step7 .step7-title {
    font-size: clamp(16px, 4vw, 24px);
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 clamp(3px, 1vh, 6px);
    line-height: 1.2;
    letter-spacing: -0.02em;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
}

#step7 .step7-subtitle {
    font-size: clamp(11px, 2.5vw, 14px);
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    margin: 0;
    line-height: 1.3;
}

/* Info banner compact */
#step7 .step7-info-banner {
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

#step7 .step7-info-text {
    font-size: clamp(10px, 2.3vw, 12px);
    color: #78350f;
    font-weight: 700;
    text-align: center;
    margin: 0;
    line-height: 1.3;
}

/* Selected container - COMPACT */
#step7 .step7-selected-wrapper {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: clamp(12px, 3vw, 18px);
    padding: clamp(8px, 2vh, 12px);
    margin-bottom: clamp(8px, 2vh, 12px);
    box-shadow: 
        0 4px 16px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    border: 2px solid rgba(245, 158, 11, 0.3);
    flex-shrink: 0;
    animation: containerPop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex;
    flex-direction: column;
    gap: clamp(6px, 1.5vh, 8px);
}

@keyframes containerPop {
    0% { opacity: 0; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}

/* Counter badge */
#step7 .step7-counter {
    display: inline-flex;
    align-items: center;
    gap: clamp(6px, 1.5vw, 8px);
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: clamp(5px, 1.2vh, 8px) clamp(10px, 2.5vw, 14px);
    border-radius: clamp(14px, 3.5vw, 20px);
    font-size: clamp(10px, 2.3vw, 12px);
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    align-self: flex-start;
}

#step7 .step7-counter.active {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
}

#step7 .step7-counter i {
    font-size: clamp(9px, 2.2vw, 11px);
}

/* Selected tags container - scrollable */
#step7 #step7Selected {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: clamp(4px, 1vw, 6px);
    max-height: clamp(50px, 10vh, 70px);
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    align-content: start;
}

#step7 #step7Selected::-webkit-scrollbar {
    width: 3px;
}

#step7 #step7Selected::-webkit-scrollbar-track {
    background: rgba(245, 158, 11, 0.1);
    border-radius: 10px;
}

#step7 #step7Selected::-webkit-scrollbar-thumb {
    background: rgba(245, 158, 11, 0.5);
    border-radius: 10px;
}

/* Tags compact */
#step7 .step7-tag {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    border-radius: clamp(8px, 2vw, 12px);
    padding: clamp(4px, 1vh, 6px) clamp(8px, 2vw, 10px);
    font-size: clamp(9px, 2.2vw, 11px);
    font-weight: 700;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: clamp(4px, 1vw, 6px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 3px 10px rgba(245, 158, 11, 0.4);
    animation: tagPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    height: fit-content;
}

@keyframes tagPop {
    0% { opacity: 0; transform: scale(0.8); }
    100% { opacity: 1; transform: scale(1); }
}

#step7 .step7-tag::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.3), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

#step7 .step7-tag:hover::before {
    opacity: 1;
}

#step7 .step7-tag:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 5px 15px rgba(245, 158, 11, 0.6);
}

#step7 .step7-tag:active {
    transform: scale(0.95);
}

#step7 .step7-tag i {
    font-size: clamp(8px, 2vw, 10px);
    transition: transform 0.3s;
}

#step7 .step7-tag:hover i {
    transform: rotate(180deg);
}

#step7 .step7-empty {
    color: #94a3b8;
    font-size: clamp(10px, 2.3vw, 12px);
    font-weight: 600;
    font-style: italic;
}

/* List container - ULTRA optimisé */
#step7 .step7-container {
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

#step7 .step7-container::-webkit-scrollbar {
    width: 4px;
}

#step7 .step7-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}

#step7 .step7-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
}

/* Grid adaptative - 2 colonnes desktop */
#step7 .step7-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(6px, 1.5vw, 10px);
    padding: 2px;
}

/* Responsive - 2 colonnes sur tablet/desktop */
@media (min-width: 481px) {
    #step7 .step7-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 769px) {
    #step7 .step7-grid {
        grid-template-columns: repeat(2, 1fr);
        max-width: 800px;
        margin: 0 auto;
    }
}

/* Status card - ULTRA compact et cliquable */
#step7 .step7-card {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(245, 158, 11, 0.3);
    border-radius: clamp(12px, 3vw, 18px);
    padding: clamp(10px, 2.5vh, 14px) clamp(12px, 3vw, 16px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: clamp(8px, 2vw, 12px);
    -webkit-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    will-change: transform;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);
    position: relative;
    overflow: hidden;
    min-height: clamp(44px, 10vw, 56px);
}

#step7 .step7-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.08), rgba(217, 119, 6, 0.08));
    opacity: 0;
    transition: opacity 0.3s;
    border-radius: inherit;
}

#step7 .step7-card:hover::before {
    opacity: 1;
}

#step7 .step7-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
    border-color: rgba(245, 158, 11, 0.5);
}

#step7 .step7-card:active {
    transform: translateY(-1px) scale(0.98);
}

/* État sélectionné ULTRA */
#step7 .step7-card.selected {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-color: #f59e0b;
    box-shadow: 0 6px 24px rgba(245, 158, 11, 0.6);
    transform: translateY(-3px) scale(1.02);
}

#step7 .step7-card.selected::before {
    opacity: 1;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
}

#step7 .step7-card.selected .step7-card-name {
    color: white;
    font-weight: 800;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

#step7 .step7-card.selected .step7-check {
    opacity: 1;
    transform: scale(1) rotate(0deg);
}

/* Check mark */
#step7 .step7-check {
    width: clamp(18px, 4.5vw, 24px);
    height: clamp(18px, 4.5vw, 24px);
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    opacity: 0;
    transform: scale(0) rotate(-180deg);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.5);
    margin-left: auto;
}

#step7 .step7-check i {
    color: white;
    font-size: clamp(9px, 2.2vw, 12px);
    font-weight: 900;
}

/* Status text */
#step7 .step7-card-name {
    font-size: clamp(11px, 2.8vw, 14px);
    font-weight: 600;
    color: #1e293b;
    transition: all 0.3s;
    line-height: 1.3;
    word-break: break-word;
    flex: 1;
}

/* Checkbox caché */
#step7 .step7-checkbox {
    display: none;
}

/* Ripple effect */
.step7-ripple {
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
#step7 .step7-nav {
    display: flex;
    gap: clamp(8px, 2vw, 12px);
    flex-shrink: 0;
}

#step7 .step7-back,
#step7 .step7-next {
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

#step7 .step7-back {
    background: rgba(255, 255, 255, 0.95);
    color: #475569;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#step7 .step7-back:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

#step7 .step7-back:active {
    transform: translateY(0);
}

#step7 .step7-next {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

#step7 .step7-next:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(16, 185, 129, 0.6);
}

#step7 .step7-next:active {
    transform: translateY(0);
}

/* Spinner */
.step7-spinner {
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
#step7 .step7-toast {
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
    border: 2px solid rgba(245, 158, 11, 0.3);
}

#step7 .step7-toast.show {
    transform: translateX(-50%) translateY(0);
}

#step7 .step7-toast.success {
    color: #10b981;
    border-color: rgba(16, 185, 129, 0.4);
}

#step7 .step7-toast.success i {
    color: #10b981;
    font-size: clamp(14px, 3.5vw, 18px);
}

#step7 .step7-toast.error {
    color: #ef4444;
    border-color: rgba(239, 68, 68, 0.4);
}

#step7 .step7-toast.error i {
    color: #ef4444;
    font-size: clamp(14px, 3.5vw, 18px);
}
</style>

<fieldset id="step7" class="hidden" aria-labelledby="step7Title">
    <div class="step7-header">
        <div class="step7-icon">
            <i class="fas fa-award"></i>
        </div>
        <h2 id="step7Title" class="step7-title">Special Status</h2>
        <p class="step7-subtitle">Do you have any special status?</p>
    </div>
    
    <div class="step7-info-banner">
        <p class="step7-info-text">✨ Not obligatory but better for you ✨</p>
    </div>
    
    <div class="step7-selected-wrapper">
        <div class="step7-counter">
            <i class="fas fa-star"></i>
            <span id="step7Counter">No selection</span>
        </div>
        <div id="step7Selected">
            <span class="step7-empty">Tap cards below 🎯</span>
        </div>
    </div>
    
    <div class="step7-container">
        <div class="step7-grid">
            @php
                $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
            @endphp
            
            @foreach($statuses as $label)
                <div class="step7-card" data-status="{{ $label }}" role="button" aria-pressed="false" tabindex="0">
                    <span class="step7-card-name">{{ $label }}</span>
                    <div class="step7-check"><i class="fas fa-check"></i></div>
                    <input type="checkbox" 
                           name="special_status[]" 
                           value="{{ $label }}" 
                           class="step7-checkbox">
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="step7-nav">
        <button type="button" id="backToStep6" class="step7-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        <button type="button" id="nextStep7" class="step7-next">
            <span id="nextStep7Text">Next</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="step7-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step7-toast-text"></span>
    </div>
</fieldset>

<script>
// === ULTRA-OPTIMIZED ZERO SCROLL JS 🚀 ===
(function() {
    'use strict';
    
    const msgs = {
        success: ["Perfect! 🎉", "Excellent! 🌟", "Great pick! ✨", "Love it! 💫", "Awesome! 🎯"],
        error: ["Removed! 🗑️", "Bye bye! 👋", "Deselected! ❌", "Gone! 💨"]
    };
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        const selected = new Set();
        
        const step7 = document.getElementById('step7');
        if (!step7) return;
        
        const cards = step7.querySelectorAll('.step7-card');
        const nextBtn = document.getElementById('nextStep7');
        const backBtn = document.getElementById('backToStep6');
        const nextText = document.getElementById('nextStep7Text');
        const counter = document.getElementById('step7Counter');
        const selectedContainer = document.getElementById('step7Selected');
        const toast = step7.querySelector('.step7-toast');
        const toastText = step7.querySelector('.step7-toast-text');
        
        if (!cards.length || !nextBtn || !backBtn) return;
        
        function showToast(msg, type = 'success') {
            toast.classList.remove('error', 'success', 'show');
            toastText.textContent = msg;
            toast.classList.add(type, 'show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        
        function createRipple(e, el) {
            const ripple = document.createElement('span');
            ripple.className = 'step7-ripple';
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
                    counter.textContent = '1 status';
                    counterEl.classList.add('active');
                } else {
                    counter.textContent = `${count} statuses`;
                    counterEl.classList.add('active');
                }
                
                // Selected list
                if (count === 0) {
                    selectedContainer.innerHTML = '<span class="step7-empty">Tap cards below 🎯</span>';
                } else {
                    selectedContainer.innerHTML = '';
                    selected.forEach(name => {
                        const tag = document.createElement('div');
                        tag.className = 'step7-tag';
                        tag.innerHTML = `${name}<i class="fas fa-times"></i>`;
                        tag.addEventListener('click', () => {
                            const card = step7.querySelector(`.step7-card[data-status="${name}"]`);
                            if (card) toggleStatus(card);
                        });
                        selectedContainer.appendChild(tag);
                    });
                }
                
                // Next button text
                nextText.textContent = 'Next';
            });
        }
        
        let saveTimer;
        function save() {
            clearTimeout(saveTimer);
            saveTimer = setTimeout(() => {
                try {
                    localStorage.setItem('selectedStatuses', JSON.stringify([...selected]));
                } catch(e) {}
            }, 300);
        }
        
        function toggleStatus(card) {
            const name = card.dataset.status;
            const checkbox = card.querySelector('.step7-checkbox');
            
            if (selected.has(name)) {
                selected.delete(name);
                card.classList.remove('selected');
                card.setAttribute('aria-pressed', 'false');
                checkbox.checked = false;
                const msg = msgs.error[Math.floor(Math.random() * msgs.error.length)];
                showToast(`${name} ${msg}`, 'error');
                haptic(40);
            } else {
                selected.add(name);
                card.classList.add('selected');
                card.setAttribute('aria-pressed', 'true');
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
                toggleStatus(this);
            });
            
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleStatus(this);
                }
            });
        });
        
        nextBtn.addEventListener('click', function() {
            if (nextText) {
                const originalText = nextText.textContent;
                nextText.innerHTML = '<div class="step7-spinner"></div>Loading...';
                setTimeout(() => nextText.textContent = originalText, 800);
            }
            
            haptic(100);
            console.log('✅ Selected statuses:', [...selected]);
        });
        
        backBtn.addEventListener('click', () => haptic(30));
        
        // Restore
        try {
            const saved = localStorage.getItem('selectedStatuses');
            if (saved) {
                JSON.parse(saved).forEach(name => {
                    const card = step7.querySelector(`.step7-card[data-status="${name}"]`);
                    if (card) {
                        const checkbox = card.querySelector('.step7-checkbox');
                        selected.add(name);
                        card.classList.add('selected');
                        card.setAttribute('aria-pressed', 'true');
                        if (checkbox) checkbox.checked = true;
                    }
                });
                updateUI();
            }
        } catch(e) {}
        
        updateUI();
        console.log('🚀 Step 7 ready - Zero Scroll Mobile-First PERFECTION!');
    }
})();
</script>