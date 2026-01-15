<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'mission_id' => $this->mission_id,
            'provider_id' => $this->provider_id,
            'offer_id' => $this->offer_id,
            'amount_paid' => (float) $this->getRawOriginal('amount_paid'),
            'status' => $this->status,
            'country' => $this->country,

            // Fee info (only for admins or participants)
            'client_fee' => $this->when(
                $this->canViewFees($request),
                (float) $this->client_fee
            ),
            'provider_fee' => $this->when(
                $this->canViewFees($request),
                (float) $this->provider_fee
            ),

            // Stripe info (only for admins)
            'stripe_payment_intent_id' => $this->when(
                in_array($request->user()?->user_role, ['super_admin', 'regional_admin']),
                $this->stripe_payment_intent_id
            ),

            // Relations
            'mission' => new MissionResource($this->whenLoaded('mission')),
            'provider' => new ServiceProviderResource($this->whenLoaded('provider')),
            'offer' => new MissionOfferResource($this->whenLoaded('offer')),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }

    /**
     * Check if the user can view fee information.
     */
    private function canViewFees(Request $request): bool
    {
        $user = $request->user();

        if (!$user) {
            return false;
        }

        // Admins can always see fees
        if (in_array($user->user_role, ['super_admin', 'regional_admin'])) {
            return true;
        }

        // Mission requester can see fees
        if ($this->mission && $this->mission->requester_id === $user->id) {
            return true;
        }

        // Provider can see fees
        if ($user->serviceProvider && $this->provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }
}
