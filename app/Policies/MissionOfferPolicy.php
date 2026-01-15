<?php

namespace App\Policies;

use App\Models\MissionOffer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissionOfferPolicy
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
    public function view(User $user, MissionOffer $offer): bool
    {
        // Provider who created the offer can view it
        if ($user->serviceProvider && $offer->provider_id === $user->serviceProvider->id) {
            return true;
        }

        // Requester of the mission can view all offers on their mission
        if ($offer->mission && $offer->mission->requester_id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only service providers can create offers
        return $user->serviceProvider !== null && $user->status === 'active';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MissionOffer $offer): bool
    {
        // Only the provider who created the offer can update it
        if (!$user->serviceProvider) {
            return false;
        }

        // Can only update pending offers
        if ($offer->status !== 'pending') {
            return false;
        }

        return $offer->provider_id === $user->serviceProvider->id;
    }

    /**
     * Determine whether the user can delete (cancel) the model.
     */
    public function delete(User $user, MissionOffer $offer): bool
    {
        // Only the provider who created the offer can cancel it
        if (!$user->serviceProvider) {
            return false;
        }

        // Cannot cancel accepted offers
        if ($offer->status === 'accepted') {
            return false;
        }

        return $offer->provider_id === $user->serviceProvider->id;
    }

    /**
     * Determine whether the user can accept the offer.
     */
    public function accept(User $user, MissionOffer $offer): bool
    {
        // Only the requester of the mission can accept offers
        if (!$offer->mission) {
            return false;
        }

        return $offer->mission->requester_id === $user->id && $offer->status === 'pending';
    }

    /**
     * Determine whether the user can reject the offer.
     */
    public function reject(User $user, MissionOffer $offer): bool
    {
        // Only the requester of the mission can reject offers
        if (!$offer->mission) {
            return false;
        }

        return $offer->mission->requester_id === $user->id && $offer->status === 'pending';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MissionOffer $offer): bool
    {
        if (!$user->serviceProvider) {
            return false;
        }

        return $offer->provider_id === $user->serviceProvider->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MissionOffer $offer): bool
    {
        return false; // Never allow force delete
    }
}
