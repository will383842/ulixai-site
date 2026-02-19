@extends('admin.dashboard.index')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Transaction #{{ $transaction->id }}</h4>
        <a href="{{ route('admin.transactions') }}" class="btn btn-secondary btn-sm">Back to Transactions</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header"><h6>Transaction Details</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td><strong>ID</strong></td><td>{{ $transaction->id }}</td></tr>
                        <tr><td><strong>Status</strong></td><td><span class="badge bg-{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'refunded' ? 'danger' : 'warning') }}">{{ ucfirst($transaction->status) }}</span></td></tr>
                        <tr><td><strong>Amount Paid</strong></td><td>{{ number_format($transaction->amount_paid ?? 0, 2) }} {{ $transaction->currency ?? 'EUR' }}</td></tr>
                        <tr><td><strong>Provider Fee</strong></td><td>{{ number_format($transaction->provider_fee ?? 0, 2) }} {{ $transaction->currency ?? 'EUR' }}</td></tr>
                        <tr><td><strong>Client Fee</strong></td><td>{{ number_format($transaction->client_fee ?? 0, 2) }} {{ $transaction->currency ?? 'EUR' }}</td></tr>
                        <tr><td><strong>Gateway</strong></td><td>{{ ucfirst($transaction->payment_gateway ?? 'N/A') }}</td></tr>
                        <tr><td><strong>Created</strong></td><td>{{ $transaction->created_at?->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header"><h6>Stripe Payment Intent</h6></div>
                <div class="card-body">
                    @if(isset($paymentIntent))
                    <table class="table table-sm">
                        <tr><td><strong>Intent ID</strong></td><td><code>{{ $paymentIntent->id }}</code></td></tr>
                        <tr><td><strong>Status</strong></td><td>{{ $paymentIntent->status }}</td></tr>
                        <tr><td><strong>Amount</strong></td><td>{{ number_format($paymentIntent->amount / 100, 2) }} {{ strtoupper($paymentIntent->currency) }}</td></tr>
                        <tr><td><strong>Created</strong></td><td>{{ \Carbon\Carbon::createFromTimestamp($paymentIntent->created)->format('d/m/Y H:i') }}</td></tr>
                    </table>
                    @else
                    <p class="text-muted">No Stripe payment intent data available.</p>
                    @endif
                </div>
            </div>

            @if($transaction->mission)
            <div class="card mb-4">
                <div class="card-header"><h6>Mission</h6></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr><td><strong>Title</strong></td><td>{{ $transaction->mission->title ?? 'N/A' }}</td></tr>
                        <tr><td><strong>Status</strong></td><td>{{ ucfirst($transaction->mission->status ?? 'N/A') }}</td></tr>
                        <tr><td><strong>Mission ID</strong></td><td>{{ $transaction->mission->id }}</td></tr>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
