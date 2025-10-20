@extends('admin.dashboard.index')
@yield('content')
@section('admin-content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-blue-800 bg-clip-text text-transparent">
                        Admin Dashboard
                    </h1>
                    <p class="mt-2 text-lg text-gray-600">Overview of Ulixia platform activity and finances</p>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl px-4 py-2 shadow-sm border border-white/20">
                        <span class="text-sm text-gray-500">Last updated</span>
                        <div class="text-sm font-semibold text-gray-900">{{ now()->format('M d, Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Primary Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-white/20 hover:scale-[1.02] ">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-500/10 to-blue-600/5 rounded-full -mr-12 -mt-12"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</div>
                            <div class="text-sm text-gray-500 mt-1">
                                {{ '+12% from ' . now()->subMonth()->format('F') }}
                            </div>
                        </div>

                    </div>
                    <div class="text-gray-700 font-semibold">Total Users</div>
                </div>
            </div>

            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-white/20 hover:scale-[1.02]">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-500/10 to-green-600/5 rounded-full translate-x-6 -translate-y-6"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900">{{ number_format($totalProviders) }}</div>
                            <div class="text-sm text-gray-500 mt-1">+8% from last month</div>
                        </div>
                    </div>
                    <div class="text-gray-700 font-semibold">Service Providers</div>
                </div>
            </div>

            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-white/20 hover:scale-[1.02]">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-purple-500/10 to-purple-600/5 rounded-full translate-x-6 -translate-y-6"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900">{{ number_format($totalRequesters) }}</div>
                            <div class="text-sm text-gray-500 mt-1">+15% from last month</div>
                        </div>
                    </div>
                    <div class="text-gray-700 font-semibold">Service Requesters</div>
                </div>
            </div>
        </div>

        <!-- Stripe Wallet Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-8 mb-10 border border-white/20">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Ulixia Stripe Wallet</h2>
                </div>
                <div class="hidden sm:flex items-center space-x-2 text-sm text-gray-500">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Live data</span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border border-blue-200/50">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-blue-700 font-medium">Available Balance</div>
                        <div class="p-2 bg-blue-500/10 rounded-lg">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-blue-800">{{ number_format($stripeBalance['available'], 2) }}</div>
                    <div class="text-sm text-blue-600 mt-1">{{ strtoupper($stripeBalance['currency']) }}</div>
                </div>

                <div class="p-6 bg-gradient-to-br from-yellow-50 to-yellow-100/50 rounded-xl border border-yellow-200/50">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-yellow-700 font-medium">Pending Balance</div>
                        <div class="p-2 bg-yellow-500/10 rounded-lg">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-yellow-800">{{ number_format($stripeBalance['pending'], 2) }}</div>
                    <div class="text-sm text-yellow-600 mt-1">{{ strtoupper($stripeBalance['currency']) }}</div>
                </div>

                <div class="p-6 bg-gradient-to-br from-green-50 to-green-100/50 rounded-xl border border-green-200/50">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-green-700 font-medium">Total Revenue</div>
                        <div class="p-2 bg-green-500/10 rounded-lg">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-green-800">{{ number_format($totalRevenue, 2) }}</div>
                    <div class="text-sm text-green-600 mt-1">EUR</div>
                </div>

                <div class="p-6 bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl border border-red-200/50">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-red-700 font-medium">Pending Payouts</div>
                        <div class="p-2 bg-red-500/10 rounded-lg">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-red-800">{{ number_format($totalPendingPayouts, 2) }}</div>
                    <div class="text-sm text-red-600 mt-1">EUR</div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-gray-600 font-medium mb-2">Pending KYC Providers</div>
                        <div class="text-3xl font-bold text-orange-600">{{ number_format($pendingKycProviders) }}</div>
                    </div>
                    <div class="p-3 bg-orange-500/10 rounded-xl">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-gray-600 font-medium mb-2">Pending Transactions</div>
                        <div class="text-3xl font-bold text-yellow-600">{{ number_format($pendingTransactions) }}</div>
                    </div>
                    <div class="p-3 bg-yellow-500/10 rounded-xl">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-gray-600 font-medium mb-2">Recent Missions</div>
                        <div class="text-3xl font-bold text-blue-600">{{ number_format($recentMissions->count()) }}</div>
                    </div>
                    <div class="p-3 bg-blue-500/10 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users & Providers -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Recent Users</h3>
                    <a href="{{ route('admin.users')}}" class="text-blue-600 hover:text-blue-700 hover:underline text-sm font-medium">View all</a>
                </div>
                <div class="space-y-4">
                    @foreach($recentUsers as $user)
                        <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-lg hover:bg-gray-100/50 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email ?? 'User' }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Recent Providers</h3>
                    <a href="{{ route('admin.users')}}" class="text-blue-600 hover:text-blue-700 hover:underline text-sm font-medium">View all</a>
                </div>
                <div class="space-y-4">
                    @foreach($recentProviders as $provider)
                        <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-lg hover:bg-gray-100/50 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr($provider->first_name, 0, 1) . substr($provider->last_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $provider->first_name }} {{ $provider->last_name }}</div>
                                    <div class="text-sm text-gray-500">Service Provider</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $provider->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $provider->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 mb-10 border border-white/20">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Recent Transactions</h3>
                <a href="{{ route('admin.transactions') }}" class="text-blue-600 hover:text-blue-700 hover:underline text-sm font-medium">View all transactions</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Transaction ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">User</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Amount</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($recentTransactions as $txn)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-mono text-sm text-gray-900">#{{ $txn->id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                            {{ $txn->provider->first_name ? strtoupper(substr($txn->provider->first_name, 0, 1)) : '?' }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $txn->provider->first_name ?? 'Unknown User' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">€{{ number_format($txn->amount_paid, 2) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $txn->status == 'completed' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }}">
                                        @if($txn->status == 'completed')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($txn->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $txn->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $txn->created_at->format('H:i') }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Missions -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-white/20">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">Recent Missions</h3>
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View all missions</a>
            </div>
            <div class="space-y-4">
                @foreach($recentMissions as $mission)
                    <div class="flex items-center justify-between p-4 bg-gray-50/50 rounded-lg hover:bg-gray-100/50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $mission->title ?? 'Mission #' . $mission->id }}</div>
                                <div class="text-sm text-gray-500">Active mission</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium text-gray-900">{{ $mission->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $mission->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection