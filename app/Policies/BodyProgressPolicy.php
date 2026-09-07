<?php

namespace App\Policies;

use App\Models\BodyProgress;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class BodyProgressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('body_progress.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, BodyProgress $bodyProgress): bool
    {
        return $user->hasAbility('body-progress.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('body-progress.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, BodyProgress $bodyProgress): bool
    {
        return $user->hasAbility('body-progress.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, BodyProgress $bodyProgress): bool
    {
        return $user->hasAbility('body-progress.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, BodyProgress $bodyProgress): bool
    {
        return $user->hasAbility('body-progress.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, BodyProgress $bodyProgress): bool
    {
        return $user->hasAbility('body-progress.forceDelete');
    }
}
