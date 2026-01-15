<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'slug' => $this->slug,
            'profile_photo' => $this->profile_photo,
            'profile_description' => $this->profile_description,

            // Location
            'country' => $this->country,
            'provider_address' => $this->provider_address,
            'operational_countries' => $this->operational_countries,

            // Languages
            'native_language' => $this->native_language,
            'spoken_language' => $this->spoken_language,

            // Services
            'services_to_offer' => $this->services_to_offer,
            'services_to_offer_category' => $this->services_to_offer_category,

            // Communication preferences
            'communication_online' => (bool) $this->communication_online,
            'communication_inperson' => (bool) $this->communication_inperson,

            // Status
            'is_active' => (bool) $this->is_active,
            'ulysse_status' => $this->ulysse_status,
            'points' => $this->points,
            'special_status' => $this->special_status,

            // KYC Status (only for owner or admin)
            'kyc_status' => $this->when(
                $request->user()?->id === $this->user_id ||
                in_array($request->user()?->user_role, ['super_admin', 'regional_admin']),
                $this->kyc_status
            ),

            // Stripe info (only for owner)
            'stripe_account_id' => $this->when(
                $request->user()?->id === $this->user_id,
                $this->stripe_account_id ? 'connected' : null
            ),
            'kyc_link' => $this->when(
                $request->user()?->id === $this->user_id && $this->kyc_status !== 'verified',
                $this->kyc_link
            ),

            // Relations
            'user' => new UserResource($this->whenLoaded('user')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'missions_count' => $this->whenCounted('missions'),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
