@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Catégories</span>
    </nav>

    <!-- Header -->
    <div class="page-header" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 16px;">
        <div>
            <h1 class="page-title">Gestion des catégories</h1>
            <p class="page-subtitle">Organisez et gérez votre hiérarchie de catégories</p>
        </div>
        <div class="flex gap-3">
            <button onclick="toggleCompactView()" id="compactToggle" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span id="compactText">Vue compacte</span>
            </button>
            <button onclick="toggleExpandAll()" id="expandAllBtn" class="btn btn-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span id="expandCollapseText">Tout déplier</span>
            </button>
            <button onclick="openCreateModal(1)" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter catégorie
            </button>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="admin-card border-l-4 border-green-500 p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="admin-card p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Rechercher une catégorie..."
                           class="form-input pl-10" onkeyup="searchCategories()">
                </div>
            </div>
            <div>
                <select id="levelFilter" onchange="filterByLevel()" class="form-input">
                    <option value="">Tous les niveaux</option>
                    <option value="main">Catégories principales</option>
                    <option value="sub">Sous-catégories</option>
                    <option value="subsub">Sous-sous-catégories</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="admin-card p-5">
            <div class="flex items-center">
                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50">
                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-medium text-gray-500">Principales</p>
                    <p class="text-lg font-semibold text-gray-900">{{ count($mainCategories) }}</p>
                </div>
            </div>
        </div>

        <div class="admin-card p-5">
            <div class="flex items-center">
                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-green-50">
                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-medium text-gray-500">Sous-catégories</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $mainCategories->sum(function($cat) { return $cat->subCategories->count(); }) }}</p>
                </div>
            </div>
        </div>

        <div class="admin-card p-5">
            <div class="flex items-center">
                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-purple-50">
                    <svg class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-medium text-gray-500">Sous-sous-catégories</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $mainCategories->sum(function($cat) { return $cat->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }); }) }}</p>
                </div>
            </div>
        </div>

        <div class="admin-card p-5">
            <div class="flex items-center">
                <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-orange-50">
                    <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-xs font-medium text-gray-500">Total</p>
                    <p class="text-lg font-semibold text-gray-900">{{ count($mainCategories) + $mainCategories->sum(function($cat) { return $cat->subCategories->count(); }) + $mainCategories->sum(function($cat) { return $cat->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }); }) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Hierarchy -->
    <div id="categoriesContainer" class="space-y-4">
        @forelse($mainCategories as $index => $mainCategory)
        <div class="category-section admin-card overflow-hidden" data-category-id="{{ $mainCategory->id }}" data-level="main">
            <!-- Main Category -->
            <div class="category-item group">
                <div class="flex items-center justify-between px-6 py-4 cursor-pointer hover:bg-gray-50 transition-colors" onclick="toggleCategory({{ $mainCategory->id }})">
                    <div class="flex items-center space-x-4 flex-1">
                        <button class="toggle-icon flex items-center justify-center h-6 w-6 rounded transition-transform duration-300" id="toggle-icon-{{ $mainCategory->id }}">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        @if($mainCategory->icon_image)
                            <img src="{{ asset($mainCategory->icon_image) }}" alt="{{ $mainCategory->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                        @else
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white shadow-sm">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <h4 class="text-base font-semibold text-gray-900 category-name">{{ $mainCategory->name }}</h4>
                            <div class="flex items-center space-x-4 text-xs text-gray-500 mt-1">
                                <span>{{ $mainCategory->subCategories->count() }} sous-catégories</span>
                                @if($mainCategory->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }) > 0)
                                <span>{{ $mainCategory->subCategories->sum(function($sub) { return $sub->subSubCategories->count(); }) }} sous-sous-catégories</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <select onchange="updateCategoryOrder({{ $mainCategory->id }}, this.value)" class="form-input py-1.5 text-sm w-16">
                            @for($i = 0; $i <= count($mainCategories); $i++)
                                <option value="{{ $i }}" {{ $mainCategory->sort_order == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="action-buttons flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-all">
                            <button onclick="event.stopPropagation(); openCreateModal(2, {{ $mainCategory->id }})" class="btn btn-ghost text-blue-600 hover:bg-blue-50 py-1.5 text-xs">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Sous-cat.
                            </button>
                            <button onclick="event.stopPropagation(); openEditModal({{ $mainCategory->id }}, '{{ addslashes($mainCategory->name) }}')" class="btn btn-ghost text-green-600 hover:bg-green-50 py-1.5 text-xs">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </button>
                            <button onclick="event.stopPropagation(); deleteCategory({{ $mainCategory->id }})" class="btn btn-ghost text-red-600 hover:bg-red-50 py-1.5 text-xs">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sub Categories -->
            <div class="subcategories bg-gray-50" id="subcategories-{{ $mainCategory->id }}" data-level="sub">
                @if($mainCategory->subCategories->count() > 0)
                <div class="px-6 py-3 space-y-2">
                    @foreach($mainCategory->subCategories as $subCategory)
                    <div class="category-item group bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all" data-level="sub">
                        <div class="flex items-center justify-between px-4 py-3">
                            <div class="flex items-center space-x-3 flex-1 cursor-pointer" onclick="toggleSubCategory({{ $subCategory->id }})">
                                @if($subCategory->subSubCategories->count() > 0)
                                <button class="toggle-icon flex items-center justify-center h-5 w-5 rounded transition-transform duration-300" id="toggle-icon-sub-{{ $subCategory->id }}">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                @else
                                <div class="w-5"></div>
                                @endif
                                @if($subCategory->icon_image)
                                    <img src="{{ asset($subCategory->icon_image) }}" alt="{{ $subCategory->name }}" class="h-8 w-8 rounded-full object-cover ring-2 ring-white shadow-sm">
                                @else
                                    <div class="flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-br from-green-400 to-green-600 text-white shadow-sm">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <h5 class="font-medium text-gray-800 category-name">{{ $subCategory->name }}</h5>
                                    <p class="text-xs text-gray-500">{{ $subCategory->subSubCategories->count() }} sous-sous-catégories</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <select onchange="updateCategoryOrder({{ $subCategory->id }}, this.value)" class="form-input py-1 text-xs w-14">
                                    @for($i = 0; $i <= $mainCategory->subCategories->count(); $i++)
                                        <option value="{{ $i }}" {{ $subCategory->sort_order == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="action-buttons flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-all">
                                    <button onclick="event.stopPropagation(); openCreateModal(3, {{ $subCategory->id }})" class="btn btn-ghost text-blue-600 hover:bg-blue-50 py-1 text-xs">+ Sous-sous</button>
                                    <button onclick="event.stopPropagation(); openEditModal({{ $subCategory->id }}, '{{ addslashes($subCategory->name) }}')" class="btn btn-ghost text-green-600 hover:bg-green-50 py-1 text-xs">Modifier</button>
                                    <button onclick="event.stopPropagation(); deleteCategory({{ $subCategory->id }})" class="btn btn-ghost text-red-600 hover:bg-red-50 py-1 text-xs">Supprimer</button>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-Sub Categories -->
                        @if($subCategory->subSubCategories->count() > 0)
                        <div class="sub-subcategories bg-gray-50 rounded-b-lg" id="subcategories-sub-{{ $subCategory->id }}" data-level="subsub">
                            <div class="px-4 pb-3 space-y-1">
                                @foreach($subCategory->subSubCategories as $subSubCategory)
                                <div class="category-item group flex items-center justify-between py-2 px-3 rounded hover:bg-white transition-colors" data-level="subsub">
                                    <div class="flex items-center space-x-3">
                                        <div class="h-2 w-2 rounded-full bg-purple-400"></div>
                                        <span class="text-sm text-gray-700 category-name">{{ $subSubCategory->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <select onchange="updateCategoryOrder({{ $subSubCategory->id }}, this.value)" class="form-input py-0.5 text-xs w-14">
                                            @for($i = 0; $i <= $subCategory->subSubCategories->count(); $i++)
                                                <option value="{{ $i }}" {{ $subSubCategory->sort_order == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <div class="action-buttons flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-all">
                                            <button onclick="openEditModal({{ $subSubCategory->id }}, '{{ addslashes($subSubCategory->name) }}')" class="p-1 text-green-600 hover:bg-green-50 rounded transition-colors">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button onclick="deleteCategory({{ $subSubCategory->id }})" class="p-1 text-red-600 hover:bg-red-50 rounded transition-colors">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
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
        <div class="admin-card text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            <h3 class="text-sm font-medium text-gray-900 mb-1">Aucune catégorie</h3>
            <p class="text-sm text-gray-500 mb-4">Commencez par créer votre première catégorie principale.</p>
            <button onclick="openCreateModal(1)" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter catégorie
            </button>
        </div>
        @endforelse
    </div>

    <!-- Modals -->
    @include('admin.dashboard.category.modals')
</div>

@push('scripts')
<script>
let isCompactView = false;
let allExpanded = false;

function openCreateModal(level, parentId = null) {
    document.getElementById('createCategoryLevel').value = level;
    document.getElementById('createCategoryParentId').value = parentId || '';
    document.getElementById('createCategoryModal').classList.remove('hidden');
    const titles = { 1: 'Créer une catégorie principale', 2: 'Créer une sous-catégorie', 3: 'Créer une sous-sous-catégorie' };
    document.getElementById('createModalTitle').textContent = titles[level] || 'Créer une catégorie';
    setTimeout(() => document.getElementById('createCategoryName')?.focus(), 100);
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
    setTimeout(() => {
        const input = document.getElementById('editCategoryName');
        if (input) { input.focus(); input.select(); }
    }, 100);
}

function closeEditModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
    document.getElementById('editCategoryForm').reset();
}

function deleteCategory(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?\n\nCette action supprimera définitivement la catégorie et toutes ses sous-catégories.')) {
        const form = document.getElementById('deleteCategoryForm');
        form.action = `/admin/categories/${id}`;
        form.submit();
    }
}

function toggleCategory(categoryId) {
    const subcategoriesDiv = document.getElementById(`subcategories-${categoryId}`);
    const toggleIcon = document.getElementById(`toggle-icon-${categoryId}`);
    if (!subcategoriesDiv) return;
    const isCollapsed = subcategoriesDiv.style.maxHeight === '0px' || !subcategoriesDiv.classList.contains('expanded');
    if (isCollapsed) {
        subcategoriesDiv.style.maxHeight = subcategoriesDiv.scrollHeight + 'px';
        subcategoriesDiv.classList.add('expanded');
        toggleIcon.classList.add('rotated');
        setTimeout(() => { if (subcategoriesDiv.classList.contains('expanded')) subcategoriesDiv.style.maxHeight = 'none'; }, 400);
    } else {
        subcategoriesDiv.style.maxHeight = subcategoriesDiv.scrollHeight + 'px';
        subcategoriesDiv.offsetHeight;
        subcategoriesDiv.style.maxHeight = '0px';
        subcategoriesDiv.classList.remove('expanded');
        toggleIcon.classList.remove('rotated');
        subcategoriesDiv.querySelectorAll('.sub-subcategories').forEach(subSub => {
            subSub.style.maxHeight = '0px';
            subSub.classList.remove('expanded');
        });
    }
}

function toggleSubCategory(subCategoryId) {
    const subSubcategoriesDiv = document.getElementById(`subcategories-sub-${subCategoryId}`);
    const toggleIcon = document.getElementById(`toggle-icon-sub-${subCategoryId}`);
    if (!subSubcategoriesDiv) return;
    const isCollapsed = subSubcategoriesDiv.style.maxHeight === '0px' || !subSubcategoriesDiv.classList.contains('expanded');
    if (isCollapsed) {
        subSubcategoriesDiv.style.maxHeight = subSubcategoriesDiv.scrollHeight + 'px';
        subSubcategoriesDiv.classList.add('expanded');
        if (toggleIcon) toggleIcon.classList.add('rotated');
        setTimeout(() => { if (subSubcategoriesDiv.classList.contains('expanded')) subSubcategoriesDiv.style.maxHeight = 'none'; }, 400);
    } else {
        subSubcategoriesDiv.style.maxHeight = subSubcategoriesDiv.scrollHeight + 'px';
        subSubcategoriesDiv.offsetHeight;
        subSubcategoriesDiv.style.maxHeight = '0px';
        subSubcategoriesDiv.classList.remove('expanded');
        if (toggleIcon) toggleIcon.classList.remove('rotated');
    }
}

function toggleCompactView() {
    isCompactView = !isCompactView;
    const container = document.getElementById('categoriesContainer');
    const toggleBtn = document.getElementById('compactToggle');
    const toggleText = document.getElementById('compactText');
    if (isCompactView) {
        container.classList.add('compact-view');
        toggleText.textContent = 'Vue détaillée';
        toggleBtn.classList.add('btn-primary');
        toggleBtn.classList.remove('btn-secondary');
    } else {
        container.classList.remove('compact-view');
        toggleText.textContent = 'Vue compacte';
        toggleBtn.classList.remove('btn-primary');
        toggleBtn.classList.add('btn-secondary');
    }
}

function toggleExpandAll() {
    allExpanded = !allExpanded;
    const expandCollapseText = document.getElementById('expandCollapseText');
    const subcategories = document.querySelectorAll('.subcategories');
    const subSubcategories = document.querySelectorAll('.sub-subcategories');
    const toggleIcons = document.querySelectorAll('.toggle-icon');
    if (allExpanded) {
        expandCollapseText.textContent = 'Tout replier';
        subcategories.forEach(sub => { sub.style.maxHeight = 'none'; sub.classList.add('expanded'); });
        subSubcategories.forEach(subSub => { subSub.style.maxHeight = 'none'; subSub.classList.add('expanded'); });
        toggleIcons.forEach(icon => icon.classList.add('rotated'));
    } else {
        expandCollapseText.textContent = 'Tout déplier';
        subcategories.forEach(sub => { sub.style.maxHeight = '0px'; sub.classList.remove('expanded'); });
        subSubcategories.forEach(subSub => { subSub.style.maxHeight = '0px'; subSub.classList.remove('expanded'); });
        toggleIcons.forEach(icon => icon.classList.remove('rotated'));
    }
}

function searchCategories() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const categoryItems = document.querySelectorAll('.category-item');
    const categoryNames = document.querySelectorAll('.category-name');
    categoryNames.forEach(name => { name.innerHTML = name.textContent; });
    if (searchTerm === '') {
        document.querySelectorAll('.category-section').forEach(section => section.style.display = 'block');
        categoryItems.forEach(item => item.style.display = 'flex');
        return;
    }
    document.querySelectorAll('.category-section').forEach(section => section.style.display = 'none');
    categoryItems.forEach(item => item.style.display = 'none');
    categoryNames.forEach(nameEl => {
        const categoryName = nameEl.textContent.toLowerCase();
        if (categoryName.includes(searchTerm)) {
            const highlightedText = nameEl.textContent.replace(new RegExp(searchTerm, 'gi'), match => `<span class="bg-yellow-200 px-0.5 rounded">${match}</span>`);
            nameEl.innerHTML = highlightedText;
            const categoryItem = nameEl.closest('.category-item');
            const categorySection = nameEl.closest('.category-section');
            if (categoryItem) categoryItem.style.display = 'flex';
            if (categorySection) categorySection.style.display = 'block';
            const subcategoriesContainer = nameEl.closest('.subcategories');
            if (subcategoriesContainer) {
                subcategoriesContainer.style.maxHeight = 'none';
                subcategoriesContainer.classList.add('expanded');
                const parentToggleIcon = subcategoriesContainer.parentElement.querySelector('.toggle-icon');
                if (parentToggleIcon) parentToggleIcon.classList.add('rotated');
            }
            const subSubcategoriesContainer = nameEl.closest('.sub-subcategories');
            if (subSubcategoriesContainer) {
                subSubcategoriesContainer.style.maxHeight = 'none';
                subSubcategoriesContainer.classList.add('expanded');
            }
        }
    });
}

function filterByLevel() {
    const selectedLevel = document.getElementById('levelFilter').value;
    const categoryItems = document.querySelectorAll('.category-item');
    const categorySections = document.querySelectorAll('.category-section');
    if (selectedLevel === '') {
        categorySections.forEach(section => section.style.display = 'block');
        categoryItems.forEach(item => item.style.display = 'flex');
        return;
    }
    categorySections.forEach(section => section.style.display = 'none');
    categoryItems.forEach(item => item.style.display = 'none');
    if (selectedLevel === 'main') {
        document.querySelectorAll('[data-level="main"]').forEach(section => {
            section.style.display = 'block';
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
                const subcategoriesContainer = section.querySelector('.subcategories');
                if (subcategoriesContainer) {
                    subcategoriesContainer.style.maxHeight = 'none';
                    subcategoriesContainer.classList.add('expanded');
                    const toggleIcon = section.querySelector('.toggle-icon');
                    if (toggleIcon) toggleIcon.classList.add('rotated');
                }
                subCategoryItems.forEach(item => item.style.display = 'flex');
            }
        });
    } else if (selectedLevel === 'subsub') {
        document.querySelectorAll('.category-section').forEach(section => {
            const subSubCategoryItems = section.querySelectorAll('[data-level="subsub"]');
            if (subSubCategoryItems.length > 0) {
                section.style.display = 'block';
                const mainCategoryItem = section.querySelector('.category-item');
                if (mainCategoryItem) mainCategoryItem.style.display = 'flex';
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
                    const subSubContainer = item.querySelector('.sub-subcategories');
                    if (subSubContainer) {
                        subSubContainer.style.maxHeight = 'none';
                        subSubContainer.classList.add('expanded');
                    }
                });
                subSubCategoryItems.forEach(item => item.style.display = 'flex');
            }
        });
    }
}

document.addEventListener('click', function(event) {
    const createModal = document.getElementById('createCategoryModal');
    const editModal = document.getElementById('editCategoryModal');
    if (event.target === createModal) closeCreateModal();
    if (event.target === editModal) closeEditModal();
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') { closeCreateModal(); closeEditModal(); }
});

document.addEventListener('DOMContentLoaded', function() {
    const subcategories = document.querySelectorAll('.subcategories');
    const subSubcategories = document.querySelectorAll('.sub-subcategories');
    subcategories.forEach(sub => { sub.style.maxHeight = '0px'; sub.classList.remove('expanded'); });
    subSubcategories.forEach(subSub => { subSub.style.maxHeight = '0px'; subSub.classList.remove('expanded'); });
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
        if (data.success && typeof toastr !== 'undefined') {
            toastr.success('Ordre mis à jour avec succès');
        }
    });
}
</script>
@endpush

<style>
.subcategories, .sub-subcategories {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
    opacity: 0;
}
.subcategories.expanded, .sub-subcategories.expanded {
    opacity: 1;
}
.toggle-icon {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.toggle-icon.rotated {
    transform: rotate(180deg);
}
.compact-view .subcategories { max-height: 150px !important; overflow-y: auto; }
.compact-view .subcategories.expanded { max-height: 150px !important; }
.compact-view .sub-subcategories { max-height: 100px !important; overflow-y: auto; }
</style>
@endsection
