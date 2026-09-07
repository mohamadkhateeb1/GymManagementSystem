<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\TrainingPlan;
use Illuminate\Auth\Access\Response;

class TrainingPlanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('training_plan.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, TrainingPlan $trainingPlan): bool
    {
        return $user->hasAbility('training_plan.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('training_plan.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, TrainingPlan $trainingPlan): bool
    {
        return $user->hasAbility('training_plan.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, TrainingPlan $trainingPlan): bool
    {
        return $user->hasAbility('training_plan.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, TrainingPlan $trainingPlan): bool
    {
        return $user->hasAbility('training_plan.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, TrainingPlan $trainingPlan): bool
    {
        return $user->hasAbility('training_plan.forceDelete');
    }
}
