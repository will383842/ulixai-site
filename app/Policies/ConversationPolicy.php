<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Conversation $conversation): bool
    {
        // Requester can view
        if ($conversation->requester_id === $user->id) {
            return true;
        }

        // Provider can view
        if ($user->serviceProvider && $conversation->provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->status === 'active';
    }

    /**
     * Determine whether the user can send messages in the conversation.
     */
    public function sendMessage(User $user, Conversation $conversation): bool
    {
        // Requester can send messages
        if ($conversation->requester_id === $user->id) {
            return true;
        }

        // Provider can send messages
        if ($user->serviceProvider && $conversation->provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Conversation $conversation): bool
    {
        // Only participants can update (mark as read, etc.)
        if ($conversation->requester_id === $user->id) {
            return true;
        }

        if ($user->serviceProvider && $conversation->provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Conversation $conversation): bool
    {
        // Only requester can delete the conversation
        return $conversation->requester_id === $user->id;
    }

    /**
     * Determine whether the user can report the conversation.
     */
    public function report(User $user, Conversation $conversation): bool
    {
        // Both participants can report
        if ($conversation->requester_id === $user->id) {
            return true;
        }

        if ($user->serviceProvider && $conversation->provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Conversation $conversation): bool
    {
        return $conversation->requester_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Conversation $conversation): bool
    {
        return false; // Never allow force delete
    }
}
