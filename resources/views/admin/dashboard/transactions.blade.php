@extends('admin.dashboard.index')

@section('admin-content')

<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4 mb-4">
            <!-- Country Filter -->
            <input 
                type="text" 
                id="country-filter" 
                class="input w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300 ease-in-out" 
                placeholder="Filter by country">
            
            <!-- Mission Name Filter -->
            <input 
                type="text" 
                id="mission-name-filter" 
                class="input w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300 ease-in-out" 
                placeholder="Filter by mission name">
            
            <!-- Status Filter -->
            <input 
                type="text" 
                id="status-filter" 
                class="input w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300 ease-in-out" 
                placeholder="Filter by status">
            
            <!-- Email Filter -->
            <input 
                type="text" 
                id="email-filter" 
                class="input w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300 ease-in-out" 
                placeholder="Filter by provider email">

            <!-- Filter Button -->
            <button 
                id="filter-btn" 
                class="px-6 py-2 bg-blue-500 text-white rounded-md font-medium transition-all duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Filter
            </button>
        </div>

        <!-- Transaction Summary -->
        <div class="bg-white shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-blue-700 flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Recent Transactions
                </h3>
                <div id="transaction-count" class="text-sm text-gray-500">
                    Total: {{ $transactions->count() }} transactions
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mission</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ulixai Fee</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider Pays</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-table-body" class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $txn)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $txn->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-500">{{ $txn->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ Str::limit($txn->mission->title ?? '-', 30) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $txn->provider->first_name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $txn->provider->email ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600">€{{ number_format($txn->amount_paid, 2) }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                €{{ number_format($txn->client_fee, 2) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                €{{ number_format($txn->provider_fee, 2) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'completed' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        'cancelled' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $statusColor = $statusColors[strtolower($txn->status)] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    {{ ucfirst($txn->mission->payment_status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $txn->country }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($txn->mission->payment_status !== 'released' && $txn->mission->payment_status !== 'refunded')
                                        <button onclick="handleRefund({{ $txn->id }})"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                            </svg>
                                            Refund
                                        </button>
                                    @else
                                        <span class="text-sm text-gray-500">
                                            {{ ucfirst($txn->mission->payment_status) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg">No transactions found</p>
                                    <p class="text-gray-400 text-sm">Transactions will appear here once they are created</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- KYC/Stripe Status Section -->
        <div class="bg-white  shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-blue-700 flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Provider Stripe/KYC Status
                </h3>
                <div class="text-sm text-gray-500">
                    Total: {{ $providers->count() }} providers
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stripe Account</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Charges</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payouts</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KYC Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($providers as $provider)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-blue-700">
                                                {{ substr($provider->first_name, 0, 1) }}{{ substr($provider->last_name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $provider->first_name }} {{ $provider->last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">ID: {{ $provider->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $provider->email }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($provider->stripe_account_id)
                                    <div class="text-xs font-mono text-gray-600 bg-gray-100 px-2 py-1 rounded">
                                        {{ Str::limit($provider->stripe_account_id, 15) }}
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($provider->stripe_chg_enabled)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Enabled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if($provider->stripe_pts_enabled)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Enabled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @php
                                    $kycStatusColors = [
                                        'verified' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'incomplete' => 'bg-orange-100 text-orange-800'
                                    ];
                                    $kycStatus = $provider->kyc_status ?? 'pending';
                                    $kycColor = $kycStatusColors[strtolower($kycStatus)] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $kycColor }}">
                                    {{ ucfirst($kycStatus) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                @if(!$provider->stripe_chg_enabled || !$provider->stripe_pts_enabled)
                                    <form method="POST" action="{{ route('admin.stripe.kyc.remind', $provider->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.316 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                            Remind KYC
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 text-xs font-medium rounded-md">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Complete
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg">No service providers found</p>
                                    <p class="text-gray-400 text-sm">Providers will appear here once they are registered</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('filter-btn').addEventListener('click', function() {
        // Get filter values
        let country = document.getElementById('country-filter').value;
        let missionName = document.getElementById('mission-name-filter').value;
        let status = document.getElementById('status-filter').value;
        let email = document.getElementById('email-filter').value;

        // Make the AJAX request
        fetch('/api/transactions/filter?country=' + country + '&mission_name=' + missionName + '&status=' + status + '&email=' + email)
            .then(response => response.json())
            .then(data => {
                // Empty the table body
                let tableBody = document.getElementById('transaction-table-body');
                tableBody.innerHTML = '';

                // Update transaction count
                document.getElementById('transaction-count').innerText = data.length;
                // Loop through the data and populate the table
                data.forEach(txn => {
                    let row = document.createElement('tr');

                    row.innerHTML = `
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(txn.created_at).toLocaleDateString()}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${txn.mission.title || '-'}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${txn.provider.first_name}</div>
                            <div class="text-xs text-gray-500">${txn.provider.email}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">€${txn.amount_paid}</td>
                        <td class="px-4 py-4 whitespace-nowrap">€${txn.client_fee}</td>
                        <td class="px-4 py-4 whitespace-nowrap">€${txn.provider_fee}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${txn.status}</td>
                        <td class="px-4 py-4 whitespace-nowrap">${txn.country}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function handleRefund(transactionId) {
        if (!confirm('Are you sure you want to refund this transaction?')) {
            return;
        }

        fetch(`/api/admin/transactions/${transactionId}/refund`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Transaction refunded successfully');
                location.reload(); // Refresh to see updated status
            } else {
                alert(data.message || 'Failed to refund transaction');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to refund transaction');
        });
    }
</script>

@endsection