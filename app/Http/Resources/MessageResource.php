<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'conversation_id' => $this->conversation_id,
            'sender_id' => $this->sender_id,
            'message' => $this->message,
            'is_read' => (bool) $this->is_read,
            'read_at' => $this->read_at?->toIso8601String(),

            // Attachments if any
            'attachments' => $this->attachments,

            // Sender info
            'sender' => new UserResource($this->whenLoaded('sender')),

            // Is current user the sender
            'is_mine' => $this->when(
                $request->user(),
                $this->sender_id === $request->user()?->id
            ),

            // Timestamps
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
