@extends('admin.dashboard.index')

@section('admin-content')

<div class="min-h-screen bg-gray-50">
    <div class="mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-bold text-gray-900">Category Management</h1>
                    <p class="mt-1 text-sm text-gray-500">Organize and manage your category hierarchy efficiently</p>
                </div>
                <div class="mt-4 md:mt-0 md:ml-4 flex gap-3">
                    <button onclick="toggleCompactView()" id="compactToggle"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <span id="compactText">Compact View</span>
                    </button>
                    <button onclick="toggleExpandAll()" id="expandAllBtn"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <span id="expandCollapseText">Expand All</span>
                    </button>
                    <button onclick="openCreateModal(1)" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Main Category
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200 animate-fade-in">
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

        <!-- Search and Filter Bar -->
        <div class="mb-6 bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="searchInput" placeholder="Search categories..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               onkeyup="searchCategories()">
                    </div>
                </div>
                <div class="flex gap-2">
                    <select id="levelFilter" onchange="filterByLevel()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Levels</option>
                        <option value="main">Main Categories</option>
                        <option value="sub">Sub Categories</option>
                        <option value="subsub">Sub-Sub Categories</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="mb-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-4">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 category-card">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7l-2 7m-5-6v6m-2-6v6m-3-2l4-4m3 4l-4-4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Main Categories</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ count($mainCategories) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 category-card">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-50">
                                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Sub Categories</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $mainCategories->sum(function($cat) { return $cat->subCategories->count(); }) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 category-card">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-purple-50">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Sub-Sub Categories</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $mainCategories->sum(function($cat) { return $cat->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }); }) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-200 category-card">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-orange-50">
                                    <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Items</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ count($mainCategories) + $mainCategories->sum(function($cat) { return $cat->subCategories->count(); }) + $mainCategories->sum(function($cat) { return $cat->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }); }) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Hierarchy -->
        <div id="categoriesContainer" class="space-y-4">
            @forelse($mainCategories as $index => $mainCategory)
            <div class="category-section bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden category-card animate-fade-in-up" 
                 data-category-id="{{ $mainCategory->id }}" 
                 data-level="main"
                 style="animation-delay: {{ $index * 0.1 }}s;">
                
                <!-- Main Category -->
                <div class="category-item group">
                    <div class="flex items-center justify-between px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors duration-200" onclick="toggleCategory({{ $mainCategory->id }})">
                        <div class="flex items-center space-x-4 flex-1">
                            <div class="flex-shrink-0">
                                <button class="toggle-icon flex items-center justify-center h-6 w-6 rounded transition-transform duration-300" 
                                        id="toggle-icon-{{ $mainCategory->id }}">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-shrink-0">
                                @if($mainCategory->icon_image)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset($mainCategory->icon_image) }}" alt="{{ $mainCategory->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                                    </div>
                                @else
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white shadow-sm">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 category-name">{{ $mainCategory->name }}</h4>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 mt-1">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                        {{ $mainCategory->subCategories->count() }} subcategories
                                    </span>
                                    @if($mainCategory->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }) > 0)
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        {{ $mainCategory->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }) }} sub-subcategories
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mr-4">
                            <select 
                                onchange="updateCategoryOrder({{ $mainCategory->id }}, this.value)"
                                class="block w-20 text-sm text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            >
                                @for($i = 0; $i <= count($mainCategories); $i++)
                                    <option value="{{ $i }}" {{ $mainCategory->sort_order == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="action-buttons flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-all duration-200">
                            <button onclick="event.stopPropagation(); openCreateModal(2, {{ $mainCategory->id }})" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Sub
                            </button>
                            <button onclick="event.stopPropagation(); openEditModal({{ $mainCategory->id }}, '{{ $mainCategory->name }}')" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button onclick="event.stopPropagation(); deleteCategory({{ $mainCategory->id }})" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sub Categories -->
                <div class="subcategories bg-gray-50" id="subcategories-{{ $mainCategory->id }}" data-level="sub">
                    @if($mainCategory->subCategories->count() > 0)
                    <div class="px-6 py-3 space-y-2">
                        @foreach($mainCategory->subCategories as $subCategory)
                        <div class="category-item group bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all duration-200" data-level="sub">
                            <div class="flex items-center justify-between px-4 py-3">
                                <div class="flex items-center space-x-3 flex-1 cursor-pointer" onclick="toggleSubCategory({{ $subCategory->id }})">
                                    @if($subCategory->subSubCategories->count() > 0)
                                    <div class="flex-shrink-0">
                                        <button class="toggle-icon flex items-center justify-center h-5 w-5 rounded transition-transform duration-300" id="toggle-icon-sub-{{ $subCategory->id }}">
                                            <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>
                                    @else
                                    <div class="flex-shrink-0 w-5"></div>
                                    @endif
                                    <div class="flex-shrink-0">
                                        @if($subCategory->icon_image)
                                            <img src="{{ asset($subCategory->icon_image) }}" alt="{{ $subCategory->name }}" class="h-8 w-8 rounded-full object-cover ring-2 ring-white shadow-sm">
                                        @else
                                            <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-br from-green-400 to-green-600 text-white shadow-sm">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h5 class="font-medium text-gray-800 category-name">{{ $subCategory->name }}</h5>
                                        <p class="text-xs text-gray-500">{{ $subCategory->subSubCategories->count() }} sub-subcategories</p>
                                    </div>
                                </div>
                                <div class="flex items-center mr-4">
                                    <select 
                                        onchange="updateCategoryOrder({{ $subCategory->id }}, this.value)"
                                        class="block w-16 text-sm text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        @for($i = 0; $i <= $mainCategory->subCategories->count(); $i++)
                                            <option value="{{ $i }}" {{ $subCategory->sort_order == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="action-buttons flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                    <button onclick="event.stopPropagation(); openCreateModal(3, {{ $subCategory->id }})" 
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Sub-Sub
                                    </button>
                                    <button onclick="event.stopPropagation(); openEditModal({{ $subCategory->id }}, '{{ $subCategory->name }}')" 
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-green-700 bg-green-50 hover:bg-green-100 transition-colors">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button onclick="event.stopPropagation(); deleteCategory({{ $subCategory->id }})" 
                                            class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-red-700 bg-red-50 hover:bg-red-100 transition-colors">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <!-- Sub-Sub Categories -->
                            @if($subCategory->subSubCategories->count() > 0)
                            <div class="sub-subcategories bg-gray-25" id="subcategories-sub-{{ $subCategory->id }}" data-level="subsub">
                                <div class="px-4 pb-3 space-y-1">
                                    @foreach($subCategory->subSubCategories as $subSubCategory)
                                    <div class="category-item group flex items-center justify-between py-2 px-3 rounded hover:bg-white transition-colors duration-200" data-level="subsub">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="h-2 w-2 rounded-full bg-purple-400"></div>
                                            </div>
                                            <span class="text-sm text-gray-700 category-name">{{ $subSubCategory->name }}</span>
                                        </div>
                                        <div class="flex items-center mr-4">
                                            <select 
                                                onchange="updateCategoryOrder({{ $subSubCategory->id }}, this.value)"
                                                class="block w-16 text-sm text-center border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            >
                                                @for($i = 0; $i <= $subCategory->subSubCategories->count(); $i++)
                                                    <option value="{{ $i }}" {{ $subSubCategory->sort_order == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="action-buttons flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                            <button onclick="openEditModal({{ $subSubCategory->id }}, '{{ $subSubCategory->name }}')" 
                                                    class="p-1 text-green-600 hover:bg-green-50 rounded transition-colors">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button onclick="deleteCategory({{ $subSubCategory->id }})" 
                                                    class="p-1 text-red-600 hover:bg-red-50 rounded transition-colors">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="text-center py-12">
                    <div class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-gray-100">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7l-2 7m-5-6v6m-2-6v6m-3-2l4-4m3 4l-4-4" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-sm font-medium text-gray-900">No categories</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first main category.</p>
                    <div class="mt-6">
                        <button onclick="openCreateModal(1)" 
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Main Category
                        </button>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modals -->
    @include('admin.dashboard.category.modals')
</div>

<script>
// Global state
let isCompactView = false;
let allExpanded = false;

// Original functions from your code
function openCreateModal(level, parentId = null) {
    document.getElementById('createCategoryLevel').value = level;
    document.getElementById('createCategoryParentId').value = parentId || '';
    document.getElementById('createCategoryModal').classList.remove('hidden');
    
    // Set the title based on level
    const titles = {
        1: 'Create Main Category',
        2: 'Create Sub Category',
        3: 'Create Sub-Sub Category'
    };
    document.getElementById('createModalTitle').textContent = titles[level] || 'Create Category';
    
    // Focus on the input field
    setTimeout(() => {
        document.getElementById('createCategoryName')?.focus();
    }, 100);
}

function closeCreateModal() {
    document.getElementById('createCategoryModal').classList.add('hidden');
    document.getElementById('createCategoryForm').reset();
}

function openEditModal(id, name) {
    document.getElementById('editCategoryId').value = id;
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryModal').classList.remove('hidden');
    document.getElementById('editCategoryForm').action = `/admin/categories/${id}`;
    
    // Focus on the input field and select text
    setTimeout(() => {
        const input = document.getElementById('editCategoryName');
        if (input) {
            input.focus();
            input.select();
        }
    }, 100);
}

function closeEditModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
    document.getElementById('editCategoryForm').reset();
}

function deleteCategory(id) {
    // Create a more professional confirmation dialog
    const confirmed = confirm('Are you sure you want to delete this category?\n\nThis action will permanently delete the category and all of its subcategories. This cannot be undone.');
    
    if (confirmed) {
        const form = document.getElementById('deleteCategoryForm');
        form.action = `/admin/categories/${id}`;
        form.submit();
    }
}

// Enhanced toggle category functionality
function toggleCategory(categoryId) {
    const subcategoriesDiv = document.getElementById(`subcategories-${categoryId}`);
    const toggleIcon = document.getElementById(`toggle-icon-${categoryId}`);
    const svg = toggleIcon.querySelector('svg');
    
    if (!subcategoriesDiv) return;
    
    const isCollapsed = subcategoriesDiv.style.maxHeight === '0px' || !subcategoriesDiv.classList.contains('expanded');
    
    if (isCollapsed) {
        // Expand
        subcategoriesDiv.style.maxHeight = subcategoriesDiv.scrollHeight + 'px';
        subcategoriesDiv.classList.add('expanded');
        toggleIcon.classList.add('rotated');
        
        // Reset max-height after animation completes
        setTimeout(() => {
            if (subcategoriesDiv.classList.contains('expanded')) {
                subcategoriesDiv.style.maxHeight = 'none';
            }
        }, 400);
    } else {
        // Collapse
        subcategoriesDiv.style.maxHeight = subcategoriesDiv.scrollHeight + 'px';
        subcategoriesDiv.offsetHeight; // Force reflow
        subcategoriesDiv.style.maxHeight = '0px';
        subcategoriesDiv.classList.remove('expanded');
        toggleIcon.classList.remove('rotated');
        
        // Also collapse any open sub-subcategories
        const subSubcategories = subcategoriesDiv.querySelectorAll('.sub-subcategories');
        subSubcategories.forEach(subSub => {
            subSub.style.maxHeight = '0px';
            subSub.classList.remove('expanded');
        });
    }
}

// Toggle sub-subcategories
function toggleSubCategory(subCategoryId) {
    const subSubcategoriesDiv = document.getElementById(`subcategories-sub-${subCategoryId}`);
    const toggleIcon = document.getElementById(`toggle-icon-sub-${subCategoryId}`);
    
    if (!subSubcategoriesDiv) return;
    
    const isCollapsed = subSubcategoriesDiv.style.maxHeight === '0px' || !subSubcategoriesDiv.classList.contains('expanded');
    
    if (isCollapsed) {
        // Expand
        subSubcategoriesDiv.style.maxHeight = subSubcategoriesDiv.scrollHeight + 'px';
        subSubcategoriesDiv.classList.add('expanded');
        if (toggleIcon) toggleIcon.classList.add('rotated');
        
        setTimeout(() => {
            if (subSubcategoriesDiv.classList.contains('expanded')) {
                subSubcategoriesDiv.style.maxHeight = 'none';
            }
        }, 400);
    } else {
        // Collapse
        subSubcategoriesDiv.style.maxHeight = subSubcategoriesDiv.scrollHeight + 'px';
        subSubcategoriesDiv.offsetHeight; // Force reflow
        subSubcategoriesDiv.style.maxHeight = '0px';
        subSubcategoriesDiv.classList.remove('expanded');
        if (toggleIcon) toggleIcon.classList.remove('rotated');
    }
}

// New enhanced functions
function toggleCompactView() {
    isCompactView = !isCompactView;
    const container = document.getElementById('categoriesContainer');
    const toggleBtn = document.getElementById('compactToggle');
    const toggleText = document.getElementById('compactText');
    
    if (isCompactView) {
        container.classList.add('compact-view');
        toggleText.textContent = 'Detailed View';
        toggleBtn.classList.add('bg-blue-50', 'text-blue-700');
        toggleBtn.classList.remove('bg-white', 'text-gray-700');
    } else {
        container.classList.remove('compact-view');
        toggleText.textContent = 'Compact View';
        toggleBtn.classList.remove('bg-blue-50', 'text-blue-700');
        toggleBtn.classList.add('bg-white', 'text-gray-700');
    }
}

function toggleExpandAll() {
    allExpanded = !allExpanded;
    const expandCollapseText = document.getElementById('expandCollapseText');
    const subcategories = document.querySelectorAll('.subcategories');
    const subSubcategories = document.querySelectorAll('.sub-subcategories');
    const toggleIcons = document.querySelectorAll('.toggle-icon');
    
    if (allExpanded) {
        expandCollapseText.textContent = 'Collapse All';
        // Expand all main subcategories
        subcategories.forEach(sub => {
            sub.style.maxHeight = 'none';
            sub.classList.add('expanded');
        });
        
        // Expand all sub-subcategories
        subSubcategories.forEach(subSub => {
            subSub.style.maxHeight = 'none';
            subSub.classList.add('expanded');
        });
        
        // Rotate all toggle icons
        toggleIcons.forEach(icon => {
            icon.classList.add('rotated');
        });
        
    } else {
        expandCollapseText.textContent = 'Expand All';
        
        // Collapse all
        subcategories.forEach(sub => {
            sub.style.maxHeight = '0px';
            sub.classList.remove('expanded');
        });
        
        subSubcategories.forEach(subSub => {
            subSub.style.maxHeight = '0px';
            subSub.classList.remove('expanded');
        });
        
        // Reset toggle icons
        toggleIcons.forEach(icon => {
            icon.classList.remove('rotated');
        });
    }
}

// Search functionality
function searchCategories() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryItems = document.querySelectorAll('.category-item');
    const categoryNames = document.querySelectorAll('.category-name');
    
    // Remove previous highlights
    categoryNames.forEach(name => {
        name.innerHTML = name.textContent;
    });
    
    if (searchTerm === '') {
        // Show all categories
        document.querySelectorAll('.category-section').forEach(section => {
            section.style.display = 'block';
        });
        categoryItems.forEach(item => {
            item.style.display = 'flex';
        });
        return;
    }
    
    // Hide all first
    document.querySelectorAll('.category-section').forEach(section => {
        section.style.display = 'none';
    });
    categoryItems.forEach(item => {
        item.style.display = 'none';
    });
    
    // Show matching categories and their parents
    categoryNames.forEach(nameEl => {
        const categoryName = nameEl.textContent.toLowerCase();
        if (categoryName.includes(searchTerm)) {
            // Highlight the match
            const highlightedText = nameEl.textContent.replace(
                new RegExp(searchTerm, 'gi'),
                match => `<span class="search-highlight">${match}</span>`
            );
            nameEl.innerHTML = highlightedText;
            
            // Show this category item and its parent section
            const categoryItem = nameEl.closest('.category-item');
            const categorySection = nameEl.closest('.category-section');
            
            if (categoryItem) categoryItem.style.display = 'flex';
            if (categorySection) categorySection.style.display = 'block';
            
            // If this is a subcategory, expand its parent
            const subcategoriesContainer = nameEl.closest('.subcategories');
            if (subcategoriesContainer) {
                subcategoriesContainer.style.maxHeight = 'none';
                subcategoriesContainer.classList.add('expanded');
                const parentToggleIcon = subcategoriesContainer.parentElement.querySelector('.toggle-icon');
                if (parentToggleIcon) parentToggleIcon.classList.add('rotated');
            }
            
            // If this is a sub-subcategory, expand its parent too
            const subSubcategoriesContainer = nameEl.closest('.sub-subcategories');
            if (subSubcategoriesContainer) {
                subSubcategoriesContainer.style.maxHeight = 'none';
                subSubcategoriesContainer.classList.add('expanded');
                const parentToggleIcon = subSubcategoriesContainer.parentElement.querySelector('[id^="toggle-icon-sub-"]');
                if (parentToggleIcon) parentToggleIcon.classList.add('rotated');
            }
        }
    });
}

// Filter by level functionality
function filterByLevel() {
    const selectedLevel = document.getElementById('levelFilter').value;
    const categoryItems = document.querySelectorAll('.category-item');
    const categorySections = document.querySelectorAll('.category-section');
    
    if (selectedLevel === '') {
        // Show all
        categorySections.forEach(section => {
            section.style.display = 'block';
        });
        categoryItems.forEach(item => {
            item.style.display = 'flex';
        });
        return;
    }
    
    // Hide all first
    categorySections.forEach(section => {
        section.style.display = 'none';
    });
    categoryItems.forEach(item => {
        item.style.display = 'none';
    });
    
    // Show matching levels
    if (selectedLevel === 'main') {
        document.querySelectorAll('[data-level="main"]').forEach(section => {
            section.style.display = 'block';
            // Show only the main category item, hide subcategories
            const mainCategoryItem = section.querySelector('.category-item');
            if (mainCategoryItem) mainCategoryItem.style.display = 'flex';
        });
    } else if (selectedLevel === 'sub') {
        document.querySelectorAll('.category-section').forEach(section => {
            const subCategoryItems = section.querySelectorAll('[data-level="sub"]');
            if (subCategoryItems.length > 0) {
                section.style.display = 'block';
                const mainCategoryItem = section.querySelector('.category-item');
                if (mainCategoryItem) mainCategoryItem.style.display = 'flex';
                
                // Expand subcategories
                const subcategoriesContainer = section.querySelector('.subcategories');
                if (subcategoriesContainer) {
                    subcategoriesContainer.style.maxHeight = 'none';
                    subcategoriesContainer.classList.add('expanded');
                    const toggleIcon = section.querySelector('.toggle-icon');
                    if (toggleIcon) toggleIcon.classList.add('rotated');
                }
                
                subCategoryItems.forEach(item => {
                    item.style.display = 'flex';
                });
            }
        });
    } else if (selectedLevel === 'subsub') {
        document.querySelectorAll('.category-section').forEach(section => {
            const subSubCategoryItems = section.querySelectorAll('[data-level="subsub"]');
            if (subSubCategoryItems.length > 0) {
                section.style.display = 'block';
                const mainCategoryItem = section.querySelector('.category-item');
                if (mainCategoryItem) mainCategoryItem.style.display = 'flex';
                
                // Expand all levels
                const subcategoriesContainer = section.querySelector('.subcategories');
                if (subcategoriesContainer) {
                    subcategoriesContainer.style.maxHeight = 'none';
                    subcategoriesContainer.classList.add('expanded');
                    const toggleIcon = section.querySelector('.toggle-icon');
                    if (toggleIcon) toggleIcon.classList.add('rotated');
                }
                
                const subCategoryItems = section.querySelectorAll('[data-level="sub"]');
                subCategoryItems.forEach(item => {
                    item.style.display = 'flex';
                    
                    // Expand sub-subcategories
                    const subSubContainer = item.querySelector('.sub-subcategories');
                    if (subSubContainer) {
                        subSubContainer.style.maxHeight = 'none';
                        subSubContainer.classList.add('expanded');
                        const subToggleIcon = item.querySelector('[id^="toggle-icon-sub-"]');
                        if (subToggleIcon) subToggleIcon.classList.add('rotated');
                    }
                });
                
                subSubCategoryItems.forEach(item => {
                    item.style.display = 'flex';
                });
            }
        });
    }
}

// Close modals when clicking outside
document.addEventListener('click', function(event) {
    const createModal = document.getElementById('createCategoryModal');
    const editModal = document.getElementById('editCategoryModal');
    
    if (event.target === createModal) {
        closeCreateModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeCreateModal();
        closeEditModal();
    }
});

// Prevent modal close when clicking inside modal content
document.querySelectorAll('.modal-content').forEach(modal => {
    modal.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});

// Initialize collapsed state on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all subcategories as collapsed
    const subcategories = document.querySelectorAll('.subcategories');
    const subSubcategories = document.querySelectorAll('.sub-subcategories');
    
    subcategories.forEach(sub => {
        sub.style.maxHeight = '0px';
        sub.classList.remove('expanded');
    });
    
    subSubcategories.forEach(subSub => {
        subSub.style.maxHeight = '0px';
        subSub.classList.remove('expanded');
    });
    
    // Auto-expand categories with few items for better UX (optional)
    document.querySelectorAll('.category-section').forEach(function(section) {
        const subcategoryCount = section.querySelectorAll('[data-level="sub"]').length;
        if (subcategoryCount <= 2 && subcategoryCount > 0) {
            const categoryId = section.dataset.categoryId;
            if (categoryId) {
                setTimeout(() => toggleCategory(categoryId), 100);
            }
        }
    });
});

function updateCategoryOrder(categoryId, newOrder) {
    fetch(`/admin/categories/${categoryId}/update-order`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ sort_order: newOrder })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Category order updated successfully', 'Success');
        }
    });
}
</script>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fade-in-up {
    animation: fade-in-up 0.3s ease-out forwards;
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

/* Enhanced transitions for collapsible subcategories */
.subcategories, .sub-subcategories {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
    opacity: 0;
}

.subcategories.expanded, .sub-subcategories.expanded {
    opacity: 1;
}

.category-card {
    transition: all 0.2s ease;
}

.category-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}

.toggle-icon {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}

.action-buttons {
    transition: all 0.2s ease;
}

.search-highlight {
    background-color: #fef3c7;
    padding: 2px 4px;
    border-radius: 4px;
    font-weight: 600;
}

/* Compact view styles */
.compact-view .subcategories {
    max-height: 150px !important;
    overflow-y: auto;
}

.compact-view .subcategories.expanded {
    max-height: 150px !important;
}

.compact-view .sub-subcategories {
    max-height: 100px !important;
    overflow-y: auto;
}

.compact-view .category-card {
    margin-bottom: 8px;
}

.compact-view .category-card:hover {
    transform: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Improved hover effects for better UX */
.cursor-pointer:hover h4 {
    color: #1e40af;
    transition: color 0.2s ease;
}

.cursor-pointer:hover h5 {
    color: #059669;
    transition: color 0.2s ease;
}

/* Better visual hierarchy */
.bg-gray-25 {
    background-color: #fafafa;
}

/* Custom scrollbar for compact view */
.compact-view .subcategories::-webkit-scrollbar,
.compact-view .sub-subcategories::-webkit-scrollbar {
    width: 4px;
}

.compact-view .subcategories::-webkit-scrollbar-track,
.compact-view .sub-subcategories::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 2px;
}

.compact-view .subcategories::-webkit-scrollbar-thumb,
.compact-view .sub-subcategories::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}

.compact-view .subcategories::-webkit-scrollbar-thumb:hover,
.compact-view .sub-subcategories::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Enhanced button hover effects */
button:hover {
    transform: translateY(-1px);
    transition: transform 0.1s ease;
}

button:active {
    transform: translateY(0);
}

/* Style for the order dropdown */
select.block {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}
</style>

@endsection