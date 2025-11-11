{{-- ═══════════════════════════════════════════════════════════
     🎯 SIDEBAR DASHBOARD - VERSION FINALE CORRIGÉE
     ═══════════════════════════════════════════════════════════
     
     - Header mobile supprimé (navigation via hamburger global)
     - JavaScript original COMPLET préservé
     - Design moderne conservé
     - Fonctionne en desktop ET mobile
     
     @version 3.1.0 - CORRIGÉ
--}}

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-72 bg-white shadow-lg sidebar-transition transform -translate-x-full lg:translate-x-0 lg:static lg:h-auto z-50">
    <div class="p-6 h-screen overflow-y-auto">
        <!-- Mobile Close Button -->
        <div class="lg:hidden flex justify-end mb-4">
            <button id="close-sidebar" class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Greeting Section -->
        <div class="flex items-center space-x-3 mb-8">
            @php
                $provider = Auth::user()?->serviceProvider;
            @endphp

            <div class="w-12 h-12 rounded-full border-2 border-gray-300 overflow-hidden bg-center bg-cover"
                 style="background-image: url('{{ $provider?->profile_photo ? asset($provider->profile_photo) : '' }}'), url('{{ asset('images/helpexpat.png') }}');">
            </div>

            <div>
                <h2 id="user-greeting" class="text-xl font-bold text-gray-800">
                    {{ Auth::user()->name }}!
                </h2>
            </div>
        </div>

        @php 
            $user = Auth::user();
            $unreadMessagesCount = $user->unreadMessagesCount() ?? 0;
        @endphp

        <!-- Navigation Menu -->
        <nav class="space-y-2 mb-8">
            <a href="{{ route('dashboard')}}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-gauge-high w-5 h-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('user.service.requests') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('service-request') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-list-check w-5 h-5"></i>
                <span>My services request</span>
            </a>

            @if($user->user_role == 'service_provider')
            <a href="{{ route('user.joblist') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('job-list') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-briefcase w-5 h-5"></i>
                <span>My job list</span>
            </a>
            @endif

            <a href="{{ route('user.earnings') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('my-earnings') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-euro-sign w-5 h-5"></i>
                <span>My earnings</span>
            </a>
            
            <a href="{{ route('user.conversation') }}"
               class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->is('conversations') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <i class="fa-solid fa-envelope w-5 h-5"></i>
                        <span class="bg-red-400 rounded-full text-white text-xs absolute -top-2 -right-2 min-w-[16px] h-4 flex items-center justify-center font-medium {{ $unreadMessagesCount == 0 ? 'hidden' : ''}}" 
                              data-value="{{ $unreadMessagesCount }}" 
                              id="private_messages_notification">{{ $unreadMessagesCount > 0 ? $unreadMessagesCount : '' }}</span>
                    </div>
                    <span>Private messaging</span>
                </div>     
            </a>

            <a href="{{ route('user.account') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('account') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-user w-5 h-5"></i>
                <span>My account</span>
            </a>

            <a href="{{ route('user.payments.validate') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->is('payments-validate') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} nav-link">
                <i class="fa-solid fa-credit-card w-5 h-5"></i>
                <span>Payments to be validated</span>
            </a>
        </nav>

        <!-- Promotional Cards -->
        <div class="space-y-4 mb-8">
            <a href="{{ route('user.affiliate.account') }}" 
               class="block bg-gradient-to-r from-pink-500 to-orange-500 p-3 rounded-lg text-white shadow-lg hover:scale-105 transition-transform duration-200">
                <div class="flex flex-col items-center justify-center">
                    <div class="bg-white bg-opacity-20 p-2 rounded-full mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="text-base font-bold leading-tight">My Affiliation Account</span>
                </div>
            </a>
        </div>

        <!-- Logout -->
        <div class="pt-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-sm font-semibold text-red-500 border border-red-200 hover:text-white hover:bg-red-500 hover:border-red-500 transition-all duration-200 px-4 py-2 rounded-lg">
                    Log Out
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

    // ═══════════════════════════════════════════════════════════
    // SIDEBAR FUNCTIONS - ORIGINAL COMPLET
    // ═══════════════════════════════════════════════════════════

    // Close sidebar
    function closeSidebarFunc() {
        if (!sidebar || !overlay) return;
        
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Open sidebar (si besoin via le menu hamburger global)
    function openSidebarFunc() {
        if (!sidebar || !overlay) return;
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Event listeners
    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFunc);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebarFunc);
    }

    // CRITIQUE : Close sidebar when clicking nav links on MOBILE ONLY
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) { // lg breakpoint
                closeSidebarFunc();
            }
        });
    });

    // Handle escape key (mobile only)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth < 1024) {
            const isOpen = sidebar && !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                closeSidebarFunc();
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) { // lg breakpoint
            closeSidebarFunc(); // Fermer en cas de resize vers desktop
        }
    });

    // Extract and display first name only
    function extractFirstName(fullNameWithGreeting) {
        const cleanName = fullNameWithGreeting.replace(/[^\w\s]/g, '').trim();
        const nameParts = cleanName.split(/\s+/);
        return nameParts[0] || cleanName;
    }

    // Update sidebar greeting to show first name only
    const userGreeting = document.getElementById('user-greeting');
    if (userGreeting) {
        const fullGreeting = userGreeting.textContent.trim();
        const firstName = extractFirstName(fullGreeting);
        userGreeting.textContent = firstName + '!';
    }

    console.log('✅ Sidebar initialized (desktop + mobile)');
});
</script>

<style>
/* Sidebar transition */
.sidebar-transition {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>