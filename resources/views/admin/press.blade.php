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

        <!-- LANGUAGE SELECTOR (CORRIGÉ) -->
        <div class="flex gap-2 flex-wrap mb-8">
            <button type="button" onclick="setLang('en')" class="lang-btn" data-lang="en" style="background-color: #2563eb; color: white; padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 500; border: none; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s;">🇬🇧 English</button>
            <button type="button" onclick="setLang('fr')" class="lang-btn" data-lang="fr" style="background-color: #d1d5db; color: #374151; padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s;">🇫🇷 Français</button>
            <button type="button" onclick="setLang('de')" class="lang-btn" data-lang="de" style="background-color: #d1d5db; color: #374151; padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s;">🇩🇪 Deutsch</button>
        </div>
    </div>

    <!-- TABS: Kit vs Releases -->
    <div class="mb-8 flex gap-4">
        <button id="tab-kit" onclick="switchTab('kit')" class="tab-btn active px-6 py-3 rounded-lg font-semibold bg-blue-600 text-white transition-all">📦 Kit Presse</button>
        <button id="tab-releases" onclick="switchTab('releases')" class="tab-btn px-6 py-3 rounded-lg font-semibold bg-gray-300 text-gray-700 transition-all">📢 Communiqués de Presse</button>
    </div>

    <!-- TAB 1: PRESS KIT -->
    <div id="tab-content-kit" class="tab-content">
        <div id="grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8"></div>
    </div>

    <!-- TAB 2: PRESS RELEASES -->
    <div id="tab-content-releases" class="tab-content hidden">
        <div class="mb-6">
            <button onclick="openReleaseModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition-all">+ Ajouter un Communiqué</button>
        </div>
        <div id="releases-list" class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Communiqués de Presse</h2>
            <div id="releases-container" class="space-y-4"></div>
        </div>
    </div>

    <!-- DELETE ALL BUTTON -->
    <form action="{{ route('admin.press.deleteAll') }}" method="POST" 
          onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer TOUS les fichiers de presse?')"
          class="mt-8 mb-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
            🗑️ Supprimer tous les fichiers
        </button>
    </form>

    <!-- EXISTING ENTRIES (ALL LANGUAGES) -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Tous les Fichiers Presse</h2>
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
                                $typeLabel = $item->type === 'kit' ? 'Kit' : 'Communiqué';
                                $typeColor = $item->type === 'kit' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';
                            @endphp
                            <div class="flex gap-2 mb-2 flex-wrap">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold {{ $lang['color'] }}">
                                    {{ $lang['flag'] }} {{ $lang['name'] }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold {{ $typeColor }}">
                                    {{ $typeLabel }}
                                </span>
                            </div>
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
                                    <button type="button" class="text-blue-600 hover:underline" onclick="openPreviewModal('{{ route('press.preview', [$item->id, 'pdf']) }}')">📄 Aperçu PDF</button>
                                    <a href="{{ asset('storage/'.$item->pdf) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->guideline_pdf)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline" onclick="openPreviewModal('{{ route('press.preview', [$item->id, 'guideline_pdf']) }}')">📘 Aperçu Guide</button>
                                    <a href="{{ asset('storage/'.$item->guideline_pdf) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->photo)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline" onclick="openPreviewModal('{{ route('press.preview', [$item->id, 'photo']) }}')">🖼️ Aperçu Photo</button>
                                    <a href="{{ asset('storage/'.$item->photo) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                            @if($item->icon)
                                <div class="flex items-center gap-3">
                                    <button type="button" class="text-blue-600 hover:underline" onclick="openPreviewModal('{{ route('press.preview', [$item->id, 'icon']) }}')">🧩 Aperçu Logo</button>
                                    <a href="{{ asset('storage/'.$item->icon) }}" download class="text-gray-500 hover:underline">Télécharger</a>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.press.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer ce fichier?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-semibold transition">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $pressItems->links() }}</div>
        @endif
    </div>

</div>

<!-- MODAL FOR RELEASE -->
<div id="releaseModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl p-6">
        <h2 class="text-2xl font-bold mb-4">Ajouter un Communiqué de Presse</h2>
        <form id="releaseForm" onsubmit="submitRelease(event)">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Titre *</label>
                <input type="text" id="release-title" required class="w-full border-2 border-gray-300 rounded-lg p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Description *</label>
                <textarea id="release-description" required rows="4" class="w-full border-2 border-gray-300 rounded-lg p-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Fichier PDF *</label>
                <input type="file" id="release-pdf" accept=".pdf" required class="w-full border-2 border-gray-300 rounded-lg p-2">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Créer</button>
                <button type="button" onclick="closeReleaseModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-400 transition">Annuler</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL FOR PREVIEW -->
<div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-2xl max-h-96 rounded-xl shadow-2xl overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="font-semibold">Aperçu</h3>
            <button onclick="closePreviewModal()" class="text-2xl text-gray-400 hover:text-gray-600">×</button>
        </div>
        <div class="p-4 overflow-auto max-h-72">
            <iframe id="previewFrame" class="w-full h-full" style="min-height: 300px;"></iframe>
        </div>
    </div>
</div>

<style>
    .tab-btn {
        transition: all 0.3s ease;
    }
    .tab-btn.active {
        background-color: #2563eb;
        color: white;
    }
    .tab-content.hidden {
        display: none;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
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
            logo: { icon: '🎨', title: 'Official Logo', desc: 'PNG/SVG formats • High resolution • Transparent background' },
            pdf: { icon: '📑', title: 'Press Kit', desc: 'Complete information • Company details • PDF format' },
            guideline_pdf: { icon: '📘', title: 'Brand Guidelines', desc: 'Logo usage • Brand standards • Color palette • PDF' },
            photo: { icon: '📷', title: 'HD Photos', desc: 'Professional images • High quality • Print ready' }
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

    const langNames = { en: '🇬🇧 English', fr: '🇫🇷 Français', de: '🇩🇪 Deutsch' };
    const langEmojis = { en: '🇬🇧', fr: '🇫🇷', de: '🇩🇪' };
    
    let currentLang = 'en';
    let currentTab = 'kit';
    let existingFiles = {};

    function switchTab(tab) {
        currentTab = tab;
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById('tab-content-' + tab).classList.remove('hidden');
        
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');
        
        if (tab === 'releases') {
            loadReleases();
        } else {
            loadFiles();
        }
    }

    function loadFiles() {
        return fetch('/admin/press/files?language=' + currentLang + '&item_type=kit')
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

    function loadReleases() {
        return fetch('/admin/press/files?language=' + currentLang + '&item_type=release')
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    renderReleases(d);
                }
            })
            .catch(e => console.error('Erreur:', e));
    }

    function renderReleases(data) {
        const container = document.getElementById('releases-container');
        container.innerHTML = '';
        
        if (!data.releases || data.releases.length === 0) {
            container.innerHTML = '<p class="text-gray-500">Aucun communiqué pour cette langue</p>';
            return;
        }

        data.releases.forEach(release => {
            const html = `
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <h3 class="font-bold">${release.title}</h3>
                            <p class="text-sm text-gray-600">${release.description}</p>
                        </div>
                        <button onclick="deleteRelease(${release.id})" class="text-red-600 hover:text-red-800 ml-2">🗑️</button>
                    </div>
                    ${release.pdf ? `<p class="text-sm"><a href="${release.pdf_url}" class="text-blue-600 hover:underline" target="_blank">📄 PDF</a></p>` : ''}
                </div>
            `;
            container.innerHTML += html;
        });
    }

    function setLang(lang) {
        currentLang = lang;
        document.getElementById('langTitle').textContent = langNames[lang];
        document.getElementById('langEmoji').textContent = langEmojis[lang];
        
        // Réinitialiser TOUS les boutons
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.style.backgroundColor = '#d1d5db';
            btn.style.color = '#374151';
            btn.style.boxShadow = 'none';
        });
        
        // Activer le bouton courant
        const activeBtn = document.querySelector(`[data-lang="${lang}"]`);
        if (activeBtn) {
            activeBtn.style.backgroundColor = '#2563eb';
            activeBtn.style.color = 'white';
            activeBtn.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
        }
        
        // Recharger selon l'onglet
        if (currentTab === 'kit') {
            loadFiles().then(() => render());
        } else {
            loadReleases();
        }
    }

    function render() {
        const grid = document.getElementById('grid');
        grid.innerHTML = '';
        const langData = labels[currentLang];
        
        Object.entries(langData).forEach(([type, item]) => {
            const hasFile = existingFiles[type] ? true : false;
            const fileUrl = existingFiles[type] ? existingFiles[type].url : null;
            
            const card = document.createElement('div');
            card.className = 'card';
            
            let buttonHtml = `
                <button class="btn btn-upload" onclick="document.getElementById('file-${type}').click()">
                    ${hasFile ? '🔄 Remplacer' : '📤 Uploader'}
                </button>
            `;
            
            if (hasFile) {
                buttonHtml += `
                    <button class="btn btn-view" onclick="previewFile('${type}', '${currentLang}', '${fileUrl}')">👁️ Voir</button>
                    <button class="btn btn-delete" onclick="removeFile('${type}', '${currentLang}')">🗑️ Supprimer</button>
                `;
            }
            
            card.innerHTML = `
                <div class="icon">${item.icon}</div>
                <div class="title">${item.title}</div>
                <div class="desc">${item.desc}</div>
                
                <div class="file-status ${hasFile ? 'exists' : 'empty'}">
                    ${hasFile ? '✅ Fichier présent' : '❌ Aucun fichier'}
                </div>
                
                ${buttonHtml}
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
        form.append('item_type', 'kit');
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

    function removeFile(type, lang) {
        if (!confirm('Supprimer ce fichier?')) return;
        fetch('/admin/press/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content },
            body: JSON.stringify({ type, language: lang, item_type: 'kit' })
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

    function previewFile(type, lang, url) {
        if (!url) {
            alert('Fichier non disponible');
            return;
        }
        openPreviewModal(url);
    }

    function openReleaseModal() {
        document.getElementById('releaseModal').classList.remove('hidden');
    }

    function closeReleaseModal() {
        document.getElementById('releaseModal').classList.add('hidden');
        document.getElementById('releaseForm').reset();
    }

    function submitRelease(event) {
        event.preventDefault();
        const form = new FormData();
        form.append('title', document.getElementById('release-title').value);
        form.append('description', document.getElementById('release-description').value);
        form.append('file', document.getElementById('release-pdf').files[0]);
        form.append('language', currentLang);
        form.append('type', 'pdf');
        form.append('item_type', 'release');
        form.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch('/admin/press/upload', { method: 'POST', body: form })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    notify('✅ Communiqué créé!', 'success');
                    closeReleaseModal();
                    loadReleases();
                } else {
                    notify('❌ Erreur', 'error');
                }
            })
            .catch(e => notify('❌ Erreur', 'error'));
    }

    function deleteRelease(id) {
        if (!confirm('Supprimer ce communiqué?')) return;
        fetch(`/admin/press/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => {
            notify('✅ Communiqué supprimé!', 'success');
            loadReleases();
        })
        .catch(e => notify('❌ Erreur', 'error'));
    }

    function openPreviewModal(url) {
        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewFrame').src = url;
    }

    function closePreviewModal() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewFrame').src = '';
    }

    function notify(msg, type) {
        const n = document.createElement('div');
        n.className = `notification ${type}`;
        n.textContent = msg;
        document.body.appendChild(n);
        setTimeout(() => n.remove(), 3000);
    }

    window.addEventListener('DOMContentLoaded', () => {
        setLang('en');
    });
</script>
@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold mb-6">📰 Messages Presse</h1>

  <div class="flex gap-3 mb-4">
    <select id="filterStatus" class="border rounded px-3 py-2">
      <option value="">Tous statuts</option>
      <option value="pending">pending</option>
      <option value="read">read</option>
      <option value="responded">responded</option>
      <option value="archived">archived</option>
    </select>
    <input id="search" class="border rounded px-3 py-2" placeholder="Recherche…">
    <button onclick="loadInquiries()" class="bg-blue-600 text-white px-4 py-2 rounded">Recharger</button>
  </div>

  <div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full">
      <thead>
        <tr class="bg-gray-50 text-left text-sm">
          <th class="p-3">Date</th>
          <th class="p-3">Media</th>
          <th class="p-3">Nom</th>
          <th class="p-3">Email</th>
          <th class="p-3">Message</th>
          <th class="p-3">Statut</th>
          <th class="p-3"></th>
        </tr>
      </thead>
      <tbody id="rows"></tbody>
    </table>
  </div>

  <div class="flex justify-between items-center mt-4">
    <button id="prev" class="px-3 py-2 border rounded" disabled>Précédent</button>
    <span id="meta" class="text-sm text-gray-600"></span>
    <button id="next" class="px-3 py-2 border rounded" disabled>Suivant</button>
  </div>
</div>

<script>
let nextUrl = null, prevUrl = null;

async function loadInquiries(url = null) {
  const params = new URLSearchParams();
  const status = document.getElementById('filterStatus').value;
  const search = document.getElementById('search').value.trim();
  if (status) params.set('status', status);
  if (search) params.set('search', search);

  const endpoint = url ?? ('/admin/press/inquiries/list' + (params.toString() ? ('?' + params.toString()) : ''));
  const res = await fetch(endpoint, { headers: { 'Accept': 'application/json' }});
  const data = await res.json();

  const tbody = document.getElementById('rows');
  tbody.innerHTML = '';

  data.data.forEach(row => {
    const tr = document.createElement('tr');
    tr.className = 'border-t';
    tr.innerHTML = `
      <td class="p-3 text-sm">${new Date(row.created_at).toLocaleString()}</td>
      <td class="p-3 text-sm">${esc(row.media_name ?? '')}</td>
      <td class="p-3 text-sm">${esc(row.full_name ?? '')}</td>
      <td class="p-3 text-sm"><a class="text-blue-600" href="mailto:${att(row.email)}">${esc(row.email)}</a></td>
      <td class="p-3 text-sm max-w-[420px] truncate" title="${att(row.message)}">${esc((row.message ?? '').slice(0, 120))}</td>
      <td class="p-3 text-sm">${esc(row.status)}</td>
      <td class="p-3 text-sm">
        ${row.status === 'pending' ? `<button onclick="markAsRead(${row.id})" class="px-2 py-1 border rounded">Marquer lu</button>` : ''}
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById('meta').textContent = `Page ${data.current_page} / ${data.last_page} • ${data.total} messages`;
  nextUrl = data.next_page_url;
  prevUrl = data.prev_page_url;
  document.getElementById('next').disabled = !nextUrl;
  document.getElementById('prev').disabled = !prevUrl;
}

async function markAsRead(id) {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  await fetch(`/admin/press/inquiries/${id}/read`, { method: 'PATCH', headers: { 'X-CSRF-TOKEN': csrf }});
  loadInquiries();
}

document.getElementById('next').onclick = () => loadInquiries(nextUrl);
document.getElementById('prev').onclick = () => loadInquiries(prevUrl);

function esc(s){ return (s??'').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }
function att(s){ return (s??'').replace(/"/g,'&quot;'); }

document.addEventListener('DOMContentLoaded', () => loadInquiries());
</script>
@endsection
