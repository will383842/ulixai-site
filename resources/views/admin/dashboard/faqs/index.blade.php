@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">FAQs</span>
    </nav>

    <!-- Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h1 class="page-title">Gestion des FAQs</h1>
            <p class="page-subtitle">Ajoutez, modifiez, réordonnez ou supprimez les questions fréquentes</p>
        </div>
        <button onclick="openCreateModal()" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Ajouter une FAQ
        </button>
    </div>

    <!-- FAQ List -->
    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Liste des FAQs</h2>
            <p class="text-sm text-gray-500 mt-1">Glissez-déposez pour réorganiser l'ordre</p>
        </div>

        <ul id="faq-list" class="divide-y divide-gray-100">
            @foreach($faqs as $faq)
            <li class="p-6 flex items-start gap-4 hover:bg-gray-50 transition-colors" data-id="{{ $faq->id }}">

                <!-- Drag handle -->
                <div class="cursor-move text-gray-400 hover:text-gray-600 mt-2" title="Glisser pour réorganiser">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 14h16" />
                    </svg>
                </div>

                <!-- FAQ Content -->
                <div class="flex-1">
                    <form class="faq-inline-form space-y-3" data-faq-id="{{ $faq->id }}">
                        @csrf
                        @method('PUT')

                        <input type="text"
                            name="question"
                            value="{{ $faq->question }}"
                            class="form-input text-base font-medium"
                            placeholder="Entrez la question..." />

                        <textarea name="answer" rows="2"
                                class="form-input text-sm"
                                placeholder="Entrez la réponse...">{{ $faq->answer }}</textarea>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="status" value="1" {{ $faq->status ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Actif</span>
                            </label>

                            <button type="submit" class="btn btn-primary text-sm">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Delete Form -->
                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette FAQ ?')" class="ml-4 mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-ghost text-red-600 hover:bg-red-50" title="Supprimer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </li>
            @endforeach
        </ul>

        @if($faqs->count() === 0)
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 text-sm font-medium">Aucune FAQ</p>
                <p class="text-gray-400 text-xs mt-1">Commencez par ajouter une nouvelle question</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div id="faqModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="admin-card max-w-2xl w-full">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                <button onclick="closeModal()" class="btn btn-ghost text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="faqForm" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" value="POST">

                <div>
                    <label for="question" class="block text-xs font-medium text-gray-500 mb-1">Question</label>
                    <input type="text" name="question" id="question" class="form-input" placeholder="Entrez la question..." />
                </div>

                <div>
                    <label for="answer" class="block text-xs font-medium text-gray-500 mb-1">Réponse</label>
                    <textarea name="answer" id="answer" rows="4" class="form-input" placeholder="Entrez la réponse..."></textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="status" id="status" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="status" class="ml-2 text-sm text-gray-900">Actif</label>
                </div>

                <!-- Footer -->
                <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="closeModal()" class="btn btn-secondary">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
const modal = document.getElementById('faqModal');
const form = document.getElementById('faqForm');
let currentFaqId = null;

new Sortable(document.getElementById('faq-list'), {
    animation: 200,
    handle: '.cursor-move',
    ghostClass: 'bg-blue-50',
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
                toastr.success('Ordre des FAQs mis à jour');
            }
        });
    }
});

function openCreateModal() {
    currentFaqId = null;
    form.reset();
    document.getElementById('modalTitle').textContent = 'Créer une nouvelle FAQ';
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
                form.querySelector('button[type="submit"]').textContent = 'Mis à jour !';
                setTimeout(() => {
                    form.querySelector('button[type="submit"]').textContent = 'Mettre à jour';
                }, 1200);
                toastr.success('FAQ mise à jour avec succès');
            }
        });
    });
});
</script>
@endpush
@endsection
