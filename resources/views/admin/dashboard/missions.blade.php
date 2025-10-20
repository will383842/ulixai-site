@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen w-[1248px] bg-slate-50 py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Service Requests</h1>
                    <p class="mt-1 text-sm text-slate-600">Manage and monitor all platform missions</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="h-2 w-2 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-slate-600">Live Dashboard</span>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <!-- Search Input -->
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="missionSearch" 
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                            placeholder="Search missions..."
                        >
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select 
                            id="missionStatus" 
                            class="appearance-none w-full sm:w-auto pl-4 pr-10 py-2.5 border border-slate-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                        >
                            <option value="">All Statuses</option>
                            <option value="published">Published</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                        <span class="text-slate-600">Active</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="h-2 w-2 bg-yellow-500 rounded-full"></div>
                        <span class="text-slate-600">Pending</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div id="missionsTableWrapper">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200" id="missionsTable">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Mission</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Requester</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Provider</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="missionsTableBody" class="bg-white divide-y divide-slate-200">
                            <!-- AJAX content -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div id="missionsPagination" class="bg-slate-50 px-6 py-4 border-t border-slate-200">
                    <div class="flex items-center justify-center space-x-1">
                        <!-- Pagination buttons will be inserted here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="hidden bg-white rounded-xl shadow-sm border border-slate-200 p-8">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-500 border-t-transparent"></div>
                <span class="ml-3 text-slate-600">Loading missions...</span>
            </div>
        </div>
    </div>
</div>

<script>
function showLoading() {
    document.getElementById('missionsTableWrapper').classList.add('hidden');
    document.getElementById('loadingState').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingState').classList.add('hidden');
    document.getElementById('missionsTableWrapper').classList.remove('hidden');
}

function fetchMissions(page = 1) {
    showLoading();
    
    const search = document.getElementById('missionSearch').value;
    const status = document.getElementById('missionStatus').value;
    
    let url = `/api/admin/missions?page=${page}`;
    if (search) url += `&search=${encodeURIComponent(search)}`;
    if (status) url += `&status=${encodeURIComponent(status)}`;
    
    fetch(url)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('missionsTableBody');
            tbody.innerHTML = '';
            
            if (data.missions.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-slate-500 text-sm">No missions found</p>
                                <p class="text-slate-400 text-xs mt-1">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                `;
            } else {
                data.missions.forEach(m => {
                    const statusConfig = {
                        'completed': { bg: 'bg-emerald-100', text: 'text-emerald-800', dot: 'bg-emerald-500' },
                        'in_progress': { bg: 'bg-amber-100', text: 'text-amber-800', dot: 'bg-amber-500' },
                        'pending': { bg: 'bg-blue-100', text: 'text-blue-800', dot: 'bg-blue-500' },
                        'cancelled': { bg: 'bg-slate-100', text: 'text-slate-800', dot: 'bg-slate-500' }
                    };
                    
                    const config = statusConfig[m.status] || statusConfig['cancelled'];
                    const statusDisplay = m.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                    
                    tbody.innerHTML += `
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900 text-sm">
                                    ${m.title || '(No Title)'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-700">
                                    ${m.requester?.name || '-'}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-700">
                                    ${m.selected_provider_id ? 
                                        (m.selected_provider?.first_name + ' ' + m.selected_provider?.last_name) : 
                                        '<span class="text-slate-400">Unassigned</span>'
                                    }
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-2 w-2 ${config.dot} rounded-full mr-2"></div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ${config.bg} ${config.text}">
                                        ${statusDisplay}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-500">
                                    ${(new Date(m.created_at)).toLocaleDateString('en-US', { 
                                        month: 'short', 
                                        day: 'numeric', 
                                        year: 'numeric' 
                                    })}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="/admin/missions/${m.id}" 
                                       class="inline-flex items-center px-3 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="h-3 w-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <button onclick="deleteMission(${m.id})"
                                            class="inline-flex items-center px-3 py-1.5 border border-red-300 shadow-sm text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                        <svg class="h-3 w-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }
            
            // Enhanced Pagination
            const pag = data.pagination;
            let pagHtml = '';
            
            if (pag.last_page > 1) {
                // Previous button
                if (pag.current_page > 1) {
                    pagHtml += `
                        <button onclick="fetchMissions(${pag.current_page - 1})" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                    `;
                }
                
                // Page numbers
                const startPage = Math.max(1, pag.current_page - 2);
                const endPage = Math.min(pag.last_page, pag.current_page + 2);
                
                if (startPage > 1) {
                    pagHtml += `<button onclick="fetchMissions(1)" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">1</button>`;
                    if (startPage > 2) {
                        pagHtml += `<span class="px-2 py-2 text-slate-400">...</span>`;
                    }
                }
                
                for (let i = startPage; i <= endPage; i++) {
                    pagHtml += `
                        <button onclick="fetchMissions(${i})" 
                                class="px-3 py-2 text-sm font-medium rounded-lg transition-colors ${
                                    i === pag.current_page ? 
                                    'bg-blue-600 text-white shadow-sm' : 
                                    'text-slate-600 hover:text-slate-900 hover:bg-slate-100'
                                }">
                            ${i}
                        </button>
                    `;
                }
                
                if (endPage < pag.last_page) {
                    if (endPage < pag.last_page - 1) {
                        pagHtml += `<span class="px-2 py-2 text-slate-400">...</span>`;
                    }
                    pagHtml += `<button onclick="fetchMissions(${pag.last_page})" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">${pag.last_page}</button>`;
                }
                
                // Next button
                if (pag.current_page < pag.last_page) {
                    pagHtml += `
                        <button onclick="fetchMissions(${pag.current_page + 1})" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                            Next
                            <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    `;
                }
            }
            
            document.getElementById('missionsPagination').innerHTML = pagHtml;
            
            hideLoading();
        })
        .catch(error => {
            console.error('Error fetching missions:', error);
            hideLoading();
            
            const tbody = document.getElementById('missionsTableBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-12">
                        <div class="flex flex-col items-center">
                            <svg class="h-12 w-12 text-red-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-slate-500 text-sm">Failed to load missions</p>
                            <button onclick="fetchMissions()" class="mt-2 text-blue-600 hover:text-blue-700 text-xs">Try again</button>
                        </div>
                    </td>
                </tr>
            `;
        });
}

// Debounced search to avoid too many API calls
let searchTimeout;
document.getElementById('missionSearch').addEventListener('input', () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => fetchMissions(), 300);
});

document.getElementById('missionStatus').addEventListener('change', () => fetchMissions());
function deleteMission(missionId) {
    if (confirm('Are you sure you want to delete this mission? This action cannot be undone.')) {
        fetch(`/admin/missions/${missionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success('Mission deleted successfully');
                fetchMissions(); // Refresh the missions list
            } else {
                toastr.error(data.message || 'Failed to delete mission');
            }
        })
        .catch(error => {
            toastr.error('Failed to delete mission');
        });
    }
}

document.addEventListener('DOMContentLoaded', () => fetchMissions());
</script>

<style>
/* Custom scrollbar for the table */
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

/* Smooth transitions for table rows */
tbody tr {
    transition: background-color 0.15s ease-in-out;
}

/* Focus states for better accessibility */
input:focus, select:focus, button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection