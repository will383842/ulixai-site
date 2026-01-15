<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
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
            'requester_id' => $this->requester_id,
            'provider_id' => $this->provider_id,

            // Relations
            'mission' => new MissionResource($this->whenLoaded('mission')),
            'requester' => new UserResource($this->whenLoaded('requester')),
            'provider' => new ServiceProviderResource($this->whenLoaded('provider')),
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'messages_count' => $this->whenCounted('messages'),

            // Last message preview
            'last_message' => $this->when(
                $this->relationLoaded('messages') && $this->messages->isNotEmpty(),
                function () {
                    return new MessageResource($this->messages->last());
                }
            ),

            // Unread count for current user
            'unread_count' => $this->when(
                $request->user(),
                function () use ($request) {
                    if ($this->relationLoaded('messages')) {
                        return $this->messages
                            ->where('is_read', false)
                            ->where('sender_id', '!=', $request->user()->id)
                            ->count();
                    }
                    return null;
                }
            ),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
