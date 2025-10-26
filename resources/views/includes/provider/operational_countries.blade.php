<div id="step6" class="hidden">
    <style>
        @keyframes popIn {
            0% { transform: scale(0.95); opacity: 0; }
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
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            border-color: #60a5fa;
        }
        .country-card.selected {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-color: #2563eb;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        }
        .country-card.selected .country-name {
            color: white;
            font-weight: 600;
        }
        .country-card.selected .country-icon {
            background: rgba(255, 255, 255, 0.2);
        }
        .country-card.selected .country-icon svg {
            color: white;
        }
        .shake-animation {
            animation: shake 0.5s;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        .search-glow:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>

    <!-- Header avec gradient -->
    <div class="mb-6 text-center">
        <h2 class="text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-500 bg-clip-text text-transparent mb-3 animate-slideDown">
            🌍 Where Do You Operate?
        </h2>
        <p class="text-gray-600 text-base font-medium">Select at least 1 country • Click to add/remove</p>
    </div>

    <!-- Zone des pays sélectionnés (chips) -->
    <div id="selectedChipsContainer" class="mb-6 hidden">
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-blue-900 flex items-center">
                    Selected Countries
                    <span id="chipCounter" class="ml-2 bg-blue-600 text-white text-xs px-2.5 py-1 rounded-full font-bold">0</span>
                </h3>
                <button id="clearAll" class="text-red-500 hover:text-red-700 text-xs font-semibold hover:underline transition-all">
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
                class="w-full px-6 py-4 text-lg border-3 border-blue-300 rounded-2xl focus:border-blue-500 focus:outline-none search-glow transition-all bg-white"
            >
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Liste des pays avec design moderne et épuré -->
    <div id="countryList" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-[500px] overflow-y-auto p-2 mb-6">
        @foreach($countries as $country)
            <div class="country-card group border-2 border-blue-400 rounded-xl p-3 bg-white hover:border-blue-500 relative transition-all duration-200" data-country="{{ $country->country }}">
                <input 
                    type="checkbox" 
                    name="countries[]" 
                    value="{{ $country->country }}" 
                    class="country-checkbox absolute opacity-0"
                >
                <div class="flex items-center space-x-3">
                    <div class="country-icon w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg flex-shrink-0 transition-all">
                        <svg class="w-5 h-5 text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="country-name font-medium text-gray-700 text-sm leading-tight flex-1 transition-colors">{{ $country->country }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Messages erreur/succès -->
    <div id="countryError" class="hidden mb-5 p-5 bg-red-50 border-l-4 border-red-500 rounded-xl shake-animation">
        <div class="flex items-center">
            <span class="text-3xl mr-4">⚠️</span>
            <p class="text-red-700 font-bold text-lg">Please select at least 1 country!</p>
        </div>
    </div>

    <div id="countrySuccess" class="hidden mb-5 p-5 bg-blue-50 border-l-4 border-blue-500 rounded-xl">
        <div class="flex items-center">
            <span class="text-3xl mr-4">🎉</span>
            <p class="text-blue-700 font-bold text-lg">Perfect! <span id="successCount"></span> countries selected</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="wizard-nav-container">
        <button id="backToStep5" type="button" class="nav-btn-back">
            Back
        </button>
        <button id="nextStep6" type="button" class="nav-btn-next">
            Continue
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
                chip.className = 'country-chip inline-flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm hover:shadow-md transition-all';
                chip.innerHTML = `
                    <span>${countryName}</span>
                    <button class="remove-chip hover:bg-blue-700 rounded p-0.5 transition-all" data-country="${countryName}">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
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
                            updateSelection();
                        });
                    });
                } else {
                    chipsContainer.classList.add('hidden');
                }

                // Messages
                errorMsg.classList.add('hidden');
                successMsg.classList.add('hidden');
                
                if (selected.length >= 1) {
                    successMsg.classList.remove('hidden');
                    document.getElementById('successCount').textContent = selected.length;
                }

                // Save localStorage
                const selectedCountries = Array.from(selected).map(cb => cb.value);
                localStorage.setItem('operationalCountries', JSON.stringify(selectedCountries));
                
                // Vérifier la validation
                checkValidation();
            }

            // Click sur les cards
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    const checkbox = this.querySelector('.country-checkbox');
                    
                    checkbox.checked = !checkbox.checked;
                    
                    if (checkbox.checked) {
                        this.classList.add('selected');
                    } else {
                        this.classList.remove('selected');
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
                
                if (selected < 1) {
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
                    }
                });
                updateSelection();
            }
            
            // Fonction de validation pour désactiver/activer le bouton
            function checkValidation() {
                const isValid = document.querySelectorAll('#countryList input[type="checkbox"]:checked').length >= 1;
                if (nextBtn) {
                    nextBtn.disabled = !isValid;
                }
            }
            
            // Vérification initiale
            setTimeout(checkValidation, 200);
        });
    </script>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextStep6');
    const stepElement = document.getElementById('step6');
    
    function checkValidation() {
        const isValid = document.querySelectorAll('#countryList input[type="checkbox"]:checked').length >= 1;
        if (nextBtn) {
            nextBtn.disabled = !isValid;
        }
    }
    
    // Observer les changements
    if (stepElement) {
        stepElement.addEventListener('click', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('input', () => setTimeout(checkValidation, 100));
        stepElement.addEventListener('change', () => setTimeout(checkValidation, 100));
    }
    
    // Vérification initiale
    setTimeout(checkValidation, 200);
});
</script>