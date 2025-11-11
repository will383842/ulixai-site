<!-- KYC Banner - Mobile First 2025/2026 -->
@php
    $user = auth()->user();
    $provider = $user->serviceProvider ?? null;
@endphp

@if($user->user_role === 'service_provider')
    @if ($provider && $provider->kyc_status != 'verified' && $provider->stripe_account_id)
        <style>
            /* ========================================
               KYC BANNER 2025/2026
               ======================================== */
            
            .kyc-banner-2025 {
                position: relative;
                background: linear-gradient(135deg, 
                    rgba(255, 251, 235, 0.95) 0%, 
                    rgba(254, 243, 199, 0.95) 100%);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-left: 4px solid #f59e0b;
                border-radius: 1rem;
                padding: 1.25rem;
                margin-bottom: 1.5rem;
                box-shadow: 
                    0 10px 15px -3px rgba(245, 158, 11, 0.1),
                    0 4px 6px -2px rgba(245, 158, 11, 0.05),
                    0 0 0 1px rgba(245, 158, 11, 0.1);
                animation: kycSlideIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                overflow: hidden;
            }
            
            @keyframes kycSlideIn {
                from { 
                    opacity: 0; 
                    transform: translateY(-20px); 
                }
                to { 
                    opacity: 1; 
                    transform: translateY(0); 
                }
            }
            
            /* Shimmer effect subtil */
            .kyc-banner-2025::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, 0.4),
                    transparent
                );
                animation: shimmer 3s infinite;
            }
            
            @keyframes shimmer {
                0% { left: -100%; }
                50%, 100% { left: 100%; }
            }
            
            .kyc-content-wrapper {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .kyc-icon-wrapper {
                display: flex;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .kyc-icon-badge {
                flex-shrink: 0;
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.5rem;
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
                animation: iconPulse 2s ease-in-out infinite;
            }
            
            @keyframes iconPulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .kyc-text-content {
                flex: 1;
            }
            
            .kyc-title-2025 {
                font-size: 1.125rem;
                font-weight: 700;
                color: #92400e;
                margin-bottom: 0.375rem;
                letter-spacing: -0.01em;
            }
            
            .kyc-description-2025 {
                font-size: 0.875rem;
                color: #78350f;
                line-height: 1.5;
                opacity: 0.9;
            }
            
            .kyc-cta-wrapper {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .kyc-btn-2025 {
                position: relative;
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
                padding: 0.875rem 1.75rem;
                border-radius: 0.75rem;
                font-weight: 600;
                font-size: 0.9375rem;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                box-shadow: 
                    0 4px 12px rgba(245, 158, 11, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.2) inset;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                -webkit-tap-highlight-color: transparent;
                overflow: hidden;
                width: 100%;
            }
            
            .kyc-btn-2025::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }
            
            .kyc-btn-2025:hover::before {
                width: 300px;
                height: 300px;
            }
            
            .kyc-btn-2025:active {
                transform: scale(0.96);
            }
            
            .kyc-btn-2025:disabled {
                opacity: 0.7;
                cursor: not-allowed;
                transform: none;
            }
            
            .kyc-btn-content {
                position: relative;
                z-index: 1;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            /* Loading spinner */
            .kyc-spinner {
                width: 18px;
                height: 18px;
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-top-color: white;
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }
            
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .kyc-dismiss-btn {
                align-self: flex-start;
                background: rgba(120, 53, 15, 0.1);
                color: #92400e;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                font-size: 0.8125rem;
                font-weight: 500;
                border: none;
                cursor: pointer;
                transition: all 0.2s ease;
                -webkit-tap-highlight-color: transparent;
            }
            
            .kyc-dismiss-btn:hover {
                background: rgba(120, 53, 15, 0.15);
            }
            
            .kyc-dismiss-btn:active {
                transform: scale(0.95);
            }
            
            /* Toast notification */
            .kyc-toast {
                position: fixed;
                top: 1rem;
                right: 1rem;
                left: 1rem;
                background: white;
                border-radius: 1rem;
                padding: 1rem;
                box-shadow: 
                    0 20px 25px -5px rgba(0, 0, 0, 0.1),
                    0 10px 10px -5px rgba(0, 0, 0, 0.04);
                z-index: 10000;
                animation: toastSlideIn 0.3s ease;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }
            
            @keyframes toastSlideIn {
                from { transform: translateY(-100%); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            
            @keyframes toastSlideOut {
                from { transform: translateY(0); opacity: 1; }
                to { transform: translateY(-100%); opacity: 0; }
            }
            
            .kyc-toast.toast-hide {
                animation: toastSlideOut 0.3s ease forwards;
            }
            
            .kyc-toast-icon {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
            }
            
            .kyc-toast-icon.success {
                background: #dcfce7;
                color: #16a34a;
            }
            
            .kyc-toast-icon.error {
                background: #fee2e2;
                color: #dc2626;
            }
            
            .kyc-toast-icon.info {
                background: #dbeafe;
                color: #2563eb;
            }
            
            .kyc-toast-content {
                flex: 1;
            }
            
            .kyc-toast-title {
                font-weight: 600;
                font-size: 0.9375rem;
                color: #111827;
                margin-bottom: 0.125rem;
            }
            
            .kyc-toast-message {
                font-size: 0.8125rem;
                color: #6b7280;
            }
            
            /* Responsive Desktop */
            @media (min-width: 640px) {
                .kyc-content-wrapper {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                }
                
                .kyc-cta-wrapper {
                    flex-direction: row;
                    align-items: center;
                    min-width: fit-content;
                }
                
                .kyc-btn-2025 {
                    width: auto;
                    min-width: 140px;
                }
                
                .kyc-toast {
                    left: auto;
                    max-width: 400px;
                }
            }
            
            @media (min-width: 768px) {
                .kyc-banner-2025 {
                    padding: 1.5rem;
                }
                
                .kyc-icon-badge {
                    width: 56px;
                    height: 56px;
                    font-size: 1.75rem;
                }
                
                .kyc-title-2025 {
                    font-size: 1.25rem;
                }
            }
            
            /* Reduced Motion Support */
            @media (prefers-reduced-motion: reduce) {
                .kyc-banner-2025,
                .kyc-banner-2025::before,
                .kyc-icon-badge,
                .kyc-btn-2025,
                .kyc-toast {
                    animation: none !important;
                }
                
                .kyc-btn-2025:active {
                    transform: scale(0.98);
                }
            }
            
            /* Dark mode support (optionnel) */
            @media (prefers-color-scheme: dark) {
                .kyc-banner-2025 {
                    background: linear-gradient(135deg, 
                        rgba(39, 39, 42, 0.95) 0%, 
                        rgba(24, 24, 27, 0.95) 100%);
                    border-left-color: #fbbf24;
                }
                
                .kyc-title-2025 {
                    color: #fbbf24;
                }
                
                .kyc-description-2025 {
                    color: #fde68a;
                }
            }
        </style>

        <div id="kyc-banner" class="kyc-banner-2025" role="alert" aria-live="polite">
            <div class="kyc-content-wrapper">
                <div class="kyc-icon-wrapper">
                    <div class="kyc-icon-badge" aria-hidden="true">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <div class="kyc-text-content">
                        <h3 class="kyc-title-2025">Complete Your Identity Verification</h3>
                        <p class="kyc-description-2025">To receive payouts securely, please complete your KYC verification with Stripe.</p>
                    </div>
                </div>
                
                <div class="kyc-cta-wrapper">
                    <button
                        id="start-kyc-btn"
                        class="kyc-btn-2025"
                        onclick="completeKYC2025()"
                        aria-label="Start KYC verification process"
                    >
                        <span class="kyc-btn-content">
                            <i class="fas fa-arrow-right"></i>
                            <span>Continue</span>
                        </span>
                    </button>
                    <button
                        id="dismiss-kyc-btn"
                        class="kyc-dismiss-btn"
                        onclick="dismissKYCBanner()"
                        aria-label="Dismiss banner temporarily"
                    >
                        Remind me later
                    </button>
                </div>
            </div>
        </div>

        <script>
        (function() {
            'use strict';
            
            // ========================================
            // TOAST NOTIFICATION SYSTEM
            // ========================================
            const toast = {
                show(type, title, message, duration = 4000) {
                    // Supprimer les toasts existants
                    document.querySelectorAll('.kyc-toast').forEach(t => t.remove());
                    
                    const icons = {
                        success: 'fa-circle-check',
                        error: 'fa-circle-xmark',
                        info: 'fa-circle-info'
                    };
                    
                    const toastEl = document.createElement('div');
                    toastEl.className = 'kyc-toast';
                    toastEl.innerHTML = `
                        <div class="kyc-toast-icon ${type}">
                            <i class="fas ${icons[type]}"></i>
                        </div>
                        <div class="kyc-toast-content">
                            <div class="kyc-toast-title">${title}</div>
                            ${message ? `<div class="kyc-toast-message">${message}</div>` : ''}
                        </div>
                    `;
                    
                    document.body.appendChild(toastEl);
                    
                    // Haptic feedback
                    if ('vibrate' in navigator) {
                        navigator.vibrate(type === 'error' ? [50, 30, 50] : 25);
                    }
                    
                    // Auto-dismiss
                    setTimeout(() => {
                        toastEl.classList.add('toast-hide');
                        setTimeout(() => toastEl.remove(), 300);
                    }, duration);
                }
            };
            
            // ========================================
            // KYC COMPLETION FUNCTION
            // ========================================
            window.completeKYC2025 = function() {
                const btn = document.getElementById('start-kyc-btn');
                const btnContent = btn.querySelector('.kyc-btn-content');
                const originalContent = btnContent.innerHTML;
                
                // État loading
                btn.disabled = true;
                btnContent.innerHTML = `
                    <div class="kyc-spinner"></div>
                    <span>Processing...</span>
                `;
                
                // Haptic feedback
                if ('vibrate' in navigator) {
                    navigator.vibrate(15);
                }
                
                fetch("{{ route('stripe.kyc.link') }}")
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        if (data.completed) {
                            toast.show('success', 'Already Verified!', 'Your account is already verified.');
                            
                            setTimeout(() => {
                                const banner = document.getElementById('kyc-banner');
                                banner.style.animation = 'kycSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) reverse';
                                setTimeout(() => banner.remove(), 400);
                            }, 2000);
                            
                        } else if (data.url) {
                            toast.show('info', 'Redirecting...', 'Opening Stripe verification page.');
                            
                            setTimeout(() => {
                                window.location.href = data.url;
                            }, 1000);
                            
                        } else {
                            throw new Error('Invalid response from server');
                        }
                    })
                    .catch(err => {
                        console.error('KYC Error:', err);
                        
                        toast.show('error', 'Connection Error', 'Please try again later or contact support.');
                        
                        // Restaurer le bouton
                        btn.disabled = false;
                        btnContent.innerHTML = originalContent;
                    });
            };
            
            // ========================================
            // DISMISS BANNER TEMPORAIREMENT
            // ========================================
            window.dismissKYCBanner = function() {
                const banner = document.getElementById('kyc-banner');
                
                // Haptic feedback
                if ('vibrate' in navigator) {
                    navigator.vibrate(10);
                }
                
                banner.style.animation = 'kycSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) reverse';
                setTimeout(() => banner.remove(), 400);
                
                toast.show('info', 'Reminder Set', 'We\'ll remind you about KYC verification.');
                
                // Stocker dans sessionStorage pour ne pas réafficher pendant la session
                sessionStorage.setItem('kyc_dismissed', 'true');
            };
            
            // Vérifier si déjà dismissed pendant cette session
            if (sessionStorage.getItem('kyc_dismissed') === 'true') {
                const banner = document.getElementById('kyc-banner');
                if (banner) banner.remove();
            }
            
        })();
        </script>
    @endif
@endif