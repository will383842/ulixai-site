@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto py-8 px-4">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Reputation Points Leaderboard</h1>
        <p class="text-gray-600">Track and manage provider reputation across the platform</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="flex justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                </svg>
                Filters
            </h2>
            <a href="{{ route('admin.reputation.config') }}" class="text-blue-600 hover:text-blue-900 font-medium flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="ml-1">Update Points</span>
            </a>
            
        </div>
        <form method="GET" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select name="country" id="country" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Countries</option>
                        @foreach($countries as $c)
                            <option value="{{ $c }}" {{ $country == $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                    <select name="language" id="language" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Languages</option>
                        @foreach($languages as $l)
                            <option value="{{ $l }}" {{ $language == $l ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="badge" class="block text-sm font-medium text-gray-700 mb-2">Badge</label>
                    <select name="badge" id="badge" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Badges</option>
                        @foreach($badges as $b)
                            <option value="{{ $b->id }}" {{ $badge == $b->id ? 'selected' : '' }}>{{ $b->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Providers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $providers->count() }}</p>
                </div>
                <div class="ml-4">
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Average Points</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($providers->avg('points'), 1) }}</p>
                </div>
                <div class="ml-4">
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Top Score</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $providers->max('points') ?? 0 }}</p>
                </div>
                <div class="ml-4">
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Leaderboard Rankings</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Badge</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($providers as $i => $provider)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($i < 3)
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $i === 0 ? 'bg-yellow-100 text-yellow-800' : ($i === 1 ? 'bg-gray-100 text-gray-800' : 'bg-orange-100 text-orange-800') }}">
                                        @if($i === 0)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @else
                                            {{ $i + 1 }}
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm font-medium text-gray-900">{{ $i + 1 }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover" src="/{{ $provider->profile_photo ?? '/images/default-avatar.png' }}" alt="">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $provider->first_name }} {{ $provider->last_name }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $provider->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $provider->country }}</div>
                            <div class="text-sm text-gray-500">{{ $provider->preferred_language }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $catIds = is_string($provider->services_to_offer_category) ? json_decode($provider->services_to_offer_category, true) : ($provider->services_to_offer_category ?? []);
                                $catNames = collect($categories)->whereIn('id', (array)$catIds)->pluck('name');
                            @endphp
                            <div class="flex flex-wrap gap-1">
                                @foreach($catNames->take(2) as $catName)
                                    <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                        {{ $catName }}
                                    </span>
                                @endforeach
                                @if($catNames->count() > 2)
                                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">
                                        +{{ $catNames->count() - 2 }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-bold text-blue-600">{{ number_format($provider->points) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $badge = $provider->user->badges()->where('type', 'reputation')->orderByDesc('threshold')->first();
                            @endphp
                            @if($badge)
                                <span class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full text-sm font-medium">
                                    <img src="/images/badges/{{ $badge->icon }}" class="w-4 h-4 mr-2" alt="">
                                    {{ $badge->title }}
                                </span>
                            @else
                                <span class="text-sm text-gray-500">No badge</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="openAdjustModal({{ $provider->id }}, {{ $provider->points }}, '{{ $provider->first_name }} {{ $provider->last_name }}')" class="text-gray-600 hover:text-gray-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Breakdown Row -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Adjust Points Modal -->
<div id="adjustModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Adjust Reputation Points</h3>
                <button onclick="closeAdjustModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="adjustForm" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provider</label>
                    <p id="providerName" class="text-sm text-gray-900 bg-gray-50 p-2 rounded"></p>
                </div>
                
                <div class="mb-4">
                    <label for="modalPoints" class="block text-sm font-medium text-gray-700 mb-2">Reputation Points</label>
                    <input type="number" id="modalPoints" name="points" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                
                <div class="mb-6">
                    <label for="modalReason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Adjustment</label>
                    <textarea id="modalReason" name="reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter reason for this adjustment..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAdjustModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Update Points
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

function openAdjustModal(providerId, currentPoints, providerName) {
    document.getElementById('adjustForm').action = `{{ url('admin/provider') }}/${providerId}/adjust-points`;
    document.getElementById('providerName').textContent = providerName;
    document.getElementById('modalPoints').value = currentPoints;
    document.getElementById('modalReason').value = '';
    document.getElementById('adjustModal').classList.remove('hidden');
}

function closeAdjustModal() {
    document.getElementById('adjustModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('adjustModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAdjustModal();
    }
});
</script>
@endsection