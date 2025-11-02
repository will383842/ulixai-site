@extends('admin.dashboard.index')

@section('admin-content')
<div class="px-6 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">SEO & Analytics</h1>
        <button id="refreshSeoBtn"
                class="inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring">
            Actualiser maintenant
        </button>
    </div>

    {{-- Connection status --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="p-4 rounded-xl border bg-white shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium">Backlinks (Bing)</h2>
                <span class="text-xs px-2 py-1 rounded-full
                    {{ $isConfigured['bing'] ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $isConfigured['bing'] ? 'Connecté' : 'Non connecté' }}
                </span>
            </div>
            <p class="text-sm text-gray-600 mt-2">Source : Bing Webmaster API (GetLinkCounts).</p>
            <div id="bingSummary" class="mt-4 text-sm text-gray-800">
                @if($metrics && ($metrics['bing']['connected'] ?? false))
                    <div class="flex items-center gap-4">
                        <div>
                            <div class="text-2xl font-semibold">
                                {{ number_format($metrics['bing']['summary']['approxTotalLinks'] ?? 0) }}
                            </div>
                            <div class="text-gray-500">Liens entrants (approx.)</div>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold">
                                {{ number_format($metrics['bing']['summary']['scannedPages'] ?? 0) }}
                            </div>
                            <div class="text-gray-500">Pages scannées</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs text-gray-500">Top pages liées</p>
                        <ul class="list-disc ml-5 mt-2 space-y-1">
                            @foreach(($metrics['bing']['summary']['topPages'] ?? []) as $p)
                                <li><a href="{{ $p['url'] }}" class="text-blue-600 hover:underline" target="_blank" rel="noopener">{{ $p['url'] }}</a> — {{ $p['count'] }} liens</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="text-gray-500">Aucune donnée en cache. Cliquez sur “Actualiser maintenant”.</div>
                @endif
            </div>
        </div>

        <div class="p-4 rounded-xl border bg-white shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium">Autorité (Open PageRank)</h2>
                <span class="text-xs px-2 py-1 rounded-full
                    {{ $isConfigured['opr'] ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $isConfigured['opr'] ? 'Connecté' : 'Non connecté' }}
                </span>
            </div>
            <p class="text-sm text-gray-600 mt-2">Source : openpagerank.com (page_rank_decimal).</p>
            <div id="oprSummary" class="mt-4 text-sm text-gray-800">
                @if($metrics && ($metrics['openpagerank']['connected'] ?? false) && ($metrics['openpagerank']['data'] ?? null))
                    <div class="flex items-center gap-4">
                        <div>
                            <div class="text-2xl font-semibold">
                                {{ number_format($metrics['openpagerank']['data']['page_rank_decimal'] ?? 0, 2) }}
                            </div>
                            <div class="text-gray-500">Score Open PageRank</div>
                        </div>
                        <div>
                            <div class="text-2xl font-semibold">
                                {{ $metrics['openpagerank']['data']['rank'] ?? '—' }}
                            </div>
                            <div class="text-gray-500">Rang global</div>
                        </div>
                    </div>
                @else
                    <div class="text-gray-500">Aucune donnée en cache. Cliquez sur “Actualiser maintenant”.</div>
                @endif
            </div>
        </div>
    </div>

    @if($metrics)
        <p class="text-xs text-gray-500">Dernière génération: {{ $metrics['generated_at'] ?? '' }} — Domaine : {{ $metrics['domain'] ?? '' }}</p>
    @endif
</div>

<script>
document.getElementById('refreshSeoBtn').addEventListener('click', async () => {
    try {
        const res = await fetch('{{ route('admin.seo.refresh') }}', { method: 'POST', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }});
        const data = await res.json();
        window.location.reload();
    } catch (e) {
        alert('Erreur lors de l\'actualisation.');
    }
});
</script>
@endsection
