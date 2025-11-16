@extends('dashboard.layouts.master')
@section('title', 'Service Request Details')

@section('content')
@php
  $images = json_decode($mission->attachments ?? '[]', true);
  $user = auth()->user();
  $provider = $user->serviceProvider ?? null;
  
  // Parse spoken languages
  $spokenLanguages = [];
  if ($mission->requester && $mission->requester->spoken_languages) {
      $decoded = json_decode($mission->requester->spoken_languages, true);
      $spokenLanguages = is_array($decoded) ? $decoded : [$mission->requester->spoken_languages];
  }
  
  // Calculate remaining days
  if($mission->service_durition === '1 week') {
      $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
  } elseif($mission->service_durition === '2 weeks') {
      $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
  } elseif($mission->service_durition === '1 month') {
      $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
  } elseif($mission->service_durition === '3 months') {
      $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
  } else {
      $endTime = null;
  }
  
  if ($endTime) {
      $remainingDays = max(0, $endTime->diffInDays(\Carbon\Carbon::now()));
  } else {
      $remainingDays = 'N/A';
  }
@endphp

<style>
    :root {
        --primary-blue: #007AFF;
        --primary-blue-light: #5AC8FA;
        --secondary-gray: #E5E5EA;
        --secondary-gray-dark: #8E8E93;
        --text-primary: #000000;
        --text-secondary: #3C3C43;
        --text-tertiary: #8E8E93;
        --bg-primary: #FFFFFF;
        --bg-secondary: #F2F2F7;
        --bg-tertiary: #E5E5EA;
        --success-green: #34C759;
        --warning-orange: #FF9500;
        --danger-red: #FF3B30;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
        --radius-sm: 12px;
        --radius-md: 16px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --radius-full: 9999px;
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background: var(--bg-secondary);
    }
    
    /* MAIN CONTAINER */
    .request-details-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1rem;
        min-height: 100vh;
    }
    
    /* REQUEST CARD - MODERN GLASSMORPHISM */
    .request-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.8);
        animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* CATEGORY BADGE */
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
    }
    
    /* REQUEST TITLE */
    .request-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 1rem 0;
        line-height: 1.3;
        letter-spacing: -0.5px;
    }
    
    /* REQUEST DESCRIPTION */
    .request-description {
        color: var(--text-secondary);
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    /* IMAGE GALLERY - MODERN GRID */
    .image-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }
    
    .gallery-item {
        position: relative;
        aspect-ratio: 4 / 3;
        border-radius: var(--radius-md);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: var(--shadow-sm);
    }
    
    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
        z-index: 10;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    /* IMAGE MODAL */
    .image-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .image-modal.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .image-modal-content {
        max-width: 90vw;
        max-height: 90vh;
        position: relative;
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    
    .image-modal-content img {
        max-width: 100%;
        max-height: 90vh;
        border-radius: var(--radius-lg);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    }
    
    .image-modal-close {
        position: absolute;
        top: -1rem;
        right: -1rem;
        width: 40px;
        height: 40px;
        background: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.5rem;
        color: var(--text-primary);
        box-shadow: var(--shadow-lg);
        transition: all 0.2s;
        z-index: 10;
    }
    
    .image-modal-close:hover {
        transform: rotate(90deg) scale(1.1);
    }
    
    /* INFO GRID - MODERN CARDS */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }
    
    .info-item {
        background: var(--bg-secondary);
        border-radius: var(--radius-md);
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
        transition: all 0.2s;
    }
    
    .info-item:hover {
        background: var(--bg-tertiary);
        transform: translateY(-2px);
    }
    
    .info-label {
        font-size: 0.6875rem;
        font-weight: 600;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .info-value i {
        color: var(--primary-blue);
        font-size: 1rem;
    }
    
    /* LANGUAGES DISPLAY */
    .languages-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.375rem;
    }
    
    .language-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.625rem;
        background: var(--primary-blue);
        color: white;
        border-radius: var(--radius-full);
        font-size: 0.6875rem;
        font-weight: 600;
    }
    
    /* APPLY BUTTON - FLOATING */
    .apply-button-container {
        position: sticky;
        bottom: 1rem;
        z-index: 100;
        display: flex;
        justify-content: center;
        margin: 1.5rem 0;
    }
    
    .btn-apply {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 1rem;
        padding: 1rem 2.5rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 8px 24px rgba(0, 122, 255, 0.4);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-apply:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 12px 32px rgba(0, 122, 255, 0.5);
    }
    
    .btn-apply:active {
        transform: translateY(-2px) scale(1.02);
    }
    
    /* SECTION DIVIDER */
    .section-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--bg-tertiary), transparent);
        margin: 2rem 0;
    }
    
    /* MAIN CONTENT LAYOUT */
    .content-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    /* SECTION HEADER */
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .section-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.125rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
    }
    
    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.3px;
    }
    
    /* OFFERS SECTION */
    .offers-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        padding: 1.25rem;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    
    .offer-card {
        background: linear-gradient(135deg, #FFF9E6 0%, #FFF4CC 100%);
        border: 2px solid #FFE066;
        border-radius: var(--radius-lg);
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .offer-card:last-child {
        margin-bottom: 0;
    }
    
    .offer-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: #FFCC00;
    }
    
    .offer-header {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        margin-bottom: 0.875rem;
    }
    
    .provider-avatar {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #FFCC00;
        box-shadow: var(--shadow-sm);
    }
    
    .provider-info {
        flex: 1;
        min-width: 0;
    }
    
    .provider-name {
        font-weight: 700;
        color: #8B6914;
        font-size: 0.9375rem;
        margin-bottom: 0.25rem;
    }
    
    .provider-rating {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: #A87C1A;
        font-size: 0.8125rem;
    }
    
    .offer-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: #8B6914;
        white-space: nowrap;
    }
    
    .offer-message {
        color: #6B5416;
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }
    
    .offer-delivery {
        color: #A87C1A;
        font-size: 0.8125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        margin-bottom: 0.875rem;
    }
    
    .btn-choose-provider {
        background: linear-gradient(135deg, #FFCC00, #FFB300);
        color: #6B5416;
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-choose-provider:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 204, 0, 0.4);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: var(--text-tertiary);
    }
    
    .empty-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
    
    .empty-text {
        font-size: 0.9375rem;
        font-weight: 600;
    }
    
    /* MESSAGES SECTION - iPHONE STYLE */
    .messages-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        padding: 1.25rem;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(255, 255, 255, 0.8);
        display: flex;
        flex-direction: column;
        height: 500px;
    }
    
    .messages-list {
        flex: 1;
        overflow-y: auto;
        padding: 0.5rem 0;
        margin-bottom: 1rem;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    
    .messages-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .messages-list::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .messages-list::-webkit-scrollbar-thumb {
        background: var(--bg-tertiary);
        border-radius: var(--radius-full);
    }
    
    /* MESSAGE ITEM - iPHONE STYLE */
    .message-item {
        display: flex;
        margin-bottom: 0.875rem;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* MESSAGES FROM OTHERS - LEFT */
    .message-item.from-others {
        flex-direction: row;
        align-items: flex-end;
        gap: 0.5rem;
    }
    
    .message-item.from-others .message-avatar {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.25rem;
    }
    
    .message-item.from-others .message-content {
        max-width: 75%;
    }
    
    .message-item.from-others .message-bubble {
        background: var(--secondary-gray);
        color: var(--text-primary);
        border-radius: 18px 18px 18px 4px;
    }
    
    /* MESSAGES FROM CURRENT USER - RIGHT */
    .message-item.from-me {
        flex-direction: row-reverse;
        align-items: flex-end;
    }
    
    .message-item.from-me .message-content {
        max-width: 75%;
    }
    
    .message-item.from-me .message-bubble {
        background: var(--primary-blue);
        color: white;
        border-radius: 18px 18px 4px 18px;
    }
    
    .message-bubble {
        padding: 0.75rem 1rem;
        box-shadow: var(--shadow-sm);
        word-wrap: break-word;
    }
    
    .message-author {
        font-size: 0.6875rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        opacity: 0.8;
    }
    
    .message-text {
        font-size: 0.9375rem;
        line-height: 1.4;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    .message-time {
        font-size: 0.6875rem;
        margin-top: 0.25rem;
        opacity: 0.6;
        text-align: right;
    }
    
    /* MESSAGE FORM - iPHONE STYLE */
    .message-form {
        display: flex;
        align-items: flex-end;
        gap: 0.625rem;
        padding-top: 0.875rem;
        border-top: 1px solid var(--bg-tertiary);
    }
    
    .message-input-wrapper {
        flex: 1;
        position: relative;
    }
    
    .message-input {
        width: 100%;
        min-height: 36px;
        max-height: 100px;
        padding: 0.625rem 1rem;
        background: var(--bg-secondary);
        border: 1px solid var(--bg-tertiary);
        border-radius: 18px;
        font-size: 0.9375rem;
        font-family: inherit;
        resize: none;
        transition: all 0.2s;
    }
    
    .message-input:focus {
        outline: none;
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
    }
    
    .message-input::placeholder {
        color: var(--text-tertiary);
    }
    
    .btn-send-message {
        width: 36px;
        height: 36px;
        min-width: 36px;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0, 122, 255, 0.3);
    }
    
    .btn-send-message:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.4);
    }
    
    .btn-send-message:active {
        transform: scale(0.95);
    }
    
    .btn-send-message i {
        font-size: 1rem;
    }
    
    /* MESSAGES CLOSED STATE */
    .messages-closed {
        text-align: center;
        padding: 3rem 1.5rem;
        background: linear-gradient(135deg, #FFF9E6 0%, #FFF4CC 100%);
        border: 2px solid #FFE066;
        border-radius: var(--radius-lg);
    }
    
    .messages-closed-icon {
        font-size: 3rem;
        color: #A87C1A;
        margin-bottom: 1rem;
        opacity: 0.6;
    }
    
    .messages-closed-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #6B5416;
        margin-bottom: 0.75rem;
    }
    
    .messages-closed-text {
        font-size: 0.875rem;
        color: #8B6914;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }
    
    .btn-private-message {
        display: inline-flex;
        align-items: center;
        gap: 0.625rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        padding: 0.875rem 1.75rem;
        border-radius: var(--radius-full);
        font-weight: 700;
        font-size: 0.875rem;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        transition: all 0.2s;
    }
    
    .btn-private-message:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
    }
    
    /* MODALS - MODERN DESIGN */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .modal-content {
        background: white;
        border-radius: var(--radius-xl);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        max-width: 500px;
        width: 100%;
        padding: 2rem 1.5rem;
        position: relative;
        transform: scale(0.9);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1);
        opacity: 1;
    }
    
    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 32px;
        height: 32px;
        background: var(--bg-secondary);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.125rem;
        color: var(--text-secondary);
        transition: all 0.2s;
    }
    
    .modal-close:hover {
        background: var(--bg-tertiary);
        transform: rotate(90deg);
    }
    
    .modal-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
        box-shadow: 0 8px 24px rgba(0, 122, 255, 0.3);
    }
    
    .modal-title {
        font-size: 1.375rem;
        font-weight: 800;
        color: var(--text-primary);
        text-align: center;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
    }
    
    .modal-subtitle {
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.9375rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .modal-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }
    
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 0.875rem;
        padding: 0.875rem 0;
        border-bottom: 1px solid var(--bg-secondary);
    }
    
    .feature-item:last-child {
        border-bottom: none;
    }
    
    .feature-icon {
        width: 28px;
        min-width: 28px;
        height: 28px;
        background: var(--success-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
    }
    
    .feature-text {
        flex: 1;
        font-size: 0.9375rem;
        line-height: 1.6;
        color: var(--text-secondary);
    }
    
    .feature-highlight {
        font-weight: 700;
        color: var(--text-primary);
    }
    
    .modal-actions {
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
    }
    
    .btn-modal-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 1rem;
        padding: 1rem 2rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-modal-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
    }
    
    .btn-modal-secondary {
        background: transparent;
        color: var(--danger-red);
        font-weight: 600;
        font-size: 0.9375rem;
        padding: 0.875rem 2rem;
        border: 2px solid var(--danger-red);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-modal-secondary:hover {
        background: var(--danger-red);
        color: white;
    }
    
    /* FORM STYLES */
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.625rem;
    }
    
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        background: var(--bg-secondary);
        border: 2px solid var(--bg-tertiary);
        border-radius: var(--radius-md);
        font-size: 0.9375rem;
        font-family: inherit;
        transition: all 0.2s;
    }
    
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-error {
        color: var(--danger-red);
        font-size: 0.8125rem;
        margin-top: 0.5rem;
        display: none;
    }
    
    .form-error.visible {
        display: block;
    }
    
    /* SUCCESS MODAL */
    .modal-success-icon {
        width: 80px;
        height: 80px;
        background: var(--success-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2.5rem;
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* RESPONSIVE - TABLET */
    @media (min-width: 768px) {
        .request-details-container {
            padding: 1.5rem;
        }
        
        .request-card {
            padding: 2rem;
        }
        
        .request-title {
            font-size: 2rem;
        }
        
        .image-gallery {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        
        .info-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        
        .content-layout {
            grid-template-columns: 400px 1fr;
            gap: 1.5rem;
        }
        
        .offers-section,
        .messages-section {
            padding: 1.75rem;
        }
        
        .messages-section {
            height: 600px;
        }
        
        .modal-actions {
            flex-direction: row;
        }
    }
    
    /* RESPONSIVE - DESKTOP */
    @media (min-width: 1024px) {
        .request-details-container {
            padding: 2rem;
        }
        
        .image-gallery {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
        
        .messages-section {
            height: 700px;
        }
    }
    
    /* UTILITY CLASSES */
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
</style>

<div class="request-details-container" x-data="requestDetailsApp()">
    
    <!-- REQUEST CARD -->
    <div class="request-card">
        
        <!-- Category Badge -->
        <div class="category-badge">
            <i class="fas fa-folder-open"></i>
            <span>
                {{ $mission->category->name ?? 'Category' }} 
                @if($mission->subcategory)
                    › {{ $mission->subcategory->name }}
                @endif
                @if($mission->subsubcategory)
                    › {{ $mission->subsubcategory->name }}
                @endif
            </span>
        </div>
        
        <!-- Title -->
        <h1 class="request-title">{{ $mission->title }}</h1>
        
        <!-- Description -->
        <div class="request-description">{{ $mission->description }}</div>
        
        <!-- Image Gallery -->
        @if($images && count($images) > 0)
        <div class="image-gallery">
            @foreach($images as $img)
            <div class="gallery-item"
                 @click="openImageModal('{{ asset($img) }}')"
                 role="button"
                 tabindex="0"
                 @keydown.enter="openImageModal('{{ asset($img) }}')"
                 aria-label="View attachment">
                <img src="{{ asset($img) }}" alt="Mission attachment" loading="lazy" />
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Ad Unpublished In</div>
                <div class="info-value">
                    <i class="fas fa-calendar-times"></i>
                    <span>{{ $remainingDays }} Days</span>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Country</div>
                <div class="info-value">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $mission->location_country ?? 'Not specified' }}</span>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">City</div>
                <div class="info-value">
                    <i class="fas fa-city"></i>
                    <span>{{ $mission->location_city ?? 'Not specified' }}</span>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Duration</div>
                <div class="info-value">
                    <i class="fas fa-clock"></i>
                    <span>{{ $mission->service_durition ?? 'Not specified' }}</span>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Languages Spoken</div>
                <div class="info-value" style="flex-wrap: wrap;">
                    @if(count($spokenLanguages) > 0)
                        <div class="languages-list">
                            @foreach($spokenLanguages as $lang)
                                <span class="language-tag">{{ $lang }}</span>
                            @endforeach
                        </div>
                    @else
                        <span>{{ $mission->language ?? 'Not specified' }}</span>
                    @endif
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Remote Support</div>
                <div class="info-value">
                    <i class="fas fa-{{ $mission->is_remote ? 'check-circle' : 'times-circle' }}"></i>
                    <span>{{ $mission->is_remote ? 'Yes' : 'No' }}</span>
                </div>
            </div>
        </div>
        
        <!-- Apply Button -->
        @if(auth()->check() && $mission && $mission->requester_id != auth()->id())
        <div class="apply-button-container">
            <button @click="openOfferModal()" class="btn-apply">
                <i class="fas fa-paper-plane"></i>
                <span>Apply Now</span>
            </button>
        </div>
        @endif
    </div>
    
    <!-- Section Divider -->
    <div class="section-divider"></div>
    
    <!-- Main Content Layout -->
    <div class="content-layout">
        
        <!-- OFFERS SECTION -->
        <div class="offers-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h2 class="section-title">Offers Received</h2>
            </div>
            
            @forelse($offers as $offer)
            <div class="offer-card">
                <div class="offer-header">
                    @if($offer->provider && $offer->provider->profile_photo)
                    <img src="{{ asset($offer->provider->profile_photo) }}"
                         alt="{{ $offer->provider->first_name ?? 'Provider' }}"
                         class="provider-avatar" />
                    @else
                    <div class="provider-avatar" style="background: linear-gradient(135deg, #FFB300, #FF8F00); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        {{ substr($offer->provider->first_name ?? 'P', 0, 1) }}
                    </div>
                    @endif
                    
                    <div class="provider-info">
                        <div class="provider-name">{{ $offer->provider->first_name ?? 'Provider' }}</div>
                        <div class="provider-rating">
                            <i class="fas fa-star"></i>
                            <span>{{ $offer->provider->rating ?? '5.0' }}</span>
                        </div>
                    </div>
                    
                    <div class="offer-price">{{ $offer->price ?? '-' }} €</div>
                </div>
                
                <div class="offer-message">{{ $offer->message ?? 'No message provided.' }}</div>
                
                <div class="offer-delivery">
                    <i class="fas fa-clock"></i>
                    <span>Delivery: {{ $offer->delivery_time ?? '-' }}</span>
                </div>
                
                @if(auth()->check() && $mission && $mission->requester_id == auth()->id())
                <button @click="chooseProvider({{ $offer->provider->id }}, '{{ $offer->provider->first_name }}')"
                        class="btn-choose-provider">
                    Choose {{ $offer->provider->first_name }}
                </button>
                @endif
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="empty-text">No offers received yet</div>
            </div>
            @endforelse
        </div>
        
        <!-- MESSAGES SECTION -->
        <div class="messages-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-{{ is_null($mission->selected_provider_id) ? 'comments' : 'lock' }}"></i>
                </div>
                <h2 class="section-title">
                    {{ is_null($mission->selected_provider_id) ? 'Public Messages' : 'Public Messages Closed' }}
                </h2>
            </div>
            
            @if(is_null($mission->selected_provider_id))
                <!-- Public Messaging Open -->
                <div class="messages-list" id="messagesList" x-ref="messagesList"></div>
                
                <form @submit.prevent="sendMessage()" class="message-form">
                    <div class="message-input-wrapper">
                        <textarea x-model="messageText"
                                  class="message-input"
                                  placeholder="Type a message..."
                                  rows="1"
                                  maxlength="500"
                                  @input="autoResize($event)"
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn-send-message">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                </form>
                
                <div x-show="messageError" x-text="messageError" class="form-error visible"></div>
            @else
                <!-- Public Messaging Closed -->
                <div class="messages-closed">
                    <div class="messages-closed-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="messages-closed-title">Public Messaging Closed</h3>
                    <p class="messages-closed-text">
                        This mission now has a selected provider.<br>
                        Public messaging is no longer available.
                    </p>
                    <a href="{{ route('user.conversation') }}" class="btn-private-message">
                        <i class="fas fa-comments"></i>
                        <span>Use Private Messaging</span>
                    </a>
                </div>
            @endif
        </div>
        
    </div>
    
    <!-- Image Modal -->
    <div class="image-modal" 
         :class="{ 'active': imageModalOpen }"
         @click="closeImageModal()"
         role="dialog"
         aria-modal="true">
        <div class="image-modal-content" @click.stop>
            <button class="image-modal-close" @click="closeImageModal()">✕</button>
            <img :src="currentImage" alt="Full size attachment" />
        </div>
    </div>
    
    <!-- Offer Modal -->
    <div class="modal-overlay"
         :class="{ 'active': offerModalOpen }"
         @click="closeOfferModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="closeOfferModal()">✕</button>
            
            <div class="modal-icon">
                <i class="fas fa-paper-plane"></i>
            </div>
            
            <h2 class="modal-title">Send Your Offer</h2>
            
            <form @submit.prevent="submitOffer()">
                <div class="form-group">
                    <label for="offerPrice" class="form-label">Your Proposed Price (€)</label>
                    <input type="number"
                           id="offerPrice"
                           x-model="offerForm.price"
                           class="form-input"
                           placeholder="e.g. 50"
                           min="1"
                           step="0.01"
                           required />
                </div>
                
                <div class="form-group">
                    <label for="offerDelivery" class="form-label">Estimated Delivery Time</label>
                    <input type="text"
                           id="offerDelivery"
                           x-model="offerForm.delivery_time"
                           class="form-input"
                           placeholder="e.g. 2 days"
                           maxlength="50"
                           required />
                </div>
                
                <div class="form-group">
                    <label for="offerMessage" class="form-label">Message (max 300 characters)</label>
                    <textarea id="offerMessage"
                              x-model="offerForm.message"
                              class="form-textarea"
                              maxlength="300"
                              placeholder="I'm available and ready to help!"
                              required></textarea>
                </div>
                
                <div x-show="offerError" x-text="offerError" class="form-error visible"></div>
                
                <button type="submit" class="btn-modal-primary">
                    <i class="fas fa-paper-plane"></i>
                    <span>Submit Offer</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Confirm Provider Modal -->
    <div class="modal-overlay"
         :class="{ 'active': confirmModalOpen }"
         @click="closeConfirmModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="closeConfirmModal()">✕</button>
            
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2 class="modal-title">You're Almost There! 🎯</h2>
            
            <p class="modal-subtitle">
                You're about to work with <span style="color: var(--primary-blue); font-weight: 700;" x-text="selectedProviderName"></span>.<br>
                Here's what happens next:
            </p>
            
            <ul class="modal-features">
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="feature-text">
                        <span class="feature-highlight">Your payment is protected</span> — it's securely held by Stripe and will only be released once the job is completed.
                    </div>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="feature-text">
                        <span class="feature-highlight">You'll unlock chat</span> with the provider right after confirming.
                    </div>
                </li>
                <li class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="feature-text">
                        <span class="feature-highlight">We're here to help</span> all along — if anything goes wrong, reach out!
                    </div>
                </li>
            </ul>
            
            <div class="modal-actions">
                <a :href="paymentUrl"
                   class="btn-modal-primary">
                    <i class="fas fa-check"></i>
                    <span>Confirm & Pay</span>
                </a>
                <button @click="closeConfirmModal()"
                        class="btn-modal-secondary">
                    ← Choose Another Provider
                </button>
            </div>
        </div>
    </div>
    
    <!-- Success Modal -->
    <div class="modal-overlay"
         :class="{ 'active': successModalOpen }"
         @click="closeSuccessModal()"
         role="dialog"
         aria-modal="true">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="closeSuccessModal()">✕</button>
            
            <div class="modal-success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h2 class="modal-title">Thank You!</h2>
            
            <p class="modal-subtitle" style="font-weight: 600; color: var(--primary-blue);">
                Your request has been sent to the requester
            </p>
            
            <p style="text-align: center; color: var(--text-secondary); font-size: 0.9375rem; line-height: 1.6;">
                You will be informed if your application is accepted via your personal messaging and by email.
            </p>
        </div>
    </div>
    
</div>

<script>
function requestDetailsApp() {
    return {
        // Image Modal
        imageModalOpen: false,
        currentImage: '',
        
        // Offer Modal
        offerModalOpen: false,
        offerForm: {
            price: '',
            delivery_time: '',
            message: ''
        },
        offerError: '',
        
        // Confirm Modal
        confirmModalOpen: false,
        selectedProviderId: null,
        selectedProviderName: '',
        paymentUrl: '',
        
        // Success Modal
        successModalOpen: false,
        
        // Messages
        messages: [],
        messageText: '',
        messageError: '',
        currentUserId: {{ auth()->id() ?? 'null' }},
        missionClosed: {{ is_null($mission->selected_provider_id) ? 'false' : 'true' }},
        
        init() {
            if (!this.missionClosed) {
                this.loadMessages();
                // Refresh messages every 5 seconds
                setInterval(() => this.loadMessages(), 5000);
            }
        },
        
        // Image Modal Methods
        openImageModal(imageUrl) {
            this.currentImage = imageUrl;
            this.imageModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeImageModal() {
            this.imageModalOpen = false;
            document.body.style.overflow = '';
        },
        
        // Offer Modal Methods
        openOfferModal() {
            this.offerModalOpen = true;
            this.offerError = '';
            document.body.style.overflow = 'hidden';
        },
        
        closeOfferModal() {
            this.offerModalOpen = false;
            this.offerForm = { price: '', delivery_time: '', message: '' };
            this.offerError = '';
            document.body.style.overflow = '';
        },
        
        async submitOffer() {
            this.offerError = '';
            
            const formData = new FormData();
            formData.append('price', this.offerForm.price);
            formData.append('delivery_time', this.offerForm.delivery_time);
            formData.append('message', this.offerForm.message);
            
            try {
                const response = await fetch("{{ route('mission.offer', $mission->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    this.closeOfferModal();
                    this.successModalOpen = true;
                    setTimeout(() => location.reload(), 3000);
                } else {
                    this.offerError = data.message || 'Failed to submit offer.';
                }
            } catch (error) {
                this.offerError = 'Failed to submit offer. Please try again.';
            }
        },
        
        // Confirm Modal Methods
        chooseProvider(providerId, providerName) {
            this.selectedProviderId = providerId;
            this.selectedProviderName = providerName;
            this.paymentUrl = `{{ route('user.payments') }}?id=${providerId}&mission_id={{ $mission->id }}`;
            this.confirmModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeConfirmModal() {
            this.confirmModalOpen = false;
            document.body.style.overflow = '';
        },
        
        // Success Modal Methods
        closeSuccessModal() {
            this.successModalOpen = false;
            document.body.style.overflow = '';
        },
        
        // Messages Methods
        async loadMessages() {
            try {
                const response = await fetch("{{ route('mission.public-messages', $mission->id) }}");
                const data = await response.json();
                
                if (data.status === 'success') {
                    this.messages = data.messages || [];
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error('Error loading messages:', error);
            }
        },
        
        async sendMessage() {
            if (!this.messageText.trim()) return;
            
            this.messageError = '';
            const rawMessage = this.messageText.trim();
            const sanitizedMessage = this.sanitizeMessage(rawMessage);
            
            try {
                const response = await fetch("{{ route('mission.public-message', $mission->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: sanitizedMessage })
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    this.messageText = '';
                    this.loadMessages();
                } else {
                    this.messageError = data.message || 'Failed to send message.';
                }
            } catch (error) {
                this.messageError = 'Failed to send message. Please try again.';
            }
        },
        
        sanitizeMessage(msg) {
            let out = msg;
            
            // Gmail → first letter + @gmail.com
            out = out.replace(/\b([A-Za-z0-9._%+-])[A-Za-z0-9._%+-]*@gmail\.com\b/gi, '$1@gmail.com');
            
            // URLs with protocol → www.....com
            out = out.replace(/\bhttps?:\/\/[^\s)]+/gi, 'www.....com');
            
            // URLs starting with www. → www.....com
            out = out.replace(/\bwww\.[A-Za-z0-9-]+(?:\.[A-Za-z]{2,24})(?:\/[^\s)]*)?\b/gi, 'www.....com');
            
            // Bare domains → www.....com
            try {
                out = out.replace(/(?<!@)\b[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi, 'www.....com');
            } catch (e) {
                out = out.replace(/\b(?![A-Za-z0-9._%+-]+@)[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi, 'www.....com');
            }
            
            // Phone numbers → [phone]
            out = out.replace(/\+?\d[\d\s\-().]{7,}\d\b/g, '[phone]');
            
            // Cleanup
            out = out.replace(/\s{2,}/g, ' ').trim();
            
            return out || '[redacted]';
        },
        
        autoResize(event) {
            const textarea = event.target;
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 100) + 'px';
        },
        
        scrollToBottom() {
            const list = this.$refs.messagesList;
            if (list) {
                list.scrollTop = list.scrollHeight;
            }
        },
        
        renderMessages() {
            const list = this.$refs.messagesList;
            if (!list) return;
            
            if (this.messages.length === 0) {
                list.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-comments"></i></div>
                        <div class="empty-text">No messages yet. Start the conversation!</div>
                    </div>
                `;
                return;
            }
            
            list.innerHTML = '';
            
            this.messages.forEach(msg => {
                const isFromMe = this.currentUserId && msg.user_id === this.currentUserId;
                const messageClass = isFromMe ? 'from-me' : 'from-others';
                
                const profileImage = msg.user && msg.user.profile_photo
                    ? '{{ asset("") }}' + msg.user.profile_photo
                    : '{{ asset("images/helpexpat.png") }}';
                
                const messageHTML = `
                    <div class="message-item ${messageClass}">
                        ${!isFromMe ? `<img src="${profileImage}" alt="${msg.user.name}" class="message-avatar" />` : ''}
                        <div class="message-content">
                            <div class="message-bubble">
                                ${!isFromMe ? `<div class="message-author">${msg.user.name}</div>` : ''}
                                <div class="message-text">${this.escapeHtml(msg.message)}</div>
                                <div class="message-time">${msg.created_at}</div>
                            </div>
                        </div>
                    </div>
                `;
                
                list.insertAdjacentHTML('beforeend', messageHTML);
            });
        },
        
        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    }
}

// Watch for messages changes and re-render
document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        const app = Alpine.$data(document.querySelector('[x-data]'));
        if (app && app.messages) {
            app.renderMessages();
        }
    });
});
</script>

<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection