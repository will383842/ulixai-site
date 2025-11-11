@extends('dashboard.layouts.master')

@section('title', 'Dashboard')

@section('content')

<style>
    /* ========================================
       DASHBOARD 2025/2026 - MOBILE FIRST PRODUCTION
       Design System: Modern, Breathable, Motivating
       ======================================== */
    
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-purple: #8b5cf6;
        --color-pink: #ec4899;
        
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
        
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    /* Fix background noir au chargement */
    body {
        background: #ffffff !important;
    }
    
    /* Container principal - MOBILE FIRST */
    .dashboard-2025 {
        animation: fadeIn 0.25s ease-out;
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem;
        background: #ffffff;
        min-height: 100vh;
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0.98;
            transform: translateY(2px);
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
    
    /* ========================================
       STAT CARDS - MOBILE FIRST
       ======================================== */
    .stat-card-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1.25rem;
        border: 2px solid #cbd5e1;
        transition: var(--transition-base);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        text-decoration: none !important;
        display: block;
        color: inherit !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        min-height: 100px;
    }
    
    a.stat-card-2025 {
        pointer-events: auto !important;
    }
    
    button.stat-card-2025 {
        width: 100%;
        border: 2px solid #cbd5e1;
        font-family: inherit;
        text-align: left;
        background: var(--color-bg-primary);
    }
    
    .stat-card-2025:active {
        transform: scale(0.98);
    }
    
    .stat-card-2025::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: var(--card-accent, var(--color-primary));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stat-card-2025:hover::before {
        opacity: 1;
    }
    
    .stat-card-content {
        display: flex;
        align-items: flex-start;
        gap: 0.875rem;
        pointer-events: none;
    }
    
    .stat-card-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--border-radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        background: var(--icon-bg, #f1f5f9);
        color: var(--icon-color, var(--color-primary));
        transition: var(--transition-base);
        flex-shrink: 0;
    }
    
    .stat-card-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-value-2025 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.25rem;
        line-height: 1;
        letter-spacing: -0.02em;
    }
    
    .stat-label-2025 {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
        font-weight: 500;
        letter-spacing: 0.01em;
        line-height: 1.3;
    }
    
    .stat-card-extra {
        margin-top: 0.5rem;
        font-size: 0.6875rem;
        color: var(--color-text-tertiary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .stat-card-action {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        color: var(--color-text-tertiary);
        font-size: 0.6875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        opacity: 0;
        transition: var(--transition-base);
        pointer-events: none;
    }
    
    /* ========================================
       MODAL AFFILIATION - MOBILE FIRST
       ======================================== */
    .share-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
        z-index: 9998;
        opacity: 0;
        pointer-events: none !important;
        transition: opacity 0.3s ease;
        display: none;
    }
    
    .share-modal-overlay.active {
        opacity: 1;
        pointer-events: all !important;
        display: block;
    }
    
    .share-modal {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        border-radius: var(--border-radius-xl) var(--border-radius-xl) 0 0;
        padding: 1.25rem;
        z-index: 9999;
        transform: translateY(100%);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        max-height: 85vh;
        overflow-y: auto;
        display: none;
    }
    
    .share-modal.active {
        transform: translateY(0);
        display: block;
    }
    
    .share-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .share-modal-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
    }
    
    .share-modal-close {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f3f4f6;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
    }
    
    .share-modal-close:hover {
        background: #e5e7eb;
        color: var(--color-text-primary);
    }
    
    .share-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding: 1rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-md);
    }
    
    .share-stat {
        text-align: center;
    }
    
    .share-stat:not(:last-child) {
        border-right: 1px solid #e5e7eb;
    }
    
    .share-stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.25rem;
    }
    
    .share-stat-value.success {
        color: var(--color-success);
    }
    
    .share-stat-value.primary {
        color: var(--color-primary);
    }
    
    .share-stat-label {
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
        font-weight: 500;
    }
    
    .affiliate-link-section {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--color-bg-secondary);
        border: 1px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        margin-bottom: 1.25rem;
    }
    
    .affiliate-link-input {
        flex: 1;
        background: transparent;
        border: none;
        color: var(--color-text-primary);
        font-size: 0.75rem;
        outline: none;
        font-family: monospace;
        word-break: break-all;
    }
    
    .affiliate-copy-btn {
        background: var(--color-primary);
        color: white;
        border: none;
        border-radius: var(--border-radius-sm);
        padding: 0.625rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
    }
    
    .affiliate-copy-btn:active {
        transform: scale(0.96);
    }
    
    .share-section-label {
        display: block;
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .share-options-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }
    
    .share-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 0.5rem;
        border-radius: var(--border-radius-md);
        background: var(--color-bg-secondary);
        border: 1px solid transparent;
        cursor: pointer;
        transition: var(--transition-base);
        text-align: center;
    }
    
    .share-option:active {
        transform: scale(0.96);
    }
    
    .share-option-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        color: white;
    }
    
    .share-option-icon.whatsapp { background: #25D366; }
    .share-option-icon.email { background: #ea4335; }
    .share-option-icon.facebook { background: #1877f2; }
    .share-option-icon.linkedin { background: #0077b5; }
    .share-option-icon.twitter { background: #000000; }
    
    .share-option-label {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
    }
    
    /* ========================================
       MOTIVATION BANNER - PROVIDER ONLY
       ======================================== */
    .motivation-banner {
        border-radius: var(--border-radius-xl);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        border: 2px solid;
        animation: slideIn 0.5s ease-out;
    }
    
    @keyframes slideIn {
        from { 
            opacity: 0;
            transform: translateY(-10px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .motivation-emoji {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .motivation-title {
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .motivation-message {
        font-size: 0.875rem;
        line-height: 1.4;
        color: #374151;
        margin-bottom: 0.75rem;
    }
    
    .motivation-next {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.375rem 0.875rem;
        background: white;
        border-radius: 999px;
        box-shadow: var(--shadow-sm);
    }
    
    /* ========================================
       PROGRESS SECTION - PROVIDER ONLY
       ======================================== */
    .progress-section {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .progress-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    
    .progress-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
    }
    
    .progress-points-badge {
        background: #eff6ff;
        color: var(--color-primary);
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .progress-bar-container {
        position: relative;
        height: 8px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        border-radius: 999px;
        transition: width 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .progress-milestones {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }
    
    .progress-milestone {
        text-align: center;
        padding: 0.875rem 0.5rem;
        border-radius: var(--border-radius-md);
        background: var(--color-bg-secondary);
        transition: var(--transition-base);
    }
    
    .progress-milestone.active {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }
    
    .progress-milestone-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-size: 0.875rem;
        transition: var(--transition-base);
    }
    
    .progress-milestone.active .progress-milestone-icon {
        background: var(--color-primary);
        color: white;
    }
    
    .progress-milestone-label {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }
    
    .progress-milestone.active .progress-milestone-label {
        color: var(--color-primary);
    }
    
    .progress-milestone-points {
        font-size: 0.625rem;
        color: var(--color-text-tertiary);
    }
    
    /* Diamond Circle - PROVIDER ONLY */
    .diamond-circle-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-xl);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .diamond-circle-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-align: center;
    }
    
    .diamond-circle-svg {
        position: relative;
        width: 120px;
        height: 120px;
    }
    
    .diamond-circle-percentage {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-primary);
    }
    
    .diamond-circle-description {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
        text-align: center;
    }
    
    /* ========================================
       TIMELINE - MOBILE FIRST
       ======================================== */
    .timeline-card {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-lg);
        padding: 1.25rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .timeline-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .timeline-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .timeline-title i {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
    }
    
    .timeline-badge {
        background: var(--color-bg-secondary);
        color: var(--color-text-secondary);
        font-size: 0.6875rem;
        font-weight: 600;
        padding: 0.25rem 0.625rem;
        border-radius: 999px;
    }
    
    .timeline-list {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }
    
    .timeline-item {
        display: flex;
        gap: 0.875rem;
        padding: 0.875rem;
        border-radius: var(--border-radius-md);
        background: var(--color-bg-secondary);
        transition: var(--transition-base);
        text-decoration: none !important;
        color: inherit !important;
        border: 1px solid transparent;
        pointer-events: auto !important;
    }
    
    .timeline-item:active {
        transform: scale(0.98);
    }
    
    .timeline-icon {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        border-radius: var(--border-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8125rem;
        pointer-events: none;
    }
    
    .timeline-icon.success { background: #d1fae5; color: #059669; }
    .timeline-icon.info { background: #dbeafe; color: #2563eb; }
    .timeline-icon.warning { background: #fef3c7; color: #d97706; }
    .timeline-icon.message { background: #f3e8ff; color: #7c3aed; }
    .timeline-icon.money { background: #d1fae5; color: #059669; }
    
    .timeline-content {
        flex: 1;
        min-width: 0;
        pointer-events: none;
    }
    
    .timeline-time {
        font-size: 0.625rem;
        color: var(--color-text-tertiary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    
    .timeline-text {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text-primary);
        margin-bottom: 0.125rem;
        line-height: 1.4;
    }
    
    .timeline-subtext {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
        line-height: 1.4;
    }
    
    .timeline-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--color-text-tertiary);
    }
    
    .timeline-empty-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        opacity: 0.4;
    }
    
    .timeline-empty-text {
        font-size: 0.8125rem;
        font-weight: 500;
    }
    
    /* ========================================
       ACTION CARDS - MOBILE FIRST
       ======================================== */
    .action-card {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-lg);
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition-base);
        text-decoration: none !important;
        display: block;
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        color: inherit !important;
        min-height: 110px;
    }
    
    button.action-card {
        width: 100%;
        border: 2px solid #cbd5e1;
        font-family: inherit;
        background: var(--color-bg-primary);
    }
    
    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--card-color, var(--color-primary));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .action-card:hover::before {
        transform: scaleX(1);
    }
    
    .action-card:active {
        transform: scale(0.98);
    }
    
    .action-card-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--border-radius-md);
        background: var(--icon-bg, #f1f5f9);
        color: var(--icon-color, var(--color-primary));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.875rem;
        font-size: 1.125rem;
        transition: var(--transition-base);
        pointer-events: none;
    }
    
    .action-card-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.25rem;
        line-height: 1;
        pointer-events: none;
    }
    
    .action-card-label {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
        font-weight: 500;
        pointer-events: none;
        line-height: 1.3;
    }
    
    /* ========================================
       SECTION HEADERS
       ======================================== */
    .section-header {
        margin-bottom: 1.25rem;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        letter-spacing: -0.02em;
    }
    
    /* ========================================
       GRID LAYOUTS - MOBILE FIRST
       ======================================== */
    .grid-dashboard {
        display: grid;
        gap: 1rem;
        grid-template-columns: 1fr;
    }
    
    .grid-timeline {
        display: grid;
        gap: 1rem;
        grid-template-columns: 1fr;
    }
    
    /* ========================================
       Z-INDEX MANAGEMENT
       ======================================== */
    .share-modal-overlay {
        z-index: 9998 !important;
    }
    
    .share-modal {
        z-index: 9999 !important;
    }
    
    #searchPopup,
    #expatriesPopup,
    #vacanciersAutresBesoinsPopup {
        z-index: 10000 !important;
    }
    
    /* ========================================
       TOAST NOTIFICATIONS
       ======================================== */
    .toast-notification {
        position: fixed;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
        max-width: 400px;
        margin: 0 auto;
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        box-shadow: var(--shadow-xl);
        z-index: 10001;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border: 1px solid #e5e7eb;
        animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes slideUp {
        from { transform: translateY(100px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .toast-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        flex-shrink: 0;
    }
    
    .toast-icon.success { background: #d1fae5; color: #059669; }
    .toast-icon.error { background: #fee2e2; color: #dc2626; }
    .toast-icon.info { background: #dbeafe; color: #2563eb; }
    
    .toast-message {
        flex: 1;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text-primary);
    }
    
    /* ========================================
       RESPONSIVE - TABLET & DESKTOP
       ======================================== */
    @media (min-width: 640px) {
        .dashboard-2025 {
            padding: 1.5rem;
        }
        
        .grid-dashboard {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .grid-timeline {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .stat-card-2025 {
            padding: 1.5rem;
        }
        
        .stat-card-icon {
            width: 44px;
            height: 44px;
            font-size: 1.25rem;
        }
        
        .stat-value-2025 {
            font-size: 1.875rem;
        }
        
        .stat-label-2025 {
            font-size: 0.8125rem;
        }
        
        .stat-card-action {
            opacity: 0;
        }
        
        .stat-card-2025:hover {
            border-color: #94a3b8;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .stat-card-2025:hover .stat-card-action {
            opacity: 1;
        }
        
        .stat-card-2025:hover .stat-card-icon {
            transform: scale(1.05);
        }
        
        .timeline-item:hover {
            background: var(--color-bg-tertiary);
            border-color: #e2e8f0;
            transform: translateX(4px);
        }
        
        .action-card:hover {
            border-color: #94a3b8;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .action-card:hover .action-card-icon {
            transform: scale(1.1);
        }
        
        .share-option:hover {
            background: var(--color-bg-tertiary);
            border-color: #e2e8f0;
            transform: translateY(-2px);
        }
        
        .affiliate-copy-btn:hover {
            background: var(--color-primary-light);
        }
        
        .share-options-grid {
            grid-template-columns: repeat(5, 1fr);
        }
        
        .affiliate-link-section {
            flex-direction: row;
            align-items: center;
        }
        
        .affiliate-copy-btn {
            width: auto;
        }
        
        .affiliate-link-input {
            font-size: 0.8125rem;
        }
        
        .share-modal-title {
            font-size: 1.25rem;
        }
        
        .share-stat-value {
            font-size: 1.5rem;
        }
        
        .motivation-emoji {
            font-size: 2.5rem;
        }
        
        .motivation-title {
            font-size: 1.25rem;
        }
        
        .progress-milestones {
            grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
        }
        
        .diamond-circle-svg {
            width: 140px;
            height: 140px;
        }
        
        .diamond-circle-percentage {
            font-size: 1.75rem;
        }
    }
    
    @media (min-width: 1024px) {
        .dashboard-2025 {
            padding: 2rem;
        }
        
        .grid-dashboard {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        
        .share-modal {
            position: fixed;
            bottom: auto;
            top: 50%;
            left: 50%;
            right: auto;
            transform: translate(-50%, -50%) scale(0.9);
            border-radius: var(--border-radius-xl);
            max-width: 520px;
            width: 90%;
            opacity: 0;
            max-height: none;
        }
        
        .share-modal.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
    }
    
    /* ========================================
       REDUCED MOTION
       ======================================== */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="dashboard-2025">
    
    @php
        $user = auth()->user();
        $provider = $user->serviceProvider ?? null;
        $hasProviderProfile = $provider !== null;
        $unreadMessagesCount = method_exists($user, 'unreadMessagesCount') ? $user->unreadMessagesCount() : 0;
        
        // ========================================
        // MESSAGES DE MOTIVATION (PROVIDER ONLY)
        // ========================================
        $motivationMessages = [
            0 => [
                'emoji' => '🚀',
                'title' => 'Begin Your Journey!',
                'message' => 'Complete your first mission to start building your reputation on Ulixai!',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
                'border' => '#bfdbfe'
            ],
            20 => [
                'emoji' => '🌟',
                'title' => 'Great Start!',
                'message' => 'You\'re doing amazing! Keep delivering quality service to reach the next level!',
                'color' => '#10b981',
                'bg' => '#d1fae5',
                'border' => '#a7f3d0'
            ],
            40 => [
                'emoji' => '🔥',
                'title' => 'On Fire!',
                'message' => 'Impressive progress! Your clients are loving your work. Keep it up!',
                'color' => '#f59e0b',
                'bg' => '#fef3c7',
                'border' => '#fde68a'
            ],
            60 => [
                'emoji' => '⚡',
                'title' => 'Unstoppable!',
                'message' => 'You\'re crushing it! The next milestone is just around the corner!',
                'color' => '#8b5cf6',
                'bg' => '#f3e8ff',
                'border' => '#e9d5ff'
            ],
            80 => [
                'emoji' => '💎',
                'title' => 'Almost Diamond!',
                'message' => 'Incredible work! Just a few more missions to reach Diamond status!',
                'color' => '#06b6d4',
                'bg' => '#cffafe',
                'border' => '#a5f3fc'
            ],
            95 => [
                'emoji' => '👑',
                'title' => 'Elite Provider!',
                'message' => 'You\'re among the best on Ulixai! Diamond level achieved - you\'re a legend!',
                'color' => '#6366f1',
                'bg' => '#eef2ff',
                'border' => '#c7d2fe'
            ]
        ];
        
        // ========================================
        // RÉCUPÉRATION DES ACTIVITÉS RÉCENTES
        // ========================================
        $recentActivities = collect();
        
        try {
            $recentConversations = \App\Models\Conversation::where(function($query) use ($user) {
                $query->where('requester_id', $user->id)
                      ->orWhere('provider_id', $user->id);
            })
            ->where('updated_at', '>=', now()->subDays(7))
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();
            
            foreach($recentConversations as $conv) {
                $recentActivities->push([
                    'type' => 'message',
                    'date' => $conv->updated_at,
                    'title' => 'New message',
                    'subtitle' => 'Conversation updated',
                    'url' => route('conversations.show', $conv->id),
                    'icon' => 'comment-dots'
                ]);
            }
        } catch (\Exception $e) {}
        
        if ($hasProviderProfile) {
            try {
                $recentMissions = $provider->missions()
                    ->where('updated_at', '>=', now()->subDays(7))
                    ->orderByDesc('updated_at')
                    ->limit(10)
                    ->get();
                
                foreach($recentMissions as $mission) {
                    $statusMap = [
                        'completed' => ['icon' => 'check-circle', 'text' => 'Mission completed', 'type' => 'success'],
                        'in_progress' => ['icon' => 'clock', 'text' => 'Mission in progress', 'type' => 'info'],
                        'pending' => ['icon' => 'hourglass-half', 'text' => 'Mission pending', 'type' => 'warning'],
                    ];
                    $status = $statusMap[$mission->status] ?? $statusMap['pending'];
                    
                    $recentActivities->push([
                        'type' => $status['type'],
                        'date' => $mission->updated_at,
                        'title' => $status['text'],
                        'subtitle' => $mission->title ?? 'Untitled mission',
                        'url' => route('view-job', ['id' => $mission->id]),
                        'icon' => $status['icon']
                    ]);
                }
            } catch (\Exception $e) {}
            
            try {
                if (class_exists(\App\Models\Payment::class)) {
                    $recentPayments = \App\Models\Payment::where('service_provider_id', $provider->id)
                        ->where('created_at', '>=', now()->subDays(7))
                        ->where('status', 'completed')
                        ->orderByDesc('created_at')
                        ->limit(10)
                        ->get();
                    
                    foreach($recentPayments as $payment) {
                        $recentActivities->push([
                            'type' => 'money',
                            'date' => $payment->created_at,
                            'title' => 'Payment received',
                            'subtitle' => number_format($payment->amount, 2) . '€',
                            'url' => route('user.payments.validate'),
                            'icon' => 'money-bill-wave'
                        ]);
                    }
                }
            } catch (\Exception $e) {}
        }
        
        try {
            $requesterMissions = \App\Models\Mission::where('requester_id', $user->id)
                ->where('created_at', '>=', now()->subDays(7))
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();
            
            foreach($requesterMissions as $mission) {
                $recentActivities->push([
                    'type' => 'info',
                    'date' => $mission->created_at,
                    'title' => 'Service request created',
                    'subtitle' => $mission->title ?? 'Service request',
                    'url' => route('user.service.requests'),
                    'icon' => 'briefcase'
                ]);
            }
        } catch (\Exception $e) {}
        
        try {
            if (method_exists($user, 'commissions')) {
                $recentCommissions = $user->commissions()
                    ->where('created_at', '>=', now()->subDays(7))
                    ->orderByDesc('created_at')
                    ->limit(10)
                    ->get();
                
                foreach($recentCommissions as $commission) {
                    $recentActivities->push([
                        'type' => 'money',
                        'date' => $commission->created_at,
                        'title' => 'Affiliate commission earned',
                        'subtitle' => number_format($commission->amount, 2) . '€',
                        'url' => route('user.affiliate.account'),
                        'icon' => 'coins'
                    ]);
                }
            }
        } catch (\Exception $e) {}
        
        $recentActivities = $recentActivities->sortByDesc('date')->take(10);
        
        // ========================================
        // UPCOMING EVENTS
        // ========================================
        $upcomingEvents = collect();
        
        if ($hasProviderProfile) {
            try {
                $upcomingMissions = $provider->missions()
                    ->where('status', 'in_progress')
                    ->whereNotNull('deadline')
                    ->where('deadline', '>=', now())
                    ->where('deadline', '<=', now()->addDays(14))
                    ->orderBy('deadline')
                    ->get();
                
                foreach($upcomingMissions as $mission) {
                    $daysUntil = now()->diffInDays($mission->deadline, false);
                    $upcomingEvents->push([
                        'type' => 'warning',
                        'date' => $mission->deadline,
                        'title' => 'Mission deadline',
                        'subtitle' => ($mission->title ?? 'Untitled') . ' - ' . ($daysUntil == 0 ? 'Today' : "in {$daysUntil} days"),
                        'url' => route('view-job', ['id' => $mission->id]),
                        'icon' => 'calendar-exclamation',
                        'urgent' => $daysUntil <= 2
                    ]);
                }
            } catch (\Exception $e) {}
            
            if (isset($provider->kyc_status) && $provider->kyc_status != 'verified' && isset($provider->stripe_account_id) && $provider->stripe_account_id) {
                $upcomingEvents->push([
                    'type' => 'warning',
                    'date' => now()->addDays(1),
                    'title' => 'Complete KYC verification',
                    'subtitle' => 'Required to receive payouts',
                    'url' => '#kyc-banner',
                    'icon' => 'shield-halved',
                    'urgent' => true
                ]);
            }
        }
        
        $upcomingEvents = $upcomingEvents->sortBy('date');
        
        // ========================================
        // COMPTEURS
        // ========================================
        try {
            $serviceRequestsCount = \App\Models\Mission::where('requester_id', $user->id)->count();
        } catch (\Exception $e) {
            $serviceRequestsCount = 0;
        }
        
        $in_progress = $hasProviderProfile ? $provider->missions->where('status', 'in_progress')->count() : 0;
        
        try {
            $pendingPayments = 0;
            if ($hasProviderProfile && class_exists(\App\Models\Payment::class)) {
                $pendingPayments = \App\Models\Payment::where('service_provider_id', $provider->id)
                    ->where('status', 'pending')
                    ->count();
            }
        } catch (\Exception $e) {
            $pendingPayments = 0;
        }
        
        // ========================================
        // PROGRESSION (PROVIDER ONLY)
        // ========================================
        $points = $hasProviderProfile ? ($reputationPoints ?? 0) : 0;
        $progress = $hasProviderProfile ? ($progressLevel ?? 0) : 0;
        
        $currentMotivation = null;
        if ($hasProviderProfile) {
            $currentMotivation = collect($motivationMessages)->filter(fn($msg, $level) => $progress >= $level)->last();
        }
        
        // Cercle Diamond
        $circleRadius = 32;
        $circleCircumference = 2 * pi() * $circleRadius;
        $offset = $circleCircumference - ($progress / 100 * $circleCircumference);
        
    @endphp

    <!-- ========================================
         STATS CARDS - MOBILE FIRST
         ======================================== -->
    <div class="section-header">
        <h1 class="section-title">Overview</h1>
    </div>
    
    <div class="grid-dashboard" style="margin-bottom: 1.5rem;">
        
        @if($hasProviderProfile && isset($balance))
            <a href="/my-earning-payment" class="stat-card-2025" data-card-type="link" style="--card-accent: var(--color-success); --icon-bg: #d1fae5; --icon-color: #059669;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $balance['available'] ?? '0.00' }}€</div>
                        <div class="stat-label-2025">Available Balance</div>
                    </div>
                </div>
                <div class="stat-card-action">
                    <span>View</span>
                    <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
                </div>
            </a>
            
            <a href="{{ route('user.joblist') }}" class="stat-card-2025" data-card-type="link" style="--card-accent: var(--color-primary); --icon-bg: #dbeafe; --icon-color: #2563eb;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $in_progress }}</div>
                        <div class="stat-label-2025">Jobs In Progress</div>
                    </div>
                </div>
                <div class="stat-card-action">
                    <span>View</span>
                    <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
                </div>
            </a>
        @endif
        
        <a href="{{ route('user.service.requests') }}" class="stat-card-2025" data-card-type="link" style="--card-accent: var(--color-purple); --icon-bg: #f3e8ff; --icon-color: #7c3aed;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ $serviceRequestsCount }}</div>
                    <div class="stat-label-2025">My Service Requests</div>
                </div>
            </div>
            <div class="stat-card-action">
                <span>View</span>
                <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
            </div>
        </a>
        
        <a href="{{ route('user.conversation') }}" class="stat-card-2025" data-card-type="link" style="--card-accent: var(--color-pink); --icon-bg: #fce7f3; --icon-color: #db2777;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ $unreadMessagesCount }}</div>
                    <div class="stat-label-2025">Unread Messages</div>
                </div>
            </div>
            <div class="stat-card-action">
                <span>View</span>
                <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
            </div>
        </a>
        
        <button type="button" class="stat-card-2025" id="btn-affiliate-share" data-card-type="modal" style="--card-accent: var(--color-warning); --icon-bg: #fef3c7; --icon-color: #d97706;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">75%</div>
                    <div class="stat-label-2025">Referral Commission</div>
                    <div class="stat-card-extra">
                        {{ $user->referrals()->count() }} referrals · {{ number_format($user->commissions->sum('amount'), 2) }}€
                    </div>
                </div>
            </div>
            <div class="stat-card-action">
                <span>Share</span>
                <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
            </div>
        </button>
        
        <a href="{{ route('user.affiliate.account') }}" class="stat-card-2025" data-card-type="link" style="--card-accent: #14b8a6; --icon-bg: #ccfbf1; --icon-color: #0d9488;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ number_format($user->commissions->sum('amount'), 2) }}€</div>
                    <div class="stat-label-2025">Commission Earned</div>
                </div>
            </div>
            <div class="stat-card-action">
                <span>View</span>
                <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
            </div>
        </a>
        
        @if($hasProviderProfile)
            <a href="{{ route('user.payments.validate') }}" class="stat-card-2025" data-card-type="link" style="--card-accent: #f97316; --icon-bg: #ffedd5; --icon-color: #ea580c;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $pendingPayments }}</div>
                        <div class="stat-label-2025">Payments to Validate</div>
                    </div>
                </div>
                <div class="stat-card-action">
                    <span>View</span>
                    <i class="fas fa-arrow-right" style="font-size: 0.625rem;"></i>
                </div>
            </a>
        @endif
    </div>

    <!-- ========================================
         MODAL AFFILIATION
         ======================================== -->
    <div class="share-modal-overlay" id="share-overlay"></div>
    <div class="share-modal" id="share-modal">
        <div class="share-modal-header">
            <h3 class="share-modal-title">Share & Earn 75%</h3>
            <button class="share-modal-close" id="btn-close-share">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="share-stats-grid">
            <div class="share-stat">
                <div class="share-stat-value">{{ $user->referrals()->count() }}</div>
                <div class="share-stat-label">Referrals</div>
            </div>
            <div class="share-stat">
                <div class="share-stat-value success">{{ number_format($user->commissions->sum('amount'), 2) }}€</div>
                <div class="share-stat-label">Earned</div>
            </div>
            <div class="share-stat">
                <div class="share-stat-value primary">75%</div>
                <div class="share-stat-label">Commission</div>
            </div>
        </div>
        
        <div style="margin-bottom: 1.25rem;">
            <label class="share-section-label">Your referral link</label>
            <div class="affiliate-link-section">
                <input 
                    id="affiliate-link-input" 
                    type="text" 
                    readonly 
                    value="{{ config('app.url') }}/affiliate/sign-up/?code={{ $user->affiliate_code }}" 
                    class="affiliate-link-input"
                />
                <button class="affiliate-copy-btn" id="copy-btn">
                    <i class="fas fa-copy"></i>
                    <span>Copy</span>
                </button>
            </div>
        </div>
        
        <div>
            <label class="share-section-label">Share via</label>
            <div class="share-options-grid">
                <button class="share-option" data-platform="whatsapp">
                    <div class="share-option-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <span class="share-option-label">WhatsApp</span>
                </button>
                
                <button class="share-option" data-platform="email">
                    <div class="share-option-icon email">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span class="share-option-label">Email</span>
                </button>
                
                <button class="share-option" data-platform="facebook">
                    <div class="share-option-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <span class="share-option-label">Facebook</span>
                </button>
                
                <button class="share-option" data-platform="linkedin">
                    <div class="share-option-icon linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <span class="share-option-label">LinkedIn</span>
                </button>
                
                <button class="share-option" data-platform="twitter">
                    <div class="share-option-icon twitter">
                        <i class="fab fa-x-twitter"></i>
                    </div>
                    <span class="share-option-label">X</span>
                </button>
            </div>
        </div>
    </div>

    @if($hasProviderProfile && isset($reputationPoints))
        <!-- ========================================
             MOTIVATION BANNER - PROVIDER ONLY
             ======================================== -->
        @if($currentMotivation)
        <div class="motivation-banner" style="background: {{ $currentMotivation['bg'] }}; border-color: {{ $currentMotivation['border'] }};">
            <div class="motivation-emoji">{{ $currentMotivation['emoji'] }}</div>
            <h3 class="motivation-title" style="color: {{ $currentMotivation['color'] }};">
                {{ $currentMotivation['title'] }}
            </h3>
            <p class="motivation-message">{{ $currentMotivation['message'] }}</p>
            @php
                $badges = \App\Models\Badge::where('type', 'reputation')->where('is_auto', true)->orderBy('threshold')->get();
                $nextBadge = $badges->where('threshold', '>', $points)->first();
            @endphp
            @if($nextBadge)
            <div class="motivation-next" style="color: {{ $currentMotivation['color'] }};">
                <span>Next milestone:</span>
                <strong>+{{ $nextBadge->threshold - $points }} pts</strong>
                <span>→ {{ $nextBadge->title }}</span>
            </div>
            @endif
        </div>
        @endif
        
        <!-- ========================================
             PROGRESS & DIAMOND CIRCLE - PROVIDER ONLY
             ======================================== -->
        @php
            $badges = \App\Models\Badge::where('type', 'reputation')
                ->where('is_auto', true)
                ->orderBy('threshold')
                ->get();
        @endphp
        
        @if($badges->count() > 0)
        <div class="grid-dashboard" style="margin-bottom: 1.5rem;">
            
            <!-- Barre de progression -->
            <div class="progress-section" style="grid-column: 1 / -1;">
                <div class="progress-header">
                    <h3 class="progress-title">Reputation Progress</h3>
                    <div class="progress-points-badge">
                        {{ $points }} / {{ $badges->max('threshold') }} pts
                    </div>
                </div>
                
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ $progress }}%;"></div>
                </div>
                
                <div class="progress-milestones">
                    @foreach($badges as $badge)
                        <div class="progress-milestone {{ $points >= $badge->threshold ? 'active' : '' }}">
                            <div class="progress-milestone-icon">
                                <i class="fas fa-{{ $points >= $badge->threshold ? 'check' : 'lock' }}"></i>
                            </div>
                            <div class="progress-milestone-label">{{ $badge->title }}</div>
                            <div class="progress-milestone-points">{{ $badge->threshold }} pts</div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Cercle Diamond -->
            <div class="diamond-circle-container">
                <h3 class="diamond-circle-title">Diamond Ulysse Progress</h3>
                <div class="diamond-circle-svg">
                    <svg width="100%" height="100%" viewBox="0 0 80 80">
                        <circle
                            cx="40"
                            cy="40"
                            r="{{ $circleRadius }}"
                            stroke="#e5e7eb"
                            stroke-width="6"
                            fill="none"
                        />
                        <circle
                            cx="40"
                            cy="40"
                            r="{{ $circleRadius }}"
                            stroke="#3b82f6"
                            stroke-width="6"
                            fill="none"
                            stroke-dasharray="{{ $circleCircumference }}"
                            stroke-dashoffset="{{ $offset }}"
                            stroke-linecap="round"
                            style="transform: rotate(-90deg); transform-origin: 50% 50%; transition: stroke-dashoffset 0.7s ease-out;"
                        />
                    </svg>
                    <div class="diamond-circle-percentage">{{ $progress }}%</div>
                </div>
                <p class="diamond-circle-description">
                    You have earned <strong>{{ $points }} pts</strong> out of {{ $badges->max('threshold') }}.
                </p>
            </div>
            
        </div>
        @endif
    @endif

    <!-- ========================================
         ACTIVITY TIMELINE - MOBILE FIRST
         ======================================== -->
    <div class="section-header">
        <h2 class="section-title">Activity</h2>
    </div>
    
    <div class="grid-timeline" style="margin-bottom: 1.5rem;">
        
        <div class="timeline-card">
            <div class="timeline-header">
                <h3 class="timeline-title">
                    <i class="fas fa-clock-rotate-left"></i>
                    Recent
                </h3>
                <span class="timeline-badge">Last 7 days</span>
            </div>
            
            <div class="timeline-list">
                @forelse($recentActivities as $activity)
                    <a href="{{ $activity['url'] }}" class="timeline-item" data-item-type="link">
                        <div class="timeline-icon {{ $activity['type'] }}">
                            <i class="fas fa-{{ $activity['icon'] }}"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-time">{{ $activity['date']->diffForHumans() }}</div>
                            <div class="timeline-text">{{ $activity['title'] }}</div>
                            <div class="timeline-subtext">{{ $activity['subtitle'] }}</div>
                        </div>
                    </a>
                @empty
                    <div class="timeline-empty">
                        <div class="timeline-empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="timeline-empty-text">No recent activity</div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="timeline-card">
            <div class="timeline-header">
                <h3 class="timeline-title">
                    <i class="fas fa-calendar-days"></i>
                    Upcoming
                </h3>
                <span class="timeline-badge">Next 14 days</span>
            </div>
            
            <div class="timeline-list">
                @forelse($upcomingEvents as $event)
                    <a href="{{ $event['url'] }}" class="timeline-item" data-item-type="link">
                        <div class="timeline-icon {{ $event['type'] }}">
                            <i class="fas fa-{{ $event['icon'] }}"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-time">{{ $event['date']->format('M j, Y') }}</div>
                            <div class="timeline-text">
                                {{ $event['title'] }}
                                @if(isset($event['urgent']) && $event['urgent'])
                                    <i class="fas fa-exclamation-circle" style="color: var(--color-warning); margin-left: 0.25rem;"></i>
                                @endif
                            </div>
                            <div class="timeline-subtext">{{ $event['subtitle'] }}</div>
                        </div>
                    </a>
                @empty
                    <div class="timeline-empty">
                        <div class="timeline-empty-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="timeline-empty-text">Nothing scheduled</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ========================================
         QUICK ACTIONS - MOBILE FIRST
         ======================================== -->
    <div class="section-header">
        <h2 class="section-title">Quick Actions</h2>
    </div>
    
    <div class="grid-dashboard" style="margin-bottom: 3rem;">
        
        <button type="button" class="action-card" id="btn-create-request" data-action-type="popup" style="--card-color: var(--color-purple); --icon-bg: #f3e8ff; --icon-color: #7c3aed;">
            <div class="action-card-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="action-card-value"><i class="fas fa-plus" style="font-size: 1.25rem;"></i></div>
            <div class="action-card-label">Create Service Request</div>
        </button>
        
        <a href="{{ route('user.service.requests') }}" class="action-card" data-action-type="link" style="--card-color: var(--color-primary); --icon-bg: #dbeafe; --icon-color: #2563eb;">
            <div class="action-card-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="action-card-value">{{ $serviceRequestsCount }}</div>
            <div class="action-card-label">My Service Requests</div>
        </a>
        
        @if($hasProviderProfile)
            <a href="{{ route('user.joblist') }}" class="action-card" data-action-type="link" style="--card-color: var(--color-success); --icon-bg: #d1fae5; --icon-color: #059669;">
                <div class="action-card-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="action-card-value">{{ $in_progress }}</div>
                <div class="action-card-label">Jobs to Complete</div>
            </a>
            
            <a href="{{ route('user.payments.validate') }}" class="action-card" data-action-type="link" style="--card-color: var(--color-warning); --icon-bg: #fef3c7; --icon-color: #d97706;">
                <div class="action-card-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="action-card-value">{{ $pendingPayments }}</div>
                <div class="action-card-label">Payments to Validate</div>
            </a>
        @endif
    </div>

</div>

<script>
(function() {
    'use strict';
    
    console.log('🚀 Dashboard Production Ready - Mobile First');
    
    function showToast(type, message) {
        const existing = document.querySelector('.toast-notification');
        if (existing) existing.remove();
        
        const icons = {
            success: 'fa-circle-check',
            error: 'fa-circle-xmark',
            info: 'fa-circle-info'
        };
        
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = `
            <div class="toast-icon ${type}">
                <i class="fas ${icons[type] || icons.info}"></i>
            </div>
            <div class="toast-message">${message}</div>
        `;
        
        document.body.appendChild(toast);
        
        if ('vibrate' in navigator) {
            navigator.vibrate(type === 'success' ? 25 : 50);
        }
        
        setTimeout(() => {
            toast.style.animation = 'slideUp 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    function copyAffiliateLink() {
        const input = document.getElementById('affiliate-link-input');
        const btn = document.getElementById('copy-btn');
        
        if (!input || !btn) return;
        
        const originalHTML = btn.innerHTML;
        
        navigator.clipboard.writeText(input.value)
            .then(() => {
                btn.innerHTML = '<i class="fas fa-check"></i><span>Copied!</span>';
                showToast('success', 'Link copied to clipboard');
                
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            })
            .catch(() => {
                showToast('error', 'Failed to copy link');
            });
    }
    
    function openShareModal() {
        const overlay = document.getElementById('share-overlay');
        const modal = document.getElementById('share-modal');
        
        if (overlay && modal) {
            overlay.classList.add('active');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeShareModal() {
        const overlay = document.getElementById('share-overlay');
        const modal = document.getElementById('share-modal');
        
        if (overlay && modal) {
            overlay.classList.remove('active');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    function shareVia(platform) {
        const input = document.getElementById('affiliate-link-input');
        if (!input) return;
        
        const url = input.value;
        const encodedUrl = encodeURIComponent(url);
        
        const messages = {
            whatsapp: "🌍 Hey! I'm using Ulixai to find trusted service providers as an expat. Join me and get expert help worldwide!",
            email: {
                subject: "Discover Ulixai - Your Trusted Expat Service Marketplace",
                body: "Hi,\n\nI wanted to share this amazing platform: Ulixai.\n\nIt connects expats with verified service providers in 197 countries.\n\nCheck it out: "
            },
            default: "Discover Ulixai - Your trusted expat service marketplace"
        };
        
        let shareUrl;
        
        switch(platform) {
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(messages.whatsapp + '\n\n' + url)}`;
                break;
            case 'email':
                shareUrl = `mailto:?subject=${encodeURIComponent(messages.email.subject)}&body=${encodeURIComponent(messages.email.body + url)}`;
                break;
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodeURIComponent(messages.default)}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
            showToast('success', `Shared via ${platform.charAt(0).toUpperCase() + platform.slice(1)}`);
            closeShareModal();
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ DOM Ready');
        
        const overlay = document.getElementById('share-overlay');
        const modal = document.getElementById('share-modal');
        if (overlay) overlay.classList.remove('active');
        if (modal) modal.classList.remove('active');
        
        const btnCreateRequest = document.getElementById('btn-create-request');
        if (btnCreateRequest) {
            btnCreateRequest.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (typeof openHelpPopup === 'function') {
                    openHelpPopup();
                } else {
                    showToast('error', 'Category popup not available');
                }
            });
        }
        
        const btnAffiliateShare = document.getElementById('btn-affiliate-share');
        if (btnAffiliateShare) {
            btnAffiliateShare.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openShareModal();
            });
        }
        
        const copyBtn = document.getElementById('copy-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                copyAffiliateLink();
            });
        }
        
        const shareButtons = document.querySelectorAll('.share-option');
        shareButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const platform = this.getAttribute('data-platform');
                if (platform) {
                    shareVia(platform);
                }
            });
        });
        
        const btnCloseShare = document.getElementById('btn-close-share');
        if (btnCloseShare) {
            btnCloseShare.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeShareModal();
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeShareModal();
                }
            });
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeShareModal();
            }
        });
        
        console.log('✅ Dashboard initialized successfully');
    });
    
})();
</script>

@endsection

@include('wizards.requester.steps.popup_request_help')

@push('scripts')
<script src="{{ asset('js/category-popups.js') }}"></script>
<script src="{{ asset('js/categoryColors.js') }}"></script>
@endpush