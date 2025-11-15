{{-- Cancel Service Request Modal Component - Modern 2025/2026 Design --}}

<style>
    <script>
console.log('🟦 POPUP SCRIPT LOADED - VERSION 2');
</script>
    /* ===================================
       VARIABLES GLOBALES - COHÉRENTES AVEC LE DASHBOARD
       =================================== */
    :root {
        --modal-overlay-bg: rgba(15, 23, 42, 0.75);
        --modal-bg-primary: #ffffff;
        --modal-bg-secondary: #f8fafc;
        --modal-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --modal-border-radius: 1.5rem;
        --modal-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --modal-transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    /* ===================================
       MODAL OVERLAY - BACKDROP BLUR MODERNE
       =================================== */
    .cancel-modal-overlay {
        position: fixed;
        inset: 0;
        background: var(--modal-overlay-bg);
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .cancel-modal-overlay.show {
        display: flex;
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0;
            backdrop-filter: blur(0px);
        }
        to { 
            opacity: 1;
            backdrop-filter: blur(12px) saturate(180%);
        }
    }
    
    /* ===================================
       MODAL CONTENT - GLASSMORPHISM & MODERN SHADOW
       =================================== */
    .cancel-modal-content {
        background: linear-gradient(135deg, 
            rgba(255, 255, 255, 0.98) 0%, 
            rgba(248, 250, 252, 0.95) 100%);
        border-radius: var(--modal-border-radius);
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        width: 100%;
        max-width: 540px;
        max-height: 92vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        animation: slideUpBounce 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        border: 1px solid rgba(203, 213, 225, 0.3);
        -webkit-overflow-scrolling: touch;
    }
    
    @keyframes slideUpBounce {
        0% {
            opacity: 0;
            transform: translateY(60px) scale(0.92);
        }
        60% {
            transform: translateY(-8px) scale(1.02);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    /* ===================================
       MODAL HEADER - GRADIENT MODERNE
       =================================== */
    .cancel-modal-header {
        padding: 1.75rem 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-bottom: 2px solid #e2e8f0;
        position: relative;
        flex-shrink: 0;
    }
    
    .cancel-modal-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0f172a;
        text-align: center;
        padding-right: 3rem;
        line-height: 1.4;
        letter-spacing: -0.01em;
    }
    
    /* ===================================
       CLOSE BUTTON - MODERN INTERACTIVE
       =================================== */
    .cancel-modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: transparent;
        border: 2px solid transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: var(--modal-transition);
        font-size: 1.5rem;
        line-height: 1;
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
    }
    
    .cancel-modal-close:hover {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #0f172a;
        border-color: #cbd5e1;
        transform: rotate(90deg) scale(1.05);
    }
    
    .cancel-modal-close:focus {
        outline: none;
        background: #f1f5f9;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
    
    .cancel-modal-close:active {
        transform: rotate(90deg) scale(0.95);
    }
    
    /* ===================================
       MODAL BODY - SCROLLABLE CONTENT
       =================================== */
    .cancel-modal-body {
        padding: 1.75rem 1.5rem;
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }
    
    .cancel-modal-body::-webkit-scrollbar {
        width: 6px;
    }
    
    .cancel-modal-body::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .cancel-modal-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }
    
    .cancel-modal-body::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* ===================================
       FORM ELEMENTS - MODERN DESIGN
       =================================== */
    .cancel-form-group {
        margin-bottom: 1.5rem;
    }
    
    .cancel-form-group:last-child {
        margin-bottom: 0;
    }
    
    .cancel-form-label {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.625rem;
        letter-spacing: -0.01em;
    }
    
    .cancel-form-label .required-star {
        color: #ef4444;
        font-weight: 700;
    }
    
    /* SELECT - MODERN DROPDOWN */
    .cancel-form-select {
        width: 100%;
        padding: 0.875rem 1rem;
        padding-right: 3rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.875rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #0f172a;
        transition: var(--modal-transition);
        font-family: inherit;
        background: #ffffff;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%2364748b' d='M8 11L3 6h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px;
        min-height: 52px;
        touch-action: manipulation;
    }
    
    .cancel-form-select:hover {
        border-color: #cbd5e1;
        background-color: #f8fafc;
    }
    
    .cancel-form-select:focus {
        outline: none;
        border-color: #2563eb;
        background-color: #ffffff;
        box-shadow: 
            0 0 0 4px rgba(37, 99, 235, 0.1),
            0 4px 12px rgba(37, 99, 235, 0.08);
    }
    
    .cancel-form-select:disabled {
        background-color: #f1f5f9;
        color: #94a3b8;
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    /* TEXTAREA - MODERN DESIGN */
    .cancel-form-textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.875rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #0f172a;
        transition: var(--modal-transition);
        font-family: inherit;
        background: #ffffff;
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
        touch-action: manipulation;
    }
    
    .cancel-form-textarea::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    
    .cancel-form-textarea:hover {
        border-color: #cbd5e1;
        background-color: #f8fafc;
    }
    
    .cancel-form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        background-color: #ffffff;
        box-shadow: 
            0 0 0 4px rgba(37, 99, 235, 0.1),
            0 4px 12px rgba(37, 99, 235, 0.08);
    }
    
    .cancel-form-hint {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .cancel-form-hint i {
        font-size: 0.625rem;
        opacity: 0.8;
    }
    
    /* ===================================
       MODAL FOOTER - MODERN ACTIONS
       =================================== */
    .cancel-modal-footer {
        padding: 1.25rem 1.5rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-top: 2px solid #e2e8f0;
        display: flex;
        flex-direction: column-reverse;
        gap: 0.875rem;
        flex-shrink: 0;
    }
    
    /* ===================================
       BUTTONS - MODERN DESIGN SYSTEM
       =================================== */
    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        padding: 0.9375rem 1.5rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.875rem;
        letter-spacing: 0.01em;
        transition: var(--modal-transition-bounce);
        border: none;
        cursor: pointer;
        text-decoration: none;
        width: 100%;
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
        position: relative;
        overflow: hidden;
        min-height: 52px;
    }
    
    .cancel-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }
    
    .cancel-btn:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    }
    
    /* PRIMARY BUTTON - GRADIENT DANGER */
    .cancel-btn-primary {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 
            0 4px 14px rgba(239, 68, 68, 0.35),
            0 2px 4px rgba(239, 68, 68, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .cancel-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.3), 
            transparent);
        transition: left 0.6s ease;
    }
    
    .cancel-btn-primary:hover::before {
        left: 100%;
    }
    
    .cancel-btn-primary:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 
            0 8px 20px rgba(239, 68, 68, 0.4),
            0 4px 8px rgba(239, 68, 68, 0.25);
    }
    
    .cancel-btn-primary:active {
        transform: translateY(0) scale(0.98);
        box-shadow: 
            0 2px 8px rgba(239, 68, 68, 0.3),
            0 1px 2px rgba(239, 68, 68, 0.2);
    }
    
    /* SECONDARY BUTTON - OUTLINE */
    .cancel-btn-text {
        background: transparent;
        color: #64748b;
        border: 2px solid #e2e8f0;
        box-shadow: none;
    }
    
    .cancel-btn-text:hover {
        background: #f8fafc;
        color: #0f172a;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }
    
    .cancel-btn-text:active {
        transform: translateY(0);
        background: #f1f5f9;
    }
    
    /* ===================================
       SUCCESS MODAL - CELEBRATION DESIGN
       =================================== */
    .success-modal-content {
        text-align: center;
        padding: 2.5rem 2rem;
    }
    
    .success-icon-wrapper {
        width: 88px;
        height: 88px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.75rem;
        animation: successPulse 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 
            0 12px 32px rgba(16, 185, 129, 0.35),
            0 0 0 8px rgba(16, 185, 129, 0.08),
            inset 0 -4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    .success-icon-wrapper::before {
        content: '';
        position: absolute;
        inset: -12px;
        border: 2px solid #10b981;
        border-radius: 50%;
        opacity: 0;
        animation: successRipple 1s ease-out 0.3s;
    }
    
    @keyframes successPulse {
        0% { 
            transform: scale(0) rotate(0deg); 
            opacity: 0; 
        }
        50% { 
            transform: scale(1.15) rotate(180deg); 
        }
        100% { 
            transform: scale(1) rotate(360deg); 
            opacity: 1; 
        }
    }
    
    @keyframes successRipple {
        0% {
            transform: scale(1);
            opacity: 0.6;
        }
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }
    
    .success-icon {
        width: 3rem;
        height: 3rem;
        color: white;
        stroke-width: 3;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }
    
    .success-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.875rem;
        letter-spacing: -0.02em;
    }
    
    .success-text {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
        line-height: 1.6;
    }
    
    /* ===================================
       LOADING MODAL - SMOOTH SPINNER
       =================================== */
    .loading-modal-content {
        text-align: center;
        padding: 2.5rem 2rem;
    }
    
    .loading-spinner {
        width: 72px;
        height: 72px;
        border: 4px solid #e5e7eb;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1.75rem;
        position: relative;
    }
    
    .loading-spinner::after {
        content: '';
        position: absolute;
        inset: 8px;
        border: 4px solid transparent;
        border-top-color: #60a5fa;
        border-radius: 50%;
        animation: spin 1.2s linear infinite reverse;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .loading-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.625rem;
        letter-spacing: -0.01em;
    }
    
    .loading-text {
        font-size: 0.9375rem;
        color: #64748b;
        font-weight: 500;
        line-height: 1.6;
    }
    
    /* ===================================
       ERROR MESSAGE - MODERN ALERT
       =================================== */
    .cancel-error-message {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        border: 2px solid #fca5a5;
        border-radius: 0.875rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: none;
        animation: shakeError 0.5s ease;
    }
    
    @keyframes shakeError {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
        20%, 40%, 60%, 80% { transform: translateX(4px); }
    }
    
    .cancel-error-message.visible {
        display: block;
    }
    
    .cancel-error-text {
        color: #dc2626;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
        line-height: 1.5;
    }
    
    .cancel-error-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }
    
    /* ===================================
       ACCESSIBILITY - SCREEN READER
       =================================== */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
    
    /* ===================================
       RESPONSIVE - TABLET (640px+)
       =================================== */
    @media (min-width: 640px) {
        .cancel-modal-content {
            border-radius: 2rem;
            max-width: 560px;
        }
        
        .cancel-modal-header {
            padding: 2.25rem 2rem;
        }
        
        .cancel-modal-title {
            font-size: 1.375rem;
            padding-right: 3.5rem;
        }
        
        .cancel-modal-close {
            top: 1.75rem;
            right: 1.75rem;
            width: 44px;
            height: 44px;
            font-size: 1.75rem;
        }
        
        .cancel-modal-body {
            padding: 2.25rem 2rem;
        }
        
        .cancel-form-group {
            margin-bottom: 1.75rem;
        }
        
        .cancel-form-label {
            font-size: 0.9375rem;
        }
        
        .cancel-form-select,
        .cancel-form-textarea {
            padding: 1rem 1.25rem;
            font-size: 0.9375rem;
            border-radius: 1rem;
        }
        
        .cancel-form-select {
            padding-right: 3.5rem;
        }
        
        .cancel-form-textarea {
            min-height: 120px;
        }
        
        .cancel-form-hint {
            font-size: 0.8125rem;
        }
        
        .cancel-modal-footer {
            padding: 1.75rem 2rem;
            flex-direction: row;
            justify-content: space-between;
            gap: 1rem;
        }
        
        .cancel-btn {
            font-size: 0.9375rem;
            padding: 1rem 1.75rem;
            width: auto;
            flex: 1;
            min-height: 54px;
        }
        
        .cancel-btn-text {
            flex: 0 0 auto;
            min-width: 180px;
        }
        
        .success-modal-content,
        .loading-modal-content {
            padding: 3rem 2.5rem;
        }
        
        .success-icon-wrapper {
            width: 100px;
            height: 100px;
            margin-bottom: 2rem;
        }
        
        .success-icon {
            width: 3.5rem;
            height: 3.5rem;
        }
        
        .success-title {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }
        
        .success-text {
            font-size: 1.0625rem;
        }
        
        .loading-spinner {
            width: 80px;
            height: 80px;
            margin-bottom: 2rem;
        }
        
        .loading-title {
            font-size: 1.375rem;
        }
        
        .loading-text {
            font-size: 1.0625rem;
        }
    }
    
    /* ===================================
       RESPONSIVE - DESKTOP (1024px+)
       =================================== */
    @media (min-width: 1024px) {
        .cancel-modal-header {
            padding: 2.5rem 2.5rem;
        }
        
        .cancel-modal-body {
            padding: 2.5rem 2.5rem;
        }
        
        .cancel-modal-footer {
            padding: 2rem 2.5rem;
        }
        
        .success-modal-content,
        .loading-modal-content {
            padding: 3.5rem 3rem;
        }
        
        .success-icon-wrapper {
            width: 110px;
            height: 110px;
        }
        
        .success-icon {
            width: 4rem;
            height: 4rem;
        }
    }
    
    /* ===================================
       SAFE AREA SUPPORT - iOS NOTCH
       =================================== */
    @supports (padding: max(0px)) {
        .cancel-modal-content {
            padding-left: max(0px, env(safe-area-inset-left));
            padding-right: max(0px, env(safe-area-inset-right));
            padding-bottom: max(0px, env(safe-area-inset-bottom));
        }
    }
    
    /* ===================================
       DARK MODE SUPPORT
       =================================== */
    @media (prefers-color-scheme: dark) {
        .cancel-modal-content {
            background: linear-gradient(135deg, 
                rgba(30, 41, 59, 0.98) 0%, 
                rgba(15, 23, 42, 0.95) 100%);
            border-color: rgba(71, 85, 105, 0.3);
        }
        
        .cancel-modal-header,
        .cancel-modal-footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-color: #334155;
        }
        
        .cancel-modal-title,
        .cancel-form-label,
        .success-title,
        .loading-title {
            color: #f8fafc;
        }
        
        .cancel-form-select,
        .cancel-form-textarea {
            background: #1e293b;
            color: #f8fafc;
            border-color: #334155;
        }
        
        .cancel-form-select:hover,
        .cancel-form-textarea:hover {
            background: #0f172a;
            border-color: #475569;
        }
        
        .cancel-btn-text {
            color: #cbd5e1;
            border-color: #334155;
        }
        
        .cancel-btn-text:hover {
            background: #1e293b;
            color: #f8fafc;
            border-color: #475569;
        }
    }
    
    /* ===================================
       REDUCED MOTION ACCESSIBILITY
       =================================== */
    @media (prefers-reduced-motion: reduce) {
        .cancel-modal-overlay,
        .cancel-modal-content,
        .success-icon-wrapper,
        .success-icon-wrapper::before,
        .loading-spinner,
        .loading-spinner::after,
        .cancel-btn,
        .cancel-modal-close,
        .cancel-error-message,
        .cancel-btn-primary::before {
            animation: none !important;
            transition: none !important;
        }
        
        .cancel-modal-overlay.show {
            opacity: 1;
        }
    }
    
    /* ===================================
       PRINT OPTIMIZATION
       =================================== */
    @media print {
        .cancel-modal-overlay {
            display: none !important;
        }
    }
</style>

{{-- ===================================
     CANCEL REQUEST MODAL - MAIN
     =================================== --}}
<aside class="cancel-modal-overlay" 
       id="cancelRequestPopup" 
       role="dialog" 
       aria-labelledby="cancelModalTitle" 
       aria-modal="true">
    <div class="cancel-modal-content" role="document">
        
        {{-- HEADER --}}
        <div class="cancel-modal-header">
            <h2 class="cancel-modal-title" id="cancelModalTitle">
                Why do you want to cancel this ad?
            </h2>
            <button type="button" 
                    class="cancel-modal-close" 
                    onclick="closeCancelRequestPopup()" 
                    aria-label="Close modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        {{-- BODY WITH FORM --}}
        <form id="cancelRequestForm" class="cancel-modal-body">
            
            {{-- ERROR MESSAGE --}}
            <div id="cancelErrorMessage" 
                 class="cancel-error-message" 
                 role="alert" 
                 aria-live="assertive">
                <div class="cancel-error-text">
                    <svg class="cancel-error-icon" 
                         fill="currentColor" 
                         viewBox="0 0 20 20"
                         aria-hidden="true">
                        <path fill-rule="evenodd" 
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" 
                              clip-rule="evenodd"/>
                    </svg>
                    <span id="cancelErrorText"></span>
                </div>
            </div>
            
            {{-- REASON SELECT --}}
            <div class="cancel-form-group">
                <label for="cancelReasonSelect" class="cancel-form-label">
                    <span>Select a reason</span>
                    <span class="required-star" aria-label="required">*</span>
                </label>
                <select id="cancelReasonSelect" 
                        class="cancel-form-select" 
                        required 
                        aria-required="true">
                    <option value="">-- Please choose a reason --</option>
                    <option>I made a mistake in the information provided.</option>
                    <option>My situation has changed, I no longer need the service.</option>
                    <option>I found a solution elsewhere.</option>
                    <option>The timing is too short to organize this mission.</option>
                    <option>My budget is not sufficient for the type of service I need.</option>
                    <option>I didn't receive any relevant proposals.</option>
                    <option>The available providers do not match my criteria.</option>
                    <option>I've decided to postpone this request.</option>
                    <option>I submitted this request just to test the platform.</option>
                    <option value="other">Other reason (please specify below)</option>
                </select>
            </div>
            
            {{-- ADDITIONAL DETAILS --}}
            <div class="cancel-form-group">
                <label for="cancelOtherReason" class="cancel-form-label">
                    <span>Additional details (optional)</span>
                </label>
                <textarea id="cancelOtherReason" 
                          class="cancel-form-textarea" 
                          maxlength="300" 
                          placeholder="Help us understand your decision better..."
                          aria-describedby="cancelHint"></textarea>
                <p class="cancel-form-hint" id="cancelHint">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    <span>Maximum 300 characters</span>
                </p>
            </div>
            
        </form>
        
        {{-- FOOTER WITH ACTIONS --}}
        <div class="cancel-modal-footer">
            <button type="button" 
                    class="cancel-btn cancel-btn-text" 
                    onclick="closeCancelRequestPopup()"
                    aria-label="Keep request online">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                <span>Keep My Ad Online</span>
            </button>
            
 <button type="button" 
        onclick="submitCancelForm()"
        class="cancel-btn cancel-btn-primary"
        aria-label="Confirm cancellation">
    <i class="fas fa-times-circle" aria-hidden="true"></i>
    <span>CANCEL MY AD</span>
</button>
        </div>
        
    </div>
</aside>

{{-- ===================================
     SUCCESS MODAL
     =================================== --}}
<aside class="cancel-modal-overlay" 
       id="cancelSuccessPopup" 
       role="dialog" 
       aria-labelledby="successModalTitle" 
       aria-modal="true">
    <div class="cancel-modal-content" role="document">
        <div class="success-modal-content">
            
            {{-- SUCCESS ICON WITH ANIMATION --}}
            <div class="success-icon-wrapper" aria-hidden="true">
                <svg class="success-icon" 
                     fill="none" 
                     stroke="currentColor" 
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <h2 class="success-title" id="successModalTitle">
                Successfully Cancelled! 
            </h2>
            <p class="success-text">
                Your ad has been removed from the platform.<br>
                Redirecting you now...
            </p>
            
        </div>
    </div>
</aside>

{{-- ===================================
     LOADING MODAL
     =================================== --}}
<aside class="cancel-modal-overlay" 
       id="loadingPopup" 
       role="alert" 
       aria-live="assertive" 
       aria-busy="true">
    <div class="cancel-modal-content" role="document">
        <div class="loading-modal-content">
            
            {{-- LOADING SPINNER --}}
            <div class="loading-spinner" aria-hidden="true"></div>
            
            <h2 class="loading-title">Processing Cancellation...</h2>
            <p class="loading-text">
                Please wait while we remove your ad from the platform.
            </p>
            
        </div>
    </div>
</aside>

<script>
// ✅ DÉCLARATION GLOBALE (HORS DOMContentLoaded)
let currentMissionId = null;

document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    /**
     * Show error message with animation
     */
    function showErrorMessage(message) {
        const errorDiv = document.getElementById('cancelErrorMessage');
        const errorText = document.getElementById('cancelErrorText');
        
        if (errorDiv && errorText) {
            errorText.textContent = message;
            errorDiv.classList.add('visible');
            
            setTimeout(() => {
                errorDiv.classList.remove('visible');
            }, 5000);
        }
        
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        }
    }
    
    /**
     * Hide error message
     */
    function hideErrorMessage() {
        const errorDiv = document.getElementById('cancelErrorMessage');
        if (errorDiv) {
            errorDiv.classList.remove('visible');
        }
    }
    
    /**
     * Open cancel request popup
     */
    window.openCancelRequestPopup = function(missionId) {
        console.log('🟦 OPENING POPUP WITH MISSION ID:', missionId);
        currentMissionId = missionId;
        
        const popup = document.getElementById('cancelRequestPopup');
        
        if (!popup) {
            console.error('❌ Popup element not found');
            return;
        }
        
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        hideErrorMessage();
        
        setTimeout(() => {
            const firstInput = document.getElementById('cancelReasonSelect');
            if (firstInput) {
                firstInput.focus();
            }
        }, 150);
    };
    
    /**
     * Close cancel request popup
     */
    window.closeCancelRequestPopup = function() {
        const popup = document.getElementById('cancelRequestPopup');
        
        if (!popup) return;
        
        popup.classList.remove('show');
        document.body.style.overflow = '';
        currentMissionId = null;
        
        const form = document.getElementById('cancelRequestForm');
        if (form) {
            form.reset();
        }
        hideErrorMessage();
    };
    
    /**
     * Open success popup
     */
    window.openCancelSuccessPopup = function() {
        const popup = document.getElementById('cancelSuccessPopup');
        
        if (!popup) return;
        
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        setTimeout(function() {
            window.closeCancelSuccessPopup();
            window.location.reload();
        }, 3000);
    };
    
    /**
     * Close success popup
     */
    window.closeCancelSuccessPopup = function() {
        const popup = document.getElementById('cancelSuccessPopup');
        
        if (!popup) return;
        
        popup.classList.remove('show');
        document.body.style.overflow = '';
    };
    
    /**
     * Open loading popup
     */
    window.openLoadingPopup = function() {
        const popup = document.getElementById('loadingPopup');
        
        if (!popup) return;
        
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
    };
    
    /**
     * Close loading popup
     */
    window.closeLoadingPopup = function() {
        const popup = document.getElementById('loadingPopup');
        
        if (!popup) return;
        
        popup.classList.remove('show');
        document.body.style.overflow = '';
    };
    
    /**
     * Submit cancel form manually
     */
window.submitCancelForm = function() {
        console.log('🔴 SUBMITTING FORM - MISSION ID:', currentMissionId);
        
        const reasonSelect = document.getElementById('cancelReasonSelect');
        const otherReasonTextarea = document.getElementById('cancelOtherReason');
        
        if (!reasonSelect || !otherReasonTextarea) {
            console.error('❌ Form elements not found');
            return;
        }
        
        const reason = reasonSelect.value;
        const otherReason = otherReasonTextarea.value;
        
        // Validation
        if (!reason) {
            showErrorMessage('Please select a reason for canceling.');
            reasonSelect.focus();
            return;
        }
        
        if (reason === 'other' && !otherReason.trim()) {
            showErrorMessage('Please specify the other reason in the text field.');
            otherReasonTextarea.focus();
            return;
        }
        
        if (!currentMissionId) {
            console.error('❌ NO MISSION ID!');
            showErrorMessage('Error: Mission ID not found. Please try again.');
            return;
        }
        
        // ✅ SAUVEGARDER L'ID AVANT DE FERMER LE POPUP
        const missionIdToCancel = currentMissionId;
        
        // Close cancel popup and show loading
        window.closeCancelRequestPopup();
        window.openLoadingPopup();
        
        // Call API avec l'ID sauvegardé
        deleteMission(missionIdToCancel, reason, otherReason);
    };
    
    /**
     * Close modal when clicking on overlay
     */
    const cancelRequestPopup = document.getElementById('cancelRequestPopup');
    const cancelSuccessPopup = document.getElementById('cancelSuccessPopup');
    
    if (cancelRequestPopup) {
        cancelRequestPopup.addEventListener('click', function(e) {
            if (e.target === this) {
                window.closeCancelRequestPopup();
            }
        });
    }
    
    if (cancelSuccessPopup) {
        cancelSuccessPopup.addEventListener('click', function(e) {
            if (e.target === this) {
                window.closeCancelSuccessPopup();
            }
        });
    }
    
    /**
     * Close modals on Escape key
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (cancelRequestPopup && cancelRequestPopup.classList.contains('show')) {
                window.closeCancelRequestPopup();
            } else if (cancelSuccessPopup && cancelSuccessPopup.classList.contains('show')) {
                window.closeCancelSuccessPopup();
            }
        }
    });
    
    /**
     * API call to delete mission
     */
    async function deleteMission(missionId, reason, otherReason) {
        console.log('🚀 CALLING API WITH:', { missionId, reason, otherReason });
        
        try {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
            
            const payload = {
                mission_id: missionId,
                reason: reason,
                description: reason === 'other' ? otherReason : null,
                cancelled_by: 'requester',
                cancelled_on: new Date().toISOString()
            };
            
            console.log('📦 PAYLOAD:', payload);
            
            const response = await fetch('{{ route("api.cancel.mission.request") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });
            
            console.log('📨 RESPONSE STATUS:', response.status);
            
            const data = await response.json();
            console.log('📨 RESPONSE DATA:', data);
            
            if (response.ok) {
                currentMissionId = null;
                window.closeLoadingPopup();
                window.openCancelSuccessPopup();
            } else {
                throw new Error(data.error || 'Failed to cancel mission');
            }
            
        } catch (error) {
            console.error('💥 ERROR:', error);
            window.closeLoadingPopup();
            
            const errorMessage = error.message || 'An error occurred while canceling the mission. Please try again.';
            
            if (typeof toastr !== 'undefined') {
                toastr.error(errorMessage);
            }
            
            window.openCancelRequestPopup(missionId);
            showErrorMessage(errorMessage);
        }
    }
});
</script>