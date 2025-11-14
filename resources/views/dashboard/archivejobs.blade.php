@extends('dashboard.layouts.master')

@section('title', 'Job List')

@section('content')

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --border-radius-2xl: 2rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    .archive-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        margin-bottom: 2rem;
    }
    
    .archive-title-2025 {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        color: #1e3a8a;
        margin-bottom: 1.5rem;
    }
    
    .archive-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .archive-job-card-2025 {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 2px solid #93c5fd;
        border-radius: var(--border-radius-2xl);
        box-shadow: var(--shadow-sm);
        padding: 1.25rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 1rem;
        transition: var(--transition-base);
        animation: fadeIn 0.4s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .archive-job-card-2025:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: #60a5fa;
    }
    
    .archive-job-content {
        flex: 1;
        min-width: 0;
    }
    
    .archive-job-title {
        color: #1e3a8a;
        font-weight: 700;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        word-break: break-word;
    }
    
    .archive-job-details {
        font-size: 0.8125rem;
        color: #374151;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .archive-job-details span {
        line-height: 1.5;
    }
    
    .archive-job-details .font-semibold {
        font-weight: 600;
        color: #1e3a8a;
    }
    
    .archive-job-icon-container {
        min-width: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .archive-job-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(147, 197, 253, 0.3);
    }
    
    .archive-job-icon svg {
        width: 1.75rem;
        height: 1.75rem;
        color: #60a5fa;
    }
    
    .archive-empty-state {
        grid-column: 1 / -1;
        text-align: center;
        color: #9ca3af;
        padding: 3rem 1.5rem;
        background: var(--color-bg-secondary);
        border: 2px dashed #cbd5e1;
        border-radius: var(--border-radius-xl);
    }
    
    .archive-empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
    
    .archive-empty-text {
        font-size: 0.9375rem;
        font-weight: 600;
    }
    
    /* RESPONSIVE - TABLET */
    @media (min-width: 640px) {
        .archive-container-2025 {
            padding: 1.5rem;
        }
        
        .archive-title-2025 {
            font-size: 1.875rem;
            margin-bottom: 2rem;
        }
        
        .archive-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        
        .archive-job-card-2025 {
            padding: 1.5rem;
        }
    }
    
    /* RESPONSIVE - DESKTOP */
    @media (min-width: 1024px) {
        .archive-container-2025 {
            padding: 2rem;
        }
        
        .archive-grid-2025 {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }
    
    /* REDUCED MOTION */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
    
    /* OPTIMIZATIONS */
    @supports (content-visibility: auto) {
        .archive-job-card-2025 {
            content-visibility: auto;
        }
    }
</style>

<div class="archive-container-2025">
    <h2 class="archive-title-2025">Archive Jobs</h2>

    <div class="archive-grid-2025">
        @forelse($jobs as $job)
            <article class="archive-job-card-2025" 
                     aria-label="Archived job: {{ $job->title ?? 'Mission' }}">
                <div class="archive-job-content">
                    <h3 class="archive-job-title">
                        {{ $job->title ?? 'Mission' }}
                    </h3>
                    
                    <div class="archive-job-details">
                        <span>
                            Completed On :
                            <span class="font-semibold">
                                {{ $job->completed_at ? $job->completed_at->format('d M Y') : $job->updated_at->format('d M Y') }}
                            </span>
                        </span>
                        <span>
                            Created :
                            <span class="font-semibold">{{ $job->created_at->diffForHumans() }}</span>
                        </span>
                        <span>
                            Payment Status :
                            <span class="font-semibold">{{ ucfirst($job->payment_status) ?? '-' }}</span>
                        </span>
                        <span>
                            Country :
                            <span class="font-semibold">{{ $job->location_country ?? '-' }}</span>
                        </span>
                        <span>
                            Language :
                            <span class="font-semibold">{{ $job->language ?? '-' }}</span>
                        </span>
                    </div>
                </div>
                
                <div class="archive-job-icon-container">
                    <div class="archive-job-icon" aria-hidden="true">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </article>
        @empty
            <div class="archive-empty-state" role="status">
                <div class="archive-empty-icon" aria-hidden="true">
                    📦
                </div>
                <div class="archive-empty-text">
                    No completed missions yet.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection