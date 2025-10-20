<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ongoing Service Requests</title>
  <meta name="description" content="{{ $missions }}" />
  <meta name="keywords" content="service requests, ongoing, {{ $missions }}" />
  <script src="https://cdn.tailwindcss.com"></script>
  
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr + JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Inter', sans-serif;
    }
    
    .gradient-bg {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #dbeafe 100%);
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(59, 130, 246, 0.1);
    }
    
    .card-hover {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
    }
    
    .pulse-animation {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    
    .floating {
      animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
  .filter-active {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white !important;
  transform: scale(1.05);
}

    
    .stats-counter {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .category-education { background: linear-gradient(135deg, #3b82f6, #1e40af); }
    .category-tech { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .category-health { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
    .category-business { background: linear-gradient(135deg, #06b6d4, #0891b2); }
    
    .search-glow:focus {
      box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
  </style>
</head>
<body class="min-h-screen bg-white">
  @include('includes.header')
  @include('pages.popup')
   @php
      use App\Models\Country; 
      $countries = Country::where('status', 1)->pluck('country');
      $languages = [
          'English', 'French', 'Spanish', 'Portuguese', 'German', 
          'Italian', 'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'
      ];
  @endphp
  <!-- Animated background elements -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-100 opacity-30 rounded-full floating"></div>
    <div class="absolute top-3/4 right-1/4 w-32 h-32 bg-blue-200 opacity-40 rounded-full floating" style="animation-delay: -2s;"></div>
    <div class="absolute top-1/2 left-3/4 w-48 h-48 bg-blue-50 opacity-50 rounded-full floating" style="animation-delay: -4s;"></div>
  </div>

  <div class="relative z-10 min-h-screen p-4 md:">
    <!-- PHP Header Include -->
  
  

    <!-- Header Section -->
    <div class="max-w-7xl mx-auto">
      <!-- Title with animated counter -->
      <div class="text-center mb-12 mt-8">
        <h1 class="text-4xl md:text-6xl font-bold text-blue-900 mb-4">
          Service Requests
        </h1>
        <div class="flex items-center justify-center space-x-4">
          <div class="glass-effect rounded-2xl px-6 py-3 border border-blue-200">
            <span class="text-blue-800 text-lg font-medium">Active Requests:</span>
            <span class="text-3xl font-bold stats-counter ml-2" id="counter">0</span>
          </div>
          <div class="w-3 h-3 bg-blue-500 rounded-full pulse-animation"></div>
          <!-- <span class="text-blue-600 text-sm opacity-75">Live Updates</span> -->
        </div>
      </div>
      <!-- Social Media Share Card (below red cards, right side, more down) -->

        <!-- Social Media Share Card (below red cards, right side, more down) -->
         @include('pages.socialmediacard')

        <!-- Filter Row (replace pills and search) -->
        <div class="glass-effect rounded-3xl p-8 mb-12 border border-blue-200">
          <!-- Filter Row (replace pills and search) -->
          <div class="flex flex-wrap gap-4 justify-center mb-8">
              
              <!-- Country Dropdowns -->
              <select id="languageSelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white">
                  @foreach($languages as $lang)
                    <option value="{{ $lang }}">{{ $lang }}</option>
                  @endforeach
              </select>
              <select id="countrySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white">
                  @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                  @endforeach
              </select>
              
              <!-- Category Dropdown -->
              <select id="categorySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white">
                  <option value="">Select Category</option>
                  @foreach($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach  
              </select>

              <!-- Sub-category Dropdown (hidden initially) -->
              <select id="subcategorySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white hidden">
                  <option value="">Select Sub-category</option>
                  <!-- Subcategories will be dynamically added here based on the selected category -->
              </select>
              
              <button id="filterButton" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-150">
                  Filter
              </button>
          </div>

        <!-- Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="serviceGrid">
          @if(isset($missions) && count($missions))
            @foreach($missions as $index => $mission)
            @php
                if($mission->service_durition === '1 week') {
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
                } elseif($mission->service_durition === '2 weeks') {
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
                } elseif($mission->service_durition === '1 month') {
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
                } elseif($mission->service_durition === '3 months') {
                    $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
                } else {
                    $endTime = null;
                }
                if ($endTime) {
                    $remainingDays = $endTime->diffInDays(\Carbon\Carbon::now());
                } else {
                    $remainingDays = 'N/A'; 
                }
            @endphp
              <div class="bg-white rounded-3xl p-8 card-hover relative overflow-hidden shadow-xl border border-blue-100">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-bl-3xl opacity-20"></div>
                @if($mission->urgent ?? false)
                  <div class="absolute top-4 right-4 w-3 h-3 bg-blue-500 rounded-full pulse-animation"></div>
                @endif
                <div class="relative z-10">
                  <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                      <h3 class="text-xl font-bold text-blue-900 mb-3 leading-tight">
                        {{ $mission->title ?? 'Service Request' }}
                      </h3>
                      <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                          <span class="inline-block w-3 h-3 bg-blue-400 rounded-full"></span>
                          <span class="text-sm font-medium text-blue-700">
                            {{ $mission->category->name ?? 'Category' }}
                          </span>
                        </div>
                        <p class="text-sm text-blue-600">
                          {{ $mission->subcategory->name ?? 'Subcategory' }}
                        </p>
                        <div class="flex items-center space-x-1 text-sm text-blue-500">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                          </svg>
                          <span>{{ $mission->location_country ?? ($mission->location_city ?? 'Unknown Location') }}</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm text-blue-500">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                          </svg>
                          <span>{{ $mission->language ?? 'N/A' }}</span>
                        </div>
                        <div class="text-sm text-blue-600">
                          <span class="font-medium">Expires In:</span>
                          {{ $remainingDays }} Days
                        </div>
                      </div>
                    </div>
                    <div class="ml-4 flex items-center justify-center">
                      <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg animate-pulse-glow hover:shadow-yellow-300">
                        ✈️
                      </div>
                    </div>
                  </div>
                  <div class="border-t border-blue-100 pt-4 flex items-center justify-between">
                    <div class="text-sm text-blue-600">
                      <span class="font-medium">Requested by:</span>
                      {{ $mission->requester->name ?? 'Unknown' }}
                    </div>
                    
                    <a href="{{ route('qoute-offer', ['id' => $mission->id]) }}"
                       class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                      SEE
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-span-full text-center text-gray-400 py-12">
              No ongoing service requests found.
            </div>
          @endif
        </div>
        <script>
          // Update the active request counter
          document.addEventListener('DOMContentLoaded', function() {
            var counter = document.getElementById('counter');
            if (counter) {
              counter.textContent = "{{ isset($missions) ? count($missions) : 0 }}";
            }
          });
        </script>
       
      </div>
  </div>
 <script>
      // Event listener for category select
      document.getElementById('categorySelect').addEventListener('change', function() {
        var categoryId = this.value;
        var subcategorySelect = document.getElementById('subcategorySelect');
        
        if (categoryId) {
          // Fetch subcategories based on the selected category
          fetch(`/get-subcategories/${categoryId}`)
            .then(response => response.json())
            .then(subcategories => {
              // Populate the subcategory dropdown
              subcategorySelect.innerHTML = '<option value="">Select Sub-category</option>';  // Clear previous options
              
              subcategories.forEach(function(subcategory) {
                var option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.name;
                subcategorySelect.appendChild(option);
              });
              
              // Show the subcategory select
              subcategorySelect.classList.remove('hidden');
            });
        } else {
          // Hide the subcategory dropdown if no category is selected
          subcategorySelect.classList.add('hidden');
        }
      });

      // Event listener for the "Filter" button to load missions
      document.getElementById('filterButton').addEventListener('click', function() {
            var categoryId = document.getElementById('categorySelect').value;
            var subcategoryId = document.getElementById('subcategorySelect').value;
            var language = document.getElementById('languageSelect').value;
            var country = document.getElementById('countrySelect').value;

            // Fetch missions based on selected category and subcategory
            fetch(`/get-missions?category_id=${categoryId}&subcategory_id=${subcategoryId}&country=${country}&language=${language}`)
            .then(response => response.json())
        .then(missions => {
          // Render missions in the service grid
          const serviceGrid = document.getElementById('serviceGrid');
          serviceGrid.innerHTML = '';  // Clear previous missions

          if (missions.length > 0) {
            missions.forEach(function(mission) {
              const missionCard = document.createElement('div');
              missionCard.className = 'bg-white rounded-3xl p-8 card-hover relative overflow-hidden shadow-xl border border-blue-100';

              missionCard.innerHTML = `
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-bl-3xl opacity-20"></div>
                ${mission.urgent ? 
                  '<div class="absolute top-4 right-4 w-3 h-3 bg-blue-500 rounded-full pulse-animation"></div>' : ''}
                <div class="relative z-10">
                  <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                      <h3 class="text-xl font-bold text-blue-900 mb-3 leading-tight">${mission.title}</h3>
                      <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                          <span class="inline-block w-3 h-3 bg-blue-400 rounded-full"></span>
                          <span class="text-sm font-medium text-blue-700">${mission.category.name}</span>
                        </div>
                        <p class="text-sm text-blue-600">${mission.subcategory.name}</p>
                        <div class="flex items-center space-x-1 text-sm text-blue-500">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                          </svg>
                          <span>${mission.location_country || 'Unknown Location'}</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm text-blue-500">
                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                          </svg>
                          <span>${mission.language || 'N/A'}</span>
                        </div>
                      </div>
                    </div>
                    <div class="ml-4 flex items-center justify-center">
                      <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg animate-pulse-glow hover:shadow-yellow-300">
                        ✈️
                      </div>
                    </div>
                  </div>
                  <div class="border-t border-blue-100 pt-4 flex items-center justify-between">
                    <div class="text-sm text-blue-600">
                      <span class="font-medium">Requested by:</span>
                      ${mission.requester.name || 'Unknown'}
                    </div>
                    <a href="{{ route('qoute-offer', ['id' => $mission->id ?? 0]) }}"
                      class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                      SEE
                    </a>
                  </div>
                </div>
              `;

              serviceGrid.appendChild(missionCard);
            });
          } else {
            serviceGrid.innerHTML = '<p>No missions found.</p>';
          }
        });
    });
</script>

 
@include('dashboard.partials.dashboard-mobile-navbar')
</body>
</html>