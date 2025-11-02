@extends('admin.dashboard.index')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
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
    <button class="px-4 py-2 border rounded">Filtrer</button>
  </form>

  <div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
      <h2 class="font-semibold mb-3">Transactions (par pays)</h2>
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left border-b">
            <th class="p-2">Pays</th>
            <th class="p-2">#</th>
            <th class="p-2">Montant brut</th>
            <th class="p-2">Frais client</th>
            <th class="p-2">Part prestataire</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tx as $row)
          <tr class="border-b">
            <td class="p-2">{{ $row->country ?? '-' }}</td>
            <td class="p-2">{{ $row->tx_count }}</td>
            <td class="p-2">{{ number_format($row->gross_amount, 2, '.', ' ') }}</td>
            <td class="p-2">{{ number_format($row->client_fee_total, 2, '.', ' ') }}</td>
            <td class="p-2">{{ number_format($row->provider_fee_total, 2, '.', ' ') }}</td>
          </tr>
          @empty
          <tr><td class="p-2 text-gray-500" colspan="5">Aucune donnée</td></tr>
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
            <td class="p-2 uppercase">{{ $row->currency }}</td>
            <td class="p-2">{{ $row->status }}</td>
            <td class="p-2">{{ $row->count }}</td>
            <td class="p-2">{{ number_format($row->total, 2, '.', ' ') }}</td>
          </tr>
          @empty
          <tr><td class="p-2 text-gray-500" colspan="4">Aucune donnée</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
