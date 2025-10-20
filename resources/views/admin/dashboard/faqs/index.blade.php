@extends('admin.dashboard.index')

@section('admin-content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Manage FAQs</h2>
                <p class="mt-1 text-sm text-gray-500">Add, edit, reorder, or remove frequently asked questions</p>
            </div>
            <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition">
                + Add FAQ
            </button>
        </div>

        <!-- FAQ List -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <ul id="faq-list" class="divide-y divide-gray-200">
                @foreach($faqs as $faq)
                <li class="p-5 flex items-start gap-4" data-id="{{ $faq->id }}">
                    
                    <!-- Drag handle -->
                    <div class="cursor-move text-gray-400 hover:text-gray-600 mt-2" title="Drag to reorder">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 14h16" />
                        </svg>
                    </div>

                    <!-- FAQ Content -->
                    <div class="flex-1">
                        <!-- Update Form -->
                        <form class="faq-inline-form space-y-3" data-faq-id="{{ $faq->id }}">
                            @csrf
                            @method('PUT')

                            <input type="text" 
                                name="question" 
                                value="{{ $faq->question }}" 
                                class="w-full text-lg font-medium text-gray-900 border-b border-gray-200 focus:border-blue-500 focus:ring-0 outline-none bg-transparent" 
                                placeholder="Enter question..." />

                            <textarea name="answer" rows="2" 
                                    class="w-full text-gray-700 border-b border-gray-200 focus:border-blue-500 focus:ring-0 outline-none bg-transparent" 
                                    placeholder="Enter answer...">{{ $faq->answer }}</textarea>

                            <div class="flex items-center justify-between">
                                <label class="inline-flex items-center gap-2">
                                    <input type="checkbox" name="status" value="1" {{ $faq->status ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">Active</span>
                                </label>

                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Delete Form (separate, aligned right) -->
                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" 
                        onsubmit="return confirm('Are you sure?')" class="ml-4 mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded-md text-sm shadow flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>

                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>

<!-- Modal -->
<div id="faqModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <form id="faqForm" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" value="POST">

                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                    <input type="text" name="question" id="question" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                    <textarea name="answer" id="answer" rows="4" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="status" id="status" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <label for="status" class="ml-2 text-sm text-gray-900">Active</label>
                </div>

                <!-- Footer -->
                <div class="pt-4 flex justify-end gap-3 border-t border-gray-200">
                    <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const modal = document.getElementById('faqModal');
const form = document.getElementById('faqForm');
let currentFaqId = null;

new Sortable(document.getElementById('faq-list'), {
    animation: 200,
    handle: '.cursor-move',
    ghostClass: 'bg-gray-100',
    onEnd: function() {
        const items = Array.from(document.querySelectorAll('#faq-list li')).map((el, index) => ({
            id: el.dataset.id,
            order: index
        }));

        fetch('{{ route("admin.faqs.update-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                toastr.success('FAQ reordered successfully.', 'Success');
            }
        });
    }
});

function openCreateModal() {
    currentFaqId = null;
    form.reset();
    document.getElementById('modalTitle').textContent = 'Create New FAQ';
    form.action = '{{ route("admin.faqs.store") }}';
    form._method.value = 'POST';
    modal.classList.remove('hidden');
}

function closeModal() {
    modal.classList.add('hidden');
    form.reset();
}

modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
});

document.querySelectorAll('.faq-inline-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const faqId = form.getAttribute('data-faq-id');
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        fetch(`/admin/faqs/${faqId}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                form.querySelector('button[type="submit"]').textContent = 'Updated!';
                setTimeout(() => {
                    form.querySelector('button[type="submit"]').textContent = 'Update';
                }, 1200);
                toastr.success('FAQ updated successfully.', 'Success');
            }
        });
    });
});
</script>

@endsection
