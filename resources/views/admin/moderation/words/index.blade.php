@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div>
            <nav class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.moderation.dashboard') }}" class="hover:text-blue-600">Moderation</a>
                <span class="mx-2">/</span>
                <span>Mots interdits</span>
            </nav>
            <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700;">Gestion des mots interdits</h1>
        </div>
        <div class="flex gap-2">
            <button onclick="showAddModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i> Ajouter un mot
            </button>
            <button onclick="showImportModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-file-import mr-2"></i> Importer
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex-grow">
                <input type="text" id="searchWord" placeholder="Rechercher un mot..." class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onkeyup="filterWords()">
            </div>
            <select id="severityFilter" class="form-select" onchange="filterWords()">
                <option value="">Toutes severites</option>
                <option value="critical">Critique (blocage auto)</option>
                <option value="warning">Avertissement (revision)</option>
            </select>
            <select id="categoryFilter" class="form-select" onchange="filterWords()">
                <option value="">Toutes categories</option>
                <option value="politics">Politique</option>
                <option value="contact">Contact direct</option>
                <option value="scam">Arnaque</option>
                <option value="spam">Spam</option>
                <option value="offensive">Offensant</option>
                <option value="adult">Adulte</option>
                <option value="violence">Violence</option>
                <option value="other">Autre</option>
            </select>
            <select id="languageFilter" class="form-select" onchange="filterWords()">
                <option value="">Toutes langues</option>
                <option value="fr">Francais</option>
                <option value="en">English</option>
                <option value="de">Deutsch</option>
                <option value="es">Espanol</option>
                <option value="pt">Portugues</option>
                <option value="ru">Русский</option>
                <option value="zh">中文</option>
                <option value="ar">العربية</option>
                <option value="hi">हिन्दी</option>
                <option value="universal">Universel</option>
            </select>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-gray-700">{{ $stats['total'] ?? 0 }}</div>
            <div class="text-xs text-gray-500">Total mots</div>
        </div>
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-red-600">{{ $stats['critical'] ?? 0 }}</div>
            <div class="text-xs text-gray-500">Critiques</div>
        </div>
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-orange-600">{{ $stats['warning'] ?? 0 }}</div>
            <div class="text-xs text-gray-500">Avertissements</div>
        </div>
        <div class="admin-card p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['detections_today'] ?? 0 }}</div>
            <div class="text-xs text-gray-500">Detections aujourd'hui</div>
        </div>
    </div>

    <!-- Words Table -->
    <div class="admin-card overflow-hidden">
        <table class="w-full" id="wordsTable">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Mot/Pattern</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Categorie</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Severite</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Langue</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Detections</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Statut</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($words as $word)
                <tr class="hover:bg-gray-50 transition-colors word-row"
                    data-severity="{{ $word->severity }}"
                    data-category="{{ $word->category }}"
                    data-language="{{ $word->language }}"
                    data-word="{{ strtolower($word->word) }}"
                    id="word-row-{{ $word->id }}">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-2">
                            @if($word->is_regex)
                            <span class="px-1.5 py-0.5 bg-purple-100 text-purple-700 rounded text-xs font-mono">regex</span>
                            @endif
                            <code class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $word->word }}</code>
                        </div>
                        @if($word->description)
                        <div class="text-xs text-gray-500 mt-1">{{ $word->description }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        @php
                            $categoryLabels = [
                                'politics' => ['label' => 'Politique', 'color' => 'bg-purple-100 text-purple-700'],
                                'contact' => ['label' => 'Contact', 'color' => 'bg-blue-100 text-blue-700'],
                                'scam' => ['label' => 'Arnaque', 'color' => 'bg-red-100 text-red-700'],
                                'spam' => ['label' => 'Spam', 'color' => 'bg-yellow-100 text-yellow-700'],
                                'offensive' => ['label' => 'Offensant', 'color' => 'bg-orange-100 text-orange-700'],
                                'adult' => ['label' => 'Adulte', 'color' => 'bg-pink-100 text-pink-700'],
                                'violence' => ['label' => 'Violence', 'color' => 'bg-red-100 text-red-700'],
                                'other' => ['label' => 'Autre', 'color' => 'bg-gray-100 text-gray-700'],
                            ];
                            $cat = $categoryLabels[$word->category] ?? ['label' => $word->category, 'color' => 'bg-gray-100 text-gray-700'];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $cat['color'] }}">
                            {{ $cat['label'] }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        @if($word->severity === 'critical')
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                            <i class="fas fa-ban mr-1"></i> Critique
                        </span>
                        @else
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                            <i class="fas fa-exclamation-triangle mr-1"></i> Avertissement
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        @php
                            $langLabels = [
                                'fr' => 'FR', 'en' => 'EN', 'de' => 'DE', 'es' => 'ES',
                                'pt' => 'PT', 'ru' => 'RU', 'zh' => 'ZH', 'ar' => 'AR',
                                'hi' => 'HI', 'universal' => 'ALL'
                            ];
                        @endphp
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded text-xs font-medium">
                            {{ $langLabels[$word->language] ?? $word->language }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="font-medium text-gray-700">{{ $word->detection_count ?? 0 }}</span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <button onclick="toggleWordStatus({{ $word->id }})" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $word->is_active ? 'bg-green-500' : 'bg-gray-300' }}">
                            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $word->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                        </button>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="editWord({{ $word->id }})" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteWord({{ $word->id }})" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                        <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                        <p>Aucun mot interdit trouve</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($words->hasPages())
    <div class="mt-6">
        {{ $words->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Add/Edit Modal -->
<div id="wordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 id="wordModalTitle" class="text-lg font-semibold mb-4">Ajouter un mot interdit</h3>
        <form id="wordForm">
            <input type="hidden" id="wordId">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mot ou pattern *</label>
                <input type="text" id="wordInput" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Ex: whatsapp, +\d{10,}">
            </div>

            <div class="mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="isRegex" class="rounded text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Expression reguliere (regex)</span>
                </label>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categorie *</label>
                    <select id="wordCategory" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Selectionnez</option>
                        <option value="politics">Politique</option>
                        <option value="contact">Contact direct</option>
                        <option value="scam">Arnaque</option>
                        <option value="spam">Spam</option>
                        <option value="offensive">Offensant</option>
                        <option value="adult">Adulte</option>
                        <option value="violence">Violence</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Severite *</label>
                    <select id="wordSeverity" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="critical">Critique (blocage auto + strike)</option>
                        <option value="warning">Avertissement (revision admin)</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Langue *</label>
                <select id="wordLanguage" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="universal">Universel (toutes langues)</option>
                    <option value="fr">Francais</option>
                    <option value="en">English</option>
                    <option value="de">Deutsch</option>
                    <option value="es">Espanol</option>
                    <option value="pt">Portugues</option>
                    <option value="ru">Русский</option>
                    <option value="zh">中文</option>
                    <option value="ar">العربية</option>
                    <option value="hi">हिन्दी</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description (optionnel)</label>
                <textarea id="wordDescription" rows="2" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Pourquoi ce mot est interdit..."></textarea>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeWordModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 p-6">
        <h3 class="text-lg font-semibold mb-4">Importer des mots</h3>
        <form id="importForm" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fichier CSV</label>
                <input type="file" id="importFile" accept=".csv" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                <p class="text-xs text-gray-500 mt-1">Format: mot,categorie,severite,langue,description</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-blue-700">
                    <strong>Format attendu:</strong><br>
                    Ligne 1: En-tetes (ignores)<br>
                    Colonnes: word, category, severity, language, description
                </p>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeImportModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Importer</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-select {
    padding: 0.5rem 2rem 0.5rem 0.75rem;
    border: 1px solid var(--admin-border);
    border-radius: 0.5rem;
    background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") right 0.5rem center/1.5em 1.5em no-repeat;
    appearance: none;
}
</style>

<script>
// Store words data for editing
const wordsData = @json($words->keyBy('id'));

function filterWords() {
    const search = document.getElementById('searchWord').value.toLowerCase();
    const severity = document.getElementById('severityFilter').value;
    const category = document.getElementById('categoryFilter').value;
    const language = document.getElementById('languageFilter').value;

    document.querySelectorAll('.word-row').forEach(row => {
        const matchSearch = !search || row.dataset.word.includes(search);
        const matchSeverity = !severity || row.dataset.severity === severity;
        const matchCategory = !category || row.dataset.category === category;
        const matchLanguage = !language || row.dataset.language === language;

        row.style.display = (matchSearch && matchSeverity && matchCategory && matchLanguage) ? '' : 'none';
    });
}

function showAddModal() {
    document.getElementById('wordModalTitle').textContent = 'Ajouter un mot interdit';
    document.getElementById('wordId').value = '';
    document.getElementById('wordInput').value = '';
    document.getElementById('isRegex').checked = false;
    document.getElementById('wordCategory').value = '';
    document.getElementById('wordSeverity').value = 'critical';
    document.getElementById('wordLanguage').value = 'universal';
    document.getElementById('wordDescription').value = '';
    openModal('wordModal');
}

function editWord(wordId) {
    const word = wordsData[wordId];
    if (!word) return;

    document.getElementById('wordModalTitle').textContent = 'Modifier le mot interdit';
    document.getElementById('wordId').value = wordId;
    document.getElementById('wordInput').value = word.word;
    document.getElementById('isRegex').checked = word.is_regex;
    document.getElementById('wordCategory').value = word.category;
    document.getElementById('wordSeverity').value = word.severity;
    document.getElementById('wordLanguage').value = word.language;
    document.getElementById('wordDescription').value = word.description || '';
    openModal('wordModal');
}

function closeWordModal() {
    closeModal('wordModal');
}

function showImportModal() {
    document.getElementById('importFile').value = '';
    openModal('importModal');
}

function closeImportModal() {
    closeModal('importModal');
}

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

function toggleWordStatus(wordId) {
    fetch(`/admin/moderation/words/${wordId}/toggle`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            toastr.success(data.message);
            window.location.reload();
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

function deleteWord(wordId) {
    if (!confirm('Supprimer ce mot interdit ?')) return;

    fetch(`/admin/moderation/words/${wordId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`word-row-${wordId}`).remove();
            toastr.success(data.message);
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
}

document.getElementById('wordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const wordId = document.getElementById('wordId').value;
    const data = {
        word: document.getElementById('wordInput').value,
        is_regex: document.getElementById('isRegex').checked,
        category: document.getElementById('wordCategory').value,
        severity: document.getElementById('wordSeverity').value,
        language: document.getElementById('wordLanguage').value,
        description: document.getElementById('wordDescription').value
    };

    const url = wordId ? `/admin/moderation/words/${wordId}` : '/admin/moderation/words';
    const method = wordId ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeWordModal();
            toastr.success(data.message);
            window.location.reload();
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

document.getElementById('importForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('file', document.getElementById('importFile').files[0]);

    fetch('/admin/moderation/words/import', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeImportModal();
            toastr.success(data.message);
            window.location.reload();
        } else {
            toastr.error(data.message || 'Erreur');
        }
    })
    .catch(() => toastr.error('Erreur de connexion'));
});

// Close modals on outside click
['wordModal', 'importModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) closeModal(id);
    });
});
</script>
@endsection
