@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="x-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center space-x-6">
                <div class="flex-shrink-0">
                    <div class="h-16 w-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-2xl font-semibold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold text-gray-900 truncate">{{ $user->name }}</h1>
                    <p class="text-gray-600 text-sm mt-1">{{ $user->email }}</p>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                        <span class="text-sm text-gray-500">{{ ucfirst($user->user_role === 'service_requester' ? 'Requester' : 'Provider') }}</span>
                        @if($provider)
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-gray-500" for="providerVisibilityToggle">Ulysse Map Visibility:</label>
                            <input type="checkbox"
                                id="providerVisibilityToggle"
                                data-provider-id="{{ $provider->id }}"
                                {{ $provider->provider_visibility ? 'checked' : '' }}
                                style="width: 18px; height: 18px;"
                            >
                            <span class="ml-2 text-sm text-gray-700" id="providerVisibilityLabel">
                                {{ $provider->provider_visibility ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>
                        <!-- Edit Coordinates Button -->

                        <button type="button"
                            class="ml-4 px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600"
                            onclick="openCoordsModal({{ $provider->id }})">
                            Edit Coordinates
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button class="tab-link py-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm whitespace-nowrap focus:outline-none" 
                            onclick="showTab(event, 'profile')" data-tab="profile">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Profile</span>
                        </div>
                    </button>
                    <button class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                            onclick="showTab(event, 'missions')" data-tab="missions">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Missions</span>
                        </div>
                    </button>
                    <button class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                            onclick="showTab(event, 'transactions')" data-tab="transactions">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Transactions</span>
                        </div>
                    </button>
                    <a href="{{ route('admin.users.edit-profile', $user->id) }}"
                       class="tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h6m2 7a2 2 0 002-2v-7.586a1 1 0 00-.293-.707l-7-7a1 1 0 00-1.414 0l-7 7A1 1 0 002 10.414V18a2 2 0 002 2h12z" />
                            </svg>
                            <span>Edit Profile</span>
                        </div>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Profile Tab Content -->
        <div id="profile" class="tab-content">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">User Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Full Name</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email Address</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Country</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->country ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Gender</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->gender ?? 'Not specified' }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">User Role</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ ucfirst($user->user_role) }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Preferred Language</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->preferred_language ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Affiliate Code</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->affiliate_code ?? 'Not assigned' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Member Since</label>
                                    <p class="text-sm text-gray-900 mt-1">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Management -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Status</h3>
                        <form method="POST" action="{{ route('admin.users.manage', $user->id) }}" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200">
                                    Update Status
                                </button>
                                @if($user->status == 'active')
                                    <button type="submit" name="status" value="suspended" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200">
                                        Suspend User
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Activity</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Last Login</label>
                                <p class="text-sm text-gray-900 mt-1">{{ $user->last_login_at ? $user->last_login_at->format('M d, Y g:i A') : 'Never' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($provider)
            <div class="mt-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Service Provider Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">First Name</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->first_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Last Name</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->last_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Native Language</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->native_language }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone Number</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->phone_number }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Country</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->country }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <p class="text-sm text-gray-900 mt-1">{{ $provider->ulysse_status }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Missions Tab Content -->
        <div id="missions" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Missions</h3>
                </div>
                <div class="overflow-hidden">
                    @if($missions->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mission</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($missions as $mission)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">#{{ $mission->id }}</div>
                                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $mission->title }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                                {{ $mission->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($mission->status == 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst(str_replace('_', ' ', $mission->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                                {{ $mission->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($mission->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if($mission->selectedProvider)
                                                {{ $mission->selectedProvider->first_name }} {{ $mission->selectedProvider->last_name }}
                                            @else
                                                <span class="text-gray-400">Unassigned</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $mission->budget_min }} - {{ $mission->budget_max }} {{ $mission->budget_currency }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $mission->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button onclick="openMissionActionModal({{ $mission->id }})" 
                                                    class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Manage
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No missions found</h3>
                            <p class="mt-1 text-sm text-gray-500">This user hasn't created any missions yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Transactions Tab Content -->
        <div id="transactions" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Transactions</h3>
                </div>
                <div class="overflow-hidden">
                    @if($transactions->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mission</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">#{{ $transaction->id }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">${{ number_format($transaction->amount_paid, 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                                {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if($transaction->mission)
                                                <div class="truncate max-w-xs">{{ $transaction->mission->title }}</div>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if($transaction->provider)
                                                {{ $transaction->provider->first_name }} {{ $transaction->provider->last_name }}
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $transaction->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No transactions found</h3>
                            <p class="mt-1 text-sm text-gray-500">This user hasn't made any transactions yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Affiliate Accounts Section -->
        <div id="affiliate" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Affiliate Accounts</h3>
                </div>
                <div class="px-6 py-4">
                    <!-- Filters -->
                    <form id="affiliate-filters-form" method="GET" action="" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                        <input type="date" name="date" value="{{ request('date') }}" class="rounded border-gray-300 px-2 py-1" placeholder="Date">
                        <input type="text" name="country" value="{{ request('country') }}" class="rounded border-gray-300 px-2 py-1" placeholder="Country">
                        <select name="role" class="rounded border-gray-300 px-2 py-1">
                            <option value="">Role</option>
                            <option value="service_requester" {{ request('role')=='service_requester'?'selected':'' }}>Requester</option>
                            <option value="service_provider" {{ request('role')=='service_provider'?'selected':'' }}>Provider</option>
                            <option value="super_admin" {{ request('role')=='super_admin'?'selected':'' }}>Super Admin</option>
                            <option value="regional_admin" {{ request('role')=='regional_admin'?'selected':'' }}>Regional Admin</option>
                            <option value="moderator" {{ request('role')=='moderator'?'selected':'' }}>Moderator</option>
                        </select>
                        <input type="text" name="language" value="{{ request('language') }}" class="rounded border-gray-300 px-2 py-1" placeholder="Language">
                        <select name="influencer" class="rounded border-gray-300 px-2 py-1">
                            <option value="">Influencer</option>
                            <option value="1" {{ request('influencer')=='1'?'selected':'' }}>Yes</option>
                            <option value="0" {{ request('influencer')=='0'?'selected':'' }}>No</option>
                        </select>
                        <input type="text" name="entity" value="{{ request('entity') }}" class="rounded border-gray-300 px-2 py-1" placeholder="Entity">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">Filter</button>
                    </form>

                    <div id="affiliate-accounts-content">
                        @php
                            $referredUsers = \App\Models\User::where('referred_by', $user->id)
                                ->when(request('date'), fn($q) => $q->whereDate('created_at', request('date')))
                                ->when(request('country'), fn($q) => $q->where('country', request('country')))
                                ->when(request('role'), fn($q) => $q->where('user_role', request('role')))
                                ->when(request('language'), fn($q) => $q->where('preferred_language', request('language')))
                                ->when(request('influencer') !== null, fn($q) => $q->where('special_status', 'like', '%influencer%'))
                                ->when(request('entity'), fn($q) => $q->where('affiliate_code', request('entity')))
                                ->get();
                        @endphp
                        @include('admin.dashboard.partials.affiliate-accounts-table', ['referredUsers' => $referredUsers])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Action Modal -->
<div id="missionActionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Manage Mission</h3>
                <button onclick="closeMissionActionModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="missionActionForm" method="POST" action="" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            <input type="hidden" name="mission_id" id="modal_mission_id" value="">
            
            <!-- Status Dropdown -->
            <div class="relative">
                <label for="modal_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="relative">
                    <select name="status" id="modal_status" class="appearance-none block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="published">Published</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="disputed">Disputed</option>
                        <option value="waiting_to_start">Waiting to Start</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Payment Status Dropdown -->
            <div class="relative">
                <label for="modal_payment_status" class="block text-sm font-medium text-gray-700 mb-2">Payment Status</label>
                <div class="relative">
                    <select name="payment_status" id="modal_payment_status"
                            class="appearance-none block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                        <option value="held">Held</option>
                        <option value="released">Released</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Assign Provider Dropdown -->
            <div class="relative">
                <label for="modal_selected_provider_id" class="block text-sm font-medium text-gray-700 mb-2">Assign Provider</label>
                <div class="relative">
                    <select name="selected_provider_id" id="modal_selected_provider_id"
                            class="appearance-none block w-full bg-white border border-gray-300 rounded-md py-2 pl-3 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select Provider --</option>
                        @foreach(\App\Models\ServiceProvider::all() as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->first_name }} {{ $prov->last_name }} ({{ $prov->email }})</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" />
                        </svg>
                    </div>
                </div>
            </div>

            
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeMissionActionModal()" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@if($provider)
    @php
        $countryCoords = $provider->country_coords ? preg_replace('/[\[\]]/', '', $provider->country_coords) : '';
        $cityCoords = $provider->city_coords ? preg_replace('/[\[\]]/', '', $provider->city_coords) : '';
    @endphp
<!-- Coordinates Modal -->
<div id="coordsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">User Location Coordinates</h3>
        <form id="coordsForm">
            @csrf
            <input type="hidden" id="coordsProviderId" value="{{$provider->id}}">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">City Coordinates (lat, lng)</label>
                <input type="text" value="{{$cityCoords}}" id="cityCoordsInput" name="city_coords" class="w-full border rounded px-3 py-2" placeholder="e.g. 48.8566, 2.3522">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Country Coordinates (lat, lng)</label>
                <input type="text" value="{{ implode(', ', $countryCoords) }}" id="countryCoordsInput" name="country_coords" class="w-full border rounded px-3 py-2" placeholder="e.g. 46.6034, 1.8883">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeCoordsModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
function showTab(evt, tabId) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-link').forEach(el => {
        el.classList.remove('border-blue-500', 'text-blue-600');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content (guard against missing element)
    var tabContent = document.getElementById(tabId);
    if (tabContent) {
        tabContent.classList.remove('hidden');
    }

    // Add active state to selected tab
    if (evt && evt.currentTarget) {
        evt.currentTarget.classList.remove('border-transparent', 'text-gray-500');
        evt.currentTarget.classList.add('border-blue-500', 'text-blue-600');
    }
}

// Initialize first tab on page load
document.addEventListener('DOMContentLoaded', function() {
    const firstTab = document.querySelector('.tab-link');
    if (firstTab) {
        firstTab.click();
    }
});

// Mission Action Modal functions
function openMissionActionModal(missionId) {
    document.getElementById('modal_mission_id').value = missionId;
    document.getElementById('missionActionForm').action = '/admin/missions/' + missionId + '/manage';
    document.getElementById('missionActionModal').classList.remove('hidden');
}

function closeMissionActionModal() {
    document.getElementById('missionActionModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('missionActionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeMissionActionModal();
    }
});

// Add tab for affiliate
document.addEventListener('DOMContentLoaded', function() {
    // Add affiliate tab button if not present
    if (!document.querySelector('[data-tab="affiliate"]')) {
        let nav = document.querySelector('nav[aria-label="Tabs"]');
        if (nav) {
            let btn = document.createElement('button');
            btn.className = 'tab-link py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none';
            btn.setAttribute('onclick', "showTab(event, 'affiliate')");
            btn.setAttribute('data-tab', 'affiliate');
            btn.innerHTML = `<div class="flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3m-8 9V3m8 0a4 4 0 00-8 0" />
                </svg>
                <span>Affiliate</span>
            </div>`;
            nav.appendChild(btn);
        }
    }
});

function openCoordsModal(providerId) {
    $('#coordsModal').removeClass('hidden');
}
function closeCoordsModal() {
    $('#coordsModal').addClass('hidden');
}

// AJAX submit for coordinates
$('#coordsForm').on('submit', function(e) {
    e.preventDefault();
    var providerId = $('#coordsProviderId').val();
    var cityCoords = $('#cityCoordsInput').val().split(',').map(Number);
    var countryCoords = $('#countryCoordsInput').val().split(',').map(Number);

    $.ajax({
        url: '/api/admin/provider/' + providerId + '/update-coords',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        data: {
            city_coords: cityCoords.length === 2 ? JSON.stringify(cityCoords) : null,
            country_coords: countryCoords.length === 2 ? JSON.stringify(countryCoords) : null
        },
        success: function(data) {
            alert('Coordinates updated successfully');
            closeCoordsModal();
            location.reload();
        },
        error: function(xhr) {
            alert('Failed to update coordinates');
        }
    });
});

$(document).ready(function() {
    $('#providerVisibilityToggle').on('change', function() {
        var providerId = $(this).data('provider-id');
        var checked = $(this).is(':checked');
        var $label = $('#providerVisibilityLabel');
        $(this).prop('disabled', true);
        $.ajax({
            url: '/api/admin/provider/' + providerId + '/toggle-visibility',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            success: function(data) {
                if (data.success) {
                    $label.text(data.visible ? 'Visible' : 'Hidden');
                }
            },
            complete: function() {
                $('#providerVisibilityToggle').prop('disabled', false);
            }
        });
    });
});
</script>
@endsection