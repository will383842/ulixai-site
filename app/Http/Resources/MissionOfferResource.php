<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionOfferResource extends JsonResource
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
            'mission_id' => $this->mission_id,
            'provider_id' => $this->provider_id,
            'price' => (float) $this->price,
            'delivery_time' => $this->delivery_time,
            'message' => $this->message,
            'status' => $this->status,

            // Relations
            'provider' => new ServiceProviderResource($this->whenLoaded('provider')),
            'mission' => new MissionResource($this->whenLoaded('mission')),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
