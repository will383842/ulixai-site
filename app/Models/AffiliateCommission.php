<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class AffiliateCommission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'referrer_id',
        'referee_id',
        'mission_id',
        'amount',
        'currency',
        'status',
        'payout_method',
        'stripe_transfer_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Commission status constants.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_AVAILABLE = 'available';
    const STATUS_PAID = 'paid';

    /**
     * Get all available statuses.
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'En attente',
            self::STATUS_AVAILABLE => 'Disponible',
            self::STATUS_PAID => 'Paye',
        ];
    }

    /**
     * Get the referrer (affiliate) who earned this commission.
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * Get the referee (referred user) who generated this commission.
     */
    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    /**
     * Get the mission associated with this commission.
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    /**
     * Get the formatted amount with currency symbol.
     */
    public function getFormattedAmountAttribute(): string
    {
        return CurrencyService::formatStatic(
            $this->amount,
            $this->currency ?? 'EUR',
            true
        );
    }

    /**
     * Get the status label in French.
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Check if the commission is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the commission is available for withdrawal.
     */
    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * Check if the commission has been paid.
     */
    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    /**
     * Scope to filter commissions by currency.
     */
    public function scopeByCurrency(Builder $query, string $currency): Builder
    {
        return $query->where('currency', strtoupper($currency));
    }

    /**
     * Scope to filter commissions by status.
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter pending commissions.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope to filter available commissions.
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    /**
     * Scope to filter paid commissions.
     */
    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Scope to filter commissions for a specific referrer.
     */
    public function scopeForReferrer(Builder $query, int $referrerId): Builder
    {
        return $query->where('referrer_id', $referrerId);
    }

    /**
     * Scope to filter commissions for a specific referee.
     */
    public function scopeForReferee(Builder $query, int $refereeId): Builder
    {
        return $query->where('referee_id', $refereeId);
    }

    /**
     * Scope to filter commissions within a date range.
     */
    public function scopeBetweenDates(Builder $query, Carbon $start, Carbon $end): Builder
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    /**
     * Scope to filter commissions created this month.
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year);
    }

    /**
     * Scope to filter commissions created this year.
     */
    public function scopeThisYear(Builder $query): Builder
    {
        return $query->whereYear('created_at', Carbon::now()->year);
    }

    /**
     * Mark the commission as available.
     */
    public function markAsAvailable(): bool
    {
        if ($this->status !== self::STATUS_PENDING) {
            return false;
        }

        $this->status = self::STATUS_AVAILABLE;
        return $this->save();
    }

    /**
     * Mark the commission as paid.
     */
    public function markAsPaid(?string $stripeTransferId = null): bool
    {
        if ($this->status !== self::STATUS_AVAILABLE) {
            return false;
        }

        $this->status = self::STATUS_PAID;
        if ($stripeTransferId) {
            $this->stripe_transfer_id = $stripeTransferId;
        }
        return $this->save();
    }

    /**
     * Get the total commissions amount for a user.
     */
    public static function getTotalForUser(int $userId, ?string $status = null): float
    {
        $query = self::where('referrer_id', $userId);

        if ($status) {
            $query->where('status', $status);
        }

        return (float) $query->sum('amount');
    }

    /**
     * Get monthly totals for a user (for charts).
     */
    public static function getMonthlyTotalsForUser(int $userId, int $months = 12): array
    {
        $startDate = Carbon::now()->subMonths($months)->startOfMonth();

        return self::where('referrer_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
    }

    /**
     * Get statistics for the admin dashboard.
     */
    public static function getGlobalStats(): array
    {
        return [
            'total' => self::count(),
            'total_amount' => (float) self::sum('amount'),
            'pending_count' => self::pending()->count(),
            'pending_amount' => (float) self::pending()->sum('amount'),
            'available_count' => self::available()->count(),
            'available_amount' => (float) self::available()->sum('amount'),
            'paid_count' => self::paid()->count(),
            'paid_amount' => (float) self::paid()->sum('amount'),
        ];
    }

    /**
     * Create a commission from a mission payment.
     */
    public static function createFromMission(
        Mission $mission,
        User $referrer,
        User $referee,
        float $commissionRate,
        float $transactionAmount,
        string $currency = 'EUR'
    ): ?self {
        $amount = round($transactionAmount * ($commissionRate / 100), 2);

        if ($amount <= 0) {
            return null;
        }

        return self::create([
            'referrer_id' => $referrer->id,
            'referee_id' => $referee->id,
            'mission_id' => $mission->id,
            'amount' => $amount,
            'currency' => strtoupper($currency),
            'status' => self::STATUS_PENDING,
        ]);
    }
}
