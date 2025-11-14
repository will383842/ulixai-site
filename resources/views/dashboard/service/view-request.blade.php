@extends('dashboard.layouts.master')

@section('title', 'Service Request Details')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
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
    
    /* MOBILE FIRST - Base styles pour mobile */
    .request-details-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem;
        min-height: 100vh;
    }
    
    .request-card {
        background: white;
        border-radius: var(--border-radius-xl);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .request-header {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        padding: 1.25rem;
        border-bottom: 2px solid #93c5fd;
    }
    
    .request-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.75rem;
        word-break: break-word;
        line-height: 1.3;
    }
    
    .status-badges {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.875rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .status-active {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .status-urgent {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .request-body {
        padding: 1.25rem;
    }
    
    .section {
        margin-bottom: 1.75rem;
    }
    
    .section:last-child {
        margin-bottom: 0;
    }
    
    .section-title {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .section-title i {
        color: var(--color-primary);
    }
    
    /* Info Grid - MOBILE FIRST (1 colonne par défaut) */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
        background: var(--color-bg-secondary);
        padding: 1rem;
        border-radius: var(--border-radius-md);
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        font-size: 0.8125rem;
    }
    
    .info-icon {
        color: var(--color-text-tertiary);
        width: 16px;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }
    
    .info-label {
        color: var(--color-text-secondary);
        font-weight: 600;
        min-width: 90px;
        flex-shrink: 0;
    }
    
    .info-value {
        color: var(--color-text-primary);
        font-weight: 500;
        flex: 1;
        word-break: break-word;
    }
    
    .info-value.highlight {
        color: var(--color-danger);
        font-weight: 700;
    }
    
    .description-box {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 2px solid #93c5fd;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        color: var(--color-text-primary);
        font-size: 0.875rem;
        line-height: 1.6;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    /* Attachments Grid - MOBILE FIRST (2 colonnes) */
    .attachments-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .attachment-item {
        position: relative;
        aspect-ratio: 1;
        border: 2px solid #cbd5e1;
        border-radius: var(--border-radius-md);
        overflow: hidden;
        background: var(--color-bg-secondary);
        cursor: pointer;
        transition: var(--transition-base);
    }
    
    .attachment-item:hover,
    .attachment-item:focus {
        border-color: var(--color-primary);
        transform: scale(1.02);
    }
    
    .attachment-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .attachment-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    .attachment-placeholder i {
        font-size: 1.75rem;
        color: var(--color-text-tertiary);
        opacity: 0.4;
    }
    
    /* Actions - MOBILE FIRST (column layout) */
    .actions-container {
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e7eb;
    }
    
    .actions-main {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .actions-secondary {
        display: flex;
        justify-content: center;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem 1.5rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: var(--transition-base);
        text-decoration: none;
        border: none;
        cursor: pointer;
        touch-action: manipulation;
        width: 100%;
    }
    
    .btn:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .btn-outline {
        background: transparent;
        color: var(--color-primary);
        border: 2px solid var(--color-primary);
    }
    
    .btn-outline:hover,
    .btn-outline:focus {
        background: var(--color-primary);
        color: white;
    }
    
    .btn-danger-link {
        background: transparent;
        color: var(--color-primary);
        padding: 0.5rem 1rem;
        text-decoration: underline;
        font-weight: 600;
        border: none;
        width: auto;
    }
    
    .btn-danger-link:hover,
    .btn-danger-link:focus {
        color: #1d4ed8;
    }
    
    /* MODAL STYLES */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);
    }
    
    .modal-overlay.show {
        display: flex;
    }
    
    .modal-content {
        background: white;
        border-radius: var(--border-radius-xl);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalSlideIn 0.3s ease;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .modal-header {
        padding: 1.25rem;
        border-bottom: 2px solid #e5e7eb;
        position: relative;
    }
    
    .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-align: center;
        padding-right: 2rem;
        line-height: 1.3;
    }
    
    .modal-close {
        position: absolute;
        top: 0.875rem;
        right: 0.875rem;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: var(--color-text-tertiary);
        cursor: pointer;
        transition: var(--transition-base);
        font-size: 1.5rem;
    }
    
    .modal-close:hover,
    .modal-close:focus {
        background: var(--color-bg-secondary);
        color: var(--color-text-primary);
    }
    
    .modal-body {
        padding: 1.25rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-group:last-child {
        margin-bottom: 0;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }
    
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        transition: var(--transition-base);
        font-family: inherit;
    }
    
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-hint {
        font-size: 0.75rem;
        color: var(--color-primary);
        margin-top: 0.75rem;
        display: flex;
        align-items: flex-start;
        gap: 0.375rem;
        line-height: 1.4;
    }
    
    .form-hint i {
        margin-top: 0.125rem;
        flex-shrink: 0;
    }
    
    .modal-footer {
        padding: 1rem 1.25rem;
        border-top: 2px solid #e5e7eb;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .modal-footer .btn {
        width: 100%;
    }
    
    .btn-primary {
        background: var(--color-primary);
        color: white;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }
    
    .btn-primary:hover,
    .btn-primary:focus {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
    
    .btn-danger-text {
        background: transparent;
        color: var(--color-danger);
        text-decoration: underline;
        font-weight: 600;
    }
    
    .btn-danger-text:hover,
    .btn-danger-text:focus {
        color: #dc2626;
    }
    
    /* SUCCESS MODAL */
    .success-modal-content {
        text-align: center;
        padding: 2rem 1.5rem;
    }
    
    .success-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        animation: successPulse 0.6s ease;
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .success-icon i {
        font-size: 2.25rem;
        color: white;
    }
    
    .success-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 1rem;
    }
    
    .success-text {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        line-height: 1.6;
        margin-bottom: 0;
    }
    
    /* LOADING MODAL */
    .loading-modal-content {
        text-align: center;
        padding: 2rem 1.5rem;
    }
    
    .loading-spinner {
        width: 64px;
        height: 64px;
        border: 4px solid #e5e7eb;
        border-top-color: var(--color-primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1.25rem;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .loading-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }
    
    .loading-text {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
    }
    
    /* LIGHTBOX */
    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    
    .lightbox.show {
        display: flex;
    }
    
    .lightbox-content {
        max-width: 90vw;
        max-height: 90vh;
        position: relative;
    }
    
    .lightbox-image {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }
    
    .lightbox-close {
        position: absolute;
        top: -3rem;
        right: 0;
        width: 40px;
        height: 40px;
        background: white;
        border: none;
        border-radius: 50%;
        color: var(--color-text-primary);
        font-size: 1.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-base);
    }
    
    .lightbox-close:hover,
    .lightbox-close:focus {
        background: #e5e7eb;
    }
    
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
    
    /* TABLET - 640px+ */
    @media (min-width: 640px) {
        .request-details-container {
            padding: 1.5rem;
        }
        
        .request-card {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        
        .request-header {
            padding: 1.75rem;
        }
        
        .request-title {
            font-size: 1.375rem;
        }
        
        .request-body {
            padding: 1.75rem;
        }
        
        .section {
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 0.9375rem;
            margin-bottom: 1rem;
        }
        
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            padding: 1.25rem;
        }
        
        .info-item {
            font-size: 0.875rem;
        }
        
        .description-box {
            padding: 1.25rem;
            font-size: 0.9375rem;
        }
        
        .attachments-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        
        .attachment-placeholder i {
            font-size: 2rem;
        }
        
        .actions-container {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        
        .actions-main {
            flex-direction: row;
            flex: 1;
        }
        
        .actions-main .btn {
            width: auto;
            flex: 1;
        }
        
        .actions-secondary {
            flex-shrink: 0;
        }
        
        .btn-danger-link {
            width: auto;
        }
        
        .modal-header {
            padding: 1.5rem;
        }
        
        .modal-title {
            font-size: 1.125rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
            flex-direction: row;
            justify-content: space-between;
        }
        
        .modal-footer .btn {
            width: auto;
            flex: 1;
        }
        
        .success-modal-content,
        .loading-modal-content {
            padding: 2.5rem 2rem;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
        }
        
        .success-icon i {
            font-size: 2.5rem;
        }
        
        .success-title {
            font-size: 1.25rem;
        }
        
        .success-text {
            font-size: 0.9375rem;
        }
    }
    
    /* DESKTOP SMALL - 768px+ */
    @media (min-width: 768px) {
        .attachments-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* DESKTOP - 1024px+ */
    @media (min-width: 1024px) {
        .request-details-container {
            padding: 2rem;
        }
        
        .request-header {
            padding: 2rem;
        }
        
        .request-title {
            font-size: 1.5rem;
        }
        
        .request-body {
            padding: 2rem;
        }
        
        .description-box {
            padding: 1.5rem;
        }
        
        .info-grid {
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
</style>

@php
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
    
    $attachments = !empty($mission->attachments) ? json_decode($mission->attachments, true) : [];
@endphp

<div class="request-details-container">
    
    <!-- Request Card -->
    <article class="request-card">
        
        <!-- Header -->
        <header class="request-header">
            <h1 class="request-title">{{ $mission->title ?? 'Service Request' }}</h1>
            
            <div class="status-badges" role="group" aria-label="Request status">
                <span class="status-badge status-active" role="status">
                    <i class="fas fa-circle" style="font-size: 0.5rem;" aria-hidden="true"></i>
                    Active
                </span>
                @if($remainingDays <= 3 && $remainingDays > 0)
                    <span class="status-badge status-urgent" role="status">
                        <i class="fas fa-clock" aria-hidden="true"></i>
                        {{ $remainingDays }} days left
                    </span>
                @endif
            </div>
        </header>
        
        <!-- Body -->
        <div class="request-body">
            
            <!-- Requester Information -->
            <section class="section">
                <h2 class="section-title">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    Requester Information
                </h2>
                
                <dl class="info-grid">
                    <div class="info-item">
                        <i class="fas fa-user-circle info-icon" aria-hidden="true"></i>
                        <dt class="info-label">Requester Name:</dt>
                        <dd class="info-value highlight">{{ $mission->requester->name ?? '-' }}</dd>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-phone info-icon" aria-hidden="true"></i>
                        <dt class="info-label">Phone Number:</dt>
                        <dd class="info-value highlight">{{ $mission->requester->phone_number ?? '-' }}</dd>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-calendar-plus info-icon" aria-hidden="true"></i>
                        <dt class="info-label">Date:</dt>
                        <dd class="info-value">
                            <time datetime="{{ $createdDate }}">{{ $createdDate->format('d/m/Y') }}</time>
                        </dd>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-calendar-times info-icon" aria-hidden="true"></i>
                        <dt class="info-label">Ends at:</dt>
                        <dd class="info-value">{{ $remainingDays }} Days</dd>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                        <dt class="info-label">Location:</dt>
                        <dd class="info-value">{{ $mission->location_city ?? '-' }}</dd>
                    </div>
                </dl>
            </section>
            
            <!-- Service Details -->
            <section class="section">
                <h2 class="section-title">
                    <i class="fas fa-file-alt" aria-hidden="true"></i>
                    Details of the Service Request
                </h2>
                
                <div class="description-box" role="region" aria-label="Service description">
                    {{ $mission->description ?? '-' }}
                </div>
            </section>
            
            <!-- Attachments -->
            <section class="section">
                <h2 class="section-title">
                    <i class="fas fa-paperclip" aria-hidden="true"></i>
                    Attachments
                </h2>
                
                <div class="attachments-grid" role="list" aria-label="Request attachments">
                    @if(count($attachments) > 0)
                        @foreach($attachments as $index => $img)
                            <div class="attachment-item" 
                                 role="listitem" 
                                 onclick="openLightbox('{{ asset($img) }}')"
                                 tabindex="0"
                                 onkeypress="if(event.key==='Enter') openLightbox('{{ asset($img) }}')"
                                 aria-label="View attachment {{ $index + 1 }}">
                                <img src="{{ asset($img) }}" 
                                     alt="Attachment" 
                                     loading="lazy" />
                            </div>
                        @endforeach
                    @else
                        @for($i = 0; $i < 4; $i++)
                            <div class="attachment-item" role="listitem" aria-label="No attachment">
                                <div class="attachment-placeholder">
                                    <i class="fas fa-image" aria-hidden="true"></i>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </section>
            
            <!-- Actions -->
            <div class="actions-container">
                <div class="actions-main">
                    <a href="{{ route('user.conversation') }}" 
                       class="btn btn-outline"
                       aria-label="Open private messaging">
                        <span>PRIVATE MESSAGING</span>
                    </a>
                </div>
                
                <div class="actions-secondary">
                    <button type="button" 
                            class="btn-danger-link" 
                            onclick="openDisputeModal()"
                            aria-label="Start dispute process">
                        I Start Dispute
                    </button>
                </div>
            </div>
            
        </div>
    </article>
    
</div>

<!-- Dispute Modal -->
<aside class="modal-overlay" id="disputeModal" role="dialog" aria-labelledby="disputeModalTitle" aria-modal="true">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="disputeModalTitle">WHY DO YOU WISH TO CANCEL THIS ADD?</h2>
            <button type="button" 
                    class="modal-close" 
                    onclick="closeDisputeModal()" 
                    aria-label="Close modal">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
        
        <form id="disputeForm" class="modal-body">
            <div class="form-group">
                <select id="disputeReason" 
                        class="form-select" 
                        required 
                        aria-required="true"
                        aria-label="Select cancellation reason">
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
                <textarea id="disputeDescription" 
                          class="form-textarea" 
                          maxlength="300" 
                          placeholder="Describe here the reason for your cancellation" 
                          required
                          aria-required="true"
                          aria-label="Cancellation description"></textarea>
            </div>
            
            <div class="form-hint">
                <i class="fas fa-info-circle" aria-hidden="true"></i>
                <span>Your service provider will recieve your mesasge . they have 3 days to respond</span>
            </div>
        </form>
        
        <div class="modal-footer">
            <button type="button" 
                    class="btn btn-primary" 
                    onclick="closeDisputeModal()"
                    aria-label="Keep request online">
                I keep my add online
            </button>
            
            <button type="submit" 
                    form="disputeForm" 
                    class="btn btn-danger-text"
                    aria-label="Confirm dispute">
                I confirm the dispute
            </button>
        </div>
    </div>
</aside>

<!-- Success Modal -->
<aside class="modal-overlay" id="successModal" role="dialog" aria-labelledby="successModalTitle" aria-modal="true">
    <div class="modal-content">
        <div class="success-modal-content">
            <div class="success-icon" aria-hidden="true">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="success-title" id="successModalTitle">Your decision has been sent!</h2>
            <p class="success-text">
                The service provider has just received your message.<br>
                We'll keep you in the loop for what happens next.<br>
                <span style="display: block; margin-top: 0.5rem;">Thanks a bunch for your trust! 🙌</span>
            </p>
        </div>
    </div>
</aside>

<!-- Loading Modal -->
<aside class="modal-overlay" id="loadingModal" role="alert" aria-live="assertive" aria-busy="true">
    <div class="modal-content">
        <div class="loading-modal-content">
            <div class="loading-spinner" aria-hidden="true"></div>
            <h2 class="loading-title">Canceling...</h2>
            <p class="loading-text">Please wait while we process your request.</p>
        </div>
    </div>
</aside>

<!-- Lightbox -->
<aside class="lightbox" id="lightbox" role="dialog" aria-label="Image viewer">
    <div class="lightbox-content">
        <button type="button" 
                class="lightbox-close" 
                onclick="closeLightbox()" 
                aria-label="Close image viewer">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        <img src="" alt="Attachment full size" class="lightbox-image" id="lightboxImage" />
    </div>
</aside>

<script>
(function() {
    'use strict';
    
    // Modal Management
    function openDisputeModal() {
        document.getElementById('disputeModal').classList.add('show');
        document.getElementById('disputeReason').focus();
        document.body.style.overflow = 'hidden';
    }
    
    function closeDisputeModal() {
        document.getElementById('disputeModal').classList.remove('show');
        document.body.style.overflow = '';
        document.getElementById('disputeForm').reset();
    }
    
    function openSuccessModal() {
        document.getElementById('successModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeSuccessModal() {
        document.getElementById('successModal').classList.remove('show');
        document.body.style.overflow = '';
    }
    
    function openLoadingModal() {
        document.getElementById('loadingModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLoadingModal() {
        document.getElementById('loadingModal').classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Lightbox
    function openLightbox(imageSrc) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        lightboxImage.src = imageSrc;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Make functions global
    window.openDisputeModal = openDisputeModal;
    window.closeDisputeModal = closeDisputeModal;
    window.openSuccessModal = openSuccessModal;
    window.closeSuccessModal = closeSuccessModal;
    window.openLoadingModal = openLoadingModal;
    window.closeLoadingModal = closeLoadingModal;
    window.openLightbox = openLightbox;
    window.closeLightbox = closeLightbox;
    
    // Close modal on overlay click
    document.getElementById('disputeModal').addEventListener('click', function(e) {
        if (e.target === this) closeDisputeModal();
    });
    
    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) closeSuccessModal();
    });
    
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const lightbox = document.getElementById('lightbox');
            const disputeModal = document.getElementById('disputeModal');
            const successModal = document.getElementById('successModal');
            
            if (lightbox.classList.contains('show')) closeLightbox();
            else if (disputeModal.classList.contains('show')) closeDisputeModal();
            else if (successModal.classList.contains('show')) closeSuccessModal();
        }
    });
    
    // Form Submission
    document.getElementById('disputeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const reason = document.getElementById('disputeReason').value;
        const description = document.getElementById('disputeDescription').value;
        
        if (!reason) {
            alert('Please select the reason');
            return;
        }
        
        closeDisputeModal();
        openLoadingModal();
        
        fetch('/api/mission/cancel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                mission_id: {{ $mission->id }},
                reason: reason,
                description: description,
                cancelled_by: 'requester',
                cancelled_on: new Date().toISOString()
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            closeLoadingModal();
            if (data.success) {
                openSuccessModal();
            } else {
                alert('Error: ' + (data.message || 'An error occurred'));
            }
        })
        .catch(error => {
            closeLoadingModal();
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
    
})();
</script>

@endsection