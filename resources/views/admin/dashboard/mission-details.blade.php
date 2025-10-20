@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-slate-50 py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6">
            <nav class="flex items-center space-x-2 text-sm text-slate-500 mb-4">
                <a href="{{ route('admin.missions') }}" class="hover:text-slate-700 transition-colors">Missions</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-slate-900">Mission Details</span>
            </nav>
            
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-slate-900">Mission Overview</h1>
                <a href="{{ route('admin.missions') }}" 
                   class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Missions
                </a>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-500 border-t-transparent"></div>
                <span class="ml-3 text-slate-600">Loading mission details...</span>
            </div>
        </div>

        <!-- Mission Details Content -->
        <div id="missionContent" class="hidden space-y-6">
            <!-- Status and Quick Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4" id="quickInfo">
                    <!-- Dynamic content will be inserted here -->
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Main Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Mission Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h2 class="text-lg font-semibold text-slate-900">Mission Information</h2>
                        </div>
                        <div class="p-6" id="missionInfo">
                            <!-- Dynamic content -->
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h2 class="text-lg font-semibold text-slate-900">Description</h2>
                        </div>
                        <div class="p-6" id="missionDescription">
                            <!-- Dynamic content -->
                        </div>
                    </div>

                    <!-- Transactions -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h2 class="text-lg font-semibold text-slate-900">Transaction History</h2>
                        </div>
                        <div class="p-6" id="transactionHistory">
                            <!-- Dynamic content -->
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="space-y-6">
                    <!-- Participants -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-900">Participants</h3>
                        </div>
                        <div class="p-6" id="participants">
                            <!-- Dynamic content -->
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-900">Financial Summary</h3>
                        </div>
                        <div class="p-6" id="financialSummary">
                            <!-- Dynamic content -->
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-900">Timeline</h3>
                        </div>
                        <div class="p-6" id="timeline">
                            <!-- Dynamic content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div id="errorState" class="hidden bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <div class="text-center">
                <svg class="h-12 w-12 text-red-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-slate-900 mb-2">Failed to Load Mission</h3>
                <p class="text-slate-600 mb-4">We couldn't retrieve the mission details. Please try again.</p>
                <button onclick="loadMissionDetails()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Retry
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function getStatusConfig(status) {
    const configs = {
        'completed': { 
            bg: 'bg-emerald-100', 
            text: 'text-emerald-800', 
            dot: 'bg-emerald-500',
            icon: 'M5 13l4 4L19 7'
        },
        'in_progress': { 
            bg: 'bg-amber-100', 
            text: 'text-amber-800', 
            dot: 'bg-amber-500',
            icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
        },
        'pending': { 
            bg: 'bg-blue-100', 
            text: 'text-blue-800', 
            dot: 'bg-blue-500',
            icon: 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        },
        'cancelled': { 
            bg: 'bg-slate-100', 
            text: 'text-slate-800', 
            dot: 'bg-slate-500',
            icon: 'M6 18L18 6M6 6l12 12'
        }
    };
    return configs[status] || configs['cancelled'];
}

function formatCurrency(amount, currency = '') {
    if (!amount) return '-';
    return new Intl.NumberFormat('en-US', {
        style: currency ? 'currency' : 'decimal',
        currency: currency || 'USD'
    }).format(amount);
}

function formatDate(dateString, options = {}) {
    if (!dateString) return '-';
    const defaultOptions = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString('en-US', { ...defaultOptions, ...options });
}

function loadMissionDetails() {
    // Show loading state
    document.getElementById('loadingState').classList.remove('hidden');
    document.getElementById('missionContent').classList.add('hidden');
    document.getElementById('errorState').classList.add('hidden');

    fetch(`/api/admin/missions/{{ $missionId }}`)
        .then(res => {
            if (!res.ok) throw new Error('Failed to fetch mission details');
            return res.json();
        })
        .then(m => {
            const statusConfig = getStatusConfig(m.status);
            const statusDisplay = m.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());

            // Quick Info Section
            document.getElementById('quickInfo').innerHTML = `
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-slate-900 mb-2">${m.title || '(No Title)'}</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="h-2 w-2 ${statusConfig.dot} rounded-full mr-2"></div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${statusConfig.bg} ${statusConfig.text}">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${statusConfig.icon}"></path>
                                </svg>
                                ${statusDisplay}
                            </span>
                        </div>
                        <div class="text-sm text-slate-600">
                            <span class="font-medium">ID:</span> #${m.id}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.missions.conversation', $missionId) }}" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01
                                    M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.2-3.6A7.93 7.93 0 013 12
                                    c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>

                        Conversations
                    </a>

                    <a href="{{ route('admin.missions.edit', $missionId) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Mission
                    </a>


                </div>
            `;

            // Mission Information
            document.getElementById('missionInfo').innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Title:</dt>
                            <dd class="text-sm text-slate-900 font-medium">${m.title || '(No Title)'}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Status:</dt>
                            <dd>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ${statusConfig.bg} ${statusConfig.text}">
                                    ${statusDisplay}
                                </span>
                            </dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Category:</dt>
                            <dd class="text-sm text-slate-900">${m.category || 'General'}</dd>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Created:</dt>
                            <dd class="text-sm text-slate-900">${formatDate(m.created_at)}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Updated:</dt>
                            <dd class="text-sm text-slate-900">${formatDate(m.updated_at)}</dd>
                        </div>
                        <div class="flex items-start">
                            <dt class="flex-shrink-0 text-sm font-medium text-slate-600 w-24">Priority:</dt>
                            <dd>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium ${
                                    (m.priority === 'high') ? 'bg-red-100 text-red-800' :
                                    (m.priority === 'medium') ? 'bg-yellow-100 text-yellow-800' :
                                    'bg-green-100 text-green-800'
                                }">
                                    ${m.priority || 'Normal'}
                                </span>
                            </dd>
                        </div>
                    </div>
                </div>
            `;

            // Description
            document.getElementById('missionDescription').innerHTML = `
                <div class="prose prose-slate max-w-none">
                    ${m.description ? 
                        `<div class="bg-slate-50 border border-slate-200 rounded-lg p-4 text-sm text-slate-700 leading-relaxed">${m.description}</div>` :
                        `<div class="text-center py-8 text-slate-400">
                            <svg class="h-12 w-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="text-sm">No description provided</p>
                        </div>`
                    }
                </div>
            `;

            // Participants
            document.getElementById('participants').innerHTML = `
                <div class="space-y-4">
                    <!-- Requester -->
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-slate-900">Requester</div>
                            <div class="text-sm text-slate-600">${m.requester?.name || 'Unknown'}</div>
                            <div class="text-xs text-slate-500">${m.requester?.email || ''}</div>
                        </div>
                    </div>

                    <!-- Provider -->
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 ${m.selected_provider ? 'bg-green-100' : 'bg-slate-100'} rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 ${m.selected_provider ? 'text-green-600' : 'text-slate-400'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-slate-900">Provider</div>
                            <div class="text-sm text-slate-600">
                                ${m.selected_provider ? 
                                    (m.selected_provider.first_name + ' ' + m.selected_provider.last_name) : 
                                    '<span class="italic text-slate-400">Not assigned</span>'
                                }
                            </div>
                            <div class="text-xs text-slate-500">${m.selected_provider?.email || ''}</div>
                        </div>
                    </div>
                </div>
            `;

            // Financial Summary
            document.getElementById('financialSummary').innerHTML = `
                <div class="space-y-4">
                    <div class="bg-slate-50 rounded-lg p-4">
                        <div class="text-sm font-medium text-slate-700 mb-2">Budget Range</div>
                        <div class="text-lg font-semibold text-slate-900">
                            ${formatCurrency(m.budget_min, m.budget_currency)} - ${formatCurrency(m.budget_max, m.budget_currency)}
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-200">
                        <span class="text-sm text-slate-600">Payment Status</span>
                        <span class="text-sm font-medium ${
                            m.payment_status === 'paid' ? 'text-green-700' :
                            m.payment_status === 'pending' ? 'text-amber-700' :
                            'text-slate-700'
                        }">
                            ${m.payment_status ? m.payment_status.charAt(0).toUpperCase() + m.payment_status.slice(1) : 'Unknown'}
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-slate-600">Total Transactions</span>
                        <span class="text-sm font-medium text-slate-900">${(m.transactions || []).length}</span>
                    </div>
                </div>
            `;

            // Timeline
            document.getElementById('timeline').innerHTML = `
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 h-6 w-6 bg-blue-100 rounded-full flex items-center justify-center">
                            <div class="h-2 w-2 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-slate-900">Mission Created</div>
                            <div class="text-xs text-slate-500">${formatDate(m.created_at, { hour: '2-digit', minute: '2-digit' })}</div>
                        </div>
                    </div>
                    ${m.selected_provider ? `
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 h-6 w-6 bg-green-100 rounded-full flex items-center justify-center">
                                <div class="h-2 w-2 bg-green-600 rounded-full"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-slate-900">Provider Assigned</div>
                                <div class="text-xs text-slate-500">${m.selected_provider.first_name} ${m.selected_provider.last_name}</div>
                            </div>
                        </div>
                    ` : ''}
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 h-6 w-6 bg-slate-100 rounded-full flex items-center justify-center">
                            <div class="h-2 w-2 bg-slate-400 rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-slate-900">Last Updated</div>
                            <div class="text-xs text-slate-500">${formatDate(m.updated_at, { hour: '2-digit', minute: '2-digit' })}</div>
                        </div>
                    </div>
                </div>
            `;

            // Transaction History
            const transactions = m.transactions || [];
            if (transactions.length === 0) {
                document.getElementById('transactionHistory').innerHTML = `
                    <div class="text-center py-8">
                        <svg class="h-12 w-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-sm text-slate-500">No transactions recorded</p>
                        <p class="text-xs text-slate-400 mt-1">Transaction history will appear here once payments are processed</p>
                    </div>
                `;
            } else {
                const transactionRows = transactions.map(t => `
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-slate-900">#${t.id}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-slate-900">${formatCurrency(t.amount_paid, m.budget_currency)}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${
                                t.status === 'completed' ? 'bg-green-100 text-green-800' :
                                t.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                'bg-slate-100 text-slate-800'
                            }">
                                ${t.status ? t.status.charAt(0).toUpperCase() + t.status.slice(1) : 'Unknown'}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-slate-600">${formatDate(t.created_at, { month: 'short', day: 'numeric' })}</div>
                        </td>
                    </tr>
                `).join('');

                document.getElementById('transactionHistory').innerHTML = `
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Amount</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                ${transactionRows}
                            </tbody>
                        </table>
                    </div>
                `;
            }

            // Show content, hide loading
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('missionContent').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading mission details:', error);
            
            // Show error state
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('missionContent').classList.add('hidden');
            document.getElementById('errorState').classList.remove('hidden');
        });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    loadMissionDetails();
});
</script>

<style>
/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Smooth transitions */
.transition-colors {
    transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
}

/* Focus states */
button:focus, a:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Custom scrollbar for tables */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Hover effects for cards */
.bg-white {
    transition: box-shadow 0.15s ease-in-out;
}

/* Enhanced card shadows on hover */
.shadow-sm:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Prose styling for description */
.prose {
    line-height: 1.6;
}

/* Status badge animations */
.inline-flex {
    transition: transform 0.15s ease-in-out;
}

/* Button hover animations */
button {
    transition: all 0.15s ease-in-out;
}

button:hover {
    transform: translateY(-1px);
}

button:active {
    transform: translateY(0);
}

/* Timeline connector lines */
.timeline-connector {
    position: relative;
}

.timeline-connector:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 11px;
    top: 24px;
    width: 2px;
    height: 20px;
    background-color: #e2e8f0;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .grid-cols-1 {
        gap: 1rem;
    }
    
    .space-y-6 > * + * {
        margin-top: 1rem;
    }
}

/* Loading state improvements */
.loading-shimmer {
    background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}
</style>
@endsection