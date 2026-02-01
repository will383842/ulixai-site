<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * EmailVerification Model
 *
 * SECURITY FEATURES:
 * - Tracks verification attempts to prevent brute-force
 * - Implements lockout after max failed attempts
 * - OTP is stored as hash (see RegisterController)
 */
class EmailVerification extends Model
{
    /**
     * Maximum allowed verification attempts before lockout.
     */
    public const MAX_ATTEMPTS = 5;

    /**
     * Lockout duration in minutes after max attempts reached.
     */
    public const LOCKOUT_MINUTES = 30;

    /**
     * OTP expiration time in minutes.
     */
    public const OTP_EXPIRES_MINUTES = 10;

    protected $fillable = [
        'user_id',
        'email',
        'otp',
        'is_verified',
        'verified_at',
        'attempts',
        'locked_until',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'locked_until' => 'datetime',
        'attempts' => 'integer',
    ];

    /**
     * Relationship to User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if verification is currently locked due to too many attempts.
     */
    public function isLocked(): bool
    {
        if ($this->locked_until === null) {
            return false;
        }

        return $this->locked_until->isFuture();
    }

    /**
     * Get remaining lockout time in seconds.
     */
    public function getLockoutRemainingSeconds(): int
    {
        if (!$this->isLocked()) {
            return 0;
        }

        return $this->locked_until->diffInSeconds(now());
    }

    /**
     * Check if OTP has expired.
     */
    public function isExpired(): bool
    {
        return $this->created_at->addMinutes(self::OTP_EXPIRES_MINUTES)->isPast();
    }

    /**
     * Check if max attempts have been reached.
     */
    public function hasReachedMaxAttempts(): bool
    {
        return $this->attempts >= self::MAX_ATTEMPTS;
    }

    /**
     * Increment attempts counter and lock if max reached.
     *
     * @return bool True if now locked, false otherwise
     */
    public function incrementAttempts(): bool
    {
        $this->attempts++;

        if ($this->hasReachedMaxAttempts()) {
            $this->locked_until = now()->addMinutes(self::LOCKOUT_MINUTES);
            $this->save();
            return true;
        }

        $this->save();
        return false;
    }

    /**
     * Reset attempts counter (on successful verification or new OTP).
     */
    public function resetAttempts(): void
    {
        $this->attempts = 0;
        $this->locked_until = null;
        $this->save();
    }

    /**
     * Get remaining attempts.
     */
    public function getRemainingAttempts(): int
    {
        return max(0, self::MAX_ATTEMPTS - $this->attempts);
    }
}
