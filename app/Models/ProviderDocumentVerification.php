<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderDocumentVerification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provider_document_verifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'document_type',
        'document_side',
        'image_path',
        'verification_status',
        'confidence_score',
        'detected_text',
        'detected_labels',
        'google_response',
        'rejection_reason',
        'retry_count',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'detected_labels' => 'array',
        'google_response' => 'array',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the document verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the document verification is complete and verified.
     */
    public function isComplete(): bool
    {
        return $this->verification_status === 'verified';
    }

    /**
     * Check if the document needs a retry.
     */
    public function needsRetry(): bool
    {
        return $this->verification_status === 'error' 
            && $this->retry_count < config('google-vision.max_retries', 3);
    }

    /**
     * Scope a query to only include pending verifications.
     */
    public function scopePending($query)
    {
        return $query->where('verification_status', 'pending');
    }

    /**
     * Scope a query to only include verified documents.
     */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    /**
     * Scope a query to only include rejected documents.
     */
    public function scopeRejected($query)
    {
        return $query->where('verification_status', 'rejected');
    }

    /**
     * Scope a query to only include documents in error state.
     */
    public function scopeError($query)
    {
        return $query->where('verification_status', 'error');
    }
}