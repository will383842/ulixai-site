{{-- Social Media Share Card - VERSION CORRIGÉE 2025 - Compatible provider-details.blade.php --}}

<!-- ========== STYLES SCOPÉS ========== -->
<style>
/* SCOPE COMPLET pour éviter TOUS conflits avec provider-details.blade.php */
.social-viral-wrapper * {
    box-sizing: border-box;
}

/* Banner viral - z-index INFÉRIEUR à provider-details modal (10000) */
.social-viral-banner {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 5000; /* INFÉRIEUR à 10000 du modal profile */
    background: linear-gradient(90deg, #34D399 0%, #10B981 50%, #14B8A6 100%);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.social-viral-banner.hidden {
    transform: translateY(-100%);
}

.social-viral-banner-content {
    max-width: 80rem;
    margin: 0 auto;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
}

.social-viral-banner-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    min-width: 0;
}

.social-viral-banner-icon {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    border-radius: 9999px;
    padding: 0.5rem;
    flex-shrink: 0;
    animation: social-pulse 2s infinite;
}

@keyframes social-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.social-viral-banner-text {
    flex: 1;
    min-width: 0;
}

.social-viral-banner-title {
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    line-height: 1.25;
    margin: 0;
}

.social-viral-banner-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.75rem;
    margin: 0;
}

.social-viral-banner-btn {
    background: white;
    color: #10B981;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 0.875rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.social-viral-banner-btn:hover {
    background: #F0FDF4;
    transform: scale(1.05);
}

.social-viral-banner-close {
    color: rgba(255, 255, 255, 0.8);
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    flex-shrink: 0;
    transition: color 0.2s;
}

.social-viral-banner-close:hover {
    color: white;
}

/* Spacer pour banner */
.social-viral-spacer {
    height: 64px;
}

/* Card principale */
.social-viral-card-wrapper {
    max-width: 80rem;
    margin: 1.5rem auto;
    padding: 0 1rem;
}

.social-viral-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(40px);
    border-radius: 1.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(229, 231, 235, 0.5);
    overflow: hidden;
}

/* Header avec shimmer */
.social-viral-header {
    background: linear-gradient(90deg, #EEF2FF 0%, #F3E8FF 50%, #FCE7F3 100%);
    padding: 0.75rem 1rem;
    border-bottom: 1px solid rgba(229, 231, 235, 0.5);
    position: relative;
    overflow: hidden;
}

.social-viral-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: social-shimmer 3s infinite;
    transform: translateX(-100%);
}

@keyframes social-shimmer {
    100% { transform: translateX(100%); }
}

.social-viral-header-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    z-index: 1;
}

.social-viral-header-icon {
    background: linear-gradient(135deg, #3B82F6 0%, #9333EA 100%);
    border-radius: 0.75rem;
    padding: 0.375rem;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    flex-shrink: 0;
}

.social-viral-header-text {
    min-width: 0;
    flex: 1;
}

.social-viral-header-title {
    font-size: 0.75rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.25;
    margin: 0;
}

.social-viral-header-code {
    display: none;
    align-items: center;
    gap: 0.375rem;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(8px);
    padding: 0.375rem 0.625rem;
    border-radius: 9999px;
    border: 1px solid rgba(229, 231, 235, 0.5);
    flex-shrink: 0;
}

.social-viral-header-code-label {
    font-size: 0.625rem;
    color: #6B7280;
    font-weight: 500;
}

.social-viral-header-code-value {
    font-size: 0.625rem;
    font-weight: 700;
    color: #3B82F6;
}

/* Grid boutons */
.social-viral-buttons {
    padding: 0.875rem;
}

.social-viral-buttons-mobile {
    display: block;
}

.social-viral-buttons-desktop {
    display: none;
}

.social-viral-grid-top {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.625rem;
    margin-bottom: 0.625rem;
}

.social-viral-scroll-container {
    position: relative;
}

.social-viral-scroll-wrapper {
    display: flex;
    overflow-x: auto;
    gap: 0.625rem;
    padding-bottom: 0.25rem;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.social-viral-scroll-wrapper::-webkit-scrollbar {
    display: none;
}

.social-viral-scroll-indicator {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 2rem;
    background: linear-gradient(to left, rgba(255, 255, 255, 0.8), transparent);
    pointer-events: none;
    border-radius: 0 0.75rem 0.75rem 0;
}

/* Bouton social */
.social-viral-btn {
    background: linear-gradient(135deg, var(--from-color), var(--to-color));
    border-radius: 0.75rem;
    padding: 0.875rem;
    border: 2px solid var(--border-color);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    transition: all 0.15s ease;
    touch-action: manipulation;
    cursor: pointer;
    flex-shrink: 0;
    width: 7rem;
    scroll-snap-align: center;
}

.social-viral-btn:active {
    transform: scale(0.95);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.social-viral-btn i {
    font-size: 1.875rem;
    pointer-events: none;
}

.social-viral-btn span {
    font-size: 0.6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    line-height: 1.2;
    pointer-events: none;
}

/* Couleurs des boutons */
.social-viral-btn.whatsapp {
    --from-color: #F0FDF4;
    --to-color: #D1FAE5;
    --border-color: #86EFAC;
}
.social-viral-btn.whatsapp i { color: #16A34A; }
.social-viral-btn.whatsapp span { color: #15803D; }
.social-viral-btn.whatsapp:active {
    --from-color: #16A34A;
    --to-color: #15803D;
    --border-color: #16A34A;
}
.social-viral-btn.whatsapp:active i,
.social-viral-btn.whatsapp:active span { color: white; }

.social-viral-btn.messenger {
    --from-color: #EFF6FF;
    --to-color: #DBEAFE;
    --border-color: #93C5FD;
}
.social-viral-btn.messenger i { color: #3B82F6; }
.social-viral-btn.messenger span { color: #1D4ED8; }
.social-viral-btn.messenger:active {
    --from-color: #3B82F6;
    --to-color: #2563EB;
    --border-color: #3B82F6;
}
.social-viral-btn.messenger:active i,
.social-viral-btn.messenger:active span { color: white; }

.social-viral-btn.facebook {
    --from-color: #EFF6FF;
    --to-color: #DBEAFE;
    --border-color: #93C5FD;
}
.social-viral-btn.facebook i { color: #1D4ED8; }
.social-viral-btn.facebook span { color: #1E40AF; }
.social-viral-btn.facebook:active {
    --from-color: #1D4ED8;
    --to-color: #1E40AF;
    --border-color: #1D4ED8;
}
.social-viral-btn.facebook:active i,
.social-viral-btn.facebook:active span { color: white; }

.social-viral-btn.twitter {
    --from-color: #F9FAFB;
    --to-color: #F3F4F6;
    --border-color: #D1D5DB;
}
.social-viral-btn.twitter i { color: #1F2937; }
.social-viral-btn.twitter span { color: #374151; }
.social-viral-btn.twitter:active {
    --from-color: #1F2937;
    --to-color: #111827;
    --border-color: #1F2937;
}
.social-viral-btn.twitter:active i,
.social-viral-btn.twitter:active span { color: white; }

.social-viral-btn.linkedin {
    --from-color: #EFF6FF;
    --to-color: #DBEAFE;
    --border-color: #93C5FD;
}
.social-viral-btn.linkedin i { color: #1D4ED8; }
.social-viral-btn.linkedin span { color: #1E40AF; }
.social-viral-btn.linkedin:active {
    --from-color: #1D4ED8;
    --to-color: #1E40AF;
    --border-color: #1D4ED8;
}
.social-viral-btn.linkedin:active i,
.social-viral-btn.linkedin:active span { color: white; }

.social-viral-btn.email {
    --from-color: #FEF2F2;
    --to-color: #FEE2E2;
    --border-color: #FCA5A5;
}
.social-viral-btn.email i { color: #DC2626; }
.social-viral-btn.email span { color: #B91C1C; }
.social-viral-btn.email:active {
    --from-color: #DC2626;
    --to-color: #B91C1C;
    --border-color: #DC2626;
}
.social-viral-btn.email:active i,
.social-viral-btn.email:active span { color: white; }

.social-viral-btn.copy {
    --from-color: #FAF5FF;
    --to-color: #F3E8FF;
    --border-color: #D8B4FE;
}
.social-viral-btn.copy i { color: #9333EA; }
.social-viral-btn.copy span { color: #7E22CE; }
.social-viral-btn.copy:active {
    --from-color: #9333EA;
    --to-color: #7E22CE;
    --border-color: #9333EA;
}
.social-viral-btn.copy:active i,
.social-viral-btn.copy:active span { color: white; }

.social-viral-btn.copy.copied {
    --from-color: #16A34A;
    --to-color: #15803D;
    --border-color: #16A34A;
}
.social-viral-btn.copy.copied i,
.social-viral-btn.copy.copied span { color: white; }

/* Footer message */
.social-viral-footer {
    background: linear-gradient(90deg, #F0FDF4 0%, #D1FAE5 50%, #CCFBF1 100%);
    padding: 0.5rem 1rem;
    border-top: 1px solid rgba(229, 231, 235, 0.5);
    position: relative;
    overflow: hidden;
}

.social-viral-footer::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: social-shimmer 3s infinite;
    transform: translateX(-100%);
}

.social-viral-footer-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    color: #15803D;
    position: relative;
    z-index: 1;
}

/* Popup success - z-index TRÈS ÉLEVÉ mais encore inférieur au modal profile */
.social-viral-popup {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    z-index: 9000; /* INFÉRIEUR à 10000 du modal profile */
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.social-viral-popup.show {
    display: flex;
}

.social-viral-popup-content {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-width: 28rem;
    width: 100%;
    padding: 1.5rem;
    transform: scale(0.95);
    opacity: 0;
    transition: all 0.3s;
}

.social-viral-popup.show .social-viral-popup-content {
    transform: scale(1);
    opacity: 1;
}

.social-viral-popup-icon {
    display: inline-block;
    background: linear-gradient(135deg, #34D399 0%, #10B981 100%);
    border-radius: 9999px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    animation: social-bounce 1s infinite;
}

@keyframes social-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.social-viral-popup-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.5rem;
}

.social-viral-popup-text {
    color: #6B7280;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.social-viral-popup-stats {
    background: linear-gradient(135deg, #F0FDF4 0%, #D1FAE5 100%);
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 2px solid #86EFAC;
}

.social-viral-popup-earnings {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.social-viral-popup-earnings-label {
    font-size: 0.875rem;
    color: #6B7280;
}

.social-viral-popup-earnings-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #16A34A;
}

.social-viral-popup-progress {
    height: 0.5rem;
    background: #86EFAC;
    border-radius: 9999px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.social-viral-popup-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #34D399 0%, #10B981 100%);
    border-radius: 9999px;
    width: 60%;
    animation: social-pulse 2s infinite;
}

.social-viral-popup-hint {
    font-size: 0.75rem;
    color: #6B7280;
}

.social-viral-popup-btn {
    width: 100%;
    background: linear-gradient(90deg, #16A34A 0%, #10B981 100%);
    color: white;
    font-weight: 700;
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.social-viral-popup-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
}

.social-viral-popup-close {
    width: 100%;
    background: #F3F4F6;
    color: #374151;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    border-radius: 0.75rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.875rem;
}

.social-viral-popup-close:hover {
    background: #E5E7EB;
}

/* Responsive */
@media (min-width: 640px) {
    .social-viral-banner-title {
        font-size: 1rem;
    }
    .social-viral-banner-subtitle {
        font-size: 0.875rem;
        display: block;
    }
    .social-viral-header-title {
        font-size: 0.875rem;
    }
}

@media (min-width: 1024px) {
    .social-viral-header-code {
        display: flex;
    }
    .social-viral-buttons-mobile {
        display: none;
    }
    .social-viral-buttons-desktop {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
    }
    .social-viral-btn {
        width: auto;
    }
    .social-viral-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    .social-viral-btn:active {
        transform: scale(0.98);
    }
}
</style>

<!-- ========== HTML ========== -->
<div class="social-viral-wrapper">
    
    <!-- Banner Viral -->
    <div id="socialViralBanner" class="social-viral-banner">
        <div class="social-viral-banner-content">
            <div class="social-viral-banner-left">
                <div class="social-viral-banner-icon">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="social-viral-banner-text">
                    <p class="social-viral-banner-title">💰 Share this profile & earn rewards!</p>
                    <p class="social-viral-banner-subtitle">Help your network find great helpers + Get rewarded 🎁</p>
                </div>
            </div>
            <button onclick="SocialViralCard.scrollToShare()" class="social-viral-banner-btn">
                <span>Share</span>
                <span>🚀</span>
            </button>
            <button onclick="SocialViralCard.closeBanner()" class="social-viral-banner-close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Spacer -->
    <div class="social-viral-spacer"></div>
    
    <!-- Card principale -->
    <div class="social-viral-card-wrapper" id="socialShareSection">
        <div class="social-viral-card">
            
            <!-- Header -->
            <div class="social-viral-header">
                <div class="social-viral-header-content">
                    <div class="social-viral-header-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </div>
                    <div class="social-viral-header-text">
                        <h3 class="social-viral-header-title">Share with someone seeking help or wanting to become an expat helper</h3>
                    </div>
                    @auth
                    <div class="social-viral-header-code">
                        <span class="social-viral-header-code-label">Code:</span>
                        <span class="social-viral-header-code-value">{{ Auth::user()->affiliate_code }}</span>
                    </div>
                    @endauth
                </div>
            </div>
            
            <!-- Boutons -->
            <div class="social-viral-buttons">
                
                <!-- Mobile -->
                <div class="social-viral-buttons-mobile">
                    <div class="social-viral-grid-top">
                        <a href="#" id="socialBtnWhatsApp1" class="social-viral-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                        <a href="#" id="socialBtnMessenger1" class="social-viral-btn messenger">
                            <i class="fab fa-facebook-messenger"></i>
                            <span>Messenger</span>
                        </a>
                        <a href="#" id="socialBtnFacebook1" class="social-viral-btn facebook">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="social-viral-scroll-container">
                        <div class="social-viral-scroll-wrapper">
                            <a href="#" id="socialBtnTwitter1" class="social-viral-btn twitter">
                                <i class="fab fa-x-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="#" id="socialBtnLinkedIn1" class="social-viral-btn linkedin">
                                <i class="fab fa-linkedin"></i>
                                <span>LinkedIn</span>
                            </a>
                            <a href="#" id="socialBtnEmail1" class="social-viral-btn email">
                                <i class="fas fa-envelope"></i>
                                <span>Email</span>
                            </a>
                            <button id="socialBtnCopy1" class="social-viral-btn copy">
                                <i class="fas fa-link"></i>
                                <span>Copy</span>
                            </button>
                        </div>
                        <div class="social-viral-scroll-indicator"></div>
                    </div>
                </div>
                
                <!-- Desktop -->
                <div class="social-viral-buttons-desktop">
                    <a href="#" id="socialBtnWhatsApp2" class="social-viral-btn whatsapp">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a href="#" id="socialBtnMessenger2" class="social-viral-btn messenger">
                        <i class="fab fa-facebook-messenger"></i>
                        <span>Messenger</span>
                    </a>
                    <a href="#" id="socialBtnFacebook2" class="social-viral-btn facebook">
                        <i class="fab fa-facebook"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" id="socialBtnTwitter2" class="social-viral-btn twitter">
                        <i class="fab fa-x-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="#" id="socialBtnLinkedIn2" class="social-viral-btn linkedin">
                        <i class="fab fa-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" id="socialBtnEmail2" class="social-viral-btn email">
                        <i class="fas fa-envelope"></i>
                        <span>Email</span>
                    </a>
                    <button id="socialBtnCopy2" class="social-viral-btn copy">
                        <i class="fas fa-link"></i>
                        <span>Copy</span>
                    </button>
                </div>
                
            </div>
            
            <!-- Footer -->
            <div class="social-viral-footer">
                <div class="social-viral-footer-content">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    <span>Earn € or $ for each share</span>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Popup Success -->
    <div id="socialViralPopup" class="social-viral-popup">
        <div class="social-viral-popup-content">
            <div style="text-align: center;">
                <div class="social-viral-popup-icon">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="social-viral-popup-title">Amazing! 🎉</h3>
                <p class="social-viral-popup-text">You're helping someone find the perfect helper!</p>
            </div>
            <div class="social-viral-popup-stats">
                <div class="social-viral-popup-earnings">
                    <span class="social-viral-popup-earnings-label">Your potential earnings:</span>
                    <span class="social-viral-popup-earnings-value">+5€</span>
                </div>
                <div class="social-viral-popup-progress">
                    <div class="social-viral-popup-progress-bar"></div>
                </div>
                <p class="social-viral-popup-hint">Share 2 more times to unlock bonus rewards! 🚀</p>
            </div>
            <button onclick="SocialViralCard.shareAgain()" class="social-viral-popup-btn">
                Share Again & Earn More 💰
            </button>
            <button onclick="SocialViralCard.closePopup()" class="social-viral-popup-close">
                Close
            </button>
        </div>
    </div>
    
</div>

<!-- Hidden affiliate link -->
@auth
<input type="text" id="socialViralAffiliateLink" value="{{ url('/provider/' . ($provider->id ?? '') . '?ref=' . Auth::user()->affiliate_code) }}" hidden>
@else
<input type="text" id="socialViralAffiliateLink" value="{{ url('/provider/' . ($provider->id ?? '')) }}" hidden>
@endauth

<!-- ========== JAVASCRIPT ISOLÉ ========== -->
<script>
// NAMESPACE GLOBAL pour éviter TOUS les conflits
window.SocialViralCard = (function() {
    'use strict';
    
    // ========== BANNER ==========
    function scrollToShare() {
        const section = document.getElementById('socialShareSection');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => {
                section.style.animation = 'social-pulse 1s';
                setTimeout(() => { section.style.animation = ''; }, 1000);
            }, 500);
        }
    }
    
    function closeBanner() {
        const banner = document.getElementById('socialViralBanner');
        if (banner) {
            banner.classList.add('hidden');
            try {
                localStorage.setItem('socialViralBannerClosed', Date.now());
            } catch(e) {}
        }
    }
    
    // Check banner visibility on load
    (function() {
        try {
            const lastClosed = localStorage.getItem('socialViralBannerClosed');
            if (lastClosed) {
                const hoursSinceClosed = (Date.now() - parseInt(lastClosed)) / (1000 * 60 * 60);
                if (hoursSinceClosed < 24) {
                    const banner = document.getElementById('socialViralBanner');
                    if (banner) banner.style.display = 'none';
                }
            }
        } catch(e) {}
    })();
    
    // ========== POPUP ==========
    function showPopup() {
        const popup = document.getElementById('socialViralPopup');
        if (popup) {
            popup.classList.add('show');
        }
    }
    
    function closePopup() {
        const popup = document.getElementById('socialViralPopup');
        if (popup) {
            popup.classList.remove('show');
        }
    }
    
    function shareAgain() {
        closePopup();
        scrollToShare();
    }
    
    // ========== SHARE URL ==========
    function getShareUrl() {
        const input = document.getElementById('socialViralAffiliateLink');
        if (!input) return window.location.href;
        
        let url = input.value;
        try {
            const urlObj = new URL(url, window.location.origin);
            urlObj.searchParams.set('utm_source', 'social');
            urlObj.searchParams.set('utm_medium', 'share');
            urlObj.searchParams.set('utm_campaign', 'referral');
            url = urlObj.toString();
        } catch (e) {}
        
        return url;
    }
    
    // ========== COPY BUTTON ==========
    function setupCopyButton(btnId) {
        const btn = document.getElementById(btnId);
        if (!btn) return;
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = getShareUrl();
            
            navigator.clipboard.writeText(url).then(() => {
                btn.classList.add('copied');
                btn.innerHTML = '<i class="fas fa-check"></i><span>Copied!</span>';
                
                if (typeof toastr !== 'undefined') {
                    toastr.success('✅ Link copied! 🚀');
                }
                
                setTimeout(() => {
                    btn.classList.remove('copied');
                    btn.innerHTML = '<i class="fas fa-link"></i><span>Copy</span>';
                }, 1500);
                
            }).catch(() => {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to copy');
                }
            });
        });
    }
    
    // ========== INIT ==========
    function init() {
        const url = getShareUrl();
        const enc = encodeURIComponent(url);
        const text = encodeURIComponent(`🌟 Found an amazing local/expat helper!\n\n👉 Check their profile:\n\n💡 Need help abroad? Perfect match!\n🚀 Want to help & earn? Join as a helper!\n\nShare this & help your network! 💰`);
        const subject = encodeURIComponent("🎯 Amazing Local/Expat Helper - Check This Out!");
        const emailBody = encodeURIComponent(`Hey! 👋\n\nI found this incredible local/expat helper who might interest you:\n\n${url}\n\nWhether you're:\n✅ Seeking help abroad\n✅ Wanting to become a helper and earn money\n\nCheck out their profile!\n\n---\n💡 TIP: Share this profile with your network and earn rewards! 💰`);
        
        const links = {
            socialBtnWhatsApp1: `https://api.whatsapp.com/send?text=${text}%20${enc}`,
            socialBtnWhatsApp2: `https://api.whatsapp.com/send?text=${text}%20${enc}`,
            socialBtnMessenger1: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
            socialBtnMessenger2: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
            socialBtnFacebook1: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
            socialBtnFacebook2: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
            socialBtnTwitter1: `https://twitter.com/intent/tweet?url=${enc}&text=${text}`,
            socialBtnTwitter2: `https://twitter.com/intent/tweet?url=${enc}&text=${text}`,
            socialBtnLinkedIn1: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
            socialBtnLinkedIn2: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
            socialBtnEmail1: `mailto:?subject=${subject}&body=${emailBody}`,
            socialBtnEmail2: `mailto:?subject=${subject}&body=${emailBody}`
        };
        
        Object.entries(links).forEach(([id, href]) => {
            const el = document.getElementById(id);
            if (el) {
                el.href = href;
                el.target = '_blank';
                el.rel = 'noopener noreferrer';
            }
        });
        
        setupCopyButton('socialBtnCopy1');
        setupCopyButton('socialBtnCopy2');
        
        // Trigger popup après partage
        document.querySelectorAll('[id^="socialBtn"]').forEach(btn => {
            btn.addEventListener('click', function() {
                setTimeout(showPopup, 1000);
            });
        });
    }
    
    // Auto-init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    // Public API
    return {
        scrollToShare,
        closeBanner,
        showPopup,
        closePopup,
        shareAgain
    };
})();
</script>