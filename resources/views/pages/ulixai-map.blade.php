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
                                <span id="providerCount">{{ isset($providers) ? $providers->count() : 0 }}</span>
                                <span>{{ __('Providers found') }}</span>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Leaflet is loaded
        if (typeof L === 'undefined') {
            console.error('Leaflet is not loaded');
            return;
        }

        let providers = [];
        let filterCategory = [];
        let filterCountry = [];
        let filterLanguage = [];
        let markers = [];
        let filteredProviders = [];

        // Country code to flag emoji mapping
        const countryFlags = {
            'US': '🇺🇸', 'UK': '🇬🇧', 'GB': '🇬🇧', 'CA': '🇨🇦', 'AU': '🇦🇺',
            'DE': '🇩🇪', 'FR': '🇫🇷', 'PK': '🇵🇰', 'IN': '🇮🇳', 'CN': '🇨🇳',
            'JP': '🇯🇵', 'KR': '🇰🇷', 'ES': '🇪🇸', 'IT': '🇮🇹', 'BR': '🇧🇷',
            'MX': '🇲🇽', 'RU': '🇷🇺', 'SA': '🇸🇦', 'AE': '🇦🇪', 'EG': '🇪🇬',
            'United States': '🇺🇸', 'United Kingdom': '🇬🇧', 'Canada': '🇨🇦',
            'Australia': '🇦🇺', 'Germany': '🇩🇪', 'France': '🇫🇷', 'Pakistan': '🇵🇰',
            'India': '🇮🇳', 'China': '🇨🇳', 'Japan': '🇯🇵', 'Spain': '🇪🇸', 'Italy': '🇮🇹'
        };

        // Category mapping
        const categoryMapping = {
            'legal': 'Legal Services',
            'translation': 'Translation',
            'consulting': 'Business Consulting',
            'healthcare': 'Healthcare',
            'education': 'Education',
            'technology': 'Technology',
            'finance': 'Finance',
            'marketing': 'Marketing'
        };

        // Language names
        const languageNames = {
            'en': 'English', 'es': 'Spanish', 'fr': 'French', 'de': 'German',
            'it': 'Italian', 'pt': 'Portuguese', 'ru': 'Russian', 'zh': 'Chinese',
            'ja': 'Japanese', 'ko': 'Korean', 'ar': 'Arabic', 'ur': 'Urdu',
            'hi': 'Hindi', 'bn': 'Bengali', 'tr': 'Turkish', 'nl': 'Dutch'
        };

        // Country coordinates fallback
        const defaultCountryCoords = {
            'France': [46.6034, 1.8883],
            'Germany': [51.1657, 10.4515],
            'United Kingdom': [55.3781, -3.4360],
            'United States': [39.8283, -98.5795],
            'Canada': [56.1304, -106.3468],
            'Australia': [-25.2744, 133.7751],
            'Spain': [40.4637, -3.7492],
            'Italy': [41.8719, 12.5674],
            'Pakistan': [30.3753, 69.3451],
            'India': [20.5937, 78.9629]
        };

        // Generate badge
        function generateBadge(provider) {
            const reviewCount = provider.reviews_count || 0;
            const avgRating = provider.average_rating || 0;
            if (reviewCount > 100 && avgRating >= 4.8) return 'Diamond';
            if (reviewCount > 50 && avgRating >= 4.5) return 'Expert';
            if (reviewCount > 20 && avgRating >= 4.0) return 'Pro';
            if (provider.special_status && provider.special_status.length > 0) return 'Certified';
            return 'Verified';
        }

        // Get coordinates fallback
        function getCoordinates(country) {
            const baseCoords = defaultCountryCoords[country] || [30, 0];
            return [
                baseCoords[0] + (Math.random() - 0.5) * 5,
                baseCoords[1] + (Math.random() - 0.5) * 5
            ];
        }

        // Extract city from address
        function extractCity(address) {
            if (!address) return 'Unknown';
            const parts = address.split(',');
            return parts[0].trim();
        }

        // Initialize map
        const map = L.map('map').setView([30, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Create marker icon
        function createMarkerIcon(provider) {
            const badgeColors = {
                'Diamond': 'bg-blue-500',
                'Expert': 'bg-purple-500',
                'Pro': 'bg-green-500',
                'Certified': 'bg-yellow-500',
                'Verified': 'bg-blue-600'
            };
            const badgeColor = badgeColors[provider.badge] || 'bg-gray-500';

            return L.divIcon({
                className: 'custom-marker-wrapper',
                html: `
                    <div class="relative w-12 h-12 ${badgeColor} rounded-full flex items-center justify-center text-white font-bold shadow-lg border-3 border-white" style="border: 3px solid white; border-radius: 50%; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                        <img src="/${provider.photo}" class="w-10 h-10 rounded-full object-cover" alt="${provider.firstName}" onerror="this.src='/images/default-avatar.png'">
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                `,
                iconSize: [48, 48],
                iconAnchor: [24, 24]
            });
        }

        // Create popup content
        function createPopupContent(provider) {
            const rating = provider.rating > 0 ? provider.rating.toFixed(1) : 'New';
            const reviewsText = provider.reviews === 0 ? 'No reviews yet' : `${provider.reviews} reviews`;

            return `
                <div class="w-72 p-3">
                    <div class="flex items-start space-x-3">
                        <img src="/${provider.photo}"
                             class="w-14 h-14 rounded-full object-cover shadow-lg"
                             alt="${provider.firstName}"
                             onerror="this.src='/images/default-avatar.png'">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <h3 class="text-base font-bold text-gray-900">${provider.firstName} ${provider.lastName}</h3>
                                <span class="text-lg">${provider.countryFlag}</span>
                            </div>
                            <p class="text-blue-600 font-medium text-sm mb-1">${provider.profession}</p>
                            <p class="text-gray-500 text-xs mb-2">${provider.city}, ${provider.country}</p>

                            <div class="flex items-center space-x-2 mb-2">
                                ${provider.rating > 0 ? `
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">${rating}</span>
                                    </div>
                                ` : '<span class="text-xs text-gray-400">New</span>'}
                                <span class="bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full text-xs font-medium">${provider.badge}</span>
                            </div>

                            <div class="flex flex-wrap gap-1 mb-3">
                                ${provider.languageNames.slice(0, 3).map(lang => `
                                    <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">${lang}</span>
                                `).join('')}
                            </div>

                            <a href="/service-provider/${provider.slug}"
                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium text-center transition-colors">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            `;
        }

        // Add markers to map
        function addMarkersToMap(providersList) {
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            providersList.forEach(provider => {
                if (provider.lat && provider.lng && !isNaN(provider.lat) && !isNaN(provider.lng)) {
                    const marker = L.marker([provider.lat, provider.lng], {
                        icon: createMarkerIcon(provider)
                    }).addTo(map);

                    marker.bindPopup(createPopupContent(provider), {
                        className: 'custom-popup',
                        maxWidth: 320,
                        minWidth: 280
                    });

                    markers.push(marker);
                }
            });

            document.getElementById('providerCount').textContent = providersList.length;

            // Update hidden input for form
            const providerIds = providersList.map(p => p.id).join(',');
            const fetchInput = document.getElementById('fetch_providers');
            if (fetchInput) fetchInput.value = providerIds;
        }

        // Apply filters
        function applyFilters() {
            const country = document.getElementById('countryFilter').value;
            const city = document.getElementById('cityFilter').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value;
            const language = document.getElementById('languageFilter').value;

            filteredProviders = providers.filter(provider => {
                return (!country || provider.country === country || provider.countryCode === country) &&
                       (!city || (provider.city && provider.city.toLowerCase().includes(city))) &&
                       (!category || provider.category === category) &&
                       (!language || (provider.languages && provider.languages.includes(language)));
            });

            addMarkersToMap(filteredProviders);
            updateActiveFilters();
        }

        // Update active filters display
        function updateActiveFilters() {
            const activeFilters = document.getElementById('activeFilters');
            if (!activeFilters) return;

            activeFilters.innerHTML = '';

            const filters = [
                { id: 'countryFilter', label: 'Country' },
                { id: 'cityFilter', label: 'City' },
                { id: 'categoryFilter', label: 'Category' },
                { id: 'languageFilter', label: 'Language' }
            ];

            filters.forEach(filter => {
                const element = document.getElementById(filter.id);
                const value = element ? element.value : '';
                if (value) {
                    const chip = document.createElement('div');
                    chip.className = 'flex items-center space-x-2 bg-white/20 text-white px-3 py-1 rounded-full text-sm';
                    chip.innerHTML = `
                        <span>${filter.label}: ${value}</span>
                        <button class="text-white/70 hover:text-white" onclick="window.clearMapFilter('${filter.id}')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                    activeFilters.appendChild(chip);
                }
            });
        }

        // Clear filter (global function)
        window.clearMapFilter = function(filterId) {
            const el = document.getElementById(filterId);
            if (el) el.value = '';
            applyFilters();
        };

        // Update filter options from API data
        function updateFilterOptions() {
            const countries = [...new Set(filterCountry)];
            const categories = [...new Set(filterCategory)];
            const languages = [...new Set(filterLanguage)];

            const countrySelect = document.getElementById('countryFilter');
            if (countrySelect && countries.length > 0) {
                countrySelect.innerHTML = '<option value="">All Countries</option>';
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country;
                    option.textContent = `${countryFlags[country] || '🌍'} ${country}`;
                    countrySelect.appendChild(option);
                });
            }

            const categorySelect = document.getElementById('categoryFilter');
            if (categorySelect && categories.length > 0) {
                categorySelect.innerHTML = '<option value="">All Categories</option>';
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    option.textContent = categoryMapping[category] || category;
                    categorySelect.appendChild(option);
                });
            }

            const languageSelect = document.getElementById('languageFilter');
            if (languageSelect && languages.length > 0) {
                languageSelect.innerHTML = '<option value="">All Languages</option>';
                languages.forEach(lang => {
                    const option = document.createElement('option');
                    option.value = lang;
                    option.textContent = languageNames[lang] || lang.toUpperCase();
                    languageSelect.appendChild(option);
                });
            }
        }

        // Load providers from API
        async function loadProviders() {
            try {
                const response = await fetch('/api/providers/map', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error('Failed to load providers');

                const data = await response.json();

                if (data.filters) {
                    filterCategory = data.filters.categories || [];
                    filterCountry = data.filters.countries || [];
                    filterLanguage = data.filters.languages || [];
                }

                providers = (data.data || []).map(provider => {
                    let coords = [0, 0];

                    // Try city coordinates first
                    if (provider.city_coords) {
                        let cityCoords = provider.city_coords;
                        if (typeof cityCoords === 'string') {
                            try { cityCoords = JSON.parse(cityCoords); } catch (e) { cityCoords = null; }
                        }
                        if (Array.isArray(cityCoords) && cityCoords.length === 2) {
                            coords = [
                                parseFloat(cityCoords[0]) + (Math.random() - 0.5) * 0.1,
                                parseFloat(cityCoords[1]) + (Math.random() - 0.5) * 0.1
                            ];
                        }
                    }
                    // Try country coordinates
                    else if (provider.country_coords) {
                        let countryCoords = provider.country_coords;
                        if (typeof countryCoords === 'string') {
                            try { countryCoords = JSON.parse(countryCoords); } catch (e) { countryCoords = null; }
                        }
                        if (Array.isArray(countryCoords) && countryCoords.length === 2) {
                            coords = [
                                parseFloat(countryCoords[0]) + (Math.random() - 0.5) * 2,
                                parseFloat(countryCoords[1]) + (Math.random() - 0.5) * 2
                            ];
                        }
                    }
                    // Fallback to default country coords
                    else {
                        coords = getCoordinates(provider.country);
                    }

                    const spokenLanguages = provider.spoken_language || [];

                    return {
                        id: provider.id,
                        firstName: provider.first_name || 'Provider',
                        lastName: provider.last_name || '',
                        profession: provider.services_to_offer_category || 'Service Provider',
                        country: provider.country || 'Unknown',
                        countryCode: provider.country_code,
                        countryFlag: countryFlags[provider.country] || countryFlags[provider.country_code] || '🌍',
                        city: extractCity(provider.provider_address),
                        lat: coords[0],
                        lng: coords[1],
                        photo: provider.profile_photo || 'images/default-avatar.png',
                        languages: Array.isArray(spokenLanguages) ? spokenLanguages : [],
                        languageNames: (Array.isArray(spokenLanguages) ? spokenLanguages : []).map(lang => languageNames[lang] || lang.toUpperCase()),
                        category: provider.services_to_offer_category || 'general',
                        badge: generateBadge(provider),
                        rating: provider.average_rating || 0,
                        reviews: provider.reviews_count || 0,
                        slug: provider.slug || provider.id
                    };
                });

                addMarkersToMap(providers);
                filteredProviders = [...providers];
                updateFilterOptions();

            } catch (error) {
                console.error('Error loading providers:', error);
                document.getElementById('map').innerHTML = `
                    <div class="flex items-center justify-center h-full bg-gray-800/50 rounded-2xl">
                        <div class="text-center text-white p-8">
                            <svg class="w-16 h-16 mx-auto mb-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium mb-2">Unable to load map</h3>
                            <p class="text-gray-300 mb-4">Please try again later</p>
                            <button onclick="location.reload()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Reload
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Event listeners
        document.getElementById('countryFilter')?.addEventListener('change', applyFilters);
        document.getElementById('cityFilter')?.addEventListener('input', applyFilters);
        document.getElementById('categoryFilter')?.addEventListener('change', applyFilters);
        document.getElementById('languageFilter')?.addEventListener('change', applyFilters);

        document.getElementById('resetView')?.addEventListener('click', () => {
            map.setView([30, 0], 2);
        });

        document.getElementById('fullscreen')?.addEventListener('click', () => {
            const mapContainer = document.getElementById('map');
            if (mapContainer.requestFullscreen) {
                mapContainer.requestFullscreen();
            }
        });

        window.addEventListener('resize', () => {
            map.invalidateSize();
        });

        // Load providers on init
        loadProviders();
    });
    </script>