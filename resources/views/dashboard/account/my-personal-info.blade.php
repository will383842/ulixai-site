@extends('dashboard.layouts.master')

@section('title', 'Personal Info')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #475569;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-sm: 0.75rem;
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
    
    html, body {
        background: #ffffff !important;
    }
    
    /* Optimisation: Containment pour isoler le rendu */
    .personal-info-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0.875rem;
        padding-bottom: 8rem; /* Space for mobile navbar */
        background: #ffffff;
        contain: layout style paint;
    }
    
    .page-title-2025 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 1.5rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    /* EARNINGS BADGE - Optimisé */
    .earnings-badge {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #78350f;
        padding: 0.875rem 1.5rem;
        border-radius: 999px;
        font-size: 0.8125rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        margin-bottom: 1.5rem;
        /* Optimisation: GPU acceleration */
        will-change: box-shadow;
        transform: translateZ(0);
        -webkit-backface-visibility: hidden;
    }
    
    /* Optimisation: Animation plus légère avec GPU */
    @keyframes pulseEarnings {
        0%, 100% { 
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
            transform: translateZ(0) scale(1);
        }
        50% { 
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
            transform: translateZ(0) scale(1.02);
        }
    }
    
    .earnings-badge {
        animation: pulseEarnings 3s ease-in-out infinite;
    }
    
    .earnings-label {
        font-size: 0.6875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .earnings-value {
        font-size: 1.25rem;
        font-weight: 800;
    }
    
    /* FORM CARD */
    .form-card-2025 {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        /* Optimisation: Isoler le rendu */
        contain: layout style;
    }
    
    .form-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.875rem;
        border-bottom: 2px solid #e5e7eb;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-grid {
        display: grid;
        gap: 1.25rem;
        grid-template-columns: 1fr;
        margin-bottom: 1.5rem;
    }
    
    .form-field {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .form-field.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    /* Optimisation: Inputs avec meilleure performance */
    .form-input,
    .form-select {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.9375rem;
        color: var(--color-text-primary);
        background: var(--color-bg-primary);
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        font-family: inherit;
        /* Optimisation: Éviter le zoom sur iOS */
        font-size: max(16px, 0.9375rem);
    }
    
    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-input[readonly] {
        background: var(--color-bg-secondary);
        color: var(--color-text-tertiary);
        cursor: not-allowed;
    }
    
    .form-input::placeholder {
        color: var(--color-text-tertiary);
    }
    
    .form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25rem;
        padding-right: 2.5rem;
    }
    
    .form-select[multiple] {
        height: auto;
        min-height: 120px;
        background-image: none;
        padding-right: 1.125rem;
    }
    
    .form-hint {
        font-size: 0.75rem;
        color: var(--color-text-tertiary);
        margin-top: 0.25rem;
    }
    
    /* EDITABLE FIELD GROUP */
    .editable-field-group {
        display: flex;
        gap: 0.75rem;
        align-items: flex-end;
    }
    
    .editable-field-input {
        flex: 1;
    }
    
    /* Optimisation: Boutons avec GPU acceleration */
    .btn-edit {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #78350f;
        border: none;
        border-radius: var(--border-radius-md);
        padding: 0.875rem 1.25rem;
        font-size: 0.8125rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        box-shadow: 0 2px 6px rgba(251, 191, 36, 0.3);
        /* Optimisation: GPU acceleration */
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
    }
    
    .btn-edit:active {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }
    
    .btn-edit.saving {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .btn-edit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Accessibility: Focus visible */
    .btn-edit:focus-visible,
    .btn-submit:focus-visible,
    .form-input:focus-visible,
    .form-select:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }
    
    /* SUBMIT BUTTON - Optimisé */
    .btn-submit {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: 999px;
        padding: 1rem 2.5rem;
        font-size: 0.9375rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        min-width: 200px;
        /* Optimisation: GPU acceleration */
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }
    
    .btn-submit:active {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }
    
    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: translateZ(0);
    }
    
    .submit-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e7eb;
    }
    
    /* TOAST NOTIFICATION - Optimisé */
    .toast-notification {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 1rem 1.25rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        z-index: 10001;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        border: 2px solid;
        min-width: 300px;
        max-width: 90vw;
        /* Optimisation: GPU acceleration */
        will-change: transform, opacity;
        transform: translateZ(0);
        -webkit-backface-visibility: hidden;
    }
    
    /* Optimisation: Animation plus performante */
    @keyframes slideInToast {
        from {
            transform: translateX(100%) translateZ(0);
            opacity: 0;
        }
        to {
            transform: translateX(0) translateZ(0);
            opacity: 1;
        }
    }
    
    .toast-notification {
        animation: slideInToast 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .toast-notification.success {
        border-color: var(--color-success);
        background: #f0fdf4;
    }
    
    .toast-notification.error {
        border-color: var(--color-danger);
        background: #fef2f2;
    }
    
    .toast-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .toast-notification.success .toast-icon {
        background: var(--color-success);
        color: white;
    }
    
    .toast-notification.error .toast-icon {
        background: var(--color-danger);
        color: white;
    }
    
    .toast-message {
        flex: 1;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-primary);
    }
    
    /* Optimisation: Animation du spinner */
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .fa-spin {
        animation: spin 0.8s linear infinite;
        will-change: transform;
    }
    
    /* RESPONSIVE */
    @media (min-width: 640px) {
        .personal-info-container {
            padding: 1.5rem;
            padding-bottom: 8rem;
        }
        
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .form-card-2025 {
            padding: 2rem;
        }
        
        .earnings-badge {
            padding: 1rem 1.75rem;
            font-size: 0.875rem;
        }
        
        .earnings-value {
            font-size: 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .personal-info-container {
            padding: 2rem;
            padding-bottom: 2rem; /* No mobile navbar on desktop */
        }
        
        .page-title-2025 {
            font-size: 1.75rem;
        }
        
        .form-card-2025 {
            padding: 2.5rem;
        }
    }
    
    /* Optimisation: Prevent body scroll issues */
    * {
        box-sizing: border-box;
    }
</style>

<div class="personal-info-container">

    <h1 class="page-title-2025">My Personal Information</h1>

    <!-- Earnings Badge -->
    <div class="earnings-badge">
        <span class="earnings-label">Total Referral Earnings</span>
        <span class="earnings-value">{{ number_format($user->pending_affiliate_balance, 2) ?? 0.00 }} €</span>
    </div>

    <!-- Personal Info Form -->
    <div class="form-card-2025">
        <h2 class="form-section-title">Personal Details</h2>

        <form id="personalInfoForm">
            @csrf

            <!-- Basic Info Fields -->
            <div class="form-grid">
                <div class="form-field">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{$user->name ?? ''}}" class="form-input" required>
                </div>

                <div class="form-field">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" value="{{ $user->dob ?? ''}}" class="form-input">
                </div>

                <div class="form-field">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ ($user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="form-field">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{$user->address ?? ''}}" class="form-input">
                </div>
                
                <div class="form-field">
                    <label class="form-label">Nationality</label>
                    <select name="country" class="form-select">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->country }}" {{ ($user->country ?? '') == $country->country ? 'selected' : '' }}>{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label class="form-label">Native Language</label>
                    <select name="preferred_language" class="form-select">
                        <option value="">Select Language</option>
                        @foreach($languages as $language)
                            <option value="{{ $language }}" {{ ($user->preferred_language ?? '') == $language ? 'selected' : '' }}>{{ $language }}</option>
                        @endforeach
                    </select>
                </div>

                @if($user->user_role === 'service_provider')
                <div class="form-field">
                    <label class="form-label">Provider Native Language</label>
                    <select name="provider_native_language" class="form-select">
                        <option value="">Select Native Language</option>
                        @foreach($languages as $language)
                            <option value="{{ $language }}" {{ ($provider->native_language ?? '') == $language ? 'selected' : '' }}>{{ $language }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Full Width Field for Spoken Languages -->
                <div class="form-field full-width">
                    <label class="form-label">What languages do you speak?</label>
                    <select name="spoken_languages[]" multiple class="form-select">
                    @php
                        $spokenLanguages = is_array($provider->spoken_language ?? []) ? $provider->spoken_language : json_decode($provider->spoken_language ?? '[]', true);
                    @endphp  
                    @foreach($languages as $language)
                        <option value="{{ $language }}" {{ in_array($language, $spokenLanguages) ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                    </select>
                    <small class="form-hint">Hold Ctrl/Cmd to select multiple languages</small>
                </div>
                @else
                <!-- Full Width Field for Regular Users -->
                <div class="form-field full-width">
                    <label class="form-label">What languages do you speak?</label>
                    <input type="text" name="spoken_languages_text" class="form-input" placeholder="e.g., English, Spanish, French">
                </div>
                @endif
            </div>

            <!-- Editable Fields -->
            <div class="form-grid">
                <div class="form-field">
                    <label class="form-label">WhatsApp Number</label>
                    <div class="editable-field-group">
                        <div class="editable-field-input">
                            <input type="tel" name="whatsapp_number" value="{{ $user->phone_number ?? '' }}" class="form-input">
                        </div>
                        <button type="button" class="btn-edit edit-field-btn" data-field="whatsapp_number">
                            Edit
                        </button>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Email</label>
                    <div class="editable-field-group">
                        <div class="editable-field-input">
                            <input type="email" name="email" value="{{$user->email ?? 'example@gmail.com'}}" class="form-input" readonly>
                        </div>
                        <button type="button" class="btn-edit edit-field-btn" data-field="email">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <input type="hidden" name="user_id" value="{{$user->id}}">

            <!-- Submit Button -->
            <div class="submit-container">
                <button type="submit" class="btn-submit" aria-label="Update personal information">
                    <i class="fas fa-save"></i>
                    <span>Update Information</span>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
(function() {
    'use strict';
    
    // Optimisation: Debounce pour les événements répétitifs
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Optimisation: Toast avec GPU acceleration
    function showToast(message, type) {
        const existing = document.querySelector('.toast-notification');
        if (existing) {
            existing.remove();
        }
        
        const icons = {
            success: 'fa-circle-check',
            error: 'fa-circle-xmark'
        };
        
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        toast.innerHTML = `
            <div class="toast-icon">
                <i class="fas ${icons[type]}"></i>
            </div>
            <div class="toast-message">${message}</div>
        `;
        
        // Optimisation: Utiliser requestAnimationFrame
        requestAnimationFrame(() => {
            document.body.appendChild(toast);
        });
        
        // Vibration feedback (si supporté)
        if ('vibrate' in navigator) {
            navigator.vibrate(25);
        }
        
        // Auto-dismiss après 5 secondes
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 5000);
    }
    
    // Handle form submission - Optimisé
    function handleFormSubmit(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('.btn-submit');
        const originalHTML = submitBtn.innerHTML;
        
        // Désactiver le bouton pendant la requête
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Updating...</span>';
        submitBtn.disabled = true;
        submitBtn.setAttribute('aria-busy', 'true');
        
        fetch('/account/update-personal-info', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('✨ Personal information updated successfully!', 'success');
            } else {
                showToast(data.message || '😅 Oops! Something went wrong. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('🤔 Hmm... A connection error occurred. Please check your internet and try again.', 'error');
        })
        .finally(() => {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
            submitBtn.removeAttribute('aria-busy');
        });
    }
    
    // Handle edit field buttons - Optimisé
    function handleEditField(button) {
        const fieldName = button.getAttribute('data-field');
        const input = document.querySelector(`input[name="${fieldName}"]`);
        
        if (!input) {
            console.error('Input not found for field:', fieldName);
            return;
        }
        
        if (input.hasAttribute('readonly')) {
            // Switch to edit mode
            input.removeAttribute('readonly');
            input.focus();
            button.textContent = 'Save';
            button.classList.add('saving');
        } else {
            // Save the field
            const formData = new FormData();
            formData.append(fieldName, input.value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            
            const originalText = button.textContent;
            const originalValue = input.defaultValue || input.value;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;
            
            fetch('/account/update-field', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    input.setAttribute('readonly', 'true');
                    input.defaultValue = input.value; // Update default value
                    button.textContent = 'Edit';
                    button.classList.remove('saving');
                    const fieldLabel = fieldName.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    showToast(`✨ ${fieldLabel} updated successfully!`, 'success');
                } else {
                    showToast(data.message || '😅 Failed to update. Please try again.', 'error');
                    input.value = originalValue;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('🤔 Connection error. Please check your internet and try again.', 'error');
                input.value = originalValue;
            })
            .finally(() => {
                button.textContent = originalText;
                button.disabled = false;
            });
        }
    }
    
    // Optimisation: Initialisation avec event delegation
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission
        const form = document.getElementById('personalInfoForm');
        if (form) {
            form.addEventListener('submit', handleFormSubmit);
        }
        
        // Edit buttons - Utiliser event delegation
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('edit-field-btn') || 
                e.target.closest('.edit-field-btn')) {
                e.preventDefault();
                e.stopPropagation();
                
                const button = e.target.classList.contains('edit-field-btn') 
                    ? e.target 
                    : e.target.closest('.edit-field-btn');
                
                handleEditField(button);
            }
        });
        
        // Optimisation: Passive scroll listener si nécessaire
        document.addEventListener('scroll', debounce(() => {
            // Actions sur scroll si nécessaire
        }, 150), { passive: true });
    });
})();
</script>

@endsection