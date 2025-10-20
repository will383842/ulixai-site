<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'referral_stats' => 'array',
        'is_fake' => 'boolean',
        'last_login_at' => 'datetime',
        'bank_details_verified_at' => 'datetime',
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

    public function unreadMessagesCount(): int
    {
        $userId = $this->id;
         $proId = $this->serviceProvider->id ?? $userId;

        $asRequesterConversation  = Conversation::where('requester_id', $userId)->with('messages')->get();

        $asProviderConversation  = Conversation::where('provider_id', $proId)->with('messages')->get();
        $totalUnread = 0;
        if($asRequesterConversation) {
            foreach($asRequesterConversation as $conv) {
                $unreadmessges =  $conv->messages->where('is_read', false)->where('sender_id', '!=', $userId)->count();
                $totalUnread += $unreadmessges;
            }
        }

        if($asProviderConversation) {
            foreach($asProviderConversation as $conv) {
                $unreadmessges =  $conv->messages->where('is_read', false)->where('sender_id', '!=', $userId)->count();
                $totalUnread += $unreadmessges;
            }
        }

        return $totalUnread;
        
    }

    public function missions() {
        return $this->hasMany(Mission::class, 'requester_id');
    }

    public function hasBankingDetails(): bool
    {
        return !is_null($this->bank_account_holder) && 
               !is_null($this->bank_account_iban) && 
               !is_null($this->bank_swift_bic);
    }

}


