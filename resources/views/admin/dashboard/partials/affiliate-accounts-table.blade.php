@if($referredUsers->count())

<div class="overflow-x-auto">
    
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-gray-600">Name</th>
                <th class="px-4 py-2 text-left text-gray-600">Email</th>
                <th class="px-4 py-2 text-left text-gray-600">Country</th>
                <th class="px-4 py-2 text-left text-gray-600">Role</th>
                <th class="px-4 py-2 text-left text-gray-600">Language</th>
                <th class="px-4 py-2 text-left text-gray-600">Payable</th>
                <th class="px-4 py-2 text-left text-gray-600">Joined</th>
                <th class="px-4 py-2 text-left text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referredUsers as $refUser)
            <tr>
                <td class="px-4 py-2">{{ $refUser->name }}</td>
                <td class="px-4 py-2">{{ $refUser->email }}</td>
                <td class="px-4 py-2">{{ $refUser->country }}</td>
                <td class="px-4 py-2">{{ ucfirst($refUser->user_role) }}</td>
                <td class="px-4 py-2">{{ $refUser->preferred_language }}</td>
                <td class="px-4 py-2">
                    <form method="POST" action="{{ route('admin.users.manage', $user->id) }}" class="flex items-center space-x-2">
                        @csrf
                        @method('PATCH')
                        
                        <input type="hidden" name="edit_payable_user_id" value="{{ $refUser->id }}">
                        <input type="number" step="0.01" name="payable_amount" value="{{ $refUser->pending_affiliate_balance ?? 0 }}" class="w-20 border-gray-300 rounded px-1 py-0.5 text-xs">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">Save</button>
                    </form>
                </td>
                <td class="px-4 py-2">{{ $refUser->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <!-- Retroactive linking -->
                    <form method="POST" action="{{ route('admin.users.manage', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="retroactive_user_id" value="{{ $refUser->id }}">
                        <input type="text" name="new_referrer_id" placeholder="New Referrer Email or ID" class="sm:w-24 md:w-50 border-gray-300 rounded px-1 py-0.5 text-xs">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Reassign</button>
                    </form>
                    <!-- Block affiliate -->
                    <form method="POST" action="{{ route('admin.users.manage', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        
                        @if($refUser->isSuspended())
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">Unblock</button>
                            <input type="hidden" name="unblock_affiliate_user_id" value="{{ $refUser->id }}">
                        @else
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">Block</button>
                            <input type="hidden" name="block_affiliate_user_id" value="{{ $refUser->id }}">
                        @endif
                    </form>
                    <a href="{{ route('admin.users.manage', $refUser->id) }}" 
                        class="inline-flex items-center justify-center w-6 h-6 border border-gray-300 shadow-sm rounded-full text-gray-400 bg-white hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <div class="text-gray-500">No referred accounts found.</div>
@endif
