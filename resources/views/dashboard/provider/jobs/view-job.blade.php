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
        --border-radius-2xl: 2rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    /* OPTIMISATIONS GLOBALES */
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
    
    /* CONTAINER PRINCIPAL - RESPECT STRUCTURE ORIGINALE */
    .job-detail-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background: var(--color-bg-secondary);
    }
    
    .job-detail-main {
        flex: 1;
        padding: 1rem;
        width: 100%;
    }
    
    .job-detail-card-wrapper {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-2xl);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        padding: 1rem;
        max-width: 100%;
        margin: 0 auto;
        animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        will-change: transform, opacity;
        contain: layout style paint;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* TITRE PRINCIPAL */
    .job-title-main-2025 {
        color: #1e3a8a;
        font-weight: 700;
        font-size: 1.125rem;
        line-height: 1.4;
        margin: 0 0 1.5rem 0;
        word-break: break-word;
        hyphens: auto;
    }
    
    /* SECTION INFO REQUESTER */
    .requester-info-section-2025 {
        margin-bottom: 1.5rem;
    }
    
    .info-list-2025 {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .info-row-2025 {
        font-size: 0.875rem;
        color: #1f2937;
        line-height: 1.6;
    }
    
    .info-label-2025 {
        font-weight: 400;
    }
    
    .info-value-highlight-red {
        color: #dc2626;
        font-weight: 500;
    }
    
    .info-value-highlight-red-bold {
        color: #b91c1c;
        font-weight: 600;
    }
    
    /* SECTION DETAILS */
    .service-details-section-2025 {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .section-title-2025 {
        color: #1e3a8a;
        font-weight: 700;
        font-size: 0.9375rem;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .details-box-2025 {
        border: 1px solid #93c5fd;
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        color: #374151;
        font-size: 0.875rem;
        line-height: 1.7;
        background: #eff6ff;
        white-space: pre-wrap;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    
    /* GALERIE D'IMAGES - MOBILE FIRST RESPONSIVE */
    .image-gallery-2025 {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 colonnes sur mobile */
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .gallery-item-2025 {
        position: relative;
        border: 1px solid #93c5fd;
        border-radius: var(--border-radius-lg);
        padding: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 8rem;
        background: #eff6ff;
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition-base);
        will-change: transform;
        -webkit-user-select: none;
        user-select: none;
    }
    
    .gallery-item-2025:hover,
    .gallery-item-2025:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        transform: translateY(-2px) scale(1.02);
    }
    
    .gallery-item-2025:active {
        transform: translateY(0) scale(0.98);
    }
    
    .gallery-item-2025 img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        border-radius: var(--border-radius-lg);
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
    
    .gallery-placeholder-2025 {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #60a5fa;
    }
    
    .gallery-placeholder-2025 svg {
        width: 2rem;
        height: 2rem;
        opacity: 0.5;
    }
    
    /* SECTION ACTIONS - STRUCTURE ORIGINALE RESPECTÉE */
    .action-section-2025 {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .action-buttons-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        flex: 1;
    }
    
    .action-cancel-group {
        text-align: left;
    }
    
    /* BOUTONS D'ACTION - MOBILE FIRST */
    .btn-messaging-2025 {
        border: 1px solid #3b82f6;
        color: #2563eb;
        background: transparent;
        padding: 0.625rem 1.5rem;
        border-radius: 9999px;
        font-weight: 500;
        font-size: 0.8125rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-base);
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        touch-action: manipulation;
        -webkit-user-select: none;
        user-select: none;
        width: 100%; /* Full width sur mobile */
    }
    
    .btn-messaging-2025:hover,
    .btn-messaging-2025:focus {
        background: #eff6ff;
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .btn-messaging-2025:active {
        transform: scale(0.97);
    }
    
    .link-cancel-2025 {
        color: #2563eb;
        font-weight: 500;
        font-size: 0.875rem;
        text-decoration: underline;
        cursor: pointer;
        transition: var(--transition-base);
        display: inline-block;
        touch-action: manipulation;
    }
    
    .link-cancel-2025:hover,
    .link-cancel-2025:focus {
        color: #1d4ed8;
        text-decoration: none;
    }
    
    /* MODALS - OPTIMISÉS POUR PERFORMANCE */
    .modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 9998;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem; /* px-4 */
        opacity: 0;
        transition: opacity 0.2s ease;
        will-change: opacity;
    }
    
    .modal-overlay-2025.active {
        display: flex;
        opacity: 1;
    }
    
    .modal-content-2025 {
        background: white;
        border-radius: var(--border-radius-2xl);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        max-width: 28rem;
        width: 100%;
        padding: 1.5rem;
        text-align: center;
        position: relative;
        transform: scale(0.95);
        opacity: 0;
        transition: var(--transition-smooth);
        will-change: transform, opacity;
        max-height: 90vh;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .modal-overlay-2025.active .modal-content-2025 {
        transform: scale(1);
        opacity: 1;
    }
    
    /* MODAL CLOSE BUTTON */
    .modal-close-btn-2025 {
        position: absolute;
        top: 0.5rem;
        right: 0.75rem;
        color: #9ca3af;
        font-size: 1.5rem;
        line-height: 1;
        cursor: pointer;
        background: none;
        border: none;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition-base);
        touch-action: manipulation;
    }
    
    .modal-close-btn-2025:hover,
    .modal-close-btn-2025:focus {
        color: #374151;
        background: #f3f4f6;
        outline: none;
    }
    
    /* MODAL TITLES */
    .modal-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    
    /* FORM ELEMENTS */
    .modal-form-2025 {
        text-align: left;
        margin-top: 1rem;
    }
    
    .form-group-2025 {
        margin-bottom: 1rem;
    }
    
    .form-label-2025 {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
    }
    
    .form-select-2025,
    .form-textarea-2025 {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: var(--border-radius-md);
        padding: 0.625rem 0.75rem;
        font-size: 0.875rem;
        transition: var(--transition-base);
        font-family: inherit;
        background: white;
    }
    
    .form-select-2025:focus,
    .form-textarea-2025:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .form-textarea-2025 {
        resize: vertical;
        min-height: 6rem;
    }
    
    /* INFO BOXES DANS MODAL */
    .modal-info-box-2025 {
        font-size: 0.9375rem;
        line-height: 1.6;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-md);
        margin-bottom: 0.5rem;
        text-align: left;
    }
    
    .info-box-success {
        color: #1d4ed8;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-left: 3px solid #3b82f6;
    }
    
    .info-box-danger {
        color: #dc2626;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-left: 3px solid #ef4444;
    }
    
    /* MODAL ACTIONS - MOBILE FIRST */
    .modal-actions-2025 {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: stretch;
        margin-top: 1rem;
        gap: 1rem;
    }
    
    .modal-btn-primary-2025 {
        background: #2563eb;
        color: white;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.625rem 1rem;
        font-size: 0.75rem;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.025em;
        width: 100%; /* Full width sur mobile */
        touch-action: manipulation;
    }
    
    .modal-btn-primary-2025:hover,
    .modal-btn-primary-2025:focus {
        background: #1d4ed8;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        outline: none;
    }
    
    .modal-btn-secondary-2025 {
        color: #1d4ed8;
        text-decoration: underline;
        font-weight: 600;
        font-size: 0.75rem;
        background: none;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        touch-action: manipulation;
        width: 100%; /* Full width sur mobile */
        padding: 0.625rem;
    }
    
    .modal-btn-secondary-2025:hover,
    .modal-btn-secondary-2025:focus {
        color: #1e40af;
        text-decoration: none;
        outline: none;
    }
    
    /* RESULT MODAL */
    .modal-result-2025 {
        padding: 2rem 1rem;
    }
    
    .result-title-2025 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .result-subtitle-2025 {
        color: #dc2626;
        margin-top: 0.5rem;
        font-size: 1rem;
    }
    
    /* LOADING MODAL */
    .loading-spinner-2025 {
        width: 4rem;
        height: 4rem;
        border: 4px solid #bfdbfe;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1rem;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    .loading-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
    }
    
    .loading-text-2025 {
        color: #1e3a8a;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    /* RESPONSIVE - TABLET (640px+) */
    @media (min-width: 640px) {
        .job-detail-main {
            padding: 1.5rem;
        }
        
        .job-detail-card-wrapper {
            padding: 2rem;
        }
        
        .job-title-main-2025 {
            font-size: 1.25rem;
        }
        
        .section-title-2025 {
            font-size: 1rem;
        }
        
        /* 3 colonnes sur écran moyen */
        .image-gallery-2025 {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .action-section-2025 {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        
        .action-cancel-group {
            text-align: right;
        }
        
        /* Boutons auto width sur desktop */
        .btn-messaging-2025 {
            width: auto;
        }
        
        /* Modal actions en ligne */
        .modal-actions-2025 {
            flex-direction: row;
            align-items: center;
        }
        
        .modal-btn-primary-2025,
        .modal-btn-secondary-2025 {
            width: auto;
            flex: 1;
        }
    }
    
    /* RESPONSIVE - DESKTOP (1024px+) */
    @media (min-width: 1024px) {
        .job-detail-wrapper {
            flex-direction: row;
        }
        
        .job-detail-main {
            padding-left: 2.5rem;
            padding-right: 2rem;
        }
        
        .image-gallery-2025 {
            grid-template-columns: repeat(4, 1fr);
        }
        
        .modal-content-2025 {
            max-width: 32rem;
        }
    }
    
    /* PRÉFÉRENCES UTILISATEUR */
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
        .job-detail-wrapper {
            background: #0f172a;
        }
        
        .job-detail-card-wrapper {
            background: #1e293b;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }
    }
    
    /* OPTIMISATIONS SUPPLÉMENTAIRES */
    @supports (content-visibility: auto) {
        .gallery-item-2025 {
            content-visibility: auto;
            contain-intrinsic-size: 8rem;
        }
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
    
    /* FOCUS VISIBLE POUR ACCESSIBILITÉ */
    .btn-messaging-2025:focus-visible,
    .link-cancel-2025:focus-visible,
    .modal-close-btn-2025:focus-visible,
    .modal-btn-primary-2025:focus-visible,
    .modal-btn-secondary-2025:focus-visible {
        outline: 3px solid #3b82f6;
        outline-offset: 2px;
    }
</style>

<div class="job-detail-wrapper">
    <!-- Main Content -->
    <div class="job-detail-main">
        <div class="job-detail-card-wrapper">
            
            <!-- Title -->
            <h2 class="job-title-main-2025">{{ $job->title ?? 'Service Request' }}</h2>
            
            <!-- Requester Info -->
            <div class="requester-info-section-2025">
                <div class="info-list-2025">
                    <p class="info-row-2025">
                        <span class="info-label-2025">Requester:</span>
                        <span class="info-value-highlight-red">{{ $job->requester->name ?? '-' }}</span>
                    </p>
                    <p class="info-row-2025">
                        <span class="info-label-2025">Phone:</span>
                        <span class="info-value-highlight-red-bold">{{ $job->requester->phone_number ?? '-' }}</span>
                    </p>
                    <p class="info-row-2025">
                        <span class="info-label-2025">Date:</span>
                        <span>{{ $job->created_at ? $job->created_at->format('d/m/Y') : '-' }}</span>
                    </p>
                    @if($job->service_duration)
                    <p class="info-row-2025">
                        <span class="info-label-2025">Duration:</span>
                        <span>{{ $job->service_duration }}</span>
                    </p>
                    @endif
                    <p class="info-row-2025">
                        <span class="info-label-2025">Location:</span>
                        <span>{{ $job->location_city ?? '-' }}, {{ $job->location_country ?? '-' }}</span>
                    </p>
                    <p class="info-row-2025">
                        <span class="info-label-2025">Language:</span>
                        <span>{{ $job->language ?? '-' }}</span>
                    </p>
                </div>
            </div>
            
            <!-- Service Details -->
            <div class="service-details-section-2025">
                <h3 class="section-title-2025">Details of the Service Request</h3>
                <div class="details-box-2025">{{ $job->description ?? 'No description provided.' }}</div>
            </div>
            
            <!-- Image Thumbnails -->
            <div class="image-gallery-2025">
                @php
                    $images = json_decode($job->attachments ?? '[]', true);
                @endphp
                @forelse($images as $img)
                    <div class="gallery-item-2025" 
                         role="button" 
                         tabindex="0" 
                         aria-label="View attachment image"
                         onclick="viewImage('{{ asset($img) }}')">
                        <img src="{{ asset($img) }}" 
                             alt="Attachment" 
                             loading="lazy"
                             decoding="async" />
                    </div>
                @empty
                    @for ($i = 0; $i < 4; $i++)
                        <div class="gallery-item-2025" aria-label="No attachment">
                            <div class="gallery-placeholder-2025">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M4 16l4-4a3 3 0 014 0l4 4M2 20h20M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
            
            <!-- Action Buttons + Cancel -->
<div class="action-section-2025">
    <!-- Left Buttons -->
    <div class="action-buttons-group">
        <a href="{{ route('user.conversation') }}" 
           class="btn-messaging-2025">
            PRIVATE MESSAGING
        </a>
    </div>
    
    <!-- Right Text -->
    <div class="action-cancel-group">
        {{-- ✅ Prestataire peut annuler AVANT démarrage --}}
        @if(in_array($job->status, ['published', 'waiting_to_start']))
            <a href="#" 
               onclick="openCancelServicePopup(event)" 
               class="link-cancel-2025">
                Cancel the service
            </a>
        @endif
        
        {{-- ✅ Pendant in_progress : Prestataire peut signaler un problème --}}
        @if($job->status === 'in_progress')
            <a href="#" 
               onclick="openDisputePopup(event)" 
               class="link-cancel-2025">
                <i class="fas fa-flag"></i> Report an issue
            </a>
        @endif
    </div>
</div>
            </div>
            
        </div>
    </div>
</div>

<!-- Cancel Service Popup Modal -->
<div id="cancelServicePopup" 
     class="modal-overlay-2025" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="cancelModalTitle"
     aria-hidden="true">
    <div class="modal-content-2025">
        <button onclick="closeCancelServicePopup()" 
                class="modal-close-btn-2025" 
                aria-label="Close modal">
            &times;
        </button>
        
        <h2 class="modal-title-2025" id="cancelModalTitle">
            Why do you want to cancel your job for service requester?
        </h2>
        
        <form id="cancelServiceForm" class="modal-form-2025">
            <div class="form-group-2025">
                <label for="cancelReason" class="form-label-2025">Select a reason</label>
                <select id="cancelReason" 
                        class="form-select-2025" 
                        required 
                        aria-required="true">
                    <option value="">-- Please choose --</option>
                    <option>I'm no longer available on the scheduled dates.</option>
                    <option>I was unable to establish communication with the requester.</option>
                    <option>I have changed location and can no longer complete the mission.</option>
                    <option>The mission details are unclear or insufficient.</option>
                    <option>I'm dealing with a personal or family emergency.</option>
                    <option>I lack the necessary tools or resources to complete the mission.</option>
                    <option>I don't feel comfortable with the client's profile.</option>
                    <option value="other">Other reason (please specify below)</option>
                </select>
            </div>
            
            <div class="form-group-2025">
                <label for="cancelDescription" class="form-label-2025">Other reason (please specify):</label>
                <textarea id="cancelDescription" 
                          class="form-textarea-2025" 
                          maxlength="300" 
                          placeholder="Free text field"
                          aria-describedby="charLimit"></textarea>
                <span id="charLimit" class="sr-only">Maximum 300 characters</span>
            </div>
            
            <div class="modal-info-box-2025 info-box-success">
                By providing this service, you increase the number of point in your account and you will be more visible.
            </div>
            
            <div class="modal-info-box-2025 info-box-danger">
                If you cancel your service, you will lose 150 points on your ranking and you will be much less visible.
            </div>
            
            <div class="modal-actions-2025">
                <button type="button" 
                        onclick="closeCancelServicePopup()" 
                        class="modal-btn-primary-2025"
                        aria-label="Keep the service">
                    I WILL STILL PROVIDE THE SERVICE
                </button>
                <button type="submit" 
                        class="modal-btn-secondary-2025"
                        aria-label="Confirm cancellation">
                    I CANCEL
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Cancel Service Result Popup -->
<div id="cancelServiceResultPopup" 
     class="modal-overlay-2025" 
     role="alert" 
     aria-live="assertive" 
     aria-hidden="true">
    <div class="modal-content-2025">
        <div class="modal-result-2025">
            <div class="result-title-2025">
                TOO BAD. THE SERVICE REQUESTER<br>WILL BE DISAPPOINTED
            </div>
            <div class="result-subtitle-2025">
                You have lost some points
            </div>
        </div>
    </div>
</div>

<!-- Loading Popup -->
<div id="loadingPopup" 
     class="modal-overlay-2025" 
     role="alert" 
     aria-live="assertive" 
     aria-busy="true"
     aria-hidden="true">
    <div class="modal-content-2025">
        <div class="modal-result-2025">
            <div class="loading-spinner-2025" aria-hidden="true"></div>
            <h3 class="loading-title-2025">Canceling...</h3>
            <div class="loading-text-2025">Please wait while we process your request.</div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // FONCTIONS D'OUVERTURE/FERMETURE DES MODALS
    function openCancelServicePopup(e) {
        e.preventDefault();
        const modal = document.getElementById('cancelServicePopup');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            // Focus trap - focus sur le premier élément
            setTimeout(() => {
                const firstFocusable = modal.querySelector('select, button');
                if (firstFocusable) firstFocusable.focus();
            }, 100);
        }
    }
    
    function closeCancelServicePopup() {
        const modal = document.getElementById('cancelServicePopup');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
    
    function openLoadingPopup() {
        const modal = document.getElementById('loadingPopup');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }
    }
    
    function closeLoadingPopup() {
        const modal = document.getElementById('loadingPopup');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        }
    }
    
    function openResultPopup() {
        const modal = document.getElementById('cancelServiceResultPopup');
        if (modal) {
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        }
    }
    
    function closeResultPopup() {
        const modal = document.getElementById('cancelServiceResultPopup');
        if (modal) {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
    
    // GESTION DU FORMULAIRE
    const form = document.getElementById('cancelServiceForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const reasonSelect = document.getElementById('cancelReason');
            const descriptionTextarea = document.getElementById('cancelDescription');
            
            const reason = reasonSelect ? reasonSelect.value : '';
            const description = descriptionTextarea ? descriptionTextarea.value : '';
            
            if (!reason) {
                if (reasonSelect) reasonSelect.focus();
                return;
            }
            
            closeCancelServicePopup();
            openLoadingPopup();
            
            fetch('/api/mission/cancel/by-provider', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    mission_id: {{ $job->id }},
                    reason: reason,
                    description: description,
                    cancelled_by: 'provider',
                    cancelled_on: new Date().toISOString()
                })
            })
            .then(response => {
                closeLoadingPopup();
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    openResultPopup();
                    
                    setTimeout(() => {
                        window.location.href = '/job-list';
                    }, 3000);
                } else {
                    console.error('Error:', data.message || 'An error occurred');
                }
            })
            .catch(error => {
                closeLoadingPopup();
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    }
    
    // FERMETURE SUR CLIC OUTSIDE
    document.getElementById('cancelServicePopup')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelServicePopup();
        }
    });
    
    document.getElementById('cancelServiceResultPopup')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeResultPopup();
        }
    });
    
    // FERMETURE SUR TOUCHE ESCAPE
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCancelServicePopup();
            closeResultPopup();
        }
    });
    
    // FONCTION VIEW IMAGE (PLACEHOLDER)
    function viewImage(imageUrl) {
        // Peut être étendue pour ouvrir une lightbox
        console.log('View image:', imageUrl);
    }
    
    // EXPOSITION DES FONCTIONS GLOBALEMENT
    window.openCancelServicePopup = openCancelServicePopup;
    window.closeCancelServicePopup = closeCancelServicePopup;
    window.viewImage = viewImage;
    
})();
</script>

@endsection