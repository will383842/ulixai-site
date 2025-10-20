@extends('admin.dashboard.index')

@section('admin-content')
<div class="space-y-8">
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Bug Reports Management</h2>


            
            <!-- Tab Navigation -->
            <div class="mt-4 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button id="all-tab" class="tab-button py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                        All Reports
                        <span id="all-count" class="ml-2 bg-blue-100 text-blue-800 py-1 px-2 rounded-full text-xs">{{ count($AllBugReports) }}</span>
                    </button>
                    <button id="resolved-tab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Resolved Reports
                        <span id="resolved-count" class="ml-2 bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">0</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- All Reports Section -->
        <div id="all-reports" class="tab-content">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATE</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DESCRIPTION</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">REPORTER</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SUGGESTIONS</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LANGUAGE</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">COUNTRY</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($AllBugReports as $report)
                            <tr id="row-{{ $report->id }}" class="hover:bg-gray-50 unresolved-row">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $report->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $report->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $report->bug_description }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900">{{ $report->user->name ?? 'Anonymous' }}</div>
                                    
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">{{ $report->suggestions ?? 'No suggestions' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-sm text-gray-900">{{ $report->language }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span id="badge-{{ $report->id }}"
                                          class="status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Not Resolved
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-sm text-gray-900">{{ $report->country }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <button
                                        data-id="{{ $report->id }}"
                                        class="toggle-status inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Resolve
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr id="no-reports-all">
                                <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                                    No bug reports found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Resolved Reports Section -->
        <div id="resolved-reports" class="tab-content hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DATE</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DESCRIPTION</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">REPORTER</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SUGGESTIONS</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LANGUAGE</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">COUNTRY</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RESOLVED ON</th>
                        </tr>
                    </thead>
                    <tbody id="resolved-table-body" class="divide-y divide-gray-100">
                        <tr id="no-resolved-reports">
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                                No resolved reports yet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let resolvedCount = 0;
    
    // Tab functionality
    const allTab = document.getElementById('all-tab');
    const resolvedTab = document.getElementById('resolved-tab');
    const allReports = document.getElementById('all-reports');
    const resolvedReports = document.getElementById('resolved-reports');
    
    allTab.addEventListener('click', () => {
        // Switch to All Reports tab
        allTab.className = 'tab-button py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600';
        resolvedTab.className = 'tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300';
        
        allReports.classList.remove('hidden');
        resolvedReports.classList.add('hidden');
    });
    
    resolvedTab.addEventListener('click', () => {
        // Switch to Resolved Reports tab
        resolvedTab.className = 'tab-button py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600';
        allTab.className = 'tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300';
        
        resolvedReports.classList.remove('hidden');
        allReports.classList.add('hidden');
    });
    
    // Resolve functionality
    document.querySelectorAll('.toggle-status').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const badge = document.getElementById(`badge-${id}`);
            const row = document.getElementById(`row-${id}`);
            
            if (badge.textContent.trim() === 'Not Resolved') {
                // Update status
                badge.textContent = 'Resolved';
                badge.className = "status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800";
                btn.textContent = 'Resolved';
                btn.className = "toggle-status inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300";
                btn.disabled = true;
                
                // Clone row for resolved section
                const clonedRow = row.cloneNode(true);
                clonedRow.id = `resolved-${id}`;
                clonedRow.classList.remove('unresolved-row');
                clonedRow.classList.add('resolved-row');
                
                // Update the resolved date column
                const cells = clonedRow.querySelectorAll('td');
                cells[7].innerHTML = `
                    <div class="text-sm font-medium text-gray-900">${new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</div>
                    <div class="text-xs text-gray-500">${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</div>
                `;
                
                // Add to resolved table
                const resolvedTableBody = document.getElementById('resolved-table-body');
                const noResolvedReports = document.getElementById('no-resolved-reports');
                
                if (noResolvedReports) {
                    noResolvedReports.remove();
                }
                
                resolvedTableBody.appendChild(clonedRow);
                
                // Update counts
                resolvedCount++;
                document.getElementById('resolved-count').textContent = resolvedCount;
                
               
                
                // Hide row from all reports (optional - you can remove this if you want to keep it visible)
                // row.style.display = 'none';
            }
        });
    });
});
</script>
@endsection