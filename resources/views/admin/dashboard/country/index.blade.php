@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Country Management</h2>
                <p class="mt-2 text-gray-600">Enable or disable countries for the platform</p>
            </div>

            <!-- Add Search Form -->
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <form action="{{ route('admin.countries.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1 max-w-lg">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ $search }}"
                                   placeholder="Search by country name or code..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Search
                    </button>
                    @if($search)
                        <a href="{{ route('admin.countries.index') }}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Add Search Results Summary if searching -->
            @if($search)
                <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                    <p class="text-sm text-blue-700">
                        Found {{ $countries->total() }} results for "{{ $search }}"
                    </p>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($countries as $country)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $country->country }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $country->short_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $country->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $country->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button onclick="toggleCountryStatus({{ $country->id }}, this)" 
                                    class="toggle-button inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md {{ $country->status ? 'text-red-700 bg-red-100 hover:bg-red-200' : 'text-green-700 bg-green-100 hover:bg-green-200' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ $country->status ? 'Disable' : 'Enable' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Add pagination links -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $countries->links() }}
            </div>
        </div>
    </div>
</div>

<script>
function toggleCountryStatus(countryId, button) {
    fetch(`/admin/countries/${countryId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const isActive = data.status;
            const statusSpan = button.closest('tr').querySelector('.rounded-full');
            const toggleButton = button;

            // Update status badge
            statusSpan.className = `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            statusSpan.textContent = isActive ? 'Active' : 'Inactive';

            // Update button
            toggleButton.className = `toggle-button inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md ${isActive ? 'text-red-700 bg-red-100 hover:bg-red-200' : 'text-green-700 bg-green-100 hover:bg-green-200'} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500`;
            toggleButton.textContent = isActive ? 'Disable' : 'Enable';
        }
    });
}
</script>
@endsection