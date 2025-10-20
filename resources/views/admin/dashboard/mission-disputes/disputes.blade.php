@extends('admin.dashboard.index')

@section('admin-content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Disputed Missions</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all disputed missions that require admin review.</p>
        </div>
    </div>
    
    <div class="mt-8 flex flex-col">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Mission ID</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Requester</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Provider</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Dispute Reason</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cancelled By</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($disputes as $dispute)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">{{ $dispute->id }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $dispute->title }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $dispute->requester->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ optional($dispute->selectedProvider->user)->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $dispute->transactions->where('status', 'paid')->first()->amount_paid ?? 'N/A' }} €</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $dispute->cancellationReasons->first()->custum_description ?? $dispute->cancellationReasons->first()->reason }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ ucfirst($dispute->cancelled_by) }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <button class="transfer-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" 
                                                data-mission-id="{{ $dispute->id }}"
                                                data-provider-id="{{ $dispute->selected_provider_id }}">
                                            Transfer to Provider
                                        </button>
                                        <button class="refund-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                data-mission-id="{{ $dispute->id }}">
                                            Refund to Requester
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.refund-btn').click(function() {
        if (confirm('Are you sure you want to refund this amount to the requester?')) {
            const missionId = $(this).data('mission-id');
            $.ajax({
                url: '/admin/disputes/refund',
                method: 'POST',
                data: {
                    mission_id: missionId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    toastr.error('Error: ' + xhr.responseJSON.message);
                }
            });
        }
    });

    $('.transfer-btn').click(function() {
        if (confirm('Are you sure you want to transfer this amount to the provider?')) {
            const missionId = $(this).data('mission-id');
            const providerId = $(this).data('provider-id');
            $.ajax({
                url: '/admin/disputes/transfer',
                method: 'POST',
                data: {
                    mission_id: missionId,
                    provider_id: providerId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    toastr.error('Error: ' + xhr.responseJSON.message);
                }
            });
        }
    });
});
</script>
@endsection