@extends('dashboard.layouts.master')
@section('title', 'Identity Documents')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-danger: #ef4444;
        --color-warning: #f59e0b;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #475569;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
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

    .documents-upload-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0.875rem;
        padding-bottom: 8rem;
        min-height: 100vh;
        contain: layout style paint;
    }

    .documents-upload-card {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        border: 2px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        contain: layout style;
    }

    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .page-subtitle {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        line-height: 1.5;
    }

    .document-buttons-grid {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .document-button {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-lg);
        padding: 1rem 1.5rem;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        text-align: center;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
        position: relative;
    }

    .document-button:hover:not(:disabled) {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
    }

    .document-button:active:not(:disabled) {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }

    .document-button:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .document-button:disabled {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        cursor: not-allowed;
        opacity: 0.9;
    }

    .document-button-uploaded {
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
    }

    .document-button-checkmark {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-success);
        font-size: 1rem;
        font-weight: bold;
    }

    .document-button-locked {
        font-size: 0.75rem;
        margin-top: 0.25rem;
        opacity: 0.9;
        display: block;
    }

    .progress-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e5e7eb;
    }

    .progress-bar-container {
        width: 100%;
        height: 8px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        border-radius: 999px;
        transition: width 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        will-change: width;
        transform: translateZ(0);
    }

    .progress-text {
        text-align: center;
        margin-top: 0.75rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text-secondary);
    }

    /* Documents Display Section */
    .documents-display-section {
        margin-top: 2rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: var(--border-radius-lg);
        border: 2px solid #e2e8f0;
    }

    .documents-display-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .document-item {
        background: white;
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-bottom: 1rem;
        border: 2px solid #e2e8f0;
    }

    .document-item:last-child {
        margin-bottom: 0;
    }

    .document-item-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .document-item-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-primary);
        text-transform: uppercase;
    }

    .document-item-badge {
        background: var(--color-success);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .document-item-locked {
        background: #64748b;
    }

    .document-images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 0.75rem;
    }

    .document-image-container {
        position: relative;
        aspect-ratio: 1.4;
        border-radius: var(--border-radius-md);
        overflow: hidden;
        border: 2px solid #e2e8f0;
        background: #f1f5f9;
    }

    .document-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .document-image-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.75);
        color: white;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        text-transform: uppercase;
    }

    .no-documents-message {
        text-align: center;
        padding: 2rem;
        color: var(--color-text-secondary);
        font-size: 0.875rem;
    }

    .lock-message {
        margin-top: 0.75rem;
        padding: 0.75rem;
        background: #fef3c7;
        border: 2px solid #fbbf24;
        border-radius: var(--border-radius-md);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .lock-message-icon {
        color: #d97706;
        font-size: 1.125rem;
    }

    .lock-message-text {
        font-size: 0.8125rem;
        color: #92400e;
        font-weight: 500;
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0.2s ease;
        transform: translateZ(0);
        -webkit-backface-visibility: hidden;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-container {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }

    .modal-container.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: white;
        border-radius: var(--border-radius-xl);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        max-width: 700px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        padding: 2rem 1.5rem;
        padding-bottom: 6rem;
        transform: scale(0.95) translateZ(0);
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        will-change: transform;
        -webkit-overflow-scrolling: touch;
    }

    .modal-container.active .modal-content {
        transform: scale(1) translateZ(0);
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f3f4f6;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        font-size: 1.5rem;
        color: #6b7280;
        -webkit-tap-highlight-color: transparent;
        z-index: 10;
    }

    .modal-close:hover {
        background: #e5e7eb;
        transform: rotate(90deg);
    }

    .modal-close:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 2px;
    }

    .modal-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        padding-right: 2rem;
    }

    .upload-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .upload-field {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .upload-label-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .upload-box {
        width: 100%;
        max-width: 200px;
        aspect-ratio: 1;
        border: 3px dashed var(--color-primary-light);
        border-radius: var(--border-radius-lg);
        background: #eff6ff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        position: relative;
        overflow: hidden;
    }

    .upload-box:hover {
        background: #dbeafe;
        border-color: var(--color-primary);
        transform: translateY(-2px);
    }

    .upload-box:focus-within {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    .upload-text {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-primary);
        text-align: center;
    }

    .upload-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-preview {
        position: absolute;
        inset: 0;
        display: none;
    }

    .upload-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-box.has-file .upload-preview {
        display: block;
    }

    .upload-box.has-file .upload-icon,
    .upload-box.has-file .upload-text {
        display: none;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e7eb;
        position: absolute;
        bottom: 1.5rem;
        left: 1.5rem;
        right: 1.5rem;
        background: white;
    }

    .btn-cancel {
        padding: 0.75rem 1.5rem;
        background: #f1f5f9;
        color: var(--color-text-primary);
        border: none;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        -webkit-tap-highlight-color: transparent;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
    }

    .btn-cancel:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .btn-submit {
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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

    .btn-submit:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    * {
        box-sizing: border-box;
    }

    @media (min-width: 640px) {
        .documents-upload-container {
            padding: 1.5rem;
            padding-bottom: 8rem;
        }

        .documents-upload-card {
            padding: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .upload-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .modal-content {
            padding: 2.5rem 2rem;
            padding-bottom: 6rem;
        }

        .modal-actions {
            left: 2rem;
            right: 2rem;
        }
    }

    @media (min-width: 1024px) {
        .documents-upload-container {
            padding: 2rem;
            padding-bottom: 2rem;
        }

        .documents-upload-card {
            padding: 2.5rem;
        }

        .modal-content {
            padding-bottom: 2rem;
        }

        .modal-actions {
            position: relative;
            bottom: auto;
            left: auto;
            right: auto;
        }
    }

    @media (max-width: 768px) {
        .modal-content {
            border-radius: var(--border-radius-xl) var(--border-radius-xl) 0 0;
            max-height: 95vh;
        }
    }
</style>

<div class="documents-upload-container">
    <div class="documents-upload-card">
        
        <!-- Header -->
        <div class="page-header">
            <h2 class="page-title">My Identity Documents</h2>
            <p class="page-subtitle">
                @if(!empty($documents))
                    Your documents have been uploaded and locked. They cannot be modified.
                @else
                    Click on the document you are going to send us
                @endif
            </p>
        </div>

        <!-- Document Buttons -->
        <div class="document-buttons-grid">
            @if(isset($documents['european_id']))
            <button class="document-button document-button-uploaded" disabled aria-label="European identity card uploaded">
                <span class="document-button-checkmark">✓</span>
                European identity card
                <span class="document-button-locked">🔒 Locked</span>
            </button>
            @else
            <button onclick="openModal('european_id')" class="document-button" aria-label="Upload European identity card">
                European identity card
            </button>
            @endif

            @if(isset($documents['passport']))
            <button class="document-button document-button-uploaded" disabled aria-label="Passport uploaded">
                <span class="document-button-checkmark">✓</span>
                Passport
                <span class="document-button-locked">🔒 Locked</span>
            </button>
            @else
            <button onclick="openModal('passport')" class="document-button" aria-label="Upload passport">
                Passport
            </button>
            @endif

            @if(isset($documents['license']))
            <button class="document-button document-button-uploaded" disabled aria-label="Driver's license uploaded">
                <span class="document-button-checkmark">✓</span>
                Driver's license
                <span class="document-button-locked">🔒 Locked</span>
            </button>
            @else
            <button onclick="openModal('license')" class="document-button" aria-label="Upload driver's license">
                Driver's license
            </button>
            @endif
        </div>

        <!-- Display Uploaded Documents -->
        @if(!empty($documents))
        <div class="documents-display-section">
            <h3 class="documents-display-title">📄 Uploaded Documents (Read-only)</h3>
            
            @if(isset($documents['european_id']))
            <div class="document-item">
                <div class="document-item-header">
                    <span class="document-item-name">European Identity Card</span>
                    <span class="document-item-badge document-item-locked">
                        <i class="fas fa-lock"></i> Locked
                    </span>
                </div>
                <div class="document-images-grid">
                    @if(isset($documents['european_id']['front']))
                    <div class="document-image-container">
                        <img src="{{ asset($documents['european_id']['front']) }}" alt="European ID Front">
                        <span class="document-image-label">Front</span>
                    </div>
                    @endif
                    @if(isset($documents['european_id']['back']))
                    <div class="document-image-container">
                        <img src="{{ asset($documents['european_id']['back']) }}" alt="European ID Back">
                        <span class="document-image-label">Back</span>
                    </div>
                    @endif
                </div>
                <div class="lock-message">
                    <i class="fas fa-lock lock-message-icon"></i>
                    <span class="lock-message-text">This document has been verified and cannot be modified</span>
                </div>
            </div>
            @endif

            @if(isset($documents['passport']))
            <div class="document-item">
                <div class="document-item-header">
                    <span class="document-item-name">Passport</span>
                    <span class="document-item-badge document-item-locked">
                        <i class="fas fa-lock"></i> Locked
                    </span>
                </div>
                <div class="document-images-grid">
                    @if(isset($documents['passport']['front']))
                    <div class="document-image-container">
                        <img src="{{ asset($documents['passport']['front']) }}" alt="Passport">
                        <span class="document-image-label">Passport</span>
                    </div>
                    @endif
                </div>
                <div class="lock-message">
                    <i class="fas fa-lock lock-message-icon"></i>
                    <span class="lock-message-text">This document has been verified and cannot be modified</span>
                </div>
            </div>
            @endif

            @if(isset($documents['license']))
            <div class="document-item">
                <div class="document-item-header">
                    <span class="document-item-name">Driver's License</span>
                    <span class="document-item-badge document-item-locked">
                        <i class="fas fa-lock"></i> Locked
                    </span>
                </div>
                <div class="document-images-grid">
                    @if(isset($documents['license']['front']))
                    <div class="document-image-container">
                        <img src="{{ asset($documents['license']['front']) }}" alt="License Front">
                        <span class="document-image-label">Front</span>
                    </div>
                    @endif
                    @if(isset($documents['license']['back']))
                    <div class="document-image-container">
                        <img src="{{ asset($documents['license']['back']) }}" alt="License Back">
                        <span class="document-image-label">Back</span>
                    </div>
                    @endif
                </div>
                <div class="lock-message">
                    <i class="fas fa-lock lock-message-icon"></i>
                    <span class="lock-message-text">This document has been verified and cannot be modified</span>
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Progress Bar -->
        <div class="progress-section">
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="progress-text">25% Complete</p>
        </div>
    </div>
</div>

<!-- Modal Overlay -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal()"></div>

<!-- Modal for Document Upload -->
<div class="modal-container" id="documentModal">
    <div class="modal-content">
        <button onclick="closeModal()" class="modal-close" aria-label="Close modal">&times;</button>
        
        <h3 class="modal-title" id="modalTitle">I Send My Document</h3>
        
        <div class="upload-grid" id="documentFields">
            <!-- Dynamic Content will be inserted here -->
        </div>

        <div class="modal-actions">
            <button onclick="closeModal()" class="btn-cancel">Cancel</button>
            <button onclick="submitDocument()" class="btn-submit" id="submitBtn" aria-label="Submit document">
                Submit Document
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
(function() {
    'use strict';
    
    let currentDocType = '';
    const uploadedDocuments = @json($documents ?? []);

    window.openModal = function(docType) {
        // Check if document already exists
        if (uploadedDocuments[docType]) {
            if (typeof toastr !== 'undefined') {
                toastr.warning('🔒 This document has already been uploaded and cannot be modified.');
            } else {
                alert('This document has already been uploaded and cannot be modified.');
            }
            return;
        }

        currentDocType = docType;
        const modal = document.getElementById('documentModal');
        const overlay = document.getElementById('modalOverlay');
        const documentFields = document.getElementById('documentFields');
        
        // Clear previous content
        documentFields.innerHTML = '';

        // Update modal title
        const titles = {
            'european_id': 'European Identity Card',
            'passport': 'Passport',
            'license': 'Driver\'s License'
        };
        document.getElementById('modalTitle').textContent = titles[docType] || 'Upload Document';

        // Dynamically generate form fields based on document type
        if (docType === 'european_id' || docType === 'license') {
            documentFields.innerHTML = `
                <div class="upload-field">
                    <label class="upload-label-text">Front Side</label>
                    <label class="upload-box" id="front-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="upload-icon" alt="" aria-hidden="true" />
                        <span class="upload-text">Upload photo</span>
                        <input type="file" class="upload-input" id="front-${docType}" accept="image/*" onchange="previewImage(this, 'front-box')" aria-label="Upload front side of document">
                        <div class="upload-preview"></div>
                    </label>
                </div>
                <div class="upload-field">
                    <label class="upload-label-text">Back Side</label>
                    <label class="upload-box" id="back-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="upload-icon" alt="" aria-hidden="true" />
                        <span class="upload-text">Upload photo</span>
                        <input type="file" class="upload-input" id="back-${docType}" accept="image/*" onchange="previewImage(this, 'back-box')" aria-label="Upload back side of document">
                        <div class="upload-preview"></div>
                    </label>
                </div>
            `;
        } else if (docType === 'passport') {
            documentFields.innerHTML = `
                <div class="upload-field">
                    <label class="upload-label-text">Passport Photo</label>
                    <label class="upload-box" id="front-box">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="upload-icon" alt="" aria-hidden="true" />
                        <span class="upload-text">Upload photo</span>
                        <input type="file" class="upload-input" id="front-${docType}" accept="image/*" onchange="previewImage(this, 'front-box')" aria-label="Upload passport photo">
                        <div class="upload-preview"></div>
                    </label>
                </div>
            `;
        }

        requestAnimationFrame(() => {
            overlay.classList.add('active');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    };

    window.closeModal = function() {
        const modal = document.getElementById('documentModal');
        const overlay = document.getElementById('modalOverlay');
        
        modal.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    window.previewImage = function(input, boxId) {
        const box = document.getElementById(boxId);
        const preview = box.querySelector('.upload-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Document preview">`;
                box.classList.add('has-file');
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    };

    window.submitDocument = function() {
        const submitBtn = document.getElementById('submitBtn');
        const originalHTML = submitBtn.innerHTML;
        
        const formData = new FormData();
        const frontFile = document.getElementById(`front-${currentDocType}`).files[0];
        const backFile = document.getElementById(`back-${currentDocType}`)?.files[0];

        if (!frontFile) {
            if (typeof toastr !== 'undefined') {
                toastr.warning('📸 Please upload the front photo!');
            } else {
                alert('Please upload the front photo!');
            }
            return;
        }

        formData.append('document_type', currentDocType);
        formData.append('front', frontFile);
        if (backFile) formData.append('back', backFile);

        // Disable button and show loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
        submitBtn.disabled = true;
        submitBtn.setAttribute('aria-busy', 'true');

        fetch('{{ route('provider.upload.document') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('✨ Document uploaded successfully!');
                } else {
                    alert('Document uploaded successfully!');
                }
                closeModal();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('😅 Failed to upload document. Please try again.');
                } else {
                    alert('Failed to upload document.');
                }
            }
        })
        .catch(err => {
            console.error(err);
            if (typeof toastr !== 'undefined') {
                toastr.error('🤔 Connection error. Please check your internet and try again.');
            } else {
                alert('Error occurred while uploading.');
            }
        })
        .finally(() => {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
            submitBtn.removeAttribute('aria-busy');
        });
    };

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
})();
</script>

@endsection