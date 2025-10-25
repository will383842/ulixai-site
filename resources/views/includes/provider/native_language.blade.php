<!-- Step 2: Native Language - ZERO SCROLL PERFECTION 🚀 -->
<!-- Auto-adapts to viewport, 200% mobile-first, NO SCROLL EVER -->

<style>
/* === ZERO SCROLL - AUTO-ADAPTIVE DESIGN === */
#step2 {
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
}

#step2.hidden {
    display: none !important;
}

/* Header ultra-compact */
#step2 .step2-header-content {
    text-align: center;
    margin-bottom: clamp(8px, 2vh, 16px);
    flex-shrink: 0;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#step2 .step2-icon-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: clamp(32px, 6vw, 44px);
    height: clamp(32px, 6vw, 44px);
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: clamp(10px, 2vw, 16px);
    margin-bottom: clamp(6px, 1.5vh, 10px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-4px); }
}

#step2 .step2-icon-badge i {
    color: white;
    font-size: clamp(14px, 3vw, 20px);
}

#step2 .step2-main-title {
    font-size: clamp(16px, 4vw, 24px);
    font-weight: 800;
    color: #111827;
    margin: 0 0 clamp(3px, 1vh, 6px);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

#step2 .step2-subtitle-text {
    font-size: clamp(11px, 2.5vw, 14px);
    color: #6b7280;
    margin: 0;
    line-height: 1.3;
}

/* Grid NO SCROLL - Auto-adaptive avec gap flexible */
#step2 .step2-languages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(clamp(70px, 20vw, 110px), 1fr));
    gap: clamp(6px, 1.5vw, 14px);
    flex: 1;
    align-content: start;
    overflow: hidden;
    padding: 2px;
}

/* Ajustements responsive intelligents */
@media (max-width: 360px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 361px) and (max-width: 480px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 481px) and (max-width: 768px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 769px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(4, 1fr);
        max-width: 800px;
        margin: 0 auto;
    }
}

/* Petits écrans en hauteur */
@media (max-height: 600px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-height: 500px) {
    #step2 .step2-languages-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

/* Language button - Taille adaptive */
#step2 .lang-btn {
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: clamp(12px, 3vw, 18px);
    padding: clamp(8px, 2vw, 14px) clamp(6px, 1.5vw, 10px);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: clamp(4px, 1vh, 8px);
    aspect-ratio: 1 / 1.15;
    overflow: hidden;
    -webkit-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    will-change: transform;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
}

#step2 .lang-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(139, 92, 246, 0.08));
    opacity: 0;
    transition: opacity 0.3s;
    border-radius: inherit;
}

#step2 .lang-btn:hover::before {
    opacity: 1;
}

#step2 .lang-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(99, 102, 241, 0.15);
    border-color: #c7d2fe;
}

#step2 .lang-btn:active {
    transform: translateY(-1px) scale(0.98);
}

#step2 .lang-btn.selected {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-color: #6366f1;
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    transform: translateY(-3px) scale(1.02);
}

#step2 .lang-btn.selected::before {
    opacity: 1;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
}

/* Flag adaptive */
#step2 .lang-flag {
    width: clamp(28px, 6vw, 44px);
    height: clamp(28px, 6vw, 44px);
    border-radius: clamp(8px, 2vw, 14px);
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    position: relative;
    flex-shrink: 0;
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
}

#step2 .lang-btn:hover .lang-flag {
    transform: scale(1.08) rotate(3deg);
}

#step2 .lang-btn.selected .lang-flag {
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

#step2 .lang-flag-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    position: absolute;
    inset: 0;
    z-index: 3;
    transition: opacity 0.3s;
}

#step2 .lang-flag-emoji {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: clamp(16px, 4vw, 26px);
    z-index: 2;
    line-height: 1;
}

#step2 .lang-flag-img.loaded ~ .lang-flag-emoji {
    display: none;
}

/* Language name - Responsive font */
#step2 .lang-name {
    font-size: clamp(10px, 2.5vw, 14px);
    font-weight: 700;
    color: #374151;
    text-align: center;
    line-height: 1.2;
    transition: all 0.3s;
    position: relative;
    z-index: 2;
    letter-spacing: -0.01em;
    word-break: break-word;
    hyphens: auto;
    max-width: 100%;
}

#step2 .lang-btn.selected .lang-name {
    color: white;
    font-weight: 800;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Checkmark adaptive */
#step2 .lang-check {
    position: absolute;
    top: clamp(4px, 1vw, 8px);
    right: clamp(4px, 1vw, 8px);
    width: clamp(16px, 3.5vw, 22px);
    height: clamp(16px, 3.5vw, 22px);
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0);
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    z-index: 5;
}

#step2 .lang-btn.selected .lang-check {
    opacity: 1;
    transform: scale(1);
    animation: checkBounce 0.5s ease-out;
}

@keyframes checkBounce {
    0% { transform: scale(0); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
}

#step2 .lang-check i {
    color: #6366f1;
    font-size: clamp(8px, 2vw, 11px);
}

/* Toast compact */
#step2 .step2-toast {
    position: fixed;
    bottom: clamp(16px, 3vh, 24px);
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: clamp(10px, 2vh, 14px) clamp(16px, 4vw, 24px);
    border-radius: clamp(12px, 3vw, 16px);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    font-weight: 600;
    font-size: clamp(12px, 2.5vw, 14px);
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: clamp(6px, 1.5vw, 10px);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
    max-width: 90vw;
}

#step2 .step2-toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* Navigation compact NO SCROLL */
#step2 .step2-navigation {
    display: flex;
    flex-direction: row;
    gap: clamp(8px, 2vw, 12px);
    justify-content: space-between;
    margin-top: clamp(8px, 2vh, 16px);
    flex-shrink: 0;
}

/* Buttons adaptifs */
#step2 #nextStep2 {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    font-weight: 700;
    font-size: clamp(13px, 3vw, 15px);
    padding: clamp(12px, 2.5vh, 16px) clamp(20px, 5vw, 32px);
    border-radius: clamp(12px, 3vw, 16px);
    border: none;
    box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(6px, 1.5vw, 10px);
    flex: 1;
    min-height: clamp(44px, 8vh, 52px);
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

#step2 #nextStep2::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

#step2 #nextStep2:hover::before {
    opacity: 1;
}

#step2 #nextStep2:disabled {
    background: linear-gradient(135deg, #d1d5db, #9ca3af);
    box-shadow: none;
    cursor: not-allowed;
    opacity: 0.6;
}

#step2 #nextStep2:not(:disabled):hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.5);
}

#step2 #nextStep2:not(:disabled):active {
    transform: translateY(0);
}

#step2 #backToStep1 {
    color: #6366f1;
    font-weight: 600;
    font-size: clamp(13px, 3vw, 15px);
    padding: clamp(12px, 2.5vh, 16px) clamp(16px, 4vw, 24px);
    border-radius: clamp(12px, 3vw, 16px);
    background: #f3f4f6;
    border: 2px solid #e5e7eb;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(6px, 1.5vw, 10px);
    flex: 0.7;
    min-height: clamp(44px, 8vh, 52px);
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    white-space: nowrap;
}

#step2 #backToStep1:hover {
    border-color: #6366f1;
    background: #eef2ff;
    transform: translateY(-2px);
}

#step2 #backToStep1:active {
    transform: translateY(0);
}

/* Spinner */
#step2 .step2-spinner {
    display: inline-block;
    width: clamp(12px, 3vw, 16px);
    height: clamp(12px, 3vw, 16px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Ripple */
#step2 .step2-ripple {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.4), transparent);
    transform: scale(0);
    animation: ripple 0.6s ease-out;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Focus */
#step2 *:focus-visible {
    outline: 2px solid #6366f1;
    outline-offset: 3px;
    border-radius: 6px;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    #step2 *,
    #step2 *::before,
    #step2 *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}

/* Dark mode */
@media (prefers-color-scheme: dark) {
    #step2 .lang-btn {
        background: #1f2937;
        border-color: #374151;
    }
    #step2 .lang-name {
        color: #e5e7eb;
    }
    #step2 .step2-main-title {
        color: #f9fafb;
    }
    #step2 .step2-subtitle-text {
        color: #9ca3af;
    }
    #step2 #backToStep1 {
        background: #374151;
        border-color: #4b5563;
        color: #a5b4fc;
    }
}
</style>

<!-- Preload drapeaux critiques -->
<link rel="preload" as="image" href="https://flagcdn.com/w80/gb.png">
<link rel="preload" as="image" href="https://flagcdn.com/w80/fr.png">
<link rel="preload" as="image" href="https://flagcdn.com/w80/es.png">

<fieldset id="step2" class="form-step hidden">
    <legend class="sr-only">Select your native language</legend>
    
    <div class="step2-header-content">
        <div class="step2-icon-badge">
            <i class="fas fa-globe"></i>
        </div>
        <h2 class="step2-main-title">What's your native language? 🌍</h2>
        <p class="step2-subtitle-text">Pick the one you're most comfortable with ✨</p>
    </div>
    
    <div class="step2-languages-grid">
        <button type="button" class="lang-btn" data-lang="English" data-code="en" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/gb.png" alt="" decoding="async" fetchpriority="high">
                <div class="lang-flag-emoji">🇬🇧</div>
            </div>
            <span class="lang-name">English</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="French" data-code="fr" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/fr.png" alt="" decoding="async" fetchpriority="high">
                <div class="lang-flag-emoji">🇫🇷</div>
            </div>
            <span class="lang-name">Français</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="German" data-code="de" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/de.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇩🇪</div>
            </div>
            <span class="lang-name">Deutsch</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Russian" data-code="ru" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/ru.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇷🇺</div>
            </div>
            <span class="lang-name">Русский</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Chinese" data-code="zh" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/cn.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇨🇳</div>
            </div>
            <span class="lang-name">中文</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Spanish" data-code="es" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/es.png" alt="" decoding="async" fetchpriority="high">
                <div class="lang-flag-emoji">🇪🇸</div>
            </div>
            <span class="lang-name">Español</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Portuguese" data-code="pt" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/pt.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇵🇹</div>
            </div>
            <span class="lang-name">Português</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Arabic" data-code="ar" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/sa.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇸🇦</div>
            </div>
            <span class="lang-name">العربية</span>
        </button>
        
        <button type="button" class="lang-btn" data-lang="Hindi" data-code="hi" tabindex="0" aria-pressed="false">
            <div class="lang-check"><i class="fas fa-check"></i></div>
            <div class="lang-flag">
                <img class="lang-flag-img" src="https://flagcdn.com/w80/in.png" alt="" decoding="async">
                <div class="lang-flag-emoji">🇮🇳</div>
            </div>
            <span class="lang-name">हिन्दी</span>
        </button>
    </div>
    
    <div class="step2-navigation">
        <button type="button" id="backToStep1">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
        
        <button type="button" id="nextStep2" disabled>
            <span id="nextStep2Text">Continue</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    
    <input type="hidden" id="nativeLanguage" name="nativeLanguage" value="">
    
    <div class="step2-toast">
        <i class="fas fa-check-circle"></i>
        <span class="step2-toast-text"></span>
    </div>
</fieldset>

<script>
// === ULTRA-OPTIMIZED ZERO SCROLL JS 🚀 ===
(function() {
    'use strict';
    
    const messages = [
        "Perfect choice! 🎉",
        "Excellent! 🌟",
        "Great pick! ✨",
        "Love it! 💫",
        "Awesome! 🎯"
    ];
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStep2);
    } else {
        initStep2();
    }
    
    function initStep2() {
        let selectedLang = null;
        
        const step2 = document.getElementById('step2');
        if (!step2) return;
        
        const langBtns = step2.querySelectorAll('.lang-btn');
        const nextBtn = document.getElementById('nextStep2');
        const backBtn = document.getElementById('backToStep1');
        const nextText = document.getElementById('nextStep2Text');
        const hiddenInput = document.getElementById('nativeLanguage');
        const toast = step2.querySelector('.step2-toast');
        const toastText = step2.querySelector('.step2-toast-text');
        
        if (!langBtns.length || !nextBtn || !backBtn) return;
        
        function showToast(lang) {
            const message = messages[Math.floor(Math.random() * messages.length)];
            toastText.textContent = `${lang} - ${message}`;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }
        
        function createRipple(e, el) {
            const ripple = document.createElement('span');
            ripple.className = 'step2-ripple';
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
        
        function selectLanguage(btn) {
            const lang = btn.dataset.lang;
            const code = btn.dataset.code;
            const langName = btn.querySelector('.lang-name').textContent;
            
            langBtns.forEach(b => {
                b.classList.remove('selected');
                b.setAttribute('aria-pressed', 'false');
            });
            
            btn.classList.add('selected');
            btn.setAttribute('aria-pressed', 'true');
            
            selectedLang = { lang, code };
            
            if (hiddenInput) hiddenInput.value = lang;
            
            try {
                localStorage.setItem('nativeLanguage', lang);
                localStorage.setItem('nativeLanguageCode', code);
            } catch(e) {}
            
            nextBtn.disabled = false;
            nextText.textContent = 'Continue →';
            
            haptic(50);
            showToast(langName);
            
            if (typeof window.updateNextButton === 'function') {
                window.updateNextButton();
            }
        }
        
        langBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                createRipple(e, this);
                selectLanguage(this);
            });
            
            btn.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    selectLanguage(this);
                }
            });
            
            const img = btn.querySelector('.lang-flag-img');
            if (img && 'decode' in img) {
                img.decode()
                    .then(() => {
                        img.classList.add('loaded');
                        img.style.opacity = '1';
                    })
                    .catch(() => img.style.display = 'none');
            }
        });
        
        nextBtn.addEventListener('click', function() {
            if (!selectedLang) {
                const alertMsg = "Oops! Pick your language first 😊";
                if (toastText) {
                    toastText.textContent = alertMsg;
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 2500);
                } else {
                    alert(alertMsg);
                }
                return;
            }
            
            if (nextText) {
                const originalText = nextText.textContent;
                nextText.innerHTML = '<div class="step2-spinner"></div>Loading...';
                setTimeout(() => nextText.textContent = originalText, 800);
            }
            
            haptic(100);
        });
        
        backBtn.addEventListener('click', () => haptic(30));
        
        try {
            const saved = localStorage.getItem('nativeLanguage');
            if (saved) {
                const savedBtn = step2.querySelector(`.lang-btn[data-lang="${saved}"]`);
                if (savedBtn) {
                    savedBtn.classList.add('selected');
                    savedBtn.setAttribute('aria-pressed', 'true');
                    selectedLang = {
                        lang: saved,
                        code: savedBtn.dataset.code
                    };
                    if (hiddenInput) hiddenInput.value = saved;
                    nextBtn.disabled = false;
                    nextText.textContent = 'Continue →';
                }
            }
        } catch(e) {}
        
        console.log('🚀 Step 2 ready - Zero Scroll Perfect Adaptive');
    }
})();
</script>