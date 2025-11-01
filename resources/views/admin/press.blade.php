@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="container mx-auto px-4 py-8">
    <!-- BANDEAU LANGUE ACTUELLE -->
    <div id="langBanner" class="mb-8 p-6 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90">Langue actuelle</p>
                <h2 id="langTitle" class="text-3xl font-bold">🇬🇧 English</h2>
            </div>
            <div class="text-6xl" id="langEmoji">🇬🇧</div>
        </div>
    </div>

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">📰 Centre de Presse</h1>
        <p class="text-gray-600 mb-6">Gérez vos documents de presse en 3 langues</p>

        <!-- LANGUAGE SELECTOR -->
        <div class="flex gap-2 flex-wrap mb-8">
            <button onclick="setLang('en')" class="lang-btn px-6 py-2 rounded-lg font-medium bg-blue-600 text-white transition-all shadow-lg ring-4 ring-blue-300 hover:shadow-xl" data-lang="en">🇬🇧 English</button>
            <button onclick="setLang('fr')" class="lang-btn px-6 py-2 rounded-lg font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all" data-lang="fr">🇫🇷 Français</button>
            <button onclick="setLang('de')" class="lang-btn px-6 py-2 rounded-lg font-medium bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all" data-lang="de">🇩🇪 Deutsch</button>
        </div>
    </div>

    <!-- GRILLE DE 4 CARTES -->
    <div id="grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"></div>

    <!-- DELETE ALL BUTTON -->
    <form action="{{ route('admin.press.deleteAll') }}" method="POST" 
          onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer TOUS les fichiers de presse?')"
          class="mb-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold">
            🗑️ Supprimer tous les fichiers
        </button>
    </form>

    <!-- EXISTING ENTRIES -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Fichiers existants (Toutes les langues)</h2>
        @if ($pressItems->count() === 0)
            <p class="text-gray-500">Aucun fichier pour le moment.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($pressItems as $item)
                    <div class="border rounded-xl p-4 hover:shadow-lg transition-shadow">
                        <div class="mb-3">
                            @php
                                $langConfig = [
                                    'en' => ['flag' => '🇬🇧', 'name' => 'English', 'color' => 'bg-blue-100 text-blue-800'],
                                    'fr' => ['flag' => '🇫🇷', 'name' => 'Français', 'color' => 'bg-red-100 text-red-800'],
                                    'de' => ['flag' => '🇩🇪', 'name' => 'Deutsch', 'color' => 'bg-yellow-100 text-yellow-800'],
                                ];
                                $lang = $langConfig[$item->language] ?? ['flag' => '🌍', 'name' => 'Unknown', 'color' => 'bg-gray-100 text-gray-800'];
                            @endphp
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold {{ $lang['color'] }}">
                                <span>{{ $lang['flag'] }}</span>
                                <span>{{ $lang['name'] }}</span>
                            </span>
                        </div>
                        <div class="flex items-center gap-3 mb-3">
                            @php
                                $iconUrl = $item->icon ? route('press.preview', [$item->id, 'icon']) : null;
                            @endphp
                            @if($iconUrl)
                                <img src="{{ $iconUrl }}" alt="icon" class="w-10 h-10 object-cover rounded-md">
                            @else
                                <div class="w-10 h-10 rounded-md bg-gray-100 flex items-center justify-center text-gray-400">🗂️</div>
                            @endif
                            <div class="flex-1">
                                <div class="font-semibold">{{ $item->title ?? 'Sans titre' }}</div>
                                <div class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        @if($item->description)
                            <p class="text-sm text-gray-700 mb-3 line-clamp-3">{{ $item->description }}</p>
                        @endif
                        <div class="space-y-2 text-sm mb-3">
                            @if($item->pdf)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('press.preview', [$item->id, 'pdf']) }}')">
                                        📄 Aperçu PDF
                                    </button>
                                    <a href="{{ asset('storage/'.$item->pdf) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->guideline_pdf)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('press.preview', [$item->id, 'guideline_pdf']) }}')">
                                        📘 Aperçu Guide
                                    </button>
                                    <a href="{{ asset('storage/'.$item->guideline_pdf) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->photo)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('press.preview', [$item->id, 'photo']) }}')">
                                        🖼️ Aperçu Photo
                                    </button>
                                    <a href="{{ asset('storage/'.$item->photo) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->icon)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline"
                                            onclick="openCvModal('{{ route('press.preview', [$item->id, 'icon']) }}')">
                                        🧩 Aperçu Logo
                                    </button>
                                    <a href="{{ asset('storage/'.$item->icon) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.press.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer ce fichier?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-semibold transition">
                                🗑️ Supprimer ce fichier
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $pressItems->links() }}</div>
        @endif
    </div>

</div>

<!-- MODAL -->
<div id="cvModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
  <div class="bg-white w-full max-w-5xl h-5/6 rounded-xl shadow-2xl overflow-hidden animate-fade-in">
    <div class="flex justify-between items-center px-6 py-4 bg-gray-50 border-b">
      <h3 id="cvModalTitle" class="font-semibold text-gray-800">Aperçu</h3>
      <button onclick="closeCvModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
    </div>
    <div class="relative h-full">
      <iframe id="cvFrame" src="" class="w-full h-full bg-gray-100"></iframe>
      <div id="cvLoader" class="absolute inset-0 bg-white flex items-center justify-center">
        <div class="flex items-center space-x-2">
          <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          <span class="text-gray-600">Chargement...</span>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
    @keyframes fade-in { from {opacity:0; transform:scale(0.95)} to {opacity:1; transform:scale(1)} }
    .animate-fade-in { animation: fade-in 0.2s ease-out }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

    .card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s;
        border: 2px solid transparent;
        position: relative;
        min-height: 450px;
    }
    .card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transform: translateY(-4px);
        border-color: #3b82f6;
    }
    .icon { font-size: 3rem; margin-bottom: 12px; }
    .title { font-size: 1.25rem; font-weight: 700; margin-bottom: 8px; color: #1f2937; }
    .desc { font-size: 0.875rem; color: #6b7280; margin-bottom: 16px; line-height: 1.5; }
    
    .file-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 16px;
    }
    .file-status.exists {
        background: #d1fae5;
        color: #065f46;
    }
    .file-status.empty {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .btn {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        margin-bottom: 8px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-upload { background: #3b82f6; color: white; }
    .btn-upload:hover { background: #2563eb; transform: scale(1.02); }
    .btn-view { border: 2px solid #3b82f6; color: #3b82f6; background: white; }
    .btn-view:hover { background: #eff6ff; }
    .btn-delete { background: #ef4444; color: white; }
    .btn-delete:hover { background: #dc2626; }
    input[type="file"] { display: none; }
    .notification {
        position: fixed;
        top: 1rem;
        right: 1rem;
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 50;
        animation: slideIn 0.3s ease;
    }
    .notification.success { background: #10b981; }
    .notification.error { background: #ef4444; }
    @keyframes slideIn { from { transform: translateX(400px); } to { transform: translateX(0); } }
</style>

<script>
    const labels = {
        en: {
            logo: { icon: '🎨', title: 'Logo officiel', desc: 'Formats PNG/SVG • Haute résolution • Fond transparent' },
            pdf: { icon: '📑', title: 'Dossier de presse', desc: 'Information complète • Détails sur l\'entreprise • Format PDF' },
            guideline_pdf: { icon: '📘', title: 'Charte graphique', desc: 'Utilisation du logo • Normes de la marque • Palette de couleurs • PDF' },
            photo: { icon: '📷', title: 'Photos HD', desc: 'Images professionnelles • Haute qualité • Prêtes à imprimer' }
        },
        fr: {
            logo: { icon: '🎨', title: 'Logo officiel', desc: 'Formats PNG/SVG • Haute résolution • Fond transparent' },
            pdf: { icon: '📑', title: 'Dossier de presse', desc: 'Information complète • Détails sur l\'entreprise • Format PDF' },
            guideline_pdf: { icon: '📘', title: 'Charte graphique', desc: 'Utilisation du logo • Normes de la marque • Palette de couleurs • PDF' },
            photo: { icon: '📷', title: 'Photos HD', desc: 'Images professionnelles • Haute qualité • Prêtes à imprimer' }
        },
        de: {
            logo: { icon: '🎨', title: 'Offizielles Logo', desc: 'PNG/SVG-Formate • Hohe Auflösung • Transparenter Hintergrund' },
            pdf: { icon: '📑', title: 'Pressemappe', desc: 'Vollständige Informationen • Unternehmensdetails • PDF-Format' },
            guideline_pdf: { icon: '📘', title: 'Markenrichtlinie', desc: 'Logo-Verwendung • Markenstandards • Farbpalette • PDF' },
            photo: { icon: '📷', title: 'HD-Fotos', desc: 'Professionelle Bilder • Hohe Qualität • Druckfertig' }
        }
    };

    const langNames = {
        en: '🇬🇧 English',
        fr: '🇫🇷 Français',
        de: '🇩🇪 Deutsch'
    };

    const langEmojis = { en: '🇬🇧', fr: '🇫🇷', de: '🇩🇪' };
    let currentLang = 'en';
    let existingFiles = {};

    function loadFiles() {
        return fetch('/admin/press/files?language=' + currentLang)
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    existingFiles = d.files || {};
                }
                return true;
            })
            .catch(e => {
                console.error('Erreur:', e);
                return false;
            });
    }

    function setLang(lang) {
        currentLang = lang;
        
        // Update banner
        document.getElementById('langTitle').textContent = langNames[lang];
        document.getElementById('langEmoji').textContent = langEmojis[lang];
        
        // Update buttons
        document.querySelectorAll('.lang-btn').forEach(b => {
            b.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'ring-4', 'ring-blue-300', 'hover:shadow-xl');
            b.classList.add('bg-gray-200', 'text-gray-700');
        });
        
        // Ajouter les styles au bouton actif
        const activeBtn = document.querySelector(`[data-lang="${lang}"]`);
        activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'ring-4', 'ring-blue-300', 'hover:shadow-xl');
        activeBtn.classList.remove('bg-gray-200', 'text-gray-700');
        
        // Load and render
        loadFiles().then(() => render());
    }

    function render() {
        const grid = document.getElementById('grid');
        grid.innerHTML = '';
        const langData = labels[currentLang];
        
        Object.entries(langData).forEach(([type, item]) => {
            const hasFile = existingFiles[type] ? true : false;
            const card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `
                <div class="icon">${item.icon}</div>
                <div class="title">${item.title}</div>
                <div class="desc">${item.desc}</div>
                
                <div class="file-status ${hasFile ? 'exists' : 'empty'}">
                    ${hasFile ? '✅ Fichier présent' : '❌ Aucun fichier'}
                </div>
                
                <button class="btn btn-upload" onclick="document.getElementById('file-${type}').click()">📤 Uploader</button>
                <button class="btn btn-view" onclick="preview('${type}', '${currentLang}')">👁️ Voir</button>
                <button class="btn btn-delete" onclick="remove('${type}', '${currentLang}')">🗑️ Supprimer</button>
                <input type="file" id="file-${type}" onchange="upload('${type}', '${currentLang}', this)">
            `;
            grid.appendChild(card);
        });
    }

    function upload(type, lang, input) {
        if (!input.files[0]) return;
        const form = new FormData();
        form.append('file', input.files[0]);
        form.append('type', type);
        form.append('language', lang);
        form.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch('/admin/press/upload', { method: 'POST', body: form })
            .then(r => r.json())
            .then(d => {
                notify(d.success ? '✅ Fichier uploadé!' : '❌ Erreur', d.success ? 'success' : 'error');
                if (d.success) {
                    input.value = '';
                    loadFiles().then(() => render());
                }
            })
            .catch(e => notify('❌ Erreur', 'error'));
    }

    function remove(type, lang) {
        if (!confirm('Supprimer ce fichier?')) return;
        fetch('/admin/press/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ type, language: lang })
        })
        .then(r => r.json())
        .then(d => {
            notify(d.success ? '✅ Fichier supprimé!' : '❌ Erreur', d.success ? 'success' : 'error');
            if (d.success) {
                loadFiles().then(() => render());
            }
        })
        .catch(e => notify('❌ Erreur', 'error'));
    }

    function preview(type, lang) {
        alert('Prévisualisation à implémenter');
    }

    function notify(msg, type) {
        const n = document.createElement('div');
        n.className = `notification ${type}`;
        n.textContent = msg;
        document.body.appendChild(n);
        setTimeout(() => n.remove(), 3000);
    }

    function openCvModal(url, title = 'Aperçu') {
        const modal = document.getElementById('cvModal');
        const frame = document.getElementById('cvFrame');
        const loader = document.getElementById('cvLoader');
        const heading = document.getElementById('cvModalTitle');
        heading.textContent = title;
        modal.classList.remove('hidden');
        loader.style.display = 'flex';
        frame.onload = function() { loader.style.display = 'none'; };
        frame.src = url;
    }

    function closeCvModal() {
        const modal = document.getElementById('cvModal');
        const frame = document.getElementById('cvFrame');
        const loader = document.getElementById('cvLoader');
        frame.src = "";
        modal.classList.add('hidden');
        loader.style.display = 'flex';
    }

    document.getElementById('cvModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeCvModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('cvModal').classList.contains('hidden')) {
            closeCvModal();
        }
    });

    // Initialize
    window.addEventListener('DOMContentLoaded', () => {
        loadFiles().then(() => render());
    });
</script>

@endsection