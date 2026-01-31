<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'email_otp',
        'country',
        'affiliate_code',
        'referred_by',
        'referral_stats',
        'status',
        'user_role',
        'preferred_language',
        'preferred_currency',
        'spoken_languages',
        'is_fake',
        'last_login_at',
        'remember_token',
        'gender',
        'credit_balance',
        'affiliate_balance',
        'pending_affiliate_balance',
        'dob',
        'address',
        'phone_number',
        'bank_account_holder',
        'bank_account_iban',
        'bank_swift_bic',
        'bank_name',
        'account_country',
        'bank_details_verified_at',
        // Moderation fields
        'strike_count',
        'last_strike_at',
        'ban_reason',
        'banned_at',
        'can_appeal',
        'appeal_until',
        'trust_score',
        'requires_review',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'bank_account_iban',
        'bank_swift_bic',
        'bank_account_holder',
        'email_otp',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'bank_account_iban' => 'encrypted',
        'bank_swift_bic' => 'encrypted',
        'bank_details_verified_at' => 'datetime',
        'referral_stats' => 'array',
        'spoken_languages' => 'array',
        'is_fake' => 'boolean',
        'last_login_at' => 'datetime',
        'profile_photo_verified' => 'boolean',
        'profile_photo_verification_data' => 'array',
        'identity_verified' => 'boolean',
        'identity_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
        // Moderation casts
        'last_strike_at' => 'datetime',
        'banned_at' => 'datetime',
        'appeal_until' => 'datetime',
        'can_appeal' => 'boolean',
        'requires_review' => 'boolean',
    ];

    // ===========================================
    // RELATIONSHIPS
    // ===========================================

    public function serviceProvider(): HasOne
    {
        return $this->hasOne(ServiceProvider::class);
    }

    public function emailVerification()
    {
        return $this->hasOne(EmailVerification::class);
    }
   
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Get all users referred by this user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(AffiliateCommission::class, 'referrer_id');
    }

    /**
     * Get the document verifications for the user.
     */
    public function providerDocumentVerifications(): HasMany
    {
        return $this->hasMany(\App\Models\ProviderDocumentVerification::class);
    }
    
    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    /**
     * Check if user is banned
     */
    public function isBanned(): bool
    {
        return $this->status === 'banned';
    }

    /**
     * Check if user can submit an appeal
     */
    public function canAppeal(): bool
    {
        // User must be banned or suspended
        if (!$this->isBanned() && !$this->isSuspended()) {
            return false;
        }

        // Check if can_appeal flag is set
        if ($this->can_appeal === false) {
            return false;
        }

        // Check if appeal_until has passed
        if ($this->appeal_until && now()->gt($this->appeal_until)) {
            return false;
        }

        // Check if there's already a pending appeal
        $pendingAppeal = \App\Services\Global_Moderations\Models\UserAppeal::where('user_id', $this->id)
            ->whereIn('status', ['pending', 'under_review'])
            ->exists();

        return !$pendingAppeal;
    }

    /**
     * Get user's strikes
     */
    public function strikes(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\UserStrike::class);
    }

    /**
     * Get user's active strikes
     */
    public function activeStrikes(): HasMany
    {
        return $this->strikes()->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Get user's moderation flags
     */
    public function moderationFlags(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\ModerationFlag::class);
    }

    /**
     * Get user's moderation actions history
     */
    public function moderationActions(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\ModerationAction::class);
    }

    /**
     * Get user's appeals
     */
    public function appeals(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\UserAppeal::class);
    }

    /**
     * Get reports filed against this user
     */
    public function reportsAgainst(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\ContentReport::class, 'reported_user_id');
    }

    /**
     * Get reports filed by this user
     */
    public function reportsFiled(): HasMany
    {
        return $this->hasMany(\App\Services\Global_Moderations\Models\ContentReport::class, 'reporter_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot(['assigned_by', 'assigned_by_id', 'meta', 'assigned_at', 'revoked_at'])
            ->withTimestamps();
    }

    public function userBadge()
    {
        return $this->hasOne(UserBadge::class,'user_id');
    }

    public function hasAdminRole($role = null)
    {
        $roles = ['super_admin', 'regional_admin', 'moderator'];
        if ($role) {
            return $this->user_role === $role;
        }
        return in_array($this->user_role, $roles);
    }

    public function missions() 
    {
        return $this->hasMany(Mission::class, 'requester_id');
    }

    /**
     * Check if user has complete banking details
     */
    public function hasBankingDetails()
    {
        return !empty($this->bank_account_holder) &&
               !empty($this->bank_account_iban) &&
               !empty($this->bank_name);
    }

    // ===========================================
    // FORMATTED BALANCE ACCESSORS
    // ===========================================

    /**
     * Get the formatted credit balance with the user's preferred currency.
     */
    public function getFormattedCreditBalanceAttribute(): string
    {
        $amount = $this->credit_balance ?? 0;
        $currency = $this->preferred_currency ?? 'EUR';

        return $this->formatAmountWithCurrency($amount, $currency);
    }

    /**
     * Get the formatted affiliate balance with the user's preferred currency.
     */
    public function getFormattedAffiliateBalanceAttribute(): string
    {
        $amount = $this->affiliate_balance ?? 0;
        $currency = $this->preferred_currency ?? 'EUR';

        return $this->formatAmountWithCurrency($amount, $currency);
    }

    /**
     * Get the formatted pending affiliate balance with the user's preferred currency.
     */
    public function getFormattedPendingAffiliateBalanceAttribute(): string
    {
        $amount = $this->pending_affiliate_balance ?? 0;
        $currency = $this->preferred_currency ?? 'EUR';

        return $this->formatAmountWithCurrency($amount, $currency);
    }

    /**
     * Format an amount with the specified currency.
     */
    protected function formatAmountWithCurrency(float $amount, string $currency): string
    {
        $symbols = [
            'EUR' => "\u{20AC}",
            'USD' => '$',
            'GBP' => "\u{00A3}",
            'CHF' => 'CHF',
            'CAD' => 'CA$',
            'XOF' => 'CFA',
            'XAF' => 'FCFA',
            'MAD' => 'DH',
            'TND' => 'DT',
            'DZD' => 'DA',
        ];

        $symbol = $symbols[$currency] ?? $currency;
        $formattedAmount = number_format($amount, 2, ',', ' ');

        // Position du symbole selon la devise
        $symbolAfter = in_array($currency, ['EUR', 'XOF', 'XAF', 'MAD', 'TND', 'DZD', 'CHF']);

        return $symbolAfter
            ? "{$formattedAmount} {$symbol}"
            : "{$symbol}{$formattedAmount}";
    }

    // ===========================================
    // MESSAGES & NOTIFICATIONS
    // ===========================================

    /**
     * Compte TOUS les messages non lus (services + jobs)
     */
    public function unreadMessagesCount(): int
    {
        $userId = $this->id;
        $proId = $this->serviceProvider->id ?? $userId;

        $asRequesterConversation = Conversation::where('requester_id', $userId)->with('messages')->get();
        $asProviderConversation = Conversation::where('provider_id', $proId)->with('messages')->get();
        
        $totalUnread = 0;
        
        if($asRequesterConversation) {
            foreach($asRequesterConversation as $conv) {
                $unreadmessges = $conv->messages->where('is_read', false)->where('sender_id', '!=', $userId)->count();
                $totalUnread += $unreadmessges;
            }
        }

        if($asProviderConversation) {
            foreach($asProviderConversation as $conv) {
                $unreadmessges = $conv->messages->where('is_read', false)->where('sender_id', '!=', $userId)->count();
                $totalUnread += $unreadmessges;
            }
        }

        return $totalUnread;
    }

    /**
     * Compte le total des notifications non lues pour "My services request"
     * Inclut : propositions (offers) + messages privés des service requests
     */
    public function totalUnreadServiceNotifications(): int
    {
        $total = 0;
        
        // 1. Messages privés non lus dans les conversations de type "service"
        $asRequesterConversations = Conversation::where('requester_id', $this->id)
            ->where('type', 'service')
            ->with('messages')
            ->get();
        
        foreach($asRequesterConversations as $conv) {
            $unreadMessages = $conv->messages
                ->where('is_read', false)
                ->where('sender_id', '!=', $this->id)
                ->count();
            $total += $unreadMessages;
        }
        
        // 2. Propositions (offers) non lues sur mes missions
        $unreadOffers = DB::table('mission_offers')
            ->join('missions', 'mission_offers.mission_id', '=', 'missions.id')
            ->where('missions.requester_id', $this->id)
            ->whereNull('mission_offers.read_at')
            ->count();
        
        $total += $unreadOffers;
        
        return $total;
    }

    // ===========================================
    // GOOGLE VISION VERIFICATION
    // ===========================================

    /**
     * Check if user's identity is fully verified.
     */
    public function isIdentityVerified(): bool
    {
        return $this->identity_verified;
    }

    /**
     * Check if user has a verified document of a specific type.
     */
    public function hasVerifiedDocument(string $type): bool
    {
        return $this->providerDocumentVerifications()
            ->where('document_type', $type)
            ->where('verification_status', 'verified')
            ->exists();
    }

    /**
     * Get all complete (verified) documents.
     */
    public function getCompleteDocuments()
    {
        return $this->providerDocumentVerifications()
            ->where('verification_status', 'verified')
            ->get();
    }

    /**
     * Check if user can become a provider (has verified photo + at least one document).
     */
    public function canBecomeProvider(): bool
    {
        $hasVerifiedPhoto = $this->profile_photo_verified;
        $hasVerifiedDocument = $this->providerDocumentVerifications()
            ->where('verification_status', 'verified')
            ->exists();
        
        return $hasVerifiedPhoto && $hasVerifiedDocument;
    }

    // ===========================================
    // MISSIONS COUNTS BY STATUS
    // ===========================================

    /**
     * Compte les missions publiées (published)
     */
    public function missionsPublishedCount(): int
    {
        return $this->missions()->where('status', 'published')->count();
    }

    /**
     * Compte les missions en cours (in_progress)
     */
    public function missionsInProgressCount(): int
    {
        return $this->missions()->where('status', 'in_progress')->count();
    }

    /**
     * Compte les missions complétées (completed)
     */
    public function missionsCompletedCount(): int
    {
        return $this->missions()->where('status', 'completed')->count();
    }

    /**
     * Compte les missions annulées (cancelled)
     */
    public function missionsCancelledCount(): int
    {
        return $this->missions()->whereIn('status', ['cancelled', 'cancelled_by_requester', 'cancelled_by_provider'])->count();
    }
}