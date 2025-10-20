@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Roles & Permissions</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create New Admin Form (Only for Super Admin) -->
    @if(auth()->user()->user_role === 'super_admin')
    <div class="bg-white rounded shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Create New Admin</h2>
        <form id="createAdminForm" method="POST"  class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Enter full name"
                       required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Enter email address"
                       required>
            </div>
            
            <div>
                <label for="user_role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select id="user_role" 
                        name="user_role" 
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Select Role</option>
                    <option value="regional_admin" {{ old('user_role') == 'regional_admin' ? 'selected' : '' }}>Regional Admin</option>
                    <option value="moderator" {{ old('user_role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                    <option value="super_admin" {{ old('user_role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Enter password"
                       required>
            </div>
            
            <div class="md:col-span-2 lg:col-span-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded text-sm font-medium transition-colors">
                    <i class="fas fa-plus mr-1"></i> Create Admin
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Existing Admins Table -->
    <div class="bg-white rounded shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold">Existing Admins</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $admin->email }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $roleColors = [
                                    'super_admin' => 'bg-purple-100 text-purple-800',
                                    'regional_admin' => 'bg-blue-100 text-blue-800',
                                    'moderator' => 'bg-yellow-100 text-yellow-800'
                                ];
                                $roleColor = $roleColors[$admin->user_role] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $roleColor }}">
                                {{ ucfirst(str_replace('_', ' ', $admin->user_role)) }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if(auth()->user()->user_role === 'super_admin' || (auth()->user()->user_role === 'regional_admin' && $admin->user_role === 'moderator'))
                                <!-- Update Role Form -->
                                <form method="POST" data-admin-id="{{ $admin->id }}" class="inline-block mr-2 assignRoleForm">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <select name="user_role" class="border border-gray-300 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            @if(auth()->user()->user_role === 'super_admin')
                                                <option value="super_admin" {{ $admin->user_role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                            @endif
                                            <option value="regional_admin" {{ $admin->user_role == 'regional_admin' ? 'selected' : '' }}>Regional Admin</option>
                                            <option value="moderator" {{ $admin->user_role == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                        </select>
                                        
                                        <input type="password" 
                                               name="password" 
                                               placeholder="New Password (optional)" 
                                               class="border border-gray-300 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-blue-500" />
                                        
                                        <button type="submit" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs transition-colors">
                                            Update
                                        </button>
                                    </div>
                                </form>
                                
                                <!-- Revoke Role Button -->
                                @if($admin->user_role !== 'super_admin' && $admin->id !== auth()->user()->id)
                                <form method="POST"  data-admin-id="{{ $admin->id }}"  class="revokeRoleForm inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition-colors" 
                                            onclick="return confirm('Are you sure you want to revoke this admin role? This action cannot be undone.')">
                                        <i class="fas fa-trash mr-1"></i> Revoke
                                    </button>
                                </form>
                                @endif
                            @else
                                <span class="text-gray-400 text-xs">No permissions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No admins found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Role Permissions Info -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-3">Role Permissions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="bg-white p-4 rounded border-l-4 border-purple-500">
                <h4 class="font-semibold text-purple-700 mb-2">Super Admin</h4>
                <ul class="text-gray-600 space-y-1">
                    <li>• Full system access</li>
                    <li>• Create/manage all admins</li>
                    <li>• System configuration</li>
                    <li>• All content management</li>
                </ul>
            </div>
            
            <div class="bg-white p-4 rounded border-l-4 border-blue-500">
                <h4 class="font-semibold text-blue-700 mb-2">Regional Admin</h4>
                <ul class="text-gray-600 space-y-1">
                    <li>• Regional content management</li>
                    <li>• Create/manage moderators</li>
                    <li>• User management in region</li>
                    <li>• Regional reports</li>
                </ul>
            </div>
            
            <div class="bg-white p-4 rounded border-l-4 border-yellow-500">
                <h4 class="font-semibold text-yellow-700 mb-2">Moderator</h4>
                <ul class="text-gray-600 space-y-1">
                    <li>• Content moderation</li>
                    <li>• User support</li>
                    <li>• Basic reports</li>
                    <li>• Limited user actions</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Helper: Show a toast notification
    function showToast(msg, type = 'success') {
        let toast = document.createElement('div');
        toast.className = `fixed top-5 right-5 z-50 bg-${type === 'success' ? 'green' : 'red'}-600 text-white px-4 py-2 rounded-lg shadow mb-2`;
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    }

    // CREATE ADMIN AJAX
    const createAdminForm = document.getElementById('createAdminForm');
    if (createAdminForm) {
        createAdminForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(createAdminForm);
            fetch('{{ route("admin.roles-permissions.create") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Admin created successfully!', 'success');
                    setTimeout(() => window.location.reload(), 1200); // Or dynamically add row to table
                } else {
                    showToast('Error: ' + (data.error || 'Validation failed.'), 'error');
                }
            })
            .catch(err => showToast('Error: ' + err, 'error'));
        });
    }

    // ASSIGN ROLE AJAX
    document.querySelectorAll('.assignRoleForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const adminId = form.getAttribute('data-admin-id');
            const formData = new FormData(form);
            fetch(`/admin/roles-permissions/${adminId}/assign`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Role updated!', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Error: ' + (data.error || 'Validation failed.'), 'error');
                }
            })
            .catch(err => showToast('Error: ' + err, 'error'));
        });
    });

    // REVOKE ROLE AJAX
    document.querySelectorAll('.revokeRoleForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to revoke this admin role? This action cannot be undone.')) return;
            const adminId = form.getAttribute('data-admin-id');
            fetch(`/admin/roles-permissions/${adminId}/revoke`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Role revoked!', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Error: ' + (data.error || 'Validation failed.'), 'error');
                }
            })
            .catch(err => showToast('Error: ' + err, 'error'));
        });
    });
});
</script>
