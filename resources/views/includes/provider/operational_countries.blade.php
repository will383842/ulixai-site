<div id="step6" class="hidden">
    <style>
        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        .country-chip {
            animation: popIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .country-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .country-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        .country-card.selected {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        .country-card.selected span {
            color: white;
            font-weight: 600;
        }
        .shake-animation {
            animation: shake 0.5s;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .search-glow:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
    </style>

    <!-- Header avec gradient -->
    <div class="mb-6 text-center">
        <h2 class="text-4xl font-black bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 bg-clip-text text-transparent mb-3 animate-slideDown">
            🌍 Where Do You Operate?
        </h2>
        <p class="text-gray-600 text-base font-medium">Select at least 3 countries • Click to add/remove</p>
    </div>

    <!-- Zone des pays sélectionnés (chips) -->
    <div id="selectedChipsContainer" class="mb-6 hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-5 border-2 border-purple-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-purple-900 flex items-center">
                    ✨ Selected Countries 
                    <span id="chipCounter" class="ml-2 bg-purple-600 text-white text-sm px-3 py-1 rounded-full">0</span>
                </h3>
                <button id="clearAll" class="text-red-500 hover:text-red-700 text-sm font-semibold hover:underline">
                    Clear All
                </button>
            </div>
            <div id="selectedChips" class="flex flex-wrap gap-2">
                <!-- Les chips seront ajoutés ici dynamiquement -->
            </div>
        </div>
    </div>

    <!-- Barre de recherche stylée -->
    <div class="mb-5">
        <div class="relative">
            <input 
                type="text" 
                id="countrySearch" 
                placeholder="🔍 Search for a country..." 
                class="w-full px-6 py-4 text-lg border-3 border-purple-300 rounded-2xl focus:border-purple-500 focus:outline-none search-glow transition-all bg-white"
            >
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Liste des pays avec design ultra moderne -->
    <div id="countryList" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-[500px] overflow-y-auto p-2 mb-6">
        @foreach($countries as $country)
            <div class="country-card border-3 border-gray-200 rounded-2xl p-4 bg-white hover:border-purple-400 relative" data-country="{{ $country->country }}">
                <input 
                    type="checkbox" 
                    name="countries[]" 
                    value="{{ $country->country }}" 
                    class="country-checkbox absolute opacity-0"
                >
                <div class="flex flex-col items-center text-center space-y-2">
                    <div class="w-14 h-14 flex items-center justify-center bg-gradient-to-br from-purple-100 to-pink-100 rounded-full text-3xl">
                        🌐
                    </div>
                    <span class="font-semibold text-gray-700 text-sm">{{ $country->country }}</span>
                </div>
                <!-- Checkmark animé -->
                <div class="checkmark absolute top-2 right-2 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow-lg hidden">
                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Messages erreur/succès -->
    <div id="countryError" class="hidden mb-5 p-5 bg-red-50 border-l-4 border-red-500 rounded-xl shake-animation">
        <div class="flex items-center">
            <span class="text-3xl mr-4">⚠️</span>
            <p class="text-red-700 font-bold text-lg">Please select at least 3 countries!</p>
        </div>
    </div>

    <div id="countrySuccess" class="hidden mb-5 p-5 bg-green-50 border-l-4 border-green-500 rounded-xl">
        <div class="flex items-center">
            <span class="text-3xl mr-4">🎉</span>
            <p class="text-green-700 font-bold text-lg">Perfect! <span id="successCount"></span> countries selected</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between items-center pt-6 border-t-2 border-gray-200">
        <button 
            id="backToStep5" 
            class="group flex items-center space-x-2 text-gray-700 hover:text-purple-600 font-bold text-lg transition-all"
        >
            <svg class="w-6 h-6 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Back</span>
        </button>
        
        <button 
            id="nextStep6" 
            class="group gradient-bg text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all flex items-center space-x-3"
        >
            <span>Continue</span>
            <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.country-card');
            const chipsContainer = document.getElementById('selectedChipsContainer');
            const chipsArea = document.getElementById('selectedChips');
            const chipCounter = document.getElementById('chipCounter');
            const clearAllBtn = document.getElementById('clearAll');
            const errorMsg = document.getElementById('countryError');
            const successMsg = document.getElementById('countrySuccess');
            const searchInput = document.getElementById('countrySearch');
            const nextBtn = document.getElementById('nextStep6');

            // Fonction pour créer un chip
            function createChip(countryName) {
                const chip = document.createElement('div');
                chip.className = 'country-chip flex items-center space-x-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full font-semibold shadow-lg';
                chip.innerHTML = `
                    <span>${countryName}</span>
                    <button class="remove-chip ml-2 hover:bg-white hover:text-purple-600 rounded-full p-1 transition-all" data-country="${countryName}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                `;
                return chip;
            }

            // Fonction de mise à jour
            function updateSelection() {
                const selected = document.querySelectorAll('.country-checkbox:checked');
                
                // Vider les chips
                chipsArea.innerHTML = '';
                
                if (selected.length > 0) {
                    chipsContainer.classList.remove('hidden');
                    chipCounter.textContent = selected.length;
                    
                    selected.forEach(checkbox => {
                        const chip = createChip(checkbox.value);
                        chipsArea.appendChild(chip);
                    });

                    // Events sur les boutons X des chips
                    document.querySelectorAll('.remove-chip').forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const country = this.dataset.country;
                            const card = document.querySelector(`.country-card[data-country="${country}"]`);
                            const checkbox = card.querySelector('.country-checkbox');
                            checkbox.checked = false;
                            card.classList.remove('selected');
                            card.querySelector('.checkmark').classList.add('hidden');
                            updateSelection();
                        });
                    });
                } else {
                    chipsContainer.classList.add('hidden');
                }

                // Messages
                errorMsg.classList.add('hidden');
                successMsg.classList.add('hidden');
                
                if (selected.length >= 3) {
                    successMsg.classList.remove('hidden');
                    document.getElementById('successCount').textContent = selected.length;
                }

                // Save localStorage
                const selectedCountries = Array.from(selected).map(cb => cb.value);
                localStorage.setItem('operationalCountries', JSON.stringify(selectedCountries));
            }

            // Click sur les cards
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    const checkbox = this.querySelector('.country-checkbox');
                    const checkmark = this.querySelector('.checkmark');
                    
                    checkbox.checked = !checkbox.checked;
                    
                    if (checkbox.checked) {
                        this.classList.add('selected');
                        checkmark.classList.remove('hidden');
                    } else {
                        this.classList.remove('selected');
                        checkmark.classList.add('hidden');
                    }
                    
                    updateSelection();
                });
            });

            // Clear All
            clearAllBtn.addEventListener('click', function() {
                document.querySelectorAll('.country-checkbox:checked').forEach(cb => {
                    cb.checked = false;
                });
                cards.forEach(card => {
                    card.classList.remove('selected');
                    card.querySelector('.checkmark').classList.add('hidden');
                });
                updateSelection();
            });

            // Recherche
            searchInput.addEventListener('input', function() {
                const search = this.value.toLowerCase();
                cards.forEach(card => {
                    const country = card.dataset.country.toLowerCase();
                    card.style.display = country.includes(search) ? 'block' : 'none';
                });
            });

            // Validation Next
            nextBtn.addEventListener('click', function(e) {
                const selected = document.querySelectorAll('.country-checkbox:checked').length;
                
                if (selected < 3) {
                    e.preventDefault();
                    errorMsg.classList.remove('hidden');
                    successMsg.classList.add('hidden');
                    errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            // Restore localStorage
            const saved = localStorage.getItem('operationalCountries');
            if (saved) {
                const selectedCountries = JSON.parse(saved);
                cards.forEach(card => {
                    const checkbox = card.querySelector('.country-checkbox');
                    if (selectedCountries.includes(checkbox.value)) {
                        checkbox.checked = true;
                        card.classList.add('selected');
                        card.querySelector('.checkmark').classList.remove('hidden');
                    }
                });
                updateSelection();
            }
        });
    </script>
</div>