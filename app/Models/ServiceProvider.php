<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceProvider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'native_language',
        'spoken_language',
        'services_to_offer',
        'services_to_offer_category',
        'provider_address',
        'operational_countries',
        'communication_online',
        'communication_inperson',
        'profile_description',
        'profile_photo',
        'provider_docs',
        'phone_number',
        'country',
        'preferred_language',
        'special_status',
        'email',
        'documents',
        'ip_address',
        'stripe_account_id',
        'slug',
        'stripe_chg_enabled',
        'stripe_pts_enabled', 
        'kyc_link',
        'kyc_status',
        'points',
        'ulysse_status',
        'provider_visibility',
        'country_coords',
        'city_coords',
        'pinned',
        'is_active',
        'deleted_at',
    ];

    protected $casts = [
        'spoken_language' => 'array',
        'operational_countries' => 'array',
        'special_status' => 'array',
        'documents' => 'array',
        'country_coords' => 'array',
        'city_coords' => 'array',
        'deleted_at' => 'datetime',
        'is_active' => 'boolean',
        'services_to_offer' => 'array',
        'services_to_offer_category' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProviderReview::class, 'provider_id');
    }

    public function missions(): HasMany 
    {
        return $this->hasMany(Mission::class, 'selected_provider_id');
    }
}