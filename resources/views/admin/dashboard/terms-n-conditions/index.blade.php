@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.settings') }}">Parametres</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Conditions generales</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Conditions generales</h1>
        <p class="page-subtitle">Gerez les differentes conditions generales de la plateforme</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-4 overflow-x-auto" aria-label="Tabs">
                @foreach($types as $typeKey => $typeLabel)
                <button type="button"
                    class="terms-tab whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                    data-type="{{ $typeKey }}"
                    onclick="switchTab('{{ $typeKey }}')">
                    @if($typeKey === 'general')
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    @elseif($typeKey === 'client')
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @elseif($typeKey === 'provider')
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    @elseif($typeKey === 'affiliate')
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                    {{ $typeLabel }}
                </button>
                @endforeach
            </nav>
        </div>
    </div>

    <form id="termsForm">
        <!-- Terms & Conditions Editor -->
        <div class="admin-card mb-6">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 id="sectionTitle" class="font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span id="editorTitle">Conditions generales d'utilisation</span>
                </h2>
                <p class="text-sm text-gray-500 mt-1">Modifiez le texte complet des conditions ci-dessous</p>
            </div>

            <div class="p-6">
                <!-- Quick Insert Buttons -->
                <div class="mb-4 flex flex-wrap gap-2">
                    <span class="text-xs text-gray-500 mr-2 self-center">Inserer:</span>
                    <button type="button" onclick="insertTemplate('h2')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Titre H2</button>
                    <button type="button" onclick="insertTemplate('h3')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Titre H3</button>
                    <button type="button" onclick="insertTemplate('p')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Paragraphe</button>
                    <button type="button" onclick="insertTemplate('ul')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Liste</button>
                    <button type="button" onclick="insertTemplate('strong')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Gras</button>
                    <button type="button" onclick="insertTemplate('blockquote')" class="px-3 py-1 text-xs bg-gray-100 hover:bg-gray-200 rounded-full transition">Citation</button>
                </div>

                <div>
                    <label for="content" class="block text-xs font-medium text-gray-500 mb-2">
                        Contenu des conditions generales (HTML autorise)
                    </label>
                    <textarea id="content" name="content"
                        class="form-input font-mono text-sm w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        rows="25" placeholder="Ecrivez vos conditions generales ici..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">
                        Astuce : Vous pouvez utiliser le formatage HTML comme &lt;h2&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;p&gt;, etc.
                        Utilisez <code class="bg-gray-100 px-1 rounded">@site</code> pour inserer automatiquement le nom du site.
                    </p>
                </div>
            </div>
        </div>

        <!-- Suggested Clauses -->
        <div class="admin-card mb-6 bg-amber-50 border-amber-200">
            <div class="px-6 py-4 border-b border-amber-200">
                <h3 class="font-semibold text-amber-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Clauses suggerees
                </h3>
            </div>
            <div class="p-6">
                <div id="suggestedClauses" class="space-y-3">
                    <!-- Clauses will be populated by JavaScript based on selected type -->
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="admin-card mb-6">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Apercu
                </h3>
                <button type="button" onclick="updatePreview()" class="text-sm text-blue-600 hover:text-blue-800">
                    Rafraichir l'apercu
                </button>
            </div>
            <div class="p-6">
                <div id="preview" class="prose prose-sm max-w-none bg-gray-50 rounded-lg p-6 min-h-[200px]">
                    <p class="text-gray-400 italic">L'apercu apparaitra ici...</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between gap-4 bg-white rounded-lg p-4 shadow-sm border">
            <div class="flex items-center gap-4">
                <a href="#" id="viewPublicPage" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Voir la page publique
                </a>
                <span id="saveMsg" class="text-sm text-gray-500"></span>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" id="cancelBtn" class="btn btn-secondary px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button type="submit" id="saveBtn" class="btn btn-primary px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer
                </button>
            </div>
        </div>
    </form>
</div>

<style>
.terms-tab {
    border-color: transparent;
    color: #6B7280;
}
.terms-tab:hover {
    border-color: #D1D5DB;
    color: #374151;
}
.terms-tab.active {
    border-color: #2563EB;
    color: #2563EB;
}
.prose h1, .prose h2, .prose h3, .prose h4 {
    font-weight: 700;
    color: #1F2937;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}
.prose h2 { font-size: 1.5rem; }
.prose h3 { font-size: 1.25rem; }
.prose p { margin-bottom: 1rem; color: #4B5563; }
.prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
.prose li { margin-bottom: 0.5rem; }
.prose strong { color: #1F2937; }
.prose blockquote {
    border-left: 4px solid #2563EB;
    padding-left: 1rem;
    margin: 1rem 0;
    color: #6B7280;
    font-style: italic;
}
.suggested-clause {
    background: white;
    border: 1px solid #FCD34D;
    border-radius: 8px;
    padding: 12px 16px;
    cursor: pointer;
    transition: all 0.2s;
}
.suggested-clause:hover {
    background: #FEF3C7;
    border-color: #F59E0B;
}
.suggested-clause h4 {
    font-size: 14px;
    font-weight: 600;
    color: #92400E;
    margin-bottom: 4px;
}
.suggested-clause p {
    font-size: 12px;
    color: #78716C;
    margin: 0;
}
</style>

@push('scripts')
<script>
(() => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const form = document.getElementById('termsForm');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveBtn = document.getElementById('saveBtn');
    const saveMsg = document.getElementById('saveMsg');
    const contentField = document.getElementById('content');
    const previewEl = document.getElementById('preview');
    const editorTitle = document.getElementById('editorTitle');
    const viewPublicPage = document.getElementById('viewPublicPage');
    const suggestedClausesEl = document.getElementById('suggestedClauses');

    let sectionId = null;
    let currentType = 'general';

    const publicUrls = {
        general: '{{ route("terms.show") }}',
        client: '{{ route("terms.client") }}',
        provider: '{{ route("terms.provider") }}',
        affiliate: '{{ route("terms.affiliate") }}'
    };

    const typeTitles = {
        general: "Conditions generales d'utilisation",
        client: "Conditions generales clients",
        provider: "Conditions generales prestataires",
        affiliate: "Conditions generales d'affiliation"
    };

    const suggestedClauses = {
        client: [
            {
                title: "Annulation de commande - Frais de service",
                html: `<h3>Annulation de commande</h3>
<p>En cas d'annulation d'une commande par le client, quelle qu'en soit la raison :</p>
<ul>
<li>Les <strong>frais de service</strong> supportes par le client <strong>ne sont pas rembourses</strong>.</li>
<li>Ces frais sont credites sur la <strong>tirelire du client</strong> accessible depuis son tableau de bord.</li>
<li>Le montant credite sera automatiquement <strong>deduit lors d'une prochaine commande</strong>.</li>
</ul>
<p>Cette politique s'applique a toutes les annulations, y compris celles effectuees avant le debut de la mission.</p>`
            }
        ],
        provider: [
            {
                title: "Commissions d'affiliation - Calcul HT",
                html: `<h3>Programme d'affiliation - Calcul des commissions</h3>
<p>Les commissions d'affiliation sont calculees sur le <strong>montant hors taxes (HT)</strong> des frais de service.</p>
<p>La TVA ou autres taxes applicables ne sont pas incluses dans la base de calcul des commissions.</p>`
            },
            {
                title: "Conformite legale - Utilisation des liens affilies",
                html: `<h3>Utilisation des liens d'affiliation</h3>
<p>En participant au programme d'affiliation, le prestataire s'engage a :</p>
<ul>
<li><strong>Se conformer a la legislation</strong> de son pays de residence concernant la promotion de services en ligne, la publicite et le marketing d'affiliation.</li>
<li>Respecter toutes les <strong>obligations fiscales et declaratives</strong> applicables aux revenus generes par l'affiliation.</li>
</ul>
<p><strong>En cas de manquement</strong> a ces obligations, le prestataire est <strong>seul responsable</strong>. La responsabilite de @site ne pourra en aucun cas etre engagee pour les consequences juridiques, fiscales ou financieres resultant du non-respect de ces obligations par l'affilie.</p>`
            }
        ],
        affiliate: [
            {
                title: "Calcul des commissions sur le HT",
                html: `<h3>Base de calcul des commissions</h3>
<p>Les commissions d'affiliation sont calculees exclusivement sur le <strong>montant hors taxes (HT)</strong> des frais de service percus par @site.</p>
<p>Sont exclus de la base de calcul :</p>
<ul>
<li>La TVA et toutes autres taxes applicables</li>
<li>Les eventuels frais bancaires ou de transaction</li>
<li>Les remboursements et avoir</li>
</ul>`
            },
            {
                title: "Conformite legale obligatoire",
                html: `<h3>Obligations legales de l'affilie</h3>
<p>En utilisant son lien d'affiliation, l'affilie s'engage a :</p>
<ul>
<li><strong>Se conformer integralement a la legislation</strong> en vigueur dans son pays de residence et dans les pays ou il effectue sa promotion.</li>
<li>Respecter les regles relatives a la <strong>publicite en ligne</strong>, au <strong>marketing d'affiliation</strong>, et a la <strong>protection des donnees personnelles</strong> (RGPD, CCPA, etc.).</li>
<li>Declarer et payer les <strong>impots et charges sociales</strong> applicables aux revenus generes.</li>
</ul>
<h4>Exoneration de responsabilite</h4>
<p><strong>En cas de manquement</strong> aux obligations legales precitees, l'affilie est <strong>seul et entierement responsable</strong> des consequences juridiques, fiscales, administratives ou financieres qui pourraient en decouler.</p>
<p>La <strong>responsabilite de @site ne pourra en aucun cas etre engagee</strong> du fait des agissements de l'affilie, de ses manquements ou de son non-respect de la reglementation applicable.</p>`
            },
            {
                title: "Pratiques interdites",
                html: `<h3>Pratiques interdites</h3>
<p>L'affilie s'interdit formellement de :</p>
<ul>
<li>Utiliser des techniques de <strong>spam</strong> ou de sollicitation non desiree</li>
<li>Faire de la <strong>publicite mensongere</strong> ou trompeuse</li>
<li>Usurper l'identite de @site ou de ses representants</li>
<li>Utiliser des <strong>techniques de referencement abusif</strong> (black hat SEO)</li>
<li>Creer de <strong>faux avis</strong> ou temoignages</li>
</ul>
<p>Tout manquement a ces regles entrainera la <strong>suspension immediate</strong> du compte affilie et la <strong>perte des commissions</strong> non encore versees.</p>`
            }
        ],
        general: []
    };

    window.switchTab = function(type) {
        currentType = type;

        // Update tab styles
        document.querySelectorAll('.terms-tab').forEach(tab => {
            tab.classList.remove('active');
            if (tab.dataset.type === type) {
                tab.classList.add('active');
            }
        });

        // Update editor title
        editorTitle.textContent = typeTitles[type];

        // Update public page link
        viewPublicPage.href = publicUrls[type];

        // Update suggested clauses
        updateSuggestedClauses(type);

        // Load content for this type
        load(type);
    };

    function updateSuggestedClauses(type) {
        const clauses = suggestedClauses[type] || [];

        if (clauses.length === 0) {
            suggestedClausesEl.innerHTML = '<p class="text-sm text-amber-700">Aucune clause suggeree pour ce type de conditions.</p>';
            return;
        }

        suggestedClausesEl.innerHTML = clauses.map((clause, index) => `
            <div class="suggested-clause" onclick="insertClause(${index})">
                <h4>${clause.title}</h4>
                <p>Cliquez pour inserer cette clause</p>
            </div>
        `).join('');
    }

    window.insertClause = function(index) {
        const clauses = suggestedClauses[currentType] || [];
        if (clauses[index]) {
            const html = clauses[index].html;
            const cursorPos = contentField.selectionStart;
            const textBefore = contentField.value.substring(0, cursorPos);
            const textAfter = contentField.value.substring(cursorPos);
            contentField.value = textBefore + '\n\n' + html + '\n\n' + textAfter;
            contentField.focus();
            updatePreview();
            toastr.success('Clause inseree');
        }
    };

    window.insertTemplate = function(tag) {
        const templates = {
            h2: '<h2>Titre de section</h2>',
            h3: '<h3>Sous-titre</h3>',
            p: '<p>Votre texte ici...</p>',
            ul: '<ul>\n  <li>Element 1</li>\n  <li>Element 2</li>\n  <li>Element 3</li>\n</ul>',
            strong: '<strong>texte en gras</strong>',
            blockquote: '<blockquote>Citation importante</blockquote>'
        };

        if (templates[tag]) {
            const cursorPos = contentField.selectionStart;
            const textBefore = contentField.value.substring(0, cursorPos);
            const textAfter = contentField.value.substring(cursorPos);
            contentField.value = textBefore + templates[tag] + textAfter;
            contentField.focus();
            updatePreview();
        }
    };

    window.updatePreview = function() {
        let content = contentField.value || '';
        content = content.replace(/@site/g, '{{ config("app.name") }}');

        // Basic XSS prevention for preview
        const allowedTags = ['p', 'br', 'strong', 'b', 'em', 'i', 'u', 'ul', 'ol', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'a', 'blockquote', 'hr', 'span', 'div'];

        if (content.trim()) {
            previewEl.innerHTML = content;
        } else {
            previewEl.innerHTML = '<p class="text-gray-400 italic">L\'apercu apparaitra ici...</p>';
        }
    };

    async function load(type = 'general') {
        saveMsg.textContent = 'Chargement...';
        try {
            const res = await fetch(`{{ route('admin.terms.fetch') }}?type=${type}`);
            const data = await res.json();
            if (!data.success) throw new Error('fetch failed');

            const section = (data.sections || [])[0];
            sectionId = section?.id ?? null;
            contentField.value = typeof section?.body === 'string' ? section.body : '';

            updatePreview();
            saveMsg.textContent = '';
        } catch (e) {
            console.error(e);
            saveMsg.textContent = 'Erreur de chargement';
        }
    }

    async function saveAll(e) {
        e.preventDefault();
        saveBtn.disabled = true;
        saveMsg.textContent = 'Enregistrement...';

        const payload = {
            id: sectionId ?? null,
            number: 1,
            title: typeTitles[currentType],
            body: contentField.value || '',
            type: currentType,
            is_active: 1,
            slug: currentType + '-terms',
            version: null,
            effective_date: null,
        };

        try {
            const res = await fetch(`{{ route('admin.terms.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            }).then(r => r.json());

            if (res?.success && res.section) {
                sectionId = res.section.id;
            }

            saveMsg.textContent = 'Enregistre';
            toastr.success('Conditions enregistrees');
            setTimeout(() => saveMsg.textContent = '', 1500);
        } catch (e) {
            console.error(e);
            saveMsg.textContent = 'Echec de l\'enregistrement';
            toastr.error('Echec de l\'enregistrement');
        } finally {
            saveBtn.disabled = false;
        }
    }

    function cancel() {
        load(currentType);
    }

    // Live preview on input
    contentField.addEventListener('input', () => {
        clearTimeout(contentField.previewTimeout);
        contentField.previewTimeout = setTimeout(updatePreview, 300);
    });

    form.addEventListener('submit', saveAll);
    cancelBtn.addEventListener('click', cancel);

    // Initialize with general tab
    switchTab('general');
})();
</script>
@endpush
@endsection
