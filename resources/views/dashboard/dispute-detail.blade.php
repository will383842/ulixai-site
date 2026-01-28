@extends('dashboard.layouts.master')

@section('title', __('Détail du litige') . ' #' . $mission->id)

@section('content')

<style>
    .dispute-detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .dispute-back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        text-decoration: none;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        transition: color 0.2s;
    }

    .dispute-back-link:hover {
        color: #2563eb;
    }

    .dispute-detail-header {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .dispute-detail-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 0.5rem;
    }

    .dispute-detail-subtitle {
        color: #b45309;
        font-size: 0.9375rem;
    }

    .dispute-detail-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .dispute-detail-card-header {
        background: #f8fafc;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dispute-detail-card-body {
        padding: 1.25rem;
    }

    .dispute-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
    }

    .dispute-info-block {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .dispute-info-block-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .dispute-info-block-value {
        font-size: 1rem;
        font-weight: 500;
        color: #0f172a;
    }

    .dispute-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .dispute-timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
    }

    .dispute-timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .dispute-timeline-item:last-child {
        padding-bottom: 0;
    }

    .dispute-timeline-dot {
        position: absolute;
        left: -1.625rem;
        top: 0.25rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #2563eb;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px #dbeafe;
    }

    .dispute-timeline-dot.warning {
        background: #f59e0b;
        box-shadow: 0 0 0 3px #fef3c7;
    }

    .dispute-timeline-dot.pending {
        background: #94a3b8;
        box-shadow: 0 0 0 3px #f1f5f9;
    }

    .dispute-timeline-date {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 0.25rem;
    }

    .dispute-timeline-content {
        font-size: 0.9375rem;
        color: #0f172a;
    }

    .dispute-alert {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .dispute-alert svg {
        flex-shrink: 0;
        color: #2563eb;
    }

    .dispute-alert-content {
        font-size: 0.9375rem;
        color: #1e40af;
    }

    .dispute-parties {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .dispute-party {
        padding: 1rem;
        background: #f8fafc;
        border-radius: 0.75rem;
    }

    .dispute-party-role {
        font-size: 0.6875rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.5rem;
    }

    .dispute-party-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 1rem;
    }

    .dispute-party-email {
        font-size: 0.8125rem;
        color: #64748b;
    }

    @media (max-width: 640px) {
        .dispute-parties {
            grid-template-columns: 1fr;
        }

        .dispute-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dispute-detail-container">
    <a href="{{ route('user.disputes') }}" class="dispute-back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        {{ __('Retour aux litiges') }}
    </a>

    <div class="dispute-detail-header">
        <div class="dispute-detail-title">{{ __('Litige') }} #{{ $mission->id }}</div>
        <div class="dispute-detail-subtitle">{{ $mission->title }}</div>
    </div>

    {{-- Alerte statut --}}
    <div class="dispute-alert" style="margin-bottom: 1.5rem;">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="dispute-alert-content">
            {{ __('Ce litige est actuellement en cours d\'examen par notre équipe. Nous vous notifierons dès qu\'une décision sera prise.') }}
        </div>
    </div>

    {{-- Parties impliquées --}}
    <div class="dispute-detail-card">
        <div class="dispute-detail-card-header">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            {{ __('Parties impliquées') }}
        </div>
        <div class="dispute-detail-card-body">
            <div class="dispute-parties">
                <div class="dispute-party">
                    <div class="dispute-party-role">{{ __('Demandeur') }}</div>
                    <div class="dispute-party-name">{{ $mission->requester->name }}</div>
                    @if($isRequester)
                    <div class="dispute-party-email">({{ __('Vous') }})</div>
                    @endif
                </div>
                <div class="dispute-party">
                    <div class="dispute-party-role">{{ __('Prestataire') }}</div>
                    <div class="dispute-party-name">{{ optional(optional($mission->selectedProvider)->user)->name ?? 'N/A' }}</div>
                    @if($isProvider)
                    <div class="dispute-party-email">({{ __('Vous') }})</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Informations de la mission --}}
    @php
        $transaction = $mission->transactions->where('status', 'paid')->first();
        $offer = $mission->offers->where('status', 'accepted')->first();
        $reason = $mission->cancellationReasons->first();
        $currency = $mission->budget_currency ?? 'EUR';
    @endphp

    <div class="dispute-detail-card">
        <div class="dispute-detail-card-header">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            {{ __('Détails de la mission') }}
        </div>
        <div class="dispute-detail-card-body">
            <div class="dispute-info-grid">
                <div class="dispute-info-block">
                    <span class="dispute-info-block-label">{{ __('Montant payé') }}</span>
                    <span class="dispute-info-block-value">{{ $transaction ? number_format($transaction->amount_paid, 2) . ' ' . $currency : 'N/A' }}</span>
                </div>
                <div class="dispute-info-block">
                    <span class="dispute-info-block-label">{{ __('Date de paiement') }}</span>
                    <span class="dispute-info-block-value">{{ $transaction ? $transaction->created_at->format('d/m/Y') : 'N/A' }}</span>
                </div>
                <div class="dispute-info-block">
                    <span class="dispute-info-block-label">{{ __('Ouvert par') }}</span>
                    <span class="dispute-info-block-value">{{ ucfirst($mission->cancelled_by) }}</span>
                </div>
                <div class="dispute-info-block">
                    <span class="dispute-info-block-label">{{ __('Date du litige') }}</span>
                    <span class="dispute-info-block-value">{{ $mission->cancelled_on ? $mission->cancelled_on->format('d/m/Y H:i') : $mission->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Motif du litige --}}
    @if($reason)
    <div class="dispute-detail-card">
        <div class="dispute-detail-card-header">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            {{ __('Motif du litige') }}
        </div>
        <div class="dispute-detail-card-body">
            <div class="dispute-info-block" style="margin-bottom: 1rem;">
                <span class="dispute-info-block-label">{{ __('Raison') }}</span>
                <span class="dispute-info-block-value">{{ $reason->reason }}</span>
            </div>
            @if($reason->custum_description)
            <div class="dispute-info-block">
                <span class="dispute-info-block-label">{{ __('Description détaillée') }}</span>
                <span class="dispute-info-block-value" style="white-space: pre-wrap;">{{ $reason->custum_description }}</span>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Timeline --}}
    <div class="dispute-detail-card">
        <div class="dispute-detail-card-header">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ __('Historique') }}
        </div>
        <div class="dispute-detail-card-body">
            <div class="dispute-timeline">
                <div class="dispute-timeline-item">
                    <div class="dispute-timeline-dot pending"></div>
                    <div class="dispute-timeline-date">{{ __('En attente') }}</div>
                    <div class="dispute-timeline-content">{{ __('Décision de l\'équipe Ulixai') }}</div>
                </div>
                <div class="dispute-timeline-item">
                    <div class="dispute-timeline-dot warning"></div>
                    <div class="dispute-timeline-date">{{ $mission->cancelled_on ? $mission->cancelled_on->format('d/m/Y H:i') : $mission->updated_at->format('d/m/Y H:i') }}</div>
                    <div class="dispute-timeline-content">{{ __('Litige ouvert par') }} {{ $mission->cancelled_by }}</div>
                </div>
                @if($transaction)
                <div class="dispute-timeline-item">
                    <div class="dispute-timeline-dot"></div>
                    <div class="dispute-timeline-date">{{ $transaction->created_at->format('d/m/Y H:i') }}</div>
                    <div class="dispute-timeline-content">{{ __('Paiement effectué') }} - {{ number_format($transaction->amount_paid, 2) }} {{ $currency }}</div>
                </div>
                @endif
                <div class="dispute-timeline-item">
                    <div class="dispute-timeline-dot"></div>
                    <div class="dispute-timeline-date">{{ $mission->created_at->format('d/m/Y H:i') }}</div>
                    <div class="dispute-timeline-content">{{ __('Mission créée') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
