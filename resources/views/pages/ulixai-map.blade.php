   <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        
        .animate-fade-in { animation: fadeIn 0.8s ease-out; }
        .animate-slide-in { animation: slideIn 0.6s ease-out; }
        .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
        
        .map-container { height: 70vh; min-height: 500px; }
        
        .custom-popup .leaflet-popup-content-wrapper {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        
        .custom-popup .leaflet-popup-tip {
            background: rgba(255, 255, 255, 0.95);
        }
        
        .provider-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .filter-chip {
            transition: all 0.3s ease;
        }
        
        .filter-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }
        
        .custom-marker {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .custom-marker:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }
        
        .search-input {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color:white;
        }
        
        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }
    </style>
    <!-- Hero Section -->
    <section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1.5s;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16 animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                    Service <span class="bg-gradient-to-r from-blue-200 to-cyan-200 bg-clip-text text-transparent">Providers Worldwide</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Discover verified professionals across the globe. From lawyers to translators, consultants to specialists - find the right expertise wherever you are.
                </p>
            </div>

            <!-- Filters Section -->
            <div class="mb-12 animate-fade-in" style="animation-delay: 0.3s;">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Country Filter -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Country</label>
                            <select id="countryFilter" class="search-input w-full px-4 py-2 rounded-lg placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="" >All Countries</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                                <option value="DE">Germany</option>
                                <option value="FR">France</option>
                                <option value="PK">Pakistan</option>
                            </select>
                        </div>
                        
                        <!-- City Filter -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">City</label>
                            <input type="text" id="cityFilter" placeholder="Search city..." class="search-input w-full px-4 py-2 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        
                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Category</label>
                            <select id="categoryFilter" class="search-input w-full px-4 py-2 rounded-lg placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">All Categories</option>
                                <option value="legal">Legal Services</option>
                                <option value="translation">Translation</option>
                                <option value="consulting">Consulting</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="education">Education</option>
                                <option value="technology">Technology</option>
                            </select>
                        </div>
                        
                        <!-- Language Filter -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Language</label>
                            <select id="languageFilter" class="search-input w-full px-4 py-2 rounded-lg placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">All Languages</option>
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="ur">Urdu</option>
                                <option value="ar">Arabic</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Active Filters & Stats -->
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="flex flex-wrap gap-2 mb-4 lg:mb-0">
                            <div id="activeFilters" class="flex flex-wrap gap-2"></div>
                        </div>
                        <form action="{{ route('view.service-providers') }}" method="GET">
                            <input type="hidden" id="fetch_providers" name="providers" value="" class="bg-transparent border-none outline-none text-green-200" readonly>
                            <button type="submit" 
                                class="flex items-center gap-2 bg-green-500/20 text-green-200 px-4 py-2 rounded-full border border-green-400/30 cursor-pointer hover:bg-green-500/30 transition">
                                <span id="providerCount">125</span>
                                <span>Providers found</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map Container -->
            <div class="animate-fade-in" style="animation-delay: 0.5s;">
                <div class="relative">
                    <div id="map" class="map-container rounded-2xl shadow-2xl border border-white/20 overflow-hidden"></div>
                    
                    <!-- Map Controls -->
                    <div class="absolute top-4 right-4 flex flex-col gap-2">
                        <button id="resetView" class="bg-white/90 backdrop-blur-sm text-gray-900 p-3 rounded-full shadow-lg hover:bg-white hover:scale-105 transition-all duration-300" title="Reset View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0a2 2 0 01-2 2H10a2 2 0 01-2-2v0z"></path>
                            </svg>
                        </button>
                        <button id="fullscreen" class="bg-white/90 backdrop-blur-sm text-gray-900 p-3 rounded-full shadow-lg hover:bg-white hover:scale-105 transition-all duration-300" title="Fullscreen">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>