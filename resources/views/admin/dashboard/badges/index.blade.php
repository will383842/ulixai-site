@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Badge Management</h1>
            <p class="text-gray-600 mt-1">Create and manage user badges and achievements</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $badges->count() }} Total Badges
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Badge Form -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Create New Badge</h2>
            <p class="text-gray-600 text-sm mt-1">Add a new badge to the system</p>
        </div>
        
        <form method="POST" action="{{ route('admin.badges') }}" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Title -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input name="title" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           placeholder="Enter badge title" 
                           required>
                </div>

                <!-- Slug -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input name="slug" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           placeholder="auto-generated-slug">
                </div>

                <!-- Icon -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                    <input name="icon" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           placeholder="icon.svg">
                </div>

                <!-- Type -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                    <select name="type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                            required>
                        <option value="reputation" selected>Reputation</option>
                        <option value="achievement">Achievement</option>
                        <option value="special">Special</option>
                        <option value="milestone">Milestone</option>
                    </select>
                </div>

                <!-- Threshold -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Threshold</label>
                    <input name="threshold" 
                           type="number" 
                           min="0"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           placeholder="0">
                </div>

                <!-- Sort Order -->
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input name="sort_order" 
                           type="number" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           placeholder="0" 
                           value="0">
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="flex flex-wrap gap-6 mt-6 pt-6 border-t border-gray-200">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           checked
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Active Badge</span>
                </label>
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" 
                           name="is_auto" 
                           value="1"
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="text-sm font-medium text-gray-700">Auto-Award</span>
                </label>
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="inline-flex items-center px-3 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Create Badge</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Badge List -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Existing Badges</h2>
            <p class="text-gray-600 text-sm mt-1">Manage your current badges</p>
        </div>
        
        @if($badges->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Badge</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($badges as $badge)
                        <tr class="hover:bg-gray-50 transition-colors duration-150" data-badge-id="{{ $badge->id }}">
                            <form method="POST" action="{{ route('admin.badges') }}" class="contents badge-form">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $badge->id }}">
                                
                                <td class="px-6 py-4">
                                    <div class="space-y-3">
                                        <input name="title" 
                                               value="{{ $badge->title }}" 
                                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <input name="slug" 
                                               value="{{ $badge->slug }}" 
                                               placeholder="Slug"
                                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="space-y-3">
                                        <input name="icon" 
                                               value="{{ $badge->icon }}" 
                                               placeholder="Icon"
                                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <div class="grid grid-cols-2 gap-2">
                                            <select name="type" 
                                                    class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="reputation" {{ $badge->type === 'reputation' ? 'selected' : '' }}>Reputation</option>
                                                <option value="achievement" {{ $badge->type === 'achievement' ? 'selected' : '' }}>Achievement</option>
                                                <option value="special" {{ $badge->type === 'special' ? 'selected' : '' }}>Special</option>
                                                <option value="milestone" {{ $badge->type === 'milestone' ? 'selected' : '' }}>Milestone</option>
                                            </select>
                                            <input name="threshold" 
                                                   type="number" 
                                                   value="{{ $badge->threshold }}" 
                                                   placeholder="Threshold"
                                                   class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="space-y-3">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ $badge->is_active ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <span class="text-sm text-gray-700">Active</span>
                                        </label>
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" 
                                                   name="is_auto" 
                                                   value="1" 
                                                   {{ $badge->is_auto ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <span class="text-sm text-gray-700">Auto</span>
                                        </label>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-2">
                                        <button type="submit" 
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-xs font-medium transition-colors duration-200 flex items-center justify-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                            <span>Update</span>
                                        </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.badges') }}" onsubmit="return confirm('Are you sure you want to delete this badge? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $badge->id }}">
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-xs font-medium transition-colors duration-200 flex items-center justify-center space-x-1 w-full">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </form>
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden divide-y divide-gray-200">
                @foreach($badges as $badge)
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">{{ $badge->title }}</h3>
                        <div class="flex space-x-1">
                            @if($badge->is_active)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                            @endif
                            @if($badge->is_auto)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Auto</span>
                            @endif
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('admin.badges') }}" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $badge->id }}">
                        
                        <div class="grid grid-cols-2 gap-3">
                            <input name="title" value="{{ $badge->title }}" placeholder="Title" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <input name="slug" value="{{ $badge->slug }}" placeholder="Slug" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <input name="icon" value="{{ $badge->icon }}" placeholder="Icon" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <select name="type" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                                <option value="reputation" {{ $badge->type === 'reputation' ? 'selected' : '' }}>Reputation</option>
                                <option value="achievement" {{ $badge->type === 'achievement' ? 'selected' : '' }}>Achievement</option>
                                <option value="special" {{ $badge->type === 'special' ? 'selected' : '' }}>Special</option>
                                <option value="milestone" {{ $badge->type === 'milestone' ? 'selected' : '' }}>Milestone</option>
                            </select>
                            <input name="threshold" type="number" value="{{ $badge->threshold }}" placeholder="Threshold" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                        </div>
                        
                        <div class="flex space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="is_active" value="1" {{ $badge->is_active ? 'checked' : '' }} class="rounded">
                                <span class="text-sm">Active</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="is_auto" value="1" {{ $badge->is_auto ? 'checked' : '' }} class="rounded">
                                <span class="text-sm">Auto</span>
                            </label>
                        </div>
                        
                        <div class="flex space-x-3 pt-2">
                            <button type="submit" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-medium">Update</button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.badges') }}" onsubmit="return confirm('Delete this badge?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $badge->id }}">
                        <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-md text-sm font-medium">Delete</button>
                    </form>
                        </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No badges</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new badge.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Custom focus styles for better UX */
.badge-form input:focus,
.badge-form select:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Smooth transitions */
* {
    transition: all 0.2s ease-in-out;
}

/* Hover effects */
.badge-form:hover {
    background-color: rgba(249, 250, 251, 0.5);
}
</style>

<script>
// Auto-generate slug from title
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            if (!slugInput.value || slugInput.placeholder.includes('auto-generated')) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });
    }
    
    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('input[name="title"]');
            if (title && !title.value.trim()) {
                e.preventDefault();
                alert('Please enter a badge title');
                title.focus();
            }
        });
    });
});
</script>
@endsection