@extends('dashboard.layouts.master')
@section('title', 'Service Request Details')

@section('content')

@php
    $images = json_decode($mission->attachments ?? '[]', true);
    $user = auth()->user();
    
    // Calculate remaining days
    $remainingDays = 'N/A';
    $durationMap = [
        '1 week' => 7,
        '2 weeks' => 14,
        '1 month' => 30,
        '3 months' => 90,
    ];
    
    $serviceDuration = $mission->service_duration ?? $mission->service_durition;
    if (isset($durationMap[$serviceDuration])) {
        $totalDays = $durationMap[$serviceDuration];
        $createdAt = \Carbon\Carbon::parse($mission->created_at);
        $now = \Carbon\Carbon::now();
        $daysPassed = $createdAt->diffInDays($now);
        $remainingDays = max(0, $totalDays - $daysPassed);
    }
@endphp

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    /* ============================================
       MOBILE-FIRST RESPONSIVE DESIGN - IDENTICAL TO PROVIDER VIEW
       Breakpoints: 
       - Base: 320px+ (mobile)
       - SM: 640px+ (large mobile)
       - MD: 768px+ (tablet)
       - LG: 1024px+ (desktop)
       - XL: 1280px+ (large desktop)
    ============================================ */
    
    :root {
        --primary-blue: #007AFF;
        --primary-blue-light: #5AC8FA;
        --secondary-gray: #E5E5EA;
        --text-primary: #000000;
        --text-secondary: #3C3C43;
        --text-tertiary: #8E8E93;
        --bg-primary: #FFFFFF;
        --bg-secondary: #F2F2F7;
        --bg-tertiary: #E5E5EA;
        --success-green: #34C759;
        --danger-red: #FF3B30;
        --warning-yellow: #FFCC00;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 24px rgba(0, 0, 0, 0.15);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background: #E8E8ED;
    }
    
    /* ============================================
       CONTAINER - MOBILE FIRST
    ============================================ */
    .request-details-container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        padding: 0.5rem;
        padding-bottom: 2rem;
    }
    
    @media (min-width: 640px) {
        .request-details-container {
            padding: 1rem;
            padding-bottom: 2.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .request-details-container {
            max-width: 1400px;
            padding: 2rem;
            padding-bottom: 3rem;
        }
    }
    
    /* ============================================
       OWNER INFO BANNER - DESKTOP ONLY
    ============================================ */
    .owner-info-banner {
        display: none;
        background: linear-gradient(135deg, #34C759, #30D158);
        color: white;
        padding: 0.75rem 1rem;
        border-radius: var(--radius-md);
        align-items: center;
        gap: 0.625rem;
        margin-bottom: 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 1024px) {
        .owner-info-banner {
            display: flex;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
    }
    
    .owner-info-banner i {
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    @media (min-width: 1024px) {
        .owner-info-banner i {
            font-size: 1.125rem;
        }
    }
    
    /* ============================================
       REQUEST CARD - MOBILE FIRST
    ============================================ */
    .request-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }
    
    @media (min-width: 768px) {
        .request-card {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }
    }
    
    @media (min-width: 1024px) {
        .request-card {
            padding: 2rem;
            border-radius: var(--radius-xl);
        }
    }
    
    /* ============================================
       CATEGORY BADGE - MOBILE FIRST
    ============================================ */
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        border-radius: var(--radius-full);
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 768px) {
        .category-badge {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
    }
    
    /* ============================================
       TITLE - MOBILE FIRST
    ============================================ */
    .request-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 0.75rem 0;
        line-height: 1.3;
        letter-spacing: -0.3px;
    }
    
    @media (min-width: 640px) {
        .request-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .request-title {
            font-size: 2rem;
            letter-spacing: -0.5px;
        }
    }
    
    /* ============================================
       DESCRIPTION - MOBILE FIRST
    ============================================ */
    .request-description {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    @media (min-width: 768px) {
        .request-description {
            font-size: 0.9375rem;
            margin-bottom: 1.25rem;
        }
    }
    
    /* ============================================
       IMAGE GALLERY - MOBILE FIRST
    ============================================ */
    .image-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .image-gallery {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }
    }
    
    @media (min-width: 1024px) {
        .image-gallery {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
    }
    
    .gallery-item {
        position: relative;
        aspect-ratio: 4 / 3;
        border-radius: var(--radius-sm);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 768px) {
        .gallery-item {
            border-radius: var(--radius-md);
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
            z-index: 10;
        }
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    /* ============================================
       INFO GRID - MOBILE FIRST
    ============================================ */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
    }
    
    @media (min-width: 1024px) {
        .info-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    }
    
    .info-item {
        background: var(--bg-secondary);
        border-radius: var(--radius-sm);
        padding: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .info-item {
            padding: 1rem;
            border-radius: var(--radius-md);
            gap: 0.375rem;
        }
        
        .info-item:hover {
            background: var(--bg-tertiary);
            transform: translateY(-2px);
        }
    }
    
    .info-label {
        font-size: 0.625rem;
        font-weight: 600;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }
    
    @media (min-width: 768px) {
        .info-label {
            font-size: 0.6875rem;
        }
    }
    
    .info-value {
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    @media (min-width: 768px) {
        .info-value {
            font-size: 0.875rem;
            gap: 0.375rem;
        }
    }
    
    .info-value i {
        color: var(--primary-blue);
        font-size: 0.875rem;
    }
    
    @media (min-width: 768px) {
        .info-value i {
            font-size: 1rem;
        }
    }
    
    /* ============================================
       SECTION DIVIDER - MOBILE FIRST
    ============================================ */
    .section-divider {
        height: 1px;
        background: var(--bg-tertiary);
        margin: 1rem 0;
    }
    
    @media (min-width: 768px) {
        .section-divider {
            background: linear-gradient(90deg, transparent, var(--bg-tertiary), transparent);
            margin: 1.5rem 0;
        }
    }
    
    @media (min-width: 1024px) {
        .section-divider {
            margin: 2rem 0;
        }
    }
    
    /* ============================================
       ACTION BUTTONS - MOBILE FIRST
       Sur mobile : Fixés en bas au-dessus de la navbar
       Sur desktop : Position normale
    ============================================ */
    .action-buttons-container {
        position: fixed;
        bottom: calc(60px + env(safe-area-inset-bottom, 0px));
        left: 0;
        right: 0;
        z-index: 999;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 0.75rem;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.95));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }
    
    @media (min-width: 768px) {
        .action-buttons-container {
            bottom: calc(70px + env(safe-area-inset-bottom, 0px));
            flex-direction: row;
            gap: 0.75rem;
            padding: 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .action-buttons-container {
            position: relative;
            bottom: auto;
            left: auto;
            right: auto;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            box-shadow: none;
            border-top: none;
            padding: 0;
            margin: 1.5rem 0 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    }
    
    .btn-primary-action {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.875rem 1.5rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        flex: 1;
    }
    
    @media (min-width: 768px) {
        .btn-primary-action {
            font-size: 0.9375rem;
            padding: 1rem 2rem;
            gap: 0.625rem;
        }
    }
    
    @media (min-width: 1024px) {
        .btn-primary-action {
            flex: 0 0 auto;
            font-size: 1rem;
        }
        
        .btn-primary-action:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
        }
    }
    
    .btn-danger-action {
        background: transparent;
        color: var(--danger-red);
        font-weight: 600;
        font-size: 0.8125rem;
        padding: 0.75rem 1.25rem;
        border: 2px solid var(--danger-red);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        flex: 1;
    }
    
    @media (min-width: 768px) {
        .btn-danger-action {
            font-size: 0.875rem;
            padding: 0.875rem 1.5rem;
            gap: 0.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .btn-danger-action {
            flex: 0 0 auto;
            font-size: 0.9375rem;
        }
        
        .btn-danger-action:hover {
            background: var(--danger-red);
            color: white;
            transform: translateY(-2px);
        }
    }
    
    /* ============================================
       IMAGE MODAL - MOBILE FIRST
    ============================================ */
    .image-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .image-modal.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .image-modal-content {
        max-width: 95vw;
        max-height: 95vh;
        position: relative;
    }
    
    @media (min-width: 768px) {
        .image-modal-content {
            max-width: 90vw;
            max-height: 90vh;
        }
    }
    
    .image-modal-content img {
        max-width: 100%;
        max-height: 95vh;
        border-radius: var(--radius-sm);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
    }
    
    @media (min-width: 768px) {
        .image-modal-content img {
            max-height: 90vh;
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }
    }
    
    .image-modal-close {
        position: absolute;
        top: -0.75rem;
        right: -0.75rem;
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
        color: var(--text-primary);
        box-shadow: var(--shadow-lg);
        transition: all 0.2s;
        z-index: 10;
    }
    
    @media (min-width: 768px) {
        .image-modal-close {
            top: -1rem;
            right: -1rem;
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
        }
        
        .image-modal-close:hover {
            transform: rotate(90deg) scale(1.1);
        }
    }
    
    /* ============================================
       MODALS - MOBILE FIRST
    ============================================ */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
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
    
    @media (min-width: 768px) {
        .modal-overlay {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    }
    
    .modal-overlay.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .modal-content {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        padding: 1.5rem 1rem;
        position: relative;
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    @media (min-width: 768px) {
        .modal-content {
            padding: 2rem 1.5rem;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1);
        opacity: 1;
    }
    
    .modal-close {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        width: 28px;
        height: 28px;
        background: var(--bg-secondary);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
        color: var(--text-secondary);
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .modal-close {
            top: 1rem;
            right: 1rem;
            width: 32px;
            height: 32px;
            font-size: 1.125rem;
        }
        
        .modal-close:hover {
            background: var(--bg-tertiary);
            transform: rotate(90deg);
        }
    }
    
    .modal-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--danger-red), #FF6B6B);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.75rem;
        box-shadow: 0 6px 16px rgba(255, 59, 48, 0.3);
    }
    
    @media (min-width: 768px) {
        .modal-icon {
            width: 64px;
            height: 64px;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            box-shadow: 0 8px 24px rgba(255, 59, 48, 0.3);
        }
    }
    
    .modal-icon.success {
        background: linear-gradient(135deg, var(--success-green), #30D158);
        box-shadow: 0 6px 16px rgba(52, 199, 89, 0.3);
    }
    
    @media (min-width: 768px) {
        .modal-icon.success {
            box-shadow: 0 8px 24px rgba(52, 199, 89, 0.3);
        }
    }
    
    .modal-title {
        font-size: 1.125rem;
        font-weight: 800;
        color: var(--text-primary);
        text-align: center;
        margin-bottom: 0.5rem;
        letter-spacing: -0.3px;
    }
    
    @media (min-width: 768px) {
        .modal-title {
            font-size: 1.375rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }
    }
    
    .modal-subtitle {
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    @media (min-width: 768px) {
        .modal-subtitle {
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
        }
    }
    
    /* ============================================
       FORM STYLES - MOBILE FIRST
    ============================================ */
    .form-group {
        margin-bottom: 1rem;
    }
    
    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
    
    .form-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    
    @media (min-width: 768px) {
        .form-label {
            font-size: 0.875rem;
            margin-bottom: 0.625rem;
        }
    }
    
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 0.875rem;
        background: var(--bg-secondary);
        border: 2px solid var(--bg-tertiary);
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        font-family: inherit;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .form-select,
        .form-textarea {
            padding: 0.875rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.9375rem;
        }
    }
    
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.1);
    }
    
    @media (min-width: 768px) {
        .form-select:focus,
        .form-textarea:focus {
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
        }
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }
    
    @media (min-width: 768px) {
        .form-textarea {
            min-height: 100px;
        }
    }
    
    .form-hint {
        font-size: 0.75rem;
        color: var(--primary-blue);
        margin-top: 0.75rem;
        display: flex;
        align-items: flex-start;
        gap: 0.375rem;
        line-height: 1.4;
    }
    
    @media (min-width: 768px) {
        .form-hint {
            font-size: 0.8125rem;
            margin-top: 0.875rem;
            gap: 0.5rem;
        }
    }
    
    .form-hint i {
        margin-top: 0.125rem;
        flex-shrink: 0;
    }
    
    .modal-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    
    @media (min-width: 768px) {
        .modal-actions {
            gap: 0.875rem;
        }
    }
    
    @media (min-width: 1024px) {
        .modal-actions {
            flex-direction: row;
        }
    }
    
    .btn-modal-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 0.9375rem;
        padding: 0.875rem 1.75rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        text-decoration: none;
        transition: all 0.2s;
        flex: 1;
    }
    
    @media (min-width: 768px) {
        .btn-modal-primary {
            font-size: 1rem;
            padding: 1rem 2rem;
            gap: 0.625rem;
        }
        
        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
        }
    }
    
    .btn-modal-secondary {
        background: transparent;
        color: var(--danger-red);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.75rem 1.5rem;
        border: 2px solid var(--danger-red);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s;
        flex: 1;
    }
    
    @media (min-width: 768px) {
        .btn-modal-secondary {
            font-size: 0.9375rem;
            padding: 0.875rem 2rem;
        }
        
        .btn-modal-secondary:hover {
            background: var(--danger-red);
            color: white;
        }
    }
    
    /* Success Modal Animation */
    .modal-icon.success {
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* Loading Spinner */
    .loading-spinner {
        width: 48px;
        height: 48px;
        border: 4px solid var(--bg-tertiary);
        border-top-color: var(--primary-blue);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1rem;
    }
    
    @media (min-width: 768px) {
        .loading-spinner {
            width: 64px;
            height: 64px;
            border-width: 5px;
            margin-bottom: 1.5rem;
        }
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* ============================================
       UTILITY CLASSES
    ============================================ */
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
    
    /* Hide scroll to top button */
    #scrollToTop,
    .scroll-to-top,
    .back-to-top,
    [class*="scroll-top"],
    [id*="scroll-top"] {
        display: none !important;
    }
    
    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="request-details-container" x-data="requestDetailsApp()">
    
    {{-- Bandeau informatif Owner - visible uniquement sur desktop --}}
    <div class="owner-info-banner">
        <i class="fas fa-user-check"></i>
        <span>Owner view - This is your service request. You can manage it here.</span>
    </div>
    
    <!-- REQUEST CARD -->
    <div class="request-card">
        
        <!-- Category Badge -->
        <div class="category-badge">
            <i class="fas fa-folder-open"></i>
            <span>
                {{ $mission->category->name ?? 'Category' }} 
                @if($mission->subcategory)
                    › {{ $mission->subcategory->name }}
                @endif
                @if($mission->subsubcategory)
                    › {{ $mission->subsubcategory->name }}
                @endif
            </span>
        </div>
        
        <!-- Title -->
        <h1 class="request-title">{{ $mission->title }}</h1>
        
        <!-- Description -->
        <div class="request-description">{{ $mission->description }}</div>
        
        <!-- Image Gallery -->
        @if($images && count($images) > 0)
        <div class="image-gallery">
            @foreach($images as $img)
            <div class="gallery-item"
                 @click="openImageModal('{{ asset($img) }}')"
                 role="button"
                 tabindex="0"
                 @keydown.enter="openImageModal('{{ asset($img) }}')"
                 aria-label="View attachment">
                <img src="{{ asset($img) }}" alt="Mission attachment" loading="lazy" />
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Time remaining before deletion -->
            <div class="info-item">
                <div class="info-label">Ad Unpublished In</div>
                <div class="info-value">
                    <i class="fas fa-calendar-times"></i>
                    <span>{{ $remainingDays }} {{ $remainingDays == 1 ? 'Day' : 'Days' }}</span>
                </div>
            </div>
            
            <!-- Country of assistance -->
            <div class="info-item">
                <div class="info-label">Country of Assistance</div>
                <div class="info-value">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $mission->location_country ?? 'Not specified' }}</span>
                </div>
            </div>
            
            <!-- City -->
            @if($mission->location_city)
            <div class="info-item">
                <div class="info-label">City</div>
                <div class="info-value">
                    <i class="fas fa-city"></i>
                    <span>{{ $mission->location_city }}</span>
                </div>
            </div>
            @endif
            
            <!-- Spoken languages -->
            <div class="info-item">
                <div class="info-label">Spoken Languages</div>
                <div class="info-value">
                    <i class="fas fa-language"></i>
                    <span>
                        @php
                            $languages = json_decode($mission->spoken_languages ?? '[]', true);
                            if (empty($languages)) {
                                $languages = $mission->language ? [$mission->language] : ['Not specified'];
                            } else {
                                $languages = array_unique($languages);
                            }
                            echo implode(', ', $languages);
                        @endphp
                    </span>
                </div>
            </div>
            
            <!-- Type of need -->
            <div class="info-item">
                <div class="info-label">Type of Need</div>
                <div class="info-value">
                    <i class="fas fa-{{ $mission->is_remote ? 'laptop' : 'handshake' }}"></i>
                    <span>{{ $mission->is_remote ? 'Online' : 'In-Person' }}</span>
                </div>
            </div>
            
            <!-- Urgency -->
            <div class="info-item">
                <div class="info-label">Urgency</div>
                <div class="info-value">
                    @php
                        $urgencyMap = [
                            'urgent' => ['icon' => 'exclamation-circle', 'color' => '#FF3B30', 'label' => 'Urgent'],
                            'high' => ['icon' => 'clock', 'color' => '#FF9500', 'label' => 'Within a week'],
                            'medium' => ['icon' => 'calendar', 'color' => '#FFCC00', 'label' => '1-2 weeks'],
                            'low' => ['icon' => 'calendar-alt', 'color' => '#34C759', 'label' => 'More than a month']
                        ];
                        $urgency = $urgencyMap[$mission->urgency] ?? ['icon' => 'calendar', 'color' => '#8E8E93', 'label' => 'Not specified'];
                    @endphp
                    <i class="fas fa-{{ $urgency['icon'] }}" style="color: {{ $urgency['color'] }};"></i>
                    <span style="color: {{ $urgency['color'] }}; font-weight: 700;">{{ $urgency['label'] }}</span>
                </div>
            </div>
            
            <!-- Duration in country -->
            @if($mission->requester_duration_in_country)
            <div class="info-item">
                <div class="info-label">In Country Since</div>
                <div class="info-value">
                    <i class="fas fa-hourglass-half"></i>
                    <span>{{ $mission->requester_duration_in_country }}</span>
                </div>
            </div>
            @endif
            
            <!-- Requester's origin country -->
            @if($mission->requester && $mission->requester->country)
            <div class="info-item">
                <div class="info-label">Your Origin Country</div>
                <div class="info-value">
                    <i class="fas fa-flag"></i>
                    <span>{{ $mission->requester->country }}</span>
                </div>
            </div>
            @endif
            
            <!-- Created date -->
            <div class="info-item">
                <div class="info-label">Published On</div>
                <div class="info-value">
                    <i class="fas fa-calendar-plus"></i>
                    <span>{{ \Carbon\Carbon::parse($mission->created_at)->format('M d, Y') }}</span>
                </div>
            </div>
            
            <!-- Phone number (if available) -->
            @if($mission->requester && $mission->requester->phone_number)
            <div class="info-item">
                <div class="info-label">Your Phone</div>
                <div class="info-value">
                    <i class="fas fa-phone"></i>
                    <span>{{ $mission->requester->phone_number }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Section Divider -->
    <div class="section-divider"></div>
    
    <!-- Action Buttons -->
    <div class="action-buttons-container">
        <a href="{{ route('user.conversation') }}" class="btn-primary-action">
            <i class="fas fa-comments"></i>
            <span>Private Messaging</span>
        </a>
        
        {{-- ✅ Cancel UNIQUEMENT si mission pas encore payée (published) --}}
        @if($mission->status === 'published')
            <button @click="openCancelModal()" class="btn-danger-action">
                <i class="fas fa-ban"></i>
                <span>Cancel Request</span>
            </button>
        @endif
        
        {{-- ✅ Dispute UNIQUEMENT si mission en cours (in_progress) --}}
        @if($mission->status === 'in_progress')
            <button @click="openDisputeModal()" class="btn-danger-action">
                <i class="fas fa-flag"></i>
                <span>Open Dispute</span>
            </button>
        @endif
        
        {{-- ❌ AUCUN bouton si: waiting_to_start, completed, disputed, cancelled --}}
    </div>
    
    <!-- Image Modal -->
    <div class="image-modal" 
         :class="{ 'active': imageModalOpen }"
         @click="closeImageModal()"
         role="dialog"
         aria-modal="true">
        <div class="image-modal-content" @click.stop>
            <button class="image-modal-close" @click="closeImageModal()">✕</button>
            <img :src="currentImage" alt="Full size attachment" />
        </div>
    </div>
    
    <!-- Cancel Modal (AVANT paiement - status: published) -->
    <div class="modal-overlay"
         :class="{ 'active': cancelModalOpen }"
         @click="closeCancelModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="closeCancelModal()">✕</button>
            
            <div class="modal-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            
            <h2 class="modal-title">Why Do You Wish to Cancel This Request?</h2>
            
            <p class="modal-subtitle">
                Please let us know why you want to cancel this service request
            </p>
            
            <form @submit.prevent="submitCancel()">
                <div class="form-group">
                    <label for="cancelReason" class="form-label">Select a reason</label>
                    <select id="cancelReason" 
                            x-model="cancelForm.reason"
                            class="form-select" 
                            required>
                        <option value="">Select a reason...</option>
                        <option value="mistake">I made a mistake in the information provided.</option>
                        <option value="situation_changed">My situation has changed, I no longer need the service.</option>
                        <option value="found_solution">I found a solution elsewhere.</option>
                        <option value="timing_short">The timing is too short to organize this mission.</option>
                        <option value="budget">My budget is not sufficient for the type of service I need.</option>
                        <option value="no_proposals">I didn't receive any relevant proposals.</option>
                        <option value="criteria_mismatch">The available providers do not match my criteria.</option>
                        <option value="postpone">I've decided to postpone this request.</option>
                        <option value="testing">I submitted this request just to test the platform.</option>
                        <option value="other">Other reason (please specify below)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="cancelDescription" class="form-label">Additional details</label>
                    <textarea id="cancelDescription" 
                              x-model="cancelForm.description"
                              class="form-textarea" 
                              maxlength="300" 
                              placeholder="Describe here the reason for your cancellation"
                              required></textarea>
                </div>
                
                <div class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    <span>Your cancellation will be processed immediately. This action cannot be undone.</span>
                </div>
                
                <div class="modal-actions">
                    <button type="button" 
                            class="btn-modal-primary" 
                            @click="closeCancelModal()">
                        <i class="fas fa-check"></i>
                        <span>Keep My Request Online</span>
                    </button>
                    
                    <button type="submit" 
                            class="btn-modal-secondary">
                        <span>Confirm Cancellation</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Dispute Modal (PENDANT mission - status: in_progress) -->
    <div class="modal-overlay"
         :class="{ 'active': disputeModalOpen }"
         @click="closeDisputeModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="closeDisputeModal()">✕</button>
            
            <div class="modal-icon">
                <i class="fas fa-flag"></i>
            </div>
            
            <h2 class="modal-title">Open a Dispute</h2>
            
            <p class="modal-subtitle">
                What problem did you encounter with this service?
            </p>
            
            <form @submit.prevent="submitDispute()">
                <div class="form-group">
                    <label for="disputeReason" class="form-label">Select the issue</label>
                    <select id="disputeReason" 
                            x-model="disputeForm.reason"
                            class="form-select" 
                            required>
                        <option value="">Select a reason...</option>
                        <option value="provider_unreachable">The provider is unreachable</option>
                        <option value="service_not_delivered">The service was not delivered as promised</option>
                        <option value="poor_quality">The quality of service is unsatisfactory</option>
                        <option value="unprofessional">The provider behaved unprofessionally</option>
                        <option value="safety_concern">I have safety concerns</option>
                        <option value="price_dispute">There is a disagreement about the price</option>
                        <option value="incomplete_work">The work is incomplete</option>
                        <option value="other">Other issue (please specify below)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="disputeDescription" class="form-label">Describe the problem</label>
                    <textarea id="disputeDescription" 
                              x-model="disputeForm.description"
                              class="form-textarea" 
                              maxlength="500" 
                              placeholder="Please provide details about the issue"
                              required></textarea>
                </div>
                
                <div class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    <span>The payment will be held while our team reviews your case. Both parties will have a chance to explain their side.</span>
                </div>
                
                <div class="modal-actions">
                    <button type="button" 
                            class="btn-modal-primary" 
                            @click="closeDisputeModal()">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </button>
                    
                    <button type="submit" 
                            class="btn-modal-secondary">
                        <i class="fas fa-flag"></i>
                        <span>Open Dispute</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Loading Modal -->
    <div class="modal-overlay"
         :class="{ 'active': loadingModalOpen }"
         role="alert"
         aria-live="assertive">
        <div class="modal-content" style="text-align: center;">
            <div class="loading-spinner"></div>
            <h2 class="modal-title">Processing...</h2>
            <p class="modal-subtitle">Please wait while we process your request.</p>
        </div>
    </div>
    
    <!-- Success Modal -->
    <div class="modal-overlay"
         :class="{ 'active': successModalOpen }"
         @click="closeSuccessModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop style="text-align: center;">
            <button class="modal-close" @click="closeSuccessModal()">✕</button>
            
            <div class="modal-icon success">
                <i class="fas fa-check"></i>
            </div>
            
            <h2 class="modal-title">Request Processed Successfully!</h2>
            
            <p class="modal-subtitle">
                Your request has been processed.<br>
                We'll keep you informed about what happens next.<br>
                <span style="display: block; margin-top: 0.5rem;">Thank you for your trust! 🙏</span>
            </p>
            
            <button @click="closeSuccessModal()" class="btn-modal-primary" style="margin-top: 1rem;">
                <span>Close</span>
            </button>
        </div>
    </div>
    
</div>

<script>
function requestDetailsApp() {
    return {
        // Image Modal
        imageModalOpen: false,
        currentImage: '',
        
        // Cancel Modal (AVANT paiement)
        cancelModalOpen: false,
        cancelForm: {
            reason: '',
            description: ''
        },
        
        // Dispute Modal (PENDANT mission)
        disputeModalOpen: false,
        disputeForm: {
            reason: '',
            description: ''
        },
        
        // Loading Modal
        loadingModalOpen: false,
        
        // Success Modal
        successModalOpen: false,
        
        init() {
            // Initialization
        },
        
        // Image Modal Methods
        openImageModal(imageUrl) {
            this.currentImage = imageUrl;
            this.imageModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeImageModal() {
            this.imageModalOpen = false;
            document.body.style.overflow = '';
        },
        
        // Cancel Modal Methods (AVANT paiement - status: published)
        openCancelModal() {
            this.cancelModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeCancelModal() {
            this.cancelModalOpen = false;
            this.cancelForm = { reason: '', description: '' };
            document.body.style.overflow = '';
        },
        
        async submitCancel() {
            if (!this.cancelForm.reason) {
                alert('Please select a reason');
                return;
            }
            
            this.closeCancelModal();
            this.loadingModalOpen = true;
            
            try {
                const response = await fetch('/api/mission/cancel', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        mission_id: {{ $mission->id }},
                        reason: this.cancelForm.reason,
                        description: this.cancelForm.description,
                        cancelled_by: 'requester',
                        cancelled_on: new Date().toISOString()
                    })
                });
                
                const data = await response.json();
                
                this.loadingModalOpen = false;
                
                if (data.success) {
                    this.successModalOpen = true;
                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard") }}';
                    }, 3000);
                } else {
                    alert('Error: ' + (data.message || 'An error occurred'));
                }
            } catch (error) {
                this.loadingModalOpen = false;
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        },
        
        // Dispute Modal Methods (PENDANT mission - status: in_progress)
        openDisputeModal() {
            this.disputeModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeDisputeModal() {
            this.disputeModalOpen = false;
            this.disputeForm = { reason: '', description: '' };
            document.body.style.overflow = '';
        },
        
        async submitDispute() {
            if (!this.disputeForm.reason) {
                alert('Please select a reason');
                return;
            }
            
            this.closeDisputeModal();
            this.loadingModalOpen = true;
            
            try {
                const response = await fetch('/api/mission/dispute', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        mission_id: {{ $mission->id }},
                        reason: this.disputeForm.reason,
                        description: this.disputeForm.description,
                        disputed_by: 'requester',
                        disputed_on: new Date().toISOString()
                    })
                });
                
                const data = await response.json();
                
                this.loadingModalOpen = false;
                
                if (data.success) {
                    this.successModalOpen = true;
                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard") }}';
                    }, 3000);
                } else {
                    alert('Error: ' + (data.message || 'An error occurred'));
                }
            } catch (error) {
                this.loadingModalOpen = false;
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        },
        
        // Success Modal Methods
        closeSuccessModal() {
            this.successModalOpen = false;
            document.body.style.overflow = '';
            window.location.href = '{{ route("dashboard") }}';
        }
    }
}

// Close modals on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const app = Alpine.$data(document.querySelector('[x-data]'));
        if (app) {
            if (app.imageModalOpen) app.closeImageModal();
            if (app.cancelModalOpen) app.closeCancelModal();
            if (app.disputeModalOpen) app.closeDisputeModal();
            if (app.successModalOpen) app.closeSuccessModal();
        }
    }
});
</script>

@endsection# 1. Vérifier que vous êtes bien sur dashboard-users
git branch

# 2. Ajouter tous les changements
git add .

# 3. Créer le commit
git commit -m "Votre message de commit"

# 4. Pousser sur dashboard-users (pas sur main)
git push origin dashboard-users
