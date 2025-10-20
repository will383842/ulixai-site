<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Improved Responsive Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom blur background animation */
        .blur-orb {
            animation: float 6s ease-in-out infinite;
        }

        .blur-orb:nth-child(2) {
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            33% { transform: translateY(-20px) translateX(10px); }
            66% { transform: translateY(10px) translateX(-10px); }
        }

        /* Custom gradient for payment cards */
        .payment-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Main content spacer -->
    <div class="min-h-screen flex items-end">
        
        <footer class="relative w-full bg-gradient-to-br from-white via-blue-50 to-red-50 border-t border-red-100 overflow-hidden">
            <!-- Animated Decorative Background -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="blur-orb absolute -top-20 -left-20 w-80 h-80 bg-gradient-to-r from-red-200 to-pink-200 rounded-full blur-3xl opacity-20"></div>
                <div class="blur-orb absolute -bottom-20 -right-20 w-80 h-80 bg-gradient-to-r from-blue-200 to-purple-200 rounded-full blur-3xl opacity-20"></div>
                <div class="blur-orb absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-gradient-to-r from-yellow-200 to-orange-200 rounded-full blur-3xl opacity-10"></div>
            </div>

            <!-- Main Footer Content -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                
                <!-- Main Grid Layout -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-12">
                    
                    <!-- About Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12  rounded-lg flex items-center justify-center">
                                <img src="/images/headerlogos.png" alt="Logo" class="w-25 h-auto max-h-14 object-contain" />
                            </div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                 @site
                            </h3>
                        </div>
                        <div class="space-y-4 text-gray-600 leading-relaxed">
                            <p class="text-sm lg:text-base">
                                <span class="font-semibold text-blue-800"> @site.com</span> is the solution for anyone who needs a helping hand — wherever they are in the world.
                            </p>
                            <p class="text-sm lg:text-base">
                                Need trusted, hassle-free assistance? Our platform connects you with verified providers who are available and ready to help.
                            </p>
                            <p class="text-sm lg:text-base font-medium text-blue-700">
                                At @site, we never leave you alone.
                            </p>
                        </div>
                        <div class="space-y-3">
                            <h5 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Follow Us</h5>
                            <div class="flex flex-wrap gap-3">
                                <a href="https://www.facebook.com/profile.php?id=61575873886727" class="group w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    <i class="fab fa-facebook-f text-sm group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="https://fr.pinterest.com/ulixai/" class="group w-10 h-10 bg-red-600 hover:bg-red-700 text-white rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    <i class="fab fa-pinterest-p text-sm group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="https://www.instagram.com/ulixai_officiel/" class="group w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    <i class="fab fa-instagram text-sm group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="#" class="group w-10 h-10 bg-black hover:bg-gray-800 text-white rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    <i class="fab fa-tiktok text-sm group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="https://x.com/Ulixai_officiel" class="group w-10 h-10 bg-blue-400 hover:bg-blue-500 text-white rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    <i class="fab fa-twitter text-sm group-hover:scale-110 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-gray-900 flex items-center">
                            <span class="text-orange-500 mr-2">⚡</span>
                            Quick Links
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="/" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Home</a></li>
                            <li>
                            <a href="{{ auth()->check() ? url('/inviteFriend') : route('login') }}"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">
                                Invite Friends
                            </a>
                            </li>

                            <li><a href="/affiliate" class="text-gray-600 hover:text-blue-700 hover:underline text-sm lg:text-base hover:translate-x-1 transform transition-all inline-block">Affiliate Program</a></li>
                            <li><a href="/becomepartner" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Become a Partner</a></li>
                            <li>
                            <a href="{{ route('recruitment') }}"
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">
                                Recruitment
                            </a>
                            </li>

                            <li><a href="/customerreviews" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Customer Reviews</a></li>
                            <li><a href="/aboutUS" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">About Us</a></li>
                            <li><a href="https://williamsjullin.com/" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Founder @site</a></li>
                        </ul>
                    </div>

                    <!-- Legal Info -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-gray-900 flex items-center">
                            <span class="text-blue-500 mr-2">📚</span>
                            Legal & Info
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="/trustnsecurity" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Trust & Security</a></li>
                            <li><a href="/howitwork" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">How It Works</a></li>
                            <li>
                                <a href="{{ route('terms.show') }}"
                                    class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">
                                    Terms & Conditions
                                </a>
                                </li>
                            <li><a href="/cookiemanagment" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transformation inline-block">Cookie Management</a></li>
                            <li><a href="/legal-notice" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Legal Notice</a></li>
                            <li><a href="/press" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 text-sm lg:text-base hover:translate-x-1 transform transition-transform inline-block">Press</a></li>
                        </ul>
                    </div>

                    <!-- Payment & Actions -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-gray-900 flex items-center">
                            <span class="text-green-500 mr-2">💳</span>
                            Payment
                        </h4>
                        <div class="grid grid-cols-3 mb-4">
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('images/visa.png') }}" alt="VISA" class="w-20 h-[50px] object-contain">
                            </div>
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" class="w-20 h-[50px] object-contain">
                            </div>
                            <div class="flex items-center justify-center">
                                <img src="{{ asset('images/paypal.png') }}" alt="PayPal" class="w-20 h-[50px] object-contain">
                            </div>
                        </div>

                        <!-- Report Bug Button -->
                        <div class="space-y-4">
                            <a href="/reportbug" class="w-full bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-sm text-center block">
                                <i class="fas fa-bug mr-2"></i>
                                Report a Bug
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <p class="text-sm text-gray-500 text-center sm:text-left">
                            © 2025 <span class="font-semibold text-blue-700"> @site.com</span> – Helping expatriates and travelers connect.
                        </p>
                        <div class="flex items-center space-x-4 text-xs text-gray-400">
                            <span>Made with ❤️ for travelers</span>
                        </div>
                    </div>
                </div>

            </div>
        </footer>
    </div>
</body>
</html>
