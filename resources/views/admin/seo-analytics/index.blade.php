@extends('admin.dashboard.index')

@section('admin-content')
<div class="px-6 py-6">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">SEO &amp; Analytics</h1>
    <button id="refreshSeoBtn"
            class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring">
      Actualiser maintenant
    </button>
  </div>

  {{-- States --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="p-4 rounded-xl border bg-white shadow-sm">
      <div class="flex items-center justify-between">
        <h2 class="font-medium text-gray-800">Bing Webmaster</h2>
        <span class="text-xs px-2 py-1 rounded-full"
              :class="''">
          @if(data_get($metrics, 'bing.connected'))
            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Connecté</span>
          @else
            <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Non connecté</span>
          @endif
        </span>
      </div>
      <div class="mt-3 text-sm text-gray-700">
        <div>Total liens approx.: <strong>{{ data_get($metrics, 'bing.summary.approxTotalLinks', 0) }}</strong></div>
        <div>Pages scannées: <strong>{{ data_get($metrics, 'bing.summary.scannedPages', 0) }}</strong></div>
      </div>
      <div class="mt-4">
        <h3 class="text-sm font-semibold text-gray-800 mb-2">Top pages</h3>
        <ul class="text-sm list-disc list-inside space-y-1 max-h-40 overflow-auto">
          @forelse(data_get($metrics, 'bing.summary.topPages', []) as $row)
            <li><a href="{{ $row['url'] ?? '#' }}" target="_blank" class="text-blue-600 hover:underline">{{ $row['url'] ?? '' }}</a>
              — <span class="text-gray-600">liens: {{ $row['count'] ?? 0 }}</span></li>
          @empty
            <li class="text-gray-500">Aucune donnée.</li>
          @endforelse
        </ul>
      </div>
      @if(data_get($metrics, 'bing.summary.note'))
        <p class="mt-3 text-xs text-gray-500">{{ data_get($metrics, 'bing.summary.note') }}</p>
      @endif
      @if(data_get($metrics, 'bing.error'))
        <p class="mt-3 text-xs text-red-600">Erreur: {{ data_get($metrics, 'bing.error') }}</p>
      @endif
    </div>

    <div class="p-4 rounded-xl border bg-white shadow-sm">
      <div class="flex items-center justify-between">
        <h2 class="font-medium text-gray-800">Open PageRank</h2>
        <span class="text-xs px-2 py-1 rounded-full">
          @if(data_get($metrics, 'opr.connected'))
            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Connecté</span>
          @else
            <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Non connecté</span>
          @endif
        </span>
      </div>
      <div class="mt-3 text-sm text-gray-700">
        <div>Score: <strong>{{ data_get($metrics, 'opr.rank', '—') }}</strong></div>
      </div>
      @if(data_get($metrics, 'opr.error'))
        <p class="mt-3 text-xs text-red-600">Erreur: {{ data_get($metrics, 'opr.error') }}</p>
      @endif
    </div>
  </div>

  <p class="text-xs text-gray-500">Dernier rafraîchissement: {{ data_get($metrics, 'refreshed_at', '—') }}</p>
</div>

<script>
document.getElementById('refreshSeoBtn').addEventListener('click', async () => {
  try {
    const res = await fetch('{{ route('admin.seo.refresh') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      }
    });
    const data = await res.json();
    if (data && data.ok) {
      window.location.reload();
    } else {
      alert('Actualisation incomplète.');
    }
  } catch (e) {
    alert('Erreur lors de l\'actualisation.');
  }
});
</script>
@endsection
