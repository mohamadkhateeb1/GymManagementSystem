<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\Rating;
use Illuminate\Auth\Access\Response;

class RatingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('rating.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user): bool
    {
        return $user->hasAbility('rating.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('rating.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user): bool
    {
        return $user->hasAbility('rating.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user): bool
    {
        return $user->hasAbility('rating.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user): bool
    {
        return $user->hasAbility('rating.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user): bool
    {
        return $user->hasAbility('rating.forceDelete');
    }
}
