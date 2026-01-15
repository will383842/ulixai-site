<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'user_role' => $this->user_role,
            'status' => $this->status,
            'country' => $this->country,
            'preferred_language' => $this->preferred_language,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email_verified_at' => $this->email_verified_at?->toIso8601String(),
            'last_login_at' => $this->last_login_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),

            // Credit and affiliate info
            'credit_balance' => $this->when(
                $request->user()?->id === $this->id,
                $this->credit_balance
            ),
            'affiliate_code' => $this->when(
                $request->user()?->id === $this->id,
                $this->affiliate_code
            ),
            'affiliate_balance' => $this->when(
                $request->user()?->id === $this->id,
                $this->affiliate_balance
            ),

            // Service provider relation
            'service_provider' => new ServiceProviderResource($this->whenLoaded('serviceProvider')),
        ];
    }
}
