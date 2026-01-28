@extends('dashboard.layouts.master')

@section('title', __('Mes litiges'))

@section('content')

<style>
    .disputes-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .disputes-header {
        margin-bottom: 2rem;
    }

    .disputes-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .disputes-header p {
        color: #64748b;
        font-size: 0.95rem;
    }

    .disputes-section {
        margin-bottom: 2.5rem;
    }

    .disputes-section h2 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .disputes-section h2 .badge {
        background: #fef3c7;
        color: #d97706;
        padding: 0.25rem 0.625rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .dispute-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
    }

    .dispute-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .dispute-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .dispute-title {
        font-weight: 600;
        color: #0f172a;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .dispute-id {
        color: #64748b;
        font-size: 0.8125rem;
    }

    .dispute-status {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .dispute-status.pending {
        background: #fef3c7;
        color: #d97706;
    }

    .dispute-status.resolved {
        background: #d1fae5;
        color: #059669;
    }

    .dispute-status.refunded {
        background: #dbeafe;
        color: #2563eb;
    }

    .dispute-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 0.75rem;
    }

    .dispute-info-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .dispute-info-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .dispute-info-value {
        font-size: 0.9375rem;
        font-weight: 500;
        color: #0f172a;
    }

    .dispute-reason {
        padding: 1rem;
        background: #fff7ed;
        border-left: 3px solid #f97316;
        border-radius: 0 0.5rem 0.5rem 0;
        margin-bottom: 1rem;
    }

    .dispute-reason-label {
        font-size: 0.75rem;
        color: #9a3412;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .dispute-reason-text {
        color: #7c2d12;
        font-size: 0.875rem;
    }

    .dispute-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-dispute {
        padding: 0.625rem 1.25rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-dispute-primary {
        background: #2563eb;
        color: #fff;
    }

    .btn-dispute-primary:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .btn-dispute-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-dispute-secondary:hover {
        background: #e2e8f0;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: #f8fafc;
        border-radius: 1rem;
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #64748b;
        font-size: 0.9375rem;
    }

    @media (max-width: 640px) {
        .disputes-container {
            padding: 1rem;
        }

        .dispute-card-header {
            flex-direction: column;
            gap: 0.75rem;
        }

        .dispute-info {
            grid-template-columns: 1fr 1fr;
        }

        .dispute-actions {
            flex-direction: column;
        }

        .btn-dispute {
            justify-content: center;
        }
    }
</style>

<div class="disputes-container">
    <div class="disputes-header">
        <h1>{{ __('Mes litiges') }}</h1>
        <p>{{ __('Suivez l\'état de vos litiges et réclamations') }}</p>
    </div>

    {{-- Litiges en cours --}}
    @php
        $activeDisputes = $disputesAsRequester->merge($disputesAsProvider);
    @endphp

    @if($activeDisputes->isNotEmpty())
    <div class="disputes-section">
        <h2>
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ __('Litiges en cours') }}
            <span class="badge">{{ $activeDisputes->count() }}</span>
        </h2>

        @foreach($activeDisputes as $dispute)
        @php
            $isRequester = $dispute->requester_id === auth()->id();
            $otherParty = $isRequester
                ? optional($dispute->selectedProvider)->user
                : $dispute->requester;
            $transaction = $dispute->transactions->where('status', 'paid')->first();
            $reason = $dispute->cancellationReasons->first();
            $currency = $dispute->budget_currency ?? 'EUR';
        @endphp
        <div class="dispute-card">
            <div class="dispute-card-header">
                <div>
                    <div class="dispute-title">{{ $dispute->title }}</div>
                    <div class="dispute-id">Mission #{{ $dispute->id }} - {{ $isRequester ? __('En tant que demandeur') : __('En tant que prestataire') }}</div>
                </div>
                <span class="dispute-status pending">{{ __('En cours d\'examen') }}</span>
            </div>

            <div class="dispute-info">
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ __('Montant') }}</span>
                    <span class="dispute-info-value">{{ $transaction ? number_format($transaction->amount_paid, 2) . ' ' . $currency : 'N/A' }}</span>
                </div>
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ $isRequester ? __('Prestataire') : __('Demandeur') }}</span>
                    <span class="dispute-info-value">{{ $otherParty->name ?? 'N/A' }}</span>
                </div>
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ __('Ouvert par') }}</span>
                    <span class="dispute-info-value">{{ ucfirst($dispute->cancelled_by) }}</span>
                </div>
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ __('Date') }}</span>
                    <span class="dispute-info-value">{{ $dispute->cancelled_on ? $dispute->cancelled_on->format('d/m/Y') : $dispute->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>

            @if($reason)
            <div class="dispute-reason">
                <div class="dispute-reason-label">{{ __('Motif du litige') }}</div>
                <div class="dispute-reason-text">{{ $reason->custum_description ?? $reason->reason }}</div>
            </div>
            @endif

            <div class="dispute-actions">
                <a href="{{ route('user.disputes.show', $dispute->id) }}" class="btn-dispute btn-dispute-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ __('Voir le détail') }}
                </a>
                <a href="{{ route('user.conversation') }}" class="btn-dispute btn-dispute-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    {{ __('Messagerie') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Litiges résolus --}}
    @if($resolvedDisputes->isNotEmpty())
    <div class="disputes-section">
        <h2>
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ __('Historique des litiges résolus') }}
        </h2>

        @foreach($resolvedDisputes as $dispute)
        @php
            $isRequester = $dispute->requester_id === auth()->id();
            $transaction = $dispute->transactions->first();
            $wasRefunded = $dispute->payment_status === 'refunded';
            $currency = $dispute->budget_currency ?? 'EUR';
        @endphp
        <div class="dispute-card">
            <div class="dispute-card-header">
                <div>
                    <div class="dispute-title">{{ $dispute->title }}</div>
                    <div class="dispute-id">Mission #{{ $dispute->id }}</div>
                </div>
                <span class="dispute-status {{ $wasRefunded ? 'refunded' : 'resolved' }}">
                    {{ $wasRefunded ? __('Remboursé') : __('Transféré au prestataire') }}
                </span>
            </div>

            <div class="dispute-info">
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ __('Montant') }}</span>
                    <span class="dispute-info-value">{{ $transaction ? number_format($transaction->amount_paid, 2) . ' ' . $currency : 'N/A' }}</span>
                </div>
                <div class="dispute-info-item">
                    <span class="dispute-info-label">{{ __('Résolution') }}</span>
                    <span class="dispute-info-value">{{ $dispute->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- État vide --}}
    @if($activeDisputes->isEmpty() && $resolvedDisputes->isEmpty())
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3>{{ __('Aucun litige') }}</h3>
        <p>{{ __('Vous n\'avez aucun litige en cours ou résolu.') }}</p>
    </div>
    @endif
</div>

@endsection
