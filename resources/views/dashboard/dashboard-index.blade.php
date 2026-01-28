@extends('dashboard.layouts.master')

@section('title', 'Dashboard')

@php
    $userCurrency = auth()->user()->preferred_currency ?? 'EUR';
    $currencySymbol = $userCurrency === 'USD' ? '$' : '€';
@endphp

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
        --color-pink: #ec4899;
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
    
    html, body {
        background: #ffffff !important;
        margin: 0 !important;
    }
    
    .dashboard-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        background: #ffffff;
        min-height: 100vh;
    }
    
    /* STAT CARDS - MOBILE FIRST */
    .stat-card-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        border: 2px solid #cbd5e1;
        transition: var(--transition-base);
        position: relative;
        cursor: pointer;
        text-decoration: none !important;
        display: block;
        color: inherit !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .stat-card-affiliate-special {
        background: linear-gradient(135deg, #f97316 0%, #ec4899 50%, #8b5cf6 100%) !important;
        border: none !important;
        color: white !important;
        box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3) !important;
        animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3); }
        50% { box-shadow: 0 12px 28px rgba(236, 72, 153, 0.4); }
    }
    
    .stat-card-affiliate-special .stat-value-2025,
    .stat-card-affiliate-special .stat-label-2025,
    .stat-card-affiliate-special .stat-card-extra {
        color: white !important;
    }
    
    .stat-card-affiliate-special .stat-card-icon {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white !important;
    }
    
    .stat-card-2025:active {
        transform: scale(0.98);
    }
    
    .stat-card-content {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .stat-card-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--border-radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        background: var(--icon-bg, #f1f5f9);
        color: var(--icon-color, var(--color-primary));
        flex-shrink: 0;
        transition: var(--transition-base);
    }
    
    .stat-card-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-value-2025 {
        font-size: 1.375rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.25rem;
        line-height: 1;
    }
    
    .stat-label-2025 {
        font-size: 0.6875rem;
        color: var(--color-text-secondary);
        font-weight: 500;
        line-height: 1.3;
    }
    
    .stat-card-extra {
        margin-top: 0.5rem;
        font-size: 0.625rem;
        color: var(--color-text-tertiary);
        line-height: 1.3;
    }
    
    /* MODAL AFFILIATION */
    .share-modal-overlay {
        position: fixed;
        inset: 0;
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
        margin-bottom: 0.25rem;
    }
    
    .share-stat-value.success { color: var(--color-success); }
    .share-stat-value.primary { color: var(--color-primary); }
    
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
        border-radius: 0.75rem;
        padding: 0.625rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
    }
    
    .share-section-label {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
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
        cursor: pointer;
        transition: var(--transition-base);
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
    
    /* MOTIVATION BANNER PROVIDER */
    .motivation-banner {
        border-radius: var(--border-radius-xl);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        border: 2px solid;
        animation: slideInBounce 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }
    
    @keyframes slideInBounce {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .motivation-emoji {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        animation: bounce 2s ease-in-out infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    .motivation-title {
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .motivation-message {
        font-size: 0.875rem;
        line-height: 1.5;
        color: #374151;
        margin-bottom: 0.875rem;
    }
    
    .motivation-progress-text {
        font-size: 0.8125rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        padding: 0.5rem 0.875rem;
        background: white;
        border-radius: var(--border-radius-md);
        display: inline-block;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
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
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    
    /* CARTE MOTIVATION REQUESTER - MOBILE FIRST */
    .requester-motivation-card {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        border-radius: var(--border-radius-lg);
        padding: 1rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .requester-motivation-content {
        flex: 1;
        min-width: 0;
    }
    
    .requester-motivation-emoji {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .requester-motivation-title {
        font-size: 0.9375rem;
        font-weight: 700;
        margin-bottom: 0.375rem;
        line-height: 1.3;
    }
    
    .requester-motivation-text {
        font-size: 0.8125rem;
        opacity: 0.95;
        line-height: 1.4;
    }
    
    .requester-info-box {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.75rem 1rem;
        border-radius: 999px;
        font-size: 0.8125rem;
        font-weight: 600;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        animation: pulseInfo 2s ease-in-out infinite;
    }
    
    @keyframes pulseInfo {
        0%, 100% { transform: translateY(0); opacity: 1; }
        50% { transform: translateY(-3px); opacity: 0.9; }
    }
    
    /* PROGRESS SECTION PROVIDER */
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
    
    /* DIAMOND CIRCLE */
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
    
    /* TIMELINE */
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
    }
    
    .timeline-title {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .timeline-badge {
        background: var(--color-bg-secondary);
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
    }
    
    .timeline-icon {
        width: 32px;
        height: 32px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8125rem;
        flex-shrink: 0;
    }
    
    .timeline-icon.success { background: #d1fae5; color: #059669; }
    .timeline-icon.info { background: #dbeafe; color: #2563eb; }
    .timeline-icon.warning { background: #fef3c7; color: #d97706; }
    
    .timeline-content {
        flex: 1;
        min-width: 0;
    }
    
    .timeline-time {
        font-size: 0.625rem;
        color: var(--color-text-tertiary);
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }
    
    .timeline-text {
        font-size: 0.8125rem;
        font-weight: 600;
        margin-bottom: 0.125rem;
    }
    
    .timeline-subtext {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
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
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .grid-dashboard {
        display: grid;
        gap: 0.875rem;
        grid-template-columns: 1fr;
    }
    
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
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 10001;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border: 1px solid #e5e7eb;
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
    
    .toast-message {
        flex: 1;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    
    /* RESPONSIVE */
    @media (min-width: 640px) {
        .dashboard-2025 { padding: 1.5rem; }
        .grid-dashboard { grid-template-columns: repeat(2, 1fr); }
        
        /* Stat cards plus grands sur tablette+ */
        .stat-card-2025 { padding: 1.25rem; }
        .stat-card-icon { width: 40px; height: 40px; font-size: 1.125rem; }
        .stat-value-2025 { font-size: 1.5rem; }
        .stat-label-2025 { font-size: 0.75rem; }
        .stat-card-extra { font-size: 0.6875rem; }
        
        .stat-card-2025:hover { border-color: #94a3b8; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); transform: translateY(-2px); }
        .stat-card-2025:hover .stat-card-icon { transform: scale(1.05); }
        .timeline-item:hover { background: #f1f5f9; transform: translateX(4px); }
        .share-options-grid { grid-template-columns: repeat(5, 1fr); }
        .affiliate-link-section { flex-direction: row; align-items: center; }
        .affiliate-copy-btn { width: auto; }
        .motivation-emoji { font-size: 2.5rem; }
        .motivation-title { font-size: 1.25rem; }
        .progress-milestones { grid-template-columns: repeat(auto-fit, minmax(90px, 1fr)); }
        .diamond-circle-svg { width: 140px; height: 140px; }
        .diamond-circle-percentage { font-size: 1.75rem; }
        
        /* Requester card en row sur tablette+ */
        .requester-motivation-card {
            flex-direction: row;
            align-items: center;
            padding: 1.25rem;
        }
        .requester-info-box {
            width: auto;
            flex-direction: row;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
        }
    }
    
    @media (min-width: 1024px) {
        .dashboard-2025 { padding: 2rem; }
        .grid-dashboard { grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .requester-motivation-card { grid-column: span 2; }
        .share-modal { position: fixed; bottom: auto; top: 50%; left: 50%; right: auto; transform: translate(-50%, -50%) scale(0.9); border-radius: var(--border-radius-xl); max-width: 520px; width: 90%; opacity: 0; max-height: none; }
        .share-modal.active { transform: translate(-50%, -50%) scale(1); opacity: 1; }
    }
</style>

<div class="dashboard-2025">
    
    @php
        $user = auth()->user();
        $provider = $user->serviceProvider ?? null;
        $hasProviderProfile = $provider !== null;
        $unreadMessagesCount = method_exists($user, 'unreadMessagesCount') ? $user->unreadMessagesCount() : 0;
        
        $recentActivities = collect();
        $upcomingEvents = collect();
        $serviceRequestsCount = 0;
        $in_progress = 0;
        $pendingPayments = 0;
        
        try {
            $conversations = \App\Models\Conversation::where(function($query) use ($user) {
                $query->where('requester_id', $user->id)->orWhere('provider_id', $user->id);
            })
            ->where('updated_at', '>=', now()->subDays(7))
            ->orderByDesc('updated_at')
            ->limit(5)
            ->get(['id', 'updated_at']);
            
            foreach($conversations as $conv) {
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
                $missions = $provider->missions()
                    ->where('updated_at', '>=', now()->subDays(7))
                    ->orderByDesc('updated_at')
                    ->limit(5)
                    ->get(['id', 'status', 'title', 'updated_at']);
                
                foreach($missions as $mission) {
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
                $upcoming = $provider->missions()
                    ->where('status', 'in_progress')
                    ->whereNotNull('deadline')
                    ->where('deadline', '>=', now())
                    ->where('deadline', '<=', now()->addDays(14))
                    ->orderBy('deadline')
                    ->limit(5)
                    ->get(['id', 'title', 'deadline']);
                
                foreach($upcoming as $mission) {
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
            
            try {
                $in_progress = $provider->missions()->where('status', 'in_progress')->count();
            } catch (\Exception $e) {}
            
            try {
                if (class_exists(\App\Models\Payment::class)) {
                    $pendingPayments = \App\Models\Payment::where('service_provider_id', $provider->id)
                        ->where('status', 'pending')
                        ->count();
                }
            } catch (\Exception $e) {}
        }
        
        try {
            $serviceRequestsCount = \App\Models\Mission::where('requester_id', $user->id)->count();
        } catch (\Exception $e) {}
        
        $recentActivities = $recentActivities->sortByDesc('date')->take(10);
        $upcomingEvents = $upcomingEvents->sortBy('date');
        
        // MESSAGES MOTIVATION PROVIDER
        $motivationMessages = [
            0 => [
                'emoji' => '🚀',
                'title' => 'Welcome Aboard!',
                'message' => 'Your journey to becoming a Diamond provider starts now! Complete your first mission to unlock amazing rewards!',
                'progressText' => 'Just getting started...',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
                'border' => '#bfdbfe'
            ],
            15 => [
                'emoji' => '🌟',
                'title' => 'You\'re Doing Great!',
                'message' => 'WOW! You\'re making real progress! Keep this momentum going - your clients are loving your work!',
                'progressText' => 'Only {remaining} more points to Bronze!',
                'color' => '#10b981',
                'bg' => '#d1fae5',
                'border' => '#a7f3d0'
            ],
            35 => [
                'emoji' => '🔥',
                'title' => 'You\'re On FIRE!',
                'message' => 'AMAZING progress! You\'re halfway to the next level. ONE MORE STEP AND you\'ll unlock even better rewards!',
                'progressText' => 'Only {remaining} more points to Silver!',
                'color' => '#f59e0b',
                'bg' => '#fef3c7',
                'border' => '#fde68a'
            ],
            55 => [
                'emoji' => '⚡',
                'title' => 'UNSTOPPABLE!',
                'message' => 'You\'re CRUSHING it! Your reputation is skyrocketing! The Gold level is RIGHT THERE - don\'t stop now!',
                'progressText' => 'JUST {remaining} MORE POINTS to Gold!',
                'color' => '#8b5cf6',
                'bg' => '#f3e8ff',
                'border' => '#e9d5ff'
            ],
            75 => [
                'emoji' => '💎',
                'title' => 'Almost DIAMOND!',
                'message' => 'WOW! You\'re SO CLOSE! Just a few more missions and you\'ll reach DIAMOND status - the ultimate achievement!',
                'progressText' => 'Only {remaining} points left to DIAMOND!',
                'color' => '#06b6d4',
                'bg' => '#cffafe',
                'border' => '#a5f3fc'
            ],
            95 => [
                'emoji' => '👑',
                'title' => 'DIAMOND ACHIEVED!',
                'message' => 'INCREDIBLE! You\'ve reached the TOP! You\'re now among the ELITE providers on Ulixai. You\'re a LEGEND!',
                'progressText' => 'You\'re at the TOP! Keep it up!',
                'color' => '#6366f1',
                'bg' => '#eef2ff',
                'border' => '#c7d2fe'
            ]
        ];
        
        $requesterMotivations = [
            'default' => [
                'emoji' => '🌍',
                'title' => 'Living Abroad Made Easy!',
                'text' => 'Visa, banking, permits, moving... Whatever you need, our trusted providers are ready!'
            ],
            'returning' => [
                'emoji' => '✨',
                'title' => 'Welcome Back!',
                'text' => 'Banking, legal, housing, permits - our experts are here for your journey abroad!'
            ],
            'active' => [
                'emoji' => '🚀',
                'title' => 'Keep Going!',
                'text' => 'From visa renewals to home repairs - connect with skilled expat professionals!'
            ]
        ];
        
        $requesterType = 'default';
        try {
            $requestCount = \App\Models\Mission::where('requester_id', $user->id)->count();
            if ($requestCount > 0) {
                $requesterType = 'active';
            } elseif ($user->created_at < now()->subDays(7)) {
                $requesterType = 'returning';
            }
        } catch (\Exception $e) {}
        
        $requesterMotivation = $requesterMotivations[$requesterType];
        
        // PROGRESSION PROVIDER
        $points = $hasProviderProfile ? ($reputationPoints ?? 0) : 0;
        $progress = $hasProviderProfile ? ($progressLevel ?? 0) : 0;
        
        $currentMotivation = null;
        if ($hasProviderProfile) {
            $currentMotivation = collect($motivationMessages)->filter(fn($msg, $level) => $progress >= $level)->last();
        }
        
        // CERCLE DIAMOND
        $circleRadius = 32;
        $circleCircumference = 2 * pi() * $circleRadius;
        $offset = $circleCircumference - ($progress / 100 * $circleCircumference);
    @endphp

    <h1 class="section-title">Overview</h1>
    
    <div class="grid-dashboard" style="margin-bottom: 1.5rem;">
        
        @if($hasProviderProfile && isset($balance))
            <a href="/my-earning-payment" class="stat-card-2025" style="--icon-bg: #d1fae5; --icon-color: #059669;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $userCurrency === 'USD' ? $currencySymbol : '' }}{{ $balance['available'] ?? '0.00' }}{{ $userCurrency !== 'USD' ? $currencySymbol : '' }}</div>
                        <div class="stat-label-2025">Available Balance</div>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('user.joblist') }}" class="stat-card-2025" style="--icon-bg: #dbeafe; --icon-color: #2563eb;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $in_progress }}</div>
                        <div class="stat-label-2025">Jobs In Progress</div>
                    </div>
                </div>
            </a>
        @endif
        
        <a href="{{ route('user.service.requests') }}" class="stat-card-2025" style="--icon-bg: #f3e8ff; --icon-color: #7c3aed;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ $serviceRequestsCount }}</div>
                    <div class="stat-label-2025">My Service Requests</div>
                </div>
            </div>
        </a>
        
        <a href="{{ route('user.conversation') }}" class="stat-card-2025" style="--icon-bg: #fce7f3; --icon-color: #db2777;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ $unreadMessagesCount }}</div>
                    <div class="stat-label-2025">Unread Messages</div>
                </div>
            </div>
        </a>
        
        <button type="button" class="stat-card-2025 stat-card-affiliate-special" id="btn-affiliate-share">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">75%</div>
                    <div class="stat-label-2025">Share & Earn 75% Commission</div>
                    <div class="stat-card-extra">
                        {{ $user->referrals()->count() }} referrals · {{ $userCurrency === 'USD' ? $currencySymbol : '' }}{{ number_format($user->commissions->sum('amount'), 2) }}{{ $userCurrency !== 'USD' ? $currencySymbol : '' }} earned
                    </div>
                </div>
            </div>
        </button>
        
        <a href="{{ route('user.affiliate.account') }}" class="stat-card-2025" style="--icon-bg: #ccfbf1; --icon-color: #0d9488;">
            <div class="stat-card-content">
                <div class="stat-card-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-value-2025">{{ $userCurrency === 'USD' ? $currencySymbol : '' }}{{ number_format($user->commissions->sum('amount'), 2) }}{{ $userCurrency !== 'USD' ? $currencySymbol : '' }}</div>
                    <div class="stat-label-2025">Total Commission Earned</div>
                </div>
            </div>
        </a>
        
        @if(!$hasProviderProfile || $serviceRequestsCount == 0)
        <div class="requester-motivation-card">
            <div class="requester-motivation-content">
                <div class="requester-motivation-emoji">{{ $requesterMotivation['emoji'] }}</div>
                <h3 class="requester-motivation-title">{{ $requesterMotivation['title'] }}</h3>
                <p class="requester-motivation-text">{{ $requesterMotivation['text'] }}</p>
            </div>
            <div class="requester-info-box">
                <i class="fas fa-arrow-up" style="font-size: 1rem; margin-bottom: 0.25rem;"></i>
                <span>Click "Request Help" in the header above</span>
            </div>
        </div>
        @endif
        
        @if($hasProviderProfile)
            <a href="{{ route('user.payments.validate') }}" class="stat-card-2025" style="--icon-bg: #ffedd5; --icon-color: #ea580c;">
                <div class="stat-card-content">
                    <div class="stat-card-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-card-info">
                        <div class="stat-value-2025">{{ $pendingPayments }}</div>
                        <div class="stat-label-2025">Payments to Validate</div>
                    </div>
                </div>
            </a>
        @endif
    </div>

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
                <div class="share-stat-value success">{{ $userCurrency === 'USD' ? $currencySymbol : '' }}{{ number_format($user->commissions->sum('amount'), 2) }}{{ $userCurrency !== 'USD' ? $currencySymbol : '' }}</div>
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
        @if($currentMotivation)
        @php
            $badges = \App\Models\Badge::where('type', 'reputation')->where('is_auto', true)->orderBy('threshold')->get();
            $nextBadge = $badges->where('threshold', '>', $points)->first();
            $remaining = $nextBadge ? ($nextBadge->threshold - $points) : 0;
            $progressText = str_replace('{remaining}', $remaining, $currentMotivation['progressText']);
        @endphp
        <div class="motivation-banner" style="background: {{ $currentMotivation['bg'] }}; border-color: {{ $currentMotivation['border'] }};">
            <div class="motivation-emoji">{{ $currentMotivation['emoji'] }}</div>
            <h3 class="motivation-title" style="color: {{ $currentMotivation['color'] }};">
                {{ $currentMotivation['title'] }}
            </h3>
            <p class="motivation-message">{{ $currentMotivation['message'] }}</p>
            @if($remaining > 0)
            <div class="motivation-progress-text" style="color: {{ $currentMotivation['color'] }};">
                {{ $progressText }}
            </div>
            @endif
            @if($nextBadge)
            <div class="motivation-next" style="color: {{ $currentMotivation['color'] }};">
                <span>Next:</span>
                <strong>{{ $nextBadge->title }}</strong>
                <i class="fas fa-arrow-right"></i>
            </div>
            @endif
        </div>
        @endif
        
        @php
            $badges = \App\Models\Badge::where('type', 'reputation')
                ->where('is_auto', true)
                ->orderBy('threshold')
                ->get();
        @endphp
        
        @if($badges->count() > 0)
        <div class="grid-dashboard" style="margin-bottom: 1.5rem;">
            
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

    <h2 class="section-title">Activity</h2>
    
    <div class="grid-dashboard" style="margin-bottom: 3rem;">
        
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
                    <a href="{{ $activity['url'] }}" class="timeline-item">
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
                        <div>No recent activity</div>
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
                    <a href="{{ $event['url'] }}" class="timeline-item">
                        <div class="timeline-icon {{ $event['type'] }}">
                            <i class="fas fa-{{ $event['icon'] }}"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-time">{{ $event['date']->format('M j, Y') }}</div>
                            <div class="timeline-text">
                                {{ $event['title'] }}
                                @if(isset($event['urgent']) && $event['urgent'])
                                    <i class="fas fa-exclamation-circle" style="color: var(--color-warning);"></i>
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
                        <div>Nothing scheduled</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<script>
(function() {
    'use strict';
    
    function showToast(type, message) {
        const existing = document.querySelector('.toast-notification');
        if (existing) existing.remove();
        
        const icons = { success: 'fa-circle-check', error: 'fa-circle-xmark' };
        
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = `
            <div class="toast-icon ${type}">
                <i class="fas ${icons[type]}"></i>
            </div>
            <div class="toast-message">${message}</div>
        `;
        
        document.body.appendChild(toast);
        
        if ('vibrate' in navigator) navigator.vibrate(25);
        
        setTimeout(() => toast.remove(), 3000);
    }
    
    function copyAffiliateLink() {
        const input = document.getElementById('affiliate-link-input');
        const btn = document.getElementById('copy-btn');
        
        if (!input || !btn) return;
        
        const originalHTML = btn.innerHTML;
        
        navigator.clipboard.writeText(input.value)
            .then(() => {
                btn.innerHTML = '<i class="fas fa-check"></i><span>Copied!</span>';
                showToast('success', 'Link copied!');
                setTimeout(() => btn.innerHTML = originalHTML, 2000);
            })
            .catch(() => showToast('error', 'Failed to copy'));
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
            whatsapp: "🌍 Hey! I'm using Ulixai for all my expat needs. Join me and earn 75% commission!",
            email: {
                subject: "Discover Ulixai - Earn 75% Commission!",
                body: "Check out Ulixai - expat services marketplace with 75% referral commission!\n\n"
            },
            default: "Discover Ulixai - Your expat service marketplace!"
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
            showToast('success', 'Shared!');
            closeShareModal();
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('share-overlay');
        const modal = document.getElementById('share-modal');
        if (overlay) overlay.classList.remove('active');
        if (modal) modal.classList.remove('active');
        
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
                if (platform) shareVia(platform);
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
            if (e.key === 'Escape') closeShareModal();
        });
    });
    
})();
</script>

@endsection