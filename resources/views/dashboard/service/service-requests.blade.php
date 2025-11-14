@extends('dashboard.layouts.master')

@section('title', 'Service Cards')

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
    
    .services-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        background: #ffffff;
        min-height: 100vh;
    }
    
    .services-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .services-title-main {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin: 0;
    }
    
    /* BOUTON PREMIUM UNIFIÉ */
    .btn-premium {
        background: linear-gradient(135deg, var(--color-gradient-start) 0%, var(--color-gradient-mid) 50%, var(--color-gradient-end) 100%);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: var(--border-radius-lg);
        font-weight: 700;
        font-size: 0.875rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.4);
        position: relative;
        overflow: hidden;
        -webkit-user-select: none;
        user-select: none;
        touch-action: manipulation;
    }
    
    .btn-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-premium:hover::before,
    .btn-premium:focus::before {
        left: 100%;
    }
    
    .btn-premium:hover,
    .btn-premium:focus {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.5);
    }
    
    .btn-premium:active {
        transform: translateY(0) scale(0.98);
    }
    
    .btn-premium:focus {
        outline: 3px solid rgba(99, 102, 241, 0.5);
        outline-offset: 2px;
    }
    
    .btn-premium i {
        font-size: 1rem;
    }
    
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
        padding: 0.5rem;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        line-height: 1;
    }
    
    .stat-value.active { color: var(--color-success); }
    .stat-value.published { color: var(--color-warning); }
    .stat-value.completed { color: var(--color-text-secondary); }
    
    .stat-label {
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        line-height: 1.2;
    }
    
    /* TABS ULTRA-VISIBLES */
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
        background: rgba(255, 255, 255, 0.5);
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
    
    .filters-bar {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        align-items: stretch;
    }
    
    .search-box {
        flex: 1 1 100%;
        min-width: 200px;
        position: relative;
    }
    
    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        transition: var(--transition-base);
        -webkit-appearance: none;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--color-text-tertiary);
        pointer-events: none;
    }
    
    .filter-select {
        flex: 1 1 calc(50% - 0.25rem);
        min-width: 120px;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        background: white;
        transition: var(--transition-base);
        -webkit-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        padding-right: 2.5rem;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
    
    .services-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .service-card-2025 {
        background: var(--color-bg-primary);
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        transition: var(--transition-base);
        position: relative;
        overflow: hidden;
        will-change: transform;
    }
    
    .service-card-2025:hover {
        border-color: #94a3b8;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    .service-card-published {
        background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        border-color: #fdba74;
    }
    
    .card-header-row {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 0.875rem;
    }
    
    .service-icon-2025 {
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
    
    .service-icon-published {
        background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
    }
    
    .card-content-main {
        flex: 1;
        min-width: 0;
    }
    
    .service-title-2025 {
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
    
    .status-badge-in-progress {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .status-badge-completed {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-badge-disputed {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .status-badge-waiting {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-badge-published {
        background: #fff7ed;
        color: #9a3412;
        border: 1px solid #fdba74;
    }
    
    .urgency-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.5rem;
        border-radius: 999px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .urgency-high {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .urgency-medium {
        background: #fef3c7;
        color: #92400e;
    }
    
    .urgency-low {
        background: #d1fae5;
        color: #065f46;
    }
    
    .countdown-inline {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
        font-weight: 600;
    }
    
    .progress-bar-wrapper {
        margin-bottom: 0.875rem;
    }
    
    .progress-bar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.375rem;
    }
    
    .progress-label {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
    }
    
    .progress-value {
        font-size: 0.6875rem;
        font-weight: 700;
        color: var(--color-primary);
    }
    
    .progress-bar-track {
        height: 6px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }
    
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        transition: width 0.5s ease;
        border-radius: 999px;
    }
    
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
    
    .proposals-highlight {
        padding: 0.875rem;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: var(--border-radius-md);
        margin-bottom: 0.875rem;
        border: 2px solid #fbbf24;
    }
    
    .proposals-title {
        font-size: 0.8125rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .proposals-count-big {
        font-size: 1.375rem;
        font-weight: 700;
        color: #92400e;
        line-height: 1;
    }
    
    .new-badge {
        background: var(--color-danger);
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 999px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        animation: pulse 2s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }
    
    .price-range-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.625rem;
        background: rgba(255, 255, 255, 0.6);
        border-radius: var(--border-radius-sm);
        margin-top: 0.5rem;
        gap: 0.5rem;
    }
    
    .price-item {
        text-align: center;
        flex: 1;
    }
    
    .price-label {
        font-size: 0.625rem;
        color: #92400e;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.125rem;
    }
    
    .price-value {
        font-size: 0.8125rem;
        font-weight: 700;
        color: #92400e;
    }
    
    .provider-box {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        padding: 0.75rem;
        background: #f0fdf4;
        border-radius: var(--border-radius-md);
        margin-bottom: 0.875rem;
        border: 1px solid #bbf7d0;
    }
    
    .provider-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        flex-shrink: 0;
        font-size: 0.875rem;
    }
    
    .provider-info {
        flex: 1;
        min-width: 0;
    }
    
    .provider-name {
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.125rem;
    }
    
    .provider-meta {
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
    }
    
    .last-activity {
        font-size: 0.6875rem;
        color: var(--color-text-tertiary);
        font-style: italic;
        padding: 0.5rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-sm);
        margin-bottom: 0.875rem;
    }
    
    .service-actions {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
        padding-top: 0.875rem;
        border-top: 2px solid #f1f5f9;
    }
    
    .btn-service-action {
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
    }
    
    .btn-service-action:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .btn-view-proposals {
        background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    
    .btn-view-proposals:hover,
    .btn-view-proposals:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }
    
    .btn-view-request {
        background: transparent;
        color: var(--color-primary);
        border: 2px solid var(--color-primary);
    }
    
    .btn-view-request:hover,
    .btn-view-request:focus {
        background: var(--color-primary);
        color: white;
    }
    
    .btn-view-provider {
        background: var(--color-success);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }
    
    .btn-view-provider:hover,
    .btn-view-provider:focus {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-cancel-request {
        background: transparent;
        color: var(--color-danger);
        border: 2px solid var(--color-danger);
    }
    
    .btn-cancel-request:hover,
    .btn-cancel-request:focus {
        background: var(--color-danger);
        color: white;
    }
    
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
        margin-bottom: 1.5rem;
    }
    
    /* NOTIFICATION TOAST */
    .notification-toast {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        max-width: 320px;
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        border: 2px solid #d1fae5;
        display: none;
        z-index: 9999;
        animation: slideInUp 0.3s ease;
    }
    
    @keyframes slideInUp {
        from { transform: translateY(100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .notification-toast.show {
        display: block;
    }
    
    .notification-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }
    
    .notification-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #d1fae5;
        color: #065f46;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .notification-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--color-text-primary);
    }
    
    .notification-text {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
        margin-bottom: 0.75rem;
    }
    
    .notification-action {
        background: var(--color-success);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius-sm);
        font-size: 0.75rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: var(--transition-base);
    }
    
    .notification-action:hover {
        background: #059669;
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
        .services-container-2025 {
            padding: 1.5rem;
        }
        
        .services-title-main {
            font-size: 1.75rem;
        }
        
        .stats-overview {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1.25rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
        }
        
        .stat-label {
            font-size: 0.75rem;
        }
        
        .services-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        
        .service-card-2025 {
            padding: 1.25rem;
        }
        
        .service-icon-2025 {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
        
        .service-title-2025 {
            font-size: 1rem;
        }
        
        .service-actions {
            flex-direction: row;
            flex-wrap: wrap;
        }
        
        .btn-service-action {
            flex: 1;
            min-width: 140px;
        }
        
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .search-box {
            flex: 1 1 auto;
        }
        
        .filter-select {
            flex: 0 1 auto;
        }
    }
    
    /* RESPONSIVE - DESKTOP */
    @media (min-width: 1024px) {
        .services-container-2025 {
            padding: 2rem;
        }
        
        .services-grid-2025 {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        
        .service-card-2025 {
            padding: 1.5rem;
        }
    }
    
    /* DARK MODE SUPPORT */
    @media (prefers-color-scheme: dark) {
        :root {
            --color-text-primary: #f8fafc;
            --color-text-secondary: #cbd5e1;
            --color-text-tertiary: #94a3b8;
            --color-bg-primary: #1e293b;
            --color-bg-secondary: #0f172a;
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
    
    /* PRINT */
    @media print {
        .filters-bar,
        .tabs-container,
        .btn-premium,
        .notification-toast {
            display: none !important;
        }
    }
</style>

<div class="services-container-2025">
    
    @php
        // TAB 1: Active Missions (en cours, en attente, complétées mais non payées, disputes)
        $activeInProgress = $missions->filter(function($m) {
            return !empty($m->selected_provider_id) 
                && in_array($m->status, ['in_progress', 'waiting_to_start', 'disputed']) 
                && $m->payment_status !== 'released';
        });
        
        // Missions complétées en attente de paiement (doivent aussi être dans Active)
        $completedAwaitingPayment = $missions->filter(function($m) {
            return !empty($m->selected_provider_id)
                && $m->status === 'completed' 
                && $m->payment_status !== 'released';
        });
        
        // Fusionner pour avoir toutes les missions actives
        $currentRequests = $activeInProgress->merge($completedAwaitingPayment);
        
        // TAB 2: Published (pas encore de prestataire sélectionné)
        $publishedNoProvider = $missions->filter(function($m) {
            return empty($m->selected_provider_id) && $m->status === 'published';
        });
        
        // TAB 3: Completed (missions vraiment terminées ET payées)
        $completedRequests = $missions->filter(function($m) {
            return $m->status === 'completed' && $m->payment_status === 'released';
        });
        
        // Calculer nouvelles propositions
        $newProposalsCount = 0;
        foreach($publishedNoProvider as $mission) {
            $newProposalsCount += $mission->offers->where('created_at', '>=', now()->subDay())->count();
        }
    @endphp
    
    <!-- Header -->
    <header class="services-header-top">
        <h1 class="services-title-main">My Service Requests</h1>
        <a href="{{ route('service-providers') }}" 
           class="btn-premium" 
           aria-label="Browse service providers">
            <i class="fas fa-star" aria-hidden="true"></i>
            <span>Browse Providers</span>
            <i class="fas fa-arrow-right" style="font-size: 0.75rem;" aria-hidden="true"></i>
        </a>
    </header>
    
    <!-- Stats Overview -->
    <section class="stats-overview" aria-label="Requests statistics">
        <div class="stat-item">
            <div class="stat-value active" aria-label="{{ $currentRequests->count() }} active missions">{{ $currentRequests->count() }}</div>
            <div class="stat-label">Active Missions</div>
        </div>
        <div class="stat-item">
            <div class="stat-value published" aria-label="{{ $publishedNoProvider->count() }} published requests">{{ $publishedNoProvider->count() }}</div>
            <div class="stat-label">Published</div>
        </div>
        <div class="stat-item">
            <div class="stat-value published" aria-label="{{ $publishedNoProvider->sum(fn($m) => $m->offers->count()) }} total proposals">{{ $publishedNoProvider->sum(fn($m) => $m->offers->count()) }}</div>
            <div class="stat-label">Total Proposals</div>
        </div>
        <div class="stat-item">
            <div class="stat-value completed" aria-label="{{ $completedRequests->count() }} completed missions">{{ $completedRequests->count() }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </section>
    
    <!-- Tabs -->
    <nav class="tabs-container" role="tablist" aria-label="Request categories">
        <button class="tab-button active" 
                data-tab="active" 
                role="tab" 
                aria-selected="true" 
                aria-controls="tab-active"
                id="tab-btn-active">
            <i class="fas fa-circle" style="font-size: 0.5rem; color: var(--color-success);" aria-hidden="true"></i>
            <span>Active Missions</span>
            @if($currentRequests->count() > 0)
                <span class="tab-badge" aria-label="{{ $currentRequests->count() }} active">{{ $currentRequests->count() }}</span>
            @endif
        </button>
        
        <button class="tab-button" 
                data-tab="published" 
                role="tab" 
                aria-selected="false" 
                aria-controls="tab-published"
                id="tab-btn-published">
            <i class="fas fa-hourglass-half" aria-hidden="true"></i>
            <span>Published</span>
            @if($publishedNoProvider->count() > 0)
                <span class="tab-badge" aria-label="{{ $publishedNoProvider->count() }} published">{{ $publishedNoProvider->count() }}</span>
            @endif
        </button>
        
        <button class="tab-button" 
                data-tab="completed" 
                role="tab" 
                aria-selected="false" 
                aria-controls="tab-completed"
                id="tab-btn-completed">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>Completed</span>
        </button>
    </nav>
    
    <!-- Filters Bar -->
    <section class="filters-bar" aria-label="Search and filters">
        <div class="search-box">
            <i class="fas fa-search search-icon" aria-hidden="true"></i>
            <label for="search-input" class="sr-only">Search requests</label>
            <input type="text" 
                   class="search-input" 
                   placeholder="Search requests..." 
                   id="search-input"
                   aria-label="Search requests by title">
        </div>
        
        <label for="filter-urgency" class="sr-only">Filter by urgency</label>
        <select class="filter-select" id="filter-urgency" aria-label="Filter by urgency level">
            <option value="">All Urgency</option>
            @php
                $urgencies = $missions->pluck('urgency')->unique()->filter();
            @endphp
            @foreach($urgencies as $urgency)
                <option value="{{ strtolower($urgency) }}">{{ ucfirst($urgency) }}</option>
            @endforeach
        </select>
        
        <label for="filter-country" class="sr-only">Filter by country</label>
        <select class="filter-select" id="filter-country" aria-label="Filter by country">
            <option value="">All Countries</option>
            @foreach($missions->pluck('location_country')->unique()->filter()->sort() as $country)
                <option value="{{ strtolower(trim($country)) }}">{{ $country }}</option>
            @endforeach
        </select>
    </section>
    
    <!-- TAB 1: Active Missions -->
    <section class="tab-content active" 
             id="tab-active" 
             role="tabpanel" 
             aria-labelledby="tab-btn-active">
        <div class="services-grid-2025">
            @forelse($currentRequests as $mission)
                @php
                    $safeTitle = $mission->title ?? 'Service Request';
                    $safeUrgency = strtolower(trim($mission->urgency ?? ''));
                    $safeCountry = strtolower(trim($mission->location_country ?? ''));
                    $safeSearch = strtolower($safeTitle);
                    
                    $createdDate = \Carbon\Carbon::parse($mission->created_at);
                    $now = \Carbon\Carbon::now();
                    
                    $totalDays = 7;
                    if($mission->service_durition === '1 week') $totalDays = 7;
                    elseif($mission->service_durition === '2 weeks') $totalDays = 14;
                    elseif($mission->service_durition === '1 month') $totalDays = 30;
                    elseif($mission->service_durition === '3 months') $totalDays = 90;
                    
                    $daysElapsed = $createdDate->diffInDays($now);
                    $daysRemaining = max(0, $totalDays - $daysElapsed);
                    $progressPercent = min(100, ($daysElapsed / $totalDays) * 100);
                    
                    $statusMap = [
                        'in_progress' => ['text' => 'In Progress', 'class' => 'status-badge-in-progress'],
                        'completed' => ['text' => 'Awaiting Payment', 'class' => 'status-badge-completed'],
                        'disputed' => ['text' => 'Disputed', 'class' => 'status-badge-disputed'],
                        'waiting_to_start' => ['text' => 'Waiting to Start', 'class' => 'status-badge-waiting'],
                    ];
                    $statusInfo = $statusMap[$mission->status] ?? ['text' => 'N/A', 'class' => 'status-badge-waiting'];
                    
                    $hasProvider = $mission->selectedProvider !== null;
                    $providerName = $hasProvider ? ($mission->selectedProvider->name ?? 'Provider') : 'Provider';
                    $providerSlug = $hasProvider ? ($mission->selectedProvider->slug ?? '') : '';
                @endphp
                
                <article class="service-card-2025" 
                         data-urgency="{{ $safeUrgency }}"
                         data-country="{{ $safeCountry }}"
                         data-search="{{ $safeSearch }}"
                         aria-label="Service request: {{ $safeTitle }}">
                    
                    <div class="card-header-row">
                        <div class="service-icon-2025" aria-hidden="true">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-content-main">
                            <h3 class="service-title-2025">{{ strtoupper($safeTitle) }}</h3>
                            
                            <div class="status-row">
                                <span class="status-badge-2025 {{ $statusInfo['class'] }}" role="status">
                                    <i class="fas fa-circle" style="font-size: 0.5rem;" aria-hidden="true"></i>
                                    {{ $statusInfo['text'] }}
                                </span>
                                
                                <span class="countdown-inline">
                                    <i class="fas fa-clock" aria-hidden="true"></i>
                                    <span aria-label="Day {{ $daysElapsed }} of {{ $totalDays }}">Day {{ $daysElapsed }} of {{ $totalDays }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    @if($mission->status === 'in_progress' || $mission->status === 'waiting_to_start')
                    <div class="progress-bar-wrapper" role="progressbar" aria-valuenow="{{ round($progressPercent) }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar-header">
                            <span class="progress-label">Progress</span>
                            <span class="progress-value">{{ round($progressPercent) }}%</span>
                        </div>
                        <div class="progress-bar-track">
                            <div class="progress-bar-fill" style="width: {{ $progressPercent }}%;"></div>
                        </div>
                    </div>
                    @endif
                    
                    @if($hasProvider)
                    <div class="provider-box">
                        <div class="provider-avatar" aria-hidden="true">
                            {{ substr($providerName, 0, 1) }}
                        </div>
                        <div class="provider-info">
                            <div class="provider-name">{{ $providerName }}</div>
                            <div class="provider-meta">
                                <i class="fas fa-user-check" aria-hidden="true"></i>
                                Assigned Provider
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <dl class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-clock info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Duration:</dt>
                            <dd class="info-value">{{ $mission->service_durition ?? '-' }}</dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-calendar-day info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Due:</dt>
                            <dd class="info-value">{{ $daysRemaining }} days</dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Location:</dt>
                            <dd class="info-value">{{ $mission->location_city ?? $mission->location_country ?? '-' }}</dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-language info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Language:</dt>
                            <dd class="info-value">{{ $mission->language ?? '-' }}</dd>
                        </div>
                    </dl>
                    
                    <div class="last-activity">
                        <i class="fas fa-clock" aria-hidden="true"></i>
                        <time datetime="{{ $mission->updated_at }}">Last updated {{ \Carbon\Carbon::parse($mission->updated_at)->diffForHumans() }}</time>
                    </div>
                    
                    <div class="service-actions">
                        <a href="{{ route('view.request', ['id' => $mission->id]) }}" 
                           class="btn-service-action btn-view-request"
                           aria-label="View details for {{ $safeTitle }}">
                            <i class="fas fa-file-alt" aria-hidden="true"></i>
                            <span>View Details</span>
                        </a>
                        
                        @if($hasProvider && $providerSlug)
                            <a href="{{ route('provider-details', ['id' => $providerSlug]) }}" 
                               class="btn-service-action btn-view-provider"
                               aria-label="View provider profile">
                                <i class="fas fa-user-check" aria-hidden="true"></i>
                                <span>See Provider</span>
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state-2025" style="grid-column: 1 / -1;" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="empty-title">No Active Missions</div>
                    <p class="empty-text">You don't have any missions in progress right now.</p>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- TAB 2: Published -->
    <section class="tab-content" 
             id="tab-published" 
             role="tabpanel" 
             aria-labelledby="tab-btn-published">
        <div class="services-grid-2025">
            @forelse($publishedNoProvider as $mission)
                @php
                    $safeTitle = $mission->title ?? 'WAITING FOR PROVIDER';
                    $safeUrgency = strtolower(trim($mission->urgency ?? ''));
                    $safeCountry = strtolower(trim($mission->location_country ?? ''));
                    $safeSearch = strtolower($safeTitle);
                    
                    $urgencyClass = 'urgency-low';
                    if($mission->urgency === 'high') $urgencyClass = 'urgency-high';
                    elseif($mission->urgency === 'medium') $urgencyClass = 'urgency-medium';
                    
                    $createdDate = \Carbon\Carbon::parse($mission->created_at);
                    
                    if($mission->service_durition === '1 week') {
                        $endTime = $createdDate->copy()->addWeek();
                    } elseif($mission->service_durition === '2 weeks') {
                        $endTime = $createdDate->copy()->addWeeks(2);
                    } elseif($mission->service_durition === '1 month') {
                        $endTime = $createdDate->copy()->addMonth();
                    } elseif($mission->service_durition === '3 months') {
                        $endTime = $createdDate->copy()->addMonths(3);
                    } else {
                        $endTime = $createdDate->copy()->addWeek();
                    }
                    
                    $remainingDays = \Carbon\Carbon::now()->diffInDays($endTime, false);
                    $remainingDays = max(0, $remainingDays);
                    
                    $offersCount = $mission->offers->count();
                    $newCount = $mission->offers->where('created_at', '>=', now()->subDay())->count();
                    $minPrice = $offersCount > 0 ? $mission->offers->min('price') : null;
                    $maxPrice = $offersCount > 0 ? $mission->offers->max('price') : null;
                    $avgPrice = $offersCount > 0 ? $mission->offers->avg('price') : null;
                @endphp
                
                <article class="service-card-2025 service-card-published"
                         data-urgency="{{ $safeUrgency }}"
                         data-country="{{ $safeCountry }}"
                         data-search="{{ $safeSearch }}"
                         aria-label="Published request: {{ $safeTitle }}">
                    
                    <div class="card-header-row">
                        <div class="service-icon-2025 service-icon-published" aria-hidden="true">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="card-content-main">
                            <h3 class="service-title-2025">{{ strtoupper($safeTitle) }}</h3>
                            
                            <div class="status-row">
                                <span class="status-badge-2025 status-badge-published" role="status">
                                    <i class="fas fa-circle" style="font-size: 0.5rem;" aria-hidden="true"></i>
                                    Searching Provider
                                </span>
                                
                                @if($mission->urgency)
                                <span class="urgency-badge {{ $urgencyClass }}" role="status">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    {{ ucfirst($mission->urgency) }}
                                </span>
                                @endif
                                
                                <span class="countdown-inline">
                                    <i class="fas fa-calendar-times" aria-hidden="true"></i>
                                    <span aria-label="Expires in {{ $remainingDays }} days">Expires in {{ $remainingDays }} days</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    @if($offersCount > 0)
                    <div class="proposals-highlight" role="region" aria-label="Proposals summary">
                        <div class="proposals-title">
                            <i class="fas fa-file-contract" aria-hidden="true"></i>
                            <span class="proposals-count-big">{{ $offersCount }}</span>
                            <span>{{ $offersCount === 1 ? 'Proposal' : 'Proposals' }} Received</span>
                            @if($newCount > 0)
                                <span class="new-badge" role="status" aria-label="{{ $newCount }} new proposals">{{ $newCount }} NEW</span>
                            @endif
                        </div>
                        
                        @if($minPrice && $maxPrice)
                        <div class="price-range-box" aria-label="Price range">
                            <div class="price-item">
                                <div class="price-label">Min</div>
                                <div class="price-value">{{ number_format($minPrice, 0) }}€</div>
                            </div>
                            <div class="price-item">
                                <div class="price-label">Avg</div>
                                <div class="price-value">{{ number_format($avgPrice, 0) }}€</div>
                            </div>
                            <div class="price-item">
                                <div class="price-label">Max</div>
                                <div class="price-value">{{ number_format($maxPrice, 0) }}€</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                    
                    <dl class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-clock info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Duration:</dt>
                            <dd class="info-value">{{ $mission->service_durition ?? '-' }}</dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-calendar-plus info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Published:</dt>
                            <dd class="info-value">
                                <time datetime="{{ $createdDate }}">{{ $createdDate->diffForHumans() }}</time>
                            </dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Location:</dt>
                            <dd class="info-value">{{ $mission->location_country ?? '-' }}</dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-language info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Language:</dt>
                            <dd class="info-value">{{ $mission->language ?? '-' }}</dd>
                        </div>
                    </dl>
                    
                    <div class="service-actions">
                        @if($offersCount > 0)
                            <a href="{{ route('qoute-offer', ['id'=> $mission->id]) }}" 
                               class="btn-service-action btn-view-proposals" 
                               style="flex: 2;"
                               aria-label="View {{ $offersCount }} proposals for {{ $safeTitle }}">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                                <span>View {{ $offersCount }} Proposals</span>
                                @if($newCount > 0)
                                    <span class="new-badge">{{ $newCount }} NEW</span>
                                @endif
                            </a>
                        @else
                            <a href="{{ route('qoute-offer', ['id'=> $mission->id]) }}" 
                               class="btn-service-action btn-view-request" 
                               style="flex: 2;"
                               aria-label="View request details">
                                <i class="fas fa-file-alt" aria-hidden="true"></i>
                                <span>View Request</span>
                            </a>
                        @endif
                        
                        <button 
                            class="btn-service-action btn-cancel-request"
                            onclick="openCancelRequestPopup({{ $mission->id }})"
                            style="flex: 1;"
                            aria-label="Cancel request">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>
                            <span>Cancel</span>
                        </button>
                    </div>
                </article>
            @empty
                <div class="empty-state-2025" style="grid-column: 1 / -1;" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="empty-title">No Published Requests</div>
                    <p class="empty-text">You don't have any requests waiting for providers. Browse our network of service providers to find the perfect match for your needs!</p>
                    <a href="{{ route('service-providers') }}" 
                       class="btn-premium" 
                       aria-label="Browse available service providers">
                        <i class="fas fa-star" aria-hidden="true"></i>
                        <span>Browse Available Providers</span>
                        <i class="fas fa-arrow-right" style="font-size: 0.75rem;" aria-hidden="true"></i>
                    </a>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- TAB 3: Completed -->
    <section class="tab-content" 
             id="tab-completed" 
             role="tabpanel" 
             aria-labelledby="tab-btn-completed">
        <div class="services-grid-2025">
            @forelse($completedRequests as $mission)
                @php
                    $safeTitle = $mission->title ?? 'Service Request';
                    $safeUrgency = strtolower(trim($mission->urgency ?? ''));
                    $safeCountry = strtolower(trim($mission->location_country ?? ''));
                    $safeSearch = strtolower($safeTitle);
                @endphp
                
                <article class="service-card-2025" 
                         data-urgency="{{ $safeUrgency }}"
                         data-country="{{ $safeCountry }}"
                         data-search="{{ $safeSearch }}"
                         aria-label="Completed request: {{ $safeTitle }}">
                    
                    <div class="card-header-row">
                        <div class="service-icon-2025" style="background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);" aria-hidden="true">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-content-main">
                            <h3 class="service-title-2025">{{ strtoupper($safeTitle) }}</h3>
                            
                            <div class="status-row">
                                <span class="status-badge-2025 status-badge-completed" role="status">
                                    <i class="fas fa-check-circle" style="font-size: 0.625rem;" aria-hidden="true"></i>
                                    Completed & Paid
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <dl class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-calendar-check info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Completed:</dt>
                            <dd class="info-value">
                                <time datetime="{{ $mission->updated_at }}">{{ \Carbon\Carbon::parse($mission->updated_at)->format('M j, Y') }}</time>
                            </dd>
                        </div>
                        
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                            <dt class="info-label">Location:</dt>
                            <dd class="info-value">{{ $mission->location_country ?? '-' }}</dd>
                        </div>
                    </dl>
                    
                    <div class="service-actions">
                        <a href="{{ route('view.request', ['id' => $mission->id]) }}" 
                           class="btn-service-action btn-view-request"
                           aria-label="View completed request details">
                            <i class="fas fa-file-alt" aria-hidden="true"></i>
                            <span>View Details</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="empty-state-2025" style="grid-column: 1 / -1;" role="status">
                    <div class="empty-icon" aria-hidden="true">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="empty-title">No Completed Missions Yet</div>
                    <p class="empty-text">Your completed missions will appear here once they are finished and paid.</p>
                </div>
            @endforelse
        </div>
    </section>
    
</div>

<!-- Notification Toast pour missions complétées -->
<aside class="notification-toast" id="completion-notification" role="alert" aria-live="polite">
    <div class="notification-header">
        <div class="notification-icon">
            <i class="fas fa-check" aria-hidden="true"></i>
        </div>
        <div class="notification-title">Mission Completed! 🎉</div>
    </div>
    <p class="notification-text" id="notification-message"></p>
    <button class="notification-action" onclick="viewCompletedMission()">View Mission</button>
</aside>

@include('dashboard.service.cancel-service-request')

<script>
(function() {
    'use strict';
    
    // Performance: Debounce function
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
    
    // Tabs Navigation with ARIA
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetTab = button.dataset.tab;
            
            // Update ARIA attributes
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-selected', 'false');
            });
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Activate current tab
            button.classList.add('active');
            button.setAttribute('aria-selected', 'true');
            const targetContent = document.getElementById(`tab-${targetTab}`);
            targetContent.classList.add('active');
            
            // Announce to screen readers
            const announcement = `${button.textContent.trim()} tab selected`;
            announceToScreenReader(announcement);
            
            // Reset filters
            applyFilters();
        });
    });
    
    // Keyboard navigation for tabs
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
    
    // Search & Filters with debounce for performance
    const searchInput = document.getElementById('search-input');
    const filterUrgency = document.getElementById('filter-urgency');
    const filterCountry = document.getElementById('filter-country');
    
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const urgencyFilter = filterUrgency.value.toLowerCase().trim();
        const countryFilter = filterCountry.value.toLowerCase().trim();
        
        const activeTab = document.querySelector('.tab-content.active');
        const cards = activeTab.querySelectorAll('.service-card-2025');
        
        let visibleCount = 0;
        
        cards.forEach(card => {
            const searchText = (card.dataset.search || '').toLowerCase().trim();
            const urgency = (card.dataset.urgency || '').toLowerCase().trim();
            const country = (card.dataset.country || '').toLowerCase().trim();
            
            const matchesSearch = !searchTerm || searchText.includes(searchTerm);
            const matchesUrgency = !urgencyFilter || urgency === urgencyFilter;
            const matchesCountry = !countryFilter || country === countryFilter;
            
            if (matchesSearch && matchesUrgency && matchesCountry) {
                card.style.display = '';
                card.removeAttribute('aria-hidden');
                visibleCount++;
            } else {
                card.style.display = 'none';
                card.setAttribute('aria-hidden', 'true');
            }
        });
        
        // Handle empty states
        const grid = activeTab.querySelector('.services-grid-2025');
        let dynamicEmpty = grid.querySelector('.empty-state-2025[data-dynamic]');
        
        if (visibleCount === 0 && !grid.querySelector('.empty-state-2025:not([data-dynamic])')) {
            if (!dynamicEmpty) {
                dynamicEmpty = document.createElement('div');
                dynamicEmpty.className = 'empty-state-2025';
                dynamicEmpty.setAttribute('data-dynamic', 'true');
                dynamicEmpty.style.gridColumn = '1 / -1';
                dynamicEmpty.setAttribute('role', 'status');
                dynamicEmpty.innerHTML = `
                    <div class="empty-icon" aria-hidden="true"><i class="fas fa-search"></i></div>
                    <div class="empty-title">No Results Found</div>
                    <p class="empty-text">Try adjusting your filters or search term.</p>
                `;
                grid.appendChild(dynamicEmpty);
            }
        } else if (dynamicEmpty && visibleCount > 0) {
            dynamicEmpty.remove();
        }
        
        // Announce results to screen readers
        announceToScreenReader(`Showing ${visibleCount} result${visibleCount !== 1 ? 's' : ''}`);
    }
    
    const debouncedFilter = debounce(applyFilters, 300);
    
    searchInput.addEventListener('input', debouncedFilter);
    filterUrgency.addEventListener('change', applyFilters);
    filterCountry.addEventListener('change', applyFilters);
    
    // Screen reader announcements
    function announceToScreenReader(message) {
        const announcement = document.createElement('div');
        announcement.setAttribute('role', 'status');
        announcement.setAttribute('aria-live', 'polite');
        announcement.className = 'sr-only';
        announcement.textContent = message;
        document.body.appendChild(announcement);
        setTimeout(() => announcement.remove(), 1000);
    }
    
    // Keyboard shortcut: Ctrl/Cmd + K for search
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
    });
    
    // Notification system for completed missions
    let completedMissionId = null;
    
    function showCompletionNotification(missionTitle, missionId) {
        completedMissionId = missionId;
        const notification = document.getElementById('completion-notification');
        const message = document.getElementById('notification-message');
        message.textContent = `Your mission "${missionTitle}" has been completed successfully!`;
        notification.classList.add('show');
        
        // Auto-hide after 10 seconds
        setTimeout(() => {
            notification.classList.remove('show');
        }, 10000);
    }
    
    window.viewCompletedMission = function() {
        if (completedMissionId) {
            window.location.href = `/dashboard/request/${completedMissionId}`;
        }
    };
    
    // Check for newly completed missions (via localStorage or API)
    function checkCompletedMissions() {
        const lastCheck = localStorage.getItem('last_completion_check');
        const now = Date.now();
        
        // Check every 5 minutes
        if (!lastCheck || now - lastCheck > 300000) {
            localStorage.setItem('last_completion_check', now);
        }
    }
    
    // Run on page load
    checkCompletedMissions();
    
    // Performance: Lazy load images if any
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Prefetch on hover for better perceived performance
    document.querySelectorAll('a[href^="/"]').forEach(link => {
        link.addEventListener('mouseenter', () => {
            const linkUrl = link.getAttribute('href');
            const prefetchLink = document.createElement('link');
            prefetchLink.rel = 'prefetch';
            prefetchLink.href = linkUrl;
            document.head.appendChild(prefetchLink);
        }, { once: true });
    });
    
})();
</script>

@endsection