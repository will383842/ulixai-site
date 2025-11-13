@extends('dashboard.layouts.master')

@section('title', 'My Documents')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-success: #10b981;
        --color-danger: #ef4444;
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

    .documents-container-2025 {
        max-width: 900px;
        margin: 0 auto;
        padding: 0.875rem;
        padding-bottom: 8rem;
        min-height: 100vh;
        contain: layout style paint;
    }

    .documents-card-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        border: 2px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        contain: layout style;
    }

    .documents-header-2025 {
        margin-bottom: 1.5rem;
    }

    .documents-title-2025 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .documents-subtitle-2025 {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        line-height: 1.5;
    }

    .documents-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .document-item-2025 {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem 1.5rem;
        border-radius: var(--border-radius-lg);
        border: 2px solid;
        text-decoration: none !important;
        transition: var(--transition-base);
        min-height: 140px;
        will-change: transform;
        transform: translateZ(0);
        -webkit-tap-highlight-color: transparent;
    }

    .document-item-2025.completed {
        border-color: var(--color-success);
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .document-item-2025.pending {
        border-color: var(--color-danger);
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .document-item-2025:hover {
        transform: translateY(-2px) translateZ(0);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .document-item-2025:active {
        transform: translateY(0) translateZ(0);
        transition-duration: 0.1s;
    }

    /* Accessibility: Focus visible */
    .document-item-2025:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .document-icon-2025 {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }

    .document-item-2025.completed .document-icon-2025 {
        background: var(--color-success);
        color: white;
    }

    .document-item-2025.pending .document-icon-2025 {
        background: var(--color-danger);
        color: white;
    }

    .document-label-2025 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-text-primary);
        text-align: center;
    }

    .document-status-badge-2025 {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        font-weight: 700;
    }

    .document-item-2025.completed .document-status-badge-2025 {
        background: var(--color-success);
        color: white;
    }

    .document-item-2025.pending .document-status-badge-2025 {
        background: var(--color-danger);
        color: white;
    }

    * {
        box-sizing: border-box;
    }

    @media (min-width: 640px) {
        .documents-container-2025 {
            padding: 1.5rem;
            padding-bottom: 8rem;
        }

        .documents-card-2025 {
            padding: 2rem;
        }

        .documents-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .documents-title-2025 {
            font-size: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .documents-container-2025 {
            padding: 2rem;
            padding-bottom: 2rem;
        }

        .documents-card-2025 {
            padding: 2.5rem;
        }
    }
</style>

<div class="documents-container-2025">
    <div class="documents-card-2025">
        
        <!-- Header -->
        <div class="documents-header-2025">
            <h2 class="documents-title-2025">My Documents</h2>
            <p class="documents-subtitle-2025">Upload your profile picture and identity documents. We recommend using a white background for best results.</p>
        </div>

        <!-- Documents Grid -->
        <div class="documents-grid-2025">

            <!-- Profile Picture -->
            <a href="{{ route('upload-picture') }}" class="document-item-2025 completed" aria-label="Upload profile picture - Status: Completed">
                <div class="document-icon-2025">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <span class="document-label-2025">My Profile Picture</span>
                <div class="document-status-badge-2025" aria-label="Completed">
                    <i class="fas fa-check" aria-hidden="true"></i>
                </div>
            </a>

            <!-- Identity Documents -->
            <a href="{{ route('upload-document') }}" class="document-item-2025 pending" aria-label="Upload identity documents - Status: Pending">
                <div class="document-icon-2025">
                    <i class="fas fa-id-card" aria-hidden="true"></i>
                </div>
                <span class="document-label-2025">Identity Documents</span>
                <div class="document-status-badge-2025" aria-label="Pending">
                    <i class="fas fa-exclamation" aria-hidden="true"></i>
                </div>
            </a>

        </div>
    </div>
</div>

@endsection