(function() {
    'use strict';
    
    // ═══════════════════════════════════════════════════════════
    // 🎯 CONFIGURATION
    // ═══════════════════════════════════════════════════════════
    const CONFIG = {
        DEBOUNCE_DELAY: 300,
        SUBMIT_COOLDOWN: 5000,
        MIN_FORM_TIME: 10,
        IMAGE_MAX_SIZE: 5 * 1024 * 1024,
        IMAGE_MAX_WIDTH: 1200,
        IMAGE_QUALITY: 0.8,
        VALID_IMAGE_TYPES: ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']
    };
    
    // ═══════════════════════════════════════════════════════════
    // 🔒 VARIABLES GLOBALES
    // ═══════════════════════════════════════════════════════════
    let userScenario = 'new';
    let userFirstName = '';
    let isPasswordVerificationMode = false;
    let formSubmitting = false;
    let lastSubmitTime = 0;
    let currentStep = 0;
    const totalSteps = 15;
    
    const DOM = {
        steps: null, nextBtn: null, prevBtn: null, progressBar: null,
        stepLabel: null, stepCounter: null, funText: null, stickyNav: null,
        requestTitle: null, titleCount: null, titleCounter: null,
        moreDetails: null, detailsCount: null, detailsCounter: null,
        password: null, strengthBar: null, strengthLabel: null,
        cachedSelectors: { supportType: null, urgency: null, languages: null, lastUpdate: 0 }
    };
    
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // localStorage cache
    let localStorageCache = null;
    let cacheTimestamp = 0;
    const CACHE_DURATION = 500;
    
    // ═══════════════════════════════════════════════════════════
    // ♿ ACCESSIBILITÉ
    // ═══════════════════════════════════════════════════════════
    function announce(message, priority = 'polite') {
        let announcer = document.getElementById('a11y-announcer');
        if (!announcer) {
            announcer = document.createElement('div');
            announcer.id = 'a11y-announcer';
            announcer.className = 'sr-only';
            announcer.setAttribute('aria-live', priority);
            announcer.setAttribute('aria-atomic', 'true');
            document.body.appendChild(announcer);
        }
        announcer.textContent = '';
        setTimeout(() => { announcer.textContent = message; }, 100);
        setTimeout(() => { announcer.textContent = ''; }, 3000);
    }
    
    // ═══════════════════════════════════════════════════════════
    // ⚡ PERFORMANCE
    // ═══════════════════════════════════════════════════════════
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    function getCachedSelector(name, selector, maxAge = 1000) {
        const now = Date.now();
        if (DOM.cachedSelectors[name] && (now - DOM.cachedSelectors.lastUpdate) < maxAge) {
            return DOM.cachedSelectors[name];
        }
        DOM.cachedSelectors[name] = document.querySelector(selector);
        DOM.cachedSelectors.lastUpdate = now;
        return DOM.cachedSelectors[name];
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🛡️ SÉCURITÉ
    // ═══════════════════════════════════════════════════════════
    function sanitizeHTML(str) {
        if (typeof str !== 'string') return '';
        const temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        return emailRegex.test(email) && email.length <= 254;
    }
    
    function validateImageFile(file) {
        if (!file) throw new Error('No file provided');
        if (!CONFIG.VALID_IMAGE_TYPES.includes(file.type)) {
            throw new Error('Invalid file type. Only images (JPG, PNG, GIF, WebP) are allowed.');
        }
        if (file.size > CONFIG.IMAGE_MAX_SIZE) {
            throw new Error('File size must be less than 5MB');
        }
        return true;
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🖼️ COMPRESSION D'IMAGES
    // ═══════════════════════════════════════════════════════════
    function compressImage(file, maxWidth = CONFIG.IMAGE_MAX_WIDTH, quality = CONFIG.IMAGE_QUALITY) {
        return new Promise((resolve, reject) => {
            try {
                validateImageFile(file);
                const reader = new FileReader();
                reader.onerror = () => reject(new Error('Failed to read file'));
                reader.onload = (e) => {
                    const img = new Image();
                    img.onerror = () => reject(new Error('Failed to load image'));
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let width = img.width, height = img.height;
                        if (width > maxWidth) {
                            height = Math.round((height * maxWidth) / width);
                            width = maxWidth;
                        }
                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d', { alpha: false });
                        if (!ctx) { reject(new Error('Failed to get canvas context')); return; }
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, width, height);
                        canvas.toBlob((blob) => {
                            if (!blob) { reject(new Error('Failed to compress image')); return; }
                            const compressedFile = new File([blob], file.name.replace(/\.\w+$/, '.jpg'), { type: 'image/jpeg', lastModified: Date.now() });
                            console.log('📸 Compression:', Math.round(file.size / 1024) + 'KB →', Math.round(compressedFile.size / 1024) + 'KB');
                            resolve(compressedFile);
                        }, 'image/jpeg', quality);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } catch (error) { reject(error); }
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📦 CONFIGURATION GLOBALE (depuis Blade)
    // ═══════════════════════════════════════════════════════════
    const funTexts = window.formConfig?.funTexts || [];
    const stepLabels = window.formConfig?.stepLabels || [];
    const isAuthenticated = window.formConfig?.isAuthenticated || false;
    const checkEmailUrl = window.formConfig?.checkEmailUrl || '';
    const verifyPasswordUrl = window.formConfig?.verifyPasswordUrl || '';
    
    // ═══════════════════════════════════════════════════════════
    // 🎯 INITIALISATION DOM
    // ═══════════════════════════════════════════════════════════
    function initDOMElements() {
        console.log('🔍 [DOM] Searching for elements...');
        
        DOM.steps = document.querySelectorAll('.form-step');
        DOM.nextBtn = document.getElementById('nextBtn');
        DOM.prevBtn = document.getElementById('prevBtn');
        DOM.progressBar = document.getElementById('progressBar');
        DOM.stepLabel = document.getElementById('formStepLabel');
        DOM.stepCounter = document.getElementById('stepCounter');
        DOM.funText = document.getElementById('funText');
        DOM.stickyNav = document.getElementById('stickyNav');
        DOM.requestTitle = document.getElementById('requestTitle');
        DOM.titleCount = document.getElementById('titleCount');
        DOM.titleCounter = document.getElementById('titleCounter');
        DOM.moreDetails = document.getElementById('moreDetails');
        DOM.detailsCount = document.getElementById('detailsCount');
        DOM.detailsCounter = document.getElementById('detailsCounter');
        DOM.password = document.getElementById('password');
        DOM.strengthBar = document.getElementById('strengthBar');
        DOM.strengthLabel = document.getElementById('strengthLabel');
        
        if (!DOM.steps || DOM.steps.length === 0) {
            console.error('❌ [DOM] Form steps not found!');
            return false;
        }
        
        console.log('✅ [DOM] Found', DOM.steps.length, 'steps');
        return true;
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🔤 COMPTEURS DE CARACTÈRES
    // ═══════════════════════════════════════════════════════════
    function setupCharacterCounters() {
        if (DOM.requestTitle && DOM.titleCount) {
            const updateTitleCounter = debounce(function() {
                const length = this.value.length;
                DOM.titleCount.textContent = length + '/15';
                if (length >= 15) {
                    DOM.titleCounter.className = 'mt-3 text-sm text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                    DOM.titleCounter.innerHTML = '✅ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
                } else {
                    DOM.titleCounter.className = 'mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                    DOM.titleCounter.innerHTML = '⚠️ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
                }
                updateNextButton();
            }, CONFIG.DEBOUNCE_DELAY);
            DOM.requestTitle.addEventListener('input', updateTitleCounter);
        }
        
        if (DOM.moreDetails && DOM.detailsCount) {
            const updateDetailsCounter = debounce(function() {
                const length = this.value.length;
                DOM.detailsCount.textContent = length;
                if (length >= 50) {
                    DOM.detailsCounter.className = 'mt-3 text-sm flex justify-between text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                    DOM.detailsCounter.innerHTML = '<span>✅ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
                } else {
                    DOM.detailsCounter.className = 'mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                    DOM.detailsCounter.innerHTML = '<span>⚠️ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
                }
                updateNextButton();
            }, CONFIG.DEBOUNCE_DELAY);
            DOM.moreDetails.addEventListener('input', updateDetailsCounter);
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🔐 MOT DE PASSE
    // ═══════════════════════════════════════════════════════════
    function setupPasswordStrength() {
        if (!DOM.password || !DOM.strengthBar) return;
        const updatePasswordStrength = debounce(function() {
            if (isPasswordVerificationMode) { updateNextButton(); return; }
            const length = this.value.length;
            let strength = 0, text = 'Too short', color = 'bg-gray-300';
            if (length < 6) { strength = 0; text = 'Too short'; color = 'bg-gray-300'; }
            else if (length < 8) { strength = 33; text = 'Weak'; color = 'bg-red-500'; }
            else if (length < 10) { strength = 66; text = 'Medium'; color = 'bg-yellow-500'; }
            else { strength = 100; text = 'Strong'; color = 'bg-green-500'; }
            if (!prefersReducedMotion) DOM.strengthBar.style.transition = 'width 0.3s ease, background-color 0.3s ease';
            DOM.strengthBar.style.width = strength + '%';
            DOM.strengthBar.setAttribute('aria-valuenow', strength);
            DOM.strengthBar.className = 'h-full transition-all duration-300 ' + color;
            DOM.strengthLabel.textContent = text;
            updateNextButton();
        }, 100);
        DOM.password.addEventListener('input', updatePasswordStrength);
    }
    
    // ═══════════════════════════════════════════════════════════
    // ⏱️ BOUTONS DE DURÉE
    // ═══════════════════════════════════════════════════════════
    function setupDurationButtons() {
        const durationButtons = document.querySelectorAll('.option-btn');
        const durationInput = document.getElementById('durationHere');
        if (!durationInput) return;
        durationButtons.forEach(button => {
            button.addEventListener('click', function() {
                durationButtons.forEach(btn => {
                    btn.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                    btn.setAttribute('aria-pressed', 'false');
                    if (btn.classList.contains('sm:col-span-2')) btn.classList.add('sm:col-span-2');
                });
                this.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
                this.setAttribute('aria-pressed', 'true');
                if (this.classList.contains('sm:col-span-2')) this.classList.add('sm:col-span-2');
                const value = this.getAttribute('data-value');
                durationInput.value = sanitizeHTML(value);
                if (['1-2 years', '2-5 years', 'More than 5 years'].includes(value)) {
                    const popup = document.getElementById('expatPopup');
                    if (popup) {
                        popup.classList.remove('hidden');
                        popup.style.zIndex = '9999';
                        announce('You might be interested in becoming an expat helper', 'polite');
                        if (!prefersReducedMotion) setTimeout(() => popup.classList.add('hidden'), 5000);
                    }
                }
                updateNextButton();
            });
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📞 TYPE DE SUPPORT
    // ═══════════════════════════════════════════════════════════
    function setupSupportOptions() {
        const supportOptions = document.querySelectorAll('.support-option');
        supportOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            if (!radio) return;
            radio.addEventListener('change', function() {
                supportOptions.forEach(opt => {
                    opt.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100';
                });
                if (this.checked) {
                    option.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
                    const label = option.querySelector('span');
                    if (label) announce('Selected: ' + label.textContent, 'polite');
                }
                DOM.cachedSelectors.supportType = null;
                updateNextButton();
            });
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // ⚡ URGENCE
    // ═══════════════════════════════════════════════════════════
    function setupUrgencyOptions() {
        const urgencyOptions = document.querySelectorAll('.urgency-option');
        urgencyOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            if (!radio) return;
            radio.addEventListener('change', function() {
                urgencyOptions.forEach(opt => {
                    opt.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100';
                });
                if (this.checked) {
                    option.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
                    const label = option.querySelector('span');
                    if (label) announce('Selected: ' + label.textContent, 'polite');
                }
                DOM.cachedSelectors.urgency = null;
                updateNextButton();
            });
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🌍 LANGUES
    // ═══════════════════════════════════════════════════════════
    function setupLanguageOptions() {
        const langOptions = document.querySelectorAll('.lang-option');
        langOptions.forEach(option => {
            const checkbox = option.querySelector('.lang-checkbox');
            if (!checkbox) return;
            option.addEventListener('click', function(e) {
                e.preventDefault();
                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
                } else {
                    this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95';
                }
                DOM.cachedSelectors.languages = null;
                updateNextButton();
            });
            checkbox.addEventListener('click', function(e) { e.stopPropagation(); });
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📅 DURÉE DU SERVICE
    // ═══════════════════════════════════════════════════════════
    function setupServiceDurationButtons() {
        const serviceDurationBtns = document.querySelectorAll('.duration-btn');
        const serviceDurationInput = document.getElementById('serviceDuration');
        if (!serviceDurationInput) return;
        serviceDurationBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                serviceDurationBtns.forEach(b => {
                    b.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                    b.setAttribute('aria-pressed', 'false');
                });
                this.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
                this.setAttribute('aria-pressed', 'true');
                const duration = this.getAttribute('data-duration');
                serviceDurationInput.value = sanitizeHTML(duration);
                announce('Selected: ' + duration, 'polite');
                updateNextButton();
            });
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // ✅ CONDITIONS GÉNÉRALES
    // ═══════════════════════════════════════════════════════════
    function setupTermsCheckbox() {
        const termsCheckbox = document.getElementById('termsCheckbox');
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', function() {
                if (this.checked) announce('Terms and conditions accepted', 'polite');
                updateNextButton();
            });
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📧 VÉRIFICATION EMAIL
    // ═══════════════════════════════════════════════════════════
    function checkEmailExists(email) {
        if (!checkEmailUrl) {
            console.error('❌ checkEmailUrl not configured');
            return Promise.resolve({ exists: false, has_valid_cookie: false });
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('❌ CSRF token not found');
            return Promise.resolve({ exists: false, has_valid_cookie: false });
        }
        return fetch(checkEmailUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ email: sanitizeHTML(email) })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error: ' + response.status);
            return response.json();
        })
        .then(data => { console.log('📧 Email check result:', data); return data; })
        .catch(err => { console.error('❌ Error checking email:', err); return { exists: false, has_valid_cookie: false }; });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🔑 VÉRIFICATION MOT DE PASSE
    // ═══════════════════════════════════════════════════════════
    function verifyPassword(email, password) {
        if (!verifyPasswordUrl) {
            console.error('❌ verifyPasswordUrl not configured');
            return Promise.resolve({ success: false, message: 'Configuration error' });
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('❌ CSRF token not found');
            return Promise.resolve({ success: false, message: 'Security error' });
        }
        return fetch(verifyPasswordUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ email: sanitizeHTML(email), password: password })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error: ' + response.status);
            return response.json();
        })
        .then(data => { console.log('🔐 Password verification result:', data); return data; })
        .catch(err => { console.error('❌ Error verifying password:', err); return { success: false, message: 'Verification failed. Please try again.' }; });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 👋 MESSAGES DE BIENVENUE
    // ═══════════════════════════════════════════════════════════
    function showWelcomeMessage(scenario, firstName) {
        const welcomeMsg = document.getElementById('welcomeMessage');
        const welcomeTitle = document.getElementById('welcomeTitle');
        const welcomeText = document.getElementById('welcomeText');
        if (!welcomeMsg || !welcomeTitle || !welcomeText) return;
        const safeName = sanitizeHTML(firstName);
        switch (scenario) {
            case 'new':
                welcomeTitle.textContent = '👋 Welcome!';
                welcomeText.textContent = "Let's create your account 🎉";
                announce('Welcome! Creating your account', 'polite');
                break;
            case 'returning-with-cookie':
            case 'returning-without-cookie':
                welcomeTitle.textContent = `Hey ${safeName}! 👋`;
                welcomeText.textContent = 'Happy to see you back! ✨';
                announce(`Welcome back ${safeName}!`, 'polite');
                break;
        }
        welcomeMsg.classList.remove('hidden');
        if (!prefersReducedMotion) welcomeMsg.style.animation = 'slideInDown 0.5s ease-out';
    }
    
    function setupPasswordLoginMode(firstName) {
        isPasswordVerificationMode = true;
        const passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
        const passwordWelcomeTitle = document.getElementById('passwordWelcomeTitle');
        const passwordWelcomeText = document.getElementById('passwordWelcomeText');
        const passwordLabel = document.getElementById('passwordLabel');
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordInfoText = document.getElementById('passwordInfoText');
        const safeName = sanitizeHTML(firstName);
        if (passwordWelcomeMsg && passwordWelcomeTitle && passwordWelcomeText) {
            passwordWelcomeTitle.textContent = `Hey ${safeName}! 👋`;
            passwordWelcomeText.textContent = 'Happy to see you back!';
            passwordWelcomeMsg.classList.remove('hidden');
        }
        if (passwordInput) { passwordInput.placeholder = 'Enter your password'; passwordInput.value = ''; }
        if (passwordLabel) passwordLabel.textContent = 'Password';
        if (passwordStrength) passwordStrength.style.display = 'none';
        if (passwordInfoText) passwordInfoText.innerHTML = '🔐 For security, please enter your <strong>password</strong>';
        announce('Please enter your password to continue', 'polite');
    }
    
    function setupPasswordCreationMode() {
        isPasswordVerificationMode = false;
        const passwordWelcomeMsg = document.getElementById('passwordWelcomeMessage');
        const passwordLabel = document.getElementById('passwordLabel');
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordInfoText = document.getElementById('passwordInfoText');
        if (passwordWelcomeMsg) passwordWelcomeMsg.classList.add('hidden');
        if (passwordInput) { passwordInput.placeholder = 'Choose a secure password (min 6 chars)'; passwordInput.value = ''; }
        if (passwordLabel) passwordLabel.textContent = 'Choose a password (minimum 6 characters)';
        if (passwordStrength) passwordStrength.style.display = 'block';
        if (passwordInfoText) passwordInfoText.innerHTML = '🔐 Use at least <strong>6 characters</strong> — 8+ recommended';
        announce('Create a secure password for your account', 'polite');
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📄 AFFICHAGE DES ÉTAPES (PARTIE 2 DANS LE PROCHAIN MESSAGE)
    // ═══════════════════════════════════════════════════════════
    // ═══════════════════════════════════════════════════════════
    // 📄 AFFICHAGE DES ÉTAPES
    // ═══════════════════════════════════════════════════════════
    function showStep(index) {
        if (index < 0 || index >= totalSteps) {
            console.error('❌ Invalid step index:', index);
            return;
        }
        
        if (isAuthenticated && index >= 9 && index <= 11) {
            currentStep = 12;
            index = 12;
        }
        
        DOM.steps.forEach((step, i) => {
            if (i === index) {
                step.classList.remove('hidden');
                step.setAttribute('aria-hidden', 'false');
            } else {
                step.classList.add('hidden');
                step.setAttribute('aria-hidden', 'true');
            }
        });
        
        if (index === 14) {
            setTimeout(() => {
                const adLink = document.getElementById('see-my-ad');
                const missionId = localStorage.getItem('current-mission-id');
                if (missionId && adLink) {
                    adLink.href = '/quote-offer?id=' + encodeURIComponent(missionId);
                    console.log('✅ Ad link updated:', adLink.href);
                }
            }, 100);
        }
        
        const progress = ((index + 1) / totalSteps) * 100;
        if (DOM.progressBar) {
            if (prefersReducedMotion) {
                DOM.progressBar.style.width = progress + '%';
            } else {
                const currentWidth = parseFloat(DOM.progressBar.style.width) || 0;
                const targetWidth = progress;
                let frame = 0;
                const totalFrames = 20;
                function animateProgress() {
                    frame++;
                    const easeProgress = frame / totalFrames;
                    const easeWidth = currentWidth + (targetWidth - currentWidth) * easeProgress;
                    DOM.progressBar.style.width = easeWidth + '%';
                    DOM.progressBar.setAttribute('aria-valuenow', Math.round(easeWidth));
                    if (frame < totalFrames) requestAnimationFrame(animateProgress);
                }
                requestAnimationFrame(animateProgress);
            }
        }
        
        if (DOM.stepLabel && stepLabels[index]) {
            DOM.stepLabel.textContent = stepLabels[index];
        }
        
        if (DOM.stepCounter) {
            if (index < 12) {
                DOM.stepCounter.textContent = 'Step ' + (index + 1);
            } else if (index === 12) {
                DOM.stepCounter.textContent = 'Step 12';
            } else {
                DOM.stepCounter.textContent = '';
            }
        }
        
        if (DOM.funText && funTexts[index]) {
            DOM.funText.textContent = funTexts[index].text;
            if (!prefersReducedMotion) DOM.funText.style.transition = 'color 0.3s ease';
            DOM.funText.style.color = funTexts[index].color;
        }
        
        if (DOM.prevBtn) {
            DOM.prevBtn.style.visibility = (index === 0) ? 'hidden' : 'visible';
        }
        
        if (DOM.stickyNav) {
            if (index === 13 || index === 14) {
                DOM.stickyNav.classList.add('hidden');
            } else {
                DOM.stickyNav.classList.remove('hidden');
            }
        }
        
        if (index === 13) {
            const delay = prefersReducedMotion ? 0 : 2000;
            setTimeout(() => {
                currentStep++;
                showStep(currentStep);
            }, delay);
        }
        
        const currentStepEl = DOM.steps[index];
        if (currentStepEl && index !== 13 && index !== 14) {
            const firstFocusable = currentStepEl.querySelector(
                'input:not([type="hidden"]):not(.lang-checkbox):not([disabled]), select:not([disabled]), textarea:not([disabled]), button[type="button"]:not(.photo-menu-btn):not([disabled])'
            );
            if (firstFocusable) setTimeout(() => { firstFocusable.focus(); }, 100);
        }
        
        if (stepLabels[index]) {
            const stepNumber = index < 12 ? `Step ${index + 1} of ${totalSteps}` : 'Final step';
            announce(`${stepNumber}: ${stepLabels[index]}`, 'polite');
        }
        
        updateNextButton();
    }
    
    // ═══════════════════════════════════════════════════════════
    // ✅ VALIDATION DES ÉTAPES
    // ═══════════════════════════════════════════════════════════
    function validateStep(stepIndex) {
        if ([13, 14].includes(stepIndex)) return true;
        
        let valid = true;
        let message = '';
        
        switch(stepIndex) {
            case 0: {
                const countryNeed = document.getElementById('countryNeed');
                if (!countryNeed || !countryNeed.value) {
                    message = 'Please select a country';
                    valid = false;
                    if (countryNeed) countryNeed.focus();
                }
                break;
            }
            case 1: {
                const originCountry = document.getElementById('originCountry');
                if (!originCountry || !originCountry.value) {
                    message = 'Please select your country of origin';
                    valid = false;
                    if (originCountry) originCountry.focus();
                }
                break;
            }
            case 2: {
                valid = true;
                break;
            }
            case 3: {
                const durationHere = document.getElementById('durationHere');
                if (!durationHere || !durationHere.value) {
                    message = 'Please select how long you have been here';
                    valid = false;
                }
                break;
            }
            case 4: {
                const title = document.getElementById('requestTitle');
                const details = document.getElementById('moreDetails');
                if (!title || !title.value || title.value.trim().length < 15) {
                    message = 'Title must be at least 15 characters';
                    valid = false;
                    if (title) title.focus();
                } else if (!details || !details.value || details.value.trim().length < 50) {
                    message = 'Details must be at least 50 characters';
                    valid = false;
                    if (details) details.focus();
                }
                break;
            }
            case 5: {
                valid = true;
                break;
            }
            case 6: {
                const supportType = getCachedSelector('supportType', 'input[name="supportType"]:checked');
                if (!supportType) {
                    message = 'Please select a support type';
                    valid = false;
                }
                break;
            }
            case 7: {
                const urgency = getCachedSelector('urgency', 'input[name="urgency"]:checked');
                if (!urgency) {
                    message = 'Please select urgency level';
                    valid = false;
                }
                break;
            }
            case 8: {
                const languages = document.querySelectorAll('input[name="languages[]"]:checked');
                if (languages.length === 0) {
                    message = 'Please select at least one language';
                    valid = false;
                }
                break;
            }
            case 9: {
                const firstName = document.getElementById('firstName');
                if (!firstName || !firstName.value.trim()) {
                    message = 'Please enter your first name';
                    valid = false;
                    if (firstName) firstName.focus();
                }
                break;
            }
            case 10: {
                const emailInput = document.getElementById('email');
                const email = emailInput ? emailInput.value.trim() : '';
                if (!email || !isValidEmail(email)) {
                    message = 'Please enter a valid email address';
                    valid = false;
                    if (emailInput) emailInput.focus();
                    showValidationError(message);
                    return false;
                }
                if (DOM.nextBtn) {
                    DOM.nextBtn.disabled = true;
                    DOM.nextBtn.textContent = 'Checking...';
                }
                checkEmailExists(email).then(data => {
                    if (data.exists && data.has_valid_cookie) {
                        userScenario = 'returning-with-cookie';
                        userFirstName = data.first_name || 'there';
                        showWelcomeMessage('returning-with-cookie', userFirstName);
                        setTimeout(() => {
                            currentStep = 11;
                            storeStepData(10);
                            currentStep++;
                            showStep(currentStep);
                        }, 1500);
                    } else if (data.exists && !data.has_valid_cookie) {
                        userScenario = 'returning-without-cookie';
                        userFirstName = data.first_name || 'there';
                        showWelcomeMessage('returning-without-cookie', userFirstName);
                        setTimeout(() => {
                            storeStepData(10);
                            currentStep++;
                            setupPasswordLoginMode(userFirstName);
                            showStep(currentStep);
                        }, 1500);
                    } else {
                        userScenario = 'new';
                        showWelcomeMessage('new', '');
                        setTimeout(() => {
                            storeStepData(10);
                            currentStep++;
                            setupPasswordCreationMode();
                            showStep(currentStep);
                        }, 1000);
                    }
                    if (DOM.nextBtn) {
                        DOM.nextBtn.disabled = false;
                        DOM.nextBtn.textContent = 'Next →';
                    }
                }).catch(err => {
                    console.error('Email check error:', err);
                    if (DOM.nextBtn) {
                        DOM.nextBtn.disabled = false;
                        DOM.nextBtn.textContent = 'Next →';
                    }
                });
                return false;
            }
            case 11: {
                const pwd = document.getElementById('password');
                if (!pwd || !pwd.value || pwd.value.length < 6) {
                    message = 'Password must be at least 6 characters';
                    valid = false;
                    if (pwd) pwd.focus();
                    showValidationError(message);
                    return false;
                }
                if (isPasswordVerificationMode) {
                    const emailForVerif = document.getElementById('email');
                    if (!emailForVerif) return false;
                    if (DOM.nextBtn) {
                        DOM.nextBtn.disabled = true;
                        DOM.nextBtn.textContent = 'Verifying...';
                    }
                    verifyPassword(emailForVerif.value, pwd.value).then(data => {
                        if (data.success) {
                            console.log('✅ Password correct');
                            storeStepData(11);
                            currentStep++;
                            showStep(currentStep);
                        } else {
                            showValidationError(data.message || 'Wrong password, please try again');
                            pwd.value = '';
                            pwd.focus();
                        }
                        if (DOM.nextBtn) {
                            DOM.nextBtn.disabled = false;
                            DOM.nextBtn.textContent = 'Next →';
                        }
                    }).catch(err => {
                        console.error('Password verification error:', err);
                        if (DOM.nextBtn) {
                            DOM.nextBtn.disabled = false;
                            DOM.nextBtn.textContent = 'Next →';
                        }
                    });
                    return false;
                }
                break;
            }
            case 12: {
                const duration = document.getElementById('serviceDuration');
                const terms = document.getElementById('termsCheckbox');
                if (!duration || !duration.value) {
                    message = 'Please select service duration';
                    valid = false;
                } else if (!terms || !terms.checked) {
                    showCGVWarning();
                    valid = false;
                    if (terms) terms.focus();
                }
                break;
            }
        }
        
        if (!valid && message) showValidationError(message);
        return valid;
    }
    
    // ═══════════════════════════════════════════════════════════
    // ⚠️ AFFICHAGE DES ERREURS
    // ═══════════════════════════════════════════════════════════
    function showValidationError(message) {
        const errorDiv = document.getElementById('validationError');
        const messageEl = document.getElementById('validationMessage');
        if (errorDiv && messageEl) {
            messageEl.textContent = sanitizeHTML(message);
            errorDiv.classList.remove('hidden');
            errorDiv.style.zIndex = '10000';
            announce('Error: ' + message, 'assertive');
            const hideDelay = prefersReducedMotion ? 2000 : 3000;
            setTimeout(() => { errorDiv.classList.add('hidden'); }, hideDelay);
        }
    }
    
    function showCGVWarning() {
        const warningDiv = document.getElementById('cgvWarning');
        if (warningDiv) {
            warningDiv.classList.remove('hidden');
            warningDiv.style.zIndex = '10000';
            announce("Don't forget to accept the terms and conditions", 'assertive');
            const hideDelay = prefersReducedMotion ? 2000 : 3000;
            setTimeout(() => { warningDiv.classList.add('hidden'); }, hideDelay);
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🔘 MISE À JOUR DU BOUTON NEXT
    // ═══════════════════════════════════════════════════════════
    const updateNextButton = throttle(function() {
        if (!DOM.nextBtn) return;
        let canProceed = false;
        switch(currentStep) {
            case 0: { const c0 = document.getElementById('countryNeed'); canProceed = !!(c0 && c0.value); break; }
            case 1: { const c1 = document.getElementById('originCountry'); canProceed = !!(c1 && c1.value); break; }
            case 2: { canProceed = true; break; }
            case 3: { const c3 = document.getElementById('durationHere'); canProceed = !!(c3 && c3.value); break; }
            case 4: {
                const title = document.getElementById('requestTitle');
                const details = document.getElementById('moreDetails');
                canProceed = !!(title && details && title.value.trim().length >= 15 && details.value.trim().length >= 50);
                break;
            }
            case 5: { canProceed = true; break; }
            case 6: { const supportType = getCachedSelector('supportType', 'input[name="supportType"]:checked', 500); canProceed = !!supportType; break; }
            case 7: { const urgency = getCachedSelector('urgency', 'input[name="urgency"]:checked', 500); canProceed = !!urgency; break; }
            case 8: { const languages = document.querySelectorAll('input[name="languages[]"]:checked'); canProceed = languages.length > 0; break; }
            case 9: { const c9 = document.getElementById('firstName'); canProceed = !!(c9 && c9.value.trim()); break; }
            case 10: { const emailEl = document.getElementById('email'); const email = emailEl ? emailEl.value.trim() : ''; canProceed = isValidEmail(email); break; }
            case 11: { const pwdEl = document.getElementById('password'); canProceed = !!(pwdEl && pwdEl.value.length >= 6); break; }
            case 12: { const durEl = document.getElementById('serviceDuration'); const termEl = document.getElementById('termsCheckbox'); canProceed = !!(durEl && durEl.value && termEl && termEl.checked); break; }
            default: { canProceed = true; }
        }
        DOM.nextBtn.disabled = !canProceed;
        DOM.nextBtn.setAttribute('aria-disabled', !canProceed);
    }, 100);
    
    // ═══════════════════════════════════════════════════════════
    // 💾 STOCKAGE DES DONNÉES
    // ═══════════════════════════════════════════════════════════
    function getLocalStorageData() {
        const now = Date.now();
        if (localStorageCache && (now - cacheTimestamp) < CACHE_DURATION) {
            return { ...localStorageCache };
        }
        try {
            localStorageCache = JSON.parse(localStorage.getItem('help-request')) || {};
            cacheTimestamp = now;
            return { ...localStorageCache };
        } catch (e) {
            console.error('Error reading localStorage:', e);
            return {};
        }
    }
    
    function setLocalStorageData(data) {
        try {
            localStorage.setItem('help-request', JSON.stringify(data));
            localStorageCache = { ...data };
            cacheTimestamp = Date.now();
        } catch (e) {
            console.error('Error writing localStorage:', e);
            if (e.name === 'QuotaExceededError') {
                showValidationError('Storage quota exceeded. Please clear some data.');
            }
        }
    }
    
    function storeStepData(stepIndex) {
        const expats = getLocalStorageData();
        switch (stepIndex) {
            case 0: { const c0 = document.getElementById('countryNeed'); expats.countryNeed = c0 ? sanitizeHTML(c0.value) : ''; break; }
            case 1: { const c1 = document.getElementById('originCountry'); expats.originCountry = c1 ? sanitizeHTML(c1.value) : ''; break; }
            case 2: { const c2 = document.getElementById('currentCity'); expats.currentCity = c2 ? sanitizeHTML(c2.value) : ''; break; }
            case 3: { const c3 = document.getElementById('durationHere'); expats.durationHere = c3 ? sanitizeHTML(c3.value) : ''; break; }
            case 4: {
                const title = document.getElementById('requestTitle');
                const details = document.getElementById('moreDetails');
                expats.requestTitle = title ? sanitizeHTML(title.value) : '';
                expats.moreDetails = details ? sanitizeHTML(details.value) : '';
                break;
            }
            case 6: { const supportType = document.querySelector('input[name="supportType"]:checked'); expats.supportType = supportType ? supportType.value : null; break; }
            case 7: { const urgency = document.querySelector('input[name="urgency"]:checked'); expats.urgency = urgency ? urgency.value : null; break; }
            case 8: {
                const languages = Array.from(document.querySelectorAll('input[name="languages[]"]:checked')).map(cb => sanitizeHTML(cb.value));
                expats.languages = languages;
                break;
            }
            case 9: { const fname = document.getElementById('firstName'); expats.firstName = fname ? sanitizeHTML(fname.value) : ''; break; }
            case 10: { const email = document.getElementById('email'); expats.email = email ? sanitizeHTML(email.value) : ''; break; }
            case 11: { break; }
           case 12: { 
                const dur = document.getElementById('serviceDuration'); 
                expats.serviceDuration = dur ? sanitizeHTML(dur.value) : '';
                
                // ✅ GDPR: Sauvegarder le consentement CGV
                const terms = document.getElementById('termsCheckbox');
                if (terms) {
                    expats.termsAccepted = terms.checked;
                    if (terms.checked) {
                        expats.termsAcceptedAt = new Date().toISOString();
                        console.log('✅ [GDPR] Terms accepted at:', expats.termsAcceptedAt);
                    }
                }
                
                break; 
            }
        }
        setLocalStorageData(expats);
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🔄 RESTAURATION DES DONNÉES
    // ═══════════════════════════════════════════════════════════
    function restoreStepData() {
        const expats = getLocalStorageData();
        const fields = {
            'countryNeed': expats.countryNeed,
            'originCountry': expats.originCountry,
            'currentCity': expats.currentCity,
            'durationHere': expats.durationHere,
            'requestTitle': expats.requestTitle,
            'moreDetails': expats.moreDetails,
            'firstName': expats.firstName,
            'email': expats.email,
            'serviceDuration': expats.serviceDuration
        };
        
        for (let [id, value] of Object.entries(fields)) {
            if (value) {
                const el = document.getElementById(id);
                if (el) {
                    el.value = value;
                    if (['requestTitle', 'moreDetails'].includes(id)) {
                        el.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                }
            }
        }

        // ✅ GDPR: Restaurer la checkbox CGV
        if (expats.termsAccepted !== undefined) {
            const terms = document.getElementById('termsCheckbox');
            if (terms) {
                terms.checked = expats.termsAccepted;
                console.log('🔄 [GDPR] Terms checkbox restored:', expats.termsAccepted);
                if (expats.termsAcceptedAt) {
                    console.log('📅 [GDPR] Originally accepted at:', expats.termsAcceptedAt);
                }
            }
        }
        
        if (expats.languages && Array.isArray(expats.languages)) {
            expats.languages.forEach(lang => {
                try {
                    const checkbox = document.querySelector(`input[name="languages[]"][value="${CSS.escape(lang)}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                        const option = checkbox.closest('.lang-option');
                        if (option) {
                            option.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
                        }
                    }
                } catch (e) {
                    console.error('Error restoring language:', lang, e);
                }
            });
        }
        
        try {
            const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
            for (let photoName in photoData) {
                const input = document.querySelector(`input[name="${CSS.escape(photoName)}"]`);
                const preview = input?.closest('.photo-upload-box')?.querySelector('.photo-preview');
                if (preview && photoData[photoName].base64) {
                    preview.src = photoData[photoName].base64;
                    const photoBox = input.closest('.photo-upload-box');
                    if (photoBox) {
                        photoBox.classList.add('has-photo');
                        const label = photoBox.querySelector('.photo-label');
                        if (label) label.classList.add('hidden');
                    }
                }
            }
        } catch (e) {
            console.error('Error restoring photos:', e);
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🎧 ÉCOUTE GLOBALE DES ÉVÉNEMENTS
    // ═══════════════════════════════════════════════════════════
    function setupGlobalListeners() {
        const debouncedStoreAndUpdate = debounce(function(e) {
            storeStepData(currentStep);
            updateNextButton();
        }, CONFIG.DEBOUNCE_DELAY);
        
        document.querySelectorAll('input:not([type="hidden"]):not(.lang-checkbox):not([type="radio"]):not([type="checkbox"]), select, textarea').forEach(el => {
            el.addEventListener('input', debouncedStoreAndUpdate);
        });
        
        document.querySelectorAll('input[type="radio"], input[type="checkbox"]:not(.lang-checkbox)').forEach(el => {
            el.addEventListener('change', function() {
                storeStepData(currentStep);
                updateNextButton();
            });
        });
        
// ✅ GDPR: Listener spécifique pour la checkbox CGV
        const termsCheckbox = document.getElementById('termsCheckbox');
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                console.log('✅ [GDPR] Terms checkbox changed:', isChecked);
                
                if (isChecked) {
                    console.log('📅 [GDPR] User accepted terms at:', new Date().toISOString());
                }
                
                storeStepData(currentStep);
                updateNextButton();
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey && DOM.nextBtn && !DOM.nextBtn.disabled) {
                const activeEl = document.activeElement;
                if (activeEl && activeEl.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    DOM.nextBtn.click();
                }
            }
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // ⬅️➡️ NAVIGATION
    // ═══════════════════════════════════════════════════════════
    function setupNavigation() {
        if (!DOM.nextBtn || !DOM.prevBtn) {
            console.error('❌ Navigation buttons not found');
            return;
        }
        
        DOM.nextBtn.addEventListener('click', function() {
            if (this.disabled || formSubmitting) return;
            if (currentStep < totalSteps - 1) {
                if (currentStep === 10 || (currentStep === 11 && isPasswordVerificationMode)) {
                    validateStep(currentStep);
                    return;
                }
                if (!validateStep(currentStep)) return;
                storeStepData(currentStep);
                if (isAuthenticated && currentStep === 8) currentStep = 11;
                if (currentStep === 12) {
                    handleFormSubmission();
                    return;
                }
                currentStep++;
                showStep(currentStep);
            }
        });
        
        DOM.prevBtn.addEventListener('click', function() {
            if (currentStep > 0) {
                storeStepData(currentStep);
                if (isAuthenticated && currentStep === 12) {
                    currentStep = 8;
                } else {
                    currentStep--;
                }
                showStep(currentStep);
            }
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📤 SOUMISSION DU FORMULAIRE
    // ═══════════════════════════════════════════════════════════
    function handleFormSubmission() {
        const now = Date.now();
        if (now - lastSubmitTime < CONFIG.SUBMIT_COOLDOWN) {
            showValidationError('Please wait a few seconds before submitting again');
            return;
        }
        
        const honeypot = document.getElementById('website');
        if (honeypot && honeypot.value !== '') {
            console.warn('🍯 Honeypot triggered - possible bot');
            currentStep++;
            showStep(currentStep);
            return;
        }
        
        const timestampField = document.getElementById('timestamp');
        if (timestampField) {
            const timestamp = parseInt(timestampField.value);
            const elapsed = Math.floor(Date.now() / 1000) - timestamp;
            if (elapsed < CONFIG.MIN_FORM_TIME) {
                showValidationError('Please take your time to fill the form properly');
                return;
            }
        }
        
        formSubmitting = true;
        lastSubmitTime = now;
        
        const form = document.getElementById('helpRequestForm');
        if (!form) {
            console.error('❌ Form not found');
            formSubmitting = false;
            return;
        }
        
        const formData = new FormData(form);
        const expats = getLocalStorageData();
        
        Object.entries(expats).forEach(([key, val]) => {
            if (!formData.has(key) && key !== 'password') {
                if (Array.isArray(val)) {
                    val.forEach(v => formData.append(key + '[]', v));
                } else if (val) {
                    formData.append(key, val);
                }
            }
        });
        
        try {
            const categories = JSON.parse(localStorage.getItem('create-request')) || {};
            if (categories) {
                formData.append('category', categories.category || '');
                formData.append('subcategory', categories.sub_category || '');
                formData.append('subcategory2', categories.child_category || '');
            }
        } catch (e) {
            console.error('Error adding categories:', e);
        }
        
        // ✅ GDPR: Ajouter la version des CGV et timestamp
        formData.append('terms_version', '1.0'); // À incrémenter si tu changes tes CGV
        formData.append('terms_accepted_at', expats.termsAcceptedAt || new Date().toISOString());
        
        console.log('📋 [GDPR] Submitting with terms version 1.0');

        if (DOM.nextBtn) {
            DOM.nextBtn.disabled = true;
            DOM.nextBtn.setAttribute('aria-busy', 'true');
            DOM.nextBtn.textContent = 'Submitting...';
        }
        
        announce('Submitting your request, please wait', 'polite');
        console.log('📤 Submitting form...');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('❌ CSRF token not found');
            showValidationError('Security error. Please refresh the page.');
            formSubmitting = false;
            if (DOM.nextBtn) {
                DOM.nextBtn.disabled = false;
                DOM.nextBtn.setAttribute('aria-busy', 'false');
                DOM.nextBtn.textContent = 'Next →';
            }
            return;
        }
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            },
            body: formData
        })
        .then(res => {
            console.log('📡 Response status:', res.status);
            if (!res.ok) throw new Error('Server error: ' + res.status);
            return res.json();
        })
        .then(data => {
            console.log('✅ Server response:', data);
            localStorage.removeItem('help-request');
            localStorage.removeItem('create-request');
            localStorage.removeItem('photo-previews');
            if (data.mission_id) {
                localStorage.setItem('current-mission-id', data.mission_id);
                console.log('💾 Mission ID saved:', data.mission_id);
            }
            announce('Your request has been submitted successfully!', 'polite');
            formSubmitting = false;
            currentStep++;
            showStep(currentStep);
        })
        .catch(error => {
            console.error('❌ Submission error:', error);
            showValidationError('Submission failed. Please check your connection and try again.');
            announce('Submission failed. Please try again.', 'assertive');
            formSubmitting = false;
        })
        .finally(() => {
            if (DOM.nextBtn) {
                DOM.nextBtn.disabled = false;
                DOM.nextBtn.setAttribute('aria-busy', 'false');
                DOM.nextBtn.textContent = 'Next →';
            }
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // 📸 GESTION DES PHOTOS
    // ═══════════════════════════════════════════════════════════
    function setupPhotoHandling() {
        const photoBoxes = document.querySelectorAll('.photo-upload-box');
        const photoMenuModal = document.getElementById('photoMenuModal');
        const photoMenuOptions = document.querySelectorAll('.photo-menu-option');
        const closePhotoMenuModal = document.getElementById('closePhotoMenuModal');
        let activePhotoInput = null;
        let activePhotoPreview = null;
        
        const cameraModal = document.getElementById('cameraModal');
        const cameraVideo = document.getElementById('cameraVideo');
        const capturePhotoBtn = document.getElementById('capturePhotoBtn');
        const closeCameraModal = document.getElementById('closeCameraModal');
        let cameraStream = null;
        
        let currentZoomLevel = 1;
        let currentPhotoBox = null;
        const photoZoomModal = document.getElementById('photoZoomModal');
        const zoomedImage = document.getElementById('zoomedImage');
        const closeZoomModal = document.getElementById('closeZoomModal');
        const zoomInBtn = document.getElementById('zoomIn');
        const zoomOutBtn = document.getElementById('zoomOut');
        const resetZoomBtn = document.getElementById('resetZoom');
        const deletePhotoBtn = document.getElementById('deletePhoto');
        
        photoBoxes.forEach(box => {
            const menuBtn = box.querySelector('.photo-menu-btn');
            const input = box.querySelector('.photo-input');
            const preview = box.querySelector('.photo-preview');
            
            if (menuBtn && input && preview) {
                menuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (box.classList.contains('has-photo')) {
                        openPhotoZoom(preview.src, box);
                        return;
                    }
                    activePhotoInput = input;
                    activePhotoPreview = preview;
                    if (photoMenuModal) {
                        photoMenuModal.classList.remove('hidden');
                        photoMenuModal.style.zIndex = '9999';
                    }
                });
                
                input.addEventListener('change', async function(e) {
                    const file = e.target.files[0];
                    if (!file) return;
                    try {
                        validateImageFile(file);
                        const compressedFile = await compressImage(file, 1200, 0.8);
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(compressedFile);
                        input.files = dataTransfer.files;
                        const photoUrl = URL.createObjectURL(compressedFile);
                        preview.src = photoUrl;
                        box.classList.add('has-photo');
                        const label = box.querySelector('.photo-label');
                        if (label) label.classList.add('hidden');
                        const reader = new FileReader();
                        reader.onload = function(readerEvent) {
                            try {
                                const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                                photoData[input.name] = { base64: readerEvent.target.result, timestamp: Date.now() };
                                localStorage.setItem('photo-previews', JSON.stringify(photoData));
                                console.log('💾 Photo saved:', input.name);
                            } catch (err) {
                                console.error('Error saving photo:', err);
                            }
                        };
                        reader.readAsDataURL(compressedFile);
                    } catch (error) {
                        showValidationError(error.message);
                        input.value = '';
                    }
                });
            }
        });
        
        photoMenuOptions.forEach(option => {
            option.addEventListener('click', function() {
                const action = option.getAttribute('data-action');
                if (photoMenuModal) photoMenuModal.classList.add('hidden');
                if (!activePhotoInput) return;
                if (action === 'library' || action === 'file') {
                    activePhotoInput.click();
                } else if (action === 'camera') {
                    if (cameraModal) {
                        cameraModal.classList.remove('hidden');
                        cameraModal.style.zIndex = '9999';
                    }
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } } })
                        .then(function(stream) {
                            cameraStream = stream;
                            if (cameraVideo) {
                                cameraVideo.srcObject = stream;
                                cameraVideo.play();
                            }
                        })
                        .catch(function(err) {
                            console.error('Camera access denied:', err);
                            showValidationError('Camera access denied');
                            if (cameraModal) cameraModal.classList.add('hidden');
                        });
                    }
                }
            });
        });
        
        if (closePhotoMenuModal) {
            closePhotoMenuModal.onclick = function() {
                if (photoMenuModal) photoMenuModal.classList.add('hidden');
            };
        }
        
        if (photoMenuModal) {
            photoMenuModal.addEventListener('click', function(e) {
                if (e.target === this) this.classList.add('hidden');
            });
        }
        
        function closeCameraAndStream() {
            if (cameraModal) cameraModal.classList.add('hidden');
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
            if (cameraVideo && cameraVideo.srcObject) {
                cameraVideo.srcObject.getTracks().forEach(track => track.stop());
                cameraVideo.srcObject = null;
            }
        }
        
        if (closeCameraModal) closeCameraModal.onclick = closeCameraAndStream;
        if (cameraModal) {
            cameraModal.addEventListener('click', function(e) {
                if (e.target === this) closeCameraAndStream();
            });
        }
        
        if (capturePhotoBtn && cameraVideo) {
            capturePhotoBtn.onclick = async function() {
                if (!cameraVideo.srcObject) return;
                const canvas = document.createElement('canvas');
                canvas.width = cameraVideo.videoWidth;
                canvas.height = cameraVideo.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(cameraVideo, 0, 0, canvas.width, canvas.height);
                canvas.toBlob(async function(blob) {
                    try {
                        let file = new File([blob], 'camera-photo-' + Date.now() + '.png', { type: 'image/png', lastModified: Date.now() });
                        file = await compressImage(file, 1200, 0.8);
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        if (activePhotoInput) {
                            activePhotoInput.files = dataTransfer.files;
                            console.log('📸 Photo captured:', file.size, 'bytes');
                            const photoUrl = URL.createObjectURL(file);
                            if (activePhotoPreview) {
                                activePhotoPreview.src = photoUrl;
                                const photoBox = activePhotoInput.closest('.photo-upload-box');
                                if (photoBox) {
                                    photoBox.classList.add('has-photo');
                                    const label = photoBox.querySelector('.photo-label');
                                    if (label) label.classList.add('hidden');
                                }
                            }
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                try {
                                    const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                                    photoData[activePhotoInput.name] = { base64: e.target.result, timestamp: Date.now() };
                                    localStorage.setItem('photo-previews', JSON.stringify(photoData));
                                    console.log('💾 Camera photo saved');
                                } catch (err) {
                                    console.error('Error saving camera photo:', err);
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                        closeCameraAndStream();
                    } catch (error) {
                        console.error('Error processing camera photo:', error);
                        showValidationError('Failed to process photo');
                    }
                }, 'image/png', 0.95);
            };
        }
        
        function openPhotoZoom(imageUrl, photoBox) {
            currentPhotoBox = photoBox;
            if (zoomedImage) zoomedImage.src = imageUrl;
            currentZoomLevel = 1;
            if (zoomedImage) zoomedImage.style.transform = 'scale(1)';
            if (photoZoomModal) {
                photoZoomModal.classList.remove('hidden');
                photoZoomModal.classList.add('flex');
            }
            document.body.style.overflow = 'hidden';
        }
        
        function closePhotoZoom() {
            if (photoZoomModal) {
                photoZoomModal.classList.add('hidden');
                photoZoomModal.classList.remove('flex');
            }
            currentPhotoBox = null;
            currentZoomLevel = 1;
            document.body.style.overflow = '';
        }
        
        if (closeZoomModal) closeZoomModal.addEventListener('click', closePhotoZoom);
        if (photoZoomModal) {
            photoZoomModal.addEventListener('click', function(e) {
                if (e.target === this) closePhotoZoom();
            });
        }
        
        if (zoomInBtn && zoomedImage) {
            zoomInBtn.addEventListener('click', function() {
                currentZoomLevel = Math.min(currentZoomLevel + 0.25, 3);
                zoomedImage.style.transform = `scale(${currentZoomLevel})`;
            });
        }
        
        if (zoomOutBtn && zoomedImage) {
            zoomOutBtn.addEventListener('click', function() {
                currentZoomLevel = Math.max(currentZoomLevel - 0.25, 0.5);
                zoomedImage.style.transform = `scale(${currentZoomLevel})`;
            });
        }
        
        if (resetZoomBtn && zoomedImage) {
            resetZoomBtn.addEventListener('click', function() {
                currentZoomLevel = 1;
                zoomedImage.style.transform = 'scale(1)';
            });
        }
        
        if (deletePhotoBtn) {
            deletePhotoBtn.addEventListener('click', function() {
                if (!currentPhotoBox) return;
                const input = currentPhotoBox.querySelector('.photo-input');
                const preview = currentPhotoBox.querySelector('.photo-preview');
                const label = currentPhotoBox.querySelector('.photo-label');
                if (input) input.value = '';
                if (preview) preview.src = preview.getAttribute('data-default-src') || '/images/uploadpng.png';
                currentPhotoBox.classList.remove('has-photo');
                if (label) label.classList.remove('hidden');
                if (input) {
                    try {
                        const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                        delete photoData[input.name];
                        localStorage.setItem('photo-previews', JSON.stringify(photoData));
                        console.log('🗑️ Photo deleted:', input.name);
                    } catch (e) {
                        console.error('Error deleting photo:', e);
                    }
                }
                closePhotoZoom();
            });
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🚀 INITIALISATION PRINCIPALE
    // ═══════════════════════════════════════════════════════════
    function initializeForm() {
        console.log('🚀 [RequestForm] Starting initialization...');
        
        if (!initDOMElements()) {
            console.error('❌ [RequestForm] Failed to initialize DOM elements');
            return;
        }
        
        restoreStepData();
        setupCharacterCounters();
        setupPasswordStrength();
        setupDurationButtons();
        setupSupportOptions();
        setupUrgencyOptions();
        setupLanguageOptions();
        setupServiceDurationButtons();
        setupTermsCheckbox();
        setupNavigation();
        setupGlobalListeners();
        setupPhotoHandling();
        showStep(0);
        
        console.log('✅ [RequestForm] Initialization complete');
    }
    
    // ═══════════════════════════════════════════════════════════
    // 🎬 DÉMARRAGE QUAND LE DOM EST PRÊT
    // ═══════════════════════════════════════════════════════════
    if (document.readyState === 'loading') {
        console.log('⏳ [RequestForm] DOM is loading, waiting for DOMContentLoaded...');
        document.addEventListener('DOMContentLoaded', initializeForm, { once: true });
    } else {
        console.log('✅ [RequestForm] DOM already loaded, initializing immediately');
        initializeForm();
    }
    
})();