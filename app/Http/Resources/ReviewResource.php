<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'provider_id' => $this->provider_id,
            'mission_id' => $this->mission_id,
            'user_id' => $this->user_id,
            'rating' => (float) $this->rating,
            'comment' => $this->comment,
            'is_visible' => (bool) $this->is_visible,

            // Reviewer info (limited for privacy)
            'reviewer_name' => $this->whenLoaded('user', function () {
                return $this->user->name;
            }),

            // Relations
            'provider' => new ServiceProviderResource($this->whenLoaded('provider')),
            'mission' => new MissionResource($this->whenLoaded('mission')),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
