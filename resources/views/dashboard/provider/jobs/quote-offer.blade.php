@extends('dashboard.layouts.master')
@section('title', 'Quote Offer')

@section('content')
@php
  $images = json_decode($mission->attachments ?? '[]', true);
  $user = auth()->user();
  $provider = $user->serviceProvider;
  if($provider) {
    $providerKyc = $provider->kyc_status != 'verified' && $provider->stripe_account_id;
  }
@endphp

<!-- Alpine.js (add once in your layout if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-primary-dark: #1d4ed8;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-purple: #8b5cf6;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #94a3b8;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --color-bg-tertiary: #f1f5f9;
        --border-radius-sm: 0.75rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --border-radius-2xl: 2rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
        --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
    
    /* CONTAINER PRINCIPAL */
    .quote-offer-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.75rem;
        background: var(--color-bg-secondary);
        min-height: 100vh;
    }
    
    /* HEADER SECTION */
    .mission-header-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-xl);
        padding: 1rem;
        margin-bottom: 1.25rem;
        box-shadow: var(--shadow-sm);
        animation: slideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        will-change: transform, opacity;
        border: 2px solid #e0f2fe;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .mission-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e3a8a;
        margin: 0 0 0.875rem 0;
        line-height: 1.4;
        word-break: break-word;
    }
    
    .mission-description-box {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.875rem;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 2px solid #93c5fd;
        border-radius: var(--border-radius-md);
        margin-bottom: 0.875rem;
    }
    
    .mission-icon-2025 {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        border-radius: var(--border-radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    
    .mission-description-text {
        flex: 1;
        min-width: 0;
        color: #374151;
        font-size: 0.75rem;
        line-height: 1.6;
        word-break: break-word;
    }
    
    .mission-description-highlight {
        color: #1e40af;
        font-weight: 600;
        display: block;
        margin-top: 0.5rem;
    }
    
    /* CRITICAL: Prevent profile images from triggering any unwanted behavior */
    #public-messages-list img {
        pointer-events: none;
        user-select: none;
    }
    
    /* GALERIE D'IMAGES - RESPONSIVE GRID */
    .image-gallery-2025 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.625rem;
        margin-bottom: 1.25rem;
    }
    
    /* Ensure attachment images only respond to their specific modal */
    .gallery-item-2025 {
        position: relative;
        aspect-ratio: 4 / 3;
        border-radius: var(--border-radius-md);
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition-base);
        border: 2px solid #93c5fd;
        background: var(--color-bg-tertiary);
        will-change: transform;
    }
    
    .gallery-item-2025:hover,
    .gallery-item-2025:focus-within {
        transform: translateY(-2px) scale(1.02);
        border-color: var(--color-primary);
        box-shadow: var(--shadow-md);
    }
    
    .gallery-item-2025:active {
        transform: translateY(0) scale(0.98);
    }
    
    .gallery-item-2025 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        pointer-events: none;
        user-select: none;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
    
    /* IMAGE MODAL */
    .image-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .image-modal-overlay[style*="display: flex"] {
        opacity: 1;
        pointer-events: all;
    }
    
    .image-modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    .image-modal-content img {
        max-width: 100%;
        max-height: 90vh;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
    }
    
    .image-modal-close {
        position: absolute;
        top: -0.5rem;
        right: -0.5rem;
        width: 36px;
        height: 36px;
        background: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.25rem;
        color: var(--color-text-primary);
        box-shadow: var(--shadow-md);
        transition: var(--transition-base);
        z-index: 10;
    }
    
    .image-modal-close:hover,
    .image-modal-close:focus {
        background: #f3f4f6;
        transform: rotate(90deg) scale(1.1);
        outline: none;
    }
    
    /* APPLY BUTTON */
    .apply-button-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1.25rem;
    }
    
    .btn-apply-2025 {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.75rem 1.5rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        touch-action: manipulation;
    }
    
    .btn-apply-2025:hover,
    .btn-apply-2025:focus {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        outline: none;
    }
    
    .btn-apply-2025:active {
        transform: translateY(0);
    }
    
    .btn-apply-2025:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    /* MISSION INFO CARDS */
    .mission-info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.875rem;
        margin-bottom: 1.25rem;
    }
    
    .info-card-2025 {
        background: var(--color-bg-primary);
        border: 2px solid #e0f2fe;
        border-radius: var(--border-radius-md);
        padding: 0.875rem;
        box-shadow: var(--shadow-sm);
    }
    
    .info-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .info-item-row:last-child {
        border-bottom: none;
    }
    
    .info-label-2025 {
        color: var(--color-text-secondary);
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .info-value-2025 {
        color: var(--color-text-primary);
        font-size: 0.75rem;
        font-weight: 600;
        text-align: right;
    }
    
    /* SECTION DIVIDER */
    .section-divider-2025 {
        height: 2px;
        background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
        margin: 1.5rem 0;
    }
    
    /* MAIN CONTENT GRID */
    .content-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }
    
    /* SECTION HEADERS */
    .section-header-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        color: white;
        padding: 0.625rem 1.25rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(30, 58, 138, 0.25);
    }
    
    /* OFFERS SECTION */
    .offers-section-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        box-shadow: var(--shadow-sm);
        border: 2px solid #e0f2fe;
    }
    
    .offer-card-2025 {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        border: 2px solid #fde68a;
        border-radius: var(--border-radius-md);
        padding: 0.875rem;
        margin-bottom: 0.875rem;
        transition: var(--transition-base);
        animation: fadeInUp 0.4s ease;
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .offer-card-2025:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: #fbbf24;
    }
    
    .offer-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.625rem;
    }
    
    .provider-avatar {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fbbf24;
    }
    
    .provider-avatar-placeholder {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        border: 2px solid #fbbf24;
    }
    
    .provider-info {
        flex: 1;
        min-width: 0;
    }
    
    .provider-name {
        font-weight: 700;
        color: #78350f;
        font-size: 0.8125rem;
        margin-bottom: 0.25rem;
    }
    
    .provider-rating {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: #92400e;
        font-size: 0.75rem;
    }
    
    .offer-price {
        font-size: 0.9375rem;
        font-weight: 700;
        color: #78350f;
        white-space: nowrap;
    }
    
    .offer-details {
        margin-bottom: 0.625rem;
    }
    
    .offer-message {
        color: #78350f;
        font-size: 0.75rem;
        line-height: 1.6;
        margin-bottom: 0.5rem;
        word-break: break-word;
    }
    
    .offer-delivery {
        color: #92400e;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .btn-choose-provider {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #78350f;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.625rem 1rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.025em;
        box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
        width: 100%;
        touch-action: manipulation;
    }
    
    .btn-choose-provider:hover,
    .btn-choose-provider:focus {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        outline: none;
    }
    
    .btn-choose-provider:active {
        transform: translateY(0);
    }
    
    .empty-state-2025 {
        text-align: center;
        padding: 2rem 1.25rem;
        background: var(--color-bg-tertiary);
        border: 2px dashed #cbd5e1;
        border-radius: var(--border-radius-md);
        color: var(--color-text-tertiary);
    }
    
    .empty-icon {
        font-size: 2rem;
        margin-bottom: 0.875rem;
        opacity: 0.4;
    }
    
    .empty-text {
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* MESSAGES SECTION - HEIGHT RESPONSIVE */
    .messages-section-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        box-shadow: var(--shadow-sm);
        border: 2px solid #e0f2fe;
        display: flex;
        flex-direction: column;
        height: 400px;
    }
    
    .messages-list {
        flex: 1;
        overflow-y: auto;
        padding-right: 0.5rem;
        margin-bottom: 0.875rem;
        -webkit-overflow-scrolling: touch;
    }
    
    .messages-list::-webkit-scrollbar {
        width: 6px;
    }
    
    .messages-list::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 999px;
    }
    
    .messages-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }
    
    .messages-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .message-item {
        display: flex;
        gap: 0.625rem;
        margin-bottom: 1rem;
        animation: fadeInUp 0.3s ease;
    }
    
    .message-avatar {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e0f2fe;
    }
    
    .message-content {
        flex: 1;
        min-width: 0;
    }
    
    .message-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
        flex-wrap: wrap;
    }
    
    .message-author {
        font-weight: 700;
        color: var(--color-text-primary);
        font-size: 0.75rem;
    }
    
    .message-time {
        color: var(--color-text-tertiary);
        font-size: 0.6875rem;
    }
    
    .message-text {
        color: var(--color-text-secondary);
        font-size: 0.75rem;
        line-height: 1.6;
        word-break: break-word;
    }
    
    /* MESSAGE FORM */
    .message-form {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.875rem;
        border-top: 2px solid #f1f5f9;
    }
    
    .message-input {
        flex: 1;
        min-width: 0;
        padding: 0.625rem 0.875rem;
        border: 2px solid #e0f2fe;
        border-radius: 999px;
        font-size: 0.75rem;
        transition: var(--transition-base);
        font-family: inherit;
    }
    
    .message-input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .message-input::placeholder {
        color: var(--color-text-tertiary);
    }
    
    .btn-send-message {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.625rem 1.25rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        touch-action: manipulation;
    }
    
    .btn-send-message:hover,
    .btn-send-message:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        outline: none;
    }
    
    .btn-send-message:active {
        transform: translateY(0);
    }
    
    .message-error {
        color: var(--color-danger);
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: none;
    }
    
    .message-error.visible {
        display: block;
    }
    
    /* MODALS */
    .modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .modal-overlay-2025.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .modal-content-2025 {
        background: white;
        border-radius: var(--border-radius-xl);
        box-shadow: var(--shadow-xl);
        max-width: 32rem;
        width: 100%;
        padding: 1.5rem 1rem;
        position: relative;
        transform: scale(0.9);
        opacity: 0;
        transition: var(--transition-smooth);
        max-height: 90vh;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .modal-overlay-2025.active .modal-content-2025 {
        transform: scale(1);
        opacity: 1;
    }
    
    .modal-close-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 32px;
        height: 32px;
        background: #f3f4f6;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.125rem;
        color: var(--color-text-secondary);
        transition: var(--transition-base);
        z-index: 10;
    }
    
    .modal-close-btn:hover,
    .modal-close-btn:focus {
        background: #e5e7eb;
        color: var(--color-text-primary);
        transform: rotate(90deg);
        outline: none;
    }
    
    /* CONFIRM PROVIDER MODAL */
    .modal-header-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--color-primary);
        font-size: 1.75rem;
    }
    
    .modal-title-2025 {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #1e3a8a;
        text-align: center;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .modal-subtitle {
        text-align: center;
        color: var(--color-text-secondary);
        font-size: 0.8125rem;
        margin-bottom: 1.25rem;
        line-height: 1.6;
    }
    
    .provider-name-highlight {
        color: var(--color-primary);
        font-weight: 700;
    }
    
    .modal-features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.25rem 0;
    }
    
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
        padding: 0.625rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .feature-item:last-child {
        border-bottom: none;
    }
    
    .feature-icon {
        width: 20px;
        min-width: 20px;
        height: 20px;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.625rem;
        margin-top: 0.125rem;
    }
    
    .feature-text {
        flex: 1;
        font-size: 0.75rem;
        line-height: 1.6;
        color: var(--color-text-secondary);
    }
    
    .feature-highlight {
        font-weight: 700;
        color: var(--color-text-primary);
    }
    
    .modal-actions-2025 {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn-modal-primary {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.75rem 1.25rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        text-decoration: none;
        touch-action: manipulation;
    }
    
    .btn-modal-primary:hover,
    .btn-modal-primary:focus {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        outline: none;
    }
    
    .btn-modal-primary:active {
        transform: translateY(0);
    }
    
    .btn-modal-secondary {
        background: transparent;
        color: var(--color-danger);
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.625rem 1.25rem;
        border: 2px solid var(--color-danger);
        border-radius: 999px;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.025em;
        touch-action: manipulation;
    }
    
    .btn-modal-secondary:hover,
    .btn-modal-secondary:focus {
        background: var(--color-danger);
        color: white;
        outline: none;
    }
    
    /* OFFER MODAL */
    .modal-form-2025 {
        margin-top: 1rem;
    }
    
    .form-group-2025 {
        margin-bottom: 1rem;
    }
    
    .form-label-2025 {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
    }
    
    .form-input-2025,
    .form-textarea-2025 {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 2px solid #e0f2fe;
        border-radius: var(--border-radius-md);
        font-size: 0.75rem;
        font-family: inherit;
        transition: var(--transition-base);
    }
    
    .form-input-2025:focus,
    .form-textarea-2025:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-textarea-2025 {
        resize: vertical;
        min-height: 80px;
    }
    
    .form-error {
        color: var(--color-danger);
        font-size: 0.6875rem;
        margin-top: 0.5rem;
        display: none;
    }
    
    .form-error.visible {
        display: block;
    }
    
    /* SUCCESS MODAL */
    .modal-success-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        color: white;
        font-size: 2rem;
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .modal-success-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e3a8a;
        text-align: center;
        margin-bottom: 0.625rem;
    }
    
    .modal-success-subtitle {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #1e40af;
        text-align: center;
        margin-bottom: 0.875rem;
    }
    
    .modal-success-text {
        color: var(--color-text-secondary);
        font-size: 0.75rem;
        text-align: center;
        line-height: 1.6;
    }
    
    /* SCREEN READER ONLY */
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
    
    /* RESPONSIVE - SMALL TABLET (640px) */
    @media (min-width: 640px) {
        .quote-offer-container-2025 {
            padding: 1.25rem;
        }
        
        .mission-header-2025 {
            padding: 1.5rem;
            border-radius: var(--border-radius-2xl);
        }
        
        .mission-title-2025 {
            font-size: 1.375rem;
        }
        
        .mission-description-box {
            padding: 1.25rem;
            border-radius: var(--border-radius-lg);
        }
        
        .mission-icon-2025 {
            width: 56px;
            height: 56px;
            min-width: 56px;
            font-size: 1.5rem;
        }
        
        .mission-description-text {
            font-size: 0.875rem;
        }
        
        /* GRID 3 COLONNES SUR TABLET */
        .image-gallery-2025 {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.875rem;
        }
        
        .gallery-item-2025 {
            border-radius: var(--border-radius-lg);
        }
        
        .btn-apply-2025 {
            font-size: 0.9375rem;
            padding: 0.875rem 2rem;
            gap: 0.625rem;
        }
        
        .mission-info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .info-card-2025 {
            padding: 1rem;
        }
        
        .info-label-2025,
        .info-value-2025 {
            font-size: 0.8125rem;
        }
        
        .section-divider-2025 {
            margin: 2rem 0;
        }
        
        .content-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .section-header-2025 {
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.25rem;
        }
        
        .offers-section-2025,
        .messages-section-2025 {
            padding: 1.5rem;
            border-radius: var(--border-radius-xl);
        }
        
        /* HEIGHT RESPONSIVE POUR MESSAGES */
        .messages-section-2025 {
            height: 600px;
        }
        
        .offer-card-2025 {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .provider-avatar,
        .provider-avatar-placeholder {
            width: 48px;
            height: 48px;
            min-width: 48px;
        }
        
        .provider-name {
            font-size: 0.9375rem;
        }
        
        .provider-rating {
            font-size: 0.8125rem;
        }
        
        .offer-price {
            font-size: 1.125rem;
        }
        
        .offer-message {
            font-size: 0.8125rem;
        }
        
        .offer-delivery {
            font-size: 0.8125rem;
        }
        
        .btn-choose-provider {
            font-size: 0.8125rem;
            padding: 0.625rem 1.25rem;
        }
        
        .empty-state-2025 {
            padding: 2.5rem 1.5rem;
        }
        
        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .empty-text {
            font-size: 0.875rem;
        }
        
        .message-item {
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        
        .message-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
        }
        
        .message-author {
            font-size: 0.875rem;
        }
        
        .message-time {
            font-size: 0.75rem;
        }
        
        .message-text {
            font-size: 0.8125rem;
        }
        
        .message-form {
            padding-top: 1rem;
        }
        
        .message-input {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        
        .btn-send-message {
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
        }
        
        .message-error {
            font-size: 0.8125rem;
        }
        
        .modal-content-2025 {
            padding: 2rem 1.5rem;
            border-radius: var(--border-radius-2xl);
        }
        
        .modal-close-btn {
            top: 0.75rem;
            right: 0.75rem;
            width: 36px;
            height: 36px;
            font-size: 1.25rem;
        }
        
        .modal-header-icon {
            width: 64px;
            height: 64px;
            margin-bottom: 1.25rem;
            font-size: 2rem;
        }
        
        .modal-title-2025 {
            font-size: 1.25rem;
        }
        
        .modal-subtitle {
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
        }
        
        .feature-item {
            gap: 0.75rem;
            padding: 0.75rem 0;
        }
        
        .feature-icon {
            width: 24px;
            min-width: 24px;
            height: 24px;
            font-size: 0.75rem;
        }
        
        .feature-text {
            font-size: 0.875rem;
        }
        
        .modal-actions-2025 {
            flex-direction: row;
        }
        
        .btn-modal-primary {
            font-size: 0.9375rem;
            padding: 0.875rem 1.5rem;
        }
        
        .btn-modal-secondary {
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
        }
        
        .form-label-2025 {
            font-size: 0.875rem;
        }
        
        .form-input-2025,
        .form-textarea-2025 {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        
        .form-textarea-2025 {
            min-height: 100px;
        }
        
        .form-error {
            font-size: 0.8125rem;
        }
        
        .modal-success-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }
        
        .modal-success-title {
            font-size: 1.375rem;
            margin-bottom: 0.75rem;
        }
        
        .modal-success-subtitle {
            font-size: 0.9375rem;
            margin-bottom: 1rem;
        }
        
        .modal-success-text {
            font-size: 0.875rem;
        }
    }
    
    /* RESPONSIVE - DESKTOP (1024px) */
    @media (min-width: 1024px) {
        .quote-offer-container-2025 {
            padding: 2rem;
        }
        
        .mission-header-2025 {
            padding: 2rem;
        }
        
        .mission-title-2025 {
            font-size: 1.5rem;
        }
        
        /* GRID 4 COLONNES SUR DESKTOP */
        .image-gallery-2025 {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
        
        .offers-section-2025,
        .messages-section-2025 {
            padding: 1.75rem;
        }
    }
    
    /* FOCUS VISIBLE */
    .btn-apply-2025:focus-visible,
    .btn-choose-provider:focus-visible,
    .btn-send-message:focus-visible,
    .gallery-item-2025:focus-visible,
    .modal-close-btn:focus-visible,
    .btn-modal-primary:focus-visible,
    .btn-modal-secondary:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 2px;
    }
    
    /* REDUCED MOTION */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
    
    /* OPTIMISATIONS */
    @supports (content-visibility: auto) {
        .offer-card-2025,
        .message-item {
            content-visibility: auto;
        }
    }
</style>

<div class="quote-offer-container-2025">
    
    <!-- Mission Header -->
    <section class="mission-header-2025" aria-labelledby="mission-title">
        <h1 id="mission-title" class="mission-title-2025">{{ $mission->title ?? 'Service Request' }}</h1>
        
        <div class="mission-description-box">
            <div class="mission-icon-2025" aria-hidden="true">
                <i class="fas fa-home"></i>
            </div>
            <div class="mission-description-text">
                {{ $mission->description ?? 'No description provided.' }}
                <span class="mission-description-highlight">Details of the service request</span>
            </div>
        </div>
        
        <!-- Image Gallery -->
        <div class="image-gallery-2025"
             x-data="{
                open: false,
                image: '',
                openModal(img) {
                    this.image = img;
                    this.open = true;
                },
                closeModal() {
                    this.open = false;
                }
             }">
            @if($images && count($images) > 0)
                @foreach($images as $img)
                    <div class="gallery-item-2025"
                         @click="openModal('{{ asset($img) }}')"
                         role="button"
                         tabindex="0"
                         @keydown.enter="openModal('{{ asset($img) }}')"
                         @keydown.space.prevent="openModal('{{ asset($img) }}')"
                         aria-label="View attachment image">
                        <img src="{{ asset($img) }}"
                             alt="Mission attachment"
                             loading="lazy"
                             decoding="async" />
                    </div>
                @endforeach
            @endif
            
            <!-- Image Modal -->
            <div class="image-modal-overlay"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 style="display: none;"
                 role="dialog"
                 aria-modal="true"
                 aria-label="Image preview">
                <div class="image-modal-content" @click.stop>
                    <button class="image-modal-close"
                            @click="closeModal()"
                            aria-label="Close image preview">
                        ✕
                    </button>
                    <img :src="image"
                         alt="Full size attachment"
                         class="modal-image" />
                </div>
            </div>
        </div>
        
        <!-- Apply Button -->
        <div class="apply-button-wrapper">
            @if(auth()->check() && $mission && $mission->requester_id != auth()->id())
                <button onclick="checkKycAndOpenOffer()"
                        class="btn-apply-2025"
                        aria-label="Apply for this service request">
                    <i class="fas fa-paper-plane" aria-hidden="true"></i>
                    <span>I APPLY</span>
                </button>
            @endif
        </div>
        
        <script>
            function checkKycAndOpenOffer() {
                @if(!$provider || ($provider && ($provider->kyc_status != 'verified' || !$provider->stripe_account_id)))
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Please complete KYC verification to apply for missions');
                    }
                @else
                    const modal = document.getElementById('offerPopupModal');
                    if (modal) {
                        modal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                @endif
            }
        </script>
        
        @php
            if($mission->service_durition === '1 week') {
                $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
            } elseif($mission->service_durition === '2 weeks') {
                $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
            } elseif($mission->service_durition === '1 month') {
                $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
            } elseif($mission->service_durition === '3 months') {
                $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
            } else {
                $endTime = null;
            }
            if ($endTime) {
                $remainingDays = $endTime->diffInDays(\Carbon\Carbon::now());
            } else {
                $remainingDays = 'N/A';
            }
        @endphp
        
        <!-- Mission Info Grid -->
        <div class="mission-info-grid">
            <div class="info-card-2025">
                <div class="info-item-row">
                    <span class="info-label-2025">Duration:</span>
                    <span class="info-value-2025">{{ $mission->service_durition ?? '-' }}</span>
                </div>
                <div class="info-item-row">
                    <span class="info-label-2025">Ends In:</span>
                    <span class="info-value-2025">{{ $remainingDays }} Days</span>
                </div>
                <div class="info-item-row">
                    <span class="info-label-2025">Country:</span>
                    <span class="info-value-2025">{{ $mission->location_country ?? '-' }}</span>
                </div>
            </div>
            
            <div class="info-card-2025">
                <div class="info-item-row">
                    <span class="info-label-2025">City:</span>
                    <span class="info-value-2025">{{ $mission->location_city ?? '-' }}</span>
                </div>
                <div class="info-item-row">
                    <span class="info-label-2025">Language:</span>
                    <span class="info-value-2025">{{ $mission->language ?? '-' }}</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section Divider -->
    <div class="section-divider-2025" aria-hidden="true"></div>
    
    <!-- Main Content Grid -->
    <div class="content-grid-2025">
        
        <!-- OFFERS RECEIVED -->
        <section class="offers-section-2025" aria-labelledby="offers-heading">
            <h2 class="section-header-2025" id="offers-heading">
                <i class="fas fa-file-invoice" aria-hidden="true"></i>
                <span>Offers Received</span>
            </h2>
            
            @forelse($offers as $offer)
                <article class="offer-card-2025" aria-label="Offer from {{ $offer->provider->first_name ?? 'Provider' }}">
                    <div class="offer-header">
                        @if($offer->provider && $offer->provider->profile_photo)
                            <img src="{{ asset($offer->provider->profile_photo) }}"
                                 alt="{{ $offer->provider->first_name ?? 'Provider' }}"
                                 class="provider-avatar" />
                        @else
                            <div class="provider-avatar-placeholder" aria-hidden="true">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        
                        <div class="provider-info">
                            <div class="provider-name">{{ $offer->provider->first_name ?? 'Provider' }}</div>
                            <div class="provider-rating">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <span>{{ $offer->provider->rating ?? '5.00' }}</span>
                            </div>
                        </div>
                        
                        <div class="offer-price" aria-label="Offer price: {{ $offer->price ?? '-' }} euros">
                            {{ $offer->price ?? '-' }} €
                        </div>
                    </div>
                    
                    <div class="offer-details">
                        <p class="offer-message">{{ $offer->message ?? 'No message.' }}</p>
                        <p class="offer-delivery">
                            <i class="fas fa-clock" aria-hidden="true"></i>
                            Delivery time: {{ $offer->delivery_time ?? '-' }}
                        </p>
                    </div>
                    
                    @if(auth()->check() && $mission && $mission->requester_id == auth()->id())
                        <button type="button"
                                onclick="chooseProvider({{ $offer->provider->id }}, {{ $mission->id }}, '{{ $offer->provider->first_name }}')"
                                class="btn-choose-provider"
                                aria-label="Choose {{ $offer->provider->first_name ?? 'provider' }}">
                            I choose {{ $offer->provider->first_name ?? 'provider' }}
                        </button>
                    @endif
                </article>
            @empty
                <div class="empty-state-2025" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <div class="empty-text">No offers received yet.</div>
                </div>
            @endforelse
        </section>
        
<!-- PUBLIC MESSAGES -->
@if(is_null($mission->selected_provider_id))
    {{-- ✅ MESSAGERIE PUBLIQUE OUVERTE --}}
    <section class="messages-section-2025" aria-labelledby="messages-heading">
        <h2 class="section-header-2025" id="messages-heading">
            <i class="fas fa-comments" aria-hidden="true"></i>
            <span>Public Messages</span>
        </h2>
        
        <div id="public-messages-list"
             class="messages-list"
             role="log"
             aria-live="polite"
             aria-label="Public conversation messages">
            <!-- Messages will be loaded here -->
        </div>
        
        <form id="publicMessageForm" class="message-form" aria-label="Send public message">
            <input type="text"
                   name="message"
                   id="publicMessageInput"
                   placeholder="Type your public message..."
                   class="message-input"
                   maxlength="500"
                   aria-label="Message text"
                   required />
            <button type="submit"
                    class="btn-send-message"
                    aria-label="Send message">
                Send
            </button>
        </form>
        <div id="public-message-error" class="message-error" role="alert" aria-live="assertive"></div>
    </section>
@else
    {{-- ❌ MESSAGERIE PUBLIQUE FERMÉE --}}
    <section class="messages-section-2025" aria-labelledby="messages-heading">
        <h2 class="section-header-2025" id="messages-heading">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <span>Public Messages</span>
        </h2>
        
        <div style="text-align: center; padding: 3rem 1.5rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border: 2px solid #fbbf24; border-radius: 1rem;">
            <div style="font-size: 3rem; color: #92400e; margin-bottom: 1rem; opacity: 0.6;">
                <i class="fas fa-lock"></i>
            </div>
            <h3 style="font-size: 1.125rem; font-weight: 700; color: #78350f; margin-bottom: 0.75rem;">
                Public Messaging Closed
            </h3>
            <p style="font-size: 0.875rem; color: #92400e; line-height: 1.6; margin-bottom: 1.25rem;">
                This mission now has a selected provider.<br>
                Public messaging is no longer available.
            </p>
            <a href="{{ route('user.conversation') }}" 
               style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 999px; font-weight: 700; font-size: 0.875rem; text-decoration: none; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: all 0.2s;">
                <i class="fas fa-comments"></i>
                <span>Use Private Messaging</span>
            </a>
        </div>
    </section>
@endif
        
    </div>
    
</div>

<!-- Confirmation Popup Modal -->
<div id="confirmProviderModal"
     class="modal-overlay-2025"
     role="dialog"
     aria-modal="true"
     aria-labelledby="confirm-modal-title"
     aria-hidden="true">
    <div class="modal-content-2025">
        <button onclick="closeConfirmProviderModal()"
                class="modal-close-btn"
                aria-label="Close modal">
            &times;
        </button>
        
        <div class="modal-header-icon" aria-hidden="true">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h2 class="modal-title-2025" id="confirm-modal-title">
            You're almost there! 🎯
        </h2>
        
        <p class="modal-subtitle">
            You're about to work with <span id="provider-name" class="provider-name-highlight"></span>.<br>
            Here's what happens next:
        </p>
        
        <ul class="modal-features-list">
            <li class="feature-item">
                <div class="feature-icon" aria-hidden="true">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">Your payment is protected</span> — it's securely held by Stripe and will only be released to the provider once the job is completed.
                </div>
            </li>
            <li class="feature-item">
                <div class="feature-icon" aria-hidden="true">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">You'll unlock chat</span> with the provider right after confirming your request.
                </div>
            </li>
            <li class="feature-item">
                <div class="feature-icon" aria-hidden="true">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">We're here to help</span> all along your service request — if anything goes wrong, just reach out!
                </div>
            </li>
        </ul>
        
        <div class="modal-actions-2025">
            <a href="#"
               id="pay-provider"
               class="btn-modal-primary"
               aria-label="Confirm and proceed to payment">
                <i class="fas fa-check" aria-hidden="true"></i>
                <span>Confirm & Pay</span>
            </a>
            <button id="chooseAnotherProviderBtn"
                    type="button"
                    class="btn-modal-secondary"
                    onclick="closeConfirmProviderModal()"
                    aria-label="Go back and choose another provider">
                &larr; Choose another provider
            </button>
        </div>
    </div>
</div>

<!-- Offer Popup Modal -->
<div id="offerPopupModal"
     class="modal-overlay-2025"
     role="dialog"
     aria-modal="true"
     aria-labelledby="offer-modal-title"
     aria-hidden="true">
    <div class="modal-content-2025">
        <button id="closeOfferPopupBtn"
                class="modal-close-btn"
                aria-label="Close modal">
            &times;
        </button>
        
        <h2 class="modal-title-2025" id="offer-modal-title">Send your offer</h2>
        
        <form id="offerForm" class="modal-form-2025" aria-label="Submit offer form">
            <div class="form-group-2025">
                <label for="offerPrice" class="form-label-2025">Your proposed price (€)</label>
                <input type="number"
                       id="offerPrice"
                       name="price"
                       class="form-input-2025"
                       placeholder="e.g. 50"
                       min="1"
                       step="0.01"
                       required
                       aria-required="true" />
            </div>
            
            <div class="form-group-2025">
                <label for="offerDelivery" class="form-label-2025">Estimated delivery time (in days)</label>
                <input type="text"
                       id="offerDelivery"
                       name="delivery_time"
                       class="form-input-2025"
                       placeholder="e.g. 2 days"
                       maxlength="50"
                       required
                       aria-required="true" />
            </div>
            
            <div class="form-group-2025">
                <label for="offerMessage" class="form-label-2025">A short message (max 300 characters)</label>
                <textarea id="offerMessage"
                          name="message"
                          class="form-textarea-2025"
                          maxlength="300"
                          placeholder="I'm available and ready to help!"
                          required
                          aria-required="true"></textarea>
            </div>
            
            <div id="offer-error" class="form-error" role="alert" aria-live="assertive"></div>
            
            <button type="submit" class="btn-modal-primary" aria-label="Submit your offer">
                <i class="fas fa-paper-plane" aria-hidden="true"></i>
                <span>I'm sending my offer</span>
            </button>
        </form>
    </div>
</div>

<!-- Offer Sent Confirmation Popup -->
<div id="offerSentPopup"
     class="modal-overlay-2025"
     role="dialog"
     aria-modal="true"
     aria-labelledby="offer-sent-title"
     aria-hidden="true">
    <div class="modal-content-2025">
        <button id="closeOfferSentPopupBtn"
                class="modal-close-btn"
                aria-label="Close modal">
            &times;
        </button>
        
        <div class="modal-success-icon" aria-hidden="true">
            <i class="fas fa-check"></i>
        </div>
        
        <h2 class="modal-success-title" id="offer-sent-title">Thank You!</h2>
        
        <div class="modal-success-subtitle">Your request has been sent to the requester</div>
        
        <p class="modal-success-text">
            You will be informed if your application is accepted via your personal messaging and by email.
        </p>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // MODAL MANAGEMENT
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            // Focus trap
            setTimeout(() => {
                const firstFocusable = modal.querySelector('button, input, textarea, select, a');
                if (firstFocusable) firstFocusable.focus();
            }, 100);
        }
    }
    
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
    
    function closeConfirmProviderModal() {
        closeModal('confirmProviderModal');
    }
    
    // CHOOSE PROVIDER
    function chooseProvider(providerId, missionId, providerName) {
        const modal = document.getElementById('confirmProviderModal');
        if (modal) {
            const nameElement = document.getElementById('provider-name');
            if (nameElement) {
                nameElement.textContent = providerName;
            }
            
            const payLink = document.getElementById('pay-provider');
            if (payLink) {
                const baseUrl = '{{ route("user.payments") }}';
                payLink.href = `${baseUrl}?id=${providerId}&mission_id=${missionId}`;
            }
            
            openModal('confirmProviderModal');
        }
    }
    
    // PUBLIC MESSAGING
    function renderPublicMessages(messages) {
        const list = document.getElementById('public-messages-list');
        if (!list) return;
        
        list.innerHTML = '';
        
        if (!messages || messages.length === 0) {
            list.innerHTML = '<div class="empty-state-2025"><div class="empty-icon"><i class="fas fa-comments"></i></div><div class="empty-text">No messages yet. Start the conversation!</div></div>';
            return;
        }
        
        messages.forEach(msg => {
            const profileImage = msg.user.profile_photo
                ? '{{ asset("") }}' + msg.user.profile_photo
                : '{{ asset("images/helpexpat.png") }}';
            
            const messageHTML = `
                <div class="message-item">
                    <img src="${profileImage}"
                         alt="${msg.user.name}"
                         class="message-avatar" />
                    <div class="message-content">
                        <div class="message-header">
                            <span class="message-author">${msg.user.name}</span>
                            <span class="message-time">${msg.created_at}</span>
                        </div>
                        <div class="message-text">${msg.message}</div>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('beforeend', messageHTML);
        });
        
        // Scroll to bottom
        list.scrollTop = list.scrollHeight;
    }
    
    function loadPublicMessages() {
        fetch("{{ route('mission.public-messages', $mission->id) }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    renderPublicMessages(data.messages);
                }
            })
            .catch(err => {
                console.error('Error loading messages:', err);
            });
    }
    
    function sanitizeMessage(msg) {
        let out = msg;
        
        // Gmail → first letter + @gmail.com
        out = out.replace(/\b([A-Za-z0-9._%+-])[A-Za-z0-9._%+-]*@gmail\.com\b/gi, '$1@gmail.com');
        
        // URLs with protocol → www.....com
        out = out.replace(/\bhttps?:\/\/[^\s)]+/gi, 'www.....com');
        
        // URLs starting with www. → www.....com
        out = out.replace(/\bwww\.[A-Za-z0-9-]+(?:\.[A-Za-z]{2,24})(?:\/[^\s)]*)?\b/gi, 'www.....com');
        
        // Bare domains → www.....com
        try {
            out = out.replace(
                /(?<!@)\b[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi,
                'www.....com'
            );
        } catch (e) {
            // Fallback
            out = out.replace(
                /\b(?![A-Za-z0-9._%+-]+@)[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi,
                'www.....com'
            );
        }
        
        // Phone numbers → [phone]
        out = out.replace(/\+?\d[\d\s\-().]{7,}\d\b/g, '[phone]');
        
        // Cleanup spaces
        out = out.replace(/\s{2,}/g, ' ').trim();
        
        return out;
    }
    
    // MODAL EVENT LISTENERS
    document.addEventListener('DOMContentLoaded', function() {
        // Close buttons
        const closeConfirmBtn = document.getElementById('closeConfirmProviderModal');
        if (closeConfirmBtn) {
            closeConfirmBtn.addEventListener('click', closeConfirmProviderModal);
        }
        
        const chooseAnotherBtn = document.getElementById('chooseAnotherProviderBtn');
        if (chooseAnotherBtn) {
            chooseAnotherBtn.addEventListener('click', closeConfirmProviderModal);
        }
        
        const closeOfferBtn = document.getElementById('closeOfferPopupBtn');
        if (closeOfferBtn) {
            closeOfferBtn.addEventListener('click', () => closeModal('offerPopupModal'));
        }
        
        const closeOfferSentBtn = document.getElementById('closeOfferSentPopupBtn');
        if (closeOfferSentBtn) {
            closeOfferSentBtn.addEventListener('click', () => closeModal('offerSentPopup'));
        }
        
        // Click outside to close
        const modals = ['confirmProviderModal', 'offerPopupModal', 'offerSentPopup'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal(modalId);
                    }
                });
            }
        });
        
        // Escape key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                modals.forEach(modalId => closeModal(modalId));
            }
        });
        
        // OFFER FORM SUBMISSION
        const offerForm = document.getElementById('offerForm');
        if (offerForm) {
            offerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const errorDiv = document.getElementById('offer-error');
                if (errorDiv) {
                    errorDiv.classList.remove('visible');
                }
                
                const formData = new FormData(offerForm);
                
                fetch("{{ route('mission.offer', $mission->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async res => {
                    const json = await res.json();
                    if (json.status === 'success') {
                        closeModal('offerPopupModal');
                        openModal('offerSentPopup');
                        offerForm.reset();
                    } else {
                        if (errorDiv) {
                            errorDiv.textContent = json.message || 'Failed to submit offer.';
                            errorDiv.classList.add('visible');
                        }
                    }
                })
                .catch(() => {
                    if (errorDiv) {
                        errorDiv.textContent = 'Failed to submit offer. Please try again.';
                        errorDiv.classList.add('visible');
                    }
                });
            });
        }
        
        // PUBLIC MESSAGE FORM
        loadPublicMessages();
        
        const publicMessageForm = document.getElementById('publicMessageForm');
        const publicMessageInput = document.getElementById('publicMessageInput');
        const publicMessageError = document.getElementById('public-message-error');
        
        if (publicMessageForm && publicMessageInput) {
            publicMessageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (publicMessageError) {
                    publicMessageError.classList.remove('visible');
                }
                
                const raw = publicMessageInput.value.trim();
                if (!raw) return;
                
                let msg = sanitizeMessage(raw);
                if (!msg) msg = '[redacted]';
                
                fetch("{{ route('mission.public-message', $mission->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: msg })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        publicMessageInput.value = '';
                        loadPublicMessages();
                    } else {
                        if (publicMessageError) {
                            publicMessageError.textContent = data.message || 'Failed to send message.';
                            publicMessageError.classList.add('visible');
                        }
                    }
                })
                .catch(() => {
                    if (publicMessageError) {
                        publicMessageError.textContent = 'Failed to send message.';
                        publicMessageError.classList.add('visible');
                    }
                });
            });
        }
    });
    
    // EXPOSE GLOBAL FUNCTIONS
    window.chooseProvider = chooseProvider;
    window.closeConfirmProviderModal = closeConfirmProviderModal;
    
})();
</script>

@endsection