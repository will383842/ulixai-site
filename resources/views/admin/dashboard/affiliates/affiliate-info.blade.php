@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen">
    <div class="container mx-auto p-6">
        <!-- Back Button -->
        <a href="{{ route('admin.affiliationss') }}" class="inline-flex items-center mb-6 text-blue-600 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Affiliates
        </a>

        <!-- Affiliate Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $affiliate->name }}'s Affiliate Dashboard</h1>
                <p class="text-gray-600 mt-1">Member since {{ $affiliate->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Revenue Card -->
            <div class="p-6 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-xl border border-purple-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-purple-700 font-medium">Total Revenue Generated</div>
                    <div class="p-2 bg-purple-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-purple-800">${{ number_format($totalRevenue, 2) }}</div>
            </div>

            <!-- Total Balance Given -->
            <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border border-blue-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-blue-700 font-medium">Total Pending Balance</div>
                    <div class="p-2 bg-blue-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-blue-800">${{ number_format($affiliate->pending_affiliate_balance, 2) }}</div>
            </div>

            <!-- Total Amount Paid -->
            <div class="p-6 bg-gradient-to-br from-green-50 to-green-100/50 rounded-xl border border-green-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-green-700 font-medium">Total Amount Paid</div>
                    <div class="p-2 bg-green-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-green-800">${{ number_format($totalAmountPaid, 2) }}</div>
            </div>
        </div>

        <!-- Referrals Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Referrals ({{ $referrals->count() }})</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Spent</th>
                            <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission Earned</th> -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($referrals as $referral)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-600">
                                                {{ strtoupper(substr($referral->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $referral->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $referral->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $referral->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ${{ number_format($referral->total_spent, 2) }}
                            </td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ${{ number_format($referral->commission_earned, 2) }}
                            </td> -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No referrals found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
