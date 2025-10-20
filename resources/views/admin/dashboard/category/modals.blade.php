<!-- Create Category Modal -->
<div id="createCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 1000;">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 id="createModalTitle" class="text-lg leading-6 font-medium text-gray-900">Create Category</h3>
            <form id="createCategoryForm" action="{{ route('admin.categories.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="createCategoryLevel" name="level" value="1">
                <input type="hidden" id="createCategoryParentId" name="parent_id" value="">
                
                <div class="mt-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Category Icon Upload with Preview -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Category Icon</label>
                    <div class="mt-1 flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full border-2 border-gray-200 flex items-center justify-center overflow-hidden">
                            <img id="createImagePreview" src="" alt="Preview" class="hidden w-full h-full object-cover">
                            <svg id="createDefaultIcon" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="icon_image" id="icon_image" accept="image/*"
                                class="hidden"
                                onchange="previewImage(this, 'createImagePreview', 'createDefaultIcon')">
                            <button type="button" onclick="document.getElementById('icon_image').click()"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Choose Image
                            </button>
                            <p class="mt-1 text-xs text-gray-500">Recommended: 64x64px (Square)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeCreateModal()" 
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 1000;">
    <div class="modal-content relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Category</h3>
            <form id="editCategoryForm" method="POST" class="mt-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editCategoryId" name="id">
                
                <div class="mt-2">
                    <label for="editCategoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="editCategoryName" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Category Icon Upload with Preview -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Category Icon</label>
                    <div class="mt-1 flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full border-2 border-gray-200 flex items-center justify-center overflow-hidden">
                            <img id="editImagePreview" src="" alt="Preview" class="w-full h-full object-cover">
                            <svg id="editDefaultIcon" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="icon_image" id="edit_icon_image" accept="image/*"
                                class="hidden"
                                onchange="previewImage(this, 'editImagePreview', 'editDefaultIcon')">
                            <button type="button" onclick="document.getElementById('edit_icon_image').click()"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Choose New Image
                            </button>
                            <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image</p>
                        </div>
                    </div>

                    <div class="mt-4">
    <label for="bg_color" class="block font-medium text-sm text-gray-700">Background Color</label>
    <input type="color" name="bg_color" id="bg_color"
           value="{{ old('bg_color', $category->bg_color ?? '#ffffff') }}"
           class="mt-1 block w-24 h-10 border rounded">
</div>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Category Form -->
<form id="deleteCategoryForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function closeCreateModal() {
    document.getElementById('createCategoryModal').classList.add('hidden');
    document.getElementById('createCategoryForm').reset();
    document.getElementById('createImagePreview').classList.add('hidden');
    document.getElementById('createDefaultIcon').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editCategoryModal').classList.add('hidden');
    document.getElementById('editCategoryForm').reset();
    document.getElementById('editImagePreview').classList.add('hidden');
    document.getElementById('editDefaultIcon').classList.remove('hidden');
}

function openCreateModal(level, parentId = null) {
    document.getElementById('createCategoryLevel').value = level;
    document.getElementById('createCategoryParentId').value = parentId || '';
    document.getElementById('createCategoryModal').classList.remove('hidden');
}

function openEditModal(id, name, currentImage = null) {
    document.getElementById('editCategoryId').value = id;
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryForm').action = `/admin/categories/${id}`;
    
    // Handle image preview
    const preview = document.getElementById('editImagePreview');
    const defaultIcon = document.getElementById('editDefaultIcon');
    
    if (currentImage) {
        preview.src = currentImage;
        preview.classList.remove('hidden');
        defaultIcon.classList.add('hidden');
    } else {
        preview.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
    }
    
    document.getElementById('editCategoryModal').classList.remove('hidden');
}

function deleteCategory(id) {
    if (confirm('Are you sure you want to delete this category?')) {
        const form = document.getElementById('deleteCategoryForm');
        form.action = `/admin/categories/${id}`;
        form.submit();
    }
}

function previewImage(input, previewId, defaultIconId) {
    const preview = document.getElementById(previewId);
    const defaultIcon = document.getElementById(defaultIconId);
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            defaultIcon.classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Close modals when clicking outside
window.addEventListener('click', function(event) {
    const createModal = document.getElementById('createCategoryModal');
    const editModal = document.getElementById('editCategoryModal');
    
    if (event.target === createModal) {
        closeCreateModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
});

// Escape key to close modals
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeCreateModal();
        closeEditModal();
    }
});
</script>
