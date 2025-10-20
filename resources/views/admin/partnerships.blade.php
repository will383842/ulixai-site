@extends('admin.dashboard.index')

@section('admin-content')

<div class="bg-white rounded-lg shadow-sm">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center space-x-2">
            <div class="w-5 h-5 border border-gray-400 rounded"></div>
            <h2 class="text-lg font-medium text-gray-900">Partnership Requests</h2>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Date</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Applicant</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Country</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Phone</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Language</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Sector</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Type</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Time</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Source</th>
                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Motivation</th>
                  
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($partnerships as $partnership)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($partnership->created_at)->format('M') }}<br>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($partnership->created_at)->format('d, Y') }}</span><br>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($partnership->created_at)->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $partnership->first_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->country }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->language_spoken }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->sector_of_activity }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->partnership_type }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->preferred_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->how_heard_about }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $partnership->motivation }}</div>
                        </td>
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection