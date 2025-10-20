@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage all users and their access permissions</p>
                </div>
                <div>
                    <a href="{{ route('admin.w-map-view') }}" class="text-white bg-blue-400 rounded-2xl p-2 hover:bg-blue-500">Ulysse World Map</a>
                </div>
                @if(session('admin_id'))
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                    <form method="POST" action="{{ route('admin.restore-admin') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Return to Admin
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button class="user-filter-btn py-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm whitespace-nowrap focus:outline-none"  data-role="all">
                            <div class="flex items-center space-x-2">
                                <span>Users</span>
                            </div>
                        </button>
                        <button class="user-filter-btn py-4 px-1 text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                                data-role="service_provider">
                            <div class="flex items-center space-x-2">
                                <span>Providers</span>
                            </div>
                        </button>
                        <button class="user-filter-btn py-4 px-1 text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap focus:outline-none"
                                data-role="service_requester"
                            <div class="flex items-center space-x-2">
                                <span>Requesters</span>
                            </div>
                        </button>
                    </nav>
                    <div class="mt-2 sm:mt-0 text-sm text-gray-500">
                        Total: <span id="userCount">{{ $users->total() }}</span> users
                    </div>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joined
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <!-- User Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            <div class="text-xs text-gray-400">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Role -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        {{ $user->user_role == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                           ($user->user_role == 'service_provider' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->user_role)) }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full
                                            {{ $user->status == 'active' ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>

                                <!-- Joined Date -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Secret Login Button -->
                                        <form method="POST" action="{{ route('admin.secret-login', $user->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                                    title="Login as this user">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                                Login
                                            </button>
                                        </form>

                                        <!-- Manage User Button -->
                                        <a href="{{ route('admin.users.manage', $user->id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 border border-gray-300 shadow-sm rounded-full text-gray-400 bg-white hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                           title="Manage User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                            </svg>
                                        </a>

                                        <!-- Pin/Unpin Service Provider Button -->
                                        @php
                                            $provider = \App\Models\ServiceProvider::where('user_id', $user->id)->first();
                                        @endphp
                                        @if($provider)
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 border border-gray-300 shadow-sm rounded-full
                                                {{ $provider->pinned ? 'bg-yellow-200 text-yellow-700' : 'bg-white text-gray-400' }}
                                                hover:bg-yellow-100 hover:text-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition-colors duration-200"
                                            title="{{ $provider->pinned ? 'Unpin Provider' : 'Pin Provider' }}"
                                            onclick="togglePinProvider({{ $provider->id }}, this)">
                                            <svg class="w-4 h-4" fill="{{ $provider->pinned ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13 21.314V13H11v8.314l-4.657-4.657a8 8 0 1111.314 0z" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden">
                <div class="space-y-4 p-4">
                    @foreach($users as $user)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 truncate">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Role</div>
                                    <div class="mt-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                            {{ $user->user_role == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                               ($user->user_role == 'service_provider' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->user_role)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</div>
                                    <div class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <div class="text-xs text-gray-500">ID: {{ $user->id }}</div>
                                <div class="flex items-center space-x-2">
                                    <!-- Secret Login Button -->
                                    <form method="POST" action="{{ route('admin.secret-login', $user->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                            </svg>
                                            Login
                                        </button>
                                    </form>

                                    <!-- Manage User Button -->
                                    <a href="{{ route('admin.users.manage', $user->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 border border-gray-300 shadow-sm rounded-full text-gray-400 bg-white hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Empty State -->
            @if($users->count() == 0)
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                    <p class="mt-1 text-sm text-gray-500">No users have been registered yet.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($users->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">
                            Previous
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                    @endif

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">
                            Next
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $users->firstItem() }}</span> to <span class="font-medium">{{ $users->lastItem() }}</span> of <span class="font-medium">{{ $users->total() }}</span> results
                        </p>
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.user-filter-btn');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const role = this.getAttribute('data-role');
            filterButtons.forEach(b => b.classList.remove('border-b-2', 'border-blue-500'));
            this.classList.add('border-b-2', 'border-blue-500');
            filterUserRows(role);
        });
    });

    function filterUserRows(role) {
        const rows = document.querySelectorAll('tbody tr');
        let count = 0;
        rows.forEach(row => {
            const userRole = row.querySelector('td:nth-child(2) span')?.textContent?.trim().toLowerCase() || '';
            if (role === 'all') {
                row.style.display = '';
                count++;
            } else if (role === 'service_provider' && userRole.includes('provider')) {
                row.style.display = '';
                count++;
            } else if (role === 'service_requester' && userRole.includes('requester')) {
                row.style.display = '';
                count++;
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('userCount').textContent = count;
    }
    // Default: show all users
    filterUserRows('all');
});

function togglePinProvider(providerId, btn) {
    btn.disabled = true;
    fetch('/api/admin/provider/' + providerId + '/toggle-pin', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Toggle button color/icon
            if (data.pinned) {
                btn.classList.add('bg-yellow-200', 'text-yellow-700');
                btn.classList.remove('bg-white', 'text-gray-400');
                btn.title = 'Unpin Provider';
                btn.querySelector('svg').setAttribute('fill', 'currentColor');
            } else {
                btn.classList.remove('bg-yellow-200', 'text-yellow-700');
                btn.classList.add('bg-white', 'text-gray-400');
                btn.title = 'Pin Provider';
                btn.querySelector('svg').setAttribute('fill', 'none');
            }
        } else {
            alert('Failed to update pin status');
        }
    })
    .catch(() => alert('Failed to update pin status'))
    .finally(() => { btn.disabled = false; });
}
</script>
@endsection