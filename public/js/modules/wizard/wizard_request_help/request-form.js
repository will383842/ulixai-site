(function() {
    'use strict';
    
    // ✅ FONCTION DE COMPRESSION D'IMAGES
    function compressImage(file, maxWidth = 1200, quality = 0.8) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;
                    
                    if (width > maxWidth) {
                        height = (height * maxWidth) / width;
                        width = maxWidth;
                    }
                    
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    
                    canvas.toBlob((blob) => {
                        const compressedFile = new File(
                            [blob], 
                            file.name.replace(/\.\w+$/, '.jpg'),
                            { type: 'image/jpeg', lastModified: Date.now() }
                        );
                        console.log('📸 Compression:', file.size, '→', compressedFile.size, 'bytes');
                        resolve(compressedFile);
                    }, 'image/jpeg', quality);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }
    
    // Récupérer les variables globales
    const funTexts = window.formConfig.funTexts;
    const stepLabels = window.formConfig.stepLabels;
    const isAuthenticated = window.formConfig.isAuthenticated;
    
    const steps = document.querySelectorAll('.form-step');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const progressBar = document.getElementById('progressBar');
    const stepLabel = document.getElementById('formStepLabel');
    const stepCounter = document.getElementById('stepCounter');
    const funText = document.getElementById('funText');
    const stickyNav = document.getElementById('stickyNav');
    
    let currentStep = 0;
    const totalSteps = 15;
    
    const requestTitle = document.getElementById('requestTitle');
    const titleCount = document.getElementById('titleCount');
    const titleCounter = document.getElementById('titleCounter');
    const moreDetails = document.getElementById('moreDetails');
    const detailsCount = document.getElementById('detailsCount');
    const detailsCounter = document.getElementById('detailsCounter');
    
    if (requestTitle && titleCount) {
        requestTitle.addEventListener('input', function() {
            const length = this.value.length;
            titleCount.textContent = length + '/15';
            if (length >= 15) {
                titleCounter.className = 'mt-3 text-sm text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                titleCounter.innerHTML = '✅ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
            } else {
                titleCounter.className = 'mt-3 text-sm text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                titleCounter.innerHTML = '⚠️ Minimum 15 characters • <span id="titleCount">' + length + '/15</span>';
            }
            updateNextButton();
        });
    }
    
    if (moreDetails && detailsCount) {
        moreDetails.addEventListener('input', function() {
            const length = this.value.length;
            detailsCount.textContent = length;
            if (length >= 50) {
                detailsCounter.className = 'mt-3 text-sm flex justify-between text-green-700 bg-green-50 border-green-300 p-3 rounded-xl border-2 shadow-sm';
                detailsCounter.innerHTML = '<span>✅ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
            } else {
                detailsCounter.className = 'mt-3 text-sm flex justify-between text-orange-600 bg-orange-50 border-orange-300 p-3 rounded-xl border-2 shadow-sm';
                detailsCounter.innerHTML = '<span>⚠️ Min 50 chars</span><span class="text-gray-700"><span id="detailsCount">' + length + '</span>/50 (max 1500)</span>';
            }
            updateNextButton();
        });
    }
    
    const password = document.getElementById('password');
    const strengthBar = document.getElementById('strengthBar');
    const strengthLabel = document.getElementById('strengthLabel');
    
    if (password && strengthBar) {
        password.addEventListener('input', function() {
            const length = this.value.length;
            let strength = 0;
            let text = 'Too short';
            let color = 'bg-gray-300';
            
            if (length < 6) {
                strength = 0;
                text = 'Too short';
                color = 'bg-gray-300';
            } else if (length < 8) {
                strength = 33;
                text = 'Weak';
                color = 'bg-red-500';
            } else if (length < 10) {
                strength = 66;
                text = 'Medium';
                color = 'bg-yellow-500';
            } else {
                strength = 100;
                text = 'Strong';
                color = 'bg-green-500';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.setAttribute('aria-valuenow', strength);
            strengthBar.className = 'h-full transition-all duration-300 ' + color;
            strengthLabel.textContent = text;
            updateNextButton();
        });
    }
    
    const durationButtons = document.querySelectorAll('.option-btn');
    const durationInput = document.getElementById('durationHere');
    
    durationButtons.forEach(button => {
        button.addEventListener('click', function() {
            durationButtons.forEach(btn => {
                btn.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                btn.setAttribute('aria-pressed', 'false');
                if (btn.classList.contains('sm:col-span-2')) {
                    btn.classList.add('sm:col-span-2');
                }
            });
            this.className = 'option-btn border-2 rounded-2xl py-4 px-3 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
            this.setAttribute('aria-pressed', 'true');
            if (this.classList.contains('sm:col-span-2')) {
                this.classList.add('sm:col-span-2');
            }
            durationInput.value = this.getAttribute('data-value');
            
            const value = this.getAttribute('data-value');
            if (['1-2 years', '2-5 years', 'More than 5 years'].includes(value)) {
                const popup = document.getElementById('expatPopup');
                popup.classList.remove('hidden');
                popup.style.zIndex = '9999';
                setTimeout(() => popup.classList.add('hidden'), 5000);
            }
            updateNextButton();
        });
    });
    
    const supportOptions = document.querySelectorAll('.support-option');
    supportOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        radio.addEventListener('change', function() {
            supportOptions.forEach(opt => {
                opt.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 text-blue-900 hover:bg-blue-100';
            });
            if (this.checked) {
                option.className = 'support-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
            }
            updateNextButton();
        });
    });
    
    const urgencyOptions = document.querySelectorAll('.urgency-option');
    urgencyOptions.forEach(option => {
        const radio = option.querySelector('input[type="radio"]');
        radio.addEventListener('change', function() {
            urgencyOptions.forEach(opt => {
                opt.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md border-blue-500 bg-blue-50 hover:bg-blue-100';
            });
            if (this.checked) {
                option.className = 'urgency-option flex items-center justify-between gap-3 border-2 rounded-2xl px-4 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md bg-blue-600 text-white border-blue-700';
            }
            updateNextButton();
        });
    });
    
    const langOptions = document.querySelectorAll('.lang-option');
    langOptions.forEach(option => {
        const checkbox = option.querySelector('.lang-checkbox');
        
        option.addEventListener('click', function(e) {
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
            } else {
                this.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 border-blue-400 bg-blue-50 hover:bg-blue-100 active:scale-95';
            }
            
            updateNextButton();
        });
        
        checkbox.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
    
    const serviceDurationBtns = document.querySelectorAll('.duration-btn');
    const serviceDurationInput = document.getElementById('serviceDuration');
    
    serviceDurationBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            serviceDurationBtns.forEach(b => {
                b.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 border-blue-400 text-blue-700 bg-blue-50 hover:bg-blue-100';
                b.setAttribute('aria-pressed', 'false');
            });
            this.className = 'duration-btn border-2 rounded-2xl py-3 px-5 text-center font-semibold text-sm transition-all shadow-sm hover:shadow-md active:scale-95 bg-blue-600 text-white border-blue-700 shadow-lg';
            this.setAttribute('aria-pressed', 'true');
            serviceDurationInput.value = this.getAttribute('data-duration');
            updateNextButton();
        });
    });
    
    const termsCheckbox = document.getElementById('termsCheckbox');
    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', updateNextButton);
    }
    
    function showStep(index) {
        if (isAuthenticated && index >= 9 && index <= 11) {
            currentStep = 12;
            index = 12;
        }
        
        steps.forEach((step, i) => step.classList.toggle('hidden', i !== index));
        
        if (index === 14) {
            setTimeout(() => {
                const adLink = document.getElementById('see-my-ad');
                const missionId = localStorage.getItem('current-mission-id');
                if (missionId && adLink) {
                    adLink.href = '/quote-offer?id=' + missionId;
                    console.log('✅ Lien "See My Ad" mis à jour:', adLink.href);
                } else {
                    console.error('❌ Impossible de mettre à jour le lien:', {
                        missionId: missionId,
                        linkExists: !!adLink
                    });
                }
            }, 100);
        }
        
        const progress = ((index + 1) / totalSteps) * 100;
        progressBar.style.width = progress + '%';
        progressBar.setAttribute('aria-valuenow', Math.round(progress));
        
        if (stepLabel && stepLabels[index]) {
            stepLabel.textContent = stepLabels[index];
        }
        
        if (stepCounter) {
            if (index < 12) {
                stepCounter.textContent = 'Step ' + (index + 1);
            } else if (index === 12) {
                stepCounter.textContent = 'Step 12b';
            } else {
                stepCounter.textContent = '';
            }
        }
        
        if (funText && funTexts[index]) {
            funText.textContent = funTexts[index].text;
            funText.style.color = funTexts[index].color;
        }
        
        if (index === 0) {
            prevBtn.style.visibility = 'hidden';
        } else {
            prevBtn.style.visibility = 'visible';
        }
        
        if (index === 13 || index === 14) {
            stickyNav.classList.add('hidden');
        } else {
            stickyNav.classList.remove('hidden');
        }
        
        if (index === 13) {
            setTimeout(() => {
                currentStep++;
                showStep(currentStep);
            }, 2000);
        }
        
        const currentStepEl = steps[index];
        if (currentStepEl) {
            const firstInput = currentStepEl.querySelector('input:not([type="hidden"]):not(.lang-checkbox), select, textarea, button[type="button"]:not(.photo-menu-btn)');
            if (firstInput && index !== 13 && index !== 14) {
                setTimeout(() => firstInput.focus(), 100);
            }
        }
        
        updateNextButton();
    }
    
    function validateStep(stepIndex) {
        if ([13, 14].includes(stepIndex)) return true;
        
        const step = steps[stepIndex];
        let valid = true;
        let message = '';
        
        switch(stepIndex) {
            case 0:
                const countryNeed = document.getElementById('countryNeed');
                if (!countryNeed.value) {
                    message = 'Please select a country';
                    valid = false;
                    countryNeed.focus();
                }
                break;
                
            case 1:
                const originCountry = document.getElementById('originCountry');
                if (!originCountry.value) {
                    message = 'Please select your country of origin';
                    valid = false;
                    originCountry.focus();
                }
                break;
                
            case 2:
                valid = true;
                break;
                
            case 3:
                const durationHere = document.getElementById('durationHere');
                if (!durationHere.value) {
                    message = 'Please select how long you have been here';
                    valid = false;
                }
                break;
                
            case 4:
                const title = document.getElementById('requestTitle');
                const details = document.getElementById('moreDetails');
                if (!title.value || title.value.length < 15) {
                    message = 'Title must be at least 15 characters';
                    valid = false;
                    title.focus();
                } else if (!details.value || details.value.length < 50) {
                    message = 'Details must be at least 50 characters';
                    valid = false;
                    details.focus();
                }
                break;
                
            case 5:
                valid = true;
                break;
                
            case 6:
                const supportType = document.querySelector('input[name="supportType"]:checked');
                if (!supportType) {
                    message = 'Please select a support type';
                    valid = false;
                }
                break;
                
            case 7:
                const urgency = document.querySelector('input[name="urgency"]:checked');
                if (!urgency) {
                    message = 'Please select urgency level';
                    valid = false;
                }
                break;
                
            case 8:
                const languages = document.querySelectorAll('input[name="languages[]"]:checked');
                if (languages.length === 0) {
                    message = 'Please select at least one language';
                    valid = false;
                }
                break;
                
            case 9:
                const firstName = document.getElementById('firstName');
                if (!firstName.value) {
                    message = 'Please enter your first name';
                    valid = false;
                    firstName.focus();
                }
                break;
                
            case 10:
                const emailInput = document.getElementById('email');
                const email = emailInput.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email || !emailPattern.test(email)) {
                    message = 'Please enter a valid email address';
                    valid = false;
                    emailInput.focus();
                } else {
                    checkEmailAndLogin(email);
                }
                break;
                
            case 11:
                const pwd = document.getElementById('password');
                if (!pwd.value || pwd.value.length < 6) {
                    message = 'Password must be at least 6 characters';
                    valid = false;
                    pwd.focus();
                }
                break;
                
            case 12:
                const duration = document.getElementById('serviceDuration');
                const terms = document.getElementById('termsCheckbox');
                if (!duration.value) {
                    message = 'Please select service duration';
                    valid = false;
                } else if (!terms.checked) {
                    showCGVWarning();
                    valid = false;
                    terms.focus();
                }
                break;
        }
        
        if (!valid && message) {
            showValidationError(message);
        }
        
        return valid;
    }
    
    function showValidationError(message) {
        const errorDiv = document.getElementById('validationError');
        const messageEl = document.getElementById('validationMessage');
        messageEl.textContent = message;
        errorDiv.classList.remove('hidden');
        errorDiv.style.zIndex = '9999';
        setTimeout(() => errorDiv.classList.add('hidden'), 3000);
    }
    
    function showCGVWarning() {
        const warningDiv = document.getElementById('cgvWarning');
        warningDiv.classList.remove('hidden');
        warningDiv.style.zIndex = '9999';
        setTimeout(() => warningDiv.classList.add('hidden'), 3000);
    }
    
    function updateNextButton() {
        let canProceed = false;
        
        switch(currentStep) {
            case 0:
                canProceed = !!document.getElementById('countryNeed').value;
                break;
            case 1:
                canProceed = !!document.getElementById('originCountry').value;
                break;
            case 2:
                canProceed = true;
                break;
            case 3:
                canProceed = !!document.getElementById('durationHere').value;
                break;
            case 4:
                const title = document.getElementById('requestTitle').value;
                const details = document.getElementById('moreDetails').value;
                canProceed = title.length >= 15 && details.length >= 50;
                break;
            case 5:
                canProceed = true;
                break;
            case 6:
                canProceed = !!document.querySelector('input[name="supportType"]:checked');
                break;
            case 7:
                canProceed = !!document.querySelector('input[name="urgency"]:checked');
                break;
            case 8:
                canProceed = document.querySelectorAll('input[name="languages[]"]:checked').length > 0;
                break;
            case 9:
                canProceed = !!document.getElementById('firstName').value;
                break;
            case 10:
                const email = document.getElementById('email').value;
                canProceed = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                break;
            case 11:
                canProceed = document.getElementById('password').value.length >= 6;
                break;
            case 12:
                canProceed = !!document.getElementById('serviceDuration').value && document.getElementById('termsCheckbox').checked;
                break;
            default:
                canProceed = true;
        }
        
        if (canProceed) {
            nextBtn.className = 'px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md bg-blue-600 text-white hover:bg-blue-700 hover:shadow-lg active:scale-95 cursor-pointer';
            nextBtn.disabled = false;
        } else {
            nextBtn.className = 'px-8 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-md bg-gray-300 text-gray-500 cursor-not-allowed';
            nextBtn.disabled = true;
        }
    }
    
    function storeStepData(stepIndex) {
        const expats = JSON.parse(localStorage.getItem('help-request')) || {};
        
        switch (stepIndex) {
            case 0:
                expats.countryNeed = document.getElementById('countryNeed').value;
                break;
            case 1:
                expats.originCountry = document.getElementById('originCountry').value;
                break;
            case 2:
                expats.currentCity = document.getElementById('currentCity').value;
                break;
            case 3:
                expats.durationHere = document.getElementById('durationHere').value;
                break;
            case 4:
                expats.requestTitle = document.getElementById('requestTitle').value;
                expats.moreDetails = document.getElementById('moreDetails').value;
                break;
            case 6:
                const supportType = document.querySelector('input[name="supportType"]:checked');
                expats.supportType = supportType ? supportType.value : null;
                break;
            case 7:
                const urgency = document.querySelector('input[name="urgency"]:checked');
                expats.urgency = urgency ? urgency.value : null;
                break;
            case 8:
                const languages = Array.from(document.querySelectorAll('input[name="languages[]"]:checked')).map(cb => cb.value);
                expats.languages = languages;
                break;
            case 9:
                expats.firstName = document.getElementById('firstName').value;
                break;
            case 10:
                expats.email = document.getElementById('email').value;
                break;
            case 11:
                expats.password = document.getElementById('password').value;
                break;
            case 12:
                expats.serviceDuration = document.getElementById('serviceDuration').value;
                break;
        }
        
        localStorage.setItem('help-request', JSON.stringify(expats));
    }
    
    function restoreStepData() {
        const expats = JSON.parse(localStorage.getItem('help-request')) || {};
        
        if (expats.countryNeed) document.getElementById('countryNeed').value = expats.countryNeed;
        if (expats.originCountry) document.getElementById('originCountry').value = expats.originCountry;
        if (expats.currentCity) document.getElementById('currentCity').value = expats.currentCity;
        if (expats.durationHere) document.getElementById('durationHere').value = expats.durationHere;
        if (expats.requestTitle) {
            document.getElementById('requestTitle').value = expats.requestTitle;
            document.getElementById('requestTitle').dispatchEvent(new Event('input'));
        }
        if (expats.moreDetails) {
            document.getElementById('moreDetails').value = expats.moreDetails;
            document.getElementById('moreDetails').dispatchEvent(new Event('input'));
        }
        if (expats.firstName) document.getElementById('firstName').value = expats.firstName;
        if (expats.email) document.getElementById('email').value = expats.email;
        if (expats.password) {
            document.getElementById('password').value = expats.password;
            document.getElementById('password').dispatchEvent(new Event('input'));
        }
        if (expats.serviceDuration) document.getElementById('serviceDuration').value = expats.serviceDuration;
        
        if (expats.languages && Array.isArray(expats.languages)) {
            expats.languages.forEach(lang => {
                const checkbox = document.querySelector('input[name="languages[]"][value="' + lang + '"]');
                if (checkbox) {
                    checkbox.checked = true;
                    const option = checkbox.closest('.lang-option');
                    if (option) {
                        option.className = 'lang-option border-2 rounded-2xl px-3 py-3 cursor-pointer transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 bg-blue-600 text-white border-blue-700';
                    }
                }
            });
        }
        
        const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
        for (let photoName in photoData) {
            const input = document.querySelector(`input[name="${photoName}"]`);
            const preview = input?.closest('.photo-upload-box')?.querySelector('.photo-preview');
            
            if (preview && photoData[photoName].base64) {
                preview.src = photoData[photoName].base64;
                const photoBox = input.closest('.photo-upload-box');
                if (photoBox) {
                    photoBox.classList.add('has-photo');
                    const label = photoBox.querySelector('.photo-label');
                    if (label) label.classList.add('hidden');
                }
                console.log('🔄 Photo preview restauré:', photoName);
            }
        }
    }
    
    restoreStepData();

    document.querySelectorAll('input:not([type="hidden"]):not(.lang-checkbox), select, textarea').forEach(el => {
        el.addEventListener('input', function() {
            storeStepData(currentStep);
            updateNextButton();
        });
        el.addEventListener('change', function() {
            storeStepData(currentStep);
            updateNextButton();
        });
    });
    
    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps - 1) {
            if (!validateStep(currentStep)) return;
            
            storeStepData(currentStep);
            
            if (isAuthenticated && currentStep === 8) {
                currentStep = 11;
            }
            
            if (currentStep === 12) {
                const form = document.getElementById('helpRequestForm');
                const formData = new FormData(form);
                const expats = JSON.parse(localStorage.getItem('help-request')) || {};
                
                Object.entries(expats).forEach(([key, val]) => {
                    if (!formData.has(key)) {
                        if (Array.isArray(val)) {
                            val.forEach(v => formData.append(key + '[]', v));
                        } else {
                            formData.append(key, val);
                        }
                    }
                });
                
                const categories = JSON.parse(localStorage.getItem('create-request')) || {};
                if (categories) {
                    formData.append('category', categories.category || '');
                    formData.append('subcategory', categories.sub_category || '');
                    formData.append('subcategory2', categories.child_category || '');
                }
                
                nextBtn.disabled = true;
                nextBtn.setAttribute('aria-busy', 'true');
                
                console.log('📤 Envoi du formulaire...');
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(res => {
                    console.log('📡 Statut réponse:', res.status);
                    if (!res.ok) {
                        throw new Error('Erreur serveur: ' + res.status);
                    }
                    return res.json();
                })
                .then(data => {
                    console.log('✅ Données reçues du serveur:', data);
                    console.log('🆔 Mission ID:', data.mission_id);
                    
                    localStorage.removeItem('help-request');
                    localStorage.removeItem('create-request');
                    localStorage.removeItem('photo-previews');
                    
                    if (data.mission_id) {
                        localStorage.setItem('current-mission-id', data.mission_id);
                        console.log('💾 Mission ID stocké dans localStorage');
                    } else {
                        console.warn('⚠️ Aucun mission_id reçu du serveur');
                        console.warn('⚠️ Données complètes:', JSON.stringify(data));
                    }
                    
                    currentStep++;
                    showStep(currentStep);
                })
                .catch((error) => {
                    console.error('❌ Erreur lors de la soumission:', error);
                    console.error('❌ Détails:', error.message);
                    showValidationError('Submission failed. Please try again.');
                })
                .finally(() => {
                    nextBtn.disabled = false;
                    nextBtn.setAttribute('aria-busy', 'false');
                });
                return;
            }
            
            currentStep++;
            showStep(currentStep);
        }
    });
    
    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            storeStepData(currentStep);
            
            // ✅ FIX: Gérer le retour depuis step 12b (step 12 quand authentifié)
            if (isAuthenticated && currentStep === 12) {
                currentStep = 8; // Retourner au step languages (step 9)
            } else {
                currentStep--;
            }
            
            showStep(currentStep);
        }
    });
    
    // ✅ GESTION DES PHOTOS - UPLOAD ET ZOOM
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
    
    // Variables pour le zoom
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
        
        menuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Si une photo existe déjà, ouvrir le zoom
            if (box.classList.contains('has-photo')) {
                openPhotoZoom(preview.src, box);
                return;
            }
            
            // Sinon ouvrir le menu d'upload
            activePhotoInput = input;
            activePhotoPreview = preview;
            photoMenuModal.classList.remove('hidden');
            photoMenuModal.style.zIndex = '9999';
        });
        
        // ✅ COMPRESSION lors de la sélection depuis la bibliothèque
        input.addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            if (file.size > 5 * 1024 * 1024) {
                showValidationError('File size must be less than 5MB');
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                showValidationError('Only image files are allowed');
                return;
            }
            
            // ✅ COMPRESSER L'IMAGE
            const compressedFile = await compressImage(file, 1200, 0.8);
            
            // Remplacer le fichier dans l'input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            input.files = dataTransfer.files;
            
            // Afficher la preview
            const photoUrl = URL.createObjectURL(compressedFile);
            preview.src = photoUrl;
            
            // Changer l'apparence du bloc
            box.classList.add('has-photo');
            const label = box.querySelector('.photo-label');
            if (label) label.classList.add('hidden');
            
            // Sauvegarder dans localStorage
            const reader = new FileReader();
            reader.onload = function(readerEvent) {
                const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                const photoName = input.name;
                photoData[photoName] = {
                    base64: readerEvent.target.result,
                    timestamp: Date.now()
                };
                localStorage.setItem('photo-previews', JSON.stringify(photoData));
                console.log('💾 Photo preview sauvegardé:', photoName);
            };
            reader.readAsDataURL(compressedFile);
        });
    });
    
    photoMenuOptions.forEach(option => {
        option.addEventListener('click', function() {
            const action = option.getAttribute('data-action');
            photoMenuModal.classList.add('hidden');
            if (!activePhotoInput) return;
            
            if (action === 'library' || action === 'file') {
                activePhotoInput.click();
            } else if (action === 'camera') {
                cameraModal.classList.remove('hidden');
                cameraModal.style.zIndex = '9999';
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({ 
                        video: { 
                            facingMode: 'environment',
                            width: { ideal: 1280 },
                            height: { ideal: 720 }
                        } 
                    })
                    .then(function(stream) {
                        cameraStream = stream;
                        cameraVideo.srcObject = stream;
                        cameraVideo.play();
                    })
                    .catch(function(err) {
                        console.error('Camera access denied:', err);
                        showValidationError('Camera access denied');
                        cameraModal.classList.add('hidden');
                    });
                }
            }
        });
    });
    
    if (closePhotoMenuModal) {
        closePhotoMenuModal.onclick = function() {
            photoMenuModal.classList.add('hidden');
        };
    }
    
    photoMenuModal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
    
    function closeCameraAndStream() {
        cameraModal.classList.add('hidden');
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
            cameraStream = null;
        }
        if (cameraVideo.srcObject) {
            cameraVideo.srcObject.getTracks().forEach(track => track.stop());
            cameraVideo.srcObject = null;
        }
    }
    
    if (closeCameraModal) {
        closeCameraModal.onclick = closeCameraAndStream;
    }
    
    cameraModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCameraAndStream();
        }
    });
    
    if (capturePhotoBtn) {
        capturePhotoBtn.onclick = async function() {
            if (!cameraVideo.srcObject) return;
            const canvas = document.createElement('canvas');
            canvas.width = cameraVideo.videoWidth;
            canvas.height = cameraVideo.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(cameraVideo, 0, 0, canvas.width, canvas.height);
            
            canvas.toBlob(async function(blob) {
                let file = new File([blob], 'camera-photo-' + Date.now() + '.png', { 
                    type: 'image/png',
                    lastModified: Date.now()
                });
                
                // ✅ COMPRESSION de la photo capturée
                file = await compressImage(file, 1200, 0.8);
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                
                if (activePhotoInput) {
                    activePhotoInput.files = dataTransfer.files;
                    console.log('📸 Photo capturée et compressée:', file.size, 'bytes');
                    
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
                        const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
                        const photoName = activePhotoInput.name;
                        photoData[photoName] = {
                            base64: e.target.result,
                            timestamp: Date.now()
                        };
                        localStorage.setItem('photo-previews', JSON.stringify(photoData));
                        console.log('💾 Photo preview sauvegardé:', photoName);
                    };
                    reader.readAsDataURL(file);
                }
                
                closeCameraAndStream();
            }, 'image/png', 0.95);
        };
    }
    
    // ✅ FONCTIONS DE ZOOM
    function openPhotoZoom(imageUrl, photoBox) {
        currentPhotoBox = photoBox;
        zoomedImage.src = imageUrl;
        currentZoomLevel = 1;
        zoomedImage.style.transform = 'scale(1)';
        photoZoomModal.classList.remove('hidden');
        photoZoomModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closePhotoZoom() {
        photoZoomModal.classList.add('hidden');
        photoZoomModal.classList.remove('flex');
        currentPhotoBox = null;
        currentZoomLevel = 1;
        document.body.style.overflow = '';
    }
    
    if (closeZoomModal) {
        closeZoomModal.addEventListener('click', closePhotoZoom);
    }
    
    photoZoomModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closePhotoZoom();
        }
    });
    
    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', function() {
            currentZoomLevel = Math.min(currentZoomLevel + 0.25, 3);
            zoomedImage.style.transform = `scale(${currentZoomLevel})`;
        });
    }
    
    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', function() {
            currentZoomLevel = Math.max(currentZoomLevel - 0.25, 0.5);
            zoomedImage.style.transform = `scale(${currentZoomLevel})`;
        });
    }
    
    if (resetZoomBtn) {
        resetZoomBtn.addEventListener('click', function() {
            currentZoomLevel = 1;
            zoomedImage.style.transform = 'scale(1)';
        });
    }
    
    if (deletePhotoBtn) {
        deletePhotoBtn.addEventListener('click', function() {
            if (!currentPhotoBox) return;
            
            // Reset le bloc photo
            const input = currentPhotoBox.querySelector('.photo-input');
            const preview = currentPhotoBox.querySelector('.photo-preview');
            const label = currentPhotoBox.querySelector('.photo-label');
            
            input.value = '';
            preview.src = preview.getAttribute('data-default-src') || '/images/uploadpng.png';
            currentPhotoBox.classList.remove('has-photo');
            if (label) label.classList.remove('hidden');
            
            // Supprimer du localStorage
            const photoName = input.name;
            const photoData = JSON.parse(localStorage.getItem('photo-previews')) || {};
            delete photoData[photoName];
            localStorage.setItem('photo-previews', JSON.stringify(photoData));
            
            console.log('🗑️ Photo supprimée:', photoName);
            closePhotoZoom();
        });
    }
    
    function checkEmailAndLogin(email) {
        fetch('/check-email-login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateHeaderUI(data.user);
                currentStep = 12;
                showStep(currentStep);
            }
        })
        .catch(err => {
            console.error('Error checking email:', err);
        });
    }
    
    function updateHeaderUI(user) {
        const authButtonsContainer = document.querySelector('.flex.items-center.space-x-3');
        if (!authButtonsContainer) return;
        
        const userMenuHTML = `
            <div class="relative" x-data="{ open:false }">
                <button 
                    type="button"
                    @click="open = !open"
                    @keydown.escape.window="open = false"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100"
                    aria-haspopup="menu"
                    :aria-expanded="open.toString()"
                >
                    <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                         style="background-image: url('${user.avatar || '/images/helpexpat.png'}');">
                    </div>
                    <span id="header-user-name" class="font-medium text-gray-700 truncate max-w-[10rem]">
                        ${user.name || 'User'}
                    </span>
                    <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                </button>
                <div
                    x-cloak
                    x-show="open"
                    x-transition
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                    style="display:none"
                    class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50"
                    role="menu"
                >
                    <div class="p-3 flex items-center gap-3 border-b">
                        <div class="w-8 h-8 rounded-full border bg-center bg-cover"
                             style="background-image: url('${user.avatar || '/images/helpexpat.png'}');">
                        </div>
                        <div class="min-w-0">
                            <div id="header-user-fullname" class="font-semibold truncate mb-1">
                                ${user.name || 'User'}
                            </div>
                            <div class="text-xs">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-medium bg-emerald-100 text-emerald-700 ring-1 ring-emerald-600/20 truncate max-w-[12rem]">
                                    <i class="fas fa-toolbox text-[11px]"></i>
                                    Service Provider
                                </span>
                            </div>
                        </div>
                    </div>
                    <nav class="py-1">
                        <a href="/dashboard" 
                           class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gray-50" 
                           role="menuitem">
                            <i class="fas fa-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                        <form method="POST" action="/logout" class="mt-1">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <button type="submit" 
                                    class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50" 
                                    role="menuitem">
                                <i class="fas fa-right-from-bracket"></i>
                                <span>Log out</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        `;
        
        authButtonsContainer.innerHTML = userMenuHTML;
        if (window.Alpine) {
            window.Alpine.initTree(authButtonsContainer);
        }
    }
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Enter key pour next
        if (e.key === 'Enter' && !e.shiftKey && !nextBtn.disabled) {
            const activeEl = document.activeElement;
            if (activeEl && activeEl.tagName !== 'TEXTAREA') {
                e.preventDefault();
                nextBtn.click();
            }
        }
        
        // Escape pour fermer le zoom
        if (e.key === 'Escape' && !photoZoomModal.classList.contains('hidden')) {
            closePhotoZoom();
        }
    });
    
    showStep(currentStep);
    
    if (window.countrySelect) {
        document.querySelectorAll('.country-select').forEach(function(select) {
            window.countrySelect(select, {
                defaultCountry: "us",
                onlyCountries: null,
                responsiveDropdown: true
            });
        });
    }
})();