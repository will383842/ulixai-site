{{-- Cancel Service Request Modal Component --}}

<style>
    /* MODAL SYSTEM - MOBILE FIRST */
    .cancel-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    .cancel-modal-overlay.show {
        display: flex;
        animation: fadeIn 0.2s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .cancel-modal-content {
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        -webkit-overflow-scrolling: touch;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .cancel-modal-header {
        padding: 1.25rem 1rem;
        border-bottom: 2px solid #e5e7eb;
        position: relative;
    }
    
    .cancel-modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        text-align: center;
        padding-right: 2.5rem;
        line-height: 1.3;
    }
    
    .cancel-modal-close {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 1.5rem;
        line-height: 1;
        touch-action: manipulation;
    }
    
    .cancel-modal-close:hover,
    .cancel-modal-close:focus {
        background: #f1f5f9;
        color: #0f172a;
        transform: rotate(90deg);
    }
    
    .cancel-modal-close:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .cancel-modal-close:active {
        transform: scale(0.95);
    }
    
    .cancel-modal-body {
        padding: 1.25rem 1rem;
    }
    
    .cancel-form-group {
        margin-bottom: 1rem;
    }
    
    .cancel-form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }
    
    .cancel-form-select,
    .cancel-form-textarea {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 0.75rem;
        transition: all 0.2s ease;
        font-family: inherit;
        background: white;
    }
    
    .cancel-form-select:focus,
    .cancel-form-textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .cancel-form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }
    
    .cancel-form-textarea {
        resize: vertical;
        min-height: 80px;
    }
    
    .cancel-form-hint {
        font-size: 0.6875rem;
        color: #64748b;
        margin-top: 0.375rem;
    }
    
    .cancel-modal-footer {
        padding: 1rem;
        border-top: 2px solid #e5e7eb;
        display: flex;
        flex-direction: column-reverse;
        gap: 0.75rem;
    }
    
    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        width: 100%;
        touch-action: manipulation;
    }
    
    .cancel-btn:focus {
        outline: 3px solid rgba(37, 99, 235, 0.5);
        outline-offset: 2px;
    }
    
    .cancel-btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    
    .cancel-btn-primary:hover,
    .cancel-btn-primary:focus {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
    }
    
    .cancel-btn-primary:active {
        transform: translateY(0);
    }
    
    .cancel-btn-text {
        background: transparent;
        color: #2563eb;
        border: none;
        text-decoration: underline;
        padding: 0.5rem 1rem;
    }
    
    .cancel-btn-text:hover,
    .cancel-btn-text:focus {
        color: #1d4ed8;
    }
    
    /* SUCCESS MODAL */
    .success-modal-content {
        text-align: center;
        padding: 1.75rem 1rem;
    }
    
    .success-icon-wrapper {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .success-icon {
        width: 2rem;
        height: 2rem;
        color: white;
        stroke-width: 3;
    }
    
    .success-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.625rem;
    }
    
    .success-text {
        font-size: 0.8125rem;
        color: #64748b;
        font-weight: 600;
    }
    
    /* LOADING MODAL */
    .loading-modal-content {
        text-align: center;
        padding: 1.75rem 1rem;
    }
    
    .loading-spinner {
        width: 56px;
        height: 56px;
        border: 4px solid #e5e7eb;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1.25rem;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .loading-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }
    
    .loading-text {
        font-size: 0.8125rem;
        color: #64748b;
        font-weight: 600;
    }
    
    /* ERROR MESSAGE */
    .cancel-error-message {
        background: #fef2f2;
        border: 2px solid #fca5a5;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        display: none;
    }
    
    .cancel-error-message.visible {
        display: block;
    }
    
    .cancel-error-text {
        color: #dc2626;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .cancel-error-icon {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
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
    
    /* RESPONSIVE - SMALL TABLET (640px) */
    @media (min-width: 640px) {
        .cancel-modal-content {
            border-radius: 1.75rem;
        }
        
        .cancel-modal-header {
            padding: 1.75rem 1.5rem;
        }
        
        .cancel-modal-title {
            font-size: 1.25rem;
        }
        
        .cancel-modal-close {
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            font-size: 1.75rem;
        }
        
        .cancel-modal-body {
            padding: 1.75rem 1.5rem;
        }
        
        .cancel-form-group {
            margin-bottom: 1.25rem;
        }
        
        .cancel-form-label {
            font-size: 0.875rem;
        }
        
        .cancel-form-select,
        .cancel-form-textarea {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        
        .cancel-form-textarea {
            min-height: 100px;
        }
        
        .cancel-form-hint {
            font-size: 0.75rem;
        }
        
        .cancel-modal-footer {
            padding: 1.5rem;
            flex-direction: row;
            justify-content: space-between;
        }
        
        .cancel-btn {
            font-size: 0.875rem;
            padding: 0.875rem 1.5rem;
            width: auto;
            flex: 1;
        }
        
        .cancel-btn-text {
            flex: 0;
            width: auto;
        }
        
        .success-modal-content,
        .loading-modal-content {
            padding: 2.5rem 1.5rem;
        }
        
        .success-icon-wrapper {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
        }
        
        .success-icon {
            width: 2.5rem;
            height: 2.5rem;
        }
        
        .success-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
        
        .success-text {
            font-size: 0.9375rem;
        }
        
        .loading-spinner {
            width: 64px;
            height: 64px;
            margin-bottom: 1.5rem;
        }
        
        .loading-title {
            font-size: 1.125rem;
        }
        
        .loading-text {
            font-size: 0.9375rem;
        }
        
        .cancel-error-message {
            padding: 0.875rem 1.25rem;
        }
        
        .cancel-error-text {
            font-size: 0.875rem;
        }
        
        .cancel-error-icon {
            width: 1.125rem;
            height: 1.125rem;
        }
    }
    
    /* RESPONSIVE - DESKTOP (1024px) */
    @media (min-width: 1024px) {
        .cancel-modal-header {
            padding: 2rem;
        }
        
        .cancel-modal-body {
            padding: 2rem;
        }
        
        .cancel-modal-footer {
            padding: 1.5rem 2rem;
        }
        
        .success-modal-content,
        .loading-modal-content {
            padding: 2.5rem 2rem;
        }
        
        .success-icon-wrapper {
            width: 90px;
            height: 90px;
        }
        
        .success-icon {
            width: 3rem;
            height: 3rem;
        }
    }
    
    /* REDUCED MOTION */
    @media (prefers-reduced-motion: reduce) {
        .cancel-modal-overlay,
        .cancel-modal-content,
        .success-icon-wrapper,
        .loading-spinner,
        .cancel-btn,
        .cancel-modal-close {
            animation: none !important;
            transition: none !important;
        }
    }
    
    /* SAFE AREA SUPPORT */
    @supports (padding: max(0px)) {
        .cancel-modal-content {
            padding-left: max(0px, env(safe-area-inset-left));
            padding-right: max(0px, env(safe-area-inset-right));
            padding-bottom: max(0px, env(safe-area-inset-bottom));
        }
    }
</style>

{{-- Cancel Request Modal --}}
<aside class="cancel-modal-overlay" 
       id="cancelRequestPopup" 
       role="dialog" 
       aria-labelledby="cancelModalTitle" 
       aria-modal="true">
    <div class="cancel-modal-content" role="document">
        
        <div class="cancel-modal-header">
            <h2 class="cancel-modal-title" id="cancelModalTitle">
                Why do you want to cancel this ad?
            </h2>
            <button type="button" 
                    class="cancel-modal-close" 
                    onclick="closeCancelRequestPopup()" 
                    aria-label="Close modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <form id="cancelRequestForm" class="cancel-modal-body">
            
            <div id="cancelErrorMessage" 
                 class="cancel-error-message" 
                 role="alert" 
                 aria-live="assertive">
                <div class="cancel-error-text">
                    <svg class="cancel-error-icon" 
                         fill="currentColor" 
                         viewBox="0 0 20 20"
                         aria-hidden="true">
                        <path fill-rule="evenodd" 
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" 
                              clip-rule="evenodd"/>
                    </svg>
                    <span id="cancelErrorText"></span>
                </div>
            </div>
            
            <div class="cancel-form-group">
                <label for="cancelReasonSelect" class="cancel-form-label">
                    Select a reason <span style="color: #ef4444;" aria-label="required">*</span>
                </label>
                <select id="cancelReasonSelect" 
                        class="cancel-form-select" 
                        required 
                        aria-required="true">
                    <option value="">-- Please choose --</option>
                    <option>I made a mistake in the information provided.</option>
                    <option>My situation has changed, I no longer need the service.</option>
                    <option>I found a solution elsewhere.</option>
                    <option>The timing is too short to organize this mission.</option>
                    <option>My budget is not sufficient for the type of service I need.</option>
                    <option>I didn't receive any relevant proposals.</option>
                    <option>The available providers do not match my criteria.</option>
                    <option>I've decided to postpone this request.</option>
                    <option>I submitted this request just to test the platform.</option>
                    <option value="other">Other reason (please specify below)</option>
                </select>
            </div>
            
            <div class="cancel-form-group">
                <label for="cancelOtherReason" class="cancel-form-label">
                    Other reason (please specify):
                </label>
                <textarea id="cancelOtherReason" 
                          class="cancel-form-textarea" 
                          maxlength="300" 
                          placeholder="Free text field"
                          aria-describedby="cancelHint"></textarea>
                <p class="cancel-form-hint" id="cancelHint">
                    Maximum 300 characters
                </p>
            </div>
            
        </form>
        
        <div class="cancel-modal-footer">
            <button type="button" 
                    class="cancel-btn cancel-btn-text" 
                    onclick="closeCancelRequestPopup()"
                    aria-label="Keep request online">
                I keep my ad online
            </button>
            
            <button type="submit" 
                    form="cancelRequestForm"
                    class="cancel-btn cancel-btn-primary"
                    aria-label="Confirm cancellation">
                <span>I CANCEL</span>
            </button>
        </div>
        
    </div>
</aside>

{{-- Success Modal --}}
<aside class="cancel-modal-overlay" 
       id="cancelSuccessPopup" 
       role="dialog" 
       aria-labelledby="successModalTitle" 
       aria-modal="true">
    <div class="cancel-modal-content" role="document">
        <div class="success-modal-content">
            
            <div class="success-icon-wrapper" aria-hidden="true">
                <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <h2 class="success-title" id="successModalTitle">Thank you!</h2>
            <p class="success-text">Your ad has been successfully deleted.</p>
            
        </div>
    </div>
</aside>

{{-- Loading Modal --}}
<aside class="cancel-modal-overlay" 
       id="loadingPopup" 
       role="alert" 
       aria-live="assertive" 
       aria-busy="true">
    <div class="cancel-modal-content" role="document">
        <div class="loading-modal-content">
            
            <div class="loading-spinner" aria-hidden="true"></div>
            
            <h2 class="loading-title">Canceling...</h2>
            <p class="loading-text">Please wait while we process your request.</p>
            
        </div>
    </div>
</aside>

<script>
(function() {
    'use strict';
    
    let currentMissionId = null;
    
    // Show error message
    function showErrorMessage(message) {
        const errorDiv = document.getElementById('cancelErrorMessage');
        const errorText = document.getElementById('cancelErrorText');
        
        if (errorDiv && errorText) {
            errorText.textContent = message;
            errorDiv.classList.add('visible');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorDiv.classList.remove('visible');
            }, 5000);
        }
        
        // Also use toastr if available
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        }
    }
    
    // Hide error message
    function hideErrorMessage() {
        const errorDiv = document.getElementById('cancelErrorMessage');
        if (errorDiv) {
            errorDiv.classList.remove('visible');
        }
    }
    
    // Open cancel request popup
    function openCancelRequestPopup(missionId) {
        currentMissionId = missionId;
        const popup = document.getElementById('cancelRequestPopup');
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        // Hide any existing error
        hideErrorMessage();
        
        // Focus first form element
        setTimeout(() => {
            document.getElementById('cancelReasonSelect').focus();
        }, 100);
    }
    
    // Close cancel request popup
    function closeCancelRequestPopup() {
        const popup = document.getElementById('cancelRequestPopup');
        popup.classList.remove('show');
        document.body.style.overflow = '';
        currentMissionId = null;
        
        // Reset form
        document.getElementById('cancelRequestForm').reset();
        hideErrorMessage();
    }
    
    // Open success popup
    function openCancelSuccessPopup() {
        const popup = document.getElementById('cancelSuccessPopup');
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        // Auto-close after 3 seconds and reload
        setTimeout(function() {
            closeCancelSuccessPopup();
            window.location.reload();
        }, 3000);
    }
    
    // Close success popup
    function closeCancelSuccessPopup() {
        const popup = document.getElementById('cancelSuccessPopup');
        popup.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Open loading popup
    function openLoadingPopup() {
        const popup = document.getElementById('loadingPopup');
        popup.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Close loading popup
    function closeLoadingPopup() {
        const popup = document.getElementById('loadingPopup');
        popup.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Make functions global
    window.openCancelRequestPopup = openCancelRequestPopup;
    window.closeCancelRequestPopup = closeCancelRequestPopup;
    window.openCancelSuccessPopup = openCancelSuccessPopup;
    window.closeCancelSuccessPopup = closeCancelSuccessPopup;
    window.openLoadingPopup = openLoadingPopup;
    window.closeLoadingPopup = closeLoadingPopup;
    
    // Close modal on overlay click
    document.getElementById('cancelRequestPopup').addEventListener('click', function(e) {
        if (e.target === this) closeCancelRequestPopup();
    });
    
    document.getElementById('cancelSuccessPopup').addEventListener('click', function(e) {
        if (e.target === this) closeCancelSuccessPopup();
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cancelPopup = document.getElementById('cancelRequestPopup');
            const successPopup = document.getElementById('cancelSuccessPopup');
            
            if (cancelPopup.classList.contains('show')) {
                closeCancelRequestPopup();
            } else if (successPopup.classList.contains('show')) {
                closeCancelSuccessPopup();
            }
        }
    });
    
    // Form submission handler
    document.getElementById('cancelRequestForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const reason = document.getElementById('cancelReasonSelect').value;
        const otherReason = document.getElementById('cancelOtherReason').value;
        
        // Validation
        if (!reason) {
            showErrorMessage('Please select a reason for canceling.');
            document.getElementById('cancelReasonSelect').focus();
            return;
        }
        
        if (reason === 'other' && !otherReason.trim()) {
            showErrorMessage('Please specify the other reason.');
            document.getElementById('cancelOtherReason').focus();
            return;
        }
        
        // Close cancel popup and show loading
        closeCancelRequestPopup();
        openLoadingPopup();
        
        // Call API
        deleteMission(currentMissionId, reason, otherReason);
    });
    
    // API call to delete mission
    async function deleteMission(missionId, reason, otherReason) {
        try {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
            
            const response = await fetch('/api/mission/cancel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    mission_id: missionId,
                    reason: reason,
                    description: reason === 'other' ? otherReason : null,
                    cancelled_by: 'requester',
                    cancelled_on: new Date().toISOString()
                })
            });
            
            if (response.ok) {
                currentMissionId = null;
                closeLoadingPopup();
                openCancelSuccessPopup();
            } else {
                throw new Error('Failed to cancel mission');
            }
            
        } catch (error) {
            console.error('Error canceling mission:', error);
            closeLoadingPopup();
            
            // Show error with toastr and inline message
            const errorMessage = 'An error occurred while canceling the mission. Please try again.';
            
            if (typeof toastr !== 'undefined') {
                toastr.error(errorMessage);
            }
            
            // Reopen cancel modal with error
            openCancelRequestPopup(missionId);
            showErrorMessage(errorMessage);
        }
    }
    
})();
</script>