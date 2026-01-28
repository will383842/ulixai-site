@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.dashboard') }}">Affiliation</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.affiliates.commissions') }}">Commissions</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Commission #{{ $commission->id }}</span>
    </nav>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h1 class="page-title">Commission #{{ $commission->id }}</h1>
            <p class="page-subtitle">Creee le {{ $commission->created_at->format('d/m/Y a H:i') }}</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('admin.affiliates.commissions') }}" class="btn btn-outline text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info Card -->
        <div class="lg:col-span-2 admin-card">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Details de la commission</h2>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Amount -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Montant</dt>
                        <dd class="mt-1 text-2xl font-bold text-green-600">
                            {{ \App\Models\Currency::format($commission->amount, $commission->currency ?? 'EUR') }}
                        </dd>
                    </div>

                    <!-- Status -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Statut</dt>
                        <dd class="mt-1">
                            @if($commission->status === 'pending')
                                <span class="badge-warning text-base px-4 py-2">En attente</span>
                            @elseif($commission->status === 'available')
                                <span class="badge-info text-base px-4 py-2">Disponible</span>
                            @elseif($commission->status === 'paid')
                                <span class="badge-success text-base px-4 py-2">Paye</span>
                            @endif
                        </dd>
                    </div>

                    <!-- Referrer -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Affilie (parrain)</dt>
                        <dd class="mt-1">
                            @if($commission->referrer)
                                <a href="{{ route('admin.affiliates.show', $commission->referrer_id) }}" class="flex items-center hover:text-blue-600">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-700">
                                            {{ strtoupper(substr($commission->referrer->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $commission->referrer->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $commission->referrer->email }}</div>
                                    </div>
                                </a>
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </dd>
                    </div>

                    <!-- Referee -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Filleul</dt>
                        <dd class="mt-1">
                            @if($commission->referee)
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-purple-700">
                                            {{ strtoupper(substr($commission->referee->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $commission->referee->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $commission->referee->email }}</div>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </dd>
                    </div>

                    <!-- Mission -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Mission associee</dt>
                        <dd class="mt-1">
                            @if($commission->mission_id)
                                <a href="{{ route('admin.missions.show', $commission->mission_id) }}" class="text-blue-600 hover:underline font-medium">
                                    Mission #{{ $commission->mission_id }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Commission manuelle</span>
                            @endif
                        </dd>
                    </div>

                    <!-- Currency -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Devise</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">
                            {{ $commission->currency ?? 'EUR' }}
                        </dd>
                    </div>

                    <!-- Created At -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date de creation</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $commission->created_at->format('d/m/Y H:i:s') }}
                        </dd>
                    </div>

                    <!-- Updated At -->
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Derniere modification</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $commission->updated_at->format('d/m/Y H:i:s') }}
                        </dd>
                    </div>

                    @if($commission->stripe_transfer_id)
                    <!-- Stripe Transfer ID -->
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Reference Stripe</dt>
                        <dd class="mt-1 text-sm font-mono text-gray-600 bg-gray-50 px-3 py-2 rounded">
                            {{ $commission->stripe_transfer_id }}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="admin-card h-fit">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">Actions</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Update Status Form -->
                <form action="{{ route('admin.affiliates.commissions.update', $commission->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Modifier le statut</label>
                        <select name="status" class="form-select w-full">
                            <option value="pending" {{ $commission->status === 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="available" {{ $commission->status === 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="paid" {{ $commission->status === 'paid' ? 'selected' : '' }}>Paye</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Raison (optionnel)</label>
                        <textarea name="reason" rows="2" class="form-textarea w-full" placeholder="Raison de la modification..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">
                        Mettre a jour
                    </button>
                </form>

                @if($commission->status !== 'paid')
                <hr class="my-4">
                <!-- Delete Form -->
                <form action="{{ route('admin.affiliates.commissions.delete', $commission->id) }}" method="POST"
                      onsubmit="return confirm('Etes-vous sur de vouloir supprimer cette commission ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Supprimer la commission
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Transaction Info if Mission exists -->
    @if($commission->mission && $commission->mission->transactions->count() > 0)
    <div class="admin-card mt-6">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Transactions de la mission</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commission->mission->transactions as $transaction)
                    <tr>
                        <td class="text-sm text-gray-500">#{{ $transaction->id }}</td>
                        <td class="text-sm font-medium text-gray-900">
                            {{ \App\Models\Currency::format($transaction->amount_paid ?? $transaction->amount, $transaction->currency ?? 'EUR') }}
                        </td>
                        <td>
                            @if($transaction->status === 'completed')
                                <span class="badge-success">Complete</span>
                            @elseif($transaction->status === 'pending')
                                <span class="badge-warning">En attente</span>
                            @else
                                <span class="badge-default">{{ $transaction->status }}</span>
                            @endif
                        </td>
                        <td class="text-sm text-gray-500">
                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
