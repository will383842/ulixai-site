<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-primary-dark: #1d4ed8;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
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
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
        --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    /* DELIVERY MODALS */
    .delivery-modal-overlay-2025 {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .delivery-modal-overlay-2025:not(.hidden) {
        opacity: 1;
        pointer-events: all;
    }
    
    .delivery-modal-content-2025 {
        background: var(--color-bg-primary);
        border-radius: var(--border-radius-2xl);
        box-shadow: var(--shadow-xl);
        max-width: 28rem;
        width: 100%;
        padding: 2rem;
        position: relative;
        text-align: center;
        transform: scale(0.9);
        opacity: 0;
        transition: var(--transition-smooth);
        max-height: 90vh;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .delivery-modal-overlay-2025:not(.hidden) .delivery-modal-content-2025 {
        transform: scale(1);
        opacity: 1;
    }
    
    /* CLOSE BUTTON */
    .delivery-modal-close-2025 {
        position: absolute;
        top: 0.75rem;
        right: 1rem;
        background: none;
        border: none;
        color: #9ca3af;
        font-size: 1.5rem;
        line-height: 1;
        cursor: pointer;
        transition: var(--transition-base);
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        touch-action: manipulation;
    }
    
    .delivery-modal-close-2025:hover,
    .delivery-modal-close-2025:focus {
        color: #374151;
        background: #f3f4f6;
        outline: none;
    }
    
    /* ICON CONTAINER */
    .delivery-icon-container-2025 {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        animation: iconPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes iconPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .delivery-icon-confirm {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    }
    
    .delivery-icon-success {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    }
    
    .delivery-icon-2025 {
        width: 2rem;
        height: 2rem;
    }
    
    /* TITLE */
    .delivery-modal-title-2025 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .delivery-modal-title-large {
        font-size: 1.25rem;
    }
    
    .delivery-emoji {
        width: 1.5rem;
        height: 1.5rem;
        display: inline-block;
        vertical-align: middle;
    }
    
    /* MESSAGE */
    .delivery-modal-message-2025 {
        color: var(--color-text-secondary);
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    
    .delivery-modal-message-2025.hidden {
        display: none;
    }
    
    /* BUTTONS */
    .delivery-modal-actions-2025 {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        align-items: center;
        width: 100%;
    }
    
    .delivery-btn-primary-2025 {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white;
        font-weight: 700;
        font-size: 0.9375rem;
        padding: 0.75rem 2rem;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        text-decoration: none;
        touch-action: manipulation;
        min-width: 200px;
    }
    
    .delivery-btn-primary-2025:hover,
    .delivery-btn-primary-2025:focus {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        outline: none;
    }
    
    .delivery-btn-primary-2025:active {
        transform: translateY(0);
    }
    
    .delivery-btn-secondary-2025 {
        background: transparent;
        color: var(--color-primary);
        font-weight: 700;
        font-size: 0.9375rem;
        padding: 0.75rem 2rem;
        border: 2px solid var(--color-primary-light);
        border-radius: 999px;
        cursor: pointer;
        transition: var(--transition-base);
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        touch-action: manipulation;
        min-width: 200px;
    }
    
    .delivery-btn-secondary-2025:hover,
    .delivery-btn-secondary-2025:focus {
        background: #eff6ff;
        outline: none;
    }
    
    .delivery-btn-secondary-2025:active {
        transform: scale(0.98);
    }
    
    /* BUTTON ICONS */
    .delivery-btn-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }
    
    /* SUCCESS STATE */
    .delivery-success-checkmark {
        width: 2rem;
        height: 2rem;
        color: white;
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
    
    /* RESPONSIVE - TABLET */
    @media (min-width: 640px) {
        .delivery-modal-content-2025 {
            padding: 2.5rem;
        }
        
        .delivery-modal-title-2025 {
            font-size: 1.25rem;
        }
        
        .delivery-modal-title-large {
            font-size: 1.5rem;
        }
        
        .delivery-modal-actions-2025 {
            flex-direction: row;
            justify-content: center;
        }
        
        .delivery-btn-primary-2025,
        .delivery-btn-secondary-2025 {
            min-width: auto;
            flex: 0 1 auto;
        }
    }
    
    /* FOCUS VISIBLE */
    .delivery-modal-close-2025:focus-visible,
    .delivery-btn-primary-2025:focus-visible,
    .delivery-btn-secondary-2025:focus-visible {
        outline: 3px solid var(--color-primary);
        outline-offset: 2px;
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
    
    /* LOADING STATE */
    .delivery-btn-loading {
        opacity: 0.7;
        pointer-events: none;
        position: relative;
    }
    
    .delivery-btn-loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid transparent;
        border-top-color: currentColor;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<!-- Delivery Confirmation Popup (Step 1) -->
<div id="deliveryConfirmPopup" 
     class="delivery-modal-overlay-2025 hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="delivery-confirm-title"
     aria-describedby="delivery-confirm-desc">
    <div class="delivery-modal-content-2025">
        <button onclick="closeDeliveryConfirmPopup()" 
                class="delivery-modal-close-2025"
                aria-label="Close dialog">
            &times;
        </button>
        
        <div class="flex flex-col items-center">
            <div class="delivery-icon-container-2025 delivery-icon-confirm" aria-hidden="true">
                <svg class="delivery-icon-2025 text-blue-500" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="2.5" 
                     viewBox="0 0 24 24">
                    <rect x="5" y="7" width="14" height="10" rx="2" fill="#fff" stroke="#3B82F6"/>
                    <rect x="7" y="5" width="10" height="4" rx="2" fill="#3B82F6"/>
                </svg>
            </div>
            
            <h2 id="delivery-confirm-title" class="delivery-modal-title-2025">
                <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4e6.svg" 
                     class="delivery-emoji" 
                     alt="Package box" 
                     aria-hidden="true" />
                <span>Do you confirm that your mission is completed and delivered?</span>
            </h2>
            
            <p id="message" 
               class="delivery-modal-message-2025 hidden"
               role="status"
               aria-live="polite">
                Your service requester has just received your delivery confirmation.
            </p>
        </div>
        
        <div class="delivery-modal-actions-2025">
            <button onclick="sendDelivery()" 
                    class="delivery-btn-primary-2025"
                    aria-label="Confirm delivery">
                <svg class="delivery-btn-icon" 
                     fill="currentColor" 
                     viewBox="0 0 20 20"
                     aria-hidden="true">
                    <rect x="5" y="9" width="10" height="6" rx="2"/>
                    <rect x="7" y="5" width="6" height="4" rx="2"/>
                </svg>
                <span>YES</span>
            </button>
            
            <button onclick="closeDeliveryConfirmPopup()" 
                    class="delivery-btn-secondary-2025"
                    aria-label="Go back">
                <span>&larr; Back</span>
            </button>
        </div>
    </div>
</div>

<!-- Delivery Sent Popup (Step 2) -->
<div id="deliverySentPopup" 
     class="delivery-modal-overlay-2025 hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="delivery-sent-title"
     aria-describedby="delivery-sent-desc">
    <div class="delivery-modal-content-2025">
        <button onclick="closeDeliverySentPopup()" 
                class="delivery-modal-close-2025"
                aria-label="Close dialog">
            &times;
        </button>
        
        <div class="flex flex-col items-center">
            <div class="delivery-icon-container-2025 delivery-icon-success" aria-hidden="true">
                <svg class="delivery-success-checkmark" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="2.5" 
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          d="M9 12l2 2 4-4"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>
            </div>
            
            <h2 id="delivery-sent-title" class="delivery-modal-title-2025 delivery-modal-title-large">
                <svg class="delivery-emoji" 
                     fill="none" 
                     stroke="#3B82F6" 
                     stroke-width="2.5" 
                     viewBox="0 0 24 24"
                     aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          d="M9 12l2 2 4-4"/>
                </svg>
                <span>Your delivery confirmation has been sent!</span>
                <span class="ml-1">📬</span>
            </h2>
            
            <p id="delivery-sent-desc" class="delivery-modal-message-2025">
                Your service requester has just been notified. They will now be asked to validate the delivery.
            </p>
        </div>
        
        <div class="delivery-modal-actions-2025">
            <a href="/dashboardindex" 
               class="delivery-btn-primary-2025"
               aria-label="Return to dashboard">
                <span>Go back to my dashboard</span>
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // DELIVERY CONFIRMATION SYSTEM
    let currentMissionId = null;
    
    /**
     * Opens the delivery confirmation popup
     * @param {number} missionId - The mission ID to confirm delivery for
     */
    function openDeliveryConfirmPopup(missionId) {
        currentMissionId = missionId;
        const modal = document.getElementById('deliveryConfirmPopup');
        if (modal) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            // Focus management
            setTimeout(() => {
                const firstButton = modal.querySelector('button:not(.delivery-modal-close-2025)');
                if (firstButton) firstButton.focus();
            }, 100);
        }
    }
    
    /**
     * Closes the delivery confirmation popup
     */
    function closeDeliveryConfirmPopup() {
        const modal = document.getElementById('deliveryConfirmPopup');
        if (modal) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            
            // Reset message visibility
            const message = document.getElementById('message');
            if (message) {
                message.classList.add('hidden');
            }
        }
    }
    
    /**
     * Sends the delivery confirmation to the server
     */
    function sendDelivery() {
        if (!currentMissionId) {
            console.error('No mission ID set');
            return;
        }
        
        const button = event.target.closest('button');
        if (button) {
            button.classList.add('delivery-btn-loading');
            button.disabled = true;
        }
        
        fetch('/api/provider/jobs/confirm-delivery', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ mission_id: currentMissionId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success message
                const message = document.getElementById('message');
                if (message) {
                    message.classList.remove('hidden');
                }
                
                // Reload page after short delay
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                // Show error
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message || 'Failed to confirm delivery');
                } else {
                    alert('Error: ' + (data.message || 'Failed to confirm delivery'));
                }
                
                // Re-enable button
                if (button) {
                    button.classList.remove('delivery-btn-loading');
                    button.disabled = false;
                }
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            
            if (typeof toastr !== 'undefined') {
                toastr.error('Failed to confirm delivery. Please try again.');
            } else {
                alert('Failed to confirm delivery. Please try again.');
            }
            
            // Re-enable button
            if (button) {
                button.classList.remove('delivery-btn-loading');
                button.disabled = false;
            }
        });
    }
    
    /**
     * Closes the delivery sent confirmation popup
     */
    function closeDeliverySentPopup() {
        const modal = document.getElementById('deliverySentPopup');
        if (modal) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
    
    // MODAL INTERACTIONS
    // Close on click outside
    document.getElementById('deliveryConfirmPopup')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeliveryConfirmPopup();
        }
    });
    
    document.getElementById('deliverySentPopup')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeliverySentPopup();
        }
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeliveryConfirmPopup();
            closeDeliverySentPopup();
        }
    });
    
    // EXPOSE FUNCTIONS GLOBALLY
    window.openDeliveryConfirmPopup = openDeliveryConfirmPopup;
    window.closeDeliveryConfirmPopup = closeDeliveryConfirmPopup;
    window.sendDelivery = sendDelivery;
    window.closeDeliverySentPopup = closeDeliverySentPopup;
    
})();
</script>