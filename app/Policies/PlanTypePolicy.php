<?php

namespace App\Policies;

use App\Models\PlanType;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class PlanTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('plan_type.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, PlanType $planType): bool
    {
        return $user->hasAbility('plan_type.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('plan_type.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, PlanType $planType): bool
    {
        return $user->hasAbility('plan_type.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, PlanType $planType): bool
    {
        return $user->hasAbility('plan_type.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, PlanType $planType): bool
    {
        return $user->hasAbility('plan_type.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, PlanType $planType): bool
    {
        return $user->hasAbility('plan_type.forceDelete');
    }
}
