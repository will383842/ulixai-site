<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';

    protected $fillable = [
        'user_id',
        'provider_id',
        'amount',
        'currency',
        'payout_type',
        'stripe_transfer_id',
        'stripe_payout_id',
        'bank_account_last4',
        'bank_account_type',
        'status',
        'failure_reason',
        'paid_at',
        'initiated_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'initiated_at' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
