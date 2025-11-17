@extends('dashboard.layouts.master')

@section('title', 'Job List')

@section('content')
<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-purple: #8b5cf6;
        --color-gradient-start: #6366f1;
        --color-gradient-mid: #8b5cf6;
        --color-gradient-end: #d946ef;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #94a3b8;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-sm: 0.75rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
    }
    
    .jobs-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        background: #ffffff;
        min-height: 100vh;
    }
    
    /* HEADER */
    .jobs-header-top {
        margin-bottom: 1.5rem;
    }
    
    .jobs-title-main {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin: 0 0 1rem 0;
    }
    
    /* ONGOING BANNER - ULTRA-VISIBLE */
    .ongoing-banner-2025 {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border-radius: var(--border-radius-lg);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        animation: slideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .ongoing-content {
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        min-width: 0;
    }
    
    .ongoing-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        flex-shrink: 0;
        animation: pulse 2s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }
    
    .ongoing-text-wrap {
        flex: 1;
        min-width: 0;
    }
    
    .ongoing-count {
        font-size: 1.375rem;
        font-weight: 700;
        display: block;
        line-height: 1.2;
        margin-bottom: 0.125rem;
    }
    
    .ongoing-label {
        font-size: 0.75rem;
        font-weight: 600;
        opacity: 0.95;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .ongoing-btn {
        background: white;
        color: #dc2626;
        padding: 0.75rem 1.5rem;
        border-radius: 999px;
        font-size: 0.8125rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        white-space: nowrap;
    }
    
    .ongoing-btn:hover, .ongoing-btn:focus {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    
    .ongoing-btn:active {
        transform: translateY(0) scale(0.98);
    }
    
    /* STATS OVERVIEW */
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-radius: var(--border-radius-lg);
        border: 2px solid #93c5fd;
    }
    
    .stat-item {
        text-align: center;
        padding: 0.625rem 0.5rem;
        background: rgba(255, 255, 255, 0.5);
        border-radius: var(--border-radius-md);
        transition: var(--transition-base);
    }
    
    .stat-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-2px);
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.375rem;
        line-height: 1;
    }
    
    .stat-value.active { color: var(--color-success); }
    .stat-value.offers { color: var(--color-warning); }
    
    .stat-label {
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        line-height: 1.3;
    }
    
    /* SECTION BADGES */
    .section-badge-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        margin-bottom: 1.5rem;
        text-align: center;
        width: 100%;
        justify-content: center;
    }
    
    /* TABS */
    .tabs-container {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 0.375rem;
        background: #e2e8f0;
        border-radius: var(--border-radius-lg);
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    
    .tabs-container::-webkit-scrollbar {
        display: none;
    }
    
    .tab-button {
        padding: 0.875rem 1.25rem;
        border-radius: var(--border-radius-md);
        font-weight: 700;
        font-size: 0.8125rem;
        border: 2px solid transparent;
        cursor: pointer;
        transition: var(--transition-base);
        background: transparent;
        color: var(--color-text-secondary);
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        flex-shrink: 0;
        touch-action: manipulation;
    }
    
    .tab-button:hover {
        background: rgba(255, 255, 255, 0.6);
        color: var(--color-primary);
    }
    
    .tab-button.active {
        background: white;
        color: var(--color-primary);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        border-color: #bfdbfe;
        transform: translateY(-1px);
    }
    
    .tab-button:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .tab-button::after {
        content: '';
        position: absolute;
        bottom: -0.375rem;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 60%;
        height: 3px;
        background: var(--color-primary);
        border-radius: 999px;
        transition: transform 0.3s ease;
    }
    
    .tab-button.active::after {
        transform: translateX(-50%) scaleX(1);
    }
    
    .tab-badge {
        background: var(--color-danger);
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 999px;
        font-size: 0.625rem;
        font-weight: 700;
        min-width: 18px;
        text-align: center;
        line-height: 1.4;
    }
    
    .tab-button.active .tab-badge {
        background: var(--color-primary);
        animation: bounce 0.5s ease;
    }
    
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* JOBS GRID - RESPONSIVE */
    .jobs-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    /* JOB CARDS */
    .job-card-2025 {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        transition: var(--transition-base);
        position: relative;
        overflow: hidden;
        will-change: transform;
    }
    
    .job-card-2025:hover {
        border-color: #94a3b8;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .card-header-row {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 0.875rem;
    }
    
    .job-icon-2025 {
        width: 40px;
        height: 40px;
        border-radius: var(--border-radius-md);
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
        font-size: 1.125rem;
    }
    
    .card-content-main {
        flex: 1;
        min-width: 0;
    }
    
    .job-title-2025 {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin: 0 0 0.5rem 0;
        word-break: break-word;
        line-height: 1.3;
    }
    
    .status-row {
        display: flex;
        gap: 0.375rem;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .status-badge-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.625rem;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .status-badge-waiting {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-badge-in-progress {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .status-badge-disputed {
        background: #fee2e2;
        color: #991b1b;
    }
    
    /* OFFER CARDS */
    .offer-card-2025 {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        border: 2px solid #fdba74;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        transition: var(--transition-base);
    }
    
    .offer-card-2025:hover {
        border-color: #f97316;
        box-shadow: 0 8px 24px rgba(249, 115, 22, 0.15);
        transform: translateY(-2px);
    }
    
    .offer-icon-published {
        background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
    }
    
    /* INFO GRID */
    .info-grid {
        display: grid;
        gap: 0.5rem;
        margin-bottom: 0.875rem;
        padding: 0.875rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-md);
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
    }
    
    .info-icon {
        color: var(--color-text-tertiary);
        width: 14px;
        text-align: center;
        flex-shrink: 0;
    }
    
    .info-label {
        color: var(--color-text-secondary);
        font-weight: 600;
        min-width: 60px;
    }
    
    .info-value {
        color: var(--color-text-primary);
        font-weight: 500;
    }
    
    /* PRICE BOX */
    .price-box-highlight {
        padding: 0.875rem;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: var(--border-radius-md);
        margin-bottom: 0.875rem;
        border: 2px solid #fbbf24;
        text-align: center;
    }
    
    .price-label-main {
        font-size: 0.6875rem;
        color: #78350f;
        font-weight: 600;
        margin-bottom: 0.375rem;
        text-transform: uppercase;
    }
    
    .price-value-main {
        font-size: 1.125rem;
        font-weight: 700;
        color: #92400e;
    }
    
    /* DISPUTE BADGE */
    .dispute-badge-inline {
        background: #fee2e2;
        color: #dc2626;
        border: 2px solid #fca5a5;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.875rem;
        width: 100%;
        justify-content: center;
    }
    
    .dispute-badge-inline:hover {
        background: #fca5a5;
        color: white;
        transform: scale(1.02);
    }
    
    /* SERVICE ACTIONS - RESPONSIVE */
    .service-actions {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
        padding-top: 0.875rem;
        border-top: 2px solid #f1f5f9;
    }
    
    .btn-job-action {
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-md);
        font-weight: 600;
        font-size: 0.8125rem;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        touch-action: manipulation;
        width: 100%; /* Full width on mobile */
    }
    
    .btn-job-action:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .btn-view-job {
        background: transparent;
        color: var(--color-primary);
        border: 2px solid var(--color-primary);
    }
    
    .btn-view-job:hover,
    .btn-view-job:focus {
        background: var(--color-primary);
        color: white;
    }
    
    .btn-start-job {
        background: var(--color-success);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }
    
    .btn-start-job:hover,
    .btn-start-job:focus {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-finish-job {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
    }
    
    .btn-finish-job:hover,
    .btn-finish-job:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    
    .btn-resolve-dispute {
        background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    
    .btn-resolve-dispute:hover,
    .btn-resolve-dispute:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }
    
    /* ✅ NOUVEAU : Bouton Cancel Offer */
    .btn-cancel-offer {
        background: transparent;
        color: var(--color-danger);
        border: 2px solid var(--color-danger);
        box-shadow: none;
    }
    
    .btn-cancel-offer:hover,
    .btn-cancel-offer:focus {
        background: var(--color-danger);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    
    .btn-cancel-offer:active {
        transform: translateY(0) scale(0.98);
    }
    
    /* EMPTY STATE */
    .empty-state-2025 {
        text-align: center;
        padding: 2.5rem 1.5rem;
        background: var(--color-bg-secondary);
        border: 2px dashed #cbd5e1;
        border-radius: var(--border-radius-lg);
    }
    
    .empty-icon {
        font-size: 2.5rem;
        color: var(--color-text-tertiary);
        margin-bottom: 1rem;
        opacity: 0.4;
    }
    
    .empty-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }
    
    .empty-text {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
    }
    
    /* BOTTOM NAV */
    .bottom-nav-2025 {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
        padding: 1.5rem 0;
        border-top: 2px solid #e5e7eb;
    }
    
    .nav-link-2025 {
        color: var(--color-primary);
        font-size: 0.875rem;
        font-weight: 700;
        text-decoration: none !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition-base);
        position: relative;
        padding: 0.5rem 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .nav-link-2025::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--color-primary);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .nav-link-2025:hover::after {
        transform: scaleX(1);
    }
    
    .nav-link-2025:hover {
        color: #1d4ed8;
    }
    
    /* MODALS */
    .modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9998;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .modal-overlay-2025.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .modal-2025 {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.9);
        background: white;
        border-radius: var(--border-radius-xl);
        padding: 1rem; /* px-4 mobile */
        max-width: calc(100vw - 2rem);
        width: 500px;
        max-height: 85vh;
        overflow-y: auto;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .modal-2025.active {
        opacity: 1;
        pointer-events: all;
        transform: translate(-50%, -50%) scale(1);
    }
    
    .modal-header-2025 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .modal-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .modal-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f1f5f9;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
        font-size: 1.125rem;
    }
    
    .modal-close-btn:hover {
        background: #e2e8f0;
        color: var(--color-text-primary);
        transform: rotate(90deg);
    }
    
    .modal-content-2025 {
        margin-bottom: 1.5rem;
    }
    
    .modal-message-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid var(--color-primary);
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-bottom: 1.25rem;
        font-size: 0.875rem;
        line-height: 1.6;
        color: var(--color-text-secondary);
    }
    
    .modal-timer {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        background: #fef3c7;
        border: 2px solid #fde68a;
        border-radius: var(--border-radius-md);
        margin-bottom: 1.5rem;
    }
    
    .modal-timer-icon {
        font-size: 1.25rem;
        color: #f59e0b;
    }
    
    .modal-timer-text {
        font-size: 0.8125rem;
        color: #92400e;
        font-weight: 600;
        flex: 1;
    }
    
    .modal-timer-value {
        font-weight: 700;
        color: #78350f;
    }
    
    .modal-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .modal-btn {
        padding: 0.875rem 1.5rem;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-align: center;
        width: 100%; /* Full width on mobile */
    }
    
    .modal-btn-outline {
        background: white;
        color: var(--color-danger);
        border: 2px solid var(--color-danger);
    }
    
    .modal-btn-outline:hover {
        background: var(--color-danger);
        color: white;
    }
    
    .modal-btn-primary {
        background: var(--color-primary);
        color: white;
    }
    
    .modal-btn-primary:hover {
        background: #1d4ed8;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    
    .modal-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }
    
    .modal-success .modal-header-2025 {
        border-color: #6ee7b7;
    }
    
    .modal-success-icon {
        width: 64px;
        height: 64px;
        background: var(--color-success);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* ✅ NOUVEAU : Toast Notifications */
    .toast-container {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        pointer-events: none;
    }
    
    .toast {
        background: white;
        border-radius: var(--border-radius-md);
        padding: 1rem 1.25rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 280px;
        max-width: 400px;
        pointer-events: all;
        animation: slideInRight 0.3s ease;
        border-left: 4px solid;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .toast.success {
        border-left-color: var(--color-success);
    }
    
    .toast.error {
        border-left-color: var(--color-danger);
    }
    
    .toast-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 0.875rem;
        color: white;
    }
    
    .toast.success .toast-icon {
        background: var(--color-success);
    }
    
    .toast.error .toast-icon {
        background: var(--color-danger);
    }
    
    .toast-message {
        flex: 1;
        font-size: 0.875rem;
        color: var(--color-text-primary);
        font-weight: 500;
    }
    
    .toast-close {
        width: 24px;
        height: 24px;
        border: none;
        background: transparent;
        color: var(--color-text-tertiary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition-base);
        flex-shrink: 0;
    }
    
    .toast-close:hover {
        background: #f1f5f9;
        color: var(--color-text-primary);
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
    
    /* RESPONSIVE - TABLET */
    @media (min-width: 640px) {
        .jobs-container-2025 {
            padding: 1.5rem;
        }
        
        .jobs-title-main {
            font-size: 1.75rem;
        }
        
        .stats-overview {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1.25rem;
        }
        
        .stat-item {
            padding: 0.875rem;
        }
        
        .stat-value {
            font-size: 2rem;
        }
        
        .stat-label {
            font-size: 0.75rem;
        }
        
        .jobs-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        
        .job-card-2025, .offer-card-2025 {
            padding: 1.25rem;
        }
        
        .job-icon-2025 {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
        
        .job-title-2025 {
            font-size: 1rem;
        }
        
        .service-actions {
            flex-direction: row;
        }
        
        .btn-job-action {
            flex: 1;
            width: auto; /* Auto width on desktop */
        }
        
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .modal-actions {
            flex-direction: row;
        }
        
        .modal-btn {
            flex: 1;
            width: auto; /* Auto width on desktop */
        }
        
        .modal-2025 {
            padding: 2rem; /* More padding on desktop */
        }
        
        .modal-title-2025 {
            font-size: 1.25rem;
        }
        
        .ongoing-banner-2025 {
            flex-wrap: nowrap;
        }
        
        .ongoing-btn {
            padding: 0.875rem 2rem;
        }
    }
    
    /* RESPONSIVE - DESKTOP */
    @media (min-width: 1024px) {
        .jobs-container-2025 {
            padding: 2rem;
        }
        
        .jobs-grid-2025 {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        
        .job-card-2025, .offer-card-2025 {
            padding: 1.5rem;
        }
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
</style>

<!-- ✅ NOUVEAU : Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<div class="jobs-container-2025">
    
    @php 
        $jobsAccepted = $jobs->filter(function($job) {
            return in_array($job->status, ['accepted', 'waiting_to_start', 'in_progress', 'disputed']);
        });
    
        $jobsOffer = $jobs->filter(function($job) {
            return in_array($job->status, ['pending']);
        });
    @endphp
    
    <!-- Header -->
    <header class="jobs-header-top">
        <h1 class="jobs-title-main">My Jobs</h1>
    </header>
    
    <!-- Ongoing Banner -->
    @if($ongoingJobs ?? 0)
    <div class="ongoing-banner-2025">
        <div class="ongoing-content">
            <div class="ongoing-icon">
                <i class="fas fa-fire"></i>
            </div>
            <div class="ongoing-text-wrap">
                <div class="ongoing-count">{{ $ongoingJobs }}</div>
                <div class="ongoing-label">Ongoing Service Requests</div>
            </div>
        </div>
        <a href="{{ route('ongoing-requests')}}" class="ongoing-btn">
            <span>Discover</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    @endif
    
    <!-- Stats Overview -->
    <section class="stats-overview" aria-label="Jobs statistics">
        <div class="stat-item">
            <div class="stat-value active" aria-label="{{ $jobsAccepted->count() }} active jobs">{{ $jobsAccepted->count() }}</div>
            <div class="stat-label">Active Jobs</div>
        </div>
        <div class="stat-item">
            <div class="stat-value offers" aria-label="{{ $jobsOffer->count() }} pending offers">{{ $jobsOffer->count() }}</div>
            <div class="stat-label">Pending Offers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value" aria-label="{{ $jobs->where('dispute_count', '>', 0)->count() }} disputes">{{ $jobs->where('dispute_count', '>', 0)->count() }}</div>
            <div class="stat-label">Disputes</div>
        </div>
        <div class="stat-item">
            <div class="stat-value" aria-label="{{ $jobs->whereIn('status', ['completed'])->count() }} completed">{{ $jobs->whereIn('status', ['completed'])->count() }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </section>
    
    <!-- Tabs -->
    <nav class="tabs-container" role="tablist" aria-label="Job categories">
        <button class="tab-button active" 
                data-tab="current" 
                role="tab" 
                aria-selected="true"
                aria-controls="tab-current"
                id="tab-btn-current">
            <i class="fas fa-circle" style="font-size: 0.5rem; color: var(--color-success);" aria-hidden="true"></i>
            <span>Current Jobs</span>
            @if($jobsAccepted->count() > 0)
                <span class="tab-badge" aria-label="{{ $jobsAccepted->count() }} current">{{ $jobsAccepted->count() }}</span>
            @endif
        </button>
        
        <button class="tab-button" 
                data-tab="offers" 
                role="tab" 
                aria-selected="false"
                aria-controls="tab-offers"
                id="tab-btn-offers">
            <i class="fas fa-hourglass-half" aria-hidden="true"></i>
            <span>Quote Offers</span>
            @if($jobsOffer->count() > 0)
                <span class="tab-badge" aria-label="{{ $jobsOffer->count() }} offers">{{ $jobsOffer->count() }}</span>
            @endif
        </button>
    </nav>
    
    <!-- TAB 1: Current Jobs -->
    <section class="tab-content active" 
             id="tab-current" 
             role="tabpanel" 
             aria-labelledby="tab-btn-current">
        
        <div class="section-badge-2025">
            <i class="fas fa-clipboard-check"></i>
            <span>Current job to do</span>
        </div>
        
        <div class="jobs-grid-2025">
            @forelse($jobsAccepted as $job)
                @php
                    $statusMap = [
                        'waiting_to_start' => ['text' => 'Ready to Start', 'class' => 'status-badge-waiting'],
                        'in_progress' => ['text' => 'In Progress', 'class' => 'status-badge-in-progress'],
                        'disputed' => ['text' => 'Disputed', 'class' => 'status-badge-disputed'],
                    ];
                    $statusInfo = $statusMap[$job->status] ?? ['text' => 'Pending', 'class' => 'status-badge-waiting'];
                @endphp
                
                <article class="job-card-2025" aria-label="Job: {{ $job->title ?? 'Job' }}">
                    <div class="card-header-row">
                        <div class="job-icon-2025" aria-hidden="true">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-content-main">
                            <h3 class="job-title-2025">{{ strtoupper($job->title ?? 'JOB') }}</h3>
                            <div class="status-row">
                                <span class="status-badge-2025 {{ $statusInfo['class'] }}" role="status">
                                    <i class="fas fa-circle" style="font-size: 0.5rem;" aria-hidden="true"></i>
                                    {{ $statusInfo['text'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="price-box-highlight">
                        <div class="price-label-main">For this job I win</div>
                        <div class="price-value-main">- €</div>
                    </div>
                    
                    @if($job->dispute_count ?? 0)
                    <button
                        type="button"
                        class="dispute-badge-inline"
                        onclick="openDisputePopup({{ $job->id }})"
                        aria-label="{{ $job->dispute_count }} ongoing disputes">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                        <span>{{ $job->dispute_count }} Ongoing dispute</span>
                    </button>
                    @endif
                    
                    <dl class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-calendar info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Deadline:</dt>
                            <dd class="info-value">{{ $job->service_durition ?? '-' }}</dd>
                        </div>
                    </dl>
                    
                    <div class="service-actions">
                        <a href="{{ route('view-job', ['id' => $job->id]) }}" 
                           class="btn-job-action btn-view-job"
                           aria-label="View job details">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                            <span>See the job</span>
                        </a>
                        
                        @if($job->status === 'waiting_to_start')
                            <button class="btn-job-action btn-start-job" 
                                    onclick="startMission({{$job->id}})"
                                    aria-label="Start this job">
                                <i class="fas fa-play" aria-hidden="true"></i>
                                <span>Start</span>
                            </button>
                        @elseif($job->status === 'in_progress')
                            <button class="btn-job-action btn-finish-job" 
                                    onclick="openDeliveryConfirmPopup({{$job->id}})"
                                    aria-label="Mark job as finished">
                                <i class="fas fa-check-circle" aria-hidden="true"></i>
                                <span>Job finish</span>
                            </button>
                        @elseif($job->status === 'disputed')
                            <button class="btn-job-action btn-resolve-dispute" 
                                    onclick="resolveDispute({{$job->id}})"
                                    aria-label="Resolve dispute">
                                <i class="fas fa-gavel" aria-hidden="true"></i>
                                <span>Resolve Dispute</span>
                            </button>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state-2025" style="grid-column: 1 / -1;" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <div class="empty-title">No current jobs to do.</div>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- TAB 2: Quote Offers -->
    <section class="tab-content" 
             id="tab-offers" 
             role="tabpanel" 
             aria-labelledby="tab-btn-offers">
        
        <div class="section-badge-2025">
            <i class="fas fa-file-invoice"></i>
            <span>My quote offers</span>
        </div>
        
        <div class="jobs-grid-2025">
            @forelse($offers as $offer)
                <article class="offer-card-2025" data-offer-id="{{ $offer->id }}" aria-label="Quote offer: {{ $offer->mission->title ?? 'Job' }}">
                    <div class="card-header-row">
                        <div class="job-icon-2025 offer-icon-published" aria-hidden="true">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div class="card-content-main">
                            <h3 class="job-title-2025">{{ strtoupper($offer->mission->title ?? 'JOB') }}</h3>
                        </div>
                    </div>
                    
                    <dl class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-clock info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Deadline:</dt>
                            <dd class="info-value">{{ $offer->mission->service_durition ?? '-' }}</dd>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar-plus info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Published:</dt>
                            <dd class="info-value">{{ $offer->mission->created_at->diffForHumans() }}</dd>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-euro-sign info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Offer Price:</dt>
                            <dd class="info-value">{{ $offer->price ?? '-' }} €</dd>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Country:</dt>
                            <dd class="info-value">{{ $offer->mission->location_country ?? '-' }}</dd>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-language info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Language:</dt>
                            <dd class="info-value">{{ $offer->mission->language ?? '-' }}</dd>
                        </div>
                    </dl>
                    
                    <div class="service-actions">
                        <a href="{{ route('quote-offer', ['id' => $offer->mission->id])}}"> 
                           class="btn-job-action btn-view-job"
                           aria-label="View quote offer details">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                            <span>See the job</span>
                        </a>
                        
                        {{-- ✅ NOUVEAU : Bouton Cancel Offer --}}
                        @if($offer->status === 'pending')
                        <button class="btn-job-action btn-cancel-offer" 
                                onclick="confirmCancelOffer({{ $offer->id }})"
                                aria-label="Cancel this offer">
                            <i class="fas fa-times" aria-hidden="true"></i>
                            <span>Cancel Offer</span>
                        </button>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state-2025" style="grid-column: 1 / -1;" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="empty-title">No pending quote offers.</div>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- Bottom Navigation -->
    <div class="bottom-nav-2025">
        <a href="{{ route('provider.jobs.archive', auth()->id()) }}" class="nav-link-2025">
            <i class="fas fa-archive"></i>
            <span>Archived</span>
        </a>
    </div>
    
</div>

<!-- Dispute Popup Modal -->
<div class="modal-overlay-2025" id="disputeOverlay"></div>
<div class="modal-2025" id="disputePopup">
    <div class="modal-header-2025">
        <h3 class="modal-title-2025">
            <span style="color: var(--color-danger);">
                <i class="fas fa-exclamation-circle"></i>
            </span>
            You have received a dispute
        </h3>
        <button class="modal-close-btn" onclick="closeDisputePopup()" aria-label="Close modal">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="modal-content-2025">
        <p style="font-size: 0.875rem; color: var(--color-text-secondary); margin-bottom: 1rem;">
            The client has sent you the following message:
        </p>
        
        <div class="modal-message-box">
            Hi "name service provider",<br><br>
            I hope you're doing well. I'm contacting you because I have some concerns about the current order:
            <ul style="margin: 0.75rem 0; padding-left: 1.25rem;">
                <li>No update has been shared since the project started.</li>
                <li>The expected delivery date was 3 days ago.</li>
                <li>I sent 2 messages without a reply.</li>
            </ul>
            I'd really appreciate it if you could either provide a clear update or cancel the order if you're unable to continue. Looking forward to your response. Thanks in advance!
        </div>
        
        <div class="modal-timer">
            <div class="modal-timer-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="modal-timer-text">
                Time remaining to respond: <span class="modal-timer-value" id="disputeTimer">23:51:43</span>
            </div>
        </div>
    </div>
    
    <div class="modal-actions">
        <button class="modal-btn modal-btn-outline" onclick="openDecisionPopup()" aria-label="Refuse dispute request">
            Refuse Request
        </button>
        <button class="modal-btn modal-btn-primary" onclick="openDecisionPopup()" aria-label="Accept dispute request">
            Accept Request
        </button>
    </div>
</div>

<!-- Decision Sent Popup Modal -->
<div class="modal-overlay-2025" id="decisionOverlay"></div>
<div class="modal-2025 modal-success" id="decisionPopup">
    <div class="modal-header-2025">
        <button class="modal-close-btn" onclick="closeDecisionPopup()" style="margin-left: auto;" aria-label="Close modal">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div style="text-align: center;">
        <div class="modal-success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--color-success); margin-bottom: 1rem;">
            Your decision has been sent!
        </h3>
        
        <p style="font-size: 0.875rem; color: var(--color-text-secondary); margin-bottom: 0.5rem;">
            The service requester has just received your message.<br>
            We'll keep you in the loop for what happens next.
        </p>
        
        <p style="font-size: 0.875rem; color: var(--color-text-secondary); margin-top: 1rem;">
            Thanks a bunch for your trust! 🙌
        </p>
    </div>
</div>

@include('dashboard.provider.jobs.delivery-confirm-popup')

<script>
(function() {
    'use strict';
    
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetTab = button.dataset.tab;
            
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-selected', 'false');
            });
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            button.classList.add('active');
            button.setAttribute('aria-selected', 'true');
            document.getElementById(`tab-${targetTab}`).classList.add('active');
        });
    });
    
    tabButtons.forEach((button, index) => {
        button.addEventListener('keydown', (e) => {
            let newIndex;
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                newIndex = (index + 1) % tabButtons.length;
                tabButtons[newIndex].focus();
                tabButtons[newIndex].click();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                newIndex = (index - 1 + tabButtons.length) % tabButtons.length;
                tabButtons[newIndex].focus();
                tabButtons[newIndex].click();
            } else if (e.key === 'Home') {
                e.preventDefault();
                tabButtons[0].focus();
                tabButtons[0].click();
            } else if (e.key === 'End') {
                e.preventDefault();
                tabButtons[tabButtons.length - 1].focus();
                tabButtons[tabButtons.length - 1].click();
            }
        });
    });
    
    // ═══════════════════════════════════════════════════════
    // ✅ NOUVEAU : Toast System
    // ═══════════════════════════════════════════════════════
    function showToast(type, message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        const iconMap = {
            'success': 'fa-check',
            'error': 'fa-times'
        };
        
        toast.innerHTML = `
            <div class="toast-icon">
                <i class="fas ${iconMap[type] || 'fa-info'}"></i>
            </div>
            <div class="toast-message">${message}</div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(toast);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            toast.style.animation = 'slideInRight 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    
    // ═══════════════════════════════════════════════════════
    // ✅ NOUVEAU : Cancel Offer Functions
    // ═══════════════════════════════════════════════════════
    function confirmCancelOffer(offerId) {
        if (confirm('Are you sure you want to cancel this offer? This action is irreversible.')) {
            cancelOffer(offerId);
        }
    }
    
    async function cancelOffer(offerId) {
        try {
            const response = await fetch(`/api/offers/${offerId}/cancel`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Succès - retirer la card de l'interface
                const card = document.querySelector(`[data-offer-id="${offerId}"]`);
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => card.remove(), 300);
                }
                
                // Toast de confirmation
                showToast('success', data.message || 'Your offer has been cancelled successfully');
                
                // Mettre à jour le badge du tab
                setTimeout(() => {
                    const remainingOffers = document.querySelectorAll('.offer-card-2025').length - 1;
                    const badge = document.querySelector('#tab-btn-offers .tab-badge');
                    if (badge) {
                        if (remainingOffers > 0) {
                            badge.textContent = remainingOffers;
                        } else {
                            badge.remove();
                        }
                    }
                }, 400);
            } else {
                showToast('error', data.message || 'An error occurred while cancelling the offer');
            }
        } catch (error) {
            console.error('Error cancelling offer:', error);
            showToast('error', 'An error occurred while cancelling the offer');
        }
    }
    
    // ═══════════════════════════════════════════════════════
    // Existing Functions
    // ═══════════════════════════════════════════════════════
    function openDisputePopup(idx) {
        const overlay = document.getElementById('disputeOverlay');
        const modal = document.getElementById('disputePopup');
        if (overlay && modal) {
            overlay.classList.add('active');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeDisputePopup() {
        const overlay = document.getElementById('disputeOverlay');
        const modal = document.getElementById('disputePopup');
        if (overlay && modal) {
            overlay.classList.remove('active');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    function openDecisionPopup() {
        closeDisputePopup();
        const overlay = document.getElementById('decisionOverlay');
        const modal = document.getElementById('decisionPopup');
        if (overlay && modal) {
            overlay.classList.add('active');
            modal.classList.add('active');
        }
    }
    
    function closeDecisionPopup() {
        const overlay = document.getElementById('decisionOverlay');
        const modal = document.getElementById('decisionPopup');
        if (overlay && modal) {
            overlay.classList.remove('active');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    function startMission(missionId) {
        if (!confirm('Are you sure you want to start this mission?')) return;

        fetch('/api/provider/jobs/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ mission_id: missionId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error('Failed to start mission:', data.message);
            }
        })
        .catch(error => {
            console.error('Error starting mission:', error);
        });
    }

    function resolveDispute(missionId) {
        if (!confirm('Are you sure you want to resolve this dispute?')) return;

        fetch('/api/provider/jobs/resolve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ mission_id: missionId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error('Failed to resolve dispute:', data.message);
            }
        })
        .catch(error => {
            console.error('Error resolving dispute:', error);
        });
    }
    
    document.getElementById('disputeOverlay')?.addEventListener('click', closeDisputePopup);
    document.getElementById('decisionOverlay')?.addEventListener('click', closeDecisionPopup);
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDisputePopup();
            closeDecisionPopup();
        }
    });
    
    // ═══════════════════════════════════════════════════════
    // Expose Functions to Global Scope
    // ═══════════════════════════════════════════════════════
    window.openDisputePopup = openDisputePopup;
    window.closeDisputePopup = closeDisputePopup;
    window.openDecisionPopup = openDecisionPopup;
    window.closeDecisionPopup = closeDecisionPopup;
    window.startMission = startMission;
    window.resolveDispute = resolveDispute;
    window.confirmCancelOffer = confirmCancelOffer;
    window.showToast = showToast;
    
})();
</script>

@endsection