{{--
  ═══════════════════════════════════════════════════════════
  🦶 FOOTER COMPONENT - Partial (No HTML structure)
  ═══════════════════════════════════════════════════════════

  Ce fichier est un COMPOSANT PARTIEL.
  Il doit être inclus dans une page qui a déjà la structure HTML.

  Usage: @include('includes.footer')

  @version 3.0.0
  @refactored 2025-12-31
--}}

<style>
/* ═══════════════════════════════════════════════════════════
   FOOTER STYLES - Mobile First
   ═══════════════════════════════════════════════════════════ */

/* Blur orbs animation */
@keyframes footer-float {
    0%, 100% { transform: translate3d(0, 0, 0); }
    50% { transform: translate3d(0, -8px, 0); }
}

@keyframes footer-pulse-glow {
    0%, 100% { box-shadow: 0 0 15px rgba(220, 38, 38, 0.4); }
    50% { box-shadow: 0 0 25px rgba(220, 38, 38, 0.6); }
}

/* Blur orbs - Disabled on mobile for performance */
.footer-blur-orb {
    opacity: 0;
}

@media (min-width: 768px) {
    .footer-blur-orb {
        will-change: transform;
        opacity: 0.12;
    }
}

@media (min-width: 1024px) {
    .footer-blur-orb {
        animation: footer-float 12s ease-in-out infinite;
    }
    .footer-blur-orb:nth-child(2) {
        animation-delay: -4s;
    }
}

/* Glass card effect */
.footer-glass-card {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.5);
}

@media (min-width: 768px) {
    .footer-glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
}

/* SOS Banner */
.footer-sos-banner {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%);
}

@media (min-width: 768px) {
    .footer-sos-banner {
        animation: footer-pulse-glow 3s ease-in-out infinite;
    }
}

.footer-sos-banner:hover {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 50%, #7f1d1d 100%);
}

/* Social icons */
.footer-social-icon {
    transition: transform 0.2s ease;
}

@media (min-width: 768px) {
    .footer-social-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
    }
}

/* Link hover effect */
.footer-link-item {
    transition: color 0.2s ease;
}

.footer-link-item:hover {
    color: #2563eb;
}

/* Blue mesh gradient background */
.footer-blue-mesh {
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
}

@media (min-width: 768px) {
    .footer-blue-mesh {
        background:
            radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.1) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(147, 197, 253, 0.08) 0px, transparent 50%),
            linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0f2fe 100%);
    }
}

/* Payment cards */
.footer-payment-card {
    transition: transform 0.2s ease;
}

@media (min-width: 768px) {
    .footer-payment-card:hover {
        transform: translateY(-2px);
    }
}

/* Logo container */
.footer-logo-container {
    min-height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .footer-blur-orb,
    .footer-sos-banner,
    .footer-social-icon,
    .footer-payment-card {
        animation: none !important;
        transition: none !important;
    }
}
</style>

<!-- Ultra-Compact Mobile-First Footer -->
<footer class="relative w-full footer-blue-mesh overflow-hidden border-t border-blue-200/50" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">

    <!-- Decorative orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="footer-blur-orb absolute -top-16 -left-16 w-48 h-48 bg-blue-400 rounded-full blur-3xl"></div>
        <div class="footer-blur-orb absolute -bottom-16 right-0 w-48 h-48 bg-cyan-300 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Footer Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4">

        <!-- SOS-Expat Red Banner - MOBILE OPTIMIZED -->
        <a href="https://sos-expat.com"
           target="_blank"
           rel="noopener noreferrer"
           class="footer-sos-banner block rounded-2xl p-4 sm:p-5 mb-5 shadow-lg transition-all duration-300 hover:shadow-xl group"
           aria-label="Get urgent help on SOS-Expat">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-white">
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm flex-shrink-0">
                        <i class="fas fa-phone-volume text-2xl text-white" aria-hidden="true"></i>
                    </div>
                    <div class="text-center sm:text-left flex-1">
                        <h2 class="text-base sm:text-lg lg:text-xl font-bold mb-0.5">
                            🚨 Need Urgent Help?
                        </h2>
                        <p class="text-xs sm:text-sm opacity-90 leading-relaxed">
                            <strong class="font-bold">SOS-Expat.com</strong> – Phone connection <strong>in under 5 minutes</strong> with a lawyer or helping expat
                        </p>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm px-4 py-2.5 rounded-lg font-bold text-xs sm:text-sm whitespace-nowrap group-hover:bg-white/30 transition-colors flex items-center gap-2 min-h-[44px]">
                    Get Help Now
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform" aria-hidden="true"></i>
                </div>
            </div>
        </a>

        <!-- Single Unified Card -->
        <div class="footer-glass-card rounded-2xl p-4 sm:p-5 lg:p-6 shadow-sm">

            <!-- Top Row: Brand, Mission & Social -->
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 mb-4 sm:mb-5 pb-4 sm:pb-5 border-b border-blue-100">

                <!-- Brand & Mission -->
                <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 text-center sm:text-left w-full lg:w-auto">
                    <!-- Logo - Touch friendly size -->
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 p-0.5 shadow-md flex-shrink-0">
                        <div class="footer-logo-container w-full h-full bg-white rounded-xl overflow-hidden">
                            <img src="/images/headerlogos.png"
                                 alt="Ulixai Logo"
                                 width="56"
                                 height="56"
                                 loading="lazy"
                                 itemprop="logo"
                                 class="w-full h-auto object-contain p-1.5" />
                        </div>
                    </div>

                    <!-- Brand & Tagline -->
                    <div class="flex-1">
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-1" itemprop="name">
                            Ulixai
                        </h2>
                        <p class="text-xs sm:text-sm lg:text-base text-gray-700 font-medium leading-snug" itemprop="description">
                            🌍 <strong>All nationalities, all languages, all countries</strong> – Together, we support each other!
                        </p>
                    </div>
                </div>

                <!-- Social Media Icons - 44x44 minimum for touch -->
                <nav aria-label="Social media links" class="flex gap-2.5 sm:gap-3">
                    <a href="https://www.facebook.com/profile.php?id=61575873886727"
                       class="footer-social-icon w-11 h-11 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center shadow-sm"
                       aria-label="Facebook"
                       rel="noopener noreferrer"
                       target="_blank">
                        <i class="fab fa-facebook-f text-sm" aria-hidden="true"></i>
                    </a>
                    <a href="https://fr.pinterest.com/ulixai/"
                       class="footer-social-icon w-11 h-11 sm:w-10 sm:h-10 bg-gradient-to-br from-red-500 to-rose-600 text-white rounded-lg flex items-center justify-center shadow-sm"
                       aria-label="Pinterest"
                       rel="noopener noreferrer"
                       target="_blank">
                        <i class="fab fa-pinterest-p text-sm" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.instagram.com/ulixai_officiel/"
                       class="footer-social-icon w-11 h-11 sm:w-10 sm:h-10 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 text-white rounded-lg flex items-center justify-center shadow-sm"
                       aria-label="Instagram"
                       rel="noopener noreferrer"
                       target="_blank">
                        <i class="fab fa-instagram text-sm" aria-hidden="true"></i>
                    </a>
                </nav>
            </div>

            <!-- Bottom Row: Links - MOBILE FIRST GRID -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-x-4 sm:gap-x-6 gap-y-4 text-xs sm:text-sm">

                <!-- Quick Links -->
                <nav aria-labelledby="footer-quick-links">
                    <h3 id="footer-quick-links" class="font-bold text-gray-900 mb-2">Quick Links</h3>
                    <ul class="space-y-1.5" role="list">
                        <li><a href="/" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Home</a></li>
                        <li><a href="/affiliate" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Affiliate</a></li>
                        <li><a href="/becomepartner" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Partners</a></li>
                        <li><a href="{{ route('recruitment') }}" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Recruitment</a></li>
                    </ul>
                </nav>

                <!-- More Links -->
                <nav aria-labelledby="footer-more-links">
                    <h3 id="footer-more-links" class="font-bold text-gray-900 mb-2">Discover</h3>
                    <ul class="space-y-1.5" role="list">
                        <li><a href="/customerreviews" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Reviews</a></li>
                        <li><a href="/aboutUS" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">About Us</a></li>
                        <li><a href="/howitwork" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">How It Works</a></li>
                        <li><a href="/press" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Press</a></li>
                    </ul>
                </nav>

                <!-- Legal -->
                <nav aria-labelledby="footer-legal-links">
                    <h3 id="footer-legal-links" class="font-bold text-gray-900 mb-2">Legal</h3>
                    <ul class="space-y-1.5" role="list">
                        <li><a href="/trustnsecurity" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Security</a></li>
                        <li><a href="{{ route('terms.show') }}" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Terms</a></li>
                        <li><a href="/cookiemanagment" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Cookies</a></li>
                        <li><a href="/legal-notice" class="footer-link-item text-gray-600 hover:text-blue-600 block py-0.5">Legal Notice</a></li>
                    </ul>
                </nav>

                <!-- Payment Methods -->
                <div aria-labelledby="footer-payment">
                    <h3 id="footer-payment" class="font-bold text-gray-900 mb-2">Payment</h3>
                    <div class="flex gap-2 flex-wrap">
                        <div class="footer-payment-card bg-white/70 rounded-lg p-1.5 w-14 h-10 flex items-center justify-center shadow-sm">
                            <img src="{{ asset('images/visa.png') }}" alt="VISA" width="50" height="30" loading="lazy" class="w-full h-auto object-contain">
                        </div>
                        <div class="footer-payment-card bg-white/70 rounded-lg p-1.5 w-14 h-10 flex items-center justify-center shadow-sm">
                            <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" width="50" height="30" loading="lazy" class="w-full h-auto object-contain">
                        </div>
                        <div class="footer-payment-card bg-white/70 rounded-lg p-1.5 w-14 h-10 flex items-center justify-center shadow-sm">
                            <img src="{{ asset('images/paypal.png') }}" alt="PayPal" width="50" height="30" loading="lazy" class="w-full h-auto object-contain">
                        </div>
                    </div>
                </div>

                <!-- 2 Platforms, 4 Missions -->
                <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                    <h3 class="font-bold text-gray-900 mb-2">2 Platforms, 4 Missions</h3>
                    <p class="text-gray-600 leading-relaxed mb-2">
                        <strong class="text-blue-600">Ulixai</strong> & <strong class="text-red-600">SOS-Expat</strong> – One startup, global solidarity! 🤝
                    </p>
                    <p class="text-gray-500 text-xs">
                        © <time datetime="2025">2025</time> <span class="font-semibold">Ulixai</span> · All rights reserved
                    </p>
                </div>

            </div>

        </div>

    </div>
</footer>
