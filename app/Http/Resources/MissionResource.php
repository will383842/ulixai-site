<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'payment_status' => $this->payment_status,

            // Categories
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'subsubcategory_id' => $this->subsubcategory_id,

            // Budget
            'budget_min' => $this->budget_min,
            'budget_max' => $this->budget_max,
            'budget_currency' => $this->budget_currency ?? 'EUR',

            // Location
            'location_country' => $this->location_country,
            'location_city' => $this->location_city,
            'is_remote' => (bool) $this->is_remote,

            // Service details
            'service_duration' => $this->service_duration,
            'requester_duration_in_country' => $this->requester_duration_in_country,
            'language' => $this->language,
            'spoken_languages' => $this->spoken_languages,
            'urgency' => $this->urgency,

            // Attachments
            'attachments' => $this->attachments,

            // Requester info (limited for privacy)
            'requester_id' => $this->requester_id,
            'requester' => $this->when(
                $request->user()?->id === $this->requester_id ||
                ($request->user()?->serviceProvider &&
                 $this->selected_provider_id === $request->user()->serviceProvider->id),
                new UserResource($this->whenLoaded('requester'))
            ),

            // Provider info
            'selected_provider_id' => $this->selected_provider_id,
            'selected_provider' => new ServiceProviderResource($this->whenLoaded('selectedProvider')),

            // Relations
            'category' => new CategoryResource($this->whenLoaded('category')),
            'subcategory' => new CategoryResource($this->whenLoaded('subcategory')),
            'offers' => MissionOfferResource::collection($this->whenLoaded('offers')),
            'offers_count' => $this->whenCounted('offers'),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),

            // Cancellation info (if applicable)
            'cancelled_by' => $this->when($this->status === 'cancelled', $this->cancelled_by),
            'cancelled_on' => $this->when($this->status === 'cancelled', $this->cancelled_on?->toIso8601String()),
        ];
    }
}
