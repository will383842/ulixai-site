@extends('admin.dashboard.index')

@section('admin-content')


<div class="min-h-screen bg-gray-50">
    <div class="mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-bold text-gray-900">Fake Content Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage fake requesters, providers, and missions for testing purposes</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Create Content Cards -->
        <div class="mb-10">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('admin.fake-content.create-requester-form') }}" 
                   class="group relative bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 hover:border-blue-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Create Fake Requester</h3>
                            <p class="mt-1 text-sm text-gray-500">Add new test requester</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.fake-content.create-provider-form') }}" 
                   class="group relative bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 hover:border-blue-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Create Fake Provider</h3>
                            <p class="mt-1 text-sm text-gray-500">Add new test provider</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.fake-content.create-mission-form') }}" 
                   class="group relative bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 hover:border-blue-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600">Create Fake Mission</h3>
                            <p class="mt-1 text-sm text-gray-500">Add new test mission</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Fake Requesters Section -->
        <div class="mb-10">
            <div class="sm:flex sm:items-center mb-6">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Fake Requesters</h2>
                    <p class="mt-2 text-sm text-gray-700">A list of all fake requesters in your system.</p>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors" id="requester-row-{{ $user->id }}">
                                <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'requester', 'id' => $user->id]) }}">
                                    @csrf
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="name" value="{{ $user->name }}" 
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="email" value="{{ $user->email }}" 
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="status" 
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                Update
                                            </button>
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors ajax-delete-btn"
                                                    data-type="requester"
                                                    data-id="{{ $user->id }}">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Fake Providers Section -->
        <div class="mb-10">
            <div class="sm:flex sm:items-center mb-6">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Fake Providers</h2>
                    <p class="mt-2 text-sm text-gray-700">A list of all fake providers in your system.</p>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($providers as $provider)
                            <tr class="hover:bg-gray-50 transition-colors" id="provider-row-{{ $provider->id }}">
                                <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'provider', 'id' => $provider->id]) }}">
                                    @csrf
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $provider->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <input name="first_name" value="{{ $provider->first_name }}" 
                                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                                   placeholder="First Name">
                                            <input name="last_name" value="{{ $provider->last_name }}" 
                                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                                   placeholder="Last Name">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="country" value="{{ $provider->country }}" 
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="points" value="{{ $provider->points }}" type="number"
                                               class="block w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="status" 
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="active" {{ $provider->user->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="suspended" {{ $provider->user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                Update
                                            </button>
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors ajax-delete-btn"
                                                    data-type="provider"
                                                    data-id="{{ $provider->id }}">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Fake Missions Section -->
        <div class="mb-10">
            <div class="sm:flex sm:items-center mb-6">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Fake Missions</h2>
                    <p class="mt-2 text-sm text-gray-700">A list of all fake missions in your system.</p>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($missions as $mission)
                            <tr class="hover:bg-gray-50 transition-colors" id="mission-row-{{ $mission->id }}">
                                <form method="POST" action="{{ route('admin.fake-content.update', ['type' => 'mission', 'id' => $mission->id]) }}">
                                    @csrf
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $mission->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="title" value="{{ $mission->title }}" 
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mission->requester_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input name="location_country" value="{{ $mission->location_country }}" 
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="status" 
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="published" {{ $mission->status == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="in_progress" {{ $mission->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $mission->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $mission->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                Update
                                            </button>
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors ajax-delete-btn"
                                                    data-type="mission"
                                                    data-id="{{ $mission->id }}">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ajax-delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm('Delete this ' + btn.dataset.type + '?')) return;
            const type = btn.dataset.type;
            const id = btn.dataset.id;
            fetch("{{ url('admin/fake-content-generation') }}/" + type + "/" + id + "/delete", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Content Removed Successfully', 'Success');
                    document.getElementById(type + '-row-' + id).remove();
                } else {
                    alert(data.message || 'Failed to delete.');
                }
            })
            .catch(() => alert('Failed to delete.'));
        });
    });
});
</script>