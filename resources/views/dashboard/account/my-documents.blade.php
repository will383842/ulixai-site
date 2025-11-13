@extends('dashboard.layouts.master')

@section('title', 'My Documents')

@section('content')

@php
    // Décoder le JSON si c'est une chaîne
    $documentsArray = is_string($documents) ? json_decode($documents, true) : $documents;
    $hasDocuments = !empty($documentsArray) && is_array($documentsArray);
    $docCount = $hasDocuments ? count($documentsArray) : 0;
@endphp

<style>
    .documents-container-2025 {
        max-width: 900px;
        margin: 0 auto;
        padding: 0.875rem 0.875rem 6rem;
        min-height: 100vh;
    }

    .documents-card-2025 {
        background: #fff;
        border-radius: 1.5rem;
        padding: 1.5rem;
        border: 2px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .documents-header-2025 {
        margin-bottom: 1.5rem;
    }

    .documents-title-2025 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 0.5rem 0;
    }

    .documents-subtitle-2025 {
        font-size: 0.875rem;
        color: #64748b;
        line-height: 1.5;
        margin: 0;
    }

    .documents-grid-2025 {
        display: grid;
        gap: 1rem;
        grid-template-columns: 1fr;
    }

    .document-item-2025 {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem 1.5rem;
        border-radius: 1.25rem;
        border: 2px solid;
        text-decoration: none;
        transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 140px;
        cursor: pointer;
    }

    .document-item-2025.completed {
        border-color: #10b981;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .document-item-2025.pending {
        border-color: #ef4444;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .document-item-2025:hover,
    .document-item-2025:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        outline: none;
    }

    .document-item-2025:focus-visible {
        outline: 3px solid #2563eb;
        outline-offset: 2px;
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
        background: #10b981;
        color: #fff;
    }

    .document-item-2025.pending .document-icon-2025 {
        background: #ef4444;
        color: #fff;
    }

    .document-label-2025 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #0f172a;
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
    }

    .document-item-2025.completed .document-status-badge-2025 {
        background: #10b981;
        color: #fff;
    }

    .document-item-2025.pending .document-status-badge-2025 {
        background: #ef4444;
        color: #fff;
    }

    .document-count-info {
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 1rem;
        text-align: center;
    }

    .document-count-info.all-complete {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 2px solid #10b981;
    }

    .document-count-text {
        font-size: 0.875rem;
        font-weight: 600;
        color: #64748b;
        margin: 0;
    }

    .document-count-info.all-complete .document-count-text {
        color: #10b981;
    }

    /* Tablet et plus */
    @media (min-width: 640px) {
        .documents-container-2025 {
            padding: 1.5rem 1.5rem 6rem;
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

    /* Desktop */
    @media (min-width: 1024px) {
        .documents-container-2025 {
            padding: 2rem;
        }
    }

    /* Préférence réduite pour les animations */
    @media (prefers-reduced-motion: reduce) {
        .document-item-2025 {
            transition: none;
        }
    }

    /* Mode sombre (si nécessaire) */
    @media (prefers-color-scheme: dark) {
        .documents-card-2025 {
            background: #1e293b;
            border-color: #334155;
        }

        .documents-title-2025,
        .document-label-2025 {
            color: #f1f5f9;
        }

        .documents-subtitle-2025,
        .document-count-text {
            color: #94a3b8;
        }
    }
</style>

<div class="documents-container-2025">
    <div class="documents-card-2025">
        
        <!-- Header -->
        <header class="documents-header-2025">
            <h1 class="documents-title-2025">My Documents</h1>
            <p class="documents-subtitle-2025">Upload your profile picture and identity documents. We recommend using a white background for best results.</p>
        </header>

        <!-- Documents Grid -->
        <div class="documents-grid-2025" role="list">

            <!-- Profile Picture -->
            <a href="{{ route('upload-picture') }}" 
               class="document-item-2025 completed" 
               role="listitem"
               aria-label="My Profile Picture - Completed">
                <div class="document-icon-2025" aria-hidden="true">
                    <i class="fas fa-user"></i>
                </div>
                <span class="document-label-2025">My Profile Picture</span>
                <div class="document-status-badge-2025" aria-hidden="true">
                    <i class="fas fa-check"></i>
                </div>
            </a>

            <!-- Identity Documents -->
            <a href="{{ route('upload-document') }}" 
               class="document-item-2025 {{ $hasDocuments ? 'completed' : 'pending' }}"
               role="listitem"
               aria-label="Identity Documents - {{ $hasDocuments ? 'Completed' : 'Pending' }}">
                <div class="document-icon-2025" aria-hidden="true">
                    <i class="fas fa-id-card"></i>
                </div>
                <span class="document-label-2025">Identity Documents</span>
                <div class="document-status-badge-2025" aria-hidden="true">
                    <i class="fas fa-{{ $hasDocuments ? 'check' : 'exclamation' }}"></i>
                </div>
            </a>

        </div>

        <!-- Document Count Info -->
        @if($hasDocuments)
        <div class="document-count-info all-complete" role="status" aria-live="polite">
            <p class="document-count-text">
                <i class="fas fa-check-circle" aria-hidden="true"></i> 
                {{ $docCount }} identity document{{ $docCount > 1 ? 's' : '' }} uploaded successfully
            </p>
        </div>
        @endif
    </div>
</div>

@endsection