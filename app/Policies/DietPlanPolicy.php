<?php

namespace App\Policies;

use App\Models\DietPlan;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class DietPlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('diet_plan.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, DietPlan $dietPlan): bool
    {
        return $user->hasAbility('diet_plan.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('diet_plan.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, DietPlan $dietPlan): bool
    {
        return $user->hasAbility('diet_plan.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, DietPlan $dietPlan): bool
    {
        return $user->hasAbility('diet_plan.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, DietPlan $dietPlan): bool
    {
        return $user->hasAbility('diet_plan.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, DietPlan $dietPlan): bool
    {
        return $user->hasAbility('diet_plan.forceDelete');
    }
}
