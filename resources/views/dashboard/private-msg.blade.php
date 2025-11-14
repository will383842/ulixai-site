@extends('dashboard.layouts.master')

@section('title', 'Private Messaging')

@section('content')
@php
    $activeTab = request('tab') === 'jobs' ? 'jobs' : 'services';
    
    // Calculer les messages non lus pour le tab actuel
    $unreadCurrentTab = 0;
    
    foreach($missions as $mission) {
        $conv = $conversations->firstWhere('mission_id', $mission->id);
        if($conv && $conv->messages) {
            $unreadCount = $conv->messages()->where('is_read', false)->where('sender_id', '!=', $user->id)->count() ?? 0;
            $unreadCurrentTab += $unreadCount;
        }
    }
@endphp

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-purple: #8b5cf6;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #94a3b8;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --color-message-sent: #2563eb;
        --color-message-received: #f1f5f9;
        --border-radius-sm: 0.75rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --border-radius-bubble: 1.125rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --chat-header-height: 70px;
        --chat-input-height: 80px;
    }

    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    .messaging-container-2025 {
        max-width: 100vw;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: var(--color-bg-secondary);
        contain: layout style paint;
        display: flex;
        flex-direction: column;
    }

    .messaging-header-2025 {
        background: white;
        padding: 1.5rem 1rem 1rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        flex-shrink: 0;
    }

    .messaging-title-2025 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 1rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .tabs-nav-2025 {
        display: flex;
        gap: 0.625rem;
        padding: 0.375rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-xl);
    }

    .tab-link-2025 {
        padding: 0.625rem 1.25rem;
        border-radius: calc(var(--border-radius-xl) - 0.375rem);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        background: transparent;
        color: var(--color-text-secondary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        border: 2px solid transparent;
        touch-action: manipulation;
        position: relative;
        flex: 1;
        justify-content: center;
    }

    .tab-link-2025:hover {
        background: rgba(37, 99, 235, 0.05);
        color: var(--color-primary);
    }

    .tab-link-2025.active {
        background: white;
        color: var(--color-primary);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.12);
        border-color: rgba(37, 99, 235, 0.1);
    }

    .tab-badge-2025 {
        background: var(--color-danger);
        color: white;
        border-radius: 50%;
        min-width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6875rem;
        font-weight: 700;
        padding: 0 0.375rem;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.4);
        animation: badgePulse 2s ease-in-out infinite;
    }

    .tab-badge-2025.hidden {
        display: none;
    }

    @keyframes badgePulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.95;
        }
    }

    .messaging-content-2025 {
        display: flex;
        flex-direction: column;
        flex: 1;
        overflow: hidden;
        background: var(--color-bg-primary);
    }

    .conversations-panel-2025 {
        width: 100%;
        max-height: 40vh;
        overflow-y: auto;
        border-bottom: 1px solid #f1f5f9;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        background: white;
    }

    .conversations-panel-2025::-webkit-scrollbar {
        display: none;
    }

    .conversations-header-2025 {
        padding: 1rem 1.25rem;
        background: var(--color-bg-secondary);
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .conversations-title-2025 {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--color-text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .conversations-count-2025 {
        background: var(--color-primary);
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        min-width: 20px;
        text-align: center;
    }

    .conversations-list-2025 {
        padding: 0.5rem;
    }

    .conversation-item-2025 {
        padding: 1rem;
        background: white;
        border-radius: var(--border-radius-xl);
        margin-bottom: 0.625rem;
        cursor: pointer;
        transition: var(--transition-base);
        border: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        will-change: transform;
        touch-action: manipulation;
    }

    .conversation-item-2025:active {
        transform: scale(0.98);
    }

    .conversation-item-2025:hover {
        background: var(--color-bg-secondary);
        border-color: var(--color-primary-light);
    }

    .conversation-item-2025.active {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-color: var(--color-primary);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
    }

    .conversation-avatar-2025 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .conversation-details-2025 {
        flex: 1;
        min-width: 0;
    }

    .conversation-name-2025 {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.25rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .conversation-meta-2025 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .conversation-status-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.125rem 0.5rem;
        border-radius: 999px;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .conversation-status-2025.in_progress {
        background: #d1fae5;
        color: #065f46;
    }

    .conversation-status-2025.completed {
        background: #dbeafe;
        color: #1e40af;
    }

    .conversation-status-2025.disputed {
        background: #fee2e2;
        color: #991b1b;
    }

    .conversation-status-2025.waiting_to_start {
        background: #fef3c7;
        color: #92400e;
    }

    .conversation-location-2025 {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .conversation-unread-2025 {
        background: var(--color-danger);
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6875rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    }

    .conversation-unread-2025.hidden {
        display: none;
    }

    .chat-container-2025 {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: white;
    }

    .chat-header-2025 {
        height: var(--chat-header-height);
        padding: 1rem;
        background: white;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-shrink: 0;
    }

    .chat-header-2025.hidden {
        display: none;
    }

    .chat-header-left-2025 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        min-width: 0;
    }

    .chat-avatar-2025 {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-purple) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
    }

    .chat-header-info-2025 {
        flex: 1;
        min-width: 0;
    }

    .chat-user-name-2025 {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.125rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chat-header-actions-2025 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chat-action-btn-2025 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--color-bg-secondary);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
        font-size: 0.9375rem;
        flex-shrink: 0;
        touch-action: manipulation;
    }

    .chat-action-btn-2025:hover {
        background: #e5e7eb;
        color: var(--color-text-primary);
        transform: scale(1.05);
    }

    .chat-action-btn-2025:active {
        transform: scale(0.95);
    }

    .chat-action-btn-2025.danger:hover {
        background: #fee2e2;
        color: var(--color-danger);
    }

    .chat-messages-wrapper-2025 {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        background: white;
        position: relative;
    }

    .chat-empty-state-2025 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 2.5rem;
        text-align: center;
    }

    .chat-empty-icon-2025 {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--color-primary);
        font-size: 2.5rem;
    }

    .chat-empty-title-2025 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.625rem;
    }

    .chat-empty-text-2025 {
        font-size: 0.9375rem;
        color: var(--color-text-secondary);
    }

    .chat-messages-2025 {
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .message-group-2025 {
        display: flex;
        gap: 0.5rem;
        animation: messageSlideIn 0.3s ease;
    }

    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-group-2025.sent {
        justify-content: flex-end;
    }

    .message-group-2025.received {
        justify-content: flex-start;
    }

    .message-bubble-2025 {
        max-width: 75%;
        padding: 0.875rem 1.125rem;
        border-radius: 1.25rem;
        font-size: 0.9375rem;
        line-height: 1.5;
        word-wrap: break-word;
        position: relative;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .message-group-2025.sent .message-bubble-2025 {
        background: linear-gradient(135deg, var(--color-message-sent) 0%, var(--color-primary-light) 100%);
        color: white;
        border-bottom-right-radius: 0.5rem;
    }

    .message-group-2025.received .message-bubble-2025 {
        background: var(--color-message-received);
        color: var(--color-text-primary);
        border-bottom-left-radius: 0.5rem;
    }

    .message-text-2025 {
        margin-bottom: 0.5rem;
    }

    .message-attachments-2025 {
        margin-top: 0.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .message-attachment-2025 {
        background: rgba(255, 255, 255, 0.15);
        border-radius: var(--border-radius-sm);
        padding: 0.5rem;
        cursor: pointer;
        transition: var(--transition-base);
    }

    .message-group-2025.received .message-attachment-2025 {
        background: white;
        border: 1px solid #e5e7eb;
    }

    .message-attachment-2025:hover {
        transform: scale(1.02);
    }

    .message-attachment-image-2025 {
        width: 100%;
        max-width: 200px;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
    }

    .message-attachment-image-2025 img {
        width: 100%;
        height: auto;
        display: block;
    }

    .message-attachment-file-2025 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .message-attachment-icon-2025 {
        font-size: 1.25rem;
    }

    .message-group-2025.sent .message-attachment-icon-2025 {
        color: rgba(255, 255, 255, 0.9);
    }

    .message-group-2025.received .message-attachment-icon-2025 {
        color: var(--color-primary);
    }

    .message-attachment-info-2025 {
        flex: 1;
        min-width: 0;
    }

    .message-attachment-name-2025 {
        font-size: 0.8125rem;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .message-attachment-size-2025 {
        font-size: 0.75rem;
        opacity: 0.8;
    }

    .message-attachment-download-2025 {
        flex-shrink: 0;
    }

    .message-time-2025 {
        font-size: 0.6875rem;
        opacity: 0.7;
        margin-top: 0.25rem;
        display: block;
    }

    .typing-indicator-2025 {
        display: none;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1rem;
        margin: 0 1rem 1rem 1rem;
    }

    .typing-indicator-2025.show {
        display: flex;
    }

    .typing-dot-2025 {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--color-text-tertiary);
        animation: typingBounce 1.4s infinite;
    }

    .typing-dot-2025:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot-2025:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typingBounce {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-6px);
        }
    }

    .typing-text-2025 {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
        margin-left: 0.25rem;
    }

    .chat-input-area-2025 {
        min-height: var(--chat-input-height);
        background: white;
        border-top: 1px solid #f1f5f9;
        padding: 1rem;
        flex-shrink: 0;
    }

    .chat-input-area-2025.hidden {
        display: none;
    }

    .attachment-preview-2025 {
        margin-bottom: 0.75rem;
        padding: 1rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-xl);
        display: none;
        border: 1px solid #e5e7eb;
    }

    .attachment-preview-2025.show {
        display: block;
    }

    .attachment-preview-header-2025 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
    }

    .attachment-preview-title-2025 {
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--color-text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .attachment-clear-btn-2025 {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
        font-size: 0.875rem;
        touch-action: manipulation;
    }

    .attachment-clear-btn-2025:hover {
        background: #fee2e2;
        color: var(--color-danger);
    }

    .attachment-preview-list-2025 {
        display: flex;
        gap: 0.75rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 0.5rem;
        scrollbar-width: thin;
    }

    .attachment-preview-item-2025 {
        flex-shrink: 0;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: var(--border-radius-lg);
        padding: 0.625rem;
        min-width: 120px;
        position: relative;
    }

    .attachment-preview-image-2025 {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: var(--border-radius-md);
        margin-bottom: 0.5rem;
    }

    .attachment-preview-info-2025 {
        font-size: 0.75rem;
        color: var(--color-text-secondary);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .attachment-remove-btn-2025 {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--color-danger);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.75rem;
        transition: var(--transition-base);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        touch-action: manipulation;
    }

    .attachment-remove-btn-2025:active {
        transform: scale(0.9);
    }

    .chat-input-form-2025 {
        display: flex;
        align-items: flex-end;
        gap: 0.75rem;
    }

    .chat-attach-btn-2025 {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--color-bg-secondary);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
        font-size: 1.25rem;
        flex-shrink: 0;
        touch-action: manipulation;
    }

    .chat-attach-btn-2025:hover {
        background: #dbeafe;
        color: var(--color-primary);
        transform: scale(1.08);
    }

    .chat-attach-btn-2025:active {
        transform: scale(0.95);
    }

    .chat-input-wrapper-2025 {
        flex: 1;
        position: relative;
    }

    .chat-input-2025 {
        width: 100%;
        padding: 0.875rem 3.5rem 0.875rem 1.25rem;
        border: 2px solid #f1f5f9;
        border-radius: 1.75rem;
        font-size: 0.9375rem;
        color: var(--color-text-primary);
        transition: var(--transition-base);
        background: var(--color-bg-secondary);
        resize: none;
        max-height: 100px;
        font-family: inherit;
        font-size: max(16px, 0.9375rem);
    }

    .chat-input-2025:focus {
        outline: none;
        border-color: var(--color-primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
    }

    .chat-send-btn-2025 {
        position: absolute;
        right: 0.5rem;
        bottom: 0.5rem;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        font-size: 0.875rem;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        touch-action: manipulation;
        will-change: transform;
    }

    .chat-send-btn-2025:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    .chat-send-btn-2025:active {
        transform: scale(0.95);
    }

    .report-modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition-base);
    }

    .report-modal-overlay-2025.show {
        opacity: 1;
        visibility: visible;
    }

    .report-modal-2025 {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95);
        background: white;
        border-radius: 1.75rem;
        padding: 0;
        z-index: 9999;
        max-width: 500px;
        width: 90%;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
    }

    .report-modal-2025.show {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, -50%) scale(1);
    }

    .report-modal-header-2025 {
        padding: 1.75rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .report-modal-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
    }

    .report-modal-subtitle-2025 {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        margin-top: 0.375rem;
    }

    .report-modal-body-2025 {
        padding: 1.5rem 1.75rem;
    }

    .report-textarea-2025 {
        width: 100%;
        padding: 0.875rem 1.125rem;
        border: 2px solid #f1f5f9;
        border-radius: var(--border-radius-xl);
        font-size: 0.9375rem;
        color: var(--color-text-primary);
        transition: var(--transition-base);
        background: var(--color-bg-secondary);
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
        font-size: max(16px, 0.9375rem);
    }

    .report-textarea-2025:focus {
        outline: none;
        border-color: var(--color-primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
    }

    .report-modal-footer-2025 {
        padding: 1.5rem 1.75rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.875rem;
    }

    .report-cancel-btn-2025 {
        padding: 0.75rem 1.5rem;
        background: var(--color-bg-secondary);
        color: var(--color-text-primary);
        border: none;
        border-radius: var(--border-radius-xl);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        touch-action: manipulation;
    }

    .report-cancel-btn-2025:hover {
        background: #e2e8f0;
    }

    .report-submit-btn-2025 {
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--color-danger) 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-xl);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
        touch-action: manipulation;
    }

    .report-submit-btn-2025:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
    }

    .report-submit-btn-2025:active {
        transform: translateY(0);
    }

    .image-modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        cursor: zoom-out;
    }

    .image-modal-overlay-2025.show {
        display: flex;
    }

    .image-modal-content-2025 {
        max-width: 90%;
        max-height: 90%;
        background: white;
        border-radius: 1.75rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        cursor: default;
    }

    .image-modal-header-2025 {
        padding: 1.25rem;
        background: var(--color-bg-secondary);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .image-modal-title-2025 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-text-primary);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        flex: 1;
    }

    .image-modal-close-2025 {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition-base);
        color: var(--color-text-secondary);
        font-size: 1rem;
        flex-shrink: 0;
        touch-action: manipulation;
    }

    .image-modal-close-2025:hover {
        background: #fee2e2;
        color: var(--color-danger);
    }

    .image-modal-image-2025 {
        width: 100%;
        max-height: 70vh;
        object-fit: contain;
        display: block;
        background: #000;
    }

    .image-modal-footer-2025 {
        padding: 1.25rem;
        background: var(--color-bg-secondary);
        display: flex;
        justify-content: flex-end;
    }

    .image-download-btn-2025 {
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-xl);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        text-decoration: none;
        touch-action: manipulation;
    }

    .image-download-btn-2025:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    @media (min-width: 640px) {
        .messaging-header-2025 {
            padding: 1.5rem 2rem;
        }

        .messaging-title-2025 {
            font-size: 1.75rem;
        }

        .message-bubble-2025 {
            max-width: 65%;
        }
    }

    @media (min-width: 1024px) {
        .messaging-container-2025 {
            max-width: 100%;
            padding: 0;
        }

        .messaging-header-2025 {
            padding: 1.5rem 2rem;
        }

        .messaging-title-2025 {
            font-size: 1.875rem;
        }

        .messaging-content-2025 {
            flex-direction: row;
        }

        .conversations-panel-2025 {
            width: 380px;
            max-height: none;
            border-right: 1px solid #f1f5f9;
            border-bottom: none;
        }

        .chat-messages-2025 {
            padding: 2rem;
        }

        .report-modal-2025 {
            width: 500px;
        }
    }

    body.modal-open {
        overflow: hidden;
    }
</style>

<div class="messaging-container-2025">
    <!-- Header -->
    <div class="messaging-header-2025">
        <h1 class="messaging-title-2025">Private Messaging</h1>
        
        <div class="tabs-nav-2025">
            <a href="?tab=services" 
               class="tab-link-2025 {{ $activeTab === 'services' ? 'active' : '' }}">
                <i class="fas fa-tools"></i>
                <span>Service Requests</span>
                @if($activeTab === 'services' && $unreadCurrentTab > 0)
                    <span class="tab-badge-2025" id="tab-badge-services" data-count="{{ $unreadCurrentTab }}">{{ $unreadCurrentTab }}</span>
                @else
                    <span class="tab-badge-2025 hidden" id="tab-badge-services" data-count="0">0</span>
                @endif
            </a>
            @if($user->user_role === 'service_provider')
                <a href="?tab=jobs" 
                   class="tab-link-2025 {{ $activeTab === 'jobs' ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Listings</span>
                    @if($activeTab === 'jobs' && $unreadCurrentTab > 0)
                        <span class="tab-badge-2025" id="tab-badge-jobs" data-count="{{ $unreadCurrentTab }}">{{ $unreadCurrentTab }}</span>
                    @else
                        <span class="tab-badge-2025 hidden" id="tab-badge-jobs" data-count="0">0</span>
                    @endif
                </a>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <div class="messaging-content-2025">
        <!-- Conversations Panel -->
        <div class="conversations-panel-2025">
            <div class="conversations-header-2025">
                <h2 class="conversations-title-2025">Conversations</h2>
                <span class="conversations-count-2025">{{ count($missions) }}</span>
            </div>
            
            <div class="conversations-list-2025">
                @foreach($missions as $mission)
                    @php
                        $conv = $conversations->firstWhere('mission_id', $mission->id);
                        $un_read = 0;
                        $otherParty = null;
                        if($conv) {
                            if($conv->messages) {
                                $un_read = $conv->messages()->where('is_read', false)->where('sender_id', '!=', $user->id)->count() ?? 0;
                            }
                        
                            if ($user->id === $conv->requester->id) {
                                $otherParty = $conv->provider->first_name ?? null;
                            } elseif($user->id === $conv->provider->user_id) {
                                $otherParty = explode(' ', $conv->requester->name)[0] ?? null;
                            }
                        }
                        $statusClass = '';
                        if($mission->status === 'in_progress') $statusClass = 'in_progress';
                        elseif($mission->status === 'completed') $statusClass = 'completed';
                        elseif($mission->status === 'disputed') $statusClass = 'disputed';
                        elseif($mission->status === 'waiting_to_start') $statusClass = 'waiting_to_start';
                    @endphp
                    
                    <div class="conversation-item-2025 mission-card"
                         data-mission-id="{{ $mission->id }}"
                         data-conversation-id="{{ $conv ? $conv->id : '' }}"
                         data-other-name="{{ $otherParty ?? 'Unknown' }}"
                         data-other-phone="{{ $otherParty->phone_number ?? '' }}"
                         data-tab-type="{{ $activeTab }}">
                        <div class="conversation-avatar-2025">
                            {{ substr($otherParty ?? 'U', 0, 1) }}
                        </div>
                        
                        <div class="conversation-details-2025">
                            <div class="conversation-name-2025">{{ $mission->title }}</div>
                            <div class="conversation-meta-2025">
                                <span class="conversation-status-2025 {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $mission->status)) }}
                                </span>
                                <span class="conversation-location-2025">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $mission->location_city ?? 'Remote' }}
                                </span>
                            </div>
                        </div>
                        
                        @if($un_read > 0)
                            <span class="conversation-unread-2025" 
                                  id="conversation_unread_{{ $conv->id ?? '' }}"
                                  data-value="{{ $un_read }}">
                                {{ $un_read }}
                            </span>
                        @else
                            <span class="conversation-unread-2025 hidden" 
                                  id="conversation_unread_{{ $conv->id ?? '' }}"
                                  data-value="0">
                                0
                            </span>
                        @endif
                    </div>
                @endforeach

                @if(count($missions) === 0)
                    <div style="text-align: center; padding: 3rem 1rem; color: var(--color-text-tertiary);">
                        <div style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.3;">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <p style="font-size: 0.875rem;">No conversations yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Chat Container -->
        <div class="chat-container-2025">
            <!-- Chat Header -->
            <div class="chat-header-2025 hidden" id="chatHeader">
                <div class="chat-header-left-2025">
                    <div class="chat-avatar-2025">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="chat-header-info-2025">
                        <div class="chat-user-name-2025" id="chatUserName"></div>
                        <span style="font-size: 0.75rem; color: var(--color-text-secondary);" id="chatPhone"></span>
                    </div>
                </div>
                <div class="chat-header-actions-2025">
                    <button class="chat-action-btn-2025 danger report-conversation-btn" 
                            data-report-conversation-id="" 
                            title="Report Conversation"
                            aria-label="Report this conversation">
                        <i class="fas fa-flag"></i>
                    </button>
                    <button class="chat-action-btn-2025" 
                            id="closeChatBtn"
                            aria-label="Close chat">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="chat-messages-wrapper-2025">
                <!-- Empty State -->
                <div class="chat-empty-state-2025" id="emptyState">
                    <div class="chat-empty-icon-2025">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="chat-empty-title-2025">Select a Conversation</h3>
                    <p class="chat-empty-text-2025">Choose a mission from the list to start messaging</p>
                </div>

                <!-- Messages Container -->
                <div id="messagesContainer" class="hidden">
                    <div id="chatMessages" class="chat-messages-2025"></div>
                    
                    <!-- Typing Indicator -->
                    <div class="typing-indicator-2025" id="typingIndicator">
                        <div class="typing-dot-2025"></div>
                        <div class="typing-dot-2025"></div>
                        <div class="typing-dot-2025"></div>
                        <span class="typing-text-2025">Typing...</span>
                    </div>
                </div>
            </div>

            <!-- Chat Input Area -->
            <div class="chat-input-area-2025 hidden" id="messageInputArea">
                <!-- Attachment Preview -->
                <div class="attachment-preview-2025" id="attachmentPreview">
                    <div class="attachment-preview-header-2025">
                        <span class="attachment-preview-title-2025">
                            <i class="fas fa-paperclip"></i>
                            Attachments
                        </span>
                        <button class="attachment-clear-btn-2025" id="clearAttachments" aria-label="Clear all attachments">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="attachment-preview-list-2025" id="previewContainer"></div>
                </div>

                <!-- Input Form -->
                <form id="chatForm" class="chat-input-form-2025">
                    <input type="hidden" id="conversationId">
                    <input type="file" id="fileInput" multiple accept="image/*,.pdf,.doc,.docx" class="hidden" style="display: none;">
                    
                    <button type="button" 
                            id="attachBtn" 
                            class="chat-attach-btn-2025"
                            aria-label="Attach files">
                        <i class="fas fa-paperclip"></i>
                    </button>

                    <div class="chat-input-wrapper-2025">
                        <input type="text" 
                               id="chatInput" 
                               placeholder="Type your message..." 
                               class="chat-input-2025"
                               autocomplete="off"
                               aria-label="Message input">
                        <button type="submit" 
                                id="sendBtn" 
                                class="chat-send-btn-2025"
                                aria-label="Send message">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Report Modal -->
<div class="report-modal-overlay-2025" id="reportModalOverlay"></div>
<div class="report-modal-2025" id="reportModal">
    <div class="report-modal-header-2025">
        <h2 class="report-modal-title-2025">Report Conversation</h2>
        <p class="report-modal-subtitle-2025">Please provide a reason for reporting this conversation</p>
    </div>
    <div class="report-modal-body-2025">
        <textarea id="reportReasonInput" 
                  class="report-textarea-2025" 
                  placeholder="Describe the issue..."
                  aria-label="Report reason"></textarea>
    </div>
    <div class="report-modal-footer-2025">
        <button id="cancelReportBtn" class="report-cancel-btn-2025">Cancel</button>
        <button id="submitReportBtn" class="report-submit-btn-2025">
            <i class="fas fa-flag"></i>
            Submit Report
        </button>
    </div>
</div>

<!-- Image Modal -->
<div class="image-modal-overlay-2025" id="imageModalOverlay">
    <div class="image-modal-content-2025" id="imageModalContent">
        <div class="image-modal-header-2025">
            <h3 class="image-modal-title-2025" id="imageModalTitle">Image</h3>
            <button class="image-modal-close-2025" id="imageModalClose" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <img src="" alt="" class="image-modal-image-2025" id="imageModalImage">
        <div class="image-modal-footer-2025">
            <a href="" download class="image-download-btn-2025" id="imageDownloadBtn">
                <i class="fas fa-download"></i>
                Download
            </a>
        </div>
    </div>
</div>

<script>
    let currentConversationId = null;
    let selectedFiles = [];
    let userId = {{ $user->id }};
    let conversationChannel = null; 
    let lastMessageTimestamp = null;
    let reportConversationId = null;

    // DOM Elements
    const elements = {
        chatHeader: document.getElementById('chatHeader'),
        chatUserName: document.getElementById('chatUserName'),
        chatPhone: document.getElementById('chatPhone'),
        emptyState: document.getElementById('emptyState'),
        messagesContainer: document.getElementById('messagesContainer'),
        chatMessages: document.getElementById('chatMessages'),
        messageInputArea: document.getElementById('messageInputArea'),
        chatForm: document.getElementById('chatForm'),
        chatInput: document.getElementById('chatInput'),
        fileInput: document.getElementById('fileInput'),
        attachBtn: document.getElementById('attachBtn'),
        attachmentPreview: document.getElementById('attachmentPreview'),
        previewContainer: document.getElementById('previewContainer'),
        clearAttachments: document.getElementById('clearAttachments'),
        closeChatBtn: document.getElementById('closeChatBtn'),
        conversationId: document.getElementById('conversationId'),
        typingIndicator: document.getElementById('typingIndicator')
    };

    const utils = {
        formatTime(timestamp) {
            return new Date(timestamp).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        },

        scrollToBottom() {
            const wrapper = document.querySelector('.chat-messages-wrapper-2025');
            if (wrapper) {
                wrapper.scrollTop = wrapper.scrollHeight;
            }
        },

        showNotification(message, type = 'info') {
            console.log(`${type.toUpperCase()}: ${message}`);
        }
    };

    const messageManager = {
        renderMessage(message) {
            const messageGroup = document.createElement('div');
            const isOwn = message.sender_id === userId;
            messageGroup.className = `message-group-2025 ${isOwn ? 'sent' : 'received'}`;
            messageGroup.setAttribute('data-message-id', message.id);
            
            const bubble = document.createElement('div');
            bubble.className = 'message-bubble-2025';
            
            let content = '';
            
            if (message.body) {
                content += `<div class="message-text-2025">${this.escapeHtml(message.body)}</div>`;
            }
            
            if (message.attachments && message.attachments.length > 0) {
                content += this.renderAttachments(message.attachments, isOwn);
            }
            
            content += `<span class="message-time-2025">${utils.formatTime(message.created_at)}</span>`;
            
            bubble.innerHTML = content;
            messageGroup.appendChild(bubble);
            
            return messageGroup;
        },

        renderAttachments(attachments, isOwn) {
            if (!attachments || attachments.length === 0) return '';
            
            return `
                <div class="message-attachments-2025">
                    ${attachments.map(att => {
                        const isImage = att.mime_type && att.mime_type.startsWith('image/');
                        const downloadUrl = `/attachments/${att.id}/download`;
                        const viewUrl = att.url || `/storage/${att.path}`;
                        
                        if (isImage) {
                            return `
                                <div class="message-attachment-2025 message-attachment-image-2025" 
                                     onclick="openImageModal('${viewUrl}', '${att.filename}', '${downloadUrl}')">
                                    <img src="${viewUrl}" alt="${att.filename}" loading="lazy">
                                </div>
                            `;
                        } else {
                            const iconClass = this.getFileIcon(att.mime_type);
                            return `
                                <div class="message-attachment-2025 message-attachment-file-2025">
                                    <i class="${iconClass} message-attachment-icon-2025"></i>
                                    <div class="message-attachment-info-2025">
                                        <div class="message-attachment-name-2025">${att.filename}</div>
                                        <div class="message-attachment-size-2025">${att.formatted_size || this.formatFileSize(att.size)}</div>
                                    </div>
                                    <a href="${downloadUrl}" download class="message-attachment-download-2025" onclick="event.stopPropagation()">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }).join('')}
                </div>
            `;
        },

        getFileIcon(mimeType) {
            if (!mimeType) return 'fas fa-file';
            
            if (mimeType.startsWith('image/')) return 'fas fa-image';
            if (mimeType.includes('pdf')) return 'fas fa-file-pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel';
            if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'fas fa-file-powerpoint';
            if (mimeType.startsWith('video/')) return 'fas fa-file-video';
            if (mimeType.startsWith('audio/')) return 'fas fa-file-audio';
            
            return 'fas fa-file';
        },

        formatFileSize(bytes) {
            if (!bytes) return '0 bytes';
            
            if (bytes >= 1073741824) {
                return (bytes / 1073741824).toFixed(2) + ' GB';
            } else if (bytes >= 1048576) {
                return (bytes / 1048576).toFixed(2) + ' MB';
            } else if (bytes >= 1024) {
                return (bytes / 1024).toFixed(2) + ' KB';
            } else {
                return bytes + ' bytes';
            }
        },

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },

        addMessage(message) {
            const existingMessage = document.querySelector(`[data-message-id="${message.id}"]`);
            if (existingMessage) {
                return; 
            }

            const messageElement = this.renderMessage(message);
            elements.chatMessages.appendChild(messageElement);
            utils.scrollToBottom();
            
            lastMessageTimestamp = message.created_at;
        },

        loadMessages(messages) {
            elements.chatMessages.innerHTML = '';
            lastMessageTimestamp = null;
            
            messages.forEach(message => {
                const messageElement = this.renderMessage(message);
                elements.chatMessages.appendChild(messageElement);
            });
            
            if (messages.length > 0) {
                lastMessageTimestamp = messages[messages.length - 1].created_at;
            }
            
            utils.scrollToBottom();
        },

        handleBroadcastMessage(data) {
            const message = data.message;
            if (message.conversation_id == currentConversationId) {
                this.addMessage(message);
            }
        }
    };

    const broadcastManager = {
        subscribeToConversation(conversationId) {
            this.unsubscribeFromConversation();
            
            if (!window.Echo) {
                console.error('Laravel Echo is not initialized');
                return;
            }
            
            conversationChannel = window.Echo.channel(`conversation.${conversationId}`)
                .listen('MessageSent', (data) => {
                    messageManager.handleBroadcastMessage(data);
                })
                .error((error) => {
                    console.error('Channel subscription error:', error);
                });
        },
        
        unsubscribeFromConversation() {
            if (conversationChannel) {
                window.Echo.leave(`conversation.${currentConversationId}`);
                conversationChannel = null;
            }
        }
    };

    const chatManager = {
        openChat(conversationId, userName, phone, missionId) {
            currentConversationId = conversationId;
            
            elements.emptyState.style.display = 'none';
            elements.chatHeader.classList.remove('hidden');
            elements.messagesContainer.classList.remove('hidden');
            elements.messageInputArea.classList.remove('hidden');
            
            elements.chatUserName.textContent = userName;
            elements.chatPhone.textContent = phone;
            elements.conversationId.value = conversationId;

            document.querySelectorAll('.conversation-item-2025').forEach(card => {
                card.classList.remove('active');
            });
            document.querySelector(`[data-conversation-id="${conversationId}"]`)?.classList.add('active');
            
            const reportBtn = document.querySelector('.report-conversation-btn');
            if (reportBtn) {
                reportBtn.setAttribute('data-report-conversation-id', conversationId);
            }

            this.loadMessages(conversationId);
            broadcastManager.subscribeToConversation(conversationId);
        },

        closeChat() {
            broadcastManager.unsubscribeFromConversation();
            
            currentConversationId = null;
            lastMessageTimestamp = null;
            
            elements.chatHeader.classList.add('hidden');
            elements.messagesContainer.classList.add('hidden');
            elements.messageInputArea.classList.add('hidden');
            elements.emptyState.style.display = 'flex';
            
            document.querySelectorAll('.conversation-item-2025').forEach(card => {
                card.classList.remove('active');
            });
            
            fileManager.clearAttachments();
        },

        async loadMessages(conversationId) {
            try {
                const response = await fetch(`/conversations/${conversationId}/messages`);
                if (!response.ok) throw new Error('Failed to load messages');
                
                const messages = await response.json();
                messageManager.loadMessages(messages);
            } catch (error) {
                console.error('Error loading messages:', error);
                utils.showNotification('Failed to load messages', 'error');
            }
        },

        async sendMessage() {
            const messageText = elements.chatInput.value.trim();
            if (!messageText && selectedFiles.length === 0) return;
            if (!currentConversationId) return;

            try {
                const formData = new FormData();
                formData.append('body', messageText);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                
                selectedFiles.forEach((file, index) => {
                    formData.append(`files[${index}]`, file);
                });

                const response = await fetch(`/conversations/${currentConversationId}/message`, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Failed to send message');
                }

                const result = await response.json();
                
                elements.chatInput.value = '';
                fileManager.clearAttachments();
                
                utils.showNotification('Message sent successfully', 'success');
                
            } catch (error) {
                console.error('Error sending message:', error);
                utils.showNotification(error.message || 'Failed to send message', 'error');
            }
        },

        async startConversation(missionId) {
            try {
                const response = await fetch('/conversations/start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        mission_id: missionId
                    })
                });

                if (!response.ok) throw new Error('Failed to start conversation');
                
                const conversation = await response.json();
                return conversation.id;
            } catch (error) {
                console.error('Error starting conversation:', error);
                utils.showNotification('Failed to start conversation', 'error');
                return null;
            }
        }
    };

    window.openImageModal = function(imageSrc, filename, downloadUrl) {
        const overlay = document.getElementById('imageModalOverlay');
        const image = document.getElementById('imageModalImage');
        const title = document.getElementById('imageModalTitle');
        const downloadBtn = document.getElementById('imageDownloadBtn');
        
        if (overlay && image && title && downloadBtn) {
            image.src = imageSrc;
            image.alt = filename;
            title.textContent = filename;
            downloadBtn.href = downloadUrl;
            
            overlay.classList.add('show');
            document.body.classList.add('modal-open');
        }
    };

    window.closeImageModal = function() {
        const overlay = document.getElementById('imageModalOverlay');
        if (overlay) {
            overlay.classList.remove('show');
            document.body.classList.remove('modal-open');
        }
    };

    const fileManager = {
        handleFileSelect(files) {
            selectedFiles = Array.from(files);
            this.updatePreview();
        },

        updatePreview() {
            if (selectedFiles.length === 0) {
                elements.attachmentPreview.classList.remove('show');
                return;
            }

            elements.attachmentPreview.classList.add('show');
            elements.previewContainer.innerHTML = selectedFiles.map((file, index) => {
                const isImage = file.type.startsWith('image/');
                const fileSize = this.formatFileSize(file.size);
                
                return `
                    <div class="attachment-preview-item-2025">
                        ${isImage ? 
                            `<img src="${URL.createObjectURL(file)}" alt="Preview" class="attachment-preview-image-2025">` :
                            `<div style="height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="${this.getFileIcon(file.type)}" style="font-size: 2rem; color: var(--color-primary);"></i>
                            </div>`
                        }
                        <div class="attachment-preview-info-2025">${file.name} (${fileSize})</div>
                        <button type="button" onclick="removeFile(${index})" class="attachment-remove-btn-2025" aria-label="Remove file">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }).join('');
        },

        getFileIcon(mimeType) {
            if (!mimeType) return 'fas fa-file';
            
            if (mimeType.startsWith('image/')) return 'fas fa-image';
            if (mimeType.includes('pdf')) return 'fas fa-file-pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word';
            
            return 'fas fa-file';
        },

        formatFileSize(bytes) {
            if (bytes >= 1048576) {
                return (bytes / 1048576).toFixed(2) + ' MB';
            } else if (bytes >= 1024) {
                return (bytes / 1024).toFixed(2) + ' KB';
            } else {
                return bytes + ' bytes';
            }
        },

        clearAttachments() {
            selectedFiles = [];
            elements.fileInput.value = '';
            elements.attachmentPreview.classList.remove('show');
            
            elements.previewContainer.querySelectorAll('img').forEach(img => {
                if (img.src.startsWith('blob:')) {
                    URL.revokeObjectURL(img.src);
                }
            });
        }
    };

    function updateTabBadge(tabType, delta) {
        const badgeId = tabType === 'jobs' ? 'tab-badge-jobs' : 'tab-badge-services';
        const badge = document.getElementById(badgeId);
        
        if (!badge) return;
        
        const currentCount = parseInt(badge.dataset.count || "0", 10);
        const newCount = Math.max(0, currentCount + delta);
        
        badge.dataset.count = newCount;
        badge.textContent = newCount;
        
        if (newCount > 0) {
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }

    function updateGlobalBadges(delta) {
        // Badge sidebar desktop
        const sidebarBadge = document.getElementById('private_messages_notification');
        if (sidebarBadge) {
            const currentCount = parseInt(sidebarBadge.dataset.value || "0", 10);
            const newCount = Math.max(0, currentCount + delta);
            
            sidebarBadge.dataset.value = newCount;
            sidebarBadge.textContent = newCount > 99 ? '99+' : newCount;
            
            if (newCount > 0) {
                sidebarBadge.style.display = '';
            } else {
                sidebarBadge.style.display = 'none';
            }
        }
        
        // Badge navigation mobile
        const mobileBadge = document.getElementById('mobileBadge2025');
        if (mobileBadge) {
            const currentCount = parseInt(mobileBadge.textContent.replace('+', '') || "0", 10);
            const newCount = Math.max(0, currentCount + delta);
            
            mobileBadge.textContent = newCount > 99 ? '99+' : newCount;
            
            if (newCount > 0) {
                mobileBadge.style.display = '';
            } else {
                mobileBadge.style.display = 'none';
            }
        } else if (delta > 0) {
            // Créer le badge mobile s'il n'existe pas et qu'on ajoute des messages
            const messagesLink = document.querySelector('[data-nav="messages"]');
            if (messagesLink) {
                const newBadge = document.createElement('span');
                newBadge.id = 'mobileBadge2025';
                newBadge.className = 'badge-2025';
                newBadge.setAttribute('role', 'status');
                newBadge.setAttribute('aria-live', 'polite');
                newBadge.textContent = delta > 99 ? '99+' : delta;
                messagesLink.appendChild(newBadge);
            }
        }
    }

    function getConversationTabType(conversationId) {
        const conversationItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
        return conversationItem ? conversationItem.dataset.tabType : 'services';
    }

    function initializeEventListeners() {
        document.querySelectorAll('.mission-card').forEach(card => {
            card.addEventListener('click', async function() {

                let conversationId = this.dataset.conversationId;
                const missionId = this.dataset.missionId;
                const userName = this.dataset.otherName;
                const phone = this.dataset.otherPhone;
                const tabType = this.dataset.tabType;
                const isReadElement = document.getElementById(`conversation_unread_${conversationId}`);
                
                // Récupérer le nombre de messages non lus avant de le réinitialiser
                let unreadCount = 0;
                if(isReadElement) {
                    unreadCount = parseInt(isReadElement.dataset.value || "0", 10);
                    isReadElement.dataset.value = 0;
                    isReadElement.classList.add('hidden');
                }

                // Mettre à jour tous les badges
                if(unreadCount > 0) {
                    updateTabBadge(tabType, -unreadCount);
                    updateGlobalBadges(-unreadCount);
                }

                if (!conversationId) {
                    conversationId = await chatManager.startConversation(missionId);
                    if (conversationId) {
                        this.dataset.conversationId = conversationId;
                    } else {
                        return;
                    }
                }
                
                chatManager.openChat(conversationId, userName, phone, missionId);
            });
        });

        elements.closeChatBtn.addEventListener('click', () => {
            chatManager.closeChat();
        });

        elements.attachBtn.addEventListener('click', () => {
            elements.fileInput.click();
        });

        elements.fileInput.addEventListener('change', (e) => {
            fileManager.handleFileSelect(e.target.files);
        });

        elements.clearAttachments.addEventListener('click', () => {
            fileManager.clearAttachments();
        });

        elements.chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            chatManager.sendMessage();
        });

        elements.chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatManager.sendMessage();
            }
        });

        const imageModalOverlay = document.getElementById('imageModalOverlay');
        const imageModalClose = document.getElementById('imageModalClose');
        
        if (imageModalOverlay) {
            imageModalOverlay.addEventListener('click', (e) => {
                if (e.target === imageModalOverlay) {
                    closeImageModal();
                }
            });
        }
        
        if (imageModalClose) {
            imageModalClose.addEventListener('click', closeImageModal);
        }
    }

    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        fileManager.updatePreview();
    };

    function initializeEchoMonitoring() {
        if (window.Echo) {
            window.Echo.connector.pusher.connection.bind('connected', () => {
                console.log('WebSocket connected');
            });

            window.Echo.connector.pusher.connection.bind('disconnected', () => {
                console.log('WebSocket disconnected');
            });

            window.Echo.connector.pusher.connection.bind('error', (error) => {
                console.error('WebSocket error:', error);
            });
        }
    }

    function initializeReportButtons() {
        const reportBtns = document.querySelectorAll('.report-conversation-btn');
        const reportModal = document.getElementById('reportModal');
        const reportOverlay = document.getElementById('reportModalOverlay');
        const cancelBtn = document.getElementById('cancelReportBtn');
        const submitBtn = document.getElementById('submitReportBtn');
        const reasonInput = document.getElementById('reportReasonInput');
        
        reportBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                reportConversationId = this.getAttribute('data-report-conversation-id');
                reasonInput.value = '';
                reportModal.classList.add('show');
                reportOverlay.classList.add('show');
                document.body.classList.add('modal-open');
            });
        });

        const closeReportModal = () => {
            reportModal.classList.remove('show');
            reportOverlay.classList.remove('show');
            document.body.classList.remove('modal-open');
            reportConversationId = null;
        };

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeReportModal);
        }

        if (reportOverlay) {
            reportOverlay.addEventListener('click', closeReportModal);
        }

        if (submitBtn) {
            submitBtn.addEventListener('click', async function() {
                const reason = reasonInput.value.trim();
                const reportBtn = document.querySelector('.report-conversation-btn');
                let convId = null;
                if (reportBtn) {
                    convId = reportBtn.getAttribute('data-report-conversation-id');
                }
                
                if (!convId || !reason) {
                    console.log('Missing conversation ID or reason');
                    return;
                }
                
                try {
                    const res = await fetch(`/conversations/${convId}/report`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ reason })
                    });
                    const data = await res.json();
                    closeReportModal();
                    
                    if(res.ok && typeof toastr !== 'undefined') {
                        toastr.success(data.message || 'Report submitted successfully', 'Success');
                    } else if(typeof toastr !== 'undefined') {
                        toastr.error(data.message || 'Failed to submit report', 'Error');
                    }
                } catch(error) {
                    console.error('Report error:', error);
                    closeReportModal();
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeEventListeners();
        initializeEchoMonitoring();
        initializeReportButtons();
    });

    window.addEventListener('beforeunload', () => {
        broadcastManager.unsubscribeFromConversation();
    });

    function handleNotification(data) {
        if (currentConversationId == data.conversation.id) {
            fetch(`/isRead/${data.message.id}/message`,  {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(messages => {
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
            return;
        }

        const isReadElement = document.getElementById(`conversation_unread_${data.conversation.id}`);
        if (isReadElement) {
            const oldValue = parseInt(isReadElement.dataset.value || "0", 10);
            const newValue = oldValue + 1;
            isReadElement.dataset.value = newValue;
            isReadElement.textContent = newValue;
            isReadElement.classList.remove('hidden');
            
            // Mettre à jour tous les badges
            const tabType = getConversationTabType(data.conversation.id);
            updateTabBadge(tabType, 1);
            updateGlobalBadges(1);
        }
    }

    if(window.Echo) {
        const listenNotifications = window.Echo.channel(`notify-user-${userId}`)
            .listen('NotifyUser', (data) => {
                handleNotification(data);
            })
            .error((error) => {
                console.error('Channel subscription error:', error);
            });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
            const reportModal = document.getElementById('reportModal');
            if (reportModal && reportModal.classList.contains('show')) {
                reportModal.classList.remove('show');
                document.getElementById('reportModalOverlay').classList.remove('show');
                document.body.classList.remove('modal-open');
            }
        }
    });
</script>

@endsection