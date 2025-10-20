@extends('admin.dashboard.index')

@section('admin-content')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 0.1; }
        50% { opacity: 0.3; }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-pulse-slow {
        animation: pulse-slow 3s ease-in-out infinite;
    }

    .map-container {
        height: 70vh;
        min-height: 480px;
        border-radius: 1rem;
    }

    .custom-popup .leaflet-popup-content-wrapper {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .custom-popup .leaflet-popup-tip {
        background: #ffffff;
    }

    .custom-marker {
        background: #3b82f6;
        border: 3px solid white;
        border-radius: 9999px;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        transition: transform 0.3s ease;
    }

    .custom-marker:hover {
        transform: scale(1.1);
    }

    .search-input {
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        color: #374151;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.5rem;
    }

    .filter-chip:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }
</style>

<!-- Hero Section -->
<section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <!-- Optional background pulses (fade them more) -->
    <div class="absolute top-10 left-10 w-56 h-56 bg-blue-100 rounded-full blur-2xl opacity-30 animate-pulse-slow"></div>
    <div class="absolute bottom-16 right-10 w-72 h-72 bg-gray-200 rounded-full blur-2xl opacity-20 animate-pulse-slow"></div>

    <div class="relative max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Service <span class="text-blue-600">Providers Directory</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Discover and manage verified professionals across the globe from a unified admin interface.
            </p>
        </div>

        <!-- Filters Section -->
        <div class="mb-12 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="admin-card shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Country Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <select id="countryFilter" class="search-input w-full px-3 py-2 rounded-lg">
                            <option value="">All Countries</option>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" id="cityFilter" placeholder="Search city..." class="search-input w-full px-3 py-2 rounded-lg">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="categoryFilter" class="search-input w-full px-3 py-2 rounded-lg">
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                        <select id="languageFilter" class="search-input w-full px-3 py-2 rounded-lg">
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

                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex flex-wrap gap-2 mb-4 lg:mb-0" id="activeFilters"></div>
                    <div class="bg-white text-blue-700 px-4 py-2 rounded-full border border-blue-300 font-medium">
                        <span id="providerCount">125</span> providers found
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="animate-fade-in" style="animation-delay: 0.4s;">
            <div class="relative">
                <div id="map" class="map-container bg-white border border-gray-200 shadow-md"></div>

                <!-- Map Controls -->
                <div class="absolute top-4 right-4 flex flex-col gap-2">
                    <button id="resetView" class="bg-white text-gray-700 p-2 rounded-full shadow-md hover:scale-105 transition duration-200 border border-gray-300" title="Reset View">
                        🔄
                    </button>
                    <button id="fullscreen" class="bg-white text-gray-700 p-2 rounded-full shadow-md hover:scale-105 transition duration-200 border border-gray-300" title="Fullscreen">
                        ⛶
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
  let providers = [];
  let filterCategory = [];
  let filterCountry = [];
  let filterLanguage = [];
        
        // Country code to flag emoji mapping
        const countryFlags = {
            'US': '🇺🇸', 'UK': '🇬🇧', 'GB': '🇬🇧', 'CA': '🇨🇦', 'AU': '🇦🇺', 
            'DE': '🇩🇪', 'FR': '🇫🇷', 'PK': '🇵🇰', 'IN': '🇮🇳', 'CN': '🇨🇳',
            'JP': '🇯🇵', 'KR': '🇰🇷', 'ES': '🇪🇸', 'IT': '🇮🇹', 'BR': '🇧🇷',
            'MX': '🇲🇽', 'RU': '🇷🇺', 'SA': '🇸🇦', 'AE': '🇦🇪', 'EG': '🇪🇬'
        };

        // Category mapping for better display
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

        // Language code to name mapping
        const languageNames = {
            'en': 'English', 'es': 'Spanish', 'fr': 'French', 'de': 'German',
            'it': 'Italian', 'pt': 'Portuguese', 'ru': 'Russian', 'zh': 'Chinese',
            'ja': 'Japanese', 'ko': 'Korean', 'ar': 'Arabic', 'ur': 'Urdu',
            'hi': 'Hindi', 'bn': 'Bengali', 'tr': 'Turkish', 'nl': 'Dutch'
        };

        // Generate badge based on provider data
        function generateBadge(provider) {
            const reviewCount = provider.reviews_count || 0;
            const avgRating = provider.average_rating || 0;
            
            if (reviewCount > 100 && avgRating >= 4.8) return 'Diamond';
            if (reviewCount > 50 && avgRating >= 4.5) return 'Expert';
            if (reviewCount > 20 && avgRating >= 4.0) return 'Pro';
            if (provider.special_status && provider.special_status.length > 0) return 'Certified';
            return 'Verified';
        }

        function getCoordinates(country, address) {
            const countryCoords = {
                'Afghanistan': [33.9391, 67.7100],
                'Albania': [41.1533, 20.1683],
                'Algeria': [28.0339, 1.6596],
                'Andorra': [42.5063, 1.5218],
                'Angola': [-11.2027, 17.8739],
                'Argentina': [-38.4161, -63.6167],
                'Armenia': [40.0691, 45.0382],
                'Australia': [-25.2744, 133.7751],
                'Austria': [47.5162, 14.5501],
                'Azerbaijan': [40.1431, 47.5769],
                'Bahamas': [25.0343, -77.3963],
                'Bahrain': [25.9304, 50.6378],
                'Bangladesh': [23.6850, 90.3563],
                'Barbados': [13.1939, -59.5432],
                'Belarus': [53.7098, 27.9534],
                'Belgium': [50.5039, 4.4699],
                'Belize': [17.1899, -88.4976],
                'Benin': [9.3077, 2.3158],
                'Bhutan': [27.5142, 90.4336],
                'Bolivia': [-16.2902, -63.5887],
                'Bosnia and Herzegovina': [43.9159, 17.6791],
                'Botswana': [-22.3285, 24.6849],
                'Brazil': [-14.2350, -51.9253],
                'Brunei': [4.5353, 114.7277],
                'Bulgaria': [42.7339, 25.4858],
                'Burkina Faso': [12.2383, -1.5616],
                'Burundi': [-3.3731, 29.9189],
                'Cabo Verde': [16.5388, -24.0132],
                'Cambodia': [12.5657, 104.9910],
                'Cameroon': [7.3697, 12.3547],
                'Canada': [56.1304, -106.3468],
                'Central African Republic': [6.6111, 20.9394],
                'Chad': [15.4542, 18.7322],
                'Chile': [-35.6751, -71.5430],
                'China': [35.8617, 104.1954],
                'Colombia': [4.5709, -74.2973],
                'Comoros': [-11.6455, 43.3333],
                'Congo': [-0.2280, 15.8277],
                'Costa Rica': [9.7489, -83.7534],
                'Croatia': [45.1000, 15.2000],
                'Cuba': [21.5218, -77.7812],
                'Cyprus': [35.1264, 33.4299],
                'Czech Republic': [49.8175, 15.4730],
                'Denmark': [56.2639, 9.5018],
                'Djibouti': [11.8251, 42.5903],
                'Dominica': [15.4140, -61.3710],
                'Dominican Republic': [18.7357, -70.1627],
                'Ecuador': [-1.8312, -78.1834],
                'Egypt': [26.0975, 30.0444],
                'El Salvador': [13.7942, -88.8965],
                'Equatorial Guinea': [1.6508, 10.2679],
                'Eritrea': [15.1794, 39.7823],
                'Estonia': [58.5953, 25.0136],
                'Eswatini': [-26.5225, 31.4659],
                'Ethiopia': [9.1450, 40.4897],
                'Fiji': [-16.7784, 179.4144],
                'Finland': [61.9241, 25.7482],
                'France': [46.6034, 1.8883],
                'Gabon': [-0.8037, 11.6094],
                'Gambia': [13.4432, -15.3101],
                'Georgia': [42.3154, 43.3569],
                'Germany': [51.1657, 10.4515],
                'Ghana': [7.9465, -1.0232],
                'Greece': [39.0742, 21.8243],
                'Grenada': [12.1165, -61.6790],
                'Guatemala': [15.7835, -90.2308],
                'Guinea': [9.9456, -9.6966],
                'Guinea-Bissau': [11.8037, -15.1804],
                'Guyana': [4.8604, -58.9302],
                'Haiti': [18.9712, -72.2852],
                'Honduras': [15.2000, -86.2419],
                'Hungary': [47.1625, 19.5033],
                'Iceland': [64.9631, -19.0208],
                'India': [20.5937, 78.9629],
                'Indonesia': [-0.7893, 113.9213],
                'Iran': [32.4279, 53.6880],
                'Iraq': [33.2232, 43.6793],
                'Ireland': [53.4129, -8.2439],
                'Israel': [31.0461, 34.8516],
                'Italy': [41.8719, 12.5674],
                'Jamaica': [18.1096, -77.2975],
                'Japan': [36.2048, 138.2529],
                'Jordan': [30.5852, 36.2384],
                'Kazakhstan': [48.0196, 66.9237],
                'Kenya': [-0.0236, 37.9062],
                'Kiribati': [-3.3704, -168.7340],
                'Kuwait': [29.3117, 47.4818],
                'Kyrgyzstan': [41.2044, 74.7661],
                'Laos': [19.8563, 102.4955],
                'Latvia': [56.8796, 24.6032],
                'Lebanon': [33.8547, 35.8623],
                'Lesotho': [-29.6100, 28.2336],
                'Liberia': [6.4281, -9.4295],
                'Libya': [26.3351, 17.2283],
                'Liechtenstein': [47.1660, 9.5554],
                'Lithuania': [55.1694, 23.8813],
                'Luxembourg': [49.8153, 6.1296],
                'Madagascar': [-18.7669, 46.8691],
                'Malawi': [-13.2543, 34.3015],
                'Malaysia': [4.2105, 101.9758],
                'Maldives': [3.2028, 73.2207],
                'Mali': [17.5707, -3.9962],
                'Malta': [35.9375, 14.3754],
                'Marshall Islands': [7.1315, 171.1845],
                'Mauritania': [21.0079, -10.9408],
                'Mauritius': [-20.3484, 57.5522],
                'Mexico': [23.6345, -102.5528],
                'Micronesia': [7.4256, 150.5508],
                'Moldova': [47.4116, 28.3699],
                'Monaco': [43.7384, 7.4246],
                'Mongolia': [46.8625, 103.8467],
                'Montenegro': [42.7087, 19.3744],
                'Morocco': [31.7917, -7.0926],
                'Mozambique': [-18.6657, 35.5296],
                'Myanmar': [21.9162, 95.9560],
                'Namibia': [-22.9576, 18.4904],
                'Nauru': [-0.5228, 166.9315],
                'Nepal': [28.3949, 84.1240],
                'Netherlands': [52.1326, 5.2913],
                'New Zealand': [-40.9006, 174.8860],
                'Nicaragua': [12.2650, -85.2072],
                'Niger': [17.6078, 8.0817],
                'Nigeria': [9.0820, 8.6753],
                'North Korea': [40.3399, 127.5101],
                'North Macedonia': [41.6086, 21.7453],
                'Norway': [60.4720, 8.4689],
                'Oman': [21.4735, 55.9754],
                'Pakistan': [30.3753, 69.3451],
                'Palau': [7.5150, 134.5825],
                'Palestine': [31.9522, 35.2332],
                'Panama': [8.5380, -80.7821],
                'Papua New Guinea': [-6.3140, 143.9555],
                'Paraguay': [-23.4425, -58.4438],
                'Peru': [-9.1900, -75.0152],
                'Philippines': [12.8797, 121.7740],
                'Poland': [51.9194, 19.1451],
                'Portugal': [39.3999, -8.2245],
                'Qatar': [25.3548, 51.1839],
                'Romania': [45.9432, 24.9668],
                'Russia': [61.5240, 105.3188],
                'Rwanda': [-1.9403, 29.8739],
                'Saint Kitts and Nevis': [17.3578, -62.7830],
                'Saint Lucia': [13.9094, -60.9789],
                'Saint Vincent and the Grenadines': [12.9843, -61.2872],
                'Samoa': [-13.7590, -172.1046],
                'San Marino': [43.9424, 12.4578],
                'Sao Tome and Principe': [0.1864, 6.6131],
                'Saudi Arabia': [23.8859, 45.0792],
                'Senegal': [14.4974, -14.4524],
                'Serbia': [44.0165, 21.0059],
                'Seychelles': [-4.6796, 55.4920],
                'Sierra Leone': [8.4606, -11.7799],
                'Singapore': [1.3521, 103.8198],
                'Slovakia': [48.6690, 19.6990],
                'Slovenia': [46.1512, 14.9955],
                'Solomon Islands': [-9.6457, 160.1562],
                'Somalia': [5.1521, 46.1996],
                'South Africa': [-30.5595, 22.9375],
                'South Korea': [35.9078, 127.7669],
                'South Sudan': [6.8770, 31.3070],
                'Spain': [40.4637, -3.7492],
                'Sri Lanka': [7.8731, 80.7718],
                'Sudan': [12.8628, 30.2176],
                'Suriname': [3.9193, -56.0278],
                'Sweden': [60.1282, 18.6435],
                'Switzerland': [46.8182, 8.2275],
                'Syria': [34.8021, 38.9968],
                'Taiwan': [23.6978, 120.9605],
                'Tajikistan': [38.8610, 71.2761],
                'Tanzania': [-6.3690, 34.8888],
                'Thailand': [15.8700, 100.9925],
                'Timor-Leste': [-8.8742, 125.7275],
                'Togo': [8.6195, 0.8248],
                'Tonga': [-21.1789, -175.1982],
                'Trinidad and Tobago': [10.6918, -61.2225],
                'Tunisia': [33.8869, 9.5375],
                'Turkey': [38.9637, 35.2433],
                'Turkmenistan': [38.9697, 59.5563],
                'Tuvalu': [-7.1095, 177.6493],
                'Uganda': [1.3733, 32.2903],
                'Ukraine': [48.3794, 31.1656],
                'United Arab Emirates': [23.4241, 53.8478],
                'United Kingdom': [55.3781, -3.4360],
                'United States': [39.8283, -98.5795],
                'Uruguay': [-32.5228, -55.7658],
                'Uzbekistan': [41.3775, 64.5853],
                'Vanuatu': [-15.3767, 166.9592],
                'Vatican City': [41.9029, 12.4534],
                'Venezuela': [6.4238, -66.5897],
                'Vietnam': [14.0583, 108.2772],
                'Yemen': [15.5527, 48.5164],
                'Zambia': [-13.1339, 27.8493],
                'Zimbabwe': [-19.0154, 29.1549]
            };
            
            // Add some random offset for better visualization
            const baseCoords = countryCoords[country] || [0, 0];
            return [
                baseCoords[0] + (Math.random() - 0.5) * 5, // Add some random offset
                baseCoords[1] + (Math.random() - 0.5) * 5
            ];
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
                
                if (!response.ok) {
                    throw new Error('Failed to load providers');
                }
                
                const data = await response.json();
                filterCategory = data.filters.categories;
                filterCountry = data.filters.countries;
                filterLanguage = data.filters.languages;
                providers = data.data.map(provider => {
                    let coords = [0, 0];
                    if (provider.city_coords) {
                        let cityCoords = provider.city_coords;
                        if (typeof cityCoords === 'string') {
                            try {
                                cityCoords = JSON.parse(cityCoords);
                            } catch (e) {
                                cityCoords = null;
                            }
                        }
                        if (Array.isArray(cityCoords) && cityCoords.length === 2) {
                            coords = [
                                parseFloat(cityCoords[0]) + (Math.random() - 0.5) * 0.1,
                                parseFloat(cityCoords[1]) + (Math.random() - 0.5) * 0.1
                            ];
                        }
                    } else if (provider.country_coords) {
                        let countryCoords = provider.country_coords;
                        if (typeof countryCoords === 'string') {
                            try {
                                countryCoords = JSON.parse(countryCoords);
                            } catch (e) {
                                countryCoords = null;
                            }
                        }
                        if (Array.isArray(countryCoords) && countryCoords.length === 2) {
                            coords = [
                                parseFloat(countryCoords[0]) + (Math.random() - 0.5) * 2,
                                parseFloat(countryCoords[1]) + (Math.random() - 0.5) * 2
                            ];
                        }
                    } else {
                        coords = getCoordinates(provider.country, provider.provider_address);
                    }
                    const spokenLanguages = provider.spoken_language || [];
                    const reviewCount = provider.reviews_count || 0;
                    const avgRating = provider.average_rating || 0;
                    return {
                        id: provider.id,
                        userId: provider.user_id,
                        firstName: provider.first_name,
                        lastName: provider.last_name,
                        profession: provider.services_to_offer_category || 'Service Provider',
                        country: provider.country,
                        countryFlag: countryFlags[provider.country] || '🌍',
                        city: extractCity(provider.provider_address),
                        address: provider.provider_address,
                        lat: coords[0],
                        lng: coords[1],
                        photo: provider.profile_photo || '/images/default-avatar.png',
                        languages: spokenLanguages,
                        languageNames: spokenLanguages.map(lang => languageNames[lang] || lang.toUpperCase()),
                        category: provider.services_to_offer_category || 'general',
                        categoryName: categoryMapping[provider.services_to_offer_category] || provider.services_to_offer_category,
                        badge: generateBadge(provider),
                        rating: avgRating,
                        reviews: reviewCount,
                        slug: provider.slug,
                        description: provider.profile_description,
                        nativeLanguage: provider.native_language,
                        operationalCountries: provider.operational_countries || [],
                        communicationOnline: provider.communication_online,
                        communicationInperson: provider.communication_inperson,
                        specialStatus: provider.special_status || []
                    };
                });
                
                // Initialize map with loaded providers
                addMarkersToMap(providers);
                filteredProviders = [...providers];
                
                // Update filter options based on loaded data
                updateFilterOptions();
                
            } catch (error) {
                console.error('Error loading providers:', error);
                
                // Fallback: Show error message or use sample data
                document.getElementById('map').innerHTML = `
                    <div class="flex items-center justify-center h-full bg-gray-100 rounded-2xl">
                        <div class="text-center">
                            <div class="text-red-500 mb-4">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Unable to load providers</h3>
                            <p class="text-gray-600 mb-4">Please check your connection and try again.</p>
                            <button onclick="loadProviders()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Retry
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Extract city from address string
        function extractCity(address) {
            if (!address) return 'Unknown';
            
            // Simple extraction - you might want to improve this
            const parts = address.split(',');
            return parts[0].trim();
        }

        // Update filter options based on available data
        function updateFilterOptions() {
            const countries = [...new Set(filterCountry)];
            const categories = [...new Set(filterCategory)];
            const languages = [...new Set(filterLanguage)];
            
            // Update country filter
            const countrySelect = document.getElementById('countryFilter');
            countrySelect.innerHTML = '<option value="">All Countries</option>';
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country;
                option.textContent = `${countryFlags[country] || '🌍'} ${country}`;
                countrySelect.appendChild(option);
            });
            
            // Update category filter
            const categorySelect = document.getElementById('categoryFilter');
            categorySelect.innerHTML = '<option value="">All Categories</option>';
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = categoryMapping[category] || category;
                categorySelect.appendChild(option);
            });
            
            // Update language filter
            const languageSelect = document.getElementById('languageFilter');
            languageSelect.innerHTML = '<option value="">All Languages</option>';
            languages.forEach(lang => {
                const option = document.createElement('option');
                option.value = lang;
                option.textContent = languageNames[lang] || lang.toUpperCase();
                languageSelect.appendChild(option);
            });
        }

        // Initialize map
        const map = L.map('map').setView([30, 0], 2);
        
        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Store markers for filtering
        let markers = [];
        let filteredProviders = [...providers];

        // Create custom marker icon
        function createMarkerIcon(provider) {
            const badgeColors = {
                'Diamond': 'bg-blue-500',
                'Expert': 'bg-purple-500',
                'Pro': 'bg-green-500',
                'Certified': 'bg-yellow-500',
                'Verified': 'bg-red-500',
                'Mentor': 'bg-indigo-500'
            };
            
            const badgeColor = badgeColors[provider.badge] || 'bg-gray-500';
            
            return L.divIcon({
                className: 'custom-marker',
                html: `
                    <div class="relative w-12 h-12 ${badgeColor} rounded-full flex items-center justify-center text-white font-bold shadow-lg border-2 border-white">
                        <img src="/${provider.photo}" class="w-10 h-10 rounded-full object-cover" alt="${provider.firstName}">
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
            const reviewsText = provider.reviews === 0 ? 'No reviews yet' : provider.reviews;
            const ratingDisplay = provider.rating > 0 ? 
                `<div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-sm font-medium">${rating}</span>
                    <span class="text-sm text-gray-500">(${reviewsText})</span>
                </div>` : 
                `<span class="text-sm text-gray-500">New provider</span>`;

            return `
                <div class="w-80 p-4">
                    <div class="flex items-start space-x-4">
                        <img src="/${provider.photo}" 
                             class="w-16 h-16 rounded-full object-cover shadow-lg" 
                             alt="${provider.firstName}"
                            >
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="text-lg font-bold text-gray-900">${provider.firstName} ${provider.lastName}</h3>
                                <span class="text-xl">${provider.countryFlag}</span>
                            </div>
                            <p class="text-blue-600 font-semibold mb-1">${provider.profession}</p>
                            <p class="text-gray-600 text-sm mb-2">${provider.city}, ${provider.country}</p>
                            
                            <div class="flex items-center space-x-4 mb-3">
                                ${ratingDisplay}
                                <div class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                    ${provider.badge}
                                </div>
                            </div>
                            
                            ${provider.description ? `
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">${provider.description.substring(0, 100)}${provider.description.length > 100 ? '...' : ''}</p>
                            ` : ''}
                            
                            <div class="flex flex-wrap gap-1 mb-3">
                                ${provider.languageNames.map(lang => `
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">${lang}</span>
                                `).join('')}
                            </div>
                            
                            <div class="flex items-center space-x-4 mb-3 text-xs text-gray-500">
                                ${provider.communicationOnline ? '<span class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-1"></span>Online</span>' : ''}
                                ${provider.communicationInperson ? '<span class="flex items-center"><span class="w-2 h-2 bg-blue-400 rounded-full mr-1"></span>In-person</span>' : ''}
                            </div>
                            
                            <div class="flex space-x-2">
                                <button onclick="viewProvider(${provider.userId})" data-route-template="{{ route('admin.users.manage', ':id') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Provider action functions
        function viewProvider(userId) {
            const routeTemplate = document.querySelector('[data-route-template]').dataset.routeTemplate;
            const url = routeTemplate.replace(':id', userId);
            window.open(url, '_blank');
        }


        function contactProvider(providerId) {
            // window.open(`/contact/${providerId}`, '_blank');
        }

        // Add markers to map
        function addMarkersToMap(providersList) {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];
    providersList.forEach(provider => {
        const marker = L.marker([provider.lat, provider.lng], {
            icon: createMarkerIcon(provider)
        }).addTo(map);

        marker.bindPopup(createPopupContent(provider), {
            className: 'custom-popup',
            maxWidth: 350,
            minWidth: 320
        });

        markers.push(marker);
    });

    // Update provider count
    document.getElementById('providerCount').textContent = providersList.length;
}

// Filter functionality
function applyFilters() {
    const country = document.getElementById('countryFilter').value;
    const city = document.getElementById('cityFilter').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const language = document.getElementById('languageFilter').value;

    filteredProviders = providers.filter(provider => {
        return (!country || provider.country === country) &&
                (!city || provider.city.toLowerCase().includes(city)) &&
                (!category || provider.category === category) &&
                (!language || provider.languages.includes(language));
    });

    addMarkersToMap(filteredProviders);
    updateActiveFilters();
}

// Update active filters display
function updateActiveFilters() {
    const activeFilters = document.getElementById('activeFilters');
    activeFilters.innerHTML = '';

    const filters = [
        { id: 'countryFilter', label: 'Country' },
        { id: 'cityFilter', label: 'City' },
        { id: 'categoryFilter', label: 'Category' },
        { id: 'languageFilter', label: 'Language' }
    ];

    filters.forEach(filter => {
        const element = document.getElementById(filter.id);
        const value = element.value;
        if (value) {
            const chip = document.createElement('div');
            chip.className = 'filter-chip bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center space-x-2';
            chip.innerHTML = `
                <span>${filter.label}: ${value}</span>
                <button class="text-blue-200 hover:text-white" onclick="clearFilter('${filter.id}')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            activeFilters.appendChild(chip);
        }
    });
}

// Clear individual filter
function clearFilter(filterId) {
    document.getElementById(filterId).value = '';
    applyFilters();
}

// Event listeners for filters
document.getElementById('countryFilter').addEventListener('change', applyFilters);
document.getElementById('cityFilter').addEventListener('input', applyFilters);
document.getElementById('categoryFilter').addEventListener('change', applyFilters);
document.getElementById('languageFilter').addEventListener('change', applyFilters);

// Reset view button
document.getElementById('resetView').addEventListener('click', () => {
    map.setView([30, 0], 2);
});

// Fullscreen button
document.getElementById('fullscreen').addEventListener('click', () => {
    const mapContainer = document.getElementById('map');
    if (mapContainer.requestFullscreen) {
        mapContainer.requestFullscreen();
    }
});

// Initialize map with all providers
loadProviders();

// Adjust map size on window resize
window.addEventListener('resize', () => {
    map.invalidateSize();
});
</script>
@endsection
