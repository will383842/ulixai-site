@extends('admin.dashboard.index')

@section('admin-content')
<div class="container admin-accounting-container mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Comptabilité</h1>

  <form method="get" class="flex flex-wrap items-end gap-3 mb-6">
    <div>
      <label class="block text-xs text-gray-500">Pays</label>
      <input type="text" name="country" value="{{ $filters['country'] ?? '' }}" class="border rounded px-3 py-2" placeholder="FR, US, ...">
    </div>
    <div>
      <label class="block text-xs text-gray-500">Devise</label>
      <input type="text" name="currency" value="{{ $filters['currency'] ?? '' }}" class="border rounded px-3 py-2" placeholder="eur, usd, ...">
    </div>
    <button class="px-4 py-2 border rounded bg-blue-600 text-white hover:bg-blue-700">Filtrer</button>
  </form>

  <div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
      <h2 class="font-semibold mb-3">Transactions (par devise & statut)</h2>
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left border-b">
            <th class="p-2">Devise</th>
            <th class="p-2">Statut</th>
            <th class="p-2">#</th>
            <th class="p-2">Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tx as $row)
          <tr class="border-b">
            <td class="p-2 uppercase">{{ $row->currency ?? '-' }}</td>
            <td class="p-2">{{ $row->status ?? '-' }}</td>
            <td class="p-2">{{ $row->count ?? 0 }}</td>
            <td class="p-2">{{ number_format($row->total ?? 0, 2, '.', ' ') }}</td>
          </tr>
          @empty
          <tr><td class="p-2 text-gray-500" colspan="4">Aucune donnée</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="bg-white rounded shadow p-4 overflow-x-auto">
      <h2 class="font-semibold mb-3">Payouts (par devise & statut)</h2>
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left border-b">
            <th class="p-2">Devise</th>
            <th class="p-2">Statut</th>
            <th class="p-2">#</th>
            <th class="p-2">Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payouts as $row)
          <tr class="border-b">
            <td class="p-2 uppercase">{{ $row->currency ?? '-' }}</td>
            <td class="p-2">{{ $row->status ?? '-' }}</td>
            <td class="p-2">{{ $row->count ?? 0 }}</td>
            <td class="p-2">{{ number_format($row->total ?? 0, 2, '.', ' ') }}</td>
          </tr>
          @empty
          <tr><td class="p-2 text-gray-500" colspan="4">Aucune donnée</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-10 grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded shadow p-4">
      <div class="flex items-center justify-between mb-2">
        <h2 class="font-semibold">Revenus — 30 jours</h2>
        <a href="{{ route('admin.accounting.export',['section'=>'revenue']) }}" class="text-sm underline text-blue-600">Exporter CSV</a>
      </div>
      <div class="chart-area" style="height: 200px;">
        <canvas id="revenueChart" aria-label="Graphique des revenus" role="img"></canvas>
      </div>
    </div>
    <div class="bg-white rounded shadow p-4">
      <div class="flex items-center justify-between mb-2">
        <h2 class="font-semibold">KYC vérifiés — 30 jours</h2>
        <a href="{{ route('admin.accounting.export',['section'=>'kyc']) }}" class="text-sm underline text-blue-600">Exporter CSV</a>
      </div>
      <div class="chart-area" style="height: 200px;">
        <canvas id="kycChart" aria-label="Graphique KYC" role="img"></canvas>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function(){
  const rev = @json(($revenueTrend ?? collect())->toArray());
  const kyc = @json(($kycTrend ?? collect())->toArray());
  const rlabels = Object.keys(rev), rdata = Object.values(rev);
  const klabels = Object.keys(kyc), kdata = Object.values(kyc);

  const revenueCanvas = document.getElementById('revenueChart');
  const kycCanvas = document.getElementById('kycChart');

  if (revenueCanvas) {
    if (window._revenueChart) { try { window._revenueChart.destroy(); } catch(e){} }
    window._revenueChart = new Chart(revenueCanvas.getContext('2d'), {
      type:'line',
      data:{ labels:rlabels, datasets:[{ label:'Revenus', data:rdata, borderWidth:2, tension:0.3, borderColor:'#3B82F6', backgroundColor:'rgba(59,130,246,0.1)', fill:true }] },
      options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ display:false } } }
    });
  }

  if (kycCanvas) {
    if (window._kycChart) { try { window._kycChart.destroy(); } catch(e){} }
    window._kycChart = new Chart(kycCanvas.getContext('2d'), {
      type:'bar',
      data:{ labels:klabels, datasets:[{ label:'KYC vérifiés', data:kdata, borderWidth:2, backgroundColor:'#10B981' }] },
      options:{ responsive:true, maintainAspectRatio:false, plugins:{ legend:{ display:false } } }
    });
  }
})();
</script>
@endsection
