{{-- ═══════════════════════════════════════════════════════════
     🎯 SIDEBAR DASHBOARD COMPLET - AVEC BADGES TOTAUX
     ═══════════════════════════════════════════════════════════ --}}

<style>
/* ========================================
   SIDEBAR OPTIMISÉE 2025/2026
   ======================================== */

/* Sidebar transition avec spring */
.sidebar-transition {
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Overlay avec backdrop blur */
#sidebar-overlay {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Sidebar container */
#sidebar {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
}

/* Nav links avec effet moderne */
.nav-link {
    position: relative;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.nav-link:hover {
    transform: translateX(4px);
}

.nav-link:active {
    transform: translateX(2px) scale(0.98);
}

/* État actif avec gradient subtil */
.nav-link.active,
.nav-link.text-blue-600 {
    background: linear-gradient(135deg, 
        rgba(14, 165, 233, 0.12) 0%, 
        rgba(6, 182, 212, 0.12) 100%) !important;
    color: #0ea5e9 !important;
    font-weight: 600;
}

/* Badge notifications moderne */
.notification-badge-sidebar {
    position: absolute !important;
    top: -8px !important;
    right: -8px !important;
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
        0 0 0 2px rgba(255, 255, 255, 1);
    animation: badgePulse 2.5s ease-in-out infinite;
    z-index: 10;
}

/* Cache le badge quand count = 0 */
.notification-badge-sidebar[data-value="0"] {
    display: none !important;
}

@keyframes badgePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Promo card moderne avec glassmorphism */
.promo-card-modern {
    background: linear-gradient(135deg, 
        rgba(236, 72, 153, 0.95) 0%, 
        rgba(251, 146, 60, 0.95) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.promo-card-modern:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.4);
}

.promo-card-modern:active {
    transform: translateY(-2px) scale(1);
}

/* Close button moderne */
#close-sidebar {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

#close-sidebar:hover {
    transform: rotate(90deg) scale(1.1);
    background-color: rgba(239, 68, 68, 0.1);
}

#close-sidebar:active {
    transform: rotate(90deg) scale(0.95);
}

/* Logout button moderne */
.logout-button-modern {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
}

.logout-button-modern::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.logout-button-modern:hover::before {
    opacity: 1;
}

.logout-button-modern:hover {
    color: white;
    border-color: #ef4444;
    transform: translateY(-2px);
    box-shadow: 0 8px 12px -2px rgba(239, 68, 68, 0.3);
}

.logout-button-modern:active {
    transform: translateY(0);
}

.logout-button-modern span {
    position: relative;
    z-index: 1;
}

/* Avatar avec border moderne */
.avatar-container {
    border: 3px solid transparent;
    background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%) border-box;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    flex-shrink: 0;
}

.avatar-container:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px -4px rgba(14, 165, 233, 0.4);
}

/* Icon avec animation au hover */
.nav-link i {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.nav-link:hover i {
    transform: scale(1.1);
}

.nav-link.active i {
    filter: drop-shadow(0 2px 4px rgba(14, 165, 233, 0.3));
}

/* Promo icon avec rotation au hover */
.promo-icon-container {
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.promo-card-modern:hover .promo-icon-container {
    transform: rotate(360deg) scale(1.1);
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    .nav-link:hover {
        transform: none;
    }
    
    .promo-card-modern:hover {
        transform: none;
    }
}

/* Scrollbar personnalisée */
#sidebar::-webkit-scrollbar {
    width: 6px;
}

#sidebar::-webkit-scrollbar-track {
    background: transparent;
}

#sidebar::-webkit-scrollbar-thumb {
    background: rgba(14, 165, 233, 0.3);
    border-radius: 3px;
}

#sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(14, 165, 233, 0.5);
}

#sidebar nav::-webkit-scrollbar {
    width: 4px;
}

#sidebar nav::-webkit-scrollbar-track {
    background: transparent;
}

#sidebar nav::-webkit-scrollbar-thumb {
    background: rgba(14, 165, 233, 0.2);
    border-radius: 3px;
}

/* Performance optimizations */
.sidebar-transition,
.nav-link,
.promo-card-modern,
#close-sidebar {
    will-change: transform;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

/* Position sidebar */
#sidebar {
    top: 0;
    height: 100vh;
}

@media (min-width: 1024px) {
    #sidebar {
        top: 4rem;
        height: calc(100vh - 4rem);
        transform: translateX(0) !important;
    }
}
</style>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

<!-- Sidebar SOUS LE HEADER -->
<div id="sidebar" class="fixed left-0 w-72 shadow-2xl sidebar-transition -translate-x-full lg:translate-x-0 z-40 overflow-y-auto hidden lg:block">
    <div class="p-4 h-full flex flex-col min-h-0">
        <!-- Mobile Close Button -->
        <div class="lg:hidden flex justify-end mb-3 flex-shrink-0">
            <button id="close-sidebar" class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" aria-label="Fermer le menu">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Greeting Section -->
        <div class="flex items-center space-x-3 mb-6 flex-shrink-0">
            @php
                $provider = Auth::user()?->serviceProvider;
            @endphp

            <div class="avatar-container w-12 h-12 rounded-full overflow-hidden bg-center bg-cover"
                 style="background-image: url('{{ $provider?->profile_photo ? asset($provider->profile_photo) : '' }}'), url('{{ asset('images/helpexpat.png') }}');">
            </div>

            <div class="flex-1 min-w-0">
                <h2 id="user-greeting" class="text-xl font-bold text-gray-800 truncate">
                    {{ Auth::user()->name }}!
                </h2>
            </div>
        </div>

        @php 
            $user = Auth::user();
            $unreadMessagesCount = $user->unreadMessagesCount() ?? 0;
            // ✅ NOUVEAU - Badge total pour My services request
            $totalServiceNotifications = $user->totalUnreadServiceNotifications() ?? 0;
        @endphp

        <!-- Navigation Menu -->
        <nav class="space-y-2 flex-1 overflow-y-auto min-h-0">
            {{-- Dashboard --}}
            <a href="{{ route('dashboard')}}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-link {{ request()->is('dashboard') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fa-solid fa-gauge-high w-5 h-5 flex-shrink-0"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            {{-- ✅ My services request AVEC BADGE TOTAL --}}
            <a href="{{ route('user.service.requests') }}"
               class="flex items-center justify-between px-4 py-3 rounded-lg nav-link {{ request()->is('service-request') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <div class="flex items-center space-x-3">
                    <div class="relative flex-shrink-0">
                        <i class="fa-solid fa-list-check w-5 h-5"></i>
                        {{-- ✅ Badge TOTAL (propositions + messages publics) --}}
                        <span class="notification-badge-sidebar" 
                              data-value="{{ $totalServiceNotifications }}" 
                              id="services_notification">{{ $totalServiceNotifications > 99 ? '99+' : $totalServiceNotifications }}</span>
                    </div>
                    <span>My services request</span>
                </div>
            </a>

            @if($user->user_role == 'service_provider')
            {{-- My job list --}}
            <a href="{{ route('user.joblist') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-link {{ request()->is('job-list') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fa-solid fa-briefcase w-5 h-5 flex-shrink-0"></i>
                <span>My job list</span>
            </a>
            @endif

            {{-- My earnings --}}
            <a href="{{ route('user.earnings') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-link {{ request()->is('my-earnings') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fa-solid fa-euro-sign w-5 h-5 flex-shrink-0"></i>
                <span>My earnings</span>
            </a>
            
            {{-- Private messaging avec badge --}}
            <a href="{{ route('user.conversation') }}"
               class="flex items-center justify-between px-4 py-3 rounded-lg nav-link {{ request()->is('conversations') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <div class="flex items-center space-x-3">
                    <div class="relative flex-shrink-0">
                        <i class="fa-solid fa-envelope w-5 h-5"></i>
                        {{-- Badge messages privés --}}
                        <span class="notification-badge-sidebar" 
                              data-value="{{ $unreadMessagesCount }}" 
                              id="private_messages_notification">{{ $unreadMessagesCount > 99 ? '99+' : $unreadMessagesCount }}</span>
                    </div>
                    <span>Private messaging</span>
                </div>     
            </a>

            {{-- My account --}}
            <a href="{{ route('user.account') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-link {{ request()->is('account') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fa-solid fa-user w-5 h-5 flex-shrink-0"></i>
                <span>My account</span>
            </a>

            {{-- Payments to be validated --}}
            <a href="{{ route('user.payments.validate') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg nav-link {{ request()->is('payments-validate') ? 'active text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fa-solid fa-credit-card w-5 h-5 flex-shrink-0"></i>
                <span>Payments to be validated</span>
            </a>

            {{-- BLOC AFFILIATION INTÉGRÉ --}}
            <div class="pt-2">
                <a href="{{ route('user.affiliate.account') }}" 
                   class="block promo-card-modern p-4 rounded-xl text-white shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <div class="promo-icon-container bg-white bg-opacity-20 p-3 rounded-full mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-base font-bold leading-tight text-center">My Affiliation Account</span>
                    </div>
                </a>
            </div>
        </nav>

        <!-- Logout -->
        <div class="pt-4 border-t border-gray-200 flex-shrink-0 mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button-modern w-full text-sm font-semibold text-red-500 border-2 border-red-200 px-4 py-2.5 rounded-lg">
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const closeSidebar = document.getElementById('close-sidebar');
    const navLinks = document.querySelectorAll('.nav-link');

    function toggleSidebar() {
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        if (isOpen) {
            closeSidebarFunc();
        } else {
            openSidebarFunc();
        }
    }

    function openSidebarFunc() {
        if (!sidebar || !overlay) return;
        
        if (window.innerWidth < 1024) {
            sidebar.classList.remove('hidden');
        }
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarFunc() {
        if (!sidebar || !overlay) return;
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
        
        if (window.innerWidth < 1024) {
            setTimeout(() => {
                sidebar.classList.add('hidden');
            }, 400);
        }
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFunc);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebarFunc);
    }

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                closeSidebarFunc();
            }
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth < 1024) {
            const isOpen = sidebar && !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                closeSidebarFunc();
            }
        }
    });

    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth >= 1024) {
                if (sidebar) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.remove('hidden');
                }
                if (overlay) {
                    overlay.classList.add('hidden');
                }
                document.body.style.overflow = '';
            } else {
                closeSidebarFunc();
            }
        }, 250);
    });

    function extractFirstName(fullNameWithGreeting) {
        const cleanName = fullNameWithGreeting.replace(/[^\w\s]/g, '').trim();
        const nameParts = cleanName.split(/\s+/);
        return nameParts[0] || cleanName;
    }

    const userGreeting = document.getElementById('user-greeting');
    if (userGreeting) {
        const fullGreeting = userGreeting.textContent.trim();
        const firstName = extractFirstName(fullGreeting);
        userGreeting.textContent = firstName + '!';
    }

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if ('vibrate' in navigator) {
                navigator.vibrate(10);
            }
        });
    });

    // ✅ NOUVEAU - Mise à jour temps réel des badges
    @if(auth()->check())
    if (window.Echo) {
        // Badge messages privés
        window.Echo.channel('notify-user-{{ auth()->id() }}')
            .listen('NotifyUser', (data) => {
                if (data.type === 'message') {
                    const badge = document.getElementById('private_messages_notification');
                    if (badge) {
                        const current = parseInt(badge.dataset.value || 0);
                        const newCount = current + 1;
                        badge.dataset.value = newCount;
                        badge.textContent = newCount > 99 ? '99+' : newCount;
                    }
                }
            });

        // Badge services (propositions + messages publics)
        window.Echo.channel('notify-user-{{ auth()->id() }}')
            .listen('.MissionMessageReceived', (data) => {
                const badge = document.getElementById('services_notification');
                if (badge) {
                    const current = parseInt(badge.dataset.value || 0);
                    const newCount = current + 1;
                    badge.dataset.value = newCount;
                    badge.textContent = newCount > 99 ? '99+' : newCount;
                }
            });
    }
    @endif

    console.log('✅ Sidebar avec badges totaux initialisée');
});
</script>