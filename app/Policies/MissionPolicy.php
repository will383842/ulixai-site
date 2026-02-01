<?php

namespace App\Policies;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * SECURITY: Only active, non-banned users can browse missions.
     * This prevents suspended/banned users from accessing the platform.
     */
    public function viewAny(User $user): bool
    {
        // User must have an active account status
        return $user->status === 'active';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mission $mission): bool
    {
        // Requester can always view their own missions
        if ($mission->requester_id === $user->id) {
            return true;
        }

        // Selected provider can view the mission
        if ($user->serviceProvider && $mission->selected_provider_id === $user->serviceProvider->id) {
            return true;
        }

        // Provider who made an offer can view the mission
        if ($user->serviceProvider) {
            $hasOffer = $mission->offers()->where('provider_id', $user->serviceProvider->id)->exists();
            if ($hasOffer) {
                return true;
            }
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
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mission $mission): bool
    {
        // Only requester can update their mission
        return $mission->requester_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mission $mission): bool
    {
        // Only requester can delete their mission
        return $mission->requester_id === $user->id;
    }

    /**
     * Determine whether the user can cancel the mission.
     */
    public function cancel(User $user, Mission $mission): bool
    {
        // Requester can cancel their own mission
        if ($mission->requester_id === $user->id) {
            return true;
        }

        // Selected provider can cancel (with penalties)
        if ($user->serviceProvider && $mission->selected_provider_id === $user->serviceProvider->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can start the mission.
     */
    public function start(User $user, Mission $mission): bool
    {
        // Only selected provider can start the mission
        if (!$user->serviceProvider) {
            return false;
        }

        return $mission->selected_provider_id === $user->serviceProvider->id
            && $mission->status === 'waiting_to_start'
            && $mission->payment_status === 'paid';
    }

    /**
     * Determine whether the user can complete the mission.
     */
    public function complete(User $user, Mission $mission): bool
    {
        // Only selected provider can complete the mission
        if (!$user->serviceProvider) {
            return false;
        }

        return $mission->selected_provider_id === $user->serviceProvider->id
            && $mission->status === 'in_progress';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mission $mission): bool
    {
        return $mission->requester_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mission $mission): bool
    {
        return false; // Never allow force delete
    }
}
