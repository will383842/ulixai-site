<!-- Bottom Navigation Bar - Mobile Only - Optimized 2025/2026 -->
@php
  $unreadMessagesCount = auth()->check()
      ? (method_exists(auth()->user(), 'unreadMessagesCount') ? auth()->user()->unreadMessagesCount() : 0)
      : 0;
  
  // ✅ NOUVEAU - Badge total pour Services
  $totalServiceNotifications = auth()->check()
      ? (method_exists(auth()->user(), 'totalUnreadServiceNotifications') ? auth()->user()->totalUnreadServiceNotifications() : 0)
      : 0;
  
  // Détection de la route active
  $currentRoute = Route::currentRouteName();
@endphp

<style>
    /* ========================================
       NAVIGATION MOBILE OPTIMISÉE 2025/2026
       ======================================== */
    
    /* Container principal - Island Navigation */
    .mobile-nav-2025 {
        position: fixed;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        pointer-events: none;
        max-width: 100vw;
        padding: 0 1rem;
        animation: slideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes slideUp {
        from { transform: translateX(-50%) translateY(80px); opacity: 0; }
        to { transform: translateX(-50%) translateY(0); opacity: 1; }
    }
    
    .mobile-nav-island {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(40px) saturate(180%);
        -webkit-backdrop-filter: blur(40px) saturate(180%);
        border: 1px solid rgba(226, 232, 240, 0.6);
        border-radius: 2rem;
        padding: 0.5rem;
        box-shadow: 
            0 20px 25px -5px rgba(0, 0, 0, 0.08),
            0 10px 10px -5px rgba(0, 0, 0, 0.04),
            0 0 0 1px rgba(14, 165, 233, 0.05);
        pointer-events: auto;
        display: flex;
        gap: 0.25rem;
        align-items: center;
        justify-content: center;
        will-change: transform;
        transform: translateZ(0);
    }
    
    /* Item de navigation */
    .nav-item-2025 {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        border-radius: 1.25rem;
        color: #64748b;
        text-decoration: none;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        user-select: none;
        min-width: 68px;
    }
    
    .nav-item-2025:active {
        transform: scale(0.88);
    }
    
    /* État actif */
    .nav-item-2025.active {
        background: linear-gradient(135deg, 
            rgba(14, 165, 233, 0.12) 0%, 
            rgba(6, 182, 212, 0.12) 100%);
        color: #0ea5e9;
    }
    
    /* Icônes */
    .nav-icon-2025 {
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
    }
    
    .nav-item-2025.active .nav-icon-2025 {
        transform: scale(1.15) translateY(-1px);
        filter: drop-shadow(0 4px 12px rgba(14, 165, 233, 0.4));
    }
    
    /* Labels */
    .nav-label-2025 {
        font-size: 0.625rem;
        font-weight: 500;
        letter-spacing: 0.03em;
        transition: font-weight 0.3s ease;
        opacity: 0.8;
    }
    
    .nav-item-2025.active .nav-label-2025 {
        font-weight: 700;
        opacity: 1;
    }
    
    /* Badge notifications */
    .badge-2025 {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        font-size: 0.625rem;
        font-weight: 800;
        padding: 0.125rem 0.375rem;
        border-radius: 9999px;
        min-width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 
            0 4px 12px rgba(239, 68, 68, 0.5),
            0 0 0 3px rgba(255, 255, 255, 0.3);
        animation: badgePulse 2.5s ease-in-out infinite;
        z-index: 10;
    }
    
    /* Cache le badge quand count = 0 */
    .badge-2025[data-count="0"] {
        display: none !important;
    }
    
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Ripple effect au tap */
    .nav-item-2025::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 1.25rem;
        background: radial-gradient(circle, rgba(14, 165, 233, 0.3) 0%, transparent 70%);
        transform: scale(0);
        opacity: 0;
        pointer-events: none;
        transition: all 0.5s ease;
    }
    
    .nav-item-2025:active::before {
        transform: scale(2.5);
        opacity: 1;
        transition: all 0s;
    }
    
    /* Safe Area pour iPhone */
    @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .mobile-nav-2025 {
            bottom: calc(1rem + env(safe-area-inset-bottom));
        }
    }
    
    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .mobile-nav-2025,
        .nav-item-2025,
        .nav-icon-2025,
        .badge-2025 {
            animation: none !important;
            transition: none !important;
        }
        .nav-item-2025:active {
            transform: scale(0.95);
        }
    }
    
    /* Responsive ultra-small screens */
    @media (max-width: 360px) {
        .nav-item-2025 {
            padding: 0.625rem 0.75rem;
            min-width: 60px;
        }
        .nav-icon-2025 {
            font-size: 1.125rem;
        }
        .nav-label-2025 {
            font-size: 0.5625rem;
        }
    }
    
    /* Hover sur desktop */
    @media (hover: hover) and (min-width: 1024px) {
        .nav-item-2025:hover {
            background: rgba(14, 165, 233, 0.08);
            transform: translateY(-2px);
        }
        .nav-item-2025:hover .nav-icon-2025 {
            transform: scale(1.1);
        }
    }
    
    /* Cache sur desktop */
    @media (min-width: 1024px) {
        .mobile-nav-2025 {
            display: none;
        }
    }
    
    /* Performance optimizations */
    .mobile-nav-island,
    .nav-item-2025,
    .nav-icon-2025 {
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
</style>

<nav class="mobile-nav-2025" id="mobileNav2025" aria-label="Navigation mobile principale">
    <div class="mobile-nav-island" role="navigation">
        
        <!-- Mon compte -->
        <a href="{{ route('user.account') }}" 
           class="nav-item-2025 {{ $currentRoute === 'user.account' ? 'active' : '' }}"
           aria-label="Mon compte"
           data-nav="account">
            <div class="nav-icon-2025">
                <i class="fas fa-user"></i>
            </div>
            <span class="nav-label-2025">Account</span>
        </a>

        <!-- ✅ Services AVEC BADGE TOTAL -->
        <a href="{{ route('user.service.requests') }}" 
           class="nav-item-2025 {{ in_array($currentRoute, ['user.service.requests', 'user.service.show']) ? 'active' : '' }}"
           aria-label="Services"
           data-nav="services">
            <div class="nav-icon-2025">
                <i class="fas fa-briefcase"></i>
            </div>
            <span class="nav-label-2025">Services</span>
            {{-- ✅ Badge TOTAL (propositions + messages publics) --}}
            <span class="badge-2025" 
                  id="servicesBadge2025" 
                  data-count="{{ $totalServiceNotifications }}"
                  role="status" 
                  aria-live="polite">
                {{ $totalServiceNotifications > 99 ? '99+' : $totalServiceNotifications }}
            </span>
        </a>

        <!-- Job (seulement pour providers) -->
        @if(auth()->user()->user_role == 'service_provider')
            <a href="{{ route('user.joblist') }}" 
               class="nav-item-2025 {{ in_array($currentRoute, ['user.joblist', 'user.job.show']) ? 'active' : '' }}"
               aria-label="Emplois"
               data-nav="job">
                <div class="nav-icon-2025">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="nav-label-2025">Job</span>
            </a>
        @endif

        <!-- Payments -->
        <a href="{{ route('user.payments.validate') }}" 
           class="nav-item-2025 {{ $currentRoute === 'user.payments.validate' ? 'active' : '' }}"
           aria-label="Paiements"
           data-nav="payments">
            <div class="nav-icon-2025">
                <i class="fas fa-credit-card"></i>
            </div>
            <span class="nav-label-2025">Payments</span>
        </a>

        <!-- Messages privés -->
        <a href="{{ route('user.conversation') }}" 
           class="nav-item-2025 {{ in_array($currentRoute, ['user.conversation', 'user.conversation.show']) ? 'active' : '' }}"
           aria-label="Messages"
           data-nav="messages">
            <div class="nav-icon-2025">
                <i class="fas fa-comment-dots"></i>
            </div>
            <span class="nav-label-2025">Messages</span>
            {{-- Badge messages privés --}}
            <span class="badge-2025" 
                  id="mobileBadge2025" 
                  data-count="{{ $unreadMessagesCount }}"
                  role="status" 
                  aria-live="polite">
                {{ $unreadMessagesCount > 99 ? '99+' : $unreadMessagesCount }}
            </span>
        </a>

    </div>
</nav>

<script>
(function() {
    'use strict';
    
    const nav = document.getElementById('mobileNav2025');
    if (!nav) return;
    
    // Haptic basique
    const haptic = {
        trigger(duration = 10) {
            if ('vibrate' in navigator) {
                navigator.vibrate(duration);
            }
        }
    };
    
    // Feedback sur tap
    const navItems = document.querySelectorAll('.nav-item-2025');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            haptic.trigger(item.classList.contains('active') ? 8 : 12);
        });
    });
    
    // ✅ Update badges en temps réel
    @if(auth()->check())
    if (typeof window.Echo !== 'undefined') {
        // Badge messages privés
        window.Echo.channel('notify-user-{{ auth()->id() }}')
            .listen('NotifyUser', function(data) {
                if (data.type === 'message') {
                    const badge = document.getElementById('mobileBadge2025');
                    if (badge) {
                        const currentCount = parseInt(badge.dataset.count || "0", 10);
                        const newCount = currentCount + 1;
                        badge.dataset.count = newCount;
                        badge.textContent = newCount > 99 ? '99+' : newCount;
                        haptic.trigger(15);
                    }
                }
            });

        // ✅ NOUVEAU - Badge services (propositions + messages publics)
        window.Echo.channel('notify-user-{{ auth()->id() }}')
            .listen('.MissionMessageReceived', function(data) {
                const badge = document.getElementById('servicesBadge2025');
                if (badge) {
                    const currentCount = parseInt(badge.dataset.count || "0", 10);
                    const newCount = currentCount + 1;
                    badge.dataset.count = newCount;
                    badge.textContent = newCount > 99 ? '99+' : newCount;
                    haptic.trigger(15);
                }
            });
    }
    @endif
    
    console.log('✅ Mobile nav avec badges totaux initialisée');
})();
</script>