@component('mail::message')
# Payout Processed Successfully

Dear {{ $user->name }},

We're pleased to inform you that your payout request has been processed successfully.

**Payout Details:**
- Amount: €{{ number_format($payout->amount, 2) }}
- Date: {{ $payout->paid_at->format('d M Y') }}
- Reference: {{ $payout->stripe_payout_id }}

@if($payout->bank_account_type === 'connected_account')
The funds have been sent to your connected Stripe account and will be automatically transferred to your registered bank account.
@else
The funds have been sent directly to your bank account ending in {{ $payout->bank_account_last4 }}.
@endif

Please note that it may take 1-3 business days for the funds to appear in your bank account.

@component('mail::button', ['url' => route('user.earnings')])
View Earnings Dashboard
@endcomponent

If you have any questions about this payout, please don't hesitate to contact our support team.

Best regards,  
{{ config('app.name') }} Team
@endcomponent
