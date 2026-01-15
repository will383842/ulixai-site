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
    ];

    protected $hidden = [
        'password',
        'remember_token',
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