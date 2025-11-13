@extends('dashboard.layouts.master')

@section('title', 'My Account')

@section('content')
    @php 
      $user = auth()->user();
    @endphp

<script>
  const LOGGED_IN_USER_ID = {{ auth()->user()->id }};
</script>

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #475569;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-sm: 0.75rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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

    .account-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        padding-bottom: 8rem;
        min-height: 100vh;
        contain: layout style paint;
    }

    .welcome-header-2025 {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        border-radius: var(--border-radius-xl);
        padding: 2rem 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .welcome-title-2025 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .welcome-subtitle-2025 {
        font-size: 1rem;
        opacity: 0.95;
    }

    .section-card-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-xl);
        padding: 1.5rem;
        border: 2px solid #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        transition: var(--transition-base);
        will-change: transform;
    }

    .section-header-2025 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title-2025 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .section-subtitle-2025 {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        margin-top: 0.25rem;
    }

    .btn-primary-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
        will-change: transform;
        -webkit-tap-highlight-color: transparent;
    }

    .btn-primary-2025:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -2px rgba(37, 99, 235, 0.4);
    }

    .btn-primary-2025:active {
        transform: translateY(0);
        transition-duration: 0.1s;
    }

    .btn-danger-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: linear-gradient(135deg, var(--color-danger) 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: var(--border-radius-md);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
        will-change: transform;
        -webkit-tap-highlight-color: transparent;
    }

    .btn-danger-2025:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -2px rgba(239, 68, 68, 0.4);
    }

    .btn-primary-2025:focus-visible,
    .btn-secondary-2025:focus-visible,
    .btn-danger-2025:focus-visible,
    .modal-close-2025:focus-visible,
    .category-item-2025:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 3px;
    }

    .info-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .info-item-2025 {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-label-2025 {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value-2025 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-text-primary);
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
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

    .modal-2025 {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.95) translateZ(0);
        background: white;
        border-radius: var(--border-radius-xl);
        padding: 0;
        z-index: 9999;
        max-width: 600px;
        width: 90%;
        max-height: 85vh;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        will-change: transform, opacity;
        -webkit-backface-visibility: hidden;
    }

    .modal-2025.active {
        transform: translate(-50%, -50%) scale(1) translateZ(0);
        opacity: 1;
        visibility: visible;
    }

    .modal-header-2025 {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .modal-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-text-primary);
    }

    .modal-close-2025 {
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
        font-size: 1.125rem;
        color: #6b7280;
        -webkit-tap-highlight-color: transparent;
    }

    .modal-close-2025:hover {
        background: #e5e7eb;
        transform: rotate(90deg);
    }

    .modal-body-2025 {
        padding: 1.5rem;
        overflow-y: auto;
        max-height: calc(85vh - 140px);
        -webkit-overflow-scrolling: touch;
    }

    .modal-footer-2025 {
        padding: 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    .form-group-2025 {
        margin-bottom: 1.25rem;
    }

    .form-label-2025 {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }

    .form-input-2025 {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.9375rem;
        color: var(--color-text-primary);
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        background: var(--color-bg-primary);
        font-size: max(16px, 0.9375rem);
    }

    .form-input-2025:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input-2025:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 2px;
    }

    .form-textarea-2025 {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.9375rem;
        color: var(--color-text-primary);
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        background: var(--color-bg-primary);
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
        font-size: max(16px, 0.9375rem);
    }

    .form-textarea-2025:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .btn-secondary-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
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

    .btn-secondary-2025:hover {
        background: #e2e8f0;
    }

    .category-grid-2025 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    .category-item-2025 {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--color-bg-secondary);
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        cursor: pointer;
        transition: var(--transition-base);
        -webkit-tap-highlight-color: transparent;
    }

    .category-item-2025:active {
        transform: scale(0.98);
    }

    .category-item-2025:hover {
        background: #eff6ff;
        border-color: var(--color-primary-light);
    }

    .category-checkbox-2025 {
        width: 18px;
        height: 18px;
        border-radius: 0.375rem;
        border: 2px solid #cbd5e1;
        cursor: pointer;
        accent-color: var(--color-primary);
    }

    .category-icon-2025 {
        width: 40px;
        height: 40px;
        margin-left: 0.75rem;
        border-radius: var(--border-radius-md);
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
    }

    .category-icon-2025 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-name-2025 {
        margin-left: 0.75rem;
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-text-primary);
        flex: 1;
    }

    .step-indicator-2025 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .step-number-2025 {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        font-weight: 600;
    }

    .progress-bar-2025 {
        height: 6px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin-top: 0.5rem;
    }

    .progress-fill-2025 {
        height: 100%;
        background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        border-radius: 999px;
        transition: width 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        will-change: width;
        transform: translateZ(0);
    }

    .empty-state-2025 {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--color-text-tertiary);
    }

    .empty-icon-2025 {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.4;
    }

    .empty-text-2025 {
        font-size: 0.9375rem;
        color: var(--color-text-secondary);
    }

    .selection-count-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.875rem;
        background: #eff6ff;
        color: var(--color-primary);
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .toggle-group-2025 {
        display: flex;
        gap: 0.5rem;
        padding: 0.25rem;
        background: var(--color-bg-secondary);
        border-radius: var(--border-radius-md);
    }

    .toggle-btn {
        flex: 1;
        padding: 0.625rem 1rem;
        border: 2px solid transparent;
        border-radius: calc(var(--border-radius-md) - 0.25rem);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-base);
        background: transparent;
        color: var(--color-text-secondary);
        -webkit-tap-highlight-color: transparent;
    }

    .toggle-btn.active {
        background: white;
        color: var(--color-primary);
        border-color: var(--color-primary);
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
    }

    .status-badge-2025 {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-badge-2025.success {
        background: #d1fae5;
        color: #059669;
    }

    .status-badge-2025.warning {
        background: #fef3c7;
        color: #d97706;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .spinner {
        display: inline-block;
        width: 48px;
        height: 48px;
        border: 4px solid #e5e7eb;
        border-top-color: var(--color-primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        will-change: transform;
    }

    .checkbox-group-2025 {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: #fff5f5;
        border: 2px solid #fecaca;
        border-radius: var(--border-radius-md);
        cursor: pointer;
        transition: var(--transition-base);
    }

    .checkbox-group-2025:hover {
        background: #fee2e2;
        border-color: #fca5a5;
    }

    .checkbox-group-2025 input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-top: 0.125rem;
        cursor: pointer;
        accent-color: var(--color-danger);
        flex-shrink: 0;
    }

    .checkbox-label-2025 {
        flex: 1;
    }

    .checkbox-title-2025 {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--color-danger);
        margin-bottom: 0.25rem;
    }

    .checkbox-description-2025 {
        font-size: 0.8125rem;
        color: #991b1b;
        line-height: 1.5;
    }

    * {
        box-sizing: border-box;
    }

    @media (min-width: 640px) {
        .account-container-2025 {
            padding: 1.5rem;
            padding-bottom: 8rem;
        }

        .welcome-header-2025 {
            padding: 2.5rem 2rem;
        }

        .welcome-title-2025 {
            font-size: 2rem;
        }

        .info-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
        }

        .category-grid-2025 {
            grid-template-columns: repeat(2, 1fr);
        }

        .section-card-2025 {
            padding: 2rem;
        }

        .modal-2025 {
            width: 85%;
        }
    }

    @media (min-width: 1024px) {
        .account-container-2025 {
            padding: 2rem;
            padding-bottom: 2rem;
        }

        .modal-2025 {
            width: 600px;
        }
    }

    @media (max-width: 768px) {
        .modal-2025 {
            position: fixed;
            top: auto;
            bottom: 0;
            left: 0;
            right: 0;
            transform: translateY(100%) translateZ(0);
            max-width: 100%;
            width: 100%;
            border-radius: var(--border-radius-xl) var(--border-radius-xl) 0 0;
        }

        .modal-2025.active {
            transform: translateY(0) translateZ(0);
        }
    }

    body.modal-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
        height: 100%;
    }
</style>

<div class="account-container-2025">

    <!-- Welcome Header -->
    <div class="welcome-header-2025">
        <h1 class="welcome-title-2025">Hey, {{ explode(' ', $user->name)[0] ?? 'there' }}!</h1>
        <p class="welcome-subtitle-2025">Manage your account settings and preferences</p>
    </div>

    <!-- Banking Information Section -->
    <div class="section-card-2025">
        <div class="section-header-2025">
            <div>
                <h3 class="section-title-2025">Banking Information</h3>
                <p class="section-subtitle-2025">Set up your banking details for receiving payments</p>
            </div>
            <button onclick="showBankingModal()" class="btn-primary-2025">
                <i class="fas fa-credit-card"></i>
                <span>{{ $user->hasBankingDetails() ? 'Update Details' : 'Add Details' }}</span>
            </button>
        </div>

        @if($user->hasBankingDetails())
            <div class="info-grid-2025">
                <div class="info-item-2025">
                    <div class="info-label-2025">Account Holder</div>
                    <div class="info-value-2025">{{ $user->bank_account_holder }}</div>
                </div>
                <div class="info-item-2025">
                    <div class="info-label-2025">IBAN</div>
                    <div class="info-value-2025">{{ substr($user->bank_account_iban, 0, 4) . '****' }}</div>
                </div>
                <div class="info-item-2025">
                    <div class="info-label-2025">Bank Name</div>
                    <div class="info-value-2025">{{ $user->bank_name }}</div>
                </div>
                <div class="info-item-2025">
                    <div class="info-label-2025">Last Updated</div>
                    <div class="info-value-2025">{{ $user->bank_details_verified_at?->diffForHumans() }}</div>
                </div>
            </div>
        @else
            <div class="empty-state-2025">
                <div class="empty-icon-2025">
                    <i class="fas fa-university"></i>
                </div>
                <p class="empty-text-2025">No banking information added yet</p>
            </div>
        @endif
    </div>

    @if(auth()->user()->user_role === 'service_provider')
        @include('dashboard.my-account-partials.service-provider-section')
    @else
        @include('dashboard.my-account-partials.regular-user-section')
    @endif

    <!-- Account Deletion Section -->
    <div class="section-card-2025">
        <div class="section-header-2025">
            <div>
                <h3 class="section-title-2025" style="color: var(--color-danger);">Delete Account</h3>
                <p class="section-subtitle-2025">Permanently delete your account and all associated data</p>
            </div>
        </div>

        <form id="deleteAccountForm" method="POST" action="{{ route('account.delete') }}">
            @csrf
            @method('DELETE')
            
            <label class="checkbox-group-2025">
                <input type="checkbox" id="confirmDelete" name="confirm_delete" required>
                <div class="checkbox-label-2025">
                    <div class="checkbox-title-2025">I want to permanently delete my account</div>
                    <div class="checkbox-description-2025">
                        This action cannot be undone. All your data, including profile information, 
                        @if(auth()->user()->user_role === 'service_provider')
                        service provider details, categories, reviews,
                        @endif
                        and banking details will be permanently deleted.
                    </div>
                </div>
            </label>

            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end;">
                <button type="button" onclick="confirmAccountDeletion()" class="btn-danger-2025" id="deleteAccountBtn" disabled>
                    <i class="fas fa-trash-alt"></i>
                    <span>Delete My Account</span>
                </button>
            </div>
        </form>
    </div>

</div>

<!-- Modal Overlay -->
<div class="modal-overlay hidden" onclick="closeAllPopups()"></div>

<!-- Modals for Service Providers -->
@if(auth()->user()->user_role === 'service_provider')
  @include('dashboard.my-account-partials.about-you-modal')
  @include('dashboard.my-account-partials.special-status-modal', ['provider' => auth()->user()->serviceProvider])
  @include('dashboard.my-account-partials.category-search-modal')
@endif
@include('dashboard.my-account-partials.banking-details-modal')

<script>
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

if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.src = img.dataset.src;
    });
} else {
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
}

document.addEventListener("DOMContentLoaded", function () {
  initializeSpecialStatusModal();
  initializeToggleButtons();
  initializeAccountDeletion();
});

function initializeAccountDeletion() {
    const checkbox = document.getElementById('confirmDelete');
    const deleteBtn = document.getElementById('deleteAccountBtn');
    
    if (checkbox && deleteBtn) {
        checkbox.addEventListener('change', function() {
            deleteBtn.disabled = !this.checked;
        });
    }
}

function confirmAccountDeletion() {
    if (!document.getElementById('confirmDelete').checked) {
        showNotification('Please confirm account deletion by checking the box', 'warning');
        return;
    }
    
    if (confirm('Are you absolutely sure you want to delete your account? This action is irreversible and all your data will be permanently lost.')) {
        document.getElementById('deleteAccountForm').submit();
    }
}

// CORRECTION: Fonctions pour gérer l'affichage des modals
function showModal(modalId) {
  const modal = document.getElementById(modalId);
  const overlay = document.querySelector('.modal-overlay');
  
  if (modal) {
    // Retirer la classe hidden
    modal.classList.remove('hidden');
    
    // Pour les modals avec structure différente (aboutYouPopup, selectet-provider-category)
    if (modalId === 'aboutYouPopup' || modalId === 'selectet-provider-category') {
      document.body.style.overflow = 'hidden';
      
      // Forcer le reflow avant d'ajouter les animations
      void modal.offsetHeight;
      
      if (overlay) {
        overlay.classList.remove('hidden');
        requestAnimationFrame(() => {
          overlay.classList.add('active');
        });
      }
    }
    // Pour bankingDetailsModal (structure différente)
    else if (modalId === 'bankingDetailsModal') {
      // Ce modal a déjà sa propre fonction showBankingModal()
      return;
    }
    // Pour les modals avec classe modal-2025
    else if (modal.classList.contains('modal-2025')) {
      if (overlay) overlay.classList.remove('hidden');
      
      requestAnimationFrame(() => {
        modal.classList.add('active');
        if (overlay) overlay.classList.add('active');
        document.body.classList.add('modal-open');
      });
    }
  }
}

function hideModal(modalId) {
  const modal = document.getElementById(modalId);
  const overlay = document.querySelector('.modal-overlay');
  
  if (modal) {
    if (modalId === 'aboutYouPopup' || modalId === 'selectet-provider-category') {
      modal.classList.add('hidden');
      document.body.style.overflow = '';
      
      if (overlay) {
        overlay.classList.remove('active');
        overlay.classList.add('hidden');
      }
    }
    else if (modalId === 'bankingDetailsModal') {
      // Ce modal a déjà sa propre fonction hideBankingModal()
      return;
    }
    else if (modal.classList.contains('modal-2025')) {
      modal.classList.remove('active');
      
      setTimeout(() => {
        modal.classList.add('hidden');
        
        const activeModals = document.querySelectorAll('.modal-2025:not(.hidden)');
        if (activeModals.length === 0) {
          if (overlay) {
            overlay.classList.remove('active');
            overlay.classList.add('hidden');
          }
          document.body.classList.remove('modal-open');
        }
      }, 200);
    }
  }
}

// FONCTIONS MODIFIÉES - DÉBUT
function openAboutYouPopup() {
    const modal = document.getElementById('aboutYouPopup');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeAboutYouPopup() {
    const modal = document.getElementById('aboutYouPopup');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function openCategoryPopup() {
    const modal = document.getElementById('selectet-provider-category');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Charger les catégories
        fetch('/api/categories')
            .then(res => res.json())
            .then(data => {
                renderCategoryStep(data);
            });
    }
}

function openSpecialStatusModal() {
    const modal = document.getElementById('specialStatusModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}
// FONCTIONS MODIFIÉES - FIN

function submitAboutYou() {
  const description = document.getElementById("aboutYouText").value;

  fetch('/api/update-about-you', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
      user_id: LOGGED_IN_USER_ID,
      description: description
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      toastr.success('About updated successfully!', 'Success');
      closeAboutYouPopup();
    } else {
        toastr.error('Update failed!', 'Error');
    }
  })
  .catch(error => {
    showNotification('An error occurred. Please try again.', 'error');
  });
}

function initializeToggleButtons() {
  document.querySelectorAll(".special-status-item").forEach(group => {
    const buttons = group.querySelectorAll(".toggle-btn");

    buttons.forEach(button => {
      button.addEventListener("click", () => {
        buttons.forEach(btn => {
            btn.classList.remove("active");
        });
        button.classList.add("active");
      });
    });
  });
}

function closeAllPopups() {
  const modalIds = ['selectet-provider-category', 'aboutYouPopup', 'specialStatusModal', 'bankingDetailsModal'];
  modalIds.forEach(id => {
    if (id === 'bankingDetailsModal') {
      hideBankingModal();
    } else {
      hideModal(id);
    }
  });
}

function renderCategoryStep(response) {
    const modal = document.getElementById('render-selectet-provider-category');
    if (!modal) return;
    const categories = response.categories || [];

    const html = `
        <div class="step-indicator-2025">
            <div>
                <div style="font-size: 1rem; font-weight: 700; color: var(--color-text-primary);">Select Categories</div>
                <div style="font-size: 0.875rem; color: var(--color-text-secondary); margin-top: 0.25rem;">Choose categories that match your services</div>
            </div>
            <span class="step-number-2025">Step 1 of 3</span>
        </div>
        <div class="progress-bar-2025">
            <div class="progress-fill-2025" style="width: 33%;"></div>
        </div>
        <div class="category-grid-2025" id="categoryStep" style="margin-top: 1.5rem;">
            ${categories.map(cat => `
                <label class="category-item-2025">
                    <input type="checkbox" class="category-checkbox-2025 main-category-checkbox" value="${cat.id}">
                    ${cat.icon_image ? `
                        <div class="category-icon-2025">
                            <img src="${cat.icon_image}" alt="${cat.name}" loading="lazy">
                        </div>
                    ` : `
                        <div class="category-icon-2025">
                            <i class="fas fa-folder"></i>
                        </div>
                    `}
                    <div class="category-name-2025">${cat.name}</div>
                </label>
            `).join('')}
        </div>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
            <div class="selection-count-2025">
                <i class="fas fa-check-circle"></i>
                <span id="selected-count">0</span> selected
            </div>
            <button type="button" onclick="proceedToSubcategories()" class="btn-primary-2025" id="next-btn" disabled>
                <span>Next Step</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    `;
    
    requestAnimationFrame(() => {
        modal.innerHTML = html;
        modal.dataset.selectedMainCategories = '[]';
        modal.dataset.selectedSubCategories = '[]';
        modal.dataset.selectedSubSubCategories = '[]';
        setupCategoryListeners();
    });
}

function setupCategoryListeners() {
    const checkboxes = document.querySelectorAll('.main-category-checkbox');
    const nextBtn = document.getElementById('next-btn');
    const countDisplay = document.getElementById('selected-count');
    
    const container = document.getElementById('categoryStep');
    if (container) {
        container.addEventListener('change', debounce((e) => {
            if (e.target.classList.contains('main-category-checkbox')) {
                const selectedCount = document.querySelectorAll('.main-category-checkbox:checked').length;
                countDisplay.textContent = selectedCount;
                nextBtn.disabled = selectedCount === 0;
            }
        }, 100));
    }
}

function proceedToSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const checked = Array.from(modal.querySelectorAll('.main-category-checkbox:checked')).map(cb => parseInt(cb.value));

    if (!checked.length) {
        showNotification('Please select at least one category.', 'warning');
        return;
    }
    
    modal.dataset.selectedMainCategories = JSON.stringify(checked);
    showLoadingState(modal);
    
    Promise.all(checked.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`).then(res => res.json().then(data => ({catId, subs: data.subcategories || []})))
    )).then(results => {
        renderSubcategoryStepMulti(checked, results);
    }).catch(error => {
        console.error('Error fetching subcategories:', error);
        showNotification('Failed to load subcategories. Please try again.', 'error');
    });
}

function renderSubcategoryStepMulti(mainCatIds, subcategoriesArr) {
    const modal = document.getElementById('render-selectet-provider-category');
    const hasSubcategories = subcategoriesArr.some(({subs}) => subs.length > 0);
    
    const html = `
        <div class="step-indicator-2025">
            <h3 class="modal-title-2025">Select Subcategories</h3>
            <span class="step-number-2025">Step 2 of 3</span>
        </div>
        <div class="progress-bar-2025">
            <div class="progress-fill-2025" style="width: 66%;"></div>
        </div>
        <div style="margin-top: 1.5rem;">
            ${hasSubcategories ? `
                <div class="category-grid-2025" id="subcategoryStep">
                    ${subcategoriesArr.map(({catId, subs}) => subs.map(sub => `
                        <label class="category-item-2025">
                            <input type="checkbox" class="category-checkbox-2025 sub-category-checkbox" data-main="${catId}" value="${sub.id}">
                            ${sub.icon_image ? `
                                <div class="category-icon-2025">
                                    <img src="${sub.icon_image}" alt="${sub.name}" loading="lazy">
                                </div>
                            ` : `
                                <div class="category-icon-2025">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                            `}
                            <div class="category-name-2025">${sub.name}</div>
                        </label>
                    `).join('')).join('')}
                </div>
            ` : `
                <div class="empty-state-2025">
                    <div class="empty-icon-2025">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <p class="empty-text-2025">No subcategories available</p>
                </div>
            `}
        </div>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
            <button type="button" onclick="goBackToMainCategories()" class="btn-secondary-2025">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </button>
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                ${hasSubcategories ? `
                    <div class="selection-count-2025">
                        <i class="fas fa-check-circle"></i>
                        <span id="sub-selected-count">0</span> selected
                    </div>
                    <button type="button" onclick="proceedToSubSubcategories()" class="btn-primary-2025" id="next-sub-btn" disabled>
                        <span>Next Step</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                ` : `
                    <button type="button" onclick="saveCategorySelectionMulti()" class="btn-primary-2025">
                        <i class="fas fa-check"></i>
                        <span>Save Selection</span>
                    </button>
                `}
            </div>
        </div>
    `;
    
    requestAnimationFrame(() => {
        modal.innerHTML = html;
        if (hasSubcategories) {
            setupSubcategoryListeners();
        }
    });
}

function setupSubcategoryListeners() {
    const nextBtn = document.getElementById('next-sub-btn');
    const countDisplay = document.getElementById('sub-selected-count');
    
    const container = document.getElementById('subcategoryStep');
    if (container) {
        container.addEventListener('change', debounce((e) => {
            if (e.target.classList.contains('sub-category-checkbox')) {
                const selectedCount = document.querySelectorAll('.sub-category-checkbox:checked').length;
                countDisplay.textContent = selectedCount;
                if (nextBtn) nextBtn.disabled = selectedCount === 0;
            }
        }, 100));
    }
}

function proceedToSubSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const checked = Array.from(modal.querySelectorAll('.sub-category-checkbox:checked')).map(cb => parseInt(cb.value));
    
    if (!checked.length) {
        showNotification('Please select at least one subcategory.', 'warning');
        return;
    }
    
    modal.dataset.selectedSubCategories = JSON.stringify(checked);
    showLoadingState(modal);
    
    Promise.all(
        checked.map(subId =>
            fetch(`/api/categories/${subId}/subcategories`)
                .then(res => res.json())
                .then(data => ({ subId, subs: data.subcategories || [] }))
        )
    ).then(results => {
        renderSubSubcategoryStepMulti(checked, results);
    }).catch(error => {
        console.error('Error fetching sub-subcategories:', error);
        showNotification('Failed to load sub-subcategories. Please try again.', 'error');
    });
}

function renderSubSubcategoryStepMulti(subCatIds, subsubcategoriesArr) {
    const modal = document.getElementById('render-selectet-provider-category');
    const hasSubSubcategories = subsubcategoriesArr.some(({subs}) => subs.length > 0);
    
    const html = `
        <div class="step-indicator-2025">
            <h3 class="modal-title-2025">Select Specializations</h3>
            <span class="step-number-2025">Step 3 of 3</span>
        </div>
        <div class="progress-bar-2025">
            <div class="progress-fill-2025" style="width: 100%;"></div>
        </div>
        <div style="margin-top: 1.5rem;">
            ${hasSubSubcategories ? `
                <div class="category-grid-2025" id="subsubcategoryStep">
                    ${subsubcategoriesArr.map(({subId, subs}) => subs.map(subsub => `
                        <label class="category-item-2025">
                            <input type="checkbox" class="category-checkbox-2025 subsub-category-checkbox" data-sub="${subId}" value="${subsub.id}">
                            ${subsub.icon_image ? `
                                <div class="category-icon-2025">
                                    <img src="${subsub.icon_image}" alt="${subsub.name}" loading="lazy">
                                </div>
                            ` : `
                                <div class="category-icon-2025">
                                    <i class="fas fa-star"></i>
                                </div>
                            `}
                            <div class="category-name-2025">${subsub.name}</div>
                        </label>
                    `).join('')).join('')}
                </div>
            ` : `
                <div class="empty-state-2025">
                    <div class="empty-icon-2025">
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="empty-text-2025">No specializations available</p>
                </div>
            `}
        </div>
        <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
            <button type="button" onclick="goBackToSubcategories()" class="btn-secondary-2025">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </button>
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                ${hasSubSubcategories ? `
                    <div class="selection-count-2025">
                        <i class="fas fa-check-circle"></i>
                        <span id="subsub-selected-count">0</span> selected
                    </div>
                ` : ''}
                <button type="button" onclick="saveCategorySelectionMulti()" class="btn-primary-2025">
                    <i class="fas fa-check"></i>
                    <span>Save Selection</span>
                </button>
            </div>
        </div>
    `;
    
    requestAnimationFrame(() => {
        modal.innerHTML = html;
        if (hasSubSubcategories) {
            setupSubSubcategoryListeners();
        }
    });
}

function setupSubSubcategoryListeners() {
    const countDisplay = document.getElementById('subsub-selected-count');
    
    const container = document.getElementById('subsubcategoryStep');
    if (container) {
        container.addEventListener('change', debounce((e) => {
            if (e.target.classList.contains('subsub-category-checkbox')) {
                const selectedCount = document.querySelectorAll('.subsub-category-checkbox:checked').length;
                if (countDisplay) countDisplay.textContent = selectedCount;
            }
        }, 100));
    }
}

function goBackToMainCategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const storedMainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    
    fetch('/api/categories')
        .then(res => res.json())
        .then(data => {
            renderCategoryStep(data);
            setTimeout(() => restoreMainCategorySelections(storedMainCats), 100);
        });
}

function goBackToSubcategories() {
    const modal = document.getElementById('render-selectet-provider-category');
    const storedMainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    const storedSubCats = JSON.parse(modal.dataset.selectedSubCategories || '[]');
    
    if (storedMainCats.length === 0) {
        goBackToMainCategories();
        return;
    }
    
    showLoadingState(modal);
    
    Promise.all(storedMainCats.map(catId =>
        fetch(`/api/categories/${catId}/subcategories`).then(res => res.json().then(data => ({catId, subs: data.subcategories || []})))
    )).then(results => {
        renderSubcategoryStepMulti(storedMainCats, results);
        setTimeout(() => restoreSubcategorySelections(storedSubCats), 100);
    });
}

function restoreMainCategorySelections(selectedIds) {
    selectedIds.forEach(id => {
        const checkbox = document.querySelector(`.main-category-checkbox[value="${id}"]`);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
    
    const selectedCount = selectedIds.length;
    const countDisplay = document.getElementById('selected-count');
    const nextBtn = document.getElementById('next-btn');
    
    if (countDisplay) countDisplay.textContent = selectedCount;
    if (nextBtn) nextBtn.disabled = selectedCount === 0;
}

function restoreSubcategorySelections(selectedIds) {
    selectedIds.forEach(id => {
        const checkbox = document.querySelector(`.sub-category-checkbox[value="${id}"]`);
        if (checkbox) {
            checkbox.checked = true;
        }
    });
    
    const selectedCount = selectedIds.length;
    const countDisplay = document.getElementById('sub-selected-count');
    const nextBtn = document.getElementById('next-sub-btn');
    
    if (countDisplay) countDisplay.textContent = selectedCount;
    if (nextBtn) nextBtn.disabled = selectedCount === 0;
}

function showLoadingState(modal) {
    modal.innerHTML = `
        <div class="empty-state-2025">
            <div class="spinner"></div>
            <p class="empty-text-2025" style="margin-top: 1rem;">Loading categories...</p>
        </div>
    `;
}

function showNotification(message, type = 'info') {
    if (typeof toastr !== 'undefined') {
        toastr[type](message);
    } else {
        alert(message);
    }
}

function saveCategorySelectionMulti() {
    const modal = document.getElementById('render-selectet-provider-category');
    
    const mainCats = JSON.parse(modal.dataset.selectedMainCategories || '[]');
    const subCats = JSON.parse(modal.dataset.selectedSubCategories || '[]');
    const subSubCats = Array.from(modal.querySelectorAll('.subsub-category-checkbox:checked')).map(cb => parseInt(cb.value));
    
    if (mainCats.length === 0) {
        showNotification('Please select at least one category.', 'warning');
        return;
    }
    
    showLoadingState(modal);
    
    fetch('/api/provider/save-categories', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            categories: mainCats,
            subcategories: subCats,
            subsubcategories: subSubCats,
            user_id: {{ $user->id }}
        })
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            showNotification('Categories saved successfully!', 'success');
            closeAllPopups();
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification('Failed to save categories. Please try again.', 'error');
        }
    })
    .catch(error => {
        console.error('Save error:', error);
        showNotification('Network error. Please check your connection and try again.', 'error');
    });
}

function initializeSpecialStatusModal() {
  const openBtn = document.getElementById("openSpecialStatusModal");
  const modal = document.getElementById("specialStatusModal");
  const closeBtn = document.getElementById("closeSpecialStatusModal");

  if (openBtn && modal && closeBtn) {
    openBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openSpecialStatusModal();
    });

    closeBtn.addEventListener("click", () => {
      hideModal("specialStatusModal");
    });
  }
}

document.addEventListener('keydown', function (event) {
  if (event.key === "Escape") {
    closeAllPopups();
  }
});

document.addEventListener('scroll', debounce(() => {
}, 150), { passive: true });
</script>

@endsection