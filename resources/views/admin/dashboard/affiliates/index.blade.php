@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen ">
    <div class="container mx-auto p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Affiliate Dashboard</h1>
                    <p class="text-gray-600">Monitor and manage your affiliate program performance</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Revenue Card -->
            <div class="p-6 bg-gradient-to-br from-green-50 to-green-100/50 rounded-xl border border-green-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-green-700 font-medium">Total Revenue Through Affiliates</div>
                    <div class="p-2 bg-green-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-green-800">${{ number_format($total, 2) }}</div>
                <div class="text-sm text-green-600 mt-1">USD</div>
            </div>

            <!-- Balance Given Card -->
            <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border border-blue-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-blue-700 font-medium">Total Balance Given</div>
                    <div class="p-2 bg-blue-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-blue-800">${{ number_format($totalData, 2) }}</div>
                <div class="text-sm text-blue-600 mt-1">USD</div>
            </div>

            <!-- Amount to be Paid Card -->
            <div class="p-6 bg-gradient-to-br from-orange-50 to-orange-100/50 rounded-xl border border-orange-200/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-orange-700 font-medium">Total Amount to be Paid</div>
                    <div class="p-2 bg-orange-500/10 rounded-lg">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-orange-800">${{ number_format($totalAmountToPaid, 2) }}</div>
                <div class="text-sm text-orange-600 mt-1">USD</div>
            </div>
        </div>

        <!-- Affiliates Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">All Affiliates</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $affiliates->count() }} total affiliates</p>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
          <div class="overflow-x-auto">
    @if($affiliates->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Affiliate
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Referred By
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Balance
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <!-- New Column -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Registration Date
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($affiliates as $affiliate)
                @php
                    $referrer = $affiliate->referrer; // already loaded
                    $balance  = (float) ($affiliate->pending_affiliate_balance ?? 0);
                    $href     = route('admin.affiliates.details', ['id' => $affiliate->id]);
                    $initial  = function($name){ return strtoupper(mb_substr($name ?? 'U', 0, 1, 'UTF-8')); };
                @endphp

                <tr class="hover:bg-gray-50 transition-colors duration-200 cursor-pointer"
                    onclick="window.location='{{ $href }}'">
                    <!-- Affiliate Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ $initial($affiliate->name) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $affiliate->name }}</div>
                                <div class="text-sm text-gray-500">{{ $affiliate->email ?? 'No email' }}</div>
                            </div>
                        </div>
                    </td>

                    <!-- Referrer Info -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($referrer)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">
                                            {{ $initial($referrer->name) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm text-gray-900">
                                        {{ trim(($referrer->name ?? '').' '.($referrer->last_name ?? '')) ?: 'Unknown' }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Direct
                            </span>
                        @endif
                    </td>

                    <!-- Balance -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            ${{ number_format($balance, 2) }}
                        </div>
                        @if($balance > 0)
                            <div class="text-xs text-green-600">Pending payout</div>
                        @else
                            <div class="text-xs text-gray-500">No pending balance</div>
                        @endif
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($balance > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-yellow-400 rounded-full"></span>
                                Pending
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full"></span>
                                Active
                            </span>
                        @endif
                    </td>

                    <!-- Registration Date -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ optional($affiliate->created_at)->format('Y-m-d') ?? '-' }}
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ $href }}" class="text-primary-600 hover:text-primary-800">View</a>
                            {{-- more actions --}}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <!-- Empty State -->
        ...
    @endif
</div>

        </div>
    </div>
</div>

<style>
    /* Custom scrollbar for the table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection